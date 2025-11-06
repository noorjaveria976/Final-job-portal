<?php
include('config.php');

if (isset($_POST['register-user'])) {

    $first_name     = $_POST['user_first_name'];
    $last_name      = $_POST['user_last_name'];
    $email          = $_POST['user_email'];
    $phone          = $_POST['user_phone'];
    $gender         = $_POST['user_gender'];
    $dob            = $_POST['user_dob'];
    $joining_date   = $_POST['user_joining_date'];
    $address        = $_POST['user_address'];
    $password       = $_POST['password'];
    $confirm_pass   = $_POST['confirm_password'];

    // ✅ role automatically assign ho seeker ko
    $role = "seeker"; // Ye sidebar role se match hota hai

    // Password hashing
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Insert query with role included
    $stmt = $conn->prepare("
        INSERT INTO users 
        (user_first_name, user_last_name, user_email, user_phone, user_gender, user_dob, user_joining_date, user_address, password, user_role)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
    ");

    $stmt->bind_param("ssssssssss", $first_name, $last_name, $email, $phone, $gender, $dob, $joining_date, $address, $hashed_password, $role);

    if ($stmt->execute()) {
        // Redirect to login page after successful register
        header("Location: login.php?registered=1");
        exit;
    } else {
        echo "<script>alert('Registration Failed!');</script>";
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>User Registration</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow">
                    <div class="card-header text-center">
                        <h4>Register User</h4>
                    </div>
                    <div class="card-body">
<!-- 
                        <?php if ($error) : ?>
                            <div class="alert alert-danger"><?= $error; ?></div>
                        <?php endif; ?>

                        <?php if ($success) : ?>
                            <div class="alert alert-success"><?= $success; ?></div>
                        <?php endif; ?> -->

                        <form method="POST" action="" class="needs-validation">

                            <div class="row">
                                <div class="mb-3 col-md-6">
                                    <label class="form-label">First Name</label>
                                    <input type="text" name="user_first_name" class="form-control" required>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Last Name</label>
                                    <input type="text" name="user_last_name" class="form-control" required>
                                </div>
                            </div>

                            <div class="row">
                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Email</label>
                                    <input type="email" name="user_email" class="form-control" required>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Contact</label>
                                    <input type="text" name="user_phone" class="form-control" required>
                                </div>
                            </div>

                            <div class="row">
                                <div class="mb-3 col-md-4">
                                    <label class="form-label">Gender</label>
                                    <select name="user_gender" class="form-select" required>
                                        <option value="">Select Gender</option>
                                        <option value="male">Male</option>
                                        <option value="female">Female</option>
                                    </select>
                                </div>

                                <div class="mb-3 col-md-4">
                                    <label class="form-label">Date of Birth</label>
                                    <input type="date" name="user_dob" class="form-control">
                                </div>

                                <div class="mb-3 col-md-4">
                                    <label class="form-label">Joining Date</label>
                                    <input type="date" name="user_joining_date" class="form-control">
                                </div>
                            </div>

                            <div class="row">
                                <!-- <div class="mb-3 col-md-4">
                                    <label class="form-label">Role</label>
                                    <select name="user_role" class="form-select" required>
                                        <option value="">Select Role</option>
                                        <option value="admin">Admin</option>
                                        <option value="manager">Manager</option>
                                        <option value="computer_technician">Computer Technician</option>
                                        <option value="seeker">Seeker</option>
                                    </select>
                                </div> -->

                                <div class="mb-3 col-md-8">
                                    <label class="form-label">Address</label>
                                    <input type="text" name="user_address" class="form-control" required>
                                </div>
                            </div>

                            <div class="row">
                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Password</label>
                                    <input type="password" name="password" class="form-control" required>
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Confirm Password</label>
                                    <input type="password" name="confirm_password" class="form-control" required>
                                </div>
                            </div>

                            <button type="submit" name="register-user" class="btn btn-primary w-100">Register</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
