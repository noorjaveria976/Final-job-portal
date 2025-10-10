<?php
session_start();
include '../config.php';

if (!isset($_GET['id'])) {
    echo json_encode(["success" => false, "message" => "Project ID missing"]);
    exit;
}

$id = intval($_GET['id']);
$result = mysqli_query($conn, "SELECT * FROM projects WHERE id='$id' LIMIT 1");

if ($result && mysqli_num_rows($result) > 0) {
$row = mysqli_fetch_assoc($result);

if (!empty($row['image'])) {
    $row['image'] = "uploads/projects/" . $row['image'];
}

echo json_encode(["success" => true, "project" => $row]);

} else {
    echo json_encode([
        "success" => false,
        "message" => "Project not found"
    ]);
}
?>
