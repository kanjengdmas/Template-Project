<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Data Obat</h1>
    <button class="btn btn-primary" data-toggle="modal" data-target="#addModal"><i class="fas fa-plus fa-sm text-white-50"></i> Tambah Obat</button>
</div>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Obat</th>
                        <th>Jenis Obat</th>
                        <th>Stok</th>
                        <th>Deskripsi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; foreach ($obat as $o): ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $o->nama_obat ?></td>
                        <td><?= $o->jenis_obat ?></td>
                        <td>
                            <?php 
                                if($o->stok > 20) {
                                    echo '<span class="badge badge-success">Aman ('.$o->stok.')</span>';
                                } elseif($o->stok > 0) {
                                    echo '<span class="badge badge-warning">Menipis ('.$o->stok.')</span>';
                                } else {
                                    echo '<span class="badge badge-danger">Habis</span>';
                                }
                            ?>
                        </td>
                        <td><?= $o->deskripsi_obat ?></td>
                        <td>
                            <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editModal<?= $o->id ?>"><i class="fas fa-edit"></i> Edit</button>
                            <button class="btn btn-danger btn-sm" onclick="confirmDelete('<?= base_url('admin/obat_delete/'.$o->id) ?>')"><i class="fas fa-trash"></i> Hapus</button>
                        </td>
                    </tr>

                    <!-- Edit Modal -->
                    <div class="modal fade" id="editModal<?= $o->id ?>" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <form action="<?= base_url('admin/obat_edit') ?>" method="post">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Edit Obat</h5>
                                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <input type="hidden" name="id" value="<?= $o->id ?>">
                                        <div class="form-group">
                                            <label>Nama Obat</label>
                                            <input type="text" class="form-control" name="nama_obat" value="<?= $o->nama_obat ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Jenis Obat</label>
                                            <select class="form-control" name="jenis_obat" required>
                                                <option value="Tablet" <?= $o->jenis_obat == 'Tablet' ? 'selected' : '' ?>>Tablet</option>
                                                <option value="Sirup" <?= $o->jenis_obat == 'Sirup' ? 'selected' : '' ?>>Sirup</option>
                                                <option value="Kapsul" <?= $o->jenis_obat == 'Kapsul' ? 'selected' : '' ?>>Kapsul</option>
                                                <option value="Salep" <?= $o->jenis_obat == 'Salep' ? 'selected' : '' ?>>Salep</option>
                                                <option value="Tetes" <?= $o->jenis_obat == 'Tetes' ? 'selected' : '' ?>>Tetes</option>
                                                <option value="Lainnya" <?= $o->jenis_obat == 'Lainnya' ? 'selected' : '' ?>>Lainnya</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Stok</label>
                                            <input type="number" class="form-control" name="stok" value="<?= $o->stok ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Deskripsi Obat</label>
                                            <textarea class="form-control" name="deskripsi_obat" rows="3"><?= $o->deskripsi_obat ?></textarea>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                                        <button class="btn btn-primary" type="submit">Simpan Perubahan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Add Modal -->
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="<?= base_url('admin/obat_add') ?>" method="post">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Obat</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nama Obat</label>
                        <input type="text" class="form-control" name="nama_obat" required>
                    </div>
                    <div class="form-group">
                        <label>Jenis Obat</label>
                        <select class="form-control" name="jenis_obat" required>
                            <option value="Tablet">Tablet</option>
                            <option value="Sirup">Sirup</option>
                            <option value="Kapsul">Kapsul</option>
                            <option value="Salep">Salep</option>
                            <option value="Tetes">Tetes</option>
                            <option value="Lainnya">Lainnya</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Stok</label>
                        <input type="number" class="form-control" name="stok" required>
                    </div>
                    <div class="form-group">
                        <label>Deskripsi Obat</label>
                        <textarea class="form-control" name="deskripsi_obat" rows="3"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                    <button class="btn btn-primary" type="submit">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function confirmDelete(url) {
    Swal.fire({
        title: 'Apakah Anda yakin?',
        text: "Data yang dihapus tidak dapat dikembalikan!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Ya, hapus!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = url;
        }
    })
}
</script>
