<?= $this->extend('layouts/admin') ?>

<?= $this->section('pageTitle') ?>
<div class="pk-heading">
    <div>
        <h1>Pengaturan Hari Libur</h1>
        <p>Kelola jadwal hari libur dan penutupan layanan MPP Kota Tangerang.</p>
    </div>
</div>
<?= $this->endSection() ?>


<?= $this->section('styles') ?>
<style>
    /* HEADING */
    .pk-heading {
        margin-bottom: 22px;
    }

    .pk-heading h1 {
        font-size: 23px;
        font-weight: 700;
        color: var(--navy);
        margin: 0;
    }

    .pk-heading p {
        color: var(--muted);
        font-size: 12.5px;
        margin: 5px 0 0;
    }

    /* BUTTON */
    .pk-primary {
        border: 0;
        background: var(--navy);
        color: white;
        border-radius: 7px;
        padding: 11px 16px;
        font-size: 12px;
        font-weight: 700;
        white-space: nowrap;
        cursor: pointer;
    }

    .pk-primary:hover {
        background: var(--navy-light);
        color: white;
    }

    /* STATISTIK */
    .stats-row {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 16px;
        margin-bottom: 20px;
    }

    .stat-card {
        display: flex;
        align-items: center;
        gap: 14px;
        padding: 17px 19px;
        background: white;
        border: 1px solid var(--border);
        border-radius: 10px;
    }

    .stat-icon {
        width: 44px;
        height: 44px;
        min-width: 44px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 9px;
        background: var(--yellow-soft);
        color: #a77c00;
        font-size: 20px;
    }

    .stat-card:nth-child(2) .stat-icon {
        background: #eaf1fb;
        color: #416b9d;
    }

    .stat-card:nth-child(3) .stat-icon {
        background: #e5f5ec;
        color: var(--green);
    }

    .stat-card small {
        display: block;
        margin-bottom: 4px;
        color: var(--muted);
        font-size: 12px;
    }

    .stat-card strong {
        font-size: 22px;
    }

    /* FILTER */
    .pk-filter {
        padding: 17px 18px;
        margin-bottom: 18px;
        background: white;
        border: 1px solid var(--border);
        border-radius: 9px;
    }

    .pk-filter > strong {
        font-size: 13px;
        color: var(--navy);
        display: block;
        margin-bottom: 13px;
    }

    .pk-filter-grid {
        display: grid;
        grid-template-columns: minmax(180px, 1fr) 200px 200px auto;
        gap: 12px;
    }

    .pk-filter input,
    .pk-filter select {
        width: 100%;
        min-height: 40px;
        border: 1px solid var(--border);
        border-radius: 7px;
        padding: 10px;
        font-size: 12px;
    }

    .pk-search-btn {
        background: var(--navy);
        color: white;
        border: 0;
        border-radius: 7px;
        padding: 9px 24px;
        min-width: 140px;
        min-height: 40px;
        font-size: 12px;
        font-weight: 600;
        white-space: nowrap;
        cursor: pointer;
    }

    .pk-search-btn:hover {
        background: var(--navy-light);
    }

    /* HEADER TABEL */
    .pk-table-head {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 15px;
        padding: 18px 20px;
    }

    .pk-table-head h2 {
        margin: 0;
        color: var(--navy);
        font-size: 16px;
        font-weight: 700;
    }

    .pk-table-head p {
        margin: 5px 0 0;
        color: var(--muted);
        font-size: 12px;
    }

    /* TABEL */
    .table-card {
        margin-top: 20px;
        overflow: hidden;
        background: var(--white);
        border: 1px solid var(--border);
        border-radius: 8px;
        box-shadow: 0 4px 16px rgba(16, 35, 63, .05);
    }

    .table-responsive {
        overflow-x: auto;
    }

    .hari-libur-table {
        width: 100%;
        min-width: 900px;
        table-layout: fixed;
        border-collapse: separate;
        border-spacing: 0;
        margin: 0;
        font-size: 13px;
    }

    .hari-libur-table th {
        height: 52px;
        padding: 0 14px;
        background: #fafafa;
        border-bottom: 1px solid var(--border);
        color: #64748b;
        text-align: center;
        vertical-align: middle;
        font-size: 12px;
        font-weight: 600;
        white-space: nowrap;
    }

    .hari-libur-table td {
        padding: 15px 14px;
        border-bottom: 1px solid #edf0f3;
        color: #64748b;
        font-size: 12.5px;
        vertical-align: middle;
    }

    /* Pembagian lebar kolom */
    .hari-libur-table th,
    .hari-libur-table td {
        padding: 12px 8px;
        vertical-align: middle;
    }

    /* No. */
    .hari-libur-table th:nth-child(1),
    .hari-libur-table td:nth-child(1) {
        width: 7%;
        text-align: center;
    }

    /* Tanggal */
    .hari-libur-table th:nth-child(2),
    .hari-libur-table td:nth-child(2) {
        width: 14%;
        text-align: center;
    }

    /* Nama Hari Libur */
    .hari-libur-table th:nth-child(3) {
        width: 22%;
        text-align: center;
    }

    .hari-libur-table td:nth-child(3) {
        width: 22%;
        text-align: left;
        padding-left: 38px;
    }

    /* Jenis Libur */
    .hari-libur-table th:nth-child(4),
    .hari-libur-table td:nth-child(4) {
        width: 16%;
        text-align: center;
    }

    /* Keterangan */
    .hari-libur-table th:nth-child(5),
    .hari-libur-table td:nth-child(5) {
        width: 23%;
        text-align: center;
    }

    /* Aksi */
    .hari-libur-table th:nth-child(6),
    .hari-libur-table td:nth-child(6) {
        width: 18%;
        text-align: center;
    }

    .hari-libur-table tbody tr:last-child td {
        border-bottom: none;
    }

    .hari-libur-table tbody tr:hover td {
        background: #fcfcfc;
    }

    /* Keterangan */
    .hari-libur-table td.keterangan-kosong {
        text-align: center !important;
        padding-left: 8px !important;
        padding-right: 8px !important;
    }

    .hari-libur-table td.keterangan-isi {
        text-align: left !important;
        padding-left: 15px !important;
    }

    /* Nama Hari Libur */
    .holiday-name {
        color: #64748b !important;
        font-size: 13px !important;
        font-weight: 700;
    }

    /*Deskripsi Penggunaan Tanggal */
    .petunjuk-tanggal {
        display: block;
        font-size: 11px;
        font-style: italic;
        color: #8491a3;
        margin-top: 5px;
    }

    /* Badge Jenis Libur */
    .holiday-badge {
        display: inline-block;
        padding: 3px 8px;
        border-radius: 5px;
        font-size: 10px;
        font-weight: 600;
        white-space: nowrap;
    }

    .badge-national {
        background:rgb(252, 235, 196);
        color: #936b13;
    }

    .badge-special {
        background: #cfe2ff;
        color: #084298;
    }

    /* Tombol Aksi */
    .action-group {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
    }

    .action-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 32px;
        height: 32px;
        border: 1px solid var(--navy);
        border-radius: 7px;
        background: #fff;
        color: var(--navy);
        font-size: 13px;
        cursor: pointer;
        transition: background .2s ease, border-color .2s ease;
    }

    .action-btn.delete {
        border-color: var(--red);
        color: var(--red);
    }

    .action-btn.edit:hover {
        background: var(--navy);
        border-color: var(--navy);
        color: #fff;
    }

    .action-btn.delete:hover {
        background: #c62828;
        border-color: #c62828;
        color: #fff;
    }

    /* Empty State dan Footer */
    .empty-content {
        padding: 45px 20px !important;
        text-align: center;
    }

    .empty-content i {
        display: block;
        margin-bottom: 10px;
        color: #c5ccd5;
        font-size: 32px;
    }

    .empty-content strong {
        display: block;
        margin-bottom: 4px;
        color: #64748b;
        font-size: 13px;
    }

    .empty-content span {
        color: var(--muted);
        font-size: 11px;
    }

    .table-footer {
        padding: 12px 15px;
        border-top: 1px solid var(--border);
        color: #98a2b3;
        font-size: 11px;
    }

    /* MODAL */
    #modalHariLibur .modal-content {
        overflow: hidden;
        border: none;
        border-radius: 12px;
    }

    #modalHariLibur .modal-header {
        background: var(--navy);
        color: white;
    }

    #modalHariLibur .modal-header p {
        margin: 5px 0 0;
        color: rgba(255, 255, 255, .65);
        font-size: 12px;
    }

    #modalHariLibur .modal-header .btn-close {
        filter: invert(1);
    }

    #modalHariLibur .modal-body {
        padding: 23px;
    }

    #modalHariLibur .modal-body label {
        margin-bottom: 7px;
        color: #475467;
        font-size: 13px;
        font-weight: 600;
    }

    #modalHariLibur .modal-body .form-control,
    #modalHariLibur .modal-body .form-select {
        border-color: var(--border);
        border-radius: 7px;
        font-size: 13px;
    }

    .btn-save {
        padding: 9px 17px;
        border: none;
        border-radius: 7px;
        background: #25aaa3;
        color: white;
        font-size: 13px;
    }

    .btn-save:hover {
        background: #208f89;
        color: white;
    }

    /* Kalender Flatpickr - gaya kalender bawaan */
    .flatpickr-calendar {
        width: 270px !important;
        padding: 5px;
        border: 1px solid #ced4da !important;
        border-radius: 8px !important;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.08) !important;
        font-family: inherit;
        font-size: 12px;
    }

    /* Header bulan */
    .flatpickr-months {
        height: 35px;
    }

    .flatpickr-current-month {
        font-size: 13px !important;
        padding-top: 7px;
    }

    .flatpickr-monthDropdown-months {
        font-size: 13px !important;
    }

    .numInputWrapper span {
        display: none;
    }

    /* Navigasi bulan */
    .flatpickr-prev-month,
    .flatpickr-next-month {
        padding: 8px !important;
        fill: #495057 !important;
    }

    /* Nama hari */
    .flatpickr-weekdays {
        height: 28px;
    }

    span.flatpickr-weekday {
        font-size: 11px;
        font-weight: 500;
        color: #495057;
    }

    /* Tanggal */
    .flatpickr-days {
        width: 252px !important;
    }

    .dayContainer {
        min-width: 252px !important;
        max-width: 252px !important;
        width: 252px !important;
    }

    .flatpickr-day {
        max-width: 36px;
        height: 34px;
        line-height: 34px;
        font-size: 12px;
        border-radius: 50%;
    }

    /* Tanggal terpilih */
    .flatpickr-day.selected,
    .flatpickr-day.startRange,
    .flatpickr-day.endRange {
        background: #0d6efd !important;
        border-color: #0d6efd !important;
        color: white !important;
    }

    /* Hover tanggal */
    .flatpickr-day:hover {
        background: #e9ecef;
        border-color: #e9ecef;
    }

    /* RESPONSIVE */
    @media (max-width: 1100px) {
        .pk-filter-grid {
            grid-template-columns: 1fr 1fr;
        }

        .pk-filter-grid button {
            justify-self: start;
        }
    }

    @media (max-width: 768px) {
        .stats-row {
            grid-template-columns: 1fr;
        }

        .pk-filter-grid {
            grid-template-columns: 1fr;
        }

        .pk-filter-grid button {
            width: 100%;
        }

        .pk-table-head {
            align-items: flex-start;
        }

        .pk-table-head .pk-primary {
            padding: 10px 12px;
        }

        .table-footer {
            flex-direction: column;
        }
    }
</style>
<?= $this->endSection() ?>


<?= $this->section('content') ?>

<!-- RINGKASAN -->
<div class="stats-row">
    <div class="stat-card">
        <div class="stat-icon">
            <i class="bi bi-calendar2-week"></i>
        </div>
        <div>
            <small>Total Hari Libur</small>
            <strong id="statTotal">0</strong>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon">
            <i class="bi bi-flag"></i>
        </div>
        <div>
            <small>Libur Nasional</small>
            <strong id="statNasional">0</strong>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon">
            <i class="bi bi-building"></i>
        </div>
        <div>
            <small>Libur Khusus MPP</small>
            <strong id="statKhusus">0</strong>
        </div>
    </div>
</div>

<!-- FILTER DATA -->
<div class="pk-filter">
    <strong>
        <i class="bi bi-funnel"></i>
        Filter Data Hari Libur
    </strong>

    <div class="pk-filter-grid">
        <input
            id="searchLibur"
            type="search"
            placeholder="Cari nama hari libur atau keterangan..."
            aria-label="Cari hari libur"
        >

        <select id="filterTahun" aria-label="Filter tahun">
            <option value="">Semua Tahun</option>
        </select>

        <select id="filterJenis" aria-label="Filter jenis hari libur">
            <option value="">Semua Jenis Libur</option>
            <option value="Nasional">Libur Nasional</option>
            <option value="Khusus MPP">Libur Khusus MPP</option>
        </select>

        <button class="pk-search-btn" id="cariData" type="button">
            <i class="bi bi-search"></i>
            Cari Data
        </button>
    </div>
</div>

<!-- TABEL HARI LIBUR -->
<div class="table-card">
    <div class="pk-table-head">
        <div>
            <h2>Daftar Hari Libur</h2>
            <p>Informasi jadwal hari libur dan penutupan layanan MPP Kota Tangerang.</p>
        </div>

        <button class="pk-primary" type="button" onclick="bukaTambah()">
            <i class="bi bi-plus-lg"></i>
            Tambah Hari Libur
        </button>
    </div>

    <div class="table-responsive">
        <table class="hari-libur-table">
            <thead>
                <tr>
                    <th style="width:60px">No.</th>
                    <th>Tanggal</th>
                    <th>Nama Hari Libur</th>
                    <th>Jenis Libur</th>
                    <th>Keterangan</th>
                    <th style="width:100px">Aksi</th>
                </tr>
            </thead>
            <tbody id="hariLiburBody">
                <tr>
                    <td colspan="6" class="empty-state">
                        <i class="bi bi-search"></i>
                        Atur filter data, lalu klik tombol Cari Data.
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="table-footer">
        <span id="infoData">Silakan lakukan pencarian data hari libur.</span>
        <span>
            <i class="bi bi-info-circle me-1"></i>
            Data tersimpan di database MPP.
        </span>
    </div>
</div>

<!-- MODAL TAMBAH DAN EDIT -->
<div class="modal fade" id="modalHariLibur" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <div>
                    <h5 class="modal-title" id="judulModal">Tambah Hari Libur</h5>
                    <p>Lengkapi informasi hari libur di bawah ini.</p>
                </div>
                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Tutup"
                ></button>
            </div>

            <div class="modal-body">
                <form id="formHariLibur">
                    <input type="hidden" id="liburId">

                    <div class="mb-3">
                        <label for="tanggalLibur">Tanggal Libur</label>
                        <input
                            type="text"
                            id="tanggalLibur"
                            class="form-control"
                            placeholder="Pilih tanggal libur"
                            autocomplete="off"
                            required
                        >
                        <small class="text-muted petunjuk-tanggal">
                            Pilih satu atau beberapa tanggal sesuai kebutuhan.
                        </small>
                    </div>

                    <div class="mb-3">
                        <label for="namaLibur">Nama Hari Libur</label>
                        <input
                            type="text"
                            id="namaLibur"
                            class="form-control"
                            maxlength="150"
                            placeholder="Contoh: Hari Kemerdekaan"
                            required
                        >
                    </div>

                    <div class="mb-3">
                        <label for="jenisLibur">Jenis Hari Libur</label>
                        <select id="jenisLibur" class="form-select" required>
                            <option value="">Pilih jenis libur</option>
                            <option value="Nasional">Libur Nasional</option>
                            <option value="Khusus MPP">Libur Khusus MPP</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="keteranganLibur">Keterangan</label>
                        <textarea
                            id="keteranganLibur"
                            class="form-control"
                            rows="3"
                            maxlength="255"
                            placeholder="Keterangan tambahan (opsional)"
                        ></textarea>
                    </div>

                    <div class="d-flex justify-content-end gap-2 mt-4">
                        <button
                            type="button"
                            class="btn btn-light border"
                            data-bs-dismiss="modal"
                        >Batal</button>

                        <button type="submit" class="btn-save">
                            <i class="bi bi-check2-circle me-1"></i>
                            Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>


<?= $this->section('scripts') ?>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

<script>
    // ============================================================
    // KONFIGURASI API DAN DATA
    // ============================================================
    const apiHariLibur = <?= json_encode(site_url('admin/hari-libur')) ?>;
    const csrfHeader = <?= json_encode(config('Security')->headerName) ?>;
    let csrfHash = <?= json_encode(csrf_hash()) ?>;
    let dataHariLibur = [];

    // Filter yang diterapkan hanya setelah tombol Cari Data diklik.
    let filterDiterapkan = null;

    const modalElement = document.getElementById('modalHariLibur');
    const modal = bootstrap.Modal.getOrCreateInstance(modalElement);
    const form = document.getElementById('formHariLibur');
    const tombolSimpan = form.querySelector('button[type="submit"]');
    const tbody = document.getElementById('hariLiburBody');

    // ============================================================
    // KALENDER MULTI-TANGGAL
    // ============================================================
    const kalenderLibur = flatpickr('#tanggalLibur', {
        mode: 'multiple',
        dateFormat: 'Y-m-d',
        altInput: true,
        altFormat: 'd-m-Y',
        conjunction: ', ',
        allowInput: false,
        disableMobile: true
    });

    // ============================================================
    // UTILITAS TANGGAL DAN KEAMANAN HTML
    // ============================================================
    function formatTanggal(tanggal) {
        if (!tanggal) return '-';
        const bagian = String(tanggal).slice(0, 10).split('-');
        return bagian.length === 3 ? bagian[2] + '-' + bagian[1] + '-' + bagian[0] : '-';
    }

    function escapeHTML(teks) {
        return String(teks ?? '').replace(/[&<>"']/g, function (karakter) {
            return {
                '&': '&amp;', '<': '&lt;', '>': '&gt;',
                '"': '&quot;', "'": '&#039;'
            }[karakter];
        });
    }

    // ============================================================
    // REQUEST JSON KE CODEIGNITER 4
    // ============================================================
    async function requestAPI(url, method = 'GET', payload = null) {
        const headers = { 'Accept': 'application/json' };
        const opsi = { method, headers, credentials: 'same-origin' };

        if (method !== 'GET') {
            headers['Content-Type'] = 'application/json';
            headers[csrfHeader] = csrfHash;
            if (payload !== null) opsi.body = JSON.stringify(payload);
        }

        let response;
        try {
            response = await fetch(url, opsi);
        } catch (error) {
            throw new Error('Tidak dapat terhubung ke server. Periksa jaringan LAN.');
        }

        const tipe = response.headers.get('content-type') || '';
        const hasil = tipe.includes('application/json')
            ? await response.json()
            : null;

        // Bila controller mengembalikan token CSRF terbaru, gunakan langsung.
        if (hasil && hasil.csrfHash) csrfHash = hasil.csrfHash;

        if (!response.ok || !hasil || hasil.status !== true) {
            if (response.status === 403) {
                throw new Error('Sesi atau token keamanan sudah berubah. Muat ulang halaman lalu coba lagi.');
            }
            throw new Error((hasil && hasil.message) || 'Permintaan gagal (HTTP ' + response.status + ').');
        }
        return hasil;
    }

    // ============================================================
    // AMBIL DATA ASLI DARI DATABASE
    // ============================================================
    async function muatHariLibur() {
        tbody.innerHTML = '<tr><td colspan="6" class="empty-state">Memuat data hari libur...</td></tr>';

        try {
            const hasil = await requestAPI(apiHariLibur);

            dataHariLibur = Array.isArray(hasil.data)
                ? hasil.data.map(item => ({
                    id: Number(item.id),
                    tanggal: String(item.tanggal || '').slice(0, 10),
                    nama: String(item.nama ?? ''),
                    jenis: String(item.jenis ?? ''),
                    keterangan: String(item.keterangan ?? '')
                }))
                : [];

            perbaruiPilihanTahun();
            perbaruiStatistik();

            // Tampilkan seluruh data saat halaman pertama kali dibuka.
            filterDiterapkan = {
                pencarian: '',
                tahun: '',
                jenis: ''
            };

            tampilkanHariLibur();

        } catch (error) {
            tbody.innerHTML = '<tr><td colspan="6" class="empty-state">' +
                escapeHTML(error.message) + '</td></tr>';
            document.getElementById('infoData').textContent = 'Gagal memuat data';
        }
    }

    // ============================================================
    // FILTER TAHUN
    // ============================================================
    function perbaruiPilihanTahun() {
        const select = document.getElementById('filterTahun');
        const tahunDipilih = select.value;

        const tahunData = [...new Set(dataHariLibur
            .map(item => item.tanggal.substring(0, 4))
            .filter(Boolean))].sort();

        select.innerHTML = '<option value="">Semua Tahun</option>';

        tahunData.forEach(function (tahun) {
            const option = document.createElement('option');
            option.value = tahun;
            option.textContent = 'Tahun ' + tahun;
            select.appendChild(option);
        });

        if (tahunData.includes(tahunDipilih)) {
            select.value = tahunDipilih;
        }
    }

    // ============================================================
    // STATISTIK
    // ============================================================
    function perbaruiStatistik() {
        document.getElementById('statTotal').textContent = dataHariLibur.length;

        document.getElementById('statNasional').textContent =
            dataHariLibur.filter(item => item.jenis === 'Nasional').length;

        document.getElementById('statKhusus').textContent =
            dataHariLibur.filter(item => item.jenis === 'Khusus MPP').length;
    }

    // ============================================================
    // TAMPILKAN INSTRUKSI SEBELUM PENCARIAN
    // ============================================================
    function tampilkanInstruksiPencarian() {
        tbody.innerHTML = `<tr>
            <td colspan="6" class="empty-state">
                <i class="bi bi-search"></i>
                Atur filter data, lalu klik tombol Cari Data.
            </td>
        </tr>`;

        document.getElementById('infoData').textContent =
            'Silakan lakukan pencarian data hari libur.';
    }

    // ============================================================
    // TOMBOL CARI DATA
    // ============================================================
    function cariDataHariLibur() {
        filterDiterapkan = {
            pencarian: document.getElementById('searchLibur').value.toLowerCase().trim(),
            tahun: document.getElementById('filterTahun').value,
            jenis: document.getElementById('filterJenis').value
        };

        tampilkanHariLibur();
    }

    // ============================================================
    // RENDER TABEL
    // ============================================================
    function tampilkanHariLibur() {
        if (!filterDiterapkan) {
            tampilkanInstruksiPencarian();
            return;
        }

        const pencarian = filterDiterapkan.pencarian;
        const tahun = filterDiterapkan.tahun;
        const jenis = filterDiterapkan.jenis;

        const hasil = dataHariLibur.filter(function (item) {
            const cocokCari =
                item.nama.toLowerCase().includes(pencarian) ||
                item.keterangan.toLowerCase().includes(pencarian) ||
                item.tanggal.includes(pencarian);

            return cocokCari &&
                (!tahun || item.tanggal.startsWith(tahun)) &&
                (!jenis || item.jenis === jenis);
        }).sort((a, b) => a.tanggal.localeCompare(b.tanggal));

        perbaruiStatistik();

        if (hasil.length === 0) {
            tbody.innerHTML = `<tr><td colspan="6" class="empty-state">
                <i class="bi bi-calendar2-x"></i>
                Tidak ada data hari libur yang sesuai.
                </td></tr>`;
        } else {
            tbody.innerHTML = hasil.map(function (item, index) {
                const badge = item.jenis === 'Nasional'
                    ? 'badge-national'
                    : 'badge-special';

                return `<tr>
                    <td>${index + 1}</td>
                    <td>${escapeHTML(formatTanggal(item.tanggal))}</td>
                    <td class="holiday-name">${escapeHTML(item.nama || '-')}</td>
                    <td>
                        <span class="holiday-badge ${badge}">
                            ${escapeHTML(item.jenis || '-')}
                        </span>
                    </td>
                    <td>${escapeHTML(item.keterangan || '-')}</td>
                    <td>
                        <div class="action-group">
                            <button type="button" class="action-btn edit"
                                title="Edit Hari Libur"
                                aria-label="Edit hari libur"
                                data-action="edit" data-id="${item.id}">
                                <i class="bi bi-pencil"></i>
                            </button>

                            <button type="button" class="action-btn delete"
                                title="Hapus Hari Libur"
                                aria-label="Hapus hari libur"
                                data-action="hapus" data-id="${item.id}">
                                <i class="bi bi-trash3"></i>
                            </button>
                        </div>
                    </td>
                </tr>`;
            }).join('');
        }

        document.getElementById('infoData').textContent =
            'Menampilkan ' + hasil.length + ' dari ' + dataHariLibur.length + ' data hari libur';
    }

    // ============================================================
    // MODAL TAMBAH DAN EDIT
    // ============================================================
    function bukaTambah() {
        form.reset();
        document.getElementById('liburId').value = '';
        kalenderLibur.clear();
        kalenderLibur.set('mode', 'multiple');

        document.getElementById('judulModal').textContent = 'Tambah Hari Libur';
        modal.show();
    }

    function editHariLibur(id) {
        const item = dataHariLibur.find(data => data.id === Number(id));
        if (!item) return;

        form.reset();
        document.getElementById('liburId').value = item.id;
        kalenderLibur.set('mode', 'single');
        kalenderLibur.setDate(item.tanggal, true);
        document.getElementById('namaLibur').value = item.nama;
        document.getElementById('jenisLibur').value = item.jenis;
        document.getElementById('keteranganLibur').value = item.keterangan;
        document.getElementById('judulModal').textContent = 'Edit Hari Libur';
        modal.show();
    }

    // ============================================================
    // SIMPAN DATA KE DATABASE (POST / PUT)
    // ============================================================
    form.addEventListener('submit', async function (event) {
        event.preventDefault();
        if (!form.reportValidity()) return;

        const id = document.getElementById('liburId').value;

        const tanggalTerpilih = kalenderLibur.selectedDates.map(tanggal => {
            const tahun = tanggal.getFullYear();
            const bulan = String(tanggal.getMonth() + 1).padStart(2, '0');
            const hari = String(tanggal.getDate()).padStart(2, '0');

            return `${tahun}-${bulan}-${hari}`;
        });

        const data = {
            tanggal: id ? tanggalTerpilih[0] : tanggalTerpilih,
            nama: document.getElementById('namaLibur').value.trim(),
            jenis: document.getElementById('jenisLibur').value,
            keterangan: document.getElementById('keteranganLibur').value.trim()
        };

        if (!data.tanggal || !data.nama || !data.jenis) {
            alert('Tanggal, nama, dan jenis hari libur wajib diisi.');
            return;
        }

        if (data.keterangan.length > 255) {
            alert('Keterangan maksimal 255 karakter.');
            return;
        }

        const tanggalDuplikat = tanggalTerpilih.filter(tanggal =>
            dataHariLibur.some(item =>
                item.tanggal === tanggal && String(item.id) !== id
            )
        );

        if (tanggalDuplikat.length > 0) {
            alert(
                'Tanggal berikut sudah terdaftar sebagai hari libur:\n' +
                tanggalDuplikat.map(formatTanggal).join(', ')
            );
            return;
        }

        tombolSimpan.disabled = true;

        try {
            const hasil = await requestAPI(
                id ? apiHariLibur + '/' + encodeURIComponent(id) : apiHariLibur,
                id ? 'PUT' : 'POST',
                data
            );

            modal.hide();
            alert(hasil.message || 'Data hari libur berhasil disimpan.');

            // Reload mengambil data dan token CSRF terbaru, aman saat regenerate=true.
            window.location.reload();

        } catch (error) {
            alert(error.message);

        } finally {
            tombolSimpan.disabled = false;
        }
    });

    // ============================================================
    // HAPUS DATA DI DATABASE (DELETE)
    // ============================================================
    async function hapusHariLibur(id) {
        const item = dataHariLibur.find(data => data.id === Number(id));
        if (!item) return;

        if (!confirm('Hapus hari libur "' + item.nama + '"?')) return;

        try {
            const hasil = await requestAPI(
                apiHariLibur + '/' + encodeURIComponent(id),
                'DELETE'
            );

            alert(hasil.message || 'Hari libur berhasil dihapus.');
            window.location.reload();

        } catch (error) {
            alert(error.message);
        }
    }

    // Delegasi klik untuk tombol aksi dalam tabel.
    tbody.addEventListener('click', function (event) {
        const tombol = event.target.closest('button[data-action]');
        if (!tombol) return;

        const id = Number(tombol.dataset.id);

        if (tombol.dataset.action === 'edit') {
            editHariLibur(id);
        }

        if (tombol.dataset.action === 'hapus') {
            hapusHariLibur(id);
        }
    });

    // ============================================================
    // EVENT FILTER DAN INISIALISASI
    // ============================================================

    // Filter hanya dijalankan ketika tombol Cari Data diklik.
    document.getElementById('cariData').addEventListener('click', cariDataHariLibur);

    // Tekan Enter pada kolom pencarian juga menjalankan pencarian.
    document.getElementById('searchLibur').addEventListener('keydown', function (event) {
        if (event.key === 'Enter') {
            event.preventDefault();
            cariDataHariLibur();
        }
    });

    muatHariLibur();
</script>
<?= $this->endSection() ?>