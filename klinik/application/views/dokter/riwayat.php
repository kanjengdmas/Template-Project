<link href="<?= base_url('assets/css/riwayat.css') ?>" rel="stylesheet">

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Riwayat Pemeriksaan Pasien (Selesai)</h1>
</div>

<!-- Alert Messages -->
<?php if ($this->session->flashdata('success')): ?>
    <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm mb-4" role="alert">
        <i class="fas fa-check-circle mr-2"></i><?= $this->session->flashdata('success'); ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php endif; ?>

<?php if(empty($riwayat)): ?>
<div class="alert alert-info border-0 shadow-sm">
    <i class="fas fa-info-circle mr-2"></i> Belum ada riwayat pemeriksaan pasien yang diselesaikan.
</div>
<?php else: ?>
<div class="row">
    <?php foreach ($riwayat as $r): ?>
    <div class="col-xl-6 col-lg-6 mb-4">
        <div class="card shadow-sm h-100 history-card position-relative">
            <!-- Delete Floating Button -->
            <a href="<?= base_url('dokter/hapus_riwayat/' . $r->id) ?>" class="btn-delete-card" onclick="return confirm('Apakah Anda yakin ingin menghapus riwayat pemeriksaan ini?')" title="Hapus Riwayat">
                <i class="fas fa-times"></i>
            </a>

            <!-- Card Header -->
            <div class="card-header history-card-header py-3 d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center">
                    <div class="bg-light-primary rounded-circle p-2 mr-2 text-primary" style="background: rgba(79, 70, 229, 0.1);">
                        <i class="fas fa-user-injured"></i>
                    </div>
                    <div>
                        <h6 class="m-0 font-weight-bold text-gray-900"><?= $r->nama_pasien ?></h6>
                        <small class="text-muted"><?= $r->umur ?> Tahun &bull; <?= $r->jenis_kelamin ?></small>
                    </div>
                </div>
                <div>
                    <span class="badge badge-success px-2 py-1"><i class="fas fa-check-circle mr-1"></i>Selesai</span>
                </div>
            </div>

            <!-- Card Body -->
            <div class="card-body">
                <div class="mb-3">
                    <small class="text-muted"><i class="fas fa-calendar-alt mr-1"></i> Tanggal Pemeriksaan: <?= date('d M Y', strtotime($r->tanggal)) ?></small>
                </div>
                
                <div class="mb-3">
                    <h6 class="font-weight-bold text-gray-800 mb-1" style="font-size: 14px;">Keluhan:</h6>
                    <p class="text-gray-600 border-left-custom-warning pl-2 py-1 mb-0 small"><?= nl2br($r->keluhan) ?></p>
                </div>

                <div class="mb-3">
                    <h6 class="font-weight-bold text-success mb-1" style="font-size: 14px;">Diagnosis:</h6>
                    <p class="text-gray-800 border-left-custom-success pl-2 py-1 mb-0 small"><?= nl2br($r->diagnosis) ?></p>
                </div>

                <div class="mb-3">
                    <h6 class="font-weight-bold text-info mb-1" style="font-size: 14px;">Saran Medis:</h6>
                    <p class="text-gray-800 border-left-custom-info pl-2 py-1 mb-0 small"><?= nl2br($r->saran) ?></p>
                </div>

                <?php if(!empty($r->resep)): ?>
                    <hr class="my-3">
                    <h6 class="font-weight-bold text-primary mb-2" style="font-size: 14px;"><i class="fas fa-pills mr-1"></i> Resep Obat:</h6>
                    <ul class="list-group list-group-flush border rounded">
                    <?php foreach($r->resep as $resep): ?>
                        <li class="list-group-item d-flex justify-content-between align-items-center py-2 px-3 bg-light" style="font-size: 13px;">
                            <span><strong><?= $resep->nama_obat ?></strong> <span class="text-primary">(<?= isset($resep->jumlah) ? $resep->jumlah : 1 ?> Pcs)</span></span>
                            <span class="text-danger font-weight-bold"><?= $resep->aturan_pakai ?></span>
                        </li>
                    <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <?php endforeach; ?>
</div>
<?php endif; ?>
