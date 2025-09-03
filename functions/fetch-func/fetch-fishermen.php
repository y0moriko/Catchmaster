<?php
include 'D:\xamp\htdocs\Capstone\functions\conn.php';

// Fetch admin data
$sql = "SELECT user_id, fname, mname, lname, phone_number, barangay, municipality, province, birthday, image_path FROM User ORDER BY lname ASC";
$result = mysqli_query($conn, $sql);

if ($result && mysqli_num_rows($result) > 0) {
    while ($user = mysqli_fetch_assoc($result)) {
        $imagePath = !empty($user['image_path']) ? htmlspecialchars($user['image_path']) : '';
        echo '<tr class="tr-shadow">
            <td>
                <label class="au-checkbox">
                    <input type="checkbox">
                    <span class="au-checkmark"></span>
                </label>
            </td>

            <td>
                <img src="' . $imagePath . '" alt="Fishermen Image" width="50" height="50" style="object-fit: cover; border-radius: 8px;">
            </td>
            <td>' . htmlspecialchars($user['fname']) . '</td>
            <td>' . htmlspecialchars($user['mname']) . '</td>
            <td>' . htmlspecialchars($user['lname']) . '</td>
            <td>' . htmlspecialchars($user['phone_number']) . '</td>
            <td>' . htmlspecialchars($user['barangay']) . '</td>
            <td>' . htmlspecialchars($user['birthday']) . '</td>
            <td>
            <div class="table-data-feature">
                <a href="functions/delete-func/delete-fishermen.php?fisherman_id=' . $user['user_id'] . '" class="item" data-toggle="tooltip" title="Delete" onclick="return confirm(\'Are you sure you want to delete this fisherman?\');">
                    <i class="zmdi zmdi-delete"></i>
                </a>
                <a href="#" class="item edit-fisherman-btn" data-id=' . $user['user_id'] . ' " data-toggle="tooltip" title="Edit">
                    <i class="zmdi zmdi-edit"></i>
                </a>
            </div>
            </td>
        </tr>
        <tr class="spacer"></tr>';
    }
} else {
    echo '<tr><td colspan="9">No fishermen records found.</td></tr>';
}

mysqli_close($conn);
?>
