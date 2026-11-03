<?php

namespace App\Controllers;

use App\Models\LogUserLoginModel;
use CodeIgniter\HTTP\ResponseInterface;

class AdminLogUserLoginController extends BaseController
{
    protected LogUserLoginModel $logModel;

    public function __construct()
    {
        $this->logModel = new LogUserLoginModel();
    }

    /** Hanya admin (role_id 1) yang dapat melihat audit login. */
    private function isAdmin(): bool
    {
        return session()->get('is_logged_in') === true
            && (int) session()->get('role_id') === 1;
    }

    /** GET /admin/log-user-login */
    public function halaman(): ResponseInterface|string
    {
        if (!$this->isAdmin()) {
            return redirect()->to(site_url('/'));
        }

        return view('admin/log_user_login', [
            'title'      => 'Log User Login',
            'activeMenu' => 'log-user-login',
        ]);
    }

    /** GET /admin/log-user-login/data */
    public function index(): ResponseInterface
    {
        if (!$this->isAdmin()) {
            return $this->response->setStatusCode(403)->setJSON([
                'status' => false,
                'message' => 'Akses ditolak.',
            ]);
        }

        try {
            $logs = $this->logModel
                ->orderBy('waktu', 'DESC')
                ->orderBy('id', 'DESC')
                ->findAll();

            // Nama tabel/kolom instansi dapat berbeda antar proyek.
            // Bila struktur instansi dikenal, cocokkan ID dengan nama aslinya.
            $namaInstansi = $this->ambilNamaInstansi();

            $data = [];
            foreach ($logs as $log) {
                $idInstansi = $log['instansi_id'] ?? null;
                $instansi = ($idInstansi !== null && $idInstansi !== '')
                    ? ($namaInstansi[(string) $idInstansi] ?? 'Instansi #' . $idInstansi)
                    : '-';

                $waktu = (string) ($log['waktu'] ?? '');
                $aktivitas = (string) ($log['aktivitas'] ?? '');

                $data[] = [
                    'id'        => (int) $log['id'],
                    'username'  => (string) ($log['username'] ?? '-'),
                    'instansi'  => $instansi,
                    'aktivitas' => $aktivitas,
                    'tanggal'   => substr($waktu, 0, 10),
                    'waktu'     => substr($waktu, 11, 8),
                    'ip'        => (string) ($log['alamat_ip'] ?? '-'),
                    'perangkat' => (string) ($log['perangkat'] ?? '-'),
                    'status'    => $aktivitas === 'Login Gagal' ? 'Gagal' : 'Berhasil',
                    'logout'    => $aktivitas === 'Logout' ? substr($waktu, 11, 8) : '-',
                ];
            }

            return $this->response->setJSON([
                'status' => true,
                'data'   => $data,
            ]);
        } catch (\Throwable $e) {
            log_message('error', 'AdminLogUserLoginController::index | ' . $e->getMessage());
            return $this->response->setStatusCode(500)->setJSON([
                'status'  => false,
                'message' => 'Gagal mengambil riwayat login.',
            ]);
        }
    }

   /**
     * Menghindari asumsi struktur tabel instansi.
     * Mendukung tabel `instansi` atau `instansis`, kolom id dan nama/nama_instansi.
     */
    private function ambilNamaInstansi(): array
    {
        $db = db_connect();
        $tabel = null;
        foreach (['instansi', 'instansis'] as $namaTabel) {
            if ($db->tableExists($namaTabel)) {
                $tabel = $namaTabel;
                break;
            }
        }
        if ($tabel === null) {
            return [];
        }

        $fields = $db->getFieldNames($tabel);
        $kolomId = in_array('id', $fields, true) ? 'id' : (in_array('instansi_id', $fields, true) ? 'instansi_id' : null);
        $kolomNama = null;
        foreach (['nama_instansi', 'nama', 'instansi'] as $candidate) {
            if (in_array($candidate, $fields, true)) {
                $kolomNama = $candidate;
                break;
            }
        }
        if ($kolomId === null || $kolomNama === null) {
            return [];
        }

        $mapping = [];
        foreach ($db->table($tabel)->select([$kolomId, $kolomNama])->get()->getResultArray() as $item) {
            $mapping[(string) $item[$kolomId]] = (string) $item[$kolomNama];
        }
        return $mapping;
    }
}