<?php
session_start();
include 'config.php';

if (!isset($_SESSION['uid'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['uid'];
$partners = [];

// --- LOGIKA SORTING ---
// 1. Tentukan opsi sorting yang diizinkan (Whitelist untuk keamanan)
$allowed_sorts = [
    'name_asc' => 'u.nama ASC',
    'name_desc' => 'u.nama DESC',
    'latest' => 'sp.created_at DESC'
];

// 2. Ambil opsi sorting dari URL, jika tidak ada, gunakan default 'name_asc'
$sort_key = $_GET['sort'] ?? 'name_asc';
if (!array_key_exists($sort_key, $allowed_sorts)) {
    $sort_key = 'name_asc'; // Default jika parameter tidak valid
}
$order_by_sql = $allowed_sorts[$sort_key];
// --- AKHIR LOGIKA SORTING ---


// Query untuk mengambil partner yang sudah 'accepted'
// TAMBAHKAN klausa ORDER BY yang dinamis
$sql = "SELECT u.nama, u.npm FROM users u
        JOIN study_partners sp ON (u.id = sp.user_one_id OR u.id = sp.user_two_id)
        WHERE (sp.user_one_id = ? OR sp.user_two_id = ?)
        AND sp.status = 'accepted' AND u.id != ?
        ORDER BY $order_by_sql"; // <-- Klausa ORDER BY dinamis

$stmt = $conn->prepare($sql);
$stmt->bind_param("iii", $user_id, $user_id, $user_id);
$stmt->execute();
$result = $stmt->get_result();
while ($row = $result->fetch_assoc()) {
    $partners[] = $row;
}
$stmt->close();
$conn->close();
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Study Partner - V-Check</title>
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
            padding: 20px 25px;
            border-bottom-left-radius: 30px;
            border-bottom-right-radius: 30px;
            display: flex;
            align-items: center;
            gap: 15px;
            font-weight: 700;
            font-size: 1.4rem;
        }

        .back-btn {
            font-size: 1.4rem;
            cursor: pointer;
        }

        main {
            padding: 20px;
        }

        .top-card {
            background: white;
            border-radius: 20px;
            padding: 20px;
            margin-bottom: 20px;
            display: flex;
            justify-content: space-around;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .top-btn {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 8px;
            font-weight: 600;
            color: #a3a96e;
            font-size: 0.85rem;
        }

        .top-btn i {
            background-color: #a3a96e;
            color: white;
            border-radius: 12px;
            padding: 12px;
            font-size: 1.2rem;
        }

        .section-card {
            background: white;
            border-radius: 15px;
            padding: 15px 20px;
            margin-bottom: 15px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.08);
        }

        .section-card h6 {
            font-weight: 700;
            font-size: 1.05rem;
            color: #7a7f4a;
            margin-bottom: 10px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .section-card h6 i {
            font-size: 1.1rem;
            color: #a3a96e;
        }

        .partner-list {
            background: white;
            border-radius: 15px;
            padding: 15px 20px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.08);
        }

        .partner-list h6 {
            font-weight: 700;
            font-size: 1.05rem;
            color: #7a7f4a;
            margin-bottom: 15px;
            display: flex;
            justify-content: space-between;
        }

        .partner-list .item {
            font-weight: 600;
            color: #a3a96e;
            font-size: 0.95rem;
            margin-bottom: 12px;
            border-bottom: 1px solid #f0f0f0;
            padding-bottom: 12px;
        }

        .partner-list .item:last-child {
            border-bottom: none;
        }

        .partner-list .item span {
            display: block;
            font-weight: 400;
            font-size: 0.85rem;
            color: #7a7f4a;
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
            position: fixed;
            bottom: 0;
            width: 100%;
            left: 0;
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
        <div class="page-title mx-auto">Study Partner</div>
    </header>

    <!-- Main Content -->
    <main>
        <div class="top-card">
            <div class="top-btn" onclick="window.location.href='addPartner.php'"><i class="fa-solid fa-user-plus"></i>Tambah Partner</div>
            <div class="top-btn" onclick="window.location.href='editPartner.php'"><i class="fa-solid fa-pen"></i>Edit Partner</div>
            <div class="top-btn" onclick="window.location.href='pendingRequest.php'"><i class="fa-regular fa-user"></i>Pending</div>
        </div>
        <div class="partner-list">
            <h6>
                Partner List
                <div class="dropdown">
                    <button class="btn btn-outline-secondary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false" style="--bs-btn-border-color: #a3a96e; --bs-btn-color: #a3a96e; --bs-btn-hover-bg: #a3a96e; --bs-btn-hover-color: white;">
                        <i class="fa-solid fa-filter"></i> Filter
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="studyPartner.php?sort=name_asc">Nama (A-Z)</a></li>
                        <li><a class="dropdown-item" href="studyPartner.php?sort=name_desc">Nama (Z-A)</a></li>
                        <li><a class="dropdown-item" href="studyPartner.php?sort=latest">Terbaru</a></li>
                    </ul>
                </div>
            </h6>

            <?php if (empty($partners)): ?>
                <p class="text-muted">Anda belum memiliki study partner.</p>
                <?php else: foreach ($partners as $partner): ?>
                    <div class="item">
                        <?php echo htmlspecialchars($partner['nama']); ?>
                        <span><?php echo htmlspecialchars($partner['npm']); ?></span>
                    </div>
            <?php endforeach;
            endif; ?>
        </div>
    </main>

    <!-- Footer -->
    <footer class="footer">
        <button aria-label="Menu" title="Menu" onclick="window.location.href='menu.php'">
            <i class="fa-solid fa-bars"></i>
        </button>
        <button aria-label="Notifikasi" title="Notifikasi" onclick="window.location.href='notification.php'">
            <i class="fa-regular fa-bell"></i>
        </button>
        <button aria-label="QR Code" title="QR Code" onclick="window.location.href='scanQR.php'">
            <i class="fa-solid fa-qrcode"></i>
        </button>
        <button aria-label="Upload" title="Upload" onclick="window.location.href='upload-1.php'">
            <i class="fa-solid fa-upload"></i>
        </button>
        <button aria-label="Profile" title="Profile" onclick="window.location.href='profile.php'">
            <i class="fa-regular fa-user"></i>
        </button>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>