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

    /* TABEL */
    .table-card {
        overflow: hidden;
        background: white;
        border: 1px solid var(--border);
        border-radius: 9px;
        box-shadow: 0 5px 18px rgba(16, 35, 63, .04);
    }

    .pk-table-head {
        padding: 13px 18px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 6px;
        border-bottom: 1px solid var(--border);
    }

    .pk-table-head h2 {
        font-size: 14px;
        font-weight: 700;
        color: var(--navy);
        margin: 0;
    }

    .pk-table-head p {
        font-size: 11.5px;
        color: var(--muted);
        margin: 5px 0 0;
    }

    .table-card .table {
        min-width: 820px;
        margin: 0;
    }

    .table-card .table thead th {
        padding: 14px 12px;
        background: #f8f9fa;
        color: #718096;
        border-bottom: 1px solid var(--border);
        font-size: 12px;
        font-weight: 600;
        text-align: center;
        white-space: nowrap;
    }

    .table-card .table tbody td {
        padding: 13px 12px;
        color: #667085;
        border-color: #edf0f3;
        font-size: 13px;
        vertical-align: middle;
    }

    .table-card .table tbody tr:hover {
        background: #fafbfc;
    }

    .holiday-name {
        color: #536b86 !important;
        font-weight: 600;
    }

    .holiday-badge {
        display: inline-block;
        padding: 6px 11px;
        border-radius: 15px;
        font-size: 11px;
        white-space: nowrap;
    }

    .badge-national {
        background: #fff3d7;
        color: #936b13;
    }

    .badge-special {
        background: #e5f5ec;
        color: #237a56;
    }

    .action-wrapper {
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .btn-action {
        width: 32px;
        height: 32px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border: none;
        border-radius: 7px;
        color: white;
    }

    .btn-edit {
        background: #42a5f5;
    }

    .btn-delete {
        background: #ef5350;
    }

    .btn-action:hover {
        filter: brightness(.94);
    }

    .table-footer {
        display: flex;
        justify-content: space-between;
        gap: 12px;
        padding: 14px 17px;
        color: var(--muted);
        font-size: 12px;
    }

    .empty-state {
        padding: 35px !important;
        text-align: center;
        color: var(--muted) !important;
    }

    .empty-state i {
        display: block;
        margin-bottom: 8px;
        font-size: 26px;
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
        <table class="table">
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
                            type="date"
                            id="tanggalLibur"
                            class="form-control"
                            required
                        >
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
            tampilkanInstruksiPencarian();

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
                    <td><i class="bi bi-calendar3 me-1"></i>${escapeHTML(formatTanggal(item.tanggal))}</td>
                    <td class="holiday-name">${escapeHTML(item.nama || '-')}</td>
                    <td><span class="holiday-badge ${badge}">${escapeHTML(item.jenis || '-')}</span></td>
                    <td>${escapeHTML(item.keterangan || '-')}</td>
                    <td><div class="action-wrapper">
                        <button type="button" class="btn-action btn-edit" title="Edit"
                            aria-label="Edit hari libur" data-action="edit" data-id="${item.id}">
                            <i class="bi bi-pencil-square"></i></button>
                        <button type="button" class="btn-action btn-delete" title="Hapus"
                            aria-label="Hapus hari libur" data-action="hapus" data-id="${item.id}">
                            <i class="bi bi-trash"></i></button>
                    </div></td></tr>`;
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
        document.getElementById('judulModal').textContent = 'Tambah Hari Libur';
        modal.show();
    }

    function editHariLibur(id) {
        const item = dataHariLibur.find(data => data.id === Number(id));
        if (!item) return;

        form.reset();
        document.getElementById('liburId').value = item.id;
        document.getElementById('tanggalLibur').value = item.tanggal;
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

        const data = {
            tanggal: document.getElementById('tanggalLibur').value,
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

        const duplikat = dataHariLibur.some(item =>
            item.tanggal === data.tanggal && String(item.id) !== id
        );

        if (duplikat) {
            alert('Tanggal tersebut sudah terdaftar sebagai hari libur.');
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