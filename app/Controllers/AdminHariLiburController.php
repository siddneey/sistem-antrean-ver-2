<?php

namespace App\Controllers;

use App\Models\HariLiburModel;

class AdminHariLiburController extends BaseController
{
    protected HariLiburModel $hariLiburModel;

    public function __construct()
    {
        $this->hariLiburModel = new HariLiburModel();
    }

    /**
     * ============================================================
     * HALAMAN PENGATURAN HARI LIBUR
     * ============================================================
     *
     * GET /admin/pengaturan-hari-libur
     *
     * Menampilkan frontend pengaturan hari libur.
     */
    public function halaman()
    {
        return view('admin/pengaturan_hari_libur', [
            'title'      => 'Pengaturan Hari Libur',
            'activeMenu' => 'pengaturan-hari-libur',
        ]);
    }

    /**
     * ============================================================
     * AMBIL DAFTAR HARI LIBUR
     * ============================================================
     *
     * GET /admin/hari-libur
     */
    public function index()
    {
        try {
            $hariLibur = $this->hariLiburModel
                ->select(
                    'id, tanggal, nama, jenis, keterangan, created_at, updated_at'
                )
                ->orderBy('tanggal', 'ASC')
                ->findAll();

            return $this->response->setJSON([
                'status' => true,
                'data'   => $hariLibur,
            ]);

        } catch (\Throwable $e) {
            log_message(
                'error',
                'AdminHariLiburController::index | ' . $e->getMessage()
            );

            return $this->response
                ->setStatusCode(500)
                ->setJSON([
                    'status'  => false,
                    'message' => 'Gagal mengambil data hari libur.',
                ]);
        }
    }

    /**
     * ============================================================
     * TAMBAH HARI LIBUR
     * ============================================================
     *
     * POST /admin/hari-libur
     *
     * Body JSON:
     * {
     *     "tanggal": "2026-08-17",
     *     "nama": "Hari Kemerdekaan Republik Indonesia",
     *     "jenis": "Nasional",
     *     "keterangan": "Libur nasional"
     * }
     */
    public function create()
    {
        $input = $this->request->getJSON(true);

        if (!is_array($input)) {
            return $this->response
                ->setStatusCode(400)
                ->setJSON([
                    'status'  => false,
                    'message' => 'Format JSON tidak valid.',
                ]);
        }

        // --------------------------------------------------------
        // Ambil data dari request
        // --------------------------------------------------------
        $tanggal = trim((string) ($input['tanggal'] ?? ''));
        $nama = trim((string) ($input['nama'] ?? ''));
        $jenis = trim((string) ($input['jenis'] ?? ''));
        $keterangan = trim((string) ($input['keterangan'] ?? ''));

        // --------------------------------------------------------
        // Validasi input
        // --------------------------------------------------------
        $pesanValidasi = $this->validasiData(
            $tanggal,
            $nama,
            $jenis,
            $keterangan
        );

        if ($pesanValidasi !== null) {
            return $this->response
                ->setStatusCode(400)
                ->setJSON([
                    'status'  => false,
                    'message' => $pesanValidasi,
                ]);
        }

        try {
            // ----------------------------------------------------
            // Cek apakah tanggal sudah terdaftar
            // ----------------------------------------------------
            $existing = $this->hariLiburModel
                ->where('tanggal', $tanggal)
                ->first();

            if ($existing) {
                return $this->response
                    ->setStatusCode(409)
                    ->setJSON([
                        'status'  => false,
                        'message' => 'Tanggal tersebut sudah terdaftar sebagai hari libur.',
                    ]);
            }

            // ----------------------------------------------------
            // Simpan ke database
            // ----------------------------------------------------
            $berhasil = $this->hariLiburModel->insert([
                'tanggal'    => $tanggal,
                'nama'       => $nama,
                'jenis'      => $jenis,
                'keterangan' => $keterangan !== '' ? $keterangan : null,
            ]);

            if ($berhasil === false) {
                return $this->response
                    ->setStatusCode(422)
                    ->setJSON([
                        'status'  => false,
                        'message' => 'Data hari libur gagal divalidasi atau disimpan.',
                        'errors'  => $this->hariLiburModel->errors(),
                    ]);
            }

            return $this->response
                ->setStatusCode(201)
                ->setJSON([
                    'status'  => true,
                    'message' => 'Hari libur berhasil ditambahkan.',
                    'id'      => $this->hariLiburModel->getInsertID(),
                ]);

        } catch (\Throwable $e) {
            log_message(
                'error',
                'AdminHariLiburController::create | ' . $e->getMessage()
            );

            return $this->response
                ->setStatusCode(500)
                ->setJSON([
                    'status'  => false,
                    'message' => 'Gagal menambahkan hari libur.',
                ]);
        }
    }

    /**
     * ============================================================
     * EDIT HARI LIBUR
     * ============================================================
     *
     * PUT /admin/hari-libur/{id}
     *
     * Body JSON:
     * {
     *     "tanggal": "2026-12-31",
     *     "nama": "Penutupan Layanan Akhir Tahun",
     *     "jenis": "Khusus MPP",
     *     "keterangan": "Penyesuaian operasional layanan MPP"
     * }
     */
    public function update($id)
    {
        // --------------------------------------------------------
        // Validasi ID
        // --------------------------------------------------------
        if (
            filter_var(
                $id,
                FILTER_VALIDATE_INT,
                ['options' => ['min_range' => 1]]
            ) === false
        ) {
            return $this->response
                ->setStatusCode(400)
                ->setJSON([
                    'status'  => false,
                    'message' => 'ID hari libur tidak valid.',
                ]);
        }

        $id = (int) $id;

        try {
            // ----------------------------------------------------
            // Cari data yang akan diedit
            // ----------------------------------------------------
            $hariLibur = $this->hariLiburModel->find($id);

            if (!$hariLibur) {
                return $this->response
                    ->setStatusCode(404)
                    ->setJSON([
                        'status'  => false,
                        'message' => 'Hari libur tidak ditemukan.',
                    ]);
            }

            // ----------------------------------------------------
            // Ambil JSON dari request
            // ----------------------------------------------------
            $input = $this->request->getJSON(true);

            if (!is_array($input)) {
                return $this->response
                    ->setStatusCode(400)
                    ->setJSON([
                        'status'  => false,
                        'message' => 'Format JSON tidak valid.',
                    ]);
            }

            // Gunakan data lama jika field tidak dikirim.
            $tanggal = array_key_exists('tanggal', $input)
                ? trim((string) $input['tanggal'])
                : (string) $hariLibur['tanggal'];

            $nama = array_key_exists('nama', $input)
                ? trim((string) $input['nama'])
                : (string) ($hariLibur['nama'] ?? '');

            $jenis = array_key_exists('jenis', $input)
                ? trim((string) $input['jenis'])
                : (string) ($hariLibur['jenis'] ?? '');

            $keterangan = array_key_exists('keterangan', $input)
                ? trim((string) $input['keterangan'])
                : (string) ($hariLibur['keterangan'] ?? '');

            // ----------------------------------------------------
            // Validasi seluruh data
            // ----------------------------------------------------
            $pesanValidasi = $this->validasiData(
                $tanggal,
                $nama,
                $jenis,
                $keterangan
            );

            if ($pesanValidasi !== null) {
                return $this->response
                    ->setStatusCode(400)
                    ->setJSON([
                        'status'  => false,
                        'message' => $pesanValidasi,
                    ]);
            }

            // ----------------------------------------------------
            // Cek tanggal duplikat selain milik sendiri
            // ----------------------------------------------------
            $existing = $this->hariLiburModel
                ->where('tanggal', $tanggal)
                ->where('id !=', $id)
                ->first();

            if ($existing) {
                return $this->response
                    ->setStatusCode(409)
                    ->setJSON([
                        'status'  => false,
                        'message' => 'Tanggal tersebut sudah terdaftar sebagai hari libur.',
                    ]);
            }

            // ----------------------------------------------------
            // Simpan perubahan
            // ----------------------------------------------------
            $berhasil = $this->hariLiburModel->update($id, [
                'tanggal'    => $tanggal,
                'nama'       => $nama,
                'jenis'      => $jenis,
                'keterangan' => $keterangan !== '' ? $keterangan : null,
            ]);

            if ($berhasil === false) {
                return $this->response
                    ->setStatusCode(422)
                    ->setJSON([
                        'status'  => false,
                        'message' => 'Data hari libur gagal divalidasi atau diperbarui.',
                        'errors'  => $this->hariLiburModel->errors(),
                    ]);
            }

            return $this->response->setJSON([
                'status'  => true,
                'message' => 'Hari libur berhasil diperbarui.',
            ]);

        } catch (\Throwable $e) {
            log_message(
                'error',
                'AdminHariLiburController::update | ' . $e->getMessage()
            );

            return $this->response
                ->setStatusCode(500)
                ->setJSON([
                    'status'  => false,
                    'message' => 'Gagal memperbarui hari libur.',
                ]);
        }
    }

    /**
     * ============================================================
     * HAPUS HARI LIBUR
     * ============================================================
     *
     * DELETE /admin/hari-libur/{id}
     */
    public function delete($id)
    {
        // --------------------------------------------------------
        // Validasi ID
        // --------------------------------------------------------
        if (
            filter_var(
                $id,
                FILTER_VALIDATE_INT,
                ['options' => ['min_range' => 1]]
            ) === false
        ) {
            return $this->response
                ->setStatusCode(400)
                ->setJSON([
                    'status'  => false,
                    'message' => 'ID hari libur tidak valid.',
                ]);
        }

        $id = (int) $id;

        try {
            // ----------------------------------------------------
            // Pastikan data tersedia
            // ----------------------------------------------------
            $hariLibur = $this->hariLiburModel->find($id);

            if (!$hariLibur) {
                return $this->response
                    ->setStatusCode(404)
                    ->setJSON([
                        'status'  => false,
                        'message' => 'Hari libur tidak ditemukan.',
                    ]);
            }

            // ----------------------------------------------------
            // Hapus data dari database
            // ----------------------------------------------------
            $berhasil = $this->hariLiburModel->delete($id);

            if ($berhasil === false) {
                return $this->response
                    ->setStatusCode(422)
                    ->setJSON([
                        'status'  => false,
                        'message' => 'Hari libur gagal dihapus.',
                    ]);
            }

            return $this->response->setJSON([
                'status'  => true,
                'message' => 'Hari libur berhasil dihapus.',
            ]);

        } catch (\Throwable $e) {
            log_message(
                'error',
                'AdminHariLiburController::delete | ' . $e->getMessage()
            );

            return $this->response
                ->setStatusCode(500)
                ->setJSON([
                    'status'  => false,
                    'message' => 'Gagal menghapus hari libur.',
                ]);
        }
    }

    /**
     * ============================================================
     * VALIDASI DATA HARI LIBUR
     * ============================================================
     *
     * Dipakai oleh create() dan update() agar aturan validasi sama.
     *
     * Mengembalikan:
     * - null jika data valid
     * - string pesan error jika data tidak valid
     */
    protected function validasiData(
        string $tanggal,
        string $nama,
        string $jenis,
        string $keterangan
    ): ?string {
        // Tanggal wajib diisi.
        if ($tanggal === '') {
            return 'Tanggal hari libur wajib diisi.';
        }

        // Format tanggal harus YYYY-MM-DD.
        if (!$this->isValidDate($tanggal)) {
            return 'Format tanggal harus YYYY-MM-DD.';
        }

        // Nama wajib diisi, maksimal 150 karakter.
        if ($nama === '') {
            return 'Nama hari libur wajib diisi.';
        }

        if (mb_strlen($nama) > 150) {
            return 'Nama hari libur maksimal 150 karakter.';
        }

        // Jenis hanya boleh menggunakan pilihan yang tersedia.
        if (!in_array($jenis, ['Nasional', 'Khusus MPP'], true)) {
            return 'Jenis hari libur tidak valid.';
        }

        // Keterangan sesuai panjang kolom VARCHAR(255).
        if (mb_strlen($keterangan) > 255) {
            return 'Keterangan maksimal 255 karakter.';
        }

        return null;
    }

    /**
     * ============================================================
     * VALIDASI FORMAT TANGGAL
     * ============================================================
     *
     * Memastikan tanggal benar-benar valid.
     * Contoh:
     * - 2026-08-17 -> valid
     * - 2026-02-30 -> tidak valid
     */
    protected function isValidDate(string $tanggal): bool
    {
        $tanggalObj = \DateTime::createFromFormat(
            '!Y-m-d',
            $tanggal
        );

        return $tanggalObj !== false
            && $tanggalObj->format('Y-m-d') === $tanggal;
    }
}