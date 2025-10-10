<?php
// Prevent redefining constants if already defined
if (!defined('DB_HOST')) define('DB_HOST', 'localhost');
if (!defined('DB_USER')) define('DB_USER', 'root');
if (!defined('DB_PASS')) define('DB_PASS', ''); // Add your DB password if any
if (!defined('DB_NAME')) define('DB_NAME', 'final_job_portal_db'); // Your database name

// Create connection only if $conn is not already set
if (!isset($conn)) {
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

    // Check connection
    if ($conn->connect_error) {
        die("Database connection failed: " . $conn->connect_error);
    }

    // Set charset to utf8
    $conn->set_charset("utf8");
}
?>
