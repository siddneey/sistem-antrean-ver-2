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
        body { margin: 0; min-height: 100vh; background: var(--bg); color: #253247; font: 13px Arial, sans-serif; }
        button, input, select, textarea { font: inherit; }
        .topbar { min-height: 64px; padding: 10px 24px; background: var(--navy); color: #fff; display: flex; align-items: center; justify-content: space-between; gap: 12px; }
        .brand { display: flex; align-items: center; gap: 12px; min-width: 0; }
        .brand-logo { height: 42px; max-width: 110px; object-fit: contain; }
        .brand-title { font-size: 16px; font-weight: 700; }
        .brand-title span { color: var(--yellow); }
        .brand-subtitle { font-size: 11px; color: #cbd5e1; margin-top: 3px; }
        .top-actions { display: flex; align-items: center; gap: 12px; }
        .clock-box { background: var(--navy-light); border: 1px solid #38516f; border-radius: 9px; padding: 7px 12px; text-align: center; }
        .clock { font-size: 17px; font-weight: 700; font-variant-numeric: tabular-nums; }
        .clock-date { font-size: 10px; color: #cbd5e1; }
        .menu-button { color: #fff; background: var(--navy-light); border: 1px solid #52647a; }
        .menu-button:hover { color: #fff; background: #294564; }
        .page { padding: 18px 22px; max-width: 1700px; margin: auto; }
        .page-heading { display: flex; justify-content: space-between; align-items: center; gap: 10px; margin-bottom: 14px; }
        .page-heading h1 { font-size: 21px; font-weight: 700; color: var(--navy); margin: 0 0 5px; }
        .page-heading p { color: var(--muted); margin: 0; font-size: 12px; }
        .status-label { display: inline-flex; align-items: center; gap: 7px; background: #e4f6eb; color: #197044; padding: 8px 12px; border-radius: 20px; font-size: 11px; font-weight: 700; white-space: nowrap; }
        .status-dot { width: 7px; height: 7px; background: #229954; border-radius: 50%; }
        .status-label.closed { background: #feeceb; color: #b42318; }
        .status-label.closed .status-dot { background: #d92d20; }
        .dashboard { display: grid; grid-template-columns: minmax(0, 1.4fr) minmax(300px, 1fr); gap: 14px; }
        .column { display: flex; flex-direction: column; gap: 14px; min-width: 0; }
        .panel, .stat { background: #fff; border: 1px solid var(--border); border-radius: 9px; overflow: hidden; }
        .panel-heading { display: flex; justify-content: space-between; align-items: center; gap: 10px; padding: 13px 15px; border-bottom: 1px solid var(--border); color: var(--navy); font-weight: 700; }
        .panel-content { padding: 14px; }
        .ticket { display: grid; grid-template-columns: .85fr 1.15fr; align-items: center; gap: 16px; padding: 16px; background: #fffaf0; border: 1px solid #efdfa9; border-radius: 8px; }
        .ticket-label { color: #7d6b3c; font-size: 11px; letter-spacing: .5px; }
        .ticket-number { margin: 8px 0; color: var(--navy); font-size: clamp(40px, 4.5vw, 58px); font-weight: 800; line-height: 1.1; }
        .ticket-category { background: var(--yellow); color: var(--navy); border-radius: 5px; padding: 5px 9px; font-size: 11px; font-weight: 700; }
        .ticket-detail { padding-left: 17px; border-left: 1px solid #e7dba9; }
        .detail-label { color: var(--muted); font-size: 11px; margin-bottom: 4px; }
        .detail-value { color: var(--navy); font-weight: 700; overflow-wrap: anywhere; }
        .detail-row { margin-bottom: 10px; }
        .main-buttons { display: grid; grid-template-columns: 1fr 1fr 1.25fr; gap: 8px; margin-top: 12px; }
        .main-btn { min-height: 39px; font-size: 12px; font-weight: 700; }
        .btn-yellow { background: var(--yellow); border-color: var(--yellow); color: var(--navy); }
        .btn-yellow:hover { background: #e8b92f; border-color: #e8b92f; color: var(--navy); }
        .btn-navy { background: var(--navy); border-color: var(--navy); color: #fff; }
        .btn-navy:hover { background: var(--navy-light); border-color: var(--navy-light); color: #fff; }
        .btn-teal { background: var(--teal); border-color: var(--teal); color: #fff; }
        .btn-teal:hover { background: #0b666e; border-color: #0b666e; color: #fff; }
        .btn-transfer { width: 100%; margin-top: 9px; padding: 10px; border: 1px solid #d6deea; border-radius: 7px; background: #fff; color: var(--navy); font-weight: 700; }
        .btn-transfer:hover { background: #fff8dc; border-color: var(--yellow); }
        .waiting-list { padding: 0 15px; max-height: 420px; overflow-y: auto; }
        .waiting-item { display: flex; justify-content: space-between; align-items: center; gap: 8px; padding: 12px 0; border-bottom: 1px solid #edf0f4; }
        .waiting-item:last-child { border: 0; }
        .waiting-info { display: flex; align-items: center; gap: 10px; min-width: 0; }
        .wait-number { min-width: 58px; padding: 8px 5px; text-align: center; background: #edf2f8; border-radius: 6px; color: var(--navy); font-weight: 700; }
        .wait-name { font-size: 12px; font-weight: 700; }
        .wait-time { color: var(--muted); font-size: 11px; margin-top: 3px; }
        .tag { display: inline-block; padding: 5px 8px; border-radius: 12px; background: #fff3c4; color: #805d00; font-size: 10px; white-space: nowrap; }
        .tag-priority { background: #eee5ff; color: #6941c6; }
        .stats { display: grid; grid-template-columns: 1fr 1fr; gap: 10px; }
        .stat { padding: 13px; }
        .stat-label { color: var(--muted); font-size: 11px; }
        .stat-number { margin-top: 4px; color: var(--navy); font-size: 26px; font-weight: 700; }
        .history-wrap { max-height: 420px; overflow: auto; }
        .history-table { width: 100%; border-collapse: collapse; font-size: 11px; }
        .history-table th { background: #f8fafc; color: var(--muted); font-weight: 600; text-align: left; padding: 10px 13px; }
        .history-table td { border-top: 1px solid #edf0f4; padding: 10px 13px; }
        .done-tag, .pending-tag { padding: 4px 8px; border-radius: 12px; font-size: 10px; }
        .done-tag { background: #e4f6eb; color: #197044; }
        .pending-tag { background: #fff3c4; color: #805d00; }
        .empty { text-align: center; color: var(--muted); padding: 18px 5px; }
        .modal-header { background: var(--navy); color: #fff; }
        .modal-header .btn-close { filter: invert(1); }
        .modal-title { font-size: 16px; font-weight: 700; }
        .form-label { font-size: 12px; font-weight: 700; }
        .form-control, .form-select { font-size: 13px; }
        .form-text { font-size: 11px; }
        .required { color: #d92d20; }
        .transfer-number-box { background: #fff9e8; border: 1px solid #f0dfaa; border-radius: 8px; padding: 12px; margin-bottom: 16px; }
        .transfer-number { font-size: 23px; font-weight: 700; color: var(--navy); }
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
    </style>
</head>
<body>
<header class="topbar">
    <div class="brand">
        <img src="<?= base_url('assets/images/logokota.png') ?>" class="brand-logo" alt="Logo Kota Tangerang">
        <div>
            <div class="brand-title">Sistem Antrean Petugas - <span>(<?= esc($namaAkun) ?>)</span></div>
            <div class="brand-subtitle">Monitoring layanan MPP Kota Tangerang</div>
        </div>
    </div>
    <div class="top-actions">
        <div class="clock-box">
            <div class="clock" id="clock">--:--:--</div>
            <div class="clock-date" id="clockDate">-</div>
        </div>
        <div class="dropdown">
            <button class="btn menu-button dropdown-toggle" data-bs-toggle="dropdown" type="button">
                <i class="bi bi-list me-1"></i>Menu
            </button>
            <ul class="dropdown-menu dropdown-menu-end">
                <li><button class="dropdown-item" type="button" data-bs-toggle="modal" data-bs-target="#settingModal" onclick="isiPengaturan()"><i class="bi bi-sliders me-2"></i>Pengaturan Loket</button></li>
                <li><hr class="dropdown-divider"></li>
                <li>
                    <form action="<?= site_url('logout') ?>" method="post" onsubmit="return confirm('Yakin ingin keluar?')">
                        <?= csrf_field() ?>
                        <button class="dropdown-item text-danger" type="submit"><i class="bi bi-box-arrow-right me-2"></i>Keluar</button>
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
        <span class="status-label" id="statusBadge"><span class="status-dot"></span><span id="statusBadgeText">Loket Buka</span></span>
    </div>

    <section class="dashboard">
        <div class="column">
            <section class="panel">
                <div class="panel-heading">
                    <span><i class="bi bi-megaphone me-2"></i>Antrean Sedang Dilayani</span>
                    <span class="text-secondary fw-normal" style="font-size:11px">Petugas aktif</span>
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
                                <div class="detail-value" id="activeInstansi"><?= esc($namaInstansi) ?></div>
                            </div>
                            <div class="detail-row">
                                <div class="detail-label">Detail Layanan</div>
                                <div class="detail-value" id="activeLayanan">-</div>
                            </div>
                        </div>
                    </div>
                    <div class="main-buttons">
                        <button class="btn main-btn btn-teal" type="button" id="btnUlang" onclick="panggilUlang()"><i class="bi bi-arrow-repeat me-1"></i>Panggil Ulang</button>
                        <button class="btn main-btn btn-yellow" type="button" id="btnSelanjutnya" onclick="selanjutnya()"><i class="bi bi-arrow-right-circle me-1"></i>Selanjutnya</button>
                        <button class="btn main-btn btn-navy" type="button" id="btnSelesai" onclick="bukaKonfirmasi()"><i class="bi bi-check-circle me-1"></i>Konfirmasi Selesai</button>
                    </div>
                    <button class="btn-transfer" type="button" id="btnTerusan" onclick="bukaTerusan()"><i class="bi bi-arrow-left-right me-2"></i>Buat Terusan Antrean</button>
                </div>
            </section>
            <section class="panel">
                <div class="panel-heading">
                    <span><i class="bi bi-hourglass-split me-2"></i>Antrean Berikutnya</span>
                    <span class="text-secondary fw-normal" id="waitingCount">0 antrean</span>
                </div>
                <div class="waiting-list" id="waitingList"><div class="empty">Memuat antrean...</div></div>
            </section>
        </div>

        <div class="column">
            <div class="stats">
                <div class="stat"><div class="stat-label"><i class="bi bi-people me-1"></i>Antrean Menunggu</div><div class="stat-number" id="countWaiting">0</div></div>
                <div class="stat"><div class="stat-label"><i class="bi bi-check-circle me-1"></i>Sudah Selesai</div><div class="stat-number" id="countDone">0</div></div>
            </div>
            <section class="panel">
                <div class="panel-heading"><span><i class="bi bi-clock-history me-2"></i>Riwayat Pelayanan</span><span class="text-secondary fw-normal" style="font-size:11px">Hari ini</span></div>
                <div class="history-wrap">
                    <table class="history-table">
                        <thead><tr><th>Nomor</th><th>Waktu</th><th>Status / Aksi</th></tr></thead>
                        <tbody id="historyList"><tr><td colspan="3" class="empty">Memuat riwayat...</td></tr></tbody>
                    </table>
                </div>
            </section>
        </div>
    </section>
</main>

<div class="modal fade" id="completeModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <form class="modal-content" onsubmit="simpanKonfirmasi(event)">
            <div class="modal-header"><h5 class="modal-title">Konfirmasi Pelayanan Selesai</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
            <div class="modal-body">
                <div class="mb-3"><label class="form-label">Nomor Antrean</label><input id="completeNumber" class="form-control" readonly></div>
                <div class="mb-3"><label class="form-label" for="completeStatus">Status <span class="required">*</span></label><select class="form-select" id="completeStatus" onchange="ubahStatusKonfirmasi()"><option value="SELESAI">Selesai</option><option value="PENDING">Pending</option></select></div>
                <div class="mb-3" id="completeServiceWrap"><label class="form-label" for="completeService">Detail Pelayanan <span class="required">*</span></label><select class="form-select" id="completeService"><option value="">Pilih layanan</option></select></div>
                <div><label class="form-label" for="completeNote">Keterangan <span class="required">*</span></label><textarea id="completeNote" class="form-control" rows="3" required></textarea></div>
            </div>
            <div class="modal-footer"><button class="btn btn-light border" type="button" data-bs-dismiss="modal">Batal</button><button class="btn btn-yellow" type="submit">Simpan Konfirmasi</button></div>
        </form>
    </div>
</div>

<div class="modal fade" id="transferModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <form class="modal-content" onsubmit="simpanTerusan(event)">
            <div class="modal-header"><h5 class="modal-title">Buat Terusan Antrean</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
            <div class="modal-body">
                <p class="text-secondary">Pelayanan asal diselesaikan, kemudian nomor antrean yang sama masuk ke daftar menunggu instansi tujuan.</p>
                <div class="transfer-number-box"><div class="detail-label">NOMOR ANTREAN</div><div class="transfer-number" id="transferNumberDisplay">-</div></div>
                <div class="mb-3"><label class="form-label" for="transferService">Detail Pelayanan <span class="required">*</span></label><select class="form-select" id="transferService" required><option value="">Pilih layanan</option></select></div>
                <div class="mb-3"><label class="form-label" for="transferNote">Keterangan Layanan <span class="required">*</span></label><textarea class="form-control" id="transferNote" required></textarea></div>
                <div><label class="form-label" for="transferDestination">Diteruskan ke <span class="required">*</span></label><select class="form-select" id="transferDestination" required><option value="">Pilih instansi tujuan</option></select></div>
            </div>
            <div class="modal-footer"><button class="btn btn-light border" type="button" data-bs-dismiss="modal">Batal</button><button class="btn btn-yellow" type="submit">Simpan Terusan</button></div>
        </form>
    </div>
</div>

<div class="modal fade" id="settingModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <form class="modal-content" onsubmit="simpanPengaturan(event)">
            <div class="modal-header"><h5 class="modal-title">Pengaturan Loket</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
            <div class="modal-body">
                <div class="mb-3"><label class="form-label" for="quotaService">Kuota Layanan per Hari</label><input type="number" class="form-control" id="quotaService" min="1" required></div>
                <div class="mb-3"><label class="form-label" for="quotaBooking">Kuota Booking</label><input type="number" class="form-control" id="quotaBooking" min="0" required></div>
                <div><label class="form-label" for="settingStatus">Status Loket</label><select class="form-select" id="settingStatus"><option value="BUKA">Buka</option><option value="TUTUP">Tutup</option></select></div>
            </div>
            <div class="modal-footer"><button class="btn btn-light border" type="button" data-bs-dismiss="modal">Batal</button><button class="btn btn-yellow" type="submit">Simpan Pengaturan</button></div>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    'use strict';

    const API = {
        dashboard: <?= json_encode(site_url('petugas/dashboard/data')) ?>,
        pilihan: <?= json_encode(site_url('petugas/pilihan')) ?>,
        panggil: <?= json_encode(site_url('petugas/antrean/panggil')) ?>,
        ulang: <?= json_encode(site_url('petugas/antrean/panggil-ulang')) ?>,
        status: <?= json_encode(site_url('petugas/antrean/status')) ?>,
        pending: <?= json_encode(site_url('petugas/antrean/panggil-pending')) ?>,
        terusan: <?= json_encode(site_url('petugas/antrean/terusan')) ?>,
        pengaturan: <?= json_encode(site_url('petugas/pengaturan-loket')) ?>,

        // Status kesiapan seluruh Display dan audio Kelompok petugas.
        statusAudio: <?= json_encode(site_url('petugas/antrean/status-audio')) ?>
    };

    const INSTANSI_ID = <?= json_encode($instansiId) ?>;
    const CSRF_HEADER = <?= json_encode(csrf_header()) ?>;

    let csrfToken = <?= json_encode(csrf_hash()) ?>;

    let aktif = null;
    let menunggu = [];
    let riwayat = [];
    let jumlahSelesai = 0;
    let loketAktif = true;
    let sibuk = false;
    let pilihanLayanan = [];
    let pilihanInstansi = [];

    /*
    |--------------------------------------------------------------------------
    | STATUS AUDIO GLOBAL
    |--------------------------------------------------------------------------
    */

    let statusAudioLoaded = false;
    let semuaDisplaySiap = false;
    let statusPanggilanServer = 'UNKNOWN';

    // Pengunci lokal agar tombol tidak bisa diklik berulang.
    // Pengunci utama tetap berada di database melalui PelayananService.
    let audioGuard = false;

    let daftarStatusDisplay = [];

    const el = id => document.getElementById(id);
    const modal = id => bootstrap.Modal.getOrCreateInstance(el(id));

    const escapeHTML = nilai => String(nilai ?? '')
        .replace(/&/g, '&amp;')
        .replace(/</g, '&lt;')
        .replace(/>/g, '&gt;')
        .replace(/"/g, '&quot;')
        .replace(/'/g, '&#039;');

    const nomor = item => item && item.nomor_antrean != null
        ? String(Number(item.nomor_antrean))
        : '-';

    const waktu = nilai => nilai
        ? String(nilai).split(' ').pop()
        : '-';

    const jenis = item => item?.jenis_antrean === 'PRIORITAS'
        ? 'Prioritas'
        : 'Umum';

    const layanan = item => item?.nama_layanan || 'Menunggu pelayanan';


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

        const hasil = await response.json();

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

        const hasil = await response.json();

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
    | CEK STATUS SELURUH DISPLAY
    |--------------------------------------------------------------------------
    */

    async function muatStatusAudio() {
        try {
            const data = await getJSON(API.statusAudio);

            statusAudioLoaded = true;

            semuaDisplaySiap = (
                data.semua_display_siap === true
            );

            statusPanggilanServer = String(
                data.status_panggilan || 'UNKNOWN'
            ).toUpperCase();

            daftarStatusDisplay = Array.isArray(data.displays)
                ? data.displays
                : [];

            /*
             * Jika ada Display yang sedang memutar audio,
             * pengunci lokal harus tetap aktif.
             */
            if (statusPanggilanServer === 'PLAYING') {
                audioGuard = true;
            }

            /*
             * Pengunci lokal baru boleh dilepas apabila:
             * 1. Backend berhasil memberikan status.
             * 2. Status Kelompok petugas sudah IDLE.
             * 3. Tidak ada permintaan audio yang sedang diproses.
             *
             * Jika status tidak diketahui, pengunci tidak dilepas.
             */
            if (
                statusPanggilanServer === 'IDLE'
                && audioGuard
                && !sibuk
            ) {
                audioGuard = false;
            }

            render();

            return data;

        } catch (error) {
            /*
             * Jika status gagal dibaca, anggap belum siap.
             * Jangan melepas audioGuard karena status audio
             * sebenarnya belum diketahui.
             */
            statusAudioLoaded = false;
            semuaDisplaySiap = false;

            render();

            throw error;
        }
    }


    function pesanDisplayBelumSiap() {
        if (!statusAudioLoaded) {
            return 'Gagal memeriksa status Display. Silakan coba lagi.';
        }

        if (!semuaDisplaySiap) {
            const belumSiap = daftarStatusDisplay.filter(item => {
                return item.ready !== true;
            });

            if (belumSiap.length > 0) {
                const daftar = belumSiap.map(item => {
                    const nama = item.nama_kelompok || 'Kelompok';
                    const status = item.status || 'BELUM_SIAP';

                    return `${nama}: ${status}`;
                });

                return (
                    'Panggilan belum dapat dilakukan. ' +
                    'Pastikan seluruh Display online dan Tes Suara siap.\n\n' +
                    daftar.join('\n')
                );
            }

            return (
                'Panggilan belum dapat dilakukan. ' +
                'Pastikan seluruh Display online dan Tes Suara siap.'
            );
        }

        if (statusPanggilanServer === 'PLAYING') {
            return (
                'Harap tunggu, panggilan sebelumnya sedang berlangsung.'
            );
        }

        if (audioGuard) {
            return (
                'Harap tunggu, status panggilan sebelumnya belum selesai.'
            );
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

        el('clock').textContent = sekarang.toLocaleTimeString('id-ID', {
            hour12: false,
            timeZone: 'Asia/Jakarta'
        }).replace(/\./g, ':');

        el('clockDate').textContent = sekarang.toLocaleDateString('id-ID', {
            weekday: 'long',
            day: 'numeric',
            month: 'long',
            year: 'numeric',
            timeZone: 'Asia/Jakarta'
        });
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

        el('activeLayanan').textContent = aktif
            ? layanan(aktif)
            : '-';

        el('waitingCount').textContent =
            `${menunggu.length} antrean`;

        el('countWaiting').textContent = menunggu.length;
        el('countDone').textContent = jumlahSelesai;

        /*
         * Tombol audio hanya aktif jika:
         * - Status Display sudah berhasil diperiksa.
         * - Seluruh Display siap.
         * - Tidak ada panggilan yang sedang berlangsung.
         * - Tidak ada aksi lain yang sedang diproses.
         */
        const bolehPanggil = (
            statusAudioLoaded
            && semuaDisplaySiap
            && !audioGuard
            && !sibuk
        );

        el('btnUlang').disabled = !aktif || !bolehPanggil;

        el('btnSelanjutnya').disabled = (
            !!aktif
            || !menunggu.length
            || !loketAktif
            || !bolehPanggil
        );

        el('btnSelesai').disabled = !aktif;
        el('btnTerusan').disabled = !aktif;

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
                                Terdaftar ${escapeHTML(waktu(a.waktu_masuk))}
                            </div>
                        </div>
                    </div>

                    <span class="tag ${
                        jenis(a) === 'Prioritas' ? 'tag-priority' : ''
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
    }


    /*
    |--------------------------------------------------------------------------
    | MUAT DATA DASHBOARD
    |--------------------------------------------------------------------------
    */

    async function muatDashboard() {
        try {
            const data = await getJSON(API.dashboard);

            aktif = data.aktif || null;
            menunggu = data.menunggu || [];
            riwayat = data.riwayat || [];
            jumlahSelesai = Number(data.jumlah_selesai || 0);

            render();

        } catch (error) {
            console.error('Dashboard:', error);
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
                'Pilih ' + (
                    field === 'nama_layanan'
                        ? 'layanan'
                        : 'instansi tujuan'
                ),
                ''
            )
        );

        for (const item of data) {
            select.add(
                new Option(item[field], String(item.id))
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
        if (sibuk) return;

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
    |
    | Digunakan oleh:
    | - Panggil antrean berikutnya.
    | - Panggil ulang.
    | - Panggil antrean pending.
    |
    */

    async function aksiPanggilan(callback) {
        if (sibuk) return;

        /*
         * Periksa ulang kondisi Display sebelum mengirim
         * permintaan panggilan ke backend.
         */
        try {
            await muatStatusAudio();

        } catch (error) {
            console.error('Status audio:', error);

            alert(
                'Tidak dapat memeriksa kesiapan Display. ' +
                'Panggilan dibatalkan.'
            );

            return;
        }

        /*
         * Pastikan semua Display siap.
         */
        if (!semuaDisplaySiap) {
            alert(pesanDisplayBelumSiap());
            return;
        }

        /*
         * Jangan kirim permintaan jika Kelompok masih PLAYING.
         */
        if (
            statusPanggilanServer === 'PLAYING'
            || audioGuard
        ) {
            alert(
                'Harap tunggu, panggilan sebelumnya sedang berlangsung.'
            );

            return;
        }

        /*
         * Kunci tombol di browser sebelum request dikirim.
         * Penguncian utama tetap dilakukan oleh backend/database.
         */
        sibuk = true;
        audioGuard = true;

        render();

        try {
            await callback();

        } catch (error) {
            console.error('Panggilan audio:', error);
            alert(error.message);

        } finally {
            sibuk = false;

            /*
             * Jangan langsung melepas audioGuard.
             * Periksa status backend terlebih dahulu.
             */
            await muatDashboard();

            try {
                await muatStatusAudio();
            } catch (error) {
                console.error(
                    'Gagal memperbarui status audio:',
                    error
                );

                /*
                 * Status tidak diketahui.
                 * audioGuard tetap aktif sampai status
                 * backend berhasil dibaca kembali.
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
        if (!loketAktif) {
            return alert('Loket sedang ditutup.');
        }

        if (aktif) {
            return alert(
                'Selesaikan antrean aktif terlebih dahulu.'
            );
        }

        if (!menunggu.length) {
            return alert('Tidak ada antrean berikutnya.');
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
            return alert('Belum ada antrean aktif.');
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

        if (!aktif) return;

        const status = el('completeStatus').value;
        const keterangan = el('completeNote').value.trim();

        // Keterangan wajib diisi.
        if (!keterangan) {
            alert('Keterangan wajib diisi.');
            el('completeNote').focus();
            return;
        }

        const payload = {
            riwayat_layanan_id: Number(aktif.riwayat_id),
            status,
            keterangan
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

        if (!aktif) return;

        await aksi(async () => {
            await postJSON(API.terusan, {
                riwayat_layanan_id: Number(aktif.riwayat_id),
                layanan_id: Number(el('transferService').value),
                instansi_tujuan_id: Number(
                    el('transferDestination').value
                ),
                keterangan: el('transferNote').value.trim()
            });

            modal('transferModal').hide();
        });
    }


    /*
    |--------------------------------------------------------------------------
    | STATUS LOKET
    |--------------------------------------------------------------------------
    */

    function toggleStatusBadge() {
        el('statusBadgeText').textContent = loketAktif
            ? 'Loket Buka'
            : 'Loket Tutup';

        el('statusBadge').classList.toggle(
            'closed',
            !loketAktif
        );

        render();
    }


    /*
    |--------------------------------------------------------------------------
    | PENGATURAN LOKET
    |--------------------------------------------------------------------------
    */

    async function isiPengaturan() {
        try {
            const data = await getJSON(API.pengaturan);

            el('quotaService').value = data.kuota_layanan;
            el('quotaBooking').value = data.kuota_booking;
            el('settingStatus').value = data.status_loket;

            loketAktif = data.status_loket === 'BUKA';

            toggleStatusBadge();

        } catch (error) {
            console.error(error);
            alert(error.message);
        }
    }


    async function simpanPengaturan(event) {
        event.preventDefault();

        const layanan = Number(el('quotaService').value);
        const booking = Number(el('quotaBooking').value);

        if (
            !Number.isInteger(layanan)
            || layanan < 1
            || !Number.isInteger(booking)
            || booking < 0
            || booking > layanan
        ) {
            return alert(
                'Kuota layanan dan booking tidak valid.'
            );
        }

        await aksi(async () => {
            const data = await postJSON(API.pengaturan, {
                kuota_layanan: layanan,
                kuota_booking: booking,
                status_loket: el('settingStatus').value
            });

            loketAktif = data.status_loket === 'BUKA';

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
    | POLLING STATUS AUDIO
    |--------------------------------------------------------------------------
    |
    | Status Display diperiksa setiap 1 detik.
    | Jika satu Display offline atau belum siap,
    | tombol panggilan otomatis dinonaktifkan.
    |
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

    // Periksa langsung saat halaman dibuka.
    pollingStatusAudio();

    // Periksa berkala.
    setInterval(() => {
        if (!sibuk) {
            pollingStatusAudio();
        }
    }, 1000);

</script>
</body>
</html>