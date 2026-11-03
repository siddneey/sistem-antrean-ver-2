<?= $this->extend('layouts/admin') ?>

<?= $this->section('pageTitle') ?>
    <div class="absensi-heading">
        <div>
            <h1>Absensi Petugas</h1>
            <p>
                Pantau kehadiran petugas berdasarkan aktivitas login
                dan logout pada setiap instansi.
            </p>
        </div>
    </div>
<?= $this->endSection() ?>


<?= $this->section('styles') ?>
<style>

/* ==================== HEADER ==================== */

.absensi-heading {
    margin-bottom: 22px;
}

.absensi-heading h1 {
    font-size: 23px;
    font-weight: 700;
    color: var(--navy);
    margin: 0;
}

.absensi-heading p {
    color: var(--muted);
    font-size: 12.5px;
    margin: 5px 0 0;
}


/* ==================== STATISTIK ==================== */

.absensi-stat-grid {
    display: grid;
    grid-template-columns: repeat(2, minmax(0, 1fr));
    gap: 15px;
    margin-bottom: 20px;
}

.absensi-stat-card {
    background: #fff;
    border: 1px solid var(--border);
    border-radius: 9px;
    min-height: 94px;
    padding: 16px;
    display: flex;
    align-items: center;
    gap: 13px;
}

.absensi-stat-icon {
    width: 43px;
    height: 43px;
    min-width: 43px;
    border-radius: 9px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 18px;
}

.absensi-stat-icon.green {
    background: #eaf7ef;
    color: var(--green);
}

.absensi-stat-icon.red {
    background: #fff0ef;
    color: var(--red);
}

.absensi-stat-info span {
    display: block;
    color: var(--muted);
    font-size: 11px;
    margin-bottom: 5px;
}

.absensi-stat-info strong {
    color: var(--navy);
    font-size: 22px;
}


/* ==================== FILTER ==================== */

.absensi-filter-card {
    background: #fff;
    border: 1px solid var(--border);
    border-radius: 9px;
    padding: 17px;
    margin-bottom: 20px;
}

.absensi-filter-heading {
    color: var(--navy);
    font-size: 13px;
    font-weight: 700;
    margin-bottom: 14px;
}

.absensi-filter-heading i {
    margin-right: 6px;
}

.absensi-filter-grid {
    display: grid;
    grid-template-columns:
        minmax(220px, 1.5fr)
        repeat(3, minmax(140px, 1fr))
        auto;
    align-items: end;
    gap: 13px;
}

.absensi-filter-group label {
    display: block;
    color: var(--muted);
    font-size: 11px;
    font-weight: 700;
    margin-bottom: 6px;
}

.absensi-filter-control {
    width: 100%;
    height: 39px;
    padding: 0 10px;
    border: 1px solid var(--border);
    border-radius: 7px;
    background: #fff;
    color: var(--text);
    outline: none;
    font-size: 12px;
}

.absensi-filter-control:focus {
    border-color: var(--navy);
    box-shadow: 0 0 0 3px rgba(16, 35, 63, .06);
}

.absensi-btn-search {
    height: 39px;
    padding: 0 18px;
    border: 0;
    border-radius: 7px;
    background: var(--navy);
    color: #fff;
    font-size: 12px;
    font-weight: 600;
    cursor: pointer;
    white-space: nowrap;
    transition: .2s ease;
}

.absensi-btn-search:hover {
    background: #1c3558;
}


/* ==================== TABEL ==================== */

.absensi-table-card {
    background: #fff;
    border: 1px solid var(--border);
    border-radius: 9px;
    overflow: hidden;
}

.absensi-table-header {
    padding: 13px 18px;
    border-bottom: 1px solid var(--border);
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 12px;
}

.absensi-table-header h3 {
    color: var(--navy);
    font-size: 14px;
    font-weight: 700;
    margin: 0;
}

.absensi-table-header p {
    color: var(--muted);
    font-size: 11.5px;
    margin: 5px 0 0;
}

.absensi-btn-export {
    height: 39px;
    padding: 0 16px;
    border: 0;
    border-radius: 7px;
    background: #5fb967;
    color: #fff;
    font-size: 12px;
    font-weight: 700;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 7px;
    text-decoration: none;
    white-space: nowrap;
    transition: .2s ease;
}

.absensi-btn-export:hover {
    background:rgb(52, 116, 57);
    color: #fff;
}

.absensi-table-responsive {
    overflow-x: auto;
}

.absensi-table {
    width: 100%;
    min-width: 1000px;
    border-collapse: collapse;
}

.absensi-table th {
    height: 47px;
    padding: 0 14px;
    background: #fafafa;
    color: #667085;
    border-bottom: 1px solid var(--border);
    font-size: 11px;
    font-weight: 700;
    text-align: center;
    white-space: nowrap;
}

.absensi-table td {
    padding: 13px 14px;
    color: #667085;
    border-bottom: 1px solid #edf0f3;
    font-size: 12px;
    vertical-align: middle;
    text-align: center;
}

/* Username dan instansi tetap rata kiri */
.absensi-table td.text-left {
    text-align: left;
}

.absensi-table tbody tr:hover td {
    background: #fcfcfc;
}

.absensi-table tbody tr:last-child td {
    border-bottom: none;
}

.absensi-user {
    display: flex;
    align-items: center;
    justify-content: flex-start;
    gap: 10px;
}

.absensi-user-avatar {
    width: 36px;
    height: 36px;
    min-width: 36px;
    border-radius: 9px;
    background: var(--yellow-soft);
    color: var(--navy);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 12px;
    font-weight: 700;
}

.absensi-user-name {
    display: block;
    color: var(--text);
    font-size: 12px;
    font-weight: 600;
}

.absensi-instansi-badge {
    display: inline-block;
    padding: 5px 8px;
    border-radius: 5px;
    background: #f1f3f5;
    color: #667085;
    font-size: 10px;
}

.absensi-status {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 5px 8px;
    border-radius: 5px;
    font-size: 10px;
    font-weight: 600;
    white-space: nowrap;
}

.absensi-status.hadir {
    background: #eaf7ef;
    color: var(--green);
}

.absensi-status.tidak-hadir {
    background: #fff0ef;
    color: var(--red);
}

.absensi-action-btn {
    width: 32px;
    height: 32px;
    border: 1px solid var(--border);
    border-radius: 7px;
    background: #fff;
    color: var(--navy);
    display: inline-flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: .2s ease;
}

.absensi-action-btn:hover {
    background: var(--yellow-soft);
    border-color: #eadfbd;
}

.absensi-empty-content {
    padding: 35px 20px;
    text-align: center;
}

.absensi-empty-content i {
    display: block;
    color: #b4beca;
    font-size: 30px;
    margin-bottom: 9px;
}

.absensi-empty-content strong {
    display: block;
    color: #667085;
    font-size: 13px;
}

.absensi-empty-content span {
    display: block;
    color: #98a2b3;
    font-size: 11px;
    margin-top: 5px;
}

.absensi-table-footer {
    padding: 13px 17px;
    border-top: 1px solid var(--border);
    color: #98a2b3;
    font-size: 11px;
    display: flex;
    justify-content: space-between;
    gap: 10px;
}


/* ==================== MODAL DETAIL ==================== */

#absensiDetailModal .modal-content {
    border: none;
    border-radius: 10px;
    overflow: hidden;
}

#absensiDetailModal .modal-header {
    background: var(--navy);
    color: #fff;
    border: none;
    padding: 16px 20px;
}

#absensiDetailModal .modal-title {
    font-size: 16px;
    font-weight: 700;
}

#absensiDetailModal .btn-close {
    filter: brightness(0) invert(1);
}

#absensiDetailModal .modal-body {
    padding: 22px;
}

#absensiDetailModal .detail-item {
    padding: 12px 0;
    border-bottom: 1px solid var(--border);
}

#absensiDetailModal .detail-item:last-child {
    border-bottom: none;
}

#absensiDetailModal .detail-label {
    display: block;
    color: var(--muted);
    font-size: 11px;
    margin-bottom: 5px;
}

#absensiDetailModal .detail-value {
    color: var(--text);
    font-size: 13px;
    font-weight: 600;
    overflow-wrap: anywhere;
}


/* ==================== RESPONSIVE ==================== */

@media (max-width: 1200px) {
    .absensi-filter-grid {
        grid-template-columns: repeat(2, minmax(0, 1fr));
    }
}

@media (max-width: 800px) {
    .absensi-filter-grid {
        grid-template-columns: 1fr;
    }

    .absensi-btn-search {
        width: 100%;
    }

    .absensi-table-header {
        align-items: flex-start;
        flex-direction: column;
    }

    .absensi-btn-export {
        width: 100%;
    }
}

@media (max-width: 550px) {
    .absensi-stat-grid {
        grid-template-columns: 1fr;
    }

    .absensi-table-footer {
        flex-direction: column;
    }
}

</style>
<?= $this->endSection() ?>


<?= $this->section('content') ?>

<?php
$queryExport = http_build_query([
    'tanggal'  => $filterTanggal,
    'keyword'  => $filterKeyword,
    'instansi' => $filterInstansi,
    'status'   => $filterStatus,
]);

$totalData = count($absensi);
?>

<!-- ==================== STATISTIK ==================== -->

<div class="absensi-stat-grid">

    <div class="absensi-stat-card">
        <div class="absensi-stat-icon green">
            <i class="bi bi-person-check-fill"></i>
        </div>

        <div class="absensi-stat-info">
            <span>Total Petugas Hadir</span>
            <strong><?= $totalHadir ?></strong>
        </div>
    </div>


    <div class="absensi-stat-card">
        <div class="absensi-stat-icon red">
            <i class="bi bi-person-x-fill"></i>
        </div>

        <div class="absensi-stat-info">
            <span>Total Petugas Tidak Hadir</span>
            <strong><?= $totalTidakHadir ?></strong>
        </div>
    </div>

</div>


<!-- ==================== FILTER ==================== -->

<div class="absensi-filter-card">

    <div class="absensi-filter-heading">
        <i class="bi bi-funnel"></i>
        Filter Absensi
    </div>

    <form
        action="<?= site_url('admin/absensi-petugas') ?>"
        method="get"
        class="absensi-filter-grid"
    >

        <div class="absensi-filter-group">
            <label for="keyword">
                Cari Petugas
            </label>

            <input
                type="search"
                id="keyword"
                name="keyword"
                class="absensi-filter-control"
                placeholder="Cari username petugas..."
                value="<?= esc($filterKeyword) ?>"
            >
        </div>


        <div class="absensi-filter-group">
            <label for="instansi">
                Instansi
            </label>

            <select
                id="instansi"
                name="instansi"
                class="absensi-filter-control"
            >
                <option value="">
                    Semua Instansi
                </option>

                <?php foreach ($daftarInstansi as $instansi): ?>
                    <option
                        value="<?= esc($instansi['id']) ?>"
                        <?= (string) $filterInstansi === (string) $instansi['id']
                            ? 'selected'
                            : ''
                        ?>
                    >
                        <?= esc($instansi['nama_instansi']) ?>
                    </option>
                <?php endforeach; ?>

            </select>
        </div>


        <div class="absensi-filter-group">
            <label for="status">
                Status Kehadiran
            </label>

            <select
                id="status"
                name="status"
                class="absensi-filter-control"
            >
                <option value="">
                    Semua Status
                </option>

                <option
                    value="Hadir"
                    <?= $filterStatus === 'Hadir'
                        ? 'selected'
                        : ''
                    ?>
                >
                    Hadir
                </option>

                <option
                    value="Tidak Hadir"
                    <?= $filterStatus === 'Tidak Hadir'
                        ? 'selected'
                        : ''
                    ?>
                >
                    Tidak Hadir
                </option>

            </select>
        </div>


        <div class="absensi-filter-group">
            <label for="tanggal">
                Tanggal
            </label>

            <input
                type="date"
                id="tanggal"
                name="tanggal"
                class="absensi-filter-control"
                value="<?= esc($filterTanggal) ?>"
            >
        </div>


        <button
            type="submit"
            class="absensi-btn-search"
        >
            <i class="bi bi-search"></i>
            Cari Data
        </button>

    </form>

</div>


<!-- ==================== TABEL ==================== -->

<div class="absensi-table-card">

    <div class="absensi-table-header">

        <div>
            <h3>Data Absensi Petugas</h3>

            <p>
                Daftar kehadiran petugas berdasarkan aktivitas
                login dan logout.
            </p>
        </div>


        <a
            href="<?= site_url(
                'admin/absensi-petugas/export?' . $queryExport
            ) ?>"
            class="absensi-btn-export"
        >
            <i class="bi bi-file-earmark-excel"></i>
            Ekspor Excel
        </a>

    </div>


    <div class="absensi-table-responsive">

        <table class="absensi-table">

            <thead>
                <tr>
                    <th width="55">No</th>
                    <th>Username Petugas</th>
                    <th>Instansi</th>
                    <th>Tanggal</th>
                    <th>Jam Masuk</th>
                    <th>Jam Pulang</th>
                    <th>Status Kehadiran</th>
                    <th width="75">Detail</th>
                </tr>
            </thead>


            <tbody>

                <?php if (!empty($absensi)): ?>

                    <?php foreach ($absensi as $index => $item): ?>

                        <?php
                        $statusClass =
                            $item['status'] === 'Hadir'
                                ? 'hadir'
                                : 'tidak-hadir';

                        $username = $item['username'] ?? '-';
                        ?>

                        <tr
                            data-id="<?= esc((string) ($item['id'] ?? '')) ?>"
                            data-username="<?= esc($username) ?>"
                            data-instansi="<?= esc($item['instansi'] ?? '-') ?>"
                            data-tanggal="<?= esc($item['tanggal'] ?? '') ?>"
                            data-status="<?= esc($item['status'] ?? '-') ?>"
                            data-jam-masuk="<?= esc($item['jam_masuk'] ?? '-') ?>"
                            data-jam-pulang="<?= esc($item['jam_pulang'] ?? '-') ?>"
                            data-keterangan="<?= esc($item['keterangan'] ?? '-') ?>"
                        >

                            <td>
                                <?= $index + 1 ?>
                            </td>


                            <td class="text-left">

                                <div class="absensi-user">

                                    <div class="absensi-user-avatar">
                                        <?= esc(
                                            strtoupper(
                                                substr(
                                                    $username,
                                                    0,
                                                    1
                                                )
                                            )
                                        ) ?>
                                    </div>

                                    <span class="absensi-user-name">
                                        <?= esc($username) ?>
                                    </span>

                                </div>

                            </td>


                            <td class="text-left">
                                <span class="absensi-instansi-badge">
                                    <?= esc(
                                        $item['instansi'] ?? '-'
                                    ) ?>
                                </span>
                            </td>


                            <td>
                                <?php if (!empty($item['tanggal'])): ?>
                                    <?= esc(
                                        date(
                                            'd-m-Y',
                                            strtotime(
                                                $item['tanggal']
                                            )
                                        )
                                    ) ?>
                                <?php else: ?>
                                    -
                                <?php endif; ?>
                            </td>


                            <td>
                                <?= esc(
                                    $item['jam_masuk'] ?? '-'
                                ) ?>
                            </td>


                            <td>
                                <?= esc(
                                    $item['jam_pulang'] ?? '-'
                                ) ?>
                            </td>


                            <td>

                                <span
                                    class="
                                        absensi-status
                                        <?= $statusClass ?>
                                    "
                                >
                                    <i class="bi bi-circle-fill"></i>

                                    <?= esc(
                                        $item['status'] ?? '-'
                                    ) ?>
                                </span>

                            </td>


                            <td>

                                <button
                                    type="button"
                                    class="absensi-action-btn"
                                    title="Lihat detail"
                                    aria-label="Lihat detail absensi"
                                    onclick="lihatDetailAbsensi(this)"
                                >
                                    <i class="bi bi-eye"></i>
                                </button>

                            </td>

                        </tr>

                    <?php endforeach; ?>


                <?php else: ?>

                    <tr>
                        <td colspan="8">

                            <div class="absensi-empty-content">

                                <i class="bi bi-calendar2-x"></i>

                                <strong>
                                    Data absensi tidak ditemukan
                                </strong>

                                <span>
                                    Tidak ada data petugas sesuai
                                    filter yang dipilih.
                                </span>

                            </div>

                        </td>
                    </tr>

                <?php endif; ?>

            </tbody>

        </table>

    </div>


    <div class="absensi-table-footer">

        <span>
            Menampilkan <?= $totalData ?> data absensi
        </span>

        <span>
            Data kehadiran berdasarkan aktivitas login dan logout
        </span>

    </div>

</div>


<!-- ==================== MODAL DETAIL ==================== -->

<div
    class="modal fade"
    id="absensiDetailModal"
    tabindex="-1"
    aria-hidden="true"
>

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content">


            <div class="modal-header">

                <h5 class="modal-title">

                    <i class="bi bi-clipboard-check me-2"></i>

                    Detail Absensi Petugas

                </h5>


                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Tutup"
                ></button>

            </div>


            <div class="modal-body">

                <div class="detail-item">

                    <span class="detail-label">
                        Username Petugas
                    </span>

                    <div
                        class="detail-value"
                        id="detailUsername"
                    >
                        -
                    </div>

                </div>


                <div class="detail-item">

                    <span class="detail-label">
                        Instansi
                    </span>

                    <div
                        class="detail-value"
                        id="detailInstansi"
                    >
                        -
                    </div>

                </div>


                <div class="detail-item">

                    <span class="detail-label">
                        Tanggal
                    </span>

                    <div
                        class="detail-value"
                        id="detailTanggal"
                    >
                        -
                    </div>

                </div>


                <div class="detail-item">

                    <span class="detail-label">
                        Status Kehadiran
                    </span>

                    <div
                        class="detail-value"
                        id="detailStatus"
                    >
                        -
                    </div>

                </div>


                <div class="detail-item">

                    <span class="detail-label">
                        Jam Masuk
                    </span>

                    <div
                        class="detail-value"
                        id="detailJamMasuk"
                    >
                        -
                    </div>

                </div>


                <div class="detail-item">

                    <span class="detail-label">
                        Jam Pulang
                    </span>

                    <div
                        class="detail-value"
                        id="detailJamPulang"
                    >
                        -
                    </div>

                </div>


                <div class="detail-item">

                    <span class="detail-label">
                        Keterangan
                    </span>

                    <div
                        class="detail-value"
                        id="detailKeterangan"
                    >
                        -
                    </div>

                </div>

            </div>


            <div class="modal-footer">

                <button
                    type="button"
                    class="btn btn-light btn-sm"
                    data-bs-dismiss="modal"
                >
                    Tutup
                </button>

            </div>

        </div>

    </div>

</div>

<?= $this->endSection() ?>


<?= $this->section('scripts') ?>

<script>

function formatTanggalAbsensi(tanggal) {

    if (
        !tanggal ||
        !/^\d{4}-\d{2}-\d{2}$/.test(tanggal)
    ) {
        return '-';
    }

    return new Date(
        tanggal + 'T00:00:00'
    ).toLocaleDateString(
        'id-ID',
        {
            day: '2-digit',
            month: 'long',
            year: 'numeric'
        }
    );
}


function lihatDetailAbsensi(button) {

    const row = button.closest('tr');

    if (!row) {
        return;
    }


    document.getElementById(
        'detailUsername'
    ).textContent =
        row.dataset.username || '-';


    document.getElementById(
        'detailInstansi'
    ).textContent =
        row.dataset.instansi || '-';


    document.getElementById(
        'detailTanggal'
    ).textContent =
        formatTanggalAbsensi(
            row.dataset.tanggal
        );


    document.getElementById(
        'detailStatus'
    ).textContent =
        row.dataset.status || '-';


    document.getElementById(
        'detailJamMasuk'
    ).textContent =
        row.dataset.jamMasuk || '-';


    document.getElementById(
        'detailJamPulang'
    ).textContent =
        row.dataset.jamPulang || '-';


    document.getElementById(
        'detailKeterangan'
    ).textContent =
        row.dataset.keterangan || '-';


    bootstrap.Modal
        .getOrCreateInstance(
            document.getElementById(
                'absensiDetailModal'
            )
        )
        .show();
}

</script>

<?= $this->endSection() ?>