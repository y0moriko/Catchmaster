<?php
include __DIR__ . '/../conn.php';

// Check if 'status' column exists
$statusExists = mysqli_query($conn, "SHOW COLUMNS FROM User LIKE 'status'");
$hasStatus = mysqli_num_rows($statusExists) > 0;

// Fetch fishermen data
$sql = "SELECT user_id, fname, mname, lname, phone_number, barangay, birthday, image_path, " . ($hasStatus ? "status" : "'Active' AS status") . " FROM User ORDER BY lname ASC";
$result = mysqli_query($conn, $sql);

if ($result && mysqli_num_rows($result) > 0) {
    while ($user = mysqli_fetch_assoc($result)) {
        $imagePath = !empty($user['image_path']) ? htmlspecialchars($user['image_path']) : 'https://via.placeholder.com/50x50?text=NA';
        $fullName = htmlspecialchars($user['fname'] . ' ' . $user['mname'] . ' ' . $user['lname']);

        $birthday = new DateTime($user['birthday']);
        $today = new DateTime();
        $age = $birthday->diff($today)->y;

        $status = htmlspecialchars($user['status']);
        $statusClass = strtolower($status) === 'active' ? 'status-active' : 'status-inactive';

        echo "<tr>
            <td><input type='checkbox' class='custom-checkbox'></td>
            <td><img src='{$imagePath}' alt='Profile' class='profile-image'></td>
            <td>
                <div class='fisherman-name'>{$fullName}</div>
                <div class='contact-info'>Member since ...</div>
            </td>
            <td>" . htmlspecialchars($user['phone_number']) . "</td>
            <td>" . htmlspecialchars($user['barangay']) . "</td>
            <td><span class='age-badge'>{$age}</span></td>
            <td><span class='status-badge {$statusClass}'>{$status}</span></td>
            <td>
                <div class='action-btns'>
                    <button class='action-btn btn-edit' onclick='editFisherman(" . $user['user_id'] . ")'>
                        <i class='fas fa-edit'></i>
                    </button>
                    <button class='action-btn btn-delete' onclick='confirmDelete(" . $user['user_id'] . ")'>
                        <i class='fas fa-trash'></i>
                    </button>
                </div>
            </td>
        </tr>";
    }
} else {
    echo "<tr><td colspan='8'>No fishermen records found.</td></tr>";
}

mysqli_close($conn);
?>
