<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nota #<?php echo $order['id']; ?> | VERIDIAN</title>
    <script src="<?php echo base_url('assets/js/tailwindcss.js'); ?>"></script>
    <link rel="stylesheet" href="<?php echo base_url('assets/css/all.min.css'); ?>">
    <style>
        @media print {
            body { background: white !important; color: black !important; }
            .no-print { display: none !important; }
            .glass { background: white !important; border: 1px solid #ccc !important; box-shadow: none !important; }
            .text-gold-accent { color: #D4AF37 !important; }
        }
    </style>
</head>
<body class="bg-gray-100 p-6 flex flex-col items-center">
    
    <div class="no-print mb-8 space-x-4">
        <button onclick="window.print()" class="bg-blue-600 text-white px-6 py-2 rounded-lg font-bold">Cetak Nota</button>
        <a href="<?php echo base_url('landing/pesanan'); ?>" class="bg-gray-600 text-white px-6 py-2 rounded-lg font-bold">Kembali</a>
    </div>

    <div class="max-w-2xl w-full bg-white text-black p-10 rounded-xl shadow-lg border border-gray-200 glass">
        <div class="flex justify-between items-start mb-10 pb-10 border-b border-gray-100">
            <div>
                <h1 class="text-2xl font-black tracking-widest text-black">VERIDIAN <span class="text-yellow-600">LUXURY</span></h1>
                <p class="text-xs text-gray-500 max-w-[200px] mt-2"><?php echo $store['address']; ?></p>
            </div>
            <div class="text-right">
                <h2 class="text-xl font-bold uppercase tracking-widest">Nota Pesanan</h2>
                <p class="text-sm text-gray-500">ID: #ORD-<?php echo str_pad($order['id'], 5, '0', STR_PAD_LEFT); ?></p>
                <p class="text-sm text-gray-500">Tanggal: <?php echo date('d/m/Y H:i', strtotime($order['order_date'])); ?></p>
            </div>
        </div>

        <div class="mb-10 grid grid-cols-2 gap-6 pb-6 border-b border-gray-100">
            <div>
                <h3 class="text-xs font-bold uppercase tracking-widest text-gray-400 mb-2">Informasi Penerima</h3>
                <p class="font-bold text-sm text-black"><?php echo htmlspecialchars($order['recipient_name']); ?></p>
                <p class="text-xs text-gray-600 mt-1"><i class="fa-solid fa-phone text-gray-400 mr-1"></i> <?php echo htmlspecialchars($order['phone_number']); ?></p>
                <p class="text-xs text-gray-600 mt-1"><i class="fa-solid fa-location-dot text-gray-400 mr-1"></i> <?php echo htmlspecialchars($order['address']); ?></p>
            </div>
            <div>
                <h3 class="text-xs font-bold uppercase tracking-widest text-gray-400 mb-2">Informasi Pembayaran</h3>
                <p class="text-xs font-bold uppercase text-gray-700">Metode: <?php echo htmlspecialchars($order['payment_method'] === 'transfer' ? 'Transfer Bank' : ($order['payment_method'] === 'ewallet' ? 'E-Wallet' : 'COD (Bayar di Tempat)')); ?></p>
                <?php if (!empty($order['payment_detail'])): ?>
                    <p class="text-xs text-gray-600 mt-1">Detail Pengirim: <strong class="uppercase text-yellow-600"><?php echo htmlspecialchars($order['payment_detail']); ?></strong></p>
                <?php endif; ?>
                <p class="text-xs text-gray-600 mt-2">Status: <span class="font-bold uppercase <?php echo ($order['status'] == 'pending') ? 'text-red-500' : 'text-green-500'; ?>"><?php echo $order['status']; ?></span></p>
            </div>
        </div>

        <table class="w-full mb-10 text-sm">
            <thead>
                <tr class="border-b-2 border-gray-100">
                    <th class="text-left py-4">Produk</th>
                    <th class="text-center py-4">Qty</th>
                    <th class="text-right py-4">Harga</th>
                    <th class="text-right py-4">Subtotal</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($items as $i): ?>
                <tr class="border-b border-gray-50">
                    <td class="py-4 font-semibold"><?php echo $i['name']; ?></td>
                    <td class="py-4 text-center"><?php echo $i['quantity']; ?></td>
                    <td class="py-4 text-right">Rp <?php echo number_format($i['price'], 0, ',', '.'); ?></td>
                    <td class="py-4 text-right font-bold">Rp <?php echo number_format($i['price'] * $i['quantity'], 0, ',', '.'); ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="3" class="text-right py-6 font-bold text-lg">Total Pembayaran</td>
                    <td class="text-right py-6 font-black text-xl text-yellow-600">Rp <?php echo number_format($order['total_amount'], 0, ',', '.'); ?></td>
                </tr>
            </tfoot>
        </table>

        <div class="text-center pt-10 border-t border-gray-100 italic text-xs text-gray-400">
            Terima kasih telah mempercayakan kemewahan Anda kepada VERIDIAN Luxury Tech.
        </div>
    </div>
</body>
</html>
