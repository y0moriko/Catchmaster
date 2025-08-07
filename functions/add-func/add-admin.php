<?php
session_start();
include_once '../conn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fname = $_POST['first_name'];
    $mname = $_POST['middle_name'];
    $lname = $_POST['last_name'];
    $phone = $_POST['phone_number'];
    $gmail = $_POST['email'];
    $role = $_POST['department_role'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $account_type = 'admin';
    $role_id = 1;

    $imagePath = '';
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = '../../uploads/admins/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        $imageName = uniqid() . '_' . basename($_FILES['image']['name']);
        $targetFile = $uploadDir . $imageName;

        if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFile)) {
            $imagePath = $targetFile;
        } else {
            $_SESSION['error'] = "Failed to upload image.";
            header("Location: ../../profile.php");
            exit;
        }
    }

    $stmt = $conn->prepare("INSERT INTO admin (fname, mname, lname, phone_number, gmail, department_role, image_path) 
                            VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssss", $fname, $mname, $lname, $phone, $gmail, $role, $imagePath);

    if ($stmt->execute()) {
        $admin_id = $stmt->insert_id;

        $stmt2 = $conn->prepare("INSERT INTO account (admin_id, username, password, account_type, role_id) 
                                 VALUES (?, ?, ?, ?, ?)");
        $stmt2->bind_param("isssi", $admin_id, $gmail, $password, $account_type, $role_id);

        if ($stmt2->execute()) {
            $_SESSION['success'] = "Admin account successfully added!";
        } else {
            $_SESSION['error'] = "Failed to create account: " . $stmt2->error;
        }

        $stmt2->close();
    } else {
        $_SESSION['error'] = "Failed to insert admin: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();

    header("Location: ../../profile.php");
    exit;
}
?>
