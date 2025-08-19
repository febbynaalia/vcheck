<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Login - V-Check</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <style>
    body {
      background-color: #f4f6e8;
      font-family: 'Poppins', sans-serif;
      margin: 0;
      padding: 0;
      min-height: 100vh;
      display: flex;
      flex-direction: column;
      align-items: center;
    }

    .top-illustration {
      width: 100%;
      background-color: #a3a96e;
      border-bottom-left-radius: 30px;
      border-bottom-right-radius: 30px;
      padding: 50px 0 30px 0;
      display: flex;
      justify-content: center;
    }

    .top-illustration img {
      width: 150px;
      height: auto;
      user-select: none;
      display: block;
    }

    .login-box {
      width: 100%;
      max-width: 400px;
      background: #fff;
      border-radius: 30px;
      padding: 32px 28px 28px 28px;
      margin-top: -30px;
      box-shadow: 0 8px 24px rgba(0, 0, 0, 0.08);
      display: flex;
      flex-direction: column;
      gap: 16px;
    }

    .login-box h2 {
      text-align: center;
      color: #a3a96e;
      font-weight: 700;
      margin-bottom: 18px;
      letter-spacing: 1px;
    }

    .form-control {
      border-radius: 15px;
      background-color: #f0f1ea;
      border: 1px solid #e0e0d1;
      padding: 12px 14px;
      font-weight: 500;
      color: #333;
      margin-bottom: 14px;
      transition: border-color 0.2s;
    }

    .form-control:focus {
      border-color: #a3a96e;
      outline: none;
      background-color: #f8f9f4;
    }

    .btn-login {
      background-color: #a3a96e;
      color: #fff;
      font-weight: 600;
      border: none;
      border-radius: 20px;
      padding: 12px;
      width: 100%;
      box-shadow: 0 4px 12px rgba(163, 169, 110, 0.15);
      transition: background-color 0.3s, box-shadow 0.3s;
      font-size: 1rem;
      margin-bottom: 6px;
    }

.btn-loginDosen {
      background-color: #a3a96e;
      color: white;
      font-weight: 600;
      border: none;
      border-radius: 20px;
      margin-top: 15px;
      padding: 12px;
      width: 100%;
      box-shadow: 0 4px 8px rgba(163, 169, 110, 0.5);
      transition: background-color 0.3s ease;
    }

    .btn-login:hover,
    .btn-login:focus {
      background-color: #8a8f5a;
      box-shadow: 0 6px 16px rgba(163, 169, 110, 0.22);
    }

.btn-loginDosen:hover {
      background-color: #8a8f5a;
    }

    .forgot {
      text-align: center;
      margin-top: 6px;
    }

    .forgot a {
      color: #8a8a5c;
      font-size: 0.95rem;
      text-decoration: underline;
      transition: color 0.2s;
    }

    .forgot a:hover {
      color: #a3a96e;
    }

    @media (max-width: 480px) {
      .login-box {
        padding: 22px 10px 18px 10px;
        max-width: 95vw;
      }
      .top-illustration img {
        width: 110px;
      }
    }
  </style>
</head>

<body>

  <!-- Top illustration -->
  <div class="top-illustration">
    <img src="assets/oyen.png" alt="Oyen Lemes" />
  </div>

  <!-- Login box -->
  <div class="login-box">
    <h2>Login</h2>
    <form action="login-action.php" method="POST">
      <input type="email" name="email" class="form-control" placeholder="Email" required />
      <input type="password" name="password" class="form-control" placeholder="Password" required />
      <!-- PAKE INI BUAT DI PHP!!!-->
      <button type="submit" class="btn-login">Login</button>
      <!-- <a href="homepage.php" class="btn-login d-block text-center text-white text-decoration-none">Login</a> -->
      <button type="button" class="btn-loginDosen" onclick="window.location.href='loginDosen.php'">Login sebagai Dosen?</button>
      </form>
    <div class="forgot">
      <a href="forgot-pw.php">Forgot Password?</a>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>