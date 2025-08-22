<?php
include 'D:\xamp\htdocs\Capstone\functions\conn.php'; // Adjust path if needed

// Fetch fish data with image column
$sql = "SELECT fish_id, fish_name, scientific_name, fish_description, image_path FROM Fish ORDER BY fish_name ASC";
$result = mysqli_query($conn, $sql);

if ($result && mysqli_num_rows($result) > 0) {
    while ($fish = mysqli_fetch_assoc($result)) {
        // Set image path, use default if not set
        $imagePath = !empty($fish['image_path']) ? htmlspecialchars($fish['image_path']) : 'assets/images/default-fish.png';

        echo '<tr class="tr-shadow">
            <td>
                <label class="au-checkbox">
                    <input type="checkbox">
                    <span class="au-checkmark"></span>
                </label>
            </td>

            <!-- Fish Image Column -->
            <td>
                <img src="' . $imagePath . '" alt="Fish Image" width="50" height="50" style="object-fit: cover; border-radius: 8px;">
            </td>
            <td>' . htmlspecialchars($fish['fish_name']) . '</td>
            <td>' . htmlspecialchars($fish['scientific_name']) . '</td>
            <td>' . htmlspecialchars($fish['fish_description']) . '</td>
            <td>
                <div class="table-data-feature">
                    <button class="item" data-toggle="tooltip" title="Send">
                        <i class="zmdi zmdi-mail-send"></i>
                    </button>
                    <a href="forms/edit-fish-form.php?id=' . $fish['fish_id'] . '" class="item" data-toggle="tooltip" title="Edit">
                        <i class="zmdi zmdi-edit"></i>
                    </a>
                    <a href="functions/delete-func/delete-fish.php?id=' . $fish['fish_id'] . '" class="item" data-toggle="tooltip" title="Delete" onclick="return confirm(\'Are you sure you want to delete this fish?\');">
                        <i class="zmdi zmdi-delete"></i>
                    </a>
                    <button class="item" data-toggle="tooltip" title="More">
                        <i class="zmdi zmdi-more"></i>
                    </button>
                </div>
            </td>
        </tr>';
    }
} else {
    echo '<tr><td colspan="6">No fish records found.</td></tr>'; // updated colspan
}

mysqli_close($conn);
?>
