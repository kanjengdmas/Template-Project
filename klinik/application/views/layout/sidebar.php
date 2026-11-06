        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= base_url() ?>">
                <div class="sidebar-brand-icon">
                    <i class="fa-solid fa-notes-medical"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Klinik Digital</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <?php $role = $this->session->userdata('role'); ?>

            <!-- Nav Item - Dashboard -->
            <li class="nav-item <?= ($this->uri->segment(1) == $role) ? 'active' : '' ?>">
                <a class="nav-link" href="<?= base_url($role) ?>">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <?php if ($role == 'admin'): ?>
                <div class="sidebar-heading">Master Data</div>
                <li class="nav-item <?= ($this->uri->segment(2) == 'user') ? 'active' : '' ?>">
                    <a class="nav-link" href="<?= base_url('admin/user') ?>">
                        <i class="fas fa-fw fa-users"></i>
                        <span>Data User</span></a>
                </li>
                <li class="nav-item <?= ($this->uri->segment(2) == 'dokter') ? 'active' : '' ?>">
                    <a class="nav-link" href="<?= base_url('admin/dokter') ?>">
                        <i class="fas fa-fw fa-user-doctor"></i>
                        <span>Data Dokter</span></a>
                </li>
                <li class="nav-item <?= ($this->uri->segment(2) == 'obat') ? 'active' : '' ?>">
                    <a class="nav-link" href="<?= base_url('admin/obat') ?>">
                        <i class="fas fa-fw fa-pills"></i>
                        <span>Data Obat</span></a>
                </li>
                <li class="nav-item <?= ($this->uri->segment(2) == 'laporan') ? 'active' : '' ?>">
                    <a class="nav-link" href="<?= base_url('admin/laporan') ?>">
                        <i class="fas fa-fw fa-file-alt"></i>
                        <span>Laporan</span></a>
                </li>

            <?php elseif ($role == 'petugas'): ?>
                <div class="sidebar-heading">Pemeriksaan</div>
                <li class="nav-item <?= ($this->uri->segment(2) == 'pemeriksaan') ? 'active' : '' ?>">
                    <a class="nav-link" href="<?= base_url('petugas/pemeriksaan') ?>">
                        <i class="fas fa-fw fa-stethoscope"></i>
                        <span>Data Pemeriksaan</span></a>
                </li>
                <li class="nav-item <?= ($this->uri->segment(2) == 'konfirmasi') ? 'active' : '' ?>">
                    <a class="nav-link" href="<?= base_url('petugas/konfirmasi') ?>">
                        <i class="fas fa-fw fa-check-circle"></i>
                        <span>Konfirmasi Pemeriksaan</span></a>
                </li>

            <?php elseif ($role == 'dokter'): ?>
                <div class="sidebar-heading">Pemeriksaan</div>
                <li class="nav-item <?= ($this->uri->segment(2) == 'pemeriksaan') ? 'active' : '' ?>">
                    <a class="nav-link" href="<?= base_url('dokter/pemeriksaan') ?>">
                        <i class="fas fa-fw fa-stethoscope"></i>
                        <span>Pemeriksaan Pasien</span></a>
                </li>
                <li class="nav-item <?= ($this->uri->segment(2) == 'riwayat') ? 'active' : '' ?>">
                    <a class="nav-link" href="<?= base_url('dokter/riwayat') ?>">
                        <i class="fas fa-fw fa-history"></i>
                        <span>Riwayat Pemeriksaan</span></a>
                </li>

            <?php elseif ($role == 'pasien'): ?>
                <div class="sidebar-heading">Pemeriksaan</div>
                <li class="nav-item <?= ($this->uri->segment(2) == 'pemeriksaan') ? 'active' : '' ?>">
                    <a class="nav-link" href="<?= base_url('pasien/pemeriksaan') ?>">
                        <i class="fas fa-fw fa-stethoscope"></i>
                        <span>Buat Pemeriksaan</span></a>
                </li>
                <li class="nav-item <?= ($this->uri->segment(2) == 'riwayat') ? 'active' : '' ?>">
                    <a class="nav-link" href="<?= base_url('pasien/riwayat') ?>">
                        <i class="fas fa-fw fa-history"></i>
                        <span>Riwayat Pemeriksaan</span></a>
                </li>
            <?php endif; ?>

            <!-- Divider -->
            

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline mt-3">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->
