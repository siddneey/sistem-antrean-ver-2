<?= $this->extend('layouts/admin') ?>

<?= $this->section('pageTitle') ?>
<div class="page-heading">
    <div class="heading-main">
        <div>
            <h1>Instansi</h1>
            <p>Kelola data instansi dan layanan yang tersedia.</p>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('styles') ?>
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

}


/* =====================================================
        CONTENT
===================================================== */

.instansi-content {
padding: 28px 30px 40px;
}
.instansi-header {
display: flex;

            align-items: center;

            gap: 10px;

            margin-bottom: 22px;
}
.instansi-header i {
color: var(--navy);

            font-size: 23px;
}
.instansi-header h1 {
margin: 0;

            color: var(--navy);

            font-size: 25px;

            font-weight: 700;
}
/* =====================================================
           STATISTIK
        ===================================================== */
.instansi-stats {
display: grid;

            grid-template-columns: repeat(3, 1fr);

            gap: 14px;

            margin-bottom: 20px;
}
.stat-card {
background: var(--white);

            border: 1px solid var(--border);

            border-radius: 8px;

            min-height: 78px;

            padding: 14px 16px;

            display: flex;

            align-items: center;

            gap: 13px;
}
.stat-icon {
width: 40px;

            height: 40px;

            min-width: 40px;

            border-radius: 8px;

            background: var(--yellow-soft);

            color: var(--navy);

            display: flex;

            align-items: center;

            justify-content: center;

            font-size: 18px;
}
.stat-info small {
display: block;

            color: var(--muted);

            font-size: 11px;

            margin-bottom: 3px;
}
.stat-info strong {
display: block;

            color: var(--navy);

            font-size: 18px;

            font-weight: 700;
}
/* =====================================================
   FILTER
===================================================== */
.instansi-filter-panel {
    background: var(--white);
    border: 1px solid var(--border);
    border-radius: 11px;
    padding: 17px 18px 18px;
    margin-bottom: 18px;
}

.filter-title {
    display: flex;
    align-items: center;
    gap: 7px;
    color: var(--navy);
    font-size: 13px;
    font-weight: 700;
    margin-bottom: 14px;
}

.filter-title i {
    color: #64748b;
    font-size: 14px;
}

.instansi-filter {
    display: grid;
    grid-template-columns: minmax(220px, 1fr) 170px auto;
    align-items: center;
    gap: 12px;
}

.search-wrapper {
    position: relative;
    min-width: 0;
}

.search-wrapper i {
    position: absolute;
    left: 12px;
    top: 50%;
    transform: translateY(-50%);
    color: var(--muted);
    font-size: 14px;
    pointer-events: none;
}

.search-input {
    width: 100%;
    height: 39px;
    border: 1px solid #dfe4ea;
    border-radius: 7px;
    background: var(--white);
    color: var(--text);
    font-family: inherit;
    font-size: 12.5px;
    padding: 0 12px 0 34px;
    outline: none;
}

.search-input:focus,
.group-select:focus {
    border-color: #aab7c8;
    box-shadow: 0 0 0 3px rgba(16, 35, 63, 0.08);
}

.group-select-wrap {
    position: relative;
    width: 100%;
}

.group-select-wrap::after {
    content: "";
    position: absolute;
    top: 50%;
    right: 13px;
    width: 8px;
    height: 8px;
    border-right: 1.7px solid #475569;
    border-bottom: 1.7px solid #475569;
    transform: translateY(-70%) rotate(45deg);
    pointer-events: none;
}

.group-select {
    appearance: none;
    -webkit-appearance: none;
    -moz-appearance: none;
    display: block;
    width: 100%;
    height: 39px;
    border: 1px solid #dfe4ea;
    border-radius: 7px;
    background: var(--white);
    color: #475467;
    font-family: inherit;
    font-size: 12.5px;
    font-weight: 400;
    text-align: left;
    text-align-last: left;
    padding: 0 28px 0 12px;
    outline: none;
    cursor: pointer;
}

.group-select option {
    font-weight: 400;
    text-align: left;
}

.btn-add {
    height: 39px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 7px;
    padding: 0 16px;
    border: none;
    border-radius: 7px;
    background: var(--navy);
    color: #fff;
    font-size: 12px;
    font-weight: 700;
    white-space: nowrap;
    cursor: pointer;
    transition: background 0.2s ease;
}

.btn-add:hover {
    background: var(--navy-light);
    color: #fff;
}

/* =====================================================
           TABLE
        ===================================================== */
.instansi-table-card {
margin-top: 20px;

            background: var(--white);

            border: 1px solid var(--border);

            border-radius: 8px;

            overflow: hidden;

            box-shadow:
                0 4px 16px rgba(16,35,63,0.05);
}
.instansi-table-wrapper {
overflow-x: auto;
}
.instansi-table {
width: 100%;

            min-width: 850px;

            border-collapse: collapse;

            font-size: 13px;
}
.instansi-table thead th {
    height: 52px;
    padding: 0 14px;
    background: #fafafa;
    border-bottom: 1px solid var(--border);
    color: #64748b;
    text-align: center;
    vertical-align: middle;
    font-size: 12px;
    font-weight: 600;
}
.instansi-table thead th:nth-child(1) { width: 23%; }
.instansi-table thead th:nth-child(2) { width: 36%; }
.instansi-table thead th:nth-child(3) { width: 15%; }
.instansi-table thead th:nth-child(4) { width: 13%; }
.instansi-table thead th:nth-child(5) { width: 13%; }
.instansi-table tbody td {
padding: 14px;

            border-bottom: 1px solid #edf0f3;

            color: #64748b;

            vertical-align: top;
}
.instansi-table tbody td:nth-child(3),
.instansi-table tbody td:nth-child(4) {
    text-align: center;
    vertical-align: top;
}
.instansi-table tbody td:nth-child(3) .service-count-badge,
.instansi-table tbody td:nth-child(4) .status-badge {
    margin-left: auto;
    margin-right: auto;
}
.instansi-table tbody td:nth-child(4) .status-badge {
    justify-content: center;
}
.instansi-table tbody tr:last-child td {
border-bottom: none;
}
.instansi-table tbody tr:hover td {
background: #fcfcfc;
}
/* =====================================================
           NAMA INSTANSI
        ===================================================== */
.instansi-name {
display: flex;

            align-items: flex-start;

            gap: 9px;
}
.instansi-info {
min-width: 0;
}
.instansi-title {
color: #64748b;

            font-weight: 700;

            font-size: 13px;

            margin-bottom: 5px;
}
.instansi-group {
display: inline-block;

            color: #7b8798;

            background: #f1f3f5;

            border-radius: 5px;

            padding: 3px 7px;

            font-size: 10px;
}
/* =====================================================
           SOUND
        ===================================================== */
.sound-btn {
width: 32px;

            height: 32px;

            min-width: 32px;

            border: 1px solid #eadfbd;

            border-radius: 7px;

            background: var(--yellow-soft);

            color: #806600;

            display: inline-flex;

            align-items: center;

            justify-content: center;

            cursor: pointer;

            transition: 0.2s ease;
}
.sound-btn:hover {
background: var(--yellow);

            color: var(--navy);

            border-color: var(--yellow);
}
.sound-btn.speaking {
background: var(--yellow);

            color: var(--navy);

            border-color: var(--yellow);
}
/* =====================================================
           LAYANAN
        ===================================================== */
.service-list {
display: flex;

            flex-direction: column;

            gap: 6px;
}
.service-item {
display: flex;

            align-items: flex-start;

            gap: 7px;

            color: #64748b;

            line-height: 1.4;
}
.service-item i {
color: var(--green);

            font-size: 13px;

            margin-top: 2px;
}
.service-count-badge {
display: inline-flex;

            align-items: center;

            justify-content: center;

            min-width: 88px;

            padding: 6px 10px;

            border-radius: 6px;

            background: #f1f3f5;

            color: var(--navy);

            font-size: 11px;

            font-weight: 700;

            white-space: nowrap;
}
/* =====================================================
           STATUS
        ===================================================== */
.status-badge {
display: inline-flex;

            align-items: center;

            gap: 6px;

            color: #198754;

            font-size: 11px;

            font-weight: 600;
}
.status-dot {
width: 7px;

            height: 7px;

            border-radius: 50%;

            background: #198754;
}
/* =====================================================
           AKSI
        ===================================================== */
.aksi {
text-align: center;
}
.action-buttons {
display: flex;

            align-items: center;

            justify-content: center;

            gap: 6px;
}
.btn-action {
width: 32px;

            height: 32px;

            border: 1px solid var(--navy);

            border-radius: 7px;

            background: white;

            display: inline-flex;

            align-items: center;

            justify-content: center;

            color: var(--navy);

            cursor: pointer;

            transition: 0.2s ease;
}
.btn-action.delete {
width: 32px;

            height: 32px;

            border: 1px solid var(--red);

            border-radius: 7px;

            background: white;

            display: inline-flex;

            align-items: center;

            justify-content: center;

            color: var(--red);

            cursor: pointer;

            transition: 0.2s ease;
}
.btn-action:hover {
background: var(--navy);

            border-color: var(--navy);

            color: white;
}
.btn-action.delete:hover {
background: #c62828;

            border-color: #c62828;

            color: var(--white);
}
/* =====================================================
           EMPTY
        ===================================================== */
.empty-row {
display: none;
}
.empty-content {
text-align: center;

            padding: 45px 20px;
}
.empty-content i {
display: block;

            font-size: 32px;

            color: #c5ccd5;

            margin-bottom: 10px;
}
.empty-content strong {
display: block;

            color: #64748b;

            font-size: 13px;

            margin-bottom: 4px;
}
.empty-content span {
color: var(--muted);

            font-size: 11px;
}
/* =====================================================
           MODAL
        ===================================================== */
.modal-content {
border: none;

            border-radius: 9px;

            overflow: hidden;
}
.modal-header {
background: var(--navy);

            color: white;

            border-bottom: none;
}
.modal-title {
font-size: 16px;

            font-weight: 700;
}
.modal-header .btn-close {
filter: brightness(0) invert(1);
}
.modal-body {
padding: 22px;
}
.form-label {
color: #64748b;

            font-size: 12px;

            font-weight: 600;
}
.form-control,
.form-select {
font-size: 13px;

            border-color: var(--border);

            border-radius: 7px;
}
.form-control:focus,
.form-select:focus {
border-color: var(--navy);

            box-shadow:
                0 0 0 3px rgba(16,35,63,0.08);
}
.modal-footer {
border-top: 1px solid var(--border);
}
.btn-modal-cancel {
border: 1px solid var(--border);

            background: white;

            border-color: #c62828;
            
            color: #c62828;

            border-radius: 7px;

            font-size: 12px;
}
.btn-modal-cancel:hover {
background: #c62828;

            border-color: #c62828;

            color: var(--white);
}
.btn-modal-save {
border: none;

            background: var(--navy);

            color: white;

            border-radius: 7px;

            font-size: 12px;
}
.btn-modal-save:hover {
background: var(--navy-light);

            color: white;
}
/* =====================================================
           RESPONSIVE
        ===================================================== */
@media (max-width: 1250px) {
    .instansi-filter {
        grid-template-columns: minmax(180px, 1fr) 160px auto;
    }
}

@media (max-width: 1000px) {
    .instansi-stats {
        grid-template-columns: 1fr 1fr;
    }

    .instansi-filter {
        grid-template-columns: minmax(180px, 1fr) 160px;
    }

    .btn-add {
        grid-column: 1 / -1;
        justify-self: start;
    }
}
@media (max-width: 700px) {
.instansi-content {
padding: 20px;
}
}
@media (max-width: 700px) {
    .instansi-content {
        padding: 20px;
    }

    .page-heading h1 {
        font-size: 20px;
    }
}

@media (max-width: 600px) {
    .instansi-stats {
        grid-template-columns: 1fr;
    }

    .instansi-filter {
        grid-template-columns: 1fr;
    }

    .btn-add {
        width: 100%;
    }
}

/* Heading mengikuti tipografi halaman laporan proses antrean. */
.page-heading {
    display: flex;
    align-items: flex-start;
    justify-content: space-between;
    gap: 20px;
    margin-bottom: 20px;
}

.heading-main {
    display: flex;
    align-items: flex-start;
    gap: 12px;
}

.page-heading h1 {
    margin: 0;
    color: var(--navy);
    font-size: 23px;
    line-height: 1.25;
    font-weight: 700;
}

.page-heading p {
    margin: 5px 0 0;
    color: var(--muted);
    font-size: 12.5px;
}

.instansi-content {
    padding: 0;
}

@media (max-width: 900px) {
    .page-heading {
        display: block;
    }
}

</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<section class="instansi-content">

<?php

            $totalInstansi = count($instansi ?? []);

            $totalLayanan = 0;

            foreach (($instansi ?? []) as $item) {
                $totalLayanan += count($item['layanan'] ?? []);
            }

            $totalSuaraAktif = $totalInstansi;

            ?>

            <!-- =================================================
                 STATISTIK
            ================================================== -->

            <div class="instansi-stats">

                <div class="stat-card">

                    <div class="stat-icon">

                        <i class="bi bi-building"></i>

                    </div>

                    <div class="stat-info">

                        <small>
                            Total Instansi
                        </small>

                        <strong>
                            <?= $totalInstansi ?>
                        </strong>

                    </div>

                </div>

                <div class="stat-card">

                    <div class="stat-icon">

                        <i class="bi bi-list-check"></i>

                    </div>

                    <div class="stat-info">

                        <small>
                            Total Layanan
                        </small>

                        <strong>
                            <?= $totalLayanan ?>
                        </strong>

                    </div>

                </div>

                <div class="stat-card">

                    <div class="stat-icon">

                        <i class="bi bi-volume-up"></i>

                    </div>

                    <div class="stat-info">

                        <small>
                            Suara Aktif
                        </small>

                        <strong>
                            <?= $totalSuaraAktif ?> Instansi
                        </strong>

                    </div>

                </div>

            </div>

            <!-- =================================================
                 FILTER
            ================================================== -->

            <div class="instansi-filter-panel">
                <div class="filter-title">
                    <i class="bi bi-funnel"></i>
                    Filter Data Instansi
                </div>

                <div class="instansi-filter">
                    <div class="search-wrapper">
                        <i class="bi bi-search"></i>
                        <input
                            type="text"
                            id="searchInstansi"
                            class="search-input"
                            placeholder="Cari instansi atau layanan..."
                        >
                    </div>

                    <div class="group-select-wrap">
                        <select id="filterGrup" class="group-select">
                            <option value="all">Semua Grup</option>
                            <?php for ($grup = 1; $grup <= 8; $grup++): ?>
                                <option value="<?= $grup ?>">Grup <?= $grup ?></option>
                            <?php endfor; ?>
                        </select>
                    </div>

                    <button
                        type="button"
                        class="btn-add"
                        data-bs-toggle="modal"
                        data-bs-target="#modalTambah"
                    >
                        <i class="bi bi-plus-lg"></i>
                        Tambah Instansi
                    </button>
                </div>
            </div>

            <!-- =================================================
                 TABLE
            ================================================== -->

            <div class="instansi-table-card">

                <div class="instansi-table-wrapper">

                    <table
                        class="instansi-table"
                        id="instansiTable"
                    >

                        <thead>

                            <tr>

                                <th>
                                    Nama Instansi
                                </th>

                                <th>
                                    Layanan
                                </th>

                                <th>
                                    Jumlah Layanan
                                </th>

                                <th>
                                    Status
                                </th>

                                <th>
                                    Aksi
                                </th>

                            </tr>

                        </thead>

                        <tbody>

                            <?php foreach ($instansi as $item): ?>

                                <tr
                                    class="instansi-row"
                                    data-grup="<?= esc($item['grup_id']) ?>"
                                    data-search="<?= esc(
                                        $item['nama_instansi'] . ' ' .
                                        implode(' ', array_column($item['layanan'] ?? [], 'nama_layanan'))
                                    ) ?>"
                                >

                                    <!-- NAMA -->

                                    <td>

                                        <div class="instansi-name">

                                            <!-- SUARA NAMA INSTANSI -->

                                            <button
                                                type="button"
                                                class="sound-btn"
                                                data-speech="<?= esc($item['nama_instansi']) ?>"
                                                title="Dengarkan nama instansi"
                                            >

                                                <i class="bi bi-volume-up-fill"></i>

                                            </button>

                                            <div class="instansi-info">

                                                <div class="instansi-title">

                                                    <?= esc($item['nama_instansi']) ?>

                                                </div>

                                                <span class="instansi-group">

                                                    Grup <?= esc($item['grup_id']) ?>

                                                </span>

                                            </div>

                                        </div>

                                    </td>

                                    <!-- LAYANAN -->

                                    <td>

                                        <div class="service-list">

                                            <?php foreach ($item['layanan'] as $layanan): ?>

                                                <div class="service-item">

                                                    <i class="bi bi-check2-circle"></i>

                                                    <span>
                                                        <?= esc($layanan['nama_layanan']) ?>
                                                    </span>

                                                </div>

                                            <?php endforeach; ?>

                                        </div>

                                    </td>

                                    <!-- JUMLAH LAYANAN -->

                                    <td>

                                        <span class="service-count-badge">
                                            <?= count($item['layanan']) ?> Layanan
                                        </span>

                                    </td>

                                    <!-- STATUS -->

                                    <td>

                                        <span class="status-badge">

                                            <span class="status-dot"></span>

                                            Aktif

                                        </span>

                                    </td>

                                    <!-- AKSI -->

                                    <td class="aksi">

                                        <div class="action-buttons">

                                            <button
                                                type="button"
                                                class="btn-action"
                                                title="Edit"
                                                onclick="editInstansi(<?= (int) $item['id'] ?>)"
                                            >

                                                <i class="bi bi-pencil"></i>

                                            </button>

                                            <button
                                                type="button"
                                                class="btn-action delete"
                                                title="Hapus"
                                                onclick="deleteInstansi(<?= (int) $item['id'] ?>)"
                                            >

                                                <i class="bi bi-trash3"></i>

                                            </button>

                                        </div>

                                    </td>

                                </tr>

                            <?php endforeach; ?>

                            <!-- EMPTY -->

                            <tr
                                id="emptyRow"
                                class="empty-row"
                            >

                                <td colspan="5">

                                    <div class="empty-content">

                                        <i class="bi bi-search"></i>

                                        <strong>
                                            Data tidak ditemukan
                                        </strong>

                                        <span>
                                            Coba gunakan kata kunci atau filter grup yang berbeda.
                                        </span>

                                    </div>

                                </td>

                            </tr>

                        </tbody>

                    </table>

                </div>

            </div>

        </section>

    <!-- =====================================================
         MODAL TAMBAH INSTANSI
    ===================================================== -->

    <div
        class="modal fade"
        id="modalTambah"
        tabindex="-1"
        aria-hidden="true"
    >

        <div class="modal-dialog modal-dialog-centered">

            <div class="modal-content">

                <div class="modal-header">

                    <h5 class="modal-title">
                        Tambah Instansi
                    </h5>

                    <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"
                    ></button>

                </div>

                <div class="modal-body">

                    <form id="formTambahInstansi">

                        <div class="mb-3">

                            <label class="form-label">
                                Nama Instansi
                            </label>

                            <input
                                type="text"
                                id="namaInstansi"
                                class="form-control"
                                placeholder="Masukkan nama instansi"
                                required
                            >

                        </div>

                        <div class="mb-3">

                            <label class="form-label">
                                Grup
                            </label>

                            <select
                                id="grupInstansi"
                                class="form-select"
                                required
                            >

                                <option value="">
                                    Pilih grup
                                </option>

                                <?php for ($grup = 1; $grup <= 8; $grup++): ?>

                                    <option value="<?= $grup ?>">
                                        Grup <?= $grup ?>
                                    </option>

                                <?php endfor; ?>

                            </select>

                        </div>

                        <div class="mb-3">
                            <label class="form-label">Layanan</label>

                            <div id="daftarLayanan" class="d-flex flex-column gap-2">
                                <!-- Input layanan dibuat melalui JavaScript -->
                            </div>

                            <button
                                type="button"
                                id="btnTambahLayanan"
                                class="btn btn-outline-primary btn-sm mt-2"
                            >
                                <i class="bi bi-plus-circle"></i>
                                Tambah Layanan
                            </button>
                        </div>

                    </form>

                </div>

                <div class="modal-footer">

                    <button
                        type="button"
                        class="btn btn-modal-cancel"
                        data-bs-dismiss="modal"
                    >

                        Batal

                    </button>

                    <button
                        type="button"
                        class="btn btn-modal-save"
                        id="btnSimpanInstansi"
                    >

                        Simpan

                    </button>

                </div>

            </div>

        </div>

    </div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
/* =================================================
           SEARCH + FILTER
        ================================================= */

        const searchInput =
            document.getElementById('searchInstansi');

        const filterGrup =
            document.getElementById('filterGrup');

        const rows =
            document.querySelectorAll('.instansi-row');

        const emptyRow =
            document.getElementById('emptyRow');

        function filterInstansi() {

            const keyword =
                searchInput.value
                    .toLowerCase()
                    .trim();

            const grup =
                filterGrup.value;

            let visible =
                0;

            rows.forEach(function (row) {

                const searchData =
                    row.dataset.search
                        .toLowerCase();

                const rowGrup =
                    row.dataset.grup;

                const cocokSearch =
                    keyword === '' ||
                    searchData.includes(keyword);

                const cocokGrup =
                    grup === 'all' ||
                    rowGrup === grup;

                if (
                    cocokSearch &&
                    cocokGrup
                ) {

                    row.style.display = '';

                    visible++;

                } else {

                    row.style.display = 'none';

                }

            });

            if (visible === 0) {

                emptyRow.style.display =
                    'table-row';

            } else {

                emptyRow.style.display =
                    'none';

            }

        }

        searchInput.addEventListener(
            'input',
            filterInstansi
        );

        filterGrup.addEventListener(
            'change',
            filterInstansi
        );

        /* =================================================
           TEXT TO SPEECH - INSTANSI
        ================================================= */

        const soundButtons =
            document.querySelectorAll('.instansi-name .sound-btn');

        soundButtons.forEach(function (button) {

            button.addEventListener('click', function () {

                const text =
                    this.dataset.speech;

                if (!('speechSynthesis' in window)) {

                    alert(
                        'Browser kamu belum mendukung fitur suara.'
                    );

                    return;

                }

                window.speechSynthesis.cancel();

                soundButtons.forEach(function (btn) {

                    btn.classList.remove(
                        'speaking'
                    );

                });

                const speech =
                    new SpeechSynthesisUtterance(
                        text
                    );

                speech.lang =
                    'id-ID';

                speech.rate =
                    0.9;

                speech.pitch =
                    1;

                const currentButton =
                    this;

                currentButton.classList.add(
                    'speaking'
                );

                speech.onend = function () {

                    currentButton.classList.remove(
                        'speaking'
                    );

                };

                speech.onerror = function () {

                    currentButton.classList.remove(
                        'speaking'
                    );

                };

                window.speechSynthesis.speak(
                    speech
                );

            });

        });

        /* =================================================
        EDIT, DELETE, DAN TAMBAH INSTANSI & LAYANAN
        ================================================= */

        let editingId = null;
        let layananAwal = [];

        const formInstansi = document.getElementById('formTambahInstansi');
        const modalInstansiEl = document.getElementById('modalTambah');
        const modalInstansi = bootstrap.Modal.getOrCreateInstance(modalInstansiEl);
        const btnSimpan = document.getElementById('btnSimpanInstansi');

        const inputNama = document.getElementById('namaInstansi');
        const inputGrup = document.getElementById('grupInstansi');
        const daftarLayanan = document.getElementById('daftarLayanan');
        const btnTambahLayanan = document.getElementById('btnTambahLayanan');

        const urlInstansi = '<?= site_url('admin/instansi') ?>';

        async function requestInstansi(url, options = {}) {
            const response = await fetch(url, {
                ...options,
                headers: {
                    'Accept': 'application/json',
                    ...(options.body
                        ? { 'Content-Type': 'application/json' }
                        : {}),
                    ...options.headers
                }
            });

            const result = await response.json();

            if (!response.ok || result.status === false) {
                throw new Error(result.message || 'Permintaan gagal.');
            }

            return result;
        }

        // Membuat satu kotak input layanan
        function tambahInputLayanan(nama = '', id = null) {
            const baris = document.createElement('div');
            baris.className = 'input-group layanan-item';

            if (id !== null) {
                baris.dataset.id = String(id);
            }

            const input = document.createElement('input');
            input.type = 'text';
            input.className = 'form-control';
            input.placeholder = 'Masukkan nama layanan';
            input.value = nama;
            input.maxLength = 150;
            input.required = true;

            const tombolHapus = document.createElement('button');
            tombolHapus.type = 'button';
            tombolHapus.className = 'btn btn-outline-danger';
            tombolHapus.innerHTML = '<i class="bi bi-trash"></i>';
            tombolHapus.title = 'Hapus layanan';

            tombolHapus.addEventListener('click', function () {
                baris.remove();
            });

            baris.append(input, tombolHapus);
            daftarLayanan.appendChild(baris);
        }

        // Tombol tambah layanan
        btnTambahLayanan.addEventListener('click', function () {
            tambahInputLayanan();
        });

        // Ambil layanan dari semua kotak input
        function ambilDaftarLayanan() {
            return Array.from(
                daftarLayanan.querySelectorAll('.layanan-item')
            ).map(baris => ({
                id: baris.dataset.id
                    ? Number(baris.dataset.id)
                    : null,
                nama_layanan: baris.querySelector('input').value.trim()
            }));
        }

        // Kosongkan daftar input
        function kosongkanDaftarLayanan() {
            daftarLayanan.replaceChildren();
        }

        // Isi daftar layanan saat modal dibuka
        function isiDaftarLayanan(layanan = []) {
            kosongkanDaftarLayanan();

            layanan.forEach(item => {
                if (typeof item === 'string') {
                    tambahInputLayanan(item);
                } else {
                    tambahInputLayanan(
                        item.nama_layanan || '',
                        item.id ?? null
                    );
                }
            });

            // Untuk instansi baru, sediakan satu input kosong
            if (layanan.length === 0) {
                tambahInputLayanan();
            }
        }

        /* =================================================
        EDIT
        ================================================= */

        async function editInstansi(id) {
            try {
                const result = await requestInstansi(urlInstansi);

                const item = (result.data || []).find(
                    instansi => Number(instansi.id) === Number(id)
                );

                if (!item) {
                    throw new Error('Instansi tidak ditemukan.');
                }

                editingId = Number(id);

                inputNama.value = item.nama_instansi || '';
                inputGrup.value = String(item.grup_id || '');

                // Simpan kondisi awal layanan untuk mendeteksi layanan yang dihapus/diubah.
                layananAwal = (item.layanan || []).map(layanan => ({
                    id: Number(layanan.id),
                    nama_layanan: layanan.nama_layanan
                }));

                // Tampilkan layanan ke input dinamis.
                isiDaftarLayanan(item.layanan || []);

                modalInstansiEl.querySelector('.modal-title').textContent =
                    'Edit Instansi';

                btnSimpan.textContent = 'Simpan Perubahan';

                modalInstansi.show();

            } catch (error) {
                console.error(error);
                alert('Gagal mengambil data: ' + error.message);
            }
        }

        /* =================================================
        DELETE
        ================================================= */

        async function deleteInstansi(id) {
            if (!confirm('Apakah Anda yakin ingin menghapus instansi ini?')) {
                return;
            }

            try {
                await requestInstansi(`${urlInstansi}/${id}`, {
                    method: 'DELETE'
                });

                alert('Instansi berhasil dihapus dari database.');
                window.location.reload();

            } catch (error) {
                console.error(error);
                alert('Gagal menghapus: ' + error.message);
            }
        }

        /* =================================================
        TAMBAH DAN SIMPAN EDIT
        ================================================= */

        btnSimpan.addEventListener('click', async function () {
            if (!formInstansi.checkValidity()) {
                formInstansi.reportValidity();
                return;
            }

            const nama = inputNama.value.trim();
            const grupId = Number(inputGrup.value);
            const daftarSekarang = ambilDaftarLayanan();

            if (daftarSekarang.some(item => !item.nama_layanan)) {
                alert('Nama layanan tidak boleh kosong.');
                return;
            }

            // Cegah nama layanan duplikat dalam instansi yang sama.
            const namaLayanan = daftarSekarang.map(
                item => item.nama_layanan.toLocaleLowerCase()
            );

            if (new Set(namaLayanan).size !== namaLayanan.length) {
                alert('Nama layanan tidak boleh duplikat.');
                return;
            }

            btnSimpan.disabled = true;

            try {
                const isEdit = editingId !== null;
                const urlLayanan = '<?= site_url('admin/layanan') ?>';

                if (isEdit) {
                    const idSekarang = daftarSekarang
                        .filter(item => item.id !== null)
                        .map(item => item.id);

                    // Layanan lama yang sudah dibuang dari daftar input.
                    const layananDihapus = layananAwal.filter(
                        lama => !idSekarang.includes(lama.id)
                    );

                    // 1. Hapus layanan yang dipilih untuk dihapus.
                    for (const layanan of layananDihapus) {
                        await requestInstansi(
                            `${urlLayanan}/${layanan.id}`,
                            { method: 'DELETE' }
                        );
                    }

                    // 2. Ubah nama layanan lama jika memang berubah.
                    for (const layanan of daftarSekarang) {
                        if (layanan.id === null) {
                            continue;
                        }

                        const lama = layananAwal.find(
                            item => item.id === layanan.id
                        );

                        if (
                            lama &&
                            lama.nama_layanan !== layanan.nama_layanan
                        ) {
                            await requestInstansi(
                                `${urlLayanan}/${layanan.id}`,
                                {
                                    method: 'PUT',
                                    body: JSON.stringify({
                                        nama_layanan: layanan.nama_layanan
                                    })
                                }
                            );
                        }
                    }

                    // 3. Tambahkan layanan yang belum punya ID.
                    for (const layanan of daftarSekarang) {
                        if (layanan.id !== null) {
                            continue;
                        }

                        await requestInstansi(urlLayanan, {
                            method: 'POST',
                            body: JSON.stringify({
                                instansi_id: editingId,
                                nama_layanan: layanan.nama_layanan
                            })
                        });
                    }
                }

                // 4. Simpan nama dan grup instansi.
                const payloadInstansi = {
                    nama_instansi: nama,
                    grup_id: grupId
                };

                await requestInstansi(
                    isEdit
                        ? `${urlInstansi}/${editingId}`
                        : urlInstansi,
                    {
                        method: isEdit ? 'PUT' : 'POST',
                        body: JSON.stringify({
                            ...payloadInstansi,
                            ...(!isEdit
                                ? {
                                    layanan: daftarSekarang.map(
                                        item => item.nama_layanan
                                    )
                                }
                                : {})
                        })
                    }
                );

                alert(
                    isEdit
                        ? 'Data instansi dan layanan berhasil diperbarui!'
                        : 'Instansi dan layanan berhasil ditambahkan!'
                );

                modalInstansi.hide();
                window.location.reload();

            } catch (error) {
                console.error('Gagal menyimpan instansi/layanan:', error);

                alert(
                    'Gagal menyimpan perubahan: ' + error.message +
                    '\n\nJika ada layanan yang sudah terhapus atau berubah sebelum error, periksa kembali data setelah halaman dimuat ulang.'
                );

            } finally {
                btnSimpan.disabled = false;
            }
        });

        /* =================================================
        RESET MODAL
        ================================================= */

        modalInstansiEl.addEventListener('hidden.bs.modal', function () {
            editingId = null;
            layananAwal = [];

            formInstansi.reset();
            kosongkanDaftarLayanan();
            tambahInputLayanan();

            modalInstansiEl.querySelector('.modal-title').textContent =
                'Tambah Instansi';

            btnSimpan.textContent = 'Simpan';
        });
</script>
<?= $this->endSection() ?>