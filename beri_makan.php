<?php
session_start();
include 'config.php';

// Pastikan user login
if (!isset($_SESSION['uid'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['uid'];

// Ambil data pet
$stmt = $conn->prepare("SELECT catfood, levelKenyang FROM oyen WHERE user_id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$stmt->bind_result($catfood, $levelKenyang);
$stmt->fetch();
$stmt->close();

// Cek apakah masih punya cat food dan belum kenyang
if ($catfood > 0 && $levelKenyang < 10) {
    $catfood -= 1;
    $levelKenyang += 1;
    if ($levelKenyang > 10) $levelKenyang = 10;

    $update = $conn->prepare("UPDATE oyen SET catfood = ?, levelKenyang = ? WHERE user_id = ?");
    $update->bind_param("iii", $catfood, $levelKenyang, $user_id);
    $update->execute();
    $update->close();
}

// Redirect balik ke homepage
header("Location: homepage.php");
exit();
?>
