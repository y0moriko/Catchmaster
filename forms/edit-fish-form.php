<?php
include 'D:\xamp\htdocs\Capstone\functions\conn.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Fetch current data
    $sql = "SELECT * FROM Fish WHERE fish_id = $id";
    $result = mysqli_query($conn, $sql);
    $fish = mysqli_fetch_assoc($result);

    if (!$fish) {
        echo "Fish not found!";
        exit;
    }
} else {
    echo "No ID specified!";
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Fish</title>
</head>
<body>
    <h2>Edit Fish Info</h2>

    <form action="functions/update-func/update-fish.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="fish_id" value="<?php echo $fish['fish_id']; ?>">

        <label>Fish Name:</label>
        <input type="text" name="fish_name" value="<?php echo htmlspecialchars($fish['fish_name']); ?>"><br>

        <label>Scientific Name:</label>
        <input type="text" name="scientific_name" value="<?php echo htmlspecialchars($fish['scientific_name']); ?>"><br>

        <label>Description:</label>
        <textarea name="fish_description"><?php echo htmlspecialchars($fish['fish_description']); ?></textarea><br>

        <label>Current Image:</label><br>
        <img src="uploads/fish/<?php echo $fish['image_path']; ?>" width="100" height="100"><br>

        <label>Replace Image:</label>
        <input type="file" name="new_image"><br>

        <button type="submit" name="update_fish">Save Changes</button>
    </form>
</body>
</html>
