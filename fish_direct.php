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
    <title>Fish Directory - CatchMaster</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <!-- <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.6.2/css/bootstrap.min.css" rel="stylesheet"> -->
    <link href="css/direct.css" rel="stylesheet">
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
                    <span>Fish Directory</span>
                </nav>
            </div>
        </div>

        <!-- Page Header -->
        <div class="page-header">
            <h1 class="page-title">Fish Species Directory</h1>
        </div>

        <!-- Modern Table Card -->
        <div class="table-card">
            <div class="table-header">
                <h3 class="table-title">Fish Species Agdangan Area</h3>
                <div class="table-controls">
                    <div class="table-filters">
                        <select class="filter-select">
                            <option selected>All Properties</option>
                            <option value="Saltwater">Saltwater</option>
                            <option value="Freshwater">Freshwater</option>
                        </select>
                        <select class="filter-select">
                            <option selected>All Habitats</option>
                            <option value="Pelagic">Pelagic</option>
                            <option value="Demersal">Demersal</option>
                            <option value="Reef-associated">Reef-associated</option>
                            <option value="Invertebrate">Invertebrate</option>
                        </select>
                        <button class="filter-btn">
                            <i class="fas fa-filter"></i>
                            Apply Filters
                        </button>
                    </div>
                    <div class="table-actions">
                        <button class="action-button btn-add" onclick="openModal('addFishModal')">
                            <i class="fas fa-plus"></i>
                            Add Fish Species
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
                            <th>Image</th>
                            <th>Fish Name</th>
                            <th>Scientific Name</th>
                            <th>Description</th>
                            <th>Family</th>
                            <th>Habitat</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php include 'functions/fetch-func/fetch-fish.php'?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Add Fish Modal -->
    <div id="addFishModal" class="add-fish-modal">
    <div class="add-fish-modal-content">
        <span class="add-fish-close-btn" onclick="closeModal('addFishModal')">&times;</span>
        <h3><i class="fas fa-fish"></i> Add Fish Species</h3>
        
        <form action="functions/add-func/add-fish.php" method="post" enctype="multipart/form-data" novalidate>
        <label>Fish Name *</label>
        <input type="text" name="fish_name" required>

        <label>Scientific Name</label>
        <input type="text" name="scientific_name">

        <label>Local Name</label>
        <input type="text" name="local_name">

        <label>Family *</label>
        <input type="text" name="family" required>

        <label>Habitat *</label>
        <select name="habitat" required>
            <option value="">Select Habitat</option>
            <option value="Pelagic">Pelagic</option>
            <option value="Demersal">Demersal</option>
            <option value="Reef-associated">Reef-associated</option>
            <option value="Invertebrate">Invertebrate</option>
        </select>

        <label>Image</label>
        <input type="file" name="image" accept="image/*" onchange="previewImage(event)">
        <img id="imagePreview" style="display:none; max-width:100px; margin-top:10px;">

        <label>Description *</label>
        <textarea name="fish_description" required rows="3"></textarea>

        <div class="add-fish-actions">
            <button type="button" class="add-fish-btn-secondary" onclick="closeModal('addFishModal')">Cancel</button>
            <button type="submit" class="add-fish-btn-primary">Save Species</button>
        </div>
        </form>
    </div>
    </div>


    <!-- Custom Confirmation Modal -->
    <div id="confirmDeleteModal" class="add-fish-modal">
        <div class="add-fish-modal-content">
            <span class="add-fish-close-btn" onclick="closeModal('confirmDeleteModal')">&times;</span>
            <h3 class="text-danger">
                <i class="fas fa-exclamation-triangle"></i> Confirm Deletion
            </h3>

            <p style="margin: 15px 0; font-size: 14px; color: #444;">
                Are you sure you want to delete this fish species? This action cannot be undone.
            </p>

            <div class="add-fish-actions">
                <button type="button" class="add-fish-btn-secondary" onclick="closeModal('confirmDeleteModal')">
                    Cancel
                </button>
                <button type="button" class="add-fish-btn-primary" id="confirmDeleteBtn" style="background-color: #dc3545; border-color: #dc3545;">
                    <i class="fas fa-trash"></i> Yes, Delete
                </button>
            </div>
        </div>
    </div>

    <!-- Edit Fish Modal -->
    <div id="editFishModal" class="add-fish-modal">
        <div class="add-fish-modal-content">
            <span class="add-fish-close-btn" onclick="closeModal('editFishModal')">&times;</span>
            <h3><i class="fas fa-edit"></i> Edit Fish Species</h3>
            
            <!-- The edit form will be loaded here dynamically -->
            <div id="editFishContent">
                <!-- Example placeholder, actual form loaded via JS/AJAX -->
                <p>Loading...</p>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.6.2/js/bootstrap.min.js"></script>

    <script>
    // Capitalize input fields
    function capitalizeInput(input) {
        const words = input.value.split(' ');
        input.value = words
            .map(word => word.charAt(0).toUpperCase() + word.slice(1).toLowerCase())
            .join(' ');
    }

    // Open/Close Custom Modal
    function openModal(id) {
        document.getElementById(id).classList.add('show');
    }

    function closeModal(id) {
        document.getElementById(id).classList.remove('show');
    }

    // Image preview
    function previewImage(event) {
        const img = document.getElementById('imagePreview');
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = e => {
                img.src = e.target.result;
                img.style.display = "block";
            };
            reader.readAsDataURL(file);
        }
    }

    // Confirm Delete Modal
    function confirmDelete(fishId) {
        // Store fishId for deletion in the button's data attribute
        const deleteBtn = document.getElementById('confirmDeleteBtn');
        deleteBtn.setAttribute('data-fish-id', fishId);

        // Show your custom modal
        openModal('confirmDeleteModal');
    }


    document.addEventListener('DOMContentLoaded', function() {
        const confirmDeleteBtn = document.getElementById('confirmDeleteBtn');
        confirmDeleteBtn.addEventListener('click', function() {
            const fishId = this.getAttribute('data-fish-id');
            if(fishId) {
                // Redirect to your delete script with the fish ID
                window.location.href = `functions/delete-func/delete-fish.php?id=${fishId}`;
            }
        });
    });

        //Edit Fish
    function editFish(fishId) {
        fetch(`functions/fetch-func/fetch-single-fish.php?id=${fishId}`)
        .then(response => response.json())
        .then(fish => {
            document.getElementById('editFishContent').innerHTML = `
                <form action="functions/update-func/update-fish.php" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="fish_id" value="${fish.fish_id}">

                    <label>Fish Name *</label>
                    <input type="text" name="fish_name" value="${fish.fish_name}" required>

                    <label>Scientific Name</label>
                    <input type="text" name="scientific_name" value="${fish.scientific_name}">

                    <label>Local Name</label>
                    <input type="text" name="local_name" value="${fish.local_name}">

                    <label>Family *</label>
                    <input type="text" name="family" value="${fish.family}" required>

                    <label>Habitat *</label>
                    <select name="habitat" required>
                        <option value="Pelagic" ${fish.habitat === 'Pelagic' ? 'selected' : ''}>Pelagic</option>
                        <option value="Demersal" ${fish.habitat === 'Demersal' ? 'selected' : ''}>Demersal</option>
                        <option value="Reef-associated" ${fish.habitat === 'Reef-associated' ? 'selected' : ''}>Reef-associated</option>
                        <option value="Invertebrate" ${fish.habitat === 'Invertebrate' ? 'selected' : ''}>Invertebrate</option>
                    </select>

                    <label>Image</label>
                    <input type="file" name="new_image" accept="image/*" onchange="previewEditImage(event)">
                    <img id="editImagePreview" src="uploads/fish/${fish.image_path}" style="max-width:100px; margin-top:10px;">

                    <label>Description *</label>
                    <textarea name="fish_description" rows="3" required>${fish.fish_description}</textarea>

                    <div class="add-fish-actions">
                        <button type="button" class="add-fish-btn-secondary" onclick="closeModal('editFishModal')">Cancel</button>
                        <button type="submit" class="add-fish-btn-primary" name="update_fish">Update Species</button>
                    </div>
                </form>
            `;
            openModal('editFishModal');
        })
        .catch(err => console.error('Error fetching fish data:', err));
    }

    // Image preview for edit modal
    function previewEditImage(event) {
        const img = document.getElementById('editImagePreview');
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = e => {
                img.src = e.target.result;
            };
            reader.readAsDataURL(file);
        }
    }


    // Auto-capitalize input fields
    document.addEventListener('DOMContentLoaded', function() {
        const inputs = document.querySelectorAll('input[type="text"]:not([readonly])');
        inputs.forEach(input => {
            input.addEventListener('input', function() {
                capitalizeInput(this);
            });
        });
    });

    // Handle Excel file upload
    document.getElementById('excel_file').addEventListener('change', function() {
        if (this.files.length > 0) {
            console.log('Excel file selected:', this.files[0].name);
            // TODO: Add upload logic
        }
    });

    // Filter functionality
    document.addEventListener('DOMContentLoaded', function() {
        const filterBtn = document.querySelector('.filter-btn');
        if (filterBtn) {
            filterBtn.addEventListener('click', function() {
                console.log('Applying filters...');
            });
        }
    });
</script>
</body>
</html>
