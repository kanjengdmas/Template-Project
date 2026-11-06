        <!-- Sidebar -->
        <nav class="sidebar py-3 d-none d-md-block">
            <div class="text-center mb-4 px-3">
                <h4 class="fw-bold m-0"><i class="fas fa-tools me-2"></i>Sipanja</h4>
                <small class="text-white-50">Sistem Peminjaman Alat</small>
            </div>
            <ul class="list-unstyled">
                <?php $role = $this->session->userdata('role'); ?>
                
                <li><a href="<?= base_url('dashboard') ?>" class="<?= ($this->uri->segment(1) == 'dashboard') ? 'active' : '' ?>"><i class="fas fa-home me-2"></i> Dashboard</a></li>
                
                <?php if ($role == 'Admin'): ?>
                <li class="px-3 mt-3 mb-1 text-uppercase text-white-50 small fw-bold">Master Data</li>
                <li><a href="<?= base_url('kategori') ?>" class="<?= ($this->uri->segment(1) == 'kategori') ? 'active' : '' ?>"><i class="fas fa-tags me-2"></i> Kategori Alat</a></li>
                <li><a href="<?= base_url('alat') ?>" class="<?= ($this->uri->segment(1) == 'alat') ? 'active' : '' ?>"><i class="fas fa-toolbox me-2"></i> Data Alat</a></li>
                <li><a href="<?= base_url('user') ?>" class="<?= ($this->uri->segment(1) == 'user') ? 'active' : '' ?>"><i class="fas fa-users me-2"></i> Manajemen User</a></li>
                
                <li class="px-3 mt-3 mb-1 text-uppercase text-white-50 small fw-bold">Akun</li>
                <li><a href="<?= base_url('admin/pengaturan') ?>" class="<?= ($this->uri->segment(2) == 'pengaturan') ? 'active' : '' ?>"><i class="fas fa-cog me-2"></i> Pengaturan Akun</a></li>
                <?php endif; ?>

                <?php if ($role == 'Admin' || $role == 'Petugas'): ?>
                <li class="px-3 mt-3 mb-1 text-uppercase text-white-50 small fw-bold">Transaksi</li>
                <li><a href="<?= base_url('transaksi/pengajuan') ?>" class="<?= ($this->uri->segment(2) == 'pengajuan') ? 'active' : '' ?>"><i class="fas fa-clipboard-list me-2"></i> Pengajuan Peminjaman</a></li>
                <li><a href="<?= base_url('transaksi/pengembalian') ?>" class="<?= ($this->uri->segment(2) == 'pengembalian') ? 'active' : '' ?>"><i class="fas fa-undo me-2"></i> Pengembalian</a></li>
                <li><a href="<?= base_url('denda') ?>" class="<?= ($this->uri->segment(1) == 'denda') ? 'active' : '' ?>"><i class="fas fa-money-bill-wave me-2"></i> Data Denda</a></li>
                
                <li class="px-3 mt-3 mb-1 text-uppercase text-white-50 small fw-bold">Laporan</li>
                <li><a href="<?= base_url('laporan') ?>" class="<?= ($this->uri->segment(1) == 'laporan') ? 'active' : '' ?>"><i class="fas fa-print me-2"></i> Cetak Laporan</a></li>
                <?php endif; ?>

               

                <?php if ($role == 'Peminjam'): ?>
                <li class="px-3 mt-3 mb-1 text-uppercase text-white-50 small fw-bold">Peminjaman</li>
                <li><a href="<?= base_url('peminjam/alat') ?>" class="<?= ($this->uri->segment(2) == 'alat') ? 'active' : '' ?>"><i class="fas fa-boxes me-2"></i> Daftar Alat</a></li>
                <li><a href="<?= base_url('peminjam/riwayat') ?>" class="<?= ($this->uri->segment(2) == 'riwayat') ? 'active' : '' ?>"><i class="fas fa-history me-2"></i> Riwayat Peminjaman</a></li>
                <li><a href="<?= base_url('peminjam/denda') ?>" class="<?= ($this->uri->segment(2) == 'denda') ? 'active' : '' ?>"><i class="fas fa-file-invoice-dollar me-2"></i> Data Denda</a></li>
                <?php endif; ?>
                
            </ul>
        </nav>
        <!-- End of Sidebar -->
