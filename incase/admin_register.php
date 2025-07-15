<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Admin Register</title>

  <!-- Bootstrap 5 CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Optional Vendor CSS -->
  <link href="vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" />
  <link href="vendor/font-awesome-5/css/fontawesome-all.min.css" rel="stylesheet" />
  <link href="vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" />

  <style>
    
    html, body {

      height: 100%;
      margin: 0;
      padding: 0;
      font-family: Arial, sans-serif;
    }

    #carouselBackground {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      z-index: -1;
      overflow: hidden;
    }

    #carouselBackground .carousel-item img {
      width: 100vw;
      height: 100vh;
      object-fit: cover;
    }

    .login-form {
      max-width: 600px;
      margin: 100px auto;
      background: rgba(255, 255, 255, 0.2);
      backdrop-filter: blur(12px);
      -webkit-backdrop-filter: blur(12px);
      border-radius: 16px;
      border: 1px solid rgba(255, 255, 255, 0.3);
      box-shadow: 0 8px 32px rgba(0, 0, 0, 0.2);
      padding: 40px;
      color: #000;
    }

    .form-row {
      display: flex;
      gap: 16px;
      flex-wrap: wrap;
      margin-bottom: 20px;
    }

    .form-row .form-group {
      flex: 1;
      min-width: 150px;
    }

    .au-input {
      background-color: rgba(255, 255, 255, 0.9);
      border: 1px solid #ced4da;
      padding: 10px;
      border-radius: 6px;
      width: 100%;
    }

    .image-upload {
      position: relative;
      width: 100px;
      height: 100px;
      border: 2px dashed #000;
      border-radius: 5px;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      margin-bottom: 20px;
      cursor: pointer;
      text-align: center;
    }

    .image-upload input[type="file"] {
      display: none;
    }

    .image-upload .icon {
      font-size: 24px;
      color: #000;
      margin-bottom: 4px;
    }

    .image-upload small {
      color: #666;
      font-size: 12px;
    }

    #imagePreview {
      width: 100%;
      height: 100%;
      object-fit: cover;
      border-radius: 5px;
      display: none;
      position: absolute;
      top: 0;
      left: 0;

    }
  </style>
</head>

<body>
  <!-- Carousel Background -->
  <div id="carouselBackground" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-interval="4000">
    <div class="carousel-inner">
      <div class="carousel-item active"><img src="images/icon/0.jpg" class="d-block w-100"></div>
      <div class="carousel-item"><img src="images/icon/00.jpg" class="d-block w-100"></div>
      <div class="carousel-item"><img src="images/icon/000.jpg" class="d-block w-100"></div>
      <div class="carousel-item"><img src="images/icon/0000.jpg" class="d-block w-100"></div>
    </div>
  </div>

  <div class="login-form">
    <div class="text-center mb-4">
      <img src="images/icon/222.png" alt="Catchmaster" style="max-height: 100px;" />
    </div>
    <form action="functions/add-func/add-admin.php" method="post" enctype="multipart/form-data" autocomplete="off" novalidate>
      <div class="image-upload" onclick="document.getElementById('image').click();">
        <input id="image" type="file" name="image" accept="image/*" onchange="previewImage(event)">
        <span class="icon">+</span>
        <small>Add Image</small>
        <img id="imagePreview" src="" alt="Image Preview">
      </div>

      <div class="form-row">
        <div class="form-group">
          <label for="first_name">First Name</label>
          <input id="first_name" class="au-input" type="text" name="first_name" required oninput="capitalizeInput(this)">
        </div>
        <div class="form-group">
          <label for="middle_name">Middle Name</label>
          <input id="middle_name" class="au-input" type="text" name="middle_name" oninput="capitalizeInput(this)">
        </div>
        <div class="form-group">
          <label for="last_name">Last Name</label>
          <input id="last_name" class="au-input" type="text" name="last_name" required oninput="capitalizeInput(this)">
        </div>
      </div>

      <div class="form-group mb-3">
        <label for="department_role">Department Role</label>
        <input id="department_role" class="au-input" type="text" name="department_role" required>
      </div>

      <div class="form-row">
        <div class="form-group">
          <label for="email">Email Address</label>
          <input id="email" class="au-input" type="email" name="email" required>
        </div>
        <div class="form-group">
          <label for="phone_number">Phone Number</label>
          <input id="phone_number" class="au-input" type="tel" name="phone_number" required>
        </div>
      </div>

      <div class="form-row">
        <div class="form-group">
          <label for="password">Password</label>
          <input id="password" class="au-input" type="password" name="password" required>
        </div>
        <div class="form-group">
          <label for="confirm_password">Confirm Password</label>
          <input id="confirm_password" class="au-input" type="password" name="confirm_password" required>
        </div>
      </div>

      <div class="form-check mb-3">
        <input type="checkbox" class="form-check-input" name="agree" required>
        <label class="form-check-label">Agree to the terms and policy</label>
      </div>

      <button class="btn btn-success w-100" type="submit">Register</button>
    </form>

    <div class="text-center mt-3">
      <p>Already have an account? <a href="login.php">Sign In</a></p>
    </div>
  </div>

  <!-- Bootstrap 5 JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    function previewImage(event) {
      const imagePreview = document.getElementById('imagePreview');
      const file = event.target.files[0];
      const reader = new FileReader();

      reader.onload = function () {
        imagePreview.src = reader.result;
        imagePreview.style.display = 'block';
      }

      if (file) {
        reader.readAsDataURL(file);
      } else {
        imagePreview.src = "";
        imagePreview.style.display = 'none';
      }
    }

    function capitalizeInput(input) {
      const words = input.value.split(' ');
      input.value = words.map(word => word.charAt(0).toUpperCase() + word.slice(1).toLowerCase()).join(' ');
    }
  </script>
</body>

</html>
