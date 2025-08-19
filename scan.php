<?php
// Mulai session untuk mendapatkan user ID
session_start();
include 'config.php';

// Cek apakah user sudah login
if (!isset($_SESSION['uid'])) {
    echo "Akses ditolak. Silakan login terlebih dahulu.";
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil user_id dari SESSION, bukan dari POST untuk keamanan
    $user_id = $_SESSION['uid']; 
    $kode = $_POST['kode_qr'];

    // Gunakan prepared statements untuk keamanan
    $stmt = $conn->prepare("INSERT INTO kehadiran (uid, kode, waktu) VALUES (?, ?, NOW())");
    $stmt->bind_param("is", $user_id, $kode);

    if ($stmt->execute()) {
        echo "Kehadiran tercatat!";
        // Anda bisa menambahkan logika untuk memberi 'cat food' di sini
    } else {
        echo "Gagal mencatat kehadiran: " . $stmt->error;
    }
    $stmt->close();
} else {
    echo "Metode request tidak valid.";
}
$conn->close();
?>