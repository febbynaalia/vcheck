<?php
session_start();
include 'config.php'; // Your database connection file

if (!isset($_SESSION['uid'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['uid'];
$incoming_requests = [];
$outgoing_requests = [];
$message = '';
$message_type = '';

// Handle actions (accept/declined)
if (isset($_GET['action']) && isset($_GET['request_id'])) {
    $request_id = $_GET['request_id'];
    $action = $_GET['action']; // 'accept' or 'declined'

    // Verify ownership and status before updating
    $stmt = $conn->prepare("SELECT user_one_id, user_two_id, status FROM study_partners WHERE id = ?");
    $stmt->bind_param("i", $request_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $request_details = $result->fetch_assoc();
    $stmt->close();

    if ($request_details && $request_details['status'] == 'pending' && $request_details['user_two_id'] == $user_id) {
        // This request is pending and addressed to the current user (incoming)
        if ($action == 'accept') {
            $new_status = 'accepted';
            $success_message = 'Permintaan partner diterima.';
            $error_message = 'Gagal menerima permintaan partner.';
        } elseif ($action == 'declined') { // Changed from 'reject' to 'declined'
            $new_status = 'declined';
            $success_message = 'Permintaan partner ditolak.';
            $error_message = 'Gagal menolak permintaan partner.';
        } else {
            $message = "Aksi tidak valid.";
            $message_type = 'danger';
        }

        if (isset($new_status)) {
            // Update status and action_user_id
            $stmt = $conn->prepare("UPDATE study_partners SET status = ?, action_user_id = ? WHERE id = ?");
            $stmt->bind_param("sii", $new_status, $user_id, $request_id); // Current user is action_user_id
            if ($stmt->execute()) {
                $message = $success_message;
                $message_type = 'success';
            } else {
                $message = $error_message;
                $message_type = 'danger';
            }
            $stmt->close();
        }
    } else {
        $message = "Permintaan tidak ditemukan, sudah diproses, atau Anda tidak memiliki izin untuk mengelolanya.";
        $message_type = 'danger';
    }
}


// Fetch Incoming Pending Requests (where current user is user_two_id and status is pending)
$sql_incoming = "SELECT sp.id AS request_id, u.nama, u.npm, sp.created_at FROM users u
                JOIN study_partners sp ON u.id = sp.user_one_id
                WHERE sp.user_two_id = ? AND sp.status = 'pending'
                ORDER BY sp.created_at DESC";
$stmt_incoming = $conn->prepare($sql_incoming);
$stmt_incoming->bind_param("i", $user_id);
$stmt_incoming->execute();
$result_incoming = $stmt_incoming->get_result();
while ($row = $result_incoming->fetch_assoc()) {
    $incoming_requests[] = $row;
}
$stmt_incoming->close();

// Fetch Outgoing Pending Requests (where current user is user_one_id and status is pending)
$sql_outgoing = "SELECT sp.id AS request_id, u.nama, u.npm, sp.created_at FROM users u
                JOIN study_partners sp ON u.id = sp.user_two_id
                WHERE sp.user_one_id = ? AND sp.status = 'pending'
                ORDER BY sp.created_at DESC";
$stmt_outgoing = $conn->prepare($sql_outgoing);
$stmt_outgoing->bind_param("i", $user_id);
$stmt_outgoing->execute();
$result_outgoing = $stmt_outgoing->get_result();
while ($row = $result_outgoing->fetch_assoc()) {
    $outgoing_requests[] = $row;
}
$stmt_outgoing->close();

$conn->close();
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Permintaan Tertunda - V-Check</title>
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

        .request-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 0;
            border-bottom: 1px solid #eee;
        }

        .request-item:last-child {
            border-bottom: none;
        }

        .request-details {
            font-weight: 600;
            color: #a3a96e;
            font-size: 0.95rem;
        }

        .request-details span {
            display: block;
            font-weight: 400;
            font-size: 0.85rem;
            color: #7a7f4a;
        }

        .request-actions {
            display: flex;
            gap: 8px;
        }

        .btn-accept {
            background: linear-gradient(90deg, #a3a96e 0%, #b6c36e 100%);
            color: #fff;
            border: none;
            font-weight: 600;
            font-size: 0.9rem;
            padding: 6px 18px 6px 12px;
            border-radius: 6px;
            box-shadow: 0 2px 6px rgba(163, 169, 110, 0.12);
            display: flex;
            align-items: center;
            transition: background 0.2s;
        }

        .btn-accept i {
            margin-right: 6px;
            font-size: 1.1em;
        }

        .btn-accept:hover {
            background: linear-gradient(90deg, #8e944e 0%, #a3a96e 100%);
        }

        .btn-decline {
            background: linear-gradient(90deg, #e57373 0%, #f06292 100%);
            color: #fff;
            border: none;
            font-weight: 600;
            font-size: 0.9rem;
            padding: 6px 18px 6px 12px;
            border-radius: 6px;
            box-shadow: 0 2px 6px rgba(230, 115, 115, 0.12);
            display: flex;
            align-items: center;
            transition: background 0.2s;
        }

        .btn-decline i {
            margin-right: 6px;
            font-size: 1.1em;
        }

        .btn-decline:hover {
            background: linear-gradient(90deg, #c62828 0%, #e57373 100%);
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
        <div class="page-title mx-auto">Permintaan Tertunda</div>
    </header>

    <!-- Main Content -->
    <main>
        <?php if ($message): ?>
            <div class="alert alert-<?php echo $message_type; ?> alert-dismissible fade show" role="alert">
                <?php echo $message; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <div class="section-card mb-3">
            <h6>Permintaan Masuk</h6>
            <?php if (empty($incoming_requests)): ?>
                <p class="text-muted">Tidak ada permintaan partner masuk yang tertunda.</p>
            <?php else: ?>
                <?php foreach ($incoming_requests as $request): ?>
                    <div class="request-item">
                        <div class="request-details">
                            Dari: <?php echo htmlspecialchars($request['nama']); ?>
                            <span>NPM: <?php echo htmlspecialchars($request['npm']); ?></span>
                            <small class="text-muted">Dikirim pada: <?php echo date("d M Y H:i", strtotime($request['created_at'])); ?></small>
                        </div>
                        <div class="request-actions">
                            <a href="pendingRequest.php?action=accept&request_id=<?php echo $request['request_id']; ?>" class="btn btn-success">Terima</a>
                            <a href="pendingRequest.php?action=declined&request_id=<?php echo $request['request_id']; ?>" class="btn btn-danger">Tolak</a>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>

        <div class="section-card">
            <h6>Permintaan Terkirim</h6>
            <?php if (empty($outgoing_requests)): ?>
                <p class="text-muted">Tidak ada permintaan partner keluar yang tertunda.</p>
            <?php else: ?>
                <?php foreach ($outgoing_requests as $request): ?>
                    <div class="request-item">
                        <div class="request-details">
                            Ke: <?php echo htmlspecialchars($request['nama']); ?>
                            <span>NPM: <?php echo htmlspecialchars($request['npm']); ?></span>
                            <small class="text-muted">Dikirim pada: <?php echo date("d M Y H:i", strtotime($request['created_at'])); ?></small>
                        </div>
                        <div class="request-actions">
                            <span class="badge bg-warning text-dark">Menunggu</span>
                        </div>
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