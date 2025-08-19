<?php
session_start();
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    $stmt = $conn->prepare("SELECT id, nama, npm FROM users WHERE email = ? AND password = ?");
    $stmt->bind_param("ss", $email, $password);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $nama, $npm);
        $stmt->fetch();

        $_SESSION['uid'] = $id;
        $_SESSION['nama'] = $nama;
        $_SESSION['npm'] = $npm; // ✅ WAJIB

        header("Location: homepage.php");
        exit;
    } else {
        echo "Login gagal. Cek email atau password.";
    }
}
?>
