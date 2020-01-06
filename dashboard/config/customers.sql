-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 28, 2019 at 01:23 PM
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
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(11) NOT NULL,
  `name` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `phone` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `lastname` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL,
  `krapin` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `profile` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `name`, `user_id`, `phone`, `lastname`, `email`, `krapin`, `profile`, `address`) VALUES
(1, 'victor', 2, '714309973', NULL, NULL, NULL, NULL, NULL),
(2, 'test name', 3, '0714309973', NULL, NULL, NULL, NULL, NULL),
(3, 'victor', 2, '714309973', NULL, NULL, NULL, NULL, NULL),
(4, '', 6, '', NULL, NULL, NULL, NULL, NULL),
(5, '', 68, '', NULL, NULL, NULL, NULL, NULL),
(6, '', 71, '', NULL, NULL, NULL, NULL, NULL),
(7, '', 73, '', NULL, NULL, NULL, NULL, NULL),
(8, '', 75, '', NULL, NULL, NULL, NULL, NULL),
(9, '', 77, '', NULL, NULL, NULL, NULL, NULL),
(10, 'First supplier', 78, '714309973', NULL, NULL, NULL, NULL, NULL),
(11, 'victor', 79, '714309973', NULL, NULL, NULL, NULL, NULL),
(12, 'wwe', 80, 'qwe', NULL, NULL, NULL, NULL, NULL),
(13, 'gfgsvahjs', 81, '642378194763', NULL, NULL, NULL, NULL, NULL),
(14, 'Festus', 82, 'Kipkemoi', NULL, NULL, NULL, NULL, NULL),
(15, 'Festus', 83, '0704010956', NULL, NULL, NULL, NULL, NULL),
(16, 'Festus', 84, '0704010956', 'Festus', 'fkip@gmail.com', 'A009872417X', 'PROF.png', 'PHENOM ESTATE'),
(17, 'Jack', 86, '079588585', NULL, NULL, NULL, NULL, NULL),
(18, 'Mutai', 87, '070890899', 'Mutai', 'mutai@gmail.com', 'A119872417X', 'prof7.png', 'Embakasi police station'),
(19, 'Mercy', 88, '0704010957', 'Mercy', 'mercy@gmail.com', 'A109872417X', 'chebae.jpg', 'lifestyle terraces syokimau'),
(20, 'James', 89, '0709079856', 'Kariuki', 'james@gmail.com', 'A119872417X', NULL, 'Jericho'),
(21, 'Jane', 90, '0712345678', NULL, NULL, NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
