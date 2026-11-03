<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\LogUserLoginModel;
use CodeIgniter\HTTP\ResponseInterface;

class AuthController extends BaseController
{
    protected UserModel $userModel;
    protected LogUserLoginModel $logUserLoginModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->logUserLoginModel = new LogUserLoginModel();
    }

    /**
     * ============================================================
     * CATAT AKTIVITAS LOGIN / LOGOUT
     * ============================================================
     *
     * Pencatatan log tidak boleh menyebabkan proses login
     * atau logout gagal apabila terjadi masalah database log.
     */
    protected function catatAktivitas(
        ?int $userId,
        string $username,
        ?int $instansiId,
        string $aktivitas
    ): void {
        try {
            $userAgent = $this->request->getUserAgent();

            $perangkat = trim(
                $userAgent->getBrowser() . ' / ' .
                $userAgent->getPlatform()
            );

            $this->logUserLoginModel->insert([
                'user_id'     => $userId,
                'username'    => mb_substr($username, 0, 100),
                'instansi_id' => $instansiId,
                'aktivitas'   => $aktivitas,
                'alamat_ip'   => $this->request->getIPAddress(),
                'perangkat'   => mb_substr($perangkat, 0, 255),
                'waktu'       => date('Y-m-d H:i:s'),
            ]);

        } catch (\Throwable $e) {
            log_message(
                'error',
                'AuthController::catatAktivitas | ' .
                $e->getMessage()
            );
        }
    }

    /**
     * ============================================================
     * LOGIN ADMIN / PETUGAS
     * ============================================================
     *
     * POST /login
     *
     * Mendukung JSON dan form HTML.
     */
    public function login(): ResponseInterface
    {
        $isJson = str_contains(
            strtolower($this->request->getHeaderLine('Content-Type')),
            'application/json'
        );

        $input = $isJson
            ? $this->request->getJSON(true)
            : $this->request->getPost();

        if (!is_array($input)) {
            return $this->response
                ->setStatusCode(400)
                ->setJSON([
                    'status'  => false,
                    'message' => 'Format request tidak valid.',
                ]);
        }

        $username = trim((string) ($input['username'] ?? ''));
        $password = (string) ($input['password'] ?? '');

        /**
         * --------------------------------------------------------
         * VALIDASI INPUT
         * --------------------------------------------------------
         */
        if ($username === '' || $password === '') {
            if (!$isJson) {
                return redirect()->back()
                    ->with(
                        'error',
                        'Username dan password wajib diisi.'
                    );
            }

            return $this->response
                ->setStatusCode(400)
                ->setJSON([
                    'status'  => false,
                    'message' => 'Username dan password wajib diisi.',
                ]);
        }

        /**
         * --------------------------------------------------------
         * CARI USER
         * --------------------------------------------------------
         */
        $user = $this->userModel
            ->where('username', $username)
            ->first();

        /**
         * --------------------------------------------------------
         * LOGIN GAGAL
         * --------------------------------------------------------
         */
        if (
            !$user ||
            !password_verify($password, $user['password'])
        ) {
            $this->catatAktivitas(
                $user ? (int) $user['id'] : null,
                $username,
                $user && $user['instansi_id'] !== null
                    ? (int) $user['instansi_id']
                    : null,
                'Login Gagal'
            );

            if (!$isJson) {
                return redirect()->back()
                    ->with(
                        'error',
                        'Username atau password salah.'
                    );
            }

            return $this->response
                ->setStatusCode(401)
                ->setJSON([
                    'status'  => false,
                    'message' => 'Username atau password salah.',
                ]);
        }

        /**
         * --------------------------------------------------------
         * VALIDASI ROLE
         * --------------------------------------------------------
         */
        $roleId = (int) $user['role_id'];

        if (!in_array($roleId, [1, 2], true)) {
            $this->catatAktivitas(
                (int) $user['id'],
                $username,
                $user['instansi_id'] !== null
                    ? (int) $user['instansi_id']
                    : null,
                'Login Gagal'
            );

            if (!$isJson) {
                return redirect()->back()
                    ->with(
                        'error',
                        'Role akun tidak dikenali.'
                    );
            }

            return $this->response
                ->setStatusCode(403)
                ->setJSON([
                    'status'  => false,
                    'message' => 'Role akun tidak dikenali.',
                ]);
        }

        /**
         * --------------------------------------------------------
         * BUAT SESSION LOGIN
         * --------------------------------------------------------
         */
        $session = session();
        $session->regenerate(true);

        $session->set([
            'is_logged_in' => true,
            'user_id'      => $user['id'],
            'role_id'      => $roleId,
            'instansi_id'  => $user['instansi_id'],
            'username'     => $user['username'],
        ]);

        /**
         * --------------------------------------------------------
         * CATAT LOGIN BERHASIL
         * --------------------------------------------------------
         */
        $this->catatAktivitas(
            (int) $user['id'],
            (string) $user['username'],
            $user['instansi_id'] !== null
                ? (int) $user['instansi_id']
                : null,
            'Login Berhasil'
        );

        /**
         * --------------------------------------------------------
         * REDIRECT FORM HTML
         * --------------------------------------------------------
         */
        if (!$isJson) {
            $destination = $roleId === 1
                ? 'admin/dashboard'
                : 'petugas/dashboard';

            return redirect()->to(site_url($destination));
        }

        /**
         * --------------------------------------------------------
         * RESPONSE JSON
         * --------------------------------------------------------
         */
        return $this->response->setJSON([
            'status'  => true,
            'message' => 'Login berhasil.',
            'data'    => [
                'user_id'     => $user['id'],
                'role_id'     => $roleId,
                'instansi_id' => $user['instansi_id'],
                'username'    => $user['username'],
            ],
        ]);
    }

    /**
     * ============================================================
     * LOGOUT ADMIN / PETUGAS
     * ============================================================
     *
     * POST /logout
     */
    public function logout(): ResponseInterface
    {
        $session = session();

        /**
         * --------------------------------------------------------
         * AMBIL DATA SEBELUM SESSION DIHAPUS
         * --------------------------------------------------------
         */
        if ($session->get('is_logged_in')) {
            $userId = $session->get('user_id');
            $instansiId = $session->get('instansi_id');

            $this->catatAktivitas(
                $userId !== null ? (int) $userId : null,
                (string) $session->get('username'),
                $instansiId !== null ? (int) $instansiId : null,
                'Logout'
            );
        }

        /**
         * --------------------------------------------------------
         * HAPUS SESSION
         * --------------------------------------------------------
         */
        $session->destroy();

        $accept = $this->request->getHeaderLine('Accept');

        if (str_contains($accept, 'application/json')) {
            return $this->response
                ->setStatusCode(200)
                ->setJSON([
                    'status'  => true,
                    'message' => 'Logout berhasil.',
                ]);
        }

        return redirect()->to(site_url('/'));
    }
}