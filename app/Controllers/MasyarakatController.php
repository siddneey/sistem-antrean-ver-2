<?php

namespace App\Controllers;

use App\Services\AntreanService;
use DateTimeImmutable;
use InvalidArgumentException;
use Throwable;

class MasyarakatController extends BaseController
{
    protected AntreanService $antreanService;

    public function __construct()
    {
        $this->antreanService = new AntreanService();
    }

    public function kiosk()
    {
        return view('masyarakat/kiosk');
    }

    public function instansi()
    {
        try {
            $instansi = db_connect()->table('instansi')
                ->select('id, grup_id, nama_instansi, logo')
                ->orderBy('nama_instansi', 'ASC')
                ->get()->getResultArray();

            return $this->response->setJSON([
                'status' => true,
                'data' => $instansi,
            ]);
        } catch (Throwable $e) {
            log_message('error', 'MasyarakatController::instansi | ' . $e->getMessage());
            return $this->response->setStatusCode(500)->setJSON([
                'status' => false,
                'message' => 'Gagal mengambil daftar instansi.',
            ]);
        }
    }

    /** GET /masyarakat/kuota/{instansiId}?tanggal=YYYY-MM-DD */
    public function kuota($instansiId)
    {
        $id = filter_var($instansiId, FILTER_VALIDATE_INT);
        if ($id === false || $id < 1) {
            return $this->response->setStatusCode(400)->setJSON([
                'status' => false,
                'message' => 'Instansi tidak valid.',
            ]);
        }

        $tanggal = trim((string) $this->request->getGet('tanggal'));
        $tanggal = $tanggal !== '' ? $tanggal : date('Y-m-d');
        if (!$this->isValidDate($tanggal)) {
            return $this->response->setStatusCode(400)->setJSON([
                'status' => false,
                'message' => 'Format tanggal harus YYYY-MM-DD.',
            ]);
        }

        $hariIni = date('Y-m-d');
        $batasAkhir = (new DateTimeImmutable($hariIni))->modify('+7 days')->format('Y-m-d');
        if ($tanggal < $hariIni || $tanggal > $batasAkhir) {
            return $this->response->setStatusCode(400)->setJSON([
                'status' => false,
                'message' => 'Tanggal harus hari ini sampai maksimal 7 hari ke depan.',
            ]);
        }

        try {
            $db = db_connect();
            $instansi = $db->table('instansi')
                ->select('id, nama_instansi, logo')
                ->where('id', $id)->get()->getRowArray();

            if (!$instansi) {
                return $this->response->setStatusCode(404)->setJSON([
                    'status' => false,
                    'message' => 'Instansi tidak ditemukan.',
                ]);
            }

            $booking = $tanggal > $hariIni;
            $kategori = $booking ? 'BOOKING' : 'HARI_INI';
            $pengaturan = $this->antreanService->getKuotaInstansi((int) $id, $tanggal);
            $terpakai = $this->antreanService->getJumlahAntreanPerKategori((int) $id, $kategori, $tanggal);
            $batas = (int) ($booking ? $pengaturan['kuota_booking'] : $pengaturan['kuota_layanan']);
            $tersisa = max(0, $batas - $terpakai);
            $statusLoket = strtoupper((string) $pengaturan['status_loket']);

            $tanggalObj = new DateTimeImmutable($tanggal);
            $akhirPekan = (int) $tanggalObj->format('N') >= 6;
            $libur = $db->table('hari_libur')->where('tanggal', $tanggal)->countAllResults() > 0;
            $jamBuka = $booking || (date('H:i:s') >= '08:00:00' && date('H:i:s') <= '21:00:00');
            $bisaAmbil = $statusLoket === 'BUKA' && $tersisa > 0 && !$akhirPekan && !$libur && $jamBuka;

            return $this->response->setJSON([
                'status' => true,
                'data' => [
                    'instansi_id' => (int) $id,
                    'instansi' => $instansi['nama_instansi'],
                    'logo' => $instansi['logo'] ?? null,
                    'tanggal' => $tanggal,
                    'kategori' => $kategori,
                    'status_loket' => $statusLoket,
                    'kuota_aktif' => $batas,
                    'terpakai' => $terpakai,
                    'tersisa' => $tersisa,
                    'bisa_ambil' => $bisaAmbil,
                    'kuota_layanan' => (int) $pengaturan['kuota_layanan'],
                    'kuota_booking' => (int) $pengaturan['kuota_booking'],
                ],
            ]);
        } catch (Throwable $e) {
            log_message('error', 'MasyarakatController::kuota | ' . $e->getMessage());
            return $this->response->setStatusCode(500)->setJSON([
                'status' => false,
                'message' => 'Gagal mengambil data kuota.',
            ]);
        }
    }

    /** POST /masyarakat/antrean */
    public function ambilAntrean()
    {
        $input = $this->request->getJSON(true);
        if (!is_array($input)) {
            return $this->response->setStatusCode(400)->setJSON([
                'status' => false,
                'message' => 'Request JSON tidak valid.',
            ]);
        }

        $tanggal = trim((string) ($input['tanggal_antrean'] ?? ''));
        $id = filter_var($input['instansi_id'] ?? null, FILTER_VALIDATE_INT);
        $jenis = strtoupper(trim((string) ($input['jenis_antrean'] ?? '')));

        if (!$this->isValidDate($tanggal)) {
            return $this->response->setStatusCode(400)->setJSON([
                'status' => false,
                'message' => 'Tanggal antrean harus berformat YYYY-MM-DD.',
            ]);
        }
        if ($id === false || $id < 1) {
            return $this->response->setStatusCode(400)->setJSON([
                'status' => false,
                'message' => 'Instansi wajib dipilih.',
            ]);
        }
        if (!in_array($jenis, ['BIASA', 'PRIORITAS'], true)) {
            return $this->response->setStatusCode(400)->setJSON([
                'status' => false,
                'message' => 'Jenis antrean harus BIASA atau PRIORITAS.',
            ]);
        }

        try {
            $hasil = $this->antreanService->ambilAntrean((int) $id, $jenis, $tanggal);
            return $this->response
                ->setStatusCode(($hasil['status'] ?? false) ? 201 : 409)
                ->setJSON($hasil);
        } catch (InvalidArgumentException $e) {
            return $this->response->setStatusCode(400)->setJSON([
                'status' => false,
                'message' => $e->getMessage(),
            ]);
        } catch (\RuntimeException $e) {
            return $this->response->setStatusCode(422)->setJSON([
                'status' => false,
                'message' => $e->getMessage(),
            ]);
        } catch (Throwable $e) {
            log_message('error', 'MasyarakatController::ambilAntrean | ' . $e->getMessage());
            return $this->response->setStatusCode(500)->setJSON([
                'status' => false,
                'message' => 'Gagal memproses pengambilan antrean.',
            ]);
        }
    }

    /** GET /masyarakat/hari-libur */
    public function hariLibur()
    {
        $hariIni = date('Y-m-d');
        $tanggalAkhir = (new DateTimeImmutable($hariIni))->modify('+7 days')->format('Y-m-d');
        try {
            $hariLibur = db_connect()->table('hari_libur')
                ->select('tanggal, nama, jenis, keterangan')
                ->where('tanggal >=', $hariIni)
                ->where('tanggal <=', $tanggalAkhir)
                ->orderBy('tanggal', 'ASC')
                ->get()->getResultArray();

            return $this->response->setJSON([
                'status' => true,
                'data' => $hariLibur,
            ]);
        } catch (Throwable $e) {
            log_message('error', 'MasyarakatController::hariLibur | ' . $e->getMessage());
            return $this->response->setStatusCode(500)->setJSON([
                'status' => false,
                'message' => 'Gagal mengambil data hari libur.',
            ]);
        }
    }

    protected function isValidDate(string $tanggal): bool
    {
        $obj = DateTimeImmutable::createFromFormat('!Y-m-d', $tanggal);
        $errors = DateTimeImmutable::getLastErrors();
        return $obj !== false
            && ($errors === false || ($errors['warning_count'] === 0 && $errors['error_count'] === 0))
            && $obj->format('Y-m-d') === $tanggal;
    }
}