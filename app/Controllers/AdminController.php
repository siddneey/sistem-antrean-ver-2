<?php

namespace App\Controllers;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use RuntimeException;

class AdminController extends BaseController
{
    /**
     * Dashboard admin.
     */
    public function dashboard()
    {
        return view('admin/dashboard', [
            'activeMenu' => 'dashboard',
        ]);
    }

    /**
     * Membaca dan memvalidasi filter laporan.
     */
    private function getFilterLaporan(): array
    {
        $tanggalHariIni = date('Y-m-d');

        $mulai = $this->request->getGet('tanggal_mulai');
        $selesai = $this->request->getGet('tanggal_selesai');
        $statusInput = $this->request->getGet('status');
        $instansiInput = $this->request->getGet('instansi');
        $keywordInput = $this->request->getGet('keyword');

        $tanggalMulai = $this->validasiTanggal($mulai)
            ? $mulai
            : $tanggalHariIni;

        $tanggalSelesai = $this->validasiTanggal($selesai)
            ? $selesai
            : $tanggalHariIni;

        // Pastikan rentang tanggal tidak terbalik.
        if ($tanggalMulai > $tanggalSelesai) {
            [$tanggalMulai, $tanggalSelesai] = [
                $tanggalSelesai,
                $tanggalMulai,
            ];
        }

        $status = is_string($statusInput)
            ? strtolower(trim($statusInput))
            : '';

        if (!in_array($status, ['', 'menunggu', 'proses', 'selesai'], true)) {
            $status = '';
        }

        return [
            'tanggalMulai'   => $tanggalMulai,
            'tanggalSelesai' => $tanggalSelesai,
            'filterStatus'   => $status,
            'filterInstansi' => is_string($instansiInput)
                ? trim($instansiInput)
                : '',
            'keyword'        => is_string($keywordInput)
                ? trim($keywordInput)
                : '',
        ];
    }

    /**
     * Memastikan tanggal menggunakan format YYYY-MM-DD yang valid.
     */
    private function validasiTanggal($tanggal): bool
    {
        if (!is_string($tanggal)) {
            return false;
        }

        if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $tanggal)) {
            return false;
        }

        [$tahun, $bulan, $hari] = array_map(
            'intval',
            explode('-', $tanggal)
        );

        return checkdate($bulan, $hari, $tahun);
    }

    /**
     * Membuat query laporan berdasarkan filter yang sama
     * untuk halaman laporan maupun ekspor Excel.
     */
    private function queryLaporan(array $filter)
    {
        $db = \Config\Database::connect();

        $builder = $db->table('riwayat_layanan rl');

        $builder->select([
            'rl.id AS riwayat_id',
            'rl.status_layanan',
            'rl.waktu_masuk',
            'rl.waktu_mulai',
            'rl.waktu_selesai',

            'a.id AS antrean_id',
            'a.nomor_antrean',
            'a.jenis_antrean',
            'a.tanggal_antrean',
            'a.waktu_ambil',

            'i.nama_instansi',
            'l.nama_layanan',
            'u.username AS nama_petugas',
        ]);

        $builder->join(
            'antrean a',
            'a.id = rl.antrean_id'
        );

        $builder->join(
            'instansi i',
            'i.id = rl.instansi_id'
        );

        $builder->join(
            'layanan l',
            'l.id = rl.layanan_id',
            'left'
        );

        $builder->join(
            'users u',
            'u.id = rl.petugas_id',
            'left'
        );

        // Filter periode berdasarkan tanggal tiket antrean.
        $builder->where(
            'a.tanggal_antrean >=',
            $filter['tanggalMulai']
        );

        $builder->where(
            'a.tanggal_antrean <=',
            $filter['tanggalSelesai']
        );

        // Filter status.
        if ($filter['filterStatus'] === 'menunggu') {
            $builder->where(
                'rl.status_layanan',
                'MENUNGGU'
            );
        } elseif ($filter['filterStatus'] === 'proses') {
            $builder->whereIn(
                'rl.status_layanan',
                ['DIPANGGIL', 'DILAYANI', 'PENDING']
            );
        } elseif ($filter['filterStatus'] === 'selesai') {
            $builder->where(
                'rl.status_layanan',
                'SELESAI'
            );
        }

        // Filter instansi.
        if ($filter['filterInstansi'] !== '') {
            $builder->where(
                'i.nama_instansi',
                $filter['filterInstansi']
            );
        }

        // Pencarian kata kunci.
        if ($filter['keyword'] !== '') {
            $keyword = $filter['keyword'];

            $builder->groupStart()
                ->like('a.nomor_antrean', $keyword)
                ->orLike('i.nama_instansi', $keyword)
                ->orLike('l.nama_layanan', $keyword)
                ->orLike('u.username', $keyword)
                ->groupEnd();
        }

        return $builder
        ->orderBy('a.tanggal_antrean', 'DESC')
        ->orderBy('rl.updated_at', 'DESC')
        ->orderBy('a.nomor_antrean', 'ASC');
    }

    /**
     * Halaman laporan proses antrean.
     */
    public function laporanProsesAntrean()
    {
        $filter = $this->getFilterLaporan();
        $db = \Config\Database::connect();

        $laporan = $this->queryLaporan($filter)
            ->get()
            ->getResultArray();

        $daftarInstansi = $db->table('instansi')
            ->select('nama_instansi')
            ->orderBy('nama_instansi', 'ASC')
            ->get()
            ->getResultArray();

        return view('admin/laporan_proses_antrean', array_merge(
            $filter,
            [
                'activeMenu'    => 'laporan-proses-antrean',
                'laporan'       => $laporan,
                'daftarInstansi' => $daftarInstansi,
            ]
        ));
    }

    /**
     * Ekspor laporan proses antrean ke Excel.
     */
    public function exportLaporanProsesAntrean()
    {
        $filter = $this->getFilterLaporan();

        $laporan = $this->queryLaporan($filter)
            ->get()
            ->getResultArray();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setTitle('Laporan Antrean');

        // Judul laporan.
        $sheet->setCellValue('A1', 'LAPORAN PROSES ANTREAN');
        $sheet->mergeCells('A1:K1');

        $sheet->getStyle('A1:K1')->applyFromArray([
            'font' => [
                'bold'  => true,
                'size'  => 16,
                'color' => ['rgb' => 'FFFFFF'],
            ],
            'fill' => [
                'fillType'   => Fill::FILL_SOLID,
                'startColor' => ['rgb' => '1F4E78'],
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical'   => Alignment::VERTICAL_CENTER,
            ],
        ]);

        $sheet->getRowDimension(1)->setRowHeight(28);

        // Informasi filter laporan.
        $sheet->setCellValue('A2', 'Periode');
        $sheet->setCellValue(
            'B2',
            $filter['tanggalMulai'] . ' s.d. ' . $filter['tanggalSelesai']
        );

        $sheet->setCellValue('A3', 'Status');
        $sheet->setCellValue(
            'B3',
            $filter['filterStatus'] !== ''
                ? strtoupper($filter['filterStatus'])
                : 'Semua'
        );

        $sheet->setCellValue('D3', 'Instansi');
        $sheet->setCellValue(
            'E3',
            $filter['filterInstansi'] !== ''
                ? $filter['filterInstansi']
                : 'Semua'
        );

        $sheet->setCellValue('G3', 'Kata kunci');
        $sheet->setCellValue(
            'H3',
            $filter['keyword'] !== ''
                ? $filter['keyword']
                : 'Semua'
        );

        $headers = [
            'No.',
            'ID Riwayat',
            'Nomor Antrean',
            'Jenis Antrean',
            'Instansi',
            'Layanan',
            'Petugas',
            'Status',
            'Waktu Masuk',
            'Waktu Mulai',
            'Waktu Selesai',
        ];

        $sheet->fromArray($headers, null, 'A5');

        $sheet->getStyle('A5:K5')->applyFromArray([
            'font' => [
                'bold'  => true,
                'color' => ['rgb' => 'FFFFFF'],
            ],
            'fill' => [
                'fillType'   => Fill::FILL_SOLID,
                'startColor' => ['rgb' => '4472C4'],
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical'   => Alignment::VERTICAL_CENTER,
                'wrapText'   => true,
            ],
        ]);

        $sheet->getRowDimension(5)->setRowHeight(30);

        $baris = 6;

        foreach ($laporan as $index => $row) {
            $sheet->fromArray([
                $index + 1,
                $row['riwayat_id'] ?? '',
                $row['nomor_antrean'] ?? '',
                $row['jenis_antrean'] ?? '',
                $row['nama_instansi'] ?? '',
                $row['nama_layanan'] ?? '',
                $row['nama_petugas'] ?? '',
                $row['status_layanan'] ?? '',
                $row['waktu_masuk'] ?? '',
                $row['waktu_mulai'] ?? '',
                $row['waktu_selesai'] ?? '',
            ], null, 'A' . $baris);

            $baris++;
        }

        $barisTerakhir = max(5, $baris - 1);

        $sheet->getStyle('A5:K' . $barisTerakhir)
            ->getBorders()
            ->getAllBorders()
            ->setBorderStyle(Border::BORDER_THIN);

        $sheet->getStyle('A5:K' . $barisTerakhir)
            ->getAlignment()
            ->setVertical(Alignment::VERTICAL_CENTER);

        if ($baris > 6) {
            $sheet->getStyle('C6:C' . ($baris - 1))
                ->getNumberFormat()
                ->setFormatCode('@');
        }

        foreach (range('A', 'K') as $kolom) {
            $sheet->getColumnDimension($kolom)->setAutoSize(true);
        }

        // Lebar kolom minimum.
        $sheet->getColumnDimension('A')->setWidth(8);
        $sheet->getColumnDimension('B')->setWidth(13);
        $sheet->getColumnDimension('C')->setWidth(18);
        $sheet->getColumnDimension('E')->setWidth(25);
        $sheet->getColumnDimension('F')->setWidth(25);
        $sheet->getColumnDimension('G')->setWidth(20);

        $sheet->freezePane('A6');
        $sheet->setAutoFilter('A5:K' . $barisTerakhir);

        $namaFile = 'laporan-proses-antrean-'
            . $filter['tanggalMulai'] . '-'
            . $filter['tanggalSelesai'] . '.xlsx';

        $tempFile = tempnam(sys_get_temp_dir(), 'laporan_antrean_');

        if ($tempFile === false) {
            $spreadsheet->disconnectWorksheets();

            throw new RuntimeException(
                'Gagal membuat file sementara untuk ekspor Excel.'
            );
        }

        try {
            $writer = new Xlsx($spreadsheet);
            $writer->save($tempFile);

            $isiFile = file_get_contents($tempFile);

            if ($isiFile === false) {
                throw new RuntimeException(
                    'Gagal membaca file Excel yang dibuat.'
                );
            }
        } finally {
            if (is_file($tempFile)) {
                unlink($tempFile);
            }

            $spreadsheet->disconnectWorksheets();
        }

        return $this->response->download(
            $namaFile,
            $isiFile,
            true
        )->setFileName($namaFile);
    }

    /**
     * Halaman laporan ringkasan antrean.
     */
    public function laporanRingkasanAntrean()
    {
        return view('admin/laporan_ringkasan_antrean', [
            'activeMenu' => 'laporan-ringkasan-antrean',
        ]);
    }

    /**
     * Halaman pengaturan layar.
     */   
    public function pengaturanLayar()
    {
        return view('admin/pengaturan_layar', [
            'activeMenu' => 'pengaturan-layar',
        ]);
    }


    /**
     * Halaman log user login.
     */
    public function logUserLogin()
    {
        return view('admin/log_user_login', [
            'activeMenu' => 'log-user-login',
        ]);
    }

    /**
     * Halaman absensi petugas.
     */
    public function absensiPetugas()
    {
        return view('admin/absensi_petugas', [
            'activeMenu' => 'absensi-petugas',
        ]);
    }

}