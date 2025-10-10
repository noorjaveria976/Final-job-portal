<?php
session_start();
include '../config.php';

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'User not logged in']);
    exit;
}

$user_id = $_SESSION['user_id'];
$cv_id = intval($_GET['id']);

$sql = mysqli_query($conn, "SELECT * FROM cvs WHERE id = '$cv_id' AND user_id = '$user_id'");
if (mysqli_num_rows($sql) > 0) {
    $cv = mysqli_fetch_assoc($sql);
    echo json_encode(['success' => true, 'cv' => $cv]);
} else {
    echo json_encode(['success' => false, 'message' => 'CV not found!']);
}
?>
