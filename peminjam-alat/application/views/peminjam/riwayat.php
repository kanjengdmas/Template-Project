<link rel="stylesheet" href="<?= base_url('assets/css/peminjam-riwayat.css') ?>">

<div class="card border-0 table-container mb-4">
    <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center border-0 mt-2">
        <div>
            <h5 class="m-0 fw-bold text-dark">Riwayat Peminjaman Saya</h5>
            <p class="text-muted small m-0 mt-1">Daftar riwayat dan status pengajuan alat yang telah Anda lakukan</p>
        </div>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-custom datatable">
                <thead>
                    <tr>
                        <th width="5%" class="text-center">No</th>
                        <th>Kode Peminjaman</th>
                        <th>Nama Alat</th>
                        <th class="text-center">Jumlah</th>
                        <th>Tgl Pengajuan</th>
                        <th>Rencana Kembali</th>
                        <th>Status</th>
                        <th width="10%" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; foreach ($riwayat as $r) : ?>
                    <tr>
                        <td class="text-center fw-semibold text-muted"><?= $no++ ?></td>
                        <td><span class="badge badge-soft badge-soft-secondary"><?= $r['kode_peminjaman'] ?></span></td>
                        <td class="fw-semibold text-dark"><?= $r['nama_alat'] ?></td>
                        <td class="text-center fw-bold"><?= $r['jumlah'] ?></td>
                        <td><span class="text-secondary" style="font-size: 0.8rem;"><?= date('d/m/Y', strtotime($r['tanggal_pengajuan'])) ?></span></td>
                        <td><span class="text-secondary" style="font-size: 0.8rem;"><?= date('d/m/Y', strtotime($r['tanggal_kembali_rencana'])) ?></span></td>
                        <td>
                            <?php if($r['status'] == 'Menunggu Persetujuan'): ?>
                                <span class="badge badge-soft badge-soft-warning"><i class="fas fa-clock"></i> Menunggu</span>
                            <?php elseif($r['status'] == 'Disetujui'): ?>
                                <span class="badge badge-soft badge-soft-info"><i class="fas fa-check"></i> Disetujui</span>
                            <?php elseif($r['status'] == 'Ditolak'): ?>
                                <span class="badge badge-soft badge-soft-danger"><i class="fas fa-times"></i> Ditolak</span>
                            <?php elseif($r['status'] == 'Dipinjam'): ?>
                                <span class="badge badge-soft badge-soft-primary"><i class="fas fa-dolly"></i> Dipinjam</span>
                            <?php else: ?>
                                <span class="badge badge-soft badge-soft-success"><i class="fas fa-check-double"></i> Selesai</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <div class="d-flex justify-content-center">
                                <?php if($r['status'] == 'Menunggu Persetujuan'): ?>
                                    <a href="<?= base_url('peminjam/batalkan/'.$r['id']) ?>" class="btn-action btn-action-delete btn-batal" title="Batalkan Pengajuan">
                                        <i class="fas fa-times"></i>
                                    </a>
                                <?php else: ?>
                                    <span class="text-muted small">-</span>
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
<script src="<?= base_url('assets/js/peminjam-riwayat.js') ?>"></script>
