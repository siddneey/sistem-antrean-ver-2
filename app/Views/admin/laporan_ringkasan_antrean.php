<?= $this->extend('layouts/admin') ?>

<?= $this->section('styles') ?>
<style>
    /* PAGE HEADING */
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

    /* FILTER */
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
        grid-template-columns:
            minmax(130px, 1fr)
            minmax(130px, 1fr)
            minmax(160px, 1.2fr)
            auto;
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
        width: 100%;
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

    .filter-actions {
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .btn-filter,
    .btn-export {
        height: 39px;
        border-radius: 7px;
        border: none;
        padding: 0 13px;
        font-size: 12px;
        font-weight: 700;
        white-space: nowrap;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 7px;
        cursor: pointer;
        text-decoration: none;
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
    }

    .btn-export:hover {
        background: #4fa957;
        color: #fff;
    }

    .btn-export.secondary {
        background: #64748b;
    }

    .btn-export.secondary:hover {
        background: #475467;
        color: #fff;
    }

    /* TABLE */
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
        margin-top: 3px;
    }

    .table-wrap {
        width: 100%;
        overflow-x: auto;
    }

    .report-table {
        width: 100%;
        min-width: 650px;
        border-collapse: collapse;
    }

    .report-table th {
        height: 45px;
        background: #f8f9fb;
        color: #475467;
        border-bottom: 1px solid #dfe4ea;
        padding: 10px 12px;
        font-size: 11px;
        font-weight: 700;
        text-align: left;
        vertical-align: middle;
    }

    .report-table th:nth-child(2),
    .report-table td:nth-child(2) {
        width: 210px;
    }

    .report-table th:nth-child(3),
    .report-table td:nth-child(3) {
        width: 140px;
        text-align: center;
    }

    .report-table td {
        min-height: 42px;
        padding: 10px 12px;
        border-bottom: 1px solid #edf0f3;
        color: #475467;
        font-size: 12px;
        vertical-align: middle;
    }

    .report-table tbody tr:hover {
        background: #fbfcfd;
    }

    .instansi-row td {
        background: #fafafa;
        color: var(--navy);
        font-weight: 700;
    }

    .service-name {
        padding-left: 30px !important;
    }

    .total-row td {
        background: #eaf5e3;
        color: #344054;
        font-weight: 700;
        border-top: 1px solid #dcebd3;
        border-bottom: none;
    }

    .btn-detail {
        min-height: 30px;
        padding: 0 12px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 6px;
        background: #68bd70;
        color: white;
        text-decoration: none;
        font-size: 11px;
        font-weight: 600;
    }

    .btn-detail:hover {
        background: #51a95b;
        color: white;
    }

    .empty-row {
        text-align: center;
        padding: 35px 15px !important;
        color: var(--muted) !important;
    }

    /* RESPONSIVE */
    @media (max-width: 1250px) {
        .filter-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }

        .filter-actions {
            grid-column: 1 / -1;
        }

        .filter-actions button {
            flex: 1;
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

        .filter-actions {
            grid-column: auto;
            flex-direction: column;
        }

        .filter-actions button {
            width: 100%;
        }

        .page-heading h1 {
            font-size: 20px;
        }

        .table-toolbar {
            align-items: flex-start;
            flex-direction: column;
        }
    }
</style>
<?= $this->endSection() ?>


<?= $this->section('pageTitle') ?>
<div class="page-heading">
    <div class="heading-main">
        <div>
            <h1>Laporan Ringkasan Antrean</h1>
            <p>
                Menampilkan ringkasan jumlah antrean selesai berdasarkan
                periode dan instansi layanan.
            </p>
        </div>
    </div>
</div>
<?= $this->endSection() ?>


<?= $this->section('content') ?>

<!-- FILTER -->
<div class="filter-box">
    <div class="filter-title">
        <i class="bi bi-funnel"></i>
        Filter Laporan
    </div>

    <form
        id="filterForm"
        method="get"
        action="<?= site_url('admin/laporan-ringkasan-antrean') ?>"
    >
        <div class="filter-grid">

            <div class="field">
                <label for="tanggalMulai">Tanggal Mulai</label>
                <input
                    type="date"
                    id="tanggalMulai"
                    name="tanggal_mulai"
                    class="form-control"
                    value="<?= esc($_GET['tanggal_mulai'] ?? date('Y-m-d')) ?>"
                >
            </div>

            <div class="field">
                <label for="tanggalSelesai">Tanggal Selesai</label>
                <input
                    type="date"
                    id="tanggalSelesai"
                    name="tanggal_selesai"
                    class="form-control"
                    value="<?= esc($_GET['tanggal_selesai'] ?? date('Y-m-d')) ?>"
                >
            </div>

            <div class="field">
                <label for="instansi">Instansi</label>
                <select id="instansi" name="instansi" class="form-select">
                    <option value="">Semua Instansi</option>
                    <?php foreach (($daftarInstansi ?? []) as $item): ?>
                        <option
                            value="<?= esc($item['nama_instansi']) ?>"
                            <?= (($_GET['instansi'] ?? '') === $item['nama_instansi']) ? 'selected' : '' ?>
                        >
                            <?= esc($item['nama_instansi']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="filter-actions">
                <button type="submit" class="btn-filter">
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
            <div class="table-toolbar-title">Ringkasan Antrean Selesai</div>
            <div class="table-toolbar-info">
                Jumlah antrean selesai per instansi dan layanan
            </div>
        </div>

        <button type="button" class="btn-export" id="exportExcel">
            <i class="bi bi-file-earmark-excel"></i>
            Ekspor Excel
        </button>
    </div>

    <div class="table-wrap">
        <table class="report-table">
            <thead>
                <tr>
                    <th>Instansi</th>
                    <th>Jumlah Antrean Selesai</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>
                <!-- Data contoh sementara -->
                <tr class="instansi-row">
                    <td>BAPENDA</td>
                    <td>4</td>
                    <td>
                        <a href="#" class="btn-detail">
                            Lihat Detail
                        </a>
                    </td>
                </tr>

                <tr>
                    <td class="service-name">
                        – Pendaftaran SPPT PBB-P2 Objek Pajak Baru
                    </td>
                    <td>1</td>
                    <td></td>
                </tr>

                <tr>
                    <td class="service-name">
                        – Permohonan Penundaan Jatuh Tempo Pembayaran PBB-P2
                    </td>
                    <td>1</td>
                    <td></td>
                </tr>

                <tr>
                    <td class="service-name">
                        – Permohonan SPPT-PBB-P2 Mutasi Sebagian/Seluruhnya Objek dan Subjek
                    </td>
                    <td>1</td>
                    <td></td>
                </tr>

                <tr>
                    <td class="service-name">
                        – Permohonan Surat Keterangan NJOP
                    </td>
                    <td>1</td>
                    <td></td>
                </tr>
            </tbody>

            <tfoot>
                <tr class="total-row">
                    <td>TOTAL</td>
                    <td>4</td>
                    <td></td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>

<?= $this->endSection() ?>


<?= $this->section('scripts') ?>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('filterForm');
    const mulai = document.getElementById('tanggalMulai');
    const selesai = document.getElementById('tanggalSelesai');

    if (form && mulai && selesai) {
        form.addEventListener('submit', function (event) {
            if (mulai.value && selesai.value && mulai.value > selesai.value) {
                event.preventDefault();
                alert('Tanggal mulai tidak boleh lebih besar dari tanggal selesai.');
            }
        });
    }

    document.getElementById('exportRingkasan')?.addEventListener('click', function () {
        alert('Fitur ekspor ringkasan belum dihubungkan ke backend.');
    });

    document.getElementById('exportHarian')?.addEventListener('click', function () {
        alert('Fitur ekspor harian belum dihubungkan ke backend.');
    });
});
</script>
<?= $this->endSection() ?>