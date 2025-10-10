<?php $pageTitle = "Add School"; ?>
<?php include('config.php');

// --- Register User (agar form submit ho) ---
if (isset($_POST['register-user'])) {
    $user_first_name   = trim($_POST['user_first_name']);
    $user_last_name    = trim($_POST['user_last_name']);
    $user_email        = trim($_POST['user_email']);
    $user_phone        = trim($_POST['user_phone']);
    $user_gender       = trim($_POST['user_gender']);
    $user_dob          = trim($_POST['user_dob']);
    $user_address      = trim($_POST['user_address']);
    $user_joining_date = trim($_POST['user_joining_date']);
    $user_role         = trim($_POST['user_role']);
    $password          = trim($_POST['password']);
    $confirm_password  = trim($_POST['confirm_password']);

    if ($password !== $confirm_password) {
        echo "<script>alert('Passwords do not match');</script>";
    } else {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $cn->prepare("SELECT user_id FROM users WHERE user_email = ?");
        $stmt->bind_param("s", $user_email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            echo "<script>alert('Email already registered');</script>";
        } else {
            $stmt_insert = $cn->prepare("INSERT INTO users 
                (user_first_name, user_last_name, user_email, user_phone, user_gender, user_dob, user_joining_date, user_role, password, created_at) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())");
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

<!-- ================= Page Content Start ================= -->
<section class="section">
    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header justify-content-between">
                        <h4>Schools Details</h4>
                        <button type="button" class="btn btn-primary" data-toggle="modal"
                            data-target=".bd-example-modal-lg">Add School</button>
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
                                    <!-- Static Example Rows -->
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
                                        <td><img alt="image" src="assets/img/users/user-3.png" width="35"></td>
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
<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add School Information</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <div class="modal-body">
                <form class="needs-validation" method="POST" novalidate>
                    <div class="row">
                        <!-- District Dropdown -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>District</label>
                                <select name="district_id" class="form-control" required>
                                    <option value="">-- Select District --</option>
                                    <!-- PHP: Fetch districts from DB here -->
                                </select>
                                <div class="invalid-feedback">Please select district.</div>
                            </div>
                        </div>

                        <!-- School Code -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>School Code</label>
                                <input type="text" name="school_code" class="form-control" required>
                                <div class="invalid-feedback">Please enter school code.</div>
                            </div>
                        </div>

                        <!-- School Name -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>School Name</label>
                                <input type="text" name="school_name" class="form-control" required>
                                <div class="invalid-feedback">Please enter school name.</div>
                            </div>
                        </div>

                        <!-- Latitude -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Latitude</label>
                                <input type="number" step="0.000001" name="latitude" class="form-control">
                            </div>
                        </div>

                        <!-- Longitude -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Longitude</label>
                                <input type="number" step="0.000001" name="longitude" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <button class="btn btn-primary" type="submit" name="submit">Save School</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- ================= Page Content End ================= -->