<div class="container-fluid">

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Manajemen Pesanan & Pembayaran</h1>
    </div>

    <?php if($this->session->flashdata('success')): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?php echo $this->session->flashdata('success'); ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php endif; ?>

    <link rel="stylesheet" href="<?php echo base_url('assets/css/admin-table.css'); ?>">

    <div class="card shadow mb-4 card-dark">
        <div class="card-body p-0">
            <div class="table-container table-responsive">
                <table class="table table-dark-custom" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Produk</th>
                            <th>Order ID</th>
                            <th>Customer</th>
                            <th>Pembayaran</th>
                            <th>Total</th>
                            <th>Status</th>
                            <th>Tanggal</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no=1; foreach($orders as $o): ?>
                        <tr>
                            <td class="text-muted"><?php echo $no++; ?></td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <img src="<?php echo base_url('assets/img/'.$o['product_image']); ?>" class="rounded mr-3" style="width: 45px; height: 45px; object-fit: contain; background: #24262d; border: 1px solid rgba(255,255,255,0.05);">
                                    <div class="font-weight-bold text-white" style="font-size: 0.85rem;"><?php echo $o['product_name']; ?></div>
                                </div>
                            </td>
                            <td class="font-weight-bold text-info">#ORD-<?php echo str_pad($o['id'], 5, '0', STR_PAD_LEFT); ?></td>
                            <td class="text-muted"><?php echo $o['fullname']; ?></td>
                            <td>
                                <div class="text-white font-weight-bold text-uppercase" style="font-size: 0.8rem;">
                                    <?php echo htmlspecialchars($o['payment_method'] === 'transfer' ? 'Transfer Bank' : ($o['payment_method'] === 'ewallet' ? 'E-Wallet' : 'COD')); ?>
                                </div>
                                <?php if (!empty($o['payment_detail'])): ?>
                                    <small class="text-muted d-block mt-1" style="font-size: 0.72rem;"><?php echo htmlspecialchars($o['payment_detail']); ?></small>
                                <?php endif; ?>
                            </td>
                            <td class="text-white font-weight-bold">Rp <?php echo number_format($o['total_amount'], 0, ',', '.'); ?></td>
                            <td>
                                <?php if ($o['status'] == 'cancelled'): ?>
                                    <span class="badge badge-danger" style="font-size: 0.65rem; padding: 4px 8px;">Dibatalkan Customer</span>
                                <?php else: ?>
                                    <span class="badge <?php 
                                        if($o['status'] == 'pending') echo 'badge-warning';
                                        elseif($o['status'] == 'confirmed' || $o['status'] == 'processed') echo 'badge-info';
                                        elseif($o['status'] == 'shipping') echo 'badge-primary';
                                        elseif($o['status'] == 'completed') echo 'badge-success';
                                        else echo 'badge-danger';
                                    ?>" style="font-size: 0.65rem; padding: 4px 8px;"><?php 
                                        if($o['status'] == 'pending') echo 'PENDING';
                                        elseif($o['status'] == 'confirmed' || $o['status'] == 'processed') echo 'DIPROSES';
                                        elseif($o['status'] == 'shipping') echo 'DIKIRIM';
                                        elseif($o['status'] == 'completed') echo 'SELESAI';
                                        else echo 'BATAL';
                                    ?></span>
                                <?php endif; ?>
                            </td>
                            <td class="text-muted small"><?php echo date('d/m/Y H:i', strtotime($o['order_date'])); ?></td>
                             <td>
                                <button class="btn btn-outline-info btn-sm view-detail" data-id="<?php echo $o['id']; ?>" data-toggle="modal" data-target="#detailModal" title="Detail Items">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <?php if($role === 'kasir' && $o['status'] !== 'cancelled'): ?>
                                <button class="btn btn-outline-warning btn-sm ml-1" data-toggle="modal" data-target="#statusModal<?php echo $o['id']; ?>" title="Update Status">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <!-- Status Modal -->
                        <div class="modal fade" id="statusModal<?php echo $o['id']; ?>" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content card-dark border-0">
                                    <div class="modal-header border-0 pb-0">
                                        <h5 class="modal-title text-white">Update Status #<?php echo str_pad($o['id'], 5, '0', STR_PAD_LEFT); ?></h5>
                                        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form action="<?php echo base_url('kasir/pesanan/update_status'); ?>" method="POST">
                                        <div class="modal-body">
                                            <input type="hidden" name="id" value="<?php echo $o['id']; ?>">
                                            <div class="form-group mb-4">
                                                <label class="text-muted small d-block">Status Saat Ini: </label>
                                                <span class="badge badge-secondary"><?php echo strtoupper($o['status']); ?></span>
                                            </div>
                                            <div class="form-group">
                                                <label class="text-white small">Pilih Status Baru</label>
                                                <select name="status" class="form-control bg-dark border-0 text-white" style="border-radius: 8px;">
                                                    <option value="pending" <?php echo $o['status'] == 'pending' ? 'selected' : ''; ?>>Menunggu Konfirmasi (Pending)</option>
                                                    <option value="processed" <?php echo $o['status'] == 'processed' ? 'selected' : ''; ?>>Sedang Diproses (Processed)</option>
                                                    <option value="shipping" <?php echo $o['status'] == 'shipping' ? 'selected' : ''; ?>>Dalam Perjalanan (Shipping)</option>
                                                    <option value="completed" <?php echo $o['status'] == 'completed' ? 'selected' : ''; ?>>Selesai (Completed)</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="modal-footer border-0">
                                            <button type="button" class="btn btn-link text-muted" data-dismiss="modal">Batal</button>
                                            <button type="submit" class="btn btn-success px-4" style="border-radius: 8px;">Simpan Perubahan</button>
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

<!-- Detail Modal -->
<div class="modal fade" id="detailModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content card-dark border-0">
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title text-white">Detail Item Pesanan</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table table-sm table-dark-custom">
                    <thead>
                        <tr class="bg-dark">
                            <th class="border-0">Barang</th>
                            <th class="border-0">Qty</th>
                            <th class="border-0">Harga</th>
                        </tr>
                    </thead>
                    <tbody id="detail-items" class="small">
                        <!-- Loaded via JS -->
                    </tbody>
                </table>
            </div>
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-secondary btn-sm px-4" data-dismiss="modal" style="border-radius: 8px;">Tutup</button>
            </div>
        </div>
    </div>
</div>

<script>
    const PESANAN_DETAIL_URL = '<?php echo base_url("kasir/pesanan/detail/"); ?>';
</script>
<script src="<?php echo base_url('assets/js/admin-pesanan.js'); ?>"></script>

</div>
<!-- End of Main Content -->
