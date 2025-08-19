<?php
session_start();
include 'config.php';

// Cek apakah user sudah login
if (!isset($_SESSION['uid'])) {
    echo "Akses ditolak. Silakan login terlebih dahulu.";
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["file"])) {
    // Ambil data dari session dan form
    $user_id = $_SESSION['uid'];
    $nama = $_SESSION['nama']; // Ambil nama dari session
    $keterangan = $_POST["keterangan"];

    // Proses file upload
    $file_name = $_FILES["file"]["name"];
    $tmp = $_FILES["file"]["tmp_name"];
    $target_dir = "uploads/";
    
    // Buat nama file unik untuk menghindari tumpang tindih
    $new_file_name = uniqid() . '-' . basename($file_name);
    $target_file = $target_dir . $new_file_name;

    if (move_uploaded_file($tmp, $target_file)) {
        // Gunakan prepared statements
        $stmt = $conn->prepare("INSERT INTO uploads (user_id, nama, keterangan, filename) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("isss", $user_id, $nama, $keterangan, $new_file_name);
        
        if ($stmt->execute()) {
            echo "Upload berhasil.";
        } else {
            echo "Gagal menyimpan data ke database.";
        }
        $stmt->close();
    } else {
        echo "Upload file gagal.";
    }
} else {
    echo "Tidak ada file yang diupload atau metode request salah.";
}
$conn->close();
?>