<?php
session_start();
include 'config.php';

// Cek login
if (!isset($_SESSION['uid'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['uid'];

// Ambil data user
$nama = '';
$profile_pic = 'default.png';

$stmt = $conn->prepare("SELECT nama, profile_pic FROM users WHERE id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$stmt->bind_result($nama, $profile_pic);
$stmt->fetch();
$stmt->close();

// Ambil data pet
$pet_nama = 'Oyen';
$levelKenyang = 5;
$catfood = 0;

$stmt2 = $conn->prepare("SELECT nama, levelKenyang, catfood FROM oyen WHERE user_id = ?");
$stmt2->bind_param("i", $user_id);
$stmt2->execute();
$stmt2->bind_result($pet_nama, $levelKenyang, $catfood);
$stmt2->fetch();
$stmt2->close();

// Tentukan status Oyen
if ($levelKenyang <= 2) {
    $status = "meow.... meow.... lemes....";
    $image = "oyen_sick.png";
} elseif ($levelKenyang <= 5) {
    $status = "Oyen laper....!";
    $image = "oyen.png";
} else {
    $status = "Happy happy oyen cat!!";
    $image = "oyen_happy.png";
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>V-Check</title>
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
            position: relative;
        }
        .header .profile-pic {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            border: 2px solid white;
            object-fit: cover;
        }
        .header h2 {
            font-weight: 700;
            margin-bottom: 5px;
        }
        .xp-label {
            font-size: 0.8rem;
            opacity: 0.8;
            margin-bottom: 5px;
        }
        .xp-bar-container {
            background-color: #d9d9d9;
            border-radius: 10px;
            height: 10px;
            width: 100%;
            max-width: 300px;
            overflow: hidden;
            margin-bottom: 8px;
        }
        .xp-bar {
            background-color: #e6f0c9;
            height: 100%;
            width: 40%;
            border-radius: 10px 0 0 10px;
            transition: width 0.3s ease;
        }
        .points {
            font-size: 0.9rem;
            opacity: 0.9;
        }
        .pet-card {
            background-color: white;
            border-radius: 25px 25px 0 0;
            margin-top: -15px;
            padding: 25px 20px 40px 20px;
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.1);
            text-align: center;
            flex-grow: 1;
        }
        .tab-pet {
            background-color: #f4f6e8;
            color: #a3a96e;
            font-weight: 600;
            font-size: 1.1rem;
            padding: 10px 20px;
            border-radius: 20px 20px 0 0;
            width: 80px;
            margin: 0 auto 15px auto;
            box-shadow: 0 3px 6px rgba(0, 0, 0, 0.1);
        }
        .pet-name {
            font-weight: 700;
            font-size: 1.4rem;
            color: #a3a96e;
            margin-bottom: 5px;
        }
        .pet-status {
            font-size: 0.9rem;
            color: #8a8a5c;
            margin-bottom: 15px;
        }
        .pet-image {
            width: 120px;
            height: 120px;
            margin-bottom: 20px;
            user-select: none;
        }
        .btn-feed {
            background-color: #a3a96e;
            border: none;
            border-radius: 25px;
            padding: 10px 30px;
            color: white;
            font-weight: 600;
            box-shadow: 0 4px 8px rgba(163, 169, 110, 0.5);
            transition: background-color 0.3s ease;
        }
        .btn-feed:disabled {
            opacity: 0.5;
        }
        .btn-feed:hover {
            background-color: #8a8f5a;
        }
        .food-info {
            margin-top: 12px;
            font-size: 0.85rem;
            color: #8a8a5c;
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
            transition: color 0.3s ease;
        }
        .footer i:hover {
            color: #e6f0c9;
        }
    </style>
</head>
<body>

<!-- Header -->
<header class="header d-flex align-items-center gap-3 sticky-top">
    <img src="profile_pics/<?php echo htmlspecialchars($profile_pic); ?>" alt="Profile" class="profile-pic" />
    <div>
        <h2>Hi, <?= htmlspecialchars($nama); ?>!</h2>
        <div class="xp-label">XP</div>
        <div class="xp-bar-container">
            <div class="xp-bar"></div>
        </div>
        <div class="points">Point terkumpul: 6</div>
    </div>
</header>

<!-- Main Pet Section -->
<main class="pet-card d-flex flex-column align-items-center">
    <div class="tab-pet">Pet</div>
    <div class="pet-name"><?= htmlspecialchars($pet_nama); ?></div>
    <div class="pet-status"><?= $status ?></div>
    <img src="assets/<?= $image ?>" alt="Oyen" class="pet-image" />

    <form action="beri_makan.php" method="POST">
        <button type="submit" class="btn-feed" <?= ($catfood <= 0 || $levelKenyang >= 10) ? 'disabled' : '' ?>>
            Beri makan
        </button>
    </form>

    <div class="food-info">Kamu punya <?= $catfood ?> cat food.</div>

    <div style="width: 80%; max-width: 300px; background-color: #d9d9d9; height: 10px; border-radius: 10px; overflow: hidden; margin-top: 10px;">
        <div style="height: 100%; width: <?= $levelKenyang * 10 ?>%; background-color: #a3a96e;"></div>
    </div>
    <p style="font-size: 0.85rem; color: #8a8a5c; margin-top: 4px;">Kenyang: <?= $levelKenyang ?>/10</p>
</main>

<!-- Footer -->
<footer class="footer">
    <button onclick="location.href='menu.php'"><i class="fa-solid fa-bars"></i></button>
    <button onclick="location.href='notification.php'"><i class="fa-regular fa-bell"></i></button>
    <button onclick="location.href='scanQR.php'"><i class="fa-solid fa-qrcode"></i></button>
    <button onclick="location.href='upload-1.php'"><i class="fa-solid fa-upload"></i></button>
    <button onclick="location.href='profile.php'"><i class="fa-regular fa-user"></i></button>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
