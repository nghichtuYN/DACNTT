-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 14, 2024 at 04:38 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `salesmanagement`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbcategory`
--

CREATE TABLE `tbcategory` (
  `CatID` int(11) NOT NULL,
  `CatName` varchar(255) NOT NULL,
  `Status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbcategory`
--

INSERT INTO `tbcategory` (`CatID`, `CatName`, `Status`) VALUES
(1, 'Áo', 1),
(9, 'QUẦN', 1),
(10, 'MŨ', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tborder`
--

CREATE TABLE `tborder` (
  `OrdID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `CustName` varchar(100) NOT NULL,
  `CustAddress` text NOT NULL,
  `CustPhone` varchar(20) NOT NULL,
  `OrderDate` date NOT NULL DEFAULT current_timestamp(),
  `ReceiveDate` date DEFAULT NULL,
  `Status` tinyint(4) NOT NULL DEFAULT 0,
  `OrdCost` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tborder`
--

INSERT INTO `tborder` (`OrdID`, `UserID`, `CustName`, `CustAddress`, `CustPhone`, `OrderDate`, `ReceiveDate`, `Status`, `OrdCost`) VALUES
(28, 2, 'Đặng Việt Hoàng', '111a', '0972045499', '2024-06-12', '0000-00-00', 0, '1700000'),
(29, 2, 'Đặng Việt Hoàng', '33333', '0972045499', '2024-06-12', NULL, 1, '1700000'),
(30, 2, 'Đặng Việt Hoàng', '5555', '0972045499', '2024-06-12', NULL, 1, '1700000'),
(31, 3, 'Nguyen Thu Trang', '44/1/1 Bang B,Hoang Liet.Hoang Mai', '0862201203', '2024-06-13', '2024-06-15', 1, '5100000'),
(32, 3, 'Đặng Việt Hoàng', 'Ngõ 44/1/4 Bằng B ,Hoàng Liệt, Hoàng Mai', '0972045499', '2024-06-14', '2024-06-16', 1, '600000'),
(33, 3, 'Đặng Việt Hoàng', 'Bằng B', '0972045499', '2024-06-14', NULL, 0, '1700000'),
(34, 3, 'Đặng Việt Hoàng', 'Bằng B', '0972045499', '2024-06-14', NULL, 0, '1400000'),
(35, 3, 'Đặng Việt Hoàng', 'Băng a', '0972045499', '2024-06-14', NULL, 0, '3900000');

-- --------------------------------------------------------

--
-- Table structure for table `tborderdetail`
--

CREATE TABLE `tborderdetail` (
  `OrdID` int(11) NOT NULL,
  `ProID` int(11) NOT NULL,
  `Quantity` int(11) NOT NULL,
  `Price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tborderdetail`
--

INSERT INTO `tborderdetail` (`OrdID`, `ProID`, `Quantity`, `Price`) VALUES
(28, 15, 1, '1700000.00'),
(29, 1, 1, '1700000.00'),
(30, 1, 1, '1700000.00'),
(31, 1, 2, '3400000.00'),
(31, 15, 1, '1700000.00'),
(32, 34, 2, '600000.00'),
(33, 15, 1, '1700000.00'),
(34, 20, 2, '1400000.00'),
(35, 23, 1, '1700000.00'),
(35, 24, 2, '2200000.00');

-- --------------------------------------------------------

--
-- Table structure for table `tbproduct`
--

CREATE TABLE `tbproduct` (
  `ProID` int(11) NOT NULL,
  `ProName` varchar(255) NOT NULL,
  `ProImage` varchar(255) DEFAULT NULL,
  `ProImage1` varchar(255) DEFAULT NULL,
  `ProImage2` varchar(255) DEFAULT NULL,
  `ProImage3` varchar(255) DEFAULT NULL,
  `ProImage4` varchar(255) DEFAULT NULL,
  `Price` decimal(10,2) NOT NULL,
  `Description` text DEFAULT NULL,
  `Status` tinyint(1) NOT NULL,
  `CatID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbproduct`
--

INSERT INTO `tbproduct` (`ProID`, `ProName`, `ProImage`, `ProImage1`, `ProImage2`, `ProImage3`, `ProImage4`, `Price`, `Description`, `Status`, `CatID`) VALUES
(1, 'Áo Adidas xanh da trời', 'image1.jpg', 'image2.jpg', 'image3.jpg', 'image4.jpg', 'image5.jpg', '1700000.00', 'Item is confirmed after payment confirmation. No refunds, returns or exchanges will be entertained except as required by law. This product is excluded from all promotional discounts and offers. Limited to 1 Quantity per Order.', 1, 1),
(15, 'SW_SS TEE_NZ HT', 'ao4.jpg', 'ao1.jpg', 'ao2.jpg', 'ao3.jpg', 'ao5.jpg', '1700000.00', 'Item is confirmed after payment confirmation. No refunds, returns or exchanges will be entertained except as required by law. This product is excluded from all promotional discounts and offers. Limited to 1 Quantity per Order.', 1, 1),
(16, 'SW_LS TEE_NZ TN', 'ao21.jpg', 'ao22.jpg', 'ao23.jpg', 'ao24.jpg', 'ao25.jpg', '1700000.00', 'NO RETURNS, NO REFUNDS\r\nItem is confirmed after payment confirmation. No refunds, returns or exchanges will be entertained except as required by law. This product is excluded from all promotional discounts and offers. Limited to 1 Quantity per Order.', 1, 1),
(17, 'ÁO THUN BA LÁ ESSENTIALS', 'aothun4.jpg', 'aothun1.jpg', 'aothun2.jpg', 'aothun3.jpg', 'aothun5.jpg', '700000.00', NULL, 1, 1),
(18, 'ÁO THUN BA LÁ ESSENTIALS', 'aothun4.jpg', 'aothun1.jpg', 'aothun2.jpg', 'aothun3.jpg', 'aothun5.jpg', '700000.00', NULL, 1, 1),
(19, 'ÁO THUN BA LÁ ESSENTIALS', 'aothun4.jpg', 'aothun1.jpg', 'aothun2.jpg', 'aothun3.jpg', 'aothun5.jpg', '700000.00', NULL, 1, 1),
(20, 'ÁO THUN BA LÁ ESSENTIALS', 'aothun4.jpg', 'aothun1.jpg', 'aothun2.jpg', 'aothun3.jpg', 'aothun5.jpg', '700000.00', NULL, 1, 1),
(21, 'ÁO THUN BA LÁ ESSENTIALS', 'aothun4.jpg', 'aothun1.jpg', 'aothun2.jpg', 'aothun3.jpg', 'aothun5.jpg', '700000.00', NULL, 1, 1),
(22, 'SW_LS TEE_NZ TN', 'ao21.jpg', 'ao22.jpg', 'ao23.jpg', 'ao24.jpg', 'ao25.jpg', '1700000.00', 'NO RETURNS, NO REFUNDS\r\nItem is confirmed after payment confirmation. No refunds, returns or exchanges will be entertained except as required by law. This product is excluded from all promotional discounts and offers. Limited to 1 Quantity per Order.', 1, 1),
(23, 'SW_LS TEE_NZ TN', 'ao21.jpg', 'ao22.jpg', 'ao23.jpg', 'ao24.jpg', 'ao25.jpg', '1700000.00', 'NO RETURNS, NO REFUNDS\r\nItem is confirmed after payment confirmation. No refunds, returns or exchanges will be entertained except as required by law. This product is excluded from all promotional discounts and offers. Limited to 1 Quantity per Order.', 1, 1),
(24, 'QUẦN SHORT SÂN NHÀ REAL MADRID 24/25', 'quan4.jpg', 'Quan1.jpg', 'quan2.jpg', 'quan3.jpg', 'quan5.jpg', '1100000.00', 'NO RETURNS, NO REFUNDS\r\nItem is confirmed after payment confirmation. No refunds, returns or exchanges will be entertained except as required by law. This product is excluded from all promotional discounts and offers. Limited to 1 Quantity per Order.', 1, 9),
(25, 'QUẦN SHORT SÂN NHÀ REAL MADRID 24/25', 'quan4.jpg', 'Quan1.jpg', 'quan2.jpg', 'quan3.jpg', 'quan5.jpg', '1100000.00', NULL, 1, 9),
(26, 'QUẦN SHORT SÂN NHÀ REAL MADRID 24/25', 'quan4.jpg', 'Quan1.jpg', 'quan2.jpg', 'quan3.jpg', 'quan5.jpg', '1100000.00', NULL, 1, 9),
(27, 'QUẦN SHORT SÂN NHÀ REAL MADRID 24/25', 'quan4.jpg', 'Quan1.jpg', 'quan2.jpg', 'quan3.jpg', 'quan5.jpg', '1100000.00', NULL, 1, 9),
(28, 'SW_LS TEE_NZ TN', 'ao21.jpg', 'ao22.jpg', 'ao23.jpg', 'ao24.jpg', 'ao25.jpg', '1700000.00', 'NO RETURNS, NO REFUNDS\r\nItem is confirmed after payment confirmation. No refunds, returns or exchanges will be entertained except as required by law. This product is excluded from all promotional discounts and offers. Limited to 1 Quantity per Order.', 1, 9),
(29, 'SW_LS TEE_NZ TN', 'ao21.jpg', 'ao22.jpg', 'ao23.jpg', 'ao24.jpg', 'ao25.jpg', '1700000.00', 'NO RETURNS, NO REFUNDS\r\nItem is confirmed after payment confirmation. No refunds, returns or exchanges will be entertained except as required by law. This product is excluded from all promotional discounts and offers. Limited to 1 Quantity per Order.', 1, 9),
(30, 'SW_LS TEE_NZ TN', 'ao21.jpg', 'ao22.jpg', 'ao23.jpg', 'ao24.jpg', 'ao25.jpg', '1700000.00', 'NO RETURNS, NO REFUNDS\r\nItem is confirmed after payment confirmation. No refunds, returns or exchanges will be entertained except as required by law. This product is excluded from all promotional discounts and offers. Limited to 1 Quantity per Order.', 1, 9),
(31, 'QUẦN SHORT SÂN NHÀ REAL MADRID 24/25', 'quan4.jpg', 'Quan1.jpg', 'quan2.jpg', 'quan3.jpg', 'quan5.jpg', '1100000.00', NULL, 1, 9),
(32, 'QUẦN SHORT SÂN NHÀ REAL MADRID 24/25', 'quan4.jpg', 'Quan1.jpg', 'quan2.jpg', 'quan3.jpg', 'quan5.jpg', '1100000.00', NULL, 1, 9),
(33, 'Áo Adidas xanh da trời', 'image1.jpg', 'image2.jpg', 'image3.jpg', 'image4.jpg', 'image5.jpg', '1700000.00', 'Item is confirmed after payment confirmation. No refunds, returns or exchanges will be entertained except as required by law. This product is excluded from all promotional discounts and offers. Limited to 1 Quantity per Order.', 1, 9),
(34, 'MŨ DAD CAP SAMBA1', 'mu1.jpg', 'mu2.jpg', 'mu3.jpg', NULL, NULL, '600000.00', '', 1, 10);

-- --------------------------------------------------------

--
-- Table structure for table `tbuser`
--

CREATE TABLE `tbuser` (
  `UserID` int(11) NOT NULL,
  `UserName` varchar(100) NOT NULL,
  `UserEmail` varchar(100) NOT NULL,
  `UserPassword` varchar(100) NOT NULL,
  `isAdmin` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbuser`
--

INSERT INTO `tbuser` (`UserID`, `UserName`, `UserEmail`, `UserPassword`, `isAdmin`) VALUES
(1, 'Dang viet hoang', '123@gmail.com', '123456', 0),
(2, 'Admin', 'hoangtroll14354@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 1),
(3, 'Nguyen Thu Trang', 'trang@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbcategory`
--
ALTER TABLE `tbcategory`
  ADD PRIMARY KEY (`CatID`);

--
-- Indexes for table `tborder`
--
ALTER TABLE `tborder`
  ADD PRIMARY KEY (`OrdID`),
  ADD KEY `UserID` (`UserID`);

--
-- Indexes for table `tborderdetail`
--
ALTER TABLE `tborderdetail`
  ADD PRIMARY KEY (`OrdID`,`ProID`),
  ADD KEY `ProID` (`ProID`);

--
-- Indexes for table `tbproduct`
--
ALTER TABLE `tbproduct`
  ADD PRIMARY KEY (`ProID`),
  ADD KEY `CatID` (`CatID`);

--
-- Indexes for table `tbuser`
--
ALTER TABLE `tbuser`
  ADD PRIMARY KEY (`UserID`),
  ADD UNIQUE KEY `UserEmail` (`UserEmail`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbcategory`
--
ALTER TABLE `tbcategory`
  MODIFY `CatID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `tborder`
--
ALTER TABLE `tborder`
  MODIFY `OrdID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `tbproduct`
--
ALTER TABLE `tbproduct`
  MODIFY `ProID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `tbuser`
--
ALTER TABLE `tbuser`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tborder`
--
ALTER TABLE `tborder`
  ADD CONSTRAINT `tborder_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `tbuser` (`UserID`);

--
-- Constraints for table `tborderdetail`
--
ALTER TABLE `tborderdetail`
  ADD CONSTRAINT `tborderdetail_ibfk_1` FOREIGN KEY (`OrdID`) REFERENCES `tborder` (`OrdID`),
  ADD CONSTRAINT `tborderdetail_ibfk_2` FOREIGN KEY (`ProID`) REFERENCES `tbproduct` (`ProID`);

--
-- Constraints for table `tbproduct`
--
ALTER TABLE `tbproduct`
  ADD CONSTRAINT `tbproduct_ibfk_1` FOREIGN KEY (`CatID`) REFERENCES `tbcategory` (`CatID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
