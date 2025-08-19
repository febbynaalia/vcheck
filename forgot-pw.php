<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Lupa Password</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <style>
    body {
      background-color: #f4f6e8;
      font-family: 'Poppins', sans-serif;
      color: #8a936d;
      max-width: 400px;
      margin: auto;
      padding: 0;
    }

    .header {
      background-color: #a3a96e;
      ;
      color: white;
      padding: 15px 20px;
      border-bottom-left-radius: 40px;
      border-bottom-right-radius: 40px;
      font-weight: 700;
      font-size: 1.8rem;
      text-align: center;
      user-select: none;
    }

    .header img {
      width: 120px;
      margin-bottom: 1rem;
    }

    .form-container {
      background: white;
      padding: 2rem;
      border-radius: 30px 30px 0 0;
      box-shadow: 0 4px 6px rgb(0 0 0 / 0.1);
      margin-top: -20px;
    }

    .form-container h2 {
      font-weight: bold;
      margin-bottom: 1rem;
      color: #8a936d;
    }

    .form-control {
      border-radius: 15px;
      background-color: #e6e6e6;
      border: none;
      font-weight: bold;
      color: #6b6b6b;
      margin-bottom: 1rem;
      padding: 0.75rem 1rem;
    }

    .btn-send {
      background-color: #b4bc7a;
      border: none;
      border-radius: 20px;
      padding: 0.75rem;
      width: 100%;
      font-weight: bold;
      color: white;
      margin-bottom: 1rem;
    }

    .btn-send:hover {
      background-color: #9ca56a;
    }
  </style>
</head>

<body>

  <!-- Header -->
  <div class="header sticky-top">
    <img src="/v-check/assets/oyen.png" alt="Crying Cat" />
  </div>

  <!-- Form Container -->
  <div class="form-container">
    <h2>Forgot Password?</h2>
    <form>
      <input type="email" class="form-control" placeholder="Email" required />
      <button type="submit" class="btn-send">Send</button>
    </form>

    <p class="text-center" style="font-size: 0.9rem; color: #6b6b6b;">
      Remembered your password? <a href="login.php" style="color: #8a936d; text-decoration: underline;">Login</a>
    </p>
  </div>
</body>

</html>