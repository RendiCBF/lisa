<?= $this->extend('layouts/admin_master') ?>

<?= $this->section('main_content') ?>
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Edit Item Barang</h6>
        </div>
        <div class="card-body">
            <form action="<?= base_url('item/update/' . $item['id']) ?>" method="post">
                <?= csrf_field() ?>
                
                <div class="form-group">
                    <label>Pilih Supplier</label>
                    <select name="supplier_id" class="form-control" required>
                        <?php foreach($suppliers as $s) : ?>
                            <option value="<?= $s['id'] ?>" <?= ($s['id'] == $item['supplier_id']) ? 'selected' : '' ?>>
                                <?= $s['nama'] ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label>Nama Barang</label>
                    <input type="text" name="nama" class="form-control" value="<?= $item['nama'] ?>" required>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Stok</label>
                            <input type="number" name="stok" class="form-control" value="<?= $item['stok'] ?>" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Harga (Rp)</label>
                            <input type="number" name="harga" class="form-control" value="<?= $item['harga'] ?>" required>
                        </div>
                    </div>
                </div>

                <hr>
                <a href="<?= base_url('item') ?>" class="btn btn-secondary">Batal</a>
                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection() ?>