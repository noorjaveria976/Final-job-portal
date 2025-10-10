<?php
session_start();
include '../config.php';


header('Content-Type: application/json');

if (!isset($_GET['id'])) {
    echo json_encode(['success' => false, 'message' => 'No ID provided']);
    exit;
}

$exp_id = intval($_GET['id']);
$user_id = $_SESSION['user_id'] ?? 0;

$query = "SELECT * FROM job_seeker_experiences WHERE id = $exp_id AND user_id = $user_id LIMIT 1";
$result = mysqli_query($conn, $query);

if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    echo json_encode([
        'success' => true,
        'experience' => $row
    ]);
} else {
    echo json_encode(['success' => false, 'message' => 'Experience not found']);
}
