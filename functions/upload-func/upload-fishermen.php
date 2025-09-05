<?php
session_start();
include 'D:/xamp/htdocs/Capstone/functions/conn.php';
require 'D:/xamp/htdocs/Capstone/extensions/simplexlsx-master/src/SimpleXLSX.php';

if (!file_exists('D:/xamp/htdocs/Capstone/extensions/simplexlsx-master/src/SimpleXLSX.php')) {
    $_SESSION['error'] = "Required file not found!";
    header("Location: ../../fishermen_list.php");
    exit();
}

if (isset($_FILES['excel_file'])) {
    if ($xlsx = SimpleXLSX::parse($_FILES['excel_file']['tmp_name'])) {
        $rows = $xlsx->rows();
        $inserted = 0;
        $skipped = 0;

        foreach ($rows as $index => $row) {
            if ($index === 0) continue; // skip header

            $fname = trim($row[0] ?? '');
            $mname = trim($row[1] ?? '');
            $lname = trim($row[2] ?? '');
            $phone_number = trim($row[3] ?? '');
            $gmail = trim($row[4] ?? '');
            $barangay = trim($row[5] ?? '');
            $municipality = trim($row[6] ?? '');
            $province = trim($row[7] ?? '');
            $birthday = trim($row[8] ?? '');

            if (empty($fname) || empty($lname)) {
                $skipped++;
                continue;
            }

            $checkStmt = $conn->prepare("SELECT 1 FROM user WHERE fname = ? AND lname = ?");
            $checkStmt->bind_param("ss", $fname, $lname);
            $checkStmt->execute();
            $checkResult = $checkStmt->get_result();

            if ($checkResult->num_rows > 0) {
                $skipped++;
                continue;
            }

            $stmt = $conn->prepare("INSERT INTO user (fname, mname, lname, phone_number, gmail, barangay, municipality, province, birthday) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("sssssssss", $fname, $mname, $lname, $phone_number, $gmail, $barangay, $municipality, $province, $birthday);
            $stmt->execute();
            $inserted++;
        }

        $_SESSION['success'] = "Upload complete. ✅ Inserted: $inserted, Skipped: $skipped.";
        header("Location: ../../fishermen_list.php");
        exit();
    } else {
        $_SESSION['error'] = "Failed to parse file: " . SimpleXLSX::parseError();
        header("Location: ../../fishermen_list.php");
        exit();
    }
} else {
    $_SESSION['error'] = "No file uploaded.";
    header("Location: ../../fishermen_list.php");
    exit();
}
?>
