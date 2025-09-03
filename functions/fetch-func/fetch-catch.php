<?php
include 'D:\xamp\htdocs\Capstone\functions\conn.php'; // Adjust path if needed

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Fetch fish catch data
$sql = "
    SELECT
        fc.catch_id,
        fc.fish_id,
        f.fish_name,
        fc.quantity_kg,
        fc.location,
        fc.catch_date
    FROM
        fishcatch fc
    JOIN
        fish f ON fc.fish_id = f.fish_id
    ORDER BY
        fc.catch_date DESC";


$result = mysqli_query($conn, $sql);

if ($result && mysqli_num_rows($result) > 0) {
    while ($catch = mysqli_fetch_assoc($result)) {
        echo '<tr class="tr-shadow">
            <td>
                <label class="au-checkbox">
                    <input type="checkbox">
                    <span class="au-checkmark"></span>
                </label>
            </td>
            <td>' . htmlspecialchars($catch['fish_name']) . '</td>
            <td>' . htmlspecialchars($catch['quantity_kg']) . ' kg</td>
            <td>' . htmlspecialchars($catch['location']) . '</td>
            <td>' . htmlspecialchars($catch['catch_date']) . '</td>
            <td>
                <div class="table-data-feature">
                    <a href="functions/delete-func/delete-catch.php?id=' . $catch['catch_id'] . '" class="item" data-toggle="tooltip" title="Delete" onclick="return confirm(\'Are you sure you want to delete this catch?\');">
                        <i class="zmdi zmdi-delete"></i>
                    </a>
                </div>
            </td>
        </tr>';
    }
} else {
    echo '<tr><td colspan="5">No fish catch records found.</td></tr>'; // Adjusted colspan to 5
}

mysqli_close($conn);
?>
