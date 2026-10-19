<?php

namespace App\Controllers;

class PetugasController extends BaseController
{
    private function instansiPetugas(): ?int
    {
        if ((int) session()->get('role_id') !== 2) {
            return null;
        }

        $instansiId = (int) session()->get('instansi_id');

        return $instansiId > 0 ? $instansiId : null;
    }

    public function dashboard()
    {
        $instansiId = $this->instansiPetugas();

        if ($instansiId === null) {
            return redirect()->to(site_url('login'));
        }

        return view('petugas/index', [
            'username'   => session()->get('username'),
            'instansiId' => $instansiId,
        ]);
    }

    public function dataDashboard()
    {
        $instansiId = $this->instansiPetugas();

        if ($instansiId === null) {
            return $this->response->setStatusCode(403)->setJSON([
                'status'  => false,
                'message' => 'Akses ditolak.',
            ]);
        }

        $db = \Config\Database::connect();

        $data = $db->table('riwayat_layanan rl')
            ->select(
                'rl.id AS riwayat_id,
                 a.nomor_antrean,
                 a.jenis_antrean,
                 rl.status_layanan,
                 rl.waktu_masuk,
                 rl.waktu_mulai,
                 rl.waktu_selesai,
                 l.nama_layanan'
            )
            ->join('antrean a', 'a.id = rl.antrean_id')
            ->join('layanan l', 'l.id = rl.layanan_id', 'left')
            ->where('rl.instansi_id', $instansiId)
            ->where('a.tanggal_antrean', date('Y-m-d'))
            ->orderBy('rl.waktu_masuk', 'ASC')
            ->orderBy('rl.id', 'ASC')
            ->get()
            ->getResultArray();

        $aktif = null;
        $menunggu = [];
        $riwayat = [];
        $jumlahSelesai = 0;

        foreach ($data as $item) {
            $status = $item['status_layanan'];

            if (in_array($status, ['DIPANGGIL', 'DILAYANI'], true)) {
                if ($aktif === null) {
                    $aktif = $item;
                }
            } elseif ($status === 'MENUNGGU') {
                $menunggu[] = $item;
            } elseif (in_array($status, ['SELESAI', 'PENDING'], true)) {
                $riwayat[] = $item;

                if ($status === 'SELESAI') {
                    $jumlahSelesai++;
                }
            }
        }

        return $this->response->setJSON([
            'status' => true,
            'data' => [
                'aktif'           => $aktif,
                'menunggu'        => $menunggu,
                'jumlah_menunggu' => count($menunggu),
                'jumlah_selesai'  => $jumlahSelesai,
                'riwayat'         => array_reverse($riwayat),
            ],
        ]);
    }

    public function pengaturanLoket()
    {
        $instansiId = $this->instansiPetugas();

        if ($instansiId === null) {
            return $this->response->setStatusCode(403)->setJSON([
                'status'  => false,
                'message' => 'Akses ditolak.',
            ]);
        }

        $db = \Config\Database::connect();

        $pengaturan = $db->table('kuota_instansi')
            ->where('instansi_id', $instansiId)
            ->where('tanggal', date('Y-m-d'))
            ->get()
            ->getRowArray();

        return $this->response->setJSON([
            'status' => true,
            'data' => [
                'kuota_layanan' => (int) ($pengaturan['kuota_layanan'] ?? 50),
                'kuota_booking' => (int) ($pengaturan['kuota_booking'] ?? 30),
                'status_loket'  => $pengaturan['status_loket'] ?? 'BUKA',
            ],
        ]);
    }

    public function simpanPengaturanLoket()
    {
        $instansiId = $this->instansiPetugas();

        if ($instansiId === null) {
            return $this->response->setStatusCode(403)->setJSON([
                'status'  => false,
                'message' => 'Akses ditolak.',
                'csrfHash' => csrf_hash(),
            ]);
        }

        $input = $this->request->getJSON(true);

        if (!is_array($input)) {
            return $this->response->setStatusCode(400)->setJSON([
                'status'   => false,
                'message'  => 'Format data tidak valid.',
                'csrfHash' => csrf_hash(),
            ]);
        }

        $layanan = filter_var(
            $input['kuota_layanan'] ?? null,
            FILTER_VALIDATE_INT,
            ['options' => ['min_range' => 1]]
        );

        $booking = filter_var(
            $input['kuota_booking'] ?? null,
            FILTER_VALIDATE_INT,
            ['options' => ['min_range' => 0]]
        );

        $status = strtoupper(trim((string) ($input['status_loket'] ?? '')));

        if (
            $layanan === false ||
            $booking === false ||
            $booking > $layanan ||
            !in_array($status, ['BUKA', 'TUTUP'], true)
        ) {
            return $this->response->setStatusCode(422)->setJSON([
                'status'   => false,
                'message'  => 'Kuota atau status loket tidak valid.',
                'csrfHash' => csrf_hash(),
            ]);
        }

        $db = \Config\Database::connect();
        $tanggal = date('Y-m-d');
        $sekarang = date('Y-m-d H:i:s');

        // Unique key: (instansi_id, tanggal).
        // Jika belum ada data hari ini, buat baris baru.
        // Jika sudah ada, perbarui pengaturannya.
        $sql = "
            INSERT INTO kuota_instansi
                (
                    instansi_id,
                    tanggal,
                    kuota_layanan,
                    kuota_booking,
                    status_loket,
                    created_at,
                    updated_at
                )
            VALUES (?, ?, ?, ?, ?, ?, ?)
            ON DUPLICATE KEY UPDATE
                kuota_layanan = VALUES(kuota_layanan),
                kuota_booking = VALUES(kuota_booking),
                status_loket = VALUES(status_loket),
                updated_at = VALUES(updated_at)
        ";

        try {
            $db->query($sql, [
                $instansiId,
                $tanggal,
                $layanan,
                $booking,
                $status,
                $sekarang,
                $sekarang,
            ]);
        } catch (\Throwable $e) {
            log_message('error', 'Gagal simpan pengaturan loket: ' . $e->getMessage());

            return $this->response->setStatusCode(500)->setJSON([
                'status'   => false,
                'message'  => 'Pengaturan gagal disimpan.',
                'csrfHash' => csrf_hash(),
            ]);
        }

        return $this->response->setJSON([
            'status'   => true,
            'message'  => 'Pengaturan loket berhasil disimpan.',
            'csrfHash' => csrf_hash(),
            'data' => [
                'kuota_layanan' => $layanan,
                'kuota_booking' => $booking,
                'status_loket'  => $status,
            ],
        ]);
    }
}