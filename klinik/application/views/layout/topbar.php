        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <?php 
                                    $CI =& get_instance();
                                    $nama_tampil = $CI->session->userdata('nama');
                                    if ($CI->session->userdata('role') == 'dokter') {
                                        $CI->load->model('Dokter_model');
                                        $d_data = $CI->Dokter_model->get_by_user_id($CI->session->userdata('id'));
                                        if ($d_data) {
                                            $nama_tampil .= ' - <span class="badge badge-info">' . $d_data->spesialis . '</span>';
                                        }
                                    }
                                ?>
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?= $nama_tampil ?></span>
                                <?php
                                    $foto = $CI->session->userdata('foto') ? $CI->session->userdata('foto') : 'default.jpg';
                                ?>
                                <img class="img-profile rounded-circle" style="object-fit: cover;"
                                    src="<?= base_url('assets/img/profile/') . $foto ?>">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="<?= base_url('profil') ?>">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">
