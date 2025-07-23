<?php
session_start();
include 'D:\xamp\htdocs\Capstone\functions\conn.php';

// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Check if the connection is successful
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_GET['id'])) {
    $admin_id = intval($_GET['id']); // Ensure the ID is an integer
    error_log("Admin ID: " . $admin_id); // Log the admin ID for debugging

    // Check if the admin ID exists
    $check_sql = "SELECT * FROM Admin WHERE admin_id = ?";
    $check_stmt = mysqli_prepare($conn, $check_sql);
    mysqli_stmt_bind_param($check_stmt, "i", $admin_id);
    mysqli_stmt_execute($check_stmt);
    $result = mysqli_stmt_get_result($check_stmt);
    if (mysqli_num_rows($result) == 0) {
        $_SESSION['error'] = "Admin ID does not exist.";
        error_log("Admin ID does not exist: " . $admin_id);
        header("Location: ../../admin_list.php");
        exit();
    }
    mysqli_stmt_close($check_stmt);

    mysqli_begin_transaction($conn);

    try {
        // Delete from Account table
        $sql_account = "DELETE FROM Account WHERE admin_id = ?";
        $stmt_account = mysqli_prepare($conn, $sql_account);
        if (!$stmt_account) {
            throw new Exception("Prepare Account delete failed: " . mysqli_error($conn));
        }
        mysqli_stmt_bind_param($stmt_account, "i", $admin_id);
        if (!mysqli_stmt_execute($stmt_account)) {
            throw new Exception("Execute Account delete failed: " . mysqli_error($conn));
        }
        mysqli_stmt_close($stmt_account);
        error_log("Deleted from Account table for admin_id: " . $admin_id); // Log successful deletion

        // Delete from Admin table
        $sql_admin = "DELETE FROM Admin WHERE admin_id = ?";
        $stmt_admin = mysqli_prepare($conn, $sql_admin);
        if (!$stmt_admin) {
            throw new Exception("Prepare Admin delete failed: " . mysqli_error($conn));
        }
        mysqli_stmt_bind_param($stmt_admin, "i", $admin_id);
        if (!mysqli_stmt_execute($stmt_admin)) {
            throw new Exception("Execute Admin delete failed: " . mysqli_error($conn));
        }
        mysqli_stmt_close($stmt_admin);
        error_log("Deleted from Admin table for admin_id: " . $admin_id); // Log successful deletion

        // Commit transaction
        mysqli_commit($conn);
        $_SESSION['message'] = "Admin account deleted successfully.";
        error_log("Transaction committed successfully for admin_id: " . $admin_id); // Log transaction success
    } catch (Exception $e) {
        mysqli_rollback($conn);
        $_SESSION['error'] = "Failed to delete admin account: " . $e->getMessage();
        error_log("Error: " . $e->getMessage()); // Log the error message
    }
} else {
    $_SESSION['error'] = "No admin ID provided.";
    error_log("No admin ID provided."); // Log if no ID is provided
}

mysqli_close($conn);
header("Location: ../../admin_list.php");
exit();
?>
