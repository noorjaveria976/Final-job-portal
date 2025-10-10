<?php $pageTitle = "Profile "; ?>

<?php

include 'config.php';

// Dummy session user_id (replace with actual login session)
$user_id = $_SESSION['user_id'] ?? 1;

// Fetch applied jobs (join with jobs table to get details)
$sql = "SELECT j.* 
        FROM job_seeker_appliedjobs aj
        INNER JOIN jobs j ON aj.job_id = j.id
        WHERE aj.user_id = $user_id
        ORDER BY aj.applied_at DESC";

$result = mysqli_query($conn, $sql);

?>


<section class="section">
  <div class="section-body">
    <!-- add content here -->
    <div class="container my-4">
      <h3 class="mb-4">My Applied Jobs</h3>

      <?php if (mysqli_num_rows($result) > 0): ?>
        <?php while ($job = mysqli_fetch_assoc($result)): ?>
          <div class="card card-primary mb-3">
            <div class="card-body text-dark">
              <div class="row">
                <!-- Left Column -->
                <div class="col-md-8 col-sm-8 d-flex">
                  <!-- Job Image -->
                  <div class="jobimg border p-1 rounded me-3" style="width: 80px; height: 80px; overflow:hidden;">
                    <img src="./assets/img/logo tef.png" alt="<?= $job['company_name'] ?>" title="<?= $job['company_name'] ?>" class="img-fluid">
                  </div>
                  <!-- Job Info -->
                  <div class="jobinfo">
                    <h3 class="fs-5 mb-1">
                      <a class="text-decoration-none text-dark" href="view_jobs.php?id=<?= $job['id'] ?>" title="<?= $job['title'] ?>">
                        <?= $job['title'] ?>
                      </a>
                    </h3>
                    <div class="companyName mb-1">
                      <a class="text-decoration-none text-dark" href="view_jobs.php?id=<?= $job['id'] ?>" title="<?= $job['company_name'] ?>">
                        <?= $job['company_name'] ?>
                      </a>
                    </div>
                    <div class="location">
                      <label class="fulltime bg-success border rounded-pill px-2 text-white" title="<?= $job['job_shift'] ?>">
                        <?= $job['job_shift'] ?>
                      </label>
                      - <span><?= $job['city_name'] ?></span>
                    </div>
                  </div>
                </div>

                <!-- Right Column -->
                <div class="col-md-4 col-sm-4 d-flex justify-content-end align-items-start">
                  <a href="layout.php?page=seeker_view_jobs&id=<?= $job['id'] ?>" class="btn btn-outline-primary py-2 px-4 mt-3">
                    VIEW DETAILS
                  </a>
                </div>
              </div>

              <!-- Job Short Description -->
              <p class="mt-3 text-muted">
                <?= substr(strip_tags($job['description']), 0, 150) ?>...
              </p>
            </div>
          </div>
        <?php endwhile; ?>
      <?php else: ?>
        <p class="text-muted">You have not applied to any jobs yet.</p>
      <?php endif; ?>
    </div>
  </div>
</section>