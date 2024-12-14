-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 14, 2024 at 02:04 AM
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
  `registered_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `reset_token` varchar(255) DEFAULT NULL,
  `reset_token_expires` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`admin_id`, `admin_firstname`, `admin_lastname`, `admin_email`, `admin_password`, `registered_at`, `reset_token`, `reset_token_expires`) VALUES
('ACC-10001', 'ADMIN', '', 'admin@edu.com', '$2y$10$WU4sqEJdQH7lk9Qz72fEBuAEwoXecaEBlhd/OSY4lFVtqe9JwpvzS', '2024-11-17 06:33:11', NULL, NULL);

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
(425, 'SCC-10001', '2024-11-12', '11:29:28', '11:29:29', 'OUT', '2024-11-12 03:29:28'),
(426, 'SCC-10001', '2024-12-07', '09:07:58', '09:09:01', 'OUT', '2024-12-07 01:09:01'),
(427, 'SCC-10001', '2024-12-07', '09:10:38', '09:11:59', 'OUT', '2024-12-07 01:11:59'),
(428, 'SCC-10001', '2024-12-07', '09:13:04', '09:14:17', 'OUT', '2024-12-07 01:14:17'),
(429, 'SCC-10001', '2024-12-07', '09:15:25', '09:17:03', 'OUT', '2024-12-07 01:17:03'),
(430, 'SCC-10001', '2024-12-07', '09:18:09', '09:19:35', 'OUT', '2024-12-07 01:19:35'),
(431, 'SCC-10001', '2024-12-07', '09:20:54', '09:22:01', 'OUT', '2024-12-07 01:22:01'),
(432, 'SCC-10005', '2024-12-07', '09:21:02', '09:22:09', 'OUT', '2024-12-07 01:22:09'),
(433, 'SCC-10001', '2024-12-07', '09:23:41', '09:25:08', 'OUT', '2024-12-07 01:25:08'),
(434, 'SCC-10005', '2024-12-07', '09:23:49', '09:25:13', 'OUT', '2024-12-07 01:25:13'),
(435, 'SCC-10001', '2024-12-07', '09:27:35', '09:28:53', 'OUT', '2024-12-07 01:28:53'),
(436, 'SCC-10005', '2024-12-07', '09:27:40', '09:28:49', 'OUT', '2024-12-07 01:28:49'),
(437, 'SCC-10005', '2024-12-07', '09:29:53', NULL, 'IN', '2024-12-07 01:29:53'),
(438, 'SCC-10001', '2024-12-07', '09:29:59', '09:50:58', 'OUT', '2024-12-07 01:50:58'),
(439, 'SCC-10003', '2024-12-07', '09:57:33', NULL, 'IN', '2024-12-07 01:57:33'),
(440, 'SCC-10001', '2024-12-07', '09:57:37', '11:45:13', 'OUT', '2024-12-07 03:45:13'),
(441, 'SCC-10001', '2024-12-07', '11:46:16', NULL, 'IN', '2024-12-07 03:46:16'),
(442, 'SCC-10006', '2024-12-14', '03:53:36', '03:55:04', 'OUT', '2024-12-13 19:55:04'),
(443, 'SCC-10007', '2024-12-14', '03:54:31', '04:06:58', 'OUT', '2024-12-13 20:06:58'),
(444, 'SCC-10006', '2024-12-14', '03:59:32', '04:06:22', 'OUT', '2024-12-13 20:06:22'),
(445, 'SCC-10004', '2024-12-14', '04:00:12', '04:06:55', 'OUT', '2024-12-13 20:06:55'),
(446, 'SCC-10005', '2024-12-14', '04:00:16', '04:06:57', 'OUT', '2024-12-13 20:06:57'),
(447, 'SCC-10003', '2024-12-14', '04:00:21', '04:06:59', 'OUT', '2024-12-13 20:06:59'),
(448, 'SCC-10010', '2024-12-14', '04:07:02', NULL, 'IN', '2024-12-13 20:07:02'),
(449, 'SCC-10009', '2024-12-14', '04:07:03', NULL, 'IN', '2024-12-13 20:07:03'),
(450, 'SCC-10008', '2024-12-14', '04:07:04', NULL, 'IN', '2024-12-13 20:07:04'),
(451, 'SCC-10006', '2024-12-14', '04:07:28', '04:08:41', 'OUT', '2024-12-13 20:08:41'),
(452, 'SCC-10006', '2024-12-14', '04:09:46', '04:11:02', 'OUT', '2024-12-13 20:11:02'),
(453, 'SCC-10006', '2024-12-14', '04:12:03', NULL, 'IN', '2024-12-13 20:12:03');

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `course_id` varchar(10) NOT NULL,
  `course_name` varchar(100) NOT NULL,
  `course_description` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`course_id`, `course_name`, `course_description`, `created_at`, `updated_at`, `deleted_at`) VALUES
('ACT', 'Associate in Computer Technology', 'A two-year course focused on IT and computer systems.', '2024-12-08 10:44:07', '2024-12-08 16:06:29', NULL),
('BSBA', 'Bachelor of Science in Business Administration', 'A course covering various aspects of business administration.', '2024-12-08 10:27:06', '2024-12-08 10:27:06', NULL),
('BSCRIM', 'Bachelor of Science in Criminology', 'A course focused on criminology and criminal justice.', '2024-12-08 10:27:06', '2024-12-08 10:27:06', NULL),
('BSCS', 'Bachelor of Science in Computer Science', 'A four-year program on computing, algorithms, and new developments in the field.', '2024-12-12 08:10:53', '2024-12-12 08:12:37', NULL),
('BSED', 'Bachelor of Science in Education', 'A course for students aiming to become educators.', '2024-12-08 10:27:06', '2024-12-08 10:27:06', NULL),
('BSHM', 'Bachelor of Science in Hospitality Management', 'A course focused on hospitality and management.', '2024-12-08 10:27:06', '2024-12-08 10:27:06', NULL),
('BSIT', 'Bachelor of Science in Information Technology', 'A four-year course focused on IT and computer systems.', '2024-12-08 10:27:06', '2024-12-08 10:27:06', NULL);

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
('1024001', '0000123456', 'John', 'Wick', '1st year', 'BSIT', 'john.doe@example.com', '2024-12-04', '1234567890', '123 Main St', 'Male', 'Jane Doe', '987654321', '../../uploads/pp.png', '2024-12-13 18:34:07', 1),
('2024001', '00RF123456', 'John', 'Doe', '1st year', 'BSIT', 'john.doe@example.com', '2024-10-03', '1234567890', '123 Main St', 'Male', 'Jane Doe', '987654321', '../../uploads/pp.png', NULL, 0),
('SCC-10001', '0009500936', 'Alvin', 'Lagoras', '1st year', 'ACT', 'test1@gmail.com', '2024-10-03', '09054444433', 'Minglanilla,Cebu', 'Male', 'Lupercia', '09054009658', 'uploads/671fb535d5d7a-328101249_863345214723439_1040826811328765772_n.jpg', NULL, 0),
('SCC-10002', '0009600522', 'Joshua', 'Espanillo', '1st year', 'BSHM', 'test2@gmail.com', '2024-10-10', '09054444433', 'Naga, cebu', 'Male', 'Mother', '09999433333', 'uploads/671fb57933fb5-pexels-marleneleppanen-1183266.jpg', '2024-11-16 07:39:10', 1),
('SCC-10003', '0009698140', 'Jonard', 'Victorillo', '1st year', 'BSCRIM', 'jonard@gmail.com', '2024-11-01', '09054444433', 'Naga, Cebu', 'Male', 'Janeza', '09999433333', 'uploads/jonard.jpg', NULL, 0),
('SCC-10004', '0009500522', 'Aljun', 'Delantar', '1st year', 'BSCRIM', 'aljun@gmail.com', '2024-11-01', '09054444433', 'Lipata, cebu', 'Male', 'mark', '09999433333', 'uploads/67278b729ec13-aljun.jpg', NULL, 0),
('SCC-10005', '0009697931', 'Mike', 'Cortez', '2nd year', 'BSED', 'mike@gmail.com', '2024-10-04', '09054444433', 'Minglanilla', 'Male', 'Mother', '09999433333', 'uploads/67278bb61de3a-mike.jpg', NULL, 0),
('SCC-10006', '0009499601', 'Romeo', 'Albarando', '1st year', 'BSIT', 'romeo.albarando@gmail.com', '2024-12-04', '09497767299', 'Pakigne, Minglanilla', 'Male', '09451290466', 'Juanita Albaran', 'uploads/675c5c8288f68-9b90a65f-6781-4bac-aba5-a59da00564fb.jpg', NULL, 0),
('SCC-10007', '0009762139', 'Irish', 'Rivera', '2nd year', 'BSBA', 'irish.rivera@gmail.com', '2021-02-09', '09054009658', 'Minglanilla. Cebu', 'Male', 'John Rivera', '09054009658', '../../../uploads/pp.png', NULL, 0),
('SCC-10008', '0009698141', 'Joshua', 'Espanillo', '1st year', 'BSCS', 'wangska@gmail.com', '2024-12-04', '09054009658', 'Minglanilla, Cebu', 'Male', 'Lyza Espanillo', '09054009658', '../../../uploads/pp.png', NULL, 0),
('SCC-10009', '0009697932', 'King', 'Ompad', '2nd year', 'BSED', 'king@gmail.com', '2024-12-01', '09054009658', 'Minglanilla, Cebu', 'Male', 'John Ompad', '09054009658', '../../../uploads/pp.png', NULL, 0),
('SCC-10010', '0009501849', 'Josh', 'Mendoza', '3rd year', 'BSIT', 'josh.medoza@gmail.com', '2024-12-01', '09054444433', 'CarCar, Cebu', 'Male', 'Maria Mendoza', '09054009658', '../../../uploads/pp.png', NULL, 0),
('SCC-2024001', '00RF100001', 'John', 'Smith', '1st Year', 'BSIT', 'john.smith@example.com', '2000-01-15', '09171234567', '123 Oak Street', 'Male', 'Mary Smith', '09187654321', '../../uploads/pp.png', NULL, 0),
('SCC-2024002', '00RF100002', 'Maria', 'Santos', '2nd Year', 'BSCS', 'maria.santos@example.com', '2000-03-22', '09182345678', '456 Maple Avenue', 'Female', 'Pedro Santos', '09189876543', '../../uploads/pp.png', NULL, 0),
('SCC-2024003', '00RF100003', 'James', 'Garcia', '3rd Year', 'BSIT', 'james.garcia@example.com', '1999-07-10', '09193456789', '789 Pine Road', 'Male', 'Elena Garcia', '09181234567', '../../uploads/pp.png', NULL, 0),
('SCC-2024004', '00RF100004', 'Sofia', 'Cruz', '1st Year', 'BSCS', 'sofia.cruz@example.com', '2001-05-18', '09204567890', '321 Cedar Lane', 'Female', 'Ramon Cruz', '09182345678', '../../uploads/pp.png', NULL, 0),
('SCC-2024005', '00RF100005', 'Michael', 'Reyes', '2nd Year', 'BSIT', 'michael.reyes@example.com', '2000-11-30', '09215678901', '654 Birch Street', 'Male', 'Ana Reyes', '09193456789', '../../uploads/pp.png', NULL, 0),
('SCC-2024006', '00RF100006', 'Emma', 'Tan', '3rd Year', 'BSCS', 'emma.tan@example.com', '2001-02-14', '09226789012', '987 Elm Court', 'Female', 'David Tan', '09204567890', '../../uploads/pp.png', NULL, 0),
('SCC-2024007', '00RF100007', 'Daniel', 'Lopez', '1st Year', 'BSIT', 'daniel.lopez@example.com', '1999-09-25', '09237890123', '147 Spruce Drive', 'Male', 'Carmen Lopez', '09215678901', '../../uploads/pp.png', NULL, 0),
('SCC-2024008', '00RF100008', 'Isabella', 'Torres', '2nd Year', 'BSCS', 'isabella.torres@example.com', '2000-06-08', '09248901234', '258 Willow Way', 'Female', 'Miguel Torres', '09226789012', '../../uploads/pp.png', NULL, 0),
('SCC-2024009', '00RF100009', 'Alexander', 'Flores', '3rd Year', 'BSIT', 'alex.flores@example.com', '2001-04-19', '09259012345', '369 Ash Avenue', 'Male', 'Rosa Flores', '09237890123', '../../uploads/pp.png', NULL, 0),
('SCC-2024010', '00RF100010', 'Sophia', 'Rivera', '1st Year', 'BSCS', 'sophia.rivera@example.com', '1999-12-03', '09260123456', '741 Palm Street', 'Female', 'Juan Rivera', '09248901234', '../../uploads/pp.png', NULL, 0),
('SCC-2024011', '00RF100011', 'William', 'Gomez', '2nd Year', 'BSIT', 'william.gomez@example.com', '2000-08-21', '09271234567', '852 Beach Road', 'Male', 'Maria Gomez', '09259012345', '../../uploads/pp.png', NULL, 0),
('SCC-2024012', '00RF100012', 'Olivia', 'Lim', '3rd Year', 'BSCS', 'olivia.lim@example.com', '2001-01-11', '09282345678', '963 Coast Highway', 'Female', 'Henry Lim', '09260123456', '../../uploads/pp.png', NULL, 0),
('SCC-2024013', '00RF100013', 'Benjamin', 'Santos', '1st Year', 'BSIT', 'ben.santos@example.com', '1999-10-28', '09293456789', '159 Mountain View', 'Male', 'Sofia Santos', '09271234567', '../../uploads/pp.png', NULL, 0),
('SCC-2024014', '00RF100014', 'Mia', 'Nguyen', '2nd Year', 'BSCS', 'mia.nguyen@example.com', '2000-07-16', '09304567890', '357 Valley Road', 'Female', 'Tran Nguyen', '09282345678', '../../uploads/pp.png', NULL, 0),
('SCC-2024015', '00RF100015', 'Lucas', 'Kim', '3rd Year', 'BSIT', 'lucas.kim@example.com', '2001-03-05', '09315678901', '246 Lake Avenue', 'Male', 'Jin Kim', '09293456789', '../../uploads/pp.png', NULL, 0),
('SCC-2024016', '00RF100016', 'Ava', 'Chen', '1st Year', 'BSCS', 'ava.chen@example.com', '1999-11-13', '09326789012', '135 River Street', 'Female', 'Wei Chen', '09304567890', '../../uploads/pp.png', NULL, 0),
('SCC-2024017', '00RF100017', 'Henry', 'Wang', '2nd Year', 'BSIT', 'henry.wang@example.com', '2000-09-02', '09337890123', '468 Forest Lane', 'Male', 'Li Wang', '09315678901', '../../uploads/pp.png', NULL, 0),
('SCC-2024018', '00RF100018', 'Charlotte', 'Lee', '3rd Year', 'BSCS', 'charlotte.lee@example.com', '2001-06-24', '09348901234', '791 Garden Road', 'Female', 'Min Lee', '09326789012', '../../uploads/pp.png', NULL, 0),
('SCC-2024019', '00RF100019', 'Sebastian', 'Park', '1st Year', 'BSIT', 'sebastian.park@example.com', '1999-08-07', '09359012345', '024 Sunset Drive', 'Male', 'Jung Park', '09337890123', '../../uploads/pp.png', NULL, 0),
('SCC-2024020', '00RF100020', 'Amelia', 'Wu', '2nd Year', 'BSCS', 'amelia.wu@example.com', '2000-04-30', '09360123456', '357 Sunrise Avenue', 'Female', 'Feng Wu', '09348901234', '../../uploads/pp.png', NULL, 0),
('SCC-2024021', '00RF100021', 'Jack', 'Zhang', '3rd Year', 'BSIT', 'jack.zhang@example.com', '2001-02-17', '09371234567', '680 Moon Street', 'Male', 'Hui Zhang', '09359012345', '../../uploads/pp.png', NULL, 0),
('SCC-2024022', '00RF100022', 'Victoria', 'Liu', '1st Year', 'BSCS', 'victoria.liu@example.com', '1999-12-09', '09382345678', '913 Star Road', 'Female', 'Mei Liu', '09360123456', '../../uploads/pp.png', NULL, 0),
('SCC-2024023', '00RF100023', 'Oliver', 'Cho', '2nd Year', 'BSIT', 'oliver.cho@example.com', '2000-10-26', '09393456789', '246 Galaxy Lane', 'Male', 'Soo Cho', '09371234567', '../../uploads/pp.png', NULL, 0),
('SCC-2024024', '00RF100024', 'Luna', 'Kang', '3rd Year', 'BSCS', 'luna.kang@example.com', '2001-07-14', '09404567890', '579 Universe Drive', 'Female', 'Min Kang', '09382345678', '../../uploads/pp.png', NULL, 0),
('SCC-2024025', '00RF100025', 'Leo', 'Yamamoto', '1st Year', 'BSIT', 'leo.yamamoto@example.com', '1999-05-01', '09415678901', '802 Cosmos Avenue', 'Male', 'Hiro Yamamoto', '09393456789', '../../uploads/pp.png', NULL, 0),
('SCC-2024026', '00RF100026', 'Grace', 'Tanaka', '2nd Year', 'BSCS', 'grace.tanaka@example.com', '2000-03-19', '09426789012', '135 Neptune Street', 'Female', 'Yuki Tanaka', '09404567890', '../../uploads/pp.png', NULL, 0),
('SCC-2024027', '00RF100027', 'Nathan', 'Suzuki', '3rd Year', 'BSIT', 'nathan.suzuki@example.com', '2001-01-06', '09437890123', '468 Mars Road', 'Male', 'Kenji Suzuki', '09415678901', '../../uploads/pp.png', NULL, 0),
('SCC-2024028', '00RF100028', 'Zoe', 'Sato', '1st Year', 'BSCS', 'zoe.sato@example.com', '1999-11-23', '09448901234', '791 Jupiter Lane', 'Female', 'Akiko Sato', '09426789012', '../../uploads/pp.png', NULL, 0),
('SCC-2024029', '00RF100029', 'Ryan', 'Watanabe', '2nd Year', 'BSIT', 'ryan.watanabe@example.com', '2000-08-10', '09459012345', '024 Saturn Drive', 'Male', 'Toshi Watanabe', '09437890123', '../../uploads/pp.png', NULL, 0),
('SCC-2024030', '00RF100030', 'Lily', 'Ito', '3rd Year', 'BSCS', 'lily.ito@example.com', '2001-05-28', '09460123456', '357 Venus Avenue', 'Female', 'Yumi Ito', '09448901234', '../../uploads/pp.png', NULL, 0),
('SCC-2024031', '00RF100031', 'Ethan', 'Nakamura', '1st Year', 'BSIT', 'ethan.nakamura@example.com', '1999-09-15', '09471234567', '680 Mercury Street', 'Male', 'Hiroshi Nakamura', '09459012345', '../../uploads/pp.png', NULL, 0),
('SCC-2024032', '00RF100032', 'Chloe', 'Kobayashi', '2nd Year', 'BSCS', 'chloe.kobayashi@example.com', '2000-06-03', '09482345678', '913 Pluto Road', 'Female', 'Sakura Kobayashi', '09460123456', '../../uploads/pp.png', NULL, 0),
('SCC-2024033', '00RF100033', 'David', 'Yamada', '3rd Year', 'BSIT', 'david.yamada@example.com', '2001-03-21', '09493456789', '246 Earth Lane', 'Male', 'Takeshi Yamada', '09471234567', '../../uploads/pp.png', NULL, 0),
('SCC-2024034', '00RF100034', 'Hannah', 'Saito', '1st Year', 'BSCS', 'hannah.saito@example.com', '1999-12-08', '09504567890', '579 Solar Drive', 'Female', 'Kaori Saito', '09482345678', '../../uploads/pp.png', NULL, 0),
('SCC-2024035', '00RF100035', 'Andrew', 'Matsuda', '2nd Year', 'BSIT', 'andrew.matsuda@example.com', '2000-09-26', '09515678901', '802 Lunar Avenue', 'Male', 'Ryo Matsuda', '09493456789', '../../uploads/pp.png', NULL, 0),
('SCC-2024036', '00RF100036', 'Aria', 'Fujita', '3rd Year', 'BSCS', 'aria.fujita@example.com', '2001-07-13', '09526789012', '135 Stellar Street', 'Female', 'Mika Fujita', '09504567890', '../../uploads/pp.png', NULL, 0),
('SCC-2024037', '00RF100037', 'Kevin', 'Takahashi', '1st Year', 'BSIT', 'kevin.takahashi@example.com', '1999-04-30', '09537890123', '468 Meteor Road', 'Male', 'Ken Takahashi', '09515678901', '../../uploads/pp.png', NULL, 0),
('SCC-2024038', '00RF100038', 'Scarlett', 'Nakajima', '2nd Year', 'BSCS', 'scarlett.nakajima@example.com', '2000-02-17', '09548901234', '791 Comet Lane', 'Female', 'Yoko Nakajima', '09526789012', '../../uploads/pp.png', NULL, 0),
('SCC-2024039', '00RF100039', 'Christopher', 'Kato', '3rd Year', 'BSIT', 'chris.kato@example.com', '2001-01-04', '09559012345', '024 Nova Drive', 'Male', 'Masashi Kato', '09537890123', '../../uploads/pp.png', NULL, 0),
('SCC-2024040', '00RF100040', 'Audrey', 'Yoshida', '1st Year', 'BSCS', 'audrey.yoshida@example.com', '1999-10-22', '09560123456', '357 Orbit Avenue', 'Female', 'Emi Yoshida', '09548901234', '../../uploads/pp.png', NULL, 0),
('SCC-2024041', '00RF100041', 'Matthew', 'Inoue', '2nd Year', 'BSIT', 'matthew.inoue@example.com', '2000-08-09', '09571234567', '680 Eclipse Street', 'Male', 'Daichi Inoue', '09559012345', '../../uploads/pp.png', NULL, 0),
('SCC-2024042', '00RF100042', 'Evelyn', 'Aoki', '3rd Year', 'BSCS', 'evelyn.aoki@example.com', '2001-05-27', '09582345678', '913 Celestial Road', 'Female', 'Nana Aoki', '09560123456', '../../uploads/pp.png', NULL, 0),
('SCC-2024043', '00RF100043', 'Joseph', 'Mori', '1st Year', 'BSIT', 'joseph.mori@example.com', '1999-03-14', '09593456789', '246 Astral Lane', 'Male', 'Shota Mori', '09571234567', '../../uploads/pp.png', NULL, 0),
('SCC-2024044', '00RF100044', 'Abigail', 'Abe', '2nd Year', 'BSCS', 'abigail.abe@example.com', '2000-12-31', '09604567890', '579 Nebula Drive', 'Female', 'Hana Abe', '09582345678', '../../uploads/pp.png', NULL, 0),
('SCC-2024045', '00RF100045', 'Thomas', 'Harada', '3rd Year', 'BSIT', 'thomas.harada@example.com', '2001-10-18', '09615678901', '802 Pulsar Avenue', 'Male', 'Yuto Harada', '09593456789', '../../uploads/pp.png', NULL, 0),
('SCC-2024046', '00RF100046', 'Emily', 'Endo', '1st Year', 'BSCS', 'emily.endo@example.com', '1999-07-05', '09626789012', '135 Quasar Street', 'Female', 'Rin Endo', '09604567890', '../../uploads/pp.png', NULL, 0),
('SCC-2024047', '00RF100047', 'Samuel', 'Okada', '2nd Year', 'BSIT', 'samuel.okada@example.com', '2000-04-23', '09637890123', '468 Horizon Road', 'Male', 'Riku Okada', '09615678901', '../../uploads/pp.png', NULL, 0),
('SCC-2024048', '00RF100048', 'Elizabeth', 'Maeda', '3rd Year', 'BSCS', 'elizabeth.maeda@example.com', '2001-02-09', '09648901234', '791 Dawn Lane', 'Female', 'Aoi Maeda', '09626789012', '../../uploads/pp.png', NULL, 0),
('SCC-2024049', '00RF100049', 'Daniel', 'Nomura', '1st Year', 'BSIT', 'daniel.nomura@example.com', '1999-11-27', '09659012345', '024 Dusk Drive', 'Male', 'Sora Nomura', '09637890123', '../../uploads/pp.png', NULL, 0),
('SCC-2024050', '00RF100050', 'Madison', 'Kikuchi', '2nd Year', 'BSCS', 'madison.kikuchi@example.com', '2000-09-14', '09660123456', '357 Twilight Avenue', 'Female', 'Mai Kikuchi', '09648901234', '../../uploads/pp.png', NULL, 0),
('SCC-2024051', '00RF100051', 'Christopher', 'Kubo', '3rd Year', 'BSIT', 'chris.kubo@example.com', '2001-06-01', '09671234567', '680 Aurora Street', 'Male', 'Yuki Kubo', '09659012345', '../../uploads/pp.png', NULL, 0),
('SCC-2024052', '00RF100052', 'Avery', 'Takeuchi', '1st Year', 'BSCS', 'avery.takeuchi@example.com', '1999-03-19', '09682345678', '913 Rainbow Road', 'Female', 'Miu Takeuchi', '09660123456', '../../uploads/pp.png', NULL, 0),
('SCC-2024053', '00RF100053', 'Andrew', 'Fujimoto', '2nd Year', 'BSIT', 'andrew.fujimoto@example.com', '2000-12-06', '09693456789', '246 Cloud Lane', 'Male', 'Haruki Fujimoto', '09671234567', '../../uploads/pp.png', NULL, 0),
('SCC-2024054', '00RF100054', 'Claire', 'Ogawa', '3rd Year', 'BSCS', 'claire.ogawa@example.com', '2001-09-23', '09704567890', '579 Storm Drive', 'Female', 'Yui Ogawa', '09682345678', '../../uploads/pp.png', NULL, 0),
('SCC-2024055', '00RF100055', 'Joshua', 'Arai', '1st Year', 'BSIT', 'joshua.arai@example.com', '1999-06-10', '09715678901', '802 Thunder Avenue', 'Male', 'Kenta Arai', '09693456789', '../../uploads/pp.png', NULL, 0),
('SCC-2024056', '00RF100056', 'Natalie', 'Sakamoto', '2nd Year', 'BSCS', 'natalie.sakamoto@example.com', '2000-03-28', '09726789012', '135 Lightning Street', 'Female', 'Risa Sakamoto', '09704567890', '../../uploads/pp.png', NULL, 0),
('SCC-2024057', '00RF100057', 'Ryan', 'Murakami', '3rd Year', 'BSIT', 'ryan.murakami@example.com', '2001-01-14', '09737890123', '468 Rain Road', 'Male', 'Yuma Murakami', '09715678901', '../../uploads/pp.png', NULL, 0),
('SCC-2024058', '00RF100058', 'Sarah', 'Nakano', '1st Year', 'BSCS', 'sarah.nakano@example.com', '1999-10-02', '09748901234', '791 Snow Lane', 'Female', 'Akane Nakano', '09726789012', '../../uploads/pp.png', NULL, 0),
('SCC-2024059', '00RF100059', 'Justin', 'Ono', '2nd Year', 'BSIT', 'justin.ono@example.com', '2000-07-19', '09759012345', '024 Frost Drive', 'Male', 'Takumi Ono', '09737890123', '../../uploads/pp.png', NULL, 0),
('SCC-2024060', '00RF100060', 'Rachel', 'Ishii', '3rd Year', 'BSCS', 'rachel.ishii@example.com', '2001-04-06', '09760123456', '357 Ice Avenue', 'Female', 'Saki Ishii', '09748901234', '../../uploads/pp.png', NULL, 0),
('SCC-2024061', '00RF100061', 'Brandon', 'Yamamoto', '1st Year', 'BSIT', 'brandon.yamamoto@example.com', '1999-08-23', '09771234567', '680 Spring Street', 'Male', 'Kenji Yamamoto', '09759012345', '../../uploads/pp.png', NULL, 0),
('SCC-2024062', '00RF100062', 'Lauren', 'Tanaka', '2nd Year', 'BSCS', 'lauren.tanaka@example.com', '2000-05-11', '09782345678', '913 Summer Road', 'Female', 'Ayumi Tanaka', '09760123456', '../../uploads/pp.png', NULL, 0),
('SCC-2024063', '00RF100063', 'Jonathan', 'Suzuki', '3rd Year', 'BSIT', 'jonathan.suzuki@example.com', '2001-02-27', '09793456789', '246 Autumn Lane', 'Male', 'Ryota Suzuki', '09771234567', '../../uploads/pp.png', NULL, 0),
('SCC-2024064', '00RF100064', 'Katherine', 'Sato', '1st Year', 'BSCS', 'katherine.sato@example.com', '1999-12-14', '09804567890', '579 Winter Drive', 'Female', 'Yuka Sato', '09782345678', '../../uploads/pp.png', NULL, 0),
('SCC-2024065', '00RF100065', 'Tyler', 'Watanabe', '2nd Year', 'BSIT', 'tyler.watanabe@example.com', '2000-09-01', '09815678901', '802 Maple Avenue', 'Male', 'Kazuki Watanabe', '09793456789', '../../uploads/pp.png', NULL, 0),
('SCC-2024066', '00RF100066', 'Samantha', 'Ito', '3rd Year', 'BSCS', 'samantha.ito@example.com', '2001-06-19', '09826789012', '135 Cherry Street', 'Female', 'Haruna Ito', '09804567890', '../../uploads/pp.png', NULL, 0),
('SCC-2024067', '00RF100067', 'Nicholas', 'Nakamura', '1st Year', 'BSIT', 'nicholas.nakamura@example.com', '1999-03-06', '09837890123', '468 Sakura Road', 'Male', 'Tatsuya Nakamura', '09815678901', '../../uploads/pp.png', NULL, 0),
('SCC-2024068', '00RF100068', 'Alexandra', 'Kobayashi', '2nd Year', 'BSCS', 'alexandra.kobayashi@example.com', '2000-12-24', '09848901234', '791 Bamboo Lane', 'Female', 'Momoka Kobayashi', '09826789012', '../../uploads/pp.png', NULL, 0),
('SCC-2024069', '00RF100069', 'Eric', 'Yamada', '3rd Year', 'BSIT', 'eric.yamada@example.com', '2001-10-11', '09859012345', '024 Pine Drive', 'Male', 'Ryuki Yamada', '09837890123', '../../uploads/pp.png', NULL, 0),
('SCC-2024070', '00RF100070', 'Julia', 'Saito', '1st Year', 'BSCS', 'julia.saito@example.com', '1999-07-28', '09860123456', '357 Cedar Avenue', 'Female', 'Nanami Saito', '09848901234', '../../uploads/pp.png', NULL, 0),
('SCC-2024071', '00RF100071', 'Steven', 'Matsuda', '2nd Year', 'BSIT', 'steven.matsuda@example.com', '2000-04-15', '09871234567', '680 Oak Street', 'Male', 'Hayato Matsuda', '09859012345', '../../uploads/pp.png', NULL, 0),
('SCC-2024072', '00RF100072', 'Morgan', 'Fujita', '3rd Year', 'BSCS', 'morgan.fujita@example.com', '2001-01-02', '09882345678', '913 Elm Road', 'Female', 'Misaki Fujita', '09860123456', '../../uploads/pp.png', NULL, 0),
('SCC-2024073', '00RF100073', 'Timothy', 'Takahashi', '1st Year', 'BSIT', 'timothy.takahashi@example.com', '1999-10-20', '09893456789', '246 Birch Lane', 'Male', 'Shun Takahashi', '09871234567', '../../uploads/pp.png', NULL, 0),
('SCC-2024074', '00RF100074', 'Gabriella', 'Nakajima', '2nd Year', 'BSCS', 'gabriella.nakajima@example.com', '2000-07-07', '09904567890', '579 Willow Drive', 'Female', 'Ayaka Nakajima', '09882345678', '../../uploads/pp.png', NULL, 0),
('SCC-2024075', '00RF100075', 'Adam', 'Kato', '3rd Year', 'BSIT', 'adam.kato@example.com', '2001-04-24', '09915678901', '802 Aspen Avenue', 'Male', 'Yuto Kato', '09893456789', '../../uploads/pp.png', NULL, 0),
('SCC-2024076', '00RF100076', 'Rebecca', 'Yoshida', '1st Year', 'BSCS', 'rebecca.yoshida@example.com', '1999-02-11', '09926789012', '135 Magnolia Street', 'Female', 'Kaho Yoshida', '09904567890', '../../uploads/pp.png', NULL, 0),
('SCC-2024077', '00RF100077', 'Patrick', 'Inoue', '2nd Year', 'BSIT', 'patrick.inoue@example.com', '2000-11-29', '09937890123', '468 Dogwood Road', 'Male', 'Sota Inoue', '09915678901', '../../uploads/pp.png', NULL, 0),
('SCC-2024078', '00RF100078', 'Caroline', 'Aoki', '3rd Year', 'BSCS', 'caroline.aoki@example.com', '2001-09-16', '09948901234', '791 Redwood Lane', 'Female', 'Yuna Aoki', '09926789012', '../../uploads/pp.png', NULL, 0),
('SCC-2024079', '00RF100079', 'Kenneth', 'Mori', '1st Year', 'BSIT', 'kenneth.mori@example.com', '1999-06-03', '09959012345', '024 Sequoia Drive', 'Male', 'Ren Mori', '09937890123', '../../uploads/pp.png', NULL, 0),
('SCC-2024080', '00RF100080', 'Allison', 'Abe', '2nd Year', 'BSCS', 'allison.abe@example.com', '2000-03-21', '09960123456', '357 Cypress Avenue', 'Female', 'Miki Abe', '09948901234', '../../uploads/pp.png', NULL, 0),
('SCC-2024081', '00RF100081', 'George', 'Harada', '3rd Year', 'BSIT', 'george.harada@example.com', '2001-01-07', '09971234567', '680 Palm Street', 'Male', 'Koki Harada', '09959012345', '../../uploads/pp.png', NULL, 0),
('SCC-2024082', '00RF100082', 'Vanessa', 'Endo', '1st Year', 'BSCS', 'vanessa.endo@example.com', '1999-10-25', '09982345678', '913 Coconut Road', 'Female', 'Rika Endo', '09960123456', '../../uploads/pp.png', NULL, 0),
('SCC-2024083', '00RF100083', 'Peter', 'Okada', '2nd Year', 'BSIT', 'peter.okada@example.com', '2000-08-12', '09993456789', '246 Banana Lane', 'Male', 'Yuki Okada', '09971234567', '../../uploads/pp.png', NULL, 0),
('SCC-2024084', '00RF100084', 'Brianna', 'Maeda', '3rd Year', 'BSCS', 'brianna.maeda@example.com', '2001-05-30', '09004567890', '579 Mango Drive', 'Female', 'Sana Maeda', '09982345678', '../../uploads/pp.png', NULL, 0),
('SCC-2024085', '00RF100085', 'Bryan', 'Nomura', '1st Year', 'BSIT', 'bryan.nomura@example.com', '1999-03-17', '09015678901', '802 Orange Avenue', 'Male', 'Riku Nomura', '09993456789', '../../uploads/pp.png', NULL, 0),
('SCC-2024086', '00RF100086', 'Nicole', 'Kikuchi', '2nd Year', 'BSCS', 'nicole.kikuchi@example.com', '2000-12-04', '09026789012', '135 Lemon Street', 'Female', 'Yui Kikuchi', '09004567890', '../../uploads/pp.png', NULL, 0),
('SCC-2024087', '00RF100087', 'Richard', 'Kubo', '3rd Year', 'BSIT', 'richard.kubo@example.com', '2001-09-22', '09037890123', '468 Lime Road', 'Male', 'Haruto Kubo', '09015678901', '../../uploads/pp.png', NULL, 0),
('SCC-2024088', '00RF100088', 'Catherine', 'Takeuchi', '1st Year', 'BSCS', 'catherine.takeuchi@example.com', '1999-07-09', '09048901234', '791 Apple Lane', 'Female', 'Mei Takeuchi', '09026789012', '../../uploads/pp.png', NULL, 0),
('SCC-2024089', '00RF100089', 'Scott', 'Fujimoto', '2nd Year', 'BSIT', 'scott.fujimoto@example.com', '2000-04-26', '09059012345', '024 Grape Drive', 'Male', 'Yuto Fujimoto', '09037890123', '../../uploads/pp.png', NULL, 0),
('SCC-2024090', '00RF100090', 'Angela', 'Ogawa', '3rd Year', 'BSCS', 'angela.ogawa@example.com', '2001-02-13', '09060123456', '357 Berry Avenue', 'Female', 'Hina Ogawa', '09048901234', '../../uploads/pp.png', NULL, 0),
('SCC-2024091', '00RF100091', 'Jeffrey', 'Arai', '1st Year', 'BSIT', 'jeffrey.arai@example.com', '1999-11-30', '09071234567', '680 Peach Street', 'Male', 'Kaito Arai', '09059012345', '../../uploads/pp.png', NULL, 0),
('SCC-2024092', '00RF100092', 'Andrea', 'Sakamoto', '2nd Year', 'BSCS', 'andrea.sakamoto@example.com', '2000-09-17', '09082345678', '913 Plum Road', 'Female', 'Aoi Sakamoto', '09060123456', '../../uploads/pp.png', NULL, 0),
('SCC-2024093', '00RF100093', 'Gregory', 'Murakami', '3rd Year', 'BSIT', 'gregory.murakami@example.com', '2001-06-05', '09093456789', '246 Pear Lane', 'Male', 'Sora Murakami', '09071234567', '../../uploads/pp.png', NULL, 0),
('SCC-2024094', '00RF100094', 'Christine', 'Nakano', '1st Year', 'BSCS', 'christine.nakano@example.com', '1999-03-22', '09104567890', '579 Fig Drive', 'Female', 'Riko Nakano', '09082345678', '../../uploads/pp.png', NULL, 0),
('SCC-2024095', '00RF100095', 'Jeremy', 'Ono', '2nd Year', 'BSIT', 'jeremy.ono@example.com', '2000-01-09', '09115678901', '802 Date Avenue', 'Male', 'Yuma Ono', '09093456789', '../../uploads/pp.png', NULL, 0),
('SCC-2024096', '00RF100096', 'Michelle', 'Ishii', '3rd Year', 'BSCS', 'michelle.ishii@example.com', '2001-10-27', '09126789012', '135 Kiwi Street', 'Female', 'Mio Ishii', '09104567890', '../../uploads/pp.png', NULL, 0),
('SCC-2024097', '00RF100097', 'Stephen', 'Yamamoto', '1st Year', 'BSIT', 'stephen.yamamoto@example.com', '1999-08-14', '09137890123', '468 Melon Road', 'Male', 'Ryo Yamamoto', '09115678901', '../../uploads/pp.png', NULL, 0),
('SCC-2024098', '00RF100098', 'Amanda', 'Tanaka', '2nd Year', 'BSCS', 'amanda.tanaka@example.com', '2000-05-01', '09148901234', '791 Papaya Lane', 'Female', 'Yuna Tanaka', '09126789012', '../../uploads/pp.png', NULL, 0),
('SCC-2024099', '00RF100099', 'Edward', 'Suzuki', '3rd Year', 'BSIT', 'edward.suzuki@example.com', '2001-02-18', '09159012345', '024 Guava Drive', 'Male', 'Kento Suzuki', '09137890123', '../../uploads/pp.png', NULL, 0),
('SCC-2024100', '00RF100100', 'Jessica', 'Sato', '1st Year', 'BSCS', 'jessica.sato@example.com', '1999-11-05', '09160123456', '357 Durian Avenue', 'Female', 'Sakura Sato', '09148901234', '../../uploads/pp.png', NULL, 0),
('SCC-2024101', '00RF100101', 'Michael', 'Johnson', '1st Year', 'BSIT', 'michael.johnson@example.com', '2000-06-15', '09161234567', '789 Pine Street', 'Male', 'Sarah Johnson', '09149012345', '../../uploads/pp.png', NULL, 0),
('SCC-2024102', '00RF100102', 'Emma', 'Williams', '2nd Year', 'BSCS', 'emma.williams@example.com', '2001-03-22', '09162345678', '456 Cedar Lane', 'Female', 'David Williams', '09150123456', '../../uploads/pp.png', NULL, 0),
('SCC-2024103', '00RF100103', 'Oliver', 'Brown', '1st Year', 'BSIT', 'oliver.brown@example.com', '1999-09-10', '09163456789', '147 Spruce Drive', 'Male', 'Carmen Brown', '09161234567', '../../uploads/pp.png', NULL, 0),
('SCC-2024104', '00RF100104', 'Isabella', 'Davis', '2nd Year', 'BSCS', 'isabella.davis@example.com', '2000-06-08', '09164567890', '258 Willow Way', 'Female', 'Miguel Davis', '09162345678', '../../uploads/pp.png', NULL, 0),
('SCC-2024105', '00RF100105', 'Alexander', 'Martin', '3rd Year', 'BSIT', 'alex.martin@example.com', '2001-04-19', '09165678901', '369 Ash Avenue', 'Male', 'Rosa Martin', '09163456789', '../../uploads/pp.png', NULL, 0),
('SCC-2024106', '00RF100106', 'Sophia', 'Harris', '1st Year', 'BSCS', 'sophia.harris@example.com', '1999-12-03', '09166789012', '741 Palm Street', 'Female', 'Juan Harris', '09164567890', '../../uploads/pp.png', NULL, 0),
('SCC-2024107', '00RF100107', 'William', 'White', '2nd Year', 'BSIT', 'william.white@example.com', '2000-08-21', '09167890123', '852 Beach Road', 'Male', 'Maria White', '09165678901', '../../uploads/pp.png', NULL, 0),
('SCC-2024108', '00RF100108', 'Olivia', 'Anderson', '3rd Year', 'BSCS', 'olivia.anderson@example.com', '2001-01-11', '09168901234', '963 Coast Highway', 'Female', 'Henry Anderson', '09166789012', '../../uploads/pp.png', NULL, 0),
('SCC-2024109', '00RF100109', 'Benjamin', 'Thomas', '1st Year', 'BSIT', 'ben.thomas@example.com', '1999-10-28', '09169012345', '159 Mountain View', 'Male', 'Sofia Thomas', '09167890123', '../../uploads/pp.png', NULL, 0),
('SCC-2024110', '00RF100110', 'Mia', 'Jackson', '2nd Year', 'BSCS', 'mia.jackson@example.com', '2000-07-16', '09170123456', '357 Valley Road', 'Female', 'Tran Jackson', '09168901234', '../../uploads/pp.png', NULL, 0),
('SCC-2024111', '00RF100111', 'Lucas', 'Miller', '3rd Year', 'BSIT', 'lucas.miller@example.com', '2001-03-05', '09171234567', '246 Lake Avenue', 'Male', 'Jin Miller', '09169012345', '../../uploads/pp.png', NULL, 0),
('SCC-2024112', '00RF100112', 'Ava', 'Wilson', '1st Year', 'BSCS', 'ava.wilson@example.com', '1999-11-13', '09172345678', '135 River Street', 'Female', 'Wei Wilson', '09170123456', '../../uploads/pp.png', NULL, 0),
('SCC-2024113', '00RF100113', 'Henry', 'Moore', '2nd Year', 'BSIT', 'henry.moore@example.com', '2000-09-02', '09173456789', '468 Forest Lane', 'Male', 'Li Moore', '09171234567', '../../uploads/pp.png', NULL, 0),
('SCC-2024114', '00RF100114', 'Charlotte', 'Taylor', '3rd Year', 'BSCS', 'charlotte.taylor@example.com', '2001-06-24', '09174567890', '791 Garden Road', 'Female', 'Min Taylor', '09172345678', '../../uploads/pp.png', NULL, 0),
('SCC-2024115', '00RF100115', 'Sebastian', 'Anderson', '1st Year', 'BSIT', 'sebastian.anderson@example.com', '1999-08-07', '09175678901', '024 Sunset Drive', 'Male', 'Jung Anderson', '09173456789', '../../uploads/pp.png', NULL, 0),
('SCC-2024116', '00RF100116', 'Amelia', 'Thomas', '2nd Year', 'BSCS', 'amelia.thomas@example.com', '2000-04-30', '09176789012', '357 Sunrise Avenue', 'Female', 'Feng Thomas', '09174567890', '../../uploads/pp.png', NULL, 0),
('SCC-2024117', '00RF100117', 'Jack', 'White', '3rd Year', 'BSIT', 'jack.white@example.com', '2001-02-17', '09177890123', '680 Moon Street', 'Male', 'Hui White', '09175678901', '../../uploads/pp.png', NULL, 0),
('SCC-2024118', '00RF100118', 'Victoria', 'Harris', '1st Year', 'BSCS', 'victoria.harris@example.com', '1999-12-09', '09178901234', '913 Star Road', 'Female', 'Mei Harris', '09176789012', '../../uploads/pp.png', NULL, 0),
('SCC-2024119', '00RF100119', 'Oliver', 'Martin', '2nd Year', 'BSIT', 'oliver.martin@example.com', '2000-10-26', '09179012345', '246 Galaxy Lane', 'Male', 'Soo Martin', '09177890123', '../../uploads/pp.png', NULL, 0),
('SCC-2024120', '00RF100120', 'Luna', 'Brown', '3rd Year', 'BSCS', 'luna.brown@example.com', '2001-07-14', '09180123456', '579 Universe Drive', 'Female', 'Min Brown', '09178901234', '../../uploads/pp.png', NULL, 0),
('SCC-2024121', '00RF100121', 'Leo', 'Davis', '1st Year', 'BSIT', 'leo.davis@example.com', '1999-05-01', '09181234567', '802 Cosmos Avenue', 'Male', 'Hiro Davis', '09179012345', '../../uploads/pp.png', NULL, 0),
('SCC-2024122', '00RF100122', 'Grace', 'Miller', '2nd Year', 'BSCS', 'grace.miller@example.com', '2000-03-19', '09182345678', '135 Neptune Street', 'Female', 'Yuki Miller', '09180123456', '../../uploads/pp.png', NULL, 0),
('SCC-2024123', '00RF100123', 'Nathan', 'Wilson', '3rd Year', 'BSIT', 'nathan.wilson@example.com', '2001-01-06', '09183456789', '468 Mars Road', 'Male', 'Kenji Wilson', '09181234567', '../../uploads/pp.png', NULL, 0),
('SCC-2024124', '00RF100124', 'Zoe', 'Moore', '1st Year', 'BSCS', 'zoe.moore@example.com', '1999-11-23', '09184567890', '791 Jupiter Lane', 'Female', 'Akiko Moore', '09182345678', '../../uploads/pp.png', NULL, 0),
('SCC-2024125', '00RF100125', 'Ryan', 'Taylor', '2nd Year', 'BSIT', 'ryan.taylor@example.com', '2000-08-10', '09185678901', '024 Saturn Drive', 'Male', 'Toshi Taylor', '09183456789', '../../uploads/pp.png', NULL, 0),
('SCC-2024126', '00RF100126', 'Lily', 'Anderson', '3rd Year', 'BSCS', 'lily.anderson@example.com', '2001-05-28', '09186789012', '357 Venus Avenue', 'Female', 'Yumi Anderson', '09184567890', '../../uploads/pp.png', NULL, 0),
('SCC-2024127', '00RF100127', 'Ethan', 'Thomas', '1st Year', 'BSIT', 'ethan.thomas@example.com', '1999-09-15', '09187890123', '680 Mercury Street', 'Male', 'Hiroshi Thomas', '09185678901', '../../uploads/pp.png', NULL, 0),
('SCC-2024128', '00RF100128', 'Chloe', 'Harris', '2nd Year', 'BSCS', 'chloe.harris@example.com', '2000-06-03', '09188901234', '913 Pluto Road', 'Female', 'Sakura Harris', '09186789012', '../../uploads/pp.png', NULL, 0),
('SCC-2024129', '00RF100129', 'David', 'White', '3rd Year', 'BSIT', 'david.white@example.com', '2001-03-21', '09189012345', '246 Earth Lane', 'Male', 'Takeshi White', '09187890123', '../../uploads/pp.png', NULL, 0),
('SCC-2024130', '00RF100130', 'Hannah', 'Martin', '1st Year', 'BSCS', 'hannah.martin@example.com', '1999-12-08', '09190123456', '579 Solar Drive', 'Female', 'Kaori Martin', '09188901234', '../../uploads/pp.png', NULL, 0),
('SCC-2024131', '00RF100131', 'Andrew', 'Brown', '2nd Year', 'BSIT', 'andrew.brown@example.com', '2000-09-26', '09191234567', '802 Lunar Avenue', 'Male', 'Ryo Brown', '09189012345', '../../uploads/pp.png', NULL, 0),
('SCC-2024132', '00RF100132', 'Aria', 'Davis', '3rd Year', 'BSCS', 'aria.davis@example.com', '2001-07-13', '09192345678', '135 Stellar Street', 'Female', 'Mika Davis', '09190123456', '../../uploads/pp.png', NULL, 0),
('SCC-2024133', '00RF100133', 'Kevin', 'Miller', '1st Year', 'BSIT', 'kevin.miller@example.com', '1999-04-30', '09193456789', '468 Meteor Road', 'Male', 'Ken Miller', '09191234567', '../../uploads/pp.png', NULL, 0),
('SCC-2024134', '00RF100134', 'Scarlett', 'Wilson', '2nd Year', 'BSCS', 'scarlett.wilson@example.com', '2000-02-17', '09194567890', '791 Comet Lane', 'Female', 'Yoko Wilson', '09192345678', '../../uploads/pp.png', NULL, 0),
('SCC-2024135', '00RF100135', 'Christopher', 'Moore', '3rd Year', 'BSIT', 'chris.moore@example.com', '2001-01-04', '09195678901', '024 Nova Drive', 'Male', 'Masashi Moore', '09193456789', '../../uploads/pp.png', NULL, 0),
('SCC-2024136', '00RF100136', 'Audrey', 'Taylor', '1st Year', 'BSCS', 'audrey.taylor@example.com', '1999-10-22', '09196789012', '357 Orbit Avenue', 'Female', 'Emi Taylor', '09194567890', '../../uploads/pp.png', NULL, 0),
('SCC-2024137', '00RF100137', 'Matthew', 'Anderson', '2nd Year', 'BSIT', 'matthew.anderson@example.com', '2000-08-09', '09197890123', '680 Eclipse Street', 'Male', 'Daichi Anderson', '09195678901', '../../uploads/pp.png', NULL, 0),
('SCC-2024138', '00RF100138', 'Evelyn', 'Thomas', '3rd Year', 'BSCS', 'evelyn.thomas@example.com', '2001-05-27', '09198901234', '913 Celestial Road', 'Female', 'Nana Thomas', '09196789012', '../../uploads/pp.png', NULL, 0),
('SCC-2024139', '00RF100139', 'Joseph', 'Harris', '1st Year', 'BSIT', 'joseph.harris@example.com', '1999-03-14', '09204567890', '246 Astral Lane', 'Male', 'Shota Harris', '09197890123', '../../uploads/pp.png', NULL, 0),
('SCC-2024140', '00RF100140', 'Abigail', 'White', '2nd Year', 'BSCS', 'abigail.white@example.com', '2000-12-31', '09215678901', '579 Nebula Drive', 'Female', 'Hana White', '09198901234', '../../uploads/pp.png', NULL, 0),
('SCC-2024141', '00RF100141', 'Thomas', 'Martin', '3rd Year', 'BSIT', 'thomas.martin@example.com', '2001-10-18', '09226789012', '802 Pulsar Avenue', 'Male', 'Yuto Martin', '09204567890', '../../uploads/pp.png', NULL, 0),
('SCC-2024142', '00RF100142', 'Emily', 'Brown', '1st Year', 'BSCS', 'emily.brown@example.com', '1999-07-05', '09237890123', '135 Quasar Street', 'Female', 'Rin Brown', '09215678901', '../../uploads/pp.png', NULL, 0),
('SCC-2024143', '00RF100143', 'Samuel', 'Davis', '2nd Year', 'BSIT', 'samuel.davis@example.com', '2000-04-23', '09248901234', '468 Horizon Road', 'Male', 'Riku Davis', '09226789012', '../../uploads/pp.png', NULL, 0),
('SCC-2024144', '00RF100144', 'Elizabeth', 'Miller', '3rd Year', 'BSCS', 'elizabeth.miller@example.com', '2001-02-09', '09259012345', '791 Dawn Lane', 'Female', 'Aoi Miller', '09237890123', '../../uploads/pp.png', NULL, 0),
('SCC-2024145', '00RF100145', 'Daniel', 'Wilson', '1st Year', 'BSIT', 'daniel.wilson@example.com', '1999-11-27', '09260123456', '024 Dusk Drive', 'Male', 'Sora Wilson', '09248901234', '../../uploads/pp.png', NULL, 0),
('SCC-2024146', '00RF100146', 'Madison', 'Moore', '2nd Year', 'BSCS', 'madison.moore@example.com', '2000-09-14', '09271234567', '357 Twilight Avenue', 'Female', 'Mai Moore', '09259012345', '../../uploads/pp.png', NULL, 0),
('SCC-2024147', '00RF100147', 'Christopher', 'Taylor', '3rd Year', 'BSIT', 'chris.taylor@example.com', '2001-06-01', '09282345678', '680 Aurora Street', 'Male', 'Yuki Taylor', '09260123456', '../../uploads/pp.png', NULL, 0),
('SCC-2024148', '00RF100148', 'Avery', 'Anderson', '1st Year', 'BSCS', 'avery.anderson@example.com', '1999-03-19', '09293456789', '913 Rainbow Road', 'Female', 'Miu Anderson', '09271234567', '../../uploads/pp.png', NULL, 0),
('SCC-2024149', '00RF100149', 'Andrew', 'Thomas', '2nd Year', 'BSIT', 'andrew.thomas@example.com', '2000-12-06', '09294567890', '246 Cloud Lane', 'Male', 'Haruki Thomas', '09282345678', '../../uploads/pp.png', NULL, 0),
('SCC-2024150', '00RF100150', 'Claire', 'Harris', '3rd Year', 'BSCS', 'claire.harris@example.com', '2001-09-23', '09304567890', '579 Storm Drive', 'Female', 'Yui Harris', '09293456789', '../../uploads/pp.png', NULL, 0),
('SCC-2024151', '00RF100151', 'Joshua', 'White', '1st Year', 'BSIT', 'joshua.white@example.com', '1999-06-10', '09315678901', '802 Thunder Avenue', 'Male', 'Kenta White', '09304567890', '../../uploads/pp.png', NULL, 0),
('SCC-2024152', '00RF100152', 'Natalie', 'Martin', '2nd Year', 'BSCS', 'natalie.martin@example.com', '2000-03-28', '09326789012', '135 Lightning Street', 'Female', 'Risa Martin', '09315678901', '../../uploads/pp.png', NULL, 0),
('SCC-2024153', '00RF100153', 'Ryan', 'Brown', '3rd Year', 'BSIT', 'ryan.brown@example.com', '2001-01-14', '09337890123', '468 Rain Road', 'Male', 'Yuma Brown', '09326789012', '../../uploads/pp.png', NULL, 0),
('SCC-2024154', '00RF100154', 'Sarah', 'Davis', '1st Year', 'BSCS', 'sarah.davis@example.com', '1999-10-02', '09348901234', '791 Snow Lane', 'Female', 'Akane Davis', '09337890123', '../../uploads/pp.png', NULL, 0),
('SCC-2024155', '00RF100155', 'Marcus', 'Chen', '1st Year', 'BSIT', 'marcus.chen@example.com', '2000-07-15', '09401234567', '123 Maple Drive', 'Male', 'Linda Chen', '09391234567', '../../uploads/pp.png', NULL, 0),
('SCC-2024156', '00RF100156', 'Rachel', 'Kim', '2nd Year', 'BSCS', 'rachel.kim@example.com', '2001-04-22', '09402345678', '456 Oak Lane', 'Female', 'James Kim', '09392345678', '../../uploads/pp.png', NULL, 0),
('SCC-2024157', '00RF100157', 'Brandon', 'Wang', '3rd Year', 'BSIT', 'brandon.wang@example.com', '1999-09-30', '09403456789', '789 Pine Court', 'Male', 'Susan Wang', '09393456789', '../../uploads/pp.png', NULL, 0),
('SCC-2024158', '00RF100158', 'Sophia', 'Liu', '1st Year', 'BSCS', 'sophia.liu@example.com', '2000-06-18', '09404567890', '321 Cedar Street', 'Female', 'Michael Liu', '09394567890', '../../uploads/pp.png', NULL, 0),
('SCC-2024159', '00RF100159', 'Jason', 'Zhang', '2nd Year', 'BSIT', 'jason.zhang@example.com', '2001-03-25', '09405678901', '654 Birch Avenue', 'Male', 'Jennifer Zhang', '09395678901', '../../uploads/pp.png', NULL, 0),
('SCC-2024160', '00RF100160', 'Emily', 'Wu', '3rd Year', 'BSCS', 'emily.wu@example.com', '1999-12-10', '09406789012', '987 Elm Road', 'Female', 'Robert Wu', '09396789012', '../../uploads/pp.png', NULL, 0),
('SCC-2024161', '00RF100161', 'Kevin', 'Li', '1st Year', 'BSIT', 'kevin.li@example.com', '2000-09-05', '09407890123', '147 Spruce Lane', 'Male', 'Patricia Li', '09397890123', '../../uploads/pp.png', NULL, 0),
('SCC-2024162', '00RF100162', 'Michelle', 'Huang', '2nd Year', 'BSCS', 'michelle.huang@example.com', '2001-06-20', '09408901234', '258 Willow Path', 'Female', 'David Huang', '09398901234', '../../uploads/pp.png', NULL, 0),
('SCC-2024163', '00RF100163', 'Daniel', 'Zhou', '3rd Year', 'BSIT', 'daniel.zhou@example.com', '1999-11-15', '09409012345', '369 Ash Circle', 'Male', 'Mary Zhou', '09399012345', '../../uploads/pp.png', NULL, 0),
('SCC-2024164', '00RF100164', 'Angela', 'Sun', '1st Year', 'BSCS', 'angela.sun@example.com', '2000-08-28', '09410123456', '741 Oak Court', 'Female', 'John Sun', '09400123456', '../../uploads/pp.png', NULL, 0),
('SCC-2024165', '00RF100165', 'Marco', 'Dela Cruz', '2nd Year', 'BSIT', 'marco.delacruz@example.com', '2001-04-12', '09411234567', '852 Maple Street', 'Male', 'Teresa Dela Cruz', '09401234567', '../../uploads/pp.png', NULL, 0),
('SCC-2024166', '00RF100166', 'Sofia', 'Ramos', '3rd Year', 'BSCS', 'sofia.ramos@example.com', '2000-09-25', '09412345678', '963 Pine Avenue', 'Female', 'Ramon Ramos', '09402345678', '../../uploads/pp.png', NULL, 0),
('SCC-2024167', '00RF100167', 'Gabriel', 'Mendoza', '1st Year', 'BSIT', 'gabriel.mendoza@example.com', '1999-12-08', '09413456789', '741 Cedar Road', 'Male', 'Maria Mendoza', '09403456789', '../../uploads/pp.png', NULL, 0),
('SCC-2024168', '00RF100168', 'Isabella', 'Santos', '2nd Year', 'BSCS', 'isabella.santos@example.com', '2001-07-21', '09414567890', '159 Birch Lane', 'Female', 'Jose Santos', '09404567890', '../../uploads/pp.png', NULL, 0),
('SCC-2024169', '00RF100169', 'Rafael', 'Torres', '3rd Year', 'BSIT', 'rafael.torres@example.com', '2000-02-14', '09415678901', '357 Elm Drive', 'Male', 'Carmen Torres', '09405678901', '../../uploads/pp.png', NULL, 0),
('SCC-2024170', '00RF100170', 'Camila', 'Reyes', '1st Year', 'BSCS', 'camila.reyes@example.com', '1999-11-30', '09416789012', '456 Oak Circle', 'Female', 'Antonio Reyes', '09406789012', '../../uploads/pp.png', NULL, 0),
('SCC-2024171', '00RF100171', 'Diego', 'Fernandez', '2nd Year', 'BSIT', 'diego.fernandez@example.com', '2001-06-03', '09417890123', '789 Spruce Path', 'Male', 'Laura Fernandez', '09407890123', '../../uploads/pp.png', NULL, 0),
('SCC-2024172', '00RF100172', 'Valentina', 'Cruz', '3rd Year', 'BSCS', 'valentina.cruz@example.com', '2000-01-16', '09418901234', '123 Willow Court', 'Female', 'Miguel Cruz', '09408901234', '../../uploads/pp.png', NULL, 0),
('SCC-2024173', '00RF100173', 'Mateo', 'Garcia', '1st Year', 'BSIT', 'mateo.garcia@example.com', '1999-08-29', '09419012345', '456 Ash Street', 'Male', 'Ana Garcia', '09409012345', '../../uploads/pp.png', NULL, 0),
('SCC-2024174', '00RF100174', 'Luna', 'Morales', '2nd Year', 'BSCS', 'luna.morales@example.com', '2001-03-12', '09420123456', '789 Beech Road', 'Female', 'Roberto Morales', '09410123456', '../../uploads/pp.png', NULL, 0),
('SCC-2024175', '00RF100175', 'Samuel', 'Rivera', '3rd Year', 'BSIT', 'samuel.rivera@example.com', '2000-10-25', '09421234567', '321 Pine Lane', 'Male', 'Elena Rivera', '09411234567', '../../uploads/pp.png', NULL, 0),
('SCC-2024176', '00RF100176', 'Victoria', 'Gomez', '1st Year', 'BSCS', 'victoria.gomez@example.com', '1999-05-08', '09422345678', '654 Cedar Avenue', 'Female', 'Carlos Gomez', '09412345678', '../../uploads/pp.png', NULL, 0),
('SCC-2024177', '00RF100177', 'Nicolas', 'Flores', '2nd Year', 'BSIT', 'nicolas.flores@example.com', '2001-12-21', '09423456789', '987 Maple Drive', 'Male', 'Isabel Flores', '09413456789', '../../uploads/pp.png', NULL, 0),
('SCC-2024178', '00RF100178', 'Lucia', 'Perez', '3rd Year', 'BSCS', 'lucia.perez@example.com', '2000-07-04', '09424567890', '147 Oak Path', 'Female', 'Manuel Perez', '09414567890', '../../uploads/pp.png', NULL, 0),
('SCC-2024179', '00RF100179', 'Emilio', 'Martinez', '1st Year', 'BSIT', 'emilio.martinez@example.com', '1999-02-17', '09425678901', '258 Elm Court', 'Male', 'Rosa Martinez', '09415678901', '../../uploads/pp.png', NULL, 0),
('SCC-2024180', '00RF100180', 'Catalina', 'Rodriguez', '2nd Year', 'BSCS', 'catalina.rodriguez@example.com', '2001-09-30', '09426789012', '369 Birch Street', 'Female', 'Juan Rodriguez', '09416789012', '../../uploads/pp.png', NULL, 0),
('SCC-2024181', '00RF100181', 'Joaquin', 'Sanchez', '3rd Year', 'BSIT', 'joaquin.sanchez@example.com', '2000-04-13', '09427890123', '741 Spruce Lane', 'Male', 'Carmen Sanchez', '09417890123', '../../uploads/pp.png', NULL, 0),
('SCC-2024182', '00RF100182', 'Miranda', 'Diaz', '1st Year', 'BSCS', 'miranda.diaz@example.com', '1999-11-26', '09428901234', '852 Willow Road', 'Female', 'Felipe Diaz', '09418901234', '../../uploads/pp.png', NULL, 0),
('SCC-2024183', '00RF100183', 'Felipe', 'Torres', '2nd Year', 'BSIT', 'felipe.torres@example.com', '2001-06-09', '09429012345', '963 Ash Avenue', 'Male', 'Maria Torres', '09419012345', '../../uploads/pp.png', NULL, 0),
('SCC-2024184', '00RF100184', 'Daniela', 'Ramirez', '3rd Year', 'BSCS', 'daniela.ramirez@example.com', '2000-01-22', '09430123456', '159 Beech Drive', 'Female', 'Jose Ramirez', '09420123456', '../../uploads/pp.png', NULL, 0),
('SCC-2024185', '00RF100185', 'Andres', 'Herrera', '1st Year', 'BSIT', 'andres.herrera@example.com', '1999-08-05', '09431234567', '357 Pine Path', 'Male', 'Ana Herrera', '09421234567', '../../uploads/pp.png', NULL, 0),
('SCC-2024186', '00RF100186', 'Regina', 'Castro', '2nd Year', 'BSCS', 'regina.castro@example.com', '2001-03-18', '09432345678', '456 Cedar Court', 'Female', 'Luis Castro', '09422345678', '../../uploads/pp.png', NULL, 0),
('SCC-2024187', '00RF100187', 'Martin', 'Ortiz', '3rd Year', 'BSIT', 'martin.ortiz@example.com', '2000-10-31', '09433456789', '789 Maple Lane', 'Male', 'Sofia Ortiz', '09423456789', '../../uploads/pp.png', NULL, 0),
('SCC-2024188', '00RF100188', 'Carolina', 'Vargas', '1st Year', 'BSCS', 'carolina.vargas@example.com', '1999-05-14', '09434567890', '123 Oak Road', 'Female', 'Diego Vargas', '09424567890', '../../uploads/pp.png', NULL, 0),
('SCC-2024189', '00RF100189', 'Lorenzo', 'Jimenez', '2nd Year', 'BSIT', 'lorenzo.jimenez@example.com', '2001-12-27', '09435678901', '456 Elm Street', 'Male', 'Laura Jimenez', '09425678901', '../../uploads/pp.png', NULL, 0),
('SCC-2024190', '00RF100190', 'Valeria', 'Moreno', '3rd Year', 'BSCS', 'valeria.moreno@example.com', '2000-07-10', '09436789012', '789 Birch Avenue', 'Female', 'Carlos Moreno', '09426789012', '../../uploads/pp.png', NULL, 0),
('SCC-2024191', '00RF100191', 'Sebastian', 'Silva', '1st Year', 'BSIT', 'sebastian.silva@example.com', '1999-02-23', '09437890123', '321 Spruce Drive', 'Male', 'Isabel Silva', '09427890123', '../../uploads/pp.png', NULL, 0),
('SCC-2024192', '00RF100192', 'Mariana', 'Romero', '2nd Year', 'BSCS', 'mariana.romero@example.com', '2001-09-06', '09438901234', '654 Willow Path', 'Female', 'Antonio Romero', '09428901234', '../../uploads/pp.png', NULL, 0),
('SCC-2024193', '00RF100193', 'Ricardo', 'Ruiz', '3rd Year', 'BSIT', 'ricardo.ruiz@example.com', '2000-04-19', '09439012345', '987 Ash Lane', 'Male', 'Elena Ruiz', '09429012345', '../../uploads/pp.png', NULL, 0),
('SCC-2024194', '00RF100194', 'Adriana', 'Navarro', '1st Year', 'BSCS', 'adriana.navarro@example.com', '1999-11-02', '09440123456', '147 Beech Court', 'Female', 'Manuel Navarro', '09430123456', '../../uploads/pp.png', NULL, 0),
('SCC-2024195', '00RF100195', 'Fernando', 'Medina', '2nd Year', 'BSIT', 'fernando.medina@example.com', '2001-06-15', '09441234567', '258 Pine Road', 'Male', 'Rosa Medina', '09431234567', '../../uploads/pp.png', NULL, 0),
('SCC-2024196', '00RF100196', 'Gabriela', 'Acosta', '3rd Year', 'BSCS', 'gabriela.acosta@example.com', '2000-01-28', '09442345678', '369 Cedar Street', 'Female', 'Juan Acosta', '09432345678', '../../uploads/pp.png', NULL, 0),
('SCC-2024197', '00RF100197', 'Eduardo', 'Rojas', '1st Year', 'BSIT', 'eduardo.rojas@example.com', '1999-08-11', '09443456789', '741 Maple Avenue', 'Male', 'Carmen Rojas', '09433456789', '../../uploads/pp.png', NULL, 0),
('SCC-2024198', '00RF100198', 'Antonella', 'Flores', '2nd Year', 'BSCS', 'antonella.flores@example.com', '2001-03-24', '09444567890', '852 Oak Drive', 'Female', 'Felipe Flores', '09434567890', '../../uploads/pp.png', NULL, 0),
('SCC-2024199', '00RF100199', 'Santiago', 'Chavez', '3rd Year', 'BSIT', 'santiago.chavez@example.com', '2000-10-07', '09445678901', '963 Elm Path', 'Male', 'Maria Chavez', '09435678901', '../../uploads/pp.png', NULL, 0),
('SCC-2024200', '00RF100200', 'Valentina', 'Pena', '1st Year', 'BSCS', 'valentina.pena@example.com', '1999-05-20', '09446789012', '159 Birch Road', 'Female', 'Jose Pena', '09436789012', '../../uploads/pp.png', NULL, 0),
('SCC-2024201', '00RF100201', 'Miguel', 'Bautista', '2nd Year', 'BSIT', 'miguel.bautista@example.com', '2000-06-15', '09447890123', '753 Maple Court', 'Male', 'Elena Bautista', '09437890123', '../../uploads/pp.png', NULL, 0),
('SCC-2024202', '00RF100202', 'Andrea', 'Santos', '3rd Year', 'BSCS', 'andrea.santos@example.com', '2001-01-28', '09448901234', '852 Pine Street', 'Female', 'Carlos Santos', '09438901234', '../../uploads/pp.png', NULL, 0),
('SCC-2024203', '00RF100203', 'Lucas', 'Villanueva', '1st Year', 'BSIT', 'lucas.villanueva@example.com', '1999-09-11', '09449012345', '951 Oak Avenue', 'Male', 'Maria Villanueva', '09439012345', '../../uploads/pp.png', NULL, 0),
('SCC-2024204', '00RF100204', 'Julia', 'Pascual', '2nd Year', 'BSCS', 'julia.pascual@example.com', '2000-04-24', '09450123456', '159 Cedar Lane', 'Female', 'Antonio Pascual', '09440123456', '../../uploads/pp.png', NULL, 0),
('SCC-2024205', '00RF100205', 'Diego', 'Ramos', '3rd Year', 'BSIT', 'diego.ramos@example.com', '2001-11-07', '09451234567', '357 Birch Road', 'Male', 'Sofia Ramos', '09441234567', '../../uploads/pp.png', NULL, 0),
('SCC-2024206', '00RF100206', 'Camila', 'Mercado', '1st Year', 'BSCS', 'camila.mercado@example.com', '1999-06-20', '09452345678', '456 Elm Path', 'Female', 'Juan Mercado', '09442345678', '../../uploads/pp.png', NULL, 0),
('SCC-2024207', '00RF100207', 'Matias', 'Cruz', '2nd Year', 'BSIT', 'matias.cruz@example.com', '2000-02-03', '09453456789', '654 Spruce Drive', 'Male', 'Carmen Cruz', '09443456789', '../../uploads/pp.png', NULL, 0),
('SCC-2024208', '00RF100208', 'Valentina', 'Reyes', '3rd Year', 'BSCS', 'valentina.reyes@example.com', '2001-09-16', '09454567890', '753 Willow Street', 'Female', 'Miguel Reyes', '09444567890', '../../uploads/pp.png', NULL, 0),
('SCC-2024209', '00RF100209', 'Sebastian', 'Torres', '1st Year', 'BSIT', 'sebastian.torres@example.com', '1999-04-29', '09455678901', '852 Ash Avenue', 'Male', 'Ana Torres', '09445678901', '../../uploads/pp.png', NULL, 0),
('SCC-2024210', '00RF100210', 'Isabella', 'Garcia', '2nd Year', 'BSCS', 'isabella.garcia@example.com', '2000-12-12', '09456789012', '951 Beech Lane', 'Female', 'Luis Garcia', '09446789012', '../../uploads/pp.png', NULL, 0),
('SCC-2024211', '00RF100211', 'Alejandro', 'Santos', '3rd Year', 'BSIT', 'alejandro.santos@example.com', '2001-07-25', '09457890123', '159 Pine Road', 'Male', 'Rosa Santos', '09447890123', '../../uploads/pp.png', NULL, 0),
('SCC-2024212', '00RF100212', 'Sofia', 'Mendoza', '1st Year', 'BSCS', 'sofia.mendoza@example.com', '1999-03-08', '09458901234', '357 Cedar Path', 'Female', 'Diego Mendoza', '09448901234', '../../uploads/pp.png', NULL, 0),
('SCC-2024213', '00RF100213', 'Emilio', 'Flores', '2nd Year', 'BSIT', 'emilio.flores@example.com', '2000-10-21', '09459012345', '456 Oak Court', 'Male', 'Laura Flores', '09449012345', '../../uploads/pp.png', NULL, 0),
('SCC-2024214', '00RF100214', 'Lucia', 'Castro', '3rd Year', 'BSCS', 'lucia.castro@example.com', '2001-05-04', '09460123456', '654 Maple Street', 'Female', 'Carlos Castro', '09450123456', '../../uploads/pp.png', NULL, 0),
('SCC-2024215', '00RF100215', 'Martin', 'Rivera', '1st Year', 'BSIT', 'martin.rivera@example.com', '1999-12-17', '09461234567', '753 Birch Avenue', 'Male', 'Isabel Rivera', '09451234567', '../../uploads/pp.png', NULL, 0);
INSERT INTO `students` (`student_id`, `student_rfid`, `student_firstname`, `student_lastname`, `student_level`, `course_id`, `student_email`, `student_birthdate`, `student_phone`, `student_address`, `student_gender`, `guardian_name`, `guardian_contact`, `profile_picture`, `deleted_at`, `deleted`) VALUES
('SCC-2024216', '00RF100216', 'Regina', 'Gonzalez', '2nd Year', 'BSCS', 'regina.gonzalez@example.com', '2000-08-30', '09462345678', '852 Elm Drive', 'Female', 'Antonio Gonzalez', '09452345678', '../../uploads/pp.png', NULL, 0),
('SCC-2024217', '00RF100217', 'Nicolas', 'Ramirez', '3rd Year', 'BSIT', 'nicolas.ramirez@example.com', '2001-03-13', '09463456789', '951 Spruce Lane', 'Male', 'Elena Ramirez', '09453456789', '../../uploads/pp.png', NULL, 0),
('SCC-2024218', '00RF100218', 'Carolina', 'Morales', '1st Year', 'BSCS', 'carolina.morales@example.com', '1999-10-26', '09464567890', '159 Willow Road', 'Female', 'Manuel Morales', '09454567890', '../../uploads/pp.png', NULL, 0),
('SCC-2024219', '00RF100219', 'Fernando', 'Diaz', '2nd Year', 'BSIT', 'fernando.diaz@example.com', '2000-06-09', '09465678901', '357 Ash Path', 'Male', 'Carmen Diaz', '09455678901', '../../uploads/pp.png', NULL, 0),
('SCC-2024220', '00RF100220', 'Gabriela', 'Herrera', '3rd Year', 'BSCS', 'gabriela.herrera@example.com', '2001-01-22', '09466789012', '456 Beech Street', 'Female', 'Juan Herrera', '09456789012', '../../uploads/pp.png', NULL, 0),
('SCC-2024221', '00RF100221', 'Eduardo', 'Ortiz', '1st Year', 'BSIT', 'eduardo.ortiz@example.com', '1999-09-05', '09467890123', '654 Pine Avenue', 'Male', 'Sofia Ortiz', '09457890123', '../../uploads/pp.png', NULL, 0),
('SCC-2024222', '00RF100222', 'Antonella', 'Vargas', '2nd Year', 'BSCS', 'antonella.vargas@example.com', '2000-04-18', '09468901234', '753 Cedar Court', 'Female', 'Luis Vargas', '09458901234', '../../uploads/pp.png', NULL, 0),
('SCC-2024223', '00RF100223', 'Santiago', 'Jimenez', '3rd Year', 'BSIT', 'santiago.jimenez@example.com', '2001-11-01', '09469012345', '852 Oak Lane', 'Male', 'Ana Jimenez', '09459012345', '../../uploads/pp.png', NULL, 0),
('SCC-2024224', '00RF100224', 'Valentina', 'Moreno', '1st Year', 'BSCS', 'valentina.moreno@example.com', '1999-06-14', '09470123456', '951 Maple Road', 'Female', 'Diego Moreno', '09460123456', '../../uploads/pp.png', NULL, 0),
('SCC-2024225', '00RF100225', 'Marco', 'Silva', '2nd Year', 'BSIT', 'marco.silva@example.com', '2000-02-27', '09471234567', '159 Birch Path', 'Male', 'Laura Silva', '09461234567', '../../uploads/pp.png', NULL, 0),
('SCC-2024226', '00RF100226', 'Sofia', 'Romero', '3rd Year', 'BSCS', 'sofia.romero@example.com', '2001-09-10', '09472345678', '357 Elm Street', 'Female', 'Carlos Romero', '09462345678', '../../uploads/pp.png', NULL, 0),
('SCC-2024227', '00RF100227', 'Gabriel', 'Ruiz', '1st Year', 'BSIT', 'gabriel.ruiz@example.com', '1999-04-23', '09473456789', '456 Spruce Avenue', 'Male', 'Isabel Ruiz', '09463456789', '../../uploads/pp.png', NULL, 0),
('SCC-2024228', '00RF100228', 'Isabella', 'Navarro', '2nd Year', 'BSCS', 'isabella.navarro@example.com', '2000-12-06', '09474567890', '654 Willow Drive', 'Female', 'Antonio Navarro', '09464567890', '../../uploads/pp.png', NULL, 0),
('SCC-2024229', '00RF100229', 'Rafael', 'Medina', '3rd Year', 'BSIT', 'rafael.medina@example.com', '2001-07-19', '09475678901', '753 Ash Court', 'Male', 'Elena Medina', '09465678901', '../../uploads/pp.png', NULL, 0),
('SCC-2024230', '00RF100230', 'Camila', 'Acosta', '1st Year', 'BSCS', 'camila.acosta@example.com', '1999-03-02', '09476789012', '852 Beech Road', 'Female', 'Manuel Acosta', '09466789012', '../../uploads/pp.png', NULL, 0),
('SCC-2024231', '00RF100231', 'Diego', 'Rojas', '2nd Year', 'BSIT', 'diego.rojas@example.com', '2000-10-15', '09477890123', '951 Pine Lane', 'Male', 'Carmen Rojas', '09467890123', '../../uploads/pp.png', NULL, 0),
('SCC-2024232', '00RF100232', 'Valentina', 'Flores', '3rd Year', 'BSCS', 'valentina.flores@example.com', '2001-05-28', '09478901234', '159 Cedar Path', 'Female', 'Juan Flores', '09468901234', '../../uploads/pp.png', NULL, 0),
('SCC-2024233', '00RF100233', 'Mateo', 'Chavez', '1st Year', 'BSIT', 'mateo.chavez@example.com', '1999-12-11', '09479012345', '357 Oak Street', 'Male', 'Sofia Chavez', '09469012345', '../../uploads/pp.png', NULL, 0),
('SCC-2024234', '00RF100234', 'Luna', 'Pena', '2nd Year', 'BSCS', 'luna.pena@example.com', '2000-08-24', '09480123456', '456 Maple Avenue', 'Female', 'Luis Pena', '09470123456', '../../uploads/pp.png', NULL, 0),
('SCC-2024235', '00RF100235', 'Samuel', 'Bautista', '3rd Year', 'BSIT', 'samuel.bautista@example.com', '2001-03-07', '09481234567', '654 Birch Drive', 'Male', 'Ana Bautista', '09471234567', '../../uploads/pp.png', NULL, 0),
('SCC-2024236', '00RF100236', 'Victoria', 'Santos', '1st Year', 'BSCS', 'victoria.santos@example.com', '1999-10-20', '09482345678', '753 Elm Court', 'Female', 'Diego Santos', '09472345678', '../../uploads/pp.png', NULL, 0),
('SCC-2024237', '00RF100237', 'Nicolas', 'Villanueva', '2nd Year', 'BSIT', 'nicolas.villanueva@example.com', '2000-06-03', '09483456789', '852 Spruce Road', 'Male', 'Laura Villanueva', '09473456789', '../../uploads/pp.png', NULL, 0),
('SCC-2024238', '00RF100238', 'Lucia', 'Pascual', '3rd Year', 'BSCS', 'lucia.pascual@example.com', '2001-01-16', '09484567890', '951 Willow Lane', 'Female', 'Carlos Pascual', '09474567890', '../../uploads/pp.png', NULL, 0);

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
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `reset_token` varchar(255) DEFAULT NULL,
  `reset_token_expires` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `teachers`
--

INSERT INTO `teachers` (`teacher_id`, `teacher_firstname`, `teacher_lastname`, `teacher_email`, `teacher_password`, `created_at`, `reset_token`, `reset_token_expires`) VALUES
('SCC-11112', 'Alvin', 'Lagoras', 'alvinlag94@gmail.com', '$2y$10$WU4sqEJdQH7lk9Qz72fEBuAEwoXecaEBlhd/OSY4lFVtqe9JwpvzS', '2024-11-15 18:11:14', '97da133cd03b7dd0022efd9601ea7499492b63bb1c19df343ebb2807340c3303', '2024-12-08 21:31:35'),
('SCC-11113', 'Alvin', 'Lagoras', 'test1@gmail.com', '$2y$10$n/O7QrTv8tmtOrZzsG/Phe1LbIilNKuEQVA70P6zvs.vlvosZ0OMq', '2024-11-18 01:24:52', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_logs`
--

CREATE TABLE `user_logs` (
  `log_id` int(11) NOT NULL,
  `admin_id` varchar(10) DEFAULT NULL,
  `teacher_id` varchar(50) DEFAULT NULL,
  `action` enum('login','logout') NOT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  `browser_info` varchar(255) DEFAULT NULL
) ;

--
-- Dumping data for table `user_logs`
--

INSERT INTO `user_logs` (`log_id`, `admin_id`, `teacher_id`, `action`, `ip_address`, `timestamp`, `browser_info`) VALUES
(43, 'ACC-10001', NULL, 'logout', '127.0.0.1', '2024-12-12 08:28:16', 'Windows 10 - Chrome'),
(44, 'ACC-10001', NULL, 'login', '127.0.0.1', '2024-12-12 08:28:22', 'Windows 10 - Chrome'),
(45, 'ACC-10001', NULL, 'logout', '127.0.0.1', '2024-12-12 08:28:54', 'Windows 10 - Chrome'),
(46, 'ACC-10001', NULL, 'login', '127.0.0.1', '2024-12-12 08:30:02', 'Windows 10 - Edge'),
(47, 'ACC-10001', NULL, 'login', '127.0.0.1', '2024-12-12 17:35:24', 'Windows 10 - Chrome'),
(48, 'ACC-10001', NULL, 'logout', '127.0.0.1', '2024-12-12 19:08:22', 'Windows 10 - Chrome'),
(49, NULL, 'SCC-11112', 'login', '127.0.0.1', '2024-12-12 19:08:31', 'Windows 10 - Chrome'),
(50, 'ACC-10001', NULL, 'login', '127.0.0.1', '2024-12-13 01:41:59', 'Windows 10 - Chrome'),
(51, 'ACC-10001', NULL, 'logout', '127.0.0.1', '2024-12-13 04:07:51', 'Windows 10 - Chrome'),
(52, NULL, 'SCC-11112', 'login', '127.0.0.1', '2024-12-13 04:07:56', 'Windows 10 - Chrome'),
(53, NULL, 'SCC-11112', 'login', '127.0.0.1', '2024-12-13 14:53:43', 'Windows 10 - Chrome'),
(54, NULL, 'SCC-11112', 'logout', '127.0.0.1', '2024-12-13 15:39:49', 'Windows 10 - Chrome'),
(55, 'ACC-10001', NULL, 'login', '127.0.0.1', '2024-12-13 15:39:55', 'Windows 10 - Chrome'),
(56, 'ACC-10001', NULL, 'logout', '127.0.0.1', '2024-12-13 16:12:00', 'Windows 10 - Chrome'),
(57, NULL, 'SCC-11112', 'login', '127.0.0.1', '2024-12-13 16:12:06', 'Windows 10 - Chrome'),
(58, NULL, 'SCC-11112', 'logout', '127.0.0.1', '2024-12-13 16:18:25', 'Windows 10 - Chrome'),
(59, 'ACC-10001', NULL, 'login', '127.0.0.1', '2024-12-13 16:18:34', 'Windows 10 - Chrome'),
(60, 'ACC-10001', NULL, 'logout', '127.0.0.1', '2024-12-13 16:20:05', 'Windows 10 - Chrome'),
(61, NULL, 'SCC-11112', 'login', '127.0.0.1', '2024-12-13 16:20:46', 'Windows 10 - Chrome'),
(62, NULL, 'SCC-11112', 'logout', '127.0.0.1', '2024-12-13 17:42:34', 'Windows 10 - Chrome'),
(63, 'ACC-10001', NULL, 'login', '127.0.0.1', '2024-12-13 17:42:40', 'Windows 10 - Chrome'),
(64, NULL, 'SCC-11112', 'login', '127.0.0.1', '2024-12-13 17:51:45', 'Windows 10 - Chrome'),
(65, NULL, 'SCC-11112', 'login', '127.0.0.1', '2024-12-14 00:14:20', 'Windows 10 - Chrome'),
(66, NULL, 'SCC-11112', 'logout', '127.0.0.1', '2024-12-14 00:24:11', 'Windows 10 - Chrome'),
(67, 'ACC-10001', NULL, 'login', '127.0.0.1', '2024-12-14 00:24:18', 'Windows 10 - Chrome'),
(68, 'ACC-10001', NULL, 'logout', '127.0.0.1', '2024-12-14 01:03:27', 'Windows 10 - Chrome');

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
-- Indexes for table `user_logs`
--
ALTER TABLE `user_logs`
  ADD PRIMARY KEY (`log_id`),
  ADD KEY `admin_id` (`admin_id`),
  ADD KEY `teacher_id` (`teacher_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `attendance_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=454;

--
-- AUTO_INCREMENT for table `user_logs`
--
ALTER TABLE `user_logs`
  MODIFY `log_id` int(11) NOT NULL AUTO_INCREMENT;

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

--
-- Constraints for table `user_logs`
--
ALTER TABLE `user_logs`
  ADD CONSTRAINT `user_logs_ibfk_1` FOREIGN KEY (`admin_id`) REFERENCES `admins` (`admin_id`) ON DELETE SET NULL,
  ADD CONSTRAINT `user_logs_ibfk_2` FOREIGN KEY (`teacher_id`) REFERENCES `teachers` (`teacher_id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
