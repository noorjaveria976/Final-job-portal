-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 24, 2025 at 10:46 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tefitsm_management_system`
--

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
  `user_role` enum('admin','manager','computer_technician','super_admin') NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_first_name`, `user_last_name`, `user_email`, `user_phone`, `user_gender`, `user_dob`, `user_address`, `user_joining_date`, `user_role`, `password`, `created_at`) VALUES
(1, 'Tanveer', 'Ahmad', 'super.admin@itsm.pk', '030006956496', 'male', '2025-08-20', NULL, '2025-08-14', 'super_admin', '$2y$10$Lhen34VerZrDyQhqBvEiLe2H7EkaJAgoiikPMklpzl4anLvk4LQpi', '2025-08-19 08:36:17'),
(2, 'Tanveer', 'Ahmad', 'tanveer.ahmad@tef.org.pk', '03012345678', 'male', '2025-08-06', NULL, '2025-08-05', 'admin', '$2y$10$8CVNyROXW0GX2rxoda65BOiPVbF6d/udFDS2NQPR3rf6FLnCkd7Fi', '2025-08-19 08:37:19'),
(3, 'sajid', 'sb', 'sajid.manager@tef.org.pk', '0300000000', 'male', '2025-08-07', NULL, '2025-08-14', 'manager', '$2y$10$6d8n3d3pViIp659ia0TkGu.2Abd3WXfQ4D0sYL86r/ua1Xblj9DNq', '2025-08-19 08:39:22'),
(4, 'mister', 'khan', 'khan@gmail.com', '877656757675', 'male', '2025-08-14', NULL, '2025-08-19', 'admin', '$2y$10$.qC3UD6BnGWnW/MP/3MTvOSguLichCv70nXwnBDJwHM14ceCkHR0m', '2025-08-19 08:48:13'),
(5, 'employee2', 'waseem', 'waseem@gmail.com', '6987798', 'male', '2025-08-21', NULL, '2025-08-07', 'computer_technician', '$2y$10$xOCELi6Np0KVSEGe4iuwvewj8MzV6fdQu80tpo.LI6cfM.n9s32Y6', '2025-08-19 09:21:47');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `user_email` (`user_email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
