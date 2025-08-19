<?php
// Mulai session dan sertakan file konfigurasi
session_start();
include 'config.php'; //

// Jika pengguna tidak login, arahkan kembali ke halaman login
if (!isset($_SESSION['uid'])) {
    header("Location: login.php");
    exit();
}

// Ambil ID pengguna dari session
$user_id = $_SESSION['uid'];

// Siapkan variabel untuk menampung data
$nama = '';
$npm = '';
$fakultas = '';
$ipk = 0.0;
$level = 1;
$profile_pic = 'default.png'; // Nama file default

// Siapkan query untuk mengambil data lengkap pengguna, termasuk foto profil
$stmt = $conn->prepare("SELECT nama, npm, fakultas, ipk, level, profile_pic FROM users WHERE id = ?"); //
$stmt->bind_param("i", $user_id);
$stmt->execute();
$stmt->bind_result($nama, $npm, $fakultas, $ipk, $level, $profile_pic);
$stmt->fetch();
$stmt->close();
$conn->close();

// Logika sederhana untuk nama level berdasarkan angka
$level_name = "The Conquest"; // Default
if ($level == 1) $level_name = "Newbie";
if ($level == 2) $level_name = "Explorer";
if ($level == 3) $level_name = "Veteran";
if ($level == 4) $level_name = "The Conquest"; //
if ($level >= 5) $level_name = "Master";

?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Menu - V-Check</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet" />
    <style>
        body {
            background-color: #f4f6e8;
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .header {
            background-color: #a3a96e;
            color: white;
            border-radius: 0 0 20px 20px;
            padding: 20px 25px;
            font-weight: 700;
            font-size: 1.8rem;
            box-shadow: 0 3px 6px rgba(0, 0, 0, 0.1);
        }

        .main-card {
            background-color: #a3a96e;
            border-radius: 20px;
            padding: 20px;
            margin: 20px;
            color: white;
            font-weight: 600;
            font-size: 1.1rem;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
        }

        .ktv-card {
            background-color: white;
            border-radius: 15px;
            padding: 15px;
            margin-top: 15px;
            color: #a3a96e;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
        }

        .ktv-info {
            display: flex;
            flex-direction: column;
            gap: 4px;
        }

        .ktv-info strong {
            font-weight: 700;
            font-size: 1.1rem;
        }

        .ktv-info span {
            font-size: 0.9rem;
            color: #8a8a5c;
        }

        .ktv-rating {
            background-color: #a3a96e;
            color: white;
            font-weight: 700;
            padding: 6px 14px;
            border-radius: 12px;
            font-size: 1rem;
            box-shadow: 0 4px 8px rgba(163, 169, 110, 0.5);
            user-select: none;
        }

        .ktv-image {
            width: 70px;
            height: 70px;
            border-radius: 15px;
            object-fit: cover;
            margin-left: 15px;
        }

        .level-info {
            margin-top: 10px;
            font-weight: 700;
            font-size: 1.1rem;
        }

        .settings-btn {
            background-color: white;
            color: #a3a96e;
            font-weight: 700;
            font-size: 1rem;
            border-radius: 20px;
            padding: 12px 20px;
            margin: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
            cursor: pointer;
            border: none;
            transition: background-color 0.3s ease;
        }

        .settings-btn:hover {
            background-color: #e6f0c9;
        }

        .settings-btn i {
            font-size: 1.2rem;
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
            margin-top: auto;
        }

        .footer button {
            background: none;
            border: none;
            color: white;
            cursor: pointer;
            transition: color 0.3s ease;
        }

        .footer button:hover {
            color: #e6f0c9;
        }

        @media (max-width: 400px) {
            .header {
                font-size: 1.5rem;
                padding: 15px 20px;
            }

            .ktv-rating {
                font-size: 0.9rem;
            }

            .settings-btn {
                font-size: 0.95rem;
                padding: 10px 15px;
                margin: 15px;
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
        <div class="page-title mx-auto">Menu</div>
    </header>

    <!-- Main Card -->
    <section class="main-card">
        Kartu Tanda Veteran (KTV) <div class="ktv-card">
            <div class="ktv-info">
                <strong><?php echo htmlspecialchars($nama); ?></strong>
                <span><?php echo htmlspecialchars($npm); ?></span>
                <span><?php echo htmlspecialchars($fakultas); ?></span>
            </div>
            <img src="profile_pics/<?php echo htmlspecialchars($profile_pic); ?>" alt="<?php echo htmlspecialchars($nama); ?>" class="ktv-image" />
            <div class="ktv-rating"><?php echo number_format($ipk, 2); ?></div>
        </div>
        <div class="level-info">Level <?php echo $level; ?>: <?php echo $level_name; ?></div>
    </section>

    <!-- Settings Button -->
    <a href="settings.php" class="settings-btn text-decoration-none">
        <span>Settings</span>
        <i class="fa-solid fa-chevron-right"></i>
    </a>

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