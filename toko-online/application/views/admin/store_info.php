<div class="container-fluid">

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Informasi Toko</h1>
        <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#editModal">
            <i class="fas fa-edit fa-sm text-white-50"></i> Edit Informasi
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

    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3 text-center mb-4">
                            <img src="<?php echo base_url('assets/img/logo.png'); ?>" alt="Logo Toko" class="img-fluid rounded-xl border-accent p-1 shadow-glow-emerald" style="max-width: 180px;">
                            <h4 class="mt-4 font-weight-bold text-accent"><?php echo $store['name']; ?></h4>
                        </div>
                        <div class="col-md-9">
                            <table class="table table-borderless">
                                <tr>
                                    <th width="200">Nama Toko</th>
                                    <td>: <?php echo $store['name']; ?></td>
                                </tr>
                                <tr>
                                    <th>Alamat</th>
                                    <td>: <?php echo $store['address']; ?></td>
                                </tr>
                                <tr>
                                    <th>Email</th>
                                    <td>: <?php echo $store['email']; ?></td>
                                </tr>
                                <tr>
                                    <th>WhatsApp</th>
                                    <td>: <?php echo $store['whatsapp']; ?></td>
                                </tr>
                                <tr>
                                    <th>Jam Operasional</th>
                                    <td>: <?php echo $store['hours']; ?></td>
                                </tr>
                                <tr>
                                    <th>Link Google Maps</th>
                                    <td>: <a href="<?php echo $store['maps_link']; ?>" target="_blank" class="text-truncate d-inline-block" style="max-width: 400px;"><?php echo $store['maps_link']; ?></a></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Informasi Toko</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?php echo base_url('admin/kontak/update'); ?>" method="POST">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Nama Toko</label>
                                <input type="text" name="name" class="form-control" value="<?php echo $store['name']; ?>" required>
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" name="email" class="form-control" value="<?php echo $store['email']; ?>" required>
                            </div>
                            <div class="form-group">
                                <label>WhatsApp</label>
                                <input type="text" name="whatsapp" class="form-control" value="<?php echo $store['whatsapp']; ?>" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Jam Operasional</label>
                                <input type="text" name="hours" class="form-control" value="<?php echo $store['hours']; ?>" required>
                            </div>
                            <div class="form-group">
                                <label>Alamat</label>
                                <textarea name="address" class="form-control" rows="2" required><?php echo $store['address']; ?></textarea>
                            </div>
                            <div class="form-group">
                                <label>Link Google Maps</label>
                                <input type="text" name="maps_link" class="form-control" value="<?php echo $store['maps_link']; ?>" required>
                            </div>
                        </div>
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

</div>
<!-- End of Main Content -->
