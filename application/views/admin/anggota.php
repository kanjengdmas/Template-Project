<div class="card card-modern">
    <div class="card-body">
        <button class="btn btn-primary-custom mb-4" onclick="tambahAnggota()">
            <i class="fas fa-plus me-2"></i>Tambah Anggota
        </button>

        <div class="table-responsive">
            <table class="table table-hover datatable w-100">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Anggota</th>
                        <th>Username</th>
                        <th>Kontak</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no=1; foreach($anggota as $a): ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td>
                            <div class="d-flex align-items-center">
                                <img src="<?= base_url('assets/img/users/' . (!empty($a->foto) ? $a->foto : 'default.jpg')) ?>" class="rounded-circle me-3" width="40" height="40" style="object-fit:cover;">
                                <strong><?= $a->nama ?></strong>
                            </div>
                        </td>
                        <td><span class="badge bg-light text-dark border"><?= $a->username ?></span></td>
                        <td>
                            <small><i class="fas fa-envelope text-muted me-1"></i> <?= $a->email ?></small><br>
                            <small><i class="fas fa-phone text-muted me-1"></i> <?= $a->telepon ?></small>
                        </td>
                        <td>
                            <button class="btn btn-sm btn-info text-white" onclick="detailAnggota(<?= $a->id_user ?>)" title="Detail"><i class="fas fa-eye"></i></button>
                            <button class="btn btn-sm btn-warning text-white" onclick="editAnggota(<?= $a->id_user ?>)" title="Edit"><i class="fas fa-edit"></i></button>
                            <button class="btn btn-sm btn-danger" onclick="hapusAnggota(<?= $a->id_user ?>)" title="Hapus"><i class="fas fa-trash"></i></button>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Form Anggota -->
<div class="modal fade" id="modalAnggota" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-light">
                <h5 class="modal-title fw-bold" id="modalTitle">Tambah Anggota</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="formAnggota">
                <div class="modal-body">
                    <input type="hidden" name="id_user" id="id_user">
                    <div class="mb-3">
                        <label class="form-label">Nama Lengkap</label>
                        <input type="text" class="form-control" name="nama" id="nama" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Username</label>
                        <input type="text" class="form-control" name="username" id="username" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Password <small class="text-muted" id="passHelp">(Kosongkan jika tidak diubah)</small></label>
                        <input type="password" class="form-control" name="password" id="password">
                    </div>
                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control" name="email" id="email" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Telepon</label>
                            <input type="text" class="form-control" name="telepon" id="telepon" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Alamat</label>
                        <textarea class="form-control" name="alamat" id="alamat" rows="2" required></textarea>
                    </div>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary-custom" id="btnSave">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Detail -->
<div class="modal fade" id="modalDetail" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-light">
                <h5 class="modal-title fw-bold">Detail Anggota</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body text-center" id="detailContent">
                <!-- Content loaded via AJAX -->
            </div>
        </div>
    </div>
</div>

<script>
    window.AppConfig = {
        baseUrl: '<?= base_url() ?>'
    };
</script>
<script src="<?= base_url('assets/js/admin_anggota.js') ?>"></script>
