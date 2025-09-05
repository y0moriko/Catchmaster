<?php
session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login</title>

  <!-- Bootstrap 5 CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

  <style>
    html, body {
      height: 100%;
      margin: 0;
      padding: 0;
    }

    body {
      display: flex;
      justify-content: center;
      align-items: center;
      position: relative;
      overflow: hidden;
      background: url("images/icon/0000.jpg") no-repeat center center fixed;
      background-size: cover;
    }

    .login-box {
      padding: 40px;
      border-radius: 20px;
      background: rgba(255, 255, 255, 0.25);
      box-shadow: 0 8px 32px rgba(0, 0, 0, 0.2);
      backdrop-filter: blur(12px);
      -webkit-backdrop-filter: blur(12px);
      border: 1px solid rgba(255, 255, 255, 0.3);
      color: #fff;
      width: 100%;
      max-width: 420px;
      z-index: 1;
    }

    .login-logo img {
      max-height: 100px;
      margin-bottom: 20px;
    }

    .form-control {
      background: transparent;
      color: #fff;
      border: 1px solid rgba(255, 255, 255, 0.6);
    }

    .form-control::placeholder {
      color: rgba(255, 255, 255, 0.7);
    }

    .forgot-password {
      display: block;
      margin-top: 10px;
      text-align: right;
    }

    .forgot-password a {
      color: #fff;
      text-decoration: none;
      font-size: 0.9rem;
    }

    .forgot-password a:hover {
      text-decoration: underline;
    }
  </style>
  <?php include 'notifications/messages.php' ?>
</head>
<body>
  <!-- Login Box -->
  <div class="login-box text-center mx-auto">
    <div class="login-logo mb-4">
      <img src="images/icon/222.png" alt="Logo" class="img-fluid">
    </div>
    <h4 class="mb-4 fw-bold">Welcome Back!</h4>
    <form action="functions/sessions/admin-login.php" method="post">
      <div class="mb-3 text-start">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" required>
      </div>
      <div class="mb-3 text-start">
        <label for="password" class="form-label">Password</label>
        <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password" required>
      </div>
      <button class="btn btn-success w-100 py-2 fw-semibold" type="submit">Sign In</button>

      <!-- Forgot password link -->
      <div class="forgot-password">
        <a href="forgot_password.php">Forgot Password?</a>
      </div>
    </form>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
