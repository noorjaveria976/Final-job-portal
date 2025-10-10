

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
                        <form method="POST" action="" class="needs-validation" novalidate>
                            <div class="row">
                                <div class="mb-3 col-md-6">
                                    <label class="form-label">First_Name</label>
                                    <input type="text" name="user_first_name" class="form-control" required>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Last_Name</label>
                                    <input type="text" name="user_last_name" class="form-control" required>
                                </div>
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
                                    <label class="form-label">Joining_Date</label>
                                    <input type="date" name="user_joining_date" class="form-control">
                                </div>
                                <div class="mb-3 col-md-4">
                                    <label class="form-label">Role</label>
                                    <select name="user_role" class="form-select" required>
                                        <option value="">Select Role</option>
                                        <option value="admin">Admin</option>
                                        <option value="manager">Manager</option>
                                        <option value="computer_technician">Computer_Technician</option>
                                    </select>
                                </div>
                                <div class="mb-3 col-md-8">
                                    <label class="form-label">Address</label>
                                    <input type="text" name="user_address" class="form-control" required>
                                </div>
                                <!-- <div class="mb-3 col-md-2">
                                    <label class="form-label">Profile_Pic</label>
                                    <input type="file" name="user_profile_pic" class="form-control" required>
                                </div> -->
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>