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
    /* Tampilan status tidak aktif dan informasi sistem */
    .status-offline { color: #dc6464; font-size: 12px; }
    .status-offline .status-dot { background: #dc6464; }
    .login-badge.is-login { background: #43a047; }
    .layar-notice { margin-bottom: 16px; font-size: 13px; }
    .layar-loading { padding: 18px !important; text-align: center; }
    .btn-add-ip:disabled, .btn-delete-ip:disabled { opacity: .6; cursor: wait; }
</style>
<?= $this->endSection() ?>


<?= $this->section('content') ?>

<!-- ===================================================== -->
<!-- JUDUL HALAMAN                                       -->
<!-- ===================================================== -->
<div class="layar-page-title">
    <h1>Pengaturan Layar</h1>
</div>

<!-- Pesan berhasil atau gagal dari proses API -->
<div id="layarNotice" class="alert layar-notice d-none" role="alert"></div>

<!-- ===================================================== -->
<!-- STATUS LAYAR DISPLAY                                -->
<!-- Data berasal dari GET /admin/layar/status            -->
<!-- ===================================================== -->
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
            <tbody id="layarBody">
                <tr><td colspan="6" class="layar-loading">Memuat status layar...</td></tr>
            </tbody>
        </table>
    </div>
</div>

<!-- ===================================================== -->
<!-- DAFTAR IP AKSES                                     -->
<!-- Data berasal dari GET /admin/layar/ip                -->
<!-- ===================================================== -->
<div class="ip-header">
    <div class="layar-section-title">Daftar IP Akses</div>
    <div class="ip-tools">
        <input type="search" id="searchIP" class="search-ip"
               placeholder="Cari IP Address..." aria-label="Cari IP Address">
        <button type="button" id="refreshIPBtn" class="refresh-btn">
            <i class="bi bi-arrow-clockwise"></i> Refresh
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
                <!-- Form tambah IP: tidak mengubah data sebelum server menyetujui -->
                <tr id="ipAddRow">
                    <td>
                        <form id="formTambahIP" class="ip-input-row">
                            <input type="text" id="ipBaru" name="ip_address"
                                   class="ip-input" placeholder="Masukkan IP Baru..."
                                   aria-label="IP Address baru" maxlength="45" required>
                        </form>
                    </td>
                    <td>
                        <button type="submit" form="formTambahIP" id="tambahIPBtn" class="btn-add-ip">
                            <i class="bi bi-plus-lg"></i> Tambah
                        </button>
                    </td>
                </tr>
                <!-- Baris IP dari database ditambahkan melalui JavaScript -->
            </tbody>
        </table>
    </div>
    <div class="empty-ip" id="emptyIP">
        <i class="bi bi-search" style="font-size: 24px;"></i>
        <div id="emptyIPText">Belum ada IP Address terdaftar.</div>
    </div>
</div>

<!-- ===================================================== -->
<!-- MODAL DETAIL LAYAR                                  -->
<!-- ===================================================== -->
<div class="modal fade" id="modalDetailLayar" tabindex="-1"
     aria-labelledby="modalDetailLayarLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalDetailLayarLabel">
                    <i class="bi bi-display"></i> Detail Layar
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <div class="modal-body">
                <div class="detail-layar-grid">
                    <strong>Nama Layar</strong><span id="detailNamaLayar">-</span>
                    <strong>Login</strong><span id="detailLogin">-</span>
                    <strong>Login Terakhir</strong><span id="detailLoginTerakhir">-</span>
                    <strong>Status</strong><span id="detailStatus">-</span>
                    <strong>Aktivitas Terakhir</strong><span id="detailLastSeen">-</span>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
(() => {
    'use strict';

    // =====================================================
    // KONFIGURASI API DAN ELEMEN HALAMAN
    // =====================================================
    const api = {
        status: <?= json_encode(base_url('admin/layar/status')) ?>,
        ip: <?= json_encode(base_url('admin/layar/ip')) ?>
    };

    // CSRF CodeIgniter 4 (jika filter CSRF diaktifkan).
    const csrfName = <?= json_encode(csrf_token()) ?>;
    let csrfHash = <?= json_encode(csrf_hash()) ?>;

    const layarBody = document.getElementById('layarBody');
    const ipBody = document.getElementById('ipBody');
    const searchInput = document.getElementById('searchIP');
    const ipInput = document.getElementById('ipBaru');
    const tambahButton = document.getElementById('tambahIPBtn');
    const refreshButton = document.getElementById('refreshIPBtn');
    const notice = document.getElementById('layarNotice');

    let daftarIP = [];
    let daftarLayar = [];

    // =====================================================
    // FUNGSI BANTUAN
    // =====================================================
    function pesan(teks, jenis = 'danger') {
        notice.className = `alert alert-${jenis} layar-notice`;
        notice.textContent = teks;
    }

    function tanggal(nilai) {
        if (!nilai) return '-';
        // Format dari MySQL: YYYY-MM-DD HH:mm:ss.
        // Ditampilkan apa adanya agar tidak keliru mengubah zona waktu.
        return String(nilai);
    }

    async function requestJSON(url, options = {}) {
        const response = await fetch(url, {
            credentials: 'same-origin',
            headers: { 'Accept': 'application/json', ...(options.headers || {}) },
            ...options
        });
        const data = await response.json().catch(() => null);
        if (data && typeof data.csrfHash === 'string') csrfHash = data.csrfHash;
        if (data && typeof data.csrf_hash === 'string') csrfHash = data.csrf_hash;

        if (!response.ok || !data || data.status !== true) {
            throw new Error(data?.message || `Permintaan gagal (HTTP ${response.status}).`);
        }
        return data;
    }

    function buatSel(teks) {
        const td = document.createElement('td');
        td.textContent = teks;
        return td;
    }

    // =====================================================
    // STATUS LAYAR DISPLAY
    // =====================================================
    async function muatStatusLayar() {
        try {
            const hasil = await requestJSON(api.status);
            daftarLayar = Array.isArray(hasil.data) ? hasil.data : [];
            layarBody.replaceChildren();

            if (!daftarLayar.length) {
                const tr = document.createElement('tr');
                const td = buatSel('Belum ada kelompok layar.');
                td.colSpan = 6;
                td.className = 'layar-loading';
                tr.appendChild(td);
                layarBody.appendChild(tr);
                return;
            }

            daftarLayar.forEach((layar, index) => {
                const tr = document.createElement('tr');
                tr.appendChild(buatSel(String(index + 1)));
                tr.appendChild(buatSel(layar.nama_kelompok || '-'));

                const loginTd = document.createElement('td');
                const login = document.createElement('span');
                login.className = `login-badge${layar.login ? ' is-login' : ''}`;
                login.textContent = layar.login ? 'Iya' : 'Tidak';
                loginTd.appendChild(login);
                tr.appendChild(loginTd);

                tr.appendChild(buatSel(tanggal(layar.login_terakhir)));

                const statusTd = document.createElement('td');
                const status = document.createElement('span');
                status.className = layar.aktif ? 'status-online' : 'status-online status-offline';
                const dot = document.createElement('span');
                dot.className = 'status-dot';
                status.appendChild(dot);
                status.appendChild(document.createTextNode(layar.aktif ? 'Aktif' : 'Tidak Aktif'));
                statusTd.appendChild(status);
                tr.appendChild(statusTd);

                const aksiTd = document.createElement('td');
                const detail = document.createElement('button');
                detail.type = 'button';
                detail.className = 'btn btn-sm btn-outline-secondary';
                detail.innerHTML = '<i class="bi bi-eye"></i> Detail';
                detail.addEventListener('click', () => lihatLayar(layar));
                aksiTd.appendChild(detail);
                tr.appendChild(aksiTd);
                layarBody.appendChild(tr);
            });
        } catch (error) {
            layarBody.innerHTML = '<tr><td colspan="6" class="layar-loading">Gagal memuat status layar.</td></tr>';
            pesan(error.message);
        }
    }

    function lihatLayar(layar) {
        document.getElementById('detailNamaLayar').textContent = layar.nama_kelompok || '-';
        document.getElementById('detailLogin').textContent = layar.login ? 'Iya' : 'Tidak';
        document.getElementById('detailLoginTerakhir').textContent = tanggal(layar.login_terakhir);
        document.getElementById('detailStatus').textContent = layar.aktif ? 'Aktif' : 'Tidak Aktif';
        document.getElementById('detailLastSeen').textContent = tanggal(layar.last_seen);
        bootstrap.Modal.getOrCreateInstance(document.getElementById('modalDetailLayar')).show();
    }

    // =====================================================
    // DAFTAR IP: TAMPILKAN DAN CARI
    // =====================================================
    function tampilkanIP() {
        ipBody.querySelectorAll('.ip-row').forEach(row => row.remove());
        const keyword = searchInput.value.trim().toLowerCase();
        const cocok = daftarIP.filter(item => String(item.ip_address || '').toLowerCase().includes(keyword));

        cocok.forEach(item => {
            const tr = document.createElement('tr');
            tr.className = 'ip-row';
            tr.appendChild(buatSel(item.ip_address));

            const aksiTd = document.createElement('td');
            const hapus = document.createElement('button');
            hapus.type = 'button';
            hapus.className = 'btn-delete-ip';
            hapus.textContent = 'Hapus';
            hapus.addEventListener('click', () => hapusIP(item, hapus));
            aksiTd.appendChild(hapus);
            tr.appendChild(aksiTd);
            ipBody.appendChild(tr);
        });

        const kosong = document.getElementById('emptyIP');
        kosong.style.display = cocok.length ? 'none' : 'block';
        document.getElementById('emptyIPText').textContent = keyword
            ? 'IP Address tidak ditemukan.'
            : 'Belum ada IP Address terdaftar.';
    }

    async function muatIP() {
        const hasil = await requestJSON(api.ip);
        daftarIP = Array.isArray(hasil.data) ? hasil.data : [];
        tampilkanIP();
    }

    // =====================================================
    // TAMBAH IP (POST FORM DATA KE DATABASE)
    // =====================================================
    async function tambahIP(event) {
        event.preventDefault();
        const ip = ipInput.value.trim();
        if (!ip) {
            pesan('Masukkan IP Address terlebih dahulu.');
            ipInput.focus();
            return;
        }
        tambahButton.disabled = true;
        try {
            const form = new FormData();
            form.append('ip_address', ip);
            form.append(csrfName, csrfHash);
            const hasil = await requestJSON(api.ip, { method: 'POST', body: form });
            ipInput.value = '';
            await muatIP();
            pesan(hasil.message || 'IP Address berhasil ditambahkan.', 'success');
        } catch (error) {
            pesan(error.message);
        } finally {
            tambahButton.disabled = false;
        }
    }

    // =====================================================
    // HAPUS IP (DELETE KE DATABASE)
    // =====================================================
    async function hapusIP(item, button) {
        if (!confirm(`Yakin ingin menghapus IP ${item.ip_address}?`)) return;
        button.disabled = true;
        try {
            const hasil = await requestJSON(`${api.ip}/${encodeURIComponent(item.id)}`, {
                method: 'DELETE',
                headers: { [csrfName]: csrfHash }
            });
            await muatIP();
            pesan(hasil.message || 'IP Address berhasil dihapus.', 'success');
        } catch (error) {
            pesan(error.message);
            button.disabled = false;
        }
    }

    // =====================================================
    // REFRESH STATUS LAYAR DAN DAFTAR IP
    // =====================================================
    async function refreshIP() {
        refreshButton.disabled = true;
        const icon = refreshButton.querySelector('i');
        icon.classList.add('spin');
        try {
            await Promise.all([muatIP(), muatStatusLayar()]);
            pesan('Data layar dan IP berhasil diperbarui.', 'success');
        } catch (error) {
            pesan(error.message);
        } finally {
            refreshButton.disabled = false;
            icon.classList.remove('spin');
        }
    }

    // =====================================================
    // INISIALISASI HALAMAN
    // =====================================================
    searchInput.addEventListener('input', tampilkanIP);
    document.getElementById('formTambahIP').addEventListener('submit', tambahIP);
    refreshButton.addEventListener('click', refreshIP);
    muatStatusLayar();
    muatIP().catch(error => pesan(error.message));
})();
</script>
<?= $this->endSection() ?>
