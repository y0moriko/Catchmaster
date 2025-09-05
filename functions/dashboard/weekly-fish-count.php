<?php
include __DIR__ . '/../conn.php';

// SQL to get total quantity caught for the current week
$sql = "
    SELECT SUM(quantity_kg) AS total_caught
    FROM fishcatch
    WHERE WEEK(catch_date, 1) = WEEK(CURDATE(), 1)
      AND YEAR(catch_date) = YEAR(CURDATE())
";

// Execute query
$result = mysqli_query($conn, $sql);

// Default to 0
$totalCaught = 0;

if ($result && $row = mysqli_fetch_assoc($result)) {
    $totalCaught = $row['total_caught'] ?? 0;
}

mysqli_close($conn);

// Output the result (for use in dashboard)
echo $totalCaught;
?>
