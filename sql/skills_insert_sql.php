<?php
session_start();
include '../config.php';

header('Content-Type: application/json'); // JSON response denge

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_SESSION['user_id'];
    $job_skill = mysqli_real_escape_string($conn, $_POST['job_skill']);
    $job_experience = mysqli_real_escape_string($conn, $_POST['job_experience']);
    $skill_id = isset($_POST['skill_id']) ? intval($_POST['skill_id']) : 0;

    if ($skill_id > 0) {
        // 🔄 Update existing skill
        $sql = "UPDATE job_seeker_skills 
                SET job_skill='$job_skill', job_experience='$job_experience' 
                WHERE id='$skill_id' AND user_id='$user_id'";
        $msg = "Skill updated successfully!";
    } else {
        // ➕ Insert new skill
        $sql = "INSERT INTO job_seeker_skills (user_id, job_skill, job_experience) 
                VALUES ('$user_id', '$job_skill', '$job_experience')";
        $msg = "Skill added successfully!";
    }

    if (mysqli_query($conn, $sql)) {
        echo json_encode(["success" => true, "message" => $msg]);
    } else {
        echo json_encode(["success" => false, "message" => "Database error: " . mysqli_error($conn)]);
    }
}
?>
