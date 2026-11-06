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
                <th>Kode</th>
                <th>Peminjam</th>
                <th>Alat</th>
                <th class="text-center">Jml</th>
                <th>Tgl Pengajuan</th>
                <th>Tgl Pinjam</th>
                <th>Tgl Kembali Rencana</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php if(empty($laporan)): ?>
                <tr><td colspan="9" class="text-center">Data tidak ditemukan</td></tr>
            <?php else: ?>
                <?php $no=1; foreach($laporan as $l): ?>
                <tr>
                    <td class="text-center"><?= $no++ ?></td>
                    <td><?= $l['kode_peminjaman'] ?></td>
                    <td><?= $l['nama_peminjam'] ?></td>
                    <td><?= $l['nama_alat'] ?></td>
                    <td class="text-center"><?= $l['jumlah'] ?></td>
                    <td><?= date('d/m/Y H:i', strtotime($l['tanggal_pengajuan'])) ?></td>
                    <td><?= $l['tanggal_pinjam'] ? date('d/m/Y', strtotime($l['tanggal_pinjam'])) : '-' ?></td>
                    <td><?= date('d/m/Y', strtotime($l['tanggal_kembali_rencana'])) ?></td>
                    <td><?= $l['status'] ?></td>
                </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
</body>
</html>
