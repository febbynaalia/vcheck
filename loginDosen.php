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
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: flex-start;
      height: 100vh;
    }

    .top-illustration {
      width: 100%;
      background-color: #a3a96e;
      border-bottom-left-radius: 30px;
      border-bottom-right-radius: 30px;
      padding-top: 50px;
      padding-bottom: 30px;
      display: flex;
      justify-content: center;
    }

    .top-illustration img {
      width: 150px;
      height: auto;
      user-select: none;
    }

    .login-box {
      width: 100%;
      max-width: 400px;
      background: white;
      border-radius: 30px;
      padding: 30px 25px;
      margin-top: -30px;
      box-shadow: 0 8px 15px rgba(0, 0, 0, 0.1);
    }

    .login-box h2 {
      text-align: center;
      color: #a3a96e;
      font-weight: 700;
      margin-bottom: 25px;
    }

    .form-control {
      border-radius: 15px;
      background-color: #e6e6e6;
      border: none;
      padding: 12px;
      font-weight: 500;
      color: #333;
      margin-bottom: 15px;
    }

    .btn-loginDosen {
      background-color: #a3a96e;
      color: white;
      font-weight: 600;
      border: none;
      border-radius: 20px;
      margin-top: 10px;
      padding: 12px;
      width: 100%;
      box-shadow: 0 4px 8px rgba(163, 169, 110, 0.5);
      transition: background-color 0.3s ease;
    }

    .btn-login:hover {
      background-color: #8a8f5a;
    }

    .forgot {
      text-align: center;
      margin-top: 10px;
    }

    .forgot a {
      color: #8a8a5c;
      font-size: 0.9rem;
      text-decoration: underline;
    }
  </style>
</head>

<body>

  <!-- Top illustration -->
  <div class="top-illustration">
    <img src="assets/pngegg.png" alt="Dosen" />
  </div>

  <!-- Login box -->
  <div class="login-box">
    <h2>Login Dosen</h2>
    <form action="loginDosen-action.php" method="POST">
      <input type="email" name="email" class="form-control" placeholder="Email" required />
      <input type="password" name="password" class="form-control" placeholder="Password" required />
      <!-- PAKE INI BUAT DI PHP!!! -->
      <!-- <a href="homepage.php" class="btn-login d-block text-center text-white text-decoration-none">Login</a> -->
      <button type="submit" class="btn-loginDosen">Masuk</button>
    </form>
    <div class="forgot">
      <a href="forgot-pw.php">Forgot Password?</a>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>