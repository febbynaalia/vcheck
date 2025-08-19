<?php
// upload_profile_pic.php

session_start();
include 'config.php';

// Pastikan pengguna sudah login
if (!isset($_SESSION['uid'])) {
    die("Akses ditolak. Silakan login.");
}

$user_id = $_SESSION['uid'];

if (isset($_FILES['profile_pic']) && $_FILES['profile_pic']['error'] == 0) {
    $target_dir = "profile_pics/"; // Pastikan folder ini ada
    $allowed_types = ['jpg', 'jpeg', 'png', 'gif'];

    $file_name = basename($_FILES["profile_pic"]["name"]);
    $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

    // Cek apakah tipe file diizinkan
    if (in_array($file_ext, $allowed_types)) {
        // Buat nama file unik untuk mencegah tumpang tindih
        $new_file_name = uniqid('user' . $user_id . '_', true) . '.' . $file_ext;
        $target_file = $target_dir . $new_file_name;

        // Pindahkan file ke direktori tujuan
        if (move_uploaded_file($_FILES["profile_pic"]["tmp_name"], $target_file)) {
            // Update database dengan nama file baru
            $stmt = $conn->prepare("UPDATE users SET profile_pic = ? WHERE id = ?");
            $stmt->bind_param("si", $new_file_name, $user_id);
            if ($stmt->execute()) {
                // Berhasil
                header("Location: profile.php?status=success");
            } else {
                header("Location: profile.php?status=dberror");
            }
            $stmt->close();
        } else {
            header("Location: profile.php?status=moveerror");
        }
    } else {
        header("Location: profile.php?status=filetype");
    }
} else {
    header("Location: profile.php?status=nofile");
}

$conn->close();
?>