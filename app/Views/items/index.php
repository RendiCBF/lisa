<?= $this->extend('layouts/admin_master') ?>

<?= $this->section('main_content') ?>
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Master Data Barang</h1>
        <a href="<?= base_url('item/create') ?>" class="btn btn-primary btn-sm shadow-sm">
            <i class="fas fa-plus fa-sm text-white-50"></i> Tambah Barang
        </a>
    </div>

    <div class="card shadow mb-4">
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
                        <?php $no = 1; foreach ($items as $i) : ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= esc($i['nama']) ?></td>
                                <td><span class="badge badge-info"><?= esc($i['nama_supplier']) ?></span></td>
                                <td><?= $i['stok'] ?></td>
                                <td>Rp <?= number_format($i['harga'], 0, ',', '.') ?></td>
                                <td>
                                    <a href="<?= base_url('item/edit/' . $i['id']) ?>" class="btn btn-warning btn-sm">Edit</a>
                                    <form action="<?= base_url('item/' . $i['id']) ?>" method="post" class="d-inline" onsubmit="return confirm('Hapus barang ini?')">
                                        <?= csrf_field() ?>
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>