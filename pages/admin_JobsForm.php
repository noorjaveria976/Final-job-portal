<?php
include('config.php');

$job_id = $_GET['id'] ?? null; // Edit mode ke liye

if ($job_id) {
    $res = $conn->query("SELECT * FROM jobs WHERE id='$job_id'");
    $job = $res->fetch_assoc();
}

// POST request
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title            = $conn->real_escape_string($_POST['title'] ?? '');
    $description      = $conn->real_escape_string($_POST['description'] ?? '');
    $benefits         = $conn->real_escape_string($_POST['benefits'] ?? '');
    $country_name     = $conn->real_escape_string($_POST['country_name'] ?? '');
    $state_name       = $conn->real_escape_string($_POST['state_name'] ?? ''); // fix
    $city_name        = $conn->real_escape_string($_POST['city_name'] ?? '');
    $career_level     = $conn->real_escape_string($_POST['career_level'] ?? '');
    $gender           = $conn->real_escape_string($_POST['gender'] ?? '');
    $company_name     = $conn->real_escape_string($_POST['company_name'] ?? '');
    $salary_from      = $_POST['salary_from'] ?? '';
    $salary_to        = $_POST['salary_to'] ?? '';
    $salary_currency  = $_POST['salary_currency'] ?? '';
    $salary_period    = $_POST['salary_period'] ?? '';
    $hide_salary      = $_POST['hide_salary'] ?? 'No'; // fix
    $functional_area  = $conn->real_escape_string($_POST['functional_area'] ?? '');
    $job_type         = $conn->real_escape_string($_POST['job_type'] ?? '');
    $job_shift        = $conn->real_escape_string($_POST['job_shift'] ?? '');
    $degree_level     = $conn->real_escape_string($_POST['degree_level'] ?? '');
    $job_experience   = $conn->real_escape_string($_POST['job_experience'] ?? '');
    $num_of_positions = $_POST['num_of_positions'] ?? '';
    $expiry_date      = $_POST['expiry_date'] ?? '';
    $external_job     = $_POST['external_job'] ?? 'no';
    $job_link         = $conn->real_escape_string($_POST['job_link'] ?? '');
    $is_freelance     = $_POST['is_freelance'] ?? 'No';

    if ($job_id) {
        // UPDATE query
        $stmt = $conn->prepare("UPDATE jobs SET title=?, description=?, benefits=?, country_name=?, state_name=?, city_name=?, company_name=?, salary_from=?, salary_to=?, salary_currency=?, salary_period=?, hide_salary=?, career_level=?, functional_area=?, job_type=?, job_shift=?, num_of_positions=?, gender=?, expiry_date=?, degree_level=?, job_experience=?, is_freelance=?, external_job=?, job_link=? WHERE id=?");

        $stmt->bind_param("sssssssssssssssssssssssss",
            $title, $description, $benefits, $country_name, $state_name, $city_name, $company_name,
            $salary_from, $salary_to, $salary_currency, $salary_period, $hide_salary,
            $career_level, $functional_area, $job_type, $job_shift, $num_of_positions, $gender,
            $expiry_date, $degree_level, $job_experience, $is_freelance, $external_job, $job_link,
            $job_id
        );

        if ($stmt->execute()) {
            $_SESSION['success'] = "Job Updated Successfully!";
            header("Location: layout.php?page=admin_manageJobs");
            exit();
        } else {
            echo "Error: ".$stmt->error;
        }
        $stmt->close();
    } else {
        // --- Insert new job ---
        $sql = "INSERT INTO jobs (
                    title, description, benefits, country_name, state_name, city_name, company_name,
                    salary_from, salary_to, salary_currency, salary_period, hide_salary,
                    career_level, functional_area, job_type, job_shift,
                    num_of_positions, gender, expiry_date, degree_level, job_experience,
                    is_freelance, external_job, job_link, created_at, status
                ) VALUES (
                    '$title', '$description', '$benefits', '$country_name', '$state_name', '$city_name', '$company_name',
                    '$salary_from', '$salary_to', '$salary_currency', '$salary_period', '$hide_salary',
                    '$career_level', '$functional_area', '$job_type', '$job_shift',
                    '$num_of_positions', '$gender', '$expiry_date', '$degree_level', '$job_experience',
                    '$is_freelance', '$external_job', '$job_link', NOW(), 'Inactive'
                )";
        if ($conn->query($sql) === TRUE) {
            $_SESSION['success'] = "Job Added successfully!";
            header("Location:layout.php?page=admin_manageJobs");
            exit();
        } else {
            echo "Error: " . $conn->error;
        }
    }
}
?>

<!-- Main Content -->
<section class="section">
    <div class="section-body">
        <!-- add content here -->
        <!-- Personal Information -->
        <!-- Personal Information -->
        <h5>Job Details</h5>
        <form method="POST" action="" accept-charset="UTF-8" class="form">
            <input name="_token" type="hidden" value="HmbWBIt1dbfdyve9yXAnvJiW636QuLsC5vGcLS1L">
            <div class="row">
                <!-- Job Title -->
                <div class="col-md-12">
                    <div class="formrow">
                        <input class="form-control" id="title" placeholder="Job title" name="title" type="text"
                            value="<?= htmlspecialchars($job['title'] ?? '', ENT_QUOTES) ?>">
                    </div>
                </div>

                <!-- Description -->
                <div class="col-md-12 mt-3">
                    <div class="formrow">
                        <label for="" class="pb-2">Description</label>
                        <textarea name="description" rows="4" class="form-control"><?= htmlspecialchars($job['description'] ?? '', ENT_QUOTES) ?></textarea>
                    </div>
                </div>

                <!-- Benefits -->
                <div class="col-md-12 mb-3">
                    <div class="formrow">
                        <label for="" class="pb-2">Benefits</label>
                        <textarea name="benefits" rows="3" class="form-control"><?= htmlspecialchars($job['benefits'] ?? '', ENT_QUOTES) ?></textarea>
                    </div>
                </div>

                <!-- Country -->
                <div class="col-md-4">
                    <div class="formrow" id="country_id_div">
                        <select class="form-control" id="country_name" name="country_name">
                            <option value="">Select Country</option>
                            <?php
                            $countries = ["Afghanistan", "Albania", "Algeria", "American Samoa", "Andorra", "Angola", "Anguilla", "Antarctica", "Antigua And Barbuda", "Argentina", "Armenia", "Aruba", "Australia", "Austria", "Azerbaijan"];
                            foreach ($countries as $c) {
                                $selected = (isset($job['country_name']) && $job['country_name'] == $c) ? 'selected' : '';
                                echo "<option value=\"$c\" $selected>$c</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>

                <!-- City -->
                <div class="col-md-4">
                    <div class="formrow" id="city_id_div">
                        <select class="form-control" id="city_name" name="city_name">
                            <option value="" selected>Select City</option>
                            <?php
                            $cities = ["Lahore", "Karachi", "Islamabad", "Faisalabad", "Multan", "Rawalpindi", "Peshawar", "Quetta", "Hyderabad", "Sialkot"];
                            foreach ($cities as $c) {
                                $selected = (isset($job['city_name']) && $job['city_name'] == $c) ? 'selected' : '';
                                echo "<option value=\"$c\" $selected>$c</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>

                <!-- Company Name -->
                <div class="col-md-4">
                    <div class="formrow">
                        <input type="text" class="form-control" id="company_name" name="company_name" placeholder="Enter Company Name"
                            value="<?= htmlspecialchars($job['company_name'] ?? '', ENT_QUOTES) ?>" required>
                    </div>
                </div>

                <!-- Salary From/To -->
                <div class="col-md-6 mt-3">
                    <div class="formrow">
                        <input class="form-control" id="salary_from" placeholder="Salary from" name="salary_from" type="number"
                            value="<?= $job['salary_from'] ?? '' ?>">
                    </div>
                </div>
                <div class="col-md-6 mt-3">
                    <div class="formrow">
                        <input class="form-control" id="salary_to" placeholder="Salary to" name="salary_to" type="number"
                            value="<?= $job['salary_to'] ?? '' ?>">
                    </div>
                </div>

                <!-- Salary Currency -->
                <div class="col-md-4 mt-3">
                    <div class="formrow">
                        <select class="form-control" id="salary_currency" name="salary_currency">
                            <option value="">Select Salary Currency</option>
                            <?php
                            $currencies = ["£", "$", "€", "د.إ", "؋", "Lek", "ƒ", "ман", "KM", "лв", "$b", "R$", "P", "p.", "CHF", "¥", "₡", "₱", "Kč", "kr", "RD$", "¢", "Q", "L", "Ft", "Rp", "₪", "﷼", "J$"];
                            foreach ($currencies as $c) {
                                $selected = (isset($job['salary_currency']) && $job['salary_currency'] == $c) ? 'selected' : '';
                                echo "<option value=\"$c\" $selected>$c</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>

                <!-- Salary Period -->
                <div class="col-md-4 mt-3">
                    <div class="formrow">
                        <select class="form-control" id="salary_period" name="salary_period">
                            <option value="">Select Salary Period</option>
                            <?php
                            $periods = ["Weekly", "Monthly", "Yearly"];
                            foreach ($periods as $p) {
                                $selected = (isset($job['salary_period']) && $job['salary_period'] == $p) ? 'selected' : '';
                                echo "<option value=\"$p\" $selected>$p</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>

                <!-- Hide Salary -->
                <div class="col-md-4 mt-3">
                    <div class="formrow">
                        <label for="hide_salary" class="bold">Hide Salary?</label>
                        <div class="radio-list">
                            <label class="radio-inline">
                                <input id="hide_salary_yes" name="hide_salary" type="radio" value="Yes" <?= (isset($job['hide_salary']) && $job['hide_salary'] == "Yes") ? 'checked' : '' ?>> Yes
                            </label>
                            <label class="radio-inline">
                                <input id="hide_salary_no" name="hide_salary" type="radio" value="No" <?= (!isset($job['hide_salary']) || $job['hide_salary'] == "No") ? 'checked' : '' ?>> No
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Career Level -->
                <div class="col-md-6 mt-3">
                    <div class="formrow">
                        <select class="form-control" id="career_level" name="career_level">
                            <option value="">Select Career level</option>
                            <?php
                            $levels = ["Department Head", "Entry Level", "Experienced Professional", "GM / CEO / Country Head / President", "Intern/Student"];
                            foreach ($levels as $l) {
                                $selected = (isset($job['career_level']) && $job['career_level'] == $l) ? 'selected' : '';
                                echo "<option value=\"$l\" $selected>$l</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>

                <!-- Functional Area -->
                <div class="col-md-6 mt-3">
                    <div class="formrow">
                        <select class="form-control" id="functional_area" name="functional_area">
                            <option value="">Select Functional Area</option>
                            <?php
                            $areas = ["Other", "Information Technology", "Management and Manufacturing", "Engineering and Information Technology", "Health Care Provider", "Accounting/Auditing and Finance", "Administrative", "Sales and Business Development", "Accountant", "Admin", "Advertising", "Architects & Construction"];
                            foreach ($areas as $a) {
                                $selected = (isset($job['functional_area']) && $job['functional_area'] == $a) ? 'selected' : '';
                                echo "<option value=\"$a\" $selected>$a</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>

                <!-- Job Type -->
                <div class="col-md-6 mt-3">
                    <div class="formrow">
                        <select class="form-control" id="job_type" name="job_type">
                            <option value="">Select Job Type</option>
                            <?php
                            $types = ["Contract", "Freelance", "Full Time/Permanent", "Internship", "Part Time"];
                            foreach ($types as $t) {
                                $selected = (isset($job['job_type']) && $job['job_type'] == $t) ? 'selected' : '';
                                echo "<option value=\"$t\" $selected>$t</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>

                <!-- Job Shift -->
                <div class="col-md-6 mt-3">
                    <div class="formrow">
                        <select class="form-control" id="job_shift" name="job_shift">
                            <option value="">Select Job Shift</option>
                            <?php
                            $shifts = ["First Shift (Day)", "Second Shift (Afternoon)", "Third Shift (Night)", "Rotating"];
                            foreach ($shifts as $s) {
                                $selected = (isset($job['job_shift']) && $job['job_shift'] == $s) ? 'selected' : '';
                                echo "<option value=\"$s\" $selected>$s</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>

                <!-- Number of Positions -->
                <div class="col-md-6 mt-3">
                    <div class="formrow">
                        <select class="form-control" id="num_of_positions" name="num_of_positions">
                            <option value="">Select number of Positions</option>
                            <?php
                            for ($i = 1; $i <= 14; $i++) {
                                $selected = (isset($job['num_of_positions']) && $job['num_of_positions'] == $i) ? 'selected' : '';
                                echo "<option value=\"$i\" $selected>$i</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>

                <!-- Gender -->
                <div class="col-md-6 mt-3">
                    <div class="formrow">
                        <select class="form-control" id="gender" name="gender">
                            <option value="">Select Gender</option>
                            <?php
                            $genders = ["Male", "Female", "Any"];
                            foreach ($genders as $g) {
                                $selected = (isset($job['gender']) && $job['gender'] == $g) ? 'selected' : '';
                                echo "<option value=\"$g\" $selected>$g</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>

                <!-- Expiry Date -->
                <div class="col-md-6 mt-3">
                    <div class="form-group">
                        <label for="expiry_date">Expiry Date</label>
                        <input type="date" name="expiry_date" id="expiry_date" class="form-control" required
                            value="<?= $job['expiry_date'] ?? '' ?>">
                    </div>
                </div>

                <!-- Degree Level -->
                <div class="col-md-6 mt-3">
                    <div class="formrow">
                        <select class="form-control" id="degree_level" name="degree_level" required>
                            <option value="">Select Required Degree Level</option>
                            <?php
                            $degrees = ["Non-Matriculation", "Matriculation/O-Level", "Intermediate/A-Level", "Bachelors", "Masters", "MPhil/MS", "PHD/Doctorate", "Certification", "Diploma", "Short Course"];
                            foreach ($degrees as $d) {
                                $selected = (isset($job['degree_level']) && $job['degree_level'] == $d) ? 'selected' : '';
                                echo "<option value=\"$d\" $selected>$d</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>

                <!-- Job Experience -->
                <div class="col-md-6 mt-3">
                    <div class="formrow">
                        <select class="form-control" id="job_experience" name="job_experience" required>
                            <option value="">Select Required Job Experience</option>
                            <?php
                            $exps = ["Fresh", "Less Than 1 Year", "1 Year", "2 Years", "3 Years", "4 Years", "5 Years", "6 Years", "7 Years"];
                            foreach ($exps as $e) {
                                $selected = (isset($job['job_experience']) && $job['job_experience'] == $e) ? 'selected' : '';
                                echo "<option value=\"$e\" $selected>$e</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>

                <!-- Freelance -->
                <div class="col-md-6 mt-3">
                    <div class="formrow">
                        <label for="is_freelance" class="bold">Is Freelance?</label>
                        <div class="radio-list">
                            <label class="radio-inline">
                                <input id="is_freelance_yes" name="is_freelance" type="radio" value="Yes" <?= (isset($job['is_freelance']) && $job['is_freelance'] == "Yes") ? 'checked' : '' ?>> Yes
                            </label>
                            <label class="radio-inline">
                                <input id="is_freelance_no" name="is_freelance" type="radio" value="No" <?= (!isset($job['is_freelance']) || $job['is_freelance'] == "No") ? 'checked' : '' ?>> No
                            </label>
                        </div>
                    </div>
                </div>

                <!-- External Job -->
                <div class="col-md-12 mt-3">
                    <div class="formrow">
                        <label for="external_job" class="bold">Is this External Job?</label>
                        <div class="radio-list">
                            <label class="radio-inline">
                                <input id="external" name="external_job" type="radio" value="yes" <?= (isset($job['external_job']) && $job['external_job'] == "yes") ? 'checked' : '' ?>> Yes
                            </label>
                            <label class="radio-inline">
                                <input id="not_external" name="external_job" type="radio" value="no" <?= (!isset($job['external_job']) || $job['external_job'] == "no") ? 'checked' : '' ?>> No
                            </label>
                        </div>

                        <div class="form-group">
                            <div id="externalLinkField" class="formrow" style="<?= (isset($job['external_job']) && $job['external_job'] == "yes") ? '' : 'display:none;' ?>">
                                <label for="job_link" class="bold">External Link</label>
                                <input class="form-control" name="job_link" type="text" id="job_link" value="<?= htmlspecialchars($job['job_link'] ?? '', ENT_QUOTES) ?>">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Submit -->
                <div class="col-md-12">
                    <div class="formrow">
                        <button type="submit" class="btn1" style="background-color: #0400ff; color: #ffffff; padding: 10px 18px; border-radius: 5px; border: none; transition: all 0.3s ease; width: 100%; height: 40px;">
                            <?= $job_id ? 'Update Job' : 'Submit the Jobs' ?> <i class="fa fa-arrow-circle-right" aria-hidden="true"></i>
                        </button>
                    </div>
                </div>

                <input type="file" name="image" id="image" style="display:none;" accept="image/*" />
            </div>
        </form>

        <!-- JS to toggle external link field -->
        <script>
            document.querySelectorAll('input[name="external_job"]').forEach(el => {
                el.addEventListener('change', function() {
                    document.getElementById('externalLinkField').style.display = this.value == 'yes' ? 'block' : 'none';
                });
            });
        </script>

        <hr>
    </div>
</section>


<script>
    document.querySelectorAll('.delete-btn').forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            const url = this.href;
            Swal.fire({
                title: 'Are you sure?',
                text: "This action cannot be undone!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = url;
                }
            })
        })
    });

    <?php if (isset($_SESSION['success'])): ?>
        Swal.fire({
            icon: 'success',
            title: 'Success',
            text: '<?= $_SESSION['success'] ?>'
        });
    <?php unset($_SESSION['success']);
    endif; ?>
</script>