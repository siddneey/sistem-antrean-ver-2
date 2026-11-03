<?php

namespace App\Services;

use CodeIgniter\Database\BaseConnection;
use DateTimeImmutable;
use DateTimeZone;
use RuntimeException;

class DisplayService
{
    protected BaseConnection $db;

    public function __construct()
    {
        $this->db = db_connect();
    }

    public function getDisplayByKelompokDanGrup(
        int $kelompokId,
        int $grupId
    ): array {
        if ($kelompokId < 1 || $grupId < 1) {
            throw new RuntimeException(
                'ID kelompok atau grup tidak valid.'
            );
        }

        // Kelompok audio dan Grup tampilan independen.
        $kelompok = $this->db->table('kelompok')
            ->where('id', $kelompokId)
            ->get()
            ->getRowArray();

        $grupAktif = $this->db->table('grup')
            ->where('id', $grupId)
            ->get()
            ->getRowArray();

        if (!$kelompok || !$grupAktif) {
            throw new RuntimeException(
                'Kelompok atau grup tidak ditemukan.'
            );
        }

        $tanggal = (new DateTimeImmutable(
            'now',
            new DateTimeZone('Asia/Jakarta')
        ))->format('Y-m-d');

        $grup = $this->db->table('grup')
            ->orderBy('nama_grup', 'ASC')
            ->get()
            ->getResultArray();

        // Instansi hanya untuk Grup tampilan yang dipilih.
        $instansi = $this->db->table('instansi')
            ->select('id, grup_id, nama_instansi, logo')
            ->where('grup_id', $grupId)
            ->orderBy('nama_instansi', 'ASC')
            ->get()
            ->getResultArray();

        /*
         * Ambil riwayat layanan hari ini secara global.
         */
        $rows = $this->db->table('riwayat_layanan rl')
            ->select(
                'rl.id AS riwayat_layanan_id, ' .
                'rl.antrean_id, rl.instansi_id, ' .
                'rl.status_layanan, rl.waktu_masuk, ' .
                'a.nomor_antrean, a.jenis_antrean, ' .
                'a.waktu_ambil, i.nama_instansi, ' .
                'i.grup_id'
            )
            ->join(
                'antrean a',
                'a.id = rl.antrean_id'
            )
            ->join(
                'instansi i',
                'i.id = rl.instansi_id'
            )
            ->where('a.tanggal_antrean', $tanggal)
            ->orderBy('rl.id', 'DESC')
            ->get()
            ->getResultArray();

        /*
         * Ambil status terakhir per antrean dan instansi.
         */
        $terakhir = [];

        foreach ($rows as $row) {
            $key = $row['antrean_id'] . ':' .
                $row['instansi_id'];

            if (!isset($terakhir[$key])) {
                $terakhir[$key] = $row;
            }
        }

        /*
         * Ambil antrean yang sudah pernah dipanggil.
         */
        $panggilanIds = [];

        $panggilanHariIni = $this->db
            ->table('riwayat_panggilan rp')
            ->select('rp.riwayat_layanan_id')
            ->join(
                'riwayat_layanan rl',
                'rl.id = rp.riwayat_layanan_id'
            )
            ->join(
                'antrean a',
                'a.id = rl.antrean_id'
            )
            ->where('a.tanggal_antrean', $tanggal)
            ->where('rp.aksi', 'PANGGIL')
            ->get()
            ->getResultArray();

        foreach ($panggilanHariIni as $panggilan) {
            $panggilanIds[
                (int) $panggilan['riwayat_layanan_id']
            ] = true;
        }

        /*
         * Ringkasan instansi pada Grup aktif.
         */
        $ringkasan = [];

        foreach ($instansi as $item) {
            $id = (int) $item['id'];

            $ringkasan[$id] = [
                'instansi_id' => $id,
                'nama_instansi' => $item['nama_instansi'],
                'menunggu' => 0,
                'total' => 0,
            ];
        }

        $antrean = [];

        foreach ($terakhir as $row) {
            $instansiId = (int) $row['instansi_id'];

            $status = strtoupper(trim(
                (string) $row['status_layanan']
            ));

            $jenis = strtoupper(trim(
                (string) $row['jenis_antrean']
            ));

            $sudahDipanggil = isset(
                $panggilanIds[
                    (int) $row['riwayat_layanan_id']
                ]
            );

            $menunggu = (
                $status === 'MENUNGGU'
                && !$sudahDipanggil
            );

            if (isset($ringkasan[$instansiId])) {
                $ringkasan[$instansiId]['total']++;

                if ($menunggu) {
                    $ringkasan[$instansiId]['menunggu']++;
                }
            }

            if (!$menunggu) {
                continue;
            }

            $waktu = $row['waktu_masuk']
                ?: $row['waktu_ambil'];

            $nomor = (string) $row['nomor_antrean'];

            $antrean[] = [
                'riwayat_layanan_id' =>
                    (int) $row['riwayat_layanan_id'],
                'antrean_id' =>
                    (int) $row['antrean_id'],
                'instansi_id' => $instansiId,
                'grup_id' => (int) $row['grup_id'],
                'nomor_antrean' => $nomor,
                'nomor' => $nomor,
                'jenis_antrean' => $jenis,
                'prioritas' => $jenis === 'PRIORITAS',
                'jam' => $waktu
                    ? date('H:i', strtotime($waktu))
                    : '-',
                'waktu_masuk' => $waktu,
                'instansi' => $row['nama_instansi'],
                'nama_instansi' => $row['nama_instansi'],
                'status' => 'MENUNGGU',
            ];
        }

        /*
         * Prioritas di atas, lalu waktu terlama.
         */
        usort(
            $antrean,
            static function (array $a, array $b): int {
                if ($a['prioritas'] !== $b['prioritas']) {
                    return $a['prioritas'] ? -1 : 1;
                }

                $hasil = strcmp(
                    (string) $a['waktu_masuk'],
                    (string) $b['waktu_masuk']
                );

                return $hasil ?: (
                    $a['riwayat_layanan_id']
                    <=> $b['riwayat_layanan_id']
                );
            }
        );

        /*
         * Riwayat visual berdasarkan Grup.
         */
        $riwayatTampilan = $this->ambilRiwayatPanggilan(
            $tanggal,
            $grupId,
            null
        );

        /*
         * Riwayat audio berdasarkan Kelompok.
         */
        $riwayatAudio = $this->ambilRiwayatPanggilan(
            $tanggal,
            null,
            $kelompokId
        );

        $panggilanTerbaru = $riwayatAudio[0] ?? null;

        /*
         * Baca status lock audio Kelompok.
         */
        $statusPanggilan = strtoupper(trim(
            (string) ($kelompok['status_panggilan'] ?? 'IDLE')
        ));

        $riwayatPanggilanAktifId = isset(
            $kelompok['riwayat_panggilan_aktif_id']
        )
            ? (int) $kelompok['riwayat_panggilan_aktif_id']
            : 0;

        /*
         * Cari detail panggilan yang sedang aktif.
         */
        $panggilanAktif = null;

        if (
            $statusPanggilan === 'PLAYING'
            && $riwayatPanggilanAktifId > 0
        ) {
            foreach ($riwayatAudio as $item) {
                if (
                    (int) $item['riwayat_panggilan_id']
                    === $riwayatPanggilanAktifId
                ) {
                    $panggilanAktif = $item;
                    break;
                }
            }
        }

        /*
         * Panggilan visual terbaru per instansi.
         */
        $panggilanPerInstansi = [];

        foreach ($riwayatTampilan as $panggilan) {
            $id = (int) $panggilan['instansi_id'];

            if (!isset($panggilanPerInstansi[$id])) {
                $panggilanPerInstansi[$id] = $panggilan;
            }
        }

        foreach ($instansi as &$item) {
            $id = (int) $item['id'];

            $panggilan = $panggilanPerInstansi[$id]
                ?? null;

            $item['id'] = $id;
            $item['grup_id'] = (int) $item['grup_id'];
            $item['nama'] = $item['nama_instansi'];
            $item['panggilan'] = $panggilan;

            $item['nomor'] = $panggilan
                ? (string) $panggilan['nomor_antrean']
                : '';

            $item['status'] = $panggilan
                ? 'DIPANGGIL'
                : 'MENUNGGU';

            $item['menunggu'] =
                $ringkasan[$id]['menunggu'] ?? 0;

            $item['total'] =
                $ringkasan[$id]['total'] ?? 0;
        }

        unset($item);

        return [
            'kelompok' => [
                'id' => (int) $kelompok['id'],
                'nama_kelompok' =>
                    $kelompok['nama_kelompok'],
                'suara' => $kelompok['suara'] ?? null,

                'status_panggilan' => $statusPanggilan,

                'riwayat_panggilan_aktif_id' =>
                    $riwayatPanggilanAktifId,

                'panggilan_aktif' => $panggilanAktif,
            ],

            'grup_aktif' => [
                'id' => (int) $grupAktif['id'],
                'kelompok_id' =>
                    (int) $grupAktif['kelompok_id'],
                'nama_grup' => $grupAktif['nama_grup'],
            ],

            'grup' => $grup,
            'instansi' => $instansi,
            'antrean' => $antrean,
            'ringkasan' => array_values($ringkasan),

            'riwayat_panggilan' => $riwayatTampilan,
            'riwayat_panggilan_audio' => $riwayatAudio,
            'panggilan_terbaru' => $panggilanTerbaru,

            // Alias di tingkat utama untuk kebutuhan JavaScript.
            'panggilan_audio_aktif' => $panggilanAktif,
        ];
    }

    protected function ambilRiwayatPanggilan(
        string $tanggal,
        ?int $grupId,
        ?int $kelompokId
    ): array {
        $query = $this->db
            ->table('riwayat_panggilan rp')
            ->select(
                'rp.id AS riwayat_panggilan_id, ' .
                'rp.waktu, rp.aksi, ' .
                'rl.instansi_id, a.nomor_antrean, ' .
                'a.jenis_antrean, i.nama_instansi, ' .
                'i.grup_id'
            )
            ->join(
                'riwayat_layanan rl',
                'rl.id = rp.riwayat_layanan_id'
            )
            ->join(
                'antrean a',
                'a.id = rl.antrean_id'
            )
            ->join(
                'instansi i',
                'i.id = rl.instansi_id'
            )
            ->join(
                'grup g',
                'g.id = i.grup_id'
            )
            ->where('a.tanggal_antrean', $tanggal)
            ->where('rp.aksi', 'PANGGIL');

        if ($grupId !== null) {
            $query->where('i.grup_id', $grupId);
        }

        if ($kelompokId !== null) {
            $query->where(
                'g.kelompok_id',
                $kelompokId
            );
        }

        $rows = $query
            ->orderBy('rp.id', 'DESC')
            ->limit(100)
            ->get()
            ->getResultArray();

        foreach ($rows as &$row) {
            $row['riwayat_panggilan_id'] =
                (int) $row['riwayat_panggilan_id'];

            $row['instansi_id'] =
                (int) $row['instansi_id'];

            $row['grup_id'] =
                (int) $row['grup_id'];

            $row['nomor_antrean'] =
                (string) $row['nomor_antrean'];
        }

        unset($row);

        return $rows;
    }

    public function getPanggilanTerbaruByKelompokDanGrup(
        int $kelompokId,
        int $grupId
    ): ?array {
        $data = $this->getDisplayByKelompokDanGrup(
            $kelompokId,
            $grupId
        );

        return $data['panggilan_terbaru'];
    }

    public function isPanggilanTerbaru(
        int $kelompokId,
        int $grupId,
        int $riwayatPanggilanId
    ): bool {
        $terbaru = $this
            ->getPanggilanTerbaruByKelompokDanGrup(
                $kelompokId,
                $grupId
            );

        return $terbaru !== null
            && (int) $terbaru['riwayat_panggilan_id']
                === $riwayatPanggilanId;
    }
}