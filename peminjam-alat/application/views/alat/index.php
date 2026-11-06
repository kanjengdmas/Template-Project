<link rel="stylesheet" href="<?= base_url('assets/css/alat.css') ?>">

<div class="card border-0 table-container mb-4">
    <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center border-0 mt-2">
        <div>
            <h5 class="m-0 fw-bold text-dark">Daftar Alat</h5>
            <p class="text-muted small m-0 mt-1">Kelola data alat dan inventaris Sipanja secara real-time</p>
        </div>
        <button class="btn btn-primary btn-sm px-3 py-2 fw-semibold shadow-sm d-flex align-items-center gap-2" style="border-radius: 10px;" data-bs-toggle="modal" data-bs-target="#tambahModal">
            <i class="fas fa-plus"></i> Tambah Alat
        </button>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-custom datatable">
                <thead>
                    <tr>
                        <th width="5%" class="text-center">No</th>
                        <th width="10%" class="text-center">Foto</th>
                        <th>Kode</th>
                        <th>Nama Alat</th>
                        <th>Kategori</th>
                        <th>Stok</th>
                        <th>Kondisi</th>
                        <th>Status</th>
                        <th width="15%" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; foreach ($alat as $a) : ?>
                    <tr>
                        <td class="text-center fw-semibold text-muted"><?= $no++ ?></td>
                        <td class="text-center">
                            <img src="<?= base_url('assets/img/'.$a['foto_alat']) ?>" alt="<?= $a['nama_alat'] ?>" class="img-alat-thumb">
                        </td>
                        <td><span class="badge badge-soft badge-soft-primary"><?= $a['kode_alat'] ?></span></td>
                        <td class="fw-semibold text-dark"><?= $a['nama_alat'] ?></td>
                        <td><span class="text-secondary"><?= $a['nama_kategori'] ?></span></td>
                        <td>
                            <?php if($a['stok'] == 0): ?>
                                <span class="badge badge-soft badge-soft-danger">Habis</span>
                            <?php elseif($a['stok'] <= 5): ?>
                                <span class="badge badge-soft badge-soft-warning"><?= $a['stok'] ?> Pcs (Kritis)</span>
                            <?php else: ?>
                                <span class="badge badge-soft badge-soft-secondary"><?= $a['stok'] ?> Pcs</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <?php if($a['kondisi'] == 'Baik'): ?>
                                <span class="badge badge-soft badge-soft-success"><i class="fas fa-check-circle"></i> Baik</span>
                            <?php elseif($a['kondisi'] == 'Rusak Ringan'): ?>
                                <span class="badge badge-soft badge-soft-warning"><i class="fas fa-exclamation-triangle"></i> Rusak Ringan</span>
                            <?php else: ?>
                                <span class="badge badge-soft badge-soft-danger"><i class="fas fa-times-circle"></i> Rusak Berat</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <?php if($a['status_ketersediaan'] == 'Tersedia'): ?>
                                <span class="badge badge-soft badge-soft-success">Tersedia</span>
                            <?php else: ?>
                                <span class="badge badge-soft badge-soft-danger">Tidak Tersedia</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <div class="d-flex justify-content-center gap-1">
                                <button class="btn-action btn-action-view detail-btn" 
                                    data-kode="<?= $a['kode_alat'] ?>"
                                    data-nama="<?= $a['nama_alat'] ?>"
                                    data-kategori="<?= $a['nama_kategori'] ?>"
                                    data-stok="<?= $a['stok'] ?>"
                                    data-kondisi="<?= $a['kondisi'] ?>"
                                    data-lokasi="<?= $a['lokasi_penyimpanan'] ?>"
                                    data-status="<?= $a['status_ketersediaan'] ?>"
                                    data-foto="<?= base_url('assets/img/'.$a['foto_alat']) ?>"
                                    data-bs-toggle="modal" data-bs-target="#detailModal"
                                    title="Detail Alat">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <button class="btn-action btn-action-edit edit-btn" 
                                    data-id="<?= $a['id'] ?>" 
                                    data-nama="<?= $a['nama_alat'] ?>" 
                                    data-kategori="<?= $a['kategori_id'] ?>" 
                                    data-stok="<?= $a['stok'] ?>" 
                                    data-kondisi="<?= $a['kondisi'] ?>" 
                                    data-lokasi="<?= $a['lokasi_penyimpanan'] ?>" 
                                    data-status="<?= $a['status_ketersediaan'] ?>" 
                                    data-bs-toggle="modal" data-bs-target="#editModal"
                                    title="Edit Alat">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <a href="<?= base_url('alat/hapus/'.$a['id']) ?>" class="btn-action btn-action-delete btn-hapus" title="Hapus Alat">
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
    <div class="modal-dialog modal-lg">
        <form action="<?= base_url('alat/simpan') ?>" method="post" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Data Alat</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label>Kode Alat</label>
                            <input type="text" name="kode_alat" class="form-control" value="<?= isset($next_kode) ? $next_kode : '' ?>" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Nama Alat</label>
                            <input type="text" name="nama_alat" class="form-control" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Kategori</label>
                            <select name="kategori_id" class="form-control" required>
                                <option value="">- Pilih Kategori -</option>
                                <?php foreach($kategori as $k): ?>
                                    <option value="<?= $k['id'] ?>"><?= $k['nama_kategori'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Stok</label>
                            <input type="number" name="stok" class="form-control" min="0" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Kondisi</label>
                            <select name="kondisi" class="form-control" required>
                                <option value="Baik">Baik</option>
                                <option value="Rusak Ringan">Rusak Ringan</option>
                                <option value="Rusak Berat">Rusak Berat</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Status Ketersediaan</label>
                            <select name="status_ketersediaan" class="form-control" required>
                                <option value="Tersedia">Tersedia</option>
                                <option value="Tidak Tersedia">Tidak Tersedia</option>
                            </select>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label>Lokasi Penyimpanan</label>
                            <input type="text" name="lokasi_penyimpanan" class="form-control">
                        </div>
                        <div class="col-md-12 mb-3">
                            <label>Foto Alat (Opsional)</label>
                            <input type="file" name="foto_alat" class="form-control" accept="image/*">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Modal Edit -->
<div class="modal fade" id="editModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <form action="<?= base_url('alat/edit') ?>" method="post" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Data Alat</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id" id="edit-id">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label>Nama Alat</label>
                            <input type="text" name="nama_alat" id="edit-nama" class="form-control" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Kategori</label>
                            <select name="kategori_id" id="edit-kategori" class="form-control" required>
                                <?php foreach($kategori as $k): ?>
                                    <option value="<?= $k['id'] ?>"><?= $k['nama_kategori'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Stok</label>
                            <input type="number" name="stok" id="edit-stok" class="form-control" min="0" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Kondisi</label>
                            <select name="kondisi" id="edit-kondisi" class="form-control" required>
                                <option value="Baik">Baik</option>
                                <option value="Rusak Ringan">Rusak Ringan</option>
                                <option value="Rusak Berat">Rusak Berat</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Status Ketersediaan</label>
                            <select name="status_ketersediaan" id="edit-status" class="form-control" required>
                                <option value="Tersedia">Tersedia</option>
                                <option value="Tidak Tersedia">Tidak Tersedia</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Lokasi Penyimpanan</label>
                            <input type="text" name="lokasi_penyimpanan" id="edit-lokasi" class="form-control">
                        </div>
                        <div class="col-md-12 mb-3">
                            <label>Ganti Foto (Biarkan kosong jika tidak ingin ganti)</label>
                            <input type="file" name="foto_alat" class="form-control" accept="image/*">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Modal Detail -->
<div class="modal fade" id="detailModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detail Alat</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body text-center">
                <img id="detail-foto" src="" alt="Foto Alat" class="img-fluid rounded mb-3" style="max-height: 250px;">
                <h4 id="detail-nama" class="fw-bold mb-1"></h4>
                <p id="detail-kode" class="text-muted mb-3"></p>
                
                <table class="table table-sm table-bordered text-start">
                    <tr><th width="40%">Kategori</th><td id="detail-kategori"></td></tr>
                    <tr><th>Stok Tersedia</th><td id="detail-stok"></td></tr>
                    <tr><th>Kondisi</th><td id="detail-kondisi"></td></tr>
                    <tr><th>Lokasi</th><td id="detail-lokasi"></td></tr>
                    <tr><th>Status</th><td id="detail-status"></td></tr>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
<script src="<?= base_url('assets/js/alat.js') ?>"></script>
