<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Petugas</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f3f5f9;
            color: #172b4d;
        }

        .navbar {
            background: #10233f;
            color: white;
            padding: 18px 6%;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
        }

        .navbar h2 {
            margin: 0;
            font-size: 20px;
        }

        .logout-button {
            border: 0;
            border-radius: 7px;
            padding: 10px 15px;
            background: #dc3545;
            color: white;
            font-weight: bold;
            cursor: pointer;
        }

        .logout-button:hover {
            background: #bb2d3b;
        }

        .container {
            width: min(1100px, 90%);
            margin: 35px auto;
        }

        .welcome {
            padding: 28px;
            background: white;
            border-radius: 12px;
            box-shadow: 0 3px 15px rgba(0, 0, 0, .04);
        }

        .welcome h1 {
            margin-top: 0;
            font-size: 26px;
        }

        .welcome p {
            color: #667085;
            line-height: 1.6;
        }

        .cards {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 18px;
            margin-top: 22px;
        }

        .card {
            background: white;
            padding: 22px;
            border-radius: 12px;
            border: 1px solid #e5e9f0;
        }

        .card h3 {
            margin-top: 0;
            font-size: 16px;
        }

        .card p {
            color: #667085;
            font-size: 14px;
            line-height: 1.6;
        }

        .notice {
            margin-top: 22px;
            padding: 16px;
            background: #fff8dc;
            border-radius: 8px;
            color: #735d09;
            font-size: 14px;
            line-height: 1.6;
        }

        @media (max-width: 700px) {
            .navbar {
                padding: 16px 5%;
            }

            .navbar h2 {
                font-size: 16px;
            }

            .cards {
                grid-template-columns: 1fr;
            }

            .welcome h1 {
                font-size: 22px;
            }
        }
    </style>
</head>

<body>

    <header class="navbar">
        <h2>Dashboard Petugas</h2>

        <form action="<?= site_url('logout') ?>" method="post">
            <?= csrf_field() ?>

            <button type="submit" class="logout-button">
                Logout
            </button>
        </form>
    </header>

    <main class="container">

        <section class="welcome">
            <h1>
                Halo, <?= esc(session()->get('username') ?? 'Petugas') ?>!
            </h1>

            <p>
                Selamat datang di dashboard petugas pelayanan.
                Gunakan halaman ini untuk mengakses pengelolaan antrean.
            </p>
        </section>

        <section class="cards">

            <div class="card">
                <h3>Antrean Menunggu</h3>
                <p>
                    Halaman untuk melihat antrean yang masih menunggu
                    giliran pelayanan.
                </p>
            </div>

            <div class="card">
                <h3>Antrean Dilayani</h3>
                <p>
                    Halaman untuk memantau antrean yang sedang diproses.
                </p>
            </div>

            <div class="card">
                <h3>Riwayat Antrean</h3>
                <p>
                    Pengembangan halaman riwayat pelayanan dapat
                    ditambahkan setelah dashboard dasar selesai.
                </p>
            </div>

        </section>

        <div class="notice">
            <strong>Catatan:</strong> Ini dashboard sementara untuk
            memastikan halaman petugas bisa dibuka dan logout berfungsi.
            Kartu di atas belum terhubung dengan data antrean.
        </div>

    </main>

</body>
</html>