<?php $pageTitle = "Build Profile "; ?>


<!-- php for cv -->
<?php
// --- safe session start ---
if (session_status() === PHP_SESSION_NONE) session_start();

// include DB connection if not already included
if (!isset($conn)) {
    include 'config.php';
}

?>






<section class="section">
    <div class="section-body">
        <!-- add content here -->
        <div class="formpanel">
            <h3>Build Your Resume</h3>
            <!-- Personal Information -->
            <!-- cv -->
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4>Attached CV</h4>
                    <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#exampleModal"><i class="fas fa-plus"></i>
                    </button>
                </div>
                <div class="card-body">

                    <?php


                    // User ka ID session se le lo (example)
                    $user_id = $_SESSION['user_id'];

                    // Query to fetch CVs
                    $query = mysqli_query($conn, "SELECT * FROM cvs WHERE user_id = '$user_id' ORDER BY created_at DESC");
                    ?>

                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th><strong>CV Title</strong></th>
                                <th><strong>Default CV</strong></th>
                                <th><strong>Date</strong></th>
                                <th><strong>Action</strong></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (mysqli_num_rows($query) > 0) {
                                while ($row = mysqli_fetch_assoc($query)) {
                                    $cv_id = $row['id'];
                                    $cv_title = $row['title'];
                                    $cv_file = $row['cv_file'];
                                    $is_default = $row['is_default'];
                                    $created_at = $row['created_at'];
                            ?>
                                    <tr id="cv_<?php echo $cv_id; ?>">
                                        <td><?php echo htmlspecialchars($cv_title); ?></td>
                                        <td>
                                            <?php if ($is_default == 1) { ?>
                                                <span class="text text-dark">Default</span>
                                            <?php } else { ?>
                                                <span class="text text-muted">-</span>
                                            <?php } ?>
                                        </td>
                                        <td><span class="text text-dark"><?php echo $created_at; ?></span></td>
                                        <td>
                                            <a href="uploads/cvs/<?php echo $cv_file; ?>" download="<?php echo $cv_title; ?>" title="<?php echo $cv_title; ?>">
                                                <i class="fas fa-download"></i>
                                            </a>
                                            <a href="javascript:;" onclick="console.log('CV ID:', <?php echo $cv_id; ?>); editCv(<?php echo $cv_id; ?>);" class="text text-dark ms-2">
                                                <i class="fas fa-pencil-alt"></i>
                                            </a>




                                            <a href="sql/delete_cv.php?id=<?php echo $row['id']; ?>"
                                                class="text text-danger ms-2"
                                                onclick="return confirm('Delete this CV?');">
                                                <i class="fas fa-times"></i>
                                            </a>

                                        </td>
                                    </tr>
                            <?php
                                }
                            } else {
                                echo '<tr><td colspan="4" class="text-center">No CV Uploaded Yet</td></tr>';
                            }
                            ?>
                        </tbody>
                    </table>


                </div>
            </div>
            <!-- Projects -->
            <?php

            $user_id = $_SESSION['user_id']; // current logged-in user ka id

            $sql = "SELECT * FROM projects WHERE user_id = '$user_id' ORDER BY created_at DESC";
            $query = mysqli_query($conn, $sql);

            if (!$query) {
                die("SQL Error in Projects Section: " . mysqli_error($conn) . " | Query: " . $sql);
            }
            ?>
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 onclick="showProjects();">Projects</h4>
                    <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#projectModal">
                        <i class="fas fa-plus"></i>
                    </button>
                </div>

                <div class="card-body">
                    <div id="projects_div">
                        <table class="table">
                            <tbody class="d-flex flex-wrap">
                                <?php if (mysqli_num_rows($query) > 0): ?>
                                    <?php while ($row = mysqli_fetch_assoc($query)): ?>
                                        <tr class="d-flex flex-column border rounded p-2 m-2" style="width:220px;">
                                            <td class="mb-2 text-center">
                                                <img src="uploads/projects/<?php echo htmlspecialchars($row['image']); ?>"
                                                    alt="<?php echo htmlspecialchars($row['name']); ?>"
                                                    title="<?php echo htmlspecialchars($row['name']); ?>"
                                                    class="img-fluid">

                                            </td>
                                            <td>
                                                <strong><?php echo htmlspecialchars($row['name']); ?></strong><br>
                                                <small>
                                                    <?php
                                                    $date_start = !empty($row['date_start']) ? date('d M, Y', strtotime($row['date_start'])) : '';
                                                    $date_end   = !empty($row['date_end']) ? date('d M, Y', strtotime($row['date_end'])) : '';
                                                    echo $date_start . ($date_end ? ' - ' . $date_end : '');
                                                    ?>
                                                </small><br>
                                                <?php echo htmlspecialchars($row['description']); ?>
                                            </td>
                                            <td class="pt-5">
                                                <a class="text-info" href="javascript:void(0);" onclick="showProfileProjectEditModal(<?php echo $row['id']; ?>);">Edit</a> |
                                                <a class="text-danger" href="javascript:void(0);" onclick="delete_profile_project(<?php echo $row['id']; ?>);">Delete</a>
                                            </td>
                                        </tr>
                                    <?php endwhile; ?>
                                <?php else: ?>
                                    <tr>
                                        <td class="text-center">No projects added yet.</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- experience -->
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4>Experience</h4>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#experienceModal">
                        <i class="fas fa-plus"></i>
                    </button>
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
                                    <div class="cvnewbxedit ms-auto">
                                        <a href="javascript:void(0);" onclick="editExperience(<?php echo $exp_id; ?>);" class="text text-dark">
                                            <i class="fas fa-pencil-alt"></i>
                                        </a>

                                        <a href="javascript:void(0);" onclick="delete_profile_experience(<?php echo $exp_id; ?>);" class="text text-danger ms-2">
                                            <i class="fas fa-times"></i>
                                        </a>
                                    </div>
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


            <!-- education -->
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 onclick="showEducation();">Education</h4>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#educationModal">
                        <i class="fas fa-plus"></i>
                    </button>
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
                                                <div class="cvnewbxedit ms-auto">
                                                    <a href="javascript:void(0);" onclick="edit_profile_education(<?php echo $row['id']; ?>);" class="text text-dark">
                                                        <i class="fas fa-pencil-alt"></i>
                                                    </a>

                                                    <a href="javascript:void(0);" onclick="delete_profile_education(<?php echo $row['id']; ?>);" class="text text-danger ms-2">
                                                        <i class="fas fa-times"></i>
                                                    </a>
                                                </div>
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


            <!-- skills....... -->
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4>Skills</h4>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#skillModal">
                        <i class="fas fa-plus"></i>
                    </button>
                </div>
                <div class="card-body">
                    <div id="skill_div">
                        <div class="col-md-12">
                            <table class="table table-striped">
                                <tbody>
                                    <?php

                                    $user_id = $_SESSION['user_id'];

                                    $sql = "SELECT * FROM job_seeker_skills WHERE user_id='$user_id' ORDER BY id DESC";
                                    $result = mysqli_query($conn, $sql);

                                    if (mysqli_num_rows($result) > 0) {
                                        while ($row = mysqli_fetch_assoc($result)) {
                                    ?>
                                            <tr id="skill_<?php echo $row['id']; ?>">
                                                <td><strong class="text"><?php echo htmlspecialchars($row['job_skill']); ?></strong></td>
                                                <td><span class="text"><?php echo htmlspecialchars($row['job_experience']); ?></span></td>
                                                <td align="right">
                                                    <a href="javascript:void(0);" onclick="showProfileSkillEditModal(<?php echo $row['id']; ?>);" class="text text-dark">
                                                        <i class="fas fa-pencil-alt"></i>
                                                    </a>
                                                    <a href="javascript:void(0);" onclick="delete_profile_skill(<?php echo $row['id']; ?>);" class="text text-danger ms-2">
                                                        <i class="fas fa-times"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                    <?php
                                        }
                                    } else {
                                        echo '<tr><td colspan="3" class="text-center">No skills added yet.</td></tr>';
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>



            <!-- languages -->
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4>Languages</h4>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#languageModal">
                        <i class="fas fa-plus"></i>
                    </button>
                </div>

                <div class="card-body">
                    <div id="language_div">
                        <div class="col-md-12">
                            <table class="table table-striped">
                                <tbody>
                                    <?php
                                    // Ensure session is started and config included once in your page
                                    if (session_status() === PHP_SESSION_NONE) {
                                        session_start();
                                    }
                                    include 'config.php'; // adjust path if needed

                                    $user_id = isset($_SESSION['user_id']) ? intval($_SESSION['user_id']) : 0;

                                    $sql = "SELECT * FROM job_seeker_languages WHERE user_id = '$user_id' ORDER BY id DESC";
                                    $result = mysqli_query($conn, $sql);

                                    if ($result && mysqli_num_rows($result) > 0) {
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            $lang_id = (int)$row['id'];
                                            $language = htmlspecialchars($row['language']);
                                            $level = htmlspecialchars($row['language_level']);
                                    ?>
                                            <tr id="language_<?php echo $lang_id; ?>">
                                                <td><strong><?php echo $language; ?></strong></td>
                                                <td><span><?php echo $level; ?></span></td>
                                                <td align="right">
                                                    <a href="javascript:void(0);" onclick="showProfileLanguageEditModal(<?php echo $lang_id; ?>);" class="text text-dark">
                                                        <i class="fas fa-pencil-alt"></i>
                                                    </a>
                                                    <a href="javascript:void(0);" onclick="delete_profile_language(<?php echo $lang_id; ?>);" class="text text-danger ms-2">
                                                        <i class="fas fa-times"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                    <?php
                                        }
                                    } else {
                                        echo '<tr><td colspan="3" class="text-center">No languages added yet.</td></tr>';
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>


<!-- modal for add cv -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="formModal"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title" id="formModal">Add CV</h1>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="sql/save_cv.php" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-body">
                        <input type="hidden" name="cv_id" id="cv_id">


                        <div class="formrow pb-3" id="div_title">
                            <input class="form-control" id="title" placeholder="CV title" name="title" type="text" required>
                        </div>

                        <div class="formrow pb-3" id="div_cv_file">
                            <input name="cv_file" id="cv_file" type="file" required>
                        </div>

                        <div class="formrow" id="div_is_default">
                            <label for="is_default" class="bold">Is default?</label>
                            <div class="radio-list">
                                <label class="radio-inline">
                                    <input id="default" name="is_default" type="radio" value="1"> Yes
                                </label>
                                <label class="radio-inline">
                                    <input id="not_default" name="is_default" type="radio" value="0" checked> No
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary w-100 fw-bold fs-6">Save Changes <i class="fas fa-arrow-circle-right"></i></button>
                    </div>
                </div>
            </form>

        </div>
    </div>
</div>




<!-- Project Modal -->
<div class="modal fade" id="projectModal" tabindex="-1" aria-labelledby="projectModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form class="form" id="add_edit_profile_project" method="POST" action="sql/save_project.php" enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="modal-title" id="projectModalLabel">Add / Edit Project</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <input type="hidden" name="project_id" id="project_id">


                    <!-- Project Name -->
                    <div class="formrow pb-3">
                        <input class="form-control p-3" id="name" placeholder="Project Name" name="name" type="text" required>
                    </div>

                    <!-- Project Image -->
                    <div class="formrow pb-3">
                        <div class="uploadphotobx border border-dashed p-3 text-center rounded cursor-pointer" id="uploadBox">
                            <i class="fa fa-upload fa-2x mb-2"></i>
                            <div id="uploadText">Click here to upload Project Image</div>
                            <img id="previewImage" src="" alt="Preview" style="display:none; max-width:100%; margin-top:10px; border-radius:10px;" />
                        </div>
                        <input type="file" name="image" id="imageInput" style="display:none;" accept="image/*">
                    </div>

                    <!-- Project URL -->
                    <div class="formrow pb-3">
                        <input class="form-control p-3" id="url" placeholder="Project URL" name="url" type="text">
                    </div>

                    <!-- Start Date -->
                    <div class="formrow pb-3">
                        <input class="form-control p-3 datepicker" id="date_start" placeholder="Project Start Date" name="date_start" type="date">
                    </div>

                    <!-- End Date -->
                    <div class="formrow pb-3">
                        <input class="form-control p-3 datepicker" id="date_end" placeholder="Project End Date" name="date_end" type="date">
                    </div>

                    <!-- Ongoing Project -->
                    <div class="formrow pb-3">
                        <label class="bold">Is Currently Ongoing?</label>
                        <div class="radio-list">
                            <label class="me-3"><input type="radio" name="is_on_going" value="1"> Yes</label>
                            <label><input type="radio" name="is_on_going" value="0" checked> No</label>
                        </div>
                    </div>

                    <!-- Description -->
                    <div class="formrow pb-3">
                        <textarea name="description" class="form-control" id="description" placeholder="Project description"></textarea>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save Changes <i class="fa fa-arrow-circle-right"></i></button>
                </div>
            </form>
        </div>
    </div>
</div>



<!-- JS for Image Upload Preview -->
<script>
    const uploadBox = document.getElementById('uploadBox');
    const imageInput = document.getElementById('imageInput');
    const previewImage = document.getElementById('previewImage');
    const uploadText = document.getElementById('uploadText');

    uploadBox.addEventListener('click', () => {
        imageInput.click();
    });

    imageInput.addEventListener('change', (event) => {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = (e) => {
                previewImage.src = e.target.result;
                previewImage.style.display = 'block';
                uploadText.style.display = 'none';
            };
            reader.readAsDataURL(file);
        }
    });
</script>



<!-- modal for add experience -->
<div class="modal fade" id="experienceModal" tabindex="-1" role="dialog" aria-labelledby="formModal2"
    aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add Experience</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="form" id="experienceForm" method="POST" action="sql/save_experience_sql.php">
                <!-- <input type="hidden" name="_token" value="6yWsZRaRmexsWsKMZhvrp1XB4w6hgjC2GUPscb02" autocomplete="off"> -->

                <div class="modal-body">
                    <div class="form-body">
                        <input type="hidden" name="experience_id" id="experience_id">

                        <div class="formrow" id="div_title">
                            <input class="form-control" id="title" placeholder="Experience Title" name="title" type="text" value="">
                            <span class="help-block title-error"></span>
                        </div>

                        <div class="formrow" id="div_company">
                            <input class="form-control" id="company" placeholder="Company" name="company" type="text" value="">
                            <span class="help-block company-error"></span>
                        </div>

                        <div class="formrow" id="div_country_id">
                            <select class="form-control" id="country_id" name="country">
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
                                <option value="Bahamas The">Bahamas The</option>
                                <option value="Bahrain">Bahrain</option>
                                <option value="Bangladesh">Bangladesh</option>
                            </select>
                            <span class="help-block country_id-error"></span>
                        </div>

                        <div class="formrow" id="div_state_id">
                            <span id="default_state_experience_dd"><select id="state_id" class="form-control" name="state">
                                    <option value="">Select State</option>
                                    <option value="Alabama">Alabama</option>
                                    <option value="Alaska">Alaska</option>
                                    <option value="Florida">Florida</option>
                                    <option value="Georgia">Georgia</option>
                                    <option value="Hawaii">Hawaii</option>
                                    <option value="Idaho">Idaho</option>
                                    <option value="Illinois">Illinois</option>
                                    <option value="Indiana">Indiana</option>
                                    <option value="Iowa">Iowa</option>
                                    <option value="Kansas">Kansas</option>
                                    <option value="Kentucky">Kentucky</option>
                                    <option value="Louisiana">Louisiana</option>
                                </select></span>
                            <span class="help-block state_id-error"></span>
                        </div>

                        <div class="formrow" id="div_city_id">
                            <span id="default_city_experience_dd">
                                <select class="form-control" id="city_id" name="city">
                                    <option value="" selected="selected">Select City</option>
                                    <option value="Arizona">Arizona</option>
                                    <option value="Arkansas">Arkansas</option>
                                    <option value="Byram">Byram</option>
                                    <option value="California">California</option>
                                    <option value="Cokato">Cokato</option>
                                    <option value="Colorado">Colorado</option>
                                </select>
                            </span>
                            <span class="help-block city_id-error"></span>
                        </div>

                        <div class="formrow" id="div_date_start">
                            <input class="form-control" autocomplete="off" id="date_start" placeholder="Experience Start Date" name="date_start" type="date" value="">
                            <span class="help-block date_start-error"></span>
                        </div>

                        <div class="formrow" id="div_is_currently_working">
                            <label for="is_currently_working" class="bold">Currently Working?</label>
                            <div class="radio-list">
                                <label class="radio-inline"><input id="currently_working" name="is_currently_working" type="radio" value="1"> Yes </label>
                                <label class="radio-inline"><input id="not_currently_working" name="is_currently_working" type="radio" value="0" checked="&quot;checked&quot;"> No </label>
                            </div>
                            <span class="help-block is_currently_working-error"></span>
                        </div>


                        <div class="formrow" id="div_date_end">
                            <!-- <input type="date" class="form-control"> -->
                            <input class="form-control" autocomplete="off" id="date_end" placeholder="Experience End Date" name="date_end" type="date" value="">
                            <span class="help-block date_end-error"></span>
                        </div>




                        <div class="formrow" id="div_description">
                            <textarea name="description" class="form-control" id="description" placeholder="Experience description"></textarea>
                            <span class="help-block description-error"></span>
                        </div>
                    </div>
                </div>




                <script>
                    $('input[name="is_currently_working"]').on('change', function() {
                        var isWorking = $(this).val();
                        if (isWorking == "1") {
                            $('#div_date_end').hide();
                        } else {
                            $('#div_date_end').show();
                        }
                    });

                    // Call on load
                    var isWorkingInit = $('input[name="is_currently_working"]:checked').val();
                    if (isWorkingInit == "1") {
                        $('#div_date_end').hide();
                    } else {
                        $('#div_date_end').show();
                    }
                </script>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-large btn-primary">
                        Save Changes <i class="fa fa-arrow-circle-right" aria-hidden="true"></i>
                    </button>

                </div>
            </form>
        </div>
    </div>
</div>
<!-- modal for add education -->
<div class="modal fade" id="educationModal" tabindex="-1" role="dialog" aria-labelledby="formModal3"
    aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <form class="form" id="add_edit_profile_education" method="POST" action="sql/education_insert_sql.php">


                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Add Education</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-body">
                        <input type="hidden" name="id" id="edu_id">

                        <div class="formrow" id="div_degree_level_id">
                            <select class="form-control" id="degree_level_id" name="degree_level_id">
                                <option value="" selected="selected">Select Degree Level</option>
                                <option value="Non-Matriculation">Non-Matriculation</option>
                                <option value="Matriculation/O-Level">Matriculation/O-Level</option>
                                <option value="Intermediate/A-Level">Intermediate/A-Level</option>
                                <option value="Bachelors">Bachelors</option>

                            </select>
                            <span class="help-block degree_level_id-error"></span>
                        </div>


                        <div class="formrow" id="div_degree_type_id">
                            <span id="degree_types_dd">
                                <select class="form-control" id="degree_type_id" name="degree_type_id">
                                    <option value="" selected="selected">Select Degree Type</option>
                                    <option value="Science">Science</option>
                                    <option value="Arts">Arts</option>
                                    <option value="Computer">Computer</option>
                                </select>
                            </span>
                            <span class="help-block degree_type_id-error"></span>
                        </div>

                        <div class="formrow" id="div_degree_title">
                            <input class="form-control" id="degree_title" placeholder="Degree Title" name="degree_title" type="text" value="">
                            <span class="help-block degree_title-error"></span>
                        </div>

                        <!-- <div class="formrow" id="div_major_subjects">
                                <select class="form-control select2-multiple select2-hidden-accessible" id="major_subjects" multiple="" name="major_subjects[]" tabindex="-1" aria-hidden="true">
                                    <option value="Abnormal Psychology">Abnormal Psychology</option>
                                    <option value="Accounting">Accounting</option>
                                    <option value="Accounting &amp; Finance">Accounting &amp; Finance</option>
                                    <option value="Acting and Performance">Acting and Performance</option>
                                    <option value="Addressing problems of learning through technology and pedagogy">Addressing problems of learning through technology and pedagogy</option>
                                    <option value="Administrative Law and Accountability">Administrative Law and Accountability</option>

                                </select>
                                <span class="select2 select2-container select2-container--default" dir="ltr" style="width: 766.667px;"></span><span class="selection"></span><span class="select2-selection select2-selection--multiple" role="combobox" aria-autocomplete="list" aria-haspopup="true" aria-expanded="false" tabindex="0">
                                    <ul class="select2-selection__rendered list-style-none">
                                        <li class="select2-search select2-search--inline"><input class="select2-search__field" type="search" tabindex="-1" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false" role="textbox" placeholder="Select Major Subjects" style="width: 765.333px;"></li>
                                    </ul>
                                </span>
                                </span><span class="dropdown-wrapper" aria-hidden="true"></span>
                                <span class="help-block major_subjects-error"></span>
                            </div> -->

                        <div class="formrow" id="div_country_id">
                            <select class="form-control" id="education_country_id" name="country_id">
                                <option value="">Select Country</option>
                                <option value="Afghanistan">Afghanistan</option>
                                <option value="Albania">Albania</option>
                                <option value="Algeria">Algeria</option>
                                <option value="American Samoa">American Samoa</option>
                                <option value="Andorra">Andorra</option>

                            </select>
                            <span class="help-block country_id-error"></span>
                        </div>

                        <div class="formrow" id="div_state_id">
                            <span id="default_state_education_dd">
                                <select id="education_state_id" class="form-control" name="state_id">
                                    <option value="">Select State</option>
                                    <option value="Alabama">Alabama</option>
                                    <option value="Alaska">Alaska</option>
                                    <option value="Arizona">Arizona</option>
                                    <option value="Arkansas">Arkansas</option>

                                </select></span>
                            <span class="help-block state_id-error"></span>
                        </div>

                        <div class="formrow" id="div_city_id">
                            <span id="default_city_education_dd">
                                <select class="form-control" id="city_id" name="city_id">
                                    <option value="" selected="selected">Select City</option>
                                    <option value="Lodhran">Lodhran</option>
                                    <option value="BWP">BWP</option>
                                    <option value="Multan">Multan</option>
                                    <option value="Lahore">Lahore</option>
                                </select>
                            </span>
                            <span class="help-block city_id-error"></span>
                        </div>

                        <div class="formrow" id="div_institution">
                            <input class="form-control" id="institution" placeholder="Institution" name="institution" type="text" value="">
                            <span class="help-block institution-error"></span>
                        </div>


                        <div class="formrow" id="div_date_completion">
                            <select class="form-control" id="date_completion" name="date_completion">
                                <option value="" selected="selected">Select Year</option>
                                <option value="2025">2025</option>
                                <option value="2024">2024</option>
                                <option value="2023">2023</option>
                                <option value="2022">2022</option>

                            </select>
                            <span class="help-block date_completion-error"></span>
                        </div>


                        <div class="formrow" id="div_degree_result">
                            <input class="form-control" id="degree_result" placeholder="Degree Result" name="degree_result" type="text" value="">
                            <span class="help-block degree_result-error"></span>
                        </div>



                        <div class="formrow" id="div_result_type_id">
                            <select class="form-control" id="result_type_id" name="result_type_id">
                                <option value="" selected="selected">Select Result Type</option>
                                <option value="GPA">GPA</option>
                                <option value="Grade">Grade</option>
                                <option value="Percentage">Percentage</option>
                            </select>
                            <span class="help-block result_type_id-error"></span>
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-large btn-primary">
                        Save Changes <i class="fa fa-arrow-circle-right" aria-hidden="true"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- modal for add skills -->
<div class="modal fade" id="skillModal" tabindex="-1" role="dialog" aria-labelledby="formModal4"
    aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <form class="form" id="add_edit_profile_skill" method="POST" action="sql/skills_insert_sql.php"><input type="hidden" name="_token" value="rtLt9mvNx5J5gDNmrhcdV1ZSVZoZegEtQK253C5E" autocomplete="off">
                <div class="modal-header">
                    <h4 class="modal-title">Add Skill</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-body">
                        <input type="hidden" id="skill_id" name="skill_id">

                        <div class="formrow mb-3" id="div_job_skill_id">
                            <select class="form-control" id="job_skill" name="job_skill">
                                <option value="" selected="selected">Select skill</option>
                                <option value="Active listening">Active listening</option>
                                <option value="Adaptability skills">Adaptability skills</option>
                                <option value="Adobe Illustrator">Adobe Illustrator</option>
                                <option value="Adobe Photoshop">Adobe Photoshop</option>
                                <option value="Agile decision-making">Agile decision-making</option>
                                <option value="Agility">Agility</option>

                            </select> <span class="help-block job_skill_id-error"></span>
                        </div>
                        <div class="formrow" id="div_job_experience_id">
                            <select class="form-control" id="job_experience" name="job_experience">
                                <option value="" selected="selected">Select experience</option>
                                <option value="Fresh">Fresh</option>
                                <option value="Less Than 1 Year">Less Than 1 Year</option>
                                <option value="1 Year">1 Year</option>
                                <option value="2 years">2 years</option>
                                <option value="3 years">3 years</option>
                                <option value="4 years">4 years</option>
                                <option value="5 years">5 years</option>
                                <option value="6 years">6 years</option>

                            </select> <span class="help-block job_experience_id-error"></span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary w-100 fs-6 fw-bold" onclick="submitProfileSkillForm();">Save Changes <i class="fa fa-arrow-circle-right" aria-hidden="true"></i></button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
</div>
<!-- modal for add language -->
<div class="modal fade" id="languageModal" tabindex="-1" role="dialog" aria-labelledby="formModal4"
    aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <form class="form" id="add_edit_profile_language" method="POST">


                <div class="modal-header">
                    <h4 class="modal-title">Add Language</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-body">
                        <input type="hidden" id="lang_id" name="lang_id">

                        <div class="formrow mb-3" id="div_language_id">
                            <select class="form-control" id="language" name="language">
                                <option value="" selected="selected">Select language</option>
                                <option value="Abkhazian">Abkhazian</option>
                                <option value="Afar">Afar</option>
                                <option value="English">English</option>
                                <option value="Urdu">Urdu</option>
                                <option value="Punjabi">Punjabi</option>
                                <option value="Saraiki">Saraiki</option>
                                <option value="Albanian">Albanian</option>

                            </select> <span class="help-block language_id-error"></span>
                        </div>
                        <div class="formrow" id="div_language_level_id">
                            <select class="form-control" id="language_level" name="language_level">
                                <option value="" selected="selected">Select Language Level</option>
                                <option value="Intermediate">Intermediate</option>
                                <option value="Beginner">Beginner</option>
                                <option value="Expert">Expert</option>
                            </select> <span class="help-block language_level_id-error"></span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary w-100 fs-6 fw-bold" onclick="submitProfileLanguageForm();">
                        Save Changes <i class="fa fa-arrow-circle-right" aria-hidden="true"></i>
                    </button>


                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
</div>






<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<!-- General JS Scripts -->
<script src="assets/js/app.min.js"></script>
<!-- Template JS File -->
<script src="assets/js/scripts.js"></script>
<!-- Custom JS File -->
<script src="assets/js/custom.js"></script>

<!-- edit script for cv -->
<script>
    function editCv(cvId) {
        console.log("CV ID:", cvId);
        $.ajax({
            url: "sql/get_cv.php",
            type: "GET",
            data: {
                id: cvId
            },
            success: function(response) {
                const data = JSON.parse(response);
                if (data.success) {
                    $('#title').val(data.cv.title);
                    $('#cv_id').val(data.cv.id);
                    $('input[name="is_default"][value="' + data.cv.is_default + '"]').prop('checked', true);
                    $('#exampleModal').modal('show');
                } else {
                    alert('CV not found!');
                }
            }
        });
    }
</script>
<!-- AJAX for project -->
<script>
    // Fetch all projects and display
    function fetchProjects() {
        $.get('sql/fetch_projects.php', function(data) {
            const projects = JSON.parse(data);
            let html = '';

            if (projects.length === 0) {
                // Yahan flex hatana hoga warna center nahi hoga
                $('#projects_div table tbody')
                    .removeClass('d-flex flex-wrap')
                    .html(`
                    <tr>
                        <td colspan="3" class="text-center py-3">
                            No projects added yet.
                        </td>
                    </tr>
                `);
            } else {
                // Agar projects mil gaye to flex wapas lagao
                $('#projects_div table tbody')
                    .addClass('d-flex flex-wrap');

                projects.forEach(proj => {
                    html += `
                <tr class="d-flex flex-column border rounded p-2 m-2" style="width:220px;">
                    <td class="mb-2 text-center">
                        <img src="uploads/projects/${proj.image || 'default.png'}" style="max-width:120px;">
                    </td>
                    <td>
                        <strong>${proj.name}</strong><br>
                        <small>${proj.date_start} - ${proj.date_end}</small><br>
                        ${proj.description}
                    </td>
                    <td class="pt-3 text-center">
                        <a href="javascript:void(0);" onclick="editProject(${proj.id})">Edit</a> |
                        <a href="javascript:void(0);" class="text-danger" onclick="deleteProject(${proj.id})">Delete</a>
                    </td>
                </tr>`;
                });

                $('#projects_div table tbody').html(html);
            }
        });
    }



    // Edit project → fill modal
    function editProject(id) {
        $.get('sql/fetch_projects.php', function(data) {
            const projects = JSON.parse(data);
            const project = projects.find(p => p.id == id);
            if (project) {
                $('#project_id').val(project.id);
                $('#name').val(project.name);
                $('#url').val(project.url);
                $('#date_start').val(project.date_start);
                $('#date_end').val(project.date_end);
                $('#description').val(project.description);

                if (project.image) {
                    previewImage.src = 'uploads/projects/' + project.image;
                    previewImage.style.display = 'block';
                    uploadText.style.display = 'none';
                } else {
                    previewImage.style.display = 'none';
                    uploadText.style.display = 'block';
                }

                $('#projectModal').modal('show');
            } else {
                alert('Project not found!');
            }
        });
    }

    // Delete project
    function deleteProject(id) {
        if (confirm('Delete this project?')) {
            $.post('sql/delete_project.php', {
                id: id
            }, function(resp) {
                fetchProjects();
            });
        }
    }

    // Submit add/edit form
    function submitProjectForm() {
        const formData = new FormData($('#projectForm')[0]);
        $.ajax({
            url: 'sql/save_project.php',
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                let res = JSON.parse(response);
                if (res.success) {
                    // ✅ Alert ab sirf yahan chalega
                    alert(res.message);
                    $("#projectModal").modal("hide");
                    fetchProjects(); // list refresh karega
                } else {
                    alert("Error: " + res.message);
                }
                $('#projectModal').modal('hide');
                $('#projectForm')[0].reset();
                previewImage.style.display = 'none';
                uploadText.style.display = 'block';
                fetchProjects();
            }
        });
    }

    // On page load
    $(document).ready(function() {
        fetchProjects();
    });
</script>

<!-- AJAX for experience -->
<script>
    // Fetch Experiences
    function fetchExperiences() {
        $.get('sql/fetch_experiences_sql.php', function(data) {
            let experiences = [];

            try {
                experiences = JSON.parse(data);
            } catch (e) {
                console.error("JSON parse error:", e, data);
                return;
            }

            let html = '';

            if (Array.isArray(experiences) && experiences.length > 0) {
                experiences.forEach(exp => {
                    const endDate = (exp.is_currently_working == 1) ?
                        "Currently working" :
                        (exp.date_end && exp.date_end !== "0000-00-00" ? exp.date_end : "N/A");

                    html += `
                    <div class="experience-item mb-3 p-3 border rounded">
                        <h5 class="mb-2">${exp.title || ''}</h5>
                        <p class="mb-2"><strong>${exp.company || ''}</strong></p>
                        <p class="mb-1">${exp.country || ''}, ${exp.state || ''}, ${exp.city || ''}</p>
                        <p class="mb-1">From ${exp.date_start || 'N/A'} - ${endDate}</p>
                        <p class="mb-0">${exp.description || ''}</p>
                    </div>
                `;
                });
            } else {
                html = "<p>No experiences found.</p>";
            }

            $('#experienceList').html(html);
        });
    }
    // Edit experience
    function editExperience(expId) {
        console.log("Experience ID:", expId);
        $.ajax({
            url: "sql/get_experience_sql.php",
            type: "GET",
            data: {
                id: expId
            },
            dataType: "json", // 👈 ye line important
            success: function(data) {
                if (data.success) {
                    console.log("Experience fetched:", data.experience);
                    $('#experience_id').val(data.experience.id);
                    $('#title').val(data.experience.title);
                    $('#company').val(data.experience.company);

                    // Ye text fields hain jo tum DB me save kar rahe ho
                    $('#country_id').val(data.experience.country);
                    $('#state_id').val(data.experience.state);
                    $('#city_id').val(data.experience.city);

                    $('#date_start').val(data.experience.date_start);
                    $('#date_end').val(data.experience.date_end);
                    $('input[name="is_currently_working"][value="' + data.experience.is_currently_working + '"]').prop('checked', true);
                    $('#description').val(data.experience.description);


                    if (data.experience.is_currently_working == 1) {
                        $('#div_date_end').hide();
                    } else {
                        $('#div_date_end').show();
                    }

                    const modalEl = document.getElementById('experienceModal');
                    const modal = new bootstrap.Modal(modalEl);
                    modal.show();
                } else {
                    alert('Experience not found!');
                }
            },
            error: function(xhr, status, error) {
                console.error("AJAX Error:", error, xhr.responseText);
            }
        });

    }
    // Delete experience
    function delete_profile_experience(id) {
        if (confirm("Are you sure you want to delete this experience?")) {
            $.post("sql/delete_experience_sql.php", {
                id: id
            }, function(response) {
                let res = JSON.parse(response);
                if (res.success) {
                    alert(res.message);
                    location.reload();
                } else {
                    alert("Delete failed: " + res.message);
                }
            });
        }
    }
    // Submit Experience Form (Add/Edit)
    $('#experienceForm').on('submit', function(e) {
        e.preventDefault();

        // Country, State, City selected text nikaalna
        const countryText = $('#country_id option:selected').text();
        const stateText = $('#state_id option:selected').text();
        const cityText = $('#city_id option:selected').text();

        // Agar user ne blank select kiya hai to empty string save hoga
        $('<input>').attr({
            type: 'hidden',
            name: 'country',
            value: countryText
        }).appendTo('#experienceForm');
        $('<input>').attr({
            type: 'hidden',
            name: 'state',
            value: stateText
        }).appendTo('#experienceForm');
        $('<input>').attr({
            type: 'hidden',
            name: 'city',
            value: cityText
        }).appendTo('#experienceForm');

        // AJAX Save
        $.post('sql/save_experience_sql.php', $(this).serialize(), function(response) {
            try {
                const res = JSON.parse(response);
                if (res.success) {
                    alert("Experience Saved Successfully!");

                    // Refresh list
                    fetchExperiences();

                    // Reset form
                    $('#experienceForm')[0].reset();

                    // Close modal if used
                    let modalEl = document.getElementById('experienceModal');
                    if (modalEl) {
                        let modal = bootstrap.Modal.getInstance(modalEl);
                        if (!modal) modal = new bootstrap.Modal(modalEl);
                        modal.hide();
                    }
                } else {
                    alert("Error: " + res.message);
                }
            } catch (err) {
                console.error("Invalid JSON Response:", response);
            }
        });
    });

    // On page load
    $(document).ready(function() {
        fetchExperiences();
    });
</script>

<!-- AJAX for education -->
<script>
    document.getElementById("add_edit_profile_education").addEventListener("submit", function(e) {
        // Degree Level
        let degreeLevel = document.getElementById("degree_level_id");
        degreeLevel.value = degreeLevel.options[degreeLevel.selectedIndex].text;

        // Degree Type
        let degreeType = document.getElementById("degree_type_id");
        degreeType.value = degreeType.options[degreeType.selectedIndex].text;

        // Country
        let country = document.getElementById("education_country_id");
        country.value = country.options[country.selectedIndex].text;

        // State
        let state = document.getElementById("education_state_id");
        state.value = state.options[state.selectedIndex].text;

        // City
        let city = document.getElementById("city_id");
        city.value = city.options[city.selectedIndex].text;

        // Result Type
        let resultType = document.getElementById("result_type_id");
        resultType.value = resultType.options[resultType.selectedIndex].text;
    });
    // Delete education
    function delete_profile_education(id) {
        if (confirm("Are you sure you want to delete this education?")) {
            $.ajax({
                url: "sql/delete_education_sql.php",
                type: "POST",
                data: {
                    id: id
                },
                dataType: "json",
                success: function(response) {
                    if (response.success) {
                        alert(response.message); // ✅ show alert
                        location.reload(); // ✅ reload
                    } else {
                        alert("Delete failed: " + response.message);
                    }
                },
                error: function() {
                    alert("An error occurred while deleting education.");
                }
            });
        }
    }

    // Edit education
    function edit_profile_education(id) {
        $.ajax({
            url: "sql/fetch_education_sql.php", // ✅ same folder me rakho
            type: "POST",
            data: {
                id: id
            },
            success: function(response) {
                let data = JSON.parse(response);

                if (data.success) {
                    // form fill
                    $("#edu_id").val(data.education.id);
                    $("#degree_level_id").val(data.education.degree_level_id);
                    $("#degree_type_id").val(data.education.degree_type_id);
                    $("#degree_title").val(data.education.degree_title);
                    $("#institution").val(data.education.institution);
                    $("#education_country_id").val(data.education.country_id);
                    $("#education_state_id").val(data.education.state_id);
                    // City select fix
                    $("#city_id option").each(function() {
                        if ($.trim($(this).val().toLowerCase()) === $.trim(data.education.city_id.toLowerCase())) {
                            $(this).prop("selected", true);
                        }
                    });

                    $("#date_completion").val(data.education.date_completion);
                    $("#degree_result").val(data.education.degree_result);
                    $("#result_type_id").val(data.education.result_type_id);

                    $(".modal-title").text("Edit Education");
                    $("#educationModal").modal("show"); // ✅ modal open hoga
                } else {
                    alert("Record not found");
                }
            },
            error: function() {
                alert("Error fetching data.");
            }
        });
    }


    function add_new_education() {
        $("#add_edit_profile_education")[0].reset();
        $("#edu_id").val(""); // clear hidden id
        $(".modal-title").text("Add Education");
        $("#educationModal").modal("show");
    }
</script>

<!-- AJAX for skill -->
<script>
    function submitProfileSkillForm() {
        $.ajax({
            url: "sql/skills_insert_sql.php",
            type: "POST",
            data: $("#add_edit_profile_skill").serialize(),
            success: function(response) {
                if (response.success) {
                    alert(response.message); // ✅ Show alert
                    location.reload(); // ✅ Auto reload page
                } else {
                    alert("Error: " + response.message);
                }
            }
        });
    }


    function showSkills() {
        $.ajax({
            url: "sql/skills_fetch_sql.php",
            type: "GET",
            success: function(response) {
                $("#skill_div table tbody").html(response);
            }
        });
    }

    function delete_profile_skill(id) {
        if (confirm("Are you sure you want to delete this skill?")) {
            $.post("sql/skill_delete_sql.php", {
                id: id
            }, function(response) {
                let res = JSON.parse(response);
                if (res.success) {
                    alert(res.message);
                    location.reload(); // refresh to update table
                } else {
                    alert("Delete failed: " + res.message);
                }
            });
        }
    }

    function showProfileSkillEditModal(id) {
        $.post("sql/skill_fetch_sql.php", {
            id: id
        }, function(response) {
            let res = JSON.parse(response);
            if (res.success) {
                // fill modal with skill data
                $("#skill_id").val(res.data.id);
                $("#job_skill").val(res.data.job_skill);
                $("#job_experience").val(res.data.job_experience);

                $(".modal-title").text("Edit Skill");
                $("#skillModal").modal("show");
            } else {
                alert("Failed to fetch skill details!");
            }
        });
    }
</script>

<!-- AJAX for language -->
<script>
    function submitProfileLanguageForm() {
        $.ajax({
            url: "sql/language_insert_sql.php",
            type: "POST",
            data: $("#add_edit_profile_language").serialize(),
            success: function(response) {
                if (response.success) {
                    alert(response.message);
                    location.reload(); // 🔄 auto refresh after success
                } else {
                    alert("Error: " + response.message);
                }
            }
        });
    }


    // 🟢 Edit (Open Modal + Fetch Existing Data)
    function showProfileLanguageEditModal(id) {
        $.ajax({
            url: "sql/language_fetch_sql.php", // ye file DB se record fetch karegi
            type: "POST",
            data: {
                id: id
            },
            success: function(response) {
                let data = JSON.parse(response);
                if (data.success) {
                    // Fill modal fields
                    $("#lang_id").val(data.language.id);
                    $("#language").val(data.language.language);
                    $("#language_level").val(data.language.language_level);

                    // Change modal title
                    $(".modal-title").text("Edit Language");

                    // Show modal
                    $("#languageModal").modal("show");
                } else {
                    alert("Error: " + data.message);
                }
            }
        });
    }


    // 🟢 Delete Language
    function delete_profile_language(lang_id) {
        if (confirm("Are you sure you want to delete this language?")) {
            $.ajax({
                url: "sql/language_delete_sql.php",
                type: "POST",
                data: {
                    language_id: lang_id
                },
                success: function(response) {
                    if (response.success) {
                        alert(response.message); // ✅ show alert
                        location.reload(); // ✅ auto reload
                    } else {
                        alert("Error: " + response.message);
                    }
                }
            });
        }
    }
</script>