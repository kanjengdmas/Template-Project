    <!-- Sidebar -->
    <div class="sidebar d-flex flex-column" style="width: 250px; background: linear-gradient(180deg, #1E3A8A 0%, #2563EB 100%); box-shadow: 4px 0 20px rgba(37, 99, 235, 0.15);">
        <div class="text-center mb-4 mt-2">
            <h4 class="fw-bold text-white"><i class="fas fa-book-reader me-2"></i>E-Perpus</h4>
            <span class="badge rounded-pill" style="background:rgba(255,255,255,0.2); color:white;">Anggota</span>
        </div>
        <hr class="mx-3 mt-0 text-muted">
        <ul class="nav flex-column mb-auto">
            <li class="nav-item">
                <a href="<?= base_url('anggota') ?>" class="nav-link <?= ($this->uri->segment(2) == '') ? 'active' : '' ?>">
                    <i class="fas fa-home"></i> Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a href="<?= base_url('anggota/katalog') ?>" class="nav-link <?= ($this->uri->segment(2) == 'katalog') ? 'active' : '' ?>">
                    <i class="fas fa-book-open"></i> Katalog Buku
                </a>
            </li>
            <li class="nav-item">
                <a href="<?= base_url('anggota/dipinjam') ?>" class="nav-link <?= ($this->uri->segment(2) == 'dipinjam') ? 'active' : '' ?>">
                    <i class="fas fa-hand-holding-usd"></i> Buku Dipinjam
                </a>
            </li>
            <li class="nav-item">
                <a href="<?= base_url('anggota/riwayat') ?>" class="nav-link <?= ($this->uri->segment(2) == 'riwayat') ? 'active' : '' ?>">
                    <i class="fas fa-history"></i> Riwayat
                </a>
            </li>
            <li class="nav-item">
                <a href="<?= base_url('anggota/profil') ?>" class="nav-link <?= ($this->uri->segment(2) == 'profil') ? 'active' : '' ?>">
                    <i class="fas fa-user-cog"></i> Profil Saya
                </a>
            </li>
        </ul>
        <hr class="mx-3 text-muted">
    </div>
    
    <!-- Main Content wrapper -->
    <div class="flex-grow-1 main-content w-100">
        <!-- Top Navbar -->
        <nav class="navbar navbar-expand-lg bg-white rounded-3 shadow-sm mb-4 px-3 py-2">
            <div class="container-fluid">
                <span class="navbar-brand mb-0 h1 fw-bold"><?= ucfirst(str_replace('_', ' ', $this->uri->segment(2) ? $this->uri->segment(2) : 'Dashboard')) ?></span>
                <div class="d-flex align-items-center">
                    <div class="dropdown">
                        <a href="#" class="d-flex align-items-center text-decoration-none dropdown-toggle text-dark" id="dropdownUser" data-bs-toggle="dropdown" aria-expanded="false">
                            <?php $foto = $this->session->userdata('foto') ? $this->session->userdata('foto') : 'default.jpg'; ?>
                            <img src="<?= base_url('assets/img/users/'.$foto) ?>" alt="mdo" width="32" height="32" class="rounded-circle me-2" style="object-fit:cover;">
                            <strong><?= $this->session->userdata('nama') ?></strong>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end shadow border-0 mt-2" aria-labelledby="dropdownUser">
                            <li><a class="dropdown-item" href="<?= base_url('anggota/profil') ?>"><i class="fas fa-user me-2 text-primary"></i>Profil</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item text-danger" href="<?= base_url('auth/logout') ?>"><i class="fas fa-sign-out-alt me-2"></i>Logout</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
