<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Instansi - MPP Kota Tangerang</title>

    <!-- Bootstrap -->
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
            --white: #ffffff;

            --text: #1d2939;
            --muted: #7b8798;
            --border: #e4e8ee;

            --green: #198754;
            --red: #d9534f;

            --sidebar-width: 260px;
            --sidebar-collapsed: 78px;

            --transition-sidebar:
                width 0.35s cubic-bezier(0.4, 0, 0.2, 1),
                margin-left 0.35s cubic-bezier(0.4, 0, 0.2, 1),
                padding 0.35s cubic-bezier(0.4, 0, 0.2, 1);

        }


        * {

            margin: 0;
            padding: 0;
            box-sizing: border-box;

        }


        html,
        body {

            min-height: 100%;

        }


        body {

            font-family: Arial, Helvetica, sans-serif;

            background: var(--bg);

            color: var(--text);

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


        /* =====================================================
           LOGOUT
        ===================================================== */

        .logout-btn {

            height: 40px;

            padding: 0 14px;

            border: 1px solid #eadfbd;

            border-radius: 8px;

            background: var(--yellow-soft);

            color: #806600;

            text-decoration: none;

            display: flex;

            align-items: center;

            gap: 7px;

            font-size: 13px;

            font-weight: 600;

            transition:
                background 0.2s ease,
                color 0.2s ease,
                border-color 0.2s ease;

        }


        .logout-btn:hover {

            background: var(--yellow);

            border-color: var(--yellow);

            color: var(--navy);

        }


        /* =====================================================
           INSTANSI
        ===================================================== */

        .instansi-content {

            padding: 28px 30px 40px;

        }


        .instansi-header {

            display: flex;

            align-items: center;

            gap: 10px;

            margin-bottom: 22px;

        }


        .instansi-header i {

            color: var(--navy);

            font-size: 23px;

        }


        .instansi-header h1 {

            margin: 0;

            color: var(--navy);

            font-size: 25px;

            font-weight: 700;

        }


        /* =====================================================
           STATISTIK
        ===================================================== */

        .instansi-stats {

            display: grid;

            grid-template-columns: repeat(3, 1fr);

            gap: 14px;

            margin-bottom: 20px;

        }


        .stat-card {

            background: var(--white);

            border: 1px solid var(--border);

            border-radius: 8px;

            min-height: 78px;

            padding: 14px 16px;

            display: flex;

            align-items: center;

            gap: 13px;

        }


        .stat-icon {

            width: 40px;

            height: 40px;

            min-width: 40px;

            border-radius: 8px;

            background: var(--yellow-soft);

            color: var(--navy);

            display: flex;

            align-items: center;

            justify-content: center;

            font-size: 18px;

        }


        .stat-info small {

            display: block;

            color: var(--muted);

            font-size: 11px;

            margin-bottom: 3px;

        }


        .stat-info strong {

            display: block;

            color: var(--navy);

            font-size: 18px;

            font-weight: 700;

        }


        /* =====================================================
           FILTER
        ===================================================== */

        .instansi-filter {

            display: flex;

            align-items: center;

            flex-wrap: wrap;

            gap: 12px;

            padding-bottom: 20px;

            border-bottom: 1px solid var(--border);

        }


        .filter-label {

            color: #6b7280;

            font-size: 13px;

            font-weight: 700;

            margin-right: 4px;

        }


        .search-wrapper {

            position: relative;

        }


        .search-wrapper i {

            position: absolute;

            left: 12px;

            top: 50%;

            transform: translateY(-50%);

            color: var(--muted);

            font-size: 14px;

        }


        .search-input {

            height: 38px;

            width: 260px;

            border: 1px solid var(--border);

            border-radius: 7px;

            background: var(--white);

            color: var(--text);

            font-size: 13px;

            padding: 0 10px 0 34px;

            outline: none;

        }


        .search-input:focus {

            border-color: var(--navy);

            box-shadow:
                0 0 0 3px rgba(16,35,63,0.08);

        }


        .group-select {

            height: 38px;

            width: 140px;

            border: 1px solid var(--border);

            border-radius: 7px;

            background: var(--white);

            color: var(--text);

            font-size: 13px;

            padding: 0 10px;

            outline: none;

        }


        .group-select:focus {

            border-color: var(--navy);

            box-shadow:
                0 0 0 3px rgba(16,35,63,0.08);

        }


        .btn-add {

            height: 38px;

            display: inline-flex;

            align-items: center;

            gap: 7px;

            padding: 0 16px;

            border: none;

            border-radius: 20px;

            background: var(--navy);

            color: white;

            font-size: 12px;

            font-weight: 600;

            cursor: pointer;

            transition: 0.2s ease;

            margin-left: auto;

        }


        .btn-add:hover {

            background: var(--navy-light);

            color: white;

        }


        /* =====================================================
           TABLE
        ===================================================== */

        .instansi-table-card {

            margin-top: 20px;

            background: var(--white);

            border: 1px solid var(--border);

            border-radius: 8px;

            overflow: hidden;

            box-shadow:
                0 4px 16px rgba(16,35,63,0.05);

        }


        .instansi-table-wrapper {

            overflow-x: auto;

        }


        .instansi-table {

            width: 100%;

            min-width: 850px;

            border-collapse: collapse;

            font-size: 13px;

        }


        .instansi-table thead th {

            height: 52px;

            padding: 0 14px;

            background: #fafafa;

            border-bottom: 1px solid var(--border);

            color: #64748b;

            text-align: left;

            font-size: 12px;

            font-weight: 600;

        }


        .instansi-table thead th:nth-child(1) {

            width: 25%;

        }


        .instansi-table thead th:nth-child(2) {

            width: 48%;

        }


        .instansi-table thead th:nth-child(3) {

            width: 12%;

        }


        .instansi-table thead th:nth-child(4) {

            width: 15%;

            text-align: center;

        }


        .instansi-table tbody td {

            padding: 14px;

            border-bottom: 1px solid #edf0f3;

            color: #64748b;

            vertical-align: top;

        }


        .instansi-table tbody tr:last-child td {

            border-bottom: none;

        }


        .instansi-table tbody tr:hover td {

            background: #fcfcfc;

        }


        /* =====================================================
           NAMA INSTANSI
        ===================================================== */

        .instansi-name {

            display: flex;

            align-items: flex-start;

            gap: 9px;

        }


        .instansi-info {

            min-width: 0;

        }


        .instansi-title {

            color: #64748b;

            font-weight: 700;

            font-size: 13px;

            margin-bottom: 5px;

        }


        .instansi-group {

            display: inline-block;

            color: #7b8798;

            background: #f1f3f5;

            border-radius: 5px;

            padding: 3px 7px;

            font-size: 10px;

        }


        /* =====================================================
           SOUND
        ===================================================== */

        .sound-btn {

            width: 32px;

            height: 32px;

            min-width: 32px;

            border: 1px solid #eadfbd;

            border-radius: 7px;

            background: var(--yellow-soft);

            color: #806600;

            display: inline-flex;

            align-items: center;

            justify-content: center;

            cursor: pointer;

            transition: 0.2s ease;

        }


        .sound-btn:hover {

            background: var(--yellow);

            color: var(--navy);

            border-color: var(--yellow);

        }


        .sound-btn.speaking {

            background: var(--yellow);

            color: var(--navy);

            border-color: var(--yellow);

        }


        /* =====================================================
           LAYANAN
        ===================================================== */

        .service-list {

            display: flex;

            flex-direction: column;

            gap: 6px;

        }


        .service-item {

            display: flex;

            align-items: flex-start;

            gap: 7px;

            color: #64748b;

            line-height: 1.4;

        }


        .service-item i {

            color: var(--green);

            font-size: 13px;

            margin-top: 2px;

        }


        .service-count-badge {

            display: inline-flex;

            align-items: center;

            justify-content: center;

            min-width: 88px;

            padding: 6px 10px;

            border-radius: 6px;

            background: #f1f3f5;

            color: var(--navy);

            font-size: 11px;

            font-weight: 700;

            white-space: nowrap;

        }


        /* =====================================================
           STATUS
        ===================================================== */

        .status-badge {

            display: inline-flex;

            align-items: center;

            gap: 6px;

            color: #198754;

            font-size: 11px;

            font-weight: 600;

        }


        .status-dot {

            width: 7px;

            height: 7px;

            border-radius: 50%;

            background: #198754;

        }


        /* =====================================================
           AKSI
        ===================================================== */

        .aksi {

            text-align: center;

        }


        .action-buttons {

            display: flex;

            align-items: center;

            justify-content: center;

            gap: 6px;

        }


        .btn-action {

            width: 32px;

            height: 32px;

            border: 1px solid var(--border);

            border-radius: 7px;

            background: white;

            display: inline-flex;

            align-items: center;

            justify-content: center;

            color: var(--navy);

            cursor: pointer;

            transition: 0.2s ease;

        }


        .btn-action:hover {

            background: var(--navy);

            border-color: var(--navy);

            color: white;

        }


        .btn-action.delete:hover {

            background: #fff1f0;

            border-color: #f0c5c2;

            color: var(--red);

        }


        /* =====================================================
           EMPTY
        ===================================================== */

        .empty-row {

            display: none;

        }


        .empty-content {

            text-align: center;

            padding: 45px 20px;

        }


        .empty-content i {

            display: block;

            font-size: 32px;

            color: #c5ccd5;

            margin-bottom: 10px;

        }


        .empty-content strong {

            display: block;

            color: #64748b;

            font-size: 13px;

            margin-bottom: 4px;

        }


        .empty-content span {

            color: var(--muted);

            font-size: 11px;

        }


        /* =====================================================
           MODAL
        ===================================================== */

        .modal-content {

            border: none;

            border-radius: 9px;

            overflow: hidden;

        }


        .modal-header {

            background: var(--navy);

            color: white;

            border-bottom: none;

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

            color: #64748b;

            font-size: 12px;

            font-weight: 600;

        }


        .form-control,
        .form-select {

            font-size: 13px;

            border-color: var(--border);

            border-radius: 7px;

        }


        .form-control:focus,
        .form-select:focus {

            border-color: var(--navy);

            box-shadow:
                0 0 0 3px rgba(16,35,63,0.08);

        }


        .modal-footer {

            border-top: 1px solid var(--border);

        }


        .btn-modal-cancel {

            border: 1px solid var(--border);

            background: white;

            color: #64748b;

            border-radius: 7px;

            font-size: 12px;

        }


        .btn-modal-save {

            border: none;

            background: var(--navy);

            color: white;

            border-radius: 7px;

            font-size: 12px;

        }


        .btn-modal-save:hover {

            background: var(--navy-light);

            color: white;

        }


        /* =====================================================
           RESPONSIVE
        ===================================================== */

        @media (max-width: 1000px) {

            .instansi-stats {

                grid-template-columns: 1fr 1fr;

            }

        }


        @media (max-width: 900px) {

            .btn-add {

                width: 100%;

                justify-content: center;

                margin-left: 0;

            }

        }


        @media (max-width: 700px) {

            .sidebar {

                width: var(--sidebar-width);

                transform: translateX(-100%);

                box-shadow:
                    5px 0 25px rgba(0,0,0,0.15);

            }


            body.mobile-sidebar-open .sidebar {

                transform: translateX(0);

            }


            .main-content,
            body.sidebar-collapsed .main-content {

                margin-left: 0;

            }


            .topbar {

                height: auto;

                min-height: 76px;

                padding: 14px 18px;

                gap: 10px;

            }


            .topbar-right {

                gap: 10px;

            }


            .date-input {

                width: 140px;

            }


            .instansi-content {

                padding: 20px;

            }

        }


        @media (max-width: 600px) {

            .instansi-header h1 {

                font-size: 21px;

            }


            .instansi-stats {

                grid-template-columns: 1fr;

            }


            .instansi-filter {

                align-items: stretch;

                flex-direction: column;

            }


            .search-wrapper,
            .search-input,
            .group-select {

                width: 100%;

            }


            .btn-add {

                width: 100%;

            }


        }


        @media (max-width: 430px) {

            .topbar {

                justify-content: space-between;

            }


            .logout-btn span {

                display: none;

            }


            .logout-btn {

                width: 40px;

                padding: 0;

                justify-content: center;

            }


            .date-input {

                width: 135px;

            }

        }

    </style>

</head>


<body>


    <!-- =====================================================
         SIDEBAR
    ===================================================== -->

    <aside class="sidebar">


        <div class="sidebar-header">


            <div class="brand">

                <div class="brand-logo">

                    <img
                        src="<?= base_url('assets/images/logokota.png') ?>"
                        alt="logokota"
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
                title="Buka / Tutup Sidebar"
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


            <!-- DASHBOARD -->

            <a
                href="<?= base_url('admin/dashboard') ?>"
                class="menu-item"
            >

                <i class="bi bi-grid"></i>

                <span>
                    Dashboard
                </span>

            </a>


            <!-- LAPORAN PROSES -->

            <a
                href="<?= site_url('admin/laporan-proses-antrean') ?>"
                class="menu-item"
            >

                <i class="bi bi-hourglass-split"></i>

                <span>
                    Laporan Proses Antrean
                </span>

            </a>


            <!-- LAPORAN RINGKASAN -->

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


            <!-- INSTANSI AKTIF -->

            <a
                href="<?= site_url('admin/instansi/halaman') ?>"
                class="menu-item active"
            >

                <i class="bi bi-building"></i>

                <span>
                    Instansi
                </span>

            </a>


            <!-- PETUGAS -->

            <a
                href="<?= site_url('admin/petugas') ?>"
                class="menu-item"
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
                onclick="return false;"
            >

                <i class="bi bi-display"></i>

                <span>
                    Pengaturan Layar
                </span>

            </a>


            <a
                href="<?= base_url('admin/pengaturan-hari-libur') ?>"
                class="menu-item"
                onclick="return false;"
            >

                <i class="bi bi-calendar-x"></i>

                <span>
                    Pengaturan Hari Libur
                </span>

            </a>


            <a
                href="<?= site_url('admin/log-user-login') ?>"
                class="menu-item"
                onclick="return false;"
            >

                <i class="bi bi-clock-history"></i>

                <span>
                    Log User Login
                </span>

            </a>


            <a
                href="<?= site_url('admin/absensi-petugas') ?>"
                class="menu-item"
                onclick="return false;"
            >

                <i class="bi bi-person-check"></i>

                <span>
                    Absensi Petugas
                </span>

            </a>


        </nav>

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
                        id="tanggal"
                        class="date-input"
                        value="<?= date('Y-m-d') ?>"
                    >

                </div>


                <a
                    href="#"
                    class="logout-btn"
                    id="logoutButton"
                >

                    <i class="bi bi-box-arrow-right"></i>

                    <span>
                        Logout
                    </span>

                </a>


            </div>

        </header>



        <!-- =====================================================
             HALAMAN INSTANSI
        ===================================================== -->

        <section class="instansi-content">


            <!-- HEADER -->

            <div class="instansi-header">

                <h1>
                    Instansi
                </h1>

            </div>

            
            <?php

            $totalInstansi = count($instansi ?? []);

            $totalLayanan = 0;

            foreach (($instansi ?? []) as $item) {
                $totalLayanan += count($item['layanan'] ?? []);
            }

            $totalSuaraAktif = $totalInstansi;

            ?>

            <!-- =================================================
                 STATISTIK
            ================================================== -->

            <div class="instansi-stats">


                <div class="stat-card">

                    <div class="stat-icon">

                        <i class="bi bi-building"></i>

                    </div>

                    <div class="stat-info">

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

                        <i class="bi bi-list-check"></i>

                    </div>

                    <div class="stat-info">

                        <small>
                            Total Layanan
                        </small>

                        <strong>
                            <?= $totalLayanan ?>
                        </strong>

                    </div>

                </div>


                <div class="stat-card">

                    <div class="stat-icon">

                        <i class="bi bi-volume-up"></i>

                    </div>

                    <div class="stat-info">

                        <small>
                            Suara Aktif
                        </small>

                        <strong>
                            <?= $totalSuaraAktif ?> Instansi
                        </strong>

                    </div>

                </div>


            </div>



            <!-- =================================================
                 FILTER
            ================================================== -->

            <div class="instansi-filter">


                <span class="filter-label">
                    DATA INSTANSI:
                </span>


                <div class="search-wrapper">

                    <i class="bi bi-search"></i>

                    <input
                        type="text"
                        id="searchInstansi"
                        class="search-input"
                        placeholder="Cari instansi atau layanan..."
                    >

                </div>


                <select
                    id="filterGrup"
                    class="group-select"
                >

                    <option value="all">
                        Semua Grup
                    </option>

                    <?php for ($grup = 1; $grup <= 8; $grup++): ?>

                        <option value="<?= $grup ?>">
                            Grup <?= $grup ?>
                        </option>

                    <?php endfor; ?>

                </select>


                <button
                    type="button"
                    class="btn-add"
                    data-bs-toggle="modal"
                    data-bs-target="#modalTambah"
                >

                    <i class="bi bi-plus-lg"></i>

                    Tambah Instansi

                </button>


            </div>



            <!-- =================================================
                 TABLE
            ================================================== -->

            <div class="instansi-table-card">


                <div class="instansi-table-wrapper">


                    <table
                        class="instansi-table"
                        id="instansiTable"
                    >


                        <thead>

                            <tr>

                                <th>
                                    Nama Instansi
                                </th>

                                <th>
                                    Layanan
                                </th>

                                <th>
                                    Jumlah Layanan
                                </th>

                                <th>
                                    Status
                                </th>

                                <th>
                                    Aksi
                                </th>

                            </tr>

                        </thead>


                        <tbody>


                            <?php foreach ($instansi as $item): ?>

                                <tr
                                    class="instansi-row"
                                    data-grup="<?= esc($item['grup_id']) ?>"
                                    data-search="<?= esc(
                                        $item['nama_instansi'] . ' ' .
                                        implode(' ', array_column($item['layanan'] ?? [], 'nama_layanan'))
                                    ) ?>"
                                >


                                    <!-- NAMA -->

                                    <td>

                                        <div class="instansi-name">


                                            <!-- SUARA NAMA INSTANSI -->

                                            <button
                                                type="button"
                                                class="sound-btn"
                                                data-speech="<?= esc($item['nama_instansi']) ?>"
                                                title="Dengarkan nama instansi"
                                            >

                                                <i class="bi bi-volume-up-fill"></i>

                                            </button>


                                            <div class="instansi-info">

                                                <div class="instansi-title">

                                                    <?= esc($item['nama_instansi']) ?>

                                                </div>


                                                <span class="instansi-group">

                                                    Grup <?= esc($item['grup_id']) ?>

                                                </span>

                                            </div>


                                        </div>

                                    </td>



                                    <!-- LAYANAN -->

                                    <td>

                                        <div class="service-list">


                                            <?php foreach ($item['layanan'] as $layanan): ?>

                                                <div class="service-item">

                                                    <i class="bi bi-check2-circle"></i>

                                                    <span>
                                                        <?= esc($layanan['nama_layanan']) ?>
                                                    </span>


                                                </div>

                                            <?php endforeach; ?>


                                        </div>

                                    </td>



                                    <!-- JUMLAH LAYANAN -->

                                    <td>

                                        <span class="service-count-badge">
                                            <?= count($item['layanan']) ?> Layanan
                                        </span>

                                    </td>


                                    <!-- STATUS -->

                                    <td>

                                        <span class="status-badge">

                                            <span class="status-dot"></span>

                                            Aktif

                                        </span>

                                    </td>



                                    <!-- AKSI -->

                                    <td class="aksi">

                                        <div class="action-buttons">


                                            <button
                                                type="button"
                                                class="btn-action"
                                                title="Edit"
                                                onclick="editInstansi(<?= (int) $item['id'] ?>)"
                                            >

                                                <i class="bi bi-pencil"></i>

                                            </button>


                                            <button
                                                type="button"
                                                class="btn-action delete"
                                                title="Hapus"
                                                onclick="deleteInstansi(<?= (int) $item['id'] ?>)"
                                            >

                                                <i class="bi bi-trash3"></i>

                                            </button>


                                        </div>

                                    </td>


                                </tr>

                            <?php endforeach; ?>



                            <!-- EMPTY -->

                            <tr
                                id="emptyRow"
                                class="empty-row"
                            >

                                <td colspan="5">

                                    <div class="empty-content">

                                        <i class="bi bi-search"></i>

                                        <strong>
                                            Data tidak ditemukan
                                        </strong>

                                        <span>
                                            Coba gunakan kata kunci atau filter grup yang berbeda.
                                        </span>

                                    </div>

                                </td>

                            </tr>


                        </tbody>


                    </table>


                </div>


            </div>


        </section>


    </main>



    <!-- =====================================================
         MODAL TAMBAH INSTANSI
    ===================================================== -->

    <div
        class="modal fade"
        id="modalTambah"
        tabindex="-1"
        aria-hidden="true"
    >

        <div class="modal-dialog modal-dialog-centered">

            <div class="modal-content">


                <div class="modal-header">

                    <h5 class="modal-title">
                        Tambah Instansi
                    </h5>

                    <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"
                    ></button>

                </div>


                <div class="modal-body">


                    <form id="formTambahInstansi">


                        <div class="mb-3">

                            <label class="form-label">
                                Nama Instansi
                            </label>

                            <input
                                type="text"
                                id="namaInstansi"
                                class="form-control"
                                placeholder="Masukkan nama instansi"
                                required
                            >

                        </div>


                        <div class="mb-3">

                            <label class="form-label">
                                Grup
                            </label>

                            <select
                                id="grupInstansi"
                                class="form-select"
                                required
                            >

                                <option value="">
                                    Pilih grup
                                </option>

                                <?php for ($grup = 1; $grup <= 8; $grup++): ?>

                                    <option value="<?= $grup ?>">
                                        Grup <?= $grup ?>
                                    </option>

                                <?php endfor; ?>

                            </select>

                        </div>


                        <div class="mb-3">
                            <label class="form-label">Layanan</label>

                            <div id="daftarLayanan" class="d-flex flex-column gap-2">
                                <!-- Input layanan dibuat melalui JavaScript -->
                            </div>

                            <button
                                type="button"
                                id="btnTambahLayanan"
                                class="btn btn-outline-primary btn-sm mt-2"
                            >
                                <i class="bi bi-plus-circle"></i>
                                Tambah Layanan
                            </button>
                        </div>


                    </form>


                </div>


                <div class="modal-footer">


                    <button
                        type="button"
                        class="btn btn-modal-cancel"
                        data-bs-dismiss="modal"
                    >

                        Batal

                    </button>


                    <button
                        type="button"
                        class="btn btn-modal-save"
                        id="btnSimpanInstansi"
                    >

                        Simpan

                    </button>


                </div>


            </div>

        </div>

    </div>



    <!-- Bootstrap JS -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>



    <script>

        /* =================================================
           SIDEBAR
        ================================================= */

        const sidebarToggle =
            document.getElementById('sidebarToggle');


        sidebarToggle.addEventListener('click', function () {

            if (window.innerWidth <= 700) {

                document.body.classList.toggle(
                    'mobile-sidebar-open'
                );

            } else {

                document.body.classList.toggle(
                    'sidebar-collapsed'
                );

            }

        });



        /* =================================================
           LOGOUT
        ================================================= */

        const logoutButton =
            document.getElementById('logoutButton');


        logoutButton.addEventListener('click', function (event) {

            if (!window.confirm(
                'Apakah Anda yakin ingin logout?'
            )) {

                event.preventDefault();

            }

        });



        /* =================================================
           DATE TOPBAR
        ================================================= */

        const tanggal =
            document.getElementById('tanggal');


        if (tanggal) {

            tanggal.addEventListener('change', function () {

                console.log(
                    'Tanggal yang dipilih:',
                    this.value
                );

            });

        }



        /* =================================================
           MOBILE SIDEBAR
        ================================================= */

        document.addEventListener('click', function (event) {

            if (window.innerWidth > 700) {

                return;

            }


            const sidebar =
                document.querySelector('.sidebar');


            const toggle =
                document.getElementById('sidebarToggle');


            if (
                document.body.classList.contains(
                    'mobile-sidebar-open'
                ) &&

                !sidebar.contains(event.target) &&

                !toggle.contains(event.target)
            ) {

                document.body.classList.remove(
                    'mobile-sidebar-open'
                );

            }

        });



        /* =================================================
           SEARCH + FILTER
        ================================================= */

        const searchInput =
            document.getElementById('searchInstansi');


        const filterGrup =
            document.getElementById('filterGrup');


        const rows =
            document.querySelectorAll('.instansi-row');


        const emptyRow =
            document.getElementById('emptyRow');


        function filterInstansi() {


            const keyword =
                searchInput.value
                    .toLowerCase()
                    .trim();


            const grup =
                filterGrup.value;


            let visible =
                0;


            rows.forEach(function (row) {


                const searchData =
                    row.dataset.search
                        .toLowerCase();


                const rowGrup =
                    row.dataset.grup;


                const cocokSearch =
                    keyword === '' ||
                    searchData.includes(keyword);


                const cocokGrup =
                    grup === 'all' ||
                    rowGrup === grup;


                if (
                    cocokSearch &&
                    cocokGrup
                ) {

                    row.style.display = '';

                    visible++;

                } else {

                    row.style.display = 'none';

                }

            });


            if (visible === 0) {

                emptyRow.style.display =
                    'table-row';

            } else {

                emptyRow.style.display =
                    'none';

            }

        }


        searchInput.addEventListener(
            'input',
            filterInstansi
        );


        filterGrup.addEventListener(
            'change',
            filterInstansi
        );



        /* =================================================
           TEXT TO SPEECH - INSTANSI
        ================================================= */

        const soundButtons =
            document.querySelectorAll('.instansi-name .sound-btn');


        soundButtons.forEach(function (button) {


            button.addEventListener('click', function () {


                const text =
                    this.dataset.speech;


                if (!('speechSynthesis' in window)) {

                    alert(
                        'Browser kamu belum mendukung fitur suara.'
                    );

                    return;

                }


                window.speechSynthesis.cancel();


                soundButtons.forEach(function (btn) {

                    btn.classList.remove(
                        'speaking'
                    );

                });


                const speech =
                    new SpeechSynthesisUtterance(
                        text
                    );


                speech.lang =
                    'id-ID';


                speech.rate =
                    0.9;


                speech.pitch =
                    1;


                const currentButton =
                    this;


                currentButton.classList.add(
                    'speaking'
                );


                speech.onend = function () {

                    currentButton.classList.remove(
                        'speaking'
                    );

                };


                speech.onerror = function () {

                    currentButton.classList.remove(
                        'speaking'
                    );

                };


                window.speechSynthesis.speak(
                    speech
                );


            });

        });

        /* =================================================
        EDIT, DELETE, DAN TAMBAH INSTANSI & LAYANAN
        ================================================= */

        let editingId = null;
        let layananAwal = [];

        const formInstansi = document.getElementById('formTambahInstansi');
        const modalInstansiEl = document.getElementById('modalTambah');
        const modalInstansi = bootstrap.Modal.getOrCreateInstance(modalInstansiEl);
        const btnSimpan = document.getElementById('btnSimpanInstansi');

        const inputNama = document.getElementById('namaInstansi');
        const inputGrup = document.getElementById('grupInstansi');
        const daftarLayanan = document.getElementById('daftarLayanan');
        const btnTambahLayanan = document.getElementById('btnTambahLayanan');

        const urlInstansi = '<?= site_url('admin/instansi') ?>';

        async function requestInstansi(url, options = {}) {
            const response = await fetch(url, {
                ...options,
                headers: {
                    'Accept': 'application/json',
                    ...(options.body
                        ? { 'Content-Type': 'application/json' }
                        : {}),
                    ...options.headers
                }
            });

            const result = await response.json();

            if (!response.ok || result.status === false) {
                throw new Error(result.message || 'Permintaan gagal.');
            }

            return result;
        }


        // Membuat satu kotak input layanan
        function tambahInputLayanan(nama = '', id = null) {
            const baris = document.createElement('div');
            baris.className = 'input-group layanan-item';

            if (id !== null) {
                baris.dataset.id = String(id);
            }

            const input = document.createElement('input');
            input.type = 'text';
            input.className = 'form-control';
            input.placeholder = 'Masukkan nama layanan';
            input.value = nama;
            input.maxLength = 150;
            input.required = true;

            const tombolHapus = document.createElement('button');
            tombolHapus.type = 'button';
            tombolHapus.className = 'btn btn-outline-danger';
            tombolHapus.innerHTML = '<i class="bi bi-trash"></i>';
            tombolHapus.title = 'Hapus layanan';

            tombolHapus.addEventListener('click', function () {
                baris.remove();
            });

            baris.append(input, tombolHapus);
            daftarLayanan.appendChild(baris);
        }

        // Tombol tambah layanan
        btnTambahLayanan.addEventListener('click', function () {
            tambahInputLayanan();
        });

        // Ambil layanan dari semua kotak input
        function ambilDaftarLayanan() {
            return Array.from(
                daftarLayanan.querySelectorAll('.layanan-item')
            ).map(baris => ({
                id: baris.dataset.id
                    ? Number(baris.dataset.id)
                    : null,
                nama_layanan: baris.querySelector('input').value.trim()
            }));
        }

        // Kosongkan daftar input
        function kosongkanDaftarLayanan() {
            daftarLayanan.replaceChildren();
        }

        // Isi daftar layanan saat modal dibuka
        function isiDaftarLayanan(layanan = []) {
            kosongkanDaftarLayanan();

            layanan.forEach(item => {
                if (typeof item === 'string') {
                    tambahInputLayanan(item);
                } else {
                    tambahInputLayanan(
                        item.nama_layanan || '',
                        item.id ?? null
                    );
                }
            });

            // Untuk instansi baru, sediakan satu input kosong
            if (layanan.length === 0) {
                tambahInputLayanan();
            }
        }

        /* =================================================
        EDIT
        ================================================= */

        async function editInstansi(id) {
            try {
                const result = await requestInstansi(urlInstansi);

                const item = (result.data || []).find(
                    instansi => Number(instansi.id) === Number(id)
                );

                if (!item) {
                    throw new Error('Instansi tidak ditemukan.');
                }

                editingId = Number(id);

                inputNama.value = item.nama_instansi || '';
                inputGrup.value = String(item.grup_id || '');

                // Simpan kondisi awal layanan untuk mendeteksi layanan yang dihapus/diubah.
                layananAwal = (item.layanan || []).map(layanan => ({
                    id: Number(layanan.id),
                    nama_layanan: layanan.nama_layanan
                }));

                // Tampilkan layanan ke input dinamis.
                isiDaftarLayanan(item.layanan || []);

                modalInstansiEl.querySelector('.modal-title').textContent =
                    'Edit Instansi';

                btnSimpan.textContent = 'Simpan Perubahan';

                modalInstansi.show();

            } catch (error) {
                console.error(error);
                alert('Gagal mengambil data: ' + error.message);
            }
        }

        /* =================================================
        DELETE
        ================================================= */

        async function deleteInstansi(id) {
            if (!confirm('Apakah Anda yakin ingin menghapus instansi ini?')) {
                return;
            }

            try {
                await requestInstansi(`${urlInstansi}/${id}`, {
                    method: 'DELETE'
                });

                alert('Instansi berhasil dihapus dari database.');
                window.location.reload();

            } catch (error) {
                console.error(error);
                alert('Gagal menghapus: ' + error.message);
            }
        }

        /* =================================================
        TAMBAH DAN SIMPAN EDIT
        ================================================= */

        btnSimpan.addEventListener('click', async function () {
            if (!formInstansi.checkValidity()) {
                formInstansi.reportValidity();
                return;
            }

            const nama = inputNama.value.trim();
            const grupId = Number(inputGrup.value);
            const daftarSekarang = ambilDaftarLayanan();

            if (daftarSekarang.some(item => !item.nama_layanan)) {
                alert('Nama layanan tidak boleh kosong.');
                return;
            }

            // Cegah nama layanan duplikat dalam instansi yang sama.
            const namaLayanan = daftarSekarang.map(
                item => item.nama_layanan.toLocaleLowerCase()
            );

            if (new Set(namaLayanan).size !== namaLayanan.length) {
                alert('Nama layanan tidak boleh duplikat.');
                return;
            }

            btnSimpan.disabled = true;

            try {
                const isEdit = editingId !== null;
                const urlLayanan = '<?= site_url('admin/layanan') ?>';

                if (isEdit) {
                    const idSekarang = daftarSekarang
                        .filter(item => item.id !== null)
                        .map(item => item.id);

                    // Layanan lama yang sudah dibuang dari daftar input.
                    const layananDihapus = layananAwal.filter(
                        lama => !idSekarang.includes(lama.id)
                    );

                    // 1. Hapus layanan yang dipilih untuk dihapus.
                    for (const layanan of layananDihapus) {
                        await requestInstansi(
                            `${urlLayanan}/${layanan.id}`,
                            { method: 'DELETE' }
                        );
                    }

                    // 2. Ubah nama layanan lama jika memang berubah.
                    for (const layanan of daftarSekarang) {
                        if (layanan.id === null) {
                            continue;
                        }

                        const lama = layananAwal.find(
                            item => item.id === layanan.id
                        );

                        if (
                            lama &&
                            lama.nama_layanan !== layanan.nama_layanan
                        ) {
                            await requestInstansi(
                                `${urlLayanan}/${layanan.id}`,
                                {
                                    method: 'PUT',
                                    body: JSON.stringify({
                                        nama_layanan: layanan.nama_layanan
                                    })
                                }
                            );
                        }
                    }

                    // 3. Tambahkan layanan yang belum punya ID.
                    for (const layanan of daftarSekarang) {
                        if (layanan.id !== null) {
                            continue;
                        }

                        await requestInstansi(urlLayanan, {
                            method: 'POST',
                            body: JSON.stringify({
                                instansi_id: editingId,
                                nama_layanan: layanan.nama_layanan
                            })
                        });
                    }
                }

                // 4. Simpan nama dan grup instansi.
                const payloadInstansi = {
                    nama_instansi: nama,
                    grup_id: grupId
                };

                await requestInstansi(
                    isEdit
                        ? `${urlInstansi}/${editingId}`
                        : urlInstansi,
                    {
                        method: isEdit ? 'PUT' : 'POST',
                        body: JSON.stringify({
                            ...payloadInstansi,
                            ...(!isEdit
                                ? {
                                    layanan: daftarSekarang.map(
                                        item => item.nama_layanan
                                    )
                                }
                                : {})
                        })
                    }
                );

                alert(
                    isEdit
                        ? 'Data instansi dan layanan berhasil diperbarui!'
                        : 'Instansi dan layanan berhasil ditambahkan!'
                );

                modalInstansi.hide();
                window.location.reload();

            } catch (error) {
                console.error('Gagal menyimpan instansi/layanan:', error);

                alert(
                    'Gagal menyimpan perubahan: ' + error.message +
                    '\n\nJika ada layanan yang sudah terhapus atau berubah sebelum error, periksa kembali data setelah halaman dimuat ulang.'
                );

            } finally {
                btnSimpan.disabled = false;
            }
        });

        /* =================================================
        RESET MODAL
        ================================================= */

        modalInstansiEl.addEventListener('hidden.bs.modal', function () {
            editingId = null;
            layananAwal = [];

            formInstansi.reset();
            kosongkanDaftarLayanan();
            tambahInputLayanan();

            modalInstansiEl.querySelector('.modal-title').textContent =
                'Tambah Instansi';

            btnSimpan.textContent = 'Simpan';
        });

    </script>


</body>

</html>