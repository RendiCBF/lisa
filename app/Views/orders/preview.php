<?= $this->extend('layouts/admin_master') ?>

<?= $this->section('main_content') ?>
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary">Nota Transaksi #<?= $order['id'] ?></h6>
                    <button onclick="window.print()" class="btn btn-sm btn-secondary">
                        <i class="fas fa-print"></i> Cetak Nota
                    </button>
                </div>
                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-sm-6">
                            <h6 class="mb-3">Detail Transaksi:</h6>
                            <div><strong>No. Referensi:</strong> INV-<?= str_pad($order['id'], 5, '0', STR_PAD_LEFT) ?></div>
                            <div><strong>Tanggal:</strong> <?= date('d/m/Y H:i', strtotime($order['tanggal_order'])) ?></div>
                            <div><strong>Status:</strong> <span class="badge badge-success"><?= $order['status'] ?></span></div>
                        </div>
                    </div>

                    <div class="table-responsive-sm">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th class="center">#</th>
                                    <th>Item</th>
                                    <th class="right">Harga Satuan</th>
                                    <th class="center">Qty</th>
                                    <th class="right">Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; foreach($details as $d) : ?>
                                <tr>
                                    <td class="center"><?= $no++ ?></td>
                                    <td class="left font-weight-bold"><?= $d['nama_barang'] ?></td>
                                    <td class="right">Rp <?= number_format($d['harga_unit'], 0, ',', '.') ?></td>
                                    <td class="center"><?= $d['kuantitas'] ?></td>
                                    <td class="right">Rp <?= number_format($d['subtotal'], 0, ',', '.') ?></td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                        <div class="col-lg-4 col-sm-5 ml-auto">
                            <table class="table table-clear">
                                <tbody>
                                    <tr>
                                        <td class="left"><strong>Total Bayar</strong></td>
                                        <td class="right"><strong>Rp <?= number_format($order['jumlah_total'], 0, ',', '.') ?></strong></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-center">
                    <a href="<?= base_url('order/create') ?>" class="btn btn-primary">Transaksi Baru</a>
                    <a href="<?= base_url('item') ?>" class="btn btn-info">Cek Stok Barang</a>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>