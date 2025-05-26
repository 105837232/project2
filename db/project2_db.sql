-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 26, 2025 at 05:11 AM
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
-- Database: `project2_db`
--
CREATE DATABASE IF NOT EXISTS `project2_db` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `project2_db`;

-- --------------------------------------------------------

CREATE TABLE `eoi` (
  `EOInumber` int(11) NOT NULL,
  `jobRef` char(5) NOT NULL,
  `firstName` varchar(20) NOT NULL,
  `lastName` varchar(20) NOT NULL,
  `dob` varchar(10) NOT NULL,
  `gender` enum('Male','Female') NOT NULL,
  `address` varchar(40) NOT NULL,
  `suburb` varchar(40) NOT NULL,
  `state` varchar(10) NOT NULL,
  `postcode` char(4) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` varchar(12) NOT NULL,
  `skills` text,
  `otherSkills` text,
  `status` enum('New','Current','Final') NOT NULL DEFAULT 'New'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `eoi`
--

INSERT INTO `eoi` (`EOInumber`, `jobRef`, `firstName`, `lastName`, `dob`, `gender`, `address`, `suburb`, `state`, `postcode`, `email`, `phone`, `skills`, `otherSkills`, `status`) VALUES
(1, 'CS456', 'Lu', 'Abc', '19/01/2005', 'Male', 'Kieu Mai', 'Hanoi', 'NSW', '1001', 'hashing.bump@gmail.com', '0784758412', 'JavaScript, Others', 'Nodejs', 'New'),
(2, 'CS666', 'Lock', 'Key', '10/02/2005', 'Male', 'Long Bien', 'Ha Noi', 'VIC', '3002', 'lockkey@gmail.com', '0945656767', 'HTML, CSS', '', 'Current'),
(3, 'PR123', 'Nami', 'Lee', '15/03/2005', 'Female', 'Tran Binh', 'Hanoi', 'NSW', '2619', 'namiluu@gmail.com', '0383874893', 'HTML, CSS', '', 'New'),
(4, 'CS666', 'Teagan', 'Osha', '29/05/2005', 'Female', 'Kim Giang', 'Hanoi', 'SA', '5001', 'hieunguyen@gmail.com', '0978452563', 'CSS, Others', 'Reactjs', 'New');




--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`) VALUES
(14, 'joshuathai', '$2y$10$Wn.Tbr4LM4kYg72fcYeoou.8jPxDX9ho8fMwszYqb/5ZXmy2TCdmC'),
(19, 'joshuathai343', '$2y$10$4V.4aAG2Lso.TSw6US4zwOjMLHZCpfPp1747KwpVhw0KL3iDLtT.2'),
(21, 'joshuathaiDDS', '$2y$10$.8Fr7QmfK.hwLxboKp0ne.9jLiDIeKBzAlzIJbXkU5VmgGpFqVB/6');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

