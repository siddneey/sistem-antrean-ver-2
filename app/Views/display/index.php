<?php

$kelompokId = (int) ($kelompokId ?? 0);
$grupId = (int) ($grupId ?? 0);
$displaySessionToken = (string) ($displaySessionToken ?? '');

$initialData = is_array($initialData ?? null)
    ? $initialData
    : [];

$jsonFlags = JSON_HEX_TAG
    | JSON_HEX_AMP
    | JSON_HEX_APOS
    | JSON_HEX_QUOT
    | JSON_INVALID_UTF8_SUBSTITUTE;

?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1"
    >

    <title>Display Antrean - MPP Kota Tangerang</title>

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
                href="<?= site_url('display') ?>"
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
                    LAYAR DISPLAY AKTIF
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

<!-- POPUP TES SUARA -->

<div
    id="audioPopup"
    class="audio-popup"
    role="dialog"
    aria-labelledby="audioPopupTitle"
>
    <div class="audio-popup-content">

        <span class="audio-popup-icon">
            🔔
        </span>

        <div class="audio-popup-text">
            <strong id="audioPopupTitle">
                Tes Suara Display
            </strong>

            <small id="audioPopupDescription">
                Klik Tes Suara untuk memeriksa
                jingle panggilan antrean.
            </small>
        </div>

        <button
            id="audioButton"
            class="audio-popup-button"
            type="button"
        >
            Tes Suara
        </button>

    </div>
</div>

<script>
'use strict';

/* ====================================================
   KONFIGURASI
==================================================== */

const KELOMPOK_ID = <?= json_encode($kelompokId) ?>;
const GRUP_ID = <?= json_encode($grupId) ?>;
const DISPLAY_SESSION_TOKEN = <?= json_encode(
    $displaySessionToken,
    $jsonFlags
) ?>;

const HEARTBEAT_URL = <?= json_encode(
    site_url('display/heartbeat/' . $kelompokId),
    $jsonFlags
) ?>;

const AUDIO_SELESAI_URL = <?= json_encode(
    site_url('display/audio-selesai/' . $kelompokId),
    $jsonFlags
) ?>;

const INITIAL_DATA = <?= json_encode(
    $initialData,
    $jsonFlags
) ?>;

const API_URL = <?= json_encode(
    site_url(
        'display/kelompok/' .
        $kelompokId .
        '/grup/' .
        $grupId
    ),
    $jsonFlags
) ?>;

const AUDIO_UMUM = <?= json_encode(
    base_url('audio/umum/'),
    $jsonFlags
) ?>;

const AUDIO_INSTANSI = <?= json_encode(
    base_url('audio/instansi/'),
    $jsonFlags
) ?>;

const LOGO_BASE = <?= json_encode(
    base_url('assets/images/'),
    $jsonFlags
) ?>;

const JINGLE_URL = AUDIO_UMUM + 'jingle.mp3';

const $ = id => document.getElementById(id);

/* ====================================================
   HELPER
==================================================== */

function esc(value) {
    return String(value ?? '').replace(
        /[&<>"']/g,
        character => ({
            '&': '&amp;',
            '<': '&lt;',
            '>': '&gt;',
            '"': '&quot;',
            "'": '&#39;'
        })[character]
    );
}

function norm(value) {
    return String(value ?? '')
        .normalize('NFD')
        .replace(/[\u0300-\u036f]/g, '')
        .toUpperCase()
        .replace(/[^A-Z0-9]+/g, ' ')
        .trim();
}

function assetUrl(base, filename) {
    return base + encodeURIComponent(filename);
}

/* ====================================================
   MAPPING AUDIO INSTANSI
==================================================== */

const audioInstansi = {
    'PT POS INDONESIA': 'PT. Pos Indonesia.mp3',
    'PENGADILAN AGAMA': 'Pengadilan Agama.mp3',
    'BANK BANTEN': 'Bank Banten.mp3',
    'POLRES': 'POLRES.mp3',
    'DIRJEN AHU': 'Dirjen AHU.mp3',
    'DITJEN AHU': 'Dirjen AHU.mp3',
    'BNN': 'BNN.mp3',
    'BPOM': 'BPOM.mp3',
    'BANK BJB': 'Bank BJB.mp3',
    'PERKIM': 'PERKIM.mp3',
    'DUKCAPIL': 'DUKCAPIL.mp3',
    'DINAS LINGKUNGAN HIDUP':
        'DINAS LINGKUNGAN HIDUP.mp3',
    'BAZNAS': 'Baznas.mp3',
    'TASPEN': 'TASPEN.mp3',
    'ATR BPN': 'ATR BPN.mp3',
    'BPKD': 'BPKD.mp3',
    'PLN': 'PLN.mp3',
    'PELAYANAN PBG': 'Pelayanan PBG.mp3',
    'PTSP 2': 'PTSP 2.mp3',
    'PTSP 1': 'PTSP 1.mp3',
    'KEJARI': 'KEJARI.mp3',
    'BAPENDA': 'Bapenda.mp3',
    'DISNAKER': 'disnaker.mp3',
    'DPUPR': 'DPUPR.mp3',
    'BPJS KESEHATAN': 'BPJS Kesehatan.mp3',
    'PDAM': 'PDAM.mp3',
    'SAMSAT': 'Samsat.mp3',
    'BPJS TK': 'BPJS TK.mp3',
    'BPJS KETENAGAKERJAAN': 'BPJS TK.mp3',
    'BPJSTK': 'BPJS TK.mp3'
};

/* ====================================================
   MAPPING LOGO
==================================================== */

const logoMap = {
    'ATR BPN': 'atr bpn.png',
    'BANK BANTEN': 'bank banten.png',
    'BANK BJB': 'bank bjb.png',
    'BAPENDA': 'bapenda.jpg',
    'BAZNAS': 'baznas.png',
    'BNN': 'BNN.jpg',
    'BPJS KESEHATAN': 'BPJS Kesehatan.png',
    'BPJS KETENAGAKERJAAN':
        'BPJS Ketenagakerjaan.png',
    'BPJS TK': 'BPJS Ketenagakerjaan.png',
    'BPOM': 'BPOM.png',
    'DISNAKER': 'disnaker.png',
    'DITJEN AHU': 'ditjen ahu.jpg',
    'KEJARI': 'kejari.png',
    'PDAM': 'PDAM.png',
    'PENGADILAN AGAMA': 'pengadilan agama.jpg',
    'PLN': 'PLN.png',
    'POLRES': 'polres.png',
    'PT POS INDONESIA': 'PT POS INDONESIA.jpg',
    'SAMSAT': 'samsat.png',
    'TASPEN': 'taspen.png'
};

function resolveFile(map, name) {
    return map[norm(name)] || null;
}

/* ====================================================
   AUDIO STATE
==================================================== */

function callId(panggilan) {
    return Number(
        panggilan?.riwayat_panggilan_id || 0
    );
}

function maxAudioCallId(data) {
    const riwayat = Array.isArray(
        data?.riwayat_panggilan_audio
    )
        ? data.riwayat_panggilan_audio
        : [];

    return Math.max(
        0,
        ...riwayat
            .map(callId)
            .filter(Number.isSafeInteger),
        callId(data?.panggilan_terbaru)
    );
}

let lastSeenAudioId = maxAudioCallId(INITIAL_DATA);

let audioEnabled = false;
let playing = false;
let polling = false;

const audioQueue = [];
const queuedAudioIds = new Set();
const completedAudioIds = new Set();

function masukkanAntreanAudio(panggilan) {
    const id = callId(panggilan);

    if (
        !audioEnabled ||
        id < 1 ||
        queuedAudioIds.has(id) ||
        completedAudioIds.has(id)
    ) {
        return;
    }

    const files = audioFiles(panggilan);

    if (!files) {
        return;
    }

    queuedAudioIds.add(id);

    audioQueue.push({
        id,
        files
    });

    void drainAudio();
}

/* ====================================================
   HEARTBEAT DISPLAY
==================================================== */

async function kirimHeartbeat() {
    try {
        const response = await fetch(HEARTBEAT_URL, {
            method: 'POST',
            credentials: 'same-origin',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            },
            body: JSON.stringify({
                session_token: DISPLAY_SESSION_TOKEN,
                audio_ready: audioEnabled ? 1 : 0
            })
        });

        const result = await response.json();

        if (!response.ok || !result.status) {
            console.error(
                'Heartbeat Display gagal:',
                result.message || response.status
            );

            return false;
        }

        return true;

    } catch (error) {
        console.error('Gagal mengirim heartbeat Display:', error);
        return false;
    }
}

/* ====================================================
   KONFIRMASI AUDIO SELESAI
==================================================== */

async function konfirmasiAudioSelesai(riwayatId) {
    try {
        const response = await fetch(AUDIO_SELESAI_URL, {
            method: 'POST',
            credentials: 'same-origin',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            },
            body: JSON.stringify({
                session_token: DISPLAY_SESSION_TOKEN,
                riwayat_panggilan_id: riwayatId
            })
        });

        const result = await response.json();

        if (!response.ok || !result.status) {
            console.error(
                'Konfirmasi audio selesai gagal:',
                result.message || response.status
            );

            return false;
        }

        return true;

    } catch (error) {
        console.error(
            'Gagal mengirim konfirmasi audio selesai:',
            error
        );

        return false;
    }
}

/* ====================================================
   ANGKA AUDIO
==================================================== */

function angkaFiles(nomor) {
    const n = Number(nomor);

    if (
        !Number.isSafeInteger(n) ||
        n < 1 ||
        n > 1999
    ) {
        return null;
    }

    if (n <= 11) {
        return [
            assetUrl(AUDIO_UMUM, n + '.mp3')
        ];
    }

    if (n < 20) {
        return [
            assetUrl(
                AUDIO_UMUM,
                (n - 10) + '.mp3'
            ),
            assetUrl(
                AUDIO_INSTANSI,
                'Belas.mp3'
            )
        ];
    }

    if (n < 100) {
        const puluh = Math.floor(n / 10) * 10;
        const sisa = n % 10;

        return [
            assetUrl(
                AUDIO_UMUM,
                puluh + '.mp3'
            ),
            ...(sisa ? angkaFiles(sisa) : [])
        ];
    }

    if (n < 1000) {
        const ratus = Math.floor(n / 100) * 100;
        const sisa = n % 100;

        return [
            assetUrl(
                AUDIO_UMUM,
                ratus + '.mp3'
            ),
            ...(sisa ? angkaFiles(sisa) : [])
        ];
    }

    const sisa = n - 1000;

    return [
        assetUrl(AUDIO_UMUM, '1000.mp3'),
        ...(sisa ? angkaFiles(sisa) : [])
    ];
}

/* ====================================================
   SUSUN PANGGILAN AUDIO
==================================================== */

function audioFiles(panggilan) {
    const nomorFiles = angkaFiles(
        panggilan.nomor_antrean
    );

    const instansiFile = resolveFile(
        audioInstansi,
        panggilan.nama_instansi
    );

    if (!nomorFiles || !instansiFile) {
        console.warn(
            'Audio belum tersedia:',
            panggilan
        );
        return null;
    }

    return [
        JINGLE_URL,

        assetUrl(
            AUDIO_UMUM,
            'Nomor Antrean.mp3'
        ),

        ...nomorFiles,

        assetUrl(
            AUDIO_UMUM,
            'Silahkan Menuju Loket.mp3'
        ),

        assetUrl(
            AUDIO_INSTANSI,
            instansiFile
        ),

    ];
}

/* ====================================================
   PLAYER AUDIO
==================================================== */

function playFile(url) {
    return new Promise((resolve, reject) => {
        const audio = new Audio();
        let settled = false;

        const namaFile = decodeURIComponent(
            url.split('/').pop().split('?')[0]
        ).toLowerCase();

        // Jingle dikecilkan, audio lainnya tetap maksimal.
        if (namaFile === 'jingle.mp3') {
            audio.volume = 0.35;
        } else {
            audio.volume = 1.0;
        }

        function finish(error = null) {
            if (settled) return;

            settled = true;

            audio.onended = null;
            audio.onerror = null;

            if (error) {
                reject(error);
            } else {
                resolve();
            }
        }

        audio.onended = () => finish();

        audio.onerror = () => {
            finish(new Error(
                'Gagal memuat audio: ' + url
            ));
        };

        audio.src = url;

        audio.play().catch(finish);
    });
}

async function drainAudio() {
    if (playing || !audioEnabled) {
        return;
    }

    playing = true;

    try {
        while (
            audioQueue.length > 0 &&
            audioEnabled
        ) {
            const panggilan = audioQueue.shift();
            let audioBerhasil = true;

            for (const file of panggilan.files) {
                if (!audioEnabled) {
                    audioBerhasil = false;
                    break;
                }

                try {
                    await playFile(file);
                } catch (error) {
                    console.error(
                        'Audio panggilan gagal:',
                        file,
                        error
                    );

                    audioBerhasil = false;
                    break;
                }
            }

            if (audioBerhasil) {
                const berhasil = await konfirmasiAudioSelesai(
                    panggilan.id
                );

                if (berhasil) {
                    completedAudioIds.add(panggilan.id);
                }
            } else {
                console.error(
                    'Rangkaian audio belum selesai untuk riwayat:',
                    panggilan.id
                );
            }
        }
    } finally {
        playing = false;
    }
}

/* ====================================================
   POPUP TES SUARA
==================================================== */

$('audioButton').addEventListener(
    'click',
    async function () {
        if (audioEnabled) return;

        const button = $('audioButton');

        button.disabled = true;
        button.textContent = 'Memutar...';

        try {
            await playFile(JINGLE_URL);

            audioEnabled = true;

            $('audioPopup').classList.add(
                'is-hidden'
            );

            // Tandai Display siap setelah tes audio berhasil.
            await kirimHeartbeat();

            void drainAudio();

        } catch (error) {
            console.error('Tes suara gagal:', error);

            audioEnabled = false;

            button.disabled = false;
            button.textContent = 'Coba Lagi';

            $('audioPopupDescription').textContent =
                'Tes gagal. Periksa file jingle, ' +
                'volume, dan izin audio browser.';

            // Pastikan server mengetahui Display belum siap.
            void kirimHeartbeat();
        }
    }
);

/* ====================================================
   RENDER KARTU INSTANSI
==================================================== */

function renderCards(items) {
    const track = $('agencyTrack');

    const html = items.map(instansi => {
        const panggilan = instansi.panggilan;

        const nomor = panggilan?.nomor_antrean != null
            ? esc(panggilan.nomor_antrean)
            : '—';

        const namaLogo = resolveFile(
            logoMap,
            instansi.nama_instansi
        ) || String(
            instansi.logo || 'logokota.png'
        ).split('/').pop();

        const logoUrl = assetUrl(
            LOGO_BASE,
            namaLogo
        );

        const fallback = assetUrl(
            LOGO_BASE,
            'logokota.png'
        );

        return `
            <article class="agency-card ${panggilan ? 'has-queue' : ''}">
                <div class="agency-logo-box">
                    <img
                        src="${esc(logoUrl)}"
                        data-fallback="${esc(fallback)}"
                        alt=""
                    >
                </div>

                <div class="agency-info">
                    <div class="agency-name">
                        ${esc(instansi.nama_instansi)}
                    </div>

                    <div class="agency-call-label">
                        Nomor antrean
                    </div>

                    <div class="agency-number">
                        ${nomor}
                    </div>
                </div>
            </article>
        `;
    }).join('');

    if (track.dataset.html === html) {
        return;
    }

    track.dataset.html = html;
    track.innerHTML = html;

    const list = $('agencyList');

    list.classList.add('is-static');

    track.style.animationDuration = '';

    if (items.length > 1) {
        const cards = [...track.children];

        for (const card of cards) {
            const clone = card.cloneNode(true);

            clone.setAttribute(
                'aria-hidden',
                'true'
            );

            track.appendChild(clone);
        }

        track.style.animationDuration =
            Math.max(
                32,
                items.length * 10
            ) + 's';

        requestAnimationFrame(() => {
            if (track.dataset.html !== html) {
                return;
            }

            list.classList.toggle(
                'is-static',
                track.scrollHeight / 2
                    <= list.clientHeight + 8
            );
        });
    }
}

/* FALLBACK LOGO */

$('agencyTrack').addEventListener(
    'error',
    function (event) {
        const img = event.target;

        if (!(img instanceof HTMLImageElement)) {
            return;
        }

        const fallback = img.dataset.fallback;

        if (fallback && img.src !== fallback) {
            img.src = fallback;
        } else {
            img.removeAttribute('data-fallback');
        }
    },
    true
);

/* ====================================================
   RENDER TABEL ANTREAN
   PRIORITAS TEPAT DI BAWAH NOMOR
==================================================== */

function renderRows(id, rows) {
    const html = rows.length
        ? rows.map(row => {
            const nomor = row.nomor_antrean
                ?? row.nomor
                ?? '-';

            const jam = row.jam || '-';

            const instansi = row.instansi
                || row.nama_instansi
                || '-';

            const prioritas =
                String(row.jenis_antrean || '')
                    .trim()
                    .toUpperCase() === 'PRIORITAS'
                || row.prioritas === true
                || row.prioritas === 1
                || row.prioritas === '1';

            return `
                <tr>
                    <td class="queue-number">
                        <div class="queue-number-content">
                            <span class="queue-number-value">
                                ${esc(nomor)}
                            </span>

                            ${prioritas
                                ? '<span class="priority-label">PRIORITAS</span>'
                                : ''}
                        </div>
                    </td>

                    <td>${esc(jam)}</td>

                    <td>${esc(instansi)}</td>
                </tr>
            `;
        }).join('')
        : `
            <tr>
                <td colspan="3" class="queue-empty">
                    Belum ada antrean menunggu
                </td>
            </tr>
        `;

    const tbody = $(id);

    if (tbody.dataset.html !== html) {
        tbody.dataset.html = html;
        tbody.innerHTML = html;
    }
}

/* ====================================================
   RENDER SELURUH DISPLAY
==================================================== */

function render(data) {
    if (!data || typeof data !== 'object') {
        return;
    }

    // KELOMPOK AUDIO

    $('kelompokLabel').textContent =
        data.kelompok?.nama_kelompok
        || 'Kelompok';

    // GRUP TAMPILAN

    $('grupLabel').textContent =
        data.grup_aktif?.nama_grup || 'Grup';

    // KARTU INSTANSI GRUP PILIHAN

    const instansi = Array.isArray(data.instansi)
        ? data.instansi
        : [];

    renderCards(instansi);

    // ANTREAN MENUNGGU GLOBAL

    const antrean = Array.isArray(data.antrean)
        ? [...data.antrean]
        : [];

    /*
     * Prioritas naik ke atas.
     * Tidak ada warna khusus.
     */

    const isPrioritas = row => {
        const jenis = String(
            row.jenis_antrean || ''
        ).trim().toUpperCase();

        return jenis === 'PRIORITAS'
            || row.prioritas === true
            || row.prioritas === 1
            || row.prioritas === '1';
    };

    antrean.sort((a, b) => {
        const prioritasA = isPrioritas(a);
        const prioritasB = isPrioritas(b);

        if (prioritasA !== prioritasB) {
            return prioritasA ? -1 : 1;
        }

        return String(
            a.waktu_masuk || a.jam || ''
        ).localeCompare(
            String(b.waktu_masuk || b.jam || '')
        );
    });

    // TOTAL SELURUH ANTREAN MENUNGGU

    $('queueCount').textContent = String(
        antrean.length
    );

    /*
     * Maksimal 8 antrean:
     * 4 tabel kiri
     * 4 tabel kanan
     */

    const tampil = antrean.slice(0, 8);

    renderRows(
        'queueLeft',
        tampil.slice(0, 4)
    );

    renderRows(
        'queueRight',
        tampil.slice(4, 8)
    );

    // RINGKASAN KHUSUS GRUP

    const ringkasan = Array.isArray(data.ringkasan)
        ? data.ringkasan
        : [];

    const ringkasanMap = new Map(
        ringkasan.map(item => [
            Number(item.instansi_id),
            item
        ])
    );

    const summaryHtml = instansi.map(item => {
        const statistik = ringkasanMap.get(
            Number(item.id)
        ) || {};

        const menunggu = Number(
            statistik.menunggu ?? 0
        );

        const total = Number(
            statistik.total ?? 0
        );

        return `
            <div class="summary-item">
                <div class="summary-agency">
                    ${esc(item.nama_instansi)}
                </div>

                <div class="summary-data">
                    <div class="summary-cell">
                        <div class="summary-cell-label">
                            Menunggu
                        </div>

                        <div class="summary-cell-value">
                            ${esc(menunggu)}
                        </div>
                    </div>

                    <div class="summary-cell">
                        <div class="summary-cell-label">
                            Total
                        </div>

                        <div class="summary-cell-value">
                            ${esc(total)}
                        </div>
                    </div>
                </div>
            </div>
        `;
    }).join('');

    const summaryGrid = $('summaryGrid');

    if (
        summaryGrid.dataset.html !== summaryHtml
    ) {
        summaryGrid.dataset.html = summaryHtml;
        summaryGrid.innerHTML = summaryHtml;
    }
}

/* ====================================================
   POLLING 2,5 DETIK
==================================================== */

async function poll() {
    if (polling) {
        return;
    }

    polling = true;

    try {
        const response = await fetch(
            API_URL,
            {
                cache: 'no-store',
                credentials: 'same-origin',
                headers: {
                    'Accept': 'application/json'
                }
            }
        );

        if (!response.ok) {
            throw new Error(
                'HTTP ' + response.status
            );
        }

        const json = await response.json();

        if (!json.status || !json.data) {
            throw new Error(
                json.message || 'API error'
            );
        }

        const data = json.data;

        if (
            Number(data.kelompok?.id) !== KELOMPOK_ID ||
            Number(data.grup_aktif?.id) !== GRUP_ID
        ) {
            throw new Error(
                'Kelompok atau Grup tidak cocok.'
            );
        }

        // AUDIO KHUSUS KELOMPOK

        const calls = Array.isArray(
            data.riwayat_panggilan_audio
        )
            ? data.riwayat_panggilan_audio
            : [];

        const unseen = calls
            .filter(call => {
                return callId(call) > lastSeenAudioId;
            })
            .sort((a, b) => {
                return callId(a) - callId(b);
            });

        // Jangan tandai panggilan sudah dibaca sebelum
        // Display lolos Tes Suara.
        if (audioEnabled) {
        for (const panggilan of unseen) {
            masukkanAntreanAudio(panggilan);
        }

        lastSeenAudioId = Math.max(
            lastSeenAudioId,
            maxAudioCallId(data)
        );
    }
        render(data);

        void drainAudio();

    } catch (error) {
        console.error(
            'Polling Display gagal:',
            error
        );
    } finally {
        polling = false;
    }
}

/* ====================================================
   JAM WIB
==================================================== */

function clock() {
    const now = new Date();

    $('digitalClock').textContent =
        new Intl.DateTimeFormat(
            'id-ID',
            {
                timeZone: 'Asia/Jakarta',
                hour: '2-digit',
                minute: '2-digit',
                second: '2-digit',
                hour12: false
            }
        ).format(now) + ' WIB';

    $('digitalDate').textContent =
        new Intl.DateTimeFormat(
            'id-ID',
            {
                timeZone: 'Asia/Jakarta',
                weekday: 'long',
                day: '2-digit',
                month: 'long',
                year: 'numeric'
            }
        ).format(now);
}

    /* ====================================================
    MENU DISPLAY
    ==================================================== */

    const displayMenuButton = $('displayMenuButton');
    const displayMenuContent = $('displayMenuContent');

    displayMenuButton.addEventListener('click', function (event) {
        event.stopPropagation();

        const isOpen = displayMenuContent.classList.toggle('show');

        displayMenuButton.setAttribute(
            'aria-expanded',
            isOpen ? 'true' : 'false'
        );
    });

    document.addEventListener('click', function (event) {
        if (!event.target.closest('.display-menu')) {
            displayMenuContent.classList.remove('show');

            displayMenuButton.setAttribute(
                'aria-expanded',
                'false'
            );
        }
    });

    document.addEventListener('keydown', function (event) {
        if (event.key === 'Escape') {
            displayMenuContent.classList.remove('show');

            displayMenuButton.setAttribute(
                'aria-expanded',
                'false'
            );
        }
    });

/* ====================================================
   INISIALISASI
==================================================== */

render(INITIAL_DATA);

// Heartbeat awal: Display online tetapi belum siap audio.
void kirimHeartbeat();

clock();

setInterval(clock, 1000);

// Heartbeat setiap 5 detik.
setInterval(kirimHeartbeat, 5000);

setInterval(poll, 2500);

void poll();

</script>

</body>
</html>