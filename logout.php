<?php
session_start();
session_unset();
session_destroy();

// Set pesan notifikasi untuk logout
session_start();
$_SESSION['message'] = "Logout berhasil.";
header("Location: utama.php");
exit;
?>
