<?php

namespace App\Controllers;

use Throwable;

class PetugasController extends BaseController
{
    private function instansiPetugas(): ?int
    {
        if ((int) session()->get('role_id') !== 2) {
            return null;
        }
        $id = (int) session()->get('instansi_id');
        return $id > 0 ? $id : null;
    }

    private function tolak()
    {
        return $this->response->setStatusCode(403)->setJSON([
            'status' => false,
            'message' => 'Akses ditolak.',
        ]);
    }

    public function dashboard()
    {
        $instansiId = $this->instansiPetugas();
        if ($instansiId === null) {
            return redirect()->to(site_url('login'));
        }
        $instansi = db_connect()->table('instansi')
            ->select('nama_instansi')
            ->where('id', $instansiId)
            ->get()
            ->getRowArray();

        return view('petugas/index', [
            'username'     => session()->get('username'),
            'instansiId'   => $instansiId,
            'namaInstansi' => $instansi['nama_instansi'] ?? 'Instansi tidak ditemukan',
        ]);
    }

    public function dataDashboard()
    {
        $instansiId = $this->instansiPetugas();
        if ($instansiId === null) {
            return $this->tolak();
        }
        $db = db_connect();
        $rows = $db->table('riwayat_layanan rl')
            ->select('rl.id AS riwayat_id, rl.petugas_id, a.nomor_antrean,
                a.jenis_antrean, rl.status_layanan, rl.waktu_masuk,
                rl.waktu_mulai, rl.waktu_selesai, l.nama_layanan')
            ->join('antrean a', 'a.id = rl.antrean_id')
            ->join('layanan l', 'l.id = rl.layanan_id', 'left')
            ->where('rl.instansi_id', $instansiId)
            ->where('a.tanggal_antrean', date('Y-m-d'))
            ->orderBy('rl.waktu_masuk', 'ASC')
            ->orderBy('rl.id', 'ASC')->get()->getResultArray();

        $aktif = null;
        $menunggu = [];
        $riwayat = [];
        $selesai = 0;
        $petugasId = (int) session()->get('user_id');
        foreach ($rows as $row) {
            $status = $row['status_layanan'];
            if (in_array($status, ['DIPANGGIL', 'DILAYANI'], true)) {
                if ((int) $row['petugas_id'] === $petugasId && $aktif === null) {
                    $aktif = $row;
                }
            } elseif ($status === 'MENUNGGU') {
                $menunggu[] = $row;
            } elseif (in_array($status, ['SELESAI', 'PENDING'], true)) {
                $riwayat[] = $row;
                if ($status === 'SELESAI') {
                    $selesai++;
                }
            }
        }
        usort($menunggu, static function (array $a, array $b): int {
            $pa = $a['jenis_antrean'] === 'PRIORITAS' ? 0 : 1;
            $pb = $b['jenis_antrean'] === 'PRIORITAS' ? 0 : 1;
            return ($pa <=> $pb)
                ?: strcmp((string) $a['waktu_masuk'], (string) $b['waktu_masuk'])
                ?: ((int) $a['riwayat_id'] <=> (int) $b['riwayat_id']);
        });
        return $this->response->setJSON([
            'status' => true,
            'data' => [
                'aktif' => $aktif,
                'menunggu' => $menunggu,
                'jumlah_menunggu' => count($menunggu),
                'jumlah_selesai' => $selesai,
                'riwayat' => array_reverse($riwayat),
            ],
        ]);
    }

    public function pilihan()
    {
        $instansiId = $this->instansiPetugas();
        if ($instansiId === null) {
            return $this->tolak();
        }
        $db = db_connect();
        return $this->response->setJSON([
            'status' => true,
            'data' => [
                'layanan' => $db->table('layanan')
                    ->select('id, nama_layanan')->where('instansi_id', $instansiId)
                    ->orderBy('nama_layanan', 'ASC')->get()->getResultArray(),
                'instansi' => $db->table('instansi')
                    ->select('id, nama_instansi')->where('id !=', $instansiId)
                    ->orderBy('nama_instansi', 'ASC')->get()->getResultArray(),
            ],
        ]);
    }

    /** GET pengaturan aktif petugas. Pengaturan booking mengikuti entri terbaru. */
    public function pengaturanLoket()
    {
        $instansiId = $this->instansiPetugas();
        if ($instansiId === null) {
            return $this->tolak();
        }

        try {
            $row = db_connect()->table('kuota_instansi')
                ->select('kuota_layanan, kuota_booking, status_loket, tanggal')
                ->where('instansi_id', $instansiId)
                ->where('tanggal <=', date('Y-m-d'))
                ->orderBy('tanggal', 'DESC')
                ->limit(1)
                ->get()
                ->getRowArray();

            return $this->response->setJSON([
                'status' => true,
                'data' => [
                    'kuota_layanan' => (int) ($row['kuota_layanan'] ?? 50),
                    'kuota_booking' => (int) ($row['kuota_booking'] ?? 30),
                    'status_loket' => strtoupper((string) ($row['status_loket'] ?? 'BUKA')),
                ],
            ]);
        } catch (Throwable $e) {
            log_message('error', '[PengaturanLoket GET] {message}', ['message' => $e->getMessage()]);
            return $this->response->setStatusCode(500)->setJSON([
                'status' => false,
                'message' => 'Gagal mengambil pengaturan loket.',
            ]);
        }
    }

    /** POST pengaturan petugas: kedua kuota independen. */
    public function simpanPengaturanLoket()
    {
        $instansiId = $this->instansiPetugas();
        if ($instansiId === null) {
            return $this->tolak();
        }

        $input = $this->request->getJSON(true);
        if (!is_array($input)) {
            return $this->response->setStatusCode(400)->setJSON([
                'status' => false,
                'message' => 'Request JSON tidak valid.',
                'csrfHash' => csrf_hash(),
            ]);
        }

        $layanan = filter_var($input['kuota_layanan'] ?? null, FILTER_VALIDATE_INT);
        $booking = filter_var($input['kuota_booking'] ?? null, FILTER_VALIDATE_INT);
        $status = strtoupper(trim((string) ($input['status_loket'] ?? '')));

        if ($layanan === false || $layanan < 1 || $booking === false
            || $booking < 0 || !in_array($status, ['BUKA', 'TUTUP'], true)) {
            return $this->response->setStatusCode(400)->setJSON([
                'status' => false,
                'message' => 'Pengaturan loket tidak valid.',
                'csrfHash' => csrf_hash(),
            ]);
        }

        try {
            $db = db_connect();
            $waktu = date('Y-m-d H:i:s');
            $db->query(
                'INSERT INTO kuota_instansi
                    (instansi_id, tanggal, kuota_layanan, kuota_booking, status_loket, created_at, updated_at)
                 VALUES (?, ?, ?, ?, ?, ?, ?)
                 ON DUPLICATE KEY UPDATE
                    kuota_layanan = VALUES(kuota_layanan),
                    kuota_booking = VALUES(kuota_booking),
                    status_loket = VALUES(status_loket),
                    updated_at = VALUES(updated_at)',
                [$instansiId, date('Y-m-d'), $layanan, $booking, $status, $waktu, $waktu]
            );

            if ($db->affectedRows() < 0) {
                throw new \RuntimeException('Gagal menyimpan pengaturan.');
            }

            return $this->response->setJSON([
                'status' => true,
                'data' => [
                    'kuota_layanan' => $layanan,
                    'kuota_booking' => $booking,
                    'status_loket' => $status,
                ],
                'csrfHash' => csrf_hash(),
            ]);
        } catch (Throwable $e) {
            log_message('error', '[PengaturanLoket] {message}', ['message' => $e->getMessage()]);
            return $this->response->setStatusCode(500)->setJSON([
                'status' => false,
                'message' => 'Gagal menyimpan pengaturan loket.',
                'csrfHash' => csrf_hash(),
            ]);
        }
    }
}