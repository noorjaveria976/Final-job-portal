<?php $pageTitle = "View Details "; ?>
<?php


include 'config.php';



$user_id = $_SESSION['user_id'] ?? 0;

// Dummy fallback (sirf testing ke liye)
if (!$user_id) {
  $user_id = 1;
}
// 🔹 Profile Complete Check Function
function isProfileComplete($conn, $user_id) {
    $sql = "SELECT * FROM job_seeker_profiles WHERE user_id = '$user_id' LIMIT 1";
    $result = mysqli_query($conn, $sql);

    if (!$result || mysqli_num_rows($result) == 0) {
        return false; // profile hi nahi hai
    }

    $profile = mysqli_fetch_assoc($result);

    // Required fields list
    $requiredFields = [
        'first_name', 'last_name', 'gender', 'marital_status',
        'country', 'state', 'city', 'nationality',
        'date_of_birth', 'phone', 'mobile_num', 'street_address',
        'job_experience', 'career_level', 'industry', 'functional_area',
        'salary_currency', 'current_salary', 'expected_salary', 'summary'
        
    ];

    foreach ($requiredFields as $field) {
    if (!isset($profile[$field]) || $profile[$field] === null) {
        echo "<pre>⚠️ Missing field: $field</pre>";
        return false;
    }

    if (is_string($profile[$field]) && trim($profile[$field]) === '') {
        echo "<pre>⚠️ Empty field: $field</pre>";
        return false;
    }
}


    return true; // sab filled hain
}
// Apply button form submit handle
if (isset($_POST['apply_job'])) {
  $job_id = intval($_GET['id']);

  // 🔹 Step 1: Check profile completion
  if (!isProfileComplete($conn, $user_id)) {
    $msg = "<p class='text-danger'>⚠️ Please complete your profile before applying for a job.</p>";
  } else {
    // 🔹 Step 2: Check if already applied
    $check = "SELECT * FROM job_seeker_appliedjobs WHERE user_id = $user_id AND job_id = $job_id LIMIT 1";
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

?>

<section class="section">
  <div class="section-body">
    <!-- add content here -->
    <div class="container-fluid py-4">


      <div class="card shadow" style="border-radius: 20px;">
        <div class="card-body">
          <div class="row">
            <!-- Left Column -->
            <div class="col-md-4" style="background-color: #f8f9fa; border-right: 2px solid #e9ecef; padding: 15px;">
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
                    <th>State:</th>
                    <td><?= htmlspecialchars($job['state_name']) ?></td>
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
              <a href="layout.php?page=seeker_apply_jobs" class="btn btn-success btn-sm mb-3">
                <i class="fas fa-arrow-left"></i> Back to Listings
              </a>

              <div class="d-flex align-items-center mb-3">
                <img src="./assets/img/logo tef.png" alt="Logo" class="job-logo me-3" style=" width: 70px; height: auto; border-radius: 5px;">
                <div class="date-box me-3" style="background-color: #3498db; color: white; text-align: center; padding: 5px; border-radius: 5px; width: 60px; font-size: 14px;">
                  <strong style=" font-size: 18px; display: block;"><?= date("d", strtotime($job['created_at'] ?? $job['expiry_date'])) ?></strong>
                  <?= date("M", strtotime($job['created_at'] ?? $job['expiry_date'])) ?>
                </div>
                <div>
                  <h5 class="mb-0"><?= $job['title'] ?></h5>
                  <small class="text-muted"><?= $job['company_name'] ?>, <?= $job['city_name'] ?></small>
                </div>
              </div>

              <h6 class=" text-danger border-bottom pb-1 mb-2">Job Description</h6>
              <p><?= nl2br($job['description']) ?></p>

              <h6 class=" text-danger border-bottom pb-1 mb-2">Benefits</h6>
              <p><?= nl2br($job['benefits']) ?></p>

              <h6 class=" text-danger mt-3 border-bottom pb-1 mb-2">Degree Level</h6>
              <span class="bg-info text-white px-2 py-1 rounded d-inline-block me-1 mb-1"><?= $job['degree_level'] ?></span>

              <div class="mt-4">
                <?php if (!empty($msg)) echo $msg; ?>

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
                <?php endif; ?>
              </div>


            </div>
          </div>
        </div>
      </div>


    </div>
  </div>
</section>