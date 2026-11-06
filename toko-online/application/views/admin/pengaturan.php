<!-- Begin Page Content -->
<div class="container-fluid px-4">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <div>
            <h1 class="h3 mb-1 text-white font-weight-bold">Pengaturan Akun</h1>
            <p class="mb-0 text-muted" style="font-size: 0.9rem;">Kelola informasi profil dan keamanan akun Anda di sini.</p>
        </div>
    </div>

    <!-- Alert Notifications -->
    <?php if($this->session->flashdata('success')): ?>
        <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm" role="alert" style="background: rgba(74, 222, 128, 0.1); color: #4ade80; border-radius: 12px;">
            <i class="fas fa-check-circle mr-2"></i> <?php echo $this->session->flashdata('success'); ?>
            <button type="button" class="close text-white" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php endif; ?>

    <?php if($this->session->flashdata('error')): ?>
        <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm" role="alert" style="background: rgba(239, 68, 68, 0.1); color: #f87171; border-radius: 12px;">
            <i class="fas fa-exclamation-circle mr-2"></i> <?php echo $this->session->flashdata('error'); ?>
            <button type="button" class="close text-white" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php endif; ?>

    <link href="<?php echo base_url('assets/css/admin-pengaturan.css'); ?>" rel="stylesheet">

    <div class="row">
        <!-- Left Side: Profile Summary -->
        <div class="col-xl-4 col-lg-5 mb-4">
            <div class="card card-dark p-4 text-center">
                <!-- Avatar with Overlay to upload -->
                <div class="profile-avatar-container mb-4" data-toggle="modal" data-target="#avatarModal" title="Ganti Foto Profil">
                    <?php
                    $user_avatar = base_url('assets/img/default-avatar.png');
                    if (!empty($user['image'])) {
                        $user_avatar = base_url('assets/uploads/avatars/' . $user['image']);
                    } else {
                        if ($role === 'admin') {
                            $user_avatar = base_url('assets/img/admin-avatar.png');
                        } elseif ($role === 'kasir') {
                            $user_avatar = base_url('assets/img/kasir-avatar.png');
                        }
                    }
                    ?>
                    <img src="<?php echo $user_avatar; ?>" alt="Foto Profil" class="profile-avatar">
                    <div class="avatar-overlay">
                        <div class="text-center">
                            <i class="fas fa-camera mb-1 d-block text-lg"></i>
                            <span style="font-size: 0.7rem; font-weight: 600;">Ubah Foto</span>
                        </div>
                    </div>
                </div>

                <!-- Profile Info -->
                <h4 class="text-white font-weight-bold mb-1"><?php echo htmlspecialchars($user['fullname']); ?></h4>
                <p class="text-muted mb-3" style="font-size: 0.85rem;">@<?php echo htmlspecialchars($user['username']); ?></p>
                
                <div class="d-flex justify-content-center align-items-center gap-2 mb-4">
                    <span class="badge badge-success px-3 py-2 text-capitalize" style="font-size: 0.75rem; border-radius: 8px; background: rgba(74, 222, 128, 0.1); color: #4ade80; border: 1px solid rgba(74, 222, 128, 0.2);">
                        <i class="fas fa-user-shield mr-1"></i> <?php echo htmlspecialchars($user['role']); ?>
                    </span>
                    <span class="badge px-3 py-2" style="font-size: 0.75rem; border-radius: 8px; background: rgba(59, 130, 246, 0.1); color: #60a5fa; border: 1px solid rgba(59, 130, 246, 0.2);">
                        <i class="fas fa-circle mr-1" style="font-size: 0.5rem; vertical-align: middle;"></i> Aktif
                    </span>
                </div>

                <hr class="w-100 border-white/5 my-4">

                <!-- Primary Action Buttons -->
                <div class="d-flex flex-column gap-2 px-2">
                    <button class="btn btn-gold btn-block mb-2 shadow-sm" data-toggle="modal" data-target="#editProfileModal">
                        <i class="fas fa-user-edit mr-2"></i> Edit Profil
                    </button>
                    <button class="btn btn-outline-danger btn-block border-0 shadow-sm" style="background: rgba(239, 68, 68, 0.05); color: #f87171; border-radius: 12px; padding: 10px 20px; font-weight: 700;" data-toggle="modal" data-target="#passwordModal">
                        <i class="fas fa-key mr-2"></i> Ganti Password
                    </button>
                </div>
            </div>
        </div>

        <!-- Right Side: Details Tabs -->
        <div class="col-xl-8 col-lg-7 mb-4">
            <div class="card card-dark">
                <!-- Nav Tabs -->
                <ul class="nav tab-nav-custom px-4 pt-3" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="profile-tab" data-toggle="tab" href="#profile-pane" role="tab" aria-selected="true">
                            <i class="fas fa-id-card mr-2"></i> Profil Saya
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="security-tab" data-toggle="tab" href="#security-pane" role="tab" aria-selected="false">
                            <i class="fas fa-shield-alt mr-2"></i> Keamanan Akun
                        </a>
                    </li>
                </ul>

                <!-- Tab Contents -->
                <div class="tab-content p-2">
                    <!-- Profile Tab -->
                    <div class="tab-pane fade show active" id="profile-pane" role="tabpanel" aria-labelledby="profile-tab">
                        <div class="p-3">
                            <div class="info-row">
                                <div class="info-icon">
                                    <i class="fas fa-user-circle"></i>
                                </div>
                                <div class="info-content">
                                    <label>Nama Lengkap</label>
                                    <p><?php echo htmlspecialchars($user['fullname']); ?></p>
                                </div>
                            </div>
                            <div class="info-row">
                                <div class="info-icon">
                                    <i class="fas fa-at"></i>
                                </div>
                                <div class="info-content">
                                    <label>Username</label>
                                    <p><?php echo htmlspecialchars($user['username']); ?></p>
                                </div>
                            </div>
                            <div class="info-row">
                                <div class="info-icon">
                                    <i class="fas fa-envelope"></i>
                                </div>
                                <div class="info-content">
                                    <label>Email</label>
                                    <p><?php echo !empty($user['email']) ? htmlspecialchars($user['email']) : '<span class="text-white/30 italic">Belum diisi</span>'; ?></p>
                                </div>
                            </div>
                            <div class="info-row">
                                <div class="info-icon">
                                    <i class="fas fa-phone"></i>
                                </div>
                                <div class="info-content">
                                    <label>Nomor Telepon</label>
                                    <p><?php echo !empty($user['phone']) ? htmlspecialchars($user['phone']) : '<span class="text-white/30 italic">Belum diisi</span>'; ?></p>
                                </div>
                            </div>
                            <div class="info-row">
                                <div class="info-icon">
                                    <i class="fas fa-map-marker-alt"></i>
                                </div>
                                <div class="info-content">
                                    <label>Alamat</label>
                                    <p><?php echo !empty($user['address']) ? htmlspecialchars($user['address']) : '<span class="text-white/30 italic">Belum diisi</span>'; ?></p>
                                </div>
                            </div>
                            <div class="info-row">
                                <div class="info-icon">
                                    <i class="fas fa-user-tag"></i>
                                </div>
                                <div class="info-content">
                                    <label>Role / Jabatan</label>
                                    <p class="text-capitalize"><?php echo htmlspecialchars($user['role']); ?></p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Security Tab -->
                    <div class="tab-pane fade" id="security-pane" role="tabpanel" aria-labelledby="security-tab">
                        <div class="p-4 text-center py-5">
                            <i class="fas fa-shield-alt text-success mb-4" style="font-size: 3rem; opacity: 0.3;"></i>
                            <h5 class="text-white font-weight-bold mb-2">Keamanan Akun Anda Terjaga</h5>
                            <p class="text-muted mx-auto mb-4" style="max-width: 450px; font-size: 0.85rem;">
                                Sandi Anda disimpan menggunakan enkripsi hash tingkat industri yang aman. Pastikan untuk memperbarui password Anda secara berkala untuk menjaga kerahasiaan data staff.
                            </p>
                            <button class="btn btn-gold px-4 py-2" data-toggle="modal" data-target="#passwordModal">
                                <i class="fas fa-key mr-2"></i> Ubah Password Sekarang
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- ==============================================
     BOOTSTRAP MODALS
     ============================================== -->

<!-- Modal: Upload Avatar -->
<div class="modal fade" id="avatarModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content card-dark border-0">
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title text-white font-weight-bold"><i class="fas fa-camera mr-2 text-success"></i> Unggah Foto Profil</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?php echo base_url($role . '/pengaturan/upload_avatar'); ?>" method="POST" enctype="multipart/form-data">
                <div class="modal-body text-center py-4">
                    <p class="text-muted small mb-4">Pilih file foto profil (Format: JPG, JPEG, PNG, GIF. Maksimal 2MB).</p>
                    <div class="custom-file bg-dark border-0 text-left" style="border-radius: 8px; overflow: hidden;">
                        <input type="file" name="avatar" class="custom-file-input" id="avatarFile" required>
                        <label class="custom-file-label bg-dark border-0 text-white-50" for="avatarFile">Pilih file...</label>
                    </div>
                </div>
                <div class="modal-footer border-0 pt-0">
                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal" style="border-radius: 10px;">Batal</button>
                    <button type="submit" class="btn btn-success" style="border-radius: 10px; font-weight: 600;">Unggah</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal: Edit Profile -->
<div class="modal fade" id="editProfileModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content card-dark border-0">
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title text-white font-weight-bold"><i class="fas fa-user-edit mr-2 text-success"></i> Edit Informasi Profil</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?php echo base_url($role . '/pengaturan/edit_profile'); ?>" method="POST">
                <div class="modal-body py-4 space-y-3">
                    <div class="form-group">
                        <label class="text-white-50 small">Nama Lengkap</label>
                        <input type="text" name="fullname" class="form-control bg-dark border-0 text-white" style="border-radius: 8px;" value="<?php echo htmlspecialchars($user['fullname']); ?>" required>
                    </div>
                    <div class="form-group">
                        <label class="text-white-50 small">Username</label>
                        <input type="text" name="username" class="form-control bg-dark border-0 text-white" style="border-radius: 8px;" value="<?php echo htmlspecialchars($user['username']); ?>" required>
                    </div>
                    <div class="form-group">
                        <label class="text-white-50 small">Email</label>
                        <input type="email" name="email" class="form-control bg-dark border-0 text-white" style="border-radius: 8px;" value="<?php echo htmlspecialchars($user['email'] ?? ''); ?>">
                    </div>
                    <div class="form-group">
                        <label class="text-white-50 small">Nomor Telepon</label>
                        <input type="text" name="phone" class="form-control bg-dark border-0 text-white" style="border-radius: 8px;" value="<?php echo htmlspecialchars($user['phone'] ?? ''); ?>">
                    </div>
                    <div class="form-group">
                        <label class="text-white-50 small">Alamat</label>
                        <textarea name="address" class="form-control bg-dark border-0 text-white" style="border-radius: 8px;" rows="3"><?php echo htmlspecialchars($user['address'] ?? ''); ?></textarea>
                    </div>
                </div>
                <div class="modal-footer border-0 pt-0">
                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal" style="border-radius: 10px;">Batal</button>
                    <button type="submit" class="btn btn-success" style="border-radius: 10px; font-weight: 600;">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal: Change Password -->
<div class="modal fade" id="passwordModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content card-dark border-0">
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title text-white font-weight-bold"><i class="fas fa-key mr-2 text-danger"></i> Ubah Password</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?php echo base_url($role . '/pengaturan/change_password'); ?>" method="POST" id="changePasswordForm">
                <div class="modal-body py-4">
                    <div class="form-group">
                        <label class="text-white-50 small">Password Lama</label>
                        <input type="password" name="old_password" class="form-control bg-dark border-0 text-white" style="border-radius: 8px;" required>
                    </div>
                    <div class="form-group">
                        <label class="text-white-50 small">Password Baru</label>
                        <input type="password" name="new_password" id="newPassword" class="form-control bg-dark border-0 text-white" style="border-radius: 8px;" required minlength="8">
                        <small class="text-muted">Minimal 8 karakter.</small>
                    </div>
                    <div class="form-group">
                        <label class="text-white-50 small">Konfirmasi Password Baru</label>
                        <input type="password" name="confirm_password" id="confirmPassword" class="form-control bg-dark border-0 text-white" style="border-radius: 8px;" required>
                    </div>
                </div>
                <div class="modal-footer border-0 pt-0">
                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal" style="border-radius: 10px;">Batal</button>
                    <button type="submit" class="btn btn-danger" style="border-radius: 10px; font-weight: 600;">Ubah Password</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="<?php echo base_url('assets/js/admin-pengaturan.js'); ?>"></script>
