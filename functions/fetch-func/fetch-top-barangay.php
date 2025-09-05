<?php
include __DIR__ . '/../conn.php';

function getTopBarangays($limit = 5) {
    global $conn; // Use the existing DB connection

    $stmt = $conn->prepare("
        SELECT location, SUM(quantity_kg) AS total_catch
        FROM fishcatch
        GROUP BY location
        ORDER BY total_catch DESC
        LIMIT ?
    ");
    $stmt->bind_param("i", $limit);
    $stmt->execute();
    $result = $stmt->get_result();

    $topBarangays = [];
    while ($row = $result->fetch_assoc()) {
        $topBarangays[] = $row;
    }
    return $topBarangays;
}
?>
