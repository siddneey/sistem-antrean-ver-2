<?= $this->extend('layouts/admin') ?>

<?= $this->section('styles') ?>
<style>
    /* =========================
       PAGE HEADING
       ========================= */
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

    .report-date {
        color: var(--muted);
        font-size: 12px;
        padding-top: 5px;
        white-space: nowrap;
    }

    /* =========================
       FILTER
       ========================= */
    .filter-box {
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
        font-size: 14px;
        color: #64748b;
    }

    .filter-grid {
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr)) auto;
        gap: 12px;
        align-items: end;
    }

    .field label {
        display: block;
        margin-bottom: 6px;
        color: #667085;
        font-size: 11px;
        font-weight: 600;
    }

    .filter-box .form-control,
    .filter-box .form-select {
        height: 39px;
        border: 1px solid #dfe4ea;
        border-radius: 7px;
        color: var(--text);
        font-size: 12.5px;
        box-shadow: none;
    }

    .filter-box .form-control:focus,
    .filter-box .form-select:focus {
        border-color: #aab7c8;
    }

    .btn-filter,
    .btn-export {
        height: 39px;
        border-radius: 7px;
        border: none;
        padding: 0 16px;
        font-size: 12px;
        font-weight: 700;
        white-space: nowrap;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 7px;
        text-decoration: none;
        width: auto;
        flex-shrink: 0;
    }

    .btn-filter {
        background: var(--navy);
        color: #fff;
    }

    .btn-filter:hover {
        background: var(--navy-light);
        color: #fff;
    }

    .btn-export {
        background: #5fb967;
        color: #fff;
        cursor: pointer;
    }

    .btn-export:hover {
        background: #4fa957;
        color: #fff;
    }

    /* =========================
       TABLE
       ========================= */
    .table-panel {
        background: var(--white);
        border: 1px solid var(--border);
        border-radius: 11px;
        overflow: hidden;
    }

    .table-toolbar {
        min-height: 54px;
        padding: 10px 17px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        border-bottom: 1px solid var(--border);
    }

    .table-toolbar-title {
        color: var(--navy);
        font-size: 13px;
        font-weight: 700;
    }

    .table-toolbar-info {
        color: var(--muted);
        font-size: 11px;
    }

    .table-wrap {
        width: 100%;
        overflow-x: auto;
    }

    .report-table {
        width: 100%;
        min-width: 1120px;
        border-collapse: collapse;
    }

    .report-table th {
        background: #f8f9fb;
        color: #475467;
        border-bottom: 1px solid #dfe4ea;
        border-right: 1px solid #edf0f3;
        padding: 12px 9px;
        font-size: 11px;
        font-weight: 700;
        text-align: center;
        vertical-align: middle;
        white-space: nowrap;
    }

    .report-table th:last-child,
    .report-table td:last-child {
        border-right: none;
    }

    .report-table td {
        height: 50px;
        padding: 9px;
        border-bottom: 1px solid #edf0f3;
        border-right: 1px solid #f0f2f5;
        color: #344054;
        font-size: 12px;
        text-align: center;
        vertical-align: middle;
    }

    .report-table tbody tr.data-row:hover {
        background: #fbfcfd;
    }

    .date-row td {
        height: 39px;
        padding: 8px 13px;
        background: #fff8dc;
        color: #735d09;
        border-bottom: 1px solid #eee2ae;
        text-align: left;
        font-weight: 700;
        font-size: 12px;
    }

    .date-row i {
        margin-right: 7px;
    }

    .queue-number {
        color: var(--navy);
        font-weight: 700;
        font-size: 13px;
    }

    .petugas {
        text-align: center !important;
    }

    .instansi {
        font-weight: 700;
        color: var(--navy) !important;
        text-align: center !important;
    }

    .booking {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        color: #667085;
    }

    .booking.yes {
        color: var(--green);
        font-weight: 600;
    }

    .status-badge {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 68px;
        height: 24px;
        padding: 0 8px;
        border-radius: 5px;
        font-size: 10.5px;
        font-weight: 700;
    }

    .status-selesai {
        color: #176b42;
        background: #e8f5ed;
    }

    .status-proses {
        color: #7a5c00;
        background: #fff4cf;
    }

    .status-menunggu {
        color: #5b6472;
        background: #eef1f4;
    }

    .table-empty {
        padding: 45px 20px !important;
        color: var(--muted) !important;
    }

    /* =========================
       RESPONSIVE
       ========================= */
    @media (max-width: 1250px) {
        .filter-grid {
            grid-template-columns: repeat(3, minmax(0, 1fr));
        }

        .btn-filter,
        .btn-export {
            width: 100%;
        }
    }

    @media (max-width: 900px) {
        .page-heading {
            display: block;
        }

        .report-date {
            margin-top: 8px;
        }
    }

    @media (max-width: 700px) {
        .filter-grid {
            grid-template-columns: 1fr;
        }

        .page-heading h1 {
            font-size: 20px;
        }

        .table-toolbar {
            align-items: flex-start;
            flex-direction: column;
        }

        .table-toolbar .btn-export {
            width: auto;
        }
    }
</style>
<?= $this->endSection() ?>


<?= $this->section('pageTitle') ?>
<div class="page-heading">
    <div class="heading-main">
        <div>
            <h1>Laporan Proses Antrean</h1>
            <p>
                Menampilkan riwayat proses antrean berdasarkan periode
                dan status antrean.
            </p>
        </div>
    </div>
</div>
<?= $this->endSection() ?>


<?= $this->section('content') ?>

<?php
$namaBulan = [
    1  => 'Januari',
    2  => 'Februari',
    3  => 'Maret',
    4  => 'April',
    5  => 'Mei',
    6  => 'Juni',
    7  => 'Juli',
    8  => 'Agustus',
    9  => 'September',
    10 => 'Oktober',
    11 => 'November',
    12 => 'Desember',
];

$formatTanggal = static function ($tanggal) use ($namaBulan) {
    if (empty($tanggal)) {
        return '—';
    }

    $timestamp = strtotime($tanggal);

    if ($timestamp === false) {
        return '—';
    }

    return date('d', $timestamp) . ' '
        . $namaBulan[(int) date('n', $timestamp)] . ' '
        . date('Y', $timestamp);
};

$formatWaktu = static function ($waktu) {
    if (empty($waktu)) {
        return '—';
    }

    $timestamp = strtotime($waktu);

    return $timestamp === false
        ? '—'
        : date('H:i:s', $timestamp);
};

$statusLabel = static function ($status) {
    switch (strtoupper((string) $status)) {
        case 'SELESAI':
            return 'Selesai';

        case 'DIPANGGIL':
            return 'Dipanggil';

        case 'DILAYANI':
            return 'Dilayani';

        case 'PENDING':
            return 'Pending';

        case 'MENUNGGU':
        default:
            return 'Menunggu';
    }
};

$statusClass = static function ($status) {
    switch (strtoupper((string) $status)) {
        case 'SELESAI':
            return 'status-selesai';

        case 'DIPANGGIL':
        case 'DILAYANI':
        case 'PENDING':
            return 'status-proses';

        case 'MENUNGGU':
        default:
            return 'status-menunggu';
    }
};

/*
 * Kelompokkan baris berdasarkan tanggal tiket antrean.
 * Query controller mengurutkan tanggal terbaru lebih dahulu.
 */
$kelompokLaporan = [];

foreach ($laporan ?? [] as $item) {
    $tanggal = $item['tanggal_antrean']
        ?? $item['waktu_masuk']
        ?? '';

    $kunciTanggal = $tanggal !== ''
        ? date('Y-m-d', strtotime($tanggal))
        : 'tanpa-tanggal';

    $kelompokLaporan[$kunciTanggal][] = $item;
}

$totalLaporan = count($laporan ?? []);
?>

<!-- FILTER -->
<div class="filter-box">
    <div class="filter-title">
        <i class="bi bi-funnel"></i>
        Filter Laporan
    </div>

    <form
        id="filterForm"
        method="get"
        action="<?= site_url('admin/laporan-proses-antrean') ?>"
    >
        <div class="filter-grid">

            <div class="field">
                <label for="tanggalMulai">Tanggal Mulai</label>
                <input
                    type="date"
                    id="tanggalMulai"
                    name="tanggal_mulai"
                    class="form-control"
                    value="<?= esc($tanggalMulai ?? date('Y-m-d')) ?>"
                >
            </div>

            <div class="field">
                <label for="tanggalSelesai">Tanggal Selesai</label>
                <input
                    type="date"
                    id="tanggalSelesai"
                    name="tanggal_selesai"
                    class="form-control"
                    value="<?= esc($tanggalSelesai ?? date('Y-m-d')) ?>"
                >
            </div>

            <div class="field">
                <label for="statusAntrean">Status Antrean</label>
                <select
                    id="statusAntrean"
                    name="status"
                    class="form-select"
                >
                    <option value="">Semua Antrean</option>

                    <option
                        value="menunggu"
                        <?= ($filterStatus ?? '') === 'menunggu' ? 'selected' : '' ?>
                    >
                        Menunggu
                    </option>

                    <option
                        value="proses"
                        <?= ($filterStatus ?? '') === 'proses' ? 'selected' : '' ?>
                    >
                        Diproses
                    </option>

                    <option
                        value="selesai"
                        <?= ($filterStatus ?? '') === 'selesai' ? 'selected' : '' ?>
                    >
                        Selesai
                    </option>
                </select>
            </div>

            <div class="field">
                <label for="instansi">Instansi</label>
                <select
                    id="instansi"
                    name="instansi"
                    class="form-select"
                >
                    <option value="">Semua Instansi</option>

                    <?php foreach (($daftarInstansi ?? []) as $itemInstansi): ?>
                        <?php $namaInstansi = $itemInstansi['nama_instansi'] ?? ''; ?>

                        <option
                            value="<?= esc($namaInstansi) ?>"
                            <?= ($filterInstansi ?? '') === $namaInstansi ? 'selected' : '' ?>
                        >
                            <?= esc($namaInstansi) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="field">
                <button type="submit" class="btn-filter w-100">
                    <i class="bi bi-search"></i>
                    Cari Data
                </button>
            </div>

        </div>
    </form>
</div>


<!-- TABLE -->
<div class="table-panel">

    <div class="table-toolbar">
        <div>
            <div class="table-toolbar-title">Data Proses Antrean</div>
            <div class="table-toolbar-info">
                Menampilkan <?= $totalLaporan ?> data sesuai filter
            </div>
        </div>

        <button
            type="button"
            class="btn-export"
            id="exportExcel"
        >
            <i class="bi bi-file-earmark-excel"></i>
            Ekspor Excel
        </button>
    </div>

    <div class="table-wrap">
        <table class="report-table" id="reportTable">
            <thead>
                <tr>
                    <th style="width:45px;">No</th>
                    <th>Petugas</th>
                    <th>Nomor<br>Antrean</th>
                    <th>Waktu<br>Ambil</th>
                    <th>Waktu<br>Panggil</th>
                    <th>Waktu<br>Selesai</th>
                    <th>Instansi</th>
                    <th>Layanan</th>
                    <th>Kategori<br>Antrean</th>
                    <th>Booking</th>
                    <th>Diteruskan<br>Oleh</th>
                    <th>Status</th>
                </tr>
            </thead>

            <tbody>
                <?php if ($totalLaporan === 0): ?>
                    <tr>
                        <td colspan="12" class="table-empty">
                            <i class="bi bi-inbox" style="font-size:22px;"></i>
                            <div style="margin-top:8px;">
                                Tidak ada data antrean pada periode dan filter yang dipilih.
                            </div>
                        </td>
                    </tr>
                <?php else: ?>

                    <?php $nomor = 1; ?>

                    <?php foreach ($kelompokLaporan as $tanggal => $barisTanggal): ?>
                        <tr class="date-row">
                            <td colspan="12">
                                <i class="bi bi-calendar3"></i>
                                Tanggal:
                                <?= $tanggal === 'tanpa-tanggal'
                                    ? 'Tidak diketahui'
                                    : esc($formatTanggal($tanggal)) ?>
                            </td>
                        </tr>

                        <?php foreach ($barisTanggal as $row): ?>
                            <?php
                            $status = strtoupper(
                                (string) ($row['status_layanan'] ?? 'MENUNGGU')
                            );

                            $nomorAntrean = $row['nomor_antrean'] ?? null;

                            $waktuAmbil = $row['waktu_ambil']
                                ?? $row['waktu_masuk']
                                ?? null;

                            // waktu_mulai merupakan waktu mulai pelayanan.
                            $waktuPanggil = $row['waktu_mulai'] ?? null;

                            $waktuSelesai = $row['waktu_selesai'] ?? null;

                            $jenisAntrean = strtoupper(
                                (string) ($row['jenis_antrean'] ?? '')
                            );

                            $kategoriAntrean = $jenisAntrean === 'PRIORITAS'
                                ? 'Prioritas'
                                : ($jenisAntrean === 'BIASA' ? 'Umum' : '—');
                            ?>

                            <tr class="data-row">
                                <td><?= $nomor++ ?></td>

                                <td class="petugas">
                                    <?= esc($row['nama_petugas'] ?? '—') ?>
                                </td>

                                <td class="queue-number">
                                    <?= $nomorAntrean !== null
                                        ? esc((string) $nomorAntrean)
                                        : '—' ?>
                                </td>

                                <td>
                                    <?= esc($formatWaktu($waktuAmbil)) ?>
                                </td>

                                <td>
                                    <?= esc($formatWaktu($waktuPanggil)) ?>
                                </td>

                                <td>
                                    <?= esc($formatWaktu($waktuSelesai)) ?>
                                </td>

                                <td class="instansi">
                                    <?= esc($row['nama_instansi'] ?? '—') ?>
                                </td>

                                <td>
                                    <?= esc($row['nama_layanan'] ?? '—') ?>
                                </td>

                                <td>
                                    <?= esc($kategoriAntrean) ?>
                                </td>

                                <td>
                                    <span class="booking">—</span>
                                </td>

                                <td>—</td>

                                <td>
                                    <span class="status-badge <?= esc($statusClass($status)) ?>">
                                        <?= esc($statusLabel($status)) ?>
                                    </span>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endforeach; ?>

                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?= $this->endSection() ?>


<?= $this->section('scripts') ?>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const filterForm = document.getElementById('filterForm');
    const exportButton = document.getElementById('exportExcel');

    if (filterForm) {
        filterForm.addEventListener('submit', function (event) {
            const mulai = document.getElementById('tanggalMulai').value;
            const selesai = document.getElementById('tanggalSelesai').value;

            if (mulai && selesai && mulai > selesai) {
                event.preventDefault();
                alert('Tanggal mulai tidak boleh lebih besar dari tanggal selesai.');
            }
        });
    }

    if (exportButton) {
        exportButton.addEventListener('click', function () {
            const params = new URLSearchParams();

            const tanggalMulai =
                document.getElementById('tanggalMulai').value;

            const tanggalSelesai =
                document.getElementById('tanggalSelesai').value;

            const status =
                document.getElementById('statusAntrean').value;

            const instansi =
                document.getElementById('instansi').value;

            const keywordInput =
                document.getElementById('keyword');

            if (tanggalMulai) {
                params.set('tanggal_mulai', tanggalMulai);
            }

            if (tanggalSelesai) {
                params.set('tanggal_selesai', tanggalSelesai);
            }

            if (status) {
                params.set('status', status);
            }

            if (instansi) {
                params.set('instansi', instansi);
            }

            if (keywordInput && keywordInput.value.trim()) {
                params.set('keyword', keywordInput.value.trim());
            }

            const baseUrl =
                '<?= site_url('admin/laporan-proses-antrean/export') ?>';

            const queryString = params.toString();

            window.location.assign(
                baseUrl + (queryString ? '?' + queryString : '')
            );
        });
    }

});
</script>
<?= $this->endSection() ?>