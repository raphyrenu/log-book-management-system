-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 30, 2024 at 08:14 AM
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
-- Database: `log_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `log_entries`
--

CREATE TABLE `log_entries` (
  `id` int(11) NOT NULL,
  `entry_date` date NOT NULL,
  `entry_time` time NOT NULL,
  `days` varchar(255) NOT NULL,
  `week` int(11) NOT NULL,
  `activity_description` text NOT NULL,
  `working_hour` decimal(5,2) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_student`
--

CREATE TABLE `user_student` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_student`
--

INSERT INTO `user_student` (`id`, `username`, `email`, `password`, `created_at`) VALUES
(1, 'raphyboy', 'raphyboy159@gmail.com', '$2y$10$EIGtKTY4wCIUqxb.zEAKe.yJQIKUCOHrj/nOV0VQCZdZQCbnPrJb2', '2024-05-30 05:32:00'),
(2, 'raphy', 'raphyboy159@gmail.com', '$2y$10$qUWwWI.i2hvpEqujmE/zbuNN0zNL9B3LfbN1rmtJojF/SDiz37QPm', '2024-05-30 05:37:32'),
(3, 'Renu12', 'raphyboy159@gmail.com', '$2y$10$261K3gB6PHgQ98BDyz0pkellhR4ZB0Xr/PYGLMcn/2lW9gYHqTGwG', '2024-05-30 06:08:23');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `log_entries`
--
ALTER TABLE `log_entries`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `user_student`
--
ALTER TABLE `user_student`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `log_entries`
--
ALTER TABLE `log_entries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user_student`
--
ALTER TABLE `user_student`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `log_entries`
--
ALTER TABLE `log_entries`
  ADD CONSTRAINT `log_entries_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user_student` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
