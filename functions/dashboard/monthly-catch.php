<?php
include __DIR__ . '/../conn.php';

// Total fish caught this month
$sqlMonth = "SELECT SUM(quantity_kg) AS monthly_total FROM fishcatch WHERE MONTH(catch_date) = MONTH(CURDATE()) AND YEAR(catch_date) = YEAR(CURDATE())";
$resultMonth = mysqli_query($conn, $sqlMonth);
$monthlyTotal = mysqli_fetch_assoc($resultMonth)['monthly_total'] ?? 0;

// Total fish caught all time<?php
include 'functions/conn.php';

// Initialize array for 12 months
$monthlyCatch = array_fill(1, 12, 0);

// Fetch monthly totals
$sqlMonthly = "SELECT MONTH(catch_date) AS month, SUM(quantity_kg) AS total
               FROM fishcatch
               WHERE YEAR(catch_date) = YEAR(CURDATE())
               GROUP BY MONTH(catch_date)";
$result = mysqli_query($conn, $sqlMonthly);

while($row = mysqli_fetch_assoc($result)) {
    $month = (int)$row['month'];
    $monthlyCatch[$month] = (int)$row['total'];
}

// Current month total
$currentMonth = (int)date('n'); // 1-12
$monthlyTotal = $monthlyCatch[$currentMonth];

// Total fish caught this year
$yearlyTotal = array_sum($monthlyCatch);
?>
