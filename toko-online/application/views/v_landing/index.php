<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>VeridianLTD | Luxury Tech Development</title>
  <meta name="description" content="Landing page toko online HP premium dengan art style dark green elegant luxury. Temukan smartphone masa depan Anda di sini.">
  
  <!-- Tailwind CSS CDN (Now Local) -->
  <script src="<?php echo base_url('assets/js/tailwindcss.js'); ?>"></script>
  <!-- Custom Tailwind Colors Setup -->
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
            'deep-dark': '#071312',
          },
          fontFamily: {
            sans: ['Poppins', 'Inter', 'sans-serif'],
          },
          backgroundImage: {
            'gradient-emerald': 'linear-gradient(135deg, #12352F 0%, #0B1D1B 100%)',
            'gradient-luxury': 'linear-gradient(135deg, #1F8A70 0%, #12352F 50%, #0B1D1B 100%)',
          },
          boxShadow: {
            'glow-emerald': '0 0 20px rgba(31, 138, 112, 0.3)',
            'glow-gold': '0 0 20px rgba(212, 175, 55, 0.3)',
          }
        }
      }
    }
  </script>
  
  <!-- FontAwesome Icons (Local) -->
  <link rel="stylesheet" href="<?php echo base_url('assets/css/all.min.css'); ?>">
  
  <!-- Custom CSS -->
  <link rel="stylesheet" href="<?php echo base_url('assets/css/style.css'); ?>">
  <!-- Swiper.js for Carousel (Local) -->
  <link rel="stylesheet" href="<?php echo base_url('assets/css/swiper-bundle.min.css'); ?>" />
  <script src="<?php echo base_url('assets/js/swiper-bundle.min.js'); ?>"></script>
</head>
<body class="bg-main-bg text-txt-main selection:bg-acc-emerald selection:text-white overflow-x-hidden">

  <!-- Glow Cursor Element -->
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
        <li><a href="<?php echo base_url(); ?>" class="text-white transition-all duration-300 relative group">HOME<span class="absolute left-0 bottom-[-4px] w-full h-[2px] bg-gold-accent transition-all duration-300"></span></a></li>
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
        <?php else: ?>
            <a href="<?php echo base_url('auth'); ?>" class="px-6 py-2.5 rounded-full border border-gold-accent/50 bg-gold-accent/10 hover:bg-gold-accent text-gold-accent hover:text-main-bg font-semibold tracking-wide text-sm transition-all duration-300 btn-gold-glow flex items-center gap-2">
                LOGIN <i class="fa-solid fa-arrow-right text-xs"></i>
            </a>
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
  <!-- 2. HERO SECTION                            -->
  <!-- ========================================== -->
  <section class="relative min-h-screen flex items-center pt-28 pb-16 px-6 lg:px-16 overflow-hidden">
    <!-- Subtly rotating graphic in background -->
    <div class="absolute right-[5%] top-[15%] w-[400px] h-[400px] rounded-full border border-acc-emerald/10 animate-slow-spin pointer-events-none hidden lg:block">
      <div class="absolute top-0 left-1/2 w-3 h-3 bg-gold-accent rounded-full"></div>
    </div>
    
    <div class="max-w-7xl mx-auto grid lg:grid-cols-2 gap-12 items-center relative z-10 w-full">
      
      <!-- Left Content -->
      <div class="text-center lg:text-left space-y-6">
        <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-sec-dark/60 border border-acc-emerald/30 text-xs font-semibold tracking-wider text-gold-accent uppercase shadow-inner reveal">
          <span class="relative flex h-2 w-2">
            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-gold-accent opacity-75"></span>
            <span class="relative inline-flex rounded-full h-2 w-2 bg-gold-accent"></span>
          </span>
          Edisi Flagship 2026
        </div>
        
        <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold tracking-tight text-white leading-[1.1] reveal reveal-slow" style="transition-delay: 200ms;">
          Smartphone Premium <br>
          Untuk Gaya Hidup <br>
          <span id="typing-element" class="text-gradient-gold text-gold-glow"></span>
        </h1>
        
        <p class="text-txt-sec text-base sm:text-lg max-w-xl mx-auto lg:mx-0 font-light leading-relaxed reveal reveal-slow" style="transition-delay: 500ms;">
          Hadirkan kesempurnaan estetika dalam genggaman Anda. Dilapisi titanium premium, diotaki prosesor kuantum tercanggih, dirancang eksklusif untuk standar Anda yang tinggi.
        </p>
        
        <!-- CTA Group -->
        <div class="flex flex-col sm:flex-row gap-4 justify-center lg:justify-start items-center pt-4 reveal" style="transition-delay: 800ms;">
          <a href="<?php echo base_url('landing/produk'); ?>" class="px-8 py-4 bg-gold-accent text-main-bg rounded-full font-bold text-base btn-gold-glow tracking-wide transition-all w-full sm:w-auto text-center">
            Miliki Sekarang
          </a>
          <a href="#promo" class="px-8 py-4 bg-transparent border border-txt-sec/30 text-white rounded-full font-semibold text-base hover:bg-sec-dark/40 hover:border-acc-emerald transition-all duration-300 w-full sm:w-auto flex items-center justify-center gap-2">
            <i class="fa-solid fa-play text-xs text-gold-accent"></i> Lihat Demo
          </a>
        </div>
        
        <!-- Mini Stats -->
        <div class="grid grid-cols-3 gap-6 pt-8 border-t border-sec-dark/50 max-w-md mx-auto lg:mx-0">
          <div>
            <h4 class="text-2xl font-bold text-white text-gold-glow">200+</h4>
            <p class="text-xs text-txt-sec uppercase tracking-wider">Fitur Pro</p>
          </div>
          <div>
            <h4 class="text-2xl font-bold text-white text-gold-glow">5.0</h4>
            <p class="text-xs text-txt-sec uppercase tracking-wider">Rating Global</p>
          </div>
          <div>
            <h4 class="text-2xl font-bold text-white text-gold-glow">24/7</h4>
            <p class="text-xs text-txt-sec uppercase tracking-wider">VIP Service</p>
          </div>
        </div>
      </div>
      
      <!-- Right Content (Floating Image) -->
      <div class="flex justify-center items-center relative reveal">
        <!-- Background Light Effect -->
        <div class="absolute w-72 h-72 md:w-96 md:h-96 rounded-full bg-radial-gradient from-acc-emerald/20 to-transparent opacity-80 blur-2xl"></div>
        
        <!-- Floating Phone -->
        <div class="relative animate-float">
          <img src="<?php echo base_url(); ?>assets/img/hero1.png" alt="Smartphone Premium Veridian" class="w-[280px] md:w-[380px] h-auto object-contain drop-shadow-[0_25px_25px_rgba(0,0,0,0.6)] filter brightness-110">
          
          <!-- Float Badge 1 -->
          <div class="absolute top-[20%] -right-10 sm:-right-14 glass border border-gold-accent/20 py-2.5 px-4 rounded-2xl shadow-2xl backdrop-blur-md animate-pulse flex items-center gap-3">
            <div class="w-10 h-10 rounded-xl bg-gold-accent/10 border border-gold-accent/30 flex items-center justify-center">
              <i class="fa-solid fa-camera text-gold-accent"></i>
            </div>
            <div>
              <p class="text-[10px] text-txt-sec uppercase tracking-wider">Pro Camera</p>
              <p class="text-sm font-bold text-white">200 MP Dual</p>
            </div>
          </div>
          
          <!-- Float Badge 2 -->
          <div class="absolute bottom-[15%] -left-10 sm:-left-14 glass border border-acc-emerald/30 py-2.5 px-4 rounded-2xl shadow-2xl backdrop-blur-md flex items-center gap-3">
            <div class="w-10 h-10 rounded-xl bg-acc-emerald/10 border border-acc-emerald/30 flex items-center justify-center">
              <i class="fa-solid fa-bolt text-acc-emerald"></i>
            </div>
            <div>
              <p class="text-[10px] text-txt-sec uppercase tracking-wider">Super Charge</p>
              <p class="text-sm font-bold text-white">150W Solid</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- ========================================== -->
  <!-- 3. BRAND PARTNER (AUTO SCROLL MARQUEE)     -->
  <!-- ========================================== -->
  <section class="py-10 bg-deep-dark border-y border-sec-dark relative overflow-hidden reveal">
    <div class="max-w-7xl mx-auto px-6 lg:px-16 text-center mb-6">
      <p class="text-xs text-txt-sec/50 font-semibold uppercase tracking-widest">Global Technology Partners</p>
    </div>
    
    <!-- Sliding Marquee container -->
    <div class="marquee-container relative flex w-full overflow-hidden cursor-pointer">
      <div class="animate-infinite-scroll flex items-center space-x-24 pr-24 text-txt-sec/30 font-bold text-2xl uppercase select-none">
        <!-- Item Group -->
        <div class="flex items-center space-x-3 group hover:text-gold-accent transition-colors"><i class="fa-brands fa-apple text-3xl"></i><span>APPLE</span></div>
        <div class="flex items-center space-x-3 group hover:text-acc-emerald transition-colors"><i class="fa-solid fa-microchip text-3xl"></i><span>SAMSUNG</span></div>
        <div class="flex items-center space-x-3 group hover:text-acc-emerald transition-colors"><i class="fa-brands fa-android text-3xl"></i><span>XIAOMI</span></div>
        <div class="flex items-center space-x-3 group hover:text-gold-accent transition-colors"><i class="fa-solid fa-headset text-3xl"></i><span>ASUS ROG</span></div>
        <div class="flex items-center space-x-3 group hover:text-acc-emerald transition-colors"><i class="fa-solid fa-bolt text-3xl"></i><span>INFINIX</span></div>
        
        <!-- Duplicated block for infinite seam -->
        <div class="flex items-center space-x-3 group hover:text-gold-accent transition-colors"><i class="fa-brands fa-apple text-3xl"></i><span>APPLE</span></div>
        <div class="flex items-center space-x-3 group hover:text-acc-emerald transition-colors"><i class="fa-solid fa-microchip text-3xl"></i><span>SAMSUNG</span></div>
        <div class="flex items-center space-x-3 group hover:text-acc-emerald transition-colors"><i class="fa-brands fa-android text-3xl"></i><span>XIAOMI</span></div>
        <div class="flex items-center space-x-3 group hover:text-gold-accent transition-colors"><i class="fa-solid fa-headset text-3xl"></i><span>ASUS ROG</span></div>
        <div class="flex items-center space-x-3 group hover:text-acc-emerald transition-colors"><i class="fa-solid fa-bolt text-3xl"></i><span>INFINIX</span></div>
      </div>
      
      <div class="animate-infinite-scroll flex items-center space-x-24 pr-24 text-txt-sec/30 font-bold text-2xl uppercase select-none" aria-hidden="true">
        <!-- Item Group 2 -->
        <div class="flex items-center space-x-3 group hover:text-gold-accent transition-colors"><i class="fa-brands fa-apple text-3xl"></i><span>APPLE</span></div>
        <div class="flex items-center space-x-3 group hover:text-acc-emerald transition-colors"><i class="fa-solid fa-microchip text-3xl"></i><span>SAMSUNG</span></div>
        <div class="flex items-center space-x-3 group hover:text-acc-emerald transition-colors"><i class="fa-brands fa-android text-3xl"></i><span>XIAOMI</span></div>
        <div class="flex items-center space-x-3 group hover:text-gold-accent transition-colors"><i class="fa-solid fa-headset text-3xl"></i><span>ASUS ROG</span></div>
        <div class="flex items-center space-x-3 group hover:text-acc-emerald transition-colors"><i class="fa-solid fa-bolt text-3xl"></i><span>INFINIX</span></div>
        
        <!-- Duplicated block 2 -->
        <div class="flex items-center space-x-3 group hover:text-gold-accent transition-colors"><i class="fa-brands fa-apple text-3xl"></i><span>APPLE</span></div>
        <div class="flex items-center space-x-3 group hover:text-acc-emerald transition-colors"><i class="fa-solid fa-microchip text-3xl"></i><span>SAMSUNG</span></div>
        <div class="flex items-center space-x-3 group hover:text-acc-emerald transition-colors"><i class="fa-brands fa-android text-3xl"></i><span>XIAOMI</span></div>
        <div class="flex items-center space-x-3 group hover:text-gold-accent transition-colors"><i class="fa-solid fa-headset text-3xl"></i><span>ASUS ROG</span></div>
        <div class="flex items-center space-x-3 group hover:text-acc-emerald transition-colors"><i class="fa-solid fa-bolt text-3xl"></i><span>INFINIX</span></div>
      </div>
    </div>
  </section>

  <!-- ========================================== -->
  <!-- 4. FEATURED PRODUCTS SECTION               -->
  <!-- ========================================== -->
  <section id="produk" class="py-24 px-6 lg:px-16 relative">
    <div class="max-w-7xl mx-auto">
      
      <!-- Section Header -->
      <div class="text-center mb-16">
        <p class="text-gold-accent font-semibold text-sm tracking-widest uppercase mb-2 reveal">Koleksi Terkini</p>
        <h2 class="text-3xl md:text-4xl font-bold text-white mb-4 reveal" style="transition-delay: 200ms;">Pilih Kemewahan Anda</h2>
        <div class="h-1 w-24 bg-gradient-to-r from-transparent via-gold-accent to-transparent mx-auto reveal" style="transition-delay: 350ms;"></div>
        <p class="text-txt-sec max-w-xl mx-auto mt-4 font-light text-sm sm:text-base reveal reveal-slow" style="transition-delay: 500ms;">
          Dirancang khusus dengan material kelas dunia untuk menghadirkan prestise dan performa ekstrem tanpa kompromi.
        </p>
      </div>
      
      <!-- Swiper Carousel -->
      <div class="swiper productSwiper pb-12">
        <div class="swiper-wrapper">
          <?php foreach($products as $p): ?>
          <div class="swiper-slide h-auto">
            <!-- Product Card -->
            <div class="glass-card rounded-3xl p-6 flex flex-col relative overflow-hidden group h-full transition-all duration-300 hover:border-gold-accent/30">
              <!-- Product Image Area -->
              <div class="relative rounded-2xl overflow-hidden bg-deep-dark/50 mb-6 p-4 flex items-center justify-center h-[300px]">
                <div class="absolute inset-0 bg-radial-gradient from-acc-emerald/10 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                
                <!-- Info Button (Exclamation Style) -->
                <a href="<?php echo base_url('landing/produk'); ?>" class="absolute top-4 right-4 w-12 h-12 rounded-full bg-gold-accent text-main-bg flex items-center justify-center shadow-glow-gold opacity-0 group-hover:opacity-100 transition-all duration-300 transform translate-y-[-10px] group-hover:translate-y-0 z-20">
                  <i class="fa-solid fa-exclamation text-2xl font-black"></i>
                </a>

                <img src="<?php echo base_url(); ?>assets/img/<?php echo $p['image']; ?>" alt="<?php echo $p['name']; ?>" class="h-full w-auto object-contain transform group-hover:scale-110 transition-transform duration-500 filter drop-shadow-[0_10px_15px_rgba(0,0,0,0.5)]">
              </div>
              
              <!-- Details -->
              <div class="flex-grow space-y-3">
                <div class="flex items-center space-x-1 text-gold-accent text-xs">
                  <i class="fa-solid fa-star"></i>
                  <i class="fa-solid fa-star"></i>
                  <i class="fa-solid fa-star"></i>
                  <i class="fa-solid fa-star"></i>
                  <i class="fa-solid fa-star"></i>
                  <span class="text-txt-sec text-xs ml-2">(4.9)</span>
                </div>
                <h3 class="text-xl font-bold text-white group-hover:text-gold-accent transition-colors duration-300"><?php echo $p['name']; ?></h3>
                <p class="text-xs text-txt-sec"><?php echo $p['category']; ?> / <?php echo $p['description']; ?></p>
                <div class="text-lg font-extrabold text-gold-accent tracking-wide pt-1">Rp <?php echo number_format($p['price'], 0, ',', '.'); ?></div>
              </div>
            </div>
          </div>
          <?php endforeach; ?>
        </div>
        <!-- Pagination -->
        <div class="swiper-pagination !bottom-0"></div>
      </div>
    </div>
  </section>

  <!-- ========================================== -->
  <!-- 5. SHOWCASE FLAGSHIP (FULL IMPACT)         -->
  <!-- ========================================== -->
  <section id="showcase" class="py-24 bg-deep-dark relative overflow-hidden flex items-center justify-center min-h-[80vh] px-6 lg:px-16 border-y border-sec-dark">
    <!-- Ambient Central Light -->
    <div class="absolute w-[400px] h-[400px] bg-acc-emerald/15 rounded-full blur-[120px] pointer-events-none top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2"></div>
    
    <div class="max-w-7xl mx-auto grid lg:grid-cols-3 gap-12 items-center w-full relative z-10">
      
      <!-- Left Features -->
      <div class="space-y-16 order-2 lg:order-1 text-center lg:text-right flex flex-col items-center lg:items-end">
        <div class="flex flex-col lg:flex-row items-center lg:items-start gap-4 group reveal reveal-left">
          <div class="order-2 lg:order-1">
            <h4 class="text-xl font-bold text-white group-hover:text-gold-accent transition-colors">Ultra Cinema Camera</h4>
            <p class="text-xs text-txt-sec mt-2 max-w-xs leading-relaxed mx-auto lg:ml-auto lg:mr-0">Lensa titanium bersertifikasi optik profesional untuk detail visual malam hari yang tak bercacat.</p>
          </div>
          <div class="order-1 lg:order-2 w-14 h-14 shrink-0 rounded-2xl border border-gold-accent/30 bg-sec-dark/80 text-gold-accent flex items-center justify-center text-xl shadow-lg group-hover:shadow-glow-gold transition-all">
            <i class="fa-solid fa-camera"></i>
          </div>
        </div>
        
        <div class="flex flex-col lg:flex-row items-center lg:items-start gap-4 group reveal reveal-left" style="transition-delay: 150ms;">
          <div class="order-2 lg:order-1">
            <h4 class="text-xl font-bold text-white group-hover:text-gold-accent transition-colors">Quantum AI Performance</h4>
            <p class="text-xs text-txt-sec mt-2 max-w-xs leading-relaxed mx-auto lg:ml-auto lg:mr-0">Chipset berarsitektur 3nm terintegrasi jaringan saraf cerdas untuk respons instan multi-tasking.</p>
          </div>
          <div class="order-1 lg:order-2 w-14 h-14 shrink-0 rounded-2xl border border-gold-accent/30 bg-sec-dark/80 text-gold-accent flex items-center justify-center text-xl shadow-lg group-hover:shadow-glow-gold transition-all">
            <i class="fa-solid fa-microchip"></i>
          </div>
        </div>
      </div>

      <!-- Center Spotlight Smartphone -->
      <div class="flex flex-col items-center text-center space-y-8 order-1 lg:order-2 reveal">
        <div class="space-y-2">
          <span class="text-gold-accent text-xs font-bold uppercase tracking-widest">Highlight Edisi Terbatas</span>
          <h2 class="text-3xl md:text-5xl font-black leading-none text-white uppercase">
            THE NEXT <br>
            <span class="text-gradient-gold text-gold-glow">EVOLUTION</span>
          </h2>
        </div>
        
        <div class="relative animate-float w-[260px] md:w-[320px] drop-shadow-[0_35px_45px_rgba(0,0,0,0.8)]">
          <img src="<?php echo base_url(); ?>assets/img/showcase.png" alt="Veridian Ultimate Flagship" class="w-full h-auto object-contain filter brightness-105">
        </div>
      </div>

      <!-- Right Features -->
      <div class="space-y-16 order-3 text-center lg:text-left flex flex-col items-center lg:items-start">
        <div class="flex flex-col lg:flex-row items-center lg:items-start gap-4 group reveal reveal-right">
          <div class="w-14 h-14 shrink-0 rounded-2xl border border-acc-emerald/40 bg-sec-dark/80 text-acc-emerald flex items-center justify-center text-xl shadow-lg group-hover:shadow-glow-emerald transition-all">
            <i class="fa-solid fa-wand-magic-sparkles"></i>
          </div>
          <div>
            <h4 class="text-xl font-bold text-white group-hover:text-acc-emerald transition-colors">120Hz Emerald AMOLED</h4>
            <p class="text-xs text-txt-sec mt-2 max-w-xs leading-relaxed mx-auto lg:mx-0">Ketajaman warna 1 miliar spektrum dengan konsumsi daya super efisien dan perlindungan mata VIP.</p>
          </div>
        </div>
        
        <div class="flex flex-col lg:flex-row items-center lg:items-start gap-4 group reveal reveal-right" style="transition-delay: 150ms;">
          <div class="w-14 h-14 shrink-0 rounded-2xl border border-acc-emerald/40 bg-sec-dark/80 text-acc-emerald flex items-center justify-center text-xl shadow-lg group-hover:shadow-glow-emerald transition-all">
            <i class="fa-solid fa-shield-halved"></i>
          </div>
          <div>
            <h4 class="text-xl font-bold text-white group-hover:text-acc-emerald transition-colors">Armor Space Titanium</h4>
            <p class="text-xs text-txt-sec mt-2 max-w-xs leading-relaxed mx-auto lg:mx-0">Bingkai ultra ringan standar kedirgantaraan berkekuatan tinggi, tahan gores, korosi, dan benturan.</p>
          </div>
        </div>
      </div>

    </div>
  </section>

  <!-- ========================================== -->
  <!-- 6. KATEGORI PRODUK (COMPACT CARDS)         -->
  <!-- ========================================== -->
  <section id="kategori" class="py-24 px-6 lg:px-16 relative overflow-hidden">
    <div class="max-w-7xl mx-auto relative z-10">
      
      <!-- Header -->
      <div class="flex flex-col md:flex-row md:items-end justify-between mb-14 reveal">
        <div>
          <p class="text-acc-emerald font-semibold text-sm tracking-widest uppercase mb-2">Layanan Unggulan</p>
          <h2 class="text-3xl md:text-4xl font-bold text-white">Solusi Teknologi Eksklusif</h2>
        </div>
        <a href="<?php echo base_url('landing/layanan'); ?>" class="text-gold-accent text-xs font-bold tracking-widest uppercase mt-4 md:mt-0 flex items-center gap-2 border-b border-gold-accent/30 pb-1 hover:text-white hover:border-white transition-all">
          LIHAT SEMUA LAYANAN <i class="fa-solid fa-arrow-trend-up"></i>
        </a>
      </div>

      <!-- Horizontal Cards Grid -->
      <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
        <?php foreach(array_slice($services, 0, 3) as $s): ?>
        <a href="<?php echo base_url('landing/layanan'); ?>" class="glass-card rounded-[2rem] p-8 flex flex-col relative overflow-hidden group transition-all duration-300 hover:border-gold-accent/40 reveal">
          <div class="space-y-3 relative z-10 flex-grow">
            <div class="w-12 h-12 rounded-xl bg-gold-accent/10 border border-gold-accent/30 flex items-center justify-center text-gold-accent text-xl">
              <i class="fa-solid <?php echo $s['icon']; ?>"></i>
            </div>
            <h3 class="text-2xl font-bold text-white group-hover:text-gold-accent transition-colors"><?php echo $s['title']; ?></h3>
            <p class="text-xs text-txt-sec max-w-xs"><?php echo $s['description']; ?></p>
            <span class="inline-flex items-center gap-1 text-xs font-bold text-gold-accent pt-2 group-hover:translate-x-1 transition-transform">Selengkapnya <i class="fa-solid fa-chevron-right text-[9px]"></i></span>
          </div>
        </a>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <!-- ========================================== -->
  <!-- 7. STATISTIK ELEGAN (COUNTER ANIMATION)    -->
  <!-- ========================================== -->
  <section id="stats" class="py-20 bg-stat-gradient border-y border-sec-dark px-6 lg:px-16 relative overflow-hidden">
    <div class="max-w-7xl mx-auto relative z-10">
      <div class="grid grid-cols-2 lg:grid-cols-4 gap-10 md:gap-14 text-center">
        
        <!-- Stat Item 1 -->
        <div class="space-y-2 reveal">
          <div class="text-4xl sm:text-5xl font-extrabold text-gold-accent flex items-center justify-center tracking-tighter leading-none">
            <span class="counter-number text-gradient-gold text-gold-glow" data-target="10000">0</span>
            <span class="text-gold-accent">+</span>
          </div>
          <p class="text-[11px] text-txt-sec font-bold uppercase tracking-widest pt-2">customer</p>
        </div>

        <!-- Stat Item 2 -->
        <div class="space-y-2 reveal">
          <div class="text-4xl sm:text-5xl font-extrabold text-white flex items-center justify-center tracking-tighter leading-none">
            <span class="counter-number" data-target="500">0</span>
            <span class="text-acc-emerald">+</span>
          </div>
          <p class="text-[11px] text-txt-sec font-bold uppercase tracking-widest pt-2">Koleksi HP</p>
        </div>

        <!-- Stat Item 3 -->
        <div class="space-y-2 reveal">
          <div class="text-4xl sm:text-5xl font-extrabold text-white flex items-center justify-center tracking-tighter leading-none">
            <span class="counter-number" data-target="49">0</span>
            <span class="text-xs text-gold-accent absolute translate-x-[22px] translate-y-[-12px]">/5.0</span>
          </div>
          <!-- Custom label with star icon overlay -->
          <p class="text-[11px] text-txt-sec font-bold uppercase tracking-widest pt-2 flex items-center justify-center gap-1">
            Rating Bintang <i class="fa-solid fa-star text-gold-accent text-[9px]"></i>
          </p>
        </div>

        <!-- Stat Item 4 -->
        <div class="space-y-2 reveal">
          <div class="text-4xl sm:text-5xl font-extrabold text-gold-accent flex items-center justify-center tracking-tighter leading-none">
            <span class="counter-number text-gradient-gold text-gold-glow" data-target="24">0</span>
            <span class="text-gold-accent">/7</span>
          </div>
          <p class="text-[11px] text-txt-sec font-bold uppercase tracking-widest pt-2">Dukungan Ahli</p>
        </div>

      </div>
    </div>
  </section>

  <!-- ========================================== -->
  <!-- 8. PROMO BANNER WITH COUNTDOWN             -->
  <!-- ========================================== -->
  <section id="promo" class="py-24 px-6 lg:px-16 relative">
    <div class="max-w-6xl mx-auto relative z-10 reveal">
      <div class="relative rounded-[2.5rem] overflow-hidden border border-gold-accent/30 p-8 md:p-14 bg-gradient-luxury shadow-2xl">
        <!-- Pattern bg overlay -->
        <div class="absolute inset-0 opacity-5" style="background-image: radial-gradient(circle, #D4AF37 1px, transparent 1px); background-size: 20px 20px;"></div>
        
        <!-- Glowing spots within card -->
        <div class="absolute top-0 right-0 w-[300px] h-[300px] bg-acc-emerald/20 blur-[60px] pointer-events-none"></div>
        
        <div class="grid md:grid-cols-2 items-center gap-10 relative z-10">
          
          <div class="space-y-6 text-center md:text-left">
            <span class="bg-gold-accent/20 border border-gold-accent/40 text-gold-accent px-4 py-1.5 rounded-full text-xs font-extrabold tracking-widest uppercase">Sorotan Terlaris</span>
            <h2 class="text-3xl md:text-4xl lg:text-5xl font-extrabold text-white leading-tight">Koleksi Flagship Paling Diminati</h2>
            <p class="text-txt-sec text-sm sm:text-base max-w-md mx-auto md:mx-0">Miliki mahakarya terpopuler kami, <strong>Veridian Obsidian Series</strong>, yang telah menjadi pilihan ribuan pelanggan VIP global berkat perpaduan sempurna antara kemewahan material titanium dan kecepatan prosesor absolut.</p>
            <a href="#produk" class="inline-block px-8 py-3.5 bg-gold-accent text-main-bg rounded-full font-bold tracking-wide text-sm transition-all duration-300 btn-gold-glow uppercase">Miliki Koleksi Ini</a>
          </div>

          <div class="flex flex-col items-center justify-center space-y-6 bg-deep-dark/40 border border-acc-emerald/20 backdrop-blur-lg rounded-3xl p-8">
            <p class="text-xs tracking-widest text-txt-sec uppercase">Sisa Waktu Penawaran</p>
            
            <!-- Countdown Display -->
            <div class="flex gap-4 sm:gap-6 items-center">
              <div class="text-center">
                <div id="timer-hours" class="w-16 h-16 sm:w-20 sm:h-20 rounded-2xl border-2 border-gold-accent flex items-center justify-center text-2xl sm:text-3xl font-extrabold text-white shadow-glow-gold">00</div>
                <span class="text-[10px] text-txt-sec uppercase mt-2 block tracking-wider">Jam</span>
              </div>
              <div class="text-2xl sm:text-3xl font-bold text-gold-accent animate-pulse">:</div>
              <div class="text-center">
                <div id="timer-minutes" class="w-16 h-16 sm:w-20 sm:h-20 rounded-2xl border border-acc-emerald flex items-center justify-center text-2xl sm:text-3xl font-extrabold text-white">00</div>
                <span class="text-[10px] text-txt-sec uppercase mt-2 block tracking-wider">Menit</span>
              </div>
              <div class="text-2xl sm:text-3xl font-bold text-acc-emerald animate-pulse">:</div>
              <div class="text-center">
                <div id="timer-seconds" class="w-16 h-16 sm:w-20 sm:h-20 rounded-2xl border border-acc-emerald flex items-center justify-center text-2xl sm:text-3xl font-extrabold text-white text-acc-emerald">00</div>
                <span class="text-[10px] text-txt-sec uppercase mt-2 block tracking-wider">Detik</span>
              </div>
            </div>
          </div>

        </div>
      </div>
    </div>
  </section>

  <!-- ========================================== -->
  <!-- 9. VIDEO PREVIEW / UI MOCKUP SECTION       -->
  <!-- ========================================== -->
  <section class="py-24 bg-deep-dark relative overflow-hidden px-6 lg:px-16">
    <div class="max-w-7xl mx-auto grid lg:grid-cols-2 gap-16 items-center relative z-10">
      
      <!-- Informational Column -->
      <div class="space-y-7">
        <div class="inline-flex items-center gap-2 px-3 py-1 rounded bg-acc-emerald/10 border border-acc-emerald/30 text-acc-emerald font-bold text-[10px] uppercase tracking-widest reveal">
          Veridian OS 4.0
        </div>
        <h2 class="text-3xl md:text-5xl font-black text-white leading-tight reveal reveal-slow" style="transition-delay: 250ms;">
          Sistem Operasi Terbersih, <br>
          <span class="text-gradient-gold text-gold-glow">Sangat Mulus & Responsif.</span>
        </h2>
        <p class="text-txt-sec font-light text-base md:text-lg leading-relaxed reveal reveal-slow" style="transition-delay: 550ms;">
          Rasakan integrasi fluid interface dengan physics engine tercanggih. Bebas bloatware, berorientasi penuh pada efisiensi baterai dan visual transisi selembut sutra.
        </p>
        
        <!-- Feature bullets -->
        <div class="grid sm:grid-cols-2 gap-4 reveal" style="transition-delay: 850ms;">
          <div class="flex items-center gap-3 bg-sec-dark/30 p-4 rounded-xl border border-sec-dark text-xs text-white">
            <i class="fa-solid fa-bolt text-gold-accent text-sm"></i> 1ms Touch Response
          </div>
          <div class="flex items-center gap-3 bg-sec-dark/30 p-4 rounded-xl border border-sec-dark text-xs text-white">
            <i class="fa-solid fa-shield-check text-gold-accent text-sm"></i> Ultra Cyber Security
          </div>
          <div class="flex items-center gap-3 bg-sec-dark/30 p-4 rounded-xl border border-sec-dark text-xs text-white">
            <i class="fa-solid fa-battery-full text-gold-accent text-sm"></i> AI Power Saving
          </div>
          <div class="flex items-center gap-3 bg-sec-dark/30 p-4 rounded-xl border border-sec-dark text-xs text-white">
            <i class="fa-solid fa-hand-sparkles text-gold-accent text-sm"></i> Zero Bloatware App
          </div>
        </div>
      </div>

      <!-- 3D perspective mockup screen container -->
      <div class="perspective-frame flex justify-center lg:justify-end relative reveal">
        <!-- Floating back card -->
        <div class="absolute left-0 top-1/4 w-32 h-32 bg-acc-emerald/10 border border-acc-emerald/30 rounded-3xl blur-sm pointer-events-none transform -rotate-12 z-0 hidden sm:block"></div>
        
        <div class="device-mockup-frame relative w-[290px] sm:w-[350px] aspect-[9/19] bg-deep-dark rounded-[2.75rem] border-8 border-sec-dark overflow-hidden z-10 group select-none cursor-pointer">
          
          <!-- Internal Camera Notch -->
          <div class="absolute top-0 left-1/2 -translate-x-1/2 w-32 h-6 bg-[#0B1D1B] rounded-b-2xl z-30 flex items-center justify-center">
            <div class="w-2 h-2 rounded-full bg-[#12352F] ring-4 ring-black/20"></div>
          </div>
          
          <!-- Mockup Screen Graphic -->
          <div class="w-full h-full pointer-events-none">
            <img src="<?php echo base_url(); ?>assets/img/mockup_screen.png" alt="UX Layout Preview" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105 filter contrast-115 saturate-110">
          </div>

          <!-- Glowing reflective swipe -->
          <div class="absolute inset-0 bg-gradient-to-tr from-transparent via-white/5 to-transparent -translate-x-full group-hover:translate-x-full transition-transform duration-[1.5s] ease-out z-20"></div>
        </div>
      </div>

    </div>
  </section>

  <!-- ========================================== -->
  <!-- 10. TESTIMONIALS VIP                       -->
  <!-- ========================================== -->
  <section class="py-24 px-6 lg:px-16 relative overflow-hidden border-t border-sec-dark">
    <div class="max-w-7xl mx-auto">
      
      <!-- Header -->
      <div class="text-center mb-16 reveal">
        <p class="text-acc-emerald font-semibold text-sm tracking-widest uppercase mb-2">Apa Kata Mereka</p>
        <h2 class="text-3xl md:text-4xl font-bold text-white mb-4">Dipercaya Kalangan Elite</h2>
        <div class="h-1 w-20 bg-acc-emerald mx-auto opacity-40"></div>
      </div>

      <!-- Testimonial Grid -->
      <div class="grid md:grid-cols-3 gap-8">
        
        <!-- Card 1 -->
        <div class="glass-card rounded-[2rem] p-8 relative flex flex-col space-y-6 reveal">
          <i class="fa-solid fa-quote-left text-4xl text-gold-accent/10 absolute top-6 right-8"></i>
          <div class="flex items-center gap-1 text-gold-accent text-xs">
            <i class="fa-solid fa-star"></i>
            <i class="fa-solid fa-star"></i>
            <i class="fa-solid fa-star"></i>
            <i class="fa-solid fa-star"></i>
            <i class="fa-solid fa-star"></i>
          </div>
          <p class="text-sm leading-relaxed font-light text-txt-sec italic flex-grow">
            "Material titanium emerald-nya benar-benar memikat mata. Sangat terasa aura premium dan eksklusifnya. Kamera ultra-wide 200MP-nya luar biasa tajam!"
          </p>
          <div class="flex items-center gap-4 border-t border-sec-dark/50 pt-6">
            <div class="w-12 h-12 rounded-full border-2 border-gold-accent overflow-hidden">
              <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="User profile" class="w-full h-full object-cover">
            </div>
            <div>
              <h5 class="text-white font-bold text-sm">Adrian Perkasa</h5>
              <p class="text-[10px] text-txt-sec tracking-wider uppercase">Chief Technology Officer</p>
            </div>
          </div>
        </div>

        <!-- Card 2 -->
        <div class="glass-card rounded-[2rem] p-8 relative flex flex-col space-y-6 reveal">
          <i class="fa-solid fa-quote-left text-4xl text-gold-accent/10 absolute top-6 right-8"></i>
          <div class="flex items-center gap-1 text-gold-accent text-xs">
            <i class="fa-solid fa-star"></i>
            <i class="fa-solid fa-star"></i>
            <i class="fa-solid fa-star"></i>
            <i class="fa-solid fa-star"></i>
            <i class="fa-solid fa-star"></i>
          </div>
          <p class="text-sm leading-relaxed font-light text-txt-sec italic flex-grow">
            "Desain bodinya super sleek dan minimalis, sangat mencerminkan profesionalitas bisnis. Pelayanan VIP Concierge-nya juga sangat responsif dan ramah."
          </p>
          <div class="flex items-center gap-4 border-t border-sec-dark/50 pt-6">
            <div class="w-12 h-12 rounded-full border-2 border-gold-accent overflow-hidden">
              <img src="https://randomuser.me/api/portraits/women/44.jpg" alt="User profile" class="w-full h-full object-cover">
            </div>
            <div>
              <h5 class="text-white font-bold text-sm">Helena Wijaya</h5>
              <p class="text-[10px] text-txt-sec tracking-wider uppercase">Creative Entrepreneur</p>
            </div>
          </div>
        </div>

        <!-- Card 3 -->
        <div class="glass-card rounded-[2rem] p-8 relative flex flex-col space-y-6 reveal">
          <i class="fa-solid fa-quote-left text-4xl text-gold-accent/10 absolute top-6 right-8"></i>
          <div class="flex items-center gap-1 text-gold-accent text-xs">
            <i class="fa-solid fa-star"></i>
            <i class="fa-solid fa-star"></i>
            <i class="fa-solid fa-star"></i>
            <i class="fa-solid fa-star"></i>
            <i class="fa-regular fa-star"></i>
          </div>
          <p class="text-sm leading-relaxed font-light text-txt-sec italic flex-grow">
            "Performa gaming dan multi-tasking tercepat yang pernah saya coba tahun ini. Pengiriman super kilat dan packing kayu berlapis beludru yang sangat mewah."
          </p>
          <div class="flex items-center gap-4 border-t border-sec-dark/50 pt-6">
            <div class="w-12 h-12 rounded-full border-2 border-gold-accent overflow-hidden">
              <img src="https://randomuser.me/api/portraits/men/85.jpg" alt="User profile" class="w-full h-full object-cover">
            </div>
            <div>
              <h5 class="text-white font-bold text-sm">Bagas Wicaksono</h5>
              <p class="text-[10px] text-txt-sec tracking-wider uppercase">Tech Reviewer / Vlogger</p>
            </div>
          </div>
        </div>

      </div>
    </div>
  </section>

  <!-- ========================================== -->
  <!-- 11. WHY CHOOSE US ACCORDION SECTION        -->
  <!-- ========================================== -->
  <section id="tim" class="py-24 bg-deep-dark/60 px-6 lg:px-16 border-y border-sec-dark">
    <div class="max-w-7xl mx-auto">
      <div class="text-center mb-16 reveal">
        <p class="text-gold-accent font-semibold text-sm tracking-widest uppercase mb-2">The Visionaries</p>
        <h2 class="text-3xl md:text-4xl font-bold text-white mb-4">Bertemu Tim Kami</h2>
        <div class="h-1 w-20 bg-gold-accent/40 mx-auto"></div>
      </div>

      <div class="grid grid-cols-2 lg:grid-cols-4 gap-3 md:gap-8">
        <?php foreach(array_slice($team, 0, 4) as $t): ?>
        <div class="glass-card rounded-2xl md:rounded-[2rem] overflow-hidden flex flex-col group reveal">
          <div class="relative aspect-[4/5] overflow-hidden">
            <img src="<?php echo base_url(); ?>assets/img/<?php echo $t['photo']; ?>" alt="<?php echo $t['name']; ?>" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
          </div>
          <div class="p-3 md:p-6 text-center">
            <h4 class="text-sm md:text-lg font-bold text-white group-hover:text-gold-accent transition-colors line-clamp-1"><?php echo $t['name']; ?></h4>
            <p class="text-[9px] md:text-[10px] text-gold-accent font-bold uppercase tracking-widest"><?php echo $t['position']; ?></p>
          </div>
        </div>
        <?php endforeach; ?>
      </div>
      
      <div class="text-center mt-12">
        <a href="<?php echo base_url('landing/tim'); ?>" class="inline-block px-8 py-3 rounded-full border border-gold-accent/30 text-gold-accent hover:bg-gold-accent hover:text-main-bg font-bold text-xs uppercase tracking-widest transition-all">Lihat Semua Tim</a>
      </div>
    </div>
  </section>

  <!-- ========================================== -->
  <!-- 12. NEWSLETTER LUXURY SECTION              -->
  <!-- ========================================== -->
  <section id="newsletter" class="py-24 px-6 relative overflow-hidden flex items-center justify-center">
    <!-- Parallax Background Blur -->
    <div class="absolute inset-0 bg-cover bg-center opacity-[0.05] scale-110 pointer-events-none bg-[url('https://images.unsplash.com/photo-1605810230434-7631ac76ec81?q=80&w=1600')] parallax-bg"></div>
    <div class="absolute inset-0 bg-gradient-to-b from-main-bg via-main-bg/95 to-main-bg pointer-events-none"></div>
    
    <div class="max-w-3xl w-full relative z-10 text-center space-y-7">
      <div class="inline-flex items-center justify-center w-16 h-16 rounded-full border border-gold-accent/30 bg-sec-dark/60 text-gold-accent text-2xl shadow-glow-gold mb-2 reveal">
        <i class="fa-regular fa-bell"></i>
      </div>
      <h2 class="text-3xl md:text-5xl font-black text-white reveal reveal-slow" style="transition-delay: 250ms;">Update Teknologi Eksklusif</h2>
      <p class="text-txt-sec text-sm sm:text-base max-w-lg mx-auto font-light leading-relaxed reveal reveal-slow" style="transition-delay: 550ms;">
        Jadilah yang pertama mengetahui terobosan inovasi terbaru, rilis perangkat edisi terbatas khusus kolektor, serta wawasan tren gadget masa depan langsung ke email Anda.
      </p>
      
      <!-- Input Form Wrapper -->
      <form onsubmit="event.preventDefault(); alert('Terima kasih! Anda akan segera menerima update teknologi eksklusif kami.');" class="flex flex-col sm:flex-row max-w-md mx-auto gap-3 pt-4 reveal" style="transition-delay: 850ms;">
        <input type="email" required placeholder="Ketik alamat email profesional Anda" class="flex-grow px-6 py-4 rounded-full border border-sec-dark bg-deep-dark/50 text-white text-sm focus:border-gold-accent focus:outline-none placeholder-txt-sec/40 shadow-inner transition-all">
        <button type="submit" class="px-8 py-4 rounded-full bg-gold-accent text-main-bg font-extrabold text-xs uppercase tracking-widest btn-gold-glow flex items-center justify-center gap-2">
          DAPATKAN UPDATE <i class="fa-solid fa-chevron-right text-[10px]"></i>
        </button>
      </form>
      <p class="text-[10px] text-txt-sec/30 uppercase tracking-widest reveal" style="transition-delay: 1100ms;">Keamanan privasi terjamin & tanpa pesan sampah.</p>
    </div>
  </section>

  <!-- ========================================== -->
  <!-- 13. FOOTER PREMIUM                         -->
  <!-- ========================================== -->
  <footer id="kontak" class="bg-deep-dark border-t border-sec-dark pt-16 pb-8 px-6 lg:px-16 text-txt-sec relative overflow-hidden">
    <div class="max-w-7xl mx-auto grid md:grid-cols-2 lg:grid-cols-4 gap-12 mb-16 relative z-10">
      
      <!-- Col 1: Brand -->
      <div class="space-y-6">
        <a href="#" class="flex items-center space-x-2">
          <div class="w-8 h-8 rounded-lg border border-gold-accent flex items-center justify-center">
            <i class="fa-solid fa-shield-halved text-gold-accent text-xs"></i>
          </div>
          <span class="text-xl font-bold tracking-wider text-white">VERIDIAN LTD</span>
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

      <!-- Col 2: Links -->
      <div>
        <h4 class="text-white font-bold tracking-wider text-sm uppercase mb-6 relative after:content-[''] after:absolute after:left-0 after:-bottom-2 after:w-8 after:h-[2px] after:bg-gold-accent">Perusahaan</h4>
        <ul class="space-y-4 text-xs">
          <li><a href="#" class="hover:text-white hover:underline decoration-gold-accent underline-offset-4 transition-colors">Tentang Kami</a></li>
          <li><a href="#" class="hover:text-white hover:underline decoration-gold-accent underline-offset-4 transition-colors">Karir Global</a></li>
          <li><a href="#" class="hover:text-white hover:underline decoration-gold-accent underline-offset-4 transition-colors">Press Kit</a></li>
          <li><a href="#" class="hover:text-white hover:underline decoration-gold-accent underline-offset-4 transition-colors">Keberlanjutan</a></li>
        </ul>
      </div>

      <!-- Col 3: Links Support -->
      <div>
        <h4 class="text-white font-bold tracking-wider text-sm uppercase mb-6 relative after:content-[''] after:absolute after:left-0 after:-bottom-2 after:w-8 after:h-[2px] after:bg-gold-accent">Dukungan</h4>
        <ul class="space-y-4 text-xs">
          <li><a href="#" class="hover:text-white hover:underline decoration-gold-accent underline-offset-4 transition-colors">Hubungi Kami</a></li>
          <li><a href="#" class="hover:text-white hover:underline decoration-gold-accent underline-offset-4 transition-colors">Pusat Bantuan</a></li>
          <li><a href="#" class="hover:text-white hover:underline decoration-gold-accent underline-offset-4 transition-colors">Klaim Garansi</a></li>
          <li><a href="#" class="hover:text-white hover:underline decoration-gold-accent underline-offset-4 transition-colors">Kebijakan Privasi</a></li>
        </ul>
      </div>

      <!-- Col 4: Address VIP -->
      <div class="space-y-5">
        <h4 class="text-white font-bold tracking-wider text-sm uppercase relative after:content-[''] after:absolute after:left-0 after:-bottom-2 after:w-8 after:h-[2px] after:bg-gold-accent">Showroom</h4>
        <p class="text-xs leading-relaxed font-light">
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

    <!-- Bottom Footer -->
    <div class="max-w-7xl mx-auto border-t border-sec-dark pt-8 text-center flex flex-col sm:flex-row items-center justify-between gap-4 relative z-10">
      <p class="text-[10px] tracking-widest text-txt-sec/60 uppercase">
        &copy; 2026 <?php echo $store['name']; ?>. All Rights Reserved.
      </p>
      <div class="flex items-center gap-6 text-[10px] uppercase tracking-wider">
        <a href="#" class="hover:text-white transition-colors">Syarat & Ketentuan</a>
        <span class="text-sec-dark">|</span>
        <a href="#" class="hover:text-white transition-colors">Peta Situs</a>
      </div>
    </div>

  </footer>

  <!-- Custom JS File -->
  <script src="<?php echo base_url('assets/js/script.js'); ?>"></script>
  <script>
    // Initialize Product Swiper
    var swiper = new Swiper(".productSwiper", {
      slidesPerView: 1,
      spaceBetween: 30,
      loop: true,
      autoplay: {
        delay: 3500,
        disableOnInteraction: false,
      },
      pagination: {
        el: ".swiper-pagination",
        clickable: true,
      },
      breakpoints: {
        640: {
          slidesPerView: 2,
        },
        1024: {
          slidesPerView: 3,
        },
      },
    });
  </script>
</body>
</html>
