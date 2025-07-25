<?php
include 'D:\xamp\htdocs\Capstone\functions\conn.php';

// Fetch admin data
$sql = "SELECT user_id, fname, mname, lname, phone_number, barangay, municipality, province, birthday FROM User ORDER BY lname ASC";
$result = mysqli_query($conn, $sql);

if ($result && mysqli_num_rows($result) > 0) {
    while ($user = mysqli_fetch_assoc($result)) {
        echo '<tr class="tr-shadow">
            <td>
                <label class="au-checkbox">
                    <input type="checkbox">
                    <span class="au-checkmark"></span>
                </label>
            </td>
            <td>' . htmlspecialchars($user['fname']) . '</td>
            <td>' . htmlspecialchars($user['mname']) . '</td>
            <td>' . htmlspecialchars($user['lname']) . '</td>
            <td>' . htmlspecialchars($user['phone_number']) . '</td>
            <td>' . htmlspecialchars($user['barangay']) . '</td>
            <td>' . htmlspecialchars($user['birthday']) . '</td>
            <td>
            <div class="table-data-feature">
                <button class="item" data-toggle="tooltip" title="Send">
                    <i class="zmdi zmdi-mail-send"></i>
                </button>
                <button class="item" data-toggle="tooltip" title="Edit">
                    <i class="zmdi zmdi-edit"></i>
                </button>
                <a href="functions/delete-func/delete-fishermen.php?fisherman_id=' . $user['user_id'] . '" class="item" data-toggle="tooltip" title="Delete" onclick="return confirm(\'Are you sure you want to delete this fisherman?\');">
                    <i class="zmdi zmdi-delete"></i>
                </a>
                <button class="item" data-toggle="tooltip" title="More">
                    <i class="zmdi zmdi-more"></i>
                </button>
            </div>
            </td>
        </tr>
        <tr class="spacer"></tr>';
    }
} else {
    echo '<tr><td colspan="9">No admin records found.</td></tr>';
}

mysqli_close($conn);
?>
