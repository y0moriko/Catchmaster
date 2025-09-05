<?php
session_start(); 
include __DIR__ . '/../conn.php';

if (isset($_GET['id'])) {
    $catch_id = intval($_GET['id']);

    $sql = "UPDATE fishcatch SET status='Processed' WHERE catch_id=$catch_id";
    if (mysqli_query($conn, $sql)) {
        $_SESSION['success'] = "Status updated successfully!";
        header('Location: ../../fish_catch.php'); // make sure this path is correct
        exit();
    } else {
        $_SESSION['error'] = "Error updating status: " . mysqli_error($conn);
        header('Location: ../../fish_catch.php');
        exit();
    }
} else {
    $_SESSION['error'] = "No catch ID provided.";
    header('Location: ../../fish_catch.php');
    exit();
}
?>
