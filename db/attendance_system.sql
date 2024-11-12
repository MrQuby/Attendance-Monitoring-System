-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 12, 2024 at 05:08 AM
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
(408, 'SCC-10004', '2024-11-11', '11:03:57', '11:03:58', 'OUT', '2024-11-11 03:03:57'),
(409, 'SCC-10004', '2024-11-11', '11:03:59', NULL, 'IN', '2024-11-11 03:03:59'),
(410, 'SCC-10004', '2024-11-12', '11:04:07', '11:04:08', 'OUT', '2024-11-12 03:04:07'),
(411, 'SCC-10004', '2024-11-12', '11:04:09', '11:04:10', 'OUT', '2024-11-12 03:04:09'),
(412, 'SCC-10004', '2024-11-12', '11:05:53', '11:05:54', 'OUT', '2024-11-12 03:05:53'),
(413, 'SCC-10003', '2024-11-12', '11:06:01', '11:06:20', 'OUT', '2024-11-12 03:06:01'),
(414, 'SCC-10003', '2024-11-12', '11:06:21', '11:11:50', 'OUT', '2024-11-12 03:06:21'),
(415, 'SCC-10005', '2024-11-12', '11:06:23', '11:12:27', 'OUT', '2024-11-12 03:06:23'),
(416, 'SCC-10001', '2024-11-12', '11:06:24', '11:11:46', 'OUT', '2024-11-12 03:06:24'),
(417, 'SCC-10001', '2024-11-12', '11:11:47', '11:11:48', 'OUT', '2024-11-12 03:11:47'),
(418, 'SCC-10003', '2024-11-12', '11:11:51', '11:11:54', 'OUT', '2024-11-12 03:11:51'),
(419, 'SCC-10001', '2024-11-12', '11:12:12', '11:12:14', 'OUT', '2024-11-12 03:12:12'),
(420, 'SCC-10001', '2024-11-12', '11:12:15', '11:12:16', 'OUT', '2024-11-12 03:12:15'),
(421, 'SCC-10003', '2024-11-12', '11:12:24', NULL, 'IN', '2024-11-12 03:12:24'),
(422, 'SCC-10001', '2024-11-12', '11:29:23', '11:29:24', 'OUT', '2024-11-12 03:29:23'),
(423, 'SCC-10001', '2024-11-12', '11:29:25', '11:29:26', 'OUT', '2024-11-12 03:29:25'),
(424, 'SCC-10001', '2024-11-12', '11:29:26', '11:29:28', 'OUT', '2024-11-12 03:29:26'),
(425, 'SCC-10001', '2024-11-12', '11:29:28', '11:29:29', 'OUT', '2024-11-12 03:29:28');

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
  MODIFY `attendance_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=426;

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
