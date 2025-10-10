<?php


include('config.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $title            = $conn->real_escape_string($_POST['title']);
  $description      = $conn->real_escape_string($_POST['description']);
  $benefits         = $conn->real_escape_string($_POST['benefits']);

  // Text fields
  $country_name     = $conn->real_escape_string($_POST['country_name']);
  $state_name       = $conn->real_escape_string($_POST['state_name']);
  $city_name        = $conn->real_escape_string($_POST['city_name']);
  $career_level     = $conn->real_escape_string($_POST['career_level']);
  $gender           = $conn->real_escape_string($_POST['gender']);

  $company_name     = $conn->real_escape_string($_POST['company_name']);
  $salary_from      = $_POST['salary_from'];
  $salary_to        = $_POST['salary_to'];
  $salary_currency  = $_POST['salary_currency'];
  $salary_period    = $_POST['salary_period'];   // text value (Monthly/Yearly etc.)
  $hide_salary      = $_POST['hide_salary'];     // Yes/No
  $functional_area  = $conn->real_escape_string($_POST['functional_area']);
  $job_type         = $conn->real_escape_string($_POST['job_type']);
  // Ensure a value is always set
  $is_freelance = $_POST['is_freelance'] ?? 'No'; // default No



  // ✅ Now storing human-readable strings
  $job_shift        = $conn->real_escape_string($_POST['job_shift']);       // e.g. "First Shift (Day)"
  $degree_level     = $conn->real_escape_string($_POST['degree_level']);    // e.g. "Bachelors"
  $job_experience   = $conn->real_escape_string($_POST['job_experience']);  // e.g. "3 Years"

  $num_of_positions = $_POST['num_of_positions'];
  $expiry_date      = $_POST['expiry_date'];
  $external_job     = $_POST['external_job'];
  $job_link         = $conn->real_escape_string($_POST['job_link']);

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

?>
<!-- Main Content -->
<section class="section">
    <div class="section-body">
        <!-- add content here -->
        <!-- Personal Information -->
        <!-- Personal Information -->
        <h5>Job Details</h5>
        <form method="POST" action="" accept-charset="UTF-8" class="form"><input name="_token"
                type="hidden" value="HmbWBIt1dbfdyve9yXAnvJiW636QuLsC5vGcLS1L">
            <div class="row">
                <div class="col-md-12">
                    <div class="formrow "> <input class="form-control" id="title"
                            placeholder="Job title" name="title" type="text">
                    </div>
                </div>
                <div class="col-md-12 mt-3">
                    <div class="formrow ">
                        <label for="" class="pb-2">Description</label>
                        <textarea name="description" rows="4" class="form-control"><?php echo htmlspecialchars($job['description'] ?? '', ENT_QUOTES); ?></textarea>

                    </div>
                </div>

                <div class="col-md-12 mb-3">
                    <div class="formrow ">
                        <label for="" class="pb-2">Benefits</label>
                        <textarea name="benefits" rows="3" class="form-control"><?php echo htmlspecialchars($job['benefits'] ?? '', ENT_QUOTES); ?></textarea>

                    </div>
                </div>



                <div class="col-md-4 ">
                    <div class="formrow " id="country_id_div"> <select class="form-control" id="country_name" name="country_name">
                            <option value="">Select Country</option>
                            <option value="Afghanistan">Afghanistan</option>
                            <option value="Albania">Albania</option>
                            <option value="Algeria">Algeria</option>
                            <option value="American Samoa">American Samoa</option>
                            <option value="Andorra">Andorra</option>
                            <option value="Angola">Angola</option>
                            <option value="Anguilla">Anguilla</option>
                            <option value="Antarctica">Antarctica</option>
                            <option value="Antigua And Barbuda">Antigua And Barbuda</option>
                            <option value="Argentina">Argentina</option>
                            <option value="Armenia">Armenia</option>
                            <option value="Aruba">Aruba</option>
                            <option value="Australia">Australia</option>
                            <option value="Austria">Austria</option>
                            <option value="Azerbaijan">Azerbaijan</option>
                        </select>

                    </div>
                </div>
                <div class="col-md-4">
                    <div class="formrow" id="city_id_div">
                        <select class="form-control" id="city_name" name="city_name">
                            <option value="" selected>Select City</option>
                            <option value="Lahore">Lahore</option>
                            <option value="Karachi">Karachi</option>
                            <option value="Islamabad">Islamabad</option>
                            <option value="Faisalabad">Faisalabad</option>
                            <option value="Multan">Multan</option>
                            <option value="Rawalpindi">Rawalpindi</option>
                            <option value="Peshawar">Peshawar</option>
                            <option value="Quetta">Quetta</option>
                            <option value="Hyderabad">Hyderabad</option>
                            <option value="Sialkot">Sialkot</option>
                        </select>

                    </div>
                </div>
                <div class="col-md-4">
                    <div class="formrow">
                        <input type="text" class="form-control" id="company_name" name="company_name" placeholder="Enter Company Name" required>
                    </div>
                </div>

                <div class="col-md-6 mt-3">
                    <div class="formrow " id="salary_from_div"> <input class="form-control"
                            id="salary_from" placeholder="Salary from" name="salary_from" type="number">
                    </div>
                </div>
                <div class="col-md-6 mt-3">
                    <div class="formrow " id="salary_to_div">
                        <input class="form-control" id="salary_to" placeholder="Salary to"
                            name="salary_to" type="number">
                    </div>
                </div>
                <div class="col-md-4 mt-3">
                    <div class="formrow " id="salary_currency_div">

                        <select class="form-control" id="salary_currency" name="salary_currency">
                            <option value="">Select Salary Currency</option>
                            <option value="£">SYP (£)</option>
                            <option value="$">USD ($)</option>
                            <option value="€">EUR (€)</option>
                            <option value="د.إ">AED (د.إ)</option>
                            <option value="؋">AF (؋)</option>
                            <option value="Lek">ALL (Lek)</option>
                            <option value="ƒ">AWG (ƒ)</option>
                            <option value="ман">AZ (ман)</option>
                            <option value="KM">BAM (KM)</option>
                            <option value="лв">UZS (лв)</option>
                            <option value="$b">BOB ($b)</option>
                            <option value="R$">BRL (R$)</option>
                            <option value="P">BWP (P)</option>
                            <option value="p.">BYR (p.)</option>
                            <option value="CHF">CHF (CHF)</option>
                            <option value="¥">JPY (¥)</option>
                            <option value="₡">CRC (₡)</option>
                            <option value="₱">CUP (₱)</option>
                            <option value="Kč">CZK (Kč)</option>
                            <option value="kr">SEK (kr)</option>
                            <option value="RD$">DOP (RD$)</option>
                            <option value="¢">GHC (¢)</option>
                            <option value="Q">GTQ (Q)</option>
                            <option value="L">HNL (L)</option>
                            <option value="Ft">HUF (Ft)</option>
                            <option value="Rp">INR (Rp)</option>
                            <option value="₪">ILS (₪)</option>
                            <option value="﷼">YER (﷼)</option>
                            <option value="J$">JMD (J$)</option>

                        </select>
                    </div>
                </div>
                <div class="col-md-4 mt-3">
                    <div class="formrow " id="salary_period_id_div"> <select class="form-control" id="salary_period" name="salary_period">
                            <option value="" selected>Select Salary Period</option>
                            <option value="Weekly">Weekly</option>
                            <option value="Monthly">Monthly</option>
                            <option value="Yearly">Yearly</option>
                        </select>

                    </div>
                </div>
                <div class="col-md-4 mt-3">
                    <div class="formrow "> <label for="hide_salary" class="bold">Hide Salary?</label>
                        <div class="radio-list">
                            <label class="radio-inline">
                                <input id="hide_salary_yes" name="hide_salary" type="radio" value="Yes"> Yes
                            </label>
                            <label class="radio-inline">
                                <input id="hide_salary_no" name="hide_salary" type="radio" value="No" checked> No
                            </label>

                        </div>
                    </div>
                </div>
                <div class="col-md-6 mt-3">
                    <div class="formrow " id="career_level_id_div"><select class="form-control" id="career_level" name="career_level">
                            <option value="" selected>Select Career level</option>
                            <option value="Department Head">Department Head</option>
                            <option value="Entry Level">Entry Level</option>
                            <option value="Experienced Professional">Experienced Professional</option>
                            <option value="GM / CEO / Country Head / President">GM / CEO / Country Head / President</option>
                            <option value="Intern/Student">Intern/Student</option>
                        </select>

                    </div>
                </div>

                <!-- Functional Area -->
                <div class="col-md-6 mt-3">
                    <div class="formrow" id="functional_area_div">
                        <select class="form-control" id="functional_area" name="functional_area">
                            <option value="" selected>Select Functional Area</option>
                            <option value="Other">Other</option>
                            <option value="Information Technology">Information Technology</option>
                            <option value="Management and Manufacturing">Management and Manufacturing</option>
                            <option value="Engineering and Information Technology">Engineering and Information Technology</option>
                            <option value="Health Care Provider">Health Care Provider</option>
                            <option value="Accounting/Auditing and Finance">Accounting/Auditing and Finance</option>
                            <option value="Administrative">Administrative</option>
                            <option value="Sales and Business Development">Sales and Business Development</option>
                            <option value="Accountant">Accountant</option>
                            <option value="Admin">Admin</option>
                            <option value="Advertising">Advertising</option>
                            <option value="Architects & Construction">Architects & Construction</option>
                        </select>
                    </div>
                </div>

                <!-- Job Type -->
                <div class="col-md-6 mt-3">
                    <div class="formrow" id="job_type_div">
                        <select class="form-control" id="job_type" name="job_type">
                            <option value="" selected>Select Job Type</option>
                            <option value="Contract">Contract</option>
                            <option value="Freelance">Freelance</option>
                            <option value="Full Time/Permanent">Full Time/Permanent</option>
                            <option value="Internship">Internship</option>
                            <option value="Part Time">Part Time</option>
                        </select>
                    </div>
                </div>

                <!-- Job Shift -->
                <div class="col-md-6 mt-3">
                    <div class="formrow" id="job_shift_div">
                        <select class="form-control" id="job_shift" name="job_shift">
                            <option value="" selected>Select Job Shift</option>
                            <option value="First Shift (Day)">First Shift (Day)</option>
                            <option value="Second Shift (Afternoon)">Second Shift (Afternoon)</option>
                            <option value="Third Shift (Night)">Third Shift (Night)</option>
                            <option value="Rotating">Rotating</option>
                        </select>
                    </div>
                </div>

                <div class="col-md-6 mt-3">
                    <div class="formrow " id="num_of_positions_div"> <select class="form-control"
                            id="num_of_positions" name="num_of_positions">
                            <option value="" selected="selected">Select number of Positions</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            <option value="7">7</option>
                            <option value="8">8</option>
                            <option value="9">9</option>
                            <option value="10">10</option>
                            <option value="11">11</option>
                            <option value="12">12</option>
                            <option value="13">13</option>
                            <option value="14">14</option>

                        </select>
                    </div>
                </div>
                <div class="col-md-6 mt-3">
                    <div class="formrow " id="gender_id_div"> <select class="form-control" id="gender" name="gender">
                            <option value="" selected>Select Gender</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                            <option value="Any">Any</option>
                        </select>

                    </div>
                </div>
                <div class="col-md-6 mt-3">
                    <div class="form-group">
                        <label for="expiry_date">Expiry Date</label>
                        <input type="date" name="expiry_date" id="expiry_date" class="form-control" required>
                    </div>

                </div>
                <!-- Degree Level -->
                <div class="col-md-6 mt-3">
                    <div class="formrow" id="degree_level_id_div">
                        <select class="form-control" id="degree_level" name="degree_level" required>
                            <option value="" selected>Select Required Degree Level</option>
                            <option value="Non-Matriculation">Non-Matriculation</option>
                            <option value="Matriculation/O-Level">Matriculation/O-Level</option>
                            <option value="Intermediate/A-Level">Intermediate/A-Level</option>
                            <option value="Bachelors">Bachelors</option>
                            <option value="Masters">Masters</option>
                            <option value="MPhil/MS">MPhil/MS</option>
                            <option value="PHD/Doctorate">PHD/Doctorate</option>
                            <option value="Certification">Certification</option>
                            <option value="Diploma">Diploma</option>
                            <option value="Short Course">Short Course</option>
                        </select>
                    </div>
                </div>

                <!-- Job Experience -->
                <div class="col-md-6 mt-3">
                    <div class="formrow" id="job_experience_id_div">
                        <select class="form-control" id="job_experience" name="job_experience" required>
                            <option value="" selected>Select Required Job Experience</option>
                            <option value="Fresh">Fresh</option>
                            <option value="Less Than 1 Year">Less Than 1 Year</option>
                            <option value="1 Year">1 Year</option>
                            <option value="2 Years">2 Years</option>
                            <option value="3 Years">3 Years</option>
                            <option value="4 Years">4 Years</option>
                            <option value="5 Years">5 Years</option>
                            <option value="6 Years">6 Years</option>
                            <option value="7 Years">7 Years</option>
                        </select>
                    </div>
                </div>

                <!-- Freelance -->
                <div class="col-md-6 mt-3">
                    <div class="formrow">
                        <label for="is_freelance" class="bold">Is Freelance?</label>
                        <div class="radio-list">
                            <label class="radio-inline">
                                <input id="is_freelance_yes" name="is_freelance" type="radio" value="Yes"> Yes
                            </label>
                            <label class="radio-inline">
                                <input id="is_freelance_no" name="is_freelance" type="radio" value="No" checked> No
                            </label>
                        </div>
                    </div>
                </div>


                <!-- Job Shift -->
                <div class="col-md-6 mt-3">
                    <div class="formrow" id="job_shift_div">
                        <select class="form-control" id="job_shift" name="job_shift">
                            <option value="" selected>Select Job Shift</option>
                            <option value="First Shift (Day)">First Shift (Day)</option>
                            <option value="Second Shift (Afternoon)">Second Shift (Afternoon)</option>
                            <option value="Third Shift (Night)">Third Shift (Night)</option>
                            <option value="Rotating">Rotating</option>
                        </select>
                    </div>
                </div>





                <div class="col-md-12 mt-3">
                    <div class="formrow">
                        <label for="external_job" class="bold">Is this External Job?</label>
                        <div class="radio-list">
                            <label class="radio-inline">
                                <input id="external" name="external_job" type="radio" value="yes">
                                Yes
                            </label>
                            <label class="radio-inline">
                                <input id="not_external" name="external_job" type="radio" value="no"
                                    checked=&quot;checked&quot;>
                                No
                            </label>
                        </div>
                    </div>


                    <div class="form-group">
                        <div id="externalLinkField" class="formrow" style="display: none">
                            <label for="job_link" class="bold">External Link</label>
                            <input class="form-control" name="job_link" type="text" value=""
                                id="job_link">
                        </div>

                    </div>

                </div>






                <div class="col-md-12">
                    <div class="formrow">
                        <button type="submit" class=" btn1" style="background-color: #0400ff; color: #ffffff;  padding: 10px 18px; border-radius: 5px; border: none; transition: all 0.3s ease; width: 100%; height: 40px;">Submit the Jobs <i
                                class="fa fa-arrow-circle-right" aria-hidden="true"></i></button>
                    </div>
                </div>
            </div>
            <input type="file" name="image" id="image" style="display:none;" accept="image/*" />
        </form>
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