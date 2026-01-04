<?= $this->extend('layouts/admin_master') ?>

<?= $this->section('main_content') ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Tambah Supplier Baru</h6>
                </div>
                <div class="card-body">
                    
                    <?php if (session()->getFlashdata('errors')) : ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>Periksa kembali!</strong>
                            <ul>
                                <?php foreach (session()->getFlashdata('errors') as $error) : ?>
                                    <li><?= $error ?></li>
                                <?php endforeach; ?>
                            </ul>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    <?php endif; ?>

                    <form action="<?= base_url('supplier/store') ?>" method="post">
                        <?= csrf_field() ?>
                        
                        <div class="form-group">
                            <label for="nama">Nama Supplier</label>
                            <input type="text" name="nama" class="form-control" id="nama" value="<?= old('nama') ?>" placeholder="Contoh: PT. Sumber Makmur" required>
                            <small class="text-muted">Nama harus unik dan minimal 3 karakter.</small>
                        </div>

                        <div class="form-group">
                            <label for="kontak">Kontak Person</label>
                            <input type="text" name="kontak" class="form-control" id="kontak" value="<?= old('kontak') ?>" placeholder="Nama penanggung jawab" required>
                        </div>

                        <div class="form-group">
                            <label for="no_telepon">No. Telepon</label>
                            <input type="text" name="no_telepon" class="form-control" id="no_telepon" value="<?= old('no_telepon') ?>" placeholder="Contoh: 08123456789" required>
                        </div>

                        <hr>
                        <a href="<?= base_url('supplier') ?>" class="btn btn-secondary">Batal</a>
                        <button type="submit" class="btn btn-primary">Simpan Data</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>