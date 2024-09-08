-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 08, 2024 at 05:32 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ridpathdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `enrollmentrecords`
--

CREATE TABLE `enrollmentrecords` (
  `enrollmentID` int(254) NOT NULL,
  `studentID` int(254) NOT NULL,
  `strandID` int(254) NOT NULL,
  `paymentModeID` int(254) NOT NULL,
  `enrollmentStatusID` int(254) NOT NULL,
  `interestID` int(254) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `enrollmentstatus`
--

CREATE TABLE `enrollmentstatus` (
  `statusID` int(254) NOT NULL,
  `description` varchar(254) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `interests`
--

CREATE TABLE `interests` (
  `interestID` int(254) NOT NULL,
  `description` varchar(254) NOT NULL,
  `strandID` int(254) NOT NULL,
  `isactive` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `interests`
--

INSERT INTO `interests` (`interestID`, `description`, `strandID`, `isactive`) VALUES
(1, 'Teaching', 6, 'Yes'),
(2, 'Politics', 5, 'Yes'),
(3, 'Public Service', 5, 'Yes'),
(4, 'Geology', 4, 'Yes'),
(5, 'Computers', 7, 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `miscellaneousfees`
--

CREATE TABLE `miscellaneousfees` (
  `miscID` int(254) NOT NULL,
  `strandID` int(254) NOT NULL,
  `description` varchar(254) NOT NULL,
  `amount` int(254) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `miscellaneousfees`
--

INSERT INTO `miscellaneousfees` (`miscID`, `strandID`, `description`, `amount`) VALUES
(4, 4, 'Laboratory', 235);

-- --------------------------------------------------------

--
-- Table structure for table `paymentmodes`
--

CREATE TABLE `paymentmodes` (
  `paymentModeID` int(254) NOT NULL,
  `description` varchar(254) NOT NULL,
  `paymenttype` varchar(20) NOT NULL,
  `qrimgurl` varchar(500) NOT NULL,
  `isactive` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `paymentmodes`
--

INSERT INTO `paymentmodes` (`paymentModeID`, `description`, `paymenttype`, `qrimgurl`, `isactive`) VALUES
(5, 'GCash With Sample QR', 'Online', '../payment-qr/GCash With Sample QR.png', 'Yes'),
(6, 'MAYA with Sample QR', 'Online', '../payment-qr/MAYA with Sample QR.png', 'Yes'),
(7, 'Cash Payment', 'Offline', '', 'Yes'),
(8, 'GoTyme with Sample QR', 'Online', '../payment-qr/GoTyme with Sample QR.png', 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `paymentrecord`
--

CREATE TABLE `paymentrecord` (
  `transactionID` int(254) NOT NULL,
  `studentID` int(254) NOT NULL,
  `paymentModeID` int(254) NOT NULL,
  `amount` int(254) NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `strands`
--

CREATE TABLE `strands` (
  `strandID` int(254) NOT NULL,
  `strandname` varchar(254) NOT NULL,
  `abbreviation` varchar(254) NOT NULL,
  `isactive` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `strands`
--

INSERT INTO `strands` (`strandID`, `strandname`, `abbreviation`, `isactive`) VALUES
(4, 'Science, Technology, Engineering, and Mathematics', 'STEM', 'Yes'),
(5, 'Humanities and Social Sciences', 'HUMSS', 'Yes'),
(6, 'General Academic', 'GA', 'Yes'),
(7, 'Technical Vocational Livelihood - Computer System Servicing', 'TVL - CSS', 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `tuitionfees`
--

CREATE TABLE `tuitionfees` (
  `tuitionID` int(254) NOT NULL,
  `strandID` int(254) NOT NULL,
  `amount` int(254) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tuitionfees`
--

INSERT INTO `tuitionfees` (`tuitionID`, `strandID`, `amount`) VALUES
(1, 4, 23456),
(2, 5, 32432);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userID` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `isActive` int(11) NOT NULL,
  `userRole` int(11) NOT NULL,
  `fullname` varchar(200) NOT NULL,
  `lastname` varchar(200) NOT NULL,
  `firstname` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userID`, `username`, `password`, `isActive`, `userRole`, `fullname`, `lastname`, `firstname`) VALUES
(1, 'admin', 'admin', 1, 1, 'admin, admin', 'admin', 'admin'),
(2, 'Brian', 'Moscoso@2024', 1, 1, 'Moscoso, Brian', 'Moscoso', 'Brian'),
(3, 'ErrL18', 'Rebuya@2024', 1, 1, 'Rebuya, Rouise Earl', 'Rebuya', 'Rouise Earl'),
(4, 'Jemrel', 'Mangaliman@2024', 1, 1, 'Mangaliman, Jemrel Ricky', 'Mangaliman', 'Jemrel Ricky'),
(5, 'Khinz', 'Demonteverde@2024', 1, 1, 'Demonteverde, Christian', 'Demonteverde', 'Christian'),
(6, '2202516', 'Reburt@2024', 1, 1, 'Reburtsssss, Rael', 'Reburtsssss', 'Rael'),
(7, '053961', 'test@2024', 1, 0, 'test, test', 'test', 'test'),
(8, 'tet', 'tet@2024', 1, 0, 'tet, tetris', 'tet', 'tetris');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `enrollmentrecords`
--
ALTER TABLE `enrollmentrecords`
  ADD PRIMARY KEY (`enrollmentID`);

--
-- Indexes for table `enrollmentstatus`
--
ALTER TABLE `enrollmentstatus`
  ADD PRIMARY KEY (`statusID`);

--
-- Indexes for table `interests`
--
ALTER TABLE `interests`
  ADD PRIMARY KEY (`interestID`);

--
-- Indexes for table `miscellaneousfees`
--
ALTER TABLE `miscellaneousfees`
  ADD PRIMARY KEY (`miscID`);

--
-- Indexes for table `paymentmodes`
--
ALTER TABLE `paymentmodes`
  ADD PRIMARY KEY (`paymentModeID`);

--
-- Indexes for table `paymentrecord`
--
ALTER TABLE `paymentrecord`
  ADD PRIMARY KEY (`transactionID`);

--
-- Indexes for table `strands`
--
ALTER TABLE `strands`
  ADD PRIMARY KEY (`strandID`);

--
-- Indexes for table `tuitionfees`
--
ALTER TABLE `tuitionfees`
  ADD PRIMARY KEY (`tuitionID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `enrollmentrecords`
--
ALTER TABLE `enrollmentrecords`
  MODIFY `enrollmentID` int(254) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `enrollmentstatus`
--
ALTER TABLE `enrollmentstatus`
  MODIFY `statusID` int(254) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `interests`
--
ALTER TABLE `interests`
  MODIFY `interestID` int(254) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `miscellaneousfees`
--
ALTER TABLE `miscellaneousfees`
  MODIFY `miscID` int(254) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `paymentmodes`
--
ALTER TABLE `paymentmodes`
  MODIFY `paymentModeID` int(254) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `paymentrecord`
--
ALTER TABLE `paymentrecord`
  MODIFY `transactionID` int(254) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `strands`
--
ALTER TABLE `strands`
  MODIFY `strandID` int(254) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tuitionfees`
--
ALTER TABLE `tuitionfees`
  MODIFY `tuitionID` int(254) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
