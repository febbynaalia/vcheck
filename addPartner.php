<?php
session_start();
include 'config.php'; // Your database connection file

if (!isset($_SESSION['uid'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['uid'];
$message = '';
$message_type = ''; // 'success' or 'danger'

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $target_npm = $_POST['npm'];

    // 1. Validate input
    if (empty($target_npm)) {
        $message = "NPM tidak boleh kosong.";
        $message_type = 'danger';
    } else {
        // 2. Find the target user by NPM
        $stmt = $conn->prepare("SELECT id FROM users WHERE npm = ?");
        $stmt->bind_param("s", $target_npm);
        $stmt->execute();
        $result = $stmt->get_result();
        $target_user = $result->fetch_assoc();
        $stmt->close();

        if (!$target_user) {
            $message = "Pengguna dengan NPM tersebut tidak ditemukan.";
            $message_type = 'danger';
        } elseif ($target_user['id'] == $user_id) {
            $message = "Anda tidak bisa menambahkan diri sendiri sebagai partner.";
            $message_type = 'danger';
        } else {
            $target_user_id = $target_user['id'];

            // Determine user_one_id and user_two_id consistently for the unique_partner_pair constraint
            // Always store the lower ID as user_one_id to ensure the unique constraint works regardless of who initiated
            $u_one = min($user_id, $target_user_id);
            $u_two = max($user_id, $target_user_id);

            // 3. Check if a request already exists (pending, accepted, declined, blocked)
            $stmt = $conn->prepare("SELECT id, status FROM study_partners WHERE user_one_id = ? AND user_two_id = ?");
            $stmt->bind_param("ii", $u_one, $u_two);
            $stmt->execute();
            $result = $stmt->get_result();
            $existing_request = $result->fetch_assoc();
            $stmt->close();

            if ($existing_request) {
                if ($existing_request['status'] == 'pending') {
                    $message = "Permintaan partner sudah dikirim dan sedang menunggu persetujuan.";
                } elseif ($existing_request['status'] == 'accepted') {
                    $message = "Anda sudah menjadi partner dengan pengguna ini.";
                } elseif ($existing_request['status'] == 'declined') {
                    $message = "Permintaan partner sebelumnya ditolak. Anda bisa mencoba mengirim ulang.";
                    // Optionally, you might allow resending or re-activating declined requests here.
                    // For now, we'll treat it as 'already exists' for simplicity.
                } elseif ($existing_request['status'] == 'blocked') {
                    $message = "Anda diblokir oleh pengguna ini atau telah memblokirnya.";
                }
                $message_type = 'danger';
            } else {
                // 4. Insert new pending request
                // Use the consistent user_one_id, user_two_id, and set action_user_id
                $stmt = $conn->prepare("INSERT INTO study_partners (user_one_id, user_two_id, status, action_user_id, created_at) VALUES (?, ?, 'pending', ?, NOW())");
                $stmt->bind_param("iii", $u_one, $u_two, $user_id); // The current user (sender) is the action_user_id

                if ($stmt->execute()) {
                    $message = "Permintaan partner berhasil dikirim!";
                    $message_type = 'success';
                } else {
                    $message = "Gagal mengirim permintaan partner. Silakan coba lagi.";
                    $message_type = 'danger';
                }
                $stmt->close();
            }
        }
    }
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Tambah Partner - V-Check</title>
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

        .form-card {
            background: white;
            border-radius: 15px;
            padding: 25px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.08);
        }

        .form-card h6 {
            font-weight: 700;
            font-size: 1.1rem;
            color: #7a7f4a;
            margin-bottom: 20px;
            text-align: center;
        }

        .form-label {
            font-weight: 600;
            color: #7a7f4a;
        }

        .btn-primary {
            background-color: #a3a96e;
            border-color: #a3a96e;
            width: 100%;
            padding: 10px;
            font-size: 1rem;
            border-radius: 10px;
        }

        .btn-primary:hover {
            background-color: #7a7f4a;
            border-color: #7a7f4a;
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
        <div class="page-title mx-auto">Tambah Partner</div>
    </header>

    <!-- Main Content -->
    <main>
        <div class="form-card">
            <h6>Kirim Permintaan Partner</h6>
            <?php if ($message): ?>
                <div class="alert alert-<?php echo $message_type; ?> alert-dismissible fade show" role="alert">
                    <?php echo $message; ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>
            <form action="addPartner.php" method="POST">
                <div class="mb-3">
                    <label for="npm" class="form-label">NPM Calon Partner</label>
                    <input type="text" class="form-control" id="npm" name="npm" placeholder="Masukkan NPM partner" required>
                </div>
                <button type="submit" class="btn btn-primary">Kirim Permintaan</button>
            </form>
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