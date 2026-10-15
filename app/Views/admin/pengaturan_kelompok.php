<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Pengaturan Kelompok - MPP Kota Tangerang</title>

    <!-- Bootstrap 5 -->
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <!-- Bootstrap Icons -->
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css"
        rel="stylesheet"
    >

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

        /* =====================================================
           SIDEBAR
        ===================================================== */

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
            transition:
                width 0.35s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .sidebar-header {
            height: 76px;
            min-height: 76px;
            padding: 0 17px;
            display: flex;
            align-items: center;
            border-bottom: 1px solid rgba(255,255,255,0.08);
            position: relative;
            transition:
                padding 0.35s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 10px;
            min-width: 0;
            transition:
                opacity 0.25s ease,
                transform 0.35s cubic-bezier(0.4, 0, 0.2, 1);
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
            transition:
                opacity 0.25s ease,
                width 0.35s ease;
        }

        /* =====================================================
           HAMBURGER
        ===================================================== */

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
            transition:
                background 0.2s ease,
                transform 0.25s ease;
        }

        .sidebar-toggle:hover {
            background: rgba(255,255,255,0.09);
        }

        .sidebar-toggle:active {
            transform: scale(0.90);
        }

        /* =====================================================
           WELCOME
        ===================================================== */

        .welcome {
            padding: 21px 20px 17px;
            min-height: 82px;
            overflow: hidden;
            transition:
                padding 0.35s cubic-bezier(0.4, 0, 0.2, 1),
                min-height 0.35s ease;
        }

        .welcome small {
            display: block;
            color: rgba(255,255,255,0.48);
            font-size: 11px;
            margin-bottom: 4px;
            white-space: nowrap;
            transition:
                opacity 0.22s ease,
                transform 0.3s ease;
        }

        .welcome strong {
            display: block;
            color: white;
            font-size: 14px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            transition:
                opacity 0.22s ease,
                transform 0.3s ease;
        }

        /* =====================================================
           SIDEBAR MENU
        ===================================================== */

        .sidebar-menu {
            padding: 4px 11px 20px;
            overflow-y: auto;
            overflow-x: hidden;
            scrollbar-width: thin;
            transition:
                padding 0.35s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .menu-title {
            color: rgba(255,255,255,0.38);
            font-size: 10px;
            font-weight: 700;
            text-transform: uppercase;
            padding: 11px 10px 7px;
            white-space: nowrap;
            overflow: hidden;
            transition:
                opacity 0.2s ease,
                height 0.35s ease,
                padding 0.35s ease;
        }

        .menu-item {
            width: 100%;
            height: 42px;
            display: flex;
            align-items: center;
            gap: 13px;
            padding: 0 12px;
            margin-bottom: 3px;
            color: rgba(255,255,255,0.72);
            text-decoration: none;
            border-radius: 8px;
            font-size: 13px;
            white-space: nowrap;
            overflow: hidden;
            transition:
                background 0.2s ease,
                color 0.2s ease,
                padding 0.35s cubic-bezier(0.4, 0, 0.2, 1),
                gap 0.35s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .menu-item i {
            width: 20px;
            min-width: 20px;
            text-align: center;
            font-size: 16px;
            transition:
                transform 0.3s ease;
        }

        .menu-item span {
            overflow: hidden;
            transition:
                opacity 0.22s ease,
                max-width 0.35s ease;
        }

        .menu-item:hover {
            color: white;
            background: rgba(255,255,255,0.08);
        }

        /* PENGATURAN KELOMPOK AKTIF */
        .menu-item.active {
            background: var(--yellow);
            color: var(--navy);
            font-weight: 600;
        }

        /* =====================================================
           COLLAPSED SIDEBAR
        ===================================================== */

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

        /* =====================================================
           MAIN CONTENT
        ===================================================== */

        .main-content {
            margin-left: var(--sidebar-width);
            min-height: 100vh;
            transition:
                margin-left 0.35s cubic-bezier(0.4, 0, 0.2, 1);
        }

        body.sidebar-collapsed .main-content {
            margin-left: var(--sidebar-collapsed);
        }

        /* =====================================================
           TOPBAR
        ===================================================== */

        .topbar {
            height: 76px;
            background: var(--white);
            border-bottom: 1px solid var(--border);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 30px;
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
            transition:
                border-color 0.2s ease,
                box-shadow 0.2s ease;
        }

        .date-input:hover {
            border-color: #c7ced8;
        }

        .date-input:focus {
            border-color: var(--navy);
            box-shadow:
                0 0 0 3px rgba(16,35,63,0.08);
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

        /* =====================================================
           PAGE CONTENT
        ===================================================== */

        .page-content {
            padding: 28px 30px 40px;
        }

        .page-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 22px;
        }

        .page-title {
            display: block;
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

        .btn-add {
            height: 40px;
            display: inline-flex;
            align-items: center;
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

        .btn-add:hover {
            background: var(--navy-light);
            color: white;
        }


        /* =====================================================
           STAT CARDS
        ===================================================== */

        .stats-row {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 16px;
            margin-bottom: 20px;
        }

        .stat-card {
            background: white;
            border: 1px solid var(--border);
            border-radius: 10px;
            padding: 17px 20px;
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .stat-icon {
            width: 44px;
            height: 44px;
            border-radius: 9px;
            background: var(--yellow-soft);
            color: #a77c00;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
        }

        .stat-card small {
            display: block;
            color: var(--muted);
            font-size: 12px;
            margin-bottom: 4px;
        }

        .stat-card strong {
            font-size: 22px;
            color: var(--text);
        }

        /* =====================================================
           FILTER
        ===================================================== */

        .filter-box {
            background: white;
            border: 1px solid var(--border);
            border-radius: 9px;
            padding: 16px;
            margin-bottom: 18px;
        }

        .filter-row {
            display: grid;
            grid-template-columns: 1.5fr 1fr auto;
            gap: 10px;
        }

        .form-control,
        .form-select {
            height: 40px;
            border-color: var(--border);
            border-radius: 7px;
            font-size: 13px;
        }

        .btn-reset {
            height: 40px;
            border: 1px solid var(--border);
            background: white;
            color: #667085;
            border-radius: 7px;
            padding: 0 16px;
            font-size: 13px;
        }

        .btn-reset:hover {
            background: #f8f9fa;
        }

        /* =====================================================
           TABLE
        ===================================================== */

        .table-card {
            background: white;
            border: 1px solid var(--border);
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 5px 18px rgba(16,35,63,.05);
        }

        .table {
            margin: 0;
            min-width: 1050px;
        }

        .table thead th {
            background: #f8f9fa;
            color: #718096;
            font-size: 12px;
            font-weight: 600;
            border-bottom: 1px solid var(--border);
            padding: 13px 10px;
            white-space: nowrap;
        }

        .table tbody td {
            color: #667085;
            font-size: 13px;
            padding: 11px 10px;
            vertical-align: middle;
            border-color: #edf0f3;
        }

        .table tbody tr:hover {
            background: #fafbfc;
        }

        .group-name {
            color: #536b86;
            font-weight: 600;
        }

        .instansi-list {
            line-height: 1.6;
        }

        .screen-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: #eef4fb;
            color: #54708e;
            border-radius: 15px;
            padding: 6px 10px;
            font-size: 12px;
        }

        .action-wrapper {
            display: flex;
            align-items: center;
            gap: 5px;
            flex-wrap: wrap;
        }

        .btn-action {
            border: none;
            border-radius: 18px;
            padding: 7px 12px;
            color: white;
            font-size: 12px;
            white-space: nowrap;
        }

        .btn-edit {
            background: #42a5f5;
        }

        .btn-setting {
            background: #62bd6a;
        }

        .btn-delete {
            background: #ef5350;
        }

        .btn-action:hover {
            opacity: .88;
            color: white;
        }

        /* =====================================================
           MODAL
        ===================================================== */

        .modal-content {
            border: none;
            border-radius: 12px;
            overflow: hidden;
        }

        .modal-header {
            background: var(--navy);
            color: white;
            border: none;
        }

        .modal-header .btn-close {
            filter: invert(1);
        }

        .instansi-check-list {
            border: 1px solid var(--border);
            border-radius: 8px;
            padding: 12px;
            max-height: 230px;
            overflow-y: auto;
        }

        .instansi-check {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 7px 5px;
            font-size: 13px;
            color: #667085;
        }

        .instansi-check + .instansi-check {
            border-top: 1px solid #f0f2f5;
        }

        /* =====================================================
           RESPONSIVE
        ===================================================== */

        @media (max-width: 1000px) {

            .stats-row {
                grid-template-columns: 1fr 1fr;
            }

            .filter-row {
                grid-template-columns: 1fr 1fr;
            }
        }

        @media (max-width: 768px) {

            .sidebar {
                width: var(--sidebar-collapsed);
            }

            .sidebar .brand {
                width: 0;
                opacity: 0;
            }

            .sidebar .welcome small,
            .sidebar .welcome strong {
                display: none;
            }

            .sidebar-header {
                padding: 0 20px;
                justify-content: center;
            }

            .sidebar-toggle {
                margin-left: 0;
            }

            .menu-title {
                display: none;
            }

            .menu-item {
                justify-content: center;
                padding-left: 0;
                padding-right: 0;
                gap: 0;
            }

            .menu-item span {
                display: none;
            }

            .main-content {
                margin-left: var(--sidebar-collapsed);
            }

            .topbar {
                padding: 0 18px;
            }

            .topbar-left span {
                display: none;
            }

            .date-wrapper {
                display: none;
            }

            .page-content {
                padding: 22px 18px;
            }

            .page-header {
                align-items: flex-start;
                flex-direction: column;
                gap: 12px;
            }

            .stats-row {
                grid-template-columns: 1fr;
            }

            .filter-row {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body>

<?php

/* =====================================================
   DATA KELOMPOK
===================================================== */

$kelompok = [

    [
        'id' => 1,
        'nama' => 'Grup 1',
        'instansi' => [
            'SAMSAT',
            'BPJS KESEHATAN',
            'DISNAKER',
            'ATR BPN'
        ],
        'suara_layar' => 'Kelompok 1'
    ],

    [
        'id' => 2,
        'nama' => 'Grup 2',
        'instansi' => [
            'BAPENDA',
            'BPKD',
            'BPJS TK',
            'KEJARI'
        ],
        'suara_layar' => 'Kelompok 2'
    ],

    [
        'id' => 3,
        'nama' => 'Grup 3',
        'instansi' => [
            'DUKCAPIL',
            'DITJEN AHU',
            'PENGADILAN AGAMA',
            'PELAYANAN PBG'
        ],
        'suara_layar' => 'Kelompok 2'
    ],

    [
        'id' => 4,
        'nama' => 'Grup 4',
        'instansi' => [
            'DPUPR',
            'PERKIM',
            'DISHUB',
            'BNN'
        ],
        'suara_layar' => 'Kelompok 2'
    ],

    [
        'id' => 5,
        'nama' => 'Grup 5',
        'instansi' => [
            'POLRES',
            'PT. POS INDONESIA',
            'TASPEN',
            'PLN',
            'PDAM'
        ],
        'suara_layar' => 'Kelompok 2'
    ],

    [
        'id' => 6,
        'nama' => 'Grup 6',
        'instansi' => [
            'BPOM',
            'DINAS LINGKUNGAN HIDUP',
            'PTSP 1',
            'PTSP 2'
        ],
        'suara_layar' => 'Kelompok 1'
    ],

    [
        'id' => 7,
        'nama' => 'Bank Banten',
        'instansi' => [
            'BANK BANTEN'
        ],
        'suara_layar' => 'Kelompok 1'
    ],

    [
        'id' => 8,
        'nama' => 'Bank BJB',
        'instansi' => [
            'BANK BJB',
            'Baznas'
        ],
        'suara_layar' => 'Kelompok 1'
    ]

];

$totalKelompok = count($kelompok);

$totalInstansi = 0;

foreach ($kelompok as $item) {
    $totalInstansi += count($item['instansi']);
}

?>

<!-- =====================================================
     SIDEBAR
===================================================== -->

<aside class="sidebar">

    <div class="sidebar-header">

        <div class="brand">

            <div class="brand-logo">

                <img
                    src="<?= base_url('assets/images/logokota.png') ?>"
                    alt="Logo Kota Tangerang"
                >

            </div>

            <div class="brand-text">
                MPP Kota Tangerang
            </div>

        </div>

        <button
            class="sidebar-toggle"
            id="sidebarToggle"
            type="button"
        >
            <i class="bi bi-list"></i>
        </button>

    </div>


    <div class="welcome">

        <small>Welcome,</small>

        <strong>Admin MPP</strong>

    </div>


    <div class="sidebar-menu">

        <!-- MENU UTAMA -->

        <div class="menu-title">
            Menu Utama
        </div>

        <a
            href="<?= base_url('admin') ?>"
            class="menu-item"
        >
            <i class="bi bi-grid"></i>
            <span>Dashboard</span>
        </a>

        <a
            href="<?= base_url('admin/laporan-proses-antrean') ?>"
            class="menu-item"
        >
            <i class="bi bi-hourglass-split"></i>
            <span>Laporan Proses Antrean</span>
        </a>

        <a
            href="<?= base_url('admin/laporan-ringkasan-antrean') ?>"
            class="menu-item"
        >
            <i class="bi bi-bar-chart-fill"></i>
            <span>Laporan Ringkasan Antrean</span>
        </a>


        <!-- MASTER DATA -->

        <div class="menu-title">
            Master Data
        </div>

        <a
            href="<?= base_url('admin/instansi') ?>"
            class="menu-item"
        >
            <i class="bi bi-building"></i>
            <span>Instansi</span>
        </a>

        <a
            href="<?= base_url('admin/petugas') ?>"
            class="menu-item"
        >
            <i class="bi bi-person"></i>
            <span>Petugas</span>
        </a>


        <!-- PENGATURAN -->

        <div class="menu-title">
            Pengaturan
        </div>

        <a
            href="<?= base_url('admin/pengaturan-kelompok') ?>"
            class="menu-item active"
        >
            <i class="bi bi-people"></i>
            <span>Pengaturan Kelompok</span>
        </a>

        <a
            href="<?= base_url('admin/pengaturan-layar') ?>"
            class="menu-item"
        >
            <i class="bi bi-display"></i>
            <span>Pengaturan Layar</span>
        </a>

        <a
            href="<?= base_url('admin/pengaturan-hari-libur') ?>"
            class="menu-item"
        >
            <i class="bi bi-calendar-x"></i>
            <span>Pengaturan Hari Libur</span>
        </a>

        <a
            href="<?= site_url('admin/log-user-login') ?>"
            class="menu-item"
        >
            <i class="bi bi-clock-history"></i>
            <span>Log User Login</span>
        </a>

        <a
            href="<?= site_url('admin/absensi-petugas') ?>"
            class="menu-item"
        >
            <i class="bi bi-person-check"></i>
            <span>Absensi Petugas</span>
        </a>

    </div>

</aside>


<!-- =====================================================
     MAIN CONTENT
===================================================== -->

<main class="main-content">

    <!-- TOPBAR -->

    <header class="topbar">

        <div class="topbar-left">

            Admin

            <span>
                Monitoring layanan MPP Kota Tangerang
            </span>

        </div>


        <div class="topbar-right">

            <div class="date-wrapper">

                <i class="bi bi-calendar3"></i>

                <input
                    type="date"
                    class="date-input"
                    id="tanggal"
                    value="<?= date('Y-m-d') ?>"
                >

            </div>


            <a
                href="#"
                class="logout-btn"
                onclick="return confirm('Yakin ingin logout?')"
            >

                <span>Logout</span>

                <i class="bi bi-box-arrow-right"></i>

            </a>

        </div>

    </header>


    <!-- =================================================
         PAGE CONTENT
    ================================================= -->

    <section class="page-content">

        <!-- PAGE HEADER -->

        
        <div class="page-header">
            <div class="page-title">
                <h1>Pengaturan Kelompok</h1>
                <p>Kelola pembagian instansi dan pengaturan kelompok layanan.</p>
            </div>

            <button type="button" class="btn-add" data-bs-toggle="modal"
                data-bs-target="#modalTambah">
                <i class="bi bi-plus-lg"></i>
                Tambah Kelompok
            </button>
        </div>



        <!-- =================================================
             STATISTIC
        ================================================= -->

        <div class="stats-row">

            <div class="stat-card">

                <div class="stat-icon">
                    <i class="bi bi-diagram-3-fill"></i>
                </div>

                <div>

                    <small>
                        Total Kelompok
                    </small>

                    <strong>
                        <?= $totalKelompok ?>
                    </strong>

                </div>

            </div>


            <div class="stat-card">

                <div class="stat-icon">
                    <i class="bi bi-building"></i>
                </div>

                <div>

                    <small>
                        Total Instansi
                    </small>

                    <strong>
                        <?= $totalInstansi ?>
                    </strong>

                </div>

            </div>


            <div class="stat-card">

                <div class="stat-icon">
                    <i class="bi bi-volume-up-fill"></i>
                </div>

                <div>

                    <small>
                        Kelompok Suara Layar
                    </small>

                    <strong>
                        <?= $totalKelompok ?>
                    </strong>

                </div>

            </div>

        </div>


        <!-- =================================================
             FILTER
        ================================================= -->

        <div class="filter-box">

            <div class="filter-row">

                <input
                    type="text"
                    id="searchKelompok"
                    class="form-control"
                    placeholder="Cari kelompok atau instansi..."
                >


                <select
                    id="filterSuara"
                    class="form-select"
                >

                    <option value="">
                        Semua Suara Layar
                    </option>

                    <option value="Kelompok 1">
                        Kelompok 1
                    </option>

                    <option value="Kelompok 2">
                        Kelompok 2
                    </option>

                </select>


                <button
                    type="button"
                    class="btn-reset"
                    id="resetFilter"
                >

                    <i class="bi bi-arrow-counterclockwise"></i>

                    Reset

                </button>

            </div>

        </div>


        <!-- =================================================
             TABLE
        ================================================= -->

        <div class="table-card">

            <div class="table-responsive">

                <table class="table">

                    <thead>

                        <tr>

                            <th style="width:50px;">
                                No
                            </th>

                            <th style="width:180px;">
                                Nama Kelompok
                            </th>

                            <th>
                                Nama Instansi
                            </th>

                            <th style="width:150px;">
                                Suara Layar
                            </th>

                            <th style="width:390px;">
                                Aksi
                            </th>

                        </tr>

                    </thead>


                    <tbody id="kelompokBody">

                    <?php foreach ($kelompok as $index => $item): ?>

                        <tr
                            data-search="<?= esc(
                                strtolower(
                                    $item['nama'] . ' ' .
                                    implode(' ', $item['instansi'])
                                )
                            ) ?>"
                            data-suara="<?= esc(
                                strtolower($item['suara_layar'])
                            ) ?>"
                        >

                            <td>
                                <?= $index + 1 ?>
                            </td>


                            <td>

                                <span class="group-name">
                                    <?= esc($item['nama']) ?>
                                </span>

                            </td>


                            <td>

                                <div class="instansi-list">

                                    <?= esc(
                                        implode(
                                            ', ',
                                            $item['instansi']
                                        )
                                    ) ?>

                                </div>

                            </td>


                            <td>

                                <span class="screen-badge">

                                    <i class="bi bi-volume-up-fill"></i>

                                    <?= esc($item['suara_layar']) ?>

                                </span>

                            </td>


                            <td>

                                <div class="action-wrapper">

                                    <button
                                        type="button"
                                        class="btn-action btn-edit"
                                        onclick="editKelompok(
                                            <?= $item['id'] ?>,
                                            '<?= esc($item['nama'], 'js') ?>',
                                            '<?= esc($item['suara_layar'], 'js') ?>'
                                        )"
                                    >

                                        <i class="bi bi-pencil-fill"></i>

                                        Ubah

                                    </button>


                                    <button
                                        type="button"
                                        class="btn-action btn-setting"
                                        onclick="settingInstansi(
                                            <?= $item['id'] ?>,
                                            '<?= esc($item['nama'], 'js') ?>'
                                        )"
                                    >

                                        <i class="bi bi-pencil-fill"></i>

                                        Pengaturan Instansi &amp; Suara

                                    </button>


                                    <button
                                        type="button"
                                        class="btn-action btn-delete"
                                        onclick="hapusKelompok(
                                            <?= $item['id'] ?>,
                                            '<?= esc($item['nama'], 'js') ?>'
                                        )"
                                    >

                                        <i class="bi bi-trash-fill"></i>

                                        Hapus

                                    </button>

                                </div>

                            </td>

                        </tr>

                    <?php endforeach; ?>

                    </tbody>

                </table>

            </div>

        </div>

    </section>

</main>


<!-- =====================================================
     MODAL TAMBAH KELOMPOK
===================================================== -->

<div
    class="modal fade"
    id="modalTambah"
    tabindex="-1"
>

    <div class="modal-dialog modal-lg modal-dialog-centered">

        <div class="modal-content">

            <div class="modal-header">

                <h5 class="modal-title">

                    <i class="bi bi-plus-circle"></i>

                    Tambah Kelompok

                </h5>

                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                ></button>

            </div>


            <div class="modal-body">

                <div class="mb-3">

                    <label class="form-label">
                        Nama Kelompok
                    </label>

                    <input
                        type="text"
                        id="namaKelompokBaru"
                        class="form-control"
                        placeholder="Contoh: Grup 9"
                    >

                </div>


                <div class="mb-3">

                    <label class="form-label">
                        Suara Layar
                    </label>

                    <select
                        id="suaraLayarBaru"
                        class="form-select"
                    >

                        <option value="Kelompok 1">
                            Kelompok 1
                        </option>

                        <option value="Kelompok 2">
                            Kelompok 2
                        </option>

                    </select>

                </div>


                <label class="form-label">
                    Pilih Instansi
                </label>


                <div class="instansi-check-list">

                    <?php

                    $daftarInstansi = [

                        'SAMSAT',
                        'BPJS KESEHATAN',
                        'DISNAKER',
                        'ATR BPN',

                        'BAPENDA',
                        'BPKD',
                        'BPJS TK',
                        'KEJARI',

                        'DUKCAPIL',
                        'DITJEN AHU',
                        'PENGADILAN AGAMA',
                        'PELAYANAN PBG',

                        'DPUPR',
                        'PERKIM',
                        'DISHUB',
                        'BNN',

                        'POLRES',
                        'PT. POS INDONESIA',
                        'TASPEN',
                        'PLN',
                        'PDAM',

                        'BPOM',
                        'DINAS LINGKUNGAN HIDUP',
                        'PTSP 1',
                        'PTSP 2',

                        'BANK BANTEN',
                        'BANK BJB',
                        'Baznas'

                    ];

                    ?>


                    <?php foreach ($daftarInstansi as $instansi): ?>

                        <label class="instansi-check">

                            <input
                                type="checkbox"
                                class="form-check-input instansi-checkbox"
                                value="<?= esc($instansi) ?>"
                            >

                            <span>
                                <?= esc($instansi) ?>
                            </span>

                        </label>

                    <?php endforeach; ?>

                </div>

            </div>


            <div class="modal-footer">

                <button
                    type="button"
                    class="btn btn-light"
                    data-bs-dismiss="modal"
                >
                    Batal
                </button>

                <button
                    type="button"
                    class="btn btn-primary"
                    onclick="simpanKelompok()"
                >

                    <i class="bi bi-save"></i>

                    Simpan

                </button>

            </div>

        </div>

    </div>

</div>


<!-- =====================================================
     MODAL EDIT
===================================================== -->

<div
    class="modal fade"
    id="modalEdit"
    tabindex="-1"
>

    <div class="modal-dialog modal-md modal-dialog-centered">

        <div class="modal-content">

            <div class="modal-header">

                <h5 class="modal-title">

                    <i class="bi bi-pencil-square"></i>

                    Ubah Kelompok

                </h5>

                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                ></button>

            </div>


            <div class="modal-body">

                <input
                    type="hidden"
                    id="editId"
                >


                <div class="mb-3">

                    <label class="form-label">
                        Nama Kelompok
                    </label>

                    <input
                        type="text"
                        class="form-control"
                        id="editNama"
                    >

                </div>


                <div class="mb-3">

                    <label class="form-label">
                        Suara Layar
                    </label>

                    <select
                        class="form-select"
                        id="editSuara"
                    >

                        <option value="Kelompok 1">
                            Kelompok 1
                        </option>

                        <option value="Kelompok 2">
                            Kelompok 2
                        </option>

                    </select>

                </div>

            </div>


            <div class="modal-footer">

                <button
                    type="button"
                    class="btn btn-light"
                    data-bs-dismiss="modal"
                >
                    Batal
                </button>

                <button
                    type="button"
                    class="btn btn-primary"
                    onclick="updateKelompok()"
                >

                    <i class="bi bi-save"></i>

                    Simpan Perubahan

                </button>

            </div>

        </div>

    </div>

</div>


<!-- =====================================================
     MODAL PENGATURAN INSTANSI & SUARA
===================================================== -->

<div
    class="modal fade"
    id="modalInstansi"
    tabindex="-1"
>

    <div class="modal-dialog modal-lg modal-dialog-centered">

        <div class="modal-content">

            <div class="modal-header">

                <h5 class="modal-title">

                    <i class="bi bi-volume-up"></i>

                    Pengaturan Instansi &amp; Suara

                </h5>

                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                ></button>

            </div>


            <div class="modal-body">

                <p style="font-size:13px;color:#667085;">

                    Pengaturan untuk kelompok:

                    <strong id="namaKelompokSetting"></strong>

                </p>


                <div
                    id="detailInstansi"
                    class="instansi-check-list"
                ></div>

            </div>


            <div class="modal-footer">

                <button
                    type="button"
                    class="btn btn-light"
                    data-bs-dismiss="modal"
                >
                    Tutup
                </button>

                <button
                    type="button"
                    class="btn btn-success"
                    onclick="simpanSettingInstansi()"
                >

                    <i class="bi bi-save"></i>

                    Simpan Pengaturan

                </button>

            </div>

        </div>

    </div>

</div>


<!-- =====================================================
     JAVASCRIPT
===================================================== -->

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>

    /* =====================================================
       SIDEBAR
    ===================================================== */

    document
        .getElementById('sidebarToggle')
        .addEventListener('click', function () {

            document.body.classList.toggle(
                'sidebar-collapsed'
            );

        });


    /* =====================================================
       FILTER
    ===================================================== */

    const searchInput =
        document.getElementById('searchKelompok');

    const filterSuara =
        document.getElementById('filterSuara');

    const resetFilter =
        document.getElementById('resetFilter');


    function filterKelompok() {

        const search =
            searchInput.value
                .toLowerCase()
                .trim();

        const suara =
            filterSuara.value
                .toLowerCase();

        const rows =
            document.querySelectorAll(
                '#kelompokBody tr'
            );


        rows.forEach(function (row) {

            const text =
                row.dataset.search || '';

            const rowSuara =
                row.dataset.suara || '';


            const cocokSearch =
                search === '' ||
                text.includes(search);


            const cocokSuara =
                suara === '' ||
                rowSuara === suara;


            if (cocokSearch && cocokSuara) {

                row.style.display = '';

            } else {

                row.style.display = 'none';

            }

        });

    }


    searchInput.addEventListener(
        'input',
        filterKelompok
    );


    filterSuara.addEventListener(
        'change',
        filterKelompok
    );


    resetFilter.addEventListener(
        'click',
        function () {

            searchInput.value = '';

            filterSuara.value = '';

            filterKelompok();

        }
    );


    /* =====================================================
       EDIT KELOMPOK
    ===================================================== */

    function editKelompok(
        id,
        nama,
        suara
    ) {

        document.getElementById(
            'editId'
        ).value = id;


        document.getElementById(
            'editNama'
        ).value = nama;


        document.getElementById(
            'editSuara'
        ).value = suara;


        const modal =
            new bootstrap.Modal(
                document.getElementById(
                    'modalEdit'
                )
            );


        modal.show();

    }


    function updateKelompok() {

        const nama =
            document.getElementById(
                'editNama'
            ).value.trim();


        if (nama === '') {

            alert(
                'Nama kelompok wajib diisi.'
            );

            return;

        }


        alert(
            'Perubahan kelompok "' +
            nama +
            '" berhasil disimpan sementara.'
        );


        bootstrap.Modal
            .getInstance(
                document.getElementById(
                    'modalEdit'
                )
            )
            .hide();

    }


    /* =====================================================
       TAMBAH KELOMPOK
    ===================================================== */

    function simpanKelompok() {

        const nama =
            document.getElementById(
                'namaKelompokBaru'
            ).value.trim();


        if (nama === '') {

            alert(
                'Nama kelompok wajib diisi.'
            );

            return;

        }


        const checked =
            document.querySelectorAll(
                '.instansi-checkbox:checked'
            );


        if (checked.length === 0) {

            alert(
                'Pilih minimal satu instansi.'
            );

            return;

        }


        alert(
            'Kelompok "' +
            nama +
            '" berhasil disiapkan.'
        );

    }


    /* =====================================================
       DATA KELOMPOK UNTUK MODAL
    ===================================================== */

    const dataKelompok =
        <?= json_encode(
            $kelompok,
            JSON_UNESCAPED_UNICODE
        ) ?>;


    /* =====================================================
       PENGATURAN INSTANSI & SUARA
    ===================================================== */

    function settingInstansi(
        id,
        nama
    ) {

        document.getElementById(
            'namaKelompokSetting'
        ).textContent = nama;


        const data =
            dataKelompok.find(
                function (item) {

                    return item.id == id;

                }
            );


        const container =
            document.getElementById(
                'detailInstansi'
            );


        container.innerHTML = '';


        if (!data) {
            return;
        }


        data.instansi.forEach(
            function (instansi) {

                const label =
                    document.createElement(
                        'label'
                    );


                label.className =
                    'instansi-check';


                label.innerHTML = `
                    <input
                        type="checkbox"
                        class="form-check-input"
                        checked
                    >

                    <span>
                        ${instansi}
                    </span>
                `;


                container.appendChild(
                    label
                );

            }
        );


        const modal =
            new bootstrap.Modal(
                document.getElementById(
                    'modalInstansi'
                )
            );


        modal.show();

    }


    function simpanSettingInstansi() {

        alert(
            'Pengaturan instansi dan suara berhasil disimpan sementara.'
        );


        bootstrap.Modal
            .getInstance(
                document.getElementById(
                    'modalInstansi'
                )
            )
            .hide();

    }


    /* =====================================================
       HAPUS
    ===================================================== */

    function hapusKelompok(
        id,
        nama
    ) {

        const yakin =
            confirm(
                'Yakin ingin menghapus "' +
                nama +
                '"?'
            );


        if (!yakin) {
            return;
        }


        alert(
            'Kelompok "' +
            nama +
            '" berhasil dihapus sementara.'
        );

    }

</script>

</body>

</html>