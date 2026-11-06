<div class="row">
    <!-- Card Profil (Left Column) -->
    <div class="col-lg-4 mb-4">
        <div class="card card-modern shadow-sm border-0 text-center py-4">
            <div class="card-body">
                <div class="position-relative d-inline-block mb-3">
                    <img src="<?= base_url('assets/img/users/' . (!empty($user->foto) ? $user->foto : 'default.jpg')) ?>" 
                         class="rounded-circle shadow-sm border border-4 border-white" 
                         width="150" 
                         height="150" 
                         style="object-fit: cover; background: #e9ecef;" 
                         id="profileImageLeft">
                </div>
                <h4 class="fw-bold mb-1" id="profileNameLeft"><?= $user->nama ?></h4>
                <p class="text-muted mb-2">@<?= $user->username ?></p>
                <div class="mb-3">
                    <span class="badge bg-primary px-3 py-2 text-uppercase"><?= $user->role ?></span>
                    <span class="badge bg-success px-3 py-2">AKTIF</span>
                </div>
                <hr class="my-4">
                <div class="d-grid gap-2">
                    <button class="btn btn-primary-custom" onclick="openEditProfileModal()">
                        <i class="fas fa-user-edit me-2"></i>Edit Profil
                    </button>
                    <button class="btn btn-outline-primary" onclick="openChangePasswordModal()">
                        <i class="fas fa-key me-2"></i>Ubah Password
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Tab Navigation & Content (Right Column) -->
    <div class="col-lg-8 mb-4">
        <div class="card card-modern shadow-sm border-0">
            <div class="card-header bg-white border-bottom-0 pt-3">
                <ul class="nav nav-tabs card-header-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active fw-bold text-primary" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-tab-pane" type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="true">
                            <i class="fas fa-user me-2"></i>Profil Saya
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link fw-bold text-primary" id="security-tab" data-bs-toggle="tab" data-bs-target="#security-tab-pane" type="button" role="tab" aria-controls="security-tab-pane" aria-selected="false">
                            <i class="fas fa-shield-alt me-2"></i>Keamanan Akun
                        </button>
                    </li>
                </ul>
            </div>
            <div class="card-body mt-3">
                <div class="tab-content" id="myTabContent">
                    <!-- Tab Profil Saya -->
                    <div class="tab-pane fade show active" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">
                        <div class="row g-4">
                            <div class="col-md-6">
                                <label class="text-muted small d-block">Nama Lengkap</label>
                                <span class="fw-bold fs-6 text-dark" id="profileNameDetail"><?= $user->nama ?></span>
                            </div>
                            <div class="col-md-6">
                                <label class="text-muted small d-block">Username</label>
                                <span class="fw-bold fs-6 text-dark" id="profileUsernameDetail">@<?= $user->username ?></span>
                            </div>
                            <div class="col-md-6">
                                <label class="text-muted small d-block">Email Address</label>
                                <span class="fw-bold fs-6 text-dark" id="profileEmailDetail"><?= $user->email ?></span>
                            </div>
                            <div class="col-md-6">
                                <label class="text-muted small d-block">Nomor Telepon</label>
                                <span class="fw-bold fs-6 text-dark" id="profilePhoneDetail"><?= $user->telepon ?></span>
                            </div>
                            <div class="col-md-12">
                                <label class="text-muted small d-block">Alamat Lengkap</label>
                                <span class="fw-bold fs-6 text-dark" id="profileAddressDetail"><?= $user->alamat ?></span>
                            </div>
                            <div class="col-md-6">
                                <label class="text-muted small d-block">Hak Akses / Role</label>
                                <span class="badge bg-light text-primary border border-primary text-uppercase px-3 py-2 fw-bold" id="profileRoleDetail"><?= $user->role ?></span>
                            </div>
                        </div>
                    </div>

                    <!-- Tab Keamanan Akun -->
                    <div class="tab-pane fade" id="security-tab-pane" role="tabpanel" aria-labelledby="security-tab" tabindex="0">
                        <div class="text-center py-4">
                            <div class="p-3 bg-light rounded-circle d-inline-block mb-3" style="width: 80px; height: 80px;">
                                <i class="fas fa-lock text-primary fa-2x mt-2"></i>
                            </div>
                            <h5 class="fw-bold">Keamanan &amp; Kata Sandi</h5>
                            <p class="text-muted mx-auto" style="max-width: 450px;">Pastikan kata sandi Anda kuat, unik, dan diperbarui secara berkala untuk menjaga keamanan akun administrator Anda.</p>
                            <button class="btn btn-primary-custom px-4 mt-2" onclick="openChangePasswordModal()">
                                <i class="fas fa-key me-2"></i>Ubah Password Sekarang
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Edit Profil -->
<div class="modal fade" id="modalEditProfile" tabindex="-1" aria-labelledby="modalEditProfileLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-header bg-light">
                <h5 class="modal-title fw-bold text-dark" id="modalEditProfileLabel">
                    <i class="fas fa-user-edit text-primary me-2"></i>Edit Profil Saya
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="formEditProfile" enctype="multipart/form-data">
                <div class="modal-body p-4">
                    <div class="text-center mb-4">
                        <img src="<?= base_url('assets/img/users/' . (!empty($user->foto) ? $user->foto : 'default.jpg')) ?>" 
                             class="rounded-circle shadow-sm border" 
                             width="90" 
                             height="90" 
                             style="object-fit: cover;" 
                             id="profilePreviewModal">
                        <div class="mt-2">
                            <label for="fotoInput" class="btn btn-sm btn-outline-primary px-3">
                                <i class="fas fa-upload me-2"></i>Pilih Foto Baru
                            </label>
                            <input type="file" name="foto" id="fotoInput" class="d-none" accept="image/*" onchange="previewImage(this)">
                        </div>
                        <small class="text-muted d-block mt-1">Format: JPG, JPEG, PNG. Maksimal 2MB.</small>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Nama Lengkap</label>
                        <input type="text" class="form-control" name="nama" id="inputNama" value="<?= $user->nama ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Username</label>
                        <input type="text" class="form-control" name="username" id="inputUsername" value="<?= $user->username ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Email Address</label>
                        <input type="email" class="form-control" name="email" id="inputEmail" value="<?= $user->email ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Nomor Telepon</label>
                        <input type="text" class="form-control" name="telepon" id="inputTelepon" value="<?= $user->telepon ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Alamat Lengkap</label>
                        <textarea class="form-control" name="alamat" id="inputAlamat" rows="3" required><?= $user->alamat ?></textarea>
                    </div>
                </div>
                <div class="modal-footer border-0 bg-light p-3">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary-custom px-4" id="btnSaveProfile">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Ubah Password -->
<div class="modal fade" id="modalChangePassword" tabindex="-1" aria-labelledby="modalChangePasswordLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-header bg-light">
                <h5 class="modal-title fw-bold text-dark" id="modalChangePasswordLabel">
                    <i class="fas fa-shield-alt text-primary me-2"></i>Ubah Kata Sandi
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="formChangePassword">
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Password Lama</label>
                        <div class="input-group">
                            <span class="input-group-text bg-white"><i class="fas fa-lock text-muted"></i></span>
                            <input type="password" class="form-control border-start-0" name="password_lama" id="inputPasswordLama" placeholder="Masukkan password lama Anda" required>
                        </div>
                    </div>
                    <hr class="my-4">
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Password Baru</label>
                        <div class="input-group">
                            <span class="input-group-text bg-white"><i class="fas fa-key text-muted"></i></span>
                            <input type="password" class="form-control border-start-0" name="password_baru" id="inputPasswordBaru" placeholder="Minimal 8 karakter" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Konfirmasi Password Baru</label>
                        <div class="input-group">
                            <span class="input-group-text bg-white"><i class="fas fa-check-double text-muted"></i></span>
                            <input type="password" class="form-control border-start-0" name="konfirmasi_password" id="inputKonfirmasiPassword" placeholder="Ulangi password baru Anda" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-0 bg-light p-3">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary-custom px-4" id="btnSavePassword">Perbarui Password</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    window.AppConfig = {
        baseUrl: '<?= base_url() ?>'
    };
</script>
<script src="<?= base_url('assets/js/admin_pengaturan.js') ?>"></script>
