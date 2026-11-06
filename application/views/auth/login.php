<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - E-Perpus</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?= base_url('assets/css/vendor/bootstrap.min.css') ?>">
    <!-- FontAwesome -->
    <link rel="stylesheet" href="<?= base_url('assets/css/vendor/all.min.css') ?>">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="<?= base_url('assets/css/vendor/sweetalert2.min.css') ?>">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">
    <style>
        body {
            background: linear-gradient(135deg, #1E3A8A 0%, #2563EB 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px 0;
        }
        .login-card {
            border: none;
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(0,0,0,0.05);
            background: white;
            max-width: 450px;
            width: 100%;
        }
        .form-control {
            border-radius: 8px;
            padding: 12px 15px;
            border: 1px solid #E5E7EB;
        }
        .form-control:focus {
            box-shadow: none;
            border-color: var(--primary-color);
        }
        .input-group-text {
            background: transparent;
            border-right: none;
            color: #9CA3AF;
        }
        .form-control.with-icon {
            border-left: none;
        }
        .toggle-password {
            background: transparent;
            border: 1px solid #E5E7EB;
            border-left: none;
            color: #9CA3AF;
            cursor: pointer;
            display: flex;
            align-items: center;
            padding: 0 15px;
            border-top-right-radius: 8px;
            border-bottom-right-radius: 8px;
            transition: color 0.2s, border-color 0.2s;
        }
        .toggle-password:hover {
            color: var(--primary-color);
        }
        .form-control.password-input {
            border-right: none;
        }
        .login-btn {
            padding: 12px;
            border-radius: 8px;
            font-weight: 600;
        }
    </style>
</head>
<body>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 d-flex justify-content-center">
                <div class="login-card p-4 p-md-5">
                    
                    <div class="text-center mb-4">
                        <i class="fas fa-book-reader text-primary" style="font-size: 3.5rem;"></i>
                        <h2 class="fw-bold mt-2 mb-0">E-Perpus</h2>
                    </div>
                    
                    <h4 class="fw-bold mb-1 text-center">Selamat Datang!</h4>
                    <p class="text-muted mb-4 text-center">Silakan login ke akun Anda.</p>
                    
                    <form id="form-login">
                        <div class="mb-3">
                            <label class="form-label fw-medium">Email / Username</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                                <input type="text" name="username" class="form-control with-icon" placeholder="Masukkan email atau username" required>
                            </div>
                        </div>
                        <div class="mb-4">
                            <label class="form-label fw-medium">Password</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                <input type="password" name="password" id="password" class="form-control with-icon password-input" placeholder="Masukkan password" required>
                                <span class="toggle-password" id="toggle-password-btn"><i class="fas fa-eye"></i></span>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary-custom login-btn w-100 mb-3" id="btn-login">
                            Login <i class="fas fa-sign-in-alt ms-2"></i>
                        </button>
                        
                        <div class="text-center mt-3">
                            <p class="text-muted mb-2">Belum punya akun? <a href="<?= base_url('auth/register') ?>" class="text-primary fw-bold text-decoration-none">Daftar di sini</a></p>
                            <a href="<?= base_url() ?>" class="text-muted text-decoration-none small"><i class="fas fa-arrow-left me-1"></i> Kembali ke Beranda</a>
                        </div>
                    </form>
                    
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery & Bootstrap JS -->
    <script src="<?= base_url('assets/js/vendor/jquery-3.6.0.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/vendor/bootstrap.bundle.min.js') ?>"></script>
    <!-- SweetAlert2 -->
    <script src="<?= base_url('assets/js/vendor/sweetalert2.all.min.js') ?>"></script>
    <script>
        $(document).ready(function() {
            let lockoutRemaining = <?= isset($lockout_remaining) ? $lockout_remaining : 0 ?>;
            let countdownInterval = null;

            function startLockoutCountdown(seconds) {
                let btn = $('#btn-login');
                let formInputs = $('#form-login input, #form-login button');
                
                formInputs.prop('disabled', true);
                
                clearInterval(countdownInterval);
                let remaining = seconds;
                btn.html('<i class="fas fa-lock me-2"></i> Terkunci (' + remaining + 's)');
                
                countdownInterval = setInterval(function() {
                    remaining--;
                    if (remaining <= 0) {
                        clearInterval(countdownInterval);
                        btn.html('Login <i class="fas fa-sign-in-alt ms-2"></i>').prop('disabled', false);
                        $('#form-login input').prop('disabled', false);
                    } else {
                        btn.html('<i class="fas fa-lock me-2"></i> Terkunci (' + remaining + 's)');
                    }
                }, 1000);
            }

            if (lockoutRemaining > 0) {
                startLockoutCountdown(lockoutRemaining);
            }

            // Toggle Password Visibility
            $('#toggle-password-btn').on('click', function() {
                let passwordField = $('#password');
                let passwordFieldType = passwordField.attr('type');
                let eyeIcon = $(this).find('i');
                
                if (passwordFieldType === 'password') {
                    passwordField.attr('type', 'text');
                    eyeIcon.removeClass('fa-eye').addClass('fa-eye-slash');
                } else {
                    passwordField.attr('type', 'password');
                    eyeIcon.removeClass('fa-eye-slash').addClass('fa-eye');
                }
            });

            $('#form-login').on('submit', function(e) {
                e.preventDefault();
                let btn = $('#btn-login');
                btn.html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...').prop('disabled', true);

                $.ajax({
                    url: '<?= base_url("auth/process") ?>',
                    type: 'POST',
                    data: $(this).serialize(),
                    dataType: 'json',
                    success: function(response) {
                        if (response.status === 'success') {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil Login!',
                                text: 'Mengalihkan...',
                                timer: 1500,
                                showConfirmButton: false
                            }).then(() => {
                                if (response.role === 'admin') {
                                    window.location.href = '<?= base_url("admin") ?>';
                                } else {
                                    window.location.href = '<?= base_url("anggota") ?>';
                                }
                            });
                        } else if (response.status === 'lockout') {
                            Swal.fire({
                                icon: 'warning',
                                title: 'Akun Dikunci',
                                text: response.message || 'Terlalu banyak percobaan masuk salah!',
                                confirmButtonColor: '#2563EB'
                            });
                            startLockoutCountdown(response.remaining);
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal',
                                text: response.message,
                                confirmButtonColor: '#2563EB'
                            });
                            btn.html('Login <i class="fas fa-sign-in-alt ms-2"></i>').prop('disabled', false);
                        }
                    },
                    error: function() {
                        Swal.fire('Error', 'Terjadi kesalahan sistem.', 'error');
                        btn.html('Login <i class="fas fa-sign-in-alt ms-2"></i>').prop('disabled', false);
                    }
                });
            });
        });
    </script>
</body>
</html>
