<?php

/**
 * ============================================================
 * HALAMAN PILIH DISPLAY - MPP KOTA TANGERANG
 * ============================================================
 *
 * Kelompok = Zona suara.
 * Grup = Data tampilan.
 *
 * Setiap opsi Grup menampilkan daftar nama instansi:
 *
 * Grup 1 (Bapenda, Disnaker, BPJS Kesehatan)
 *
 * Nama instansi berasal dari database.
 */

$kelompok = isset($kelompok) && is_array($kelompok)
    ? $kelompok
    : [];

$grup = isset($grup) && is_array($grup)
    ? $grup
    : [];

?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1"
    >

    <title>Pilih Display - MPP Kota Tangerang</title>

    <style>
        /* ====================================================
           1. WARNA UTAMA
        ==================================================== */

        :root {
            --navy: #122b52;
            --navy-dark: #0b1d39;
            --blue: #2860b7;
            --yellow: #f5c842;
            --background: #eef2f8;
            --text: #1b2c46;
            --muted: #748198;
            --border: #dce4ef;
        }

        * {
            box-sizing: border-box;
        }

        html,
        body {
            min-height: 100%;
            margin: 0;
        }

        body {
            display: flex;
            flex-direction: column;

            min-height: 100vh;

            background: var(--background);
            color: var(--text);

            font-family: Arial, Helvetica, sans-serif;
        }

        /* ====================================================
           2. HEADER
        ==================================================== */

        .page-header {
            min-height: 86px;

            display: flex;
            align-items: center;
            justify-content: center;

            padding: 12px 20px;

            background: linear-gradient(
                115deg,
                #10264b 0%,
                #1c4485 58%,
                #163365 100%
            );

            border-bottom: 4px solid var(--yellow);
        }

        .header-content {
            width: 100%;
            max-width: 950px;

            display: flex;
            align-items: center;
            justify-content: center;
            gap: 18px;
        }

        .header-logo {
            width: 58px;
            height: 58px;
            object-fit: contain;
        }

        .header-title {
            color: #ffffff;

            font-size: clamp(15px, 2vw, 22px);
            font-weight: 800;
            line-height: 1.4;
            letter-spacing: 1.5px;

            text-align: center;
        }

        .header-title span {
            display: block;
            color: var(--yellow);
        }

        /* ====================================================
           3. KONTEN UTAMA
        ==================================================== */

        .page-main {
            flex: 1;

            display: flex;
            align-items: center;
            justify-content: center;

            padding: 25px 16px;
        }

        .selection-card {
            width: 100%;
            max-width: 440px;

            overflow: hidden;

            border: 1px solid var(--border);
            border-radius: 14px;

            background: #ffffff;

            box-shadow: 0 12px 35px rgba(
                16,
                43,
                88,
                0.09
            );
        }

        /* ====================================================
           4. HEADER FORM
        ==================================================== */

        .card-header {
            padding: 21px 24px 17px;

            border-bottom: 1px solid #e8edf5;

            text-align: center;
        }

        .card-icon {
            width: 46px;
            height: 46px;

            display: flex;
            align-items: center;
            justify-content: center;

            margin: 0 auto 12px;

            border-radius: 12px;

            background: #fff4cc;
            color: var(--navy);

            font-size: 23px;
        }

        .card-title {
            margin: 0;

            color: var(--navy);

            font-size: 19px;
            font-weight: 800;
        }

        .card-subtitle {
            margin: 7px 0 0;

            color: var(--muted);

            font-size: 12px;
            line-height: 1.6;
        }

        /* ====================================================
           5. FORM
        ==================================================== */

        .selection-form {
            padding: 22px 24px 24px;
        }

        .form-group {
            margin-bottom: 18px;
        }

        .form-label {
            display: block;

            margin-bottom: 8px;

            color: var(--navy);

            font-size: 12px;
            font-weight: 800;
        }

        .required {
            color: #dc3545;
        }

        .form-select {
            width: 100%;
            height: 45px;

            padding: 0 12px;

            border: 1px solid #d7e0ed;
            border-radius: 8px;

            background: #ffffff;
            color: var(--text);

            font-family: inherit;
            font-size: 13px;

            cursor: pointer;
        }

        .form-select:focus {
            outline: none;

            border-color: var(--blue);

            box-shadow: 0 0 0 3px rgba(
                40,
                96,
                183,
                0.12
            );
        }

        .form-help {
            margin-top: 7px;

            color: var(--muted);

            font-size: 11px;
            line-height: 1.5;
        }

        /* ====================================================
           6. KETERANGAN
        ==================================================== */

        .selection-info {
            margin-bottom: 18px;
            padding: 11px 13px;

            border: 1px solid #dbe8fa;
            border-radius: 8px;

            background: #f3f7ff;
        }

        .selection-info-title {
            margin-bottom: 6px;

            color: var(--navy);

            font-size: 11px;
            font-weight: 800;
        }

        .selection-info-text {
            color: #62718a;

            font-size: 11px;
            line-height: 1.7;
        }

        /* ====================================================
           7. TOMBOL
        ==================================================== */

        .submit-button {
            width: 100%;
            height: 46px;

            display: flex;
            align-items: center;
            justify-content: center;
            gap: 9px;

            border: none;
            border-radius: 8px;

            background: var(--yellow);
            color: var(--navy-dark);

            font-family: inherit;
            font-size: 13px;
            font-weight: 800;

            cursor: pointer;
        }

        .submit-button:hover:not(:disabled) {
            background: #ffdb61;
        }

        .submit-button:disabled {
            background: #e5e7eb;
            color: #9ca3af;
            cursor: not-allowed;
        }

        .error-message {
            display: none;

            margin-bottom: 15px;
            padding: 10px 12px;

            border: 1px solid #f5c2c7;
            border-radius: 7px;

            background: #fff1f2;
            color: #b42318;

            font-size: 12px;
            line-height: 1.5;
        }

        .error-message.show {
            display: block;
        }

        /* ====================================================
           8. FOOTER
        ==================================================== */

        .page-footer {
            min-height: 36px;

            display: flex;
            align-items: center;
            justify-content: center;

            padding: 10px 15px;

            background: var(--yellow);
            color: #382900;

            font-size: 11px;
            font-weight: 800;
            text-align: center;
        }

        /* ====================================================
           9. RESPONSIVE
        ==================================================== */

        @media (max-width: 600px) {
            .page-header {
                min-height: 75px;
                padding: 10px;
            }

            .header-content {
                gap: 10px;
            }

            .header-logo {
                width: 42px;
                height: 42px;
            }

            .header-title {
                font-size: 13px;
                letter-spacing: 0.5px;
            }

            .page-main {
                padding: 20px 12px;
            }

            .selection-form {
                padding: 20px 18px;
            }

            .card-header {
                padding: 19px 16px;
            }

            .page-footer {
                font-size: 10px;
            }
        }

        
        /* ====================================================
           10. FORM COMPACT
           Memperkecil form supaya tidak perlu scroll
        ==================================================== */

        .page-header {
            min-height: 60px;
            padding: 6px 12px;
        }

        .header-logo {
            width: 40px;
            height: 40px;
        }

        .header-title {
            font-size: 14px;
            letter-spacing: 1px;
        }

        .page-main {
            padding: 10px 12px;
        }

        .selection-card {
            max-width: 350px;
            border-radius: 12px;
        }

        .card-header {
            padding: 12px 16px 10px;
        }

        .card-icon {
            width: 32px;
            height: 32px;
            margin-bottom: 6px;
            font-size: 17px;
        }

        .card-title {
            font-size: 17px;
        }

        .card-subtitle {
            margin-top: 4px;
            font-size: 11px;
            line-height: 1.4;
        }

        .selection-form {
            padding: 14px 16px 16px;
        }

        .form-group {
            margin-bottom: 11px;
        }

        .form-label {
            margin-bottom: 5px;
            font-size: 12px;
        }

        .form-select {
            height: 38px;
            padding: 0 10px;
            font-size: 12px;
        }

        .form-help {
            margin-top: 4px;
            font-size: 10px;
            line-height: 1.4;
        }

        .selection-info {
            margin-bottom: 11px;
            padding: 8px 10px;
        }

        .selection-info-title {
            margin-bottom: 3px;
            font-size: 10px;
        }

        .selection-info-text {
            font-size: 10px;
            line-height: 1.4;
        }

        .submit-button {
            height: 39px;
            font-size: 12px;
        }

        .page-footer {
            min-height: 28px;
            padding: 6px 10px;
            font-size: 10px;
        }

        /* Layar dengan tinggi terbatas */
        @media (max-height: 650px) {
            .page-main {
                padding: 7px 10px;
            }

            .card-icon {
                display: none;
            }

            .card-header {
                padding: 9px 14px;
            }

            .selection-form {
                padding: 11px 14px;
            }

            .form-group {
                margin-bottom: 8px;
            }

            .selection-info {
                margin-bottom: 8px;
            }
        }

        /* Ukuran HP */
        @media (max-width: 600px) {
            .page-header {
                min-height: 56px;
                padding: 6px 10px;
            }

            .header-logo {
                width: 32px;
                height: 32px;
            }

            .header-title {
                font-size: 11px;
                letter-spacing: 0.3px;
            }

            .selection-card {
                max-width: 330px;
            }

            .selection-form {
                padding: 12px 14px;
            }
        }

    </style>
</head>

<body>

    <!-- ====================================================
         10. HEADER
    ===================================================== -->

    <header class="page-header">

        <div class="header-content">

            <img
                class="header-logo"
                src="<?= base_url('assets/images/logokota.png') ?>"
                alt="Logo Kota Tangerang"
            >

            <div class="header-title">
                MAL PELAYANAN PUBLIK
                <span>KOTA TANGERANG</span>
            </div>

            <img
                class="header-logo"
                src="<?= base_url('assets/images/mpp2.png') ?>"
                alt="Logo MPP"
            >

        </div>

    </header>

    <!-- ====================================================
         11. FORM PEMILIHAN
    ===================================================== -->

    <main class="page-main">

        <section class="selection-card">

            <div class="card-header">

                <div
                    class="card-icon"
                    aria-hidden="true"
                >
                    ▣
                </div>

                <h1 class="card-title">
                    Pilih Display
                </h1>

                <p class="card-subtitle">
                    Tentukan zona suara dan grup instansi
                    yang akan ditampilkan.
                </p>

            </div>

            <form
                id="displayForm"
                class="selection-form"
                autocomplete="off"
            >

                <!-- Pesan error -->
                <div
                    id="errorMessage"
                    class="error-message"
                    role="alert"
                ></div>

                <!-- ========================================
                     KELOMPOK SUARA
                ========================================= -->

                <div class="form-group">

                    <label
                        class="form-label"
                        for="kelompokSelect"
                    >
                        Kelompok Suara
                        <span class="required">*</span>
                    </label>

                    <select
                        id="kelompokSelect"
                        name="kelompok_id"
                        class="form-select"
                        required
                    >

                        <option value="">
                            -- Pilih Kelompok Suara --
                        </option>

                        <?php foreach ($kelompok as $item): ?>

                            <option
                                value="<?= (int) ($item['id'] ?? 0) ?>"
                            >
                                <?= esc(
                                    $item['nama_kelompok'] ?? '',
                                    'html'
                                ) ?>
                            </option>

                        <?php endforeach; ?>

                    </select>

                    <div class="form-help">
                        Kelompok menentukan zona suara
                        panggilan antrean.
                    </div>

                </div>

                <!-- ========================================
                     GRUP TAMPILAN
                ========================================= -->

                <div class="form-group">

                    <label
                        class="form-label"
                        for="grupSelect"
                    >
                        Grup Tampilan
                        <span class="required">*</span>
                    </label>

                    <select
                        id="grupSelect"
                        name="grup_id"
                        class="form-select"
                        required
                    >

                        <option value="">
                            -- Pilih Grup Tampilan --
                        </option>

                        <?php foreach ($grup as $item): ?>

                            <?php
                                // Nama grup.
                                $namaGrup = (string) (
                                    $item['nama_grup'] ?? ''
                                );

                                // Daftar instansi dari controller.
                                $daftarInstansi =
                                    $item['daftar_instansi'] ?? [];

                                // Pastikan berupa array.
                                if (!is_array($daftarInstansi)) {
                                    $daftarInstansi = [];
                                }

                                // Format daftar instansi.
                                $namaInstansi = !empty($daftarInstansi)
                                    ? implode(', ', $daftarInstansi)
                                    : 'Belum ada instansi';

                                // Label lengkap dropdown.
                                $labelGrup =
                                    $namaGrup
                                    . ' ('
                                    . $namaInstansi
                                    . ')';
                            ?>

                            <option
                                value="<?= (int) ($item['id'] ?? 0) ?>"
                            >
                                <?= esc($labelGrup, 'html') ?>
                            </option>

                        <?php endforeach; ?>

                    </select>

                    <div class="form-help">
                        Nama instansi dalam kurung menunjukkan
                        anggota masing-masing Grup.
                    </div>

                </div>

                <!-- ========================================
                     INFORMASI
                ========================================= -->

                <div class="selection-info">

                    <div class="selection-info-title">
                        Informasi Display
                    </div>

                    <div class="selection-info-text">
                        Kelompok suara dan Grup tampilan
                        dapat dipilih secara terpisah.
                        Daftar Grup tidak dibatasi
                        oleh Kelompok yang dipilih.
                    </div>

                </div>

                <!-- ========================================
                     SUBMIT
                ========================================= -->

                <button
                    id="submitButton"
                    class="submit-button"
                    type="submit"
                    disabled
                >
                    <span aria-hidden="true">▣</span>
                    Tampilkan Display
                </button>

            </form>

        </section>

    </main>

    <!-- ====================================================
         12. FOOTER
    ===================================================== -->

    <footer class="page-footer">

        MAL PELAYANAN PUBLIK KOTA TANGERANG

        &nbsp; | &nbsp;

        SISTEM DISPLAY ANTREAN

    </footer>

    <!-- ====================================================
         13. JAVASCRIPT
    ===================================================== -->

    <script>
        'use strict';

        // ====================================================
        // A. URL DISPLAY
        // ====================================================

        const DISPLAY_BASE_URL = <?= json_encode(
            rtrim(site_url('display/layar'), '/'),
            JSON_HEX_TAG
            | JSON_HEX_AMP
            | JSON_HEX_APOS
            | JSON_HEX_QUOT
        ) ?>;

        // ====================================================
        // B. ELEMEN FORM
        // ====================================================

        const form = document.getElementById(
            'displayForm'
        );

        const kelompokSelect = document.getElementById(
            'kelompokSelect'
        );

        const grupSelect = document.getElementById(
            'grupSelect'
        );

        const submitButton = document.getElementById(
            'submitButton'
        );

        const errorMessage = document.getElementById(
            'errorMessage'
        );

        // ====================================================
        // C. ERROR
        // ====================================================

        function showError(message) {
            errorMessage.textContent = message;

            errorMessage.classList.add(
                'show'
            );
        }

        function clearError() {
            errorMessage.textContent = '';

            errorMessage.classList.remove(
                'show'
            );
        }

        // ====================================================
        // D. VALIDASI ID
        // ====================================================

        function isValidId(value) {
            const id = Number(value);

            return Number.isSafeInteger(id)
                && id > 0;
        }

        // ====================================================
        // E. UPDATE TOMBOL
        // ====================================================

        function updateSubmitButton() {
            const kelompokId = kelompokSelect.value;
            const grupId = grupSelect.value;

            const valid =
                isValidId(kelompokId)
                && isValidId(grupId);

            submitButton.disabled = !valid;

            clearError();
        }

        // ====================================================
        // F. EVENT PILIHAN
        // ====================================================

        /**
         * Kedua dropdown independen.
         *
         * Mengubah Kelompok tidak akan:
         * - Menghapus pilihan Grup.
         * - Memfilter pilihan Grup.
         * - Mengubah daftar instansi.
         */
        kelompokSelect.addEventListener(
            'change',
            updateSubmitButton
        );

        grupSelect.addEventListener(
            'change',
            updateSubmitButton
        );

        // ====================================================
        // G. SUBMIT FORM
        // ====================================================

        form.addEventListener(
            'submit',
            function (event) {
                event.preventDefault();

                clearError();

                const kelompokId = Number(
                    kelompokSelect.value
                );

                const grupId = Number(
                    grupSelect.value
                );

                if (!isValidId(kelompokId)) {
                    showError(
                        'Silakan pilih Kelompok suara.'
                    );

                    kelompokSelect.focus();

                    return;
                }

                if (!isValidId(grupId)) {
                    showError(
                        'Silakan pilih Grup tampilan.'
                    );

                    grupSelect.focus();

                    return;
                }

                // Token khusus untuk tab browser ini
                // dan Kelompok yang dipilih.
                const storageKey =
                    'mpp_display_owner_' + kelompokId;

                let ownerToken = sessionStorage.getItem(
                    storageKey
                );

                // Buat token baru jika belum tersedia
                // atau format token tidak valid.
                if (!/^[a-f0-9]{64}$/.test(ownerToken || '')) {
                    const randomBytes = new Uint8Array(32);

                    crypto.getRandomValues(randomBytes);

                    ownerToken = Array.from(randomBytes)
                        .map(byte => byte.toString(16).padStart(2, '0'))
                        .join('');

                    sessionStorage.setItem(
                        storageKey,
                        ownerToken
                    );
                }

                // URL Display dengan token pemilik tab.
                const targetUrl =
                    DISPLAY_BASE_URL
                    + '/'
                    + kelompokId
                    + '/'
                    + grupId
                    + '?owner_token='
                    + encodeURIComponent(ownerToken);

                submitButton.disabled = true;

                submitButton.textContent =
                    'Membuka Display...';

                window.location.assign(
                    targetUrl
                );
            }
        );
        // ====================================================
        // H. INISIALISASI
        // ====================================================

        updateSubmitButton();

    </script>

</body>
</html>