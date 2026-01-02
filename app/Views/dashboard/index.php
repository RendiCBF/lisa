<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Sistem Enterprise</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow">
    <div class="container">
        <a class="navbar-brand fw-bold" href="#">Sistem Ritel</a>
        <div class="d-flex">
            <span class="navbar-text text-white me-3">
                Halo, **<?= session()->get('nama') ?>** </span>
           <a href="<?= base_url('auth/logout') ?>" class="btn btn-danger">Keluar</a>
        </div>
    </div>
</nav>

<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-5 text-center">
                    <h1 class="display-4">Selamat Datang di Dashboard</h1>
                    <p class="lead text-muted">Anda berhasil login ke Sistem Enterprise Minggu 3.</p>
                    <hr class="my-4">
                    <p>Status Akun: <span class="badge bg-success">Aktif</span></p>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>