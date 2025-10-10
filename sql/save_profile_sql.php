<?php
session_start();
include '../config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_POST['user_id'];

    // Sanitize text inputs
    $email          = mysqli_real_escape_string($conn, $_POST['email']);
    $password       = mysqli_real_escape_string($conn, $_POST['password']);
    $first_name     = mysqli_real_escape_string($conn, $_POST['first_name']);
    $last_name      = mysqli_real_escape_string($conn, $_POST['last_name']);
    $middle_name    = mysqli_real_escape_string($conn, $_POST['middle_name']);
    $gender         = mysqli_real_escape_string($conn, $_POST['gender']);
    $marital_status = mysqli_real_escape_string($conn, $_POST['marital_status']);
    $country        = mysqli_real_escape_string($conn, $_POST['country']);
    $state          = mysqli_real_escape_string($conn, $_POST['state']);
    $city           = mysqli_real_escape_string($conn, $_POST['city']);
    $nationality    = mysqli_real_escape_string($conn, $_POST['nationality']);
    $date_of_birth  = mysqli_real_escape_string($conn, $_POST['date_of_birth']);
    $phone          = mysqli_real_escape_string($conn, $_POST['phone']);
    $mobile_num     = mysqli_real_escape_string($conn, $_POST['mobile_num']);
    $street_address = mysqli_real_escape_string($conn, $_POST['street_address']);
    $job_experience = mysqli_real_escape_string($conn, $_POST['job_experience']);
    $career_level   = mysqli_real_escape_string($conn, $_POST['career_level']);
    $industry       = mysqli_real_escape_string($conn, $_POST['industry']);
    $functional_area= mysqli_real_escape_string($conn, $_POST['functional_area']);
    $salary_currency= mysqli_real_escape_string($conn, $_POST['salary_currency']);
    $current_salary = mysqli_real_escape_string($conn, $_POST['current_salary']);
    $expected_salary= mysqli_real_escape_string($conn, $_POST['expected_salary']);
    $summary        = mysqli_real_escape_string($conn, $_POST['summary']);
    $is_subscribed  = isset($_POST['is_subscribed']) ? 1 : 0;

    // Handle Profile Image Upload
    $profile_image = "";
    if (!empty($_FILES['image']['name'])) {
        $profile_image = time() . "_" . basename($_FILES['image']['name']);
        $target = "uploads/profile/" . $profile_image;
        move_uploaded_file($_FILES['image']['tmp_name'], $target);
    }

    // Handle Cover Image Upload
    $cover_image = "";
    if (!empty($_FILES['cover_image']['name'])) {
        $cover_image = time() . "_" . basename($_FILES['cover_image']['name']);
        $target = "uploads/cover/" . $cover_image;
        move_uploaded_file($_FILES['cover_image']['tmp_name'], $target);
    }

    // Check if user profile exists
    $check = mysqli_query($conn, "SELECT id FROM job_seeker_profiles WHERE user_id='$user_id' LIMIT 1");

    if (mysqli_num_rows($check) > 0) {
        // UPDATE existing record
        $update = "UPDATE job_seeker_profiles SET
            email='$email',
            password='$password',
            first_name='$first_name',
            last_name='$last_name',
            middle_name='$middle_name',
            gender='$gender',
            marital_status='$marital_status',
            country='$country',
            state='$state',
            city='$city',
            nationality='$nationality',
            date_of_birth='$date_of_birth',
            phone='$phone',
            mobile_num='$mobile_num',
            street_address='$street_address',
            job_experience='$job_experience',
            career_level='$career_level',
            industry='$industry',
            functional_area='$functional_area',
            salary_currency='$salary_currency',
            current_salary='$current_salary',
            expected_salary='$expected_salary',
            summary='$summary',
            is_subscribed='$is_subscribed'";

        // Update images only if new uploaded
        if (!empty($profile_image)) {
            $update .= ", profile_image='$profile_image'";
        }
        if (!empty($cover_image)) {
            $update .= ", cover_images='$cover_image'";
        }

        $update .= " WHERE user_id='$user_id'";

        $query = mysqli_query($conn, $update);
        $msg = $query ? "Profile Updated Successfully!" : "Error updating profile!";
    } else {
        // INSERT new record
        $insert = "INSERT INTO job_seeker_profiles (
            user_id, email, password, first_name, last_name, middle_name, gender, marital_status,
            country, state, city, nationality, date_of_birth, phone, mobile_num, street_address,
            job_experience, career_level, industry, functional_area, salary_currency,
            current_salary, expected_salary, summary, is_subscribed, profile_image, cover_images, created_at
        ) VALUES (
            '$user_id', '$email', '$password', '$first_name', '$last_name', '$middle_name', '$gender', '$marital_status',
            '$country', '$state', '$city', '$nationality', '$date_of_birth', '$phone', '$mobile_num', '$street_address',
            '$job_experience', '$career_level', '$industry', '$functional_area', '$salary_currency',
            '$current_salary', '$expected_salary', '$summary', '$is_subscribed', '$profile_image', '$cover_image', NOW()
        )";

        $query = mysqli_query($conn, $insert);
        $msg = $query ? "Profile Created Successfully!" : "Error saving profile!";
    }

    echo "<script>alert('$msg'); window.location='my_profile.php';</script>";
}
?>
