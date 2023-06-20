-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 20, 2023 at 11:11 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dry-it`
--

-- --------------------------------------------------------

--
-- Table structure for table `laundryservices`
--

CREATE TABLE `laundryservices` (
  `serviceID` int(11) NOT NULL,
  `serviceName` varchar(50) NOT NULL,
  `servicePrice` int(11) NOT NULL,
  `serviceCategory` tinyint(1) NOT NULL,
  `tenantID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `laundryservices`
--

INSERT INTO `laundryservices` (`serviceID`, `serviceName`, `servicePrice`, `serviceCategory`, `tenantID`) VALUES
(1, 'Laundry Kiloan', 6000, 0, 1),
(2, 'Laundry Satuan', 10000, 0, 1),
(3, 'Laundry GECE!', 15000, 1, 1),
(4, 'Laundry Super!', 20000, 1, 1),
(5, 'Laundry WOI!', 4000, 0, 2);

-- --------------------------------------------------------

--
-- Table structure for table `tenant`
--

CREATE TABLE `tenant` (
  `id` int(3) NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `Photo` varchar(255) NOT NULL,
  `phone` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tenant`
--

INSERT INTO `tenant` (`id`, `name`, `address`, `Photo`, `phone`) VALUES
(1, 'New Laundry ', 'Jalan Kemanggisan ', 'https://media.discordapp.net/attachments/524461320314028052/1093157739561242695/20230228_154831.jpg?width=568&height=426', '081234567898'),
(2, 'New Laundry 1', 'Jalan Kemanggisan ', 'https://media.discordapp.net/attachments/524461320314028052/1093157739561242695/20230228_154831.jpg?width=568&height=426', '081234567888'),
(3, 'New Laundry 2', 'Jalan Kemanggisan ', 'https://media.discordapp.net/attachments/524461320314028052/1093157739561242695/20230228_154831.jpg?width=568&height=426', '081212124566'),
(4, 'New Laundry 3', 'Jalan Kemanggisan 123', 'https://media.discordapp.net/attachments/524461320314028052/1093157739561242695/20230228_154831.jpg?width=568&height=426', '089956561214'),
(5, 'New Laundry 10', 'Jalan Kemanggisan 123', 'https://media.discordapp.net/attachments/524461320314028052/1093157739561242695/20230228_154831.jpg?width=568&height=426', '089655422356');

-- --------------------------------------------------------

--
-- Table structure for table `transactiondetail`
--

CREATE TABLE `transactiondetail` (
  `transactiondetailid` int(11) NOT NULL,
  `transactionid` int(11) NOT NULL,
  `tenantid` int(11) NOT NULL,
  `serviceid` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transactiondetail`
--

INSERT INTO `transactiondetail` (`transactiondetailid`, `transactionid`, `tenantid`, `serviceid`, `quantity`) VALUES
(1, 23, 1, 1, 2),
(2, 24, 1, 1, 2),
(3, 24, 1, 2, 1),
(4, 24, 1, 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `transactionheader`
--

CREATE TABLE `transactionheader` (
  `TransactionId` int(11) NOT NULL,
  `TransactionDate` datetime NOT NULL,
  `TransactionPrice` bigint(20) NOT NULL,
  `TransactionProgress` tinyint(1) NOT NULL,
  `UsersId` int(11) NOT NULL,
  `TenantId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transactionheader`
--

INSERT INTO `transactionheader` (`TransactionId`, `TransactionDate`, `TransactionPrice`, `TransactionProgress`, `UsersId`, `TenantId`) VALUES
(1, '2023-06-07 00:00:00', 50000, 0, 8, 2),
(2, '2023-06-05 00:00:00', 20000, 0, 8, 4),
(4, '2023-06-01 00:00:00', 100000, 1, 8, 3),
(5, '2023-06-01 00:00:00', 100000, 0, 8, 3),
(20, '2023-06-20 06:00:13', 74000, 0, 8, 1),
(21, '2023-06-20 06:00:38', 74000, 0, 8, 1),
(22, '2023-06-20 06:00:51', 74000, 0, 8, 1),
(23, '2023-06-20 06:01:46', 74000, 0, 8, 1),
(24, '2023-06-20 06:04:38', 74000, 0, 8, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(3) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `address` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `address`) VALUES
(7, 'admin', '$2y$10$iusesomecrazystrings2u0s.7Uu7dRDQyLygbeI6Nisg4CfKtRlq', 'admin@gmail.com', 'Jalan Rahasia'),
(8, 'felix', '$2y$10$iusesomecrazystrings2uhB91MlWpGIP6pNsNYciRE5VvNMZtBaa', 'felix@gmail.com', 'Jalan Binus'),
(9, 'asepp', '$2y$10$iusesomecrazystrings2uzMvdNBmQwUd9DW3i8ZxUUzhw.C8PQhW', 'asep@gmail.com', 'Jalan Tomang');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `laundryservices`
--
ALTER TABLE `laundryservices`
  ADD PRIMARY KEY (`serviceID`),
  ADD KEY `foreign_key` (`tenantID`);

--
-- Indexes for table `tenant`
--
ALTER TABLE `tenant`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transactiondetail`
--
ALTER TABLE `transactiondetail`
  ADD PRIMARY KEY (`transactiondetailid`),
  ADD KEY `tenantid` (`tenantid`),
  ADD KEY `serviceid` (`serviceid`);

--
-- Indexes for table `transactionheader`
--
ALTER TABLE `transactionheader`
  ADD PRIMARY KEY (`TransactionId`),
  ADD KEY `UsersId` (`UsersId`),
  ADD KEY `TenantId` (`TenantId`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tenant`
--
ALTER TABLE `tenant`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `transactiondetail`
--
ALTER TABLE `transactiondetail`
  MODIFY `transactiondetailid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `transactionheader`
--
ALTER TABLE `transactionheader`
  MODIFY `TransactionId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `transactiondetail`
--
ALTER TABLE `transactiondetail`
  ADD CONSTRAINT `transactiondetail_ibfk_1` FOREIGN KEY (`tenantid`) REFERENCES `tenant` (`id`),
  ADD CONSTRAINT `transactiondetail_ibfk_2` FOREIGN KEY (`serviceid`) REFERENCES `laundryservices` (`serviceID`);

--
-- Constraints for table `transactionheader`
--
ALTER TABLE `transactionheader`
  ADD CONSTRAINT `transactionheader_ibfk_1` FOREIGN KEY (`UsersId`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `transactionheader_ibfk_2` FOREIGN KEY (`TenantId`) REFERENCES `tenant` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
