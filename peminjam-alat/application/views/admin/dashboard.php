<style>
    .stat-card { border-radius: 12px; border: none; box-shadow: 0 4px 12px rgba(0,0,0,0.03); transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); }
    .stat-card:hover { transform: translateY(-5px); box-shadow: 0 8px 24px rgba(0,0,0,0.08); }
    .stat-icon { width: 48px; height: 48px; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 20px; }
    .bg-icon-blue { background-color: rgba(37, 99, 235, 0.1); color: #2563EB; }
    .bg-icon-green { background-color: rgba(34, 197, 94, 0.1); color: #22C55E; }
    .bg-icon-purple { background-color: rgba(139, 92, 246, 0.1); color: #8B5CF6; }
    .bg-icon-orange { background-color: rgba(245, 158, 11, 0.1); color: #F59E0B; }
    .trend-up { color: #198754; font-size: 12px; font-weight: 600; }
    .list-card { border-radius: 12px; border: none; box-shadow: 0 4px 12px rgba(0,0,0,0.03); height: 100%; transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); }
    .list-card:hover { transform: translateY(-5px); box-shadow: 0 8px 24px rgba(0,0,0,0.08); }
    .list-wrapper-scroll { max-height: 280px; overflow-y: auto; padding-right: 8px; }
    .list-wrapper-scroll::-webkit-scrollbar { width: 5px; }
    .list-wrapper-scroll::-webkit-scrollbar-track { background: transparent; }
    .list-wrapper-scroll::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 10px; }
    .list-wrapper-scroll::-webkit-scrollbar-thumb:hover { background: #94a3b8; }
    .list-item { display: flex; align-items: center; padding: 12px 0; border-bottom: 1px solid #f1f1f1; }
    .list-item:last-child { border-bottom: none; }
    .avatar { width: 40px; height: 40px; border-radius: 50%; background-color: #e9ecef; display: flex; align-items: center; justify-content: center; font-weight: bold; color: #6c757d; }
    .badge-custom { font-weight: 500; padding: 5px 10px; border-radius: 6px; }
    .number-badge { width: 24px; height: 24px; border-radius: 6px; background-color: #f8f9fa; color: #6c757d; display: flex; align-items: center; justify-content: center; font-weight: bold; font-size: 12px; }
    .info-icon { width: 32px; height: 32px; border-radius: 50%; background-color: rgba(37, 99, 235, 0.1); color: #2563EB; display: flex; align-items: center; justify-content: center; }

    /* Animations */
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    .fade-in-up {
        opacity: 0;
        animation: fadeInUp 0.6s cubic-bezier(0.4, 0, 0.2, 1) forwards;
    }
    .stagger-1 { animation-delay: 0.05s; }
    .stagger-2 { animation-delay: 0.1s; }
    .stagger-3 { animation-delay: 0.15s; }
    .stagger-4 { animation-delay: 0.2s; }
    .stagger-5 { animation-delay: 0.25s; }
    .stagger-6 { animation-delay: 0.3s; }
    .stagger-7 { animation-delay: 0.35s; }
    .stagger-8 { animation-delay: 0.4s; }
    .stagger-9 { animation-delay: 0.45s; }
</style>

<div class="d-flex justify-content-between align-items-end mb-4">
    <div>
        <h4 class="fw-bold text-dark m-0">Selamat datang kembali, <?= explode(' ', $this->session->userdata('nama'))[0] ?>!</h4>
    </div>
    <div class="d-none d-md-block">
        <div class="bg-white border rounded-3 px-3 py-2 d-flex align-items-center shadow-sm">
            <i class="far fa-calendar-alt text-muted me-2"></i>
            <span class="text-dark small fw-medium"><?= date('l, d M Y') ?> <br> <small class="text-muted"><?= date('H:i') ?> WIB</small></span>
        </div>
    </div>
</div>

<!-- STAT CARDS -->
<div class="row mb-4">
    <div class="col-xl-3 col-md-6 mb-4 mb-xl-0 fade-in-up stagger-1">
        <div class="card stat-card h-100">
            <div class="card-body">
                <div class="d-flex align-items-center mb-3">
                    <div class="stat-icon bg-icon-blue me-3"><i class="fas fa-box"></i></div>
                    <div>
                        <div class="text-xs fw-bold text-muted text-uppercase mb-1" style="font-size: 11px; letter-spacing: 0.5px;">Total Alat</div>
                        <div class="h4 mb-0 fw-bold text-dark count-up" data-target="<?= $total_alat ?>">0</div>
                    </div>
                </div>
                <div class="trend-up"><i class="fas fa-arrow-up"></i> +<?= $trend_alat ?> dari bulan lalu</div>
                <div class="mt-2"><canvas id="sparkAlat" height="40"></canvas></div>
            </div>
        </div>
    </div>
    
    <div class="col-xl-3 col-md-6 mb-4 mb-xl-0 fade-in-up stagger-2">
        <div class="card stat-card h-100">
            <div class="card-body">
                <div class="d-flex align-items-center mb-3">
                    <div class="stat-icon bg-icon-green me-3"><i class="fas fa-exchange-alt"></i></div>
                    <div>
                        <div class="text-xs fw-bold text-muted text-uppercase mb-1" style="font-size: 11px; letter-spacing: 0.5px;">Total Transaksi</div>
                        <div class="h4 mb-0 fw-bold text-dark count-up" data-target="<?= $total_transaksi ?>">0</div>
                    </div>
                </div>
                <div class="trend-up"><i class="fas fa-arrow-up"></i> +<?= $trend_transaksi ?> dari bulan lalu</div>
                <div class="mt-2"><canvas id="sparkTransaksi" height="40"></canvas></div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4 mb-xl-0 fade-in-up stagger-3">
        <div class="card stat-card h-100">
            <div class="card-body">
                <div class="d-flex align-items-center mb-3">
                    <div class="stat-icon bg-icon-purple me-3"><i class="fas fa-users"></i></div>
                    <div>
                        <div class="text-xs fw-bold text-muted text-uppercase mb-1" style="font-size: 11px; letter-spacing: 0.5px;">Total Peminjam</div>
                        <div class="h4 mb-0 fw-bold text-dark count-up" data-target="<?= $total_peminjam ?>">0</div>
                    </div>
                </div>
                <div class="trend-up"><i class="fas fa-arrow-up"></i> +<?= $trend_peminjam ?> dari bulan lalu</div>
                <div class="mt-2"><canvas id="sparkPeminjam" height="40"></canvas></div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 fade-in-up stagger-4">
        <div class="card stat-card h-100">
            <div class="card-body">
                <div class="d-flex align-items-center mb-3">
                    <div class="stat-icon bg-icon-orange me-3"><i class="fas fa-money-bill-wave"></i></div>
                    <div>
                        <div class="text-xs fw-bold text-muted text-uppercase mb-1" style="font-size: 11px; letter-spacing: 0.5px;">Total Denda</div>
                        <div class="h4 mb-0 fw-bold text-dark count-up" data-target="<?= $total_denda ?>" data-prefix="Rp " data-format="rupiah">Rp 0</div>
                    </div>
                </div>
                <div class="trend-up text-danger"><i class="fas fa-arrow-up"></i> +Rp <?= number_format($trend_denda, 0, ',', '.') ?> dari bulan lalu</div>
                <div class="mt-2"><canvas id="sparkDenda" height="40"></canvas></div>
            </div>
        </div>
    </div>
</div>


<!-- CHARTS SECTION -->
<div class="row mb-4">
    <div class="col-lg-8 mb-4 mb-lg-0 fade-in-up stagger-5">
        <div class="card list-card">
            <div class="card-header bg-white border-0 pt-4 pb-0 d-flex justify-content-between align-items-center">
                <h6 class="m-0 fw-bold text-dark">Grafik Peminjaman & Pengembalian</h6>
                <select class="form-select form-select-sm w-auto shadow-none border-light"><option>6 Bulan Terakhir</option></select>
            </div>
            <div class="card-body">
                <canvas id="mainChart" height="100"></canvas>
            </div>
        </div>
    </div>
    <div class="col-lg-4 fade-in-up stagger-6">
        <div class="card list-card">
            <div class="card-header bg-white border-0 pt-4 pb-0">
                <h6 class="m-0 fw-bold text-dark">Distribusi Status Peminjaman</h6>
            </div>
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-7 position-relative">
                        <canvas id="doughnutChart" height="200"></canvas>
                        <!-- Central Text in Doughnut -->
                        <div class="position-absolute top-50 start-50 translate-middle text-center" style="margin-top: 2px;">
                            <h3 class="fw-bold m-0 text-dark" style="font-size: 1.6rem;"><?= array_sum(json_decode($status_dist)) ?></h3>
                            <span class="text-muted small" style="font-size: 0.7rem; letter-spacing: 0.5px;">Total</span>
                        </div>
                    </div>
                    <div class="col-5 ps-0">
                        <div class="d-flex flex-column gap-2" style="font-size: 0.78rem;">
                            <div class="d-flex align-items-center">
                                <span class="badge rounded-circle me-2" style="background-color: #F59E0B; width: 10px; height: 10px; display: inline-block; padding: 0;"></span>
                                <span class="text-dark fw-medium text-truncate">Menunggu (<?= json_decode($status_dist)[0] ?>)</span>
                            </div>
                            <div class="d-flex align-items-center">
                                <span class="badge rounded-circle me-2" style="background-color: #2563EB; width: 10px; height: 10px; display: inline-block; padding: 0;"></span>
                                <span class="text-dark fw-medium text-truncate">Dipinjam (<?= json_decode($status_dist)[1] ?>)</span>
                            </div>
                            <div class="d-flex align-items-center">
                                <span class="badge rounded-circle me-2" style="background-color: #EF4444; width: 10px; height: 10px; display: inline-block; padding: 0;"></span>
                                <span class="text-dark fw-medium text-truncate">Ditolak (<?= json_decode($status_dist)[2] ?>)</span>
                            </div>
                            <div class="d-flex align-items-center">
                                <span class="badge rounded-circle me-2" style="background-color: #22C55E; width: 10px; height: 10px; display: inline-block; padding: 0;"></span>
                                <span class="text-dark fw-medium text-truncate">Selesai (<?= json_decode($status_dist)[3] ?>)</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- LISTS SECTION -->
<div class="row">
    <!-- Pengajuan Terbaru -->
    <div class="col-lg-4 mb-4 fade-in-up stagger-7">
        <div class="card list-card p-4">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h6 class="m-0 fw-bold text-dark">Pengajuan Terbaru</h6>
                <a href="<?= base_url('transaksi/pengajuan') ?>" class="badge bg-light text-primary text-decoration-none">Lihat Semua</a>
            </div>
            <div class="list-wrapper-scroll">
                <?php if(empty($pengajuan_terbaru)): ?>
                    <p class="text-muted small">Belum ada pengajuan.</p>
                <?php else: ?>
                    <?php foreach($pengajuan_terbaru as $pt): ?>
                    <div class="list-item">
                        <div class="avatar me-3"><?= substr($pt['nama_peminjam'], 0, 1) ?></div>
                        <div class="flex-grow-1">
                            <div class="fw-bold text-dark small"><?= $pt['nama_peminjam'] ?></div>
                            <div class="text-muted" style="font-size:11px;"><?= date('d M Y - H:i', strtotime($pt['tanggal_pengajuan'])) ?></div>
                        </div>
                        <div class="mx-3" style="width: 120px;">
                            <div class="fw-bold text-dark small text-truncate" title="<?= $pt['nama_alat'] ?>"><?= $pt['nama_alat'] ?></div>
                            <div class="text-muted" style="font-size:11px;">Jumlah: <?= $pt['jumlah'] ?></div>
                        </div>
                        <div>
                            <?php if($pt['status'] == 'Menunggu Persetujuan'): ?>
                                <span class="badge badge-custom bg-warning text-dark" style="background-color: #fff3cd !important;">Menunggu</span>
                            <?php elseif($pt['status'] == 'Disetujui'): ?>
                                <span class="badge badge-custom bg-success text-white" style="background-color: #d1e7dd !important; color:#0f5132!important;">Disetujui</span>
                            <?php elseif($pt['status'] == 'Ditolak'): ?>
                                <span class="badge badge-custom bg-danger text-white" style="background-color: #f8d7da !important; color:#842029!important;">Ditolak</span>
                            <?php else: ?>
                                <span class="badge badge-custom bg-primary">Dipinjam</span>
                            <?php endif; ?>
                        </div>
                    </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Alat Populer -->
    <div class="col-lg-4 mb-4 fade-in-up stagger-8">
        <div class="card list-card p-4">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h6 class="m-0 fw-bold text-dark">Alat Paling Banyak Dipinjam</h6>
                <a href="<?= base_url('alat') ?>" class="badge bg-light text-primary text-decoration-none">Lihat Semua</a>
            </div>
            <div class="list-wrapper-scroll">
                <?php if(empty($alat_populer)): ?>
                    <p class="text-muted small">Belum ada data.</p>
                <?php else: ?>
                    <?php $no=1; foreach($alat_populer as $ap): ?>
                    <div class="list-item">
                        <div class="number-badge me-3"><?= $no++ ?></div>
                        <div class="me-3">
                            <img src="<?= base_url('assets/img/'.$ap['foto_alat']) ?>" alt="<?= $ap['nama_alat'] ?>" class="rounded" style="width: 36px; height: 36px; object-fit: cover;">
                        </div>
                        <div class="flex-grow-1">
                            <div class="fw-bold text-dark small"><?= $ap['nama_alat'] ?></div>
                            <div class="text-muted" style="font-size:11px;"><?= $ap['nama_kategori'] ?></div>
                        </div>
                        <div class="fw-bold text-dark small"><?= $ap['total_pinjam'] ?> kali</div>
                    </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Aktivitas Terbaru -->
    <div class="col-lg-4 mb-4 fade-in-up stagger-9">
        <div class="card list-card p-4">
            <div class="mb-3">
                <h6 class="m-0 fw-bold text-dark">Aktivitas Terbaru</h6>
            </div>
            <div class="list-wrapper-scroll">
                <?php if (empty($recent_activities)): ?>
                    <div class="text-center py-4 text-muted small">
                        <i class="fas fa-history fa-2x mb-2 text-muted" style="opacity: 0.3;"></i>
                        <p class="m-0">Belum ada aktivitas terbaru.</p>
                    </div>
                <?php else: ?>
                    <?php foreach ($recent_activities as $act): 
                        $nama = htmlspecialchars($act['nama_user']);
                        $alat = htmlspecialchars($act['nama_alat']);
                        $tipe = $act['tipe'];
                        $status = $act['status'];
                        $nominal = $act['nominal'];
                        
                        $text = "";
                        if ($tipe == 'pengajuan') {
                            $text = "<strong>$nama</strong> mengajukan peminjaman <strong>$alat</strong>";
                        } elseif ($tipe == 'peminjaman') {
                            $text = "<strong>$nama</strong> meminjam <strong>$alat</strong>";
                        } elseif ($tipe == 'pengembalian') {
                            $text = "<strong>$nama</strong> mengembalikan <strong>$alat</strong>";
                        } elseif ($tipe == 'denda') {
                            $formatted_nominal = number_format($nominal, 0, ',', '.');
                            if ($status == 'Sudah Dibayar') {
                                $text = "<strong>$nama</strong> membayar denda Rp $formatted_nominal";
                            } else {
                                $text = "<strong>$nama</strong> dikenakan denda Rp $formatted_nominal";
                            }
                        }
                    ?>
                        <div class="list-item d-flex align-items-start" style="padding: 10px 0;">
                            <span class="text-success me-2 fw-bold">✓</span>
                            <div class="flex-grow-1 text-dark small" style="line-height: 1.4;">
                                <?= $text ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<!-- CHART SCRIPTS -->
<script>
    const dashboardData = {
        totalAlat: <?= $total_alat ?>,
        totalTransaksi: <?= $total_transaksi ?>,
        totalPeminjam: <?= $total_peminjam ?>,
        totalDenda: <?= $total_denda ?>,
        chartLabels: <?= $chart_labels ?>,
        chartPeminjaman: <?= $chart_peminjaman ?>,
        chartPengembalian: <?= $chart_pengembalian ?>,
        statusDist: <?= $status_dist ?>
    };
</script>
<script src="<?= base_url('assets/js/admin-dashboard.js') ?>"></script>
