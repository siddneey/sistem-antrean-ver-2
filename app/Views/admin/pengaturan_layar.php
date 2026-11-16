<?= $this->extend('layouts/admin') ?>

<?= $this->section('pageTitle') ?>
<?= $this->endSection() ?>

<?= $this->section('styles') ?>
<style>
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
    }

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

    .badge-aktif {
        color: #398653;
        background: #eaf7ee;
    }

    .badge-nonaktif {
        color: #d34c4c;
        background: #fff0f0;
    }

    .layar-action-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 5px;
        min-height: 31px;
        padding: 5px 11px;
        border: 1px solid var(--border);
        border-radius: 6px;
        color: #52647a;
        background: white;
        font-size: 11px;
        font-weight: 500;
        white-space: nowrap;
        transition: .2s ease;
    }

    .layar-action-btn:hover {
        color: var(--navy);
        background: #f5f7fa;
    }

    .btn-hapus-ip {
        color: #d34c4c;
        border-color: #f1cccc;
    }

    .btn-hapus-ip:hover {
        color: white;
        background: #dc6464;
        border-color: #dc6464;
    }

    .ip-add-form {
        display: flex;
        align-items: center;
        gap: 9px;
        margin-bottom: 12px;
        padding: 14px 14px 0;
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

    .btn-add-ip:disabled {
        opacity: .6;
        cursor: not-allowed;
    }

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

<div class="layar-page-title">
    <h1>Pengaturan Layar</h1>
    <div class="layar-page-subtitle">
        Kelola status perangkat display dan daftar IP yang terdaftar pada sistem.
    </div>
</div>

<div id="layarNotice" class="alert d-none layar-notice" role="alert"></div>

<!-- STATUS LAYAR DISPLAY -->

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
                    <th style="width: 110px;">Aksi</th>
                </tr>
            </thead>
            <tbody id="layarBody">
                <tr>
                    <td colspan="5" class="text-center py-4">
                        Memuat data layar...
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>


<!-- DAFTAR IP AKSES -->

<div class="layar-section-header">
    <div>
        <div class="layar-section-title">Daftar IP Akses</div>
        <div class="layar-section-description">
            Kelola daftar alamat IP yang tersimpan pada sistem.
        </div>
    </div>

    <div class="ip-tools">
        <input
            type="search"
            id="searchIP"
            class="search-ip"
            placeholder="Cari IP Address..."
            aria-label="Cari IP Address"
        >

        <button type="button" id="refreshIPBtn" class="refresh-btn">
            <i class="bi bi-arrow-clockwise"></i>
            Refresh
        </button>
    </div>
</div>

<div class="layar-content-card">

    <form id="formTambahIP" class="ip-add-form">
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
                    <th style="width: 150px;">Aksi</th>
                </tr>
            </thead>
            <tbody id="ipBody">
                <tr>
                    <td colspan="3" class="text-center py-4">
                        Memuat daftar IP...
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="empty-ip" id="emptyIP">
        <i class="bi bi-search"></i>
        <div id="emptyIPText">Belum ada IP Address terdaftar.</div>
    </div>
</div>


<!-- MODAL DETAIL DISPLAY -->

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

                    <strong>Status Login</strong>
                    <span id="detailStatus">-</span>

                    <strong>Status Audio</strong>
                    <span id="detailAudio">-</span>

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


<!-- MODAL DETAIL IP -->

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
                    <strong>ID</strong>
                    <span id="detailIdIP">-</span>

                    <strong>IP Address</strong>
                    <span id="detailAlamatIP">-</span>
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
    | URL API
    |--------------------------------------------------------------------------
    | Sesuaikan URL ini jika route di Routes.php berbeda.
    */

    const URL_STATUS_LAYAR = "<?= site_url('admin/layar/status') ?>";
    const URL_DAFTAR_IP = "<?= site_url('admin/layar/ip') ?>";

    /*
    |--------------------------------------------------------------------------
    | ELEMEN HALAMAN
    |--------------------------------------------------------------------------
    */

    const layarBody = document.getElementById('layarBody');
    const ipBody = document.getElementById('ipBody');
    const searchInput = document.getElementById('searchIP');
    const ipInput = document.getElementById('ipBaru');
    const formIP = document.getElementById('formTambahIP');
    const tambahIPBtn = document.getElementById('tambahIPBtn');
    const notice = document.getElementById('layarNotice');
    const emptyIP = document.getElementById('emptyIP');

    let daftarLayar = [];
    let daftarIP = [];
    let sedangMemuat = false;

    /*
    |--------------------------------------------------------------------------
    | FUNGSI UMUM
    |--------------------------------------------------------------------------
    */

    function tampilkanPesan(teks, jenis = 'success') {
        notice.className = `alert alert-${jenis} layar-notice`;
        notice.textContent = teks;

        clearTimeout(tampilkanPesan.timer);

        tampilkanPesan.timer = setTimeout(() => {
            notice.classList.add('d-none');
        }, 4000);
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

    function formatTanggal(value) {
        if (!value) return '-';

        const tanggal = new Date(
            String(value).replace(' ', 'T')
        );

        if (Number.isNaN(tanggal.getTime())) {
            return value;
        }

        return tanggal.toLocaleString('id-ID', {
            day: '2-digit',
            month: 'short',
            year: 'numeric',
            hour: '2-digit',
            minute: '2-digit',
            second: '2-digit'
        });
    }

    async function requestAPI(url, options = {}) {
        const response = await fetch(url, {
            credentials: 'same-origin',
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                ...(options.headers || {})
            },
            ...options
        });

        let hasil;

        try {
            hasil = await response.json();
        } catch {
            throw new Error('Respons server bukan JSON yang valid.');
        }

        if (!response.ok || hasil.status === false) {
            throw new Error(
                hasil.message || `Request gagal (${response.status}).`
            );
        }

        return hasil;
    }

    /*
    |--------------------------------------------------------------------------
    | AMBIL STATUS LAYAR
    |--------------------------------------------------------------------------
    */

    async function ambilStatusLayar() {
        try {
            const hasil = await requestAPI(URL_STATUS_LAYAR);

            daftarLayar = Array.isArray(hasil.data)
                ? hasil.data
                : [];

            tampilkanLayar();

        } catch (error) {
            layarBody.replaceChildren();

            const tr = document.createElement('tr');
            const td = buatSel(error.message);
            td.colSpan = 5;
            td.className = 'text-center text-danger py-4';

            tr.appendChild(td);
            layarBody.appendChild(tr);
        }
    }

    /*
    |--------------------------------------------------------------------------
    | TAMPILKAN STATUS LAYAR
    |--------------------------------------------------------------------------
    */

    function tampilkanLayar() {
        layarBody.replaceChildren();

        if (daftarLayar.length === 0) {
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
            nama.textContent = layar.nama_kelompok || '-';

            namaTd.appendChild(nama);
            tr.appendChild(namaTd);

            tr.appendChild(
                buatSel(formatTanggal(layar.login_terakhir))
            );

            const statusTd = document.createElement('td');

            let teksStatus = 'Tidak Aktif';
            let kelasStatus = 'badge-nonaktif';

            if (layar.status === 'SIAP') {
                teksStatus = 'Siap';
                kelasStatus = 'badge-aktif';
            } else if (layar.status === 'BELUM_SIAP') {
                teksStatus = 'Belum Siap';
                kelasStatus = 'badge-nonaktif';
            } else if (layar.aktif) {
                teksStatus = 'Aktif';
                kelasStatus = 'badge-aktif';
            }

            statusTd.appendChild(
                buatBadge(teksStatus, kelasStatus)
            );

            tr.appendChild(statusTd);

            const aksiTd = document.createElement('td');

            const tombolDetail = document.createElement('button');

            tombolDetail.type = 'button';
            tombolDetail.className = 'layar-action-btn';
            tombolDetail.innerHTML =
                '<i class="bi bi-eye"></i> Detail';

            tombolDetail.addEventListener('click', () => {
                lihatDetailLayar(layar);
            });

            aksiTd.appendChild(tombolDetail);
            tr.appendChild(aksiTd);

            layarBody.appendChild(tr);
        });
    }

    /*
    |--------------------------------------------------------------------------
    | DETAIL LAYAR
    |--------------------------------------------------------------------------
    */

    function lihatDetailLayar(layar) {
        document.getElementById('detailNamaLayar').textContent =
            layar.nama_kelompok || '-';

        document.getElementById('detailLoginTerakhir').textContent =
            formatTanggal(layar.login_terakhir);

        document.getElementById('detailStatus').textContent =
            layar.aktif ? 'Aktif' : 'Tidak Aktif';

        document.getElementById('detailAudio').textContent =
            layar.audio_ready ? 'Siap' : 'Belum Siap';

        document.getElementById('detailLastSeen').textContent =
            formatTanggal(layar.last_seen);

        bootstrap.Modal
            .getOrCreateInstance(
                document.getElementById('modalDetailLayar')
            )
            .show();
    }

    /*
    |--------------------------------------------------------------------------
    | AMBIL DAFTAR IP
    |--------------------------------------------------------------------------
    */

    async function ambilDaftarIP() {
        try {
            const hasil = await requestAPI(URL_DAFTAR_IP);

            daftarIP = Array.isArray(hasil.data)
                ? hasil.data
                : [];

            tampilkanIP();

        } catch (error) {
            ipBody.replaceChildren();

            const tr = document.createElement('tr');
            const td = buatSel(error.message);

            td.colSpan = 3;
            td.className = 'text-center text-danger py-4';

            tr.appendChild(td);
            ipBody.appendChild(tr);

            emptyIP.style.display = 'none';
        }
    }

    /*
    |--------------------------------------------------------------------------
    | TAMPILKAN DAFTAR IP
    |--------------------------------------------------------------------------
    */

    function tampilkanIP() {
        ipBody.replaceChildren();

        const keyword = searchInput.value.trim().toLowerCase();

        const hasilFilter = daftarIP.filter(item => {
            return String(item.ip_address || '')
                .toLowerCase()
                .includes(keyword);
        });

        hasilFilter.forEach((item, index) => {
            const tr = document.createElement('tr');

            tr.appendChild(buatSel(index + 1));

            const ipTd = document.createElement('td');
            const ipText = document.createElement('span');

            ipText.className = 'layar-name';
            ipText.textContent = item.ip_address || '-';

            ipTd.appendChild(ipText);
            tr.appendChild(ipTd);

            const aksiTd = document.createElement('td');

            const tombolDetail = document.createElement('button');

            tombolDetail.type = 'button';
            tombolDetail.className = 'layar-action-btn';
            tombolDetail.innerHTML =
                '<i class="bi bi-eye"></i> Detail';

            tombolDetail.addEventListener('click', () => {
                lihatDetailIP(item);
            });

            const tombolHapus = document.createElement('button');

            tombolHapus.type = 'button';
            tombolHapus.className =
                'layar-action-btn btn-hapus-ip';

            tombolHapus.innerHTML =
                '<i class="bi bi-trash"></i> Hapus';

            tombolHapus.addEventListener('click', () => {
                hapusIP(item.id, item.ip_address);
            });

            aksiTd.append(tombolDetail, tombolHapus);
            tr.appendChild(aksiTd);

            ipBody.appendChild(tr);
        });

        emptyIP.style.display =
            hasilFilter.length === 0 ? 'block' : 'none';

        document.getElementById('emptyIPText').textContent =
            keyword
                ? 'IP Address tidak ditemukan.'
                : 'Belum ada IP Address terdaftar.';
    }

    /*
    |--------------------------------------------------------------------------
    | TAMBAH IP
    |--------------------------------------------------------------------------
    */

    formIP.addEventListener('submit', async function(event) {
        event.preventDefault();

        const ipAddress = ipInput.value.trim();

        if (!ipAddress) {
            tampilkanPesan('IP Address wajib diisi.', 'warning');
            return;
        }

        tambahIPBtn.disabled = true;
        tambahIPBtn.innerHTML =
            '<span class="spinner-border spinner-border-sm"></span> Menyimpan...';

        try {
            const formData = new FormData();
            formData.append('ip_address', ipAddress);

            const hasil = await requestAPI(URL_DAFTAR_IP, {
                method: 'POST',
                body: formData
            });

            ipInput.value = '';

            tampilkanPesan(
                hasil.message || 'IP Address berhasil ditambahkan.',
                'success'
            );

            await ambilDaftarIP();

        } catch (error) {
            tampilkanPesan(error.message, 'danger');

        } finally {
            tambahIPBtn.disabled = false;
            tambahIPBtn.innerHTML =
                '<i class="bi bi-plus-lg"></i> Tambah IP';
        }
    });

    /*
    |--------------------------------------------------------------------------
    | HAPUS IP
    |--------------------------------------------------------------------------
    */

    async function hapusIP(id, ipAddress) {
        const yakin = confirm(
            `Yakin ingin menghapus IP ${ipAddress}?`
        );

        if (!yakin) return;

        try {
            const hasil = await requestAPI(
                `${URL_DAFTAR_IP}/${encodeURIComponent(id)}`,
                {
                    method: 'DELETE'
                }
            );

            tampilkanPesan(
                hasil.message || 'IP Address berhasil dihapus.',
                'success'
            );

            await ambilDaftarIP();

        } catch (error) {
            tampilkanPesan(error.message, 'danger');
        }
    }

    /*
    |--------------------------------------------------------------------------
    | DETAIL IP
    |--------------------------------------------------------------------------
    */

    function lihatDetailIP(item) {
        document.getElementById('detailIdIP').textContent =
            item.id ?? '-';

        document.getElementById('detailAlamatIP').textContent =
            item.ip_address || '-';

        bootstrap.Modal
            .getOrCreateInstance(
                document.getElementById('modalDetailIP')
            )
            .show();
    }

    /*
    |--------------------------------------------------------------------------
    | SEARCH IP
    |--------------------------------------------------------------------------
    */

    searchInput.addEventListener('input', tampilkanIP);

    /*
    |--------------------------------------------------------------------------
    | REFRESH MANUAL
    |--------------------------------------------------------------------------
    */

    document.getElementById('refreshIPBtn')
        .addEventListener('click', async function() {

            const icon = this.querySelector('i');

            icon.classList.add('spin');

            await Promise.all([
                ambilStatusLayar(),
                ambilDaftarIP()
            ]);

            setTimeout(() => {
                icon.classList.remove('spin');
            }, 500);

            tampilkanPesan('Data berhasil diperbarui.', 'success');
        });

    /*
    |--------------------------------------------------------------------------
    | LOAD AWAL
    |--------------------------------------------------------------------------
    */

    async function muatSemuaData() {
        if (sedangMemuat) return;

        sedangMemuat = true;

        await Promise.all([
            ambilStatusLayar(),
            ambilDaftarIP()
        ]);

        sedangMemuat = false;
    }

    muatSemuaData();

    /*
    |--------------------------------------------------------------------------
    | AUTO REFRESH
    |--------------------------------------------------------------------------
    | Status layar diperbarui setiap 5 detik.
    | Daftar IP diperbarui setiap 15 detik.
    */

    setInterval(ambilStatusLayar, 5000);
    setInterval(ambilDaftarIP, 15000);

})();
</script>

<?= $this->endSection() ?>