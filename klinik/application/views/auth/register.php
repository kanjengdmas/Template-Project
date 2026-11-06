<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Klinik Digital - Register</title>
    <!-- Custom fonts for this template-->
    <link href="<?= base_url('assets/css/all.min.css') ?>" rel="stylesheet" type="text/css">
    <link href="<?= base_url('assets/css/outfit.css') ?>" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link href="<?= base_url('assets/css/sb-admin-2.min.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/css/register.css') ?>" rel="stylesheet">
</head>
<body>
    <div class="register-wrapper">
        <!-- Sidebar Section -->
        <div class="register-sidebar d-none d-md-flex">
            <div class="sidebar-logo">
                <i class="fa-solid fa-notes-medical"></i> Klinik Digital
            </div>
            <div class="sidebar-content">
                <h2>Mari Mulai Hidup Lebih Sehat</h2>
                <p>Daftarkan diri Anda untuk mengakses fitur riwayat medis, konsultasi dokter pilihan, serta resep obat digital yang terintegrasi secara instan.</p>
            </div>
            <div class="sidebar-footer">
                &copy; <?= date('Y') ?> Klinik Digital. All rights reserved.
            </div>
        </div>

        <!-- Form Section -->
        <div class="register-form-section">
            <div class="form-header">
                <h1>Daftar Akun Baru</h1>
                <p>Silakan lengkapi formulir pendaftaran di bawah ini</p>
            </div>

            <form class="user" method="post" action="<?= base_url('auth/register'); ?>">
                <div class="form-input-group">
                    <input type="text" class="form-input-control" id="nama" name="nama" value="<?= set_value('nama'); ?>" placeholder="Nama Lengkap" required autocomplete="off">
                    <i class="fa-solid fa-signature"></i>
                    <?= form_error('nama', '<small class="text-danger pl-2 mt-1 d-block">', '</small>'); ?>
                </div>

                <div class="form-input-group">
                    <input type="text" class="form-input-control" id="username" name="username" value="<?= set_value('username'); ?>" placeholder="Username" required autocomplete="off">
                    <i class="fa-regular fa-user"></i>
                    <?= form_error('username', '<small class="text-danger pl-2 mt-1 d-block">', '</small>'); ?>
                </div>

                <div class="form-input-group">
                    <input type="email" class="form-input-control" id="email" name="email" value="<?= set_value('email'); ?>" placeholder="Alamat Email" required autocomplete="off">
                    <i class="fa-regular fa-envelope"></i>
                    <?= form_error('email', '<small class="text-danger pl-2 mt-1 d-block">', '</small>'); ?>
                </div>
                
                <div class="form-input-group">
                    <input type="password" class="form-input-control" id="password" name="password" placeholder="Password (Min. 6 Karakter)" required>
                    <i class="fa-solid fa-lock"></i>
                    <i class="fa-regular fa-eye-slash toggle-password" id="togglePassword"></i>
                    <?= form_error('password', '<small class="text-danger pl-2 mt-1 d-block">', '</small>'); ?>
                </div>

                <button type="submit" class="btn-register">
                    Daftar Sekarang
                </button>
            </form>

            <div class="form-footer">
                <div>Sudah punya akun? <a href="<?= base_url('auth/login'); ?>">Login Disini</a></div>
                <a href="<?= base_url(); ?>" class="back-home"><i class="fa-solid fa-arrow-left"></i> Kembali ke Beranda</a>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="<?= base_url('assets/js/jquery.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/bootstrap.bundle.min.js') ?>"></script>
    <!-- Core plugin JavaScript-->
    <script src="<?= base_url('assets/js/jquery.easing.min.js') ?>"></script>
    <script>
        $(document).ready(function() {
            // Toggle Password Visibility
            $('#togglePassword').on('click', function() {
                const passwordField = $('#password');
                const type = passwordField.attr('type') === 'password' ? 'text' : 'password';
                passwordField.attr('type', type);
                $(this).toggleClass('fa-eye-slash fa-eye');
            });
        });
    </script>
</body>
</html>
