<?php
include 'D:/xamp/htdocs/Capstone/functions/conn.php';

$stmt = $conn->prepare("SELECT * FROM admin WHERE admin_id = 2");
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $admin = $result->fetch_assoc();
} else {
    echo "Admin not found.";
    exit();
}

$stmt2 = $conn->prepare("SELECT * FROM admin WHERE admin_id != ?");
$stmt2->bind_param("i", $admin['admin_id']);
$stmt2->execute();
$result2 = $stmt2->get_result();

$personnel = [];
while ($row = $result2->fetch_assoc()) {
    $personnel[] = $row;
}
?>
