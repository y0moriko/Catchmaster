<?php
session_start();
include __DIR__ . '/../conn.php';

if (!isset($_POST['personnel_id'])) {
    $_SESSION['error'] = "Invalid request.";
    header("Location: ../profile.php");
    exit();
}

$personnel_id = $_POST['personnel_id'];
$fname = $_POST['fname'];
$mname = $_POST['mname'];
$lname = $_POST['lname'];
$gmail = $_POST['gmail'];
$phone_number = $_POST['phone_number'];
$department_role = $_POST['department_role'];

// Handle image upload if provided
$image_path = null;
if (isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
    $uploadDir = __DIR__ . '/../../assets/personnel/';
    if (!is_dir($uploadDir)) mkdir($uploadDir, 0777, true);
    
    $filename = time() . '_' . basename($_FILES['photo']['name']);
    $targetFile = $uploadDir . $filename;
    if (move_uploaded_file($_FILES['photo']['tmp_name'], $targetFile)) {
        $image_path = 'assets/personnel/' . $filename;
    }
}

// Update personnel record
$sql = "UPDATE admin SET fname=?, mname=?, lname=?, gmail=?, phone_number=?, department_role=?";
$params = [$fname, $mname, $lname, $gmail, $phone_number, $department_role];
$types = "ssssss";

if ($image_path) {
    $sql .= ", image_path=?";
    $types .= "s";
    $params[] = $image_path;
}

$sql .= " WHERE admin_id=?";
$types .= "i";
$params[] = $personnel_id;

$stmt = $conn->prepare($sql);
$stmt->bind_param($types, ...$params);
if ($stmt->execute()) {
    $_SESSION['success'] = "Personnel updated successfully.";
} else {
    $_SESSION['error'] = "Failed to update personnel.";
}

header("Location: ../../profile-test.php");
exit();
