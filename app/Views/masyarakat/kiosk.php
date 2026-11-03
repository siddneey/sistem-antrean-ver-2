<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mal Pelayanan Publik Kota Tangerang</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

    <style>
        /* =====================================================
           WARNA DAN DASAR TAMPILAN
        ===================================================== */
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
        * { box-sizing: border-box; }
        body {
            margin: 0;
            min-height: 100vh;
            background:
                radial-gradient(circle at 10% 0%, rgba(244,196,48,.08), transparent 25%),
                radial-gradient(circle at 100% 100%, rgba(33,79,125,.18), transparent 30%),
                var(--navy-dark);
            font-family: "Segoe UI", Arial, sans-serif;
            color: var(--navy);
        }

        /* =====================================================
           WRAPPER DAN HEADER
        ===================================================== */
        .kiosk-wrapper { width: 100%; max-width: 1320px; min-height: 100vh; margin: 0 auto; padding: 24px; }
        .kiosk-container {
            min-height: calc(100vh - 48px);
            background: var(--soft-white);
            border-radius: 22px;
            overflow: hidden;
            box-shadow: 0 25px 70px rgba(0,0,0,.28);
        }
        .kiosk-header {
            position: relative;
            min-height: 190px;
            padding: 28px 35px;
            background: linear-gradient(120deg,#07182d 0%,#0b2341 55%,#12375e 100%);
            color: white;
            overflow: hidden;
        }
        .header-circle-one {
            position: absolute; width: 310px; height: 310px; right: -100px; top: -155px;
            border: 50px solid rgba(244,196,48,.08); border-radius: 50%;
        }
        .header-circle-two {
            position: absolute; width: 180px; height: 180px; right: 100px; bottom: -115px;
            border: 25px solid rgba(255,255,255,.04); border-radius: 50%;
        }
        .header-pattern {
            position: absolute; right: 30px; bottom: 22px; width: 100px; height: 70px; opacity: .15;
            background-image: linear-gradient(45deg,transparent 45%,var(--yellow) 45%,var(--yellow) 55%,transparent 55%);
            background-size: 18px 18px;
        }
        .header-content { position: relative; z-index: 5; display: flex; align-items: center; gap: 20px; }
        .header-logo {
            position: relative; width: 72px; height: 72px; min-width: 72px; border-radius: 18px;
            background: white; color: var(--navy); display: flex; align-items: center;
            justify-content: center; font-size: 34px; box-shadow: 0 8px 25px rgba(0,0,0,.2);
        }
        .header-logo::after {
            content: ""; position: absolute; width: 13px; height: 13px; right: -5px; bottom: -5px;
            background: var(--yellow); border: 3px solid var(--navy); border-radius: 50%;
        }
        .header-info { display: flex; flex-direction: column; }
        .header-badge {
            display: inline-flex; align-items: center; gap: 6px; width: fit-content;
            padding: 5px 10px; margin-bottom: 7px; border: 1px solid rgba(244,196,48,.35);
            border-radius: 20px; background: rgba(244,196,48,.08); color: var(--yellow);
            font-size: 10px; font-weight: 700; letter-spacing: 1.1px;
        }
        .header-title { margin: 0; font-size: 29px; line-height: 1.15; font-weight: 750; letter-spacing: -.5px; }
        .header-title span { color: var(--yellow); }
        .header-subtitle { margin: 7px 0 0; color: rgba(255,255,255,.67); font-size: 13px; }
        .header-line { width: 60px; height: 4px; margin-top: 13px; border-radius: 10px; background: var(--yellow); }

        /* =====================================================
           TOOLBAR DAN DROPDOWN
        ===================================================== */
        .toolbar {
            display: flex; align-items: center; justify-content: space-between; gap: 20px;
            padding: 18px 30px; background: white; border-bottom: 1px solid #edf0f3;
        }
        .toolbar-left { display: flex; align-items: center; gap: 11px; }
        .toolbar-icon {
            width: 38px; height: 38px; border-radius: 10px; background: #eef2f7;
            color: var(--navy); display: flex; align-items: center; justify-content: center; font-size: 18px;
        }
        .toolbar-title { margin: 0; font-size: 13px; font-weight: 700; color: var(--navy); }
        .toolbar-description { margin: 2px 0 0; font-size: 11px; color: var(--gray); }
        .service-select-wrapper { position: relative; min-width: 225px; }
        .service-select-label {
            position: absolute; left: 13px; top: -7px; padding: 0 5px; background: white;
            color: var(--gray); font-size: 10px; font-weight: 600; z-index: 2;
        }
        .service-select { position: relative; width: 100%; }
        .service-select-button {
            width: 100%; height: 43px; padding: 0 38px 0 13px; border: 1px solid var(--border);
            border-radius: 9px; background: white; color: rgba(107,114,128,.65);
            font-size: 12px; font-weight: 400; font-style: italic; text-align: left;
            cursor: pointer; outline: none; position: relative;
        }
        .service-select-button::after {
            content: ""; position: absolute; right: 14px; top: 50%; width: 7px; height: 7px;
            border-right: 1.5px solid #64748b; border-bottom: 1.5px solid #64748b;
            transform: translateY(-65%) rotate(45deg); transition: transform .18s ease;
        }
        .service-select-button[aria-expanded="true"] { border-color: var(--navy-light); box-shadow: 0 0 0 3px rgba(23,61,104,.08); }
        .service-select-button[aria-expanded="true"]::after { transform: translateY(-20%) rotate(225deg); }
        .service-select-button.selected { color: var(--navy); font-weight: 600; font-style: normal; }
        .service-select .dropdown-menu {
            width: 100%; margin-top: 6px !important; padding: 6px; border: 1px solid var(--border);
            border-radius: 10px; background: white; box-shadow: 0 10px 25px rgba(11,35,65,.12);
        }
        .service-select .dropdown-item { padding: 10px 12px; border-radius: 7px; color: var(--navy); font-size: 12px; font-weight: 500; }
        .service-select .dropdown-item:hover, .service-select .dropdown-item:focus { background: #f1f4f8; color: var(--navy); }

        /* =====================================================
           GRID DAN KARTU INSTANSI
        ===================================================== */
        .kiosk-content { padding: 25px 30px 20px; }
        .section-header { display: flex; align-items: flex-end; justify-content: space-between; gap: 20px; margin-bottom: 18px; }
        .section-title { margin: 0; font-size: 20px; font-weight: 750; color: var(--navy); }
        .section-subtitle { margin: 4px 0 0; font-size: 13px; color: var(--gray); }
        .section-badge {
            display: flex; align-items: center; gap: 7px; padding: 7px 12px;
            border-radius: 20px; background: #eef2f7; color: var(--navy); font-size: 11px; font-weight: 600;
        }
        .section-badge i { color: var(--yellow-dark); }
        .instansi-grid { display: grid; grid-template-columns: repeat(5,minmax(0,1fr)); gap: 14px; }
        .instansi-card {
            position: relative; width: 100%; min-height: 125px; padding: 15px 12px;
            border: 1px solid var(--border); border-radius: 14px; background: white;
            color: var(--navy); cursor: pointer; overflow: hidden;
            transition: transform .18s ease,box-shadow .18s ease,border-color .18s ease;
        }
        .instansi-card::before {
            content: ""; position: absolute; left: 0; top: 0; bottom: 0; width: 4px;
            background: var(--yellow); transform: scaleY(0); transform-origin: center;
            transition: transform .18s ease;
        }
        .instansi-card:hover { transform: translateY(-3px); border-color: rgba(11,35,65,.25); box-shadow: 0 8px 20px rgba(11,35,65,.12); }
        .instansi-card:hover::before { transform: scaleY(1); }
        .instansi-card:active { transform: translateY(-1px); }
        .instansi-card-inner { height: 100%; min-height: 92px; display: flex; flex-direction: column; align-items: center; justify-content: center; }
        .instansi-icon {
            width: 46px; height: 46px; margin-bottom: 9px; border-radius: 11px;
            background: var(--navy); color: var(--yellow); display: flex;
            align-items: center; justify-content: center; font-size: 21px;
        }
        .instansi-name { width: 100%; text-align: center; font-size: 13px; line-height: 1.25; font-weight: 650; color: var(--navy); }
        .instansi-status { grid-column: 1 / -1; color: var(--gray); font-size: 13px; }
        .kiosk-footer { display: flex; align-items: center; justify-content: center; gap: 8px; padding: 15px 20px 20px; color: #7b8490; font-size: 11px; }
        .status-dot { width: 7px; height: 7px; border-radius: 50%; background: var(--yellow); }

        /* =====================================================
           MODAL, KALENDER, DAN PILIHAN ANTREAN
        ===================================================== */
        .modal-content { border: none; border-radius: 18px; overflow: hidden; box-shadow: 0 20px 50px rgba(0,0,0,.25); }
        .modal-header { background: var(--navy); color: white; border-bottom: none; padding: 20px 22px; }
        .modal-title { font-size: 17px; font-weight: 700; }
        .modal-header .btn-close { filter: brightness(0) invert(1); opacity: .8; }
        .modal-body { padding: 25px; }
        .booking-info, .selected-instansi { padding: 14px; border-radius: 11px; background: #f1f4f8; border-left: 4px solid var(--yellow); margin-bottom: 20px; }
        .booking-info-label, .selected-instansi-label { font-size: 11px; color: var(--gray); }
        .booking-info-name, .selected-instansi-name { margin-top: 3px; font-size: 17px; font-weight: 700; color: var(--navy); }
        .date-title { margin-bottom: 11px; font-size: 13px; font-weight: 700; color: var(--navy); }
        .date-grid { display: grid; grid-template-columns: repeat(5,1fr); gap: 9px; }
        .date-option {
            min-height: 76px; padding: 9px 5px; border: 1px solid var(--border);
            border-radius: 10px; background: white; cursor: pointer; text-align: center;
            transition: all .18s ease;
        }
        .date-option:hover:not(.disabled) { border-color: var(--navy); transform: translateY(-2px); }
        .date-option.active { background: var(--navy); border-color: var(--navy); color: white; }
        .date-option.disabled { background: #e5e8ec; color: #9aa1aa; border-color: #d9dde2; cursor: not-allowed; opacity: .75; }
        .date-day { display: block; font-size: 10px; font-weight: 600; text-transform: uppercase; }
        .date-number { display: block; margin-top: 4px; font-size: 20px; line-height: 1; font-weight: 750; }
        .date-month { display: block; margin-top: 4px; font-size: 9px; }
        .queue-title { margin-bottom: 12px; font-size: 14px; font-weight: 700; color: var(--navy); }
        .queue-options { display: grid; grid-template-columns: 1fr 1fr; gap: 12px; }
        .queue-option { border: 2px solid var(--border); background: white; border-radius: 13px; padding: 18px 12px; cursor: pointer; text-align: center; transition: all .18s ease; }
        .queue-option:hover { border-color: var(--navy-light); }
        .queue-option.active { border-color: var(--yellow); background: #fff9df; }
        .queue-option-icon { width: 43px; height: 43px; margin: 0 auto 9px; border-radius: 50%; background: var(--navy); color: var(--yellow); display: flex; align-items: center; justify-content: center; font-size: 20px; }
        .queue-option-name { font-size: 14px; font-weight: 700; color: var(--navy); }
        .queue-option-desc { margin-top: 3px; font-size: 11px; color: var(--gray); }
        .error-message { display: none; margin-top: 14px; padding: 10px 12px; border-radius: 8px; background: #fff0f0; color: #b42318; font-size: 12px; }
        .modal-footer { border-top: 1px solid #edf0f3; padding: 15px 20px; }
        .btn-kiosk-primary, .btn-kiosk-yellow { border: none; padding: 10px 20px; border-radius: 9px; font-weight: 700; }
        .btn-kiosk-primary { background: var(--navy); color: white; }
        .btn-kiosk-primary:hover { background: var(--navy-light); color: white; }
        .btn-kiosk-yellow { background: var(--yellow); color: var(--navy); }
        .btn-kiosk-yellow:hover { background: var(--yellow-dark); color: var(--navy); }

        /* =====================================================
           STRUK ANTREAN
        ===================================================== */
        .receipt { text-align: center; padding: 10px; }
        .receipt-logo { width: 60px; height: 60px; margin: 0 auto 12px; border-radius: 14px; background: var(--navy); color: var(--yellow); display: flex; align-items: center; justify-content: center; font-size: 28px; }
        .receipt-title { margin: 0; font-size: 18px; font-weight: 750; color: var(--navy); }
        .receipt-subtitle { margin: 4px 0 18px; color: var(--gray); font-size: 12px; }
        .receipt-number-box { padding: 20px; border-radius: 14px; background: var(--navy); color: white; margin-bottom: 18px; }
        .receipt-number-label { font-size: 11px; color: rgba(255,255,255,.7); }
        .receipt-number { margin-top: 2px; font-size: 42px; line-height: 1; font-weight: 800; color: var(--yellow); letter-spacing: 2px; }
        .receipt-info { text-align: left; border-top: 1px dashed #d7dce2; border-bottom: 1px dashed #d7dce2; padding: 13px 0; }
        .receipt-info-row { display: flex; justify-content: space-between; gap: 15px; margin-bottom: 7px; font-size: 12px; }
        .receipt-info-row:last-child { margin-bottom: 0; }
        .receipt-info-label { color: var(--gray); }
        .receipt-info-value { color: var(--navy); font-weight: 700; text-align: right; }

        /* =====================================================
           RESPONSIVE
        ===================================================== */
        @media (max-width: 1199px) { .instansi-grid { grid-template-columns: repeat(4,minmax(0,1fr)); } }
        @media (max-width: 991px) {
            .instansi-grid { grid-template-columns: repeat(3,minmax(0,1fr)); }
            .toolbar { align-items: flex-start; flex-direction: column; }
            .service-select-wrapper { width: 100%; }
            .kiosk-wrapper { padding: 15px; }
            .kiosk-container { min-height: calc(100vh - 30px); }
            .kiosk-content { padding: 22px; }
        }
        @media (max-width: 767px) {
            .instansi-grid { grid-template-columns: repeat(2,minmax(0,1fr)); }
            .kiosk-header { min-height: 165px; }
            .header-title { font-size: 22px; }
            .header-subtitle { font-size: 12px; }
            .section-header { align-items: flex-start; flex-direction: column; }
            .section-badge { display: none; }
            .date-grid { grid-template-columns: repeat(3,1fr); }
        }
        @media (max-width: 575px) {
            .kiosk-wrapper { padding: 0; }
            .kiosk-container { border-radius: 0; min-height: 100vh; }
            .kiosk-header { padding: 22px 18px; }
            .header-content { gap: 13px; }
            .header-logo { width: 55px; height: 55px; min-width: 55px; font-size: 25px; }
            .header-title { font-size: 18px; }
            .header-badge { font-size: 8px; }
            .header-subtitle { font-size: 11px; }
            .toolbar { padding: 15px; }
            .kiosk-content { padding: 18px 15px; }
            .instansi-grid { grid-template-columns: repeat(2,minmax(0,1fr)); gap: 10px; }
            .instansi-card { min-height: 105px; }
            .queue-options { grid-template-columns: 1fr; }
            .date-grid { grid-template-columns: repeat(3,1fr); }
        }

        /* =====================================================
           PRINT STRUK THERMAL 80MM
        ===================================================== */
        @media print {
            @page { size: 80mm auto; margin: 0; }
            html, body {
                width: 80mm !important; min-width: 80mm !important; max-width: 80mm !important;
                height: auto !important; min-height: 0 !important; margin: 0 !important;
                padding: 0 !important; background: white !important; overflow: visible !important;
                display: block !important;
            }
            .kiosk-wrapper, .kiosk-container {
                width: 80mm !important; min-width: 80mm !important; max-width: 80mm !important;
                height: auto !important; min-height: 0 !important; margin: 0 !important;
                padding: 0 !important; background: white !important; display: block !important;
                border: none !important; border-radius: 0 !important; box-shadow: none !important;
                overflow: visible !important;
            }
            .kiosk-header, .toolbar, .kiosk-content, .kiosk-footer,
            #modalTanggal, #modalValidasi, .modal-backdrop { display: none !important; }
            #modalReceipt, #modalReceipt .modal-dialog,
            #modalReceipt .modal-content, #modalReceipt .modal-body {
                position: static !important; display: block !important;
                width: 80mm !important; min-width: 80mm !important; max-width: 80mm !important;
                height: auto !important; min-height: 0 !important; margin: 0 !important;
                padding: 0 !important; border: none !important; border-radius: 0 !important;
                background: white !important; box-shadow: none !important; overflow: visible !important;
                opacity: 1 !important; visibility: visible !important; transform: none !important;
                top: auto !important; right: auto !important; bottom: auto !important; left: auto !important;
                float: none !important;
            }
            #modalReceipt .modal-header, #modalReceipt .modal-footer { display: none !important; }
            #modalReceipt .receipt {
                display: block !important; box-sizing: border-box !important;
                width: 72mm !important; min-width: 72mm !important; max-width: 72mm !important;
                height: auto !important; min-height: 0 !important;
                margin: 0 4mm !important; padding: 5mm 2mm !important;
                background: white !important; position: static !important;
                text-align: center !important; overflow: visible !important;
            }
            #modalReceipt .receipt-logo {
                width: 14mm !important; height: 14mm !important; margin: 0 auto 3mm !important;
                border-radius: 3mm !important; display: flex !important; align-items: center !important;
                justify-content: center !important; background: var(--navy) !important;
                color: var(--yellow) !important; font-size: 7mm !important;
            }
            #modalReceipt .receipt-title { margin: 0 !important; padding: 0 !important; font-size: 4.5mm !important; line-height: 1.2 !important; color: var(--navy) !important; }
            #modalReceipt .receipt-subtitle { margin: 1mm 0 4mm !important; padding: 0 !important; font-size: 3mm !important; line-height: 1.2 !important; color: #6b7280 !important; }
            #modalReceipt .receipt-number-box { width: 100% !important; margin: 0 0 4mm !important; padding: 4mm !important; box-sizing: border-box !important; border-radius: 3mm !important; background: var(--navy) !important; color: white !important; }
            #modalReceipt .receipt-number-label { margin: 0 !important; padding: 0 !important; font-size: 2.8mm !important; color: rgba(255,255,255,.75) !important; }
            #modalReceipt .receipt-number { margin: 1mm 0 0 !important; padding: 0 !important; font-size: 11mm !important; line-height: 1 !important; font-weight: 800 !important; letter-spacing: .5mm !important; color: var(--yellow) !important; }
            #modalReceipt .receipt-info { width: 100% !important; margin: 0 !important; padding: 3mm 0 !important; border-top: 1px dashed #999 !important; border-bottom: 1px dashed #999 !important; text-align: left !important; box-sizing: border-box !important; }
            #modalReceipt .receipt-info-row { display: flex !important; justify-content: space-between !important; align-items: flex-start !important; width: 100% !important; margin: 0 0 2mm !important; padding: 0 !important; gap: 3mm !important; font-size: 3mm !important; line-height: 1.25 !important; }
            #modalReceipt .receipt-info-row:last-child { margin-bottom: 0 !important; }
            #modalReceipt .receipt-info-label { flex: 0 0 auto !important; margin: 0 !important; padding: 0 !important; color: #6b7280 !important; }
            #modalReceipt .receipt-info-value { flex: 1 1 auto !important; max-width: 45mm !important; margin: 0 !important; padding: 0 !important; color: var(--navy) !important; font-weight: 700 !important; text-align: right !important; word-break: break-word !important; overflow-wrap: break-word !important; }
            #modalReceipt .receipt > * { box-sizing: border-box !important; }
            .modal.fade, .modal.show { opacity: 1 !important; }
            #modalReceipt.fade { transition: none !important; }
            #modalReceipt .modal-dialog-centered { display: block !important; min-height: 0 !important; }
        }
    </style>
</head>
<body>
    <!-- =====================================================
         HALAMAN UTAMA KIOSK
    ===================================================== -->
    <div class="kiosk-wrapper">
        <div class="kiosk-container">
            <header class="kiosk-header">
                <div class="header-circle-one"></div>
                <div class="header-circle-two"></div>
                <div class="header-pattern"></div>
                <div class="header-content">
                    <div class="header-logo"><i class="bi bi-buildings"></i></div>
                    <div class="header-info">
                        <div class="header-badge"><i class="bi bi-shield-check"></i> LAYANAN PUBLIK</div>
                        <h1 class="header-title">Mal Pelayanan Publik <span>Kota Tangerang</span></h1>
                        <p class="header-subtitle">Satu tempat untuk berbagai kebutuhan pelayanan masyarakat</p>
                        <div class="header-line"></div>
                    </div>
                </div>
            </header>

            <div class="toolbar">
                <div class="toolbar-left">
                    <div class="toolbar-icon"><i class="bi bi-ticket-perforated"></i></div>
                    <div>
                        <p class="toolbar-title">Layanan Antrean</p>
                        <p class="toolbar-description">Pilih jenis layanan yang ingin digunakan</p>
                    </div>
                </div>
                <div class="service-select-wrapper">
                    <span class="service-select-label">Jenis Layanan</span>
                    <div class="dropdown service-select">
                        <button type="button" class="service-select-button" id="jenisLayananBtn"
                                data-bs-toggle="dropdown" aria-expanded="false" aria-haspopup="true">
                            <span id="jenisLayananText">Pilih</span>
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="jenisLayananBtn">
                            <li><button type="button" class="dropdown-item" onclick="ubahLayanan('HARI_INI', 'Antrian Hari Ini')">Antrian Hari Ini</button></li>
                            <li><button type="button" class="dropdown-item" onclick="ubahLayanan('BOOKING', 'Booking')">Booking</button></li>
                        </ul>
                    </div>
                </div>
            </div>

            <main class="kiosk-content">
                <div class="section-header">
                    <div>
                        <h2 class="section-title">Pilih Instansi</h2>
                        <p class="section-subtitle" id="sectionSubtitle">Silakan pilih instansi yang ingin Anda kunjungi</p>
                    </div>
                    <div class="section-badge"><i class="bi bi-hand-index-thumb"></i> Ketuk pilihan layanan</div>
                </div>
                <!-- Diisi dari GET /masyarakat/instansi; tidak ada ID instansi hardcoded. -->
                <div class="instansi-grid" id="instansiGrid" aria-live="polite">
                    <p class="instansi-status">Memuat daftar instansi...</p>
                </div>
            </main>

            <footer class="kiosk-footer">
                <span class="status-dot"></span>
                Silakan pilih instansi untuk melanjutkan proses layanan
            </footer>
        </div>
    </div>

    <!-- =====================================================
         MODAL TANGGAL BOOKING
    ===================================================== -->
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

    <!-- =====================================================
         MODAL PILIH JENIS ANTREAN
    ===================================================== -->
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
                    <div id="informasiKuota" class="booking-info" role="status" aria-live="polite">Memeriksa kuota...</div>
                    <div class="queue-options">
                        <div class="queue-option" role="button" tabindex="0" data-jenis="BIASA" onclick="pilihJenis('BIASA', this)" onkeydown="if(event.key==='Enter'||event.key===' '){event.preventDefault();pilihJenis('BIASA',this)}">
                            <div class="queue-option-icon"><i class="bi bi-person"></i></div>
                            <div class="queue-option-name">Antrean Biasa</div>
                            <div class="queue-option-desc">Untuk masyarakat umum</div>
                        </div>
                        <div class="queue-option" role="button" tabindex="0" data-jenis="PRIORITAS" onclick="pilihJenis('PRIORITAS', this)" onkeydown="if(event.key==='Enter'||event.key===' '){event.preventDefault();pilihJenis('PRIORITAS',this)}">
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

    <!-- =====================================================
         MODAL INFORMASI LOKET / KUOTA
    ===================================================== -->
    <div class="modal fade" id="modalInformasi" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="bi bi-info-circle me-2"></i>Informasi!</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <div class="modal-body text-center py-4">
                    <div class="mb-3" style="font-size:42px;color:var(--yellow-dark)"><i class="bi bi-exclamation-circle"></i></div>
                    <p id="pesanInformasi" class="fw-semibold mb-0" role="status"></p>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-kiosk-primary" data-bs-dismiss="modal">Tutup</button>
                    <button type="button" class="btn btn-kiosk-yellow d-none" id="btnBookingSekarang">Booking Sekarang <i class="bi bi-calendar-event ms-1"></i></button>
                </div>
            </div>
        </div>
    </div>

    <!-- =====================================================
         MODAL STRUK ANTREAN
    ===================================================== -->
    <div class="modal fade" id="modalReceipt" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Nomor Antrean</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <div class="modal-body">
                    <div class="receipt">
                        <div class="receipt-logo"><i class="bi bi-buildings"></i></div>
                        <h3 class="receipt-title">Mal Pelayanan Publik</h3>
                        <div class="receipt-subtitle">Kota Tangerang</div>
                        <div class="receipt-number-box">
                            <div class="receipt-number-label">NOMOR ANTREAN</div>
                            <div class="receipt-number" id="nomorAntrean">-</div>
                        </div>
                        <div class="receipt-info">
                            <div class="receipt-info-row">
                                <span class="receipt-info-label">Instansi</span>
                                <span class="receipt-info-value" id="receiptInstansi">-</span>
                            </div>
                            <div class="receipt-info-row">
                                <span class="receipt-info-label">Jenis Antrean</span>
                                <span class="receipt-info-value" id="receiptJenis">-</span>
                            </div>
                            <div class="receipt-info-row">
                                <span class="receipt-info-label">Tanggal</span>
                                <span class="receipt-info-value" id="receiptTanggal">-</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-kiosk-primary" onclick="window.print()">
                        <i class="bi bi-printer me-1"></i> Cetak
                    </button>
                    <button type="button" class="btn btn-kiosk-yellow" data-bs-dismiss="modal">Selesai</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        /* =====================================================
           KONFIGURASI API DAN STATE
        ===================================================== */
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
                    tampilkanPopupInformasi('Kuota antrean hari ini sudah habis. Silakan melakukan booking untuk tanggal pelayanan berikutnya.', true);
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
                // Pertahankan instansi yang sudah dipilih, hanya ubah jalur dan tanggal.
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


        const ikonInstansi = {
            'SAMSAT': 'bi-car-front',
            'BAPENDA': 'bi-building',
            'BPKD': 'bi-bank',
            'DISNAKER': 'bi-briefcase',
            'DUKCAPIL': 'bi-person-vcard',
            'TASPEN': 'bi-person',
            'BPJS KESEHATAN': 'bi-heart-pulse',
            'BPJS TK': 'bi-people',
            'PDAM': 'bi-droplet',
            'PENGADILAN AGAMA': 'bi-bank',
            'PLN': 'bi-lightning-charge',
            'ATR BPN': 'bi-map',
            'KEJARI': 'bi-building',
            'POLRES': 'bi-shield',
            'BNN': 'bi-shield-check',
            'BPOM': 'bi-capsule',
            'DINAS LINGKUNGAN HIDUP': 'bi-tree',
            'PT. POS INDONESIA': 'bi-envelope',
            'DITJEN AHU': 'bi-building',
            'PELAYANAN PBG': 'bi-house',
            'DPUPR': 'bi-building',
            'PERKIM': 'bi-house-door',
            'DISHUB': 'bi-bus-front',
            'PTSP 1': 'bi-file-earmark-text',
            'PTSP 2': 'bi-file-earmark-text',
            'BANK BANTEN': 'bi-bank',
            'BANK BJB': 'bi-bank',
            'BAZNAS': 'bi-heart'
        };

        function formatTanggalAPI(date) {
            return [
                date.getFullYear(),
                String(date.getMonth() + 1).padStart(2, '0'),
                String(date.getDate()).padStart(2, '0')
            ].join('-');
        }

        function formatTanggalIndonesia(date) {
            return date.toLocaleDateString('id-ID', {
                day: '2-digit', month: 'long', year: 'numeric'
            });
        }

        /* =====================================================
           INSTANSI DARI MYSQL
        ===================================================== */
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

                    const iconBox = document.createElement('div');
                    iconBox.className = 'instansi-icon';

                    const icon = document.createElement('i');
                    icon.className = 'bi ' + (ikonInstansi[nama.toUpperCase()] || 'bi-building');
                    iconBox.appendChild(icon);

                    const nameBox = document.createElement('div');
                    nameBox.className = 'instansi-name';
                    nameBox.textContent = nama;

                    inner.append(iconBox, nameBox);
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

        /* =====================================================
           PILIH LAYANAN DAN INSTANSI
        ===================================================== */
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
            if (!['BUKA', 'TUTUP'].includes(data.status_loket) ||
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
                ? formatTanggalAPI(tanggalBooking) : formatTanggalAPI(new Date());
            perbaruiInfoKuota(tanggal);
        }

        /* =====================================================
           KALENDER BOOKING H+1 SAMPAI H+7
        ===================================================== */
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
            document.querySelectorAll('.date-option').forEach(item => item.classList.remove('active'));
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

        /* =====================================================
           PILIH JENIS ANTREAN
        ===================================================== */
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

        /* =====================================================
           SIMPAN ANTREAN KE MYSQL DAN TAMPILKAN STRUK
        ===================================================== */
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
                document.getElementById('receiptJenis').textContent = jenisAntrean === 'PRIORITAS'
                    ? 'Antrean Prioritas' : 'Antrean Biasa';
                document.getElementById('receiptTanggal').textContent = formatTanggalIndonesia(tanggalDipilih);

                const modalValidasi = document.getElementById('modalValidasi');
                modalValidasi.addEventListener('hidden.bs.modal', () => {
                    bootstrap.Modal.getOrCreateInstance(document.getElementById('modalReceipt')).show();
                }, { once: true });
                bootstrap.Modal.getOrCreateInstance(modalValidasi).hide();
            } catch (error) {
                console.error('Ambil antrean:', error);
                alert(error.message);
            } finally {
                sedangMengambilAntrean = false;
                tombol.disabled = !kuotaBolehDiambil;
            }
        }

        /* =====================================================
           INISIALISASI HALAMAN
        ===================================================== */
        document.addEventListener('DOMContentLoaded', loadInstansi);
    </script>
</body>
</html>