<?php
session_start();
include '../config.php';

$user_id = $_SESSION['user_id'];

$sql = "
    SELECT id, title, company, country, state, city, date_start, date_end, is_currently_working, description
    FROM job_seeker_experiences
    WHERE user_id = '$user_id'
    ORDER BY id DESC
";

$result = mysqli_query($conn, $sql);

$experiences = [];
if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $experiences[] = $row;
    }
    echo json_encode($experiences);
} else {
    echo json_encode([
        "success" => false,
        "error" => mysqli_error($conn),
        "query" => $sql
    ]);
}
?>
