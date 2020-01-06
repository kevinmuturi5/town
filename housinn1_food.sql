-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 31, 2019 at 05:28 AM
-- Server version: 5.6.41-84.1
-- PHP Version: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `housinn1_food`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `category_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `category_description` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
(16, 'Festus', 84, '0704010959', 'Festus', 'fkip@gmail.com', 'A009872417X', 'prof7.png', 'PHENOM ESTATE'),
(17, 'Jack', 86, '079588585', NULL, NULL, NULL, NULL, NULL),
(18, 'Mutai', 87, '070890899', 'Mutai', 'mutai@gmail.com', 'A119872417X', 'prof7.png', 'Embakasi police station'),
(19, 'Mercy', 88, '0704010957', 'Mercy', 'mercy@gmail.com', 'A109872417X', 'prof3.jpg', 'lifestyle terraces syokimau'),
(20, 'James', 89, '0709079856', 'Kariuki', 'james@gmail.com', 'A119872417X', 'pic2.jpg', 'Jericho'),
(21, 'Jane', 90, '0712345678', 'Scant', 'jane@gmail.com', 'A129872417X', 'prof3.jpg', 'Westlands Emirates 4th Floor'),
(22, 'customer bram', 96, '0789856636', NULL, NULL, NULL, NULL, NULL);

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
(873, 84, 13, 5, 3, 'dfejb', 30, 'unconfirmed'),
(874, 84, 4, 12, 3, '', 19, 'confirmed'),
(875, 88, 22, 1, 5, 'YELLOW', 450, 'unconfirmed'),
(876, 84, 22, 7, 5, 'YELLOW', 450, 'confirmed'),
(877, 84, 14, 27, 3, 'jdbjsk', 10, 'unconfirmed'),
(878, 87, 14, 1, 3, 'jdbjsk', 10, 'confirmed'),
(879, 89, 13, 12, 3, 'dfejb', 60, 'unconfirmed'),
(880, 89, 4, 3, 3, '', 19, 'unconfirmed'),
(881, 89, 4, 3, 3, '', 1980, 'unconfirmed'),
(882, 89, 14, 2, 3, 'jdbjsk', 428, 'unconfirmed'),
(883, 89, 18, 13, 3, 'asf', 89, 'unconfirmed'),
(884, 88, 4, 2, 3, '', 1980, 'unconfirmed'),
(885, 84, 4, 2, 3, '', 1980, 'confirmed'),
(886, 90, 4, 4, 3, '', 1980, 'confirmed'),
(888, 88, 14, 3, 3, 'jdbjsk', 19, 'unconfirmed'),
(889, 87, 14, 5, 3, 'jdbjsk', 19, 'unconfirmed'),
(890, 92, 14, 2, 3, 'jdbjsk', 1980, 'unconfirmed'),
(891, 92, 22, 2, 5, 'YELLOW', 30, 'unconfirmed'),
(892, 92, 18, 5, 3, 'asf', 30, 'unconfirmed'),
(893, 4, 13, 6, 3, 'dfejb', 143, 'unconfirmed'),
(894, 84, 13, 2, 3, 'dfejb', 89, 'unconfirmed'),
(895, 84, 14, 4, 3, 'jdbjsk', 19, 'unconfirmed'),
(896, 84, 22, 1, 5, 'YELLOW', 30, 'unconfirmed');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `unit_description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `available` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `quantity` int(11) NOT NULL,
  `unit_price` float NOT NULL,
  `sku` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `images` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `color` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `size` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `other_desc` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `supplier_id`, `unit_description`, `available`, `description`, `quantity`, `unit_price`, `sku`, `images`, `color`, `size`, `other_desc`) VALUES
(4, 'Office Chair', 3, '', '', '', 0, 0, '12345', 'sit.jpg', '', '', ''),
(13, 'Pen', 3, '', '', 'dfejb', 23, 123, 'dd2kejf2', 'pen.jpg', 'fekwj', 'ddkfe', ''),
(14, 'Ream Papers', 3, '', '', 'jdbjsk', 9, 132, '748', 'ream.jpg', 'sdnbhv', '141', ''),
(18, 'Cellotape', 3, 'as', '', 'asf', 40, 100, '12345678', 'cellotape.png', '', '', ''),
(19, 'Papers', 5, '58', '', 'peofusdtu90we', 3, 1500, '6d2a0230', '', '', '', ''),
(20, 'cool product', 5, '12', '', 'cool', 2, 120, '5bd7f81d', '', '', '', ''),
(21, 'Milk', 3, '6', '', 'fdgf', 2, 60, 'a7407b91', '', '', '', ''),
(22, 'BOTTOM YELLOW', 5, '2', '', 'YELLOW', 2, 3100, '0a33363a', 'paper.jpg', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `product_description`
--

CREATE TABLE `product_description` (
  `id` int(11) NOT NULL,
  `color` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `quantity` int(255) NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `product_id` int(11) NOT NULL,
  `images` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `product_description`
--

INSERT INTO `product_description` (`id`, `color`, `quantity`, `description`, `product_id`, `images`) VALUES
(1, 'white', 10, 'These are ream papers', 1, ''),
(2, 'white', 10, 'These are ream papers', 2, ''),
(3, 'white', 10, 'These are ream papers', 3, ''),
(4, 'red', 2, 'lorem ipsj qw njqvqdwj behjs kq', 4, ''),
(5, 'white', 100, 'These are ream papers', 5, ''),
(6, 'White, Khaki', 20, 'High Quality Printing papers', 6, '120px_rainforest_bluemountainsnsw.jpg,180px_koala_ag1.jpg,180px_ormiston_pound.jpg,180px_wobbegong.jpg,');

-- --------------------------------------------------------

--
-- Table structure for table `product_suppliers`
--

CREATE TABLE `product_suppliers` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `location` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `pin` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `supplier_id` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `product_suppliers`
--

INSERT INTO `product_suppliers` (`id`, `name`, `phone`, `email`, `location`, `pin`, `supplier_id`) VALUES
(30, 'Joshua', '0726172684', 'joshua@yahoo.com', 'Amani', 'A0078747788J', '94'),
(34, 'desire', '073434346778', 'josh@yahoo.com', 'nairobi', 'A00234544J', '4');

-- --------------------------------------------------------

--
-- Table structure for table `purchases`
--

CREATE TABLE `purchases` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `receipt_number` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `quantity` int(255) NOT NULL,
  `total_price` float NOT NULL,
  `unit_price` float NOT NULL,
  `vat` float NOT NULL,
  `vat_pin` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sub_total` float NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `sku` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `STATUS` varchar(30) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'declared'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `purchases`
--

INSERT INTO `purchases` (`id`, `customer_id`, `name`, `receipt_number`, `description`, `quantity`, `total_price`, `unit_price`, `vat`, `vat_pin`, `sub_total`, `date`, `time`, `supplier_id`, `sku`, `STATUS`) VALUES
(99, 11, 'paper green', '5285598hj', 'black', 52, 115440, 2220, 15922.8, NULL, 99517.2, '2019-08-14', '20:20:00', 94, '8f1c1006', 'declared'),
(100, 11, 'bluemoon', '78987', 'blue', 1, 100, 100, 13.7931, NULL, 86.2069, '2019-02-20', '20:12:00', 94, 'b008dbc4', 'declared'),
(104, 11, 'PRODUCT', '788888', 'drammmer', 1, 1200, 1200, 165.517, NULL, 1034.48, '2019-08-22', '20:20:00', 94, 'e5dabd82', 'undeclared'),
(105, 11, 'paper millers', '78ctrb78', 'product new exist', 100, 100000, 1000, 13793.1, NULL, 86206.9, '2019-08-22', '12:20:00', 94, 'f6b9d468', 'declared'),
(106, 11, 'newest product', '47587445', 'product', 100, 22000, 220, 3034.48, NULL, 18965.5, '2018-02-20', '20:12:00', 94, '127f76bd', 'declared'),
(108, 3, 'new product', '74444htht', 'durable pieces', 40, 4000, 100, 551.724, NULL, 3448.28, '2019-08-14', '23:02:00', 4, 'cac7e09c', 'declared'),
(109, 3, 'new reams', '23333', 'new reams', 1, 299, 299, 41.2414, NULL, 257.759, '2019-08-14', '20:02:00', 4, '2e862748', 'declared'),
(110, 3, 'njugus melon', '900000899', 'njugus releevevvant', 7, 700, 100, 96.5517, NULL, 603.448, '2015-02-20', '22:00:00', 4, 'eb7b9bad', 'declared');

-- --------------------------------------------------------

--
-- Table structure for table `ready_sale`
--

CREATE TABLE `ready_sale` (
  `id` int(11) NOT NULL,
  `fraction` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `quantity` int(11) NOT NULL,
  `selling_price` float NOT NULL,
  `buying_price` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `sku` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `ready_sale`
--

INSERT INTO `ready_sale` (`id`, `fraction`, `quantity`, `selling_price`, `buying_price`, `sku`, `product_id`) VALUES
(7, '1/4', 0, 1980, '33', '748', 14),
(8, '1/8', 100, 19, '16.5', '748', 14),
(9, '0/1', 10, 0, '0', '12345678', 19),
(10, '1/4', 8, 30, '25', '12345678', 19),
(11, '1/3', 1, 56.6667, '33.333333333333', '12345678', 19),
(12, '1/2', 0, 70, '50', '12345678', 19),
(13, '1/2', 0, 60, '50', '12345678', 22),
(14, '1/4', 0, 30, '25', '12345678', 22),
(15, '1/8', 36, 393.75, '387.5', '70f31521', 20),
(16, '1/8', 5, 392.5, '387.5', '052ff413', 33),
(17, '1/4', 10, 30, '25', '12345678', 18),
(18, '1/2', 10, 110, '100', 'test', 34),
(19, '1/2', 0, 89, '61', 'dd2kejf2', 13),
(20, '1/8', 8, 427.5, '387.5', '2bb4b738', 35),
(21, '0/1', 1, 0, '0', '12345', 4),
(22, '0/1', 13, 10, '0', 'fdfj', 42),
(23, '0/1', 100, 50, '0', 'dd2kejf2', 13),
(24, '1/2', 0, 89, '61', 'dd2kejf2', 13),
(25, '1/2', 0, 10, '100', 'abd', 41),
(26, '0/1', 10, 10, '0', 'dd2kejf2', 13),
(27, '1/2', 0, 89, '61.5', 'dd2kejf2', 13),
(28, '1/1', 0, 143, '123', 'dd2kejf2', 13),
(29, '1/2', 90, 80, '75', '150', 43),
(30, '1/2', 9, 1650, '1550', '052ff413', 33),
(31, '1/2', 1, 4600, '4500', 'fdfj', 42),
(32, '1/8', 1, 28.75, '10', '3076bb14', 131);

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `id` int(11) NOT NULL,
  `receipt_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `product_id` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `product_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `sku` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `quantity` int(11) NOT NULL,
  `unit_price` float NOT NULL,
  `sub_total` float NOT NULL,
  `vat` float NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `customer_id` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `inv_date` datetime DEFAULT CURRENT_TIMESTAMP,
  `STATUS` varchar(30) COLLATE utf8_unicode_ci DEFAULT 'declared'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`id`, `receipt_id`, `product_id`, `product_name`, `sku`, `quantity`, `unit_price`, `sub_total`, `vat`, `supplier_id`, `customer_id`, `inv_date`, `STATUS`) VALUES
(1, '3030', '19', 'Papers', '12345678', 50, 150, 7500, 8700, 94, NULL, '2019-08-30 10:57:02', 'declared'),
(2, '3030', '19', 'Papers', '12345678', 10, 150, 1500, 1740, 94, NULL, '2019-08-30 10:57:02', 'declared'),
(3, '3030', NULL, 'name2', '748', 1, 100, 100, 116, 94, NULL, '2019-08-30 10:57:02', 'declared'),
(4, 'qwgy', NULL, 'ans', '748', 30, 20, 600, 696, 94, NULL, '2019-08-30 10:57:02', 'declared'),
(5, '3030', NULL, 'Print paperss', '748', 10, 130, 1300, 10, 94, NULL, '2019-08-30 10:57:02', 'declared'),
(6, '907', '4', 'Office Chair', '12345', 1, 0, 0, 0, 94, '84', '0000-00-00 00:00:00', 'undeclared'),
(7, '908', '13', 'Pen', 'dd2kejf2', 3, 123, 369, 59.04, 94, '84', '2019-08-30 11:57:27', 'declared'),
(8, '873', '13', 'Pen', 'dd2kejf2', 11, 123, 1353, 216.48, 94, '84', '2019-08-30 12:24:57', 'declared'),
(9, '902', '13', 'Pen', 'dd2kejf2', 8, 123, 984, 157.44, 94, '84', '2019-08-30 12:24:57', 'declared'),
(10, '908', '13', 'Pen', 'dd2kejf2', 9, 123, 1107, 177.12, 94, '84', '2019-08-30 12:24:57', 'declared'),
(11, '909', '13', 'Pen', 'dd2kejf2', 12, 123, 1476, 236.16, 3, '84', '2019-08-30 12:24:57', 'declared'),
(12, '910', '14', 'Ream Papers', '748', 1, 132, 132, 21.12, 3, '84', '2019-08-30 12:24:57', 'undeclared'),
(15, '874', '4', 'Office Chair', '12345', 16, 0, 0, 0, 3, '84', '2019-08-30 12:55:58', 'undeclared'),
(16, '885', '4', 'Office Chair', '12345', 6, 0, 0, 0, 3, '84', '2019-08-30 12:55:58', 'undeclared'),
(17, '903', '4', 'Office Chair', '12345', 6, 0, 0, 0, 3, '84', '2019-08-30 12:55:58', 'undeclared'),
(18, '906', '4', 'Office Chair', '12345', 2, 0, 0, 0, 3, '84', '2019-08-30 12:55:58', 'undeclared'),
(19, '907', '4', 'Office Chair', '12345', 2, 0, 0, 0, 3, '84', '2019-08-30 12:55:58', 'declared'),
(20, '911', '4', 'Office Chair', '12345', 2, 0, 0, 0, 3, '84', '2019-08-30 12:55:58', 'declared');

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `phone` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`id`, `name`, `user_id`, `phone`) VALUES
(1, 'victor', 1, '714309973'),
(2, 'victor', 3, '714309973'),
(3, 'supplier', 4, '0714309973'),
(4, 'Supplier A', 5, '0712345678'),
(5, 'wilson', 82, '0727831550'),
(6, 'test supplier', 83, '0714309973'),
(7, 'ABEL MURIITHI', 84, '+254770557761'),
(10, 'joshua mutua', 94, '0726172684'),
(17, 'Festus', 101, '0704010957');

-- --------------------------------------------------------

--
-- Table structure for table `ticket`
--

CREATE TABLE `ticket` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `type` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `type`, `username`, `password`) VALUES
(1, 1, 'victor@email.comaS', '$2y$10$xrafmFYqUed28g1/oUYq1.3rP.3oTX2/jahVktBrcGV5mXm9fSn46'),
(2, 1, 'victor', '$2y$10$eGbgTng.xOQOprPYV/zIHe.nvA4UIegZwKp/DUc0ehn3cQrr44mhO'),
(3, 2, 'victornguli', '$2y$10$DvYssBJP7yq1z9KWWoUFO.oAkFkySePRAf9xZlYkSxpu6h4uOxeSe'),
(4, 2, 'supplier', '$2y$10$ebYRj9nj9rYpZ/2miLUJjOP0hSg32jnsKJG9Bwna5PPcan6Y2GWsO'),
(5, 2, 'myusername', '$2y$10$IwjEFOWtatt4wjBZ1NvqU.ItnevhHi67AG.WjkOj9HEbFJN.MwXha'),
(78, 1, 'root', '$2y$10$ssSsO1gUiPMOVUDN7felCuw60Uu3onXV3k9Ar5.5nb0eeX6ehRhQW'),
(79, 1, 'username233', '$2y$10$TmB3BvoPAgrKZ80hdQq8seZDmb9m10yGqGGPpIZV2bG5LUjMaC96i'),
(80, 1, 'victorwefe', '$2y$10$0FsvwFZb611PeJjLH.9LAeYlhY77d6yPihfohe7W1wEz.pqQsVRf.'),
(81, 1, 'supplier2', '$2y$10$FSRO03S5A7CR4y4Yb5VsA.vzz0uV9FF3qoFjDdkwU9A6s2nGuct4a'),
(82, 1, 'fes@gmail.com', '$2y$10$orc/P2vG8f.6A77okqJsa.mxUacnI3EtCm3R4Y943ZL9JCFMsbj7u'),
(83, 1, 'fkipkemoi', '$2y$10$fuC6.yyBHCk7Pm4mSNoDbu4HF6jOdlttWmlL1WiNj7dy2.fPFBztm'),
(84, 1, 'fkip', '$2y$10$EawJreZeBWym34P4GaBAC.AYPZlcTAXQXRO4M3SH3sKpnV08dnrUu'),
(85, 2, 'fkipsupp', '$2y$10$wr1FYmIKtiE7gqzs5e0aNOKbW5dCRUAV9H2A.pLn7sysXst1nJeVK'),
(86, 1, 'jack', '$2y$10$2yMCRhgLp10vjwuT/nO7rOb0bfRnYSo7zqVKhad5YBhqLEGWECiia'),
(87, 1, 'cust', '$2y$10$oOZ3/.bhAWCPrutQej1R6.ZEHjQMkLv9ZRPhHc9Lj99UMRWK0k2Ga'),
(88, 1, 'mercy', '$2y$10$B.OhwYXwxR64BAh3wLEhhu./kunwrvm9n4oUhTP5daoqbh79kgqZ2'),
(89, 1, 'james', '$2y$10$UbjyYdDYOb0wPPobiJCfAuML7lvLM0MEYyka8adoZv9escaZMiyEO'),
(90, 1, 'jane', '$2y$10$rQ2npu5IrB/reCEakj5hc.i7e9PPPcHf3JQU6zTrZUGKQjiZWi3da'),
(91, 1, 'nicole', '$2y$10$Y2dKa7RPee9bI0XAr685Aed/xh5DG64JSSQGa3cGX.zOAUensFcjy'),
(92, 1, 'noah', '$2y$10$li.ktImYiWDmbxmOUKt97.Cqr8i1dCWwjwlxfO9Ln5uuZFcj9DB/C'),
(93, 2, 'willie', '$2y$10$BKShb.3H28S7xmCeT7EjOeVwVDFWnjjJfer7nUzyuws366QUW8N5.'),
(94, 1, 'Njure', '$2y$10$EG82fMTLpi42JwdgqO0PDeLTg6PtszCXCGz3RAy1.bq64T84qJ5g.'),
(95, 2, 'brams', '$2y$10$GHnRVQYnV1ixKMl0ItU6vOU5yq9TyMG4b10codN72AqNBIO6GfXsG'),
(96, 1, 'customerbram', '$2y$10$c9q9ORgGi0jrp2phWpTSrenz9SkFuSklVn8XNJsOXtuD/EiZtepIy');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_description`
--
ALTER TABLE `product_description`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `product_id` (`product_id`);

--
-- Indexes for table `product_suppliers`
--
ALTER TABLE `product_suppliers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchases`
--
ALTER TABLE `purchases`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ready_sale`
--
ALTER TABLE `ready_sale`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_id` (`user_id`);

--
-- Indexes for table `ticket`
--
ALTER TABLE `ticket`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=897;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `product_description`
--
ALTER TABLE `product_description`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `product_suppliers`
--
ALTER TABLE `product_suppliers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `purchases`
--
ALTER TABLE `purchases`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=111;

--
-- AUTO_INCREMENT for table `ready_sale`
--
ALTER TABLE `ready_sale`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `ticket`
--
ALTER TABLE `ticket`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=97;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
