<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesanan Saya | VERIDIAN Luxury Tech</title>
    <script src="<?php echo base_url('assets/js/tailwindcss.js'); ?>"></script>
    <link rel="stylesheet" href="<?php echo base_url('assets/css/all.min.css'); ?>">
    <link class="reveal-css" rel="stylesheet" href="<?php echo base_url('assets/css/style.css'); ?>">
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
                                    <a href="<?php echo base_url('landing/profil'); ?>" class="flex items-center gap-2 px-3 py-2 rounded-lg text-sm text-txt-sec hover:text-white hover:bg-sec-dark/30 transition-all">
                                        <i class="fa-solid fa-user-gear text-xs text-gold-accent"></i> Profil Saya
                                    </a>
                                    <a href="<?php echo base_url('landing/pesanan'); ?>" class="flex items-center gap-2 px-3 py-2 rounded-lg text-sm text-white bg-sec-dark/30 transition-all">
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
    <!-- 2. MAIN LAYOUT HISTORY PESANAN             -->
    <!-- ========================================== -->
    <div class="max-w-[95%] xl:max-w-[1550px] mx-auto px-4 md:px-8 py-10 relative z-10">
        
        <div class="reveal flex flex-col sm:flex-row items-center justify-between gap-4 mb-10 pb-6 border-b border-white/5">
            <div>
                <a href="<?php echo base_url('landing/profil'); ?>" class="text-gold-accent flex items-center gap-2 hover:translate-x-[-5px] transition-transform text-sm font-semibold mb-2">
                    <i class="fa-solid fa-chevron-left"></i> Kembali ke Profil
                </a>
                <h1 class="text-3xl font-extrabold tracking-wider text-white">RIWAYAT <span class="text-gold-accent">PESANAN</span></h1>
            </div>
            
        </div>

        <?php if($this->session->flashdata('success')): ?>
            <div class="reveal mb-6 p-4 rounded-2xl bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 text-sm font-semibold flex items-center gap-3">
                <i class="fa-solid fa-circle-check text-base"></i>
                <span><?php echo $this->session->flashdata('success'); ?></span>
            </div>
        <?php endif; ?>
        <?php if($this->session->flashdata('error')): ?>
            <div class="reveal mb-6 p-4 rounded-2xl bg-red-500/10 border border-red-500/20 text-red-400 text-sm font-semibold flex items-center gap-3">
                <i class="fa-solid fa-circle-exclamation text-base"></i>
                <span><?php echo $this->session->flashdata('error'); ?></span>
            </div>
        <?php endif; ?>

        <?php if(empty($orders)): ?>
            <div class="reveal glass border border-white/5 rounded-[2rem] p-16 text-center">
                <div class="w-20 h-20 rounded-full bg-sec-dark/50 border border-white/5 flex items-center justify-center mx-auto mb-6">
                    <i class="fa-solid fa-receipt text-3xl text-gold-accent/40 animate-pulse"></i>
                </div>
                <h2 class="text-xl font-bold text-white mb-2">Belum Ada Riwayat Pesanan</h2>
                <p class="text-txt-sec text-sm max-w-md mx-auto mb-8 leading-relaxed">Semua transaksi pembelian gawai flagship Anda akan tercatat di sini secara aman dan terenkripsi.</p>
                <a href="<?php echo base_url('landing'); ?>" class="inline-block bg-gold-accent text-main-bg px-8 py-4 rounded-xl font-bold uppercase tracking-wider text-xs transition-all duration-300 hover:shadow-glow-gold">Belanja Sekarang</a>
            </div>
        <?php else: ?>
            <div class="space-y-6">
                <?php foreach($orders as $o): ?>
                <div class="reveal glass border border-white/5 rounded-[2rem] p-6 md:p-8 flex flex-col md:flex-row items-center justify-between gap-6 hover:border-gold-accent/20 transition-all duration-300">
                    <div class="flex flex-col gap-6 w-full md:w-2/3">
                        <div class="flex flex-wrap items-center gap-3 mb-1">
                            <span class="text-xs font-bold text-txt-sec">Invoice #<?php echo $o['id']; ?></span>
                            <div>
                                <?php
                                    $status = strtolower($o['status']);
                                    if ($status == 'completed' || $status == 'selesai') {
                                        echo '<span class="px-3 py-1 rounded-full bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 text-[10px] font-bold uppercase tracking-wider">Selesai</span>';
                                    } elseif ($status == 'shipping' || $status == 'dikirim' || $status == 'processed' || $status == 'diproses') {
                                        echo '<span class="px-3 py-1 rounded-full bg-sky-500/10 border border-sky-500/20 text-sky-400 text-[10px] font-bold uppercase tracking-wider">Dikirim</span>';
                                    } elseif ($status == 'cancelled' || $status == 'batal') {
                                        echo '<span class="px-3 py-1 rounded-full bg-red-500/10 border border-red-500/20 text-red-400 text-[10px] font-bold uppercase tracking-wider">Batal</span>';
                                    } else {
                                        echo '<span class="px-3 py-1 rounded-full bg-amber-500/10 border border-amber-500/20 text-amber-400 text-[10px] font-bold uppercase tracking-wider">Menunggu Pembayaran</span>';
                                    }
                                ?>
                            </div>
                        </div>

                        <!-- Product Items List inside Order -->
                        <div class="flex flex-col gap-4">
                            <?php if(!empty($o['items'])): ?>
                                <?php foreach($o['items'] as $item): ?>
                                <div class="flex items-center gap-4">
                                    <div class="w-16 h-16 rounded-xl bg-white/5 border border-white/5 flex items-center justify-center overflow-hidden shrink-0">
                                        <?php if(!empty($item['image'])): ?>
                                            <img src="<?php echo base_url('assets/img/'.$item['image']); ?>" alt="Produk" class="w-11 h-11 object-contain">
                                        <?php else: ?>
                                            <i class="fa-solid fa-mobile-screen-button text-gold-accent text-lg"></i>
                                        <?php endif; ?>
                                    </div>
                                    <div>
                                        <h4 class="font-bold text-white text-sm"><?php echo htmlspecialchars($item['name']); ?></h4>
                                        <p class="text-xs text-txt-sec mt-0.5"><?php echo $item['quantity']; ?> x Rp <?php echo number_format($item['price'], 0, ',', '.'); ?></p>
                                    </div>
                                </div>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <!-- Fallback if items empty -->
                                <div class="flex items-center gap-4">
                                    <div class="w-16 h-16 rounded-xl bg-white/5 border border-white/5 flex items-center justify-center overflow-hidden shrink-0">
                                        <?php if(!empty($o['product_image'])): ?>
                                            <img src="<?php echo base_url('assets/img/'.$o['product_image']); ?>" alt="Produk" class="w-11 h-11 object-contain">
                                        <?php else: ?>
                                            <i class="fa-solid fa-mobile-screen-button text-gold-accent text-lg"></i>
                                        <?php endif; ?>
                                    </div>
                                    <div>
                                        <h4 class="font-bold text-white text-sm">Pesanan #<?php echo $o['id']; ?></h4>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>

                        <div class="mt-2 border-t border-white/5 pt-4">
                            <h2 class="text-2xl font-black text-white">Rp <?php echo number_format($o['total_amount'], 0, ',', '.'); ?></h2>
                            <p class="text-xs text-txt-sec mt-1.5 flex items-center gap-1.5">
                                <i class="fa-regular fa-clock"></i> <?php echo date('d M Y, H:i', strtotime($o['order_date'])); ?>
                            </p>
                            <?php if(!empty($o['payment_method'])): ?>
                                <p class="text-[10px] text-gold-accent mt-2 font-medium tracking-wide">
                                    Metode: <span class="uppercase text-white"><?php echo htmlspecialchars($o['payment_method'] === 'transfer' ? 'Transfer Bank' : ($o['payment_method'] === 'ewallet' ? 'E-Wallet' : 'COD')); ?></span>
                                    <?php if(!empty($o['payment_detail'])): ?>
                                        <span class="text-txt-sec ml-2">(<?php echo htmlspecialchars($o['payment_detail']); ?>)</span>
                                    <?php endif; ?>
                                </p>
                            <?php endif; ?>
                        </div>
                    </div>
                    
                    <div class="flex flex-col sm:flex-row items-start sm:items-center gap-4 w-full md:w-auto justify-between md:justify-end border-t border-white/5 pt-4 md:border-0 md:pt-0">
                        <?php if($o['status'] == 'pending'): ?>
                            <p class="text-[10px] text-amber-400/80 italic max-w-[180px] leading-relaxed">
                                <i class="fa-solid fa-hourglass-half"></i> Menunggu konfirmasi pembayaran oleh kasir...
                            </p>
                        <?php endif; ?>
                        
                        <div class="flex items-center gap-3 w-full sm:w-auto justify-end">
                            <?php if($o['status'] == 'pending'): ?>
                                <button type="button" 
                                        onclick="openCancelModal(<?php echo $o['id']; ?>)" 
                                        class="bg-red-500/10 border border-red-500/20 px-5 py-3 rounded-xl text-xs font-bold text-red-400 hover:bg-red-500 hover:text-white hover:border-red-500 transition-all flex items-center gap-2 shrink-0">
                                    <i class="fa-solid fa-ban"></i> Batalkan
                                </button>
                            <?php endif; ?>
                            
                            <a href="<?php echo base_url('landing/nota/'.$o['id']); ?>" class="bg-sec-dark/50 border border-gold-accent/20 px-5 py-3 rounded-xl text-xs font-bold hover:bg-sec-dark hover:border-gold-accent text-gold-accent hover:text-white transition-all flex items-center gap-2 shrink-0">
                                <i class="fa-solid fa-file-invoice"></i> Lihat Nota
                            </a>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
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
                <p class="text-xs leading-relaxed font-light text-txt-sec">
                    Dedikasi kami adalah melayani para visioner yang memandang teknologi bukan sekadar alat, melainkan mahakarya seni bernilai tinggi.
                </p>
                <div class="flex items-center space-x-4">
                    <a href="#" class="w-9 h-9 rounded-full bg-sec-dark/50 border border-acc-emerald/20 hover:border-gold-accent hover:text-gold-accent flex items-center justify-center transition-all duration-300"><i class="fa-brands fa-instagram text-sm text-txt-sec"></i></a>
                    <a href="#" class="w-9 h-9 rounded-full bg-sec-dark/50 border border-acc-emerald/20 hover:border-gold-accent hover:text-gold-accent flex items-center justify-center transition-all duration-300"><i class="fa-brands fa-twitter text-sm text-txt-sec"></i></a>
                    <a href="#" class="w-9 h-9 rounded-full bg-sec-dark/50 border border-acc-emerald/20 hover:border-gold-accent hover:text-gold-accent flex items-center justify-center transition-all duration-300"><i class="fa-brands fa-linkedin-in text-sm text-txt-sec"></i></a>
                    <a href="#" class="w-9 h-9 rounded-full bg-sec-dark/50 border border-acc-emerald/20 hover:border-gold-accent hover:text-gold-accent flex items-center justify-center transition-all duration-300"><i class="fa-brands fa-youtube text-sm text-txt-sec"></i></a>
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
                    <li><a href="#" class="hover:text-white hover:underline decoration-gold-accent underline-offset-4 transition-colors text-txt-sec">Klaim Garansi VIP</a></li>
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

    <!-- Cancellation Reason Modal -->
    <div id="cancelModal" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/80 backdrop-blur-sm opacity-0 pointer-events-none transition-all duration-300">
        <div class="w-full max-w-lg rounded-[2rem] bg-deep-dark border border-gold-accent/20 shadow-glow-gold p-6 md:p-8 transform scale-95 transition-all duration-300 relative max-h-[90vh] overflow-y-auto custom-scrollbar">
            <!-- Close Button -->
            <button onclick="closeCancelModal()" class="absolute top-6 right-6 text-txt-sec hover:text-white transition-colors">
                <i class="fa-solid fa-xmark text-xl"></i>
            </button>

            <h3 class="text-xl font-bold text-white mb-2 flex items-center gap-3">
                <i class="fa-solid fa-ban text-red-500"></i> Alasan Pembatalan
            </h3>
            <p class="text-xs text-txt-sec mb-6">Silakan pilih alasan Anda membatalkan pesanan ini untuk membantu kami meningkatkan layanan.</p>

            <form id="cancelForm" action="<?php echo base_url('landing/cancel_order'); ?>" method="POST" class="space-y-4">
                <input type="hidden" name="order_id" id="cancelOrderId" value="">
                
                <div class="space-y-3">
                    <?php 
                    $reasons = [
                        'Saya berubah pikiran',
                        'Salah memilih produk',
                        'Ingin mengubah jumlah pesanan',
                        'Ingin mengubah alamat pengiriman',
                        'Menemukan produk lain yang lebih sesuai',
                        'Harga tidak sesuai budget',
                        'Pembayaran tidak dapat dilanjutkan',
                        'Pesanan dibuat tidak sengaja'
                    ];
                    foreach ($reasons as $index => $reason):
                    ?>
                    <label class="flex items-center gap-3 p-3.5 rounded-xl border border-white/5 bg-sec-dark/20 hover:bg-sec-dark/40 cursor-pointer transition-all">
                        <input type="radio" name="reason" value="<?php echo htmlspecialchars($reason); ?>" class="accent-gold-accent w-4 h-4" required>
                        <span class="text-xs text-txt-main font-medium"><?php echo htmlspecialchars($reason); ?></span>
                    </label>
                    <?php endforeach; ?>

                    <label class="flex items-center gap-3 p-3.5 rounded-xl border border-white/5 bg-sec-dark/20 hover:bg-sec-dark/40 cursor-pointer transition-all">
                        <input type="radio" name="reason" value="Lainnya" id="reasonLainnya" class="accent-gold-accent w-4 h-4" required>
                        <span class="text-xs text-txt-main font-medium">Lainnya</span>
                    </label>
                </div>

                <!-- Textarea for "Lainnya" (hidden by default) -->
                <div id="customReasonContainer" class="hidden transition-all duration-300 mt-3">
                    <textarea name="custom_reason" id="customReasonText" rows="3" placeholder="Jelaskan alasan pembatalan..." class="w-full p-4 rounded-xl bg-sec-dark/30 border border-white/10 text-white placeholder-txt-sec/50 text-xs focus:border-gold-accent focus:outline-none transition-all"></textarea>
                </div>

                <div class="flex items-center justify-end gap-3 mt-8 pt-4 border-t border-white/5">
                    <button type="button" onclick="closeCancelModal()" class="px-6 py-3 rounded-xl border border-white/10 text-xs font-bold text-txt-sec hover:bg-white/5 hover:text-white transition-all">
                        Batal
                    </button>
                    <button type="submit" class="bg-red-500/10 border border-red-500/30 px-6 py-3 rounded-xl text-xs font-bold text-red-400 hover:bg-red-500 hover:text-white hover:border-red-500 transition-all">
                        Batalkan Pesanan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openCancelModal(orderId) {
            document.getElementById('cancelOrderId').value = orderId;
            const modal = document.getElementById('cancelModal');
            modal.classList.remove('opacity-0', 'pointer-events-none');
            modal.firstElementChild.classList.remove('scale-95');
            modal.firstElementChild.classList.add('scale-100');
        }

        function closeCancelModal() {
            const modal = document.getElementById('cancelModal');
            modal.classList.add('opacity-0', 'pointer-events-none');
            modal.firstElementChild.classList.remove('scale-100');
            modal.firstElementChild.classList.add('scale-95');
            // Reset form
            document.getElementById('cancelForm').reset();
            document.getElementById('customReasonContainer').classList.add('hidden');
            document.getElementById('customReasonText').removeAttribute('required');
        }

        // Toggle custom reason textarea based on "Lainnya" selection
        document.querySelectorAll('input[name="reason"]').forEach(radio => {
            radio.addEventListener('change', function() {
                const customContainer = document.getElementById('customReasonContainer');
                const customText = document.getElementById('customReasonText');
                if (this.value === 'Lainnya') {
                    customContainer.classList.remove('hidden');
                    customText.setAttribute('required', 'required');
                    customText.focus();
                } else {
                    customContainer.classList.add('hidden');
                    customText.removeAttribute('required');
                }
            });
        });
    </script>

    <!-- Custom JS File for Password Toggles & Page Animations -->
    <script src="<?php echo base_url('assets/js/login.js'); ?>"></script>
    <!-- Custom JS File -->
    <script src="<?php echo base_url('assets/js/script.js'); ?>"></script>
</body>
</html>
