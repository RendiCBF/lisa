<?= $this->extend('layouts/admin_master') ?>

<?= $this->section('main_content') ?>
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Transaksi Baru (Multi-Item)</h6>
        </div>
        <div class="card-body">
            <form action="<?= base_url('order/store') ?>" method="post">
                <?= csrf_field() ?>
                
                <div class="col-md-4">
                    <label>Pilih Pelanggan</label>
                    <select name="customer_id" class="form-control" required>
                        <option value="">-- Pilih Pelanggan --</option>
                        <?php foreach($customers as $c) : ?>
                            <option value="<?= $c['id'] ?>"><?= $c['nama'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <table class="table table-bordered" id="orderTable">
                    <thead>
                        <tr>
                            <th width="40%">Produk</th>
                            <th>Harga Satuan</th>
                            <th width="10%">Qty</th>
                            <th>Subtotal</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="item-list">
                        <tr class="baris-item">
                            <td>
                                <select name="items[0][item_id]" class="form-control pilih-barang" required>
                                    <option value="">-- Pilih Barang --</option>
                                    <?php foreach($items as $i) : ?>
                                        <option value="<?= $i['id'] ?>" data-harga="<?= $i['harga'] ?>" data-stok="<?= $i['stok'] ?>">
                                            <?= $i['nama'] ?> (Stok: <?= $i['stok'] ?>)
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </td>
                            <td>
                                <input type="number" name="items[0][harga]" class="form-control harga-input" readonly>
                            </td>
                            <td>
                                <input type="number" name="items[0][qty]" class="form-control qty-input" min="1" required>
                            </td>
                            <td>
                                <input type="number" name="items[0][subtotal]" class="form-control subtotal-input" readonly>
                            </td>
                            <td>
                                <button type="button" class="btn btn-danger btn-sm remove-row">x</button>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <button type="button" class="btn btn-success btn-sm" id="add-item">
                    <i class="fas fa-plus"></i> Tambah Baris
                </button>

                <hr>
                <div class="row justify-content-end">
                    <div class="col-md-4">
                        <h4>Total: Rp <span id="grand-total-text">0</span></h4>
                        <button type="submit" class="btn btn-primary btn-block mt-3">Simpan Transaksi</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
let rowCount = 1;

// Tambah baris baru
document.getElementById('add-item').addEventListener('click', function() {
    let tbody = document.getElementById('item-list');
    let newRow = document.querySelector('.baris-item').cloneNode(true);
    
    // Update index nama input agar tidak bentrok
    newRow.querySelectorAll('select, input').forEach(input => {
        input.name = input.name.replace('[0]', '[' + rowCount + ']');
        input.value = '';
    });
    newRow.querySelector('.subtotal-input').value = 0;
    
    tbody.appendChild(newRow);
    rowCount++;
});

// Hapus baris
document.addEventListener('click', function(e) {
    if (e.target.classList.contains('remove-row')) {
        if (document.querySelectorAll('.baris-item').length > 1) {
            e.target.closest('tr').remove();
            hitungTotal();
        }
    }
});

// Perhitungan Otomatis
document.addEventListener('input', function(e) {
    let row = e.target.closest('tr');
    
    if (e.target.classList.contains('pilih-barang')) {
        let harga = e.target.options[e.target.selectedIndex].dataset.harga;
        row.querySelector('.harga-input').value = harga;
    }
    
    if (e.target.classList.contains('qty-input') || e.target.classList.contains('pilih-barang')) {
        let qty = row.querySelector('.qty-input').value || 0;
        let harga = row.querySelector('.harga-input').value || 0;
        let subtotal = qty * harga;
        row.querySelector('.subtotal-input').value = subtotal;
        hitungTotal();
    }
});

function hitungTotal() {
    let total = 0;
    document.querySelectorAll('.subtotal-input').forEach(input => {
        total += parseInt(input.value || 0);
    });
    document.getElementById('grand-total-text').innerText = new Intl.NumberFormat('id-ID').format(total);
}
</script>
<?= $this->endSection() ?>