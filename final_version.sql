-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Aug 17, 2020 at 08:26 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.2.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `twobros`
--

-- --------------------------------------------------------

--
-- Table structure for table `agent`
--

CREATE TABLE `agent` (
  `agentId` int(11) NOT NULL,
  `agentLastName` char(15) DEFAULT NULL,
  `agentFirstName` char(15) DEFAULT NULL,
  `contactInfomation` char(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `apartment`
--

CREATE TABLE `apartment` (
  `apartmentId` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `pictures` char(30) DEFAULT NULL,
  `size` int(11) NOT NULL,
  `streetAddress` char(60) NOT NULL,
  `unitNumber` char(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `apartment`
--

INSERT INTO `apartment` (`apartmentId`, `price`, `pictures`, `size`, `streetAddress`, `unitNumber`) VALUES
(3, 4910, '1WEA32.png', 923, '102 West End Avenue', '32'),
(7, 2350, '2E6S7G.png', 465, '22 East 60th Street', '7G'),
(13, 3245, '1CP2E.png', 1370, '115 Clifton Place', '2E'),
(14, 4690, '1W2S23.png', 980, '18 West 2nd Street', '23'),
(15, 2310, '1B2D.png', 976, '1095 Broadway', '2D'),
(16, 2125, '2CA3F.png', 896, '289 Classon Avenue', '3F');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customerId` int(11) NOT NULL,
  `password` char(30) NOT NULL,
  `username` char(30) NOT NULL,
  `createDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customerId`, `password`, `username`, `createDate`) VALUES
(1, '123', 'aaa', '2020-08-17'),
(2, '123', 'bbb', '2020-08-17'),
(12, '123', 'ccc', '2020-08-17');

-- --------------------------------------------------------

--
-- Table structure for table `user_apt_like`
--

CREATE TABLE `user_apt_like` (
  `customerId` int(11) NOT NULL,
  `apartmentId` int(11) NOT NULL,
  `add_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_apt_like`
--

INSERT INTO `user_apt_like` (`customerId`, `apartmentId`, `add_date`) VALUES
(2, 7, '2020-08-17'),
(1, 14, '2020-08-17'),
(1, 16, '2020-08-17'),
(12, 3, '2020-08-17');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `agent`
--
ALTER TABLE `agent`
  ADD PRIMARY KEY (`agentId`);

--
-- Indexes for table `apartment`
--
ALTER TABLE `apartment`
  ADD PRIMARY KEY (`apartmentId`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customerId`);

--
-- Indexes for table `user_apt_like`
--
ALTER TABLE `user_apt_like`
  ADD KEY `customerId` (`customerId`),
  ADD KEY `apartmentId` (`apartmentId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `agent`
--
ALTER TABLE `agent`
  MODIFY `agentId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `apartment`
--
ALTER TABLE `apartment`
  MODIFY `apartmentId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `customerId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `user_apt_like`
--
ALTER TABLE `user_apt_like`
  ADD CONSTRAINT `user_apt_like_ibfk_1` FOREIGN KEY (`customerId`) REFERENCES `customer` (`customerId`),
  ADD CONSTRAINT `user_apt_like_ibfk_2` FOREIGN KEY (`apartmentId`) REFERENCES `apartment` (`apartmentId`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
