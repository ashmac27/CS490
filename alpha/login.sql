-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: sql1.njit.edu
-- Generation Time: May 27, 2020 at 07:06 PM
-- Server version: 8.0.17
-- PHP Version: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `am2829`
--
-- --------------------------------------------------------
--
-- Table structure for table `login`
--

CREATE TABLE IF NOT EXISTS `login` (
  `username` varchar(7) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`username`, `password`, `role`) VALUES('am123', '5f4dcc3b5aa765d61d8327deb882cf99', 'Student');
INSERT INTO `login` (`username`, `password`, `role`) VALUES('am124', '5f4dcc3b5aa765d61d8327deb882cf99', 'Student');
INSERT INTO `login` (`username`, `password`, `role`) VALUES('am125', '5f4dcc3b5aa765d61d8327deb882cf99', 'Student');
INSERT INTO `login` (`username`, `password`, `role`) VALUES('am126', '5f4dcc3b5aa765d61d8327deb882cf99', 'Student');
INSERT INTO `login` (`username`, `password`, `role`) VALUES('am127', '5f4dcc3b5aa765d61d8327deb882cf99', 'Student');
INSERT INTO `login` (`username`, `password`, `role`) VALUES('am128', '5f4dcc3b5aa765d61d8327deb882cf99', 'Student');
INSERT INTO `login` (`username`, `password`, `role`) VALUES('db123', '5f4dcc3b5aa765d61d8327deb882cf99', 'Teacher');
INSERT INTO `login` (`username`, `password`, `role`) VALUES('db124', '5f4dcc3b5aa765d61d8327deb882cf99', 'Teacher');
INSERT INTO `login` (`username`, `password`, `role`) VALUES('db125', '5f4dcc3b5aa765d61d8327deb882cf99', 'Teacher');
INSERT INTO `login` (`username`, `password`, `role`) VALUES('db126', '5f4dcc3b5aa765d61d8327deb882cf99', 'Teacher');
INSERT INTO `login` (`username`, `password`, `role`) VALUES('db127', '5f4dcc3b5aa765d61d8327deb882cf99', 'Teacher');
INSERT INTO `login` (`username`, `password`, `role`) VALUES('db128', '5f4dcc3b5aa765d61d8327deb882cf99', 'Teacher');

ALTER TABLE `login`
 ADD PRIMARY KEY (`username`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
