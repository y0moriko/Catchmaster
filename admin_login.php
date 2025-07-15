
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
    }

    #carouselBackground {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      z-index: -1;
    }

    #carouselBackground .carousel-item,
    #carouselBackground .carousel-item img {
      height: 100vh;
      object-fit: cover;
    }

    .login-box {
      background-color: rgba(255, 255, 255, 0.9);
      padding: 40px;
      border-radius: 10px;
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
      width: 100%;
      max-width: 400px;
      z-index: 1;
    }

    .login-logo img {
      max-height: 80px;
      margin-bottom: 20px;
    }
  </style>
</head>
<body>
  <?php include 'notifications/messages.php'?>
  <!-- Background Carousel -->
  <div id="carouselBackground" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-interval="4000">
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img src="images/icon/0.jpg" class="d-block w-100" alt="Slide 1">
      </div>
      <div class="carousel-item">
        <img src="images/icon/00.jpg" class="d-block w-100" alt="Slide 2">
      </div>
      <div class="carousel-item">
        <img src="images/icon/000.jpg" class="d-block w-100" alt="Slide 3">
      </div>
      <div class="carousel-item">
        <img src="images/icon/0000.jpg" class="d-block w-100" alt="Slide 4">
      </div>
    </div>
  </div>

  <!-- Login Box -->
  <div class="login-box text-center mx-auto" style="
  max-width: 420px;
  width: 100%;
  padding: 40px;
  border-radius: 20px;
  background: rgba(255, 255, 255, 0.25);
  box-shadow: 0 8px 32px rgba(0, 0, 0, 0.2);
  backdrop-filter: blur(12px);
  -webkit-backdrop-filter: blur(12px);
  border: 1px solid rgba(255, 255, 255, 0.3);
  color: #fff;
">
  <div class="login-logo mb-4">
    <img src="images/icon/222.png" alt="Logo" class="img-fluid" style="max-height: 100px;">
  </div>
  <h4 class="mb-4 fw-bold">Welcome Back!</h4>
  <form action="functions/sessions/admin-login.php" method="post">
    <div class="mb-3 text-start">
      <label for="email" class="form-label">Username</label>
      <input type="email" class="form-control bg-transparent text-white border-light" id="email" name="email" placeholder="Enter your username" required>
    </div>
    <div class="mb-3 text-start">
      <label for="password" class="form-label">Password</label>
      <input type="password" class="form-control bg-transparent text-white border-light" id="password" name="password" placeholder="Enter your password" required>
    </div>
    <button class="btn btn-success w-100 py-2 fw-semibold" type="submit">Sign In</button>
  </form>
</div>


  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>