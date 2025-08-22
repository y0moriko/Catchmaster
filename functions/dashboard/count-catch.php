<?php
include 'D:\xamp\htdocs\Capstone\functions\conn.php'; // Adjust path if needed

// Query to sum total quantity from fishcatch
$sql = "SELECT SUM(quantity_kg) as total_quantity FROM fishcatch"; // Adjust the condition based on your requirements
$result = mysqli_query($conn, $sql);

$total_quantity = 0; // Default total quantity
if ($result) {
    $row = mysqli_fetch_assoc($result);
    $total_quantity = $row['total_quantity'] ?? 0; // Get the total quantity from the result, default to 0 if null
}

// Debugging: Output the total quantity
echo htmlspecialchars($total_quantity) . " kg";

mysqli_close($conn);
?>
