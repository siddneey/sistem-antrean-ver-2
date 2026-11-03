<?= $this->extend('layouts/admin') ?>

<?= $this->section('pageTitle') ?>
<?= $this->endSection() ?>

<?= $this->section('styles') ?>
<style>
    /* =====================================================
       JUDUL HALAMAN
    ===================================================== */

    .layar-page-title {
        margin-bottom: 24px;
    }

    .layar-page-title h1 {
        margin: 0;
        color: var(--navy);
        font-size: 25px;
        font-weight: 700;
    }

    .layar-page-subtitle {
        margin-top: 5px;
        color: var(--muted);
        font-size: 13px;
        font-weight: 400;
    }

    /* =====================================================
       HEADING SECTION
    ===================================================== */

    .layar-section-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        margin-bottom: 12px;
    }

    .layar-section-title {
        margin: 0;
        color: #69809b;
        font-size: 16px;
        font-weight: 500;
    }

    .layar-section-description {
        margin-top: 5px;
        color: var(--muted);
        font-size: 12px;
    }

    /* =====================================================
       CARD DAN TABEL
    ===================================================== */

    .layar-content-card {
        margin-bottom: 27px;
        overflow: hidden;
        background: var(--white);
        border: 1px solid var(--border);
        border-radius: 7px;
        box-shadow: 0 5px 18px rgba(16, 35, 63, .05);
    }

    .layar-table {
        width: 100%;
        margin: 0;
    }

    .layar-table thead th {
        padding: 13px 14px;
        color: #718096;
        background: #f8f9fa;
        border-bottom: 1px solid var(--border);
        font-size: 12px;
        font-weight: 600;
        text-align: center;
        vertical-align: middle;
        white-space: nowrap;
    }

    .layar-table tbody td {
        padding: 13px 14px;
        color: #667085;
        border-color: #edf0f3;
        font-size: 13px;
        vertical-align: middle;
    }

    .layar-table tbody tr:hover {
        background: #fafbfc;
    }

    .layar-name {
        color: var(--navy);
        font-weight: 600;
    }

    .layar-subtext {
        display: block;
        margin-top: 3px;
        color: #98a2b3;
        font-size: 11px;
    }

    /* =====================================================
       BADGE STATUS
    ===================================================== */

    .layar-badge {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
        min-width: 90px;
        padding: 6px 11px;
        border-radius: 20px;
        font-size: 11px;
        font-weight: 600;
        white-space: nowrap;
    }

    .layar-badge::before {
        width: 6px;
        height: 6px;
        background: currentColor;
        border-radius: 50%;
        content: "";
    }

    .badge-aktif,
    .badge-diizinkan {
        color: #398653;
        background: #eaf7ee;
    }

    .badge-nonaktif,
    .badge-diblokir {
        color: #d34c4c;
        background: #fff0f0;
    }

    /* =====================================================
       TOMBOL AKSI
    ===================================================== */

    .layar-action-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 5px;
        min-height: 31px;
        padding: 5px 11px;
        border: 1px solid transparent;
        border-radius: 6px;
        font-size: 11px;
        font-weight: 500;
        white-space: nowrap;
        transition: .2s ease;
    }

    .btn-detail-layar {
        color: #52647a;
        background: white;
        border-color: var(--border);
    }

    .btn-detail-layar:hover {
        color: var(--navy);
        background: #f5f7fa;
    }

    .btn-nonaktifkan,
    .btn-blokir {
        color: #d34c4c;
        background: white;
        border-color: #f1cccc;
    }

    .btn-nonaktifkan:hover,
    .btn-blokir:hover {
        color: white;
        background: #dc6464;
        border-color: #dc6464;
    }

    .btn-aktifkan,
    .btn-buka-blokir {
        color: #398653;
        background: white;
        border-color: #cce8d4;
    }

    .btn-aktifkan:hover,
    .btn-buka-blokir:hover {
        color: white;
        background: #49a56a;
        border-color: #49a56a;
    }

    /* =====================================================
       FORM TAMBAH IP
    ===================================================== */

    .ip-add-form {
        display: flex;
        align-items: center;
        gap: 9px;
        margin-bottom: 12px;
    }

    .ip-input {
        width: 100%;
        max-width: 350px;
        height: 36px;
        padding: 0 12px;
        border: 1px solid var(--border);
        border-radius: 7px;
        outline: none;
        font-size: 12px;
    }

    .ip-input:focus,
    .search-ip:focus {
        border-color: var(--navy);
        box-shadow: 0 0 0 3px rgba(16, 35, 63, .07);
    }

    .btn-add-ip {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
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

    /* =====================================================
       SEARCH DAN REFRESH
    ===================================================== */

    .ip-tools {
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .search-ip {
        width: 230px;
        height: 36px;
        padding: 0 12px;
        border: 1px solid var(--border);
        border-radius: 7px;
        outline: none;
        font-size: 12px;
    }

    .refresh-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
        height: 36px;
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

    @keyframes layar-spin {
        from { transform: rotate(0deg); }
        to { transform: rotate(360deg); }
    }

    .refresh-btn .spin {
        animation: layar-spin .5s linear;
    }

    /* =====================================================
       EMPTY STATE DAN NOTICE
    ===================================================== */

    .empty-ip {
        display: none;
        padding: 25px;
        color: var(--muted);
        text-align: center;
        font-size: 13px;
    }

    .empty-ip i {
        display: block;
        margin-bottom: 8px;
        color: #aab4c1;
        font-size: 25px;
    }

    .layar-notice {
        margin-bottom: 18px;
        font-size: 13px;
    }

    /* =====================================================
       MODAL DETAIL
    ===================================================== */

    #modalDetailLayar .modal-content,
    #modalDetailIP .modal-content {
        overflow: hidden;
        border: none;
        border-radius: 10px;
    }

    #modalDetailLayar .modal-header,
    #modalDetailIP .modal-header {
        color: white;
        background: var(--navy);
        border: none;
    }

    #modalDetailLayar .btn-close,
    #modalDetailIP .btn-close {
        filter: invert(1);
    }

    .detail-grid {
        display: grid;
        grid-template-columns: 135px minmax(0, 1fr);
        gap: 14px 10px;
        font-size: 13px;
    }

    .detail-grid strong {
        color: #667085;
        font-weight: 600;
    }

    .detail-grid span {
        color: var(--navy);
        overflow-wrap: anywhere;
    }

    /* =====================================================
       RESPONSIVE
    ===================================================== */

    @media (max-width: 900px) {
        .layar-section-header {
            align-items: flex-start;
            flex-direction: column;
        }

        .ip-tools {
            width: 100%;
        }

        .search-ip {
            flex: 1;
            width: 100%;
        }
    }

    @media (max-width: 768px) {
        .layar-page-title h1 {
            font-size: 22px;
        }

        .layar-table thead th,
        .layar-table tbody td {
            padding: 11px 10px;
        }
    }

    @media (max-width: 480px) {
        .ip-add-form {
            align-items: stretch;
            flex-direction: column;
        }

        .ip-input {
            max-width: none;
        }

        .btn-add-ip {
            width: fit-content;
        }

        .detail-grid {
            grid-template-columns: 110px minmax(0, 1fr);
        }
    }
</style>
<?= $this->endSection() ?>


<?= $this->section('content') ?>

<!-- =====================================================
     JUDUL HALAMAN
===================================================== -->

<div class="layar-page-title">
    <h1>Pengaturan Layar</h1>
    <div class="layar-page-subtitle">
        Kelola status perangkat display dan akses IP yang terhubung ke sistem.
    </div>
</div>

<div id="layarNotice" class="alert layar-notice d-none" role="alert"></div>

<!-- =====================================================
     STATUS LAYAR DISPLAY
===================================================== -->

<div class="layar-section-header">
    <div>
        <div class="layar-section-title">Status Layar Display</div>
        <div class="layar-section-description">
            Pantau aktivitas dan status perangkat display yang terhubung.
        </div>
    </div>
</div>

<div class="layar-content-card">
    <div class="table-responsive">
        <table class="table layar-table">
            <thead>
                <tr>
                    <th style="width: 55px;">No</th>
                    <th>Nama Layar</th>
                    <th style="width: 190px;">Login Terakhir</th>
                    <th style="width: 140px;">Status Login</th>
                    <th style="width: 190px;">Aksi</th>
                </tr>
            </thead>

            <tbody id="layarBody">
                <tr>
                    <td colspan="5" class="text-center py-4">
                        <span class="text-muted">Belum ada data layar.</span>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<!-- =====================================================
     DAFTAR IP AKSES
===================================================== -->

<div class="layar-section-header">
    <div>
        <div class="layar-section-title">Daftar IP Akses</div>
        <div class="layar-section-description">
            Lihat perangkat yang mengakses sistem dan kelola akses berdasarkan alamat IP.
        </div>
    </div>

    <div class="ip-tools">
        <input
            type="search"
            id="searchIP"
            class="search-ip"
            placeholder="Cari IP, akun, atau perangkat..."
            aria-label="Cari IP, akun, atau perangkat"
        >

        <button type="button" id="refreshIPBtn" class="refresh-btn">
            <i class="bi bi-arrow-clockwise"></i>
            Refresh
        </button>
    </div>
</div>

<div class="layar-content-card">

    <!-- FORM TAMBAH IP DI ATAS TABEL -->
    <form id="formTambahIP" class="ip-add-form" style="padding: 14px 14px 0;">
        <input
            type="text"
            id="ipBaru"
            name="ip_address"
            class="ip-input"
            placeholder="Masukkan IP Address baru..."
            aria-label="IP Address baru"
            maxlength="45"
            required
        >

        <button type="submit" id="tambahIPBtn" class="btn-add-ip">
            <i class="bi bi-plus-lg"></i>
            Tambah IP
        </button>
    </form>

    <div class="table-responsive">
        <table class="table layar-table">
            <thead>
                <tr>
                    <th style="width: 55px;">No</th>
                    <th>IP Address</th>
                    <th>Perangkat / Akun</th>
                    <th style="width: 125px;">Role</th>
                    <th style="width: 135px;">Status Akses</th>
                    <th style="width: 155px;">Aksi</th>
                </tr>
            </thead>

            <tbody id="ipBody"></tbody>
        </table>
    </div>

    <div class="empty-ip" id="emptyIP">
        <i class="bi bi-search"></i>
        <div id="emptyIPText">Belum ada IP Address terdaftar.</div>
    </div>
</div>

<!-- =====================================================
     MODAL DETAIL DISPLAY
===================================================== -->

<div class="modal fade" id="modalDetailLayar" tabindex="-1"
     aria-labelledby="modalDetailLayarLabel" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="modalDetailLayarLabel">
                    <i class="bi bi-display"></i>
                    Detail Layar Display
                </h5>

                <button type="button" class="btn-close"
                        data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>

            <div class="modal-body">
                <div class="detail-grid">
                    <strong>Nama Layar</strong>
                    <span id="detailNamaLayar">-</span>

                    <strong>Login Terakhir</strong>
                    <span id="detailLoginTerakhir">-</span>

                    <strong>IP Address</strong>
                    <span id="detailIPLayar">-</span>

                    <strong>Status Login</strong>
                    <span id="detailStatus">-</span>

                    <strong>Aktivitas Terakhir</strong>
                    <span id="detailLastSeen">-</span>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary"
                        data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<!-- =====================================================
     MODAL DETAIL IP
===================================================== -->

<div class="modal fade" id="modalDetailIP" tabindex="-1"
     aria-labelledby="modalDetailIPLabel" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="modalDetailIPLabel">
                    <i class="bi bi-globe"></i>
                    Detail IP Address
                </h5>

                <button type="button" class="btn-close"
                        data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>

            <div class="modal-body">
                <div class="detail-grid">
                    <strong>IP Address</strong>
                    <span id="detailAlamatIP">-</span>

                    <strong>Perangkat</strong>
                    <span id="detailPerangkatIP">-</span>

                    <strong>Nama Akun</strong>
                    <span id="detailAkunIP">-</span>

                    <strong>Role</strong>
                    <span id="detailRoleIP">-</span>

                    <strong>Status Akses</strong>
                    <span id="detailStatusIP">-</span>

                    <strong>Aktivitas Terakhir</strong>
                    <span id="detailAktivitasIP">-</span>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary"
                        data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>


<?= $this->section('scripts') ?>
<script>
(() => {
    'use strict';

    /*
    |--------------------------------------------------------------------------
    | DATA DEMO FRONTEND
    |--------------------------------------------------------------------------
    | Data sementara untuk preview tampilan.
    | Belum tersimpan ke database.
    */

    let daftarLayar = [
        {
            id: 1,
            nama_kelompok: 'Display Utama',
            login_terakhir: '2026-11-02 08:30:00',
            aktif: true,
            ip_address: '192.168.1.10',
            last_seen: '2026-11-02 14:20:00'
        },
        {
            id: 2,
            nama_kelompok: 'Display Kelompok A',
            login_terakhir: '2026-11-02 09:00:00',
            aktif: true,
            ip_address: '192.168.1.11',
            last_seen: '2026-11-02 14:15:00'
        },
        {
            id: 3,
            nama_kelompok: 'Display Kelompok B',
            login_terakhir: '2026-11-01 16:30:00',
            aktif: false,
            ip_address: '192.168.1.12',
            last_seen: '2026-11-01 16:30:00'
        }
    ];

    let daftarIP = [
        {
            id: 1,
            ip_address: '192.168.1.10',
            perangkat: 'Komputer Display Utama',
            akun: 'display_utama',
            role: 'Display',
            aktif: true,
            aktivitas: 'Login Berhasil'
        },
        {
            id: 2,
            ip_address: '192.168.1.11',
            perangkat: 'Komputer Display Kelompok A',
            akun: 'display_kelompok_a',
            role: 'Display',
            aktif: true,
            aktivitas: 'Login Berhasil'
        },
        {
            id: 3,
            ip_address: '192.168.1.20',
            perangkat: 'Laptop Admin',
            akun: 'admin',
            role: 'Admin',
            aktif: true,
            aktivitas: 'Login Berhasil'
        },
        {
            id: 4,
            ip_address: '192.168.1.30',
            perangkat: 'Komputer Petugas',
            akun: 'petugas_bapenda',
            role: 'Petugas',
            aktif: false,
            aktivitas: 'Login Gagal'
        }
    ];

    const layarBody = document.getElementById('layarBody');
    const ipBody = document.getElementById('ipBody');
    const searchInput = document.getElementById('searchIP');
    const ipInput = document.getElementById('ipBaru');
    const notice = document.getElementById('layarNotice');

    /*
    |--------------------------------------------------------------------------
    | FUNGSI UMUM
    |--------------------------------------------------------------------------
    */

    function tampilkanPesan(teks, jenis = 'success') {
        notice.className = `alert alert-${jenis} layar-notice`;
        notice.textContent = teks;

        window.clearTimeout(tampilkanPesan.timer);

        tampilkanPesan.timer = window.setTimeout(() => {
            notice.classList.add('d-none');
        }, 3500);
    }

    function buatSel(teks) {
        const td = document.createElement('td');
        td.textContent = teks ?? '-';
        return td;
    }

    function buatBadge(teks, className) {
        const badge = document.createElement('span');
        badge.className = `layar-badge ${className}`;
        badge.textContent = teks;
        return badge;
    }

    /*
    |--------------------------------------------------------------------------
    | TABEL STATUS LAYAR DISPLAY
    |--------------------------------------------------------------------------
    */

    function tampilkanLayar() {
        layarBody.replaceChildren();

        if (!daftarLayar.length) {
            const tr = document.createElement('tr');
            const td = buatSel('Belum ada data layar.');
            td.colSpan = 5;
            td.className = 'text-center py-4';
            tr.appendChild(td);
            layarBody.appendChild(tr);
            return;
        }

        daftarLayar.forEach((layar, index) => {
            const tr = document.createElement('tr');

            tr.appendChild(buatSel(index + 1));

            const namaTd = document.createElement('td');
            const nama = document.createElement('span');
            nama.className = 'layar-name';
            nama.textContent = layar.nama_kelompok;
            namaTd.appendChild(nama);
            tr.appendChild(namaTd);

            tr.appendChild(buatSel(layar.login_terakhir || '-'));

            const statusTd = document.createElement('td');
            statusTd.appendChild(
                buatBadge(
                    layar.aktif ? 'Aktif' : 'Tidak Aktif',
                    layar.aktif ? 'badge-aktif' : 'badge-nonaktif'
                )
            );
            tr.appendChild(statusTd);

            const aksiTd = document.createElement('td');

            const tombolStatus = document.createElement('button');
            tombolStatus.type = 'button';
            tombolStatus.className =
                `layar-action-btn ${layar.aktif ? 'btn-nonaktifkan' : 'btn-aktifkan'}`;

            tombolStatus.innerHTML = layar.aktif
                ? '<i class="bi bi-power"></i> Nonaktifkan'
                : '<i class="bi bi-check-circle"></i> Aktifkan';

            tombolStatus.addEventListener('click', () => {
                ubahStatusLayar(layar.id);
            });

            const tombolDetail = document.createElement('button');
            tombolDetail.type = 'button';
            tombolDetail.className = 'layar-action-btn btn-detail-layar';
            tombolDetail.innerHTML = '<i class="bi bi-eye"></i>';
            tombolDetail.title = 'Lihat detail';

            tombolDetail.addEventListener('click', () => {
                lihatDetailLayar(layar);
            });

            aksiTd.append(tombolStatus, tombolDetail);
            tr.appendChild(aksiTd);

            layarBody.appendChild(tr);
        });
    }

    function ubahStatusLayar(id) {
        const layar = daftarLayar.find(item => item.id === id);

        if (!layar) return;

        const statusBaru = !layar.aktif;
        const tindakan = statusBaru ? 'mengaktifkan' : 'menonaktifkan';

        const yakin = confirm(
            `Yakin ingin ${tindakan} ${layar.nama_kelompok}?`
        );

        if (!yakin) return;

        layar.aktif = statusBaru;

        tampilkanLayar();

        tampilkanPesan(
            `Status ${layar.nama_kelompok} berhasil diubah (simulasi frontend).`,
            'success'
        );
    }

    function lihatDetailLayar(layar) {
        document.getElementById('detailNamaLayar').textContent =
            layar.nama_kelompok || '-';

        document.getElementById('detailLoginTerakhir').textContent =
            layar.login_terakhir || '-';

        document.getElementById('detailIPLayar').textContent =
            layar.ip_address || '-';

        document.getElementById('detailStatus').textContent =
            layar.aktif ? 'Aktif' : 'Tidak Aktif';

        document.getElementById('detailLastSeen').textContent =
            layar.last_seen || '-';

        bootstrap.Modal
            .getOrCreateInstance(document.getElementById('modalDetailLayar'))
            .show();
    }

    /*
    |--------------------------------------------------------------------------
    | TABEL DAFTAR IP
    |--------------------------------------------------------------------------
    */

    function tampilkanIP() {
        ipBody.replaceChildren();

        const keyword = searchInput.value.trim().toLowerCase();

        const hasilFilter = daftarIP.filter(item => {
            return [
                item.ip_address,
                item.perangkat,
                item.akun,
                item.role
            ].some(nilai =>
                String(nilai || '').toLowerCase().includes(keyword)
            );
        });

        hasilFilter.forEach((item, index) => {
            const tr = document.createElement('tr');

            tr.appendChild(buatSel(index + 1));

            const ipTd = document.createElement('td');
            const ipText = document.createElement('span');
            ipText.className = 'layar-name';
            ipText.textContent = item.ip_address;
            ipTd.appendChild(ipText);
            tr.appendChild(ipTd);

            const perangkatTd = document.createElement('td');

            const perangkat = document.createElement('span');
            perangkat.className = 'layar-name';
            perangkat.textContent = item.perangkat || '-';

            const akun = document.createElement('span');
            akun.className = 'layar-subtext';
            akun.textContent = item.akun || '-';

            perangkatTd.append(perangkat, akun);
            tr.appendChild(perangkatTd);

            tr.appendChild(buatSel(item.role || '-'));

            const statusTd = document.createElement('td');
            statusTd.appendChild(
                buatBadge(
                    item.aktif ? 'Diizinkan' : 'Diblokir',
                    item.aktif ? 'badge-diizinkan' : 'badge-diblokir'
                )
            );
            tr.appendChild(statusTd);

            const aksiTd = document.createElement('td');

            const tombol = document.createElement('button');
            tombol.type = 'button';
            tombol.className =
                `layar-action-btn ${item.aktif ? 'btn-blokir' : 'btn-buka-blokir'}`;

            tombol.innerHTML = item.aktif
                ? '<i class="bi bi-slash-circle"></i> Blokir'
                : '<i class="bi bi-unlock"></i> Buka Blokir';

            tombol.addEventListener('click', () => {
                ubahStatusIP(item.id);
            });

            const detail = document.createElement('button');
            detail.type = 'button';
            detail.className = 'layar-action-btn btn-detail-layar';
            detail.innerHTML = '<i class="bi bi-eye"></i>';
            detail.title = 'Detail IP';

            detail.addEventListener('click', () => {
                lihatDetailIP(item);
            });

            aksiTd.append(tombol, detail);
            tr.appendChild(aksiTd);

            ipBody.appendChild(tr);
        });

        const kosong = document.getElementById('emptyIP');

        kosong.style.display = hasilFilter.length ? 'none' : 'block';

        document.getElementById('emptyIPText').textContent =
            keyword
                ? 'IP atau perangkat tidak ditemukan.'
                : 'Belum ada IP Address terdaftar.';
    }

    function ubahStatusIP(id) {
        const item = daftarIP.find(data => data.id === id);

        if (!item) return;

        const statusBaru = !item.aktif;
        const tindakan = statusBaru ? 'membuka blokir' : 'memblokir';

        const yakin = confirm(
            `Yakin ingin ${tindakan} IP ${item.ip_address}?`
        );

        if (!yakin) return;

        item.aktif = statusBaru;

        tampilkanIP();

        tampilkanPesan(
            `Status IP ${item.ip_address} berhasil diubah (simulasi frontend).`,
            'success'
        );
    }

    function lihatDetailIP(item) {
        document.getElementById('detailAlamatIP').textContent =
            item.ip_address || '-';

        document.getElementById('detailPerangkatIP').textContent =
            item.perangkat || '-';

        document.getElementById('detailAkunIP').textContent =
            item.akun || '-';

        document.getElementById('detailRoleIP').textContent =
            item.role || '-';

        document.getElementById('detailStatusIP').textContent =
            item.aktif ? 'Diizinkan' : 'Diblokir';

        document.getElementById('detailAktivitasIP').textContent =
            item.aktivitas || '-';

        bootstrap.Modal
            .getOrCreateInstance(document.getElementById('modalDetailIP'))
            .show();
    }

    /*
    |--------------------------------------------------------------------------
    | TAMBAH IP - SIMULASI FRONTEND
    |--------------------------------------------------------------------------
    */

    document.getElementById('formTambahIP').addEventListener('submit', event => {
        event.preventDefault();

        const ip = ipInput.value.trim();

        if (!ip) {
            tampilkanPesan('Masukkan IP Address terlebih dahulu.', 'danger');
            ipInput.focus();
            return;
        }

        const polaIP =
            /^(?:(?:25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)\.){3}(?:25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)$|^[0-9a-fA-F:]{2,45}$/;

        if (!polaIP.test(ip)) {
            tampilkanPesan('Format IP Address tidak valid.', 'danger');
            ipInput.focus();
            return;
        }

        const sudahAda = daftarIP.some(
            item => item.ip_address.toLowerCase() === ip.toLowerCase()
        );

        if (sudahAda) {
            tampilkanPesan('IP Address sudah terdaftar.', 'danger');
            return;
        }

        daftarIP.push({
            id: Date.now(),
            ip_address: ip,
            perangkat: 'Perangkat Baru',
            akun: '-',
            role: 'Belum Diketahui',
            aktif: true,
            aktivitas: 'Belum ada aktivitas'
        });

        ipInput.value = '';
        tampilkanIP();

        tampilkanPesan(
            'IP Address berhasil ditambahkan ke tampilan demo.',
            'success'
        );
    });

    /*
    |--------------------------------------------------------------------------
    | SEARCH DAN REFRESH
    |--------------------------------------------------------------------------
    */

    searchInput.addEventListener('input', tampilkanIP);

    document.getElementById('refreshIPBtn').addEventListener('click', function () {
        const icon = this.querySelector('i');

        icon.classList.add('spin');

        tampilkanLayar();
        tampilkanIP();

        window.setTimeout(() => {
            icon.classList.remove('spin');

            tampilkanPesan(
                'Tampilan berhasil diperbarui.',
                'success'
            );
        }, 300);
    });

    /*
    |--------------------------------------------------------------------------
    | INISIALISASI
    |--------------------------------------------------------------------------
    */

    tampilkanLayar();
    tampilkanIP();

})();
</script>
<?= $this->endSection() ?>