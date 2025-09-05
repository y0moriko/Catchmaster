<?php
session_start();
include __DIR__ . '/../conn.php';

error_reporting(E_ALL);
ini_set('display_errors', 1);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_GET['admin_id'])) {
    $admin_id = intval($_GET['admin_id']);
    error_log("Admin ID: " . $admin_id);

    // Check if the admin exists
    $check_sql = "SELECT * FROM admin WHERE admin_id = ?";
    $check_stmt = mysqli_prepare($conn, $check_sql);
    mysqli_stmt_bind_param($check_stmt, "i", $admin_id);
    mysqli_stmt_execute($check_stmt);
    $result = mysqli_stmt_get_result($check_stmt);
    if (mysqli_num_rows($result) == 0) {
        $_SESSION['error'] = "Admin ID does not exist.";
        error_log("Admin ID does not exist: " . $admin_id);
        header("Location: ../../profile-test.php");
        exit();
    }
    mysqli_stmt_close($check_stmt);

    mysqli_begin_transaction($conn);

    try {
        // Delete from account table first
        $sql_account = "DELETE FROM account WHERE admin_id = ?";
        $stmt_account = mysqli_prepare($conn, $sql_account);
        if (!$stmt_account) {
            throw new Exception("Prepare account delete failed: " . mysqli_error($conn));
        }
        mysqli_stmt_bind_param($stmt_account, "i", $admin_id);
        if (!mysqli_stmt_execute($stmt_account)) {
            throw new Exception("Execute account delete failed: " . mysqli_error($conn));
        }
        mysqli_stmt_close($stmt_account);
        error_log("Deleted from account table for admin_id: " . $admin_id);

        // Delete from admin table
        $sql_admin = "DELETE FROM admin WHERE admin_id = ?";
        $stmt_admin = mysqli_prepare($conn, $sql_admin);
        if (!$stmt_admin) {
            throw new Exception("Prepare admin delete failed: " . mysqli_error($conn));
        }
        mysqli_stmt_bind_param($stmt_admin, "i", $admin_id);
        if (!mysqli_stmt_execute($stmt_admin)) {
            throw new Exception("Execute admin delete failed: " . mysqli_error($conn));
        }
        mysqli_stmt_close($stmt_admin);
        error_log("Deleted from admin table for admin_id: " . $admin_id);

        mysqli_commit($conn);
        $_SESSION['message'] = "Admin account deleted successfully.";
        error_log("Transaction committed successfully for admin_id: " . $admin_id);
    } catch (Exception $e) {
        mysqli_rollback($conn);
        $_SESSION['error'] = "Failed to delete admin account: " . $e->getMessage();
        error_log("Error: " . $e->getMessage());
    }
} else {
    $_SESSION['error'] = "No admin ID provided.";
    error_log("No admin ID provided.");
}

mysqli_close($conn);
header("Location: ../../admin_list.php");
exit();
?>
