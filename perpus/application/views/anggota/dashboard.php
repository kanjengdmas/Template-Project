<div class="row mb-4">
    <div class="col-12">
        <div class="card card-modern bg-primary text-white" style="background: linear-gradient(135deg, var(--primary-color), var(--accent-color));">
            <div class="card-body p-4 d-flex align-items-center">
                <div class="me-4 d-none d-md-block">
                    <i class="fas fa-book-reader" style="font-size: 4rem; opacity: 0.8;"></i>
                </div>
                <div>
                    <h3 class="fw-bold mb-1">Selamat Datang, <?= $this->session->userdata('nama') ?>!</h3>
                    <p class="mb-0 text-white-50">Mari temukan buku menarik hari ini di E-Perpus. Jelajahi katalog kami sekarang.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row g-4">
    <div class="col-md-6 col-lg-4">
        <div class="card card-modern h-100 border-start border-4 border-warning">
            <div class="card-body">
                <h6 class="text-muted text-uppercase fw-bold mb-3">Status Peminjaman Anda</h6>
                <div class="d-flex justify-content-between align-items-center">
                    <h2 class="fw-bold mb-0 text-warning"><?= $active_borrows ?> / 3</h2>
                    <i class="fas fa-book text-warning fs-1 opacity-25"></i>
                </div>
                <p class="text-muted mt-3 mb-0 small">Batas maksimal peminjaman adalah 3 buku.</p>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-lg-8">
        <div class="card card-modern h-100">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h6 class="text-muted text-uppercase fw-bold mb-0">Riwayat Terakhir</h6>
                    <a href="<?= base_url('anggota/riwayat') ?>" class="btn btn-sm btn-outline-primary">Lihat Semua</a>
                </div>
                <?php if(empty($riwayat)): ?>
                    <div class="text-center py-4 text-muted">
                        <i class="fas fa-folder-open fs-3 mb-2"></i>
                        <p>Belum ada riwayat peminjaman.</p>
                    </div>
                <?php else: ?>
                    <ul class="list-group list-group-flush">
                        <?php $limit = 0; foreach($riwayat as $r): if($limit++ >= 3) break; ?>
                        <li class="list-group-item px-0 d-flex justify-content-between align-items-center border-0 mb-2 pb-2 border-bottom">
                            <div class="d-flex align-items-center">
                                <img src="<?= base_url('assets/img/buku/' . (!empty($r->cover) ? $r->cover : 'default_book.jpg')) ?>" class="rounded" width="40" height="60" style="object-fit:cover;">
                                <div class="ms-3">
                                    <h6 class="mb-0 fw-bold text-truncate" style="max-width: 250px;" title="<?= $r->judul_buku ?>"><?= $r->judul_buku ?></h6>
                                    <small class="text-muted">Pinjam: <?= date('d/m/Y', strtotime($r->tanggal_pinjam)) ?></small>
                                </div>
                            </div>
                            <?php if($r->status == 'Dipinjam'): ?>
                                <span class="badge bg-primary rounded-pill">Dipinjam</span>
                            <?php elseif($r->status == 'Menunggu Verifikasi'): ?>
                                <span class="badge bg-warning text-dark rounded-pill">Menunggu</span>
                            <?php else: ?>
                                <span class="badge bg-success rounded-pill">Selesai</span>
                            <?php endif; ?>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
