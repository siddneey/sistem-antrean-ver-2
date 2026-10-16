<?php

namespace App\Controllers;

use App\Models\GrupModel;
use App\Models\InstansiModel;
use App\Models\LayananModel;
use CodeIgniter\Database\BaseConnection;
use Throwable;

class AdminInstansiController extends BaseController
{
    protected InstansiModel $instansiModel;
    protected GrupModel $grupModel;
    protected LayananModel $layananModel;

    public function __construct()
    {
        $this->instansiModel = new InstansiModel();
        $this->grupModel = new GrupModel();
        $this->layananModel = new LayananModel();
    }

    /**
     * GET /admin/instansi/halaman
     */
    public function halaman()
    {
        $instansi = $this->instansiModel
            ->select([
                'instansi.id',
                'instansi.grup_id',
                'instansi.nama_instansi',
                'instansi.logo',
                'grup.nama_grup',
            ])
            ->join('grup', 'grup.id = instansi.grup_id', 'left')
            ->orderBy('instansi.nama_instansi', 'ASC')
            ->findAll();

        $layananModel = new \App\Models\LayananModel();

        foreach ($instansi as &$item) {
            $item['layanan'] = $layananModel
                ->select('id, nama_layanan')
                ->where('instansi_id', $item['id'])
                ->orderBy('nama_layanan', 'ASC')
                ->findAll();
        }
        unset($item);

        return view('admin/instansi', [
            'instansi' => $instansi,
            'activeMenu' => 'instansi',
        ]);
    }

    /**
     * Ubah input layanan menjadi daftar nama yang bersih.
     * Input bisa berupa teks per baris atau array.
     */
    private function parseLayanan($input): array
    {
        if (is_string($input)) {
            $input = preg_split('/\r\n|\r|\n/', $input);
        }

        if (!is_array($input)) {
            return [];
        }

        $hasil = [];
        $terdaftar = [];

        foreach ($input as $nama) {
            if (!is_string($nama) && !is_numeric($nama)) {
                continue;
            }

            $nama = trim((string) $nama);

            if ($nama === '') {
                continue;
            }

            if (mb_strlen($nama) > 150) {
                throw new \InvalidArgumentException(
                    'Nama layanan maksimal 150 karakter.'
                );
            }

            // Hindari duplikat tanpa membedakan huruf besar/kecil.
            $key = mb_strtolower($nama);

            if (isset($terdaftar[$key])) {
                continue;
            }

            $terdaftar[$key] = true;
            $hasil[] = $nama;
        }

        return $hasil;
    }

    /**
     * Simpan hanya layanan yang belum dimiliki instansi.
     * Layanan lama tidak dihapus.
     */
    private function tambahLayananBaru(
        BaseConnection $db,
        int $instansiId,
        array $namaLayanan
    ): int {
        $query = $db->table('layanan')
            ->select('nama_layanan')
            ->where('instansi_id', $instansiId)
            ->get()
            ->getResultArray();

        $existing = [];

        foreach ($query as $item) {
            $existing[mb_strtolower(trim($item['nama_layanan']))] = true;
        }

        $jumlahDitambahkan = 0;

        foreach ($namaLayanan as $nama) {
            $key = mb_strtolower($nama);

            if (isset($existing[$key])) {
                continue;
            }

            $berhasil = $this->layananModel->insert([
                'instansi_id' => $instansiId,
                'nama_layanan' => $nama,
            ]);

            if (!$berhasil) {
                throw new \RuntimeException(
                    'Gagal menyimpan layanan.'
                );
            }

            $existing[$key] = true;
            $jumlahDitambahkan++;
        }

        return $jumlahDitambahkan;
    }

    /**
     * GET /admin/instansi
     */
    public function index()
    {
        $instansi = $this->instansiModel
            ->select([
                'instansi.id',
                'instansi.grup_id',
                'instansi.nama_instansi',
                'instansi.logo',
                'instansi.created_at',
                'instansi.updated_at',
                'grup.nama_grup',
            ])
            ->join('grup', 'grup.id = instansi.grup_id', 'left')
            ->orderBy('instansi.nama_instansi', 'ASC')
            ->findAll();

        foreach ($instansi as &$item) {
            $item['layanan'] = $this->layananModel
                ->select('id, nama_layanan')
                ->where('instansi_id', $item['id'])
                ->orderBy('nama_layanan', 'ASC')
                ->findAll();
        }
        unset($item);

        return $this->response->setJSON([
            'status' => true,
            'data' => $instansi,
        ]);
    }

    /**
     * POST /admin/instansi
     *
     * Form-data:
     * nama_instansi, grup_id, logo (opsional), layanan (per baris)
     */
    public function create()
    {
        $input = $this->request->getPost();

        if (!is_array($input) || empty($input)) {
            $input = $this->request->getJSON(true) ?? [];
        }

        $namaInstansi = trim((string) ($input['nama_instansi'] ?? ''));
        $grupId = filter_var(
            $input['grup_id'] ?? null,
            FILTER_VALIDATE_INT
        );
        $logo = trim((string) ($input['logo'] ?? ''));

        if ($namaInstansi === '' || mb_strlen($namaInstansi) > 150) {
            return $this->response->setStatusCode(400)->setJSON([
                'status' => false,
                'message' => 'Nama instansi wajib diisi dan maksimal 150 karakter.',
            ]);
        }

        if ($grupId === false || $grupId < 1) {
            return $this->response->setStatusCode(400)->setJSON([
                'status' => false,
                'message' => 'Grup wajib dipilih.',
            ]);
        }

        if ($logo !== '' && mb_strlen($logo) > 255) {
            return $this->response->setStatusCode(400)->setJSON([
                'status' => false,
                'message' => 'Logo maksimal 255 karakter.',
            ]);
        }

        if (!$this->grupModel->find($grupId)) {
            return $this->response->setStatusCode(404)->setJSON([
                'status' => false,
                'message' => 'Grup tidak ditemukan.',
            ]);
        }

        if ($this->instansiModel
            ->where('nama_instansi', $namaInstansi)
            ->first()
        ) {
            return $this->response->setStatusCode(409)->setJSON([
                'status' => false,
                'message' => 'Nama instansi sudah digunakan.',
            ]);
        }

        try {
            $namaLayanan = $this->parseLayanan($input['layanan'] ?? []);

            $db = db_connect();
            $db->transBegin();

            $data = [
                'grup_id' => (int) $grupId,
                'nama_instansi' => $namaInstansi,
            ];

            if ($logo !== '') {
                $data['logo'] = $logo;
            }

            $id = $this->instansiModel->insert($data, true);

            if (!$id) {
                throw new \RuntimeException(
                    'Gagal menyimpan instansi.'
                );
            }

            $jumlahLayanan = $this->tambahLayananBaru(
                $db,
                (int) $id,
                $namaLayanan
            );

            if ($db->transStatus() === false) {
                throw new \RuntimeException(
                    'Transaksi database gagal.'
                );
            }

            $db->transCommit();

            return $this->response->setStatusCode(201)->setJSON([
                'status' => true,
                'message' => 'Instansi berhasil ditambahkan.',
                'data' => [
                    'id' => (int) $id,
                    'jumlah_layanan_ditambahkan' => $jumlahLayanan,
                ],
            ]);
        } catch (\InvalidArgumentException $e) {
            if (isset($db) && $db->transStatus() !== false) {
                $db->transRollback();
            }

            return $this->response->setStatusCode(400)->setJSON([
                'status' => false,
                'message' => $e->getMessage(),
            ]);
        } catch (Throwable $e) {
            if (isset($db)) {
                $db->transRollback();
            }

            log_message('error', 'Gagal membuat instansi: {error}', [
                'error' => $e->getMessage(),
            ]);

            return $this->response->setStatusCode(500)->setJSON([
                'status' => false,
                'message' => 'Gagal menyimpan instansi dan layanan.',
            ]);
        }
    }

    /**
     * PUT /admin/instansi/{id}
     *
     * Layanan yang dikirim hanya ditambahkan.
     * Layanan lama tetap dipertahankan.
     */
    public function update($id)
    {
        $id = (int) $id;
        $instansi = $this->instansiModel->find($id);

        if ($id < 1 || !$instansi) {
            return $this->response->setStatusCode(404)->setJSON([
                'status' => false,
                'message' => 'Instansi tidak ditemukan.',
            ]);
        }

        $input = $this->request->getJSON(true);

        if (!is_array($input)) {
            return $this->response->setStatusCode(400)->setJSON([
                'status' => false,
                'message' => 'Request JSON tidak valid.',
            ]);
        }

        $data = [];

        if (array_key_exists('nama_instansi', $input)) {
            $nama = trim((string) $input['nama_instansi']);

            if ($nama === '' || mb_strlen($nama) > 150) {
                return $this->response->setStatusCode(400)->setJSON([
                    'status' => false,
                    'message' => 'Nama instansi wajib diisi dan maksimal 150 karakter.',
                ]);
            }

            $duplikat = $this->instansiModel
                ->where('nama_instansi', $nama)
                ->where('id !=', $id)
                ->first();

            if ($duplikat) {
                return $this->response->setStatusCode(409)->setJSON([
                    'status' => false,
                    'message' => 'Nama instansi sudah digunakan.',
                ]);
            }

            $data['nama_instansi'] = $nama;
        }

        if (array_key_exists('grup_id', $input)) {
            $grupId = filter_var(
                $input['grup_id'],
                FILTER_VALIDATE_INT
            );

            if ($grupId === false || $grupId < 1) {
                return $this->response->setStatusCode(400)->setJSON([
                    'status' => false,
                    'message' => 'Grup tidak valid.',
                ]);
            }

            if (!$this->grupModel->find($grupId)) {
                return $this->response->setStatusCode(404)->setJSON([
                    'status' => false,
                    'message' => 'Grup tidak ditemukan.',
                ]);
            }

            $data['grup_id'] = (int) $grupId;
        }

        if (array_key_exists('logo', $input)) {
            $logo = trim((string) $input['logo']);

            if (mb_strlen($logo) > 255) {
                return $this->response->setStatusCode(400)->setJSON([
                    'status' => false,
                    'message' => 'Logo maksimal 255 karakter.',
                ]);
            }

            $data['logo'] = $logo !== '' ? $logo : null;
        }

        try {
            // Jika key layanan tidak dikirim, daftar layanan tidak disentuh.
            $namaLayanan = array_key_exists('layanan', $input)
                ? $this->parseLayanan($input['layanan'])
                : null;

            if (empty($data) && ($namaLayanan === null || empty($namaLayanan))) {
                return $this->response->setStatusCode(400)->setJSON([
                    'status' => false,
                    'message' => 'Tidak ada data yang diubah.',
                ]);
            }

            $db = db_connect();
            $db->transBegin();

            if (!empty($data)) {
                if (!$this->instansiModel->update($id, $data)) {
                    throw new \RuntimeException(
                        'Gagal memperbarui instansi.'
                    );
                }
            }

            $jumlahLayanan = 0;

            if ($namaLayanan !== null) {
                $jumlahLayanan = $this->tambahLayananBaru(
                    $db,
                    $id,
                    $namaLayanan
                );
            }

            if ($db->transStatus() === false) {
                throw new \RuntimeException(
                    'Transaksi database gagal.'
                );
            }

            $db->transCommit();

            return $this->response->setJSON([
                'status' => true,
                'message' => 'Instansi berhasil diperbarui.',
                'jumlah_layanan_ditambahkan' => $jumlahLayanan,
            ]);
        } catch (\InvalidArgumentException $e) {
            if (isset($db)) {
                $db->transRollback();
            }

            return $this->response->setStatusCode(400)->setJSON([
                'status' => false,
                'message' => $e->getMessage(),
            ]);
        } catch (Throwable $e) {
            if (isset($db)) {
                $db->transRollback();
            }

            log_message('error', 'Gagal memperbarui instansi: {error}', [
                'error' => $e->getMessage(),
            ]);

            return $this->response->setStatusCode(500)->setJSON([
                'status' => false,
                'message' => 'Gagal memperbarui instansi.',
            ]);
        }
    }

    /**
     * DELETE /admin/instansi/{id}
     *
     * Menghapus instansi dan layanan miliknya dalam satu transaksi.
     */
    public function delete($id)
    {
        $id = (int) $id;
        $instansi = $this->instansiModel->find($id);

        if ($id < 1 || !$instansi) {
            return $this->response->setStatusCode(404)->setJSON([
                'status' => false,
                'message' => 'Instansi tidak ditemukan.',
            ]);
        }

        $db = db_connect();

        try {
            $db->transBegin();

            $this->layananModel
                ->where('instansi_id', $id)
                ->delete();

            $this->instansiModel->delete($id);

            if ($db->transStatus() === false) {
                throw new \RuntimeException(
                    'Transaksi database gagal.'
                );
            }

            $db->transCommit();

            return $this->response->setJSON([
                'status' => true,
                'message' => 'Instansi dan layanan terkait berhasil dihapus.',
            ]);
        } catch (Throwable $e) {
            $db->transRollback();

            log_message('error', 'Gagal menghapus instansi: {error}', [
                'error' => $e->getMessage(),
            ]);

            return $this->response->setStatusCode(500)->setJSON([
                'status' => false,
                'message' => 'Gagal menghapus instansi.',
            ]);
        }
    }
}
