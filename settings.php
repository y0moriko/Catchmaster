<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <?php include 'header.php'; ?>
    <title>Settings</title>
    <style>
        :root {
            --primary: #4361ee;
            --secondary: #3f37c9;
            --accent: #4895ef;
            --light: #f8f9fa;
            --dark: #212529;
            --gray: #6c757d;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background: linear-gradient(to right, #f5f7ff, #e8f0ff);
            padding: 2rem;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        h1 {
            background: linear-gradient(to right, var(--dark), var(--dark));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            font-size: 3rem;
            text-align: center;
            margin-bottom: 2rem;
            padding-top: 100px;
            position: relative;
        }

        h1::after {
            content: '';
            position: absolute;
            width: 80px;
            height: 4px;
            background-color: var(--dark);
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            border-radius: 2px;
        }

        .cards-container {
            display: flex;
            flex-wrap: wrap;
            gap: 2rem;
            justify-content: center;
            max-width: 1200px;
        }

        .card {
            background: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            width: 350px;
            transition: all 0.3s ease;
        }

        .card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(67, 97, 238, 0.2);
        }

        .card-image {
            height: 200px;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #f0f0f0;
        }

        .card-image img {
            max-width: 100%;
            max-height: 100%;
            padding: 10px;
            object-fit: contain;
        }

        .card-content {
            padding: 1.5rem;
        }

        .card-title {
            font-size: 1.5rem;
            font-weight: bold;
            color: var(--dark);
            margin-bottom: 0.5rem;
        }

        .card-description {
            color: var(--gray);
            font-size: 0.95rem;
            line-height: 1.5;
            margin-bottom: 1.2rem;
        }

        .card-button {
            display: inline-block;
            padding: 0.75rem 1.5rem;
            background: linear-gradient(to right, var(--primary), var(--accent));
            color: white;
            border-radius: 30px;
            border: none;
            cursor: pointer;
            transition: all 0.3s ease;
            font-weight: bold;
            box-shadow: 0 4px 10px rgba(67, 97, 238, 0.3);
        }

        .card-button:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 16px rgba(67, 97, 238, 0.4);
        }

        /* Modal Styling */
        .modal {
            display: none;
            position: fixed;
            z-index: 999;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0,0,0,0.6);
            padding: 60px 0;
        }

        .modal-content {
            margin: auto;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 12px;
            width: 90%;
            max-width: 800px;
            max-height: 80vh;
            padding: 2rem;
            overflow-y: auto;
            position: relative;
            color: var(--dark);
            animation: fadeIn 0.3s ease;
        }

        .modal-content::-webkit-scrollbar {
            width: 8px;
        }

        .modal-content::-webkit-scrollbar-thumb {
            background: var(--accent);
            border-radius: 5px;
        }

        .close {
            position: absolute;
            top: 15px;
            right: 20px;
            font-size: 28px;
            font-weight: bold;
            color: #aaa;
            cursor: pointer;
        }

        .close:hover {
            color: black;
        }

        .modal-title {
            font-size: 2rem;
            margin-bottom: 1rem;
            color: var(--dark);
        }

        .modal-intro {
            color: var(--gray);
            font-size: 1rem;
            margin-bottom: 2rem;
        }

        .faq-item {
            margin-bottom: 1.5rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid #ddd;
        }

        .faq-item h3 {
            font-size: 1.1rem;
            color: var(--dark);
            margin-bottom: 0.3rem;
            display: flex;
            align-items: center;
        }

        .faq-item h3 span {
            margin-left: 0.5rem;
        }

        .faq-item p {
            margin-left: 1.5rem;
            color: #333;
            font-size: 0.95rem;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: scale(0.95); }
            to { opacity: 1; transform: scale(1); }
        }

        @media (max-width: 768px) {
            .card {
                width: 100%;
                max-width: 350px;
            }
        }
    </style>
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
