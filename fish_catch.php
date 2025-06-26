<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="au theme template">
    <meta name="author" content="Hau Nguyen">
    <meta name="keywords" content="au theme template">

    <!-- Title Page-->
    <title>Dashboard 3</title>

    <!-- Fontfaces CSS-->
    <link href="css/font-face.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-5/css/fontawesome-all.min.css" rel="stylesheet" media="all">
    <link href="vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">

    <!-- Bootstrap CSS-->
    <link href="vendor/bootstrap-4.1/bootstrap.min.css" rel="stylesheet" media="all">

    <!-- Vendor CSS-->
    <link href="vendor/animsition/animsition.min.css" rel="stylesheet" media="all">
    <link href="vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet" media="all">
    <link href="vendor/wow/animate.css" rel="stylesheet" media="all">
    <link href="vendor/css-hamburgers/hamburgers.min.css" rel="stylesheet" media="all">
    <link href="vendor/slick/slick.css" rel="stylesheet" media="all">
    <link href="vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="vendor/perfect-scrollbar/perfect-scrollbar.css" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="css/theme.css" rel="stylesheet" media="all">

    <style>
    .header-desktop3 {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      z-index: 999; /* stays on top of other content */
    }
    body {
        position: relative;
        margin: 0;
        padding: 0;
        min-height: 100vh;
        z-index: 0;
    }

    body:before {
        content: "";
        position: fixed;
        top: 0;
        left: 0;
        height: 100%;
        width: 100%;
        background-image: url('images/icon/01.webp');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        filter: blur(5px); 
        z-index: -1; 
    }
</style>
<script>
  function sendEmail(name) {
    alert('Sending email to ' + name);
  }

  function editRow(name) {
    alert('Editing profile for ' + name);
    // Open modal or redirect to edit page here
  }

  function deleteRow(btn) {
    const row = btn.closest('tr.tr-shadow');
    const name = row.querySelectorAll('td')[1].textContent;
    if (confirm('Delete record for ' + name + '?')) {
      row.nextElementSibling.remove(); // remove spacer
      row.remove(); // remove row
    }
  }

  function moreInfo(name) {
    alert('More info about ' + name);
  }
</script>

</head>
<body class="animsition">
    <div class="page-wrapper">
        <!-- HEADER DESKTOP-->
        <header class="header-desktop3 d-none d-lg-block">
            <div class="section__content section__content--p35">
                <div class="header4-wrap">
                    <div class="header__logo">
                        <a href="#">
                            <img src="images/icon/01111.png" alt="Catchmaster" />
                        </a>
                    </div>
                    <div class="header__navbar">
                        <ul class="list-unstyled">
                            <li class="has-sub">
                                <a href="index3.php">
                                    <i class="fas fa-tachometer-alt"></i>Dashboard
                                    <span class="bot-line"></span>
                                </a>
                                <ul class="header3-sub-list list-unstyled">
                                   
                                </ul>
                            </li>
                            <li>
                                <a href="fish_direct.php">
                                    <i class="fa fa-anchor" aria-hidden="true"></i>
                                    <span class="bot-line"></span>Fish Directory</a>
                            </li>
                            <li>
                                <a href="fish_catch.php">
                                    <i class="fas fa-shopping-basket"></i>
                                    <span class="bot-line"></span>Fish Catch</a>
                            </li>
                            <li class="has-sub">
                                    <a class="js-arrow" href="#">
                                        <i class="fas fa-copy"></i>
                                        <span class="bot-line"></span>User Management</a>
                                    <ul class="header3-sub-list list-unstyled">
                                        <li>
                                         <a href="fishermen_list.php">Fishermen</a>
                                        </li>
                                        <li>
                                            <a href="admin_list.php">Admin</a>
                                        </li>
                                    </ul>
                                </li>

                            <li>
                    </div>
                    <div class="header__tool">
                        <div class="header-button-item has-noti js-item-menu">
                            <i class="zmdi zmdi-notifications"></i>
                            <div class="notifi-dropdown notifi-dropdown--no-bor js-dropdown">
                                <div class="notifi__title">
                                    <p>You have 3 Notifications</p>
                                </div>
                                <div class="notifi__item">
                                    <div class="bg-c1 img-cir img-40">
                                        <i class="zmdi zmdi-email-open"></i>
                                    </div>
                                    <div class="content">
                                        <p>You got a email notification</p>
                                        <span class="date">April 12, 2018 06:50</span>
                                    </div>
                                </div>
                                <div class="notifi__item">
                                    <div class="bg-c2 img-cir img-40">
                                        <i class="zmdi zmdi-account-box"></i>
                                    </div>
                                    <div class="content">
                                        <p>Your account has been blocked</p>
                                        <span class="date">April 12, 2018 06:50</span>
                                    </div>
                                </div>
                                <div class="notifi__item">
                                    <div class="bg-c3 img-cir img-40">
                                        <i class="zmdi zmdi-file-text"></i>
                                    </div>
                                    <div class="content">
                                        <p>You got a new file</p>
                                        <span class="date">April 12, 2018 06:50</span>
                                    </div>
                                </div>
                                <div class="notifi__footer">
                                    <a href="#">All notifications</a>
                                </div>
                            </div>
                        </div>
                        <div class="header-button-item js-item-menu">
                            <i class="zmdi zmdi-settings"></i>
                            <div class="setting-dropdown js-dropdown">
                                <div class="account-dropdown__body">
                                    <div class="account-dropdown__item">
                                        <a href="profile.html">
                                            <i class="zmdi zmdi-account"></i>Account</a>
                                    </div>
                                    <div class="account-dropdown__item">
                                        <a href="#">
                                            <i class="zmdi zmdi-settings"></i>Setting</a>
                                    </div>
                                    <div class="account-dropdown__item">
                                        <a href="#">
                                            <i class="zmdi zmdi-money-box"></i>Billing</a>
                                    </div>
                                </div>
                                <div class="account-dropdown__body">
                                    <div class="account-dropdown__item">
                                        <a href="#">
                                            <i class="zmdi zmdi-globe"></i>Language</a>
                                    </div>
                                    <div class="account-dropdown__item">
                                        <a href="#">
                                            <i class="zmdi zmdi-pin"></i>Location</a>
                                    </div>
                                    <div class="account-dropdown__item">
                                        <a href="#">
                                            <i class="zmdi zmdi-email"></i>Email</a>
                                    </div>
                                    <div class="account-dropdown__item">
                                        <a href="#">
                                            <i class="zmdi zmdi-notifications"></i>Notifications</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="account-wrap">
                            <div class="account-item account-item--style2 clearfix js-item-menu">
                                <div class="image">
                                    <img src="images/icon/avatar-01.jpg" alt="John Doe" />
                                </div>
                                <div class="content">
                                    <a class="js-acc-btn" href="#">john doe</a>
                                </div>
                                <div class="account-dropdown js-dropdown">
                                    <div class="info clearfix">
                                        <div class="image">
                                            <a href="#">
                                                <img src="images/icon/01.webp" alt="John Doe" />
                                            </a>
                                        </div>
                                        <div class="content">
                                            <h5 class="name">
                                                <a href="#">john doe</a>
                                            </h5>
                                            <span class="email">johndoe@example.com</span>
                                        </div>
                                    </div>
                                    <div class="account-dropdown__body">
                                        <div class="account-dropdown__item">
                                            <a href="profile.html">
                                                <i class="zmdi zmdi-account"></i>Account</a>
                                        </div>
                                        <div class="account-dropdown__item">
                                            <a href="#">
                                                <i class="zmdi zmdi-settings"></i>Setting</a>
                                        </div>
                                        <div class="account-dropdown__item">
                                            <a href="#">
                                                <i class="zmdi zmdi-money-box"></i>Billing</a>
                                        </div>
                                    </div>
                                    <div class="account-dropdown__footer">
                                        <a href="#">
                                            <i class="zmdi zmdi-power"></i>Logout</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- END HEADER DESKTOP-->

        <!-- HEADER MOBILE-->
        <header class="header-mobile header-mobile-2 d-block d-lg-none">
            <div class="header-mobile__bar">
                <div class="container-fluid">
                    <div class="header-mobile-inner">
                        <a class="logo" href="index.html">
                            <img src="images/icon/02.jpg" alt="Catchmaster" />
                        </a>
                        <button class="hamburger hamburger--slider" type="button">
                            <span class="hamburger-box">
                                <span class="hamburger-inner"></span>
                            </span>
                        </button>
                    </div>
                </div>
            </div>
            <nav class="navbar-mobile">
                <div class="container-fluid">
                    <ul class="navbar-mobile__list list-unstyled">
                        <li class="has-sub">
                            <a class="js-arrow" href="#">
                                <i class="fas fa-tachometer-alt"></i>Dashboard</a>
                            <ul class="navbar-mobile-sub__list list-unstyled js-sub-list">
                                <li>
                                    <a href="index.html">Dashboard 3</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="chart.html">
                                <i class="fas fa-chart-bar"></i>Charts</a>
                        </li>
                        <li>
                            <a href="table.html">
                                <i class="fas fa-table"></i>Tables</a>
                        </li>
                        <li>
                            <a href="form.html">
                                <i class="far fa-check-square"></i>Forms</a>
                        </li>
                        <li>
                            <a href="calendar.html">
                                <i class="fas fa-calendar-alt"></i>Calendar</a>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <div class="sub-header-mobile-2 d-block d-lg-none">
            <div class="header__tool">
                <div class="header-button-item has-noti js-item-menu">
                    <i class="zmdi zmdi-notifications"></i>
                    <div class="notifi-dropdown notifi-dropdown--no-bor js-dropdown">
                        <div class="notifi__title">
                            <p>You have 3 Notifications</p>
                        </div>
                        <div class="notifi__item">
                            <div class="bg-c1 img-cir img-40">
                                <i class="zmdi zmdi-email-open"></i>
                            </div>
                            <div class="content">
                                <p>You got a email notification</p>
                                <span class="date">April 12, 2018 06:50</span>
                            </div>
                        </div>
                        <div class="notifi__item">
                            <div class="bg-c2 img-cir img-40">
                                <i class="zmdi zmdi-account-box"></i>
                            </div>
                            <div class="content">
                                <p>Your account has been blocked</p>
                                <span class="date">April 12, 2018 06:50</span>
                            </div>
                        </div>
                        <div class="notifi__item">
                            <div class="bg-c3 img-cir img-40">
                                <i class="zmdi zmdi-file-text"></i>
                            </div>
                            <div class="content">
                                <p>You got a new file</p>
                                <span class="date">April 12, 2018 06:50</span>
                            </div>
                        </div>
                        <div class="notifi__footer">
                            <a href="#">All notifications</a>
                        </div>
                    </div>
                </div>
                <div class="header-button-item js-item-menu">
                    <i class="zmdi zmdi-settings"></i>
                    <div class="setting-dropdown js-dropdown">
                        <div class="account-dropdown__body">
                            <div class="account-dropdown__item">
                                <a href="#">
                                    <i class="zmdi zmdi-account"></i>Account</a>
                            </div>
                            <div class="account-dropdown__item">
                                <a href="#">
                                    <i class="zmdi zmdi-settings"></i>Setting</a>
                            </div>
                            <div class="account-dropdown__item">
                                <a href="#">
                                    <i class="zmdi zmdi-money-box"></i>Billing</a>
                            </div>
                        </div>
                        <div class="account-dropdown__body">
                            <div class="account-dropdown__item">
                                <a href="#">
                                    <i class="zmdi zmdi-globe"></i>Language</a>
                            </div>
                            <div class="account-dropdown__item">
                                <a href="#">
                                    <i class="zmdi zmdi-pin"></i>Location</a>
                            </div>
                            <div class="account-dropdown__item">
                                <a href="#">
                                    <i class="zmdi zmdi-email"></i>Email</a>
                            </div>
                            <div class="account-dropdown__item">
                                <a href="#">
                                    <i class="zmdi zmdi-notifications"></i>Notifications</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="account-wrap">
                    <div class="account-item account-item--style2 clearfix js-item-menu">
                        <div class="image">
                            <img src="images/icon/avatar-01.jpg" alt="John Doe" />
                        </div>
                        <div class="content">
                            <a class="js-acc-btn" href="#">john doe</a>
                        </div>
                        <div class="account-dropdown js-dropdown">
                            <div class="info clearfix">
                                <div class="image">
                                    <a href="#">
                                        <img src="images/icon/avatar-01.jpg" alt="John Doe" />
                                    </a>
                                </div>
                                <div class="content">
                                    <h5 class="name">
                                        <a href="#">john doe</a>
                                    </h5>
                                    <span class="email">johndoe@example.com</span>
                                </div>
                            </div>
                            <div class="account-dropdown__body">
                                <div class="account-dropdown__item">
                                    <a href="#">
                                        <i class="zmdi zmdi-account"></i>Account</a>
                                </div>
                                <div class="account-dropdown__item">
                                    <a href="#">
                                        <i class="zmdi zmdi-settings"></i>Setting</a>
                                </div>
                                <div class="account-dropdown__item">
                                    <a href="#">
                                        <i class="zmdi zmdi-money-box"></i>Billing</a>
                                </div>
                            </div>
                            <div class="account-dropdown__footer">
                                <a href="#">
                                    <i class="zmdi zmdi-power"></i>Logout</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>    

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
                                <form class="modal-content" action="functions/add-func/table.html" method="post" enctype="multipart/form-data" novalidate>
                                <div class="modal-header">
                                    <h5 class="modal-title" id="fisherModalLabel">Add Fish Catch</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" title="Close modal">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>

                                <div class="modal-body">
                                    <!-- Select Fish -->
                                    <div class="form-group">
                                    <label for="speciesName">Select Fish <span class="text-danger">*</span></label>
                                    <select class="form-control" id="speciesName" name="species_name" required>
                                        <option value="" disabled selected>Select species</option>
                                        <option value="Tilapia">Tilapia</option>
                                        <option value="Bangus">Bangus</option>
                                        <option value="Tuna">Tuna</option>
                                        <option value="Salmon">Salmon</option>
                                        <option value="Sardines">Sardines</option>
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

                                    <!-- Image -->
                                    <div class="form-group">
                                    <label for="fishImage">Fish Image</label>
                                    <input type="file" class="form-control-file" id="fishImage" name="image" accept="image/*">
                                    <small class="form-text text-muted">Upload an image (optional).</small>
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
                                        <tr class="tr-shadow">
                                            <tbody>
    <tr class="tr-shadow">
        <td>
            <label class="au-checkbox">
                <input type="checkbox">
                <span class="au-checkmark"></span>
            </label>
        </td>
        <td>tulingan</td>
        <td>1</td>
        <td>agdangan</td>
        <td>2025/06/28-3:00pm</td>
        
        <td>
            <div class="table-data-feature">
                <button class="item" title="Send" onclick="sendEmail('Ruby')">
                    <i class="zmdi zmdi-mail-send"></i>
                </button>
                <button class="item" title="Edit" onclick="editRow('Ruby')">
                    <i class="zmdi zmdi-edit"></i>
                </button>
                <button class="item" title="Delete" onclick="deleteRow(this)">
                    <i class="zmdi zmdi-delete"></i>
                </button>
                <button class="item" title="More" onclick="moreInfo('Ruby')">
                    <i class="zmdi zmdi-more"></i>
                </button>
            </div>
        </td>
    </tr>
    <tr class="spacer"></tr>

    <!-- More rows below (example) -->
    <tr class="tr-shadow">
        <td><label class="au-checkbox"><input type="checkbox"><span class="au-checkmark"></span></label></td>
        <td>tulingan</td>
        <td>1</td>
        <td>agdangan</td>
        <td>2025/06/28-3:00pm</td>
        
        <td>
            <div class="table-data-feature">
                <button class="item" title="Send" onclick="sendEmail('Luna')">
                    <i class="zmdi zmdi-mail-send"></i>
                </button>
                <button class="item" title="Edit" onclick="editRow('Luna')">
                    <i class="zmdi zmdi-edit"></i>
                </button>
                <button class="item" title="Delete" onclick="deleteRow(this)">
                    <i class="zmdi zmdi-delete"></i>
                </button>
                <button class="item" title="More" onclick="moreInfo('Luna')">
                    <i class="zmdi zmdi-more"></i>
                </button>
            </div>
        </td>
    </tr>
    <tr class="spacer"></tr>

    <tr class="tr-shadow">
        <td><label class="au-checkbox"><input type="checkbox"><span class="au-checkmark"></span></label></td>
        <td>tulingan</td>
        <td>1</td>
        <td>agdangan</td>
        <td>2025/06/28-3:00pm</td>
        <td>
            <div class="table-data-feature">
                <button class="item" title="Send" onclick="sendEmail('Enzo')">
                    <i class="zmdi zmdi-mail-send"></i>
                </button>
                <button class="item" title="Edit" onclick="editRow('Enzo')">
                    <i class="zmdi zmdi-edit"></i>
                </button>
                <button class="item" title="Delete" onclick="deleteRow(this)">
                    <i class="zmdi zmdi-delete"></i>
                </button>
                <button class="item" title="More" onclick="moreInfo('Enzo')">
                    <i class="zmdi zmdi-more"></i>
                </button>
            </div>
        </td>
    </tr>
</tbody>
                     
                                <!-- END DATA TABLE -->

                        
                    </div>
                </div>
            </div>
        </div>

    </div>
    <script>
                        function showModal() {
                            $('#fisherModal').modal('show'); 
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
