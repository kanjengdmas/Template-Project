<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Antrean Pemeriksaan Pasien</h1>
</div>

<?php if(empty($pemeriksaan)): ?>
<div class="alert alert-success">
    <i class="fas fa-check-circle mr-2"></i> Tidak ada antrean pasien saat ini.
</div>
<?php else: ?>
<div class="card shadow mb-4">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Tanggal Masuk</th>
                        <th>Nama Pasien</th>
                        <th>Umur / JK</th>
                        <th>Keluhan Singkat</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; foreach ($pemeriksaan as $p): ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= date('d M Y', strtotime($p->tanggal)) ?></td>
                        <td><?= $p->nama_pasien ?></td>
                        <td><?= $p->umur ?> thn / <?= $p->jenis_kelamin ?></td>
                        <td><?= strlen($p->keluhan) > 50 ? substr($p->keluhan, 0, 50).'...' : $p->keluhan ?></td>
                        <td>
                            <a href="<?= base_url('dokter/periksa/'.$p->id) ?>" class="btn btn-primary btn-sm"><i class="fas fa-stethoscope"></i> Mulai Periksa</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php endif; ?>
