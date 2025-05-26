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


----------------------------------------------------------------- THIS IS THE START SQL FOR JOB DESCRIPTION-------------------------------------------------------------------

CREATE TABLE `aside` (
  `id` int(11) NOT NULL,
  `description` text NOT NULL,
  `title` varchar(50) NOT NULL,
  `css_id` varchar(100) NOT NULL,
  `link` varchar(100) NOT NULL,
  `image_path` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `aside`
--

INSERT INTO `aside` (`id`, `description`, `title`, `css_id`, `link`, `image_path`) VALUES
(1, 'Swinburne is a world leader in online education. We use interactive and innovative technologies to deliver our online courses and degrees. From vocational education to undergraduate and postgraduate study, Swinburne has online study options at all level.', 'Study online with Swinburne', 'aside', 'https://www.swinburne.edu.au/', 'images/Swinburne.png');

-- --------------------------------------------------------

--
-- Table structure for table `benefits`
--

CREATE TABLE `benefits` (
  `benefits_id` int(11) NOT NULL,
  `job_id` int(11) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `benefits`
--

INSERT INTO `benefits` (`benefits_id`, `job_id`, `description`) VALUES
(1, 3, 'The chance to make a real impact on our company\'s success.'),
(2, 3, 'A positive and collaborative work environment'),
(3, 3, 'Opportunities for professional development and growth.'),
(4, 2, 'A clear path for career advancement within the company.'),
(5, 2, 'Opportunity to learn from experienced developers and industry experts.'),
(6, 2, 'Access to ongoing training and development opportunities to enhance your skills.'),
(7, 1, 'Competitive salary and benefits package.'),
(8, 1, 'Professional development and training opportunities.'),
(9, 1, 'A challenging and rewarding career path in cybersecurity.');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `job_id` int(11) NOT NULL,
  `title` varchar(250) NOT NULL,
  `role` varchar(250) NOT NULL,
  `type` varchar(100) NOT NULL,
  `salary_min` varchar(50) NOT NULL,
  `salary_max` varchar(50) NOT NULL,
  `location` varchar(250) NOT NULL,
  `reference_id` varchar(100) NOT NULL,
  `report_to` varchar(250) NOT NULL,
  `about` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jobs`
--

INSERT INTO `jobs` (`job_id`, `title`, `role`, `type`, `salary_min`, `salary_max`, `location`, `reference_id`, `report_to`, `about`) VALUES
(1, 'Cybersecurity Specialist', 'Senior ', 'Full Time', '$140,000', '$200,000', 'Hawthorn, Melbourne, VIC', 'REF001', 'Chief Information Security Officer', 'As a Senior Cyber Security Specialist, you will be responsible for proactively identifying, assessing, and mitigating cyber security risks, leading incident response efforts, and contributing to the development and implementation of our cybersecurity strategy. You will work closely with other IT and business teams to ensure a robust and resilient security posture.'),
(2, 'Software Developer', 'Junior', 'Full time', '$80,000', '$90,000', ' Hawthorn, Melbourne, VIC', 'REF002', 'Software Engineer Manager', 'As a Junior Software Developer, you\'ll be an integral part of our team, contributing to the development and maintenance of our software products.This role is designed to provide hands-on experience and mentorship, allowing you to learn and grow your skills in a supportive environment. You\'ll be working alongside experienced developers, gaining valuable knowledge and contributing to real-world projects from day one.'),
(3, 'Data Analyst', 'Entry-Level', 'Full Time', '$90,000', '$110,000', 'Hawthorn, Melbourne, VIC', 'REF003', 'Senior Data Analyst', 'We are seeking a highly motivated and detail-oriented entry-level Data Analyst to join our team. As a member of our team, you will play a crucial role in supporting data-driven decision-making by assisting in the collection, analysis, and interpretation of data, identifying trends and patterns, and communicating findings to stakeholders. This is an excellent opportunity for someone with a passion for data and a desire to learn and grow within a dynamic environment.');

-- --------------------------------------------------------

--
-- Table structure for table `qualifications`
--

CREATE TABLE `qualifications` (
  `qualifications_id` int(11) NOT NULL,
  `job_id` int(11) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `qualifications`
--

INSERT INTO `qualifications` (`qualifications_id`, `job_id`, `description`) VALUES
(1, 1, 'Bachelor\'s degree in Computer Science, Information Technology, or a related field.'),
(2, 1, '7+ years of experience in cybersecurity, with a focus on incident response, threat detection, and security strategy.'),
(3, 1, '\r\nExperience with security tools and technologies, including firewalls, intrusion detection/prevention systems, SIEM tools, and endpoint security solutions.'),
(4, 1, 'Excellent communication, interpersonal, and problem-solving skills.'),
(5, 1, 'Relevant industry certifications (e.g., CISSP, CEH, CISM) are preferred.'),
(6, 2, 'Bachelor\'s degree in Computer Science or a related field, or equivalent experience.'),
(7, 2, 'A passion for learning and a desire to continuously improve your skills.'),
(8, 2, 'Ability to communicate effectively with both technical and non-technical colleagues.'),
(9, 2, 'Familiarity with one or more programming languages (e.g., Python, Java, JavaScript, C#).'),
(10, 2, 'Ability to work collaboratively in a team environment.'),
(11, 3, 'Bachelor\'s degree in a related field (e.g., mathematics, statistics, computer science) or equivalent experience.'),
(12, 3, 'Strong analytical and problem-solving skills.'),
(13, 3, 'Excellent communication and interpersonal skills.'),
(14, 3, 'Basic understanding of databases and SQL (preferred).'),
(15, 3, 'Ability to work independently and as part of a team.');

-- --------------------------------------------------------

--
-- Table structure for table `responsibilities`
--

CREATE TABLE `responsibilities` (
  `responsibilities_id` int(11) NOT NULL,
  `job_id` int(11) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `responsibilities`
--

INSERT INTO `responsibilities` (`responsibilities_id`, `job_id`, `description`) VALUES
(1, 1, 'Monitor security systems and tools for suspicious activity, analyzing events and alerts to identify potential threats.'),
(2, 1, 'Contribute to the development and implementation of cybersecurity policies, standards, and procedures.'),
(4, 1, 'Possess in-depth knowledge of various security technologies, including firewalls, intrusion detection/prevention systems, SIEM tools, and endpoint security solutions.'),
(5, 1, 'Collaborate with other IT and business teams to ensure security requirements are met.'),
(6, 1, 'Conduct root cause analysis of security incidents to identify vulnerabilities and prevent future occurrences.'),
(7, 2, 'Participate in writing, testing, and debugging code under the guidance of senior developers.'),
(8, 2, 'Stay current with the latest technologies and programming languages, and be open to learning new tools and techniques.'),
(9, 2, 'Work closely with other developers, product managers, and designers to understand requirements and contribute to the development process.'),
(10, 2, 'Contribute to the continuous improvement of our software products and processes.'),
(11, 2, 'Assist in identifying and resolving software issues, working with senior developers to find solutions.'),
(12, 3, 'Assist in gathering data from various sources, ensuring data accuracy and completeness.'),
(13, 3, 'Perform basic data analysis tasks, including data cleaning, transformation, and validation, using tools like Excel or SQL.'),
(14, 3, 'Create simple charts, graphs, and dashboards to communicate data insights in a clear and concise manner.'),
(15, 3, 'Prepare concise and accurate reports summarizing data findings and insights.'),
(16, 3, 'Work closely with team members to understand data needs and contribute to data-driven projects.');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `aside`
--
ALTER TABLE `aside`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `benefits`
--
ALTER TABLE `benefits`
  ADD PRIMARY KEY (`benefits_id`),
  ADD KEY `fk_job` (`job_id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`job_id`);

--
-- Indexes for table `qualifications`
--
ALTER TABLE `qualifications`
  ADD PRIMARY KEY (`qualifications_id`),
  ADD KEY `fk_job_id` (`job_id`) USING BTREE;

--
-- Indexes for table `responsibilities`
--
ALTER TABLE `responsibilities`
  ADD PRIMARY KEY (`responsibilities_id`),
  ADD KEY `fk_job_id` (`job_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `aside`
--
ALTER TABLE `aside`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `benefits`
--
ALTER TABLE `benefits`
  MODIFY `benefits_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `job_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `qualifications`
--
ALTER TABLE `qualifications`
  MODIFY `qualifications_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `responsibilities`
--
ALTER TABLE `responsibilities`
  MODIFY `responsibilities_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `benefits`
--
ALTER TABLE `benefits`
  ADD CONSTRAINT `fk_job` FOREIGN KEY (`job_id`) REFERENCES `jobs` (`job_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `qualifications`
--
ALTER TABLE `qualifications`
  ADD CONSTRAINT `pk_job_id` FOREIGN KEY (`job_id`) REFERENCES `jobs` (`job_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `responsibilities`
--
ALTER TABLE `responsibilities`
  ADD CONSTRAINT `fk_job_id` FOREIGN KEY (`job_id`) REFERENCES `jobs` (`job_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

--------------------------------------------------- THIS IS THE END OF SQL FOR JOB DESCRIPTION-----------------------------------------------------------------------------