<?php
include 'D:\xamp\htdocs\Capstone\functions\conn.php';

// Fetch admin data
$sql = "SELECT fname, mname, lname, birthday, phone_number, gmail, address FROM Admin ORDER BY lname ASC";
$result = mysqli_query($conn, $sql);

if ($result && mysqli_num_rows($result) > 0) {
    while ($admin = mysqli_fetch_assoc($result)) {
        echo '<tr class="tr-shadow">
            <td>
                <label class="au-checkbox">
                    <input type="checkbox">
                    <span class="au-checkmark"></span>
                </label>
            </td>
            <td>' . htmlspecialchars($admin['fname']) . '</td>
            <td>' . htmlspecialchars($admin['mname']) . '</td>
            <td>' . htmlspecialchars($admin['lname']) . '</td>
            <td>' . htmlspecialchars($admin['birthday']) . '</td>
            <td>' . htmlspecialchars($admin['phone_number']) . '</td>
            <td><span class="block-email">' . htmlspecialchars($admin['gmail']) . '</span></td>
            <td class="desc">' . htmlspecialchars($admin['address']) . '</td>
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
        </tr>
        <tr class="spacer"></tr>';
    }
} else {
    echo '<tr><td colspan="9">No admin records found.</td></tr>';
}

mysqli_close($conn);
?>
