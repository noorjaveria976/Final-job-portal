<?php
session_start();
include '../config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $id = intval($_POST['id']);
    $user_id = $_SESSION['user_id'];

    $sql = "DELETE FROM job_seeker_skills WHERE id='$id' AND user_id='$user_id'";
    if (mysqli_query($conn, $sql)) {
        echo json_encode(["success" => true, "message" => "Skill deleted successfully"]);
    } else {
        echo json_encode(["success" => false, "message" => "Delete failed"]);
    }
}
?>
