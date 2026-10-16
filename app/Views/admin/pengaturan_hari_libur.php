<?= $this->extend('layouts/admin') ?>

<?= $this->section('pageTitle') ?>
<div class="page-header">
    <div>
        <div class="page-title">
            <h1>Pengaturan Hari Libur</h1>
        </div>
        <p class="page-description">
            Kelola jadwal hari libur dan penutupan layanan MPP Kota Tangerang.
        </p>
    </div>

    <button class="btn-add" type="button" onclick="bukaTambah()">
        <i class="bi bi-plus-lg"></i>
        Tambah Hari Libur
    </button>
</div>
<?= $this->endSection() ?>


<?= $this->section('styles') ?>
<style>
    .page-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 15px;
        margin-bottom: 23px;
    }

    .page-title h1 {
        margin: 0;
        color: var(--navy);
        font-size: 25px;
        font-weight: 700;
    }

    .page-description {
        margin: 6px 0 0;
        color: var(--muted);
        font-size: 12px;
    }

    .btn-add {
        min-height: 40px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 7px;
        padding: 0 16px;
        border: none;
        border-radius: 8px;
        background: var(--navy);
        color: white;
        font-size: 13px;
        font-weight: 600;
        white-space: nowrap;
        cursor: pointer;
        transition: background .2s ease;
    }

    .btn-add:hover {
        background: var(--navy-light);
        color: white;
    }

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

    .filter-box {
        padding: 16px;
        margin-bottom: 18px;
        background: white;
        border: 1px solid var(--border);
        border-radius: 9px;
    }

    .filter-row {
        display: grid;
        grid-template-columns: 1.5fr 1fr 1fr auto;
        gap: 10px;
    }

    .filter-row .form-control,
    .filter-row .form-select {
        min-height: 40px;
        border-color: var(--border);
        border-radius: 7px;
        font-size: 13px;
    }

    .btn-reset {
        min-height: 40px;
        padding: 0 15px;
        border: 1px solid var(--border);
        border-radius: 7px;
        background: white;
        color: #667085;
        font-size: 13px;
    }

    .btn-reset:hover {
        background: #f8f9fa;
    }

    .table-card {
        overflow: hidden;
        background: white;
        border: 1px solid var(--border);
        border-radius: 9px;
        box-shadow: 0 5px 18px rgba(16, 35, 63, .04);
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

    @media (max-width: 1100px) {
        .filter-row {
            grid-template-columns: 1fr 1fr;
        }
    }

    @media (max-width: 768px) {
        .page-header {
            align-items: flex-start;
            flex-direction: column;
        }

        .page-title h1 {
            font-size: 22px;
        }

        .stats-row {
            grid-template-columns: 1fr;
        }

        .filter-row {
            grid-template-columns: 1fr;
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

<!-- FILTER -->
<div class="filter-box">
    <div class="filter-row">
        <input
            type="search"
            id="searchLibur"
            class="form-control"
            placeholder="Cari nama hari libur atau keterangan..."
        >

        <select id="filterTahun" class="form-select">
            <option value="">Semua Tahun</option>
        </select>

        <select id="filterJenis" class="form-select">
            <option value="">Semua Jenis Libur</option>
            <option value="Nasional">Libur Nasional</option>
            <option value="Khusus MPP">Libur Khusus MPP</option>
        </select>

        <button type="button" class="btn-reset" id="resetFilter">
            <i class="bi bi-arrow-counterclockwise"></i>
            Reset
        </button>
    </div>
</div>

<!-- TABEL -->
<div class="table-card">
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
            <tbody id="hariLiburBody"></tbody>
        </table>
    </div>

    <div class="table-footer">
        <span id="infoData">Menampilkan data hari libur</span>
        <span>
            <i class="bi bi-info-circle me-1"></i>
            Data masih berupa dummy.
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
                            maxlength="500"
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
    // Data dummy sementara, tidak terhubung ke database.
    let dataHariLibur = [
        {
            id: 1,
            tanggal: '2026-01-01',
            nama: 'Tahun Baru Masehi',
            jenis: 'Nasional',
            keterangan: 'Libur nasional'
        },
        {
            id: 2,
            tanggal: '2026-08-17',
            nama: 'Hari Kemerdekaan Republik Indonesia',
            jenis: 'Nasional',
            keterangan: 'Peringatan Hari Kemerdekaan'
        },
        {
            id: 3,
            tanggal: '2026-12-25',
            nama: 'Hari Raya Natal',
            jenis: 'Nasional',
            keterangan: 'Libur nasional'
        },
        {
            id: 4,
            tanggal: '2026-12-31',
            nama: 'Penutupan Layanan Akhir Tahun',
            jenis: 'Khusus MPP',
            keterangan: 'Penyesuaian operasional layanan MPP'
        }
    ];

    let idBerikutnya = 5;

    const modalElement = document.getElementById('modalHariLibur');
    const modal = bootstrap.Modal.getOrCreateInstance(modalElement);
    const form = document.getElementById('formHariLibur');

    // Format tanggal ke format Indonesia.
    function formatTanggal(tanggal) {
        if (!tanggal) return '-';

        const bagian = tanggal.split('-');
        return bagian[2] + '-' + bagian[1] + '-' + bagian[0];
    }

    // Mencegah teks input dibaca sebagai HTML.
    function escapeHTML(teks) {
        return String(teks ?? '').replace(/[&<>"']/g, function (karakter) {
            return {
                '&': '&amp;',
                '<': '&lt;',
                '>': '&gt;',
                '"': '&quot;',
                "'": '&#039;'
            }[karakter];
        });
    }

    // Isi pilihan tahun sesuai data.
    function perbaruiPilihanTahun() {
        const select = document.getElementById('filterTahun');
        const tahunDipilih = select.value;

        const tahunData = [...new Set(
            dataHariLibur.map(item => item.tanggal.substring(0, 4))
        )].sort();

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

    // Render tabel dan statistik.
    function tampilkanHariLibur() {
        const pencarian = document.getElementById('searchLibur')
            .value.toLowerCase().trim();
        const tahun = document.getElementById('filterTahun').value;
        const jenis = document.getElementById('filterJenis').value;

        const hasil = dataHariLibur
            .filter(function (item) {
                const cocokCari =
                    item.nama.toLowerCase().includes(pencarian) ||
                    item.keterangan.toLowerCase().includes(pencarian) ||
                    item.tanggal.includes(pencarian);

                const cocokTahun = !tahun || item.tanggal.startsWith(tahun);
                const cocokJenis = !jenis || item.jenis === jenis;

                return cocokCari && cocokTahun && cocokJenis;
            })
            .sort((a, b) => a.tanggal.localeCompare(b.tanggal));

        // Statistik menghitung semua data, bukan hanya hasil filter.
        document.getElementById('statTotal').textContent =
            dataHariLibur.length;

        document.getElementById('statNasional').textContent =
            dataHariLibur.filter(item => item.jenis === 'Nasional').length;

        document.getElementById('statKhusus').textContent =
            dataHariLibur.filter(item => item.jenis === 'Khusus MPP').length;

        const tbody = document.getElementById('hariLiburBody');

        if (hasil.length === 0) {
            tbody.innerHTML = `
                <tr>
                    <td colspan="6" class="empty-state">
                        <i class="bi bi-calendar2-x"></i>
                        Tidak ada data hari libur yang sesuai.
                    </td>
                </tr>`;
        } else {
            tbody.innerHTML = hasil.map(function (item, index) {
                const badge = item.jenis === 'Nasional'
                    ? 'badge-national'
                    : 'badge-special';

                return `
                    <tr>
                        <td>${index + 1}</td>
                        <td>
                            <i class="bi bi-calendar3 me-1"></i>
                            ${formatTanggal(item.tanggal)}
                        </td>
                        <td class="holiday-name">${escapeHTML(item.nama)}</td>
                        <td>
                            <span class="holiday-badge ${badge}">
                                ${escapeHTML(item.jenis)}
                            </span>
                        </td>
                        <td>${escapeHTML(item.keterangan || '-')}</td>
                        <td>
                            <div class="action-wrapper">
                                <button
                                    type="button"
                                    class="btn-action btn-edit"
                                    title="Edit"
                                    aria-label="Edit hari libur"
                                    onclick="editHariLibur(${item.id})"
                                >
                                    <i class="bi bi-pencil-square"></i>
                                </button>
                                <button
                                    type="button"
                                    class="btn-action btn-delete"
                                    title="Hapus"
                                    aria-label="Hapus hari libur"
                                    onclick="hapusHariLibur(${item.id})"
                                >
                                    <i class="bi bi-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>`;
            }).join('');
        }

        document.getElementById('infoData').textContent =
            'Menampilkan ' + hasil.length + ' dari ' +
            dataHariLibur.length + ' data hari libur';
    }

    // Buka modal tambah.
    function bukaTambah() {
        form.reset();
        document.getElementById('liburId').value = '';
        document.getElementById('judulModal').textContent = 'Tambah Hari Libur';
        modal.show();
    }

    // Buka modal edit.
    function editHariLibur(id) {
        const item = dataHariLibur.find(data => data.id === id);

        if (!item) return;

        document.getElementById('liburId').value = item.id;
        document.getElementById('tanggalLibur').value = item.tanggal;
        document.getElementById('namaLibur').value = item.nama;
        document.getElementById('jenisLibur').value = item.jenis;
        document.getElementById('keteranganLibur').value = item.keterangan;

        document.getElementById('judulModal').textContent = 'Edit Hari Libur';
        modal.show();
    }

    // Simpan data dummy baru atau hasil edit.
    form.addEventListener('submit', function (event) {
        event.preventDefault();

        const id = document.getElementById('liburId').value;
        const tanggal = document.getElementById('tanggalLibur').value;
        const nama = document.getElementById('namaLibur').value.trim();
        const jenis = document.getElementById('jenisLibur').value;
        const keterangan = document.getElementById('keteranganLibur')
            .value.trim();

        if (!tanggal || !nama || !jenis) {
            alert('Tanggal, nama, dan jenis hari libur wajib diisi.');
            return;
        }

        // Cegah tanggal yang sama tercatat dua kali.
        const duplikat = dataHariLibur.some(function (item) {
            return item.tanggal === tanggal && String(item.id) !== id;
        });

        if (duplikat) {
            alert('Tanggal tersebut sudah terdaftar sebagai hari libur.');
            return;
        }

        const itemBaru = {
            id: id ? Number(id) : idBerikutnya++,
            tanggal,
            nama,
            jenis,
            keterangan
        };

        if (id) {
            const index = dataHariLibur.findIndex(
                item => item.id === Number(id)
            );

            if (index !== -1) {
                dataHariLibur[index] = itemBaru;
            }
        } else {
            dataHariLibur.push(itemBaru);
        }

        perbaruiPilihanTahun();
        tampilkanHariLibur();
        modal.hide();

        alert(
            id
                ? 'Data dummy hari libur berhasil diperbarui.'
                : 'Data dummy hari libur berhasil ditambahkan.'
        );
    });

    // Hapus data dummy.
    function hapusHariLibur(id) {
        const item = dataHariLibur.find(data => data.id === id);

        if (!item) return;

        if (!confirm('Hapus hari libur "' + item.nama + '"?')) return;

        dataHariLibur = dataHariLibur.filter(data => data.id !== id);

        perbaruiPilihanTahun();
        tampilkanHariLibur();
    }

    // Filter pencarian.
    document.getElementById('searchLibur')
        .addEventListener('input', tampilkanHariLibur);

    document.getElementById('filterTahun')
        .addEventListener('change', tampilkanHariLibur);

    document.getElementById('filterJenis')
        .addEventListener('change', tampilkanHariLibur);

    // Reset semua filter.
    document.getElementById('resetFilter').addEventListener('click', function () {
        document.getElementById('searchLibur').value = '';
        document.getElementById('filterTahun').value = '';
        document.getElementById('filterJenis').value = '';

        tampilkanHariLibur();
    });

    // Inisialisasi.
    perbaruiPilihanTahun();
    tampilkanHariLibur();
</script>
<?= $this->endSection() ?>