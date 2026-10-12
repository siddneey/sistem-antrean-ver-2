<?php

namespace App\Services;

use App\Models\AntreanModel;
use App\Models\RiwayatLayananModel;
use App\Models\RiwayatPanggilanModel;

use CodeIgniter\Database\BaseConnection;
use RuntimeException;

class PelayananService
{
    protected BaseConnection $db;

    protected AntreanModel $antreanModel;
    protected RiwayatLayananModel $riwayatLayananModel;
    protected RiwayatPanggilanModel $riwayatPanggilanModel;

    public function __construct()
    {
        $this->db = db_connect();

        $this->antreanModel = new AntreanModel();
        $this->riwayatLayananModel = new RiwayatLayananModel();
        $this->riwayatPanggilanModel = new RiwayatPanggilanModel();
    }

    /*
    |--------------------------------------------------------------------------
    | SELANJUTNYA / PANGGIL ANTREAN BERIKUTNYA
    |--------------------------------------------------------------------------
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
            // Cari semua kandidat MENUNGGU
            $kandidat = $this->db
                ->table('riwayat_layanan')
                ->select([
                    'id AS riwayat_layanan_id',
                    'antrean_id',
                    'instansi_id',
                    'layanan_id',
                    'status_layanan',
                    'waktu_masuk',
                ])
                ->where(
                    'instansi_id',
                    $instansiId
                )
                ->where(
                    'status_layanan',
                    'MENUNGGU'
                )
                ->orderBy(
                    'waktu_masuk',
                    'ASC'
                )
                ->orderBy(
                    'id',
                    'ASC'
                )
                ->get()
                ->getResultArray();


            if (!$kandidat) {
                throw new RuntimeException(
                    'Tidak ada antrean yang dapat dipanggil.'
                );
            }

            $hasilKandidat = $this->db
                ->table('riwayat_layanan rl')
                ->select([
                    'rl.id AS riwayat_layanan_id',
                    'rl.antrean_id',
                    'rl.instansi_id',
                    'rl.layanan_id',
                    'rl.status_layanan',
                    'rl.waktu_masuk',
                    'a.nomor_antrean',
                    'a.tanggal_antrean',
                    'a.jenis_antrean',
                ])
                ->join('antrean a', 'a.id = rl.antrean_id')
                ->where('rl.instansi_id', $instansiId)
                ->where('rl.status_layanan', 'MENUNGGU')
                ->where('a.tanggal_antrean', date('Y-m-d'))
                ->orderBy('rl.waktu_masuk', 'ASC')
                ->orderBy('rl.id', 'ASC')
                ->get()
                ->getResultArray();

            if (!$hasilKandidat) {
                throw new RuntimeException(
                    'Tidak ada antrean yang dapat dipanggil.'
                );
            }

            // Urutan Antrean (PRIORITAS → BIASA → FIFO)
            usort(
                $hasilKandidat,
                static function (array $a, array $b): int {
                    $prioritasA =
                        $a['jenis_antrean'] === 'PRIORITAS'
                            ? 0
                            : 1;

                    $prioritasB =
                        $b['jenis_antrean'] === 'PRIORITAS'
                            ? 0
                            : 1;

                    if ($prioritasA !== $prioritasB) {
                        return $prioritasA <=> $prioritasB;
                    }

                    $waktuA = strtotime($a['waktu_masuk']);
                    $waktuB = strtotime($b['waktu_masuk']);

                    if ($waktuA !== $waktuB) {
                        return $waktuA <=> $waktuB;
                    }

                    return (int) $a['riwayat_layanan_id']
                        <=> (int) $b['riwayat_layanan_id'];
                }
            );

            // Cari kandidat yang berhasil dikunci
            $antreanTerpilih = null;

            foreach ($hasilKandidat as $row) {
                $locked = $this->db
                    ->query(
                        'SELECT id, antrean_id, instansi_id, status_layanan
                         FROM riwayat_layanan
                         WHERE id = ?
                         FOR UPDATE',
                        [
                            $row['riwayat_layanan_id'],
                        ]
                    )
                    ->getRowArray();

                if (!$locked) {
                    continue;
                }

                if ($locked['status_layanan'] !== 'MENUNGGU') {
                    continue;
                }

                if ((int) $locked['instansi_id'] !== $instansiId) {
                    continue;
                }

                $row['antrean_id'] =
                    (int) $locked['antrean_id'];

                $antreanTerpilih = $row;
                break;
            }

            if (!$antreanTerpilih) {
                throw new RuntimeException(
                    'Semua antrean yang tersedia sudah diproses oleh petugas lain.'
                );
            }

            $waktuPanggil = date('Y-m-d H:i:s');

            // PANGGIL PERTAMA
            $this->db
                ->table('riwayat_layanan')
                ->where(
                    'id',
                    $antreanTerpilih['riwayat_layanan_id']
                )
                ->update([
                    'status_layanan' => 'DILAYANI',
                    'petugas_id' => $petugasId,
                    'waktu_mulai' => $waktuPanggil,
                    'updated_at' => $waktuPanggil,
                ]);

            if ($this->db->affectedRows() < 1) {
                throw new RuntimeException(
                    'Gagal mengubah status antrean menjadi DILAYANI.'
                );
            }

            // Catat panggilan pertama
            $this->db
                ->table('riwayat_panggilan')
                ->insert([
                    'riwayat_layanan_id' =>
                        $antreanTerpilih['riwayat_layanan_id'],

                    'petugas_id' =>
                        $petugasId,

                    'aksi' =>
                        'PANGGIL',

                    'waktu' =>
                        $waktuPanggil,

                    'keterangan' =>
                        null,

                    'created_at' =>
                        $waktuPanggil,

                    'updated_at' =>
                        $waktuPanggil,
                ]);

            if ($this->db->transStatus() === false) {
                throw new RuntimeException(
                    'Gagal memproses pemanggilan antrean.'
                );
            }

            $this->db->transCommit();

            return [
                'riwayat_layanan_id' =>
                    (int) $antreanTerpilih['riwayat_layanan_id'],

                'antrean_id' =>
                    (int) $antreanTerpilih['antrean_id'],

                'nomor_antrean' =>
                    (int) $antreanTerpilih['nomor_antrean'],

                'jenis_antrean' =>
                    $antreanTerpilih['jenis_antrean'],

                'instansi_id' =>
                    (int) $antreanTerpilih['instansi_id'],

                'petugas_id' =>
                    $petugasId,

                'status_layanan' =>
                    'DILAYANI',

                'aksi' =>
                    'PANGGIL',

                'waktu' =>
                    $waktuPanggil,
            ];

        } catch (\Throwable $e) {
            $this->db->transRollback();

            throw $e;
        }
    }

    /*
    |--------------------------------------------------------------------------
    | ULANGI PANGGILAN
    |--------------------------------------------------------------------------
    */

    public function panggilUlang(
        int $petugasId,
        int $riwayatLayananId
    ): array {
        $this->db->transBegin();

        try {
            $riwayat = $this->getRiwayatDenganLock(
                $riwayatLayananId
            );

            if (!$riwayat) {
                throw new RuntimeException(
                    'Riwayat layanan tidak ditemukan.'
                );
            }

            // Pastikan petugas yang sama
            if (
                (int) $riwayat['petugas_id']
                !== $petugasId
            ) {
                throw new RuntimeException(
                    'Antrean ini bukan tanggung jawab petugas tersebut.'
                );
            }

            // Hanya antrean aktif yang bisa dipanggil ulang
            if (!in_array(
                $riwayat['status_layanan'],
                [
                    'DIPANGGIL',
                    'DILAYANI',
                ],
                true
            )) {
                throw new RuntimeException(
                    'Antrean tidak dapat dipanggil ulang.'
                );
            }

            $waktu = date('Y-m-d H:i:s');

            // Catat panggilan ulang
            $this->db
                ->table('riwayat_panggilan')
                ->insert([
                    'riwayat_layanan_id' =>
                        $riwayatLayananId,

                    'petugas_id' =>
                        $petugasId,

                    'aksi' =>
                        'PANGGIL',

                    'waktu' =>
                        $waktu,

                    'keterangan' =>
                        'Panggilan ulang',

                    'created_at' =>
                        $waktu,

                    'updated_at' =>
                        $waktu,
                ]);

            if ($this->db->transStatus() === false) {
                throw new RuntimeException(
                    'Gagal menyimpan riwayat panggilan ulang.'
                );
            }

            $this->db->transCommit();

            return [
                'riwayat_layanan_id' =>
                    $riwayatLayananId,

                'petugas_id' =>
                    $petugasId,

                'aksi' =>
                    'PANGGIL',

                'keterangan' =>
                    'Panggilan ulang',

                'waktu' =>
                    $waktu,
            ];

        } catch (\Throwable $e) {
            $this->db->transRollback();

            throw $e;
        }
    }

    
    /*
    |--------------------------------------------------------------------------
    | KONFIRMASI STATUS
    |--------------------------------------------------------------------------
    */

    public function konfirmasiStatus(
        int $petugasId,
        int $riwayatLayananId,
        string $status,
        ?int $layananId = null,
        ?string $keterangan = null
    ): array {
        
        // Normalisasi dan validasi status
        $status = strtoupper(trim($status));

        if (!in_array(
            $status,
            ['SELESAI', 'PENDING'],
            true
        )) {
            throw new RuntimeException(
                'Status hanya dapat berupa SELESAI atau PENDING.'
            );
        }

        $this->db->transBegin();

        try {
            // Ambil dan kunci riwayat layanan
            $riwayat = $this->getRiwayatDenganLock(
                $riwayatLayananId
            );

            if (!$riwayat) {
                throw new RuntimeException(
                    'Riwayat layanan tidak ditemukan.'
                );
            }

            // Validasi petugas yang menangani antrean
            if ((int) $riwayat['petugas_id'] !== $petugasId) {
                throw new RuntimeException(
                    'Antrean ini bukan tanggung jawab petugas tersebut.'
                );
            }

            // Pastikan antrean masih aktif
            if (!in_array(
                $riwayat['status_layanan'],
                ['DIPANGGIL', 'DILAYANI'],
                true
            )) {
                throw new RuntimeException(
                    'Antrean tidak sedang dilayani.'
                );
            }

            $waktu = date('Y-m-d H:i:s');

            // Siapkan data perubahan status SELESAI
            if ($status === 'SELESAI') {
                
                // Layanan wajib dipilih
                if ($layananId === null) {
                    throw new RuntimeException(
                        'Detail layanan wajib dipilih ketika status SELESAI.'
                    );
                }
                // Validasi layanan terhadap instansi
                $this->validasiLayanan(
                    $layananId,
                    (int) $riwayat['instansi_id']
                );

                $dataUpdate = [
                    'status_layanan' => 'SELESAI',
                    'layanan_id' => $layananId,
                    'waktu_selesai' => $waktu,
                    'keterangan' => $keterangan,
                    'updated_at' => $waktu,
                ];
            } else {
                
                // Siapkan data perubahan status PENDING
                $dataUpdate = [
                    'status_layanan' => 'PENDING',
                    'layanan_id' => null,
                    'waktu_selesai' => null,
                    'keterangan' => $keterangan,
                    'updated_at' => $waktu,
                ];
            }

            // Simpan perubahan status
            $this->db
                ->table('riwayat_layanan')
                ->where('id', $riwayatLayananId)
                ->update($dataUpdate);

            if ($this->db->transStatus() === false) {
                throw new RuntimeException(
                    'Gagal mengubah status antrean.'
                );
            }

            $this->db->transCommit();

            return $this->getRiwayatLayanan(
                $riwayatLayananId
            );

        } catch (\Throwable $e) {

            $this->db->transRollback();

            throw $e;
        }
    }

    /*
    |--------------------------------------------------------------------------
    | PANGGIL ANTREAN PENDING
    |--------------------------------------------------------------------------
    */

    public function panggilPending(
        int $petugasId,
        int $riwayatLayananId
    ): array {
        $this->db->transBegin();

        try {
            $riwayat = $this->getRiwayatDenganLock(
                $riwayatLayananId
            );

            if (!$riwayat) {
                throw new RuntimeException(
                    'Riwayat layanan tidak ditemukan.'
                );
            }

            // Pastikan petugas adalah petugas pada instansi tersebut
            $this->validasiPetugasInstansi(
                $petugasId,
                (int) $riwayat['instansi_id']
            );

            // Pastikan PENDING
            if ($riwayat['status_layanan'] !== 'PENDING') {
                throw new RuntimeException(
                    'Antrean tersebut bukan antrean PENDING.'
                );
            }

            $waktu = date('Y-m-d H:i:s');

            // Pending kembali dilayani
            $this->db
                ->table('riwayat_layanan')
                ->where(
                    'id',
                    $riwayatLayananId
                )
                ->update([
                    'status_layanan' => 'DILAYANI',
                    'petugas_id' => $petugasId,
                    'waktu_mulai' => $waktu,
                    'waktu_selesai' => null,
                    'updated_at' => $waktu,
                ]);

            // Catat panggilan
            $this->db
                ->table('riwayat_panggilan')
                ->insert([
                    'riwayat_layanan_id' =>
                        $riwayatLayananId,

                    'petugas_id' =>
                        $petugasId,

                    'aksi' =>
                        'PANGGIL',

                    'waktu' =>
                        $waktu,

                    'keterangan' =>
                        'Panggil antrean pending',

                    'created_at' =>
                        $waktu,

                    'updated_at' =>
                        $waktu,
                ]);

            if ($this->db->transStatus() === false) {
                throw new RuntimeException(
                    'Gagal memanggil antrean pending.'
                );
            }

            $this->db->transCommit();

            return [
                'riwayat_layanan_id' =>
                    $riwayatLayananId,

                'antrean_id' =>
                    (int) $riwayat['antrean_id'],

                'nomor_antrean' =>
                    $this->getNomorAntrean(
                        (int) $riwayat['antrean_id']
                    ),

                'instansi_id' =>
                    (int) $riwayat['instansi_id'],

                'petugas_id' =>
                    $petugasId,

                'status_layanan' =>
                    'DILAYANI',

                'aksi' =>
                    'PANGGIL',

                'waktu' =>
                    $waktu,
            ];

        } catch (\Throwable $e) {
            $this->db->transRollback();

            throw $e;
        }
    }

    
    /*
    |--------------------------------------------------------------------------
    | TERUSAN ANTREAN
    |--------------------------------------------------------------------------
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
            
            // Lock perjalanan layanan asal
            $riwayat = $this->getRiwayatDenganLock(
                $riwayatLayananId
            );

            if (!$riwayat) {
                throw new RuntimeException(
                    'Riwayat layanan tidak ditemukan.'
                );
            }

            // Pastikan petugas yang menangani
            if (
                (int) $riwayat['petugas_id']
                !== $petugasId
            ) {
                throw new RuntimeException(
                    'Antrean ini bukan tanggung jawab petugas tersebut.'
                );
            }

            //| Terusan hanya bisa dilakukan ketika sedang dilayani
            if (!in_array(
                $riwayat['status_layanan'],
                [
                    'DIPANGGIL',
                    'DILAYANI',
                ],
                true
            )) {
                throw new RuntimeException(
                    'Antrean tidak sedang dalam proses pelayanan.'
                );
            }
            
            // Validasi layanan asal
            $this->validasiLayanan(
                $layananId,
                (int) $riwayat['instansi_id']
            );

            // Validasi instansi tujuan
            $this->validasiInstansi(
                $instansiTujuanId
            );

            // Instansi tujuan tidak boleh sama
            if (
                (int) $riwayat['instansi_id']
                === $instansiTujuanId
            ) {
                throw new RuntimeException(
                    'Instansi tujuan tidak boleh sama dengan instansi asal.'
                );
            }

            // Cek perjalanan aktif di instansi tujuan
            $sudahAda = $this->db
                ->table('riwayat_layanan')
                ->where(
                    'antrean_id',
                    $riwayat['antrean_id']
                )
                ->where(
                    'instansi_id',
                    $instansiTujuanId
                )
                ->whereIn(
                    'status_layanan',
                    [
                        'MENUNGGU',
                        'DIPANGGIL',
                        'DILAYANI',
                        'PENDING',
                    ]
                )
                ->countAllResults();

            if ($sudahAda > 0) {
                throw new RuntimeException(
                    'Antrean sudah memiliki proses layanan aktif di instansi tujuan.'
                );
            }

            $waktu = date('Y-m-d H:i:s');

            // Selesaikan perjalanan di instansi asal
            $this->db
                ->table('riwayat_layanan')
                ->where(
                    'id',
                    $riwayatLayananId
                )
                ->update([
                    'status_layanan' => 'SELESAI',
                    'layanan_id' => $layananId,
                    'waktu_selesai' => $waktu,
                    'keterangan' => $keterangan,
                    'updated_at' => $waktu,
                ]);

            // Buat perjalanan baru di instansi tujuan
            $this->db
                ->table('riwayat_layanan')
                ->insert([
                    'antrean_id' =>
                        $riwayat['antrean_id'],

                    'instansi_id' =>
                        $instansiTujuanId,

                    'layanan_id' =>
                        null,

                    'petugas_id' =>
                        null,

                    'status_layanan' =>
                        'MENUNGGU',

                    'waktu_masuk' =>
                        $waktu,

                    'waktu_mulai' =>
                        null,

                    'waktu_selesai' =>
                        null,

                    'keterangan' =>
                        null,

                    'created_at' =>
                        $waktu,

                    'updated_at' =>
                        $waktu,
                ]);

            $riwayatBaruId = $this->db->insertID();

            if (!$riwayatBaruId) {
                throw new RuntimeException(
                    'Gagal membuat riwayat layanan tujuan.'
                );
            }

            if ($this->db->transStatus() === false) {
                throw new RuntimeException(
                    'Gagal memproses terusan antrean.'
                );
            }

            $this->db->transCommit();

            return [
                'riwayat_layanan_id' =>
                    (int) $riwayatBaruId,

                'antrean_id' =>
                    (int) $riwayat['antrean_id'],

                'nomor_antrean' =>
                    $this->getNomorAntrean(
                        (int) $riwayat['antrean_id']
                    ),

                'instansi_asal_id' =>
                    (int) $riwayat['instansi_id'],

                'instansi_tujuan_id' =>
                    $instansiTujuanId,

                'layanan_asal_id' =>
                    $layananId,

                'status_asal' =>
                    'SELESAI',

                'status_tujuan' =>
                    'MENUNGGU',

                'waktu_masuk_tujuan' =>
                    $waktu,
            ];

        } catch (\Throwable $e) {
            $this->db->transRollback();

            throw $e;
        }
    }

    
    /*
    |--------------------------------------------------------------------------
    | GET ANTREAN YANG SEDANG DILAYANI
    |--------------------------------------------------------------------------
    */

    public function getAntreanSedangDilayani(
        int $instansiId
    ): array {
        $db = $this->db;
        $db = $this->db;

        /*
        |--------------------------------------------------------------------------
        | Ambil SEMUA antrean aktif
        |--------------------------------------------------------------------------
        |
        | Satu instansi dapat memiliki beberapa petugas yang bekerja
        | bersamaan, sehingga endpoint ini tidak boleh memakai limit(1).
        |
        */

        $riwayat = $db
            ->table('riwayat_layanan')
            ->where(
                'instansi_id',
                $instansiId
            )
            ->whereIn(
                'status_layanan',
                [
                    'DIPANGGIL',
                    'DILAYANI',
                ]
            )
            ->orderBy(
                'id',
                'DESC'
            )
            ->get()
            ->getResultArray();

        if (!$riwayat) {
            return [];
        }

        $hasil = [];

        foreach ($riwayat as $row) {
            $antrean = $db
                ->table('antrean')
                ->select([
                    'nomor_antrean',
                    'tanggal_antrean',
                    'jenis_antrean',
                ])
                ->where(
                    'id',
                    $row['antrean_id']
                )
                ->where(
                    'tanggal_antrean',
                    date('Y-m-d')
                )
                ->get()
                ->getRowArray();

            if (!$antrean) {
                continue;
            }

            $hasil[] = array_merge(
                $row,
                $antrean
            );
        }

        return $hasil;
    }

    /*
    |--------------------------------------------------------------------------
    | GET ANTREAN SELANJUTNYA
    |--------------------------------------------------------------------------
    */

    public function getAntreanSelanjutnya(
        int $instansiId
    ): array {
        $kandidat = $this->db
            ->table('riwayat_layanan')
            ->select([
                'id AS riwayat_layanan_id',
                'antrean_id',
                'instansi_id',
                'layanan_id',
                'petugas_id',
                'status_layanan',
                'waktu_masuk',
                'waktu_mulai',
                'waktu_selesai',
                'keterangan',
                'created_at',
                'updated_at',
            ])
            ->where(
                'instansi_id',
                $instansiId
            )
            ->where(
                'status_layanan',
                'MENUNGGU'
            )
            ->orderBy(
                'waktu_masuk',
                'ASC'
            )
            ->orderBy(
                'id',
                'ASC'
            )
            ->get()
            ->getResultArray();

        if (!$kandidat) {
            return [];
        }

        $hasil = [];

        foreach ($kandidat as $row) {
            $antrean = $this->db
                ->table('antrean')
                ->select([
                    'id',
                    'nomor_antrean',
                    'tanggal_antrean',
                    'jenis_antrean',
                ])
                ->where(
                    'id',
                    $row['antrean_id']
                )
                ->where(
                    'tanggal_antrean',
                    date('Y-m-d')
                )
                ->get()
                ->getRowArray();

            if (!$antrean) {
                continue;
            }

            $row['nomor_antrean'] =
                (int) $antrean['nomor_antrean'];

            $row['tanggal_antrean'] =
                $antrean['tanggal_antrean'];

            $row['jenis_antrean'] =
                $antrean['jenis_antrean'];

            $hasil[] = $row;
        }

        // Urutan Antrean (PRIORITAS → BIASA → FIFO)
        usort(
            $hasil,
            static function (array $a, array $b): int {
                $prioritasA =
                    $a['jenis_antrean'] === 'PRIORITAS'
                        ? 0
                        : 1;

                $prioritasB =
                    $b['jenis_antrean'] === 'PRIORITAS'
                        ? 0
                        : 1;

                if ($prioritasA !== $prioritasB) {
                    return $prioritasA <=> $prioritasB;
                }

                $waktuA = strtotime($a['waktu_masuk']);
                $waktuB = strtotime($b['waktu_masuk']);

                if ($waktuA !== $waktuB) {
                    return $waktuA <=> $waktuB;
                }

                return (int) $a['riwayat_layanan_id']
                    <=> (int) $b['riwayat_layanan_id'];
            }
        );

        return $hasil;
    }

    
    // Alias lama untuk menjaga kompatibilitas dengan controller yang masih menggunakan getAntreanMenunggu()
    public function getAntreanMenunggu(
        int $instansiId
    ): array {
        return $this->getAntreanSelanjutnya(
            $instansiId
        );
    }

    /*
    |--------------------------------------------------------------------------
    | GET ANTREAN YANG SUDAH DIPANGGIL
    |--------------------------------------------------------------------------
    */

    public function getAntreanSudahDipanggil(
        int $instansiId
    ): array {
        $db = $this->db;
        $db = $this->db;

        // Ambil riwayat layanan berdasarkan instansi dan status yang ditampilkan
        $riwayat = $db
            ->table('riwayat_layanan')
            ->where('instansi_id', $instansiId)
            ->whereIn(
                'status_layanan',
                [
                    'DIPANGGIL',
                    'DILAYANI',
                    'PENDING',
                    'SELESAI',
                ]
            )
            ->orderBy('updated_at', 'DESC')
            ->orderBy('id', 'DESC')
            ->get()
            ->getResultArray();

        if (empty($riwayat)) {
            return [];
        }

        $hasil = [];
        $tanggalHariIni = date('Y-m-d');

        foreach ($riwayat as $row) {
            // Ambil nomor, tanggal, dan jenis antrean dari tabel antrean
            $antrean = $db
                ->table('antrean')
                ->select(
                    'nomor_antrean, tanggal_antrean, jenis_antrean'
                )
                ->where('id', $row['antrean_id'])
                ->where('tanggal_antrean', $tanggalHariIni)
                ->get()
                ->getRowArray();

            // Lewati jika data antrean tidak ditemukan atau bukan antrean hari ini
            if (empty($antrean)) {
                continue;
            }

            $hasil[] = array_merge(
                $row,
                $antrean
            );
        }

        return $hasil;
    }

    /*
    |--------------------------------------------------------------------------
    | GET RIWAYAT LAYANAN
    |--------------------------------------------------------------------------
    */

    public function getRiwayatLayanan(
        int $riwayatLayananId
    ): ?array {
        $db = $this->db;
        $db = $this->db;

        // Ambil data riwayat layanan berdasarkan ID
        $riwayat = $db
            ->table('riwayat_layanan')
            ->where('id', $riwayatLayananId)
            ->get()
            ->getRowArray();

        if (empty($riwayat)) {
            return null;
        }

        // Ambil nomor, tanggal, dan jenis antrean berdasarkan ID antrean
        $antrean = $db
            ->table('antrean')
            ->select(
                'nomor_antrean, tanggal_antrean, jenis_antrean'
            )
            ->where('id', $riwayat['antrean_id'])
            ->get()
            ->getRowArray();

        if (empty($antrean)) {
            return null;
        }

        return array_merge(
            $riwayat,
            $antrean
        );
    }

    // HELPER

    /*
    |--------------------------------------------------------------------------
    | GET RIWAYAT DENGAN LOG
    |--------------------------------------------------------------------------
    */

    protected function getRiwayatDenganLock(
        int $riwayatLayananId
    ): ?array {
        return $this->db
            ->query(
                'SELECT *
                FROM riwayat_layanan
                WHERE id = ?
                FOR UPDATE',
                [$riwayatLayananId]
            )
            ->getRowArray();
    }

    /*
    |--------------------------------------------------------------------------
    | GET NOMOR ANTREAN
    |--------------------------------------------------------------------------
    */
    protected function getNomorAntrean(
        int $antreanId
    ): int {
        $row = $this->db
            ->table('antrean')
            ->select('nomor_antrean')
            ->where(
                'id',
                $antreanId
            )
            ->get()
            ->getRowArray();

        if (!$row) {
            throw new RuntimeException(
                'Data antrean tidak ditemukan.'
            );
        }

        return (int) $row['nomor_antrean'];
    }

    
    /*
    |--------------------------------------------------------------------------
    | VALIDASI LAYANAN
    |--------------------------------------------------------------------------
    */

    protected function validasiLayanan(
        int $layananId,
        int $instansiId
    ): void {
        $layanan = $this->db
            ->table('layanan')
            ->where(
                'id',
                $layananId
            )
            ->where(
                'instansi_id',
                $instansiId
            )
            ->get()
            ->getRowArray();

        if (!$layanan) {
            throw new RuntimeException(
                'Layanan tidak ditemukan atau bukan milik instansi tersebut.'
            );
        }
    }

    /*
    |--------------------------------------------------------------------------
    | VALIDASI INSTANSI
    |--------------------------------------------------------------------------
    */

    protected function validasiInstansi(
        int $instansiId
    ): array {
        $instansi = $this->db
            ->table('instansi')
            ->where(
                'id',
                $instansiId
            )
            ->get()
            ->getRowArray();

        if (!$instansi) {
            throw new RuntimeException(
                'Instansi tidak ditemukan.'
            );
        }

        return $instansi;
    }

    /*
    |--------------------------------------------------------------------------
    | VALIDASI PETUGAS INSTANSI
    |--------------------------------------------------------------------------
    */

    protected function validasiPetugasInstansi(
        int $petugasId,
        int $instansiId
    ): void {
        $petugas = $this->db
            ->table('users u')
            ->select('
                u.id,
                u.instansi_id,
                u.role_id,
                r.nama_role
            ')
            ->join(
                'roles r',
                'r.id = u.role_id'
            )
            ->where(
                'u.id',
                $petugasId
            )
            ->get()
            ->getRowArray();

        if (!$petugas) {
            throw new RuntimeException(
                'Petugas tidak ditemukan.'
            );
        }

        if ($petugas['nama_role'] !== 'Petugas') {
            throw new RuntimeException(
                'User tersebut bukan petugas.'
            );
        }

        if (
            $petugas['instansi_id'] === null
            || (int) $petugas['instansi_id'] !== $instansiId
        ) {
            throw new RuntimeException(
                'Petugas tidak terdaftar pada instansi tersebut.'
            );
        }
    }

}