<?= $this->extend('layouts/admin') ?>

<?= $this->section('pageTitle') ?>

<?= $this->endSection() ?>

<?= $this->section('styles') ?>
<style>
    /* HEADER */
    .page-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 15px;
        margin-bottom: 22px;
    }

    .page-title h1 {
        color: var(--navy);
        font-size: 25px;
        font-weight: 700;
        margin: 0;
    }

    .page-title p {
        color: var(--muted);
        font-size: 12px;
        margin: 6px 0 0;
    }

    .btn-export {
        height: 40px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        padding: 0 15px;
        border: 1px solid #cfe7d8;
        border-radius: 8px;
        background: #edf8f0;
        color: var(--green);
        font-size: 12px;
        font-weight: 600;
        cursor: pointer;
        white-space: nowrap;
        transition: .2s ease;
    }

    .btn-export:hover {
        background: #d9f0e1;
    }

    /* STATISTICS */
    .log-stat-grid {
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));
        gap: 15px;
        margin-bottom: 20px;
    }

    .log-stat-card {
        background: #fff;
        border: 1px solid var(--border);
        border-radius: 9px;
        min-height: 94px;
        padding: 16px;
        display: flex;
        align-items: center;
        gap: 13px;
    }

    .log-stat-icon {
        width: 43px;
        height: 43px;
        min-width: 43px;
        border-radius: 9px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: var(--yellow-soft);
        color: var(--navy);
        font-size: 18px;
    }

    .log-stat-icon.green {
        background: #eaf7ef;
        color: var(--green);
    }

    .log-stat-icon.blue {
        background: #eef5ff;
        color: #3976b8;
    }

    .log-stat-icon.red {
        background: #fff0ef;
        color: var(--red);
    }

    .log-stat-info span {
        display: block;
        color: var(--muted);
        font-size: 11px;
        margin-bottom: 5px;
    }

    .log-stat-info strong {
        color: var(--navy);
        font-size: 22px;
    }

    /* FILTER */
    .log-filter-card {
        background: #fff;
        border: 1px solid var(--border);
        border-radius: 9px;
        padding: 17px;
        margin-bottom: 20px;
    }

    .log-filter-heading {
        color: var(--navy);
        font-size: 13px;
        font-weight: 700;
        margin-bottom: 14px;
    }

    .log-filter-heading i {
        margin-right: 6px;
    }

    .log-filter-grid {
        display: grid;
        grid-template-columns: minmax(220px, 1.5fr)
            repeat(3, minmax(140px, 1fr)) auto;
        align-items: end;
        gap: 13px;
    }

    .log-filter-group label {
        display: block;
        color: var(--muted);
        font-size: 11px;
        margin-bottom: 6px;
    }

    .log-filter-control {
        width: 100%;
        height: 39px;
        padding: 0 10px;
        border: 1px solid var(--border);
        border-radius: 7px;
        background: #fff;
        color: var(--text);
        outline: none;
        font-size: 12px;
    }

    .log-filter-control:focus {
        border-color: var(--navy);
        box-shadow: 0 0 0 3px rgba(16, 35, 63, .06);
    }

    .log-btn-reset {
        height: 39px;
        padding: 0 13px;
        border: 1px solid var(--border);
        border-radius: 7px;
        background: #fff;
        color: #667085;
        font-size: 12px;
        cursor: pointer;
        white-space: nowrap;
    }

    .log-btn-reset:hover {
        background: #f7f8fa;
    }

    .log-filter-note {
        margin-top: 12px;
        color: var(--muted);
        font-size: 11px;
    }

    /* TABLE */
    .log-table-card {
        background: #fff;
        border: 1px solid var(--border);
        border-radius: 9px;
        overflow: hidden;
    }

    .log-table-header {
        padding: 17px 20px;
        border-bottom: 1px solid var(--border);
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
    }

    .log-table-header h3 {
        color: var(--navy);
        font-size: 15px;
        margin: 0;
    }

    .log-table-header p {
        color: var(--muted);
        font-size: 11px;
        margin: 5px 0 0;
    }

    .log-live-label {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 6px 9px;
        border-radius: 6px;
        background: #edf8f0;
        color: var(--green);
        font-size: 10px;
        font-weight: 700;
        white-space: nowrap;
    }

    .log-live-label i {
        font-size: 7px;
    }

    .log-table-responsive {
        overflow-x: auto;
    }

    .log-table {
        width: 100%;
        min-width: 1000px;
        border-collapse: collapse;
    }

    .log-table th {
        height: 47px;
        padding: 0 14px;
        background: #fafafa;
        color: #667085;
        border-bottom: 1px solid var(--border);
        font-size: 11px;
        font-weight: 700;
        text-align: left;
        white-space: nowrap;
    }

    .log-table td {
        padding: 13px 14px;
        color: #667085;
        border-bottom: 1px solid #edf0f3;
        font-size: 12px;
        vertical-align: middle;
    }

    .log-table tbody tr:hover td {
        background: #fcfcfc;
    }

    .log-table tbody tr:last-child td {
        border-bottom: none;
    }

    .log-user {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .log-user-avatar {
        width: 36px;
        height: 36px;
        min-width: 36px;
        border-radius: 9px;
        background: var(--yellow-soft);
        color: var(--navy);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 12px;
        font-weight: 700;
    }

    .log-user-name {
        display: block;
        color: var(--text);
        font-size: 12px;
        font-weight: 600;
    }

    .log-user-desc {
        display: block;
        color: #98a2b3;
        font-size: 10px;
        margin-top: 3px;
    }

    .log-instansi-badge {
        display: inline-block;
        padding: 5px 8px;
        border-radius: 5px;
        background: #f1f3f5;
        color: #667085;
        font-size: 10px;
    }

    .log-activity {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 5px 8px;
        border-radius: 5px;
        font-size: 10px;
        font-weight: 600;
        white-space: nowrap;
    }

    .log-activity.login {
        background: #eaf7ef;
        color: var(--green);
    }

    .log-activity.logout {
        background: #eef5ff;
        color: #3976b8;
    }

    .log-activity.failed {
        background: #fff0ef;
        color: var(--red);
    }

    .log-time-main {
        display: block;
        color: var(--text);
        font-weight: 600;
        font-size: 12px;
    }

    .log-time-sub {
        display: block;
        color: #98a2b3;
        font-size: 10px;
        margin-top: 3px;
    }

    .log-ip-address {
        font-family: Consolas, monospace;
        font-size: 11px;
        color: #667085;
    }

    .log-action-btn {
        width: 32px;
        height: 32px;
        border: 1px solid var(--border);
        border-radius: 7px;
        background: #fff;
        color: var(--navy);
        display: inline-flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: .2s ease;
    }

    .log-action-btn:hover {
        background: var(--yellow-soft);
        border-color: #eadfbd;
    }

    .log-empty-row {
        display: none;
    }

    .log-empty-content {
        padding: 35px 20px;
        text-align: center;
    }

    .log-empty-content i {
        display: block;
        color: #b4beca;
        font-size: 30px;
        margin-bottom: 9px;
    }

    .log-empty-content strong {
        display: block;
        color: #667085;
        font-size: 13px;
    }

    .log-empty-content span {
        display: block;
        color: #98a2b3;
        font-size: 11px;
        margin-top: 5px;
    }

    .log-table-footer {
        padding: 13px 17px;
        border-top: 1px solid var(--border);
        color: #98a2b3;
        font-size: 11px;
        display: flex;
        justify-content: space-between;
        gap: 10px;
    }

    /* DETAIL MODAL: khusus halaman ini */
    #logDetailModal .modal-content {
        border: none;
        border-radius: 10px;
        overflow: hidden;
    }

    #logDetailModal .modal-header {
        background: var(--navy);
        color: #fff;
        border: none;
        padding: 16px 20px;
    }

    #logDetailModal .modal-title {
        font-size: 16px;
        font-weight: 700;
    }

    #logDetailModal .btn-close {
        filter: brightness(0) invert(1);
    }

    #logDetailModal .modal-body {
        padding: 22px;
    }

    #logDetailModal .detail-item {
        padding: 12px 0;
        border-bottom: 1px solid var(--border);
    }

    #logDetailModal .detail-item:last-child {
        border-bottom: none;
    }

    #logDetailModal .detail-label {
        display: block;
        color: var(--muted);
        font-size: 11px;
        margin-bottom: 5px;
    }

    #logDetailModal .detail-value {
        color: var(--text);
        font-size: 13px;
        font-weight: 600;
        overflow-wrap: anywhere;
    }

    /* RESPONSIVE */
    @media (max-width: 1200px) {
        .log-filter-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }

        .log-stat-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }
    }

    @media (max-width: 800px) {
        .page-header {
            align-items: flex-start;
            flex-direction: column;
        }

        .log-filter-grid {
            grid-template-columns: 1fr;
        }

        .btn-export {
            width: 100%;
        }
    }

    @media (max-width: 550px) {
        .log-stat-grid {
            grid-template-columns: 1fr;
        }

        .log-table-footer {
            flex-direction: column;
        }
    }
</style>
<?= $this->endSection() ?>


<?= $this->section('content') ?>

<?php
/*
 * DATA CONTOH SEMENTARA.
 * Nantinya ganti dengan data dari controller/database.
 */
$logs = $logs ?? [
    [
        'id' => 1, 'username' => 'bapenda1', 'instansi' => 'BAPENDA',
        'aktivitas' => 'Login Berhasil', 'tanggal' => '2026-10-08',
        'waktu' => '08:15:23', 'ip' => '192.168.10.21',
        'perangkat' => 'Chrome / Windows', 'status' => 'Berhasil',
        'logout' => 'Belum logout'
    ],
    [
        'id' => 2, 'username' => 'bapenda2', 'instansi' => 'BAPENDA',
        'aktivitas' => 'Logout', 'tanggal' => '2026-10-08',
        'waktu' => '08:03:11', 'ip' => '192.168.10.22',
        'perangkat' => 'Chrome / Windows', 'status' => 'Berhasil',
        'logout' => '08:03:11'
    ],
    [
        'id' => 3, 'username' => 'bpjskes', 'instansi' => 'BPJS KESEHATAN',
        'aktivitas' => 'Login Berhasil', 'tanggal' => '2026-10-08',
        'waktu' => '07:58:42', 'ip' => '192.168.10.31',
        'perangkat' => 'Edge / Windows', 'status' => 'Berhasil',
        'logout' => 'Belum logout'
    ],
    [
        'id' => 4, 'username' => 'bpkd2', 'instansi' => 'BPKD',
        'aktivitas' => 'Login Gagal', 'tanggal' => '2026-10-08',
        'waktu' => '07:45:10', 'ip' => '192.168.10.42',
        'perangkat' => 'Chrome / Android', 'status' => 'Gagal',
        'logout' => '-'
    ],
    [
        'id' => 5, 'username' => 'dpmptsp1', 'instansi' => 'DPMPTSP',
        'aktivitas' => 'Login Berhasil', 'tanggal' => '2026-10-07',
        'waktu' => '15:40:05', 'ip' => '192.168.10.51',
        'perangkat' => 'Chrome / Windows', 'status' => 'Berhasil',
        'logout' => '16:12:30'
    ],
    [
        'id' => 6, 'username' => 'dukcapil', 'instansi' => 'DUKCAPIL',
        'aktivitas' => 'Logout', 'tanggal' => '2026-10-07',
        'waktu' => '15:20:19', 'ip' => '192.168.10.61',
        'perangkat' => 'Firefox / Windows', 'status' => 'Berhasil',
        'logout' => '15:20:19'
    ],
    [
        'id' => 7, 'username' => 'disnaker1', 'instansi' => 'DISNAKER',
        'aktivitas' => 'Login Berhasil', 'tanggal' => '2026-10-07',
        'waktu' => '08:09:44', 'ip' => '192.168.10.71',
        'perangkat' => 'Chrome / Windows', 'status' => 'Berhasil',
        'logout' => '15:01:08'
    ],
    [
        'id' => 8, 'username' => 'samsat1', 'instansi' => 'SAMSAT',
        'aktivitas' => 'Login Gagal', 'tanggal' => '2026-10-06',
        'waktu' => '09:12:03', 'ip' => '192.168.10.81',
        'perangkat' => 'Chrome / Windows', 'status' => 'Gagal',
        'logout' => '-'
    ],
    [
        'id' => 9, 'username' => 'atrbpn1', 'instansi' => 'ATR BPN',
        'aktivitas' => 'Login Berhasil', 'tanggal' => '2026-10-06',
        'waktu' => '08:30:12', 'ip' => '192.168.10.91',
        'perangkat' => 'Edge / Windows', 'status' => 'Berhasil',
        'logout' => '14:00:02'
    ],
    [
        'id' => 10, 'username' => 'dishub1', 'instansi' => 'DISHUB',
        'aktivitas' => 'Logout', 'tanggal' => '2026-10-06',
        'waktu' => '13:45:55', 'ip' => '192.168.10.15',
        'perangkat' => 'Chrome / Android', 'status' => 'Berhasil',
        'logout' => '13:45:55'
    ],
];

$totalLog = count($logs);
$totalLogin = count(array_filter(
    $logs,
    fn($log) => $log['aktivitas'] === 'Login Berhasil'
));
$totalLogout = count(array_filter(
    $logs,
    fn($log) => $log['aktivitas'] === 'Logout'
));
$totalGagal = count(array_filter(
    $logs,
    fn($log) => $log['aktivitas'] === 'Login Gagal'
));

$instansiList = array_values(array_unique(
    array_column($logs, 'instansi')
));
sort($instansiList);
?>

<div class="page-header">
    <div class="page-title">
        <h1>Log User Login</h1>
        <p>Pantau riwayat login, logout, dan aktivitas akses pengguna pada sistem MPP Kota Tangerang.</p>
    </div>

    <button type="button" class="btn-export" id="logExportBtn">
        <i class="bi bi-file-earmark-spreadsheet"></i>
        Export CSV
    </button>
</div>

<!-- STATISTIK -->
<div class="log-stat-grid">
    <div class="log-stat-card">
        <div class="log-stat-icon">
            <i class="bi bi-clock-history"></i>
        </div>
        <div class="log-stat-info">
            <span>Total Aktivitas</span>
            <strong><?= $totalLog ?></strong>
        </div>
    </div>

    <div class="log-stat-card">
        <div class="log-stat-icon green">
            <i class="bi bi-box-arrow-in-right"></i>
        </div>
        <div class="log-stat-info">
            <span>Login Berhasil</span>
            <strong><?= $totalLogin ?></strong>
        </div>
    </div>

    <div class="log-stat-card">
        <div class="log-stat-icon blue">
            <i class="bi bi-box-arrow-right"></i>
        </div>
        <div class="log-stat-info">
            <span>Aktivitas Logout</span>
            <strong><?= $totalLogout ?></strong>
        </div>
    </div>

    <div class="log-stat-card">
        <div class="log-stat-icon red">
            <i class="bi bi-shield-exclamation"></i>
        </div>
        <div class="log-stat-info">
            <span>Login Gagal</span>
            <strong><?= $totalGagal ?></strong>
        </div>
    </div>
</div>

<!-- FILTER -->
<div class="log-filter-card">
    <div class="log-filter-heading">
        <i class="bi bi-funnel"></i>
        Filter Riwayat Aktivitas
    </div>

    <div class="log-filter-grid">
        <div class="log-filter-group">
            <label for="logSearch">Cari Pengguna</label>
            <input type="search" id="logSearch" class="log-filter-control"
                   placeholder="Username atau alamat IP...">
        </div>

        <div class="log-filter-group">
            <label for="logFilterInstansi">Instansi</label>
            <select id="logFilterInstansi" class="log-filter-control">
                <option value="">Semua Instansi</option>
                <?php foreach ($instansiList as $instansi): ?>
                    <option value="<?= esc($instansi) ?>"><?= esc($instansi) ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="log-filter-group">
            <label for="logFilterAktivitas">Jenis Aktivitas</label>
            <select id="logFilterAktivitas" class="log-filter-control">
                <option value="">Semua Aktivitas</option>
                <option value="Login Berhasil">Login Berhasil</option>
                <option value="Logout">Logout</option>
                <option value="Login Gagal">Login Gagal</option>
            </select>
        </div>

        <div class="log-filter-group">
            <label for="logFilterTanggal">Tanggal</label>
            <input type="date" id="logFilterTanggal" class="log-filter-control">
        </div>

        <button type="button" class="log-btn-reset" id="logResetBtn">
            <i class="bi bi-arrow-counterclockwise"></i>
            Reset
        </button>
    </div>

    <div class="log-filter-note">
        <i class="bi bi-info-circle"></i>
        Gunakan filter untuk menemukan riwayat akses pengguna secara lebih cepat.
    </div>
</div>

<!-- TABEL -->
<div class="log-table-card">
    <div class="log-table-header">
        <div>
            <h3>Riwayat Login Pengguna</h3>
            <p>Catatan aktivitas masuk dan keluar dari sistem.</p>
        </div>
        <span class="log-live-label">
            <i class="bi bi-circle-fill"></i>
            Riwayat Aktivitas
        </span>
    </div>

    <div class="log-table-responsive">
        <table class="log-table">
            <thead>
                <tr>
                    <th width="55">No</th>
                    <th>Pengguna</th>
                    <th>Instansi</th>
                    <th>Aktivitas</th>
                    <th>Waktu</th>
                    <th>Alamat IP</th>
                    <th>Perangkat</th>
                    <th width="75">Detail</th>
                </tr>
            </thead>

            <tbody id="logTableBody">
                <?php foreach ($logs as $index => $log): ?>
                    <?php
                    $activityClass = 'login';
                    $activityIcon = 'bi-box-arrow-in-right';

                    if ($log['aktivitas'] === 'Logout') {
                        $activityClass = 'logout';
                        $activityIcon = 'bi-box-arrow-right';
                    } elseif ($log['aktivitas'] === 'Login Gagal') {
                        $activityClass = 'failed';
                        $activityIcon = 'bi-shield-exclamation';
                    }
                    ?>

                    <tr
                        data-username="<?= esc(strtolower($log['username'])) ?>"
                        data-instansi="<?= esc($log['instansi']) ?>"
                        data-aktivitas="<?= esc($log['aktivitas']) ?>"
                        data-tanggal="<?= esc($log['tanggal']) ?>"
                        data-waktu="<?= esc($log['waktu']) ?>"
                        data-ip="<?= esc($log['ip']) ?>"
                        data-perangkat="<?= esc($log['perangkat']) ?>"
                        data-status="<?= esc($log['status']) ?>"
                        data-logout="<?= esc($log['logout']) ?>"
                    >
                        <td class="log-row-number"><?= $index + 1 ?></td>

                        <td>
                            <div class="log-user">
                                <div class="log-user-avatar">
                                    <?= esc(strtoupper(substr($log['username'], 0, 1))) ?>
                                </div>
                                <div>
                                    <span class="log-user-name"><?= esc($log['username']) ?></span>
                                    <span class="log-user-desc">Akun pengguna</span>
                                </div>
                            </div>
                        </td>

                        <td>
                            <span class="log-instansi-badge"><?= esc($log['instansi']) ?></span>
                        </td>

                        <td>
                            <span class="log-activity <?= $activityClass ?>">
                                <i class="bi <?= $activityIcon ?>"></i>
                                <?= esc($log['aktivitas']) ?>
                            </span>
                        </td>

                        <td>
                            <span class="log-time-main"><?= esc($log['waktu']) ?> WIB</span>
                            <span class="log-time-sub">
                                <?= esc(date('d M Y', strtotime($log['tanggal']))) ?>
                            </span>
                        </td>

                        <td><span class="log-ip-address"><?= esc($log['ip']) ?></span></td>
                        <td><?= esc($log['perangkat']) ?></td>

                        <td>
                            <button type="button"
                                    class="log-action-btn"
                                    title="Lihat detail"
                                    aria-label="Lihat detail log"
                                    data-log-detail>
                                <i class="bi bi-eye"></i>
                            </button>
                        </td>
                    </tr>
                <?php endforeach; ?>

                <tr id="logEmptyRow" class="log-empty-row">
                    <td colspan="8">
                        <div class="log-empty-content">
                            <i class="bi bi-search"></i>
                            <strong>Data log tidak ditemukan</strong>
                            <span>Coba ubah kata pencarian atau filter yang digunakan.</span>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="log-table-footer">
        <span id="logResultInfo">Menampilkan <?= $totalLog ?> aktivitas</span>
        <span>Data contoh untuk tampilan antarmuka</span>
    </div>
</div>

<!-- MODAL DETAIL -->
<div class="modal fade" id="logDetailModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="bi bi-clock-history me-2"></i>
                    Detail Aktivitas
                </h5>
                <button type="button" class="btn-close"
                        data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>

            <div class="modal-body">
                <div class="detail-item">
                    <span class="detail-label">Username</span>
                    <div class="detail-value" id="logDetailUsername">-</div>
                </div>
                <div class="detail-item">
                    <span class="detail-label">Instansi</span>
                    <div class="detail-value" id="logDetailInstansi">-</div>
                </div>
                <div class="detail-item">
                    <span class="detail-label">Jenis Aktivitas</span>
                    <div class="detail-value" id="logDetailAktivitas">-</div>
                </div>
                <div class="detail-item">
                    <span class="detail-label">Waktu Aktivitas</span>
                    <div class="detail-value" id="logDetailWaktu">-</div>
                </div>
                <div class="detail-item">
                    <span class="detail-label">Alamat IP</span>
                    <div class="detail-value" id="logDetailIP">-</div>
                </div>
                <div class="detail-item">
                    <span class="detail-label">Perangkat</span>
                    <div class="detail-value" id="logDetailPerangkat">-</div>
                </div>
                <div class="detail-item">
                    <span class="detail-label">Status</span>
                    <div class="detail-value" id="logDetailStatus">-</div>
                </div>
                <div class="detail-item">
                    <span class="detail-label">Waktu Logout</span>
                    <div class="detail-value" id="logDetailLogout">-</div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-light btn-sm"
                        data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>


<?= $this->section('scripts') ?>
<script>
(() => {
    const search = document.getElementById('logSearch');
    const filterInstansi = document.getElementById('logFilterInstansi');
    const filterAktivitas = document.getElementById('logFilterAktivitas');
    const filterTanggal = document.getElementById('logFilterTanggal');
    const emptyRow = document.getElementById('logEmptyRow');
    const resultInfo = document.getElementById('logResultInfo');
    const tableBody = document.getElementById('logTableBody');
    const modalElement = document.getElementById('logDetailModal');

    if (!search || !tableBody) return;

    const getRows = () =>
        Array.from(tableBody.querySelectorAll('tr[data-username]'));

    function filterLog() {
        const keyword = search.value.toLowerCase().trim();
        const instansi = filterInstansi.value;
        const aktivitas = filterAktivitas.value;
        const tanggal = filterTanggal.value;
        let jumlah = 0;

        getRows().forEach(row => {
            const cocokPengguna =
                row.dataset.username.includes(keyword) ||
                row.dataset.ip.toLowerCase().includes(keyword);

            const cocokInstansi =
                !instansi || row.dataset.instansi === instansi;

            const cocokAktivitas =
                !aktivitas || row.dataset.aktivitas === aktivitas;

            const cocokTanggal =
                !tanggal || row.dataset.tanggal === tanggal;

            const tampil =
                cocokPengguna &&
                cocokInstansi &&
                cocokAktivitas &&
                cocokTanggal;

            row.style.display = tampil ? '' : 'none';

            if (tampil) {
                jumlah++;
                row.querySelector('.log-row-number').textContent = jumlah;
            }
        });

        emptyRow.style.display = jumlah === 0 ? 'table-row' : 'none';
        resultInfo.textContent = `Menampilkan ${jumlah} aktivitas`;
    }

    search.addEventListener('input', filterLog);
    filterInstansi.addEventListener('change', filterLog);
    filterAktivitas.addEventListener('change', filterLog);
    filterTanggal.addEventListener('change', filterLog);

    document.getElementById('logResetBtn').addEventListener('click', () => {
        search.value = '';
        filterInstansi.value = '';
        filterAktivitas.value = '';
        filterTanggal.value = '';
        filterLog();
    });

    /* DETAIL AKTIVITAS */
    tableBody.addEventListener('click', event => {
        const button = event.target.closest('[data-log-detail]');
        if (!button) return;

        const row = button.closest('tr');
        const tanggal = new Date(row.dataset.tanggal + 'T00:00:00')
            .toLocaleDateString('id-ID', {
                day: '2-digit',
                month: 'long',
                year: 'numeric'
            });

        const details = {
            logDetailUsername: row.dataset.username,
            logDetailInstansi: row.dataset.instansi,
            logDetailAktivitas: row.dataset.aktivitas,
            logDetailWaktu: `${tanggal}, ${row.dataset.waktu} WIB`,
            logDetailIP: row.dataset.ip,
            logDetailPerangkat: row.dataset.perangkat,
            logDetailStatus: row.dataset.status,
            logDetailLogout: row.dataset.logout
        };

        Object.entries(details).forEach(([id, value]) => {
            document.getElementById(id).textContent = value || '-';
        });

        bootstrap.Modal
            .getOrCreateInstance(modalElement)
            .show();
    });

    /* EXPORT CSV BERDASARKAN FILTER AKTIF */
    document.getElementById('logExportBtn').addEventListener('click', () => {
        const data = [[
            'No', 'Username', 'Instansi', 'Aktivitas', 'Tanggal',
            'Waktu', 'Alamat IP', 'Perangkat', 'Status', 'Waktu Logout'
        ]];

        let nomor = 1;

        getRows().forEach(row => {
            if (row.style.display === 'none') return;

            data.push([
                nomor++,
                row.dataset.username,
                row.dataset.instansi,
                row.dataset.aktivitas,
                row.dataset.tanggal,
                row.dataset.waktu,
                row.dataset.ip,
                row.dataset.perangkat,
                row.dataset.status,
                row.dataset.logout
            ]);
        });

        if (data.length === 1) {
            alert('Tidak ada data untuk diekspor. Periksa filter terlebih dahulu.');
            return;
        }

        const csv = data.map(record =>
            record.map(value =>
                '"' + String(value).replace(/"/g, '""') + '"'
            ).join(',')
        ).join('\r\n');

        const blob = new Blob(['\uFEFF' + csv], {
            type: 'text/csv;charset=utf-8;'
        });

        const url = URL.createObjectURL(blob);
        const link = document.createElement('a');

        link.href = url;
        link.download = 'log-user-login.csv';
        document.body.appendChild(link);
        link.click();
        link.remove();

        setTimeout(() => URL.revokeObjectURL(url), 1000);
    });

    filterLog();
})();
</script>
<?= $this->endSection() ?>