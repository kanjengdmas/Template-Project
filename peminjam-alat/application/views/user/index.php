<link rel="stylesheet" href="<?= base_url('assets/css/user.css') ?>">

<div class="card border-0 table-container mb-4">
    <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center border-0 mt-2">
        <div>
            <h5 class="m-0 fw-bold text-dark">Daftar Akun Pengguna</h5>
            <p class="text-muted small m-0 mt-1">Kelola data pengguna, hak akses, dan profil peminjam Sipanja</p>
        </div>
        <button class="btn btn-primary btn-sm px-3 py-2 fw-semibold shadow-sm d-flex align-items-center gap-2" style="border-radius: 10px;" data-bs-toggle="modal" data-bs-target="#tambahModal">
            <i class="fas fa-plus"></i> Tambah User
        </button>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-custom datatable">
                <thead>
                    <tr>
                        <th width="5%" class="text-center">No</th>
                        <th>Nama</th>
                        <th>Username</th>
                        <th>Role</th>
                        <th>NIM/NIK</th>
                        <th>No Telp</th>
                        <th width="15%" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; foreach ($users as $u) : ?>
                    <tr>
                        <td class="text-center fw-semibold text-muted"><?= $no++ ?></td>
                        <td class="fw-semibold text-dark"><?= $u['nama'] ?></td>
                        <td><span class="text-secondary"><?= $u['username'] ?></span></td>
                        <td>
                            <?php if($u['role'] == 'Admin'): ?>
                                <span class="badge badge-soft badge-soft-danger"><i class="fas fa-user-shield"></i> Admin</span>
                            <?php elseif($u['role'] == 'Petugas'): ?>
                                <span class="badge badge-soft badge-soft-warning"><i class="fas fa-user-cog"></i> Petugas</span>
                            <?php else: ?>
                                <span class="badge badge-soft badge-soft-info"><i class="fas fa-user"></i> Peminjam</span>
                            <?php endif; ?>
                        </td>
                        <td class="fw-medium text-slate-600"><?= $u['nim_nik'] ? $u['nim_nik'] : '-' ?></td>
                        <td class="text-slate-600"><?= $u['no_telp'] ? $u['no_telp'] : '-' ?></td>
                        <td>
                            <div class="d-flex justify-content-center gap-1">
                                <button class="btn-action btn-action-view detail-btn" 
                                    data-nama="<?= $u['nama'] ?>"
                                    data-username="<?= $u['username'] ?>"
                                    data-role="<?= $u['role'] ?>"
                                    data-nim="<?= $u['nim_nik'] ?>"
                                    data-telp="<?= $u['no_telp'] ?>"
                                    data-alamat="<?= $u['alamat'] ?>"
                                    data-bs-toggle="modal" data-bs-target="#detailModal"
                                    title="Detail Profil">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <button class="btn-action btn-action-edit edit-btn" 
                                    data-id="<?= $u['id'] ?>" 
                                    data-nama="<?= $u['nama'] ?>" 
                                    data-role="<?= $u['role'] ?>" 
                                    data-nim="<?= $u['nim_nik'] ?>" 
                                    data-telp="<?= $u['no_telp'] ?>" 
                                    data-alamat="<?= $u['alamat'] ?>" 
                                    data-bs-toggle="modal" data-bs-target="#editModal"
                                    title="Edit Akun">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <?php if($u['id'] != $this->session->userdata('id')): ?>
                                <a href="<?= base_url('user/hapus/'.$u['id']) ?>" class="btn-action btn-action-delete btn-hapus" title="Hapus Akun">
                                    <i class="fas fa-trash"></i>
                                </a>
                                <?php endif; ?>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Tambah -->
<div class="modal fade" id="tambahModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <form action="<?= base_url('user/simpan') ?>" method="post">
            <div class="modal-content" style="border-radius: 14px; overflow: hidden; border: none;">
                <div class="modal-header bg-light border-0 py-3">
                    <h5 class="modal-title fw-bold text-dark"><i class="fas fa-user-plus text-primary me-2"></i> Tambah User Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body py-4">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold text-secondary small">Nama Lengkap <span class="text-danger">*</span></label>
                            <input type="text" name="nama" class="form-control py-2" required placeholder="Masukkan nama lengkap">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold text-secondary small">Username <span class="text-danger">*</span></label>
                            <input type="text" name="username" class="form-control py-2" required placeholder="Masukkan username">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold text-secondary small">Password <span class="text-danger">*</span></label>
                            <input type="password" name="password" class="form-control py-2" required minlength="5" placeholder="Masukkan password (min. 5 karakter)">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold text-secondary small">Role <span class="text-danger">*</span></label>
                            <select name="role" class="form-control py-2" required>
                                <option value="Peminjam">Peminjam</option>
                                <option value="Petugas">Petugas</option>
                                <option value="Admin">Admin</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold text-secondary small">NIM / NIK / NIP (Opsional)</label>
                            <input type="text" name="nim_nik" class="form-control py-2" placeholder="Masukkan NIM/NIK/NIP">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold text-secondary small">No Telepon (Opsional)</label>
                            <input type="text" name="no_telp" class="form-control py-2" placeholder="Masukkan no telp/WhatsApp">
                        </div>
                        <div class="col-md-12 mb-3">
                            <label class="form-label fw-semibold text-secondary small">Alamat (Opsional)</label>
                            <textarea name="alamat" class="form-control py-2" rows="2" placeholder="Masukkan alamat lengkap"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer bg-light border-0 py-3">
                    <button type="button" class="btn btn-secondary px-3 py-2" style="border-radius: 8px;" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary px-3 py-2" style="border-radius: 8px;">Simpan</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Modal Edit -->
<div class="modal fade" id="editModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <form action="<?= base_url('user/edit') ?>" method="post">
            <div class="modal-content" style="border-radius: 14px; overflow: hidden; border: none;">
                <div class="modal-header bg-light border-0 py-3">
                    <h5 class="modal-title fw-bold text-dark"><i class="fas fa-user-edit text-warning me-2"></i> Edit Data User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body py-4">
                    <input type="hidden" name="id" id="edit-id">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold text-secondary small">Nama Lengkap <span class="text-danger">*</span></label>
                            <input type="text" name="nama" id="edit-nama" class="form-control py-2" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold text-secondary small">Role <span class="text-danger">*</span></label>
                            <select name="role" id="edit-role" class="form-control py-2" required>
                                <option value="Peminjam">Peminjam</option>
                                <option value="Petugas">Petugas</option>
                                <option value="Admin">Admin</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold text-secondary small">Password Baru (Kosongkan jika tidak diubah)</label>
                            <input type="password" name="password" class="form-control py-2" minlength="5" placeholder="Masukkan password baru jika ingin diubah">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold text-secondary small">NIM / NIK / NIP</label>
                            <input type="text" name="nim_nik" id="edit-nim" class="form-control py-2">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold text-secondary small">No Telepon</label>
                            <input type="text" name="no_telp" id="edit-telp" class="form-control py-2">
                        </div>
                        <div class="col-md-12 mb-3">
                            <label class="form-label fw-semibold text-secondary small">Alamat</label>
                            <textarea name="alamat" id="edit-alamat" class="form-control py-2" rows="2"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer bg-light border-0 py-3">
                    <button type="button" class="btn btn-secondary px-3 py-2" style="border-radius: 8px;" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary px-3 py-2" style="border-radius: 8px;">Update</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Modal Detail -->
<div class="modal fade" id="detailModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content" style="border-radius: 14px; overflow: hidden; border: none;">
            <div class="modal-header bg-light border-0 py-3">
                <h5 class="modal-title fw-bold text-dark"><i class="fas fa-id-card text-info me-2"></i> Detail Profil Pengguna</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body text-center py-4">
                <div class="mb-3 d-inline-flex align-items-center justify-content-center" style="width: 80px; height: 80px; border-radius: 50%; background-color: #f0f4ff; color: #0a3fd6;">
                    <i class="fas fa-user fa-3x"></i>
                </div>
                <h4 id="detail-nama" class="fw-bold text-dark mb-1"></h4>
                <div class="d-flex justify-content-center mb-4">
                    <span id="detail-role-badge" class="badge badge-soft"></span>
                </div>
                
                <div class="px-2">
                    <table class="table table-sm table-borderless text-start mb-0">
                        <tr style="border-bottom: 1px solid #f1f5f9;"><th class="py-2 text-secondary fw-semibold" width="35%">Username</th><td class="py-2 text-dark" id="detail-username"></td></tr>
                        <tr style="border-bottom: 1px solid #f1f5f9;"><th class="py-2 text-secondary fw-semibold">NIM / NIK / NIP</th><td class="py-2 text-dark" id="detail-nim"></td></tr>
                        <tr style="border-bottom: 1px solid #f1f5f9;"><th class="py-2 text-secondary fw-semibold">No Telepon</th><td class="py-2 text-dark" id="detail-telp"></td></tr>
                        <tr><th class="py-2 text-secondary fw-semibold">Alamat</th><td class="py-2 text-dark" id="detail-alamat"></td></tr>
                    </table>
                </div>
            </div>
            <div class="modal-footer bg-light border-0 py-3">
                <button type="button" class="btn btn-secondary px-4 py-2" style="border-radius: 8px;" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
<script src="<?= base_url('assets/js/user.js') ?>"></script>
