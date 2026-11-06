<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Dashboard Pasien</h1>
    <a href="<?= base_url('pasien/pemeriksaan') ?>" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-plus fa-sm text-white-50"></i> Buat Pemeriksaan Baru</a>
</div>

<!-- Content Row -->
<div class="row">

    <!-- Total Pemeriksaan -->
    <div class="col-xl-4 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Pemeriksaan</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $total_pemeriksaan ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-notes-medical fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Pemeriksaan Selesai -->
    <div class="col-xl-4 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Pemeriksaan Selesai</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $pemeriksaan_selesai ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-check-circle fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Pemeriksaan Menunggu -->
    <div class="col-xl-4 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Menunggu Konfirmasi</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $pemeriksaan_menunggu ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-clock fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-6">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Selamat Datang di Klinik Digital!</h6>
            </div>
            <div class="card-body">
                <p>Melalui panel ini, Anda dapat:</p>
                <ul>
                    <li>Mengajukan permintaan pemeriksaan baru ke dokter kami.</li>
                    <li>Melihat riwayat pemeriksaan, diagnosis, dan saran dari dokter.</li>
                    <li>Melihat resep obat yang telah diberikan secara digital.</li>
                </ul>
                <p class="mb-0">Jika ada pertanyaan, silakan hubungi petugas klinik.</p>
            </div>
        </div>
    </div>
</div>
