<?php


include('config.php');
// Only allow admin to access this page
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit();
}

// Handle toast messages
$toast = "";
if (isset($_SESSION['success'])) {
    $msg = $_SESSION['success'];
    unset($_SESSION['success']);
    $toast = "
    <script>
      document.addEventListener('DOMContentLoaded', function() {
        Swal.fire('Success', '$msg', 'success');
      });
    </script>
    ";
}
if (isset($_SESSION['error'])) {
    $msg = $_SESSION['error'];
    unset($_SESSION['error']);
    $toast = "
    <script>
      document.addEventListener('DOMContentLoaded', function() {
        Swal.fire('Error', '$msg', 'error');
      });
    </script>
    ";
}



?>
<!-- Main Content -->
 <section class="section">
                <h4 class="mb-4">Manage Users</h4>

                <div class="card shadow-sm">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Users List</h5>
                        <!-- Add Modal Button -->
                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addUserModal">
                            <i class="fas fa-user-plus"></i> Add New User
                        </button>
                    </div>

                    <div class="card-body">
                        <table id="tableExport" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Full Name</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $res = $conn->query("SELECT * FROM system_users ORDER BY id DESC");
                                if ($res && $res->num_rows > 0) {
                                    $i = 1;
                                    while ($row = $res->fetch_assoc()) {
                                        $is_last = ($res->num_rows <= 1) ? "true" : "false";
                                        echo "<tr>
                                            <td>{$i}</td>
                                            <td>".htmlspecialchars($row['name'])."</td>
                                            <td>".htmlspecialchars($row['email'])."</td>
                                            <td>".htmlspecialchars($row['role'])."</td>
                                            <td>
                                                <a href='includes/admin_status.php?id={$row['id']}' 
                                                   class='btn btn-sm ".($row['status']=='Active'?'btn-success':'btn-secondary')." status-btn' 
                                                   data-status='{$row['status']}' data-last='{$is_last}'>
                                                   {$row['status']}
                                                </a>
                                            </td>
                                            <td>
                                                <a href='#' class='btn btn-sm btn-info btn-edit'
                                                   data-id='{$row['id']}' 
                                                   data-name='".htmlspecialchars($row['name'])."'
                                                   data-email='".htmlspecialchars($row['email'])."'
                                                   data-role='{$row['role']}'
                                                   data-status='{$row['status']}'>Edit</a>
                                                <a href='includes/admin_delete.php?id={$row['id']}' 
                                                   class='btn btn-sm btn-danger delete-btn' data-last='{$is_last}'>Delete</a>
                                            </td>
                                        </tr>";
                                        $i++;
                                    }
                                } else {
                                    echo "<tr><td colspan='6' class='text-center'>No Users Found</td></tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </section>


             <!-- Add User Modal -->
    <div class="modal fade" id="addUserModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document" style="max-width: 55%;">
            <div class="modal-content">
                <form method="POST" action="includes/save_admin.php">
                    <div class="modal-header">
                        <h5 class="modal-title">Add New User</h5>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Full Name</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Email Address</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Role</label>
                            <select name="role" class="form-control" required>
                                <option value="admin">Admin</option>
                                <option value="jobseeker">Job Seeker</option>
                                <option value="jobprovider">Job Provider</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Status</label>
                            <select name="status" class="form-control" required>
                                <option value="Active">Active</option>
                                <option value="Inactive">Inactive</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" name="save_admin" class="btn btn-primary">Save User</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit User Modal -->
    <div class="modal fade" id="editUserModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document" style="max-width: 55%;">
            <div class="modal-content">
                <form method="POST" action="includes/save_admin.php">
                    <input type="hidden" name="id" id="editUserId">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit User</h5>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Full Name</label>
                            <input type="text" name="name" id="editUserName" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" name="email" id="editUserEmail" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Role</label>
                            <select name="role" id="editUserRole" class="form-control" required>
                                <option value="admin">Admin</option>
                                <option value="jobseeker">Job Seeker</option>
                                <option value="jobprovider">Job Provider</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Status</label>
                            <select name="status" id="editUserStatus" class="form-control" required>
                                <option value="Active">Active</option>
                                <option value="Inactive">Inactive</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" name="update_admin" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Edit button populate
            document.querySelectorAll(".btn-edit").forEach(function(btn) {
                btn.addEventListener("click", function() {
                    document.getElementById("editUserId").value = this.dataset.id;
                    document.getElementById("editUserName").value = this.dataset.name;
                    document.getElementById("editUserEmail").value = this.dataset.email;
                    document.getElementById("editUserRole").value = this.dataset.role;
                    document.getElementById("editUserStatus").value = this.dataset.status;
                    $('#editUserModal').modal('show');
                });
            });

            // Delete confirmation
            document.querySelectorAll(".delete-btn").forEach(function(btn) {
                btn.addEventListener("click", function(e) {
                    e.preventDefault();
                    const url = this.href;
                    const isLast = this.getAttribute("data-last");
                    if (isLast === "true") {
                        Swal.fire("Not Allowed!", "Cannot delete last user!", "error");
                        return;
                    }
                    Swal.fire({
                        title: "Are you sure?",
                        text: "This user will be deleted!",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#d33",
                        cancelButtonColor: "#3085d6",
                        confirmButtonText: "Yes, delete!"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = url;
                        }
                    });
                });
            });

            // Status change confirmation
            document.querySelectorAll(".status-btn").forEach(function(btn) {
                btn.addEventListener("click", function(e) {
                    e.preventDefault();
                    const url = this.href;
                    const status = this.getAttribute("data-status");
                    const isLast = this.getAttribute("data-last");
                    if (isLast === "true" && status === "Active") {
                        Swal.fire("Not Allowed!", "Cannot inactivate last admin!", "error");
                        return;
                    }
                    Swal.fire({
                        title: "Change Status?",
                        text: "Change status from " + status + "?",
                        icon: "question",
                        showCancelButton: true,
                        confirmButtonText: "Yes, change it!"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = url;
                        }
                    });
                });
            });
        });
    </script>