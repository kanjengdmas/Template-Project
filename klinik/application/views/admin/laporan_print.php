<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <!-- Custom styles for this template-->
    <link href="<?= base_url('assets/sbadmin/') ?>css/sb-admin-2.min.css" rel="stylesheet">
    <style>
        body {
            color: #000;
            background-color: #fff;
        }
        @media print {
            @page { margin: 1cm; }
            body { margin: 1.6cm; }
            .no-print { display: none; }
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #000;
            padding-bottom: 10px;
        }
        .header h2 { margin: 0; font-weight: bold; }
        .header p { margin: 0; font-size: 14px; }
        .table th, .table td { border: 1px solid #000 !important; }
    </style>
</head>
<body>
    <div class="container-fluid mt-4">
        <div class="header">
            <h2>KLINIK DIGITAL</h2>
            <p>Jl. Sehat Selalu No. 123, Kota Kesehatan</p>
            <p>Telp: (021) 1234567 | Email: info@klinikdigital.com</p>
        </div>

        <h4 class="text-center mb-4">LAPORAN DATA PEMERIKSAAN PASIEN</h4>

        <table class="table table-bordered">
            <thead class="text-center font-weight-bold">
                <tr>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>Nama Pasien</th>
                    <th>Keluhan</th>
                    <th>Dokter</th>
                    <th>Diagnosis</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1; foreach ($pemeriksaan as $p): ?>
                <tr>
                    <td class="text-center"><?= $no++ ?></td>
                    <td><?= date('d M Y', strtotime($p->tanggal)) ?></td>
                    <td><?= $p->nama_pasien ?></td>
                    <td><?= $p->keluhan ?></td>
                    <td><?= $p->nama_dokter ? $p->nama_dokter : '-' ?></td>
                    <td><?= $p->diagnosis ? $p->diagnosis : '-' ?></td>
                    <td class="text-center"><?= $p->status ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <div class="row mt-5">
            <div class="col-8"></div>
            <div class="col-4 text-center">
                <p>Jakarta, <?= date('d M Y') ?></p>
                <br><br><br>
                <p class="font-weight-bold">Administrator</p>
            </div>
        </div>
    </div>

    <script>
        window.print();
    </script>
</body>
</html>
