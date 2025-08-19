<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    $_SESSION['error'] = "Please log in first.";
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <?php include 'functions/fetch-func/fetch-admin.php'?>
  <?php include 'header.php'; ?>
  <meta charset="UTF-8">
  <title>Profile & Fisheries Section</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.6.2/css/bootstrap.min.css" rel="stylesheet">

  <style>
    body {
      background-color: #f4f6f9;
      font-family: 'Segoe UI', sans-serif;
    }

    .container-custom {
      padding: 100px 20px 50px;
    }

    .card {
      border-radius: 20px;
      box-shadow: 0 8px 20px rgba(0,0,0,0.08);
    }

    .card-header {
      border-top-left-radius: 20px;
      border-top-right-radius: 20px;
    }

    .profile-img {
      width: 130px;
      height: 130px;
      object-fit: cover;
      border-radius: 50%;
      border: 3px solid #007bff;
    }

    .personnel-card {
      display: flex;
      align-items: flex-start;
      background-color: #f8f9fa;
      padding: 15px;
      border-radius: 10px;
      margin-bottom: 15px;
      box-shadow: 0 2px 6px rgba(0,0,0,0.05);
    }

    .personnel-card img {
      width: 80px;
      height: 80px;
      border-radius: 50%;
      margin-right: 15px;
    }

    .personnel-card h5 {
      margin: 0 0 6px;
      font-size: 17px;
      color: #333;
    }

    .personnel-card p {
      margin: 2px 0;
      font-size: 14px;
      color: #555;
    }

    .capitalize-first-letter {
      text-transform: capitalize;
    }
  </style>
</head>
<body>

<div class="container container-custom">
  <div class="row">

    <!-- Admin Profile -->
    <div class="col-md-5 mb-4">
      <div class="card">
        <div class="card-header bg-primary text-white text-center">
          <h5 class="mb-0">Admin Profile</h5>
        </div>
        <div class="card-body text-center">
          <?php if (!empty($admin['image_path'])): ?>
            <img src="<?php echo $admin['image_path']; ?>" alt="Admin Image" class="profile-img mb-3">
          <?php else: ?>
            <img src="assets/default-profile.png" alt="Default Image" class="profile-img mb-3">
          <?php endif; ?>

          <h5 class="card-title">
            <?php echo $admin['fname'] . ' ' . $admin['mname'] . ' ' . $admin['lname']; ?>
          </h5>
          <p class="mb-1" style="color: black;"><strong>Department: </strong>Agriculture Fisheries<p>
          <p class="mb-1" style="color: black;"><strong>Role:</strong> <?php echo $admin['department_role']; ?></p>
          <p class="mb-1" style="color: black;"><strong>Email:</strong> <?php echo $admin['gmail']; ?></p>
          <p class="mb-1" style="color: black;"><strong>Phone:</strong> <?php echo $admin['phone_number']; ?></p>

          <button class="btn btn-outline-primary mt-3" data-toggle="modal" data-target="#editProfileModal">
            Edit Profile
          </button>
        </div>
      </div>
    </div>

    <!-- Fisheries Personnel -->
    <div class="col-md-7 mb-4">
    <div class="card">
      <div class="card-header bg-primary text-white text-center">
        <h5 class="mb-0">Fisheries Personnel</h5>
      </div>
      <div class="card-body">
        <?php foreach ($personnel as $person): ?>
          <div class="personnel-card">
            <img src="<?php echo !empty($person['image_path']) ? $person['image_path'] : 'assets/default-profile.png'; ?>" alt="Profile">
            <div>
              <h5><?php echo $person['fname'] . ' ' . $person['mname'] . ' ' . $person['lname']; ?></h5>
              <p><strong>Email:</strong> <?php echo $person['gmail']; ?></p>
              <p><strong>Department:</strong> Fisheries</p>
              <p><strong>Role:</strong> <?php echo $person['department_role']; ?></p>
            </div>
          </div>
        <?php endforeach; ?>

        <div class="text-center mt-3">
          <button class="btn btn-primary" data-toggle="modal" data-target="#addMemberModal">
            Add Personnel
          </button>
        </div>
      </div>
    </div>
  </div>


<!-- Edit Profile Modal -->
<div class="modal fade" id="editProfileModal" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <!-- FORM dapat nasa labas ng .modal-content -->
    <form id="editProfileForm" method="POST" action="functions/update-func/edit-admin.php" enctype="multipart/form-data">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Edit Profile</h5>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <div class="modal-body">
          <!-- Profile Photo -->
          <div class="form-row mb-3 text-center">
            <div class="col-md-12">
              <img id="previewImage"
                   src= <?php echo $admin['image_path'] ?? 'default.png'; ?>
                   alt="Profile Picture"
                   class="rounded-circle"
                   style="width: 120px; height: 120px; object-fit: cover; border:2px solid #ccc;">
              <div class="mt-2">
                <input type="file" name="photo" id="photoInput" accept="image/*" class="form-control-file">
              </div>
            </div>
          </div>

          <!-- Name Row -->
          <div class="form-row">
            <div class="form-group col-md-4">
              <label>First Name</label>
              <input type="text" class="form-control" name="fname" value="<?php echo $admin['fname']; ?>">
            </div>
            <div class="form-group col-md-4">
              <label>Middle Name</label>
              <input type="text" class="form-control" name="mname" value="<?php echo $admin['mname']; ?>">
            </div>
            <div class="form-group col-md-4">
              <label>Last Name</label>
              <input type="text" class="form-control" name="lname" value="<?php echo $admin['lname']; ?>">
            </div>
          </div>

          <!-- Gmail + Role Row -->
          <div class="form-row">
            <div class="form-group col-md-6">
              <label>Gmail</label>
              <input type="email" class="form-control" name="gmail" value="<?php echo $admin['gmail']; ?>">
            </div>
            <div class="form-group col-md-6">
              <label>Role</label>
              <input type="text" class="form-control" name="role" value="<?php echo $admin['department_role']; ?>">
            </div>
          </div>
        </div>

        <div class="modal-footer">
          <input type="hidden" name="admin_id" value="<?php echo $admin['admin_id']; ?>">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary">Save Changes</button>
        </div>
      </div>
    </form>
  </div>
</div>





<!-- Add Personnel Modal -->
<div class="modal fade" id="addMemberModal" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-md" role="document">
    <form class="modal-content" action="functions/add-func/add-admin.php" method="POST" enctype="multipart/form-data" autocomplete="off">
      <input type="email" name="fake_email" style="display:none">
      <input type="password" name="fake_password" style="display:none">

      <div class="modal-header">
        <h5 class="modal-title">Add Personnel</h5>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <div class="modal-body">
        <!-- Profile Photo Preview -->
        <div class="form-group text-center">
          <img id="addPreviewImage" src="uploads/default.png" alt="Profile Preview" class="rounded-circle" style="width:120px; height:120px; object-fit:cover; border:2px solid #ccc;">
          <div class="mt-2">
            <input type="file" name="image" class="form-control-file" accept="image/*" id="addPhotoInput">
          </div>
        </div>

        <div class="form-group">
          <label>First Name</label>
          <input type="text" name="first_name" class="form-control capitalize-first-letter" required>
        </div>
        <div class="form-group">
          <label>Middle Name</label>
          <input type="text" name="middle_name" class="form-control capitalize-first-letter">
        </div>
        <div class="form-group">
          <label>Last Name</label>
          <input type="text" name="last_name" class="form-control capitalize-first-letter" required>
        </div>
        <div class="form-group">
          <label>Phone Number</label>
          <input type="text" name="phone_number" class="form-control" required>
        </div>
        <div class="form-group">
          <label>Email Address</label>
          <input type="email" name="email" class="form-control" autocomplete="new-email" value="">
        </div>
        <div class="form-group">
          <label>Department Role</label>
          <input type="text" name="department_role" class="form-control capitalize-first-letter" required>
        </div>
        <div class="form-group">
          <label>Password</label>
          <input type="password" name="password" class="form-control" autocomplete="new-password" required>
        </div>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-primary">Add Member</button>
      </div>
    </form>
  </div>
</div>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="vendor/bootstrap-4.1/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.6.2/js/bootstrap.min.js"></script>

<script>
  $('#addMemberModal').on('show.bs.modal', function () {
    $(this).find('input[type="text"], input[type="email"], input[type="password"]').val('');
    $(this).find('input[type="file"]').val('');
  });
  document.querySelectorAll('.capitalize-first-letter').forEach(input => {
    input.addEventListener('input', function () {
      this.value = this.value.toLowerCase().replace(/\b\w/g, c => c.toUpperCase());
    });
  });
  document.getElementById("photoInput").addEventListener("change", function(e) {
  const file = e.target.files[0];
  if (file) {
    const reader = new FileReader();
    reader.onload = function(event) {
      document.getElementById("previewImage").src = event.target.result;
    };
    reader.readAsDataURL(file);
  }
  });
  document.getElementById('addPhotoInput').addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (file) {
      const reader = new FileReader();
      reader.onload = function(event) {
        document.getElementById('addPreviewImage').src = event.target.result;
      };
      reader.readAsDataURL(file);
    }
  });
</script>

</body>
</html>