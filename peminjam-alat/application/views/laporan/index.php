<link rel="stylesheet" href="<?= base_url('assets/css/laporan.css') ?>">

<div class="row justify-content-center">
    <div class="col-md-8 col-lg-7">
        <div class="card border-0 report-card mb-4">
            <div class="card-header report-header py-4 d-flex align-items-center">
                <div class="me-3" style="width: 44px; height: 44px; border-radius: 10px; background-color: rgba(255, 255, 255, 0.2); display: flex; align-items: center; justify-content: center; font-size: 1.25rem;">
                    <i class="fas fa-print"></i>
                </div>
                <div>
                    <h5 class="m-0 fw-bold">Cetak Laporan Sipanja</h5>
                    <p class="text-white-50 small m-0 mt-1" style="font-size: 0.75rem;">Generate laporan peminjaman, pengembalian, denda, dan alat</p>
                </div>
            </div>
            <div class="card-body report-body">
                <form action="<?= base_url('laporan/cetak') ?>" method="post" target="_blank">
                    
                    <!-- Jenis Laporan -->
                    <div class="mb-4">
                        <label class="form-label-custom">Jenis Laporan <span class="text-danger">*</span></label>
                        <select name="jenis_laporan" id="jenis_laporan" class="form-select form-control-premium w-100" required>
                            <option value="">- Pilih Jenis Laporan -</option>
                            <option value="peminjaman">Laporan Peminjaman</option>
                            <option value="pengembalian">Laporan Pengembalian</option>
                            <option value="denda">Laporan Denda</option>
                            <option value="alat">Laporan Data Alat</option>
                        </select>
                    </div>

                    <!-- Filter Tanggal -->
                    <div class="row g-3 mb-4" id="filter-tanggal">
                        <div class="col-md-6">
                            <label class="form-label-custom">Dari Tanggal</label>
                            <input type="date" name="tgl_awal" class="form-control form-control-premium w-100">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label-custom">Sampai Tanggal</label>
                            <input type="date" name="tgl_akhir" class="form-control form-control-premium w-100">
                        </div>
                    </div>

                    <!-- Format Cetak -->
                    <div class="mb-4">
                        <label class="form-label-custom">Format Cetak <span class="text-danger">*</span></label>
                        <select name="format" class="form-select form-control-premium w-100" required>
                            <option value="print">Print / PDF</option>
                            <option value="excel">Export Excel</option>
                        </select>
                    </div>

                    <!-- Info Box -->
                    <div class="info-badge-premium mb-4">
                        <i class="fas fa-info-circle fs-5 mt-0.5"></i>
                        <div>
                            <strong>Catatan Penggunaan:</strong><br>
                            <span class="text-muted" style="font-size: 0.8rem; line-height: 1.4;">
                                Laporan Data Alat tidak memerlukan filter rentang tanggal dan akan mencetak seluruh data inventaris saat ini.
                            </span>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="btn btn-generate btn-primary w-100 fw-bold d-flex align-items-center justify-content-center gap-2">
                        <i class="fas fa-print"></i> Generate Laporan
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="<?= base_url('assets/js/laporan.js') ?>"></script>
