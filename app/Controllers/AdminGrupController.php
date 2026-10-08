<?php

namespace App\Controllers;

use App\Models\GrupModel;
use App\Models\InstansiModel;
use App\Models\KelompokModel;
use CodeIgniter\HTTP\ResponseInterface;

class AdminGrupController extends BaseController
{
    protected GrupModel $grupModel;
    protected KelompokModel $kelompokModel;
    protected InstansiModel $instansiModel;

    public function __construct()
    {
        $this->grupModel = new GrupModel();
        $this->kelompokModel = new KelompokModel();
        $this->instansiModel = new InstansiModel();
    }

    /**
     * GET /admin/grup
     *
     * Menampilkan seluruh grup.
     */
    public function index(): ResponseInterface
    {
        $grup = $this->grupModel
            ->select('id, kelompok_id, nama_grup, created_at, updated_at')
            ->findAll();

        return $this->response
            ->setStatusCode(200)
            ->setJSON([
                'status' => true,
                'data'   => $grup,
            ]);
    }

    /**
     * POST /admin/grup
     *
     * Menambahkan grup baru.
     *
     * Request body:
     * {
     *     "nama_grup": "Grup Bapenda",
     *     "kelompok_id": 1
     * }
     */
    public function create(): ResponseInterface
    {
        // Ambil data dari raw JSON
        $input = $this->request->getJSON(true);

        // Pastikan JSON valid
        if (!is_array($input)) {
            return $this->response
                ->setStatusCode(400)
                ->setJSON([
                    'status'  => false,
                    'message' => 'Format JSON tidak valid.',
                ]);
        }

        $namaGrup   = trim((string) ($input['nama_grup'] ?? ''));
        $kelompokId = $input['kelompok_id'] ?? null;

        // Validasi input wajib
        if (
            $namaGrup === '' ||
            $kelompokId === null ||
            $kelompokId === ''
        ) {
            return $this->response
                ->setStatusCode(400)
                ->setJSON([
                    'status'  => false,
                    'message' => 'Nama grup dan kelompok wajib diisi.',
                ]);
        }

        // Pastikan kelompok ID valid
        if (!is_numeric($kelompokId) || (int) $kelompokId <= 0) {
            return $this->response
                ->setStatusCode(400)
                ->setJSON([
                    'status'  => false,
                    'message' => 'kelompok_id tidak valid.',
                ]);
        }

        $kelompokId = (int) $kelompokId;

        // Validasi kelompok harus ada
        if (!$this->kelompokModel->find($kelompokId)) {
            return $this->response
                ->setStatusCode(404)
                ->setJSON([
                    'status'  => false,
                    'message' => 'Kelompok tidak ditemukan.',
                ]);
        }

        // Nama grup unik di dalam kelompok yang sama
        $existing = $this->grupModel
            ->where('kelompok_id', $kelompokId)
            ->where('nama_grup', $namaGrup)
            ->first();

        if ($existing) {
            return $this->response
                ->setStatusCode(409)
                ->setJSON([
                    'status'  => false,
                    'message' => 'Nama grup sudah digunakan dalam kelompok tersebut.',
                ]);
        }

        // Simpan grup
        $this->grupModel->insert([
            'kelompok_id' => $kelompokId,
            'nama_grup'   => $namaGrup,
        ]);

        return $this->response
            ->setStatusCode(201)
            ->setJSON([
                'status'  => true,
                'message' => 'Grup berhasil ditambahkan.',
                'id'      => $this->grupModel->getInsertID(),
            ]);
    }

    /**
     * PUT /admin/grup/{id}
     *
     * Mengubah data grup.
     *
     * Request body:
     * {
     *     "nama_grup": "Grup Bapenda Baru",
     *     "kelompok_id": 2
     * }
     *
     * Semua field bersifat opsional.
     */
    public function update($id): ResponseInterface
    {
        // Pastikan ID valid
        if (!is_numeric($id) || (int) $id <= 0) {
            return $this->response
                ->setStatusCode(400)
                ->setJSON([
                    'status'  => false,
                    'message' => 'ID grup tidak valid.',
                ]);
        }

        $id = (int) $id;

        // Cari grup
        $grup = $this->grupModel->find($id);

        if (!$grup) {
            return $this->response
                ->setStatusCode(404)
                ->setJSON([
                    'status'  => false,
                    'message' => 'Grup tidak ditemukan.',
                ]);
        }

        // Ambil data dari raw JSON
        $input = $this->request->getJSON(true);

        // Pastikan JSON valid
        if (!is_array($input)) {
            return $this->response
                ->setStatusCode(400)
                ->setJSON([
                    'status'  => false,
                    'message' => 'Format JSON tidak valid.',
                ]);
        }

        $data = [];

        $namaGrup   = $input['nama_grup'] ?? null;
        $kelompokId = $input['kelompok_id'] ?? null;

        // Jika kelompok tidak dikirim,
        // gunakan kelompok saat ini
        $targetKelompokId = $kelompokId !== null
            ? $kelompokId
            : (int) $grup['kelompok_id'];

        // Validasi kelompok ID jika dikirim
        if ($kelompokId !== null) {
            if (
                !is_numeric($kelompokId) ||
                (int) $kelompokId <= 0
            ) {
                return $this->response
                    ->setStatusCode(400)
                    ->setJSON([
                        'status'  => false,
                        'message' => 'kelompok_id tidak valid.',
                    ]);
            }

            $targetKelompokId = (int) $kelompokId;

            // Pastikan kelompok ada
            if (!$this->kelompokModel->find($targetKelompokId)) {
                return $this->response
                    ->setStatusCode(404)
                    ->setJSON([
                        'status'  => false,
                        'message' => 'Kelompok tidak ditemukan.',
                    ]);
            }
        }

        // Update nama grup
        if ($namaGrup !== null) {
            $namaGrup = trim((string) $namaGrup);

            if ($namaGrup === '') {
                return $this->response
                    ->setStatusCode(400)
                    ->setJSON([
                        'status'  => false,
                        'message' => 'Nama grup tidak boleh kosong.',
                    ]);
            }

            // Cek nama grup agar tidak bentrok
            $existing = $this->grupModel
                ->where('kelompok_id', $targetKelompokId)
                ->where('nama_grup', $namaGrup)
                ->where('id !=', $id)
                ->first();

            if ($existing) {
                return $this->response
                    ->setStatusCode(409)
                    ->setJSON([
                        'status'  => false,
                        'message' => 'Nama grup sudah digunakan dalam kelompok tersebut.',
                    ]);
            }

            $data['nama_grup'] = $namaGrup;
        }

        // Update kelompok
        if ($kelompokId !== null) {
            $data['kelompok_id'] = $targetKelompokId;

            // Jika kelompok berubah tetapi nama tidak dikirim,
            // cek apakah nama lama bentrok di kelompok baru.
            if ($namaGrup === null) {
                $existing = $this->grupModel
                    ->where('kelompok_id', $targetKelompokId)
                    ->where('nama_grup', $grup['nama_grup'])
                    ->where('id !=', $id)
                    ->first();

                if ($existing) {
                    return $this->response
                        ->setStatusCode(409)
                        ->setJSON([
                            'status'  => false,
                            'message' => 'Nama grup sudah digunakan dalam kelompok tersebut.',
                        ]);
                }
            }
        }

        // Tidak ada data yang diubah
        if (empty($data)) {
            return $this->response
                ->setStatusCode(400)
                ->setJSON([
                    'status'  => false,
                    'message' => 'Tidak ada data yang diubah.',
                ]);
        }

        // Update database
        $this->grupModel->update($id, $data);

        return $this->response
            ->setStatusCode(200)
            ->setJSON([
                'status'  => true,
                'message' => 'Grup berhasil diperbarui.',
            ]);
    }

    /**
     * DELETE /admin/grup/{id}
     *
     * Menghapus grup.
     */
    public function delete($id): ResponseInterface
    {
        // Pastikan ID valid
        if (!is_numeric($id) || (int) $id <= 0) {
            return $this->response
                ->setStatusCode(400)
                ->setJSON([
                    'status'  => false,
                    'message' => 'ID grup tidak valid.',
                ]);
        }

        $id = (int) $id;

        // Cari grup
        $grup = $this->grupModel->find($id);

        if (!$grup) {
            return $this->response
                ->setStatusCode(404)
                ->setJSON([
                    'status'  => false,
                    'message' => 'Grup tidak ditemukan.',
                ]);
        }

        // Grup tidak boleh dihapus jika masih memiliki instansi
        $jumlahInstansi = $this->instansiModel
            ->where('grup_id', $id)
            ->countAllResults();

        if ($jumlahInstansi > 0) {
            return $this->response
                ->setStatusCode(409)
                ->setJSON([
                    'status'          => false,
                    'message'         => 'Grup tidak dapat dihapus karena masih memiliki instansi.',
                    'jumlah_instansi' => $jumlahInstansi,
                ]);
        }

        // Hapus grup
        $this->grupModel->delete($id);

        return $this->response
            ->setStatusCode(200)
            ->setJSON([
                'status'  => true,
                'message' => 'Grup berhasil dihapus.',
            ]);
    }
}