<?php
header('Content-Type: application/json');

include '../functions/conn.php'; // your DB connection file

// Get the raw POST data
$data = json_decode(file_get_contents('php://input'), true);

if (!isset($data['username']) || !isset($data['password'])) {
    echo json_encode(['status' => 'error', 'message' => 'Username and password required']);
    exit;
}

$username = $data['username'];
$password = $data['password'];

// Prepare and execute query
$stmt = $conn->prepare("SELECT * FROM account WHERE username = ? AND account_type = 'user' LIMIT 1");
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo json_encode(['status' => 'error', 'message' => 'Invalid username or account type']);
    exit;
}

$user = $result->fetch_assoc();

if (!password_verify($password, $user['password'])) {
    echo json_encode(['status' => 'error', 'message' => 'Incorrect password']);
    exit;
}

echo json_encode(['status' => 'success', 'message' => 'Login successful', 'user' => [
    'id' => $user['id'],
    'username' => $user['username'],
    'name' => $user['name']
]]);
