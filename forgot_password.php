<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Forgot Password</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="d-flex justify-content-center align-items-center vh-100 bg-dark text-white">
  <div class="p-4 rounded bg-secondary bg-opacity-50" style="max-width:400px;width:100%;">
    <h3 class="text-center mb-3">Forgot Password</h3>
    <form action="functions/sessions/send-reset.php" method="post">
      <div class="mb-3">
        <label for="email" class="form-label">Enter your registered email</label>
        <input type="email" class="form-control" name="email" id="email" required>
      </div>
      <button type="submit" class="btn btn-light w-100">Send Reset Link</button>
    </form>
    <div class="text-center mt-3">
      <a href="login.php" class="text-light">Back to Login</a>
    </div>
  </div>
</body>
</html>
