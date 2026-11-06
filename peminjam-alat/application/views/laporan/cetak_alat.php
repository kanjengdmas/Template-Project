<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= $title ?></title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #000; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        .text-center { text-align: center; }
        .header { text-align: center; margin-bottom: 20px; border-bottom: 2px solid #000; padding-bottom: 10px; }
        @media print {
            .no-print { display: none; }
        }
    </style>
</head>
<body <?= isset($_POST['format']) && $_POST['format'] == 'print' ? 'onload="window.print()"' : '' ?>>
    <div class="header">
        <h2>SISTEM PEMINJAMAN ALAT (SIPANJA)</h2>
        <h3><?= strtoupper($title) ?></h3>
    </div>

    <table>
        <thead>
            <tr>
                <th width="5%" class="text-center">No</th>
                <th>Kode Alat</th>
                <th>Nama Alat</th>
                <th>Kategori</th>
                <th class="text-center">Stok</th>
                <th>Kondisi</th>
                <th>Lokasi</th>
                <th>Status Ketersediaan</th>
            </tr>
        </thead>
        <tbody>
            <?php if(empty($laporan)): ?>
                <tr><td colspan="8" class="text-center">Data tidak ditemukan</td></tr>
            <?php else: ?>
                <?php $no=1; foreach($laporan as $l): ?>
                <tr>
                    <td class="text-center"><?= $no++ ?></td>
                    <td><?= $l['kode_alat'] ?></td>
                    <td><?= $l['nama_alat'] ?></td>
                    <td><?= $l['nama_kategori'] ?></td>
                    <td class="text-center"><?= $l['stok'] ?></td>
                    <td><?= $l['kondisi'] ?></td>
                    <td><?= $l['lokasi_penyimpanan'] ?></td>
                    <td><?= $l['status_ketersediaan'] ?></td>
                </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
</body>
</html>
