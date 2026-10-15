<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Pengaturan Layar - MPP Kota Tangerang</title>

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

            font-family:
                Arial,
                Helvetica,
                sans-serif;

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
                width 0.35s
                cubic-bezier(
                    0.4,
                    0,
                    0.2,
                    1
                );

        }


        /* =====================================================
           SIDEBAR HEADER
        ===================================================== */

        .sidebar-header {

            height: 76px;

            min-height: 76px;

            padding: 0 17px;

            display: flex;

            align-items: center;

            border-bottom:
                1px solid
                rgba(
                    255,
                    255,
                    255,
                    0.08
                );

            position: relative;

            transition:
                padding 0.35s
                cubic-bezier(
                    0.4,
                    0,
                    0.2,
                    1
                );

        }


        .brand {

            display: flex;

            align-items: center;

            gap: 10px;

            min-width: 0;

            transition:
                opacity 0.25s ease,
                transform 0.35s
                cubic-bezier(
                    0.4,
                    0,
                    0.2,
                    1
                );

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

            background:
                rgba(
                    255,
                    255,
                    255,
                    0.09
                );

        }


        .sidebar-toggle:active {

            transform: scale(0.90);

        }


        /* =====================================================
           WELCOME
        ===================================================== */

        .welcome {

            padding:
                21px
                20px
                17px;

            min-height: 82px;

            overflow: hidden;

            transition:
                padding 0.35s
                cubic-bezier(
                    0.4,
                    0,
                    0.2,
                    1
                ),
                min-height 0.35s ease;

        }


        .welcome small {

            display: block;

            color:
                rgba(
                    255,
                    255,
                    255,
                    0.48
                );

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

            padding:
                4px
                11px
                20px;

            overflow-y: auto;

            overflow-x: hidden;

            scrollbar-width: thin;

            transition:
                padding 0.35s
                cubic-bezier(
                    0.4,
                    0,
                    0.2,
                    1
                );

        }


        .menu-title {

            color:
                rgba(
                    255,
                    255,
                    255,
                    0.38
                );

            font-size: 10px;

            font-weight: 700;

            text-transform: uppercase;

            padding:
                11px
                10px
                7px;

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

            padding:
                0
                12px;

            margin-bottom: 3px;

            color:
                rgba(
                    255,
                    255,
                    255,
                    0.72
                );

            text-decoration: none;

            border-radius: 8px;

            font-size: 13px;

            white-space: nowrap;

            overflow: hidden;

            transition:
                background 0.2s ease,
                color 0.2s ease,
                padding 0.35s
                cubic-bezier(
                    0.4,
                    0,
                    0.2,
                    1
                ),
                gap 0.35s
                cubic-bezier(
                    0.4,
                    0,
                    0.2,
                    1
                );

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

            background:
                rgba(
                    255,
                    255,
                    255,
                    0.08
                );

        }


        /* =====================================================
           PENGATURAN LAYAR AKTIF
        ===================================================== */

        .menu-item.active {

            background: var(--yellow);

            color: var(--navy);

            font-weight: 600;

        }


        /* =====================================================
           COLLAPSED SIDEBAR
        ===================================================== */

        body.sidebar-collapsed
        .sidebar {

            width:
                var(--sidebar-collapsed);

        }


        body.sidebar-collapsed
        .sidebar-header {

            padding:
                0
                20px;

            justify-content: center;

        }


        body.sidebar-collapsed
        .brand {

            width: 0;

            opacity: 0;

            transform:
                translateX(-10px);

            pointer-events: none;

        }


        body.sidebar-collapsed
        .sidebar-toggle {

            margin-left: 0;

        }


        body.sidebar-collapsed
        .welcome {

            min-height: 35px;

            padding:
                8px
                0;

            display: flex;

            justify-content: center;

        }


        body.sidebar-collapsed
        .welcome small,

        body.sidebar-collapsed
        .welcome strong {

            opacity: 0;

            transform:
                translateX(-10px);

            position: absolute;

            pointer-events: none;

        }


        body.sidebar-collapsed
        .sidebar-menu {

            padding-left: 10px;

            padding-right: 10px;

        }


        body.sidebar-collapsed
        .menu-title {

            height: 0;

            padding-top: 0;

            padding-bottom: 0;

            opacity: 0;

        }


        body.sidebar-collapsed
        .menu-item {

            justify-content: center;

            padding-left: 0;

            padding-right: 0;

            gap: 0;

        }


        body.sidebar-collapsed
        .menu-item span {

            max-width: 0;

            opacity: 0;

            pointer-events: none;

        }


        body.sidebar-collapsed
        .menu-item i {

            transform:
                scale(1.02);

        }


        /* =====================================================
           MAIN CONTENT
        ===================================================== */

        .main-content {

            margin-left:
                var(--sidebar-width);

            min-height: 100vh;

            transition:
                margin-left 0.35s
                cubic-bezier(
                    0.4,
                    0,
                    0.2,
                    1
                );

        }


        body.sidebar-collapsed
        .main-content {

            margin-left:
                var(--sidebar-collapsed);

        }


        /* =====================================================
           TOPBAR
        ===================================================== */

        .topbar {

            height: 76px;

            background:
                var(--white);

            border-bottom:
                1px solid
                var(--border);

            display: flex;

            align-items: center;

            justify-content:
                space-between;

            padding:
                0
                30px;

        }


        .topbar-left {

            color:
                var(--navy);

            font-size: 17px;

            font-weight: 700;

        }


        .topbar-left span {

            color:
                var(--muted);

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

            color:
                var(--navy);

            font-size: 17px;

        }


        .date-input {

            height: 40px;

            border:
                1px solid
                var(--border);

            border-radius: 8px;

            background: white;

            color:
                var(--text);

            font-size: 13px;

            padding:
                0
                11px;

            outline: none;

            cursor: pointer;

            transition:
                border-color 0.2s ease,
                box-shadow 0.2s ease;

        }


        .date-input:hover {

            border-color:
                #c7ced8;

        }


        .date-input:focus {

            border-color:
                var(--navy);

            box-shadow:
                0 0 0 3px
                rgba(
                    16,
                    35,
                    63,
                    0.08
                );

        }


        .logout-btn {

            height: 40px;

            display: flex;

            align-items: center;

            justify-content: center;

            gap: 7px;

            padding:
                0
                13px;

            border:
                1px solid
                #eadfbd;

            border-radius: 8px;

            background:
                var(--yellow-soft);

            color:
                #806600;

            text-decoration: none;

            font-size: 13px;

            transition: .2s ease;

        }


        .logout-btn:hover {

            background:
                var(--yellow);

            color:
                var(--navy);

        }


        /* =====================================================
           PAGE CONTENT
        ===================================================== */

        .page-content {
            padding: 22px 30px 40px;
        }

        /* HEADER HALAMAN */
        .page-title {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 22px;
        }

        /* Ikon judul disembunyikan agar tampilan lebih bersih */
        .page-title i {
            display: none;
        }

        /* Judul halaman */
        .page-title h1 {
            margin: 0;
            padding: 0;
            color: var(--navy);
            font-family: Arial, Helvetica, sans-serif;
            font-size: 25px;
            font-weight: 700;
            line-height: 1.4;
        }


        /* =====================================================
           SECTION TITLE
        ===================================================== */

        .section-title {

            color:
                #69809b;

            font-size: 16px;

            font-weight: 500;

            margin:
                0
                0
                8px;

        }


        /* =====================================================
           CARD
        ===================================================== */

        .content-card {

            background:
                white;

            border:
                1px solid
                var(--border);

            border-radius: 7px;

            overflow: hidden;

            box-shadow:
                0 5px 18px
                rgba(
                    16,
                    35,
                    63,
                    0.05
                );

            margin-bottom: 28px;

        }


        /* =====================================================
           TABLE
        ===================================================== */

        .table {

            margin: 0;

        }


        .table thead th {

            background:
                #f8f9fa;

            color:
                #718096;

            font-size: 12px;

            font-weight: 500;

            border-bottom:
                1px solid
                var(--border);

            padding:
                12px
                10px;

            white-space: nowrap;

        }


        .table tbody td {

            color:
                #667085;

            font-size: 13px;

            padding:
                10px;

            vertical-align: middle;

            border-color:
                #edf0f3;

        }


        .table tbody tr:hover {

            background:
                #fafbfc;

        }


        /* =====================================================
           LOGIN BADGE
        ===================================================== */

        .login-badge {

            display: inline-flex;

            align-items: center;

            justify-content: center;

            min-width: 50px;

            height: 36px;

            padding:
                0
                12px;

            border-radius: 20px;

            background:
                #ef5350;

            color: white;

            font-size: 12px;

            font-weight: 600;

        }


        /* =====================================================
           LOGIN STATUS
        ===================================================== */

        .status-online {

            display: inline-flex;

            align-items: center;

            gap: 6px;

            color:
                #4b9b63;

            font-size: 12px;

        }


        .status-dot {

            width: 7px;

            height: 7px;

            border-radius: 50%;

            background:
                #43a047;

        }


        /* =====================================================
           IP SECTION
        ===================================================== */

        .ip-header {

            display: flex;

            align-items: center;

            justify-content:
                space-between;

            margin-bottom: 8px;

        }


        .ip-tools {

            display: flex;

            align-items: center;

            gap: 8px;

        }


        .search-ip {

            height: 38px;

            width: 220px;

            border:
                1px solid
                var(--border);

            border-radius: 7px;

            padding:
                0
                12px;

            font-size: 12px;

            outline: none;

        }


        .search-ip:focus {

            border-color:
                var(--navy);

            box-shadow:
                0 0 0 3px
                rgba(
                    16,
                    35,
                    63,
                    0.07
                );

        }


        .refresh-btn {

            height: 38px;

            border:
                1px solid
                var(--border);

            background:
                white;

            color:
                #667085;

            border-radius: 7px;

            padding:
                0
                12px;

            font-size: 12px;

        }


        .refresh-btn:hover {

            background:
                #f5f7fa;

        }


        .ip-input-row {

            display: flex;

            align-items: center;

            gap: 10px;

        }


        .ip-input {

            height: 36px;

            width: 100%;

            border:
                1px solid
                #e1e5ea;

            border-radius: 6px;

            padding:
                0
                12px;

            font-size: 12px;

            outline: none;

        }


        .ip-input:focus {

            border-color:
                var(--navy);

        }


        .btn-add-ip {

            height: 36px;

            border: none;

            background:
                #62bd6a;

            color: white;

            border-radius: 18px;

            padding:
                0
                16px;

            font-size: 12px;

            white-space: nowrap;

        }


        .btn-add-ip:hover {

            background:
                #51aa5a;

        }


        .btn-delete-ip {

            border: none;

            background:
                #ef5350;

            color: white;

            border-radius: 16px;

            padding:
                5px
                11px;

            font-size: 11px;

        }


        .btn-delete-ip:hover {

            background:
                #d94340;

        }


        /* =====================================================
           EMPTY STATE
        ===================================================== */

        .empty-ip {

            display: none;

            text-align: center;

            padding: 25px;

            color:
                var(--muted);

            font-size: 13px;

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

            background:
                var(--navy);

            color: white;

            border: none;

        }


        .modal-header
        .btn-close {

            filter:
                invert(1);

        }


        /* =====================================================
           RESPONSIVE
        ===================================================== */

        @media (max-width: 900px) {

            .ip-header {

                align-items: flex-start;

                flex-direction: column;

                gap: 10px;

            }

            .search-ip {

                width: 200px;

            }

        }


        @media (max-width: 768px) {

            .sidebar {

                width:
                    var(--sidebar-collapsed);

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

                padding:
                    0
                    20px;

                justify-content:
                    center;

            }


            .sidebar-toggle {

                margin-left: 0;

            }


            .menu-title {

                display: none;

            }


            .menu-item {

                justify-content:
                    center;

                padding-left: 0;

                padding-right: 0;

                gap: 0;

            }


            .menu-item span {

                display: none;

            }


            .main-content {

                margin-left:
                    var(--sidebar-collapsed);

            }


            .topbar {

                padding:
                    0
                    18px;

            }


            .topbar-left span {

                display: none;

            }


            .date-wrapper {

                display: none;

            }


            .page-content {

                padding:
                    22px
                    18px;

            }


            .ip-tools {

                width: 100%;

            }


            .search-ip {

                width: 100%;

            }

        }

    </style>

</head>


<body>


<?php

/* =====================================================
   DATA LAYAR
===================================================== */

$layar = [

    [
        'id' => 1,
        'nama' => 'Kelompok 1',
        'login' => 'Iya',
        'login_terakhir' => '2026-10-06 08:35:53'
    ],

    [
        'id' => 2,
        'nama' => 'Kelompok 2',
        'login' => 'Iya',
        'login_terakhir' => '2026-10-06 08:36:47'
    ]

];


/* =====================================================
   DATA IP AKSES
===================================================== */

$ipAkses = [

    '10.10.102.69',
    '127.0.0.1',
    '::1',
    '38.210.87.150',
    '38.210.87.151',
    '10.10.106.174',
    '10.11.3',
    '10.10.106.162'

];

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

        <small>
            Welcome,
        </small>

        <strong>
            Admin MPP
        </strong>

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

            <span>
                Dashboard
            </span>

        </a>


        <a
            href="<?= base_url('admin/laporan-proses-antrean') ?>"
            class="menu-item"
        >

            <i class="bi bi-hourglass-split"></i>

            <span>
                Laporan Proses Antrean
            </span>

        </a>


        <a
            href="<?= base_url('admin/laporan-ringkasan-antrean') ?>"
            class="menu-item"
        >

            <i class="bi bi-bar-chart-fill"></i>

            <span>
                Laporan Ringkasan Antrean
            </span>

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

            <span>
                Instansi
            </span>

        </a>


        <a
            href="<?= base_url('admin/petugas') ?>"
            class="menu-item"
        >

            <i class="bi bi-person"></i>

            <span>
                Petugas
            </span>

        </a>



        <!-- PENGATURAN -->

        <div class="menu-title">
            Pengaturan
        </div>


        <a
            href="<?= base_url('admin/pengaturan-kelompok') ?>"
            class="menu-item"
        >

            <i class="bi bi-people"></i>

            <span>
                Pengaturan Kelompok
            </span>

        </a>


        <!-- AKTIF -->

        <a
            href="<?= base_url('admin/pengaturan-layar') ?>"
            class="menu-item active"
        >

            <i class="bi bi-display"></i>

            <span>
                Pengaturan Layar
            </span>

        </a>


        <a
            href="<?= base_url('admin/pengaturan-hari-libur') ?>"
            class="menu-item"
        >

            <i class="bi bi-calendar-x"></i>

            <span>
                Pengaturan Hari Libur
            </span>

        </a>


        <a
            href="<?= site_url('admin/log-user-login') ?>"
            class="menu-item"
        >

            <i class="bi bi-clock-history"></i>

            <span>
                Log User Login
            </span>

        </a>


        <a
            href="<?= site_url('admin/absensi-petugas') ?>"
            class="menu-item"
        >

            <i class="bi bi-person-check"></i>

            <span>
                Absensi Petugas
            </span>

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

                <span>
                    Logout
                </span>

                <i class="bi bi-box-arrow-right"></i>

            </a>


        </div>


    </header>



    <!-- =================================================
         PAGE CONTENT
    ================================================= -->

    <section class="page-content">


        <!-- PAGE TITLE -->

        <div class="page-title">
            <h1>Pengaturan Layar</h1>
        </div>




        <!-- =================================================
             STATUS LAYAR
        ================================================= -->

        <div class="section-title">

            Status Layar Display

        </div>


        <div class="content-card">


            <div class="table-responsive">


                <table class="table">


                    <thead>

                        <tr>

                            <th style="width:45px;">
                                No
                            </th>

                            <th style="width:360px;">
                                Layar
                            </th>

                            <th style="width:80px;">
                                Login
                            </th>

                            <th>
                                Login Terakhir
                            </th>

                            <th style="width:150px;">
                                Status
                            </th>

                            <th style="width:110px;">
                                Aksi
                            </th>

                        </tr>

                    </thead>


                    <tbody id="layarBody">


                        <?php foreach ($layar as $index => $item): ?>


                        <tr>


                            <td>
                                <?= $index + 1 ?>
                            </td>


                            <td>

                                <?= esc($item['nama']) ?>

                            </td>


                            <td>

                                <span class="login-badge">

                                    <?= esc($item['login']) ?>

                                </span>

                            </td>


                            <td>

                                <?= esc(
                                    $item['login_terakhir']
                                ) ?>

                            </td>


                            <td>

                                <span class="status-online">

                                    <span class="status-dot"></span>

                                    Aktif

                                </span>

                            </td>


                            <td>

                                <button
                                    type="button"
                                    class="btn btn-sm btn-outline-secondary"
                                    onclick="lihatLayar(
                                        '<?= esc(
                                            $item['nama'],
                                            'js'
                                        ) ?>'
                                    )"
                                >

                                    <i class="bi bi-eye"></i>

                                    Detail

                                </button>

                            </td>


                        </tr>


                        <?php endforeach; ?>


                    </tbody>


                </table>


            </div>


        </div>



        <!-- =================================================
             DAFTAR IP AKSES
        ================================================= -->

        <div class="ip-header">


            <div class="section-title">

                Daftar IP Akses

            </div>


            <div class="ip-tools">


                <input
                    type="text"
                    id="searchIP"
                    class="search-ip"
                    placeholder="Cari IP Address..."
                >


                <button
                    type="button"
                    class="refresh-btn"
                    onclick="refreshIP()"
                >

                    <i class="bi bi-arrow-clockwise"></i>

                    Refresh

                </button>


            </div>


        </div>



        <div class="content-card">


            <div class="table-responsive">


                <table class="table">


                    <thead>

                        <tr>

                            <th>
                                IP Address
                            </th>

                            <th style="width:150px;">
                                Aksi
                            </th>

                        </tr>

                    </thead>


                    <tbody id="ipBody">


                        <!-- INPUT TAMBAH IP -->

                        <tr>

                            <td>

                                <div class="ip-input-row">

                                    <input
                                        type="text"
                                        id="ipBaru"
                                        class="ip-input"
                                        placeholder="Masukkan IP Baru..."
                                    >

                                </div>

                            </td>


                            <td>

                                <button
                                    type="button"
                                    class="btn-add-ip"
                                    onclick="tambahIP()"
                                >

                                    <i class="bi bi-plus-lg"></i>

                                    Tambah

                                </button>

                            </td>

                        </tr>


                        <!-- DATA IP -->

                        <?php foreach ($ipAkses as $index => $ip): ?>


                        <tr
                            class="ip-row"
                            data-ip="<?= esc(
                                strtolower($ip)
                            ) ?>"
                        >


                            <td>

                                <?= esc($ip) ?>

                            </td>


                            <td>

                                <button
                                    type="button"
                                    class="btn-delete-ip"
                                    onclick="hapusIP(
                                        this,
                                        '<?= esc(
                                            $ip,
                                            'js'
                                        ) ?>'
                                    )"
                                >

                                    Hapus

                                </button>

                            </td>


                        </tr>


                        <?php endforeach; ?>


                    </tbody>


                </table>


            </div>


            <div
                class="empty-ip"
                id="emptyIP"
            >

                <i
                    class="bi bi-search"
                    style="font-size:24px;"
                ></i>

                <br>

                IP Address tidak ditemukan.

            </div>


        </div>


    </section>


</main>



<!-- =====================================================
     MODAL DETAIL LAYAR
===================================================== -->

<div
    class="modal fade"
    id="modalDetailLayar"
    tabindex="-1"
>


    <div
        class="modal-dialog modal-dialog-centered"
    >


        <div class="modal-content">


            <div class="modal-header">


                <h5 class="modal-title">

                    <i class="bi bi-display"></i>

                    Detail Layar

                </h5>


                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                ></button>


            </div>


            <div class="modal-body">


                <div
                    style="
                        display:grid;
                        grid-template-columns:
                            130px 1fr;
                        gap:12px;
                        font-size:13px;
                    "
                >

                    <strong>
                        Nama Layar
                    </strong>

                    <span id="detailNamaLayar">
                        -
                    </span>


                    <strong>
                        Status
                    </strong>

                    <span
                        style="color:#43a047;"
                    >

                        <i class="bi bi-circle-fill"></i>

                        Aktif

                    </span>


                    <strong>
                        Login
                    </strong>

                    <span>
                        Iya
                    </span>


                    <strong>
                        Koneksi
                    </strong>

                    <span>
                        Terhubung
                    </span>

                </div>


            </div>


            <div class="modal-footer">


                <button
                    type="button"
                    class="btn btn-secondary"
                    data-bs-dismiss="modal"
                >

                    Tutup

                </button>


            </div>


        </div>


    </div>


</div>



<!-- =====================================================
     BOOTSTRAP JS
===================================================== -->

<script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
></script>



<script>


    /* =====================================================
       SIDEBAR TOGGLE
    ===================================================== */

    document
        .getElementById('sidebarToggle')
        .addEventListener(
            'click',
            function () {

                document.body.classList.toggle(
                    'sidebar-collapsed'
                );

            }
        );



    /* =====================================================
       DETAIL LAYAR
    ===================================================== */

    function lihatLayar(nama) {

        document.getElementById(
            'detailNamaLayar'
        ).textContent = nama;


        const modal =
            new bootstrap.Modal(
                document.getElementById(
                    'modalDetailLayar'
                )
            );


        modal.show();

    }



    /* =====================================================
       TAMBAH IP
    ===================================================== */

    function tambahIP() {

        const input =
            document.getElementById(
                'ipBaru'
            );


        const ip =
            input.value.trim();


        if (ip === '') {

            alert(
                'Masukkan IP Address terlebih dahulu.'
            );

            input.focus();

            return;

        }


        /*
         * Validasi sederhana.
         * Mendukung IPv4 dan IPv6.
         */

        const ipPattern =
            /^[a-zA-Z0-9:.]+$/;


        if (!ipPattern.test(ip)) {

            alert(
                'Format IP Address tidak valid.'
            );

            input.focus();

            return;

        }


        const rows =
            document.querySelectorAll(
                '.ip-row'
            );


        let sudahAda = false;


        rows.forEach(
            function (row) {

                const ipLama =
                    row.dataset.ip;


                if (
                    ipLama ===
                    ip.toLowerCase()
                ) {

                    sudahAda = true;

                }

            }
        );


        if (sudahAda) {

            alert(
                'IP Address tersebut sudah terdaftar.'
            );

            input.focus();

            return;

        }


        const tbody =
            document.getElementById(
                'ipBody'
            );


        const row =
            document.createElement(
                'tr'
            );


        row.className =
            'ip-row';


        row.dataset.ip =
            ip.toLowerCase();


        row.innerHTML = `

            <td>
                ${ip}
            </td>

            <td>

                <button
                    type="button"
                    class="btn-delete-ip"
                    onclick="hapusIP(
                        this,
                        '${ip.replace(/'/g, "\\'")}'
                    )"
                >

                    Hapus

                </button>

            </td>

        `;


        tbody.appendChild(row);


        input.value = '';


        alert(
            'IP Address berhasil ditambahkan.'
        );


        filterIP();

    }



    /* =====================================================
       HAPUS IP
    ===================================================== */

    function hapusIP(
        button,
        ip
    ) {

        const yakin =
            confirm(
                'Yakin ingin menghapus IP ' +
                ip +
                '?'
            );


        if (!yakin) {

            return;

        }


        const row =
            button.closest('tr');


        if (row) {

            row.remove();

        }


        filterIP();

    }



    /* =====================================================
       SEARCH IP
    ===================================================== */

    const searchIP =
        document.getElementById(
            'searchIP'
        );


    searchIP.addEventListener(
        'input',
        filterIP
    );


    function filterIP() {

        const keyword =
            searchIP.value
                .toLowerCase()
                .trim();


        const rows =
            document.querySelectorAll(
                '.ip-row'
            );


        let ditemukan = 0;


        rows.forEach(
            function (row) {

                const ip =
                    row.dataset.ip || '';


                if (
                    keyword === '' ||
                    ip.includes(keyword)
                ) {

                    row.style.display =
                        '';

                    ditemukan++;

                } else {

                    row.style.display =
                        'none';

                }

            }
        );


        const empty =
            document.getElementById(
                'emptyIP'
            );


        if (ditemukan === 0) {

            empty.style.display =
                'block';

        } else {

            empty.style.display =
                'none';

        }

    }



    /* =====================================================
       REFRESH IP
    ===================================================== */

    function refreshIP() {

        const button =
            document.querySelector(
                '.refresh-btn'
            );


        const icon =
            button.querySelector(
                'i'
            );


        icon.classList.add(
            'spin'
        );


        setTimeout(
            function () {

                icon.classList.remove(
                    'spin'
                );


                alert(
                    'Daftar IP berhasil diperbarui.'
                );

            },
            500
        );

    }


</script>


<style>

    @keyframes spin {

        from {

            transform:
                rotate(0deg);

        }

        to {

            transform:
                rotate(360deg);

        }

    }


    .spin {

        animation:
            spin .5s linear;

    }

</style>


</body>

</html>