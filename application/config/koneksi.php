<?php
$host = "localhost";
$user = "root";
$pass = ""; // Kosongkan jika menggunakan XAMPP standar
$db   = "perpus"; // Sesuaikan dengan nama database di perpus.sql

$koneksi = mysqli_connect($host, $user, $pass, $db);

if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>