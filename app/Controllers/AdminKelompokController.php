<?php

namespace App\Controllers;

use App\Models\KelompokModel;

class AdminKelompokController extends BaseController
{
    protected KelompokModel $kelompokModel;

    public function __construct()
    {
        $this->kelompokModel = new KelompokModel();
    }

    /**
     * GET /admin/pengaturan-kelompok
     * Menampilkan halaman frontend pengaturan kelompok.
     */
    public function halaman()
    {
        return view('admin/pengaturan_kelompok', [
            'activeMenu' => 'pengaturan-kelompok',
        ]);
    }

    /**
     * GET /admin/kelompok
     * Mengambil seluruh data kelompok dalam format JSON.
     */
    public function index()
    {
        $kelompok = $this->kelompokModel
            ->select('id, nama_kelompok, created_at, updated_at')
            ->orderBy('id', 'ASC')
            ->findAll();

        return $this->response->setJSON([
            'status' => true,
            'data'   => $kelompok,
        ]);
    }

    /**
     * POST /admin/kelompok
     * Body JSON: {"nama_kelompok": "Kelompok Utama"}
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

        $namaKelompok = trim(
            (string) ($input['nama_kelompok'] ?? '')
        );

        if ($namaKelompok === '') {
            return $this->response
                ->setStatusCode(400)
                ->setJSON([
                    'status'  => false,
                    'message' => 'Nama kelompok wajib diisi.',
                ]);
        }

        $existing = $this->kelompokModel
            ->where('nama_kelompok', $namaKelompok)
            ->first();

        if ($existing) {
            return $this->response
                ->setStatusCode(409)
                ->setJSON([
                    'status'  => false,
                    'message' => 'Nama kelompok sudah digunakan.',
                ]);
        }

        $id = $this->kelompokModel->insert([
            'nama_kelompok' => $namaKelompok,
        ], true);

        if ($id === false) {
            return $this->response
                ->setStatusCode(500)
                ->setJSON([
                    'status'  => false,
                    'message' => 'Kelompok gagal ditambahkan.',
                    'errors'  => $this->kelompokModel->errors(),
                ]);
        }

        return $this->response
            ->setStatusCode(201)
            ->setJSON([
                'status'  => true,
                'message' => 'Kelompok berhasil ditambahkan.',
                'id'      => $id,
            ]);
    }

    /**
     * PUT /admin/kelompok/{id}
     * Body JSON: {"nama_kelompok": "Kelompok Utama"}
     */
    public function update($id)
    {
        if (!ctype_digit((string) $id) || (int) $id < 1) {
            return $this->response
                ->setStatusCode(400)
                ->setJSON([
                    'status'  => false,
                    'message' => 'ID kelompok tidak valid.',
                ]);
        }

        $id = (int) $id;
        $kelompok = $this->kelompokModel->find($id);

        if (!$kelompok) {
            return $this->response
                ->setStatusCode(404)
                ->setJSON([
                    'status'  => false,
                    'message' => 'Kelompok tidak ditemukan.',
                ]);
        }

        $input = $this->request->getJSON(true);

        if (!is_array($input)) {
            return $this->response
                ->setStatusCode(400)
                ->setJSON([
                    'status'  => false,
                    'message' => 'Format JSON tidak valid.',
                ]);
        }

        $namaKelompok = trim(
            (string) ($input['nama_kelompok'] ?? '')
        );

        if ($namaKelompok === '') {
            return $this->response
                ->setStatusCode(400)
                ->setJSON([
                    'status'  => false,
                    'message' => 'Nama kelompok wajib diisi.',
                ]);
        }

        $existing = $this->kelompokModel
            ->where('nama_kelompok', $namaKelompok)
            ->where('id !=', $id)
            ->first();

        if ($existing) {
            return $this->response
                ->setStatusCode(409)
                ->setJSON([
                    'status'  => false,
                    'message' => 'Nama kelompok sudah digunakan.',
                ]);
        }

        $updated = $this->kelompokModel->update($id, [
            'nama_kelompok' => $namaKelompok,
        ]);

        if (!$updated) {
            return $this->response
                ->setStatusCode(500)
                ->setJSON([
                    'status'  => false,
                    'message' => 'Kelompok gagal diperbarui.',
                    'errors'  => $this->kelompokModel->errors(),
                ]);
        }

        return $this->response->setJSON([
            'status'  => true,
            'message' => 'Kelompok berhasil diperbarui.',
        ]);
    }

    /**
     * DELETE /admin/kelompok/{id}
     */
    public function delete($id)
    {
        if (!ctype_digit((string) $id) || (int) $id < 1) {
            return $this->response
                ->setStatusCode(400)
                ->setJSON([
                    'status'  => false,
                    'message' => 'ID kelompok tidak valid.',
                ]);
        }

        $id = (int) $id;
        $kelompok = $this->kelompokModel->find($id);

        if (!$kelompok) {
            return $this->response
                ->setStatusCode(404)
                ->setJSON([
                    'status'  => false,
                    'message' => 'Kelompok tidak ditemukan.',
                ]);
        }

        $deleted = $this->kelompokModel->delete($id);

        if (!$deleted) {
            return $this->response
                ->setStatusCode(500)
                ->setJSON([
                    'status'  => false,
                    'message' => 'Kelompok gagal dihapus.',
                ]);
        }

        return $this->response->setJSON([
            'status'  => true,
            'message' => 'Kelompok berhasil dihapus.',
        ]);
    }
}