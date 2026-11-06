<link rel="stylesheet" href="<?= base_url('assets/css/denda.css') ?>">

<div class="card border-0 table-container mb-4">
    <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center border-0 mt-2">
        <div>
            <h5 class="m-0 fw-bold text-dark">Daftar Denda</h5>
            <p class="text-muted small m-0 mt-1">Pantau dan verifikasi pembayaran denda keterlambatan / kerusakan alat</p>
        </div>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-custom datatable">
                <thead>
                    <tr>
                        <th width="5%" class="text-center">No</th>
                        <th>Nomor Denda</th>
                        <th>Peminjam</th>
                        <th>Alat</th>
                        <th>Kerusakan</th>
                        <th>Nominal</th>
                        <th>Status</th>
                        <th width="12%" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; foreach ($denda as $d) : ?>
                    <tr>
                        <td class="text-center fw-semibold text-muted"><?= $no++ ?></td>
                        <td><span class="badge badge-soft badge-soft-danger"><?= $d['nomor_denda'] ?></span></td>
                        <td>
                            <div class="fw-semibold text-dark"><?= $d['nama_peminjam'] ?></div>
                            <div class="text-muted small" style="font-size: 0.75rem;"><?= $d['kode_peminjaman'] ?></div>
                        </td>
                        <td class="fw-medium text-dark"><?= $d['nama_alat'] ?></td>
                        <td>
                            <?php if(!empty($d['jenis_kerusakan'])): ?>
                                <span class="text-slate-700"><?= $d['jenis_kerusakan'] ?></span>
                            <?php else: ?>
                                <span class="text-muted small">Keterlambatan</span>
                            <?php endif; ?>
                        </td>
                        <td class="fw-bold text-dark">Rp <?= number_format($d['nominal_denda'], 0, ',', '.') ?></td>
                        <td>
                            <?php if($d['status_pembayaran'] == 'Belum Dibayar'): ?>
                                <span class="badge badge-soft badge-soft-warning"><i class="fas fa-clock"></i> Belum Dibayar</span>
                            <?php else: ?>
                                <span class="badge badge-soft badge-soft-success"><i class="fas fa-check-circle"></i> Sudah Dibayar</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <div class="d-flex justify-content-center">
                                <?php if($d['status_pembayaran'] == 'Belum Dibayar'): ?>
                                    <a href="<?= base_url('denda/bayar/'.$d['id']) ?>" class="btn btn-success btn-sm btn-bayar d-flex align-items-center gap-1 fw-bold shadow-sm" style="border-radius: 8px; font-size: 0.8rem; padding: 0.4rem 0.8rem;" title="Verifikasi Pembayaran">
                                        <i class="fas fa-check"></i> Bayar
                                    </a>
                                <?php else: ?>
                                    <span class="badge badge-soft badge-soft-success fw-bold text-center" style="font-size: 0.8rem;"><i class="fas fa-check"></i> Selesai</span>
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

<script src="<?= base_url('assets/js/denda.js') ?>"></script>
