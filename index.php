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
<?php
include 'functions/fetch-func/fetch-top-barangay.php';
$topBarangays = getTopBarangays(5);
?>
        <!-- PAGE CONTENT-->
        <div class="page-content--bgf7">
            <!-- BREADCRUMB-->
            <section class="au-breadcrumb2">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="au-breadcrumb-content">
                                <div class="au-breadcrumb-left">
                                    <span class="au-breadcrumb-span">You are here:</span>
                                    <ul class="list-unstyled list-inline au-breadcrumb__list">
                                        <li class="list-inline-item active">
                                            <a href="#">Home</a>
                                        </li>
                                        <li class="list-inline-item seprate">
                                            <span>/</span>
                                        </li>
                                        <li class="list-inline-item">Dashboard</li>
                                    </ul>
                                </div>
                                <div class="content-wrapper">
                                <form class="au-form-icon--sm" onsubmit="return false;">
                                    <input id="globalSearch" class="au-input--w300 au-input--style2" type="text" placeholder="Search for datas & reports...">
                                    <button class="au-btn--submit2" type="button">
                                        <i class="zmdi zmdi-search"></i>
                                    </button>
                                </form>
                                <div id="searchResults" class="mt-2"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- END BREADCRUMB-->

            <!-- WELCOME-->
            <section class="welcome p-t-10">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <h1 class="title-4" style="color: blue;">Welcome back!
                            </h1>
                            <hr class="line-seprate">
                        </div>
                    </div>
                </div>
            </section>
            <!-- END WELCOME-->

            <!-- STATISTIC-->
            <section class="statistic statistic2">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6 col-lg-3">
                            <div class="statistic__item statistic__item--green">
                                <h2 class="number">
                                    <?php include 'functions/forensics/count-fishermen.php'; echo htmlspecialchars($count); ?>
                                </h2>
                                <span class="desc">head fishermen</span>
                                <div class="icon">
                                    <i class="zmdi zmdi-account-o"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-3">
                            <div class="statistic__item statistic__item--orange">
                                <h2 class="number">
                                    <?php include 'functions/forensics/count-catch.php'; ?>
                                </h2>
                                <span class="desc">fish catch</span>
                                <div class="icon">
                                    <i class="zmdi zmdi-shopping-cart"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-3">
                            <div class="statistic__item statistic__item--blue">
                                <h2 class="number">
                                    <?php include 'functions/forensics/weekly-fish-count.php'; ?>
                                </h2>
                                <span class="desc">this week</span>
                                <div class="icon">
                                    <i class="zmdi zmdi-calendar-note"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-3">
                            <div class="statistic__item statistic__item--red">
                                <h2 class="number">0</h2>
                                <span class="desc">total earnings</span>
                                <div class="icon">
                                    <i class="zmdi zmdi-money"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- END STATISTIC-->

            <!-- STATISTIC CHART-->
            <section class="statistic-chart">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <h3 class="title-5 m-b-35">statistics</h3>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-lg-4">
                            <!-- CHART-->
                            <div class="statistic-chart-1">
                                <h3 class="title-3 m-b-30">chart</h3>
                                <div class="chart-wrap">
                                    <canvas id="widgetChart5"></canvas>
                                </div>
                                <div class="statistic-chart-1-note">
                                    <span class="big">10,368</span>
                                    <span>/ 16220 fish catched</span>
                                </div>
                            </div>
                            <!-- END CHART-->
                        </div>
                        <div class="col-md-6 col-lg-4">
                            <!-- TOP CAMPAIGN-->
                            <div class="top-campaign">
                                <h3 class="title-3 m-b-30">Top Places</h3>
                                <div class="table-responsive">
                                    <table class="table table-top-campaign">
                                        <tbody>
                                            <?php
                                            $rank = 1;
                                            foreach ($topBarangays as $row):
                                            ?>
                                                <tr>
                                                    <td><?php echo $rank . ". " . htmlspecialchars($row['location']); ?></td>
                                                    <td><?php echo number_format($row['total_catch'], 0) . " kg"?></td>
                                                </tr>
                                            <?php
                                                $rank++;
                                            endforeach;
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!-- END TOP CAMPAIGN-->
                        </div>
                        <div class="col-md-6 col-lg-4">
                            <!-- CHART PERCENT-->
                            <div class="chart-percent-2">
                                <h3 class="title-3 m-b-30">chart by %</h3>
                                <div class="chart-wrap">
                                    <canvas id="percent-chart2"></canvas>
                                    <div id="chartjs-tooltip">
                                        <table></table>
                                    </div>
                                </div>
                                <div class="chart-info">
                                    <div class="chart-note">
                                        <span class="dot dot--blue"></span>
                                        <span>products</span>
                                    </div>
                                    <div class="chart-note">
                                        <span class="dot dot--red"></span>
                                        <span>Services</span>
                                    </div>
                                </div>
                            </div>
                            <!-- END CHART PERCENT-->
                        </div>
                    </div>
                </div>
            </section>
            <!-- END STATISTIC CHART-->

            <script>
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
/* ===== Background with Floating Shapes ===== */
body {
  background: linear-gradient(135deg, #e0f7fa, #fce4ec);
  overflow-x: hidden;
  min-height: 100vh;
}

body::before, body::after {
  content: "";
  position: absolute;
  width: 300px;
  height: 300px;
  background: rgba(255, 255, 255, 0.25);
  border-radius: 50%;
  filter: blur(80px);
  animation: float 12s infinite ease-in-out alternate;
}

body::before {
  top: 10%;
  left: -100px;
}
body::after {
  bottom: 15%;
  right: -120px;
}

@keyframes float {
  from { transform: translateY(0px) scale(1); }
  to { transform: translateY(30px) scale(1.05); }
}

/* ===== Glassmorphism Cards ===== */
.statistic__item {
  border-radius: 20px;
  box-shadow: 0 8px 24px rgba(0,0,0,0.15);
  backdrop-filter: blur(8px);
  transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.statistic__item:hover {
  transform: translateY(-6px);
  box-shadow: 0 16px 32px rgba(0,0,0,0.25), 0 0 20px rgba(255,255,255,0.3);
}

/* Statistic Numbers Animated */
.number {
  font-size: 2rem;
  font-weight: bold;
  animation: countup 2s ease-in-out;
}

@keyframes countup {
  from { opacity: 0; transform: translateY(10px); }
  to { opacity: 1; transform: translateY(0px); }
}

/* Table Styling (Top Barangays) */
.table-top-campaign {
  background: rgba(255,255,255,0.8);
  border-radius: 15px;
  overflow: hidden;
}

.table-top-campaign tr td {
  padding: 12px 15px;
  font-weight: 500;
}

/* Breadcrumb */
.au-breadcrumb2 {
  background: rgba(255,255,255,0.6);
  border-radius: 20px;
  backdrop-filter: blur(10px);
  padding: 15px;
  margin-bottom: 20px;
}
                            </style>
                            
                            </head>
                            <body style="background-color: lightgray; min-height: 100vh;">

                                    <!-- Modal -->
                        
                        <!-- Modal -->
                        <div class="modal fade" id="fisherModal" tabindex="-1" role="dialog" aria-labelledby="fisherModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <form class="modal-content" action="functions/add-func/table.html" method="post" enctype="multipart/form-data" novalidate>
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="fisherModalLabel">Add item</h5>
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
                                    <label for="middleName">Middle Name</label>
                                    <input type="text" class="form-control upper-input capitalize" id="middleName" name="middle_name" oninput="capitalizeInput(this)"/>
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
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" />
                                    <div class="invalid-feedback">Please enter a valid email address.</div>
                                </div>

                                <!-- Address -->
                                <div class="form-group">
                                    <label for="address">Address<span class="text-danger">*</span></label>
                                    <select class="form-control" id="address" name="address" required>
                                    <option value="" disabled selected>Select an address</option>
                                    <option value="Barangay 1">Barangay 1</option>
                                    <option value="Barangay 2">Barangay 2</option>
                                    <option value="Barangay 3">Barangay 3</option>
                                    </select>
                                    <div class="invalid-feedback">Please select an address.</div>
                                </div>

                                <!-- Image Upload -->
                                <div class="form-group">
                                    <label for="image">Profile Image</label>
                                    <input type="file" class="form-control-file" id="image" name="image" accept="image/*" />
                                    <small class="form-text text-muted">Upload a profile image (optional).</small>
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
                             
            <!-- END DATA TABLE-->
        </div>

    </div>

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
        let searchTimeout;

        document.getElementById('globalSearch').addEventListener('input', function() {
            const query = this.value.trim();
            const resultsContainer = document.getElementById('searchResults');

            clearTimeout(searchTimeout);

            if(query.length < 2) {
                resultsContainer.innerHTML = '';
                return;
            }

            searchTimeout = setTimeout(() => {
                fetch(`functions/forensics/search.php?q=${encodeURIComponent(query)}`)
                    .then(response => response.json())
                    .then(data => {
                        let html = '';
                        if(data.length > 0){
                            data.forEach(item => {
                                html += `<div class="card mb-1 p-2">
                                            <strong>${item.type}:</strong> ${item.title} <br>
                                            <small>${item.details}</small>
                                        </div>`;
                            });
                        } else {
                            html = '<p>No results found.</p>';
                        }
                        resultsContainer.innerHTML = html;
                    });
            }, 300); // debounce 300ms
        });
        </script>

</body>

</html>
<!-- end document-->
