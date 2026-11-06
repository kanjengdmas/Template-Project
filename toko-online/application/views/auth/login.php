<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | VERIDIAN Luxury Tech Development</title>
    <script src="<?php echo base_url('assets/js/tailwindcss.js'); ?>"></script>
    <link rel="stylesheet" href="<?php echo base_url('assets/css/all.min.css'); ?>">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'main-bg': '#071210',
                        'sec-dark': '#12352F',
                        'acc-emerald': '#1F8A70',
                        'gold-accent': '#D4AF37',
                        'txt-sec': '#A7B7B3',
                    },
                    boxShadow: {
                        'glow-gold': '0 0 40px rgba(212, 175, 55, 0.2)',
                    }
                }
            }
        }
    </script>
    <link rel="stylesheet" href="<?php echo base_url('assets/css/login.css'); ?>">
</head>
<body class="text-white min-h-screen flex items-center justify-center p-6 relative">
    <div class="aurora-container">
        <div class="aurora-blob blob-1"></div>
        <div class="aurora-blob blob-2"></div>
        <div class="aurora-blob blob-3"></div>
    </div>
    <div class="grain"></div>
    <div id="cursorGlow" class="cursor-glow"></div>

    <!-- Tombol Kembali ke Website -->
    <a href="<?php echo base_url(); ?>" class="absolute top-8 left-8 flex items-center gap-2 text-txt-sec hover:text-gold-accent transition-all duration-300 group z-50 reveal">
        <div class="w-8 h-8 rounded-full border border-gold-accent/30 flex items-center justify-center bg-sec-dark/50 group-hover:bg-gold-accent group-hover:text-main-bg transition-all">
            <i class="fa-solid fa-arrow-left text-xs"></i>
        </div>
        <span class="text-xs font-bold uppercase tracking-widest">Kembali ke Website</span>
    </a>

    <div class="max-w-md w-full glass p-8 md:p-12 rounded-[3rem] reveal relative z-10 overflow-hidden">
        <!-- Shine effect on card -->
        <div class="absolute -top-full -left-full w-full h-full bg-gradient-to-br from-white/10 to-transparent rotate-45 pointer-events-none"></div>

        <div class="text-center mb-10">
            <div class="inline-flex items-center justify-center w-20 h-20 rounded-3xl border-2 border-gold-accent/40 bg-sec-dark/80 text-gold-accent mb-6 shadow-glow-gold relative overflow-hidden group">
                <img src="<?php echo base_url('assets/img/logo.png'); ?>" alt="Logo" class="w-full h-full object-cover relative z-10 transition-transform duration-500 group-hover:scale-110">
                <div class="absolute inset-0 bg-gold-accent opacity-0 group-hover:opacity-10 transition-opacity"></div>
            </div>
            <h1 class="text-3xl font-black tracking-[0.25em] uppercase">VERIDIAN<span class="text-gold-accent">LTD</span></h1>
            <div class="h-[2px] w-16 bg-gradient-to-r from-transparent via-gold-accent to-transparent mx-auto mt-4"></div>
            <p class="text-txt-sec text-xs mt-6 tracking-[0.1em] font-medium opacity-70 uppercase">Login Untuk Melanjutkan</p>
        </div>

        <?php if($this->session->flashdata('error')): ?>
            <div id="alertBox" class="bg-red-500/10 border border-red-500/30 text-red-500 p-4 rounded-2xl text-xs mb-6 text-center backdrop-blur-md">
                <i class="fa-solid fa-triangle-exclamation mr-2"></i> <span id="errorMessage"><?php echo $this->session->flashdata('error'); ?></span>
            </div>
        <?php endif; ?>

        <?php if($this->session->flashdata('success')): ?>
            <div class="bg-green-500/10 border border-green-500/30 text-green-500 p-4 rounded-2xl text-xs mb-6 text-center backdrop-blur-md">
                <i class="fa-solid fa-check-double mr-2"></i> <?php echo $this->session->flashdata('success'); ?>
            </div>
        <?php endif; ?>

        <form id="loginForm" action="<?php echo base_url('auth/login'); ?>" method="POST" class="space-y-6">
            <div class="group">
                <label class="block text-[9px] font-black uppercase tracking-[0.3em] text-gray-500 mb-2 group-focus-within:text-gold-accent transition-colors px-1">Username / Email</label>
                <div class="relative">
                    <i class="fa-solid fa-id-badge absolute left-5 top-1/2 -translate-y-1/2 text-acc-emerald/40 group-focus-within:text-gold-accent transition-colors"></i>
                    <input type="text" name="identity" id="identityInput" required placeholder="Username / Email" 
                        class="w-full bg-white/5 border border-white/5 rounded-2xl py-4 pl-14 pr-4 focus:border-gold-accent/40 outline-none transition-all placeholder:text-gray-700 text-sm focus:bg-white/10">
                </div>
            </div>
            <div class="group">
                <label class="block text-[9px] font-black uppercase tracking-[0.3em] text-gray-500 mb-2 group-focus-within:text-gold-accent transition-colors px-1">Password</label>
                <div class="relative">
                    <i class="fa-solid fa-fingerprint absolute left-5 top-1/2 -translate-y-1/2 text-acc-emerald/40 group-focus-within:text-gold-accent transition-colors"></i>
                    <input type="password" id="password" name="password" required placeholder="Masukan Password Anda" 
                        class="w-full bg-white/5 border border-white/5 rounded-2xl py-4 pl-14 pr-14 focus:border-gold-accent/40 outline-none transition-all placeholder:text-gray-700 text-sm focus:bg-white/10">
                    <button type="button" id="togglePassword" class="absolute right-5 top-1/2 -translate-y-1/2 text-gray-600 hover:text-gold-accent transition-colors">
                        <i class="fa-solid fa-eye" id="eyeIcon"></i>
                    </button>
                </div>
            </div>

            <button type="submit" id="submitBtn" class="w-full bg-gold-accent text-main-bg font-black py-5 rounded-2xl hover:shadow-glow-gold transition-all uppercase tracking-[0.3em] text-[10px] transform hover:-translate-y-1 active:scale-95 group overflow-hidden relative">
                <span id="btnText" class="relative z-10">Login</span>
                <div class="absolute inset-0 bg-white/20 translate-y-full group-hover:translate-y-0 transition-transform duration-300"></div>
            </button>
        </form>

        <div class="text-center mt-10 pt-8 border-t border-white/5">
            <p class="text-gray-500 text-[9px] uppercase tracking-[0.2em]">Belum Terdaftar? <a href="<?php echo base_url('auth/register'); ?>" class="text-gold-accent font-black hover:tracking-[0.3em] transition-all ml-2">Daftar Akun Baru</a></p>
        </div>
    </div>

    <script>
        const LOCKOUT_TIME = <?php echo $this->session->userdata('lockout_time') ?: 0; ?>;
    </script>
    <script src="<?php echo base_url('assets/js/login.js'); ?>"></script>
</body>
</html>
