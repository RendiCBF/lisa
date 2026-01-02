<?= $this->extend('layouts/admin_master') ?>

<?= $this->section('main_content') ?>
<div class="text-center mt-5">
    <div class="error mx-auto" data-text="403" style="font-size: 7rem; font-weight: 700; color: #5a5c69;">403</div>
    <p class="lead text-gray-800 mb-5">Akses Ditolak (Forbidden)</p>
    <p class="text-gray-500 mb-0">Maaf, Anda (Role: <?= session()->get('role_nama') ?>) tidak memiliki izin untuk melihat data ini.</p>
    <br>
    <a href="<?= base_url('dashboard') ?>" class="btn btn-primary">&larr; Kembali ke Dashboard</a>
</div>
<?= $this->endSection() ?>