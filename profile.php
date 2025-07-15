<!DOCTYPE html>
<html lang="en">
<head>
  <?php include 'header.php'; ?>

  <style>
    body {
      position: relative;
      margin: 0;
      padding: 0;
      min-height: 100vh;
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

    /* Backdrop blur */
    .modal-backdrop.show {
      background-color: rgba(0, 0, 0, 0.3) !important;
      backdrop-filter: blur(8px);
      -webkit-backdrop-filter: blur(8px);
    }

    .capitalize {
      text-transform: capitalize;
    }
  </style>
</head>

<body style="background-color: lightgray; min-height: 100vh;">
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

  <!-- JS Scripts -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="vendor/bootstrap-4.1/popper.min.js"></script>
  <script src="vendor/bootstrap-4.1/bootstrap.min.js"></script>
  <script src="js/main.js"></script> 

</body>
</html>
