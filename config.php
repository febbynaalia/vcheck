<?php

date_default_timezone_set("Asia/Jakarta");


$host = "localhost";
$user = "root";
$pass = "Alkalisatu1"; // <-- Isi dengan password database Anda
$db   = "vcheck";

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>