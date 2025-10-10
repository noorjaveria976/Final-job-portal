<?php


include('config.php');

error_reporting(E_ALL);
ini_set('display_errors', 1);

if (isset($_POST['submit'])) {
  $name     = mysqli_real_escape_string($conn, $_POST['name']);
  $email    = mysqli_real_escape_string($conn, $_POST['email']);
  $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
  $role     = $_POST['role'];
  $status   = 'Active'; // default active

  // Check if email already exists
  $check_sql = "SELECT id FROM admin_users WHERE email='$email'";
  $check_result = mysqli_query($conn, $check_sql);

  if ($check_result && mysqli_num_rows($check_result) > 0) {
    $_SESSION['error'] = "This email is already registered!";
  } else {
    $sql = "INSERT INTO admin_users (name, email, password, role, status) 
                VALUES ('$name', '$email', '$password', '$role', '$status')";

    if (mysqli_query($conn, $sql)) {
      // ✅ Add session alert for Job Provider dashboard
      $_SESSION['new_active_admin'] = [
        'name' => $name,
        'email' => $email,
        'role' => $role
      ];
      $_SESSION['success'] = "Admin user added successfully!";
    } else {
      $_SESSION['error'] = "Error: " . mysqli_error($conn);
    }
  }
  header("Location: AdminUsers.php");
  exit();
}
?>
<!-- Main Content -->
<section class="section">
    <h4 class="mb-4">Add New Admin User</h4>

    <div class="card shadow-sm card-primary">
        <div class="card-body">
            <form method="POST" action="">
                <div class="mb-3">
                    <label class="form-label">Full Name</label>
                    <input type="text" name="name" class="form-control" placeholder="Enter name" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Email Address</label>
                    <input type="email" name="email" class="form-control" placeholder="Enter email" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" placeholder="Enter password" required>
                </div>
                <div class="form-group">
                    <label>Role</label>
                    <select name="role" class="form-control" required>
                        <option value="admin">Admin</option>
                        <option value="jobseeker">Job Seeker</option>
                        <option value="jobprovider">Job Provider</option>

                    </select>
                </div>

                <button type="submit" name="submit" class="btn btn-primary">Add User</button>
                <a href="AdminUsers.php" class="btn btn-secondary">Back</a>
            </form>
        </div>
    </div>
</section>