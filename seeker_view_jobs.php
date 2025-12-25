<?php
include 'config.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$msg = "";

// ----------------------
// 1. GET JOB DETAILS
// ----------------------
if (!isset($_GET['id'])) {
    die("No job ID provided.");
}

$job_id = intval($_GET['id']);

$result = mysqli_query($conn, "SELECT * FROM jobs WHERE id=$job_id LIMIT 1");
if (!$result) die("Job Query Failed: " . mysqli_error($conn));

$job = mysqli_fetch_assoc($result);
if (!$job) die("Job not found.");


// ----------------------
// 2. APPLY JOB
// ----------------------
if (isset($_POST['apply_job'])) {

    // ******** Sanitize Input ********
    $first_name     = mysqli_real_escape_string($conn, $_POST['first_name']);
    $gender         = mysqli_real_escape_string($conn, $_POST['gender']);
    $email          = mysqli_real_escape_string($conn, $_POST['email']);
    $country        = mysqli_real_escape_string($conn, $_POST['country']);
    $city           = mysqli_real_escape_string($conn, $_POST['city']);
    $date_of_birth  = mysqli_real_escape_string($conn, $_POST['date_of_birth']);
    $phone          = mysqli_real_escape_string($conn, $_POST['phone']);
    $street_address = mysqli_real_escape_string($conn, $_POST['street_address']);
    $job_experience = mysqli_real_escape_string($conn, $_POST['job_experience']);
    $career_level   = mysqli_real_escape_string($conn, $_POST['career_level']);
    $summary        = mysqli_real_escape_string($conn, $_POST['summary']);

    // ******** Upload Image ********
    $profile_image = "";
    if (!empty($_FILES['image']['name'])) {
        $dir = "uploads/profile/";
        if (!is_dir($dir)) mkdir($dir, 0777, true);

        $profile_image = time() . "_" . basename($_FILES['image']['name']);
        move_uploaded_file($_FILES['image']['tmp_name'], $dir . $profile_image);
    }


    // ---------------------------------------
    // 3. CHECK PROFILE BY EMAIL (MAIN LOGIC)
    // ---------------------------------------
    $check_profile = "SELECT * FROM job_seeker_profiles WHERE email='$email' LIMIT 1";
    $profile_result = mysqli_query($conn, $check_profile);

    if (!$profile_result) die("Profile Check Failed: " . mysqli_error($conn));


    // ---------------------------------------
    // CASE A: PROFILE EXISTS → ALWAYS UPDATE
    // ---------------------------------------
    if (mysqli_num_rows($profile_result) > 0) {

        $profile = mysqli_fetch_assoc($profile_result);
        $user_id = $profile['id'];  // always the same →

        // Update profile with NEWEST data
        $update = "UPDATE job_seeker_profiles SET
            first_name='$first_name',
            gender='$gender',
            country='$country',
            city='$city',
            date_of_birth='$date_of_birth',
            phone='$phone',
            street_address='$street_address',
            job_experience='$job_experience',
            career_level='$career_level',
            summary='$summary'"
            . (!empty($profile_image) ? ", profile_image='$profile_image'" : "") .
            " WHERE id=$user_id";

        mysqli_query($conn, $update);
    }

    // ---------------------------------------
    // CASE B: NEW EMAIL → INSERT NEW PROFILE
    // ---------------------------------------
    else {

        $insert_profile = "INSERT INTO job_seeker_profiles (
            first_name, email, gender, country, city, date_of_birth,
            phone, street_address, job_experience, career_level, summary,
            profile_image, created_at
        ) VALUES (
            '$first_name', '$email', '$gender', '$country', '$city', '$date_of_birth',
            '$phone', '$street_address', '$job_experience', '$career_level', '$summary',
            '$profile_image', NOW()
        )";

        mysqli_query($conn, $insert_profile);

        $user_id = mysqli_insert_id($conn);
    }


    // ---------------------------------------
    // 4. CHECK IF ALREADY APPLIED
    // ---------------------------------------
    $check_apply = "SELECT * FROM job_seeker_appliedjobs 
                    WHERE user_id=$user_id AND job_id=$job_id LIMIT 1";

    $apply_result = mysqli_query($conn, $check_apply);

    if (mysqli_num_rows($apply_result) > 0) {
        $msg = "⚠️ You have already applied for this job.";
    } else {
        $apply = "INSERT INTO job_seeker_appliedjobs (user_id, job_id, applied_at)
                  VALUES ($user_id, $job_id, NOW())";
        mysqli_query($conn, $apply);

        $msg = "✅ Application submitted successfully!";
    }

    echo "<script>alert('$msg'); window.location='seeker_view_jobs.php?id=$job_id';</script>";
    exit;
}
?>






<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Job Details</title>
    <?php include_once('include/html-sources.html'); ?>
    <link rel="stylesheet" href="assets/css/app.min.css">
    <link rel="stylesheet" href="assets/css/main.css">
    <style>
        /* Styles same as your previous CSS */
        .date-box {
            background-color: #3498db;
            color: white;
            text-align: center;
            padding: 5px;
            border-radius: 5px;
            width: 60px;
            font-size: 14px;
        }

        .date-box strong {
            font-size: 18px;
            display: block;
        }

        .job-logo {
            width: 70px;
            height: auto;
            border-radius: 5px;
        }

        .left-col {
            background-color: #f8f9fa;
            border-right: 2px solid #e9ecef;
            padding: 15px;
        }

        .section-title {
            border-bottom: 1px solid #ccc;
            padding-bottom: 5px;
            margin-bottom: 10px;
        }

        .custom-table td,
        .custom-table th {
            border-bottom: none !important;
        }

        .custom-table thead th,
        .custom-table .section-heading th {
            border-bottom: 1px solid #dee2e6 !important;
        }

        .tag {
            background-color: #5bc0de;
            color: white;
            padding: 5px 10px;
            border-radius: 4px;
            display: inline-block;
            margin: 3px 3px 3px 0;
        }
    </style>
</head>

<body>
    <div id="app">
        <div class="main-wrapper main-wrapper-1">
            <!-- <?php include_once('include/header.php'); ?> -->

            <div class="maincontent">
                <section class="section p-5">
                    <div class="container-fluid py-4">
                        <div class="card shadow">
                            <div class="card-body">
                                <div class="row">

                                    <!-- Left Column -->

                                    <div class="col-md-4 left-col">
                                        <table class="table custom-table">
                                            <thead>
                                                <tr>
                                                    <th colspan="2" class="text-info">Job Details</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <th>Company:</th>
                                                    <td><?= htmlspecialchars($job['company_name']) ?></td>
                                                </tr>
                                                <tr>
                                                    <th>Country:</th>
                                                    <td><?= htmlspecialchars($job['country_name']) ?></td>
                                                </tr>
                                                <tr>
                                                    <th>City:</th>
                                                    <td><?= htmlspecialchars($job['city_name']) ?></td>
                                                </tr>
                                                <tr>
                                                    <th>Total Positions:</th>
                                                    <td><?= htmlspecialchars($job['num_of_positions']) ?></td>
                                                </tr>
                                                <tr>
                                                    <th>Career Level:</th>
                                                    <td><?= htmlspecialchars($job['career_level']) ?></td>
                                                </tr>
                                                <tr>
                                                    <th>Functional Area:</th>
                                                    <td><?= htmlspecialchars($job['functional_area']) ?></td>
                                                </tr>
                                                <tr>
                                                    <th>Job Type:</th>
                                                    <td><?= htmlspecialchars($job['job_type']) ?></td>
                                                </tr>
                                                <tr>
                                                    <th>Job Shift:</th>
                                                    <td><?= htmlspecialchars($job['job_shift']) ?></td>
                                                </tr>
                                                <tr>
                                                    <th>Experience:</th>
                                                    <td><?= htmlspecialchars($job['job_experience']) ?></td>
                                                </tr>
                                                <tr>
                                                    <th>Gender:</th>
                                                    <td><?= htmlspecialchars($job['gender']) ?></td>
                                                </tr>
                                                <tr>
                                                    <th>Expiry Date:</th>
                                                    <td><?= date("d-m-Y", strtotime($job['expiry_date'])) ?></td>
                                                </tr>
                                                <tr>
                                                    <th>Salary:</th>
                                                    <td>
                                                        <?php if ($job['hide_salary'] == 1): ?>Hidden<?php else: ?>
                                                        <?= htmlspecialchars($job['salary_currency']) ?> <?= htmlspecialchars($job['salary_from']) ?> - <?= htmlspecialchars($job['salary_to']) ?> <?= htmlspecialchars($job['salary_period']) ?>
                                                    <?php endif; ?>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>

                                    <!-- Right Column -->

                                    <div class="col-md-8">
                                        <a href="index.php" class="btn btn-success btn-sm mb-3"><i class="fas fa-arrow-left"></i> Back to Listings</a>

                                        <div class="d-flex align-items-center mb-3">
                                            <img src="./assets/img/logo tef.png" alt="Logo" class="job-logo me-3">
                                            <div class="date-box me-3">
                                                <strong><?= date("d", strtotime($job['created_at'] ?? $job['expiry_date'])) ?></strong>
                                                <?= date("M", strtotime($job['created_at'] ?? $job['expiry_date'])) ?>
                                            </div>
                                            <div>
                                                <h5 class="mb-0"><?= $job['title'] ?></h5>
                                                <small class="text-muted"><?= $job['company_name'] ?>, <?= $job['city_name'] ?></small>
                                            </div>
                                        </div>

                                        <h6 class="section-title text-danger">Job Description</h6>
                                        <p><?= nl2br($job['description']) ?></p>

                                        <h6 class="section-title text-danger">Benefits</h6>
                                        <p><?= nl2br($job['benefits']) ?></p>

                                        <h6 class="section-title text-danger mt-3">Degree Level</h6>
                                        <span class="tag"><?= htmlspecialchars($job['degree_level']) ?></span>

                                        <div class="mt-4">
                                            <button class="btn btn-primary mt-3 w-50" data-toggle="modal" data-target="#experienceModal">
                                                <i class="fas fa-paper-plane"></i> Apply for this job
                                            </button>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                </section>
            </div>

            <?php include_once('include/footer.php'); ?>

            <!-- Modal for profile & apply -->

            <div class="modal fade" id="experienceModal" tabindex="-1" role="dialog" aria-labelledby="formModal2" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Create profile / Apply</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form class="needs-validation" method="POST" enctype="multipart/form-data">
                            <div class="modal-body">

                                <input type="hidden" name="user_id" value="<?= $user_id ?>">

                                <div class="row p-2 g-1">
                                    <div class="col-md-6">
                                        <label>Name <span>*</span></label>
                                        <input class="form-control mb-3 mt-2" name="first_name" type="text" value="<?= htmlspecialchars($data['first_name'] ?? '') ?>" placeholder="Name">

                                        <label>Gender <span>*</span></label> <select class="form-control mb-3 mt-2" name="gender">

                                            <option value="">Select Gender</option>
                                            <option value="Male" <?= ($data['gender'] ?? '') == 'Male' ? 'selected' : '' ?>>Male</option>
                                            <option value="Female" <?= ($data['gender'] ?? '') == 'Female' ? 'selected' : '' ?>>Female</option>
                                        </select>

                                        <label>Email</label> <input class="form-control" id="email" name="email" type="text" value="<?= htmlspecialchars($data['email'] ?? '') ?>" placeholder="Email">

                                    </div>

                                    <div class="col-md-6">
                                        <div class="userimgupbox bg-white text-center">
                                            <label class="fw-semibold">Profile Image</label>
                                            <img src="uploads/profile/<?= $data['profile_image'] ?? 'default.png' ?>" style="max-width:100px; max-height:100px;" alt="Profile">
                                            <label class="btn btn-light bg-transparent w-100 p-2 text-uppercase" style="border: 2px dashed #ccc;">
                                                <i class="fas fa-upload"></i> Select Profile Image
                                                <input type="file" name="image" style="display:none;">
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mt-3">
                                    <div class="col-md-4">
                                        <label>Country</label>
                                        <input class="form-control mt-2 mb-3" name="country" type="text" value="<?= htmlspecialchars($data['country'] ?? '') ?>" placeholder="Country">
                                    </div>
                                    <div class="col-md-4">
                                        <label>City</label>
                                        <input class="form-control mt-2 mb-3" name="city" type="text" value="<?= htmlspecialchars($data['city'] ?? '') ?>" placeholder="City">
                                    </div>
                                    <div class="col-md-4">
                                        <label>Date of Birth</label>
                                        <input class="form-control mt-2 mb-3" name="date_of_birth" type="date" value="<?= htmlspecialchars($data['date_of_birth'] ?? '') ?>">
                                    </div>
                                    <div class="col-md-4">
                                        <label>Phone</label>
                                        <input class="form-control mt-2" name="phone" type="text" value="<?= htmlspecialchars($data['phone'] ?? '') ?>" placeholder="Phone">
                                    </div>
                                    <div class="col-md-4">
                                        <label>Degree Level</label>
                                        <input class="form-control mt-2" name="career_level" type="text" value="<?= htmlspecialchars($data['career_level'] ?? '') ?>" placeholder="Degree Level">
                                    </div>
                                    <div class="col-md-4">
                                        <label>Job Experience</label>
                                        <select class="form-control mt-2" name="job_experience">
                                            <option value="">Select Experience</option>
                                            <?php
                                            $exp_options = ["Fresh", "Less Than 1 Year", "1 Year", "2 years", "3 years", "4 years", "5 years"];
                                            foreach ($exp_options as $exp) {
                                                $sel = ($data['job_experience'] ?? '') == $exp ? 'selected' : '';
                                                echo "<option value='$exp' $sel>$exp</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-md-12 mt-3">
                                        <label>Street Address</label>
                                        <textarea class="form-control mt-2" name="street_address" rows="3" placeholder="Street Address"><?= htmlspecialchars($data['street_address'] ?? '') ?></textarea>
                                    </div>
                                    <div class="col-md-12 mt-3">
                                        <label>Summary</label>
                                        <textarea class="form-control" name="summary" rows="5" placeholder="Profile Summary"><?= htmlspecialchars($data['summary'] ?? '') ?></textarea>
                                    </div>
                                </div>

                            </div>
                            <div class="modal-footer">
                                <button type="submit" name="apply_job" class="btn btn-primary"><i class="fas fa-paper-plane"></i> Apply now</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <script src="assets/js/app.min.js"></script>

            <script src="assets/js/scripts.js"></script>

            <script src="assets/js/custom.js"></script>

</body>

</html>