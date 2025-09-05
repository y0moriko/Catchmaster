<?php include 'notifications/messages.php'?>

<!-- Modern Header -->
<header class="modern-header">
    <div class="header-container">
        <!-- Logo Section -->
        <div class="logo-section">
            <a href="index.php">
                <img src="images/icon/222.png" alt="CatchMaster" />
            </a>
            <a href="index.php" class="logo-text">CatchMaster</a>
        </div>

        <!-- Navigation Menu -->
        <nav class="nav-menu">
            <li class="nav-item">
                <a href="index.php" class="nav-link active">
                    <i class="fas fa-tachometer-alt"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="fish_direct.php" class="nav-link">
                    <i class="fas fa-fish"></i>
                    <span>Fish Directory</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="fish_catch.php" class="nav-link">
                    <i class="fas fa-shopping-basket"></i>
                    <span>Fish Catch</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="fishermen_list.php" class="nav-link">
                    <i class="fas fa-users"></i>
                    <span>User Management</span>
                </a>
            </li>
        </nav>

        <!-- Mobile Menu Toggle -->
        <button class="mobile-menu-toggle">
            <i class="fas fa-bars"></i>
        </button>

        <!-- Header Tools -->
        <div class="header-tools">
            <!-- Notifications -->
            <div class="header-tool-item notification-tool" data-dropdown="notifications">
                <i class="fas fa-bell"></i>
                <span class="notification-badge">3</span>
                
                <div class="dropdown-menu" id="notifications-dropdown">
                    <div class="dropdown-header">
                        <h6>You have 3 notifications</h6>
                    </div>
                    <div class="dropdown-body">
                        <a href="#" class="dropdown-item">
                            <div class="dropdown-icon email">
                                <i class="fas fa-envelope"></i>
                            </div>
                            <div class="dropdown-content">
                                <h6>New Email Notification</h6>
                                <small>You received a new message</small>
                            </div>
                        </a>
                        <a href="#" class="dropdown-item">
                            <div class="dropdown-icon account">
                                <i class="fas fa-user-shield"></i>
                            </div>
                            <div class="dropdown-content">
                                <h6>Account Update</h6>
                                <small>Your profile has been updated</small>
                            </div>
                        </a>
                        <a href="#" class="dropdown-item">
                            <div class="dropdown-icon file">
                                <i class="fas fa-file-alt"></i>
                            </div>
                            <div class="dropdown-content">
                                <h6>New Report Available</h6>
                                <small>Monthly fisheries report is ready</small>
                            </div>
                        </a>
                    </div>
                    <div class="dropdown-footer">
                        <a href="#">View all notifications</a>
                    </div>
                </div>
            </div>

            <!-- Settings -->
            <div class="header-tool-item settings-tool" data-dropdown="settings">
                <i class="fas fa-cog"></i>
                
                <div class="dropdown-menu settings-dropdown" id="settings-dropdown">
                    <a href="settings.php" class="simple-dropdown-item">
                        <i class="fas fa-cogs"></i>
                        <span>System Settings</span>
                    </a>
                    <a href="#" class="simple-dropdown-item">
                        <i class="fas fa-palette"></i>
                        <span>Appearance</span>
                    </a>
                    <a href="#" class="simple-dropdown-item">
                        <i class="fas fa-shield-alt"></i>
                        <span>Privacy & Security</span>
                    </a>
                </div>
            </div>

            <!-- Profile -->
            <div class="header-tool-item profile-tool" data-dropdown="profile">
                <i class="fas fa-user-circle"></i>
                
                <div class="dropdown-menu profile-dropdown" id="profile-dropdown">
                    <a href="profile-test.php" class="simple-dropdown-item">
                        <i class="fas fa-user-cog"></i>
                        <span>Account Settings</span>
                    </a>
                    <a href="#" class="simple-dropdown-item">
                        <i class="fas fa-heart"></i>
                        <span>Preferences</span>
                    </a>
                    <a href="settings.php" class="simple-dropdown-item">
                        <i class="fas fa-question-circle"></i>
                        <span>Help & Support</span>
                    </a>
                    <a href="#" class="simple-dropdown-item" id="logoutTrigger">
                        <i class="fas fa-sign-out-alt"></i>
                        <span>Logout</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</header>

<!-- Modal -->
    <div class="logout-modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="logoutModalLabel" aria-hidden="true">
    <div class="logout-modal-dialog logout-modal-dialog-centered" role="document">
        <div class="logout-modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="logoutModalLabel">
            <i class="fas fa-sign-out-alt mr-2"></i>Confirm Logout
            </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            Are you sure you want to logout? You will need to login again to access your account.
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            <a href="functions/sessions/admin-logout.php" class="btn btn-danger">
            <i class="fas fa-sign-out-alt mr-1"></i>Yes, Logout
            </a>
        </div>
        </div>
    </div>
    </div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Dropdown functionality
    const dropdownTriggers = document.querySelectorAll('[data-dropdown]');
    
    dropdownTriggers.forEach(trigger => {
        const dropdownId = trigger.getAttribute('data-dropdown');
        const dropdown = document.getElementById(dropdownId + '-dropdown');
        
        if (dropdown) {
            trigger.addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();
                
                // Close other dropdowns
                document.querySelectorAll('.dropdown-menu.show').forEach(menu => {
                    if (menu !== dropdown) {
                        menu.classList.remove('show');
                    }
                });
                
                // Toggle current dropdown
                dropdown.classList.toggle('show');
            });
        }
    });
    
    // Handle dropdown item clicks
    document.querySelectorAll('.simple-dropdown-item').forEach(item => {
        item.addEventListener('click', function(e) {
            e.stopPropagation();
        });
    });
    
    // Close dropdowns when clicking outside
    document.addEventListener('click', function(e) {
        if (!e.target.closest('[data-dropdown]')) {
            document.querySelectorAll('.dropdown-menu.show').forEach(menu => {
                menu.classList.remove('show');
            });
        }
    });
    
    // Active nav link highlighting
    const currentPage = window.location.pathname.split('/').pop();
    const navLinks = document.querySelectorAll('.nav-link');
    
    navLinks.forEach(link => {
        link.classList.remove('active');
        const href = link.getAttribute('href');
        if (href === currentPage || (currentPage === '' && href === 'index.php')) {
            link.classList.add('active');
        }
    });
});
    // Logout modal custom toggle
document.addEventListener('DOMContentLoaded', function() {
    const logoutTrigger = document.getElementById('logoutTrigger');
    const logoutModal = document.getElementById('logoutModal');

    if (logoutTrigger && logoutModal) {
        const closeBtns = logoutModal.querySelectorAll('[data-dismiss="modal"], .close');

        logoutTrigger.addEventListener('click', function(e) {
            e.preventDefault();
            logoutModal.classList.add('show');
            logoutModal.style.display = 'block';
            document.body.classList.add('modal-open');
        });

        closeBtns.forEach(btn => {
            btn.addEventListener('click', function() {
                logoutModal.classList.remove('show');
                logoutModal.style.display = 'none';
                document.body.classList.remove('modal-open');
            });
        });
    }
});

</script>
