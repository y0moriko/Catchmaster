<?php
include __DIR__ . '/../conn.php';

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
        fc.catch_date,
        fc.status
    FROM
        fishcatch fc
    JOIN
        fish f ON fc.fish_id = f.fish_id
    ORDER BY
        fc.catch_date DESC";

$result = mysqli_query($conn, $sql);

if ($result && mysqli_num_rows($result) > 0) {
    while ($catch = mysqli_fetch_assoc($result)) {
        $status = htmlspecialchars($catch['status']);
        $statusClass = strtolower($catch['status']); // e.g., 'fresh' or 'processed'
        echo '<tr>
            <td><input type="checkbox"></td>
            <td><strong>' . htmlspecialchars($catch['fish_name']) . '</strong></td>
            <td>' . htmlspecialchars($catch['quantity_kg']) . '</td>
            <td>' . htmlspecialchars($catch['location']) . '</td>
            <td>' . date("M d, Y - h:i A", strtotime($catch['catch_date'])) . '</td>
            <td>
                <span class="status-badge status-' . $statusClass . '">' . $status . '</span>';
        
        // Show process button only if status is Fresh
        if ($catch['status'] === 'Fresh') {
            echo ' <button class="action-btn btn-process" title="Mark as Processed" onclick="markProcessed(' . $catch['catch_id'] . ')">
                    <i class="fas fa-check"></i>
                </button>';
        }
        echo '</td>
            <td>
                <div class="action-btns">
                    <button class="action-btn btn-edit" title="Edit" onclick="editCatch(' . $catch['catch_id'] . ')">
                        <i class="fas fa-edit"></i>
                    </button>
                    <button class="action-btn btn-delete" title="Delete" onclick="showDeleteModal(\'functions/delete-func/delete-catch.php?id=' . $catch['catch_id'] . '\')">
                        <i class="fas fa-trash"></i>
                    </button>
                </div>
            </td>
        </tr>';
    }
} else {
    echo '<tr><td colspan="7">No fish catch records found.</td></tr>';
}

mysqli_close($conn);
?>
