-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 22, 2023 at 06:47 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `heart_nov_2022`
--

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `con_id` int(11) NOT NULL,
  `emp_mob` varchar(14) DEFAULT NULL,
  `emp_email` varchar(200) DEFAULT NULL,
  `emp_address` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `dept_id` int(11) NOT NULL,
  `dept_name` varchar(150) DEFAULT NULL,
  `user_userid` int(11) DEFAULT NULL,
  `dept_active` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`dept_id`, `dept_name`, `user_userid`, `dept_active`) VALUES
(1, 'Finance', 1, 1),
(2, 'Nursing', 1, 1),
(3, 'Doctors', 1, 1),
(4, 'Adminstration', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `emp_id` int(11) NOT NULL,
  `emp_name` varchar(150) DEFAULT NULL,
  `job_id` int(11) DEFAULT NULL,
  `dept_id` int(11) DEFAULT NULL,
  `salary` float DEFAULT NULL,
  `hire_date` date DEFAULT NULL,
  `emp_age` int(11) DEFAULT NULL,
  `emp_gender` enum('male','female') DEFAULT NULL,
  `national_id` varchar(14) DEFAULT NULL,
  `user_userid` int(11) DEFAULT NULL,
  `emp_active` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `examinations`
--

CREATE TABLE `examinations` (
  `exam_id` int(11) NOT NULL,
  `exam_name` varchar(150) DEFAULT NULL,
  `exam_price` float DEFAULT NULL,
  `user_userid` int(11) DEFAULT NULL,
  `exam_active` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `invoice`
--

CREATE TABLE `invoice` (
  `invoice_id` int(11) NOT NULL,
  `pat_id` int(11) DEFAULT NULL,
  `invoice_date` date DEFAULT NULL,
  `invoice_time` time DEFAULT NULL,
  `invoice_total` float DEFAULT NULL,
  `emp_id` int(11) DEFAULT NULL,
  `user_userid` int(11) DEFAULT NULL,
  `invoice_active` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `invoice_details`
--

CREATE TABLE `invoice_details` (
  `detail_id` int(11) NOT NULL,
  `invoice_id` int(11) DEFAULT NULL,
  `exam_id` int(11) DEFAULT NULL,
  `price` float DEFAULT NULL,
  `discount` float DEFAULT NULL,
  `amount` float GENERATED ALWAYS AS (`price` - `discount`) VIRTUAL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `job_id` int(11) NOT NULL,
  `job_title` varchar(150) DEFAULT NULL,
  `user_userid` int(11) DEFAULT NULL,
  `job_active` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `jobs`
--

INSERT INTO `jobs` (`job_id`, `job_title`, `user_userid`, `job_active`) VALUES
(1, 'Accountant', 1, 1),
(2, 'Nurse', 1, 1),
(3, 'Doctor', 1, 1),
(4, 'Office Boy', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `patients`
--

CREATE TABLE `patients` (
  `pat_id` int(11) NOT NULL,
  `pat_name` varchar(150) DEFAULT NULL,
  `pat_mob` varchar(14) DEFAULT NULL,
  `pat_age` int(11) DEFAULT NULL,
  `pat_gender` enum('male','female') DEFAULT NULL,
  `treat_id` int(11) DEFAULT NULL,
  `user_userid` int(11) DEFAULT NULL,
  `pat_active` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `patients`
--

INSERT INTO `patients` (`pat_id`, `pat_name`, `pat_mob`, `pat_age`, `pat_gender`, `treat_id`, `user_userid`, `pat_active`) VALUES
(1, 'Hamdy Hamoda Hussein', '01012345678', 51, 'male', 1, 1, 1),
(2, 'Hend Noaman Naaem', '01112345678', 42, 'female', 2, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `sections`
--

CREATE TABLE `sections` (
  `section_id` int(11) NOT NULL,
  `section_name` varchar(150) DEFAULT NULL,
  `user_userid` int(11) DEFAULT NULL,
  `section_active` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `sections`
--

INSERT INTO `sections` (`section_id`, `section_name`, `user_userid`, `section_active`) VALUES
(1, 'Cardiology', 1, 1),
(2, 'Gastroenterology', 1, 1),
(3, 'Pediatrics', 1, 1),
(4, 'Nephrology', 1, 1),
(5, 'Hematology', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `treat_doctors`
--

CREATE TABLE `treat_doctors` (
  `treat_id` int(11) NOT NULL,
  `treat_name` varchar(150) DEFAULT NULL,
  `treat_mob` varchar(14) DEFAULT NULL,
  `treat_address` varchar(250) DEFAULT NULL,
  `treat_gender` enum('male','female') DEFAULT NULL,
  `section_id` int(11) DEFAULT NULL,
  `user_userid` int(11) DEFAULT NULL,
  `treat_active` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `treat_doctors`
--

INSERT INTO `treat_doctors` (`treat_id`, `treat_name`, `treat_mob`, `treat_address`, `treat_gender`, `section_id`, `user_userid`, `treat_active`) VALUES
(1, 'Adel Ramdan', '01012345678', 'Eldoki, Cairo, Egypt', 'male', 1, 1, 1),
(2, 'Hemat Hassan Hosny', '01112345678', 'Nasr-City, Cairo, Egypt', 'female', 2, 1, 1),
(6, 'Sabry Saber Hamed', '01512345678', 'Maadi, Cairo, Egypt', 'male', 3, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_userid` int(11) NOT NULL,
  `user_fullname` varchar(200) NOT NULL,
  `user_username` varchar(200) DEFAULT NULL,
  `user_password` varchar(200) NOT NULL,
  `user_usertype` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_userid`, `user_fullname`, `user_username`, `user_password`, `user_usertype`) VALUES
(1, 'Belal AbdElhamid AbdElfadeel', 'belal.ahmed', '123456', 1),
(2, 'Ereny Matta SAAD', 'ereny.saad', '456789', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`con_id`),
  ADD UNIQUE KEY `emp_mob` (`emp_mob`),
  ADD UNIQUE KEY `emp_email` (`emp_email`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`dept_id`),
  ADD KEY `dept_user` (`user_userid`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`emp_id`),
  ADD UNIQUE KEY `national_id` (`national_id`),
  ADD KEY `emp_job` (`job_id`),
  ADD KEY `emp_dept` (`dept_id`),
  ADD KEY `emp_user` (`user_userid`);

--
-- Indexes for table `examinations`
--
ALTER TABLE `examinations`
  ADD PRIMARY KEY (`exam_id`),
  ADD KEY `exam_user` (`user_userid`);

--
-- Indexes for table `invoice`
--
ALTER TABLE `invoice`
  ADD PRIMARY KEY (`invoice_id`),
  ADD KEY `invoice_pat` (`pat_id`),
  ADD KEY `invoice_emp` (`emp_id`),
  ADD KEY `invoice_user` (`user_userid`);

--
-- Indexes for table `invoice_details`
--
ALTER TABLE `invoice_details`
  ADD PRIMARY KEY (`detail_id`),
  ADD KEY `det_invoice` (`invoice_id`),
  ADD KEY `det_exam` (`exam_id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`job_id`),
  ADD KEY `job_user` (`user_userid`);

--
-- Indexes for table `patients`
--
ALTER TABLE `patients`
  ADD PRIMARY KEY (`pat_id`),
  ADD UNIQUE KEY `pat_mob` (`pat_mob`),
  ADD KEY `pat_treat` (`treat_id`),
  ADD KEY `pat_user` (`user_userid`);

--
-- Indexes for table `sections`
--
ALTER TABLE `sections`
  ADD PRIMARY KEY (`section_id`),
  ADD KEY `section_user` (`user_userid`);

--
-- Indexes for table `treat_doctors`
--
ALTER TABLE `treat_doctors`
  ADD PRIMARY KEY (`treat_id`),
  ADD UNIQUE KEY `treat_mob` (`treat_mob`),
  ADD KEY `treat_section` (`section_id`),
  ADD KEY `treat_user` (`user_userid`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_userid`),
  ADD UNIQUE KEY `user_username` (`user_username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `con_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `dept_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `emp_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `examinations`
--
ALTER TABLE `examinations`
  MODIFY `exam_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `invoice`
--
ALTER TABLE `invoice`
  MODIFY `invoice_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `invoice_details`
--
ALTER TABLE `invoice_details`
  MODIFY `detail_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `job_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `patients`
--
ALTER TABLE `patients`
  MODIFY `pat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `sections`
--
ALTER TABLE `sections`
  MODIFY `section_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `treat_doctors`
--
ALTER TABLE `treat_doctors`
  MODIFY `treat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_userid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `departments`
--
ALTER TABLE `departments`
  ADD CONSTRAINT `dept_user` FOREIGN KEY (`user_userid`) REFERENCES `users` (`user_userid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `employees`
--
ALTER TABLE `employees`
  ADD CONSTRAINT `emp_dept` FOREIGN KEY (`dept_id`) REFERENCES `departments` (`dept_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `emp_job` FOREIGN KEY (`job_id`) REFERENCES `jobs` (`job_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `emp_user` FOREIGN KEY (`user_userid`) REFERENCES `users` (`user_userid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `examinations`
--
ALTER TABLE `examinations`
  ADD CONSTRAINT `exam_user` FOREIGN KEY (`user_userid`) REFERENCES `users` (`user_userid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `invoice`
--
ALTER TABLE `invoice`
  ADD CONSTRAINT `invoice_emp` FOREIGN KEY (`emp_id`) REFERENCES `employees` (`emp_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `invoice_pat` FOREIGN KEY (`pat_id`) REFERENCES `patients` (`pat_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `invoice_user` FOREIGN KEY (`user_userid`) REFERENCES `users` (`user_userid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `invoice_details`
--
ALTER TABLE `invoice_details`
  ADD CONSTRAINT `det_exam` FOREIGN KEY (`exam_id`) REFERENCES `examinations` (`exam_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `det_invoice` FOREIGN KEY (`invoice_id`) REFERENCES `invoice` (`invoice_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `jobs`
--
ALTER TABLE `jobs`
  ADD CONSTRAINT `job_user` FOREIGN KEY (`user_userid`) REFERENCES `users` (`user_userid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `patients`
--
ALTER TABLE `patients`
  ADD CONSTRAINT `pat_treat` FOREIGN KEY (`treat_id`) REFERENCES `treat_doctors` (`treat_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pat_user` FOREIGN KEY (`user_userid`) REFERENCES `users` (`user_userid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sections`
--
ALTER TABLE `sections`
  ADD CONSTRAINT `section_user` FOREIGN KEY (`user_userid`) REFERENCES `users` (`user_userid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `treat_doctors`
--
ALTER TABLE `treat_doctors`
  ADD CONSTRAINT `treat_section` FOREIGN KEY (`section_id`) REFERENCES `sections` (`section_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `treat_user` FOREIGN KEY (`user_userid`) REFERENCES `users` (`user_userid`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
