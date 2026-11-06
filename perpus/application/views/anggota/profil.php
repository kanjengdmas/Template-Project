<div class="row g-4">
    <div class="col-md-4">
        <div class="card card-modern">
            <div class="card-body text-center py-5">
                <div class="position-relative d-inline-block mb-4">
                    <img src="<?= base_url('assets/img/users/'.($user->foto ? $user->foto : 'default.jpg')) ?>" class="rounded-circle shadow" width="150" height="150" style="object-fit:cover;" id="previewFoto">
                    <label for="fotoInput" class="position-absolute bottom-0 end-0 bg-primary text-white rounded-circle d-flex align-items-center justify-content-center shadow-sm" style="width: 40px; height: 40px; border: 3px solid white; cursor: pointer; transition: transform 0.2s;" title="Ubah Foto Profil" onmouseover="this.style.transform='scale(1.1)'" onmouseout="this.style.transform='scale(1)'">
                        <i class="fas fa-camera"></i>
                    </label>
                </div>
                <h4 class="fw-bold"><?= $user->nama ?></h4>
                <p class="text-muted mb-4">@<?= $user->username ?></p>
                <div class="badge bg-success p-2 rounded-pill w-50">Anggota</div>
            </div>
        </div>
    </div>
    
    <div class="col-md-8">
        <div class="card card-modern">
            <div class="card-body p-4">
                <h5 class="fw-bold mb-4">Edit Profil</h5>
                <form id="formProfil" enctype="multipart/form-data">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Nama Lengkap</label>
                            <input type="text" class="form-control" name="nama" value="<?= $user->nama ?>" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Username</label>
                            <input type="text" class="form-control" name="username" value="<?= $user->username ?>" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control" name="email" value="<?= $user->email ?>" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Telepon</label>
                            <input type="text" class="form-control" name="telepon" value="<?= $user->telepon ?>" required>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Alamat</label>
                            <textarea class="form-control" name="alamat" rows="3" required><?= $user->alamat ?></textarea>
                        </div>
                        <input type="file" name="foto" id="fotoInput" accept="image/*" class="d-none">
                        <div class="col-md-6">
                            <label class="form-label text-danger">Ganti Password <small>(Kosongkan jika tidak diubah)</small></label>
                            <div class="input-group">
                                <input type="password" class="form-control" name="password" id="password" placeholder="Password Baru" style="border-right: none;">
                                <span class="input-group-text bg-white text-muted" id="toggle-password-btn" style="cursor: pointer; border-left: none;"><i class="fas fa-eye"></i></span>
                            </div>
                        </div>
                        <div class="col-12 mt-4 text-end">
                            <button type="submit" class="btn btn-primary-custom px-4" id="btnSave">Simpan Perubahan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    window.AppConfig = {
        baseUrl: '<?= base_url() ?>'
    };
</script>
<script src="<?= base_url('assets/js/profil.js') ?>"></script>
