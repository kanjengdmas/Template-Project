<div class="row g-4 mb-4">
    <div class="col-md-4 col-lg-3">
        <div class="card card-modern h-100">
            <div class="card-body d-flex align-items-center">
                <div class="stat-icon bg-primary text-white"><i class="fas fa-book"></i></div>
                <div class="ms-3">
                    <h3 class="mb-0 fw-bold counter"><?= $total_buku ?></h3>
                    <span class="text-muted small">Total Buku</span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4 col-lg-3">
        <div class="card card-modern h-100">
            <div class="card-body d-flex align-items-center">
                <div class="stat-icon bg-success text-white"><i class="fas fa-users"></i></div>
                <div class="ms-3">
                    <h3 class="mb-0 fw-bold counter"><?= $total_anggota ?></h3>
                    <span class="text-muted small">Total Anggota</span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4 col-lg-3">
        <div class="card card-modern h-100">
            <div class="card-body d-flex align-items-center">
                <div class="stat-icon bg-info text-white"><i class="fas fa-exchange-alt"></i></div>
                <div class="ms-3">
                    <h3 class="mb-0 fw-bold counter"><?= $total_peminjaman ?></h3>
                    <span class="text-muted small">Total Transaksi</span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4 col-lg-3">
        <div class="card card-modern h-100">
            <div class="card-body d-flex align-items-center">
                <div class="stat-icon bg-warning text-white"><i class="fas fa-clock"></i></div>
                <div class="ms-3">
                    <h3 class="mb-0 fw-bold counter"><?= $menunggu_verifikasi ?></h3>
                    <span class="text-muted small">Menunggu Verifikasi</span>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row g-4">
    <!-- Chart -->
    <div class="col-lg-8">
        <div class="card card-modern h-100">
            <div class="card-body">
                <h5 class="fw-bold mb-4">Statistik Peminjaman</h5>
                <canvas id="borrowChart" height="100"></canvas>
            </div>
        </div>
    </div>
    
    <!-- Buku Terpopuler -->
    <div class="col-lg-4">
        <div class="card card-modern h-100">
            <div class="card-body">
                <h5 class="fw-bold mb-4">Buku Terpopuler</h5>
                <?php if(empty($buku_terpopuler)): ?>
                    <p class="text-muted text-center">Belum ada data peminjaman</p>
                <?php else: ?>
                    <ul class="list-group list-group-flush">
                        <?php foreach($buku_terpopuler as $b): ?>
                        <li class="list-group-item px-0 d-flex justify-content-between align-items-center border-0 mb-2">
                            <div class="d-flex align-items-center">
                                <img src="<?= base_url('assets/img/buku/' . (!empty($b->cover) ? $b->cover : 'default_book.jpg')) ?>" class="rounded" width="40" height="60" style="object-fit:cover;">
                                <div class="ms-3">
                                    <h6 class="mb-0 fw-bold text-truncate" style="max-width: 150px;" title="<?= $b->judul ?>"><?= $b->judul ?></h6>
                                    <small class="text-muted"><?= $b->penulis ?></small>
                                </div>
                            </div>
                            <span class="badge bg-primary rounded-pill"><?= $b->total_pinjam ?>x Pinjam</span>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<script>
    window.AppConfig = {
        bukuDipinjam: <?= $buku_dipinjam ?>,
        menungguVerifikasi: <?= $menunggu_verifikasi ?>,
        bukuDikembalikan: <?= $buku_dikembalikan ?>
    };
</script>
<script src="<?= base_url('assets/js/admin_dashboard.js') ?>"></script>
