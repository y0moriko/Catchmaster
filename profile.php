<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Profile Page</title>

  <!-- Fonts & Icons -->
  <link href="css/font-face.css" rel="stylesheet">
  <link href="vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet">
  <link href="vendor/font-awesome-5/css/fontawesome-all.min.css" rel="stylesheet">
  <link href="vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet">

  <!-- Bootstrap -->
  <link href="vendor/bootstrap-4.1/bootstrap.min.css" rel="stylesheet">

  <!-- Theme -->
  <link href="css/theme.css" rel="stylesheet">

  <style>
    body {
      position: relative;
      margin: 0;
      padding: 0;
      min-height: 100vh;
    }

    body::before {
      content: "";
      position: fixed;
      top: 0;
      left: 0;
      height: 100%;
      width: 100%;
      background: url('images/icon/00.jpg') center/cover no-repeat;
      filter: blur(6px);
      z-index: -1;
    }

    .account-container {
      max-width: 650px;
      margin: 130px auto 60px auto;
      background: #ffffffee;
      padding: 40px 35px;
      border-radius: 20px;
      box-shadow: 0 12px 35px rgba(0, 0, 0, 0.15);
      text-align: center;
      backdrop-filter: blur(3px);
    }

    .account-header h3 {
      font-size: 28px;
      font-weight: 600;
      color: #222;
      margin-bottom: 20px;
    }

    .profile-picture {
      width: 120px;
      height: 120px;
      border-radius: 50%;
      object-fit: cover;
      border: 3px solid #007bff;
      margin-bottom: 15px;
    }

    .profile-info h3,
    .settings h3 {
      font-size: 20px;
      font-weight: 600;
      border-bottom: 1px solid #ccc;
      padding-bottom: 10px;
      color: #007bff;
      margin-top: 40px;
      margin-bottom: 20px;
      text-align: left;
    }

    .profile-row {
      text-align: left;
      margin: 10px 0;
    }

    .profile-row label {
      font-weight: bold;
      display: inline-block;
      width: 140px;
      color: #555;
    }

    .profile-row span {
      color: #333;
    }

    .btn {
      font-weight: 500;
      padding: 10px 18px;
      background-color: #007bff;
      color: white;
      border: none;
      border-radius: 8px;
      cursor: pointer;
      margin-top: 10px;
    }

    .btn:hover {
      background-color: #0056b3;
    }

    .modal-content {
      border-radius: 15px;
      border: none;
      box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
      padding: 20px;
    }

    .modal-title {
      font-weight: 600;
      color: #007bff;
    }

    .form-control {
      border-radius: 10px;
      padding: 10px 15px;
      border: 1px solid #ccc;
      transition: border-color 0.3s ease;
    }

    .form-control:focus {
      border-color: #007bff;
      box-shadow: none;
    }

    .modal-footer .btn {
      padding: 10px 20px;
    }
  </style>
</head>
<body>

  <!-- HEADER DESKTOP -->
  <header class="header-desktop3 d-none d-lg-block">
    <div class="section__content section__content--p35">
      <div class="header4-wrap">
        <div class="header__logo">
          <a href="#"><img src="images/icon/01111.png" alt="Catchmaster"></a>
        </div>
        <div class="header__navbar">
          <ul class="list-unstyled">
            <li><a href="index.php"><i class="fas fa-tachometer-alt"></i>Dashboard</a></li>
            <li><a href="fish_direct.php"><i class="fa fa-anchor"></i>Fish Directory</a></li>
            <li><a href="fish_catch.php"><i class="fas fa-shopping-basket"></i>Fish Catch</a></li>
            <li class="has-sub">
              <a class="js-arrow" href="#"><i class="fas fa-copy"></i>User Management</a>
              <ul class="header3-sub-list list-unstyled">
                <li><a href="fishermen_list.php">Fishermen</a></li>
                <li><a href="admin.php">Admin</a></li>
              </ul>
            </li>
          </ul>
        </div>
        <div class="header__tool">
          <div class="header-button-item js-item-menu" style="position: relative;">
            <i class="zmdi zmdi-settings"></i>
          </div>
          <div class="account-wrap" style="position: relative;">
            <div class="account-item account-item--style2 clearfix js-item-menu">
              <div class="image"><img src="images/icon/jk.jpg" alt="Jungkook"></div>
              <div class="content"><a class="js-acc-btn" href="#">Jungkook</a></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </header>

  <!-- ACCOUNT SECTION -->
  <div class="account-container">
    <img src="images/icon/jk.jpg" alt="Jeon Jungkook" class="profile-picture">
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
      <button class="btn" data-toggle="modal" data-target="#editProfileModal">Edit Profile</button>
    </div>
    <div class="settings">
      <h3>Account Settings</h3>
      <div class="profile-row"><label>Password:</label><span>********</span></div>
      <button class="btn" data-toggle="modal" data-target="#changePasswordModal">Change Password</button>
    </div>
  </div>
<style>
                                /* Custom backdrop with blur and translucency for visible background */
                                .modal-backdrop.show {
                                background-color: rgba(0, 0, 0, 0.3) !important; /* lighter black */
                                backdrop-filter: blur(8px);
                                -webkit-backdrop-filter: blur(8px);
                                }

                                /* Modal content with glass morphism style */
                                .modal-content {
                                background: rgba(255, 255, 255, 0.85);
                                backdrop-filter: saturate(180%) blur(15px);
                                -webkit-backdrop-filter: saturate(180%) blur(15px);
                                border-radius: 12px;
                                border: 1px solid rgba(255, 255, 255, 0.3);
                                box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.2);
                                }

                                /* Ensure labels and inputs have good contrast on this background */
                                label {
                                font-weight: 600;
                                color: #222;
                                }

                                .modal-header .close {
                                color: #444;
                                opacity: 1;
                                font-size: 1.5rem;
                                }

                                /* Capitalize the first letter of each word in name fields */
                                .capitalize {
                                text-transform: capitalize;
                                }
                            </style>
                            </head>
                            <body style="background-color: lightgray; min-height: 100vh;"></div>
  <!-- MODALS -->
  <div class="modal fade" id="editProfileModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <form class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Edit Profile</h5>
          <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
        </div>
        <div class="modal-body">
          <div class="form-group"><label>Full Name</label><input type="text" class="form-control" value="Juan Dela Cruz"></div>
          <div class="form-group"><label>Email</label><input type="email" class="form-control" value="juan@gmail.com"></div>
          <div class="form-group"><label>Username</label><input type="text" class="form-control" value="Juan"></div>
          <div class="form-group"><label>Department</label><input type="text" class="form-control" value="Agriculture"></div>
          <div class="form-group"><label>Role</label><input type="text" class="form-control" value="Department Head"></div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary">Save Changes</button>
        </div>
      </form>
    </div>
  </div>

  <div class="modal fade" id="changePasswordModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <form class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Change Password</h5>
          <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
        </div>
        <div class="modal-body">
          <div class="form-group"><label>Current Password</label><input type="password" class="form-control" required></div>
          <div class="form-group"><label>New Password</label><input type="password" class="form-control" required></div>
          <div class="form-group"><label>Confirm New Password</label><input type="password" class="form-control" required></div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary">Update Password</button>
        </div>
      </form>
    </div>
  </div>

  <!-- SCRIPTS -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="vendor/bootstrap-4.1/popper.min.js"></script>
  <script src="vendor/bootstrap-4.1/bootstrap.min.js"></script>
</body>
</html>
