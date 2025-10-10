<?php $pageTitle = "Edit Account "; ?>

<?php
include('config.php');



// Fetch Active Jobs
$activeJobsQuery = "SELECT * FROM jobs WHERE status='Active' ORDER BY created_at DESC";
$activeJobs = $conn->query($activeJobsQuery);

// Fetch Expired / Inactive / Rejected Jobs
$expiredJobsQuery = "SELECT * FROM jobs WHERE status!='Active' ORDER BY created_at DESC";
$expiredJobs = $conn->query($expiredJobsQuery);

if (isset($_POST['delete_job']) && isset($_POST['id'])) {
    $jobId = intval($_POST['id']);

    $deleteQuery = "DELETE FROM jobs WHERE id = $jobId";
    if ($conn->query($deleteQuery)) {
        echo "success";
    } else {
        echo "error: " . $conn->error;
    }
    exit; // AJAX ke liye sirf result bhejna hai
}

?>

<section class="section">
    <div class="section-body">
        <h3>Manage Jobs</h3>

        <!-- Tabs start -->
        <ul class="nav nav-tabs mt-4" id="jobTabs">
            <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#active-jobs">Active Jobs</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#expired-jobs">Expired Jobs</a>
            </li>
        </ul>
        <!-- Tabs end -->

        <div class="tab-content ">

            <!-- Active Jobs -->
            <div class="tab-pane fade show active" id="active-jobs">
                <ul class="featuredlist row">
                    <?php if ($activeJobs && $activeJobs->num_rows > 0): ?>
                        <?php while ($job = $activeJobs->fetch_assoc()): ?>
                            <?php
                            // Candidate count fetch
                            $jobId = $job['id'];
                            $countQuery = "SELECT COUNT(*) as total FROM job_seeker_appliedjobs WHERE job_id = $jobId";
                            $countResult = $conn->query($countQuery);
                            $totalCandidates = 0;
                            if ($countResult) {
                                $countRow = $countResult->fetch_assoc();
                                $totalCandidates = $countRow['total'];
                            }
                            ?>
                            <li class="col-lg-6 col-md-6">
                                <div class="jobint p-3 border rounded shadow-sm">
                                    <h5>
                                        <a href="./jobDetails.php?id=<?= $job['id'] ?>">
                                            <?= htmlspecialchars($job['title']) ?>
                                        </a>
                                    </h5>
                                    <div><i class="fas fa-building"></i> <?= htmlspecialchars($job['company_name']) ?></div>
                                    <div><i class="fas fa-map-marker-alt"></i> <?= htmlspecialchars($job['country_name'] . '-' . $job['state_name'] . '-' . $job['city_name']) ?></div>
                                    <div><i class="fas fa-dollar-sign"></i> <?= $job['salary_from'] ?> - <?= $job['salary_to'] ?> <?= htmlspecialchars($job['salary_currency']) ?></div>
                                    <div><i class="fas fa-clock"></i> Expiry: <?= $job['expiry_date'] ?></div>
                                    <div class="d-flex mt-2">
                                        <?php
                                        $jobId = $job['id'];
                                        $countQuery = "SELECT COUNT(*) as total FROM user_information WHERE job_id = $jobId";
                                        $countResult = $conn->query($countQuery);
                                        $totalCandidates = 0;
                                        if ($countResult) {
                                            $countRow = $countResult->fetch_assoc();
                                            $totalCandidates = $countRow['total'];
                                        }
                                        ?>
                                        <a class="btn btn-primary btn-sm mr-2" href="layout.php?page=provider_ListApplieduser&job_id=<?= $job['id'] ?>">
                                            <i class="fas fa-users"></i> Candidates (<?= $totalCandidates ?>)
                                        </a>


                                        <a class="btn btn-danger btn-sm" href="javascript:;" onclick="deleteJob(<?= $job['id'] ?>)">
                                            <i class="fas fa-trash"></i> Delete
                                        </a>
                                    </div>
                                </div>
                            </li>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <li class="col-12">No active jobs found.</li>
                    <?php endif; ?>
                </ul>
            </div>

            <!-- Expired Jobs -->
            <div class="tab-pane fade" id="expired-jobs">
                <ul class="featuredlist row">
                    <?php if ($expiredJobs && $expiredJobs->num_rows > 0): ?>
                        <?php while ($job = $expiredJobs->fetch_assoc()): ?>
                            <li class="col-lg-6 col-md-6">
                                <div class="jobint p-3 border rounded shadow-sm">
                                    <h5>
                                        <a href="./jobDetails.php?id=<?= $job['id'] ?>">
                                            <?= htmlspecialchars($job['title']) ?>
                                        </a>
                                    </h5>
                                    <div><i class="fas fa-building"></i> <?= htmlspecialchars($job['company_name']) ?></div>
                                    <div><i class="fas fa-map-marker-alt"></i> <?= htmlspecialchars($job['country_name'] . '-' . $job['state_name'] . '-' . $job['city_name']) ?></div>
                                    <div><i class="fas fa-dollar-sign"></i> <?= $job['salary_from'] ?> - <?= $job['salary_to'] ?> <?= htmlspecialchars($job['salary_currency']) ?></div>
                                    <div><i class="fas fa-info-circle"></i> <?= $job['status'] ?></div>
                                    <div class="d-flex mt-2">
                                        <a class="btn btn-primary btn-sm mr-2" href="layout.php?page=provider_ListApplieduser?job_id=<?= $job['id'] ?>">
                                            <i class="fas fa-users"></i> Candidates
                                        </a>
                                        <a class="btn btn-danger btn-sm" href="javascript:;" onclick="deleteJob(<?= $job['id'] ?>)">
                                            <i class="fas fa-trash"></i> Delete
                                        </a>
                                    </div>
                                </div>
                            </li>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <li class="col-12">No expired jobs found.</li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </div>
</section>





<div class="container mt-4">
    <h3 class="mb-4">Applicants by Status</h3>

    <div class="mb-4">
        <a href="layout.php?page=provider_getApplicantsByStatus&status=accepted" class="btn btn-success status-btn">
            <i class="fas fa-check"></i> All Accepted Applicants
        </a>
        <a href="layout.php?page=provider_getApplicantsByStatus&status=rejected" class="btn btn-danger status-btn my-1">
            <i class="fas fa-times"></i> All Rejected Applicants
        </a>
        <a href="layout.php?page=provider_getApplicantsByStatus&status=pending" class="btn btn-warning status-btn">
            <i class="fas fa-hourglass-half"></i> All Pending Applicants
        </a>
        <a href="layout.php?page=provider_getApplicantsByStatus&status=shortlisted" class="btn btn-info status-btn my-1">
            <i class="fas fa-star"></i> All Shortlisted Applicants
        </a>
    </div>

    <p>Click any button above to view applicants with that status in a new page.</p>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function deleteJob(jobId) {
        Swal.fire({
            title: "Are you sure?",
            text: "This job will be deleted permanently.",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#d33",
            cancelButtonColor: "#3085d6",
            confirmButtonText: "Yes, delete it!"
        }).then((result) => {
            if (result.isConfirmed) {
                // Ab isi page ko call karega (AJAX POST)
                fetch(window.location.href, {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/x-www-form-urlencoded"
                        },
                        body: "delete_job=1&id=" + jobId
                    })
                    .then(response => response.text())
                    .then(data => {
                        Swal.fire({
                            icon: 'success',
                            title: 'Deleted!',
                            text: 'The job has been deleted.',
                            timer: 1500,
                            showConfirmButton: false
                        }).then(() => {
                            location.reload(); // Page reload after success
                        });
                    })
                    .catch(err => {
                        Swal.fire('Error', 'Unable to delete the job', 'error');
                    });
            }
        });
    }
</script>