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
    <?php include 'header.php'; ?>
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

<body style="background-color: lightgray; min-height: 100vh;">
<?php include 'notifications/messages.php'?>
<!-- DATA TABLE-->
                <section class="p-t-20">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <h3 class="title-5 m-b-35">Fish Species Agdangan Area</h3>
                                <div class="table-data__tool">
                                    <div class="table-data__tool-left">
                                        <div class="rs-select2--light rs-select2--md">
                                            <select class="js-select2" name="property">
                                                <option selected="selected">All Properties</option>
                                                <option value="">Saltwater</option>
                                                <option value="">Freshwater</option>
                                            </select>
                                            <div class="dropDownSelect2"></div>
                                        </div>
                                        <div class="rs-select2--light rs-select2--sm">
                                            <select class="js-select2" name="time">
                                                <option selected="selected">Today</option>
                                                <option value="">3 Days</option>
                                                <option value="">1 Week</option>
                                            </select>
                                            <div class="dropDownSelect2"></div>
                                        </div>
                                        <button class="au-btn-filter">
                                            <i class="zmdi zmdi-filter-list"></i>filters</button>
                                    </div>
                                    <div class="table-data__tool-right">
                                        <button class="au-btn au-btn-icon au-btn--green au-btn--small" onclick="showModal()">
                                            <i class="zmdi zmdi-plus"></i>Add Fish Species
                                        </button>
                                        <form method="post" enctype="multipart/form-data" action="functions/upload-func/upload-fish.php" style="display: inline;">
                                            <input type="file" name="excel_file" id="excel_file" accept=".xlsx" style="display: none;" onchange="this.form.submit()">
                                            <button type="button" class="au-btn au-btn-icon au-btn--blue au-btn--small" onclick="document.getElementById('excel_file').click();">
                                                <i class="zmdi zmdi-upload"></i> Upload Excel
                                            </button>
                                        </form>
                                    </div>
                                </div>

                                <div class="table-responsive table-responsive-data2">
                                    <table class="table table-data2">
                                        <thead>
                                            <tr>
                                                <th>
                                                    <label class="au-checkbox">
                                                        <input type="checkbox">
                                                        <span class="au-checkmark"></span>
                                                    </label>
                                                </th>
                                                <th>Image</th>
                                                <th>Fish Name</th>
                                                <th>Scientific Name</th>
                                                <th>Description</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php include 'functions/fetch-func/fetch-fish.php' ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    </section>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--Modal-->
    <div class="modal fade" id="fisherModal" tabindex="-1" role="dialog" aria-labelledby="fisherModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form class="modal-content" action="functions/add-func/add-fish.php" method="post" enctype="multipart/form-data" novalidate>
                <div class="modal-header">
                    <h5 class="modal-title" id="fisherModalLabel">Add Fish Species</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" title="Close modal">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Name Fields -->
                    <div class="form-group">
                        <label for="fish_name">Fish Name<span class="text-danger">*</span></label>
                        <input type="text" class="form-control upper-input capitalize" id="fishName" name="fish_name" required oninput="capitalizeInput(this)" />
                        <div class="invalid-feedback">Fish name is required.</div>
                    </div>
                    <div class="form-group">
                        <label for="scientific_name">Scientific Name</label>
                        <input type="text" class="form-control upper-input capitalize" id="scientificName" name="scientific_name" oninput="capitalizeInput(this)" />
                        <div class="invalid-feedback">Scientific name is required.</div>
                    </div>
                    <div class="form-group">
                        <label for="local_name">Local Name</label>
                        <input type="text" class="form-control upper-input capitalize" id="localName" name="local_name" oninput="capitalizeInput(this)" />
                        <div class="invalid-feedback">Local name is required.</div>
                    </div>
                    <div class="form-group" style="width:100%;">
                        <label for="fish_description">Description<span class="text-danger">*</span></label>
                        <input type="text" class="form-control upper-input capitalize" id="Description" name="fish_description" required oninput="capitalizeInput(this)" />
                        <div class="invalid-feedback">Description is required.</div>
                    </div>
                    <div class="form-group" style="width:100%;">
                        <label for="family">Family<span class="text-danger">*</span></label>
                        <input type="text" class="form-control upper-input capitalize" id="Family" name="family" required oninput="capitalizeInput(this)" />
                        <div class="invalid-feedback">Family is required.</div>
                    </div>
                    <div class="form-group">
                        <label for="habitat">Habitat<span class="text-danger">*</span></label>
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
                        <input type="file" class="form-control-file" id="image" name="image" accept="image/*" onchange="previewImage(event)" />
                        <small class="form-text text-muted">Upload an image.</small>
                    </div>
                    <!-- Image Preview -->
                    <div class="form-group">
                        <label>Image Preview</label>
                        <img id="imagePreview" src="" alt="Image Preview" style="display:none; max-width: 100%; height: auto;" />
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="reset" class="btn btn-secondary">Clear</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
    <!-- confirmation modal -->
    <div class="modal fade" id="confirmDeleteModal" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header bg-danger text-white">
            <h5 class="modal-title" id="confirmDeleteLabel">Confirm Deletion</h5>
            <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            Are you sure you want to delete this fish? This action cannot be undone.
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            <a href="#" class="btn btn-danger" id="confirmDeleteBtn">Yes, Delete</a>
        </div>
        </div>
    </div>
    </div>
    <!-- edit form modal -->
    <div class="modal fade" id="editFishModal" tabindex="-1" role="dialog" aria-labelledby="editFishModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
        <div class="modal-header bg-info text-white">
            <h5 class="modal-title" id="editFishModalLabel">Edit Fish</h5>
            <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body" id="editFishContent">
        </div>
        </div>
    </div>
    </div>

    <script>
        $(document).ready(function() {
        $('.delete-btn').on('click', function(e) {
            e.preventDefault();
            const fishId = $(this).data('id');
            const deleteUrl = 'functions/delete-func/delete-fish.php?id=' + fishId;
            $('#confirmDeleteBtn').attr('href', deleteUrl);
            $('#confirmDeleteModal').modal('show');
        });
        });
        $(document).ready(function() {
        $('.edit-btn').on('click', function(e) {
            e.preventDefault();
            const fishId = $(this).data('id');

            $.ajax({
            url: 'forms/edit-fish-form.php', // This is your current form file
            type: 'GET',
            data: { id: fishId },
            success: function(response) {
                $('#editFishContent').html(response);
                $('#editFishModal').modal('show');
            },
            error: function() {
                $('#editFishContent').html('<p class="text-danger">Failed to load form.</p>');
                $('#editFishModal').modal('show');
            }
            });
        });
        });
    </script>
                         
    <script>
    function showModal() {
        $('#fisherModal').modal({
            backdrop: 'static', // Disable click outside
            keyboard: false     // Disable Esc key
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
    </script>
 
    
  <!-- Jquery JS-->
    <script src="vendor/jquery-3.2.1.min.js"></script>
    <!-- Bootstrap JS-->
    <script src="vendor/bootstrap-4.1/popper.min.js"></script>
    <script src="vendor/bootstrap-4.1/bootstrap.min.js"></script>
    <!-- Vendor JS       -->
    <script src="vendor/slick/slick.min.js">
    </script>
    <script src="vendor/wow/wow.min.js"></script>
    <script src="vendor/animsition/animsition.min.js"></script>
    <script src="vendor/bootstrap-progressbar/bootstrap-progressbar.min.js">
    </script>
    <script src="vendor/counter-up/jquery.waypoints.min.js"></script>
    <script src="vendor/counter-up/jquery.counterup.min.js">
    </script>
    <script src="vendor/circle-progress/circle-progress.min.js"></script>
    <script src="vendor/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="vendor/chartjs/Chart.bundle.min.js"></script>
    <script src="vendor/select2/select2.min.js">
    </script>

    <!-- Main JS-->
    <script src="js/main.js"></script>


</body>

</html>
<!-- end document-->
