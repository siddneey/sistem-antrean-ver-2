<?php

namespace App\Controllers;

use App\Models\InstansiModel;
use App\Models\UserModel;
use CodeIgniter\HTTP\ResponseInterface;

class AdminPetugasController extends BaseController
{
    protected UserModel $userModel;
    protected InstansiModel $instansiModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->instansiModel = new InstansiModel();
    }

    /**
     * GET /admin/petugas
     *
     * Menampilkan seluruh petugas.
     */
    public function index(): ResponseInterface
    {
        $petugas = $this->userModel
            ->where('role_id', 2)
            ->select('id, role_id, instansi_id, username, created_at, updated_at')
            ->findAll();

        return $this->response
            ->setStatusCode(200)
            ->setJSON([
                'status' => true,
                'data'   => $petugas,
            ]);
    }

    /**
     * POST /admin/petugas
     *
     * Membuat akun petugas baru.
     *
     * Request body:
     * {
     *     "username": "petugas1",
     *     "password": "123456",
     *     "instansi_id": 1
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

        $username   = trim((string) ($input['username'] ?? ''));
        $password   = (string) ($input['password'] ?? '');
        $instansiId = $input['instansi_id'] ?? null;

        // Validasi input wajib
        if (
            $username === '' ||
            $password === '' ||
            $instansiId === null ||
            $instansiId === ''
        ) {
            return $this->response
                ->setStatusCode(400)
                ->setJSON([
                    'status'  => false,
                    'message' => 'username, password, dan instansi wajib diisi.',
                ]);
        }

        // Pastikan instansi ID berupa angka
        if (!is_numeric($instansiId) || (int) $instansiId <= 0) {
            return $this->response
                ->setStatusCode(400)
                ->setJSON([
                    'status'  => false,
                    'message' => 'instansi_id tidak valid.',
                ]);
        }

        $instansiId = (int) $instansiId;

        // Validasi instansi harus ada
        if (!$this->instansiModel->find($instansiId)) {
            return $this->response
                ->setStatusCode(404)
                ->setJSON([
                    'status'  => false,
                    'message' => 'Instansi tidak ditemukan.',
                ]);
        }

        // Username tidak boleh duplikat
        if ($this->userModel->where('username', $username)->first()) {
            return $this->response
                ->setStatusCode(409)
                ->setJSON([
                    'status'  => false,
                    'message' => 'username sudah digunakan.',
                ]);
        }

        // Buat akun petugas
        $this->userModel->insert([
            'role_id'     => 2,
            'instansi_id' => $instansiId,
            'username'    => $username,
            'password'    => password_hash($password, PASSWORD_DEFAULT),
        ]);

        return $this->response
            ->setStatusCode(201)
            ->setJSON([
                'status'  => true,
                'message' => 'Petugas berhasil ditambahkan.',
                'id'      => $this->userModel->getInsertID(),
            ]);
    }

    /**
     * PUT /admin/petugas/{id}
     *
     * Mengubah data petugas.
     *
     * Request body:
     * {
     *     "username": "petugasbaru",
     *     "password": "12345678",
     *     "instansi_id": 2
     * }
     *
     * Semua field bersifat opsional.
     */
    public function update($id): ResponseInterface
    {
        // Pastikan ID berupa angka
        if (!is_numeric($id) || (int) $id <= 0) {
            return $this->response
                ->setStatusCode(400)
                ->setJSON([
                    'status'  => false,
                    'message' => 'ID petugas tidak valid.',
                ]);
        }

        $id = (int) $id;

        // Pastikan user adalah petugas
        $petugas = $this->userModel
            ->where('id', $id)
            ->where('role_id', 2)
            ->first();

        if (!$petugas) {
            return $this->response
                ->setStatusCode(404)
                ->setJSON([
                    'status'  => false,
                    'message' => 'Petugas tidak ditemukan.',
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

        $username   = $input['username'] ?? null;
        $instansiId = $input['instansi_id'] ?? null;
        $password   = $input['password'] ?? null;

        // =========================
        // Update username
        // =========================
        if ($username !== null) {
            $username = trim((string) $username);

            if ($username === '') {
                return $this->response
                    ->setStatusCode(400)
                    ->setJSON([
                        'status'  => false,
                        'message' => 'username tidak boleh kosong.',
                    ]);
            }

            // Cek username dipakai user lain
            $existing = $this->userModel
                ->where('username', $username)
                ->where('id !=', $id)
                ->first();

            if ($existing) {
                return $this->response
                    ->setStatusCode(409)
                    ->setJSON([
                        'status'  => false,
                        'message' => 'username sudah digunakan.',
                    ]);
            }

            $data['username'] = $username;
        }

        // =========================
        // Update instansi
        // =========================
        if ($instansiId !== null) {

            // Pastikan instansi ID valid
            if (!is_numeric($instansiId) || (int) $instansiId <= 0) {
                return $this->response
                    ->setStatusCode(400)
                    ->setJSON([
                        'status'  => false,
                        'message' => 'instansi_id tidak valid.',
                    ]);
            }

            $instansiId = (int) $instansiId;

            // Pastikan instansi benar-benar ada
            if (!$this->instansiModel->find($instansiId)) {
                return $this->response
                    ->setStatusCode(404)
                    ->setJSON([
                        'status'  => false,
                        'message' => 'Instansi tidak ditemukan.',
                    ]);
            }

            $data['instansi_id'] = $instansiId;
        }

        // =========================
        // Update password
        // =========================
        if ($password !== null) {
            $password = (string) $password;

            if ($password === '') {
                return $this->response
                    ->setStatusCode(400)
                    ->setJSON([
                        'status'  => false,
                        'message' => 'password tidak boleh kosong.',
                    ]);
            }

            $data['password'] = password_hash(
                $password,
                PASSWORD_DEFAULT
            );
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
        $this->userModel->update($id, $data);

        return $this->response
            ->setStatusCode(200)
            ->setJSON([
                'status'  => true,
                'message' => 'Petugas berhasil diperbarui.',
            ]);
    }

    /**
     * DELETE /admin/petugas/{id}
     *
     * Menghapus akun petugas.
     */
    public function delete($id): ResponseInterface
    {
        // Pastikan ID berupa angka
        if (!is_numeric($id) || (int) $id <= 0) {
            return $this->response
                ->setStatusCode(400)
                ->setJSON([
                    'status'  => false,
                    'message' => 'ID petugas tidak valid.',
                ]);
        }

        $id = (int) $id;

        // Pastikan user adalah petugas
        $petugas = $this->userModel
            ->where('id', $id)
            ->where('role_id', 2)
            ->first();

        if (!$petugas) {
            return $this->response
                ->setStatusCode(404)
                ->setJSON([
                    'status'  => false,
                    'message' => 'Petugas tidak ditemukan.',
                ]);
        }

        // Hapus petugas
        $this->userModel->delete($id);

        return $this->response
            ->setStatusCode(200)
            ->setJSON([
                'status'  => true,
                'message' => 'Petugas berhasil dihapus.',
            ]);
    }
}