<?php $pageTitle = "District List"; ?>

<?php
include('config.php');
$user_id = $_SESSION['user_id'] ?? 0;
if ($user_id == 0) {
  die("User not logged in.");
}


?>

<section class="section">
    <div class="section-body">
        <div class="row">
            <div class="col-md-8">
                <?php


                // Fetch profile data
                $sql = "SELECT * FROM job_seeker_profiles WHERE user_id='$user_id' LIMIT 1";
                $result = mysqli_query($conn, $sql);
                $profile = mysqli_fetch_assoc($result);



                // Profile Image
                $profileImg = !empty($profile['profile_image'])
                    ? "uploads/profile/" . $profile['profile_image']
                    : "uploads/profile/default.png";

                // Cover Image
                $cover_image = !empty($profile['cover_images'])
                    ? "uploads/cover/" . $profile['cover_images']
                    : "uploads/cover/default_cover.png";
                ?>

                <!-- coverphoto -->
                <div class="row usercoverphoto">
                    <div class="col-12 image">
                        <img src="<?php echo $cover_image; ?>" alt="Job Seeker" title="Job Seeker" style="height: 240px; display: block; width: 100%;">

                    </div>
                </div>
                <!-- profile -->
                <div class="profileban border bg-white text-dark">
                    <div class="abtuser" style="padding: 20px; border-radius: 15px; padding-bottom: 0px;">
                        <div class="row d-flex">
                            <div class="col-lg-3 col-md-4">

                                <div class="uavatar">
                                    <!-- <img src="./assets/img/users/user-11.jpg" alt="Job Seeker" title="Job Seeker"> -->
                                    <img src="<?php echo $profileImg; ?>"
                                        style="max-width:100px; max-height:100px; display: block; object-fit: cover; border-radius: 5px;" alt="Profile">
                                </div>
                            </div>
                            <div class="col-lg-9 col-md-8">
                                <div class="title">
                                    <h3><span class="text-dark"><?= $profile['first_name'] ?? '' ?><?= !empty($profile['last_name']) ? ' ' . $profile['last_name'] : '' ?></span> <span style="font-size: 14px;">(Information Technology)</span></h3>
                                    <div class="redyto text-success mb-2">
                                        <span><i class="fas fa-laptop"></i> Ready for Hire</span>
                                    </div>
                                    <div class="desi"><i class="fa fa-map-marker" aria-hidden="true"></i> <strong>
                                            <?= $profile['city'] ?? '' ?><?= !empty($profile['state']) ? ', ' . $profile['state'] : '' ?><?= !empty($profile['country']) ? ', ' . $profile['country'] : '' ?>
                                        </strong></div>

                                    <div class="membersinc"><i class="fa fa-history" aria-hidden="true"></i> Member Since, Sep 19, 2018</div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- download btn -->
                <div class="userlinkstp p-4 bg-light fs-5 fw-bold border" style="border-bottom-left-radius: 10px; border-bottom-right-radius:10px">
                    <a href="" class="btn btn-outline-primary py-2 px-4">
                        <i class="fa fa-download" aria-hidden="true"></i> Download CV
                    </a>
                </div>
                <!-- about -->
                <div class="card card-success mt-4">
                    <div class="card-header">
                        <h4>About Me</h4>
                    </div>
                    <div class="card-body">
                        Hello! I'm Javeria Noor, A Passionate UI/UX Designer and Frontend Developer eager to start my professional journey. With a span background in my field, I bring valuable experience, problem-solving skills, and a commitment to excellence. I’m looking for opportunities where I can make a meaningful impact.
                    </div>

                </div>
                <!-- skills -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h4>Skills</h4>
                    </div>
                    <div class="card-body">
                        <ul class="list-unstyled user-progress list-unstyled-border list-unstyled-noborder">
                            <?php
                           

                            $user_id = isset($_SESSION['user_id']) ? intval($_SESSION['user_id']) : 0;

                            $sql = "SELECT * FROM job_seeker_skills WHERE user_id='$user_id' ORDER BY id DESC";
                            $result = mysqli_query($conn, $sql);

                            if ($result && mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                    $skill_id   = (int)$row['id'];
                                    $skill_name = htmlspecialchars($row['job_skill']);
                                    $experience = htmlspecialchars($row['job_experience']);

                                    // 🔹 Convert experience into percentage (example mapping)
                                    $percentage = 0;
                                    if (stripos($experience, "year") !== false) {
                                        preg_match('/\d+/', $experience, $matches);
                                        $years = isset($matches[0]) ? (int)$matches[0] : 0;
                                        $percentage = min(100, $years * 7); // e.g. 1 year = 7%, 10+ = capped at 100
                                    } elseif (strtolower($experience) === "fresh") {
                                        $percentage = 10;
                                    }

                                    // 🔹 Random color classes for variety
                                    $colors = ["bg-primary", "bg-warning", "bg-success", "bg-info", "bg-danger", "bg-dark"];
                                    $barColor = $colors[array_rand($colors)];
                            ?>

                                    <li class="media" id="skill_<?php echo $skill_id; ?>">
                                        <div class="media-body">
                                            <div class="media-title"><?php echo $skill_name; ?></div>
                                        </div>
                                        <div class="media-progressbar p-t-10">
                                            <div class="progress" data-height="6">
                                                <div class="progress-bar <?php echo $barColor; ?>" data-width="<?php echo $percentage; ?>%"></div>
                                            </div>
                                        </div>
                                        <span class="ms-2 text-muted small"><?php echo $experience; ?></span>

                                    </li>

                            <?php
                                }
                            } else {
                                echo '<li><div class="media-title text-center">No skills added yet.</div></li>';
                            }
                            ?>
                        </ul>
                    </div>

                </div>
                <!-- experience  -->
                <div class="card card-danger p-4 text-dark">
                    <div class="card-header">
                        <h3>Experience </h3>
                    </div>
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

                </div>
                <!-- education  -->
                <div class="card card-warning p-4 text-dark">
                    <div class="card-header">
                        <h3>Education </h3>
                    </div>
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
                                <ul class="educationList list-unstyled
">
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

                </div>
                <!-- portfolio -->
                <div class="userdetailbox profileproject text-dark">
                    <h3>Portfolio</h3>
                    <?php

                    $user_id = $_SESSION['user_id']; // current logged-in user ka id

                    $sql = "SELECT * FROM projects WHERE user_id = '$user_id' ORDER BY created_at DESC";
                    $query = mysqli_query($conn, $sql);

                    if (!$query) {
                        die("SQL Error in Projects Section: " . mysqli_error($conn) . " | Query: " . $sql);
                    }
                    ?>

                    <div class="row mt-4">
                        <?php if (mysqli_num_rows($query) > 0): ?>
                            <?php while ($row = mysqli_fetch_assoc($query)): ?>
                                <div class="col-12 col-md-6 col-lg-3">
                                    <div class="project-card" style="position: relative; overflow: hidden; border-radius: 8px; margin-bottom: 20px;">
                                        <img src="uploads/projects/<?php echo htmlspecialchars($row['image']); ?>"
                                            alt="<?php echo htmlspecialchars($row['name']); ?>"
                                            title="<?php echo htmlspecialchars($row['name']); ?>"
                                            class="img-fluid" style="width: 100%; height: auto; transition: all 0.4s ease;">


                                        <div class="project-overlay">
                                            <h6><?php echo htmlspecialchars($row['name']); ?></h6>
                                            <small>
                                                <?php
                                                $date_start = !empty($row['date_start']) ? date('d M, Y', strtotime($row['date_start'])) : '';
                                                $date_end   = !empty($row['date_end']) ? date('d M, Y', strtotime($row['date_end'])) : '';
                                                echo $date_start . ($date_end ? ' - ' . $date_end : '');
                                                ?>
                                            </small>
                                            <p class="mt-2"><?php echo htmlspecialchars($row['description']); ?></p>
                                            
                                        </div>
                                    </div>
                                </div>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <div class="col-12 text-center">
                                <p>No projects added yet.</p>
                            </div>
                        <?php endif; ?>
                    </div>

                </div>
            </div>
            <div class="col-md-4">
                <!--fetch data from my_profile.php -->
                <?php
                $query = "SELECT * FROM job_seeker_profiles WHERE user_id = '$user_id' LIMIT 1";
                $result = mysqli_query($conn, $query);

                $profile = mysqli_fetch_assoc($result);
                ?>

                <!-- contact info -->
                <div class="card card-danger p-4">
                    <div class="card-header">
                        <h4>Contact Information</h4>
                    </div>
                    <div class="card-body">
                        <div class="jobdetail">

                            <div class="candidateinfo">
                                <?php if (!empty($profile['phone'])): ?>
                                    <div class="loctext mt-3"><i class="fa fa-phone" style="margin-right: 5px; width: 24px; color: #6777ef;"></i> <a href="tel:<?= $profile['phone'] ?>" class="text-decoration-none text-dark"><?= $profile['phone'] ?></a></div>
                                <?php endif; ?>

                                <?php if (!empty($profile['mobile_num'])): ?>
                                    <div class="loctext mt-3"><i class="fa fa-mobile" style="margin-right: 5px; width: 24px; color: #6777ef;"></i> <a href="tel:<?= $profile['mobile_num'] ?>" class="text-decoration-none text-dark"><?= $profile['mobile_num'] ?></a></div>
                                <?php endif; ?>

                                <?php if (!empty($profile['email'])): ?>
                                    <div class="loctext mt-3"><i class="fa fa-envelope" style="margin-right: 5px; width: 24px; color: #6777ef;"></i> <a href="mailto:<?= $profile['email'] ?>" class="text-decoration-none text-dark"><?= $profile['email'] ?></a></div>
                                <?php endif; ?>

                                <?php if (!empty($profile['street_address'])): ?>
                                    <div class="loctext mt-3"><i class="fa fa-map-marker" style="margin-right: 5px; width: 24px; color: #6777ef;"></i> <?= $profile['street_address'] ?></div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- details -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h3>Candidate Details</h3>
                    </div>
                    <div class="card-body p-1" style="margin-left: 30px;">
                        <div class="job-header p-0">
                            <div class="jobdetail">

                                <ul class="jbdetail list-unstyled row">
                                    <li class="col-lg-6 col-md-6 col-6">
                                        <div class="jbitlist">
                                            <i class="fas fa-check-circle fast" style="font-size: 20px;color: #6777ef;"></i>
                                            <div class="jbitdata mb-2">
                                                <span class="d-block">Verified</span>
                                                <strong>Yes</strong>
                                            </div>
                                        </div>
                                    </li>

                                    <li class="col-lg-6 col-md-6 col-6">
                                        <div class="jbitlist mb-2">
                                            <i class="fas fa-handshake fast" style="font-size: 20px;color: #6777ef;"></i>
                                            <div class="jbitdata">
                                                <span class="d-block">Ready for Hire</span>
                                                <strong>Yes</strong>
                                            </div>
                                        </div>
                                    </li>

                                    <?php if (!empty($profile['date_of_birth'])): ?>
                                        <?php
                                        $dob = new DateTime($profile['date_of_birth']);
                                        $today = new DateTime();
                                        $age = $today->diff($dob)->y;
                                        ?>
                                        <li class="col-lg-6 col-md-6 col-6">
                                            <div class="jbitlist mb-2">
                                                <i class="fas fa-birthday-cake fast" style="font-size: 20px;color: #6777ef;"></i>
                                                <div class="jbitdata">
                                                    <span class="d-block">Age</span>
                                                    <strong><?= $age ?> Years</strong>
                                                </div>
                                            </div>
                                        </li>
                                    <?php endif; ?>

                                    <?php if (!empty($profile['gender'])): ?>
                                        <li class="col-lg-6 col-md-6 col-6">
                                            <div class="jbitlist mb-2">
                                                <i class="fas fa-user-circle fast" style="font-size: 20px;color: #6777ef;"></i>
                                                <div class="jbitdata">
                                                    <span class="d-block">Gender</span>
                                                    <strong><?= $profile['gender'] ?></strong>
                                                </div>
                                            </div>
                                        </li>
                                    <?php endif; ?>

                                    <?php if (!empty($profile['marital_status'])): ?>
                                        <li class="col-lg-6 col-md-6 col-6">
                                            <div class="jbitlist mb-2">
                                                <i class="fas fa-book fast" style="font-size: 20px;color: #6777ef;"></i>
                                                <div class="jbitdata">
                                                    <span class="d-block">Marital Status</span>
                                                    <strong><?= $profile['marital_status'] ?></strong>
                                                </div>
                                            </div>
                                        </li>
                                    <?php endif; ?>

                                    <?php if (!empty($profile['job_experience'])): ?>
                                        <li class="col-lg-6 col-md-6 col-6">
                                            <div class="jbitlist mb-2">
                                                <i class="fas fa-briefcase fast" style="font-size: 20px;color: #6777ef;"></i>
                                                <div class="jbitdata">
                                                    <span class="d-block">Experience</span>
                                                    <strong><?= $profile['job_experience'] ?> years</strong>
                                                </div>
                                            </div>
                                        </li>
                                    <?php endif; ?>

                                    <?php if (!empty($profile['career_level'])): ?>
                                        <li class="col-lg-6 col-md-6 col-6">
                                            <div class="jbitlist mb-2">
                                                <i class="fas fa-code-branch fast" style="font-size: 20px;color: #6777ef;"></i>
                                                <div class="jbitdata">
                                                    <span class="d-block">Career Level</span>
                                                    <strong><?= $profile['career_level'] ?></strong>
                                                </div>
                                            </div>
                                        </li>
                                    <?php endif; ?>

                                    <li class="col-lg-6 col-md-6 col-6">
                                        <div class="jbitlist mb-2">
                                            <i class="fas fa-map-marker-alt fast" style="font-size: 20px;color: #6777ef;"></i>
                                            <div class="jbitdata">
                                                <span class="d-block">Location</span>
                                                <strong>
                                                    <?= $profile['city'] ?? '' ?><?= !empty($profile['state']) ? ', ' . $profile['state'] : '' ?><?= !empty($profile['country']) ? ', ' . $profile['country'] : '' ?>
                                                </strong>
                                            </div>
                                        </div>
                                    </li>

                                    <?php if (!empty($profile['current_salary'])): ?>
                                        <li class="col-lg-6 col-md-6 col-6">
                                            <div class="jbitlist mb-2">
                                                <i class="fas fa-donate fast" style="font-size: 20px;color: #6777ef;"></i>
                                                <div class="jbitdata">
                                                    <span class="d-block">Current Salary</span>
                                                    <strong><?= $profile['current_salary'] ?></strong>
                                                </div>
                                            </div>
                                        </li>
                                    <?php endif; ?>

                                    <?php if (!empty($profile['expected_salary'])): ?>
                                        <li class="col-lg-6 col-md-6 col-6">
                                            <div class="jbitlist">
                                                <i class="fas fa-hand-holding-usd fast" style="font-size: 20px;color: #6777ef;"></i>
                                                <div class="jbitdata">
                                                    <span class="d-block">Expected Salary</span>
                                                    <strong><?= $profile['expected_salary'] ?></strong>
                                                </div>
                                            </div>
                                        </li>
                                    <?php endif; ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- language -->
                <div class="card card-success">
                    <div class="card-header">
                        <h4>Language</h4>
                    </div>
                    <div class="card-body">
                        <ul class="list-unstyled user-progress list-unstyled-border list-unstyled-noborder">
                            <?php
                            

                            $user_id = isset($_SESSION['user_id']) ? intval($_SESSION['user_id']) : 0;

                            $sql = "SELECT * FROM job_seeker_languages WHERE user_id='$user_id' ORDER BY id DESC";
                            $result = mysqli_query($conn, $sql);

                            if ($result && mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                    $lang_id   = (int)$row['id'];
                                    $language  = htmlspecialchars($row['language']);
                                    $level     = htmlspecialchars($row['language_level']);

                                    // 🔹 Mapping language level -> percentage
                                    $percentage = 0;
                                    switch (strtolower($level)) {
                                        case "basic":
                                            $percentage = 40;
                                            break;
                                        case "intermediate":
                                            $percentage = 60;
                                            break;
                                        case "fluent":
                                            $percentage = 80;
                                            break;
                                        case "native":
                                        case "expert":
                                            $percentage = 100;
                                            break;
                                        default:
                                            $percentage = 50; // fallback
                                    }

                                    // 🔹 Random/progressive bar colors
                                    $colors = ["bg-primary", "bg-warning", "bg-success", "bg-info", "bg-danger"];
                                    $barColor = $colors[array_rand($colors)];
                            ?>

                                    <li class="media" id="language_<?php echo $lang_id; ?>">
                                        <div class="media-body">
                                            <div class="media-title"><?php echo $language; ?></div>
                                        </div>
                                        <div class="media-progressbar p-t-10">
                                            <div class="progress" data-height="6">
                                                <div class="progress-bar <?php echo $barColor; ?>" data-width="<?php echo $percentage; ?>%"></div>
                                            </div>
                                        </div>
                                        <span class="ms-2 text-muted small"><?php echo $level; ?></span>

                                    </li>

                            <?php
                                }
                            } else {
                                echo '<li><div class="media-title text-center">No languages added yet.</div></li>';
                            }
                            ?>
                        </ul>
                    </div>

                </div>

            </div>
        </div>
    </div>
</section>