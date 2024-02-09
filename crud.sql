-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 09, 2024 at 01:20 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `crud`
--

-- --------------------------------------------------------

--
-- Table structure for table `blocks`
--

CREATE TABLE `blocks` (
  `block_id` int(11) NOT NULL,
  `taluk_id` int(11) NOT NULL,
  `block_name` varchar(100) NOT NULL,
  `block_name_vernacular` varchar(100) NOT NULL,
  `status` enum('ACTIVE','INACTIVE','DELETED','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `blocks`
--

INSERT INTO `blocks` (`block_id`, `taluk_id`, `block_name`, `block_name_vernacular`, `status`) VALUES
(5, 6, 'block', 'தொகுதி', 'ACTIVE');

-- --------------------------------------------------------

--
-- Table structure for table `districts`
--

CREATE TABLE `districts` (
  `district_id` int(11) NOT NULL,
  `state_id` int(11) NOT NULL,
  `district_name` varchar(100) NOT NULL,
  `district_name_vernacular` varchar(100) NOT NULL,
  `district_headquarters` varchar(100) NOT NULL,
  `district_headquarters_vernacular` varchar(100) NOT NULL,
  `status` enum('ACTIVE','INACTIVE','DELETED','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `districts`
--

INSERT INTO `districts` (`district_id`, `state_id`, `district_name`, `district_name_vernacular`, `district_headquarters`, `district_headquarters_vernacular`, `status`) VALUES
(1, 1, 'tirupathi', 'திருப்பதி', 'Tamilnadu', 'தமிழ்நாடு', 'ACTIVE');

-- --------------------------------------------------------

--
-- Table structure for table `institutionalcourses`
--

CREATE TABLE `institutionalcourses` (
  `institution_course_id` int(11) NOT NULL,
  `institution_id` int(11) NOT NULL,
  `stream_id` int(11) NOT NULL,
  `course_duration` enum('2','3','4','5YEARS','') NOT NULL,
  `course_category` enum('UG','PG','DIPLOMA','') NOT NULL,
  `special_category` enum('0','1','') NOT NULL,
  `status` enum('ACTIVE','INACTIVE','DELETED','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `institutionalcourses`
--

INSERT INTO `institutionalcourses` (`institution_course_id`, `institution_id`, `stream_id`, `course_duration`, `course_category`, `special_category`, `status`) VALUES
(0, 3, 0, '4', 'DIPLOMA', '1', 'ACTIVE'),
(1, 3, 0, '4', 'UG', '0', 'ACTIVE'),
(4, 3, 0, '2', 'PG', '0', 'ACTIVE');

-- --------------------------------------------------------

--
-- Table structure for table `institutionprincipals`
--

CREATE TABLE `institutionprincipals` (
  `institution_principal_id` int(11) NOT NULL,
  `institution_id` varchar(100) NOT NULL,
  `principal_name` varchar(255) NOT NULL,
  `principal_name_vernacular` varchar(255) NOT NULL,
  `principal_email` varchar(255) NOT NULL,
  `principal_mobile` varchar(20) NOT NULL,
  `status` enum('ACTIVE','INACTIVE','DELETED','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `institutionprincipals`
--

INSERT INTO `institutionprincipals` (`institution_principal_id`, `institution_id`, `principal_name`, `principal_name_vernacular`, `principal_email`, `principal_mobile`, `status`) VALUES
(4, '3', 'Principal Name', 'முதன்மை பெயர்', 'principal@gmail.com', '6879XXXXYYYY', 'ACTIVE');

-- --------------------------------------------------------

--
-- Table structure for table `institutions`
--

CREATE TABLE `institutions` (
  `institution_id` int(11) NOT NULL,
  `institution_code` varchar(100) NOT NULL,
  `institution_name` varchar(255) NOT NULL,
  `institution_name_vernacular` varchar(255) NOT NULL,
  `institution_type_id` int(11) NOT NULL,
  `place_id` int(11) NOT NULL,
  `status` enum('ACTIVE','INACTIVE','DELETED','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `institutions`
--

INSERT INTO `institutions` (`institution_id`, `institution_code`, `institution_name`, `institution_name_vernacular`, `institution_type_id`, `place_id`, `status`) VALUES
(3, 'Institution Code', 'Institution Name', 'நிறுவனத்தின் பெயர்', 8, 5, 'ACTIVE');

-- --------------------------------------------------------

--
-- Table structure for table `institutiontypes`
--

CREATE TABLE `institutiontypes` (
  `institution_type_id` int(11) NOT NULL,
  `institution_type` varchar(100) NOT NULL,
  `status` enum('ACTIVE','INACTIVE','DELETED','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `institutiontypes`
--

INSERT INTO `institutiontypes` (`institution_type_id`, `institution_type`, `status`) VALUES
(8, 'Institution Type', 'ACTIVE');

-- --------------------------------------------------------

--
-- Table structure for table `logins`
--

CREATE TABLE `logins` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `logins`
--

INSERT INTO `logins` (`id`, `username`, `password`) VALUES
(1, 'admin', '827ccb0eea8a706c4c34a16891f84e7b');

-- --------------------------------------------------------

--
-- Table structure for table `places`
--

CREATE TABLE `places` (
  `place_id` int(11) NOT NULL,
  `block_id` int(11) NOT NULL,
  `place_type` enum('Metro','Urban','Semi-Urban','Rural','') NOT NULL,
  `place_name` varchar(100) NOT NULL,
  `place_name_vernacular` varchar(100) NOT NULL,
  `pincode` varchar(100) NOT NULL,
  `status` enum('ACTIVE','INACTIVE','DELETED','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `places`
--

INSERT INTO `places` (`place_id`, `block_id`, `place_type`, `place_name`, `place_name_vernacular`, `pincode`, `status`) VALUES
(5, 5, 'Urban', 'kanyakumari', 'கன்னியாகுமரி', '678956', 'ACTIVE');

-- --------------------------------------------------------

--
-- Table structure for table `states`
--

CREATE TABLE `states` (
  `state_id` int(11) NOT NULL,
  `state_name` varchar(100) NOT NULL,
  `state_name_vernacular` varchar(100) NOT NULL,
  `status` enum('ACTIVE','INACTIVE','DELETED','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `states`
--

INSERT INTO `states` (`state_id`, `state_name`, `state_name_vernacular`, `status`) VALUES
(1, 'Tamilnadu', 'தமிழ்நாடு', 'ACTIVE');

-- --------------------------------------------------------

--
-- Table structure for table `streams`
--

CREATE TABLE `streams` (
  `stream_id` int(11) NOT NULL,
  `institution_type_id` varchar(100) NOT NULL,
  `stream_name` varchar(255) NOT NULL,
  `stream_name_vernacular` varchar(255) NOT NULL,
  `status` enum('ACTIVE','INACTIVE','DELETED','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `streams`
--

INSERT INTO `streams` (`stream_id`, `institution_type_id`, `stream_name`, `stream_name_vernacular`, `status`) VALUES
(0, '8', 'Stream Name', 'ஸ்ட்ரீம் பெயர்', 'ACTIVE');

-- --------------------------------------------------------

--
-- Table structure for table `taluks`
--

CREATE TABLE `taluks` (
  `taluk_id` int(11) NOT NULL,
  `district_id` int(11) NOT NULL,
  `taluk_name` varchar(100) NOT NULL,
  `taluk_name_vernacular` varchar(100) NOT NULL,
  `status` enum('ACTIVE','INACTIVE','DELETED','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `taluks`
--

INSERT INTO `taluks` (`taluk_id`, `district_id`, `taluk_name`, `taluk_name_vernacular`, `status`) VALUES
(6, 1, 'taluk', 'தாலுக்கா', 'ACTIVE');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `blocks`
--
ALTER TABLE `blocks`
  ADD PRIMARY KEY (`block_id`);

--
-- Indexes for table `districts`
--
ALTER TABLE `districts`
  ADD PRIMARY KEY (`district_id`);

--
-- Indexes for table `institutionalcourses`
--
ALTER TABLE `institutionalcourses`
  ADD PRIMARY KEY (`institution_course_id`);

--
-- Indexes for table `institutionprincipals`
--
ALTER TABLE `institutionprincipals`
  ADD PRIMARY KEY (`institution_principal_id`);

--
-- Indexes for table `institutions`
--
ALTER TABLE `institutions`
  ADD PRIMARY KEY (`institution_id`);

--
-- Indexes for table `institutiontypes`
--
ALTER TABLE `institutiontypes`
  ADD PRIMARY KEY (`institution_type_id`);

--
-- Indexes for table `logins`
--
ALTER TABLE `logins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `places`
--
ALTER TABLE `places`
  ADD PRIMARY KEY (`place_id`);

--
-- Indexes for table `states`
--
ALTER TABLE `states`
  ADD PRIMARY KEY (`state_id`);

--
-- Indexes for table `streams`
--
ALTER TABLE `streams`
  ADD PRIMARY KEY (`stream_id`);

--
-- Indexes for table `taluks`
--
ALTER TABLE `taluks`
  ADD PRIMARY KEY (`taluk_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `blocks`
--
ALTER TABLE `blocks`
  MODIFY `block_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `districts`
--
ALTER TABLE `districts`
  MODIFY `district_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `institutionalcourses`
--
ALTER TABLE `institutionalcourses`
  MODIFY `institution_course_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `institutionprincipals`
--
ALTER TABLE `institutionprincipals`
  MODIFY `institution_principal_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `institutions`
--
ALTER TABLE `institutions`
  MODIFY `institution_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `institutiontypes`
--
ALTER TABLE `institutiontypes`
  MODIFY `institution_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `logins`
--
ALTER TABLE `logins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `places`
--
ALTER TABLE `places`
  MODIFY `place_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `states`
--
ALTER TABLE `states`
  MODIFY `state_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `streams`
--
ALTER TABLE `streams`
  MODIFY `stream_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `taluks`
--
ALTER TABLE `taluks`
  MODIFY `taluk_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
