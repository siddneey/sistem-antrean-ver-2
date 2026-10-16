<?= $this->extend('layouts/admin') ?>

<?= $this->section('pageTitle') ?>

<?= $this->endSection() ?>


<?= $this->section('styles') ?>
<style>
    /* Header halaman */
    .layar-page-title {
        margin-bottom: 22px;
    }

    .layar-page-title h1 {
        margin: 0;
        color: var(--navy);
        font-size: 25px;
        font-weight: 700;
    }

    .layar-section-title {
        margin: 0 0 10px;
        color: #69809b;
        font-size: 16px;
        font-weight: 500;
    }

    .layar-content-card {
        margin-bottom: 28px;
        overflow: hidden;
        background: var(--white);
        border: 1px solid var(--border);
        border-radius: 7px;
        box-shadow: 0 5px 18px rgba(16, 35, 63, .05);
    }

    .layar-table {
        margin: 0;
    }

    .layar-table thead th {
        padding: 12px 10px;
        color: #718096;
        background: #f8f9fa;
        border-bottom: 1px solid var(--border);
        font-size: 12px;
        font-weight: 500;
        white-space: nowrap;
    }

    .layar-table tbody td {
        padding: 10px;
        color: #667085;
        border-color: #edf0f3;
        font-size: 13px;
        vertical-align: middle;
    }

    .layar-table tbody tr:hover {
        background: #fafbfc;
    }

    .login-badge {
        display: inline-flex;
        min-width: 50px;
        height: 36px;
        align-items: center;
        justify-content: center;
        padding: 0 12px;
        color: white;
        background: #ef5350;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
    }

    .status-online {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        color: #4b9b63;
        font-size: 12px;
    }

    .status-dot {
        width: 7px;
        height: 7px;
        background: #43a047;
        border-radius: 50%;
    }

    /* Daftar IP */
    .ip-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        margin-bottom: 10px;
    }

    .ip-header .layar-section-title {
        margin-bottom: 0;
    }

    .ip-tools {
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .search-ip {
        width: 220px;
        height: 38px;
        padding: 0 12px;
        border: 1px solid var(--border);
        border-radius: 7px;
        outline: none;
        font-size: 12px;
    }

    .search-ip:focus,
    .ip-input:focus {
        border-color: var(--navy);
        box-shadow: 0 0 0 3px rgba(16, 35, 63, .07);
    }

    .refresh-btn {
        height: 38px;
        padding: 0 12px;
        color: #667085;
        background: white;
        border: 1px solid var(--border);
        border-radius: 7px;
        font-size: 12px;
    }

    .refresh-btn:hover {
        background: #f5f7fa;
    }

    .ip-input-row {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .ip-input {
        width: 100%;
        height: 36px;
        padding: 0 12px;
        border: 1px solid #e1e5ea;
        border-radius: 6px;
        outline: none;
        font-size: 12px;
    }

    .btn-add-ip {
        height: 36px;
        padding: 0 16px;
        color: white;
        background: #62bd6a;
        border: none;
        border-radius: 18px;
        font-size: 12px;
        white-space: nowrap;
    }

    .btn-add-ip:hover {
        background: #51aa5a;
    }

    .btn-delete-ip {
        padding: 5px 11px;
        color: white;
        background: #ef5350;
        border: none;
        border-radius: 16px;
        font-size: 11px;
    }

    .btn-delete-ip:hover {
        background: #d94340;
    }

    .empty-ip {
        display: none;
        padding: 25px;
        color: var(--muted);
        text-align: center;
        font-size: 13px;
    }

    /* Modal khusus halaman ini */
    #modalDetailLayar .modal-content {
        overflow: hidden;
        border: none;
        border-radius: 12px;
    }

    #modalDetailLayar .modal-header {
        color: white;
        background: var(--navy);
        border: none;
    }

    #modalDetailLayar .btn-close {
        filter: invert(1);
    }

    .detail-layar-grid {
        display: grid;
        grid-template-columns: 130px minmax(0, 1fr);
        gap: 12px;
        font-size: 13px;
    }

    .refresh-btn .bi-arrow-clockwise {
        display: inline-block;
    }

    @keyframes layar-spin {
        from { transform: rotate(0deg); }
        to { transform: rotate(360deg); }
    }

    .refresh-btn .spin {
        animation: layar-spin .5s linear;
    }

    @media (max-width: 900px) {
        .ip-header {
            align-items: flex-start;
            flex-direction: column;
        }

        .search-ip {
            width: 200px;
        }
    }

    @media (max-width: 768px) {
        .ip-tools {
            width: 100%;
        }

        .search-ip {
            width: 100%;
            min-width: 0;
        }

        .layar-page-title h1 {
            font-size: 22px;
        }
    }

    @media (max-width: 420px) {
        .ip-tools {
            align-items: stretch;
        }

        .search-ip {
            flex: 1;
        }

        .detail-layar-grid {
            grid-template-columns: 105px minmax(0, 1fr);
        }
    }
</style>
<?= $this->endSection() ?>


<?= $this->section('content') ?>

<?php
/*
|--------------------------------------------------------------------------
| Data contoh layar
|--------------------------------------------------------------------------
| Data ini masih statis. Nantinya bisa diganti dengan data database.
*/
$layar = [
    [
        'id' => 1,
        'nama' => 'Kelompok 1',
        'login' => 'Iya',
        'login_terakhir' => '2026-10-06 08:35:53',
    ],
    [
        'id' => 2,
        'nama' => 'Kelompok 2',
        'login' => 'Iya',
        'login_terakhir' => '2026-10-06 08:36:47',
    ],
];

/*
|--------------------------------------------------------------------------
| Daftar IP contoh
|--------------------------------------------------------------------------
| Perubahan tambah/hapus di halaman ini hanya terjadi di browser.
*/
$ipAkses = [
    '10.10.102.69',
    '127.0.0.1',
    '::1',
    '38.210.87.150',
    '38.210.87.151',
    '10.10.106.174',
    '10.11.3',
    '10.10.106.162',
];
?>

<div class="layar-page-title">
    <h1>Pengaturan Layar</h1>
</div>

<!-- STATUS LAYAR -->
<div class="layar-section-title">Status Layar Display</div>

<div class="layar-content-card">
    <div class="table-responsive">
        <table class="table layar-table">
            <thead>
                <tr>
                    <th style="width: 45px;">No</th>
                    <th style="width: 260px;">Layar</th>
                    <th style="width: 80px;">Login</th>
                    <th>Login Terakhir</th>
                    <th style="width: 120px;">Status</th>
                    <th style="width: 110px;">Aksi</th>
                </tr>
            </thead>

            <tbody>
                <?php foreach ($layar as $index => $item): ?>
                    <tr>
                        <td><?= $index + 1 ?></td>

                        <td><?= esc($item['nama']) ?></td>

                        <td>
                            <span class="login-badge">
                                <?= esc($item['login']) ?>
                            </span>
                        </td>

                        <td><?= esc($item['login_terakhir']) ?></td>

                        <td>
                            <span class="status-online">
                                <span class="status-dot"></span>
                                Aktif
                            </span>
                        </td>

                        <td>
                            <button
                                type="button"
                                class="btn btn-sm btn-outline-secondary"
                                onclick="lihatLayar(<?= esc(json_encode($item['nama']), 'attr') ?>)"
                            >
                                <i class="bi bi-eye"></i>
                                Detail
                            </button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- DAFTAR IP AKSES -->
<div class="ip-header">
    <div class="layar-section-title">Daftar IP Akses</div>

    <div class="ip-tools">
        <input
            type="text"
            id="searchIP"
            class="search-ip"
            placeholder="Cari IP Address..."
            aria-label="Cari IP Address"
        >

        <button
            type="button"
            class="refresh-btn"
            onclick="refreshIP()"
        >
            <i class="bi bi-arrow-clockwise"></i>
            Refresh
        </button>
    </div>
</div>

<div class="layar-content-card">
    <div class="table-responsive">
        <table class="table layar-table">
            <thead>
                <tr>
                    <th>IP Address</th>
                    <th style="width: 150px;">Aksi</th>
                </tr>
            </thead>

            <tbody id="ipBody">
                <!-- Form tambah IP -->
                <tr id="ipAddRow">
                    <td>
                        <div class="ip-input-row">
                            <input
                                type="text"
                                id="ipBaru"
                                class="ip-input"
                                placeholder="Masukkan IP Baru..."
                                aria-label="IP Address baru"
                                maxlength="45"
                            >
                        </div>
                    </td>

                    <td>
                        <button
                            type="button"
                            class="btn-add-ip"
                            onclick="tambahIP()"
                        >
                            <i class="bi bi-plus-lg"></i>
                            Tambah
                        </button>
                    </td>
                </tr>

                <!-- Data IP -->
                <?php foreach ($ipAkses as $ip): ?>
                    <tr
                        class="ip-row"
                        data-ip="<?= esc(strtolower($ip), 'attr') ?>"
                    >
                        <td class="ip-value"><?= esc($ip) ?></td>

                        <td>
                            <button
                                type="button"
                                class="btn-delete-ip"
                                onclick="hapusIP(this)"
                            >
                                Hapus
                            </button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <div class="empty-ip" id="emptyIP">
        <i class="bi bi-search" style="font-size: 24px;"></i>
        <div>IP Address tidak ditemukan.</div>
    </div>
</div>

<!-- MODAL DETAIL LAYAR -->
<div
    class="modal fade"
    id="modalDetailLayar"
    tabindex="-1"
    aria-labelledby="modalDetailLayarLabel"
    aria-hidden="true"
>
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalDetailLayarLabel">
                    <i class="bi bi-display"></i>
                    Detail Layar
                </h5>

                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Tutup"
                ></button>
            </div>

            <div class="modal-body">
                <div class="detail-layar-grid">
                    <strong>Nama Layar</strong>
                    <span id="detailNamaLayar">-</span>

                    <strong>Status</strong>
                    <span style="color: #43a047;">
                        <i class="bi bi-circle-fill"></i>
                        Aktif
                    </span>

                    <strong>Login</strong>
                    <span>Iya</span>

                    <strong>Koneksi</strong>
                    <span>Terhubung</span>
                </div>
            </div>

            <div class="modal-footer">
                <button
                    type="button"
                    class="btn btn-secondary"
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
    // DETAIL LAYAR
    function lihatLayar(nama) {
        document.getElementById('detailNamaLayar').textContent = nama;

        const modalElement = document.getElementById('modalDetailLayar');
        const modal = bootstrap.Modal.getOrCreateInstance(modalElement);

        modal.show();
    }

    // TAMBAH IP
    function tambahIP() {
        const input = document.getElementById('ipBaru');
        const ip = input.value.trim();

        if (ip === '') {
            alert('Masukkan IP Address terlebih dahulu.');
            input.focus();
            return;
        }

        /*
         * Validasi karakter dasar IPv4/IPv6.
         * Ini bukan validasi IP lengkap; server tetap perlu memvalidasi
         * kembali jika fitur ini nantinya dihubungkan ke database.
         */
        const ipPattern = /^[a-zA-Z0-9:.]+$/;

        if (!ipPattern.test(ip)) {
            alert('Format IP Address tidak valid.');
            input.focus();
            return;
        }

        const rows = document.querySelectorAll('#ipBody .ip-row');
        const ipLower = ip.toLowerCase();

        const sudahAda = Array.from(rows).some(function (row) {
            return row.dataset.ip === ipLower;
        });

        if (sudahAda) {
            alert('IP Address tersebut sudah terdaftar.');
            input.focus();
            return;
        }

        // Buat elemen dengan textContent agar input tidak dieksekusi sebagai HTML.
        const row = document.createElement('tr');
        row.className = 'ip-row';
        row.dataset.ip = ipLower;

        const ipCell = document.createElement('td');
        ipCell.className = 'ip-value';
        ipCell.textContent = ip;

        const actionCell = document.createElement('td');
        const deleteButton = document.createElement('button');

        deleteButton.type = 'button';
        deleteButton.className = 'btn-delete-ip';
        deleteButton.textContent = 'Hapus';
        deleteButton.addEventListener('click', function () {
            hapusIP(deleteButton);
        });

        actionCell.appendChild(deleteButton);
        row.appendChild(ipCell);
        row.appendChild(actionCell);

        document.getElementById('ipBody').appendChild(row);

        input.value = '';
        filterIP();

        alert('IP Address berhasil ditambahkan.');
    }

    // HAPUS IP
    function hapusIP(button) {
        const row = button.closest('.ip-row');

        if (!row) {
            return;
        }

        const ip = row.dataset.ip || '';

        if (!confirm('Yakin ingin menghapus IP ' + ip + '?')) {
            return;
        }

        row.remove();
        filterIP();
    }

    // PENCARIAN IP
    const searchIP = document.getElementById('searchIP');

    searchIP.addEventListener('input', filterIP);

    function filterIP() {
        const keyword = searchIP.value.toLowerCase().trim();
        const rows = document.querySelectorAll('#ipBody .ip-row');

        let ditemukan = 0;

        rows.forEach(function (row) {
            const ip = row.dataset.ip || '';
            const cocok = keyword === '' || ip.includes(keyword);

            row.style.display = cocok ? '' : 'none';

            if (cocok) {
                ditemukan++;
            }
        });

        const empty = document.getElementById('emptyIP');
        empty.style.display = ditemukan === 0 ? 'block' : 'none';
    }

    // REFRESH DAFTAR IP
    function refreshIP() {
        const button = document.querySelector('.refresh-btn');
        const icon = button.querySelector('i');

        if (button.disabled) {
            return;
        }

        button.disabled = true;
        icon.classList.add('spin');

        // Simulasi refresh karena data saat ini belum berasal dari server.
        window.setTimeout(function () {
            icon.classList.remove('spin');
            button.disabled = false;

            filterIP();
            alert('Daftar IP berhasil diperbarui.');
        }, 500);
    }

    // Jalankan pencarian awal.
    filterIP();
</script>
<?= $this->endSection() ?>