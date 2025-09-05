<?php
include __DIR__ . '/../conn.php';

if (!isset($_GET['id']) || empty($_GET['id'])) {
    echo json_encode(['error' => 'Fisherman ID is required']);
    exit();
}

$fishermanId = intval($_GET['id']);

// Fetch data
$sql = "SELECT user_id, fname, mname, lname, phone_number, barangay, birthday, image_path
        FROM User
        WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $fishermanId);
$stmt->execute();
$result = $stmt->get_result();

if ($result && $result->num_rows > 0) {
    $fisherman = $result->fetch_assoc();

    $fisherman['image_path'] = !empty($fisherman['image_path']) ? htmlspecialchars($fisherman['image_path']) : 'https://via.placeholder.com/100';

    echo json_encode($fisherman);
} else {
    echo json_encode(['error' => 'Fisherman not found']);
}

$stmt->close();
$conn->close();
?>
