<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register | VERIDIAN Luxury Tech</title>
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
    <link rel="stylesheet" href="<?php echo base_url('assets/css/register.css'); ?>">
</head>
<body class="text-white min-h-screen flex items-center justify-center p-6 relative py-20 md:py-32">
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
            <h1 class="text-3xl font-black tracking-[0.25em] uppercase">REGIS<span class="text-gold-accent">TRASI</span></h1>
            <div class="h-[2px] w-16 bg-gradient-to-r from-transparent via-gold-accent to-transparent mx-auto mt-4"></div>
            <p class="text-txt-sec text-xs mt-6 tracking-[0.1em] font-medium opacity-70 uppercase">Daftar Untuk Bergabung</p>
        </div>

        <?php if($this->session->flashdata('error')): ?>
            <div class="bg-red-500/10 border border-red-500/30 text-red-500 p-4 rounded-2xl text-xs mb-6 text-center backdrop-blur-md animate-pulse">
                <i class="fa-solid fa-triangle-exclamation mr-2"></i> <?php echo $this->session->flashdata('error'); ?>
            </div>
        <?php endif; ?>

        <?php if($this->session->flashdata('success')): ?>
            <div class="bg-green-500/10 border border-green-500/30 text-green-500 p-4 rounded-2xl text-xs mb-6 text-center backdrop-blur-md">
                <i class="fa-solid fa-check-double mr-2"></i> <?php echo $this->session->flashdata('success'); ?>
            </div>
        <?php endif; ?>

        <form action="<?php echo base_url('auth/process_register'); ?>" method="POST" class="space-y-5">
            <div class="group">
                <label class="block text-[9px] font-black uppercase tracking-[0.3em] text-gray-500 mb-2 group-focus-within:text-gold-accent transition-colors px-1">Nama Lengkap</label>
                <div class="relative">
                    <i class="fa-solid fa-address-card absolute left-5 top-1/2 -translate-y-1/2 text-acc-emerald/40 group-focus-within:text-gold-accent transition-colors"></i>
                    <input type="text" name="fullname" required placeholder="Nama Lengkap Anda" 
                        class="w-full bg-white/5 border border-white/5 rounded-2xl py-4 pl-14 pr-4 focus:border-gold-accent/40 outline-none transition-all placeholder:text-gray-700 text-sm focus:bg-white/10">
                </div>
            </div>
            <div class="group">
                <label class="block text-[9px] font-black uppercase tracking-[0.3em] text-gray-500 mb-2 group-focus-within:text-gold-accent transition-colors px-1">Alamat Email</label>
                <div class="relative">
                    <i class="fa-solid fa-envelope-open-text absolute left-5 top-1/2 -translate-y-1/2 text-acc-emerald/40 group-focus-within:text-gold-accent transition-colors"></i>
                    <input type="email" name="email" required placeholder="anda@gmail.com" 
                        pattern="[a-zA-Z0-9._%+-]+@gmail\.com$"
                        title="Harap gunakan alamat email @gmail.com"
                        class="w-full bg-white/5 border border-white/5 rounded-2xl py-4 pl-14 pr-4 focus:border-gold-accent/40 outline-none transition-all placeholder:text-gray-700 text-sm focus:bg-white/10">
                </div>
            </div>
            <div class="group">
                <label class="block text-[9px] font-black uppercase tracking-[0.3em] text-gray-500 mb-2 group-focus-within:text-gold-accent transition-colors px-1">Username</label>
                <div class="relative">
                    <i class="fa-solid fa-user-tag absolute left-5 top-1/2 -translate-y-1/2 text-acc-emerald/40 group-focus-within:text-gold-accent transition-colors"></i>
                    <input type="text" name="username" required placeholder="Username Unik" 
                        class="w-full bg-white/5 border border-white/5 rounded-2xl py-4 pl-14 pr-4 focus:border-gold-accent/40 outline-none transition-all placeholder:text-gray-700 text-sm focus:bg-white/10">
                </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="group">
                    <label class="block text-[9px] font-black uppercase tracking-[0.3em] text-gray-500 mb-2 group-focus-within:text-gold-accent transition-colors px-1">Password</label>
                    <div class="relative">
                        <i class="fa-solid fa-lock-open absolute left-5 top-1/2 -translate-y-1/2 text-acc-emerald/40 group-focus-within:text-gold-accent transition-colors"></i>
                        <input type="password" id="password" name="password" required placeholder="••••••••" 
                            class="w-full bg-white/5 border border-white/5 rounded-2xl py-4 pl-14 pr-10 focus:border-gold-accent/40 outline-none transition-all placeholder:text-gray-700 text-sm focus:bg-white/10">
                        <button type="button" class="togglePassword absolute right-4 top-1/2 -translate-y-1/2 text-gray-600 hover:text-gold-accent transition-colors" data-target="password">
                            <i class="fa-solid fa-eye eyeIcon"></i>
                        </button>
                    </div>
                </div>
                <div class="group">
                    <label class="block text-[9px] font-black uppercase tracking-[0.3em] text-gray-500 mb-2 group-focus-within:text-gold-accent transition-colors px-1">Konfirmasi</label>
                    <div class="relative">
                        <i class="fa-solid fa-shield-check absolute left-5 top-1/2 -translate-y-1/2 text-acc-emerald/40 group-focus-within:text-gold-accent transition-colors"></i>
                        <input type="password" id="confirm_password" name="confirm_password" required placeholder="••••••••" 
                            class="w-full bg-white/5 border border-white/5 rounded-2xl py-4 pl-14 pr-10 focus:border-gold-accent/40 outline-none transition-all placeholder:text-gray-700 text-sm focus:bg-white/10">
                        <button type="button" class="togglePassword absolute right-4 top-1/2 -translate-y-1/2 text-gray-600 hover:text-gold-accent transition-colors" data-target="confirm_password">
                            <i class="fa-solid fa-eye eyeIcon"></i>
                        </button>
                    </div>
                </div>
            </div>

            <button type="submit" class="w-full bg-gold-accent text-main-bg font-black py-5 rounded-2xl hover:shadow-glow-gold transition-all uppercase tracking-[0.3em] text-[10px] transform hover:-translate-y-1 active:scale-95 group overflow-hidden relative mt-4">
                <span class="relative z-10">Daftarkan Sekarang</span>
                <div class="absolute inset-0 bg-white/20 translate-y-full group-hover:translate-y-0 transition-transform duration-300"></div>
            </button>
        </form>

        <div class="text-center mt-10 pt-8 border-t border-white/5">
            <p class="text-gray-500 text-[9px] uppercase tracking-[0.2em]">Sudah Jadi Anggota? <a href="<?php echo base_url('auth'); ?>" class="text-gold-accent font-black hover:tracking-[0.3em] transition-all ml-2">Masuk Disini</a></p>
        </div>
    </div>

    <script src="<?php echo base_url('assets/js/register.js'); ?>"></script>
</body>
</html>
