<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Mal Pelayanan Publik Kota Tangerang</title>


    <!-- =====================================================
         BOOTSTRAP
    ====================================================== -->

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >


    <!-- =====================================================
         BOOTSTRAP ICONS
    ====================================================== -->

    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
    >


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

            background:
                radial-gradient(
                    circle at 10% 0%,
                    rgba(244, 196, 48, 0.08),
                    transparent 25%
                ),
                radial-gradient(
                    circle at 100% 100%,
                    rgba(33, 79, 125, 0.18),
                    transparent 30%
                ),
                var(--navy-dark);

            font-family:
                "Segoe UI",
                Arial,
                sans-serif;

            color: var(--navy);

        }


        /* =====================================================
           MAIN WRAPPER
        ====================================================== */

        .kiosk-wrapper {

            width: 100%;

            max-width: 1320px;

            min-height: 100vh;

            margin: 0 auto;

            padding: 24px;

        }


        .kiosk-container {

            min-height:
                calc(100vh - 48px);

            background:
                var(--soft-white);

            border-radius: 22px;

            overflow: hidden;

            box-shadow:
                0 25px 70px
                rgba(0, 0, 0, 0.28);

        }


        /* =====================================================
           HEADER
        ====================================================== */

        .kiosk-header {

            position: relative;

            min-height: 190px;

            padding:
                28px 35px;

            background:
                linear-gradient(
                    120deg,
                    #07182d 0%,
                    #0b2341 55%,
                    #12375e 100%
                );

            color: white;

            overflow: hidden;

        }


        /* Decorative circles */

        .header-circle-one {

            position: absolute;

            width: 310px;

            height: 310px;

            right: -100px;

            top: -155px;

            border:
                50px solid
                rgba(244, 196, 48, 0.08);

            border-radius: 50%;

        }


        .header-circle-two {

            position: absolute;

            width: 180px;

            height: 180px;

            right: 100px;

            bottom: -115px;

            border:
                25px solid
                rgba(255, 255, 255, 0.04);

            border-radius: 50%;

        }


        .header-pattern {

            position: absolute;

            right: 30px;

            bottom: 22px;

            width: 100px;

            height: 70px;

            opacity: 0.15;

            background-image:
                linear-gradient(
                    45deg,
                    transparent 45%,
                    var(--yellow) 45%,
                    var(--yellow) 55%,
                    transparent 55%
                );

            background-size:
                18px 18px;

        }


        .header-content {

            position: relative;

            z-index: 5;

            display: flex;

            align-items: center;

            gap: 20px;

        }


        .header-logo {

            position: relative;

            width: 72px;

            height: 72px;

            min-width: 72px;

            border-radius: 18px;

            background:
                white;

            color:
                var(--navy);

            display: flex;

            align-items: center;

            justify-content: center;

            font-size: 34px;

            box-shadow:
                0 8px 25px
                rgba(0, 0, 0, 0.2);

        }


        .header-logo::after {

            content: "";

            position: absolute;

            width: 13px;

            height: 13px;

            right: -5px;

            bottom: -5px;

            background:
                var(--yellow);

            border:
                3px solid var(--navy);

            border-radius: 50%;

        }


        .header-info {

            display: flex;

            flex-direction: column;

        }


        .header-badge {

            display: inline-flex;

            align-items: center;

            gap: 6px;

            width: fit-content;

            padding:
                5px 10px;

            margin-bottom: 7px;

            border:
                1px solid
                rgba(244, 196, 48, 0.35);

            border-radius: 20px;

            background:
                rgba(244, 196, 48, 0.08);

            color:
                var(--yellow);

            font-size: 10px;

            font-weight: 700;

            letter-spacing: 1.1px;

        }


        .header-title {

            margin: 0;

            font-size: 29px;

            line-height: 1.15;

            font-weight: 750;

            letter-spacing: -0.5px;

        }


        .header-title span {

            color:
                var(--yellow);

        }


        .header-subtitle {

            margin:
                7px 0 0;

            color:
                rgba(255, 255, 255, 0.67);

            font-size: 13px;

        }


        .header-line {

            width: 60px;

            height: 4px;

            margin-top: 13px;

            border-radius: 10px;

            background:
                var(--yellow);

        }


        /* =====================================================
           TOOLBAR
        ====================================================== */

        .toolbar {

            display: flex;

            align-items: center;

            justify-content: space-between;

            gap: 20px;

            padding:
                18px 30px;

            background:
                white;

            border-bottom:
                1px solid #edf0f3;

        }


        .toolbar-left {

            display: flex;

            align-items: center;

            gap: 11px;

        }


        .toolbar-icon {

            width: 38px;

            height: 38px;

            border-radius: 10px;

            background:
                #eef2f7;

            color:
                var(--navy);

            display: flex;

            align-items: center;

            justify-content: center;

            font-size: 18px;

        }


        .toolbar-title {

            margin: 0;

            font-size: 13px;

            font-weight: 700;

            color:
                var(--navy);

        }


        .toolbar-description {

            margin: 2px 0 0;

            font-size: 11px;

            color:
                var(--gray);

        }


        /* =====================================================
           DROPDOWN
        ====================================================== */

        .service-select-wrapper {

            position: relative;

            min-width: 225px;

        }


        .service-select-label {

            position: absolute;

            left: 13px;

            top: -7px;

            padding:
                0 5px;

            background:
                white;

            color:
                var(--gray);

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

            padding:
                0 38px 0 13px;

            border:
                1px solid var(--border);

            border-radius: 9px;

            background:
                white;

            color:
                rgba(107, 114, 128, 0.65);

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

            transform:
                translateY(-65%)
                rotate(45deg);

            transition:
                transform 0.18s ease;

        }


        .service-select-button[aria-expanded="true"] {

            border-color:
                var(--navy-light);

            box-shadow:
                0 0 0 3px
                rgba(23, 61, 104, 0.08);

        }


        .service-select-button[aria-expanded="true"]::after {

            transform:
                translateY(-20%)
                rotate(225deg);

        }


        .service-select-button.selected {

            color:
                var(--navy);

            font-weight: 600;

            font-style: normal;

        }


        .service-select .dropdown-menu {

            width: 100%;

            margin-top: 6px !important;

            padding: 6px;

            border:
                1px solid var(--border);

            border-radius: 10px;

            background:
                white;

            box-shadow:
                0 10px 25px
                rgba(11, 35, 65, 0.12);

        }


        .service-select .dropdown-item {

            padding:
                10px 12px;

            border-radius: 7px;

            color:
                var(--navy);

            font-size: 12px;

            font-weight: 500;

            font-style: normal;

        }


        .service-select .dropdown-item:hover,
        .service-select .dropdown-item:focus {

            background:
                #f1f4f8;

            color:
                var(--navy);

        }


        /* =====================================================
           CONTENT
        ====================================================== */

        .kiosk-content {

            padding:
                25px 30px 20px;

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

            color:
                var(--navy);

        }


        .section-subtitle {

            margin:
                4px 0 0;

            font-size: 13px;

            color:
                var(--gray);

        }


        .section-badge {

            display: flex;

            align-items: center;

            gap: 7px;

            padding:
                7px 12px;

            border-radius: 20px;

            background:
                #eef2f7;

            color:
                var(--navy);

            font-size: 11px;

            font-weight: 600;

        }


        .section-badge i {

            color:
                var(--yellow-dark);

        }


        /* =====================================================
           INSTANSI GRID
        ====================================================== */

        .instansi-grid {

            display: grid;

            grid-template-columns:
                repeat(5, minmax(0, 1fr));

            gap: 14px;

        }


        /* =====================================================
           INSTANSI CARD
        ====================================================== */

        .instansi-card {

            position: relative;

            width: 100%;

            min-height: 125px;

            padding:
                15px 12px;

            border:
                1px solid var(--border);

            border-radius: 14px;

            background:
                white;

            color:
                var(--navy);

            cursor: pointer;

            overflow: hidden;

            transition:
                transform 0.18s ease,
                box-shadow 0.18s ease,
                border-color 0.18s ease;

        }


        .instansi-card::before {

            content: "";

            position: absolute;

            left: 0;

            top: 0;

            bottom: 0;

            width: 4px;

            background:
                var(--yellow);

            transform:
                scaleY(0);

            transform-origin:
                center;

            transition:
                transform 0.18s ease;

        }


        .instansi-card:hover {

            transform:
                translateY(-3px);

            border-color:
                rgba(11, 35, 65, 0.25);

            box-shadow:
                0 8px 20px
                rgba(11, 35, 65, 0.12);

        }


        .instansi-card:hover::before {

            transform:
                scaleY(1);

        }


        .instansi-card:active {

            transform:
                translateY(-1px);

        }


        .instansi-card-inner {

            height: 100%;

            min-height: 92px;

            display: flex;

            flex-direction: column;

            align-items: center;

            justify-content: center;

        }


        .instansi-icon {

            width: 46px;

            height: 46px;

            margin-bottom: 9px;

            border-radius: 11px;

            background:
                var(--navy);

            color:
                var(--yellow);

            display: flex;

            align-items: center;

            justify-content: center;

            font-size: 21px;

        }


        .instansi-name {

            width: 100%;

            text-align: center;

            font-size: 13px;

            line-height: 1.25;

            font-weight: 650;

            color:
                var(--navy);

        }


        /* =====================================================
           FOOTER
        ====================================================== */

        .kiosk-footer {

            display: flex;

            align-items: center;

            justify-content: center;

            gap: 8px;

            padding:
                15px 20px 20px;

            color:
                #7b8490;

            font-size: 11px;

        }


        .status-dot {

            width: 7px;

            height: 7px;

            border-radius: 50%;

            background:
                var(--yellow);

        }


        /* =====================================================
           MODAL
        ====================================================== */

        .modal-content {

            border: none;

            border-radius: 18px;

            overflow: hidden;

            box-shadow:
                0 20px 50px
                rgba(0, 0, 0, 0.25);

        }


        .modal-header {

            background:
                var(--navy);

            color:
                white;

            border-bottom:
                none;

            padding:
                20px 22px;

        }


        .modal-title {

            font-size: 17px;

            font-weight: 700;

        }


        .modal-header .btn-close {

            filter:
                brightness(0)
                invert(1);

            opacity: 0.8;

        }


        .modal-body {

            padding:
                25px;

        }


        /* =====================================================
           BOOKING DATE
        ====================================================== */

        .booking-info {

            padding:
                14px;

            margin-bottom:
                20px;

            border-radius: 11px;

            background:
                #f1f4f8;

            border-left:
                4px solid var(--yellow);

        }


        .booking-info-label {

            font-size: 10px;

            color:
                var(--gray);

        }


        .booking-info-name {

            margin-top: 2px;

            font-size: 16px;

            font-weight: 700;

            color:
                var(--navy);

        }


        .date-title {

            margin-bottom:
                11px;

            font-size: 13px;

            font-weight: 700;

            color:
                var(--navy);

        }


        .date-grid {

            display: grid;

            grid-template-columns:
                repeat(5, 1fr);

            gap: 9px;

        }


        .date-option {

            min-height: 76px;

            padding:
                9px 5px;

            border:
                1px solid var(--border);

            border-radius: 10px;

            background:
                white;

            cursor: pointer;

            text-align: center;

            transition:
                all 0.18s ease;

        }


        .date-option:hover:not(.disabled) {

            border-color:
                var(--navy);

            transform:
                translateY(-2px);

        }


        .date-option.active {

            background:
                var(--navy);

            border-color:
                var(--navy);

            color:
                white;

        }


        .date-option.disabled {

            background:
                #e5e8ec;

            color:
                #9aa1aa;

            border-color:
                #d9dde2;

            cursor:
                not-allowed;

            opacity:
                0.75;

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


        /* =====================================================
           SELECTED INSTANSI
        ====================================================== */

        .selected-instansi {

            padding:
                15px;

            border-radius:
                12px;

            background:
                #f1f4f8;

            border-left:
                4px solid var(--yellow);

            margin-bottom:
                22px;

        }


        .selected-instansi-label {

            font-size: 11px;

            color:
                var(--gray);

        }


        .selected-instansi-name {

            margin-top: 3px;

            color:
                var(--navy);

            font-size: 17px;

            font-weight: 700;

        }


        /* =====================================================
           QUEUE OPTION
        ====================================================== */

        .queue-title {

            margin-bottom:
                12px;

            font-size: 14px;

            font-weight: 700;

            color:
                var(--navy);

        }


        .queue-options {

            display: grid;

            grid-template-columns:
                1fr 1fr;

            gap: 12px;

        }


        .queue-option {

            border:
                2px solid var(--border);

            background:
                white;

            border-radius:
                13px;

            padding:
                18px 12px;

            cursor:
                pointer;

            text-align:
                center;

            transition:
                all 0.18s ease;

        }


        .queue-option:hover {

            border-color:
                var(--navy-light);

        }


        .queue-option.active {

            border-color:
                var(--yellow);

            background:
                #fff9df;

        }


        .queue-option-icon {

            width: 43px;

            height: 43px;

            margin:
                0 auto 9px;

            border-radius:
                50%;

            background:
                var(--navy);

            color:
                var(--yellow);

            display:
                flex;

            align-items:
                center;

            justify-content:
                center;

            font-size:
                20px;

        }


        .queue-option-name {

            font-size:
                14px;

            font-weight:
                700;

            color:
                var(--navy);

        }


        .queue-option-desc {

            margin-top:
                3px;

            font-size:
                11px;

            color:
                var(--gray);

        }


        .error-message {

            display:
                none;

            margin-top:
                14px;

            padding:
                10px 12px;

            border-radius:
                8px;

            background:
                #fff0f0;

            color:
                #b42318;

            font-size:
                12px;

        }


        /* =====================================================
           BUTTON
        ====================================================== */

        .modal-footer {

            border-top:
                1px solid #edf0f3;

            padding:
                15px 20px;

        }


        .btn-kiosk-primary {

            border:
                none;

            background:
                var(--navy);

            color:
                white;

            padding:
                10px 20px;

            border-radius:
                9px;

            font-weight:
                600;

        }


        .btn-kiosk-primary:hover {

            background:
                var(--navy-light);

            color:
                white;

        }


        .btn-kiosk-yellow {

            border:
                none;

            background:
                var(--yellow);

            color:
                var(--navy);

            padding:
                10px 20px;

            border-radius:
                9px;

            font-weight:
                700;

        }


        .btn-kiosk-yellow:hover {

            background:
                var(--yellow-dark);

            color:
                var(--navy);

        }


        /* =====================================================
           RECEIPT
        ====================================================== */

        .receipt {

            text-align:
                center;

            padding:
                10px;

        }


        .receipt-logo {

            width:
                60px;

            height:
                60px;

            margin:
                0 auto 12px;

            border-radius:
                14px;

            background:
                var(--navy);

            color:
                var(--yellow);

            display:
                flex;

            align-items:
                center;

            justify-content:
                center;

            font-size:
                28px;

        }


        .receipt-title {

            margin:
                0;

            font-size:
                18px;

            font-weight:
                750;

            color:
                var(--navy);

        }


        .receipt-subtitle {

            margin:
                4px 0 18px;

            color:
                var(--gray);

            font-size:
                12px;

        }


        .receipt-number-box {

            padding:
                20px;

            border-radius:
                14px;

            background:
                var(--navy);

            color:
                white;

            margin-bottom:
                18px;

        }


        .receipt-number-label {

            font-size:
                11px;

            color:
                rgba(255,255,255,0.7);

        }


        .receipt-number {

            margin-top:
                2px;

            font-size:
                42px;

            line-height:
                1;

            font-weight:
                800;

            color:
                var(--yellow);

            letter-spacing:
                2px;

        }


        .receipt-info {

            text-align:
                left;

            border-top:
                1px dashed #d7dce2;

            border-bottom:
                1px dashed #d7dce2;

            padding:
                13px 0;

        }


        .receipt-info-row {

            display:
                flex;

            justify-content:
                space-between;

            gap:
                15px;

            margin-bottom:
                7px;

            font-size:
                12px;

        }


        .receipt-info-row:last-child {

            margin-bottom:
                0;

        }


        .receipt-info-label {

            color:
                var(--gray);

        }


        .receipt-info-value {

            color:
                var(--navy);

            font-weight:
                700;

            text-align:
                right;

        }


        /* =====================================================
           RESPONSIVE
        ====================================================== */

        @media (max-width: 1199px) {

            .instansi-grid {

                grid-template-columns:
                    repeat(4, minmax(0, 1fr));

            }

        }


        @media (max-width: 991px) {

            .instansi-grid {

                grid-template-columns:
                    repeat(3, minmax(0, 1fr));

            }


            .toolbar {

                align-items:
                    flex-start;

                flex-direction:
                    column;

            }


            .service-select-wrapper {

                width:
                    100%;

            }


            .kiosk-wrapper {

                padding:
                    15px;

            }


            .kiosk-container {

                min-height:
                    calc(100vh - 30px);

            }


            .kiosk-content {

                padding:
                    22px;

            }

        }


        @media (max-width: 767px) {

            .instansi-grid {

                grid-template-columns:
                    repeat(2, minmax(0, 1fr));

            }


            .kiosk-header {

                min-height:
                    165px;

            }


            .header-title {

                font-size:
                    22px;

            }


            .header-subtitle {

                font-size:
                    12px;

            }


            .section-header {

                align-items:
                    flex-start;

                flex-direction:
                    column;

            }


            .section-badge {

                display:
                    none;

            }


            .date-grid {

                grid-template-columns:
                    repeat(3, 1fr);

            }

        }


        @media (max-width: 575px) {

            .kiosk-wrapper {

                padding:
                    0;

            }


            .kiosk-container {

                border-radius:
                    0;

                min-height:
                    100vh;

            }


            .kiosk-header {

                padding:
                    22px 18px;

            }


            .header-content {

                gap:
                    13px;

            }


            .header-logo {

                width:
                    55px;

                height:
                    55px;

                min-width:
                    55px;

                font-size:
                    25px;

            }


            .header-title {

                font-size:
                    18px;

            }


            .header-badge {

                font-size:
                    8px;

            }


            .header-subtitle {

                font-size:
                    11px;

            }


            .toolbar {

                padding:
                    15px;

            }


            .kiosk-content {

                padding:
                    18px 15px;

            }


            .instansi-grid {

                grid-template-columns:
                    repeat(2, minmax(0, 1fr));

                gap:
                    10px;

            }


            .instansi-card {

                min-height:
                    105px;

            }


            .queue-options {

                grid-template-columns:
                    1fr;

            }


            .date-grid {

                grid-template-columns:
                    repeat(3, 1fr);

            }

        }


 /* =====================================================
   PRINT STRUK THERMAL 80MM
====================================================== */

@media print {

    /* =================================================
       UKURAN KERTAS
    ================================================= */

    @page {
        size: 80mm auto;
        margin: 0;
    }


    /* =================================================
       RESET HTML & BODY
    ================================================= */

    html,
    body {
        width: 80mm !important;
        min-width: 80mm !important;
        max-width: 80mm !important;

        height: auto !important;
        min-height: 0 !important;

        margin: 0 !important;
        padding: 0 !important;

        background: #ffffff !important;

        overflow: visible !important;

        display: block !important;
    }


    /* =================================================
       SEMBUNYIKAN HALAMAN KIOSK
    ================================================= */

    .kiosk-wrapper {
        width: 80mm !important;
        min-width: 80mm !important;
        max-width: 80mm !important;

        height: auto !important;
        min-height: 0 !important;

        margin: 0 !important;
        padding: 0 !important;

        background: #ffffff !important;

        display: block !important;
    }


    .kiosk-container {
        width: 80mm !important;
        min-width: 80mm !important;
        max-width: 80mm !important;

        height: auto !important;
        min-height: 0 !important;

        margin: 0 !important;
        padding: 0 !important;

        background: #ffffff !important;

        border: none !important;
        border-radius: 0 !important;
        box-shadow: none !important;

        overflow: visible !important;

        display: block !important;
    }


    /* =================================================
       SEMBUNYIKAN ELEMEN HALAMAN UTAMA
    ================================================= */

    .kiosk-header,
    .toolbar,
    .kiosk-content,
    .kiosk-footer,

    #modalTanggal,
    #modalValidasi,

    .modal-backdrop {
        display: none !important;
    }


    /* =================================================
       MODAL RECEIPT
    ================================================= */

    #modalReceipt {
        position: static !important;

        display: block !important;

        width: 80mm !important;
        min-width: 80mm !important;
        max-width: 80mm !important;

        height: auto !important;
        min-height: 0 !important;

        margin: 0 !important;
        padding: 0 !important;

        background: #ffffff !important;

        border: none !important;

        overflow: visible !important;

        opacity: 1 !important;
        visibility: visible !important;

        transform: none !important;
    }


    /* =================================================
       MODAL DIALOG
    ================================================= */

    #modalReceipt .modal-dialog {
        position: static !important;

        display: block !important;

        width: 80mm !important;
        min-width: 80mm !important;
        max-width: 80mm !important;

        height: auto !important;
        min-height: 0 !important;

        margin: 0 !important;
        padding: 0 !important;

        transform: none !important;
    }


    /* =================================================
       MODAL CONTENT
    ================================================= */

    #modalReceipt .modal-content {
        display: block !important;

        width: 80mm !important;
        min-width: 80mm !important;
        max-width: 80mm !important;

        height: auto !important;
        min-height: 0 !important;

        margin: 0 !important;
        padding: 0 !important;

        border: none !important;
        border-radius: 0 !important;

        background: #ffffff !important;

        box-shadow: none !important;

        overflow: visible !important;
    }


    /* =================================================
       HILANGKAN HEADER & FOOTER MODAL
    ================================================= */

    #modalReceipt .modal-header,
    #modalReceipt .modal-footer {
        display: none !important;
    }


    /* =================================================
       MODAL BODY
    ================================================= */

    #modalReceipt .modal-body {
        display: block !important;

        width: 80mm !important;
        min-width: 80mm !important;
        max-width: 80mm !important;

        height: auto !important;
        min-height: 0 !important;

        margin: 0 !important;
        padding: 0 !important;

        background: #ffffff !important;

        overflow: visible !important;
    }


    /* =================================================
       STRUK
       KERTAS = 80MM
       STRUK  = 72MM
       SISA   = 8MM
       KIRI   = 4MM
       KANAN  = 4MM
    ================================================= */

    #modalReceipt .receipt {
        display: block !important;

        box-sizing: border-box !important;

        width: 72mm !important;
        min-width: 72mm !important;
        max-width: 72mm !important;

        height: auto !important;
        min-height: 0 !important;

        margin: 0 4mm !important;
        padding: 5mm 2mm !important;

        background: #ffffff !important;

        position: static !important;

        left: auto !important;
        right: auto !important;
        top: auto !important;
        bottom: auto !important;

        transform: none !important;

        text-align: center !important;

        overflow: visible !important;
    }


    /* =================================================
       LOGO
    ================================================= */

    #modalReceipt .receipt-logo {
        width: 14mm !important;
        height: 14mm !important;

        margin: 0 auto 3mm !important;

        border-radius: 3mm !important;

        display: flex !important;
        align-items: center !important;
        justify-content: center !important;

        background: var(--navy) !important;
        color: var(--yellow) !important;

        font-size: 7mm !important;
    }


    /* =================================================
       JUDUL
    ================================================= */

    #modalReceipt .receipt-title {
        margin: 0 !important;
        padding: 0 !important;

        font-size: 4.5mm !important;
        line-height: 1.2 !important;

        color: var(--navy) !important;
    }


    #modalReceipt .receipt-subtitle {
        margin: 1mm 0 4mm !important;
        padding: 0 !important;

        font-size: 3mm !important;
        line-height: 1.2 !important;

        color: #6b7280 !important;
    }


    /* =================================================
       NOMOR ANTREAN
    ================================================= */

    #modalReceipt .receipt-number-box {
        width: 100% !important;

        margin: 0 0 4mm !important;
        padding: 4mm !important;

        box-sizing: border-box !important;

        border-radius: 3mm !important;

        background: var(--navy) !important;
        color: #ffffff !important;
    }


    #modalReceipt .receipt-number-label {
        margin: 0 !important;
        padding: 0 !important;

        font-size: 2.8mm !important;

        color: rgba(255, 255, 255, 0.75) !important;
    }


    #modalReceipt .receipt-number {
        margin: 1mm 0 0 !important;
        padding: 0 !important;

        font-size: 11mm !important;
        line-height: 1 !important;

        font-weight: 800 !important;

        letter-spacing: 0.5mm !important;

        color: var(--yellow) !important;
    }


    /* =================================================
       INFORMASI STRUK
    ================================================= */

    #modalReceipt .receipt-info {
        width: 100% !important;

        margin: 0 !important;
        padding: 3mm 0 !important;

        border-top: 1px dashed #999999 !important;
        border-bottom: 1px dashed #999999 !important;

        text-align: left !important;

        box-sizing: border-box !important;
    }


    #modalReceipt .receipt-info-row {
        display: flex !important;

        justify-content: space-between !important;
        align-items: flex-start !important;

        width: 100% !important;

        margin: 0 0 2mm !important;
        padding: 0 !important;

        gap: 3mm !important;

        font-size: 3mm !important;
        line-height: 1.25 !important;
    }


    #modalReceipt .receipt-info-row:last-child {
        margin-bottom: 0 !important;
    }


    #modalReceipt .receipt-info-label {
        flex: 0 0 auto !important;

        margin: 0 !important;
        padding: 0 !important;

        color: #6b7280 !important;
    }


    #modalReceipt .receipt-info-value {
        flex: 1 1 auto !important;

        max-width: 45mm !important;

        margin: 0 !important;
        padding: 0 !important;

        color: var(--navy) !important;

        font-weight: 700 !important;

        text-align: right !important;

        word-break: break-word !important;
        overflow-wrap: break-word !important;
    }


    /* =================================================
       PAKSA ELEMEN RECEIPT TETAP DI TENGAH
    ================================================= */

    #modalReceipt .receipt > * {
        box-sizing: border-box !important;
    }


    /* =================================================
       HILANGKAN EFEK BOOTSTRAP MODAL SAAT PRINT
    ================================================= */

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


    /* =================================================
       PASTIKAN TIDAK ADA SCROLL / POSISI FIXED
    ================================================= */

    #modalReceipt,
    #modalReceipt .modal-dialog,
    #modalReceipt .modal-content,
    #modalReceipt .modal-body,
    #modalReceipt .receipt {
        position: static !important;

        top: auto !important;
        right: auto !important;
        bottom: auto !important;
        left: auto !important;

        float: none !important;
    }
}

</style>
<body>

<div class="kiosk-wrapper">

    <div class="kiosk-container">


        <!-- =================================================
             HEADER
        ================================================== -->

        <header class="kiosk-header">


            <div class="header-circle-one"></div>

            <div class="header-circle-two"></div>

            <div class="header-pattern"></div>


            <div class="header-content">


                <div class="header-logo">

                    <i class="bi bi-buildings"></i>

                </div>


                <div class="header-info">


                    <div class="header-badge">

                        <i class="bi bi-shield-check"></i>

                        LAYANAN PUBLIK

                    </div>


                    <h1 class="header-title">

                        Mal Pelayanan Publik

                        <span>
                            Kota Tangerang
                        </span>

                    </h1>


                    <p class="header-subtitle">

                        Satu tempat untuk berbagai kebutuhan pelayanan masyarakat

                    </p>


                    <div class="header-line"></div>


                </div>


            </div>


        </header>



        <!-- =================================================
             TOOLBAR + DROPDOWN
        ================================================== -->

        <div class="toolbar">


            <div class="toolbar-left">


                <div class="toolbar-icon">

                    <i class="bi bi-ticket-perforated"></i>

                </div>


                <div>

                    <p class="toolbar-title">

                        Layanan Antrean

                    </p>


                    <p class="toolbar-description">

                        Pilih jenis layanan yang ingin digunakan

                    </p>

                </div>


            </div>



            <div class="service-select-wrapper">


                <span class="service-select-label">

                    Jenis Layanan

                </span>


                <div class="dropdown service-select">

                    <button
                        type="button"
                        class="service-select-button"
                        id="jenisLayananBtn"
                        data-bs-toggle="dropdown"
                        aria-expanded="false"
                        aria-haspopup="true"
                    >
                        <span id="jenisLayananText">Pilih</span>
                    </button>

                    <ul
                        class="dropdown-menu"
                        aria-labelledby="jenisLayananBtn"
                    >
                        <li>
                            <button
                                type="button"
                                class="dropdown-item"
                                onclick="ubahLayanan('HARI_INI', 'Antrian Hari Ini')"
                            >
                                Antrian Hari Ini
                            </button>
                        </li>

                        <li>
                            <button
                                type="button"
                                class="dropdown-item"
                                onclick="ubahLayanan('BOOKING', 'Booking')"
                            >
                                Booking
                            </button>
                        </li>
                    </ul>

                </div>


            </div>


        </div>



        <!-- =================================================
             CONTENT
        ================================================== -->

        <main class="kiosk-content">


            <div class="section-header">


                <div>

                    <h2 class="section-title">

                        Pilih Instansi

                    </h2>


                    <p
                        class="section-subtitle"
                        id="sectionSubtitle"
                    >

                        Silakan pilih instansi yang ingin Anda kunjungi

                    </p>

                </div>


                <div class="section-badge">

                    <i class="bi bi-hand-index-thumb"></i>

                    Ketuk pilihan layanan

                </div>


            </div>



            <!-- =================================================
                 DATA INSTANSI
            ================================================== -->

            <?php

            $instansi = [

                [
                    'id' => 1,
                    'nama' => 'SAMSAT',
                    'icon' => 'bi-car-front'
                ],

                [
                    'id' => 2,
                    'nama' => 'BAPENDA',
                    'icon' => 'bi-building'
                ],

                [
                    'id' => 3,
                    'nama' => 'BPKPD',
                    'icon' => 'bi-bank'
                ],

                [
                    'id' => 4,
                    'nama' => 'DISNAKER',
                    'icon' => 'bi-briefcase'
                ],

                [
                    'id' => 5,
                    'nama' => 'DUKCAPIL',
                    'icon' => 'bi-person-vcard'
                ],

                [
                    'id' => 6,
                    'nama' => 'TASPEN',
                    'icon' => 'bi-person'
                ],

                [
                    'id' => 7,
                    'nama' => 'BPJS KESEHATAN',
                    'icon' => 'bi-heart-pulse'
                ],

                [
                    'id' => 8,
                    'nama' => 'BPJS TK',
                    'icon' => 'bi-people'
                ],

                [
                    'id' => 9,
                    'nama' => 'PDAM',
                    'icon' => 'bi-droplet'
                ],

                [
                    'id' => 10,
                    'nama' => 'PENGADILAN AGAMA',
                    'icon' => 'bi-bank'
                ],

                [
                    'id' => 11,
                    'nama' => 'PLN',
                    'icon' => 'bi-lightning-charge'
                ],

                [
                    'id' => 12,
                    'nama' => 'ATR BPN',
                    'icon' => 'bi-map'
                ],

                [
                    'id' => 13,
                    'nama' => 'KEJARI',
                    'icon' => 'bi-building'
                ],

                [
                    'id' => 14,
                    'nama' => 'POLRES',
                    'icon' => 'bi-shield'
                ],

                [
                    'id' => 15,
                    'nama' => 'BNN',
                    'icon' => 'bi-shield-check'
                ],

                [
                    'id' => 16,
                    'nama' => 'BPOM',
                    'icon' => 'bi-capsule'
                ],

                [
                    'id' => 17,
                    'nama' => 'DINAS LINGKUNGAN HIDUP',
                    'icon' => 'bi-tree'
                ],

                [
                    'id' => 18,
                    'nama' => 'POS INDONESIA',
                    'icon' => 'bi-envelope'
                ],

                [
                    'id' => 19,
                    'nama' => 'DITJEN AHU',
                    'icon' => 'bi-building'
                ],

                [
                    'id' => 20,
                    'nama' => 'PELAYANAN PBG',
                    'icon' => 'bi-house'
                ],

                [
                    'id' => 21,
                    'nama' => 'DPUPR',
                    'icon' => 'bi-building'
                ],

                [
                    'id' => 22,
                    'nama' => 'PERKIM',
                    'icon' => 'bi-house-door'
                ],

                [
                    'id' => 23,
                    'nama' => 'DISHUB',
                    'icon' => 'bi-bus-front'
                ],

                [
                    'id' => 24,
                    'nama' => 'PTSP 1',
                    'icon' => 'bi-file-earmark-text'
                ],

                [
                    'id' => 25,
                    'nama' => 'PTSP 2',
                    'icon' => 'bi-file-earmark-text'
                ],

                [
                    'id' => 26,
                    'nama' => 'BANK BANTEN',
                    'icon' => 'bi-bank'
                ],

                [
                    'id' => 27,
                    'nama' => 'BANK BJB',
                    'icon' => 'bi-bank'
                ],

                [
                    'id' => 28,
                    'nama' => 'BAZNAS',
                    'icon' => 'bi-heart'
                ],

            ];

            ?>



            <!-- =================================================
                 INSTANSI GRID
            ================================================== -->

            <div class="instansi-grid">


                <?php foreach ($instansi as $item): ?>


                    <button
                        type="button"
                        class="instansi-card"
                        onclick="pilihInstansi(
                            <?= $item['id'] ?>,
                            '<?= esc($item['nama']) ?>'
                        )"
                    >


                        <div class="instansi-card-inner">


                            <div class="instansi-icon">

                                <i
                                    class="bi <?= esc($item['icon']) ?>"
                                ></i>

                            </div>


                            <div class="instansi-name">

                                <?= esc($item['nama']) ?>

                            </div>


                        </div>


                    </button>


                <?php endforeach; ?>


            </div>


        </main>



        <!-- =================================================
             FOOTER
        ================================================== -->

        <footer class="kiosk-footer">

            <span class="status-dot"></span>

            Silakan pilih instansi untuk melanjutkan proses layanan

        </footer>


    </div>

</div>



<!-- =========================================================
     MODAL BOOKING DATE
========================================================== -->

<div
    class="modal fade"
    id="modalTanggal"
    tabindex="-1"
    aria-hidden="true"
>

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content">


            <div class="modal-header">

                <h5 class="modal-title">

                    Pilih Tanggal Booking

                </h5>


                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                ></button>

            </div>


            <div class="modal-body">


                <div class="booking-info">


                    <div class="booking-info-label">

                        Instansi yang dipilih

                    </div>


                    <div
                        class="booking-info-name"
                        id="bookingInstansi"
                    >

                        -

                    </div>


                </div>



                <div class="date-title">

                    Pilih tanggal pelayanan

                </div>


                <div
                    class="date-grid"
                    id="dateGrid"
                >

                </div>


                <div
                    class="error-message"
                    id="errorTanggal"
                >

                    <i class="bi bi-exclamation-circle me-1"></i>

                    Silakan pilih tanggal terlebih dahulu.

                </div>


            </div>


            <div class="modal-footer">


                <button
                    type="button"
                    class="btn btn-kiosk-primary"
                    data-bs-dismiss="modal"
                >

                    Batal

                </button>


                <button
                    type="button"
                    class="btn btn-kiosk-yellow"
                    onclick="konfirmasiTanggal()"
                >

                    Lanjutkan

                    <i
                        class="bi bi-arrow-right ms-1"
                    ></i>

                </button>


            </div>


        </div>

    </div>

</div>



<!-- =========================================================
     MODAL VALIDASI ANTREAN
========================================================== -->

<div
    class="modal fade"
    id="modalValidasi"
    tabindex="-1"
    aria-hidden="true"
>

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content">


            <div class="modal-header">

                <h5 class="modal-title">

                    Pilih Jenis Antrean

                </h5>


                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                ></button>

            </div>


            <div class="modal-body">


                <div class="selected-instansi">


                    <div class="selected-instansi-label">

                        Instansi yang dipilih

                    </div>


                    <div
                        class="selected-instansi-name"
                        id="namaInstansi"
                    >

                        -

                    </div>


                </div>


                <div class="queue-title">

                    Silakan pilih jenis antrean

                </div>


                <div class="queue-options">


                    <!-- BIASA -->

                    <div
                        class="queue-option"
                        onclick="pilihJenis('BIASA', this)"
                    >

                        <div class="queue-option-icon">

                            <i class="bi bi-person"></i>

                        </div>


                        <div class="queue-option-name">

                            Antrean Biasa

                        </div>


                        <div class="queue-option-desc">

                            Untuk masyarakat umum

                        </div>


                    </div>



                    <!-- PRIORITAS -->

                    <div
                        class="queue-option"
                        onclick="pilihJenis('PRIORITAS', this)"
                    >

                        <div class="queue-option-icon">

                            <i class="bi bi-person-check"></i>

                        </div>


                        <div class="queue-option-name">

                            Antrean Prioritas

                        </div>


                        <div class="queue-option-desc">

                            Lansia, disabilitas, dll.

                        </div>


                    </div>


                </div>


                <div
                    class="error-message"
                    id="errorJenis"
                >

                    <i class="bi bi-exclamation-circle me-1"></i>

                    Silakan pilih jenis antrean terlebih dahulu.

                </div>


            </div>


            <div class="modal-footer">


                <button
                    type="button"
                    class="btn btn-kiosk-primary"
                    data-bs-dismiss="modal"
                >

                    Batal

                </button>


                <button
                    type="button"
                    class="btn btn-kiosk-yellow"
                    onclick="konfirmasiAntrean()"
                >

                    Ambil Nomor

                    <i class="bi bi-arrow-right ms-1"></i>

                </button>


            </div>


        </div>

    </div>

</div>



<!-- =========================================================
     MODAL RECEIPT
========================================================== -->

<div
    class="modal fade"
    id="modalReceipt"
    tabindex="-1"
    aria-hidden="true"
>

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content">


            <div class="modal-header">

                <h5 class="modal-title">

                    Nomor Antrean

                </h5>


                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                ></button>

            </div>


            <div class="modal-body">


                <div class="receipt">


                    <div class="receipt-logo">

                        <i class="bi bi-buildings"></i>

                    </div>


                    <h3 class="receipt-title">

                        Mal Pelayanan Publik

                    </h3>


                    <div class="receipt-subtitle">

                        Kota Tangerang

                    </div>


                    <div class="receipt-number-box">


                        <div class="receipt-number-label">

                            NOMOR ANTREAN

                        </div>


                        <div
                            class="receipt-number"
                            id="nomorAntrean"
                        >

                            -

                        </div>


                    </div>


                    <div class="receipt-info">


                        <div class="receipt-info-row">

                            <span class="receipt-info-label">

                                Instansi

                            </span>


                            <span
                                class="receipt-info-value"
                                id="receiptInstansi"
                            >

                                -

                            </span>

                        </div>


                        <div class="receipt-info-row">

                            <span class="receipt-info-label">

                                Jenis Antrean

                            </span>


                            <span
                                class="receipt-info-value"
                                id="receiptJenis"
                            >

                                -

                            </span>

                        </div>


                        <div class="receipt-info-row">

                            <span class="receipt-info-label">

                                Tanggal

                            </span>


                            <span
                                class="receipt-info-value"
                                id="receiptTanggal"
                            >

                                -

                            </span>

                        </div>


                    </div>


                </div>


            </div>


            <div class="modal-footer">


                <button
                    type="button"
                    class="btn btn-kiosk-primary"
                    onclick="window.print()"
                >

                    <i class="bi bi-printer me-1"></i>

                    Cetak

                </button>


                <button
                    type="button"
                    class="btn btn-kiosk-yellow"
                    data-bs-dismiss="modal"
                >

                    Selesai

                </button>


            </div>


        </div>

    </div>

</div>



<!-- =========================================================
     BOOTSTRAP JS
========================================================== -->

<script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
></script>



<script>

    /* =====================================================
       VARIABLE
    ====================================================== */

    let instansiId = null;

    let instansiNama = null;

    let jenisAntrean = null;

    let jenisLayanan = '';

    let tanggalBooking = null;



    /* =====================================================
       UBAH LAYANAN
    ====================================================== */

    function ubahLayanan(value, label) {

        jenisLayanan = value;


        const layananText =
            document.getElementById(
                'jenisLayananText'
            );


        const layananButton =
            document.getElementById(
                'jenisLayananBtn'
            );


        layananText.textContent =
            label;


        layananButton.classList.add(
            'selected'
        );


        const subtitle =
            document.getElementById(
                'sectionSubtitle'
            );


        if (value === 'BOOKING') {

            subtitle.textContent =
                'Pilih instansi untuk melakukan booking layanan';


        } else if (value === 'HARI_INI') {

            subtitle.textContent =
                'Pilih instansi untuk mengambil nomor antrean hari ini';


        } else {

            subtitle.textContent =
                'Silakan pilih instansi yang ingin Anda kunjungi';

        }

    }



    /* =====================================================
       PILIH INSTANSI
    ====================================================== */

    function pilihInstansi(id, nama) {

        instansiId = id;

        instansiNama = nama;


        // Kalau belum memilih jenis layanan

        if (!jenisLayanan) {

            alert(
                'Silakan pilih jenis layanan terlebih dahulu.'
            );

            return;

        }


        // Booking

        if (jenisLayanan === 'BOOKING') {

            bukaTanggalBooking();

            return;

        }


        // Antrean hari ini

        bukaModalJenisAntrean();

    }



    /* =====================================================
       BUKA MODAL JENIS ANTREAN
    ====================================================== */

    function bukaModalJenisAntrean() {

        jenisAntrean = null;


        document
            .getElementById('namaInstansi')
            .textContent = instansiNama;


        document
            .querySelectorAll('.queue-option')
            .forEach(function (item) {

                item.classList.remove('active');

            });


        document
            .getElementById('errorJenis')
            .style.display = 'none';


        const modal =
            new bootstrap.Modal(
                document.getElementById(
                    'modalValidasi'
                )
            );


        modal.show();

    }



    /* =====================================================
       BOOKING - BUKA TANGGAL
    ====================================================== */

    function bukaTanggalBooking() {

        tanggalBooking = null;


        document
            .getElementById('bookingInstansi')
            .textContent = instansiNama;


        document
            .getElementById('errorTanggal')
            .style.display = 'none';


        generateTanggal();


        const modal =
            new bootstrap.Modal(
                document.getElementById(
                    'modalTanggal'
                )
            );


        modal.show();

    }



    /* =====================================================
       GENERATE TANGGAL 7 HARI
       
       SENIN - JUMAT AKTIF
       SABTU - MINGGU DISABLED
    ====================================================== */

    function generateTanggal() {

        const dateGrid =
            document.getElementById(
                'dateGrid'
            );


        dateGrid.innerHTML = '';


        const today =
            new Date();


        for (
            let i = 0;
            i < 7;
            i++
        ) {


            const date =
                new Date(today);


            date.setDate(
                today.getDate() + i
            );


            const day =
                date.getDay();


            /*
             * 0 = Minggu
             * 1 = Senin
             * 2 = Selasa
             * 3 = Rabu
             * 4 = Kamis
             * 5 = Jumat
             * 6 = Sabtu
             */


            const disabled =
                day === 0 ||
                day === 6;


            const dayNames = [

                'Minggu',
                'Senin',
                'Selasa',
                'Rabu',
                'Kamis',
                'Jumat',
                'Sabtu'

            ];


            const monthNames = [

                'Jan',
                'Feb',
                'Mar',
                'Apr',
                'Mei',
                'Jun',
                'Jul',
                'Agu',
                'Sep',
                'Okt',
                'Nov',
                'Des'

            ];


            const button =
                document.createElement(
                    'button'
                );


            button.type =
                'button';


            button.className =
                'date-option';


            if (disabled) {

                button.classList.add(
                    'disabled'
                );

            }


            button.innerHTML = `

                <span class="date-day">
                    ${dayNames[day]}
                </span>

                <span class="date-number">
                    ${date.getDate()}
                </span>

                <span class="date-month">
                    ${monthNames[date.getMonth()]}
                </span>

            `;


            if (!disabled) {

                button.onclick =
                    function () {

                        pilihTanggal(
                            date,
                            button
                        );

                    };

            }


            dateGrid.appendChild(
                button
            );

        }

    }



    /* =====================================================
       PILIH TANGGAL
    ====================================================== */

    function pilihTanggal(
        date,
        element
    ) {

        tanggalBooking =
            new Date(date);


        document
            .querySelectorAll('.date-option')
            .forEach(function (item) {

                item.classList.remove(
                    'active'
                );

            });


        element.classList.add(
            'active'
        );


        document
            .getElementById('errorTanggal')
            .style.display = 'none';

    }



    /* =====================================================
       KONFIRMASI TANGGAL
    ====================================================== */

    function konfirmasiTanggal() {


        if (!tanggalBooking) {

            document
                .getElementById('errorTanggal')
                .style.display = 'block';

            return;

        }


        const modalElement =
            document.getElementById(
                'modalTanggal'
            );


        const modal =
            bootstrap.Modal.getInstance(
                modalElement
            );


        if (modal) {

            modal.hide();

        }


        setTimeout(function () {

            bukaModalJenisAntrean();

        }, 300);

    }



    /* =====================================================
       PILIH JENIS ANTREAN
    ====================================================== */

    function pilihJenis(
        jenis,
        element
    ) {

        jenisAntrean =
            jenis;


        document
            .querySelectorAll('.queue-option')
            .forEach(function (item) {

                item.classList.remove(
                    'active'
                );

            });


        element.classList.add(
            'active'
        );


        document
            .getElementById('errorJenis')
            .style.display = 'none';

    }



    /* =====================================================
       KONFIRMASI ANTREAN
    ====================================================== */

    function konfirmasiAntrean() {


        if (!jenisAntrean) {

            document
                .getElementById('errorJenis')
                .style.display =
                'block';

            return;

        }


        /*
         * NOMOR DUMMY
         *
         * Nanti diganti dengan backend.
         */

        let nomorAntrean;


        if (
            jenisAntrean ===
            'PRIORITAS'
        ) {

            nomorAntrean =
                'P-005';

        } else {

            nomorAntrean =
                'B-025';

        }


        // Nomor

        document
            .getElementById(
                'nomorAntrean'
            )
            .textContent =
            nomorAntrean;


        // Instansi

        document
            .getElementById(
                'receiptInstansi'
            )
            .textContent =
            instansiNama;


        // Jenis

        document
            .getElementById(
                'receiptJenis'
            )
            .textContent =
            jenisAntrean ===
            'PRIORITAS'
                ? 'Antrean Prioritas'
                : 'Antrean Biasa';



        /*
         * Tanggal receipt
         */

        let tanggalReceipt;


        if (
            jenisLayanan ===
            'BOOKING' &&
            tanggalBooking
        ) {

            tanggalReceipt =
                tanggalBooking;

        } else {

            tanggalReceipt =
                new Date();

        }


        const tanggalText =
            tanggalReceipt.toLocaleDateString(
                'id-ID',
                {
                    day: '2-digit',
                    month: 'long',
                    year: 'numeric'
                }
            );


        document
            .getElementById(
                'receiptTanggal'
            )
            .textContent =
            tanggalText;



        // Tutup modal jenis antrean

        const modalValidasiElement =
            document.getElementById(
                'modalValidasi'
            );


        const modalValidasi =
            bootstrap.Modal.getInstance(
                modalValidasiElement
            );


        if (modalValidasi) {

            modalValidasi.hide();

        }



        // Buka receipt

        setTimeout(function () {


            const modalReceipt =
                new bootstrap.Modal(
                    document.getElementById(
                        'modalReceipt'
                    )
                );


            modalReceipt.show();


        }, 300);

    }

</script>


</body>

</html>