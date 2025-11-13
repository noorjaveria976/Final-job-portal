<?php
include('config.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>TheSmartJobPortal - Find Jobs Online</title>

  <?php include 'include/html-sources.html' ?>
  <!-- Existing CSS -->
  <link rel="stylesheet" href="assets/css/app.min.css">
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="stylesheet" href="assets/css/components.css">
  <link rel="stylesheet" href="assets/css/custom.css">
  <link rel='shortcut icon' type='image/x-icon' href='assets/img/favicon.ico' />
  <link href="assets/css/main.css" rel="stylesheet">
</head>

<body>
  <!-- Navbar -->

  <nav class="navbar navbar-expand-lg main-navbar sticky"
    style="left:0px; 
         background: rgba(255, 255, 255, 0.15); 
         backdrop-filter: blur(10px); 
         -webkit-backdrop-filter: blur(10px); 
         border-bottom: 1px solid rgba(255, 255, 255, 0.2);">
    <div class="container">
      <a class="navbar-brand" href="index.php">
        <img src="assets/img/pledges_logo-removebg-preview.png" alt="logo" style="height:40px;">
      </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav">
        <span class="navbar-toggler-icon">X</span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav mx-auto">
          <li class="nav-item active"><a class="nav-link text-white" href="index.php">Home</a></li>
          <li class="nav-item"><a class="nav-link text-white" href="">Jobs</a></li>
          <li class="nav-item"><a class="nav-link text-white" href="#">Employers</a></li>
          <li class="nav-item"><a class="nav-link text-white" href="#">About</a></li>
          <li class="nav-item"><a class="nav-link text-white" href="#">Contact</a></li>
        </ul>
        <li class="nav-item"><a class="btn btn-primary btn-sm ml-3" href="login.php">Login</a></li>
        <li class="nav-item"><a class="btn btn-success btn-sm ml-3" href="user_register.php">Register</a></li>
      </div>
    </div>
  </nav>

  <!-- Hero Section -->

  <section class="hero-section"
    style="background: url('assets/img/image-gallery/15.png') no-repeat center center;
         background-size: cover;
         background-attachment: fixed;   /* Parallax effect */
         padding:120px 0;
         position: relative;">

    <!-- Dark Overlay for readability -->
    <div style="background: rgb(0 0 0 / 10%);; padding:40px 0;">
      <div class="container text-center text-white">
        <h1 class="mb-4 ">Find Your Dream Job</h1>
        <p class="mb-5">Search jobs by category, location, or keywords.</p>
        <form class="form-inline justify-content-center">
          <input type="text" class="form-control mr-2 mb-2" placeholder="Keyword (e.g. Developer)">
          <select class="form-control mr-2 mb-2">
            <option>All Categories</option>
            <option>IT / Software</option>
            <option>Education</option>
            <option>Government</option>
            <option>Engineering</option>
          </select>
          <select class="form-control mr-2 mb-2">
            <option>All Locations</option>
            <option>Lahore</option>
            <option>Karachi</option>
            <option>Islamabad</option>
            <option>Multan</option>
            <option>Bahawalpur</option>
          </select>
          <button class="btn btn-primary mb-2">Search</button>
        </form>
      </div>
    </div>
    <section class="section" style="background: rgba(235, 235, 235, 0.27); padding:40px 0;">
      <div class="container">
        <h2 class="text-center mb-4 text-light">Latest Jobs</h2>
        <?php
        // Active jobs fetch karo
        $sql = "SELECT * FROM jobs WHERE status='Active' ORDER BY created_at DESC";
        $result = mysqli_query($conn, $sql);
        ?>
        <!--Featured Job start-->

        <div class="row">
          <?php if (mysqli_num_rows($result) > 0): ?>
            <?php while ($job = mysqli_fetch_assoc($result)): ?>
              <div class="col-md-4 mb-4">

                <!-- Wrap whole card in anchor -->
                <a href="seeker_view_jobs.php?id=<?= $job['id'] ?>" class="text-decoration-none text-dark">
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

                      </div>
                    </div>
                  </div>
                </a>
                <!-- End anchor -->

              </div>
            <?php endwhile; ?>
          <?php else: ?>
            <p class="text-center">No jobs found.</p>
          <?php endif; ?>
        </div>
        <div class="text-center my-4">
          <a href="jobs/job_list.php" class="btn btn-primary">View All Jobs</a>
        </div>
      </div>
    </section>
  </section>


  <!-- Latest Jobs -->


  <!-- Stats Section -->
  <section class="py-5 text-center" style="background:#f9fbfd;">
    <div class="container">
      <div class="row">
        <div class="col-md-4 mb-3">
          <h3>1200+</h3>
          <p>Jobs Posted</p>
        </div>
        <div class="col-md-4 mb-3">
          <h3>350+</h3>
          <p>Employers Registered</p>
        </div>
        <div class="col-md-4 mb-3">
          <h3>5000+</h3>
          <p>Job Seekers</p>
        </div>
      </div>
    </div>
  </section>
  <!-- Contact Us Section -->
  <section style="background: url('assets/img/image-gallery/16.png') no-repeat center center;
         background-size: cover;
         background-attachment: fixed;   /* Parallax effect */
         padding:120px 0;
         position: relative;">

    <div class="contact-section py-5"
      style="background: rgba(255, 255, 255, 0.15);
         backdrop-filter: blur(12px);
         -webkit-backdrop-filter: blur(12px);
         border-radius: 20px;
         border: 1px solid rgba(255, 255, 255, 0.3);
         margin: 40px auto;
         max-width: 1100px;">
      <div class="container">
        <h2 class="text-center mb-5 text-white">Contact Us</h2>
        <div class="row">
          <!-- Contact Info -->
          <div class="col-md-5 mb-4 text-white">
            <h5>Get in Touch</h5>
            <p>If you have any questions, feel free to reach out to us.</p>
            <ul class="list-unstyled">
              <li><i class="fas fa-map-marker-alt text-primary"></i> Lahore, Pakistan</li>
              <li><i class="fas fa-envelope text-primary"></i> support@jobs.tef.com.pk</li>
              <li><i class="fas fa-phone text-primary"></i> +92 300 1234567</li>
            </ul>
          </div>

          <!-- Contact Form -->
          <div class="col-md-7">
            <form action="contact_process.php" method="POST">
              <div class="form-row">
                <div class="form-group col-md-6">
                  <input type="text" class="form-control" name="name" placeholder="Your Name" required>
                </div>
                <div class="form-group col-md-6">
                  <input type="email" class="form-control" name="email" placeholder="Your Email" required>
                </div>
              </div>
              <div class="form-group">
                <input type="text" class="form-control" name="subject" placeholder="Subject" required>
              </div>
              <div class="form-group">
                <textarea class="form-control" name="message" rows="5" placeholder="Your Message" required></textarea>
              </div>
              <button type="submit" class="btn btn-primary btn-block">Send Message</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>



  <!-- Footer -->
  <footer class=" text-center py-3">
    <div class="container">
      <p>&copy; <?php echo date("Y"); ?> jobs.tef.com.pk - All Rights Reserved.</p>
    </div>
  </footer>

  <!-- JS -->
  <script src="assets/js/app.min.js"></script>
  <script src="assets/js/scripts.js"></script>
</body>

</html>