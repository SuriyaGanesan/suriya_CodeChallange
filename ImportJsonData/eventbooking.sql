-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 11, 2021 at 05:59 PM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 7.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `eventbooking`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_employee`
--

CREATE TABLE `tbl_employee` (
  `employeeId` int(11) NOT NULL,
  `employee_name` varchar(100) NOT NULL,
  `employee_mail` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_employee`
--

INSERT INTO `tbl_employee` (`employeeId`, `employee_name`, `employee_mail`) VALUES
(128, 'Reto Fanzen', 'reto.fanzen@no-reply.rexx-systems.com'),
(129, 'Leandro Bußmann', 'leandro.bussmann@no-reply.rexx-systems.com'),
(130, 'Hans Schäfer', 'hans.schaefer@no-reply.rexx-systems.com'),
(131, 'Mia Wyss', 'mia.wyss@no-reply.rexx-systems.com');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_event`
--

CREATE TABLE `tbl_event` (
  `eventId` int(11) NOT NULL,
  `eventName` varchar(100) NOT NULL,
  `eventDate` datetime NOT NULL,
  `Fee` int(11) NOT NULL,
  `version` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_event`
--

INSERT INTO `tbl_event` (`eventId`, `eventName`, `eventDate`, `Fee`, `version`) VALUES
(1, 'PHP 7 crash course', '2019-09-04 08:00:00', 0, '1.0.17+42'),
(2, 'International PHP Conference', '2019-10-21 10:00:00', 1486, '1.0.17+59'),
(3, 'code.talks', '2019-10-24 08:00:00', 475, '1.0.17+59');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_participants`
--

CREATE TABLE `tbl_participants` (
  `participantId` int(11) NOT NULL,
  `employeeId` int(11) NOT NULL,
  `eventId` int(11) NOT NULL,
  `eventFee` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_participants`
--

INSERT INTO `tbl_participants` (`participantId`, `employeeId`, `eventId`, `eventFee`) VALUES
(1, 128, 1, 0),
(2, 128, 2, 1486),
(3, 129, 2, 658),
(4, 130, 1, 0),
(5, 131, 1, 0),
(6, 131, 2, 658),
(7, 128, 3, 475),
(8, 130, 3, 534);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_employee`
--
ALTER TABLE `tbl_employee`
  ADD PRIMARY KEY (`employeeId`);

--
-- Indexes for table `tbl_event`
--
ALTER TABLE `tbl_event`
  ADD PRIMARY KEY (`eventId`);

--
-- Indexes for table `tbl_participants`
--
ALTER TABLE `tbl_participants`
  ADD PRIMARY KEY (`participantId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_employee`
--
ALTER TABLE `tbl_employee`
  MODIFY `employeeId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=132;

--
-- AUTO_INCREMENT for table `tbl_event`
--
ALTER TABLE `tbl_event`
  MODIFY `eventId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tbl_participants`
--
ALTER TABLE `tbl_participants`
  MODIFY `participantId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
