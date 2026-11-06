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
    <!-- External Auth CSS -->
    <link rel="stylesheet" href="<?= base_url('assets/css/auth.css') ?>">
</head>
<body>
    <!-- Hidden Base URL for AJAX Requests -->
    <input type="hidden" id="base_url" value="<?= base_url() ?>">

    <div class="login-container w-100">
        
        <!-- Left Side: Hero Image & Features -->
        <div class="login-left">
            <!-- Particle Canvas -->
            <canvas id="login-particles" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; pointer-events: none; z-index: 1;"></canvas>

            <div style="position: relative; z-index: 2;">
                <div>
                    <div class="brand-logo-left"><i class="fas fa-tools"></i> Sipanja</div>
                    <div class="brand-subtitle-left">Sistem Peminjaman Alat</div>
                </div>

                <h1 class="hero-title">Buat Akun Peminjam<br>Sekarang</h1>
                <p class="hero-desc">Lengkapi data diri Anda untuk membuat akun peminjam dan mulai ajukan peminjaman alat dengan mudah.</p>

                <!-- Hero Image Carousel (Auto) -->
                <div id="heroCarousel" class="carousel slide carousel-fade text-center my-4" data-bs-ride="carousel" data-bs-interval="3000" data-bs-pause="false">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="<?= base_url('assets/img/default.png') ?>" alt="Default Alat" class="hero-image bg-white rounded-4 p-2">
                        </div>
                        <div class="carousel-item">
                            <img src="<?= base_url('assets/img/laptop.png') ?>" alt="Laptop" class="hero-image bg-white rounded-4 p-2">
                        </div>
                        <div class="carousel-item">
                            <img src="<?= base_url('assets/img/kamera.png') ?>" alt="Kamera" class="hero-image bg-white rounded-4 p-2">
                        </div>
                        <div class="carousel-item">
                            <img src="<?= base_url('assets/img/proyektor.png') ?>" alt="Proyektor" class="hero-image bg-white rounded-4 p-2">
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
                            <p>Data Anda terlindungi</p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="feature-box">
                        <div class="feature-icon"><i class="fas fa-bolt"></i></div>
                        <div class="feature-text">
                            <h6>Cepat</h6>
                            <p>Proses hanya beberapa detik</p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="feature-box">
                        <div class="feature-icon"><i class="fas fa-user-check"></i></div>
                        <div class="feature-text">
                            <h6>Mudah</h6>
                            <p>Lengkapi data dan siap digunakan</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Side: Register Form -->
        <div class="login-right">
            <div class="login-card" style="max-width: 650px;">
                
                <!-- Header Card -->
                <div class="d-flex align-items-center mb-4">
                    <div class="me-3" style="width: 50px; height: 50px; border-radius: 50%; display: flex; align-items: center; justify-content: center; background-color: rgba(10, 63, 214, 0.1); color: var(--primary-blue); font-size: 1.25rem;">
                        <i class="fas fa-user-plus"></i>
                    </div>
                    <div>
                        <h2 class="welcome-title m-0">Daftar Akun</h2>
                        <p class="welcome-subtitle m-0 mt-1">Sebagai Peminjam di Sipanja</p>
                    </div>
                </div>

                <hr class="border-secondary opacity-10 mb-4">

                <!-- Validation Errors (CodeIgniter) -->
                <?php if(validation_errors()): ?>
                    <div class="alert alert-danger alert-dismissible fade show small py-2 mb-4" role="alert">
                        <i class="fas fa-exclamation-circle me-1"></i> Periksa kembali isian form Anda.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" style="padding: 0.75rem 1rem;"></button>
                    </div>
                <?php endif; ?>

                <form id="registerForm" action="<?= base_url('auth/register') ?>" method="post">
                    
                    <div class="row g-3 mb-1">
                        <div class="col-md-6">
                            <!-- Nama Lengkap Field -->
                            <div class="form-group-custom">
                                <div class="input-group-wrapper">
                                    <i class="fas fa-user field-icon"></i>
                                    <input type="text" name="nama" class="form-control-custom" value="<?= set_value('nama') ?>" required placeholder=" ">
                                    <label class="label-floating">Nama Lengkap</label>
                                </div>
                                <?= form_error('nama', '<small class="text-danger mt-1 d-block">', '</small>') ?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <!-- NIM / NIK Field -->
                            <div class="form-group-custom">
                                <div class="input-group-wrapper">
                                    <i class="fas fa-id-card field-icon"></i>
                                    <input type="text" name="nim_nik" class="form-control-custom" value="<?= set_value('nim_nik') ?>" required placeholder=" ">
                                    <label class="label-floating">NIM / NIK</label>
                                </div>
                                <?= form_error('nim_nik', '<small class="text-danger mt-1 d-block">', '</small>') ?>
                            </div>
                        </div>
                    </div>

                    <div class="row g-3 mb-1">
                        <div class="col-md-6">
                            <!-- Email Field -->
                            <div class="form-group-custom">
                                <div class="input-group-wrapper">
                                    <i class="fas fa-envelope field-icon"></i>
                                    <input type="email" name="email" id="email" class="form-control-custom" value="<?= set_value('email') ?>" required placeholder=" ">
                                    <label class="label-floating">Email</label>
                                </div>
                                <span id="email-error-msg" class="small d-block mt-1" style="font-size: 0.8rem;"></span>
                                <?= form_error('email', '<small class="text-danger mt-1 d-block">', '</small>') ?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <!-- No. Telepon / WhatsApp Field -->
                            <div class="form-group-custom">
                                <div class="input-group-wrapper">
                                    <i class="fas fa-phone-alt field-icon"></i>
                                    <input type="text" name="no_telp" class="form-control-custom" value="<?= set_value('no_telp') ?>" required placeholder=" ">
                                    <label class="label-floating">No. Telepon / WhatsApp</label>
                                </div>
                                <?= form_error('no_telp', '<small class="text-danger mt-1 d-block">', '</small>') ?>
                            </div>
                        </div>
                    </div>

                    <!-- Alamat Lengkap Field (Textarea) -->
                    <div class="form-group-custom mb-3">
                        <div class="input-group-wrapper textarea-wrapper">
                            <i class="fas fa-map-marker-alt field-icon mt-2"></i>
                            <textarea name="alamat" class="form-control-custom" rows="2" required placeholder=" " style="resize: none;"><?= set_value('alamat') ?></textarea>
                            <label class="label-floating">Alamat Lengkap</label>
                        </div>
                        <?= form_error('alamat', '<small class="text-danger mt-1 d-block">', '</small>') ?>
                    </div>

                    <div class="row g-3 mb-1">
                        <div class="col-md-6">
                            <!-- Username Field with AJAX Check -->
                            <div class="form-group-custom">
                                <div class="input-group-wrapper">
                                    <i class="fas fa-user field-icon"></i>
                                    <input type="text" name="username" id="username" class="form-control-custom" value="<?= set_value('username') ?>" required placeholder=" ">
                                    <label class="label-floating">Username</label>
                                    <span id="username-spinner" class="spinner-border spinner-border-sm text-primary d-none ms-2" role="status" style="width: 1rem; height: 1rem;"></span>
                                </div>
                                <span id="username-feedback" class="small d-block mt-1" style="font-size: 0.8rem;"></span>
                                <?= form_error('username', '<small class="text-danger mt-1 d-block">', '</small>') ?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <!-- Password Field with Strength Meter -->
                            <div class="form-group-custom">
                                <div class="input-group-wrapper">
                                    <i class="fas fa-lock field-icon"></i>
                                    <input type="password" name="password" id="password" class="form-control-custom" required placeholder=" ">
                                    <label class="label-floating">Password</label>
                                    <button class="btn-toggle-pass-custom" type="button" id="togglePassword">
                                        <i class="fas fa-eye" id="eyeIcon"></i>
                                    </button>
                                </div>
                                <!-- Password Strength Meter -->
                                <div class="pw-strength-wrapper mt-2 d-none" id="pw-strength-container">
                                    <div class="progress" style="height: 6px; background-color: #e2e8f0; border-radius: 3px;">
                                        <div class="progress-bar" id="pw-strength-bar" role="progressbar" style="width: 0%; border-radius: 3px;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <span class="small fw-semibold mt-1 d-block" id="pw-strength-text" style="font-size: 0.75rem;"></span>
                                </div>
                                <?= form_error('password', '<small class="text-danger mt-1 d-block">', '</small>') ?>
                            </div>
                        </div>
                    </div>

                    <!-- Konfirmasi Password -->
                    <div class="form-group-custom mb-4">
                        <div class="input-group-wrapper">
                            <i class="fas fa-lock field-icon"></i>
                            <input type="password" name="password_confirm" id="password_confirm" class="form-control-custom" required placeholder=" ">
                            <label class="label-floating">Konfirmasi Password</label>
                            <button class="btn-toggle-pass-custom" type="button" id="togglePasswordConfirm">
                                <i class="fas fa-eye" id="eyeIconConfirm"></i>
                            </button>
                        </div>
                        <span id="pw-match-message" class="small fw-semibold d-block mt-1" style="font-size: 0.8rem;"></span>
                    </div>

                    <!-- Info Alert -->
                    <div class="alert border-0 d-flex align-items-center mb-4" style="background-color: #f0f4ff; color: var(--primary-blue); font-size: 0.85rem; border-radius: 8px; padding: 1rem;">
                        <i class="fas fa-info-circle fs-4 me-3"></i>
                        <div>
                            <strong>Pastikan semua data yang Anda masukkan sudah benar.</strong><br>
                            <span class="text-muted" style="font-size: 0.8rem;">Data yang sudah didaftarkan tidak dapat diubah sendiri.</span>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" id="btnRegister" class="btn btn-primary-custom w-100">
                        <i class="fas fa-user-plus me-2"></i> Daftar Sekarang
                    </button>
                </form>

                <div class="divider">atau</div>

                <div class="text-center small" style="color: #64748b;">
                    Sudah punya akun? <a href="<?= base_url('auth') ?>" class="link-custom">Masuk sekarang</a>
                </div>

                <div class="text-center mt-4">
                    <a href="<?= base_url() ?>" class="back-link">
                        <i class="fas fa-arrow-left"></i> Kembali ke Landing Page
                    </a>
                </div>
            </div>
        </div>

    </div>

    <!-- Flash Data Holder for SweetAlert2 -->
    <div id="flash-data" 
         data-error="<?= $this->session->flashdata('error') ?>" 
         data-success="<?= $this->session->flashdata('success') ?>">
    </div>

    <!-- Bootstrap Bundle JS -->
    <script src="<?= base_url('assets/js/bootstrap.bundle.min.js') ?>"></script>
    <!-- Custom Auth JS -->
    <script src="<?= base_url('assets/js/auth.js') ?>"></script>
</body>
</html>
