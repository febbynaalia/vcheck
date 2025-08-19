<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>V-Check</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500;700&display=swap" rel="stylesheet" />
    <style>
        body {
            margin: 0;
            background-color: #f4f6e8;
            font-family: 'Poppins', sans-serif;
            height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .header {
            background-color: #a3a96e;
            color: white;
            text-align: center;
            padding: 25px;
            border-bottom-left-radius: 30px;
            border-bottom-right-radius: 30px;
            font-size: 1.5rem;
            font-weight: 700;
        }

        .content {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            padding: 20px;
        }

        .logo {
            width: 120px;
            margin-bottom: 20px;
        }

        .title {
            font-size: 2rem;
            font-weight: 700;
            color: #a3a96e;
            margin-bottom: 10px;
        }

        .subtitle {
            font-size: 1rem;
            color: #7a7f4a;
            margin-bottom: 30px;
        }

        .start-btn {
            background-color: #a3a96e;
            color: white;
            border: none;
            border-radius: 25px;
            padding: 12px 30px;
            font-weight: 600;
            font-size: 1rem;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            transition: background-color 0.3s ease;
            text-decoration: none;
        }

        .start-btn:hover {
            background-color: #8e935c;
        }

        .footer {
            background-color: #a3a96e;
            color: white;
            text-align: center;
            padding: 12px;
            border-top-left-radius: 30px;
            border-top-right-radius: 30px;
            font-size: 0.9rem;
        }
    </style>
</head>

<body>

    <!-- Header -->
    <div class="header sticky-top">
        V-Check
    </div>

    <!-- Content -->
    <div class="content">
        <img src="assets/oyen.png" alt="Logo V-Check" class="logo" />
        <div class="title">Selamat Datang di V-Check</div>
        <div class="subtitle">Petualangan Kehadiran & SKPM dimulai dari sini!</div>
        <a href="login.php" class="start-btn">Mulai</a>
    </div>

    <!-- Footer -->
    <div class="footer">
        &copy; 2025 V-Check | Virtual Kehadiran Mahasiswa
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>