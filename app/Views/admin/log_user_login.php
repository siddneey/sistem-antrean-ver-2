<?= $this->extend('layouts/admin') ?>

<?= $this->section('pageTitle') ?>
    <div class="pk-heading">
        <div>
            <h1>Log User Login</h1>
            <p>Pantau riwayat login, logout, dan aktivitas akses pengguna pada sistem MPP Kota Tangerang.</p>
        </div>
    </div>
<?= $this->endSection() ?>

<?= $this->section('styles') ?>
<style>
/* ==================== HEADER ==================== */

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

/* ==================== STATISTIK ==================== */

.log-stat-grid {
    display:grid;
    grid-template-columns:repeat(4,minmax(0,1fr));
    gap:15px;
    margin-bottom:20px;
} 

.log-stat-card {
    background:#fff;
    border:1px solid var(--border);
    border-radius:9px;
    min-height:94px;
    padding:16px;
    display:flex;
    align-items:center;
    gap:13px;
}

.log-stat-icon {
    width:43px;
    height:43px;
    min-width:43px;
    border-radius:9px;
    display:flex;
    align-items:center;
    justify-content:center;
    background:var(--yellow-soft);
    color:var(--navy);
    font-size:18px;
}

.log-stat-icon.green {
    background:#eaf7ef;
    color:var(--green);
}

.log-stat-icon.blue {
    background:#eef5ff;
    color:#3976b8;
}

.log-stat-icon.red {
    background:#fff0ef;
    color:var(--red);
}

.log-stat-info span {
    display:block;
    color:var(--muted);
    font-size:11px;
    margin-bottom:5px;
}

.log-stat-info strong {
    color:var(--navy);
    font-size:22px;
}

/* ==================== FILTER ==================== */

.log-filter-card {
    background:#fff;
    border:1px solid var(--border);
    border-radius:9px;
    padding:17px;
    margin-bottom:20px;
}

.log-filter-heading {
    color:var(--navy);
    font-size:13px;
    font-weight:700;
    margin-bottom:14px;
}

.log-filter-heading i {
    margin-right:6px;
}

.log-filter-grid {
    display:grid;
    grid-template-columns:minmax(220px,1.5fr) repeat(3,minmax(140px,1fr)) auto;
    align-items:end;
    gap:13px;
}

.log-filter-group label {
    display:block;
    color:var(--muted);
    font-size:11px;
    font-weight:700;
    margin-bottom:6px;
}

.log-filter-control {
    width:100%;
    height:39px;
    padding:0 10px;
    border:1px solid var(--border);
    border-radius:7px;
    background:#fff;
    color:var(--text);
    outline:none;
    font-size:12px;
}

.log-filter-control:focus {
    border-color:var(--navy);
    box-shadow:0 0 0 3px rgba(16,35,63,.06);
}

.log-btn-search {
    height:39px;
    padding:0 18px;
    border:0;
    border-radius:7px;
    background:var(--navy);
    color:#fff;
    font-size:12px;
    font-weight:600;
    cursor:pointer;
    white-space:nowrap;
    transition:.2s ease;
}

.log-btn-search:hover {
    background:#1c3558;
}

/* ==================== TABEL ==================== */

.log-table-card {
    background:#fff;
    border:1px solid var(--border);
    border-radius:9px;
    overflow:hidden;
}

.log-table-header {
    padding:13px 18px;
    border-bottom:1px solid var(--border);
    display:flex;
    align-items:center;
    justify-content:space-between;
    gap:12px;
}

.log-table-header h3 {
    color:var(--navy);
    font-size:14px;
    font-weight:700;
    margin:0;
}

.log-table-header p {
    color:var(--muted);
    font-size:11.5px;
    margin:5px 0 0;
}

.log-table-responsive {
    overflow-x:auto;
}

.log-table {
    width:100%;
    min-width:1000px;
    border-collapse:collapse;
}

.log-table th {
    height:47px;
    padding:0 14px;
    background:#fafafa;
    color:#667085;
    border-bottom:1px solid var(--border);
    font-size:11px;
    font-weight:700;
    text-align:center;
    white-space:nowrap;
}

.log-table td {
    padding:13px 14px;
    color:#667085;
    border-bottom:1px solid #edf0f3;
    font-size:12px;
    vertical-align:middle;
    text-align:center;
}

/* Kolom pengguna tetap rata kiri dengan jarak yang nyaman */
.log-table td:nth-child(2) {
    text-align:left;
    padding-left:22px;
}

.log-table tbody tr:hover td {
    background:#fcfcfc;
}

.log-table tbody tr:last-child td {
    border-bottom:none;
}

.log-user {
    display:flex;
    align-items:center;
    justify-content:flex-start;
    gap:10px;
}

.log-user-avatar {
    width:36px;
    height:36px;
    min-width:36px;
    border-radius:9px;
    background:var(--yellow-soft);
    color:var(--navy);
    display:flex;
    align-items:center;
    justify-content:center;
    font-size:12px;
    font-weight:700;
}

.log-user-name {
    display:block;
    color:var(--text);
    font-size:12px;
    font-weight:600;
}

.log-user-desc {
    display:block;
    color:#98a2b3;
    font-size:10px;
    margin-top:3px;
}

.log-instansi-badge {
    display:inline-block;
    padding:5px 8px;
    border-radius:5px;
    background:#f1f3f5;
    color:#667085;
    font-size:10px;
}

.log-activity {
    display:inline-flex;
    align-items:center;
    gap:6px;
    padding:5px 8px;
    border-radius:5px;
    font-size:10px;
    font-weight:600;
    white-space:nowrap;
}

.log-activity.login {
    background:#eaf7ef;
    color:var(--green);
}

.log-activity.logout {
    background:#eef5ff;
    color:#3976b8;
}

.log-activity.failed {
    background:#fff0ef;
    color:var(--red);
}

.log-time-main {
    display:block;
    color:var(--text);
    font-weight:600;
    font-size:12px;
}

.log-time-sub {
    display:block;
    color:#98a2b3;
    font-size:10px;
    margin-top:3px;
}

.log-ip-address {
    font-family:Consolas,monospace;
    font-size:11px;
    color:#667085;
}

.log-action-btn {
    width:32px;
    height:32px;
    border:1px solid var(--border);
    border-radius:7px;
    background:#fff;
    color:var(--navy);
    display:inline-flex;
    align-items:center;
    justify-content:center;
    cursor:pointer;
    transition:.2s ease;
}

.log-action-btn:hover {
    background:var(--yellow-soft);
    border-color:#eadfbd;
}

.log-empty-content {
    padding:35px 20px;
    text-align:center;
}

.log-empty-content i {
    display:block;
    color:#b4beca;
    font-size:30px;
    margin-bottom:9px;
}

.log-empty-content strong {
    display:block;
    color:#667085;
    font-size:13px;
}

.log-empty-content span {
    display:block;
    color:#98a2b3;
    font-size:11px;
    margin-top:5px;
}

.log-table-footer {
    padding:13px 17px;
    border-top:1px solid var(--border);
    color:#98a2b3;
    font-size:11px;
    display:flex;
    justify-content:space-between;
    gap:10px;
}

/* ==================== MODAL DETAIL ==================== */

#logDetailModal .modal-content {
    border:none;
    border-radius:10px;
    overflow:hidden;
}

#logDetailModal .modal-header {
    background:var(--navy);
    color:#fff;
    border:none;
    padding:16px 20px;
}

#logDetailModal .modal-title {
    font-size:16px;
    font-weight:700;
}

#logDetailModal .btn-close {
    filter:brightness(0) invert(1);
}

#logDetailModal .modal-body {
    padding:22px;
}

#logDetailModal .detail-item {
    padding:12px 0;
    border-bottom:1px solid var(--border);
}

#logDetailModal .detail-item:last-child {
    border-bottom:none;
}

#logDetailModal .detail-label {
    display:block;
    color:var(--muted);
    font-size:11px;
    margin-bottom:5px;
}

#logDetailModal .detail-value {
    color:var(--text);
    font-size:13px;
    font-weight:600;
    overflow-wrap:anywhere;
}

/* ==================== RESPONSIVE ==================== */

@media(max-width:1200px) {
    .log-filter-grid {
        grid-template-columns:repeat(2,minmax(0,1fr));
    }

    .log-stat-grid {
        grid-template-columns:repeat(2,minmax(0,1fr));
    }
}

@media(max-width:800px) {
    .page-header {
        align-items:flex-start;
        flex-direction:column;
    }

    .log-filter-grid {
        grid-template-columns:1fr;
    }

    .log-btn-search {
        width:100%;
    }
}

@media(max-width:550px) {
    .log-stat-grid {
        grid-template-columns:1fr;
    }

    .log-table-footer {
        flex-direction:column;
    }
}
</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<!-- STATISTIK -->
<div class="log-stat-grid">
    <div class="log-stat-card">
        <div class="log-stat-icon">
            <i class="bi bi-clock-history"></i>
        </div>
        <div class="log-stat-info">
            <span>Total Aktivitas</span>
            <strong id="logTotal">0</strong>
        </div>
    </div>

    <div class="log-stat-card">
        <div class="log-stat-icon green">
            <i class="bi bi-box-arrow-in-right"></i>
        </div>
        <div class="log-stat-info">
            <span>Login Berhasil</span>
            <strong id="logLogin">0</strong>
        </div>
    </div>

    <div class="log-stat-card">
        <div class="log-stat-icon blue">
            <i class="bi bi-box-arrow-right"></i>
        </div>
        <div class="log-stat-info">
            <span>Aktivitas Logout</span>
            <strong id="logLogout">0</strong>
        </div>
    </div>

    <div class="log-stat-card">
        <div class="log-stat-icon red">
            <i class="bi bi-shield-exclamation"></i>
        </div>
        <div class="log-stat-info">
            <span>Login Gagal</span>
            <strong id="logGagal">0</strong>
        </div>
    </div>
</div>

<!-- FILTER -->
<div class="log-filter-card">
    <div class="log-filter-heading">
        <i class="bi bi-funnel"></i>
        Filter Riwayat Aktivitas
    </div>

    <div class="log-filter-grid">
        <div class="log-filter-group">
            <label for="logSearch">Cari Pengguna</label>
            <input type="search" id="logSearch" class="log-filter-control"
                   placeholder="Username atau alamat IP...">
        </div>

        <div class="log-filter-group">
            <label for="logFilterInstansi">Instansi</label>
            <select id="logFilterInstansi" class="log-filter-control">
                <option value="">Semua Instansi</option>
            </select>
        </div>

        <div class="log-filter-group">
            <label for="logFilterAktivitas">Jenis Aktivitas</label>
            <select id="logFilterAktivitas" class="log-filter-control">
                <option value="">Semua Aktivitas</option>
                <option value="Login Berhasil">Login Berhasil</option>
                <option value="Logout">Logout</option>
                <option value="Login Gagal">Login Gagal</option>
            </select>
        </div>

        <div class="log-filter-group">
            <label for="logFilterTanggal">Tanggal</label>
            <input type="date" id="logFilterTanggal" class="log-filter-control">
        </div>

        <button type="button" class="log-btn-search" id="logSearchBtn">
            <i class="bi bi-search"></i>
            Cari Data
        </button>
    </div>
</div>

<!-- TABEL RIWAYAT LOGIN -->
<div class="log-table-card">
    <div class="log-table-header">
        <div>
            <h3>Riwayat Login Pengguna</h3>
            <p>Catatan aktivitas masuk dan keluar dari sistem.</p>
        </div>
    </div>

    <div class="log-table-responsive">
        <table class="log-table">
            <thead>
                <tr>
                    <th width="55">No</th>
                    <th>Pengguna</th>
                    <th>Instansi</th>
                    <th>Aktivitas</th>
                    <th>Waktu</th>
                    <th>Alamat IP</th>
                    <th>Perangkat</th>
                    <th width="75">Detail</th>
                </tr>
            </thead>
            <tbody id="logTableBody">
                <tr>
                    <td colspan="8">
                        <div class="log-empty-content">
                            <i class="bi bi-hourglass-split"></i>
                            <strong>Memuat riwayat aktivitas...</strong>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="log-table-footer">
        <span id="logResultInfo">Memuat data...</span>
        <span>Data aktivitas dari database MPP</span>
    </div>
</div>

<!-- MODAL DETAIL AKTIVITAS -->
<div class="modal fade" id="logDetailModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="bi bi-clock-history me-2"></i>
                    Detail Aktivitas
                </h5>
                <button type="button" class="btn-close"
                        data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>

            <div class="modal-body">
                <?php
                $detailLabels = [
                    'Username'  => 'Username',
                    'Instansi'  => 'Instansi',
                    'Aktivitas' => 'Jenis Aktivitas',
                    'Waktu'     => 'Waktu Aktivitas',
                    'IP'        => 'Alamat IP',
                    'Perangkat' => 'Perangkat',
                    'Status'    => 'Status',
                    'Logout'    => 'Waktu Logout',
                ];
                ?>
                <?php foreach ($detailLabels as $id => $label): ?>
                    <div class="detail-item">
                        <span class="detail-label"><?= esc($label) ?></span>
                        <div class="detail-value" id="logDetail<?= esc($id) ?>">-</div>
                    </div>
                <?php endforeach; ?>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-light btn-sm"
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

    const endpoint = <?= json_encode(site_url('admin/log-user-login/data'), JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT) ?>;
    const el = id => document.getElementById(id);
    const body = el('logTableBody');

    let semuaLog = [];
    let hasilFilter = [];

    // Filter yang sedang diterapkan.
    let filterAktif = {
        kata: '',
        instansi: '',
        aktivitas: '',
        tanggal: ''
    };

    // Mengamankan teks sebelum ditampilkan di tabel.
    function escapeHTML(value) {
        return String(value ?? '').replace(/[&<>"']/g, ch => ({
            '&':'&amp;',
            '<':'&lt;',
            '>':'&gt;',
            '"':'&quot;',
            "'":'&#039;'
        }[ch]));
    }

    function formatTanggal(tanggal) {
        if (!/^\d{4}-\d{2}-\d{2}$/.test(tanggal || '')) {
            return '-';
        }

        return new Date(tanggal + 'T00:00:00').toLocaleDateString(
            'id-ID',
            {
                day:'2-digit',
                month:'short',
                year:'numeric'
            }
        );
    }

    function isiStatistik() {
        el('logTotal').textContent = semuaLog.length;

        el('logLogin').textContent = semuaLog.filter(
            x => x.aktivitas === 'Login Berhasil'
        ).length;

        el('logLogout').textContent = semuaLog.filter(
            x => x.aktivitas === 'Logout'
        ).length;

        el('logGagal').textContent = semuaLog.filter(
            x => x.aktivitas === 'Login Gagal'
        ).length;
    }

    function isiInstansi() {
        const select = el('logFilterInstansi');
        const lama = select.value;

        const daftar = [
            ...new Set(
                semuaLog
                    .map(x => x.instansi)
                    .filter(x => x && x !== '-')
            )
        ].sort((a, b) => a.localeCompare(b, 'id'));

        select.replaceChildren(
            new Option('Semua Instansi', '')
        );

        daftar.forEach(nama => {
            select.add(new Option(nama, nama));
        });

        if (daftar.includes(lama)) {
            select.value = lama;
        }
    }

    // Mengambil nilai filter hanya ketika tombol Cari Data diklik.
    function cariLog() {
        filterAktif = {
            kata: el('logSearch').value.toLowerCase().trim(),
            instansi: el('logFilterInstansi').value,
            aktivitas: el('logFilterAktivitas').value,
            tanggal: el('logFilterTanggal').value
        };

        filterLog();
    }

    function filterLog() {
        const {kata, instansi, aktivitas, tanggal} = filterAktif;

        hasilFilter = semuaLog.filter(x =>
            (
                String(x.username).toLowerCase().includes(kata) ||
                String(x.ip).toLowerCase().includes(kata)
            ) &&
            (!instansi || x.instansi === instansi) &&
            (!aktivitas || x.aktivitas === aktivitas) &&
            (!tanggal || x.tanggal === tanggal)
        );

        tampilkanTabel();
    }

    function tampilkanTabel() {
        el('logResultInfo').textContent =
            `Menampilkan ${hasilFilter.length} dari ${semuaLog.length} aktivitas`;

        if (!hasilFilter.length) {
            body.innerHTML = `
                <tr>
                    <td colspan="8">
                        <div class="log-empty-content">
                            <i class="bi bi-search"></i>
                            <strong>Data log tidak ditemukan</strong>
                            <span>Coba ubah kata pencarian atau filter yang digunakan.</span>
                        </div>
                    </td>
                </tr>
            `;
            return;
        }

        body.innerHTML = hasilFilter.map((x, i) => {
            const cls = x.aktivitas === 'Logout'
                ? 'logout'
                : (x.aktivitas === 'Login Gagal' ? 'failed' : 'login');

            const ikon = cls === 'logout'
                ? 'bi-box-arrow-right'
                : (cls === 'failed' ? 'bi-shield-exclamation' : 'bi-box-arrow-in-right');

            const nama = String(x.username || '-');

            return `
                <tr>
                    <td>${i + 1}</td>
                    <td>
                        <div class="log-user">
                            <div class="log-user-avatar">
                                ${escapeHTML(nama.charAt(0).toUpperCase())}
                            </div>
                            <div>
                                <span class="log-user-name">${escapeHTML(nama)}</span>
                                <span class="log-user-desc">Akun pengguna</span>
                            </div>
                        </div>
                    </td>
                    <td>
                        <span class="log-instansi-badge">${escapeHTML(x.instansi)}</span>
                    </td>
                    <td>
                        <span class="log-activity ${cls}">
                            <i class="bi ${ikon}"></i>
                            ${escapeHTML(x.aktivitas)}
                        </span>
                    </td>
                    <td>
                        <span class="log-time-main">${escapeHTML(x.waktu)} WIB</span>
                        <span class="log-time-sub">${escapeHTML(formatTanggal(x.tanggal))}</span>
                    </td>
                    <td>
                        <span class="log-ip-address">${escapeHTML(x.ip)}</span>
                    </td>
                    <td>${escapeHTML(x.perangkat)}</td>
                    <td>
                        <button
                            type="button"
                            class="log-action-btn"
                            data-log-id="${Number(x.id)}"
                            title="Lihat detail"
                            aria-label="Lihat detail log"
                        >
                            <i class="bi bi-eye"></i>
                        </button>
                    </td>
                </tr>
            `;
        }).join('');
    }

    // Mengambil riwayat asli dari API admin.
    async function muatLog() {
        try {
            const res = await fetch(endpoint, {
                headers: {
                    'Accept':'application/json'
                },
                credentials:'same-origin',
                cache:'no-store'
            });

            if (!res.ok) {
                throw new Error(
                    res.status === 403
                        ? 'Akses ditolak. Login sebagai admin.'
                        : 'HTTP ' + res.status
                );
            }

            const json = await res.json();

            if (!json.status || !Array.isArray(json.data)) {
                throw new Error(
                    json.message || 'Format data tidak valid.'
                );
            }

            semuaLog = json.data;

            isiStatistik();
            isiInstansi();
            filterLog();

        } catch (error) {
            console.error('Gagal memuat log:', error);

            body.innerHTML = `
                <tr>
                    <td colspan="8">
                        <div class="log-empty-content">
                            <i class="bi bi-exclamation-triangle"></i>
                            <strong>Gagal mengambil riwayat login</strong>
                            <span>${escapeHTML(error.message)}</span>
                        </div>
                    </td>
                </tr>
            `;

            el('logResultInfo').textContent = 'Gagal memuat data';
        }
    }

    // Terapkan filter melalui tombol Cari Data.
    el('logSearchBtn').addEventListener('click', cariLog);

    // Enter pada kolom pencarian juga menjalankan pencarian.
    el('logSearch').addEventListener('keydown', event => {
        if (event.key === 'Enter') {
            cariLog();
        }
    });

    // Detail aktivitas.
    body.addEventListener('click', event => {
        const btn = event.target.closest('[data-log-id]');

        if (!btn) return;

        const log = semuaLog.find(
            x => Number(x.id) === Number(btn.dataset.logId)
        );

        if (!log) return;

        const data = {
            Username: log.username,
            Instansi: log.instansi,
            Aktivitas: log.aktivitas,
            Waktu: `${formatTanggal(log.tanggal)}, ${log.waktu} WIB`,
            IP: log.ip,
            Perangkat: log.perangkat,
            Status: log.status,
            Logout: log.aktivitas === 'Logout'
                ? `${formatTanggal(log.tanggal)}, ${log.waktu} WIB`
                : '-'
        };

        Object.entries(data).forEach(([id, value]) => {
            el('logDetail' + id).textContent = value || '-';
        });

        bootstrap.Modal
            .getOrCreateInstance(el('logDetailModal'))
            .show();
    });

    muatLog();
})();
</script>
<?= $this->endSection() ?>