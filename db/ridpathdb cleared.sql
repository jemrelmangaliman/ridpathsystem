-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 17, 2024 at 02:41 PM
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
(7, 6, 3, 4, 1, '2024-08-01T00:00:00', '2025-05-31T23:59:59', '14:02', '16:05'),
(10, 11, 8, 4, 1, '2024-08-01T00:00:00', '2025-05-31T23:59:59', '18:44', '19:44'),
(11, 11, 9, 4, 1, '2024-08-01T00:00:00', '2025-05-31T23:59:59', '15:44', '16:44'),
(12, 11, 7, 4, 3, '2024-08-01T00:00:00', '2025-05-31T23:59:59', '08:48', '09:48');

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
  `enrollmentremarks` varchar(500) NOT NULL,
  `admissiondate` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
(7, 'On Hold'),
(8, 'Cancelled'),
(9, 'Completed');

-- --------------------------------------------------------

--
-- Table structure for table `examcategory`
--

CREATE TABLE `examcategory` (
  `examCategoryID` int(254) NOT NULL,
  `strandID` int(254) NOT NULL,
  `categoryname` varchar(254) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `examcategory`
--

INSERT INTO `examcategory` (`examCategoryID`, `strandID`, `categoryname`) VALUES
(1, 4, 'Mathematics'),
(2, 7, 'Computer Systems'),
(3, 6, 'Social Sciences'),
(4, 5, 'Psychology'),
(5, 8, 'Home Economics');

-- --------------------------------------------------------

--
-- Table structure for table `examchoices`
--

CREATE TABLE `examchoices` (
  `choiceID` int(254) NOT NULL,
  `questionID` int(254) NOT NULL,
  `choicedescription` varchar(254) NOT NULL,
  `iscorrect` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `examchoices`
--

INSERT INTO `examchoices` (`choiceID`, `questionID`, `choicedescription`, `iscorrect`) VALUES
(76, 26, 'A) x=2x = 2x=2', 0),
(77, 26, 'B) x=4x = 4x=4', 1),
(78, 26, 'C) x=6x = 6x=6', 0),
(79, 26, 'D) x=8x = 8x=8', 0),
(84, 28, 'A) 12x3y312x^3y^312x3y3', 1),
(85, 28, 'B) 7x3y37x^3y^37x3y3', 0),
(86, 28, 'C) 12x2y212x^2y^212x2y2', 0),
(87, 28, 'D) 7x2y37x^2y^37x2y3', 0),
(88, 29, 'A) 8', 0),
(89, 29, 'B) 10', 0),
(90, 29, 'C) 12', 0),
(91, 29, 'D) 13', 1),
(92, 30, 'A) 2, 3', 1),
(93, 30, 'B) -2, 3', 0),
(94, 30, 'C) -3, -2', 0),
(95, 30, 'D) 5, 6', 0),
(96, 31, 'A) -3', 1),
(97, 31, 'B) 3', 0),
(98, 31, 'C) 4', 0),
(99, 31, 'D) -4', 0),
(100, 32, 'A) 2x2x2x', 1),
(101, 32, 'B) xxx', 0),
(102, 32, 'C) x2x^2x2', 0),
(103, 32, 'D) 3x3x3x', 0),
(104, 33, 'A) x3x^3x3', 0),
(105, 33, 'B) x3+Cx^3 + Cx3+C', 1),
(106, 33, 'C) x2+Cx^2 + Cx2+C', 0),
(107, 33, 'D) 3x3+C3x^3 + C3x3+C', 0),
(108, 34, 'A) 3x2+23x^2 + 23x2+2', 1),
(109, 34, 'B) 3x+23x + 23x+2', 0),
(110, 34, 'C) x3+2x^3 + 2x3+2', 0),
(111, 34, 'D) 2x3+12x^3 + 12x3+1', 0),
(112, 35, 'A) 4', 0),
(113, 35, 'B) 8', 0),
(114, 35, 'C) 12', 0),
(115, 35, 'D) 16', 1),
(116, 36, 'A) -1', 0),
(117, 36, 'B) 1', 1),
(118, 36, 'C) 2', 0),
(119, 36, 'D) 3', 0),
(120, 37, 'A) 16\\frac{1}{6}61', 0),
(121, 37, 'B) 15\\frac{1}{5}51', 1),
(122, 37, 'C) 14\\frac{1}{4}41', 0),
(123, 37, 'D) 13\\frac{1}{3}31', 0),
(124, 38, 'A) 0.2', 0),
(125, 38, 'B) 0.3', 0),
(126, 38, 'C) 0.4', 1),
(127, 38, 'D) 0.5', 0),
(128, 39, 'A) 5', 0),
(129, 39, 'B) 6', 0),
(130, 39, 'C) 7', 0),
(131, 39, 'D) 8', 1),
(132, 40, 'A) 14\\frac{1}{4}41', 1),
(133, 40, 'B) 12\\frac{1}{2}21', 0),
(134, 40, 'C) 34\\frac{3}{4}43', 0),
(135, 40, 'D) 13\\frac{1}{3}31', 0),
(136, 41, 'A) 4', 0),
(137, 41, 'B) 6', 0),
(138, 41, 'C) 8', 1),
(139, 41, 'D) 10', 0),
(140, 42, 'A) Understanding animals\' behavior', 0),
(141, 42, 'B) Understanding human behavior and mental processes', 1),
(142, 42, 'C) Analyzing historical events', 0),
(143, 42, 'D) Studying ancient civilizations', 0),
(144, 43, 'A) Cognitive psychology', 0),
(145, 43, 'B) Developmental psychology', 0),
(146, 43, 'C) Biological psychology', 1),
(147, 43, 'D) Social psychology', 0),
(148, 44, 'A) Behaviorism', 0),
(149, 44, 'B) Humanism', 0),
(150, 44, 'C) Psychoanalysis', 1),
(151, 44, 'D) Cognitive theory', 0),
(152, 45, 'A) Ignoring undesirable behavior', 0),
(153, 45, 'B) Taking away a privilege for bad behavior', 0),
(154, 45, 'C) Giving a reward after a desirable behavior', 1),
(155, 45, 'D) Scolding a child for misbehavior', 0),
(156, 46, 'A) The discomfort felt when holding two conflicting beliefs', 1),
(157, 46, 'B) The process of learning through association', 0),
(158, 46, 'C) The psychological phenomenon of social comparison', 0),
(159, 46, 'D) The feeling of satisfaction after achieving a goal', 0),
(160, 47, 'A) Carl Rogers', 0),
(161, 47, 'B) Ivan Pavlov', 1),
(162, 47, 'C) B.F. Skinner', 0),
(163, 47, 'D) Abraham Maslow', 0),
(164, 48, 'A) Understanding mental illnesses', 0),
(165, 48, 'B) How individuals are influenced by others', 1),
(166, 48, 'C) The study of unconscious motives', 0),
(167, 48, 'D) Cognitive development in children', 0),
(168, 49, 'A) People are motivated by material needs', 0),
(169, 49, 'B) People are motivated by a series of needs that must be met in order of priority', 1),
(170, 49, 'C) People’s needs can be ranked by social importance', 0),
(171, 49, 'D) Needs are subjective and do not follow a specific order', 0),
(172, 50, 'A) Cognitive perspective', 0),
(173, 50, 'B) Humanistic perspective', 0),
(174, 50, 'C) Psychoanalytic perspective', 1),
(175, 50, 'D) Behavioral perspective', 0),
(176, 51, 'A) Receiving a paycheck for work performed', 1),
(177, 51, 'B) Enjoying the work you do', 0),
(178, 51, 'C) Feeling satisfied with the task completed', 0),
(179, 51, 'D) Being passionate about your job', 0),
(180, 52, 'A) Cerebellum', 0),
(181, 52, 'B) Hippocampus', 0),
(182, 52, 'C) Medulla oblongata', 1),
(183, 52, 'D) Amygdala', 0),
(184, 53, 'A) James-Lange theory', 1),
(185, 53, 'B) Cannon-Bard theory', 0),
(186, 53, 'C) Schachter-Singer theory', 0),
(187, 53, 'D) Lazarus theory', 0),
(188, 54, 'A) Cognitive rigidity', 0),
(189, 54, 'B) Cognitive dissonance', 0),
(190, 54, 'C) Cognitive flexibility', 1),
(191, 54, 'D) Cognitive impairment', 0),
(192, 55, 'A) Bipolar disorder', 0),
(193, 55, 'B) Phobia', 1),
(194, 55, 'C) Schizophrenia', 0),
(195, 55, 'D) Depression', 0),
(196, 56, 'A) Stereotyping', 0),
(197, 56, 'B) In-group bias', 1),
(198, 56, 'C) Prejudice', 0),
(199, 56, 'D) Out-group bias', 0),
(200, 57, 'A) A single-party system', 0),
(201, 57, 'B) Citizens are given the right to vote', 1),
(202, 57, 'C) No political parties exist', 0),
(203, 57, 'D) Government control over media', 0),
(204, 58, 'A) To study the physical environment', 0),
(205, 58, 'B) To understand human behavior in society', 1),
(206, 58, 'C) To examine the history of civilizations', 0),
(207, 58, 'D) To explore the genetic basis of behavior', 0),
(208, 59, 'A) The right to own private property', 0),
(209, 59, 'B) The right to free speech', 1),
(210, 59, 'C) The right to mandatory military service', 0),
(211, 59, 'D) The right to be taxed', 0),
(212, 60, 'A) The ability of a person to change social status', 1),
(213, 60, 'B) The movement of people from one country to another', 0),
(214, 60, 'C) The speed at which a society evolves', 0),
(215, 60, 'D) The movement of goods and services in the economy', 0),
(216, 61, 'A) Plato', 0),
(217, 61, 'B) Aristotle', 0),
(218, 61, 'C) John Locke', 1),
(219, 61, 'D) Karl Marx', 0),
(220, 62, 'A) A local tradition that remains unchanged for centuries', 0),
(221, 62, 'B) The spread of fast food chains worldwide', 1),
(222, 62, 'C) An individual’s choice to dress according to traditional fashion', 0),
(223, 62, 'D) The practice of following a specific family ritual', 0),
(224, 63, 'A) To enforce laws and maintain order', 1),
(225, 63, 'B) To provide free healthcare for all citizens', 0),
(226, 63, 'C) To promote economic growth through trade', 0),
(227, 63, 'D) To control all aspects of an individual’s life', 0),
(228, 64, 'A) The separation of nations into distinct territories', 0),
(229, 64, 'B) The integration of different cultures and economies worldwide', 1),
(230, 64, 'C) The preservation of traditional cultures and economies', 0),
(231, 64, 'D) The implementation of a single global government', 0),
(232, 65, 'A) Social structure', 0),
(233, 65, 'B) Culture', 1),
(234, 65, 'C) Social mobility', 0),
(235, 65, 'D) Feudalism', 0),
(236, 66, 'A) Socialism', 0),
(237, 66, 'B) Communism', 0),
(238, 66, 'C) Capitalism', 1),
(239, 66, 'D) Feudalism', 0),
(240, 67, 'A) Laws that are applied only to the wealthy', 0),
(241, 67, 'B) Laws that ensure political leaders can do as they wish', 0),
(242, 67, 'C) The principle that all individuals and institutions are accountable to the law', 1),
(243, 67, 'D) Laws that are designed to benefit a specific group of people', 0),
(244, 68, 'A) The family', 1),
(245, 68, 'B) The educational system', 0),
(246, 68, 'C) The legal system', 0),
(247, 68, 'D) The economy', 0),
(248, 69, 'A) The structure of government institutions', 0),
(249, 69, 'B) The distribution of resources and goods', 1),
(250, 69, 'C) The creation of laws and policies', 0),
(251, 69, 'D) The analysis of historical events', 0),
(252, 70, 'A) The rights to own property and business', 0),
(253, 70, 'B) The rights granted to individuals by the state to ensure equality and justice', 1),
(254, 70, 'C) The rights of government officials to govern freely', 0),
(255, 70, 'D) The rights to engage in military service', 0),
(256, 71, 'A) Sigmund Freud', 0),
(257, 71, 'B) Max Weber', 0),
(258, 71, 'C) Karl Marx', 1),
(259, 71, 'D) Emile Durkheim', 0),
(260, 72, 'A) Store data', 0),
(261, 72, 'B) Process instructions', 1),
(262, 72, 'C) Display graphics', 0),
(263, 72, 'D) Print documents', 0),
(264, 73, 'A) Keyboard', 0),
(265, 73, 'B) Mouse', 0),
(266, 73, 'C) Monitor', 1),
(267, 73, 'D) Flash drive', 0),
(268, 74, 'A) RAM', 0),
(269, 74, 'B) Motherboard', 1),
(270, 74, 'C) Hard drive', 0),
(271, 74, 'D) CPU', 0),
(272, 75, 'A) Random Allocation Memory', 0),
(273, 75, 'B) Read Access Memory', 0),
(274, 75, 'C) Random Access Memory', 1),
(275, 75, 'D) Read Allocation Memory', 0),
(276, 76, 'A) Utility software', 0),
(277, 76, 'B) Application software', 0),
(278, 76, 'C) Operating system', 1),
(279, 76, 'D) Driver software', 0),
(280, 77, 'A) Hardware', 0),
(281, 77, 'B) Malware', 1),
(282, 77, 'C) Operating system', 0),
(283, 77, 'D) Software update', 0),
(284, 78, 'A) VGA cable', 0),
(285, 78, 'B) USB port', 0),
(286, 78, 'C) LAN cable', 1),
(287, 78, 'D) HDMI cable', 0),
(288, 79, 'A) Store files', 0),
(289, 79, 'B) Backup data', 0),
(290, 79, 'C) Protect against unauthorized access', 1),
(291, 79, 'D) Enhance screen brightness', 0),
(292, 80, 'A) ping', 0),
(293, 80, 'B) ipconfig', 1),
(294, 80, 'C) tracert', 0),
(295, 80, 'D) nslookup', 0),
(296, 81, 'A) HDMI', 0),
(297, 81, 'B) VGA', 0),
(298, 81, 'C) USB', 1),
(299, 81, 'D) Ethernet', 0),
(300, 82, 'A) 650 MB', 0),
(301, 82, 'B) 700 MB', 1),
(302, 82, 'C) 4.7 GB', 0),
(303, 82, 'D)8.5 GB', 0),
(304, 83, 'A) RAM', 0),
(305, 83, 'B) Hard disk', 1),
(306, 83, 'C) Cache', 0),
(307, 83, 'D) Registers', 0),
(308, 84, 'A) Soldering iron', 0),
(309, 84, 'B) Crimping tool', 1),
(310, 84, 'C) Multimeter', 0),
(311, 84, 'D) Screwdriver', 0),
(312, 85, 'A) Local Area Network', 1),
(313, 85, 'B) Long Access Network', 0),
(314, 85, 'C) Linked Access Node', 0),
(315, 85, 'D) Line Allocation Network', 0),
(316, 86, 'A) Restarting', 0),
(317, 86, 'B) Logging out', 0),
(318, 86, 'C) Shutting down', 1),
(319, 86, 'D) Sleeping', 0),
(320, 87, 'A) Carry it pointing up', 0),
(321, 87, 'B) Hold it by the blade', 0),
(322, 87, 'C) Hold it by the handle', 1),
(323, 87, 'D) Carry it in your pocket', 0),
(324, 88, 'A) Cleaning the kitchen', 0),
(325, 88, 'B) Preparing ingredients before cooking', 1),
(326, 88, 'C) Setting the table', 0),
(327, 88, 'D) Serving food', 0),
(328, 89, 'A) Boiling', 0),
(329, 89, 'B) Steaming', 0),
(330, 89, 'C) Frying', 1),
(331, 89, 'D) Poaching', 0),
(332, 90, 'A) Sweeten the dough', 0),
(333, 90, 'B) Act as a preservative', 0),
(334, 90, 'C) Leaven the dough', 1),
(335, 90, 'D) Provide color', 0),
(336, 91, 'A) Freezer', 0),
(337, 91, 'B) Pantry', 0),
(338, 91, 'C) Refrigerator', 1),
(339, 91, 'D) Oven', 0),
(340, 92, 'A) Vitamin A', 0),
(341, 92, 'B) Vitamin B', 0),
(342, 92, 'C) Vitamin C', 1),
(343, 92, 'D) Vitamin D', 0),
(344, 93, 'A) Wash your hands after handling raw meat', 1),
(345, 93, 'B) Use the same cutting board for all foods', 0),
(346, 93, 'C) Leave leftovers on the counter overnight', 0),
(347, 93, 'D) Store raw meat above ready-to-eat foods', 0),
(348, 94, 'A) Use water', 0),
(349, 94, 'B) Cover with a lid', 1),
(350, 94, 'C) Use a towel', 0),
(351, 94, 'D) Blow on it', 0),
(352, 95, 'A) To the right of the plate', 0),
(353, 95, 'B) Above the plate', 0),
(354, 95, 'C) To the left of the plate', 1),
(355, 95, 'D) Under the napkin', 0),
(356, 96, 'A) Grater', 0),
(357, 96, 'B) Peeler', 1),
(358, 96, 'C) Knife', 0),
(359, 96, 'D) Whisk', 0),
(360, 97, 'A) 200°F', 0),
(361, 97, 'B) 325°F', 0),
(362, 97, 'C) 375°F', 1),
(363, 97, 'D) 425°F', 0),
(364, 98, 'A) Sugar and water', 0),
(365, 98, 'B) Butter and flour', 1),
(366, 98, 'C) Salt and oil', 0),
(367, 98, 'D) Vinegar and spices', 0),
(368, 99, 'A) Scaling', 1),
(369, 99, 'B) Peeling', 0),
(370, 99, 'C) Filleting', 0),
(371, 99, 'D) Gutting', 0),
(372, 100, 'A) To cook them completely', 0),
(373, 100, 'B) To enhance color and reduce cooking time', 1),
(374, 100, 'C) To season them', 0),
(375, 100, 'D) To dehydrate them', 0),
(376, 101, 'A) Baking soda', 0),
(377, 101, 'B) Bleach', 0),
(378, 101, 'C) Vinegar', 0),
(379, 101, 'D) Dishwashing liquid', 1);

-- --------------------------------------------------------

--
-- Table structure for table `examquestions`
--

CREATE TABLE `examquestions` (
  `questionID` int(254) NOT NULL,
  `examCategoryID` int(254) NOT NULL,
  `question` varchar(500) NOT NULL,
  `correctChoiceID` int(254) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `examquestions`
--

INSERT INTO `examquestions` (`questionID`, `examCategoryID`, `question`, `correctChoiceID`) VALUES
(26, 1, '1. Solve for xxx: 5x−3=2x+95x - 3 = 2x + 95x−3=2x+9', 77),
(28, 1, '2. Simplify: (3x2y)(4xy2)(3x^2y)(4xy^2)(3x2y)(4xy2)', 84),
(29, 1, '3. If f(x)=2x+3f(x) = 2x + 3f(x)=2x+3, find f(5)f(5)f(5):', 91),
(30, 1, '4. Solve for xxx: x2−5x+6=0x^2 - 5x + 6 = 0x2−5x+6=0', 92),
(31, 1, '5. The sum of the roots of the equation x2+3x−4=0x^2 + 3x - 4 = 0x2+3x−4=0 is:', 96),
(32, 1, '6. If f(x)=x2f(x) = x^2f(x)=x2, the derivative f′(x)f\'(x)f′(x) is:', 100),
(33, 1, '7. The integral of 3x23x^23x2 with respect to xxx is:', 105),
(34, 1, '8. If y=x3+2xy = x^3 + 2xy=x3+2x, find dy/dxdy/dxdy/dx:', 108),
(35, 1, '9. The area under y=4xy = 4xy=4x from x=0x = 0x=0 to x=2x = 2x=2 is:', 115),
(36, 1, '10. Find the slope of the tangent line to y=x2−3x+2y = x^2 - 3x + 2y=x2−3x+2 at x=1x = 1x=1:', 117),
(37, 1, '11. If a die is rolled, what is the probability of getting a 5?', 121),
(38, 1, '12. If 60% of students passed a test, what is the probability that a randomly selected student did not pass?', 126),
(39, 1, '13. What is the mean of the data set 2,5,7,10,122, 5, 7, 10, 122,5,7,10,12?', 131),
(40, 1, '14. A card is drawn from a deck of 52 cards. The probability of drawing a spade is:', 132),
(41, 1, '15. The median of the data set 4,6,8,10,124, 6, 8, 10, 124,6,8,10,12 is:', 138),
(42, 4, '1. Which of the following is the primary focus of psychology?', 141),
(43, 4, '2. Which of the following is the study of how the brain and body interact to influence behavior?', 146),
(44, 4, '3. Sigmund Freud is known for developing which psychological theory?', 150),
(45, 4, '4. Which of the following is an example of positive reinforcement?', 154),
(46, 4, '5. What does the term “cognitive dissonance” refer to?', 156),
(47, 4, '6. Which psychologist is known for his work on classical conditioning?', 161),
(48, 4, '7. Which of the following is a major focus of social psychology?', 165),
(49, 4, '8. What is the main idea behind Maslow\'s hierarchy of needs?', 169),
(50, 4, '9. Which psychological perspective emphasizes the importance of unconscious thoughts and early childhood experiences?', 174),
(51, 4, '10. Which of the following is an example of an extrinsic motivator?', 176),
(52, 4, '11. Which part of the brain is responsible for regulating basic life functions such as breathing and heartbeat?', 182),
(53, 4, '12.Which theory suggests that emotions are a result of physiological reactions to stimuli?', 184),
(54, 4, '13. Which of the following refers to the ability to adjust to new information or situations?', 190),
(55, 4, '14. Which psychological disorder is characterized by excessive fear or anxiety in certain situations?', 193),
(56, 4, '15. What is the term for the tendency to favor one’s own group over others?', 197),
(57, 3, '1. Which of the following is a key characteristic of a democratic government?', 201),
(58, 3, '2. What is the main goal of sociology as a field of study?', 205),
(59, 3, '3. Which of the following is a fundamental right guaranteed in the 1987 Philippine Constitution?', 209),
(60, 3, '4. What is the concept of “social mobility”?', 212),
(61, 3, '5. Which philosopher is known for his theory of the \"social contract\"?', 218),
(62, 3, '6. Which of the following is an example of cultural diffusion?', 221),
(63, 3, '7. What is the primary function of government according to political science?', 224),
(64, 3, '8. Which of the following best describes the concept of “globalization”?', 229),
(65, 3, '9 In sociology, which term refers to the set of values, beliefs, and behaviors shared by a group of people?', 233),
(66, 3, '10. Which type of economy is based on private ownership of property and the free market system?', 238),
(67, 3, '11. What is the “rule of law”?', 242),
(68, 3, '12.Which of the following is an example of an informal social institution?', 244),
(69, 3, '13. What is the primary focus of economics as a field of study?', 249),
(70, 3, '14. Which of the following best defines \"civil rights\"?', 253),
(71, 3, '15. The “theory of class struggle” was proposed by which theorist?', 258),
(72, 2, '1. What is the primary function of the CPU in a computer?', 261),
(73, 2, '2. Which of the following is an example of an output device?', 266),
(74, 2, '3. Which part of the computer is responsible for connecting all components together?', 269),
(75, 2, '4. What does RAM stand for?', 274),
(76, 2, '5. Which type of software is used to control the hardware of a computer?', 278),
(77, 2, '6. A computer virus is a type of:', 281),
(78, 2, '7. Which of the following is used to connect a computer to a network?', 286),
(79, 2, '8. What is the purpose of a firewall?', 290),
(80, 2, '9. Which command is used to view the IP address of a computer in the command prompt?', 293),
(81, 2, '10. Which port is commonly used for connecting a printer?', 298),
(82, 2, '11. What is the maximum storage capacity of a standard CD-ROM?', 301),
(83, 2, '12. Which of the following is a non-volatile memory?', 305),
(84, 2, '13. What tool is used to crimp RJ45 connectors onto Ethernet cables?', 309),
(85, 2, '14. In networking, what does LAN stand for?', 312),
(86, 2, '15. The process of turning off a computer properly to prevent damage is called:', 318),
(87, 5, '1. What is the proper way to handle a knife in the kitchen?', 322),
(88, 5, '2. The term \"mise en place\" refers to:', 325),
(89, 5, '3. Which of the following is a dry-heat cooking method?', 330),
(90, 5, '4. The primary function of yeast in baking is to:', 334),
(91, 5, '5. What type of food storage is best for fresh fruits and vegetables?', 338),
(92, 5, '6. Which vitamin is most commonly found in citrus fruits?', 342),
(93, 5, '7. To prevent cross-contamination, you should:', 344),
(94, 5, '8. What is the best way to extinguish a grease fire?', 349),
(95, 5, '9. In table setting, where should the fork be placed?', 354),
(96, 5, '10. Which kitchen tool is used for peeling vegetables?', 357),
(97, 5, '11. The best temperature for baking cookies is around:', 362),
(98, 5, '12. What is the main ingredient in a roux?', 365),
(99, 5, '13. The process of removing scales from fish is called:', 368),
(100, 5, '14. What is the primary purpose of blanching vegetables?', 373),
(101, 5, '15. Which cleaning agent is best for removing grease from kitchen surfaces?', 379);

-- --------------------------------------------------------

--
-- Table structure for table `examrecords`
--

CREATE TABLE `examrecords` (
  `recordID` int(254) NOT NULL,
  `studentID` int(254) NOT NULL,
  `schoolYearID` int(254) NOT NULL,
  `examCategoryID` int(254) NOT NULL,
  `questionID` int(254) NOT NULL,
  `iscorrect` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `examscores`
--

CREATE TABLE `examscores` (
  `scoreID` int(254) NOT NULL,
  `studentID` int(254) NOT NULL,
  `schoolYearID` int(254) NOT NULL,
  `examCategoryID` int(254) NOT NULL,
  `score` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
(10, 6, 'Misc', 1000),
(11, 6, 'Seminar Fee', 500);

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
(11, 4, '12', 'Kalibo', 40, 40, 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `sectionstudentlist`
--

CREATE TABLE `sectionstudentlist` (
  `listItemID` int(254) NOT NULL,
  `sectionID` int(254) NOT NULL,
  `studentID` int(254) NOT NULL
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
(7, 'Technical Vocational Livelihood - Computer System Servicing', 'TVL - CSS', 'Yes'),
(8, 'Technical Vocational Livelihood - Cookery, Housekeeping, and Household Services', 'TVL - CHHS', 'Yes');

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
(10, 4, 9, 4, '11', 'Yes'),
(14, 6, 2, 0, '11', 'Yes'),
(15, 5, 1, 0, '11', 'Yes');

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
  `isactive` varchar(10) NOT NULL,
  `profileimgurl` varchar(400) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`tempID`, `firstname`, `middlename`, `lastname`, `birthday`, `gender`, `address`, `email`, `contactnumber`, `studentnumber`, `password`, `userRole`, `isassignedtosection`, `isactive`, `profileimgurl`) VALUES
(1, 'John', 'Titor', 'Smith', '2008-10-07', 'Male', 'Pulo, Cabuyao, Laguna, Philippines, Earth, Milky Way Galaxy', 'johnsmith@gmail.com', '09123456789', '201810517', 'password', 4, 0, '', ''),
(2, 'Erik', 'Smith', 'Titor', '2007-10-15', 'Male', 'test', 'eriktitor@gmail.com', '09123456789', '', 'password', 4, 0, '', '../userimages/s2.jpg'),
(3, 'Walter', 'Hartwell', 'White', '2009-10-07', 'Female', 'Test', 'walterwhite@gmail.com', '01234567890', '123454321', 'password', 4, 0, '', '');

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
  `firstname` varchar(200) NOT NULL,
  `profileimgurl` varchar(400) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userID`, `username`, `password`, `isActive`, `userRole`, `fullname`, `lastname`, `firstname`, `profileimgurl`) VALUES
(1, 'admin', 'admin', 1, 1, 'admin, admin', 'admin', 'admin', ''),
(7, '053961', 'test@2024', 1, 2, 'test, test', 'test', 'test', ''),
(8, 'tet', 'tet@2024', 1, 2, 'tet, tetris', 'tet', 'tetris', ''),
(9, 'Registrar', 'Regie@2024', 1, 2, 'Regie, Strar', 'Regie', 'Strar', '../userimages/r9.png');

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
-- Indexes for table `examcategory`
--
ALTER TABLE `examcategory`
  ADD PRIMARY KEY (`examCategoryID`);

--
-- Indexes for table `examchoices`
--
ALTER TABLE `examchoices`
  ADD PRIMARY KEY (`choiceID`);

--
-- Indexes for table `examquestions`
--
ALTER TABLE `examquestions`
  ADD PRIMARY KEY (`questionID`);

--
-- Indexes for table `examrecords`
--
ALTER TABLE `examrecords`
  ADD PRIMARY KEY (`recordID`);

--
-- Indexes for table `examscores`
--
ALTER TABLE `examscores`
  ADD PRIMARY KEY (`scoreID`);

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
  MODIFY `classID` int(254) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `days`
--
ALTER TABLE `days`
  MODIFY `dayID` int(254) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `enrollmentrecords`
--
ALTER TABLE `enrollmentrecords`
  MODIFY `enrollmentID` int(254) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `enrollmentstatus`
--
ALTER TABLE `enrollmentstatus`
  MODIFY `statusID` int(254) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `examcategory`
--
ALTER TABLE `examcategory`
  MODIFY `examCategoryID` int(254) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `examchoices`
--
ALTER TABLE `examchoices`
  MODIFY `choiceID` int(254) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=380;

--
-- AUTO_INCREMENT for table `examquestions`
--
ALTER TABLE `examquestions`
  MODIFY `questionID` int(254) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102;

--
-- AUTO_INCREMENT for table `examrecords`
--
ALTER TABLE `examrecords`
  MODIFY `recordID` int(254) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT for table `examscores`
--
ALTER TABLE `examscores`
  MODIFY `scoreID` int(254) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `fileattachments`
--
ALTER TABLE `fileattachments`
  MODIFY `fileID` int(254) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `interests`
--
ALTER TABLE `interests`
  MODIFY `interestID` int(254) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `miscellaneousfees`
--
ALTER TABLE `miscellaneousfees`
  MODIFY `miscID` int(254) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

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
  MODIFY `schoolYearID` int(254) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `sections`
--
ALTER TABLE `sections`
  MODIFY `sectionID` int(254) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `sectionstudentlist`
--
ALTER TABLE `sectionstudentlist`
  MODIFY `listItemID` int(254) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `strands`
--
ALTER TABLE `strands`
  MODIFY `strandID` int(254) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `strandsubjects`
--
ALTER TABLE `strandsubjects`
  MODIFY `strandSubjectID` int(254) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

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
