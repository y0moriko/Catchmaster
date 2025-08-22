<?php
session_start();
include 'D:/xamp/htdocs/Capstone/functions/conn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    function cleanInput($conn, $input) {
        return mysqli_real_escape_string($conn, trim($input));
    }

    $fname = cleanInput($conn, $_POST['first_name'] ?? '');
    $mname = cleanInput($conn, $_POST['middle_name'] ?? '');
    $lname = cleanInput($conn, $_POST['last_name'] ?? '');
    $phone = cleanInput($conn, $_POST['contact'] ?? '');
    $email = cleanInput($conn, $_POST['email'] ?? '');
    $barangay = cleanInput($conn, $_POST['address'] ?? '');
    $municipality = cleanInput($conn, $_POST['municipality'] ?? 'Agdangan');
    $province = cleanInput($conn, $_POST['province'] ?? 'Quezon Province');
    $birthday = cleanInput($conn, $_POST['birthday'] ?? '');
    $image_path = null;

    // Get admin_id from session
    $admin_id = $_SESSION['admin_id'] ?? null;

    if (!$fname || !$lname || !$phone || !$barangay || !$birthday) {
        $_SESSION['error'] = "Please fill in all required fields.";
        header("Location: {$_SERVER['HTTP_REFERER']}");
        exit();
    }

    // ✅ Check duplicate in User table (phone/email)
    $checkUser = "SELECT user_id FROM User WHERE phone_number = ? OR gmail = ?";
    $stmtCheck = mysqli_prepare($conn, $checkUser);
    mysqli_stmt_bind_param($stmtCheck, "ss", $phone, $email);
    mysqli_stmt_execute($stmtCheck);
    mysqli_stmt_store_result($stmtCheck);

    if (mysqli_stmt_num_rows($stmtCheck) > 0) {
        $_SESSION['error'] = "A fisherman with this phone or email already exists.";
        mysqli_stmt_close($stmtCheck);
        header("Location: {$_SERVER['HTTP_REFERER']}");
        exit();
    }
    mysqli_stmt_close($stmtCheck);

    // ✅ Handle image upload
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

    // ✅ Insert fisherman into User
    $sql = "INSERT INTO User (fname, mname, lname, phone_number, gmail, barangay, municipality, province, birthday, admin_id, image_path)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "sssssssssis", $fname, $mname, $lname, $phone, $email, $barangay, $municipality, $province, $birthday, $admin_id, $image_path);

    if (mysqli_stmt_execute($stmt)) {
        $new_user_id = mysqli_insert_id($conn); // ✅ Get the new fisherman's user_id

        // ✅ Create Account linked to this user_id
        $username = $phone; // username = phone
        $hashed_password = password_hash($phone, PASSWORD_DEFAULT);

        // Prevent duplicate in Account
        $checkAcc = "SELECT account_id FROM Account WHERE username = ?";
        $stmtCheckAcc = mysqli_prepare($conn, $checkAcc);
        mysqli_stmt_bind_param($stmtCheckAcc, "s", $username);
        mysqli_stmt_execute($stmtCheckAcc);
        mysqli_stmt_store_result($stmtCheckAcc);

        if (mysqli_stmt_num_rows($stmtCheckAcc) > 0) {
            $_SESSION['error'] = "Account with this username already exists.";
            mysqli_stmt_close($stmtCheckAcc);
            header("Location: {$_SERVER['HTTP_REFERER']}");
            exit();
        }
        mysqli_stmt_close($stmtCheckAcc);

        // Get role_id
        $role_name = 'user';
        $sql_role = "SELECT role_id FROM Role WHERE role_name = ?";
        $stmt_role = mysqli_prepare($conn, $sql_role);
        mysqli_stmt_bind_param($stmt_role, "s", $role_name);
        mysqli_stmt_execute($stmt_role);
        mysqli_stmt_bind_result($stmt_role, $role_id);
        mysqli_stmt_fetch($stmt_role);
        mysqli_stmt_close($stmt_role);

        // Insert into Account with link to User (user_id)
        $sql_account = "INSERT INTO Account (user_id, username, password, account_type, role_id, admin_id)
                        VALUES (?, ?, ?, ?, ?, ?)";
        $stmt_account = mysqli_prepare($conn, $sql_account);
        $account_type = 'user';
        mysqli_stmt_bind_param($stmt_account, "isssii", $new_user_id, $username, $hashed_password, $account_type, $role_id, $admin_id);
        mysqli_stmt_execute($stmt_account);
        mysqli_stmt_close($stmt_account);

        $_SESSION['success'] = "Fisherman and account added successfully.";
        header("Location: ../../fishermen_list.php");
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
