<?php
if (isset($_GET['delete_id'])) {
    die("Delete ID received: " . $_GET['delete_id']);
}
?>


<?php


include('config.php');
echo $conn->affected_rows;

if (isset($_GET['delete_id'])) {
    $id = intval($_GET['delete_id']);

    // Check if user exists
    $check = $conn->query("SELECT user_role FROM users WHERE user_id = $user_id");
    if ($check->num_rows == 0) {
        echo "<script>alert('User not found!'); window.history.back();</script>";
        exit;
    }

    $user = $check->fetch_assoc();

    // Protect last admin
    if ($user['user_role'] == 'admin') {
        $count = $conn->query("SELECT COUNT(*) AS total FROM users WHERE user_role='admin'");
        $total = $count->fetch_assoc()['total'];

        if ($total <= 1) {
            echo "<script>alert('Last admin cannot be deleted!'); window.history.back();</script>";
            exit;
        }
    }

    // Delete user
    $delete = $conn->query("DELETE FROM users WHERE user_id = $user_id");

    if ($delete) {
        echo "<script>alert('User deleted successfully'); window.location='layout.php?page=adduser';</script>";
    } else {
        echo "<script>alert('Deletion failed: " . $conn->error . "');</script>";
    }
    exit;
}


// actuall start
if (isset($_POST['register-user'])) {
    $user_first_name = trim($_POST['user_first_name']);
    $user_last_name  = trim($_POST['user_last_name']);
    $user_email      = trim($_POST['user_email']);
    $user_phone      = trim($_POST['user_phone']);
    $user_gender     = trim($_POST['user_gender']);
    $user_dob        = trim($_POST['user_dob']);
    $user_address        = trim($_POST['user_address']);
    $user_joining_date = trim($_POST['user_joining_date']);
    $user_role       = trim($_POST['user_role']);
    $password        = trim($_POST['password']);
    $confirm_password = trim($_POST['confirm_password']);

    // Check passwords match
    if ($password !== $confirm_password) {
        echo "<script>alert('Passwords do not match');</script>";
    } else {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Check if email exists
        $stmt = $conn->prepare("SELECT user_id FROM users WHERE user_email = ?");
        $stmt->bind_param("s", $user_email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            echo "<script>alert('Email already registered');</script>";
        } else {
            // Insert new user
            $stmt_insert = $conn->prepare("INSERT INTO users 
(user_first_name, user_last_name, user_email, user_phone, user_gender, user_dob, user_address, user_joining_date, user_role, password, created_at) 
VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())");

            $stmt_insert->bind_param(
                "ssssssssss",
                $user_first_name,
                $user_last_name,
                $user_email,
                $user_phone,
                $user_gender,
                $user_dob,
                $user_address,
                $user_joining_date,
                $user_role,
                $hashed_password
            );


            if ($stmt_insert->execute()) {
                echo "<script>alert('Registration successful'); </script>";
            } else {
                echo "Error: " . $stmt_insert->error;
            }
            $stmt_insert->close();
        }
        $stmt->close();
    }
}
?>
<?php

?>


<!-- Main Content -->
<section class="section">
    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div>
                    <div class="card-header d-flex justify-content-between">
                        <h4>Employee Detials</h4>
                        <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#registerUserModal">
                            Register User
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover" id="tableExport" style="width:100%;">
                                <thead>
                                    <tr>
                                        <th>Sr.#</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone no</th>
                                        <th>Joining date</th>
                                        <th>Address</th>
                                        <th>Role</th>
                                        <th>Details</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                    $sql = "SELECT user_id, 
                    CONCAT(user_first_name, ' ', user_last_name) AS full_name, 
                    user_email, user_phone, user_address, 
                    user_joining_date, user_role, created_at 
                    FROM users";

                                    $result = $conn->query($sql);
                                    $sr= 1; // Serial number start

                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                    ?>

                                            <tr>
                                                <td><?php echo $sr++; ?></td>
                                                <td><?php echo $row['full_name']; ?></td>
                                                <td><?php echo $row['user_email']; ?></td>
                                                <td><?php echo $row['user_phone']; ?></td>
                                                <td><?php echo $row['user_joining_date']; ?></td>
                                                <td><?php echo $row['user_address']; ?></td>
                                                <td><?php echo $row['user_role']; ?></td>
                                                <td><button class="btn btn-sm btn-primary">Detail</button></td>
                                                <td>
                                                    <button class="btn btn-sm btn-primary">Edit</button>
                                                    <a href="layout.php?page=adduser&delete_id=<?php echo $row['user_id']; ?>"
                                                        class="btn btn-danger btn-sm"
                                                        onclick="return confirm('Are you sure?')">
                                                        Delete
                                                    </a>





                                                </td>
                                            </tr>

                                    <?php
                                        }
                                    } else {
                                        echo "<tr><td colspan='9' class='text-center'>No Users Found</td></tr>";
                                    }
                                    ?>

                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

</section>


<!-- Trigger Button -->
<button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#registerUserModal">
    + Register User
</button>

<!-- Register User Modal -->
<div class="modal fade bd-example-modal-lg" id="registerUserModal" tabindex="-1" role="dialog" aria-labelledby="registerUserModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="registerUserModalLabel">+ Register User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">

                            <form class="needs-validation" method="POST" novalidate>
                                <div class="card-body">
                                    <div class="row">

                                        <!-- First Name -->
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>First Name</label>
                                                <input type="text" name="user_first_name" class="form-control" placeholder="Enter first name" required>
                                                <div class="invalid-feedback">Please enter first name.</div>
                                            </div>
                                        </div>

                                        <!-- Last Name -->
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Last Name</label>
                                                <input type="text" name="user_last_name" class="form-control" placeholder="Enter last name" required>
                                                <div class="invalid-feedback">Please enter last name.</div>
                                            </div>
                                        </div>

                                        <!-- Email -->
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Email</label>
                                                <input type="email" name="user_email" class="form-control" placeholder="Enter email address" required>
                                                <div class="invalid-feedback">Please enter a valid email.</div>
                                            </div>
                                        </div>

                                        <!-- Contact -->
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Contact</label>
                                                <input type="text" name="user_phone" class="form-control" placeholder="Enter phone number" required>
                                                <div class="invalid-feedback">Please enter contact number.</div>
                                            </div>
                                        </div>

                                        <!-- Gender -->
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Gender</label>
                                                <select name="user_gender" class="form-control" required>
                                                    <option value="">Select Gender</option>
                                                    <option value="male">Male</option>
                                                    <option value="female">Female</option>
                                                </select>
                                                <div class="invalid-feedback">Please select gender.</div>
                                            </div>
                                        </div>

                                        <!-- DOB -->
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Date of Birth</label>
                                                <input type="date" name="user_dob" class="form-control">
                                            </div>
                                        </div>

                                        <!-- Joining Date -->
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Joining Date</label>
                                                <input type="date" name="user_joining_date" class="form-control">
                                            </div>
                                        </div>

                                        <!-- Role -->
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Role</label>
                                                <select name="user_role" class="form-control" required>
                                                    <option value="">Select Role</option>
                                                    <option value="admin">Admin</option>
                                                    <option value="HR">HR</option>
                                                    <option value="Assistant HR">Assistant HR</option>

                                                </select>
                                                <div class="invalid-feedback">Please select role.</div>
                                            </div>
                                        </div>

                                        <!-- Address -->
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Address</label>
                                                <input type="text" name="user_address" class="form-control" placeholder="Enter full address" required>
                                                <div class="invalid-feedback">Please enter address.</div>
                                            </div>
                                        </div>


                                        <!-- Password -->
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Password</label>
                                                <input type="password" name="password" class="form-control" placeholder="Enter password" required>
                                                <div class="invalid-feedback">Please enter password.</div>
                                            </div>
                                        </div>

                                        <!-- Confirm Password -->
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Confirm Password</label>
                                                <input type="password" name="confirm_password" class="form-control" placeholder="Re-enter password" required>
                                                <div class="invalid-feedback">Passwords must match.</div>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <div class="card-footer text-right">
                                    <button type="submit" name="register-user" class="btn btn-primary">Register</button>
                                </div>

                            </form>

                        </div>

                    </div>

                </div>
            </div>

        </div>
    </div>
</div>