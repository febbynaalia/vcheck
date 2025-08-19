<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Upload Bukti Absen - V-Check</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet" />
  <style>
    body {
      background-color: #f4f6e8;
      font-family: 'Poppins', sans-serif;
      margin: 0;
      padding-bottom: 80px;
    }

    header {
      background-color: #a3a96e;
      color: white;
      padding: 20px;
      font-weight: 700;
      font-size: 1.5rem;
      border-radius: 0 0 20px 20px;
      text-align: center;
    }

    main {
      padding: 30px 20px;
    }

    .instruction {
      color: #a3a96e;
      font-weight: 600;
      font-size: 1.1rem;
      margin-bottom: 20px;
      text-align: center;
    }

    .btn-choice {
      width: 100%;
      background-color: white;
      color: #a3a96e;
      font-weight: 600;
      font-size: 1rem;
      border-radius: 15px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      border: none;
      padding: 12px 20px;
      margin-bottom: 15px;
      display: flex;
      justify-content: space-between;
      align-items: center;
      transition: background-color 0.3s ease;
    }

    .btn-choice:hover {
      background-color: #e6f0c9;
    }

    .btn-choice::after {
      content: "›";
      font-size: 1.3rem;
      font-weight: bold;
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
      position: fixed;
      bottom: 0;
      left: 0;
      width: 100%;
    }

    .footer button {
      background: none;
      border: none;
      color: white;
      cursor: pointer;
    }

    .footer i:hover {
      color: #e6f0c9;
    }
  </style>
</head>

<body>

  <!-- Header -->
  <header class="header d-flex align-items-center sticky-top">
    <div class="back-btn" onclick="history.back()">
      <i class="fa-solid fa-arrow-left"></i>
    </div>
    <div class="page-title mx-auto">Upload Bukti Absen</div>
  </header>

  <!-- Main Content -->
  <main>
    <p class="instruction">Pilih salah satu!</p>

    <button class="btn-choice" type="button" onclick="window.location.href='upload-2.php'">Surat Dispensasi</button>
    <button class="btn-choice" type="button" onclick="window.location.href='upload-2.php'">Surat Sakit</button>
    <button class="btn-choice" type="button" onclick="window.location.href='upload-2.php'">Surat Izin</button>
  </main>

  <!-- Footer -->
  <footer class="footer">
    <button onclick="window.location.href='menu.php'"><i class="fa-solid fa-bars"></i></button>
    <button onclick="window.location.href='notification.php'"><i class="fa-regular fa-bell"></i></button>
    <button onclick="window.location.href='scanQR.php'"><i class="fa-solid fa-qrcode"></i></button>
    <button onclick="window.location.href='upload-1.php'"><i class="fa-solid fa-upload"></i></button>
    <button onclick="window.location.href='profile.php'"><i class="fa-regular fa-user"></i></button>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>