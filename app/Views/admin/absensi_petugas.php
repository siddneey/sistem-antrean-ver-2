<?= $this->extend('layouts/admin') ?>

<?= $this->section('pageTitle') ?>

<?= $this->endSection() ?>

<?= $this->section('styles') ?>
<style>
    .absensi-page {
        --absensi-navy: var(--navy, #10233f);
        --absensi-yellow-soft: var(--yellow-soft, #fff8dc);
        --absensi-border: var(--border, #e4e8ee);
        --absensi-muted: var(--muted, #7b8798);
        --absensi-text: var(--text, #1d2939);
    }

    .absensi-page .page-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 15px;
        margin-bottom: 22px;
    }

    .absensi-page .page-title h1 {
        color: var(--absensi-navy);
        font-size: 25px;
        font-weight: 700;
        margin: 0;
    }

    .absensi-page .page-title p {
        color: var(--absensi-muted);
        font-size: 12px;
        margin: 6px 0 0;
    }

    .absensi-page .btn-primary-custom {
        min-height: 40px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 7px;
        padding: 0 16px;
        border: none;
        border-radius: 8px;
        background: var(--absensi-navy);
        color: white;
        font-size: 13px;
        font-weight: 600;
        cursor: pointer;
        transition: .2s ease;
    }

    .absensi-page .btn-primary-custom:hover {
        background: var(--navy-light, #193456);
        color: white;
    }

    .absensi-page .stat-grid {
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));
        gap: 15px;
        margin-bottom: 20px;
    }

    .absensi-page .stat-card {
        background: white;
        border: 1px solid var(--absensi-border);
        border-radius: 9px;
        min-height: 88px;
        padding: 16px;
        display: flex;
        align-items: center;
        gap: 13px;
    }

    .absensi-page .stat-icon {
        width: 43px;
        height: 43px;
        min-width: 43px;
        border-radius: 9px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: var(--absensi-yellow-soft);
        color: var(--absensi-navy);
        font-size: 18px;
    }

    .absensi-page .stat-icon.green {
        background: #eaf7ef;
        color: #198754;
    }

    .absensi-page .stat-icon.red {
        background: #fff0ef;
        color: #d9534f;
    }

    .absensi-page .stat-icon.blue {
        background: #eef5ff;
        color: #3976b8;
    }

    .absensi-page .stat-info span {
        display: block;
        color: var(--absensi-muted);
        font-size: 11px;
        margin-bottom: 4px;
    }

    .absensi-page .stat-info strong {
        color: var(--absensi-navy);
        font-size: 21px;
    }

    .absensi-page .filter-card {
        background: white;
        border: 1px solid var(--absensi-border);
        border-radius: 9px;
        padding: 17px;
        margin-bottom: 20px;
        display: flex;
        align-items: flex-end;
        gap: 13px;
        flex-wrap: wrap;
    }

    .absensi-page .filter-title {
        align-self: center;
        color: var(--absensi-navy);
        font-size: 13px;
        font-weight: 700;
        margin-right: 4px;
    }

    .absensi-page .filter-title i {
        margin-right: 5px;
    }

    .absensi-page .filter-group label {
        display: block;
        color: var(--absensi-muted);
        font-size: 11px;
        margin-bottom: 5px;
    }

    .absensi-page .filter-input,
    .absensi-page .filter-select {
        height: 38px;
        padding: 0 10px;
        border: 1px solid var(--absensi-border);
        border-radius: 7px;
        background: white;
        color: var(--absensi-text);
        outline: none;
        font-size: 12px;
    }

    .absensi-page .filter-input {
        width: 210px;
    }

    .absensi-page .filter-select {
        width: 175px;
    }

    .absensi-page .filter-input:focus,
    .absensi-page .filter-select:focus {
        border-color: var(--absensi-navy);
        box-shadow: 0 0 0 3px rgba(16, 35, 63, .06);
    }

    .absensi-page .btn-reset {
        height: 38px;
        padding: 0 13px;
        border: 1px solid var(--absensi-border);
        border-radius: 7px;
        background: white;
        color: #667085;
        font-size: 12px;
        cursor: pointer;
        white-space: nowrap;
    }

    .absensi-page .btn-reset:hover {
        background: #f7f8fa;
    }

    .absensi-page .table-card {
        background: white;
        border: 1px solid var(--absensi-border);
        border-radius: 9px;
        overflow: hidden;
    }

    .absensi-page .table-header {
        padding: 17px 20px;
        border-bottom: 1px solid var(--absensi-border);
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
    }

    .absensi-page .table-header h3 {
        color: var(--absensi-navy);
        font-size: 15px;
        margin: 0;
    }

    .absensi-page .table-header p {
        color: var(--absensi-muted);
        font-size: 11px;
        margin: 4px 0 0;
    }

    .absensi-page .attendance-table {
        width: 100%;
        min-width: 950px;
        border-collapse: collapse;
        margin: 0;
    }

    .absensi-page .attendance-table th {
        height: 48px;
        padding: 0 14px;
        background: #fafafa;
        color: #667085;
        border-bottom: 1px solid var(--absensi-border);
        font-size: 11px;
        font-weight: 700;
        text-align: left;
        white-space: nowrap;
    }

    .absensi-page .attendance-table td {
        padding: 12px 14px;
        color: #667085;
        border-bottom: 1px solid #edf0f3;
        font-size: 12px;
        vertical-align: middle;
    }

    .absensi-page .attendance-table tbody tr:hover td {
        background: #fcfcfc;
    }

    .absensi-page .user-info {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .absensi-page .user-avatar {
        width: 36px;
        height: 36px;
        min-width: 36px;
        border-radius: 50%;
        background: var(--absensi-yellow-soft);
        color: var(--absensi-navy);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 12px;
        font-weight: 700;
    }

    .absensi-page .user-name {
        display: block;
        color: var(--absensi-text);
        font-size: 12px;
        font-weight: 600;
    }

    .absensi-page .user-desc {
        display: block;
        color: #98a2b3;
        font-size: 10px;
        margin-top: 2px;
    }

    .absensi-page .status-badge {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        padding: 5px 9px;
        border-radius: 5px;
        font-size: 10px;
        font-weight: 600;
        white-space: nowrap;
    }

    .absensi-page .status-hadir {
        background: #eaf7ef;
        color: #198754;
    }

    .absensi-page .status-terlambat {
        background: #fff8dc;
        color: #987500;
    }

    .absensi-page .status-izin {
        background: #eef5ff;
        color: #3976b8;
    }

    .absensi-page .status-alpha {
        background: #fff0ef;
        color: #d9534f;
    }

    .absensi-page .action-group {
        display: flex;
        gap: 6px;
    }

    .absensi-page .action-btn {
        width: 32px;
        height: 32px;
        border: 1px solid var(--absensi-border);
        border-radius: 7px;
        background: white;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        font-size: 13px;
        color: var(--absensi-navy);
        transition: .2s ease;
    }

    .absensi-page .action-btn:hover {
        background: var(--absensi-yellow-soft);
        border-color: #eadfbd;
    }

    .absensi-page .empty-content {
        padding: 40px;
        text-align: center;
    }

    .absensi-page .empty-content i {
        display: block;
        color: #b4beca;
        font-size: 30px;
        margin-bottom: 8px;
    }

    .absensi-page .empty-content strong {
        display: block;
        color: #667085;
        font-size: 13px;
    }

    .absensi-page .empty-content span {
        display: block;
        color: #98a2b3;
        font-size: 11px;
        margin-top: 4px;
    }

    .absensi-page .table-footer {
        padding: 12px 15px;
        border-top: 1px solid var(--absensi-border);
        color: #98a2b3;
        font-size: 11px;
    }

    /* Modal khusus halaman absensi */
    #modalDetail .modal-content {
        border: none;
        border-radius: 10px;
        overflow: hidden;
    }

    #modalDetail .modal-header {
        background: var(--navy, #10233f);
        color: white;
        border: none;
        padding: 16px 20px;
    }

    #modalDetail .modal-title {
        font-size: 16px;
        font-weight: 700;
    }

    #modalDetail .modal-header .btn-close {
        filter: brightness(0) invert(1);
    }

    #modalDetail .modal-body {
        padding: 22px;
    }

    #modalDetail .detail-label {
        color: var(--muted, #7b8798);
        font-size: 11px;
        margin-bottom: 5px;
    }

    #modalDetail .detail-value {
        color: var(--text, #1d2939);
        font-size: 13px;
        font-weight: 600;
        margin-bottom: 18px;
        overflow-wrap: anywhere;
    }

    #modalDetail .modal-footer {
        padding: 13px 20px;
        border-top: 1px solid var(--border, #e4e8ee);
    }

    @media (max-width: 1200px) {
        .absensi-page .stat-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }

        .absensi-page .filter-input {
            width: 190px;
        }
    }

    @media (max-width: 800px) {
        .absensi-page .page-header {
            align-items: flex-start;
            flex-direction: column;
        }

        .absensi-page .filter-card {
            flex-direction: column;
            align-items: stretch;
        }

        .absensi-page .filter-title {
            align-self: flex-start;
        }

        .absensi-page .filter-input,
        .absensi-page .filter-select,
        .absensi-page .btn-reset {
            width: 100%;
        }
    }

    @media (max-width: 550px) {
        .absensi-page .stat-grid {
            grid-template-columns: 1fr;
        }

        .absensi-page .page-title h1 {
            font-size: 22px;
        }

        #modalDetail .modal-body {
            padding: 16px;
        }
    }
</style>
<?= $this->endSection() ?>


<?= $this->section('content') ?>

<?php
/*
|--------------------------------------------------------------------------
| DATA ABSENSI SEMENTARA
|--------------------------------------------------------------------------
| Data contoh untuk tampilan. Belum terhubung ke database.
*/

$absensi = [
    [
        'id' => 1,
        'nama' => 'bapenda1',
        'instansi' => 'BAPENDA',
        'tanggal' => date('Y-m-d'),
        'jam_masuk' => '07:55',
        'jam_pulang' => '-',
        'status' => 'Hadir',
        'keterangan' => 'Hadir tepat waktu',
    ],
    [
        'id' => 2,
        'nama' => 'bapenda2',
        'instansi' => 'BAPENDA',
        'tanggal' => date('Y-m-d'),
        'jam_masuk' => '08:12',
        'jam_pulang' => '-',
        'status' => 'Terlambat',
        'keterangan' => 'Datang melewati jam masuk',
    ],
    [
        'id' => 3,
        'nama' => 'bpjskes',
        'instansi' => 'BPJS KESEHATAN',
        'tanggal' => date('Y-m-d'),
        'jam_masuk' => '07:50',
        'jam_pulang' => '-',
        'status' => 'Hadir',
        'keterangan' => 'Hadir tepat waktu',
    ],
    [
        'id' => 4,
        'nama' => 'bpkd1',
        'instansi' => 'BPKD',
        'tanggal' => date('Y-m-d'),
        'jam_masuk' => '-',
        'jam_pulang' => '-',
        'status' => 'Izin',
        'keterangan' => 'Izin tidak masuk',
    ],
    [
        'id' => 5,
        'nama' => 'dpmptsp1',
        'instansi' => 'DPMPTSP',
        'tanggal' => date('Y-m-d'),
        'jam_masuk' => '07:58',
        'jam_pulang' => '-',
        'status' => 'Hadir',
        'keterangan' => 'Hadir tepat waktu',
    ],
    [
        'id' => 6,
        'nama' => 'dukcapil',
        'instansi' => 'DUKCAPIL',
        'tanggal' => date('Y-m-d'),
        'jam_masuk' => '-',
        'jam_pulang' => '-',
        'status' => 'Alpha',
        'keterangan' => 'Tidak ada keterangan',
    ],
    [
        'id' => 7,
        'nama' => 'disnaker1',
        'instansi' => 'DISNAKER',
        'tanggal' => date('Y-m-d'),
        'jam_masuk' => '07:53',
        'jam_pulang' => '-',
        'status' => 'Hadir',
        'keterangan' => 'Hadir tepat waktu',
    ],
    [
        'id' => 8,
        'nama' => 'samsat1',
        'instansi' => 'SAMSAT',
        'tanggal' => date('Y-m-d'),
        'jam_masuk' => '08:10',
        'jam_pulang' => '-',
        'status' => 'Terlambat',
        'keterangan' => 'Datang melewati jam masuk',
    ],
    [
        'id' => 9,
        'nama' => 'dishub1',
        'instansi' => 'DISHUB',
        'tanggal' => date('Y-m-d'),
        'jam_masuk' => '07:48',
        'jam_pulang' => '-',
        'status' => 'Hadir',
        'keterangan' => 'Hadir tepat waktu',
    ],
    [
        'id' => 10,
        'nama' => 'pbg1',
        'instansi' => 'PELAYANAN PBG',
        'tanggal' => date('Y-m-d'),
        'jam_masuk' => '-',
        'jam_pulang' => '-',
        'status' => 'Alpha',
        'keterangan' => 'Tidak ada keterangan',
    ],
];

$totalAbsensi = count($absensi);
$totalHadir = count(array_filter(
    $absensi,
    fn($item) => $item['status'] === 'Hadir'
));
$totalTerlambat = count(array_filter(
    $absensi,
    fn($item) => $item['status'] === 'Terlambat'
));
$totalTidakHadir = count(array_filter(
    $absensi,
    fn($item) => in_array($item['status'], ['Izin', 'Alpha'], true)
));

$instansiList = array_values(array_unique(array_column($absensi, 'instansi')));
sort($instansiList);
?>

<div class="absensi-page">

    <div class="page-header">
        <div class="page-title">
            <h1>Absensi Petugas</h1>
            <p>Pantau kehadiran petugas pada setiap instansi MPP Kota Tangerang.</p>
        </div>

        <button type="button" class="btn-primary-custom" onclick="exportAbsensi()">
            <i class="bi bi-download"></i>
            Export CSV
        </button>
    </div>

    <!-- STATISTIK -->
    <div class="stat-grid">
        <div class="stat-card">
            <div class="stat-icon">
                <i class="bi bi-people-fill"></i>
            </div>
            <div class="stat-info">
                <span>Total Data Absensi</span>
                <strong><?= $totalAbsensi ?></strong>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon green">
                <i class="bi bi-person-check-fill"></i>
            </div>
            <div class="stat-info">
                <span>Hadir</span>
                <strong><?= $totalHadir ?></strong>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon red">
                <i class="bi bi-clock-history"></i>
            </div>
            <div class="stat-info">
                <span>Terlambat</span>
                <strong><?= $totalTerlambat ?></strong>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon blue">
                <i class="bi bi-person-x-fill"></i>
            </div>
            <div class="stat-info">
                <span>Izin / Alpha</span>
                <strong><?= $totalTidakHadir ?></strong>
            </div>
        </div>
    </div>

    <!-- FILTER -->
    <div class="filter-card">
        <div class="filter-title">
            <i class="bi bi-funnel"></i>
            Filter Absensi
        </div>

        <div class="filter-group">
            <label for="searchAbsensi">Cari Petugas</label>
            <input
                type="text"
                id="searchAbsensi"
                class="filter-input"
                placeholder="Cari nama petugas..."
            >
        </div>

        <div class="filter-group">
            <label for="filterInstansi">Instansi</label>
            <select id="filterInstansi" class="filter-select">
                <option value="">Semua Instansi</option>
                <?php foreach ($instansiList as $instansi): ?>
                    <option value="<?= esc($instansi) ?>">
                        <?= esc($instansi) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="filter-group">
            <label for="filterStatus">Status Kehadiran</label>
            <select id="filterStatus" class="filter-select">
                <option value="">Semua Status</option>
                <option value="Hadir">Hadir</option>
                <option value="Terlambat">Terlambat</option>
                <option value="Izin">Izin</option>
                <option value="Alpha">Alpha</option>
            </select>
        </div>

        <div class="filter-group">
            <label for="filterTanggal">Tanggal Absensi</label>
            <input
                type="date"
                id="filterTanggal"
                class="filter-input"
                value="<?= date('Y-m-d') ?>"
            >
        </div>

        <button type="button" class="btn-reset" onclick="resetFilter()">
            <i class="bi bi-arrow-counterclockwise"></i>
            Reset
        </button>
    </div>

    <!-- TABEL ABSENSI -->
    <div class="table-card">
        <div class="table-header">
            <div>
                <h3>Data Absensi Petugas</h3>
                <p>Daftar kehadiran petugas berdasarkan tanggal dan instansi.</p>
            </div>
        </div>

        <div class="table-responsive">
            <table class="attendance-table">
                <thead>
                    <tr>
                        <th width="55">No</th>
                        <th>Nama Petugas</th>
                        <th>Instansi</th>
                        <th>Tanggal</th>
                        <th>Jam Masuk</th>
                        <th>Jam Pulang</th>
                        <th>Status</th>
                        <th width="90">Aksi</th>
                    </tr>
                </thead>

                <tbody id="absensiTableBody">
                    <?php foreach ($absensi as $index => $item): ?>
                        <?php
                        $statusClass = match ($item['status']) {
                            'Hadir' => 'status-hadir',
                            'Terlambat' => 'status-terlambat',
                            'Izin' => 'status-izin',
                            default => 'status-alpha',
                        };
                        ?>

                        <tr
                            data-id="<?= esc((string) $item['id']) ?>"
                            data-nama="<?= esc(strtolower($item['nama'])) ?>"
                            data-instansi="<?= esc($item['instansi']) ?>"
                            data-tanggal="<?= esc($item['tanggal']) ?>"
                            data-status="<?= esc($item['status']) ?>"
                            data-jam-masuk="<?= esc($item['jam_masuk']) ?>"
                            data-jam-pulang="<?= esc($item['jam_pulang']) ?>"
                            data-keterangan="<?= esc($item['keterangan']) ?>"
                        >
                            <td class="row-number"><?= $index + 1 ?></td>

                            <td>
                                <div class="user-info">
                                    <div class="user-avatar">
                                        <?= esc(strtoupper(substr($item['nama'], 0, 1))) ?>
                                    </div>
                                    <div>
                                        <span class="user-name">
                                            <?= esc($item['nama']) ?>
                                        </span>
                                        <span class="user-desc">Petugas MPP</span>
                                    </div>
                                </div>
                            </td>

                            <td><?= esc($item['instansi']) ?></td>
                            <td>
                                <?= esc(date('d-m-Y', strtotime($item['tanggal']))) ?>
                            </td>
                            <td><?= esc($item['jam_masuk']) ?></td>
                            <td><?= esc($item['jam_pulang']) ?></td>

                            <td>
                                <span class="status-badge <?= $statusClass ?>">
                                    <i class="bi bi-circle-fill"></i>
                                    <?= esc($item['status']) ?>
                                </span>
                            </td>

                            <td>
                                <div class="action-group">
                                    <button
                                        type="button"
                                        class="action-btn"
                                        title="Lihat Detail"
                                        aria-label="Lihat detail absensi <?= esc($item['nama']) ?>"
                                        onclick="lihatDetail(this)"
                                    >
                                        <i class="bi bi-eye"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>

                    <tr id="emptyRow" style="display: none;">
                        <td colspan="8">
                            <div class="empty-content">
                                <i class="bi bi-calendar2-x"></i>
                                <strong>Data absensi tidak ditemukan</strong>
                                <span>Coba ubah kata pencarian atau filter.</span>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="table-footer">
            <span id="resultInfo">
                Menampilkan <?= $totalAbsensi ?> data absensi
            </span>
        </div>
    </div>

</div>

<!-- MODAL DETAIL -->
<div class="modal fade" id="modalDetail" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="bi bi-clipboard-check me-2"></i>
                    Detail Absensi Petugas
                </h5>
                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Tutup"
                ></button>
            </div>

            <div class="modal-body">
                <div class="row">
                    <div class="col-6">
                        <div class="detail-label">Nama Petugas</div>
                        <div class="detail-value" id="detailNama">-</div>
                    </div>

                    <div class="col-6">
                        <div class="detail-label">Instansi</div>
                        <div class="detail-value" id="detailInstansi">-</div>
                    </div>

                    <div class="col-6">
                        <div class="detail-label">Tanggal</div>
                        <div class="detail-value" id="detailTanggal">-</div>
                    </div>

                    <div class="col-6">
                        <div class="detail-label">Status</div>
                        <div class="detail-value" id="detailStatus">-</div>
                    </div>

                    <div class="col-6">
                        <div class="detail-label">Jam Masuk</div>
                        <div class="detail-value" id="detailMasuk">-</div>
                    </div>

                    <div class="col-6">
                        <div class="detail-label">Jam Pulang</div>
                        <div class="detail-value" id="detailPulang">-</div>
                    </div>

                    <div class="col-12">
                        <div class="detail-label">Keterangan</div>
                        <div class="detail-value" id="detailKeterangan">-</div>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button
                    type="button"
                    class="btn btn-light btn-sm"
                    data-bs-dismiss="modal"
                >
                    Tutup
                </button>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>


<?= $this->section('scripts') ?>
<script>
    (() => {
        const searchInput = document.getElementById('searchAbsensi');
        const filterInstansi = document.getElementById('filterInstansi');
        const filterStatus = document.getElementById('filterStatus');
        const filterTanggal = document.getElementById('filterTanggal');
        const tableBody = document.getElementById('absensiTableBody');
        const emptyRow = document.getElementById('emptyRow');
        const resultInfo = document.getElementById('resultInfo');

        if (!searchInput || !tableBody) return;

        const getRows = () =>
            Array.from(tableBody.querySelectorAll('tr[data-nama]'));

        function formatTanggal(tanggal) {
            if (!tanggal) return '-';

            const parts = tanggal.split('-');
            if (parts.length !== 3) return tanggal;

            const date = new Date(
                Number(parts[0]),
                Number(parts[1]) - 1,
                Number(parts[2])
            );

            return date.toLocaleDateString('id-ID', {
                day: '2-digit',
                month: 'long',
                year: 'numeric'
            });
        }

        function filterAbsensi() {
            const keyword = searchInput.value.toLowerCase().trim();
            const instansi = filterInstansi.value;
            const status = filterStatus.value;
            const tanggal = filterTanggal.value;

            let jumlah = 0;

            getRows().forEach((row) => {
                const cocokNama = row.dataset.nama.includes(keyword);
                const cocokInstansi =
                    !instansi || row.dataset.instansi === instansi;
                const cocokStatus =
                    !status || row.dataset.status === status;
                const cocokTanggal =
                    !tanggal || row.dataset.tanggal === tanggal;

                const tampil =
                    cocokNama &&
                    cocokInstansi &&
                    cocokStatus &&
                    cocokTanggal;

                row.style.display = tampil ? '' : 'none';

                if (tampil) {
                    jumlah++;
                    row.querySelector('.row-number').textContent = jumlah;
                }
            });

            emptyRow.style.display = jumlah === 0 ? 'table-row' : 'none';
            resultInfo.textContent = `Menampilkan ${jumlah} data absensi`;
        }

        window.resetFilter = function () {
            searchInput.value = '';
            filterInstansi.value = '';
            filterStatus.value = '';
            filterTanggal.value = '';
            filterAbsensi();
        };

        window.lihatDetail = function (button) {
            const row = button.closest('tr');
            if (!row) return;

            const nama = row.querySelector('.user-name')?.textContent.trim();

            document.getElementById('detailNama').textContent = nama || '-';
            document.getElementById('detailInstansi').textContent =
                row.dataset.instansi || '-';
            document.getElementById('detailTanggal').textContent =
                formatTanggal(row.dataset.tanggal);
            document.getElementById('detailStatus').textContent =
                row.dataset.status || '-';
            document.getElementById('detailMasuk').textContent =
                row.dataset.jamMasuk || '-';
            document.getElementById('detailPulang').textContent =
                row.dataset.jamPulang || '-';
            document.getElementById('detailKeterangan').textContent =
                row.dataset.keterangan || '-';

            bootstrap.Modal.getOrCreateInstance(
                document.getElementById('modalDetail')
            ).show();
        };

        window.exportAbsensi = function () {
            const rows = getRows().filter(
                row => row.style.display !== 'none'
            );

            if (rows.length === 0) {
                alert('Tidak ada data absensi untuk diekspor.');
                return;
            }

            const data = [[
                'No',
                'Nama Petugas',
                'Instansi',
                'Tanggal',
                'Jam Masuk',
                'Jam Pulang',
                'Status',
                'Keterangan'
            ]];

            rows.forEach((row, index) => {
                data.push([
                    index + 1,
                    row.querySelector('.user-name')?.textContent.trim() || '',
                    row.dataset.instansi || '',
                    row.dataset.tanggal || '',
                    row.dataset.jamMasuk || '',
                    row.dataset.jamPulang || '',
                    row.dataset.status || '',
                    row.dataset.keterangan || ''
                ]);
            });

            const csv = data.map(row =>
                row.map(value =>
                    '"' + String(value ?? '').replace(/"/g, '""') + '"'
                ).join(',')
            ).join('\r\n');

            const blob = new Blob(['\uFEFF' + csv], {
                type: 'text/csv;charset=utf-8;'
            });

            const url = URL.createObjectURL(blob);
            const link = document.createElement('a');

            link.href = url;
            link.download = 'absensi-petugas.csv';
            document.body.appendChild(link);
            link.click();
            link.remove();

            // Beri waktu browser mulai mengunduh sebelum URL dilepas.
            setTimeout(() => URL.revokeObjectURL(url), 1000);
        };

        searchInput.addEventListener('input', filterAbsensi);
        filterInstansi.addEventListener('change', filterAbsensi);
        filterStatus.addEventListener('change', filterAbsensi);
        filterTanggal.addEventListener('change', filterAbsensi);

        filterAbsensi();
    })();
</script>
<?= $this->endSection() ?>