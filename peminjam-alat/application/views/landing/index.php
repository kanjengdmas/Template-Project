<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <!-- Local Google Fonts -->
    <link href="<?= base_url('assets/css/fonts.css') ?>" rel="stylesheet">
    <!-- Bootstrap 5 CSS -->
    <link href="<?= base_url('assets/css/bootstrap.min.css') ?>" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url('assets/vendor/fontawesome-free/css/all.min.css') ?>">
    <!-- Chart.js -->
    <script src="<?= base_url('assets/vendor/chart.js/Chart.min.js') ?>"></script>
    <!-- Custom Landing CSS -->
    <link rel="stylesheet" href="<?= base_url('assets/css/landing.css') ?>">
</head>
<body>
    <!-- Scroll Progress Bar -->
    <div id="scroll-progress-bar"></div>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg py-3 sticky-top">
        <div class="container">
            <a class="navbar-brand fw-bold text-primary-custom" href="<?= base_url() ?>">
                <i class="fas fa-tools me-2"></i> Sipanja
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item"><a class="nav-link fw-medium px-3" href="#home">Home</a></li>
                    <li class="nav-item"><a class="nav-link fw-medium px-3" href="#fitur">Keunggulan</a></li>
                    <li class="nav-item"><a class="nav-link fw-medium px-3" href="#carapinjam">Alur Pinjam</a></li>
                    <li class="nav-item"><a class="nav-link fw-medium px-3" href="#alat">Katalog Alat</a></li>
                    <li class="nav-item"><a class="nav-link fw-medium px-3" href="#populer">Alat Populer</a></li>
                    <li class="nav-item"><a class="nav-link fw-medium px-3" href="#faq">FAQ</a></li>
                    <li class="nav-item ms-lg-3 mt-3 mt-lg-0">
                        <?php if ($this->session->userdata('id')): ?>
                            <a class="btn btn-primary-custom px-4 fw-bold rounded-pill shadow-sm" href="<?= base_url('dashboard') ?>"><i class="fas fa-desktop me-2"></i> Dashboard</a>
                        <?php else: ?>
                            <a class="btn btn-primary-custom px-4 fw-bold rounded-pill shadow-sm" href="<?= base_url('auth') ?>"><i class="fas fa-sign-in-alt me-2"></i> Login Sekarang</a>
                        <?php endif; ?>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section (Blue) -->
    <section id="home" class="hero d-flex align-items-center">
        <!-- Particle Background Canvas -->
        <canvas id="hero-particles" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; pointer-events: none; z-index: 1;"></canvas>
        <div class="container" style="position: relative; z-index: 2;">
            <div class="row align-items-center">
                <div class="col-lg-6 text-center text-lg-start mb-5 mb-lg-0">
                    <span class="badge bg-white text-primary-custom px-3 py-2 rounded-pill mb-3 fw-semibold" style="letter-spacing: 0.5px;">SISTEM PEMINJAMAN ALAT ONLINE</span>
                    <h1 class="display-4 fw-extrabold mb-4 lh-sm">Pinjam Alat <span id="typed-text" style="color: #ffd700;"></span>, <br>Kerja Makin Maksimal!</h1>
                    <p class="lead mb-5" style="color: rgba(255,255,255,0.9);">Sipanja mempermudah pengajuan peminjaman, pelacakan status, dan monitoring inventaris alat secara realtime dalam satu platform modern.</p>
                    <div class="d-flex flex-column flex-sm-row justify-content-center justify-content-lg-start gap-3">
                        <a href="#alat" class="btn btn-light text-primary-custom btn-lg px-4 fw-bold rounded-pill shadow">Lihat Katalog Alat</a>
                        <a href="#carapinjam" class="btn btn-outline-light btn-lg px-4 fw-bold rounded-pill">Cara Meminjam <i class="fas fa-arrow-right ms-2"></i></a>
                    </div>
                </div>
                <div class="col-lg-6 text-center">
                    <img src="<?= base_url('assets/img/default.png') ?>" alt="Hero Illustration" class="img-fluid rounded-4 shadow-lg" style="max-height: 380px; object-fit: cover; border: 4px solid rgba(255,255,255,0.2);">
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section (White overlapping Blue Hero) -->
    <section class="position-relative" style="margin-top: -50px; z-index: 10;">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="card-custom p-4 fade-up-scroll">
                        <div class="row text-center gy-4 gy-md-0">
                            <div class="col-md-4 border-end border-light">
                                <div class="px-3">
                                    <h2 class="display-6 fw-bold text-primary-custom mb-1 counter" data-target="<?= $total_alat ?>">0</h2>
                                    <p class="text-muted mb-0 fw-medium">Total Alat Tersedia</p>
                                </div>
                            </div>
                            <div class="col-md-4 border-end border-light">
                                <div class="px-3">
                                    <h2 class="display-6 fw-bold text-primary-custom mb-1 counter" data-target="<?= $total_peminjam ?>">0</h2>
                                    <p class="text-muted mb-0 fw-medium">Peminjam Terdaftar</p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="px-3">
                                    <h2 class="display-6 fw-bold text-primary-custom mb-1 counter" data-target="<?= $total_transaksi ?>">0</h2>
                                    <p class="text-muted mb-0 fw-medium">Transaksi Berhasil</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 3. Kenapa Memilih Sipanja (Light/White) -->
    <section id="fitur" class="py-5 mt-5">
        <div class="container">
            <div class="text-center max-width-600 mb-5">
                <span class="text-primary-custom fw-bold text-uppercase" style="font-size: 13px; letter-spacing: 1px;">Keunggulan Kami</span>
                <h2 class="fw-bold mt-2 text-dark">Kenapa Memilih Sipanja?</h2>
                <p class="text-muted">Nikmati kemudahan peminjaman alat dengan sistem terintegrasi.</p>
            </div>
            <div class="row g-4">
                <div class="col-md-6 col-lg-3 fade-up-scroll">
                    <div class="card card-custom h-100 p-4 border border-light">
                        <div class="feature-icon-box bg-light-blue">
                            <i class="fas fa-bolt"></i>
                        </div>
                        <h5 class="fw-bold mb-2 text-dark">Proses Cepat</h5>
                        <p class="text-muted mb-0 small">Ajukan peminjaman secara online kapan saja tanpa perlu antre panjang.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3 fade-up-scroll">
                    <div class="card card-custom h-100 p-4 border border-light">
                        <div class="feature-icon-box" style="background-color: rgba(34, 197, 94, 0.1); color: #22c55e;">
                            <i class="fas fa-lock"></i>
                        </div>
                        <h5 class="fw-bold mb-2 text-dark">Aman</h5>
                        <p class="text-muted mb-0 small">Data peminjaman dan informasi inventaris disimpan dengan sistem keamanan terbaik.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3 fade-up-scroll">
                    <div class="card card-custom h-100 p-4 border border-light">
                        <div class="feature-icon-box" style="background-color: rgba(249, 115, 22, 0.1); color: #f97316;">
                            <i class="fas fa-mobile-alt"></i>
                        </div>
                        <h5 class="fw-bold mb-2 text-dark">Responsive</h5>
                        <p class="text-muted mb-0 small">Desain modern yang fleksibel dan nyaman diakses dari HP maupun Laptop.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3 fade-up-scroll">
                    <div class="card card-custom h-100 p-4 border border-light">
                        <div class="feature-icon-box" style="background-color: rgba(139, 92, 246, 0.1); color: #8b5cf6;">
                            <i class="fas fa-chart-line"></i>
                        </div>
                        <h5 class="fw-bold mb-2 text-dark">Monitoring</h5>
                        <p class="text-muted mb-0 small">Pantau status persetujuan dan riwayat pengembalian alat secara real-time.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 4. Cara Peminjaman (Blue Gradient) -->
    <section id="carapinjam" class="py-5 bg-blue-gradient mt-4">
        <div class="container py-4">
            <div class="text-center mb-5">
                <span class="badge bg-white text-primary-custom fw-bold text-uppercase px-3 py-2 rounded-pill mb-3" style="font-size: 12px; letter-spacing: 1px;">Alur Peminjaman</span>
                <h2 class="fw-bold text-white">Bagaimana Cara Kerjanya?</h2>
                <p style="color: rgba(255,255,255,0.8);">Hanya dengan 6 langkah mudah berikut untuk mengajukan peminjaman alat.</p>
            </div>
            
            <div class="row timeline-container mt-5">
                <div class="col-lg-2 col-md-4 col-sm-6 timeline-step fade-up-scroll">
                    <div class="timeline-number">1</div>
                    <div class="timeline-arrow"></div>
                    <h6 class="fw-bold text-white">Login</h6>
                    <p class="small" style="color: rgba(255,255,255,0.8);">Masuk menggunakan akun Anda.</p>
                </div>
                <div class="col-lg-2 col-md-4 col-sm-6 timeline-step fade-up-scroll">
                    <div class="timeline-number">2</div>
                    <div class="timeline-arrow"></div>
                    <h6 class="fw-bold text-white">Pilih Alat</h6>
                    <p class="small" style="color: rgba(255,255,255,0.8);">Cari alat di katalog.</p>
                </div>
                <div class="col-lg-2 col-md-4 col-sm-6 timeline-step fade-up-scroll">
                    <div class="timeline-number">3</div>
                    <div class="timeline-arrow"></div>
                    <h6 class="fw-bold text-white">Ajukan Pinjam</h6>
                    <p class="small" style="color: rgba(255,255,255,0.8);">Isi formulir pengajuan.</p>
                </div>
                <div class="col-lg-2 col-md-4 col-sm-6 timeline-step fade-up-scroll">
                    <div class="timeline-number">4</div>
                    <div class="timeline-arrow"></div>
                    <h6 class="fw-bold text-white">Verifikasi</h6>
                    <p class="small" style="color: rgba(255,255,255,0.8);">Menunggu persetujuan petugas.</p>
                </div>
                <div class="col-lg-2 col-md-4 col-sm-6 timeline-step fade-up-scroll">
                    <div class="timeline-number">5</div>
                    <div class="timeline-arrow"></div>
                    <h6 class="fw-bold text-white">Ambil Alat</h6>
                    <p class="small" style="color: rgba(255,255,255,0.8);">Ambil di lokasi penyimpanan.</p>
                </div>
                <div class="col-lg-2 col-md-4 col-sm-6 timeline-step fade-up-scroll">
                    <div class="timeline-number">6</div>
                    <h6 class="fw-bold text-white">Pengembalian</h6>
                    <p class="small" style="color: rgba(255,255,255,0.8);">Kembalikan alat dalam kondisi baik.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- 5. Daftar Alat (Light/White) -->
    <section id="alat" class="py-5 mt-4">
        <div class="container">
            <div class="text-center mb-5">
                <span class="text-primary-custom fw-bold text-uppercase" style="font-size: 13px; letter-spacing: 1px;">Katalog Inventaris</span>
                <h2 class="fw-bold mt-2 text-dark">Daftar Alat Pilihan</h2>
                <p class="text-muted">Informasi ketersediaan stok terkini yang siap dipinjam.</p>
            </div>
            <div class="row">
                <?php if(empty($alat)): ?>
                    <div class="col-12 text-center text-muted">Belum ada alat yang ditambahkan.</div>
                <?php else: ?>
                    <?php foreach (array_slice($alat, 0, 6) as $a): 
                        $stok_maks = $a['stok'] + ($a['id'] % 3 + 2);
                        $stok_tersedia = $a['stok'];
                        $persen = round(($stok_tersedia / $stok_maks) * 100);
                    ?>
                    <div class="col-md-4 mb-4 fade-up-scroll">
                        <div class="card card-custom h-100 overflow-hidden border border-light">
                            <div class="position-relative">
                                <img src="<?= base_url('assets/img/'.$a['foto_alat']) ?>" alt="<?= $a['nama_alat'] ?>" class="card-img-top" style="height: 200px; object-fit: cover;">
                                <div class="position-absolute top-0 end-0 m-3">
                                    <span class="badge bg-white text-dark shadow-sm px-2 py-1"><?= $a['nama_kategori'] ?></span>
                                </div>
                            </div>
                            <div class="card-body p-4">
                                <h5 class="card-title fw-bold text-dark mb-3"><?= $a['nama_alat'] ?></h5>
                                
                                <div class="mb-3">
                                    <div class="d-flex justify-content-between mb-1">
                                        <span class="text-muted small">Ketersediaan Stok</span>
                                        <span class="fw-bold small text-dark"><?= $stok_tersedia ?>/<?= $stok_maks ?> Unit</span>
                                    </div>
                                    <div class="progress">
                                        <div class="progress-bar <?= $persen > 50 ? 'bg-success' : ($persen > 20 ? 'bg-warning' : 'bg-danger') ?>" role="progressbar" style="width: <?= $persen ?>%" aria-valuenow="<?= $persen ?>" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                                <p class="card-text text-muted small mb-0"><i class="fas fa-info-circle fa-sm me-1 text-primary-custom"></i> Kondisi: <strong class="text-dark"><?= $a['kondisi'] ?></strong></p>
                            </div>
                            <div class="card-footer bg-light border-top-0 pb-4 px-4 pt-3">
                                <?php if($a['stok'] > 0 && $a['status_ketersediaan'] == 'Tersedia'): ?>
                                    <span class="text-success small fw-bold"><i class="fas fa-check-circle me-1"></i> Tersedia</span>
                                <?php else: ?>
                                    <span class="text-danger small fw-bold"><i class="fas fa-times-circle me-1"></i> Tidak Tersedia</span>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
            <div class="text-center mt-4">
                <a href="<?= base_url('auth') ?>" class="btn btn-outline-primary-custom px-4 fw-bold rounded-pill">Lihat Selengkapnya</a>
            </div>
        </div>
    </section>

    <!-- 6. Alat Populer 🔥 (Blue Box inside Light background) -->
    <section id="populer" class="py-5" style="background-color: white;">
        <div class="container">
            <div class="text-center mb-5">
                <span class="text-primary-custom fw-bold text-uppercase" style="font-size: 13px; letter-spacing: 1px;">Paling Dicari</span>
                <h2 class="fw-bold mt-2 text-dark">Alat Populer Bulan Ini 🔥</h2>
                <p class="text-muted">Berikut adalah daftar alat yang paling sering dipinjam oleh pengguna.</p>
            </div>
            
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="card card-custom p-4 border border-light">
                        <div class="list-wrapper">
                            <?php if(empty($alat_populer)): ?>
                                <p class="text-muted text-center py-3 m-0">Belum ada transaksi peminjaman.</p>
                            <?php else: ?>
                                <?php 
                                $badges = ['badge-gold', 'badge-silver', 'badge-bronze'];
                                $trophies = ['🥇', '🥈', '🥉'];
                                $no = 0; 
                                foreach($alat_populer as $ap): 
                                    if ($no >= 3) break;
                                ?>
                                <div class="d-flex align-items-center py-3 border-bottom <?= $no == 2 ? 'border-0 pb-0' : '' ?> <?= $no == 0 ? 'pt-0' : '' ?>">
                                    <div class="popular-badge <?= $badges[$no] ?> me-4">
                                        <?= $trophies[$no] ?>
                                    </div>
                                    <div class="me-3">
                                        <img src="<?= base_url('assets/img/'.$ap['foto_alat']) ?>" alt="<?= $ap['nama_alat'] ?>" class="rounded-3 shadow-sm border" style="width: 65px; height: 65px; object-fit: cover;">
                                    </div>
                                    <div class="flex-grow-1">
                                        <h5 class="fw-bold text-dark mb-1"><?= $ap['nama_alat'] ?></h5>
                                        <span class="badge bg-light text-secondary border"><?= $ap['nama_kategori'] ?></span>
                                    </div>
                                    <div class="text-end">
                                        <h5 class="fw-bold text-primary-custom m-0"><?= $ap['total_pinjam'] ?> Kali</h5>
                                        <small class="text-muted">Dipinjam</small>
                                    </div>
                                </div>
                                <?php 
                                $no++;
                                endforeach; 
                                ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 7. Statistik Grafik (Light) -->
    <section id="statistik" class="py-5 mt-4">
        <div class="container">
            <div class="text-center mb-5">
                <span class="text-primary-custom fw-bold text-uppercase" style="font-size: 13px; letter-spacing: 1px;">Analisis Tren</span>
                <h2 class="fw-bold mt-2 text-dark">Statistik Peminjaman Alat</h2>
                <p class="text-muted">Grafik tren frekuensi peminjaman alat selama beberapa bulan terakhir.</p>
            </div>
            
            <div class="row justify-content-center">
                <div class="col-lg-10 fade-up-scroll">
                    <div class="card card-custom p-4 border border-light bg-white">
                        <div style="height: 350px;">
                            <canvas id="landingChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 8. Testimoni (Blue Gradient) -->
    <section id="testimoni" class="py-5 bg-blue-gradient mt-4">
        <div class="container py-4">
            <div class="text-center mb-5">
                <span class="badge bg-white text-primary-custom fw-bold text-uppercase px-3 py-2 rounded-pill mb-3" style="font-size: 12px; letter-spacing: 1px;">Testimoni</span>
                <h2 class="fw-bold text-white">Apa Kata Mereka?</h2>
                <p style="color: rgba(255,255,255,0.8);">Umpan balik langsung dari pengguna yang telah menggunakan Sipanja.</p>
            </div>
            
            <div class="row g-4 justify-content-center">
                <div class="col-md-6 col-lg-5 fade-up-scroll">
                    <div class="card card-custom p-4 h-100 border-0 shadow-lg">
                        <div class="text-warning mb-3">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                        <p class="text-dark fs-6 fst-italic mb-4">"Sistem sangat membantu proses peminjaman alat. Dulu harus catat manual dan repot cek stok, sekarang tinggal klik dan tunggu persetujuan."</p>
                        <div class="d-flex align-items-center mt-auto">
                            <div class="bg-primary-custom text-white rounded-circle d-flex align-items-center justify-content-center fw-bold" style="width: 48px; height: 48px;">AS</div>
                            <div class="ms-3">
                                <h6 class="fw-bold m-0 text-dark">Andi Saputra</h6>
                                <small class="text-muted">Mahasiswa Peminjam</small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-5 fade-up-scroll">
                    <div class="card card-custom p-4 h-100 border-0 shadow-lg">
                        <div class="text-warning mb-3">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                        <p class="text-dark fs-6 fst-italic mb-4">"Lebih mudah dibanding pencatatan manual. Notifikasinya realtime, pelacakan denda transparan, dan UI-nya sangat ramah pengguna."</p>
                        <div class="d-flex align-items-center mt-auto">
                            <div class="bg-success text-white rounded-circle d-flex align-items-center justify-content-center fw-bold" style="width: 48px; height: 48px;">SN</div>
                            <div class="ms-3">
                                <h6 class="fw-bold m-0 text-dark">Siti Nurhaliza</h6>
                                <small class="text-muted">Dosen / Peminjam Instansi</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 9. FAQ (Light/White) -->
    <section id="faq" class="py-5 mt-4">
        <div class="container">
            <div class="text-center mb-5">
                <span class="text-primary-custom fw-bold text-uppercase" style="font-size: 13px; letter-spacing: 1px;">Pertanyaan Umum</span>
                <h2 class="fw-bold mt-2 text-dark">Frequently Asked Questions</h2>
                <p class="text-muted">Punya pertanyaan? Cari tahu jawaban cepatnya di bawah ini.</p>
            </div>
            
            <div class="row justify-content-center">
                <div class="col-lg-8 fade-up-scroll">
                    <div class="accordion faq-accordion" id="accordionFAQ">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingOne">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    Berapa lama proses persetujuan peminjaman alat?
                                </button>
                            </h2>
                            <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionFAQ">
                                <div class="accordion-body text-muted small border-top">
                                    Proses verifikasi dan persetujuan pengajuan peminjaman biasanya memakan waktu maksimal 1x24 jam sejak pengajuan dikirimkan. Petugas akan meninjau ketersediaan stok serta rencana tanggal pengembalian Anda.
                                </div>
                            </div>
                        </div>
                        
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingTwo">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    Apakah jangka waktu peminjaman alat bisa diperpanjang?
                                </button>
                            </h2>
                            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionFAQ">
                                <div class="accordion-body text-muted small border-top">
                                    Bisa. Perpanjangan jangka waktu peminjaman dapat dikomunikasikan secara langsung ke petugas sebelum masa pinjam berakhir, selama alat tersebut tidak sedang dipesan oleh peminjam lain.
                                </div>
                            </div>
                        </div>
                        
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingThree">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                    Bagaimana jika alat rusak atau hilang selama masa peminjaman?
                                </button>
                            </h2>
                            <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionFAQ">
                                <div class="accordion-body text-muted small border-top">
                                    Peminjam bertanggung jawab penuh atas alat yang dipinjam. Jika terjadi kerusakan atau kehilangan, peminjam akan dikenakan denda sesuai dengan tingkat kerusakan atau penggantian unit alat baru sesuai ketentuan yang berlaku di sistem denda.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 10. CTA Section (Blue) -->
    <div class="container mb-5 fade-up-scroll">
        <section class="cta-section text-center text-lg-start">
            <div class="row align-items-center">
                <div class="col-lg-8 mb-4 mb-lg-0">
                    <h2 class="fw-bold mb-3 text-white">Siap Meminjam Alat?</h2>
                    <p class="mb-0 fs-5" style="color: rgba(255,255,255,0.9);">Ajukan peminjaman sekarang dan nikmati proses yang cepat, praktis, dan terdokumentasi dengan baik.</p>
                </div>
                <div class="col-lg-4 text-center text-lg-end">
                    <a href="<?= base_url('auth') ?>" class="btn btn-light text-primary-custom btn-lg px-5 py-3 fw-bold rounded-pill shadow"><i class="fas fa-sign-in-alt me-2"></i> Login Sekarang</a>
                </div>
            </div>
        </section>
    </div>

    <!-- 11. Footer Profesional -->
    <footer class="py-5 mt-5">
        <div class="container">
            <div class="row gy-4">
                <!-- Kolom 1: Profil Brand -->
                <div class="col-lg-4 col-md-6">
                    <h5 class="fw-bold text-white mb-3"><i class="fas fa-tools text-primary me-2" style="color: #60a5fa !important;"></i> Sipanja</h5>
                    <p class="small text-white-50 lh-lg pe-lg-4">Sistem Peminjaman Alat terpadu berbasis web yang dirancang untuk efisiensi operasional manajemen inventaris, peminjaman, pelacakan, dan verifikasi denda realtime.</p>
                </div>
                <!-- Kolom 2: Navigasi Menu -->
                <div class="col-lg-2 col-md-6 col-6">
                    <h6 class="fw-bold text-white mb-3 text-uppercase" style="font-size: 13px; letter-spacing: 0.5px;">Menu Utama</h6>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="#home" class="small text-white-50">Home</a></li>
                        <li class="mb-2"><a href="#fitur" class="small text-white-50">Keunggulan</a></li>
                        <li class="mb-2"><a href="#alat" class="small text-white-50">Katalog Alat</a></li>
                        <li class="mb-2"><a href="#carapinjam" class="small text-white-50">Alur Pinjam</a></li>
                    </ul>
                </div>
                <!-- Kolom 3: Hubungi Kami -->
                <div class="col-lg-3 col-md-6 col-6">
                    <h6 class="fw-bold text-white mb-3 text-uppercase" style="font-size: 13px; letter-spacing: 0.5px;">Hubungi Kami</h6>
                    <ul class="list-unstyled text-white-50 small">
                        <li class="mb-2 d-flex align-items-center"><i class="far fa-envelope me-2" style="color: #60a5fa;"></i> support@sipanja.id</li>
                        <li class="mb-2 d-flex align-items-center"><i class="fas fa-phone-alt me-2" style="color: #60a5fa;"></i> +62 812-3456-7890</li>
                        <li class="mb-2 d-flex align-items-start"><i class="fas fa-map-marker-alt me-2 mt-1" style="color: #60a5fa;"></i> Kampus Utama Gedung IT Lantai 3, Surabaya</li>
                    </ul>
                </div>
                <!-- Kolom 4: Social Media -->
                <div class="col-lg-3 col-md-6">
                    <h6 class="fw-bold text-white mb-3 text-uppercase" style="font-size: 13px; letter-spacing: 0.5px;">Ikuti Kami</h6>
                    <div class="d-flex gap-2">
                        <a href="https://instagram.com" class="btn btn-outline-light btn-sm rounded-circle d-flex align-items-center justify-content-center" style="width: 38px; height: 38px; border-color: rgba(255,255,255,0.2);"><i class="fab fa-instagram"></i></a>
                        <a href="https://facebook.com" class="btn btn-outline-light btn-sm rounded-circle d-flex align-items-center justify-content-center" style="width: 38px; height: 38px; border-color: rgba(255,255,255,0.2);"><i class="fab fa-facebook-f"></i></a>
                    </div>
                </div>
            </div>
            <hr class="my-4 border-secondary opacity-25">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-center text-white-50 small">
                <p class="mb-0">&copy; <?= date('Y') ?> Sipanja. Seluruh hak cipta dilindungi.</p>
                <div class="d-flex gap-3 mt-3 mt-md-0">
                    <a href="#" class="small text-white-50 hover-white">Kebijakan Privasi</a>
                    <a href="#" class="small text-white-50 hover-white">Syarat & Ketentuan</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap Bundle JS -->
    <script src="<?= base_url('assets/js/bootstrap.bundle.min.js') ?>"></script>

    <!-- Statistik Chart.js -->
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const ctx = document.getElementById('landingChart').getContext('2d');
        const gradient = ctx.createLinearGradient(0, 0, 0, 300);
        gradient.addColorStop(0, 'rgba(10, 63, 214, 0.3)'); 
        gradient.addColorStop(1, 'rgba(10, 63, 214, 0.0)');

        new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli'],
                datasets: [{
                    label: 'Frekuensi Peminjaman Alat',
                    data: [12, 19, 26, 35, 48, 52, 65],
                    borderColor: '#0A3FD6',
                    borderWidth: 3,
                    backgroundColor: gradient,
                    fill: true,
                    tension: 0.35,
                    pointBackgroundColor: '#0A3FD6',
                    pointBorderColor: '#ffffff',
                    pointBorderWidth: 2,
                    pointRadius: 6,
                    pointHoverRadius: 8
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    x: {
                        grid: {
                            display: false
                        },
                        ticks: {
                            color: '#64748b',
                            font: {
                                family: 'Plus Jakarta Sans',
                                weight: '500'
                            }
                        }
                    },
                    y: {
                        grid: {
                            color: '#f1f5f9'
                        },
                        ticks: {
                            color: '#64748b',
                            font: {
                                family: 'Plus Jakarta Sans',
                                weight: '500'
                            }
                        }
                    }
                }
            }
        });

        // 1. Scroll Progress Bar
        window.addEventListener('scroll', function() {
            const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
            const docHeight = document.documentElement.scrollHeight - window.innerHeight;
            const scrollPercent = docHeight > 0 ? (scrollTop / docHeight) * 100 : 0;
            const progressBar = document.getElementById('scroll-progress-bar');
            if (progressBar) {
                progressBar.style.width = scrollPercent + '%';
            }
        });

        // 2. Typed.js Hero Text Effect
        const typedTarget = document.getElementById('typed-text');
        if (typedTarget) {
            const words = ["Praktis", "Cepat", "Mudah", "Aman"];
            let wordIndex = 0;
            let charIndex = 0;
            let isDeleting = false;
            
            // Add cursor span element
            const cursorSpan = document.createElement('span');
            cursorSpan.className = 'typed-cursor';
            cursorSpan.textContent = '|';
            typedTarget.parentNode.insertBefore(cursorSpan, typedTarget.nextSibling);

            function typeEffect() {
                const currentWord = words[wordIndex];
                if (isDeleting) {
                    typedTarget.textContent = currentWord.substring(0, charIndex - 1);
                    charIndex--;
                } else {
                    typedTarget.textContent = currentWord.substring(0, charIndex + 1);
                    charIndex++;
                }

                let typeSpeed = isDeleting ? 75 : 150;

                if (!isDeleting && charIndex === currentWord.length) {
                    typeSpeed = 1500; // Pause at end of word
                    isDeleting = true;
                } else if (isDeleting && charIndex === 0) {
                    isDeleting = false;
                    wordIndex = (wordIndex + 1) % words.length;
                    typeSpeed = 500; // Pause before next word
                }

                setTimeout(typeEffect, typeSpeed);
            }
            typeEffect();
        }

        // 3. Particle Background Hero
        const canvas = document.getElementById('hero-particles');
        if (canvas) {
            const ctx = canvas.getContext('2d');
            let particles = [];

            function resizeCanvas() {
                canvas.width = canvas.parentElement.offsetWidth;
                canvas.height = canvas.parentElement.offsetHeight;
            }
            window.addEventListener('resize', resizeCanvas);
            resizeCanvas();

            class Particle {
                constructor() {
                    this.x = Math.random() * canvas.width;
                    this.y = Math.random() * canvas.height;
                    this.size = Math.random() * 2 + 1;
                    this.speedX = Math.random() * 0.4 - 0.2;
                    this.speedY = Math.random() * -0.4 - 0.1;
                    this.opacity = Math.random() * 0.4 + 0.1;
                }
                update() {
                    this.x += this.speedX;
                    this.y += this.speedY;
                    if (this.y < 0) {
                        this.y = canvas.height;
                        this.x = Math.random() * canvas.width;
                    }
                    if (this.x < 0 || this.x > canvas.width) {
                        this.speedX = -this.speedX;
                    }
                }
                draw() {
                    ctx.fillStyle = `rgba(255, 255, 255, ${this.opacity})`;
                    ctx.beginPath();
                    ctx.arc(this.x, this.y, this.size, 0, Math.PI * 2);
                    ctx.fill();
                }
            }

            for (let i = 0; i < 40; i++) {
                particles.push(new Particle());
            }

            function animateParticles() {
                ctx.clearRect(0, 0, canvas.width, canvas.height);
                particles.forEach(p => {
                    p.update();
                    p.draw();
                });
                requestAnimationFrame(animateParticles);
            }
            animateParticles();
        }

        // 4. Counter Statistics (using IntersectionObserver)
        const counters = document.querySelectorAll('.counter');
        const countObserver = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const counter = entry.target;
                    const target = +counter.getAttribute('data-target');
                    let count = 0;
                    const speed = 100; // speed divider
                    const increment = target / speed;

                    const updateCount = () => {
                        count += increment;
                        if (count < target) {
                            counter.innerText = Math.ceil(count);
                            setTimeout(updateCount, 15);
                        } else {
                            counter.innerText = target;
                        }
                    };
                    updateCount();
                    observer.unobserve(counter);
                }
            });
        }, { threshold: 0.2 });

        counters.forEach(counter => countObserver.observe(counter));

        // 5. Scroll Animation (AOS Alternative using IntersectionObserver)
        const animatedElements = document.querySelectorAll('.fade-up-scroll');
        const scrollObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('appeared');
                    scrollObserver.unobserve(entry.target);
                }
            });
        }, { threshold: 0.1, rootMargin: '0px 0px -50px 0px' });

        animatedElements.forEach(el => scrollObserver.observe(el));
    });
    </script>
</body>
</html>
