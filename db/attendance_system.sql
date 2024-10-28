-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 18, 2024 at 07:43 PM
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
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `student_id` varchar(50) NOT NULL,
  `student_firstname` varchar(100) NOT NULL,
  `student_lastname` varchar(100) NOT NULL,
  `student_level` varchar(100) NOT NULL,
  `student_course` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`student_id`, `student_firstname`, `student_lastname`, `student_level`, `student_course`) VALUES
('SCC-10001', 'Alvin', 'Lagaras', '3rd', 'BSIT'),
('SCC-10002', 'John', 'Doe', '3rd', 'BSIT');

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
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`student_id`);

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
-- AUTO_INCREMENT for table `teachers`
--
ALTER TABLE `teachers`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
