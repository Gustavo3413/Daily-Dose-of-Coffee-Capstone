-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 05, 2023 at 05:18 AM
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
(1, 'Gustavo', 'contact@try.com', 1119999999, 'Hi, this is a teste message. Thank you!');

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
-- Table structure for table `menu_coffeeshop`
--

CREATE TABLE `menu_coffeeshop` (
  `productid` int(11) NOT NULL,
  `description` varchar(200) DEFAULT NULL,
  `price` decimal(4,2) NOT NULL,
  `discount` decimal(4,2) DEFAULT NULL,
  `coffeeshop_img` varchar(300) DEFAULT NULL,
  `stock` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `menu_coffeeshop`
--

INSERT INTO `menu_coffeeshop` (`productid`, `description`, `price`, `discount`, `coffeeshop_img`, `stock`, `name`) VALUES
(1, 'The best hot chocolate in town.', 4.00, NULL, 'images/cold4.png', 100, 'Hot Chocolate'),
(2, 'Our original blend of selected beans.', 4.00, NULL, 'images/c6.png', 100, 'Black Coffee'),
(3, 'Our original blend of selected beans with a taste of chocolate and whiped cream.', 5.00, NULL, 'images/c1.png', 100, 'Capuccino');

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
,`coffeeshop_img` varchar(300)
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
  `coffeeshop_img` varchar(300) DEFAULT NULL,
  `stock` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products_coffeeshop`
--

INSERT INTO `products_coffeeshop` (`productid`, `description`, `price`, `discount`, `coffeeshop_img`, `stock`, `name`) VALUES
(1, NULL, 15.00, NULL, 'images/packagewhite.png', 100, 'Light roast ground coffee'),
(2, NULL, 15.00, NULL, 'images/packagebrown.png', 100, 'Medium roast ground coffee'),
(3, NULL, 15.00, NULL, 'images/packageblack.png', 100, 'Dark roasr ground coffee');

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `saleid` int(11) NOT NULL,
  `delivererid` int(11) DEFAULT NULL,
  `userid` int(11) NOT NULL,
  `productid` int(11) NOT NULL,
  `time` datetime NOT NULL DEFAULT current_timestamp(),
  `price` decimal(3,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`saleid`, `delivererid`, `userid`, `productid`, `time`, `price`) VALUES
(1, NULL, 2, 3, '2023-12-04 22:55:39', 0.00),
(2, NULL, 2, 2, '2023-12-04 22:55:39', 0.00),
(3, NULL, 2, 2, '2023-12-04 22:55:39', 0.00),
(4, NULL, 2, 1, '2023-12-04 22:55:39', 0.00),
(5, NULL, 2, 2, '2023-12-04 22:55:39', 0.00),
(6, NULL, 2, 1, '2023-12-04 22:55:39', 0.00),
(7, NULL, 2, 2, '2023-12-04 22:55:39', 0.00),
(8, NULL, 2, 1, '2023-12-04 22:55:39', 0.00),
(9, NULL, 2, 2, '2023-12-04 22:55:39', 0.00),
(10, NULL, 2, 1, '2023-12-04 22:55:39', 0.00),
(11, NULL, 2, 2, '2023-12-04 22:55:39', 0.00),
(12, NULL, 2, 1, '2023-12-04 22:55:39', 0.00),
(13, NULL, 2, 2, '2023-12-04 22:55:39', 0.00),
(14, NULL, 2, 1, '2023-12-04 22:55:39', 0.00),
(15, NULL, 2, 2, '2023-12-04 22:55:39', 0.00),
(16, NULL, 2, 1, '2023-12-04 22:55:39', 0.00),
(17, NULL, 2, 2, '2023-12-04 22:55:39', 0.00),
(18, NULL, 2, 1, '2023-12-04 22:55:39', 0.00),
(19, NULL, 2, 2, '2023-12-04 22:55:39', 0.00),
(20, NULL, 2, 1, '2023-12-04 22:55:39', 0.00),
(21, NULL, 2, 2, '2023-12-04 22:55:39', 0.00),
(22, NULL, 2, 1, '2023-12-04 22:55:39', 0.00),
(23, NULL, 2, 2, '2023-12-04 22:55:39', 0.00),
(24, NULL, 2, 1, '2023-12-04 22:55:39', 0.00),
(25, NULL, 2, 1, '2023-12-04 22:56:37', 0.00),
(26, NULL, 2, 2, '2023-12-04 22:56:37', 0.00),
(27, NULL, 2, 1, '2023-12-04 22:57:19', 0.00),
(28, NULL, 2, 2, '2023-12-04 22:57:19', 0.00),
(29, NULL, 2, 1, '2023-12-04 22:57:45', 0.00),
(30, NULL, 2, 2, '2023-12-04 22:57:45', 0.00),
(31, NULL, 2, 1, '2023-12-04 22:57:52', 0.00),
(32, NULL, 2, 2, '2023-12-04 22:57:52', 0.00),
(33, NULL, 2, 1, '2023-12-04 22:57:57', 0.00),
(34, NULL, 2, 2, '2023-12-04 22:57:57', 0.00),
(35, NULL, 2, 1, '2023-12-04 22:58:17', 0.00),
(36, NULL, 2, 2, '2023-12-04 22:58:17', 0.00),
(37, NULL, 2, 1, '2023-12-04 23:04:04', 4.00),
(38, NULL, 2, 2, '2023-12-04 23:04:04', 4.00);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userid` int(11) NOT NULL,
  `username` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  `address` varchar(200) DEFAULT NULL,
  `registration_date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userid`, `username`, `email`, `password`, `address`, `registration_date`) VALUES
(2, 'Gustavo', 'example@example.com', '1234', NULL, '2023-11-01'),
(3, 'James', 'james@example.com', 'aaaaa', NULL, '2023-11-01'),
(4, 'Peter', 'peter@example.com', '1234', NULL, '2023-11-01'),
(5, 'test', 'test123@gmail.com', '1234', NULL, '2023-11-08'),
(6, 'Mike', 'mike@example.com', '1234', NULL, '2023-11-22'),
(7, 'example', 'example@conestoga.com', '1234', NULL, '2023-11-22');

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
-- Indexes for table `menu_coffeeshop`
--
ALTER TABLE `menu_coffeeshop`
  ADD PRIMARY KEY (`productid`),
  ADD KEY `name_idx` (`name`);

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
  ADD KEY `userid_idx` (`userid`),
  ADD KEY `productid_idx1` (`productid`);

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
-- AUTO_INCREMENT for table `menu_coffeeshop`
--
ALTER TABLE `menu_coffeeshop`
  MODIFY `productid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `products_coffeeshop`
--
ALTER TABLE `products_coffeeshop`
  MODIFY `productid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `saleid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `sales`
--
ALTER TABLE `sales`
  ADD CONSTRAINT `delivererid` FOREIGN KEY (`delivererid`) REFERENCES `deliverers` (`delivererid`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `productid` FOREIGN KEY (`productid`) REFERENCES `menu_coffeeshop` (`productid`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `userid` FOREIGN KEY (`userid`) REFERENCES `users` (`userid`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
