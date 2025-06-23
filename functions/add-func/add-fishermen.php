<?php
session_start();
include 'D:\xamp\htdocs\Capstone\functions\conn.php'; // adjust path if needed

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

    $fname = cleanInput($conn, $_POST['first_name'] ?? '');
    $mname = cleanInput($conn, $_POST['middle_name'] ?? '');
    $lname = cleanInput($conn, $_POST['last_name'] ?? '');
    $phone = cleanInput($conn, $_POST['contact'] ?? '');
    $email = cleanInput($conn, $_POST['email'] ?? '');
    $barangay = cleanInput($conn, $_POST['address'] ?? '');
    
    // Set default values for municipality and province
    $municipality = cleanInput($conn, $_POST['municipality'] ?? 'Agdangan'); // Default to Agdangan
    $province = cleanInput($conn, $_POST['province'] ?? 'Quezon Province'); // Default to Quezon Province
    
    $birthday = cleanInput($conn, $_POST['birthday'] ?? '');

    // Basic validation
    if (!$fname || !$lname || !$phone || !$barangay || !$birthday) {
        $_SESSION['error'] = "Please fill in all required fields.";
        header("Location: {$_SERVER['HTTP_REFERER']}");
        exit();
    }

    // Optional: Handle image upload
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
            $_SESSION['error'] = "Failed to upload image.";
            header("Location: {$_SERVER['HTTP_REFERER']}");
            exit();
        }
    }

    // Insert fisherman into User table
    $sql = "INSERT INTO User (fname, mname, lname, phone_number, gmail, barangay, municipality, province, birthday, admin_id, image_path)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    if (!$stmt) {
        $_SESSION['error'] = "Prepare failed: " . mysqli_error($conn);
        header("Location: {$_SERVER['HTTP_REFERER']}");
        exit();
    }
    mysqli_stmt_bind_param($stmt, "sssssssssis", $fname, $mname, $lname, $phone, $email, $barangay, $municipality, $province, $birthday, $admin_id, $image_path);
    
    if (mysqli_stmt_execute($stmt)) {
        // Fisherman added successfully, now insert into Account table
        $username = $phone; // Use phone number as username
        $hashed_password = password_hash($phone, PASSWORD_DEFAULT); // Hash the phone number for password
        
        // Get role_id from Role table
        $role_name = 'user'; // Assuming the role you want to assign is 'user'
        $sql_role = "SELECT role_id FROM Role WHERE role_name = ?";
        $stmt_role = mysqli_prepare($conn, $sql_role);
        if (!$stmt_role) {
            $_SESSION['error'] = "Prepare Role failed: " . mysqli_error($conn);
            header("Location: {$_SERVER['HTTP_REFERER']}");
            exit();
        }
        mysqli_stmt_bind_param($stmt_role, "s", $role_name);
        if (!mysqli_stmt_execute($stmt_role)) {
            $_SESSION['error'] = "Execute Role failed: " . mysqli_error($conn);
            header("Location: {$_SERVER['HTTP_REFERER']}");
            exit();
        }
        mysqli_stmt_bind_result($stmt_role, $role_id);
        if (!mysqli_stmt_fetch($stmt_role)) {
            $_SESSION['error'] = "Role 'user' not found in Role table.";
            header("Location: {$_SERVER['HTTP_REFERER']}");
            exit();
        }
        mysqli_stmt_close($stmt_role);

        // Insert into Account table
        $sql_account = "INSERT INTO Account (username, password, account_type, role_id) VALUES (?, ?, ?, ?)";
        $stmt_account = mysqli_prepare($conn, $sql_account);
        if (!$stmt_account) {
            $_SESSION['error'] = "Prepare Account failed: " . mysqli_error($conn);
            header("Location: {$_SERVER['HTTP_REFERER']}");
            exit();
        }
        $account_type = 'user'; // Set account type to user
        mysqli_stmt_bind_param($stmt_account, "sssi", $username, $hashed_password, $account_type, $role_id);
        if (!mysqli_stmt_execute($stmt_account)) {
            $_SESSION['error'] = "Execute Account failed: " . mysqli_error($conn);
            header("Location: {$_SERVER['HTTP_REFERER']}");
            exit();
        }
        mysqli_stmt_close($stmt_account);

        $_SESSION['message'] = "Fisherman and account added successfully.";
        header("Location: ../../index3.php");
        exit();
    } else {
        $_SESSION['error'] = "Failed to add fisherman: " . mysqli_error($conn);
        header("Location: {$_SERVER['HTTP_REFERER']}");
        exit();
    }
    
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}
?>
