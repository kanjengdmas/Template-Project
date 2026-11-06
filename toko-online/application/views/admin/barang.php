<div class="container-fluid">

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Manajemen Barang</h1>
        <div>
            <?php if($role === 'admin'): ?>
            <a href="<?php echo base_url('kasir/barang/print'); ?>" class="btn btn-info btn-sm mr-2" target="_blank">
                <i class="fas fa-print fa-sm text-white-50"></i> Cetak Laporan Stok
            </a>
            <?php endif; ?>
            
            <?php if($role === 'kasir'): ?>
            <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addModal">
                <i class="fas fa-plus fa-sm text-white-50"></i> Tambah Barang
            </button>
            <?php endif; ?>
        </div>
    </div>

    <?php if($this->session->flashdata('success')): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?php echo $this->session->flashdata('success'); ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php endif; ?>

    <style>
        .card-dark {
            background: #1a1c23;
            border: 1px solid rgba(255, 255, 255, 0.05);
            border-radius: 15px;
        }
        .table-container {
            max-height: 600px;
            overflow-y: auto;
            border-radius: 10px;
            background: #1a1c23;
        }
        .table-dark-custom {
            color: #e2e8f0;
            margin-bottom: 0;
        }
        .table-dark-custom thead th {
            position: sticky;
            top: 0;
            background: #24262d !important;
            color: #4ade80 !important; /* Emerald Accent */
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.75rem;
            letter-spacing: 0.05em;
            border: none !important;
            z-index: 10;
            padding: 15px;
        }
        .table-dark-custom tbody td {
            border-top: 1px solid rgba(255, 255, 255, 0.05) !important;
            vertical-align: middle;
            padding: 12px 15px;
            background: #1a1c23;
        }
        .table-dark-custom tbody tr:hover td {
            background: rgba(255, 255, 255, 0.02) !important;
        }
        /* Custom Scrollbar */
        .table-container::-webkit-scrollbar {
            width: 6px;
        }
        .table-container::-webkit-scrollbar-track {
            background: rgba(0, 0, 0, 0.2);
        }
        .table-container::-webkit-scrollbar-thumb {
            background: rgba(74, 222, 128, 0.2);
            border-radius: 10px;
        }
        .table-container::-webkit-scrollbar-thumb:hover {
            background: rgba(74, 222, 128, 0.5);
        }
    </style>

    <div class="card shadow mb-4 card-dark">
        <div class="card-body p-0">
            <div class="table-container table-responsive">
                <table class="table table-dark-custom" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th class="pl-4">No</th>
                            <th>Gambar</th>
                            <th>Nama Barang</th>
                            <th>Kategori</th>
                            <th>Harga</th>
                            <th>Stok</th>
                            <th>Deskripsi</th>
                            <th class="pr-4">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no=1; foreach($barang as $b): ?>
                        <tr>
                            <td class="pl-4 text-muted small"><?php echo $no++; ?></td>
                            <td>
                                <img src="<?php echo base_url('assets/img/'.$b['image']); ?>" width="50" height="50" class="rounded shadow-sm" style="object-fit: contain; background: #24262d; border: 1px solid rgba(255,255,255,0.05);">
                            </td>
                            <td class="font-weight-bold text-white"><?php echo $b['name']; ?></td>
                            <td class="text-muted small"><?php echo $b['category']; ?></td>
                            <td class="text-white">Rp <?php echo number_format($b['price'], 0, ',', '.'); ?></td>
                            <td>
                                <span class="badge badge-outline-accent" style="font-size: 0.75rem; color: #4ade80; border: 1px solid rgba(74, 222, 128, 0.3); padding: 4px 10px;"><?php echo $b['stock']; ?> items</span>
                            </td>
                            <td class="text-muted small" style="max-width: 200px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;" title="<?php echo $b['description']; ?>">
                                <?php echo !empty($b['description']) ? $b['description'] : '-'; ?>
                            </td>
                            <td class="pr-4">
                                <button class="btn btn-outline-info btn-sm btn-circle" data-toggle="modal" data-target="#detailModal<?php echo $b['id']; ?>" title="Detail">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <?php if($role === 'kasir'): ?>
                                <button class="btn btn-outline-warning btn-sm btn-circle ml-1" data-toggle="modal" data-target="#editModal<?php echo $b['id']; ?>" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <a href="<?php echo base_url($role.'/barang/delete/'.$b['id']); ?>" class="btn btn-outline-danger btn-sm btn-circle ml-1" onclick="return confirm('Hapus barang ini?')" title="Hapus">
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

<!-- Modal Detail & Edit -->
<?php foreach($barang as $b): ?>
<!-- Detail Modal -->
<div class="modal fade" id="detailModal<?php echo $b['id']; ?>" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content card-dark border-0">
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title text-white">Detail Barang</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="text-center mb-4 p-3" style="background: rgba(255,255,255,0.02); border-radius: 15px;">
                    <img src="<?php echo base_url('assets/img/'.$b['image']); ?>" class="img-fluid rounded" style="max-height: 250px; object-fit: contain;">
                </div>
                <table class="table table-borderless text-white-50">
                    <tr>
                        <th width="35%" class="text-accent">Nama Barang</th>
                        <td class="text-white">: <?php echo $b['name']; ?></td>
                    </tr>
                    <tr>
                        <th class="text-accent">Kategori</th>
                        <td class="text-white">: <?php echo $b['category']; ?></td>
                    </tr>
                    <tr>
                        <th class="text-accent">Harga</th>
                        <td class="text-white">: Rp <?php echo number_format($b['price'], 0, ',', '.'); ?></td>
                    </tr>
                    <tr>
                        <th class="text-accent">Stok</th>
                        <td class="text-white">: <?php echo $b['stock']; ?> items</td>
                    </tr>
                    <tr>
                        <th class="text-accent">Deskripsi</th>
                        <td class="text-white-50">: <small><?php echo !empty($b['description']) ? $b['description'] : '-'; ?></small></td>
                    </tr>
                </table>
            </div>
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-secondary btn-sm px-4" data-dismiss="modal" style="border-radius: 8px;">Tutup</button>
            </div>
        </div>
    </div>
</div>

<!-- Edit Modal -->
<div class="modal fade" id="editModal<?php echo $b['id']; ?>" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content card-dark border-0">
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title text-white">Edit Barang</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?php echo base_url($role.'/barang/edit'); ?>" method="POST" enctype="multipart/form-data">
                <div class="modal-body text-white-50">
                    <input type="hidden" name="id" value="<?php echo $b['id']; ?>">
                    <div class="form-group">
                        <label class="small text-accent">Nama Barang</label>
                        <input type="text" name="name" class="form-control bg-dark border-0 text-white" value="<?php echo $b['name']; ?>" required style="border-radius: 8px;">
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label class="small text-accent">Kategori</label>
                            <input type="text" name="category" class="form-control bg-dark border-0 text-white" value="<?php echo $b['category']; ?>" required style="border-radius: 8px;">
                        </div>
                        <div class="form-group col-md-6">
                            <label class="small text-accent">Harga</label>
                            <input type="number" name="price" class="form-control bg-dark border-0 text-white" value="<?php echo $b['price']; ?>" required style="border-radius: 8px;">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="small text-accent">Stok</label>
                        <input type="number" name="stock" class="form-control bg-dark border-0 text-white" value="<?php echo $b['stock']; ?>" required style="border-radius: 8px;">
                    </div>
                    <div class="form-group">
                         <label class="small text-accent">Deskripsi</label>
                         <textarea name="description" class="form-control bg-dark border-0 text-white" rows="3" style="border-radius: 8px;"><?php echo $b['description']; ?></textarea>
                     </div>
                     <div class="form-group">
                         <label class="small text-accent">Foto Barang (Biarkan kosong jika tidak diganti)</label>
                         <input type="file" name="image" class="form-control-file text-muted small">
                     </div>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-link text-muted" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-warning px-4" style="border-radius: 8px; color: #000; font-weight: 600;">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php endforeach; ?>

<!-- Add Modal -->
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content card-dark border-0">
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title text-white">Tambah Barang Baru</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?php echo base_url($role.'/barang/add'); ?>" method="POST" enctype="multipart/form-data">
                <div class="modal-body text-white-50">
                    <div class="form-group">
                        <label class="small text-accent">Nama Barang</label>
                        <input type="text" name="name" class="form-control bg-dark border-0 text-white" required style="border-radius: 8px;">
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label class="small text-accent">Kategori</label>
                            <input type="text" name="category" class="form-control bg-dark border-0 text-white" required style="border-radius: 8px;">
                        </div>
                        <div class="form-group col-md-6">
                            <label class="small text-accent">Harga</label>
                            <input type="number" name="price" class="form-control bg-dark border-0 text-white" required style="border-radius: 8px;">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="small text-accent">Stok</label>
                        <input type="number" name="stock" class="form-control bg-dark border-0 text-white" required style="border-radius: 8px;">
                    </div>
                    <div class="form-group">
                         <label class="small text-accent">Deskripsi</label>
                         <textarea name="description" class="form-control bg-dark border-0 text-white" rows="3" style="border-radius: 8px;"></textarea>
                     </div>
                     <div class="form-group">
                         <label class="small text-accent">Foto Barang</label>
                         <input type="file" name="image" class="form-control-file text-muted small">
                     </div>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-link text-muted" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary px-4" style="border-radius: 8px; font-weight: 600;">Tambah Barang</button>
                </div>
            </form>
        </div>
    </div>
</div>

</div>
<!-- End of Main Content -->
