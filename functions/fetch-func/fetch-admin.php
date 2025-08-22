<?php
include 'D:/xamp/htdocs/Capstone/functions/conn.php';

// Make sure the admin is logged in
if (!isset($_SESSION['admin_id'])) {
    $_SESSION['error'] = "Please log in first.";
    header("Location: login.php");
    exit();
}

// Get current admin info
$current_admin_id = $_SESSION['admin_id'];
$stmt = $conn->prepare("SELECT * FROM admin WHERE admin_id = ?");
$stmt->bind_param("i", $current_admin_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $admin = $result->fetch_assoc();
} else {
    echo "Admin not found.";
    exit();
}

// Get other personnel (exclude current admin)
$stmt2 = $conn->prepare("SELECT * FROM admin WHERE admin_id != ?");
$stmt2->bind_param("i", $current_admin_id);
$stmt2->execute();
$result2 = $stmt2->get_result();

$personnel = [];
while ($row = $result2->fetch_assoc()) {
    $personnel[] = $row;
}
?>
