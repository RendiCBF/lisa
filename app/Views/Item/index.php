<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Data Produk - Ritel Lisa</title>
    
    <link href="<?= base_url('assets/vendor/fontawesome-free/css/all.min.css') ?>" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="<?= base_url('assets/css/sb-admin-2.min.css') ?>" rel="stylesheet">
    
    <link href="<?= base_url('assets/vendor/datatables/dataTables.bootstrap4.min.css') ?>" rel="stylesheet">
</head>

<body id="page-top">

    <div id="wrapper">

        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= base_url('dashboard') ?>">
                <div class="sidebar-brand-icon rotate-n-15"><i class="fas fa-store"></i></div>
                <div class="sidebar-brand-text mx-3">Ritel Lisa</div>
            </a>
            <hr class="sidebar-divider my-0">
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url('dashboard') ?>">
                    <i class="fas fa-fw fa-tachometer-alt"></i><span>Dashboard</span></a>
            </li>
            <hr class="sidebar-divider">
            <div class="sidebar-heading">Master Data</div>
            <li class="nav-item active">
                <a class="nav-link" href="<?= base_url('item') ?>">
                    <i class="fas fa-fw fa-box"></i><span>Data Produk</span></a>
            </li>
            </ul>

        <div id="content-wrapper" class="d-flex flex-column">

            <div id="content">

                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">Administrator</span>
                                <img class="img-profile rounded-circle" src="<?= base_url('assets/img/undraw_profile.svg') ?>">
                            </a>
                        </li>
                    </ul>
                </nav>

                <div class="container-fluid">

                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Manajemen Produk (Item)</h1>
                        <button class="btn btn-primary btn-sm shadow-sm" data-toggle="modal" data-target="#addModal">
                            <i class="fas fa-plus fa-sm text-white-50"></i> Tambah Produk
                        </button>
                    </div>

                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Daftar Persediaan Barang</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Nama Produk</th>
                                            <th>Kategori</th>
                                            <th class="text-center">Stok</th>
                                            <th>Harga Beli</th>
                                            <th>Harga Jual</th>
                                            <th class="text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if(!empty($items)): foreach ($items as $i) : ?>
                                        <tr>
                                            <td><?= $i['id']; ?></td>
                                            <td><?= $i['nama_item']; ?></td>
                                            <td><?= $i['kategori']; ?></td>
                                            <td class="text-center">
                                                <span class="badge <?= $i['stok'] < 10 ? 'badge-danger' : 'badge-success'; ?>">
                                                    <?= $i['stok']; ?>
                                                </span>
                                            </td>
                                            <td>Rp <?= number_format($i['harga_beli'], 0, ',', '.'); ?></td>
                                            <td>Rp <?= number_format($i['harga_jual'], 0, ',', '.'); ?></td>
                                            <td class="text-center">
                                                <a href="#" class="btn btn-warning btn-sm btn-circle" title="Edit"><i class="fas fa-edit"></i></a>
                                                <a href="#" class="btn btn-danger btn-sm btn-circle" title="Hapus"><i class="fas fa-trash"></i></a>
                                            </td>
                                        </tr>
                                        <?php endforeach; else: ?>
                                            <tr><td colspan="7" class="text-center">Tidak ada data barang.</td></tr>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
                </div>
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Nurhalisa 2025</span>
                    </div>
                </div>
            </footer>

        </div>
        </div>
    <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Produk Baru</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form action="<?= base_url('item/add') ?>" method="POST">
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Nama Item</label>
                            <input type="text" name="nama_item" class="form-control" placeholder="Contoh: Beras 5kg" required>
                        </div>
                        <div class="form-group">
                            <label>Kategori</label>
                            <select name="kategori" class="form-control">
                                <option value="Makanan">Makanan</option>
                                <option value="Minuman">Minuman</option>
                                <option value="Elektronik">Elektronik</option>
                                <option value="Lainnya">Lainnya</option>
                            </select>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label>Harga Beli</label>
                                <input type="number" name="harga_beli" class="form-control" placeholder="0" required>
                            </div>
                            <div class="col-md-6">
                                <label>Harga Jual</label>
                                <input type="number" name="harga_jual" class="form-control" placeholder="0" required>
                            </div>
                        </div>
                        <div class="form-group mt-3">
                            <label>Stok Awal</label>
                            <input type="number" name="stok" class="form-control" value="0" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                        <button class="btn btn-primary" type="submit">Simpan Produk</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <script src="<?= base_url('assets/vendor/jquery/jquery.min.js') ?>"></script>
    <script src="<?= base_url('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>

    <script src="<?= base_url('assets/vendor/jquery-easing/jquery.easing.min.js') ?>"></script>

    <script src="<?= base_url('assets/js/sb-admin-2.min.js') ?>"></script>

    <script src="<?= base_url('assets/vendor/datatables/jquery.dataTables.min.js') ?>"></script>
    <script src="<?= base_url('assets/vendor/datatables/dataTables.bootstrap4.min.js') ?>"></script>

    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable({
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.21/i18n/Indonesian.json"
                }
            });
        });
    </script>

</body>

</html>