<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Student Lounge - V-Check</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet" />
    <style>
        body {
            background-color: #f4f6e8;
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding-bottom: 90px;
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

        .level-row {
            display: flex;
            justify-content: space-between;
            padding: 15px 20px 0;
        }

        .level-row div {
            background-color: white;
            border-radius: 15px;
            padding: 10px 8px;
            font-size: 0.75rem;
            color: #a3a96e;
            text-align: center;
            flex: 1;
            margin: 0 4px;
            font-weight: 600;
        }

        .section-title {
            text-align: center;
            font-weight: 600;
            font-size: 1.1rem;
            margin-top: 25px;
            margin-bottom: 10px;
            color: #a3a96e;
        }

        .card {
            background: white;
            border-radius: 20px;
            margin: 10px 20px;
            padding: 20px;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .card.achievement {
            font-weight: 600;
            font-size: 0.95rem;
            color: #5d5d3a;
        }

        .card.achievement strong {
            display: block;
            color: #a3a96e;
            font-size: 1.05rem;
            margin-bottom: 5px;
        }

        .card.badge {
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            color: #a3a96e;
            gap: 10px;
            font-weight: 600;
        }

        .card.features {
            display: flex;
            justify-content: space-around;
            align-items: center;
            padding: 25px 10px;
        }

        .features .feature-item {
            text-align: center;
            color: #a3a96e;
            font-weight: 600;
            font-size: 0.85rem;
        }

        .features .feature-item i {
            font-size: 1.6rem;
            margin-bottom: 6px;
        }

        .feature-item {
            font-weight: 600;
            color: #a3a96e;
            font-size: 0.85rem;
            margin-bottom: 10px;
        }

        .icon-circle {
            width: 50px;
            height: 50px;
            background-color: #f4f6e8;
            color: #a3a96e;
            border-radius: 50%;
            margin: 0 auto 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.3rem;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.05);
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

        .footer button:hover {
            color: #e6f0c9;
        }

        .profile-fab {
            position: fixed;
            bottom: 75px;
            right: 20px;
            background-color: #a3a96e;
            color: white;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            font-size: 1.4rem;
            display: flex;
            justify-content: center;
            align-items: center;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
        }
    </style>
</head>

<body>

    <!-- Header -->
    <header class="header d-flex align-items-center sticky-top">
        <div class="back-btn" onclick="history.back()">
            <i class="fa-solid fa-arrow-left"></i>
        </div>
        <div class="page-title mx-auto">Student Lounge</div>
    </header>

    <!-- Profile Floating Action Button -->
    <div class="level-row">
        <div>⭐<br>Level 1</div>
        <div>⭐<br>Level 2</div>
        <div>⭐<br>Level 3</div>
        <div>⭐<br>Level 4</div>
        <div>⭐<br>Level 5</div>
        <div>⭐<br>Level 6+</div>
    </div>

    <!-- Achievement Section -->
    <div class="section-title">Achievement</div>
    <div class="card achievement">
        <strong>“A Whole New World”</strong>
        Unlocked Feature: XP Pemula (2x bonus untuk kehadiran pertama)
    </div>

    <!-- Badge Section -->
    <div class="card badge">
        <i class="fa-solid fa-award" style="opacity:0.6;"></i> <span style="opacity:0.6;">Mahasiswa Teladan</span>
    </div>

    <!-- Features Section -->
    <div class="section-title">Features</div>
    <!-- Feature Cards -->
    <div class="card features">
        <div class="row text-center w-100">
            <div class="col-4 feature-item">
                <a href="tutorial.php" style="text-decoration:none; color:inherit;">
                    <div class="icon-circle">
                        <i class="fa-solid fa-question-circle"></i>
                    </div>
                    <div>Tutorial</div>
                </a>
            </div>
            <div class="col-4 feature-item">
                <a href="studyPartner.php" style="text-decoration:none; color:inherit;">
                    <div class="icon-circle">
                        <i class="fa-solid fa-users"></i>
                    </div>
                    <div>Study Partner</div>
                </a>
            </div>
            <div class="col-4 feature-item">
                <a href="SKPM.php" style="text-decoration:none; color:inherit;">
                    <div class="icon-circle">
                        <i class="fa-solid fa-file-lines"></i>
                    </div>
                    <div>SKPM</div>
                </a>
            </div>
        </div>
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