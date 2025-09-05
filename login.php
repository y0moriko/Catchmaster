<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Welcome Admin</title>

  <!-- Bootstrap 5 CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

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

    .welcome-box {
      background-color: rgba(255, 255, 255, 0.25);
      padding: 20px;
      border-radius: 20px;
      box-shadow: 0 8px 32px rgba(0, 0, 0, 0.2);
      backdrop-filter: blur(12px);
      -webkit-backdrop-filter: blur(12px);
      border: 1px solid rgba(255, 255, 255, 0.3);
      color: #fff;
      z-index: 1;
      text-align: center;
      max-width: 420px;
      width: 100%;
    }

    .welcome-box img {
      max-height: 100px;
      margin-bottom: 20px;
    }

    .welcome-box h4 {
      margin-bottom: 40px;
    }

    .btn-admin {
      background-color: #002367;
      color: #fff;
      border: none;
      padding: 12px 50px;
      border-radius: 10px;
      font-size: 18px;
      font-weight: 600;
      text-transform: uppercase;
      transition: background-color 0.3s ease;
      text-decoration: none;
    }

    .btn-admin:hover {
      background-color: #00194a;
      color: #fff;
    }
  </style>

  <script>
  $(document).ready(function() {
      toastr.options.closeButton = true;

      <?php if(isset($_SESSION['success'])): ?>
          toastr.success('<?php echo addslashes($_SESSION['success']); unset($_SESSION['success']); ?>');
      <?php endif; ?>
      
      <?php if(isset($_SESSION['error'])): ?>
          toastr.error('<?php echo addslashes($_SESSION['error']); unset($_SESSION['error']); ?>');
      <?php endif; ?>

      <?php session_destroy(); ?>
  });
  </script>
</head>
<body>
  <!-- Welcome Admin Card -->
  <div class="welcome-box">
    <img src="images/icon/222.png" alt="Logo" class="img-fluid mb-3">
    <h4 class="mb-4">Welcome Admin!</h4>
    <a href="admin_login.php" class="btn btn-admin w-100">Admin</a>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
