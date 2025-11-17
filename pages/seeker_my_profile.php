<?php $pageTitle = "Build Profile "; ?>

<?php

include 'config.php';
$user_id = $_SESSION['user_id'] ?? 0;
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_POST['user_id'];

    // Sanitize text inputs
    $email          = mysqli_real_escape_string($conn, $_POST['email']);
    $password       = mysqli_real_escape_string($conn, $_POST['password']);
    $first_name     = mysqli_real_escape_string($conn, $_POST['first_name']);
    $last_name      = mysqli_real_escape_string($conn, $_POST['last_name']);
    $middle_name    = mysqli_real_escape_string($conn, $_POST['middle_name']);
    $gender         = mysqli_real_escape_string($conn, $_POST['gender']);
    $marital_status = mysqli_real_escape_string($conn, $_POST['marital_status']);
    $country        = mysqli_real_escape_string($conn, $_POST['country']);
    $state          = mysqli_real_escape_string($conn, $_POST['state']);
    $city           = mysqli_real_escape_string($conn, $_POST['city']);
    $nationality    = mysqli_real_escape_string($conn, $_POST['nationality']);
    $date_of_birth  = mysqli_real_escape_string($conn, $_POST['date_of_birth']);
    $phone          = mysqli_real_escape_string($conn, $_POST['phone']);
    $mobile_num     = mysqli_real_escape_string($conn, $_POST['mobile_num']);
    $street_address = mysqli_real_escape_string($conn, $_POST['street_address']);
    $job_experience = mysqli_real_escape_string($conn, $_POST['job_experience']);
    $career_level   = mysqli_real_escape_string($conn, $_POST['career_level']);
    $industry       = mysqli_real_escape_string($conn, $_POST['industry']);
    $functional_area = mysqli_real_escape_string($conn, $_POST['functional_area']);
    $salary_currency = mysqli_real_escape_string($conn, $_POST['salary_currency']);
    $current_salary = mysqli_real_escape_string($conn, $_POST['current_salary']);
    $expected_salary = mysqli_real_escape_string($conn, $_POST['expected_salary']);
    $summary        = mysqli_real_escape_string($conn, $_POST['summary']);
    $is_subscribed  = isset($_POST['is_subscribed']) ? 1 : 0;

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
}

// Handle Cover Image Upload
$cover_image = "";
if (!empty($_FILES['cover_image']['name'])) {
    $coverDir = "uploads/cover/";

    // Agar folder nahi hai to create karo
    if (!is_dir($coverDir)) {
        mkdir($coverDir, 0777, true);
    }

    $cover_image = time() . "_" . basename($_FILES['cover_image']['name']);
    $targetCover = $coverDir . $cover_image;

    if (move_uploaded_file($_FILES['cover_image']['tmp_name'], $targetCover)) {
        // Success - ab $cover_image ko DB me save karo
    } else {
        echo "Error uploading cover image!";
    }
}

    // Check if user profile exists
    $check = mysqli_query($conn, "SELECT id FROM job_seeker_profiles WHERE user_id='$user_id' LIMIT 1");

    if (mysqli_num_rows($check) > 0) {
        // UPDATE existing record
        $update = "UPDATE job_seeker_profiles SET
            email='$email',
            password='$password',
            first_name='$first_name',
            last_name='$last_name',
            middle_name='$middle_name',
            gender='$gender',
            marital_status='$marital_status',
            country='$country',
            state='$state',
            city='$city',
            nationality='$nationality',
            date_of_birth='$date_of_birth',
            phone='$phone',
            mobile_num='$mobile_num',
            street_address='$street_address',
            job_experience='$job_experience',
            career_level='$career_level',
            industry='$industry',
            functional_area='$functional_area',
            salary_currency='$salary_currency',
            current_salary='$current_salary',
            expected_salary='$expected_salary',
            summary='$summary',
            is_subscribed='$is_subscribed'";

        // Update images only if new uploaded
        if (!empty($profile_image)) {
            $update .= ", profile_image='$profile_image'";
        }
        if (!empty($cover_image)) {
            $update .= ", cover_images='$cover_image'";
        }

        $update .= " WHERE user_id='$user_id'";

        $query = mysqli_query($conn, $update);
        $msg = $query ? "Profile Updated Successfully!" : "Error updating profile!";
    } else {
        // INSERT new record
        $insert = "INSERT INTO job_seeker_profiles (
            user_id, email, password, first_name, last_name, middle_name, gender, marital_status,
            country, state, city, nationality, date_of_birth, phone, mobile_num, street_address,
            job_experience, career_level, industry, functional_area, salary_currency,
            current_salary, expected_salary, summary, is_subscribed, profile_image, cover_images, created_at
        ) VALUES (
            '$user_id', '$email', '$password', '$first_name', '$last_name', '$middle_name', '$gender', '$marital_status',
            '$country', '$state', '$city', '$nationality', '$date_of_birth', '$phone', '$mobile_num', '$street_address',
            '$job_experience', '$career_level', '$industry', '$functional_area', '$salary_currency',
            '$current_salary', '$expected_salary', '$summary', '$is_subscribed', '$profile_image', '$cover_image', NOW()
        )";

        $query = mysqli_query($conn, $insert);
        $msg = $query ? "Profile Created Successfully!" : "Error saving profile!";
    }

    echo "<script>alert('$msg'); window.location='';</script>";
}
?>


<section class="section">
    <div class="section-body">
        <!-- add content here -->
        <div class="userccount one">
            <div class="formpanel mt0">
                <script>
                    var elements = document.querySelectorAll('.popmessage, .bgoverlay');

                    if (elements.length > 0) {
                        setTimeout(function() {
                            elements.forEach(function(element) {
                                element.style.display = 'none';
                            });
                        }, 5000);
                    }
                </script>
                <!-- Personal Information -->
                <?php

                // Fetch existing profile data
                $profile = mysqli_query($conn, "SELECT * FROM job_seeker_profiles WHERE user_id='$user_id' LIMIT 1");
                $data = mysqli_fetch_assoc($profile);
                ?>

                <form method="POST" action="" accept-charset="UTF-8" class="form" enctype="multipart/form-data">

                    <input type="hidden" name="user_id" value="<?= $user_id ?>">

                    <h5>Account Information</h5>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="formrow">
                                <label>Email</label>
                                <input class="form-control" id="email" name="email" type="text"
                                    value="<?= htmlspecialchars($data['email'] ?? '') ?>" placeholder="Email">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="formrow">
                                <label>Password</label>
                                <input class="form-control" id="password" name="password" type="password"
                                    value="<?= htmlspecialchars($data['password'] ?? '') ?>" placeholder="Password">
                            </div>
                        </div>
                    </div>

                    <hr>

                    <h5>Personal Information</h5>
                    <div class="row p-2 g-1">
                        <div class="col-md-6 pe-3">
                            <div class="userimgupbox bg-white p-5">
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

                        <div class="col-md-6 ps-4">
                            <div class="userimgupbox bg-white p-5">
                                <div class="imagearea text-center">
                                    <label class="fw-semibold">Cover Photo</label>
                                    <img src="uploads/cover/<?= $data['cover_images'] ?? 'default_cover.png' ?>"
                                        style="max-width:200px; max-height:90px;" alt="Cover">
                                </div>
                                <div class="formrow">
                                    <label class="btn btn-light bg-transparent w-100 p-2 text-uppercase"
                                        style="border: 2px dashed #ccc;">
                                        <i class="fas fa-upload"></i> Select Cover Photo
                                        <input type="file" name="cover_image" id="cover_image" style="display:none;">
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-6">
                            <label>First Name <span>*</span></label>
                            <input class="form-control" name="first_name" type="text"
                                value="<?= htmlspecialchars($data['first_name'] ?? '') ?>" placeholder="First Name">
                        </div>
                        <div class="col-md-6">
                            <label>Last Name <span>*</span></label>
                            <input class="form-control" name="last_name" type="text"
                                value="<?= htmlspecialchars($data['last_name'] ?? '') ?>" placeholder="Last Name">
                        </div>
                        <div class="col-md-4">
                            <label>Nick Name</label>
                            <input class="form-control" name="middle_name" type="text"
                                value="<?= htmlspecialchars($data['middle_name'] ?? '') ?>" placeholder="Nick Name">
                        </div>
                        <div class="col-md-4">
                            <label>Gender <span>*</span></label>
                            <select class="form-control" name="gender">
                                <option value="">Select Gender</option>
                                <option value="Male" <?= ($data['gender'] ?? '') == 'Male' ? 'selected' : '' ?>>Male</option>
                                <option value="Female" <?= ($data['gender'] ?? '') == 'Female' ? 'selected' : '' ?>>Female</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label>Marital Status <span>*</span></label>
                            <select class="form-control" name="marital_status">
                                <option value="">Select</option>
                                <option value="Single" <?= ($data['marital_status'] ?? '') == 'Single' ? 'selected' : '' ?>>Single</option>
                                <option value="Married" <?= ($data['marital_status'] ?? '') == 'Married' ? 'selected' : '' ?>>Married</option>
                                <option value="Divorced" <?= ($data['marital_status'] ?? '') == 'Divorced' ? 'selected' : '' ?>>Divorced</option>
                                <option value="Widow/er" <?= ($data['marital_status'] ?? '') == 'Widow/er' ? 'selected' : '' ?>>Widow/er</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label>Country</label>
                            <input class="form-control" name="country" type="text"
                                value="<?= htmlspecialchars($data['country'] ?? '') ?>" placeholder="Country">
                        </div>
                        <div class="col-md-3">
                            <label>State</label>
                            <input class="form-control" name="state" type="text"
                                value="<?= htmlspecialchars($data['state'] ?? '') ?>" placeholder="State">
                        </div>
                        <div class="col-md-3">
                            <label>City</label>
                            <input class="form-control" name="city" type="text"
                                value="<?= htmlspecialchars($data['city'] ?? '') ?>" placeholder="City">
                        </div>
                        <div class="col-md-6">
                            <label>Nationality</label>
                            <input class="form-control" name="nationality" type="text"
                                value="<?= htmlspecialchars($data['nationality'] ?? '') ?>" placeholder="Nationality">
                        </div>
                        <div class="col-md-6">
                            <label>Date of Birth</label>
                            <input class="form-control" name="date_of_birth" type="date"
                                value="<?= htmlspecialchars($data['date_of_birth'] ?? '') ?>">
                        </div>
                        <div class="col-md-6">
                            <label>Phone</label>
                            <input class="form-control" name="phone" type="text"
                                value="<?= htmlspecialchars($data['phone'] ?? '') ?>" placeholder="Phone">
                        </div>
                        <div class="col-md-6">
                            <label>Mobile</label>
                            <input class="form-control" name="mobile_num" type="text"
                                value="<?= htmlspecialchars($data['mobile_num'] ?? '') ?>" placeholder="Mobile">
                        </div>
                        <div class="col-md-12">
                            <label>Street Address</label>
                            <textarea class="form-control" name="street_address" rows="3"
                                placeholder="Street Address"><?= htmlspecialchars($data['street_address'] ?? '') ?></textarea>
                        </div>
                    </div>

                    <hr>
                    <h5>Career Information</h5>
                    <div class="row">
                        <!-- <div class="col-md-6">
                                            <label>Job Experience</label>
                                            <input class="form-control" name="job_experience" type="text"
                                                value="<?= htmlspecialchars($data['job_experience'] ?? '') ?>" placeholder="Job Experience">
                                        </div> -->
                        <div class="col-md-6">
                            <div>
                                <label for="">Job Experience <span>*</span></label>
                                <select class="form-control" name="job_experience">
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
                        <div class="col-md-6">
                            <label>Career Level</label>
                            <input class="form-control" name="career_level" type="text"
                                value="<?= htmlspecialchars($data['career_level'] ?? '') ?>" placeholder="Career Level">
                        </div>
                        <div class="col-md-6">
                            <label>Industry</label>
                            <input class="form-control" name="industry" type="text"
                                value="<?= htmlspecialchars($data['industry'] ?? '') ?>" placeholder="Industry">
                        </div>
                        <div class="col-md-6">
                            <label>Functional Area</label>
                            <input class="form-control" name="functional_area" type="text"
                                value="<?= htmlspecialchars($data['functional_area'] ?? '') ?>" placeholder="Functional Area">
                        </div>
                        <div class="col-md-4">
                            <label>Salary Currency</label>
                            <input class="form-control" name="salary_currency" type="text"
                                value="<?= htmlspecialchars($data['salary_currency'] ?? '') ?>" placeholder="Currency">
                        </div>
                        <div class="col-md-4">
                            <label>Current Salary</label>
                            <input class="form-control" name="current_salary" type="text"
                                value="<?= htmlspecialchars($data['current_salary'] ?? '') ?>" placeholder="Current Salary">
                        </div>
                        <div class="col-md-4">
                            <label>Expected Salary</label>
                            <input class="form-control" name="expected_salary" type="text"
                                value="<?= htmlspecialchars($data['expected_salary'] ?? '') ?>" placeholder="Expected Salary">
                        </div>
                    </div>

                    <div class="row mt-3">
                        <h5>Summary</h5>
                        <div class="col-md-12">
                            <textarea class="form-control" name="summary" rows="5"
                                placeholder="Profile Summary"><?= htmlspecialchars($data['summary'] ?? '') ?></textarea>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-12">
                            <label>
                                <input type="checkbox" name="is_subscribed" <?= ($data['is_subscribed'] ?? 0) ? 'checked' : '' ?>>
                                Subscribe to Newsletter
                            </label>
                        </div>
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary w-100">Update Profile and Save</button>
                        </div>
                    </div>
                </form>




            </div>
        </div>
    </div>
</section>

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