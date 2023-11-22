-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 09, 2023 at 10:24 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `capstone_group_6`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_users`
--

CREATE TABLE `admin_users` (
  `adminid` int(11) NOT NULL,
  `email` varchar(45) NOT NULL,
  `name` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `contact_us`
--

CREATE TABLE `contact_us` (
  `formid` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `phone` int(13) NOT NULL,
  `message` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact_us`
--

INSERT INTO `contact_us` (`formid`, `name`, `email`, `phone`, `message`) VALUES
(1, 'Gustavo', 'contact@try.com', 1119999999, 'Hi, this is a test message. Thank you!');

-- --------------------------------------------------------

--
-- Table structure for table `deliverers`
--

CREATE TABLE `deliverers` (
  `delivererid` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `address` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `bank` varchar(45) NOT NULL,
  `bank_branch` varchar(45) NOT NULL,
  `bank_account` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Stand-in structure for view `nostock`
-- (See below for the actual view)
--
CREATE TABLE `nostock` (
`productid` int(11)
,`description` varchar(200)
,`price` decimal(4,2)
,`discount` decimal(4,2)
,`coffeeshop_img` blob
,`stock` int(10) unsigned
,`name` varchar(100)
);

-- --------------------------------------------------------

--
-- Table structure for table `products_coffeeshop`
--

CREATE TABLE `products_coffeeshop` (
  `productid` int(11) NOT NULL,
  `description` varchar(200) DEFAULT NULL,
  `price` decimal(4,2) NOT NULL,
  `discount` decimal(4,2) DEFAULT NULL,
  `coffeeshop_img` blob DEFAULT NULL,
  `stock` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products_coffeeshop`
--

INSERT INTO `products_coffeeshop` (`productid`, `description`, `price`, `discount`, `coffeeshop_img`, `stock`, `name`) VALUES
(1, 'The best hot chocolate in town.', 4.00, NULL, NULL, 100, 'Hot Chocolate'),
(2, 'Our original blend of selected beans.', 4.00, NULL, NULL, 100, 'Black Coffee'),
(3, 'Our original blend of selected beans with a taste of chocolate and whiped cream.', 5.00, NULL, NULL, 100, 'Capuccino'),
(4, 'Test product', 3.00, NULL, NULL, 0, 'Test');

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `saleid` int(11) NOT NULL,
  `delivererid` int(11) DEFAULT NULL,
  `userid` int(11) NOT NULL,
  `productid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userid` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  `address` varchar(200) DEFAULT NULL,
  `registration_date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userid`, `name`, `email`, `password`, `address`, `registration_date`) VALUES
(2, 'Gustavo', 'example@example.com', '1234', NULL, '2023-11-01'),
(3, 'James', 'james@example.com', 'aaaaa', NULL, '2023-11-01'),
(4, 'Peter', 'peter@example.com', '1234', NULL, '2023-11-01'),
(5, 'test', 'test123@gmail.com', '1234', NULL, '2023-11-08');

-- --------------------------------------------------------

--
-- Structure for view `nostock`
--
DROP TABLE IF EXISTS `nostock`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `nostock`  AS SELECT `products_coffeeshop`.`productid` AS `productid`, `products_coffeeshop`.`description` AS `description`, `products_coffeeshop`.`price` AS `price`, `products_coffeeshop`.`discount` AS `discount`, `products_coffeeshop`.`coffeeshop_img` AS `coffeeshop_img`, `products_coffeeshop`.`stock` AS `stock`, `products_coffeeshop`.`name` AS `name` FROM `products_coffeeshop` WHERE `products_coffeeshop`.`stock` = 0 ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_users`
--
ALTER TABLE `admin_users`
  ADD PRIMARY KEY (`adminid`),
  ADD UNIQUE KEY `adminid_UNIQUE` (`adminid`);

--
-- Indexes for table `contact_us`
--
ALTER TABLE `contact_us`
  ADD PRIMARY KEY (`formid`);

--
-- Indexes for table `deliverers`
--
ALTER TABLE `deliverers`
  ADD PRIMARY KEY (`delivererid`);

--
-- Indexes for table `products_coffeeshop`
--
ALTER TABLE `products_coffeeshop`
  ADD PRIMARY KEY (`productid`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`saleid`),
  ADD KEY `delivererid_idx` (`delivererid`),
  ADD KEY `productid_idx` (`productid`),
  ADD KEY `userid_idx` (`userid`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_users`
--
ALTER TABLE `admin_users`
  MODIFY `adminid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `contact_us`
--
ALTER TABLE `contact_us`
  MODIFY `formid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `deliverers`
--
ALTER TABLE `deliverers`
  MODIFY `delivererid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products_coffeeshop`
--
ALTER TABLE `products_coffeeshop`
  MODIFY `productid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `saleid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `sales`
--
ALTER TABLE `sales`
  ADD CONSTRAINT `delivererid` FOREIGN KEY (`delivererid`) REFERENCES `deliverers` (`delivererid`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `productid` FOREIGN KEY (`productid`) REFERENCES `products_coffeeshop` (`productid`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `userid` FOREIGN KEY (`userid`) REFERENCES `users` (`userid`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
