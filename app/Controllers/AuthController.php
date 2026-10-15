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
    public function login(): \CodeIgniter\HTTP\ResponseInterface
    {
        $isJson = str_contains(
            strtolower($this->request->getHeaderLine('Content-Type')),
            'application/json'
        );

        // Ambil input dari JSON atau form HTML
        $input = $isJson
            ? $this->request->getJSON(true)
            : $this->request->getPost();

        if (!is_array($input)) {
            return $this->response
                ->setStatusCode(400)
                ->setJSON([
                    'status' => false,
                    'message' => 'Format request tidak valid.',
                ]);
        }

        $username = trim((string) ($input['username'] ?? ''));
        $password = (string) ($input['password'] ?? '');

        if ($username === '' || $password === '') {
            if (!$isJson) {
                return redirect()->back()
                    ->with('error', 'Username dan password wajib diisi.');
            }

            return $this->response
                ->setStatusCode(400)
                ->setJSON([
                    'status' => false,
                    'message' => 'Username dan password wajib diisi.',
                ]);
        }

        $user = $this->userModel
            ->where('username', $username)
            ->first();

        if (
            !$user ||
            !password_verify($password, $user['password'])
        ) {
            if (!$isJson) {
                return redirect()->back()
                    ->with('error', 'Username atau password salah.');
            }

            return $this->response
                ->setStatusCode(401)
                ->setJSON([
                    'status' => false,
                    'message' => 'Username atau password salah.',
                ]);
        }

        $roleId = (int) $user['role_id'];

        // Hanya admin dan petugas yang boleh login ke dashboard
        if (!in_array($roleId, [1, 2], true)) {
            if (!$isJson) {
                return redirect()->back()
                    ->with('error', 'Role akun tidak dikenali.');
            }

            return $this->response
                ->setStatusCode(403)
                ->setJSON([
                    'status' => false,
                    'message' => 'Role akun tidak dikenali.',
                ]);
        }

        $session = session();
        $session->regenerate(true);

        $session->set([
            'is_logged_in' => true,
            'user_id'      => $user['id'],
            'role_id'      => $roleId,
            'instansi_id'  => $user['instansi_id'],
            'username'     => $user['username'],
        ]);

        // Form HTML diarahkan ke dashboard sesuai role
        if (!$isJson) {
            $destination = $roleId === 1
                ? 'admin/dashboard'
                : 'petugas/dashboard';

            return redirect()->to(site_url($destination));
        }

        // Respons untuk klien API tetap JSON
        return $this->response->setJSON([
            'status' => true,
            'message' => 'Login berhasil.',
            'data' => [
                'user_id'     => $user['id'],
                'role_id'     => $roleId,
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

        $accept = $this->request->getHeaderLine('Accept');

        // Request API: balas JSON
        if (str_contains($accept, 'application/json')) {
            return $this->response
                ->setStatusCode(200)
                ->setJSON([
                    'status'  => true,
                    'message' => 'Logout berhasil.',
                ]);
        }

        // Request halaman web: kembali ke halaman login
        return redirect()->to(site_url('/'));
    }
}