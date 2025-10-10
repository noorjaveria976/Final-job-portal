-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 10, 2025 at 01:32 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `final_job_portal_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_blogs`
--

CREATE TABLE `admin_blogs` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `blog_date` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_blogs`
--

INSERT INTO `admin_blogs` (`id`, `title`, `content`, `image`, `blog_date`, `created_at`) VALUES
(1, 'gfdsa', 'GFDSqa', 'uploads/admin_blogs/1757508919_WhatsApp Image 2025-05-25 at 07.42.23_10f205e6.jpg', '2025-09-10', '2025-09-10 12:55:19');

-- --------------------------------------------------------

--
-- Table structure for table `admin_career_levels`
--

CREATE TABLE `admin_career_levels` (
  `id` int(11) NOT NULL,
  `language` varchar(100) NOT NULL,
  `career_level` varchar(150) NOT NULL,
  `status` enum('Active','Inactive','Pending') NOT NULL DEFAULT 'Active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_career_levels`
--

INSERT INTO `admin_career_levels` (`id`, `language`, `career_level`, `status`, `created_at`) VALUES
(1, 'English', 'fds', 'Active', '2025-09-10 15:08:21'),
(2, 'English', 'gfd', 'Active', '2025-09-10 16:21:06');

-- --------------------------------------------------------

--
-- Table structure for table `admin_companies`
--

CREATE TABLE `admin_companies` (
  `id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `industry` varchar(100) NOT NULL,
  `contact_person` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `website` varchar(200) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `status` enum('Active','Inactive','Pending') DEFAULT 'Active',
  `logo` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_companies`
--

INSERT INTO `admin_companies` (`id`, `name`, `industry`, `contact_person`, `email`, `phone`, `website`, `address`, `status`, `logo`, `created_at`, `updated_at`) VALUES
(1, 'Multimedia Design', 'Laboriosam quis est', 'Sana  Sattar', 'sanasattar057@gmail.com', '03367610382', 'http://www.comapnydomain.com', 'House No:24 ,11MPR,Gailly wala Lodhran, Punjab, Pakistan', 'Active', '1757507520_logo.jpg', '2025-09-10 12:32:00', '2025-09-10 12:34:21'),
(4, 'Multimedia Design', 'Laboriosam quis est', 'Sana  Sattar', 'sanasattar05@gmail.com', '03367610382', 'http://www.comapnydomain.com', 'House No:24 ,11MPR,Gailly wala Lodhran, Punjab, Pakistan', 'Pending', '1757507834_logo.jpg', '2025-09-10 12:37:14', '2025-09-10 12:37:14');

-- --------------------------------------------------------

--
-- Table structure for table `admin_countries`
--

CREATE TABLE `admin_countries` (
  `id` int(11) NOT NULL,
  `country` varchar(100) NOT NULL,
  `iso_code` varchar(10) NOT NULL,
  `status` enum('Active','Inactive') DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `admin_degree_levels`
--

CREATE TABLE `admin_degree_levels` (
  `id` int(11) NOT NULL,
  `degree_name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_degree_levels`
--

INSERT INTO `admin_degree_levels` (`id`, `degree_name`, `description`, `status`) VALUES
(1, 'gfds', ' bvcxz', 0),
(3, 'cxzxz', 'dsa', 1);

-- --------------------------------------------------------

--
-- Table structure for table `admin_degree_types`
--

CREATE TABLE `admin_degree_types` (
  `id` int(11) NOT NULL,
  `degree_type` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `status` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `admin_employer_packages`
--

CREATE TABLE `admin_employer_packages` (
  `id` int(11) NOT NULL,
  `package_name` varchar(150) NOT NULL,
  `job_posts` int(11) NOT NULL,
  `duration` varchar(50) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `highlight` tinyint(1) DEFAULT 0,
  `urgent` tinyint(1) DEFAULT 0,
  `support` tinyint(1) DEFAULT 0,
  `status` enum('Active','Inactive') DEFAULT 'Active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_employer_packages`
--

INSERT INTO `admin_employer_packages` (`id`, `package_name`, `job_posts`, `duration`, `price`, `highlight`, `urgent`, `support`, `status`, `created_at`) VALUES
(1, 'ds', 32, '12 Days', 432.00, 0, 1, 0, 'Active', '2025-09-10 14:35:37'),
(2, 'fdsa', 4321, '12 Days', 432.00, 0, 1, 0, 'Active', '2025-09-10 14:38:45');

-- --------------------------------------------------------

--
-- Table structure for table `admin_faqs`
--

CREATE TABLE `admin_faqs` (
  `id` int(11) NOT NULL,
  `question` text NOT NULL,
  `answer` text NOT NULL,
  `last_updated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_faqs`
--

INSERT INTO `admin_faqs` (`id`, `question`, `answer`, `last_updated`) VALUES
(2, '<p>hgfdsaq&nbsp;&nbsp;&nbsp;&nbsp;</p>', '<p>HGFDSA</p>', '2025-09-10 12:53:25');

-- --------------------------------------------------------

--
-- Table structure for table `admin_functional_areas`
--

CREATE TABLE `admin_functional_areas` (
  `id` int(11) NOT NULL,
  `functional_area` varchar(150) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL DEFAULT 'Active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_functional_areas`
--

INSERT INTO `admin_functional_areas` (`id`, `functional_area`, `status`, `created_at`) VALUES
(2, 'Information Technology', 'Inactive', '2025-09-10 16:30:29');

-- --------------------------------------------------------

--
-- Table structure for table `admin_genders`
--

CREATE TABLE `admin_genders` (
  `id` int(11) NOT NULL,
  `gender_name` varchar(50) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_genders`
--

INSERT INTO `admin_genders` (`id`, `gender_name`, `status`, `created_at`) VALUES
(1, 'Male', 0, '2025-09-10 16:36:05'),
(2, 'Male', 1, '2025-09-10 16:51:33');

-- --------------------------------------------------------

--
-- Table structure for table `admin_industries`
--

CREATE TABLE `admin_industries` (
  `id` int(11) NOT NULL,
  `industry_name` varchar(150) NOT NULL,
  `industry_desc` text DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_industries`
--

INSERT INTO `admin_industries` (`id`, `industry_name`, `industry_desc`, `status`, `created_at`) VALUES
(3, 'gfdsad', 'dfgh', 1, '2025-09-10 17:06:15');

-- --------------------------------------------------------

--
-- Table structure for table `admin_job_attributes`
--

CREATE TABLE `admin_job_attributes` (
  `id` int(11) NOT NULL,
  `attribute_name` varchar(255) NOT NULL,
  `attribute_value` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_job_attributes`
--

INSERT INTO `admin_job_attributes` (`id`, `attribute_name`, `attribute_value`, `status`, `created_at`) VALUES
(2, 'fd', 'fdsa', 1, '2025-09-10 14:53:53');

-- --------------------------------------------------------

--
-- Table structure for table `admin_job_experience`
--

CREATE TABLE `admin_job_experience` (
  `id` int(11) NOT NULL,
  `experience_title` varchar(255) NOT NULL,
  `experience_desc` text DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_job_experience`
--

INSERT INTO `admin_job_experience` (`id`, `experience_title`, `experience_desc`, `status`, `created_at`) VALUES
(2, 'hgfds', 'jhgfds', 0, '2025-09-10 17:16:22'),
(3, 'hgfds', 'jhgfds', 1, '2025-09-10 17:16:32'),
(4, 'trer', 'tre', 1, '2025-09-10 17:18:38'),
(2, 'hgfds', 'jhgfds', 0, '2025-09-10 17:16:22'),
(3, 'hgfds', 'jhgfds', 1, '2025-09-10 17:16:32'),
(4, 'trer', 'tre', 1, '2025-09-10 17:18:38'),
(2, 'hgfds', 'jhgfds', 0, '2025-09-10 17:16:22'),
(3, 'hgfds', 'jhgfds', 1, '2025-09-10 17:16:32'),
(4, 'trer', 'tre', 1, '2025-09-10 17:18:38'),
(2, 'hgfds', 'jhgfds', 0, '2025-09-10 17:16:22'),
(3, 'hgfds', 'jhgfds', 1, '2025-09-10 17:16:32'),
(4, 'trer', 'tre', 1, '2025-09-10 17:18:38'),
(2, 'hgfds', 'jhgfds', 0, '2025-09-10 17:16:22'),
(3, 'hgfds', 'jhgfds', 1, '2025-09-10 17:16:32'),
(4, 'trer', 'tre', 1, '2025-09-10 17:18:38');

-- --------------------------------------------------------

--
-- Table structure for table `admin_job_shifts`
--

CREATE TABLE `admin_job_shifts` (
  `id` int(11) NOT NULL,
  `shift_name` varchar(100) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_job_shifts`
--

INSERT INTO `admin_job_shifts` (`id`, `shift_name`, `status`, `created_at`) VALUES
(4, 'fgh', 1, '2025-09-10 18:36:25'),
(5, 'cxzCXZ', 0, '2025-09-10 18:51:07'),
(4, 'fgh', 1, '2025-09-10 18:36:25'),
(5, 'cxzCXZ', 0, '2025-09-10 18:51:07'),
(4, 'fgh', 1, '2025-09-10 18:36:25'),
(5, 'cxzCXZ', 0, '2025-09-10 18:51:07'),
(4, 'fgh', 1, '2025-09-10 18:36:25'),
(5, 'cxzCXZ', 0, '2025-09-10 18:51:07'),
(4, 'fgh', 1, '2025-09-10 18:36:25'),
(5, 'cxzCXZ', 0, '2025-09-10 18:51:07');

-- --------------------------------------------------------

--
-- Table structure for table `admin_job_skills`
--

CREATE TABLE `admin_job_skills` (
  `id` int(11) NOT NULL,
  `skill_name` varchar(255) NOT NULL,
  `category` varchar(100) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_job_skills`
--

INSERT INTO `admin_job_skills` (`id`, `skill_name`, `category`, `status`, `created_at`) VALUES
(1, 'gfdsfds', 'Frontend', 0, '2025-09-10 17:26:42'),
(2, 'gfdsfds', 'Frontend', 1, '2025-09-10 17:28:15'),
(1, 'gfdsfds', 'Frontend', 0, '2025-09-10 17:26:42'),
(2, 'gfdsfds', 'Frontend', 1, '2025-09-10 17:28:15'),
(1, 'gfdsfds', 'Frontend', 0, '2025-09-10 17:26:42'),
(2, 'gfdsfds', 'Frontend', 1, '2025-09-10 17:28:15'),
(1, 'gfdsfds', 'Frontend', 0, '2025-09-10 17:26:42'),
(2, 'gfdsfds', 'Frontend', 1, '2025-09-10 17:28:15'),
(1, 'gfdsfds', 'Frontend', 0, '2025-09-10 17:26:42'),
(2, 'gfdsfds', 'Frontend', 1, '2025-09-10 17:28:15');

-- --------------------------------------------------------

--
-- Table structure for table `admin_job_titles`
--

CREATE TABLE `admin_job_titles` (
  `id` int(11) NOT NULL,
  `job_title` varchar(255) NOT NULL,
  `industry` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_job_titles`
--

INSERT INTO `admin_job_titles` (`id`, `job_title`, `industry`, `status`, `created_at`) VALUES
(2, 'bgfvdcgfds', 'bvcxzc', 1, '2025-09-10 17:35:41'),
(3, 'hgfds', 'hgfdess', 0, '2025-09-10 17:41:53'),
(4, 'GFH', 'fgh', 0, '2025-09-10 17:48:32'),
(2, 'bgfvdcgfds', 'bvcxzc', 1, '2025-09-10 17:35:41'),
(3, 'hgfds', 'hgfdess', 0, '2025-09-10 17:41:53'),
(4, 'GFH', 'fgh', 0, '2025-09-10 17:48:32'),
(2, 'bgfvdcgfds', 'bvcxzc', 1, '2025-09-10 17:35:41'),
(3, 'hgfds', 'hgfdess', 0, '2025-09-10 17:41:53'),
(4, 'GFH', 'fgh', 0, '2025-09-10 17:48:32'),
(2, 'bgfvdcgfds', 'bvcxzc', 1, '2025-09-10 17:35:41'),
(3, 'hgfds', 'hgfdess', 0, '2025-09-10 17:41:53'),
(4, 'GFH', 'fgh', 0, '2025-09-10 17:48:32'),
(2, 'bgfvdcgfds', 'bvcxzc', 1, '2025-09-10 17:35:41'),
(3, 'hgfds', 'hgfdess', 0, '2025-09-10 17:41:53'),
(4, 'GFH', 'fgh', 0, '2025-09-10 17:48:32');

-- --------------------------------------------------------

--
-- Table structure for table `admin_job_types`
--

CREATE TABLE `admin_job_types` (
  `id` int(11) NOT NULL,
  `job_type` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `status` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_job_types`
--

INSERT INTO `admin_job_types` (`id`, `job_type`, `description`, `status`) VALUES
(2, 'gfds', 'dwsa', 1),
(2, 'gfds', 'dwsa', 1),
(2, 'gfds', 'dwsa', 1),
(2, 'gfds', 'dwsa', 1),
(2, 'gfds', 'dwsa', 1);

-- --------------------------------------------------------

--
-- Table structure for table `admin_language_levels`
--

CREATE TABLE `admin_language_levels` (
  `id` int(11) NOT NULL,
  `language_code` varchar(100) NOT NULL,
  `level` varchar(100) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_language_levels`
--

INSERT INTO `admin_language_levels` (`id`, `language_code`, `level`, `status`, `created_at`) VALUES
(1, 'gfdsgfddsa', 'gfds', 1, '2025-09-10 15:00:18'),
(1, 'gfdsgfddsa', 'gfds', 1, '2025-09-10 15:00:18'),
(1, 'gfdsgfddsa', 'gfds', 1, '2025-09-10 15:00:18'),
(1, 'gfdsgfddsa', 'gfds', 1, '2025-09-10 15:00:18'),
(1, 'gfdsgfddsa', 'gfds', 1, '2025-09-10 15:00:18');

-- --------------------------------------------------------

--
-- Table structure for table `admin_major_subjects`
--

CREATE TABLE `admin_major_subjects` (
  `id` int(11) NOT NULL,
  `subject_name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `status` tinyint(1) DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_major_subjects`
--

INSERT INTO `admin_major_subjects` (`id`, `subject_name`, `description`, `status`, `created_at`) VALUES
(2, 'fvdcxsz', 'fdsa', 0, '2025-09-10 19:55:57'),
(2, 'fvdcxsz', 'fdsa', 0, '2025-09-10 19:55:57'),
(2, 'fvdcxsz', 'fdsa', 0, '2025-09-10 19:55:57'),
(2, 'fvdcxsz', 'fdsa', 0, '2025-09-10 19:55:57'),
(2, 'fvdcxsz', 'fdsa', 0, '2025-09-10 19:55:57');

-- --------------------------------------------------------

--
-- Table structure for table `admin_manage_location`
--

CREATE TABLE `admin_manage_location` (
  `id` int(11) NOT NULL,
  `country` varchar(100) NOT NULL,
  `iso_code` varchar(10) NOT NULL,
  `state` varchar(100) NOT NULL,
  `city` varchar(100) NOT NULL,
  `status` enum('Active','Inactive') DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_manage_location`
--

INSERT INTO `admin_manage_location` (`id`, `country`, `iso_code`, `state`, `city`, `status`) VALUES
(6, 'Pakistan', 'PAK', 'lfgh', 'Lodhran', 'Active'),
(7, 'Pakistan', 'PAK', 'l', 'Lodhran', 'Active'),
(6, 'Pakistan', 'PAK', 'lfgh', 'Lodhran', 'Active'),
(7, 'Pakistan', 'PAK', 'l', 'Lodhran', 'Active'),
(6, 'Pakistan', 'PAK', 'lfgh', 'Lodhran', 'Active'),
(7, 'Pakistan', 'PAK', 'l', 'Lodhran', 'Active'),
(6, 'Pakistan', 'PAK', 'lfgh', 'Lodhran', 'Active'),
(7, 'Pakistan', 'PAK', 'l', 'Lodhran', 'Active'),
(6, 'Pakistan', 'PAK', 'lfgh', 'Lodhran', 'Active'),
(7, 'Pakistan', 'PAK', 'l', 'Lodhran', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `admin_marital_status`
--

CREATE TABLE `admin_marital_status` (
  `id` int(11) NOT NULL,
  `status_name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
-- Table structure for table `admin_portal_users`
--

CREATE TABLE `admin_portal_users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','jobseeker','jobprovider') NOT NULL,
  `status` enum('active','inactive') DEFAULT 'inactive',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_portal_users`
--

INSERT INTO `admin_portal_users` (`id`, `name`, `email`, `password`, `role`, `status`, `created_at`) VALUES
(1, 'Super Admin', 'admin@gmail.com', '123', 'admin', 'active', '2025-09-12 12:57:05'),
(1, 'Super Admin', 'admin@gmail.com', '123', 'admin', 'active', '2025-09-12 12:57:05'),
(1, 'Super Admin', 'admin@gmail.com', '123', 'admin', 'active', '2025-09-12 12:57:05'),
(1, 'Super Admin', 'admin@gmail.com', '123', 'admin', 'active', '2025-09-12 12:57:05'),
(1, 'Super Admin', 'admin@gmail.com', '123', 'admin', 'active', '2025-09-12 12:57:05');

-- --------------------------------------------------------

--
-- Table structure for table `admin_result_grades`
--

CREATE TABLE `admin_result_grades` (
  `id` int(11) NOT NULL,
  `grade_name` varchar(10) NOT NULL,
  `min_percent` int(11) NOT NULL,
  `max_percent` int(11) NOT NULL,
  `description` text DEFAULT NULL,
  `status` tinyint(1) DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_result_grades`
--

INSERT INTO `admin_result_grades` (`id`, `grade_name`, `min_percent`, `max_percent`, `description`, `status`, `created_at`) VALUES
(5, 'rewqfg', 543, 5432, '543', 1, '2025-09-10 20:14:22'),
(5, 'rewqfg', 543, 5432, '543', 1, '2025-09-10 20:14:22');

-- --------------------------------------------------------

--
-- Table structure for table `admin_seo_pages`
--

CREATE TABLE `admin_seo_pages` (
  `id` int(11) NOT NULL,
  `page_name` varchar(150) NOT NULL,
  `slug` varchar(150) NOT NULL,
  `meta_title` varchar(255) NOT NULL,
  `meta_description` text DEFAULT NULL,
  `keywords` varchar(255) DEFAULT NULL,
  `last_updated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_seo_pages`
--

INSERT INTO `admin_seo_pages` (`id`, `page_name`, `slug`, `meta_title`, `meta_description`, `keywords`, `last_updated`) VALUES
(4, 'hgfdsahgfdsa', 'jhgfdsa', 'gfdsa', 'hgfdsa', 'gfdsa', '2025-09-10 12:49:37');

-- --------------------------------------------------------

--
-- Table structure for table `admin_site_languages`
--

CREATE TABLE `admin_site_languages` (
  `id` int(11) NOT NULL,
  `language_name` varchar(100) NOT NULL,
  `language_code` varchar(10) NOT NULL,
  `flag` varchar(255) DEFAULT NULL,
  `status` enum('Active','Inactive') DEFAULT 'Active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_site_languages`
--

INSERT INTO `admin_site_languages` (`id`, `language_name`, `language_code`, `flag`, `status`, `created_at`, `updated_at`) VALUES
(2, 'ngfds', 'mbnfds', 'uploads/flags/1757511725.png', 'Active', '2025-09-10 13:42:05', '2025-09-10 13:42:05');

-- --------------------------------------------------------

--
-- Table structure for table `admin_system_users`
--

CREATE TABLE `admin_system_users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','jobseeker','jobprovider') NOT NULL,
  `status` enum('Active','Inactive') NOT NULL DEFAULT 'Active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_system_users`
--

INSERT INTO `admin_system_users` (`id`, `name`, `email`, `password`, `role`, `status`, `created_at`) VALUES
(33, 'Sana Sattar', 'admin123@gmail.com', '$2y$10$jPD.Cgl3OIJti7C5hAfry.qswxQwRrk5.AFy0rz5k9Tw7.Cwm1UlK', 'admin', 'Active', '2025-09-16 06:46:50'),
(34, 'Sana', 'admin@gmail.com', '$2y$10$G1ouPuwPVPW3gUo8QbIyd.YvXx6dweKA8A9HfT37MVUfD.VtEmm6S', 'admin', 'Inactive', '2025-09-16 06:50:08'),
(37, 'JobProvider', 'provider123@gmail.com', '$2y$10$LjJxr7muE51Ar1Jng6.9NuvL9nJCBrcs7syhWDD26D69k25RPma5m', 'jobprovider', 'Active', '2025-09-16 06:57:15'),
(38, 'seeker', 'seeker123@gmail.com', '$2y$10$/S4ZHD9gWRO3n/fAp8N64uVQ1mSfKvipd13VUhVsGCanLd59qfIjK', 'jobseeker', 'Active', '2025-09-16 06:57:56');

-- --------------------------------------------------------

--
-- Table structure for table `admin_testimonials`
--

CREATE TABLE `admin_testimonials` (
  `id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `review` text NOT NULL,
  `review_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_testimonials`
--

INSERT INTO `admin_testimonials` (`id`, `name`, `image`, `review`, `review_date`) VALUES
(4, 'jhgfdsagfdsafvdcZXA', '1757510949_13.png', 'JHGFDSAq', '2025-09-12');

-- --------------------------------------------------------

--
-- Table structure for table `admin_users`
--

CREATE TABLE `admin_users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','jobseeker','jobprovider') NOT NULL DEFAULT 'admin',
  `status` enum('Active','Inactive') DEFAULT 'Active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_users`
--

INSERT INTO `admin_users` (`id`, `name`, `email`, `password`, `role`, `status`, `created_at`) VALUES
(37, 'SANA  SATTAR', 'fd@gmail.com', '$2y$10$LaagzLKdCPSTENHlT8rl5.L5yWz7CgVsF..Awri6Ks10q9HO.g8S2', 'admin', 'Active', '2025-09-12 13:31:11'),
(44, 'SANA  SATTAR', 'admin1@gmail.com', '$2y$10$BNMsY1V50fJogb3PX9xI9.C85zrLJ180qkhurrP.WziKVq3DCeC8y', 'admin', 'Active', '2025-09-12 16:39:21'),
(45, 'SANA  SATTAR', 'irzahh@gmail.com', '$2y$10$6xeL6rDD8ce2LHt9j5Amnu8W12MB4/Pyztt3WVpshSw6IQMYs5JwS', 'admin', 'Active', '2025-09-14 10:57:51'),
(46, 'Javeria', 'javeria@gmail.com', '$2y$10$Evb4D1ZPeFjkDgo7UH8dh.BRR4In15O1lF9INed7xBP.v6VenDKca', 'admin', 'Active', '2025-09-27 10:52:18');

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
(16, 5, 'resume', '1759280269-Benefits of reading book in Digital era by Mariam Abbas.pdf', 0, '2025-10-01 00:57:32'),
(17, 5, 'resume', '1759469438-Benefits of reading book in Digital era by Mariam Abbas.pdf', 0, '2025-10-03 05:30:38');

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
  `status` enum('Active','Inactive','Rejected') NOT NULL DEFAULT 'Inactive'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jobs`
--

INSERT INTO `jobs` (`id`, `title`, `company_name`, `description`, `benefits`, `country_name`, `state_name`, `city_name`, `salary_from`, `salary_to`, `salary_currency`, `salary_period`, `hide_salary`, `career_level`, `functional_area`, `job_type`, `job_shift`, `num_of_positions`, `gender`, `expiry_date`, `degree_level`, `job_experience`, `is_freelance`, `external_job`, `job_link`, `created_at`, `status`) VALUES
(70, 'Dolore itaque eligen', 'Holloway Anthony Co', 'Rem recusandae Erro', 'Amet iusto voluptat', 'Afghanistan', '', 'Peshawar', 50.00, 98.00, 'KM', 'Monthly', 0, 'Entry Level', 'Management and Manufacturing', 'Internship', 'Third Shift (Night)', 6, 'Female', '2005-05-13', 'Diploma', '2 Years', 0, 'no', '', '2025-09-28 06:00:37', 'Inactive'),
(79, 'Sit sequi commodo om', 'Fletcher and Cotton Traders', 'Sed perspiciatis ip', 'Reprehenderit dolor', 'Azerbaijan', '', 'Hyderabad', 7.00, 11.00, '$', 'Monthly', 0, 'Experienced Professional', 'Other', 'Freelance', 'Third Shift (Night)', 7, 'Female', '1970-02-06', 'MPhil/MS', '6 Years', 0, 'no', '', '2025-09-28 10:54:11', 'Active'),
(80, 'Reprehenderit ea sit', 'Tyson and Larsen LLC', 'Laboris sint earum ', 'Consectetur repudia', 'Antigua And Barbuda', '', 'Rawalpindi', 15.00, 95.00, 'лв', 'Weekly', 0, 'Intern/Student', 'Health Care Provider', 'Part Time', 'Second Shift (Afternoon)', 4, 'Male', '1993-03-05', 'Matriculation/O-Level', '7 Years', 0, 'yes', '', '2025-09-28 10:54:16', 'Active'),
(84, 'Nihil consectetur p', 'Allison Rice Traders', 'Labore aperiam magni', 'Temporibus perferend', 'Anguilla', '', 'Islamabad', 51.00, 97.00, '€', 'Monthly', 0, 'Intern/Student', 'Management and Manufacturing', 'Freelance', 'Second Shift (Afternoon)', 13, 'Any', '1979-02-18', 'Masters', '7 Years', 0, 'yes', '', '2025-09-30 08:23:55', 'Inactive'),
(85, 'Sunt nihil quisquam', 'Mays and Delaney Trading', 'Veniam ipsum enim m', 'Veniam libero ipsum', 'American Samoa', '', 'Multan', 82.00, 76.00, 'ƒ', 'Yearly', 0, 'Experienced Professional', 'Accounting/Auditing and Finance', 'Freelance', 'First Shift (Day)', 10, 'Male', '2007-05-04', 'MPhil/MS', '4 Years', 0, 'yes', '', '2025-09-30 08:32:24', 'Inactive'),
(86, 'Teaching', 'TEF', 'Here is the description...', 'These are the benefits', 'Aruba', NULL, 'Hyderabad', 10000.00, 15000.00, '$', 'Monthly', 0, 'Department Head', 'Accountant', 'Freelance', 'Second Shift (Afternoon)', 11, 'Female', '2025-10-10', 'PHD/Doctorate', 'Less Than 1 Year', 0, 'no', '', '2025-09-30 08:39:39', 'Inactive'),
(87, 'Teaching', 'TEF', 'Here is the description...', 'These are the benefits', 'Aruba', NULL, 'Hyderabad', 10000.00, 15000.00, '$', 'Monthly', 0, 'Department Head', 'Accountant', 'Freelance', 'Second Shift (Afternoon)', 11, 'Female', '2025-10-10', 'PHD/Doctorate', 'Less Than 1 Year', 0, 'no', '', '2025-09-30 08:39:51', 'Inactive'),
(88, 'Do recusandae Beata', 'Craig and Dorsey Plc', 'Nostrum quis consequ', 'Eos excepteur eos a ', 'Afghanistan', NULL, 'Hyderabad', 100.00, 44.00, '﷼', 'Weekly', 0, 'GM / CEO / Country Head / President', 'Accountant', 'Freelance', 'Second Shift (Afternoon)', 14, 'Male', '2011-09-28', 'Bachelors', '3 Years', 0, 'no', '', '2025-09-30 08:40:49', 'Inactive'),
(89, 'Professor', 'Holland and Klein Traders', 'Harum ducimus ullam', 'Placeat nesciunt c', 'Aruba', NULL, 'Rawalpindi', 94.00, 49.00, 'Rp', 'Monthly', 0, 'Entry Level', 'Accountant', 'Part Time', 'First Shift (Day)', 3, 'Female', '1982-09-04', 'Certification', '7 Years', 0, 'yes', '', '2025-10-01 06:18:14', 'Active'),
(90, 'Web', 'Rowland and Fox Co', 'Atque neque dicta pa', 'Aliquid sit molesti', 'Anguilla', NULL, 'Karachi', 20.00, 3.00, 'Q', 'Weekly', 0, 'Department Head', 'Advertising', 'Internship', 'Rotating', 8, 'Female', '1997-09-17', 'Diploma', '4 Years', 0, 'no', '', '2025-10-01 06:45:23', 'Active'),
(91, 'IT technician', 'Maldonado and Mayo Associates', 'Proident quaerat re', 'Eum enim laudantium', 'Antarctica', '', 'Sialkot', 46.00, 41.00, 'J$', 'Monthly', 0, 'Department Head', 'Accountant', 'Part Time', 'Third Shift (Night)', 7, 'Male', '2008-08-15', 'MPhil/MS', '3 Years', 0, 'yes', '', '2025-10-02 00:36:30', 'Active'),
(92, 'Wed developer', 'Ochoa and Sweet Traders', 'Et delectus minim d', 'Sapiente rerum qui e', 'Anguilla', NULL, 'Karachi', 25.00, 59.00, 'ƒ', 'Monthly', 0, 'GM / CEO / Country Head / President', 'Engineering and Information Technology', 'Part Time', 'Second Shift (Afternoon)', 11, 'Any', '2000-01-28', 'MPhil/MS', '6 Years', 0, 'no', '', '2025-10-03 05:22:42', 'Active'),
(93, 'Javeria', 'Marquez and Mckinney Trading', 'Consequatur est eaqu', 'Adipisicing consecte', 'Armenia', '', 'Hyderabad', 37.00, 48.00, 'RD$', 'Weekly', 0, 'Department Head', 'Information Technology', 'Full Time/Permanent', 'Rotating', 5, 'Female', '1997-12-17', 'Matriculation/O-Level', '3 Years', 0, 'no', '', '2025-10-10 11:21:54', 'Inactive');

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
(1, 1, 5, '2025-09-17 19:35:00', 'Pending'),
(2, 1, 4, '2025-09-17 19:44:53', 'Pending'),
(3, 6, 4, '2025-09-22 08:27:37', 'Pending'),
(4, 1, 7, '2025-09-27 06:54:18', 'Pending'),
(5, 1, 8, '2025-09-27 07:02:22', 'Pending'),
(6, 5, 10, '2025-09-29 08:33:14', 'Pending'),
(7, 5, 8, '2025-09-29 12:26:51', 'Pending'),
(8, 5, 81, '2025-09-30 07:33:38', 'Pending'),
(9, 5, 88, '2025-09-30 08:43:08', 'Pending'),
(10, 5, 80, '2025-10-01 02:15:08', 'Pending'),
(11, 5, 89, '2025-10-01 06:20:16', 'Pending'),
(12, 5, 90, '2025-10-01 06:46:07', 'Accepted'),
(13, 5, 91, '2025-10-02 05:26:27', 'Accepted'),
(14, 5, 92, '2025-10-03 05:27:55', 'Accepted');

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
(8, 1, 'Non-Matriculation', 'Arts', 'Inter', NULL, 'Algeria', 'Alabama', 'Lodhran', 'Amina', '2025', 'B', 'Percentage', '2025-09-13 18:26:44'),
(10, 3, 'Intermediate/A-Level', 'Computer', 'Inter', NULL, 'Afghanistan', 'Alabama', 'Lodhran', 'AGDC', '2025', 'A', 'GPA', '2025-09-22 15:29:49'),
(12, 5, 'Intermediate/A-Level', 'Computer', 'Enim ut magnam in el', NULL, 'Algeria', 'Alabama', 'Lodhran', 'Laboris qui elit ip', '2025', 'Architecto ipsam ani', 'GPA', '2025-10-01 01:11:44');

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
(15, 5, 'Dicta incididunt qui', 'Huff and Cooke Plc', 'Afghanistan', 'Iowa', 'Arizona', '1976-02-04', '1995-11-22', 0, 'Libero alias beatae ', '2025-10-01 01:09:05', '2025-10-01 01:09:05');

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
  `user_id` int(11) NOT NULL,
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
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `job_seeker_profiles`
--

INSERT INTO `job_seeker_profiles` (`id`, `user_id`, `email`, `password`, `first_name`, `last_name`, `middle_name`, `gender`, `marital_status`, `country`, `state`, `city`, `nationality`, `date_of_birth`, `phone`, `mobile_num`, `street_address`, `job_experience`, `career_level`, `industry`, `functional_area`, `salary_currency`, `current_salary`, `expected_salary`, `summary`, `is_subscribed`, `profile_image`, `cover_images`, `status`, `created_at`) VALUES
(1, 1, 'seeker@jobsportal.com', '45tgfg', 'Javeria', 'Noor', 'Jia', 'Female', 'Single', 'Afghanistan', 'Alabama', 'Aberdeen', 'Afghans', '2006-02-15', '+1234567890', '+1324564798', 'Dummy Street Address 123 USA', '1 Year', 'Department Head', 'Accounting/Taxation', 'Information Technology', 'USD', '7000', '10000', 'I am passionate fir this job\r\n', 1, '1757959631_2025 img.png', '1757959681_2025.png', 'Pending', '2025-09-15 17:24:15'),
(2, 3, 'javeria@gmail.com', '12345', 'Javeria', 'Noor', 'Jia', 'Female', 'Single', 'Pakistan', 'Alabama', 'Lodhran', 'Pakistani', '2025-09-25', '+1234567890', '+1324564798', 'sdrhgyresuwsetyioe67iiiiiiiiiii', 'Less Than 1 Year', 'Department Head', 'Technology', 'Information Technology', 'USD', '6000', '10000', 'This is my profile...', 0, '1758554581_IMG_0010.JPG', '1758554581_img-20241027-wa0002.jpg', 'Pending', '2025-09-16 07:51:41'),
(3, 5, 'seeker@jobsportal.com', '11223344', '', 'Noor', 'Jia', 'Female', 'Single', 'Pakistan', 'Alabama', 'Lodhran', 'Pakistani', '2006-02-15', '+1234567890', '+1324564798', 'sdrhgyresuwsetyioe67iiiiiiiiiii', '', 'Department Head', 'Et autem deserunt el', 'Information Technology', 'USD', '7000', '10000', 'I am passionate for my career.', 0, '1759237196_IMG_4229.JPG', '1759237233_img-20241027-wa0002.jpg', 'Pending', '2025-09-30 12:10:00');

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
(8, 5, 'Active listening', 'Less Than 1 Year', '2025-10-01 01:13:22');

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
-- Indexes for table `admin_blogs`
--
ALTER TABLE `admin_blogs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin_career_levels`
--
ALTER TABLE `admin_career_levels`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin_companies`
--
ALTER TABLE `admin_companies`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `admin_countries`
--
ALTER TABLE `admin_countries`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `country` (`country`);

--
-- Indexes for table `admin_degree_levels`
--
ALTER TABLE `admin_degree_levels`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin_degree_types`
--
ALTER TABLE `admin_degree_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin_employer_packages`
--
ALTER TABLE `admin_employer_packages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin_faqs`
--
ALTER TABLE `admin_faqs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin_functional_areas`
--
ALTER TABLE `admin_functional_areas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin_genders`
--
ALTER TABLE `admin_genders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin_industries`
--
ALTER TABLE `admin_industries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin_job_attributes`
--
ALTER TABLE `admin_job_attributes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin_users`
--
ALTER TABLE `admin_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

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
  ADD PRIMARY KEY (`id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=94;

--
-- AUTO_INCREMENT for table `job_seeker_appliedjobs`
--
ALTER TABLE `job_seeker_appliedjobs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `job_seeker_education`
--
ALTER TABLE `job_seeker_education`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `job_seeker_experiences`
--
ALTER TABLE `job_seeker_experiences`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `job_seeker_languages`
--
ALTER TABLE `job_seeker_languages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `job_seeker_profiles`
--
ALTER TABLE `job_seeker_profiles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `job_seeker_skills`
--
ALTER TABLE `job_seeker_skills`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user_information`
--
ALTER TABLE `user_information`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
