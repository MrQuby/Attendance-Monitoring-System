-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 18, 2024 at 03:57 AM
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
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `admin_id` varchar(10) NOT NULL,
  `admin_firstname` varchar(50) NOT NULL,
  `admin_lastname` varchar(50) NOT NULL,
  `admin_email` varchar(100) NOT NULL,
  `admin_password` varchar(255) NOT NULL,
  `registered_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`admin_id`, `admin_firstname`, `admin_lastname`, `admin_email`, `admin_password`, `registered_at`) VALUES
('ACC-10001', 'ADMIN', '', 'admin@edu.com', '$2y$10$WU4sqEJdQH7lk9Qz72fEBuAEwoXecaEBlhd/OSY4lFVtqe9JwpvzS', '2024-11-17 06:33:11');

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
(408, 'SCC-10004', '2024-11-18', '11:03:57', '11:03:58', 'OUT', '2024-11-11 03:03:57'),
(409, 'SCC-10004', '2024-11-18', '11:03:59', NULL, 'IN', '2024-11-11 03:03:59'),
(410, 'SCC-10004', '2024-11-12', '11:04:07', '11:04:08', 'OUT', '2024-11-12 03:04:07'),
(411, 'SCC-10004', '2024-11-12', '11:04:09', '11:04:10', 'OUT', '2024-11-12 03:04:09'),
(412, 'SCC-10004', '2024-11-12', '11:05:53', '11:05:54', 'OUT', '2024-11-12 03:05:53'),
(413, 'SCC-10003', '2024-11-12', '11:06:01', '11:06:20', 'OUT', '2024-11-12 03:06:01'),
(414, 'SCC-10003', '2024-11-12', '11:06:21', '11:11:50', 'OUT', '2024-11-12 03:06:21'),
(415, 'SCC-10005', '2024-11-12', '11:06:23', '11:12:27', 'OUT', '2024-11-12 03:06:23'),
(416, 'SCC-10001', '2024-11-18', '11:06:24', '11:11:46', 'OUT', '2024-11-12 03:06:24'),
(417, 'SCC-10001', '2024-11-12', '11:11:47', '11:11:48', 'OUT', '2024-11-12 03:11:47'),
(418, 'SCC-10003', '2024-11-12', '11:11:51', '11:11:54', 'OUT', '2024-11-12 03:11:51'),
(419, 'SCC-10001', '2024-11-12', '11:12:12', '11:12:14', 'OUT', '2024-11-12 03:12:12'),
(420, 'SCC-10001', '2024-11-12', '11:12:15', '11:12:16', 'OUT', '2024-11-12 03:12:15'),
(421, 'SCC-10003', '2024-11-17', '11:12:24', NULL, 'IN', '2024-11-12 03:12:24'),
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
('SCC-10002', '0009600522', 'Joshua', 'Espanillo', '1st year', 'BSHM', 'test2@gmail.com', '2024-10-10', '09054444433', 'Naga, cebu', 'Male', 'Mother', '09999433333', 'uploads/671fb57933fb5-pexels-marleneleppanen-1183266.jpg', '2024-11-16 07:39:10', 1),
('SCC-10003', '0009698140', 'Jonard', 'Victorillo', '1st year', 'BSCRIM', 'jonard@gmail.com', '2024-11-01', '09054444433', 'Naga, Cebu', 'Male', 'Mother', '09999433333', 'uploads/jonard.jpg', NULL, 0),
('SCC-10004', '0009500522', 'Aljun', 'Delantae', '4th year', 'BSCRIM', 'aljun@gmail.com', '2024-11-01', '09054444433', 'Lipata, cebu', 'Male', 'Mother', '09999433333', 'uploads/67278b729ec13-aljun.jpg', NULL, 0),
('SCC-10005', '0009697931', 'Mike', 'Cortez', '2nd year', 'BSED', 'mike@gmail.com', '2024-10-04', '09054444433', 'Minglanilla', 'Male', 'Mother', '09999433333', 'uploads/67278bb61de3a-mike.jpg', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `teachers`
--

CREATE TABLE `teachers` (
  `teacher_id` varchar(50) NOT NULL,
  `teacher_firstname` varchar(100) NOT NULL,
  `teacher_lastname` varchar(100) NOT NULL,
  `teacher_email` varchar(150) NOT NULL,
  `teacher_password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `teachers`
--

INSERT INTO `teachers` (`teacher_id`, `teacher_firstname`, `teacher_lastname`, `teacher_email`, `teacher_password`, `created_at`) VALUES
('SCC-11112', 'Alvin', 'Lagoras', 'test@gmail.com', '$2y$10$WU4sqEJdQH7lk9Qz72fEBuAEwoXecaEBlhd/OSY4lFVtqe9JwpvzS', '2024-11-15 18:11:14'),
('SCC-11113', 'Alvin', 'Lagoras', 'test1@gmail.com', '$2y$10$n/O7QrTv8tmtOrZzsG/Phe1LbIilNKuEQVA70P6zvs.vlvosZ0OMq', '2024-11-18 01:24:52');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`admin_id`),
  ADD UNIQUE KEY `admin_email` (`admin_email`);

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
  ADD PRIMARY KEY (`teacher_id`),
  ADD UNIQUE KEY `teacher_email` (`teacher_email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `attendance_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=426;

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
