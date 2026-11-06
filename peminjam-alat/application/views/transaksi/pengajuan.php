<link rel="stylesheet" href="<?= base_url('assets/css/transaksi-pengajuan.css') ?>">

<div class="card border-0 table-container mb-4">
    <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center border-0 mt-2">
        <div>
            <h5 class="m-0 fw-bold text-dark">Data Pengajuan Peminjaman</h5>
            <p class="text-muted small m-0 mt-1">Verifikasi dan serahkan alat untuk pengajuan peminjaman baru</p>
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
                        <th>Tgl Pengajuan</th>
                        <th>Status</th>
                        <th width="15%" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; foreach ($pengajuan as $p) : ?>
                    <tr>
                        <td class="text-center fw-semibold text-muted"><?= $no++ ?></td>
                        <td><span class="badge badge-soft badge-soft-secondary"><?= $p['kode_peminjaman'] ?></span></td>
                        <td class="fw-semibold text-dark"><?= $p['nama_peminjam'] ?></td>
                        <td class="fw-medium text-dark"><?= $p['nama_alat'] ?></td>
                        <td class="text-center fw-bold"><?= $p['jumlah'] ?></td>
                        <td><span class="text-secondary" style="font-size: 0.8rem;"><?= date('d/m/Y H:i', strtotime($p['tanggal_pengajuan'])) ?></span></td>
                        <td>
                            <?php if($p['status'] == 'Menunggu Persetujuan'): ?>
                                <span class="badge badge-soft badge-soft-warning"><i class="fas fa-clock"></i> Menunggu</span>
                            <?php elseif($p['status'] == 'Disetujui'): ?>
                                <span class="badge badge-soft badge-soft-info"><i class="fas fa-check"></i> Disetujui</span>
                            <?php elseif($p['status'] == 'Ditolak'): ?>
                                <span class="badge badge-soft badge-soft-danger"><i class="fas fa-times"></i> Ditolak</span>
                            <?php elseif($p['status'] == 'Dipinjam'): ?>
                                <span class="badge badge-soft badge-soft-primary"><i class="fas fa-dolly"></i> Dipinjam</span>
                            <?php else: ?>
                                <span class="badge badge-soft badge-soft-success"><i class="fas fa-check-double"></i> Selesai</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <div class="d-flex justify-content-center gap-1">
                                <!-- Tombol Detail untuk semua role -->
                                <button class="btn btn-outline-primary btn-sm d-flex align-items-center gap-1 detail-btn" 
                                    style="border-radius: 8px; font-size: 0.8rem; padding: 0.4rem 0.8rem;"
                                    data-kode="<?= $p['kode_peminjaman'] ?>"
                                    data-nama="<?= $p['nama_peminjam'] ?>"
                                    data-alat="<?= $p['nama_alat'] ?>"
                                    data-jumlah="<?= $p['jumlah'] ?>"
                                    data-tgl="<?= date('d/m/Y H:i', strtotime($p['tanggal_pengajuan'])) ?>"
                                    data-status="<?= $p['status'] ?>"
                                    data-keterangan="<?= htmlspecialchars($p['keterangan'] ?? '') ?>"
                                    data-bs-toggle="modal" data-bs-target="#detailPengajuanModal"
                                    title="Detail Pengajuan">
                                    <i class="fas fa-info-circle"></i> Detail
                                </button>

                                <!-- Tombol Aksi Verifikasi hanya untuk Petugas -->
                                <?php if ($this->session->userdata('role') != 'Admin'): ?>
                                    <?php if($p['status'] == 'Menunggu Persetujuan'): ?>
                                        <a href="<?= base_url('transaksi/proses_pengajuan/'.$p['id'].'/Disetujui') ?>" class="btn-action-icon btn-action-approve btn-action" title="Setujui Pengajuan">
                                            <i class="fas fa-check"></i>
                                        </a>
                                        <a href="<?= base_url('transaksi/proses_pengajuan/'.$p['id'].'/Ditolak') ?>" class="btn-action-icon btn-action-reject btn-action" title="Tolak Pengajuan">
                                            <i class="fas fa-times"></i>
                                        </a>
                                    <?php elseif($p['status'] == 'Disetujui'): ?>
                                        <a href="<?= base_url('transaksi/proses_pengajuan/'.$p['id'].'/Dipinjam') ?>" class="btn btn-primary btn-sm btn-action d-flex align-items-center gap-1 fw-bold shadow-sm" style="border-radius: 8px; font-size: 0.8rem; padding: 0.4rem 0.8rem;" title="Serahkan Alat">
                                            <i class="fas fa-box"></i> Serahkan
                                        </a>
                                    <?php else: ?>
                                        <span class="text-muted small d-flex align-items-center"><i class="fas fa-check-circle text-success me-1"></i> Selesai</span>
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

<!-- Modal Detail Pengajuan -->
<div class="modal fade" id="detailPengajuanModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content" style="border-radius: 14px; overflow: hidden; border: none;">
            <div class="modal-header bg-light border-0 py-3">
                <h5 class="modal-title fw-bold text-dark"><i class="fas fa-info-circle text-primary me-2"></i> Detail Pengajuan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body py-4">
                <div class="mb-3">
                    <label class="form-label fw-semibold text-secondary small mb-1">Kode Peminjaman</label>
                    <div id="detail-kode" class="fw-bold text-dark"></div>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-semibold text-secondary small mb-1">Peminjam</label>
                    <div id="detail-nama" class="text-dark"></div>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-semibold text-secondary small mb-1">Alat yang Diajukan</label>
                    <div id="detail-alat" class="text-dark"></div>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-semibold text-secondary small mb-1">Jumlah</label>
                    <div id="detail-jumlah" class="text-dark"></div>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-semibold text-secondary small mb-1">Tanggal Pengajuan</label>
                    <div id="detail-tgl" class="text-dark"></div>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-semibold text-secondary small mb-1">Status</label>
                    <div id="detail-status" class="text-dark"></div>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-semibold text-secondary small mb-1">Keterangan</label>
                    <div id="detail-keterangan" class="text-dark"></div>
                </div>
            </div>
            <div class="modal-footer bg-light border-0 py-3">
                <button type="button" class="btn btn-secondary px-4 py-2" style="border-radius: 8px;" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<script src="<?= base_url('assets/js/transaksi-pengajuan.js') ?>"></script>
