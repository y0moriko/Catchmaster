<?php
session_start();
include 'D:\xamp\htdocs\Capstone\functions\conn.php';

// Check for admin login and get admin_id from session
if (!isset($_SESSION['user_id'])) {
    die('Unauthorized. Please login as admin.');
}
$admin_id = $_SESSION['user_id']; // Assumes this stores the admin's user_id

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize inputs
    function cleanInput($conn, $input) {
        return mysqli_real_escape_string($conn, trim($input));
    }

    $fname = cleanInput($conn, $_POST['fish_name'] ?? '');
    $sname = cleanInput($conn, $_POST['scientific_name'] ?? '');
    $description = cleanInput($conn, $_POST['fish_description'] ?? '');

    // Basic validation
    if (!$fname || !$sname || !$description) {
        die('Please fill in all required fields.');
    }
    
    $image_path = null;
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $img_tmp = $_FILES['image']['tmp_name'];
        $img_name = basename($_FILES['image']['name']);
        $img_name = preg_replace("/[^a-zA-Z0-9.\-_]/", "", $img_name);
        $upload_dir = "uploads/fishermen_images/";
        if (!is_dir($upload_dir)) mkdir($upload_dir, 0755, true);
        $target_file = $upload_dir . uniqid() . "_" . $img_name;
        if (move_uploaded_file($img_tmp, $target_file)) {
            $image_path = $target_file;
        } else {
            die("Failed to upload image.");
        }
    }

    // Insert fisherman into fish table
    $sql = "INSERT INTO Fish (fish_name, scientific_name, fish_description, image_path)
            VALUES (?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    if (!$stmt) {
        die("Prepare failed: " . mysqli_error($conn));
    }
    mysqli_stmt_bind_param($stmt, "sssssssssis", $fname, $sname, $description, $image_path);

    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}
?>