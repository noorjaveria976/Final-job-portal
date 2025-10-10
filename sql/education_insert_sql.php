<?php
session_start();
include '../config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_SESSION['user_id'];  // logged-in user ka id
    $id = isset($_POST['id']) ? intval($_POST['id']) : 0;

    $degree_level_id  = mysqli_real_escape_string($conn, $_POST['degree_level_id']);
    $degree_type_id   = mysqli_real_escape_string($conn, $_POST['degree_type_id']);
    $degree_title     = mysqli_real_escape_string($conn, $_POST['degree_title']);
    $country_id       = mysqli_real_escape_string($conn, $_POST['country_id']);
    $state_id         = mysqli_real_escape_string($conn, $_POST['state_id']);
    $city_id          = mysqli_real_escape_string($conn, $_POST['city_id']);
    $institution      = mysqli_real_escape_string($conn, $_POST['institution']);
    $date_completion  = mysqli_real_escape_string($conn, $_POST['date_completion']);
    $degree_result    = mysqli_real_escape_string($conn, $_POST['degree_result']);
    $result_type_id   = mysqli_real_escape_string($conn, $_POST['result_type_id']);

    if ($id > 0) {
        // Update record
        $sql = "UPDATE job_seeker_education 
                SET degree_level_id='$degree_level_id',
                    degree_type_id='$degree_type_id',
                    degree_title='$degree_title',
                    country_id='$country_id',
                    state_id='$state_id',
                    city_id='$city_id',
                    institution='$institution',
                    date_completion='$date_completion',
                    degree_result='$degree_result',
                    result_type_id='$result_type_id'
                WHERE id='$id' AND user_id='$user_id'";
        $msg = "Education updated successfully!";
    } else {
        // Insert new record
        $sql = "INSERT INTO job_seeker_education 
                (user_id, degree_level_id, degree_type_id, degree_title, country_id, state_id, city_id, institution, date_completion, degree_result, result_type_id, created_at) 
                VALUES ('$user_id', '$degree_level_id', '$degree_type_id', '$degree_title', '$country_id', '$state_id', '$city_id', '$institution', '$date_completion', '$degree_result', '$result_type_id', NOW())";
        $msg = "Education added successfully!";
    }

    if (mysqli_query($conn, $sql)) {
        header("Location: ../layout.php?page=seeker_build_resume");
        exit;
    } else {
        header("Location: ../layout.php?page=seeker_build_resume?error=" . mysqli_error($conn));
        exit;
    }
}
?>
