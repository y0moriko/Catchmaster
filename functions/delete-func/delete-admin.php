<?php
session_start();
include 'D:\xamp\htdocs\Capstone\functions\conn.php';

function deleteAdmin($admin_id) {
    global $conn;

    // Validate admin_id
    if (empty($admin_id) || !is_numeric($admin_id)) {
        $_SESSION['error'] = "Invalid admin ID.";
        return;
    }

    // Start transaction
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

        // Delete from Admin table
        $sql_admin = "DELETE FROM Admin WHERE id = ?";
        $stmt_admin = mysqli_prepare($conn, $sql_admin);
        if (!$stmt_admin) {
            throw new Exception("Prepare Admin delete failed: " . mysqli_error($conn));
        }
        mysqli_stmt_bind_param($stmt_admin, "i", $admin_id);
        if (!mysqli_stmt_execute($stmt_admin)) {
            throw new Exception("Execute Admin delete failed: " . mysqli_error($conn));
        }
        mysqli_stmt_close($stmt_admin);

        // Commit transaction
        mysqli_commit($conn);

        $_SESSION['message'] = "Admin account deleted successfully.";
    } catch (Exception $e) {
        mysqli_rollback($conn);
        $_SESSION['error'] = "Failed to delete admin account: " . $e->getMessage();
    }

    mysqli_close($conn);
}

// Example usage
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $admin_id = $_POST['admin_id'] ?? '';
    deleteAdmin($admin_id);
    header("Location: {$_SERVER['HTTP_REFERER']}");
    exit();
}
?>
