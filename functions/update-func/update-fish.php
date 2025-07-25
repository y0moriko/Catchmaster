<?php
include '../conn.php';

if (isset($_POST['update_fish'])) {
    $id = $_POST['fish_id'];
    $name = $_POST['fish_name'];
    $sci = $_POST['scientific_name'];
    $desc = $_POST['fish_description'];

    // Check if new image is uploaded
    if ($_FILES['new_image']['name']) {
        $imgName = basename($_FILES['new_image']['name']);
        $targetDir = "../../uploads/fish/";
        $targetPath = $targetDir . $imgName;
        move_uploaded_file($_FILES['new_image']['tmp_name'], $targetPath);

        $sql = "UPDATE Fish SET 
                    fish_name='$name', 
                    scientific_name='$sci', 
                    fish_description='$desc', 
                    image_path='$imgName'
                WHERE fish_id=$id";
    } else {
        // No image uploaded
        $sql = "UPDATE Fish SET 
                    fish_name='$name', 
                    scientific_name='$sci', 
                    fish_description='$desc'
                WHERE fish_id=$id";
    }

    if (mysqli_query($conn, $sql)) {
        header("Location: ../../fish-list.php?updated=1");
        exit;
    } else {
        echo "Error updating fish: " . mysqli_error($conn);
    }
}
?>
