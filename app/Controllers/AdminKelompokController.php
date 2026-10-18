<?php

namespace App\Controllers;

use App\Models\KelompokModel;
use App\Models\GrupModel;
use App\Models\InstansiModel;
use CodeIgniter\HTTP\ResponseInterface;
use RuntimeException;
use Throwable;

class AdminKelompokController extends BaseController
{
    protected KelompokModel $kelompokModel;
    protected GrupModel $grupModel;
    protected InstansiModel $instansiModel;

    public function __construct()
    {
        $this->kelompokModel = new KelompokModel();
        $this->grupModel = new GrupModel();
        $this->instansiModel = new InstansiModel();
    }

    /**
     * Membaca JSON request.
     */
    private function jsonInput(): ?array
    {
        $input = $this->request->getJSON(true);

        return is_array($input) ? $input : null;
    }

    /**
     * GET /pengaturan-kelompok
     *
     * Menampilkan halaman pengaturan kelompok, grup,
     * instansi, dan jalur suara.
     */

    public function halaman()
    {
        try {
            // Data kelompok dan jalur suara.
            $kelompokRows = $this->kelompokModel
                ->select(
                    'id, nama_kelompok, suara, created_at, updated_at'
                )
                ->orderBy('id', 'ASC')
                ->findAll();

            // Data grup beserta kelompok induknya.
            $grupRows = $this->grupModel
                ->select(
                    'grup.id, grup.kelompok_id, grup.nama_grup, ' .
                    'kelompok.nama_kelompok, kelompok.suara'
                )
                ->join(
                    'kelompok',
                    'kelompok.id = grup.kelompok_id',
                    'left'
                )
                ->orderBy('grup.id', 'ASC')
                ->findAll();

            // Data instansi.
            $instansiRows = $this->instansiModel
                ->select('id, grup_id, nama_instansi, logo')
                ->orderBy('nama_instansi', 'ASC')
                ->findAll();

            // Kelompokkan instansi berdasarkan grup.
            $instansiPerGrup = [];

            foreach ($instansiRows as $instansi) {
                $grupId = (int) $instansi['grup_id'];

                $instansiPerGrup[$grupId][] = $instansi;
            }

            // Siapkan data grup untuk view.
            $dataGrup = [];

            foreach ($grupRows as $grup) {
                $grupId = (int) $grup['id'];

                $daftarInstansiGrup =
                    $instansiPerGrup[$grupId] ?? [];

                $jalurSuara = (int) ($grup['suara'] ?? 1);

                $dataGrup[] = [
                    'id'              => $grupId,
                    'nama'            => $grup['nama_grup'],
                    'nama_grup'       => $grup['nama_grup'],
                    'kelompok_id'     => (int) $grup['kelompok_id'],
                    'nama_kelompok'   => $grup['nama_kelompok'] ?? '',
                    'suara'           => $jalurSuara,
                    'label_suara'     => 'Kelompok ' . $jalurSuara,
                    'instansi'        => array_column(
                        $daftarInstansiGrup,
                        'nama_instansi'
                    ),
                    'daftar_instansi' => $daftarInstansiGrup,
                ];
            }

            return view('admin/pengaturan_kelompok', [
                'title'          => 'Pengaturan Kelompok',
                'activeMenu'     => 'pengaturan-kelompok',

                // Data grup untuk tabel yang sudah ada.
                'kelompok'       => $dataGrup,

                // Data kelompok induk untuk pilihan jalur suara.
                'daftarKelompok' => $kelompokRows,

                // Alias data grup.
                'daftarGrup'     => $dataGrup,

                // Daftar nama instansi.
                'daftarInstansi' => array_column(
                    $instansiRows,
                    'nama_instansi'
                ),

                'totalKelompok'  => count($dataGrup),
                'totalInstansi'  => count($instansiRows),
            ]);

        } catch (\Throwable $e) {
            log_message(
                'error',
                'AdminKelompok halaman: {message}',
                ['message' => $e->getMessage()]
            );

            if (ENVIRONMENT === 'development') {
                return $this->response
                    ->setStatusCode(500)
                    ->setBody(
                        '<h3>Gagal memuat pengaturan kelompok</h3><pre>' .
                        esc($e->getMessage()) .
                        '</pre>'
                    );
            }

            return $this->response
                ->setStatusCode(500)
                ->setBody(
                    'Gagal memuat halaman pengaturan kelompok. ' .
                    'Periksa writable/logs untuk detail error.'
                );
        }
    }

    /**
     * GET /kelompok
     *
     * Mengambil kelompok beserta jumlah grup.
     */
    public function index(): ResponseInterface
    {
        try {
            $kelompok = $this->kelompokModel
                ->select(
                    'kelompok.id, kelompok.nama_kelompok, ' .
                    'kelompok.suara, kelompok.created_at, ' .
                    'kelompok.updated_at'
                )
                ->orderBy('kelompok.id', 'ASC')
                ->findAll();

            foreach ($kelompok as &$item) {
                $item['jumlah_grup'] = $this->grupModel
                    ->where('kelompok_id', $item['id'])
                    ->countAllResults();
            }

            unset($item);

            return $this->response->setJSON([
                'status' => true,
                'data' => $kelompok,
            ]);
        } catch (Throwable $e) {
            log_message(
                'error',
                'AdminKelompok index: {message}',
                ['message' => $e->getMessage()]
            );

            return $this->response
                ->setStatusCode(500)
                ->setJSON([
                    'status' => false,
                    'message' => 'Gagal mengambil data kelompok.',
                ]);
        }
    }

    /**
     * POST /kelompok
     *
     * JSON:
     * {
     *   "nama_kelompok": "Kelompok Instansi A",
     *   "suara": 1
     * }
     */
    public function create(): ResponseInterface
    {
        $input = $this->jsonInput();

        if ($input === null) {
            return $this->response
                ->setStatusCode(400)
                ->setJSON([
                    'status' => false,
                    'message' => 'Request JSON tidak valid.',
                ]);
        }

        $nama = trim((string) ($input['nama_kelompok'] ?? ''));

        if ($nama === '') {
            return $this->response
                ->setStatusCode(400)
                ->setJSON([
                    'status' => false,
                    'message' => 'Nama kelompok wajib diisi.',
                ]);
        }

        $suara = filter_var(
            $input['suara'] ?? null,
            FILTER_VALIDATE_INT
        );

        if (
            $suara === false ||
            !in_array($suara, [1, 2], true)
        ) {
            return $this->response
                ->setStatusCode(400)
                ->setJSON([
                    'status' => false,
                    'message' => 'Jalur suara harus bernilai 1 atau 2.',
                ]);
        }

        $existing = $this->kelompokModel
            ->where('nama_kelompok', $nama)
            ->first();

        if ($existing) {
            return $this->response
                ->setStatusCode(409)
                ->setJSON([
                    'status' => false,
                    'message' => 'Nama kelompok sudah digunakan.',
                ]);
        }

        try {
            $id = $this->kelompokModel->insert([
                'nama_kelompok' => $nama,
                'suara' => $suara,
            ], true);

            if (!$id) {
                throw new RuntimeException(
                    'Insert kelompok gagal.'
                );
            }

            return $this->response
                ->setStatusCode(201)
                ->setJSON([
                    'status' => true,
                    'message' => 'Kelompok berhasil ditambahkan.',
                    'data' => [
                        'id' => (int) $id,
                        'nama_kelompok' => $nama,
                        'suara' => $suara,
                    ],
                ]);
        } catch (Throwable $e) {
            log_message(
                'error',
                'AdminKelompok create: {message}',
                ['message' => $e->getMessage()]
            );

            return $this->response
                ->setStatusCode(500)
                ->setJSON([
                    'status' => false,
                    'message' => 'Gagal menambahkan kelompok.',
                ]);
        }
    }

    /**
     * PUT /kelompok/{id}
     */
    public function update($id): ResponseInterface
    {
        $id = filter_var($id, FILTER_VALIDATE_INT);

        if ($id === false || $id < 1) {
            return $this->response
                ->setStatusCode(400)
                ->setJSON([
                    'status' => false,
                    'message' => 'ID kelompok tidak valid.',
                ]);
        }

        $kelompok = $this->kelompokModel->find($id);

        if (!$kelompok) {
            return $this->response
                ->setStatusCode(404)
                ->setJSON([
                    'status' => false,
                    'message' => 'Kelompok tidak ditemukan.',
                ]);
        }

        $input = $this->jsonInput();

        if ($input === null) {
            return $this->response
                ->setStatusCode(400)
                ->setJSON([
                    'status' => false,
                    'message' => 'Request JSON tidak valid.',
                ]);
        }

        $data = [];

        if (array_key_exists('nama_kelompok', $input)) {
            $nama = trim((string) $input['nama_kelompok']);

            if ($nama === '') {
                return $this->response
                    ->setStatusCode(400)
                    ->setJSON([
                        'status' => false,
                        'message' => 'Nama kelompok tidak boleh kosong.',
                    ]);
            }

            $existing = $this->kelompokModel
                ->where('nama_kelompok', $nama)
                ->where('id !=', $id)
                ->first();

            if ($existing) {
                return $this->response
                    ->setStatusCode(409)
                    ->setJSON([
                        'status' => false,
                        'message' => 'Nama kelompok sudah digunakan.',
                    ]);
            }

            $data['nama_kelompok'] = $nama;
        }

        if (array_key_exists('suara', $input)) {
            $suara = filter_var(
                $input['suara'],
                FILTER_VALIDATE_INT
            );

            if (
                $suara === false ||
                !in_array($suara, [1, 2], true)
            ) {
                return $this->response
                    ->setStatusCode(400)
                    ->setJSON([
                        'status' => false,
                        'message' => 'Jalur suara harus bernilai 1 atau 2.',
                    ]);
            }

            $data['suara'] = $suara;
        }

        if (empty($data)) {
            return $this->response
                ->setStatusCode(400)
                ->setJSON([
                    'status' => false,
                    'message' => 'Tidak ada data yang diubah.',
                ]);
        }

        try {
            if (!$this->kelompokModel->update($id, $data)) {
                return $this->response
                    ->setStatusCode(500)
                    ->setJSON([
                        'status' => false,
                        'message' => 'Gagal memperbarui kelompok.',
                    ]);
            }

            return $this->response->setJSON([
                'status' => true,
                'message' => 'Kelompok berhasil diperbarui.',
            ]);
        } catch (Throwable $e) {
            log_message(
                'error',
                'AdminKelompok update: {message}',
                ['message' => $e->getMessage()]
            );

            return $this->response
                ->setStatusCode(500)
                ->setJSON([
                    'status' => false,
                    'message' => 'Gagal memperbarui kelompok.',
                ]);
        }
    }

    /**
     * DELETE /kelompok/{id}
     *
     * Kelompok tidak dapat dihapus jika masih memiliki grup.
     */
    public function delete($id): ResponseInterface
    {
        $id = filter_var($id, FILTER_VALIDATE_INT);

        if ($id === false || $id < 1) {
            return $this->response
                ->setStatusCode(400)
                ->setJSON([
                    'status' => false,
                    'message' => 'ID kelompok tidak valid.',
                ]);
        }

        $kelompok = $this->kelompokModel->find($id);

        if (!$kelompok) {
            return $this->response
                ->setStatusCode(404)
                ->setJSON([
                    'status' => false,
                    'message' => 'Kelompok tidak ditemukan.',
                ]);
        }

        try {
            $jumlahGrup = $this->grupModel
                ->where('kelompok_id', $id)
                ->countAllResults();

            if ($jumlahGrup > 0) {
                return $this->response
                    ->setStatusCode(409)
                    ->setJSON([
                        'status' => false,
                        'message' =>
                            'Kelompok tidak dapat dihapus karena masih memiliki grup.',
                        'jumlah_grup' => $jumlahGrup,
                    ]);
            }

            if (!$this->kelompokModel->delete($id)) {
                return $this->response
                    ->setStatusCode(500)
                    ->setJSON([
                        'status' => false,
                        'message' => 'Gagal menghapus kelompok.',
                    ]);
            }

            return $this->response->setJSON([
                'status' => true,
                'message' => 'Kelompok berhasil dihapus.',
            ]);
        } catch (Throwable $e) {
            log_message(
                'error',
                'AdminKelompok delete: {message}',
                ['message' => $e->getMessage()]
            );

            return $this->response
                ->setStatusCode(500)
                ->setJSON([
                    'status' => false,
                    'message' => 'Gagal menghapus kelompok.',
                ]);
        }
    }
}