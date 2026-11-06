<div class="container-fluid">

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Manajemen Tim Kami</h1>
        <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addModal">
            <i class="fas fa-plus fa-sm text-white-50"></i> Tambah Anggota Tim
        </button>
    </div>

    <?php if($this->session->flashdata('success')): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?php echo $this->session->flashdata('success'); ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php endif; ?>

    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Foto</th>
                            <th>Nama</th>
                            <th>Jabatan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no=1; foreach($team as $t): ?>
                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td><img src="<?php echo base_url('assets/img/'.$t['photo']); ?>" alt="Foto" width="50" class="rounded"></td>
                            <td><?php echo $t['name']; ?></td>
                            <td><?php echo $t['position']; ?></td>
                            <td>
                                <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editModal<?php echo $t['id']; ?>">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <a href="<?php echo base_url('admin/tim/delete/'.$t['id']); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Hapus anggota tim ini?')">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </td>
                        </tr>

                        <!-- Edit Modal -->
                        <div class="modal fade" id="editModal<?php echo $t['id']; ?>" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Edit Anggota Tim</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form action="<?php echo base_url('admin/tim/edit'); ?>" method="POST" enctype="multipart/form-data">
                                        <div class="modal-body">
                                            <input type="hidden" name="id" value="<?php echo $t['id']; ?>">
                                            <div class="form-group">
                                                <label>Nama Anggota</label>
                                                <input type="text" name="name" class="form-control" value="<?php echo $t['name']; ?>" required>
                                            </div>
                                            <div class="form-group">
                                                <label>Jabatan</label>
                                                <input type="text" name="position" class="form-control" value="<?php echo $t['position']; ?>" required>
                                            </div>
                                            <div class="form-group">
                                                <label>Foto Anggota</label>
                                                <input type="file" name="photo" class="form-control-file">
                                                <small class="text-muted">Pilih file jika ingin mengganti foto. (Format: jpg, png, webp)</small>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
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

</div>

<!-- Add Modal -->
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Anggota Tim Baru</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?php echo base_url('admin/tim/add'); ?>" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nama Anggota</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Jabatan</label>
                        <input type="text" name="position" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Foto Anggota</label>
                        <input type="file" name="photo" class="form-control-file" required>
                        <small class="text-muted">Pilih foto anggota tim. (Format: jpg, png, webp)</small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>

</div>
<!-- End of Main Content -->
