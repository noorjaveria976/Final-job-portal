<?php
session_start();
include '../config.php';

$user_id = $_SESSION['user_id'];

$title       = $_POST['title'] ?? '';
$company     = $_POST['company'] ?? '';
$country     = $_POST['country'] ?? '';
$state       = $_POST['state'] ?? '';
$city        = $_POST['city'] ?? '';
$date_start  = $_POST['date_start'] ?? '';
$date_end    = $_POST['date_end'] ?? '';
$is_currently_working = $_POST['is_currently_working'] ?? 0;
$description = $_POST['description'] ?? '';
$experience_id = $_POST['experience_id'] ?? '';  // hidden field for edit

if ($experience_id) {
    // 🔹 Update existing record
    $sql = "UPDATE job_seeker_experiences 
            SET title=?, company=?, country=?, state=?, city=?, 
                date_start=?, date_end=?, is_currently_working=?, `description`=?,
                updated_at=NOW()
            WHERE id=? AND user_id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssssisii", 
        $title, $company, $country, $state, $city, 
        $date_start, $date_end, $is_currently_working, $description, 
        $experience_id, $user_id
    );
} else {
    // 🔹 Insert new record
    $sql = "INSERT INTO job_seeker_experiences 
            (user_id, title, company, country, state, city, date_start, date_end, is_currently_working, `description`, created_at, updated_at) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW(), NOW())";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("isssssssis", 
        $user_id, $title, $company, $country, $state, $city, 
        $date_start, $date_end, $is_currently_working, $description
    );
}

if ($stmt->execute()) {
    echo json_encode(["success" => true]);
} else {
    echo json_encode(["success" => false, "error" => $stmt->error, "query" => $sql]);
}
?>
