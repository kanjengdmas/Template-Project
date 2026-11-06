<link href="<?= base_url('assets/css/profil.css') ?>" rel="stylesheet">

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-user mr-2"></i><b><?= $title; ?></b></h1>
    </div>

    <!-- Alert Messages -->
    <?php if ($this->session->flashdata('success')): ?>
        <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm" role="alert">
            <i class="fas fa-check-circle mr-2"></i><?= $this->session->flashdata('success'); ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php endif; ?>
    <?php if ($this->session->flashdata('error')): ?>
        <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm" role="alert">
            <i class="fas fa-exclamation-circle mr-2"></i><?= $this->session->flashdata('error'); ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php endif; ?>

    <?= form_open_multipart('profil/update'); ?>
    <div class="row">
        <!-- Profile Card Preview (Left) -->
        <div class="col-xl-4 col-lg-5 mb-4">
            <div class="card shadow border-0">
                <div class="profile-header-bg"></div>
                <div class="card-body text-center pt-0">
                    <div class="profile-avatar-wrapper text-center">
                        <img id="avatar-preview" src="<?= base_url('assets/img/profile/') . $user->foto; ?>" class="rounded-circle img-thumbnail shadow-sm">
                        <label class="avatar-upload-btn" for="foto">
                            <i class="fas fa-camera"></i>
                            <input type="file" id="foto" name="foto" accept="image/*">
                        </label>
                    </div>
                    
                    <h5 class="font-weight-bold text-gray-900 mt-3 mb-1"><?= $user->nama; ?></h5>
                    <p class="text-muted small mb-3">@<?= $user->username; ?></p>
                    
                    <?php
                        $badge_class = 'badge-secondary';
                        if ($user->role == 'admin') $badge_class = 'badge-danger';
                        elseif ($user->role == 'dokter') $badge_class = 'badge-info';
                        elseif ($user->role == 'petugas') $badge_class = 'badge-primary';
                        elseif ($user->role == 'pasien') $badge_class = 'badge-success';
                    ?>
                    <span class="badge <?= $badge_class; ?> px-3 py-2 text-uppercase mb-4" style="font-size: 11px; letter-spacing: 1px;">
                        <i class="fas fa-id-badge mr-1"></i><?= $user->role; ?>
                    </span>
                    
                    <div class="text-left mt-3">
                        <div class="info-card-item active">
                            <span class="text-muted small d-block">Alamat Email</span>
                            <span class="text-gray-900 font-weight-bold"><?= $user->email; ?></span>
                        </div>
                        <div class="info-card-item">
                            <span class="text-muted small d-block">Terdaftar Sejak</span>
                            <span class="text-gray-900 font-weight-bold"><?= date('d F Y', strtotime($user->created_at)); ?></span>
                        </div>
                    </div>
                    <div id="file-name-info" class="text-info small mt-2" style="display: none; font-weight: 500;"></div>
                </div>
            </div>
        </div>

        <!-- Edit Profile Form (Right) -->
        <div class="col-xl-8 col-lg-7">
            <div class="card shadow border-0 mb-4">
                <div class="card-header bg-white py-3 border-0">
                    <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-user-cog mr-2"></i>Pengaturan Akun</h6>
                </div>
                <div class="card-body">
                    
                    <!-- Section: Personal Info -->
                    <div class="form-section-title">
                        <i class="fas fa-user-circle text-primary"></i> Informasi Pribadi
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-4">
                                <label class="text-gray-800 font-weight-bold small">Nama Lengkap</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-user text-gray-400"></i></span>
                                    </div>
                                    <input type="text" class="form-control" id="nama" name="nama" value="<?= $user->nama; ?>" placeholder="Masukkan nama lengkap" required>
                                </div>
                                <?= form_error('nama', '<small class="text-danger pl-1 mt-1 d-block">', '</small>'); ?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-4">
                                <label class="text-gray-800 font-weight-bold small">Alamat Email</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-envelope text-gray-400"></i></span>
                                    </div>
                                    <input type="email" class="form-control" id="email" name="email" value="<?= $user->email; ?>" placeholder="Masukkan email aktif" required>
                                </div>
                                <?= form_error('email', '<small class="text-danger pl-1 mt-1 d-block">', '</small>'); ?>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-4">
                                <label class="text-gray-800 font-weight-bold small">Username</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-at text-gray-400"></i></span>
                                    </div>
                                    <input type="text" class="form-control bg-light" value="<?= $user->username; ?>" readonly>
                                </div>
                                <small class="text-muted d-block mt-1 pl-1">Username tidak dapat diubah</small>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-4">
                                <label class="text-gray-800 font-weight-bold small">Hak Akses / Role</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-shield-alt text-gray-400"></i></span>
                                    </div>
                                    <input type="text" class="form-control bg-light text-capitalize" value="<?= $user->role; ?>" readonly>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Section: Security/Password -->
                    <div class="form-section-title mt-2">
                        <i class="fas fa-key text-primary"></i> Keamanan Kata Sandi
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-4">
                                <label class="text-gray-800 font-weight-bold small">Password Baru</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-lock text-gray-400"></i></span>
                                    </div>
                                    <input type="password" class="form-control" id="password" name="password" placeholder="Isi hanya jika ingin diganti">
                                    <div class="input-group-append">
                                        <span class="input-group-text toggle-password" style="cursor: pointer;" data-target="#password">
                                            <i class="fa fa-eye-slash text-gray-400"></i>
                                        </span>
                                    </div>
                                </div>
                                <?= form_error('password', '<small class="text-danger pl-1 mt-1 d-block">', '</small>'); ?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-4">
                                <label class="text-gray-800 font-weight-bold small">Konfirmasi Password Baru</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-lock text-gray-400"></i></span>
                                    </div>
                                    <input type="password" class="form-control" id="passconf" name="passconf" placeholder="Ulangi password baru">
                                    <div class="input-group-append">
                                        <span class="input-group-text toggle-password" style="cursor: pointer;" data-target="#passconf">
                                            <i class="fa fa-eye-slash text-gray-400"></i>
                                        </span>
                                    </div>
                                </div>
                                <?= form_error('passconf', '<small class="text-danger pl-1 mt-1 d-block">', '</small>'); ?>
                            </div>
                        </div>
                    </div>

                    <hr class="mt-4 mb-4">
                    
                    <div class="form-group mb-0 text-right">
                        <button type="submit" class="btn btn-save-profile px-4 py-2 font-weight-bold"><i class="fas fa-save mr-2"></i>Simpan Perubahan</button>
                    </div>

                </div>
            </div>
        </div>
    </div>
    </form>

</div>
<!-- /.container-fluid -->

<script src="<?= base_url('assets/js/profil.js') ?>"></script>
