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
    <!-- SweetAlert2 -->
    <script src="<?= base_url('assets/js/sweetalert2.all.min.js') ?>"></script>
    <!-- Lottie Player -->
    <script src="<?= base_url('assets/js/lottie-player.js') ?>"></script>
    <link rel="stylesheet" href="<?= base_url('assets/css/auth.css') ?>">
</head>
<body>
    <div class="login-container w-100">
        
        <!-- Left Side: Lottie Animation & Features -->
        <div class="login-left">
            <!-- Particle Canvas -->
            <canvas id="login-particles" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; pointer-events: none; z-index: 1;"></canvas>

            <div style="position: relative; z-index: 2;">
                <div>
                    <div class="brand-logo-left"><i class="fas fa-tools"></i> Sipanja</div>
                    <div class="brand-subtitle-left">Sistem Peminjaman Alat</div>
                </div>

                <h1 class="hero-title">Peminjaman Alat<br>Jadi Lebih Mudah</h1>
                <p class="hero-desc">Kelola peminjaman alat dengan cepat, transparan, dan efisien dalam satu sistem terintegrasi.</p>

                <!-- Hero Image Carousel (Auto) -->
                <div id="heroCarousel" class="carousel slide carousel-fade text-center my-4" data-bs-ride="carousel" data-bs-interval="3000" data-bs-pause="false">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="<?= base_url('assets/img/default.png') ?>" alt="Default Alat" class="hero-image bg-white rounded-4 p-2" style="max-height: 300px; object-fit: contain;">
                        </div>
                        <div class="carousel-item">
                            <img src="<?= base_url('assets/img/laptop.png') ?>" alt="Laptop" class="hero-image bg-white rounded-4 p-2" style="max-height: 300px; object-fit: contain;">
                        </div>
                        <div class="carousel-item">
                            <img src="<?= base_url('assets/img/kamera.png') ?>" alt="Kamera" class="hero-image bg-white rounded-4 p-2" style="max-height: 300px; object-fit: contain;">
                        </div>
                        <div class="carousel-item">
                            <img src="<?= base_url('assets/img/proyektor.png') ?>" alt="Proyektor" class="hero-image bg-white rounded-4 p-2" style="max-height: 300px; object-fit: contain;">
                        </div>
                        <div class="carousel-item">
                            <img src="<?= base_url('assets/img/kursi_roda.png') ?>" alt="Kursi Roda" class="hero-image bg-white rounded-4 p-2" style="max-height: 300px; object-fit: contain;">
                        </div>
                        <div class="carousel-item">
                            <img src="<?= base_url('assets/img/tensimeter.png') ?>" alt="Tensimeter" class="hero-image bg-white rounded-4 p-2" style="max-height: 300px; object-fit: contain;">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Features -->
            <div class="row g-4 mt-auto" style="position: relative; z-index: 2;">
                <div class="col-sm-4">
                    <div class="feature-box">
                        <div class="feature-icon"><i class="fas fa-shield-alt"></i></div>
                        <div class="feature-text">
                            <h6>Aman</h6>
                            <p>Data terlindungi dengan aman</p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="feature-box">
                        <div class="feature-icon"><i class="fas fa-bolt"></i></div>
                        <div class="feature-text">
                            <h6>Cepat</h6>
                            <p>Proses peminjaman lebih efisien</p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="feature-box">
                        <div class="feature-icon"><i class="fas fa-chart-bar"></i></div>
                        <div class="feature-text">
                            <h6>Terintegrasi</h6>
                            <p>Semua data tersimpan dalam sistem</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Side: Login Form -->
        <div class="login-right">
            <div class="login-card">
                <div class="brand-logo-right"><i class="fas fa-tools"></i> Sipanja</div>
                <div class="brand-subtitle-right">Sistem Peminjaman Alat</div>

                <h2 class="welcome-title">Selamat Datang Kembali 👋</h2>
                <p class="welcome-subtitle">Silakan login untuk melanjutkan</p>

                <form id="loginForm" action="<?= base_url('auth/process_login') ?>" method="post">
                    
                    <!-- Username / Email Field with Custom Floating Label -->
                    <div class="form-group-custom">
                        <div class="input-group-wrapper">
                            <i class="fas fa-user field-icon"></i>
                            <input type="text" name="username" class="form-control-custom" required placeholder=" " value="<?= set_value('username') ?>">
                            <label class="label-floating">Username atau Email</label>
                        </div>
                    </div>

                    <!-- Password Field with Custom Floating Label -->
                    <div class="form-group-custom">
                        <div class="input-group-wrapper">
                            <i class="fas fa-lock field-icon"></i>
                            <input type="password" name="password" id="password" class="form-control-custom" required placeholder=" ">
                            <label class="label-floating">Password</label>
                            <button class="btn-toggle-pass-custom" type="button" id="togglePassword">
                                <i class="fas fa-eye" id="eyeIcon"></i>
                            </button>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="rememberMe">
                            <label class="form-check-label small" for="rememberMe" style="color: #475569;">
                                Ingat saya
                            </label>
                        </div>
                    </div>

                    <button type="submit" id="btnLogin" class="btn btn-primary-custom w-100">
                        Login <i class="fas fa-arrow-right ms-2"></i>
                    </button>
                </form>

                <div class="divider">atau</div>

                <a href="<?= base_url('auth/register') ?>" class="btn btn-outline-custom w-100 text-decoration-none">
                    <i class="fas fa-user-circle"></i> Belum punya akun? <span class="link-custom ms-1">Daftar sekarang</span>
                </a>

                <div class="text-center mt-4">
                    <a href="<?= base_url() ?>" class="back-link">
                        <i class="fas fa-arrow-left"></i> Kembali ke Landing Page
                    </a>
                </div>
            </div>
        </div>

    </div>

    <!-- Bootstrap Bundle JS -->
    <script src="<?= base_url('assets/js/bootstrap.bundle.min.js') ?>"></script>
    <!-- Flash Data Holder for SweetAlert2 -->
    <div id="flash-data" 
         data-error="<?= $this->session->flashdata('error') ?>" 
         data-success="<?= $this->session->flashdata('success') ?>">
    </div>

    <!-- Custom Auth JS -->
    <script src="<?= base_url('assets/js/auth.js') ?>"></script>
</body>
</html>
