<?php $pageTitle = "Profile "; ?>

<?php

include 'config.php';
$user_id = $_SESSION['user_id'] ?? 0;

?>
  <link href="assets/css/main.css" rel="stylesheet">

<section class="section">
  <div class="section-body">
    <?php
    // saari jobs fetch karo (latest first)
    $sql = "SELECT * FROM jobs WHERE status='active' ORDER BY created_at DESC";
    $result = mysqli_query($conn, $sql);
    ?>

    <div class="container my-4">
      <div class="row">
        <?php if (mysqli_num_rows($result) > 0): ?>
          <?php while ($job = mysqli_fetch_assoc($result)): ?>
            <div class="col-md-4 mb-4">
              <div class="card card-success h-100 shadow-sm border
                    transition transform hover-shadow" style="border-radius: 20px;">
                <div class="card-body">
                  <div class="jobint mt-0 mb-4 text-dark">

                    <!-- Job Type -->
                    <div class="d-flex">
                      <div class="fticon">
                        <i class="fas fa-briefcase bg-light p-2 border rounded-pill me-3"></i>
                        <?= htmlspecialchars($job['job_type']) ?>
                      </div>
                    </div>

                    <!-- Job Title -->
                    <h4 class="fs-5 mt-2">
                      <span class="text-dark fs-4" title="<?= htmlspecialchars($job['title']) ?>">
                        <?= htmlspecialchars($job['title']) ?>
                      </span>
                    </h4>

                    <!-- Salary -->
                    <div class="salary mb-2">
                      Salary:
                      <strong>
                        <?php if ($job['hide_salary'] == 1): ?>
                          Hidden
                        <?php else: ?>
                          <?= htmlspecialchars($job['salary_currency']) ?>
                          <?= htmlspecialchars($job['salary_from']) ?> -
                          <?= htmlspecialchars($job['salary_to']) ?>/<?= htmlspecialchars($job['salary_period']) ?>
                        <?php endif; ?>
                      </strong>
                    </div>

                    <!-- Location -->
                    <strong>
                      <i class="fas fa-map-marker-alt"></i> <?= htmlspecialchars($job['city_name']) ?>,
                      <?= htmlspecialchars($job['state_name']) ?>,
                      <?= htmlspecialchars($job['country_name']) ?>
                    </strong>

                    <!-- Company Info -->
                    <div class="jobcompany d-flex mt-3 justify-content-between align-items-center py-2 px-3 border rounded-4 border-0" style="background: #f3f3f3;">
                      <div class="ftjobcomp">
                        <span><?= date("M d, Y", strtotime($job['created_at'])) ?></span>
                        <span title="<?= htmlspecialchars($job['functional_area']) ?>">
                          <?= htmlspecialchars($job['functional_area']) ?>
                        </span>
                      </div>
                      <div class="company-logo" title="<?= htmlspecialchars($job['company_name']) ?>">
                        <img src="./assets/img/logo tef.png" alt="<?= htmlspecialchars($job['company_name']) ?>" title="<?= htmlspecialchars($job['company_name']) ?>">
                      </div>

                    </div>
                    <!-- View Details Button -->
                    <a href="layout.php?page=seeker_view_jobs&id=<?= $job['id'] ?>" class="btn btn-primary mt-3 w-75">
                      <i class="fas fa-eye"></i> View Details
                    </a>
                  </div>
                </div>
              </div>
            </div>
          <?php endwhile; ?>
        <?php else: ?>
          <p class="text-center">No jobs found.</p>
        <?php endif; ?>
      </div>
    </div>

  </div>
</section>