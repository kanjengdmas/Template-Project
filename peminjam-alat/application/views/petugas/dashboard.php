<style>
    .stat-card { border-radius: 12px; border: none; box-shadow: 0 4px 12px rgba(0,0,0,0.03); transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); }
    .stat-card:hover { transform: translateY(-5px); box-shadow: 0 8px 24px rgba(0,0,0,0.08); }
    .stat-icon { width: 48px; height: 48px; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 20px; }
    .bg-icon-orange { background-color: rgba(245, 158, 11, 0.1); color: #F59E0B; }
    .bg-icon-blue { background-color: rgba(37, 99, 235, 0.1); color: #2563EB; }
    .bg-icon-green { background-color: rgba(34, 197, 94, 0.1); color: #22C55E; }
    .bg-icon-purple { background-color: rgba(139, 92, 246, 0.1); color: #8B5CF6; }
    .trend-up { color: #22C55E; font-size: 12px; font-weight: 600; }
    .trend-down { color: #EF4444; font-size: 12px; font-weight: 600; }
    .list-card { border-radius: 12px; border: none; box-shadow: 0 4px 12px rgba(0,0,0,0.03); height: 100%; transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); }
    .list-card:hover { transform: translateY(-5px); box-shadow: 0 8px 24px rgba(0,0,0,0.08); }
    .table-custom th { font-size: 12px; text-transform: none; color: #000; font-weight: 700; border-bottom: 2px solid #f1f1f1; padding: 12px 8px; }
    .table-custom td { padding: 12px 8px; vertical-align: middle; border-bottom: 1px solid #f1f1f1; }
    .table-custom tr:last-child td { border-bottom: none; }
    .avatar { width: 36px; height: 36px; border-radius: 50%; background-color: #e9ecef; display: flex; align-items: center; justify-content: center; font-weight: bold; color: #6c757d; }
    .badge-custom { font-weight: 500; padding: 5px 10px; border-radius: 6px; }
    .btn-outline-custom { border: 1px solid #E5E7EB; color: #2563EB; background: #fff; padding: 4px 10px; font-size: 12px; font-weight: 600; border-radius: 6px; text-decoration: none; display: inline-block; transition: all 0.2s; }
    .btn-outline-custom:hover { background: #2563EB; color: #fff; }
    .quick-link-item { display: flex; justify-content: space-between; align-items: center; padding: 12px 0; border-bottom: 1px solid #f1f1f1; text-decoration: none; color: #333; transition: all 0.2s; }
    .quick-link-item:hover { color: #2563EB; padding-left: 4px; }
    .quick-link-item:last-child { border-bottom: none; }

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
                    <div class="stat-icon bg-icon-orange me-3"><i class="far fa-clock"></i></div>
                    <div>
                        <div class="text-xs fw-bold text-muted text-uppercase mb-1" style="font-size: 11px; letter-spacing: 0.5px;">Menunggu Persetujuan</div>
                        <div class="h4 mb-0 fw-bold text-dark count-up" data-target="<?= $menunggu ?>">0</div>
                    </div>
                </div>
                <div class="trend-up"><i class="fas fa-arrow-up"></i> +<?= $trend_menunggu ?> dari kemarin</div>
                <div class="mt-2"><canvas id="sparkMenunggu" height="40"></canvas></div>
            </div>
        </div>
    </div>
    
    <div class="col-xl-3 col-md-6 mb-4 mb-xl-0 fade-in-up stagger-2">
        <div class="card stat-card h-100">
            <div class="card-body">
                <div class="d-flex align-items-center mb-3">
                    <div class="stat-icon bg-icon-blue me-3"><i class="fas fa-box"></i></div>
                    <div>
                        <div class="text-xs fw-bold text-muted text-uppercase mb-1" style="font-size: 11px; letter-spacing: 0.5px;">Alat Sedang Dipinjam</div>
                        <div class="h4 mb-0 fw-bold text-dark count-up" data-target="<?= $dipinjam ?>">0</div>
                    </div>
                </div>
                <div class="trend-up"><i class="fas fa-arrow-up"></i> +<?= $trend_dipinjam ?> dari kemarin</div>
                <div class="mt-2"><canvas id="sparkDipinjam" height="40"></canvas></div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4 mb-xl-0 fade-in-up stagger-3">
        <div class="card stat-card h-100">
            <div class="card-body">
                <div class="d-flex align-items-center mb-3">
                    <div class="stat-icon bg-icon-green me-3"><i class="fas fa-history"></i></div>
                    <div>
                        <div class="text-xs fw-bold text-muted text-uppercase mb-1" style="font-size: 11px; letter-spacing: 0.5px;">Pengembalian Hari Ini</div>
                        <div class="h4 mb-0 fw-bold text-dark count-up" data-target="<?= $kembali_hari_ini ?>">0</div>
                    </div>
                </div>
                <div class="trend-down"><i class="fas fa-arrow-down"></i> <?= $trend_kembali ?> dari kemarin</div>
                <div class="mt-2"><canvas id="sparkKembali" height="40"></canvas></div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 fade-in-up stagger-4">
        <div class="card stat-card h-100">
            <div class="card-body">
                <div class="d-flex align-items-center mb-3">
                    <div class="stat-icon bg-icon-purple me-3"><i class="fas fa-check-square"></i></div>
                    <div>
                        <div class="text-xs fw-bold text-muted text-uppercase mb-1" style="font-size: 11px; letter-spacing: 0.5px;">Pengembalian Selesai</div>
                        <div class="h4 mb-0 fw-bold text-dark count-up" data-target="<?= $selesai ?>">0</div>
                    </div>
                </div>
                <div class="trend-up"><i class="fas fa-arrow-up"></i> +<?= $trend_selesai ?> dari kemarin</div>
                <div class="mt-2"><canvas id="sparkSelesai" height="40"></canvas></div>
            </div>
        </div>
    </div>
</div>


<!-- MIDDLE SECTION -->
<div class="row mb-4">
    <!-- Pengajuan Peminjaman Terbaru -->
    <div class="col-lg-8 mb-4 mb-lg-0 fade-in-up stagger-5">
        <div class="card list-card p-4">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h6 class="m-0 fw-bold text-dark">Pengajuan Peminjaman Terbaru</h6>
                <a href="<?= base_url('transaksi/pengajuan') ?>" class="badge bg-light text-primary text-decoration-none">Lihat Semua</a>
            </div>
            <div class="table-responsive">
                <table class="table table-custom mb-0">
                    <thead>
                        <tr>
                            <th width="5%">No</th>
                            <th>Peminjam</th>
                            <th>Alat yang Dipinjam</th>
                            <th>Tanggal Pinjam</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(empty($pengajuan_terbaru)): ?>
                            <tr><td colspan="6" class="text-center text-muted py-4">Belum ada pengajuan.</td></tr>
                        <?php else: ?>
                            <?php $no=1; foreach($pengajuan_terbaru as $pt): ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar me-2" style="width:32px; height:32px; font-size:12px;"><?= substr($pt['nama_peminjam'], 0, 1) ?></div>
                                        <div>
                                            <div class="fw-bold text-dark small"><?= $pt['nama_peminjam'] ?></div>
                                            <div class="text-muted" style="font-size:11px;">NIM. <?= $pt['nim_nik'] ?? '-' ?></div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="fw-bold text-dark small text-truncate" style="max-width: 150px;"><?= $pt['nama_alat'] ?></div>
                                    <div class="text-muted" style="font-size:11px;"><?= $pt['jumlah'] ?> Unit</div>
                                </td>
                                <td>
                                    <div class="text-dark small"><?= date('d M Y', strtotime($pt['tanggal_pengajuan'])) ?></div>
                                    <div class="text-muted" style="font-size:11px;"><?= date('H:i', strtotime($pt['tanggal_pengajuan'])) ?></div>
                                </td>
                                <td>
                                    <span class="badge badge-custom bg-warning text-dark" style="background-color: #fef3c7 !important; color: #d97706 !important;">Menunggu</span>
                                </td>
                                <td>
                                    <a href="<?= base_url('transaksi/pengajuan') ?>" class="btn-outline-custom"><i class="far fa-check-square"></i> Verifikasi</a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Grafik Statistik Peminjaman -->
    <div class="col-lg-4 fade-in-up stagger-6">
        <div class="card list-card">
            <div class="card-header bg-white border-0 pt-4 pb-0">
                <h6 class="m-0 fw-bold text-dark">Statistik Peminjaman (6 Bulan Terakhir)</h6>
            </div>
            <div class="card-body">
                <canvas id="mainChart" height="250"></canvas>
            </div>
        </div>
    </div>
</div>

<!-- BOTTOM SECTION -->
<div class="row">
    <!-- Pengembalian Hari Ini -->
    <div class="col-lg-5 mb-4 mb-lg-0 fade-in-up stagger-7">
        <div class="card list-card p-4">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h6 class="m-0 fw-bold text-dark">Pengembalian Hari Ini</h6>
                <a href="<?= base_url('transaksi/pengembalian') ?>" class="badge bg-light text-primary text-decoration-none">Lihat Semua</a>
            </div>
            <div class="table-responsive">
                <table class="table table-custom mb-0">
                    <thead>
                        <tr>
                            <th width="5%">No</th>
                            <th>Peminjam</th>
                            <th>Alat</th>
                            <th>Tgl Kembali</th>
                            <th>Kondisi</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(empty($pengembalian_hari_ini)): ?>
                            <tr><td colspan="6" class="text-center text-muted py-4">Tidak ada pengembalian hari ini.</td></tr>
                        <?php else: ?>
                            <?php $no=1; foreach($pengembalian_hari_ini as $ph): ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar me-2" style="width:28px; height:28px; font-size:10px;"><?= substr($ph['nama_peminjam'], 0, 1) ?></div>
                                        <div>
                                            <div class="fw-bold text-dark" style="font-size:12px;"><?= $ph['nama_peminjam'] ?></div>
                                            <div class="text-muted" style="font-size:10px;">NIM. <?= $ph['nim_nik'] ?? '-' ?></div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="fw-bold text-dark text-truncate" style="font-size:12px; max-width: 100px;" title="<?= $ph['nama_alat'] ?>"><?= $ph['nama_alat'] ?></div>
                                    <div class="text-muted" style="font-size:10px;"><?= $ph['jumlah'] ?> Unit</div>
                                </td>
                                <td>
                                    <div class="text-dark" style="font-size:12px;"><?= date('d M Y', strtotime($ph['tanggal_kembali_rencana'])) ?></div>
                                    <div class="text-muted" style="font-size:10px;">10:00</div>
                                </td>
                                <td>
                                    <span class="badge text-warning" style="background-color: #fef3c7; color: #d97706 !important;">Belum Diperiksa</span>
                                </td>
                                <td>
                                    <a href="<?= base_url('transaksi/pengembalian') ?>" class="btn-outline-custom" style="padding: 2px 6px; font-size:10px;"><i class="fas fa-search"></i> Periksa</a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Alat Sedang Dipinjam -->
    <div class="col-lg-4 mb-4 mb-lg-0 fade-in-up stagger-8">
        <div class="card list-card p-4">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h6 class="m-0 fw-bold text-dark">Alat Sedang Dipinjam</h6>
                <a href="<?= base_url('alat') ?>" class="badge bg-light text-primary text-decoration-none">Lihat Semua</a>
            </div>
            <div class="table-responsive">
                <table class="table table-custom mb-0">
                    <thead>
                        <tr>
                            <th width="5%">No</th>
                            <th>Alat</th>
                            <th class="text-center">Jumlah Dipinjam</th>
                            <th class="text-center">Tersedia</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(empty($alat_dipinjam)): ?>
                            <tr><td colspan="4" class="text-center text-muted py-4">Tidak ada alat yang dipinjam.</td></tr>
                        <?php else: ?>
                            <?php $no=1; foreach($alat_dipinjam as $ad): ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="me-2">
                                            <img src="<?= base_url('assets/img/'.$ad['foto_alat']) ?>" alt="<?= $ad['nama_alat'] ?>" class="rounded" style="width: 32px; height: 32px; object-fit: cover;">
                                        </div>
                                        <div class="fw-bold text-dark small text-truncate" style="max-width: 120px;" title="<?= $ad['nama_alat'] ?>"><?= $ad['nama_alat'] ?></div>
                                    </div>
                                </td>
                                <td class="text-center text-dark small"><?= $ad['jumlah_dipinjam'] ?> Unit</td>
                                <td class="text-center">
                                    <span class="text-success small fw-bold" style="color: #22c55e !important;"><?= $ad['stok'] ?> Unit</span>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Informasi Cepat -->
    <div class="col-lg-3 fade-in-up stagger-9">
        <div class="card list-card p-4">
            <div class="mb-3">
                <h6 class="m-0 fw-bold text-dark">Informasi Cepat</h6>
            </div>
            <div>
                <a href="<?= base_url('transaksi/pengajuan') ?>" class="quick-link-item">
                    <div><i class="far fa-edit text-primary me-2"></i> <span class="small fw-medium">Verifikasi Pengajuan</span></div>
                    <span class="badge rounded-pill bg-danger"><?= $menunggu ?></span>
                </a>
                <a href="<?= base_url('transaksi/pengembalian') ?>" class="quick-link-item">
                    <div><i class="fas fa-undo text-primary me-2"></i> <span class="small fw-medium">Pengembalian Hari Ini</span></div>
                    <span class="badge rounded-pill bg-warning text-dark"><?= $kembali_hari_ini ?></span>
                </a>
                <a href="<?= base_url('alat') ?>" class="quick-link-item">
                    <div><i class="far fa-calendar-alt text-primary me-2"></i> <span class="small fw-medium">Alat Sedang Dipinjam</span></div>
                    <span class="badge rounded-pill bg-primary"><?= $dipinjam ?></span>
                </a>
                <a href="<?= base_url('laporan') ?>" class="quick-link-item mt-3 border-top-0 pt-0">
                    <div><i class="far fa-file-alt text-primary me-2"></i> <span class="small fw-medium">Cetak Laporan</span></div>
                    <i class="fas fa-chevron-right text-muted small"></i>
                </a>
            </div>
        </div>
    </div>
</div>

<script>
    const dashboardData = {
        menunggu: <?= (int)$menunggu ?>,
        dipinjam: <?= (int)$dipinjam ?>,
        kembaliHariIni: <?= (int)$kembali_hari_ini ?>,
        selesai: <?= (int)$selesai ?>,
        chartLabels: <?= $chart_labels ?>,
        chartPeminjaman: <?= $chart_peminjaman ?>,
        chartPengembalian: <?= $chart_pengembalian ?>
    };
</script>
<script src="<?= base_url('assets/js/petugas-dashboard.js') ?>"></script>
