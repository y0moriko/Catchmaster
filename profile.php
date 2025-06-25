<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>My Account - Jeon Jungkook</title>

  <link href="css/font-face.css" rel="stylesheet" media="all" />
  <link href="vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all" />
  <link href="vendor/font-awesome-5/css/fontawesome-all.min.css" rel="stylesheet" media="all" />
  <link href="vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all" />
  <link href="vendor/bootstrap-4.1/bootstrap.min.css" rel="stylesheet" media="all" />
  <link href="css/theme.css" rel="stylesheet" />

  <style>
    body {
      background-image: url(images/icon/01.webp);
    }

    .account-container {
      max-width: 600px;
      margin: 60px auto;
      background: #fff;
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
      text-align: center;
    }

    .account-header h2 {
      margin-bottom: 10px;
      color: #333;
    }

    .profile-picture {
      width: 120px;
      height: 120px;
      border-radius: 50%;
      object-fit: cover;
      border: 3px solid #007bff;
      margin-bottom: 15px;
    }

    .profile-info,
    .settings {
      text-align: left;
      margin-top: 50px;
    }

    .profile-info h3,
    .settings h3 {
      border-bottom: 1px solid #ccc;
      padding-bottom: 10px;
      color: #555;
    }

    .profile-row {
      margin: 10px 0;
    }

    .profile-row label {
      display: inline-block;
      width: 150px;
      font-weight: bold;
    }

    .profile-row span {
      color: #333;
    }

    .btn {
      padding: 10px 15px;
      background: #007bff;
      color: white;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      margin-top: 10px;
    }

    .btn:hover {
      background: #0056b3;
    }

    .btn.logout {
      background: #dc3545;
      margin-left: 10px;
    }

    .js-dropdown {
      display: none;
      position: absolute;
      background: white;
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
      z-index: 9999;
      min-width: 200px;
      border-radius: 6px;
      top: 100%;
      right: 0;
    }
  </style>
</head>

<body>
  <!-- HEADER DESKTOP -->
  <header class="header-desktop3 d-none d-lg-block">
    <div class="section__content section__content--p35">
      <div class="header4-wrap">
        <div class="header__logo">
          <a href="#"><img src="images/icon/01111.png" alt="Catchmaster" /></a>
        </div>
        <div class="header__navbar">
          <ul class="list-unstyled">
            <li><a href="index.php"><i class="fas fa-tachometer-alt"></i>Dashboard</a></li>
            <li><a href="fish_direct.php"><i class="fa fa-anchor" aria-hidden="true"></i></i>Fish Directory</a></li>
            <li><a href="fish_catch.php"><i class="fas fa-shopping-basket"></i>Fish Catch</a></li>
            <li class="has-sub">
              <a class="js-arrow" href="#"><i class="fas fa-copy"></i>User Management</a>
              <ul class="header3-sub-list list-unstyled">
                <li><a href="table-fishermen.php">Fishermen</a></li>
                <li><a href="admin.php">Admin</a></li>
              </ul>
            </li>
          </ul>
        </div>
        <div class="header__tool">
          <!-- Settings Menu -->
          <div class="header-button-item js-item-menu" style="position: relative;">
            <i class="zmdi zmdi-settings"></i>
            <div class="setting-dropdown js-dropdown">
              <div class="account-dropdown__body">
                <div class="account-dropdown__item"><a href="account.html"><i class="zmdi zmdi-account"></i>Account</a></div>
                <div class="account-dropdown__item"><a href="#"><i class="zmdi zmdi-settings"></i>Setting</a></div>
                <div class="account-dropdown__item"><a href="#"><i class="zmdi zmdi-money-box"></i>Billing</a></div>
              </div>
              <div class="account-dropdown__body">
                <div class="account-dropdown__item"><a href="#"><i class="zmdi zmdi-globe"></i>Language</a></div>
                <div class="account-dropdown__item"><a href="#"><i class="zmdi zmdi-pin"></i>Location</a></div>
                <div class="account-dropdown__item"><a href="#"><i class="zmdi zmdi-email"></i>Email</a></div>
                <div class="account-dropdown__item"><a href="#"><i class="zmdi zmdi-notifications"></i>Notifications</a></div>
              </div>
            </div>
          </div>

          <!-- Profile Menu -->
          <div class="account-wrap" style="position: relative;">
            <div class="account-item account-item--style2 clearfix js-item-menu">
              <div class="image"><img src="images/icon/jk.jpg" alt="Jungkook" /></div>
              <div class="content"><a class="js-acc-btn" href="#">Jungkook</a></div>
              <div class="account-dropdown js-dropdown">
                <div class="info clearfix">
                  <div class="image"><a href="#"><img src="images/icon/jk.jpg" alt="John Doe" /></a></div>
                  <div class="content">
                    <h5 class="name"><a href="#">Jungkook</a></h5>
                    <span class="email">jk@example.com</span>
                  </div>
                </div>
                <div class="account-dropdown__body">
                  <div class="account-dropdown__item"><a href="profile.html"><i class="zmdi zmdi-account"></i>Account Setting</a></div>
                </div>
                <div class="account-dropdown__footer">
                  <a href="login.php"><i class="zmdi zmdi-power"></i>Logout</a>
                </div>
              </div>
            </div>
          </div>

        </div>
      </div>
    </div>
  </header>

  <!-- Account Section -->
  <div class="account-container">
    <img src="images/icon/jk.jpg" alt="Jeon Jungkook" class="profile-picture" />
    <div class="account-header">
      <h3>Juan Dela Cruz</h3>
    </div>
    <div class="profile-info">
      <h3>Profile Information</h3>
      <div class="profile-row"><label>Full Name:</label><span>Juan Dela Cruz</span></div>
      <div class="profile-row"><label>Email:</label><span>juan@gmail.com</span></div>
      <div class="profile-row"><label>Username:</label><span>Juan</span></div>
      <div class="profile-row"><label>Department:</label><span>Agriculture</span></div>
      <div class="profile-row"><label>Role:</label><span>Department Head</span></div>
      <button class="btn">Edit Profile</button>
    </div>
    <div class="settings">
      <h3>Account Settings</h3>
      <div class="profile-row"><label>Password:</label><span>********</span></div>
      <button class="btn">Change Password</button>
    </div>
  </div>

  <!-- jQuery -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <!-- Bootstrap -->
  <script src="vendor/bootstrap-4.1/popper.min.js"></script>
  <script src="vendor/bootstrap-4.1/bootstrap.min.js"></script>

  <!-- Dropdown Toggle Script -->
  <script>
    $(document).ready(function () {
      // Toggle dropdown
      $('.js-item-menu').on('click', function (e) {
        e.preventDefault();
        e.stopPropagation();

        const $dropdown = $(this).find('.js-dropdown');
        $('.js-dropdown').not($dropdown).hide();
        $dropdown.toggle();
      });

      // Close dropdown when clicking outside
      $(document).on('click', function () {
        $('.js-dropdown').hide();
      });
    });
  </script>
</body>
</html>
