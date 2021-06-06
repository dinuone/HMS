-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 06, 2021 at 10:19 AM
-- Server version: 10.4.16-MariaDB
-- PHP Version: 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hostpital_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `ID` int(11) NOT NULL,
  `FullName` varchar(50) NOT NULL,
  `Address` varchar(50) NOT NULL,
  `City` varchar(10) NOT NULL,
  `Gender` varchar(6) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `username` varchar(10) NOT NULL,
  `PSW` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`ID`, `FullName`, `Address`, `City`, `Gender`, `Email`, `username`, `PSW`) VALUES
(1, 'admin', 'no 148, golahen watta, plapathwela', 'matale', 'male', 'dinu11one@gmail.com', 'admin', 'admin12');

-- --------------------------------------------------------

--
-- Table structure for table `appoinments`
--

CREATE TABLE `appoinments` (
  `uID` int(11) NOT NULL,
  `docName` varchar(30) NOT NULL,
  `usrName` varchar(30) NOT NULL,
  `TimeAdd` varchar(30) NOT NULL,
  `dateAdd` varchar(30) NOT NULL,
  `appDate` varchar(30) NOT NULL,
  `docfees` int(11) NOT NULL,
  `docspec` varchar(30) NOT NULL,
  `docid` int(11) DEFAULT NULL,
  `id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `doctor`
--

CREATE TABLE `doctor` (
  `dctID` int(11) NOT NULL,
  `doctorName` varchar(50) NOT NULL,
  `Address` varchar(50) NOT NULL,
  `contact` char(10) NOT NULL,
  `Gender` varchar(10) NOT NULL,
  `usrName` varchar(10) DEFAULT NULL,
  `PSW` varchar(20) DEFAULT NULL,
  `docSpec` varchar(10) DEFAULT NULL,
  `docFees` int(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `frontoffice`
--

CREATE TABLE `frontoffice` (
  `RID` int(11) NOT NULL,
  `FullName` varchar(50) NOT NULL,
  `Address` varchar(30) NOT NULL,
  `Age` int(11) NOT NULL,
  `username` varchar(10) NOT NULL,
  `Contact` char(10) NOT NULL,
  `PSW` int(11) NOT NULL,
  `Email` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `gen_todaypatient`
--

CREATE TABLE `gen_todaypatient` (
  `PID` int(11) NOT NULL,
  `Pname` varchar(50) NOT NULL,
  `Address` varchar(50) NOT NULL,
  `Contact` char(10) NOT NULL,
  `Age` int(11) NOT NULL,
  `DocName` varchar(50) NOT NULL,
  `DocSpec` varchar(50) NOT NULL,
  `TimeNow` varchar(10) NOT NULL,
  `docFee` int(11) NOT NULL,
  `Payamount` int(11) NOT NULL,
  `DtaeNow` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `mediclog`
--

CREATE TABLE `mediclog` (
  `PID` int(11) NOT NULL,
  `Pname` int(11) NOT NULL,
  `DocName` varchar(50) NOT NULL,
  `DocFee` int(11) NOT NULL,
  `PtSymptom` varchar(100) NOT NULL,
  `Drugs` varchar(100) NOT NULL,
  `DateNow` varchar(50) NOT NULL,
  `TimeNow` varchar(30) NOT NULL,
  `DocID` int(11) NOT NULL,
  `Page` int(11) DEFAULT NULL,
  `AppDate` varchar(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `patients`
--

CREATE TABLE `patients` (
  `PID` int(11) NOT NULL,
  `Pname` varchar(50) NOT NULL,
  `Address` varchar(60) NOT NULL,
  `Contact` char(10) NOT NULL,
  `Age` int(11) NOT NULL,
  `DocName` varchar(50) NOT NULL,
  `DocSpec` varchar(50) NOT NULL,
  `DateNow` varchar(50) NOT NULL,
  `TimeNow` varchar(10) NOT NULL,
  `docFee` int(11) NOT NULL,
  `payamount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `uID` int(11) NOT NULL,
  `FullName` varchar(50) NOT NULL,
  `Address` varchar(60) NOT NULL,
  `City` varchar(20) NOT NULL,
  `Gender` varchar(10) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `PSW` varchar(20) NOT NULL,
  `username` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`uID`, `FullName`, `Address`, `City`, `Gender`, `Email`, `PSW`, `username`) VALUES
(0, 'dinuwan maduranga', 'no20,pubudumawatha,elwala,ukuwela', 'matale', 'male', 'dinuwan33maduranga@gmail.com', 'dtm1122', 'dinu12');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `appoinments`
--
ALTER TABLE `appoinments`
  ADD PRIMARY KEY (`uID`);

--
-- Indexes for table `doctor`
--
ALTER TABLE `doctor`
  ADD PRIMARY KEY (`dctID`);

--
-- Indexes for table `frontoffice`
--
ALTER TABLE `frontoffice`
  ADD PRIMARY KEY (`RID`);

--
-- Indexes for table `gen_todaypatient`
--
ALTER TABLE `gen_todaypatient`
  ADD PRIMARY KEY (`PID`);

--
-- Indexes for table `mediclog`
--
ALTER TABLE `mediclog`
  ADD PRIMARY KEY (`PID`);

--
-- Indexes for table `patients`
--
ALTER TABLE `patients`
  ADD PRIMARY KEY (`PID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `appoinments`
--
ALTER TABLE `appoinments`
  MODIFY `uID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `doctor`
--
ALTER TABLE `doctor`
  MODIFY `dctID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `frontoffice`
--
ALTER TABLE `frontoffice`
  MODIFY `RID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `gen_todaypatient`
--
ALTER TABLE `gen_todaypatient`
  MODIFY `PID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `patients`
--
ALTER TABLE `patients`
  MODIFY `PID` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
