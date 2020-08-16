SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;


CREATE TABLE `agent` (
  `agentId` int(11) NOT NULL,
  `agentLastName` char(15) DEFAULT NULL,
  `agentFirstName` char(15) DEFAULT NULL,
  `contactInfomation` char(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `apartment` (
  `apartmentId` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `pictures` char(30) DEFAULT NULL,
  `size` int(11) NOT NULL,
  `streetAddress` char(60) NOT NULL,
  `unitNumber` char(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `apartment` (`apartmentId`, `price`, `pictures`, `size`, `streetAddress`, `unitNumber`) VALUES
(3, 4910, '1WEA32.png', 923, '102 West End Avenue', '32'),
(7, 2350, '2E6S7G.png', 465, '22 East 60th Street', '7G'),
(13, 3245, '1CP2E.png', 1370, '115 Clifton Place', '2E'),
(14, 4690, '1W2S23.png', 980, '18 West 2nd Street', '23'),
(15, 2310, '1B2D.png', 976, '1095 Broadway', '2D'),
(16, 2125, '2CA3F.png', 896, '289 Classon Avenue', '3F');

CREATE TABLE `customer` (
  `customerId` int(11) NOT NULL,
  `password` char(30) NOT NULL,
  `nickName` char(30) DEFAULT NULL,
  `createDate` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `customer` (`customerId`, `password`, `nickName`, `createDate`) VALUES
(1, '1234567', 'first one', NULL);

CREATE TABLE `user_apt_like` (
  `customerID` int(11) NOT NULL,
  `apartmentId` int(11) NOT NULL,
  `add_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


ALTER TABLE `agent`
  ADD PRIMARY KEY (`agentId`);

ALTER TABLE `apartment`
  ADD PRIMARY KEY (`apartmentId`);

ALTER TABLE `customer`
  ADD PRIMARY KEY (`customerId`);

ALTER TABLE `user_apt_like`
  ADD KEY `customerID` (`customerID`),
  ADD KEY `apartmentId` (`apartmentId`);


ALTER TABLE `agent`
  MODIFY `agentId` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `apartment`
  MODIFY `apartmentId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

ALTER TABLE `customer`
  MODIFY `customerId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;


ALTER TABLE `user_apt_like`
  ADD CONSTRAINT `user_apt_like_ibfk_1` FOREIGN KEY (`customerID`) REFERENCES `customer` (`customerId`),
  ADD CONSTRAINT `user_apt_like_ibfk_2` FOREIGN KEY (`apartmentId`) REFERENCES `apartment` (`apartmentId`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
