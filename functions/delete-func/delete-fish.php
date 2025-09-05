<?php
session_start();
include __DIR__ . '/../conn.php';

if (isset($_GET['id'])) {
    $fish_id = intval($_GET['id']); // Ensure the ID is an integer

    // Check if the fish is linked to any fishcatch records
    $checkSql = "SELECT COUNT(*) FROM fishcatch WHERE fish_id = ?";
    $checkStmt = mysqli_prepare($conn, $checkSql);

    if ($checkStmt) {
        mysqli_stmt_bind_param($checkStmt, "i", $fish_id);
        mysqli_stmt_execute($checkStmt);
        mysqli_stmt_bind_result($checkStmt, $count);
        mysqli_stmt_fetch($checkStmt);
        mysqli_stmt_close($checkStmt);

        if ($count > 0) {
            $_SESSION['error'] = "Cannot delete this fish because it is linked to existing fish catch records.";
        } else {
            // Proceed to delete from Fish table
            $deleteSql = "DELETE FROM Fish WHERE fish_id = ?";
            $deleteStmt = mysqli_prepare($conn, $deleteSql);

            if ($deleteStmt) {
                mysqli_stmt_bind_param($deleteStmt, "i", $fish_id);
                if (mysqli_stmt_execute($deleteStmt)) {
                    $_SESSION['success'] = "Fish deleted successfully.";
                } else {
                    $_SESSION['error'] = "Error deleting fish: " . mysqli_error($conn);
                }
                mysqli_stmt_close($deleteStmt);
            } else {
                $_SESSION['error'] = "Error preparing delete statement: " . mysqli_error($conn);
            }
        }
    } else {
        $_SESSION['error'] = "Error preparing check statement: " . mysqli_error($conn);
    }
} else {
    $_SESSION['error'] = "No ID provided for deletion.";
}

mysqli_close($conn);
header("Location: ../../fish_direct.php");
exit();
