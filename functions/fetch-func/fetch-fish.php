<?php
include __DIR__ . '/../conn.php';

// Fetch fish data with image column
$sql = "SELECT fish_id, fish_name, scientific_name, family, habitat, fish_description, image_path FROM Fish ORDER BY fish_name ASC";
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
            <td>' . htmlspecialchars($fish['family']) . '</td>
            <td>' . htmlspecialchars($fish['habitat']) . '</td>
            <td>
                <div class="action-btns">
                    <button class="action-btn btn-edit" title="Edit" onclick="editFish(' . $fish['fish_id'] . ')">
                        <i class="fas fa-edit"></i>
                    </button>
                    <button class="action-btn btn-delete" title="Delete" onclick="confirmDelete(' . $fish['fish_id'] . ')">
                        <i class="fas fa-trash"></i>
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
