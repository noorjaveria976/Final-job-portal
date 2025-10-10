<?php


include('config.php');
if(!isset($_GET['action']) || !isset($_GET['id'])){
    die("Invalid request");
}

$action = $_GET['action'];
$id = intval($_GET['id']);

if ($action == 'approve') $newStatus = 'Active';
elseif ($action == 'set_pending') $newStatus = 'Inactive';
elseif ($action == 'reject') $newStatus = 'Rejected';
else die("Invalid action");

// Update job status
$stmt = $conn->prepare("UPDATE jobs SET status=? WHERE id=?");
$stmt->bind_param("si", $newStatus, $id);

if($stmt->execute()){
    $_SESSION['message'] = "Job status updated successfully.";
} else {
    $_SESSION['message'] = "Failed to update job status.";
}

$stmt->close();
$conn->close();

// Redirect back to manage jobs page
header("Location: layout.php?page=admin_manageJobs");
exit;



?>
<!-- Main Content -->
