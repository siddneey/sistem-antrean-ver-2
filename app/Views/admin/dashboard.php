<?= $this->extend('layouts/admin') ?>

<?= $this->section('styles') ?>
<style>
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

    /* Filter tanggal */
    .dashboard-filter {
        display: flex;
        align-items: center;
        flex-wrap: wrap;
        gap: 12px;
        margin-bottom: 20px;
    }

    .dashboard-filter form {
        display: flex;
        align-items: center;
        flex-wrap: wrap;
        gap: 10px;
        width: 100%;
    }

    .dashboard-filter label {
        color: var(--navy);
        font-size: 12.5px;
        font-weight: 600;
    }

    .dashboard-filter input[type="date"] {
        height: 39px;
        padding: 0 11px;
        border: 1px solid #dfe4ea;
        border-radius: 7px;
        background: var(--white);
        color: var(--text);
        font: inherit;
        font-size: 12.5px;
    }

    .dashboard-filter button {
        height: 39px;
        padding: 0 16px;
        border: 0;
        border-radius: 7px;
        background: var(--navy);
        color: #fff;
        font-size: 12px;
        font-weight: 700;
        cursor: pointer;
    }

    .dashboard-filter button:hover {
        background: var(--navy-light);
    }

    .history-note {
        color: #7b8798;
        font-size: 11.5px;
    }

    /* Ringkasan dashboard */
    .dashboard-summary {
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));
        gap: 16px;
        margin-bottom: 20px;
    }

    .summary-card {
        position: relative;
        overflow: hidden;
        display: flex;
        align-items: center;
        gap: 14px;
        min-width: 0;
        min-height: 100px;
        padding: 18px;
        background: #fff;
        border: 1px solid #e4e8ee;
        border-radius: 10px;
        box-shadow: 0 3px 12px rgba(16, 35, 63, 0.04);
    }

    .summary-card::after {
        content: "";
        position: absolute;
        left: 0;
        top: 0;
        bottom: 0;
        width: 4px;
        background: var(--card-accent);
    }

    .summary-card .summary-icon {
        display: flex;
        align-items: center;
        justify-content: center;
        flex: 0 0 44px;
        width: 44px;
        height: 44px;
        border-radius: 9px;
        color: var(--card-accent);
        background: var(--card-tint);
        font-size: 21px;
    }

    .summary-card .summary-info {
        min-width: 0;
    }

    .summary-card .summary-label {
        display: block;
        margin-bottom: 5px;
        color: #7b8798;
        font-size: 12px;
    }

    .summary-card .summary-value {
        display: block;
        color: #10233f;
        font-size: 25px;
        line-height: 1.2;
        font-weight: 750;
    }

    .summary-card.stat-total {
        --card-accent: #244a78;
        --card-tint: #e8eef8;
    }

    .summary-card.stat-aktif {
        --card-accent: #198754;
        --card-tint: #e4f5eb;
    }

    .summary-card.stat-nonaktif {
        --card-accent: #d9534f;
        --card-tint: #fce9e8;
    }

    .summary-card.stat-selesai {
        --card-accent: #b88708;
        --card-tint: #fff5d6;
    }

    @media (max-width: 1000px) {
        .dashboard-summary {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }
    }

    @media (max-width: 560px) {
        .dashboard-summary {
            grid-template-columns: 1fr;
        }
    }

    /* Grid instansi */
    .instansi-grid {
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));
        gap: 16px;
    }

    .instansi-card {
        min-width: 0;
        min-height: 145px;
        background: var(--white);
        border: 1px solid var(--border);
        border-radius: 12px;
        padding: 18px 19px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        transition: transform .2s ease, box-shadow .2s ease,
                    border-color .2s ease;
    }

    .instansi-card:hover {
        transform: translateY(-2px);
        border-color: #d6dce4;
        box-shadow: 0 6px 18px rgba(16, 35, 63, .06);
    }

    .instansi-name {
        color: var(--navy);
        font-size: 15px;
        font-weight: 700;
        line-height: 1.4;
        overflow-wrap: anywhere;
    }

    .queue-info {
        margin-top: 9px;
    }

    .queue-number {
        color: var(--text);
        font-size: 25px;
        line-height: 1.2;
        font-weight: 700;
    }

    .queue-label {
        color: var(--muted);
        font-size: 11px;
        margin-top: 5px;
    }

    /* Status */
    .instansi-status {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 10px;
        margin-top: 16px;
        padding-top: 12px;
        border-top: 1px solid #eef0f3;
    }

    .status-text {
        font-size: 11px;
        font-weight: 600;
    }

    .status-text.on {
        color: var(--green);
    }

    .status-text.off {
        color: var(--red);
    }

    /* Switch */
    .switch {
        position: relative;
        display: inline-block;
        flex: 0 0 42px;
        width: 42px;
        height: 22px;
    }

    .switch input {
        position: absolute;
        width: 1px;
        height: 1px;
        opacity: 0;
    }

    .slider {
        position: absolute;
        inset: 0;
        background: #cdd3da;
        border-radius: 30px;
        cursor: pointer;
        transition: background .25s ease;
    }

    .slider::before {
        content: "";
        position: absolute;
        width: 16px;
        height: 16px;
        left: 3px;
        top: 3px;
        background: #fff;
        border-radius: 50%;
        box-shadow: 0 1px 3px rgba(0, 0, 0, .18);
        transition: transform .25s ease;
    }

    .switch input:checked + .slider {
        background: var(--green);
    }

    .switch input:checked + .slider::before {
        transform: translateX(20px);
    }

    .switch input:focus-visible + .slider {
        outline: 2px solid var(--navy);
        outline-offset: 3px;
    }

    .switch input:disabled + .slider {
        cursor: not-allowed;
    }

    .switch input:disabled:checked + .slider,
    .switch input:disabled + .slider {
        background: #cbd0d7;
    }

    /* Mode riwayat */
    .instansi-card.is-history {
        border-color: #e4e8ee;
    }

    .instansi-card.is-history .instansi-name,
    .instansi-card.is-history .queue-number,
    .instansi-card.is-history .queue-label,
    .instansi-card.is-history .status-text {
        color: #9aa3af;
    }

    .instansi-card.is-history .instansi-status {
        border-top-color: #eceff2;
    }

    .instansi-card.is-history .switch {
        opacity: .65;
        cursor: not-allowed;
    }

    .instansi-card.is-history .slider,
    .instansi-card.is-history .switch input:checked + .slider {
        background: #cbd0d7;
        cursor: not-allowed;
    }

    .instansi-card.is-history .slider::before {
        background: #f8f9fa;
        box-shadow: none;
    }

    .dashboard-empty {
        grid-column: 1 / -1;
        padding: 28px;
        border: 1px dashed var(--border);
        border-radius: 12px;
        color: var(--muted);
        text-align: center;
        background: var(--white);
    }

    @media (max-width: 1200px) {
        .instansi-grid {
            grid-template-columns: repeat(3, minmax(0, 1fr));
        }
    }

    @media (max-width: 900px) {
        .instansi-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }

        .content {
            padding: 24px;
        }
    }

    @media (max-width: 700px) {
        .sidebar {
            width: var(--sidebar-width);
            transform: translateX(-100%);
            box-shadow: 5px 0 25px rgba(0, 0, 0, .15);
        }

        body.mobile-sidebar-open .sidebar {
            transform: translateX(0);
        }

        .main-content,
        body.sidebar-collapsed .main-content {
            margin-left: 0;
        }

        .topbar {
            height: auto;
            min-height: 76px;
            padding: 14px 18px;
            gap: 10px;
        }

        .content {
            padding: 20px;
        }

        .instansi-grid {
            grid-template-columns: 1fr;
        }

        .page-heading h1 {
            font-size: 20px;
        }

        .dashboard-filter form {
            align-items: flex-start;
        }
    }
</style>
<?= $this->endSection() ?>


<?= $this->section('pageTitle') ?>
<div class="page-heading">
    <div class="heading-main">
        <div>
            <h1>Dashboard</h1>
            <p>Pantau layanan dan jumlah antrean setiap instansi.</p>
        </div>
    </div>
</div>
<?= $this->endSection() ?>


<?= $this->section('content') ?>

<?php
    // Fallback mencegah undefined variable; controller tetap harus
    // mengirim tanggal yang sudah divalidasi.
    $tanggalHariIni = $tanggalHariIni ?? date('Y-m-d');
    $tanggalDipilih = $tanggalDipilih ?? $tanggalHariIni;
    $instansi = $instansi ?? [];

    $totalInstansi = (int) ($totalInstansi ?? count($instansi));
    $totalAktif = (int) ($totalAktif ?? 0);
    $totalNonaktif = (int) ($totalNonaktif ?? 0);
    $totalSelesai = (int) ($totalSelesai ?? 0);

    $tanggalLampau = $tanggalDipilih < $tanggalHariIni;
?>

<div class="dashboard-filter">
    <form method="get" action="<?= site_url('admin/dashboard') ?>">
        <label for="tanggal">Tanggal laporan</label>

        <input
            type="date"
            id="tanggal"
            name="tanggal"
            value="<?= esc($tanggalDipilih) ?>"
            max="<?= esc($tanggalHariIni) ?>"
            required
        >

        <button type="submit">Tampilkan</button>

        <?php if ($tanggalLampau): ?>
            <span class="history-note">
                Mode riwayat — status hanya untuk dilihat.
            </span>
        <?php endif; ?>
    </form>
</div>

<div class="dashboard-summary">
    <div class="summary-card stat-total">
        <div class="summary-icon">
            <i class="bi bi-building"></i>
        </div>
        <div class="summary-info">
            <span class="summary-label">Total Instansi</span>
            <span class="summary-value"><?= $totalInstansi ?></span>
        </div>
    </div>

    <div class="summary-card stat-aktif">
        <div class="summary-icon">
            <i class="bi bi-check-circle"></i>
        </div>
        <div class="summary-info">
            <span class="summary-label">Instansi Aktif</span>
            <span class="summary-value"><?= $totalAktif ?></span>
        </div>
    </div>

    <div class="summary-card stat-nonaktif">
        <div class="summary-icon">
            <i class="bi bi-pause-circle"></i>
        </div>
        <div class="summary-info">
            <span class="summary-label">Instansi Nonaktif</span>
            <span class="summary-value"><?= $totalNonaktif ?></span>
        </div>
    </div>

    <div class="summary-card stat-selesai">
        <div class="summary-icon">
            <i class="bi bi-clipboard-check"></i>
        </div>
        <div class="summary-info">
            <span class="summary-label">Antrean Selesai</span>
            <span class="summary-value"><?= $totalSelesai ?></span>
            <span class="summary-label">
                pada <?= esc(date('d-m-Y', strtotime($tanggalDipilih))) ?>
            </span>
        </div>
    </div>
</div>

<div class="instansi-grid">
    <?php if (empty($instansi)): ?>
        <div class="dashboard-empty">
            Belum ada data instansi untuk ditampilkan.
        </div>
    <?php else: ?>
        <?php foreach ($instansi as $item): ?>
            <?php
                $idInstansi = (int) ($item['id'] ?? 0);
                $namaInstansi = (string) ($item['nama_instansi'] ?? 'Instansi');

                $statusDatabase = strtolower(
                    trim((string) ($item['status'] ?? 'nonaktif'))
                );

                $isAktif = $statusDatabase === 'aktif';
                $statusLabel = $isAktif ? 'Aktif' : 'Nonaktif';
                $totalSelesaiInstansi = (int) ($item['total_selesai'] ?? 0);
            ?>

            <div
                class="instansi-card <?= $tanggalLampau ? 'is-history' : '' ?>"
                data-instansi-id="<?= $idInstansi ?>"
            >
                <div>
                    <div class="instansi-name">
                        <?= esc($namaInstansi) ?>
                    </div>

                    <div class="queue-info">
                        <div class="queue-number">
                            <?= $totalSelesaiInstansi ?>
                        </div>
                        <div class="queue-label">
                            layanan berhasil diselesaikan
                        </div>
                    </div>
                </div>

                <div class="instansi-status">
                    <span class="status-text <?= $isAktif ? 'on' : 'off' ?>">
                        <?= esc($statusLabel) ?>
                    </span>

                    <label class="switch">
                        <input
                            type="checkbox"
                            class="status-switch"
                            data-url="<?= esc(site_url('admin/instansi/' . $idInstansi . '/status')) ?>"
                            <?= $isAktif ? 'checked' : '' ?>
                            <?= $tanggalLampau ? 'disabled' : '' ?>
                            aria-label="Status pelayanan <?= esc($namaInstansi) ?>"
                        >
                        <span class="slider"></span>
                    </label>
                </div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>

<?= $this->endSection() ?>


<?= $this->section('scripts') ?>
<script>
(() => {
    document.querySelectorAll('.status-switch').forEach((input) => {
        input.addEventListener('change', async function () {
            const el = this;

            // Jangan proses switch yang dinonaktifkan.
            if (el.disabled) {
                return;
            }

            const card = el.closest('.instansi-card');
            if (!card) {
                return;
            }

            const statusText = card.querySelector('.status-text');
            const nameElement = card.querySelector('.instansi-name');

            if (!statusText || !el.dataset.url) {
                alert('Elemen status atau URL tidak ditemukan.');
                el.checked = !el.checked;
                return;
            }

            const statusSebelumnya = !el.checked;
            const statusBaru = el.checked ? 'Aktif' : 'Nonaktif';
            const nama = nameElement
                ? nameElement.textContent.trim()
                : 'instansi ini';

            if (!window.confirm(
                `Ubah status ${nama} menjadi ${statusBaru}?`
            )) {
                el.checked = statusSebelumnya;
                return;
            }

            el.disabled = true;

            try {
                const data = new URLSearchParams();
                data.set('status', statusBaru);

                const csrf = document.querySelector(
                    'input[name="<?= esc(csrf_token()) ?>"]'
                );

                if (csrf) {
                    data.set(csrf.name, csrf.value);
                }

                const response = await fetch(el.dataset.url, {
                    method: 'POST',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Content-Type': 'application/x-www-form-urlencoded'
                    },
                    body: data.toString()
                });

                const result = await response.json();

                if (!response.ok || !result.success) {
                    throw new Error(
                        result.message || 'Gagal menyimpan status.'
                    );
                }

                // Update UI setelah server berhasil menyimpan.
                const statusFinal = result.status || statusBaru;
                const isAktif = statusFinal === 'Aktif';

                el.checked = isAktif;
                statusText.textContent = statusFinal;
                statusText.classList.toggle('on', isAktif);
                statusText.classList.toggle('off', !isAktif);

                if (csrf && result.csrfHash) {
                    csrf.value = result.csrfHash;
                }
            } catch (error) {
                el.checked = statusSebelumnya;
                alert(error.message || 'Status gagal disimpan.');
            } finally {
                // Tanggal lampau tidak boleh mengaktifkan switch kembali.
                el.disabled = card.classList.contains('is-history');
            }
        });
    });
})();
</script>
<?= $this->endSection() ?>