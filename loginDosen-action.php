<?php
session_start();
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Cek dari database (dummy versi)
    $stmt = $conn->prepare("SELECT id_dosen, nama FROM dosen WHERE email=? AND password=?");
    $stmt->bind_param("ss", $email, $password);
    $stmt->execute();
    $stmt->store_result();

    if($stmt->num_rows > 0){
        $stmt->bind_result($id, $nama);
        $stmt->fetch();
        $_SESSION['uid'] = $id;
        $_SESSION['nama'] = $nama;
        header("Location: homepageDosen.php");
    } else {
        echo "Login gagal. Cek email atau password.";
    }
}
?>