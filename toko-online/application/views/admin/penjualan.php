<div class="container-fluid">
    <!-- Header Print Only -->
    <div class="d-none d-print-block text-center mb-4">
        <h2 class="font-weight-bold text-dark mb-1">LAPORAN DATA PENJUALAN</h2>
        <p class="text-dark small">VERIDIAN SHOP — Tanggal Cetak: <?php echo date('d/m/Y H:i'); ?></p>
    </div>

    <div class="d-sm-flex align-items-center justify-content-between mb-4 d-print-none">
        <h1 class="h3 mb-0 text-white font-weight-bold">Daftar Penjualan Terbaru</h1>
        <div class="d-flex gap-2">
            <button onclick="window.print()" class="btn btn-sm text-accent shadow-sm" style="background-color: var(--accent-bg); border: 1px solid var(--accent-green); border-radius: 8px; font-weight: 600; transition: all 0.2s;"><i class="fas fa-print fa-sm mr-1 text-accent"></i> Print List</button>
            <a href="<?php echo base_url($role . '/penjualan/export_excel'); ?>" class="btn btn-sm text-accent shadow-sm ml-2" style="background-color: var(--accent-bg); border: 1px solid var(--accent-green); border-radius: 8px; font-weight: 600; transition: all 0.2s;"><i class="fas fa-download fa-sm mr-1 text-accent"></i> Export Excel</a>
        </div>
    </div>

    <link rel="stylesheet" href="<?php echo base_url('assets/css/admin-penjualan.css'); ?>">

    <!-- DataTales Example -->
    <div class="card shadow mb-4 bg-dark-card border-0">
        <div class="card-header py-3 bg-dark-card border-bottom border-sec-dark d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-accent">Data Transaksi Harian</h6>
            <div class="d-flex gap-2">
                <input type="date" class="form-control form-control-sm" id="filterDate" style="background-color: #0f1412 !important; border: 1px solid var(--border-color) !important; color: var(--text-primary) !important; border-radius: 8px; font-weight: 500;">
            </div>
        </div>
        <div class="card-body p-0">
            <div class="table-container table-responsive">
                <table class="table table-dark-custom mb-0" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th class="pl-4">No</th>
                            <th>Produk</th>
                            <th>Invoice</th>
                            <th>Customer</th>
                            <th>Total</th>
                            <th>Metode</th>
                            <th>Status</th>
                            <th>Tanggal</th>
                            <th class="pr-4">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no=1; foreach($sales as $s): ?>
                        <tr>
                            <td class="pl-4 text-muted"><?php echo $no++; ?></td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <img src="<?php echo base_url('assets/img/'.$s['product_image']); ?>" class="rounded mr-3" style="width: 42px; height: 42px; object-fit: contain; background: #12352f; border: 1px solid rgba(255,255,255,0.05);">
                                    <div class="font-weight-bold text-white" style="font-size: 0.85rem;"><?php echo $s['product_name']; ?></div>
                                </div>
                            </td>
                            <td class="font-weight-bold text-accent">#INV-<?php echo str_pad($s['id'], 5, '0', STR_PAD_LEFT); ?></td>
                            <td class="text-muted small"><?php echo $s['customer_name']; ?></td>
                            <td class="text-white font-weight-bold">Rp <?php echo number_format($s['total_amount'], 0, ',', '.'); ?></td>
                            <td>
                                <span class="badge badge-outline-accent" style="font-size: 0.65rem;"><?php echo strtoupper($s['payment_method'] ?? 'N/A'); ?></span>
                                <small class="d-block text-muted" style="font-size: 0.6rem;"><?php echo $s['payment_detail'] ?? ''; ?></small>
                            </td>
                            <td>
                                <span class="badge <?php 
                                    if($s['status'] == 'pending') echo 'badge-warning';
                                    elseif($s['status'] == 'processed') echo 'badge-info';
                                    elseif($s['status'] == 'shipping') echo 'badge-primary';
                                    elseif($s['status'] == 'completed') echo 'badge-success';
                                    else echo 'badge-danger';
                                ?>" style="font-size: 0.65rem; padding: 4px 8px;"><?php echo strtoupper($s['status']); ?></span>
                            </td>
                            <td class="text-muted small"><?php echo date('d/m/Y H:i', strtotime($s['order_date'])); ?></td>
                            <td class="pr-4">
                                <button type="button" onclick="showDetailModal(<?php echo $s['id']; ?>)" class="btn btn-outline-info btn-sm btn-circle" title="Detail">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal Detail Transaksi -->
<div class="modal fade" id="detailModal" tabindex="-1" role="dialog" aria-labelledby="detailModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content bg-dark-card border border-sec-dark text-white" style="border-radius: 1.5rem; overflow: hidden; box-shadow: 0 10px 30px rgba(0,0,0,0.5);">
            <div class="modal-header border-bottom border-sec-dark bg-main-bg py-3">
                <h5 class="modal-title font-weight-bold text-accent" id="detailModalLabel">Detail Transaksi</h5>
                <button type="button" class="close text-white hover:text-accent transition-colors" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body p-4" id="detailModalBody" style="max-height: 70vh; overflow-y: auto;">
                <div class="text-center py-5">
                    <div class="spinner-border text-accent" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                </div>
            </div>
            <div class="modal-footer border-top border-sec-dark bg-main-bg py-2">
                <button type="button" class="btn btn-sm text-accent shadow-sm" id="btnPrintInvoice" style="background-color: var(--accent-bg); border: 1px solid var(--accent-green); border-radius: 8px; font-weight: 600; transition: all 0.2s;"><i class="fas fa-print fa-sm mr-1 text-accent"></i> Cetak Invoice</button>
                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal" style="border-radius: 8px; font-weight: 600;">Tutup</button>
            </div>
        </div>
    </div>
</div>

<script>
    const DETAIL_BASE_URL = '<?php echo base_url($role . "/penjualan/detail/"); ?>';
    const PRINT_BASE_URL = '<?php echo base_url($role . "/penjualan/print_invoice/"); ?>';
</script>
<script src="<?php echo base_url('assets/js/admin-penjualan.js'); ?>"></script>
