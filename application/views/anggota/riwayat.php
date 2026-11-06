<div class="card card-modern">
    <div class="card-body">
        <h5 class="fw-bold mb-4">Riwayat Seluruh Peminjaman</h5>
        <div class="table-responsive">
            <table class="table table-hover datatable w-100">
                <thead>
                    <tr>
                        <th>ID Transaksi</th>
                        <th>Buku</th>
                        <th>Tanggal Pinjam</th>
                        <th>Batas Kembali</th>
                        <th>Tgl Dikembalikan</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($riwayat as $r): ?>
                    <tr>
                        <td>#<?= sprintf('%04d', $r->id_pinjam) ?></td>
                        <td>
                            <div class="d-flex align-items-center">
                                <img src="<?= base_url('assets/img/buku/' . (!empty($r->cover) ? $r->cover : 'default_book.jpg')) ?>" class="rounded me-2" width="30" height="40" style="object-fit:cover;">
                                <div>
                                    <strong><?= $r->judul_buku ?></strong><br>
                                    <small class="text-muted"><?= $r->penulis ?></small>
                                </div>
                            </div>
                        </td>
                        <td><?= date('d/m/Y', strtotime($r->tanggal_pinjam)) ?></td>
                        <td><?= date('d/m/Y', strtotime($r->batas_kembali)) ?></td>
                        <td><?= $r->tanggal_pengembalian ? date('d/m/Y', strtotime($r->tanggal_pengembalian)) : '-' ?></td>
                        <td>
                            <?php if($r->status == 'Dipinjam'): ?>
                                <span class="badge bg-primary">Dipinjam</span>
                            <?php elseif($r->status == 'Menunggu Verifikasi'): ?>
                                <span class="badge bg-warning text-dark"><i class="fas fa-clock me-1"></i>Menunggu</span>
                            <?php else: ?>
                                <span class="badge bg-success">Dikembalikan</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
