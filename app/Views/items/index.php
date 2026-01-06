<?= $this->extend('layouts/admin_master') ?>

<?= $this->section('main_content') ?>
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Master Data Barang</h1>
        <a href="<?= base_url('item/create') ?>" class="btn btn-primary btn-sm shadow-sm">
            <i class="fas fa-plus fa-sm text-white-50"></i> Tambah Barang
        </a>
    </div>

    <?php if (session()->getFlashdata('success')) : ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Berhasil!</strong> <?= session()->getFlashdata('success') ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php endif; ?>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row">
                <div class="col-md-6">
                    <h6 class="m-0 font-weight-bold text-primary">Tabel Inventaris</h6>
                </div>
                <div class="col-md-6">
                    <form action="" method="get" class="form-inline float-right">
                        <div class="input-group">
                            <input type="text" name="keyword" class="form-control bg-light border-0 small" placeholder="Cari barang..." value="<?= $keyword ?? '' ?>">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="submit">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Barang</th>
                            <th>Supplier</th>
                            <th>Stok</th>
                            <th>Harga</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($items)) : ?>
                            <tr>
                                <td colspan="6" class="text-center">Data tidak ditemukan.</td>
                            </tr>
                        <?php else : ?>
                            <?php $no = 1 + (10 * (($pager->getCurrentPage('item') ?? 1) - 1)); 
                            foreach ($items as $i) : ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= esc($i['nama']) ?></td>
                                    <td><span class="badge badge-info"><?= esc($i['nama_supplier']) ?></span></td>
                                    <td><?= $i['stok'] ?></td>
                                    <td>Rp <?= number_format($i['harga'], 0, ',', '.') ?></td>
                                    <td>
                                        <a href="<?= base_url('item/edit/' . $i['id']) ?>" class="btn btn-warning btn-sm">Edit</a>
                                        <form action="<?= base_url('item/' . $i['id']) ?>" method="post" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus barang ini?')">
                                            <?= csrf_field() ?>
                                            <input type="hidden" name="_method" value="DELETE">
                                            <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
            <div class="mt-3">
                <?= $pager->links('item', 'default_full') ?>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>