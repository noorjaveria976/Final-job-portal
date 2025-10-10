<?php
session_start();
include '../config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = (int)$_POST['id'];
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $url = mysqli_real_escape_string($conn, $_POST['url']);
    $date_start = mysqli_real_escape_string($conn, $_POST['date_start']);
    $date_end = mysqli_real_escape_string($conn, $_POST['date_end']);
    $is_on_going = isset($_POST['is_on_going']) ? (int)$_POST['is_on_going'] : 0;
    $description = mysqli_real_escape_string($conn, $_POST['description']);

    // Update Image if new uploaded
    $image_query = '';
    if (!empty($_FILES['image']['name'])) {
        $image_name = time() . '_' . basename($_FILES['image']['name']);
        $target = "uploads/projects/" . $image_name;
        move_uploaded_file($_FILES['image']['tmp_name'], $target);
        $image_query = ", image='$image_name'";
    }

    $sql = "UPDATE projects SET 
            name='$name', url='$url', date_start='$date_start', date_end='$date_end', 
            is_on_going='$is_on_going', description='$description' $image_query
            WHERE id='$id'";
    if (mysqli_query($conn, $sql)) {
        echo json_encode(['status' => 'success']);
    } else {
        echo json_encode(['status' => 'error', 'message' => mysqli_error($conn)]);
    }
}
?>
