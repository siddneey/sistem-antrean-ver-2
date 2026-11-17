<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mal Pelayanan Publik Kota Tangerang</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

    <style>
        :root {
            --navy: #0b2341;
            --navy-dark: #07182d;
            --navy-light: #173d68;
            --yellow: #f4c430;
            --yellow-dark: #d8aa17;
            --white: #ffffff;
            --soft-white: #f6f8fb;
            --gray: #6b7280;
            --gray-light: #e9edf2;
            --border: #dce3eb;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            min-height: 100vh;
            font-family: "Segoe UI", Arial, sans-serif;
            color: var(--navy);
            background:
                url('<?= base_url('assets/bgkota.jpg') ?>') center / cover no-repeat fixed,
                url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 1600 900' preserveAspectRatio='xMidYMax slice'%3E%3Cg fill='%23fff' opacity='.92'%3E%3Cellipse cx='260' cy='170' rx='150' ry='42'/%3E%3Cellipse cx='370' cy='150' rx='110' ry='50'/%3E%3Cellipse cx='180' cy='155' rx='90' ry='36'/%3E%3Cellipse cx='1150' cy='120' rx='170' ry='44'/%3E%3Cellipse cx='1270' cy='100' rx='110' ry='50'/%3E%3Cellipse cx='1050' cy='108' rx='90' ry='34'/%3E%3Cellipse cx='760' cy='260' rx='130' ry='32' opacity='.7'/%3E%3Cellipse cx='1450' cy='280' rx='120' ry='30' opacity='.7'/%3E%3C/g%3E%3Cg fill='%238fb8dd'%3E%3Crect x='0' y='520' width='120' height='380'/%3E%3Crect x='130' y='470' width='90' height='430'/%3E%3Crect x='300' y='540' width='140' height='360'/%3E%3Crect x='560' y='500' width='100' height='400'/%3E%3Crect x='820' y='530' width='130' height='370'/%3E%3Crect x='1080' y='480' width='110' height='420'/%3E%3Crect x='1330' y='520' width='140' height='380'/%3E%3C/g%3E%3Cg fill='%234f86b8'%3E%3Crect x='60' y='600' width='140' height='300'/%3E%3Crect x='220' y='560' width='100' height='340'/%3E%3Crect x='440' y='620' width='120' height='280'/%3E%3Crect x='690' y='570' width='110' height='330'/%3E%3Crect x='950' y='610' width='120' height='290'/%3E%3Crect x='1200' y='580' width='100' height='320'/%3E%3Crect x='1450' y='600' width='150' height='300'/%3E%3C/g%3E%3Cg fill='%23173d68'%3E%3Crect x='0' y='700' width='180' height='200'/%3E%3Crect x='170' y='660' width='120' height='240'/%3E%3Crect x='340' y='720' width='160' height='180'/%3E%3Crect x='540' y='680' width='130' height='220'/%3E%3Crect x='740' y='730' width='170' height='170'/%3E%3Crect x='960' y='690' width='140' height='210'/%3E%3Crect x='1160' y='720' width='160' height='180'/%3E%3Crect x='1380' y='680' width='220' height='220'/%3E%3C/g%3E%3Cg fill='%23f4c430' opacity='.85'%3E%3Crect x='185' y='690' width='10' height='14'/%3E%3Crect x='215' y='720' width='10' height='14'/%3E%3Crect x='560' y='710' width='10' height='14'/%3E%3Crect x='600' y='750' width='10' height='14'/%3E%3Crect x='980' y='720' width='10' height='14'/%3E%3Crect x='1020' y='760' width='10' height='14'/%3E%3Crect x='1410' y='710' width='10' height='14'/%3E%3Crect x='1470' y='750' width='10' height='14'/%3E%3C/g%3E%3C/svg%3E")
                    center bottom / cover no-repeat fixed,
                linear-gradient(180deg, #5eb6f2 0%, #9bd3f7 45%, #d9efff 100%) fixed;
        }

        .kiosk-wrapper {
            width: 100%;
            max-width: 1320px;
            min-height: 100vh;
            margin: 0 auto;
            padding: 24px;
        }

        .kiosk-container {
            min-height: calc(100vh - 48px);
            display: flex;
            flex-direction: column;
            background: var(--soft-white);
            border-radius: 22px;
            overflow: hidden;
            box-shadow: 0 25px 70px rgba(7,24,45,.35);
        }

        /* HEADER */
        .kiosk-header {
            position: relative;
            min-height: 155px;
            padding: 20px 35px;
            color: var(--navy);
            overflow: hidden;
            isolation: isolate;
            border-bottom: 4px solid var(--yellow);
            background:
                radial-gradient(
                    ellipse 120px 34px at 62% 28%,
                    rgba(255,255,255,.85),
                    transparent 70%
                ),
                radial-gradient(
                    ellipse 90px 26px at 70% 20%,
                    rgba(255,255,255,.75),
                    transparent 70%
                ),
                radial-gradient(
                    ellipse 150px 38px at 38% 78%,
                    rgba(255,255,255,.55),
                    transparent 70%
                ),
                radial-gradient(
                    ellipse 110px 30px at 92% 26%,
                    rgba(255,255,255,.8),
                    transparent 70%
                ),
                linear-gradient(
                    105deg,
                    #f2faff 0%,
                    #cfeaff 40%,
                    #8ccaf3 100%
                );
        }

        /* BANNER GEDUNG (di kanan, tepi kiri memudar) */
        .header-building {
            position: absolute;
            z-index: 1;
            top: 0;
            right: 0;
            bottom: 0;
            height: 100%;
            width: auto;
            max-width: 48%;
            object-fit: cover;
            object-position: right center;
            display: block;
            pointer-events: none;
            user-select: none;

            -webkit-mask-image: linear-gradient(to right,
                transparent 0%, rgba(0,0,0,.25) 14%, rgba(0,0,0,.7) 32%, #000 55%);
            mask-image: linear-gradient(to right,
                transparent 0%, rgba(0,0,0,.25) 14%, rgba(0,0,0,.7) 32%, #000 55%);
        }

        .header-content {
            position: relative;
            z-index: 5;
            display: flex;
            align-items: center;
            gap: 22px;
        }

        .header-logo {
            width: 100px;
            height: 100px;
            min-width: 100px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .header-logo img {
            width: 100%;
            height: 100%;
            object-fit: contain;
            display: block;
            filter: drop-shadow(0 4px 8px rgba(11,35,65,.28));
        }

        .header-info {
            display: flex;
            flex-direction: column;
        }

        .header-eyebrow {
            display: flex;
            align-items: center;
            gap: 10px;
            margin: 0 0 4px;
            font-size: 14px;
            font-weight: 700;
            letter-spacing: 2.5px;
            text-transform: uppercase;
            color: var(--navy-light);
        }

        .header-eyebrow::before {
            content: "";
            width: 28px;
            height: 4px;
            border-radius: 10px;
            background: var(--yellow);
        }

        .header-title {
            margin: 0;
            font-size: 32px;
            line-height: 1.12;
            font-weight: 800;
            letter-spacing: -.6px;
            color: var(--navy);
            text-shadow: 0 1px 0 rgba(255,255,255,.6);
        }

        .header-title span {
            color: var(--navy-light);
        }

        /* TOOLBAR */
        .toolbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            padding: 18px 30px;
            background: white;
            border-bottom: 1px solid #edf0f3;
        }

        .toolbar-left {
            display: flex;
            align-items: center;
            gap: 0;
        }

        .toolbar-title {
            margin: 0;
            font-size: 13px;
            font-weight: 700;
            color: var(--navy);
        }

        .toolbar-description {
            margin: 2px 0 0;
            font-size: 11px;
            color: var(--gray);
        }

        .service-select-wrapper {
            position: relative;
            min-width: 225px;
        }

        .service-select-label {
            position: absolute;
            left: 13px;
            top: -7px;
            padding: 0 5px;
            background: white;
            color: var(--gray);
            font-size: 10px;
            font-weight: 600;
            z-index: 2;
        }

        .service-select {
            position: relative;
            width: 100%;
        }

        .service-select-button {
            width: 100%;
            height: 43px;
            padding: 0 38px 0 13px;
            border: 1px solid var(--border);
            border-radius: 9px;
            background: white;
            color: rgba(107,114,128,.65);
            font-size: 12px;
            font-weight: 400;
            font-style: italic;
            text-align: left;
            cursor: pointer;
            outline: none;
            position: relative;
        }

        .service-select-button::after {
            content: "";
            position: absolute;
            right: 14px;
            top: 50%;
            width: 7px;
            height: 7px;
            border-right: 1.5px solid #64748b;
            border-bottom: 1.5px solid #64748b;
            transform: translateY(-65%) rotate(45deg);
            transition: transform .18s ease;
        }

        .service-select-button[aria-expanded="true"] {
            border-color: var(--navy-light);
            box-shadow: 0 0 0 3px rgba(23,61,104,.08);
        }

        .service-select-button[aria-expanded="true"]::after {
            transform: translateY(-20%) rotate(225deg);
        }

        .service-select-button.selected {
            color: var(--navy);
            font-weight: 600;
            font-style: normal;
        }

        .service-select .dropdown-menu {
            width: 100%;
            margin-top: 6px !important;
            padding: 6px;
            border: 1px solid var(--border);
            border-radius: 10px;
            background: white;
            box-shadow: 0 10px 25px rgba(11,35,65,.12);
        }

        .service-select .dropdown-item {
            padding: 10px 12px;
            border-radius: 7px;
            color: var(--navy);
            font-size: 12px;
            font-weight: 500;
        }

        .service-select .dropdown-item:hover,
        .service-select .dropdown-item:focus {
            background: #f1f4f8;
            color: var(--navy);
        }

        /* GRID INSTANSI */
        .kiosk-content {
            flex: 1;
            padding: 25px 30px 20px;
        }

        .section-header {
            display: flex;
            align-items: flex-end;
            justify-content: space-between;
            gap: 20px;
            margin-bottom: 18px;
        }

        .section-title {
            margin: 0;
            font-size: 20px;
            font-weight: 750;
            color: var(--navy);
        }

        .section-subtitle {
            margin: 4px 0 0;
            font-size: 13px;
            color: var(--gray);
        }

        .section-badge {
            display: flex;
            align-items: center;
            gap: 7px;
            padding: 7px 12px;
            border-radius: 20px;
            background: #eef2f7;
            color: var(--navy);
            font-size: 11px;
            font-weight: 600;
        }

        .section-badge i {
            color: var(--yellow-dark);
        }

        .instansi-grid {
            display: grid;
            grid-template-columns: repeat(5,minmax(0,1fr));
            gap: 14px;
        }

        .instansi-card {
            position: relative;
            width: 100%;
            min-height: 125px;
            padding: 15px 12px;
            border: 1px solid var(--border);
            border-radius: 14px;
            background: white;
            color: var(--navy);
            cursor: pointer;
            overflow: hidden;
            transition: transform .18s ease,box-shadow .18s ease,border-color .18s ease;
        }

        .instansi-card::before {
            content: "";
            position: absolute;
            left: 0;
            top: 0;
            bottom: 0;
            width: 4px;
            background: var(--yellow);
            transform: scaleY(0);
            transform-origin: center;
            transition: transform .18s ease;
        }

        .instansi-card:hover {
            transform: translateY(-3px);
            border-color: rgba(11,35,65,.25);
            box-shadow: 0 8px 20px rgba(11,35,65,.12);
        }

        .instansi-card:hover::before {
            transform: scaleY(1);
        }

        .instansi-card:active {
            transform: translateY(-1px);
        }

        .instansi-card-inner {
            height: 100%;
            min-height: 92px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        .instansi-logo {
            width: 64px;
            height: 64px;
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: none;
        }

        .instansi-logo img {
            max-width: 100%;
            max-height: 100%;
            object-fit: contain;
            display: block;
            mix-blend-mode: multiply;
        }

        .instansi-name {
            width: 100%;
            text-align: center;
            font-size: 13px;
            line-height: 1.25;
            font-weight: 650;
            color: var(--navy);
        }

        .instansi-status {
            grid-column: 1 / -1;
            color: var(--gray);
            font-size: 13px;
        }

        /* FOOTER LOGOUT */
        .kiosk-bottom {
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: flex-end;
            padding: 12px 30px;
            background: white;
            border-top: 1px solid #d1d5db;
        }

        .btn-logout {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 80px;
            padding: 7px 14px;
            border: none;
            border-radius: 8px;
            background: #e83243;
            color: white;
            font-size: 12px;
            font-weight: 700;
            text-decoration: none;
            cursor: pointer;
            transition: background .2s ease;
        }

        .btn-logout:hover {
            background: #c92334;
            color: white;
        }

        /* MODAL */
        .modal-content {
            border: none;
            border-radius: 18px;
            overflow: hidden;
            box-shadow: 0 20px 50px rgba(0,0,0,.25);
        }

        .modal-header {
            background: var(--navy);
            color: white;
            border-bottom: none;
            padding: 20px 22px;
        }

        .modal-title {
            font-size: 17px;
            font-weight: 700;
        }

        .modal-header .btn-close {
            filter: brightness(0) invert(1);
            opacity: .8;
        }

        .modal-body {
            padding: 25px;
        }

        .booking-info,
        .selected-instansi {
            padding: 14px;
            border-radius: 11px;
            background: #f1f4f8;
            border-left: 4px solid var(--yellow);
            margin-bottom: 20px;
        }

        .booking-info-label,
        .selected-instansi-label {
            font-size: 11px;
            color: var(--gray);
        }

        .booking-info-name,
        .selected-instansi-name {
            margin-top: 3px;
            font-size: 17px;
            font-weight: 700;
            color: var(--navy);
        }

        .date-title {
            margin-bottom: 11px;
            font-size: 13px;
            font-weight: 700;
            color: var(--navy);
        }

        .date-grid {
            display: grid;
            grid-template-columns: repeat(5,1fr);
            gap: 9px;
        }

        .date-option {
            min-height: 76px;
            padding: 9px 5px;
            border: 1px solid var(--border);
            border-radius: 10px;
            background: white;
            cursor: pointer;
            text-align: center;
            transition: all .18s ease;
        }

        .date-option:hover:not(.disabled) {
            border-color: var(--navy);
            transform: translateY(-2px);
        }

        .date-option.active {
            background: var(--navy);
            border-color: var(--navy);
            color: white;
        }

        .date-option.disabled {
            background: #e5e8ec;
            color: #9aa1aa;
            border-color: #d9dde2;
            cursor: not-allowed;
            opacity: .75;
        }

        .date-day {
            display: block;
            font-size: 10px;
            font-weight: 600;
            text-transform: uppercase;
        }

        .date-number {
            display: block;
            margin-top: 4px;
            font-size: 20px;
            line-height: 1;
            font-weight: 750;
        }

        .date-month {
            display: block;
            margin-top: 4px;
            font-size: 9px;
        }

        .queue-title {
            margin-bottom: 12px;
            font-size: 14px;
            font-weight: 700;
            color: var(--navy);
        }

        .queue-options {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
        }

        .queue-option {
            border: 2px solid var(--border);
            background: white;
            border-radius: 13px;
            padding: 18px 12px;
            cursor: pointer;
            text-align: center;
            transition: all .18s ease;
        }

        .queue-option:hover {
            border-color: var(--navy-light);
        }

        .queue-option.active {
            border-color: var(--yellow);
            background: #fff9df;
        }

        .queue-option-icon {
            width: 43px;
            height: 43px;
            margin: 0 auto 9px;
            border-radius: 50%;
            background: var(--navy);
            color: var(--yellow);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
        }

        .queue-option-name {
            font-size: 14px;
            font-weight: 700;
            color: var(--navy);
        }

        .queue-option-desc {
            margin-top: 3px;
            font-size: 11px;
            color: var(--gray);
        }

        .error-message {
            display: none;
            margin-top: 14px;
            padding: 10px 12px;
            border-radius: 8px;
            background: #fff0f0;
            color: #b42318;
            font-size: 12px;
        }

        .modal-footer {
            border-top: 1px solid #edf0f3;
            padding: 15px 20px;
        }

        .btn-kiosk-primary,
        .btn-kiosk-yellow {
            border: none;
            padding: 10px 20px;
            border-radius: 9px;
            font-weight: 700;
        }

        .btn-kiosk-primary {
            background: var(--navy);
            color: white;
        }

        .btn-kiosk-primary:hover {
            background: var(--navy-light);
            color: white;
        }

        .btn-kiosk-yellow {
            background: var(--yellow);
            color: var(--navy);
        }

        .btn-kiosk-yellow:hover {
            background: var(--yellow-dark);
            color: var(--navy);
        }

        /* STRUK ANTREAN (hitam putih, sama dengan hasil cetak) */
        .receipt {
            position: relative;
            overflow: hidden;
            max-width: 300px;
            margin: 0 auto;
            padding: 26px 22px;
            background: #fff;
            color: #000;
            text-align: center;
            border: 1px dashed #b8bec6;
            border-radius: 6px;
            font-family: "Segoe UI", Arial, sans-serif;
        }

        /* WATERMARK MIRING (SVG, di belakang isi struk) */
        .receipt-watermark {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 0;
            pointer-events: none;
            user-select: none;
        }

        .receipt > *:not(.receipt-watermark) {
            position: relative;
            z-index: 1;
        }

        .receipt-header {
            margin: 0;
            font-size: 15px;
            font-weight: 800;
            line-height: 1.45;
            letter-spacing: .3px;
        }

        .receipt-divider {
            margin: 18px 0;
            border-top: 1px dashed #000;
        }

        .receipt-label {
            display: inline-block;
            margin-bottom: 6px;
            font-size: 12px;
            font-weight: 700;
            letter-spacing: 1px;
            text-decoration: underline;
            text-decoration-thickness: 1.5px;
            text-underline-offset: 4px;
        }

        .receipt-number {
            margin: 8px 0 6px;
            font-size: 64px;
            font-weight: 800;
            line-height: 1.05;
        }

        .receipt-layanan {
            margin: 2px 0 8px;
            font-size: 15px;
            font-weight: 600;
            line-height: 1.3;
            word-break: break-word;
        }

        .receipt-layanan b {
            display: block;
            margin-top: 2px;
            font-size: 21px;
            font-weight: 800;
        }

        .receipt-priority {
            display: inline-block;
            margin-top: 6px;
            padding: 3px 12px;
            border: 1.5px solid #000;
            font-size: 12px;
            font-weight: 800;
            letter-spacing: .8px;
        }

        .receipt-lines {
            text-align: left;
            font-size: 12.5px;
            line-height: 1.6;
        }

        .receipt-lines div {
            margin-bottom: 8px;
        }

        .receipt-lines div:last-child {
            margin-bottom: 0;
        }

        .receipt-note {
            margin: 0;
            padding: 0 6px;
            font-size: 11.5px;
            line-height: 1.6;
        }

        /* RESPONSIVE */
        @media (max-width: 1199px) {
            .instansi-grid {
                grid-template-columns: repeat(4,minmax(0,1fr));
            }
        }

        @media (max-width: 991px) {
            .instansi-grid {
                grid-template-columns: repeat(3,minmax(0,1fr));
            }

            .toolbar {
                align-items: flex-start;
                flex-direction: column;
            }

            .service-select-wrapper {
                width: 100%;
            }

            .kiosk-wrapper {
                padding: 15px;
            }

            .kiosk-container {
                min-height: calc(100vh - 30px);
            }

            .kiosk-content {
                padding: 22px;
            }

            .header-building {
                max-width: 42%;
            }
        }

        @media (max-width: 767px) {
            .instansi-grid {
                grid-template-columns: repeat(2,minmax(0,1fr));
            }

            .kiosk-header {
                min-height: 115px;
            }

            .header-building {
                max-width: 50%;
                opacity: .5;
            }

            .header-title {
                font-size: 24px;
            }

            .header-eyebrow {
                font-size: 12px;
                letter-spacing: 2px;
            }

            .section-header {
                align-items: flex-start;
                flex-direction: column;
            }

            .section-badge {
                display: none;
            }

            .date-grid {
                grid-template-columns: repeat(3,1fr);
            }
        }

        @media (max-width: 575px) {
            .kiosk-wrapper {
                padding: 0;
            }

            .kiosk-container {
                border-radius: 0;
                min-height: 100vh;
            }

            .kiosk-header {
                padding: 16px 18px;
            }

            .header-content {
                gap: 13px;
            }

            .header-logo {
                width: 70px;
                height: 70px;
                min-width: 70px;
            }

            .header-building {
                max-width: 55%;
                opacity: .3;
            }

            .header-title {
                font-size: 18px;
            }

            .header-eyebrow {
                font-size: 10px;
                letter-spacing: 1.5px;
            }

            .header-eyebrow::before {
                width: 18px;
            }

            .toolbar {
                padding: 15px;
            }

            .kiosk-content {
                padding: 18px 15px;
            }

            .instansi-grid {
                grid-template-columns: repeat(2,minmax(0,1fr));
                gap: 10px;
            }

            .instansi-card {
                min-height: 105px;
            }

            .queue-options {
                grid-template-columns: 1fr;
            }

            .date-grid {
                grid-template-columns: repeat(3,1fr);
            }

            .kiosk-bottom {
                padding: 15px;
            }
        }

        /* PRINT STRUK THERMAL 80MM */
        @media print {
            /* Ukuran kertas ditentukan driver printer (set "80mm x Roll" di printer thermal) */
            @page {
                margin: 0;
            }

            html,
            body {
                width: 100% !important;
                min-width: 0 !important;
                max-width: none !important;
                height: auto !important;
                min-height: 0 !important;
                margin: 0 !important;
                padding: 0 !important;
                background: white !important;
                overflow: visible !important;
                display: block !important;
            }

            .kiosk-wrapper,
            .kiosk-container {
                width: 100% !important;
                min-width: 0 !important;
                max-width: none !important;
                height: auto !important;
                min-height: 0 !important;
                margin: 0 !important;
                padding: 0 !important;
                background: white !important;
                display: block !important;
                border: none !important;
                border-radius: 0 !important;
                box-shadow: none !important;
                overflow: visible !important;
            }

            .kiosk-header,
            .toolbar,
            .kiosk-content,
            .kiosk-bottom,
            #modalTanggal,
            #modalValidasi,
            .modal-backdrop {
                display: none !important;
            }

            #modalReceipt,
            #modalReceipt .modal-dialog,
            #modalReceipt .modal-content,
            #modalReceipt .modal-body {
                position: static !important;
                display: block !important;
                width: 100% !important;
                min-width: 0 !important;
                max-width: none !important;
                height: auto !important;
                min-height: 0 !important;
                margin: 0 !important;
                padding: 0 !important;
                border: none !important;
                border-radius: 0 !important;
                background: white !important;
                box-shadow: none !important;
                overflow: visible !important;
                opacity: 1 !important;
                visibility: visible !important;
                transform: none !important;
                top: auto !important;
                right: auto !important;
                bottom: auto !important;
                left: auto !important;
                float: none !important;
            }

            #modalReceipt .modal-header,
            #modalReceipt .modal-footer {
                display: none !important;
            }

            #modalReceipt .receipt {
                display: block !important;
                box-sizing: border-box !important;
                width: min(72mm, 100%) !important;
                min-width: 0 !important;
                max-width: 72mm !important;
                height: auto !important;
                min-height: 0 !important;
                margin: 0 auto !important;
                padding: 6mm 3mm 14mm !important;
                border: none !important;
                border-radius: 0 !important;
                background: #fff !important;
                color: #000 !important;
                position: relative !important;
                text-align: center !important;
                overflow: hidden !important;
                break-inside: avoid !important;
                page-break-inside: avoid !important;
            }

            #modalReceipt .receipt * {
                box-sizing: border-box !important;
                color: #000 !important;
                background: none !important;
            }

            #modalReceipt .receipt-watermark {
                display: block !important;
                position: absolute !important;
                top: 0 !important;
                left: 0 !important;
                width: 100% !important;
                height: 100% !important;
                z-index: 0 !important;
            }

            #modalReceipt .receipt > *:not(.receipt-watermark) {
                position: relative !important;
                z-index: 1 !important;
            }

            #modalReceipt .receipt-header {
                font-size: 4.4mm !important;
                font-weight: 800 !important;
                line-height: 1.45 !important;
                letter-spacing: .2mm !important;
            }

            #modalReceipt .receipt-divider {
                margin: 5mm 0 !important;
                border-top: .3mm dashed #000 !important;
            }

            #modalReceipt .receipt-label {
                margin-bottom: 2mm !important;
                font-size: 3.5mm !important;
                font-weight: 700 !important;
                letter-spacing: .4mm !important;
                text-decoration: underline !important;
                text-decoration-thickness: .3mm !important;
                text-underline-offset: 1.1mm !important;
            }

            #modalReceipt .receipt-number {
                margin: 2mm 0 2mm !important;
                font-size: 18mm !important;
                font-weight: 800 !important;
                line-height: 1.05 !important;
            }

            #modalReceipt .receipt-layanan {
                margin: 1mm 0 2.5mm !important;
                font-size: 4.2mm !important;
                font-weight: 600 !important;
                line-height: 1.3 !important;
            }

            #modalReceipt .receipt-layanan b {
                display: block !important;
                margin-top: .6mm !important;
                font-size: 5.8mm !important;
                font-weight: 800 !important;
            }

            #modalReceipt .receipt-priority {
                margin-top: 2mm !important;
                padding: .8mm 3.5mm !important;
                border: .4mm solid #000 !important;
                font-size: 3.6mm !important;
                font-weight: 800 !important;
                letter-spacing: .3mm !important;
            }

            #modalReceipt .receipt-lines {
                text-align: left !important;
                font-size: 3.3mm !important;
                line-height: 1.5 !important;
            }

            #modalReceipt .receipt-lines div {
                margin: 0 0 2.4mm !important;
            }

            #modalReceipt .receipt-lines div:last-child {
                margin-bottom: 0 !important;
            }

            #modalReceipt .receipt-note {
                margin: 0 !important;
                padding: 0 1mm !important;
                font-size: 3.1mm !important;
                line-height: 1.55 !important;
            }

            .modal.fade,
            .modal.show {
                opacity: 1 !important;
            }

            #modalReceipt.fade {
                transition: none !important;
            }

            #modalReceipt .modal-dialog-centered {
                display: block !important;
                min-height: 0 !important;
            }
        }
    </style>
</head>

<body>
    <div class="kiosk-wrapper">
        <div class="kiosk-container">

            <!-- HEADER -->
            <header class="kiosk-header">

                <img
                    src="<?= base_url('assets/banner.png') ?>"
                    alt=""
                    class="header-building"
                >

                <div class="header-content">
                    <div class="header-logo">
                        <img src="<?= base_url('assets/mpp2.png') ?>" alt="Logo Kota Tangerang">
                    </div>

                    <div class="header-info">
                        <p class="header-eyebrow">Selamat Datang di</p>

                        <h1 class="header-title">
                            Mal Pelayanan Publik <span>Kota Tangerang</span>
                        </h1>
                    </div>
                </div>
            </header>

            <!-- TOOLBAR -->
            <div class="toolbar">
                <div class="toolbar-left">
                    <div>
                        <p class="toolbar-title">Layanan Antrean</p>
                        <p class="toolbar-description">Pilih jenis layanan yang ingin digunakan</p>
                    </div>
                </div>

                <div class="service-select-wrapper">
                    <span class="service-select-label">Jenis Layanan</span>

                    <div class="dropdown service-select">
                        <button type="button" class="service-select-button"
                            id="jenisLayananBtn"
                            data-bs-toggle="dropdown"
                            aria-expanded="false"
                            aria-haspopup="true">
                            <span id="jenisLayananText">Pilih</span>
                        </button>

                        <ul class="dropdown-menu" aria-labelledby="jenisLayananBtn">
                            <li>
                                <button type="button" class="dropdown-item"
                                    onclick="ubahLayanan('HARI_INI', 'Antrian Hari Ini')">
                                    Antrian Hari Ini
                                </button>
                            </li>
                            <li>
                                <button type="button" class="dropdown-item"
                                    onclick="ubahLayanan('BOOKING', 'Booking')">
                                    Booking
                                </button>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- DAFTAR INSTANSI -->
            <main class="kiosk-content">
                <div class="section-header">
                    <div>
                        <h2 class="section-title">Pilih Instansi</h2>
                        <p class="section-subtitle" id="sectionSubtitle">
                            Silakan pilih instansi yang ingin Anda kunjungi
                        </p>
                    </div>

                    <div class="section-badge">
                        <i class="bi bi-hand-index-thumb"></i>
                        Ketuk pilihan layanan
                    </div>
                </div>

                <div class="instansi-grid" id="instansiGrid" aria-live="polite">
                    <p class="instansi-status">Memuat daftar instansi...</p>
                </div>
            </main>

            <!-- TOMBOL LOGOUT -->
            <footer class="kiosk-bottom">
                <a href="<?= site_url('logout') ?>" class="btn-logout">
                    LOGOUT
                </a>
            </footer>

        </div>
    </div>

    <!-- MODAL TANGGAL BOOKING -->
    <div class="modal fade" id="modalTanggal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Pilih Tanggal Booking</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>

                <div class="modal-body">
                    <div class="booking-info">
                        <div class="booking-info-label">Instansi yang dipilih</div>
                        <div class="booking-info-name" id="bookingInstansi">-</div>
                    </div>

                    <div class="date-title">Pilih tanggal pelayanan</div>
                    <div class="date-grid" id="dateGrid" aria-live="polite"></div>

                    <div class="error-message" id="errorTanggal">
                        <i class="bi bi-exclamation-circle me-1"></i>
                        Silakan pilih tanggal terlebih dahulu.
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-kiosk-primary" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-kiosk-yellow" onclick="konfirmasiTanggal()">
                        Lanjutkan <i class="bi bi-arrow-right ms-1"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- MODAL PILIH JENIS ANTREAN -->
    <div class="modal fade" id="modalValidasi" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Pilih Jenis Antrean</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>

                <div class="modal-body">
                    <div class="selected-instansi">
                        <div class="selected-instansi-label">Instansi yang dipilih</div>
                        <div class="selected-instansi-name" id="namaInstansi">-</div>
                    </div>

                    <div class="queue-title">Silakan pilih jenis antrean</div>

                    <div id="informasiKuota" class="booking-info" role="status" aria-live="polite">
                        Memeriksa kuota...
                    </div>

                    <div class="queue-options">
                        <div class="queue-option" role="button" tabindex="0"
                            data-jenis="BIASA"
                            onclick="pilihJenis('BIASA', this)"
                            onkeydown="if(event.key==='Enter'||event.key===' '){event.preventDefault();pilihJenis('BIASA',this)}">
                            <div class="queue-option-icon"><i class="bi bi-person"></i></div>
                            <div class="queue-option-name">Antrean Biasa</div>
                            <div class="queue-option-desc">Untuk masyarakat umum</div>
                        </div>

                        <div class="queue-option" role="button" tabindex="0"
                            data-jenis="PRIORITAS"
                            onclick="pilihJenis('PRIORITAS', this)"
                            onkeydown="if(event.key==='Enter'||event.key===' '){event.preventDefault();pilihJenis('PRIORITAS',this)}">
                            <div class="queue-option-icon"><i class="bi bi-person-check"></i></div>
                            <div class="queue-option-name">Antrean Prioritas</div>
                            <div class="queue-option-desc">Lansia, disabilitas, dll.</div>
                        </div>
                    </div>

                    <div class="error-message" id="errorJenis">
                        <i class="bi bi-exclamation-circle me-1"></i>
                        Silakan pilih jenis antrean terlebih dahulu.
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-kiosk-primary" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-kiosk-yellow" id="btnAmbilNomor" onclick="konfirmasiAntrean()">
                        Ambil Nomor <i class="bi bi-arrow-right ms-1"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- MODAL INFORMASI -->
    <div class="modal fade" id="modalInformasi" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <i class="bi bi-info-circle me-2"></i>Informasi!
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>

                <div class="modal-body text-center py-4">
                    <div class="mb-3" style="font-size:42px;color:var(--yellow-dark)">
                        <i class="bi bi-exclamation-circle"></i>
                    </div>
                    <p id="pesanInformasi" class="fw-semibold mb-0" role="status"></p>
                </div>

                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-kiosk-primary" data-bs-dismiss="modal">Tutup</button>
                    <button type="button" class="btn btn-kiosk-yellow d-none" id="btnBookingSekarang">
                        Booking Sekarang <i class="bi bi-calendar-event ms-1"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- MODAL STRUK -->
    <div class="modal fade" id="modalReceipt" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Nomor Antrean</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>

                <div class="modal-body">
                    <div class="receipt">

                        <!-- Watermark miring rapat & merata (SVG: ikut tercetak walau "background graphics" mati) -->
                        <svg class="receipt-watermark" aria-hidden="true" focusable="false" xmlns="http://www.w3.org/2000/svg">
                            <defs>
                                <pattern id="polaWatermark" width="210" height="96"
                                         patternUnits="userSpaceOnUse" patternTransform="rotate(-28)">
                                    <!-- baris 1: tengah tile -->
                                    <text x="105" y="24" text-anchor="middle"
                                          font-family="Segoe UI, Arial, sans-serif"
                                          font-size="8.5" font-weight="700" letter-spacing="1"
                                          fill="#000" fill-opacity=".08">MPP KOTA TANGERANG</text>
                                    <!-- baris 2: digeser setengah tile -->
                                    <text x="0" y="72" text-anchor="middle"
                                          font-family="Segoe UI, Arial, sans-serif"
                                          font-size="8.5" font-weight="700" letter-spacing="1"
                                          fill="#000" fill-opacity=".08">MPP KOTA TANGERANG</text>
                                    <text x="210" y="72" text-anchor="middle"
                                          font-family="Segoe UI, Arial, sans-serif"
                                          font-size="8.5" font-weight="700" letter-spacing="1"
                                          fill="#000" fill-opacity=".08">MPP KOTA TANGERANG</text>
                                </pattern>
                            </defs>
                            <rect width="100%" height="100%" fill="url(#polaWatermark)"/>
                        </svg>

                        <p class="receipt-header">MAL PELAYANAN PUBLIK<br>KOTA TANGERANG</p>

                        <div class="receipt-divider"></div>

                        <div class="receipt-label">NOMOR ANTRIAN</div>
                        <div class="receipt-number" id="nomorAntrean">-</div>
                        <div class="receipt-layanan">Layanan:<br><b id="receiptInstansi">-</b></div>
                        <div class="receipt-priority d-none" id="receiptPrioritas">ANTRIAN PRIORITAS</div>

                        <div class="receipt-divider"></div>

                        <div class="receipt-lines">
                            <div>Tanggal Antrian: <b id="receiptTanggal">-</b></div>
                            <div>Jam Pelayanan: <b>08.00 - 15.00 WIB</b></div>
                            <div>Nomor WA Pengaduan: <b>0852-8000-0191</b></div>
                        </div>

                        <div class="receipt-divider"></div>

                        <p class="receipt-note">Jika Antrian terlewat mohon tunggu panggilan berikutnya.</p>
                    </div>
                </div>

                <div class="modal-footer">
                    <span id="statusCetak" class="me-auto small text-muted" role="status" aria-live="polite"></span>
                    <button type="button" class="btn btn-kiosk-primary" onclick="cetakStruk()">
                        <i class="bi bi-printer me-1"></i> Cetak Ulang
                    </button>
                    <button type="button" class="btn btn-kiosk-yellow" data-bs-dismiss="modal">Selesai</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        /* KONFIGURASI API DAN STATE */
        const API = {
            instansi: <?= json_encode(site_url('masyarakat/instansi')) ?>,
            hariLibur: <?= json_encode(site_url('masyarakat/hari-libur')) ?>,
            antrean: <?= json_encode(site_url('masyarakat/antrean')) ?>,
            kuotaBase: <?= json_encode(site_url('masyarakat/kuota')) ?>
        };

        let instansiId = null;
        let instansiNama = null;
        let jenisAntrean = null;
        let jenisLayanan = '';
        let tanggalBooking = null;
        let sedangMengambilAntrean = false;
        let kalenderRequest = 0;
        let pemeriksaanKuota = 0;
        let informasiTerakhir = null;
        let pemeriksaanAwal = 0;
        let kuotaBolehDiambil = false;

        const csrfNama = <?= json_encode(csrf_token()) ?>;
        let csrfHashAktif = <?= json_encode(csrf_hash()) ?>;

        function tampilkanPopupInformasi(pesan, tawarkanBooking = false) {
            document.getElementById('pesanInformasi').textContent = pesan;
            document.getElementById('btnBookingSekarang').classList.toggle('d-none', !tawarkanBooking);
            bootstrap.Modal.getOrCreateInstance(document.getElementById('modalInformasi')).show();
        }

        function tanganiKuotaTidakTersedia(data) {
            if (data.status_loket === 'TUTUP') {
                tampilkanPopupInformasi('Layanan belum dibuka oleh petugas!');
                return true;
            }

            if (data.bisa_ambil === false) {
                if (jenisLayanan === 'HARI_INI') {
                    tampilkanPopupInformasi(
                        'Kuota antrean hari ini sudah habis. Silakan melakukan booking untuk tanggal pelayanan berikutnya.',
                        true
                    );
                } else {
                    tampilkanPopupInformasi('Kuota booking pada tanggal yang dipilih sudah habis. Silakan pilih tanggal booking lainnya.');
                }
                return true;
            }

            return false;
        }

        function arahkanKeBooking() {
            const popup = document.getElementById('modalInformasi');

            popup.addEventListener('hidden.bs.modal', () => {
                ubahLayanan('BOOKING', 'Booking');
                instansiId = informasiTerakhir?.id ?? null;
                instansiNama = informasiTerakhir?.nama ?? null;

                if (instansiId && instansiNama) bukaTanggalBooking();
            }, { once: true });

            informasiTerakhir = { id: instansiId, nama: instansiNama };
            bootstrap.Modal.getOrCreateInstance(popup).hide();
        }

        document.getElementById('btnBookingSekarang').addEventListener('click', arahkanKeBooking);

        function setTombolAntrean(aktif) {
            kuotaBolehDiambil = Boolean(aktif);
            document.getElementById('btnAmbilNomor').disabled = !kuotaBolehDiambil || sedangMengambilAntrean;
        }

        /* LOGO INSTANSI */
        const BASE_ASSETS = <?= json_encode(rtrim(base_url('assets'), '/')) ?>;
        const LOGO_DEFAULT = 'logokota.png';

        const logoMap = {
            'ATR BPN': 'atr bpn.png',
            'BANK BANTEN': 'bank banten.png',
            'BANK BJB': 'bank bjb.png',
            'BAPENDA': 'bapenda.jpg',
            'BAZNAS': 'baznas.png',
            'BNN': 'bnn-logo.jpg',
            'BPJS KESEHATAN': 'BPJS Kesehatan.png',
            'BPJS KETENAGAKERJAAN': 'BPJS Ketenagakerjaan.png',
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
            'SAMSAT': 'samsat2.png',
            'TASPEN': 'taspen.png'
        };

        function normalisasiNamaInstansi(nama) {
            return String(nama || '')
                .trim()
                .toUpperCase()
                .replace(/\./g, '')
                .replace(/\s+/g, ' ');
        }

        function urlLogo(file) {
            return BASE_ASSETS + '/' + encodeURIComponent(file);
        }

        function formatTanggalAPI(date) {
            return [
                date.getFullYear(),
                String(date.getMonth() + 1).padStart(2, '0'),
                String(date.getDate()).padStart(2, '0')
            ].join('-');
        }

        // Format di struk: 09-11-2026
        function formatTanggalStruk(date) {
            return [
                String(date.getDate()).padStart(2, '0'),
                String(date.getMonth() + 1).padStart(2, '0'),
                date.getFullYear()
            ].join('-');
        }

        /* INSTANSI DARI MYSQL */
        async function loadInstansi() {
            const grid = document.getElementById('instansiGrid');
            grid.innerHTML = '<p class="instansi-status">Memuat daftar instansi...</p>';

            try {
                const response = await fetch(API.instansi, { cache: 'no-store' });
                const hasil = await response.json();

                if (!response.ok || !hasil.status || !Array.isArray(hasil.data)) {
                    throw new Error(hasil.message || 'Gagal memuat daftar instansi.');
                }

                grid.replaceChildren();

                if (hasil.data.length === 0) {
                    grid.innerHTML = '<p class="instansi-status">Belum ada instansi.</p>';
                    return;
                }

                hasil.data.forEach(item => {
                    const id = Number(item.id);
                    const nama = String(item.nama_instansi || '').trim();

                    if (!Number.isSafeInteger(id) || id < 1 || !nama) return;

                    const button = document.createElement('button');
                    button.type = 'button';
                    button.className = 'instansi-card';

                    const inner = document.createElement('div');
                    inner.className = 'instansi-card-inner';

                    const logoBox = document.createElement('div');
                    logoBox.className = 'instansi-logo';

                    const kunci = normalisasiNamaInstansi(nama);
                    const logo = document.createElement('img');
                    logo.src = urlLogo(logoMap[kunci] || LOGO_DEFAULT);
                    logo.alt = 'Logo ' + nama;
                    logo.loading = 'lazy';

                    logo.addEventListener('error', () => {
                        if (!logo.dataset.fallback) {
                            logo.dataset.fallback = '1';
                            logo.src = urlLogo(LOGO_DEFAULT);
                        }
                    });

                    logoBox.appendChild(logo);

                    const nameBox = document.createElement('div');
                    nameBox.className = 'instansi-name';
                    nameBox.textContent = nama;

                    inner.append(logoBox, nameBox);
                    button.appendChild(inner);
                    button.addEventListener('click', () => pilihInstansi(id, nama));
                    grid.appendChild(button);
                });
            } catch (error) {
                console.error('Load instansi:', error);
                grid.replaceChildren();

                const message = document.createElement('p');
                message.className = 'instansi-status';
                message.textContent = 'Gagal memuat instansi. Silakan refresh halaman.';
                grid.appendChild(message);
            }
        }

        /* PILIH LAYANAN DAN INSTANSI */
        function ubahLayanan(value, label) {
            ++pemeriksaanAwal;
            ++pemeriksaanKuota;

            jenisLayanan = value;
            instansiId = null;
            instansiNama = null;
            jenisAntrean = null;
            tanggalBooking = null;

            document.getElementById('jenisLayananText').textContent = label;
            document.getElementById('jenisLayananBtn').classList.add('selected');

            document.getElementById('sectionSubtitle').textContent = value === 'BOOKING'
                ? 'Pilih instansi untuk melakukan booking layanan'
                : 'Pilih instansi untuk mengambil nomor antrean hari ini';
        }

        async function cekKuotaInstansi(id, tanggal) {
            const url = `${API.kuotaBase}/${encodeURIComponent(id)}?tanggal=${encodeURIComponent(tanggal)}`;

            const response = await fetch(url, {
                headers: { 'Accept': 'application/json' },
                cache: 'no-store'
            });

            const hasil = await response.json();

            if (!response.ok || !hasil.status || !hasil.data) {
                throw new Error(hasil.message || 'Gagal memeriksa kuota.');
            }

            const data = hasil.data;

            if (!['AKTIF', 'NONAKTIF'].includes(
                    String(data.status_instansi || '').toUpperCase()
                ) ||
                typeof data.bisa_ambil !== 'boolean') {
                throw new Error('Respons API kuota belum sesuai. Periksa backend.');
            }

            return data;
        }

        function tampilkanInfoKuota(data) {
            const info = document.getElementById('informasiKuota');
            if (!info) return;

            info.textContent = data.status_loket === 'TUTUP'
                ? 'Loket sedang ditutup.'
                : `Kuota ${data.kategori === 'BOOKING' ? 'booking' : 'hari ini'}: ${data.terpakai} dari ${data.kuota_aktif} terpakai, ${data.tersisa} tersisa.`;

            setTombolAntrean(data.bisa_ambil === true);
        }

        async function perbaruiInfoKuota(tanggal) {
            const requestId = ++pemeriksaanKuota;
            const info = document.getElementById('informasiKuota');

            setTombolAntrean(false);
            if (info) info.textContent = 'Memeriksa kuota...';

            try {
                const data = await cekKuotaInstansi(instansiId, tanggal);

                if (requestId !== pemeriksaanKuota) return;
                tampilkanInfoKuota(data);
            } catch (error) {
                if (requestId !== pemeriksaanKuota) return;

                setTombolAntrean(false);
                if (info) info.textContent = error.message;
            }
        }

        async function pilihInstansi(id, nama) {
            if (!jenisLayanan) {
                alert('Silakan pilih jenis layanan terlebih dahulu.');
                return;
            }

            const requestId = ++pemeriksaanAwal;

            instansiId = id;
            instansiNama = nama;
            jenisAntrean = null;
            tanggalBooking = null;

            if (jenisLayanan === 'BOOKING') {
                bukaTanggalBooking();
                return;
            }

            try {
                const data = await cekKuotaInstansi(id, formatTanggalAPI(new Date()));

                if (requestId !== pemeriksaanAwal || instansiId !== id || jenisLayanan !== 'HARI_INI') return;
                if (tanganiKuotaTidakTersedia(data)) return;

                bukaModalJenisAntrean();
            } catch (error) {
                if (requestId !== pemeriksaanAwal) return;
                tampilkanPopupInformasi(error.message || 'Gagal memeriksa kuota. Silakan coba lagi.');
            }
        }

        function bukaModalJenisAntrean() {
            jenisAntrean = null;
            setTombolAntrean(false);

            document.getElementById('namaInstansi').textContent = instansiNama;
            document.getElementById('errorJenis').style.display = 'none';

            document.querySelectorAll('.queue-option').forEach(item => {
                item.classList.remove('active');
                item.setAttribute('aria-pressed', 'false');
            });

            bootstrap.Modal.getOrCreateInstance(document.getElementById('modalValidasi')).show();

            const tanggal = jenisLayanan === 'BOOKING' && tanggalBooking
                ? formatTanggalAPI(tanggalBooking)
                : formatTanggalAPI(new Date());

            perbaruiInfoKuota(tanggal);
        }

        /* KALENDER BOOKING H+1 SAMPAI H+7 */
        function bukaTanggalBooking() {
            tanggalBooking = null;

            document.getElementById('bookingInstansi').textContent = instansiNama;
            document.getElementById('errorTanggal').style.display = 'none';

            bootstrap.Modal.getOrCreateInstance(document.getElementById('modalTanggal')).show();
            generateTanggal();
        }

        async function generateTanggal() {
            const requestId = ++kalenderRequest;
            const grid = document.getElementById('dateGrid');

            grid.textContent = 'Memuat kalender...';
            tanggalBooking = null;

            let daftarHariLibur;

            try {
                const response = await fetch(API.hariLibur, { cache: 'no-store' });
                const hasil = await response.json();

                if (!response.ok || !hasil.status || !Array.isArray(hasil.data)) {
                    throw new Error(hasil.message || 'Gagal mengambil hari libur.');
                }

                daftarHariLibur = hasil.data;
            } catch (error) {
                if (requestId !== kalenderRequest) return;

                console.error('Kalender booking:', error);
                grid.textContent = 'Kalender gagal dimuat. Silakan coba lagi.';
                return;
            }

            if (requestId !== kalenderRequest) return;

            const tanggalLibur = new Set(daftarHariLibur.map(item => item.tanggal));
            const namaHari = ['Minggu','Senin','Selasa','Rabu','Kamis','Jumat','Sabtu'];
            const namaBulan = ['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agu','Sep','Okt','Nov','Des'];

            const hariIni = new Date();
            hariIni.setHours(0, 0, 0, 0);

            grid.replaceChildren();

            for (let i = 1; i <= 7; i++) {
                const tanggal = new Date(hariIni);
                tanggal.setDate(hariIni.getDate() + i);

                const tanggalString = formatTanggalAPI(tanggal);
                const akhirPekan = tanggal.getDay() === 0 || tanggal.getDay() === 6;
                const liburAdmin = tanggalLibur.has(tanggalString);
                const disabled = akhirPekan || liburAdmin;

                const button = document.createElement('button');
                button.type = 'button';
                button.className = 'date-option' + (disabled ? ' disabled' : '');
                button.disabled = disabled;

                button.innerHTML = `
                    <span class="date-day">${namaHari[tanggal.getDay()]}</span>
                    <span class="date-number">${tanggal.getDate()}</span>
                    <span class="date-month">${namaBulan[tanggal.getMonth()]}</span>
                `;

                if (liburAdmin) {
                    const dataLibur = daftarHariLibur.find(item => item.tanggal === tanggalString);
                    button.title = dataLibur?.nama || 'Hari libur';
                } else if (akhirPekan) {
                    button.title = 'Akhir pekan';
                } else {
                    button.addEventListener('click', () => pilihTanggal(tanggal, button));
                }

                grid.appendChild(button);
            }
        }

        function pilihTanggal(date, element) {
            if (element.disabled) return;

            tanggalBooking = new Date(date);

            document.querySelectorAll('.date-option').forEach(item => {
                item.classList.remove('active');
            });

            element.classList.add('active');
            document.getElementById('errorTanggal').style.display = 'none';
        }

        function konfirmasiTanggal() {
            if (!tanggalBooking) {
                document.getElementById('errorTanggal').style.display = 'block';
                return;
            }

            const modalTanggal = document.getElementById('modalTanggal');

            modalTanggal.addEventListener('hidden.bs.modal', bukaModalJenisAntrean, { once: true });
            bootstrap.Modal.getOrCreateInstance(modalTanggal).hide();
        }

        /* PILIH JENIS ANTREAN */
        function pilihJenis(jenis, element) {
            jenisAntrean = jenis;

            document.querySelectorAll('.queue-option').forEach(item => {
                item.classList.remove('active');
                item.setAttribute('aria-pressed', 'false');
            });

            element.classList.add('active');
            element.setAttribute('aria-pressed', 'true');

            document.getElementById('errorJenis').style.display = 'none';
        }

        /* SIMPAN ANTREAN DAN TAMPILKAN STRUK */
        async function konfirmasiAntrean() {
            if (sedangMengambilAntrean || !kuotaBolehDiambil) return;

            if (!instansiId) {
                alert('Silakan pilih instansi terlebih dahulu.');
                return;
            }

            if (!['BIASA', 'PRIORITAS'].includes(jenisAntrean)) {
                document.getElementById('errorJenis').style.display = 'block';
                return;
            }

            const tanggalDipilih = jenisLayanan === 'BOOKING' ? tanggalBooking : new Date();

            if (!(tanggalDipilih instanceof Date) || Number.isNaN(tanggalDipilih.getTime())) {
                alert('Silakan pilih tanggal booking.');
                return;
            }

            const tombol = document.getElementById('btnAmbilNomor');

            sedangMengambilAntrean = true;
            tombol.disabled = true;

            try {
                const tanggalAPI = formatTanggalAPI(tanggalDipilih);
                const kuota = await cekKuotaInstansi(instansiId, tanggalAPI);

                tampilkanInfoKuota(kuota);

                if (kuota.status_loket === 'TUTUP' || !kuota.bisa_ambil) {
                    const modalValidasi = document.getElementById('modalValidasi');

                    modalValidasi.addEventListener('hidden.bs.modal', () => {
                        tanganiKuotaTidakTersedia(kuota);
                    }, { once: true });

                    bootstrap.Modal.getOrCreateInstance(modalValidasi).hide();
                    return;
                }

                const response = await fetch(API.antrean, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': csrfHashAktif
                    },
                    body: JSON.stringify({
                        instansi_id: instansiId,
                        tanggal_antrean: tanggalAPI,
                        jenis_antrean: jenisAntrean
                    })
                });

                const hasil = await response.json();

                if (hasil.csrfHash) csrfHashAktif = hasil.csrfHash;

                if (!response.ok || !hasil.status) {
                    throw new Error(hasil.message || 'Gagal mengambil antrean.');
                }

                const nomor = Number(hasil.data?.nomor_antrean);

                if (!Number.isSafeInteger(nomor) || nomor < 1) {
                    throw new Error('Respons server tidak memuat nomor antrean yang valid. Periksa respons API.');
                }

                document.getElementById('nomorAntrean').textContent = String(nomor);
                document.getElementById('receiptInstansi').textContent = instansiNama;

                document.getElementById('receiptPrioritas').classList.toggle('d-none', jenisAntrean !== 'PRIORITAS');
                document.getElementById('receiptTanggal').textContent = formatTanggalStruk(tanggalDipilih);

                const modalValidasi = document.getElementById('modalValidasi');

                modalValidasi.addEventListener('hidden.bs.modal', cetakStruk, { once: true });

                bootstrap.Modal.getOrCreateInstance(modalValidasi).hide();

            } catch (error) {
                console.error('Ambil antrean:', error);
                alert(error.message);
            } finally {
                sedangMengambilAntrean = false;
                tombol.disabled = !kuotaBolehDiambil;
            }
        }

        /* CETAK STRUK OTOMATIS
           Urutan: popup jenis antrean menutup -> struk langsung dicetak
           (popup struk belum dibuka, jadi tidak ada popup yang tertimpa halaman print)
           -> setelah selesai, popup konfirmasi muncul lalu menutup sendiri. */
        const DURASI_TUTUP_STRUK = 8; // detik

        const modalReceiptEl = document.getElementById('modalReceipt');
        const statusCetakEl = document.getElementById('statusCetak');

        let sedangMencetak = false;
        let timerTutupStruk = null;

        function hentikanTimerStruk() {
            clearInterval(timerTutupStruk);
            timerTutupStruk = null;
        }

        function cetakStruk() {
            if (sedangMencetak) return;

            sedangMencetak = true;
            hentikanTimerStruk();
            statusCetakEl.textContent = 'Mencetak struk...';

            // tunggu 1 frame supaya animasi popup sebelumnya benar-benar selesai
            requestAnimationFrame(() => setTimeout(() => window.print(), 80));
        }

        function mulaiTutupOtomatis() {
            hentikanTimerStruk();

            let sisa = DURASI_TUTUP_STRUK;
            const tampil = () => {
                statusCetakEl.textContent = `Struk sudah dicetak, silakan diambil. Menutup dalam ${sisa} detik...`;
            };

            tampil();

            timerTutupStruk = setInterval(() => {
                sisa--;

                if (sisa <= 0) {
                    hentikanTimerStruk();
                    bootstrap.Modal.getOrCreateInstance(modalReceiptEl).hide();
                    return;
                }

                tampil();
            }, 1000);
        }

        // Selesai cetak (atau dibatalkan): baru tampilkan popup konfirmasi
        window.addEventListener('afterprint', () => {
            if (!sedangMencetak) return;

            sedangMencetak = false;

            if (!modalReceiptEl.classList.contains('show')) {
                bootstrap.Modal.getOrCreateInstance(modalReceiptEl).show();
            }

            mulaiTutupOtomatis();
        });

        // Kembalikan halaman utama ke kondisi awal ("Pilih") untuk pengunjung berikutnya
        function resetPilihanLayanan() {
            ++pemeriksaanAwal;
            ++pemeriksaanKuota;

            jenisLayanan = '';
            instansiId = null;
            instansiNama = null;
            jenisAntrean = null;
            tanggalBooking = null;

            document.getElementById('jenisLayananText').textContent = 'Pilih';
            document.getElementById('jenisLayananBtn').classList.remove('selected');
            document.getElementById('sectionSubtitle').textContent =
                'Silakan pilih instansi yang ingin Anda kunjungi';
        }

        modalReceiptEl.addEventListener('hidden.bs.modal', () => {
            hentikanTimerStruk();
            sedangMencetak = false;
            statusCetakEl.textContent = '';

            resetPilihanLayanan();
        });

        /* INISIALISASI HALAMAN */
        document.addEventListener('DOMContentLoaded', loadInstansi);
    </script>
</body>
</html>