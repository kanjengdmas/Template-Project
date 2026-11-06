<div class="card card-modern">
    <div class="card-body">
        <button class="btn btn-primary-custom mb-4" onclick="tambahBuku()">
            <i class="fas fa-plus me-2"></i>Tambah Buku
        </button>

        <div class="table-responsive">
            <table class="table table-hover datatable w-100">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Cover</th>
                        <th>Judul Buku</th>
                        <th>Kategori</th>
                        <th>Stok</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no=1; foreach($buku as $b): ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td>
                            <img src="<?= base_url('assets/img/buku/' . (!empty($b->cover) ? $b->cover : 'default_book.jpg')) ?>" class="rounded" width="50" height="70" style="object-fit:cover;">
                        </td>
                        <td>
                            <strong><?= $b->judul ?></strong><br>
                            <small class="text-muted"><?= $b->penulis ?></small>
                        </td>
                        <td><span class="badge bg-secondary"><?= $b->nama_kategori ?></span></td>
                        <td>
                            <?php if($b->stok > 0): ?>
                                <span class="badge bg-success"><?= $b->stok ?></span>
                            <?php else: ?>
                                <span class="badge bg-danger">Habis</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <button class="btn btn-sm btn-info text-white" onclick="detailBuku(<?= $b->id_buku ?>)" title="Detail"><i class="fas fa-eye"></i></button>
                            <button class="btn btn-sm btn-warning text-white" onclick="editBuku(<?= $b->id_buku ?>)" title="Edit"><i class="fas fa-edit"></i></button>
                            <button class="btn btn-sm btn-danger" onclick="hapusBuku(<?= $b->id_buku ?>)" title="Hapus"><i class="fas fa-trash"></i></button>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Form Buku -->
<div class="modal fade" id="modalBuku" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-light">
                <h5 class="modal-title fw-bold" id="modalTitle">Tambah Buku</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="formBuku">
                <div class="modal-body">
                    <input type="hidden" name="id_buku" id="id_buku">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Judul Buku</label>
                            <input type="text" class="form-control" name="judul" id="judul" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Kategori</label>
                            <select class="form-select" name="id_kategori" id="id_kategori" required>
                                <option value="">Pilih Kategori...</option>
                                <?php foreach($kategori as $k): ?>
                                    <option value="<?= $k->id_kategori ?>"><?= $k->nama_kategori ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Penulis</label>
                            <input type="text" class="form-control" name="penulis" id="penulis" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Penerbit</label>
                            <input type="text" class="form-control" name="penerbit" id="penerbit" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Tahun Terbit</label>
                            <input type="number" class="form-control" name="tahun_terbit" id="tahun_terbit" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Stok</label>
                            <input type="number" class="form-control" name="stok" id="stok" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Cover (Kosongkan jika tidak diubah)</label>
                            <input type="file" class="form-control" name="cover" id="cover" accept="image/*">
                            <div id="previewContainer" class="mt-2" style="display: none;">
                                <small class="text-muted d-block mb-1">Preview Cover:</small>
                                <img id="coverPreview" class="img-thumbnail" style="max-height: 80px; object-fit: cover;">
                            </div>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Deskripsi</label>
                            <textarea class="form-control" name="deskripsi" id="deskripsi" rows="3"></textarea>
                        </div>
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
                <h5 class="modal-title fw-bold">Detail Buku</h5>
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
<script src="<?= base_url('assets/js/admin_buku.js') ?>"></script>
