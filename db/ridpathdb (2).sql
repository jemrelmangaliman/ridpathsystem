-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 13, 2024 at 04:00 PM
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
-- Table structure for table `classschedule`
--

CREATE TABLE `classschedule` (
  `classID` int(254) NOT NULL,
  `sectionID` int(254) NOT NULL,
  `strandSubjectID` int(254) NOT NULL,
  `schoolYearID` int(254) NOT NULL,
  `dayID` int(254) NOT NULL,
  `formattedstartdate` varchar(50) NOT NULL,
  `formattedenddate` varchar(50) NOT NULL,
  `starttime` varchar(254) NOT NULL,
  `endtime` varchar(254) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `classschedule`
--

INSERT INTO `classschedule` (`classID`, `sectionID`, `strandSubjectID`, `schoolYearID`, `dayID`, `formattedstartdate`, `formattedenddate`, `starttime`, `endtime`) VALUES
(5, 5, 5, 4, 5, '2024-08-01T00:00:00', '2025-05-31T23:59:59', '09:48', '10:50'),
(6, 5, 5, 4, 1, '2024-08-01T00:00:00', '2025-05-31T23:59:59', '14:02', '15:02'),
(7, 6, 3, 4, 1, '2024-08-01T00:00:00', '2025-05-31T23:59:59', '14:02', '16:05');

-- --------------------------------------------------------

--
-- Table structure for table `days`
--

CREATE TABLE `days` (
  `dayID` int(254) NOT NULL,
  `dayname` varchar(254) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  `enrollmentStatusID` int(254) NOT NULL,
  `studentTypeID` int(10) NOT NULL,
  `schoolYearID` int(254) NOT NULL,
  `transactionID` int(254) NOT NULL,
  `gradelevel` varchar(5) NOT NULL,
  `interest` varchar(254) NOT NULL,
  `enrollmentremarks` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `enrollmentrecords`
--

INSERT INTO `enrollmentrecords` (`enrollmentID`, `studentID`, `strandID`, `enrollmentStatusID`, `studentTypeID`, `schoolYearID`, `transactionID`, `gradelevel`, `interest`, `enrollmentremarks`) VALUES
(22, 1, 4, 6, 2, 4, 11, '12', 'Computers', 'You are now enrolled to Grade 12 - Section Crocs'),
(23, 3, 4, 6, 1, 4, 12, '12', 'Technology', 'Admission confirmed. You are added the STEM 12 - Kalibo');

-- --------------------------------------------------------

--
-- Table structure for table `enrollmentstatus`
--

CREATE TABLE `enrollmentstatus` (
  `statusID` int(254) NOT NULL,
  `statusname` varchar(254) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `enrollmentstatus`
--

INSERT INTO `enrollmentstatus` (`statusID`, `statusname`) VALUES
(1, 'Not Enrolled'),
(2, 'Pending Enrollment Assessment'),
(3, 'For Resubmit'),
(4, 'Pending Balance Settlement'),
(5, 'Awaiting Admission Confirmation'),
(6, 'Enrolled'),
(7, 'On Hold');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `fileattachments`
--

INSERT INTO `fileattachments` (`fileID`, `tempID`, `enrollmentID`, `filename`, `attachmentname`, `attachmenturl`) VALUES
(41, 1, 22, '22-psa.txt', 'psa', '../enrollment-files/22-psa.txt'),
(42, 1, 22, '22-enrollmentform.txt', 'enrollmentform', '../enrollment-files/22-enrollmentform.txt'),
(43, 3, 23, '23-psa.txt', 'psa', '../enrollment-files/23-psa.txt'),
(44, 3, 23, '23-enrollmentform.txt', 'enrollmentform', '../enrollment-files/23-enrollmentform.txt');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `miscellaneousfees`
--

INSERT INTO `miscellaneousfees` (`miscID`, `strandID`, `description`, `amount`) VALUES
(4, 4, 'Laboratory', 235),
(5, 4, 'Books', 1500),
(6, 5, 'Misc', 1000),
(7, 5, 'Symposium Fee', 500),
(8, 7, 'ComLab Fee', 1000),
(9, 7, 'Network Tools', 1000),
(10, 6, 'Misc', 1000);

-- --------------------------------------------------------

--
-- Table structure for table `paymentmodes`
--

CREATE TABLE `paymentmodes` (
  `paymentModeID` int(254) NOT NULL,
  `description` varchar(254) NOT NULL,
  `paymenttype` varchar(20) NOT NULL,
  `qrimgurl` varchar(500) NOT NULL,
  `accountnumber` varchar(50) NOT NULL,
  `isactive` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `paymentmodes`
--

INSERT INTO `paymentmodes` (`paymentModeID`, `description`, `paymenttype`, `qrimgurl`, `accountnumber`, `isactive`) VALUES
(5, 'GCash With Sample QR', 'Online', '../payment-qr/GCash With Sample QR.png', '2323', 'Yes'),
(6, 'MAYA with Sample QR', 'Online', '../payment-qr/MAYA with Sample QR.png', '23', 'Yes'),
(7, 'Cash Payment', 'Offline', '', '', 'Yes'),
(8, 'GoTyme with Sample QR', 'Online', '../payment-qr/GoTyme with Sample QR.png', '', 'Yes'),
(9, 'Sample Payment Option', 'Offline', '', '', 'Yes'),
(10, 'test offline payment', 'Online', '../payment-qr/test offline payment.png', '0987654321', 'Yes'),
(11, 'asdas', 'Online', '../payment-qr/asdas.jpg', '324343', 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `paymentrecord`
--

CREATE TABLE `paymentrecord` (
  `transactionID` int(254) NOT NULL,
  `enrollmentID` int(254) NOT NULL,
  `paymentModeID` int(254) NOT NULL,
  `amount` int(254) NOT NULL,
  `proofimgurl` varchar(254) NOT NULL,
  `paymentremarks` varchar(300) NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `paymentrecord`
--

INSERT INTO `paymentrecord` (`transactionID`, `enrollmentID`, `paymentModeID`, `amount`, `proofimgurl`, `paymentremarks`, `status`) VALUES
(11, 22, 5, 12235, '../paymentproofs/22-paymentproof.jpg', 'reference ID: anrjglkdjrnqwlk3h12`4u230ujed241bkjghf', ''),
(12, 23, 6, 12235, '../paymentproofs/23-paymentproof.jpg', 'Reference number: 3fhiqw41vm5u9823uv242bbtgfurt2', '');

-- --------------------------------------------------------

--
-- Table structure for table `schoolyear`
--

CREATE TABLE `schoolyear` (
  `schoolYearID` int(254) NOT NULL,
  `schoolyearname` varchar(254) NOT NULL,
  `isactive` varchar(20) NOT NULL,
  `startdate` varchar(254) NOT NULL,
  `enddate` varchar(254) NOT NULL,
  `formattedstartdate` varchar(254) NOT NULL,
  `formattedenddate` varchar(254) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `schoolyear`
--

INSERT INTO `schoolyear` (`schoolYearID`, `schoolyearname`, `isactive`, `startdate`, `enddate`, `formattedstartdate`, `formattedenddate`) VALUES
(4, 'S.Y. 2024-2025', 'Yes', '2024-08-01', '2025-05-31', '2024-08-01T00:00:00', '2025-05-31T23:59:59'),
(5, 'S.Y. 2025-2026', 'No', '2025-01-01', '2026-05-31', '2025-01-01T00:00:00', '2026-05-31T23:59:59'),
(6, 'tewtew', 'No', '2024-10-01', '2024-10-31', '2024-10-01T00:00:00', '2024-10-31T23:59:59');

-- --------------------------------------------------------

--
-- Table structure for table `sections`
--

CREATE TABLE `sections` (
  `sectionID` int(254) NOT NULL,
  `strandID` int(254) NOT NULL,
  `gradelevel` varchar(5) NOT NULL,
  `sectionname` varchar(254) NOT NULL,
  `defaultslots` int(20) NOT NULL,
  `currentavailableslot` int(20) NOT NULL,
  `isactive` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sections`
--

INSERT INTO `sections` (`sectionID`, `strandID`, `gradelevel`, `sectionname`, `defaultslots`, `currentavailableslot`, `isactive`) VALUES
(1, 4, '11', 'Anahaw', 40, 40, 'Yes'),
(4, 4, '11', 'Narra', 40, 40, 'Yes'),
(5, 7, '11', 'Abanico', 40, 40, 'Yes'),
(6, 6, '11', 'Rosewood', 40, 40, 'Yes'),
(7, 6, '12', 'Bonifacio', 40, 40, 'Yes'),
(8, 6, '12', 'Rizal', 40, 40, 'Yes'),
(9, 7, '12', 'Molave', 40, 40, 'Yes'),
(10, 4, '12', 'Crocs', 40, 40, 'Yes'),
(11, 4, '12', 'Kalibo', 40, 37, 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `sectionstudentlist`
--

CREATE TABLE `sectionstudentlist` (
  `listItemID` int(254) NOT NULL,
  `sectionID` int(254) NOT NULL,
  `studentID` int(254) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sectionstudentlist`
--

INSERT INTO `sectionstudentlist` (`listItemID`, `sectionID`, `studentID`) VALUES
(4, 11, 1),
(5, 11, 3);

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
-- Table structure for table `strandsubjects`
--

CREATE TABLE `strandsubjects` (
  `strandSubjectID` int(254) NOT NULL,
  `strandID` int(254) NOT NULL,
  `subjectID` int(254) NOT NULL,
  `schoolYearID` int(254) NOT NULL,
  `gradelevel` varchar(5) NOT NULL,
  `isactive` varchar(254) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `strandsubjects`
--

INSERT INTO `strandsubjects` (`strandSubjectID`, `strandID`, `subjectID`, `schoolYearID`, `gradelevel`, `isactive`) VALUES
(2, 5, 2, 4, '11', 'Yes'),
(3, 6, 1, 4, '11', 'Yes'),
(4, 7, 3, 4, '11', 'Yes'),
(5, 7, 4, 4, '11', 'Yes'),
(6, 7, 5, 5, '11', 'Yes'),
(7, 4, 7, 4, '11', 'Yes'),
(8, 4, 6, 5, '11', 'Yes'),
(9, 4, 8, 4, '12', 'Yes'),
(10, 4, 9, 4, '11', 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `tempID` int(254) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `middlename` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `birthday` varchar(20) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `address` varchar(500) NOT NULL,
  `email` varchar(100) NOT NULL,
  `contactnumber` varchar(100) NOT NULL,
  `studentnumber` varchar(100) NOT NULL,
  `password` varchar(254) NOT NULL,
  `userRole` int(10) NOT NULL,
  `isassignedtosection` int(2) NOT NULL DEFAULT 0,
  `isactive` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`tempID`, `firstname`, `middlename`, `lastname`, `birthday`, `gender`, `address`, `email`, `contactnumber`, `studentnumber`, `password`, `userRole`, `isassignedtosection`, `isactive`) VALUES
(1, 'John', 'Titor', 'Smith', '2024-10-07', 'Male', 'Pulo, Cabuyao, Laguna, Philippines, Earth, Milky Way Galaxy', 'johnsmith@gmail.com', '09123456789', '201810517', 'password', 4, 0, ''),
(2, 'Erik', 'Smith', 'Titor', '', '', '', 'eriktitor@gmail.com', '09123456789', '', 'password', 4, 0, ''),
(3, 'Walter', 'Hartwell', 'White', '2024-10-07', 'Male', 'Test', 'walterwhite@gmail.com', '01234567890', '', 'password', 4, 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `studenttype`
--

CREATE TABLE `studenttype` (
  `studentTypeID` int(10) NOT NULL,
  `studenttypedescription` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `studenttype`
--

INSERT INTO `studenttype` (`studentTypeID`, `studenttypedescription`) VALUES
(1, 'New Student'),
(2, 'Old Student'),
(3, 'Transferee');

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `subjectID` int(254) NOT NULL,
  `pr_subjectID` int(254) NOT NULL,
  `subjectname` varchar(254) NOT NULL,
  `isactive` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`subjectID`, `pr_subjectID`, `subjectname`, `isactive`) VALUES
(1, 3, 'Gen Math', 'Yes'),
(2, 0, 'Earth and Life Science', 'Yes'),
(3, 0, 'Media Information Literacy', 'Yes'),
(4, 0, 'Computer Programming 1', 'Yes'),
(5, 4, 'Computer Programming 2', 'Yes'),
(6, 7, 'Basic Calculus', 'Yes'),
(7, 0, 'Pre-Calculus', 'Yes'),
(8, 0, 'Discrete Mathematics', 'Yes'),
(9, 0, 'Physical Fitness 1', 'Yes'),
(10, 9, 'Physical Fitness 2', 'Yes');

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
(1, 4, 10500),
(2, 5, 9000),
(3, 7, 10000),
(4, 6, 7000);

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
(7, '053961', 'test@2024', 1, 2, 'test, test', 'test', 'test'),
(8, 'tet', 'tet@2024', 1, 2, 'tet, tetris', 'tet', 'tetris'),
(9, 'Registrar', 'Regie@2024', 1, 2, 'Regie, Strar', 'Regie', 'Strar');

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
-- Indexes for table `schoolyear`
--
ALTER TABLE `schoolyear`
  ADD PRIMARY KEY (`schoolYearID`);

--
-- Indexes for table `sections`
--
ALTER TABLE `sections`
  ADD PRIMARY KEY (`sectionID`);

--
-- Indexes for table `sectionstudentlist`
--
ALTER TABLE `sectionstudentlist`
  ADD PRIMARY KEY (`listItemID`);

--
-- Indexes for table `strands`
--
ALTER TABLE `strands`
  ADD PRIMARY KEY (`strandID`);

--
-- Indexes for table `strandsubjects`
--
ALTER TABLE `strandsubjects`
  ADD PRIMARY KEY (`strandSubjectID`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`tempID`);

--
-- Indexes for table `studenttype`
--
ALTER TABLE `studenttype`
  ADD PRIMARY KEY (`studentTypeID`);

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
  MODIFY `classID` int(254) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `days`
--
ALTER TABLE `days`
  MODIFY `dayID` int(254) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `enrollmentrecords`
--
ALTER TABLE `enrollmentrecords`
  MODIFY `enrollmentID` int(254) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `enrollmentstatus`
--
ALTER TABLE `enrollmentstatus`
  MODIFY `statusID` int(254) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `fileattachments`
--
ALTER TABLE `fileattachments`
  MODIFY `fileID` int(254) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `interests`
--
ALTER TABLE `interests`
  MODIFY `interestID` int(254) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `miscellaneousfees`
--
ALTER TABLE `miscellaneousfees`
  MODIFY `miscID` int(254) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `paymentmodes`
--
ALTER TABLE `paymentmodes`
  MODIFY `paymentModeID` int(254) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `paymentrecord`
--
ALTER TABLE `paymentrecord`
  MODIFY `transactionID` int(254) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `schoolyear`
--
ALTER TABLE `schoolyear`
  MODIFY `schoolYearID` int(254) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `sections`
--
ALTER TABLE `sections`
  MODIFY `sectionID` int(254) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `sectionstudentlist`
--
ALTER TABLE `sectionstudentlist`
  MODIFY `listItemID` int(254) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `strands`
--
ALTER TABLE `strands`
  MODIFY `strandID` int(254) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `strandsubjects`
--
ALTER TABLE `strandsubjects`
  MODIFY `strandSubjectID` int(254) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `tempID` int(254) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `studenttype`
--
ALTER TABLE `studenttype`
  MODIFY `studentTypeID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `subjectID` int(254) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tuitionfees`
--
ALTER TABLE `tuitionfees`
  MODIFY `tuitionID` int(254) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
