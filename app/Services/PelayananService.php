<?php

namespace App\Services;

use CodeIgniter\Database\BaseConnection;
use RuntimeException;
use Throwable;

class PelayananService
{
    protected BaseConnection $db;

    public function __construct()
    {
        $this->db = db_connect();
    }

    private function petugas(int $petugasId): array
    {
        $user = $this->db->table('users')
            ->select('id, role_id, instansi_id')
            ->where('id', $petugasId)
            ->get()
            ->getRowArray();

        if (
            !$user
            || (int) $user['role_id'] !== 2
            || (int) $user['instansi_id'] < 1
        ) {
            throw new RuntimeException('Akun petugas tidak valid.');
        }

        return $user;
    }

    private function validasiPetugasInstansi(
        int $petugasId,
        int $instansiId
    ): void {
        $user = $this->petugas($petugasId);

        if ((int) $user['instansi_id'] !== $instansiId) {
            throw new RuntimeException(
                'Antrean ini bukan tanggung jawab petugas tersebut.'
            );
        }
    }

    private function kunciPetugas(int $petugasId): void
    {
        $user = $this->db->query(
            'SELECT id FROM users WHERE id = ? FOR UPDATE',
            [$petugasId]
        )->getRowArray();

        if (!$user) {
            throw new RuntimeException('Petugas tidak ditemukan.');
        }
    }

    private function kunciRiwayat(int $id): array
    {
        $row = $this->db->query(
            'SELECT * FROM riwayat_layanan WHERE id = ? FOR UPDATE',
            [$id]
        )->getRowArray();

        if (!$row) {
            throw new RuntimeException(
                'Riwayat layanan tidak ditemukan.'
            );
        }

        return $row;
    }

    private function pastikanBelumAktif(int $petugasId): void
    {
        $aktif = $this->db->table('riwayat_layanan rl')
            ->join('antrean a', 'a.id = rl.antrean_id')
            ->where('rl.petugas_id', $petugasId)
            ->where('a.tanggal_antrean', date('Y-m-d'))
            ->whereIn(
                'rl.status_layanan',
                ['DIPANGGIL', 'DILAYANI']
            )
            ->countAllResults();

        if ($aktif > 0) {
            throw new RuntimeException(
                'Selesaikan antrean aktif terlebih dahulu.'
            );
        }
    }

    private function validasiLayanan(
        int $layananId,
        int $instansiId
    ): void {
        if (
            !$this->db->table('layanan')
                ->where('id', $layananId)
                ->where('instansi_id', $instansiId)
                ->countAllResults()
        ) {
            throw new RuntimeException(
                'Layanan tidak tersedia pada instansi tersebut.'
            );
        }
    }

    private function validasiInstansi(int $instansiId): void
    {
        if (
            !$this->db->table('instansi')
                ->where('id', $instansiId)
                ->countAllResults()
        ) {
            throw new RuntimeException('Instansi tidak ditemukan.');
        }
    }

    /**
     * Memastikan SELURUH Display sudah online dan siap.
     *
     * Pemeriksaan ini tidak mengunci semua baris Kelompok.
     * Dengan demikian, dua Kelompok berbeda tetap dapat
     * menjalankan panggilan secara bersamaan.
     */
    private function pastikanSemuaDisplaySiap(): void
    {
        $kelompok = $this->db->table('kelompok')
            ->select([
                'id',
                'nama_kelompok',
                'display_heartbeat_at',
                'display_audio_ready',
            ])
            ->orderBy('id', 'ASC')
            ->get()
            ->getResultArray();

        if (empty($kelompok)) {
            throw new RuntimeException(
                'Tidak ada Kelompok yang terdaftar.'
            );
        }

        $sekarang = time();

        foreach ($kelompok as $item) {
            $namaKelompok = $item['nama_kelompok'];

            $heartbeat = !empty($item['display_heartbeat_at'])
                ? strtotime((string) $item['display_heartbeat_at'])
                : false;

            $selisih = $heartbeat !== false
                ? $sekarang - $heartbeat
                : PHP_INT_MAX;

            if (
                $heartbeat === false
                || $selisih < 0
                || $selisih > 15
            ) {
                throw new RuntimeException(
                    'Display ' . $namaKelompok .
                    ' sedang offline atau belum dibuka. ' .
                    'Semua Display wajib aktif sebelum panggilan dilakukan.'
                );
            }

            if ((int) $item['display_audio_ready'] !== 1) {
                throw new RuntimeException(
                    'Display ' . $namaKelompok .
                    ' belum mengaktifkan Tes Suara. ' .
                    'Semua Display wajib siap sebelum panggilan dilakukan.'
                );
            }
        }
    }

    /**
     * Mengunci Kelompok suara pemanggil.
     *
     * NOWAIT memastikan request lain tidak menunggu
     * transaksi panggilan sebelumnya selesai.
     */
    private function kunciSuaraKelompok(int $instansiId): int
    {
        $row = $this->db->table('instansi i')
            ->select('g.kelompok_id')
            ->join('grup g', 'g.id = i.grup_id')
            ->where('i.id', $instansiId)
            ->get()
            ->getRowArray();

        if (!$row || (int) $row['kelompok_id'] < 1) {
            throw new RuntimeException(
                'Kelompok suara instansi tidak ditemukan.'
            );
        }

        $kelompokId = (int) $row['kelompok_id'];

        /*
         * Periksa semua Display sebelum mengunci jalur suara.
         */
        $this->pastikanSemuaDisplaySiap();

        /*
         * NOWAIT:
         * Jika baris Kelompok sedang dikunci transaksi lain,
         * MySQL langsung mengembalikan error.
         */
        try {
            $kelompok = $this->db->query(
                'SELECT
                    id,
                    status_panggilan
                 FROM kelompok
                 WHERE id = ?
                 FOR UPDATE NOWAIT',
                [$kelompokId]
            )->getRowArray();

        } catch (Throwable $e) {
            log_message(
                'debug',
                'Gagal memperoleh lock Kelompok ' .
                $kelompokId . ': ' . $e->getMessage()
            );

            throw new RuntimeException(
                'Harap tunggu, panggilan sebelumnya sedang berlangsung.'
            );
        }

        if (!$kelompok) {
            throw new RuntimeException(
                'Kelompok suara tidak ditemukan.'
            );
        }

        /*
         * Status PLAYING tidak boleh dilewati.
         * Hanya audioSelesai() yang boleh mengubahnya menjadi IDLE.
         */
        if ($kelompok['status_panggilan'] === 'PLAYING') {
            throw new RuntimeException(
                'Harap tunggu, panggilan sebelumnya sedang berlangsung.'
            );
        }

        return $kelompokId;
    }

    /**
     * Menandai kelompok sedang memutar audio.
     */
    private function mulaiSuaraKelompok(
        int $kelompokId,
        int $panggilanId
    ): void {
        $berhasil = $this->db->table('kelompok')
            ->where('id', $kelompokId)
            ->update([
                'status_panggilan' => 'PLAYING',
                'riwayat_panggilan_aktif_id' => $panggilanId,
                'token_panggilan' => bin2hex(random_bytes(32)),
                'batas_kunci' => date(
                    'Y-m-d H:i:s',
                    time() + 120
                ),
            ]);

        if (!$berhasil || $this->db->affectedRows() !== 1) {
            throw new RuntimeException(
                'Gagal mengunci jalur suara kelompok.'
            );
        }
    }

    /**
     * Mencatat setiap pemanggilan sebagai aksi PANGGIL.
     */
    private function catatPanggilan(
        int $id,
        int $petugasId,
        string $keterangan
    ): int {
        $waktu = date('Y-m-d H:i:s');

        $berhasil = $this->db->table('riwayat_panggilan')->insert([
            'riwayat_layanan_id' => $id,
            'petugas_id' => $petugasId,
            'aksi' => 'PANGGIL',
            'waktu' => $waktu,
            'keterangan' => $keterangan,
            'created_at' => $waktu,
            'updated_at' => $waktu,
        ]);

        $panggilanId = (int) $this->db->insertID();

        if (!$berhasil || $panggilanId < 1) {
            throw new RuntimeException(
                'Gagal mencatat riwayat panggilan.'
            );
        }

        return $panggilanId;
    }

    private function cekTransaksi(): void
    {
        if ($this->db->transStatus() === false) {
            throw new RuntimeException(
                'Gagal menyimpan perubahan antrean.'
            );
        }
    }

    /**
     * PANGGIL ANTREAN PERTAMA
     */
    public function panggilAntrean(
        int $petugasId,
        int $instansiId
    ): array {
        $this->validasiPetugasInstansi(
            $petugasId,
            $instansiId
        );

        $this->db->transBegin();

        try {
            $kelompokId = $this->kunciSuaraKelompok($instansiId);

            $this->kunciPetugas($petugasId);

            $this->pastikanBelumAktif($petugasId);

            $calon = $this->db->table('riwayat_layanan rl')
                ->select(
                    'rl.id, rl.antrean_id, a.nomor_antrean, a.jenis_antrean'
                )
                ->join('antrean a', 'a.id = rl.antrean_id')
                ->where('rl.instansi_id', $instansiId)
                ->where('rl.status_layanan', 'MENUNGGU')
                ->where('a.tanggal_antrean', date('Y-m-d'))
                ->orderBy('a.jenis_antrean', 'DESC')
                ->orderBy('rl.waktu_masuk', 'ASC')
                ->orderBy('rl.id', 'ASC')
                ->get()
                ->getResultArray();

            $terpilih = null;

            foreach ($calon as $item) {
                $locked = $this->kunciRiwayat(
                    (int) $item['id']
                );

                if (
                    $locked['status_layanan'] === 'MENUNGGU'
                    && (int) $locked['instansi_id'] === $instansiId
                ) {
                    $terpilih = $item;
                    break;
                }
            }

            if (!$terpilih) {
                throw new RuntimeException(
                    'Tidak ada antrean yang dapat dipanggil.'
                );
            }

            $waktu = date('Y-m-d H:i:s');

            $this->db->table('riwayat_layanan')
                ->where('id', $terpilih['id'])
                ->where('status_layanan', 'MENUNGGU')
                ->update([
                    'status_layanan' => 'DILAYANI',
                    'petugas_id' => $petugasId,
                    'waktu_mulai' => $waktu,
                    'updated_at' => $waktu,
                ]);

            if ($this->db->affectedRows() !== 1) {
                throw new RuntimeException(
                    'Antrean sudah dipanggil petugas lain.'
                );
            }

            $panggilanId = $this->catatPanggilan(
                (int) $terpilih['id'],
                $petugasId,
                'Panggilan pertama'
            );

            $this->mulaiSuaraKelompok(
                $kelompokId,
                $panggilanId
            );

            $this->cekTransaksi();

            $this->db->transCommit();

            return [
                'riwayat_layanan_id' => (int) $terpilih['id'],
                'antrean_id' => (int) $terpilih['antrean_id'],
                'nomor_antrean' => (int) $terpilih['nomor_antrean'],
                'jenis_antrean' => $terpilih['jenis_antrean'],
                'status_layanan' => 'DILAYANI',
                'riwayat_panggilan_id' => $panggilanId,
            ];

        } catch (Throwable $e) {
            $this->db->transRollback();
            throw $e;
        }
    }

    /**
     * PANGGIL ULANG
     */
    public function panggilUlang(
        int $petugasId,
        int $riwayatLayananId
    ): array {
        $target = $this->db->table('riwayat_layanan')
            ->select('instansi_id')
            ->where('id', $riwayatLayananId)
            ->get()
            ->getRowArray();

        if (!$target) {
            throw new RuntimeException(
                'Riwayat layanan tidak ditemukan.'
            );
        }

        $this->validasiPetugasInstansi(
            $petugasId,
            (int) $target['instansi_id']
        );

        $this->db->transBegin();

        try {
            $kelompokId = $this->kunciSuaraKelompok(
                (int) $target['instansi_id']
            );

            $this->kunciPetugas($petugasId);

            $row = $this->kunciRiwayat($riwayatLayananId);

            $this->validasiPetugasInstansi(
                $petugasId,
                (int) $row['instansi_id']
            );

            if (
                (int) $row['instansi_id'] !== (int) $target['instansi_id']
                || (int) $row['petugas_id'] !== $petugasId
                || !in_array(
                    $row['status_layanan'],
                    ['DIPANGGIL', 'DILAYANI'],
                    true
                )
            ) {
                throw new RuntimeException(
                    'Antrean tidak dapat dipanggil ulang.'
                );
            }

            $panggilanId = $this->catatPanggilan(
                $riwayatLayananId,
                $petugasId,
                'Panggilan ulang'
            );

            $this->mulaiSuaraKelompok(
                $kelompokId,
                $panggilanId
            );

            $this->cekTransaksi();

            $this->db->transCommit();

            return [
                'riwayat_layanan_id' => $riwayatLayananId,
                'aksi' => 'PANGGIL',
                'riwayat_panggilan_id' => $panggilanId,
            ];

        } catch (Throwable $e) {
            $this->db->transRollback();
            throw $e;
        }
    }

    /**
     * KONFIRMASI STATUS LAYANAN
     */
    public function konfirmasiStatus(
        int $petugasId,
        int $riwayatLayananId,
        string $status,
        ?int $layananId = null,
        ?string $keterangan = null
    ): array {
        $status = strtoupper(trim($status));

        if (!in_array($status, ['SELESAI', 'PENDING'], true)) {
            throw new RuntimeException(
                'Status harus SELESAI atau PENDING.'
            );
        }

        $this->db->transBegin();

        try {
            $this->kunciPetugas($petugasId);

            $row = $this->kunciRiwayat($riwayatLayananId);

            $this->validasiPetugasInstansi(
                $petugasId,
                (int) $row['instansi_id']
            );

            if (
                (int) $row['petugas_id'] !== $petugasId
                || !in_array(
                    $row['status_layanan'],
                    ['DIPANGGIL', 'DILAYANI'],
                    true
                )
            ) {
                throw new RuntimeException(
                    'Antrean tidak sedang dilayani oleh petugas ini.'
                );
            }

            if ($status === 'SELESAI') {
                if (!$layananId) {
                    throw new RuntimeException(
                        'Detail layanan wajib dipilih.'
                    );
                }

                $this->validasiLayanan(
                    $layananId,
                    (int) $row['instansi_id']
                );
            }

            $waktu = date('Y-m-d H:i:s');

            $this->db->table('riwayat_layanan')
                ->where('id', $riwayatLayananId)
                ->update([
                    'status_layanan' => $status,
                    'layanan_id' => $status === 'SELESAI'
                        ? $layananId
                        : null,
                    'waktu_selesai' => $status === 'SELESAI'
                        ? $waktu
                        : null,
                    'keterangan' => $keterangan,
                    'updated_at' => $waktu,
                ]);

            $this->cekTransaksi();

            $this->db->transCommit();

            return $this->getRiwayatLayanan(
                $riwayatLayananId
            ) ?? [];

        } catch (Throwable $e) {
            $this->db->transRollback();
            throw $e;
        }
    }

    /**
     * PANGGIL ANTREAN PENDING
     */
    public function panggilPending(
        int $petugasId,
        int $riwayatLayananId
    ): array {
        $target = $this->db->table('riwayat_layanan')
            ->select('instansi_id')
            ->where('id', $riwayatLayananId)
            ->get()
            ->getRowArray();

        if (!$target) {
            throw new RuntimeException(
                'Riwayat layanan tidak ditemukan.'
            );
        }

        $this->validasiPetugasInstansi(
            $petugasId,
            (int) $target['instansi_id']
        );

        $this->db->transBegin();

        try {
            $kelompokId = $this->kunciSuaraKelompok(
                (int) $target['instansi_id']
            );

            $this->kunciPetugas($petugasId);

            $this->pastikanBelumAktif($petugasId);

            $row = $this->kunciRiwayat($riwayatLayananId);

            $this->validasiPetugasInstansi(
                $petugasId,
                (int) $row['instansi_id']
            );

            if (
                (int) $row['instansi_id'] !== (int) $target['instansi_id']
                || $row['status_layanan'] !== 'PENDING'
            ) {
                throw new RuntimeException(
                    'Antrean tidak berstatus pending.'
                );
            }

            $waktu = date('Y-m-d H:i:s');

            $this->db->table('riwayat_layanan')
                ->where('id', $riwayatLayananId)
                ->update([
                    'status_layanan' => 'DILAYANI',
                    'petugas_id' => $petugasId,
                    'waktu_mulai' => $waktu,
                    'waktu_selesai' => null,
                    'updated_at' => $waktu,
                ]);

            if ($this->db->affectedRows() !== 1) {
                throw new RuntimeException(
                    'Gagal mengaktifkan kembali antrean pending.'
                );
            }

            $panggilanId = $this->catatPanggilan(
                $riwayatLayananId,
                $petugasId,
                'Pemanggilan kembali dari PENDING'
            );

            $this->mulaiSuaraKelompok(
                $kelompokId,
                $panggilanId
            );

            $this->cekTransaksi();

            $this->db->transCommit();

            $hasil = $this->getRiwayatLayanan(
                $riwayatLayananId
            ) ?? [];

            $hasil['riwayat_panggilan_id'] = $panggilanId;

            return $hasil;

        } catch (Throwable $e) {
            $this->db->transRollback();
            throw $e;
        }
    }

    /**
     * TERUSAN ANTREAN
     */
    public function terusanAntrean(
        int $petugasId,
        int $riwayatLayananId,
        int $layananId,
        int $instansiTujuanId,
        ?string $keterangan = null
    ): array {
        $this->db->transBegin();

        try {
            $this->kunciPetugas($petugasId);

            $row = $this->kunciRiwayat($riwayatLayananId);

            $this->validasiPetugasInstansi(
                $petugasId,
                (int) $row['instansi_id']
            );

            if (
                (int) $row['petugas_id'] !== $petugasId
                || !in_array(
                    $row['status_layanan'],
                    ['DIPANGGIL', 'DILAYANI'],
                    true
                )
            ) {
                throw new RuntimeException(
                    'Antrean tidak sedang dilayani oleh petugas ini.'
                );
            }

            $this->validasiLayanan(
                $layananId,
                (int) $row['instansi_id']
            );

            $this->validasiInstansi($instansiTujuanId);

            if ((int) $row['instansi_id'] === $instansiTujuanId) {
                throw new RuntimeException(
                    'Instansi tujuan tidak boleh sama dengan instansi asal.'
                );
            }

            $ada = $this->db->table('riwayat_layanan')
                ->where('antrean_id', $row['antrean_id'])
                ->where('instansi_id', $instansiTujuanId)
                ->whereIn(
                    'status_layanan',
                    ['MENUNGGU', 'DIPANGGIL', 'DILAYANI', 'PENDING']
                )
                ->countAllResults();

            if ($ada) {
                throw new RuntimeException(
                    'Antrean sudah aktif di instansi tujuan.'
                );
            }

            $waktu = date('Y-m-d H:i:s');

            $this->db->table('riwayat_layanan')
                ->where('id', $riwayatLayananId)
                ->update([
                    'status_layanan' => 'SELESAI',
                    'layanan_id' => $layananId,
                    'waktu_selesai' => $waktu,
                    'keterangan' => $keterangan,
                    'updated_at' => $waktu,
                ]);

            $this->db->table('riwayat_layanan')->insert([
                'antrean_id' => $row['antrean_id'],
                'instansi_id' => $instansiTujuanId,
                'layanan_id' => null,
                'petugas_id' => null,
                'status_layanan' => 'MENUNGGU',
                'waktu_masuk' => $waktu,
                'waktu_mulai' => null,
                'waktu_selesai' => null,
                'keterangan' => null,
                'created_at' => $waktu,
                'updated_at' => $waktu,
            ]);

            $idBaru = (int) $this->db->insertID();

            if ($idBaru < 1) {
                throw new RuntimeException(
                    'Gagal membuat antrean terusan.'
                );
            }

            $this->cekTransaksi();

            $this->db->transCommit();

            return $this->getRiwayatLayanan($idBaru) ?? [];

        } catch (Throwable $e) {
            $this->db->transRollback();
            throw $e;
        }
    }

    /**
     * DATA ANTREAN PETUGAS
     */
    public function getAntreanPetugas(int $petugasId): array
    {
        $user = $this->petugas($petugasId);

        return $this->db->table('riwayat_layanan rl')
            ->select(
                'rl.*, a.nomor_antrean, a.tanggal_antrean, a.jenis_antrean'
            )
            ->join('antrean a', 'a.id = rl.antrean_id')
            ->where('rl.instansi_id', (int) $user['instansi_id'])
            ->where('a.tanggal_antrean', date('Y-m-d'))
            ->orderBy('rl.waktu_masuk', 'ASC')
            ->get()
            ->getResultArray();
    }

    public function getAntreanSedangDilayani(
        int $instansiId
    ): array {
        return $this->db->table('riwayat_layanan rl')
            ->select(
                'rl.*, a.nomor_antrean, a.tanggal_antrean, a.jenis_antrean'
            )
            ->join('antrean a', 'a.id = rl.antrean_id')
            ->where('rl.instansi_id', $instansiId)
            ->where('a.tanggal_antrean', date('Y-m-d'))
            ->whereIn(
                'rl.status_layanan',
                ['DIPANGGIL', 'DILAYANI']
            )
            ->get()
            ->getResultArray();
    }

    public function getAntreanSelanjutnya(
        int $instansiId
    ): array {
        return $this->db->table('riwayat_layanan rl')
            ->select(
                'rl.*, a.nomor_antrean, a.tanggal_antrean, a.jenis_antrean'
            )
            ->join('antrean a', 'a.id = rl.antrean_id')
            ->where('rl.instansi_id', $instansiId)
            ->where('a.tanggal_antrean', date('Y-m-d'))
            ->where('rl.status_layanan', 'MENUNGGU')
            ->orderBy('a.jenis_antrean', 'DESC')
            ->orderBy('rl.waktu_masuk', 'ASC')
            ->orderBy('rl.id', 'ASC')
            ->get()
            ->getResultArray();
    }

    public function getAntreanMenunggu(
        int $instansiId
    ): array {
        return $this->getAntreanSelanjutnya($instansiId);
    }

    public function getAntreanSudahDipanggil(
        int $instansiId
    ): array {
        return $this->db->table('riwayat_layanan rl')
            ->select(
                'rl.*, a.nomor_antrean, a.tanggal_antrean, a.jenis_antrean'
            )
            ->join('antrean a', 'a.id = rl.antrean_id')
            ->where('rl.instansi_id', $instansiId)
            ->where('a.tanggal_antrean', date('Y-m-d'))
            ->whereIn(
                'rl.status_layanan',
                ['DIPANGGIL', 'DILAYANI', 'PENDING', 'SELESAI']
            )
            ->orderBy('rl.updated_at', 'DESC')
            ->get()
            ->getResultArray();
    }

    public function getRiwayatLayanan(
        int $riwayatLayananId
    ): ?array {
        return $this->db->table('riwayat_layanan rl')
            ->select(
                'rl.*, a.nomor_antrean, a.tanggal_antrean, a.jenis_antrean'
            )
            ->join('antrean a', 'a.id = rl.antrean_id')
            ->where('rl.id', $riwayatLayananId)
            ->get()
            ->getRowArray();
    }
}