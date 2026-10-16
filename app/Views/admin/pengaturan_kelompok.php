<?= $this->extend('layouts/admin') ?>

<?= $this->section('pageTitle') ?>
<div class="page-heading">
    <div class="heading-main">
        <div>
            <h1>Pengaturan Kelompok</h1>
            <p>Kelola kelompok instansi dan pengaturan suara layar.</p>
        </div>
    </div>

    <button
        type="button"
        class="btn-add"
        data-bs-toggle="modal"
        data-bs-target="#modalTambah"
    >
        <i class="bi bi-plus-lg"></i>
        Tambah Kelompok
    </button>
</div>
<?= $this->endSection() ?>

<?= $this->section('styles') ?>
<style>
/* =====================================================
   HEADING
===================================================== */
.page-heading {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 20px;
    margin-bottom: 22px;
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

.btn-add {
    min-height: 39px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 7px;
    padding: 0 16px;
    border: 1px solid var(--navy);
    border-radius: 7px;
    background: var(--navy);
    color: #fff;
    font-size: 12px;
    font-weight: 700;
    white-space: nowrap;
    cursor: pointer;
    transition: background .2s ease, border-color .2s ease;
}

.btn-add:hover {
    background: var(--navy-light);
    border-color: var(--navy-light);
    color: #fff;
}

/* =====================================================
   STATISTIK
===================================================== */
.kelompok-stats {
    display: grid;
    grid-template-columns: repeat(3, minmax(0, 1fr));
    gap: 14px;
    margin-bottom: 20px;
}

.stat-card {
    display: flex;
    align-items: center;
    gap: 13px;
    min-height: 82px;
    padding: 15px 16px;
    background: var(--white);
    border: 1px solid var(--border);
    border-radius: 9px;
}

.stat-icon {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 42px;
    height: 42px;
    min-width: 42px;
    border-radius: 8px;
    background: var(--yellow-soft);
    color: var(--navy);
    font-size: 18px;
}

.stat-info {
    min-width: 0;
}

.stat-info small {
    display: block;
    margin-bottom: 4px;
    color: var(--muted);
    font-size: 11px;
}

.stat-info strong {
    display: block;
    color: var(--navy);
    font-size: 19px;
    font-weight: 700;
    line-height: 1.25;
}

/* =====================================================
   FILTER
===================================================== */
.kelompok-filter-panel {
    margin-bottom: 18px;
    padding: 17px 18px 18px;
    background: var(--white);
    border: 1px solid var(--border);
    border-radius: 10px;
}

.filter-title {
    display: flex;
    align-items: center;
    gap: 7px;
    margin-bottom: 14px;
    color: var(--navy);
    font-size: 13px;
    font-weight: 700;
}

.filter-title i {
    color: #64748b;
    font-size: 14px;
}

.kelompok-filter {
    display: grid;
    grid-template-columns: minmax(220px, 1fr) 190px auto;
    align-items: center;
    gap: 12px;
}

.search-wrapper {
    position: relative;
    min-width: 0;
}

.search-wrapper > i {
    position: absolute;
    top: 50%;
    left: 12px;
    transform: translateY(-50%);
    color: var(--muted);
    font-size: 14px;
    pointer-events: none;
}

.search-input,
.group-select {
    width: 100%;
    height: 39px;
    border: 1px solid #dfe4ea;
    border-radius: 7px;
    background: var(--white);
    color: var(--text);
    font-family: inherit;
    font-size: 12.5px;
    outline: none;
    transition: border-color .2s ease, box-shadow .2s ease;
}

.search-input {
    padding: 0 12px 0 34px;
}

.group-select {
    padding: 0 12px;
    cursor: pointer;
}

.search-input:focus,
.group-select:focus {
    border-color: #aab7c8;
    box-shadow: 0 0 0 3px rgba(16, 35, 63, .08);
}

.btn-reset {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 7px;
    height: 39px;
    padding: 0 14px;
    border: 1px solid #dfe4ea;
    border-radius: 7px;
    background: #fff;
    color: #475467;
    font-size: 12px;
    font-weight: 600;
    white-space: nowrap;
    cursor: pointer;
    transition: .2s ease;
}

.btn-reset:hover {
    background: #f4f6f9;
    border-color: #cbd5e1;
    color: var(--navy);
}

/* =====================================================
   TABLE
===================================================== */
.kelompok-table-card {
    overflow: hidden;
    background: var(--white);
    border: 1px solid var(--border);
    border-radius: 9px;
    box-shadow: 0 4px 16px rgba(16, 35, 63, .04);
}

.table-heading {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 12px;
    padding: 16px 18px;
    border-bottom: 1px solid var(--border);
}

.table-heading h2 {
    margin: 0;
    color: var(--navy);
    font-size: 14px;
    font-weight: 700;
}

.table-heading p {
    margin: 4px 0 0;
    color: var(--muted);
    font-size: 11.5px;
}

.table-count {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    min-width: 30px;
    height: 28px;
    padding: 0 9px;
    border-radius: 6px;
    background: var(--yellow-soft);
    color: var(--navy);
    font-size: 11px;
    font-weight: 700;
}

.kelompok-table-wrapper {
    overflow-x: auto;
}

.kelompok-table {
    width: 100%;
    min-width: 760px;
    border-collapse: collapse;
    font-size: 12.5px;
}

.kelompok-table thead th {
    height: 49px;
    padding: 0 15px;
    background: #fafafa;
    border-bottom: 1px solid var(--border);
    color: #64748b;
    text-align: left;
    vertical-align: middle;
    font-size: 11.5px;
    font-weight: 700;
    white-space: nowrap;
}

.kelompok-table thead th:first-child,
.kelompok-table tbody td:first-child {
    padding-left: 20px;
}

.kelompok-table tbody td {
    padding: 15px;
    border-bottom: 1px solid #edf0f3;
    color: #64748b;
    vertical-align: top;
}

.kelompok-table tbody tr:last-child td {
    border-bottom: none;
}

.kelompok-table tbody tr:hover td {
    background: #fcfcfd;
}

.kelompok-table th:nth-child(1) { width: 22%; }
.kelompok-table th:nth-child(2) { width: 38%; }
.kelompok-table th:nth-child(3) { width: 17%; }
.kelompok-table th:nth-child(4) { width: 23%; }

/* =====================================================
   NAMA KELOMPOK & INSTANSI
===================================================== */
.kelompok-name {
    display: flex;
    align-items: flex-start;
    gap: 10px;
}

.kelompok-icon {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 35px;
    height: 35px;
    min-width: 35px;
    border-radius: 8px;
    background: #f1f4f8;
    color: var(--navy);
    font-size: 15px;
}

.kelompok-title {
    margin: 1px 0 5px;
    color: var(--navy);
    font-size: 12.5px;
    font-weight: 700;
    line-height: 1.4;
}

.kelompok-subtitle {
    color: var(--muted);
    font-size: 10.5px;
}

.instansi-list {
    display: flex;
    flex-direction: column;
    gap: 7px;
}

.instansi-item {
    display: flex;
    align-items: flex-start;
    gap: 7px;
    color: #64748b;
    line-height: 1.45;
}

.instansi-item i {
    margin-top: 2px;
    color: var(--green);
    font-size: 12px;
}

.instansi-empty {
    color: #98a2b3;
    font-size: 11.5px;
    font-style: italic;
}

/* =====================================================
   BADGE SUARA
===================================================== */
.suara-badge {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 6px 9px;
    border: 1px solid #eadfbd;
    border-radius: 6px;
    background: var(--yellow-soft);
    color: #806600;
    font-size: 10.5px;
    font-weight: 700;
    white-space: nowrap;
}

.suara-badge i {
    font-size: 12px;
}

/* =====================================================
   AKSI
===================================================== */
.aksi {
    white-space: nowrap;
}

.action-buttons {
    display: flex;
    align-items: center;
    gap: 6px;
}

.btn-action {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 32px;
    height: 32px;
    border: 1px solid var(--navy);
    border-radius: 7px;
    background: #fff;
    color: var(--navy);
    cursor: pointer;
    transition: .2s ease;
}

.btn-action:hover {
    background: var(--navy);
    border-color: var(--navy);
    color: #fff;
}

.btn-action.settings {
    border-color: #c5a329;
    color: #806600;
}

.btn-action.settings:hover {
    border-color: var(--yellow);
    background: var(--yellow);
    color: var(--navy);
}

.btn-action.delete {
    border-color: var(--red);
    color: var(--red);
}

.btn-action.delete:hover {
    border-color: #c62828;
    background: #c62828;
    color: #fff;
}

/* =====================================================
   EMPTY STATE
===================================================== */
.empty-row {
    display: none;
}

.empty-content {
    padding: 44px 20px !important;
    text-align: center;
}

.empty-content i {
    display: block;
    margin-bottom: 10px;
    color: #c5ccd5;
    font-size: 30px;
}

.empty-content strong {
    display: block;
    margin-bottom: 4px;
    color: #64748b;
    font-size: 13px;
}

.empty-content span {
    color: var(--muted);
    font-size: 11.5px;
}

/* =====================================================
   MODAL
===================================================== */
.modal-content {
    overflow: hidden;
    border: none;
    border-radius: 10px;
    box-shadow: 0 12px 35px rgba(16, 35, 63, .15);
}

.modal-header {
    padding: 17px 20px;
    background: var(--navy);
    color: #fff;
    border-bottom: none;
}

.modal-title {
    font-size: 15px;
    font-weight: 700;
}

.modal-header .btn-close {
    filter: brightness(0) invert(1);
}

.modal-body {
    padding: 22px;
}

.form-label {
    margin-bottom: 7px;
    color: #475467;
    font-size: 12px;
    font-weight: 600;
}

.form-control,
.form-select {
    min-height: 39px;
    border-color: var(--border);
    border-radius: 7px;
    font-size: 12.5px;
}

.form-control:focus,
.form-select:focus {
    border-color: var(--navy);
    box-shadow: 0 0 0 3px rgba(16, 35, 63, .08);
}

.modal-footer {
    padding: 14px 20px;
    border-top: 1px solid var(--border);
}

.btn-modal-cancel,
.btn-modal-save {
    min-height: 36px;
    padding: 0 14px;
    border-radius: 7px;
    font-size: 12px;
    font-weight: 600;
}

.btn-modal-cancel {
    border: 1px solid #c62828;
    background: #fff;
    color: #c62828;
}

.btn-modal-cancel:hover {
    border-color: #c62828;
    background: #c62828;
    color: #fff;
}

.btn-modal-save {
    border: 1px solid var(--navy);
    background: var(--navy);
    color: #fff;
}

.btn-modal-save:hover {
    border-color: var(--navy-light);
    background: var(--navy-light);
    color: #fff;
}

.instansi-checklist {
    display: grid;
    grid-template-columns: repeat(2, minmax(0, 1fr));
    gap: 9px;
    max-height: 310px;
    overflow-y: auto;
    padding: 12px;
    border: 1px solid var(--border);
    border-radius: 8px;
}

.instansi-check-item {
    display: flex;
    align-items: flex-start;
    gap: 8px;
    padding: 8px;
    border: 1px solid #edf0f3;
    border-radius: 6px;
    color: #475467;
    font-size: 11.5px;
    cursor: pointer;
}

.instansi-check-item:hover {
    background: #fafbfc;
}

.instansi-check-item input {
    margin-top: 2px;
    accent-color: var(--navy);
}

/* =====================================================
   RESPONSIVE
===================================================== */
@media (max-width: 1000px) {
    .kelompok-filter {
        grid-template-columns: minmax(180px, 1fr) 180px;
    }

    .btn-reset {
        justify-self: start;
    }
}

@media (max-width: 768px) {
    .page-heading {
        align-items: flex-start;
    }

    .page-heading h1 {
        font-size: 21px;
    }

    .kelompok-stats {
        grid-template-columns: repeat(2, minmax(0, 1fr));
    }

    .kelompok-filter {
        grid-template-columns: 1fr;
    }

    .btn-reset {
        width: 100%;
    }

    .table-heading {
        padding: 14px;
    }
}

@media (max-width: 520px) {
    .page-heading {
        flex-direction: column;
        align-items: stretch;
        gap: 14px;
    }

    .page-heading .btn-add {
        width: 100%;
    }

    .kelompok-stats {
        grid-template-columns: 1fr;
    }

    .stat-card {
        min-height: 74px;
    }

    .kelompok-filter-panel {
        padding: 14px;
    }

    .instansi-checklist {
        grid-template-columns: 1fr;
    }
}
</style>
<?= $this->endSection() ?>


<?= $this->section('content') ?>
<?php
$kelompok = [
    [
        'id' => 1,
        'nama' => 'Grup 1',
        'instansi' => ['SAMSAT', 'BPJS KESEHATAN', 'DISNAKER', 'ATR BPN'],
        'suara' => 'Kelompok 1',
    ],
    [
        'id' => 2,
        'nama' => 'Grup 2',
        'instansi' => ['BAPENDA', 'BPKD', 'BPJS TK', 'KEJARI'],
        'suara' => 'Kelompok 2',
    ],
    [
        'id' => 3,
        'nama' => 'Grup 3',
        'instansi' => ['DUKCAPIL', 'DITJEN AHU', 'PENGADILAN AGAMA', 'PELAYANAN PBG'],
        'suara' => 'Kelompok 2',
    ],
    [
        'id' => 4,
        'nama' => 'Grup 4',
        'instansi' => ['DUPR', 'PERKIM', 'DISHUB', 'BNN'],
        'suara' => 'Kelompok 2',
    ],
    [
        'id' => 5,
        'nama' => 'Grup 5',
        'instansi' => ['POLRES', 'PT. POS INDONESIA', 'TASPEN', 'PLN', 'PDAM'],
        'suara' => 'Kelompok 2',
    ],
    [
        'id' => 6,
        'nama' => 'Grup 6',
        'instansi' => ['BPOM', 'DINAS LINGKUNGAN HIDUP', 'PTSP 1', 'PTSP 2'],
        'suara' => 'Kelompok 1',
    ],
    [
        'id' => 7,
        'nama' => 'Bank Banten',
        'instansi' => ['BANK BANTEN'],
        'suara' => 'Kelompok 1',
    ],
    [
        'id' => 8,
        'nama' => 'Bank BJB',
        'instansi' => ['BANK BJB', 'Baznas'],
        'suara' => 'Kelompok 1',
    ],
];

$totalKelompok = count($kelompok);
$totalInstansi = array_sum(array_map(
    static fn ($item) => count($item['instansi']),
    $kelompok
));

$daftarInstansi = [
    'SAMSAT',
    'BPJS KESEHATAN',
    'DISNAKER',
    'ATR BPN',
    'BAPENDA',
    'BPKD',
    'BPJS TK',
    'KEJARI',
    'DUKCAPIL',
    'DITJEN AHU',
    'PENGADILAN AGAMA',
    'PELAYANAN PBG',
    'DPUPR',
    'PERKIM',
    'DISHUB',
    'BNN',
    'POLRES',
    'PT. POS INDONESIA',
    'TASPEN',
    'PLN',
    'PDAM',
    'BPOM',
    'DINAS LINGKUNGAN HIDUP',
    'PTSP 1',
    'PTSP 2',
    'BANK BANTEN',
    'BANK BJB',
    'Baznas',
];
?>

<div class="kelompok-stats">
    <div class="stat-card">
        <div class="stat-icon">
            <i class="bi bi-collection"></i>
        </div>
        <div class="stat-info">
            <small>Total Kelompok</small>
            <strong><?= $totalKelompok ?></strong>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon">
            <i class="bi bi-building"></i>
        </div>
        <div class="stat-info">
            <small>Total Instansi Terdaftar</small>
            <strong><?= $totalInstansi ?></strong>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon">
            <i class="bi bi-volume-up"></i>
        </div>
        <div class="stat-info">
            <small>Kelompok Suara Layar</small>
            <strong><?= $totalKelompok ?></strong>
        </div>
    </div>
</div>

<div class="kelompok-filter-panel">
    <div class="filter-title">
        <i class="bi bi-funnel"></i>
        Filter Data Kelompok
    </div>

    <div class="kelompok-filter">
        <div class="search-wrapper">
            <i class="bi bi-search"></i>
            <input
                type="text"
                id="searchKelompok"
                class="search-input"
                placeholder="Cari nama kelompok atau instansi..."
                aria-label="Cari kelompok"
            >
        </div>

        <select id="filterSuara" class="group-select" aria-label="Filter suara">
            <option value="all">Semua Kelompok Suara</option>
            <option value="Kelompok 1">Kelompok 1</option>
            <option value="Kelompok 2">Kelompok 2</option>
        </select>

        <button type="button" class="btn-reset" id="resetFilter">
            <i class="bi bi-arrow-counterclockwise"></i>
            Reset Filter
        </button>
    </div>
</div>

<div class="kelompok-table-card">
    <div class="table-heading">
        <div>
            <h2>Daftar Kelompok</h2>
            <p>Informasi kelompok, instansi, dan pengaturan suara layar.</p>
        </div>
        <span class="table-count" id="jumlahKelompok"><?= $totalKelompok ?></span>
    </div>

    <div class="kelompok-table-wrapper">
        <table class="kelompok-table" id="kelompokTable">
            <thead>
                <tr>
                    <th>Nama Kelompok</th>
                    <th>Instansi Terdaftar</th>
                    <th>Kelompok Suara</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($kelompok as $item): ?>
                    <tr
                        class="kelompok-row"
                        data-id="<?= (int) $item['id'] ?>"
                        data-search="<?= esc($item['nama'] . ' ' . implode(' ', $item['instansi'])) ?>"
                        data-suara="<?= esc($item['suara']) ?>"
                    >
                        <td>
                            <div class="kelompok-name">
                                <div class="kelompok-icon">
                                    <i class="bi bi-collection"></i>
                                </div>
                                <div>
                                    <div class="kelompok-title">
                                        <?= esc($item['nama']) ?>
                                    </div>
                                    <div class="kelompok-subtitle">
                                        ID Kelompok: <?= (int) $item['id'] ?>
                                    </div>
                                </div>
                            </div>
                        </td>

                        <td>
                            <?php if (!empty($item['instansi'])): ?>
                                <div class="instansi-list">
                                    <?php foreach ($item['instansi'] as $namaInstansi): ?>
                                        <div class="instansi-item">
                                            <i class="bi bi-check2-circle"></i>
                                            <span><?= esc($namaInstansi) ?></span>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            <?php else: ?>
                                <span class="instansi-empty">Belum ada instansi</span>
                            <?php endif; ?>
                        </td>

                        <td>
                            <span class="suara-badge">
                                <i class="bi bi-volume-up"></i>
                                <?= esc($item['suara']) ?>
                            </span>
                        </td>

                        <td class="aksi">
                            <div class="action-buttons">
                                <button
                                    type="button"
                                    class="btn-action"
                                    title="Edit kelompok"
                                    aria-label="Edit <?= esc($item['nama']) ?>"
                                    onclick='editKelompok(
                                        <?= (int) $item['id'] ?>,
                                        <?= json_encode($item['nama'], JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_TAG | JSON_HEX_AMP) ?>,
                                        <?= json_encode($item['suara'], JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_TAG | JSON_HEX_AMP) ?>
                                    )'
                                >
                                    <i class="bi bi-pencil"></i>
                                </button>

                                <button
                                    type="button"
                                    class="btn-action settings"
                                    title="Atur instansi"
                                    aria-label="Atur instansi <?= esc($item['nama']) ?>"
                                    onclick='settingInstansi(
                                        <?= (int) $item['id'] ?>,
                                        <?= json_encode($item['nama'], JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_TAG | JSON_HEX_AMP) ?>
                                    )'
                                >
                                    <i class="bi bi-sliders"></i>
                                </button>

                                <button
                                    type="button"
                                    class="btn-action delete"
                                    title="Hapus kelompok"
                                    aria-label="Hapus <?= esc($item['nama']) ?>"
                                    onclick='hapusKelompok(
                                        <?= (int) $item['id'] ?>,
                                        <?= json_encode($item['nama'], JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_TAG | JSON_HEX_AMP) ?>
                                    )'
                                >
                                    <i class="bi bi-trash3"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>

                <tr id="emptyRow" class="empty-row">
                    <td colspan="4">
                        <div class="empty-content">
                            <i class="bi bi-search"></i>
                            <strong>Data tidak ditemukan</strong>
                            <span>Coba gunakan kata kunci atau filter suara yang berbeda.</span>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<!-- MODAL TAMBAH KELOMPOK -->
<div class="modal fade" id="modalTambah" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Kelompok</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>

            <div class="modal-body">
                <form id="formTambahKelompok">
                    <div class="mb-3">
                        <label for="namaKelompok" class="form-label">Nama Kelompok</label>
                        <input
                            type="text"
                            id="namaKelompok"
                            class="form-control"
                            placeholder="Contoh: Grup 9"
                            required
                        >
                    </div>

                    <div class="mb-3">
                        <label for="suaraKelompok" class="form-label">Kelompok Suara Layar</label>
                        <select id="suaraKelompok" class="form-select" required>
                            <option value="">Pilih kelompok suara</option>
                            <option value="Kelompok 1">Kelompok 1</option>
                            <option value="Kelompok 2">Kelompok 2</option>
                        </select>
                    </div>

                    <div class="mb-2">
                        <label class="form-label">Pilih Instansi</label>
                        <div class="instansi-checklist">
                            <?php foreach ($daftarInstansi as $namaInstansi): ?>
                                <label class="instansi-check-item">
                                    <input
                                        type="checkbox"
                                        name="instansiTambah[]"
                                        value="<?= esc($namaInstansi) ?>"
                                    >
                                    <span><?= esc($namaInstansi) ?></span>
                                </label>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </form>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-modal-cancel" data-bs-dismiss="modal">
                    Batal
                </button>
                <button type="button" class="btn btn-modal-save" onclick="simpanKelompok()">
                    <i class="bi bi-check2 me-1"></i>
                    Simpan
                </button>
            </div>
        </div>
    </div>
</div>

<!-- MODAL EDIT KELOMPOK -->
<div class="modal fade" id="modalEdit" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Kelompok</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>

            <div class="modal-body">
                <form id="formEditKelompok">
                    <input type="hidden" id="editIdKelompok">

                    <div class="mb-3">
                        <label for="editNamaKelompok" class="form-label">Nama Kelompok</label>
                        <input
                            type="text"
                            id="editNamaKelompok"
                            class="form-control"
                            placeholder="Masukkan nama kelompok"
                            required
                        >
                    </div>

                    <div class="mb-2">
                        <label for="editSuaraKelompok" class="form-label">Kelompok Suara Layar</label>
                        <select id="editSuaraKelompok" class="form-select" required>
                            <option value="Kelompok 1">Kelompok 1</option>
                            <option value="Kelompok 2">Kelompok 2</option>
                        </select>
                    </div>
                </form>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-modal-cancel" data-bs-dismiss="modal">
                    Batal
                </button>
                <button type="button" class="btn btn-modal-save" onclick="updateKelompok()">
                    <i class="bi bi-check2 me-1"></i>
                    Simpan Perubahan
                </button>
            </div>
        </div>
    </div>
</div>

<!-- MODAL PENGATURAN INSTANSI -->
<div class="modal fade" id="modalInstansi" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Pengaturan Instansi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>

            <div class="modal-body">
                <input type="hidden" id="settingIdKelompok">

                <p class="mb-3" style="font-size:12.5px;color:var(--muted)">
                    Pilih instansi yang ingin dimasukkan ke kelompok
                    <strong id="settingNamaKelompok" style="color:var(--navy)"></strong>.
                </p>

                <div id="daftarInstansiSetting" class="instansi-checklist">
                    <?php foreach ($daftarInstansi as $namaInstansi): ?>
                        <label class="instansi-check-item">
                            <input
                                type="checkbox"
                                name="instansiSetting[]"
                                value="<?= esc($namaInstansi) ?>"
                            >
                            <span><?= esc($namaInstansi) ?></span>
                        </label>
                    <?php endforeach; ?>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-modal-cancel" data-bs-dismiss="modal">
                    Batal
                </button>
                <button type="button" class="btn btn-modal-save" onclick="simpanSettingInstansi()">
                    <i class="bi bi-check2 me-1"></i>
                    Simpan Pengaturan
                </button>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>


<?= $this->section('scripts') ?>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const searchInput = document.getElementById('searchKelompok');
    const filterSuara = document.getElementById('filterSuara');
    const resetFilter = document.getElementById('resetFilter');
    const rows = document.querySelectorAll('.kelompok-row');
    const emptyRow = document.getElementById('emptyRow');
    const jumlahKelompok = document.getElementById('jumlahKelompok');

    function filterKelompok() {
        const keyword = searchInput.value.toLowerCase().trim();
        const suara = filterSuara.value;
        let visible = 0;

        rows.forEach(function (row) {
            const searchData = (row.dataset.search || '').toLowerCase();
            const rowSuara = row.dataset.suara || '';

            const cocokSearch = keyword === '' || searchData.includes(keyword);
            const cocokSuara = suara === 'all' || rowSuara === suara;

            if (cocokSearch && cocokSuara) {
                row.style.display = '';
                visible++;
            } else {
                row.style.display = 'none';
            }
        });

        emptyRow.style.display = visible === 0 ? 'table-row' : 'none';
        jumlahKelompok.textContent = visible;
    }

    searchInput.addEventListener('input', filterKelompok);
    filterSuara.addEventListener('change', filterKelompok);

    resetFilter.addEventListener('click', function () {
        searchInput.value = '';
        filterSuara.value = 'all';
        filterKelompok();
    });
});

/*
 * Data ini digunakan oleh fitur pengaturan instansi pada tampilan.
 * Fungsi di bawah tetap berupa simulasi di sisi browser,
 * sama seperti implementasi awal halaman Pengaturan Kelompok.
 */
const dataKelompok = <?= json_encode($kelompok, JSON_UNESCAPED_UNICODE | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_TAG | JSON_HEX_AMP) ?>;

function editKelompok(id, nama, suara) {
    document.getElementById('editIdKelompok').value = id;
    document.getElementById('editNamaKelompok').value = nama;
    document.getElementById('editSuaraKelompok').value = suara;

    bootstrap.Modal.getOrCreateInstance(
        document.getElementById('modalEdit')
    ).show();
}

function updateKelompok() {
    const id = document.getElementById('editIdKelompok').value;
    const nama = document.getElementById('editNamaKelompok').value.trim();
    const suara = document.getElementById('editSuaraKelompok').value;

    if (!nama) {
        alert('Nama kelompok wajib diisi.');
        document.getElementById('editNamaKelompok').focus();
        return;
    }

    if (!suara) {
        alert('Silakan pilih kelompok suara.');
        return;
    }

    const item = dataKelompok.find(
        kelompok => Number(kelompok.id) === Number(id)
    );

    if (item) {
        item.nama = nama;
        item.suara = suara;
    }

    alert('Perubahan kelompok berhasil disiapkan.');

    bootstrap.Modal.getOrCreateInstance(
        document.getElementById('modalEdit')
    ).hide();

    // Perubahan masih simulasi dan tidak disimpan ke database.
}

function simpanKelompok() {
    const form = document.getElementById('formTambahKelompok');
    const nama = document.getElementById('namaKelompok').value.trim();
    const suara = document.getElementById('suaraKelompok').value;
    const instansi = Array.from(
        document.querySelectorAll('input[name="instansiTambah[]"]:checked')
    ).map(input => input.value);

    if (!form.checkValidity()) {
        form.reportValidity();
        return;
    }

    if (!nama) {
        alert('Nama kelompok wajib diisi.');
        return;
    }

    if (instansi.length === 0) {
        alert('Pilih minimal satu instansi untuk kelompok ini.');
        return;
    }

    const namaSudahAda = dataKelompok.some(
        item => item.nama.toLowerCase() === nama.toLowerCase()
    );

    if (namaSudahAda) {
        alert('Nama kelompok sudah digunakan.');
        return;
    }

    alert('Kelompok berhasil disiapkan. Data belum disimpan ke database.');

    bootstrap.Modal.getOrCreateInstance(
        document.getElementById('modalTambah')
    ).hide();

    form.reset();
}

function settingInstansi(id, nama) {
    const item = dataKelompok.find(
        kelompok => Number(kelompok.id) === Number(id)
    );

    document.getElementById('settingIdKelompok').value = id;
    document.getElementById('settingNamaKelompok').textContent = nama;

    const daftar = document.getElementById('daftarInstansiSetting');
    const instansiTerpilih = item ? item.instansi : [];

    daftar.querySelectorAll('input[type="checkbox"]').forEach(function (input) {
        input.checked = instansiTerpilih.includes(input.value);
    });

    bootstrap.Modal.getOrCreateInstance(
        document.getElementById('modalInstansi')
    ).show();
}

function simpanSettingInstansi() {
    const id = document.getElementById('settingIdKelompok').value;
    const item = dataKelompok.find(
        kelompok => Number(kelompok.id) === Number(id)
    );

    const instansi = Array.from(
        document.querySelectorAll(
            '#daftarInstansiSetting input[type="checkbox"]:checked'
        )
    ).map(input => input.value);

    if (instansi.length === 0) {
        alert('Pilih minimal satu instansi untuk kelompok ini.');
        return;
    }

    if (item) {
        item.instansi = instansi;
    }

    alert('Pengaturan instansi berhasil disiapkan. Data belum disimpan ke database.');

    bootstrap.Modal.getOrCreateInstance(
        document.getElementById('modalInstansi')
    ).hide();
}

function hapusKelompok(id, nama) {
    const konfirmasi = confirm(
        'Apakah kamu yakin ingin menghapus "' + nama + '"?'
    );

    if (!konfirmasi) {
        return;
    }

    const index = dataKelompok.findIndex(
        kelompok => Number(kelompok.id) === Number(id)
    );

    if (index !== -1) {
        dataKelompok.splice(index, 1);
    }

    alert('Kelompok berhasil dihapus dari simulasi tampilan. Data database tidak berubah.');

    // Penghapusan masih simulasi di sisi browser.
}
</script>
<?= $this->endSection() ?>