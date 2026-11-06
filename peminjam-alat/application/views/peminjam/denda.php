<link rel="stylesheet" href="<?= base_url('assets/css/peminjam-denda.css') ?>">

<div class="card border-0 table-container mb-4">
    <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center border-0 mt-2">
        <div>
            <h5 class="m-0 fw-bold text-dark">Data Denda Saya</h5>
            <p class="text-muted small m-0 mt-1">Daftar denda keterlambatan atau kerusakan alat yang dibebankan kepada Anda</p>
        </div>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-custom datatable">
                <thead>
                    <tr>
                        <th width="5%" class="text-center">No</th>
                        <th>Nomor Denda</th>
                        <th>Kode Peminjaman</th>
                        <th>Nama Alat</th>
                        <th>Kerusakan</th>
                        <th>Nominal</th>
                        <th>Status Pembayaran</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; foreach ($denda as $d) : ?>
                    <tr>
                        <td class="text-center fw-semibold text-muted"><?= $no++ ?></td>
                        <td><span class="badge badge-soft badge-soft-danger"><?= $d['nomor_denda'] ?></span></td>
                        <td><span class="badge badge-soft badge-soft-secondary"><?= $d['kode_peminjaman'] ?></span></td>
                        <td class="fw-semibold text-dark"><?= $d['nama_alat'] ?></td>
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
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        
        <div class="p-4 bg-white border-top">
            <div class="info-badge-premium">
                <i class="fas fa-info-circle fs-5 mt-0.5"></i>
                <div>
                    <strong>Instruksi Pembayaran:</strong><br>
                    <span class="text-muted" style="font-size: 0.8rem; line-height: 1.4;">
                        Untuk melakukan pelunasan denda, silakan temui Petugas atau Admin secara langsung di ruang inventaris/gudang penyimpanan.
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>
