<?php
include '../config.php';

if (isset($_POST['id'])) {
    $id = intval($_POST['id']);

    $query = mysqli_query($conn, "SELECT * FROM job_seeker_education WHERE id = '$id'");
    if (mysqli_num_rows($query) > 0) {
        $row = mysqli_fetch_assoc($query);
        echo json_encode([
            "success" => true,
            "education" => $row
        ]);
    } else {
        echo json_encode([
            "success" => false,
            "message" => "Record not found"
        ]);
    }
} else {
    echo json_encode([
        "success" => false,
        "message" => "Invalid Request"
    ]);
}
?>
