<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-white font-weight-bold">Laporan & Analisis Penjualan</h1>
        <button onclick="window.print()" class="btn btn-sm btn-accent shadow-sm"><i class="fas fa-download fa-sm text-dark"></i> Unduh Laporan (PDF)</button>
    </div>

    <style>
        .chart-area {
            position: relative;
            height: 350px;
            width: 100%;
        }
    </style>

    <!-- Stats Cards -->
    <div class="row">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card bg-dark-card border-left-accent shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-accent text-uppercase mb-1">Total Pendapatan</div>
                            <div class="h5 mb-0 font-weight-bold text-white">Rp <?php echo number_format($total_revenue, 0, ',', '.'); ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x text-gray-700"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card bg-dark-card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Jumlah Transaksi</div>
                            <div class="h5 mb-0 font-weight-bold text-white"><?php echo $total_transactions; ?> Pesanan</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-shopping-basket fa-2x text-gray-700"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-6 col-md-12 mb-4">
            <div class="card bg-dark-card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Produk Paling Laris</div>
                            <div class="mt-2">
                                <?php foreach($top_products as $tp): ?>
                                    <span class="badge badge-outline-success mr-2"><?php echo $tp['name']; ?> (<?php echo $tp['total_sold']; ?>)</span>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-fire fa-2x text-gray-700"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts Row -->
    <div class="row">
        <div class="col-xl-8 col-lg-7">
            <div class="card shadow mb-4 bg-dark-card border-0">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between bg-dark-card border-bottom border-sec-dark">
                    <h6 class="m-0 font-weight-bold text-white opacity-75">Grafik penjualan</h6>
                </div>
                <div class="card-body">
                    <div class="chart-area">
                        <canvas id="salesChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-lg-5">
            <div class="card shadow mb-4 bg-dark-card border-0">
                <div class="card-header py-3 bg-dark-card border-bottom border-sec-dark">
                    <h6 class="m-0 font-weight-bold text-accent">Top 5 Produk</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-dark-custom">
                            <thead>
                                <tr>
                                    <th>Nama Produk</th>
                                    <th class="text-center">Terjual</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($top_products as $tp): ?>
                                <tr>
                                    <td><?php echo $tp['name']; ?></td>
                                    <td class="text-center font-weight-bold text-accent"><?php echo $tp['total_sold']; ?></td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    const CHART_DATA = <?php echo json_encode($chart_data ?? []); ?>;
</script>
<script src="<?php echo base_url('assets/js/admin-laporan.js'); ?>"></script>
