<?php
session_start();
include 'D:/xamp/htdocs/Capstone/functions/conn.php';

if (!isset($_SESSION['admin_id'])) {
    header('Location: login.php');
    exit();
}

$admin_id = intval($_SESSION['admin_id']);
$sql = "SELECT admin_id, fname, mname, lname, gmail, department_role, phone_number, image_path
        FROM admin WHERE admin_id = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "i", $admin_id);
mysqli_stmt_execute($stmt);
$res = mysqli_stmt_get_result($stmt);

if ($res && mysqli_num_rows($res) === 1) {
    $admin = mysqli_fetch_assoc($res);
    $fullName = trim($admin['fname'] . ' ' . $admin['mname'] . ' ' . $admin['lname']);
    $email = $admin['gmail'];
    $department = htmlspecialchars($admin['department_role']);
    $phone = htmlspecialchars($admin['phone_number']);
    $profileImg = $admin['image_path'] ? $admin['image_path'] : 'images/default-profile.png';
} else {
    $fullName = "Unknown";
    $email = "N/A";
    $department = "N/A";
    $phone = "N/A";
    $profileImg = 'images/default-profile.png';
}
mysqli_stmt_close($stmt);
?>
