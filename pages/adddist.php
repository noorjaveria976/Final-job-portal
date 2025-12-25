<?php $pageTitle = "District List"; ?>

<?php
include('config.php');

//  <div class="table-responsive">
// <table class="table table-striped table-hover" id="tableExport" style="width:100%;">


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
        $stmt = $cn->prepare("SELECT user_id FROM users WHERE user_email = ?");
        $stmt->bind_param("s", $user_email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            echo "<script>alert('Email already registered');</script>";
        } else {
            // Insert new user
            $stmt_insert = $cn->prepare("INSERT INTO users (user_first_name, user_last_name, user_email, user_phone, user_gender, user_dob, user_joining_date, user_role, password, created_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())");
            $stmt_insert->bind_param("sssssssss", $user_first_name, $user_last_name, $user_email, $user_phone, $user_gender, $user_dob, $user_joining_date, $user_role, $hashed_password);

            if ($stmt_insert->execute()) {
                echo "<script>alert('Registration successful'); window.location='index.php';</script>";
            } else {
                echo "Error: " . $stmt_insert->error;
            }
            $stmt_insert->close();
        }
        $stmt->close();
    }
}
?>

<section class="section">
    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header justify-content-between">
                        <h4>District Detials</h4>
                        <button type="button" class="btn btn-primary" data-toggle="modal"
                            data-target=".bd-example-modal-lg">Add District</button>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover" id="tableExport" style="width:100%;">
                                <thead>
                                    <tr>
                                        <th>Sr.#</th>
                                        <th>District Name</th>
                                        <th>Number of Schools</th>
                                        <th>Incharge IT</th>
                                        <th>Employees</th>
                                        <th>Program Start Date</th>
                                        <th>Budget</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>01</td>
                                        <td>Lahore</td>
                                        <td class="align-middle">
                                            <div class="progress progress-xs">
                                                <div class="progress-bar bg-success width-per-80"></div>
                                            </div>
                                            <small>80 Schools</small>
                                        </td>
                                        <td>Mr. Ahmad</td>
                                        <td>
                                            <img alt="image" src="assets/img/users/user-1.png" width="35">
                                            <img alt="image" src="assets/img/users/user-2.png" width="35">
                                        </td>
                                        <td>2021-01-15</td>
                                        <td>$120,000</td>
                                        <td>
                                            <div class="badge badge-success badge-shadow">Running</div>
                                        </td>
                                        <td><a href="district_detail.php?id=1" class="btn btn-primary">Detail</a></td>
                                    </tr>

                                    <tr>
                                        <td>02</td>
                                        <td>Multan</td>
                                        <td class="align-middle">
                                            <div class="progress progress-xs">
                                                <div class="progress-bar bg-warning width-per-60"></div>
                                            </div>
                                            <small>45 Schools</small>
                                        </td>
                                        <td>Engr. Bilal</td>
                                        <td>
                                            <img alt="image" src="assets/img/users/user-3.png" width="35">
                                        </td>
                                        <td>2020-07-10</td>
                                        <td>$95,000</td>
                                        <td>
                                            <div class="badge badge-warning badge-shadow">In Progress</div>
                                        </td>
                                        <td><a href="district_detail.php?id=2" class="btn btn-primary">Detail</a></td>
                                    </tr>

                                    <tr>
                                        <td>03</td>
                                        <td>Faisalabad</td>
                                        <td class="align-middle">
                                            <div class="progress progress-xs">
                                                <div class="progress-bar bg-danger width-per-30"></div>
                                            </div>
                                            <small>20 Schools</small>
                                        </td>
                                        <td>Mr. Imran</td>
                                        <td>
                                            <img alt="image" src="assets/img/users/user-4.png" width="35">
                                            <img alt="image" src="assets/img/users/user-5.png" width="35">
                                        </td>
                                        <td>2019-05-20</td>
                                        <td>$70,000</td>
                                        <td>
                                            <div class="badge badge-danger badge-shadow">Delayed</div>
                                        </td>
                                        <td><a href="district_detail.php?id=3" class="btn btn-primary">Detail</a></td>
                                    </tr>
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>



<!-- Large modal -->
<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="formModal">Add District Information</h5>
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

                                        <!-- District Name -->
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>District Name</label>
                                                <input type="text" name="district_name" class="form-control" required>
                                                <div class="invalid-feedback">
                                                    Please enter district name.
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Number of Schools -->
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Number of Schools</label>
                                                <input type="number" name="num_schools" class="form-control" required>
                                                <div class="invalid-feedback">
                                                    Please enter number of schools.
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Incharge IT -->
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Incharge IT</label>
                                                <input type="text" name="incharge_it" class="form-control" required>
                                                <div class="invalid-feedback">
                                                    Please enter incharge IT name.
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Employees -->
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Employees</label>
                                                <input type="number" name="employees" class="form-control" required>
                                                <div class="invalid-feedback">
                                                    Please enter number of employees.
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Program Start Date -->
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Program Start Date</label>
                                                <input type="date" name="program_start" class="form-control" required>
                                                <div class="invalid-feedback">
                                                    Please select start date.
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Budget -->
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Budget</label>
                                                <input type="number" step="0.01" name="budget" class="form-control" required>
                                                <div class="invalid-feedback">
                                                    Please enter budget.
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Status -->
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Status</label>
                                                <select name="status" class="form-control" required>
                                                    <option value="">-- Select Status --</option>
                                                    <option value="Running">Running</option>
                                                    <option value="In Progress">In Progress</option>
                                                    <option value="Delayed">Delayed</option>
                                                </select>
                                                <div class="invalid-feedback">
                                                    Please select status.
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <div class="card-footer text-right">
                                    <button class="btn btn-primary" type="submit" name="submit">Save District</button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
