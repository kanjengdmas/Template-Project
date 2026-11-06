<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Perpus | Sistem Perpustakaan Digital Modern</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?= base_url('assets/css/vendor/bootstrap.min.css') ?>">
    <!-- FontAwesome -->
    <link rel="stylesheet" href="<?= base_url('assets/css/vendor/all.min.css') ?>">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/landing.css') ?>">
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top navbar-custom py-3">
        <div class="container-fluid px-md-5 px-4">
            <a class="navbar-brand fw-bold text-primary" href="<?= base_url() ?>">
                <i class="fas fa-book-reader me-2"></i>E-Perpus
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <div class="d-flex flex-column flex-lg-row align-items-center mx-auto">
                    <ul class="navbar-nav align-items-center mb-2 mb-lg-0">
                        <li class="nav-item"><a class="nav-link" href="#home">Beranda</a></li>
                        <li class="nav-item"><a class="nav-link" href="#tentang">Tentang</a></li>
                        <li class="nav-item"><a class="nav-link" href="#katalog">Katalog Buku</a></li>
                        <li class="nav-item"><a class="nav-link" href="#fitur">Fitur</a></li>
                    </ul>
                    <div class="d-flex align-items-center ms-lg-4 mt-2 mt-lg-0">
                        <a class="btn btn-primary-custom" href="<?= base_url('auth') ?>">Login</a>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section id="home" class="hero-section py-5 d-flex align-items-center" style="min-height: 90vh; background: linear-gradient(135deg, #0F172A 0%, #1E3A8A 50%, #2563EB 100%); color: white; position: relative; overflow: hidden; margin-bottom: 30px;">
        <!-- Animated Background shapes -->
        <div class="position-absolute bg-primary rounded-circle opacity-10" style="width: 400px; height: 400px; top: -100px; left: -100px; filter: blur(100px);"></div>
        <div class="position-absolute bg-info rounded-circle opacity-10" style="width: 450px; height: 450px; bottom: -150px; right: -50px; filter: blur(120px);"></div>

        <div class="container position-relative z-1 py-5">
            <div class="row align-items-center g-5">
                <div class="col-lg-6 text-start">
                    <span class="badge bg-primary px-3 py-2 rounded-pill mb-3 text-uppercase fw-bold letter-spacing-1 shadow-sm">Sistem Modern E-Perpus</span>
                    <h1 class="display-3 fw-extrabold mb-4 text-white lh-sm" style="font-size: 3.5rem; text-shadow: 0 4px 12px rgba(0,0,0,0.15);">Sistem Peminjaman Buku Digital Modern</h1>
                    <p class="lead mb-4 text-white-50 fs-5" style="max-width: 600px;">Temukan, pinjam, dan kelola buku favoritmu secara online dengan mudah, cepat, aman, dan efisien melalui platform perpustakaan digital modern.</p>
                    <div class="d-flex flex-wrap gap-3">
                        <a href="#katalog" class="btn btn-light btn-lg px-4 py-3 rounded-pill fw-bold text-primary shadow-sm transition-hover"><i class="fas fa-search me-2"></i>Jelajahi Buku</a>
                        <a href="<?= base_url('auth') ?>" class="btn btn-outline-light btn-lg px-4 py-3 rounded-pill fw-bold transition-hover"><i class="fas fa-sign-in-alt me-2"></i>Login Sekarang</a>
                    </div>
                </div>
                <div class="col-lg-6 d-none d-lg-block text-center position-relative">
                    <img src="<?= base_url('assets/img/library_hero.jpg') ?>" alt="E-Perpus Library" class="img-fluid rounded-4 shadow-2xl border border-light border-opacity-10 transform-hover" style="max-width: 90%; transition: transform 0.4s ease-in-out; transform: rotate(-2deg); box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);">
                </div>
            </div>
        </div>
    </section>

    <!-- Statistik -->
    <section class="py-4" style="margin-top: -80px; position: relative; z-index: 2;">
        <div class="container">
            <div class="row g-4 justify-content-center">
                <div class="col-md-6 col-lg-4 col-xl-2">
                    <div class="card card-modern h-100 border-0 shadow-sm transition-hover">
                        <div class="card-body text-center p-4">
                            <div class="stat-icon mx-auto mb-3" style="background: rgba(37, 99, 235, 0.1); color: #2563EB; width: 60px; height: 60px; border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                                <i class="fas fa-book fa-lg"></i>
                            </div>
                            <h3 class="fw-bold mb-1 counter text-primary"><?= $total_buku ?></h3>
                            <p class="text-muted small mb-0 fw-semibold">Total Buku</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 col-xl-2">
                    <div class="card card-modern h-100 border-0 shadow-sm transition-hover">
                        <div class="card-body text-center p-4">
                            <div class="stat-icon mx-auto mb-3" style="background: rgba(16, 185, 129, 0.1); color: #10B981; width: 60px; height: 60px; border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                                <i class="fas fa-users fa-lg"></i>
                            </div>
                            <h3 class="fw-bold mb-1 counter text-success"><?= $total_anggota ?></h3>
                            <p class="text-muted small mb-0 fw-semibold">Total Anggota</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 col-xl-2">
                    <div class="card card-modern h-100 border-0 shadow-sm transition-hover">
                        <div class="card-body text-center p-4">
                            <div class="stat-icon mx-auto mb-3" style="background: rgba(245, 158, 11, 0.1); color: #F59E0B; width: 60px; height: 60px; border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                                <i class="fas fa-hand-holding fa-lg"></i>
                            </div>
                            <h3 class="fw-bold mb-1 counter text-warning"><?= $buku_dipinjam ?></h3>
                            <p class="text-muted small mb-0 fw-semibold">Buku Dipinjam</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 col-xl-2">
                    <div class="card card-modern h-100 border-0 shadow-sm transition-hover">
                        <div class="card-body text-center p-4">
                            <div class="stat-icon mx-auto mb-3" style="background: rgba(99, 102, 241, 0.1); color: #6366F1; width: 60px; height: 60px; border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                                <i class="fas fa-check-circle fa-lg"></i>
                            </div>
                            <h3 class="fw-bold mb-1 counter text-indigo" style="color: #6366F1;"><?= $total_buku - $buku_dipinjam ?></h3>
                            <p class="text-muted small mb-0 fw-semibold">Buku Tersedia</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 col-xl-2">
                    <div class="card card-modern h-100 border-0 shadow-sm transition-hover">
                        <div class="card-body text-center p-4">
                            <div class="stat-icon mx-auto mb-3" style="background: rgba(236, 72, 153, 0.1); color: #EC4899; width: 60px; height: 60px; border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                                <i class="fas fa-tags fa-lg"></i>
                            </div>
                            <h3 class="fw-bold mb-1 counter text-pink" style="color: #EC4899;"><?= $total_kategori ?></h3>
                            <p class="text-muted small mb-0 fw-semibold">Total Kategori</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 col-xl-2">
                    <div class="card card-modern h-100 border-0 shadow-sm transition-hover">
                        <div class="card-body text-center p-4">
                            <div class="stat-icon mx-auto mb-3" style="background: rgba(14, 165, 233, 0.1); color: #0EA5E9; width: 60px; height: 60px; border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                                <i class="fas fa-undo fa-lg"></i>
                            </div>
                            <h3 class="fw-bold mb-1 counter text-info" style="color: #0EA5E9;"><?= $buku_dikembalikan ?></h3>
                            <p class="text-muted small mb-0 fw-semibold">Pengembalian</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Tentang -->
    <section id="tentang" class="py-5 bg-white">
        <div class="container py-5">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-4 mb-lg-0">
                    <img src="<?= base_url('assets/img/about_us.jpg') ?>" alt="Tentang Kami" class="img-fluid rounded-4 shadow-lg">
                </div>
                <div class="col-lg-6 ps-lg-5">
                    <h6 class="text-primary fw-bold text-uppercase">Tentang Sistem</h6>
                    <h2 class="fw-bold mb-4">Membaca Semakin Mudah & Praktis</h2>
                    <p class="text-muted mb-4">Sistem perpustakaan digital ini dirancang untuk mempermudah proses sirkulasi buku. Dengan platform ini, Anda tidak perlu lagi datang langsung hanya untuk mengecek ketersediaan buku.</p>
                    <ul class="list-unstyled">
                        <li class="mb-3"><i class="fas fa-check-circle text-primary me-2"></i> Mempermudah proses peminjaman buku</li>
                        <li class="mb-3"><i class="fas fa-check-circle text-primary me-2"></i> Mengurangi pencatatan manual</li>
                        <li class="mb-3"><i class="fas fa-check-circle text-primary me-2"></i> Monitoring stok buku secara real-time</li>
                        <li class="mb-3"><i class="fas fa-check-circle text-primary me-2"></i> Mempermudah pembuatan laporan</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- Keunggulan & Fitur -->
    <section id="fitur" class="py-5 bg-light">
        <div class="container py-5">
            <div class="text-center mb-5">
                <h6 class="text-primary fw-bold text-uppercase">Keunggulan</h6>
                <h2 class="fw-bold">Fitur Terbaik Untuk Anda</h2>
            </div>
            <div class="row g-4">
                <div class="col-md-4 col-lg-3">
                    <div class="card card-modern h-100 text-center p-4">
                        <i class="fas fa-users feature-icon"></i>
                        <h5 class="fw-bold">Multi User Login</h5>
                        <p class="text-muted small">Akses khusus untuk admin dan anggota dengan hak akses berbeda.</p>
                    </div>
                </div>
                <div class="col-md-4 col-lg-3">
                    <div class="card card-modern h-100 text-center p-4">
                        <i class="fas fa-book feature-icon"></i>
                        <h5 class="fw-bold">Manajemen Buku Lengkap</h5>
                        <p class="text-muted small">Kelola data buku, kategori, dan stok secara real-time.</p>
                    </div>
                </div>
                <div class="col-md-4 col-lg-3">
                    <div class="card card-modern h-100 text-center p-4">
                        <i class="fas fa-chart-pie feature-icon"></i>
                        <h5 class="fw-bold">Dashboard Interaktif</h5>
                        <p class="text-muted small">Tampilan dashboard informatif dengan grafik dan angka real-time.</p>
                    </div>
                </div>
                <div class="col-md-4 col-lg-3">
                    <div class="card card-modern h-100 text-center p-4">
                        <i class="fas fa-check-double feature-icon"></i>
                        <h5 class="fw-bold">Verifikasi Aman</h5>
                        <p class="text-muted small">Proses pengembalian diverifikasi oleh admin secara langsung.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Cara Kerja -->
    <section class="py-5 bg-white">
        <div class="container py-5">
            <div class="text-center mb-5">
                <h6 class="text-primary fw-bold text-uppercase">Cara Kerja</h6>
                <h2 class="fw-bold">Alur Peminjaman Mudah</h2>
            </div>
            <div class="row g-4">
                <div class="col-md-3">
                    <div class="step-card">
                        <div class="step-number">1</div>
                        <h5 class="fw-bold">Login</h5>
                        <p class="text-muted small">Masuk ke akun anggota Anda.</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="step-card">
                        <div class="step-number">2</div>
                        <h5 class="fw-bold">Cari Buku</h5>
                        <p class="text-muted small">Pilih buku dari katalog tersedia.</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="step-card">
                        <div class="step-number">3</div>
                        <h5 class="fw-bold">Pinjam Buku</h5>
                        <p class="text-muted small">Klik tombol pinjam, stok akan otomatis berkurang.</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="step-card">
                        <div class="step-number">4</div>
                        <h5 class="fw-bold">Kembalikan</h5>
                        <p class="text-muted small">Ajukan pengembalian dan tunggu verifikasi Admin.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Katalog Terbaru -->
    <section id="katalog" class="py-5 bg-light">
        <div class="container py-5">
            <div class="d-flex justify-content-between align-items-end mb-5">
                <div>
                    <h6 class="text-primary fw-bold text-uppercase">Katalog</h6>
                    <h2 class="fw-bold mb-0">Buku Terbaru</h2>
                </div>
                <a href="<?= base_url('auth') ?>" class="btn btn-outline-primary rounded-pill">Lihat Semua <i class="fas fa-arrow-right ms-2"></i></a>
            </div>

            <!-- Carousel untuk Desktop & Tablet (Tampil 3 Buku Per Slide) -->
            <div id="carouselKatalogDesktop" class="carousel slide d-none d-md-block position-relative" data-bs-ride="carousel" data-bs-interval="5000">
                <!-- Indicators -->
                <div class="carousel-indicators mb-0" style="bottom: -45px;">
                    <?php 
                    $chunks = array_chunk($buku_terbaru, 3);
                    foreach ($chunks as $index => $chunk): 
                    ?>
                    <button type="button" data-bs-target="#carouselKatalogDesktop" data-bs-slide-to="<?= $index ?>" class="<?= $index === 0 ? 'active' : '' ?> bg-primary" aria-current="<?= $index === 0 ? 'true' : 'false' ?>" aria-label="Slide <?= $index + 1 ?>"></button>
                    <?php endforeach; ?>
                </div>

                <div class="carousel-inner">
                    <?php foreach ($chunks as $index => $chunk): ?>
                    <div class="carousel-item <?= $index === 0 ? 'active' : '' ?>">
                        <div class="row g-4 justify-content-center px-5">
                            <?php foreach ($chunk as $b): ?>
                            <div class="col-md-4">
                                <div class="card book-card h-100 shadow-sm border-0">
                                    <div class="book-img-wrapper" style="position: relative; overflow: hidden; border-top-left-radius: 16px; border-top-right-radius: 16px;">
                                        <img src="<?= base_url('assets/img/buku/' . (!empty($b->cover) ? $b->cover : 'default_book.jpg')) ?>" class="book-cover img-fluid" alt="<?= $b->judul ?>" style="height: 320px; width: 100%; object-fit: cover;">
                                    </div>
                                    <div class="card-body p-4 text-center">
                                        <span class="badge bg-primary px-3 py-2 rounded-pill mb-2"><?= $b->nama_kategori ?></span>
                                        <h5 class="card-title fw-bold text-truncate mb-2" title="<?= $b->judul ?>"><?= $b->judul ?></h5>
                                        <p class="card-text text-muted small mb-0"><?= $b->penulis ?></p>
                                    </div>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>

                <!-- Controls -->
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselKatalogDesktop" data-bs-slide="prev" style="width: 5%; left: -30px;">
                    <span class="carousel-control-prev-icon rounded-circle p-3 shadow" aria-hidden="true" style="background-color: #2563EB !important;"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselKatalogDesktop" data-bs-slide="next" style="width: 5%; right: -30px;">
                    <span class="carousel-control-next-icon rounded-circle p-3 shadow" aria-hidden="true" style="background-color: #2563EB !important;"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>

            <!-- Carousel untuk Mobile (Tampil 1 Buku Per Slide) -->
            <div id="carouselKatalogMobile" class="carousel slide d-block d-md-none position-relative" data-bs-ride="carousel" data-bs-interval="4000">
                <!-- Indicators -->
                <div class="carousel-indicators mb-0" style="bottom: -40px;">
                    <?php foreach ($buku_terbaru as $index => $b): ?>
                    <button type="button" data-bs-target="#carouselKatalogMobile" data-bs-slide-to="<?= $index ?>" class="<?= $index === 0 ? 'active' : '' ?> bg-primary" aria-current="<?= $index === 0 ? 'true' : 'false' ?>" aria-label="Slide <?= $index + 1 ?>"></button>
                    <?php endforeach; ?>
                </div>

                <div class="carousel-inner">
                    <?php foreach ($buku_terbaru as $index => $b): ?>
                    <div class="carousel-item <?= $index === 0 ? 'active' : '' ?>">
                        <div class="row justify-content-center px-4">
                            <div class="col-10 col-sm-8">
                                <div class="card book-card h-100 shadow-sm border-0">
                                    <div class="book-img-wrapper" style="position: relative; overflow: hidden; border-top-left-radius: 16px; border-top-right-radius: 16px;">
                                        <img src="<?= base_url('assets/img/buku/' . (!empty($b->cover) ? $b->cover : 'default_book.jpg')) ?>" class="book-cover img-fluid" alt="<?= $b->judul ?>" style="height: 300px; width: 100%; object-fit: cover;">
                                    </div>
                                    <div class="card-body p-4 text-center">
                                        <span class="badge bg-primary px-3 py-2 rounded-pill mb-2"><?= $b->nama_kategori ?></span>
                                        <h5 class="card-title fw-bold text-truncate mb-2" title="<?= $b->judul ?>"><?= $b->judul ?></h5>
                                        <p class="card-text text-muted small mb-0"><?= $b->penulis ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>

                <!-- Controls -->
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselKatalogMobile" data-bs-slide="prev" style="width: 10%; left: -15px;">
                    <span class="carousel-control-prev-icon rounded-circle p-2 shadow" aria-hidden="true" style="background-color: #2563EB !important; width: 2.2rem; height: 2.2rem;"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselKatalogMobile" data-bs-slide="next" style="width: 10%; right: -15px;">
                    <span class="carousel-control-next-icon rounded-circle p-2 shadow" aria-hidden="true" style="background-color: #2563EB !important; width: 2.2rem; height: 2.2rem;"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>

        </div>
    </section>

    <!-- Call To Action -->
    <section class="py-5" style="background: linear-gradient(135deg, var(--primary-color), var(--accent-color));">
        <div class="container py-5 text-center text-white">
            <h2 class="fw-bold mb-4">Mulai Gunakan Sistem Perpustakaan Digital Sekarang</h2>
            <p class="lead mb-4 mx-auto" style="max-width: 600px;">Nikmati kemudahan meminjam dan membaca buku favorit Anda kapan saja dan di mana saja.</p>
            <a href="<?= base_url('auth') ?>" class="btn btn-light btn-lg rounded-pill px-5 fw-bold text-primary">Login Sekarang</a>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer-modern py-5">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-4">
                    <h4 class="fw-bold text-white mb-4"><i class="fas fa-book-reader me-2 text-primary"></i>E-Perpus</h4>
                    <p class="text-white" style="line-height: 1.7; opacity: 0.85;">Sistem informasi perpustakaan digital modern yang memudahkan proses peminjaman dan pengelolaan buku secara efisien.</p>
                    <div class="d-flex gap-2 mt-4">
                        <a href="#" class="footer-social-btn"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="footer-social-btn"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="footer-social-btn"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
                <div class="col-lg-2 offset-lg-2">
                    <h5 class="fw-bold text-white mb-4">Tautan Cepat</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="#home" class="footer-link">Beranda</a></li>
                        <li class="mb-2"><a href="#tentang" class="footer-link">Tentang</a></li>
                        <li class="mb-2"><a href="#katalog" class="footer-link">Katalog</a></li>
                        <li class="mb-2"><a href="<?= base_url('auth') ?>" class="footer-link">Login</a></li>
                    </ul>
                </div>
                <div class="col-lg-4">
                    <h5 class="fw-bold text-white mb-4">Kontak Kami</h5>
                    <div class="footer-contact-item text-white">
                        <i class="fas fa-map-marker-alt"></i>
                        <span>Jl. Pendidikan No. 123, Jakarta</span>
                    </div>
                    <div class="footer-contact-item text-white">
                        <i class="fas fa-envelope"></i>
                        <span>info@eperpus.com</span>
                    </div>
                    <div class="footer-contact-item text-white">
                        <i class="fas fa-phone-alt"></i>
                        <span>+62 812 3456 7890</span>
                    </div>
                    <div class="footer-contact-item text-white">
                        <i class="fas fa-clock"></i>
                        <span>Senin - Jumat (08:00 - 16:00)</span>
                    </div>
                </div>
            </div>
            <hr class="my-4" style="border-color: rgba(255,255,255,0.08);">
            <div class="text-center text-white small" style="opacity: 0.8;">
                &copy; <?= date('Y') ?> E-Perpus. All rights reserved.
            </div>
        </div>
    </footer>

    <!-- jQuery & Bootstrap JS -->
    <script src="<?= base_url('assets/js/vendor/jquery-3.6.0.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/vendor/bootstrap.bundle.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/scripts.js') ?>"></script>
</body>
</html>
