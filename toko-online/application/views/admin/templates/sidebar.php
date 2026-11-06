<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center mt-4 mb-4" href="<?php echo base_url(); ?>">
                <div class="sidebar-brand-icon">
                    <img src="<?php echo base_url('assets/img/logo.png'); ?>" alt="Logo" class="rounded shadow-glow-emerald" style="width: 38px; height: 38px; border: 1px solid var(--accent-green);">
                </div>
                <div class="sidebar-brand-text mx-3" style="text-transform: none; letter-spacing: 1px;">
                    <span class="text-white font-weight-bold">VERIDIAN</span><span class="text-accent font-weight-bold">LTD</span>
                </div>
            </a>

            <!-- Heading -->
            <div class="sidebar-heading mt-2">
                Main Menu
            </div>

            <!-- Nav Item - Dashboard -->
           
            <li class="nav-item">
                <a class="nav-link" href="<?php echo $dashboard_url; ?>">
                    <i class="fas fa-fw fa-home"></i>
                    <span>Dashboard</span></a>
            </li>

            <?php if ($role === 'kasir'): ?>
                <!-- Menu Khas Kasir -->
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo base_url('kasir/barang'); ?>">
                        <i class="fas fa-fw fa-box"></i>
                        <span>Data Barang</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo base_url('kasir/pesanan'); ?>">
                        <i class="fas fa-fw fa-credit-card"></i>
                        <span>Pesanan & Pembayaran</span></a>
                </li>
            <?php elseif ($role === 'admin'): ?>
                <!-- Menu Khas Admin -->
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo base_url('kasir/barang'); ?>">
                        <i class="fas fa-fw fa-box"></i>
                        <span>Data Barang</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo base_url('admin/layanan'); ?>">
                        <i class="fas fa-fw fa-briefcase"></i>
                        <span>Layanan</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo base_url('admin/tim'); ?>">
                        <i class="fas fa-fw fa-users"></i>
                        <span>Tim Kami</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo base_url('admin/kontak'); ?>">
                        <i class="fas fa-fw fa-phone"></i>
                        <span>Informasi Toko</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo base_url('admin/tentang'); ?>">
                        <i class="fas fa-fw fa-info-circle"></i>
                        <span>Tentang Kami</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo base_url('kasir/pesanan'); ?>">
                        <i class="fas fa-fw fa-credit-card"></i>
                        <span>Pesanan & Pembayaran</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo base_url('admin/transaksi'); ?>">
                        <i class="fas fa-fw fa-exchange-alt"></i>
                        <span>Transaksi</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo base_url('admin/users'); ?>">
                        <i class="fas fa-fw fa-user-shield"></i>
                        <span>Data users</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo base_url('admin/users/customers'); ?>">
                        <i class="fas fa-fw fa-users"></i>
                        <span>User Terdaftar</span></a>
                </li>

                <!-- Sales Management -->
                <div class="sidebar-heading mt-4">
                    Sales & Analytics
                </div>

                <li class="nav-item">
                    <a class="nav-link" href="<?php echo base_url($role.'/penjualan'); ?>">
                        <i class="fas fa-fw fa-shopping-cart"></i>
                        <span>Penjualan</span></a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="<?php echo base_url($role.'/laporan'); ?>">
                        <i class="fas fa-fw fa-chart-line"></i>
                        <span>Laporan Penjualan</span></a>
                </li>
            <?php endif; ?>

            <!-- Account Settings Menu -->
            
           
            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block mt-4 mb-0">

            <!-- Dark Mode Toggle -->
            
        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand topbar mb-4 static-top">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow ml-3">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <?php
                                $user_avatar = base_url('assets/img/default-avatar.png');
                                if (!empty($this->session->userdata('user_image'))) {
                                    $user_avatar = base_url('assets/uploads/avatars/' . $this->session->userdata('user_image'));
                                } else {
                                    if ($role === 'admin') {
                                        $user_avatar = base_url('assets/img/admin-avatar.png');
                                    } elseif ($role === 'kasir') {
                                        $user_avatar = base_url('assets/img/kasir-avatar.png');
                                    }
                                }
                                ?>
                                <img class="img-profile rounded-circle mr-2"
                                    src="<?php echo $user_avatar; ?>" style="width: 32px; height: 32px; object-fit: cover;">
                                <div class="d-none d-lg-inline text-left">
                                    <div class="small font-weight-bold" style="color: var(--text-primary);"><?php echo $this->session->userdata('fullname'); ?></div>
                                    <div class="text-muted" style="font-size: 0.75rem; text-transform: capitalize;"><?php echo $role; ?></div>
                                </div>
                                <i class="fas fa-chevron-down text-muted ml-3" style="font-size: 0.7rem;"></i>
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="<?php echo base_url($role.'/pengaturan'); ?>">
                                    <i class="fas fa-user-cog fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Pengaturan Akun
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="<?php echo base_url('auth/logout'); ?>">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>