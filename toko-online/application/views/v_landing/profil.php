<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Saya | VERIDIAN Luxury Tech</title>
    <script src="<?php echo base_url('assets/js/tailwindcss.js'); ?>"></script>
    <link rel="stylesheet" href="<?php echo base_url('assets/css/all.min.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/style.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/login.css'); ?>">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'main-bg': '#0B1D1B',
                        'sec-dark': '#12352F',
                        'acc-emerald': '#1F8A70',
                        'gold-accent': '#D4AF37',
                        'txt-main': '#E8F1EF',
                        'txt-sec': '#A7B7B3',
                        'deep-dark': '#071210',
                    },
                    boxShadow: {
                        'glow-gold': '0 0 20px rgba(212, 175, 55, 0.3)',
                        'glow-emerald': '0 0 20px rgba(31, 138, 112, 0.3)',
                    },
                    backgroundImage: {
                        'gradient-luxury': 'linear-gradient(135deg, #1F8A70 0%, #12352F 50%, #0B1D1B 100%)',
                    }
                }
            }
        }
    </script>
    <style>
        body {
            overflow-y: auto !important;
        }
    </style>
</head>
<body class="bg-main-bg text-txt-main selection:bg-acc-emerald selection:text-white overflow-x-hidden pt-28">

    <!-- Interactive Cursor Glow -->
    <div id="cursorGlow" class="cursor-glow"></div>

    <!-- Background Ambient Glow Blobs -->
    <div class="ambient-glow bg-acc-emerald w-[400px] h-[400px] top-[-100px] right-[-100px]"></div>
    <div class="ambient-glow bg-sec-dark w-[500px] h-[500px] top-[40%] left-[-150px]"></div>
    <div class="ambient-glow bg-acc-emerald w-[350px] h-[350px] bottom-[-50px] right-[-50px]"></div>

    <!-- ========================================== -->
    <!-- 1. NAVBAR PREMIUM                          -->
    <!-- ========================================== -->
    <nav id="navbar" class="fixed top-0 left-0 w-full z-50 px-6 lg:px-16 py-5 transition-all duration-300 border-b border-transparent bg-transparent">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <!-- Logo -->
            <a href="<?php echo base_url(); ?>" class="flex items-center space-x-2 group">
                <div class="w-9 h-9 rounded-lg border-2 border-gold-accent flex items-center justify-center bg-sec-dark/80 group-hover:shadow-glow-gold transition-all duration-300 overflow-hidden">
                    <img src="<?php echo base_url('assets/img/logo.png'); ?>" alt="Logo" class="w-full h-full object-cover">
                </div>
                <span class="text-2xl font-bold tracking-wider text-white group-hover:text-gold-accent transition-all duration-300">
                    VERIDIAN<span class="text-gold-accent">LTD</span>
                </span>
            </a>

            <!-- Menu Links (Desktop) -->
            <ul class="hidden md:flex space-x-8 font-medium text-sm tracking-wider text-txt-sec">
                <li><a href="<?php echo base_url(); ?>" class="hover:text-white transition-all duration-300 relative group">HOME<span class="absolute left-0 bottom-[-4px] w-0 h-[2px] bg-gold-accent group-hover:w-full transition-all duration-300"></span></a></li>
                <li><a href="<?php echo base_url('landing/produk'); ?>" class="hover:text-white transition-all duration-300 relative group">PRODUK<span class="absolute left-0 bottom-[-4px] w-0 h-[2px] bg-gold-accent group-hover:w-full transition-all duration-300"></span></a></li>
                <li><a href="<?php echo base_url('landing/layanan'); ?>" class="hover:text-white transition-all duration-300 relative group">LAYANAN<span class="absolute left-0 bottom-[-4px] w-0 h-[2px] bg-gold-accent group-hover:w-full transition-all duration-300"></span></a></li>
                <li><a href="<?php echo base_url('landing/tim'); ?>" class="hover:text-white transition-all duration-300 relative group">TIM KAMI<span class="absolute left-0 bottom-[-4px] w-0 h-[2px] bg-gold-accent group-hover:w-full transition-all duration-300"></span></a></li>
                <li><a href="<?php echo base_url('landing/kontak'); ?>" class="hover:text-white transition-all duration-300 relative group">KONTAK KAMI<span class="absolute left-0 bottom-[-4px] w-0 h-[2px] bg-gold-accent group-hover:w-full transition-all duration-300"></span></a></li>
                <li><a href="<?php echo base_url('landing/tentang'); ?>" class="hover:text-white transition-all duration-300 relative group">TENTANG KAMI<span class="absolute left-0 bottom-[-4px] w-0 h-[2px] bg-gold-accent group-hover:w-full transition-all duration-300"></span></a></li>
            </ul>

            <!-- CTA Button & Cart -->
            <div class="hidden md:flex items-center gap-6">
                <a href="<?php echo base_url('landing/cart_view'); ?>" class="relative text-txt-sec hover:text-white transition-colors">
                    <i class="fa-solid fa-cart-shopping text-xl"></i>
                    <?php if($cart_count > 0): ?>
                        <span class="absolute -top-2 -right-2 bg-gold-accent text-main-bg text-[10px] font-bold w-4 h-4 rounded-full flex items-center justify-center"><?php echo $cart_count; ?></span>
                    <?php endif; ?>
                </a>
                
                <?php if($this->session->userdata('user_id')): ?>
                    <!-- Premium Profile Dropdown -->
                    <div class="relative group">
                        <button class="flex items-center gap-3 py-1.5 pl-2 pr-4 rounded-full border border-gold-accent/30 bg-sec-dark/50 hover:bg-sec-dark/80 transition-all focus:outline-none">
                            <div class="w-8 h-8 rounded-full bg-gradient-luxury flex items-center justify-center border border-gold-accent text-gold-accent font-bold text-sm uppercase overflow-hidden">
                                <?php if (!empty($this->session->userdata('user_image'))): ?>
                                    <img src="<?php echo base_url('assets/uploads/avatars/').$this->session->userdata('user_image'); ?>" class="w-full h-full object-cover">
                                <?php else: ?>
                                    <?php echo substr($this->session->userdata('fullname'), 0, 1); ?>
                                <?php endif; ?>
                            </div>
                            <div class="text-left">
                                <p class="text-[10px] text-txt-sec leading-none">Halo,</p>
                                <p class="text-xs font-semibold text-white max-w-[100px] truncate leading-tight mt-0.5"><?php echo $this->session->userdata('fullname'); ?></p>
                            </div>
                            <i class="fa-solid fa-chevron-down text-[10px] text-gold-accent ml-1 group-hover:rotate-180 transition-transform duration-300"></i>
                        </button>
                        <!-- Dropdown Menu -->
                        <div class="absolute right-0 top-full pt-2 w-48 hidden group-hover:block transition-all duration-300 z-50">
                            <div class="rounded-xl bg-deep-dark/95 border border-gold-accent/20 shadow-glow-emerald backdrop-blur-md">
                                <div class="p-4 border-b border-white/5">
                                    <p class="text-xs text-txt-sec">Masuk Sebagai:</p>
                                    <p class="text-sm font-bold text-white truncate"><?php echo $this->session->userdata('fullname'); ?></p>
                                    <span class="inline-block mt-1 px-2 py-0.5 rounded bg-gold-accent/20 text-gold-accent text-[9px] font-bold uppercase tracking-wider">Customer</span>
                                </div>
                                <div class="p-2">
                                    <a href="<?php echo base_url('landing/profil'); ?>" class="flex items-center gap-2 px-3 py-2 rounded-lg text-sm text-white bg-sec-dark/30 transition-all">
                                        <i class="fa-solid fa-user-gear text-xs text-gold-accent"></i> Profil Saya
                                    </a>
                                    <a href="<?php echo base_url('landing/pesanan'); ?>" class="flex items-center gap-2 px-3 py-2 rounded-lg text-sm text-txt-sec hover:text-white hover:bg-sec-dark/30 transition-all">
                                        <i class="fa-solid fa-box-open text-xs text-gold-accent"></i> Pesanan Saya
                                    </a>
                                    <hr class="my-1 border-white/5">
                                    <a href="<?php echo base_url('auth/logout'); ?>" class="flex items-center gap-2 px-3 py-2 rounded-lg text-sm text-red-400 hover:text-white hover:bg-red-500/20 transition-all">
                                        <i class="fa-solid fa-right-from-bracket text-xs"></i> Logout
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Mobile Cart & Menu Button -->
            <div class="flex md:hidden items-center gap-4">
                <a href="<?php echo base_url('landing/cart_view'); ?>" class="relative text-txt-sec hover:text-white transition-colors">
                    <i class="fa-solid fa-cart-shopping text-xl"></i>
                    <?php if($cart_count > 0): ?>
                        <span class="absolute -top-2 -right-2 bg-gold-accent text-main-bg text-[10px] font-bold w-4 h-4 rounded-full flex items-center justify-center"><?php echo $cart_count; ?></span>
                    <?php endif; ?>
                </a>
                <button id="btn-mobile-menu" class="text-white text-2xl focus:outline-none hover:text-gold-accent transition-colors">
                    <i class="fa-solid fa-bars-staggered"></i>
                </button>
            </div>
        </div>
        
        <!-- Mobile Menu Dropdown -->
        <div id="mobile-menu" class="hidden md:hidden absolute top-full left-0 w-full glass flex-col p-6 space-y-4 text-center font-medium text-sm tracking-wider border-b border-acc-emerald/20">
            <a href="<?php echo base_url(); ?>" class="text-txt-main hover:text-gold-accent py-2 transition-colors">HOME</a>
            <a href="<?php echo base_url('landing/produk'); ?>" class="text-txt-main hover:text-gold-accent py-2 transition-colors">PRODUK</a>
            <a href="<?php echo base_url('landing/layanan'); ?>" class="text-txt-main hover:text-gold-accent py-2 transition-colors">LAYANAN</a>
            <a href="<?php echo base_url('landing/tim'); ?>" class="text-txt-main hover:text-gold-accent py-2 transition-colors">TIM KAMI</a>
            <a href="<?php echo base_url('landing/kontak'); ?>" class="text-txt-main hover:text-gold-accent py-2 transition-colors">KONTAK</a>
            <a href="<?php echo base_url('landing/tentang'); ?>" class="text-txt-main hover:text-gold-accent py-2 transition-colors">TENTANG KAMI</a>
            <a href="<?php echo base_url('landing/cart_view'); ?>" class="text-txt-main hover:text-gold-accent py-2 transition-colors flex items-center justify-center gap-2">
                <i class="fa-solid fa-cart-shopping text-gold-accent text-xs"></i> 
                KERANJANG 
                <?php if($cart_count > 0): ?>
                    <span class="bg-gold-accent text-main-bg text-[10px] font-bold px-1.5 py-0.5 rounded-full ml-1"><?php echo $cart_count; ?></span>
                <?php endif; ?>
            </a>
            
            <?php if($this->session->userdata('user_id')): ?>
                <hr class="border-white/10 my-2">
                <div class="flex flex-col items-center py-2 space-y-2">
                    <div class="w-12 h-12 rounded-full bg-gradient-luxury flex items-center justify-center border border-gold-accent text-gold-accent font-bold text-lg uppercase overflow-hidden">
                        <?php if (!empty($this->session->userdata('user_image'))): ?>
                            <img src="<?php echo base_url('assets/uploads/avatars/').$this->session->userdata('user_image'); ?>" class="w-full h-full object-cover">
                        <?php else: ?>
                            <?php echo substr($this->session->userdata('fullname'), 0, 1); ?>
                        <?php endif; ?>
                    </div>
                    <div class="text-center">
                        <p class="text-sm font-bold text-white"><?php echo $this->session->userdata('fullname'); ?></p>
                        <p class="text-[10px] text-gold-accent font-semibold uppercase tracking-widest mt-0.5">Premium Member</p>
                    </div>
                </div>
                <a href="<?php echo base_url('landing/profil'); ?>" class="text-txt-main hover:text-gold-accent py-2 transition-colors flex items-center justify-center gap-2"><i class="fa-solid fa-user-gear text-gold-accent text-xs"></i> PROFIL SAYA</a>
                <a href="<?php echo base_url('landing/pesanan'); ?>" class="text-txt-main hover:text-gold-accent py-2 transition-colors flex items-center justify-center gap-2"><i class="fa-solid fa-box-open text-gold-accent text-xs"></i> PESANAN SAYA</a>
                
                <a href="<?php echo base_url('auth/logout'); ?>" class="inline-block mt-2 px-6 py-3 rounded-full bg-red-500 text-white font-bold tracking-wide text-center mx-auto w-full max-w-xs transition-all hover:bg-red-600">
                    LOGOUT
                </a>
            <?php else: ?>
                <a href="<?php echo base_url('auth'); ?>" class="inline-block mt-2 px-6 py-3 rounded-full bg-gold-accent text-main-bg font-bold tracking-wide text-center mx-auto w-full max-w-xs shadow-glow-gold">
                    LOGIN
                </a>
            <?php endif; ?>
        </div>
    </nav>

    <!-- ========================================== -->
    <!-- 2. MAIN LAYOUT PROFILE                     -->
    <!-- ========================================== -->
    <div class="max-w-[95%] xl:max-w-[1550px] mx-auto px-4 md:px-8 py-10 relative z-10">
        
        <!-- Header Banner / Hero Card -->
        <div class="reveal glass border border-gold-accent/20 rounded-[2.5rem] p-8 md:p-12 mb-10 flex flex-col md:flex-row items-center justify-between gap-8 relative overflow-hidden shadow-glow-emerald">
            <!-- Left background radial light -->
            <div class="absolute -left-10 -top-10 w-48 h-48 bg-acc-emerald/20 blur-3xl rounded-full"></div>
            <!-- Right background phone artwork -->
            <div class="absolute right-0 top-0 h-full w-1/3 opacity-[0.08] pointer-events-none hidden md:block" style="background-image: url('<?php echo base_url(); ?>assets/img/hero.png'); background-size: contain; background-repeat: no-repeat; background-position: right;"></div>
            
            <div class="flex flex-col md:flex-row items-center gap-6 relative z-10">
                <!-- Circular Avatar Form -->
                <form id="avatarForm" action="<?php echo base_url('landing/upload_avatar'); ?>" method="POST" enctype="multipart/form-data" class="m-0">
                    <input type="file" id="avatarInput" name="avatar" class="hidden" accept="image/*" onchange="document.getElementById('avatarForm').submit()">
                    <div class="relative group cursor-pointer" onclick="document.getElementById('avatarInput').click()" title="Klik untuk ubah foto profil">
                        <div class="w-24 h-24 rounded-full bg-gradient-to-tr from-sec-dark to-main-bg flex items-center justify-center border-2 border-gold-accent text-gold-accent font-bold text-4xl uppercase shadow-glow-gold overflow-hidden transition-all duration-300 group-hover:border-white">
                            <?php if (!empty($user['image'])): ?>
                                <img src="<?php echo base_url('assets/uploads/avatars/').$user['image']; ?>" class="w-full h-full object-cover">
                            <?php else: ?>
                                <?php echo substr($user['fullname'], 0, 1); ?>
                            <?php endif; ?>
                        </div>
                        <div class="absolute bottom-0 right-0 w-8 h-8 rounded-full bg-gold-accent text-main-bg flex items-center justify-center border-2 border-main-bg transition-transform group-hover:scale-110">
                            <i class="fa-solid fa-camera text-xs"></i>
                        </div>
                    </div>
                </form>
                <div class="text-center md:text-left">
                    <h2 class="text-2xl sm:text-3xl font-extrabold text-white mb-2">Halo, <?php echo $user['fullname']; ?> 👋</h2>
                    <p class="text-sm text-txt-sec mb-3">Kelola informasi akun, alamat, nomor telepon, dan preferensi kamu</p>
                    <div class="flex flex-wrap gap-3 items-center justify-center md:justify-start">
                        
                        <span class="text-xs text-txt-sec">
                            • &nbsp;Bergabung sejak 
                            <?php 
                            if (!empty($user['created_at'])) {
                                $date = strtotime($user['created_at']);
                                $months = [
                                    1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April', 5 => 'Mei', 6 => 'Juni',
                                    7 => 'Juli', 8 => 'Agustus', 9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'
                                ];
                                $day = (int)date('d', $date);
                                $month_num = (int)date('m', $date);
                                $year = date('Y', $date);
                                echo $day . ' ' . $months[$month_num] . ' ' . $year;
                            } else {
                                echo '12 Januari 2024';
                            }
                            ?>
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <!-- 4 Row Stats Cards -->
        <div class="reveal grid grid-cols-2 md:grid-cols-4 gap-4 mb-10">
            <?php
                $total_orders = count($orders);
                $total_items = 0;
                $pending_payment = 0;
                $shipped = 0;
                $completed = 0;
                foreach ($orders as $o) {
                    $status = strtolower($o['status']);
                    if ($status == 'pending' || $status == 'menunggu pembayaran' || $status == 'belum bayar') $pending_payment++;
                    elseif ($status == 'shipping' || $status == 'dikirim' || $status == 'processed' || $status == 'diproses') $shipped++;
                    elseif ($status == 'completed' || $status == 'selesai') $completed++;

                    if (!empty($o['items'])) {
                        foreach ($o['items'] as $item) {
                            $total_items += $item['quantity'];
                        }
                    }
                }
            ?>
            <!-- Stat 1 -->
            <div class="glass border border-white/5 rounded-2xl p-4 flex items-center gap-4 hover:border-gold-accent/30 transition-all">
                <div class="w-10 h-10 rounded-xl bg-gold-accent/10 border border-gold-accent/20 flex items-center justify-center text-gold-accent text-lg shrink-0">
                    <i class="fa-solid fa-bag-shopping"></i>
                </div>
                <div>
                    <p class="text-[10px] text-txt-sec uppercase tracking-wider leading-tight">Total Barang Dibeli</p>
                    <p class="text-lg font-bold text-white mt-0.5"><?php echo $total_items; ?></p>
                </div>
            </div>
            <!-- Stat 2 -->
            <div class="glass border border-white/5 rounded-2xl p-4 flex items-center gap-4 hover:border-gold-accent/30 transition-all">
                <div class="w-10 h-10 rounded-xl bg-amber-500/10 border border-amber-500/20 flex items-center justify-center text-amber-400 text-lg shrink-0">
                    <i class="fa-solid fa-wallet"></i>
                </div>
                <div>
                    <p class="text-[10px] text-txt-sec uppercase tracking-wider leading-tight">Menunggu</p>
                    <p class="text-lg font-bold text-white mt-0.5"><?php echo $pending_payment; ?></p>
                </div>
            </div>
            <!-- Stat 3 -->
            <div class="glass border border-white/5 rounded-2xl p-4 flex items-center gap-4 hover:border-gold-accent/30 transition-all">
                <div class="w-10 h-10 rounded-xl bg-sky-500/10 border border-sky-500/20 flex items-center justify-center text-sky-400 text-lg shrink-0">
                    <i class="fa-solid fa-truck-fast"></i>
                </div>
                <div>
                    <p class="text-[10px] text-txt-sec uppercase tracking-wider leading-tight">Dikirim</p>
                    <p class="text-lg font-bold text-white mt-0.5"><?php echo $shipped; ?></p>
                </div>
            </div>
            <!-- Stat 4 -->
            <div class="glass border border-white/5 rounded-2xl p-4 flex items-center gap-4 hover:border-gold-accent/30 transition-all">
                <div class="w-10 h-10 rounded-xl bg-emerald-500/10 border border-emerald-500/20 flex items-center justify-center text-emerald-400 text-lg shrink-0">
                    <i class="fa-solid fa-circle-check"></i>
                </div>
                <div>
                    <p class="text-[10px] text-txt-sec uppercase tracking-wider leading-tight">Selesai</p>
                    <p class="text-lg font-bold text-white mt-0.5"><?php echo $completed; ?></p>
                </div>
            </div>

        </div>

        <!-- Success Notification Alert -->
        <?php if($this->session->flashdata('success')): ?>
            <div class="mb-8 p-4 rounded-2xl bg-emerald-500/10 border border-emerald-500/30 text-emerald-400 text-sm flex items-center gap-3">
                <i class="fa-solid fa-circle-check text-base"></i>
                <span><?php echo $this->session->flashdata('success'); ?></span>
            </div>
        <?php endif; ?>

        <!-- Side-by-Side Content Grid -->
        <div class="grid lg:grid-cols-2 gap-8 items-start">
            
            <!-- Profile Info Detail Card -->
            <div class="reveal reveal-left glass border border-white/5 rounded-[2rem] p-8">
                    <div class="flex items-center justify-between mb-6 pb-4 border-b border-white/5">
                        <h3 class="text-lg font-bold text-white flex items-center gap-2">
                            <i class="fa-solid fa-address-card text-gold-accent"></i> Informasi Profil
                        </h3>
                        <button type="button" data-modal-target="editProfileModal" class="text-xs text-gold-accent hover:underline flex items-center gap-1.5 font-semibold">
                            <i class="fa-solid fa-pen-to-square"></i> Edit Profil
                        </button>
                    </div>

                    <div class="grid md:grid-cols-2 gap-8 mb-8 text-sm">
                        <!-- Account Specific Info -->
                        <div class="space-y-4">
                            <div class="flex items-start gap-3">
                                <div class="w-8 h-8 rounded-lg bg-white/5 flex items-center justify-center text-gold-accent shrink-0"><i class="fa-solid fa-user-tie"></i></div>
                                <div>
                                    <p class="text-[10px] text-txt-sec uppercase tracking-wider leading-none">Nama Lengkap</p>
                                    <p class="font-bold text-white mt-1.5"><?php echo $user['fullname']; ?></p>
                                </div>
                            </div>
                            <div class="flex items-start gap-3">
                                <div class="w-8 h-8 rounded-lg bg-white/5 flex items-center justify-center text-gold-accent shrink-0"><i class="fa-solid fa-envelope"></i></div>
                                <div>
                                    <p class="text-[10px] text-txt-sec uppercase tracking-wider leading-none">Email</p>
                                    <p class="font-bold text-white mt-1.5"><?php echo $user['email']; ?></p>
                                </div>
                            </div>
                            <div class="flex items-start gap-3">
                                <div class="w-8 h-8 rounded-lg bg-white/5 flex items-center justify-center text-gold-accent shrink-0"><i class="fa-solid fa-phone"></i></div>
                                <div>
                                    <p class="text-[10px] text-txt-sec uppercase tracking-wider leading-none">Nomor Telepon</p>
                                    <p class="font-bold text-white mt-1.5">
                                        <?php 
                                        if (!empty($user['phone'])) {
                                            $clean_phone = preg_replace('/[^0-9]/', '', $user['phone']);
                                            echo htmlspecialchars(implode('-', str_split($clean_phone, 4)));
                                        } else {
                                            echo '<span class="text-white/40 font-normal italic">Belum diisi</span>';
                                        }
                                        ?>
                                    </p>
                                </div>
                            </div>
                            
                        </div>

                        <!-- Address Info -->
                        <div class="space-y-4">
                            <div class="flex items-start gap-3">
                                <div class="w-8 h-8 rounded-lg bg-white/5 flex items-center justify-center text-gold-accent shrink-0"><i class="fa-solid fa-location-dot"></i></div>
                                <div>
                                    <p class="text-[10px] text-txt-sec uppercase tracking-wider leading-none">Alamat Utama</p>
                                    <p class="font-bold text-white mt-1.5 leading-relaxed">
                                        <?php echo !empty($user['address']) ? nl2br(htmlspecialchars($user['address'])) : '<span class="text-white/40 font-normal italic">Belum diisi</span>'; ?>
                                    </p>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>

                <!-- Recent Orders History List -->
                <div class="reveal reveal-right glass border border-white/5 rounded-[2rem] p-8">
                    <div class="flex items-center justify-between mb-6 pb-4 border-b border-white/5">
                        <h3 class="text-lg font-bold text-white flex items-center gap-2">
                            <i class="fa-solid fa-clock-rotate-left text-gold-accent"></i> Pesanan Terbaru
                        </h3>
                        <a href="<?php echo base_url('landing/pesanan'); ?>" class="text-xs text-gold-accent hover:underline flex items-center gap-1 font-semibold">
                            Lihat Semua <i class="fa-solid fa-chevron-right text-[10px]"></i>
                        </a>
                    </div>

                    <style>
                        .custom-scrollbar::-webkit-scrollbar { width: 4px; height: 6px; }
                        .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
                        .custom-scrollbar::-webkit-scrollbar-thumb { background: rgba(212, 175, 55, 0.2); border-radius: 10px; }
                        .custom-scrollbar::-webkit-scrollbar-thumb:hover { background: rgba(212, 175, 55, 0.5); }
                        
                        .custom-scrollbar-mini::-webkit-scrollbar { width: 3px; }
                        .custom-scrollbar-mini::-webkit-scrollbar-track { background: transparent; }
                        .custom-scrollbar-mini::-webkit-scrollbar-thumb { background: rgba(212, 175, 55, 0.15); border-radius: 10px; }
                    </style>
                    <div class="flex flex-col md:flex-row gap-4 max-h-[500px] overflow-y-auto md:max-h-none md:overflow-x-auto md:overflow-y-hidden pb-2 md:pb-4 pr-1 md:pr-0 w-full custom-scrollbar" style="scrollbar-width: thin; scrollbar-color: rgba(212, 175, 55, 0.2) transparent;">
                        <?php if(empty($orders)): ?>
                            <p class="text-sm text-txt-sec text-center py-6 w-full">Belum ada riwayat pesanan.</p>
                        <?php else: ?>
                            <?php $i = 0; foreach ($orders as $o): if($i++ >= 10) break; ?>
                                <div class="glass border border-white/5 rounded-2xl p-5 flex flex-col justify-between w-full md:w-[320px] shrink-0 hover:border-gold-accent/20 transition-all">
                                    <div class="flex flex-col gap-3">
                                        <!-- Invoice Header -->
                                        <div class="flex items-center justify-between pb-3 border-b border-white/5">
                                            <span class="text-xs font-bold text-txt-sec">Invoice #<?php echo $o['id']; ?></span>
                                            <span class="text-[10px] text-txt-sec"><?php echo date('d M Y', strtotime($o['order_date'])); ?></span>
                                        </div>
                                        
                                        <!-- Items List (Scrollable if too long) -->
                                        <div class="space-y-3 max-h-[140px] overflow-y-auto pr-1 custom-scrollbar-mini">
                                            <?php if(!empty($o['items'])): ?>
                                                <?php foreach($o['items'] as $item): ?>
                                                <div class="flex items-center gap-3">
                                                    <div class="w-10 h-10 rounded-lg bg-white/5 flex items-center justify-center border border-white/5 overflow-hidden shrink-0">
                                                        <?php if(!empty($item['image'])): ?>
                                                            <img src="<?php echo base_url('assets/img/').$item['image']; ?>" class="w-7 h-7 object-contain">
                                                        <?php else: ?>
                                                            <i class="fa-solid fa-mobile-screen-button text-gold-accent text-sm"></i>
                                                        <?php endif; ?>
                                                    </div>
                                                    <div class="min-w-0 flex-1">
                                                        <p class="text-xs font-bold text-white truncate"><?php echo htmlspecialchars($item['name']); ?></p>
                                                        <p class="text-[10px] text-txt-sec"><?php echo $item['quantity']; ?> x Rp <?php echo number_format($item['price'], 0, ',', '.'); ?></p>
                                                    </div>
                                                </div>
                                                <?php endforeach; ?>
                                            <?php else: ?>
                                                <div class="flex items-center gap-3">
                                                    <div class="w-10 h-10 rounded-lg bg-white/5 flex items-center justify-center border border-white/5 overflow-hidden shrink-0">
                                                        <?php if(!empty($o['product_image'])): ?>
                                                            <img src="<?php echo base_url('assets/img/').$o['product_image']; ?>" class="w-7 h-7 object-contain">
                                                        <?php else: ?>
                                                            <i class="fa-solid fa-mobile-screen-button text-gold-accent text-sm"></i>
                                                        <?php endif; ?>
                                                    </div>
                                                    <div class="min-w-0 flex-1">
                                                        <p class="text-xs font-bold text-white truncate">Pesanan #<?php echo $o['id']; ?></p>
                                                    </div>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    
                                    <!-- Footer / Pricing and Status -->
                                    <div class="mt-4 pt-3 border-t border-white/5 flex flex-col gap-3">
                                        <div class="flex items-center justify-between">
                                            <div>
                                                <?php
                                                    $status = strtolower($o['status']);
                                                    if ($status == 'completed' || $status == 'selesai') {
                                                        echo '<span class="px-2.5 py-1 rounded-full bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 text-[10px] font-semibold">Selesai</span>';
                                                    } elseif ($status == 'shipping' || $status == 'dikirim' || $status == 'processed' || $status == 'diproses') {
                                                        echo '<span class="px-2.5 py-1 rounded-full bg-sky-500/10 border border-sky-500/20 text-sky-400 text-[10px] font-semibold">Dikirim</span>';
                                                    } elseif ($status == 'cancelled' || $status == 'batal') {
                                                        echo '<span class="px-2.5 py-1 rounded-full bg-red-500/10 border border-red-500/20 text-red-400 text-[10px] font-semibold">Batal</span>';
                                                    } else {
                                                        echo '<span class="px-2.5 py-1 rounded-full bg-amber-500/10 border border-amber-500/20 text-amber-400 text-[10px] font-semibold">Menunggu Pembayaran</span>';
                                                    }
                                                ?>
                                            </div>
                                            <p class="text-xs font-bold text-white">Rp <?php echo number_format($o['total_amount'], 0, ',', '.'); ?></p>
                                        </div>
                                        <a href="<?php echo base_url('landing/nota/').$o['id']; ?>" class="block text-center text-xs font-bold text-gold-accent border border-gold-accent/20 bg-sec-dark/50 hover:bg-sec-dark py-2 rounded-xl transition-all w-full">
                                            Detail Pesanan
                                        </a>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

    </div>

    <!-- ========================================== -->
    <!-- 3. FOOTER PREMIUM                          -->
    <!-- ========================================== -->
    <footer class="bg-deep-dark border-t border-sec-dark/50 pt-20 pb-10 px-6 lg:px-16 mt-20 relative overflow-hidden">
        <!-- Background Ambient Glow in Footer -->
        <div class="ambient-glow bg-acc-emerald/10 w-[300px] h-[300px] -top-10 -left-10"></div>

        <div class="max-w-[95%] xl:max-w-[1550px] mx-auto grid md:grid-cols-2 lg:grid-cols-4 gap-12 mb-16 relative z-10">
            
            <!-- Col 1: Brand & Philosophy -->
            <div class="space-y-6">
                <a href="<?php echo base_url(); ?>" class="flex items-center space-x-2 group">
                    <div class="w-9 h-9 rounded-lg border-2 border-gold-accent flex items-center justify-center bg-sec-dark/80 group-hover:shadow-glow-gold transition-all duration-300 overflow-hidden">
                        <img src="<?php echo base_url('assets/img/logo.png'); ?>" alt="Logo" class="w-full h-full object-cover">
                    </div>
                    <span class="text-2xl font-bold tracking-wider text-white group-hover:text-gold-accent transition-all duration-300">
                        VERIDIAN<span class="text-gold-accent">LTD</span>
                    </span>
                </a>
                <p class="text-xs leading-relaxed font-light">
                    Dedikasi kami adalah melayani para visioner yang memandang teknologi bukan sekadar alat, melainkan mahakarya seni bernilai tinggi.
                </p>
                <div class="flex items-center space-x-4">
                    <a href="#" class="w-9 h-9 rounded-full bg-sec-dark/50 border border-acc-emerald/20 hover:border-gold-accent hover:text-gold-accent flex items-center justify-center transition-all duration-300"><i class="fa-brands fa-instagram text-sm"></i></a>
                    <a href="#" class="w-9 h-9 rounded-full bg-sec-dark/50 border border-acc-emerald/20 hover:border-gold-accent hover:text-gold-accent flex items-center justify-center transition-all duration-300"><i class="fa-brands fa-twitter text-sm"></i></a>
                    <a href="#" class="w-9 h-9 rounded-full bg-sec-dark/50 border border-acc-emerald/20 hover:border-gold-accent hover:text-gold-accent flex items-center justify-center transition-all duration-300"><i class="fa-brands fa-linkedin-in text-sm"></i></a>
                    <a href="#" class="w-9 h-9 rounded-full bg-sec-dark/50 border border-acc-emerald/20 hover:border-gold-accent hover:text-gold-accent flex items-center justify-center transition-all duration-300"><i class="fa-brands fa-youtube text-sm"></i></a>
                </div>
            </div>

            <!-- Col 2: Company Links -->
            <div>
                <h4 class="text-white font-bold tracking-wider text-sm uppercase mb-6 relative after:content-[''] after:absolute after:left-0 after:-bottom-2 after:w-8 after:h-[2px] after:bg-gold-accent">Perusahaan</h4>
                <ul class="space-y-4 text-xs">
                    <li><a href="#" class="hover:text-white hover:underline decoration-gold-accent underline-offset-4 transition-colors text-txt-sec">Tentang Kami</a></li>
                    <li><a href="#" class="hover:text-white hover:underline decoration-gold-accent underline-offset-4 transition-colors text-txt-sec">Karir Global</a></li>
                    <li><a href="#" class="hover:text-white hover:underline decoration-gold-accent underline-offset-4 transition-colors text-txt-sec">Press Kit</a></li>
                    <li><a href="#" class="hover:text-white hover:underline decoration-gold-accent underline-offset-4 transition-colors text-txt-sec">Keberlanjutan</a></li>
                </ul>
            </div>

            <!-- Col 3: Support Links -->
            <div>
                <h4 class="text-white font-bold tracking-wider text-sm uppercase mb-6 relative after:content-[''] after:absolute after:left-0 after:-bottom-2 after:w-8 after:h-[2px] after:bg-gold-accent">Dukungan</h4>
                <ul class="space-y-4 text-xs">
                    <li><a href="#" class="hover:text-white hover:underline decoration-gold-accent underline-offset-4 transition-colors text-txt-sec">Hubungi Kami</a></li>
                    <li><a href="#" class="hover:text-white hover:underline decoration-gold-accent underline-offset-4 transition-colors text-txt-sec">Pusat Bantuan</a></li>
                    <li><a href="#" class="hover:text-white hover:underline decoration-gold-accent underline-offset-4 transition-colors text-txt-sec">Klaim Garansi</a></li>
                    <li><a href="#" class="hover:text-white hover:underline decoration-gold-accent underline-offset-4 transition-colors text-txt-sec">Kebijakan Privasi</a></li>
                </ul>
            </div>

            <!-- Col 4: Contact details -->
            <div class="space-y-5">
                <h4 class="text-white font-bold tracking-wider text-sm uppercase relative after:content-[''] after:absolute after:left-0 after:-bottom-2 after:w-8 after:h-[2px] after:bg-gold-accent">Showroom</h4>
                <p class="text-xs leading-relaxed font-light text-txt-sec">
                    <?php echo $store['address']; ?>
                </p>
                <div class="text-xs flex items-center gap-2 font-semibold text-gold-accent">
                    <i class="fa-solid fa-phone-volume"></i> <?php echo $store['whatsapp']; ?>
                </div>
                <div class="text-xs flex items-center gap-2 font-semibold text-txt-sec">
                    <i class="fa-solid fa-envelope"></i> <?php echo $store['email']; ?>
                </div>
            </div>

        </div>

        <!-- Bottom Copyright -->
        <div class="max-w-[95%] xl:max-w-[1550px] mx-auto border-t border-sec-dark pt-8 text-center flex flex-col sm:flex-row items-center justify-between gap-4 relative z-10">
            <p class="text-[10px] tracking-widest text-txt-sec/60 uppercase">
                &copy; 2026 <?php echo $store['name']; ?>. All Rights Reserved.
            </p>
            <div class="flex items-center gap-6 text-[10px] uppercase tracking-wider">
                <a href="#" class="hover:text-white transition-colors text-txt-sec">Syarat & Ketentuan</a>
                <span class="text-sec-dark">|</span>
                <a href="#" class="hover:text-white transition-colors text-txt-sec">Peta Situs</a>
            </div>
        </div>
    </footer>

    <!-- Edit Profile Modal Wrapper (hidden by default) -->
    <div id="editProfileModal" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/70 backdrop-blur-sm opacity-0 pointer-events-none transition-all duration-300">
        <!-- Modal Card -->
        <div class="relative w-full max-w-2xl bg-[#0B1D1B] border border-white/10 rounded-[2rem] p-6 md:p-8 shadow-2xl transform scale-95 opacity-0 transition-all duration-300 max-h-[90vh] overflow-y-auto">
            <!-- Close Button -->
            <button id="closeProfileModal" class="absolute top-6 right-6 text-txt-sec hover:text-white transition-colors">
                <i class="fa-solid fa-xmark text-xl"></i>
            </button>

            <h3 class="text-xl font-bold text-white mb-6 flex items-center gap-2">
                <i class="fa-solid fa-user-pen text-gold-accent"></i> Perbarui Informasi Profil
            </h3>

            <form action="<?php echo base_url('landing/profil'); ?>" method="POST" class="space-y-5 text-left">
                <div>
                    <label class="block text-xs font-bold text-txt-sec uppercase tracking-wider mb-2">Nama Lengkap</label>
                    <input type="text" name="fullname" value="<?php echo $user['fullname']; ?>" class="w-full bg-[#12352F]/35 border border-white/10 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-gold-accent transition-colors" required>
                </div>

                <div class="grid md:grid-cols-2 gap-5">
                    <div>
                        <label class="block text-xs font-bold text-txt-sec uppercase tracking-wider mb-2">Username</label>
                        <input type="text" name="username" value="<?php echo $user['username']; ?>" class="w-full bg-[#12352F]/35 border border-white/10 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-gold-accent transition-colors" required>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-txt-sec uppercase tracking-wider mb-2">Email</label>
                        <input type="email" name="email" value="<?php echo $user['email']; ?>" class="w-full bg-[#12352F]/35 border border-white/10 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-gold-accent transition-colors" required>
                    </div>
                </div>

                <div class="grid md:grid-cols-2 gap-5">
                    <div>
                        <label class="block text-xs font-bold text-txt-sec uppercase tracking-wider mb-2">Nomor Telepon</label>
                        <input type="text" name="phone" value="<?php echo isset($user['phone']) ? htmlspecialchars($user['phone']) : ''; ?>" placeholder="Contoh: 08123456789" class="w-full bg-[#12352F]/35 border border-white/10 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-gold-accent transition-colors">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-txt-sec uppercase tracking-wider mb-2">Password Baru (Kosongkan jika tidak diganti)</label>
                        <div class="relative">
                            <input type="password" id="modal-password" name="password" class="w-full bg-[#12352F]/35 border border-white/10 rounded-xl pl-4 pr-12 py-3 text-white focus:outline-none focus:border-gold-accent transition-colors">
                            <button type="button" id="toggleModalPassword" class="absolute right-4 top-1/2 -translate-y-1/2 text-txt-sec hover:text-white transition-colors">
                                <i id="modalEyeIcon" class="fa-solid fa-eye text-lg"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold text-txt-sec uppercase tracking-wider mb-2">Alamat Lengkap</label>
                    <textarea name="address" rows="3" placeholder="Masukkan alamat lengkap Anda untuk pengiriman..." class="w-full bg-[#12352F]/35 border border-white/10 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-gold-accent transition-colors"><?php echo isset($user['address']) ? htmlspecialchars($user['address']) : ''; ?></textarea>
                </div>

                <div class="pt-4 flex gap-4">
                    <button type="button" id="cancelModalBtn" class="flex-1 bg-white/5 border border-white/10 hover:bg-white/10 text-white py-3.5 rounded-xl font-bold uppercase tracking-wider text-xs transition-colors duration-300">
                        Batal
                    </button>
                    <button type="submit" class="flex-1 bg-gold-accent text-main-bg hover:shadow-glow-gold py-3.5 rounded-xl font-bold uppercase tracking-wider text-xs transition-all duration-300">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const modal = document.getElementById('editProfileModal');
            const modalContainer = modal.querySelector('div');
            const triggers = document.querySelectorAll('[data-modal-target="editProfileModal"]');
            const closers = [
                document.getElementById('closeProfileModal'),
                document.getElementById('cancelModalBtn'),
                modal
            ];

            function openModal() {
                modal.classList.remove('pointer-events-none', 'opacity-0');
                modalContainer.classList.remove('scale-95', 'opacity-0');
            }

            function closeModal() {
                modal.classList.add('pointer-events-none', 'opacity-0');
                modalContainer.classList.add('scale-95', 'opacity-0');
            }

            triggers.forEach(t => t.addEventListener('click', (e) => {
                e.preventDefault();
                openModal();
            }));

            closers.forEach(c => {
                if(c) {
                    c.addEventListener('click', (e) => {
                        if (e.target === modal || e.currentTarget !== modal) {
                            closeModal();
                        }
                    });
                }
            });

            modalContainer.addEventListener('click', (e) => {
                e.stopPropagation();
            });

            // Modal Password Toggle
            const toggleBtn = document.getElementById('toggleModalPassword');
            if (toggleBtn) {
                toggleBtn.addEventListener('click', function() {
                    const passwordInput = document.getElementById('modal-password');
                    const eyeIcon = document.getElementById('modalEyeIcon');
                    if (passwordInput.type === 'password') {
                        passwordInput.type = 'text';
                        eyeIcon.classList.remove('fa-eye');
                        eyeIcon.classList.add('fa-eye-slash');
                    } else {
                        passwordInput.type = 'password';
                        eyeIcon.classList.remove('fa-eye-slash');
                        eyeIcon.classList.add('fa-eye');
                    }
                });
            }
        });
    </script>

    <!-- Custom JS File for Password Toggles & Page Animations -->
    <script src="<?php echo base_url('assets/js/login.js'); ?>"></script>
    <!-- Custom JS File -->
    <script src="<?php echo base_url('assets/js/script.js'); ?>"></script>
</body>
</html>
