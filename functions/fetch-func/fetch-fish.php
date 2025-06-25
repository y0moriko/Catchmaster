<?php
include 'D:\xamp\htdocs\Capstone\functions\conn.php'; // Adjust path if needed

// Fetch fish data
$sql = "SELECT fish_name, scientific_name, fish_description FROM Fish ORDER BY fish_name ASC";
$result = mysqli_query($conn, $sql);

if ($result && mysqli_num_rows($result) > 0) {
    while ($fish = mysqli_fetch_assoc($result)) {
        echo '<tr class="tr-shadow">
            <td>
                <label class="au-checkbox">
                    <input type="checkbox">
                    <span class="au-checkmark"></span>
                </label>
            </td>
            <td>' . htmlspecialchars($fish['fish_name']) . '</td>
            <td>' . htmlspecialchars($fish['scientific_name']) . '</td>
            <td>' . htmlspecialchars($fish['fish_description']) . '</td>
            <td>
                <div class="table-data-feature">
                    <button class="item" data-toggle="tooltip" title="Send">
                        <i class="zmdi zmdi-mail-send"></i>
                    </button>
                    <button class="item" data-toggle="tooltip" title="Edit">
                        <i class="zmdi zmdi-edit"></i>
                    </button>
                    <button class="item" data-toggle="tooltip" title="Delete">
                        <i class="zmdi zmdi-delete"></i>
                    </button>
                    <button class="item" data-toggle="tooltip" title="More">
                        <i class="zmdi zmdi-more"></i>
                    </button>
                </div>
            </td>
        </tr>';
    }
} else {
    echo '<tr><td colspan="5">No fish records found.</td></tr>';
}

mysqli_close($conn);
?>
