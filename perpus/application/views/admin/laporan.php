<div class="card card-modern">
    <div class="card-body">
        <div class="d-flex flex-column flex-sm-row justify-content-between align-items-start align-items-sm-center gap-3 mb-4">
            <h5 class="fw-bold mb-0">Laporan Seluruh Transaksi Peminjaman</h5>
            <button class="btn btn-outline-primary w-100 w-sm-auto" onclick="window.print()">
                <i class="fas fa-print me-2"></i>Cetak Laporan
            </button>
        </div>

        <div class="table-responsive" id="printArea">
            <table class="table table-bordered datatable w-100">
                <thead class="table-light">
                    <tr>
                        <th>No</th>
                        <th>ID Transaksi</th>
                        <th>Anggota</th>
                        <th>Buku</th>
                        <th>Tgl Pinjam</th>
                        <th>Batas Kembali</th>
                        <th>Tgl Dikembalikan</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no=1; foreach($peminjaman as $p): ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td>#<?= sprintf('%04d', $p->id_pinjam) ?></td>
                        <td><?= $p->nama_anggota ?></td>
                        <td><?= $p->judul_buku ?></td>
                        <td><?= date('d/m/Y', strtotime($p->tanggal_pinjam)) ?></td>
                        <td><?= date('d/m/Y', strtotime($p->batas_kembali)) ?></td>
                        <td><?= $p->tanggal_pengembalian ? date('d/m/Y', strtotime($p->tanggal_pengembalian)) : '-' ?></td>
                        <td><?= $p->status ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<style>
@media print {
    body * {
        visibility: hidden;
    }
    #printArea, #printArea * {
        visibility: visible;
    }
    #printArea {
        position: absolute;
        left: 0;
        top: 0;
        width: 100%;
    }
    .btn, .dataTables_filter, .dataTables_length, .dataTables_info, .dataTables_paginate {
        display: none !important;
    }
    .card {
        border: none !important;
        box-shadow: none !important;
    }
}
</style>
