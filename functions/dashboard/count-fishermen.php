<?php
include __DIR__ . '/../conn.php';

// Query to count head fishermen
$sql = "SELECT COUNT(*) as count FROM account WHERE account_type = 'user'"; // Adjust the condition based on your database schema
$result = mysqli_query($conn, $sql);

$count = 0; // Default count
if ($result) {
    $row = mysqli_fetch_assoc($result);
    $count = $row['count']; // Get the count from the result
}

mysqli_close($conn);
?>
