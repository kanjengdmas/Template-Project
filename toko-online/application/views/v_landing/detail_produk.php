<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $product['name']; ?> | VERIDIAN Luxury Tech</title>
    <script src="<?php echo base_url('assets/js/tailwindcss.js'); ?>"></script>
    <link rel="stylesheet" href="<?php echo base_url('assets/css/all.min.css'); ?>"></script>
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
                    },
                    boxShadow: {
                        'glow-emerald': '0 0 30px rgba(31, 138, 112, 0.2)',
                        'glow-gold': '0 0 30px rgba(212, 175, 55, 0.3)',
                    }
                }
            }
        }
    </script>
    <style>
        .glass { background: rgba(18, 53, 47, 0.4); backdrop-filter: blur(15px); border: 1px solid rgba(31, 138, 112, 0.2); }
        .reveal { opacity: 0; transform: translateY(30px); transition: all 0.8s ease-out; }
        .reveal.active { opacity: 1; transform: translateY(0); }
    </style>
</head>
<body class="bg-main-bg text-txt-main min-h-screen overflow-x-hidden">
    
    <!-- Navbar (Minimalist) -->
    <nav class="fixed top-0 left-0 w-full z-50 px-6 py-6 transition-all duration-300">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <a href="<?php echo base_url('landing/produk'); ?>" class="text-gold-accent flex items-center gap-2 hover:translate-x-[-5px] transition-transform font-bold tracking-widest uppercase text-sm">
                <i class="fa-solid fa-arrow-left"></i> Kembali ke Katalog
            </a>
            <div class="flex items-center gap-6">
                <a href="<?php echo base_url('landing/cart_view'); ?>" class="relative text-txt-sec hover:text-white transition-colors">
                    <i class="fa-solid fa-cart-shopping text-xl"></i>
                    <?php if($cart_count > 0): ?>
                        <span class="absolute -top-2 -right-2 bg-gold-accent text-main-bg text-[10px] font-bold w-4 h-4 rounded-full flex items-center justify-center"><?php echo $cart_count; ?></span>
                    <?php endif; ?>
                </a>
            </div>
        </div>
    </nav>

    <main class="pt-32 pb-20 px-6 lg:px-16">
        <div class="max-w-7xl mx-auto">
            <div class="grid lg:grid-cols-2 gap-16 items-center">
                
                <!-- Product Image Area -->
                <div class="relative group reveal">
                    <div class="absolute inset-0 bg-gold-accent/5 rounded-[3rem] blur-3xl group-hover:bg-gold-accent/10 transition-all duration-700"></div>
                    <div class="glass rounded-[3rem] p-8 md:p-16 flex items-center justify-center relative overflow-hidden border border-gold-accent/10">
                        <img src="<?php echo base_url('assets/img/'.$product['image']); ?>" alt="<?php echo $product['name']; ?>" class="w-full h-auto object-contain max-h-[500px] drop-shadow-[0_20px_50px_rgba(0,0,0,0.5)] transform hover:scale-105 transition-transform duration-700">
                    </div>
                </div>

                <!-- Product Details Area -->
                <div class="space-y-8 reveal" style="transition-delay: 0.2s;">
                    <div>
                        <p class="text-gold-accent font-black tracking-[0.3em] uppercase text-sm mb-4">The New Standard</p>
                        <h1 class="text-5xl md:text-7xl font-black text-white leading-tight mb-4"><?php echo $product['name']; ?></h1>
                        <div class="flex items-center gap-4">
                            <span class="px-4 py-1 rounded-full bg-acc-emerald/20 text-acc-emerald text-xs font-bold tracking-widest uppercase border border-acc-emerald/30">Premium Series</span>
                            <div class="flex text-gold-accent text-sm">
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                            </div>
                        </div>
                    </div>

                    <div class="space-y-4">
                        <p class="text-2xl font-bold text-gold-accent">Rp <?php echo number_format($product['price'], 0, ',', '.'); ?></p>
                        <div class="h-1 w-20 bg-acc-emerald rounded-full"></div>
                        <p class="text-txt-sec text-lg leading-relaxed max-w-xl">
                            <?php echo $product['description']; ?>
                        </p>
                    </div>

                    <!-- Tech Specs (Static Mockup) -->
                    <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                        <div class="glass p-4 rounded-2xl border-white/5">
                            <p class="text-[10px] text-gray-500 uppercase tracking-widest mb-1">Display</p>
                            <p class="text-sm font-bold">6.7" Super OLED</p>
                        </div>
                        <div class="glass p-4 rounded-2xl border-white/5">
                            <p class="text-[10px] text-gray-500 uppercase tracking-widest mb-1">Processor</p>
                            <p class="text-sm font-bold">Veridian V1 Chip</p>
                        </div>
                        <div class="glass p-4 rounded-2xl border-white/5">
                            <p class="text-[10px] text-gray-500 uppercase tracking-widest mb-1">Camera</p>
                            <p class="text-sm font-bold">108MP Cinematic</p>
                        </div>
                    </div>

                    <div class="pt-8 flex flex-col sm:flex-row gap-4">
                        <a href="<?php echo base_url('landing/buy_now/'.$product['id']); ?>" class="flex-grow bg-gold-accent text-main-bg py-5 px-8 rounded-2xl font-black text-center uppercase tracking-widest hover:shadow-glow-gold transition-all duration-300 transform hover:scale-[1.02]">
                            Lanjutkan ke Checkout <i class="fa-solid fa-chevron-right ml-2"></i>
                        </a>
                        <a href="<?php echo base_url('landing/add_to_cart/'.$product['id']); ?>" class="bg-sec-dark border border-acc-emerald/30 py-5 px-8 rounded-2xl font-bold text-center uppercase tracking-widest hover:bg-acc-emerald transition-all duration-300">
                            <i class="fa-solid fa-bag-shopping"></i>
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const reveals = document.querySelectorAll('.reveal');
            reveals.forEach(el => el.classList.add('active'));
        });
    </script>
</body>
</html>
