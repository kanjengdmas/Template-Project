<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Klinik Digital - Solusi Kesehatan Modern</title>
    <!-- Bootstrap CSS -->
    <link href="<?= base_url('assets/css/bootstrap5.min.css') ?>" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= base_url('assets/css/all.min.css') ?>">
    <!-- Google Fonts -->
    <link href="<?= base_url('assets/css/inter.css') ?>" rel="stylesheet">
    
    <!-- Custom Landing Page Style -->
    <link href="<?= base_url('assets/css/landing.css') ?>" rel="stylesheet">
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container">
            <a class="navbar-brand text-white fw-bold fs-4" href="#">
                <i class="fa-solid fa-notes-medical me-2"></i>Klinik Digital
            </a>
            <button class="navbar-toggler bg-white" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item"><a class="nav-link" href="#home">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="#layanan">Layanan</a></li>
                    <li class="nav-item"><a class="nav-link" href="#cara-kerja">Cara Kerja</a></li>
                    <li class="nav-item"><a class="nav-link" href="#tentang">Tentang Kami</a></li>
                    <li class="nav-item"><a class="nav-link" href="#kontak">Kontak</a></li>
                    <?php if ($this->session->userdata('role')): ?>
                        <li class="nav-item ms-lg-3 mt-3 mt-lg-0">
                            <a href="<?= base_url($this->session->userdata('role')) ?>" class="btn btn-outline-light btn-nav-login px-4 rounded-pill">Dashboard</a>
                        </li>
                        <li class="nav-item ms-lg-2 mt-2 mt-lg-0">
                            <a href="<?= base_url('auth/logout') ?>" class="btn btn-light btn-nav-register px-4 rounded-pill text-primary fw-bold">Logout</a>
                        </li>
                    <?php else: ?>
                        <li class="nav-item ms-lg-3 mt-3 mt-lg-0">
                            <a href="<?= base_url('auth/login') ?>" class="btn btn-outline-light btn-nav-login px-4 rounded-pill">Login</a>
                        </li>
                        <li class="nav-item ms-lg-2 mt-2 mt-lg-0">
                            <a href="<?= base_url('auth/register') ?>" class="btn btn-light btn-nav-register px-4 rounded-pill text-primary fw-bold">Daftar</a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section id="home" class="hero">
        <i class="fa-solid fa-heart-pulse fa-10x floating-icon" style="top: 10%; left: 5%;"></i>
        <i class="fa-solid fa-stethoscope fa-10x floating-icon" style="bottom: 10%; right: 10%; animation-delay: 2s;"></i>
        <i class="fa-solid fa-pills fa-8x floating-icon" style="top: 30%; right: 20%; animation-delay: 1s;"></i>

        <div class="container text-center text-md-start position-relative z-1">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <span class="badge bg-info text-dark mb-3 px-3 py-2 rounded-pill shadow-sm">Layanan Kesehatan Modern</span>
                    <h1 class="display-4 fw-bold mb-4">Solusi Kesehatan<br>Digital Anda</h1>
                    <p class="lead mb-5 fs-5 opacity-75">Konsultasikan keluhan kesehatan Anda secara mudah, cepat, dan aman melalui sistem klinik berbasis web kami. Kesehatan Anda adalah prioritas utama kami.</p>
                    <div class="d-flex flex-wrap gap-3 justify-content-center justify-content-md-start">
                        <?php if ($this->session->userdata('role')): ?>
                            <a href="<?= base_url($this->session->userdata('role')) ?>" class="btn btn-light btn-lg px-4 rounded-pill text-primary fw-bold shadow">Buka Dashboard</a>
                        <?php else: ?>
                            <a href="<?= base_url('auth/register') ?>" class="btn btn-light btn-lg px-4 rounded-pill text-primary fw-bold shadow">Daftar Sekarang</a>
                            <a href="<?= base_url('auth/login') ?>" class="btn btn-outline-light btn-lg px-4 rounded-pill">Login</a>
                        <?php endif; ?>
                        <a href="#layanan" class="btn btn-outline-light btn-lg px-4 rounded-pill">Pelajari Lebih Lanjut</a>
                    </div>
                </div>
                <div class="col-lg-6 d-none d-lg-block">
                    <!-- Added an illustration to match "Ilustrasi dokter" requirement -->
                    <img src="<?= base_url('assets/img/doctor-illustration.png') ?>" alt="Dokter Ilustrasi" class="img-fluid" style="filter: drop-shadow(0 20px 30px rgba(0,0,0,0.2));">
                </div>
            </div>
        </div>
    </section>

    <!-- Layanan Section -->
    <section id="layanan" class="py-5 bg-light">
        <div class="container py-5">
            <div class="text-center mb-5">
                <h6 class="text-primary fw-bold text-uppercase tracking-wider">Layanan Kami</h6>
                <h2 class="fw-bold">Pelayanan Kesehatan Terbaik Untuk Anda</h2>
            </div>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="service-card p-4">
                        <div class="service-icon"><i class="fa-solid fa-user-doctor"></i></div>
                        <h4>Konsultasi Online</h4>
                        <p class="text-muted">Konsultasi keluhan dengan dokter profesional dari rumah.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="service-card p-4">
                        <div class="service-icon"><i class="fa-solid fa-stethoscope"></i></div>
                        <h4>Pemeriksaan Kesehatan</h4>
                        <p class="text-muted">Catat rekam medis dan pemeriksaan secara akurat.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="service-card p-4">
                        <div class="service-icon"><i class="fa-solid fa-file-prescription"></i></div>
                        <h4>Resep Digital</h4>
                        <p class="text-muted">Dapatkan resep obat langsung dari dokter secara digital.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="service-card p-4">
                        <div class="service-icon"><i class="fa-solid fa-clock-rotate-left"></i></div>
                        <h4>Riwayat Pemeriksaan</h4>
                        <p class="text-muted">Akses mudah rekam jejak riwayat medis Anda kapan saja.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="service-card p-4">
                        <div class="service-icon"><i class="fa-solid fa-user-nurse"></i></div>
                        <h4>Dokter Profesional</h4>
                        <p class="text-muted">Ditangani oleh tenaga medis yang berpengalaman.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="service-card p-4">
                        <div class="service-icon"><i class="fa-solid fa-shield-halved"></i></div>
                        <h4>Data Pasien Aman</h4>
                        <p class="text-muted">Privasi dan data medis Anda terjamin keamanannya.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Cara Kerja Section -->
    <section id="cara-kerja" class="py-5">
        <div class="container py-5">
            <div class="text-center mb-5">
                <h6 class="text-primary fw-bold text-uppercase">Proses Mudah</h6>
                <h2 class="fw-bold">Cara Kerja Sistem Kami</h2>
            </div>
            <div class="row g-4">
                <div class="col-md-3">
                    <div class="step-box">
                        <div class="step-number">1</div>
                        <h5>Buat Akun</h5>
                        <p class="text-muted small">Pasien melakukan registrasi akun secara gratis.</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="step-box">
                        <div class="step-number">2</div>
                        <h5>Isi Formulir</h5>
                        <p class="text-muted small">Pasien mengisi data keluhan dan riwayat kesehatan.</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="step-box">
                        <div class="step-number">3</div>
                        <h5>Verifikasi</h5>
                        <p class="text-muted small">Petugas mengonfirmasi data pemeriksaan pasien.</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="step-box">
                        <div class="step-number">4</div>
                        <h5>Diagnosis & Resep</h5>
                        <p class="text-muted small">Dokter memberikan diagnosis dan resep obat digital.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Statistik Section -->
    <section class="stats-section text-center">
        <div class="container">
            <div class="row g-4">
                <div class="col-md-3 col-6">
                    <div class="stat-item">
                        <i class="fa-solid fa-users fa-2x mb-3 text-info"></i>
                        <h2 class="counter" data-target="1000">0</h2>
                        <p>Pasien</p>
                    </div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="stat-item">
                        <i class="fa-solid fa-user-doctor fa-2x mb-3 text-info"></i>
                        <h2 class="counter" data-target="20">0</h2>
                        <p>Dokter</p>
                    </div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="stat-item">
                        <i class="fa-solid fa-notes-medical fa-2x mb-3 text-info"></i>
                        <h2 class="counter" data-target="5000">0</h2>
                        <p>Pemeriksaan</p>
                    </div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="stat-item">
                        <i class="fa-solid fa-face-smile fa-2x mb-3 text-info"></i>
                        <h2><span class="counter" data-target="98">0</span>%</h2>
                        <p>Kepuasan Pasien</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Tentang Kami Section -->
    <section id="tentang" class="py-5 bg-light">
        <div class="container py-5">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-4 mb-lg-0">
                    <img src="<?= base_url('assets/img/about-clinic.jpg') ?>" alt="Tentang Klinik" class="img-fluid rounded-4 shadow">
                </div>
                <div class="col-lg-6 ps-lg-5">
                    <h6 class="text-primary fw-bold text-uppercase">Tentang Klinik</h6>
                    <h2 class="fw-bold mb-4">Berkomitmen Memberikan Pelayanan Kesehatan Digital yang Cepat & Mudah</h2>
                    <p class="text-muted mb-4">Klinik Digital hadir sebagai solusi kesehatan di era modern. Kami mengintegrasikan teknologi informasi untuk mempermudah akses layanan kesehatan bagi masyarakat, memberikan kenyamanan tanpa antrean panjang, serta pencatatan rekam medis yang aman.</p>
                    <ul class="list-unstyled mb-4">
                        <li class="mb-2"><i class="fa-solid fa-check text-success me-2"></i> Pelayanan Cepat & Akurat</li>
                        <li class="mb-2"><i class="fa-solid fa-check text-success me-2"></i> Tenaga Medis Profesional</li>
                        <li class="mb-2"><i class="fa-solid fa-check text-success me-2"></i> Sistem Terintegrasi Penuh</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- Kontak Section -->
    <section id="kontak" class="py-5">
        <div class="container py-5">
            <div class="text-center mb-5">
                <h6 class="text-primary fw-bold text-uppercase">Hubungi Kami</h6>
                <h2 class="fw-bold">Kami Siap Membantu Anda</h2>
            </div>
            <div class="row g-4">
                <div class="col-lg-5">
                    <div class="card border-0 shadow-sm rounded-4 h-100 p-4 bg-light">
                        <div class="card-body">
                            <h4 class="fw-bold mb-4">Informasi Kontak</h4>
                            <div class="d-flex align-items-center mb-4 contact-info">
                                <i class="fa-solid fa-location-dot"></i>
                                <div>
                                    <h6 class="mb-1 fw-bold">Alamat Klinik</h6>
                                    <p class="text-muted mb-0">Jl. Kesehatan No. 123, Jakarta Pusat</p>
                                </div>
                            </div>
                            <div class="d-flex align-items-center mb-4 contact-info">
                                <i class="fa-solid fa-phone"></i>
                                <div>
                                    <h6 class="mb-1 fw-bold">Nomor Telepon</h6>
                                    <p class="text-muted mb-0">+62 812-3456-7890</p>
                                </div>
                            </div>
                            <div class="d-flex align-items-center mb-4 contact-info">
                                <i class="fa-solid fa-envelope"></i>
                                <div>
                                    <h6 class="mb-1 fw-bold">Email</h6>
                                    <p class="text-muted mb-0">info@klinikdigital.com</p>
                                </div>
                            </div>
                            <div class="d-flex align-items-center contact-info">
                                <i class="fa-solid fa-clock"></i>
                                <div>
                                    <h6 class="mb-1 fw-bold">Jam Operasional</h6>
                                    <p class="text-muted mb-0">Senin - Minggu (08:00 - 20:00)</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="card border-0 shadow-sm rounded-4 p-4">
                        <div class="card-body">
                            <h4 class="fw-bold mb-4">Kirim Pesan</h4>
                            <form>
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <input type="text" class="form-control form-control-lg bg-light border-0" placeholder="Nama Lengkap">
                                    </div>
                                    <div class="col-md-6">
                                        <input type="email" class="form-control form-control-lg bg-light border-0" placeholder="Alamat Email">
                                    </div>
                                    <div class="col-12">
                                        <input type="text" class="form-control form-control-lg bg-light border-0" placeholder="Subjek Pesan">
                                    </div>
                                    <div class="col-12">
                                        <textarea class="form-control form-control-lg bg-light border-0" rows="5" placeholder="Tulis pesan Anda di sini..."></textarea>
                                    </div>
                                    <div class="col-12">
                                        <button type="button" class="btn btn-primary btn-lg w-100 rounded-pill fw-bold">Kirim Pesan Sekarang</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="row g-4 mb-4">
                <div class="col-lg-4">
                    <h5 class="text-white fw-bold mb-3"><i class="fa-solid fa-notes-medical me-2"></i>Klinik Digital</h5>
                    <p>Sistem informasi klinik modern untuk memberikan pelayanan kesehatan terbaik, mudah, dan aman bagi seluruh lapisan masyarakat.</p>
                    <div class="d-flex gap-3 mt-3">
                        <a href="#" class="fs-5"><i class="fa-brands fa-facebook"></i></a>
                        <a href="#" class="fs-5"><i class="fa-brands fa-twitter"></i></a>
                        <a href="#" class="fs-5"><i class="fa-brands fa-instagram"></i></a>
                    </div>
                </div>
                <div class="col-lg-2 offset-lg-2">
                    <h5 class="text-white fw-bold mb-3">Navigasi</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="#home">Home</a></li>
                        <li class="mb-2"><a href="#layanan">Layanan</a></li>
                        <li class="mb-2"><a href="#cara-kerja">Cara Kerja</a></li>
                        <li class="mb-2"><a href="#tentang">Tentang Kami</a></li>
                    </ul>
                </div>
                <div class="col-lg-4">
                    <h5 class="text-white fw-bold mb-3">Klinik Digital App</h5>
                    <p>Mulai pengalaman kesehatan digital Anda dengan mendaftar di sistem kami.</p>
                    <a href="<?= base_url('auth/register') ?>" class="btn btn-primary rounded-pill px-4">Daftar Sekarang</a>
                </div>
            </div>
            <div class="border-top border-secondary pt-4 text-center">
                <p class="mb-0">&copy; 2026 Klinik Digital. All Rights Reserved.</p>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="<?= base_url('assets/js/bootstrap5.bundle.min.js') ?>"></script>
    
    <!-- Custom Landing Page Script -->
    <script src="<?= base_url('assets/js/landing.js') ?>"></script>
</body>
</html>
