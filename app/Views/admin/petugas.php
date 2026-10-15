<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Petugas - MPP Kota Tangerang</title>

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


        /* =====================================================
           SIDEBAR HEADER
        ===================================================== */

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


        /* PETUGAS AKTIF */

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
           CONTENT
        ===================================================== */

        .content {
            padding: 28px 30px 40px;
        }


        .page-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
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
        }


        /* =====================================================
           STATISTIC CARD
        ===================================================== */

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


        /* =====================================================
           FILTER
        ===================================================== */

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


        .search-box {
            position: relative;
        }


        .search-box i {
            position: absolute;
            left: 11px;
            top: 50%;
            transform: translateY(-50%);
            color: #98a2b3;
            font-size: 13px;
        }


        .search-box input {
            width: 270px;
            height: 38px;
            padding: 0 10px 0 33px;
            border: 1px solid var(--border);
            border-radius: 7px;
            outline: none;
            font-size: 12px;
        }


        .filter-select {
            width: 175px;
            height: 38px;
            padding: 0 10px;
            border: 1px solid var(--border);
            border-radius: 7px;
            background: white;
            color: var(--text);
            outline: none;
            font-size: 12px;
        }


        .search-box input:focus,
        .filter-select:focus {
            border-color: var(--navy);
            box-shadow: 0 0 0 3px rgba(16,35,63,0.06);
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


        /* =====================================================
           TABLE
        ===================================================== */

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


        .petugas-table {
            width: 100%;
            min-width: 950px;
            border-collapse: collapse;
        }


        .petugas-table th {
            height: 48px;
            padding: 0 14px;
            background: #fafafa;
            color: #667085;
            border-bottom: 1px solid var(--border);
            font-size: 11px;
            font-weight: 700;
            text-align: left;
        }


        .petugas-table td {
            padding: 12px 14px;
            color: #667085;
            border-bottom: 1px solid #edf0f3;
            font-size: 12px;
            vertical-align: middle;
        }


        .petugas-table tbody tr:hover td {
            background: #fcfcfc;
        }


        /* =====================================================
           USER
        ===================================================== */

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
            font-size: 9px;
            margin-top: 2px;
        }


        .role-badge {
            display: inline-block;
            padding: 5px 9px;
            border-radius: 5px;
            background: #f1f3f5;
            color: #667085;
            font-size: 10px;
        }


        .status {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            font-size: 11px;
            font-weight: 600;
        }


        .status i {
            font-size: 6px;
        }


        .status.active {
            color: var(--green);
        }


        .status.inactive {
            color: var(--red);
        }


        .login-time {
            color: var(--muted);
            font-size: 11px;
        }


        /* =====================================================
           ACTION
        ===================================================== */

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


        .action-btn.edit {
            color: var(--navy);
        }


        .action-btn.delete {
            color: var(--red);
        }


        .action-btn.edit:hover {
            background: var(--yellow-soft);
            border-color: #eadfbd;
        }


        .action-btn.delete:hover {
            background: #fff0ef;
            border-color: #f2d0cd;
        }


        /* =====================================================
           EMPTY
        ===================================================== */

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


        /* =====================================================
           FOOTER TABLE
        ===================================================== */

        .table-footer {
            padding: 12px 15px;
            border-top: 1px solid var(--border);
            color: #98a2b3;
            font-size: 11px;
        }


        /* =====================================================
           MODAL
        ===================================================== */

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


        .form-label {
            color: #475467;
            font-size: 12px;
            font-weight: 600;
            margin-bottom: 6px;
        }


        .form-control,
        .form-select {
            min-height: 40px;
            border-color: var(--border);
            font-size: 12px;
        }


        .form-control:focus,
        .form-select:focus {
            border-color: var(--navy);
            box-shadow: 0 0 0 3px rgba(16,35,63,0.06);
        }


        .password-wrapper {
            position: relative;
        }


        .password-wrapper input {
            padding-right: 42px;
        }


        .password-toggle {
            position: absolute;
            top: 50%;
            right: 10px;
            transform: translateY(-50%);
            border: none;
            background: transparent;
            color: var(--muted);
            cursor: pointer;
        }


        .password-help {
            display: block;
            color: #98a2b3;
            font-size: 10px;
            margin-top: 5px;
        }


        .modal-footer {
            padding: 13px 20px;
            border-top: 1px solid var(--border);
        }


        .btn-save {
            background: var(--navy);
            color: white;
            font-size: 12px;
        }


        .btn-save:hover {
            background: var(--navy-light);
            color: white;
        }


        /* =====================================================
           RESPONSIVE
        ===================================================== */

        @media (max-width: 1100px) {

            .stat-grid {
                grid-template-columns: repeat(2, 1fr);
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
                gap: 12px;
            }


            .btn-add {
                width: 100%;
                justify-content: center;
            }


            .filter-card {
                flex-direction: column;
                align-items: stretch;
            }


            .filter-title {
                align-self: flex-start;
            }


            .search-box input,
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

        }

    </style>

</head>


<body>


<!-- =========================================================
     SIDEBAR
========================================================= -->

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
            type="button"
            class="sidebar-toggle"
            id="sidebarToggle"
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


    <nav class="sidebar-menu">


        <div class="menu-title">
            Menu Utama
        </div>


        <a
            href="<?= site_url('admin/dashboard') ?>"
            class="menu-item"
        >

            <i class="bi bi-grid"></i>

            <span>
                Dashboard
            </span>

        </a>


        <a
            href="<?= site_url('admin/laporan-proses-antrean') ?>"
            class="menu-item"
        >

            <i class="bi bi-hourglass-split"></i>

            <span>
                Laporan Proses Antrean
            </span>

        </a>


        <a
            href="<?= site_url('admin/laporan-ringkasan-antrean') ?>"
            class="menu-item"
        >

            <i class="bi bi-bar-chart"></i>

            <span>
                Laporan Ringkasan Antrean
            </span>

        </a>


        <div class="menu-title">
            Master Data
        </div>


        <a
            href="<?= site_url('admin/instansi') ?>"
            class="menu-item"
        >

            <i class="bi bi-building"></i>

            <span>
                Instansi
            </span>

        </a>


        <!-- PETUGAS AKTIF / KUNING -->

        <a
            href="<?= site_url('admin/petugas/halaman') ?>"
            class="menu-item active"
        >

            <i class="bi bi-person"></i>

            <span>
                Petugas
            </span>

        </a>


        <div class="menu-title">
            Pengaturan
        </div>


        <a
            href="<?= site_url('admin/pengaturan-kelompok') ?>"
            class="menu-item"
        >

            <i class="bi bi-people"></i>

            <span>
                Pengaturan Kelompok
            </span>

        </a>


        <a
            href="<?= base_url('admin/pengaturan-layar') ?>"
            class="menu-item"
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


    </nav>

</aside>


<!-- =========================================================
     MAIN
========================================================= -->

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
                    id="tanggal"
                    class="date-input"
                    value="<?= date('Y-m-d') ?>"
                >

            </div>


            <a
                href="#"
                class="logout-btn"
                onclick="return logoutConfirm();"
            >

                <i class="bi bi-box-arrow-right"></i>

                <span>
                    Logout
                </span>

            </a>


        </div>

    </header>


    <!-- =====================================================
         CONTENT
    ====================================================== -->

    <section class="content">


        <!-- PAGE HEADER -->

        <div class="page-header">


            <div class="page-title">

                <h1>

                    Petugas

                </h1>


                <p>
                    Kelola data petugas yang bertugas pada setiap instansi.
                </p>

            </div>


            <button
                type="button"
                class="btn-add"
                onclick="openAddModal()"
            >

                <i class="bi bi-plus-lg"></i>

                Tambah Petugas

            </button>


        </div>


        <?php

        /*
        |--------------------------------------------------------------------------
        | DATA SEMENTARA
        |--------------------------------------------------------------------------
        | Belum menggunakan database.
        */

        $petugas = [

            [
                'id' => 1,
                'nama' => 'bapenda1',
                'instansi' => 'BAPENDA',
                'role' => 'Petugas',
                'status' => 'Aktif',
                'login' => '08 Okt 2026, 08:15'
            ],

            [
                'id' => 2,
                'nama' => 'bapenda2',
                'instansi' => 'BAPENDA',
                'role' => 'Petugas',
                'status' => 'Aktif',
                'login' => '08 Okt 2026, 08:03'
            ],

            [
                'id' => 3,
                'nama' => 'bapenda3',
                'instansi' => 'BAPENDA',
                'role' => 'Petugas',
                'status' => 'Aktif',
                'login' => '07 Okt 2026, 15:40'
            ],

            [
                'id' => 4,
                'nama' => 'bpjskes',
                'instansi' => 'BPJS KESEHATAN',
                'role' => 'Petugas',
                'status' => 'Aktif',
                'login' => '08 Okt 2026, 07:58'
            ],

            [
                'id' => 5,
                'nama' => 'bpjstk',
                'instansi' => 'BPJS TK',
                'role' => 'Petugas',
                'status' => 'Aktif',
                'login' => '07 Okt 2026, 16:20'
            ],

            [
                'id' => 6,
                'nama' => 'bpkd1',
                'instansi' => 'BPKD',
                'role' => 'Petugas',
                'status' => 'Aktif',
                'login' => '08 Okt 2026, 08:01'
            ],

            [
                'id' => 7,
                'nama' => 'bpkd2',
                'instansi' => 'BPKD',
                'role' => 'Petugas',
                'status' => 'Nonaktif',
                'login' => '05 Okt 2026, 14:11'
            ],

            [
                'id' => 8,
                'nama' => 'dpmptsp1',
                'instansi' => 'DPMPTSP',
                'role' => 'Petugas',
                'status' => 'Aktif',
                'login' => '08 Okt 2026, 08:17'
            ],

            [
                'id' => 9,
                'nama' => 'dpmptsp2',
                'instansi' => 'DPMPTSP',
                'role' => 'Petugas',
                'status' => 'Aktif',
                'login' => '07 Okt 2026, 13:44'
            ],

            [
                'id' => 10,
                'nama' => 'dukcapil',
                'instansi' => 'DUKCAPIL',
                'role' => 'Petugas',
                'status' => 'Aktif',
                'login' => '08 Okt 2026, 08:22'
            ],

            [
                'id' => 11,
                'nama' => 'disnaker1',
                'instansi' => 'DISNAKER',
                'role' => 'Petugas',
                'status' => 'Aktif',
                'login' => '08 Okt 2026, 08:09'
            ],

            [
                'id' => 12,
                'nama' => 'samsat1',
                'instansi' => 'SAMSAT',
                'role' => 'Petugas',
                'status' => 'Aktif',
                'login' => '07 Okt 2026, 16:02'
            ],

            [
                'id' => 13,
                'nama' => 'atrbpn1',
                'instansi' => 'ATR BPN',
                'role' => 'Petugas',
                'status' => 'Nonaktif',
                'login' => '04 Okt 2026, 11:30'
            ],

            [
                'id' => 14,
                'nama' => 'dishub1',
                'instansi' => 'DISHUB',
                'role' => 'Petugas',
                'status' => 'Aktif',
                'login' => '08 Okt 2026, 07:51'
            ],

            [
                'id' => 15,
                'nama' => 'polres1',
                'instansi' => 'POLRES',
                'role' => 'Petugas',
                'status' => 'Aktif',
                'login' => '07 Okt 2026, 14:25'
            ],

            [
                'id' => 16,
                'nama' => 'pbg1',
                'instansi' => 'PELAYANAN PBG',
                'role' => 'Petugas',
                'status' => 'Aktif',
                'login' => '08 Okt 2026, 08:14'
            ]

        ];


        $totalPetugas = count($petugas);


        $totalAktif = count(
            array_filter(
                $petugas,
                fn($item) => $item['status'] === 'Aktif'
            )
        );


        $totalNonaktif = count(
            array_filter(
                $petugas,
                fn($item) => $item['status'] === 'Nonaktif'
            )
        );


        $totalInstansi = count(
            array_unique(
                array_column(
                    $petugas,
                    'instansi'
                )
            )
        );


        $instansiList = array_values(
            array_unique(
                array_column(
                    $petugas,
                    'instansi'
                )
            )
        );


        sort($instansiList);

        ?>


        <!-- =====================================================
             STATISTIK
        ====================================================== -->

        <div class="stat-grid">


            <div class="stat-card">

                <div class="stat-icon">

                    <i class="bi bi-people-fill"></i>

                </div>


                <div class="stat-info">

                    <span>
                        Total Petugas
                    </span>

                    <strong>
                        <?= $totalPetugas ?>
                    </strong>

                </div>

            </div>


            <div class="stat-card">

                <div class="stat-icon green">

                    <i class="bi bi-person-check-fill"></i>

                </div>


                <div class="stat-info">

                    <span>
                        Petugas Aktif
                    </span>

                    <strong>
                        <?= $totalAktif ?>
                    </strong>

                </div>

            </div>


            <div class="stat-card">

                <div class="stat-icon red">

                    <i class="bi bi-person-x-fill"></i>

                </div>


                <div class="stat-info">

                    <span>
                        Petugas Nonaktif
                    </span>

                    <strong>
                        <?= $totalNonaktif ?>
                    </strong>

                </div>

            </div>


            <div class="stat-card">

                <div class="stat-icon blue">

                    <i class="bi bi-building"></i>

                </div>


                <div class="stat-info">

                    <span>
                        Instansi Terlayani
                    </span>

                    <strong>
                        <?= $totalInstansi ?>
                    </strong>

                </div>

            </div>


        </div>


        <!-- =====================================================
             FILTER
        ====================================================== -->

        <div class="filter-card">


            <div class="filter-title">

                <i class="bi bi-funnel"></i>

                Filter Data

            </div>


            <div class="filter-group">

                <label>
                    Cari Petugas
                </label>


                <div class="search-box">

                    <i class="bi bi-search"></i>

                    <input
                        type="text"
                        id="searchPetugas"
                        placeholder="Cari nama atau username..."
                    >

                </div>

            </div>


            <div class="filter-group">

                <label>
                    Instansi
                </label>


            <select
                id="filterInstansi"
                class="filter-select"
            >
                <option value="">Semua Instansi</option>

                <?php foreach ($instansiList as $instansi): ?>
                    <option value="<?= esc($instansi['id']) ?>">
                        <?= esc($instansi['nama_instansi']) ?>
                    </option>
                <?php endforeach; ?>
            </select>

                    <option value="">
                        Semua Instansi
                    </option>


                    <?php foreach ($instansiList as $instansi): ?>

                        <option value="<?= esc($instansi) ?>">

                            <?= esc($instansi) ?>

                        </option>

                    <?php endforeach; ?>

                </select>

            </div>


            <div class="filter-group">

                <label>
                    Status
                </label>


                <select
                    id="filterStatus"
                    class="filter-select"
                >

                    <option value="">
                        Semua Status
                    </option>

                    <option value="Aktif">
                        Aktif
                    </option>

                    <option value="Nonaktif">
                        Nonaktif
                    </option>

                </select>

            </div>


            <button
                type="button"
                class="btn-reset"
                onclick="resetFilter()"
            >

                <i class="bi bi-arrow-counterclockwise"></i>

                Reset

            </button>


        </div>


        <!-- =====================================================
             TABLE
        ====================================================== -->

        <div class="table-card">


            <div class="table-header">

                <div>

                    <h3>
                        Data Petugas
                    </h3>

                    <p>
                        Daftar petugas yang terdaftar pada sistem
                    </p>

                </div>

            </div>


            <div class="table-responsive">


                <table class="petugas-table">


                    <thead>

                        <tr>

                            <th width="60">
                                No
                            </th>

                            <th>
                                Nama / Username
                            </th>

                            <th>
                                Instansi
                            </th>

                            <th>
                                Role
                            </th>

                            <th>
                                Status
                            </th>

                            <th>
                                Login Terakhir
                            </th>

                            <th width="110">
                                Aksi
                            </th>

                        </tr>

                    </thead>


                    <tbody id="petugasTableBody">

                        <tr id="loadingRow">
                            <td colspan="7" class="text-center py-4">
                                Memuat data petugas...
                            </td>
                        </tr>

                        <tr id="emptyRow" class="empty-row" style="display:none">
                            <td colspan="7" class="text-center py-4">
                                Data petugas tidak ditemukan.
                            </td>
                        </tr>

                        <?php foreach ($petugas as $index => $item): ?>


                            <tr
                                data-nama="<?= esc(strtolower($item['nama'])) ?>"
                                data-instansi="<?= esc($item['instansi']) ?>"
                                data-status="<?= esc($item['status']) ?>"
                            >


                                <td>
                                    <?= $index + 1 ?>
                                </td>


                                <td>

                                    <div class="user-info">


                                        <div class="user-avatar">

                                            <?= esc(
                                                strtoupper(
                                                    substr(
                                                        $item['nama'],
                                                        0,
                                                        1
                                                    )
                                                )
                                            ) ?>

                                        </div>


                                        <div>

                                            <span class="user-name">

                                                <?= esc(
                                                    $item['nama']
                                                ) ?>

                                            </span>


                                            <span class="user-desc">

                                                Username petugas

                                            </span>

                                        </div>


                                    </div>

                                </td>


                                <td>

                                    <?= esc(
                                        $item['instansi']
                                    ) ?>

                                </td>


                                <td>

                                    <span class="role-badge">

                                        <?= esc(
                                            $item['role']
                                        ) ?>

                                    </span>

                                </td>


                                <td>


                                    <?php if ($item['status'] === 'Aktif'): ?>

                                        <span class="status active">

                                            <i class="bi bi-circle-fill"></i>

                                            Aktif

                                        </span>

                                    <?php else: ?>

                                        <span class="status inactive">

                                            <i class="bi bi-circle-fill"></i>

                                            Nonaktif

                                        </span>

                                    <?php endif; ?>


                                </td>


                                <td>

                                    <span class="login-time">

                                        <?= esc(
                                            $item['login']
                                        ) ?>

                                    </span>

                                </td>


                                <td>


                                    <div class="action-group">


                                        <button
                                            type="button"
                                            class="action-btn edit"
                                            title="Edit Petugas"
                                            onclick='editPetugas(<?= json_encode($item) ?>)'
                                        >

                                            <i class="bi bi-pencil"></i>

                                        </button>


                                        <button
                                            type="button"
                                            class="action-btn delete"
                                            title="Hapus Petugas"
                                            onclick='hapusPetugas(<?= json_encode($item["nama"]) ?>)'
                                        >

                                            <i class="bi bi-trash3"></i>

                                        </button>


                                    </div>


                                </td>


                            </tr>


                        <?php endforeach; ?>


                        <tr
                            id="emptyRow"
                            class="empty-row"
                        >

                            <td colspan="7">

                                <div class="empty-content">

                                    <i class="bi bi-person-x"></i>

                                    <strong>
                                        Data petugas tidak ditemukan
                                    </strong>

                                    <span>
                                        Coba ubah kata pencarian atau filter.
                                    </span>

                                </div>

                            </td>

                        </tr>


                    </tbody>


                </table>


            </div>


            <div class="table-footer">

                <span id="resultInfo">

                    Menampilkan
                    <?= $totalPetugas ?>
                    petugas

                </span>

            </div>


        </div>


    </section>


</main>


<!-- =========================================================
     MODAL TAMBAH / EDIT PETUGAS
========================================================= -->

<div
    class="modal fade"
    id="modalPetugas"
    tabindex="-1"
    aria-hidden="true"
>

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content">


            <div class="modal-header">

                <h5
                    class="modal-title"
                    id="modalTitle"
                >
                    Tambah Petugas
                </h5>


                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                ></button>

            </div>


            <div class="modal-body">


                <form id="formPetugas">


                    <input
                        type="hidden"
                        id="petugasId"
                    >


                    <div class="mb-3">

                        <label
                            class="form-label"
                            for="namaPetugas"
                        >
                            Nama / Username
                        </label>


                        <input
                            type="text"
                            id="namaPetugas"
                            class="form-control"
                            placeholder="Contoh: bapenda1"
                            required
                        >

                    </div>


                    <div class="mb-3">

                        <label
                            class="form-label"
                            for="instansiPetugas"
                        >
                            Instansi
                        </label>


                        <select
                            id="instansiPetugas"
                            class="form-select"
                            required
                        >
                            <option value="">Pilih Instansi</option>

                            <?php foreach ($instansiList as $instansi): ?>
                                <option value="<?= esc($instansi['id']) ?>">
                                    <?= esc($instansi['nama_instansi']) ?>
                                </option>
                            <?php endforeach; ?>

                            <option value="">
                                Pilih Instansi
                            </option>


                            <?php foreach ($instansiList as $instansi): ?>

                                <option value="<?= esc($instansi) ?>">

                                    <?= esc($instansi) ?>

                                </option>

                            <?php endforeach; ?>

                        </select>

                    </div>


                    <div class="mb-3">

                        <label
                            class="form-label"
                            for="rolePetugas"
                        >
                            Role
                        </label>


                        <select
                            id="rolePetugas"
                            class="form-select"
                            required
                        >

                            <option value="Petugas">
                                Petugas
                            </option>

                            <option value="Admin">
                                Admin
                            </option>

                        </select>

                    </div>


                    <div class="mb-3">

                        <label
                            class="form-label"
                            for="statusPetugas"
                        >
                            Status
                        </label>


                        <select
                            id="statusPetugas"
                            class="form-select"
                            required
                        >

                            <option value="Aktif">
                                Aktif
                            </option>

                            <option value="Nonaktif">
                                Nonaktif
                            </option>

                        </select>

                    </div>


                    <div class="mb-2">

                        <label
                            class="form-label"
                            for="passwordPetugas"
                        >
                            Password
                        </label>


                        <div class="password-wrapper">

                            <input
                                type="password"
                                id="passwordPetugas"
                                class="form-control"
                                placeholder="Masukkan password"
                            >


                            <button
                                type="button"
                                class="password-toggle"
                                onclick="togglePassword()"
                            >

                                <i
                                    class="bi bi-eye"
                                    id="passwordIcon"
                                ></i>

                            </button>

                        </div>


                        <span class="password-help">

                            Saat edit, kosongkan jika password
                            tidak ingin diubah.

                        </span>

                    </div>


                </form>


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
                    class="btn btn-save"
                    onclick="simpanPetugas()"
                >

                    <i class="bi bi-check-lg"></i>

                    Simpan

                </button>


            </div>


        </div>

    </div>

</div>


<!-- =========================================================
     BOOTSTRAP JS
========================================================= -->

<script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
></script>


<script>


    /* =====================================================
       SIDEBAR TOGGLE
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
        document.getElementById('searchPetugas');


    const filterInstansi =
        document.getElementById('filterInstansi');


    const filterStatus =
        document.getElementById('filterStatus');


    const emptyRow =
        document.getElementById('emptyRow');


    const resultInfo =
        document.getElementById('resultInfo');


    function filterPetugas() {

        const keyword =
            searchInput.value
                .toLowerCase()
                .trim();


        const instansi =
            filterInstansi.value;


        const status =
            filterStatus.value;


        const rows =
            document.querySelectorAll(
                '#petugasTableBody tr[data-nama]'
            );


        let jumlah = 0;


        rows.forEach(function (row) {


            const nama =
                row.dataset.nama;


            const rowInstansi =
                row.dataset.instansi;


            const rowStatus =
                row.dataset.status;


            const cocokNama =
                nama.includes(keyword);


            const cocokInstansi =
                !instansi ||
                rowInstansi === instansi;


            const cocokStatus =
                !status ||
                rowStatus === status;


            const tampil =
                cocokNama &&
                cocokInstansi &&
                cocokStatus;


            row.style.display =
                tampil
                    ? ''
                    : 'none';


            if (tampil) {
                jumlah++;
            }

        });


        emptyRow.style.display =
            jumlah === 0
                ? 'table-row'
                : 'none';


        resultInfo.textContent =
            `Menampilkan ${jumlah} petugas`;

    }


    searchInput.addEventListener(
        'input',
        filterPetugas
    );


    filterInstansi.addEventListener(
        'change',
        filterPetugas
    );


    filterStatus.addEventListener(
        'change',
        filterPetugas
    );


    function resetFilter() {

        searchInput.value = '';

        filterInstansi.value = '';

        filterStatus.value = '';

        filterPetugas();

    }


    /* =====================================================
       TAMBAH PETUGAS
    ===================================================== */

    function openAddModal() {

        document.getElementById(
            'formPetugas'
        ).reset();


        document.getElementById(
            'modalTitle'
        ).textContent =
            'Tambah Petugas';


        document.getElementById(
            'petugasId'
        ).value = '';


        document.getElementById(
            'passwordPetugas'
        ).required = true;


        document.getElementById(
            'passwordPetugas'
        ).type = 'password';


        document.getElementById(
            'passwordIcon'
        ).className =
            'bi bi-eye';


        bootstrap.Modal
            .getOrCreateInstance(
                document.getElementById(
                    'modalPetugas'
                )
            )
            .show();

    }


    /* =====================================================
       EDIT PETUGAS
    ===================================================== */

    function editPetugas(data) {

        document.getElementById(
            'modalTitle'
        ).textContent =
            'Edit Petugas';


        document.getElementById(
            'petugasId'
        ).value =
            data.id;


        document.getElementById(
            'namaPetugas'
        ).value =
            data.nama;


        document.getElementById(
            'instansiPetugas'
        ).value =
            data.instansi;


        document.getElementById(
            'rolePetugas'
        ).value =
            data.role;


        document.getElementById(
            'statusPetugas'
        ).value =
            data.status;


        document.getElementById(
            'passwordPetugas'
        ).value = '';


        document.getElementById(
            'passwordPetugas'
        ).required = false;


        document.getElementById(
            'passwordPetugas'
        ).type = 'password';


        document.getElementById(
            'passwordIcon'
        ).className =
            'bi bi-eye';


        bootstrap.Modal
            .getOrCreateInstance(
                document.getElementById(
                    'modalPetugas'
                )
            )
            .show();

    }


    /* =====================================================
       PASSWORD
    ===================================================== */

    function togglePassword() {

        const input =
            document.getElementById(
                'passwordPetugas'
            );


        const icon =
            document.getElementById(
                'passwordIcon'
            );


        if (input.type === 'password') {

            input.type = 'text';

            icon.className =
                'bi bi-eye-slash';

        } else {

            input.type = 'password';

            icon.className =
                'bi bi-eye';

        }

    }


    /* =====================================================
       SIMPAN
    ===================================================== */

    function simpanPetugas() {

        const form =
            document.getElementById(
                'formPetugas'
            );


        if (!form.checkValidity()) {

            form.reportValidity();

            return;

        }


        const id =
            document.getElementById(
                'petugasId'
            ).value;


        if (id) {

            alert(
                'Data petugas berhasil diperbarui.'
            );

        } else {

            alert(
                'Data petugas berhasil ditambahkan.'
            );

        }


        const modal =
            bootstrap.Modal.getInstance(
                document.getElementById(
                    'modalPetugas'
                )
            );


        if (modal) {
            modal.hide();
        }

    }


    /* =====================================================
       HAPUS
    ===================================================== */

    function hapusPetugas(nama) {

        const yakin =
            confirm(
                'Yakin ingin menghapus petugas "' +
                nama +
                '"?'
            );


        if (!yakin) {
            return;
        }


        alert(
            'Petugas "' +
            nama +
            '" berhasil dihapus.'
        );

    }


    /* =====================================================
       LOGOUT
    ===================================================== */

    function logoutConfirm() {

        return confirm(
            'Apakah Anda yakin ingin logout?'
        );

    }

</script>


</body>

</html>