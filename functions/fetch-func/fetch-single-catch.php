<?php
include __DIR__ . '/../conn.php';

$id = intval($_GET['id']);

// Get the catch
$sql = "SELECT * FROM fishcatch WHERE catch_id=$id LIMIT 1";
$result = mysqli_query($conn, $sql);
$catch = mysqli_fetch_assoc($result);

// Get all fish options
$fishResult = mysqli_query($conn, "SELECT fish_id, fish_name FROM fish ORDER BY fish_name ASC");
$fishOptions = [];
while ($f = mysqli_fetch_assoc($fishResult)) {
    $fishOptions[] = $f;
}

// Format catch_date for datetime-local input
$catch['catch_date_local'] = date('Y-m-d\TH:i', strtotime($catch['catch_date']));

// Return JSON
echo json_encode(['catch_id'=>$catch['catch_id'], 'fish_id'=>$catch['fish_id'], 'quantity_kg'=>$catch['quantity_kg'], 'location'=>$catch['location'], 'catch_date_local'=>$catch['catch_date_local'], 'status'=>$catch['status'], 'fishOptions'=>$fishOptions]);

mysqli_close($conn);
?>
