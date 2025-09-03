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
<?php include 'notifications/messages.php';?>
<?php
include 'functions/fetch-func/fetch-top-barangay.php';
$topBarangays = getTopBarangays(5);
?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fisheries Dashboard</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.6.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="css\index.css" rel="stylesheet">
    <link href="css/header.css" rel="stylesheet">
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
                <span>Dashboard</span>
            </nav>
            <div class="search-container">
                <input
                    id="globalSearch"
                    class="modern-search"
                    type="text"
                    placeholder="Search for data & reports..."
                >
                <button class="search-btn" type="button">
                    <i class="fas fa-search"></i>
                </button>
                <div id="searchResults" class="search-results" style="display: none;"></div>
            </div>
        </div>
    </div>

    <!-- Welcome Section -->
    <div class="welcome-section">
        <h1 class="welcome-title">Welcome back!</h1>
        <hr class="welcome-divider">
    </div>

    <!-- Statistics Cards -->
    <div class="stats-grid">
        <div class="stat-card green">
            <div class="stat-content">
                <div class="stat-info">
                    <h2><?php include 'functions/dashboard/count-fishermen.php'; echo htmlspecialchars($count); ?></h2>
                    <span class="desc">Head Fishermen</span>
                </div>
                <a href="fishermen_list.php">
                <div class="stat-icon">
                    <i class="fas fa-users"></i>
                </div>
                </a>
            </div>
        </div>

        <div class="stat-card orange">
            <div class="stat-content">
                <div class="stat-info">
                    <h2><?php include 'functions/dashboard/count-catch.php'; ?></h2>
                    <span class="desc">Fish Catch</span>
                </div>
                <a href="fish_catch.php">
                <div class="stat-icon">
                    <i class="fas fa-fish"></i>
                </div>
                </a>
            </div>
        </div>

        <div class="stat-card blue">
            <div class="stat-content">
                <div class="stat-info">
                    <h2><?php include 'functions/dashboard/weekly-fish-count.php'; ?></h2>
                    <span class="desc">This Week</span>
                </div>
                <div class="stat-icon">
                    <i class="fas fa-calendar-week"></i>
                </div>
            </div>
        </div>

        <div class="stat-card red">
            <div class="stat-content">
                <div class="stat-info">
                    <h2><?php include 'functions/dashboard/top-fish.php'?></h2>
                    <span class="desc">Top Fish</span>
                </div>
                <div class="stat-icon">
                    <i class="fas fa-trophy"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts Section -->
    <div class="charts-section">
        <h3 class="section-title">Analytics & Statistics</h3>
        
        <div class="charts-grid">
            <!-- Chart 1 -->
            <div class="chart-card">
                <div class="chart-header">
                    <h4 class="chart-title">Fish Catch Overview</h4>
                </div>
                <div class="chart-content">
                    <div class="chart-wrap">
                        <canvas id="widgetChart5"></canvas>
                    </div>
                    <div class="chart-note">
                        <span class="big">10,368</span>
                        <span>/ 16,220 fish catched</span>
                    </div>
                </div>
            </div>

            <!-- Top Places -->
            <div class="chart-card">
                <div class="chart-header">
                    <h4 class="chart-title">Top Fishing Locations</h4>
                </div>
                <div class="chart-content">
                    <div class="table-responsive">
                        <table class="top-places-table">
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
            </div>

            <!-- Percentage Chart -->
            <div class="chart-card">
                <div class="chart-header">
                    <h4 class="chart-title">Distribution Analysis</h4>
                </div>
                <div class="chart-content">
                    <div class="chart-wrap">
                        <canvas id="percent-chart2"></canvas>
                        <div id="chartjs-tooltip">
                            <table></table>
                        </div>
                    </div>
                    <div class="chart-legend">
                        <div class="legend-item">
                            <div class="legend-dot blue"></div>
                            <span class="legend-label">Products</span>
                        </div>
                        <div class="legend-item">
                            <div class="legend-dot red"></div>
                            <span class="legend-label">Services</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Scripts -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="vendor/bootstrap-4.1/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.6.2/js/bootstrap.min.js"></script>
<script src="vendor/chartjs/Chart.bundle.min.js"></script>

<script>
function capitalizeInput(input) {
    const words = input.value.split(' ');
    input.value = words
        .map(word => word.charAt(0).toUpperCase() + word.slice(1).toLowerCase())
        .join(' ');
}

// Search functionality
let searchTimeout;
document.getElementById('globalSearch').addEventListener('input', function() {
    const query = this.value.trim();
    const resultsContainer = document.getElementById('searchResults');

    clearTimeout(searchTimeout);

    if(query.length < 2) {
        resultsContainer.style.display = 'none';
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
                        html += `<div class="search-result-item">
                                    <strong>${item.type}:</strong> ${item.title}<br>
                                    <small style="color: #64748b;">${item.details}</small>
                                </div>`;
                    });
                } else {
                    html = '<div class="search-result-item">No results found.</div>';
                }
                resultsContainer.innerHTML = html;
                resultsContainer.style.display = 'block';
            })
            .catch(error => {
                console.error('Search error:', error);
                resultsContainer.innerHTML = '<div class="search-result-item">Error occurred while searching.</div>';
                resultsContainer.style.display = 'block';
            });
    }, 300);
});

// Hide search results when clicking outside
document.addEventListener('click', function(e) {
    const searchContainer = document.querySelector('.search-container');
    const searchResults = document.getElementById('searchResults');
    
    if (!searchContainer.contains(e.target)) {
        searchResults.style.display = 'none';
    }
});

// Initialize charts when page loads
document.addEventListener('DOMContentLoaded', function() {
    // Sample chart for fish catch overview
    const ctx1 = document.getElementById('widgetChart5');
    if (ctx1) {
        new Chart(ctx1, {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
                datasets: [{
                    label: 'Fish Catch (kg)',
                    data: [1200, 1900, 1500, 2200, 2800, 2100],
                    borderColor: '#4f46e5',
                    backgroundColor: 'rgba(79, 70, 229, 0.1)',
                    borderWidth: 3,
                    fill: true,
                    tension: 0.4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: '#e2e8f0'
                        }
                    },
                    x: {
                        grid: {
                            color: '#e2e8f0'
                        }
                    }
                }
            }
        });
    }

    // Sample percentage chart
    const ctx2 = document.getElementById('percent-chart2');
    if (ctx2) {
        new Chart(ctx2, {
            type: 'doughnut',
            data: {
                labels: ['Products', 'Services'],
                datasets: [{
                    data: [65, 35],
                    backgroundColor: ['#3b82f6', '#ef4444'],
                    borderWidth: 0
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                cutout: '70%'
            }
        });
    }
});
</script>


</body>
</html>