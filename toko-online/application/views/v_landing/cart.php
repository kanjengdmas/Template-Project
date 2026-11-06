<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keranjang | VERIDIAN Luxury Tech</title>
    <script src="<?php echo base_url('assets/js/tailwindcss.js'); ?>"></script>
    <link rel="stylesheet" href="<?php echo base_url('assets/css/all.min.css'); ?>">
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
                    }
                }
            }
        }
    </script>
    <style>
        .glass { background: rgba(18, 53, 47, 0.6); backdrop-filter: blur(10px); border: 1px solid rgba(31, 138, 112, 0.2); }
    </style>
</head>
<body class="bg-main-bg text-txt-main min-h-screen p-4 md:p-8">
    <div class="max-w-2xl mx-auto">
        <div class="flex items-center justify-between mb-6">
            <a href="<?php echo base_url('landing/produk'); ?>" class="text-gold-accent flex items-center gap-1.5 hover:translate-x-[-3px] transition-transform text-sm font-semibold">
                <i class="fa-solid fa-arrow-left"></i> Kembali
            </a>
            <h1 class="text-2xl font-bold tracking-wider">KERAN<span class="text-gold-accent">JANG</span></h1>
        </div>

        <?php if(empty($cart)): ?>
            <div class="glass rounded-3xl p-8 text-center">
                <i class="fa-solid fa-cart-shopping text-5xl text-gray-700 mb-4 block"></i>
                <h2 class="text-lg font-bold mb-1">Keranjang Anda Kosong</h2>
                <p class="text-gray-400 mb-6 text-sm">Pilih smartphone premium impian Anda sekarang.</p>
                <a href="<?php echo base_url('landing/produk'); ?>" class="bg-gold-accent text-main-bg px-6 py-2.5 rounded-full font-bold uppercase tracking-widest text-xs">Cari Produk</a>
            </div>
        <?php else: ?>
            <div class="space-y-2">
                <?php $total = 0; foreach($cart as $item): $total += ($item['price'] * $item['qty']); ?>
                <div class="glass rounded-xl p-3 flex items-center gap-3">
                    <img src="<?php echo base_url('assets/img/'.$item['image']); ?>" alt="" class="w-12 h-12 md:w-16 md:h-16 object-contain bg-main-bg/50 rounded-lg p-1 flex-shrink-0">
                    <div class="flex-grow min-w-0">
                        <h3 class="text-sm md:text-base font-bold text-white truncate"><?php echo $item['name']; ?></h3>
                        <div class="flex flex-wrap items-baseline gap-x-2">
                            <span class="text-gold-accent font-bold text-xs md:text-sm">Rp <?php echo number_format($item['price'] * $item['qty'], 0, ',', '.'); ?></span>
                            <?php if ($item['qty'] > 1): ?>
                                <span class="text-[9px] md:text-[10px] text-txt-sec">(@ Rp <?php echo number_format($item['price'], 0, ',', '.'); ?>)</span>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="flex flex-col items-end gap-1.5 flex-shrink-0">
                        <form id="form-<?php echo $item['id']; ?>" action="<?php echo base_url('landing/update_cart'); ?>" method="POST" class="flex items-center">
                            <input type="hidden" name="id" value="<?php echo $item['id']; ?>">
                            <div class="flex items-center bg-main-bg/50 border border-sec-dark rounded-md overflow-hidden">
                                <button type="button" onclick="changeQty('<?php echo $item['id']; ?>', -1)" class="px-2 py-0.5 hover:bg-sec-dark transition-colors text-xs font-semibold">-</button>
                                <input type="number" id="qty-input-<?php echo $item['id']; ?>" name="qty" value="<?php echo $item['qty']; ?>" class="w-6 md:w-8 bg-transparent text-center focus:outline-none [appearance:textfield] [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none text-xs font-semibold" readonly>
                                <button type="button" onclick="changeQty('<?php echo $item['id']; ?>', 1)" class="px-2 py-0.5 hover:bg-sec-dark transition-colors text-xs font-semibold">+</button>
                            </div>
                        </form>
                        <button type="button" onclick="deleteItem('<?php echo $item['id']; ?>')" class="text-red-500 hover:text-red-400 flex items-center gap-1 text-[10px] font-bold uppercase tracking-wider transition-all duration-300" title="Hapus Barang">
                            <i class="fa-solid fa-trash-can text-[9px] md:text-[10px]"></i> Hapus
                        </button>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>

            <script>
                function changeQty(id, delta) {
                    const input = document.getElementById('qty-input-' + id);
                    const form = document.getElementById('form-' + id);
                    let currentVal = parseInt(input.value);
                    
                    // If current qty is 1 and user hits minus, ask for confirmation to remove
                    if (currentVal === 1 && delta === -1) {
                        deleteItem(id);
                    } else {
                        input.value = currentVal + delta;
                        form.submit();
                    }
                }

                function deleteItem(id) {
                    if (confirm('Apakah Anda yakin ingin menghapus produk ini dari keranjang belanja Anda?')) {
                        const input = document.getElementById('qty-input-' + id);
                        const form = document.getElementById('form-' + id);
                        input.value = 0;
                        form.submit();
                    }
                }
            </script>

            <div class="mt-4 glass rounded-xl p-4 flex items-center justify-between gap-2 border-t-2 border-t-gold-accent">
                <div>
                    <p class="text-[10px] text-gray-400 uppercase tracking-widest mb-0.5">Total Pembayaran</p>
                    <h2 class="text-lg md:text-xl font-black text-gold-accent">Rp <?php echo number_format($total, 0, ',', '.'); ?></h2>
                </div>
                <a href="<?php echo base_url('landing/checkout'); ?>" class="bg-gold-accent text-main-bg px-5 py-2 md:px-6 md:py-2.5 rounded-full font-black uppercase tracking-widest text-[10px] md:text-xs hover:shadow-[0_0_20px_rgba(212,175,55,0.4)] transition-all flex items-center gap-1 flex-shrink-0">
                    Checkout <i class="fa-solid fa-chevron-right text-[8px] md:text-[10px]"></i>
                </a>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>
