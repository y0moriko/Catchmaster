<?php
include __DIR__ . '/../functions/conn.php';

$personnel_id = $_GET['id'] ?? 0;
$stmt = $conn->prepare("SELECT * FROM admin WHERE admin_id = ?");
$stmt->bind_param("i", $personnel_id);
$stmt->execute();
$result = $stmt->get_result();
$person = $result->fetch_assoc();
?>

<form method="POST" action="functions/update-func/update-personnel.php" enctype="multipart/form-data">
    <input type="hidden" name="personnel_id" value="<?= $person['admin_id'] ?>">
    
    <div class="row mb-3">
        <div class="col-md-4 text-center">
            <label>Profile Image</label>
            <input type="file" class="form-control mb-2" name="photo" onchange="previewPersonnelImage(event)">
            <img id="personnelPreview" src="<?= $person['image_path'] ?: 'assets/default-profile.png' ?>" 
                 style="display:block; max-width:100px; margin-top:10px; border-radius:6px; border:1px solid #d1d5db;">
        </div>
        <div class="col-md-8">
            <div class="form-group">
                <label>First Name</label>
                <input type="text" name="fname" class="form-control" value="<?= htmlspecialchars($person['fname']) ?>" required>
            </div>
            <div class="form-group">
                <label>Middle Name</label>
                <input type="text" name="mname" class="form-control" value="<?= htmlspecialchars($person['mname']) ?>">
            </div>
            <div class="form-group">
                <label>Last Name</label>
                <input type="text" name="lname" class="form-control" value="<?= htmlspecialchars($person['lname']) ?>" required>
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="gmail" class="form-control" value="<?= htmlspecialchars($person['gmail']) ?>" required>
            </div>
            <div class="form-group">
                <label>Phone Number</label>
                <input type="text" name="phone_number" class="form-control" value="<?= htmlspecialchars($person['phone_number']) ?>" required>
            </div>
            <div class="form-group">
                <label>Department Role</label>
                <input type="text" name="department_role" class="form-control" value="<?= htmlspecialchars($person['department_role']) ?>" required>
            </div>
        </div>
    </div>
    
    <div class="text-right mt-3">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Update Personnel</button>
    </div>
</form>

<script>
function previewPersonnelImage(event) {
    const preview = document.getElementById('personnelPreview');
    const file = event.target.files[0];
    if(file) preview.src = URL.createObjectURL(file);
}
</script>
