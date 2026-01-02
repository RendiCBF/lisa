<?= $this->extend('layout/v_template') ?>
<?= $this->section('content') ?>
<div class="text-center">
    <div class="error mx-auto" data-text="403">403</div>
    <p class="lead text-gray-800 mb-5">Akses Ditolak</p>
    <p class="text-gray-500 mb-0">Maaf, Anda tidak memiliki izin untuk mengakses halaman ini.</p>
    <a href="<?= base_url('dashboard') ?>">&larr; Kembali ke Dashboard</a>
</div>
<?= $this->endSection() ?>