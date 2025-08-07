<?php
// Start session and connect to DB
session_start();
include 'D:/xamp/htdocs/Capstone/functions/conn.php';

// TEMPORARILY hardcoding admin_id = 2 for testing
$stmt = $conn->prepare("SELECT * FROM admin WHERE admin_id = 2");
$stmt->execute();
$result = $stmt->get_result();

// Check if admin was found
if ($result->num_rows > 0) {
    $admin = $result->fetch_assoc();
    // Access with $admin['fname'], etc.
} else {
    echo "Admin not found.";
    exit();
}
?>
