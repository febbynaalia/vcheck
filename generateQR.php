<?php
session_start();
include 'config.php';

if (!isset($_SESSION['uid'])) {
    header("Location: loginDosen.php");
    exit();
}

$qr_url = "";
$nama = '';

// Ambil nama dosen
$stmt = $conn->prepare("SELECT nama FROM dosen WHERE id_dosen = ?");
$stmt->bind_param("i", $_SESSION['uid']);
$stmt->execute();
$stmt->bind_result($nama);
$stmt->fetch();
$stmt->close();

// Tangani form submit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $kode = $_POST['kode'];
    $matkul = $_POST['matkul'];

    if (!empty($kode) && !empty($matkul)) {
        $stmt = $conn->prepare("INSERT INTO kodeabsen (kode, matkul) VALUES (?, ?)");
        $stmt->bind_param("ss", $kode, $matkul);
        $stmt->execute();
        $stmt->close();

        // Generate QR pakai Google Chart API
        $qr_url = "https://api.qrserver.com/v1/create-qr-code/?size=250x250&data=" . urlencode("$kode");
      }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Generate QR - V-Check</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <style>
    body {
      background-color: #f4f6e8;
      font-family: 'Poppins', sans-serif;
      padding: 0;
      margin: 0;
    }

    .header {
      background-color: #a3a96e;
      color: white;
      padding: 20px 25px;
      border-radius: 0 0 20px 20px;
    }

    .main-card {
      background-color: white;
      margin: 30px auto;
      padding: 30px;
      max-width: 600px;
      border-radius: 20px;
      box-shadow: 0 8px 15px rgba(0,0,0,0.1);
    }

    .form-label {
      font-weight: 600;
      color: #5a5a3b;
    }

    .btn-submit {
      background-color: #a3a96e;
      color: white;
      font-weight: 600;
      border: none;
    }

    .btn-submit:hover {
      background-color: #8a8f5a;
    }

    .qr-preview {
      margin-top: 30px;
    }
  </style>
</head>
<body>
  <div class="header">
    <h2>Halo, <?php echo htmlspecialchars($nama); ?>!</h2>
    <p>Silakan input kode dan mata kuliah untuk generate QR presensi.</p>
  </div>

  <div class="main-card">
    <form method="POST" action="">
      <div class="mb-3">
        <label class="form-label">Kode Presensi</label>
        <input type="text" name="kode" class="form-control" placeholder="Contoh: anomaly123" required>
      </div>
      <div class="mb-3">
        <label class="form-label">Nama Mata Kuliah</label>
        <input type="text" name="matkul" class="form-control" placeholder="Contoh: RPL" required>
      </div>
      <button type="submit" class="btn btn-submit w-100">Generate QR</button>
    </form>

    <?php if (!empty($qr_url)) : ?>
      <div class="qr-preview text-center">
        <h5 class="mt-4">QR Code untuk kode:</h5>
        <p><strong><?= htmlspecialchars($_POST['kode']) ?></strong></p>
        <img src="<?= $qr_url ?>" alt="QR Code">
      </div>
      <?php endif; ?>
  </div>
</body>
</html>
