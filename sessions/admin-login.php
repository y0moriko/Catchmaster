<?php
session_start();
include 'D:\xamp\htdocs\Capstone\functions\conn.php';

$email = $_POST['email'];
$password = $_POST['password'];

// Check from account table
$stmt = $conn->prepare("SELECT * FROM account WHERE username = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($user = $result->fetch_assoc()) {
    if (password_verify($password, $user['password'])) {
        // Check role
        if ($user['role'] !== 'admin') {
            $_SESSION['error'] = "Access denied. Not an admin.";
            header("Location: ../../admin_login.php");
            exit();
        }

        $_SESSION['user_id'] = $user['user_id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['role'] = $user['role'];
        $_SESSION['success'] = "Welcome, {$user['username']}!";
        header("Location: dashboard.php");
        exit();
    } else {
        $_SESSION['error'] = "Invalid credentials.";
        header("Location: ../../admin_login.php");
        exit();
    }
} else {
    $_SESSION['error'] = "User not found.";
    header("Location: ../../admin_login.php");
    exit();
}
?>
