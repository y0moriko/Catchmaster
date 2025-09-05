<?php
session_start();
include __DIR__ . '/../conn.php';

if(isset($_GET['id'])) {
    $id = intval($_GET['id']);

    $sql = "SELECT fc.catch_id, fc.fish_id, f.fish_name, fc.quantity_kg, fc.location, fc.catch_date
            FROM fishcatch fc
            JOIN fish f ON fc.fish_id = f.fish_id
            WHERE fc.catch_id = $id";
    $result = mysqli_query($conn, $sql);

    if($result && mysqli_num_rows($result) > 0) {
        echo json_encode(mysqli_fetch_assoc($result));
    } else {
        echo json_encode([]);
    }
}
?>
