<?php
// Nama akun yang sedang login (sesuaikan key session dengan yang dipakai di aplikasi)
$namaAkun = session()->get('username') ?? 'bapenda1';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Petugas Antrean - MPP Kota Tangerang</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        :root {
            --navy: #10233f;
            --navy-light: #193456;
            --yellow: #f5c542;
            --teal: #0e7c86;
            --teal-dark: #0b666e;
            --bg: #f4f6f9;
            --border: #e4e8ee;
            --muted: #7b8798;
            --green: #198754;
            --red: #dc3545;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            height: 100vh;
            overflow: hidden;
            background: var(--bg);
            color: #253247;
            font-family: Arial, Helvetica, sans-serif;
            font-size: 13px;
        }

        button, input, select, textarea {
            font-family: inherit;
        }

        /* HEADER */

        .topbar {
            height: 64px;
            padding: 0 24px;
            background: var(--navy);
            color: white;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .brand-logo {
            height: 42px;
            width: auto;
            max-width: 120px;
            object-fit: contain;
            flex-shrink: 0;
        }

        .brand-title {
            font-size: 16px;
            font-weight: bold;
        }

        .brand-title .akun {
            color: var(--yellow);
        }

        .brand-subtitle {
            color: #cbd5e1;
            font-size: 11px;
            margin-top: 3px;
        }

        .top-actions {
            display: flex;
            align-items: center;
            gap: 14px;
        }

        /* JAM */

        .clock-box {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 6px 14px 6px 8px;
            background: linear-gradient(180deg, #1c3a60 0%, #162f50 100%);
            border: 1px solid #2f4c70;
            border-radius: 10px;
            box-shadow: inset 0 1px 0 #ffffff12;
        }

        .clock-icon {
            width: 32px;
            height: 32px;
            display: grid;
            place-items: center;
            border-radius: 8px;
            background: #f5c5421f;
            border: 1px solid #f5c54255;
            color: var(--yellow);
            font-size: 16px;
        }

        .clock {
            font-size: 17px;
            font-weight: bold;
            line-height: 1.1;
            letter-spacing: 1px;
            font-variant-numeric: tabular-nums;
        }

        .clock-date {
            margin-top: 2px;
            color: #b8c5d6;
            font-size: 10.5px;
            letter-spacing: .2px;
        }

        .menu-button {
            background: var(--navy-light);
            border: 1px solid #52647a;
            border-radius: 7px;
            color: white;
            padding: 8px 12px;
            font-size: 13px;
        }

        .menu-button:hover,
        .menu-button:focus {
            background: #294564;
            color: white;
        }

        .dropdown-menu {
            min-width: 205px;
            padding: 6px;
            border: 1px solid var(--border);
            border-radius: 9px;
            box-shadow: 0 8px 24px #10233f18;
        }

        .dropdown-item {
            padding: 10px;
            border-radius: 5px;
            font-size: 13px;
        }

        /* HALAMAN UTAMA */

        .page {
            height: calc(100vh - 64px);
            padding: 16px 22px;
            display: flex;
            flex-direction: column;
            gap: 13px;
            min-height: 0;
        }

        .page-heading {
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
        }

        .page-heading h1 {
            margin: 0 0 5px;
            color: var(--navy);
            font-size: 21px;
            font-weight: bold;
        }

        .page-heading p {
            margin: 0;
            color: var(--muted);
            font-size: 12px;
        }

        .status-label {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            padding: 7px 11px;
            border-radius: 20px;
            background: #e4f6eb;
            color: #197044;
            font-weight: bold;
            font-size: 11px;
            white-space: nowrap;
        }

        .status-dot {
            width: 7px;
            height: 7px;
            border-radius: 50%;
            background: #229954;
        }

        .status-label.closed {
            background: #feeceb;
            color: #b42318;
        }

        .status-label.closed .status-dot {
            background: #d92d20;
        }

        .dashboard {
            flex: 1;
            min-height: 0;
            display: grid;
            grid-template-columns: minmax(0, 1.4fr) minmax(300px, 1fr);
            gap: 14px;
        }

        .column {
            min-height: 0;
            display: flex;
            flex-direction: column;
            gap: 14px;
        }

        .panel {
            background: white;
            border: 1px solid var(--border);
            border-radius: 9px;
            overflow: hidden;
        }

        .panel-heading {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 10px;
            padding: 12px 15px;
            border-bottom: 1px solid var(--border);
            color: var(--navy);
            font-weight: bold;
        }

        .panel-content {
            padding: 14px;
        }

        /* ANTREAN AKTIF */

        .current-panel {
            flex-shrink: 0;
        }

        .ticket {
            display: grid;
            grid-template-columns: .85fr 1.15fr;
            align-items: center;
            gap: 16px;
            padding: 16px;
            background: #fffaf0;
            border: 1px solid #efdfa9;
            border-radius: 8px;
        }

        .ticket-label {
            color: #7d6b3c;
            font-size: 11px;
            letter-spacing: .5px;
        }

        .ticket-number {
            margin: 8px 0;
            color: var(--navy);
            font-size: clamp(40px, 4.5vw, 58px);
            font-weight: 800;
            line-height: 1.1;
        }

        .ticket-category {
            display: inline-block;
            padding: 5px 9px;
            border-radius: 5px;
            background: var(--yellow);
            color: var(--navy);
            font-size: 11px;
            font-weight: bold;
        }

        .ticket-detail {
            padding-left: 17px;
            border-left: 1px solid #e7dba9;
        }

        .detail-row {
            margin-bottom: 10px;
        }

        .detail-row:last-child {
            margin-bottom: 0;
        }

        .detail-label {
            margin-bottom: 4px;
            color: var(--muted);
            font-size: 11px;
        }

        .detail-value {
            color: var(--navy);
            font-weight: bold;
            overflow-wrap: anywhere;
        }

        .main-buttons {
            display: grid;
            grid-template-columns: 1fr 1fr 1.25fr;
            gap: 8px;
            margin-top: 12px;
        }

        .main-btn {
            min-height: 39px;
            padding: 9px 5px;
            border-radius: 6px;
            font-size: 12px;
            font-weight: bold;
        }

        .btn-yellow {
            background: var(--yellow);
            border-color: var(--yellow);
            color: var(--navy);
        }

        .btn-yellow:hover {
            background: #e8b92f;
            border-color: #e8b92f;
            color: var(--navy);
        }

        .btn-navy {
            background: var(--navy);
            border-color: var(--navy);
            color: white;
        }

        .btn-navy:hover {
            background: var(--navy-light);
            border-color: var(--navy-light);
            color: white;
        }

        .btn-teal {
            background: var(--teal);
            border-color: var(--teal);
            color: white;
        }

        .btn-teal:hover,
        .btn-teal:focus {
            background: var(--teal-dark);
            border-color: var(--teal-dark);
            color: white;
        }

        .btn-light-outline {
            background: white;
            border: 1px solid #cbd5e1;
            color: var(--navy);
        }

        .btn-light-outline:hover {
            background: #f1f5f9;
            color: var(--navy);
        }

        .btn-transfer {
            width: 100%;
            margin-top: 9px;
            padding: 10px;
            background: white;
            border: 1px solid #d6deea;
            border-radius: 7px;
            color: var(--navy);
            font-size: 12px;
            font-weight: bold;
        }

        .btn-transfer:hover {
            background: #fff8dc;
            border-color: var(--yellow);
            color: var(--navy);
        }

        /* ANTREAN MENUNGGU */

        .waiting-panel,
        .history-panel {
            flex: 1;
            min-height: 0;
            display: flex;
            flex-direction: column;
        }

        .waiting-list {
            flex: 1;
            min-height: 0;
            padding: 0 15px;
        }

        .waiting-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 8px;
            padding: 10px 0;
            border-bottom: 1px solid #edf0f4;
        }

        .waiting-item:last-child {
            border-bottom: none;
        }

        .waiting-info {
            display: flex;
            align-items: center;
            gap: 10px;
            min-width: 0;
        }

        .wait-number {
            min-width: 58px;
            padding: 8px 5px;
            border-radius: 6px;
            background: #edf2f8;
            color: var(--navy);
            text-align: center;
            font-weight: bold;
        }

        .wait-name {
            font-size: 12px;
            font-weight: bold;
        }

        .wait-time {
            margin-top: 3px;
            color: var(--muted);
            font-size: 11px;
        }

        .tag {
            padding: 5px 8px;
            border-radius: 12px;
            background: #fff3c4;
            color: #805d00;
            font-size: 10px;
            white-space: nowrap;
        }

        .tag-priority {
            background: #eee5ff;
            color: #6941c6;
        }

        /* STATISTIK DAN RIWAYAT */

        .stats {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 10px;
            flex-shrink: 0;
        }

        .stat {
            padding: 13px;
            background: white;
            border: 1px solid var(--border);
            border-radius: 9px;
        }

        .stat-label {
            color: var(--muted);
            font-size: 11px;
        }

        .stat-number {
            margin-top: 4px;
            color: var(--navy);
            font-size: 26px;
            font-weight: bold;
        }

        .history-wrap {
            flex: 1;
            min-height: 0;
            overflow: auto;
        }

        .history-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 11px;
        }

        .history-table th {
            padding: 10px 13px;
            background: #f8fafc;
            color: var(--muted);
            text-align: left;
            font-weight: 600;
        }

        .history-table td {
            padding: 10px 13px;
            border-top: 1px solid #edf0f4;
        }

        .done-tag,
        .pending-tag {
            display: inline-block;
            padding: 4px 8px;
            border-radius: 12px;
            font-size: 10px;
            white-space: nowrap;
        }

        .done-tag {
            background: #e4f6eb;
            color: #197044;
        }

        .pending-tag {
            background: #fff3c4;
            color: #805d00;
        }

        .empty {
            padding: 18px 5px;
            color: var(--muted);
            text-align: center;
        }

        /* MODAL */

        .modal-content {
            overflow: hidden;
            border: 0;
            border-radius: 11px;
        }

        .modal-header {
            padding: 16px 20px;
            background: var(--navy);
            color: white;
        }

        .modal-header .btn-close {
            filter: invert(1);
        }

        .modal-title {
            font-size: 16px;
            font-weight: bold;
        }

        .modal-body {
            padding: 20px;
        }

        .modal-footer {
            padding: 12px 20px;
            border-top: 1px solid var(--border);
        }

        .form-label {
            margin-bottom: 6px;
            color: #344054;
            font-size: 12px;
            font-weight: bold;
        }

        .form-control,
        .form-select {
            min-height: 39px;
            border-color: #d0d5dd;
            border-radius: 6px;
            font-size: 13px;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: var(--navy-light);
            box-shadow: 0 0 0 3px #19345618;
        }

        .form-text {
            margin-top: 5px;
            color: var(--muted);
            font-size: 11px;
        }

        .required {
            color: #d92d20;
        }

        .transfer-modal .modal-dialog {
            max-width: 540px;
        }

        .transfer-intro {
            margin-bottom: 17px;
            color: var(--muted);
            font-size: 12px;
            line-height: 1.6;
        }

        .transfer-number-box {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            margin-bottom: 17px;
            padding: 12px 14px;
            background: #fff9e8;
            border: 1px solid #f0dfaa;
            border-radius: 8px;
        }

        .transfer-number {
            margin-top: 4px;
            color: var(--navy);
            font-size: 23px;
            font-weight: bold;
        }

        .transfer-status {
            padding: 6px 10px;
            border-radius: 20px;
            background: #e4f6eb;
            color: #197044;
            font-size: 11px;
            font-weight: bold;
            white-space: nowrap;
        }

        .transfer-modal textarea {
            min-height: 88px;
            resize: vertical;
        }

        @media (max-width: 760px) {
            body {
                height: auto;
                min-height: 100vh;
                overflow: auto;
            }

            .topbar {
                padding: 0 12px;
            }

            .brand-logo {
                height: 34px;
            }

            .brand-title {
                font-size: 13px;
            }

            .brand-subtitle {
                display: none;
            }

            .top-actions {
                gap: 8px;
            }

            .clock-box {
                padding: 5px 9px;
            }

            .clock-icon,
            .clock-date {
                display: none;
            }

            .clock {
                font-size: 13px;
                letter-spacing: .5px;
            }

            .page {
                height: auto;
                padding: 14px;
            }

            .dashboard {
                grid-template-columns: 1fr;
            }

            .waiting-panel,
            .history-panel {
                min-height: 210px;
            }
        }

        @media (min-width: 761px) and (max-height: 700px) {
            .page {
                padding: 9px 16px;
                gap: 8px;
            }

            .dashboard,
            .column {
                gap: 8px;
            }

            .panel-content {
                padding: 9px;
            }

            .ticket {
                padding: 10px;
            }

            .waiting-item {
                padding: 7px 0;
            }

            .main-btn {
                min-height: 35px;
                padding: 7px 4px;
            }

            .btn-transfer {
                margin-top: 6px;
                padding: 8px;
            }
        }
    </style>
</head>

<body>

<header class="topbar">
    <div class="brand">
        <img src="<?= base_url('assets/images/logokota.png') ?>"
             alt="Logo Kota Tangerang"
             class="brand-logo">

        <div>
            <div class="brand-title">
                Sistem Antrean Petugas -
                <span class="akun">(<?= esc($namaAkun) ?>)</span>
            </div>
            <div class="brand-subtitle">Monitoring layanan MPP Kota Tangerang</div>
        </div>
    </div>

    <div class="top-actions">
        <div class="clock-box">
            <div class="clock-icon">
                <i class="bi bi-clock"></i>
            </div>
            <div>
                <div class="clock" id="clock">--:--:--</div>
                <div class="clock-date" id="clockDate">-</div>
            </div>
        </div>

        <div class="dropdown">
            <button class="btn menu-button dropdown-toggle"
                    type="button"
                    data-bs-toggle="dropdown"
                    aria-expanded="false">
                <i class="bi bi-list me-1"></i>Menu
            </button>

            <ul class="dropdown-menu dropdown-menu-end">
                <li>
                    <button class="dropdown-item"
                            type="button"
                            data-bs-toggle="modal"
                            data-bs-target="#passwordModal">
                        <i class="bi bi-key me-2"></i>Ganti Password
                    </button>
                </li>

                <li>
                    <button class="dropdown-item"
                            type="button"
                            data-bs-toggle="modal"
                            data-bs-target="#settingModal"
                            onclick="isiPengaturan()">
                        <i class="bi bi-sliders me-2"></i>Pengaturan Loket
                    </button>
                </li>

                <li><hr class="dropdown-divider"></li>

                <li>
                    <form action="<?= site_url('logout') ?>"
                          method="post"
                          onsubmit="return confirm('Yakin ingin keluar?')">

                        <?= csrf_field() ?>

                        <button type="submit"
                                class="dropdown-item text-danger">
                            <i class="bi bi-box-arrow-right me-2"></i>Keluar
                        </button>
                    </form>
                </li>

            </ul>
        </div>
    </div>
</header>

<main class="page">

    <div class="page-heading">
        <div>
            <h1>Beranda Petugas</h1>
            <p>Kelola antrean dan proses pelayanan hari ini.</p>
        </div>

        <span class="status-label" id="statusBadge">
            <span class="status-dot"></span>
            <span id="statusBadgeText">Loket Buka</span>
        </span>
    </div>

    <section class="dashboard">

        <!-- KOLOM KIRI -->
        <div class="column">

            <section class="panel current-panel">
                <div class="panel-heading">
                    <span>
                        <i class="bi bi-megaphone me-2"></i>
                        Antrean Sedang Dilayani
                    </span>
                    <span class="text-secondary fw-normal" style="font-size:11px">
                        Loket 1
                    </span>
                </div>

                <div class="panel-content">
                    <div class="ticket">

                        <div>
                            <div class="ticket-label">NOMOR ANTREAN</div>
                            <div class="ticket-number" id="ticketNumber">A-002</div>
                            <span class="ticket-category" id="ticketCategory">UMUM</span>
                        </div>

                        <div class="ticket-detail">
                            <div class="detail-row">
                                <div class="detail-label">Instansi</div>
                                <div class="detail-value">BAPENDA</div>
                            </div>
                        </div>

                    </div>

                    <div class="main-buttons">
                        <button type="button"
                                class="btn main-btn btn-teal"
                                onclick="panggilUlang()">
                            <i class="bi bi-arrow-repeat me-1"></i>Panggil Ulang
                        </button>

                        <button type="button"
                                class="btn main-btn btn-yellow"
                                onclick="selanjutnya()">
                            <i class="bi bi-arrow-right-circle me-1"></i>Selanjutnya
                        </button>

                        <button type="button"
                                class="btn main-btn btn-navy"
                                onclick="bukaKonfirmasi()">
                            <i class="bi bi-check-circle me-1"></i>Konfirmasi Selesai
                        </button>
                    </div>

                    <button type="button"
                            class="btn btn-transfer"
                            onclick="bukaTerusan()">
                        <i class="bi bi-arrow-left-right me-2"></i>
                        Buat Terusan Antrean
                    </button>
                </div>
            </section>

            <section class="panel waiting-panel">
                <div class="panel-heading">
                    <span>
                        <i class="bi bi-hourglass-split me-2"></i>
                        Antrean Berikutnya
                    </span>
                    <span class="text-secondary fw-normal" id="waitingCount">
                        3 antrean
                    </span>
                </div>

                <div class="waiting-list" id="waitingList"></div>
            </section>

        </div>

        <!-- KOLOM KANAN -->
        <div class="column">

            <div class="stats">
                <div class="stat">
                    <div class="stat-label">
                        <i class="bi bi-people me-1"></i>Antrean Menunggu
                    </div>
                    <div class="stat-number" id="countWaiting">3</div>
                </div>

                <div class="stat">
                    <div class="stat-label">
                        <i class="bi bi-check-circle me-1"></i>Sudah Selesai
                    </div>
                    <div class="stat-number" id="countDone">4</div>
                </div>
            </div>

            <section class="panel history-panel">
                <div class="panel-heading">
                    <span>
                        <i class="bi bi-clock-history me-2"></i>
                        Riwayat Pelayanan
                    </span>
                    <span class="text-secondary fw-normal" style="font-size:11px">
                        Hari ini
                    </span>
                </div>

                <div class="history-wrap">
                    <table class="history-table">
                        <thead>
                            <tr>
                                <th>Nomor</th>
                                <th>Waktu</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody id="historyList"></tbody>
                    </table>
                </div>
            </section>

        </div>

    </section>
</main>

<!-- =====================================================
     MODAL TERUSAN ANTREAN
===================================================== -->
<div class="modal fade transfer-modal"
     id="transferModal"
     tabindex="-1"
     aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered">
        <form class="modal-content" onsubmit="simpanTerusan(event)">

            <div class="modal-header">
                <div>
                    <h5 class="modal-title">
                        <i class="bi bi-arrow-left-right me-2"></i>
                        Buat Terusan Antrean
                    </h5>
                    <div style="font-size:11px;color:#d0d9e5;margin-top:4px">
                        Teruskan proses pelayanan ke instansi berikutnya.
                    </div>
                </div>

                <button type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"
                        aria-label="Tutup"></button>
            </div>

            <div class="modal-body">

                <p class="transfer-intro">
                    Pastikan pelayanan di instansi sebelumnya sudah dilakukan.
                    Isi keterangan agar instansi tujuan mengetahui tindakan
                    yang telah diberikan.
                </p>

                <div class="transfer-number-box">
                    <div>
                        <div class="detail-label">NOMOR ANTREAN</div>
                        <div class="transfer-number" id="transferNumberDisplay">
                            A-002
                        </div>
                    </div>

                    <span class="transfer-status">
                        <i class="bi bi-check-circle me-1"></i>Selesai
                    </span>
                </div>

                <!-- Nomor dan status tidak dapat diubah petugas -->
                <input type="hidden" id="transferNumber">
                <input type="hidden" id="transferStatus" value="Selesai">

                <div class="mb-3">
                    <label for="transferService" class="form-label">
                        Detail Pelayanan <span class="required">*</span>
                    </label>

                    <select class="form-select" id="transferService" required>
                        <option value="">Pilih layanan yang sudah diterima</option>
                        <option value="Administrasi Kendaraan">Administrasi Kendaraan</option>
                        <option value="Pajak Kendaraan">Pajak Kendaraan</option>
                        <option value="Balik Nama Kendaraan">Balik Nama Kendaraan</option>
                        <option value="Perpanjangan STNK">Perpanjangan STNK</option>
                        <option value="Konsultasi">Konsultasi</option>
                        <option value="Layanan Lainnya">Layanan Lainnya</option>
                    </select>

                    <div class="form-text">
                        Pilih pelayanan yang sudah ditangani di instansi sebelumnya.
                    </div>
                </div>

                <div class="mb-3">
                    <label for="transferNote" class="form-label">
                        Keterangan Layanan <span class="required">*</span>
                    </label>

                    <textarea class="form-control"
                              id="transferNote"
                              placeholder="Masukkan keterangan aksi yang sudah dilakukan pada pelayanan ini..."
                              required></textarea>
                </div>

                <div class="mb-1">
                    <label for="transferDestination" class="form-label">
                        Diteruskan ke <span class="required">*</span>
                    </label>

                    <select class="form-select" id="transferDestination" required>
                        <option value="">Pilih instansi tujuan</option>
                        <option value="SAMSAT">SAMSAT</option>
                        <option value="BAPENDA">BAPENDA</option>
                        <option value="BPKPD">BPKPD</option>
                        <option value="DISNAKER">DISNAKER</option>
                        <option value="DUKCAPIL">DUKCAPIL</option>
                        <option value="TASPEN">TASPEN</option>
                        <option value="BPJS KESEHATAN">BPJS KESEHATAN</option>
                        <option value="BPJS TK">BPJS TK</option>
                        <option value="PDAM">PDAM</option>
                        <option value="PENGADILAN AGAMA">PENGADILAN AGAMA</option>
                        <option value="PLN">PLN</option>
                        <option value="ATR BPN">ATR BPN</option>
                        <option value="KEJARI">KEJARI</option>
                        <option value="POLRES">POLRES</option>
                        <option value="BNN">BNN</option>
                        <option value="BPOM">BPOM</option>
                        <option value="DINAS LINGKUNGAN HIDUP">DINAS LINGKUNGAN HIDUP</option>
                        <option value="POS INDONESIA">POS INDONESIA</option>
                        <option value="DITJEN AHU">DITJEN AHU</option>
                        <option value="PELAYANAN PBG">PELAYANAN PBG</option>
                        <option value="DPUPR">DPUPR</option>
                        <option value="PERKIM">PERKIM</option>
                        <option value="DISHUB">DISHUB</option>
                        <option value="PTSP 1">PTSP 1</option>
                        <option value="PTSP 2">PTSP 2</option>
                        <option value="BANK BANTEN">BANK BANTEN</option>
                        <option value="BANK BJB">BANK BJB</option>
                        <option value="BAZNAS">BAZNAS</option>
                    </select>

                    <div class="form-text">
                        Pilih instansi yang akan melanjutkan pelayanan.
                    </div>
                </div>

            </div>

            <div class="modal-footer">
                <button type="button"
                        class="btn btn-light border"
                        data-bs-dismiss="modal">
                    Batal
                </button>

                <button type="submit" class="btn btn-yellow">
                    <i class="bi bi-check2 me-1"></i>Simpan Terusan
                </button>
            </div>

        </form>
    </div>
</div>

<!-- =====================================================
     MODAL KONFIRMASI PELAYANAN SELESAI
===================================================== -->
<div class="modal fade"
     id="completeModal"
     tabindex="-1"
     aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered">
        <form class="modal-content" onsubmit="simpanKonfirmasi(event)">

            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="bi bi-clipboard-check me-2"></i>
                    Konfirmasi Pelayanan Selesai
                </h5>

                <button type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">

                <div class="mb-3">
                    <label class="form-label">Nomor Antrean</label>
                    <input type="text"
                           class="form-control"
                           id="completeNumber"
                           readonly>
                </div>

                <div class="mb-3">
                    <label for="completeStatus" class="form-label">
                        Status Pemanggilan <span class="required">*</span>
                    </label>

                    <select class="form-select" id="completeStatus" required>
                        <option value="Selesai">Selesai</option>
                        <option value="Pending">Pending</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="completeService" class="form-label">
                        Detail Pelayanan <span class="required">*</span>
                    </label>

                    <select class="form-select" id="completeService" required>
                        <option value="">Pilih layanan</option>
                        <option value="Administrasi Kendaraan">Administrasi Kendaraan</option>
                        <option value="Pajak Kendaraan">Pajak Kendaraan</option>
                        <option value="Balik Nama Kendaraan">Balik Nama Kendaraan</option>
                        <option value="Perpanjangan STNK">Perpanjangan STNK</option>
                        <option value="Konsultasi">Konsultasi</option>
                        <option value="Layanan Lainnya">Layanan Lainnya</option>
                    </select>
                </div>

                <div>
                    <label for="completeNote" class="form-label">
                        Keterangan Layanan
                    </label>

                    <textarea class="form-control"
                              id="completeNote"
                              rows="3"
                              placeholder="Catatan hasil pelayanan atau tindak lanjut..."></textarea>
                </div>

            </div>

            <div class="modal-footer">
                <button type="button"
                        class="btn btn-light border"
                        data-bs-dismiss="modal">
                    Batal
                </button>

                <button type="submit" class="btn btn-yellow">
                    Simpan Konfirmasi
                </button>
            </div>

        </form>
    </div>
</div>

<!-- =====================================================
     MODAL PENGATURAN LOKET
===================================================== -->
<div class="modal fade"
     id="settingModal"
     tabindex="-1"
     aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered">
        <form class="modal-content" onsubmit="simpanPengaturan(event)">

            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="bi bi-sliders me-2"></i>Pengaturan Loket
                </h5>

                <button type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">

                <div class="mb-3">
                    <label for="quotaService" class="form-label">
                        Kuota Layanan per Hari
                    </label>

                    <input type="number"
                           min="1"
                           class="form-control"
                           id="quotaService"
                           value="50"
                           required>

                    <div class="form-text">
                        Batas jumlah antrean layanan dalam sehari.
                    </div>
                </div>

                <div class="mb-3">
                    <label for="quotaBooking" class="form-label">
                        Kuota Booking
                    </label>

                    <input type="number"
                           min="0"
                           class="form-control"
                           id="quotaBooking"
                           value="30"
                           required>

                    <div class="form-text">
                        Batas jumlah antrean yang dialokasikan untuk booking.
                    </div>
                </div>

                <div>
                    <label for="settingStatus" class="form-label">
                        Status Loket
                    </label>

                    <select class="form-select" id="settingStatus">
                        <option value="buka">Buka</option>
                        <option value="tutup">Tutup</option>
                    </select>
                </div>

            </div>

            <div class="modal-footer">
                <button type="button"
                        class="btn btn-light border"
                        data-bs-dismiss="modal">
                    Batal
                </button>

                <button type="submit" class="btn btn-yellow">
                    Simpan Pengaturan
                </button>
            </div>

        </form>
    </div>
</div>

<!-- =====================================================
     MODAL GANTI PASSWORD
===================================================== -->
<div class="modal fade"
     id="passwordModal"
     tabindex="-1"
     aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered modal-sm">
        <form class="modal-content" onsubmit="gantiPassword(event)">

            <div class="modal-header">
                <h5 class="modal-title">Ganti Password</h5>

                <button type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">

                <div class="mb-3">
                    <label for="oldPassword" class="form-label">
                        Password Lama
                    </label>

                    <input type="password"
                           class="form-control"
                           id="oldPassword"
                           required>
                </div>

                <div class="mb-3">
                    <label for="newPassword" class="form-label">
                        Password Baru
                    </label>

                    <input type="password"
                           class="form-control"
                           id="newPassword"
                           minlength="8"
                           required>
                </div>

                <div>
                    <label for="confirmPassword" class="form-label">
                        Ulangi Password Baru
                    </label>

                    <input type="password"
                           class="form-control"
                           id="confirmPassword"
                           minlength="8"
                           required>
                </div>

            </div>

            <div class="modal-footer">
                <button type="button"
                        class="btn btn-light border"
                        data-bs-dismiss="modal">
                    Batal
                </button>

                <button type="submit" class="btn btn-yellow">
                    Simpan
                </button>
            </div>

        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
    /*
     * DATA DEMO
     * Data ini belum terhubung ke database CI4.
     */
    // =====================================================
    // KONFIGURASI API
    // =====================================================

    const DASHBOARD_API =
        <?= json_encode(site_url('petugas/dashboard/data')) ?>;

    const PENGATURAN_API =
        <?= json_encode(site_url('petugas/pengaturan-loket')) ?>;

    const CSRF_HEADER =
        <?= json_encode(csrf_header()) ?>;

    let csrfToken =
        <?= json_encode(csrf_hash()) ?>;


    // =====================================================
    // STATE DASHBOARD
    // =====================================================

    let loketAktif = true;
    let kuotaLayanan = 50;
    let kuotaBooking = 30;
    let jumlahSelesai = 0;

    let aktif = {
        id: null,
        nomor: '-',
        jenis: '-',
        layanan: '-',
        waktu: '-'
    };

    let menunggu = [];
    let riwayat = [];

    const daftarLayanan = [
        'Administrasi Kendaraan',
        'Pajak Kendaraan',
        'Balik Nama Kendaraan',
        'Perpanjangan STNK',
        'Konsultasi',
        'Layanan Lainnya'
    ];


    // =====================================================
    // UTILITAS
    // =====================================================

    function escapeHTML(nilai) {
        return String(nilai ?? '')
            .replace(/&/g, '&amp;')
            .replace(/</g, '&lt;')
            .replace(/>/g, '&gt;')
            .replace(/"/g, '&quot;')
            .replace(/'/g, '&#039;');
    }

    function waktuSekarang() {
        return new Date()
            .toLocaleTimeString('id-ID', {
                hour12: false,
                timeZone: 'Asia/Jakarta'
            })
            .replace(/\./g, ':');
    }

    function updateClock() {
        document.getElementById('clock').textContent =
            waktuSekarang();

        document.getElementById('clockDate').textContent =
            new Date().toLocaleDateString('id-ID', {
                weekday: 'long',
                day: 'numeric',
                month: 'long',
                year: 'numeric',
                timeZone: 'Asia/Jakarta'
            });
    }

    function formatNomor(item) {
        if (!item) {
            return '-';
        }

        // Sesuai contoh nomor antrean pada frontend saat ini.
        // Cocokkan lagi dengan format nomor di kiosk.
        const prefix =
            item.jenis_antrean === 'PRIORITAS' ? 'B' : 'A';

        return prefix + '-' +
            String(item.nomor_antrean).padStart(3, '0');
    }

    function formatWaktu(nilai) {
        if (!nilai) {
            return '-';
        }

        const bagian = String(nilai).split(' ');

        return bagian.length > 1
            ? bagian[1]
            : String(nilai);
    }

    function formatAntrean(item) {
        return {
            id: item.riwayat_id,
            nomor: formatNomor(item),
            jenis: item.jenis_antrean === 'PRIORITAS'
                ? 'Prioritas'
                : 'Umum',
            layanan: item.nama_layanan || 'Belum ditentukan',
            waktu: formatWaktu(item.waktu_masuk)
        };
    }

    function antreanKosong() {
        return {
            id: null,
            nomor: '-',
            jenis: '-',
            layanan: '-',
            waktu: '-'
        };
    }


    // =====================================================
    // RENDER DASHBOARD
    // =====================================================

    function render() {
        document.getElementById('ticketNumber').textContent =
            aktif.nomor;

        const kategori =
            document.getElementById('ticketCategory');

        kategori.textContent = aktif.nomor === '-'
            ? ''
            : aktif.jenis.toUpperCase();

        kategori.style.display =
            aktif.nomor === '-' ? 'none' : 'inline-block';

        document.getElementById('countWaiting').textContent =
            menunggu.length;

        document.getElementById('waitingCount').textContent =
            menunggu.length + ' antrean';

        document.getElementById('countDone').textContent =
            jumlahSelesai;

        const waitingList =
            document.getElementById('waitingList');

        waitingList.innerHTML = menunggu.length
            ? menunggu.slice(0, 5).map(a => `
                <div class="waiting-item">
                    <div class="waiting-info">
                        <div class="wait-number">
                            ${escapeHTML(a.nomor)}
                        </div>
                        <div>
                            <div class="wait-name">
                                ${escapeHTML(a.layanan)}
                            </div>
                            <div class="wait-time">
                                Terdaftar ${escapeHTML(a.waktu)}
                            </div>
                        </div>
                    </div>

                    <span class="tag ${
                        a.jenis === 'Prioritas'
                            ? 'tag-priority'
                            : ''
                    }">
                        ${escapeHTML(a.jenis)}
                    </span>
                </div>
            `).join('')
            : '<div class="empty">Tidak ada antrean menunggu.</div>';

        const historyList =
            document.getElementById('historyList');

        historyList.innerHTML = riwayat.length
            ? riwayat.slice(0, 8).map(a => `
                <tr>
                    <td>
                        <strong>${escapeHTML(a.nomor)}</strong>
                    </td>
                    <td>${escapeHTML(a.waktu)}</td>
                    <td>
                        <span class="${
                            a.status === 'Selesai'
                                ? 'done-tag'
                                : 'pending-tag'
                        }">
                            ${escapeHTML(a.status)}
                        </span>
                    </td>
                </tr>
            `).join('')
            : `
                <tr>
                    <td colspan="3" class="empty">
                        Belum ada riwayat.
                    </td>
                </tr>
            `;
    }


    // =====================================================
    // AMBIL DATA DASHBOARD DARI MYSQL
    // =====================================================

    async function muatDashboard() {
        try {
            const response = await fetch(DASHBOARD_API, {
                method: 'GET',
                credentials: 'same-origin',
                cache: 'no-store',
                headers: {
                    'Accept': 'application/json'
                }
            });

            if (!response.ok) {
                throw new Error(
                    'Gagal memuat dashboard. HTTP ' +
                    response.status
                );
            }

            const hasil = await response.json();

            if (!hasil.status) {
                throw new Error(
                    hasil.message || 'Data dashboard gagal dimuat.'
                );
            }

            const data = hasil.data;

            aktif = data.aktif
                ? formatAntrean(data.aktif)
                : antreanKosong();

            menunggu = (data.menunggu || [])
                .map(formatAntrean);

            jumlahSelesai =
                Number(data.jumlah_selesai || 0);

            riwayat = (data.riwayat || []).map(item => ({
                nomor: formatNomor(item),
                waktu: formatWaktu(
                    item.waktu_selesai ||
                    item.waktu_mulai ||
                    item.waktu_masuk
                ),
                status: item.status_layanan === 'SELESAI'
                    ? 'Selesai'
                    : 'Pending'
            }));

            render();

        } catch (error) {
            console.error(
                'Gagal memuat dashboard petugas:',
                error
            );
        }
    }


    // =====================================================
    // SUARA PEMANGGILAN
    // =====================================================

    function suara(nomor) {
        if (
            !('speechSynthesis' in window) ||
            nomor === '-'
        ) {
            return;
        }

        speechSynthesis.cancel();

        const ucapan = new SpeechSynthesisUtterance(
            'Nomor antrean ' +
            nomor.replace('-', ' ') +
            ', silakan menuju loket satu'
        );

        ucapan.lang = 'id-ID';

        speechSynthesis.speak(ucapan);
    }


    // =====================================================
    // TOMBOL ANTREAN
    // =====================================================

    // Backend antrean sudah punya routes, tetapi format
    // request PetugasAntreanController belum kita periksa.
    // Jangan ubah database dengan asumsi payload yang salah.

    function panggilUlang() {
        if (!loketAktif) {
            alert('Loket sedang ditutup.');
            return;
        }

        if (aktif.nomor === '-') {
            alert('Belum ada antrean aktif.');
            return;
        }

        // Sementara hanya suara lokal.
        // Log pemanggilan DB akan disambungkan berikutnya.
        suara(aktif.nomor);
    }

    function selanjutnya() {
        if (!loketAktif) {
            alert('Loket sedang ditutup.');
            return;
        }

        if (menunggu.length === 0) {
            alert('Tidak ada antrean berikutnya.');
            return;
        }

        alert(
            'Data antrean sudah terhubung ke database.\n\n' +
            'Aksi Selanjutnya akan kita sambungkan ke ' +
            'PetugasAntreanController::panggil agar ' +
            'status antrean benar-benar berubah di MySQL.'
        );
    }


    // =====================================================
    // MODAL KONFIRMASI SELESAI
    // =====================================================

    function bukaKonfirmasi() {
        if (aktif.nomor === '-') {
            alert('Tidak ada antrean aktif.');
            return;
        }

        document.getElementById('completeNumber').value =
            aktif.nomor;

        document.getElementById('completeStatus').value =
            'Selesai';

        const serviceSelect =
            document.getElementById('completeService');

        serviceSelect.value =
            daftarLayanan.includes(aktif.layanan)
                ? aktif.layanan
                : '';

        document.getElementById('completeNote').value = '';

        bootstrap.Modal.getOrCreateInstance(
            document.getElementById('completeModal')
        ).show();
    }

    function simpanKonfirmasi(event) {
        event.preventDefault();

        alert(
            'Konfirmasi belum dikirim ke database.\n' +
            'Kita perlu mencocokkan parameter endpoint ' +
            'petugas/antrean/status terlebih dahulu.'
        );
    }


    // =====================================================
    // MODAL TERUSAN ANTREAN
    // =====================================================

    function bukaTerusan() {
        if (aktif.nomor === '-') {
            alert(
                'Tidak ada antrean aktif yang bisa diteruskan.'
            );
            return;
        }

        document.getElementById('transferNumber').value =
            aktif.nomor;

        document.getElementById(
            'transferNumberDisplay'
        ).textContent = aktif.nomor;

        document.getElementById('transferStatus').value =
            'Selesai';

        const serviceSelect =
            document.getElementById('transferService');

        serviceSelect.value =
            daftarLayanan.includes(aktif.layanan)
                ? aktif.layanan
                : '';

        document.getElementById('transferNote').value = '';
        document.getElementById(
            'transferDestination'
        ).value = '';

        bootstrap.Modal.getOrCreateInstance(
            document.getElementById('transferModal')
        ).show();
    }

    function simpanTerusan(event) {
        event.preventDefault();

        alert(
            'Terusan antrean belum dikirim ke database.\n' +
            'Kita perlu mencocokkan ID instansi tujuan dan ' +
            'parameter PetugasAntreanController::terusan.'
        );
    }


    // =====================================================
    // PENGATURAN LOKET - AMBIL DATA
    // =====================================================

    async function isiPengaturan() {
        try {
            const response = await fetch(PENGATURAN_API, {
                method: 'GET',
                credentials: 'same-origin',
                cache: 'no-store',
                headers: {
                    'Accept': 'application/json'
                }
            });

            if (!response.ok) {
                throw new Error(
                    'Gagal mengambil pengaturan. HTTP ' +
                    response.status
                );
            }

            const hasil = await response.json();

            if (!hasil.status) {
                throw new Error(
                    hasil.message ||
                    'Gagal mengambil pengaturan loket.'
                );
            }

            kuotaLayanan =
                Number(hasil.data.kuota_layanan);

            kuotaBooking =
                Number(hasil.data.kuota_booking);

            loketAktif =
                hasil.data.status_loket === 'BUKA';

            document.getElementById(
                'quotaService'
            ).value = kuotaLayanan;

            document.getElementById(
                'quotaBooking'
            ).value = kuotaBooking;

            document.getElementById(
                'settingStatus'
            ).value = loketAktif ? 'buka' : 'tutup';

            toggleStatusBadge();

        } catch (error) {
            console.error(
                'Gagal mengambil pengaturan loket:',
                error
            );

            alert(error.message);
        }
    }


    // =====================================================
    // STATUS BADGE BUKA / TUTUP
    // =====================================================

    function toggleStatusBadge() {
        const badge =
            document.getElementById('statusBadge');

        document.getElementById(
            'statusBadgeText'
        ).textContent = loketAktif
            ? 'Loket Buka'
            : 'Loket Tutup';

        badge.classList.toggle(
            'closed',
            !loketAktif
        );
    }


    // =====================================================
    // PENGATURAN LOKET - SIMPAN KE MYSQL
    // =====================================================

    async function simpanPengaturan(event) {
        event.preventDefault();

        const layanan = Number(
            document.getElementById(
                'quotaService'
            ).value
        );

        const booking = Number(
            document.getElementById(
                'quotaBooking'
            ).value
        );

        const status = document
            .getElementById('settingStatus')
            .value
            .toUpperCase();

        if (
            !Number.isInteger(layanan) ||
            !Number.isInteger(booking) ||
            layanan < 1 ||
            booking < 0 ||
            booking > layanan
        ) {
            alert(
                'Periksa kembali kuota.\n' +
                'Kuota layanan minimal 1 dan kuota booking ' +
                'tidak boleh melebihi kuota layanan.'
            );
            return;
        }

        const tombolSimpan =
            event.currentTarget.querySelector(
                'button[type="submit"]'
            );

        tombolSimpan.disabled = true;

        try {
            const response = await fetch(PENGATURAN_API, {
                method: 'POST',
                credentials: 'same-origin',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    [CSRF_HEADER]: csrfToken
                },
                body: JSON.stringify({
                    kuota_layanan: layanan,
                    kuota_booking: booking,
                    status_loket: status
                })
            });

            const hasil = await response.json();

            // Controller mengembalikan csrfHash terbaru.
            if (hasil.csrfHash) {
                csrfToken = hasil.csrfHash;
            }

            if (!response.ok || !hasil.status) {
                throw new Error(
                    hasil.message ||
                    'Gagal menyimpan pengaturan loket.'
                );
            }

            kuotaLayanan =
                Number(hasil.data.kuota_layanan);

            kuotaBooking =
                Number(hasil.data.kuota_booking);

            loketAktif =
                hasil.data.status_loket === 'BUKA';

            toggleStatusBadge();

            bootstrap.Modal.getOrCreateInstance(
                document.getElementById('settingModal')
            ).hide();

            alert(
                'Pengaturan berhasil disimpan!\n\n' +
                'Kuota layanan: ' + kuotaLayanan + '\n' +
                'Kuota booking: ' + kuotaBooking + '\n' +
                'Status loket: ' +
                (loketAktif ? 'Buka' : 'Tutup')
            );

        } catch (error) {
            console.error(
                'Gagal menyimpan pengaturan:',
                error
            );

            alert(
                error.message +
                '\n\nKalau error CSRF, coba refresh halaman.'
            );
        } finally {
            tombolSimpan.disabled = false;
        }
    }


    // =====================================================
    // GANTI PASSWORD - MASIH DEMO
    // =====================================================

    function gantiPassword(event) {
        event.preventDefault();

        const baru =
            document.getElementById('newPassword').value;

        const konfirmasi =
            document.getElementById('confirmPassword').value;

        if (baru !== konfirmasi) {
            alert(
                'Password baru dan konfirmasi password tidak sama.'
            );
            return;
        }

        alert(
            'Fitur ganti password belum terhubung ke backend.'
        );
    }


    // =====================================================
    // INISIALISASI
    // =====================================================

    updateClock();
    setInterval(updateClock, 1000);

    render();
    toggleStatusBadge();

    // Ambil data dashboard asli.
    muatDashboard();

    // Refresh dashboard setiap 5 detik.
    setInterval(muatDashboard, 5000);

    // Ambil pengaturan loket asli saat halaman dibuka.
    isiPengaturan();

</script>

</body>
</html>