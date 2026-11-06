        <div class="main-content d-flex flex-column min-vh-100">
            <!-- Topbar -->
            <nav class="navbar navbar-expand navbar-light topbar px-3 py-2 justify-content-between">
                <button class="btn btn-light d-md-none me-3" id="sidebarToggle">
                    <i class="fas fa-bars"></i>
                </button>
                <h5 class="m-0 text-dark fw-bold d-none d-sm-block"><?= isset($title) ? $title : 'Dashboard' ?></h5>
                
                <ul class="navbar-nav align-items-center ms-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-dark" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-user-circle me-1"></i>
                            <?= $this->session->userdata('nama') ?> 
                            <span class="badge bg-primary ms-1"><?= $this->session->userdata('role') ?></span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end shadow border-0" aria-labelledby="userDropdown">
                            <li><a class="dropdown-item" href="<?= base_url('auth/profil') ?>"><i class="fas fa-user fa-sm fa-fw me-2 text-gray-400"></i> Profil</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item text-danger" href="<?= base_url('auth/logout') ?>"><i class="fas fa-sign-out-alt fa-sm fa-fw me-2"></i> Logout</a></li>
                        </ul>
                    </li>
                </ul>
            </nav>
            <!-- End of Topbar -->
            
            <!-- Main Content Area -->
            <div class="container-fluid p-4 flex-grow-1">
