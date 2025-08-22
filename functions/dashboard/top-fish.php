<?php
include 'D:\xamp\htdocs\Capstone\functions\conn.php'; // Adjust path if needed

// Query to get the fish with the highest total catch
$sql = "
    SELECT f.fish_name, SUM(fc.quantity_kg) AS total_kg
    FROM fishcatch fc
    INNER JOIN fish f ON fc.fish_id = f.fish_id
    GROUP BY fc.fish_id
    ORDER BY total_kg DESC
    LIMIT 1
";

$result = mysqli_query($conn, $sql);

$top_fish = "No data available"; // Default if no result
if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $top_fish = htmlspecialchars($row['fish_name']) . " - " . htmlspecialchars($row['total_kg']) . " kg";
}

// Output
echo $top_fish;

mysqli_close($conn);
?>
