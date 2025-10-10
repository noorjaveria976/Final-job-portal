<?php
session_start();
include '../config.php';

if (isset($_GET['id'])) {
    $cv_id = intval($_GET['id']);
    $user_id = $_SESSION['user_id'] ?? 0;

    // File name fetch karo delete ke liye
    $result = mysqli_query($conn, "SELECT cv_file FROM cvs WHERE id='$cv_id' AND user_id='$user_id'");
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $file_path = "uploads/cvs/" . $row['cv_file'];

        // Delete DB row
        mysqli_query($conn, "DELETE FROM cvs WHERE id='$cv_id' AND user_id='$user_id'");

        // File ko bhi delete karo agar exist hai
        if (file_exists($file_path)) {
            unlink($file_path);
        }
    }
}

header("Location: ../layout.php?page=seeker_build_resume"); // back to page
exit;
?>
