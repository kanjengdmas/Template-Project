<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($title) ? $title : 'Sistem Peminjaman Alat' ?></title>
    <!-- Bootstrap 5 CSS -->
    <link href="<?= base_url('assets/css/bootstrap.min.css') ?>" rel="stylesheet">
    <!-- FontAwesome -->
    <link rel="stylesheet" href="<?= base_url('assets/css/all.min.css') ?>">
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="<?= base_url('assets/css/dataTables.bootstrap5.min.css') ?>">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">
    <style>
        :root {
            --bs-primary: #2563EB;
            --bs-success: #22C55E;
            --bs-warning: #F59E0B;
            --bs-danger: #EF4444;
            --bs-body-bg: #F8FAFC;
        }
        body { font-family: 'Inter', sans-serif; background-color: var(--bs-body-bg); }
        .sidebar { 
            min-height: 100vh; 
            background: linear-gradient(180deg, #0F4CFF 0%, #0A3FD6 50%, #062B9A 100%); 
            color: white; 
            transition: all 0.3s; 
        }
        .sidebar a { color: rgba(255,255,255,.8); text-decoration: none; padding: 10px 20px; display: block; }
        .sidebar a:hover, .sidebar a.active { color: white; background-color: rgba(255,255,255,.1); }
        .main-content { width: 100%; transition: all 0.3s; }
        .topbar { background-color: white; box-shadow: 0 2px 4px rgba(0,0,0,.08); }
        
        .text-primary { color: var(--bs-primary) !important; }
        .bg-primary { background-color: var(--bs-primary) !important; }
        .btn-primary { background-color: var(--bs-primary); border-color: var(--bs-primary); }
        .btn-primary:hover { background-color: #1d4ed8; border-color: #1d4ed8; }
        
        .text-success { color: var(--bs-success) !important; }
        .bg-success { background-color: var(--bs-success) !important; }
        .btn-success { background-color: var(--bs-success); border-color: var(--bs-success); }
        
        .text-warning { color: var(--bs-warning) !important; }
        .bg-warning { background-color: var(--bs-warning) !important; }
        .btn-warning { background-color: var(--bs-warning); border-color: var(--bs-warning); color: #fff; }
        
        .text-danger { color: var(--bs-danger) !important; }
        .bg-danger { background-color: var(--bs-danger) !important; }
        .btn-danger { background-color: var(--bs-danger); border-color: var(--bs-danger); }

        .card { background-color: #FFFFFF; border: 1px solid #E5E7EB; box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px 0 rgba(0, 0, 0, 0.06); }

        @media (min-width: 768px) {
            .wrapper { display: flex; }
            .sidebar { width: 250px; flex-shrink: 0; }
        }
    </style>
</head>
<body>
    <div class="wrapper d-flex flex-column flex-md-row">
