<?php $pageTitle = "Profile "; ?>

<?php

include 'config.php';
$user_id = $_SESSION['user_id'] ?? 0;

?>


  <section class="section">
          <div class="section-body">
            <div class="card">
              <div class="card-header">
                <h4>Print Resume</h4>
              </div>
              <div class="card-body">
                <ul class="nav nav-pills" id="myTab3" role="tablist">
                  <li class="nav-item">
                    <a class="nav-link active" id="home-tab3" data-toggle="tab" href="#home3" role="tab"
                      aria-controls="home" aria-selected="true">Profile 1</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="profile-tab3" data-toggle="tab" href="#profile3" role="tab"
                      aria-controls="profile" aria-selected="false">Profile 2</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="contact-tab3" data-toggle="tab" href="#contact3" role="tab"
                      aria-controls="contact" aria-selected="false">Profile 3</a>
                  </li>
                </ul>
                <div class="tab-content" id="myTabContent2">
                  <div class="tab-pane fade show active" id="home3" role="tabpanel" aria-labelledby="home-tab3">
                    <!-- first temp -->
                    <?php


                    // Fetch profile data
                    $sql = "SELECT * FROM job_seeker_profiles WHERE user_id='$user_id' LIMIT 1";
                    $result = mysqli_query($conn, $sql);
                    $profile = mysqli_fetch_assoc($result);

                    // Calculate Age
                    $age = '';
                    if (!empty($profile['date_of_birth'])) {
                      $dob = $profile['date_of_birth'];
                      $age = date_diff(date_create($dob), date_create('today'))->y . " Years";
                    }

                    // Profile Image
                    $profileImg = !empty($profile['profile_image'])
                      ? "uploads/profile/" . $profile['profile_image']
                      : "uploads/profile/default.png";
                    ?>

                    <div class="col-md-9 col-sm-8">

                      <div id="printableArea">
                        <table width="800" align="center" style="margin:0 auto;">
                          <tbody>
                            <tr>
                              <!-- LEFT PANEL -->
                              <td width="300" bgcolor="#1e5395" style="font-family:Arial, Helvetica, sans-serif; color: #fff;">
                                <table width="270" align="center" style="margin:0 auto;">
                                  <tbody>

                                    <?php if ($profile): ?>
                                      <!-- Profile Image -->
                                      <tr>
                                        <td>
                                          <div class="usercvimg" style=" border: 2px solid #fff; width: 150px; height: 150px; border-radius: 50%; overflow: hidden; margin: 0 auto; margin-top: 20px; background: #fff;">
                                            <img src="<?php echo $profileImg; ?>" alt="Job Seeker" title="Job Seeker" style="width:200px;">
                                          </div>
                                        </td>
                                      </tr>

                                      <!-- Contact Details -->
                                      <tr>
                                        <td>
                                          <h2 style="color:#fff;margin-bottom:5px;font-size:20px;padding:10px 0;border-bottom:1px solid rgba(255,255,255,0.3);">Contact Details</h2>

                                          <div style="color:#fff;font-size:16px;display:block;padding:10px;font-weight:700;">
                                            <i class="fa fa-phone"></i> <?php echo $profile['phone']; ?>
                                          </div>

                                          <div style="color:#fff;font-size:16px;display:block;padding-left:10px;font-weight:700;">
                                            <i class="fas fa-mobile-alt"></i> <?php echo $profile['mobile_num']; ?>
                                          </div>

                                          <div style="color:#fff;font-size:16px;margin-top:10px;padding-left:10px;">
                                            <i class="fas fa-envelope"></i> <?php echo $profile['email']; ?>
                                          </div>

                                          <p style="color:#fff;font-size:14px;margin-top:10px;padding-left:10px;">
                                            <i class="fas fa-globe"></i>
                                            <?php echo $profile['city'] . ", " . $profile['state'] . ", " . $profile['country']; ?>
                                          </p>

                                          <p style="color:#fff;font-size:14px;margin-top:10px;padding-left:10px;padding-bottom:20px;border-bottom:1px solid rgba(255,255,255,0.3);">
                                            <i class="fas fa-map-marker-alt"></i> <?php echo $profile['street_address']; ?>
                                          </p>
                                        </td>
                                      </tr>

                                      <!-- Personal Details -->
                                      <tr>
                                        <td>
                                          <h2 style="color:#fff;margin-bottom:5px;font-size:20px;padding:10px 0;border-bottom:1px solid rgba(255,255,255,0.3);">Personal Details</h2>
                                          <table width="270" align="center" style="font-size:14px;">
                                            <tbody>
                                              <tr>
                                                <td><strong>D.O.B</strong></td>
                                                <td><?php echo $profile['date_of_birth']; ?></td>
                                              </tr>
                                              <tr>
                                                <td><strong>Age</strong></td>
                                                <td><?php echo $age; ?></td>
                                              </tr>
                                              <tr>
                                                <td><strong>Gender</strong></td>
                                                <td><?php echo $profile['gender']; ?></td>
                                              </tr>
                                              <tr>
                                                <td><strong>Marital Status</strong></td>
                                                <td><?php echo $profile['marital_status']; ?></td>
                                              </tr>
                                              <tr>
                                                <td><strong>Functional Area</strong></td>
                                                <td><?php echo $profile['functional_area']; ?></td>
                                              </tr>
                                              <tr>
                                                <td><strong>Industry</strong></td>
                                                <td><?php echo $profile['industry']; ?></td>
                                              </tr>
                                              <tr>
                                                <td><strong>Career Level</strong></td>
                                                <td><?php echo $profile['career_level']; ?></td>
                                              </tr>
                                              <tr>
                                                <td><strong>Current Salary</strong></td>
                                                <td><?php echo $profile['current_salary'] . " " . $profile['salary_currency']; ?></td>
                                              </tr>
                                              <tr>
                                                <td><strong>Expected Salary</strong></td>
                                                <td><?php echo $profile['expected_salary'] . " " . $profile['salary_currency']; ?></td>
                                              </tr>
                                              <tr>
                                                <td><strong>Nationality</strong></td>
                                                <td><?php echo $profile['nationality']; ?></td>
                                              </tr>
                                            </tbody>
                                          </table>
                                        </td>
                                      </tr>

                                      <!-- Skills -->
                                      <tr>
                                        <td>
                                          <h2 style="color:#fff;margin-bottom:5px;font-size:20px;padding:10px 0;border-bottom:1px solid rgba(255,255,255,0.3);">Key Skills</h2>
                                          <ul class="profileskills">
                                            <?php
                                            $skill_sql = "SELECT * FROM job_seeker_skills WHERE user_id='$user_id' ORDER BY id DESC";
                                            $skill_query = mysqli_query($conn, $skill_sql);
                                            if ($skill_query && mysqli_num_rows($skill_query) > 0):
                                              while ($row = mysqli_fetch_assoc($skill_query)): ?>
                                                <li>
                                                  <div class="skillbox">
                                                    <?php echo htmlspecialchars($row['job_skill']); ?>
                                                    <span class="text text-success"><?php echo htmlspecialchars($row['job_experience']); ?></span>
                                                  </div>
                                                </li>
                                              <?php endwhile;
                                            else: ?>
                                              <li>
                                                <div class="skillbox text-center">No skills added yet</div>
                                              </li>
                                            <?php endif; ?>
                                          </ul>
                                        </td>
                                      </tr>
                                      <tr>
                                        <td>
                                          <div style="color: #fff000; font-size: 16px; text-align: center; margin-top: 10px; font-style: italic; font-weight: bold; border-top: 1px solid rgba(255,255,255,0.3); padding-top: 20px;"> Immediate Available For Work </div>
                                        </td>
                                      </tr>
                                      <tr>
                                        <!-- <td height="30">&nbsp;</td> -->
                                      </tr>
                                    <?php else: ?>
                                      <tr>
                                        <td>
                                          <p style="color:red;text-align:center;">No profile data found. Please complete your profile.</p>
                                        </td>
                                      </tr>
                                    <?php endif; ?>

                                  </tbody>
                                </table>
                              </td>
                              <!-- my_profile.php ended -->

                              <!-- RIGHT PANEL -->
                              <td width="500" valign="top" style="font-family:Arial, Helvetica, sans-serif; vertical-align: top;">

                                <table width="500" align="center" style="font-size: 14px; margin:0 auto;">
                                  <tbody>
                                    <tr>
                                      <td bgcolor="#0981c5" style="background:#0981c5;">
                                        <h2 style="color: #fff;margin-bottom: 5px;text-align: center;font-size: 32px; padding:30px 0;">Job Seeker</h2>
                                      </td>
                                    </tr>

                                    <!-- Objective -->
                                    <tr>
                                      <?php
                                      // Fetch profile data
                                      $res = mysqli_query($conn, "SELECT summary FROM job_seeker_profiles WHERE user_id = $user_id LIMIT 1");
                                      if ($res && mysqli_num_rows($res) > 0) {
                                        $row = mysqli_fetch_assoc($res);
                                        $summary = trim($row['summary'] ?? '');
                                      }
                                      ?>
                                      <td style="padding:20px;">
                                        <h2 style="font-size: 22px; color: #000; border-bottom: 2px solid #000;">Objective</h2>
                                        <p style="font-size: 16px; color: #555;">
                                          <?php echo !empty($profile['summary']) ? htmlspecialchars($profile['summary']) : "No objective added yet."; ?>
                                        </p>
                                      </td>
                                    </tr>

                                    <!-- Experience -->
                                    <tr>
                                      <td style="padding-left:20px; padding-right:15px;">
                                        <h2 style="font-size: 22px; color: #000; border-bottom: 2px solid #000; margin-top: 0;">
                                          <span style="display:inline-block; color:#44546c; padding:10px 0">Experience</span>
                                        </h2>
                                        <!-- experience -->
                                        <div class="" id="experience_div">
                                          <ul class="experienceList">
                                            <li><span class="exdot"></span>
                                              <div class="card-body">
                                                <?php
                                                $user_id = $_SESSION['user_id'];

                                                $sql = "
                                                    SELECT id, title, company, country, state, city, date_start, date_end, is_currently_working, description
                                                    FROM job_seeker_experiences
                                                    WHERE user_id = '$user_id'
                                                    ORDER BY id DESC
                                                ";

                                                $query = mysqli_query($conn, $sql);

                                                if (!$query) {
                                                  die("SQL Error: " . mysqli_error($conn));
                                                }

                                                if (mysqli_num_rows($query) > 0) {
                                                  while ($row = mysqli_fetch_assoc($query)) {
                                                    $exp_id = $row['id'];
                                                    $title = htmlspecialchars($row['title']);
                                                    $company = htmlspecialchars($row['company']);
                                                    $city = htmlspecialchars($row['city']);   // abhi id hi aayegi
                                                    $country = htmlspecialchars($row['country']); // abhi id hi aayegi
                                                    $date_start = !empty($row['date_start']) ? date('d M, Y', strtotime($row['date_start'])) : '';
                                                    $date_end = ($row['is_currently_working'] == 1) ? 'Currently working' : (!empty($row['date_end']) ? date('d M, Y', strtotime($row['date_end'])) : '');
                                                    $description = nl2br(htmlspecialchars($row['description']));
                                                ?>

                                                    <div class="expbox" id="experience_<?php echo $exp_id; ?>">
                                                      <div class="d-flex">
                                                        <h4><?php echo $title; ?></h4>

                                                      </div>

                                                      <div class="excity mb-2"><i class="fas fa-map-marker-alt me-2"></i> <?php echo "$city - $country"; ?></div>
                                                      <div class="expcomp fw-bold mb-2"><i class="fas fa-building me-2"></i> <?php echo $company; ?></div>
                                                      <div class="expcomp fw-bold mb-2"><i class="fas fa-calendar-alt me-2"></i> From <?php echo $date_start; ?> - <?php echo $date_end; ?></div>
                                                      <p><?php echo $description; ?></p>
                                                    </div>

                                                <?php
                                                  }
                                                } else {
                                                  echo '<div class="text-center">No Experience Added Yet</div>';
                                                }
                                                ?>
                                              </div>
                                            </li>
                                          </ul>
                                        </div>
                                      </td>
                                    </tr>

                                    <!-- Education -->
                                    <tr>
                                      <td style="padding-left:20px; padding-right:15px;">
                                        <h2 style="font-size: 22px; color: #000; border-bottom: 2px solid #000; margin-top: 0;">
                                          <span style="display:inline-block; color:#44546c; padding:10px 0">Education</span>
                                        </h2>
                                        <!-- education -->
                                        <div class="" id="education_div">
                                          <ul class="educationList">
                                            <li><span class="exdot"></span>
                                              <div class="card-body">
                                                <?php
                                                $user_id = $_SESSION['user_id'];

                                                $sql = "SELECT id, user_id, degree_level_id, degree_type_id, degree_title, major_subjects, country_id, state_id, city_id, institution, date_completion, degree_result, result_type_id, created_at 
                                                FROM job_seeker_education 
                                                WHERE user_id = '$user_id' 
                                                ORDER BY id DESC";

                                                $query = mysqli_query($conn, $sql);

                                                // Debug agar query fail ho
                                                if (!$query) {
                                                  die("SQL Error in Education Section: " . mysqli_error($conn) . " | Query: " . $sql);
                                                }
                                                ?>

                                                <div id="education_div">
                                                  <?php if (mysqli_num_rows($query) > 0): ?>
                                                    <ul class="educationList">
                                                      <?php while ($row = mysqli_fetch_assoc($query)): ?>
                                                        <li>
                                                          <span class="exdot"></span>
                                                          <div class="expbox" id="education_<?php echo $row['id']; ?>">
                                                            <div class="d-flex">
                                                              <h4>
                                                                <?php echo htmlspecialchars($row['degree_level_id']); ?> -
                                                                <?php echo htmlspecialchars($row['degree_title']); ?>
                                                              </h4>

                                                            </div>
                                                            <div class="date"><?php echo $row['date_completion']; ?> - <?php echo $row['city_id']; ?> - <?php echo $row['country_id']; ?></div>
                                                            <div class="expcomp"><i class="fas fa-graduation-cap"></i> <?php echo $row['degree_type_id']; ?></div>
                                                            <div class="expcomp"><i class="fas fa-map-marker-alt"></i> <?php echo $row['city_id']; ?> - <?php echo $row['country_id']; ?></div>
                                                            <div class="expcomp"><i class="fas fa-school"></i> <?php echo $row['institution']; ?></div>
                                                          </div>
                                                        </li>
                                                      <?php endwhile; ?>
                                                    </ul>
                                                  <?php else: ?>
                                                    <div class="text-center text-muted">No Education Added Yet</div>
                                                  <?php endif; ?>
                                                </div>
                                              </div>
                                            </li>
                                          </ul>
                                        </div>
                                      </td>
                                    </tr>

                                    <tr>
                                      <td height="20">&nbsp;</td>
                                    </tr>
                                    <!-- language -->
                                    <tr>
                                      <td style="padding-left:20px; padding-right:15px;">
                                        <h2 style="font-size: 22px; color: #000; border-bottom: 2px solid #000; margin-top: 0;">
                                          <span style="display:inline-block; color:#44546c; padding:10px 0">Languages</span>
                                        </h2>
                                        <div id="language_div">
                                          <div class="profilelang d-flex flex-wrap mt-3">
                                            <?php


                                            $user_id = isset($_SESSION['user_id']) ? intval($_SESSION['user_id']) : 0;

                                            $sql = "SELECT * FROM job_seeker_languages WHERE user_id = '$user_id' ORDER BY id DESC";
                                            $result = mysqli_query($conn, $sql);

                                            if ($result && mysqli_num_rows($result) > 0) {
                                              while ($row = mysqli_fetch_assoc($result)) {
                                                $lang_id = (int)$row['id'];
                                                $language = htmlspecialchars($row['language']);
                                                $level = htmlspecialchars($row['language_level']);
                                            ?>

                                                <div class="langbox bg-light p-2 me-4 border rounded" id="language_<?php echo $lang_id; ?>">
                                                  <h5><?php echo $language; ?></h5>
                                                  <p><?php echo $level; ?></p>

                                                </div>

                                            <?php
                                              }
                                            } else {
                                              echo '<p class="text-center">No languages added yet.</p>';
                                            }
                                            ?>
                                          </div>
                                        </div>

                                      </td>
                                    </tr>
                                    <tr>
                                      <td></td>
                                    </tr>

                                  </tbody>
                                </table>
                              </td>
                            </tr>
                          </tbody>
                        </table>
                      </div>

                      <div class="text-center mt-5 mb-5">
                        <div class="downloadbtn">
                          <button type="button" onclick="downloadPDF()" class="btn btn-primary">
                            <i class="fas fa-download"></i> Download CV
                          </button>
                        </div>
                      </div>

                    </div>


                    <!-- first temp end -->

                  </div>
                  <div class="tab-pane fade" id="profile3" role="tabpanel" aria-labelledby="profile-tab3">
                    <!-- second temp -->
                    <div class="row mt-sm-4">
                      <div class="col-12 col-md-12 col-lg-4">
                        <div class="card author-box">
                          <div class="card-body">
                            <div class="author-box-center">
                              <img alt="image" src="assets/img/users/user-1.png" class="rounded-circle author-box-picture">
                              <div class="clearfix"></div>
                              <div class="author-box-name">
                                <a href="#">Sarah Smith</a>
                              </div>
                              <div class="author-box-job">Web Developer</div>
                            </div>
                            <div class="text-center">
                              <div class="author-box-description">
                                <p>
                                  Lorem ipsum dolor sit amet, consectetur adipisicing elit. Pariatur voluptatum alias molestias
                                  minus quod dignissimos.
                                </p>
                              </div>
                              <div class="mb-2 mt-3">
                                <div class="text-small font-weight-bold">Follow Hasan On</div>
                              </div>
                              <a href="#" class="btn btn-social-icon mr-1 btn-facebook">
                                <i class="fab fa-facebook-f"></i>
                              </a>
                              <a href="#" class="btn btn-social-icon mr-1 btn-twitter">
                                <i class="fab fa-twitter"></i>
                              </a>
                              <a href="#" class="btn btn-social-icon mr-1 btn-github">
                                <i class="fab fa-github"></i>
                              </a>
                              <a href="#" class="btn btn-social-icon mr-1 btn-instagram">
                                <i class="fab fa-instagram"></i>
                              </a>
                              <div class="w-100 d-sm-none"></div>
                            </div>
                          </div>
                        </div>
                        <div class="card">
                          <div class="card-header">
                            <h4>Personal Details</h4>
                          </div>
                          <div class="card-body">
                            <div class="py-4">
                              <p class="clearfix">
                                <span class="float-left">
                                  Birthday
                                </span>
                                <span class="float-right text-muted">
                                  30-05-1998
                                </span>
                              </p>
                              <p class="clearfix">
                                <span class="float-left">
                                  Phone
                                </span>
                                <span class="float-right text-muted">
                                  (0123)123456789
                                </span>
                              </p>
                              <p class="clearfix">
                                <span class="float-left">
                                  Mail
                                </span>
                                <span class="float-right text-muted">
                                  test@example.com
                                </span>
                              </p>
                              <p class="clearfix">
                                <span class="float-left">
                                  Facebook
                                </span>
                                <span class="float-right text-muted">
                                  <a href="#">John Deo</a>
                                </span>
                              </p>
                              <p class="clearfix">
                                <span class="float-left">
                                  Twitter
                                </span>
                                <span class="float-right text-muted">
                                  <a href="#">@johndeo</a>
                                </span>
                              </p>
                            </div>
                          </div>
                        </div>
                        <div class="card">
                          <div class="card-header">
                            <h4>Skills</h4>
                          </div>
                          <div class="card-body">
                            <ul class="list-unstyled user-progress list-unstyled-border list-unstyled-noborder">
                              <li class="media">
                                <div class="media-body">
                                  <div class="media-title">Java</div>
                                </div>
                                <div class="media-progressbar p-t-10">
                                  <div class="progress" data-height="6">
                                    <div class="progress-bar bg-primary" data-width="70%"></div>
                                  </div>
                                </div>
                              </li>
                              <li class="media">
                                <div class="media-body">
                                  <div class="media-title">Web Design</div>
                                </div>
                                <div class="media-progressbar p-t-10">
                                  <div class="progress" data-height="6">
                                    <div class="progress-bar bg-warning" data-width="80%"></div>
                                  </div>
                                </div>
                              </li>
                              <li class="media">
                                <div class="media-body">
                                  <div class="media-title">Photoshop</div>
                                </div>
                                <div class="media-progressbar p-t-10">
                                  <div class="progress" data-height="6">
                                    <div class="progress-bar bg-green" data-width="48%"></div>
                                  </div>
                                </div>
                              </li>
                            </ul>
                          </div>
                        </div>
                      </div>
                      <div class="col-12 col-md-12 col-lg-8">
                        <div class="card">
                          <div class="padding-20">
                            <ul class="nav nav-tabs" id="myTab2" role="tablist">
                              <li class="nav-item">
                                <a class="nav-link active" id="home-tab2" data-toggle="tab" href="#about" role="tab"
                                  aria-selected="true">About</a>
                              </li>
                              <li class="nav-item">
                                <a class="nav-link" id="profile-tab2" data-toggle="tab" href="#settings" role="tab"
                                  aria-selected="false">Setting</a>
                              </li>
                            </ul>
                            <div class="tab-content tab-bordered" id="myTab3Content">
                              <div class="tab-pane fade show active" id="about" role="tabpanel" aria-labelledby="home-tab2">
                                <div class="row">
                                  <div class="col-md-3 col-6 b-r">
                                    <strong>Full Name</strong>
                                    <br>
                                    <p class="text-muted">Emily Smith</p>
                                  </div>
                                  <div class="col-md-3 col-6 b-r">
                                    <strong>Mobile</strong>
                                    <br>
                                    <p class="text-muted">(123) 456 7890</p>
                                  </div>
                                  <div class="col-md-3 col-6 b-r">
                                    <strong>Email</strong>
                                    <br>
                                    <p class="text-muted">johndeo@example.com</p>
                                  </div>
                                  <div class="col-md-3 col-6">
                                    <strong>Location</strong>
                                    <br>
                                    <p class="text-muted">India</p>
                                  </div>
                                </div>
                                <p class="m-t-30">Completed my graduation in Arts from the well known and
                                  renowned institution
                                  of India – SARDAR PATEL ARTS COLLEGE, BARODA in 2000-01, which was
                                  affiliated
                                  to M.S. University. I ranker in University exams from the same
                                  university
                                  from 1996-01.</p>
                                <p>Worked as Professor and Head of the department at Sarda Collage, Rajkot,
                                  Gujarat
                                  from 2003-2015 </p>
                                <p>Lorem Ipsum is simply dummy text of the printing and typesetting
                                  industry. Lorem
                                  Ipsum has been the industry's standard dummy text ever since the 1500s,
                                  when
                                  an unknown printer took a galley of type and scrambled it to make a
                                  type
                                  specimen book. It has survived not only five centuries, but also the
                                  leap
                                  into electronic typesetting, remaining essentially unchanged.</p>
                                <div class="section-title">Education</div>
                                <ul>
                                  <li>B.A.,Gujarat University, Ahmedabad,India.</li>
                                  <li>M.A.,Gujarat University, Ahmedabad, India.</li>
                                  <li>P.H.D., Shaurashtra University, Rajkot</li>
                                </ul>
                                <div class="section-title">Experience</div>
                                <ul>
                                  <li>One year experience as Jr. Professor from April-2009 to march-2010
                                    at B.
                                    J. Arts College, Ahmedabad.</li>
                                  <li>Three year experience as Jr. Professor at V.S. Arts &amp; Commerse
                                    Collage
                                    from April - 2008 to April - 2011.</li>
                                  <li>Lorem Ipsum is simply dummy text of the printing and typesetting
                                    industry.
                                  </li>
                                  <li>Lorem Ipsum is simply dummy text of the printing and typesetting
                                    industry.
                                  </li>
                                  <li>Lorem Ipsum is simply dummy text of the printing and typesetting
                                    industry.
                                  </li>
                                  <li>Lorem Ipsum is simply dummy text of the printing and typesetting
                                    industry.
                                  </li>
                                </ul>
                              </div>
                              <div class="tab-pane fade" id="settings" role="tabpanel" aria-labelledby="profile-tab2">
                                <form method="post" class="needs-validation">
                                  <div class="card-header">
                                    <h4>Edit Profile</h4>
                                  </div>
                                  <div class="card-body">
                                    <div class="row">
                                      <div class="form-group col-md-6 col-12">
                                        <label>First Name</label>
                                        <input type="text" class="form-control" value="John">
                                        <div class="invalid-feedback">
                                          Please fill in the first name
                                        </div>
                                      </div>
                                      <div class="form-group col-md-6 col-12">
                                        <label>Last Name</label>
                                        <input type="text" class="form-control" value="Deo">
                                        <div class="invalid-feedback">
                                          Please fill in the last name
                                        </div>
                                      </div>
                                    </div>
                                    <div class="row">
                                      <div class="form-group col-md-7 col-12">
                                        <label>Email</label>
                                        <input type="email" class="form-control" value="test@example.com">
                                        <div class="invalid-feedback">
                                          Please fill in the email
                                        </div>
                                      </div>
                                      <div class="form-group col-md-5 col-12">
                                        <label>Phone</label>
                                        <input type="tel" class="form-control" value="">
                                      </div>
                                    </div>
                                    <div class="row">
                                      <div class="form-group col-12">
                                        <label>Bio</label>
                                        <textarea
                                          class="form-control summernote-simple">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Pariatur voluptatum alias molestias minus quod dignissimos.</textarea>
                                      </div>
                                    </div>
                                    <div class="row">
                                      <div class="form-group mb-0 col-12">
                                        <div class="custom-control custom-checkbox">
                                          <input type="checkbox" name="remember" class="custom-control-input" id="newsletter">
                                          <label class="custom-control-label" for="newsletter">Subscribe to newsletter</label>
                                          <div class="text-muted form-text">
                                            You will get new information about products, offers and promotions
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="card-footer text-right">
                                    <button class="btn btn-primary">Save Changes</button>
                                  </div>
                                </form>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- second temp end -->
                  </div>
                  <div class="tab-pane fade" id="contact3" role="tabpanel" aria-labelledby="contact-tab3">
                    Vestibulum imperdiet odio sed neque ultricies, ut dapibus mi maximus. Proin ligula massa,
                    gravida in lacinia efficitur, hendrerit eget mauris. Pellentesque fermentum, sem interdum
                    molestie finibus, nulla diam varius leo, nec varius lectus elit id dolor.
                  </div>
                </div>
              </div>
            </div>

          </div>
        </section>