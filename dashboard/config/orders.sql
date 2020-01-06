-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 28, 2019 at 01:22 PM
-- Server version: 10.1.35-MariaDB
-- PHP Version: 7.2.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `food`
--

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `units` int(11) NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `unit_description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `cost` int(255) NOT NULL,
  `status` varchar(20) COLLATE utf8_unicode_ci DEFAULT 'unconfirmed'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `customer_id`, `product_id`, `units`, `supplier_id`, `unit_description`, `cost`, `status`) VALUES
(847, 0, 4, 2, 3, '', 19, 'unconfirmed'),
(848, 0, 4, 1, 3, '', 19, 'unconfirmed'),
(849, 0, 4, 1, 3, '', 19, 'unconfirmed'),
(850, 0, 4, 1, 3, '', 1980, 'unconfirmed'),
(851, 87, 4, 7, 3, '', 1980, 'paid'),
(852, 87, 13, 4, 3, 'dfejb', 30, 'confirmed'),
(857, 0, 4, 1, 3, '', 19, 'unconfirmed'),
(858, 0, 4, 1, 3, '', 19, 'unconfirmed'),
(859, 0, 4, 1, 3, '', 19, 'unconfirmed'),
(860, 0, 4, 1, 3, '', 19, 'unconfirmed'),
(861, 0, 4, 1, 3, '', 19, 'unconfirmed'),
(862, 0, 4, 1, 3, '', 19, 'unconfirmed'),
(863, 0, 4, 1, 3, '', 0, 'unconfirmed'),
(864, 0, 4, 1, 3, '', 0, 'unconfirmed'),
(865, 0, 4, 1, 3, '', 19, 'unconfirmed'),
(866, 85, 4, 1, 3, '', 1980, 'unconfirmed'),
(873, 84, 13, 4, 3, 'dfejb', 30, 'confirmed'),
(874, 84, 4, 12, 3, '', 19, 'confirmed'),
(875, 88, 22, 1, 5, 'YELLOW', 450, 'unconfirmed'),
(876, 84, 22, 7, 5, 'YELLOW', 450, 'confirmed'),
(877, 84, 14, 24, 3, 'jdbjsk', 10, 'confirmed'),
(878, 87, 14, 1, 3, 'jdbjsk', 10, 'confirmed'),
(879, 89, 13, 19, 3, 'dfejb', 60, 'unconfirmed'),
(880, 89, 4, 2, 3, '', 19, 'unconfirmed'),
(881, 89, 4, 2, 3, '', 1980, 'unconfirmed'),
(882, 89, 14, 5, 3, 'jdbjsk', 428, 'unconfirmed'),
(883, 89, 18, 5, 3, 'asf', 89, 'unconfirmed'),
(884, 88, 4, 2, 3, '', 1980, 'unconfirmed'),
(885, 84, 4, 2, 3, '', 1980, 'confirmed'),
(886, 90, 4, 4, 3, '', 1980, 'confirmed');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=887;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
