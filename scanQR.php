<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Scan QR</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet" />
  <script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>
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
    .instruction {
      color: #a3a96e;
      font-size: 1rem;
      text-align: center;
      margin: 15px 20px;
      font-weight: 500;
    }
    .qr-scan-area {
      background-color: white;
      margin: 0 auto;
      width: 300px;
      max-width: 90%;
      border-radius: 25px;
      border: 4px solid #a3a96e;
      box-shadow: 0 4px 10px rgba(156, 162, 90, 0.3);
    }
    #reader {
      width: 100%;
    }
    .flashlight-btn {
      background-color: white;
      border-radius: 50%;
      width: 60px;
      height: 60px;
      margin: 20px auto;
      display: flex;
      justify-content: center;
      align-items: center;
      box-shadow: 0 4px 8px rgba(156, 162, 90, 0.3);
      cursor: pointer;
      border: 2px solid #9ca25a;
    }
    .flashlight-btn:hover {
      background-color: #9ca25a;
      color: white;
    }
    .flashlight-btn i {
      font-size: 1.8rem;
    }
  </style>
</head>
<body>

<header class="header">
  <div class="back-btn" onclick="history.back()">
    <i class="fa-solid fa-arrow-left"></i>
  </div>
  <div class="page-title mx-auto">Scan QR</div>
</header>

<div class="instruction">
  Scan QR Code yang diberikan Dosen anda!
</div>

<div class="qr-scan-area">
  <div id="reader"></div>
</div>

<div class="flashlight-btn" title="Toggle Flashlight" onclick="toggleFlashlight()">
  <i class="fa-solid fa-flashlight"></i>
</div>

<script>
  let scanner = new Html5QrcodeScanner("reader", {
    fps: 10,
    qrbox: { width: 250, height: 250 }
  });

  scanner.render((decodedText, decodedResult) => {
    console.log("QR terbaca:", decodedText);

    fetch('cekPresensi.php', {
      method: 'POST',
      credentials: 'include',
      headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
      body: `kode=${encodeURIComponent(decodedText)}`
    })
    .then(res => res.json())
    .then(response => {
      if (response.success && response.redirect) {
        window.location.href = response.redirect;
      } else {
        alert(response.message || "❌ Presensi gagal.");
      }
    })
    .catch(err => {
      console.error("Gagal kirim presensi:", err);
      alert("❌ Terjadi kesalahan.");
    });

    scanner.clear(); // Stop scanning agar tidak dobel
  });

  function toggleFlashlight() {
    alert('Fitur flashlight membutuhkan device support (belum diaktifkan di contoh ini).');
  }
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
