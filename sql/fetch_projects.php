<?php
session_start();
include '../config.php';

if (!isset($_SESSION['user_id'])) {
    echo json_encode([]); // Agar user login nahi hai to empty array bhej do
    exit;
}

$user_id = intval($_SESSION['user_id']);

$sql = "SELECT * FROM projects WHERE user_id = '$user_id' ORDER BY id DESC";
$result = mysqli_query($conn, $sql);

$projects = [];

if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $projects[] = [
            "id"          => $row['id'],
            "name"        => $row['name'],
            "url"         => $row['url'],
            "date_start"  => $row['date_start'],
            "date_end"    => $row['date_end'],
            "description" => $row['description'],
            "image"       => $row['image'] // sirf filename (uploads/projects/ ka path JS me add hoga)
        ];
    }
}

echo json_encode($projects);
?>
