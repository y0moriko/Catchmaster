<?php
session_start();
include 'D:\xamp\htdocs\Capstone\functions\conn.php';

// Check for admin login
// if (!isset($_SESSION['user_id'])) {
//     $_SESSION['error'] = 'Unauthorized access. Please login as admin.';
//     header("Location: ../../index.php");
//     exit();
// }

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize inputs
    function cleanInput($conn, $input) {
        return mysqli_real_escape_string($conn, trim($input));
    }

    $fish_name = cleanInput($conn, $_POST['species_name'] ?? ''); // Get the selected fish name
    $quantity = cleanInput($conn, $_POST['number'] ?? ''); // Get the quantity
    $location = cleanInput($conn, $_POST['address'] ?? ''); // Get the location
    $date = cleanInput($conn, $_POST['date'] ?? ''); // Get the date
    $time = cleanInput($conn, $_POST['time'] ?? ''); // Get the time
    $description = cleanInput($conn, $_POST['fish_description'] ?? ''); // Assuming you have a description input

    // Basic validation
    if (empty($fish_name) || empty($quantity) || empty($location) || empty($date) || empty($time)) {
        $_SESSION['error'] = 'Please fill in all required fields.';
        header("Location: {$_SERVER['HTTP_REFERER']}");
        exit();
    }

    // Fetch fish_id based on fish_name
    $sql = "SELECT id FROM fish WHERE fish_name = ?";
    $stmt = mysqli_prepare($conn, $sql);
    
    if (!$stmt) {
        $_SESSION['error'] = "Database preparation error. Please try again.";
        header("Location: {$_SERVER['HTTP_REFERER']}");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "s", $fish_name);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $fish_id);
    mysqli_stmt_fetch($stmt);
    mysqli_stmt_close($stmt);

    // Check if fish_id was found
    if (empty($fish_id)) {
        $_SESSION['error'] = "Fish not found in the database.";
        header("Location: {$_SERVER['HTTP_REFERER']}");
        exit();
    }

    // Handle image upload
    $image_path = null;
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $img_tmp = $_FILES['image']['tmp_name'];
        $img_name = basename($_FILES['image']['name']);
        $img_name = preg_replace("/[^a-zA-Z0-9.\-_]/", "", $img_name);
        $upload_dir = "uploads/fish_images/";
        
        if (!is_dir($upload_dir)) mkdir($upload_dir, 0755, true);
        
        $target_file = $upload_dir . uniqid() . "_" . $img_name;
        if (!move_uploaded_file($img_tmp, $target_file)) {
            $_SESSION['error'] = "Failed to upload image.";
            header("Location: {$_SERVER['HTTP_REFERER']}");
            exit();
        }
        $image_path = $target_file;
    }

    // Insert into fishcatch table
    $sql = "INSERT INTO fishcatch (fish_id, quantity, location, date, time, fish_description, image_path) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    
    if (!$stmt) {
        $_SESSION['error'] = "Database preparation error. Please try again.";
        header("Location: {$_SERVER['HTTP_REFERER']}");
        exit();
    }
    
    mysqli_stmt_bind_param($stmt, "iisssss", $fish_id, $quantity, $location, $date, $time, $description, $image_path);

    if (mysqli_stmt_execute($stmt)) {
        $_SESSION['success'] = "Fish catch added successfully!";
        header("Location: ../../fish_direct.php");
        exit();
    } else {
        $_SESSION['error'] = "Error adding fish catch: " . mysqli_error($conn);
        header("Location: {$_SERVER['HTTP_REFERER']}");
        exit();
    }

    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}
?>
