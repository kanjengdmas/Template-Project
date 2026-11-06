<link rel="stylesheet" href="<?= base_url('assets/css/peminjam-alat-list.css') ?>">

<?php
// Extract unique categories dynamically from the loaded alat
$categories = [];
foreach ($alat as $a) {
    if (!empty($a['nama_kategori']) && !in_array($a['nama_kategori'], $categories)) {
        $categories[] = $a['nama_kategori'];
    }
}
?>

<div class="row mb-3">
    <div class="col-12">
        <h5 class="fw-bold text-dark m-0">Katalog Alat Tersedia</h5>
        <p class="text-muted small m-0 mt-1">Pilih dan ajukan pinjaman alat inventaris Sipanja di bawah ini</p>
    </div>
</div>

<!-- Filter and Search Bar Dashboard -->
<div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-4 p-3 bg-white" style="border-radius: 14px; border: 1px solid #f1f5f9; box-shadow: 0 4px 20px rgba(0,0,0,0.01);">
    <!-- Category Pills -->
    <div class="d-flex flex-wrap gap-2" id="category-pills">
        <button class="btn btn-category active" data-category="all">Semua</button>
        <?php foreach($categories as $cat): ?>
            <button class="btn btn-category" data-category="<?= htmlspecialchars($cat) ?>"><?= htmlspecialchars($cat) ?></button>
        <?php endforeach; ?>
    </div>
    
    <!-- Search and View Switcher -->
    <div class="d-flex flex-wrap align-items-center gap-3">
        <div class="position-relative" style="width: 220px;">
            <input type="text" id="search-alat" class="form-control form-control-premium py-1.5 pe-3" placeholder="Cari alat..." style="padding-left: 2.2rem;">
            <i class="fas fa-search position-absolute text-muted" style="left: 12px; top: 50%; transform: translateY(-50%); font-size: 0.85rem;"></i>
        </div>
        
        <div class="btn-group" style="background-color: #f1f5f9; padding: 3px; border-radius: 10px;">
            <button class="btn btn-sm border-0 active" id="btn-grid-view" style="border-radius: 8px; font-size: 0.8rem; padding: 0.4rem 0.6rem;" title="Tampilan Grid">
                <i class="fas fa-th-large"></i>
            </button>
            <button class="btn btn-sm border-0" id="btn-list-view" style="border-radius: 8px; font-size: 0.8rem; padding: 0.4rem 0.6rem;" title="Tampilan List (Hemat Ruang)">
                <i class="fas fa-list"></i>
            </button>
        </div>
    </div>
</div>

<div class="row" id="catalog-row">
    <?php if(empty($alat)): ?>
        <div class="col-12 text-center py-5">
            <div class="mb-3 d-inline-flex align-items-center justify-content-center" style="width: 80px; height: 80px; border-radius: 50%; background-color: #f1f5f9; color: #94a3b8;">
                <i class="fas fa-box-open fa-3x"></i>
            </div>
            <h5 class="text-secondary fw-bold">Tidak Ada Alat Tersedia</h5>
            <p class="text-muted small">Saat ini tidak ada alat yang tersedia untuk dipinjam.</p>
        </div>
    <?php else: ?>
        <?php foreach($alat as $a): ?>
        <div class="col-sm-6 col-md-4 col-lg-3 mb-4 alat-item-col" data-nama="<?= htmlspecialchars($a['nama_alat']) ?>" data-kategori="<?= htmlspecialchars($a['nama_kategori']) ?>">
            <div class="card h-100 border-0 alat-card">
                <div class="card-img-wrapper">
                    <span class="badge-category"><?= $a['nama_kategori'] ?></span>
                    <img src="<?= base_url('assets/img/'.$a['foto_alat']) ?>" alt="<?= $a['nama_alat'] ?>">
                </div>
                <div class="card-body p-4">
                    <div class="alat-body-content">
                        <div class="alat-title-wrapper">
                            <h5 class="fw-bold text-dark mb-2" style="font-size: 1rem; line-height: 1.4; min-height: 2.8em; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;">
                                <?= $a['nama_alat'] ?>
                            </h5>
                        </div>
                        <div class="alat-info-wrapper">
                            <div class="d-flex align-items-center justify-content-between gap-3">
                                <span class="text-secondary small fw-semibold">Stok Tersedia</span>
                                <span class="fw-bold text-dark" style="font-size: 0.85rem;"><?= $a['stok'] ?> unit</span>
                            </div>
                            <div class="d-flex align-items-center justify-content-between gap-3">
                                <span class="text-secondary small fw-semibold">Kondisi Alat</span>
                                <?php if($a['kondisi'] == 'Baik'): ?>
                                    <span class="badge badge-soft badge-soft-success"><i class="fas fa-check-circle"></i> Baik</span>
                                <?php elseif($a['kondisi'] == 'Rusak Ringan'): ?>
                                    <span class="badge badge-soft badge-soft-warning"><i class="fas fa-exclamation-triangle"></i> Rusak Ringan</span>
                                <?php else: ?>
                                    <span class="badge badge-soft badge-soft-danger"><i class="fas fa-times-circle"></i> Rusak Berat</span>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    
                    <button class="btn btn-pinjam-premium w-100 pinjam-btn d-flex align-items-center justify-content-center gap-2 mt-2" 
                        data-id="<?= $a['id'] ?>" 
                        data-nama="<?= $a['nama_alat'] ?>" 
                        data-stok="<?= $a['stok'] ?>" 
                        data-bs-toggle="modal" data-bs-target="#pinjamModal">
                        <i class="fas fa-hand-holding"></i> Ajukan Pinjam
                    </button>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>

<!-- Modal Pinjam -->
<div class="modal fade" id="pinjamModal" tabindex="-1">
    <div class="modal-dialog">
        <form action="<?= base_url('peminjam/ajukan') ?>" method="post">
            <div class="modal-content" style="border-radius: 14px; overflow: hidden; border: none;">
                <div class="modal-header bg-light border-0 py-3">
                    <h5 class="modal-title fw-bold text-dark"><i class="fas fa-hand-holding-heart text-primary me-2"></i> Form Pengajuan Pinjam</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body py-4">
                    <input type="hidden" name="alat_id" id="pinjam-id">
                    
                    <div class="mb-3">
                        <label class="form-label fw-semibold text-secondary small">Nama Alat</label>
                        <input type="text" id="pinjam-nama" class="form-control py-2 bg-light border-0 fw-bold text-dark" readonly>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold text-secondary small">Jumlah Pinjam</label>
                            <div class="input-group">
                                <input type="number" name="jumlah" id="pinjam-jumlah" class="form-control py-2" style="border-radius: 8px 0 0 8px;" min="1" value="1" required>
                                <span class="input-group-text bg-light border-start-0 small fw-semibold text-muted" id="max-stok-text" style="border-radius: 0 8px 8px 0; font-size: 0.75rem;"></span>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold text-secondary small">Tgl Rencana Kembali <span class="text-danger">*</span></label>
                            <input type="date" name="tanggal_kembali_rencana" class="form-control py-2" style="border-radius: 8px;" required min="<?= date('Y-m-d') ?>">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold text-secondary small">Tujuan / Keperluan Pinjam <span class="text-danger">*</span></label>
                        <textarea name="keterangan" class="form-control py-2" style="border-radius: 8px;" rows="2" required placeholder="Jelaskan keperluan peminjaman alat secara detail..."></textarea>
                    </div>
                </div>
                <div class="modal-footer bg-light border-0 py-3">
                    <button type="button" class="btn btn-secondary px-3 py-2" style="border-radius: 8px;" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary px-3 py-2" style="border-radius: 8px;">Kirim Pengajuan</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script src="<?= base_url('assets/js/peminjam-alat-list.js') ?>"></script>
