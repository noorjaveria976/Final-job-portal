<?php

include 'config.php';


// Apply button form submit handle
if (isset($_POST['apply_job'])) {
    $job_id = intval($_GET['id']);

    // 🔹 Step 1: Check profile completion

    // 🔹 Step 2: Check if already applied
    $check = "SELECT * FROM job_seeker_appliedjobs WHERE job_id = $job_id LIMIT 1";
    $check_result = mysqli_query($conn, $check);

    if (mysqli_num_rows($check_result) > 0) {
        $msg = "<p class='text-warning'>⚠️ You have already applied for this job.</p>";
    } else {
        // 🔹 Step 3: Insert new application
        $apply = "INSERT INTO job_seeker_appliedjobs (user_id, job_id, applied_at) 
                VALUES ($user_id, $job_id, NOW())";
        if (mysqli_query($conn, $apply)) {
            $msg = "<p class='text-success'>✅ Application submitted successfully!</p>";
        } else {
            $msg = "<p class='text-danger'>❌ Error: " . mysqli_error($conn) . "</p>";
        }
    }
}

// restriction ended 

// Get job id from URL
if (isset($_GET['id'])) {
    $job_id = intval($_GET['id']);

    $sql = "SELECT * FROM jobs WHERE id = $job_id LIMIT 1";
    $result = mysqli_query($conn, $sql);
    $job = mysqli_fetch_assoc($result);

    if (!$job) {
        echo "<p class='text-danger'>Job not found.</p>";
        exit;
    }
} else {
    echo "<p class='text-danger'>No Job ID provided.</p>";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_POST['user_id'];

    // Sanitize text inputs

    $first_name     = mysqli_real_escape_string($conn, $_POST['first_name']);
    $gender         = mysqli_real_escape_string($conn, $_POST['gender']);
    $marital_status = mysqli_real_escape_string($conn, $_POST['marital_status']);
    $country        = mysqli_real_escape_string($conn, $_POST['country']);
    $city           = mysqli_real_escape_string($conn, $_POST['city']);
    $date_of_birth  = mysqli_real_escape_string($conn, $_POST['date_of_birth']);
    $phone          = mysqli_real_escape_string($conn, $_POST['phone']);
    $street_address = mysqli_real_escape_string($conn, $_POST['street_address']);
    $job_experience = mysqli_real_escape_string($conn, $_POST['job_experience']);
    $career_level   = mysqli_real_escape_string($conn, $_POST['career_level']);
    $summary        = mysqli_real_escape_string($conn, $_POST['summary']);


    // Handle Profile Image Upload
    $profile_image = "";
    if (!empty($_FILES['image']['name'])) {
        $profileDir = "uploads/profile/";

        // Agar folder nahi hai to create karo
        if (!is_dir($profileDir)) {
            mkdir($profileDir, 0777, true);
        }

        $profile_image = time() . "_" . basename($_FILES['image']['name']);
        $targetProfile = $profileDir . $profile_image;

        if (move_uploaded_file($_FILES['image']['tmp_name'], $targetProfile)) {
            // Success - ab $profile_image ko DB me save karo
        } else {
            echo "Error uploading profile image!";
        }
    } {
        // INSERT new record
        $insert = "INSERT INTO job_seeker_profiles (
            email, first_name, gender, marital_status,
            country, city, date_of_birth, phone, street_address,
            job_experience, career_level, summary, profile_image, created_at
        ) VALUES (
            '$email', '$first_name', '$gender', '$marital_status',
            '$country', '$city', '$date_of_birth', '$phone', '$street_address',
            '$job_experience', '$career_level', '$summary', '$profile_image', NOW()
        )";

        $query = mysqli_query($conn, $insert);
        $msg = $query ? "Applied Successfully!" : "Error saving profile!";
    }

    echo "<script>alert('$msg'); window.location='';</script>";
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>TEF - Admin Dashboard Template</title>
    <?php include_once('include/html-sources.html'); ?>
    <!-- Fav Icon -->
    <link rel='shortcut icon' type='image/x-icon' href='assets/img/favicon.ico' />
    <link rel="stylesheet" href="assets/css/app.min.css">
    <!-- Custom Style -->
    <link href="assets/css/main.css" rel="stylesheet">
    <style>
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

        /* Remove borders from all rows except section headings */
        .custom-table td,
        .custom-table th {
            border-bottom: none !important;
        }

        /* Keep bottom border for heading rows */
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
    <div class="loader"></div>
    <div id="app">
        <div class="main-wrapper main-wrapper-1">
            <div class="header" id="siteheader">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-2 col-md-12 col-12"> <a href="#" class="d-flex align-item-center"><img src="./assets/img/logo-dark.png" alt="JOBS PORTAL" class=" w-75"></a>
                            <div class="navbar-header navbar-light">
                                <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#nav-main" aria-controls="nav-main" aria-expanded="false" aria-label="Toggle navigation"> <i class="fas fa-bars"></i></button>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="col-lg-10 col-md-12 col-12">

                            <!-- Nav start -->
                            <nav class="navbar navbar-expand-lg navbar-light">

                                <div class="navbar-collapse collapse" id="nav-main">
                                    <button class="close-toggler" type="button" data-toggle="offcanvas"> <span><i class="fas fa-times-circle" aria-hidden="true"></i></span> </button>

                                    <ul class="navbar-nav">
                                        <li class="nav-item active"><a href="#" class="nav-link">Home</a> </li>
                                        <li class="nav-item ">
                                            <a href="" class="nav-link">Search Talent</a>
                                        </li>
                                        <li class="nav-item ">
                                            <a href="" class="nav-link">Companies</a>
                                        </li>
                                        <li class="nav-item "><a href="" class="nav-link">Blog</a> </li>
                                        <li class="nav-item "><a href="" class="nav-link">Contact Us</a> </li>
                                        <li class="nav-item "><a href="login.php" class="nav-link">Login </a> </li>
                                        <!-- <li class="nav-item "><button class="btn btn-light" data-toggle="modal" data-target="#roleModal">Login</button> </li> -->
                                        <li class="nav-item register"><a href="auth-register.html" class="nav-link register">Register</a> </li>
                                        <li class="nav-item dropdown userbtn"><a href=""><img src="https://www.sharjeelanjum.com/demos/jobsportal-update/company_logos/multimedia-design-1614272292-782.jpg" alt="Multimedia Design" title="Multimedia Design"></a>
                                            <ul class="dropdown-menu">
                                                <li class="nav-item"><a href="" class="nav-link"><i class="fa fa-tachometer" aria-hidden="true"></i> Dashboard</a> </li>
                                                <li class="nav-item"><a href="" class="nav-link"><i class="fa fa-user" aria-hidden="true"></i> Company Profile</a></li>
                                                <li class="nav-item"><a href="" class="nav-link"><i class="fa fa-desktop" aria-hidden="true"></i> Post Job</a></li>
                                                <li class="nav-item"><a href="" class="nav-link"><i class="fa fa-envelope" aria-hidden="true"></i> Company Messages</a></li>
                                                <li class="nav-item"><a href="logout.php" onclick="event.preventDefault(); document.getElementById('logout-form-header1').submit();" class="nav-link"><i class="fa fa-sign-out" aria-hidden="true"></i> Logout</a> </li>
                                                <form id="logout-form-header1" action="logout" method="POST" style="display: none;">
                                                    <input type="hidden" name="_token" value="dWQSThWOrTMy01T95xVXyfir5JdgLkzNqN6fLUtu" autocomplete="off">
                                                </form>
                                            </ul>
                                        </li>

                                        <!-- Modal for role selection -->
                                        <div class="modal fade" id="roleModal" tabindex="-1" role="dialog">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Select Your Role</h5>
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    </div>
                                                    <div class="modal-body text-center mt-3">
                                                        <a href="login.php?role=jobprovider" class="btn btn-primary btn-lg m-2">Login as Job Provider</a>
                                                        <a href="login.php?role=jobseeker" class="btn btn-success btn-lg m-2">Login as Job Seeker</a>
                                                        <a href="login.php?role=admin" class="btn btn-dark btn-lg m-2">Login as Admin</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </ul>

                                    <!-- Nav collapes end -->

                                </div>
                                <div class="clearfix"></div>
                            </nav>

                            <!-- Nav end -->

                        </div>
                    </div>

                    <!-- row end -->

                </div>

                <!-- Header container end -->

            </div>
            <!-- Main Content -->
            <div class="maincontent">
                <section class="section p-5">
                    <div class="section">
                        <!-- add content here -->
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
                                                    <!-- <tr>
                                                        <th>State:</th>
                                                        <td><?= htmlspecialchars($job['state_name']) ?></td>
                                                    </tr> -->
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
                                                            <?php if ($job['hide_salary'] == 1): ?>
                                                                Hidden
                                                            <?php else: ?>
                                                                <?= htmlspecialchars($job['salary_currency']) ?>
                                                                <?= htmlspecialchars($job['salary_from']) ?> -
                                                                <?= htmlspecialchars($job['salary_to']) ?>
                                                                <?= htmlspecialchars($job['salary_period']) ?>
                                                            <?php endif; ?>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>

                                        <!-- Right Column -->
                                        <div class="col-md-8">
                                            <a href="index.php" class="btn btn-success btn-sm mb-3">
                                                <i class="fas fa-arrow-left"></i> Back to Listings
                                            </a>

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
                                                <!-- <?php if (!empty($msg)) echo $msg; ?>

                                                <?php if ($job['external_job'] == 1 && !empty($job['job_link'])): ?>
                                                    <a href="<?= $job['job_link'] ?>" target="_blank" class="btn btn-success me-2">
                                                        <i class="fas fa-external-link-alt"></i> Apply for this Job
                                                    </a>
                                                <?php else: ?>
                                                    <form method="POST">
                                                        <button type="submit" name="apply_job" class="btn btn-primary">
                                                            <i class="fas fa-paper-plane"></i> Apply for this job
                                                        </button>
                                                    </form>
                                                <?php endif; ?> -->

                                                <button class="btn btn-primary mt-3 w-50" data-toggle="modal" data-target="#experienceModal">
                                                    <i class="fas fa-eye"></i> Apply for this job
                                                </button>
                                            </div>


                                        </div>
                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>
                </section>
                <div class="settingSidebar">
                    <a href="javascript:void(0)" class="settingPanelToggle"> <i class="fa fa-spin fa-cog"></i>
                    </a>
                    <div class="settingSidebar-body ps-container ps-theme-default">
                        <div class=" fade show active">
                            <div class="setting-panel-header">Setting Panel
                            </div>
                            <div class="p-15 border-bottom">
                                <h6 class="font-medium m-b-10">Select Layout</h6>
                                <div class="selectgroup layout-color w-50">
                                    <label class="selectgroup-item">
                                        <input type="radio" name="value" value="1" class="selectgroup-input-radio select-layout" checked>
                                        <span class="selectgroup-button">Light</span>
                                    </label>
                                    <label class="selectgroup-item">
                                        <input type="radio" name="value" value="2" class="selectgroup-input-radio select-layout">
                                        <span class="selectgroup-button">Dark</span>
                                    </label>
                                </div>
                            </div>
                            <div class="p-15 border-bottom">
                                <h6 class="font-medium m-b-10">Sidebar Color</h6>
                                <div class="selectgroup selectgroup-pills sidebar-color">
                                    <label class="selectgroup-item">
                                        <input type="radio" name="icon-input" value="1" class="selectgroup-input select-sidebar">
                                        <span class="selectgroup-button selectgroup-button-icon" data-toggle="tooltip"
                                            data-original-title="Light Sidebar"><i class="fas fa-sun"></i></span>
                                    </label>
                                    <label class="selectgroup-item">
                                        <input type="radio" name="icon-input" value="2" class="selectgroup-input select-sidebar" checked>
                                        <span class="selectgroup-button selectgroup-button-icon" data-toggle="tooltip"
                                            data-original-title="Dark Sidebar"><i class="fas fa-moon"></i></span>
                                    </label>
                                </div>
                            </div>
                            <div class="p-15 border-bottom">
                                <h6 class="font-medium m-b-10">Color Theme</h6>
                                <div class="theme-setting-options">
                                    <ul class="choose-theme list-unstyled mb-0">
                                        <li title="white" class="active">
                                            <div class="white"></div>
                                        </li>
                                        <li title="cyan">
                                            <div class="cyan"></div>
                                        </li>
                                        <li title="black">
                                            <div class="black"></div>
                                        </li>
                                        <li title="purple">
                                            <div class="purple"></div>
                                        </li>
                                        <li title="orange">
                                            <div class="orange"></div>
                                        </li>
                                        <li title="green">
                                            <div class="green"></div>
                                        </li>
                                        <li title="red">
                                            <div class="red"></div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="p-15 border-bottom">
                                <div class="theme-setting-options">
                                    <label class="m-b-0">
                                        <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input"
                                            id="mini_sidebar_setting">
                                        <span class="custom-switch-indicator"></span>
                                        <span class="control-label p-l-10">Mini Sidebar</span>
                                    </label>
                                </div>
                            </div>
                            <div class="p-15 border-bottom">
                                <div class="theme-setting-options">
                                    <label class="m-b-0">
                                        <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input"
                                            id="sticky_header_setting">
                                        <span class="custom-switch-indicator"></span>
                                        <span class="control-label p-l-10">Sticky Header</span>
                                    </label>
                                </div>
                            </div>
                            <div class="mt-4 mb-4 p-3 align-center rt-sidebar-last-ele">
                                <a href="#" class="btn btn-icon icon-left btn-primary btn-restore-theme">
                                    <i class="fas fa-undo"></i> Restore Default
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Footer -->
            <?php include_once('include/footer.php'); ?>
            <!-- footer end -->
        </div>
    </div>

    <!-- modal for add experience -->
    <div class="modal fade" id="experienceModal" tabindex="-1" role="dialog" aria-labelledby="formModal2"
        aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Create profile</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form class="form needs-validation" id="experienceForm" method="POST" action="">
                    <!-- <input type="hidden" name="_token" value="6yWsZRaRmexsWsKMZhvrp1XB4w6hgjC2GUPscb02" autocomplete="off"> -->

                    <div class="modal-body">
                        <div class="form-body">

                            <input type="hidden" name="user_id" value="<?= $user_id ?>">




                            <div class="row p-2 g-1">
                                <div class="col-md-6">
                                    <label>Name <span>*</span></label>
                                    <input class="form-control mb-3 mt-2" name="first_name" type="text"
                                        value="<?= htmlspecialchars($data['first_name'] ?? '') ?>" placeholder="Name">

                                    <!-- gender -->
                                    <label>Gender <span>*</span></label>
                                    <select class="form-control mb-3 mt-2" name="gender">
                                        <option value="">Select Gender</option>
                                        <option value="Male" <?= ($data['gender'] ?? '') == 'Male' ? 'selected' : '' ?>>Male</option>
                                        <option value="Female" <?= ($data['gender'] ?? '') == 'Female' ? 'selected' : '' ?>>Female</option>
                                    </select>

                                    <label>Email</label>
                                <input class="form-control" id="email" name="email" type="text"
                                    value="<?= htmlspecialchars($data['email'] ?? '') ?>" placeholder="Email">
                                    <!-- Marital status -->
                                    <!-- <label>Marital Status <span>*</span></label>
                                    <select class="form-control mt-2" name="marital_status">
                                        <option value="">Select</option>
                                        <option value="Single" <?= ($data['marital_status'] ?? '') == 'Single' ? 'selected' : '' ?>>Single</option>
                                        <option value="Married" <?= ($data['marital_status'] ?? '') == 'Married' ? 'selected' : '' ?>>Married</option>
                                        <option value="Divorced" <?= ($data['marital_status'] ?? '') == 'Divorced' ? 'selected' : '' ?>>Divorced</option>
                                        <option value="Widow/er" <?= ($data['marital_status'] ?? '') == 'Widow/er' ? 'selected' : '' ?>>Widow/er</option>
                                    </select> -->
                                </div>

                                <div class="col-md-6">
                                    <div class="userimgupbox bg-white ">
                                        <div class="imagearea text-center">
                                            <label class="fw-semibold">Profile Image <span>*</span></label>
                                            <img src="uploads/profile/<?= $data['profile_image'] ?? 'default.png' ?>"
                                                style="max-width:100px; max-height:100px;" alt="Profile">
                                        </div>
                                        <div class="formrow">
                                            <label class="btn btn-light bg-transparent w-100 p-2 text-uppercase"
                                                style="border: 2px dashed #ccc;">
                                                <i class="fas fa-upload"></i> Select Profile Image
                                                <input type="file" name="image" id="image" style="display:none;">
                                            </label>
                                        </div>
                                    </div>
                                </div>


                            </div>

                            <div class="row ">



                                <div class="col-md-4">
                                    <label>Country</label>
                                    <input class="form-control mt-2 mb-3" name="country" type="text"
                                        value="<?= htmlspecialchars($data['country'] ?? '') ?>" placeholder="Country">
                                </div>

                                <div class="col-md-4">
                                    <label>City</label>
                                    <input class="form-control mt-2 mb-3" name="city" type="text"
                                        value="<?= htmlspecialchars($data['city'] ?? '') ?>" placeholder="City">
                                </div>

                                <div class="col-md-4">
                                    <label>Date of Birth</label>
                                    <input class="form-control mt-2 mb-3" name="date_of_birth" type="date"
                                        value="<?= htmlspecialchars($data['date_of_birth'] ?? '') ?>">
                                </div>
                                <div class="col-md-4">
                                    <label>Phone</label>
                                    <input class="form-control mt-2" name="phone" type="text"
                                        value="<?= htmlspecialchars($data['phone'] ?? '') ?>" placeholder="Phone">
                                </div>
                                <div class="col-md-4">
                                    <label>Degree Level</label>
                                    <input class="form-control mt-2" name="career_level" type="text"
                                        value="<?= htmlspecialchars($data['career_level'] ?? '') ?>" placeholder="Degree Level">
                                </div>
                                <div class="col-md-4">
                                    <div>
                                        <label for="">Job Experience <span>*</span></label>
                                        <select class="form-control mt-2" name="job_experience">
                                            <option value="">Select Experience</option>
                                            <option value="Fresh"> <?= ($data['job_experience'] ?? '') == 'Fresh' ? 'selected' : '' ?> Fresh</option>
                                            <option value="Less Than 1 Year"> <?= ($data['job_experience'] ?? '') == 'Less Than 1 Year' ? 'selected' : '' ?> Less Than 1 Year</option>
                                            <option value="1 Year"> <?= ($data['job_experience'] ?? '') == '1 Year' ? 'selected' : '' ?> 1 Year</option>
                                            <option value="2 years"> <?= ($data['job_experience'] ?? '') == '2 years' ? 'selected' : '' ?> 2 years</option>
                                            <option value="3 years"> <?= ($data['job_experience'] ?? '') == ' 3 year' ? 'selected' : '' ?> 3 years</option>
                                            <option value="4 years"> <?= ($data['job_experience'] ?? '') == '4 years' ? 'selected' : '' ?> 4 years</option>
                                            <option value="5 years"> <?= ($data['job_experience'] ?? '') == '5 years' ? 'selected' : '' ?> 5 years</option>

                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12 mt-3">
                                    <label>Street Address</label>
                                    <textarea class="form-control mt-2" name="street_address" rows="3"
                                        placeholder="Street Address"><?= htmlspecialchars($data['street_address'] ?? '') ?></textarea>
                                </div>
                            </div>



                            <div class="row mt-3">
                                <h5>Summary</h5>
                                <div class="col-md-12">
                                    <textarea class="form-control" name="summary" rows="5"
                                        placeholder="Profile Summary"><?= htmlspecialchars($data['summary'] ?? '') ?></textarea>
                                </div>
                            </div>

                        </div>
                    </div>





                    <div class="modal-footer">
                        <!-- <button type="submit" class="btn btn-large btn-primary">
                            Apply now <i class="fa fa-arrow-circle-right" aria-hidden="true"></i>
                        </button> -->
                        <form method="POST">
                            <button type="submit" name="apply_job" class="btn btn-primary">
                                <i class="fas fa-paper-plane"></i> Apply now
                            </button>
                        </form>

                    </div>
                </form>
            </div>
        </div>
    </div>


    <script>
        $("#profile_form").on("submit", function(e) {
            e.preventDefault();
            var formData = new FormData(this);

            $.ajax({
                url: "layout.php?page=seeker_my_profile",
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                success: function(res) {
                    let response = JSON.parse(res);
                    alert(response.message);
                    location.reload();
                }
            });
        });
    </script>

    <!-- General JS Scripts -->
    <script src="assets/js/app.min.js"></script>
    <!-- JS Libraies -->
    <!-- Page Specific JS File -->
    <!-- Template JS File -->
    <script src="assets/js/scripts.js"></script>
    <!-- Custom JS File -->
    <script src="assets/js/custom.js"></script>




</body>
</html>