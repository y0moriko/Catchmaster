<?php
session_start();
include 'D:/xamp/htdocs/Capstone/functions/conn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    function cleanInput($conn, $input) {
        return mysqli_real_escape_string($conn, trim($input));
    }

    $user_id = intval($_POST['user_id'] ?? 0);
    $fname = cleanInput($conn, $_POST['first_name'] ?? '');
    $mname = cleanInput($conn, $_POST['middle_name'] ?? '');
    $lname = cleanInput($conn, $_POST['last_name'] ?? '');
    $phone = cleanInput($conn, $_POST['contact'] ?? '');
    $email = cleanInput($conn, $_POST['email'] ?? '');
    $barangay = cleanInput($conn, $_POST['barangay'] ?? '');
    $birthday = cleanInput($conn, $_POST['birthday'] ?? '');
    $image_path = null;

    if (!$user_id || !$fname || !$lname || !$phone || !$barangay || !$birthday) {
        $_SESSION['error'] = "Please fill in all required fields.";
        header("Location: {$_SERVER['HTTP_REFERER']}");
        exit();
    }

    // ✅ Handle image upload if provided
    if (isset($_FILES['new_image']) && $_FILES['new_image']['error'] === UPLOAD_ERR_OK) {
        $img_tmp = $_FILES['new_image']['tmp_name'];
        $img_name = basename($_FILES['new_image']['name']);
        $img_name = preg_replace("/[^a-zA-Z0-9.\-_]/", "", $img_name);
        $upload_dir = "uploads/fishermen_images/";
        if (!is_dir($upload_dir)) mkdir($upload_dir, 0755, true);
        $target_file = $upload_dir . uniqid() . "_" . $img_name;
        if (move_uploaded_file($img_tmp, $target_file)) {
            $image_path = $target_file;
        } else {
            $_SESSION['error'] = "Failed to upload image.";
            header("Location: {$_SERVER['HTTP_REFERER']}");
            exit();
        }
    }

    // ✅ Build SQL query
    $sql = "UPDATE User SET fname = ?, mname = ?, lname = ?, phone_number = ?, gmail = ?, barangay = ?, birthday = ?";
    if ($image_path) {
        $sql .= ", image_path = ?";
    }
    $sql .= " WHERE user_id = ?";

    // ✅ Prepare statement
    if ($image_path) {
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssssssi", $fname, $mname, $lname, $phone, $email, $barangay, $birthday, $image_path, $user_id);
    } else {
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssssssi", $fname, $mname, $lname, $phone, $email, $barangay, $birthday, $user_id);
    }

    // ✅ Execute and respond
    if ($stmt->execute()) {
        $_SESSION['success'] = "Fisherman updated successfully.";
    } else {
        $_SESSION['error'] = "Update failed: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
    header("Location: ../../fishermen_list.php");
    exit();
}
?>
