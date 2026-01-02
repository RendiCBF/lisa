
        <!-- Sidebar -->
                    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

                <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= base_url('dashboard') ?>">
                    <div class="sidebar-brand-icon rotate-n-15">
                        <i class="fas fa-store"></i>
                    </div>
                    <div class="sidebar-brand-text mx-3">Penjualan Ritel</div>
                </a>

                <hr class="sidebar-divider my-0">

                <li class="nav-item active">
                    <a class="nav-link" href="<?= base_url('dashboard') ?>">
                        <i class="fas fa-fw fa-tachometer-alt"></i>
                        <span>Dashboard Utama</span></a>
                </li>

                <hr class="sidebar-divider">
                <div class="sidebar-heading">Menu Aplikasi</div>

                <?php if (in_array(session()->get('role_nama'), ['admin', 'manager', 'staff'])): ?>
                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseData">
                        <i class="fas fa-fw fa-boxes"></i>
                        <span>Manajemen Barang</span>
                    </a>
                    <div id="collapseData" class="collapse" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <a class="collapse-item" href="<?= base_url('item') ?>">Daftar Item</a>
                            <a class="collapse-item" href="<?= base_url('supplier') ?>">Supplier</a>
                            <a class="collapse-item" href="<?= base_url('customer') ?>">Pelanggan</a>
                        </div>
                    </div>
                </li>
                <?php endif; ?>

                <?php if (in_array(session()->get('role_nama'), ['admin', 'manager', 'staff'])): ?>
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('orders') ?>">
                        <i class="fas fa-fw fa-cash-register"></i>
                        <span>Penjualan (Orders)</span></a>
                </li>
                <?php endif; ?>

                <?php if (session()->get('role_nama') == 'admin'): ?>
                <hr class="sidebar-divider">
                <div class="sidebar-heading">Administrasi</div>
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('user') ?>">
                        <i class="fas fa-fw fa-user-shield"></i>
                        <span>Manajemen User</span></a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('log_aktivitas') ?>">
                        <i class="fas fa-fw fa-history"></i>
                        <span>Audit Log</span></a>
                </li>
                <?php endif; ?>

                <hr class="sidebar-divider d-none d-md-block">

                <div class="text-center d-none d-md-inline">
                    <button class="rounded-circle border-0" id="sidebarToggle"></button>
                </div>

        </ul>
        <!-- End of Sidebar -->