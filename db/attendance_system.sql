-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 03, 2024 at 04:53 PM
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
-- Database: `attendance_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `attendance_id` int(11) NOT NULL,
  `student_id` varchar(50) NOT NULL,
  `date` date NOT NULL,
  `time_in` time DEFAULT NULL,
  `time_out` time DEFAULT NULL,
  `status` enum('IN','OUT') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`attendance_id`, `student_id`, `date`, `time_in`, `time_out`, `status`, `created_at`) VALUES
(119, 'SCC-10001', '2024-11-03', '15:15:25', '15:15:29', 'OUT', '2024-11-03 14:15:25'),
(120, 'SCC-10003', '2024-11-03', '15:15:36', '15:15:46', 'OUT', '2024-11-03 14:15:36'),
(121, 'SCC-10001', '2024-11-03', '15:15:39', '15:20:17', 'OUT', '2024-11-03 14:15:39'),
(122, 'SCC-10001', '2024-11-03', '15:20:24', '15:20:33', 'OUT', '2024-11-03 14:20:24'),
(123, 'SCC-10003', '2024-11-03', '15:20:29', '15:24:30', 'OUT', '2024-11-03 14:20:29'),
(124, 'SCC-10001', '2024-11-03', '15:24:22', '15:24:24', 'OUT', '2024-11-03 14:24:22'),
(125, 'SCC-10001', '2024-11-03', '15:24:28', '15:24:48', 'OUT', '2024-11-03 14:24:28'),
(126, 'SCC-10003', '2024-11-03', '15:24:47', '15:24:54', 'OUT', '2024-11-03 14:24:47'),
(127, 'SCC-10001', '2024-11-03', '15:24:57', '15:25:00', 'OUT', '2024-11-03 14:24:57'),
(128, 'SCC-10001', '2024-11-03', '15:37:05', '15:37:07', 'OUT', '2024-11-03 14:37:05'),
(129, 'SCC-10003', '2024-11-03', '15:37:11', '15:37:15', 'OUT', '2024-11-03 14:37:11'),
(130, 'SCC-10001', '2024-11-03', '15:37:13', '15:37:21', 'OUT', '2024-11-03 14:37:13'),
(131, 'SCC-10003', '2024-11-03', '15:37:24', '15:42:16', 'OUT', '2024-11-03 14:37:24'),
(132, 'SCC-10004', '2024-11-03', '15:42:13', '15:42:13', 'OUT', '2024-11-03 14:42:13'),
(133, 'SCC-10001', '2024-11-03', '15:42:18', '15:43:39', 'OUT', '2024-11-03 14:42:18'),
(134, 'SCC-10005', '2024-11-03', '15:42:21', '15:43:42', 'OUT', '2024-11-03 14:42:21'),
(135, 'SCC-10004', '2024-11-03', '15:42:25', '15:43:46', 'OUT', '2024-11-03 14:42:25'),
(136, 'SCC-10003', '2024-11-03', '15:42:29', '15:43:44', 'OUT', '2024-11-03 14:42:29'),
(137, 'SCC-10005', '2024-11-03', '15:43:50', '16:01:21', 'OUT', '2024-11-03 14:43:50'),
(138, 'SCC-10003', '2024-11-03', '15:43:53', '15:44:02', 'OUT', '2024-11-03 14:43:53'),
(139, 'SCC-10004', '2024-11-03', '15:43:56', '15:43:59', 'OUT', '2024-11-03 14:43:56'),
(140, 'SCC-10003', '2024-11-03', '16:01:27', '16:01:27', 'OUT', '2024-11-03 15:01:27'),
(141, 'SCC-10003', '2024-11-03', '16:01:28', '16:04:47', 'OUT', '2024-11-03 15:01:28'),
(142, 'SCC-10005', '2024-11-03', '16:01:30', '16:04:43', 'OUT', '2024-11-03 15:01:30'),
(143, 'SCC-10005', '2024-11-03', '16:04:52', '16:05:39', 'OUT', '2024-11-03 15:04:52'),
(144, 'SCC-10004', '2024-11-03', '16:04:55', '16:05:02', 'OUT', '2024-11-03 15:04:55'),
(145, 'SCC-10001', '2024-11-03', '16:04:58', '16:05:20', 'OUT', '2024-11-03 15:04:58'),
(146, 'SCC-10004', '2024-11-03', '16:05:11', '16:06:52', 'OUT', '2024-11-03 15:05:11'),
(147, 'SCC-10001', '2024-11-03', '16:05:32', '16:12:48', 'OUT', '2024-11-03 15:05:32'),
(148, 'SCC-10005', '2024-11-03', '16:05:43', '16:18:01', 'OUT', '2024-11-03 15:05:43'),
(149, 'SCC-10003', '2024-11-03', '16:06:55', '16:12:35', 'OUT', '2024-11-03 15:06:55'),
(150, 'SCC-10004', '2024-11-03', '16:12:41', '16:12:51', 'OUT', '2024-11-03 15:12:41'),
(151, 'SCC-10004', '2024-11-03', '16:12:59', '16:13:01', 'OUT', '2024-11-03 15:12:59'),
(152, 'SCC-10004', '2024-11-03', '16:13:02', '16:13:04', 'OUT', '2024-11-03 15:13:02'),
(153, 'SCC-10001', '2024-11-03', '16:13:59', '16:17:20', 'OUT', '2024-11-03 15:13:59'),
(154, 'SCC-10003', '2024-11-03', '16:14:05', '16:17:29', 'OUT', '2024-11-03 15:14:05'),
(155, 'SCC-10004', '2024-11-03', '16:17:25', '16:18:07', 'OUT', '2024-11-03 15:17:25'),
(156, 'SCC-10001', '2024-11-03', '16:17:32', '16:17:34', 'OUT', '2024-11-03 15:17:32'),
(157, 'SCC-10001', '2024-11-03', '16:17:36', '16:17:42', 'OUT', '2024-11-03 15:17:36'),
(158, 'SCC-10003', '2024-11-03', '16:17:44', '16:17:51', 'OUT', '2024-11-03 15:17:44'),
(159, 'SCC-10001', '2024-11-03', '16:17:46', '16:18:03', 'OUT', '2024-11-03 15:17:46'),
(160, 'SCC-10003', '2024-11-03', '16:18:10', '16:31:42', 'OUT', '2024-11-03 15:18:10'),
(161, 'SCC-10005', '2024-11-03', '16:18:11', '16:31:39', 'OUT', '2024-11-03 15:18:11'),
(162, 'SCC-10001', '2024-11-03', '16:18:14', '16:31:36', 'OUT', '2024-11-03 15:18:14'),
(163, 'SCC-10003', '2024-11-03', '16:31:42', '16:46:33', 'OUT', '2024-11-03 15:31:42'),
(164, 'SCC-10004', '2024-11-03', '16:31:49', '16:46:31', 'OUT', '2024-11-03 15:31:49'),
(165, 'SCC-10001', '2024-11-03', '16:46:26', '16:46:36', 'OUT', '2024-11-03 15:46:26'),
(166, 'SCC-10005', '2024-11-03', '16:46:29', '16:49:55', 'OUT', '2024-11-03 15:46:29'),
(167, 'SCC-10003', '2024-11-03', '16:49:47', NULL, 'IN', '2024-11-03 15:49:47'),
(168, 'SCC-10004', '2024-11-03', '16:49:51', NULL, 'IN', '2024-11-03 15:49:51');

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `course_id` varchar(10) NOT NULL,
  `course_name` varchar(100) NOT NULL,
  `course_description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`course_id`, `course_name`, `course_description`) VALUES
('BSBA', 'Bachelor of Science in Business Administration', 'A course covering various aspects of business administration.'),
('BSCRIM', 'Bachelor of Science in Criminology', 'A course focused on criminology and criminal justice.'),
('BSED', 'Bachelor of Science in Education', 'A course for students aiming to become educators.'),
('BSHM', 'Bachelor of Science in Hospitality Management', 'A course focused on hospitality and management.'),
('BSIT', 'Bachelor of Science in Information Technology', 'A four-year course focused on IT and computer systems.');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `student_id` varchar(20) NOT NULL,
  `student_rfid` varchar(50) DEFAULT NULL,
  `student_firstname` varchar(50) NOT NULL,
  `student_lastname` varchar(50) NOT NULL,
  `student_level` varchar(20) NOT NULL,
  `course_id` varchar(10) DEFAULT NULL,
  `student_email` varchar(255) DEFAULT NULL,
  `student_birthdate` date DEFAULT NULL,
  `student_phone` varchar(15) DEFAULT NULL,
  `student_address` text DEFAULT NULL,
  `student_gender` enum('Male','Female','Other') DEFAULT NULL,
  `guardian_name` varchar(255) DEFAULT NULL,
  `guardian_contact` varchar(15) DEFAULT NULL,
  `profile_picture` varchar(255) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`student_id`, `student_rfid`, `student_firstname`, `student_lastname`, `student_level`, `course_id`, `student_email`, `student_birthdate`, `student_phone`, `student_address`, `student_gender`, `guardian_name`, `guardian_contact`, `profile_picture`, `deleted_at`, `deleted`) VALUES
('SCC-10001', '0009500936', 'Alvin', 'Lagoras', '1st year', 'BSED', 'test1@gmail.com', '2024-10-03', '09054444433', 'Minglanilla,Cebu', 'Male', 'Mother', '09999433333', 'uploads/671fb535d5d7a-328101249_863345214723439_1040826811328765772_n.jpg', NULL, 0),
('SCC-10002', '0009600522', 'Joshua', 'Espanillo', '1st year', 'BSHM', 'test2@gmail.com', '2024-10-10', '09054444433', 'Naga, cebu', 'Male', 'Mother', '09999433333', 'uploads/671fb57933fb5-pexels-marleneleppanen-1183266.jpg', NULL, 0),
('SCC-10003', '0009698140', 'Jonard', 'Victorillo', '1st year', 'BSCRIM', 'jonard@gmail.com', '2024-11-01', '09054444433', 'Naga, Cebu', 'Male', 'Mother', '09999433333', 'uploads/jonard.jpg', NULL, 0),
('SCC-10004', '0009500522', 'Aljun', 'Delantae', '4th year', 'BSCRIM', 'aljun@gmail.com', '2024-11-01', '09054444433', 'Lipata, cebu', 'Male', 'Mother', '09999433333', 'uploads/67278b729ec13-aljun.jpg', NULL, 0),
('SCC-10005', '0009697931', 'Mike', 'Cortez', '2nd year', 'BSED', 'mike@gmail.com', '2024-10-04', '09054444433', 'Minglanilla', 'Male', 'Mother', '09999433333', 'uploads/67278bb61de3a-mike.jpg', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `teachers`
--

CREATE TABLE `teachers` (
  `id` int(11) UNSIGNED NOT NULL,
  `teacher_id` varchar(50) NOT NULL,
  `teacher_first_name` varchar(50) NOT NULL,
  `teacher_last_name` varchar(50) NOT NULL,
  `teacher_password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `teachers`
--

INSERT INTO `teachers` (`id`, `teacher_id`, `teacher_first_name`, `teacher_last_name`, `teacher_password`, `created_at`) VALUES
(2, 'SCC-11111', 'Johny', 'Sins', '$2y$10$ubx/RKfeL58aIgEVSJUQqOVBmAzgSDql3rk2Ak0F5DLPWyvrk6T3i', '2024-10-13 08:08:38'),
(3, 'SCC-11112', 'Joshua', 'Espanillo', '$2y$10$eYKwR6q9uCcblrpBxOWDwuvYQAdLz/JB1dXm9oe77Nqblz9XNIHAG', '2024-10-13 08:13:41'),
(4, 'SCC-11113', 'alvin', 'lagoras', '$2y$10$xT0XC1EOVjPDAY.8.OkRaeRuFCykKO0e5ZuPDafwuo3CGONkfNWoe', '2024-10-13 10:12:24'),
(5, 'SCC-11114', 'quby', 'lagoras', '$2y$10$fg7Dc971C9vnCMF9QMEzceLinan.tJ.KDVOhxOuDYjTxP7uO7E4ES', '2024-10-13 12:01:53');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`attendance_id`),
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`course_id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`student_id`),
  ADD UNIQUE KEY `student_rfid` (`student_rfid`),
  ADD KEY `fk_course` (`course_id`);

--
-- Indexes for table `teachers`
--
ALTER TABLE `teachers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `teacher_id` (`teacher_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `attendance_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=169;

--
-- AUTO_INCREMENT for table `teachers`
--
ALTER TABLE `teachers`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `attendance`
--
ALTER TABLE `attendance`
  ADD CONSTRAINT `attendance_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `students` (`student_id`) ON DELETE CASCADE;

--
-- Constraints for table `students`
--
ALTER TABLE `students`
  ADD CONSTRAINT `fk_course` FOREIGN KEY (`course_id`) REFERENCES `courses` (`course_id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
