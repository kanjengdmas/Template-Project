<div class="container-fluid">

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?php echo isset($title) ? $title : 'Manajemen User'; ?></h1>
        <?php if(!isset($page_type) || $page_type !== 'customer'): ?>
            <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addModal">
                <i class="fas fa-plus fa-sm text-white-50"></i> Tambah Staff
            </button>
        <?php endif; ?>
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
                            <th>Username</th>
                            <th>Nama Lengkap</th>
                            <th>Role</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no=1; foreach($users as $u): ?>
                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td><?php echo $u['username']; ?></td>
                            <td><?php echo $u['fullname']; ?></td>
                            <td><span class="badge badge-info"><?php echo strtoupper($u['role']); ?></span></td>
                            <td>
                                <?php if(isset($page_type) && $page_type === 'customer'): ?>
                                    <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#detailModal<?php echo $u['id']; ?>">
                                        <i class="fas fa-eye"></i> Detail
                                    </button>
                                <?php else: ?>
                                    <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editModal<?php echo $u['id']; ?>">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <a href="<?php echo base_url('admin/users/delete/'.$u['id']); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Hapus user ini?')">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                <?php endif; ?>
                            </td>
                        </tr>
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
                <h5 class="modal-title">Tambah User Baru</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?php echo base_url('admin/users/add'); ?>" method="POST">
                <div class="modal-body">
                    <div class="form-group">
                        <label>Username</label>
                        <input type="text" name="username" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Nama Lengkap</label>
                        <input type="text" name="fullname" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <div class="input-group">
                            <input type="password" name="password" class="form-control password-input" required>
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary toggle-password" type="button">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Role</label>
                        <select name="role" class="form-control">
                            <?php if(isset($page_type) && $page_type === 'customer'): ?>
                                <option value="customer" selected>Customer</option>
                            <?php else: ?>
                                <option value="admin">Admin</option>
                                <option value="kasir">Kasir</option>
                            <?php endif; ?>
                        </select>
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

<!-- Dynamic Modals for Users (Edit or Detail) -->
<?php foreach($users as $u): ?>
    <?php if(isset($page_type) && $page_type === 'customer'): ?>
    <!-- Detail Modal -->
    <div class="modal fade" id="detailModal<?php echo $u['id']; ?>" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-info text-white">
                    <h5 class="modal-title"><i class="fas fa-user mr-2"></i>Detail Customer</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="text-center mb-4">
                        <div class="d-inline-flex align-items-center justify-content-center bg-light rounded-circle shadow-sm" style="width: 80px; height: 80px;">
                            <i class="fas fa-user text-info fa-3x"></i>
                        </div>
                        <h4 class="mt-3 font-weight-bold text-gray-800"><?php echo $u['fullname']; ?></h4>
                        <span class="badge badge-pill badge-info px-3 py-1 text-uppercase tracking-wider">Customer</span>
                    </div>
                    <table class="table table-borderless table-striped">
                        <tr>
                            <th width="35%"><i class="fas fa-id-card text-info mr-2"></i> ID Customer</th>
                            <td>: #<?php echo $u['id']; ?></td>
                        </tr>
                        <tr>
                            <th><i class="fas fa-user-circle text-info mr-2"></i> Username</th>
                            <td>: <?php echo $u['username']; ?></td>
                        </tr>
                        <tr>
                            <th><i class="fas fa-envelope text-info mr-2"></i> Email</th>
                            <td>: <?php echo !empty($u['email']) ? $u['email'] : '-'; ?></td>
                        </tr>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
    <?php else: ?>
    <!-- Edit Modal -->
    <div class="modal fade" id="editModal<?php echo $u['id']; ?>" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?php echo base_url('admin/users/edit'); ?>" method="POST">
                    <div class="modal-body">
                        <input type="hidden" name="id" value="<?php echo $u['id']; ?>">
                        <div class="form-group">
                            <label>Username</label>
                            <input type="text" name="username" class="form-control" value="<?php echo $u['username']; ?>" required>
                        </div>
                        <div class="form-group">
                            <label>Nama Lengkap</label>
                            <input type="text" name="fullname" class="form-control" value="<?php echo $u['fullname']; ?>" required>
                        </div>
                        <div class="form-group">
                            <label>Password (Kosongkan jika tidak diganti)</label>
                            <div class="input-group">
                                <input type="password" name="password" class="form-control password-input">
                                <div class="input-group-append">
                                    <button class="btn btn-outline-secondary toggle-password" type="button">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Role</label>
                            <select name="role" class="form-control">
                                <option value="admin" <?php echo $u['role'] == 'admin' ? 'selected' : ''; ?>>Admin</option>
                                <option value="kasir" <?php echo $u['role'] == 'kasir' ? 'selected' : ''; ?>>Kasir</option>
                            </select>
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
    <?php endif; ?>
<?php endforeach; ?>

</div>
<!-- End of Main Content -->

<script src="<?php echo base_url('assets/js/admin-users.js'); ?>"></script>
