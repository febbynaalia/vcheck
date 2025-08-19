<?php
session_start();
if (!isset($_SESSION['uid'])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Presensi Sukses</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet" />
  <style>
    body {
      background-color: #f4f6e8;
      font-family: 'Poppins', sans-serif;
      margin: 0;
      padding: 0;
      height: 100vh;
      display: flex;
      flex-direction: column;
    }
    .header {
      background-color: #a3a96e;
      color: white;
      padding: 20px 20px;
      border-bottom-left-radius: 20px;
      border-bottom-right-radius: 20px;
      display: flex;
      align-items: center;
      gap: 15px;
      font-weight: 700;
      font-size: 1.5rem;
    }
    .header .back-btn {
      font-size: 1.5rem;
      cursor: pointer;
    }
    .success-box {
      background-color: white;
      margin: 30px auto;
      padding: 30px 20px;
      width: 90%;
      max-width: 320px;
      border-radius: 25px;
      border: 4px solid #a3a96e;
      box-shadow: 0 4px 10px rgba(163, 169, 110, 0.3);
      text-align: center;
    }
    .success-box img {
      width: 100px;
      margin-bottom: 15px;
    }
    .success-box h2 {
      color: #a3a96e;
      font-weight: bold;
      font-size: 1.5rem;
    }
    .success-box p {
      color: #666;
      font-size: 0.95rem;
    }
    .btn-home {
      background-color: #a3a96e;
      color: white;
      padding: 10px 25px;
      border-radius: 20px;
      border: none;
      margin-top: 15px;
      font-weight: 600;
      text-decoration: none;
      display: inline-block;
    }
    .btn-home:hover {
      background-color: #8a8f5a;
      color: white;
    }
  </style>
</head>
<body>

<header class="header">
  <div class="back-btn" onclick="history.back()">
    <i class="fa-solid fa-arrow-left"></i>
  </div>
  <div class="page-title mx-auto">Presensi Sukses</div>
</header>

<main>
  <div class="success-box">
    <img src="assets/catfood.png" alt="Cat Food" />
    <h2>Hore!</h2>
    <p>Kamu berhasil presensi dan mendapatkan 1 cat food!</p>
    <p>Yuk beri makan Oyen~</p>
    <a href="homepage.php" class="btn-home">Kembali ke Beranda</a>
  </div>
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
