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

        .topbar {
            height: 76px;
            padding: 0 30px;
            background: white;
            border-bottom: 1px solid var(--border);
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .topbar-left {
            color: var(--navy);
            font-size: 17px;
            font-weight: 700;
        }

        .topbar-left span {
            margin-left: 8px;
            color: var(--muted);
            font-size: 12px;
            font-weight: 400;
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
            padding: 0 11px;
            border: 1px solid var(--border);
            border-radius: 8px;
            font-size: 13px;
        }

        .logout-btn {
            height: 40px;
            padding: 0 13px;
            display: flex;
            align-items: center;
            gap: 7px;
            border: 1px solid #eadfbd;
            border-radius: 8px;
            background: var(--yellow-soft);
            color: #806600;
            text-decoration: none;
            font-size: 13px;
        }

        .logout-btn:hover {
            background: var(--yellow);
            color: var(--navy);
        }

        /* PAGE */

        .page-content {
            padding: 28px 30px 40px;
        }

        
        .page-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
            margin-bottom: 23px;
        }

        .page-title {
            display: block;
        }

        .page-title h1 {
            margin: 0;
            color: var(--navy);
            font-size: 25px;
            font-weight: 700;
        }

        .page-description {
            margin: 6px 0 0;
            color: var(--muted);
            font-size: 12px;
        }

        .btn-add {
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
            white-space: nowrap;
            cursor: pointer;
            transition: background 0.2s ease;
        }

        .btn-add:hover {
            background: var(--navy-light);
            color: white;
        }

        /* SUMMARY */

        .stats-row {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 16px;
            margin-bottom: 20px;
        }

        .stat-card {
            display: flex;
            align-items: center;
            gap: 14px;
            padding: 17px 19px;
            background: white;
            border: 1px solid var(--border);
            border-radius: 10px;
        }

        .stat-icon {
            width: 44px;
            height: 44px;
            min-width: 44px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 9px;
            background: var(--yellow-soft);
            color: #a77c00;
            font-size: 20px;
        }

        .stat-card:nth-child(2) .stat-icon {
            background: #eaf1fb;
            color: #416b9d;
        }

        .stat-card:nth-child(3) .stat-icon {
            background: #e5f5ec;
            color: var(--green);
        }

        .stat-card small {
            display: block;
            margin-bottom: 4px;
            color: var(--muted);
            font-size: 12px;
        }

        .stat-card strong {
            font-size: 22px;
        }

        /* FILTER */

        .filter-box {
            padding: 16px;
            margin-bottom: 18px;
            background: white;
            border: 1px solid var(--border);
            border-radius: 9px;
        }

        .filter-row {
            display: grid;
            grid-template-columns: 1.5fr 1fr 1fr auto;
            gap: 10px;
        }

        .form-control,
        .form-select {
            min-height: 40px;
            border-color: var(--border);
            border-radius: 7px;
            font-size: 13px;
        }

        .btn-reset {
            min-height: 40px;
            padding: 0 15px;
            border: 1px solid var(--border);
            border-radius: 7px;
            background: white;
            color: #667085;
            font-size: 13px;
        }

        /* TABLE */

        .table-card {
            overflow: hidden;
            background: white;
            border: 1px solid var(--border);
            border-radius: 9px;
            box-shadow: 0 5px 18px rgba(16,35,63,.04);
        }

        .table {
            min-width: 820px;
            margin: 0;
        }

        .table thead th {
            padding: 14px 12px;
            background: #f8f9fa;
            color: #718096;
            border-bottom: 1px solid var(--border);
            font-size: 12px;
            font-weight: 600;
            white-space: nowrap;
        }

        .table tbody td {
            padding: 13px 12px;
            color: #667085;
            border-color: #edf0f3;
            font-size: 13px;
            vertical-align: middle;
        }

        .table tbody tr:hover {
            background: #fafbfc;
        }

        .holiday-name {
            color: #536b86 !important;
            font-weight: 600;
        }

        .holiday-badge {
            display: inline-block;
            padding: 6px 11px;
            border-radius: 15px;
            font-size: 11px;
            white-space: nowrap;
        }

        .badge-national {
            background: #fff3d7;
            color: #936b13;
        }

        .badge-special {
            background: #e5f5ec;
            color: #237a56;
        }

        .action-wrapper {
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .btn-action {
            width: 32px;
            height: 32px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border: none;
            border-radius: 7px;
            color: white;
        }

        .btn-edit {
            background: #42a5f5;
        }

        .btn-delete {
            background: #ef5350;
        }

        .table-footer {
            display: flex;
            justify-content: space-between;
            gap: 12px;
            padding: 14px 17px;
            color: var(--muted);
            font-size: 12px;
        }

        .empty-state {
            padding: 35px !important;
            text-align: center;
            color: var(--muted) !important;
        }

        .empty-state i {
            display: block;
            margin-bottom: 8px;
            font-size: 26px;
        }

        .modal-content {
            overflow: hidden;
            border: none;
            border-radius: 12px;
        }

        .modal-header {
            background: var(--navy);
            color: white;
        }

        .modal-header p {
            margin: 5px 0 0;
            color: rgba(255,255,255,.65);
            font-size: 12px;
        }

        .modal-header .btn-close {
            filter: invert(1);
        }

        .modal-body {
            padding: 23px;
        }

        .modal-body label {
            margin-bottom: 7px;
            color: #475467;
            font-size: 13px;
            font-weight: 600;
        }

        .btn-save {
            padding: 9px 17px;
            border: none;
            border-radius: 7px;
            background: #25aaa3;
            color: white;
            font-size: 13px;
        }

        @media (max-width: 1100px) {
            .filter-row {
                grid-template-columns: 1fr 1fr;
            }
        }

        @media (max-width: 768px) {
            .page-content {
                padding: 22px 15px;
            }

            .topbar {
                padding: 0 15px;
            }

            .topbar-left span {
                display: none;
            }

            .topbar-right {
                gap: 8px;
            }

            .date-input {
                width: 135px;
            }

            .stats-row {
                grid-template-columns: 1fr;
            }

            .page-header {
                align-items: flex-start;
                flex-direction: column;
            }

            .filter-row {
                grid-template-columns: 1fr;
            }

            .table-footer {
                flex-direction: column;
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

        <button class="sidebar-toggle" id="sidebarToggle" type="button">
            <i class="bi bi-list"></i>
        </button>
    </div>

    <div class="welcome">
        <small>Welcome,</small>
        <strong>Admin MPP</strong>
    </div>

    <div class="sidebar-menu">
        <div class="menu-title">Menu Utama</div>

        <a href="<?= base_url('admin') ?>" class="menu-item">
            <i class="bi bi-grid-1x2-fill"></i><span>Dashboard</span>
        </a>

        <a href="<?= base_url('admin/laporan-proses-antrean') ?>" class="menu-item">
            <i class="bi bi-hourglass-split"></i><span>Laporan Proses Antrean</span>
        </a>

        <a href="<?= base_url('admin/laporan-ringkasan-antrean') ?>" class="menu-item">
            <i class="bi bi-bar-chart-fill"></i><span>Laporan Ringkasan Antrean</span>
        </a>

        <div class="menu-title">Master Data</div>

        <a href="<?= base_url('admin/instansi') ?>" class="menu-item">
            <i class="bi bi-building"></i><span>Instansi</span>
        </a>

        <a href="<?= base_url('admin/petugas') ?>" class="menu-item">
            <i class="bi bi-person"></i><span>Petugas</span>
        </a>

        <div class="menu-title">Pengaturan</div>

        <a href="<?= base_url('admin/pengaturan-kelompok') ?>" class="menu-item">
            <i class="bi bi-people"></i><span>Pengaturan Kelompok</span>
        </a>

        <a href="<?= base_url('admin/pengaturan-layar') ?>" class="menu-item">
            <i class="bi bi-display"></i><span>Pengaturan Layar</span>
        </a>

        <a href="<?= base_url('admin/pengaturan-hari-libur') ?>" class="menu-item active">
            <i class="bi bi-calendar-x"></i><span>Pengaturan Hari Libur</span>
        </a>

        <a href="<?= site_url('admin/log-user-login') ?>" class="menu-item">
            <i class="bi bi-clock-history"></i><span>Log User Login</span>
        </a>

        <a href="<?= site_url('admin/absensi-petugas') ?>" class="menu-item">
            <i class="bi bi-person-check"></i><span>Absensi Petugas</span>
        </a>
    </div>
</aside>

<!-- MAIN CONTENT -->

<main class="main-content">

    <header class="topbar">
        <div class="topbar-left">
            Admin
            <span>Monitoring layanan MPP Kota Tangerang</span>
        </div>

        <div class="topbar-right">
            <div class="date-wrapper">
                <i class="bi bi-calendar3"></i>
                <input type="date" class="date-input" id="tanggal"
                       value="<?= date('Y-m-d') ?>">
            </div>

            <a href="#" class="logout-btn"
               onclick="return confirm('Yakin ingin logout?')">
                <span>Logout</span>
                <i class="bi bi-box-arrow-right"></i>
            </a>
        </div>
    </header>

    <section class="page-content">

        
        <div class="page-header">
            <div>
                <div class="page-title">
                    <h1>Pengaturan Hari Libur</h1>
                </div>

                <p class="page-description">
                    Kelola jadwal hari libur dan penutupan layanan MPP Kota Tangerang.
                </p>
            </div>

            <button class="btn-add" type="button" onclick="bukaTambah()">
                <i class="bi bi-plus-lg"></i>
                Tambah Hari Libur
            </button>
        </div>


        <!-- RINGKASAN -->

        <div class="stats-row">
            <div class="stat-card">
                <div class="stat-icon"><i class="bi bi-calendar2-week"></i></div>
                <div>
                    <small>Total Hari Libur</small>
                    <strong id="statTotal">0</strong>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-icon"><i class="bi bi-flag"></i></div>
                <div>
                    <small>Libur Nasional</small>
                    <strong id="statNasional">0</strong>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-icon"><i class="bi bi-building"></i></div>
                <div>
                    <small>Libur Khusus MPP</small>
                    <strong id="statKhusus">0</strong>
                </div>
            </div>
        </div>

        <!-- FILTER -->

        <div class="filter-box">
            <div class="filter-row">
                <input type="search" id="searchLibur" class="form-control"
                       placeholder="Cari nama hari libur atau keterangan...">

                <select id="filterTahun" class="form-select">
                    <option value="">Semua Tahun</option>
                </select>

                <select id="filterJenis" class="form-select">
                    <option value="">Semua Jenis Libur</option>
                    <option value="Nasional">Libur Nasional</option>
                    <option value="Khusus MPP">Libur Khusus MPP</option>
                </select>

                <button type="button" class="btn-reset" id="resetFilter">
                    <i class="bi bi-arrow-counterclockwise"></i> Reset
                </button>
            </div>
        </div>

        <!-- TABEL -->

        <div class="table-card">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th style="width:60px">No.</th>
                            <th>Tanggal</th>
                            <th>Nama Hari Libur</th>
                            <th>Jenis Libur</th>
                            <th>Keterangan</th>
                            <th style="width:100px">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="hariLiburBody"></tbody>
                </table>
            </div>

            <div class="table-footer">
                <span id="infoData">Menampilkan data hari libur</span>
                <span><i class="bi bi-info-circle me-1"></i> Data masih berupa dummy.</span>
            </div>
        </div>
    </section>
</main>

<!-- MODAL TAMBAH DAN EDIT -->

<div class="modal fade" id="modalHariLibur" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <div>
                    <h5 class="modal-title" id="judulModal">Tambah Hari Libur</h5>
                    <p>Lengkapi informasi hari libur di bawah ini.</p>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <form id="formHariLibur">
                    <input type="hidden" id="liburId">

                    <div class="mb-3">
                        <label for="tanggalLibur">Tanggal Libur</label>
                        <input type="date" id="tanggalLibur" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="namaLibur">Nama Hari Libur</label>
                        <input type="text" id="namaLibur" class="form-control"
                               maxlength="150" placeholder="Contoh: Hari Kemerdekaan"
                               required>
                    </div>

                    <div class="mb-3">
                        <label for="jenisLibur">Jenis Hari Libur</label>
                        <select id="jenisLibur" class="form-select" required>
                            <option value="">Pilih jenis libur</option>
                            <option value="Nasional">Libur Nasional</option>
                            <option value="Khusus MPP">Libur Khusus MPP</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="keteranganLibur">Keterangan</label>
                        <textarea id="keteranganLibur" class="form-control"
                                  rows="3" maxlength="500"
                                  placeholder="Keterangan tambahan (opsional)"></textarea>
                    </div>

                    <div class="d-flex justify-content-end gap-2 mt-4">
                        <button type="button" class="btn btn-light border"
                                data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn-save">
                            <i class="bi bi-check2-circle me-1"></i> Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
    // Data dummy sementara, tidak terhubung ke database.
    let dataHariLibur = [
        {
            id: 1,
            tanggal: '2026-01-01',
            nama: 'Tahun Baru Masehi',
            jenis: 'Nasional',
            keterangan: 'Libur nasional'
        },
        {
            id: 2,
            tanggal: '2026-08-17',
            nama: 'Hari Kemerdekaan Republik Indonesia',
            jenis: 'Nasional',
            keterangan: 'Peringatan Hari Kemerdekaan'
        },
        {
            id: 3,
            tanggal: '2026-12-25',
            nama: 'Hari Raya Natal',
            jenis: 'Nasional',
            keterangan: 'Libur nasional'
        },
        {
            id: 4,
            tanggal: '2026-12-31',
            nama: 'Penutupan Layanan Akhir Tahun',
            jenis: 'Khusus MPP',
            keterangan: 'Penyesuaian operasional layanan MPP'
        }
    ];

    let idBerikutnya = 5;

    const modalElement = document.getElementById('modalHariLibur');
    const modal = bootstrap.Modal.getOrCreateInstance(modalElement);
    const form = document.getElementById('formHariLibur');

    // Sidebar
    document.getElementById('sidebarToggle').addEventListener('click', function () {
        document.body.classList.toggle('sidebar-collapsed');
    });

    // Format tanggal ke format Indonesia
    function formatTanggal(tanggal) {
        if (!tanggal) return '-';

        const bagian = tanggal.split('-');
        return bagian[2] + '-' + bagian[1] + '-' + bagian[0];
    }

    // Mencegah teks input dibaca sebagai HTML
    function escapeHTML(teks) {
        return String(teks ?? '').replace(/[&<>"']/g, function (karakter) {
            return {
                '&': '&amp;',
                '<': '&lt;',
                '>': '&gt;',
                '"': '&quot;',
                "'": '&#039;'
            }[karakter];
        });
    }

    // Isi pilihan tahun sesuai data
    function perbaruiPilihanTahun() {
        const select = document.getElementById('filterTahun');
        const tahunDipilih = select.value;

        const tahunData = [...new Set(
            dataHariLibur.map(item => item.tanggal.substring(0, 4))
        )].sort();

        select.innerHTML = '<option value="">Semua Tahun</option>';

        tahunData.forEach(function (tahun) {
            const option = document.createElement('option');
            option.value = tahun;
            option.textContent = 'Tahun ' + tahun;
            select.appendChild(option);
        });

        if (tahunData.includes(tahunDipilih)) {
            select.value = tahunDipilih;
        }
    }

    // Render tabel dan statistik
    function tampilkanHariLibur() {
        const pencarian = document.getElementById('searchLibur')
            .value.toLowerCase().trim();
        const tahun = document.getElementById('filterTahun').value;
        const jenis = document.getElementById('filterJenis').value;

        const hasil = dataHariLibur
            .filter(function (item) {
                const cocokCari =
                    item.nama.toLowerCase().includes(pencarian) ||
                    item.keterangan.toLowerCase().includes(pencarian) ||
                    item.tanggal.includes(pencarian);

                const cocokTahun = !tahun || item.tanggal.startsWith(tahun);
                const cocokJenis = !jenis || item.jenis === jenis;

                return cocokCari && cocokTahun && cocokJenis;
            })
            .sort((a, b) => a.tanggal.localeCompare(b.tanggal));

        document.getElementById('statTotal').textContent = dataHariLibur.length;
        document.getElementById('statNasional').textContent =
            dataHariLibur.filter(item => item.jenis === 'Nasional').length;
        document.getElementById('statKhusus').textContent =
            dataHariLibur.filter(item => item.jenis === 'Khusus MPP').length;

        const tbody = document.getElementById('hariLiburBody');

        if (hasil.length === 0) {
            tbody.innerHTML = `
                <tr>
                    <td colspan="6" class="empty-state">
                        <i class="bi bi-calendar2-x"></i>
                        Tidak ada data hari libur yang sesuai.
                    </td>
                </tr>`;
        } else {
            tbody.innerHTML = hasil.map(function (item, index) {
                const badge = item.jenis === 'Nasional'
                    ? 'badge-national'
                    : 'badge-special';

                return `
                    <tr>
                        <td>${index + 1}</td>
                        <td>
                            <i class="bi bi-calendar3 me-1"></i>
                            ${formatTanggal(item.tanggal)}
                        </td>
                        <td class="holiday-name">${escapeHTML(item.nama)}</td>
                        <td>
                            <span class="holiday-badge ${badge}">
                                ${escapeHTML(item.jenis)}
                            </span>
                        </td>
                        <td>${escapeHTML(item.keterangan || '-')}</td>
                        <td>
                            <div class="action-wrapper">
                                <button type="button" class="btn-action btn-edit"
                                    title="Edit"
                                    onclick="editHariLibur(${item.id})">
                                    <i class="bi bi-pencil-square"></i>
                                </button>
                                <button type="button" class="btn-action btn-delete"
                                    title="Hapus"
                                    onclick="hapusHariLibur(${item.id})">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>`;
            }).join('');
        }

        document.getElementById('infoData').textContent =
            'Menampilkan ' + hasil.length + ' dari ' +
            dataHariLibur.length + ' data hari libur';
    }

    // Buka modal tambah
    function bukaTambah() {
        form.reset();
        document.getElementById('liburId').value = '';
        document.getElementById('judulModal').textContent = 'Tambah Hari Libur';
        modal.show();
    }

    // Buka modal edit
    function editHariLibur(id) {
        const item = dataHariLibur.find(data => data.id === id);

        if (!item) return;

        document.getElementById('liburId').value = item.id;
        document.getElementById('tanggalLibur').value = item.tanggal;
        document.getElementById('namaLibur').value = item.nama;
        document.getElementById('jenisLibur').value = item.jenis;
        document.getElementById('keteranganLibur').value = item.keterangan;

        document.getElementById('judulModal').textContent = 'Edit Hari Libur';
        modal.show();
    }

    // Simpan data dummy baru atau hasil edit
    form.addEventListener('submit', function (event) {
        event.preventDefault();

        const id = document.getElementById('liburId').value;
        const tanggal = document.getElementById('tanggalLibur').value;
        const nama = document.getElementById('namaLibur').value.trim();
        const jenis = document.getElementById('jenisLibur').value;
        const keterangan = document.getElementById('keteranganLibur').value.trim();

        if (!tanggal || !nama || !jenis) {
            alert('Tanggal, nama, dan jenis hari libur wajib diisi.');
            return;
        }

        // Cegah tanggal yang sama tercatat dua kali
        const duplikat = dataHariLibur.some(function (item) {
            return item.tanggal === tanggal && String(item.id) !== id;
        });

        if (duplikat) {
            alert('Tanggal tersebut sudah terdaftar sebagai hari libur.');
            return;
        }

        const itemBaru = {
            id: id ? Number(id) : idBerikutnya++,
            tanggal,
            nama,
            jenis,
            keterangan
        };

        if (id) {
            const index = dataHariLibur.findIndex(item => item.id === Number(id));

            if (index !== -1) {
                dataHariLibur[index] = itemBaru;
            }
        } else {
            dataHariLibur.push(itemBaru);
        }

        perbaruiPilihanTahun();
        tampilkanHariLibur();
        modal.hide();

        alert(id
            ? 'Data dummy hari libur berhasil diperbarui.'
            : 'Data dummy hari libur berhasil ditambahkan.');
    });

    // Hapus data dummy
    function hapusHariLibur(id) {
        const item = dataHariLibur.find(data => data.id === id);

        if (!item) return;

        if (!confirm('Hapus hari libur "' + item.nama + '"?')) return;

        dataHariLibur = dataHariLibur.filter(data => data.id !== id);

        perbaruiPilihanTahun();
        tampilkanHariLibur();
    }

    // Filter pencarian
    document.getElementById('searchLibur')
        .addEventListener('input', tampilkanHariLibur);

    document.getElementById('filterTahun')
        .addEventListener('change', tampilkanHariLibur);

    document.getElementById('filterJenis')
        .addEventListener('change', tampilkanHariLibur);

    // Reset semua filter
    document.getElementById('resetFilter').addEventListener('click', function () {
        document.getElementById('searchLibur').value = '';
        document.getElementById('filterTahun').value = '';
        document.getElementById('filterJenis').value = '';

        tampilkanHariLibur();
    });

    // Inisialisasi
    perbaruiPilihanTahun();
    tampilkanHariLibur();
</script>

</body>
</html>