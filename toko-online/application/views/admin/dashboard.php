<!-- Begin Page Content -->
<div class="container-fluid px-4" id="stats">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-end justify-content-between mb-4">
        <div>
            <h1 class="h3 mb-1 text-white font-weight-bold">Dashboard</h1>
            <p class="mb-0 text-muted" style="font-size: 0.9rem;">Selamat datang kembali! Berikut ringkasan toko Anda hari ini.</p>
        </div>
        
    </div>

    <!-- Content Row -->
    <div class="row reveal reveal-slow">

        <!-- Total Barang -->
        <div class="col-xl-3 col-md-6 mb-4 reveal">
            <div class="card summary-card h-100">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="summary-title">Total Barang</div>
                        <div class="summary-value counter-number" data-target="<?php echo $total_products; ?>">0</div>
                        <div class="summary-trend">
                            <i class="fas fa-arrow-up"></i> Active <span class="text-muted ml-1">items</span>
                        </div>
                    </div>
                    <div class="col-auto">
                        <div class="summary-icon-wrapper">
                            <i class="fas fa-cube"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Layanan -->
        <div class="col-xl-3 col-md-6 mb-4 reveal" style="transition-delay: 0.1s;">
            <div class="card summary-card h-100">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="summary-title">Total Layanan</div>
                        <div class="summary-value counter-number" data-target="<?php echo $total_services; ?>">0</div>
                        <div class="summary-trend">
                            <i class="fas fa-arrow-up"></i> Active <span class="text-muted ml-1">services</span>
                        </div>
                    </div>
                    <div class="col-auto">
                        <div class="summary-icon-wrapper">
                            <i class="fas fa-briefcase"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Transaksi -->
        <div class="col-xl-3 col-md-6 mb-4 reveal" style="transition-delay: 0.2s;">
            <div class="card summary-card h-100">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="summary-title">Total Transaksi</div>
                        <div class="summary-value counter-number" data-target="<?php echo $total_orders; ?>">0</div>
                        <div class="summary-trend">
                            <i class="fas fa-arrow-up"></i> Completed <span class="text-muted ml-1">sales</span>
                        </div>
                    </div>
                    <div class="col-auto">
                        <div class="summary-icon-wrapper">
                            <i class="fas fa-shopping-cart"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Customer -->
        <div class="col-xl-3 col-md-6 mb-4 reveal" style="transition-delay: 0.3s;">
            <div class="card summary-card h-100">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="summary-title text-warning">Total Customer</div>
                        <div class="summary-value counter-number" style="font-size: 1.5rem;" data-target="<?php echo $total_users; ?>">0</div>
                        <div class="summary-trend">
                            <i class="fas fa-user"></i> Registered <span class="text-muted ml-1">users</span>
                        </div>
                    </div>
                    <div class="col-auto">
                        <div class="summary-icon-wrapper">
                            <i class="fas fa-user"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Content Row Charts -->
    <div class="row reveal reveal-slow" style="transition-delay: 0.4s;">

        <!-- Area Chart -->
        <div class="col-xl-8 col-lg-7 mb-4">
            <div class="card h-100">
                <!-- Card Header -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between border-0 pb-0">
                    <h6 class="m-0 card-title-custom">Grafik penjualan</h6>
                    
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="chart-area" style="height: 18rem;">
                        <canvas id="dashboardAreaChart"></canvas>
                    </div>
                    <!-- Additional Stat Below Chart -->
                    <div class="row mt-4 pt-3" style="border-top: 1px solid var(--border-color);">
                        <div class="col-md-6 d-flex align-items-center">
                            <div class="mr-3 p-3 rounded" style="background-color: var(--accent-bg); color: var(--accent-green);">
                                <i class="fas fa-chart-line fa-lg"></i>
                            </div>
                            <div>
                                <div class="text-muted small">Total Pendapatan</div>
                                <div class="h5 mb-0 text-white font-weight-bold">Rp <?php echo number_format(array_sum($monthly_sales), 0, ',', '.'); ?> <span class="badge badge-success ml-2" style="background-color: var(--accent-dark); color: var(--accent-green);"><i class="fas fa-arrow-up"></i> Live</span></div>
                                <div class="text-muted" style="font-size: 0.75rem;">Total pendapatan tahun <?php echo date('Y'); ?></div>
                            </div>
                        </div>
                        <div class="col-md-6 d-flex align-items-center">
                            <div class="mr-3 p-3 rounded" style="background-color: var(--accent-bg); color: var(--accent-green);">
                                <i class="fas fa-trophy fa-lg"></i>
                            </div>
                            <div>
                                <div class="text-muted small">Status Login</div>
                                <div class="h5 mb-0 text-white font-weight-bold" style="text-transform: capitalize;"><?php echo $role; ?></div>
                                <div class="text-muted" style="font-size: 0.75rem;">Aktif sebagai <?php echo $role; ?></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Order Summary Stats Card -->
        <div class="col-xl-4 col-lg-5 mb-4">
            <div class="card h-100 d-flex flex-column justify-content-between">
                 <?php
                // Fetch stats matching admin/pesanan.php list (all time with matching user)
                $total_pesanan = $this->db->from('orders')
                                          ->join('users', 'users.id = orders.user_id')
                                          ->count_all_results();

                $menunggu_pembayaran = $this->db->from('orders')
                                                ->join('users', 'users.id = orders.user_id')
                                                ->where('orders.status', 'pending')
                                                ->count_all_results();

                $diproses = $this->db->from('orders')
                                     ->join('users', 'users.id = orders.user_id')
                                     ->where_in('orders.status', ['confirmed', 'processed'])
                                     ->count_all_results();

                $dalam_perjalanan = $this->db->from('orders')
                                             ->join('users', 'users.id = orders.user_id')
                                             ->where_in('orders.status', ['shipping', 'shipped'])
                                             ->count_all_results();

                $pesanan_selesai = $this->db->from('orders')
                                            ->join('users', 'users.id = orders.user_id')
                                            ->where('orders.status', 'completed')
                                            ->count_all_results();

                $dibatalkan = $this->db->from('orders')
                                       ->join('users', 'users.id = orders.user_id')
                                       ->where_in('orders.status', ['cancelled', 'failed', 'batal'])
                                       ->count_all_results();
                ?>
                <!-- Card Header -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between border-0 pb-2 bg-transparent">
                    <h6 class="m-0 card-title-custom font-weight-bold d-flex align-items-center" style="font-size: 0.9rem; text-transform: uppercase; letter-spacing: 0.05em; color: var(--accent-green);">
                        <i class="fas fa-clipboard-list mr-2" style="font-size: 1.1rem;"></i> Ringkasan Pesanan
                    </h6>
                    <div>
                        <span class="badge" style="background-color: transparent; color: var(--accent-green); border: 1px solid rgba(74, 222, 128, 0.3); padding: 6px 14px; border-radius: 20px; font-size: 0.75rem; font-weight: 600;">Semua Waktu</span>
                    </div>
                </div>
                <!-- Card Body -->
                <div class="card-body d-flex flex-column justify-content-center py-3">
                    <div class="row">
                        <!-- Pesanan Masuk -->
                        <div class="col-6 mb-3">
                            <div class="p-3 border shadow-sm" style="background-color: rgba(96, 165, 250, 0.04); border: 1px solid rgba(96, 165, 250, 0.15); border-left: 4px solid #60a5fa !important; border-radius: 12px; transition: all 0.2s;">
                                <div class="small font-weight-bold mb-1" style="color: rgba(96, 165, 250, 0.75); font-size: 0.75rem; line-height: 1.2;">Pesanan Masuk</div>
                                <div class="h3 font-weight-bold mb-0 text-white"><?php echo $total_pesanan; ?></div>
                            </div>
                        </div>
                        <!-- Menunggu Pembayaran -->
                        <div class="col-6 mb-3">
                            <div class="p-3 border shadow-sm" style="background-color: rgba(251, 191, 36, 0.04); border: 1px solid rgba(251, 191, 36, 0.15); border-left: 4px solid #fbbf24 !important; border-radius: 12px; transition: all 0.2s;">
                                <div class="small font-weight-bold mb-1" style="color: rgba(251, 191, 36, 0.75); font-size: 0.75rem; line-height: 1.2;">Menunggu Pembayaran</div>
                                <div class="h3 font-weight-bold mb-0 text-white"><?php echo $menunggu_pembayaran; ?></div>
                            </div>
                        </div>
                        <!-- Sedang Diproses -->
                        <div class="col-6 mb-3">
                            <div class="p-3 border shadow-sm" style="background-color: rgba(6, 182, 212, 0.04); border: 1px solid rgba(6, 182, 212, 0.15); border-left: 4px solid #06b6d4 !important; border-radius: 12px; transition: all 0.2s;">
                                <div class="small font-weight-bold mb-1" style="color: rgba(6, 182, 212, 0.75); font-size: 0.75rem; line-height: 1.2;">Sedang Diproses</div>
                                <div class="h3 font-weight-bold mb-0 text-white"><?php echo $diproses; ?></div>
                            </div>
                        </div>
                        <!-- Dalam Perjalanan -->
                        <div class="col-6 mb-3">
                            <div class="p-3 border shadow-sm" style="background-color: rgba(168, 85, 247, 0.04); border: 1px solid rgba(168, 85, 247, 0.15); border-left: 4px solid #a855f7 !important; border-radius: 12px; transition: all 0.2s;">
                                <div class="small font-weight-bold mb-1" style="color: rgba(168, 85, 247, 0.75); font-size: 0.75rem; line-height: 1.2;">Dalam Perjalanan</div>
                                <div class="h3 font-weight-bold mb-0 text-white"><?php echo $dalam_perjalanan; ?></div>
                            </div>
                        </div>
                        <!-- Pesanan Selesai -->
                        <div class="col-6 mb-3 mb-md-0">
                            <div class="p-3 border shadow-sm" style="background-color: rgba(74, 222, 128, 0.04); border: 1px solid rgba(74, 222, 128, 0.15); border-left: 4px solid #4ade80 !important; border-radius: 12px; transition: all 0.2s;">
                                <div class="small font-weight-bold mb-1" style="color: rgba(74, 222, 128, 0.75); font-size: 0.75rem; line-height: 1.2;">Pesanan Selesai</div>
                                <div class="h3 font-weight-bold mb-0 text-white"><?php echo $pesanan_selesai; ?></div>
                            </div>
                        </div>
                        <!-- Dibatalkan -->
                        <div class="col-6">
                            <div class="p-3 border shadow-sm" style="background-color: rgba(248, 113, 113, 0.04); border: 1px solid rgba(248, 113, 113, 0.15); border-left: 4px solid #f87171 !important; border-radius: 12px; transition: all 0.2s;">
                                <div class="small font-weight-bold mb-1" style="color: rgba(248, 113, 113, 0.75); font-size: 0.75rem; line-height: 1.2;">Dibatalkan</div>
                                <div class="h3 font-weight-bold mb-0 text-white"><?php echo $dibatalkan; ?></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Content Row Tables & Lists -->
    <div class="row reveal reveal-slow" style="transition-delay: 0.6s;">
        <!-- Pesanan Terbaru -->
        <div class="col-xl-8 col-lg-7 mb-4">
            <div class="card h-100">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between border-0">
                    <h6 class="m-0 card-title-custom">Pesanan Terbaru</h6>
                    <a href="<?php echo base_url('kasir/pesanan'); ?>" class="view-all-link">Lihat Semua <i class="fas fa-arrow-right ml-1" style="font-size: 0.75rem;"></i></a>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-borderless mb-0">
                            <thead>
                                <tr>
                                    <th class="px-4">Order ID</th>
                                    <th>Pelanggan</th>
                                    <th>Tanggal</th>
                                    <th>Total</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($recent_orders as $o): ?>
                                <tr>
                                    <td class="px-4 text-muted">#ORD-<?php echo str_pad($o['id'], 5, '0', STR_PAD_LEFT); ?></td>
                                    <td><?php echo $o['fullname']; ?></td>
                                    <td class="text-muted"><?php echo date('d M Y', strtotime($o['order_date'])); ?></td>
                                    <td>Rp <?php echo number_format($o['total_amount'], 0, ',', '.'); ?></td>
                                    <td>
                                        <span class="badge-status <?php 
                                            if($o['status'] == 'pending') echo 'badge-status-diproses';
                                            elseif($o['status'] == 'completed') echo 'badge-status-selesai';
                                            else echo 'badge-status-batal';
                                        ?>"><?php echo strtoupper($o['status']); ?></span>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Produk Terlaris -->
        <div class="col-xl-4 col-lg-5 mb-4">
            <div class="card h-100">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between border-0">
                    <h6 class="m-0 card-title-custom">Produk Terlaris</h6>
                </div>
                <div class="list-group list-group-flush rounded-bottom">
                    <?php foreach($top_products as $tp): ?>
                    <div class="list-group-item-dark">
                        <div class="product-img" style="background-image: url('<?php echo base_url('assets/img/'.$tp['image']); ?>'); background-size: cover;"></div>
                        <div class="product-info flex-grow-1">
                            <h6><?php echo $tp['name']; ?></h6>
                            <p>Terjual <?php echo $tp['total_sold']; ?></p>
                        </div>
                        <div class="product-price">Rp <?php echo number_format($tp['price'], 0, ',', '.'); ?></div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Additional Detail Row -->
    <div class="row reveal reveal-slow" style="transition-delay: 0.8s;">
        <!-- Barang Masuk & Keluar -->
        <div class="col-xl-8 col-lg-7 mb-4">
            <div class="card h-100">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between border-0">
                    <h6 class="m-0 card-title-custom">Detail Barang Masuk & Keluar</h6>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive" style="max-height: 480px; overflow-y: auto; scrollbar-width: thin; scrollbar-color: rgba(74, 222, 128, 0.2) transparent;">
                        <style>
                            .table-responsive::-webkit-scrollbar { width: 4px; }
                            .table-responsive::-webkit-scrollbar-track { background: transparent; }
                            .table-responsive::-webkit-scrollbar-thumb { background: rgba(74, 222, 128, 0.2); border-radius: 10px; }
                            .table-responsive::-webkit-scrollbar-thumb:hover { background: rgba(74, 222, 128, 0.5); }
                            
                            .sticky-header-th {
                                position: sticky;
                                top: 0;
                                background-color: var(--bg-card) !important;
                                z-index: 5;
                                box-shadow: 0 2px 2px -1px rgba(0,0,0,0.4);
                            }
                        </style>
                        <table class="table table-borderless mb-0">
                            <thead>
                                <tr>
                                    <th class="px-4 sticky-header-th">Barang</th>
                                    <th class="sticky-header-th">Qty</th>
                                    <th class="sticky-header-th">Status</th>
                                    <th class="sticky-header-th">Keterangan</th>
                                    <th class="sticky-header-th">Waktu</th>
                                    <th class="sticky-header-th text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(empty($stock_logs)): ?>
                                <tr>
                                    <td colspan="6" class="text-center py-4 text-muted">Belum ada aktivitas stok</td>
                                </tr>
                                <?php endif; ?>
                                <?php foreach($stock_logs as $log): ?>
                                <tr>
                                    <td class="px-4 text-white" style="font-size: 0.85rem;"><?php echo $log['product_name']; ?></td>
                                    <td class="text-white font-weight-bold"><?php echo $log['quantity']; ?></td>
                                    <td>
                                        <?php if($log['type'] === 'masuk'): ?>
                                        <span class="badge" style="background-color: rgba(74, 222, 128, 0.1); color: #4ade80; font-size: 0.7rem;">
                                            <i class="fas fa-arrow-down mr-1"></i> Masuk
                                        </span>
                                        <?php else: ?>
                                        <span class="badge" style="background-color: rgba(248, 113, 113, 0.1); color: #f87171; font-size: 0.7rem;">
                                            <i class="fas fa-arrow-up mr-1"></i> Keluar
                                        </span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="text-muted small" style="max-width: 150px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;"><?php echo $log['description']; ?></td>
                                    <td class="text-muted small"><?php echo date('d M, H:i', strtotime($log['created_at'])); ?></td>
                                    <td class="text-center">
                                        <button class="btn btn-outline-info btn-sm view-stock-detail" 
                                                data-product="<?php echo htmlspecialchars($log['product_name']); ?>" 
                                                data-qty="<?php echo $log['quantity']; ?>" 
                                                data-type="<?php echo $log['type']; ?>" 
                                                data-desc="<?php echo htmlspecialchars($log['description']); ?>" 
                                                data-time="<?php echo date('d F Y, H:i', strtotime($log['created_at'])); ?>"
                                                data-toggle="modal" 
                                                data-target="#stockDetailModal" 
                                                title="Detail Aktivitas">
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

        <!-- Aktivitas Terbaru -->
        <div class="col-xl-4 col-lg-5 mb-4">
            <div class="card h-100">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between border-0">
                    <h6 class="m-0 card-title-custom">Aktivitas Terbaru</h6>
                </div>
                <div class="list-group list-group-flush rounded-bottom" style="max-height: 480px; overflow-y: auto; scrollbar-width: thin; scrollbar-color: rgba(212, 175, 55, 0.3) transparent;">
                    <style>
                        .list-group::-webkit-scrollbar { width: 4px; }
                        .list-group::-webkit-scrollbar-track { background: transparent; }
                        .list-group::-webkit-scrollbar-thumb { background: rgba(212, 175, 55, 0.2); border-radius: 10px; }
                        .list-group::-webkit-scrollbar-thumb:hover { background: rgba(212, 175, 55, 0.5); }
                    </style>
                    <?php if(empty($recent_activities)): ?>
                    <div class="list-group-item-dark p-4 text-center text-muted small">Belum ada aktivitas tercatat</div>
                    <?php endif; ?>
                    <?php foreach($recent_activities as $ra): ?>
                    <div class="list-group-item-dark d-flex align-items-center py-3">
                        <div class="mr-3">
                            <?php 
                                $icon = 'fa-info-circle';
                                $color = 'text-info';
                                if(stripos($ra['activity'], 'menambahkan') !== false || stripos($ra['activity'], 'baru') !== false) { $icon = 'fa-plus-circle'; $color = 'text-success'; }
                                elseif(stripos($ra['activity'], 'mengubah') !== false || stripos($ra['activity'], 'update') !== false) { $icon = 'fa-edit'; $color = 'text-warning'; }
                                elseif(stripos($ra['activity'], 'menghapus') !== false) { $icon = 'fa-trash-alt'; $color = 'text-danger'; }
                            ?>
                            <i class="fas <?php echo $icon . ' ' . $color; ?>" style="font-size: 1.1rem;"></i>
                        </div>
                        <div class="d-flex justify-content-between align-items-center flex-grow-1">
                            <div>
                                <h6 class="mb-0 text-white" style="font-size: 0.85rem;"><?php echo $ra['activity']; ?></h6>
                                <small class="text-muted"><?php echo $ra['user_fullname']; ?></small>
                            </div>
                            <span class="text-muted text-right ml-2" style="font-size: 0.7rem;"><?php echo date('H:i', strtotime($ra['created_at'])); ?></span>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<!-- Footer -->
<footer class="sticky-footer" style="background-color: var(--bg-main);">
    <div class="container my-auto">
        <div class="copyright text-center my-auto text-muted">
            <span>Copyright &copy; 2026. All rights reserved.</span>
        </div>
    </div>
</footer>
<!-- End of Footer -->

</div>
<!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top" style="background-color: var(--bg-card); color: var(--text-primary); border: 1px solid var(--border-color);">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Stock Log Detail Modal -->
<div class="modal fade" id="stockDetailModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content card-dark border-0">
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title text-white">Detail Aktivitas Stok</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-white">
                <div class="space-y-3">
                    <div class="form-group mb-3">
                        <label class="text-muted small mb-1 d-block">Nama Produk</label>
                        <p id="modal-stock-product" class="font-weight-bold text-white mb-0" style="font-size: 1.1rem;"></p>
                    </div>
                    <div class="row mb-3">
                        <div class="col-6">
                            <div class="form-group mb-0">
                                <label class="text-muted small mb-1 d-block">Jumlah Perubahan</label>
                                <p id="modal-stock-qty" class="font-weight-bold text-white mb-0" style="font-size: 1.1rem;"></p>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group mb-0">
                                <label class="text-muted small mb-1 d-block">Status</label>
                                <div id="modal-stock-badge-container"></div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <label class="text-muted small mb-1 d-block">Keterangan Aktivitas</label>
                        <div class="p-3 rounded-lg bg-dark border border-sec-dark text-txt-sec small" id="modal-stock-desc" style="white-space: pre-wrap; line-height: 1.5; border-radius: 8px; border-color: rgba(255,255,255,0.05); background-color: #24262d !important;"></div>
                    </div>
                    <div class="form-group mb-0">
                        <label class="text-muted small mb-1 d-block">Waktu Pencatatan</label>
                        <p id="modal-stock-time" class="text-txt-sec small mb-0"></p>
                    </div>
                </div>
            </div>
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-secondary px-4" data-dismiss="modal" style="border-radius: 8px;">Tutup</button>
            </div>
        </div>
    </div>
</div>

<script src="<?php echo base_url('assets/js/script.js'); ?>"></script>

<script>
    const MONTHLY_SALES = <?php echo json_encode($monthly_sales); ?>;
    const POPULAR_CATEGORY_NAMES = <?php echo json_encode(array_column($popular_categories, 'name')); ?>;
    const POPULAR_CATEGORY_TOTALS = <?php echo json_encode(array_column($popular_categories, 'total')); ?>;

    document.addEventListener('DOMContentLoaded', function() {
        const detailButtons = document.querySelectorAll('.view-stock-detail');
        detailButtons.forEach(btn => {
            btn.addEventListener('click', function() {
                const product = this.getAttribute('data-product');
                const qty = this.getAttribute('data-qty');
                const type = this.getAttribute('data-type');
                const desc = this.getAttribute('data-desc');
                const time = this.getAttribute('data-time');

                document.getElementById('modal-stock-product').innerText = product;
                document.getElementById('modal-stock-qty').innerText = qty + ' unit';
                document.getElementById('modal-stock-desc').innerText = desc;
                document.getElementById('modal-stock-time').innerText = time;

                const badgeContainer = document.getElementById('modal-stock-badge-container');
                if (type === 'masuk') {
                    badgeContainer.innerHTML = `<span class="badge" style="background-color: rgba(74, 222, 128, 0.1); color: #4ade80; font-size: 0.85rem; padding: 5px 10px; border-radius: 6px;">
                        <i class="fas fa-arrow-down mr-1"></i> Masuk
                    </span>`;
                } else {
                    badgeContainer.innerHTML = `<span class="badge" style="background-color: rgba(248, 113, 113, 0.1); color: #f87171; font-size: 0.85rem; padding: 5px 10px; border-radius: 6px;">
                        <i class="fas fa-arrow-up mr-1"></i> Keluar
                    </span>`;
                }
            });
        });
    });
</script>
<script src="<?php echo base_url('assets/js/dashboard.js'); ?>"></script>
