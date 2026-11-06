<!DOCTYPE html>
<html>
<head>
    <title>Laporan Stok Barang - VERIDIAN SHOP</title>
    <style>
        body { font-family: 'Arial', sans-serif; color: #333; }
        .header { text-align: center; margin-bottom: 30px; border-bottom: 2px solid #333; padding-bottom: 10px; }
        .header h2 { margin: 0; text-transform: uppercase; }
        .header p { margin: 5px 0; font-size: 14px; }
        
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        table th, table td { border: 1px solid #999; padding: 10px; text-align: left; font-size: 13px; }
        table th { background-color: #f2f2f2; }
        
        .footer { margin-top: 50px; text-align: right; }
        .footer p { font-size: 14px; }
        .date { font-style: italic; font-size: 12px; margin-top: 20px; }

        @media print {
            .btn-print { display: none; }
            @page { margin: 1cm; }
        }
    </style>
</head>
<body>

    <div class="header">
        <h2><?php echo isset($store['name']) ? $store['name'] : 'VERIDIAN SHOP'; ?></h2>
        <p><?php echo isset($store['address']) ? $store['address'] : '-'; ?></p>
        <p>WhatsApp: <?php echo isset($store['whatsapp']) ? $store['whatsapp'] : '-'; ?> | Email: <?php echo isset($store['email']) ? $store['email'] : '-'; ?></p>
        <h3 style="margin-top: 15px;">LAPORAN STOK BARANG</h3>
    </div>

    <p class="date">Dicetak pada: <?php echo date('d/m/Y H:i'); ?></p>

    <table>
        <thead>
            <tr>
                <th width="5%">No</th>
                <th>Nama Barang</th>
                <th>Kategori</th>
                <th>Harga Satuan</th>
                <th width="10%">Stok</th>
            </tr>
        </thead>
        <tbody>
            <?php $no=1; foreach($barang as $b): ?>
            <tr>
                <td><?php echo $no++; ?></td>
                <td><?php echo $b['name']; ?></td>
                <td><?php echo $b['category']; ?></td>
                <td>Rp <?php echo number_format($b['price'], 0, ',', '.'); ?></td>
                <td><?php echo $b['stock']; ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <div class="footer">
        <p>Hormat Kami,</p>
        <br><br><br>
        <p><strong>Administrator</strong></p>
    </div>

    <script>
        window.print();
        window.onafterprint = function() {
            window.close();
        };
    </script>

</body>
</html>
