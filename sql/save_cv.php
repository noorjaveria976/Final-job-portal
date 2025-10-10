<?php
session_start();
include '../config.php'; // DB connection

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    die("User not logged in.");
}

$user_id = $_SESSION['user_id'];

// Get form data
$title = mysqli_real_escape_string($conn, $_POST['title']);
$is_default = isset($_POST['is_default']) ? (int)$_POST['is_default'] : 0;

// Handle file upload if available
$cv_file_name = '';
if (isset($_FILES['cv_file']) && $_FILES['cv_file']['error'] == 0) {
    $target_dir = "uploads/cvs/";
    if (!is_dir($target_dir)) {
        mkdir($target_dir, 0777, true);
    }

    $file_name = time() . "-" . basename($_FILES["cv_file"]["name"]);
    $target_file = $target_dir . $file_name;

    if (move_uploaded_file($_FILES["cv_file"]["tmp_name"], $target_file)) {
        $cv_file_name = $file_name;
    } else {
        die("Error uploading file.");
    }
}

// If is_default = 1, reset previous default CV
if ($is_default == 1) {
    mysqli_query($conn, "UPDATE cvs SET is_default = 0 WHERE user_id = '$user_id'");
}

// ===========================
// INSERT or UPDATE logic here
// ===========================
if (isset($_POST['cv_id']) && !empty($_POST['cv_id'])) {
    // UPDATE query
    $cv_id = intval($_POST['cv_id']);

    if (!empty($cv_file_name)) {
        // If new file uploaded, update file too
        $sql = "UPDATE cvs 
                SET title='$title', cv_file='$cv_file_name', is_default='$is_default' 
                WHERE id='$cv_id' AND user_id='$user_id'";
    } else {
        // If no new file uploaded, keep old file
        $sql = "UPDATE cvs 
                SET title='$title', is_default='$is_default' 
                WHERE id='$cv_id' AND user_id='$user_id'";
    }

    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('CV updated successfully!'); window.location.href='../layout.php?page=seeker_build_resume';</script>";
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }

} else {
    // INSERT query
    if (empty($cv_file_name)) {
        die("No file selected.");
    }

    $sql = "INSERT INTO cvs (user_id, title, cv_file, is_default, created_at) 
            VALUES ('$user_id', '$title', '$cv_file_name', '$is_default', NOW())";

    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('CV uploaded successfully!'); window.location.href='../layout.php?page=seeker_build_resume';</script>";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>
