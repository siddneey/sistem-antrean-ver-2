
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1"
    >

    <title>SubDisplay Antrean - MPP Kota Tangerang</title>

    <style>
        :root {
            --navy: #122b52;
            --navy-dark: #0b1d39;
            --blue: #2860b7;
            --yellow: #f5c842;
            --background: #eef2f8;
            --text: #1b2c46;
            --muted: #748198;
            --border: #e0e7f0;
            --green: #159766;
        }

        * {
            box-sizing: border-box;
        }

        html,
        body {
            margin: 0;
            width: 100%;
            min-height: 100%;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
            background: var(--background);
            color: var(--text);
            overflow: hidden;
        }

        /* HEADER */

        .display-header {
            height: 86px;
            padding: 10px 25px;
            display: grid;
            grid-template-columns:
                minmax(150px, 1fr)
                minmax(280px, 2fr)
                minmax(260px, 1fr);
            align-items: center;
            gap: 15px;
            color: white;
            background: linear-gradient(
                115deg,
                #10264b 0%,
                #1c4485 58%,
                #163365 100%
            );
            border-bottom: 4px solid var(--yellow);
        }

        .header-logos {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 12px;
        }

        .header-logo {
            width: 56px;
            height: 60px;
            object-fit: contain;
        }

        .header-title {
            text-align: center;
            font-size: clamp(13px, 1.35vw, 22px);
            font-weight: 800;
            letter-spacing: 3px;
            line-height: 1.35;
        }

        .header-title span {
            display: block;
            color: var(--yellow);
        }

    .header-actions {
        display: flex;
        justify-content: flex-end;
        align-items: center;
        gap: 12px;
        }

    .display-label {
        color: #ffffff;
        font-size: 11px;
        font-weight: 600;
        white-space: nowrap;
    }

    .display-label strong {
        color: var(--yellow);
        font-weight: 700;
    }

    .display-menu {
        position: relative;
    }

    .display-menu-button {
        display: grid;
        place-items: center;
        width: 30px;
        height: 30px;
        padding: 0;
        border: 1px solid var(--yellow);
        border-radius: 4px;
        background: transparent;
        color: var(--yellow);
        font-size: 19px;
        font-weight: 800;
        line-height: 1;
        cursor: pointer;
    }

    .display-menu-button:hover {
        background: #f5c84220;
    }

    .display-menu-content {
        display: none;
        position: absolute;
        top: calc(100% + 8px);
        right: 0;
        z-index: 1000;
        min-width: 115px;
        padding: 5px;
        border: 1px solid #e0e7f0;
        border-radius: 5px;
        background: white;
        box-shadow: 0 5px 15px #00000025;
    }

    .display-menu-content.show {
        display: block;
    }

    .logout-button {
        display: block;
        padding: 8px 10px;
        border-radius: 3px;
        color: #b42318;
        text-decoration: none;
        font-size: 11px;
        font-weight: 700;
        white-space: nowrap;
    }

    .logout-button:hover {
        background: #fff1f0;
    }

        /* LAYOUT */

        .display-main {
            height: calc(100vh - 120px);
            padding: 14px;
            display: grid;
            grid-template-columns:
                minmax(265px, 29%)
                minmax(0, 1fr);
            gap: 14px;
            min-height: 0;
        }

        .left-column,
        .right-column {
            display: flex;
            flex-direction: column;
            gap: 12px;
            min-width: 0;
            min-height: 0;
        }

        /* JAM */

        .info-card {
            padding: 15px 17px 14px;
            background: var(--navy-dark);
            color: white;
            border-radius: 3px;
            box-shadow: inset 0 -4px var(--yellow);
        }

        .city-label {
            margin-bottom: 7px;
            color: #d6e0f1;
            font-size: 10px;
            font-weight: 700;
            letter-spacing: 1.3px;
            text-transform: uppercase;
        }

        .digital-clock {
            margin-bottom: 7px;
            font-size: clamp(27px, 2.3vw, 35px);
            font-weight: 600;
            letter-spacing: 1px;
            font-variant-numeric: tabular-nums;
        }

        .digital-date {
            padding-top: 7px;
            border-top: 1px solid #ffffff30;
            color: #d6e0f1;
            font-size: 11px;
        }

        /* GRUP AKTIF */

        .group-card {
            display: flex;
            align-items: center;
            justify-content: space-between;
            min-height: 54px;
            padding: 9px 12px;
            border: 1px solid var(--border);
            border-left: 3px solid var(--yellow);
            border-radius: 7px;
            background: white;
        }

        .group-caption {
            margin-bottom: 4px;
            color: var(--muted);
            font-size: 9px;
            font-weight: 700;
            letter-spacing: .5px;
        }

        .group-name {
            font-size: 12px;
            font-weight: 600;
        }

        .group-value {
            color: var(--green);
            font-size: 9px;
            font-weight: 700;
            white-space: nowrap;
        }

        /* KARTU INSTANSI */

        .agency-list {
            position: relative;
            flex: 1;
            min-height: 0;
            overflow: hidden;
            border-radius: 16px;
            mask-image: linear-gradient(
                to bottom,
                transparent,
                black 2%,
                black 98%,
                transparent
            );
        }

        .agency-track {
            display: flex;
            flex-direction: column;
            gap: 14px;
            padding: 4px 0 10px;
            will-change: transform;
            animation: agencyScroll 34s linear infinite;
        }

        .agency-list:hover .agency-track {
            animation-play-state: paused;
        }

        .agency-list.is-static .agency-track {
            animation: none;
        }

        @keyframes agencyScroll {
            from {
                transform: translateY(0);
            }

            to {
                transform: translateY(-50%);
            }
        }

        .agency-card {
            display: grid;
            grid-template-columns: 68px minmax(0, 1fr);
            align-items: center;
            gap: 15px;
            min-height: 116px;
            padding: 14px 17px;
            border: 1px solid #dfe4eb;
            border-left: 4px solid #cbd3df;
            border-radius: 9px;
            background: white;
        }

        .agency-card.has-queue {
            border-color: #b9d9ca;
            border-left-color: #198754;
            background: #f7fcf8;
        }

        .agency-logo-box {
            display: grid;
            place-items: center;
            width: 68px;
            height: 68px;
            padding: 8px;
            border: 1px solid #e7e9ed;
            border-radius: 7px;
            background: #f7f8fa;
        }

        .agency-logo-box img {
            max-width: 100%;
            max-height: 100%;
            object-fit: contain;
        }

        .agency-info {
            min-width: 0;
        }

        .agency-name {
            margin-bottom: 7px;
            color: #26364b;
            font-size: 13px;
            font-weight: 700;
            line-height: 1.35;
            overflow-wrap: anywhere;
        }

        .agency-call-label {
            margin-bottom: 3px;
            color: #6b7280;
            font-size: 11px;
        }

        .agency-number {
            color: #10233f;
            font-size: clamp(29px, 2.4vw, 38px);
            font-weight: 800;
            line-height: 1.05;
        }

        .agency-card.has-queue .agency-number {
            color: #198754;
        }

        /* PANEL ANTREAN */

        .queue-panel {
            display: flex;
            flex-direction: column;
            flex: 1;
            min-height: 0;
            overflow: hidden;
            border: 1px solid #dfe6f0;
            border-radius: 17px;
            background: white;
        }

        .queue-heading {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 12px;
            padding: 17px 19px;
            border-bottom: 1px solid var(--border);
        }

        .queue-title {
            color: var(--navy);
            font-size: 17px;
            font-weight: 800;
        }

        .queue-subtitle {
            margin-top: 4px;
            color: var(--muted);
            font-size: 11px;
            font-weight: 400;
        }

        .queue-count {
            display: flex;
            align-items: baseline;
            gap: 5px;
            padding-left: 12px;
            border-left: 2px solid var(--yellow);
            color: var(--muted);
            font-size: 11px;
            white-space: nowrap;
        }

        .queue-count strong {
            color: var(--navy);
            font-size: 18px;
        }

        /*
         * DUA TABEL COMPACT
         * 4 ANTREAN PER TABEL
         * TANPA SCROLL
         */

        .queue-columns {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 12px;
            flex: 1;
            min-height: 0;
            padding: 12px;
            background: #f7f9fd;
            align-content: start;
        }

        .queue-table-wrap {
            min-width: 0;
            height: fit-content;
            overflow: visible;
            border: 1px solid #dfe7f5;
            border-radius: 9px;
            background: white;
        }

        .queue-table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
        }

        .queue-table thead {
            background: var(--navy);
            color: white;
        }

        .queue-table th {
            padding: 10px 6px;
            font-size: 11px;
            text-align: center;
        }

        .queue-table td {
            padding: 8px 6px;
            font-size: 11px;
            line-height: 1.2;
            text-align: center;
            border-bottom: 1px solid #edf1f7;
            overflow-wrap: anywhere;
        }

        .queue-table tbody tr:nth-child(even) {
            background: #f2f6fd;
        }

        .queue-number {
            color: var(--blue);
            font-weight: 800;
        }

        /*
         * NOMOR DI ATAS
         * PRIORITAS TEPAT DI BAWAH NOMOR
         */

        .queue-number-content {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 2px;
        }

        .queue-number-value {
            display: block;
            font-size: 13px;
            font-weight: 800;
            line-height: 1.1;
        }

        .priority-label {
            display: block;
            font-size: 8px;
            font-weight: 600;
            line-height: 1;
            color: #748198;
            white-space: nowrap;
        }

        .queue-empty {
            padding: 25px 10px !important;
            color: var(--muted) !important;
        }

        /* RINGKASAN */

        .summary-panel {
            flex-shrink: 0;
            padding: 14px;
            border: 1px solid #f0dfbd;
            border-radius: 15px;
            background: #fff7e9;
        }

        .summary-header {
            margin-bottom: 10px;
        }

        .summary-title {
            color: #66491b;
            font-size: 14px;
            font-weight: 800;
        }

        .summary-grid {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 9px;
            max-height: 24vh;
            overflow: auto;
        }

        .summary-item {
            overflow: hidden;
            border: 1px solid #e7d8b7;
            border-radius: 9px;
            background: white;
            text-align: center;
        }

        .summary-agency {
            padding: 9px 4px;
            background: #f4c735;
            color: #483600;
            font-size: 10px;
            font-weight: 800;
        }

        .summary-data {
            display: grid;
            grid-template-columns: 1fr 1fr;
        }

        .summary-cell {
            padding: 8px 3px;
        }

        .summary-cell + .summary-cell {
            border-left: 1px solid #edf0f4;
        }

        .summary-cell-label {
            margin-bottom: 4px;
            color: var(--muted);
            font-size: 9px;
        }

        .summary-cell-value {
            color: var(--navy);
            font-size: 19px;
            font-weight: 800;
        }

        /* FOOTER */

        .display-footer {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 34px;
            padding: 0 15px;
            overflow: hidden;
            background: var(--yellow);
            color: #382900;
            font-size: 11px;
            font-weight: 800;
            text-align: center;
            white-space: nowrap;
        }

        /* POPUP TES SUARA */

        .audio-popup {
            position: fixed;
            top: 18px;
            left: 50%;
            transform: translateX(-50%);
            z-index: 9999;
            width: calc(100% - 32px);
            max-width: 410px;
            background: white;
            border: 1px solid #dce4ef;
            border-left: 5px solid var(--yellow);
            border-radius: 10px;
            box-shadow: 0 12px 35px #00000038;
        }

        .audio-popup.is-hidden {
            display: none;
        }

        .audio-popup-content {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 13px 15px;
        }

        .audio-popup-icon {
            font-size: 24px;
        }

        .audio-popup-text {
            flex: 1;
            min-width: 0;
        }

        .audio-popup-text strong {
            display: block;
            margin-bottom: 4px;
            color: var(--navy);
            font-size: 13px;
        }

        .audio-popup-text small {
            display: block;
            color: #64748b;
            font-size: 11px;
            line-height: 1.5;
        }

        .audio-popup-button {
            padding: 10px 13px;
            border: none;
            border-radius: 7px;
            background: var(--yellow);
            color: var(--navy-dark);
            font-size: 12px;
            font-weight: 800;
            cursor: pointer;
        }

        .audio-popup-button:disabled {
            opacity: .65;
            cursor: wait;
        }

        /* RESPONSIVE */

        @media (max-width: 1000px) {
            body {
                overflow: auto;
            }

            .display-header {
                grid-template-columns: auto 1fr auto;
                padding: 10px;
                gap: 8px;
            }

            .header-logo:nth-child(2) {
                display: none;
            }

            .display-main {
                height: auto;
                min-height: calc(100vh - 120px);
                grid-template-columns: 1fr;
            }

            .left-column {
                display: grid;
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }

            .agency-list {
                grid-column: 1 / -1;
                min-height: 300px;
                max-height: 430px;
            }

            .queue-panel {
                min-height: 320px;
            }

            .display-footer {
                height: auto;
                min-height: 34px;
                padding: 10px;
                white-space: normal;
            }
        }

        @media (max-width: 600px) {
            .display-header {
                height: auto;
                grid-template-columns: auto 1fr;
                grid-template-rows: auto auto;
                padding: 8px;
            }

            .header-logo {
                width: 38px;
                height: 44px;
            }

            .header-title {
                font-size: 12px;
                letter-spacing: 1px;
            }

            .header-actions {
                grid-column: 1 / -1;
                justify-content: center;
            }

            .group-badge {
                padding: 6px;
            }

            .group-badge-text strong {
                font-size: 11px;
            }

            .display-main {
                padding: 9px;
            }

            .left-column {
                display: flex;
            }

            .queue-columns {
                grid-template-columns: repeat(
                    2,
                    minmax(0, 1fr)
                );
                gap: 7px;
                padding: 7px;
            }

            .queue-table th,
            .queue-table td {
                padding: 7px 3px;
                font-size: 9px;
            }

            .summary-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .agency-card {
                grid-template-columns: 56px 1fr;
                min-height: 100px;
                padding: 12px;
                gap: 11px;
            }

            .agency-logo-box {
                width: 56px;
                height: 56px;
            }

            .audio-popup-content {
                flex-wrap: wrap;
            }

            .audio-popup-button {
                width: 100%;
            }
        }
    </style>
</head>

<body>

<header class="display-header">

    <div class="header-logos">
        <img
            class="header-logo"
            src="<?= base_url('assets/images/logokota.png') ?>"
            alt="Logo Kota Tangerang"
        >

        <img
            class="header-logo"
            src="<?= base_url('assets/images/mpp2.png') ?>"
            alt="Logo MPP"
        >
    </div>

    <div class="header-title">
        MAL PELAYANAN PUBLIK
        <span>KOTA TANGERANG</span>
    </div>

<div class="header-actions">

    <div class="display-label">
        Display:
        <strong id="kelompokLabel">Memuat...</strong>
    </div>

    <div class="display-menu">

        <button
            type="button"
            class="display-menu-button"
            id="displayMenuButton"
            aria-label="Menu Display"
            aria-expanded="false"
        >
            ⋮
        </button>

        <div
            class="display-menu-content"
            id="displayMenuContent"
        >
            <a
                class="logout-button"
                href="<?= site_url('subdisplay') ?>"
                 onclick="return confirm('Yakin ingin keluar?')"
            >
                Logout
            </a>
        </div>

    </div>

</div>

</header>

<main class="display-main">

    <section class="left-column">

        <div class="info-card">
            <div class="city-label">
                Kota Tangerang
            </div>

            <div
                class="digital-clock"
                id="digitalClock"
            >
                --:--:-- WIB
            </div>

            <div
                class="digital-date"
                id="digitalDate"
            >
                -
            </div>
        </div>

        <div class="group-card">
            <div>
                <div class="group-caption">
                    LAYAR SUBDISPLAY AKTIF
                </div>

                <div
                    class="group-name"
                    id="grupLabel"
                >
                    Memuat...
                </div>
            </div>

            <span class="group-value">
                ● LIVE
            </span>
        </div>

        <div
            class="agency-list"
            id="agencyList"
        >
            <div
                class="agency-track"
                id="agencyTrack"
            ></div>
        </div>

    </section>

    <section class="right-column">

        <section class="queue-panel">

            <div class="queue-heading">
                <div class="queue-title">
                    Daftar Antrean

                    <div class="queue-subtitle">
                        Informasi antrean layanan hari ini
                    </div>
                </div>

                <div class="queue-count">
                    <strong id="queueCount">0</strong>
                    <span>antrean</span>
                </div>
            </div>

            <div class="queue-columns">

                <div class="queue-table-wrap">
                    <table class="queue-table">
                        <thead>
                            <tr>
                                <th>Nomor</th>
                                <th>Jam</th>
                                <th>Instansi / Loket</th>
                            </tr>
                        </thead>

                        <tbody id="queueLeft"></tbody>
                    </table>
                </div>

                <div class="queue-table-wrap">
                    <table class="queue-table">
                        <thead>
                            <tr>
                                <th>Nomor</th>
                                <th>Jam</th>
                                <th>Instansi / Loket</th>
                            </tr>
                        </thead>

                        <tbody id="queueRight"></tbody>
                    </table>
                </div>

            </div>

        </section>

        <section class="summary-panel">

            <div class="summary-header">
                <div class="summary-title">
                    Ringkasan Antrean Instansi
                </div>
            </div>

            <div
                class="summary-grid"
                id="summaryGrid"
            ></div>

        </section>

    </section>

</main>

<footer class="display-footer">
    SELAMAT DATANG DI MAL PELAYANAN PUBLIK KOTA TANGERANG
    &nbsp; | &nbsp;
    PELAYANAN AKTIF PUKUL 08.00–15.00 WIB
    &nbsp; | &nbsp;
    MOHON MENUNGGU NOMOR ANTREAN ANDA DIPANGGIL
</footer>


<script>
'use strict';

/*
|--------------------------------------------------------------------------
| KONFIGURASI
|--------------------------------------------------------------------------
*/

const GRUP_ID = <?= (int) ($grupId ?? 0) ?>;

const API_URL = <?= json_encode(
    site_url('subdisplay/grup/' . (int) ($grupId ?? 0)),
    JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP
) ?>;

const LOGO_BASE = <?= json_encode(
    base_url('assets/images/'),
    JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP
) ?>;

const INITIAL_DATA = <?= json_encode(
    $initialData ?? [],
    JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP
) ?>;

let polling = false;

/*
|--------------------------------------------------------------------------
| HELPER
|--------------------------------------------------------------------------
*/

const $ = (id) => document.getElementById(id);

function esc(value) {
    return String(value ?? '').replace(/[&<>"']/g, (char) => ({
        '&': '&amp;',
        '<': '&lt;',
        '>': '&gt;',
        '"': '&quot;',
        "'": '&#039;'
    })[char]);
}

function getLogo(logo) {
    if (!logo) {
        return LOGO_BASE + 'logokota.png';
    }

    const value = String(logo).trim();

    if (/^https?:\/\//i.test(value)) {
        return value;
    }

    if (value.startsWith('/')) {
        return value;
    }

    return LOGO_BASE + value.split('/').pop();
}

/*
|--------------------------------------------------------------------------
| JAM DAN TANGGAL
|--------------------------------------------------------------------------
*/

function updateClock() {
    const now = new Date();

    const time = new Intl.DateTimeFormat('id-ID', {
        timeZone: 'Asia/Jakarta',
        hour: '2-digit',
        minute: '2-digit',
        second: '2-digit',
        hour12: false
    }).format(now);

    const date = new Intl.DateTimeFormat('id-ID', {
        timeZone: 'Asia/Jakarta',
        weekday: 'long',
        day: '2-digit',
        month: 'long',
        year: 'numeric'
    }).format(now);

    if ($('digitalClock')) {
        $('digitalClock').textContent = time + ' WIB';
    }

    if ($('digitalDate')) {
        $('digitalDate').textContent = date;
    }
}

/*
|--------------------------------------------------------------------------
| KARTU INSTANSI
|--------------------------------------------------------------------------
*/

function renderCards(instansi) {
    const track = $('agencyTrack');
    const list = $('agencyList');

    if (!track || !list) return;

    if (!Array.isArray(instansi) || instansi.length === 0) {
        track.innerHTML = `
            <div class="agency-card">
                <div class="agency-info">
                    Belum ada instansi pada grup ini.
                </div>
            </div>
        `;

        list.classList.add('is-static');
        return;
    }

    const cards = instansi.map((item) => {
        const nama = item.nama_instansi || item.nama || 'Instansi';

        const nomor =
            item.nomor ||
            item.panggilan?.nomor_antrean ||
            '-';

        const sedangDipanggil = nomor !== '-';

        return `
            <div class="agency-card ${sedangDipanggil ? 'has-queue' : ''}">
                <div class="agency-logo-box">
                    <img
                        src="${esc(getLogo(item.logo))}"
                        alt="${esc(nama)}"
                        onerror="this.onerror=null;this.src='${esc(LOGO_BASE)}logokota.png';"
                    >
                </div>

                <div class="agency-info">
                    <div class="agency-name">
                        ${esc(nama)}
                    </div>

                    <div class="agency-call-label">
                        ${sedangDipanggil ? 'Nomor dipanggil' : 'Belum ada panggilan'}
                    </div>

                    <div class="agency-number">
                        ${esc(nomor)}
                    </div>
                </div>
            </div>
        `;
    }).join('');

    // Duplikasi kartu untuk animasi berjalan.
    track.innerHTML = cards + cards;

    list.classList.toggle('is-static', instansi.length < 2);
}

/*
|--------------------------------------------------------------------------
| TABEL ANTREAN
|--------------------------------------------------------------------------
*/

function renderQueueRows(rows) {
    if (!Array.isArray(rows) || rows.length === 0) {
        return `
            <tr>
                <td colspan="3" class="queue-empty">
                    Belum ada antrean menunggu
                </td>
            </tr>
        `;
    }

    return rows.map((item) => {
        const nomor =
            item.nomor_antrean ||
            item.nomor ||
            '-';

        const jam = item.jam || '-';

        const instansi =
            item.nama_instansi ||
            item.instansi ||
            '-';

        const prioritas = item.prioritas == 1 || item.prioritas === true;

        return `
            <tr>
                <td class="queue-number">
                    <div class="queue-number-content">
                        <span class="queue-number-value">
                            ${esc(nomor)}
                        </span>

                        ${prioritas ? `
                            <span class="priority-label">
                                PRIORITAS
                            </span>
                        ` : ''}
                    </div>
                </td>

                <td>${esc(jam)}</td>

                <td>${esc(instansi)}</td>
            </tr>
        `;
    }).join('');
}

function renderQueue(rows) {
    const left = $('queueLeft');
    const right = $('queueRight');

    if (!left || !right) return;

    const antrean = Array.isArray(rows) ? rows : [];

    // Maksimal 8 antrean ditampilkan.
    const tampil = antrean.slice(0, 8);

    left.innerHTML = renderQueueRows(tampil.slice(0, 4));
    right.innerHTML = renderQueueRows(tampil.slice(4, 8));

    if ($('queueCount')) {
        $('queueCount').textContent = antrean.length;
    }
}

/*
|--------------------------------------------------------------------------
| RINGKASAN
|--------------------------------------------------------------------------
*/

function renderSummary(ringkasan) {
    const grid = $('summaryGrid');

    if (!grid) return;

    if (!Array.isArray(ringkasan) || ringkasan.length === 0) {
        grid.innerHTML = `
            <div class="summary-item">
                <div class="summary-agency">Belum ada data</div>
            </div>
        `;
        return;
    }

    grid.innerHTML = ringkasan.map((item) => {
        const nama = item.nama_instansi || 'Instansi';

        return `
            <div class="summary-item">
                <div class="summary-agency">
                    ${esc(nama)}
                </div>

                <div class="summary-data">
                    <div class="summary-cell">
                        <div class="summary-cell-label">Menunggu</div>
                        <div class="summary-cell-value">
                            ${Number(item.menunggu || 0)}
                        </div>
                    </div>

                    <div class="summary-cell">
                        <div class="summary-cell-label">Total</div>
                        <div class="summary-cell-value">
                            ${Number(item.total || 0)}
                        </div>
                    </div>
                </div>
            </div>
        `;
    }).join('');
}

/*
|--------------------------------------------------------------------------
| RENDER SELURUH DATA
|--------------------------------------------------------------------------
*/

function render(data) {
    if (!data || typeof data !== 'object') return;

    const grupAktif = data.grup_aktif || {};

    if ($('grupLabel')) {
        $('grupLabel').textContent =
            grupAktif.nama_grup || 'Subdisplay';
    }

    if ($('kelompokLabel')) {
        // Tidak menampilkan nama kelompok.
        $('kelompokLabel').textContent =
            grupAktif.nama_grup || 'Subdisplay';
    }

    renderCards(data.instansi || []);
    renderQueue(data.antrean || []);
    renderSummary(data.ringkasan || []);
}

/*
|--------------------------------------------------------------------------
| AMBIL DATA DARI API
|--------------------------------------------------------------------------
*/

async function loadData() {
    if (polling || !GRUP_ID) return;

    polling = true;

    try {
        const response = await fetch(API_URL, {
            method: 'GET',
            headers: {
                'Accept': 'application/json'
            },
            cache: 'no-store'
        });

        if (!response.ok) {
            throw new Error('HTTP ' + response.status);
        }

        const result = await response.json();

        if (result.status === true && result.data) {
            render(result.data);
        } else {
            console.warn('API tidak mengembalikan data:', result);
        }

    } catch (error) {
        console.error('Gagal mengambil data subdisplay:', error);
    } finally {
        polling = false;
    }
}

/*
|--------------------------------------------------------------------------
| MENU DISPLAY
|--------------------------------------------------------------------------
*/

function setupMenu() {
    const button = $('displayMenuButton');
    const content = $('displayMenuContent');

    if (!button || !content) return;

    button.addEventListener('click', function () {
        const isOpen = content.classList.toggle('show');

        button.setAttribute(
            'aria-expanded',
            isOpen ? 'true' : 'false'
        );
    });

    document.addEventListener('click', function (event) {
        if (
            !button.contains(event.target) &&
            !content.contains(event.target)
        ) {
            content.classList.remove('show');
            button.setAttribute('aria-expanded', 'false');
        }
    });
}

/*
|--------------------------------------------------------------------------
| JALANKAN DISPLAY
|--------------------------------------------------------------------------
*/

document.addEventListener('DOMContentLoaded', function () {
    updateClock();
    setupMenu();

    // Tampilkan data awal dari controller.
    if (
        INITIAL_DATA &&
        Object.keys(INITIAL_DATA).length > 0
    ) {
        render(INITIAL_DATA);
    }

    // Ambil data terbaru dari API.
    loadData();

    // Perbarui jam setiap detik.
    setInterval(updateClock, 1000);

    // Perbarui data antrean setiap 2,5 detik.
    setInterval(loadData, 2500);
});
</script>
</body>
</html>
