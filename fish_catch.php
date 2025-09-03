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
    <?php include 'notifications/messages.php' ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fish Catches - CatchMaster</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.6.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/header.css" rel="stylesheet">
    <link href="css/catch.css" rel="stylesheet">
</head>
<body>
    <?php include 'header.php'; ?>
    
    <div class="modern-container">
        <!-- Modern Breadcrumb -->
        <div class="modern-breadcrumb">
            <div class="breadcrumb-content">
                <nav class="breadcrumb-nav">
                    <span>You are here:</span>
                    <a href="index.php">Home</a>
                    <span>/</span>
                    <span>Fish Catches</span>
                </nav>
                <div class="search-container">
                    <input
                        id="globalSearch"
                        class="modern-search"
                        type="text"
                        placeholder="Search fish catches..."
                    >
                    <button class="search-btn" type="button">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Page Header -->
        <div class="page-header">
            <h1 class="page-title">Fish Catch Records</h1>
            <button class="add-catch-btn" onclick=showModal()>
                <i class="fas fa-plus"></i>
                Add Fish Catch
            </button>
        </div>

        <!-- Modern Table Card -->
        <div class="table-card">
            <div class="table-header">
                <h3 class="table-title">Recent Fish Catches</h3>
                <div class="table-filters">
                    <select class="filter-select">
                        <option>All Locations</option>
                        <option>Salvacion</option>
                        <option>Binagbag</option>
                        <option>Silangang Calutan</option>
                        <option>Kanlurang Calutan</option>
                        <option>Sildora</option>
                    </select>
                    <select class="filter-select">
                        <option>All Time</option>
                        <option>Today</option>
                        <option>This Week</option>
                        <option>This Month</option>
                    </select>
                    <button class="filter-btn">
                        <i class="fas fa-filter"></i>
                        Apply Filters
                    </button>
                </div>
            </div>
            <div class="table-responsive">
                <table class="modern-table">
                    <thead>
                        <tr>
                            <th>
                                <input type="checkbox" style="transform: scale(1.2);">
                            </th>
                            <th>Fish Species</th>
                            <th>Quantity (kg)</th>
                            <th>Location</th>
                            <th>Date & Time</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php include 'functions/fetch-func/fetch-catch.php'?>
                        <!-- Sample data rows - replace with your PHP fetch -->
                        <tr>
                            <td><input type="checkbox"></td>
                            <td><strong>Bangus</strong></td>
                            <td>25.5</td>
                            <td>Salvacion</td>
                            <td>Dec 15, 2024 - 6:30 AM</td>
                            <td><span class="status-badge status-fresh">Fresh</span></td>
                            <td>
                                <div class="action-btns">
                                    <button class="action-btn btn-edit" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="action-btn btn-delete" title="Delete">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td><input type="checkbox"></td>
                            <td><strong>Tilapia</strong></td>
                            <td>18.2</td>
                            <td>Binagbag</td>
                            <td>Dec 15, 2024 - 5:45 AM</td>
                            <td><span class="status-badge status-processed">Processed</span></td>
                            <td>
                                <div class="action-btns">
                                    <button class="action-btn btn-edit" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="action-btn btn-delete" title="Delete">
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

    <!-- Add Fish Catch Modal -->
    <div class="modal fade" id="fisherModal" tabindex="-1" role="dialog" aria-labelledby="fisherModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <form class="modal-content" action="functions/add-func/add-catch.php" method="post" enctype="multipart/form-data" novalidate>
                <div class="modal-header">
                    <h5 class="modal-title" id="fisherModalLabel">
                        <i class="fas fa-fish me-2"></i>Add Fish Catch
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <?php include 'functions/get-func/get-fish.php'?>
                    <!-- Select Fish -->
                    <div class="form-group">
                        <label for="speciesName">Select Fish <span class="text-danger">*</span></label>
                        <select class="form-control" id="speciesName" name="species_name" required>
                            <option value="" disabled selected>Select species</option>
                            <?php foreach ($fishSpecies as $species): ?>
                                <option value="<?php echo htmlspecialchars($species); ?>"><?php echo htmlspecialchars($species); ?></option>
                            <?php endforeach; ?>
                        </select>
                        <div class="invalid-feedback">Species name is required.</div>
                    </div>

                    <!-- Quantity -->
                    <div class="form-group">
                        <label for="number">Quantity in Kilogram <span class="text-danger">*</span></label>
                        <input type="number" class="form-control" id="number" name="number" step="0.1" required placeholder="Enter weight in kg">
                        <div class="invalid-feedback">Please enter a valid quantity.</div>
                    </div>

                    <!-- Location -->
                    <div class="form-group">
                        <label for="address">Location <span class="text-danger">*</span></label>
                        <select class="form-control" id="address" name="address" required>
                            <option value="" disabled selected>Select location</option>
                            <option value="Salvacion">Salvacion</option>
                            <option value="Binagbag">Binagbag</option>
                            <option value="Silangang Calutan">Silangang Calutan</option>
                            <option value="Kanlurang Calutan">Kanlurang Calutan</option>
                            <option value="Sildora">Sildora</option>
                        </select>
                        <div class="invalid-feedback">Please select a location.</div>
                    </div>

                    <!-- Date and Time -->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="auto_date">Date</label>
                                <input type="text" id="auto_date" name="date" class="form-control" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="auto_time">Time</label>
                                <input type="text" id="auto_time" name="time" class="form-control" readonly>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="reset" class="btn btn-secondary">
                        <i class="fas fa-times me-1"></i>Clear
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-1"></i>Save Catch
                    </button>
                </div>
            </form>
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

        // Auto-fill date and time when form is interacted with
        let timestampFilled = false;

        function setDateTimeOnce() {
            if (timestampFilled) return;
            const now = new Date();

            const date = now.toISOString().split('T')[0];
            const time = now.toTimeString().split(' ')[0];

            document.getElementById('auto_date').value = date;
            document.getElementById('auto_time').value = time;

            timestampFilled = true;
        }

        // Listen for any input in the form
        const form = document.querySelector('form');
        form.addEventListener('input', setDateTimeOnce);

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

        // Search functionality (placeholder)
        document.getElementById('globalSearch').addEventListener('input', function() {
            const query = this.value.toLowerCase();
            // Add your search logic here
        });
    </script>
</body>
</html>