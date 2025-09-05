<?php
include 'D:/xamp/htdocs/Capstone/functions/conn.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $sql = "SELECT * FROM User WHERE user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user):
?>

<form action="functions/update-fishermen.php" method="POST" enctype="multipart/form-data">
  <input type="hidden" name="user_id" value="<?php echo $user['user_id']; ?>">

  <div class="form-group">
    <label>First Name</label>
    <input type="text" name="first_name" class="form-control" value="<?php echo htmlspecialchars($user['fname']); ?>" required>
  </div>

  <div class="form-group">
    <label>Middle Name</label>
    <input type="text" name="middle_name" class="form-control" value="<?php echo htmlspecialchars($user['mname']); ?>">
  </div>

  <div class="form-group">
    <label>Last Name</label>
    <input type="text" name="last_name" class="form-control" value="<?php echo htmlspecialchars($user['lname']); ?>" required>
  </div>

  <div class="form-group">
    <label>Contact</label>
    <input type="text" name="contact" class="form-control" value="<?php echo htmlspecialchars($user['phone_number']); ?>" required>
  </div>

  <div class="form-group">
    <label>Barangay</label>
    <input type="text" name="barangay" class="form-control" value="<?php echo htmlspecialchars($user['barangay']); ?>" required>
  </div>

  <div class="form-group">
    <label>Birthday</label>
    <input type="date" name="birthday" class="form-control" value="<?php echo htmlspecialchars($user['birthday']); ?>" required>
  </div>

  <div class="form-group">
    <label>Replace Image</label>
    <input type="file" name="new_image" class="form-control">
    <?php if ($user['image_path']): ?>
      <img src="<?php echo $user['image_path']; ?>" width="100" height="100" class="mt-2">
    <?php endif; ?>
  </div>

  <button type="submit" name="update_fisherman" class="btn btn-primary">Save Changes</button>
</form>

<?php
    endif;
}
?>
