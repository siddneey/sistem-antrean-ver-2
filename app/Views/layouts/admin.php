<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title ?? 'Admin MPP Kota Tangerang') ?></title>
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

            transition: width 0.35s cubic-bezier(0.4, 0, 0.2, 1);
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

            transition: padding 0.35s cubic-bezier(0.4, 0, 0.2, 1);
        }


        .brand {
            display: flex;
            align-items: center;

            gap: 10px;

            min-width: 0;
            flex: 1;
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
            font-size: 15px;
            font-weight: 700;

            white-space: normal;

            overflow: visible;

            transition:
                opacity 0.25s ease,
                width 0.35s ease;
        }

        .brand-title,
        .brand-subtitle {
            display: block;
            width: 100%;
            line-height: 1.3;
        }

        .brand-title {
            font-size: 16px;
            font-weight: 700;
            line-height: 1.2;
            color: white;
        }

        .brand-subtitle {
            font-size: 16px;
            line-height: 1.3;
            color: #d5deeb;
            white-space: nowrap;
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

            color: #f5c542;

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
         height: 90px;
        min-height: 90px;
        width: 100%;
        padding: 0 30px;
        box-sizing: border-box;

        background: var(--white);
        border-bottom: 1px solid var(--border);

        display: flex;
        flex-direction: row;
        align-items: center;
        justify-content: space-between;
        gap: 24px;
        }


        .topbar-left {
            display: flex;
            flex-direction: row;
            align-items: center;
            gap: 16px;

            min-width: 0;
            color: var(--navy);
        }


        .topbar-right {
            display: flex;
            align-items: center;
            gap: 18px;
        }


        /* Ikon admin */
        .admin-icon {
            display: flex;
            align-items: center;
            justify-content: center;

            width: 30px;
            height: 30px;
            flex-shrink: 0;

            border-radius: 5px;
            background: #fff0b8;
            color: var(--navy);

            font-size: 20px;
        }

        /* Garis pemisah */
        .topbar-divider {
            width: 1px;
            height: 30px;
            flex-shrink: 0;
            background: #dce2eb;
        }

        .topbar-title,
        .topbar-subtitle {
            display: block;
            margin: 0;
            white-space: nowrap;
        }

        .topbar-title {
            margin: 0;
            flex-shrink: 0;

            color: var(--navy);
            font-size: 20px;
            font-weight: 700;
            line-height: 1.3;
        }

        .topbar-subtitle {
            margin: 0;

            color: var(--muted);
            font-size: 14px;
            line-height: 1.5;
        }

        /* =========================
        DATE
        ========================= */
        .date-wrapper {
            display: flex;
            align-items: center;
            gap: 8px;
        }


        .date-wrapper i {
            color: var(--navy);
            font-size: 17px;
        }


        .realtime-date {
            display: flex;
            flex-direction: column;
            gap: 3px;
            color: var(--navy);
        }

        .date-label {
            font-size: 11px;
            color: var(--muted);
        }

        #tanggalSekarang {
            font-size: 13px;
            font-weight: 600;
            color: var(--navy);
            white-space: nowrap;
        }

        /* =========================
           LOGOUT
        ========================= */

        .logout-btn {
            height: 40px;
            padding: 0 14px;

            border: 1px solid #f1b5b5;
            border-radius: 8px;

            background: #fff1f1;
            color: #c62828;

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
            background: #c62828;
            border-color: #c62828;
            color: white;
        }

        /* =====================================================
           CONTENT
        ===================================================== */

        .content {
            padding: 30px;
        }


        .page-title {
            margin-bottom: 25px;
        }


        .page-title h4 {
            margin: 0;

            color: var(--navy);

            font-size: 23px;

            font-weight: 700;
        }


        .page-title p {
            margin: 6px 0 0;

            color: var(--muted);

            font-size: 13px;
        }


        
    </style>
    <?= $this->renderSection('styles') ?>
</head>

<body>
    <aside class="sidebar">

        <!-- Logo + Garis Tiga -->
        <div class="sidebar-header">

            <div class="brand">

                <div class="brand-logo">
                    <img src="<?= base_url('assets/images/logokota.png') ?>" alt="logokota">
                </div>

                <div class="brand-text">
                   <span class="brand-title">MPP</span>
                    <span class="brand-subtitle">Kota Tangerang</span>
                </div>

            </div>


            <!-- GARIS TIGA -->
            <button
                type="button"
                class="sidebar-toggle"
                id="sidebarToggle"
                title="Buka / Tutup Sidebar"
            >
                <i class="bi bi-list"></i>
            </button>

        </div>


        <!-- Welcome -->
        <div class="welcome">

            <small>Welcome,</small>

            <strong>Admin MPP</strong>

        </div>


        <!-- Menu -->
        <nav class="sidebar-menu">

            <div class="menu-title">
                Menu Utama
            </div>


            <a
                href="<?= site_url('admin/dashboard') ?>"
                class="menu-item <?= ($activeMenu ?? 'dashboard') === 'dashboard' ? 'active' : '' ?>" 
            >
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>


            <a href="<?= site_url('admin/laporan-proses-antrean') ?>" 
                class="menu-item <?= ($activeMenu ?? '') === 'laporan-proses-antrean' ? 'active' : '' ?>">
                <i class="bi bi-hourglass-split"></i>
                <span>Laporan Proses Antrean</span>
            </a>


            <a href="<?= base_url('admin/laporan-ringkasan-antrean') ?>" 
                class="menu-item <?= ($activeMenu ?? '') === 'laporan-ringkasan-antrean' ? 'active' : '' ?>">
                <i class="bi bi-bar-chart"></i>
                <span>Laporan Ringkasan Antrean</span>
            </a>


            <div class="menu-title">
                Master Data
            </div>


            <a href="<?= base_url('admin/instansi/halaman') ?>" 
                class="menu-item <?= ($activeMenu ?? '') === 'instansi' ? 'active' : '' ?>">
                <i class="bi bi-building"></i>
                <span>Instansi</span>
            </a>


            <a href="<?= base_url('admin/petugas/halaman') ?>" 
                class="menu-item <?= ($activeMenu ?? '') === 'petugas' ? 'active' : '' ?>">
                <i class="bi bi-person"></i>
                <span>Petugas</span>
            </a>


            <div class="menu-title">
                Pengaturan
            </div>


            <a href="<?= base_url('admin/pengaturan-kelompok') ?>" 
                class="menu-item <?= ($activeMenu ?? '') === 'pengaturan-kelompok' ? 'active' : '' ?>">
                <i class="bi bi-people"></i>
                <span>Pengaturan Kelompok</span>
            </a>


            <a href="<?= base_url('admin/pengaturan-layar') ?>" 
                class="menu-item <?= ($activeMenu ?? '') === 'pengaturan-layar' ? 'active' : '' ?>">
                <i class="bi bi-display"></i>
                <span>Pengaturan Layar</span>
            </a>


            <a href="<?= base_url('admin/pengaturan-hari-libur') ?>" 
                class="menu-item <?= ($activeMenu ?? '') === 'pengaturan-hari-libur' ? 'active' : '' ?>">
                <i class="bi bi-calendar-x"></i>
                <span>Pengaturan Hari Libur</span>
            </a>


            <a href="<?= site_url('admin/log-user-login') ?>" 
                class="menu-item <?= ($activeMenu ?? '') === 'log-user-login' ? 'active' : '' ?>">
                <i class="bi bi-clock-history"></i>
                <span>Log User Login</span>
            </a>


            <a href="<?= site_url('admin/absensi-petugas') ?>" 
                class="menu-item <?= ($activeMenu ?? '') === 'absensi-petugas' ? 'active' : '' ?>">
                <i class="bi bi-person-check"></i>
                <span>Absensi Petugas</span>
            </a>

        </nav>

    </aside>

    <main class="main-content">
        <header class="topbar">


        <!-- KIRI -->
        <div class="topbar-left">
            <div class="admin-icon">
                <i class="bi bi-person-gear"></i>
            </div>

            <div class="topbar-divider"></div>

            <h1 class="topbar-title">Admin</h1>

            <div class="topbar-divider"></div>

            <p class="topbar-subtitle">
                Monitoring Layanan MPP Kota Tangerang
            </p>
        </div>

        <!-- KANAN -->
        <div class="topbar-right">

            <!-- PILIH TANGGAL -->
            <div class="date-wrapper">
                <div class="realtime-date">
                    <span class="date-label">Hari ini</span>
                    <span id="tanggalSekarang">Memuat tanggal...</span>
                </div>
            </div>

            <!-- LOGOUT -->
            <form action="<?= site_url('logout') ?>" method="post" id="logoutForm">
                <?= csrf_field() ?>

                <button type="submit" class="logout-btn">
                    <i class="bi bi-box-arrow-right"></i>
                    <span>Logout</span>
                </button>
            </form>

        </div>

    
        </header>

        <section class="content">
            <?= $this->renderSection('pageTitle') ?>
            <?= $this->renderSection('content') ?>
        </section>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>

        const sidebarToggle = document.getElementById('sidebarToggle');
        if (sidebarToggle) {
            sidebarToggle.addEventListener('click', function () {
                if (window.innerWidth <= 700) {
                    document.body.classList.toggle('mobile-sidebar-open');
                } else {
                    document.body.classList.toggle('sidebar-collapsed');
                }
            });
        }

        const logoutButton = document.querySelector('.logout-btn');
        if (logoutButton) {
            logoutButton.addEventListener('click', function (event) {
                if (!window.confirm('Apakah Anda yakin ingin logout?')) {
                    event.preventDefault();
                }
            });
        }

        document.addEventListener('click', function (event) {
            if (window.innerWidth > 700) return;
            const sidebar = document.querySelector('.sidebar');
            const toggle = document.getElementById('sidebarToggle');
            if (
                document.body.classList.contains('mobile-sidebar-open') &&
                sidebar && toggle &&
                !sidebar.contains(event.target) &&
                !toggle.contains(event.target)
            ) {
                document.body.classList.remove('mobile-sidebar-open');
            }
        });


        function perbaruiTanggal() {
            const sekarang = new Date();

            const tanggal = new Intl.DateTimeFormat('id-ID', {
                weekday: 'long',
                day: 'numeric',
                month: 'long',
                year: 'numeric',
                timeZone: 'Asia/Jakarta'
            }).format(sekarang);

            const tanggalElement = document.getElementById('tanggalSekarang');

            if (tanggalElement) {
                tanggalElement.textContent =
                    tanggal.charAt(0).toUpperCase() + tanggal.slice(1);
            }
        }

        perbaruiTanggal();
        setInterval(perbaruiTanggal, 60000);


        document.addEventListener('DOMContentLoaded', function () {
            const sidebarMenu = document.querySelector('.sidebar-menu');

            if (!sidebarMenu) return;

            const storageKey = 'adminSidebarScroll';

            // Pulihkan posisi scroll saat halaman dibuka kembali
            const savedScroll = sessionStorage.getItem(storageKey);

            if (savedScroll !== null) {
                sidebarMenu.scrollTop = Number(savedScroll);
            }

            // Simpan posisi scroll ketika sidebar digulir
            sidebarMenu.addEventListener('scroll', function () {
                sessionStorage.setItem(storageKey, sidebarMenu.scrollTop);
            });

            // Simpan posisi sebelum pindah ke fitur lain
            document.querySelectorAll('.sidebar-menu a').forEach(function (link) {
                link.addEventListener('click', function () {
                    sessionStorage.setItem(storageKey, sidebarMenu.scrollTop);
                });
            });
        });

    </script>
    <?= $this->renderSection('scripts') ?>
</body>
</html>
