<?php


include('config.php');



// Fetch all jobs for admin
$jobs = $conn->query("SELECT * FROM jobs ORDER BY id DESC");
if (!$jobs) {
    die("Database query failed: " . $conn->error);
}


?>
    <link rel="stylesheet" href="assets/bundles/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css">

<!-- Main Content -->
 <section class="section">
            <div class="section-body">
                <h5>Manage Jobs</h5>
                <div class="card card-primary">
                    <div class="card-header d-flex justify-content-between align-items-center"></div>
                    <div class="card-body ">
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

                                        // Status badge
                                        if ($status == 'Active') {
                                            $displayStatus = 'Approved';
                                            $badgeClass = 'success';
                                        } elseif ($status == 'Inactive') {
                                            $displayStatus = 'Pending';
                                            $badgeClass = 'warning';
                                        } else {
                                            $displayStatus = 'Rejected';
                                            $badgeClass = 'danger';
                                        }

                                        $salary = $row['salary_from'] && $row['salary_to'] ? $row['salary_from'] . '-' . $row['salary_to'] . ' ' . $row['salary_currency'] : 'N/A';
                                        // $jobType = $row['job_type'] == 1 ? 'Contract' : ($row['job_type'] == 2 ? 'Freelance' : ($row['job_type'] == 3 ? 'Full Time' : 'Full Time'));

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
                                                    <div class='dropdown-menu'>
                                        ";

                                        // Actions in dropdown
                                        if ($status != 'Active') {
                                            echo "<a class='dropdown-item status-btn' href='layout.php?page=admin_job_status&action=approve&id={$row['id']}'>Approve</a>";
                                        }
                                        if ($status != 'Inactive') {
                                            echo "<a class='dropdown-item status-btn' href='layout.php?page=admin_job_status&action=set_pending&id={$row['id']}'>Pending</a>";
                                        }
                                        if ($status != 'Rejected') {
                                            echo "<a class='dropdown-item status-btn' href='layout.php?page=admin_job_status&action=reject&id={$row['id']}'>Reject</a>";
                                        }

                                        // Edit
                                        echo "<a class='dropdown-item btn-edit'
                                                href='#'
                                                data-id='{$row['id']}'
                                                data-title='" . htmlspecialchars($row['title']) . "'
                                                data-company='" . htmlspecialchars($row['company_name']) . "'
                                                data-salary_from='{$row['salary_from']}'
                                                data-salary_to='{$row['salary_to']}'
                                                data-currency='{$row['salary_currency']}'
                                                data-job_type='{$row['job_type']}'
                                                data-status='{$row['status']}'>Edit</a>";

                                        // Delete
                                        echo "<a class='dropdown-item delete-btn' href='deleteJob.php?id={$row['id']}'>Delete</a>";

                                        echo "</div></div></td></tr>";
                                        $i++;
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>