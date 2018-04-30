-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 28, 2018 at 08:23 AM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 7.2.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ta_applications`
--

-- --------------------------------------------------------

--
-- Table structure for table `applicants`
--

CREATE TABLE `applicants` (
  `last_name` varchar(50) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `uid` varchar(9) NOT NULL,
  `gpa` float NOT NULL,
  `entry_semester` enum('summer','spring','fall') NOT NULL,
  `entry_year` varchar(4) NOT NULL,
  `student_type` enum('phd','ms','ugrad') NOT NULL,
  `department` varchar(30) NOT NULL,
  `advisor` varchar(30) NOT NULL,
  `is_ta` tinyint(1) NOT NULL,
  `ta_step` enum('0','1','2','3') NOT NULL,
  `current_course` text NOT NULL,
  `instructor` text NOT NULL,
  `has_ms` tinyint(1) NOT NULL,
  `is_non_us` tinyint(1) NOT NULL,
  `passed_mei` tinyint(1) DEFAULT NULL,
  `taking_umei` tinyint(1) DEFAULT NULL,
  `can_teach` tinyint(1) NOT NULL,
  `prefers_teach` tinyint(1) NOT NULL,
  `position_type` enum('fulltime','parttime') NOT NULL,
  `semester` enum('fall','spring','summer') NOT NULL,
  `year` varchar(4) NOT NULL,
  `additional_info` varchar(2000) DEFAULT NULL,
  `directory_id` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `experience`
--

CREATE TABLE `experience` (
  `directory_id` varchar(20) NOT NULL,
  `course` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `experience`
--

CREATE TABLE `paired_ta_final` (
  `directory_id` varchar(20) NOT NULL,
  `course` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `preferred_courses`
--

CREATE TABLE `preferred_courses` (
  `directory_id` varchar(20) NOT NULL,
  `course` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `transcripts`
--

CREATE TABLE `transcripts` (
  `directory_id` varchar(20) NOT NULL,
  `name` varchar(20) NOT NULL,
  `mimType` varchar(512) NOT NULL,
  `data` longblob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `applicants`
--
ALTER TABLE `applicants`
  ADD PRIMARY KEY (`directory_id`);

--
-- Indexes for table `transcripts`
--
ALTER TABLE `transcripts`
  ADD PRIMARY KEY (`directory_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
