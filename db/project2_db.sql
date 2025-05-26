SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

-- Table structure for table `eoi` --

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


-- Table structure for table `users`
--

CREATE TABLE `users` (
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `full_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

---- Dumping data for table `users`--

INSERT INTO `users` (`username`, `password`) VALUES
('teagan', '', 'Abc123!'),
('anna', 'ABc123!'),
('joshua', 'ABC123!'),
('tisang', 'AbC123!');
