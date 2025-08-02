<?php
session_start();
include 'D:/xamp/htdocs/Capstone/functions/conn.php';
require 'D:/xamp/htdocs/Capstone/extensions/simplexlsx-master/src/SimpleXLSX.php';

if (!file_exists('D:/xamp/htdocs/Capstone/extensions/simplexlsx-master/src/SimpleXLSX.php')) {
    $_SESSION['error'] = "Required file not found!";
    header("Location: ../../fish_direct.php");
    exit();
}

if (isset($_FILES['excel_file'])) {
    if ($xlsx = SimpleXLSX::parse($_FILES['excel_file']['tmp_name'])) {
        $rows = $xlsx->rows();
        $inserted = 0;
        $skipped = 0;

        foreach ($rows as $index => $row) {
            if ($index === 0) continue; // skip header

            $fish_name = trim($row[0] ?? '');
            $scientific_name = trim($row[1] ?? '');
            $fish_description = trim($row[2] ?? '');

            if (empty($fish_name) || empty($scientific_name)) {
                $skipped++;
                continue;
            }

            $checkStmt = $conn->prepare("SELECT 1 FROM fish WHERE fish_name = ? AND scientific_name = ?");
            $checkStmt->bind_param("ss", $fish_name, $scientific_name);
            $checkStmt->execute();
            $checkResult = $checkStmt->get_result();

            if ($checkResult->num_rows > 0) {
                $skipped++;
                continue;
            }

            $stmt = $conn->prepare("INSERT INTO fish (fish_name, scientific_name, fish_description) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $fish_name, $scientific_name, $fish_description);
            $stmt->execute();
            $inserted++;
        }

        $_SESSION['success'] = "Upload complete. ✅ Inserted: $inserted, Skipped: $skipped.";
        header("Location: ../../fish_direct.php");
        exit();
    } else {
        $_SESSION['error'] = "Failed to parse file: " . SimpleXLSX::parseError();
        header("Location: ../../fish_direct.php");
        exit();
    }
} else {
    $_SESSION['error'] = "No file uploaded.";
    header("Location: ../../fish_direct.php");
    exit();
}
?>
