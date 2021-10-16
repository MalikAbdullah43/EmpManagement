-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 16, 2021 at 07:01 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `emp`
--
create database emp;
use database;
-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `EmployeeId` int(11) NOT NULL,
  `Name` varchar(255) DEFAULT NULL,
  `Phone` int(13) DEFAULT NULL,
  `Address` varchar(255) DEFAULT NULL,
  `Deparment` varchar(255) DEFAULT NULL,
  `Gender` varchar(255) DEFAULT NULL,
  `CNIC` varchar(255) DEFAULT NULL,
  `Email` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`EmployeeId`, `Name`, `Phone`, `Address`, `Deparment`, `Gender`, `CNIC`, `Email`) VALUES
(1, 'Ali', 2147483647, 'lahroe', 'bio', 'male', '3452234455', ''),
(2, 'Ali', 2147483647, 'lahroe', 'bio', 'male', '3452234455', 'malik@jlaf'),
(3, 'Ali', 2147483647, 'lahroe', 'bio', 'male', '3452234455', 'malik@jlaf'),
(4, 'Ali', 2147483647, 'lahore', 'male', 'bio', '2345432345', 'malik@aldjksf');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `UserId` int(11) NOT NULL,
  `Name` varchar(255) DEFAULT NULL,
  `Phone` int(13) DEFAULT NULL,
  `Address` varchar(255) DEFAULT NULL,
  `Gender` varchar(255) DEFAULT NULL,
  `Email` varchar(255) DEFAULT NULL,
  `CNIC` varchar(255) DEFAULT NULL,
  `UserPassword` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`UserId`, `Name`, `Phone`, `Address`, `Gender`, `Email`, `CNIC`, `UserPassword`) VALUES
(1, 'Ali', 2147483647, 'lahore', 'male', NULL, NULL, ''),
(2, 'usama', 2147483647, 'lahore', 'male', NULL, NULL, ''),
(3, 'Umar', 2147483647, 'multan', 'male', NULL, NULL, ''),
(4, 'Uzair', 2147483647, 'lahore', 'male', NULL, NULL, ''),
(5, 'umar', 2147483647, 'islamabad', 'male', NULL, NULL, ''),
(6, 'umar', 2147483647, 'islamabad', 'male', NULL, NULL, ''),
(7, 'umar', 2147483647, 'islamabad', 'male', NULL, NULL, ''),
(8, 'umar', 2147483647, 'islamabad', 'male', NULL, NULL, ''),
(9, 'Ali', 2147483647, 'lahore', 'male', 'malik@aldjksf', '2345432345', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`EmployeeId`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`UserId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `EmployeeId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `UserId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
