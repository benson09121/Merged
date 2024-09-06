-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 23, 2024 at 10:11 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `do_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_db`
--

CREATE TABLE `admin_db` (
  `admin_id` int(100) NOT NULL,
  `admin_username` varchar(250) NOT NULL,
  `admin_password` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `admission_db`
--

CREATE TABLE `admission_db` (
  `admission_id` int(100) NOT NULL,
  `student_id` varchar(250) NOT NULL,
  `request_date` varchar(250) NOT NULL,
  `purpose` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admission_db`
--

INSERT INTO `admission_db` (`admission_id`, `student_id`, `request_date`, `purpose`) VALUES
(4, '2021170310', 'June 18, 2024', 'test'),
(5, '1', 'June 18, 2024', 'test'),
(6, '1', 'June 18, 2024', 'test erren admission\r\n'),
(7, '1', 'June 18, 2024', 'Sit in 502');

-- --------------------------------------------------------

--
-- Table structure for table `announcement_db`
--

CREATE TABLE `announcement_db` (
  `ann_id` int(100) NOT NULL,
  `announcement` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `announcement_db`
--

INSERT INTO `announcement_db` (`ann_id`, `announcement`) VALUES
(1, 'test 123');

-- --------------------------------------------------------

--
-- Table structure for table `entry_db`
--

CREATE TABLE `entry_db` (
  `entry_id` int(100) NOT NULL,
  `student_id` varchar(250) NOT NULL,
  `request_date` varchar(250) NOT NULL,
  `purpose` varchar(250) NOT NULL,
  `date_validity` varchar(250) NOT NULL,
  `Status` varchar(250) NOT NULL DEFAULT 'Invalid'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `entry_db`
--

INSERT INTO `entry_db` (`entry_id`, `student_id`, `request_date`, `purpose`, `date_validity`, `Status`) VALUES
(1, '1', 'June 18, 2024', 'test123321', 'June 20, 2024', 'Invalid'),
(2, '1', 'June 18, 2024', 'no uniform', 'June 21, 2024', 'Invalid'),
(3, '1', 'June 18, 2024', 'NO ID', 'June 21, 2024', 'Invalid'),
(4, '2021170017', 'June 20, 2024', 'test', 'June 22, 2024', 'Invalid');

-- --------------------------------------------------------

--
-- Table structure for table `goodmoral_db`
--

CREATE TABLE `goodmoral_db` (
  `goodmoral_id` int(100) NOT NULL,
  `student_id` varchar(250) NOT NULL,
  `request_date` varchar(250) NOT NULL,
  `purpose` varchar(250) NOT NULL,
  `date_release` varchar(250) NOT NULL,
  `status` varchar(250) NOT NULL DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `goodmoral_db`
--

INSERT INTO `goodmoral_db` (`goodmoral_id`, `student_id`, `request_date`, `purpose`, `date_release`, `status`) VALUES
(3, '2', 'June 18, 2024', 'test', '', 'Pending'),
(4, '1', 'June 18, 2024', 'mon', '', 'Pending'),
(5, '2021170017', 'June 18, 2024', 'testewqewqeqwewq', '', 'Pending'),
(6, '1', 'June 18, 2024', 'test erren', '', 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `intervention_db`
--

CREATE TABLE `intervention_db` (
  `intervention_id` int(100) NOT NULL,
  `major_id` int(100) NOT NULL,
  `due_date` varchar(250) NOT NULL,
  `intervention_type` varchar(250) NOT NULL,
  `specify_department` varchar(250) DEFAULT NULL,
  `notice_explain` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `intervention_db`
--

INSERT INTO `intervention_db` (`intervention_id`, `major_id`, `due_date`, `intervention_type`, `specify_department`, `notice_explain`) VALUES
(6, 174, '2024-06-29', 'Community', 'Kitchen Laboratory', 'test 2321321321'),
(7, 175, '2024-06-29', 'Counseling', '', '21'),
(8, 176, '2024-06-27', 'Community', 'Registrar', 'tesadasas');

-- --------------------------------------------------------

--
-- Table structure for table `lost_found_db`
--

CREATE TABLE `lost_found_db` (
  `lost_found_id` int(11) NOT NULL,
  `student_id_surrender` varchar(250) NOT NULL,
  `student_id_owner` varchar(250) NOT NULL,
  `item_type` varchar(250) NOT NULL,
  `loc_found` varchar(250) NOT NULL,
  `item_img` varchar(250) NOT NULL,
  `description` varchar(250) NOT NULL,
  `date_surrender` varchar(250) NOT NULL,
  `date_claim` varchar(250) NOT NULL,
  `status` varchar(250) NOT NULL DEFAULT 'surrender'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `lost_found_db`
--

INSERT INTO `lost_found_db` (`lost_found_id`, `student_id_surrender`, `student_id_owner`, `item_type`, `loc_found`, `item_img`, `description`, `date_surrender`, `date_claim`, `status`) VALUES
(14, '2021170017', '', 'mouse', 'room 501', 'item_img/437763067_779420714161724_1428912286637114098_n.png', 'dsa', 'June 5, 2024', '', 'surrender'),
(15, '2021170017', '', 'mouse', 'room 501', 'item_img/image.png', '321321', 'June 5, 2024', '', 'surrender'),
(16, '2021170017', '2021170310', 'keyboard', 'Room 502', 'item_img/aefb1d8b-226c-4b4d-8e08-dc20c946811b.jpg', 'black ', 'June 6, 2024', 'June 6, 2024', 'claimed'),
(17, '2021170017', '2021-170596', 'mouse', 'room 501', 'item_img/433610460_308158128706741_78556622223338083_n.png', 'test', 'June 6, 2024', 'June 6, 2024', 'claimed'),
(19, '1', '', 'mouse', '1', '', '1', 'June 19, 2024', '', 'surrender'),
(20, '1', '', '1', '1', '', '1', 'June 19, 2024', '', 'surrender'),
(21, '1', '', '1', '1', 'item_img/437763067_779420714161724_1428912286637114098_n.png', '1', 'June 19, 2024', '', 'surrender');

-- --------------------------------------------------------

--
-- Table structure for table `major_db`
--

CREATE TABLE `major_db` (
  `major_id` int(11) NOT NULL,
  `student_id` varchar(250) NOT NULL,
  `category` varchar(250) NOT NULL,
  `date_created` varchar(250) NOT NULL,
  `offense_type` varchar(250) NOT NULL,
  `violation_type` varchar(250) NOT NULL,
  `description` varchar(250) NOT NULL,
  `status` varchar(250) NOT NULL DEFAULT 'Not Cleared'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `major_db`
--

INSERT INTO `major_db` (`major_id`, `student_id`, `category`, `date_created`, `offense_type`, `violation_type`, `description`, `status`) VALUES
(174, '2021170600', '', 'June 23, 2024', 'Major', 'no id', 'no id', 'Completed'),
(175, '1', '', 'June 23, 2024', 'Major', 'Cheating', 'Kopya sa katabi or tingin sa CP', 'Not Cleared'),
(176, '1', '', 'June 23, 2024', 'Major', 'no id', 'no id', 'Not Cleared');

-- --------------------------------------------------------

--
-- Table structure for table `minor_db`
--

CREATE TABLE `minor_db` (
  `minor_id` int(100) NOT NULL,
  `student_id` varchar(250) NOT NULL,
  `date_created` varchar(250) NOT NULL,
  `offense_type` varchar(250) NOT NULL,
  `violation_type` varchar(250) NOT NULL,
  `description` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `minor_db`
--

INSERT INTO `minor_db` (`minor_id`, `student_id`, `date_created`, `offense_type`, `violation_type`, `description`) VALUES
(62, '1', 'June 23, 2024', 'Minor', 'ewqeqwe', 'qweqw'),
(63, '1', 'June 23, 2024', 'Minor', 'test', 'test');

-- --------------------------------------------------------

--
-- Table structure for table `student_db`
--

CREATE TABLE `student_db` (
  `student_id` varchar(250) NOT NULL,
  `f_name` varchar(250) NOT NULL,
  `m_name` varchar(250) NOT NULL,
  `l_name` varchar(250) NOT NULL,
  `department` varchar(250) NOT NULL,
  `section` mediumtext NOT NULL,
  `course` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `gender` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL,
  `account_status` varchar(250) NOT NULL DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student_db`
--

INSERT INTO `student_db` (`student_id`, `f_name`, `m_name`, `l_name`, `department`, `section`, `course`, `email`, `gender`, `password`, `account_status`) VALUES
('1', '1', '1', '1', '1', '1', '1', '1', '1', '12345678', 'banned'),
('2', '2', '2', '2', '2', '2', '2', '2', '2', '12345678', 'active'),
('2021170017', 'Brent Andrei', 'Centillo', 'Berti', 'SECA', 'INF211', 'BSIT-MWA', 'bertibc@students.nu-dasma.edu.ph', 'Male', '12345678', 'active'),
('2021170310', 'Avril Jhoanna Ashanti\r\n', 'Jose', 'Belisario\r\n', 'SECA', 'INF211', 'BSIT', 'belisarioaj@students.nu-dasma.edu.ph\r\n', 'Female', '12345678', 'active'),
('2021170314', 'Jhanna', 'Mejia', 'Falcotelo', 'SECA', 'INF211', 'BSIT-MWA', 'falcotelojm@students.nu-dasma.edu.ph', 'Female', '12345678', 'active'),
('2021170379', 'Erren Anne', 'Laroga', 'Lubas', 'SECA', 'INF211', 'BSIT-MWA', 'lubasel@students.nu-dasma.edu.ph', 'Female', '12345678', 'active'),
('2021170494', 'Frenz Deaniel', 'Modesto', 'Embestro', 'SECA', 'INF211', 'BSIT-MWA', 'embestrofm@students.nu-dasma.edu.ph', 'Male', '12345678', 'active'),
('2021170600', 'Jems', 'Ramos', 'Malonda', 'SECA', 'INF211', 'BSIT', 'malondajr@students.nu-dasma.edu.ph', 'Male', '12345678', 'active'),
('2021370005', 'Neil John', 'Demalinao', 'Leong', 'SECA', 'INF222', 'BSIT-MWA', 'leongd@students.nu-dasma.edu.ph', 'Male', '12345678', 'active'),
('2022112677', 'Ma. Francheska Anne', 'Mangcucang', 'Orqueza', 'SECA', 'INF211', 'BSIT-MWA', 'orquezamm@students.nu-dasma.edu.ph', 'Female', '12345678', 'active'),
('2022170154', 'Stanley Dave', 'Lagapa', 'Sale', 'SECA', 'INF221', 'BSIT-MWA', 'salesl@students.nu-dasma.edu.ph', 'Male', '12345678', 'active'),
('2022172363', 'Nina Ashley Mae', 'Dela Cruz', 'Geronimo', 'SECA', 'INF211', 'BSIT-MWA', 'geronimond@students.nu-dasma.edu.ph\r\n', 'Female', '12345678', 'active'),
('2022172574', 'Justin Emil', 'Mariano', 'Joson', 'SECA', 'INF211', 'BSIT-MWA', 'josonjm@students.nu-dasma.edu.ph', 'Male', '12345678', 'active'),
('2022172799', 'Donielle Gian', 'Seda', 'Sadiwa', 'SECA', 'INF211', 'BSIT-MWA', 'sadiwads@students.nu-dasma.edu.ph', 'Male', '12345678', 'active'),
('a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', '12345678', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `violation_db`
--

CREATE TABLE `violation_db` (
  `violation_id` int(100) NOT NULL,
  `category` varchar(250) NOT NULL,
  `offense_type` varchar(250) NOT NULL,
  `violation_type` varchar(250) NOT NULL,
  `description` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `violation_db`
--

INSERT INTO `violation_db` (`violation_id`, `category`, `offense_type`, `violation_type`, `description`) VALUES
(3, '', 'MINOR', 'test', 'test'),
(4, '', 'MINOR', 'test', 'test'),
(5, '', 'MINOR', 'test', 'test'),
(14, '', 'offense', '', ''),
(18, '', 'offense', 'tetetetetetetetetetetetettetetetetetetetetetetetettetetetetetetetetetetetettetetetetetetetetetetetet', 'tetetetetetetetetetetetettetetetetetetetetetetetettetetetetetetetetetetetettetetetetetetetetetetetet'),
(31, '', 'MINOR', 'ewqeqwe', 'qweqw'),
(32, 'Category 5', 'MAJOR', 'test', 'test'),
(33, 'Category 5', 'MAJOR', 'test', 'test'),
(34, 'Category 1', 'MAJOR', 'no id', 'no id'),
(35, 'Category 2', 'MAJOR', 'Cheating', 'Kopya sa katabi or tingin sa CP');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_db`
--
ALTER TABLE `admin_db`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `admission_db`
--
ALTER TABLE `admission_db`
  ADD PRIMARY KEY (`admission_id`),
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `announcement_db`
--
ALTER TABLE `announcement_db`
  ADD PRIMARY KEY (`ann_id`);

--
-- Indexes for table `entry_db`
--
ALTER TABLE `entry_db`
  ADD PRIMARY KEY (`entry_id`),
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `goodmoral_db`
--
ALTER TABLE `goodmoral_db`
  ADD PRIMARY KEY (`goodmoral_id`),
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `intervention_db`
--
ALTER TABLE `intervention_db`
  ADD PRIMARY KEY (`intervention_id`),
  ADD KEY `major_id` (`major_id`);

--
-- Indexes for table `lost_found_db`
--
ALTER TABLE `lost_found_db`
  ADD PRIMARY KEY (`lost_found_id`),
  ADD KEY `student_id` (`student_id_surrender`);

--
-- Indexes for table `major_db`
--
ALTER TABLE `major_db`
  ADD PRIMARY KEY (`major_id`),
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `minor_db`
--
ALTER TABLE `minor_db`
  ADD PRIMARY KEY (`minor_id`),
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `student_db`
--
ALTER TABLE `student_db`
  ADD PRIMARY KEY (`student_id`);

--
-- Indexes for table `violation_db`
--
ALTER TABLE `violation_db`
  ADD PRIMARY KEY (`violation_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_db`
--
ALTER TABLE `admin_db`
  MODIFY `admin_id` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `admission_db`
--
ALTER TABLE `admission_db`
  MODIFY `admission_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `announcement_db`
--
ALTER TABLE `announcement_db`
  MODIFY `ann_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `entry_db`
--
ALTER TABLE `entry_db`
  MODIFY `entry_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `goodmoral_db`
--
ALTER TABLE `goodmoral_db`
  MODIFY `goodmoral_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `intervention_db`
--
ALTER TABLE `intervention_db`
  MODIFY `intervention_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `lost_found_db`
--
ALTER TABLE `lost_found_db`
  MODIFY `lost_found_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `major_db`
--
ALTER TABLE `major_db`
  MODIFY `major_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=177;

--
-- AUTO_INCREMENT for table `minor_db`
--
ALTER TABLE `minor_db`
  MODIFY `minor_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `violation_db`
--
ALTER TABLE `violation_db`
  MODIFY `violation_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admission_db`
--
ALTER TABLE `admission_db`
  ADD CONSTRAINT `admission_db_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `student_db` (`student_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `entry_db`
--
ALTER TABLE `entry_db`
  ADD CONSTRAINT `entry_db_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `student_db` (`student_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `goodmoral_db`
--
ALTER TABLE `goodmoral_db`
  ADD CONSTRAINT `goodmoral_db_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `student_db` (`student_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `intervention_db`
--
ALTER TABLE `intervention_db`
  ADD CONSTRAINT `intervention_db_ibfk_1` FOREIGN KEY (`major_id`) REFERENCES `major_db` (`major_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `major_db`
--
ALTER TABLE `major_db`
  ADD CONSTRAINT `major_db_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `student_db` (`student_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `minor_db`
--
ALTER TABLE `minor_db`
  ADD CONSTRAINT `minor_db_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `student_db` (`student_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
