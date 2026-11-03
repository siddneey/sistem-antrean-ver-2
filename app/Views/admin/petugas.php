<?= $this->extend('layouts/admin') ?>

<?= $this->section('pageTitle') ?>
<div class="page-heading">
    <div class="heading-main">
        <div>
            <h1>Petugas</h1>
            <p>Kelola data petugas yang bertugas pada setiap instansi.</p>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('styles') ?>
<style>

:root {
    --navy: #10233f;
    --navy-dark: #0b1a30;
    --navy-light: #193456;
    --yellow: #f5c542;
    --yellow-soft: #fff8dc;
    --bg: #f4f6f9;
    --white: #ffffff;
    --text: #1d2939;
    --muted: #7b8798;
    --border: #e4e8ee;
    --green: #198754;
    --red: #d9534f;
}

/* Heading mengikuti halaman Instansi */
.page-heading{display:flex;align-items:flex-start;justify-content:space-between;gap:20px;margin-bottom:20px}
.heading-main{display:flex;align-items:flex-start;gap:12px}
.page-heading h1{margin:0;color:var(--navy);font-size:23px;line-height:1.25;font-weight:700}
.page-heading p{margin:5px 0 0;color:var(--muted);font-size:12.5px}

/* Statistik */
.petugas-content{padding:0}
.stat-grid{display:grid;grid-template-columns:repeat(4,minmax(0,1fr));gap:14px;margin-bottom:20px}
.stat-card{display:flex;align-items:center;gap:13px;min-height:78px;padding:14px 16px;background:var(--white);border:1px solid var(--border);border-radius:8px}
.stat-icon{display:flex;align-items:center;justify-content:center;flex:0 0 40px;width:40px;height:40px;border-radius:8px;background:var(--yellow-soft);color:var(--navy);font-size:18px}
.stat-icon.green{background:#eaf7ef;color:var(--green)}
.stat-icon.red{background:#fff0ef;color:var(--red)}
.stat-icon.blue{background:#eef5ff;color:#3976b8}
.stat-info span{display:block;margin-bottom:3px;color:var(--muted);font-size:11px}
.stat-info strong{display:block;color:var(--navy);font-size:18px;font-weight:700}

/* Filter */
.filter-card{margin-bottom:18px;padding:17px 18px 18px;background:var(--white);border:1px solid var(--border);border-radius:11px}
.filter-title{display:flex;align-items:center;gap:7px;margin-bottom:14px;color:var(--navy);font-size:13px;font-weight:700}
.filter-title i{color:#64748b;font-size:14px}
.filter-controls{display:grid;grid-template-columns:minmax(220px,1fr) 170px 170px auto;align-items:center;gap:12px}
.filter-group{min-width:0}
.filter-group label{display:block;margin-bottom:5px;color:var(--muted);font-size:11px}
.search-box{position:relative;min-width:0}
.search-box i{position:absolute;top:50%;left:12px;transform:translateY(-50%);color:var(--muted);font-size:14px;pointer-events:none}
.search-box input{display:block;width:100%;height:39px;padding:0 12px 0 34px;border:1px solid #dfe4ea;border-radius:7px;background:var(--white);color:var(--text);font-family:inherit;font-size:12.5px;outline:none}
.filter-select{display:block;width:100%;height:39px;padding:0 28px 0 12px;border:1px solid #dfe4ea;border-radius:7px;background:var(--white);color:#475467;font-family:inherit;font-size:12.5px;font-weight:400;outline:none;cursor:pointer}
.search-box input:focus,.filter-select:focus{border-color:#aab7c8;box-shadow:0 0 0 3px rgba(16,35,63,.08)}
.btn-add{height:39px;display:inline-flex;align-items:center;justify-content:center;gap:7px;padding:0 16px;border:0;border-radius:7px;background:var(--navy);color:#fff;font-size:12px;font-weight:700;white-space:nowrap;cursor:pointer;transition:background .2s ease}
.btn-add:hover{background:var(--navy-light);color:#fff}

/* Tabel */
.table-card{margin-top:20px;overflow:hidden;background:var(--white);border:1px solid var(--border);border-radius:8px;box-shadow:0 4px 16px rgba(16,35,63,.05)}
.table-responsive{overflow-x:auto}
.petugas-table{width:100%;min-width:950px;border-collapse:separate;border-spacing:0;font-size:13px}
.petugas-table th{height:52px;padding:0 18px;background:#fafafa;border-bottom:1px solid var(--border);color:#64748b;text-align:center;vertical-align:middle;font-size:12px;font-weight:600;white-space:nowrap}
.petugas-table td{padding:15px 18px;border-bottom:1px solid #edf0f3;color:#64748b;font-size:12.5px;vertical-align:middle}
.petugas-table th:first-child,.petugas-table td:first-child{text-align:center;width:64px}
.petugas-table th:last-child,.petugas-table td:last-child{text-align:center;width:112px}
.petugas-table td:last-child .action-group{justify-content:center}
.petugas-table td:nth-child(4),.petugas-table td:nth-child(5){text-align:center}
.petugas-table tbody tr:last-child td{border-bottom:none}
.petugas-table tbody tr:hover td{background:#fcfcfc}
.user-info{display:flex;align-items:center;gap:9px}
.user-avatar{display:flex;align-items:center;justify-content:center;flex:0 0 36px;width:36px;height:36px;border-radius:50%;background:var(--yellow-soft);color:var(--navy);font-size:12px;font-weight:700}
.user-name{display:block;color:#64748b;font-size:13px;font-weight:700}
.user-desc{display:block;margin-top:3px;color:#7b8798;font-size:10px}
.role-badge{display:inline-block;padding:3px 7px;border-radius:5px;background:#f1f3f5;color:#7b8798;font-size:10px;white-space:nowrap}
.status{display:inline-flex;align-items:center;gap:6px;font-size:11px;font-weight:600;white-space:nowrap}
.status i{font-size:7px}
.status.active{color:var(--green)}
.status.inactive{color:var(--red)}
.login-time{color:#7b8798;font-size:11px;white-space:nowrap}

/* Aksi */
.action-group{display:flex;align-items:center;gap:6px}
.action-btn{display:inline-flex;align-items:center;justify-content:center;width:32px;height:32px;border:1px solid var(--navy);border-radius:7px;background:#fff;color:var(--navy);font-size:13px;cursor:pointer;transition:background .2s ease,border-color .2s ease}
.action-btn.delete{border-color:var(--red);color:var(--red)}
.action-btn.edit:hover{background:var(--navy);border-color:var(--navy);color:#fff}
.action-btn.delete:hover{background:#c62828;border-color:#c62828;color:#fff}

/* Empty state dan footer */
.empty-row{display:none}
.empty-content{padding:45px 20px;text-align:center}
.empty-content i{display:block;margin-bottom:10px;color:#c5ccd5;font-size:32px}
.empty-content strong{display:block;margin-bottom:4px;color:#64748b;font-size:13px}
.empty-content span{color:var(--muted);font-size:11px}
.table-footer{padding:12px 15px;border-top:1px solid var(--border);color:#98a2b3;font-size:11px}

/* Modal */
#modalPetugas .modal-content{overflow:hidden;border:0;border-radius:9px}
#modalPetugas .modal-header{background:var(--navy);color:#fff;border-bottom:none;padding:16px 20px}
#modalPetugas .modal-title{font-size:16px;font-weight:700}
#modalPetugas .modal-header .btn-close{filter:brightness(0) invert(1)}
#modalPetugas .modal-body{padding:22px}
#modalPetugas .form-label{margin-bottom:6px;color:#64748b;font-size:12px;font-weight:600}
#modalPetugas .form-control,#modalPetugas .form-select{min-height:40px;border-color:var(--border);border-radius:7px;font-size:13px}
#modalPetugas .form-control:focus,#modalPetugas .form-select:focus{border-color:var(--navy);box-shadow:0 0 0 3px rgba(16,35,63,.08)}
.password-wrapper{position:relative}
.password-wrapper input{padding-right:42px}
.password-toggle{position:absolute;top:50%;right:10px;transform:translateY(-50%);border:0;background:transparent;color:var(--muted);cursor:pointer}
.password-help{display:block;margin-top:5px;color:#98a2b3;font-size:10px}
#modalPetugas .modal-footer{padding:13px 20px;border-top:1px solid var(--border)}
.btn-save{border:0;border-radius:7px;background:var(--navy);color:#fff;font-size:12px}
.btn-save:hover,.btn-save:focus{background:var(--navy-light);color:#fff}
.btn-light{border-radius:7px;background:white;color:#c62828;font-size:12px;border-color:red}
.btn-light:hover,.btn-light:focus{background:var(--red);color:#fff}

/* Responsif */
@media(max-width:1250px){.filter-controls{grid-template-columns:minmax(180px,1fr) 160px 160px auto}}
@media(max-width:1100px){.stat-grid{grid-template-columns:repeat(2,minmax(0,1fr))}.filter-controls{grid-template-columns:minmax(180px,1fr) 160px}.btn-add{grid-column:auto;justify-self:stretch}}
@media(max-width:900px){.page-heading{display:block}}
@media(max-width:700px){.filter-controls{grid-template-columns:1fr}.btn-add{width:100%;grid-column:auto}.filter-card{padding:16px}}
@media(max-width:600px){.stat-grid{grid-template-columns:1fr}.page-heading h1{font-size:20px}.stat-card{min-height:78px}}
</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<section class="petugas-content">

<?php
// Data petugas dimuat melalui endpoint API agar selalu mengikuti database.
$instansiList = $instansiList ?? [];
$petugasApiUrl = site_url('admin/petugas');
$csrfHeaderName = function_exists('csrf_header') ? csrf_header() : 'X-CSRF-TOKEN';
$csrfHashValue = function_exists('csrf_hash') ? csrf_hash() : '';
?>

<!-- KARTU STATISTIK -->
<div class="stat-grid">
    <div class="stat-card"><div class="stat-icon"><i class="bi bi-people-fill"></i></div><div class="stat-info"><span>Total Petugas</span><strong id="statTotal">0</strong></div></div>
    <div class="stat-card"><div class="stat-icon green"><i class="bi bi-person-check-fill"></i></div><div class="stat-info"><span>Petugas Aktif</span><strong id="statAktif">0</strong></div></div>
    <div class="stat-card"><div class="stat-icon red"><i class="bi bi-person-x-fill"></i></div><div class="stat-info"><span>Petugas Nonaktif</span><strong id="statNonaktif">0</strong></div></div>
    <div class="stat-card"><div class="stat-icon blue"><i class="bi bi-building"></i></div><div class="stat-info"><span>Instansi Terlayani</span><strong id="statInstansi">0</strong></div></div>
</div>

<!-- FILTER DATA -->
<div class="filter-card">
    <div class="filter-title"><i class="bi bi-funnel"></i> Filter Data Petugas</div>
    <div class="filter-controls">
        <div class="search-box">
            <i class="bi bi-search"></i>
            <input type="text" id="searchPetugas" placeholder="Cari nama atau username..." aria-label="Cari nama atau username petugas">
        </div>
        <select id="filterInstansi" class="filter-select" aria-label="Filter instansi">
            <option value="">Semua Instansi</option>
            <?php foreach ($instansiList as $instansi): ?><option value="<?= esc($instansi['id']) ?>"><?= esc($instansi['nama_instansi']) ?></option><?php endforeach; ?>
        </select>
        <select id="filterStatus" class="filter-select" aria-label="Filter status">
            <option value="">Semua Status</option>
            <option value="Aktif">Aktif</option>
            <option value="Nonaktif">Nonaktif</option>
        </select>
        <button type="button" class="btn-add" onclick="openAddModal()"><i class="bi bi-plus-lg"></i> Tambah Petugas</button>
    </div>
</div>

<!-- TABEL PETUGAS -->
<div class="table-card">
    <div class="table-responsive">
        <table class="petugas-table">
            <thead><tr><th width="60">No</th><th>Nama / Username</th><th>Instansi</th><th>Role</th><th>Status</th><th>Login Terakhir</th><th width="110">Aksi</th></tr></thead>
            <tbody id="petugasTableBody">
                <tr id="loadingRow"><td colspan="7" class="text-center py-4">Memuat data petugas...</td></tr>
                <tr id="emptyRowDetail" class="empty-row" style="display:none"><td colspan="7"><div class="empty-content"><i class="bi bi-person-x"></i><strong>Data petugas tidak ditemukan</strong><span>Coba ubah kata pencarian atau filter.</span></div></td></tr>
            </tbody>
        </table>
    </div>
    <div class="table-footer"><span id="resultInfo">Memuat data petugas...</span></div>
</div>
</section>

<!-- MODAL TAMBAH / EDIT PETUGAS -->
<div class="modal fade" id="modalPetugas" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered"><div class="modal-content">
        <div class="modal-header"><h5 class="modal-title" id="modalTitle">Tambah Petugas</h5><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button></div>
        <div class="modal-body">
            <form id="formPetugas">
                <input type="hidden" id="petugasId">
                <div class="mb-3"><label class="form-label" for="namaPetugas">Nama / Username</label><input type="text" id="namaPetugas" class="form-control" placeholder="Contoh: bapenda1" required></div>
                <div class="mb-3"><label class="form-label" for="instansiPetugas">Instansi</label><select id="instansiPetugas" class="form-select" required><option value="">Pilih Instansi</option><?php foreach ($instansiList as $instansi): ?><option value="<?= esc($instansi['id']) ?>"><?= esc($instansi['nama_instansi']) ?></option><?php endforeach; ?></select></div>
                <div class="mb-3"><label class="form-label">Role</label><input type="text" class="form-control" value="Petugas" readonly></div>
                <div class="mb-3"><label class="form-label" for="statusPetugas">Status</label><select id="statusPetugas" class="form-select" required><option value="Aktif">Aktif</option><option value="Nonaktif">Nonaktif</option></select></div>
                <div class="mb-2"><label class="form-label" for="passwordPetugas">Password</label><div class="password-wrapper"><input type="password" id="passwordPetugas" class="form-control" placeholder="Masukkan password"><button type="button" class="password-toggle" onclick="togglePassword()" aria-label="Tampilkan atau sembunyikan password"><i class="bi bi-eye" id="passwordIcon"></i></button></div><span class="password-help">CATATAN: Saat edit, kosongkan jika password tidak ingin diubah.</span></div>
            </form>
        </div>
        <div class="modal-footer"><button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button><button type="button" class="btn btn-save" onclick="simpanPetugas()">Simpan</button></div>
    </div></div>
</div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
(() => {
    const apiUrl = <?= json_encode($petugasApiUrl) ?>;
    const csrfHeaderName = <?= json_encode($csrfHeaderName) ?>;
    let csrfHashValue = <?= json_encode($csrfHashValue) ?>;
    let petugasData = [];

    const searchInput = document.getElementById('searchPetugas');
    const filterInstansi = document.getElementById('filterInstansi');
    const filterStatus = document.getElementById('filterStatus');
    const resultInfo = document.getElementById('resultInfo');
    const tableBody = document.getElementById('petugasTableBody');
    const modalElement = document.getElementById('modalPetugas');

    function escapeHtml(value) {
        return String(value ?? '').replace(/[&<>"']/g, char => ({
            '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;', "'": '&#039;'
        }[char]));
    }

    async function apiRequest(url, method = 'GET', body = null) {
        const headers = { 'Accept': 'application/json' };
        if (body !== null) headers['Content-Type'] = 'application/json';
        if (csrfHashValue) headers[csrfHeaderName] = csrfHashValue;
        const response = await fetch(url, {
            method,
            headers,
            body: body !== null ? JSON.stringify(body) : undefined,
            credentials: 'same-origin'
        });
        const newHash = response.headers.get('X-CSRF-TOKEN');
        if (newHash) csrfHashValue = newHash;
        const data = await response.json().catch(() => ({}));
        if (data.csrfHash) csrfHashValue = data.csrfHash;
        if (!response.ok || data.status === false) {
            throw new Error(data.message || `Permintaan gagal (${response.status}).`);
        }
        return data;
    }

    function updateStats() {
        const active = petugasData.filter(item => item.status === 'Aktif').length;
        const inactive = petugasData.filter(item => item.status === 'Nonaktif').length;
        const instansiIds = new Set(petugasData.map(item => String(item.instansi_id ?? '')).filter(Boolean));
        document.getElementById('statTotal').textContent = petugasData.length;
        document.getElementById('statAktif').textContent = active;
        document.getElementById('statNonaktif').textContent = inactive;
        document.getElementById('statInstansi').textContent = instansiIds.size;
    }

    function renderRows() {
        const keyword = searchInput.value.toLowerCase().trim();
        const instansi = filterInstansi.value;
        const status = filterStatus.value;
        const filtered = petugasData.filter(item => {
            const username = String(item.username ?? '').toLowerCase();
            return username.includes(keyword)
                && (!instansi || String(item.instansi_id ?? '') === instansi)
                && (!status || item.status === status);
        });

        if (!filtered.length) {
            tableBody.innerHTML = '<tr><td colspan="7"><div class="empty-content"><i class="bi bi-person-x"></i><strong>Data petugas tidak ditemukan</strong><span>Coba ubah kata pencarian atau filter.</span></div></td></tr>';
            resultInfo.textContent = 'Menampilkan 0 petugas';
            return;
        }

        tableBody.innerHTML = filtered.map((item, index) => {
            const username = escapeHtml(item.username || '-');
            const instansiNama = escapeHtml(item.nama_instansi || 'Belum ditentukan');
            const statusText = item.status === 'Nonaktif' ? 'Nonaktif' : 'Aktif';
            const statusClass = statusText === 'Aktif' ? 'active' : 'inactive';
            const login = item.last_login ? escapeHtml(item.last_login) : 'Belum pernah login';
            const jsonData = escapeHtml(JSON.stringify({
                id: item.id,
                username: item.username,
                instansi_id: item.instansi_id,
                status: statusText
            }));
            return `<tr data-nama="${username.toLowerCase()}" data-instansi="${escapeHtml(item.instansi_id)}" data-status="${statusText}">
                <td>${index + 1}</td>
                <td><div class="user-info"><div class="user-avatar">${escapeHtml((item.username || '?').charAt(0).toUpperCase())}</div><div><span class="user-name">${username}</span><span class="user-desc">Username petugas</span></div></div></td>
                <td>${instansiNama}</td>
                <td><span class="role-badge">Petugas</span></td>
                <td><span class="status ${statusClass}"><i class="bi bi-circle-fill"></i> ${statusText}</span></td>
                <td><span class="login-time">${login}</span></td>
                <td><div class="action-group">
                    <button type="button" class="action-btn edit" title="Edit Petugas" aria-label="Edit Petugas" data-edit="${jsonData}"><i class="bi bi-pencil"></i></button>
                    <button type="button" class="action-btn delete" title="Hapus Petugas" aria-label="Hapus Petugas" data-delete-id="${escapeHtml(item.id)}" data-delete-name="${username}"><i class="bi bi-trash3"></i></button>
                </div></td>
            </tr>`;
        }).join('');
        resultInfo.textContent = `Menampilkan ${filtered.length} dari ${petugasData.length} petugas`;
    }

    async function loadPetugas() {
        tableBody.innerHTML = '<tr><td colspan="7" class="text-center py-4">Memuat data petugas...</td></tr>';
        try {
            const result = await apiRequest(apiUrl);
            petugasData = Array.isArray(result.data) ? result.data : [];
            updateStats();
            renderRows();
        } catch (error) {
            tableBody.innerHTML = `<tr><td colspan="7" class="text-center py-4 text-danger">${escapeHtml(error.message)} <button class="btn btn-sm btn-outline-secondary ms-2" type="button" id="retryLoad">Coba lagi</button></td></tr>`;
            resultInfo.textContent = 'Gagal memuat data';
            document.getElementById('retryLoad')?.addEventListener('click', loadPetugas);
        }
    }

    window.openAddModal = function () {
        document.getElementById('formPetugas').reset();
        document.getElementById('modalTitle').textContent = 'Tambah Petugas';
        document.getElementById('petugasId').value = '';
        document.getElementById('passwordPetugas').required = true;
        document.getElementById('passwordPetugas').placeholder = 'Masukkan password';
        resetPasswordVisibility();
        if (window.bootstrap?.Modal) {
            window.bootstrap.Modal.getOrCreateInstance(modalElement).show();
        } else {
            console.error('Bootstrap Modal belum tersedia');
            alert('Modal tidak bisa dibuka. Periksa Bootstrap JavaScript di layouts/admin.');
        }
    };

    window.editPetugas = function (data) {
        document.getElementById('modalTitle').textContent = 'Edit Petugas';
        document.getElementById('petugasId').value = data.id;
        document.getElementById('namaPetugas').value = data.username || '';
        document.getElementById('instansiPetugas').value = data.instansi_id == null ? '' : String(data.instansi_id);
        document.getElementById('statusPetugas').value = data.status || 'Aktif';
        document.getElementById('passwordPetugas').value = '';
        document.getElementById('passwordPetugas').required = false;
        document.getElementById('passwordPetugas').placeholder = 'Kosongkan jika tidak diubah';
        resetPasswordVisibility();
        bootstrap.Modal.getOrCreateInstance(modalElement).show();
    };

    function resetPasswordVisibility() {
        document.getElementById('passwordPetugas').type = 'password';
        document.getElementById('passwordIcon').className = 'bi bi-eye';
    }

    window.togglePassword = function () {
        const input = document.getElementById('passwordPetugas');
        const icon = document.getElementById('passwordIcon');
        input.type = input.type === 'password' ? 'text' : 'password';
        icon.className = input.type === 'password' ? 'bi bi-eye' : 'bi bi-eye-slash';
    };

    window.simpanPetugas = async function () {
        const form = document.getElementById('formPetugas');
        if (!form.checkValidity()) { form.reportValidity(); return; }
        const id = document.getElementById('petugasId').value;
        const username = document.getElementById('namaPetugas').value.trim();
        const instansiId = document.getElementById('instansiPetugas').value;
        const password = document.getElementById('passwordPetugas').value;
        const status = document.getElementById('statusPetugas').value;
        const payload = { username, instansi_id: Number(instansiId), status };
        if (!id || password) payload.password = password;
        const button = document.querySelector('#modalPetugas .btn-save');
        button.disabled = true;
        button.innerHTML = '<span class="spinner-border spinner-border-sm me-1"></span> Menyimpan...';
        try {
            await apiRequest(id ? `${apiUrl}/${encodeURIComponent(id)}` : apiUrl, id ? 'PUT' : 'POST', payload);
            bootstrap.Modal.getOrCreateInstance(modalElement).hide();
            await loadPetugas();
            alert(id ? 'Data petugas berhasil diperbarui.' : 'Petugas berhasil ditambahkan.');
        } catch (error) {
            alert(error.message || 'Gagal menyimpan data petugas.');
        } finally {
            button.disabled = false;
            button.innerHTML = '<i class="bi bi-check-lg"></i> Simpan';
        }
    };

    async function deletePetugas(id, username) {
        if (!confirm(`Yakin ingin menghapus petugas "${username}"?`)) return;
        try {
            await apiRequest(`${apiUrl}/${encodeURIComponent(id)}`, 'DELETE');
            await loadPetugas();
            alert(`Petugas "${username}" berhasil dihapus.`);
        } catch (error) {
            alert(error.message || 'Gagal menghapus petugas.');
        }
    }

    tableBody.addEventListener('click', event => {
        const editButton = event.target.closest('[data-edit]');
        if (editButton) {
            try {
                const data = JSON.parse(editButton.dataset.edit);
                console.log('Data petugas untuk edit:', data);
                window.editPetugas(data);
            } catch (error) {
                console.error('Gagal membuka data petugas:', error);
                alert('Gagal membuka edit: ' + error.message);
            }
            return;
        }
        const deleteButton = event.target.closest('[data-delete-id]');
        if (deleteButton) deletePetugas(deleteButton.dataset.deleteId, deleteButton.dataset.deleteName);
    });

    searchInput.addEventListener('input', renderRows);
    filterInstansi.addEventListener('change', renderRows);
    filterStatus.addEventListener('change', renderRows);
    loadPetugas();
})();
</script>
<?= $this->endSection() ?>