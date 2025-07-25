<?php
session_start();
include 'D:\xamp\htdocs\Capstone\functions\conn.php';

function deleteFisherman($fisherman_id) {
    global $conn;

    if (empty($fisherman_id) || !is_numeric($fisherman_id)) {
        $_SESSION['error'] = "Invalid fisherman ID.";
        return;
    }

    mysqli_begin_transaction($conn);

    try {
        // Delete from account (use user_id)
        $sql_account = "DELETE FROM account WHERE user_id = ?";
        $stmt_account = mysqli_prepare($conn, $sql_account);
        if (!$stmt_account) {
            throw new Exception("Prepare account delete failed: " . mysqli_error($conn));
        }
        mysqli_stmt_bind_param($stmt_account, "i", $fisherman_id);
        if (!mysqli_stmt_execute($stmt_account)) {
            throw new Exception("Execute account delete failed: " . mysqli_error($conn));
        }
        mysqli_stmt_close($stmt_account);

        // Delete from user
        $sql_user = "DELETE FROM user WHERE user_id = ?";
        $stmt_user = mysqli_prepare($conn, $sql_user);
        if (!$stmt_user) {
            throw new Exception("Prepare user delete failed: " . mysqli_error($conn));
        }
        mysqli_stmt_bind_param($stmt_user, "i", $fisherman_id);
        if (!mysqli_stmt_execute($stmt_user)) {
            throw new Exception("Execute user delete failed: " . mysqli_error($conn));
        }
        mysqli_stmt_close($stmt_user);

        mysqli_commit($conn);
        $_SESSION['message'] = "Fisherman account deleted successfully.";
    } catch (Exception $e) {
        mysqli_rollback($conn);
        $_SESSION['error'] = "Failed to delete fisherman account: " . $e->getMessage();
    }

    mysqli_close($conn);
}

// Usage
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['fisherman_id'])) {
        $fisherman_id = intval($_GET['fisherman_id']);
        deleteFisherman($fisherman_id);
    } else {
        $_SESSION['error'] = "Fisherman ID not provided.";
    }
    header("Location: ../../fishermen_list.php");
    exit();
}
?>
