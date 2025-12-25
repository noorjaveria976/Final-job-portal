<?php
include('config.php'); // DB connection

// --------------------
// HANDLE STATUS UPDATE
// --------------------
if (isset($_POST['app_id']) && isset($_POST['status'])) {
    $app_id = $_POST['app_id'];
    $status = $_POST['status'];

    $stmt = $conn->prepare("UPDATE job_seeker_appliedjobs SET status=? WHERE id=?");

    if (!$stmt) {
        die("Prepare Failed: " . $conn->error);
    }

    $stmt->bind_param("si", $status, $app_id);

    if ($stmt->execute()) {
        echo "<script>
                alert('Status Updated Successfully');
                window.location.href='layout.php?page=provider_getApplicantsByStatus';
              </script>";
        exit;
    } else {
        echo "Error: " . $stmt->error;
    }
}

// --------------------
// FETCH APPLIED JOBS
// --------------------
$query = "SELECT 
            a.id AS application_id,
            u.user_first_name,
            u.user_last_name,
            u.user_email,
            u.user_gender,
            j.title AS job_title,
            a.status
          FROM job_seeker_appliedjobs a
          JOIN users u ON a.user_id = u.user_id
          JOIN jobs j ON a.job_id = j.id
          ORDER BY a.id DESC";

$result = $conn->query($query);

if (!$result) {
    die("Query Error: " . $conn->error);
}
?>

<!-- =========================== -->
<!-- APPLIED JOBS TABLE          -->
<!-- =========================== -->

<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

<table id="applicationsTable" class="table table-bordered">
    <thead>
        <tr>
            <th>Candidate Name</th>
            <th>Email</th>
            <th>Gender</th>
            <th>Job Applied</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
    </thead>

    <tbody>
        <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?= $row['user_first_name'] . " " . $row['user_last_name']; ?></td>
            <td><?= $row['user_email']; ?></td>
            <td><?= $row['user_gender']; ?></td>
            <td><?= $row['job_title']; ?></td>
            <td><span class="badge bg-info"><?= ucfirst($row['status']); ?></span></td>
            <td>
                <form method="POST" onsubmit="return confirm('Are you sure you want to update status?');">
                    <input type="hidden" name="app_id" value="<?= $row['application_id']; ?>">
                    <select name="status" class="form-select form-select-sm mb-1">
                        <option value="applied" <?= ($row['status']=='applied')?'selected':''; ?>>Applied</option>
                        <option value="shortlisted" <?= ($row['status']=='shortlisted')?'selected':''; ?>>Shortlisted</option>
                        <option value="selected" <?= ($row['status']=='selected')?'selected':''; ?>>Selected</option>
                        <option value="rejected" <?= ($row['status']=='rejected')?'selected':''; ?>>Rejected</option>
                    </select>
                    <button type="submit" class="btn btn-sm btn-primary">Update</button>
                    <a href="view_candidate.php?id=<?= $row['application_id']; ?>" class="btn btn-sm btn-secondary mt-1">View Details</a>
                </form>
            </td>
        </tr>
        <?php endwhile; ?>
    </tbody>
</table>

<!-- jQuery & DataTables JS -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

<script>
$(document).ready(function() {
    $('#applicationsTable').DataTable({
        "order": [[0, "desc"]]
    });
});
</script>
