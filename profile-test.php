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
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
  <link href="css/header.css" rel="stylesheet">
  <link href="css/profile.css" rel="stylesheet">

</head>
<body>

<div class="container container-custom">
  <div class="row">

    <!-- Admin Profile -->
    <div class="col-lg-5 mb-4">
      <div class="modern-card">
        <div class="card-header-modern">
          <h5 style="color: white;"><i class="fas fa-user-shield me-2" style="color: white;"></i> Admin Profile</h5>
        </div>
        <div class="profile-section">
          <div class="profile-img-container">
            <?php if (!empty($admin['image_path'])): ?>
              <img src="<?php echo $admin['image_path']; ?>" alt="Admin Image" class="profile-img">
            <?php else: ?>
              <img src="assets/default-profile.png" alt="Default Image" class="profile-img">
            <?php endif; ?>
            <div class="profile-status"></div>
          </div>

          <h4 class="profile-name">
            <?php echo $admin['fname'] . ' ' . $admin['mname'] . ' ' . $admin['lname']; ?>
          </h4>

          <div class="profile-info">
            <div class="info-item">
              <i class="fas fa-building"></i>
              <span class="info-label">Department:</span>
              <span class="info-value">Agriculture Fisheries</span>
            </div>
            <div class="info-item">
              <i class="fas fa-user-tag"></i>
              <span class="info-label">Role:</span>
              <span class="info-value"><?php echo $admin['department_role']; ?></span>
            </div>
            <div class="info-item">
              <i class="fas fa-envelope"></i>
              <span class="info-label">Email:</span>
              <span class="info-value"><?php echo $admin['gmail']; ?></span>
            </div>
            <div class="info-item">
              <i class="fas fa-phone"></i>
              <span class="info-label">Phone:</span>
              <span class="info-value"><?php echo $admin['phone_number']; ?></span>
            </div>
          </div>

          <button class="btn btn-modern btn-primary-modern mt-4" data-toggle="modal" data-target="#editProfileModal">
            <i class="fas fa-edit"></i>
            Edit Profile
          </button>
        </div>
      </div>
    </div>

    <!-- Fisheries Personnel -->
    <div class="col-lg-7 mb-4">
      <div class="modern-card">
        <div class="card-header-modern">
          <div class="d-flex justify-content-between align-items-center">
            <h5 class="mb-0" style="color: white;"><i class="fas fa-users me-2" style="color: white;"></i> Fisheries Personnel</h5>
            <button class="btn btn-modern btn-primary-modern" data-toggle="modal" data-target="#addMemberModal" style="background: rgba(255,255,255,0.2); border: 1px solid rgba(255,255,255,0.3);">
              <i class="fas fa-user-plus"></i>
              Add Personnel
            </button>
          </div>
        </div>
        <div class="personnel-grid">
          <?php foreach ($personnel as $person): ?>
            <div class="personnel-card">
              <div class="personnel-content">
                <img src="<?php echo !empty($person['image_path']) ? $person['image_path'] : 'assets/default-profile.png'; ?>" alt="Profile" class="personnel-avatar">
                
                <div class="personnel-info flex-grow-1">
                  <h5><?php echo $person['fname'] . ' ' . $person['mname'] . ' ' . $person['lname']; ?></h5>
                  <div class="personnel-detail">
                    <i class="fas fa-envelope"></i>
                    <?php echo $person['gmail']; ?>
                  </div>
                  <div class="personnel-detail">
                    <i class="fas fa-building"></i>
                    Fisheries Department
                  </div>
                  <div class="personnel-detail">
                    <i class="fas fa-user-tag"></i>
                    <?php echo $person['department_role']; ?>
                  </div>
                </div>

                <div class="action-buttons">
                  <a href="#" class="btn btn-modern btn-edit edit-personnel-btn" data-id="<?php echo $person['admin_id']; ?>" data-toggle="tooltip" title="Edit Personnel">
                    <i class="fas fa-edit"></i>
                  </a>
                  <a href="functions/delete-func/delete-personnel.php?admin_id=<?php echo $person['admin_id']; ?>" class="btn btn-modern btn-delete" onclick="return confirm('Are you sure you want to delete this personnel?');" data-toggle="tooltip" title="Delete Personnel">
                    <i class="fas fa-trash"></i>
                  </a>
                </div>
              </div>
            </div>
          <?php endforeach; ?>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Edit Profile Modal -->
<div class="modal fade" id="editProfileModal" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <form id="editProfileForm" method="POST" action="functions/update-func/edit-admin.php" enctype="multipart/form-data">
      <div class="modal-content modal-content-modern">
        <div class="modal-header modal-header-modern">
          <h5 class="modal-title"><i class="fas fa-user-edit me-2"></i>Edit Profile</h5>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <div class="modal-body" style="padding: 32px;">
          <!-- Profile Photo -->
          <div class="form-group-modern text-center">
            <div class="photo-preview">
              <img id="previewImage"
                   src="<?php echo $admin['image_path'] ?? 'default.png'; ?>"
                   alt="Profile Picture">
              <div class="photo-upload-overlay">
                <i class="fas fa-camera" style="color: white; font-size: 1.5rem;"></i>
              </div>
            </div>
            <div class="mt-3">
              <input type="file" name="photo" id="photoInput" accept="image/*" class="form-control-modern">
            </div>
          </div>

          <!-- Name Row -->
          <div class="row">
            <div class="col-md-4">
              <div class="form-group-modern">
                <label>First Name</label>
                <input type="text" class="form-control form-control-modern" name="fname" value="<?php echo $admin['fname']; ?>">
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group-modern">
                <label>Middle Name</label>
                <input type="text" class="form-control form-control-modern" name="mname" value="<?php echo $admin['mname']; ?>">
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group-modern">
                <label>Last Name</label>
                <input type="text" class="form-control form-control-modern" name="lname" value="<?php echo $admin['lname']; ?>">
              </div>
            </div>
          </div>

          <!-- Gmail + Role Row -->
          <div class="row">
            <div class="col-md-6">
              <div class="form-group-modern">
                <label>Email Address</label>
                <input type="email" class="form-control form-control-modern" name="gmail" value="<?php echo $admin['gmail']; ?>">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group-modern">
                <label>Department Role</label>
                <input type="text" class="form-control form-control-modern" name="role" value="<?php echo $admin['department_role']; ?>">
              </div>
            </div>
          </div>
        </div>

        <div class="modal-footer" style="padding: 24px; border-top: 1px solid #e2e8f0;">
          <input type="hidden" name="admin_id" value="<?php echo $admin['admin_id']; ?>">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-modern btn-primary-modern">
            <i class="fas fa-save me-1"></i>
            Save Changes
          </button>
        </div>
      </div>
    </form>
  </div>
</div>

<!-- Add Personnel Modal -->
<div class="modal fade" id="addMemberModal" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <form class="modal-content modal-content-modern" action="functions/add-func/add-admin.php" method="POST" enctype="multipart/form-data" autocomplete="off">
      <input type="email" name="fake_email" style="display:none">
      <input type="password" name="fake_password" style="display:none">

      <div class="modal-header modal-header-modern">
        <h5 class="modal-title"><i class="fas fa-user-plus me-2"></i>Add New Personnel</h5>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <div class="modal-body" style="padding: 32px;">
        <!-- Profile Photo Preview -->
        <div class="form-group-modern text-center">
          <div class="photo-preview">
            <img id="addPreviewImage" src="uploads/default.png" alt="Profile Preview">
            <div class="photo-upload-overlay">
              <i class="fas fa-camera" style="color: white; font-size: 1.5rem;"></i>
            </div>
          </div>
          <div class="mt-3">
            <input type="file" name="image" class="form-control form-control-modern" accept="image/*" id="addPhotoInput">
          </div>
        </div>

        <div class="row">
          <div class="col-md-4">
            <div class="form-group-modern">
              <label>First Name</label>
              <input type="text" name="first_name" class="form-control form-control-modern capitalize-first-letter" required>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group-modern">
              <label>Middle Name</label>
              <input type="text" name="middle_name" class="form-control form-control-modern capitalize-first-letter">
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group-modern">
              <label>Last Name</label>
              <input type="text" name="last_name" class="form-control form-control-modern capitalize-first-letter" required>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-6">
            <div class="form-group-modern">
              <label>Phone Number</label>
              <input type="text" name="phone_number" class="form-control form-control-modern" required>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group-modern">
              <label>Email Address</label>
              <input type="email" name="email" class="form-control form-control-modern" autocomplete="new-email" required>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-6">
            <div class="form-group-modern">
              <label>Department Role</label>
              <input type="text" name="department_role" class="form-control form-control-modern capitalize-first-letter" required>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group-modern">
              <label>Password</label>
              <input type="password" name="password" class="form-control form-control-modern" autocomplete="new-password" required>
            </div>
          </div>
        </div>
      </div>

      <div class="modal-footer" style="padding: 24px; border-top: 1px solid #e2e8f0;">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-modern btn-primary-modern">
          <i class="fas fa-user-plus me-1"></i>
          Add Personnel
        </button>
      </div>
    </form>
  </div>
</div>

<!-- Edit Personnel Modal -->
<div class="modal fade" id="editPersonnelModal" tabindex="-1" role="dialog" aria-labelledby="editPersonnelLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content modal-content-modern">
      <div class="modal-header modal-header-modern">
        <h5 class="modal-title" id="editPersonnelLabel"><i class="fas fa-user-edit me-2"></i>Edit Personnel</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="editPersonnelContent">
        <!-- Form will be loaded here -->
      </div>
    </div>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="vendor/bootstrap-4.1/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.6.2/js/bootstrap.min.js"></script>

<script>
$(function () {
  $('[data-toggle="tooltip"]').tooltip();
});

$('#addMemberModal').on('show.bs.modal', function () {
  $(this).find('input[type="text"], input[type="email"], input[type="password"]').val('');
  $(this).find('input[type="file"]').val('');
  $('#addPreviewImage').attr('src', 'uploads/default.png');
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

$(document).ready(function() {
  $('.edit-personnel-btn').on('click', function(e) {
    e.preventDefault();
    const adminId = $(this).data('id');

    $.ajax({
      url: 'forms/edit-personnel.php',
      type: 'GET',
      data: { id: adminId },
      success: function(response) {
        $('#editPersonnelContent').html(response);
        $('#editPersonnelModal').modal('show');
      },
      error: function() {
        $('#editPersonnelContent').html('<p class="text-danger">Failed to load form.</p>');
        $('#editPersonnelModal').modal('show');
      }
    });
  });
});
</script>

</body>
</html>