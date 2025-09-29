-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 29, 2025 at 01:18 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `login_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `attendance_records`
--

CREATE TABLE `attendance_records` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `attendance_date` date NOT NULL,
  `status` enum('present','absent') NOT NULL DEFAULT 'absent',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `attendance_records`
--

INSERT INTO `attendance_records` (`id`, `student_id`, `attendance_date`, `status`, `created_at`) VALUES
(1, 1, '2025-09-23', 'present', '2025-09-23 10:59:06'),
(2, 8, '2025-09-23', 'absent', '2025-09-23 10:59:06'),
(3, 4, '2025-09-23', 'absent', '2025-09-23 10:59:06'),
(4, 7, '2025-09-23', 'absent', '2025-09-23 10:59:06'),
(5, 3, '2025-09-23', 'absent', '2025-09-23 10:59:06'),
(6, 1, '2025-09-23', 'present', '2025-09-23 10:59:20'),
(7, 8, '2025-09-23', 'absent', '2025-09-23 10:59:20'),
(8, 4, '2025-09-23', 'absent', '2025-09-23 10:59:20'),
(9, 7, '2025-09-23', 'absent', '2025-09-23 10:59:20'),
(10, 3, '2025-09-23', 'absent', '2025-09-23 10:59:20');

-- --------------------------------------------------------

--
-- Table structure for table `audit_logs`
--

CREATE TABLE `audit_logs` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `module` varchar(100) NOT NULL,
  `action` varchar(100) NOT NULL,
  `details` text DEFAULT NULL,
  `status` enum('success','failed') DEFAULT 'success',
  `ip_address` varchar(45) DEFAULT NULL,
  `device_info` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `audit_logs`
--

INSERT INTO `audit_logs` (`id`, `user_id`, `module`, `action`, `details`, `status`, `ip_address`, `device_info`, `created_at`) VALUES
(1, 5, 'Admin', 'Dashboard Access', 'Admin opened dashboard', '', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-22 15:16:18'),
(2, 5, 'Admin', 'Dashboard Access', 'Admin opened dashboard', '', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-22 15:16:21'),
(3, 5, 'Student', 'Add', 'Student \'student_03\' (Roll: 00000)', 'success', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-22 15:17:20'),
(4, 5, 'Student', 'Delete', 'Student ID 10 deleted', 'success', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-22 15:17:42'),
(5, 5, 'Student', 'Add', 'Student \'student_04\' (Roll: 04)', 'success', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-22 15:19:32'),
(6, 5, 'Student', 'Delete', 'Student ID 11 marked as deleted', 'success', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-22 15:19:47'),
(7, 5, 'Admin', 'Dashboard Access', 'Admin opened dashboard', '', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-22 15:21:10'),
(8, 5, 'Admin', 'Dashboard Access', 'Admin opened dashboard', '', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-22 15:21:22'),
(9, 5, 'Admin', 'Dashboard Access', 'Admin opened dashboard', '', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-22 15:22:10'),
(10, 5, 'Admin', 'Dashboard Access', 'Admin opened dashboard', '', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-22 15:22:27'),
(11, 5, 'Class', 'Delete', 'Class ID 3 deleted', 'success', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-22 15:27:41'),
(12, 5, 'Class', 'Update', 'Class ID 2 updated', 'success', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-22 15:29:40'),
(13, 5, 'Admin', 'Dashboard Access', 'Admin opened dashboard', '', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-22 15:29:48'),
(14, 5, 'Admin', 'Dashboard Access', 'Admin opened dashboard', '', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-22 15:29:55'),
(15, 5, 'Admin', 'Dashboard Access', 'Admin opened dashboard', '', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-22 15:30:06'),
(16, 5, 'Admin', 'Dashboard Access', 'Admin opened dashboard', '', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-22 15:30:08'),
(17, 5, 'Auth', 'Logout', 'User SIR02 logged out', 'success', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-22 15:30:15'),
(18, 4, 'Auth', 'Login', 'User logged in successfully', 'success', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-22 15:30:18'),
(19, 4, 'Auth', 'Logout', 'User SIR01 logged out', 'success', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-22 15:46:20'),
(20, 5, 'Auth', 'Login', 'User logged in successfully', 'success', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-22 15:46:23'),
(21, 5, 'Admin', 'Dashboard Access', 'Admin opened dashboard', '', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-22 15:46:24'),
(22, 5, 'Auth', 'Logout', 'User SIR02 logged out', 'success', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-22 15:46:26'),
(23, 2, 'Auth', 'Login', 'User logged in successfully', 'success', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-22 15:46:30'),
(24, 2, 'Auth', 'Login', 'User logged in successfully', 'success', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-22 15:47:00'),
(25, 6, 'Auth', 'Login', 'User logged in successfully', 'success', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-22 15:48:11'),
(26, 6, 'Auth', 'Logout', 'User ali logged out', 'success', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-22 16:09:00'),
(27, 6, 'Auth', 'Login', 'User logged in successfully', 'success', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-22 16:12:31'),
(28, 6, 'Auth', 'Logout', 'User ali logged out', 'success', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-22 16:20:40'),
(29, 5, 'Auth', 'Login', 'User logged in successfully', 'success', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-22 16:20:45'),
(30, 5, 'Admin', 'Dashboard Access', 'Admin opened dashboard', '', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-22 16:20:45'),
(31, 2, 'Auth', 'Login', 'User logged in successfully', 'success', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-22 16:21:43'),
(32, 5, 'Auth', 'Login', 'User logged in successfully', 'success', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-22 16:21:45'),
(33, 5, 'Admin', 'Dashboard Access', 'Admin opened dashboard', '', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-22 16:21:45'),
(34, 2, 'Auth', 'Login', 'User logged in successfully', 'success', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-22 16:21:54'),
(35, 4, 'Auth', 'Login', 'User logged in successfully', 'success', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-22 16:22:03'),
(36, 6, 'Auth', 'Login', 'User logged in successfully', 'success', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-22 16:22:11'),
(37, 4, 'Auth', 'Login', 'User logged in successfully', 'success', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-22 16:22:22'),
(38, 4, 'Auth', 'Logout', 'User SIR01 logged out', 'success', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-22 16:22:38'),
(39, 5, 'Auth', 'Login', 'User logged in successfully', 'success', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-22 16:22:41'),
(40, 5, 'Admin', 'Dashboard Access', 'Admin opened dashboard', '', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-22 16:22:41'),
(41, 5, 'Auth', 'Logout', 'User SIR02 logged out', 'success', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-22 16:23:14'),
(42, 2, 'Auth', 'Login', 'User logged in successfully', 'success', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-22 16:23:18'),
(43, 5, 'Auth', 'Login', 'User logged in successfully', 'success', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-22 16:23:20'),
(44, 5, 'Admin', 'Dashboard Access', 'Admin opened dashboard', '', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-22 16:23:20'),
(45, 5, 'Auth', 'Logout', 'User SIR02 logged out', 'success', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-22 16:23:23'),
(46, 4, 'Auth', 'Login', 'User logged in successfully', 'success', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-22 16:23:26'),
(47, 4, 'Auth', 'Logout', 'User SIR01 logged out', 'success', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-22 16:23:38'),
(48, 7, 'Auth', 'Login', 'User logged in successfully', 'success', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-22 16:24:14'),
(49, 7, 'Auth', 'Login', 'User logged in successfully', 'success', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-23 10:38:57'),
(50, 7, 'Auth', 'Logout', 'User st-01 logged out', 'success', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-23 10:40:00'),
(51, 4, 'Auth', 'Login', 'User logged in successfully', 'success', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-23 10:40:03'),
(52, 4, 'Auth', 'Logout', 'User SIR01 logged out', 'success', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-23 10:40:33'),
(53, 7, 'Auth', 'Login', 'User logged in successfully', 'success', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-23 10:40:38'),
(54, 7, 'Auth', 'Login', 'User logged in successfully', 'success', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-23 10:45:31'),
(55, 7, 'Auth', 'Login', 'User logged in successfully', 'success', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-23 10:45:33'),
(56, 7, 'Auth', 'Login', 'User logged in successfully', 'success', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-23 10:45:34'),
(57, 7, 'Auth', 'Login', 'User logged in successfully', 'success', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-23 10:45:36'),
(58, 7, 'Auth', 'Login', 'User logged in successfully', 'success', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-23 10:45:38'),
(59, 7, 'Auth', 'Login', 'User logged in successfully', 'success', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-23 10:46:53'),
(60, 7, 'Auth', 'Login', 'User logged in successfully', 'success', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-23 10:46:55'),
(61, 7, 'Auth', 'Login', 'User logged in successfully', 'success', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-23 10:46:57'),
(62, 7, 'Auth', 'Login', 'User logged in successfully', 'success', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-23 10:47:06'),
(63, 7, 'Auth', 'Login', 'User logged in successfully', 'success', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-23 10:47:10'),
(64, 7, 'Auth', 'Login', 'User logged in successfully', 'success', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-23 10:51:14'),
(65, 7, 'Auth', 'Login', 'User logged in successfully', 'success', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-23 10:51:25'),
(66, 7, 'Auth', 'Login', 'User logged in successfully', 'success', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-23 10:51:26'),
(67, 7, 'Auth', 'Login', 'User logged in successfully', 'success', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-23 10:51:27'),
(68, 7, 'Auth', 'Login', 'User logged in successfully', 'success', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-23 10:51:49'),
(69, 7, 'Auth', 'Login', 'User logged in successfully', 'success', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-23 10:52:18'),
(70, 7, 'Auth', 'Logout', 'User st-01 logged out', 'success', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-23 10:54:39'),
(71, 4, 'Auth', 'Login', 'User logged in successfully', 'success', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-23 10:54:44'),
(72, 4, 'Auth', 'Logout', 'User SIR01 logged out', 'success', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-23 10:59:57'),
(73, 4, 'Auth', 'Login', 'User logged in successfully', 'success', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-28 08:41:52'),
(74, 4, 'Auth', 'Login', 'User logged in successfully', 'success', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-28 10:30:49'),
(75, 4, 'Auth', 'Logout', 'User SIR01 logged out', 'success', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-28 10:31:18'),
(76, 7, 'Auth', 'Login', 'User logged in successfully', 'success', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-28 10:31:23'),
(77, 7, 'Auth', 'Logout', 'User st-01 logged out', 'success', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-28 10:31:40'),
(78, 2, 'Auth', 'Login', 'User logged in successfully', 'success', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-28 10:31:47'),
(79, 7, 'Auth', 'Login', 'User logged in successfully', 'success', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-28 10:31:50'),
(80, 7, 'Auth', 'Logout', 'User st-01 logged out', 'success', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-28 10:31:54'),
(81, 4, 'Auth', 'Login', 'User logged in successfully', 'success', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-28 10:31:59'),
(82, 4, 'Auth', 'Logout', 'User SIR01 logged out', 'success', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-28 10:32:02'),
(83, 4, 'Auth', 'Login', 'User logged in successfully', 'success', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-29 10:54:17'),
(84, 4, 'Auth', 'Logout', 'User SIR01 logged out', 'success', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-29 11:01:10'),
(85, 9, 'Auth', 'Login', 'User logged in successfully', 'success', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-29 11:01:42'),
(86, 9, 'Admin', 'Dashboard Access', 'Admin opened dashboard', '', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-29 11:01:42'),
(87, 9, 'Admin', 'Dashboard Access', 'Admin opened dashboard', '', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-29 11:02:57'),
(88, 9, 'Admin', 'Dashboard Access', 'Admin opened dashboard', '', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-29 11:03:38'),
(89, 9, 'Auth', 'Logout', 'User admin-01 logged out', 'success', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-29 11:03:41'),
(90, 9, 'Auth', 'Login', 'User logged in successfully', 'success', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-29 11:03:43'),
(91, 9, 'Admin', 'Dashboard Access', 'Admin opened dashboard', '', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-29 11:03:44'),
(92, 9, 'Auth', 'Logout', 'User admin-01 logged out', 'success', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-29 11:04:27'),
(93, 10, 'Auth', 'Login', 'User logged in successfully', 'success', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-29 11:05:01'),
(94, 10, 'Auth', 'Logout', 'User Teacher-01 logged out', 'success', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-29 11:07:05'),
(95, 10, 'Auth', 'Login', 'User logged in successfully', 'success', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-29 11:08:24'),
(96, 10, 'Auth', 'Logout', 'User Teacher-01 logged out', 'success', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-29 11:09:19'),
(97, 7, 'Auth', 'Login', 'User logged in successfully', 'success', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-29 11:09:37');

-- --------------------------------------------------------

--
-- Table structure for table `classes`
--

CREATE TABLE `classes` (
  `id` int(11) NOT NULL,
  `class_name` varchar(100) NOT NULL,
  `section` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `is_deleted` enum('yes','no') NOT NULL DEFAULT 'no'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `classes`
--

INSERT INTO `classes` (`id`, `class_name`, `section`, `created_at`, `is_deleted`) VALUES
(1, 'lec-01', '10b', '2025-09-22 14:36:10', 'no'),
(2, 'lec-005', '10A', '2025-09-22 15:08:45', 'no'),
(3, 'lec-03', '10c', '2025-09-22 15:22:08', 'yes');

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`id`, `name`, `email`, `message`, `created_at`) VALUES
(1, 'ali', 'ah6906123@gmail.com', 'test-test', '2025-09-19 18:28:45'),
(2, 'ali', 'ah6906123@gmail.com', 'test-test', '2025-09-19 18:31:59'),
(3, 'ali', 'ah6906123@gmail.com', 'test-test', '2025-09-19 18:34:12'),
(4, 'ali', 'ah6906123@gmail.com', 'test-test', '2025-09-19 18:36:28'),
(5, 'ali', 'ah6906123@gmail.com', 'test-test', '2025-09-19 18:36:37'),
(6, 'ali', 'ah6906123@gmail.com', 'test-test', '2025-09-19 18:37:23');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `user_id` int(11) UNSIGNED DEFAULT NULL,
  `student_name` varchar(255) NOT NULL,
  `roll_no` varchar(50) NOT NULL,
  `class` varchar(50) DEFAULT NULL,
  `attendance` enum('present','absent') NOT NULL DEFAULT 'absent',
  `marks` int(11) DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  `phone` varchar(30) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `is_deleted` enum('no','yes') NOT NULL DEFAULT 'no'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `user_id`, `student_name`, `roll_no`, `class`, `attendance`, `marks`, `email`, `phone`, `created_at`, `updated_at`, `is_deleted`) VALUES
(1, NULL, 'ALi Hassan', '051', '10B', 'absent', 33, 'ah6906123@gmail.com', '03016159800', '2025-09-22 11:32:45', '2025-09-22 15:45:41', 'no'),
(2, NULL, 'test', 'test-01', 'test-class', '', NULL, 'test123@gmail.com', '-000000-00000-00000', '2025-09-22 12:10:50', '2025-09-22 12:10:58', 'yes'),
(3, NULL, 'usman ahmed', '001', 'test-class', 'present', NULL, 'ah6906123@gmail.com', '03016159800', '2025-09-22 14:15:38', '2025-09-22 15:42:03', 'no'),
(4, NULL, 'student_01', '01', '5', 'present', NULL, 'alihasan123@gmail.com', '03016159800', '2025-09-22 14:33:39', '2025-09-22 15:41:58', 'no'),
(7, NULL, 'test', '000', '10B', 'absent', 32, 'alihasan123@gmail.com', '03016159800', '2025-09-22 14:50:55', '2025-09-23 10:40:18', 'no'),
(8, NULL, 'ALi Hassan', '0000', 'test-class', 'present', NULL, 'alihasan123@gmail.com', '03016159800', '2025-09-22 15:06:56', '2025-09-22 15:41:58', 'no'),
(11, NULL, 'student_04', '04', '03', '', NULL, 'ah6903123@gmail.com', NULL, '2025-09-22 15:19:32', '2025-09-22 15:19:47', 'yes');

-- --------------------------------------------------------

--
-- Table structure for table `todos`
--

CREATE TABLE `todos` (
  `id` int(11) NOT NULL,
  `task` varchar(255) NOT NULL,
  `status` tinyint(1) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `is_deleted` enum('yes','no') NOT NULL DEFAULT 'no'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `todos`
--

INSERT INTO `todos` (`id`, `task`, `status`, `created_at`, `is_deleted`) VALUES
(4, 'alli', 0, '2025-09-19 19:19:07', 'yes'),
(5, 'test', 0, '2025-09-19 19:20:17', 'yes'),
(6, 'wwwwww', 0, '2025-09-19 19:20:33', 'yes'),
(7, 'work', 0, '2025-09-22 10:54:06', 'yes');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','teacher','student') NOT NULL DEFAULT 'student',
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `role`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Ali123', 'ah6906123@gmail.com', '$2y$10$FwPZYmDa4MdTi9Cb/I.bmeEYaunkYbcclVtmYsh9MzXXrwhEM8nI2', '', 1, '2025-09-22 13:59:36', '2025-09-22 13:59:36'),
(2, 'test', 'test123@gmail.com', '$2y$10$818BDY7O3wPEN/PBM5u2Y.Apqq.6DRSHOqHEEBJnHIhZ6wD3qQnaq', '', 1, '2025-09-22 14:10:04', '2025-09-22 14:10:04'),
(3, 'test', 'ah69055123@gmail.com', '$2y$10$bSNbVax5kOZXZv/ofTJNgOjP2Xj3oulawC7SdDptBPRo99CsisJ.S', 'teacher', 1, '2025-09-22 14:24:37', '2025-09-22 14:24:37'),
(4, 'SIR01', 'sir1234@gmail.com', '$2y$10$NIlT8p4.bJH0uxnxobAB8.p3XyW43p5WTDfxtMNEG8IxUzaweaANu', 'teacher', 1, '2025-09-22 14:25:26', '2025-09-22 14:25:26'),
(5, 'SIR02', 'ah690225123@gmail.com', '$2y$10$.wwMv.KD6kkyP6m407BNveqSV6pZC8836RhgIR9WPCiu8WLrhZ6S2', 'admin', 1, '2025-09-22 14:29:37', '2025-09-22 14:29:37'),
(6, 'ali', 'test223@gmail.com', '$2y$10$DDg1E33m.AKJliBbsBdd1uXKUwUBR/Hc3CZq5OzY8rLTQg9V99YZq', 'student', 1, '2025-09-22 15:48:08', '2025-09-22 15:48:08'),
(7, 'st-01', 'alihasn123@gmail.com', '$2y$10$P1atUI9C.j92bE04nYY7MuWfI1M2PCOW80Sb3fWq6WbLxC5NixnAm', 'student', 1, '2025-09-22 16:23:59', '2025-09-22 16:23:59'),
(8, 'ALi Hassan', 'test12345@gmail.com', '$2y$10$4vHXHfLqPS6im.13hfCt0uBpX//VdwS5AJJWV4G6g.vdMxkK/aEZy', '', 1, '2025-09-28 10:29:18', '2025-09-28 10:29:18'),
(9, 'admin-01', 'test123333@gmail.com', '$2y$10$4eq5WlP6wVh/MhobO4X1Z.WycyVPP.JJF2BSqFn5A9/ueuvmHE9.m', 'admin', 1, '2025-09-29 11:01:37', '2025-09-29 11:01:37'),
(10, 'Teacher-01', 'test122223@gmail.com', '$2y$10$RJl6.njwuqYDieIdG3BBTuPeCphq2V0qZ.La6eVfo4j9epfGvw/Q6', 'teacher', 1, '2025-09-29 11:04:58', '2025-09-29 11:04:58');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attendance_records`
--
ALTER TABLE `attendance_records`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `audit_logs`
--
ALTER TABLE `audit_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `classes`
--
ALTER TABLE `classes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `idx_roll` (`roll_no`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `todos`
--
ALTER TABLE `todos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attendance_records`
--
ALTER TABLE `attendance_records`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `audit_logs`
--
ALTER TABLE `audit_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=98;

--
-- AUTO_INCREMENT for table `classes`
--
ALTER TABLE `classes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `todos`
--
ALTER TABLE `todos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `attendance_records`
--
ALTER TABLE `attendance_records`
  ADD CONSTRAINT `attendance_records_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `students`
--
ALTER TABLE `students`
  ADD CONSTRAINT `fk_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
