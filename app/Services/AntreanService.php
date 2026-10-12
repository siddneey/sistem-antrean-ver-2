<?php

namespace App\Services;

use App\Models\AntreanModel;
use App\Models\SequenceAntreanModel;
use App\Models\RiwayatLayananModel;
use App\Models\RiwayatPanggilanModel;
use App\Models\KuotaInstansiModel;

use CodeIgniter\Database\BaseConnection;
use RuntimeException;
use Throwable;

class AntreanService
{
    protected BaseConnection $db;

    protected AntreanModel $antreanModel;
    protected SequenceAntreanModel $sequenceModel;
    protected RiwayatLayananModel $riwayatLayananModel;
    protected RiwayatPanggilanModel $riwayatPanggilanModel;
    protected KuotaInstansiModel $kuotaInstansiModel;
    
    // Jam pelayanan
    protected string $jamMulaiAmbil = '08:00:00';
    protected string $jamSelesaiAmbil = '15:00:00';

    protected string $jamMulaiPelayanan = '08:00:00';
    protected string $jamSelesaiPelayanan = '16:00:00';
    
    // Default Kuota Pelayanan
    private const KUOTA_BIASA_DEFAULT = 50;
    private const KUOTA_PRIORITAS_DEFAULT = 30;

    // Constructor
    public function __construct()
    {
        $this->db = db_connect();

        $this->antreanModel = new AntreanModel();
        $this->sequenceModel = new SequenceAntreanModel();
        $this->riwayatLayananModel = new RiwayatLayananModel();
        $this->riwayatPanggilanModel = new RiwayatPanggilanModel();
        $this->kuotaInstansiModel = new KuotaInstansiModel();
    }

    /*
    |--------------------------------------------------------------------------
    | AMBIL ANTREAN
    |--------------------------------------------------------------------------
    */
    public function ambilAntrean(
        int $instansiId,
        string $jenisAntrean,
        string $tanggal
    ): array {
        $jenisAntrean = strtoupper(trim($jenisAntrean));
        $tanggalHariIni = date('Y-m-d');
        $waktuAmbil = date('Y-m-d H:i:s');

        // Validasi sebelum memulai transaksi
        $this->validasiJenisAntrean($jenisAntrean);
        $this->validasiTanggalAntrean($tanggal);
        $this->validasiHariPelayanan($tanggal);
        $this->validasiJamPengambilan($tanggal);

        $instansi = $this->validasiInstansi($instansiId);

        // Simpan antrean ke DATABASE ANTREAN
        // Sequence tanggal dikunci terlebih dahulu oleh generateNomorAntreanDalamTransaksi().

        $this->db->transBegin();

        try { 
            // Lock sequence dan buat nomor antrean
            $nomorAntrean = $this->generateNomorAntreanDalamTransaksi( 
                $tanggal ); 
            
            // Periksa kuota di dalam transaksi
            $kuota = $this->getKuotaInstansiByJenis( 
                $instansiId,
                $jenisAntrean, 
                $tanggal
            ); 
            
            $jumlahAntrean = $this->getJumlahAntreanInstansi( 
                $instansiId, 
                $jenisAntrean, 
                $tanggal 
            ); 
            
            if ($jumlahAntrean >= $kuota) { 
                $this->db->transRollback(); 
                
                return [ 
                    'status' => false, 
                    'message' => sprintf( 
                        'Kuota antrean %s untuk tanggal tersebut sudah habis.', 
                        $jenisAntrean 
                    ), 
                    'data' => [ 
                        'tanggal' => $tanggal, 
                        'jenis_antrean' => $jenisAntrean, 
                        'kuota' => $kuota, 
                        'terpakai' => $jumlahAntrean, 
                        'tersisa' => 0, 
                    ], 
                ]; 
            } 
            
            // Simpan tiket antrean
            $antreanId = $this->antreanModel->insert([ 
                'tanggal_antrean' => $tanggal, 
                'nomor_antrean' => $nomorAntrean, 
                'jenis_antrean' => $jenisAntrean, 
                'instansi_awal_id' => $instansiId, 
                'waktu_ambil' => $waktuAmbil, 
            ], true); 
            
            if (!$antreanId) { 
                throw new RuntimeException( 
                    'Gagal membuat data antrean.' 
                );
            } 
            
            // Simpan riwayat dalam transaksi database yang sama
            $riwayatLayananId = $this->riwayatLayananModel->insert([ 
                'antrean_id' => $antreanId, 
                'instansi_id' => $instansiId, 
                'layanan_id' => null, 
                'petugas_id' => null, 
                'status_layanan' => 'MENUNGGU', 
                'waktu_masuk' => $waktuAmbil, 
                'waktu_mulai' => null, 
                'waktu_selesai' => null, 
                'keterangan' => $tanggal === $tanggalHariIni 
                    ? 'Antrean hari ini' 
                    : 'Booking antrean hari selanjutnya', 
            ], true); 
                
            if (!$riwayatLayananId) {
                
            throw new RuntimeException( 
                'Gagal membuat riwayat layanan.' 
            ); 
        } 
        
        // Pastikan seluruh query berhasil sebelum commit
        if ($this->db->transStatus() === false) { 
            throw new RuntimeException( 
                'Gagal menyimpan data antrean dan riwayat layanan.' 
            ); 
        } 
        
        $this->db->transCommit(); 
        
        return [ 
            'status' => true, 
            'message' => $tanggal === $tanggalHariIni 
                ? 'Antrean berhasil diambil.' 
                : 'Booking antrean berhasil.', 
            'data' => [ 
                'antrean_id' => $antreanId, 
                'riwayat_layanan_id' => $riwayatLayananId, 
                'nomor_antrean' => $nomorAntrean, 
                'tanggal_antrean' => $tanggal, 
                'jenis_antrean' => $jenisAntrean, 
                'instansi_id' => $instansiId, 
                'instansi' => $instansi['nama_instansi'], 
                'waktu_ambil' => $waktuAmbil, 
            ], 
        ]; 
    } catch (\Throwable $e) { 
        $this->db->transRollback(); 
        
        throw $e; 
    } 
}

    /*
    |--------------------------------------------------------------------------
    | GENERATE NOMOR ANTREAN
    |--------------------------------------------------------------------------
    */

    protected function generateNomorAntreanDalamTransaksi(
        string $tanggal
    ): int {
        $builder = $this->db
            ->table('sequence_antrean');

        // Buat sequence jika belum ada
        $builder->ignore(true)->insert([
            'tanggal' => $tanggal,
            'nomor_terakhir' => 0,
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        // Lock sequence
        $sequence = $this->db
            ->query(
                'SELECT tanggal, nomor_terakhir
                 FROM sequence_antrean
                 WHERE tanggal = ?
                 FOR UPDATE',
                [$tanggal]
            )
            ->getRowArray();

        if (!$sequence) {
            throw new RuntimeException(
                'Sequence antrean tidak ditemukan.'
            );
        }

        $nomorBaru = ((int) $sequence['nomor_terakhir']) + 1;

        // Update nomor terakhir
        $this->db
            ->table('sequence_antrean')
            ->where('tanggal', $tanggal)
            ->update([
                'nomor_terakhir' => $nomorBaru,
                'updated_at' => date('Y-m-d H:i:s'),
            ]);

        return $nomorBaru;
    }
    
    /*
    |--------------------------------------------------------------------------
    | GET JUMLAH ANTREAN
    |--------------------------------------------------------------------------
    */
    
    public function getJumlahAntreanInstansi(
        int $instansiId,
        string $jenisAntrean,
        ?string $tanggal = null
    ): int {
        if ($instansiId < 1) {
            throw new \InvalidArgumentException(
                'Instansi tidak valid.'
            );
        }

        $tanggal ??= date('Y-m-d');

        $jenisAntrean = strtoupper(trim($jenisAntrean));

        // Pastikan jenis antrean valid sebelum menghitung jumlah antrean
        $this->validasiJenisAntrean($jenisAntrean);

        return $this->db
            ->table('antrean')
            ->where('instansi_awal_id', $instansiId)
            ->where('tanggal_antrean', $tanggal)
            ->where('jenis_antrean', $jenisAntrean)
            ->countAllResults();
    }

    /*
    |--------------------------------------------------------------------------
    | GET KUOTA INSTANSI
    |--------------------------------------------------------------------------
    */

    public function getKuotaInstansi(
        int $instansiId,
        ?string $tanggal = null
    ): array {
        $tanggal ??= date('Y-m-d');

        // Cari data kuota berdasarkan instansi dan tanggal
        $data = $this->kuotaInstansiModel
            ->where('instansi_id', $instansiId)
            ->where('tanggal', $tanggal)
            ->first();

        // Gunakan kuota default jika data kuota belum tersedia
        if (!$data) {
            return [
                'instansi_id'     => $instansiId,
                'tanggal'         => $tanggal,
                'kuota_biasa'     => self::KUOTA_BIASA_DEFAULT,
                'kuota_prioritas' => self::KUOTA_PRIORITAS_DEFAULT,
            ];
        }

        // Kembalikan data kuota dengan nilai numerik
        return [
            'instansi_id'     => $instansiId,
            'tanggal'         => $tanggal,
            'kuota_biasa'     => (int) $data['kuota_biasa'],
            'kuota_prioritas' => (int) $data['kuota_prioritas'],
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | GET KUOTA INSTANSI BY JENIS
    |--------------------------------------------------------------------------
    */

    public function getKuotaInstansiByJenis(
        int $instansiId,
        string $jenisAntrean,
        ?string $tanggal = null
    ): int {
        $jenisAntrean = strtoupper(trim($jenisAntrean));

        // Ambil kuota instansi sesuai tanggal
        $kuota = $this->getKuotaInstansi(
            $instansiId,
            $tanggal
        );

        // Kembalikan kuota sesuai jenis antrean
        return match ($jenisAntrean) {
            'BIASA' => $kuota['kuota_biasa'],
            'PRIORITAS' => $kuota['kuota_prioritas'],
            default => throw new \InvalidArgumentException(
                'Jenis antrean tidak valid.'
            ),
        };
    }

    /*
    |--------------------------------------------------------------------------
    | SET KUOTA INSTANSI
    |--------------------------------------------------------------------------
    */

    public function setKuotaInstansi(
        int $instansiId,
        int $kuotaBiasa,
        int $kuotaPrioritas,
        ?string $tanggal = null
    ): array {
        // Pastikan ID instansi valid
        if ($instansiId < 1) {
            throw new \InvalidArgumentException(
                'Instansi tidak valid.'
            );
        }

        // Pastikan instansi terdaftar
        $this->validasiInstansi($instansiId);

        // Pastikan kuota biasa minimal satu tiket
        if ($kuotaBiasa < 1) {
            throw new \InvalidArgumentException(
                'Kuota biasa minimal 1 tiket.'
            );
        }

        // Pastikan kuota prioritas minimal satu tiket
        if ($kuotaPrioritas < 1) {
            throw new \InvalidArgumentException(
                'Kuota prioritas minimal 1 tiket.'
            );
        }

        $tanggal ??= date('Y-m-d');

        // Validasi tanggal antrean
        $this->validasiTanggalAntrean($tanggal);

        // Cari data kuota yang sudah tersimpan
        $data = $this->kuotaInstansiModel
            ->where('instansi_id', $instansiId)
            ->where('tanggal', $tanggal)
            ->first();

        // Siapkan data kuota yang akan disimpan
        $payload = [
            'instansi_id'     => $instansiId,
            'tanggal'         => $tanggal,
            'kuota_biasa'     => $kuotaBiasa,
            'kuota_prioritas' => $kuotaPrioritas,
        ];

        // Perbarui kuota jika data sudah tersedia
        if ($data) {
            $this->kuotaInstansiModel->update(
                $data['id'],
                [
                    'kuota_biasa'     => $kuotaBiasa,
                    'kuota_prioritas' => $kuotaPrioritas,
                ]
            );
        } else {
            // Tambahkan data kuota baru jika belum tersedia
            $this->kuotaInstansiModel->insert($payload);
        }

        return $payload;
    }

    /*
    |--------------------------------------------------------------------------
    | VALIDASI JENIS ANTREAN
    |--------------------------------------------------------------------------
    */

    private function validasiJenisAntrean(string $jenisAntrean): void
    {
        $jenisValid = ['BIASA', 'PRIORITAS'];

        if (!in_array($jenisAntrean, $jenisValid, true)) {
            throw new \InvalidArgumentException(
                'Jenis antrean tidak valid.'
            );
        }
    }

    /*
    |--------------------------------------------------------------------------
    | VALIDASI TANGGAL ANTREAN
    |--------------------------------------------------------------------------
    */

    protected function validasiTanggalAntrean(
        string $tanggal
    ): void {
        $date = \DateTime::createFromFormat(
            'Y-m-d',
            $tanggal
        );

        $errors = \DateTime::getLastErrors();

        if (
            !$date
            || (
                $errors !== false
                && (
                    $errors['warning_count'] > 0
                    || $errors['error_count'] > 0
                )
            )
            || $date->format('Y-m-d') !== $tanggal
        ) {
            throw new RuntimeException(
                'Format tanggal tidak valid. Gunakan YYYY-MM-DD.'
            );
        }

        $hariIni = new \DateTimeImmutable(
            date('Y-m-d')
        );

        $tanggalAntrean = new \DateTimeImmutable(
            $tanggal
        );

        $tanggalMaksimal = $hariIni->modify(
            '+7 days'
        );

        if ($tanggalAntrean < $hariIni) {
            throw new RuntimeException(
                'Tanggal antrean tidak boleh sebelum hari ini.'
            );
        }

        if ($tanggalAntrean > $tanggalMaksimal) {
            throw new RuntimeException(
                'Antrean hanya dapat diambil maksimal 7 hari ke depan.'
            );
        }
    }

    /*
    |--------------------------------------------------------------------------
    | VALIDASI HARI PELAYANAN
    |--------------------------------------------------------------------------
    */

    protected function validasiHariPelayanan(
        string $tanggal
    ): void {
        $hari = (int) date(
            'N',
            strtotime($tanggal)
        );

        // 6 = Sabtu, 7 = Minggu
        if ($hari >= 6) {
            throw new RuntimeException(
                'Tanggal tersebut bukan hari pelayanan.'
            );
        }

        // Periksa apakah tanggal terdaftar sebagai hari libur
        $libur = $this->db
            ->table('hari_libur')
            ->where(
                'tanggal',
                $tanggal
            )
            ->get()
            ->getRowArray();

        if ($libur) {
            $keterangan = $libur['keterangan']
                ? ' (' . $libur['keterangan'] . ')'
                : '';

            throw new RuntimeException(
                'Tanggal tersebut merupakan hari libur'
                . $keterangan
                . '.'
            );
        }
    }

    /*
    |--------------------------------------------------------------------------
    | VALIDASI JAM PENGAMBILAN
    |--------------------------------------------------------------------------
    */

    protected function validasiJamPengambilan(
        string $tanggal
    ): void {
        if ($tanggal !== date('Y-m-d')) {
            return;
        }

        $sekarang = date('H:i:s');

        if (
            $sekarang < $this->jamMulaiAmbil
            || $sekarang > $this->jamSelesaiAmbil
        ) {
            throw new RuntimeException(
                'Pengambilan antrean hari ini hanya tersedia '
                . 'pukul 08:00 sampai 15:00.'
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

}