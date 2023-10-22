-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 22, 2023 at 06:44 AM
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
-- Database: `product_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `cravings_table`
--

CREATE TABLE `cravings_table` (
  `id` int(11) NOT NULL,
  `product_name` varchar(255) DEFAULT NULL,
  `product_image` varchar(255) DEFAULT NULL,
  `product_size` varchar(50) NOT NULL,
  `price` double DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `cravings_table`
--

INSERT INTO `cravings_table` (`id`, `product_name`, `product_image`, `product_size`, `price`) VALUES
(1, 'Milktea 1', 'assets/img/Website/1.png', 'Medium', 60),
(2, 'Milktea 1', 'assets/img/Website/1.png', 'Large', 70),
(3, 'Milktea 2', 'assets/img/Website/2.png', 'Medium', 60),
(4, 'Milktea 2', 'assets/img/Website/2.png', 'Large', 70),
(5, 'Milktea 3', 'assets/img/Website/3.png', 'Medium', 60),
(6, 'Milktea 3', 'assets/img/Website/3.png', 'Large', 70),
(7, 'Milktea 4', 'assets/img/Website/4.png', 'Small', 25),
(8, 'Milktea 4', 'assets/img/Website/4.png', 'Medium', 35),
(9, 'Milktea 4', 'assets/img/Website/4.png', 'Large', 45),
(10, 'Milktea 5', 'assets/img/Website/5.png', 'Small', 25),
(11, 'Milktea 5', 'assets/img/Website/5.png', 'Medium', 35),
(12, 'Milktea 5', 'assets/img/Website/5.png', 'Large', 45),
(13, 'Milktea 6', 'assets/img/Website/6.png', 'Small', 25),
(14, 'Milktea 6', 'assets/img/Website/6.png', 'Medium', 35),
(15, 'Milktea 6', 'assets/img/Website/6.png', 'Large', 45),
(16, 'Beefy Mushroom', 'assets/img/Website/beffymushroom.png', 'Regular', 98),
(17, 'Ham and Cheese', 'assets/img/Website/ham_cheese.png', 'Regular', 78),
(18, 'Hawaiiyan', 'assets/img/Website/hawaiyan.png', 'Regular', 88),
(19, 'Meat Lovers', 'assets/img/Website/meat lovers.png', 'Regular', 118),
(20, 'Pepperoni', 'assets/img/Website/pepperoni.png', 'Regular', 88),
(40, 'milktea 7', 'assets/img/Website/7.png', 'Small', 35),
(41, 'milktea 8', 'assets/img/Website/8.png', 'large', 75),
(42, 'milktea 9', 'assets/img/Website/1.png', 'large', 75),
(44, 'milktea 9', 'assets/img/Website/1.png', 'large', 75);

-- --------------------------------------------------------

--
-- Table structure for table `order_table`
--

CREATE TABLE `order_table` (
  `email` varchar(255) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_image` varchar(255) NOT NULL,
  `product_size` varchar(55) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` bigint(20) NOT NULL,
  `total` bigint(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `order_table`
--

INSERT INTO `order_table` (`email`, `order_id`, `product_name`, `product_image`, `product_size`, `quantity`, `price`, `total`) VALUES
('', 1, 'Milktea 1', 'assets/img/Website/1.png', 'Medium', 3, 60, 180),
('', 18, 'Milktea 3', 'assets/img/Website/3.png', 'Large', 2, 70, 140),
('', 14, 'Milktea 1', 'assets/img/Website/1.png', 'Large', 4, 70, 280);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cravings_table`
--
ALTER TABLE `cravings_table`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_table`
--
ALTER TABLE `order_table`
  ADD PRIMARY KEY (`order_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cravings_table`
--
ALTER TABLE `cravings_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `order_table`
--
ALTER TABLE `order_table`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
