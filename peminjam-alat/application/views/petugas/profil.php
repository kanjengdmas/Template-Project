<link rel="stylesheet" href="<?= base_url('assets/css/peminjam-profil.css') ?>">

<div class="d-flex justify-content-between align-items-end mb-4">
    <div>
        <h3 class="fw-bold m-0 text-dark">Profil Saya</h3>
        <p class="text-muted m-0">Kelola informasi data diri dan akun Anda</p>
    </div>
</div>

<div class="row">
    <!-- Profil Singkat -->
    <div class="col-lg-4 mb-4">
        <div class="card profile-card">
            <div class="profile-header">
                <div class="profile-avatar">
                    <?php if (!empty($user['foto_profile']) && $user['foto_profile'] !== 'default_user.png' && file_exists('./assets/uploads/profile/' . $user['foto_profile'])): ?>
                        <img src="<?= base_url('assets/uploads/profile/' . $user['foto_profile']) ?>" alt="Profile Picture" style="width: 100%; height: 100%; object-fit: cover; border-radius: 50%;">
                    <?php else: ?>
                        <?= strtoupper(substr($user['nama'], 0, 1)) ?>
                    <?php endif; ?>
                </div>
                <h5 class="fw-bold mb-1"><?= $user['nama'] ?></h5>
                <p class="mb-0 text-white-50 small">Petugas</p>
            </div>
            <div class="card-body p-4">
                <div class="d-flex justify-content-between mb-3">
                    <span class="text-muted small"><i class="fas fa-envelope me-2"></i> Email</span>
                    <span class="fw-medium text-dark small"><?= $user['email'] ?? '-' ?></span>
                </div>
                <div class="d-flex justify-content-between mb-3">
                    <span class="text-muted small"><i class="fas fa-phone me-2"></i> No Telp</span>
                    <span class="fw-medium text-dark small"><?= $user['no_telp'] ?? '-' ?></span>
                </div>
                <div class="d-flex justify-content-between mb-3">
                    <span class="text-muted small"><i class="fas fa-user-circle me-2"></i> Username</span>
                    <span class="fw-medium text-dark small"><?= $user['username'] ?></span>
                </div>
                <hr>
                <div class="text-center">
                    <span class="badge-soft badge-soft-success px-3 py-2"><i class="fas fa-check-circle me-1"></i> Petugas Aktif</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Profil -->
    <div class="col-lg-8">
        <div class="card profile-card">
            <div class="card-header bg-white border-0 pt-4 pb-0 px-4">
                <h5 class="fw-bold text-dark m-0">Edit Informasi Profil</h5>
            </div>
            <div class="card-body p-4">
                <form action="<?= base_url('petugas/update_profil') ?>" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label-custom">Nama Lengkap</label>
                            <input type="text" name="nama" class="form-control form-control-premium" value="<?= $user['nama'] ?>" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label-custom">Username</label>
                            <input type="text" class="form-control form-control-premium" value="<?= $user['username'] ?>" readonly>
                            <small class="text-muted">Username tidak dapat diubah.</small>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label-custom">Email</label>
                            <input type="email" name="email" class="form-control form-control-premium" value="<?= $user['email'] ?>">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label-custom">Nomor Telepon</label>
                            <input type="text" name="no_telp" class="form-control form-control-premium" value="<?= $user['no_telp'] ?>">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label-custom">Alamat Lengkap</label>
                        <textarea name="alamat" class="form-control form-control-premium" rows="3"><?= $user['alamat'] ?></textarea>
                    </div>

                    <div class="mb-4">
                        <label class="form-label-custom">Unggah Foto Profil Baru</label>
                        <input type="file" name="foto_profile" class="form-control form-control-premium" accept="image/*">
                        <small class="text-muted">Maksimal file 2MB dengan format JPG, JPEG, atau PNG.</small>
                    </div>

                    <hr class="mb-4">
                    <h6 class="section-title-premium">Keamanan Akun</h6>
                    
                    <div class="row mb-4">
                        <div class="col-md-6 mb-3">
                            <label class="form-label-custom">Password Baru</label>
                            <div class="input-group">
                                <input type="password" name="password" id="password" class="form-control form-control-premium" style="border-top-right-radius: 0; border-bottom-right-radius: 0; border-right: 0;" placeholder="Kosongkan jika tidak ingin mengubah">
                                <button class="btn btn-outline-secondary" type="button" id="togglePassword" style="border-top-right-radius: 10px; border-bottom-right-radius: 10px; border-color: #cbd5e1; border-left: 0; background-color: #f8fafc; color: #64748b; transition: all 0.2s ease;">
                                    <i class="fas fa-eye" id="eyeIcon"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-save-premium px-4"><i class="fas fa-save me-2"></i> Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="<?= base_url('assets/js/peminjam-profil.js') ?>"></script>
