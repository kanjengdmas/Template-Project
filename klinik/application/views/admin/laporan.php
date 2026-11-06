<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Laporan Pemeriksaan</h1>
    <a href="<?= base_url('admin/laporan_print') ?>" target="_blank" class="btn btn-primary shadow-sm"><i class="fas fa-print fa-sm text-white-50"></i> Cetak Laporan</a>
</div>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Nama Pasien</th>
                        <th>Keluhan</th>
                        <th>Dokter</th>
                        <th>Diagnosis</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; foreach ($pemeriksaan as $p): ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= date('d M Y', strtotime($p->tanggal)) ?></td>
                        <td><?= $p->nama_pasien ?></td>
                        <td><?= $p->keluhan ?></td>
                        <td><?= $p->nama_dokter ? $p->nama_dokter : '-' ?></td>
                        <td><?= $p->diagnosis ? $p->diagnosis : '-' ?></td>
                        <td>
                            <?php 
                                if($p->status == 'Menunggu') echo '<span class="badge badge-warning">Menunggu</span>';
                                elseif($p->status == 'Diproses') echo '<span class="badge badge-primary">Diproses</span>';
                                elseif($p->status == 'Selesai') echo '<span class="badge badge-success">Selesai</span>';
                                elseif($p->status == 'Ditolak') echo '<span class="badge badge-danger">Ditolak</span>';
                            ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
