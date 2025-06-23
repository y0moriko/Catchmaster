<?php
session_start(); // Start the session

include 'D:\xamp\htdocs\Capstone\functions\conn.php'; // Include your database connection

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize inputs
    $email = mysqli_real_escape_string($conn, $_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    // Validate required fields
    if (empty($email) || empty($password)) {
        die("Email and Password are required.");
    }

    // Check credentials
    $sql = "SELECT * FROM Account WHERE username = ?";
    $stmt = mysqli_prepare($conn, $sql);
    if (!$stmt) {
        die("Database query failed: " . mysqli_error($conn));
    }
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($result && mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);
        // Verify password
        if (password_verify($password, $user['password'])) {
            // Successful login
            $_SESSION['user_id'] = $user['admin_id']; // Store user ID in session
            $_SESSION['username'] = $user['username']; // Store username in session

            // Log the login attempt
            $login_time = date('Y-m-d H:i:s');
            $sql_log = "INSERT INTO LoginHistory (admin_id, login_time) VALUES (?, ?)";
            $stmt_log = mysqli_prepare($conn, $sql_log);
            if (!$stmt_log) {
                die("Failed to prepare login history statement: " . mysqli_error($conn));
            }
            mysqli_stmt_bind_param($stmt_log, "is", $user['admin_id'], $login_time);
            mysqli_stmt_execute($stmt_log);
            mysqli_stmt_close($stmt_log);

            // Redirect to admin dashboard or home page
            header("Location: ..\..\index.html");
            exit();
        } else {
            // Invalid password
            echo "Invalid email or password.";
        }
    } else {
        // No user found
        echo "Invalid email or password.";
    }

    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}
?>
