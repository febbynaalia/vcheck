<?php
session_start();

// Jika pengguna tidak login, arahkan kembali ke halaman login
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
    <title>Settings - V-Check</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet" />
    <style>
        body {
            background-color: #f4f6e8;
            font-family: 'Poppins', sans-serif;
            margin: 0;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        header {
            background-color: #a3a96e;
            color: white;
            padding: 20px 25px;
            border-bottom-left-radius: 30px;
            border-bottom-right-radius: 30px;
            display: flex;
            align-items: center;
            gap: 15px;
            font-weight: 700;
            font-size: 1.4rem;
        }

        main {
            padding: 20px;
            flex-grow: 1;
        }

        .btn-logout {
            background-color: #dc3545;
            /* Warna merah untuk logout */
            color: white;
            font-weight: 700;
            font-size: 1.1rem;
            border-radius: 20px;
            padding: 15px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
            text-decoration: none;
            transition: background-color 0.3s ease;
        }

        .btn-logout:hover {
            background-color: #c82333;
            color: white;
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

        .footer button {
            background: none;
            border: none;
            color: white;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <!-- Header -->
    <header class="header d-flex align-items-center sticky-top">
        <div class="back-btn" onclick="history.back()"><i class="fa-solid fa-arrow-left"></i></div>
        <div class="page-title mx-auto">Settings</div>
    </header>

    <!-- Main Content -->
    <main>
        <a href="logout.php" class="btn-logout mt-4">
            <span>Logout</span>
            <i class="fa-solid fa-right-from-bracket"></i>
        </a>
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