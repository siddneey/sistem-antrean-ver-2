<?php

namespace App\Controllers;

use App\Models\IpAksesModel;
use App\Models\KelompokModel;
use CodeIgniter\HTTP\ResponseInterface;

class AdminLayarController extends BaseController
{
    protected IpAksesModel $ipModel;
    protected KelompokModel $kelompokModel;

    public function __construct()
    {
        $this->ipModel = new IpAksesModel();
        $this->kelompokModel = new KelompokModel();
    }

    public function halaman()
    {
        return view('admin/pengaturan_layar', [
            'activeMenu' => 'pengaturan-layar',
        ]);
    }

    /**
     * GET /admin/layar/ip
     */
    public function daftarIp(): ResponseInterface
    {
        return $this->response->setJSON([
            'status' => true,
            'data'   => $this->ipModel
                ->orderBy('id', 'DESC')
                ->findAll(),
        ]);
    }

    /**
     * POST /admin/layar/ip
     */
    public function tambahIp(): ResponseInterface
    {
        $ip = trim(
            (string) $this->request->getPost('ip_address')
        );

        if (!filter_var($ip, FILTER_VALIDATE_IP)) {
            return $this->response
                ->setStatusCode(422)
                ->setJSON([
                    'status'  => false,
                    'message' => 'Format IP address tidak valid.',
                ]);
        }

        $existing = $this->ipModel
            ->where('ip_address', $ip)
            ->first();

        if ($existing) {
            return $this->response
                ->setStatusCode(409)
                ->setJSON([
                    'status'  => false,
                    'message' => 'IP address sudah terdaftar.',
                ]);
        }

        if (!$this->ipModel->insert([
            'ip_address' => $ip,
        ])) {
            return $this->response
                ->setStatusCode(422)
                ->setJSON([
                    'status'  => false,
                    'message' => 'Gagal menyimpan IP address.',
                ]);
        }

        return $this->response
            ->setStatusCode(201)
            ->setJSON([
                'status'  => true,
                'message' => 'IP address berhasil ditambahkan.',
            ]);
    }

    /**
     * DELETE /admin/layar/ip/{id}
     */
    public function hapusIp($id): ResponseInterface
    {
        $ip = $this->ipModel->find($id);

        if (!$ip) {
            return $this->response
                ->setStatusCode(404)
                ->setJSON([
                    'status'  => false,
                    'message' => 'IP address tidak ditemukan.',
                ]);
        }

        $this->ipModel->delete($id);

        return $this->response->setJSON([
            'status'  => true,
            'message' => 'IP address berhasil dihapus.',
        ]);
    }

    /**
     * GET /admin/layar/status
     *
     * Mengambil status Display dari heartbeat tabel kelompok.
     */
    public function statusLayar(): ResponseInterface
    {
        $kelompok = $this->kelompokModel
            ->select([
                'id',
                'nama_kelompok',
                'display_heartbeat_at',
                'display_audio_ready',
                'display_session_token',
            ])
            ->orderBy('nama_kelompok', 'ASC')
            ->findAll();

        $sekarang = time();
        $hasil = [];

        foreach ($kelompok as $item) {
            $heartbeatAt = !empty($item['display_heartbeat_at'])
                ? strtotime($item['display_heartbeat_at'])
                : false;

            $umurHeartbeat = $heartbeatAt !== false
                ? $sekarang - $heartbeatAt
                : -1;

            // Samakan dengan batas online di DisplayController.
            $online = (
                $heartbeatAt !== false
                && $umurHeartbeat >= 0
                && $umurHeartbeat <= 15
                && !empty($item['display_session_token'])
            );

            $audioReady = (
                $online
                && (int) $item['display_audio_ready'] === 1
            );

            if (!$online) {
                $status = 'OFFLINE';
            } elseif (!$audioReady) {
                $status = 'BELUM_SIAP';
            } else {
                $status = 'SIAP';
            }

            $hasil[] = [
                'kelompok_id'    => (int) $item['id'],
                'nama_kelompok'  => $item['nama_kelompok'],
                'login'          => $online,
                'aktif'          => $online,
                'audio_ready'    => $audioReady,
                'status'         => $status,
                'login_terakhir' => $item['display_heartbeat_at'],
                'last_seen'      => $item['display_heartbeat_at'],
            ];
        }

        return $this->response->setJSON([
            'status' => true,
            'data'   => $hasil,
        ]);
    }
}