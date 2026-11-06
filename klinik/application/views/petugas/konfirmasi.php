<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Konfirmasi Pemeriksaan</h1>
</div>

<?php if(empty($pemeriksaan)): ?>
<div class="alert alert-success">
    <i class="fas fa-check-circle mr-2"></i> Tidak ada pemeriksaan baru yang menunggu konfirmasi.
</div>
<?php else: ?>
<div class="row">
    <?php foreach ($pemeriksaan as $p): ?>
    <div class="col-lg-6 mb-4">
        <div class="card shadow">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Pemeriksaan #<?= sprintf('%03d', $p->id) ?></h6>
                <span class="badge badge-warning">Menunggu Konfirmasi</span>
            </div>
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-sm-5 font-weight-bold">Tujuan Pemeriksaan:</div>
                    <div class="col-sm-7"><span class="badge badge-info"><?= $p->nama_dokter ?> - <?= $p->spesialis ?></span></div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-5 font-weight-bold">Nama Pasien:</div>
                    <div class="col-sm-7"><?= $p->nama_pasien ?></div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-5 font-weight-bold">Umur / JK:</div>
                    <div class="col-sm-7"><?= $p->umur ?> thn / <?= $p->jenis_kelamin ?></div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-5 font-weight-bold">Tanggal Pemeriksaan:</div>
                    <div class="col-sm-7"><?= date('d M Y', strtotime($p->tanggal)) ?></div>
                </div>
                <hr>
                <div class="mb-3">
                    <h6 class="font-weight-bold">Keluhan:</h6>
                    <p class="text-gray-800 border-left-warning pl-3"><?= nl2br($p->keluhan) ?></p>
                </div>
                
                <div class="d-flex justify-content-end mt-4">
                    <form action="<?= base_url('petugas/ubah_status/'.$p->id) ?>" method="post" class="d-inline mr-2">
                        <input type="hidden" name="status" value="Ditolak">
                        <input type="hidden" name="redirect" value="konfirmasi">
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Tolak pemeriksaan ini?')"><i class="fas fa-times"></i> Tolak</button>
                    </form>
                    <form action="<?= base_url('petugas/ubah_status/'.$p->id) ?>" method="post" class="d-inline">
                        <input type="hidden" name="status" value="Diproses">
                        <input type="hidden" name="redirect" value="konfirmasi">
                        <button type="submit" class="btn btn-primary"><i class="fas fa-check"></i> Proses ke Dokter</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php endforeach; ?>
</div>
<?php endif; ?>
