<?php
session_start();
include 'D:\xamp\htdocs\Capstone\functions\conn.php';

$username = $_POST['username'];
$password = $_POST['password'];

$stmt = $conn->prepare("SELECT * FROM admin WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

if ($user = $result->fetch_assoc()) {
    if (password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['user_id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['role'] = $user['role']; // optional
        $_SESSION['success'] = "Welcome, {$user['username']}!";
        header("Location: dashboard.php");
        exit();
    } else {
        $_SESSION['error'] = "Invalid credentials.";
        header("Location: login_page.php");
        exit();
    }
} else {
    $_SESSION['error'] = "User not found.";
    header("Location: login_page.php");
    exit();
}
?>
