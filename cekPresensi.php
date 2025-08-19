<?php
session_start();
include 'config.php';

header("Content-Type: application/json"); // <- PENTING: karena kirim JSON ke JS

// Cek metode request
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    echo json_encode(["success" => false, "message" => "❌ Metode tidak valid."]);
    exit;
}

// Cek apakah sudah login
if (!isset($_SESSION['npm']) || !isset($_SESSION['uid'])) {
    echo json_encode(["success" => false, "message" => "❌ Harus login dulu."]);
    exit;
}

$kode_qr = $_POST['kode'] ?? '';
$npm     = $_SESSION['npm'];
$uid     = $_SESSION['uid'];
$now     = date("Y-m-d H:i:s");

// Validasi input
if (empty($kode_qr)) {
    echo json_encode(["success" => false, "message" => "❌ Kode QR tidak dikirim."]);
    exit;
}

// Cek apakah kode valid
$stmt = $conn->prepare("SELECT matkul FROM kodeAbsen WHERE kode = ? LIMIT 1");
$stmt->bind_param("s", $kode_qr);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo json_encode(["success" => false, "message" => "❌ Kode QR tidak ditemukan."]);
    exit;
}

$data   = $result->fetch_assoc();
$matkul = $data['matkul'];

// Cek apakah sudah pernah absen
$check = $conn->prepare("SELECT 1 FROM kehadiran WHERE NPM = ? AND kode = ?");
$check->bind_param("is", $npm, $kode_qr);
$check->execute();
$check_result = $check->get_result();

if ($check_result->num_rows > 0) {
    echo json_encode(["success" => false, "message" => "⚠️ Kamu sudah absen untuk kode ini."]);
    exit;
}

// Simpan presensi
$insert = $conn->prepare("INSERT INTO kehadiran (NPM, kode, waktu, matkul) VALUES (?, ?, ?, ?)");
$insert->bind_param("ssss", $npm, $kode_qr, $now, $matkul);

if ($insert->execute()) {
    // Tambah cat food ke user
    $update_food = $conn->prepare("UPDATE oyen SET catfood = catfood + 1 WHERE user_id = ?");
    $update_food->bind_param("i", $uid);
    $update_food->execute();
    $update_food->close();

    // Kirim response JSON ke JavaScript
    echo json_encode([
        "success" => true,
        "redirect" => "earnCatFood.php"
    ]);
    exit;

} else {
    echo json_encode(["success" => false, "message" => "❌ Gagal menyimpan presensi."]);
}
?>
