<?php
session_start();
include '../config.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_SESSION['user_id'];
    $lang_id = isset($_POST['lang_id']) && !empty($_POST['lang_id']) ? intval($_POST['lang_id']) : 0;

    $language = mysqli_real_escape_string($conn, $_POST['language']);
    $language_level = mysqli_real_escape_string($conn, $_POST['language_level']);

    if ($lang_id > 0) {
        // 🔄 UPDATE
        $sql = "UPDATE job_seeker_languages 
                SET language='$language', language_level='$language_level'
                WHERE id='$lang_id' AND user_id='$user_id'";

        if (mysqli_query($conn, $sql)) {
            echo json_encode(["success" => true, "message" => "Language updated successfully!"]);
        } else {
            echo json_encode(["success" => false, "message" => "Failed to update language!"]);
        }

    } else {
        // ➕ INSERT
        $sql = "INSERT INTO job_seeker_languages (user_id, language, language_level) 
                VALUES ('$user_id', '$language', '$language_level')";

        if (mysqli_query($conn, $sql)) {
            echo json_encode(["success" => true, "message" => "Language added successfully!"]);
        } else {
            echo json_encode(["success" => false, "message" => "Failed to add language!"]);
        }
    }
}
?>
