-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 25, 2025 at 12:51 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `job_portal_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_notifications`
--

CREATE TABLE `admin_notifications` (
  `id` int(11) NOT NULL,
  `job_id` int(11) NOT NULL,
  `provider_id` int(11) NOT NULL,
  `type` enum('job_post','other') DEFAULT 'job_post',
  `status` enum('pending','approved','rejected') DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cvs`
--

CREATE TABLE `cvs` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `cv_file` varchar(255) NOT NULL,
  `is_default` tinyint(1) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cvs`
--

INSERT INTO `cvs` (`id`, `user_id`, `title`, `cv_file`, `is_default`, `created_at`) VALUES
(5, 1, 'Resume', '1757788265-0000.txt', 0, '2025-09-13 18:31:05'),
(6, 1, 'fcgvhjbkn', '1757914201-0000.txt', 0, '2025-09-15 05:30:01'),
(7, 3, 'Resume', '1758554655-0000.txt', 0, '2025-09-22 15:24:15'),
(8, 1, 'job application', '1758737223-0000.txt', 1, '2025-09-24 18:07:03'),
(17, 5, 'resume', '1759469438-Benefits of reading book in Digital era by Mariam Abbas.pdf', 0, '2025-10-03 05:30:38'),
(19, 5, 'dsf', '1760796408-Benefits of reading book in Digital era by Mariam Abbas.pdf', 0, '2025-10-18 14:06:48');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `company_name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `benefits` text DEFAULT NULL,
  `country_name` varchar(255) DEFAULT NULL,
  `state_name` varchar(255) DEFAULT NULL,
  `city_name` varchar(255) DEFAULT NULL,
  `salary_from` decimal(10,2) DEFAULT NULL,
  `salary_to` decimal(10,2) DEFAULT NULL,
  `salary_currency` varchar(10) DEFAULT NULL,
  `salary_period` varchar(255) DEFAULT NULL,
  `hide_salary` tinyint(1) DEFAULT NULL,
  `career_level` varchar(255) DEFAULT NULL,
  `functional_area` varchar(255) DEFAULT NULL,
  `job_type` varchar(255) DEFAULT NULL,
  `job_shift` varchar(255) DEFAULT NULL,
  `num_of_positions` int(11) DEFAULT NULL,
  `gender` varchar(50) DEFAULT NULL,
  `expiry_date` date DEFAULT NULL,
  `degree_level` varchar(255) DEFAULT NULL,
  `job_experience` varchar(255) DEFAULT NULL,
  `is_freelance` tinyint(1) DEFAULT NULL,
  `external_job` enum('yes','no') DEFAULT NULL,
  `job_link` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` enum('Active','Inactive','Rejected','Expired') NOT NULL DEFAULT 'Inactive',
  `notified` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jobs`
--

INSERT INTO `jobs` (`id`, `title`, `company_name`, `description`, `benefits`, `country_name`, `state_name`, `city_name`, `salary_from`, `salary_to`, `salary_currency`, `salary_period`, `hide_salary`, `career_level`, `functional_area`, `job_type`, `job_shift`, `num_of_positions`, `gender`, `expiry_date`, `degree_level`, `job_experience`, `is_freelance`, `external_job`, `job_link`, `created_at`, `status`, `notified`) VALUES
(70, 'Dolore itaque eligen', 'Holloway Anthony Co', 'Rem recusandae Erro', 'Amet iusto voluptat', 'Afghanistan', '', 'Peshawar', '50.00', '98.00', 'KM', 'Monthly', 0, 'Entry Level', 'Management and Manufacturing', 'Internship', 'Third Shift (Night)', 6, 'Female', '2005-05-13', 'Diploma', '2 Years', 0, 'no', '', '2025-09-28 06:00:37', 'Inactive', 0),
(84, 'Nihil consectetur p', 'Allison Rice Traders', 'Labore aperiam magni', 'Temporibus perferend', 'Anguilla', '', 'Islamabad', '51.00', '97.00', '€', 'Monthly', 0, 'Intern/Student', 'Management and Manufacturing', 'Freelance', 'Second Shift (Afternoon)', 13, 'Any', '1979-02-18', 'Masters', '7 Years', 0, 'yes', '', '2025-09-30 08:23:55', 'Inactive', 0),
(85, 'Sunt nihil quisquam', 'Mays and Delaney Trading', 'Veniam ipsum enim m', 'Veniam libero ipsum', 'American Samoa', '', 'Multan', '82.00', '76.00', 'ƒ', 'Yearly', 0, 'Experienced Professional', 'Accounting/Auditing and Finance', 'Freelance', 'First Shift (Day)', 10, 'Male', '2007-05-04', 'MPhil/MS', '4 Years', 0, 'yes', '', '2025-09-30 08:32:24', 'Inactive', 0),
(86, 'Teaching', 'TEF', 'Here is the description...', 'These are the benefits', 'Aruba', NULL, 'Hyderabad', '10000.00', '15000.00', '$', 'Monthly', 0, 'Department Head', 'Accountant', 'Freelance', 'Second Shift (Afternoon)', 11, 'Female', '2025-10-10', 'PHD/Doctorate', 'Less Than 1 Year', 0, 'no', '', '2025-09-30 08:39:39', 'Inactive', 0),
(87, 'Teaching', 'TEF', 'Here is the description...', 'These are the benefits', 'Aruba', NULL, 'Hyderabad', '10000.00', '15000.00', '$', 'Monthly', 0, 'Department Head', 'Accountant', 'Freelance', 'Second Shift (Afternoon)', 11, 'Female', '2025-10-10', 'PHD/Doctorate', 'Less Than 1 Year', 0, 'no', '', '2025-09-30 08:39:51', 'Expired', 1),
(88, 'Do recusandae Beata', 'Craig and Dorsey Plc', 'Nostrum quis consequ', 'Eos excepteur eos a ', 'Afghanistan', NULL, 'Hyderabad', '100.00', '44.00', '﷼', 'Weekly', 0, 'GM / CEO / Country Head / President', 'Accountant', 'Freelance', 'Second Shift (Afternoon)', 14, 'Male', '2011-09-28', 'Bachelors', '3 Years', 0, 'no', '', '2025-09-30 08:40:49', 'Inactive', 0),
(89, 'Professor', 'Holland and Klein Traders', 'Harum ducimus ullam', 'Placeat nesciunt c', 'Aruba', NULL, 'Rawalpindi', '94.00', '49.00', 'Rp', 'Monthly', 0, 'Entry Level', 'Accountant', 'Part Time', 'First Shift (Day)', 3, 'Female', '1982-09-04', 'Certification', '7 Years', 0, 'yes', '', '2025-10-01 06:18:14', 'Expired', 1),
(90, 'Web', 'Rowland and Fox Co', 'Atque neque dicta pa', 'Aliquid sit molesti', 'Anguilla', NULL, 'Karachi', '20.00', '3.00', 'Q', 'Weekly', 0, 'Department Head', 'Advertising', 'Internship', 'Rotating', 8, 'Female', '1997-09-17', 'Diploma', '4 Years', 0, 'no', '', '2025-10-01 06:45:23', 'Expired', 1),
(92, 'Wed developer', 'Ochoa and Sweet Traders', 'Et delectus minim d', 'Sapiente rerum qui e', 'Anguilla', NULL, 'Karachi', '25.00', '59.00', 'ƒ', 'Monthly', 0, 'GM / CEO / Country Head / President', 'Engineering and Information Technology', 'Part Time', 'Second Shift (Afternoon)', 11, 'Any', '2000-01-28', 'MPhil/MS', '6 Years', 0, 'no', '', '2025-10-03 05:22:42', 'Expired', 1),
(93, 'Javeria', 'Marquez and Mckinney Trading', 'Consequatur est eaqu', 'Adipisicing consecte', 'Armenia', '', 'Hyderabad', '37.00', '48.00', 'RD$', 'Weekly', 0, 'Department Head', 'Information Technology', 'Full Time/Permanent', 'Rotating', 5, 'Female', '1997-12-17', 'Matriculation/O-Level', '3 Years', 0, 'no', '', '2025-10-10 11:21:54', 'Expired', 1),
(95, 'jj', 'Golden and Richmond Inc', 'Ullamco eos rerum ip', 'Tempora tempor sed v', 'Andorra', NULL, 'Quetta', '78.00', '22.00', 'Lek', 'Weekly', 0, 'Entry Level', 'Health Care Provider', 'Internship', 'Rotating', 8, 'Any', '2020-09-24', 'Certification', 'Less Than 1 Year', 0, 'no', '', '2025-10-18 14:02:45', 'Inactive', 0),
(97, 'MTBC', 'Talley Chan Inc', 'Quo veniam earum ip', 'Iusto sapiente alias', 'Angola', NULL, 'Karachi', '91.00', '25.00', 'Kč', 'Monthly', 0, 'Department Head', 'Engineering and Information Technology', 'Internship', 'Third Shift (Night)', 7, 'Female', '2018-12-10', 'Non-Matriculation', 'Fresh', 0, 'yes', '', '2025-11-04 06:18:43', 'Expired', 1),
(98, 'web Designning', 'Bradley and Martin Inc', 'Doloremque sint in ', 'Qui id fugiat assu', 'Aruba', '', 'Multan', '22.00', '33.00', 'лв', 'Monthly', 0, 'Experienced Professional', 'Engineering and Information Technology', 'Contract', 'Third Shift (Night)', 9, 'Male', '1994-05-28', 'Non-Matriculation', '2 Years', 0, 'yes', '', '2025-11-25 10:08:55', 'Expired', 1),
(99, 'Graphic Designing', 'TEF', 'It is highly professional job.', 'It is highly demanded job in this era.', 'Australia', '', 'Lahore', '20000.00', '25000.00', '$', 'Monthly', 0, 'Entry Level', 'Accountant', 'Full Time/Permanent', 'Second Shift (Afternoon)', 7, 'Any', '2025-12-26', 'Certification', '3 Years', 0, 'no', '', '2025-12-19 05:23:52', 'Active', 0),
(100, 'Ecommerce', 'House and Dixon Traders', 'For a long time.', 'desirable salary', 'Armenia', '', 'Peshawar', '50000.00', '60000.00', '﷼', 'Weekly', 0, 'Experienced Professional', 'Accounting/Auditing and Finance', 'Freelance', 'Third Shift (Night)', 4, 'Any', '2025-12-30', 'Bachelors', '4 Years', 0, 'no', '', '2025-12-19 07:30:39', 'Active', 1);

-- --------------------------------------------------------

--
-- Table structure for table `job_seeker_appliedjobs`
--

CREATE TABLE `job_seeker_appliedjobs` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `job_id` int(11) NOT NULL,
  `applied_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` enum('Pending','Shortlisted','Accepted','Rejected') DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `job_seeker_appliedjobs`
--

INSERT INTO `job_seeker_appliedjobs` (`id`, `user_id`, `job_id`, `applied_at`, `status`) VALUES
(2, 1, 93, '2025-12-04 06:04:51', 'Pending'),
(3, 1, 97, '2025-12-04 06:07:06', 'Pending'),
(4, 2, 97, '2025-12-04 06:13:10', 'Pending'),
(5, 1, 89, '2025-12-04 07:41:06', 'Pending'),
(6, 1, 90, '2025-12-04 07:48:17', 'Rejected'),
(7, 3, 90, '2025-12-04 07:50:41', ''),
(8, 4, 97, '2025-12-19 05:14:00', '');

-- --------------------------------------------------------

--
-- Table structure for table `job_seeker_education`
--

CREATE TABLE `job_seeker_education` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `degree_level_id` varchar(255) DEFAULT NULL,
  `degree_type_id` varchar(255) DEFAULT NULL,
  `degree_title` varchar(255) DEFAULT NULL,
  `major_subjects` varchar(255) DEFAULT NULL,
  `country_id` varchar(255) DEFAULT NULL,
  `state_id` varchar(255) DEFAULT NULL,
  `city_id` varchar(255) DEFAULT NULL,
  `institution` varchar(255) DEFAULT NULL,
  `date_completion` year(4) DEFAULT NULL,
  `degree_result` varchar(255) DEFAULT NULL,
  `result_type_id` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `job_seeker_education`
--

INSERT INTO `job_seeker_education` (`id`, `user_id`, `degree_level_id`, `degree_type_id`, `degree_title`, `major_subjects`, `country_id`, `state_id`, `city_id`, `institution`, `date_completion`, `degree_result`, `result_type_id`, `created_at`) VALUES
(8, 1, 'Non-Matriculation', 'Arts', 'Inter', NULL, 'Algeria', 'Alabama', 'Lodhran', 'Amina', 2025, 'B', 'Percentage', '2025-09-13 18:26:44'),
(10, 3, 'Intermediate/A-Level', 'Computer', 'Inter', NULL, 'Afghanistan', 'Alabama', 'Lodhran', 'AGDC', 2025, 'A', 'GPA', '2025-09-22 15:29:49'),
(12, 5, 'Intermediate/A-Level', 'Computer', 'Enim ut magnam in el', NULL, 'Algeria', 'Alabama', 'Lodhran', 'Laboris qui elit ip', 2025, 'Architecto ipsam ani', 'GPA', '2025-10-01 01:11:44');

-- --------------------------------------------------------

--
-- Table structure for table `job_seeker_experiences`
--

CREATE TABLE `job_seeker_experiences` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(191) NOT NULL,
  `company` varchar(191) NOT NULL,
  `country` varchar(191) DEFAULT NULL,
  `state` varchar(191) DEFAULT NULL,
  `city` varchar(191) DEFAULT NULL,
  `date_start` date DEFAULT NULL,
  `date_end` date DEFAULT NULL,
  `is_currently_working` tinyint(1) DEFAULT 0,
  `description` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `job_seeker_experiences`
--

INSERT INTO `job_seeker_experiences` (`id`, `user_id`, `title`, `company`, `country`, `state`, `city`, `date_start`, `date_end`, `is_currently_working`, `description`, `created_at`, `updated_at`) VALUES
(8, 1, 'Lecturer', 'AGDC', 'Afghanistan', 'Alabama', 'Arkansas', '2025-09-09', '0000-00-00', 1, 'My experience was very good.', '2025-09-11 17:53:22', '2025-09-15 19:26:30'),
(14, 3, 'Teaching', 'AGDC', 'Afghanistan', 'Kansas', 'Byram', '2025-09-15', '0000-00-00', 1, 'My experience is going too good and impressive...', '2025-09-22 15:28:50', '2025-09-22 15:28:50'),
(16, 5, 'Quidem nostrud conse', 'Morton Doyle Co', 'Bahamas The', 'Illinois', 'Arkansas', '1986-02-03', '2018-01-27', 1, 'Eligendi cumque est', '2025-10-17 15:07:16', '2025-10-17 15:07:16');

-- --------------------------------------------------------

--
-- Table structure for table `job_seeker_languages`
--

CREATE TABLE `job_seeker_languages` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `language` varchar(100) NOT NULL,
  `language_level` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `job_seeker_languages`
--

INSERT INTO `job_seeker_languages` (`id`, `user_id`, `language`, `language_level`, `created_at`) VALUES
(3, 1, 'English', 'Intermediate', '2025-09-13 18:25:42'),
(4, 1, 'Urdu', 'Expert', '2025-09-15 19:47:17'),
(5, 3, 'English', 'Intermediate', '2025-09-22 15:30:41'),
(6, 3, 'Urdu', 'Expert', '2025-09-22 15:31:11'),
(7, 5, 'Punjabi', 'Expert', '2025-10-01 01:10:29');

-- --------------------------------------------------------

--
-- Table structure for table `job_seeker_profiles`
--

CREATE TABLE `job_seeker_profiles` (
  `id` int(11) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `first_name` varchar(100) DEFAULT NULL,
  `last_name` varchar(100) DEFAULT NULL,
  `middle_name` varchar(100) DEFAULT NULL,
  `gender` varchar(20) DEFAULT NULL,
  `marital_status` varchar(20) DEFAULT NULL,
  `country` varchar(100) DEFAULT NULL,
  `state` varchar(100) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `nationality` varchar(100) DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `mobile_num` varchar(50) DEFAULT NULL,
  `street_address` text DEFAULT NULL,
  `job_experience` varchar(50) DEFAULT NULL,
  `career_level` varchar(50) DEFAULT NULL,
  `industry` varchar(100) DEFAULT NULL,
  `functional_area` varchar(100) DEFAULT NULL,
  `salary_currency` varchar(20) DEFAULT NULL,
  `current_salary` varchar(50) DEFAULT NULL,
  `expected_salary` varchar(50) DEFAULT NULL,
  `summary` text DEFAULT NULL,
  `is_subscribed` tinyint(1) DEFAULT 0,
  `profile_image` varchar(255) DEFAULT NULL,
  `cover_images` varchar(255) DEFAULT NULL,
  `status` enum('Pending','Shortlisted','Accepted','Rejected') DEFAULT 'Pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `cv_file` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `job_seeker_profiles`
--

INSERT INTO `job_seeker_profiles` (`id`, `email`, `password`, `first_name`, `last_name`, `middle_name`, `gender`, `marital_status`, `country`, `state`, `city`, `nationality`, `date_of_birth`, `phone`, `mobile_num`, `street_address`, `job_experience`, `career_level`, `industry`, `functional_area`, `salary_currency`, `current_salary`, `expected_salary`, `summary`, `is_subscribed`, `profile_image`, `cover_images`, `status`, `created_at`, `cv_file`) VALUES
(1, 'noorjaveria@gmail.com', NULL, 'Jia', NULL, NULL, 'Female', NULL, 'Necessitatibus proid', NULL, 'Assumenda quia adipi', NULL, '2010-01-31', '+1 (867) 752-8616', NULL, 'Ut voluptatem iste u', '1 Year', 'Ad fuga Amet et la', NULL, NULL, NULL, NULL, NULL, 'Nostrum dignissimos ', 0, '', NULL, 'Pending', '2025-12-04 06:00:51', NULL),
(2, 'zuji@mailinator.com', NULL, 'Ferris', NULL, NULL, 'Female', NULL, 'Fuga Optio vitae r', NULL, 'Reprehenderit duis ', NULL, '1988-01-18', '+1 (703) 957-9322', NULL, 'Quibusdam aute molli', '3 years', 'Deleniti autem sint ', NULL, NULL, NULL, NULL, NULL, 'Dolor cum consequatu', 0, '', NULL, 'Pending', '2025-12-04 06:13:10', NULL),
(3, 'tacopamici@mailinator.com', NULL, 'Javeria', NULL, NULL, 'Female', NULL, 'Facilis eiusmod volu', NULL, 'Autem voluptate labo', NULL, '2012-07-05', '+1 (187) 297-7251', NULL, 'Illum laborum Libe', '5 years', 'Aliquid esse quia se', NULL, NULL, NULL, NULL, NULL, 'Quam deserunt conseq', 0, '', NULL, 'Pending', '2025-12-04 07:50:41', NULL),
(4, 'asadnoor4678@gmail.com', NULL, 'Asad', NULL, NULL, 'Male', NULL, 'Pakistan', NULL, 'Lodhran', NULL, '2025-12-04', '7039579322', NULL, 'sdrhgyresuwsetyioe67iiiiiiiiiii', '3 years', 'Department Head', NULL, NULL, NULL, NULL, NULL, 'I am passionate for this job.', 0, '', NULL, 'Pending', '2025-12-19 05:14:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `job_seeker_skills`
--

CREATE TABLE `job_seeker_skills` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `job_skill` varchar(255) NOT NULL,
  `job_experience` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `job_seeker_skills`
--

INSERT INTO `job_seeker_skills` (`id`, `user_id`, `job_skill`, `job_experience`, `created_at`) VALUES
(2, 1, 'Active listening', 'Fresh', '2025-09-13 07:50:47'),
(3, 1, 'Adobe Photoshop', '4 years', '2025-09-13 18:01:43'),
(4, 1, 'Agile decision-making', '6 years', '2025-09-13 18:18:21'),
(7, 3, 'Adobe Photoshop', '3 years', '2025-09-22 15:30:11'),
(8, 5, 'Active listening', 'Less Than 1 Year', '2025-10-01 01:13:22'),
(9, 5, 'Adaptability skills', 'Less Than 1 Year', '2025-10-17 15:07:53');

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `date_start` date DEFAULT NULL,
  `date_end` date DEFAULT NULL,
  `is_on_going` tinyint(1) DEFAULT 0,
  `description` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`id`, `user_id`, `name`, `image`, `url`, `date_start`, `date_end`, `is_on_going`, `description`, `created_at`) VALUES
(3, 0, 'Portfolio', '1757093254_Screenshot 2024-12-07 013209.png', 'dashboard.php', '2025-09-12', '2025-09-25', 0, 'It is my personal portfolio.', '2025-09-02 17:22:26'),
(5, 0, 'Javeria', '1757091753_Screenshot 2024-11-23 152423.png', '', '2025-09-10', '2025-09-11', 0, '', '2025-09-05 08:07:14'),
(11, 1, 'Dashboard', '1757831135_ctn_04.gif', '', '2025-09-05', '2025-09-16', 0, 'Best of luck!!!', '2025-09-14 05:55:10'),
(14, 3, 'Portfolio', '1758554835_portfolio sample.png', '', '2025-09-09', '2025-09-22', 0, 'Here is my portfolio which shows my unique personality, about, skills, experience and contact.', '2025-09-22 15:27:15'),
(15, 5, 'Dashboard', '1759280292_Screenshot 2025-08-16 111111.png', '', '2025-10-01', '2025-10-01', 0, 'dxfgchvbjnkm', '2025-10-01 00:58:12'),
(16, 5, 'job portal', '1759281747_Screenshot 2025-08-16 111111.png', '', '2025-10-01', '2025-10-01', 0, 'xdfgchvjbkn', '2025-10-01 01:22:27');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_first_name` varchar(100) NOT NULL,
  `user_last_name` varchar(100) NOT NULL,
  `user_email` varchar(150) NOT NULL,
  `user_phone` varchar(20) DEFAULT NULL,
  `user_gender` enum('male','female') NOT NULL,
  `user_dob` date DEFAULT NULL,
  `user_address` text DEFAULT NULL,
  `user_joining_date` date DEFAULT NULL,
  `user_role` enum('admin','HR','assistant HR') NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_first_name`, `user_last_name`, `user_email`, `user_phone`, `user_gender`, `user_dob`, `user_address`, `user_joining_date`, `user_role`, `password`, `created_at`) VALUES
(25, 'Javeria', 'Noor', 'admin@gmail.com', '03006285903', 'female', '2025-10-29', 'Lodhran', '2025-11-27', 'admin', '$2y$10$B3HfYSSB8nKaFKv6SFJHTeahbfXkGMurhf3QzjL46lad/P9O3E9.e', '2025-11-27 08:27:59'),
(26, 'Sana', 'Sattar', 'hr@gmail.com', '03006285903', 'female', '2025-10-28', 'Lodhran', '2025-11-27', 'HR', '$2y$10$k/MN8m3giPeXJWMTWztgf.rOwgxQhtjuZow7dikjMOYOvr02HNiBq', '2025-11-27 08:29:12'),
(27, 'Ansar', 'Ilyas', 'assistant@gmail.com', '03006285903', 'female', '2025-10-28', 'Lodhran', '2025-11-27', 'assistant HR', '$2y$10$4OJW.Upf.cepuu2cv./ugu4ppsfuRd1629ZPKDNJb7T0JF0gz5yiu', '2025-11-27 08:30:07');

-- --------------------------------------------------------

--
-- Table structure for table `user_information`
--

CREATE TABLE `user_information` (
  `id` int(11) NOT NULL,
  `job_id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `id_card` varchar(50) DEFAULT NULL,
  `cover_letter` text DEFAULT NULL,
  `gender` varchar(20) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `education` varchar(100) DEFAULT NULL,
  `skills` varchar(100) DEFAULT NULL,
  `languages` varchar(100) DEFAULT NULL,
  `profile_photo` varchar(255) DEFAULT NULL,
  `cv_file` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` enum('Pending','Shortlisted','Rejected','Accepted') DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_information`
--

INSERT INTO `user_information` (`id`, `job_id`, `name`, `email`, `id_card`, `cover_letter`, `gender`, `location`, `education`, `skills`, `languages`, `profile_photo`, `cv_file`, `created_at`, `status`) VALUES
(30, 77, 'Kelsie Manning', 'mozoji@gmail.com', '3620327200872', 'Facilis ea ea est t', 'Female', 'Lodhran', 'Master', 'Communication', 'Arabic', 'uploads/1759047957_profile_Screenshot_2025-09-17_102309.png', 'uploads/1759047957_cv_CV_of__sana.pdf', '2025-09-28 08:25:57', 'Accepted'),
(34, 81, 'SANA  SATTAR', 'sanasattar057@gmail.com', '3620327200878', '', 'Male', 'Lodhran', 'Bachelor', 'IT', 'English', 'uploads/1759056949_profile_Screenshot_2025-09-17_102309.png', 'uploads/1759056949_cv_CV_of__sana.pdf', '2025-09-28 10:55:49', 'Accepted'),
(35, 80, 'Hayes Herring', 'figagocu@gmail.com', '3620327200873', '', 'Female', 'Lodhran', 'Master', 'Marketing', 'Urdu', 'uploads/1759057001_profile_Screenshot_2025-09-17_102309.png', 'uploads/1759057001_cv_CV_of__sana.pdf', '2025-09-28 10:56:41', 'Accepted'),
(36, 79, 'Willa Sanford', 'pebin@gmail.com', '3620327200872', 'Et iure nostrum dolo', 'Female', 'Explicabo Modi quo ', 'Master', 'IT', 'Urdu', 'uploads/1759057493_profile_Screenshot_2025-09-17_102309.png', 'uploads/1759057493_cv_Dear_Hiring_Manager.docx', '2025-09-28 11:04:53', 'Rejected'),
(37, 81, 'SANA  SATTAR', 'sanasattar@gmail.com', '3620327200872', 'ss', 'Female', 'Lodhran', 'Diploma', 'Communication', 'Urdu', 'uploads/1759133865_profile_Screenshot_2025-09-23_184829.png', 'uploads/1759133865_cv_Dear_Hiring_Manager.docx', '2025-09-29 08:17:45', 'Shortlisted');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cvs`
--
ALTER TABLE `cvs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `job_seeker_appliedjobs`
--
ALTER TABLE `job_seeker_appliedjobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_applied_user` (`user_id`);

--
-- Indexes for table `job_seeker_education`
--
ALTER TABLE `job_seeker_education`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `job_seeker_experiences`
--
ALTER TABLE `job_seeker_experiences`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `job_seeker_languages`
--
ALTER TABLE `job_seeker_languages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `job_seeker_profiles`
--
ALTER TABLE `job_seeker_profiles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `job_seeker_skills`
--
ALTER TABLE `job_seeker_skills`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `user_email` (`user_email`);

--
-- Indexes for table `user_information`
--
ALTER TABLE `user_information`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cvs`
--
ALTER TABLE `cvs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT for table `job_seeker_appliedjobs`
--
ALTER TABLE `job_seeker_appliedjobs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `job_seeker_education`
--
ALTER TABLE `job_seeker_education`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `job_seeker_experiences`
--
ALTER TABLE `job_seeker_experiences`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `job_seeker_languages`
--
ALTER TABLE `job_seeker_languages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `job_seeker_profiles`
--
ALTER TABLE `job_seeker_profiles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `job_seeker_skills`
--
ALTER TABLE `job_seeker_skills`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `user_information`
--
ALTER TABLE `user_information`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `job_seeker_appliedjobs`
--
ALTER TABLE `job_seeker_appliedjobs`
  ADD CONSTRAINT `fk_applied_user` FOREIGN KEY (`user_id`) REFERENCES `job_seeker_profiles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
