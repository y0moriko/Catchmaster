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
    <style>
        :root {
            --primary: #4f46e5;
            --secondary: #06b6d4;
            --success: #10b981;
            --warning: #f59e0b;
            --danger: #ef4444;
            --dark: #1f2937;
            --light: #f8fafc;
            --gray: #64748b;
            --border-radius: 12px;
            --shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
        }

        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            font-family: 'Inter', sans-serif;
            min-height: 100vh;
            color: var(--dark);
        }

        .main-container {
            padding: 120px 20px 60px;
            max-width: 1400px;
            margin: 0 auto;
        }

        .card-modern {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-radius: var(--border-radius);
            box-shadow: var(--shadow);
            border: 1px solid rgba(255, 255, 255, 0.2);
            overflow: hidden;
            transition: transform 0.3s ease;
        }

        .card-modern:hover {
            transform: translateY(-2px);
        }

        .card-header-gradient {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
            padding: 24px;
        }

        .card-header-gradient h5 {
            margin: 0;
            font-weight: 700;
            font-size: 1.25rem;
        }

        /* Profile Section */
        .profile-container {
            padding: 40px;
            text-align: center;
        }

        .profile-image-wrapper {
            position: relative;
            display: inline-block;
            margin-bottom: 24px;
        }

        .profile-image {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            object-fit: cover;
            border: 4px solid white;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        .status-indicator {
            position: absolute;
            bottom: 8px;
            right: 8px;
            width: 20px;
            height: 20px;
            background: var(--success);
            border-radius: 50%;
            border: 3px solid white;
        }

        .profile-name {
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 24px;
            color: var(--dark);
        }

        .info-grid {
            display: grid;
            gap: 12px;
            text-align: left;
            margin-bottom: 24px;
        }

        .info-item {
            display: flex;
            align-items: center;
            padding: 12px 16px;
            background: var(--light);
            border-radius: 8px;
            transition: background-color 0.2s ease;
        }

        .info-item:hover {
            background: #e2e8f0;
        }

        .info-item i {
            width: 20px;
            margin-right: 12px;
            color: var(--primary);
        }

        .info-label {
            font-weight: 600;
            color: var(--gray);
            margin-right: 8px;
        }

        .info-value {
            color: var(--dark);
            font-weight: 500;
        }

        /* Personnel Section */
        .personnel-container {
            padding: 24px;
        }

        .personnel-header {
            display: flex;
            justify-content: between;
            align-items: center;
            margin-bottom: 20px;
        }

        .personnel-grid {
            display: grid;
            gap: 16px;
        }

        .personnel-card {
            background: white;
            border-radius: 12px;
            padding: 20px;
            border: 1px solid #e2e8f0;
            transition: all 0.3s ease;
            position: relative;
        }

        .personnel-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
        }

        .personnel-content {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .personnel-avatar {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid var(--light);
            flex-shrink: 0;
        }

        .personnel-info {
            flex-grow: 1;
        }

        .personnel-info h6 {
            margin: 0 0 8px 0;
            font-weight: 600;
            color: var(--dark);
        }

        .personnel-detail {
            display: flex;
            align-items: center;
            margin: 4px 0;
            font-size: 0.875rem;
            color: var(--gray);
        }

        .personnel-detail i {
            width: 14px;
            margin-right: 8px;
            color: var(--primary);
        }

        .action-buttons {
            display: flex;
            gap: 8px;
            flex-shrink: 0;
        }

        /* Buttons */
        .btn-modern {
            padding: 10px 20px;
            border-radius: 8px;
            border: none;
            font-weight: 500;
            transition: all 0.2s ease;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            text-decoration: none;
        }

        .btn-primary-modern {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
        }

        .btn-primary-modern:hover {
            transform: translateY(-1px);
            color: white;
            text-decoration: none;
        }

        .btn-action {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            transition: transform 0.2s ease;
        }

        .btn-edit { background: var(--warning); }
        .btn-delete { background: var(--danger); }

        .btn-action:hover {
            transform: scale(1.1);
            color: white;
            text-decoration: none;
        }

        /* Modal Styles */
        .modal-content-modern {
            border-radius: var(--border-radius);
            border: none;
            overflow: hidden;
        }

        .modal-header-modern {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
            padding: 20px 24px;
            border: none;
        }

        .modal-header-modern .modal-title {
            font-weight: 700;
            margin: 0;
        }

        .modal-header-modern .close {
            color: white;
            opacity: 0.8;
            font-size: 1.5rem;
            border: none;
            background: none;
        }

        .form-group-modern {
            margin-bottom: 20px;
        }

        .form-group-modern label {
            font-weight: 600;
            color: var(--dark);
            margin-bottom: 8px;
            display: block;
        }

        .form-control-modern {
            border: 2px solid #e2e8f0;
            border-radius: 8px;
            padding: 12px 16px;
            transition: border-color 0.2s ease;
        }

        .form-control-modern:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1);
            outline: none;
        }

        .photo-preview-container {
            text-align: center;
            margin-bottom: 24px;
        }

        .photo-preview {
            position: relative;
            display: inline-block;
        }

        .photo-preview img {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid var(--light);
        }

        .photo-overlay {
            position: absolute;
            inset: 0;
            background: rgba(0, 0, 0, 0.5);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: opacity 0.3s ease;
            cursor: pointer;
        }

        .photo-preview:hover .photo-overlay {
            opacity: 1;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .main-container {
                padding: 100px 15px 40px;
            }

            .profile-container {
                padding: 24px;
            }

            .personnel-content {
                flex-direction: column;
                text-align: center;
            }

            .action-buttons {
                justify-content: center;
                margin-top: 16px;
            }

            .personnel-header {
                flex-direction: column;
                gap: 16px;
            }
        }
    </style>
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
                                                <button class="btn btn-action btn-edit edit-personnel-btn" 
                                                        data-id="<?= $person['admin_id'] ?>" 
                                                        title="Edit Personnel">
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
            <form method="POST" action="functions/update-func/edit-admin.php" enctype="multipart/form-data">
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