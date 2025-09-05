<?php
include __DIR__ . '/../conn.php';

$q = $_GET['q'] ?? '';
$q = "%$q%";
$results = [];

// Admins
$stmt = $conn->prepare("SELECT CONCAT(fname,' ',mname,' ',lname) AS title, gmail AS details, 'Admin' AS type
                        FROM admin
                        WHERE fname LIKE ? OR mname LIKE ? OR lname LIKE ? OR gmail LIKE ?");
$stmt->bind_param("ssss", $q, $q, $q, $q);
$stmt->execute();
$res = $stmt->get_result();
while($row = $res->fetch_assoc()){
    $results[] = $row;
}

// Fisheries Personnel
$stmt2 = $conn->prepare("SELECT CONCAT(fname,' ',mname,' ',lname) AS title, CONCAT(department_role,' | ',phone_number) AS details, 'Personnel' AS type
                         FROM admin
                         WHERE fname LIKE ? OR mname LIKE ? OR lname LIKE ? OR department_role LIKE ?");
$stmt2->bind_param("ssss", $q, $q, $q, $q);
$stmt2->execute();
$res2 = $stmt2->get_result();
while($row = $res2->fetch_assoc()){
    $results[] = $row;
}

// Reports (example: Fish catch reports)
$stmt3 = $conn->prepare("SELECT report_name AS title, CONCAT('Date: ', report_date) AS details, 'Report' AS type
                         FROM reports
                         WHERE report_name LIKE ? OR report_date LIKE ?");
$stmt3->bind_param("ss", $q, $q);
$stmt3->execute();
$res3 = $stmt3->get_result();
while($row = $res3->fetch_assoc()){
    $results[] = $row;
}

echo json_encode($results);
?>
