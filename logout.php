<?php
// Mulai session untuk mengaksesnya
session_start();

// Hapus semua variabel session
$_SESSION = array();

// Hancurkan session
session_destroy();

// Alihkan pengguna ke halaman login
header("location: login.php");
exit;
?>