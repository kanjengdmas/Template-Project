<?php
// Koneksi database
$host = 'localhost';
$user = 'root';
$pass = '';
$db   = 'peminjamanalat';

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("<div style='font-family:sans-serif;padding:20px;color:red;'>Koneksi database gagal: " . $conn->connect_error . "</div>");
}

$username = 'admin';
$password_plain = 'admin123';
$role = 'Admin';
$nama = 'Administrator';
$email = 'admin@sipanja.local';

// Generate hash bcrypt yang 100% valid menggunakan PHP lokal
$hash = password_hash($password_plain, PASSWORD_DEFAULT);

// Cek apakah admin sudah ada
$cek = $conn->query("SELECT id FROM users WHERE username = '$username'");

if ($cek && $cek->num_rows > 0) {
    $stmt = $conn->prepare("UPDATE users SET password = ?, role = ?, nama = ?, email = ? WHERE username = ?");
    $stmt->bind_param('sssss', $hash, $role, $nama, $email, $username);
    $stmt->execute();
    $action = "diperbarui (UPDATE)";
} else {
    $stmt = $conn->prepare("INSERT INTO users (username, password, nama, role, email) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param('sssss', $username, $hash, $nama, $role, $email);
    $stmt->execute();
    $action = "dibuat baru (INSERT)";
}

// Verifikasi langsung
$verify = password_verify($password_plain, $hash);

$conn->close();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Reset Password Admin Sipanja</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light py-5">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow border-0 rounded-4">
                <div class="card-body p-4 text-center">
                    <div class="text-success mb-3" style="font-size: 3rem;">
                        &#10004;
                    </div>
                    <h3 class="fw-bold text-success mb-2">Akun Admin Berhasil <?= $action ?>!</h3>
                    <p class="text-muted">Password telah di-hash secara native oleh PHP dan siap digunakan.</p>

                    <div class="bg-light p-3 rounded-3 text-start mb-4 border">
                        <table class="table table-sm table-borderless mb-0">
                            <tr>
                                <th style="width: 140px;">Username:</th>
                                <td><span class="badge bg-primary fs-6">admin</span></td>
                            </tr>
                            <tr>
                                <th>Password:</th>
                                <td><span class="badge bg-dark fs-6">admin123</span></td>
                            </tr>
                            <tr>
                                <th>Role:</th>
                                <td><span class="badge bg-success fs-6">Admin</span></td>
                            </tr>
                            <tr>
                                <th>Status Verify:</th>
                                <td><?= $verify ? '<span class="text-success fw-bold">&#10003; VALID</span>' : '<span class="text-danger fw-bold">&#10007; GAGAL</span>' ?></td>
                            </tr>
                        </table>
                    </div>

                    <a href="auth" class="btn btn-primary btn-lg w-100 rounded-pill shadow-sm">
                        Menuju Halaman Login &rarr;
                    </a>

                    <p class="small text-muted mt-3 mb-0">
                        <em>Tips: Setelah berhasil login, file <code>reset_admin.php</code> ini bisa dihapus untuk keamanan.</em>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
