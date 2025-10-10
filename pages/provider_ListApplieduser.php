<?php
include('config.php');


// 🔹 Step 1: Agar status update karna hai
if (isset($_GET['apply_id']) && isset($_GET['status']) && isset($_GET['job_id'])) {
    $applyId = intval($_GET['apply_id']);
    $status  = $_GET['status'];
    $job_id  = intval($_GET['job_id']);

    $sql = "UPDATE job_seeker_appliedjobs SET status = '$status' WHERE id = $applyId";
    if ($conn->query($sql)) {
        $_SESSION['success'] = "Application has been $status successfully.";
    } else {
        $_SESSION['error'] = "Error: " . $conn->error;
    }

    header("Location: layout.php?page=provider_ListApplieduser&job_id=" . $job_id);
    exit;
}

// 🔹 Step 2: Agar candidates list dekhni hai
if (!isset($_GET['job_id'])) {
    die("❌ Invalid Request: Job ID missing.");
}
$job_id = intval($_GET['job_id']);

// Job details
$jobQuery = "SELECT title FROM jobs WHERE id = $job_id";
$jobResult = $conn->query($jobQuery);
$job = $jobResult->fetch_assoc();

// Applicants with JOIN
$applicantsQuery = "
    SELECT 
        a.id as apply_id,
        a.status,
        a.applied_at,
        p.first_name, p.last_name, p.email, p.country, p.gender, 
        p.job_experience, p.career_level, p.functional_area, p.phone
    FROM job_seeker_appliedjobs a
    INNER JOIN job_seeker_profiles p ON a.user_id = p.user_id
    WHERE a.job_id = $job_id
    ORDER BY a.applied_at DESC
";
$applicants = $conn->query($applicantsQuery);

// 🔹 Count status wise
$countShortlisted = $conn->query("SELECT COUNT(*) as c FROM job_seeker_appliedjobs WHERE job_id=$job_id AND status='Shortlisted'")->fetch_assoc()['c'];
$countAccepted    = $conn->query("SELECT COUNT(*) as c FROM job_seeker_appliedjobs WHERE job_id=$job_id AND status='Accepted'")->fetch_assoc()['c'];
$countRejected    = $conn->query("SELECT COUNT(*) as c FROM job_seeker_appliedjobs WHERE job_id=$job_id AND status='Rejected'")->fetch_assoc()['c'];
?>

<!-- Main Content -->
<section class="section">
    <div class="section-body">
        <h3 class="d-flex justify-content-between align-items-center">
            Candidates for: <?= htmlspecialchars($job['title']) ?>
            <a href="layout.php?page=managethePostedJob.php" class="btn btn-secondary btn-sm">
                <i class="fas fa-arrow-left"></i> Back to All Jobs
            </a>
        </h3>

        <div class="table-responsive mt-4">
            <table id="tableExport" class="table table-bordered table-striped">
                <thead class="thead-light">
                    <tr>
                        <th>#</th>
                        <th>Candidate Name</th>
                        <th>Email</th>
                        <th>Country</th>
                        <th>Gender</th>
                        <th>Job experience</th>
                        <th>Career level</th>
                        <th>Functional Area</th>
                        <th>Phone</th>
                        <th>Applied On</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($applicants && $applicants->num_rows > 0): ?>
                        <?php $i = 1; while ($row = $applicants->fetch_assoc()): ?>
                            <tr>
                                <td><?= $i++ ?></td>
                                <td><?= htmlspecialchars($row['first_name'] . ' ' . $row['last_name']) ?></td>
                                <td><?= htmlspecialchars($row['email']) ?></td>
                                <td><?= htmlspecialchars($row['country']) ?></td>
                                <td><?= htmlspecialchars($row['gender']) ?></td>
                                <td><?= htmlspecialchars($row['job_experience']) ?></td>
                                <td><?= htmlspecialchars($row['career_level']) ?></td>
                                <td><?= htmlspecialchars($row['functional_area']) ?></td>
                                <td><?= htmlspecialchars($row['phone']) ?></td>
                                <td><?= date("d M, Y", strtotime($row['applied_at'])) ?></td>
                                <td>
                                    <?php if ($row['status'] == "Accepted"): ?>
                                        <span class="badge badge-success">Accepted</span>
                                    <?php elseif ($row['status'] == "Rejected"): ?>
                                        <span class="badge badge-danger">Rejected</span>
                                    <?php elseif ($row['status'] == "Shortlisted"): ?>
                                        <span class="badge badge-info">Shortlisted</span>
                                    <?php else: ?>
                                        <span class="badge badge-warning">Pending</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <div class="dropdown">
                                        <a href="#" class="text-dark" id="dropdownMenu<?= $row['apply_id'] ?>" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v"></i>
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenu<?= $row['apply_id'] ?>">
                                            <a class="dropdown-item text-info" href="layout.php?page=provider_ListApplieduser&apply_id=<?= $row['apply_id'] ?>&status=Shortlisted&job_id=<?= $job_id ?>">
                                                <i class="fas fa-star"></i> Shortlist
                                            </a>
                                            <a class="dropdown-item text-success" href="layout.php?page=provider_ListApplieduser&apply_id=<?= $row['apply_id'] ?>&status=Accepted&job_id=<?= $job_id ?>">
                                                <i class="fas fa-check"></i> Accept
                                            </a>
                                            <a class="dropdown-item text-danger" href="layout.php?page=provider_ListApplieduser&apply_id=<?= $row['apply_id'] ?>&status=Rejected&job_id=<?= $job_id ?>">
                                                <i class="fas fa-times"></i> Reject
                                            </a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="12" class="text-center">No candidates applied yet.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <!-- 🔹 Status Buttons -->
        <div class="mt-4 text-center">
            <a href="layout.php?page=provider_viewApplicants&job_id=<?= $job_id ?>&status=Shortlisted" class="btn btn-info m-1">
                Shortlisted (<?= $countShortlisted ?>)
            </a>
            <a href="layout.php?page=provider_viewApplicants&job_id=<?= $job_id ?>&status=Accepted" class="btn btn-success m-1">
                Accepted (<?= $countAccepted ?>)
            </a>
            <a href="layout.php?page=provider_viewApplicants&job_id=<?= $job_id ?>&status=Rejected" class="btn btn-danger m-1">
                Rejected (<?= $countRejected ?>)
            </a>
        </div>
    </div>
</section>
