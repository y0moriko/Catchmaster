<?php
include 'D:/xamp/htdocs/Capstone/functions/conn.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $stmt = $conn->prepare("SELECT * FROM admin WHERE admin_id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $person = $result->fetch_assoc();

    if ($person):
?>

<form action="functions/update-personnel.php" method="POST" enctype="multipart/form-data">
  <input type="hidden" name="admin_id" value="<?php echo $person['admin_id']; ?>">

  <div class="form-group">
    <label>First Name</label>
    <input type="text" name="fname" class="form-control" value="<?php echo htmlspecialchars($person['fname']); ?>" required>
  </div>

  <div class="form-group">
    <label>Middle Name</label>
    <input type="text" name="mname" class="form-control" value="<?php echo htmlspecialchars($person['mname']); ?>">
  </div>

  <div class="form-group">
    <label>Last Name</label>
    <input type="text" name="lname" class="form-control" value="<?php echo htmlspecialchars($person['lname']); ?>" required>
  </div>

  <div class="form-group">
    <label>Email</label>
    <input type="email" name="gmail" class="form-control" value="<?php echo htmlspecialchars($person['gmail']); ?>" required>
  </div>

  <div class="form-group">
    <label>Role</label>
    <input type="text" name="department_role" class="form-control" value="<?php echo htmlspecialchars($person['department_role']); ?>" required>
  </div>

  <div class="form-group">
    <label>Replace Image</label>
    <input type="file" name="new_image" class="form-control">
    <?php if ($person['image_path']): ?>
      <img src="<?php echo $person['image_path']; ?>" width="100" height="100" class="mt-2">
    <?php endif; ?>
  </div>

  <button type="submit" class="btn btn-primary">Save Changes</button>
</form>

<?php
    endif;
}
?>
