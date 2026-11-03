<?php

namespace App\Controllers;

use App\Models\IpAksesModel;
use App\Models\StatusLayarModel;
use App\Models\KelompokModel;
use CodeIgniter\HTTP\ResponseInterface;

class AdminLayarController extends BaseController
{
    protected IpAksesModel $ipModel;
    protected StatusLayarModel $statusModel;
    protected KelompokModel $kelompokModel;

    public function __construct()
    {
        $this->ipModel       = new IpAksesModel();
        $this->statusModel   = new StatusLayarModel();
        $this->kelompokModel = new KelompokModel();
    }

    public function halaman()
    {
        return view('admin/pengaturan_layar', [
            'activeMenu' => 'pengaturan-layar',
        ]);
    }

    public function daftarIp(): ResponseInterface
    {
        return $this->response->setJSON([
            'status' => true,
            'data'   => $this->ipModel
                ->orderBy('id', 'DESC')
                ->findAll(),
        ]);
    }

    public function tambahIp(): ResponseInterface
    {
        $ip = trim((string) $this->request->getPost('ip_address'));

        if (! filter_var($ip, FILTER_VALIDATE_IP)) {
            return $this->response
                ->setStatusCode(422)
                ->setJSON([
                    'status'  => false,
                    'message' => 'Format IP address tidak valid.',
                ]);
        }

        if ($this->ipModel->where('ip_address', $ip)->first()) {
            return $this->response
                ->setStatusCode(409)
                ->setJSON([
                    'status'  => false,
                    'message' => 'IP address sudah terdaftar.',
                ]);
        }

        if (! $this->ipModel->insert(['ip_address' => $ip])) {
            return $this->response
                ->setStatusCode(422)
                ->setJSON([
                    'status'  => false,
                    'message' => 'Gagal menyimpan IP address.',
                ]);
        }

        return $this->response->setJSON([
            'status'  => true,
            'message' => 'IP address berhasil ditambahkan.',
        ]);
    }

    public function hapusIp($id): ResponseInterface
    {
        $ip = $this->ipModel->find($id);

        if (! $ip) {
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

    public function statusLayar(): ResponseInterface
    {
        $kelompok = $this->kelompokModel
            ->select('id, nama_kelompok')
            ->orderBy('id', 'ASC')
            ->findAll();

        $hasil = [];

        foreach ($kelompok as $item) {
            $status = $this->statusModel
                ->where('kelompok_id', $item['id'])
                ->first();

            $lastSeen = $status['last_seen'] ?? null;

            $aktif = $lastSeen !== null
                && strtotime($lastSeen) !== false
                && strtotime($lastSeen) >= time() - 60;

            $hasil[] = [
                'kelompok_id'    => (int) $item['id'],
                'nama_kelompok'  => $item['nama_kelompok'],
                'login_terakhir' => $status['login_terakhir'] ?? null,
                'last_seen'      => $lastSeen,
                'aktif'          => $aktif,
                'login'          => $status !== null
                    && ! empty($status['login_terakhir']),
            ];
        }

        return $this->response->setJSON([
            'status' => true,
            'data'   => $hasil,
        ]);
    }
}