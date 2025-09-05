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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fishermen Directory - CatchMaster</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="css/fishermen.css" rel="stylesheet">
    <link href="css/header.css" rel="stylesheet">

</head>
<body>
    <?php include 'header.php'?>
    <!-- Modern Breadcrumb -->
    <div class="modern-container">
        <div class="modern-breadcrumb">
            <div class="breadcrumb-content">
                <nav class="breadcrumb-nav">
                    <span>You are here:</span>
                    <a href="index.php">Home</a>
                    <span>/</span>
                    <span>Fishermen Directory</span>
                </nav>
            </div>
        </div>

        <!-- Page Header -->
        <div class="page-header">
            <h1 class="page-title">Fishermen Management</h1>
        </div>

        <!-- Modern Table Card -->
        <div class="table-card">
            <div class="table-header">
                <h3 class="table-title">Registered Fishermen</h3>
                <div class="table-controls">
                    <div class="table-filters">
                        <select class="filter-select">
                            <option selected>All Locations</option>
                            <option value="Binagbag">Binagbag</option>
                            <option value="Kanlurang Calutan">Kanlurang Calutan</option>
                            <option value="Silangang Calutan">Silangang Calutan</option>
                            <option value="Salvacion">Salvacion</option>
                            <option value="Sildora">Sildora</option>
                        </select>
                        <select class="filter-select">
                            <option selected>All Ages</option>
                            <option value="18-30">18-30 years</option>
                            <option value="31-50">31-50 years</option>
                            <option value="51+">51+ years</option>
                        </select>
                        <button class="filter-btn">
                            <i class="fas fa-filter"></i>
                            Apply Filters
                        </button>
                    </div>
                    <div class="table-actions">
                        <button class="action-button btn-add" onclick="showModal()">
                            <i class="fas fa-user-plus"></i>
                            Add Fisherman
                        </button>
                        <button class="action-button btn-upload" onclick="document.getElementById('excel_file').click();">
                            <i class="fas fa-upload"></i>
                            Upload Excel
                        </button>
                        <input type="file" id="excel_file" accept=".xlsx" style="display: none;">
                    </div>
                </div>
            </div>
            <div class="table-responsive">
                <table class="modern-table">
                    <thead>
                        <tr>
                            <th>
                                <input type="checkbox" class="custom-checkbox">
                            </th>
                            <th>Profile</th>
                            <th>Full Name</th>
                            <th>Contact Info</th>
                            <th>Location</th>
                            <th>Age</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Sample data rows -->
                        <?php include 'functions/fetch-func/fetch-fishermen.php'?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

<!-- Add Fisherman Modal -->
<div id="add-fisherman-modal" class="custom-modal">
    <div class="custom-modal-content">
        <span class="close" onclick="closeModal('add-fisherman-modal')">&times;</span>
        <h3 class="modal-title"><i class="fas fa-user-plus"></i> Add Fisherman</h3>
        <form action="functions/add-func/add-fishermen.php" method="post" enctype="multipart/form-data" novalidate>
            <div class="modal-body">
                <div class="row">
                    <!-- Profile Image -->
                    <div class="col-md-4 text-center">
                        <label for="image" class="form-label">Profile Image</label>
                        <input type="file" class="form-control mb-2" id="image" name="image" accept="image/*" onchange="previewImage(event)">
                        <small class="text-muted d-block mb-2">Optional</small>
                        <img id="preview" src="#" alt="Image Preview" class="image-preview" style="display:none;">
                    </div>

                    <!-- Fisherman Details -->
                    <div class="col-md-8">
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label for="firstName" class="form-label">First Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="firstName" name="first_name" required placeholder="First Name">
                            </div>
                            <div class="col-md-4">
                                <label for="middleName" class="form-label">Middle Name</label>
                                <input type="text" class="form-control" id="middleName" name="middle_name" placeholder="Middle Name">
                            </div>
                            <div class="col-md-4">
                                <label for="lastName" class="form-label">Last Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="lastName" name="last_name" required placeholder="Last Name">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="contact" class="form-label">Contact Number <span class="text-danger">*</span></label>
                                <input type="tel" class="form-control" id="contact" name="contact" pattern="[0-9]{11}" required placeholder="09XXXXXXXXX">
                            </div>
                            <div class="col-md-6">
                                <label for="email" class="form-label">Email Address</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="example@email.com">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="birthday" class="form-label">Birthday <span class="text-danger">*</span></label>
                                <input type="date" class="form-control" id="birthday" name="birthday" required>
                            </div>
                            <div class="col-md-6">
                                <label for="address" class="form-label">Barangay <span class="text-danger">*</span></label>
                                <select class="form-control" id="address" name="address" required>
                                    <option value="" disabled selected>Select location</option>
                                    <option value="Binagbag">Binagbag</option>
                                    <option value="Kanlurang Calutan">Kanlurang Calutan</option>
                                    <option value="Silangang Calutan">Silangang Calutan</option>
                                    <option value="Salvacion">Salvacion</option>
                                    <option value="Sildora">Sildora</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="reset" class="btn btn-secondary" onclick="resetPreview()">Clear</button>
                <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Save Fisherman</button>
            </div>
        </form>
    </div>
</div>

<!-- Edit Fisherman Modal -->
<div id="edit-fisherman-modal" class="custom-modal">
    <div class="custom-modal-content">
        <span class="close" onclick="closeModal('edit-fisherman-modal')">&times;</span>
        <div id="edit-fisherman-content">
            <!-- Loaded dynamically via JS -->
        </div>
    </div>
</div>

<!-- Confirm Delete Modal -->
<div id="delete-confirm-modal" class="custom-modal">
    <div class="custom-modal-content">
        <span class="close" onclick="closeModal('delete-confirm-modal')">&times;</span>
        <h3><i class="fas fa-exclamation-triangle"></i> Confirm Deletion</h3>
        <p>Are you sure you want to delete this fisherman's record? This action cannot be undone.</p>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" onclick="closeModal('delete-confirm-modal')">Cancel</button>
            <button type="button" class="btn btn-danger" id="confirmDeleteBtn">Yes, Delete</button>
        </div>
    </div>
</div>

<!-- ---------------- SCRIPT ---------------- -->
<script>
// Show Add Modal
function showModal() {
    document.getElementById('add-fisherman-modal').style.display = 'flex';
}

// Show modal by ID
function showModalById(id) {
    document.getElementById(id).style.display = 'flex';
}

// Close modal
function closeModal(id) {
    document.getElementById(id).style.display = 'none';
}

// Image preview
function previewImage(event) {
    const preview = document.getElementById('preview');
    const file = event.target.files[0];
    if (file) {
        preview.src = URL.createObjectURL(file);
        preview.style.display = 'block';
    } else {
        preview.src = '#';
        preview.style.display = 'none';
    }
}

// Reset image preview
function resetPreview() {
    const preview = document.getElementById('preview');
    const imageInput = document.getElementById('image');
    preview.src = '#';
    preview.style.display = 'none';
    imageInput.value = '';
}

// Edit Fisherman modal load
function editFisherman(fishermanId) {
    fetch(`functions/fetch-func/fetch-single-fisherman.php?id=${fishermanId}`)
        .then(res => res.json())
        .then(data => {
            const container = document.getElementById('edit-fisherman-content');
            container.innerHTML = `
                <h3 class="modal-title"><i class="fas fa-user-edit"></i> Edit Fisherman</h3>
                <form action="functions/edit-func/edit-fishermen.php" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="fisherman_id" value="${data.user_id}">
                    <label>First Name</label>
                    <input type="text" name="first_name" value="${data.fname}" class="form-control" required>
                    <label>Middle Name</label>
                    <input type="text" name="middle_name" value="${data.mname}" class="form-control">
                    <label>Last Name</label>
                    <input type="text" name="last_name" value="${data.lname}" class="form-control" required>
                    <label>Phone Number</label>
                    <input type="text" name="contact" value="${data.phone_number}" class="form-control" required>
                    <label>Barangay</label>
                    <select name="address" class="form-control" required>
                        <option value="Binagbag" ${data.barangay=='Binagbag'?'selected':''}>Binagbag</option>
                        <option value="Kanlurang Calutan" ${data.barangay=='Kanlurang Calutan'?'selected':''}>Kanlurang Calutan</option>
                        <option value="Silangang Calutan" ${data.barangay=='Silangang Calutan'?'selected':''}>Silangang Calutan</option>
                        <option value="Salvacion" ${data.barangay=='Salvacion'?'selected':''}>Salvacion</option>
                        <option value="Sildora" ${data.barangay=='Sildora'?'selected':''}>Sildora</option>
                    </select>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" onclick="closeModal('edit-fisherman-modal')">Cancel</button>
                        <button type="submit" class="btn btn-primary">Update Fisherman</button>
                    </div>
                </form>
            `;
            showModalById('edit-fisherman-modal');
        })
        .catch(err => console.error(err));
}

// Confirm Delete
function confirmDelete(fishermanId) {
    const btn = document.getElementById('confirmDeleteBtn');
    btn.setAttribute('data-id', fishermanId);
    showModalById('delete-confirm-modal');
}

document.getElementById('confirmDeleteBtn').addEventListener('click', function() {
    const id = this.getAttribute('data-id');
    window.location.href = `functions/delete-func/delete-fishermen.php?id=${id}`;
});
</script>
