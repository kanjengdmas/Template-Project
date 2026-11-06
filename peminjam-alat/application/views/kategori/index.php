<link rel="stylesheet" href="<?= base_url('assets/css/kategori.css') ?>">

<div class="card border-0 table-container mb-4">
    <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center border-0 mt-2">
        <div>
            <h5 class="m-0 fw-bold text-dark">Daftar Kategori Alat</h5>
            <p class="text-muted small m-0 mt-1">Kelola jenis dan pengelompokan inventaris alat Sipanja</p>
        </div>
        <button class="btn btn-primary btn-sm px-3 py-2 fw-semibold shadow-sm d-flex align-items-center gap-2" style="border-radius: 10px;" data-bs-toggle="modal" data-bs-target="#tambahModal">
            <i class="fas fa-plus"></i> Tambah Kategori
        </button>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-custom datatable">
                <thead>
                    <tr>
                        <th width="8%" class="text-center">No</th>
                        <th>Nama Kategori</th>
                        <th width="15%" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; foreach ($kategori as $k) : ?>
                    <tr>
                        <td class="text-center fw-semibold text-muted"><?= $no++ ?></td>
                        <td class="fw-semibold text-dark"><?= $k['nama_kategori'] ?></td>
                        <td>
                            <div class="d-flex justify-content-center gap-1">
                                <button class="btn-action btn-action-edit edit-btn" 
                                    data-id="<?= $k['id'] ?>" 
                                    data-nama="<?= $k['nama_kategori'] ?>" 
                                    data-bs-toggle="modal" data-bs-target="#editModal"
                                    title="Edit Kategori">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <a href="<?= base_url('kategori/hapus/'.$k['id']) ?>" class="btn-action btn-action-delete btn-hapus" title="Hapus Kategori">
                                    <i class="fas fa-trash"></i>
                                </a>
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
    <div class="modal-dialog">
        <form action="<?= base_url('kategori/simpan') ?>" method="post">
            <div class="modal-content" style="border-radius: 14px; overflow: hidden; border: none;">
                <div class="modal-header bg-light border-0 py-3">
                    <h5 class="modal-title fw-bold text-dark"><i class="fas fa-plus-circle text-primary me-2"></i> Tambah Kategori</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body py-4">
                    <div class="mb-3">
                        <label class="form-label fw-semibold text-secondary small">Nama Kategori</label>
                        <input type="text" name="nama_kategori" class="form-control py-2" required placeholder="Masukkan nama kategori baru">
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
    <div class="modal-dialog">
        <form action="<?= base_url('kategori/edit') ?>" method="post">
            <div class="modal-content" style="border-radius: 14px; overflow: hidden; border: none;">
                <div class="modal-header bg-light border-0 py-3">
                    <h5 class="modal-title fw-bold text-dark"><i class="fas fa-edit text-warning me-2"></i> Edit Kategori</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body py-4">
                    <input type="hidden" name="id" id="edit-id">
                    <div class="mb-3">
                        <label class="form-label fw-semibold text-secondary small">Nama Kategori</label>
                        <input type="text" name="nama_kategori" id="edit-nama" class="form-control py-2" required placeholder="Masukkan nama kategori">
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

<script src="<?= base_url('assets/js/kategori.js') ?>"></script>
