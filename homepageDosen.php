<?php
// Mulai session dan sertakan file konfigurasi
session_start();
include 'config.php';

if (!isset($_SESSION['uid'])) {
    header("Location: loginDosen.php");
    exit();
}

$user_id = $_SESSION['uid'];

$nama = '';

$stmt = $conn->prepare("SELECT nama FROM dosen WHERE id_dosen = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$stmt->bind_result($nama);
$stmt->fetch();
$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>V-Check Dosen</title>
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
      justify-content: space-between;
    }

    .header {
      background-color: #a3a96e;
      color: white;
      border-radius: 0 0 20px 20px;
      padding: 20px 25px;
    }

    .header h2 {
      font-weight: 700;
      margin-bottom: 5px;
    }

    .main-card {
      background-color: white;
      border-radius: 25px 25px 0 0;
      margin-top: -15px;
      padding: 25px 20px 40px 20px;
      box-shadow: 0 8px 15px rgba(0, 0, 0, 0.1);
      flex-grow: 1;
      text-align: center;
    }

    .dosen-menu-wrapper {
      display: flex;
      justify-content: center;
      gap: 30px;
      flex-wrap: wrap;
      margin-top: 40px;
    }

    .btn-opt {
      background-color: #a3a96e;
      border: none;
      width: 90px;
      height: 90px;
      border-radius: 50%;
      padding: 0;
      display: flex;
      align-items: center;
      justify-content: center;
      box-shadow: 0 4px 8px rgba(163, 169, 110, 0.5);
      transition: background-color 0.3s ease;
    }

    .btn-opt:hover {
      background-color: #8a8f5a;
    }

    .btn-opt img {
      width: 50%;
      height: 50%;
      object-fit: contain;
      user-select: none;
    }

    .dosen-menu {
      margin-top: 10px;
      font-size: 0.95rem;
      font-weight: 500;
      color: #a3a96e;
    }

    .footer {
      background-color: #a3a96e;
      padding: 12px 0;
      display: flex;
      justify-content: space-around;
      align-items: center;
      border-radius: 20px 20px 0 0;
      color: white;
      font-size: 1.5rem;
      box-shadow: 0 -3px 10px rgba(0, 0, 0, 0.1);
    }

    .dosen-menu-item {
     display: flex;
    flex-direction: column;
    align-items: center;
    text-align: center;
}

    @media (max-width: 480px) {
      .dosen-menu-wrapper {
        flex-direction: column;
        align-items: center;
      }
    }
  </style>
</head>
<body>

  <!-- Header -->
  <header class="header">
    <h2>Selamat Datang Kembali, <?php echo htmlspecialchars($nama); ?>!</h2>
    <div class="points">Dashboard V-check Dosen UPN "Veteran" Jawa Timur</div>
    <br>
  </header>

  <!-- Main Content -->
  <main class="main-card">
    <div class="dosen-menu-wrapper">
        <div class="dosen-menu-item">
            <a href="..." class="btn-opt">
            <img src="assets/tick.png" alt="Icon 1" />
            </a>
            <div class="dosen-menu">Validasi Izin Presensi</div>
        </div>
        <div class="dosen-menu-item">
            <a href="generateQR.php" class="btn-opt">
            <img src="assets/qr.png" alt="Icon 2" />
            </a>
            <div class="dosen-menu">Buat QR Presensi</div>
        </div>
        <div class="dosen-menu-item">
            <a href="logout.php" class="btn-opt">
            <img src="assets/logout.png" alt="Icon 3" />
            </a>
            <div class="dosen-menu">Keluar</div>
        </div>
    </div>
  </main>

  <!-- Footer -->
  <footer class="footer">
    <!-- Optional icons/buttons here -->
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
