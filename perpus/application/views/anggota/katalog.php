<div class="row mb-4">
    <div class="col-12">
        <div class="card card-modern">
            <div class="card-body">
                <form id="filterForm" class="row g-3 align-items-end">
                    <div class="col-md-5">
                        <label class="form-label">Cari Judul Buku</label>
                        <input type="text" class="form-control" id="searchInput" placeholder="Ketik judul buku...">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Kategori</label>
                        <select class="form-select" id="kategoriSelect">
                            <option value="all">Semua Kategori</option>
                            <?php foreach($kategori as $k): ?>
                                <option value="<?= $k->id_kategori ?>"><?= $k->nama_kategori ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <button type="button" class="btn btn-primary-custom w-100" id="btnFilter">Terapkan Filter</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="row g-4" id="katalogContainer">
    <?php foreach($buku as $b): ?>
    <div class="col-md-4 col-lg-3 col-6 buku-item" data-kategori="<?= $b->id_kategori ?>" data-judul="<?= strtolower($b->judul) ?>">
        <div class="card card-modern h-100 position-relative">
            <?php if($b->stok <= 0): ?>
                <div class="position-absolute top-0 end-0 bg-danger text-white px-2 py-1 m-2 rounded-2 small fw-bold" style="z-index:10;">Habis</div>
            <?php endif; ?>
            <img src="<?= base_url('assets/img/buku/' . (!empty($b->cover) ? $b->cover : 'default_book.jpg')) ?>" class="card-img-top" alt="<?= $b->judul ?>" style="height: 250px; object-fit: cover;">
            <div class="card-body d-flex flex-column">
                <span class="badge bg-secondary mb-2 align-self-start"><?= $b->nama_kategori ?></span>
                <h6 class="card-title fw-bold text-truncate" title="<?= $b->judul ?>"><?= $b->judul ?></h6>
                <p class="card-text text-muted small mb-3"><?= $b->penulis ?></p>
                <div class="mt-auto">
                    <button class="btn btn-sm btn-outline-info w-100 mb-2" onclick="detailBuku(<?= $b->id_buku ?>)">Detail</button>
                    <button class="btn btn-sm btn-primary-custom w-100" <?= ($b->stok <= 0) ? 'disabled' : '' ?> onclick="pinjamBuku(<?= $b->id_buku ?>, '<?= addslashes($b->judul) ?>')">
                        Pinjam (<?= $b->stok ?>)
                    </button>
                </div>
            </div>
        </div>
    </div>
    <?php endforeach; ?>
    <div class="col-12 text-center text-muted d-none" id="noData">
        <i class="fas fa-search fs-1 mb-3"></i>
        <h5>Buku tidak ditemukan</h5>
    </div>
</div>

<!-- Modal Detail -->
<div class="modal fade" id="modalDetail" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-light">
                <h5 class="modal-title fw-bold">Detail Buku</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body text-center" id="detailContent">
                <!-- Content loaded via AJAX -->
            </div>
        </div>
    </div>
</div>

<script>
    window.AppConfig = {
        baseUrl: '<?= base_url() ?>'
    };
</script>
<script src="<?= base_url('assets/js/katalog.js') ?>"></script>
