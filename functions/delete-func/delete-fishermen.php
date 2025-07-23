<?php
session_start();
include 'D:\xamp\htdocs\Capstone\functions\conn.php'; // Adjust path if needed

function deleteFisherman($fisherman_id) {
    global $conn;

    // Validate fisherman_id
    if (empty($fisherman_id) || !is_numeric($fisherman_id)) {
        $_SESSION['error'] = "Invalid fisherman ID.";
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
        mysqli_stmt_bind_param($stmt_account, "i", $fisherman_id);
        if (!mysqli_stmt_execute($stmt_account)) {
            throw new Exception("Execute Account delete failed: " . mysqli_error($conn));
        }
        mysqli_stmt_close($stmt_account);

        // Delete from User table
        $sql_user = "DELETE FROM User WHERE id = ?";
        $stmt_user = mysqli_prepare($conn, $sql_user);
        if (!$stmt_user) {
            throw new Exception("Prepare User delete failed: " . mysqli_error($conn));
        }
        mysqli_stmt_bind_param($stmt_user, "i", $fisherman_id);
        if (!mysqli_stmt_execute($stmt_user)) {
            throw new Exception("Execute User delete failed: " . mysqli_error($conn));
        }
        mysqli_stmt_close($stmt_user);

        // Commit transaction
        mysqli_commit($conn);

        $_SESSION['message'] = "Fisherman account deleted successfully.";
    } catch (Exception $e) {
        mysqli_rollback($conn);
        $_SESSION['error'] = "Failed to delete fisherman account: " . $e->getMessage();
    }

    mysqli_close($conn);
}

// Example usage
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['fisherman_id'])) { // Check if fisherman_id is set in the URL
        $fisherman_id = intval($_GET['fisherman_id']); // Ensure the ID is an integer
        deleteFisherman($fisherman_id);
    } else {
        $_SESSION['error'] = "Fisherman ID not provided.";
    }
    header("Location: ../../fishermen_list.php"); // Redirect to the fishermen list page
    exit();
}
?>
