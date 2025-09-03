<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href='css/header.css' rel="stylesheet">
    <link href='css/setting.css' rel="stylesheet">
    <?php include 'header.php'; ?>
    <title>Settings</title>
    
</head>
<body>
    <h1>Settings</h1>

    <div class="cards-container">
        <!-- USER GUIDE CARD -->
        <div class="card">
            <div class="card-image">
                <img src="images/icon/user.png" alt="User Guide" />
            </div>
            <div class="card-content">
                <h2 class="card-title">User Guide</h2>
                <p class="card-description">Step-by-step instructions on how to use the Fish Catch Monitoring System.</p>
                <button class="card-button" data-open="userGuideModal">View</button>
            </div>
        </div>

        <!-- HELP CENTER CARD -->
        <div class="card">
            <div class="card-image">
                <img src="images/icon/help.jpg" alt="Help Center" />
            </div>
            <div class="card-content">
                <h2 class="card-title">Help Center</h2>
                <p class="card-description">Answers to questions about scanning, data storage, and troubleshooting.</p>
                <button class="card-button" data-open="helpCenterModal">View</button>
            </div>
        </div>

        <!-- ABOUT US CARD -->
        <div class="card">
            <div class="card-image">
                <img src="images/icon/us.jpg" alt="About Us" />
            </div>
            <div class="card-content">
                <h2 class="card-title">About Us</h2>
                <p class="card-description">Learn about our mission to support sustainable fishing practices.</p>
                <button class="card-button" data-open="aboutUsModal">View</button>
            </div>
        </div>
    </div>

    <!-- MODALS -->
    <div class="modal" id="userGuideModal">
        <div class="modal-content" tabindex="-1">
            <span class="close" data-modal="userGuideModal">&times;</span>
            <h2 class="modal-title">User Guide</h2>
            <p class="modal-intro">Learn how to use the Fish Catch Monitoring System from start to finish.</p>
            <p>This guide walks you through scanning fish, uploading data, and reviewing your catch history.</p>
        </div>
    </div>

    <div class="modal" id="helpCenterModal">
        <div class="modal-content" tabindex="-1">
            <span class="close" data-modal="helpCenterModal">&times;</span>
            <h2 class="modal-title">Help Center</h2>
            <p class="modal-intro">Need help? Below are answers to common questions:</p>
            <div class="faq-list">
                <div class="faq-item">
                    <h3>📸 <span>How do I scan a fish catch?</span></h3>
                    <p>Use the scanner or camera and ensure the fish is centered and well-lit.</p>
                </div>
                <div class="faq-item">
                    <h3>💾 <span>Where is the fish data stored?</span></h3>
                    <p>All data is securely saved in the system database with timestamps.</p>
                </div>
                <div class="faq-item">
                    <h3>🐠 <span>What fish types are supported?</span></h3>
                    <p>Common types like tilapia, bangus, galunggong, and tuna.</p>
                </div>
                <div class="faq-item">
                    <h3>📈 <span>How to view catch records?</span></h3>
                    <p>Go to Dashboard → Catch Records and filter by date/type.</p>
                </div>
                <div class="faq-item">
                    <h3>⚠️ <span>If scanning fails?</span></h3>
                    <p>Check lighting/camera, retry, or restart the module.</p>
                </div>
                <div class="faq-item">
                    <h3>🔐 <span>Who can access?</span></h3>
                    <p>Only verified users with login credentials.</p>
                </div>
                <div class="faq-item">
                    <h3>🛠 <span>Need support?</span></h3>
                    <p>Email <a href="mailto:support@fishmonitor.com">support@fishmonitor.com</a>.</p>
                </div>
            </div>
        </div>
    </div>

    <div class="modal" id="aboutUsModal">
        <div class="modal-content" tabindex="-1">
            <span class="close" data-modal="aboutUsModal">&times;</span>
            <h2 class="modal-title">About Us</h2>
            <p class="modal-intro">We are a team of developers and marine experts building tools for sustainable fishing.</p>
            <p>Our system simplifies catch tracking, supports local fisheries, and helps protect marine ecosystems.</p>
            <p><strong>Version:</strong> 1.0.0</p>
            <p><strong>Contact:</strong> <a href="#">Click here to reach us</a>.</p>
        </div>
    </div>

    <script>
        document.querySelectorAll('[data-open]').forEach(button => {
            button.addEventListener('click', () => {
                const modalId = button.getAttribute('data-open');
                const modal = document.getElementById(modalId);
                modal.style.display = 'block';
                modal.querySelector('.modal-content').focus();
            });
        });

        document.querySelectorAll('.close').forEach(close => {
            close.addEventListener('click', () => {
                const modalId = close.getAttribute('data-modal');
                document.getElementById(modalId).style.display = 'none';
            });
        });
    </script>
</body>
</html>
