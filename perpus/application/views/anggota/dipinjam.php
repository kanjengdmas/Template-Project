<div class="card card-modern">
    <div class="card-body">
        <h5 class="fw-bold mb-4">Buku Sedang Dipinjam</h5>
        <div class="row g-4">
            <?php if(empty($peminjaman)): ?>
                <div class="col-12 text-center py-5 text-muted">
                    <i class="fas fa-book-open fs-1 mb-3"></i>
                    <h5>Anda belum meminjam buku apapun.</h5>
                    <a href="<?= base_url('anggota/katalog') ?>" class="btn btn-primary-custom mt-3">Cari Buku Sekarang</a>
                </div>
            <?php else: ?>
                <?php foreach($peminjaman as $p): ?>
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 shadow-sm border-0 bg-light">
                        <div class="row g-0">
                            <div class="col-4">
                                <img src="<?= base_url('assets/img/buku/' . (!empty($p->cover) ? $p->cover : 'default_book.jpg')) ?>" class="img-fluid rounded-start h-100" style="object-fit:cover;" alt="...">
                            </div>
                            <div class="col-8">
                                <div class="card-body d-flex flex-column h-100 p-3">
                                    <h6 class="card-title fw-bold text-truncate" title="<?= $p->judul_buku ?>"><?= $p->judul_buku ?></h6>
                                    <small class="text-muted mb-2"><?= $p->penulis ?></small>
                                    
                                    <div class="mt-auto">
                                        <div class="small mb-1">
                                            <strong>Tgl Pinjam:</strong> <?= date('d M Y', strtotime($p->tanggal_pinjam)) ?>
                                        </div>
                                        <div class="small mb-2">
                                            <?php 
                                            $batas = strtotime($p->batas_kembali);
                                            $sekarang = strtotime(date('Y-m-d'));
                                            $is_late = ($sekarang > $batas);
                                            ?>
                                            <strong>Batas:</strong> <span class="<?= $is_late ? 'text-danger fw-bold' : '' ?>"><?= date('d M Y', $batas) ?></span>
                                        </div>

                                        <?php if($p->status == 'Dipinjam'): ?>
                                            <button class="btn btn-sm btn-primary-custom w-100" onclick="kembalikanBuku(<?= $p->id_pinjam ?>)">Ajukan Pengembalian</button>
                                        <?php elseif($p->status == 'Menunggu Verifikasi'): ?>
                                            <div class="alert alert-warning py-1 px-2 text-center small mb-0 w-100" style="font-size: 0.8rem;">
                                                <i class="fas fa-clock"></i> Menunggu Verifikasi Admin
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</div>

<script>
    window.AppConfig = {
        baseUrl: '<?= base_url() ?>'
    };
</script>
<script src="<?= base_url('assets/js/dipinjam.js') ?>"></script>
