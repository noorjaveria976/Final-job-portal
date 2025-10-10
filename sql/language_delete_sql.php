<?php
session_start();
include '../config.php';

header('Content-Type: application/json'); // JSON response

if (isset($_POST['language_id'])) {
    $user_id = $_SESSION['user_id'];
    $language_id = intval($_POST['language_id']);

    $sql = "DELETE FROM job_seeker_languages WHERE id='$language_id' AND user_id='$user_id'";

    if (mysqli_query($conn, $sql)) {
        echo json_encode(["success" => true, "message" => "Language deleted successfully!"]);
    } else {
        echo json_encode(["success" => false, "message" => "Error: " . mysqli_error($conn)]);
    }
} else {
    echo json_encode(["success" => false, "message" => "Invalid request"]);
}
?>
