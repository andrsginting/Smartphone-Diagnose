<?php
session_start();

// Menampilkan notifikasi jika ada
if (isset($_SESSION['message'])) {
    echo "<script>alert('{$_SESSION['message']}');</script>";
    unset($_SESSION['message']); // Menghapus pesan setelah ditampilkan
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Utama</title>
    <link rel="stylesheet" href="assets/css/utama.css">
</head>
<body>
    <h1>Selamat Datang di Sistem Deteksi Smartphone</h1>
    <div class="btn-group">
        <a href="login.php" class="btn">Login</a>
        <a href="register.php" class="btn">Register</a>
    </div>
</body>
</html>
