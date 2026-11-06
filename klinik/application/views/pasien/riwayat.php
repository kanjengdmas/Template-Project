<link href="<?= base_url('assets/css/riwayat.css') ?>" rel="stylesheet">

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Riwayat Pemeriksaan</h1>
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
<?php if ($this->session->flashdata('error')): ?>
    <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm mb-4" role="alert">
        <i class="fas fa-exclamation-circle mr-2"></i><?= $this->session->flashdata('error'); ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php endif; ?>

<div class="row">
    <?php if(empty($riwayat)): ?>
        <div class="col-12">
            <div class="alert alert-info border-0 shadow-sm">Belum ada riwayat pemeriksaan.</div>
        </div>
    <?php else: ?>
        <?php foreach($riwayat as $r): ?>
        <div class="col-lg-6 mb-4">
            <div class="card shadow-sm h-100 history-card position-relative">
                <!-- Delete Floating Button -->
                <a href="<?= base_url('pasien/hapus_riwayat/' . $r->id) ?>" class="btn-delete-card" onclick="return confirm('Apakah Anda yakin ingin menghapus riwayat pemeriksaan ini?')" title="Hapus Riwayat">
                    <i class="fas fa-times"></i>
                </a>

                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between history-card-header">
                    <h6 class="m-0 font-weight-bold text-primary">Pemeriksaan #<?= sprintf('%03d', $r->id) ?></h6>
                    <div>
                        <?php 
                            if($r->status == 'Menunggu') echo '<span class="badge badge-warning">Menunggu</span>';
                            elseif($r->status == 'Diproses') echo '<span class="badge badge-primary">Diproses Dokter</span>';
                            elseif($r->status == 'Selesai') echo '<span class="badge badge-success">Selesai</span>';
                            elseif($r->status == 'Ditolak') echo '<span class="badge badge-danger">Ditolak</span>';
                        ?>
                    </div>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <small class="text-muted"><i class="fas fa-calendar-alt mr-1"></i> Tanggal Pemeriksaan: <?= date('d M Y', strtotime($r->tanggal)) ?></small>
                        <?php if($r->nama_dokter): ?>
                        <br><small class="text-muted"><i class="fas fa-user-md mr-1"></i> Ditangani oleh: dr. <?= $r->nama_dokter ?></small>
                        <?php endif; ?>
                    </div>
                    
                    <h6 class="font-weight-bold" style="font-size: 14px;">Keluhan:</h6>
                    <p class="text-gray-800 border-left-warning pl-3"><?= nl2br($r->keluhan) ?></p>

                    <?php if($r->status == 'Selesai'): ?>
                        <hr>
                        <h6 class="font-weight-bold text-success" style="font-size: 14px;">Diagnosis:</h6>
                        <p class="text-gray-800 border-left-success pl-3"><?= nl2br($r->diagnosis) ?></p>

                        <h6 class="font-weight-bold text-info" style="font-size: 14px;">Saran:</h6>
                        <p class="text-gray-800 border-left-info pl-3"><?= nl2br($r->saran) ?></p>

                        <h6 class="font-weight-bold text-primary mt-3" style="font-size: 14px;"><i class="fas fa-pills"></i> Resep Digital:</h6>
                        <?php if(!empty($r->resep)): ?>
                            <ul class="list-group list-group-flush border mb-3">
                            <?php foreach($r->resep as $resep): ?>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <div>
                                        <strong><?= $resep->nama_obat ?></strong> <span class="badge badge-light ml-1"><?= $resep->jenis_obat ?></span> <strong class="text-primary ml-1">(<?= isset($resep->jumlah) ? $resep->jumlah : 1 ?> buah)</strong>
                                    </div>
                                    <span class="text-danger font-weight-bold"><?= $resep->aturan_pakai ?></span>
                                </li>
                            <?php endforeach; ?>
                            </ul>
                        <?php else: ?>
                            <p class="text-muted italic">Tidak ada resep obat yang diberikan.</p>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>
