<div class="container-fluid">

    <link rel="stylesheet" href="<?php echo base_url('assets/css/admin-table.css'); ?>">

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-white">Manajemen Tentang Kami</h1>
        <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#editAboutModal">
            <i class="fas fa-edit fa-sm text-white-50"></i> Edit Halaman Tentang
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
            <div class="card shadow mb-4 card-dark text-white">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4 text-center mb-4">
                            <?php if(!empty($store['about_image'])): ?>
                                <img src="<?php echo base_url('assets/img/'.$store['about_image']); ?>" alt="Banner Tentang" class="img-fluid rounded shadow-sm border border-secondary" style="max-height: 250px; object-fit: cover;">
                            <?php else: ?>
                                <div class="p-5 rounded text-muted" style="background: #24262d; border: 1px solid rgba(255, 255, 255, 0.05);">
                                    <i class="fas fa-image fa-3x mb-3 text-muted"></i>
                                    <p class="small mb-0">Belum ada gambar banner</p>
                                </div>
                            <?php endif; ?>
                            <h5 class="mt-3 font-weight-bold text-info">Banner Halaman</h5>
                        </div>
                        <div class="col-md-8">
                            <table class="table table-borderless text-white">
                                <tr>
                                    <th width="180" class="text-white font-weight-bold">Judul Halaman</th>
                                    <td>: <span class="font-weight-bold text-white"><?php echo htmlspecialchars($store['about_title'] ?? 'Tentang Kami'); ?></span></td>
                                </tr>
                                <tr>
                                    <th class="text-white font-weight-bold">Sub-Judul / Slogan</th>
                                    <td>: <span class="text-info"><?php echo htmlspecialchars($store['about_subtitle'] ?? ''); ?></span></td>
                                </tr>
                                <tr>
                                    <th class="align-top text-white font-weight-bold">Isi Konten / Deskripsi</th>
                                    <td>: 
                                        <div class="mt-1 p-3 rounded" style="background: #24262d; border: 1px solid rgba(255, 255, 255, 0.05); white-space: pre-wrap; font-size: 0.9rem; line-height: 1.6; color: #e2e8f0;">
                                            <?php echo htmlspecialchars($store['about_content'] ?? 'Belum ada konten.'); ?>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<!-- Edit About Modal -->
<div class="modal fade" id="editAboutModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Halaman Tentang Kami</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?php echo base_url('admin/tentang/update'); ?>" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group">
                        <label class="font-weight-bold text-dark">Judul Halaman</label>
                        <input type="text" name="about_title" class="form-control" value="<?php echo htmlspecialchars($store['about_title'] ?? ''); ?>" required placeholder="Contoh: Mengenal Lebih Dekat VERIDIAN Store">
                    </div>
                    <div class="form-group">
                        <label class="font-weight-bold text-dark">Sub-Judul / Slogan</label>
                        <input type="text" name="about_subtitle" class="form-control" value="<?php echo htmlspecialchars($store['about_subtitle'] ?? ''); ?>" required placeholder="Contoh: Solusi Gadget Apple & Android Premium Terpercaya Sejak 2020">
                    </div>
                    <div class="form-group">
                        <label class="font-weight-bold text-dark">Isi Konten / Deskripsi Tentang Kami</label>
                        <textarea name="about_content" class="form-control" rows="8" required placeholder="Tuliskan sejarah, latar belakang, komitmen, dan keunggulan toko Anda secara detail di sini..."><?php echo htmlspecialchars($store['about_content'] ?? ''); ?></textarea>
                    </div>
                    <div class="form-group">
                        <label class="font-weight-bold text-dark">Gambar Banner Halaman</label>
                        <input type="file" name="about_image" class="form-control-file">
                        <small class="text-muted d-block mt-1">Pilih gambar premium untuk mempercantik halaman Tentang Kami. (Format: jpg, png, webp, jpeg)</small>
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
