<?php
include '../conn.php';

if(isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $sql = "SELECT * FROM Fish WHERE fish_id = $id";
    $result = mysqli_query($conn, $sql);
    if($result && mysqli_num_rows($result) > 0) {
        echo json_encode(mysqli_fetch_assoc($result));
    } else {
        echo json_encode([]);
    }
}
?>
