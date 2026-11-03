<?php

namespace App\Services;

use App\Models\AntreanModel;
use App\Models\SequenceAntreanModel;
use App\Models\RiwayatLayananModel;
use App\Models\RiwayatPanggilanModel;
use App\Models\KuotaInstansiModel;
use CodeIgniter\Database\BaseConnection;
use InvalidArgumentException;
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

    protected string $jamMulaiAmbil = '08:00:00';
    protected string $jamSelesaiAmbil = '21:00:00';
    protected string $jamMulaiPelayanan = '08:00:00';
    protected string $jamSelesaiPelayanan = '21:00:00';

    private const KUOTA_BIASA_DEFAULT = 50;
    private const KUOTA_PRIORITAS_DEFAULT = 30;
    private const KUOTA_LAYANAN_DEFAULT = 50;
    private const KUOTA_BOOKING_DEFAULT = 30;

    public function __construct()
    {
        $this->db = db_connect();
        $this->antreanModel = new AntreanModel();
        $this->sequenceModel = new SequenceAntreanModel();
        $this->riwayatLayananModel = new RiwayatLayananModel();
        $this->riwayatPanggilanModel = new RiwayatPanggilanModel();
        $this->kuotaInstansiModel = new KuotaInstansiModel();
    }

    public function ambilAntrean(int $instansiId, string $jenisAntrean, string $tanggal): array
    {
        $jenisAntrean = strtoupper(trim($jenisAntrean));
        $hariIni = date('Y-m-d');
        $waktuAmbil = date('Y-m-d H:i:s');
        $booking = $tanggal !== $hariIni;

        $this->validasiJenisAntrean($jenisAntrean);
        $this->validasiTanggalAntrean($tanggal);
        $this->validasiHariPelayanan($tanggal);
        $this->validasiJamPengambilan($tanggal);
        $instansi = $this->validasiInstansi($instansiId);

        $this->db->transBegin();
        try {
            // Mengunci seluruh penerbitan tiket untuk tanggal pelayanan yang sama.
            $nomorAntrean = $this->generateNomorAntreanDalamTransaksi($tanggal);
            $kuota = $this->getKuotaInstansi($instansiId, $tanggal);
            $kategori = $booking ? 'BOOKING' : 'HARI_INI';
            $batas = $booking ? $kuota['kuota_booking'] : $kuota['kuota_layanan'];
            $terpakai = $this->getJumlahAntreanPerKategori($instansiId, $kategori, $tanggal);

            if ($kuota['status_loket'] === 'TUTUP') {
                $this->db->transRollback();
                return [
                    'status' => false,
                    'message' => 'Loket instansi sedang ditutup untuk pengambilan antrean.',
                    'data' => ['tanggal' => $tanggal, 'status_loket' => 'TUTUP'],
                ];
            }

            if ($terpakai >= $batas) {
                $this->db->transRollback();
                return [
                    'status' => false,
                    'message' => $booking
                        ? 'Kuota layanan booking untuk tanggal tersebut sudah habis.'
                        : 'Kuota layanan hari ini sudah habis.',
                    'data' => [
                        'tanggal' => $tanggal,
                        'kategori' => $kategori,
                        'kuota' => $batas,
                        'terpakai' => $terpakai,
                        'tersisa' => 0,
                    ],
                ];
            }

            $antreanId = $this->antreanModel->insert([
                'tanggal_antrean' => $tanggal,
                'nomor_antrean' => $nomorAntrean,
                'jenis_antrean' => $jenisAntrean,
                'instansi_awal_id' => $instansiId,
                'waktu_ambil' => $waktuAmbil,
            ], true);
            if (!$antreanId) {
                throw new RuntimeException('Gagal membuat data antrean.');
            }

            $riwayatLayananId = $this->riwayatLayananModel->insert([
                'antrean_id' => $antreanId,
                'instansi_id' => $instansiId,
                'layanan_id' => null,
                'petugas_id' => null,
                'status_layanan' => 'MENUNGGU',
                'waktu_masuk' => $waktuAmbil,
                'waktu_mulai' => null,
                'waktu_selesai' => null,
                'keterangan' => $booking ? 'Booking antrean hari selanjutnya' : 'Antrean hari ini',
            ], true);
            if (!$riwayatLayananId) {
                throw new RuntimeException('Gagal membuat riwayat layanan.');
            }
            if ($this->db->transStatus() === false) {
                throw new RuntimeException('Gagal menyimpan data antrean dan riwayat layanan.');
            }
            $this->db->transCommit();

            return [
                'status' => true,
                'message' => $booking ? 'Booking antrean berhasil.' : 'Antrean berhasil diambil.',
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
        } catch (Throwable $e) {
            $this->db->transRollback();
            throw $e;
        }
    }

    protected function generateNomorAntreanDalamTransaksi(string $tanggal): int
    {
        $this->db->table('sequence_antrean')->ignore(true)->insert([
            'tanggal' => $tanggal,
            'nomor_terakhir' => 0,
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        $sequence = $this->db->query(
            'SELECT tanggal, nomor_terakhir FROM sequence_antrean WHERE tanggal = ? FOR UPDATE',
            [$tanggal]
        )->getRowArray();
        if (!$sequence) {
            throw new RuntimeException('Sequence antrean tidak ditemukan.');
        }
        $nomorBaru = (int) $sequence['nomor_terakhir'] + 1;
        $this->db->table('sequence_antrean')->where('tanggal', $tanggal)->update([
            'nomor_terakhir' => $nomorBaru,
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        return $nomorBaru;
    }

    public function getJumlahAntreanInstansi(int $instansiId, string $jenisAntrean, ?string $tanggal = null): int
    {
        if ($instansiId < 1) {
            throw new InvalidArgumentException('Instansi tidak valid.');
        }
        $tanggal ??= date('Y-m-d');
        $jenisAntrean = strtoupper(trim($jenisAntrean));
        $this->validasiJenisAntrean($jenisAntrean);
        return $this->db->table('antrean')
            ->where('instansi_awal_id', $instansiId)
            ->where('tanggal_antrean', $tanggal)
            ->where('jenis_antrean', $jenisAntrean)
            ->countAllResults();
    }

    public function getJumlahAntreanPerKategori(int $instansiId, string $kategori, ?string $tanggal = null): int
    {
        if ($instansiId < 1) {
            throw new InvalidArgumentException('Instansi tidak valid.');
        }
        $tanggal ??= date('Y-m-d');
        $kategori = strtoupper(trim($kategori));
        if (!in_array($kategori, ['HARI_INI', 'BOOKING'], true)) {
            throw new InvalidArgumentException('Kategori layanan tidak valid.');
        }
        $operator = $kategori === 'BOOKING' ? '<' : '=';
        return (int) $this->db->table('antrean')
            ->where('instansi_awal_id', $instansiId)
            ->where('tanggal_antrean', $tanggal)
            ->where('DATE(waktu_ambil) ' . $operator . ' tanggal_antrean', null, false)
            ->countAllResults();
    }

    public function getKuotaInstansi(int $instansiId, ?string $tanggal = null): array
    {
        if ($instansiId < 1) {
            throw new InvalidArgumentException('Instansi tidak valid.');
        }
        $tanggal ??= date('Y-m-d');
        $hariIni = date('Y-m-d');
        $dataTanggal = $this->db->table('kuota_instansi')
            ->where('instansi_id', $instansiId)
            ->where('tanggal', $tanggal)
            ->get()->getRowArray();

        // Pilihan A: booking menggunakan nilai terbaru dari pengaturan petugas
        // (baris paling baru sampai hari ini), bukan default tanggal tujuan.
        $pengaturanAktif = $this->db->table('kuota_instansi')
            ->where('instansi_id', $instansiId)
            ->where('tanggal <=', $hariIni)
            ->orderBy('tanggal', 'DESC')
            ->orderBy('id', 'DESC')
            ->get(1)->getRowArray();

        $dataHariIni = $tanggal === $hariIni ? $dataTanggal : null;
        $kuotaBooking = $pengaturanAktif['kuota_booking'] ?? self::KUOTA_BOOKING_DEFAULT;
        $statusLoket = $pengaturanAktif['status_loket'] ?? 'BUKA';

        return [
            'instansi_id' => $instansiId,
            'tanggal' => $tanggal,
            'kuota_biasa' => (int) ($dataTanggal['kuota_biasa'] ?? self::KUOTA_BIASA_DEFAULT),
            'kuota_prioritas' => (int) ($dataTanggal['kuota_prioritas'] ?? self::KUOTA_PRIORITAS_DEFAULT),
            'kuota_layanan' => (int) ($dataHariIni['kuota_layanan'] ?? self::KUOTA_LAYANAN_DEFAULT),
            'kuota_booking' => (int) $kuotaBooking,
            'status_loket' => strtoupper((string) $statusLoket),
        ];
    }

    // Kompatibilitas kode lama. Bukan pembatas tiket pada ambilAntrean().
    public function getKuotaInstansiByJenis(int $instansiId, string $jenisAntrean, ?string $tanggal = null): int
    {
        $jenisAntrean = strtoupper(trim($jenisAntrean));
        $kuota = $this->getKuotaInstansi($instansiId, $tanggal);
        return match ($jenisAntrean) {
            'BIASA' => $kuota['kuota_biasa'],
            'PRIORITAS' => $kuota['kuota_prioritas'],
            default => throw new InvalidArgumentException('Jenis antrean tidak valid.'),
        };
    }

    // Dipertahankan agar pemanggil lama tidak rusak.
    public function setKuotaInstansi(int $instansiId, int $kuotaBiasa, int $kuotaPrioritas, ?string $tanggal = null): array
    {
        if ($instansiId < 1) {
            throw new InvalidArgumentException('Instansi tidak valid.');
        }
        $this->validasiInstansi($instansiId);
        if ($kuotaBiasa < 1 || $kuotaPrioritas < 1) {
            throw new InvalidArgumentException('Kuota biasa dan prioritas minimal 1 tiket.');
        }
        $tanggal ??= date('Y-m-d');
        $this->validasiTanggalAntrean($tanggal);
        $data = $this->kuotaInstansiModel->where('instansi_id', $instansiId)
            ->where('tanggal', $tanggal)->first();
        $payload = [
            'instansi_id' => $instansiId,
            'tanggal' => $tanggal,
            'kuota_biasa' => $kuotaBiasa,
            'kuota_prioritas' => $kuotaPrioritas,
        ];
        if ($data) {
            $this->kuotaInstansiModel->update($data['id'], [
                'kuota_biasa' => $kuotaBiasa,
                'kuota_prioritas' => $kuotaPrioritas,
            ]);
        } else {
            $this->kuotaInstansiModel->insert($payload);
        }
        return $payload;
    }

    private function validasiJenisAntrean(string $jenisAntrean): void
    {
        if (!in_array($jenisAntrean, ['BIASA', 'PRIORITAS'], true)) {
            throw new InvalidArgumentException('Jenis antrean tidak valid.');
        }
    }

    protected function validasiTanggalAntrean(string $tanggal): void
    {
        $date = \DateTime::createFromFormat('!Y-m-d', $tanggal);
        $errors = \DateTime::getLastErrors();
        if (!$date || ($errors !== false && ($errors['warning_count'] > 0 || $errors['error_count'] > 0)) || $date->format('Y-m-d') !== $tanggal) {
            throw new RuntimeException('Format tanggal tidak valid. Gunakan YYYY-MM-DD.');
        }
        $hariIni = new \DateTimeImmutable(date('Y-m-d'));
        $tanggalAntrean = new \DateTimeImmutable($tanggal);
        if ($tanggalAntrean < $hariIni) {
            throw new RuntimeException('Tanggal antrean tidak boleh sebelum hari ini.');
        }
        if ($tanggalAntrean > $hariIni->modify('+7 days')) {
            throw new RuntimeException('Antrean hanya dapat diambil maksimal 7 hari ke depan.');
        }
    }

    protected function validasiHariPelayanan(string $tanggal): void
    {
        if ((int) date('N', strtotime($tanggal)) >= 6) {
            throw new RuntimeException('Tanggal tersebut bukan hari pelayanan.');
        }
        $libur = $this->db->table('hari_libur')->where('tanggal', $tanggal)->get()->getRowArray();
        if ($libur) {
            $keterangan = !empty($libur['keterangan']) ? ' (' . $libur['keterangan'] . ')' : '';
            throw new RuntimeException('Tanggal tersebut merupakan hari libur' . $keterangan . '.');
        }
    }

    protected function validasiJamPengambilan(string $tanggal): void
    {
        if ($tanggal !== date('Y-m-d')) {
            return;
        }
        $sekarang = date('H:i:s');
        if ($sekarang < $this->jamMulaiAmbil || $sekarang > $this->jamSelesaiAmbil) {
            throw new RuntimeException('Pengambilan antrean hari ini hanya tersedia pukul 08:00 sampai 21:00.');
        }
    }

    protected function validasiInstansi(int $instansiId): array
    {
        $instansi = $this->db->table('instansi')->where('id', $instansiId)->get()->getRowArray();
        if (!$instansi) {
            throw new RuntimeException('Instansi tidak ditemukan.');
        }
        return $instansi;
    }
}