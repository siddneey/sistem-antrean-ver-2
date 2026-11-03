<?php

namespace App\Services;

use CodeIgniter\Database\BaseConnection;
use DateTimeImmutable;
use DateTimeZone;
use RuntimeException;

class SubdisplayService
{
    protected BaseConnection $db;

    public function __construct()
    {
        $this->db = db_connect();
    }

    /**
     * Mengambil seluruh data Subdisplay berdasarkan Grup.
     *
     * Tidak menggunakan data Kelompok Suara.
     * Tidak mengambil atau memproses status audio.
     */
    public function getSubdisplayByGrup(int $grupId): array
    {
        if ($grupId < 1) {
            throw new RuntimeException('ID grup tidak valid.');
        }

        /*
        |--------------------------------------------------------------------------
        | GRUP AKTIF
        |--------------------------------------------------------------------------
        */

        $grupAktif = $this->db
            ->table('grup')
            ->where('id', $grupId)
            ->get()
            ->getRowArray();

        if (!$grupAktif) {
            throw new RuntimeException('Grup tidak ditemukan.');
        }

        /*
        |--------------------------------------------------------------------------
        | TANGGAL HARI INI
        |--------------------------------------------------------------------------
        */

        $tanggal = (new DateTimeImmutable(
            'now',
            new DateTimeZone('Asia/Jakarta')
        ))->format('Y-m-d');

        /*
        |--------------------------------------------------------------------------
        | SELURUH GRUP
        |--------------------------------------------------------------------------
        */

        $grup = $this->db
            ->table('grup')
            ->orderBy('nama_grup', 'ASC')
            ->get()
            ->getResultArray();

        /*
        |--------------------------------------------------------------------------
        | INSTANSI DALAM GRUP TERPILIH
        |--------------------------------------------------------------------------
        */

        $instansi = $this->db
            ->table('instansi')
            ->select('id, grup_id, nama_instansi, logo')
            ->where('grup_id', $grupId)
            ->orderBy('nama_instansi', 'ASC')
            ->get()
            ->getResultArray();

        /*
        |--------------------------------------------------------------------------
        | RIWAYAT LAYANAN HARI INI
        |--------------------------------------------------------------------------
        */

        $rows = $this->db
            ->table('riwayat_layanan rl')
            ->select(
                'rl.id AS riwayat_layanan_id,
                 rl.antrean_id,
                 rl.instansi_id,
                 rl.status_layanan,
                 rl.waktu_masuk,
                 a.nomor_antrean,
                 a.jenis_antrean,
                 a.waktu_ambil,
                 i.nama_instansi,
                 i.grup_id'
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
            ->where('i.grup_id', $grupId)
            ->orderBy('rl.id', 'DESC')
            ->get()
            ->getResultArray();

        /*
        |--------------------------------------------------------------------------
        | STATUS TERAKHIR PER ANTREAN DAN INSTANSI
        |--------------------------------------------------------------------------
        */

        $terakhir = [];

        foreach ($rows as $row) {
            $key = $row['antrean_id']
                . ':'
                . $row['instansi_id'];

            if (!isset($terakhir[$key])) {
                $terakhir[$key] = $row;
            }
        }

        /*
        |--------------------------------------------------------------------------
        | ID LAYANAN YANG SUDAH PERNAH DIPANGGIL
        |--------------------------------------------------------------------------
        */

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
            ->join(
                'instansi i',
                'i.id = rl.instansi_id'
            )
            ->where('a.tanggal_antrean', $tanggal)
            ->where('i.grup_id', $grupId)
            ->where('rp.aksi', 'PANGGIL')
            ->get()
            ->getResultArray();

        $panggilanIds = [];

        foreach ($panggilanHariIni as $panggilan) {
            $panggilanIds[
                (int) $panggilan['riwayat_layanan_id']
            ] = true;
        }

        /*
        |--------------------------------------------------------------------------
        | RINGKASAN INSTANSI
        |--------------------------------------------------------------------------
        */

        $ringkasan = [];

        foreach ($instansi as $item) {
            $id = (int) $item['id'];

            $ringkasan[$id] = [
                'instansi_id'   => $id,
                'nama_instansi' => $item['nama_instansi'],
                'menunggu'      => 0,
                'total'         => 0,
            ];
        }

        /*
        |--------------------------------------------------------------------------
        | DATA ANTREAN MENUNGGU
        |--------------------------------------------------------------------------
        */

        $antrean = [];

        foreach ($terakhir as $row) {
            $instansiId = (int) $row['instansi_id'];

            // Pastikan antrean hanya berasal dari Grup terpilih.
            if (!isset($ringkasan[$instansiId])) {
                continue;
            }

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

            $ringkasan[$instansiId]['total']++;

            if ($menunggu) {
                $ringkasan[$instansiId]['menunggu']++;
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

                'instansi_id' =>
                    $instansiId,

                'grup_id' =>
                    (int) $row['grup_id'],

                'nomor_antrean' =>
                    $nomor,

                'nomor' =>
                    $nomor,

                'jenis_antrean' =>
                    $jenis,

                'prioritas' =>
                    $jenis === 'PRIORITAS',

                'jam' => $waktu
                    ? date('H:i', strtotime($waktu))
                    : '-',

                'waktu_masuk' =>
                    $waktu,

                'instansi' =>
                    $row['nama_instansi'],

                'nama_instansi' =>
                    $row['nama_instansi'],

                'status' =>
                    'MENUNGGU',
            ];
        }

        /*
        |--------------------------------------------------------------------------
        | URUTAN ANTREAN
        |--------------------------------------------------------------------------
        |
        | Prioritas terlebih dahulu.
        | Setelah itu berdasarkan waktu masuk paling lama.
        |
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
        |--------------------------------------------------------------------------
        | RIWAYAT PANGGILAN VISUAL
        |--------------------------------------------------------------------------
        |
        | Hanya mengambil riwayat panggilan dari Grup terpilih.
        |
        */

        $riwayatTampilan = $this->ambilRiwayatPanggilan(
            $tanggal,
            $grupId
        );

        /*
        |--------------------------------------------------------------------------
        | PANGGILAN TERAKHIR PER INSTANSI
        |--------------------------------------------------------------------------
        */

        $panggilanPerInstansi = [];

        foreach ($riwayatTampilan as $panggilan) {
            $id = (int) $panggilan['instansi_id'];

            if (!isset($panggilanPerInstansi[$id])) {
                $panggilanPerInstansi[$id] = $panggilan;
            }
        }

        /*
        |--------------------------------------------------------------------------
        | MELENGKAPI DATA INSTANSI
        |--------------------------------------------------------------------------
        */

        foreach ($instansi as &$item) {
            $id = (int) $item['id'];

            $panggilan = $panggilanPerInstansi[$id] ?? null;

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

        /*
        |--------------------------------------------------------------------------
        | HASIL SUBDISPLAY
        |--------------------------------------------------------------------------
        */

        return [
            'grup_aktif' => [
                'id' => (int) $grupAktif['id'],

                'kelompok_id' =>
                    (int) $grupAktif['kelompok_id'],

                'nama_grup' =>
                    $grupAktif['nama_grup'],
            ],

            'grup' =>
                $grup,

            'instansi' =>
                $instansi,

            'antrean' =>
                $antrean,

            'ringkasan' =>
                array_values($ringkasan),

            'riwayat_panggilan' =>
                $riwayatTampilan,

            'panggilan_terbaru' =>
                $riwayatTampilan[0] ?? null,
        ];
    }

    /**
     * Mengambil riwayat panggilan visual
     * berdasarkan tanggal dan Grup.
     */
    protected function ambilRiwayatPanggilan(
        string $tanggal,
        int $grupId
    ): array {
        $rows = $this->db
            ->table('riwayat_panggilan rp')
            ->select(
                'rp.id AS riwayat_panggilan_id,
                 rp.waktu,
                 rp.aksi,
                 rl.instansi_id,
                 a.nomor_antrean,
                 a.jenis_antrean,
                 i.nama_instansi,
                 i.grup_id'
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
            ->where('a.tanggal_antrean', $tanggal)
            ->where('rp.aksi', 'PANGGIL')
            ->where('i.grup_id', $grupId)
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
}