<div class="card card-modern">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover datatable w-100">
                <thead>
                    <tr>
                        <th>ID Transaksi</th>
                        <th>Anggota</th>
                        <th>Buku</th>
                        <th>Tgl Pinjam</th>
                        <th>Batas Kembali</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($peminjaman as $p): ?>
                    <tr>
                        <td>#<?= sprintf('%04d', $p->id_pinjam) ?></td>
                        <td>
                            <div class="d-flex align-items-center">
                                <i class="fas fa-user-circle text-muted fs-4 me-2"></i>
                                <strong><?= $p->nama_anggota ?></strong>
                            </div>
                        </td>
                        <td>
                            <div class="d-flex align-items-center">
                                <img src="<?= base_url('assets/img/buku/' . (!empty($p->cover) ? $p->cover : 'default_book.jpg')) ?>" class="rounded me-2" width="30" height="40" style="object-fit:cover;">
                                <span class="text-truncate" style="max-width: 150px; display:inline-block;" title="<?= $p->judul_buku ?>"><?= $p->judul_buku ?></span>
                            </div>
                        </td>
                        <td><?= date('d/m/Y', strtotime($p->tanggal_pinjam)) ?></td>
                        <td>
                            <?php 
                            $batas = strtotime($p->batas_kembali);
                            $sekarang = strtotime(date('Y-m-d'));
                            $is_late = ($sekarang > $batas && $p->status != 'Dikembalikan');
                            ?>
                            <span class="<?= $is_late ? 'text-danger fw-bold' : '' ?>">
                                <?= date('d/m/Y', $batas) ?>
                                <?php if($is_late) echo ' <i class="fas fa-exclamation-circle" title="Terlambat"></i>'; ?>
                            </span>
                        </td>
                        <td>
                            <?php if($p->status == 'Dipinjam'): ?>
                                <span class="badge bg-primary">Dipinjam</span>
                            <?php elseif($p->status == 'Menunggu Verifikasi'): ?>
                                <span class="badge bg-warning text-dark"><i class="fas fa-clock me-1"></i>Menunggu Verifikasi</span>
                            <?php else: ?>
                                <span class="badge bg-success">Dikembalikan</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <?php if($p->status == 'Menunggu Verifikasi'): ?>
                                <button class="btn btn-sm btn-success" onclick="verifikasiPengembalian(<?= $p->id_pinjam ?>)" title="Verifikasi Pengembalian"><i class="fas fa-check-double"></i> Verifikasi</button>
                            <?php else: ?>
                                <button class="btn btn-sm btn-secondary" disabled title="Tidak ada aksi"><i class="fas fa-minus"></i></button>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    window.AppConfig = {
        baseUrl: '<?= base_url() ?>'
    };
</script>
<script src="<?= base_url('assets/js/admin_peminjaman.js') ?>"></script>
