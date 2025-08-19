<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Notifikasi - V-Check</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet" />
  <style>
    body {
      background-color: #f4f6e8;
      font-family: 'Poppins', sans-serif;
      margin: 0;
      padding-bottom: 80px;
    }

    .header {
      background-color: #a3a96e;
      color: white;
      padding: 20px;
      border-radius: 0 0 20px 20px;
      font-weight: 700;
      font-size: 1.5rem;
      text-align: left;
    }

    .pet-image {
      display: block;
      margin: 20px auto 10px;
      width: 100px;
      height: auto;
      user-select: none;
    }

    .notification-card {
      background-color: white;
      border-radius: 15px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      margin: 10px 20px;
      padding: 15px 20px;
      display: flex;
      align-items: center;
      gap: 15px;
    }

    .notification-icon {
      font-size: 1.8rem;
      color: #a3a96e;
    }

    .notification-content {
      flex-grow: 1;
    }

    .notification-title {
      font-weight: 700;
      color: #a3a96e;
      margin-bottom: 5px;
    }

    .notification-text {
      font-size: 0.9rem;
      color: #6b6b6b;
      margin-bottom: 0;
    }

    .notification-time {
      font-size: 0.8rem;
      color: #8a8a5c;
      white-space: nowrap;
      align-self: flex-end;
      margin-left: auto;
      margin-top: 30px;
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

    @media (max-width: 400px) {
      .notification-card {
        margin: 10px 15px;
        padding: 12px 15px;
      }
    }
  </style>
</head>

<body>

  <!-- Header -->
  <header class="header d-flex align-items-center sticky-top">
    <div class="back-btn" onclick="history.back()">
      <i class="fa-solid fa-arrow-left"></i>
    </div>
    <div class="page-title mx-auto">Notifikasi</div>
  </header>

  <!-- Pet Image -->
  <img src="assets/oyen.png" alt="Pet Oyen" class="pet-image" />

  <!-- Notification Cards -->
  <div class="notification-card">
    <div class="notification-icon"><i class="fa-regular fa-bell"></i></div>
    <div class="notification-content">
      <p class="notification-title">Presensi telah dibuka!</p>
      <p class="notification-text">Presensi di kelas RPL (F) sudah dibuka!</p>
    </div>
    <div class="notification-time">01.30 PM</div>
  </div>

  <!-- Another Notification Card -->
  <div class="notification-card">
    <div class="notification-icon"><i class="fa-regular fa-circle-check"></i></div>
    <div class="notification-content">
      <p class="notification-title">Presensi berhasil!</p>
      <p class="notification-text">Kamu berhasil check-in di kelas RPL (F)</p>
    </div>
    <div class="notification-time">01.35 PM</div>
  </div>

  <!-- Warning Notification Card -->
  <div class="notification-card">
    <div class="notification-icon"><i class="fa-solid fa-triangle-exclamation"></i></div>
    <div class="notification-content">
      <p class="notification-title">Peringatan!</p>
      <p class="notification-text">Kamu melewati batas check-in di kelas RPL (F)</p>
    </div>
    <div class="notification-time">01.40 PM</div>
  </div>

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