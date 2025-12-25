<?php
include('config.php');

// 1. Get candidate ID from URL
if (!isset($_GET['id'])) {
    die("No candidate ID provided.");
}

$user_id = intval($_GET['id']);

// 2. Fetch candidate details from profiles table
$sql = "SELECT * FROM job_seeker_profiles WHERE id = $user_id LIMIT 1";
$result = $conn->query($sql);

if (!$result || $result->num_rows == 0) {
    die("Candidate not found.");
}

$profile = $result->fetch_assoc();
?>


<div class="container mt-5">
    <h2>Candidate Profile</h2>
    <a href="all_applicants.php" class="btn btn-secondary mb-3">← Back to Applicants</a>

    <div class="card">
        <div class="card-body">
            <div class="row">

                <!-- Profile Image -->
                <div class="col-md-3 text-center">
                    <?php if (!empty($profile['profile_image'])): ?>
                        <img src="<?= htmlspecialchars($profile['profile_image']) ?>" alt="Profile Image" class="img-fluid rounded mb-3">
                    <?php else: ?>
                        <img src="default-avatar.png" alt="Profile Image" class="img-fluid rounded mb-3">
                    <?php endif; ?>
                </div>

                <!-- Candidate Info -->
                <div class="col-md-9">
                    <table class="table table-bordered">
                        <tr>
                            <th>Full Name</th>
                            <td><?= htmlspecialchars($profile['first_name'] . ' ' . $profile['middle_name'] . ' ' . $profile['last_name']) ?></td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td><?= htmlspecialchars($profile['email']) ?></td>
                        </tr>
                        <tr>
                            <th>Gender</th>
                            <td><?= htmlspecialchars($profile['gender']) ?></td>
                        </tr>
                        <tr>
                            <th>Date of Birth</th>
                            <td><?= htmlspecialchars($profile['date_of_birth']) ?></td>
                        </tr>
                        <tr>
                            <th>Phone</th>
                            <td><?= htmlspecialchars($profile['phone']) ?></td>
                        </tr>
                        <tr>
                            <th>Mobile</th>
                            <td><?= htmlspecialchars($profile['mobile_num']) ?></td>
                        </tr>
                        <tr>
                            <th>Country</th>
                            <td><?= htmlspecialchars($profile['country']) ?></td>
                        </tr>
                        <tr>
                            <th>City</th>
                            <td><?= htmlspecialchars($profile['city']) ?></td>
                        </tr>
                        <tr>
                            <th>Street Address</th>
                            <td><?= htmlspecialchars($profile['street_address']) ?></td>
                        </tr>
                        <tr>
                            <th>Career Level</th>
                            <td><?= htmlspecialchars($profile['career_level']) ?></td>
                        </tr>
                        <tr>
                            <th>Industry</th>
                            <td><?= htmlspecialchars($profile['industry']) ?></td>
                        </tr>
                        <tr>
                            <th>Functional Area</th>
                            <td><?= htmlspecialchars($profile['functional_area']) ?></td>
                        </tr>
                        <tr>
                            <th>Job Experience</th>
                            <td><?= htmlspecialchars($profile['job_experience']) ?></td>
                        </tr>
                        <tr>
                            <th>Summary</th>
                            <td><?= htmlspecialchars($profile['summary']) ?></td>
                        </tr>
                        <tr>
                            <th>CV</th>
                            <td>
                                <?php if (!empty($profile['cv_file'])): ?>
                                    <a href="<?= htmlspecialchars($profile['cv_file']) ?>" target="_blank" class="btn btn-sm btn-outline-primary">
                                        <i class="fas fa-file-pdf"></i> View CV
                                    </a>
                                <?php else: ?>
                                    <span class="text-muted">No CV uploaded</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <tr>
                            <th>Profile Created At</th>
                            <td><?= htmlspecialchars($profile['created_at']) ?></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap & FontAwesome -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.2/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/js/all.min.js"></script>

