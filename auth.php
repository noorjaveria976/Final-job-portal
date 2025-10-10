<?php
session_start();
ob_start();

include('config.php');

// Redirect to login if user is not logged in
if (!isset($_SESSION['user_email'])) {
    echo "<script>window.open('index.php','_SELF')</script>";
    exit();
}

// Get logged-in user's email from session
$userEmail = $_SESSION['user_email'];

// Fetch user info from the 'users' table
$userQry = "SELECT * FROM users WHERE user_email='$userEmail' LIMIT 1";
$userQryRun = mysqli_query($conn, $userQry);

if ($userQryRun && mysqli_num_rows($userQryRun) > 0) {
    $userRow = mysqli_fetch_assoc($userQryRun);

    // Safely assign variables, check if key exists
    $userId        = isset($userRow['user_id']) ? $userRow['user_id'] : 0;
    $userName      = (isset($userRow['user_first_name']) ? $userRow['user_first_name'] : '') . ' ' . (isset($userRow['user_last_name']) ? $userRow['user_last_name'] : '');
    $userEmail     = isset($userRow['user_email']) ? $userRow['user_email'] : '';
    $userRole      = isset($userRow['user_role']) ? $userRow['user_role'] : 'employee';
    $userPhone     = isset($userRow['user_phone']) ? $userRow['user_phone'] : '';
    $userCreatedAt = isset($userRow['created_at']) ? $userRow['created_at'] : date('Y-m-d H:i:s');

} else {
    // If user not found, destroy session and redirect to login
    session_destroy();
    echo "<script>window.open('index.php','_SELF')</script>";
    exit();
}
?>
