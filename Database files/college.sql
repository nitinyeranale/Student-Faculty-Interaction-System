-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 16, 2021 at 11:19 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.4.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `college`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `adminid` int(20) NOT NULL,
  `profilename` varchar(50) DEFAULT 'default.png',
  `fname` varchar(20) DEFAULT NULL,
  `mname` varchar(20) DEFAULT NULL,
  `lname` varchar(20) DEFAULT NULL,
  `department` varchar(30) DEFAULT NULL,
  `designation` varchar(40) DEFAULT NULL,
  `email` varchar(30) NOT NULL,
  `mobileno` varchar(15) DEFAULT NULL,
  `address` varchar(50) DEFAULT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`adminid`, `profilename`, `fname`, `mname`, `lname`, `department`, `designation`, `email`, `mobileno`, `address`, `password`) VALUES
(1, 'default.png', '', '', '', 'CSE', '', 'aditya@admin.com', '', '', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `assignmentsgiven`
--

CREATE TABLE `assignmentsgiven` (
  `id` int(11) NOT NULL,
  `givenby` varchar(20) NOT NULL,
  `name` varchar(50) NOT NULL,
  `class` varchar(20) NOT NULL,
  `subject` varchar(30) NOT NULL,
  `givenAt` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `assignmentssubmitted`
--

CREATE TABLE `assignmentssubmitted` (
  `id` int(11) DEFAULT NULL,
  `prn` varchar(30) DEFAULT NULL,
  `filename` varchar(50) NOT NULL,
  `submittedAt` datetime DEFAULT current_timestamp(),
  `class` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `chatusers`
--

CREATE TABLE `chatusers` (
  `prn` varchar(50) NOT NULL,
  `fname` varchar(30) DEFAULT NULL,
  `lname` varchar(30) DEFAULT NULL,
  `profilename` varchar(100) DEFAULT 'default.png',
  `chat_status` varchar(50) NOT NULL DEFAULT 'Offline now'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `circular`
--

CREATE TABLE `circular` (
  `id` int(11) NOT NULL,
  `type` varchar(20) NOT NULL,
  `notification` varchar(500) NOT NULL,
  `sentby` int(50) NOT NULL,
  `time` datetime NOT NULL DEFAULT current_timestamp(),
  `read_status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `faculty`
--

CREATE TABLE `faculty` (
  `facultyid` int(11) NOT NULL,
  `profile_pic` varchar(200) NOT NULL DEFAULT 'default.png',
  `fname` varchar(20) NOT NULL,
  `mname` varchar(20) NOT NULL,
  `lname` varchar(20) NOT NULL,
  `department` varchar(30) NOT NULL,
  `designation` varchar(40) NOT NULL,
  `email` varchar(30) NOT NULL,
  `mb` varchar(15) NOT NULL,
  `address` varchar(50) NOT NULL,
  `password` varchar(50) DEFAULT NULL,
  `status` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `msg_id` int(11) NOT NULL,
  `incoming_msg_id` varchar(255) NOT NULL,
  `outgoing_msg_id` varchar(255) NOT NULL,
  `msg` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `notes`
--

CREATE TABLE `notes` (
  `id` int(11) NOT NULL,
  `pdf` varchar(100) NOT NULL,
  `subject` varchar(50) NOT NULL,
  `sentby` int(11) NOT NULL,
  `type` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `requests`
--

CREATE TABLE `requests` (
  `id` int(11) NOT NULL,
  `user` varchar(30) NOT NULL,
  `friendid` varchar(30) NOT NULL,
  `status` varchar(30) NOT NULL,
  `received_time` datetime NOT NULL DEFAULT current_timestamp(),
  `read_status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `prn` varchar(20) NOT NULL,
  `profilepic` varchar(100) DEFAULT 'default.png',
  `fname` varchar(20) DEFAULT NULL,
  `mname` varchar(20) DEFAULT NULL,
  `lname` varchar(30) DEFAULT NULL,
  `birthdate` varchar(40) DEFAULT NULL,
  `email` varchar(30) NOT NULL,
  `mobileno` varchar(15) DEFAULT NULL,
  `address` varchar(50) DEFAULT NULL,
  `department` varchar(50) NOT NULL,
  `class` varchar(30) DEFAULT NULL,
  `division` varchar(20) NOT NULL,
  `currentcity` varchar(30) DEFAULT NULL,
  `highschool` varchar(100) DEFAULT NULL,
  `highercollege` varchar(100) DEFAULT NULL,
  `hometown` varchar(100) DEFAULT NULL,
  `gender` varchar(20) DEFAULT NULL,
  `sociallinks` varchar(200) DEFAULT NULL,
  `password` varchar(50) NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `syllabus`
--

CREATE TABLE `syllabus` (
  `id` int(11) NOT NULL,
  `pdf` varchar(100) NOT NULL,
  `type` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `timetable`
--

CREATE TABLE `timetable` (
  `id` int(11) NOT NULL,
  `pdf` varchar(100) NOT NULL,
  `type` varchar(20) NOT NULL,
  `division` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`adminid`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `assignmentsgiven`
--
ALTER TABLE `assignmentsgiven`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `assignmentssubmitted`
--
ALTER TABLE `assignmentssubmitted`
  ADD KEY `fk_student_prn` (`prn`),
  ADD KEY `fk_assignmentsgiven` (`id`);

--
-- Indexes for table `chatusers`
--
ALTER TABLE `chatusers`
  ADD PRIMARY KEY (`prn`);

--
-- Indexes for table `circular`
--
ALTER TABLE `circular`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `faculty`
--
ALTER TABLE `faculty`
  ADD PRIMARY KEY (`facultyid`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`msg_id`);

--
-- Indexes for table `notes`
--
ALTER TABLE `notes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `requests`
--
ALTER TABLE `requests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`prn`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `syllabus`
--
ALTER TABLE `syllabus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `timetable`
--
ALTER TABLE `timetable`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `adminid` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `assignmentsgiven`
--
ALTER TABLE `assignmentsgiven`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `circular`
--
ALTER TABLE `circular`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `faculty`
--
ALTER TABLE `faculty`
  MODIFY `facultyid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `msg_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `notes`
--
ALTER TABLE `notes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `requests`
--
ALTER TABLE `requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `syllabus`
--
ALTER TABLE `syllabus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `timetable`
--
ALTER TABLE `timetable`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `assignmentssubmitted`
--
ALTER TABLE `assignmentssubmitted`
  ADD CONSTRAINT `fk_assignmentsgiven` FOREIGN KEY (`id`) REFERENCES `assignmentsgiven` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_student_prn` FOREIGN KEY (`prn`) REFERENCES `student` (`prn`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
