<?php

namespace App\Controllers;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Cell\DataType;
use RuntimeException;

class AdminController extends BaseController
{
    
    /**
     * Dashboard khusus Admin.
     */
    public function dashboard()
    {
        $db = \Config\Database::connect();

        $tanggalHariIni = date('Y-m-d');
        $tanggalInput = $this->request->getGet('tanggal');

        // Validasi tanggal yang dipilih.
        $tanggalDipilih = $this->validasiTanggal($tanggalInput)
            ? $tanggalInput
            : $tanggalHariIni;

        // Rekap jumlah layanan yang selesai berdasarkan tanggal antrean.
        // LEFT JOIN memastikan semua instansi tetap muncul,
        // meskipun belum memiliki antrean pada tanggal tersebut.
        $sql = "
            SELECT
                i.id,
                i.nama_instansi,
                i.logo,
                i.status,
                COALESCE(rekap.total_selesai, 0) AS total_selesai
            FROM instansi i
            LEFT JOIN (
                SELECT
                    rl.instansi_id,
                    COUNT(rl.id) AS total_selesai
                FROM riwayat_layanan rl
                INNER JOIN antrean a
                    ON a.id = rl.antrean_id
                WHERE a.tanggal_antrean = ?
                AND rl.status_layanan = 'SELESAI'
                GROUP BY rl.instansi_id
            ) rekap ON rekap.instansi_id = i.id
            ORDER BY i.nama_instansi ASC
        ";

        $instansi = $db->query($sql, [$tanggalDipilih])
            ->getResultArray();

        $totalInstansi = count($instansi);
        $totalAktif = 0;
        $totalNonaktif = 0;
        $totalSelesai = 0;

        foreach ($instansi as $item) {
            $status = strtolower(trim((string) ($item['status'] ?? 'aktif')));

            if ($status === 'aktif') {
                $totalAktif++;
            } else {
                $totalNonaktif++;
            }

            $totalSelesai += (int) $item['total_selesai'];
        }

        return view('admin/dashboard', [
            'activeMenu'     => 'dashboard',
            'tanggalHariIni' => $tanggalHariIni,
            'tanggalDipilih' => $tanggalDipilih,
            'instansi'       => $instansi,
            'totalInstansi'  => $totalInstansi,
            'totalAktif'     => $totalAktif,
            'totalNonaktif'  => $totalNonaktif,
            'totalSelesai'   => $totalSelesai,
        ]);
    }

    /**
     * Simpan status aktual instansi.
     * Hanya menerima request POST dari Admin.
     */
    public function updateStatusInstansi($id)
    {
        if (! $this->request->isAJAX()) {
            return $this->response->setStatusCode(400)->setJSON([
                'success' => false,
                'message' => 'Request tidak valid.',
            ]);
        }

        $status = $this->request->getPost('status');

        if (! in_array($status, ['Aktif', 'Nonaktif'], true)) {
            return $this->response->setStatusCode(422)->setJSON([
                'success' => false,
                'message' => 'Status tidak valid.',
                'status'   => $status,
                'csrfHash' => csrf_hash(),
            ]);
        }

        $db = \Config\Database::connect();
        $builder = $db->table('instansi');

        $instansi = $builder->where('id', (int) $id)->get()->getRowArray();

        if (! $instansi) {
            return $this->response->setStatusCode(404)->setJSON([
                'success' => false,
                'message' => 'Instansi tidak ditemukan.',
            ]);
        }

        $berhasil = $db->table('instansi')
            ->where('id', (int) $id)
            ->update(['status' => $status]);

        if (! $berhasil) {
            return $this->response->setStatusCode(500)->setJSON([
                'success' => false,
                'message' => 'Status gagal disimpan.',
            ]);
        }

        return $this->response->setJSON([
            'success' => true,
            'message' => 'Status instansi berhasil diperbarui.',
            'status'  => $status,
            'csrfHash' => csrf_hash(),
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

        if (!in_array($status, ['', 'menunggu', 'dilayani', 'pending', 'selesai'], true)) {
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
        } elseif ($filter['filterStatus'] === 'dilayani') {
            $builder->whereIn(
                'rl.status_layanan',
                ['DIPANGGIL', 'DILAYANI']
            );
        } elseif ($filter['filterStatus'] === 'pending') {
            $builder->where(
                'rl.status_layanan',
                'PENDING'
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
     * Halaman ringkasan laporan antrean.
     */
    public function laporanRingkasanAntrean()
    {
        $filter = $this->getFilterLaporan();
        $db = \Config\Database::connect();

        $builder = $db->table('riwayat_layanan rl');

        $builder->select([
            'i.id AS instansi_id',
            'i.nama_instansi',
            'l.nama_layanan',
            'COUNT(rl.id) AS total_riwayat',
        ]);

        $builder->join(
            'antrean a',
            'a.id = rl.antrean_id',
            'inner'
        );

        $builder->join(
            'instansi i',
            'i.id = rl.instansi_id',
            'inner'
        );

        $builder->join(
            'layanan l',
            'l.id = rl.layanan_id',
            'left'
        );

        $builder->where(
            "UPPER(TRIM(rl.status_layanan)) = 'SELESAI'",
            null,
            false
        );
        $builder->where(
            'a.tanggal_antrean >=',
            $filter['tanggalMulai']
        );
        $builder->where(
            'a.tanggal_antrean <=',
            $filter['tanggalSelesai']
        );

        if ($filter['filterInstansi'] !== '') {
            $builder->where(
                'i.id',
                $filter['filterInstansi']
            );
        }

        $builder->groupBy([
            'i.id',
            'i.nama_instansi',
            'l.nama_layanan',
        ]);

        $builder->orderBy('i.nama_instansi', 'ASC');
        $builder->orderBy('l.nama_layanan', 'ASC');

        $ringkasan = $builder->get()->getResultArray();

        $daftarInstansi = $db->table('instansi')
            ->select('id, nama_instansi')
            ->orderBy('nama_instansi', 'ASC')
            ->get()
            ->getResultArray();

        return view('admin/laporan_ringkasan_antrean', array_merge(
            $filter,
            [
                'activeMenu'     => 'laporan-ringkasan-antrean',
                'ringkasan'      => $ringkasan,
                'daftarInstansi' => $daftarInstansi,
            ]
        ));
    }

    /**
     * Ekspor ringkasan laporan ringkasan antrean ke Excel.
     */
    public function exportLaporanRingkasanAntrean()
    {
        $filter = $this->getFilterLaporan();

        $tanggalMulai   = $filter['tanggalMulai'];
        $tanggalSelesai = $filter['tanggalSelesai'];
        $filterInstansi = $filter['filterInstansi'];

        $db = \Config\Database::connect();

        $builder = $db->table('riwayat_layanan rl');

        $builder->select([
            'i.id AS instansi_id',
            'i.nama_instansi',
            'l.nama_layanan',
            'COUNT(rl.id) AS total_riwayat',
        ]);

        $builder->join(
            'antrean a',
            'a.id = rl.antrean_id',
            'inner'
        );

        // Instansi yang tercatat pada riwayat layanan.
        $builder->join(
            'instansi i',
            'i.id = rl.instansi_id',
            'inner'
        );

        $builder->join(
            'layanan l',
            'l.id = rl.layanan_id',
            'left'
        );

        $builder->where(
            "UPPER(TRIM(rl.status_layanan)) = 'SELESAI'",
            null,
            false
        );

        $builder->where(
            'a.tanggal_antrean >=',
            $tanggalMulai
        );

        $builder->where(
            'a.tanggal_antrean <=',
            $tanggalSelesai
        );

        if ($filterInstansi !== '' && $filterInstansi !== null) {
            $builder->where(
                'rl.instansi_id',
                $filterInstansi
            );
        }

        $builder->groupBy([
            'i.id',
            'i.nama_instansi',
            'l.nama_layanan',
        ]);

        $builder->orderBy('i.nama_instansi', 'ASC');
        $builder->orderBy('l.nama_layanan', 'ASC');

        $ringkasan = $builder->get()->getResultArray();

        /*
        |--------------------------------------------------------------------------
        | Buat file Excel
        |--------------------------------------------------------------------------
        */

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $sheet->setTitle('Ringkasan Antrean');

        // Judul.
        $sheet->setCellValue('A1', 'RINGKASAN LAPORAN ANTREAN');
        $sheet->mergeCells('A1:D1');

        $sheet->getStyle('A1:D1')->applyFromArray([
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

        // Informasi periode.
        $sheet->setCellValue('A2', 'Periode');
        $sheet->setCellValue(
            'B2',
            $tanggalMulai . ' s.d. ' . $tanggalSelesai
        );

        // Nama instansi untuk informasi filter.
        $namaInstansiFilter = 'Semua';

        if ($filterInstansi !== '' && $filterInstansi !== null) {
            $instansi = $db->table('instansi')
                ->select('nama_instansi')
                ->where('id', $filterInstansi)
                ->get()
                ->getRowArray();

            $namaInstansiFilter = $instansi['nama_instansi'] ?? 'Tidak ditemukan';
        }

        $sheet->setCellValue('A3', 'Instansi');
        $sheet->setCellValue('B3', $namaInstansiFilter);

        // Header tabel.
        $headers = [
            'No.',
            'Instansi',
            'Layanan',
            'Jumlah Riwayat Layanan',
        ];

        $sheet->fromArray($headers, null, 'A5');

        $sheet->getStyle('A5:D5')->applyFromArray([
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

        // Isi tabel.
        $baris = 6;
        $totalRiwayat = 0;

        foreach ($ringkasan as $index => $row) {
            $jumlah = (int) ($row['total_riwayat'] ?? 0);
            $totalRiwayat += $jumlah;

            $sheet->fromArray([
                $index + 1,
                $row['nama_instansi'] ?? '',
                $row['nama_layanan'] ?? 'Tidak ada layanan',
                $jumlah,
            ], null, 'A' . $baris);

            $baris++;
        }

        // Jika tidak ada data, beri informasi pada tabel.
        if (empty($ringkasan)) {
            $sheet->mergeCells('A6:D6');
            $sheet->setCellValue('A6', 'Tidak ada data pada periode yang dipilih.');

            $sheet->getStyle('A6:D6')
                ->getAlignment()
                ->setHorizontal(Alignment::HORIZONTAL_CENTER);

            $baris = 7;
        }

        // Baris total.
        $sheet->setCellValue('A' . $baris, 'TOTAL');
        $sheet->mergeCells('A' . $baris . ':C' . $baris);
        $sheet->setCellValue('D' . $baris, $totalRiwayat);

        $sheet->getStyle('A' . $baris . ':D' . $baris)->applyFromArray([
            'font' => [
                'bold' => true,
            ],
            'fill' => [
                'fillType'   => Fill::FILL_SOLID,
                'startColor' => ['rgb' => 'D9EAF7'],
            ],
        ]);

        // Border dan perataan.
        $barisTerakhir = $baris;

        $sheet->getStyle('A5:D' . $barisTerakhir)
            ->getBorders()
            ->getAllBorders()
            ->setBorderStyle(Border::BORDER_THIN);

        $sheet->getStyle('A5:D' . $barisTerakhir)
            ->getAlignment()
            ->setVertical(Alignment::VERTICAL_CENTER);

        $sheet->getStyle('A5:A' . $barisTerakhir)
            ->getAlignment()
            ->setHorizontal(Alignment::HORIZONTAL_CENTER);

        $sheet->getStyle('D6:D' . $barisTerakhir)
            ->getAlignment()
            ->setHorizontal(Alignment::HORIZONTAL_CENTER);

        // Lebar kolom.
        $sheet->getColumnDimension('A')->setWidth(8);
        $sheet->getColumnDimension('B')->setWidth(30);
        $sheet->getColumnDimension('C')->setWidth(30);
        $sheet->getColumnDimension('D')->setWidth(28);

        $sheet->freezePane('A6');

        if (!empty($ringkasan)) {
            $sheet->setAutoFilter('A5:D' . ($baris - 1));
        }

        /*
        |--------------------------------------------------------------------------
        | Download Excel
        |--------------------------------------------------------------------------
        */

        $namaFile = 'ringkasan-laporan-antrean-'
            . $tanggalMulai . '-'
            . $tanggalSelesai . '.xlsx';

        try {
            $writer = new Xlsx($spreadsheet);

            ob_start();
            $writer->save('php://output');
            $isiFile = ob_get_clean();

            if ($isiFile === false) {
                throw new \RuntimeException(
                    'Gagal membuat file Excel.'
                );
            }
        } finally {
            $spreadsheet->disconnectWorksheets();
        }

        return $this->response
            ->download($namaFile, $isiFile, true)
            ->setFileName($namaFile);
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
     * ============================================================
     * DATA ABSENSI PETUGAS
     * ============================================================
     *
     * Absensi dihitung berdasarkan aktivitas pada log_user_login:
     *
     * - Login Berhasil pertama = jam masuk.
     * - Logout terakhir = jam pulang.
     * - Petugas yang memiliki Login Berhasil = Hadir.
     * - Petugas tanpa Login Berhasil = Tidak Hadir.
     *
     * Hanya user dengan role_id = 2 yang ditampilkan.
     */
    private function getDataAbsensiPetugas(array $filter): array
    {
        $db = \Config\Database::connect();

        /*
        |--------------------------------------------------------------------------
        | Ambil seluruh petugas
        |--------------------------------------------------------------------------
        */

        $builderPetugas = $db->table('users u');

        $builderPetugas->select([
            'u.id',
            'u.username',
            'u.instansi_id',
            'i.nama_instansi',
        ]);

        $builderPetugas->join(
            'instansi i',
            'i.id = u.instansi_id',
            'left'
        );

        $builderPetugas->where('u.role_id', 2);

        /*
        |--------------------------------------------------------------------------
        | Filter instansi
        |--------------------------------------------------------------------------
        */

        if ($filter['instansi_id'] !== '') {
            $builderPetugas->where(
                'u.instansi_id',
                (int) $filter['instansi_id']
            );
        }

        /*
        |--------------------------------------------------------------------------
        | Filter username petugas
        |--------------------------------------------------------------------------
        */

        if ($filter['keyword'] !== '') {
            $builderPetugas->like(
                'u.username',
                $filter['keyword']
            );
        }

        $petugas = $builderPetugas
            ->orderBy('u.username', 'ASC')
            ->get()
            ->getResultArray();

        /*
        |--------------------------------------------------------------------------
        | Ambil log login pertama
        |--------------------------------------------------------------------------
        */

        $tanggal = $filter['tanggal'];

        $loginPertama = $db->table('log_user_login')
            ->select([
                'user_id',
                'MIN(waktu) AS waktu_login',
            ])
            ->where('aktivitas', 'Login Berhasil')
            ->where('waktu >=', $tanggal . ' 00:00:00')
            ->where('waktu <=', $tanggal . ' 23:59:59')
            ->groupBy('user_id')
            ->get()
            ->getResultArray();

        $loginMap = [];

        foreach ($loginPertama as $login) {
            $loginMap[(int) $login['user_id']] =
                $login['waktu_login'];
        }

        /*
        |--------------------------------------------------------------------------
        | Ambil log logout terakhir
        |--------------------------------------------------------------------------
        */

        $logoutTerakhir = $db->table('log_user_login')
            ->select([
                'user_id',
                'MAX(waktu) AS waktu_logout',
            ])
            ->where('aktivitas', 'Logout')
            ->where('waktu >=', $tanggal . ' 00:00:00')
            ->where('waktu <=', $tanggal . ' 23:59:59')
            ->groupBy('user_id')
            ->get()
            ->getResultArray();

        $logoutMap = [];

        foreach ($logoutTerakhir as $logout) {
            $logoutMap[(int) $logout['user_id']] =
                $logout['waktu_logout'];
        }

        /*
        |--------------------------------------------------------------------------
        | Susun data absensi
        |--------------------------------------------------------------------------
        */

        $data = [];

        foreach ($petugas as $item) {
            $userId = (int) $item['id'];

            $waktuLogin = $loginMap[$userId] ?? null;
            $waktuLogout = $logoutMap[$userId] ?? null;

            $hadir = $waktuLogin !== null;

            $data[] = [
                'id'        => $userId,
                'username'  => (string) ($item['username'] ?? '-'),
                'instansi'  => (string) (
                    $item['nama_instansi'] ?? 'Belum memiliki instansi'
                ),
                'tanggal'   => $tanggal,
                'jam_masuk' => $waktuLogin
                    ? date('H:i:s', strtotime($waktuLogin))
                    : '-',
                'jam_pulang' => $waktuLogout
                    ? date('H:i:s', strtotime($waktuLogout))
                    : '-',
                'status' => $hadir
                    ? 'Hadir'
                    : 'Tidak Hadir',
                'keterangan' => $hadir
                    ? 'Tercatat login pada tanggal absensi.'
                    : 'Tidak ada aktivitas login pada tanggal absensi.',
            ];
        }

        /*
        |--------------------------------------------------------------------------
        | Filter status
        |--------------------------------------------------------------------------
        */

        if ($filter['status'] !== '') {
            $data = array_values(
                array_filter(
                    $data,
                    static fn ($item) =>
                        $item['status'] === $filter['status']
                )
            );
        }

        return $data;
    }


    /**
     * ============================================================
     * HALAMAN ABSENSI PETUGAS
     * ============================================================
     */
    public function absensiPetugas()
    {
        $tanggalInput = $this->request->getGet('tanggal');

        $tanggal = $this->validasiTanggal($tanggalInput)
            ? $tanggalInput
            : date('Y-m-d');

        $keyword = trim(
            (string) $this->request->getGet('keyword')
        );

        $instansiId = trim(
            (string) $this->request->getGet('instansi')
        );

        $status = trim(
            (string) $this->request->getGet('status')
        );

        if (!in_array(
            $status,
            ['', 'Hadir', 'Tidak Hadir'],
            true
        )) {
            $status = '';
        }

        $filter = [
            'tanggal'     => $tanggal,
            'keyword'     => $keyword,
            'instansi_id' => $instansiId,
            'status'      => $status,
        ];

        /*
        |--------------------------------------------------------------------------
        | Data absensi
        |--------------------------------------------------------------------------
        */

        $absensi = $this->getDataAbsensiPetugas(
            $filter
        );

        /*
        |--------------------------------------------------------------------------
        | Summary
        |--------------------------------------------------------------------------
        */

        $totalHadir = count(
            array_filter(
                $absensi,
                static fn ($item) =>
                    $item['status'] === 'Hadir'
            )
        );

        $totalTidakHadir = count(
            array_filter(
                $absensi,
                static fn ($item) =>
                    $item['status'] === 'Tidak Hadir'
            )
        );

        /*
        |--------------------------------------------------------------------------
        | Daftar instansi untuk filter
        |--------------------------------------------------------------------------
        */

        $db = \Config\Database::connect();

        $daftarInstansi = $db->table('instansi')
            ->select([
                'id',
                'nama_instansi',
            ])
            ->orderBy('nama_instansi', 'ASC')
            ->get()
            ->getResultArray();

        return view('admin/absensi_petugas', [
            'activeMenu'       => 'absensi-petugas',
            'absensi'          => $absensi,
            'totalHadir'       => $totalHadir,
            'totalTidakHadir'  => $totalTidakHadir,
            'daftarInstansi'   => $daftarInstansi,
            'filterTanggal'    => $tanggal,
            'filterKeyword'    => $keyword,
            'filterInstansi'   => $instansiId,
            'filterStatus'     => $status,
        ]);
    }


    /**
     * ============================================================
     * EKSPOR ABSENSI PETUGAS KE EXCEL
     * ============================================================
     */
    public function exportAbsensiPetugas()
    {
        $tanggalInput = $this->request->getGet('tanggal');

        $tanggal = $this->validasiTanggal($tanggalInput)
            ? $tanggalInput
            : date('Y-m-d');

        $keyword = trim(
            (string) $this->request->getGet('keyword')
        );

        $instansiId = trim(
            (string) $this->request->getGet('instansi')
        );

        $status = trim(
            (string) $this->request->getGet('status')
        );

        if (!in_array(
            $status,
            ['', 'Hadir', 'Tidak Hadir'],
            true
        )) {
            $status = '';
        }

        $filter = [
            'tanggal'     => $tanggal,
            'keyword'     => $keyword,
            'instansi_id' => $instansiId,
            'status'      => $status,
        ];

        $absensi = $this->getDataAbsensiPetugas(
            $filter
        );

        /*
        |--------------------------------------------------------------------------
        | Buat Spreadsheet
        |--------------------------------------------------------------------------
        */

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $sheet->setTitle('Absensi Petugas');

        /*
        |--------------------------------------------------------------------------
        | Judul
        |--------------------------------------------------------------------------
        */

        $sheet->setCellValue(
            'A1',
            'LAPORAN ABSENSI PETUGAS'
        );

        $sheet->mergeCells('A1:H1');

        $sheet->getStyle('A1:H1')->applyFromArray([
            'font' => [
                'bold'  => true,
                'size'  => 16,
                'color' => ['rgb' => 'FFFFFF'],
            ],
            'fill' => [
                'fillType'   => Fill::FILL_SOLID,
                'startColor' => ['rgb' => '198754'],
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical'   => Alignment::VERTICAL_CENTER,
            ],
        ]);

        $sheet->getRowDimension(1)
            ->setRowHeight(28);

        /*
        |--------------------------------------------------------------------------
        | Informasi filter
        |--------------------------------------------------------------------------
        */

        $sheet->setCellValue(
            'A2',
            'Tanggal Absensi'
        );

        $sheet->setCellValue(
            'B2',
            date(
                'd-m-Y',
                strtotime($tanggal)
            )
        );

        $sheet->setCellValue(
            'D2',
            'Status'
        );

        $sheet->setCellValue(
            'E2',
            $status !== ''
                ? $status
                : 'Semua'
        );

        /*
        |--------------------------------------------------------------------------
        | Header tabel
        |--------------------------------------------------------------------------
        */

        $headers = [
            'No.',
            'Username Petugas',
            'Instansi',
            'Tanggal',
            'Jam Masuk',
            'Jam Pulang',
            'Status Kehadiran',
            'Keterangan',
        ];

        $sheet->fromArray(
            $headers,
            null,
            'A4'
        );

        $sheet->getStyle('A4:H4')->applyFromArray([
            'font' => [
                'bold'  => true,
                'color' => ['rgb' => 'FFFFFF'],
            ],
            'fill' => [
                'fillType'   => Fill::FILL_SOLID,
                'startColor' => ['rgb' => '198754'],
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical'   => Alignment::VERTICAL_CENTER,
                'wrapText'   => true,
            ],
        ]);

        /*
        |--------------------------------------------------------------------------
        | Isi tabel
        |--------------------------------------------------------------------------
        */

        $baris = 5;

        foreach ($absensi as $index => $item) {
            $sheet->fromArray([
                $index + 1,
                $item['username'],
                $item['instansi'],
                date(
                    'd-m-Y',
                    strtotime($item['tanggal'])
                ),
                $item['jam_masuk'],
                $item['jam_pulang'],
                $item['status'],
                $item['keterangan'],
            ], null, 'A' . $baris);

            $baris++;
        }

        /*
        |--------------------------------------------------------------------------
        | Jika data kosong
        |--------------------------------------------------------------------------
        */

        if (empty($absensi)) {
            $sheet->mergeCells('A5:H5');

            $sheet->setCellValue(
                'A5',
                'Tidak ada data absensi.'
            );

            $sheet->getStyle('A5:H5')
                ->getAlignment()
                ->setHorizontal(
                    Alignment::HORIZONTAL_CENTER
                );

            $baris = 6;
        }

        $barisTerakhir = $baris - 1;

        /*
        |--------------------------------------------------------------------------
        | Style tabel
        |--------------------------------------------------------------------------
        */

        $sheet->getStyle(
            'A4:H' . $barisTerakhir
        )
            ->getBorders()
            ->getAllBorders()
            ->setBorderStyle(
                Border::BORDER_THIN
            );

        $sheet->getStyle(
            'A4:H' . $barisTerakhir
        )
            ->getAlignment()
            ->setVertical(
                Alignment::VERTICAL_CENTER
            );

        $sheet->getStyle(
            'A5:A' . $barisTerakhir
        )
            ->getAlignment()
            ->setHorizontal(
                Alignment::HORIZONTAL_CENTER
            );

        $sheet->getStyle(
            'D5:G' . $barisTerakhir
        )
            ->getAlignment()
            ->setHorizontal(
                Alignment::HORIZONTAL_CENTER
            );

        /*
        |--------------------------------------------------------------------------
        | Lebar kolom
        |--------------------------------------------------------------------------
        */

        $sheet->getColumnDimension('A')
            ->setWidth(8);

        $sheet->getColumnDimension('B')
            ->setWidth(24);

        $sheet->getColumnDimension('C')
            ->setWidth(30);

        $sheet->getColumnDimension('D')
            ->setWidth(15);

        $sheet->getColumnDimension('E')
            ->setWidth(15);

        $sheet->getColumnDimension('F')
            ->setWidth(15);

        $sheet->getColumnDimension('G')
            ->setWidth(20);

        $sheet->getColumnDimension('H')
            ->setWidth(40);

        $sheet->freezePane('A5');

        if (!empty($absensi)) {
            $sheet->setAutoFilter(
                'A4:H' . $barisTerakhir
            );
        }

        /*
        |--------------------------------------------------------------------------
        | Download Excel
        |--------------------------------------------------------------------------
        */

        $namaFile = 'absensi-petugas-'
            . $tanggal
            . '.xlsx';

        $tempFile = tempnam(
            sys_get_temp_dir(),
            'absensi_petugas_'
        );

        if ($tempFile === false) {
            $spreadsheet->disconnectWorksheets();

            throw new RuntimeException(
                'Gagal membuat file sementara.'
            );
        }

        try {
            $writer = new Xlsx($spreadsheet);

            $writer->save($tempFile);

            $isiFile = file_get_contents(
                $tempFile
            );

            if ($isiFile === false) {
                throw new RuntimeException(
                    'Gagal membaca file Excel.'
                );
            }
        } finally {
            if (is_file($tempFile)) {
                unlink($tempFile);
            }

            $spreadsheet->disconnectWorksheets();
        }

        return $this->response
            ->download(
                $namaFile,
                $isiFile,
                true
            )
            ->setFileName($namaFile);
    }

}