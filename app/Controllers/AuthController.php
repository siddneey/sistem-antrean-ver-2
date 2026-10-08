<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\HTTP\ResponseInterface;

class AuthController extends BaseController
{
    protected UserModel $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    /**
     * POST /login
     *
     * Login Admin / Petugas
     * Request body: JSON
     */
    public function login(): ResponseInterface
    {
        // Ambil data dari raw JSON
        $input = $this->request->getJSON(true);

        // Pastikan JSON valid dan berbentuk array
        if (!is_array($input)) {
            return $this->response
                ->setStatusCode(400)
                ->setJSON([
                    'status'  => false,
                    'message' => 'Format JSON tidak valid.',
                ]);
        }

        $username = trim((string) ($input['username'] ?? ''));
        $password = (string) ($input['password'] ?? '');

        // Validasi input
        if ($username === '' || $password === '') {
            return $this->response
                ->setStatusCode(400)
                ->setJSON([
                    'status'  => false,
                    'message' => 'username dan password wajib diisi.',
                ]);
        }

        // Cari user berdasarkan username
        $user = $this->userModel
            ->where('username', $username)
            ->first();

        // User tidak ditemukan
        if (!$user) {
            return $this->response
                ->setStatusCode(401)
                ->setJSON([
                    'status'  => false,
                    'message' => 'username atau password salah.',
                ]);
        }

        // Cek password
        if (!password_verify($password, $user['password'])) {
            return $this->response
                ->setStatusCode(401)
                ->setJSON([
                    'status'  => false,
                    'message' => 'username atau password salah.',
                ]);
        }

        // Regenerasi session setelah login
        $session = session();
        $session->regenerate(true);

        // Simpan data login ke session
        $session->set([
            'is_logged_in' => true,
            'user_id'      => $user['id'],
            'role_id'      => $user['role_id'],
            'instansi_id'  => $user['instansi_id'],
            'username'     => $user['username'],
        ]);

        // Response berhasil
        return $this->response
            ->setStatusCode(200)
            ->setJSON([
                'status'  => true,
                'message' => 'Login berhasil.',
                'data'    => [
                    'user_id'     => $user['id'],
                    'role_id'     => $user['role_id'],
                    'instansi_id' => $user['instansi_id'],
                    'username'    => $user['username'],
                ],
            ]);
    }

    /**
     * POST /logout
     *
     * Logout Admin / Petugas
     */
    public function logout(): ResponseInterface
    {
        $session = session();

        $session->destroy();

        return $this->response
            ->setStatusCode(200)
            ->setJSON([
                'status'  => true,
                'message' => 'Logout berhasil.',
            ]);
    }
}