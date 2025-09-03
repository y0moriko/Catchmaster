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
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.6.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/header.css" rel="stylesheet">
    <link href="css/direct.css" rel="stylesheet">
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
                        <button class="action-button btn-add" onclick="showModal()">
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
                        <!-- Sample data rows -->
                        <tr>
                            <td><input type="checkbox"></td>
                            <td>
                                <img src="https://via.placeholder.com/60x60?text=Fish" alt="Fish" class="fish-image">
                            </td>
                            <td>
                                <div class="fish-name">Bangus</div>
                                <div class="scientific-name">Chanos chanos</div>
                            </td>
                            <td><em>Chanos chanos</em></td>
                            <td class="fish-description">A popular silvery fish commonly found in Philippine waters, known for its mild taste and versatility in cooking.</td>
                            <td>Chanidae</td>
                            <td><span class="badge badge-info">Pelagic</span></td>
                            <td>
                                <div class="action-btns">
                                    <button class="action-btn btn-edit" title="Edit" onclick="editFish(1)">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="action-btn btn-delete" title="Delete" onclick="confirmDelete(1)">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td><input type="checkbox"></td>
                            <td>
                                <img src="https://via.placeholder.com/60x60?text=Fish" alt="Fish" class="fish-image">
                            </td>
                            <td>
                                <div class="fish-name">Tilapia</div>
                                <div class="scientific-name">Oreochromis niloticus</div>
                            </td>
                            <td><em>Oreochromis niloticus</em></td>
                            <td class="fish-description">A freshwater fish species widely cultivated in aquaculture, known for its adaptability and nutritional value.</td>
                            <td>Cichlidae</td>
                            <td><span class="badge badge-success">Freshwater</span></td>
                            <td>
                                <div class="action-btns">
                                    <button class="action-btn btn-edit" title="Edit" onclick="editFish(2)">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="action-btn btn-delete" title="Delete" onclick="confirmDelete(2)">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td><input type="checkbox"></td>
                            <td>
                                <img src="https://via.placeholder.com/60x60?text=Fish" alt="Fish" class="fish-image">
                            </td>
                            <td>
                                <div class="fish-name">Maya-maya</div>
                                <div class="scientific-name">Lutjanus campechanus</div>
                            </td>
                            <td><em>Lutjanus campechanus</em></td>
                            <td class="fish-description">A prized red snapper species found in deep waters, highly valued for its firm texture and excellent taste.</td>
                            <td>Lutjanidae</td>
                            <td><span class="badge badge-warning">Reef-associated</span></td>
                            <td>
                                <div class="action-btns">
                                    <button class="action-btn btn-edit" title="Edit" onclick="editFish(3)">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="action-btn btn-delete" title="Delete" onclick="confirmDelete(3)">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Add Fish Species Modal -->
    <div class="modal fade" id="fisherModal" tabindex="-1" role="dialog" aria-labelledby="fisherModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <form class="modal-content" action="functions/add-func/add-fish.php" method="post" enctype="multipart/form-data" novalidate>
                <div class="modal-header">
                    <h5 class="modal-title" id="fisherModalLabel">
                        <i class="fas fa-fish"></i>
                        Add Fish Species
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <!-- Name Fields -->
                            <div class="form-group">
                                <label for="fish_name">Fish Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="fishName" name="fish_name" required placeholder="Enter fish name">
                                <div class="invalid-feedback">Fish name is required.</div>
                            </div>
                            <div class="form-group">
                                <label for="scientific_name">Scientific Name</label>
                                <input type="text" class="form-control" id="scientificName" name="scientific_name" placeholder="Enter scientific name">
                            </div>
                            <div class="form-group">
                                <label for="local_name">Local Name</label>
                                <input type="text" class="form-control" id="localName" name="local_name" placeholder="Enter local name">
                            </div>
                            <div class="form-group">
                                <label for="family">Family <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="Family" name="family" required placeholder="Enter fish family">
                                <div class="invalid-feedback">Family is required.</div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="habitat">Habitat <span class="text-danger">*</span></label>
                                <select name="habitat" id="habitat" class="form-control" required>
                                    <option value="">Select Habitat</option>
                                    <option value="Pelagic">Pelagic</option>
                                    <option value="Demersal">Demersal</option>
                                    <option value="Reef-associated">Reef-associated</option>
                                    <option value="Invertebrate">Invertebrate</option>
                                </select>
                                <div class="invalid-feedback">Habitat is required.</div>
                            </div>
                            <!-- Image Upload -->
                            <div class="form-group">
                                <label for="image">Profile Image</label>
                                <input type="file" class="form-control-file" id="image" name="image" accept="image/*" onchange="previewImage(event)">
                                <small class="form-text text-muted">Upload an image of the fish species.</small>
                            </div>
                            <!-- Image Preview -->
                            <div class="form-group">
                                <label>Image Preview</label>
                                <div>
                                    <img id="imagePreview" src="" alt="Image Preview" class="image-preview" style="display:none;">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="fish_description">Description <span class="text-danger">*</span></label>
                        <textarea class="form-control" id="Description" name="fish_description" required rows="3" placeholder="Enter fish description"></textarea>
                        <div class="invalid-feedback">Description is required.</div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="reset" class="btn btn-secondary">
                        <i class="fas fa-times"></i> Clear
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Save Species
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Confirmation Modal -->
    <div class="modal fade" id="confirmDeleteModal" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="confirmDeleteLabel">
                        <i class="fas fa-exclamation-triangle"></i>
                        Confirm Deletion
                    </h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this fish species? This action cannot be undone.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger" id="confirmDeleteBtn">
                        <i class="fas fa-trash"></i> Yes, Delete
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Fish Modal -->
    <div class="modal fade" id="editFishModal" tabindex="-1" role="dialog" aria-labelledby="editFishModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editFishModalLabel">
                        <i class="fas fa-edit"></i>
                        Edit Fish Species
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="editFishContent">
                    <!-- Edit form content will be loaded here -->
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.6.2/js/bootstrap.min.js"></script>

    <script>
        function showModal() {
            $('#fisherModal').modal({
                backdrop: 'static',
                keyboard: false
            });
        }

        function capitalizeInput(input) {
            const words = input.value.split(' ');
            input.value = words
                .map(word => word.charAt(0).toUpperCase() + word.slice(1).toLowerCase())
                .join(' ');
        }

        function previewImage(event) {
            const imagePreview = document.getElementById('imagePreview');
            const file = event.target.files[0];
            const reader = new FileReader();

            reader.onload = function(e) {
                imagePreview.src = e.target.result;
                imagePreview.style.display = 'block';
            }

            if (file) {
                reader.readAsDataURL(file);
            } else {
                imagePreview.src = '';
                imagePreview.style.display = 'none';
            }
        }

        function confirmDelete(fishId) {
            $('#confirmDeleteBtn').data('fish-id', fishId);
            $('#confirmDeleteModal').modal('show');
        }

        function editFish(fishId) {
            // Simulate loading edit form content
            $('#editFishContent').html(`
                <form action="functions/edit-func/edit-fish.php" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="fish_id" value="${fishId}">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="edit_fish_name">Fish Name</label>
                                <input type="text" class="form-control" name="fish_name" value="Sample Fish Name" required>
                            </div>
                            <div class="form-group">
                                <label for="edit_scientific_name">Scientific Name</label>
                                <input type="text" class="form-control" name="scientific_name" value="Scientific Name">
                            </div>
                            <div class="form-group">
                                <label for="edit_local_name">Local Name</label>
                                <input type="text" class="form-control" name="local_name" value="Local Name">
                            </div>
                            <div class="form-group">
                                <label for="edit_family">Family</label>
                                <input type="text" class="form-control" name="family" value="Fish Family" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="edit_habitat">Habitat</label>
                                <select name="habitat" class="form-control" required>
                                    <option value="Pelagic" selected>Pelagic</option>
                                    <option value="Demersal">Demersal</option>
                                    <option value="Reef-associated">Reef-associated</option>
                                    <option value="Invertebrate">Invertebrate</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="edit_image">Profile Image</label>
                                <input type="file" class="form-control-file" name="image" accept="image/*">
                                <small class="form-text text-muted">Leave empty to keep current image.</small>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="edit_description">Description</label>
                        <textarea class="form-control" name="fish_description" rows="3" required>Sample fish description that can be edited.</textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Update Species
                        </button>
                    </div>
                </form>
            `);
            $('#editFishModal').modal('show');
        }

        // Delete confirmation handler
        $('#confirmDeleteBtn').on('click', function() {
            const fishId = $(this).data('fish-id');
            // Here you would typically make an AJAX request to delete the fish
            console.log('Deleting fish with ID:', fishId);
            $('#confirmDeleteModal').modal('hide');
            // You can add actual deletion logic here
        });

        // Form validation
        (function() {
            'use strict';
            window.addEventListener('load', function() {
                var forms = document.getElementsByClassName('modal-content');
                Array.prototype.filter.call(forms, function(form) {
                    form.addEventListener('submit', function(event) {
                        if (form.checkValidity() === false) {
                            event.preventDefault();
                            event.stopPropagation();
                        }
                        form.classList.add('was-validated');
                    }, false);
                });
            }, false);
        })();

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
                // Here you would typically submit the form or make an AJAX request
                console.log('Excel file selected:', this.files[0].name);
                // You can add actual upload logic here
            }
        });

        // Filter functionality
        document.addEventListener('DOMContentLoaded', function() {
            const filterBtn = document.querySelector('.filter-btn');
            filterBtn.addEventListener('click', function() {
                // Add your filter logic here
                console.log('Applying filters...');
            });
        });
    </script>
</body>
</html>
