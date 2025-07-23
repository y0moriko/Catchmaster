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
                            <body style="background-color: lightgray; min-height: 100vh;"></body>
                        <div class="modal fade" id="fisherModal" tabindex="-1" role="dialog" aria-labelledby="fisherModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <form class="modal-content" action="functions/add-func/add-catch.php" method="post" enctype="multipart/form-data" novalidate>
                                <div class="modal-header">
                                    <h5 class="modal-title" id="fisherModalLabel">Add Fish Catch</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" title="Close modal">
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
                                    <input type="number" class="form-control" id="number" name="number" step="any" required>
                                    </div>

                                    <!-- Location -->
                                    <div class="form-group">
                                    <label for="address">Location<span class="text-danger">*</span></label>
                                    <select class="form-control" id="address" name="address" required oninput="capitalizeInput(this)">
                                    <option value="" disabled selected>Select an address</option>
                                    <option value="Barangay 1">Salvacion</option>
                                    <option value="Barangay 2">Binagbag</option>
                                    <option value="Barangay 3">Silangang Calutan</option>
                                    <option value="Barangay 4">Kanlurang Calutan</option>
                                    <option value="Barangay 5">Sildora</option>
                                    </select>
                                    <div class="invalid-feedback">Please select an address.</div>
                                </div>

                                    <!-- Date and Time -->
                                    <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="auto_date">Date</label>
                                        <input type="text" id="auto_date" name="date" class="form-control" readonly>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="auto_time">Time</label>
                                        <input type="text" id="auto_time" name="time" class="form-control" readonly>
                                    </div>
                                    </div>
                                </div>

                                <div class="modal-footer">
                                    <button type="reset" class="btn btn-secondary">Clear</button>
                                    <button type="submit" class="btn btn-primary" id="previewBtn">Save</button>
                                </div>
                                </form>
                            </div>
                            </div>

                        <!-- Preview Modal -->
                        <div class="modal fade" id="previewModal" tabindex="-1" role="dialog" aria-labelledby="previewModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Confirm Fish Species</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close" title="Close preview">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <p><strong>Select Fish:</strong> <span id="previewSpeciesName"></span></p>
                                <p><strong>Quantity in Kilogram:</strong> <span id="previewScientificName"></span></p>
                                <p><strong>Location:</strong> <span id="previewHabitat"></span></p>
                                <p><strong>Date and Time:</strong> <span id="previewDescription"></span></p>
                                <p><strong>Image:</strong><br><img id="previewImage" src="#" alt="No image uploaded" class="img-fluid" style="max-height: 200px; display: none;"></p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Edit</button>
                                <button type="submit" class="btn btn-success" form="fishForm">Confirm & Submit</button>
                            </div>
                            </div>
                        </div>
                        </div>
                                           
            <!-- DATA TABLE-->
              <section class="p-t-20">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <h3 class="title-5 m-b-35">data table</h3>
                            <div class="table-data__tool">
                                <div class="table-data__tool-left">
                                    <div class="rs-select2--light rs-select2--md">
                                        <select class="js-select2" name="property">
                                            <option selected="selected">All Properties</option>
                                            <option value="">Option 1</option>
                                            <option value="">Option 2</option>
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
                                        <i class="zmdi zmdi-plus"></i>Add FIsh Catch
                                    </button>
                                    <div class="rs-select2--dark rs-select2--sm rs-select2--dark2">
                                        <select class="js-select2" name="type">
                                            <option selected="selected">Export</option>
                                            <option value="">Option 1</option>
                                            <option value="">Option 2</option>
                                        </select>
                                        <div class="dropDownSelect2"></div>
                                    </div>
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
                                            <th>Select Fish</th>
                                            <th>Quantity in Kilogram</th>
                                            <th>Location</th>
                                            <th>Date and Time</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php include 'functions/fetch-func/fetch-catch.php'?>
                                </tbody>
                     
                                <!-- END DATA TABLE -->

                        
                    </div>
                </div>
            </div>
        </div>

    </div>
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
</script>

<script>
function fillDateTime() {
    const now = new Date();

    // Format date: YYYY-MM-DD
    const date = now.toISOString().split('T')[0];

    // Format time: HH:MM AM/PM
    const time = now.toLocaleTimeString('en-US', {
        hour: '2-digit',
        minute: '2-digit',
        hour12: true
    });

    document.getElementById('currentDate').value = date;
    document.getElementById('currentTime').value = time;
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
    <script>
  let timestampFilled = false;

  function setDateTimeOnce() {
    if (timestampFilled) return;
    const now = new Date();

    // Format date as YYYY-MM-DD
    const date = now.toISOString().split('T')[0];
    // Format time as HH:MM:SS
    const time = now.toTimeString().split(' ')[0];

    document.getElementById('auto_date').value = date;
    document.getElementById('auto_time').value = time;

    timestampFilled = true;
  }

  // Listen for any input in the form
  const form = document.querySelector('form');
  form.addEventListener('input', setDateTimeOnce);
</script>


</body>

</html>
<!-- end document-->
