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
    <title>CatchMaster Agdangan</title>

    <!-- Fontfaces CSS-->
    <link href="css/font-face.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-5/css/fontawesome-all.min.css" rel="stylesheet" media="all">
    <link href="vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">

    <!-- Bootstrap CSS-->
    <link href="vendor/bootstrap-4.1/bootstrap.min.css" rel="stylesheet" media="all">

    <!-- Vendor CSS-->

    <link href="vendor/wow/animate.css" rel="stylesheet" media="all">
    <link href="vendor/css-hamburgers/hamburgers.min.css" rel="stylesheet" media="all">
    <link href="vendor/slick/slick.css" rel="stylesheet" media="all">
    <link href="vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="vendor/perfect-scrollbar/perfect-scrollbar.css" rel="stylesheet" media="all">

    <link href="css/theme.css" rel="stylesheet" media="all">
    <style>
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
        background: #b6b6b6;
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        filter: blur(5px); 
        z-index: -1; 
    }
    .header-desktop3 {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        z-index: 999; 
        }
        .content-wrapper {
        margin-top: 100px; 
        }
        .account-dropdown {
            z-index: 1000;
            position: absolute;
        }
        .settings-dropdown__item {
            padding: 8px 12px;
        }
        .settings-dropdown__item a {
            color: #333;
            text-decoration: none;
            display: block;
        }
        .settings-dropdown__item a:hover {
            background-color: #f1f1f1;
            border-radius: 4px;
        }
        .header-button-item.has-noti {
            margin-right: 10px;
        }
        /* Move notification icon only */
.header-button-item.has-noti i.zmdi-notifications {
    margin-right: 8px;      /* Optional: add spacing between icon and dropdown */
    transform: translateX(-10px);
}

/* Move settings icon only */
.header-button-item.js-settings-menu i.zmdi-settings {
    margin-right: 8px;      /* Optional */
    transform: translateX(-10px);
}

       
        .notifi-dropdown {
            width: 300px;
            max-width: 90vw;
            position: absolute;
            top: calc(100% + 10px);
            right: 0;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            max-height: 400px;
            overflow-y: auto;
            box-sizing: border-box;
            z-index: 1000;
            opacity: 0;
            visibility: hidden;
            transition: opacity 0.3s ease, visibility 0.3s ease;
        }

        .js-item-menu:hover .notifi-dropdown,
        .js-item-menu.active .notifi-dropdown {
            opacity: 1;
            visibility: visible;
        }

        /* Fix overflow on small screens */
        @media (max-width: 768px) {
            .notifi-dropdown {
                width: 85vw;
                left: 50%;
                transform: translateX(-50%);
                right: auto;
            }
        }


</style>



</head>
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

<body>
    <?php include 'notifications/messages.php'?>
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
                                <a href="index.php">
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
                              <li>
                                <a href="fishermen_list.php">
                                    <i class="fas fa-users"></i>
                                    <span class="bot-line"></span>User Management</a>
                            </li> 
                        </ul>
                    </div>
                    <div class="header__tool">
                       <div class="header-button-item has-noti js-item-menu" style="position: relative;">
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
                       <!-- Settings Icon -->
<div class="header-button-item js-settings-menu" style="position: relative;">
    <a href="#" title="Settings" class="js-settings-btn" style="color: inherit; text-decoration: none;">
        <i class="zmdi zmdi-settings"></i>
    </a>
    <div class="settings-dropdown js-settings-dropdown" style="display: none; position: absolute; right: 0; top: 100%; background: #fff; box-shadow: 0 5px 10px rgba(0,0,0,0.1); border-radius: 8px; padding: 10px; min-width: 200px; font-size: 14px;">
        <div class="settings-dropdown__item">
            <a href="settings.php"><i class="zmdi zmdi-settings"></i> Settings</a>
        </div>
    </div>
</div>

<!-- Profile Icon -->
<div class="header-button-item js-profile-menu" style="position: relative;">
    <a href="#" title="Profile" class="js-profile-btn" style="color: inherit; text-decoration: none;">
        <i class="zmdi zmdi-account-circle"></i>
    </a>
    <div class="profile-dropdown js-profile-dropdown"
        style="
            display: none;
            position: absolute;
            right: 0;
            top: 100%;
            background: #fff;
            box-shadow: 0 5px 10px rgba(0,0,0,0.1);
            border-radius: 8px;
            padding: 8px 12px;
            font-size: 14px;
            color: black;
            white-space: nowrap;
        ">
        <div class="profile-dropdown__item" style="padding: 8px 0;">
            <a href="profile-test.php" style="text-decoration: none; color: black;">
                <i class="zmdi zmdi-account"></i> Account Setting
            </a>
        </div>
        <div class="profile-dropdown__item" style="padding: 6px 0;">
            <a href="functions/sessions/admin-logout.php" style="text-decoration: none; color: black;">
                <i class="zmdi zmdi-power"></i> Logout
            </a>
        </div>
    </div>
</div>
                    </div>
                </div>
            </div>
        </header>

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

            // Removed automatic modal display
        }, false);
    })();

                // Function to show the modal
                function showModal() {
                    $('#fisherModal').modal('show');
                }

                function redirectToTable() {
                    // Redirect to the table file (replace 'table.html' with your actual file name)
                    window.location.href = 'table.html';
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
                            </style>
                            </head>
                            <body style="background-color: lightgray; min-height: 100vh;">


    <!-- Jquery JS-->
    <script src="vendor/jquery-3.2.1.min.js"></script>
    <!-- Bootstrap JS-->
    <script src="vendor/bootstrap-4.1/popper.min.js"></script>
    <script src="vendor/bootstrap-4.1/bootstrap.min.js"></script>
    <!-- Vendor JS       -->
    <script src="vendor/slick/slick.min.js">
    </script>
    <script src="vendor/wow/wow.min.js"></script>
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
document.addEventListener("DOMContentLoaded", function () {
    const settingsBtn = document.querySelector(".js-settings-btn");
    const dropdown = document.querySelector(".js-settings-dropdown");

    settingsBtn.addEventListener("click", function (e) {
        e.preventDefault();
        dropdown.style.display = (dropdown.style.display === "block") ? "none" : "block";
    });

    document.addEventListener("click", function (e) {
        const settingsMenu = document.querySelector(".js-settings-menu");
        if (!settingsMenu.contains(e.target)) {
            dropdown.style.display = "none";
        }
    });
});
</script>

<script>
document.addEventListener("DOMContentLoaded", function () {
    const menuItem = document.querySelector(".js-item-menu");
    const dropdown = document.querySelector(".notifi-dropdown");

    menuItem.addEventListener("click", () => {
        const rect = dropdown.getBoundingClientRect();

        // If dropdown is going off screen
        if (rect.right > window.innerWidth) {
            dropdown.style.left = 'auto';
            dropdown.style.right = '0';
        }

        if (rect.left < 0) {
            dropdown.style.left = '0';
            dropdown.style.right = 'auto';
        }
    });
});
</script>

<script>
    // Toggle settings dropdown
    document.querySelector('.js-settings-btn')?.addEventListener('click', function (e) {
        e.preventDefault();
        document.querySelector('.js-settings-dropdown').style.display ^= 'block';
    });

    // Toggle profile dropdown
    document.querySelector('.js-profile-btn')?.addEventListener('click', function (e) {
        e.preventDefault();
        document.querySelector('.js-profile-dropdown').style.display ^= 'block';
    });

    // Optional: click outside to close
    document.addEventListener('click', function (e) {
        if (!e.target.closest('.js-settings-menu')) {
            document.querySelector('.js-settings-dropdown')?.style.display = 'none';
        }
        if (!e.target.closest('.js-profile-menu')) {
            document.querySelector('.js-profile-dropdown')?.style.display = 'none';
        }
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const profileBtn = document.querySelector('.js-profile-btn');
        const profileDropdown = document.querySelector('.js-profile-dropdown');

        // Toggle the dropdown on click
        profileBtn.addEventListener('click', function (e) {
            e.preventDefault();
            profileDropdown.style.display = 
                profileDropdown.style.display === 'block' ? 'none' : 'block';
        });

        // Close the dropdown if clicking outside
        document.addEventListener('click', function (e) {
            if (!e.target.closest('.js-profile-menu')) {
                profileDropdown.style.display = 'none';
            }
        });
    });
</script>


</body>

</html>

