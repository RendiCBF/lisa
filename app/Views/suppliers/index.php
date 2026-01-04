<?= $this->extend('layouts/admin_master') ?>

<?= $this->section('main_content') ?>
<div class="container-fluid">

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Data Supplier</h1>
        <a href="<?= base_url('supplier/create') ?>" class="btn btn-primary btn-sm shadow-sm">
            <i class="fas fa-plus fa-sm text-white-50"></i> Tambah Supplier
        </a>
    </div>

    <?php if (session()->getFlashdata('success')) : ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?= session()->getFlashdata('success') ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php endif; ?>

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Daftar Pemasok</h6>
            
            <form action="<?= base_url('supplier') ?>" method="get" class="form-inline">
                <div class="input-group">
                    <input type="text" name="keyword" class="form-control bg-light border-0 small" placeholder="Cari supplier..." value="<?= esc($keyword ?? '') ?>">
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="submit">
                            <i class="fas fa-search fa-sm"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead class="thead-light">
                        <tr>
                            <th width="5%">No</th>
                            <th>Nama Supplier</th>
                            <th>Kontak Person</th>
                            <th>No. Telepon</th>
                            <th>Terdaftar Pada</th>
                            <th width="15%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $no = 1 + (10 * ($pager->getCurrentPage('supplier') - 1));
                        foreach ($suppliers as $s) : ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><strong><?= esc($s['nama']) ?></strong></td>
                                <td><?= esc($s['kontak']) ?></td>
                                <td><?= esc($s['no_telepon']) ?></td>
                                <td><?= date('d/m/Y H:i', strtotime($s['created_at'])) ?></td>
                                <td>
                                    <a href="<?= base_url('supplier/edit/' . $s['id']) ?>" class="btn btn-warning btn-sm">
                                        <i class="fas fa-edit"></i>
                                    </a>

                                    <form action="<?= base_url('supplier/' . $s['id']) ?>" method="post" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data <?= esc($s['nama']) ?>?')">
                                        <?= csrf_field() ?>
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <div class="mt-3">
                <?= $pager->links('supplier', 'default_full') ?>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>