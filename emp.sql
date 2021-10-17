-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 17, 2021 at 12:16 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `emp`
--

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
  `Phone` bigint(13) DEFAULT NULL,
  `Address` varchar(255) DEFAULT NULL,
  `Gender` varchar(255) DEFAULT NULL,
  `Email` varchar(255) DEFAULT NULL,
  `otp` varchar(11) DEFAULT NULL,
  `status` varchar(11) DEFAULT NULL,
  `CNIC` varchar(255) DEFAULT NULL,
  `UserPassword` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`UserId`, `Name`, `Phone`, `Address`, `Gender`, `Email`, `otp`, `status`, `CNIC`, `UserPassword`) VALUES
(10, 'Muhammad Usama', 3084957932, 'DHA PAHSE 8 , LAHORE', 'MALE', 'm.usamayounas669@gmail.com', '', '', '38104-4343221-1', 'C12345678'),
(11, 'Waqas', 3023456754, 'Ravi Road', 'MALE', 'waqas@gamil.com', '', '', '38104-4343221-1', 'C0987654321');

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
  MODIFY `UserId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
