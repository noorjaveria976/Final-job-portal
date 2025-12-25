{"id":"87432","variant":"standard"}
<?php
include('config.php');

/* ==========================
   UPDATE STATUS (dropdown)
========================== */
if (isset($_POST['update_status'])) {
    $applied_id = intval($_POST['applied_id']);
    $new_status = mysqli_real_escape_string($conn, $_POST['new_status']);
    mysqli_query($conn, "UPDATE job_seeker_appliedjobs SET status='$new_status' WHERE id=$applied_id");
    echo "<script>window.location='layout.php?page=provider_getApplicantsByStatus';</script>";
    exit;
}

function statusDropdown($applied_id) {
    return '
    <form method="POST" style="display:inline;">
        <input type="hidden" name="applied_id" value="'.$applied_id.'">
        <input type="hidden" name="new_status" id="status_input_'.$applied_id.'" value="">
        <div class="btn-group">
            <button type="button" class="btn btn-sm btn-warning dropdown-toggle" data-toggle="dropdown">
                Update
            </button>
            <div class="dropdown-menu">
                <button type="submit" class="dropdown-item" onclick="document.getElementById(\'status_input_'.$applied_id.'\').value=\'pending\'">Pending</button>
                <button type="submit" class="dropdown-item" onclick="document.getElementById(\'status_input_'.$applied_id.'\').value=\'approved\'">Approved</button>
                <button type="submit" class="dropdown-item" onclick="document.getElementById(\'status_input_'.$applied_id.'\').value=\'rejected\'">Rejected</button>
            </div>
        </div>
    </form>';
}


/* ==========================
   FETCH APPLICANTS + PROFILE + JOB INFO
========================== */
$query = "
SELECT 
    u.id AS applied_id,
    u.user_id,
    u.job_id,
    u.applied_at,
    u.status AS applied_status,
    j.title AS job_title,
    p.id AS profile_id,
    p.first_name,
    p.middle_name,
    p.last_name,
    p.email,
    p.gender,
    p.career_level,
    p.cv_file
FROM job_seeker_appliedjobs u
INNER JOIN job_seeker_profiles p ON u.user_id = p.id
INNER JOIN jobs j ON u.job_id = j.id
ORDER BY u.id DESC
";

$result = $conn->query($query);
?>

<section class="section">
    <div class="section-body">
        <div class="container">

            <div class="d-flex justify-content-between align-items-center mb-2">
                <h3 class="mb-0">All Applicants</h3>
                <a href="layout.php?page=provider_managethePostedJob" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Back
                </a>
            </div>

            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover" id="applicantsTable">
                    <thead class="thead-dark">
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Gender</th>
                            <th>Education</th>
                            <th>Job Applied</th>
                            <th>CV</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>

                    <tbody>
<?php
if ($result && $result->num_rows > 0) {
    $i = 1;
    while ($row = $result->fetch_assoc()) {

        $profile_id   = $row['profile_id'];
        $applied_id   = $row['applied_id'];
        $first        = trim(($row['first_name'] ?? '') . ' ' . ($row['middle_name'] ?? '') . ' ' . ($row['last_name'] ?? ''));
        $email        = $row['email'];
        $gender       = $row['gender'];
        $career_level = $row['career_level'];
        $job_title    = $row['job_title'];
        $cv_file      = $row['cv_file'];

        $status_raw = strtolower($row['applied_status']);
        $status_badge = $status_raw == 'approved' ? '<span class="badge badge-success">Approved</span>'
                     : ($status_raw == 'rejected' ? '<span class="badge badge-danger">Rejected</span>'
                     : '<span class="badge badge-warning">Pending</span>');

        // CV
        $cvLink = (!empty($cv_file)) ? 
            "<a href='".htmlspecialchars($cv_file)."' target='_blank' class='btn btn-sm btn-outline-primary'>
                <i class='fas fa-file-pdf'></i> View CV
             </a>"
             :
             "<span class='text-muted'>No CV</span>";

        // Actions: dropdown button for update
        $updateForm = function($applied_id) {
            return '
            <form method="POST" style="display:inline;">
                <input type="hidden" name="applied_id" value="'.$applied_id.'">
                <div class="btn-group">
                    <button type="button" class="btn btn-sm btn-warning dropdown-toggle" data-toggle="dropdown">
                        Update
                    </button>
                    <div class="dropdown-menu">
                        <button type="submit" name="update_status" value="pending" class="dropdown-item" onclick="this.form.new_status.value=\'pending\'">Pending</button>
                        <button type="submit" name="update_status" value="approved" class="dropdown-item" onclick="this.form.new_status.value=\'approved\'">Approved</button>
                        <button type="submit" name="update_status" value="rejected" class="dropdown-item" onclick="this.form.new_status.value=\'rejected\'">Rejected</button>
                    </div>
                    <input type="hidden" name="new_status" value="">
                </div>
            </form>';
        };
?>
                        <tr>
                            <td><?= $i ?></td>
                            <td><?= htmlspecialchars($first) ?></td>
                            <td><?= htmlspecialchars($email) ?></td>
                            <td><?= htmlspecialchars($gender) ?></td>
                            <td><?= htmlspecialchars($career_level) ?></td>
                            <td><?= htmlspecialchars($job_title) ?></td>
                            <td><?= $cvLink ?></td>
                            <td><?= $status_badge ?></td>
                            <td>
                                <?= $updateForm($applied_id) ?>
                                <a href="layout.php?page=view_candidate&id=<?= $profile_id ?>" class="btn btn-sm btn-info">View</a>
                            </td>
                        </tr>
<?php
        $i++;
    }
} else {
    echo "<tr><td colspan='9' class='text-center'>No applicants found.</td></tr>";
}
?>
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</section>

<!-- jQuery & Bootstrap -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<!-- DataTables CSS & JS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css"/>
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css"/>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>

<script>
$(document).ready(function() {
    $('#applicantsTable').DataTable({
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    });
});
</script>
