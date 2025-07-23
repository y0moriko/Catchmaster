<!DOCTYPE html>
<html lang="en">
<head>
  <?php include 'header.php'; ?>
  <meta charset="UTF-8">
  <title>Profile & Fisheries Section</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.6.2/css/bootstrap.min.css" rel="stylesheet">

  <style>
    body {
      background-color: lightgray;
      margin: 0;
      padding: 0;
      font-family: 'Segoe UI', sans-serif;
    }

    .main-container {
      display: flex;
      justify-content: center;
      align-items: flex-start;
      gap: 40px;
      padding: 130px 20px 60px;
      flex-wrap: wrap;
    }

    .account-container,
    .card {
      background-color: #ffffff;
      border-radius: 20px;
      box-shadow: 0 12px 30px rgba(0, 0, 0, 0.12);
      padding: 35px;
      width: 550px;
    }

    .profile-picture {
      width: 130px;
      height: 130px;
      object-fit: cover;
      border-radius: 50%;
      border: 3px solid #007bff;
      display: block;
      margin: 0 auto 15px;
    }

    .account-header h3 {
      text-align: center;
      font-size: 24px;
      margin-bottom: 10px;
      color: #222;
    }

    .profile-info,
    .settings {
      margin-top: 25px;
    }

    .profile-info h3,
    .settings h3 {
      font-size: 17px;
      margin-bottom: 10px;
      color: #007bff;
    }

    .profile-row {
      display: flex;
      justify-content: space-between;
      margin-bottom: 10px;
      font-size: 15px;
    }

    .profile-row label {
      font-weight: 600;
      color: #444;
    }

    .profile-row span {
      color: #555;
    }

    .btn {
      margin-top: 12px;
      background-color: #007bff;
      color: white;
      border: none;
      padding: 9px 18px;
      border-radius: 6px;
      cursor: pointer;
      transition: 0.3s;
      font-size: 14px;
    }

    .btn:hover {
      background-color: #0056b3;
    }

    .card h2 {
      font-size: 22px;
      margin-bottom: 10px;
      color: #222;
      text-align: center;
    }

    .card p {
      font-size: 15px;
      text-align: center;
      color: #666;
      margin-bottom: 20px;
    }

    .inner-cards-container {
      display: flex;
      flex-wrap: wrap;
      gap: 14px;
      justify-content: space-between;
    }

    .inner-card {
      flex: 1 1 calc(48% - 10px);
      text-align: center;
      padding: 14px;
      background-color: #f0f4fa;
      color: #007bff;
      border-radius: 10px;
      text-decoration: none;
      font-weight: 600;
      font-size: 14px;
      transition: 0.3s ease;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
    }

    .inner-card:hover {
      background-color: #007bff;
      color: #fff;
      transform: translateY(-2px);
    }

    @media screen and (max-width: 700px) {
      .main-container {
        flex-direction: column;
        align-items: center;
      }

      .inner-card {
        flex: 1 1 100%;
      }
    }

    .personnel-container {
  display: flex;
  flex-wrap: wrap;
  gap: 20px;
  justify-content: space-around;
}

.personnel-card {
  display: flex;
  align-items: flex-start;
  background-color: #f8f9fa;
  padding: 15px;
  border-radius: 10px;
}


.personnel-card h4 {
  margin: 10px 0 8px;
  font-size: 18px;
  color: #333;
}

.personnel-card p {
  font-size: 14px;
  color: #555;
  margin: 4px 0;
}
.custom-modal {
  max-width: 50%;
}

.modal-body {
  max-height: 80vh;
  overflow-y: auto;
}

.capitalize-first-letter {
  text-transform: capitalize;
}

\.info-block {
    min-width: 100%;
  }

  .info-block p, .info-block h5 {
    margin-left: 0;
    text-align: left;
  }

  .personnel-card {
    width: 100%;
  }
  </style>
</head>
<body>

<!-- Profile Card -->
<div class="main-container">
  <div class="account-container">
    <img src="images/icon/jk.jpg" alt="Jeon Jungkook" class="profile-picture">
    <div class="account-header">
      <h3>Juan Dela Cruz</h3>
  </div>
    <div class="profile-info">
      <h3>Profile Information</h3>
      <div class="profile-row"><label>Full Name:</label><span>Juan Dela Cruz</span></div>
      <div class="profile-row"><label>Email:</label><span>juan@gmail.com</span></div>
      <div class="profile-row"><label>Username:</label><span>Juan</span></div>
      <div class="profile-row"><label>Department:</label><span>Agriculture</span></div>
      <div class="profile-row"><label>Role:</label><span>Department Head</span></div>
      <button class="btn" data-toggle="modal" data-target="#editProfileModal">Edit Profile</button>
    </div>
  </div>

<!-- EDIT PROFILE MODAL -->
<div class="modal fade" id="editProfileModal"  role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <form class="modal-content" id="editProfileForm">
      <div class="modal-header">
        <h5 class="modal-title">Edit Profile</h5>
        <button type="button" class="close" data-dismiss="modal">
          
        </button>
      </div>

      <div class="modal-body">
        <div class="form-row">
          <div class="form-group col-md-6">
            <label>Full Name</label>
            <input type="text" class="form-control" name="fullName" value="Juan Dela Cruz">
          </div>
          <div class="form-group col-md-6">
            <label>Email</label>
            <input type="email" class="form-control" name="email" value="juan@gmail.com">
          </div>
        </div>

        <div class="form-row">
          <div class="form-group col-md-6">
            <label>Username</label>
            <input type="text" class="form-control" name="username" value="Juan">
          </div>
          <div class="form-group col-md-6">
            <label>Department</label>
            <input type="text" class="form-control" name="department" value="Agriculture">
          </div>
        </div>

        <div class="form-group">
          <label>Role</label>
          <input type="text" class="form-control" name="role" value="Department Head">
        </div>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-primary">Save Changes</button>
      </div>
    </form>
  </div>
</div>

<!--Fisheries Personnel Card  -->
<div class="row">

  <!-- Right Card -->
  <div class="col-md-6">
    <div class="card p-4" style="border-radius: 15px; box-shadow: 0 4px 12px rgba(0,0,0,0.1); text-align: center">
      <h3 class="mb-4">Fisheries Personnel List</h3>

      <!-- Personnel Cards -->
      <div class="personnel-card d-flex mb-4 align-items-start">
        <img src="images/icon/jk.jpg" alt="Profile" class="mr-3" style="width: 80px; height: 80px; border-radius: 50%;">
        <div class="info-block">
          <h5 class="mb-1">Jungkook Santos</h5>
          <p class="mb-1"><strong>Email:</strong> jk.santos@example.com</p>
          <p class="mb-1"><strong>Department:</strong> Fisheries</p>
          <p class="mb-1"><strong>Role:</strong>Head</p>
        </div>
      </div>

      <div class="personnel-card d-flex mb-4 align-items-start">
        <img src="images/icon/sop.jpg" alt="Profile" class="mr-3" style="width: 80px; height: 80px; border-radius: 50%;">
        <div class="info-block">
          <h5 class="mb-1">Sophia Madrigal</h5>
          <p class="mb-1"><strong>Email:</strong> madrigal@example.com</p>
          <p class="mb-1"><strong>Department:</strong> Fisheries</p>
          <p class="mb-1"><strong>Role:</strong>Ganda Lang</p>
        </div>
      </div>

      <div class="personnel-card d-flex mb-4 align-items-start">
        <img src="images/icon/kar.jpeg" alt="Profile" class="mr-3" style="width: 80px; height: 80px; border-radius: 50%;">
        <div class="info-block">
          <h5 class="mb-1">Kare Lim</h5>
          <p class="mb-1"><strong>Email:</strong> karelim@example.com</p>
          <p class="mb-1"><strong>Department:</strong> Fisheries</p>
          <p class="mb-1"><strong>Role:</strong> Field Officer</p>
        </div>
      </div>

      

      <!-- Add Personnel Button -->
      <div class="text-center mt-4">
    <button class="btn btn-primary" data-toggle="modal" data-target="#addMemberModal">
      Add Personnel
    </button>
  </div>
</div>

<!-- Add Personnel Modal -->
<div class="modal fade" id="addMemberModal" tabindex="-1" role="dialog" aria-labelledby="addMemberModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog modal-md" role="document">
    <form class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addMemberModalLabel">Add Personnel</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span>&times;</span></button>
      </div>

      <div class="modal-body">
        <div class="form-group text-center">
          <label for="profilePic"><strong>Profile Picture</strong></label><br>
          <input type="file" id="profilePic" class="form-control-file" accept="image/*">
        </div>
        <div class="form-group">
          <label for="fullName">Full Name</label>
          <input type="text" class="form-control capitalize-first-letter" id="fullName" required>
        </div>
        <div class="form-group">
          <label for="email">Email Address</label>
          <input type="email" class="form-control" id="email" required>
        </div>
        <div class="form-group">
          <label for="department">Department</label>
          <input type="text" class="form-control capitalize-first-letter" id="department" required>
        </div>
        <div class="form-group">
          <label for="role">Role</label>
          <input type="text" class="form-control capitalize-first-letter" id="role" required>
        </div>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-primary">Add Member</button>
      </div>
    </form>
  </div>
</div>

<style>
  .capitalize-first-letter {
    text-transform: capitalize;
  }
</style>


   
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="vendor/bootstrap-4.1/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.6.2/js/bootstrap.min.js"></script>


<script>
  document.getElementById("editProfileForm").addEventListener("submit", function (e) {
    e.preventDefault(); // Stop default form submission
  });

  document.querySelectorAll('.capitalize-first-letter').forEach(input => {
    input.addEventListener('input', function () {
      this.value = this.value
        .toLowerCase()
        .replace(/\b\w/g, c => c.toUpperCase());
    });
  });
</script>

</body>
</html>
