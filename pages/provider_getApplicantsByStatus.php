<?php
include('config.php');

$status = $_GET['status'] ?? '';
$status = $conn->real_escape_string($status);


// Fetch all applied users with given status for active jobs
$query = "
SELECT u.*, j.title AS job_title,
p.first_name, p.email, p.gender, p.career_level
FROM job_seeker_appliedjobs u
  INNER JOIN job_seeker_profiles p
JOIN jobs j ON u.job_id = j.id
WHERE u.status = '$status' AND j.status = 'Active'
ORDER BY u.id DESC
";

$result = $conn->query($query);
?>

<!-- Main Content -->
<section class="section">
    <div class="section-body">
        <div class="container ">
            <div class="d-flex justify-content-between align-items-center mb-2">
                <h3 class="mb-0"><?= ucfirst($status) ?> Applicants</h3>
                <a href="layout.php?page=provider_managethePostedJob" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Back
                </a>
            </div>


            <!-- Table with fixed height and scroll -->
            <div class="table-responsive" style="max-height:500px; overflow-y:auto;">
                <table class="table table-bordered table-striped table-hover" id="tableExport">
                    <thead class="thead-dark">
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Gender</th>
                            <th>Education</th>

                            <th>Job Applied</th>
                            <th>CV</th>
                            <!-- <th>Profile Photo</th> -->
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($result && $result->num_rows > 0) {
                            $i = 1;
                            while ($row = $result->fetch_assoc()) {
                                $cvLink = !empty($row['cv_file'])
                                    ? "<a href='/Jobs.TEF.com.pk_updated/{$row['cv_file']}' target='_blank' class='btn btn-sm btn-outline-primary'>
                                    <i class='fas fa-file-pdf'></i> View CV
                                    </a>"
                                    : '<span class="text-muted">No CV</span>';
                                $profilePhoto = !empty($row['profile_photo']) ? "<img src='../../uploads/profile/{$row['profile_photo']}' alt='Photo' width='50' class='rounded-circle'>" : '-';

                                echo "<tr>
                            <td>{$i}</td>
                            <td>" . htmlspecialchars($row['first_name']) . "</td>
                            <td>" . htmlspecialchars($row['email']) . "</td>
                            <td>" . htmlspecialchars($row['gender']) . "</td>
                            <td>" . htmlspecialchars($row['career_level']) . "</td>
                         
                            <td>" . htmlspecialchars($row['job_title']) . "</td>
                            <td>{$cvLink}</td>
                            <td>" . ucfirst($row['status']) . "</td>
                        </tr>";
                                $i++;
                            }
                        } else {
                            echo '<tr><td colspan="11" class="text-center">No applicants found.</td></tr>';
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</section>