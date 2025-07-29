<?php
include 'D:/xamp/htdocs/Capstone/functions/conn.php';
require 'extensions\simplexlsx-master\src\SimpleXLSX.php'; // path to the class file

if (isset($_FILES['excel_file'])) {
    if ($xlsx = SimpleXLSX::parse($_FILES['excel_file']['tmp_name'])) {
        foreach ($xlsx->rows() as $index => $row) {
            if ($index === 0) continue; // skip header row

            $fish_name = $row[0];
            $scientific_name = $row[1];
            $fish_description = $row[2];

            $stmt = $conn->prepare("INSERT INTO fish (fish_name, scientific_name, fish_description) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $fish_name, $scientific_name, $fish_description);
            $stmt->execute();
        }
        echo "Upload successful!";
    } else {
        echo "Failed to parse file: " . SimpleXLSX::parseError();
    }
}
?>
