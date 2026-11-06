<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Dashboard Dokter</h1>
</div>

<!-- Content Row -->
<div class="row">

    <!-- Pasien Hari Ini -->
    <div class="col-xl-6 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Pasien Menunggu (Hari Ini)</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $pasien_hari_ini ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-users fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Pemeriksaan Selesai -->
    <div class="col-xl-6 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Pemeriksaan Selesai</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $pemeriksaan_selesai ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-check-double fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<div class="row">
    <div class="col-lg-12">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Selamat Bekerja, dr. <?= $this->session->userdata('nama') ?></h6>
            </div>
            <div class="card-body">
                <p>Silakan buka menu <strong>Pemeriksaan Pasien</strong> untuk melihat daftar pasien yang telah diverifikasi oleh petugas dan siap untuk didiagnosis.</p>
                <a href="<?= base_url('dokter/pemeriksaan') ?>" class="btn btn-primary mt-2"><i class="fas fa-stethoscope"></i> Mulai Pemeriksaan</a>
            </div>
        </div>
    </div>
</div>
