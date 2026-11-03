<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login MPP</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <style>
        body {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #f1f5f9;
            font-family: Arial, sans-serif;
        }

        .login-card {
            width: 100%;
            max-width: 420px;
            padding: 32px;
            background: white;
            border-radius: 16px;
            box-shadow: 0 10px 35px rgba(0, 0, 0, .08);
        }

        .login-title {
            font-weight: 700;
            color: #1e293b;
        }
    </style>
</head>
<body>

<div class="login-card">
    <h3 class="login-title text-center mb-2">Login MPP</h3>
    <p class="text-secondary text-center mb-4">
        Masuk sebagai Admin atau Petugas
    </p>

    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger">
            <?= esc(session()->getFlashdata('error')) ?>
        </div>
    <?php endif; ?>

    <form action="<?= site_url('login') ?>" method="post">
        <?= csrf_field() ?>

        <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input
                type="text"
                class="form-control"
                id="username"
                name="username"
                required
                autofocus
                autocomplete="username"
            >
        </div>

        <div class="mb-4">
            <label for="password" class="form-label">Password</label>
            <input
                type="password"
                class="form-control"
                id="password"
                name="password"
                required
                autocomplete="current-password"
            >
        </div>

        <button type="submit" class="btn btn-primary w-100">
            Masuk
        </button>
    </form>
</div>

</body>
</html>