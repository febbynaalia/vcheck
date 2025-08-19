<?php
session_start();
include 'config.php'; // Your database connection file

if (!isset($_SESSION['uid'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['uid'];
$partners = [];
$message = '';
$message_type = '';

// Handle partner removal
if (isset($_GET['action']) && $_GET['action'] == 'remove' && isset($_GET['partner_id'])) {
    $partner_to_remove_id = $_GET['partner_id']; // This is the ID from study_partners table

    // Verify that this partnership belongs to the current user
    // Also, ensure the status is 'accepted' before allowing removal
    $stmt = $conn->prepare("SELECT id FROM study_partners WHERE id = ? AND (user_one_id = ? OR user_two_id = ?) AND status = 'accepted'");
    $stmt->bind_param("iii", $partner_to_remove_id, $user_id, $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $partnership_exists = $result->fetch_assoc();
    $stmt->close();

    if ($partnership_exists) {
        // Instead of outright deleting, we can change status to 'declined' or 'blocked'
        // For 'remove', changing to 'declined' makes sense if one user simply ends the partnership.
        // If you want a 'block' feature, that would be a separate action.
        $stmt = $conn->prepare("UPDATE study_partners SET status = 'declined', action_user_id = ? WHERE id = ?");
        $stmt->bind_param("ii", $user_id, $partner_to_remove_id); // Set current user as action_user_id
        if ($stmt->execute()) {
            $message = "Partner berhasil dihapus!";
            $message_type = 'success';
        } else {
            $message = "Gagal menghapus partner. Silakan coba lagi.";
            $message_type = 'danger';
        }
        $stmt->close();
    } else {
        $message = "Partnership tidak ditemukan atau Anda tidak memiliki izin untuk menghapusnya.";
        $message_type = 'danger';
    }
}

// Fetch current accepted partners
$sql = "SELECT sp.id AS partnership_id, u.nama, u.npm FROM users u
        JOIN study_partners sp ON (u.id = sp.user_one_id OR u.id = sp.user_two_id)
        WHERE (sp.user_one_id = ? OR sp.user_two_id = ?)
        AND sp.status = 'accepted' AND u.id != ?
        ORDER BY u.nama ASC";

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
    <title>Edit Partner - V-Check</title>
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
        }

        .partner-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 0;
            border-bottom: 1px solid #eee;
        }

        .partner-item:last-child {
            border-bottom: none;
        }

        .partner-details {
            font-weight: 600;
            color: #a3a96e;
            font-size: 0.95rem;
        }

        .partner-details span {
            display: block;
            font-weight: 400;
            font-size: 0.85rem;
            color: #7a7f4a;
        }

        .remove-btn {
            background-color: #dc3545;
            color: white;
            border: none;
            padding: 5px 10px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 0.8rem;
        }

        .remove-btn:hover {
            background-color: #c82333;
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
        <div class="page-title mx-auto">Edit Partner</div>
    </header>

    <!-- Main content -->
    <main>
        <div class="section-card">
            <h6>Daftar Partner Anda</h6>
            <?php if ($message): ?>
                <div class="alert alert-<?php echo $message_type; ?> alert-dismissible fade show" role="alert">
                    <?php echo $message; ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>
            <?php if (empty($partners)): ?>
                <p class="text-muted">Anda belum memiliki study partner yang diterima.</p>
            <?php else: ?>
                <?php foreach ($partners as $partner): ?>
                    <div class="partner-item">
                        <div class="partner-details">
                            <?php echo htmlspecialchars($partner['nama']); ?>
                            <span><?php echo htmlspecialchars($partner['npm']); ?></span>
                        </div>
                        <a href="editPartner.php?action=remove&partner_id=<?php echo $partner['partnership_id']; ?>" class="remove-btn" onclick="return confirm('Apakah Anda yakin ingin menghapus partner ini? Ini akan mengubah status menjadi \'ditolak\'.');">Hapus</a>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
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