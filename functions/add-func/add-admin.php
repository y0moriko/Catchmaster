<?php
session_start();
include 'D:\xamp\htdocs\Capstone\functions\conn.php';

$first_name = $middle_name = $last_name = $phone_number = $email = $department_role = $username = $password = "";
$role_name = "admin"; // Default role to assign

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize inputs
    $first_name = ucfirst(strtolower(mysqli_real_escape_string($conn, $_POST['first_name'] ?? '')));
    $middle_name = ucfirst(strtolower(mysqli_real_escape_string($conn, $_POST['middle_name'] ?? '')));
    $last_name = ucfirst(strtolower(mysqli_real_escape_string($conn, $_POST['last_name'] ?? '')));
    $phone_number = mysqli_real_escape_string($conn, $_POST['phone_number'] ?? '');
    $email = mysqli_real_escape_string($conn, $_POST['email'] ?? '');
    $department_role = mysqli_real_escape_string($conn, $_POST['department_role'] ?? '');
    
    // Set username to email
    $username = $email; // Default username to email
    $password = $_POST['password'] ?? '';

    // Validate required fields
    if (!$first_name || !$last_name || !$email || !$department_role || !$password) {
        $_SESSION['error'] = "Missing required fields.";
        header("Location: {$_SERVER['HTTP_REFERER']}");
        exit();
    }

    // Handle image upload if provided
    $image_path = null;
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $img_tmp = $_FILES['image']['tmp_name'];
        $img_name = basename($_FILES['image']['name']);
        $img_name = preg_replace("/[^a-zA-Z0-9.\-_]/", "", $img_name);
        $upload_dir = "uploads/admin_images/";
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0755, true);
        }
        $target_file = $upload_dir . uniqid() . "_" . $img_name;

        if (move_uploaded_file($img_tmp, $target_file)) {
            $image_path = $target_file;
        } else {
            $_SESSION['error'] = "Failed to upload image.";
            header("Location: {$_SERVER['HTTP_REFERER']}");
            exit();
        }
    }

    // Hash password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Start transaction
    mysqli_begin_transaction($conn);

    try {
        // Insert into Admin table
        $sql_admin = "INSERT INTO Admin (fname, mname, lname, phone_number, gmail, department_role, image_path) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt_admin = mysqli_prepare($conn, $sql_admin);
        if (!$stmt_admin) {
            throw new Exception("Prepare Admin failed: " . mysqli_error($conn));
        }
        mysqli_stmt_bind_param($stmt_admin, "sssssss", $first_name, $middle_name, $last_name, $phone_number, $email, $department_role, $image_path);
        if (!mysqli_stmt_execute($stmt_admin)) {
            throw new Exception("Execute Admin failed: " . mysqli_error($conn));
        }
        $admin_id = mysqli_insert_id($conn);
        mysqli_stmt_close($stmt_admin);

        // Get role_id from Role table
        $sql_role = "SELECT role_id FROM Role WHERE role_name = ?";
        $stmt_role = mysqli_prepare($conn, $sql_role);
        if (!$stmt_role) {
            throw new Exception("Prepare Role failed: " . mysqli_error($conn));
        }
        mysqli_stmt_bind_param($stmt_role, "s", $role_name);
        if (!mysqli_stmt_execute($stmt_role)) {
            throw new Exception("Execute Role failed: " . mysqli_error($conn));
        }
        mysqli_stmt_bind_result($stmt_role, $role_id);
        if (!mysqli_stmt_fetch($stmt_role)) {
            throw new Exception("Role 'admin' not found in Role table.");
        }
        mysqli_stmt_close($stmt_role);

        // Insert into Account table
        $account_type = 'admin';
        $sql_account = "INSERT INTO Account (admin_id, username, password, account_type, role_id) VALUES (?, ?, ?, ?, ?)";
        $stmt_account = mysqli_prepare($conn, $sql_account);
        if (!$stmt_account) {
            throw new Exception("Prepare Account failed: " . mysqli_error($conn));
        }
        mysqli_stmt_bind_param($stmt_account, "isssi", $admin_id, $username, $hashed_password, $account_type, $role_id);
        if (!mysqli_stmt_execute($stmt_account)) {
            throw new Exception("Execute Account failed: " . mysqli_error($conn));
        }
        mysqli_stmt_close($stmt_account);

        // Commit transaction
        mysqli_commit($conn);

        $_SESSION['message'] = "Admin account created successfully.";
        header("Location: ../../index.php");
        exit();

    } catch (Exception $e) {
        mysqli_rollback($conn);
        $_SESSION['error'] = "Failed to create admin account: " . $e->getMessage();
        header("Location: {$_SERVER['HTTP_REFERER']}");
        exit();
    }

    mysqli_close($conn);
}
?>
