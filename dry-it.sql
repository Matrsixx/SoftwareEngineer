-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 07, 2023 at 07:33 PM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

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
-- Table structure for table `tenant`
--

CREATE TABLE `tenant` (
  `id` int(3) NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `Photo` varchar(255) NOT NULL,
  `phone` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
-- Table structure for table `transactionheader`
--

CREATE TABLE `transactionheader` (
  `TransactionId` int(11) NOT NULL,
  `TransactionDate` date NOT NULL,
  `TransactionPrice` bigint(20) NOT NULL,
  `TransactionProgress` tinyint(1) NOT NULL,
  `UsersId` int(11) NOT NULL,
  `TenantId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transactionheader`
--

INSERT INTO `transactionheader` (`TransactionId`, `TransactionDate`, `TransactionPrice`, `TransactionProgress`, `UsersId`, `TenantId`) VALUES
(1, '2023-06-07', 50000, 0, 8, 2),
(2, '2023-06-05', 20000, 0, 8, 4),
(4, '2023-06-01', 100000, 1, 8, 3),
(5, '2023-06-01', 100000, 0, 8, 3);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(3) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`) VALUES
(7, 'admin', '$2y$10$iusesomecrazystrings2u0s.7Uu7dRDQyLygbeI6Nisg4CfKtRlq', 'admin@gmail.com'),
(8, 'felix', '$2y$10$iusesomecrazystrings2uhB91MlWpGIP6pNsNYciRE5VvNMZtBaa', 'felix@gmail.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tenant`
--
ALTER TABLE `tenant`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `transactionheader`
--
ALTER TABLE `transactionheader`
  MODIFY `TransactionId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

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
