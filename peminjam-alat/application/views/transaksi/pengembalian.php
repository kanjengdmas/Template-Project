<link rel="stylesheet" href="<?= base_url('assets/css/transaksi-pengembalian.css') ?>">

<div class="card border-0 table-container mb-4">
    <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center border-0 mt-2">
        <div>
            <h5 class="m-0 fw-bold text-dark">Data Pengembalian Alat</h5>
            <p class="text-muted small m-0 mt-1">Kelola dan proses pengembalian alat peminjaman aktif</p>
        </div>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-custom datatable">
                <thead>
                    <tr>
                        <th width="5%" class="text-center">No</th>
                        <th>Kode</th>
                        <th>Peminjam</th>
                        <th>Alat</th>
                        <th class="text-center">Jml</th>
                        <th>Tgl Pinjam</th>
                        <th>Tgl Kembali Rencana</th>
                        <th>Status</th>
                        <th width="15%" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; foreach ($peminjaman as $p) : ?>
                    <tr>
                        <td class="text-center fw-semibold text-muted"><?= $no++ ?></td>
                        <td><span class="badge badge-soft badge-soft-secondary"><?= $p['kode_peminjaman'] ?></span></td>
                        <td class="fw-semibold text-dark"><?= $p['nama_peminjam'] ?></td>
                        <td class="fw-medium text-dark"><?= $p['nama_alat'] ?></td>
                        <td class="text-center fw-bold"><?= $p['jumlah'] ?></td>
                        <td><span class="text-secondary" style="font-size: 0.8rem;"><?= $p['tanggal_pinjam'] ? date('d/m/Y', strtotime($p['tanggal_pinjam'])) : '-' ?></span></td>
                        <td><span class="text-secondary" style="font-size: 0.8rem;"><?= date('d/m/Y', strtotime($p['tanggal_kembali_rencana'])) ?></span></td>
                        <td>
                            <?php if($p['status'] == 'Dipinjam'): ?>
                                <span class="badge badge-soft badge-soft-primary"><i class="fas fa-dolly"></i> Dipinjam</span>
                            <?php else: ?>
                                <span class="badge badge-soft badge-soft-success"><i class="fas fa-check-double"></i> Selesai</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <div class="d-flex justify-content-center gap-1">
                                <!-- Tombol Detail untuk semua role -->
                                <button class="btn btn-outline-primary btn-sm d-flex align-items-center gap-1 detail-kembali-btn" 
                                    style="border-radius: 8px; font-size: 0.8rem; padding: 0.4rem 0.8rem;"
                                    data-kode="<?= $p['kode_peminjaman'] ?>"
                                    data-nama="<?= $p['nama_peminjam'] ?>"
                                    data-alat="<?= $p['nama_alat'] ?>"
                                    data-jumlah="<?= $p['jumlah'] ?>"
                                    data-tgl-pinjam="<?= $p['tanggal_pinjam'] ? date('d/m/Y H:i', strtotime($p['tanggal_pinjam'])) : '-' ?>"
                                    data-tgl-kembali-rencana="<?= date('d/m/Y', strtotime($p['tanggal_kembali_rencana'])) ?>"
                                    data-status="<?= $p['status'] ?>"
                                    data-keterangan="<?= htmlspecialchars($p['keterangan'] ?? '') ?>"
                                    data-tgl-dikembalikan="<?= $p['tanggal_dikembalikan'] ? date('d/m/Y H:i', strtotime($p['tanggal_dikembalikan'])) : '-' ?>"
                                    data-kondisi-kembali="<?= $p['kondisi_alat_kembali'] ?? '-' ?>"
                                    data-catatan-kembali="<?= htmlspecialchars($p['catatan'] ?? '') ?>"
                                    data-denda="<?= $p['nominal_denda'] ? 'Rp ' . number_format($p['nominal_denda'], 0, ',', '.') . ' (' . $p['status_pembayaran'] . ')' : '-' ?>"
                                    data-bs-toggle="modal" data-bs-target="#detailKembaliModal"
                                    title="Detail Transaksi">
                                    <i class="fas fa-info-circle"></i> Detail
                                </button>

                                <!-- Tombol Terima Kembali hanya untuk Petugas -->
                                <?php if ($this->session->userdata('role') != 'Admin'): ?>
                                    <?php if($p['status'] == 'Dipinjam'): ?>
                                        <button class="btn btn-success btn-sm kembali-btn d-flex align-items-center gap-1 fw-bold shadow-sm" 
                                            style="border-radius: 8px; font-size: 0.8rem; padding: 0.4rem 0.8rem;"
                                            data-id="<?= $p['id'] ?>"
                                            data-alat-id="<?= $p['alat_id'] ?>"
                                            data-jumlah="<?= $p['jumlah'] ?>"
                                            data-kode="<?= $p['kode_peminjaman'] ?>"
                                            data-nama="<?= $p['nama_peminjam'] ?>"
                                            data-alat="<?= $p['nama_alat'] ?>"
                                            data-bs-toggle="modal" data-bs-target="#kembaliModal">
                                            <i class="fas fa-undo"></i> Terima
                                        </button>
                                    <?php else: ?>
                                        <span class="badge badge-soft badge-soft-success fw-bold d-flex align-items-center"><i class="fas fa-check-circle me-1"></i> Selesai</span>
                                    <?php endif; ?>
                                <?php endif; ?>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Terima Kembali -->
<div class="modal fade" id="kembaliModal" tabindex="-1">
    <div class="modal-dialog">
        <form action="<?= base_url('transaksi/proses_kembali') ?>" method="post">
            <div class="modal-content" style="border-radius: 14px; overflow: hidden; border: none;">
                <div class="modal-header bg-light border-0 py-3">
                    <h5 class="modal-title fw-bold text-dark"><i class="fas fa-undo text-success me-2"></i> Form Pengembalian Alat</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body py-4">
                    <input type="hidden" name="peminjaman_id" id="kembali-id">
                    <input type="hidden" name="alat_id" id="kembali-alat-id">
                    <input type="hidden" name="jumlah" id="kembali-jumlah">
                    
                    <div class="mb-3">
                        <label class="form-label fw-semibold text-secondary small">Peminjam</label>
                        <input type="text" id="kembali-nama" class="form-control py-2 bg-light border-0 fw-semibold text-dark" readonly>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold text-secondary small">Alat yang Dikembalikan</label>
                        <input type="text" id="kembali-alat" class="form-control py-2 bg-light border-0 fw-semibold text-dark" readonly>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label fw-semibold text-secondary small">Kondisi Alat Kembali <span class="text-danger">*</span></label>
                        <select name="kondisi_alat_kembali" id="kondisi-select" class="form-select py-2" style="border-radius: 8px;" required>
                            <option value="Baik">Baik</option>
                            <option value="Rusak Ringan">Rusak Ringan</option>
                            <option value="Rusak Berat">Rusak Berat</option>
                            <option value="Hilang">Hilang</option>
                        </select>
                    </div>

                    <div class="mb-3 d-none" id="denda-div">
                        <label class="form-label fw-semibold text-secondary small">Nominal Denda (Rp) <span class="text-danger">*</span></label>
                        <input type="number" name="nominal_denda" id="nominal-denda" class="form-control py-2" style="border-radius: 8px;" min="0" value="0">
                        <small class="text-muted" style="font-size: 0.75rem;">Isi nominal denda sesuai kebijakan untuk alat yang rusak/hilang.</small>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold text-secondary small">Catatan (Opsional)</label>
                        <textarea name="catatan" class="form-control py-2" style="border-radius: 8px;" rows="2" placeholder="Masukkan catatan kondisi pengembalian"></textarea>
                    </div>
                </div>
                <div class="modal-footer bg-light border-0 py-3">
                    <button type="button" class="btn btn-secondary px-3 py-2" style="border-radius: 8px;" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary px-3 py-2" style="border-radius: 8px;">Proses Pengembalian</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Modal Detail Pengembalian -->
<div class="modal fade" id="detailKembaliModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content" style="border-radius: 14px; overflow: hidden; border: none;">
            <div class="modal-header bg-light border-0 py-3">
                <h5 class="modal-title fw-bold text-dark"><i class="fas fa-info-circle text-primary me-2"></i> Detail Peminjaman & Pengembalian</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body py-4">
                <div class="mb-3">
                    <label class="form-label fw-semibold text-secondary small mb-1">Kode Peminjaman</label>
                    <div id="detail-kembali-kode" class="fw-bold text-dark"></div>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-semibold text-secondary small mb-1">Peminjam</label>
                    <div id="detail-kembali-nama" class="text-dark"></div>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-semibold text-secondary small mb-1">Alat</label>
                    <div id="detail-kembali-alat" class="text-dark"></div>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-semibold text-secondary small mb-1">Jumlah</label>
                    <div id="detail-kembali-jumlah" class="text-dark"></div>
                </div>
                <div class="row">
                    <div class="col-6 mb-3">
                        <label class="form-label fw-semibold text-secondary small mb-1">Tanggal Pinjam</label>
                        <div id="detail-kembali-tgl-pinjam" class="text-dark"></div>
                    </div>
                    <div class="col-6 mb-3">
                        <label class="form-label fw-semibold text-secondary small mb-1">Kembali Rencana</label>
                        <div id="detail-kembali-tgl-rencana" class="text-dark"></div>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-semibold text-secondary small mb-1">Keterangan Peminjaman</label>
                    <div id="detail-kembali-keterangan" class="text-dark"></div>
                </div>
                <hr>
                <div class="mb-3">
                    <label class="form-label fw-semibold text-secondary small mb-1">Status</label>
                    <div id="detail-kembali-status" class="text-dark"></div>
                </div>
                <div id="detail-kembali-selesai-info" class="d-none">
                    <div class="mb-3">
                        <label class="form-label fw-semibold text-secondary small mb-1">Tanggal Dikembalikan</label>
                        <div id="detail-kembali-tgl-dikembalikan" class="text-dark"></div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold text-secondary small mb-1">Kondisi Alat Saat Kembali</label>
                        <div id="detail-kembali-kondisi" class="text-dark"></div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold text-secondary small mb-1">Catatan Pengembalian</label>
                        <div id="detail-kembali-catatan" class="text-dark text-break"></div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold text-secondary small mb-1">Denda</label>
                        <div id="detail-kembali-denda" class="text-dark"></div>
                    </div>
                </div>
            </div>
            <div class="modal-footer bg-light border-0 py-3">
                <button type="button" class="btn btn-secondary px-4 py-2" style="border-radius: 8px;" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<script src="<?= base_url('assets/js/transaksi-pengembalian.js') ?>"></script>
