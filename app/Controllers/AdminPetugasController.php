<?php

namespace App\Controllers;

use App\Models\InstansiModel;
use App\Models\UserModel;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;
use Throwable;

class AdminPetugasController extends ResourceController
{
    protected UserModel $userModel;
    protected InstansiModel $instansiModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->instansiModel = new InstansiModel();
        helper(['url', 'form']);
    }

    /** Halaman HTML; dropdown instansi memakai ID database. */
    public function halaman()
    {
        $instansiList = $this->instansiModel
            ->select('id, nama_instansi')
            ->orderBy('nama_instansi', 'ASC')
            ->findAll();

        return view('admin/petugas', [
            'instansiList' => $instansiList,
            'activeMenu' => 'petugas',
        ]);
    }

    /** GET /admin/petugas — daftar akun petugas dalam format JSON. */
    public function index(): ResponseInterface
    {
        $petugas = $this->userModel->builder()
            ->select([
                'users.id',
                'users.role_id',
                'users.instansi_id',
                'users.username',
                'users.status',
                'users.last_login',
                'users.created_at',
                'users.updated_at',
                'instansi.nama_instansi',
            ])
            ->join('instansi', 'instansi.id = users.instansi_id', 'left')
            ->where('users.role_id', 2)
            ->orderBy('users.username', 'ASC')
            ->get()
            ->getResultArray();

        return $this->respond([
            'status' => true,
            'data' => $petugas,
            'csrfHash' => function_exists('csrf_hash') ? csrf_hash() : null,
        ]);
    }

    /** POST /admin/petugas — membuat akun petugas baru. */
    public function create(): ResponseInterface
    {
        $input = $this->request->getJSON(true) ?? [];
        $username = trim((string) ($input['username'] ?? ''));
        $password = (string) ($input['password'] ?? '');
        $instansiId = filter_var($input['instansi_id'] ?? null, FILTER_VALIDATE_INT);
        $status = (string) ($input['status'] ?? 'Aktif');

        if ($username === '' || strlen($username) > 100 || $password === '' || $instansiId === false || !$instansiId) {
            return $this->failValidationErrors('Username, password, dan instansi wajib diisi dengan benar.');
        }
        if (strlen($password) < 8) {
            return $this->failValidationErrors('Password minimal 8 karakter.');
        }
        if (!in_array($status, ['Aktif', 'Nonaktif'], true)) {
            return $this->failValidationErrors('Status harus Aktif atau Nonaktif.');
        }
        if (!$this->instansiModel->find($instansiId)) {
            return $this->failValidationErrors('Instansi yang dipilih tidak ditemukan.');
        }
        if ($this->userModel->where('username', $username)->first()) {
            return $this->failResourceExists('Username sudah digunakan.');
        }

        try {
            $id = $this->userModel->insert([
                'role_id' => 2,
                'instansi_id' => $instansiId,
                'username' => $username,
                'password' => password_hash($password, PASSWORD_DEFAULT),
                'status' => $status,
            ], true);

            if (!$id) {
                return $this->failServerError('Data petugas gagal disimpan.');
            }

            return $this->respondCreated([
                'status' => true,
                'message' => 'Petugas berhasil ditambahkan.',
                'id' => $id,
                'csrfHash' => function_exists('csrf_hash') ? csrf_hash() : null,
            ]);
        } catch (Throwable $e) {
            log_message('error', '[AdminPetugasController::create] {message}', ['message' => $e->getMessage()]);
            return $this->failServerError('Terjadi kesalahan saat menyimpan petugas.');
        }
    }

    /** PUT /admin/petugas/{id} — memperbarui akun petugas. */
    public function update($id = null): ResponseInterface
    {
        if (!ctype_digit((string) $id) || (int) $id < 1) {
            return $this->failValidationErrors('ID petugas tidak valid.');
        }

        $petugas = $this->userModel->where('role_id', 2)->find((int) $id);
        if (!$petugas) {
            return $this->failNotFound('Data petugas tidak ditemukan.');
        }

        $input = $this->request->getJSON(true) ?? [];
        $data = [];

        if (array_key_exists('username', $input)) {
            $username = trim((string) $input['username']);
            if ($username === '' || strlen($username) > 100) {
                return $this->failValidationErrors('Username wajib diisi dan maksimal 100 karakter.');
            }
            $existing = $this->userModel
                ->where('username', $username)
                ->where('id !=', (int) $id)
                ->first();
            if ($existing) {
                return $this->failResourceExists('Username sudah digunakan akun lain.');
            }
            $data['username'] = $username;
        }

        if (array_key_exists('instansi_id', $input)) {
            $instansiId = filter_var($input['instansi_id'], FILTER_VALIDATE_INT);
            if ($instansiId === false || !$instansiId || !$this->instansiModel->find($instansiId)) {
                return $this->failValidationErrors('Instansi yang dipilih tidak valid.');
            }
            $data['instansi_id'] = $instansiId;
        }

        if (array_key_exists('status', $input)) {
            $status = (string) $input['status'];
            if (!in_array($status, ['Aktif', 'Nonaktif'], true)) {
                return $this->failValidationErrors('Status harus Aktif atau Nonaktif.');
            }
            $data['status'] = $status;
        }

        if (isset($input['password']) && $input['password'] !== '') {
            $password = (string) $input['password'];
            if (strlen($password) < 8) {
                return $this->failValidationErrors('Password baru minimal 8 karakter.');
            }
            $data['password'] = password_hash($password, PASSWORD_DEFAULT);
        }

        if ($data === []) {
            return $this->failValidationErrors('Tidak ada data yang diubah.');
        }

        try {
            if (!$this->userModel->update((int) $id, $data)) {
                return $this->failServerError('Data petugas gagal diperbarui.');
            }

            return $this->respond([
                'status' => true,
                'message' => 'Data petugas berhasil diperbarui.',
                'csrfHash' => function_exists('csrf_hash') ? csrf_hash() : null,
            ]);
        } catch (Throwable $e) {
            log_message('error', '[AdminPetugasController::update] {message}', ['message' => $e->getMessage()]);
            return $this->failServerError('Terjadi kesalahan saat memperbarui petugas.');
        }
    }

    /** DELETE /admin/petugas/{id} — menghapus akun petugas. */
    public function delete($id = null): ResponseInterface
    {
        if (!ctype_digit((string) $id) || (int) $id < 1) {
            return $this->failValidationErrors('ID petugas tidak valid.');
        }

        $petugas = $this->userModel->where('role_id', 2)->find((int) $id);
        if (!$petugas) {
            return $this->failNotFound('Data petugas tidak ditemukan.');
        }

        try {
            if (!$this->userModel->delete((int) $id)) {
                return $this->failServerError('Petugas gagal dihapus.');
            }

            return $this->respond([
                'status' => true,
                'message' => 'Petugas berhasil dihapus.',
                'csrfHash' => function_exists('csrf_hash') ? csrf_hash() : null,
            ]);
        } catch (Throwable $e) {
            log_message('error', '[AdminPetugasController::delete] {message}', ['message' => $e->getMessage()]);
            return $this->fail('Petugas tidak dapat dihapus karena masih terhubung dengan data lain.', 409);
        }
    }
}