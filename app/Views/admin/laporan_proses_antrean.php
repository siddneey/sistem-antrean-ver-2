<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Proses Antrean - MPP Kota Tangerang</title>

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
            --border: #e3e7ed;
            --green: #198754;
            --red: #d9534f;
            --blue: #3b82a0;
            --sidebar-width: 260px;
            --sidebar-collapsed: 78px;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html, body {
            min-height: 100%;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
            background: var(--bg);
            color: var(--text);
            overflow-x: hidden;
        }

        /* =========================
           SIDEBAR
        ========================= */
        .sidebar {
            position: fixed;
            inset: 0 auto 0 0;
            width: var(--sidebar-width);
            height: 100vh;
            background: var(--navy);
            color: #fff;
            z-index: 1000;
            display: flex;
            flex-direction: column;
            overflow: hidden;
            transition: width .35s cubic-bezier(.4,0,.2,1);
        }

        .sidebar-header {
            height: 76px;
            min-height: 76px;
            padding: 0 17px;
            display: flex;
            align-items: center;
            border-bottom: 1px solid rgba(255,255,255,.08);
            transition: padding .35s cubic-bezier(.4,0,.2,1);
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 10px;
            min-width: 0;
            transition: opacity .25s ease, transform .35s cubic-bezier(.4,0,.2,1);
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
            transition: opacity .25s ease, width .35s ease;
        }

        .sidebar-toggle {
            width: 38px;
            height: 38px;
            min-width: 38px;
            border: none;
            background: transparent;
            color: #fff;
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
            transition: padding .35s ease, min-height .35s ease;
        }

        .welcome small {
            display: block;
            color: rgba(255,255,255,.48);
            font-size: 11px;
            margin-bottom: 4px;
            white-space: nowrap;
            transition: opacity .22s ease, transform .3s ease;
        }

        .welcome strong {
            display: block;
            color: #fff;
            font-size: 14px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            transition: opacity .22s ease, transform .3s ease;
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
        }

        .menu-item span {
            overflow: hidden;
            transition: opacity .22s ease, max-width .35s ease;
        }

        .menu-item:hover {
            color: #fff;
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

        /* =========================
           MAIN / TOPBAR
        ========================= */
        .main-content {
            margin-left: var(--sidebar-width);
            min-height: 100vh;
            transition: margin-left .35s cubic-bezier(.4,0,.2,1);
        }

        body.sidebar-collapsed .main-content {
            margin-left: var(--sidebar-collapsed);
        }

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
            transition: .2s ease;
        }

        .logout-btn:hover {
            background: var(--yellow);
            border-color: var(--yellow);
            color: var(--navy);
        }

        /* =========================
           CONTENT
        ========================= */
        .content {
            padding: 28px 30px 35px;
        }

        .page-heading {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 20px;
            margin-bottom: 20px;
        }

        .heading-main {
            display: flex;
            align-items: flex-start;
            gap: 12px;
        }

        .heading-icon {
            width: 38px;
            height: 38px;
            border-radius: 9px;
            background: #e9eef5;
            color: var(--navy);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            flex: 0 0 auto;
        }

        .page-heading h1 {
            margin: 0;
            color: var(--navy);
            font-size: 23px;
            line-height: 1.25;
            font-weight: 700;
        }

        .page-heading p {
            margin: 5px 0 0;
            color: var(--muted);
            font-size: 12.5px;
        }

        .report-date {
            color: var(--muted);
            font-size: 12px;
            padding-top: 5px;
            white-space: nowrap;
        }

        /* =========================
           FILTER
        ========================= */
        .filter-box {
            background: var(--white);
            border: 1px solid var(--border);
            border-radius: 11px;
            padding: 17px 18px 18px;
            margin-bottom: 18px;
        }

        .filter-title {
            display: flex;
            align-items: center;
            gap: 7px;
            color: var(--navy);
            font-size: 13px;
            font-weight: 700;
            margin-bottom: 14px;
        }

        .filter-title i {
            font-size: 14px;
            color: #64748b;
        }

        .filter-grid {
            display: grid;
            grid-template-columns: 1.05fr 1.05fr 1fr 1.2fr 1.25fr auto;
            gap: 12px;
            align-items: end;
        }

        .field label {
            display: block;
            margin-bottom: 6px;
            color: #667085;
            font-size: 11px;
            font-weight: 600;
        }

        .form-control,
        .form-select {
            height: 39px;
            border: 1px solid #dfe4ea;
            border-radius: 7px;
            color: var(--text);
            font-size: 12.5px;
            box-shadow: none !important;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: #aab7c8;
        }

        .btn-filter,
        .btn-export {
            height: 39px;
            border-radius: 7px;
            border: none;
            padding: 0 16px;
            font-size: 12px;
            font-weight: 700;
            white-space: nowrap;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 7px;
        }

        .btn-filter {
            background: var(--navy);
            color: #fff;
        }

        .btn-filter:hover {
            background: var(--navy-light);
            color: #fff;
        }

        .btn-export {
            background: #5fb967;
            color: #fff;
        }

        .btn-export:hover {
            background: #4fa957;
            color: #fff;
        }

        /* =========================
           TABLE
        ========================= */
        .table-panel {
            background: var(--white);
            border: 1px solid var(--border);
            border-radius: 11px;
            overflow: hidden;
        }

        .table-toolbar {
            min-height: 54px;
            padding: 0 17px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-bottom: 1px solid var(--border);
        }

        .table-toolbar-title {
            color: var(--navy);
            font-size: 13px;
            font-weight: 700;
        }

        .table-toolbar-info {
            color: var(--muted);
            font-size: 11px;
        }

        .table-wrap {
            width: 100%;
            overflow-x: auto;
        }

        .report-table {
            width: 100%;
            min-width: 1120px;
            border-collapse: collapse;
        }

        .report-table th {
            background: #f8f9fb;
            color: #475467;
            border-bottom: 1px solid #dfe4ea;
            border-right: 1px solid #edf0f3;
            padding: 12px 9px;
            font-size: 11px;
            font-weight: 700;
            text-align: center;
            vertical-align: middle;
            white-space: nowrap;
        }

        .report-table th:last-child {
            border-right: none;
        }

        .report-table td {
            height: 50px;
            padding: 9px;
            border-bottom: 1px solid #edf0f3;
            border-right: 1px solid #f0f2f5;
            color: #344054;
            font-size: 12px;
            text-align: center;
            vertical-align: middle;
        }

        .report-table td:last-child {
            border-right: none;
        }

        .report-table tbody tr.data-row:hover {
            background: #fbfcfd;
        }

        .date-row td {
            height: 39px;
            padding: 8px 13px;
            background: #fff8dc;
            color: #735d09;
            border-bottom: 1px solid #eee2ae;
            text-align: left;
            font-weight: 700;
            font-size: 12px;
        }

        .date-row i {
            margin-right: 7px;
        }

        .queue-number {
            color: var(--navy);
            font-weight: 700;
            font-size: 13px;
        }

        .instansi {
            text-align: left !important;
            font-weight: 700;
            color: var(--navy) !important;
        }

        .petugas {
            text-align: left !important;
        }

        .booking {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            color: #667085;
        }

        .booking.yes {
            color: var(--green);
            font-weight: 600;
        }

        .status-badge {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 68px;
            height: 24px;
            padding: 0 8px;
            border-radius: 5px;
            font-size: 10.5px;
            font-weight: 700;
        }

        .status-selesai {
            color: #176b42;
            background: #e8f5ed;
        }

        .status-proses {
            color: #7a5c00;
            background: #fff4cf;
        }

        .status-menunggu {
            color: #5b6472;
            background: #eef1f4;
        }

        .table-empty {
            padding: 45px 20px !important;
            color: var(--muted) !important;
        }

        /* =========================
           RESPONSIVE
        ========================= */
        @media (max-width: 1250px) {
            .filter-grid {
                grid-template-columns: repeat(3, minmax(0, 1fr));
            }

            .btn-filter,
            .btn-export {
                width: 100%;
            }
        }

        @media (max-width: 900px) {
            .content {
                padding: 23px 20px 30px;
            }

            .filter-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }

            .page-heading {
                display: block;
            }

            .report-date {
                margin-top: 8px;
            }
        }

        @media (max-width: 700px) {
            .sidebar {
                width: var(--sidebar-width);
                transform: translateX(-100%);
                box-shadow: 5px 0 25px rgba(0,0,0,.15);
            }

            body.mobile-sidebar-open .sidebar {
                transform: translateX(0);
            }

            .main-content,
            body.sidebar-collapsed .main-content {
                margin-left: 0;
            }

            .topbar {
                height: 64px;
                padding: 0 17px;
            }

            .topbar-left span {
                display: none;
            }

            .content {
                padding: 20px 16px 28px;
            }

            .filter-grid {
                grid-template-columns: 1fr;
            }

            .page-heading h1 {
                font-size: 20px;
            }
        }

        @media (max-width: 430px) {
            .topbar-left {
                font-size: 15px;
            }

            .logout-btn span {
                display: none;
            }

            .logout-btn {
                width: 38px;
                padding: 0;
                justify-content: center;
            }

            .heading-icon {
                width: 35px;
                height: 35px;
            }
        }
    </style>
</head>

<body>

    <!-- SIDEBAR -->
    <aside class="sidebar">
        <div class="sidebar-header">
            <div class="brand">
                <div class="brand-logo"><img src="<?= base_url('assets/images/logokota.png') ?>" alt="logokota">
                </div>
                <div class="brand-text">MPP Kota Tangerang</div>
            </div>

            <button type="button" class="sidebar-toggle" id="sidebarToggle"
                    title="Buka / Tutup Sidebar">
                <i class="bi bi-list"></i>
            </button>
        </div>

        <div class="welcome">
            <small>Welcome,</small>
            <strong>Admin MPP</strong>
        </div>

        <nav class="sidebar-menu">
            <div class="menu-title">Menu Utama</div>

            <a href="<?= base_url('admin/dashboard') ?>" class="menu-item">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>

            <a href="<?= base_url('admin/laporan-proses-antrean') ?>" class="menu-item active">
                <i class="bi bi-hourglass-split"></i>
                <span>Laporan Proses Antrean</span>
            </a>

            <a href="<?= base_url('admin/laporan-ringkasan-antrean') ?>" class="menu-item">
                <i class="bi bi-bar-chart"></i>
                <span>Laporan Ringkasan Antrean</span>
            </a>

            <div class="menu-title">Master Data</div>

            <a href="<?= base_url('admin/instansi/halaman') ?>" class="menu-item">
                <i class="bi bi-building"></i>
                <span>Instansi</span>
            </a>

            <a href="<?= base_url('admin/petugas/halaman') ?>" class="menu-item">
                <i class="bi bi-person"></i>
                <span>Petugas</span>
            </a>

            <div class="menu-title">Pengaturan</div>

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

    <!-- MAIN -->
    <main class="main-content">

        <header class="topbar">
            <div class="topbar-left">
                Admin
                <span>Monitoring layanan MPP Kota Tangerang</span>
            </div>

            <a href="#" class="logout-btn" id="logoutBtn">
                <i class="bi bi-box-arrow-right"></i>
                <span>Logout</span>
            </a>
        </header>

        <section class="content">

            <!-- PAGE HEADING -->
            <div class="page-heading">
                <div class="heading-main">
                    <div>
                        <h1>Laporan Proses Antrean</h1>
                        <p>Menampilkan riwayat proses antrean berdasarkan periode dan status layanan.</p>
                    </div>
                </div>

                <div class="report-date">
                    <i class="bi bi-calendar3 me-1"></i>
                    <?= date('d F Y') ?>
                </div>
            </div>

            <!-- FILTER -->
            <div class="filter-box">
                <div class="filter-title">
                    <i class="bi bi-funnel"></i>
                    Filter Laporan
                </div>

                <form id="filterForm" method="get">
                    <div class="filter-grid">

                        <div class="field">
                            <label for="tanggalMulai">Tanggal Mulai</label>
                            <input type="date" id="tanggalMulai" name="tanggal_mulai"
                                   class="form-control"
                                   value="<?= date('Y-m-d') ?>">
                        </div>

                        <div class="field">
                            <label for="tanggalSelesai">Tanggal Selesai</label>
                            <input type="date" id="tanggalSelesai" name="tanggal_selesai"
                                   class="form-control"
                                   value="<?= date('Y-m-d') ?>">
                        </div>

                        <div class="field">
                            <label for="statusAntrean">Status Antrean</label>
                            <select id="statusAntrean" name="status" class="form-select">
                                <option value="">Semua Antrean</option>
                                <option value="menunggu">Menunggu</option>
                                <option value="proses">Diproses</option>
                                <option value="selesai">Selesai</option>
                            </select>
                        </div>

                        <div class="field">
                            <label for="instansi">Instansi / Layanan</label>
                            <select id="instansi" name="instansi" class="form-select">
                                <option value="">Semua Instansi</option>
                                <option value="BAPENDA">BAPENDA</option>
                                <option value="SAMSAT">SAMSAT</option>
                                <option value="DUKCAPIL">DUKCAPIL</option>
                                <option value="DPMPTSP">DPMPTSP</option>
                                <option value="BPJS Kesehatan">BPJS Kesehatan</option>
                            </select>
                        </div>

                        <div class="field">
                            <label for="keyword">Cari Data</label>
                            <input type="text" id="keyword" name="keyword"
                                   class="form-control"
                                   placeholder="Nomor / Instansi / Petugas...">
                        </div>

                        <div class="field">
                            <button type="submit" class="btn-filter w-100">
                                <i class="bi bi-search"></i>
                                Cari Data
                            </button>
                        </div>

                    </div>
                </form>
            </div>

            <!-- TABLE -->
            <div class="table-panel">

                <div class="table-toolbar">
                    <div>
                        <div class="table-toolbar-title">Data Proses Antrean</div>
                        <div class="table-toolbar-info">Riwayat antrean yang tercatat pada sistem</div>
                    </div>

                    <button type="button" class="btn-export" id="exportExcel">
                        <i class="bi bi-file-earmark-excel"></i>
                        Ekspor Excel
                    </button>
                </div>

                <div class="table-wrap">
                    <table class="report-table" id="reportTable">
                        <thead>
                            <tr>
                                <th style="width:45px;">No</th>
                                <th>Petugas</th>
                                <th>Nomor<br>Antrean</th>
                                <th>Ambil Tiket</th>
                                <th>Proses</th>
                                <th>Selesai</th>
                                <th>Instansi</th>
                                <th>Layanan</th>
                                <th>Kategori<br>Antrean</th>
                                <th>Booking</th>
                                <th>Diteruskan<br>Oleh</th>
                                <th>Status</th>
                            </tr>
                        </thead>

                        <tbody>

                            <tr class="date-row">
                                <td colspan="12">
                                    <i class="bi bi-calendar3"></i>
                                    Tanggal: <?= date('j F Y') ?>
                                </td>
                            </tr>

                            <!-- Contoh data -->
                            <tr class="data-row">
                                <td>1</td>
                                <td class="petugas">—</td>
                                <td class="queue-number">01</td>
                                <td>06:00:01</td>
                                <td>06:05:18</td>
                                <td>06:08:42</td>
                                <td class="instansi">BAPENDA</td>
                                <td>Pelayanan Pajak</td>
                                <td>Umum</td>
                                <td>
                                    <span class="booking yes">
                                        <i class="bi bi-check2"></i> Ya
                                    </span>
                                </td>
                                <td>—</td>
                                <td>
                                    <span class="status-badge status-selesai">Selesai</span>
                                </td>
                            </tr>

                            <tr class="data-row">
                                <td>2</td>
                                <td class="petugas">Petugas 01</td>
                                <td class="queue-number">02</td>
                                <td>06:02:15</td>
                                <td>06:09:11</td>
                                <td>06:14:03</td>
                                <td class="instansi">SAMSAT</td>
                                <td>Perpanjangan STNK</td>
                                <td>Umum</td>
                                <td>
                                    <span class="booking">Tidak</span>
                                </td>
                                <td>—</td>
                                <td>
                                    <span class="status-badge status-proses">Diproses</span>
                                </td>
                            </tr>

                        </tbody>
                    </table>
                </div>
            </div>

        </section>
    </main>

    <script>
        const sidebarToggle = document.getElementById('sidebarToggle');

        sidebarToggle.addEventListener('click', function () {
            if (window.innerWidth <= 700) {
                document.body.classList.toggle('mobile-sidebar-open');
            } else {
                document.body.classList.toggle('sidebar-collapsed');
            }
        });

        document.getElementById('logoutBtn').addEventListener('click', function (event) {
            if (!window.confirm('Apakah Anda yakin ingin logout?')) {
                event.preventDefault();
            }
        });

        document.getElementById('filterForm').addEventListener('submit', function (event) {
            const mulai = document.getElementById('tanggalMulai').value;
            const selesai = document.getElementById('tanggalSelesai').value;

            if (mulai && selesai && mulai > selesai) {
                event.preventDefault();
                alert('Tanggal mulai tidak boleh lebih besar dari tanggal selesai.');
            }
        });

        document.getElementById('exportExcel').addEventListener('click', function () {
            // Hubungkan ke endpoint ekspor Excel pada backend.
            // Contoh:
            // window.location.href = "<?= base_url('admin/laporan-proses-antrean/export') ?>?" + new URLSearchParams(new FormData(document.getElementById('filterForm')));
            alert('Fungsi ekspor Excel siap dihubungkan ke endpoint backend.');
        });

        document.addEventListener('click', function (event) {
            if (window.innerWidth > 700) return;

            const sidebar = document.querySelector('.sidebar');

            if (
                document.body.classList.contains('mobile-sidebar-open') &&
                !sidebar.contains(event.target) &&
                event.target !== sidebarToggle
            ) {
                document.body.classList.remove('mobile-sidebar-open');
            }
        });
    </script>

</body>
</html>