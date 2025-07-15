<?php
// session_start();
include 'D:\xamp\htdocs\Capstone\functions\conn.php';

// Debug: Check connection
if (!$conn) {
    die("Debug: Database connection failed: " . mysqli_connect_error());
}
echo "Debug: Database connected successfully<br>";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Debug: Show all POST data
    echo "Debug: POST data - ";
    print_r($_POST);
    echo "<br>";

    // Sanitize inputs
    function cleanInput($conn, $input) {
        return mysqli_real_escape_string($conn, trim($input));
    }

    $fish_name = cleanInput($conn, $_POST['species_name'] ?? '');
    $quantity = cleanInput($conn, $_POST['number'] ?? '');
    $location = cleanInput($conn, $_POST['address'] ?? '');
    $date = cleanInput($conn, $_POST['date'] ?? '');
    $time = cleanInput($conn, $_POST['time'] ?? '');

    // Debug: Show sanitized inputs
    echo "Debug: Sanitized inputs - Fish: $fish_name, Qty: $quantity, Location: $location, Date: $date, Time: $time<br>";

    // Basic validation
    if (empty($fish_name) || empty($quantity) || empty($location) || empty($date) || empty($time)) {
        $_SESSION['error'] = 'Please fill in all required fields.';
        header("Location: {$_SERVER['HTTP_REFERER']}");
        exit();
    }

    // Combine date and time into datetime format
    $catch_datetime = "$date $time";
    echo "Debug: Combined datetime: $catch_datetime<br>";

    // Fetch fish_id based on fish_name
    $sql = "SELECT fish_id FROM fish WHERE fish_name = ?";
    $stmt = mysqli_prepare($conn, $sql);
    
    if (!$stmt) {
        $_SESSION['error'] = "Database preparation error. Please try again.";
        header("Location: {$_SERVER['HTTP_REFERER']}");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "s", $fish_name);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $fish_id);
    mysqli_stmt_fetch($stmt);
    mysqli_stmt_close($stmt);

    // Debug: Check if fish_id was found
    if (empty($fish_id)) {
        $_SESSION['error'] = "Fish not found in the database.";
        header("Location: {$_SERVER['HTTP_REFERER']}");
        exit();
    } else {
        echo "Debug: Found fish_id: $fish_id<br>";
    }

    // Insert into fishcatch table with combined datetime
    $sql = "INSERT INTO fishcatch (fish_id, quantity_kg, location, catch_date) VALUES (?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    
    if (!$stmt) {
        $_SESSION['error'] = "Database preparation error. Please try again.";
        header("Location: {$_SERVER['HTTP_REFERER']}");
        exit();
    }
    
    mysqli_stmt_bind_param($stmt, "idss", $fish_id, $quantity, $location, $catch_datetime);

    if (mysqli_stmt_execute($stmt)) {
        $_SESSION['success'] = "Fish catch added successfully!";
        echo "Debug: Successfully inserted record<br>";
        header("Location: ../../fish_catch.php");
        exit();
    } else {
        $_SESSION['error'] = "Error adding fish catch: " . mysqli_error($conn);
        echo "Debug: Insert failed: " . mysqli_error($conn) . "<br>";
        header("Location: {$_SERVER['HTTP_REFERER']}");
        exit();
    }

    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}
?>
