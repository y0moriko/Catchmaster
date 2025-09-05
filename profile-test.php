<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    $_SESSION['error'] = "Please log in first.";
    header("Location: login.php");
    exit();
}

// Include required files
include 'functions/fetch-func/fetch-admin.php';
include 'header.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Profile & Fisheries Personnel</title>
    
    <!-- External CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Custom CSS -->
    <link href="css/header.css" rel="stylesheet">
    <link href="css/profile.css" rel="stylesheet">

</head>
<body>
    <div class="main-container">
        <div class="row">
            <!-- Admin Profile Card -->
            <div class="col-lg-5 mb-4">
                <div class="card-modern">
                    <div class="card-header-gradient">
                        <h5><i class="fas fa-user-shield me-2"></i> Admin Profile</h5>
                    </div>
                    <div class="profile-container">
                        <div class="profile-image-wrapper">
                            <img src="<?= !empty($admin['image_path']) ? htmlspecialchars($admin['image_path']) : 'assets/default-profile.png' ?>" 
                                 alt="Admin Profile" class="profile-image">
                            <div class="status-indicator"></div>
                        </div>

                        <h4 class="profile-name">
                            <?= htmlspecialchars($admin['fname'] . ' ' . $admin['mname'] . ' ' . $admin['lname']) ?>
                        </h4>

                        <div class="info-grid">
                            <div class="info-item">
                                <i class="fas fa-building"></i>
                                <span class="info-label">Department:</span>
                                <span class="info-value">Agriculture Fisheries</span>
                            </div>
                            <div class="info-item">
                                <i class="fas fa-user-tag"></i>
                                <span class="info-label">Role:</span>
                                <span class="info-value"><?= htmlspecialchars($admin['department_role']) ?></span>
                            </div>
                            <div class="info-item">
                                <i class="fas fa-envelope"></i>
                                <span class="info-label">Email:</span>
                                <span class="info-value"><?= htmlspecialchars($admin['gmail']) ?></span>
                            </div>
                            <div class="info-item">
                                <i class="fas fa-phone"></i>
                                <span class="info-label">Phone:</span>
                                <span class="info-value"><?= htmlspecialchars($admin['phone_number']) ?></span>
                            </div>
                        </div>

                        <button class="btn btn-modern btn-primary-modern" data-toggle="modal" data-target="#editProfileModal">
                            <i class="fas fa-edit"></i>
                            Edit Profile
                        </button>
                    </div>
                </div>
            </div>

            <!-- Personnel Management Card -->
            <div class="col-lg-7 mb-4">
                <div class="card-modern">
                    <div class="card-header-gradient">
                        <div class="personnel-header">
                            <h5><i class="fas fa-users me-2"></i> Fisheries Personnel</h5>
                            <button class="btn btn-modern btn-primary-modern" data-toggle="modal" data-target="#addPersonnelModal">
                                <i class="fas fa-user-plus"></i>
                                Add Personnel
                            </button>
                        </div>
                    </div>
                    <div class="personnel-container">
                        <div class="personnel-grid">
                            <?php if (!empty($personnel)): ?>
                                <?php foreach ($personnel as $person): ?>
                                    <div class="personnel-card">
                                        <div class="personnel-content">
                                            <img src="<?= !empty($person['image_path']) ? htmlspecialchars($person['image_path']) : 'assets/default-profile.png' ?>" 
                                                 alt="Personnel" class="personnel-avatar">
                                            
                                            <div class="personnel-info">
                                                <h6><?= htmlspecialchars($person['fname'] . ' ' . $person['mname'] . ' ' . $person['lname']) ?></h6>
                                                <div class="personnel-detail">
                                                    <i class="fas fa-envelope"></i>
                                                    <?= htmlspecialchars($person['gmail']) ?>
                                                </div>
                                                <div class="personnel-detail">
                                                    <i class="fas fa-user-tag"></i>
                                                    <?= htmlspecialchars($person['department_role']) ?>
                                                </div>
                                            </div>

                                            <div class="action-buttons">
                                                <button class="btn btn-action btn-edit edit-personnel-btn" data-id="<?= $person['admin_id'] ?>">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <a href="functions/delete-func/delete-admin.php?admin_id=<?= $person['admin_id'] ?>" 
                                                   class="btn btn-action btn-delete"
                                                   onclick="return confirm('Are you sure you want to delete this personnel?');" 
                                                   title="Delete Personnel">
                                                    <i class="fas fa-trash"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <div class="text-center py-4">
                                    <i class="fas fa-users fa-3x text-muted mb-3"></i>
                                    <p class="text-muted">No personnel found. Add your first team member!</p>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Profile Modal -->
    <div class="modal fade" id="editProfileModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <form method="POST" action="functions/update-func/update-admin.php" enctype="multipart/form-data">
                <div class="modal-content modal-content-modern">
                    <div class="modal-header modal-header-modern">
                        <h5 class="modal-title"><i class="fas fa-user-edit me-2"></i>Edit Profile</h5>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <div class="modal-body" style="padding: 32px;">
                        <div class="photo-preview-container">
                            <div class="photo-preview">
                                <img id="editPreviewImage"
                                     src="<?= $admin['image_path'] ?? 'assets/default-profile.png' ?>" 
                                     alt="Profile Preview">
                                <div class="photo-overlay">
                                    <i class="fas fa-camera" style="color: white; font-size: 1.2rem;"></i>
                                </div>
                            </div>
                            <input type="file" name="photo" id="editPhotoInput" accept="image/*" class="form-control form-control-modern mt-3">
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group-modern">
                                    <label>First Name</label>
                                    <input type="text" class="form-control form-control-modern" name="fname" 
                                           value="<?= htmlspecialchars($admin['fname']) ?>" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group-modern">
                                    <label>Middle Name</label>
                                    <input type="text" class="form-control form-control-modern" name="mname" 
                                           value="<?= htmlspecialchars($admin['mname']) ?>">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group-modern">
                                    <label>Last Name</label>
                                    <input type="text" class="form-control form-control-modern" name="lname" 
                                           value="<?= htmlspecialchars($admin['lname']) ?>" required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group-modern">
                                    <label>Email Address</label>
                                    <input type="email" class="form-control form-control-modern" name="gmail" 
                                           value="<?= htmlspecialchars($admin['gmail']) ?>" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group-modern">
                                    <label>Phone Number</label>
                                    <input type="tel" class="form-control form-control-modern" name="phone_number" 
                                           value="<?= htmlspecialchars($admin['phone_number']) ?>">
                                </div>
                            </div>
                        </div>

                        <div class="form-group-modern">
                            <label>Department Role</label>
                            <input type="text" class="form-control form-control-modern" name="role" 
                                   value="<?= htmlspecialchars($admin['department_role']) ?>" required>
                        </div>
                    </div>

                    <div class="modal-footer" style="padding: 24px; border-top: 1px solid #e2e8f0;">
                        <input type="hidden" name="admin_id" value="<?= $admin['admin_id'] ?>">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-modern btn-primary-modern">
                            <i class="fas fa-save"></i>
                            Save Changes
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Add Personnel Modal -->
    <div class="modal fade" id="addPersonnelModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <form class="modal-content modal-content-modern" action="functions/add-func/add-admin.php" method="POST" enctype="multipart/form-data">
                <div class="modal-header modal-header-modern">
                    <h5 class="modal-title"><i class="fas fa-user-plus me-2"></i>Add New Personnel</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <div class="modal-body" style="padding: 32px;">
                    <div class="photo-preview-container">
                        <div class="photo-preview">
                            <img id="addPreviewImage" src="assets/default-profile.png" alt="Profile Preview">
                            <div class="photo-overlay">
                                <i class="fas fa-camera" style="color: white; font-size: 1.2rem;"></i>
                            </div>
                        </div>
                        <input type="file" name="image" id="addPhotoInput" accept="image/*" class="form-control form-control-modern mt-3">
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group-modern">
                                <label>First Name</label>
                                <input type="text" name="first_name" class="form-control form-control-modern" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group-modern">
                                <label>Middle Name</label>
                                <input type="text" name="middle_name" class="form-control form-control-modern">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group-modern">
                                <label>Last Name</label>
                                <input type="text" name="last_name" class="form-control form-control-modern" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group-modern">
                                <label>Phone Number</label>
                                <input type="tel" name="phone_number" class="form-control form-control-modern" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group-modern">
                                <label>Email Address</label>
                                <input type="email" name="email" class="form-control form-control-modern" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group-modern">
                                <label>Department Role</label>
                                <input type="text" name="department_role" class="form-control form-control-modern" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group-modern">
                                <label>Password</label>
                                <input type="password" name="password" class="form-control form-control-modern" required>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer" style="padding: 24px; border-top: 1px solid #e2e8f0;">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-modern btn-primary-modern">
                        <i class="fas fa-user-plus"></i>
                        Add Personnel
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Edit Personnel Modal -->
    <div class="modal fade" id="editPersonnelModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content modal-content-modern">
                <div class="modal-header modal-header-modern">
                    <h5 class="modal-title"><i class="fas fa-user-edit me-2"></i>Edit Personnel</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body" id="editPersonnelContent">
                    <div class="text-center py-4">
                        <i class="fas fa-spinner fa-spin fa-2x text-primary"></i>
                        <p class="mt-2">Loading...</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        $(document).ready(function() {
            // Initialize tooltips
            $('[title]').tooltip();

            // Reset add personnel modal on show
            $('#addPersonnelModal').on('show.bs.modal', function() {
                $(this).find('input[type="text"], input[type="email"], input[type="password"], input[type="tel"]').val('');
                $(this).find('input[type="file"]').val('');
                $('#addPreviewImage').attr('src', 'assets/default-profile.png');
            });

            // Image preview for edit profile
            $('#editPhotoInput').on('change', function(e) {
                const file = e.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(event) {
                        $('#editPreviewImage').attr('src', event.target.result);
                    };
                    reader.readAsDataURL(file);
                }
            });

            // Image preview for add personnel
            $('#addPhotoInput').on('change', function(e) {
                const file = e.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(event) {
                        $('#addPreviewImage').attr('src', event.target.result);
                    };
                    reader.readAsDataURL(file);
                }
            });

            // Edit personnel functionality
            $('.edit-personnel-btn').on('click', function(e) {
                e.preventDefault();
                const adminId = $(this).data('id');

                $.ajax({
                    url: 'forms/edit-personnel.php',
                    type: 'GET',
                    data: { id: adminId },
                    beforeSend: function() {
                        $('#editPersonnelContent').html(`
                            <div class="text-center py-4">
                                <i class="fas fa-spinner fa-spin fa-2x text-primary"></i>
                                <p class="mt-2">Loading...</p>
                            </div>
                        `);
                    },
                    success: function(response) {
                        $('#editPersonnelContent').html(response);
                        $('#editPersonnelModal').modal('show');
                    },
                    error: function() {
                        $('#editPersonnelContent').html(`
                            <div class="text-center py-4">
                                <i class="fas fa-exclamation-triangle fa-2x text-danger"></i>
                                <p class="mt-2 text-danger">Failed to load form. Please try again.</p>
                            </div>
                        `);
                        $('#editPersonnelModal').modal('show');
                    }
                });
            });

            // Form validation
            $('form').on('submit', function() {
                const requiredFields = $(this).find('[required]');
                let isValid = true;

                requiredFields.each(function() {
                    if (!$(this).val().trim()) {
                        isValid = false;
                        $(this).addClass('is-invalid');
                    } else {
                        $(this).removeClass('is-invalid');
                    }
                });

                if (!isValid) {
                    alert('Please fill in all required fields.');
                    return false;
                }
            });

            // Remove validation styling on input
            $('input').on('input', function() {
                $(this).removeClass('is-invalid');
            });
        });
    </script>
</body>
</html>