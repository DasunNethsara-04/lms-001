-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 09, 2024 at 08:00 PM
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
-- Database: `lms`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments_tbl`
--

CREATE TABLE `comments_tbl` (
  `comment_id` int(5) NOT NULL,
  `student_id` int(5) NOT NULL,
  `message_type` varchar(15) NOT NULL,
  `message` varchar(200) NOT NULL,
  `date_added` date NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `course_tbl`
--

CREATE TABLE `course_tbl` (
  `course_id` int(3) NOT NULL,
  `course_name` varchar(30) NOT NULL,
  `course_type_id` tinyint(1) NOT NULL,
  `teacher_id` int(5) NOT NULL,
  `course_pic` varchar(60) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `course_type_tbl`
--

CREATE TABLE `course_type_tbl` (
  `course_type_id` tinyint(1) NOT NULL,
  `course_type_name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `course_type_tbl`
--

INSERT INTO `course_type_tbl` (`course_type_id`, `course_type_name`) VALUES
(1, 'Programming'),
(2, 'Computer Science'),
(3, 'IT'),
(4, 'O/L ICT'),
(5, 'A/L ICT'),
(6, 'Web Dev.');

-- --------------------------------------------------------

--
-- Table structure for table `lesson_tbl`
--

CREATE TABLE `lesson_tbl` (
  `lesson_id` int(3) NOT NULL,
  `lesson_number` int(3) NOT NULL,
  `lesson_url` varchar(70) NOT NULL,
  `course_id` int(3) NOT NULL,
  `lesson_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `student_enroll_tbl`
--

CREATE TABLE `student_enroll_tbl` (
  `enroll_id` int(11) NOT NULL,
  `student_id` int(11) DEFAULT NULL,
  `course_id` int(11) DEFAULT NULL,
  `enrollment_status` enum('Enrolled','Completed') DEFAULT 'Enrolled',
  `enrollment_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `student_lesson_progress_tbl`
--

CREATE TABLE `student_lesson_progress_tbl` (
  `progress_id` int(11) NOT NULL,
  `enroll_id` int(11) DEFAULT NULL,
  `lesson_id` int(11) DEFAULT NULL,
  `watched_status` enum('Watched','Not Watched') DEFAULT 'Not Watched',
  `progress_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `student_tbl`
--

CREATE TABLE `student_tbl` (
  `student_id` int(5) NOT NULL,
  `first_name` varchar(15) NOT NULL,
  `last_name` varchar(15) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(65) NOT NULL,
  `date_added` date NOT NULL,
  `date_updated` date DEFAULT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `teacher_tbl`
--

CREATE TABLE `teacher_tbl` (
  `teacher_id` int(5) NOT NULL,
  `title` char(6) NOT NULL,
  `first_name` varchar(15) NOT NULL,
  `last_name` varchar(15) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(65) NOT NULL,
  `date_added` date NOT NULL,
  `date_updated` date DEFAULT NULL,
  `last_login` timestamp NULL DEFAULT current_timestamp(),
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `teacher_tbl`
--

INSERT INTO `teacher_tbl` (`teacher_id`, `title`, `first_name`, `last_name`, `email`, `password`, `date_added`, `date_updated`, `last_login`, `status`) VALUES
(1, 'Mr.', 'Dasun', 'Nethsara', 'dasun@host.com', '$2y$10$0WC/7SaNQF0g2DnGlP41uukukz1nvUFCZsKnGNhrZ8rXyGJrd8Ooa', '2024-02-01', '2024-02-08', '2024-02-01 16:56:23', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments_tbl`
--
ALTER TABLE `comments_tbl`
  ADD PRIMARY KEY (`comment_id`),
  ADD KEY `std_id_from_student` (`student_id`);

--
-- Indexes for table `course_tbl`
--
ALTER TABLE `course_tbl`
  ADD PRIMARY KEY (`course_id`),
  ADD KEY `course_id` (`course_id`),
  ADD KEY `teacher_id` (`teacher_id`),
  ADD KEY `course_type_id` (`course_type_id`);

--
-- Indexes for table `course_type_tbl`
--
ALTER TABLE `course_type_tbl`
  ADD PRIMARY KEY (`course_type_id`),
  ADD KEY `course_type_id` (`course_type_id`);

--
-- Indexes for table `lesson_tbl`
--
ALTER TABLE `lesson_tbl`
  ADD PRIMARY KEY (`lesson_id`),
  ADD KEY `lesson_id` (`lesson_id`),
  ADD KEY `course_id` (`course_id`);

--
-- Indexes for table `student_enroll_tbl`
--
ALTER TABLE `student_enroll_tbl`
  ADD PRIMARY KEY (`enroll_id`),
  ADD KEY `student_id` (`student_id`),
  ADD KEY `course_id` (`course_id`);

--
-- Indexes for table `student_lesson_progress_tbl`
--
ALTER TABLE `student_lesson_progress_tbl`
  ADD PRIMARY KEY (`progress_id`),
  ADD KEY `enroll_id` (`enroll_id`),
  ADD KEY `lesson_id` (`lesson_id`);

--
-- Indexes for table `student_tbl`
--
ALTER TABLE `student_tbl`
  ADD PRIMARY KEY (`student_id`),
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `teacher_tbl`
--
ALTER TABLE `teacher_tbl`
  ADD PRIMARY KEY (`teacher_id`),
  ADD KEY `teacher_id` (`teacher_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments_tbl`
--
ALTER TABLE `comments_tbl`
  MODIFY `comment_id` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `course_tbl`
--
ALTER TABLE `course_tbl`
  MODIFY `course_id` int(3) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `course_type_tbl`
--
ALTER TABLE `course_type_tbl`
  MODIFY `course_type_id` tinyint(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `lesson_tbl`
--
ALTER TABLE `lesson_tbl`
  MODIFY `lesson_id` int(3) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `student_enroll_tbl`
--
ALTER TABLE `student_enroll_tbl`
  MODIFY `enroll_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `student_lesson_progress_tbl`
--
ALTER TABLE `student_lesson_progress_tbl`
  MODIFY `progress_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `student_tbl`
--
ALTER TABLE `student_tbl`
  MODIFY `student_id` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `teacher_tbl`
--
ALTER TABLE `teacher_tbl`
  MODIFY `teacher_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments_tbl`
--
ALTER TABLE `comments_tbl`
  ADD CONSTRAINT `std_id_from_student` FOREIGN KEY (`student_id`) REFERENCES `student_tbl` (`student_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `course_tbl`
--
ALTER TABLE `course_tbl`
  ADD CONSTRAINT `course_tbl_ibfk_1` FOREIGN KEY (`teacher_id`) REFERENCES `teacher_tbl` (`teacher_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `course_type` FOREIGN KEY (`course_type_id`) REFERENCES `course_type_tbl` (`course_type_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `lesson_tbl`
--
ALTER TABLE `lesson_tbl`
  ADD CONSTRAINT `lesson_tbl_ibfk_1` FOREIGN KEY (`course_id`) REFERENCES `course_tbl` (`course_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `student_enroll_tbl`
--
ALTER TABLE `student_enroll_tbl`
  ADD CONSTRAINT `student_enroll_tbl_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `student_tbl` (`student_id`),
  ADD CONSTRAINT `student_enroll_tbl_ibfk_2` FOREIGN KEY (`course_id`) REFERENCES `course_tbl` (`course_id`);

--
-- Constraints for table `student_lesson_progress_tbl`
--
ALTER TABLE `student_lesson_progress_tbl`
  ADD CONSTRAINT `student_lesson_progress_tbl_ibfk_1` FOREIGN KEY (`enroll_id`) REFERENCES `student_enroll_tbl` (`enroll_id`),
  ADD CONSTRAINT `student_lesson_progress_tbl_ibfk_2` FOREIGN KEY (`lesson_id`) REFERENCES `lesson_tbl` (`lesson_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
