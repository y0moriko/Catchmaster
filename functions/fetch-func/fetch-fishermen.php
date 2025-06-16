<?php
include 'D:\xamp\htdocs\Capstone\functions\conn.php'; // adjust path if needed

// Fetch fishermen data
$sql = "SELECT fname, lname, phone_number, gmail, barangay, municipality, province, birthday FROM User";
$result = mysqli_query($conn, $sql);

$fishermen = [];
if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $fishermen[] = $row;
    }
}

// Return JSON response
header('Content-Type: application/json');
echo json_encode($fishermen);

mysqli_close($conn);
?>
