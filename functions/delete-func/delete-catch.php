<?php
session_start();
include 'D:\xamp\htdocs\Capstone\functions\conn.php'; // Adjust path if needed

if (isset($_GET['id'])) {
    $catch_id = intval($_GET['id']); // Ensure the ID is an integer

    // Prepare the SQL statement to delete the fish record
    $sql = "DELETE FROM fishcatch WHERE catch_id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "i", $catch_id);
        if (mysqli_stmt_execute($stmt)) {
            // Set success message in session
            $_SESSION['success'] = "Catch deleted successfully.";
        } else {
            // Set error message in session
            $_SESSION['error'] = "Error deleting record: " . mysqli_error($conn);
        }
        mysqli_stmt_close($stmt);
    } else {
        $_SESSION['error'] = "Error preparing statement: " . mysqli_error($conn);
    }
} else {
    $_SESSION['error'] = "No ID provided for deletion.";
}

mysqli_close($conn);

// Redirect back to the fish list page
header("Location: ../../fish_catch.php");
exit();
?>
