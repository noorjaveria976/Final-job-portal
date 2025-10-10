<?php $pageTitle = "Candidates List"; ?>

<?php
include('config.php');

if (!isset($_GET['job_id']) || !isset($_GET['status'])) {
    die("Invalid request");
}

$job_id = intval($_GET['job_id']);
$status = mysqli_real_escape_string($conn, $_GET['status']);

// Get job title
$jobQuery = "SELECT title FROM jobs WHERE id = $job_id";
$job = $conn->query($jobQuery)->fetch_assoc();

// Fetch applicants by status
$applicantsQuery = "
     SELECT 
        a.id as apply_id,
        a.status,
        a.applied_at,
        p.first_name, p.last_name, p.email, p.country, p.gender, 
        p.job_experience, p.career_level, p.functional_area, p.phone
    FROM job_seeker_appliedjobs a
    INNER JOIN job_seeker_profiles p ON a.user_id = p.user_id
    WHERE a.job_id = $job_id AND status='$status'
    ORDER BY created_at DESC
";
$applicants = $conn->query($applicantsQuery);

?>

<section class="section">
    <div class="section-body">
        <h3 class="d-flex justify-content-between align-items-center">
            <?= $status ?> Candidates for: <?= htmlspecialchars($job['title']) ?>
            <a href="layout.php?page=provider_ListApplieduser&job_id=<?= $job_id ?>" class="btn btn-secondary btn-sm">
                <i class="fas fa-arrow-left"></i> Back
            </a>
        </h3>
        <div class="table-responsive mt-4">
            <table id="tableExport" class="table table-bordered table-striped">
                <thead class="thead-light">
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Country </th>
                        <th>Gender</th>
                        <th>Phone</th>
                        <th>CV</th>
                        <th>Applied On</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($applicants && $applicants->num_rows > 0): ?>
                        <?php $i = 1;
                        while ($row = $applicants->fetch_assoc()): ?>
                            <tr id="row-<?= $row['id'] ?>">
                                <td><?= $i++ ?></td>
                                <td><?= htmlspecialchars($row['name']) ?></td>
                                <td><?= htmlspecialchars($row['email']) ?></td>
                                <td><?= htmlspecialchars($row['country']) ?></td>
                                <td><?= htmlspecialchars($row['gender']) ?></td>
                                <td><?= nl2br(htmlspecialchars($row['phone'])) ?></td>
                                <td>
                                    <?php if ($row['cv_file']): ?>
                                        <a href="/Jobs.TEF.com.pk_updated/<?= $row['cv_file'] ?>" target="_blank" class="btn btn-info btn-sm">
                                            <i class="fas fa-file-alt"></i> View CV
                                        </a>
                                    <?php else: ?>
                                        N/A
                                    <?php endif; ?>
                                </td>
                                <td><?= date("d M, Y", strtotime($row['created_at'])) ?></td>
                                <td>
                                    <button class="btn btn-danger btn-sm" onclick="deleteApplicant(<?= $row['id'] ?>)">
                                        <i class="fas fa-trash"></i> Delete
                                    </button>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="9" class="text-center">No <?= $status ?> candidates found.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</section>

<script>
    function deleteApplicant(id) {
        Swal.fire({
            title: "Are you sure?",
            text: "This candidate will be deleted permanently!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#d33",
            cancelButtonColor: "#3085d6",
            confirmButtonText: "Yes, delete it!"
        }).then((result) => {
            if (result.isConfirmed) {
                fetch("actions/deleteApplicant.php?id=" + id)
                    .then(res => res.text())
                    .then(data => {
                        if (data === "success") {
                            document.getElementById("row-" + id).remove();
                            Swal.fire("Deleted!", "Candidate has been removed.", "success");
                        } else {
                            Swal.fire("Error!", data, "error");
                        }
                    });
            }
        });
    }
</script>