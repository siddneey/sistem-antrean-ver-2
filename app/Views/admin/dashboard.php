<?= $this->extend('layouts/admin') ?>

<?= $this->section('styles') ?>
<style>
/* =====================================================
           INSTANSI GRID
        ===================================================== */

        .instansi-grid {
            display: grid;

            grid-template-columns:
                repeat(4, minmax(0, 1fr));

            gap: 16px;
        }


        /* =====================================================
           INSTANSI CARD
        ===================================================== */

        .instansi-card {
            min-height: 145px;

            background: var(--white);

            border: 1px solid var(--border);

            border-radius: 12px;

            padding: 18px 19px;

            display: flex;

            flex-direction: column;

            justify-content: space-between;

            transition:
                transform 0.2s ease,
                box-shadow 0.2s ease,
                border-color 0.2s ease;
        }


        .instansi-card:hover {
            transform: translateY(-2px);

            border-color: #d6dce4;

            box-shadow:
                0 6px 18px rgba(16,35,63,0.06);
        }


        .instansi-name {
            color: var(--navy);

            font-size: 15px;

            font-weight: 700;

            line-height: 1.4;
        }


        /* Jumlah antrean */

        .queue-info {
            margin-top: 9px;
        }


        .queue-number {
            color: var(--text);

            font-size: 25px;

            line-height: 1;

            font-weight: 700;
        }


        .queue-label {
            color: var(--muted);

            font-size: 11px;

            margin-top: 5px;
        }


        /* =========================
           STATUS
        ========================= */

        .instansi-status {
            display: flex;

            align-items: center;

            justify-content: space-between;

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


        /* =====================================================
           SWITCH
        ===================================================== */

        .switch {
            position: relative;

            display: inline-block;

            width: 42px;

            height: 22px;
        }


        .switch input {
            opacity: 0;

            width: 0;
            height: 0;
        }


        .slider {
            position: absolute;

            inset: 0;

            background: #cdd3da;

            border-radius: 30px;

            cursor: pointer;

            transition:
                background 0.25s ease;
        }


        .slider:before {
            content: "";

            position: absolute;

            width: 16px;
            height: 16px;

            left: 3px;
            top: 3px;

            background: white;

            border-radius: 50%;

            box-shadow:
                0 1px 3px rgba(0,0,0,0.18);

            transition:
                transform 0.25s cubic-bezier(0.4, 0, 0.2, 1);
        }


        .switch input:checked + .slider {
            background: var(--green);
        }


        .switch input:checked + .slider:before {
            transform: translateX(20px);
        }


        /* =====================================================
           RESPONSIVE
        ===================================================== */

        @media (max-width: 1200px) {

            .instansi-grid {
                grid-template-columns:
                    repeat(3, minmax(0, 1fr));
            }

        }


        @media (max-width: 900px) {

            .instansi-grid {
                grid-template-columns:
                    repeat(2, minmax(0, 1fr));
            }

            .content {
                padding: 24px;
            }

        }


        @media (max-width: 700px) {

            .sidebar {
                width: var(--sidebar-width);

                transform: translateX(-100%);

                box-shadow:
                    5px 0 25px rgba(0,0,0,0.15);
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


            .date-input {
                width: 140px;
            }


            .content {
                padding: 20px;
            }


            .instansi-grid {
                grid-template-columns: 1fr;
            }

        }


        @media (max-width: 430px) {

            .topbar {
                justify-content: space-between;
            }


            .logout-btn span {
                display: none;
            }


            .logout-btn {
                width: 40px;

                padding: 0;

                justify-content: center;
            }


            .date-input {
                width: 135px;
            }

        }

    
</style>
<?= $this->endSection() ?>

<?= $this->section('pageTitle') ?>
<div class="page-title">
    <h4>Dashboard</h4>
    <p>Pantau layanan dan jumlah antrean setiap instansi.</p>
</div>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="instansi-grid">


                <!-- 1 -->
                <div class="instansi-card">

                    <div>
                        <div class="instansi-name">
                            SAMSAT
                        </div>

                        <div class="queue-info">

                            <div class="queue-number">
                                32
                            </div>

                            <div class="queue-label">
                                antrean berhasil dilayani
                            </div>

                        </div>
                    </div>


                    <div class="instansi-status">

                        <span class="status-text on">
                            Aktif
                        </span>

                        <label class="switch">

                            <input
                                type="checkbox"
                                checked
                                onchange="ubahStatus(this)"
                            >

                            <span class="slider"></span>

                        </label>

                    </div>

                </div>



                <!-- 2 -->
                <div class="instansi-card">

                    <div>

                        <div class="instansi-name">
                            BAPENDA
                        </div>

                        <div class="queue-info">

                            <div class="queue-number">
                                25
                            </div>

                            <div class="queue-label">
                                antrean berhasil dilayani
                            </div>

                        </div>

                    </div>


                    <div class="instansi-status">

                        <span class="status-text on">
                            Aktif
                        </span>

                        <label class="switch">

                            <input
                                type="checkbox"
                                checked
                                onchange="ubahStatus(this)"
                            >

                            <span class="slider"></span>

                        </label>

                    </div>

                </div>



                <!-- 3 -->
                <div class="instansi-card">

                    <div>

                        <div class="instansi-name">
                            DUKCAPIL
                        </div>

                        <div class="queue-info">

                            <div class="queue-number">
                                18
                            </div>

                            <div class="queue-label">
                                antrean berhasil dilayani
                            </div>

                        </div>

                    </div>


                    <div class="instansi-status">

                        <span class="status-text off">
                            Nonaktif
                        </span>

                        <label class="switch">

                            <input
                                type="checkbox"
                                onchange="ubahStatus(this)"
                            >

                            <span class="slider"></span>

                        </label>

                    </div>

                </div>



                <!-- 4 -->
                <div class="instansi-card">

                    <div>

                        <div class="instansi-name">
                            BPJS Kesehatan
                        </div>

                        <div class="queue-info">

                            <div class="queue-number">
                                12
                            </div>

                            <div class="queue-label">
                                antrean berhasil dilayani
                            </div>

                        </div>

                    </div>


                    <div class="instansi-status">

                        <span class="status-text on">
                            Aktif
                        </span>

                        <label class="switch">

                            <input
                                type="checkbox"
                                checked
                                onchange="ubahStatus(this)"
                            >

                            <span class="slider"></span>

                        </label>

                    </div>

                </div>



                <!-- 5 -->
                <div class="instansi-card">

                    <div>

                        <div class="instansi-name">
                            BPJS Ketenagakerjaan
                        </div>

                        <div class="queue-info">

                            <div class="queue-number">
                                21
                            </div>

                            <div class="queue-label">
                                antrean berhasil dilayani
                            </div>

                        </div>

                    </div>


                    <div class="instansi-status">

                        <span class="status-text on">
                            Aktif
                        </span>

                        <label class="switch">
                            <input type="checkbox" checked onchange="ubahStatus(this)">
                            <span class="slider"></span>
                        </label>

                    </div>

                </div>



                <!-- 6 -->
                <div class="instansi-card">

                    <div>

                        <div class="instansi-name">
                            Dinas Kesehatan
                        </div>

                        <div class="queue-info">

                            <div class="queue-number">
                                17
                            </div>

                            <div class="queue-label">
                                antrean berhasil dilayani
                            </div>

                        </div>

                    </div>


                    <div class="instansi-status">

                        <span class="status-text on">
                            Aktif
                        </span>

                        <label class="switch">
                            <input type="checkbox" checked onchange="ubahStatus(this)">
                            <span class="slider"></span>
                        </label>

                    </div>

                </div>



                <!-- 7 -->
                <div class="instansi-card">

                    <div>

                        <div class="instansi-name">
                            Dinas Sosial
                        </div>

                        <div class="queue-info">

                            <div class="queue-number">
                                14
                            </div>

                            <div class="queue-label">
                                antrean berhasil dilayani
                            </div>

                        </div>

                    </div>


                    <div class="instansi-status">

                        <span class="status-text on">
                            Aktif
                        </span>

                        <label class="switch">
                            <input type="checkbox" checked onchange="ubahStatus(this)">
                            <span class="slider"></span>
                        </label>

                    </div>

                </div>



                <!-- 8 -->
                <div class="instansi-card">

                    <div>

                        <div class="instansi-name">
                            Dinas Tenaga Kerja
                        </div>

                        <div class="queue-info">

                            <div class="queue-number">
                                19
                            </div>

                            <div class="queue-label">
                                antrean berhasil dilayani
                            </div>

                        </div>

                    </div>


                    <div class="instansi-status">

                        <span class="status-text on">
                            Aktif
                        </span>

                        <label class="switch">
                            <input type="checkbox" checked onchange="ubahStatus(this)">
                            <span class="slider"></span>
                        </label>

                    </div>

                </div>



                <!-- 9 -->
                <div class="instansi-card">

                    <div>
                        <div class="instansi-name">
                            Dinas Pendidikan
                        </div>

                        <div class="queue-info">
                            <div class="queue-number">
                                16
                            </div>
                            <div class="queue-label">
                                antrean berhasil dilayani
                            </div>
                        </div>
                    </div>

                    <div class="instansi-status">
                        <span class="status-text on">Aktif</span>

                        <label class="switch">
                            <input type="checkbox" checked onchange="ubahStatus(this)">
                            <span class="slider"></span>
                        </label>
                    </div>

                </div>



                <!-- 10 -->
                <div class="instansi-card">

                    <div>
                        <div class="instansi-name">
                            DPMPTSP
                        </div>

                        <div class="queue-info">
                            <div class="queue-number">
                                28
                            </div>
                            <div class="queue-label">
                                antrean berhasil dilayani
                            </div>
                        </div>
                    </div>

                    <div class="instansi-status">
                        <span class="status-text on">Aktif</span>

                        <label class="switch">
                            <input type="checkbox" checked onchange="ubahStatus(this)">
                            <span class="slider"></span>
                        </label>
                    </div>

                </div>



                <!-- 11 -->
                <div class="instansi-card">

                    <div>
                        <div class="instansi-name">
                            Pengadilan Negeri
                        </div>

                        <div class="queue-info">
                            <div class="queue-number">
                                11
                            </div>
                            <div class="queue-label">
                                antrean berhasil dilayani
                            </div>
                        </div>
                    </div>

                    <div class="instansi-status">
                        <span class="status-text on">Aktif</span>

                        <label class="switch">
                            <input type="checkbox" checked onchange="ubahStatus(this)">
                            <span class="slider"></span>
                        </label>
                    </div>

                </div>



                <!-- 12 -->
                <div class="instansi-card">

                    <div>
                        <div class="instansi-name">
                            Kejaksaan Negeri
                        </div>

                        <div class="queue-info">
                            <div class="queue-number">
                                13
                            </div>
                            <div class="queue-label">
                                antrean berhasil dilayani
                            </div>
                        </div>
                    </div>

                    <div class="instansi-status">
                        <span class="status-text on">Aktif</span>

                        <label class="switch">
                            <input type="checkbox" checked onchange="ubahStatus(this)">
                            <span class="slider"></span>
                        </label>
                    </div>

                </div>



                <!-- 13 -->
                <div class="instansi-card">

                    <div>
                        <div class="instansi-name">
                            Kepolisian
                        </div>

                        <div class="queue-info">
                            <div class="queue-number">
                                20
                            </div>
                            <div class="queue-label">
                                antrean berhasil dilayani
                            </div>
                        </div>
                    </div>

                    <div class="instansi-status">
                        <span class="status-text on">Aktif</span>

                        <label class="switch">
                            <input type="checkbox" checked onchange="ubahStatus(this)">
                            <span class="slider"></span>
                        </label>
                    </div>

                </div>



                <!-- 14 -->
                <div class="instansi-card">

                    <div>
                        <div class="instansi-name">
                            Imigrasi
                        </div>

                        <div class="queue-info">
                            <div class="queue-number">
                                9
                            </div>
                            <div class="queue-label">
                                antrean berhasil dilayani
                            </div>
                        </div>
                    </div>

                    <div class="instansi-status">
                        <span class="status-text on">Aktif</span>

                        <label class="switch">
                            <input type="checkbox" checked onchange="ubahStatus(this)">
                            <span class="slider"></span>
                        </label>
                    </div>

                </div>



                <!-- 15 -->
                <div class="instansi-card">

                    <div>
                        <div class="instansi-name">
                            Kementerian Agama
                        </div>

                        <div class="queue-info">
                            <div class="queue-number">
                                8
                            </div>
                            <div class="queue-label">
                                antrean berhasil dilayani
                            </div>
                        </div>
                    </div>

                    <div class="instansi-status">
                        <span class="status-text on">Aktif</span>

                        <label class="switch">
                            <input type="checkbox" checked onchange="ubahStatus(this)">
                            <span class="slider"></span>
                        </label>
                    </div>

                </div>



                <!-- 16 -->
                <div class="instansi-card">

                    <div>
                        <div class="instansi-name">
                            PLN
                        </div>

                        <div class="queue-info">
                            <div class="queue-number">
                                15
                            </div>
                            <div class="queue-label">
                                antrean berhasil dilayani
                            </div>
                        </div>
                    </div>

                    <div class="instansi-status">
                        <span class="status-text on">Aktif</span>

                        <label class="switch">
                            <input type="checkbox" checked onchange="ubahStatus(this)">
                            <span class="slider"></span>
                        </label>
                    </div>

                </div>



                <!-- 17 -->
                <div class="instansi-card">

                    <div>
                        <div class="instansi-name">
                            PDAM Tirta Benteng
                        </div>

                        <div class="queue-info">
                            <div class="queue-number">
                                10
                            </div>
                            <div class="queue-label">
                                antrean berhasil dilayani
                            </div>
                        </div>
                    </div>

                    <div class="instansi-status">
                        <span class="status-text on">Aktif</span>

                        <label class="switch">
                            <input type="checkbox" checked onchange="ubahStatus(this)">
                            <span class="slider"></span>
                        </label>
                    </div>

                </div>



                <!-- 18 -->
                <div class="instansi-card">

                    <div>
                        <div class="instansi-name">
                            BPHTB
                        </div>

                        <div class="queue-info">
                            <div class="queue-number">
                                7
                            </div>
                            <div class="queue-label">
                                antrean berhasil dilayani
                            </div>
                        </div>
                    </div>

                    <div class="instansi-status">
                        <span class="status-text on">Aktif</span>

                        <label class="switch">
                            <input type="checkbox" checked onchange="ubahStatus(this)">
                            <span class="slider"></span>
                        </label>
                    </div>

                </div>



                <!-- 19 -->
                <div class="instansi-card">

                    <div>
                        <div class="instansi-name">
                            Kantor Pos
                        </div>

                        <div class="queue-info">
                            <div class="queue-number">
                                12
                            </div>
                            <div class="queue-label">
                                antrean berhasil dilayani
                            </div>
                        </div>
                    </div>

                    <div class="instansi-status">
                        <span class="status-text on">Aktif</span>

                        <label class="switch">
                            <input type="checkbox" checked onchange="ubahStatus(this)">
                            <span class="slider"></span>
                        </label>
                    </div>

                </div>



                <!-- 20 -->
                <div class="instansi-card">

                    <div>
                        <div class="instansi-name">
                            Pegadaian
                        </div>

                        <div class="queue-info">
                            <div class="queue-number">
                                18
                            </div>
                            <div class="queue-label">
                                antrean berhasil dilayani
                            </div>
                        </div>
                    </div>

                    <div class="instansi-status">
                        <span class="status-text on">Aktif</span>

                        <label class="switch">
                            <input type="checkbox" checked onchange="ubahStatus(this)">
                            <span class="slider"></span>
                        </label>
                    </div>

                </div>



                <!-- 21 -->
                <div class="instansi-card">

                    <div>
                        <div class="instansi-name">
                            Bank BJB
                        </div>

                        <div class="queue-info">
                            <div class="queue-number">
                                16
                            </div>
                            <div class="queue-label">
                                antrean berhasil dilayani
                            </div>
                        </div>
                    </div>

                    <div class="instansi-status">
                        <span class="status-text on">Aktif</span>

                        <label class="switch">
                            <input type="checkbox" checked onchange="ubahStatus(this)">
                            <span class="slider"></span>
                        </label>
                    </div>

                </div>



                <!-- 22 -->
                <div class="instansi-card">

                    <div>
                        <div class="instansi-name">
                            BPOM
                        </div>

                        <div class="queue-info">
                            <div class="queue-number">
                                6
                            </div>
                            <div class="queue-label">
                                antrean berhasil dilayani
                            </div>
                        </div>
                    </div>

                    <div class="instansi-status">
                        <span class="status-text on">Aktif</span>

                        <label class="switch">
                            <input type="checkbox" checked onchange="ubahStatus(this)">
                            <span class="slider"></span>
                        </label>
                    </div>

                </div>



                <!-- 23 -->
                <div class="instansi-card">

                    <div>
                        <div class="instansi-name">
                            Ketenagakerjaan
                        </div>

                        <div class="queue-info">
                            <div class="queue-number">
                                9
                            </div>
                            <div class="queue-label">
                                antrean berhasil dilayani
                            </div>
                        </div>
                    </div>

                    <div class="instansi-status">
                        <span class="status-text on">Aktif</span>

                        <label class="switch">
                            <input type="checkbox" checked onchange="ubahStatus(this)">
                            <span class="slider"></span>
                        </label>
                    </div>

                </div>



                <!-- 24 -->
                <div class="instansi-card">

                    <div>
                        <div class="instansi-name">
                            KUA
                        </div>

                        <div class="queue-info">
                            <div class="queue-number">
                                8
                            </div>
                            <div class="queue-label">
                                antrean berhasil dilayani
                            </div>
                        </div>
                    </div>

                    <div class="instansi-status">
                        <span class="status-text on">Aktif</span>

                        <label class="switch">
                            <input type="checkbox" checked onchange="ubahStatus(this)">
                            <span class="slider"></span>
                        </label>
                    </div>

                </div>



                <!-- 25 -->
                <div class="instansi-card">

                    <div>
                        <div class="instansi-name">
                            Dinas Perhubungan
                        </div>

                        <div class="queue-info">
                            <div class="queue-number">
                                14
                            </div>
                            <div class="queue-label">
                                antrean berhasil dilayani
                            </div>
                        </div>
                    </div>

                    <div class="instansi-status">
                        <span class="status-text on">Aktif</span>

                        <label class="switch">
                            <input type="checkbox" checked onchange="ubahStatus(this)">
                            <span class="slider"></span>
                        </label>
                    </div>

                </div>



                <!-- 26 -->
                <div class="instansi-card">

                    <div>
                        <div class="instansi-name">
                            Dinas Perumahan
                        </div>

                        <div class="queue-info">
                            <div class="queue-number">
                                11
                            </div>
                            <div class="queue-label">
                                antrean berhasil dilayani
                            </div>
                        </div>
                    </div>

                    <div class="instansi-status">
                        <span class="status-text on">Aktif</span>

                        <label class="switch">
                            <input type="checkbox" checked onchange="ubahStatus(this)">
                            <span class="slider"></span>
                        </label>
                    </div>

                </div>



                <!-- 27 -->
                <div class="instansi-card">

                    <div>
                        <div class="instansi-name">
                            Dinas Lingkungan Hidup
                        </div>

                        <div class="queue-info">
                            <div class="queue-number">
                                13
                            </div>
                            <div class="queue-label">
                                antrean berhasil dilayani
                            </div>
                        </div>
                    </div>

                    <div class="instansi-status">
                        <span class="status-text on">Aktif</span>

                        <label class="switch">
                            <input type="checkbox" checked onchange="ubahStatus(this)">
                            <span class="slider"></span>
                        </label>
                    </div>

                </div>



                <!-- 28 -->
                <div class="instansi-card">

                    <div>
                        <div class="instansi-name">
                            Dinas Ketahanan Pangan
                        </div>

                        <div class="queue-info">
                            <div class="queue-number">
                                10
                            </div>
                            <div class="queue-label">
                                antrean berhasil dilayani
                            </div>
                        </div>
                    </div>

                    <div class="instansi-status">
                        <span class="status-text on">Aktif</span>

                        <label class="switch">
                            <input type="checkbox" checked onchange="ubahStatus(this)">
                            <span class="slider"></span>
                        </label>
                    </div>

                </div>

            </div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
    function ubahStatus(input) {
        const card = input.closest('.instansi-card');
        if (!card) return;

        const status = card.querySelector('.status-text');
        const namaElement = card.querySelector('.instansi-name');
        const namaInstansi = namaElement ? namaElement.textContent.trim() : 'instansi ini';
        const statusBaru = input.checked ? 'Aktif' : 'Nonaktif';

        if (!window.confirm(`Apakah Anda yakin ingin mengubah status ${namaInstansi} menjadi ${statusBaru}?`)) {
            input.checked = !input.checked;
            return;
        }

        if (status) {
            status.textContent = statusBaru;
            status.classList.toggle('on', input.checked);
            status.classList.toggle('off', !input.checked);
        }
    }

    const tanggal = document.getElementById('tanggal');
    if (tanggal) {
        tanggal.addEventListener('change', function () {
            console.log('Tanggal yang dipilih:', this.value);
        });
    }
</script>
<?= $this->endSection() ?>
