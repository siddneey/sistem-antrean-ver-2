<?php
$namaAkun = session()->get('username') ?? '-';
$instansiId = (int) ($instansiId ?? 0);
$namaInstansi = (string) ($namaInstansi ?? 'Instansi tidak ditemukan');
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard Petugas - MPP Kota Tangerang</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <style>

       /* Popup informasi panggilan */
    .popup-panggilan-backdrop {
        position: fixed;
        inset: 0;
        z-index: 20000;
        display: none;
        align-items: center;
        justify-content: center;
        padding: 20px;
        background: rgba(0, 0, 0, .48);
    }

    .popup-panggilan-backdrop.show {
        display: flex;
    }

    /* Kotak popup */
    .popup-panggilan {
        width: min(430px, 100%);
        overflow: hidden;
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 18px 50px rgba(0, 0, 0, .25);
        animation: popupPanggilanMasuk .18s ease-out;
    }

    /* Header */
    .popup-panggilan-header {
        min-height: 62px;
        padding: 14px 20px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        color: #fff;
        background: #10233f;
    }

    .popup-panggilan-title {
        display: flex;
        align-items: center;
        gap: 9px;
        font-size: 17px;
        font-weight: 650;
    }

    /* Tombol X */
    .popup-panggilan-close {
        width: 30px;
        height: 30px;
        padding: 0;
        border: 0;
        color: #fff;
        background: transparent;
        font-size: 29px;
        font-weight: 300;
        line-height: 1;
        cursor: pointer;
        opacity: .9;
    }

    .popup-panggilan-close:hover {
        opacity: 1;
    }

    /* Isi popup */
    .popup-panggilan-body {
        min-height: 165px;
        padding: 26px 28px 30px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        gap: 17px;
        text-align: center;
        color: #253247;
    }

    /* Ikon peringatan */
    .popup-panggilan-icon {
        width: 46px;
        height: 46px;
        display: grid;
        place-items: center;
        border: 3px solid #d6ad22;
        border-radius: 50%;
        color: #d6ad22;
        font-size: 29px;
        font-weight: 500;
        line-height: 1;
    }

    /* Teks pesan */
    .popup-panggilan-pesan {
        max-width: 360px;
        margin: 0;
        font-size: 15px;
        font-weight: 500;
        line-height: 1.5;
        white-space: pre-line;
    }

    .status-display-item {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    gap: 12px;
    padding: 10px 12px;
    margin-top: 8px;
    border: 1px solid var(--border);
    border-radius: 7px;
    background: #f8fafc;
}

    .status-display-item strong {
        color: var(--navy);
    }

    .status-display-item small {
        display: block;
        margin-top: 4px;
        color: var(--muted);
        line-height: 1.5;
    }

    .status-display-item .badge {
        flex-shrink: 0;
    }

    .pesan-status-gagal {
        padding: 10px 12px;
        background: #fff1f0;
        color: #b42318;
        border-radius: 7px;
        border: 1px solid #fecdca;
    }

    .pesan-status-siap {
        padding: 10px 12px;
        background: #e4f6eb;
        color: #197044;
        border-radius: 7px;
    }

    /* Animasi */
    @keyframes popupPanggilanMasuk {
        from {
            opacity: 0;
            transform: translateY(8px) scale(.98);
        }
        to {
            opacity: 1;
            transform: translateY(0) scale(1);
        }
    }

    /* Tampilan HP */
    @media (max-width: 576px) {
        .popup-panggilan {
            width: min(380px, 100%);
            border-radius: 12px;
        }

        .popup-panggilan-header {
            min-height: 56px;
            padding: 12px 16px;
        }

        .popup-panggilan-title {
            font-size: 16px;
        }

        .popup-panggilan-body {
            min-height: 145px;
            padding: 22px 18px;
            gap: 14px;
        }

        .popup-panggilan-icon {
            width: 42px;
            height: 42px;
            font-size: 26px;
        }

        .popup-panggilan-pesan {
            font-size: 14px;
        }
    }

        :root {
            --navy: #10233f;
            --navy-light: #193456;
            --yellow: #f5c542;
            --teal: #0e7c86;
            --bg: #f4f6f9;
            --border: #e4e8ee;
            --muted: #7b8798;
        }

        * { box-sizing: border-box; }

        body {
            margin: 0;
            min-height: 100vh;
            background: var(--bg);
            color: #253247;
            font: 13px Arial, sans-serif;
        }

        button, input, select, textarea { font: inherit; }

        .topbar {
            min-height: 64px;
            padding: 10px 24px;
            background: var(--navy);
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 12px;
            min-width: 0;
        }

        .brand-logo {
            height: 42px;
            max-width: 110px;
            object-fit: contain;
        }

        .brand-title {
            font-size: 16px;
            font-weight: 700;
        }

        .brand-title span { color: var(--yellow); }

        .brand-subtitle {
            font-size: 11px;
            color: #cbd5e1;
            margin-top: 3px;
        }

        .top-actions {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .clock-box {
            background: var(--navy-light);
            border: 1px solid #38516f;
            border-radius: 9px;
            padding: 7px 12px;
            text-align: center;
        }

        .clock {
            font-size: 17px;
            font-weight: 700;
            font-variant-numeric: tabular-nums;
        }

        .clock-date {
            font-size: 10px;
            color: #cbd5e1;
        }

        .menu-button {
            color: #fff;
            background: var(--navy-light);
            border: 1px solid #52647a;
        }

        .menu-button:hover {
            color: #fff;
            background: #294564;
        }

        .page {
            padding: 18px 22px;
            max-width: 1700px;
            margin: auto;
        }

        .page-heading {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 10px;
            margin-bottom: 14px;
        }

        .page-heading h1 {
            font-size: 21px;
            font-weight: 700;
            color: var(--navy);
            margin: 0 0 5px;
        }

        .page-heading p {
            color: var(--muted);
            margin: 0;
            font-size: 12px;
        }

        .status-label {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            background: #e4f6eb;
            color: #197044;
            padding: 8px 12px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 700;
            white-space: nowrap;
        }

        .status-dot {
            width: 7px;
            height: 7px;
            background: #229954;
            border-radius: 50%;
        }

        .status-label.closed {
            background: #feeceb;
            color: #b42318;
        }

        .status-label.closed .status-dot {
            background: #d92d20;
        }

        .dashboard {
            display: grid;
            grid-template-columns: minmax(0, 1.4fr) minmax(300px, 1fr);
            gap: 14px;
        }

        .column {
            display: flex;
            flex-direction: column;
            gap: 14px;
            min-width: 0;
        }

        .panel, .stat {
            background: #fff;
            border: 1px solid var(--border);
            border-radius: 9px;
            overflow: hidden;
        }

        .panel-heading {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 10px;
            padding: 13px 15px;
            border-bottom: 1px solid var(--border);
            color: var(--navy);
            font-weight: 700;
        }

        .panel-content { padding: 14px; }

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
            background: var(--yellow);
            color: var(--navy);
            border-radius: 5px;
            padding: 5px 9px;
            font-size: 11px;
            font-weight: 700;
        }

        .ticket-detail {
            padding-left: 17px;
            border-left: 1px solid #e7dba9;
        }

        .detail-label {
            color: var(--muted);
            font-size: 11px;
            margin-bottom: 4px;
        }

        .detail-value {
            color: var(--navy);
            font-weight: 700;
            overflow-wrap: anywhere;
        }

        .detail-row { margin-bottom: 10px; }

        .main-buttons {
            display: grid;
            grid-template-columns: 1fr 1fr 1.25fr;
            gap: 8px;
            margin-top: 12px;
        }

        .main-btn {
            min-height: 39px;
            font-size: 12px;
            font-weight: 700;
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
            color: #fff;
        }

        .btn-navy:hover {
            background: var(--navy-light);
            border-color: var(--navy-light);
            color: #fff;
        }

        .btn-teal {
            background: var(--teal);
            border-color: var(--teal);
            color: #fff;
        }

        .btn-teal:hover {
            background: #0b666e;
            border-color: #0b666e;
            color: #fff;
        }

        .btn-transfer {
            width: 100%;
            margin-top: 9px;
            padding: 10px;
            border: 1px solid #d6deea;
            border-radius: 7px;
            background: #fff;
            color: var(--navy);
            font-weight: 700;
        }

        .btn-transfer:hover {
            background: #fff8dc;
            border-color: var(--yellow);
        }

        .waiting-list {
            padding: 0 15px;
            max-height: 420px;
            overflow-y: auto;
        }

        .waiting-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 8px;
            padding: 12px 0;
            border-bottom: 1px solid #edf0f4;
        }

        .waiting-item:last-child { border: 0; }

        .waiting-info {
            display: flex;
            align-items: center;
            gap: 10px;
            min-width: 0;
        }

        .wait-number {
            min-width: 58px;
            padding: 8px 5px;
            text-align: center;
            background: #edf2f8;
            border-radius: 6px;
            color: var(--navy);
            font-weight: 700;
        }

        .wait-name {
            font-size: 12px;
            font-weight: 700;
        }

        .wait-time {
            color: var(--muted);
            font-size: 11px;
            margin-top: 3px;
        }

        .tag {
            display: inline-block;
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

        .stats {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 10px;
        }

        .stat { padding: 13px; }

        .stat-label {
            color: var(--muted);
            font-size: 11px;
        }

        .stat-number {
            margin-top: 4px;
            color: var(--navy);
            font-size: 26px;
            font-weight: 700;
        }

        .history-wrap {
            max-height: 420px;
            overflow: auto;
        }

        .history-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 11px;
        }

        .history-table th {
            background: #f8fafc;
            color: var(--muted);
            font-weight: 600;
            text-align: left;
            padding: 10px 13px;
        }

        .history-table td {
            border-top: 1px solid #edf0f4;
            padding: 10px 13px;
        }

        .done-tag, .pending-tag {
            padding: 4px 8px;
            border-radius: 12px;
            font-size: 10px;
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
            text-align: center;
            color: var(--muted);
            padding: 18px 5px;
        }

        .modal-header {
            background: var(--navy);
            color: #fff;
        }

        .modal-header .btn-close { filter: invert(1); }

        .modal-title {
            font-size: 16px;
            font-weight: 700;
        }

        .form-label {
            font-size: 12px;
            font-weight: 700;
        }

        .form-control, .form-select { font-size: 13px; }
        .form-text { font-size: 11px; }
        .required { color: #d92d20; }

        .transfer-number-box {
            background: #fff9e8;
            border: 1px solid #f0dfaa;
            border-radius: 8px;
            padding: 12px;
            margin-bottom: 16px;
        }

        .transfer-number {
            font-size: 23px;
            font-weight: 700;
            color: var(--navy);
        }

        @media (max-width: 760px) {
            .topbar { padding: 10px 12px; }
            .brand-logo { height: 34px; }
            .brand-title { font-size: 13px; }
            .brand-subtitle, .clock-date { display: none; }
            .clock { font-size: 12px; }
            .page { padding: 14px; }
            .dashboard { grid-template-columns: 1fr; }
            .ticket { grid-template-columns: 1fr 1fr; }
            .main-btn { font-size: 11px; }
        }

        @media (max-width: 420px) {
            .ticket { grid-template-columns: 1fr; }
            .ticket-detail {
                padding-left: 0;
                border-left: 0;
                border-top: 1px solid #e7dba9;
                padding-top: 12px;
            }
            .main-buttons { grid-template-columns: 1fr 1fr; }
            #btnSelesai { grid-column: 1 / -1; }
        }
    </style>
</head>

<body>

<header class="topbar">
    <div class="brand">
        <img
            src="<?= base_url('assets/logokota.png') ?>"
            class="brand-logo"
            alt="Logo Kota Tangerang"
        >

        <div>
            <div class="brand-title">
                Sistem Antrean Petugas -
                <span>(<?= esc($namaAkun) ?>)</span>
            </div>

            <div class="brand-subtitle">
                Monitoring layanan MPP Kota Tangerang
            </div>
        </div>
    </div>

    <div class="top-actions">
        <div class="clock-box">
            <div class="clock" id="clock">--:--:--</div>
            <div class="clock-date" id="clockDate">-</div>
        </div>

        <div class="dropdown">
            <button
                class="btn menu-button dropdown-toggle"
                data-bs-toggle="dropdown"
                type="button"
            >
                <i class="bi bi-list me-1"></i>Menu
            </button>

            <ul class="dropdown-menu dropdown-menu-end">
                <li>
                    <button
                        class="dropdown-item"
                        type="button"
                        data-bs-toggle="modal"
                        data-bs-target="#settingModal"
                        onclick="isiPengaturan()"
                    >
                        <i class="bi bi-sliders me-2"></i>
                        Pengaturan Instansi
                    </button>
                </li>

                <li><hr class="dropdown-divider"></li>

                <li>
                    <form
                        action="<?= site_url('logout') ?>"
                        method="post"
                        onsubmit="return confirm('Yakin ingin keluar?')"
                    >
                        <?= csrf_field() ?>

                        <button class="dropdown-item text-danger" type="submit">
                            <i class="bi bi-box-arrow-right me-2"></i>
                            Keluar
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

        <div class="column">

            <section class="panel">
                <div class="panel-heading">
                    <span>
                        <i class="bi bi-megaphone me-2"></i>
                        Antrean Sedang Dilayani
                    </span>

                    <span class="text-secondary fw-normal" style="font-size:11px">
                        Petugas aktif
                    </span>
                </div>

                <div class="panel-content">

                    <div class="ticket">
                        <div>
                            <div class="ticket-label">NOMOR ANTREAN</div>
                            <div class="ticket-number" id="ticketNumber">-</div>
                            <span class="ticket-category" id="ticketCategory" hidden></span>
                        </div>

                        <div class="ticket-detail">
                            <div class="detail-row">
                                <div class="detail-label">Instansi</div>
                                <div class="detail-value" id="activeInstansi">
                                    <?= esc($namaInstansi) ?>
                                </div>
                            </div>

                            <div class="detail-row">
                                <div class="detail-label">Detail Layanan</div>
                                <div class="detail-value" id="activeLayanan">-</div>
                            </div>
                        </div>
                    </div>

                    <div class="main-buttons">
                        <button
                            class="btn main-btn btn-teal"
                            type="button"
                            id="btnUlang"
                            onclick="panggilUlang()"
                        >
                            <i class="bi bi-arrow-repeat me-1"></i>
                            Panggil Ulang
                        </button>

                        <button
                            class="btn main-btn btn-yellow"
                            type="button"
                            id="btnSelanjutnya"
                            onclick="selanjutnya()"
                        >
                            <i class="bi bi-arrow-right-circle me-1"></i>
                            Selanjutnya
                        </button>

                        <button
                            class="btn main-btn btn-navy"
                            type="button"
                            id="btnSelesai"
                            onclick="bukaKonfirmasi()"
                        >
                            <i class="bi bi-check-circle me-1"></i>
                            Konfirmasi Selesai
                        </button>
                    </div>

                    <button
                        class="btn-transfer"
                        type="button"
                        id="btnTerusan"
                        onclick="bukaTerusan()"
                    >
                        <i class="bi bi-arrow-left-right me-2"></i>
                        Buat Terusan Antrean
                    </button>

                </div>
            </section>


            <section class="panel">
                <div class="panel-heading">
                    <span>
                        <i class="bi bi-hourglass-split me-2"></i>
                        Antrean Berikutnya
                    </span>

                    <span class="text-secondary fw-normal" id="waitingCount">
                        0 antrean
                    </span>
                </div>

                <div class="waiting-list" id="waitingList">
                    <div class="empty">Memuat antrean...</div>
                </div>
            </section>

        </div>


        <div class="column">

            <div class="stats">
                <div class="stat">
                    <div class="stat-label">
                        <i class="bi bi-people me-1"></i>
                        Antrean Menunggu
                    </div>
                    <div class="stat-number" id="countWaiting">0</div>
                </div>

                <div class="stat">
                    <div class="stat-label">
                        <i class="bi bi-check-circle me-1"></i>
                        Sudah Selesai
                    </div>
                    <div class="stat-number" id="countDone">0</div>
                </div>
            </div>


            <section class="panel">
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
                                <th>Status / Aksi</th>
                            </tr>
                        </thead>

                        <tbody id="historyList">
                            <tr>
                                <td colspan="3" class="empty">
                                    Memuat riwayat...
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </section>

        </div>

    </section>

</main>


<!-- MODAL KONFIRMASI -->

<div class="modal fade" id="completeModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">

        <form class="modal-content" onsubmit="simpanKonfirmasi(event)">

            <div class="modal-header">
                <h5 class="modal-title">Konfirmasi Pelayanan Selesai</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">

                <div class="mb-3">
                    <label class="form-label">Nomor Antrean</label>
                    <input id="completeNumber" class="form-control" readonly>
                </div>

                <div class="mb-3">
                    <label class="form-label" for="completeStatus">
                        Status <span class="required">*</span>
                    </label>

                    <select
                        class="form-select"
                        id="completeStatus"
                        onchange="ubahStatusKonfirmasi()"
                    >
                        <option value="SELESAI">Selesai</option>
                        <option value="PENDING">Pending</option>
                    </select>
                </div>

                <div class="mb-3" id="completeServiceWrap">
                    <label class="form-label" for="completeService">
                        Detail Pelayanan <span class="required">*</span>
                    </label>

                    <select class="form-select" id="completeService">
                        <option value="">Pilih layanan</option>
                    </select>
                </div>

                <div>
                    <label class="form-label" for="completeNote">
                        Keterangan <span class="required">*</span>
                    </label>

                    <textarea
                        id="completeNote"
                        class="form-control"
                        rows="3"
                        required
                    ></textarea>
                </div>

            </div>

            <div class="modal-footer">
                <button
                    class="btn btn-light border"
                    type="button"
                    data-bs-dismiss="modal"
                >
                    Batal
                </button>

                <button class="btn btn-yellow" type="submit">
                    Simpan Konfirmasi
                </button>
            </div>

        </form>
    </div>
</div>


<!-- MODAL TERUSAN -->

<div class="modal fade" id="transferModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">

        <form class="modal-content" onsubmit="simpanTerusan(event)">

            <div class="modal-header">
                <h5 class="modal-title">Buat Terusan Antrean</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">

                <p class="text-secondary">
                    Pelayanan asal diselesaikan, kemudian nomor antrean
                    yang sama masuk ke daftar menunggu instansi tujuan.
                </p>

                <div class="transfer-number-box">
                    <div class="detail-label">NOMOR ANTREAN</div>
                    <div class="transfer-number" id="transferNumberDisplay">-</div>
                </div>

                <div class="mb-3">
                    <label class="form-label" for="transferService">
                        Detail Pelayanan <span class="required">*</span>
                    </label>

                    <select class="form-select" id="transferService" required>
                        <option value="">Pilih layanan</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label" for="transferNote">
                        Keterangan Layanan <span class="required">*</span>
                    </label>

                    <textarea
                        class="form-control"
                        id="transferNote"
                        required
                    ></textarea>
                </div>

                <div>
                    <label class="form-label" for="transferDestination">
                        Diteruskan ke <span class="required">*</span>
                    </label>

                    <select class="form-select" id="transferDestination" required>
                        <option value="">Pilih instansi tujuan</option>
                    </select>
                </div>

            </div>

            <div class="modal-footer">
                <button
                    class="btn btn-light border"
                    type="button"
                    data-bs-dismiss="modal"
                >
                    Batal
                </button>

                <button class="btn btn-yellow" type="submit">
                    Simpan Terusan
                </button>
            </div>

        </form>
    </div>
</div>


<!-- MODAL PENGATURAN -->

<div class="modal fade" id="settingModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">

        <form class="modal-content" onsubmit="simpanPengaturan(event)">

            <div class="modal-header">
                <h5 class="modal-title">Pengaturan Instansi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">

                <div class="mb-3">
                    <label class="form-label" for="quotaService">
                        Kuota Layanan per Hari
                    </label>

                    <input
                        type="number"
                        class="form-control"
                        id="quotaService"
                        min="1"
                        required
                    >
                </div>

                <div class="mb-3">
                    <label class="form-label" for="quotaBooking">
                        Kuota Booking
                    </label>

                    <input
                        type="number"
                        class="form-control"
                        id="quotaBooking"
                        min="0"
                        required
                    >
                </div>

                <div>
                    <label class="form-label" for="settingStatus">
                        Status Instansi
                    </label>

                    <select class="form-select" id="settingStatus">
                        <option value="Aktif">Aktif</option>
                        <option value="Nonaktif">Nonaktif</option>
                    </select>
                </div>

            </div>

            <div class="modal-footer">
                <button
                    class="btn btn-light border"
                    type="button"
                    data-bs-dismiss="modal"
                >
                    Batal
                </button>

                <button class="btn btn-yellow" type="submit">
                    Simpan Pengaturan
                </button>
            </div>

        </form>
    </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
'use strict';


/*
|--------------------------------------------------------------------------
| API
|--------------------------------------------------------------------------
*/

const API = {
    dashboard: <?= json_encode(site_url('petugas/dashboard/data')) ?>,
    pilihan: <?= json_encode(site_url('petugas/pilihan')) ?>,
    panggil: <?= json_encode(site_url('petugas/antrean/panggil')) ?>,
    ulang: <?= json_encode(site_url('petugas/antrean/panggil-ulang')) ?>,
    status: <?= json_encode(site_url('petugas/antrean/status')) ?>,
    pending: <?= json_encode(site_url('petugas/antrean/panggil-pending')) ?>,
    terusan: <?= json_encode(site_url('petugas/antrean/terusan')) ?>,
    pengaturan: <?= json_encode(site_url('petugas/pengaturan-loket')) ?>,
    statusAudio: <?= json_encode(site_url('petugas/antrean/status-audio')) ?>
};

const INSTANSI_ID = <?= json_encode($instansiId) ?>;
const CSRF_HEADER = <?= json_encode(csrf_header()) ?>;

let csrfToken = <?= json_encode(csrf_hash()) ?>;


/*
|--------------------------------------------------------------------------
| STATE
|--------------------------------------------------------------------------
*/

let aktif = null;
let menunggu = [];
let riwayat = [];
let jumlahSelesai = 0;

let instansiAktif = true;
let sibuk = false;

let pilihanLayanan = [];
let pilihanInstansi = [];

let statusAudioLoaded = false;
let semuaDisplaySiap = false;
let statusPanggilanServer = 'UNKNOWN';

let audioGuard = false;

/*
 * Menandakan apakah status PLAYING sudah pernah diterima
 * setelah permintaan panggilan dilakukan.
 */
let audioPernahPlaying = false;

let daftarStatusDisplay = [];

let pesanStatusAudioError = '';
let pesanKesiapanServer = '';
let pesanPanggilanServer = '';

/*
 * Request status audio yang sedang berjalan.
 * Request polling dan klik tombol akan memakai request yang sama.
 */
let statusAudioRequest = null;

let dashboardChecking = false;


/*
|--------------------------------------------------------------------------
| HELPER
|--------------------------------------------------------------------------
*/

const el = id => document.getElementById(id);

function nilaiBoolean(value) {
    return value === true ||
           value === 1 ||
           value === '1' ||
           value === 'true';
}

const modal = id =>
    bootstrap.Modal.getOrCreateInstance(el(id));


function tampilkanNotifikasiPanggilan(pesan, jenis = 'gagal') {
    const popup = el('popupNotifikasiPanggilan');
    const isi = el('isiNotifikasiPanggilan');

    if (!popup || !isi) {
        console.warn(pesan);
        return;
    }

    isi.textContent = String(
        pesan || 'Panggilan tidak dapat diproses.'
    );

    popup.classList.add('show');
    popup.setAttribute('aria-hidden', 'false');
    el('tutupNotifikasiPanggilan')?.focus();
}

function tutupNotifikasiPanggilan() {
    const popup = el('popupNotifikasiPanggilan');

    if (!popup) return;

    popup.classList.remove('show');
    popup.setAttribute('aria-hidden', 'true');
}

document.addEventListener('keydown', event => {
    if (event.key === 'Escape') {
        tutupNotifikasiPanggilan();
    }
});

const escapeHTML = nilai => String(nilai ?? '')
    .replace(/&/g, '&amp;')
    .replace(/</g, '&lt;')
    .replace(/>/g, '&gt;')
    .replace(/"/g, '&quot;')
    .replace(/'/g, '&#039;');

const nomor = item =>
    item && item.nomor_antrean != null
        ? String(Number(item.nomor_antrean))
        : '-';

const waktu = nilai =>
    nilai ? String(nilai).split(' ').pop() : '-';

const jenis = item =>
    item?.jenis_antrean === 'PRIORITAS'
        ? 'Prioritas'
        : 'Umum';

const layanan = item =>
    item?.nama_layanan || 'Menunggu pelayanan';


/*
|--------------------------------------------------------------------------
| REQUEST API
|--------------------------------------------------------------------------
*/

async function getJSON(url) {
    const response = await fetch(url, {
        credentials: 'same-origin',
        cache: 'no-store',
        headers: {
            Accept: 'application/json'
        }
    });

    let hasil;

    try {
        hasil = await response.json();
    } catch {
        throw new Error('Respons server tidak valid.');
    }

    if (!response.ok || !hasil.status) {
        throw new Error(
            hasil.message || `HTTP ${response.status}`
        );
    }

    return hasil.data;
}


async function postJSON(url, payload) {
    const response = await fetch(url, {
        method: 'POST',
        credentials: 'same-origin',
        headers: {
            'Content-Type': 'application/json',
            Accept: 'application/json',
            [CSRF_HEADER]: csrfToken
        },
        body: JSON.stringify(payload)
    });

    let hasil;

    try {
        hasil = await response.json();
    } catch {
        throw new Error('Respons server tidak valid.');
    }

    if (hasil.csrfHash) {
        csrfToken = hasil.csrfHash;
    }

    if (!response.ok || !hasil.status) {
        throw new Error(
            hasil.message || `HTTP ${response.status}`
        );
    }

    return hasil.data;
}


/*
|--------------------------------------------------------------------------
| STATUS AUDIO DAN DISPLAY
|--------------------------------------------------------------------------
*/

async function muatStatusAudio() {
    if (statusAudioRequest) {
        return statusAudioRequest;
    }

    statusAudioRequest = (async () => {
        try {
            const data = await getJSON(API.statusAudio);

            statusAudioLoaded = true;
            pesanStatusAudioError = '';

            semuaDisplaySiap = nilaiBoolean(
                data.semua_display_siap
            );

            statusPanggilanServer = String(
                data.status_panggilan || 'UNKNOWN'
            ).toUpperCase();

            pesanKesiapanServer = String(
                data.pesan_kesiapan || ''
            );

            pesanPanggilanServer = String(
                data.pesan_panggilan || ''
            );

            daftarStatusDisplay = Array.isArray(data.displays)
                ? data.displays
                : [];

            if (statusPanggilanServer === 'PLAYING') {
                audioGuard = true;
                audioPernahPlaying = true;
            }

            if (
                statusPanggilanServer === 'IDLE' &&
                audioGuard &&
                audioPernahPlaying &&
                !sibuk
            ) {
                audioGuard = false;
                audioPernahPlaying = false;
            }

            render();

            return data;

        } catch (error) {
            statusAudioLoaded = false;
            semuaDisplaySiap = false;

            pesanStatusAudioError =
                error.message ||
                'Tidak dapat menghubungi server untuk memeriksa Display.';

            console.error('Gagal memuat status Display:', error);

            render();

            throw error;

        } finally {
            statusAudioRequest = null;
        }
    })();

    return statusAudioRequest;
}


function pesanDisplayBelumSiap() {
    if (!statusAudioLoaded) {
        return (
            pesanStatusAudioError ||
            'Gagal memeriksa status Display. Silakan coba lagi.'
        );
    }

    if (!semuaDisplaySiap) {
        const belumSiap = daftarStatusDisplay.filter(item => {
            return !nilaiBoolean(item.ready);
        });

        if (belumSiap.length > 0) {
            const daftar = belumSiap.map(item => {
                const nama = item.nama_kelompok || 'Kelompok';

                const alasan =
                    item.alasan ||
                    item.status ||
                    'Display belum siap';

                return `${nama}: ${alasan}`;
            });

            return (
                'Panggilan belum dapat dilakukan.\n\n' +
                daftar.join('\n')
            );
        }

        return (
            pesanKesiapanServer ||
            'Pastikan seluruh Display online dan Tes Suara siap.'
        );
    }

    if (statusPanggilanServer === 'PLAYING') {
        return (
            pesanPanggilanServer ||
            'Harap tunggu, panggilan sebelumnya sedang berlangsung.'
        );
    }

    if (audioGuard) {
        return 'Status panggilan sebelumnya belum selesai. Silakan tunggu.';
    }

    return '';
}

/*
|--------------------------------------------------------------------------
| JAM
|--------------------------------------------------------------------------
*/

function updateClock() {
    const sekarang = new Date();

    el('clock').textContent =
        sekarang.toLocaleTimeString('id-ID', {
            hour12: false,
            timeZone: 'Asia/Jakarta'
        }).replace(/\./g, ':');

    el('clockDate').textContent =
        sekarang.toLocaleDateString('id-ID', {
            weekday: 'long',
            day: 'numeric',
            month: 'long',
            year: 'numeric',
            timeZone: 'Asia/Jakarta'
        });
}


/*
|--------------------------------------------------------------------------
| STATUS BADGE
|--------------------------------------------------------------------------
*/

function toggleStatusBadge() {
    el('statusBadgeText').textContent = instansiAktif
        ? 'Instansi Aktif'
        : 'Instansi Nonaktif';

    el('statusBadge').classList.toggle(
        'closed',
        !instansiAktif
    );

    render();
}

/*
|--------------------------------------------------------------------------
| STATUS INSTANSI
|--------------------------------------------------------------------------
*/

async function muatStatusInstansi() {
    try {
        const data = await getJSON(API.pengaturan);

        const statusBaru = data.status_instansi === 'Aktif';

        if (instansiAktif !== statusBaru) {
            instansiAktif = statusBaru;
            toggleStatusBadge();
        }

    } catch (error) {
        console.error(
            'Gagal memperbarui status instansi:',
            error
        );
    }
}


/*
|--------------------------------------------------------------------------
| STATUS DISPLAY
|--------------------------------------------------------------------------
*/

function renderStatusDisplay() {
    const badge = el('statusKeseluruhan');
    const pesan = el('pesanStatusDisplay');
    const daftar = el('daftarStatusDisplay');

    if (!badge || !pesan || !daftar) {
        return;
    }

    daftar.replaceChildren();

    if (!statusAudioLoaded) {
        badge.className = 'badge bg-secondary';
        badge.textContent = 'TIDAK DIKETAHUI';

        pesan.className = 'pesan-status-gagal';
        pesan.textContent =
            pesanStatusAudioError ||
            'Status Display belum berhasil diperiksa.';

        return;
    }

    if (semuaDisplaySiap) {
        badge.className = 'badge bg-success';
        badge.textContent = 'SEMUA SIAP';

        pesan.className = 'pesan-status-siap';
        pesan.textContent =
            'Semua Display online dan audio siap. Pemanggilan dapat dilakukan.';
    } else {
        badge.className = 'badge bg-danger';
        badge.textContent = 'BELUM SIAP';

        pesan.className = 'pesan-status-gagal';
        pesan.textContent =
            pesanKesiapanServer ||
            'Pemanggilan belum dapat dilakukan. Periksa kesiapan Display.';
    }

    daftarStatusDisplay.forEach(item => {
        const baris = document.createElement('div');
        baris.className = 'status-display-item';

        const informasi = document.createElement('div');

        const nama = document.createElement('strong');
        nama.textContent = item.nama_kelompok || 'Display';

        const alasan = document.createElement('small');
        alasan.textContent =
            item.alasan ||
            (nilaiBoolean(item.ready)
                ? 'Display online dan audio siap.'
                : 'Display belum siap.');

        informasi.appendChild(nama);
        informasi.appendChild(alasan);

        const status = document.createElement('span');
        status.className = nilaiBoolean(item.ready)
            ? 'badge bg-success'
            : 'badge bg-danger';

        status.textContent = item.status || (
            nilaiBoolean(item.ready) ? 'SIAP' : 'BELUM SIAP'
        );

        baris.appendChild(informasi);
        baris.appendChild(status);

        daftar.appendChild(baris);
    });

    if (
        statusPanggilanServer === 'PLAYING' ||
        audioGuard
    ) {
        const peringatan = document.createElement('div');

        peringatan.className =
            'alert alert-warning py-2 mt-2 mb-0';

        peringatan.textContent =
            pesanPanggilanServer ||
            'Harap tunggu, panggilan sebelumnya sedang berlangsung.';

        daftar.appendChild(peringatan);
    }
}


/*
|--------------------------------------------------------------------------
| RENDER DASHBOARD
|--------------------------------------------------------------------------
*/

function render() {
    el('ticketNumber').textContent = nomor(aktif);

    el('ticketCategory').textContent = aktif
        ? jenis(aktif).toUpperCase()
        : '';

    el('ticketCategory').hidden = !aktif;

    el('activeInstansi').textContent = aktif
        ? (aktif.nama_instansi || 'Instansi tidak ditemukan')
        : <?= json_encode($namaInstansi) ?>;

    el('activeLayanan').textContent = aktif
        ? layanan(aktif)
        : '-';

    el('waitingCount').textContent =
        `${menunggu.length} antrean`;

    el('countWaiting').textContent = menunggu.length;
    el('countDone').textContent = jumlahSelesai;

    const bolehPanggil = !sibuk;

    /*
     * Tombol panggilan tetap dapat diklik agar petugas
     * memperoleh notifikasi jika syarat panggilan belum terpenuhi.
     * Tombol hanya dikunci saat proses request berlangsung.
     */
    el('btnUlang').disabled = sibuk;
    el('btnSelanjutnya').disabled = sibuk;

    el('btnSelesai').disabled = (
        !aktif || sibuk
    );

    el('btnTerusan').disabled = (
        !aktif || sibuk
    );

    el('waitingList').innerHTML = menunggu.length
        ? menunggu.map(a => `
            <div class="waiting-item">
                <div class="waiting-info">
                    <div class="wait-number">
                        ${escapeHTML(nomor(a))}
                    </div>

                    <div>
                        <div class="wait-name">
                            ${escapeHTML(layanan(a))}
                        </div>

                        <div class="wait-time">
                            Terdaftar
                            ${escapeHTML(waktu(a.waktu_masuk))}
                        </div>
                    </div>
                </div>

                <span class="tag ${
                    jenis(a) === 'Prioritas'
                        ? 'tag-priority'
                        : ''
                }">
                    ${escapeHTML(jenis(a))}
                </span>
            </div>
        `).join('')
        : '<div class="empty">Tidak ada antrean menunggu.</div>';

    el('historyList').innerHTML = riwayat.length
        ? riwayat.map(a => `
            <tr>
                <td>
                    <strong>${escapeHTML(nomor(a))}</strong>
                </td>

                <td>
                    ${escapeHTML(
                        waktu(
                            a.waktu_selesai
                            || a.waktu_mulai
                            || a.waktu_masuk
                        )
                    )}
                </td>

                <td>
                    <span class="${
                        a.status_layanan === 'SELESAI'
                            ? 'done-tag'
                            : 'pending-tag'
                    }">
                        ${escapeHTML(a.status_layanan)}
                    </span>

                    ${a.status_layanan === 'PENDING'
                        ? `
                            <button
                                class="btn btn-sm btn-outline-primary ms-1"
                                type="button"
                                data-pending-id="${Number(a.riwayat_id)}"
                                ${bolehPanggil ? '' : 'disabled'}
                            >
                                Panggil
                            </button>
                        `
                        : ''
                    }
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

    renderStatusDisplay();
}


/*
|--------------------------------------------------------------------------
| MUAT DASHBOARD
|--------------------------------------------------------------------------
*/

async function muatDashboard() {
    if (dashboardChecking) {
        return;
    }

    dashboardChecking = true;

    try {
        const data = await getJSON(API.dashboard);

        aktif = data.aktif || null;
        menunggu = data.menunggu || [];
        riwayat = data.riwayat || [];

        jumlahSelesai = Number(
            data.jumlah_selesai || 0
        );

        render();

    } catch (error) {
        console.error('Dashboard:', error);

    } finally {
        dashboardChecking = false;
    }
}


/*
|--------------------------------------------------------------------------
| PILIHAN LAYANAN DAN INSTANSI
|--------------------------------------------------------------------------
*/

function isiSelect(id, data, field) {
    const select = el(id);

    select.replaceChildren(
        new Option(
            field === 'nama_layanan'
                ? 'Pilih layanan'
                : 'Pilih instansi tujuan',
            ''
        )
    );

    for (const item of data) {
        select.add(
            new Option(
                item[field],
                String(item.id)
            )
        );
    }
}


async function muatPilihan() {
    const data = await getJSON(API.pilihan);

    pilihanLayanan = data.layanan || [];
    pilihanInstansi = data.instansi || [];

    isiSelect(
        'completeService',
        pilihanLayanan,
        'nama_layanan'
    );

    isiSelect(
        'transferService',
        pilihanLayanan,
        'nama_layanan'
    );

    isiSelect(
        'transferDestination',
        pilihanInstansi,
        'nama_instansi'
    );
}


/*
|--------------------------------------------------------------------------
| AKSI UMUM NON-AUDIO
|--------------------------------------------------------------------------
*/

async function aksi(callback) {
    if (sibuk) {
        return;
    }

    sibuk = true;
    render();

    try {
        await callback();

    } catch (error) {
        console.error(error);
        alert(error.message);

    } finally {
        sibuk = false;

        await muatDashboard();

        render();
    }
}


/*
|--------------------------------------------------------------------------
| AKSI PANGGILAN AUDIO
|--------------------------------------------------------------------------
*/

async function aksiPanggilan(callback) {
    if (sibuk) {
        return;
    }

    /*
     * Pastikan instansi masih aktif.
     */
    if (!instansiAktif) {
        return tampilkanNotifikasiPanggilan(
            'Instansi sedang nonaktif.',
            'peringatan'
        );
    }

    /*
     * Periksa ulang kesiapan Display dari server.
     */
    try {
        await muatStatusAudio();

    } catch (error) {
        console.error('Status audio:', error);

        tampilkanNotifikasiPanggilan(
            error.message ||
            'Tidak dapat memeriksa kesiapan Display. Panggilan dibatalkan.'
        );

        return;
    }

    /*
     * Pastikan seluruh Display siap.
     */
    if (!semuaDisplaySiap) {
        tampilkanNotifikasiPanggilan(
            pesanDisplayBelumSiap()
        );

        return;
    }

    /*
     * Cegah panggilan baru selama panggilan sebelumnya berlangsung.
     */
    if (
        statusPanggilanServer === 'PLAYING' ||
        audioGuard
    ) {
        tampilkanNotifikasiPanggilan(
            pesanDisplayBelumSiap()
        );

        return;
    }

    /*
     * Kunci tombol sebelum mengirim request.
     */
    sibuk = true;
    audioGuard = true;
    audioPernahPlaying = false;

    render();

    let requestBerhasil = false;

    try {
        await callback();

        requestBerhasil = true;

    } catch (error) {
        console.error('Panggilan audio:', error);

        tampilkanNotifikasiPanggilan(
            error.message || 'Panggilan gagal diproses.'
        );

    } finally {
        sibuk = false;

        await muatDashboard();

        /*
         * Perbarui status panggilan dari server.
         * Jika request gagal dan status masih IDLE,
         * pengunci dapat dilepas.
         */
        try {
            await muatStatusAudio();

            if (
                !requestBerhasil &&
                statusPanggilanServer === 'IDLE' &&
                !audioPernahPlaying
            ) {
                audioGuard = false;
                audioPernahPlaying = false;
            }

        } catch (error) {
            console.error(
                'Gagal memperbarui status audio:',
                error
            );

            /*
             * Jika status tidak diketahui,
             * pengunci tetap aktif demi keamanan.
             */
        }

        render();
    }
}


/*
|--------------------------------------------------------------------------
| PANGGIL ANTREAN BERIKUTNYA
|--------------------------------------------------------------------------
*/

async function selanjutnya() {
    if (!instansiAktif) {
        return tampilkanNotifikasiPanggilan(
            'Instansi sedang nonaktif.',
            'peringatan'
        );
    }

    if (aktif) {
        return tampilkanNotifikasiPanggilan(
            'Selesaikan antrean aktif terlebih dahulu.',
            'peringatan'
        );
    }

    if (!menunggu.length) {
        return tampilkanNotifikasiPanggilan(
            'Tidak ada antrean berikutnya.',
            'peringatan'
        );
    }

    await aksiPanggilan(async () => {
        await postJSON(API.panggil, {
            instansi_id: INSTANSI_ID
        });
    });
}


/*
|--------------------------------------------------------------------------
| PANGGIL ULANG
|--------------------------------------------------------------------------
*/

async function panggilUlang() {
    if (!aktif) {
        return tampilkanNotifikasiPanggilan(
            'Belum ada antrean aktif.',
            'peringatan'
        );
    }

    await aksiPanggilan(async () => {
        await postJSON(API.ulang, {
            riwayat_layanan_id: Number(aktif.riwayat_id)
        });
    });
}


/*
|--------------------------------------------------------------------------
| KONFIRMASI STATUS PELAYANAN
|--------------------------------------------------------------------------
*/

function ubahStatusKonfirmasi() {
    const selesai = (
        el('completeStatus').value === 'SELESAI'
    );

    el('completeServiceWrap').hidden = !selesai;
    el('completeService').required = selesai;
}


function bukaKonfirmasi() {
    if (!aktif) {
        return alert('Belum ada antrean aktif.');
    }

    el('completeNumber').value = nomor(aktif);
    el('completeStatus').value = 'SELESAI';
    el('completeService').value = '';
    el('completeNote').value = '';

    ubahStatusKonfirmasi();

    modal('completeModal').show();
}


async function simpanKonfirmasi(event) {
    event.preventDefault();

    if (!aktif) {
        return;
    }

    const status = el('completeStatus').value;
    const keterangan = el('completeNote').value.trim();

    if (!keterangan) {
        alert('Keterangan wajib diisi.');
        el('completeNote').focus();
        return;
    }

    const payload = {
        riwayat_layanan_id: Number(aktif.riwayat_id),
        status: status,
        keterangan: keterangan
    };

    if (status === 'SELESAI') {
        if (!el('completeService').value) {
            return alert('Pilih detail layanan.');
        }

        payload.layanan_id = Number(
            el('completeService').value
        );
    }

    await aksi(async () => {
        await postJSON(API.status, payload);

        modal('completeModal').hide();
    });
}


/*
|--------------------------------------------------------------------------
| PANGGIL ANTREAN PENDING
|--------------------------------------------------------------------------
*/

async function panggilPending(id) {
    if (aktif) {
        return alert(
            'Selesaikan antrean aktif terlebih dahulu.'
        );
    }

    if (!confirm('Panggil kembali antrean pending ini?')) {
        return;
    }

    await aksiPanggilan(async () => {
        await postJSON(API.pending, {
            riwayat_layanan_id: id
        });
    });
}


/*
|--------------------------------------------------------------------------
| TERUSAN ANTREAN
|--------------------------------------------------------------------------
*/

function bukaTerusan() {
    if (!aktif) {
        return alert('Belum ada antrean aktif.');
    }

    el('transferNumberDisplay').textContent = nomor(aktif);
    el('transferService').value = '';
    el('transferDestination').value = '';
    el('transferNote').value = '';

    modal('transferModal').show();
}


async function simpanTerusan(event) {
    event.preventDefault();

    if (!aktif) {
        return;
    }

    const layananId = Number(
        el('transferService').value
    );

    const tujuanId = Number(
        el('transferDestination').value
    );

    const keterangan = el('transferNote').value.trim();

    if (!layananId || !tujuanId || !keterangan) {
        alert('Semua kolom terusan wajib diisi.');
        return;
    }

    await aksi(async () => {
        await postJSON(API.terusan, {
            riwayat_layanan_id: Number(aktif.riwayat_id),
            layanan_id: layananId,
            instansi_tujuan_id: tujuanId,
            keterangan: keterangan
        });

        modal('transferModal').hide();
    });
}

/*
|--------------------------------------------------------------------------
| PENGATURAN INSTANSI
|--------------------------------------------------------------------------
*/

async function isiPengaturan() {
    try {
        const data = await getJSON(API.pengaturan);

        el('quotaService').value = data.kuota_layanan;
        el('quotaBooking').value = data.kuota_booking;
        el('settingStatus').value = data.status_instansi;

        instansiAktif = data.status_instansi === 'Aktif';

        toggleStatusBadge();

    } catch (error) {
        console.error(error);
        alert(error.message);
    }
}


async function simpanPengaturan(event) {
    event.preventDefault();

    const layananKuota = Number(
        el('quotaService').value
    );

    const bookingKuota = Number(
        el('quotaBooking').value
    );

    if (
        !Number.isInteger(layananKuota)
        || layananKuota < 1
        || !Number.isInteger(bookingKuota)
        || bookingKuota < 0
        || bookingKuota > layananKuota
    ) {
        return alert(
            'Kuota layanan dan booking tidak valid.'
        );
    }

    await aksi(async () => {
        const data = await postJSON(API.pengaturan, {
            kuota_layanan: layananKuota,
            kuota_booking: bookingKuota,
            status_instansi: el('settingStatus').value
        });

        instansiAktif = data.status_instansi === 'Aktif';

        toggleStatusBadge();

        modal('settingModal').hide();
    });
}


/*
|--------------------------------------------------------------------------
| EVENT RIWAYAT PENDING
|--------------------------------------------------------------------------
*/

el('historyList').addEventListener('click', event => {
    const tombol = event.target.closest('[data-pending-id]');

    if (tombol) {
        panggilPending(
            Number(tombol.dataset.pendingId)
        );
    }
});


/*
|--------------------------------------------------------------------------
| INISIALISASI
|--------------------------------------------------------------------------
*/

updateClock();

setInterval(updateClock, 1000);

render();

muatDashboard();
muatStatusInstansi();

muatPilihan().catch(error => {
    console.error(error);

    alert(
        'Gagal memuat pilihan layanan: ' + error.message
    );
});

isiPengaturan();


/*
|--------------------------------------------------------------------------
| POLLING DASHBOARD
|--------------------------------------------------------------------------
*/

setInterval(() => {
    if (!sibuk) {
        muatDashboard();
    }
}, 5000);

/*
|--------------------------------------------------------------------------
| POLLING STATUS INSTANSI
|--------------------------------------------------------------------------
*/

setInterval(() => {
    if (!sibuk) {
        muatStatusInstansi();
    }
}, 5000);

/*
|--------------------------------------------------------------------------
| POLLING STATUS AUDIO
|--------------------------------------------------------------------------
*/

async function pollingStatusAudio() {
    try {
        await muatStatusAudio();

    } catch (error) {
        console.error(
            'Polling status audio:',
            error
        );
    }
}

/*
 * Periksa langsung ketika halaman dibuka.
 */
pollingStatusAudio();

/*
 * Periksa status Display setiap 1 detik.
 */
setInterval(() => {
    if (!sibuk) {
        pollingStatusAudio();
    }
}, 1000);

</script>

<div id="popupNotifikasiPanggilan"
     class="popup-panggilan-backdrop"
     role="alertdialog"
     aria-modal="true"
     aria-labelledby="judulPopupPanggilan"
     aria-describedby="isiNotifikasiPanggilan"
     aria-hidden="true">

    <div class="popup-panggilan">
        <div class="popup-panggilan-header">
            <div class="popup-panggilan-title" id="judulPopupPanggilan">
                <i class="bi bi-info-circle"></i>
                <span>Informasi!</span>
            </div>

            <button type="button"
                    id="tutupNotifikasiPanggilan"
                    class="popup-panggilan-close"
                    onclick="tutupNotifikasiPanggilan()"
                    aria-label="Tutup popup">
                &times;
            </button>
        </div>

        <div class="popup-panggilan-body">
            <div class="popup-panggilan-icon" aria-hidden="true">!</div>
            <p class="popup-panggilan-pesan"
               id="isiNotifikasiPanggilan">Notifikasi</p>
        </div>
    </div>
</div>
</div>

</body>
</html>