<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Klinik Digital - Login</title>
    <!-- Custom fonts for this template-->
    <link href="<?= base_url('assets/css/all.min.css') ?>" rel="stylesheet" type="text/css">
    <link href="<?= base_url('assets/css/outfit.css') ?>" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link href="<?= base_url('assets/css/sb-admin-2.min.css') ?>" rel="stylesheet">
    <!-- Toastr -->
    <link rel="stylesheet" href="<?= base_url('assets/css/toastr.min.css') ?>">
    <link href="<?= base_url('assets/css/login.css') ?>" rel="stylesheet">
</head>
<body>
    <div class="login-wrapper">
        <!-- Sidebar Section -->
        <div class="login-sidebar d-none d-md-flex">
            <div class="sidebar-logo">
                <i class="fa-solid fa-notes-medical"></i> Klinik Digital
            </div>
            <div class="sidebar-content">
                <h2>Solusi Layanan Kesehatan Terpadu</h2>
                <p>Kelola semua keluhan medis, konsultasi dokter, pemeriksaan, dan resep digital Anda dengan aman, cepat, dan mudah.</p>
            </div>
            <div class="sidebar-footer">
                &copy; <?= date('Y') ?> Klinik Digital. All rights reserved.
            </div>
        </div>

        <!-- Form Section -->
        <div class="login-form-section">
            <div class="form-header">
                <h1>Selamat Datang!</h1>
                <p>Silakan masuk menggunakan akun Anda</p>
            </div>

            <form class="user" method="post" action="<?= base_url('auth/login'); ?>">
                <div class="form-input-group">
                    <input type="text" class="form-input-control" id="login" name="login" value="<?= set_value('login'); ?>" placeholder="Username atau Email" required autocomplete="off">
                    <i class="fa-regular fa-user"></i>
                    <?= form_error('login', '<small class="text-danger pl-2 mt-1 d-block">', '</small>'); ?>
                </div>
                
                <div class="form-input-group">
                    <input type="password" class="form-input-control" id="password" name="password" placeholder="Password" required>
                    <i class="fa-solid fa-lock"></i>
                    <i class="fa-regular fa-eye-slash toggle-password" id="togglePassword"></i>
                    <?= form_error('password', '<small class="text-danger pl-2 mt-1 d-block">', '</small>'); ?>
                </div>

                <button type="submit" class="btn-login" id="btnSubmit">
                    Masuk Sekarang
                </button>
            </form>

            <div class="form-footer">
                <div>Belum punya akun? <a href="<?= base_url('auth/register'); ?>">Daftar Disini</a></div>
                <a href="<?= base_url(); ?>" class="back-home"><i class="fa-solid fa-arrow-left"></i> Kembali ke Beranda</a>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="<?= base_url('assets/js/jquery.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/bootstrap.bundle.min.js') ?>"></script>
    <!-- Core plugin JavaScript-->
    <script src="<?= base_url('assets/js/jquery.easing.min.js') ?>"></script>
    <!-- Toastr -->
    <script src="<?= base_url('assets/js/toastr.min.js') ?>"></script>
    <script>
        $(document).ready(function() {
            toastr.options = {
                "closeButton": true,
                "progressBar": true,
                "positionClass": "toast-top-right",
                "timeOut": "4000"
            };
            <?php if ($this->session->flashdata('success')): ?>
                toastr.success("<?= $this->session->flashdata('success') ?>");
            <?php endif; ?>
            <?php if ($this->session->flashdata('error')): ?>
                toastr.error("<?= $this->session->flashdata('error') ?>");
            <?php endif; ?>

            // Toggle Password Visibility
            $('#togglePassword').on('click', function() {
                const passwordField = $('#password');
                const type = passwordField.attr('type') === 'password' ? 'text' : 'password';
                passwordField.attr('type', type);
                $(this).toggleClass('fa-eye-slash fa-eye');
            });

            // Lockout Countdown Logic
            let remainingLockout = <?= isset($remaining_lockout) ? (int)$remaining_lockout : 0; ?>;
            if (remainingLockout > 0) {
                disableLoginForm(remainingLockout);
            }

            function disableLoginForm(seconds) {
                $('.form-input-control').prop('disabled', true);
                $('#btnSubmit').prop('disabled', true).addClass('disabled');
                
                let countdown = seconds;
                const originalBtnText = "Masuk Sekarang";
                
                const interval = setInterval(function() {
                    if (countdown <= 0) {
                        clearInterval(interval);
                        $('.form-input-control').prop('disabled', false);
                        $('#btnSubmit').prop('disabled', false).removeClass('disabled').text(originalBtnText);
                    } else {
                        $('#btnSubmit').text("Terkunci (" + countdown + " detik)");
                        countdown--;
                    }
                }, 1000);
            }
        });
    </script>
</body>
</html>
