<?php
include('auth.php');

// Default page
$page = $_GET['page'] ?? 'dashboard';
$page = basename($page);
$file = "pages/{$page}.php";

// Default title
$pageTitle = "ITSM";

// ✅ Agar page exist karta hai to usko ek dafa include karo, sirf title nikalne ke liye
if (file_exists($file)) {
    // Output buffer start
    ob_start();
    include($file);
    $pageContent = ob_get_clean();

    // Agar page ne $pageTitle set kiya hai to wahi use karo
    if (isset($pageTitle) && $pageTitle !== "ITSM") {
        $finalTitle = $pageTitle;
    } else {
        $finalTitle = "ITSM";
    }
} else {
    $finalTitle = "404 - Page Not Found";
    $pageContent = "    <div class='text-center'>
        <h2>404 - Page Not Found</h2>
    </div>";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title><?php echo $finalTitle; ?> | ITSM</title>
    <?php include_once('include/html-sources.html'); ?>
</head>

<body>
    <div class="loader"></div>
    <div id="app">
        <div class="main-wrapper main-wrapper-1">
            <div class="navbar-bg"></div>

            <!-- Topbar -->
            <?php include_once('include/topbar.php'); ?>

            <!-- Sidebar -->
            <?php include_once('include/sidebar.php'); ?>

            <!-- Main Content -->
            <div class="main-content">
                <?php echo $pageContent; ?>
                <?php include_once('include/settingSidebar.php'); ?>
            </div>

            <!-- Footer -->
            <?php include_once('include/footer.php'); ?>
        </div>
    </div>

    <!-- Feather Icons Script -->
    <script>
        feather.replace();
    </script>
</body>

</html>
<?php include_once('include/js-sources.html'); ?>