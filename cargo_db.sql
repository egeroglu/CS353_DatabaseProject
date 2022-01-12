-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 04 Oca 2022, 07:50:41
-- Sunucu sürümü: 10.4.21-MariaDB
-- PHP Sürümü: 7.3.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `cargo_db`
--

DELIMITER $$
--
-- Yordamlar
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `get_report_procedure_customer` (IN `profileID` INT)  BEGIN
select 
c.userID,
c.username,
sum(m.amount) as sumMoney,
MIN(m.amount) as minMoney,
MAX(m.amount) as maxMoney,
AVG(m.amount) as avgMoney
from transaction m
join pays o on m.transactionID = o.transactionID
join customer c on c.userID = o.customerID
WHERE c.userID = profileID
group by c.userID, c.username;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_report_procedure_customerProf` (IN `profileID` INT)  BEGIN
select 
c.userID,
c.username,
sum(m.amount),
MIN(m.amount),
MAX(m.amount),
AVG(m.amount)
from transaction m
join pays o on m.transactionID = o.transactionID
join customer c on c.userID = o.customerID
WHERE c.userID = profileID
group by c.userID, c.username;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_report_procedure_customerProfile` (IN `profileID` INT)  BEGIN
select 
c.userID,
c.username,
sum(m.amount) as sumMoney,
MIN(m.amount) as minMoney,
MAX(m.amount) as maxMoney,
AVG(m.amount) as avgMoney
from transaction m
join pays o on m.transactionID = o.transactionID
join customer c on c.userID = o.customerID
WHERE c.userID = profileID
group by c.userID, c.username;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `branch`
--

CREATE TABLE `branch` (
  `branchID` int(11) NOT NULL,
  `name` varchar(32) DEFAULT NULL,
  `address` varchar(128) DEFAULT NULL,
  `city` varchar(32) DEFAULT NULL,
  `noOfEmployees` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Tablo döküm verisi `branch`
--

INSERT INTO `branch` (`branchID`, `name`, `address`, `city`, `noOfEmployees`) VALUES
(1, 'Ankara Branch', 'Kızılay, Çankara', 'Ankara', 5),
(2, 'Istanbul Branch', 'Taksim Meydanı, Beyoğlu', 'Istanbul', 5),
(4, 'Trabzon Branch', 'Cumhuriyet Meydanı', 'Trabzon', 6),
(5, 'Uşak Branch', 'Mecburiyet Caddesi', 'Uşak', 4);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `cashtransaction`
--

CREATE TABLE `cashtransaction` (
  `transactionID` int(11) NOT NULL,
  `changeAmount` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Tablo döküm verisi `cashtransaction`
--

INSERT INTO `cashtransaction` (`transactionID`, `changeAmount`) VALUES
(28, 10);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `clerk`
--

CREATE TABLE `clerk` (
  `userID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Tablo döküm verisi `clerk`
--

INSERT INTO `clerk` (`userID`) VALUES
(1),
(2),
(6),
(8),
(10),
(11),
(13),
(15),
(17),
(19);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `courier`
--

CREATE TABLE `courier` (
  `userID` int(11) NOT NULL,
  `license` varchar(12) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Tablo döküm verisi `courier`
--

INSERT INTO `courier` (`userID`, `license`) VALUES
(3, 'Valid'),
(4, 'Valid'),
(5, 'Valid'),
(7, 'Valid'),
(9, 'Valid'),
(12, 'Valid'),
(14, 'Valid'),
(16, 'Valid'),
(18, 'Valid'),
(20, 'Valid');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `creditcard`
--

CREATE TABLE `creditcard` (
  `creditCardNo` int(11) NOT NULL,
  `expirationDate` date NOT NULL,
  `cvv` int(11) NOT NULL,
  `customerID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Tablo döküm verisi `creditcard`
--

INSERT INTO `creditcard` (`creditCardNo`, `expirationDate`, `cvv`, `customerID`) VALUES
(123456, '0000-00-00', 123, 36),
(2147483647, '0000-00-00', 123, 36);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `creditcardtransaction`
--

CREATE TABLE `creditcardtransaction` (
  `transactionID` int(11) NOT NULL,
  `creditCardNo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Tablo döküm verisi `creditcardtransaction`
--

INSERT INTO `creditcardtransaction` (`transactionID`, `creditCardNo`) VALUES
(31, 2147483647);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `customer`
--

CREATE TABLE `customer` (
  `userID` int(11) NOT NULL,
  `address` varchar(128) DEFAULT NULL,
  `discountID` int(11) DEFAULT NULL,
  `username` varchar(64) NOT NULL,
  `password` varchar(64) NOT NULL,
  `email` varchar(64) NOT NULL,
  `phone_number` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Tablo döküm verisi `customer`
--

INSERT INTO `customer` (`userID`, `address`, `discountID`, `username`, `password`, `email`, `phone_number`) VALUES
(21, 'Ankara', NULL, 'NelaBob', '123', 'NelaBob@gmail.com', 2147483647),
(22, 'İstanbul', NULL, 'Jon-PaulStark', '123', 'Jon-PaulStark@gmail.com', 25896),
(23, 'Trabzon', NULL, 'AliYates', '123', 'AliYates@gmail.com', 1587),
(24, 'Uşak', NULL, 'Milan Shepard', '123', 'MilanShepard@gmail.com', 132),
(25, 'Trabzon', NULL, 'Riya John', '123', 'RiyaJohn@gmail.com', 4815926),
(26, 'Ankara', NULL, 'Wilf Norris', '123', 'WilfNorris@gmail.com', 15478),
(27, 'Uşak', NULL, 'Escobar', '123', 'escobar@gmail.com', 1256),
(28, 'Trabzon', NULL, 'OptimusPrime', '123', 'optimusprime@gmail.com', 1458),
(29, 'Trabzon', NULL, 'ironman', '123', 'ironman@gmail.com', 14444),
(30, 'İstanbul', NULL, 'legolas', '123', 'legolas@gmail.com', 404),
(31, 'İstanbul', NULL, 'sauronungozu', '123', 'sauron@gmail.com', 5289),
(32, 'Ankara', NULL, 'marufsatir', '123', 'maruf@gmail.com', 1111111),
(34, NULL, NULL, 'rtetr', '123', 'a@gmail.com', 123),
(36, 'Ankara', NULL, 'umitcivi', '123', 'b@gmail.com', 4444);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `deliveryassignment`
--

CREATE TABLE `deliveryassignment` (
  `clerkID` int(11) NOT NULL,
  `courierID` int(11) DEFAULT NULL,
  `submissionID` int(11) NOT NULL,
  `status` varchar(128) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Tablo döküm verisi `deliveryassignment`
--

INSERT INTO `deliveryassignment` (`clerkID`, `courierID`, `submissionID`, `status`) VALUES
(11, 12, 44, 'finished'),
(17, 20, 45, 'finished'),
(11, 12, 46, 'finished');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `discount`
--

CREATE TABLE `discount` (
  `discountID` int(11) NOT NULL,
  `percent` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Tablo döküm verisi `discount`
--

INSERT INTO `discount` (`discountID`, `percent`) VALUES
(1, 0),
(2, 20);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `employee`
--

CREATE TABLE `employee` (
  `userID` int(11) NOT NULL,
  `salary` int(11) DEFAULT NULL,
  `branchID` int(11) DEFAULT NULL,
  `username` varchar(64) NOT NULL,
  `password` varchar(64) NOT NULL,
  `email` varchar(64) NOT NULL,
  `phone_number` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Tablo döküm verisi `employee`
--

INSERT INTO `employee` (`userID`, `salary`, `branchID`, `username`, `password`, `email`, `phone_number`) VALUES
(1, 10000, 1, 'clerkAnkara1', '123', 'clerkAnkara1@gmail.com', 123),
(2, 3000, 1, 'clerkAnkara2', '123', 'clerkAnkara2@gmail.com', 1233),
(3, 1000, 1, 'courierAnkara1', '123', 'courierAnkara1@gmail.com', 1237),
(4, 3000, 1, 'courierAnkara2', '123', 'courierAnkara2@gmail.com', 12321),
(5, 12345, 1, 'courierAnkara3', '123', 'courierAnkara3@gmail.com', 12567),
(6, 5000, 2, 'clerkIstanbul1', '123', 'clerkIstanbul1@gmail.com', 5389632),
(7, 3000, 2, 'courierIstanbul1', '123', 'courierIstanbul1@gmail.com', 45678),
(8, 20000, 2, 'clerkIstanbul2', '123', 'clerkIstanbul2@gmail.com', 5462),
(9, 2222, 2, 'courierIstanbul2', '123', 'courierIstanbul2@gmail.com', 357753),
(10, 20000, 2, 'clerkIstanbul3', '123', 'clerkIstanbul3@gmail.com', 1452),
(11, 40000, 4, 'trabzonClerk1', '123', 'trabzonClerk1@gmail.com', 23456),
(12, 25580, 4, 'trabzonCourier1', '123', 'trabzonCourier1@gmail.com', 666),
(13, 45200, 4, 'trabzonClerk2', '123', 'trabzonClerk2@gmail.com', 158),
(14, 10000, 4, 'trabzonCourier2', '123', 'trabzonCourier2@gmail.com', 668),
(15, 32500, 4, 'trabzonClerk3', '123', 'trabzonClerk3@gmail.com', 627),
(16, 20000, 4, 'trabzonCourier3', '123', 'trabzonCourier3@gmail.com', 3376),
(17, 2500, 5, 'usakClerk1', '123', 'usakClerk1@gmail.com', 587),
(18, 25000, 5, 'usakCourier1', '123', 'usakClerk1@gmail.com', 258),
(19, 100, 5, 'usakClerk2', '123', 'usakClerk2@gmail.com', 441),
(20, 2222, 5, 'usakCourier2', '123', 'usakCourier2@gmail.com', 448);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `evaluates`
--

CREATE TABLE `evaluates` (
  `customerID` int(11) NOT NULL,
  `submissionID` int(11) NOT NULL,
  `clerkID` int(11) NOT NULL,
  `courierID` int(11) DEFAULT NULL,
  `score` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Tablo döküm verisi `evaluates`
--

INSERT INTO `evaluates` (`customerID`, `submissionID`, `clerkID`, `courierID`, `score`) VALUES
(23, 44, 11, 12, 12),
(24, 45, 17, 20, 22);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `insurance`
--

CREATE TABLE `insurance` (
  `insuranceID` int(11) NOT NULL,
  `coveragePercent` float DEFAULT NULL,
  `description` varchar(128) DEFAULT NULL,
  `companyID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Tablo döküm verisi `insurance`
--

INSERT INTO `insurance` (`insuranceID`, `coveragePercent`, `description`, `companyID`) VALUES
(0, 0, 'No insurance', 0),
(1, 20, 'high reward', 1),
(2, 10, 'cheap', 1),
(3, 11, 'average', 2),
(4, 50, 'expensive', 3);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `insurancecompany`
--

CREATE TABLE `insurancecompany` (
  `companyID` int(11) NOT NULL,
  `name` varchar(64) DEFAULT NULL,
  `address` varchar(128) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Tablo döküm verisi `insurancecompany`
--

INSERT INTO `insurancecompany` (`companyID`, `name`, `address`) VALUES
(0, 'null', 'null'),
(1, 'ABC', 'Bilkent University'),
(2, 'CPU', 'Ankara Kızılay'),
(3, 'PAKKARD', 'GİRESUN');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `package`
--

CREATE TABLE `package` (
  `submissionID` int(11) NOT NULL,
  `packageID` int(11) NOT NULL,
  `weight` float DEFAULT NULL,
  `width` float DEFAULT NULL,
  `length` float DEFAULT NULL,
  `height` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Tablo döküm verisi `package`
--

INSERT INTO `package` (`submissionID`, `packageID`, `weight`, `width`, `length`, `height`) VALUES
(44, 62, 1, 1, 1, 1),
(44, 63, 1, 1, 1, 1),
(45, 64, 11, 1, 1, 1),
(46, 65, 1, 1, 1, 1);

--
-- Tetikleyiciler `package`
--
DELIMITER $$
CREATE TRIGGER `before_insert_package` BEFORE INSERT ON `package` FOR EACH ROW BEGIN  
IF NEW.width < 0 THEN SET NEW.width = 0;  
END IF;
IF NEW.weight < 0 THEN SET NEW.weight = 0;  
END IF;
IF NEW.length < 0 THEN SET NEW.length = 0;  
END IF;
IF NEW.height < 0 THEN SET NEW.height = 0;  
END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `pays`
--

CREATE TABLE `pays` (
  `transactionID` int(11) NOT NULL,
  `customerID` int(11) DEFAULT NULL,
  `submissionID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Tablo döküm verisi `pays`
--

INSERT INTO `pays` (`transactionID`, `customerID`, `submissionID`) VALUES
(29, 36, 44),
(30, 36, 45),
(31, 36, 46);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `pickupassignment`
--

CREATE TABLE `pickupassignment` (
  `submissionID` int(11) NOT NULL,
  `branchID` int(11) DEFAULT NULL,
  `courierID` int(11) DEFAULT NULL,
  `status` varchar(128) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Tablo döküm verisi `pickupassignment`
--

INSERT INTO `pickupassignment` (`submissionID`, `branchID`, `courierID`, `status`) VALUES
(44, 1, 5, 'finished'),
(45, 2, 9, 'finished');

-- --------------------------------------------------------

--
-- Görünüm yapısı durumu `recipientview`
-- (Asıl görünüm için aşağıya bakın)
--
CREATE TABLE `recipientview` (
`username` varchar(64)
,`address` varchar(128)
);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `report`
--

CREATE TABLE `report` (
  `reportID` int(11) NOT NULL,
  `submissionID` int(11) NOT NULL,
  `customerID` int(11) DEFAULT NULL,
  `clerkID` int(11) DEFAULT NULL,
  `text` varchar(1024) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `status` varchar(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Tablo döküm verisi `report`
--

INSERT INTO `report` (`reportID`, `submissionID`, `customerID`, `clerkID`, `text`, `date`, `status`) VALUES
(15, 45, 24, 17, 'Good', '2022-01-03 00:00:00', 'positive'),
(16, 44, 23, 11, 'bad', '2022-01-03 00:00:00', 'waiting');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `submission`
--

CREATE TABLE `submission` (
  `submissionID` int(11) NOT NULL,
  `senderID` int(11) DEFAULT NULL,
  `recipientID` int(11) DEFAULT NULL,
  `insuranceID` int(11) DEFAULT NULL,
  `clerkID` int(11) DEFAULT NULL,
  `status` varchar(128) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Tablo döküm verisi `submission`
--

INSERT INTO `submission` (`submissionID`, `senderID`, `recipientID`, `insuranceID`, `clerkID`, `status`) VALUES
(44, 36, 23, 1, 11, 'delivered'),
(45, 36, 24, 1, 17, 'finalized'),
(46, 36, 21, 0, 11, 'delivered');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `transaction`
--

CREATE TABLE `transaction` (
  `transactionID` int(11) NOT NULL,
  `amount` float DEFAULT NULL,
  `datee` datetime DEFAULT NULL,
  `discountID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Tablo döküm verisi `transaction`
--

INSERT INTO `transaction` (`transactionID`, `amount`, `datee`, `discountID`) VALUES
(28, 188, '2002-01-03 00:00:00', 1),
(29, 137, '2022-01-03 00:00:00', 1),
(30, 56, '2022-01-03 00:00:00', 2),
(31, 124, '2022-01-03 00:00:00', 2);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `transfer`
--

CREATE TABLE `transfer` (
  `submissionID` int(11) NOT NULL,
  `branchID` int(11) NOT NULL,
  `clerkID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `users`
--

CREATE TABLE `users` (
  `userID` int(11) NOT NULL,
  `username` varchar(64) NOT NULL,
  `password` varchar(64) NOT NULL,
  `email` varchar(64) NOT NULL,
  `phone_number` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Tablo döküm verisi `users`
--

INSERT INTO `users` (`userID`, `username`, `password`, `email`, `phone_number`) VALUES
(1, 'clerkAnkara1', '123', 'clerkAnkara1@gmail.com', 123),
(2, 'clerkAnkara2', '123', 'clerkAnkara2@gmail.com', 1233),
(3, 'courierAnkara1', '123', 'courierAnkara1@gmail.com', 1237),
(4, 'courierAnkara2', '123', 'courierAnkara2@gmail.com', 12321),
(5, 'courierAnkara3', '123', 'courierAnkara3@gmail.com', 12567),
(6, 'clerkIstanbul1', '123', 'clerkIstanbul1@gmail.com', 5389632),
(7, 'courierIstanbul1', '123', 'courierIstanbul1@gmail.com', 45678),
(8, 'clerkIstanbul2', '123', 'clerkIstanbul2@gmail.com', 5462),
(9, 'courierIstanbul2', '123', 'courierIstanbul2@gmail.com', 357753),
(10, 'clerkIstanbul3', '123', 'clerkIstanbul3@gmail.com', 1452),
(11, 'trabzonClerk1', '123', 'trabzonClerk1@gmail.com', 23456),
(12, 'trabzonCourier1', '123', 'trabzonCourier1@gmail.com', 666),
(13, 'trabzonClerk2', '123', 'trabzonClerk2@gmail.com', 158),
(14, 'trabzonCourier2', '123', 'trabzonCourier2@gmail.com', 668),
(15, 'trabzonClerk3', '123', 'trabzonClerk3@gmail.com', 627),
(16, 'trabzonCourier3', '123', 'trabzonCourier3@gmail.com', 3376),
(17, 'usakClerk1', '123', 'usakClerk1@gmail.com', 587),
(18, 'usakCourier1', '123', 'usakCourier1@gmail.com', 258),
(19, 'usakClerk2', '123', 'usakClerk2@gmail.com', 441),
(20, 'usakCourier2', '123', 'usakCourier2@gmail.com', 448),
(21, 'NelaBob', '123', 'NelaBob@gmail.com', 2147483647),
(22, 'Jon-PaulStark', '123', 'Jon-PaulStark@gmail.com', 25896),
(23, 'AliYates', '123', 'AliYates@gmail.com', 1587),
(24, 'Milan Shepard', '123', 'MilanShepard@gmail.com', 132),
(25, 'Riya John', '123', 'RiyaJohn@gmail.com', 4815926),
(26, 'Wilf Norris', '123', 'WilfNorris@gmail.com', 15478),
(27, 'Escobar', '123', 'escobar@gmail.com', 1256),
(28, 'OptimusPrime', '123', 'optimusprime@gmail.com', 1458),
(29, 'ironman', '123', 'ironman@gmail.com', 14444),
(30, 'legolas', '123', 'legolas@gmail.com', 404),
(31, 'sauronungozu', '123', 'sauron@gmail.com', 5289),
(32, 'marufsatir', '123', 'maruf@gmail.com', 1111111),
(34, 'rtetr', '123', 'a@gmail.com', 123),
(36, 'umitcivi', '123', 'b@gmail.com', 4444);

-- --------------------------------------------------------

--
-- Görünüm yapısı `recipientview`
--
DROP TABLE IF EXISTS `recipientview`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `recipientview`  AS SELECT `customer`.`username` AS `username`, `customer`.`address` AS `address` FROM `customer` ;

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `branch`
--
ALTER TABLE `branch`
  ADD PRIMARY KEY (`branchID`);

--
-- Tablo için indeksler `cashtransaction`
--
ALTER TABLE `cashtransaction`
  ADD PRIMARY KEY (`transactionID`);

--
-- Tablo için indeksler `clerk`
--
ALTER TABLE `clerk`
  ADD PRIMARY KEY (`userID`);

--
-- Tablo için indeksler `courier`
--
ALTER TABLE `courier`
  ADD PRIMARY KEY (`userID`);

--
-- Tablo için indeksler `creditcard`
--
ALTER TABLE `creditcard`
  ADD PRIMARY KEY (`creditCardNo`),
  ADD KEY `customerID` (`customerID`);

--
-- Tablo için indeksler `creditcardtransaction`
--
ALTER TABLE `creditcardtransaction`
  ADD PRIMARY KEY (`transactionID`),
  ADD KEY `creditCardNo` (`creditCardNo`);

--
-- Tablo için indeksler `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`userID`),
  ADD KEY `username` (`username`) USING BTREE,
  ADD KEY `customer_ibfk_1` (`discountID`);

--
-- Tablo için indeksler `deliveryassignment`
--
ALTER TABLE `deliveryassignment`
  ADD PRIMARY KEY (`submissionID`,`clerkID`),
  ADD KEY `clerkID` (`clerkID`),
  ADD KEY `courierID` (`courierID`);

--
-- Tablo için indeksler `discount`
--
ALTER TABLE `discount`
  ADD PRIMARY KEY (`discountID`);

--
-- Tablo için indeksler `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`userID`),
  ADD KEY `branchID` (`branchID`);

--
-- Tablo için indeksler `evaluates`
--
ALTER TABLE `evaluates`
  ADD PRIMARY KEY (`customerID`,`submissionID`,`clerkID`),
  ADD KEY `submissionID` (`submissionID`),
  ADD KEY `clerkID` (`clerkID`),
  ADD KEY `courierID` (`courierID`);

--
-- Tablo için indeksler `insurance`
--
ALTER TABLE `insurance`
  ADD PRIMARY KEY (`insuranceID`),
  ADD KEY `companyID` (`companyID`);

--
-- Tablo için indeksler `insurancecompany`
--
ALTER TABLE `insurancecompany`
  ADD PRIMARY KEY (`companyID`);

--
-- Tablo için indeksler `package`
--
ALTER TABLE `package`
  ADD PRIMARY KEY (`packageID`,`submissionID`),
  ADD KEY `submissionID` (`submissionID`);

--
-- Tablo için indeksler `pays`
--
ALTER TABLE `pays`
  ADD PRIMARY KEY (`submissionID`,`transactionID`),
  ADD KEY `customerID` (`customerID`),
  ADD KEY `transactionID` (`transactionID`);

--
-- Tablo için indeksler `pickupassignment`
--
ALTER TABLE `pickupassignment`
  ADD PRIMARY KEY (`submissionID`),
  ADD KEY `branchID` (`branchID`),
  ADD KEY `courierID` (`courierID`);

--
-- Tablo için indeksler `report`
--
ALTER TABLE `report`
  ADD PRIMARY KEY (`reportID`,`submissionID`),
  ADD KEY `submissionID` (`submissionID`),
  ADD KEY `customerID` (`customerID`),
  ADD KEY `clerkID` (`clerkID`);

--
-- Tablo için indeksler `submission`
--
ALTER TABLE `submission`
  ADD PRIMARY KEY (`submissionID`),
  ADD KEY `senderID` (`senderID`),
  ADD KEY `recipientID` (`recipientID`),
  ADD KEY `insuranceID` (`insuranceID`),
  ADD KEY `clerkID` (`clerkID`);

--
-- Tablo için indeksler `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`transactionID`),
  ADD KEY `discountID` (`discountID`);

--
-- Tablo için indeksler `transfer`
--
ALTER TABLE `transfer`
  ADD PRIMARY KEY (`branchID`,`submissionID`),
  ADD KEY `submissionID` (`submissionID`),
  ADD KEY `clerkID` (`clerkID`);

--
-- Tablo için indeksler `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userID`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `branch`
--
ALTER TABLE `branch`
  MODIFY `branchID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Tablo için AUTO_INCREMENT değeri `discount`
--
ALTER TABLE `discount`
  MODIFY `discountID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Tablo için AUTO_INCREMENT değeri `insurance`
--
ALTER TABLE `insurance`
  MODIFY `insuranceID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Tablo için AUTO_INCREMENT değeri `package`
--
ALTER TABLE `package`
  MODIFY `packageID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- Tablo için AUTO_INCREMENT değeri `report`
--
ALTER TABLE `report`
  MODIFY `reportID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Tablo için AUTO_INCREMENT değeri `submission`
--
ALTER TABLE `submission`
  MODIFY `submissionID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- Tablo için AUTO_INCREMENT değeri `transaction`
--
ALTER TABLE `transaction`
  MODIFY `transactionID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- Tablo için AUTO_INCREMENT değeri `users`
--
ALTER TABLE `users`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- Dökümü yapılmış tablolar için kısıtlamalar
--

--
-- Tablo kısıtlamaları `cashtransaction`
--
ALTER TABLE `cashtransaction`
  ADD CONSTRAINT `cashtransaction_ibfk_1` FOREIGN KEY (`transactionID`) REFERENCES `transaction` (`transactionID`) ON DELETE CASCADE;

--
-- Tablo kısıtlamaları `clerk`
--
ALTER TABLE `clerk`
  ADD CONSTRAINT `clerk_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `employee` (`userID`) ON DELETE CASCADE;

--
-- Tablo kısıtlamaları `courier`
--
ALTER TABLE `courier`
  ADD CONSTRAINT `courier_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `employee` (`userID`) ON DELETE CASCADE;

--
-- Tablo kısıtlamaları `creditcard`
--
ALTER TABLE `creditcard`
  ADD CONSTRAINT `creditcard_ibfk_1` FOREIGN KEY (`customerID`) REFERENCES `customer` (`userID`) ON DELETE CASCADE;

--
-- Tablo kısıtlamaları `creditcardtransaction`
--
ALTER TABLE `creditcardtransaction`
  ADD CONSTRAINT `creditcardtransaction_ibfk_1` FOREIGN KEY (`transactionID`) REFERENCES `transaction` (`transactionID`) ON DELETE CASCADE,
  ADD CONSTRAINT `creditcardtransaction_ibfk_2` FOREIGN KEY (`creditCardNo`) REFERENCES `creditcard` (`creditCardNo`);

--
-- Tablo kısıtlamaları `customer`
--
ALTER TABLE `customer`
  ADD CONSTRAINT `customer_ibfk_1` FOREIGN KEY (`discountID`) REFERENCES `discount` (`discountID`) ON DELETE SET NULL,
  ADD CONSTRAINT `customer_ibfk_2` FOREIGN KEY (`userID`) REFERENCES `users` (`userID`) ON DELETE CASCADE;

--
-- Tablo kısıtlamaları `deliveryassignment`
--
ALTER TABLE `deliveryassignment`
  ADD CONSTRAINT `deliveryassignment_ibfk_1` FOREIGN KEY (`submissionID`) REFERENCES `submission` (`submissionID`) ON DELETE CASCADE,
  ADD CONSTRAINT `deliveryassignment_ibfk_2` FOREIGN KEY (`clerkID`) REFERENCES `clerk` (`userID`),
  ADD CONSTRAINT `deliveryassignment_ibfk_3` FOREIGN KEY (`courierID`) REFERENCES `courier` (`userID`);

--
-- Tablo kısıtlamaları `employee`
--
ALTER TABLE `employee`
  ADD CONSTRAINT `employee_ibfk_1` FOREIGN KEY (`branchID`) REFERENCES `branch` (`branchID`) ON DELETE SET NULL;

--
-- Tablo kısıtlamaları `evaluates`
--
ALTER TABLE `evaluates`
  ADD CONSTRAINT `evaluates_ibfk_1` FOREIGN KEY (`customerID`) REFERENCES `customer` (`userID`),
  ADD CONSTRAINT `evaluates_ibfk_2` FOREIGN KEY (`submissionID`) REFERENCES `submission` (`submissionID`) ON DELETE CASCADE,
  ADD CONSTRAINT `evaluates_ibfk_3` FOREIGN KEY (`clerkID`) REFERENCES `clerk` (`userID`),
  ADD CONSTRAINT `evaluates_ibfk_4` FOREIGN KEY (`courierID`) REFERENCES `courier` (`userID`);

--
-- Tablo kısıtlamaları `insurance`
--
ALTER TABLE `insurance`
  ADD CONSTRAINT `insurance_ibfk_1` FOREIGN KEY (`companyID`) REFERENCES `insurancecompany` (`companyID`) ON DELETE CASCADE;

--
-- Tablo kısıtlamaları `package`
--
ALTER TABLE `package`
  ADD CONSTRAINT `package_ibfk_1` FOREIGN KEY (`submissionID`) REFERENCES `submission` (`submissionID`) ON DELETE CASCADE;

--
-- Tablo kısıtlamaları `pays`
--
ALTER TABLE `pays`
  ADD CONSTRAINT `pays_ibfk_1` FOREIGN KEY (`customerID`) REFERENCES `customer` (`userID`) ON DELETE CASCADE,
  ADD CONSTRAINT `pays_ibfk_2` FOREIGN KEY (`transactionID`) REFERENCES `transaction` (`transactionID`) ON DELETE CASCADE,
  ADD CONSTRAINT `pays_ibfk_3` FOREIGN KEY (`submissionID`) REFERENCES `submission` (`submissionID`) ON DELETE CASCADE;

--
-- Tablo kısıtlamaları `pickupassignment`
--
ALTER TABLE `pickupassignment`
  ADD CONSTRAINT `pickupassignment_ibfk_1` FOREIGN KEY (`submissionID`) REFERENCES `submission` (`submissionID`) ON DELETE CASCADE,
  ADD CONSTRAINT `pickupassignment_ibfk_2` FOREIGN KEY (`branchID`) REFERENCES `branch` (`branchID`) ON DELETE SET NULL,
  ADD CONSTRAINT `pickupassignment_ibfk_3` FOREIGN KEY (`courierID`) REFERENCES `courier` (`userID`) ON DELETE SET NULL;

--
-- Tablo kısıtlamaları `report`
--
ALTER TABLE `report`
  ADD CONSTRAINT `report_ibfk_1` FOREIGN KEY (`submissionID`) REFERENCES `submission` (`submissionID`) ON DELETE CASCADE,
  ADD CONSTRAINT `report_ibfk_2` FOREIGN KEY (`customerID`) REFERENCES `customer` (`userID`),
  ADD CONSTRAINT `report_ibfk_3` FOREIGN KEY (`clerkID`) REFERENCES `clerk` (`userID`);

--
-- Tablo kısıtlamaları `submission`
--
ALTER TABLE `submission`
  ADD CONSTRAINT `submission_ibfk_1` FOREIGN KEY (`senderID`) REFERENCES `customer` (`userID`) ON DELETE CASCADE,
  ADD CONSTRAINT `submission_ibfk_2` FOREIGN KEY (`recipientID`) REFERENCES `customer` (`userID`) ON DELETE SET NULL,
  ADD CONSTRAINT `submission_ibfk_3` FOREIGN KEY (`insuranceID`) REFERENCES `insurance` (`insuranceID`) ON DELETE SET NULL,
  ADD CONSTRAINT `submission_ibfk_4` FOREIGN KEY (`clerkID`) REFERENCES `clerk` (`userID`) ON DELETE SET NULL;

--
-- Tablo kısıtlamaları `transaction`
--
ALTER TABLE `transaction`
  ADD CONSTRAINT `transaction_ibfk_1` FOREIGN KEY (`discountID`) REFERENCES `discount` (`discountID`) ON DELETE SET NULL;

--
-- Tablo kısıtlamaları `transfer`
--
ALTER TABLE `transfer`
  ADD CONSTRAINT `transfer_ibfk_1` FOREIGN KEY (`submissionID`) REFERENCES `submission` (`submissionID`) ON DELETE CASCADE,
  ADD CONSTRAINT `transfer_ibfk_2` FOREIGN KEY (`branchID`) REFERENCES `branch` (`branchID`),
  ADD CONSTRAINT `transfer_ibfk_3` FOREIGN KEY (`clerkID`) REFERENCES `clerk` (`userID`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
