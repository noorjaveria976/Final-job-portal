<?php
session_start();
include '../config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_SESSION['user_id'])) {
        die("User not logged in.");
    }

    $user_id     = intval($_SESSION['user_id']);  // user id session se lo
    $id          = isset($_POST['project_id']) ? intval($_POST['project_id']) : 0;
    $name        = mysqli_real_escape_string($conn, $_POST['name']);
    $url         = mysqli_real_escape_string($conn, $_POST['url']);
    $date_start  = mysqli_real_escape_string($conn, $_POST['date_start']);
    $date_end    = mysqli_real_escape_string($conn, $_POST['date_end']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);

    $imageName = '';

    // Agar file upload hui hai
    if (!empty($_FILES['image']['name'])) {
        $imageName = time() . "_" . basename($_FILES['image']['name']);
        $target = "uploads/projects/" . $imageName;
        move_uploaded_file($_FILES['image']['tmp_name'], $target);
    }

    if ($id > 0) {
        // Update → sirf ussi project ko update karo jo us user ka hai
        if ($imageName != '') {
            $sql = "UPDATE projects 
                    SET name='$name', url='$url', date_start='$date_start', date_end='$date_end', description='$description', image='$imageName' 
                    WHERE id=$id AND user_id=$user_id";
        } else {
            $sql = "UPDATE projects 
                    SET name='$name', url='$url', date_start='$date_start', date_end='$date_end', description='$description' 
                    WHERE id=$id AND user_id=$user_id";
        }
        mysqli_query($conn, $sql);
    } else {
        // Insert → ab user_id bhi save hoga
        $sql = "INSERT INTO projects (user_id, name, url, date_start, date_end, description, image, created_at) 
                VALUES ('$user_id', '$name', '$url', '$date_start', '$date_end', '$description', '$imageName', NOW())";
        mysqli_query($conn, $sql);
    }

    header("Location: ../layout.php?page=seeker_build_resume");
}
?>
