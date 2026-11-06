<style>
    .stat-card { border-radius: 12px; border: none; box-shadow: 0 4px 12px rgba(0,0,0,0.03); transition: transform 0.2s; }
    .stat-card:hover { transform: translateY(-5px); }
    .stat-icon { width: 48px; height: 48px; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 20px; }
    .bg-icon-blue { background-color: rgba(37, 99, 235, 0.1); color: #2563EB; }
    .bg-icon-orange { background-color: rgba(245, 158, 11, 0.1); color: #F59E0B; }
    .bg-icon-green { background-color: rgba(34, 197, 94, 0.1); color: #22C55E; }
    .trend-up { color: #22C55E; font-size: 12px; font-weight: 600; }
    .trend-neutral { color: #6c757d; font-size: 12px; font-weight: 500; }
    
    .list-card { border-radius: 12px; border: none; box-shadow: 0 4px 12px rgba(0,0,0,0.03); height: 100%; }
    .table-custom th { font-size: 12px; text-transform: none; color: #000; font-weight: 700; border-bottom: 2px solid #f1f1f1; padding: 12px 8px; }
    .table-custom td { padding: 12px 8px; vertical-align: middle; border-bottom: 1px solid #f1f1f1; }
    .table-custom tr:last-child td { border-bottom: none; }
    
    .badge-custom { font-weight: 500; padding: 5px 10px; border-radius: 6px; }
    
    .cta-card { background-color: #f8fafc; border: 1px dashed #cbd5e1; border-radius: 12px; }
    .alert-box { border-radius: 10px; padding: 16px; margin-bottom: 12px; display: flex; align-items: flex-start; }
    .alert-box:last-child { margin-bottom: 0; }
    .alert-icon { font-size: 20px; margin-right: 12px; }
    
    .list-item { display: flex; align-items: center; padding: 12px 0; border-bottom: 1px solid #f1f1f1; }
    .list-item:last-child { border-bottom: none; }
    .number-badge { width: 24px; height: 24px; border-radius: 6px; display: flex; align-items: center; justify-content: center; font-weight: bold; font-size: 12px; }
    .nb-1 { background-color: rgba(245, 158, 11, 0.1); color: #F59E0B; }
    .nb-2 { background-color: rgba(37, 99, 235, 0.1); color: #2563EB; }
    .nb-3 { background-color: rgba(34, 197, 94, 0.1); color: #22C55E; }
    .nb-4 { background-color: rgba(139, 92, 246, 0.1); color: #8B5CF6; }
    .nb-5 { background-color: rgba(108, 117, 125, 0.1); color: #6c757d; }
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
    <div class="col-xl-4 col-md-6 mb-4 mb-xl-0">
        <div class="card stat-card h-100">
            <div class="card-body">
                <div class="d-flex align-items-center mb-3">
                    <div class="stat-icon bg-icon-blue me-3"><i class="fas fa-file-alt"></i></div>
                    <div>
                        <div class="text-xs fw-bold text-muted text-uppercase mb-1" style="font-size: 11px; letter-spacing: 0.5px;">Total Pengajuan</div>
                        <div class="h4 mb-0 fw-bold text-dark"><?= $total_pengajuan ?></div>
                    </div>
                </div>
                <div class="trend-up"><i class="fas fa-arrow-up"></i> +<?= $trend_pengajuan ?> dari bulan lalu</div>
                <div class="mt-2"><canvas id="sparkPengajuan" height="40"></canvas></div>
            </div>
        </div>
    </div>
    
    <div class="col-xl-4 col-md-6 mb-4 mb-xl-0">
        <div class="card stat-card h-100">
            <div class="card-body">
                <div class="d-flex align-items-center mb-3">
                    <div class="stat-icon bg-icon-orange me-3"><i class="far fa-clock"></i></div>
                    <div>
                        <div class="text-xs fw-bold text-muted text-uppercase mb-1" style="font-size: 11px; letter-spacing: 0.5px;">Menunggu Persetujuan</div>
                        <div class="h4 mb-0 fw-bold text-dark"><?= $menunggu ?></div>
                    </div>
                </div>
                <div class="trend-neutral">Sama seperti bulan lalu</div>
                <div class="mt-2"><canvas id="sparkMenunggu" height="40"></canvas></div>
            </div>
        </div>
    </div>

    <div class="col-xl-4 col-md-6 mb-4 mb-xl-0">
        <div class="card stat-card h-100">
            <div class="card-body">
                <div class="d-flex align-items-center mb-3">
                    <div class="stat-icon bg-icon-green me-3"><i class="fas fa-box-open"></i></div>
                    <div>
                        <div class="text-xs fw-bold text-muted text-uppercase mb-1" style="font-size: 11px; letter-spacing: 0.5px;">Sedang Dipinjam</div>
                        <div class="h4 mb-0 fw-bold text-dark"><?= $dipinjam ?></div>
                    </div>
                </div>
                <div class="trend-neutral">Sama seperti bulan lalu</div>
                <div class="mt-2"><canvas id="sparkDipinjam" height="40"></canvas></div>
            </div>
        </div>
    </div>
</div>

<!-- MIDDLE SECTION -->
<div class="row mb-4">
    <!-- Riwayat Peminjaman Terbaru -->
    <div class="col-lg-8 mb-4 mb-lg-0">
        <div class="card list-card p-4">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h6 class="m-0 fw-bold text-dark">Riwayat Peminjaman Terbaru</h6>
                <a href="<?= base_url('peminjam/riwayat') ?>" class="badge bg-light text-primary text-decoration-none">Lihat Semua</a>
            </div>
            <div class="table-responsive">
                <table class="table table-custom mb-0">
                    <thead>
                        <tr>
                            <th>Kode Peminjaman</th>
                            <th>Alat</th>
                            <th>Tgl Pengajuan</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(empty($riwayat_terbaru)): ?>
                            <tr><td colspan="4" class="text-center text-muted py-4">Belum ada riwayat peminjaman.</td></tr>
                        <?php else: ?>
                            <?php foreach($riwayat_terbaru as $rt): ?>
                            <tr>
                                <td><span class="text-dark small fw-medium"><?= $rt['kode_peminjaman'] ?></span></td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="text-muted me-2"><i class="fas fa-toolbox"></i></div>
                                        <div>
                                            <div class="fw-bold text-dark small text-truncate" style="max-width: 150px;"><?= $rt['nama_alat'] ?></div>
                                            <div class="text-muted" style="font-size:11px;"><?= $rt['jumlah'] ?> Unit</div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="text-dark small"><?= date('d M Y', strtotime($rt['tanggal_pengajuan'])) ?></div>
                                    <div class="text-muted" style="font-size:11px;"><?= date('H:i', strtotime($rt['tanggal_pengajuan'])) ?></div>
                                </td>
                                <td>
                                    <?php if($rt['status'] == 'Menunggu Persetujuan'): ?>
                                        <span class="badge badge-custom text-warning" style="background-color: #fef3c7;">Menunggu</span>
                                    <?php elseif($rt['status'] == 'Disetujui'): ?>
                                        <span class="badge badge-custom bg-success text-white">Disetujui</span>
                                    <?php elseif($rt['status'] == 'Ditolak'): ?>
                                        <span class="badge badge-custom bg-danger text-white">Ditolak</span>
                                    <?php elseif($rt['status'] == 'Dipinjam'): ?>
                                        <span class="badge badge-custom bg-primary text-white">Dipinjam</span>
                                    <?php else: ?>
                                        <span class="badge badge-custom bg-success text-white" style="background-color: #d1e7dd !important; color:#0f5132!important;">Selesai</span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Grafik Status Peminjaman -->
    <div class="col-lg-4">
        <div class="card list-card">
            <div class="card-header bg-white border-0 pt-4 pb-0">
                <h6 class="m-0 fw-bold text-dark">Status Peminjaman</h6>
            </div>
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-7 position-relative">
                        <canvas id="doughnutChart" height="200"></canvas>
                        <!-- Central Text in Doughnut -->
                        <div class="position-absolute top-50 start-50 translate-middle text-center" style="margin-top: 2px;">
                            <h3 class="fw-bold m-0 text-dark" style="font-size: 1.6rem;"><?= $total_pengajuan ?></h3>
                            <span class="text-muted small" style="font-size: 0.7rem; letter-spacing: 0.5px;">Total</span>
                        </div>
                    </div>
                    <div class="col-5 ps-0">
                        <div class="d-flex flex-column gap-2" style="font-size: 0.78rem;">
                            <div class="d-flex align-items-center">
                                <span class="badge rounded-circle me-2" style="background-color: #2563EB; width: 10px; height: 10px; display: inline-block; padding: 0;"></span>
                                <span class="text-dark fw-medium text-truncate">Selesai (<?= json_decode($status_dist)[0] ?>)</span>
                            </div>
                            <div class="d-flex align-items-center">
                                <span class="badge rounded-circle me-2" style="background-color: #22C55E; width: 10px; height: 10px; display: inline-block; padding: 0;"></span>
                                <span class="text-dark fw-medium text-truncate">Dipinjam (<?= json_decode($status_dist)[1] ?>)</span>
                            </div>
                            <div class="d-flex align-items-center">
                                <span class="badge rounded-circle me-2" style="background-color: #F59E0B; width: 10px; height: 10px; display: inline-block; padding: 0;"></span>
                                <span class="text-dark fw-medium text-truncate">Menunggu (<?= json_decode($status_dist)[2] ?>)</span>
                            </div>
                            <div class="d-flex align-items-center">
                                <span class="badge rounded-circle me-2" style="background-color: #EF4444; width: 10px; height: 10px; display: inline-block; padding: 0;"></span>
                                <span class="text-dark fw-medium text-truncate">Ditolak (<?= json_decode($status_dist)[3] ?>)</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<!-- BOTTOM SECTION -->
<div class="row">
    <!-- CTA Ajukan Peminjaman -->
    <div class="col-lg-4 mb-4 mb-lg-0">
        <div class="card list-card p-4">
            <h6 class="fw-bold text-dark mb-2">Ajukan Peminjaman Baru</h6>
            <p class="text-muted small mb-4">Ajukan peminjaman alat yang Anda butuhkan dengan mudah.</p>
            
            <a href="<?= base_url('peminjam/alat') ?>" class="btn btn-primary fw-bold py-2 px-4 mb-4"><i class="fas fa-plus me-2"></i> Ajukan Peminjaman</a>
            
            <div class="text-center mt-auto">
                <!-- Simple mock illustration -->
                <div style="font-size: 80px; color: rgba(37, 99, 235, 0.1);"><i class="fas fa-clipboard-check"></i></div>
            </div>
        </div>
    </div>

    <!-- Alat Populer -->
    <div class="col-lg-4 mb-4 mb-lg-0">
        <div class="card list-card p-4">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h6 class="m-0 fw-bold text-dark">Alat Populer</h6>
                <a href="<?= base_url('peminjam/alat') ?>" class="badge bg-light text-primary text-decoration-none">Lihat Semua</a>
            </div>
            <div class="list-wrapper">
                <?php if(empty($alat_populer)): ?>
                    <p class="text-muted small">Belum ada data.</p>
                <?php else: ?>
                    <?php $no=1; foreach($alat_populer as $ap): ?>
                    <div class="list-item">
                        <div class="number-badge nb-<?= $no ?> me-3"><?= $no++ ?></div>
                        <div class="me-3">
                            <img src="<?= base_url('assets/img/'.$ap['foto_alat']) ?>" alt="<?= $ap['nama_alat'] ?>" class="rounded" style="width: 36px; height: 36px; object-fit: cover;">
                        </div>
                        <div class="flex-grow-1">
                            <div class="fw-bold text-dark small"><?= $ap['nama_alat'] ?></div>
                            <div class="text-muted" style="font-size:11px;"><?= $ap['total_pinjam'] ?> kali dipinjam</div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Informasi Penting -->
    <div class="col-lg-4">
        <div class="card list-card p-4">
            <div class="mb-3">
                <h6 class="m-0 fw-bold text-dark">Informasi Penting</h6>
            </div>
            
            <div class="alert-box" style="background-color: rgba(37, 99, 235, 0.05); border: 1px solid rgba(37, 99, 235, 0.1);">
                <div class="alert-icon text-primary"><i class="fas fa-info-circle"></i></div>
                <div>
                    <div class="fw-bold text-primary small mb-1">Pastikan alat dikembalikan tepat waktu</div>
                    <div class="text-muted" style="font-size: 11px;">Keterlambatan pengembalian akan dikenakan denda.</div>
                </div>
            </div>

            <div class="alert-box" style="background-color: rgba(245, 158, 11, 0.05); border: 1px solid rgba(245, 158, 11, 0.1);">
                <div class="alert-icon text-warning"><i class="fas fa-exclamation-triangle"></i></div>
                <div>
                    <div class="fw-bold text-warning small mb-1">Jaga kondisi alat</div>
                    <div class="text-muted" style="font-size: 11px;">Gunakan alat dengan baik dan jangan sampai rusak.</div>
                </div>
            </div>

            <div class="alert-box" style="background-color: rgba(34, 197, 94, 0.05); border: 1px solid rgba(34, 197, 94, 0.1);">
                <div class="alert-icon text-success"><i class="fas fa-check-circle"></i></div>
                <div>
                    <div class="fw-bold text-success small mb-1">Hubungi petugas jika ada kendala</div>
                    <div class="text-muted" style="font-size: 11px;">Jangan ragu untuk bertanya atau meminta bantuan.</div>
                </div>
            </div>
            
        </div>
    </div>
</div>

<script>
    const peminjamDashboardData = {
        totalPengajuan: <?= (int)$total_pengajuan ?>,
        menunggu: <?= (int)$menunggu ?>,
        dipinjam: <?= (int)$dipinjam ?>,
        statusDist: <?= $status_dist ?>
    };
</script>
<script src="<?= base_url('assets/js/peminjam-dashboard.js?v=1.1') ?>"></script>

