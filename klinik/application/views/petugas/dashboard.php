<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Dashboard Petugas</h1>
</div>

<!-- Content Row -->
<div class="row">

    <!-- Pemeriksaan Baru (Menunggu) -->
    <div class="col-xl-6 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Pemeriksaan Baru (Menunggu Konfirmasi)</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $pemeriksaan_baru ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-clock fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Pemeriksaan Diproses Dokter -->
    <div class="col-xl-6 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Diproses Dokter</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $diproses_dokter ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-user-doctor fa-2x text-gray-300"></i>
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
                <h6 class="m-0 font-weight-bold text-primary">Tugas Hari Ini</h6>
            </div>
            <div class="card-body">
                <p>Sebagai petugas klinik, tugas utama Anda adalah:</p>
                <ul>
                    <li>Mengecek data pemeriksaan baru yang dikirim oleh Pasien.</li>
                    <li>Melakukan verifikasi data dan mengubah status pemeriksaan menjadi <strong>Diproses Dokter</strong> agar dapat ditangani oleh Dokter.</li>
                    <li>Menolak permintaan pemeriksaan jika data tidak valid atau tidak lengkap.</li>
                </ul>
                <p class="mb-0">Silakan buka menu <strong>Konfirmasi Pemeriksaan</strong> untuk memulai.</p>
                <a href="<?= base_url('petugas/konfirmasi') ?>" class="btn btn-primary mt-3"><i class="fas fa-check-circle"></i> Mulai Konfirmasi</a>
            </div>
        </div>
    </div>
</div>
