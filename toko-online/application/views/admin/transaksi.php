<div class="container-fluid">

    <link rel="stylesheet" href="<?php echo base_url('assets/css/admin-table.css'); ?>">

    <div class="card shadow mb-4 card-dark">
        <div class="card-body p-0">
            <div class="table-container table-responsive">
                <table class="table table-dark-custom" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Order ID</th>
                            <th>Customer</th>
                            <th>Total Amount</th>
                            <th>Status</th>
                            <th>Tanggal</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(empty($orders)): ?>
                        <tr>
                            <td colspan="7" class="text-center py-4 text-muted">Belum ada transaksi</td>
                        </tr>
                        <?php endif; ?>
                        <?php $no=1; foreach($orders as $o): ?>
                        <tr>
                            <td class="text-muted"><?php echo $no++; ?></td>
                            <td class="font-weight-bold text-info">#ORD-<?php echo str_pad($o['id'], 5, '0', STR_PAD_LEFT); ?></td>
                            <td class="text-white"><?php echo $o['fullname']; ?></td>
                            <td class="text-white font-weight-bold">Rp <?php echo number_format($o['total_amount'], 0, ',', '.'); ?></td>
                            <td>
                                <span class="badge <?php 
                                    if($o['status'] == 'pending') echo 'badge-warning';
                                    elseif($o['status'] == 'confirmed' || $o['status'] == 'processed') echo 'badge-info';
                                    elseif($o['status'] == 'shipped' || $o['status'] == 'shipping') echo 'badge-primary';
                                    elseif($o['status'] == 'completed') echo 'badge-success';
                                    else echo 'badge-danger';
                                ?>" style="font-size: 0.65rem; padding: 4px 8px;"><?php echo strtoupper($o['status']); ?></span>
                            </td>
                            <td class="text-muted small"><?php echo date('d/m/Y H:i', strtotime($o['order_date'])); ?></td>
                            <td class="text-center">
                                <button class="btn btn-outline-info btn-sm view-trans-detail" 
                                        data-id="<?php echo $o['id']; ?>"
                                        data-customer="<?php echo htmlspecialchars($o['fullname']); ?>"
                                        data-recipient="<?php echo htmlspecialchars($o['recipient_name'] ?? ''); ?>"
                                        data-phone="<?php echo htmlspecialchars($o['phone_number'] ?? ''); ?>"
                                        data-address="<?php echo htmlspecialchars($o['address'] ?? ''); ?>"
                                        data-method="<?php echo htmlspecialchars($o['payment_method'] ?? ''); ?>"
                                        data-detail="<?php echo htmlspecialchars($o['payment_detail'] ?? ''); ?>"
                                        data-status="<?php echo htmlspecialchars($o['status']); ?>"
                                        data-date="<?php echo date('d M Y, H:i', strtotime($o['order_date'])); ?>"
                                        data-total="<?php echo $o['total_amount']; ?>"
                                        data-items="<?php echo htmlspecialchars(json_encode($o['items'])); ?>"
                                        data-toggle="modal" 
                                        data-target="#transDetailModal" 
                                        title="Detail Transaksi">
                                    <i class="fas fa-eye mr-1"></i> Detail
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

</div>
<!-- End of Main Content -->

<!-- Transaction Detail Modal -->
<div class="modal fade" id="transDetailModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content card-dark border-0">
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title text-white">Detail Transaksi <span id="modal-order-id" class="text-info font-weight-bold"></span></h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-white">
                <div class="row">
                    <!-- Customer Details -->
                    <div class="col-md-6 mb-4">
                        <div class="bg-dark p-3 rounded-lg border border-sec-dark" style="border-radius: 12px; border-color: rgba(255,255,255,0.05); background-color: #24262d !important; height: 100%;">
                            <h6 class="text-gold-accent font-weight-bold mb-3"><i class="fas fa-user-circle mr-2"></i> Informasi Pelanggan</h6>
                            <div class="form-group mb-2">
                                <label class="text-muted small mb-0 d-block">Akun Pengguna</label>
                                <span id="modal-customer-name" class="font-weight-bold"></span>
                            </div>
                            <div class="form-group mb-2">
                                <label class="text-muted small mb-0 d-block">Nama Penerima</label>
                                <span id="modal-recipient-name" class="font-weight-bold"></span>
                            </div>
                            <div class="form-group mb-2">
                                <label class="text-muted small mb-0 d-block">Nomor Telepon</label>
                                <span id="modal-phone" class="font-weight-bold"></span>
                            </div>
                            <div class="form-group mb-0">
                                <label class="text-muted small mb-0 d-block">Alamat Pengiriman</label>
                                <p id="modal-address" class="text-txt-sec small mb-0 mt-1 leading-relaxed" style="white-space: pre-wrap;"></p>
                            </div>
                        </div>
                    </div>
                    <!-- Payment Details -->
                    <div class="col-md-6 mb-4">
                        <div class="bg-dark p-3 rounded-lg border border-sec-dark" style="border-radius: 12px; border-color: rgba(255,255,255,0.05); background-color: #24262d !important; height: 100%;">
                            <h6 class="text-gold-accent font-weight-bold mb-3"><i class="fas fa-credit-card mr-2"></i> Informasi Pembayaran</h6>
                            <div class="form-group mb-2">
                                <label class="text-muted small mb-0 d-block">Metode Pembayaran</label>
                                <span id="modal-payment-method" class="font-weight-bold uppercase"></span>
                            </div>
                            <div class="form-group mb-2">
                                <label class="text-muted small mb-0 d-block">Detail Akun/E-Wallet</label>
                                <span id="modal-payment-detail" class="font-weight-bold text-info"></span>
                            </div>
                            <div class="form-group mb-2">
                                <label class="text-muted small mb-0 d-block">Status Transaksi</label>
                                <div id="modal-status-container" class="mt-1"></div>
                            </div>
                            <div class="form-group mb-0">
                                <label class="text-muted small mb-0 d-block">Tanggal Pemesanan</label>
                                <span id="modal-date" class="text-txt-sec small"></span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Products Table -->
                <div class="bg-dark p-3 rounded-lg border border-sec-dark" style="border-radius: 12px; border-color: rgba(255,255,255,0.05); background-color: #24262d !important;">
                    <h6 class="text-gold-accent font-weight-bold mb-3"><i class="fas fa-box-open mr-2"></i> Daftar Produk Yang Dipesan</h6>
                    <div class="table-responsive">
                        <table class="table table-borderless table-sm mb-0 text-white">
                            <thead>
                                <tr class="border-bottom border-white/5">
                                    <th class="text-muted small">Produk</th>
                                    <th class="text-muted small text-center">Harga</th>
                                    <th class="text-muted small text-center">Qty</th>
                                    <th class="text-muted small text-right">Subtotal</th>
                                </tr>
                            </thead>
                            <tbody id="modal-items-tbody">
                                <!-- Dynamic items will be added here -->
                            </tbody>
                            <tfoot>
                                <tr class="border-top border-white/5">
                                    <td colspan="3" class="text-right font-weight-bold text-muted small pt-2">Total Pembayaran :</td>
                                    <td id="modal-total-amount" class="text-right font-weight-bold text-gold-accent pt-2" style="font-size: 1.1rem;"></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-secondary px-4" data-dismiss="modal" style="border-radius: 8px;">Tutup</button>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const detailButtons = document.querySelectorAll('.view-trans-detail');
    detailButtons.forEach(btn => {
        btn.addEventListener('click', function() {
            const id = this.getAttribute('data-id');
            const customer = this.getAttribute('data-customer');
            const recipient = this.getAttribute('data-recipient');
            const phone = this.getAttribute('data-phone');
            const address = this.getAttribute('data-address');
            const method = this.getAttribute('data-method');
            const detail = this.getAttribute('data-detail');
            const status = this.getAttribute('data-status');
            const date = this.getAttribute('data-date');
            const total = this.getAttribute('data-total');
            const items = JSON.parse(this.getAttribute('data-items'));

            document.getElementById('modal-order-id').innerText = '#ORD-' + String(id).padStart(5, '0');
            document.getElementById('modal-customer-name').innerText = customer;
            document.getElementById('modal-recipient-name').innerText = recipient || '-';
            document.getElementById('modal-phone').innerText = phone || '-';
            document.getElementById('modal-address').innerText = address || '-';
            
            let methodText = method;
            if (method === 'transfer') methodText = 'Transfer Bank';
            else if (method === 'ewallet') methodText = 'E-Wallet';
            else if (method === 'cod') methodText = 'COD';
            document.getElementById('modal-payment-method').innerText = methodText;
            document.getElementById('modal-payment-detail').innerText = detail || '-';
            document.getElementById('modal-date').innerText = date;
            
            // Format Total Amount
            const formattedTotal = 'Rp ' + Number(total).toLocaleString('id-ID');
            document.getElementById('modal-total-amount').innerText = formattedTotal;

            // Status Badge
            const statusContainer = document.getElementById('modal-status-container');
            let badgeClass = 'badge-danger';
            if (status === 'pending') badgeClass = 'badge-warning';
            else if (status === 'confirmed' || status === 'processed') badgeClass = 'badge-info';
            else if (status === 'shipped' || status === 'shipping') badgeClass = 'badge-primary';
            else if (status === 'completed') badgeClass = 'badge-success';
            
            statusContainer.innerHTML = `<span class="badge ${badgeClass}" style="font-size: 0.8rem; padding: 5px 10px; border-radius: 6px;">${status.toUpperCase()}</span>`;

            // Items Tbody
            const tbody = document.getElementById('modal-items-tbody');
            tbody.innerHTML = '';
            items.forEach(item => {
                const price = Number(item.price);
                const qty = Number(item.quantity);
                const subtotal = price * qty;
                
                const tr = document.createElement('tr');
                tr.innerHTML = `
                    <td class="align-middle text-white font-weight-bold py-2">${item.product_name}</td>
                    <td class="align-middle text-center py-2">Rp ${price.toLocaleString('id-ID')}</td>
                    <td class="align-middle text-center font-weight-bold py-2">${qty}</td>
                    <td class="align-middle text-right text-gold-accent font-weight-bold py-2">Rp ${subtotal.toLocaleString('id-ID')}</td>
                `;
                tbody.appendChild(tr);
            });
        });
    });
});
</script>
