<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tentang Kami | <?php echo $store['name']; ?></title>
  
  <!-- Tailwind CSS CDN -->
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

  <link rel="stylesheet" href="<?php echo base_url('assets/css/all.min.css'); ?>">
  <link rel="stylesheet" href="<?php echo base_url('assets/css/style.css'); ?>">
</head>
<body class="bg-main-bg text-txt-main font-sans selection:bg-gold-accent selection:text-main-bg overflow-x-hidden">

  <!-- Glow Cursor Element -->
  <div id="cursorGlow" class="cursor-glow"></div>

  <!-- ========================================== -->
  <!-- 1. NAVBAR PREMIUM                          -->
  <!-- ========================================== -->
  <nav id="navbar" class="fixed top-0 left-0 w-full z-50 px-6 lg:px-16 py-5 transition-all duration-300 border-b border-transparent bg-transparent">
    <div class="max-w-7xl mx-auto flex justify-between items-center">
      <!-- Logo -->
      <a href="<?php echo base_url(); ?>" class="flex items-center space-x-2 group">
        <div class="w-9 h-9 rounded-lg border-2 border-gold-accent flex items-center justify-center bg-sec-dark/80 group-hover:shadow-glow-gold transition-all duration-300">
          <i class="fa-solid fa-shield-halved text-gold-accent text-sm"></i>
        </div>
        <span class="text-2xl font-bold tracking-wider text-white group-hover:text-gold-accent transition-all duration-300">
          VERIDIAN<span class="text-gold-accent">LTD</span>
        </span>
      </a>

      <!-- Menu Links (Desktop) -->
      <ul class="hidden md:flex space-x-8 font-medium text-sm tracking-wider text-txt-sec">
        <li><a href="<?php echo base_url(); ?>" class="hover:text-white hover:shadow-sm transition-all duration-300 relative group">HOME<span class="absolute left-0 bottom-[-4px] w-0 h-[2px] bg-gold-accent group-hover:w-full transition-all duration-300"></span></a></li>
        <li><a href="<?php echo base_url('landing/produk'); ?>" class="hover:text-white transition-all duration-300 relative group">PRODUK<span class="absolute left-0 bottom-[-4px] w-0 h-[2px] bg-gold-accent group-hover:w-full transition-all duration-300"></span></a></li>
        <li><a href="<?php echo base_url('landing/layanan'); ?>" class="hover:text-white transition-all duration-300 relative group">LAYANAN<span class="absolute left-0 bottom-[-4px] w-0 h-[2px] bg-gold-accent group-hover:w-full transition-all duration-300"></span></a></li>
        <li><a href="<?php echo base_url('landing/tim'); ?>" class="hover:text-white transition-all duration-300 relative group">TIM KAMI<span class="absolute left-0 bottom-[-4px] w-0 h-[2px] bg-gold-accent group-hover:w-full transition-all duration-300"></span></a></li>
        <li><a href="<?php echo base_url('landing/kontak'); ?>" class="hover:text-white transition-all duration-300 relative group">KONTAK KAMI<span class="absolute left-0 bottom-[-4px] w-0 h-[2px] bg-gold-accent group-hover:w-full transition-all duration-300"></span></a></li>
        <li><a href="<?php echo base_url('landing/tentang'); ?>" class="text-white transition-all duration-300 relative group">TENTANG KAMI<span class="absolute left-0 bottom-[-4px] w-full h-[2px] bg-gold-accent transition-all duration-300"></span></a></li>
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
      <a href="<?php echo base_url('landing/tentang'); ?>" class="text-gold-accent py-2 transition-colors">TENTANG KAMI</a>
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
  <!-- 2. HERO / ABOUT CONTENT SECTION            -->
  <!-- ========================================== -->
  <section class="pt-32 pb-24 px-6 lg:px-16 relative">
    <!-- Ambient Blur Glows -->
    <div class="absolute top-1/4 left-0 w-72 h-72 rounded-full bg-acc-emerald/10 blur-[100px] pointer-events-none"></div>
    <div class="absolute bottom-1/4 right-0 w-80 h-80 rounded-full bg-gold-accent/5 blur-[120px] pointer-events-none"></div>

    <div class="max-w-7xl mx-auto">
      <div class="text-center mb-16">
        <p class="text-gold-accent font-semibold text-sm tracking-widest uppercase mb-2">Eksplorasi Visi Kami</p>
        <h2 class="text-4xl md:text-5xl font-bold text-white mb-6">Tentang Kami</h2>
        <div class="h-1.5 w-24 bg-gold-accent mx-auto rounded-full"></div>
      </div>

      <div class="grid lg:grid-cols-12 gap-12 items-center">
        <!-- Visual Column (Left) -->
        <div class="lg:col-span-5 reveal">
          <div class="relative group">
            <!-- Glow Border Behind Image -->
            <div class="absolute -inset-1.5 bg-gradient-luxury rounded-[2.5rem] blur-md opacity-40 group-hover:opacity-75 transition duration-500"></div>
            
            <div class="relative bg-deep-dark rounded-[2.5rem] overflow-hidden border border-sec-dark shadow-2xl aspect-[4/5] flex items-center justify-center">
              <?php if (!empty($store['about_image'])): ?>
                <img src="<?php echo base_url('assets/img/'.$store['about_image']); ?>" alt="Tentang Kami" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
              <?php else: ?>
                <div class="p-8 text-center">
                  <div class="w-20 h-20 rounded-full bg-gold-accent/10 border border-gold-accent/30 flex items-center justify-center text-gold-accent text-3xl mx-auto mb-4">
                    <i class="fa-solid fa-users"></i>
                  </div>
                  <span class="text-white font-bold text-xl block mb-2"><?php echo $store['name']; ?></span>
                  <p class="text-txt-sec text-sm leading-relaxed">Berkomitmen melayani kebutuhan teknologi & gadget berkualitas tinggi untuk Anda.</p>
                </div>
              <?php endif; ?>
            </div>
          </div>
        </div>

        <!-- Text / Story Column (Right) -->
        <div class="lg:col-span-7 space-y-6 reveal">
          <span class="inline-block px-4 py-1.5 rounded-full bg-gold-accent/10 border border-gold-accent/20 text-gold-accent text-xs font-bold uppercase tracking-wider">
            <?php echo !empty($store['about_subtitle']) ? $store['about_subtitle'] : 'Premium Gadget Store'; ?>
          </span>
          
          <h3 class="text-3xl md:text-4xl font-bold text-white tracking-wide leading-tight">
            <?php echo !empty($store['about_title']) ? $store['about_title'] : 'Solusi Teknologi & Gadget Terbaik Anda'; ?>
          </h3>
          
          <div class="h-1 w-20 bg-acc-emerald rounded-full"></div>
          
          <div class="text-txt-sec text-base leading-relaxed space-y-4 font-light">
            <?php if (!empty($store['about_content'])): ?>
              <?php echo nl2br(htmlspecialchars($store['about_content'])); ?>
            <?php else: ?>
              <p>Selamat datang di <strong><?php echo $store['name']; ?></strong>, destinasi terpercaya Anda untuk semua kebutuhan perangkat keras dan gadget premium dengan garansi resmi dan orisinalitas mutlak.</p>
              <p>Didirikan dengan visi untuk mempermudah akses ke teknologi terdepan, kami menyediakan ekosistem terpadu yang memadukan kualitas produk unggulan dengan keandalan layanan purna jual kami.</p>
              <p>Mulai dari smartphone flagship, aksesoris premium, hingga layanan konsultasi teknis profesional, tim ahli kami berdedikasi untuk memberikan pengalaman belanja yang tak tertandingi di industri gadget Indonesia.</p>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- ========================================== -->
  <!-- 3. VALUES / CORE ADVANTAGES SECTION        -->
  <!-- ========================================== -->
  <section class="py-20 px-6 lg:px-16 bg-deep-dark border-t border-b border-sec-dark/40 relative">
    <div class="max-w-7xl mx-auto">
      <div class="text-center mb-16">
        <p class="text-gold-accent font-semibold text-sm tracking-widest uppercase mb-2">Nilai-Nilai Inti</p>
        <h3 class="text-3xl font-bold text-white mb-4">Mengapa Memilih Kami?</h3>
        <div class="h-1 w-16 bg-gold-accent mx-auto rounded-full"></div>
      </div>

      <div class="grid md:grid-cols-3 gap-8">
        <!-- Value Card 1 -->
        <div class="bg-main-bg/40 p-8 rounded-[2rem] border border-sec-dark/50 hover:border-gold-accent/40 hover:shadow-glow-emerald transition-all duration-300 group">
          <div class="w-14 h-14 rounded-2xl bg-gold-accent/10 border border-gold-accent/20 flex items-center justify-center text-gold-accent text-2xl mb-6 group-hover:scale-110 transition-transform duration-300">
            <i class="fa-solid fa-gem"></i>
          </div>
          <h4 class="text-white font-bold text-xl mb-3">Produk Orisinal Premium</h4>
          <p class="text-txt-sec text-sm leading-relaxed">Kami menjamin keaslian 100% pada semua jajaran produk gadget, aksesoris, dan unit elektronik dengan dukungan klaim garansi resmi yang sangat mudah.</p>
        </div>

        <!-- Value Card 2 -->
        <div class="bg-main-bg/40 p-8 rounded-[2rem] border border-sec-dark/50 hover:border-gold-accent/40 hover:shadow-glow-emerald transition-all duration-300 group">
          <div class="w-14 h-14 rounded-2xl bg-acc-emerald/10 border border-acc-emerald/20 flex items-center justify-center text-acc-emerald text-2xl mb-6 group-hover:scale-110 transition-transform duration-300">
            <i class="fa-solid fa-headset"></i>
          </div>
          <h4 class="text-white font-bold text-xl mb-3">Layanan Bantuan 24/7</h4>
          <p class="text-txt-sec text-sm leading-relaxed">Tim dukungan teknis dan customer service kami selalu siaga mendampingi Anda di setiap tahap pemesanan hingga penanganan produk setelah pembelian selesai.</p>
        </div>

        <!-- Value Card 3 -->
        <div class="bg-main-bg/40 p-8 rounded-[2rem] border border-sec-dark/50 hover:border-gold-accent/40 hover:shadow-glow-emerald transition-all duration-300 group">
          <div class="w-14 h-14 rounded-2xl bg-gold-accent/10 border border-gold-accent/20 flex items-center justify-center text-gold-accent text-2xl mb-6 group-hover:scale-110 transition-transform duration-300">
            <i class="fa-solid fa-shield-halved"></i>
          </div>
          <h4 class="text-white font-bold text-xl mb-3">Transaksi Terenkripsi Aman</h4>
          <p class="text-txt-sec text-sm leading-relaxed">Nikmati beragam kemudahan pembayaran yang terenkripsi aman, mulai dari Transfer Bank instan, integrasi e-wallet, hingga metode bayar di tempat (COD) terpercaya.</p>
        </div>
      </div>
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
          <li><a href="#" class="hover:text-white hover:underline decoration-gold-accent underline-offset-4 transition-colors">Klaim Garansi VIP</a></li>
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

  <script src="<?php echo base_url('assets/js/script.js'); ?>"></script>
</body>
</html>
