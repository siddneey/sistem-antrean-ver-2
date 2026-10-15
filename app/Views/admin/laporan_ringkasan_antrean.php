<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Laporan Ringkasan Antrean - MPP Kota Tangerang</title>

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

        /* =========================
           SIDEBAR HEADER
        ========================= */

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

        /* =========================
           HAMBURGER
        ========================= */

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

        /* =========================
           WELCOME
        ========================= */

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

        /* =========================
           LOGOUT
        ========================= */

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
           LAPORAN RINGKASAN ANTREAN
        ===================================================== */

        .laporan-content {
            padding: 28px 30px 40px;
        }

        .laporan-header {
            display: flex;
            align-items: center;

            gap: 10px;

            margin-bottom: 22px;
        }

        .laporan-header i {
            color: var(--navy);

            font-size: 23px;
        }

        .laporan-header h1 {
            margin: 0;

            color: var(--navy);

            font-size: 25px;
            font-weight: 700;
        }

        /* =========================
           FILTER
        ========================= */

        .laporan-filter {
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

        .date-range {
            display: flex;
            align-items: center;
        }

        .date-range input {
            height: 38px;
            width: 150px;

            border: 1px solid var(--border);

            border-radius: 7px;

            background: var(--white);

            color: var(--text);

            font-size: 13px;

            padding: 0 10px;

            outline: none;
        }

        .date-range input:focus {
            border-color: var(--navy);

            box-shadow:
                0 0 0 3px rgba(16,35,63,0.08);
        }

        .date-separator {
            height: 38px;
            min-width: 45px;

            display: flex;
            align-items: center;
            justify-content: center;

            background: #f3f4f6;

            border-top: 1px solid var(--border);
            border-bottom: 1px solid var(--border);

            color: #6b7280;

            font-size: 13px;
            font-weight: 600;
        }

        .laporan-actions {
            display: flex;
            align-items: center;

            gap: 10px;

            margin-left: auto;
        }

        .btn-export {
            height: 38px;

            display: inline-flex;
            align-items: center;

            gap: 7px;

            padding: 0 16px;

            border: none;
            border-radius: 20px;

            background: #3aa0f3;

            color: white;

            text-decoration: none;

            font-size: 12px;
            font-weight: 600;

            cursor: pointer;

            transition: 0.2s ease;
        }

        .btn-export:hover {
            background: #258bdc;
            color: white;
        }

        .btn-export.secondary {
            background: #777;
        }

        .btn-export.secondary:hover {
            background: #5f5f5f;
        }

        /* =====================================================
           TABLE
        ===================================================== */

        .laporan-table-card {
            margin-top: 20px;

            background: var(--white);

            border: 1px solid var(--border);

            border-radius: 8px;

            overflow: hidden;

            box-shadow:
                0 4px 16px rgba(16,35,63,0.05);
        }

        .laporan-table {
            width: 100%;

            border-collapse: collapse;

            font-size: 13px;
        }

        .laporan-table thead th {
            height: 52px;

            padding: 0 10px;

            background: #fafafa;

            border-bottom: 1px solid var(--border);

            color: #64748b;

            text-align: left;

            font-size: 12px;
            font-weight: 600;
        }

        .laporan-table thead th:nth-child(2) {
            width: 190px;
        }

        .laporan-table thead th:nth-child(3) {
            width: 120px;
        }

        .laporan-table tbody td {
            height: 40px;

            padding: 0 10px;

            border-bottom: 1px solid #edf0f3;

            color: #64748b;
        }

        .laporan-table tbody tr:last-child td {
            border-bottom: none;
        }

        .laporan-table .instansi-row td {
            background: #fafafa;

            color: #64748b;

            font-weight: 700;
        }

        .laporan-table .layanan {
            padding-left: 35px;

            color: #64748b;
        }

        .laporan-table .jumlah {
            color: #64748b;

            text-align: left;
        }

        .laporan-table .aksi {
            text-align: center;
        }

        .laporan-table tfoot td {
            height: 42px;

            padding: 0 10px;

            background: #eaf5e3;

            color: #64748b;

            font-weight: 700;

            border-top: 1px solid #dcebd3;
        }

        .laporan-table tfoot td:first-child {
            text-align: right;
        }

        .laporan-table tfoot td:last-child {
            text-align: center;
        }

        /* =========================
           DETAIL BUTTON
        ========================= */

        .btn-detail {
            height: 34px;

            padding: 0 15px;

            display: inline-flex;
            align-items: center;
            justify-content: center;

            border-radius: 18px;

            background: #68bd70;

            color: white;

            text-decoration: none;

            font-size: 11px;
            font-weight: 600;

            transition: 0.2s ease;
        }

        .btn-detail:hover {
            background: #51a95b;
            color: white;
        }

        /* =====================================================
           RESPONSIVE
        ===================================================== */

        @media (max-width: 900px) {

            .laporan-actions {
                width: 100%;

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

            .laporan-content {
                padding: 20px;
            }
        }

        @media (max-width: 600px) {

            .laporan-header h1 {
                font-size: 21px;
            }

            .date-range {
                width: 100%;
            }

            .date-range input {
                width: 100%;
            }

            .laporan-actions {
                flex-direction: column;

                align-items: stretch;
            }

            .btn-export {
                justify-content: center;
            }

            .laporan-table-card {
                overflow-x: auto;
            }

            .laporan-table {
                min-width: 700px;
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
                    <img src="<?= base_url('assets/images/logokota.png') ?>" alt="logokota">
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
            <small>Welcome,</small>
            <strong>Admin MPP</strong>
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
                <span>Dashboard</span>
            </a>

            <!-- LAPORAN PROSES -->
            <a
                href="<?= site_url('admin/laporan-proses-antrean') ?>"
                class="menu-item"
            >
                <i class="bi bi-hourglass-split"></i>
                <span>Laporan Proses Antrean</span>
            </a>

            <!-- LAPORAN RINGKASAN -->
            <a
                href="<?= site_url('admin/laporan-ringkasan-antrean') ?>"
                class="menu-item active"
            >
                <i class="bi bi-bar-chart"></i>
                <span>Laporan Ringkasan Antrean</span>
            </a>

            <div class="menu-title">
                Master Data
            </div>

            <a href="<?= base_url('admin/instansi/halaman') ?>" class="menu-item">
                <i class="bi bi-building"></i>
                <span>Instansi</span>
            </a>

            <a href="<?= base_url('admin/petugas/halaman') ?>" class="menu-item">
                <i class="bi bi-person"></i>
                <span>Petugas</span>
            </a>

            <div class="menu-title">
                Pengaturan
            </div>

            <a href="<?= base_url('admin/pengaturan-kelompok') ?>" class="menu-item">
                <i class="bi bi-people"></i>
                <span>Pengaturan Kelompok</span>
            </a>

            <a href="<?= base_url('admin/pengaturan-layar') ?>" class="menu-item">
                <i class="bi bi-display"></i>
                <span>Pengaturan Layar</span>
            </a>

            <a href="<?= base_url('admin/pengaturan-hari-libur') ?>" class="menu-item">
                <i class="bi bi-calendar-x"></i>
                <span>Pengaturan Hari Libur</span>
            </a>

            <a href="<?= site_url('admin/log-user-login') ?>" class="menu-item">
                <i class="bi bi-clock-history"></i>
                <span>Log User Login</span>
            </a>

            <a href="<?= site_url('admin/absensi-petugas') ?>" class="menu-item">
                <i class="bi bi-person-check"></i>
                <span>Absensi Petugas</span>
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

                <a href="#" class="logout-btn">

                    <i class="bi bi-box-arrow-right"></i>

                    <span>Logout</span>

                </a>

            </div>

        </header>


        <!-- =====================================================
             LAPORAN RINGKASAN ANTREAN
        ===================================================== -->

        <section class="laporan-content">

            <div class="laporan-header">


                <h1>
                    Laporan Ringkasan Antrean
                </h1>

            </div>


            <!-- FILTER -->

            <div class="laporan-filter">

                <span class="filter-label">
                    PERIODE TANGGAL:
                </span>

                <div class="date-range">

                    <input
                        type="date"
                        name="tanggal_mulai"
                        value="<?= date('Y-m-d') ?>"
                    >

                    <span class="date-separator">
                        s/d
                    </span>

                    <input
                        type="date"
                        name="tanggal_selesai"
                        value="<?= date('Y-m-d') ?>"
                    >

                </div>


                <div class="laporan-actions">

                    <a href="#" class="btn-export">

                        <i class="bi bi-box-arrow-up-right"></i>

                        Ekspor ke Laporan Ringkasan

                    </a>

                    <a href="#" class="btn-export secondary">

                        <i class="bi bi-box-arrow-up-right"></i>

                        Ekspor ke Laporan Harian

                    </a>

                </div>

            </div>


            <!-- TABLE -->

            <div class="laporan-table-card">

                <table class="laporan-table">

                    <thead>

                        <tr>

                            <th>
                                Instansi / Layanan
                            </th>

                            <th>
                                Jumlah Antrean Selesai
                            </th>

                            <th>
                                Aksi
                            </th>

                        </tr>

                    </thead>


                    <tbody>

                        <tr class="instansi-row">

                            <td>
                                BAPENDA
                            </td>

                            <td class="jumlah">
                                4
                            </td>

                            <td class="aksi">

                                <a
                                    href="#"
                                    class="btn-detail"
                                >
                                    Lihat Detail
                                </a>

                            </td>

                        </tr>


                        <tr>

                            <td class="layanan">
                                – Pendaftaran SPPT PBB-P2 Objek Pajak Baru
                            </td>

                            <td class="jumlah">
                                1
                            </td>

                            <td></td>

                        </tr>


                        <tr>

                            <td class="layanan">
                                – Permohonan Penundaan Jatuh Tempo Pembayaran PBB-P2
                            </td>

                            <td class="jumlah">
                                1
                            </td>

                            <td></td>

                        </tr>


                        <tr>

                            <td class="layanan">
                                – Permohonan SPPT-PBB-P2 Mutasi Sebagian/Seluruhnya Objek dan Subjek
                            </td>

                            <td class="jumlah">
                                1
                            </td>

                            <td></td>

                        </tr>


                        <tr>

                            <td class="layanan">
                                – Permohonan Surat Keterangan NJOP
                            </td>

                            <td class="jumlah">
                                1
                            </td>

                            <td></td>

                        </tr>

                    </tbody>


                    <tfoot>

                        <tr>

                            <td>
                                TOTAL
                            </td>

                            <td class="jumlah">
                                4
                            </td>

                            <td></td>

                        </tr>

                    </tfoot>

                </table>

            </div>

        </section>

    </main>


    <!-- =====================================================
         JAVASCRIPT
    ===================================================== -->

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
            document.querySelector('.logout-btn');

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

    </script>

</body>

</html>