-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 09, 2024 at 10:00 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shop_coffee`
--

-- --------------------------------------------------------

--
-- Table structure for table `bill`
--

CREATE TABLE `bill` (
  `id_bill` int(10) NOT NULL,
  `id_emp` int(10) NOT NULL,
  `total_price` int(11) NOT NULL,
  `status` varchar(25) NOT NULL,
  `order_date` datetime NOT NULL,
  `type` varchar(25) NOT NULL,
  `id_table` int(11) DEFAULT NULL,
  `slip` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `bill`
--

INSERT INTO `bill` (`id_bill`, `id_emp`, `total_price`, `status`, `order_date`, `type`, `id_table`, `slip`) VALUES
(13, 1, 185, 'Paid', '2023-11-11 10:12:11', 'Cash', 8, NULL),
(14, 1, 180, 'Paid', '2023-11-12 10:50:30', 'M-Banking', 9, NULL),
(15, 1, 170, 'Paid', '2023-11-15 09:21:55', 'Cash', 4, NULL),
(17, 1, 130, 'Paid', '0203-11-15 10:25:24', 'Cash', 1, NULL),
(18, 1, 50, 'Paid', '0203-11-16 09:25:24', 'Cash', 9, NULL),
(19, 1, 90, 'Paid', '0203-11-16 10:26:56', 'Cash', 5, NULL),
(20, 1, 140, 'Paid', '2023-11-22 09:30:04', 'M-Banking', 5, NULL),
(21, 1, 100, 'Paid', '2023-11-22 09:41:44', 'Cash', 4, NULL),
(22, 1, 70, 'Paid', '2023-11-22 12:44:26', 'M-Banking', 3, NULL),
(23, 1, 165, 'Paid', '2023-11-22 13:28:48', 'M-Banking', 1, NULL),
(24, 1, 185, 'Paid', '2023-11-23 09:38:18', 'Cash', 4, NULL),
(25, 1, 50, 'Paid', '2023-11-23 09:58:05', 'Cash', 1, NULL),
(26, 1, 140, 'Paid', '2023-11-24 09:00:13', 'Cash', 8, NULL),
(27, 1, 115, 'Paid', '2023-11-24 13:05:42', 'Cash', 10, NULL),
(28, 1, 80, 'Paid', '2023-11-25 09:16:42', 'Cash', 10, NULL),
(29, 1, 100, 'Paid', '2023-11-25 10:25:12', 'Cash', 10, NULL),
(30, 1, 190, 'Paid', '2023-11-26 13:00:00', 'M-Banking', 6, NULL),
(37, 1, 40, 'Paid', '2023-12-21 14:17:20', 'Cash', 2, NULL),
(38, 1, 75, 'Paid', '2023-12-22 02:41:16', 'M-Banking', 1, NULL),
(39, 1, 0, 'not paid', '2023-12-22 02:57:39', '', 10, NULL),
(40, 1, 85, 'Paid', '2023-12-22 02:59:46', 'Cash', 6, NULL),
(42, 1, 155, 'Paid', '0000-00-00 00:00:00', 'Cash', 10, NULL),
(43, 1, 150, 'Paid', '2023-12-22 03:12:05', 'Cash', 4, NULL),
(44, 1, 140, 'Paid', '2024-02-23 02:30:48', 'Cash', 10, NULL),
(45, 1, 0, 'not paid', '2024-02-23 02:35:10', '', 10, NULL),
(46, 1, 75, 'Paid', '2024-02-23 02:36:44', 'Cash', 10, NULL),
(47, 1, 220, 'Paid', '2024-02-23 02:38:23', 'M-Banking', 10, NULL),
(52, 1, 130, 'Paid', '2024-02-23 20:10:59', 'M-Banking', 1, 'slip/663214d617c60_420507944_788959489802346_5450706599034602964_n.jpg'),
(54, 1, 45, 'Paid', '2024-02-23 22:10:57', 'Cash', 9, NULL),
(55, 1, 0, 'not paid', '2024-02-27 20:23:50', '', 6, NULL),
(57, 1, 100, 'Paid', '2024-03-21 15:02:11', 'M-Banking', 10, NULL),
(58, 1, 40, 'Paid', '2024-04-01 12:12:46', 'Cash', 10, NULL),
(59, 1, 0, 'not paid', '2024-04-23 13:45:36', '', 10, NULL),
(60, 1, 100, 'Paid', '2024-04-23 14:03:12', 'Cash', 10, NULL),
(61, 1, 185, 'Paid', '2024-04-23 15:05:03', 'Cash', 10, NULL),
(62, 1, 90, 'Paid', '2024-04-23 15:23:02', 'Cash', 10, NULL),
(63, 1, 85, 'Paid', '2024-04-23 15:28:01', 'Cash', 10, NULL),
(64, 1, 120, 'Paid', '2024-04-23 15:29:30', 'Cash', 10, NULL),
(68, 1, 135, 'Paid', '2024-04-23 15:37:22', 'M-Banking', 10, 'slip/663214d617c60_420507944_788959489802346_5450706599034602964_n.jpg'),
(69, 1, 130, 'Paid', '2024-04-23 15:48:16', 'Cash', 10, NULL),
(72, 1, 0, 'not paid', '2024-04-23 16:20:38', '', 10, NULL),
(73, 1, 40, 'Paid', '2024-04-23 16:22:22', 'Cash', 2, NULL),
(74, 1, 0, 'not paid', '2024-04-23 16:23:26', '', 10, NULL),
(78, 1, 50, 'Paid', '2024-04-26 11:36:47', 'Cash', 10, NULL),
(79, 1, 145, 'Paid', '2024-04-26 11:41:09', 'M-Banking', 10, 'slip663214e48a496_420507944_788959489802346_5450706599034602964_n.jpg'),
(80, 1, 165, 'Paid', '2024-04-26 15:03:09', 'M-Banking', 10, 'slip/transfer.jpg'),
(81, 1, 0, 'not paid', '2024-04-26 15:18:30', '', 10, NULL),
(82, 1, 0, 'not paid', '2024-04-26 15:32:41', '', 10, NULL),
(83, 1, 0, 'not paid', '2024-05-09 13:30:47', '', 10, NULL),
(84, 1, 480, 'Paid', '2024-05-09 13:32:07', 'Cash', 10, NULL),
(85, 1, 95, 'Paid', '2024-05-09 13:55:25', 'M-Banking', 10, NULL),
(87, 1, 0, 'not paid', '2024-05-09 14:15:09', '', 10, NULL),
(88, 1, 0, 'not paid', '2024-05-09 14:20:22', '', 10, NULL),
(90, 1, 110, 'Paid', '2024-05-09 14:23:42', 'Cash', 10, NULL),
(91, 1, 340, 'Paid', '2024-05-09 14:24:16', 'Cash', 9, NULL),
(92, 1, 130, 'Paid', '2024-05-09 14:26:33', 'Cash', 3, NULL),
(93, 1, 85, 'Paid', '2024-05-09 14:34:13', 'Cash', 10, NULL),
(94, 1, 400, 'Paid', '2024-05-09 14:35:15', 'Cash', 8, NULL),
(95, 1, 240, 'Paid', '2024-05-09 14:40:35', 'M-Banking', 10, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `data_common`
--

CREATE TABLE `data_common` (
  `id` int(11) NOT NULL,
  `pic1` varchar(255) DEFAULT NULL,
  `pic2` varchar(255) DEFAULT NULL,
  `pic3` varchar(255) DEFAULT NULL,
  `pic4` varchar(255) DEFAULT NULL,
  `map` varchar(255) DEFAULT NULL,
  `ig` varchar(255) DEFAULT NULL,
  `facebook` varchar(255) DEFAULT NULL,
  `tel` varchar(255) DEFAULT NULL,
  `name1` varchar(255) DEFAULT NULL,
  `name2` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `data_common`
--

INSERT INTO `data_common` (`id`, `pic1`, `pic2`, `pic3`, `pic4`, `map`, `ig`, `facebook`, `tel`, `name1`, `name2`) VALUES
(0, 'pic_me\\icon_coffe.png', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `id_emp` int(10) NOT NULL,
  `username` varchar(25) NOT NULL,
  `password` varchar(25) NOT NULL,
  `name` varchar(70) NOT NULL,
  `tel` varchar(10) NOT NULL,
  `type` varchar(10) NOT NULL,
  `status` varchar(20) NOT NULL,
  `create_at` datetime NOT NULL,
  `update_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`id_emp`, `username`, `password`, `name`, `tel`, `type`, `status`, `create_at`, `update_at`) VALUES
(1, 'Thekot', 'admin', 'Nattawat Imthong', '0980939604', 'Manager', 'Manager', '2024-02-07 10:35:20', '2024-02-08 11:36:12'),
(3, 'kotji', '1234', 'Kot Ji', '0987624213', 'admin', 'Resign', '2024-02-08 11:45:53', '2024-04-23 10:34:27'),
(4, 'admin', 'admin', 'nattawat imthong', '0877712345', 'admin', 'Working', '2024-02-15 13:22:49', '2024-02-15 13:22:49'),
(5, 'nop', '123123123', 'nopporn', '0872223323', 'admin', 'Working', '2024-02-23 19:46:35', '2024-04-23 02:25:12'),
(6, 'Hello', '1234', 'Hello', '0871234561', 'admin', 'Working', '2024-02-23 20:20:37', '2024-02-23 20:20:37'),
(14, 'Thenatta', '12345678', 'tok', '0879412334', 'admin', 'Working', '2024-04-09 16:30:12', '2024-04-09 16:30:12'),
(16, 'newbie', '12345678', 'NewBies', '0987654321', 'admin', 'Working', '2024-04-26 15:30:10', '2024-04-26 15:30:10');

-- --------------------------------------------------------

--
-- Table structure for table `order_detail`
--

CREATE TABLE `order_detail` (
  `id` int(11) NOT NULL,
  `id_bill` int(11) NOT NULL,
  `id_product` int(11) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `comment` varchar(50) DEFAULT NULL,
  `status` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `order_detail`
--

INSERT INTO `order_detail` (`id`, `id_bill`, `id_product`, `qty`, `price`, `comment`, `status`) VALUES
(54, 13, 7, 1, 55, NULL, 'Success'),
(55, 13, 8, 1, 45, NULL, 'Success'),
(56, 13, 19, 1, 40, NULL, 'Success'),
(57, 13, 21, 1, 45, 'Add Sweet 25%', 'Success'),
(58, 14, 2, 1, 45, 'Low Sweet 25%', 'Success'),
(59, 14, 1, 2, 45, NULL, 'Success'),
(60, 14, 6, 1, 30, NULL, 'Success'),
(61, 14, 30, 1, 15, NULL, 'Success'),
(62, 15, 26, 1, 45, NULL, 'Success'),
(63, 15, 25, 2, 25, NULL, 'Success'),
(64, 15, 22, 3, 15, NULL, 'Success'),
(65, 15, 27, 1, 30, 'Add Sweet 50%', 'Success'),
(66, 17, 21, 1, 45, NULL, 'Success'),
(67, 17, 18, 1, 45, NULL, 'Success'),
(68, 17, 15, 1, 40, NULL, 'Success'),
(69, 18, 17, 1, 50, 'No Sweet', 'Success'),
(70, 19, 17, 1, 50, 'No Sweet', 'Success'),
(71, 19, 14, 2, 20, NULL, 'Success'),
(72, 20, 20, 1, 45, NULL, 'Success'),
(73, 20, 1, 1, 40, NULL, 'Success'),
(74, 20, 7, 1, 55, NULL, 'Success'),
(76, 22, 18, 1, 50, NULL, 'Success'),
(77, 22, 13, 1, 20, NULL, 'Success'),
(78, 23, 27, 1, 30, NULL, 'Success'),
(79, 23, 26, 1, 45, 'Add Sweet 25%', 'Success'),
(80, 23, 29, 1, 40, NULL, 'Success'),
(81, 23, 12, 1, 50, NULL, 'Success'),
(85, 24, 16, 1, 45, NULL, 'Success'),
(86, 24, 17, 2, 50, NULL, 'Success'),
(87, 24, 19, 1, 40, NULL, 'Success'),
(88, 25, 17, 1, 50, NULL, 'Success'),
(89, 26, 8, 1, 45, NULL, 'Success'),
(90, 26, 1, 1, 45, NULL, 'Success'),
(91, 26, 17, 1, 50, NULL, 'Success'),
(92, 27, 4, 1, 30, NULL, 'Success'),
(93, 27, 6, 1, 30, NULL, 'Success'),
(94, 27, 10, 1, 55, NULL, 'Success'),
(95, 28, 11, 1, 35, NULL, 'Success'),
(96, 28, 16, 1, 45, NULL, 'Success'),
(97, 29, 17, 2, 50, NULL, 'Success'),
(98, 30, 14, 2, 20, NULL, 'Success'),
(99, 30, 16, 1, 45, NULL, 'Success'),
(100, 30, 20, 1, 45, NULL, 'Success'),
(101, 30, 24, 1, 35, NULL, 'Success'),
(102, 30, 25, 1, 25, NULL, 'Success'),
(164, 37, 2, 1, 40, '', 'Success'),
(166, 38, 2, 1, 40, '', 'Success'),
(167, 38, 23, 1, 35, '', 'Success'),
(170, 40, 20, 1, 45, '', 'Success'),
(171, 40, 2, 1, 40, '', 'Success'),
(174, 42, 10, 2, 60, 'add sweet 50%', 'Success'),
(175, 42, 28, 1, 35, 'add sweet 25%', 'Success'),
(177, 43, 17, 3, 50, 'No Sweet', 'Success'),
(179, 44, 1, 2, 45, 'add sweet 100%', 'Success'),
(180, 44, 17, 1, 50, '', 'Success'),
(187, 46, 16, 1, 40, '', 'Success'),
(188, 46, 1, 1, 35, '', 'Success'),
(190, 47, 1, 1, 35, '', 'Success'),
(191, 47, 1, 1, 35, 'add sweet 25%', 'Success'),
(192, 47, 17, 2, 50, '', 'Success'),
(193, 47, 17, 1, 50, 'add sweet 25%', 'Success'),
(195, 52, 1, 1, 45, 'add sweet 50%', 'Success'),
(196, 52, 16, 1, 40, '', 'Success'),
(197, 52, 16, 1, 45, '', 'Success'),
(200, 54, 17, 1, 45, '', 'Success'),
(204, 57, 17, 1, 50, 'add sweet 100%', 'Success'),
(205, 57, 17, 1, 50, 'add sweet 25%', 'Success'),
(207, 58, 16, 1, 40, 'add sweet 25%', 'Success'),
(210, 60, 17, 1, 50, 'Double Shot +40 Bath', 'Success'),
(211, 60, 17, 1, 50, 'Double Shot +40 Bath', 'Success'),
(213, 61, 20, 1, 45, 'add sweet 25%', 'Success'),
(214, 61, 20, 1, 45, 'add sweet 25%', 'Success'),
(215, 61, 17, 1, 45, 'Double Shot +40 Bath', 'Success'),
(216, 61, 1, 1, 50, 'Wip Cheese +20 Bath', 'Success'),
(218, 62, 1, 1, 40, 'Wip Cheese +20 Bath', 'Success'),
(219, 62, 26, 1, 50, 'Wip Cheese +20 Bath', 'Success'),
(221, 63, 17, 1, 45, 'Double Shot +40 Bath', 'Success'),
(222, 63, 18, 1, 40, 'Single Shot +20 Bath', 'Success'),
(224, 64, 1, 1, 60, 'Milk Pudding +10 Bath', 'Success'),
(225, 64, 1, 1, 60, 'Milk Pudding +10 Bath', 'Success'),
(234, 68, 16, 1, 40, '', 'Success'),
(235, 68, 24, 1, 35, '', 'Success'),
(236, 68, 1, 1, 60, 'Milk Pudding +10 Bath', 'Success'),
(238, 69, 1, 1, 60, 'Milk Pudding +10 Bath', 'Success'),
(239, 69, 17, 1, 70, 'Single Shot +20 Bath', 'Success'),
(247, 73, 16, 1, 40, '', 'Success'),
(261, 79, 1, 1, 60, 'Milk Pudding +10 Bath', 'Success'),
(262, 79, 1, 1, 55, 'Milk Pudding +10 Bath', 'Success'),
(263, 79, 27, 1, 30, 'Bubble +5 Bath', 'Success'),
(265, 80, 18, 1, 45, 'add sweet 50%', 'Success'),
(266, 80, 10, 1, 120, 'Triple Shot +60 Bath', 'Success'),
(269, 83, NULL, NULL, NULL, NULL, 'Wait'),
(270, 84, NULL, NULL, NULL, NULL, 'Wait'),
(271, 84, 11, 1, 35, '', 'Success'),
(272, 84, 6, 2, 60, '', 'Success'),
(273, 84, 8, 1, 45, '', 'Success'),
(274, 84, 25, 1, 25, '', 'Success'),
(275, 84, 11, 1, 35, '', 'Success'),
(276, 84, 6, 2, 60, '', 'Success'),
(277, 84, 8, 1, 45, '', 'Success'),
(278, 84, 25, 1, 25, '', 'Success'),
(279, 84, 6, 1, 30, '', 'Success'),
(280, 85, NULL, NULL, NULL, NULL, 'Wait'),
(281, 85, 9, 1, 50, '', 'Processing'),
(282, 85, 8, 1, 45, '', 'Processing'),
(284, 87, NULL, NULL, NULL, NULL, 'Wait'),
(285, 88, NULL, NULL, NULL, NULL, 'Wait'),
(287, 90, NULL, NULL, NULL, NULL, 'Wait'),
(288, 90, 18, 1, 60, 'Single Shot +20 Bath', 'Yes'),
(289, 90, 10, 1, 50, '', 'Yes'),
(290, 91, NULL, NULL, NULL, NULL, 'Wait'),
(291, 91, 10, 2, 140, 'Single Shot +20 Bath', 'Yes'),
(292, 91, 18, 1, 60, 'Single Shot +20 Bath', 'Yes'),
(293, 92, NULL, NULL, NULL, NULL, 'Wait'),
(294, 92, 1, 1, 40, '', 'Processing'),
(295, 92, 10, 1, 50, '', 'Processing'),
(296, 92, 19, 1, 40, '', 'Re-Bill'),
(297, 93, NULL, NULL, NULL, NULL, 'Wait'),
(298, 93, 16, 1, 40, '', 'Processing'),
(299, 93, 20, 1, 45, '', 'Processing'),
(300, 94, NULL, NULL, NULL, NULL, 'Wait'),
(301, 94, 10, 2, 100, '', 'Re-bill'),
(302, 94, 10, 2, 100, '', 'Success'),
(303, 95, NULL, NULL, NULL, NULL, 'Wait'),
(304, 95, 10, 2, 120, 'Single Shot +20 Bath', 'Success');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id_product` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `name` varchar(50) NOT NULL,
  `price_h` int(11) NOT NULL,
  `price_c` int(11) NOT NULL,
  `price_f` int(11) NOT NULL,
  `type_1` varchar(25) NOT NULL,
  `type_2` varchar(25) NOT NULL,
  `status` varchar(25) NOT NULL,
  `create_at` datetime NOT NULL,
  `update_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id_product`, `image`, `name`, `price_h`, `price_c`, `price_f`, `type_1`, `type_2`, `status`, `create_at`, `update_at`) VALUES
(1, 'img/Green_tea.jpg', 'Green Tea', 40, 45, 50, 'Beverage', 'Tea', 'Quit selling', '2024-04-09 16:27:55', '2024-05-08 13:15:02'),
(2, 'img\\Iced Mocha - Azuca.jpg\"', 'Mocha', 40, 45, 0, 'Beverage', 'Coffee', 'Out of raw materials', '2024-02-07 11:01:54', '2024-05-08 13:52:17'),
(4, 'img/65cbab501b7fc_IMG_5896.JPG', 'Ice-Cream Vanilla Croffle', 30, 0, 0, 'Baked', 'Croffle', 'Out of raw materials', '2024-02-07 11:42:39', '2024-05-08 13:17:56'),
(6, 'img/65cbab70ba5a5_IMG_5897.JPG', 'Blueberry Croffle', 30, 0, 0, 'Baked', 'Croffle', 'Ready', '2024-02-07 22:05:16', '2024-02-14 00:48:32'),
(7, 'img/IMG_5882.JPG', 'Croissant Oreo', 55, 0, 0, 'Baked', 'Croissant', 'Ready', '2024-02-14 00:40:59', '2024-03-05 21:34:35'),
(8, 'img/IMG_5907.JPG', 'Chocolate Cake', 45, 0, 0, 'Baked', 'Cake', 'Ready', '2024-02-14 00:50:59', '2024-02-16 14:24:11'),
(9, 'img\\IMG_5881.JPG', 'Strawberry Croissant', 50, 0, 0, 'Baked', 'Croissant', 'Ready', '2024-02-16 08:36:31', '2024-02-24 01:27:14'),
(10, 'img/Coffee-caramel.jpg', 'Caramel Coffee', 50, 55, 60, 'Beverage', 'Coffee', 'Ready', '2024-02-16 14:40:51', '2024-02-23 20:22:25'),
(11, 'img/65cba9bec8196_IMG_5885.JPG', 'Choco Banana Croissant', 35, 0, 0, 'Baked', 'Croissant', 'Ready', '2024-02-16 14:42:31', '2024-02-16 14:42:31'),
(12, 'img/IMG_5915.jpg', 'Raspberry Cake', 50, 0, 0, 'Baked', 'Cake', 'Ready', '2024-02-16 14:44:04', '2024-02-16 14:44:04'),
(13, 'img/IMG_5880.JPG', 'Ice-cream Vanilla Croissant', 35, 0, 0, 'Baked', 'Croissant', 'Ready', '2024-02-19 12:35:18', '2024-02-19 12:35:18'),
(14, 'img/IMG_5893.JPG', 'Croissant', 20, 0, 0, 'Baked', 'Croissant', 'Ready', '2024-02-19 12:36:31', '2024-02-19 12:36:31'),
(15, 'img/65d2e9454ab62_IMG_5913.JPG', 'Fruits Cake', 40, 0, 0, 'Baked', 'Cake', 'Ready', '2024-02-19 12:37:36', '2024-02-19 12:38:13'),
(16, 'img/Lavender Latte.jpg', 'Latte', 40, 45, 50, 'Beverage', 'Coffee', 'Ready', '2024-02-19 12:38:55', '2024-02-19 12:38:55'),
(17, 'img/Black Coffee Macarons.jpg', 'Black Coffee', 45, 50, 0, 'Beverage', 'Coffee', 'Ready', '2024-02-19 12:39:26', '2024-02-19 12:39:26'),
(18, 'img/Dalgona Coffee vs Greek Frappe • Olive & Mango.jpg', 'Capuchino', 40, 45, 50, 'Beverage', 'Coffee', 'Ready', '2024-02-19 12:41:29', '2024-02-19 12:41:29'),
(19, 'img/Lemon Soda.jpg', 'Lemon Soda', 0, 40, 0, 'Beverage', 'Soda', 'Ready', '2024-02-19 12:41:56', '2024-02-19 12:41:56'),
(20, 'img/Strawberry Watermelon Spritzer [10 Minutes] - Chasety.jpg', 'Strawberry Soda', 0, 45, 0, 'Beverage', 'Soda', 'Ready', '2024-02-19 12:42:25', '2024-02-20 22:43:08'),
(21, 'img/Kiwi Lime Mojito Cocktail Recipe.jpg', 'Kiwi Soda', 0, 45, 0, 'Beverage', 'Soda', 'Out of raw materials', '2024-02-19 12:42:51', '2024-05-08 13:49:55'),
(22, 'img/Chick.jpg', 'Fly Chicken / Price per piece', 15, 0, 0, 'Dished', 'Dished', 'Ready', '2024-02-19 12:45:08', '2024-02-19 12:45:08'),
(23, 'img/Nugget.jpg', 'Chick Nugget', 35, 0, 0, 'Dished', 'Dished', 'Ready', '2024-02-19 12:45:46', '2024-02-19 12:45:46'),
(24, 'img/Cheeseball.jpg', 'Cheese Ball', 35, 0, 0, 'Dished', 'Dished', 'Ready', '2024-02-19 12:46:08', '2024-02-19 12:46:08'),
(25, 'img/French fries.jpg', 'French Fries', 25, 0, 0, 'Dished', 'Dished', 'Ready', '2024-02-19 12:46:45', '2024-02-19 12:46:45'),
(26, 'img/ChocolateMilk.jpg', 'Chocolate Milk', 40, 45, 50, 'Beverage', 'Tea', 'Ready', '2024-02-19 12:47:13', '2024-02-19 12:47:13'),
(27, 'img/PinkMilk.jpg', 'Pink Milk', 25, 30, 35, 'Beverage', 'Tea', 'Ready', '2024-02-19 12:49:09', '2024-02-19 12:49:09'),
(28, 'img/TaroTea.jpg', 'Taro Tea', 30, 35, 40, 'Beverage', 'Tea', 'Ready', '2024-02-19 12:49:34', '2024-02-19 12:49:34'),
(29, 'img/Thai Iced Tea (Thai Tea).jpg', 'Thai Tea', 30, 35, 40, 'Beverage', 'Tea', 'Ready', '2024-02-19 12:50:34', '2024-02-19 12:50:34'),
(30, 'img/IMG_5895.JPG', 'Croffle', 15, 0, 0, 'Baked', 'Croffle', 'Ready', '2024-02-19 12:51:04', '2024-02-19 12:51:04'),
(32, 'img/IMG_5906.JPG', 'Butter Cake', 50, 0, 0, 'Baked', 'Cake', 'Ready', '2024-02-19 16:43:37', '2024-02-19 16:43:37'),
(33, 'img/65e72e6dda979_padkrapow.jpg', ' Pad Krapraow', 45, 0, 0, 'Dished', 'Dished', 'Ready', '2024-02-23 20:29:49', '2024-03-05 21:38:37'),
(34, 'img/Breakfast.jpg', 'Breakfast', 55, 0, 0, 'Dished', 'Dished', 'Ready', '2024-03-05 21:40:17', '2024-03-05 21:40:17'),
(35, 'img/mama.jpg', 'Korean noodle', 45, 0, 0, 'Dished', 'Dished', 'Ready', '2024-03-05 21:45:18', '2024-03-05 21:45:18'),
(36, 'img/rice.jpg', 'Fried rice', 45, 0, 0, 'Dished', 'Dished', 'Ready', '2024-03-05 21:45:46', '2024-03-05 21:45:46'),
(37, 'img/salad.jpg', 'Salad', 45, 0, 0, 'Dished', 'Dished', 'Ready', '2024-03-05 21:46:01', '2024-03-05 21:46:01'),
(38, 'img/spaghetti.jpg', 'Carbonara Spaghetti', 50, 0, 0, 'Dished', 'Dished', 'Ready', '2024-03-05 21:46:48', '2024-03-05 21:46:48'),
(40, 'img/Macchiato.jpg', 'Macchiato', 45, 50, 55, 'Beverage', 'Coffee', 'Ready', '2024-04-26 14:55:26', '2024-04-26 14:55:58');

-- --------------------------------------------------------

--
-- Table structure for table `t_able`
--

CREATE TABLE `t_able` (
  `id_table` int(11) NOT NULL,
  `name` varchar(25) NOT NULL,
  `status` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `t_able`
--

INSERT INTO `t_able` (`id_table`, `name`, `status`) VALUES
(1, 'L1', 'Not use'),
(2, 'L2', 'Not use'),
(3, 'L3', 'Not use'),
(4, 'C1', 'Not use'),
(5, 'C2', 'Not use'),
(6, 'C3', 'Not use'),
(7, 'R1', 'Not use'),
(8, 'R2', 'Not use'),
(9, 'R3', 'Not use'),
(10, 'Takehome', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bill`
--
ALTER TABLE `bill`
  ADD PRIMARY KEY (`id_bill`),
  ADD KEY `FK_bill_employee` (`id_emp`),
  ADD KEY `FK_bill_table` (`id_table`);

--
-- Indexes for table `data_common`
--
ALTER TABLE `data_common`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`id_emp`);

--
-- Indexes for table `order_detail`
--
ALTER TABLE `order_detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_order_dettail_product` (`id_product`),
  ADD KEY `FK_order_bill_bill` (`id_bill`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id_product`);

--
-- Indexes for table `t_able`
--
ALTER TABLE `t_able`
  ADD PRIMARY KEY (`id_table`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bill`
--
ALTER TABLE `bill`
  MODIFY `id_bill` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=96;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `id_emp` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `order_detail`
--
ALTER TABLE `order_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=305;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id_product` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `t_able`
--
ALTER TABLE `t_able`
  MODIFY `id_table` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bill`
--
ALTER TABLE `bill`
  ADD CONSTRAINT `FK_bill_employee` FOREIGN KEY (`id_emp`) REFERENCES `employee` (`id_emp`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_bill_table` FOREIGN KEY (`id_table`) REFERENCES `t_able` (`id_table`);

--
-- Constraints for table `order_detail`
--
ALTER TABLE `order_detail`
  ADD CONSTRAINT `FK_order_bill_bill` FOREIGN KEY (`id_bill`) REFERENCES `bill` (`id_bill`),
  ADD CONSTRAINT `FK_order_dettail_product` FOREIGN KEY (`id_product`) REFERENCES `products` (`id_product`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
