<!DOCTYPE html>
<html>
<head>
    <title>Laporan Transaksi #<?php echo $order['id']; ?></title>
    <style>
        body { font-family: sans-serif; padding: 40px; }
        .header { text-align: center; border-bottom: 2px solid #333; padding-bottom: 20px; margin-bottom: 30px; }
        .info { margin-bottom: 30px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #ddd; padding: 12px; text-align: left; }
        th { background-color: #f2f2f2; }
        .total { text-align: right; font-size: 1.2em; font-weight: bold; margin-top: 20px; }
        @media print {
            .no-print { display: none; }
        }
    </style>
</head>
<body onload="window.print()">
    <div class="header">
        <h1><?php echo $store['name']; ?></h1>
        <p><?php echo $store['address']; ?></p>
        <p>WhatsApp: <?php echo $store['whatsapp']; ?> | Email: <?php echo $store['email']; ?></p>
    </div>

    <div class="info">
        <h3>Laporan Transaksi</h3>
        <p>Order ID: #ORD-<?php echo str_pad($order['id'], 5, '0', STR_PAD_LEFT); ?></p>
        <p>Tanggal: <?php echo date('d F Y H:i', strtotime($order['order_date'])); ?></p>
        <p>Status: <strong><?php echo strtoupper($order['status']); ?></strong></p>
    </div>

    <table>
        <thead>
            <tr>
                <th>Produk</th>
                <th>Qty</th>
                <th>Harga Satuan</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($items as $i): ?>
            <tr>
                <td><?php echo $i['product_name']; ?></td>
                <td><?php echo $i['quantity']; ?></td>
                <td>Rp <?php echo number_format($i['price'], 0, ',', '.'); ?></td>
                <td>Rp <?php echo number_format($i['price'] * $i['quantity'], 0, ',', '.'); ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <div class="total">
        Total Pembayaran: Rp <?php echo number_format($order['total_amount'], 0, ',', '.'); ?>
    </div>

    <div style="margin-top: 50px; text-align: right;">
        <p>Dicetak pada: <?php echo date('d/m/Y H:i:s'); ?></p>
        <br><br><br>
        <p>( ____________________ )</p>
        <p>Administrator</p>
    </div>
</body>
</html>
