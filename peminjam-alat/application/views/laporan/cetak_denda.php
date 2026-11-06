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
        <?php if($tgl_awal && $tgl_akhir): ?>
            <p>Periode: <?= date('d/m/Y', strtotime($tgl_awal)) ?> s/d <?= date('d/m/Y', strtotime($tgl_akhir)) ?></p>
        <?php endif; ?>
    </div>

    <table>
        <thead>
            <tr>
                <th width="5%" class="text-center">No</th>
                <th>Nomor Denda</th>
                <th>Kode Peminjaman</th>
                <th>Nama Peminjam</th>
                <th>Alat</th>
                <th>Kerusakan</th>
                <th>Nominal</th>
                <th>Status</th>
                <th>Tanggal</th>
            </tr>
        </thead>
        <tbody>
            <?php if(empty($laporan)): ?>
                <tr><td colspan="9" class="text-center">Data tidak ditemukan</td></tr>
            <?php else: ?>
                <?php $no=1; $total=0; foreach($laporan as $l): $total+=$l['nominal_denda']; ?>
                <tr>
                    <td class="text-center"><?= $no++ ?></td>
                    <td><?= $l['nomor_denda'] ?></td>
                    <td><?= $l['kode_peminjaman'] ?></td>
                    <td><?= $l['nama_peminjam'] ?></td>
                    <td><?= $l['nama_alat'] ?></td>
                    <td><?= $l['jenis_kerusakan'] ?></td>
                    <td>Rp <?= number_format($l['nominal_denda'], 0, ',', '.') ?></td>
                    <td><?= $l['status_pembayaran'] ?></td>
                    <td><?= date('d/m/Y H:i', strtotime($l['created_at'])) ?></td>
                </tr>
                <?php endforeach; ?>
                <tr>
                    <td colspan="6" style="text-align:right; font-weight:bold;">TOTAL DENDA</td>
                    <td colspan="3" style="font-weight:bold;">Rp <?= number_format($total, 0, ',', '.') ?></td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</body>
</html>
