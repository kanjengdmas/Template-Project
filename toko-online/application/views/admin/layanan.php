<div class="container-fluid">

    <link rel="stylesheet" href="<?php echo base_url('assets/css/admin-table.css'); ?>">

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-white">Manajemen Layanan</h1>
        <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addModal">
            <i class="fas fa-plus fa-sm text-white-50"></i> Tambah Layanan
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

    <div class="card shadow mb-4 card-dark">
        <div class="card-body p-0">
            <div class="table-container table-responsive">
                <table class="table table-dark-custom" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th width="80">No</th>
                            <th width="100">Icon</th>
                            <th width="250">Judul</th>
                            <th>Deskripsi</th>
                            <th width="150" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no=1; foreach($layanan as $l): ?>
                        <tr>
                            <td class="text-muted"><?php echo $no++; ?></td>
                            <td class="text-info"><i class="fas <?php echo $l['icon']; ?> text-lg"></i></td>
                            <td class="font-weight-bold text-white"><?php echo $l['title']; ?></td>
                            <td class="text-muted"><?php echo $l['description']; ?></td>
                            <td class="text-center">
                                <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editModal<?php echo $l['id']; ?>">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <a href="<?php echo base_url('admin/layanan/delete/'.$l['id']); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Hapus layanan ini?')">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </td>
                        </tr>

                        <!-- Edit Modal -->
                        <div class="modal fade" id="editModal<?php echo $l['id']; ?>" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Edit Layanan</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form action="<?php echo base_url('admin/layanan/edit'); ?>" method="POST">
                                        <div class="modal-body">
                                            <input type="hidden" name="id" value="<?php echo $l['id']; ?>">
                                            <div class="form-group">
                                                <label>Judul Layanan</label>
                                                <input type="text" name="title" class="form-control" value="<?php echo $l['title']; ?>" required>
                                            </div>
                                            <div class="form-group">
                                                <label>Deskripsi</label>
                                                <textarea name="description" class="form-control" rows="3" required><?php echo $l['description']; ?></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label>FontAwesome Icon (Contoh: fa-shield-halved)</label>
                                                <input type="text" name="icon" class="form-control" value="<?php echo $l['icon']; ?>" required>
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
                <h5 class="modal-title">Tambah Layanan Baru</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?php echo base_url('admin/layanan/add'); ?>" method="POST">
                <div class="modal-body">
                    <div class="form-group">
                        <label>Judul Layanan</label>
                        <input type="text" name="title" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Deskripsi</label>
                        <textarea name="description" class="form-control" rows="3" required></textarea>
                    </div>
                    <div class="form-group">
                        <label>FontAwesome Icon (Contoh: fa-shield-halved)</label>
                        <input type="text" name="icon" class="form-control" required>
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
