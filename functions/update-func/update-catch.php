<?php
session_start();
include __DIR__ . '/../conn.php';

    if (!isset($_POST['catch_id'])) {
        $_SESSION['error'] = "Invalid request.";
        header("Location: ../../fishcatch.php");
        exit();
    }

    $catch_id = intval($_POST['catch_id']);
    $fish_id = intval($_POST['fish_id']);
    $quantity_kg = floatval($_POST['quantity_kg']);
    $location = mysqli_real_escape_string($conn, $_POST['location']);
    $catch_date = mysqli_real_escape_string($conn, $_POST['catch_date']);
    $status = mysqli_real_escape_string($conn, $_POST['status']);

    if (!$fish_id || !$quantity_kg || !$location || !$catch_date || !$status) {
        $_SESSION['error'] = "All fields are required.";
        header("Location: ../../fishcatch.php");
        exit();
    }

    //Query
    $sql = "UPDATE fishcatch
            SET fish_id = ?, quantity_kg = ?, location = ?, catch_date = ?, status = ?
            WHERE catch_id = ?";

    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "idsssi", $fish_id, $quantity_kg, $location, $catch_date, $status, $catch_id);

    if (mysqli_stmt_execute($stmt)) {
        $_SESSION['success'] = "Fish catch updated successfully!";
    } else {
        $_SESSION['error'] = "Failed to update fish catch: " . mysqli_error($conn);
    }

    mysqli_stmt_close($stmt);
    mysqli_close($conn);

    // Redirect
    header("Location: ../../fish_catch.php");
    exit();
    ?>
