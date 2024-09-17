-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 17, 2024 at 03:13 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.1.17

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
-- Table structure for table `classschedule`
--

CREATE TABLE `classschedule` (
  `classID` int(254) NOT NULL,
  `sectionID` int(254) NOT NULL,
  `subjectID` int(254) NOT NULL,
  `semesterID` int(254) NOT NULL,
  `dayID` int(254) NOT NULL,
  `starttime` varchar(254) NOT NULL,
  `endtime` varchar(254) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `classschedule`
--

INSERT INTO `classschedule` (`classID`, `sectionID`, `subjectID`, `semesterID`, `dayID`, `starttime`, `endtime`) VALUES
(1, 0, 0, 0, 1, '10:19', '11:19'),
(2, 6, 2, 2, 2, '10:21', '11:21');

-- --------------------------------------------------------

--
-- Table structure for table `days`
--

CREATE TABLE `days` (
  `dayID` int(254) NOT NULL,
  `dayname` varchar(254) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `days`
--

INSERT INTO `days` (`dayID`, `dayname`) VALUES
(1, 'Monday'),
(2, 'Tuesday'),
(3, 'Wednesday'),
(4, 'Thursday'),
(5, 'Friday'),
(6, 'Saturday'),
(7, 'Sunday');

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
  `interest` varchar(254) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `enrollmentstatus`
--

CREATE TABLE `enrollmentstatus` (
  `statusID` int(254) NOT NULL,
  `statusname` varchar(254) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `enrollmentstatus`
--

INSERT INTO `enrollmentstatus` (`statusID`, `statusname`) VALUES
(1, 'Not Enrolled'),
(2, 'Pending Registrar Assessment'),
(3, 'For Resubmit'),
(4, 'Pending Balance Settlement'),
(5, 'Awaiting Admission Confirmation');

-- --------------------------------------------------------

--
-- Table structure for table `fileattachments`
--

CREATE TABLE `fileattachments` (
  `fileID` int(254) NOT NULL,
  `tempID` int(254) NOT NULL,
  `enrollmentID` int(254) NOT NULL,
  `filename` varchar(200) NOT NULL,
  `attachmentname` varchar(254) NOT NULL,
  `attachmenturl` varchar(254) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `interests`
--

CREATE TABLE `interests` (
  `interestID` int(254) NOT NULL,
  `description` varchar(254) NOT NULL,
  `strandID` int(254) NOT NULL,
  `isactive` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `interests`
--

INSERT INTO `interests` (`interestID`, `description`, `strandID`, `isactive`) VALUES
(1, 'Teaching', 6, 'Yes'),
(2, 'Politics', 5, 'Yes'),
(3, 'Public Service', 5, 'Yes'),
(4, 'Geology', 4, 'Yes'),
(5, 'Computers', 7, 'Yes'),
(6, 'Computers', 4, 'Yes'),
(7, 'Technology', 4, 'Yes'),
(8, 'Technology', 7, 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `miscellaneousfees`
--

CREATE TABLE `miscellaneousfees` (
  `miscID` int(254) NOT NULL,
  `strandID` int(254) NOT NULL,
  `description` varchar(254) NOT NULL,
  `amount` int(254) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sections`
--

CREATE TABLE `sections` (
  `sectionID` int(254) NOT NULL,
  `sectionname` varchar(254) NOT NULL,
  `isactive` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sections`
--

INSERT INTO `sections` (`sectionID`, `sectionname`, `isactive`) VALUES
(1, 'Grade 11 - Anahaw', 'Yes'),
(4, 'Grade 11 - Narra', 'Yes'),
(5, 'Grade 11 - Abanico', 'Yes'),
(6, 'Grade 11 - Rosewood', 'Yes'),
(7, 'Grade 12 - Bonifacio', 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `semester`
--

CREATE TABLE `semester` (
  `semesterID` int(254) NOT NULL,
  `semestername` varchar(254) NOT NULL,
  `isactive` varchar(20) NOT NULL,
  `startdate` varchar(254) NOT NULL,
  `enddate` varchar(254) NOT NULL,
  `formattedstarrdate` varchar(254) NOT NULL,
  `formattedenddate` varchar(254) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `semester`
--

INSERT INTO `semester` (`semesterID`, `semestername`, `isactive`, `startdate`, `enddate`, `formattedstarrdate`, `formattedenddate`) VALUES
(1, '1st Sem', 'Yes', '2024-09-04', '2024-09-17', '', ''),
(2, '2nd sem', 'Yes', '2024-06-03', '2024-10-31', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `strands`
--

CREATE TABLE `strands` (
  `strandID` int(254) NOT NULL,
  `strandname` varchar(254) NOT NULL,
  `abbreviation` varchar(254) NOT NULL,
  `isactive` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `tempID` int(254) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `middlename` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `contactnumber` varchar(100) NOT NULL,
  `studentnumber` varchar(100) NOT NULL,
  `password` varchar(254) NOT NULL,
  `userRole` int(10) NOT NULL,
  `isactive` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`tempID`, `firstname`, `middlename`, `lastname`, `email`, `contactnumber`, `studentnumber`, `password`, `userRole`, `isactive`) VALUES
(1, 'John', 'Titor', 'Smith', 'johnsmith@gmail.com', '09123456789', '', 'password', 4, '');

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `subjectID` int(254) NOT NULL,
  `subjectname` varchar(254) NOT NULL,
  `isactive` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`subjectID`, `subjectname`, `isactive`) VALUES
(1, 'Gen Math', 'Yes'),
(2, 'Earth and Life Science', 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `tuitionfees`
--

CREATE TABLE `tuitionfees` (
  `tuitionID` int(254) NOT NULL,
  `strandID` int(254) NOT NULL,
  `amount` int(254) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userID`, `username`, `password`, `isActive`, `userRole`, `fullname`, `lastname`, `firstname`) VALUES
(1, 'admin', 'admin', 1, 1, 'admin, admin', 'admin', 'admin'),
(7, '053961', 'test@2024', 1, 2, 'test, test', 'test', 'test'),
(8, 'tet', 'tet@2024', 1, 2, 'tet, tetris', 'tet', 'tetris');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `classschedule`
--
ALTER TABLE `classschedule`
  ADD PRIMARY KEY (`classID`);

--
-- Indexes for table `days`
--
ALTER TABLE `days`
  ADD PRIMARY KEY (`dayID`);

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
-- Indexes for table `fileattachments`
--
ALTER TABLE `fileattachments`
  ADD PRIMARY KEY (`fileID`);

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
-- Indexes for table `sections`
--
ALTER TABLE `sections`
  ADD PRIMARY KEY (`sectionID`);

--
-- Indexes for table `semester`
--
ALTER TABLE `semester`
  ADD PRIMARY KEY (`semesterID`);

--
-- Indexes for table `strands`
--
ALTER TABLE `strands`
  ADD PRIMARY KEY (`strandID`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`tempID`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`subjectID`);

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
-- AUTO_INCREMENT for table `classschedule`
--
ALTER TABLE `classschedule`
  MODIFY `classID` int(254) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `days`
--
ALTER TABLE `days`
  MODIFY `dayID` int(254) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `enrollmentrecords`
--
ALTER TABLE `enrollmentrecords`
  MODIFY `enrollmentID` int(254) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `enrollmentstatus`
--
ALTER TABLE `enrollmentstatus`
  MODIFY `statusID` int(254) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `fileattachments`
--
ALTER TABLE `fileattachments`
  MODIFY `fileID` int(254) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `interests`
--
ALTER TABLE `interests`
  MODIFY `interestID` int(254) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

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
-- AUTO_INCREMENT for table `sections`
--
ALTER TABLE `sections`
  MODIFY `sectionID` int(254) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `semester`
--
ALTER TABLE `semester`
  MODIFY `semesterID` int(254) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `strands`
--
ALTER TABLE `strands`
  MODIFY `strandID` int(254) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `tempID` int(254) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `subjectID` int(254) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
