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
        $this->sinkronkanAudioInstansi();
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
                'instansi.audio_nama',
                'instansi.status',
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
                'instansi.audio_nama',
                'instansi.status',
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

            // Hapus file audio milik instansi jika ada.
            if (!empty($instansi['audio_nama'])) {
                $audioPath = FCPATH . 'audio/instansi/' . basename($instansi['audio_nama']);
                if (is_file($audioPath)) {
                    @unlink($audioPath);
                }
            }

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

    /**
     * POST /admin/instansi/{id}/audio
     * Upload atau mengganti rekaman nama instansi.
     */
    public function uploadAudio($id)
    {
        $id = (int) $id;
        $instansi = $this->instansiModel->find($id);

        if ($id < 1 || !$instansi) {
            return $this->response->setStatusCode(404)->setJSON([
                'status' => false,
                'message' => 'Instansi tidak ditemukan.',
            ]);
        }

        $file = $this->request->getFile('audio');

        if (!$file || !$file->isValid() || $file->hasMoved()) {
            return $this->response->setStatusCode(400)->setJSON([
                'status' => false,
                'message' => 'File audio belum dipilih atau gagal diunggah.',
            ]);
        }

        if ($file->getSizeByUnit('mb') > 10) {
            return $this->response->setStatusCode(400)->setJSON([
                'status' => false,
                'message' => 'Ukuran audio maksimal 10 MB.',
            ]);
        }

        $allowed = [
            'mp3' => ['audio/mpeg', 'audio/mp3', 'audio/mpeg3', 'audio/x-mpeg-3'],
            'wav' => ['audio/wav', 'audio/x-wav', 'audio/wave', 'audio/vnd.wave'],
            'ogg' => ['audio/ogg', 'application/ogg'],
        ];

        $extension = strtolower($file->getExtension());
        $mime = strtolower((string) $file->getMimeType());

        if (
            !isset($allowed[$extension]) ||
            !in_array($mime, $allowed[$extension], true)
        ) {
            return $this->response->setStatusCode(400)->setJSON([
                'status' => false,
                'message' => 'Format audio harus MP3, WAV, atau OGG.',
            ]);
        }

        $directory = FCPATH . 'audio/instansi';

        if (
            !is_dir($directory) &&
            !mkdir($directory, 0755, true) &&
            !is_dir($directory)
        ) {
            return $this->response->setStatusCode(500)->setJSON([
                'status' => false,
                'message' => 'Folder audio tidak dapat dibuat.',
            ]);
        }

        /*
        * Nama file mengikuti nama instansi.
        * Contoh: BANK BANTEN.mp3
        */
        $namaFile = trim($instansi['nama_instansi']);

        // Hilangkan karakter yang tidak aman untuk nama file.
        $namaFile = preg_replace('/[^\pL\pN _-]/u', '', $namaFile);
        $namaFile = trim($namaFile, " ._-");

        if ($namaFile === '') {
            $namaFile = 'instansi_' . $id;
        }

        $newName = $namaFile . '.' . $extension;

        // File sementara agar file lama tidak langsung hilang.
        $tempName = 'upload_' . $id . '_' . bin2hex(random_bytes(8)) . '.' . $extension;
        $tempPath = $directory . DIRECTORY_SEPARATOR . $tempName;
        $targetPath = $directory . DIRECTORY_SEPARATOR . $newName;

        try {
            $file->move($directory, $tempName);

            if (!is_file($tempPath)) {
                throw new \RuntimeException('File sementara gagal disimpan.');
            }

            /*
            * Hapus file lama milik instansi jika berbeda dari target.
            * File hanya dihapus dari folder audio/instansi.
            */
            $oldName = basename((string) ($instansi['audio_nama'] ?? ''));
            $oldPath = $directory . DIRECTORY_SEPARATOR . $oldName;

            if (
                $oldName !== '' &&
                $oldName !== $newName &&
                is_file($oldPath)
            ) {
                if (!unlink($oldPath)) {
                    throw new \RuntimeException('File audio lama gagal dihapus.');
                }
            }

            // Jika nama target sudah ada, ganti dengan file baru.
            if (is_file($targetPath) && $tempPath !== $targetPath) {
                if (!unlink($targetPath)) {
                    throw new \RuntimeException('File audio lama gagal diganti.');
                }
            }

            if (!rename($tempPath, $targetPath)) {
                throw new \RuntimeException('File audio baru gagal dipindahkan.');
            }

            // Simpan nama file yang baru ke database.
            if (!$this->instansiModel->update($id, [
                'audio_nama' => $newName,
            ])) {
                throw new \RuntimeException('Gagal menyimpan nama audio ke database.');
            }

            return $this->response->setJSON([
                'status' => true,
                'message' => 'Audio instansi berhasil disimpan.',
                'audio_nama' => $newName,
                'audio_url' => base_url(
                    'audio/instansi/' . rawurlencode($newName)
                ),
            ]);

        } catch (Throwable $e) {
            if (is_file($tempPath)) {
                @unlink($tempPath);
            }

            log_message('error', 'Gagal upload audio instansi: {error}', [
                'error' => $e->getMessage(),
            ]);

            return $this->response->setStatusCode(500)->setJSON([
                'status' => false,
                'message' => 'Gagal menyimpan audio instansi.',
            ]);
        }
    }

    /**
     * GET /admin/instansi/{id}/audio/download
     * Mengunduh rekaman nama instansi.
     */
    public function downloadAudio($id)
    {
        $id = (int) $id;
        $instansi = $this->instansiModel->find($id);

        if ($id < 1 || !$instansi) {
            return $this->response->setStatusCode(404)->setJSON([
                'status' => false,
                'message' => 'Instansi tidak ditemukan.',
            ]);
        }

        if (empty($instansi['audio_nama'])) {
            return $this->response->setStatusCode(404)->setJSON([
                'status' => false,
                'message' => 'Instansi belum memiliki audio.',
            ]);
        }

        $namaFile = basename($instansi['audio_nama']);
        $path = FCPATH . 'audio/instansi/' . $namaFile;

        if (!is_file($path)) {
            return $this->response->setStatusCode(404)->setJSON([
                'status' => false,
                'message' => 'File audio tidak ditemukan.',
            ]);
        }

        return $this->response
            ->download($path, null)
            ->setFileName($namaFile);
    }

    /**
     * Normalisasi nama untuk pencocokan file audio.
     * Mengabaikan huruf besar/kecil dan spasi.
     */
    private function normalisasiNamaAudio(string $nama): string
    {
        $nama = trim($nama);

        // Hanya hapus ekstensi audio yang benar-benar dikenal.
        $nama = preg_replace('/\.(mp3|wav|ogg)$/i', '', $nama);

        // Samakan huruf besar dan kecil.
        $nama = mb_strtolower($nama, 'UTF-8');

        // Hilangkan titik, spasi, strip, underscore, dan pemisah lainnya.
        $nama = preg_replace('/[^\p{L}\p{N}]/u', '', $nama);

        return $nama;
    }

    /**
     * Sinkronisasi file audio dengan data instansi.
     */
    private function sinkronkanAudioInstansi(): void
    {
        $folder = FCPATH . 'audio/instansi';

        if (!is_dir($folder)) {
            return;
        }

        $files = glob($folder . '/*');

        if ($files === false) {
            return;
        }

        $daftarAudio = [];

        foreach ($files as $file) {
            if (!is_file($file)) {
                continue;
            }

            $extension = strtolower(pathinfo($file, PATHINFO_EXTENSION));

            if (!in_array($extension, ['mp3', 'wav', 'ogg'], true)) {
                continue;
            }

            $namaFile = basename($file);
            $key = $this->normalisasiNamaAudio($namaFile);

            if ($key === '') {
                continue;
            }

            // Tandai jika ada lebih dari satu file dengan nama setara.
            if (array_key_exists($key, $daftarAudio)) {
                $daftarAudio[$key] = null;
            } else {
                $daftarAudio[$key] = $namaFile;
            }
        }

        $instansi = $this->instansiModel->findAll();

        foreach ($instansi as $item) {
            $key = $this->normalisasiNamaAudio(
                $item['nama_instansi']
            );

            $namaAudio = $daftarAudio[$key] ?? null;

            // Lewati jika tidak ditemukan atau nama file ambigu.
            if ($namaAudio === null) {
                continue;
            }

            $pathAudio = $folder . DIRECTORY_SEPARATOR . $namaAudio;

            if (!is_file($pathAudio)) {
                continue;
            }

            // Jika nama file yang cocok sudah terdaftar, tidak perlu update.
            if (($item['audio_nama'] ?? '') === $namaAudio) {
                continue;
            }

            // Daftarkan file yang cocok ke database.
            $this->instansiModel->update($item['id'], [
                'audio_nama' => $namaAudio,
            ]);
        }
    }
}