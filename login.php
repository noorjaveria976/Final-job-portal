<?php
// Start session and include database config
session_start();
include('config.php');

$error = '';

if (isset($_POST['login-user'])) {
    $email = trim($_POST['user_email']);
    $password = trim($_POST['user_password']);

    // Prepared statement to fetch user by email
    $stmt = $conn->prepare("SELECT user_id, user_first_name, user_last_name, user_email, user_phone, user_gender, user_dob, user_joining_date, user_role, password FROM users WHERE user_email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($user_id, $user_first_name, $user_last_name, $user_email, $user_phone, $user_gender, $user_dob, $user_joining_date, $user_role, $hashed_password);
        $stmt->fetch();

        if (password_verify($password, $hashed_password)) {
            // Password correct, start session
            $_SESSION['user_id'] = $user_id;
            $_SESSION['user_first_name'] = $user_first_name;
            $_SESSION['user_last_name'] = $user_last_name;
            $_SESSION['user_email'] = $user_email;
            $_SESSION['user_phone'] = $user_phone;
            $_SESSION['user_gender'] = $user_gender;
            $_SESSION['user_dob'] = $user_dob;
            $_SESSION['user_joining_date'] = $user_joining_date;
            $_SESSION['user_role'] = $user_role;

            // Redirect to dashboard
            header("Location: layout.php");
            // header("Location: auth/admin");
            exit();
        } else {
            $error = "Email or password are incorrect";
        }
    } else {
        $error = "Email or password are not register";
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Login</title>

    <!-- General CSS Files -->
    <link rel="stylesheet" href="assets/css/app.min.css">
    <link rel="stylesheet" href="assets/bundles/bootstrap-social/bootstrap-social.css">

    <!-- Template CSS -->
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/components.css">

    <!-- Custom style CSS -->
    <link rel="stylesheet" href="assets/css/custom.css">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico" />
</head>

<body>
    <div id="app">
        <section class="section">
            <div class="container mt-5">
                <div class="row">
                    <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h4>Login</h4>
                            </div>
                            <div class="card-body">
                                <?php if (!empty($error)) : ?>
                                    <div class="alert alert-danger">
                                        <?= $error; ?>
                                    </div>
                                <?php endif; ?>

                                <form method="POST" action="#" class="needs-validation">
                                    <div class="form-group">
                                        <label for="email">Email:</label>
                                        <input id="email" type="email" class="form-control" name="user_email" tabindex="1" required autofocus>
                                        <div class="invalid-feedback">
                                            Please fill in your email
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="d-block">
                                            <label for="password" class="control-label">Password:</label>
                                            <div class="float-right">
                                                <a href="#" class="text-small">Forgot Password?</a>
                                            </div>
                                        </div>
                                        <input id="password" type="password" class="form-control" name="user_password" tabindex="2" required>
                                        <div class="invalid-feedback">
                                            Please fill in your password
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" name="remember" class="custom-control-input" tabindex="3" id="remember-me">
                                            <label class="custom-control-label" for="remember-me">Remember Me</label>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4" name="login-user">
                                            Login
                                        </button>
                                    </div>
                                   <div class="text-center"> <a href="user_register.php">Register</a></div>
                                </form>
                            </div> <!-- card-body -->
                        </div> <!-- card -->
                    </div> <!-- col -->
                </div> <!-- row -->
            </div> <!-- container -->
        </section>
    </div> <!-- app -->

    <!-- JS Scripts -->
    <script src="assets/js/app.min.js"></script>
    <script src="assets/js/scripts.js"></script>
    <script src="assets/js/custom.js"></script>
</body>

</html>