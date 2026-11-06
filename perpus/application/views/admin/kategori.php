<div class="row">
    <div class="col-md-8">
        <div class="card card-modern">
            <div class="card-body">
                <button class="btn btn-primary-custom mb-4" onclick="tambahKategori()">
                    <i class="fas fa-plus me-2"></i>Tambah Kategori
                </button>

                <div class="table-responsive">
                    <table class="table table-hover datatable w-100">
                        <thead>
                            <tr>
                                <th width="10%">No</th>
                                <th>Nama Kategori</th>
                                <th width="25%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no=1; foreach($kategori as $k): ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><strong><?= $k->nama_kategori ?></strong></td>
                                <td>
                                    <button class="btn btn-sm btn-warning text-white" onclick="editKategori(<?= $k->id_kategori ?>)" title="Edit"><i class="fas fa-edit"></i></button>
                                    <button class="btn btn-sm btn-danger" onclick="hapusKategori(<?= $k->id_kategori ?>)" title="Hapus"><i class="fas fa-trash"></i></button>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Form Kategori -->
<div class="modal fade" id="modalKategori" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-light">
                <h5 class="modal-title fw-bold" id="modalTitle">Tambah Kategori</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="formKategori">
                <div class="modal-body">
                    <input type="hidden" name="id_kategori" id="id_kategori">
                    <div class="mb-3">
                        <label class="form-label">Nama Kategori</label>
                        <input type="text" class="form-control" name="nama_kategori" id="nama_kategori" required>
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

<script>
    window.AppConfig = {
        baseUrl: '<?= base_url() ?>'
    };
</script>
<script src="<?= base_url('assets/js/admin_kategori.js') ?>"></script>
