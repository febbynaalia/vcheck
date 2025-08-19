<?php
session_start();
include 'config.php';

if (!isset($_SESSION['uid'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['uid'];
$total_poin = 0;
$activities = [
    'Disetujui' => [],
    'Diajukan' => [],
    'Diproses' => []
];

// Ambil total poin yang disetujui
$stmt_poin = $conn->prepare("SELECT SUM(poin) as total FROM skpm_activities WHERE user_id = ? AND status = 'Disetujui'");
$stmt_poin->bind_param("i", $user_id);
$stmt_poin->execute();
$result_poin = $stmt_poin->get_result();
$data_poin = $result_poin->fetch_assoc();
$total_poin = $data_poin['total'] ?? 0;
$stmt_poin->close();

// Ambil daftar semua kegiatan
$stmt_kegiatan = $conn->prepare("SELECT nama_kegiatan, status, poin FROM skpm_activities WHERE user_id = ? ORDER BY tanggal_pengajuan DESC");
$stmt_kegiatan->bind_param("i", $user_id);
$stmt_kegiatan->execute();
$result_kegiatan = $stmt_kegiatan->get_result();
while ($row = $result_kegiatan->fetch_assoc()) {
    if (array_key_exists($row['status'], $activities)) {
        $activities[$row['status']][] = $row;
    }
}
$stmt_kegiatan->close();
$conn->close();
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SKPM - V-Check</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet" />
    <style>
        /* CSS dari SKPM.php */
        body {
            background-color: #f4f6e8;
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding-bottom: 90px;
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

        .score-box {
            background-color: white;
            border-radius: 20px 20px 0 0;
            padding: 25px;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
            text-align: center;
            color: #a3a96e;
            font-weight: 700;
            font-size: 1.8rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .score-box i {
            font-size: 2rem;
        }

        .score-info {
            background-color: #a3a96e;
            color: white;
            padding: 8px 0;
            text-align: center;
            font-weight: 600;
            border-radius: 0 0 20px 20px;
            font-size: 1rem;
            margin-bottom: 20px;
        }

        .accordion-item.section-group {
            background-color: white;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
            padding: 5px 20px;
            border-radius: 20px;
            margin-bottom: 20px;
            border: none;
        }

        /* Corner fix for first and last accordion */
        .accordion-item.section-group:first-child {
            border-top-left-radius: 20px;
            border-top-right-radius: 20px;
        }
        .accordion-item.section-group:last-child {
            border-bottom-left-radius: 20px;
            border-bottom-right-radius: 20px;
        }

        .accordion-button.section-label,
        .accordion-button.collapsed.section-label {
            border-radius: 20px !important;
            background: none;
            font-weight: 700;
            font-size: 1.1rem;
            color: #7a7f4a;
            padding: 15px 0;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #eee;
            cursor: pointer;
            box-shadow: none;
        }

        .accordion-button:not(.collapsed) {
            color: #7a7f4a;
            background-color: #f4f6e8;
            box-shadow: none;
        }

        .accordion-button:focus {
            box-shadow: none;
        }

        .section-label:last-child {
            border-bottom: none;
        }

        .section-label i {
            font-size: 1.2rem;
        }

        .accordion-body {
            border-radius: 0 0 20px 20px;
        }

        .activity-card {
            background-color: #f8f9fa;
            border-radius: 15px;
            margin: 10px 0;
            padding: 15px;
            display: flex;
            justify-content: space-between;
            align-items: center;
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
        <div class="page-title mx-auto">SKPM</div>
    </header>

    <!-- Main Content -->
    <main>
        <div class="score-box">
            <div><?php echo $total_poin; ?> <span style="font-weight: 400">/ 150</span></div>
            <i class="fa-regular fa-face-smile"></i>
        </div>
        <div class="score-info">
            <?php echo ($total_poin >= 150) ? 'Target Tercapai!' : 'Sedikit Lagi!'; ?>
        </div>

        <div class="accordion" id="skpmAccordion">
            <!-- Pengajuan -->
            <div class="accordion-item section-group mb-3">
                <h2 class="accordion-header" id="headingPengajuan">
                    <button class="accordion-button collapsed section-label" type="button" data-bs-toggle="collapse" data-bs-target="#pengajuanCollapse" aria-expanded="false" aria-controls="pengajuanCollapse">
                        Pengajuan
                    </button>
                </h2>
                <div id="pengajuanCollapse" class="accordion-collapse collapse" aria-labelledby="headingPengajuan" data-bs-parent="#skpmAccordion">
                    <div class="accordion-body p-0">
                        <?php if (empty($activities['Diajukan'])): ?>
                            <p class="text-muted p-3 mb-0">Tidak ada pengajuan baru.</p>
                            <?php else: foreach ($activities['Diajukan'] as $activity): ?>
                                <div class="activity-card"><span><?php echo htmlspecialchars($activity['nama_kegiatan']); ?></span><span class="badge bg-warning text-dark">Pending</span></div>
                        <?php endforeach;
                        endif; ?>
                    </div>
                </div>
            </div>
            <!-- Dalam Proses -->
            <div class="accordion-item section-group mb-3">
                <h2 class="accordion-header" id="headingProses">
                    <button class="accordion-button collapsed section-label" type="button" data-bs-toggle="collapse" data-bs-target="#prosesCollapse" aria-expanded="false" aria-controls="prosesCollapse">
                        Dalam Proses
                    </button>
                </h2>
                <div id="prosesCollapse" class="accordion-collapse collapse" aria-labelledby="headingProses" data-bs-parent="#skpmAccordion">
                    <div class="accordion-body p-0">
                        <?php if (empty($activities['Diproses'])): ?>
                            <p class="text-muted p-3 mb-0">Tidak ada yang sedang diproses.</p>
                            <?php else: foreach ($activities['Diproses'] as $activity): ?>
                                <div class="activity-card"><span><?php echo htmlspecialchars($activity['nama_kegiatan']); ?></span><span class="badge bg-info">Diproses</span></div>
                        <?php endforeach;
                        endif; ?>
                    </div>
                </div>
            </div>
            <!-- Disetujui -->
            <div class="accordion-item section-group">
                <h2 class="accordion-header" id="headingDisetujui">
                    <button class="accordion-button section-label" type="button" data-bs-toggle="collapse" data-bs-target="#disetujuiCollapse" aria-expanded="true" aria-controls="disetujuiCollapse">
                        Disetujui
                    </button>
                </h2>
                <div id="disetujuiCollapse" class="accordion-collapse collapse show" aria-labelledby="headingDisetujui" data-bs-parent="#skpmAccordion">
                    <div class="accordion-body p-0">
                        <?php if (empty($activities['Disetujui'])): ?>
                            <p class="text-muted p-3 mb-0">Belum ada kegiatan yang disetujui.</p>
                            <?php else: foreach ($activities['Disetujui'] as $activity): ?>
                                <div class="activity-card"><span><?php echo htmlspecialchars($activity['nama_kegiatan']); ?></span><span class="badge fw-bold" style="background-color: #a3a96e; color: white;"><?php echo $activity['poin']; ?> Poin</span></div>
                        <?php endforeach;
                        endif; ?>
                    </div>
                </div>
            </div>
        </div>
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