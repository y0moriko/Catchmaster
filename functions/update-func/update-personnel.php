<?php
session_start();
include __DIR__ . '/../conn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $admin_id = $_POST['admin_id'];
    $fname    = $_POST['fname'];
    $mname    = $_POST['mname'];
    $lname    = $_POST['lname'];
    $gmail    = $_POST['gmail'];  
    $role     = $_POST['role'];

    // Handle photo upload
    $image_path = null;
    if (isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
        $ext = pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION);
        $photoName = uniqid("admin_", true) . "." . $ext;

        // Path for DB
        $image_path = "uploads/" . $photoName;

        // Move uploaded file
        move_uploaded_file($_FILES['photo']['tmp_name'], "../../" . $image_path);
    }

    // Start transaction
    $conn->begin_transaction();

    try {
        // Update admin table
        if ($image_path) {
            $sql = "UPDATE admin
                    SET fname=?, mname=?, lname=?, gmail=?, department_role=?, image_path=? 
                    WHERE admin_id=?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssssssi", $fname, $mname, $lname, $gmail, $role, $image_path, $admin_id);
        } else {
            $sql = "UPDATE admin 
                    SET fname=?, mname=?, lname=?, gmail=?, department_role=? 
                    WHERE admin_id=?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sssssi", $fname, $mname, $lname, $gmail, $role, $admin_id);
        }
        $stmt->execute();

        // Update account table (username = new gmail)
        $sqlAcc = "UPDATE account 
                   SET username=? 
                   WHERE username=(SELECT gmail FROM admin WHERE admin_id=?)";
        $stmtAcc = $conn->prepare($sqlAcc);
        $stmtAcc->bind_param("si", $gmail, $admin_id);
        $stmtAcc->execute();

        // Commit
        $conn->commit();

        $_SESSION['success'] = "Admin profile updated successfully!";
        header("Location: ../../profile-test.php");
        exit();
    } catch (Exception $e) {
        $conn->rollback();
        $_SESSION['error'] = "Error updating profile: " . $e->getMessage();
        header("Location: ../../profile-test.php");
        exit();
    }
}
?>
    