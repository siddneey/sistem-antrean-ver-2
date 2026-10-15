```php
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Absensi Petugas - MPP Kota Tangerang</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        :root {
            --navy: #10233f;
            --navy-dark: #0b1a30;
            --navy-light: #193456;
            --yellow: #f5c542;
            --yellow-soft: #fff8dc;
            --bg: #f4f6f9;
            --white: #fff;
            --text: #1d2939;
            --muted: #7b8798;
            --border: #e4e8ee;
            --green: #198754;
            --red: #d9534f;
            --sidebar-width: 260px;
            --sidebar-collapsed: 78px;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
            background: var(--bg);
            color: var(--text);
            min-height: 100vh;
            overflow-x: hidden;
        }

        /* SIDEBAR */
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            width: var(--sidebar-width);
            height: 100vh;
            background: var(--navy);
            color: white;
            z-index: 1000;
            display: flex;
            flex-direction: column;
            overflow: hidden;
            transition: width .35s cubic-bezier(.4, 0, .2, 1);
        }

        .sidebar-header {
            height: 76px;
            min-height: 76px;
            padding: 0 17px;
            display: flex;
            align-items: center;
            border-bottom: 1px solid rgba(255,255,255,.08);
            position: relative;
            transition: padding .35s ease;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 10px;
            min-width: 0;
            transition: opacity .25s ease, transform .35s ease;
        }

        .brand-logo {
            width: 40px;
            height: 40px;
            min-width: 40px;
            border-radius: 10px;
            overflow: hidden;
        }

        .brand-logo img {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }

        .brand-text {
            font-size: 16px;
            font-weight: 700;
            white-space: nowrap;
            overflow: hidden;
        }

        .sidebar-toggle {
            width: 38px;
            height: 38px;
            min-width: 38px;
            border: none;
            background: transparent;
            color: white;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 23px;
            cursor: pointer;
            margin-left: auto;
            transition: background .2s ease, transform .25s ease;
        }

        .sidebar-toggle:hover {
            background: rgba(255,255,255,.09);
        }

        .sidebar-toggle:active {
            transform: scale(.9);
        }

        .welcome {
            padding: 21px 20px 17px;
            min-height: 82px;
            overflow: hidden;
        }

        .welcome small {
            display: block;
            color: rgba(255,255,255,.48);
            font-size: 11px;
            margin-bottom: 4px;
            white-space: nowrap;
        }

        .welcome strong {
            display: block;
            color: white;
            font-size: 14px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .sidebar-menu {
            padding: 4px 11px 20px;
            overflow-y: auto;
            overflow-x: hidden;
            scrollbar-width: thin;
        }

        .menu-title {
            color: rgba(255,255,255,.38);
            font-size: 10px;
            font-weight: 700;
            text-transform: uppercase;
            padding: 11px 10px 7px;
            white-space: nowrap;
            overflow: hidden;
        }

        .menu-item {
            width: 100%;
            height: 42px;
            display: flex;
            align-items: center;
            gap: 13px;
            padding: 0 12px;
            margin-bottom: 3px;
            color: rgba(255,255,255,.72);
            text-decoration: none;
            border-radius: 8px;
            font-size: 13px;
            white-space: nowrap;
            overflow: hidden;
            transition: background .2s ease, color .2s ease, padding .35s ease;
        }

        .menu-item i {
            width: 20px;
            min-width: 20px;
            text-align: center;
            font-size: 16px;
        }

        .menu-item span {
            overflow: hidden;
        }

        .menu-item:hover {
            color: white;
            background: rgba(255,255,255,.08);
        }

        .menu-item.active {
            background: var(--yellow);
            color: var(--navy);
            font-weight: 600;
        }

        body.sidebar-collapsed .sidebar {
            width: var(--sidebar-collapsed);
        }

        body.sidebar-collapsed .sidebar-header {
            padding: 0 20px;
            justify-content: center;
        }

        body.sidebar-collapsed .brand {
            width: 0;
            opacity: 0;
            transform: translateX(-10px);
            pointer-events: none;
        }

        body.sidebar-collapsed .sidebar-toggle {
            margin-left: 0;
        }

        body.sidebar-collapsed .welcome {
            min-height: 35px;
            padding: 8px 0;
            display: flex;
            justify-content: center;
        }

        body.sidebar-collapsed .welcome small,
        body.sidebar-collapsed .welcome strong {
            opacity: 0;
            position: absolute;
            pointer-events: none;
        }

        body.sidebar-collapsed .sidebar-menu {
            padding-left: 10px;
            padding-right: 10px;
        }

        body.sidebar-collapsed .menu-title {
            height: 0;
            padding-top: 0;
            padding-bottom: 0;
            opacity: 0;
        }

        body.sidebar-collapsed .menu-item {
            justify-content: center;
            padding-left: 0;
            padding-right: 0;
            gap: 0;
        }

        body.sidebar-collapsed .menu-item span {
            display: none;
        }

        /* MAIN CONTENT */
        .main-content {
            margin-left: var(--sidebar-width);
            min-height: 100vh;
            padding-top: 76px;
            transition: margin-left .35s cubic-bezier(.4, 0, .2, 1);
        }

        body.sidebar-collapsed .main-content {
            margin-left: var(--sidebar-collapsed);
        }

        /* TOPBAR: SELALU RATA DENGAN ATAS */
        .topbar {
            height: 76px;
            position: fixed;
            top: 0;
            left: var(--sidebar-width);
            right: 0;
            z-index: 900;
            background: var(--white);
            border-bottom: 1px solid var(--border);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 30px;
            transition: left .35s cubic-bezier(.4, 0, .2, 1);
        }

        body.sidebar-collapsed .topbar {
            left: var(--sidebar-collapsed);
        }

        .topbar-left {
            color: var(--navy);
            font-size: 17px;
            font-weight: 700;
        }

        .topbar-left span {
            color: var(--muted);
            font-size: 12px;
            font-weight: 400;
            margin-left: 8px;
        }

        .topbar-right {
            display: flex;
            align-items: center;
            gap: 18px;
        }

        .date-wrapper {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .date-wrapper i {
            color: var(--navy);
            font-size: 17px;
        }

        .date-input {
            height: 40px;
            border: 1px solid var(--border);
            border-radius: 8px;
            background: white;
            color: var(--text);
            font-size: 13px;
            padding: 0 11px;
            outline: none;
            cursor: pointer;
        }

        .date-input:focus {
            border-color: var(--navy);
            box-shadow: 0 0 0 3px rgba(16,35,63,.08);
        }

        .logout-btn {
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 7px;
            padding: 0 13px;
            border: 1px solid #eadfbd;
            border-radius: 8px;
            background: var(--yellow-soft);
            color: #806600;
            text-decoration: none;
            font-size: 13px;
            transition: .2s ease;
        }

        .logout-btn:hover {
            background: var(--yellow);
            color: var(--navy);
        }

        /* CONTENT */
        .content {
            padding: 28px 30px 40px;
        }

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

        /* BUTTON */
        .btn-primary-custom {
            height: 40px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 7px;
            padding: 0 16px;
            border: none;
            border-radius: 8px;
            background: var(--navy);
            color: white;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            transition: .2s ease;
        }

        .btn-primary-custom:hover {
            background: var(--navy-light);
            color: white;
        }

        /* STATISTICS */
        .stat-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 15px;
            margin-bottom: 20px;
        }

        .stat-card {
            background: white;
            border: 1px solid var(--border);
            border-radius: 9px;
            min-height: 88px;
            padding: 16px;
            display: flex;
            align-items: center;
            gap: 13px;
        }

        .stat-icon {
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

        .stat-icon.green {
            background: #eaf7ef;
            color: var(--green);
        }

        .stat-icon.red {
            background: #fff0ef;
            color: var(--red);
        }

        .stat-icon.blue {
            background: #eef5ff;
            color: #3976b8;
        }

        .stat-info span {
            display: block;
            color: var(--muted);
            font-size: 11px;
            margin-bottom: 4px;
        }

        .stat-info strong {
            color: var(--navy);
            font-size: 21px;
        }

        /* FILTER */
        .filter-card {
            background: white;
            border: 1px solid var(--border);
            border-radius: 9px;
            padding: 17px;
            margin-bottom: 20px;
            display: flex;
            align-items: flex-end;
            gap: 13px;
            flex-wrap: wrap;
        }

        .filter-title {
            align-self: center;
            color: var(--navy);
            font-size: 13px;
            font-weight: 700;
            margin-right: 4px;
        }

        .filter-title i {
            margin-right: 5px;
        }

        .filter-group label {
            display: block;
            color: var(--muted);
            font-size: 11px;
            margin-bottom: 5px;
        }

        .filter-input,
        .filter-select {
            height: 38px;
            padding: 0 10px;
            border: 1px solid var(--border);
            border-radius: 7px;
            background: white;
            color: var(--text);
            outline: none;
            font-size: 12px;
        }

        .filter-input {
            width: 235px;
        }

        .filter-select {
            width: 175px;
        }

        .filter-input:focus,
        .filter-select:focus {
            border-color: var(--navy);
            box-shadow: 0 0 0 3px rgba(16,35,63,.06);
        }

        .btn-reset {
            height: 38px;
            padding: 0 13px;
            border: 1px solid var(--border);
            border-radius: 7px;
            background: white;
            color: #667085;
            font-size: 12px;
            cursor: pointer;
        }

        .btn-reset:hover {
            background: #f7f8fa;
        }

        /* TABLE */
        .table-card {
            background: white;
            border: 1px solid var(--border);
            border-radius: 9px;
            overflow: hidden;
        }

        .table-header {
            padding: 17px 20px;
            border-bottom: 1px solid var(--border);
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
        }

        .table-header h3 {
            color: var(--navy);
            font-size: 15px;
            margin: 0;
        }

        .table-header p {
            color: var(--muted);
            font-size: 11px;
            margin: 4px 0 0;
        }

        .table-responsive {
            overflow-x: auto;
        }

        .attendance-table {
            width: 100%;
            min-width: 950px;
            border-collapse: collapse;
        }

        .attendance-table th {
            height: 48px;
            padding: 0 14px;
            background: #fafafa;
            color: #667085;
            border-bottom: 1px solid var(--border);
            font-size: 11px;
            font-weight: 700;
            text-align: left;
            white-space: nowrap;
        }

        .attendance-table td {
            padding: 12px 14px;
            color: #667085;
            border-bottom: 1px solid #edf0f3;
            font-size: 12px;
            vertical-align: middle;
        }

        .attendance-table tbody tr:hover td {
            background: #fcfcfc;
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .user-avatar {
            width: 36px;
            height: 36px;
            min-width: 36px;
            border-radius: 50%;
            background: var(--yellow-soft);
            color: var(--navy);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            font-weight: 700;
        }

        .user-name {
            display: block;
            color: var(--text);
            font-size: 12px;
            font-weight: 600;
        }

        .user-desc {
            display: block;
            color: #98a2b3;
            font-size: 10px;
            margin-top: 2px;
        }

        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 5px 9px;
            border-radius: 5px;
            font-size: 10px;
            font-weight: 600;
            white-space: nowrap;
        }

        .status-hadir {
            background: #eaf7ef;
            color: var(--green);
        }

        .status-terlambat {
            background: #fff8dc;
            color: #987500;
        }

        .status-izin {
            background: #eef5ff;
            color: #3976b8;
        }

        .status-alpha {
            background: #fff0ef;
            color: var(--red);
        }

        .action-group {
            display: flex;
            gap: 6px;
        }

        .action-btn {
            width: 32px;
            height: 32px;
            border: 1px solid var(--border);
            border-radius: 7px;
            background: white;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            font-size: 13px;
            transition: .2s ease;
        }

        .action-btn.view {
            color: var(--navy);
        }

        .action-btn.view:hover {
            background: var(--yellow-soft);
            border-color: #eadfbd;
        }

        .empty-row {
            display: none;
        }

        .empty-content {
            padding: 40px;
            text-align: center;
        }

        .empty-content i {
            display: block;
            color: #b4beca;
            font-size: 30px;
            margin-bottom: 8px;
        }

        .empty-content strong {
            display: block;
            color: #667085;
            font-size: 13px;
        }

        .empty-content span {
            display: block;
            color: #98a2b3;
            font-size: 11px;
            margin-top: 4px;
        }

        .table-footer {
            padding: 12px 15px;
            border-top: 1px solid var(--border);
            color: #98a2b3;
            font-size: 11px;
        }

        /* MODAL */
        .modal-content {
            border: none;
            border-radius: 10px;
            overflow: hidden;
        }

        .modal-header {
            background: var(--navy);
            color: white;
            border: none;
            padding: 16px 20px;
        }

        .modal-title {
            font-size: 16px;
            font-weight: 700;
        }

        .modal-header .btn-close {
            filter: brightness(0) invert(1);
        }

        .modal-body {
            padding: 22px;
        }

        .detail-label {
            color: var(--muted);
            font-size: 11px;
            margin-bottom: 5px;
        }

        .detail-value {
            color: var(--text);
            font-size: 13px;
            font-weight: 600;
            margin-bottom: 18px;
        }

        .modal-footer {
            padding: 13px 20px;
            border-top: 1px solid var(--border);
        }

        /* RESPONSIVE */
        @media (max-width: 1100px) {
            .stat-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .filter-input {
                width: 210px;
            }
        }

        @media (max-width: 800px) {
            .topbar {
                padding: 0 18px;
            }

            .topbar-left span {
                display: none;
            }

            .content {
                padding: 22px 18px 30px;
            }

            .page-header {
                align-items: flex-start;
                flex-direction: column;
            }

            .filter-card {
                flex-direction: column;
                align-items: stretch;
            }

            .filter-title {
                align-self: flex-start;
            }

            .filter-input,
            .filter-select,
            .btn-reset {
                width: 100%;
            }
        }

        @media (max-width: 550px) {
            .stat-grid {
                grid-template-columns: 1fr;
            }

            .date-input {
                width: 130px;
            }

            .logout-btn span {
                display: none;
            }

            .logout-btn {
                width: 40px;
                padding: 0;
            }

            .topbar-right {
                gap: 10px;
            }
        }
    </style>
</head>

<body>

<!-- SIDEBAR -->
<aside class="sidebar">
    <div class="sidebar-header">
        <div class="brand">
            <div class="brand-logo">
                <img src="<?= base_url('assets/images/logokota.png') ?>" alt="Logo Kota Tangerang">
            </div>
            <div class="brand-text">MPP Kota Tangerang</div>
        </div>

        <button type="button" class="sidebar-toggle" id="sidebarToggle" aria-label="Buka atau tutup sidebar">
            <i class="bi bi-list"></i>
        </button>
    </div>

    <div class="welcome">
        <small>Welcome,</small>
        <strong>Admin MPP</strong>
    </div>

    <nav class="sidebar-menu">
        <div class="menu-title">Menu Utama</div>

        <a href="<?= site_url('admin') ?>" class="menu-item">
            <i class="bi bi-grid"></i>
            <span>Dashboard</span>
        </a>

        <a href="<?= site_url('admin/laporan-proses-antrean') ?>" class="menu-item">
            <i class="bi bi-hourglass-split"></i>
            <span>Laporan Proses Antrean</span>
        </a>

        <a href="<?= site_url('admin/laporan-ringkasan-antrean') ?>" class="menu-item">
            <i class="bi bi-bar-chart"></i>
            <span>Laporan Ringkasan Antrean</span>
        </a>

        <div class="menu-title">Master Data</div>

        <a href="<?= site_url('admin/instansi') ?>" class="menu-item">
            <i class="bi bi-building"></i>
            <span>Instansi</span>
        </a>

        <a href="<?= site_url('admin/petugas') ?>" class="menu-item">
            <i class="bi bi-person"></i>
            <span>Petugas</span>
        </a>

        <div class="menu-title">Pengaturan</div>

        <a href="<?= site_url('admin/pengaturan-kelompok') ?>" class="menu-item">
            <i class="bi bi-people"></i>
            <span>Pengaturan Kelompok</span>
        </a>

        <a href="<?= site_url('admin/pengaturan-layar') ?>" class="menu-item">
            <i class="bi bi-display"></i>
            <span>Pengaturan Layar</span>
        </a>

        <a href="<?= site_url('admin/pengaturan-hari-libur') ?>" class="menu-item">
            <i class="bi bi-calendar-x"></i>
            <span>Pengaturan Hari Libur</span>
        </a>

        <a href="<?= site_url('admin/log-user-login') ?>" class="menu-item">
            <i class="bi bi-clock-history"></i>
            <span>Log User Login</span>
        </a>

        <a href="<?= site_url('admin/absensi-petugas') ?>" class="menu-item active">
            <i class="bi bi-person-check"></i>
            <span>Absensi Petugas</span>
        </a>
    </nav>
</aside>

<!-- MAIN -->
<main class="main-content">

    <!-- TOPBAR -->
    <header class="topbar">
        <div class="topbar-left">
            Admin
            <span>Monitoring layanan MPP Kota Tangerang</span>
        </div>

        <div class="topbar-right">
            <div class="date-wrapper">
                <i class="bi bi-calendar3"></i>
                <input
                    type="date"
                    id="tanggal"
                    class="date-input"
                    value="<?= date('Y-m-d') ?>"
                >
            </div>

            <a href="<?= site_url('logout') ?>" class="logout-btn" onclick="return logoutConfirm();">
                <i class="bi bi-box-arrow-right"></i>
                <span>Logout</span>
            </a>
        </div>
    </header>

    <section class="content">

        <!-- PAGE HEADER -->
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
                'keterangan' => 'Hadir tepat waktu'
            ],
            [
                'id' => 2,
                'nama' => 'bapenda2',
                'instansi' => 'BAPENDA',
                'tanggal' => date('Y-m-d'),
                'jam_masuk' => '08:12',
                'jam_pulang' => '-',
                'status' => 'Terlambat',
                'keterangan' => 'Datang melewati jam masuk'
            ],
            [
                'id' => 3,
                'nama' => 'bpjskes',
                'instansi' => 'BPJS KESEHATAN',
                'tanggal' => date('Y-m-d'),
                'jam_masuk' => '07:50',
                'jam_pulang' => '-',
                'status' => 'Hadir',
                'keterangan' => 'Hadir tepat waktu'
            ],
            [
                'id' => 4,
                'nama' => 'bpkd1',
                'instansi' => 'BPKD',
                'tanggal' => date('Y-m-d'),
                'jam_masuk' => '-',
                'jam_pulang' => '-',
                'status' => 'Izin',
                'keterangan' => 'Izin tidak masuk'
            ],
            [
                'id' => 5,
                'nama' => 'dpmptsp1',
                'instansi' => 'DPMPTSP',
                'tanggal' => date('Y-m-d'),
                'jam_masuk' => '07:58',
                'jam_pulang' => '-',
                'status' => 'Hadir',
                'keterangan' => 'Hadir tepat waktu'
            ],
            [
                'id' => 6,
                'nama' => 'dukcapil',
                'instansi' => 'DUKCAPIL',
                'tanggal' => date('Y-m-d'),
                'jam_masuk' => '-',
                'jam_pulang' => '-',
                'status' => 'Alpha',
                'keterangan' => 'Tidak ada keterangan'
            ],
            [
                'id' => 7,
                'nama' => 'disnaker1',
                'instansi' => 'DISNAKER',
                'tanggal' => date('Y-m-d'),
                'jam_masuk' => '07:53',
                'jam_pulang' => '-',
                'status' => 'Hadir',
                'keterangan' => 'Hadir tepat waktu'
            ],
            [
                'id' => 8,
                'nama' => 'samsat1',
                'instansi' => 'SAMSAT',
                'tanggal' => date('Y-m-d'),
                'jam_masuk' => '08:10',
                'jam_pulang' => '-',
                'status' => 'Terlambat',
                'keterangan' => 'Datang melewati jam masuk'
            ],
            [
                'id' => 9,
                'nama' => 'dishub1',
                'instansi' => 'DISHUB',
                'tanggal' => date('Y-m-d'),
                'jam_masuk' => '07:48',
                'jam_pulang' => '-',
                'status' => 'Hadir',
                'keterangan' => 'Hadir tepat waktu'
            ],
            [
                'id' => 10,
                'nama' => 'pbg1',
                'instansi' => 'PELAYANAN PBG',
                'tanggal' => date('Y-m-d'),
                'jam_masuk' => '-',
                'jam_pulang' => '-',
                'status' => 'Alpha',
                'keterangan' => 'Tidak ada keterangan'
            ],
        ];

        $totalAbsensi = count($absensi);
        $totalHadir = count(array_filter($absensi, fn($item) => $item['status'] === 'Hadir'));
        $totalTerlambat = count(array_filter($absensi, fn($item) => $item['status'] === 'Terlambat'));
        $totalTidakHadir = count(array_filter($absensi, fn($item) => in_array($item['status'], ['Izin', 'Alpha'], true)));

        $instansiList = array_values(array_unique(array_column($absensi, 'instansi')));
        sort($instansiList);
        ?>

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
                        <option value="<?= esc($instansi) ?>"><?= esc($instansi) ?></option>
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
                <input type="date" id="filterTanggal" class="filter-input" value="<?= date('Y-m-d') ?>">
            </div>

            <button type="button" class="btn-reset" onclick="resetFilter()">
                <i class="bi bi-arrow-counterclockwise"></i>
                Reset
            </button>
        </div>

        <!-- TABLE -->
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
                                <td><?= $index + 1 ?></td>

                                <td>
                                    <div class="user-info">
                                        <div class="user-avatar">
                                            <?= esc(strtoupper(substr($item['nama'], 0, 1))) ?>
                                        </div>
                                        <div>
                                            <span class="user-name"><?= esc($item['nama']) ?></span>
                                            <span class="user-desc">Petugas MPP</span>
                                        </div>
                                    </div>
                                </td>

                                <td><?= esc($item['instansi']) ?></td>
                                <td><?= esc(date('d-m-Y', strtotime($item['tanggal']))) ?></td>
                                <td><?= esc($item['jam_masuk']) ?></td>
                                <td><?= esc($item['jam_pulang']) ?></td>

                                <td>
                                    <?php
                                    $statusClass = match ($item['status']) {
                                        'Hadir' => 'status-hadir',
                                        'Terlambat' => 'status-terlambat',
                                        'Izin' => 'status-izin',
                                        default => 'status-alpha',
                                    };
                                    ?>
                                    <span class="status-badge <?= $statusClass ?>">
                                        <i class="bi bi-circle-fill"></i>
                                        <?= esc($item['status']) ?>
                                    </span>
                                </td>

                                <td>
                                    <div class="action-group">
                                        <button
                                            type="button"
                                            class="action-btn view"
                                            title="Lihat Detail"
                                            onclick="lihatDetail(this)"
                                        >
                                            <i class="bi bi-eye"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>

                        <tr id="emptyRow" class="empty-row">
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
                <span id="resultInfo">Menampilkan <?= $totalAbsensi ?> data absensi</span>
            </div>
        </div>
    </section>
</main>

<!-- MODAL DETAIL ABSENSI -->
<div class="modal fade" id="modalDetail" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="bi bi-clipboard-check me-2"></i>
                    Detail Absensi Petugas
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
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
                <button type="button" class="btn btn-light btn-sm" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
    /* SIDEBAR */
    document.getElementById('sidebarToggle').addEventListener('click', function () {
        document.body.classList.toggle('sidebar-collapsed');
    });

    /* FILTER ABSENSI */
    const searchInput = document.getElementById('searchAbsensi');
    const filterInstansi = document.getElementById('filterInstansi');
    const filterStatus = document.getElementById('filterStatus');
    const filterTanggal = document.getElementById('filterTanggal');
    const emptyRow = document.getElementById('emptyRow');
    const resultInfo = document.getElementById('resultInfo');

    function filterAbsensi() {
        const keyword = searchInput.value.toLowerCase().trim();
        const instansi = filterInstansi.value;
        const status = filterStatus.value;
        const tanggal = filterTanggal.value;

        const rows = document.querySelectorAll('#absensiTableBody tr[data-nama]');
        let jumlah = 0;

        rows.forEach(function (row) {
            const cocokNama = row.dataset.nama.includes(keyword);
            const cocokInstansi = !instansi || row.dataset.instansi === instansi;
            const cocokStatus = !status || row.dataset.status === status;
            const cocokTanggal = !tanggal || row.dataset.tanggal === tanggal;

            const tampil = cocokNama && cocokInstansi && cocokStatus && cocokTanggal;
            row.style.display = tampil ? '' : 'none';

            if (tampil) jumlah++;
        });

        emptyRow.style.display = jumlah === 0 ? 'table-row' : 'none';
        resultInfo.textContent = `Menampilkan ${jumlah} data absensi`;
    }

    searchInput.addEventListener('input', filterAbsensi);
    filterInstansi.addEventListener('change', filterAbsensi);
    filterStatus.addEventListener('change', filterAbsensi);
    filterTanggal.addEventListener('change', filterAbsensi);

    /* RESET FILTER */
    function resetFilter() {
        searchInput.value = '';
        filterInstansi.value = '';
        filterStatus.value = '';
        filterTanggal.value = '';
        filterAbsensi();
    }

    /* DETAIL ABSENSI */
    function lihatDetail(button) {
        const row = button.closest('tr');

        const tanggal = row.dataset.tanggal
            ? new Date(row.dataset.tanggal + 'T00:00:00').toLocaleDateString('id-ID', {
                day: '2-digit',
                month: 'long',
                year: 'numeric'
            })
            : '-';

        document.getElementById('detailNama').textContent =
            row.querySelector('.user-name').textContent.trim();

        document.getElementById('detailInstansi').textContent =
            row.dataset.instansi || '-';

        document.getElementById('detailTanggal').textContent = tanggal;
        document.getElementById('detailStatus').textContent = row.dataset.status || '-';
        document.getElementById('detailMasuk').textContent = row.dataset.jamMasuk || '-';
        document.getElementById('detailPulang').textContent = row.dataset.jamPulang || '-';
        document.getElementById('detailKeterangan').textContent = row.dataset.keterangan || '-';

        bootstrap.Modal.getOrCreateInstance(
            document.getElementById('modalDetail')
        ).show();
    }

    /* EXPORT CSV */
    function exportAbsensi() {
        const rows = Array.from(
            document.querySelectorAll('#absensiTableBody tr[data-nama]')
        ).filter(row => row.style.display !== 'none');

        if (rows.length === 0) {
            alert('Tidak ada data absensi untuk diekspor.');
            return;
        }

        const data = [
            ['No', 'Nama Petugas', 'Instansi', 'Tanggal', 'Jam Masuk', 'Jam Pulang', 'Status', 'Keterangan']
        ];

        rows.forEach((row, index) => {
            data.push([
                index + 1,
                row.querySelector('.user-name').textContent.trim(),
                row.dataset.instansi,
                row.dataset.tanggal,
                row.dataset.jamMasuk,
                row.dataset.jamPulang,
                row.dataset.status,
                row.dataset.keterangan
            ]);
        });

        const csv = data.map(row =>
            row.map(value => '"' + String(value ?? '').replace(/"/g, '""') + '"').join(',')
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

        URL.revokeObjectURL(url);
    }

    /* LOGOUT */
    function logoutConfirm() {
        return confirm('Apakah Anda yakin ingin logout?');
    }

    /* FILTER AWAL SESUAI TANGGAL HARI INI */
    filterAbsensi();
</script>

</body>
</html>