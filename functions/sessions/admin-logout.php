<?php
session_start();
include 'D:/xamp/htdocs/Capstone/functions/conn.php'; // Adjust path as needed

if (isset($_SESSION['login_id'])) {
    $logout_time = date('Y-m-d H:i:s');
    $login_id = $_SESSION['login_id'];

    $sql_logout = "UPDATE LoginHistory SET logout_time = ? WHERE login_id = ?";
    $stmt = mysqli_prepare($conn, $sql_logout);
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "si", $logout_time, $login_id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    }
}

// Clear session and logout
session_unset();
session_destroy();

// Redirect to login page
$_SESSION['success'] = "Logged out successfully!";
header("Location: ../../login.php");
exit();
?>
