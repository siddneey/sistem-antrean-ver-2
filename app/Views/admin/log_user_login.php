
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log User Login - MPP Kota Tangerang</title>

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
            --topbar-height: 76px;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        html, body {
            width: 100%;
            min-height: 100%;
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
            z-index: 1100;
            display: flex;
            flex-direction: column;
            overflow: hidden;
            transition: width .35s cubic-bezier(.4, 0, .2, 1);
        }

        .sidebar-header {
            height: var(--topbar-height);
            min-height: var(--topbar-height);
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
            display: flex;
            align-items: center;
            justify-content: center;
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
            transform: scale(.90);
        }

        .welcome {
            padding: 21px 20px 17px;
            min-height: 82px;
            overflow: hidden;
            transition: padding .35s ease, min-height .35s ease;
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
            transition: opacity .2s ease, height .35s ease, padding .35s ease;
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
            transition: background .2s ease, color .2s ease, padding .35s ease, gap .35s ease;
        }

        .menu-item i {
            width: 20px;
            min-width: 20px;
            text-align: center;
            font-size: 16px;
            transition: transform .3s ease;
        }

        .menu-item span {
            overflow: hidden;
            transition: opacity .22s ease, max-width .35s ease;
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

        /* SIDEBAR COLLAPSED */
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
            transform: translateX(-10px);
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
            max-width: 0;
            opacity: 0;
            pointer-events: none;
        }

        body.sidebar-collapsed .menu-item i {
            transform: scale(1.02);
        }

        /* MAIN CONTENT */
        .main-content {
            margin-left: var(--sidebar-width);
            padding-top: var(--topbar-height);
            min-height: 100vh;
            transition: margin-left .35s cubic-bezier(.4, 0, .2, 1);
        }

        body.sidebar-collapsed .main-content {
            margin-left: var(--sidebar-collapsed);
        }

        /* TOPBAR - FIX DI POSISI PALING ATAS */
        .topbar {
            position: fixed;
            top: 0;
            left: var(--sidebar-width);
            right: 0;
            z-index: 1050;
            height: var(--topbar-height);
            min-height: var(--topbar-height);
            background: var(--white);
            border-bottom: 1px solid var(--border);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 30px;
            margin: 0;
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
            transition: border-color .2s ease, box-shadow .2s ease;
        }

        .date-input:hover {
            border-color: #c7ced8;
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
        .stat-grid {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 15px;
            margin-bottom: 20px;
        }

        .stat-card {
            background: white;
            border: 1px solid var(--border);
            border-radius: 9px;
            min-height: 94px;
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
            margin-bottom: 5px;
        }

        .stat-info strong {
            color: var(--navy);
            font-size: 22px;
        }

        /* FILTER */
        .filter-card {
            background: white;
            border: 1px solid var(--border);
            border-radius: 9px;
            padding: 17px;
            margin-bottom: 20px;
        }

        .filter-heading {
            color: var(--navy);
            font-size: 13px;
            font-weight: 700;
            margin-bottom: 14px;
        }

        .filter-heading i {
            margin-right: 6px;
        }

        .filter-grid {
            display: grid;
            grid-template-columns: minmax(220px, 1.5fr) repeat(3, minmax(140px, 1fr)) auto;
            align-items: end;
            gap: 13px;
        }

        .filter-group label {
            display: block;
            color: var(--muted);
            font-size: 11px;
            margin-bottom: 6px;
        }

        .filter-control {
            width: 100%;
            height: 39px;
            padding: 0 10px;
            border: 1px solid var(--border);
            border-radius: 7px;
            background: white;
            color: var(--text);
            outline: none;
            font-size: 12px;
        }

        .filter-control:focus {
            border-color: var(--navy);
            box-shadow: 0 0 0 3px rgba(16,35,63,.06);
        }

        .btn-reset {
            height: 39px;
            padding: 0 13px;
            border: 1px solid var(--border);
            border-radius: 7px;
            background: white;
            color: #667085;
            font-size: 12px;
            cursor: pointer;
            white-space: nowrap;
        }

        .btn-reset:hover {
            background: #f7f8fa;
        }

        .filter-note {
            margin-top: 12px;
            color: var(--muted);
            font-size: 11px;
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
            margin: 5px 0 0;
        }

        .live-label {
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

        .live-label i {
            font-size: 7px;
        }

        .table-responsive {
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

        .user-avatar {
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
            margin-top: 3px;
        }

        .instansi-badge {
            display: inline-block;
            padding: 5px 8px;
            border-radius: 5px;
            background: #f1f3f5;
            color: #667085;
            font-size: 10px;
        }

        .activity {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 5px 8px;
            border-radius: 5px;
            font-size: 10px;
            font-weight: 600;
            white-space: nowrap;
        }

        .activity.login {
            background: #eaf7ef;
            color: var(--green);
        }

        .activity.logout {
            background: #eef5ff;
            color: #3976b8;
        }

        .activity.failed {
            background: #fff0ef;
            color: var(--red);
        }

        .time-main {
            display: block;
            color: var(--text);
            font-weight: 600;
            font-size: 12px;
        }

        .time-sub {
            display: block;
            color: #98a2b3;
            font-size: 10px;
            margin-top: 3px;
        }

        .ip-address {
            font-family: Consolas, monospace;
            font-size: 11px;
            color: #667085;
        }

        .action-btn {
            width: 32px;
            height: 32px;
            border: 1px solid var(--border);
            border-radius: 7px;
            background: white;
            color: var(--navy);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: .2s ease;
        }

        .action-btn:hover {
            background: var(--yellow-soft);
            border-color: #eadfbd;
        }

        .empty-row {
            display: none;
        }

        .empty-content {
            padding: 35px 20px;
            text-align: center;
        }

        .empty-content i {
            display: block;
            color: #b4beca;
            font-size: 30px;
            margin-bottom: 9px;
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
            margin-top: 5px;
        }

        .table-footer {
            padding: 13px 17px;
            border-top: 1px solid var(--border);
            color: #98a2b3;
            font-size: 11px;
            display: flex;
            justify-content: space-between;
            gap: 10px;
        }

        /* DETAIL MODAL */
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

        .detail-item {
            padding: 12px 0;
            border-bottom: 1px solid var(--border);
        }

        .detail-item:last-child {
            border-bottom: none;
        }

        .detail-label {
            display: block;
            color: var(--muted);
            font-size: 11px;
            margin-bottom: 5px;
        }

        .detail-value {
            color: var(--text);
            font-size: 13px;
            font-weight: 600;
            overflow-wrap: anywhere;
        }

        /* RESPONSIVE */
        @media (max-width: 1200px) {
            .filter-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }

            .stat-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
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

            .filter-grid {
                grid-template-columns: 1fr;
            }

            .btn-export {
                width: 100%;
            }
        }

        @media (max-width: 550px) {
            .topbar {
                gap: 8px;
            }

            .topbar-left {
                font-size: 15px;
            }

            .topbar-right {
                gap: 8px;
            }

            .date-wrapper {
                gap: 5px;
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

            .stat-grid {
                grid-template-columns: 1fr;
            }

            .table-footer {
                flex-direction: column;
            }
        }
    </style>
</head>

<body>

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
            <i class="bi bi-grid"></i><span>Dashboard</span>
        </a>

        <a href="<?= site_url('admin/laporan-proses-antrean') ?>" class="menu-item">
            <i class="bi bi-hourglass-split"></i><span>Laporan Proses Antrean</span>
        </a>

        <a href="<?= site_url('admin/laporan-ringkasan-antrean') ?>" class="menu-item">
            <i class="bi bi-bar-chart"></i><span>Laporan Ringkasan Antrean</span>
        </a>

        <div class="menu-title">Master Data</div>

        <a href="<?= site_url('admin/instansi') ?>" class="menu-item">
            <i class="bi bi-building"></i><span>Instansi</span>
        </a>

        <a href="<?= site_url('admin/petugas') ?>" class="menu-item">
            <i class="bi bi-person"></i><span>Petugas</span>
        </a>

        <div class="menu-title">Pengaturan</div>

        <a href="<?= site_url('admin/pengaturan-kelompok') ?>" class="menu-item">
            <i class="bi bi-people"></i><span>Pengaturan Kelompok</span>
        </a>

        <a href="<?= base_url('admin/pengaturan-layar') ?>" class="menu-item">
            <i class="bi bi-display"></i><span>Pengaturan Layar</span>
        </a>

        <a href="<?= base_url('admin/pengaturan-hari-libur') ?>" class="menu-item">
            <i class="bi bi-calendar-x"></i><span>Pengaturan Hari Libur</span>
        </a>

        <a href="<?= site_url('admin/log-user-login') ?>" class="menu-item active">
            <i class="bi bi-clock-history"></i><span>Log User Login</span>
        </a>

        <a href="<?= site_url('admin/absensi-petugas') ?>" class="menu-item">
            <i class="bi bi-person-check"></i><span>Absensi Petugas</span>
        </a>
    </nav>
</aside>

<main class="main-content">
    <header class="topbar">
        <div class="topbar-left">
            Admin
            <span>Monitoring layanan MPP Kota Tangerang</span>
        </div>

        <div class="topbar-right">
            <div class="date-wrapper">
                <i class="bi bi-calendar3"></i>
                <input type="date" id="tanggal" class="date-input" value="<?= date('Y-m-d') ?>">
            </div>

            <a href="#" class="logout-btn" onclick="return logoutConfirm();">
                <i class="bi bi-box-arrow-right"></i>
                <span>Logout</span>
            </a>
        </div>
    </header>

    <section class="content">
        <div class="page-header">
            <div class="page-title">
                <h1>Log User Login</h1>
                <p>Pantau riwayat login, logout, dan aktivitas akses pengguna pada sistem MPP Kota Tangerang.</p>
            </div>

            <button type="button" class="btn-export" onclick="exportCSV()">
                <i class="bi bi-file-earmark-spreadsheet"></i> Export CSV
            </button>
        </div>

        <?php
        /*
         * DATA SEMENTARA
         * Ganti data ini dengan data dari database saat controller tersedia.
         */
        $logs = [
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
        $totalLogin = count(array_filter($logs, fn($log) => $log['aktivitas'] === 'Login Berhasil'));
        $totalLogout = count(array_filter($logs, fn($log) => $log['aktivitas'] === 'Logout'));
        $totalGagal = count(array_filter($logs, fn($log) => $log['aktivitas'] === 'Login Gagal'));

        $instansiList = array_values(array_unique(array_column($logs, 'instansi')));
        sort($instansiList);
        ?>

        <!-- STATISTIK -->
        <div class="stat-grid">
            <div class="stat-card">
                <div class="stat-icon"><i class="bi bi-clock-history"></i></div>
                <div class="stat-info">
                    <span>Total Aktivitas</span>
                    <strong><?= $totalLog ?></strong>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-icon green"><i class="bi bi-box-arrow-in-right"></i></div>
                <div class="stat-info">
                    <span>Login Berhasil</span>
                    <strong><?= $totalLogin ?></strong>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-icon blue"><i class="bi bi-box-arrow-right"></i></div>
                <div class="stat-info">
                    <span>Aktivitas Logout</span>
                    <strong><?= $totalLogout ?></strong>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-icon red"><i class="bi bi-shield-exclamation"></i></div>
                <div class="stat-info">
                    <span>Login Gagal</span>
                    <strong><?= $totalGagal ?></strong>
                </div>
            </div>
        </div>

        <!-- FILTER -->
        <div class="filter-card">
            <div class="filter-heading">
                <i class="bi bi-funnel"></i> Filter Riwayat Aktivitas
            </div>

            <div class="filter-grid">
                <div class="filter-group">
                    <label for="searchLog">Cari Pengguna</label>
                    <input type="search" id="searchLog" class="filter-control"
                           placeholder="Username atau alamat IP...">
                </div>

                <div class="filter-group">
                    <label for="filterInstansi">Instansi</label>
                    <select id="filterInstansi" class="filter-control">
                        <option value="">Semua Instansi</option>
                        <?php foreach ($instansiList as $instansi): ?>
                            <option value="<?= esc($instansi) ?>"><?= esc($instansi) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="filter-group">
                    <label for="filterAktivitas">Jenis Aktivitas</label>
                    <select id="filterAktivitas" class="filter-control">
                        <option value="">Semua Aktivitas</option>
                        <option value="Login Berhasil">Login Berhasil</option>
                        <option value="Logout">Logout</option>
                        <option value="Login Gagal">Login Gagal</option>
                    </select>
                </div>

                <div class="filter-group">
                    <label for="filterTanggal">Tanggal</label>
                    <input type="date" id="filterTanggal" class="filter-control">
                </div>

                <button type="button" class="btn-reset" onclick="resetFilter()">
                    <i class="bi bi-arrow-counterclockwise"></i> Reset
                </button>
            </div>

            <div class="filter-note">
                <i class="bi bi-info-circle"></i>
                Gunakan filter untuk menemukan riwayat akses pengguna secara lebih cepat.
            </div>
        </div>

        <!-- TABEL LOG -->
        <div class="table-card">
            <div class="table-header">
                <div>
                    <h3>Riwayat Login Pengguna</h3>
                    <p>Catatan aktivitas masuk dan keluar dari sistem.</p>
                </div>
                <span class="live-label">
                    <i class="bi bi-circle-fill"></i> Riwayat Aktivitas
                </span>
            </div>

            <div class="table-responsive">
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
                                data-ip="<?= esc($log['ip']) ?>"
                                data-waktu="<?= esc($log['waktu']) ?>"
                                data-perangkat="<?= esc($log['perangkat']) ?>"
                                data-status="<?= esc($log['status']) ?>"
                                data-logout="<?= esc($log['logout']) ?>"
                            >
                                <td class="row-number"><?= $index + 1 ?></td>

                                <td>
                                    <div class="log-user">
                                        <div class="user-avatar">
                                            <?= esc(strtoupper(substr($log['username'], 0, 1))) ?>
                                        </div>
                                        <div>
                                            <span class="user-name"><?= esc($log['username']) ?></span>
                                            <span class="user-desc">Akun pengguna</span>
                                        </div>
                                    </div>
                                </td>

                                <td><span class="instansi-badge"><?= esc($log['instansi']) ?></span></td>

                                <td>
                                    <span class="activity <?= $activityClass ?>">
                                        <i class="bi <?= $activityIcon ?>"></i>
                                        <?= esc($log['aktivitas']) ?>
                                    </span>
                                </td>

                                <td>
                                    <span class="time-main"><?= esc($log['waktu']) ?> WIB</span>
                                    <span class="time-sub"><?= esc(date('d M Y', strtotime($log['tanggal']))) ?></span>
                                </td>

                                <td><span class="ip-address"><?= esc($log['ip']) ?></span></td>
                                <td><?= esc($log['perangkat']) ?></td>

                                <td>
                                    <button type="button" class="action-btn" title="Lihat detail"
                                            aria-label="Lihat detail log" onclick="lihatDetail(this)">
                                        <i class="bi bi-eye"></i>
                                    </button>
                                </td>
                            </tr>
                        <?php endforeach; ?>

                        <tr id="emptyRow" class="empty-row">
                            <td colspan="8">
                                <div class="empty-content">
                                    <i class="bi bi-search"></i>
                                    <strong>Data log tidak ditemukan</strong>
                                    <span>Coba ubah kata pencarian atau filter yang digunakan.</span>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="table-footer">
                <span id="resultInfo">Menampilkan <?= $totalLog ?> aktivitas</span>
                <span>Data contoh untuk tampilan antarmuka</span>
            </div>
        </div>
    </section>
</main>

<!-- MODAL DETAIL LOG -->
<div class="modal fade" id="modalDetail" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="bi bi-clock-history me-2"></i> Detail Aktivitas
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>

            <div class="modal-body">
                <div class="detail-item">
                    <span class="detail-label">Username</span>
                    <div class="detail-value" id="detailUsername">-</div>
                </div>
                <div class="detail-item">
                    <span class="detail-label">Instansi</span>
                    <div class="detail-value" id="detailInstansi">-</div>
                </div>
                <div class="detail-item">
                    <span class="detail-label">Jenis Aktivitas</span>
                    <div class="detail-value" id="detailAktivitas">-</div>
                </div>
                <div class="detail-item">
                    <span class="detail-label">Waktu Aktivitas</span>
                    <div class="detail-value" id="detailWaktu">-</div>
                </div>
                <div class="detail-item">
                    <span class="detail-label">Alamat IP</span>
                    <div class="detail-value" id="detailIP">-</div>
                </div>
                <div class="detail-item">
                    <span class="detail-label">Perangkat</span>
                    <div class="detail-value" id="detailPerangkat">-</div>
                </div>
                <div class="detail-item">
                    <span class="detail-label">Status</span>
                    <div class="detail-value" id="detailStatus">-</div>
                </div>
                <div class="detail-item">
                    <span class="detail-label">Waktu Logout</span>
                    <div class="detail-value" id="detailLogout">-</div>
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
    /* SIDEBAR TOGGLE */
    document.getElementById('sidebarToggle').addEventListener('click', function () {
        document.body.classList.toggle('sidebar-collapsed');
    });

    /* FILTER LOG */
    const searchLog = document.getElementById('searchLog');
    const filterInstansi = document.getElementById('filterInstansi');
    const filterAktivitas = document.getElementById('filterAktivitas');
    const filterTanggal = document.getElementById('filterTanggal');
    const emptyRow = document.getElementById('emptyRow');
    const resultInfo = document.getElementById('resultInfo');

    function filterLog() {
        const keyword = searchLog.value.toLowerCase().trim();
        const instansi = filterInstansi.value;
        const aktivitas = filterAktivitas.value;
        const tanggal = filterTanggal.value;
        const rows = document.querySelectorAll('#logTableBody tr[data-username]');
        let jumlah = 0;

        rows.forEach(function (row) {
            const cocokPengguna =
                row.dataset.username.includes(keyword) ||
                row.dataset.ip.toLowerCase().includes(keyword);

            const cocokInstansi = !instansi || row.dataset.instansi === instansi;
            const cocokAktivitas = !aktivitas || row.dataset.aktivitas === aktivitas;
            const cocokTanggal = !tanggal || row.dataset.tanggal === tanggal;

            const tampil = cocokPengguna && cocokInstansi && cocokAktivitas && cocokTanggal;
            row.style.display = tampil ? '' : 'none';

            if (tampil) {
                jumlah++;
                row.querySelector('.row-number').textContent = jumlah;
            }
        });

        emptyRow.style.display = jumlah === 0 ? 'table-row' : 'none';
        resultInfo.textContent = `Menampilkan ${jumlah} aktivitas`;
    }

    searchLog.addEventListener('input', filterLog);
    filterInstansi.addEventListener('change', filterLog);
    filterAktivitas.addEventListener('change', filterLog);
    filterTanggal.addEventListener('change', filterLog);

    function resetFilter() {
        searchLog.value = '';
        filterInstansi.value = '';
        filterAktivitas.value = '';
        filterTanggal.value = '';
        filterLog();
    }

    /* DETAIL AKTIVITAS */
    function lihatDetail(button) {
        const row = button.closest('tr');

        const tanggal = new Date(row.dataset.tanggal + 'T00:00:00')
            .toLocaleDateString('id-ID', {
                day: '2-digit',
                month: 'long',
                year: 'numeric'
            });

        document.getElementById('detailUsername').textContent = row.dataset.username;
        document.getElementById('detailInstansi').textContent = row.dataset.instansi;
        document.getElementById('detailAktivitas').textContent = row.dataset.aktivitas;
        document.getElementById('detailWaktu').textContent =
            tanggal + ', ' + row.dataset.waktu + ' WIB';
        document.getElementById('detailIP').textContent = row.dataset.ip;
        document.getElementById('detailPerangkat').textContent = row.dataset.perangkat;
        document.getElementById('detailStatus').textContent = row.dataset.status;
        document.getElementById('detailLogout').textContent = row.dataset.logout;

        bootstrap.Modal.getOrCreateInstance(document.getElementById('modalDetail')).show();
    }

    /* EXPORT CSV BERDASARKAN FILTER AKTIF */
    function exportCSV() {
        const rows = document.querySelectorAll('#logTableBody tr[data-username]');
        const data = [[
            'No', 'Username', 'Instansi', 'Aktivitas', 'Tanggal',
            'Waktu', 'Alamat IP', 'Perangkat', 'Status', 'Waktu Logout'
        ]];

        let nomor = 1;

        rows.forEach(function (row) {
            if (row.style.display === 'none') {
                return;
            }

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

        const csv = data.map(function (record) {
            return record.map(function (value) {
                return '"' + String(value).replace(/"/g, '""') + '"';
            }).join(',');
        }).join('\r\n');

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

        URL.revokeObjectURL(url);
    }

    /* LOGOUT */
    function logoutConfirm() {
        return confirm('Apakah Anda yakin ingin logout?');
    }
</script>

</body>
</html>