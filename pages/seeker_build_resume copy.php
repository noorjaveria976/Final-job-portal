<?php $pageTitle = "Build Profile "; ?>


<!-- php for cv -->
<?php
// --- safe session start ---
if (session_status() === PHP_SESSION_NONE) session_start();

// include DB connection if not already included
if (!isset($conn)) {
    include 'config.php';
}

// Only handle actions when 'action' is present (so normal page render won't be interrupted)
$action = $_REQUEST['action'] ?? '';

if ($action !== '') {
    // We'll return JSON for API calls
    header('Content-Type: application/json; charset=utf-8');

    // make sure user is logged in
    $user_id = intval($_SESSION['user_id'] ?? 0);
    if ($user_id <= 0) {
        echo json_encode(["success" => false, "message" => "User not logged in"]);
        exit;
    }

    // Helper: run query and handle errors (optional)
    function runQuery($conn, $sql) {
        $res = mysqli_query($conn, $sql);
        if ($res === false) {
            return ["error" => mysqli_error($conn)];
        }
        return ["result" => $res];
    }

    switch ($action) {

        /* ---------------- CV ---------------- */
        case 'cv_save':
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                if (empty($_FILES['cv_file']['name'])) {
                    echo json_encode(["success" => false, "message" => "No file selected."]);
                    exit;
                }

                $cvDir = "uploads/cvs/";
                if (!is_dir($cvDir)) mkdir($cvDir, 0755, true);

                // sanitize filename
                $cvName = time() . "_" . preg_replace('/[^A-Za-z0-9_.-]/','', basename($_FILES['cv_file']['name']));
                $target = $cvDir . $cvName;

                if (!move_uploaded_file($_FILES['cv_file']['tmp_name'], $target)) {
                    echo json_encode(["success" => false, "message" => "Error uploading CV file."]);
                    exit;
                }

                // insert into DB (use $sql variable explicitly)
                $sql = "INSERT INTO cvs (user_id, cv_file, created_at) VALUES ('$user_id',  '$cvName', NOW())";
                $r = runQuery($conn, $sql);
                if (isset($r['error'])) {
                    echo json_encode(["success" => false, "message" => "DB error: " . $r['error']]);
                    exit;
                }

                echo json_encode(["success" => true, "message" => "CV uploaded successfully"]);
                exit;
            }
            break;

        case 'cv_fetch':
            $sql = "SELECT id, title, cv_file, created_at FROM cvs WHERE user_id='$user_id' ORDER BY id DESC";
            $r = runQuery($conn, $sql);
            if (isset($r['error'])) {
                echo json_encode([]);
                exit;
            }
            $res = $r['result'];
            $arr = [];
            while ($row = mysqli_fetch_assoc($res)) {
                $arr[] = $row;
            }
            echo json_encode($arr);
            exit;
            break;

        case 'cv_delete':
            $id = intval($_POST['id'] ?? 0);
            if ($id <= 0) {
                echo "error: invalid id";
                exit;
            }
            $sql = "DELETE FROM cvs WHERE id='$id' AND user_id='$user_id'";
            $r = runQuery($conn, $sql);
            if (isset($r['error'])) {
                echo "error: " . $r['error'];
                exit;
            }
            echo "success";
            exit;
            break;


        /* ---------------- PROJECTS ---------------- */
        case 'project_save':
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $id          = intval($_POST['project_id'] ?? 0);
                $name        = mysqli_real_escape_string($conn, $_POST['name'] ?? '');
                $url         = mysqli_real_escape_string($conn, $_POST['url'] ?? '');
                $date_start  = mysqli_real_escape_string($conn, $_POST['date_start'] ?? '');
                $date_end    = mysqli_real_escape_string($conn, $_POST['date_end'] ?? '');
                $description = mysqli_real_escape_string($conn, $_POST['description'] ?? '');
                $imageName   = '';

                if (!empty($_FILES['image']['name'])) {
                    $dir = "uploads/projects/";
                    if (!is_dir($dir)) mkdir($dir, 0755, true);
                    $imageName = time() . "_" . preg_replace('/[^A-Za-z0-9_.-]/','', basename($_FILES['image']['name']));
                    $target = $dir . $imageName;
                    if (!move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
                        echo json_encode(["success" => false, "message" => "Error uploading project image"]);
                        exit;
                    }
                }

                if ($id > 0) {
                    $sql = "UPDATE projects SET name='$name', url='$url', date_start='$date_start', date_end='$date_end', description='$description'"
                         . ($imageName ? ", image='$imageName'" : "")
                         . " WHERE id='$id' AND user_id='$user_id'";
                    $r = runQuery($conn, $sql);
                    if (isset($r['error'])) {
                        echo json_encode(["success" => false, "message" => "DB error: " . $r['error']]);
                        exit;
                    }
                    echo json_encode(["success" => true, "message" => "Project updated"]);
                    exit;
                } else {
                    $sql = "INSERT INTO projects (user_id,name,url,date_start,date_end,description,image,created_at) 
                            VALUES ('$user_id','$name','$url','$date_start','$date_end','$description','$imageName', NOW())";
                    $r = runQuery($conn, $sql);
                    if (isset($r['error'])) {
                        echo json_encode(["success" => false, "message" => "DB error: " . $r['error']]);
                        exit;
                    }
                    echo json_encode(["success" => true, "message" => "Project added"]);
                    exit;
                }
            }
            break;

        case 'project_fetch':
            $sql = "SELECT id, name, url, date_start, date_end, description, image FROM projects WHERE user_id='$user_id' ORDER BY id DESC";
            $r = runQuery($conn, $sql);
            if (isset($r['error'])) {
                echo json_encode([]);
                exit;
            }
            $res = $r['result'];
            $arr = [];
            while ($row = mysqli_fetch_assoc($res)) {
                // include full image path for convenience
                $row['image'] = !empty($row['image']) ? "uploads/projects/" . $row['image'] : "";
                $arr[] = $row;
            }
            echo json_encode($arr);
            exit;
            break;

        case 'project_delete':
            $id = intval($_POST['id'] ?? 0);
            if ($id <= 0) {
                echo "error: invalid id";
                exit;
            }
            $sql = "DELETE FROM projects WHERE id='$id' AND user_id='$user_id'";
            $r = runQuery($conn, $sql);
            if (isset($r['error'])) {
                echo "error: " . $r['error'];
                exit;
            }
            echo "success";
            exit;
            break;

        default:
            // If an unrecognized action comes, return an explicit message:
            echo json_encode(["success" => false, "message" => "Invalid action"]);
            exit;
    }
}
// if $action empty, execution continues and page HTML will render normally below
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
                    <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#exampleModal">
                        <i class="fas fa-plus"></i>
                    </button>
                </div>
               <?php
if (!isset($_SESSION['user_id'])) {
    die("User not logged in.");
}

$user_id = intval($_SESSION['user_id']);

$sqlCv   = "SELECT * FROM cvs WHERE user_id = '$user_id' ORDER BY created_at DESC";
$cvQuery = mysqli_query($conn, $sqlCv);

if (!$cvQuery) {
    die("SQL Error in CV Section: " . mysqli_error($conn) . " | Query: " . $sqlCv);
}
?>

<div class="card-body">
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
            <?php if ($cvQuery && mysqli_num_rows($cvQuery) > 0): ?>
                <?php while ($row = mysqli_fetch_assoc($cvQuery)): ?>
                    <tr id="cv_<?php echo $row['id']; ?>">
                        <td><?php echo htmlspecialchars($row['title']); ?></td>
                        <td>
                            <?php if ($row['is_default'] == 1): ?>
                                <span class="text text-dark">Default</span>
                            <?php else: ?>
                                <span class="text text-muted">-</span>
                            <?php endif; ?>
                        </td>
                        <td><span class="text text-dark"><?php echo $row['created_at']; ?></span></td>
                        <td>
                            <a href="../uploads/cvs/<?php echo $row['cv_file']; ?>"
                                download="<?php echo $row['title']; ?>"
                                title="<?php echo $row['title']; ?>">
                                <i class="fas fa-download"></i>
                            </a>
                            <a href="javascript:void(0);"
                                onclick="editCv(<?= (int)$row['id']; ?>);"
                                class="text text-dark ms-2">
                                <i class="fas fa-pencil-alt"></i>
                            </a>

                            <a href="layout.php?page=seeker_build_resume&delete=<?php echo $row['id']; ?>"
                                class="text text-danger ms-2"
                                onclick="return confirm('Delete this CV?');">
                                <i class="fas fa-times"></i>
                            </a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="4" class="text-center">No CV Uploaded Yet</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

            </div>
           <!-- Projects -->
<?php
if (!isset($_SESSION['user_id'])) {
    die("User not logged in.");
}

$user_id = intval($_SESSION['user_id']); // current logged-in user ka id

$sql   = "SELECT * FROM projects WHERE user_id = '$user_id' ORDER BY created_at DESC";
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
                    <?php if ($query && mysqli_num_rows($query) > 0): ?>
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
                    <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#experienceModal">
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
                    <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#educationModal">
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
                    <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#skillModal">
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
                    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#languageModal">
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

            <!-- ✅ IMPORTANT: action hidden input -->
            <form action="" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="action" value="cv_save">
                <input type="hidden" name="cv_id" id="cv_id">

                <div class="modal-body">
                    <div class="form-body">
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
                        <button type="submit" class="btn btn-primary w-100 fw-bold fs-6">
                            Save Changes <i class="fas fa-arrow-circle-right"></i>
                        </button>
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
            <!-- ✅ IMPORTANT: action hidden input -->
            <form id="add_edit_profile_project" method="POST" action="" enctype="multipart/form-data">
                <input type="hidden" name="action" value="project_save">
                <input type="hidden" name="project_id" id="project_id">

                <div class="modal-header">
                    <h5 class="modal-title" id="projectModalLabel">Add / Edit Project</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
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
                    <button type="submit" class="btn btn-primary">
                        Save Changes <i class="fa fa-arrow-circle-right"></i>
                    </button>
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

<!-- modal for add education -->

<!-- modal for add skills -->

<!-- modal for add language -->






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
    // CV: upload
    $("#cvForm").submit(function(e) {
        e.preventDefault();
        var fd = new FormData(this);
        $.ajax({
            url: "layout.php?page=seeker_build_resume&action=cv_save",
            type: "POST",
            data: fd,
            contentType: false,
            processData: false,
            success: function(res) {
                let data = typeof res === 'object' ? res : JSON.parse(res);
                alert(data.message);
                fetchCVs();
            },
            error: function(xhr) {
                alert("Request failed: " + xhr.responseText);
            }
        });
    });

    // fetch CVs
    function fetchCVs() {
        $.get("layout.php?page=seeker_build_resume&action=cv_fetch", function(res) {
            var cvs = typeof res === 'object' ? res : JSON.parse(res);
            $("#cvList").empty();
            cvs.forEach(cv => {
                $("#cvList").append(`<li>${cv.cv_file} <button onclick="deleteCV(${cv.id})">Delete</button></li>`);
            });
        });
    }

    function deleteCV(id) {
        $.post("layout.php?page=seeker_build_resume&action=cv_delete", {
            id: id
        }, function(resp) {
            if (resp.trim() === "success") fetchCVs();
            else alert(resp);
        });
    }


    // PROJECTS
    $("#projectForm").submit(function(e) {
        e.preventDefault();
        var fd = new FormData(this);
        $.ajax({
            url: "layout.php?page=seeker_build_resume&action=project_save",
            type: "POST",
            data: fd,
            contentType: false,
            processData: false,
            success: function(res) {
                let data = typeof res === 'object' ? res : JSON.parse(res);
                alert(data.message);
                fetchProjects();
                $("#projectForm")[0].reset();
            },
            error: function(xhr) {
                alert("Request failed: " + xhr.responseText);
            }
        });
    });

    function fetchProjects() {
        $.get("layout.php?page=seeker_build_resume&action=project_fetch", function(res) {
            var projects = typeof res === 'object' ? res : JSON.parse(res);
            $("#projectList").empty();
            projects.forEach(p => {
                $("#projectList").append(
                    `<li>
                    <b>${p.name}</b> (${p.date_start} - ${p.date_end})<br>
                    <a href="${p.url}" target="_blank">${p.url}</a><br>
                    ${p.image ? `<img src="${p.image}" width="100"><br>` : ''}
                    <p>${p.description}</p>
                    <button onclick="deleteProject(${p.id})">Delete</button>
                </li>`
                );
            });
        });
    }

    function deleteProject(id) {
        $.post("layout.php?page=seeker_build_resume&action=project_delete", {
            id: id
        }, function(resp) {
            if (resp.trim() === "success") fetchProjects();
            else alert(resp);
        });
    }

    // on page load
    $(document).ready(function() {
        fetchCVs();
        fetchProjects();
    });
</script>


<!-- AJAX for project -->
<!-- <script>
    // Save Project
    $("#projectForm").submit(function(e) {
        e.preventDefault();
        var formData = new FormData(this);
        $.ajax({
            url: "layout.php?page=seeker_build_resume&action=project_save",
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,
            success: function(res) {
                var data = JSON.parse(res);
                alert(data.message);
                fetchProjects();
                $("#projectForm")[0].reset();
            }
        });
    });

    // Fetch Projects
    function fetchProjects() {
        $.get("layout.php?page=seeker_build_resume&action=project_fetch", function(res) {
            var projects = JSON.parse(res);
            $("#projectList").html("");
            projects.forEach(p => {
                $("#projectList").append(
                    `<li>
                    <b>${p.name}</b> (${p.date_start} - ${p.date_end})<br>
                    <a href="${p.url}" target="_blank">${p.url}</a><br>
                    <img src="uploads/projects/${p.image}" width="100"><br>
                    <p>${p.description}</p>
                    <button onclick="deleteProject(${p.id})">Delete</button>
                </li>`
                );
            });
        });
    }

    // Delete Project
    function deleteProject(id) {
        $.post("layout.php?page=seeker_build_resume&action=project_delete", {
            id: id
        }, function(res) {
            if (res === "success") fetchProjects();
        });
    }


    // Edit project → fill modal
    function editProject(id) {
        $.get('layout.php?page=seeker_build_resume&action=get&id=' + id, function(data) {
            const res = JSON.parse(data);
            if (res.success) {
                const project = res.project;
                $('#project_id').val(project.id);
                $('#name').val(project.name);
                $('#url').val(project.url);
                $('#date_start').val(project.date_start);
                $('#date_end').val(project.date_end);
                $('#description').val(project.description);

                if (project.image) {
                    previewImage.src = project.image;
                    previewImage.style.display = 'block';
                    uploadText.style.display = 'none';
                } else {
                    previewImage.style.display = 'none';
                    uploadText.style.display = 'block';
                }

                $('#projectModal').modal('show');
            } else {
                alert(res.message);
            }
        });
    }

    // Delete project
    function deleteProject(id) {
        if (confirm('Delete this project?')) {
            $.post('layout.php?page=seeker_build_resume&action=delete', {
                id: id
            }, function(resp) {
                if (resp.trim() === "success") {
                    fetchProjects();
                } else {
                    alert(resp);
                }
            });
        }
    }

    // Submit add/edit form
    function submitProjectForm() {
        const formData = new FormData($('#projectForm')[0]);
        $.ajax({
            url: 'layout.php?page=seeker_build_resume&action=project_save',
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                try {
                    let res = JSON.parse(response);
                    if (res.success) {
                        alert(res.message);
                        $("#projectModal").modal("hide");
                        fetchProjects();
                    } else {
                        alert("Error: " + res.message);
                    }
                } catch (e) {
                    console.error("Invalid JSON:", response);
                }
                $('#projectForm')[0].reset();
                previewImage.style.display = 'none';
                uploadText.style.display = 'block';
            }
        });
    }

    // On page load
    $(document).ready(function() {
        fetchProjects();
    });
</script> -->

<!-- AJAX for experience -->
<!-- <script>
    // Fetch Experiences
    function fetchExperiences() {
        $.get('fetch_experiences_sql.php', function(data) {
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
            url: "get_experience_sql.php",
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
            $.post("delete_experience_sql.php", {
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
        $.post('save_experience_sql.php', $(this).serialize(), function(response) {
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
</script> -->
<!-- AJAX for education -->
<!-- <script>
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
                url: "delete_education_sql.php",
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
            url: "fetch_education_sql.php", // ✅ same folder me rakho
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
</script> -->
<!-- AJAX for skill -->
<!-- <script>
    function submitProfileSkillForm() {
        $.ajax({
            url: "skills_insert_sql.php",
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
            url: "skills_fetch_sql.php",
            type: "GET",
            success: function(response) {
                $("#skill_div table tbody").html(response);
            }
        });
    }

    function delete_profile_skill(id) {
        if (confirm("Are you sure you want to delete this skill?")) {
            $.post("skill_delete_sql.php", {
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
        $.post("skill_fetch_sql.php", {
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
</script> -->
<!-- AJAX for language -->
<!-- <script>
    function submitProfileLanguageForm() {
        $.ajax({
            url: "language_insert_sql.php",
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
            url: "language_fetch_sql.php", // ye file DB se record fetch karegi
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
                url: "language_delete_sql.php",
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
</script> -->