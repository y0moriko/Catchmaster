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
                            <body style="background-color: lightgray; min-height: 100vh;"></div>
                            <div class="modal fade" id="fisherModal" tabindex="-1" data-bs-backdrop="static" role="dialog" data-bs-keyboard="false" aria-labelledby="fisherModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <form class="modal-content" action="functions/add-func/add-fishermen.php" method="post" enctype="multipart/form-data" novalidate>
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="fisherModalLabel">Add Fishemen</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" title="Close modal">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                <div class="modal-body">

                                <!-- Name Fields -->
                                <div class="form-group">
                                    <label for="firstName">First Name<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control upper-input capitalize" id="firstName" name="first_name" required oninput="capitalizeInput(this)"/>
                                    <div class="invalid-feedback">First name is required.</div>
                                </div>
                                <div class="form-group">
                                    <label for="middleName">Middle Name<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control upper-input capitalize" id="middleName" name="middle_name" required oninput="capitalizeInput(this)"/>
                                </div>
                                <div class="form-group">
                                    <label for="lastName">Last Name<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control upper-input capitalize" id="lastName" name="last_name" required oninput="capitalizeInput(this)"/>
                                    <div class="invalid-feedback">Last name is required.</div>
                                </div>

                                <!-- Birthday -->
                                <div class="form-group">
                                    <label for="birthday">Birthday<span class="text-danger">*</span></label>
                                    <input type="date" class="form-control" id="birthday" name="birthday" required />
                                    <div class="invalid-feedback">Birthday is required.</div>
                                </div>

                                <!-- Contact -->
                                <div class="form-group">
                                    <label for="contact">Contact Number<span class="text-danger">*</span></label>
                                    <input type="number" class="form-control" id="contact" name="contact" pattern="[0-9]{11}" placeholder="09XXXXXXXXX" required />
                                    <small class="form-text text-muted">Format: 09XXXXXXXXX</small>
                                    <div class="invalid-feedback">Please enter a valid 11-digit contact number.</div>
                                </div>

                                <!-- Email -->
                                <div class="form-group">
                                    <label for="email">Email<span class="text-danger">*</span></label>
                                    <input type="email" class="form-control" id="email" name="email" required/>
                                    <div class="invalid-feedback">Please enter a valid email address.</div>
                                </div>

                                <!-- Address -->
                                <div class="form-group">
                                    <label for="address">Address<span class="text-danger">*</span></label>
                                    <select class="form-control" id="address" name="address" required oninput="capitalizeInput(this)">
                                    <option value="" disabled selected>Select an address</option>
                                    <option value="Binagbag">Binagbag</option>
                                    <option value="Kanlurang Calutan">Kanlurang Calutan</option>
                                    <option value="Silangang Calutan">Silangang Calutan</option>
                                    <option value="Salvacion">Salvacion</option>
                                    <option value="Sildora">Sildora</option>
                                    </select>
                                    <div class="invalid-feedback">Please select an address.</div>
                                </div>

                                <!-- Image Upload -->
                                <div class="form-group">
                                    <label for="image">Profile Image</label>
                                    <input type="file" class="form-control-file" id="image" name="image" accept="image/*" />
                                    <small class="form-text text-muted">Upload an image.</small>
                                </div>

                                </div>
                                <div class="modal-footer">
                                <button type="reset" class="btn btn-secondary">Clear</button>
                                <button type="submit" class="btn btn-primary">Save</button>
                                </div>
                            </form>
                            </div>
                        </div>
                            
            <!-- DATA TABLE-->
            <section class="p-t-20">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <h3 class="title-5 m-b-35">Fishermen Table</h3>
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
                                        <i class="zmdi zmdi-plus"></i>Add Fishermen
                                    </button>
                                    <form method="post" enctype="multipart/form-data" action="functions/upload-fish.php" style="display: inline;">
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
                                            <th>First Name</th>
                                            <th>Middle Name</th>
                                            <th>Last Name</th>
                                            <th>Phone Number</th>
                                            <th>Address</th>
                                            <th>Birthday</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php include 'functions/fetch-func/fetch-fishermen.php' ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
                     
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
