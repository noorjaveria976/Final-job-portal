<?php
include('config.php');
$user_id = $_SESSION['user_id'] ?? 0;

// Fetch all jobs
$jobs = $conn->query("SELECT * FROM jobs ORDER BY id DESC");
if (!$jobs) {
    die("Database query failed: " . $conn->error);
}

// User role from session
$role = $_SESSION['userRole'] ?? 'assistant'; // default to assistant HR
?>
<section class="section">
    <div class="section-body">
        <h5>Manage Jobs</h5>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped" id="tableExport">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Job Title</th>
                            <th>Company</th>
                            <th>Salary</th>
                            <th>Job Type</th>
                            <th>Job Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 1;
                        while ($row = $jobs->fetch_assoc()) {
                            $status = isset($row['status']) && !empty($row['status']) ? ucfirst($row['status']) : 'Inactive';

                            if ($status == 'Active') {
                                $displayStatus = 'Approved';
                                $badgeClass = 'success';
                            } elseif ($status == 'Inactive') {
                                $displayStatus = 'Pending';
                                $badgeClass = 'warning';
                            } else {
                                $displayStatus = 'Expired';
                                $badgeClass = 'danger';
                            }

                            $salary = ($row['salary_from'] && $row['salary_to']) ? $row['salary_from'] . '-' . $row['salary_to'] . ' ' . $row['salary_currency'] : 'N/A';

                            echo "<tr>
                                <td>{$i}</td>
                                <td>" . htmlspecialchars($row['title']) . "</td>
                                <td>" . htmlspecialchars($row['company_name']) . "</td>
                                <td>{$salary}</td>
                                <td>" . htmlspecialchars($row['job_type']) . "</td>
                                <td><span class='badge badge-{$badgeClass}'>$displayStatus</span></td>
                                <td class='text-nowrap'>
                                    <div class='dropdown'>
                                        <button class='btn btn-light btn-sm dropdown-toggle' type='button' data-toggle='dropdown'>
                                            <i class='fas fa-ellipsis-v'></i>
                                        </button>
                                        <div class='dropdown-menu'>";

                            if ($userRole === 'admin') {
                                if ($status != 'Active') {
                                    echo "<a class='dropdown-item btn btn-success w-100 mb-2' href='layout.php?page=admin_job_status&action=approve&id={$row['id']}'>Approve</a>";
                                }
                                if ($status != 'Inactive') {
                                    echo "<a class='dropdown-item btn btn-warning w-100 mb-2' href='layout.php?page=admin_job_status&action=set_pending&id={$row['id']}'>Pending</a>";
                                }
                                echo "<a class='dropdown-item btn btn-info w-100 mb-2' href='layout.php?page=admin_JobsForm&id={$row['id']}'><i class='fas fa-edit'></i> Edit</a>";
                                echo "<a class='dropdown-item btn btn-danger w-100 mb-2' href='layout.php?page=admin_deleteJob&id={$row['id']}' onclick=\"return confirm('Are you sure you want to delete this job?')\"><i class='fas fa-trash'></i> Delete</a>";
                                echo "<a class='dropdown-item btn btn-primary w-100 mb-2' href='layout.php?page=seeker_view_jobs&id={$row['id']}'><i class='fas fa-eye'></i> View</a>";
                            } else {
                                // Assistant HR: Only Edit & Delete
                                echo "<a class='dropdown-item btn btn-info w-100 mb-2' href='layout.php?page=admin_JobsForm&id={$row['id']}'><i class='fas fa-edit'></i> Edit</a>";
                                echo "<a class='dropdown-item btn btn-danger w-100 mb-2' href='layout.php?page=admin_deleteJob&id={$row['id']}' onclick=\"return confirm('Are you sure you want to delete this job?')\"><i class='fas fa-trash'></i> Delete</a>";
                                echo "<a class='dropdown-item btn btn-primary w-100 mb-2' href='layout.php?page=seeker_view_jobs&id={$row['id']}'><i class='fas fa-eye'></i> View</a>";
                            }

                            echo "      </div>
                                    </div>
                                </td>
                            </tr>";
                            $i++;
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
