<?php
session_start();
include __DIR__ . '/../conn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize inputs
    function cleanInput($conn, $input) {
        return mysqli_real_escape_string($conn, trim($input));
    }

    $fname = cleanInput($conn, $_POST['fish_name'] ?? '');
    $lname = cleanInput($conn, $_POST['local_name'] ?? '');   // ✅ NEW
    $sname = cleanInput($conn, $_POST['scientific_name'] ?? '');
    $family = cleanInput($conn, $_POST['family'] ?? '');      // ✅ NEW
    $habitat = cleanInput($conn, $_POST['habitat'] ?? '');    // ✅ NEW
    $description = cleanInput($conn, $_POST['fish_description'] ?? '');

    // Basic validation (required fields)
    if (empty($fname) || empty($sname) || empty($family) || empty($habitat) || empty($description)) {
        $_SESSION['error'] = 'Please fill in all required fields.';
        header("Location: {$_SERVER['HTTP_REFERER']}");
        exit();
    }
    
    // ✅ Image upload
    $image_path = null;
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $img_tmp = $_FILES['image']['tmp_name'];
        $img_name = basename($_FILES['image']['name']);
        $img_name = preg_replace("/[^a-zA-Z0-9.\-_]/", "", $img_name);
        $upload_dir = "../../uploads/fish_images/";
        
        if (!is_dir($upload_dir)) mkdir($upload_dir, 0755, true);
        
        $target_file = $upload_dir . uniqid() . "_" . $img_name;
        if (!move_uploaded_file($img_tmp, $target_file)) {
            $_SESSION['error'] = "Failed to upload image.";
            header("Location: {$_SERVER['HTTP_REFERER']}");
            exit();
        }
        $image_path = $target_file;
    }

    // ✅ Duplicate check (by fish_name OR scientific_name)
    $check_sql = "SELECT COUNT(*) FROM fish WHERE fish_name = ? OR scientific_name = ?";
    $check_stmt = mysqli_prepare($conn, $check_sql);
    mysqli_stmt_bind_param($check_stmt, "ss", $fname, $sname);
    mysqli_stmt_execute($check_stmt);
    mysqli_stmt_bind_result($check_stmt, $count);
    mysqli_stmt_fetch($check_stmt);
    mysqli_stmt_close($check_stmt);

    if ($count > 0) {
        $_SESSION['error'] = "This fish already exists.";
        header("Location: {$_SERVER['HTTP_REFERER']}");
        exit();
    }

    // ✅ Insert fish into table
    $sql = "INSERT INTO fish 
            (fish_name, local_name, scientific_name, family, habitat, fish_description, image_path) 
            VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    
    if (!$stmt) {
        $_SESSION['error'] = "Database preparation error. Please try again.";
        header("Location: {$_SERVER['HTTP_REFERER']}");
        exit();
    }
    
    mysqli_stmt_bind_param($stmt, "sssssss", $fname, $lname, $sname, $family, $habitat, $description, $image_path);

    if (mysqli_stmt_execute($stmt)) {
            
        header("Location: ../../fish_direct.php");
        exit();
    } else {
        $_SESSION['error'] = "Error adding fish: " . mysqli_error($conn);
        header("Location: {$_SERVER['HTTP_REFERER']}");
        exit();
    }

    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}
?>
