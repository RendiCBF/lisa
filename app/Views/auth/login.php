<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sistem Enterprise</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        body { background-color: #f0f2f5; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        .container { min-height: 100vh; display: flex; align-items: center; justify-content: center; }
        .login-card { width: 100%; max-width: 400px; border: none; transition: all 0.3s; border-radius: 15px; }
        .login-card:hover { transform: translateY(-5px); }
        .btn-primary { background-color: #4e73df; border: none; padding: 12px; border-radius: 8px; }
        .btn-primary:hover { background-color: #2e59d9; }
        .input-group-text { border-radius: 8px 0 0 8px; }
        .form-control { border-radius: 0 8px 8px 0; }
    </style>
</head>
<body>

<div class="container">
    <div class="login-card shadow-lg p-4 bg-white">
        <div class="text-center mb-4">
            <i class="fas fa-user-circle fa-3x text-primary mb-3"></i>
            <h3 class="fw-bold">Login Sistem</h3>
            <p class="text-muted small">Silakan masuk untuk melanjutkan</p>
        </div>

        <div class="mb-3">
            <?php if (session()->getFlashdata('success')) : ?>
                <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm" role="alert">
                    <i class="fas fa-check-circle me-2"></i>
                    <?= session()->getFlashdata('success') ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>

            <?php if (session()->getFlashdata('error')) : ?>
                <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm" role="alert">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    <?= session()->getFlashdata('error') ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>
        </div>

        <form action="<?= base_url('auth/attemptLogin') ?>" method="post" autocomplete="off">
            <?= csrf_field() ?> 
            
            <div class="mb-3">
                <label for="username" class="form-label small fw-bold">Username</label>
                <div class="input-group">
                    <span class="input-group-text bg-light border-end-0"><i class="fas fa-user text-muted"></i></span>
                    <input type="text" name="username" class="form-control bg-light border-start-0" id="username" 
                           value="<?= old('username') ?>" placeholder="Masukkan username" required autofocus autocomplete="off">
                </div>
            </div>

            <div class="mb-4">
                <label for="password" class="form-label small fw-bold">Password</label>
                <div class="input-group">
                    <span class="input-group-text bg-light border-end-0"><i class="fas fa-lock text-muted"></i></span>
                    <input type="password" name="password" class="form-control bg-light border-start-0" id="password" 
                           placeholder="********" required autocomplete="new-password">
                </div>
            </div>

            <button type="submit" class="btn btn-primary w-100 fw-bold shadow-sm">
                <i class="fas fa-sign-in-alt me-2"></i> MASUK
            </button>
        </form>
        
        <div class="text-center mt-4 border-top pt-3">
            <small class="text-muted">Proyek Sistem Enterprise &copy; 2025</small>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>