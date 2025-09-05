<?php
session_start();
include __DIR__ . '/../conn.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = trim($_POST['email'] ?? '');
    $password = trim($_POST['password'] ?? '');

    if (empty($email) || empty($password)) {
        $_SESSION['error'] = "Please enter both email and password.";
        header("Location: ../../admin_login.php");
        exit();
    }

    // Step 1: Fetch from account table
    $stmt = $conn->prepare("SELECT * FROM account WHERE username = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $acctResult = $stmt->get_result();

    if ($acctResult->num_rows === 1) {
        $account = $acctResult->fetch_assoc();

        // Step 2: Verify hashed password
        if (password_verify($password, $account['password'])) {
            $acct_id = $account['admin_id'];

            // Step 3: Check if linked to admin
            $adminStmt = $conn->prepare("SELECT * FROM admin WHERE admin_id = ?");
            $adminStmt->bind_param("i", $acct_id);
            $adminStmt->execute();
            $adminResult = $adminStmt->get_result();

            if ($adminResult->num_rows === 1) {
                $admin = $adminResult->fetch_assoc();

                // Step 4: Set session data
                $_SESSION['user_id'] = $acct_id;
                $_SESSION['admin_id'] = $admin['admin_id'];

                // Step 5: Record login history
                $login_time = date('Y-m-d H:i:s');
                $ip_address = $_SERVER['REMOTE_ADDR'];
                $user_agent = $_SERVER['HTTP_USER_AGENT'];

                $logStmt = $conn->prepare("INSERT INTO LoginHistory (admin_id, login_time, ip_address, user_agent) VALUES (?, ?, ?, ?)");
                $logStmt->bind_param("isss", $admin['admin_id'], $login_time, $ip_address, $user_agent);
                $logStmt->execute();

                // Store login_id for logout
                $_SESSION['login_id'] = $conn->insert_id;

                unset($_SESSION['error']);
                $_SESSION['success'] = "Login successful.";
                header("Location: ../../index.php");
                exit();
            } else {
                $_SESSION['error'] = "This account is not linked to an admin profile.";
                header("Location: ../../admin_login.php");
                exit();
            }
        } else {
            $_SESSION['error'] = "Incorrect password.";
            header("Location: ../../admin_login.php");
            exit();
        }
    } else {
        $_SESSION['error'] = "Account not found.";
        header("Location: ../../admin_login.php");
        exit();
    }

    // Close everything
    $stmt->close();
    $conn->close();
}
?>
