-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 27, 2025 at 08:07 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `webbanhang`
--

-- --------------------------------------------------------

--
-- Table structure for table `blog_category`
--

CREATE TABLE `blog_category` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `blog_comment`
--

CREATE TABLE `blog_comment` (
  `id` int(11) NOT NULL,
  `post_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `content` text DEFAULT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `blog_post`
--

CREATE TABLE `blog_post` (
  `id` int(11) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `content` longtext DEFAULT NULL,
  `author_id` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `brand`
--

CREATE TABLE `brand` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `brand`
--

INSERT INTO `brand` (`id`, `name`) VALUES
(1, 'Nike'),
(2, 'Adidas'),
(3, 'Jordan'),
(4, 'Under Armour'),
(5, 'Puma'),
(6, 'Li-Ning'),
(7, 'ANTA'),
(8, 'Peak');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`) VALUES
(8, 'Giày'),
(9, 'Áo / Quần'),
(11, 'Bóng rổ'),
(12, 'Tất thể thao'),
(13, 'Phụ kiện bảo hộ'),
(14, 'Ba lô thể thao'),
(15, 'Mũ bóng rổ'),
(16, 'Áo khoác bóng rổ');

-- --------------------------------------------------------

--
-- Table structure for table `discount_code`
--

CREATE TABLE `discount_code` (
  `id` int(11) NOT NULL,
  `code` varchar(50) DEFAULT NULL,
  `discount_type` enum('percent','amount') DEFAULT NULL,
  `value` decimal(10,2) DEFAULT NULL,
  `expire_at` datetime DEFAULT NULL,
  `usage_limit` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

CREATE TABLE `inventory` (
  `id` int(11) NOT NULL,
  `variant_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `inventory`
--

INSERT INTO `inventory` (`id`, `variant_id`, `quantity`) VALUES
(1, 3, 58),
(2, 4, 454),
(3, 5, 53),
(5, 7, 200),
(6, 8, 100),
(7, 9, 100),
(8, 10, 100),
(9, 11, 100),
(10, 12, 100),
(11, 13, 100),
(12, 14, 100),
(13, 15, 100),
(14, 16, 100),
(15, 17, 100),
(16, 18, 100),
(17, 19, 100),
(18, 20, 100),
(19, 21, 100),
(20, 22, 100),
(21, 23, 100),
(22, 24, 100),
(23, 25, 100),
(24, 26, 100),
(25, 27, 100),
(26, 28, 100),
(27, 29, 100),
(28, 30, 100),
(29, 31, 100),
(30, 32, 100),
(31, 33, 100),
(32, 34, 100),
(33, 35, 100),
(34, 36, 100),
(35, 37, 100),
(36, 38, 100),
(37, 39, 100),
(38, 40, 98),
(39, 41, 100),
(40, 42, 100),
(41, 43, 100),
(42, 44, 100),
(43, 45, 100),
(44, 46, 100),
(45, 47, 100),
(46, 48, 100),
(47, 49, 100),
(48, 50, 100),
(49, 51, 100),
(50, 52, 100),
(51, 53, 100),
(52, 54, 100),
(53, 55, 100),
(54, 56, 100),
(55, 57, 100),
(56, 58, 100),
(57, 59, 100),
(58, 60, 100),
(59, 61, 100),
(61, 63, 100),
(62, 64, 100),
(63, 65, 100),
(64, 66, 100),
(65, 67, 99),
(66, 68, 100),
(67, 69, 99),
(68, 70, 100),
(69, 71, 100),
(70, 72, 100),
(71, 73, 100),
(72, 74, 100),
(73, 75, 100),
(74, 76, 100),
(75, 77, 100),
(76, 78, 100),
(77, 79, 100),
(78, 80, 100),
(79, 81, 99),
(80, 82, 100),
(81, 83, 100),
(82, 84, 100),
(83, 85, 100),
(84, 86, 98),
(85, 87, 100),
(86, 88, 200),
(87, 89, 100),
(88, 90, 100),
(89, 91, 100),
(90, 92, 100),
(91, 93, 100),
(92, 94, 100),
(93, 95, 100),
(94, 96, 98),
(95, 97, 100),
(97, 99, 100),
(98, 100, 100),
(99, 101, 100),
(100, 102, 100),
(101, 103, 100),
(102, 104, 100),
(103, 105, 100),
(104, 106, 100),
(105, 107, 100),
(106, 108, 100),
(107, 109, 100),
(108, 110, 100),
(109, 111, 96),
(110, 112, 100),
(111, 113, 100),
(112, 114, 98),
(113, 115, 100),
(114, 116, 100),
(115, 117, 100),
(117, 119, 100),
(118, 120, 100),
(119, 121, 100),
(120, 122, 100),
(121, 123, 100),
(122, 124, 100),
(123, 125, 100),
(124, 126, 100),
(125, 127, 100),
(127, 129, 100),
(128, 130, 100),
(129, 131, 149),
(130, 132, 200),
(131, 133, 149),
(132, 134, 97),
(133, 135, 199),
(135, 137, 99),
(136, 138, 150),
(137, 139, 100),
(138, 140, 100),
(139, 141, 100),
(140, 142, 100),
(141, 143, 100),
(142, 144, 100),
(143, 145, 100),
(144, 146, 99),
(145, 147, 98),
(146, 148, 99),
(147, 149, 100),
(148, 150, 100),
(149, 151, 100),
(150, 152, 100),
(151, 153, 100),
(152, 154, 99),
(153, 155, 100),
(154, 156, 100),
(155, 157, 99),
(156, 158, 100),
(157, 159, 100),
(158, 160, 100),
(159, 161, 100),
(160, 162, 99),
(161, 163, 100),
(162, 164, 100),
(163, 165, 100),
(164, 166, 100),
(165, 167, 100),
(166, 168, 100),
(167, 169, 99),
(168, 170, 100),
(169, 171, 100),
(170, 172, 100),
(171, 173, 100),
(172, 174, 100),
(173, 175, 100),
(174, 176, 100),
(175, 177, 100),
(176, 178, 100),
(177, 179, 100),
(178, 180, 100),
(179, 181, 100),
(180, 182, 100),
(181, 183, 100),
(182, 184, 100),
(183, 185, 100),
(184, 186, 100),
(185, 187, 99),
(186, 188, 100),
(187, 189, 100),
(188, 190, 100),
(189, 191, 100),
(190, 192, 100),
(191, 193, 100),
(192, 194, 100),
(193, 195, 100),
(194, 196, 100),
(195, 197, 100),
(196, 198, 100),
(197, 199, 100),
(198, 200, 100),
(199, 201, 100),
(200, 202, 100),
(201, 203, 100),
(202, 204, 100),
(203, 205, 100),
(204, 206, 100),
(205, 207, 100),
(206, 208, 100),
(207, 209, 100),
(208, 210, 100),
(209, 211, 100),
(210, 212, 100),
(211, 213, 100),
(212, 214, 100),
(213, 215, 100),
(214, 216, 100),
(215, 217, 100),
(216, 218, 100),
(217, 219, 100),
(218, 220, 100),
(219, 221, 100),
(220, 222, 100),
(221, 223, 100),
(222, 224, 100),
(223, 225, 100),
(224, 226, 100),
(225, 227, 100),
(226, 228, 100),
(228, 230, 100),
(229, 231, 100),
(230, 232, 100),
(231, 233, 100),
(232, 234, 100),
(233, 235, 100),
(234, 236, 100),
(235, 237, 100),
(236, 238, 100),
(237, 239, 100),
(238, 240, 100),
(239, 241, 100),
(240, 242, 100),
(241, 243, 100),
(242, 244, 100),
(243, 245, 100),
(244, 246, 100),
(245, 247, 100),
(246, 248, 98),
(247, 249, 100),
(248, 250, 100),
(249, 251, 100),
(250, 252, 100),
(251, 253, 100),
(252, 254, 100),
(253, 255, 100),
(254, 256, 100),
(255, 257, 100),
(256, 258, 100),
(257, 259, 100),
(258, 260, 100),
(259, 261, 100),
(260, 262, 100),
(261, 263, 100),
(262, 264, 100),
(263, 265, 100),
(264, 266, 100),
(265, 267, 99),
(266, 268, 100),
(267, 269, 100),
(268, 270, 100),
(269, 271, 100),
(270, 272, 100),
(271, 273, 100),
(272, 274, 100),
(273, 275, 100),
(274, 276, 100),
(275, 277, 100),
(276, 278, 100),
(277, 279, 100),
(278, 280, 100),
(279, 281, 100),
(280, 282, 100),
(281, 283, 100),
(282, 284, 100),
(283, 285, 100),
(284, 286, 100),
(285, 287, 100),
(286, 288, 100),
(287, 289, 100),
(288, 290, 100),
(290, 292, 100),
(291, 293, 100),
(292, 294, 100),
(293, 295, 100),
(294, 296, 99),
(295, 297, 100),
(296, 298, 100),
(297, 299, 100),
(298, 300, 100),
(299, 301, 100),
(300, 302, 99),
(301, 303, 100),
(302, 304, 100),
(303, 305, 100),
(304, 306, 100),
(305, 307, 100),
(306, 308, 100),
(307, 309, 100),
(308, 310, 100),
(309, 311, 100),
(310, 312, 100),
(311, 313, 100),
(312, 314, 100),
(313, 315, 100),
(314, 316, 100),
(315, 317, 100),
(316, 318, 100),
(317, 319, 100),
(318, 320, 99),
(319, 321, 100),
(320, 322, 100),
(321, 323, 100),
(322, 324, 100),
(323, 325, 100),
(324, 326, 99),
(325, 327, 100),
(326, 328, 100),
(327, 329, 100),
(328, 330, 100),
(329, 331, 100),
(330, 332, 100),
(331, 333, 100),
(332, 334, 100),
(333, 335, 100),
(334, 336, 100),
(335, 337, 100),
(336, 338, 99),
(337, 339, 100),
(338, 340, 100),
(339, 341, 100),
(340, 342, 100),
(341, 343, 100),
(342, 344, 100),
(343, 345, 99),
(344, 346, 100),
(345, 347, 100),
(346, 348, 100),
(347, 349, 99),
(349, 351, 100),
(350, 352, 97),
(351, 353, 100),
(352, 354, 100),
(353, 355, 100),
(354, 356, 100),
(355, 357, 100),
(356, 358, 100),
(357, 359, 100),
(358, 360, 100),
(359, 361, 100),
(360, 362, 100),
(361, 363, 100),
(362, 364, 100),
(363, 365, 100),
(364, 366, 100),
(365, 367, 100),
(366, 368, 100),
(367, 369, 100),
(368, 370, 100),
(369, 371, 100),
(370, 372, 100),
(371, 373, 99),
(372, 374, 100),
(373, 375, 100),
(374, 376, 100);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `fullname` varchar(50) DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  `phone_number` varchar(20) DEFAULT NULL,
  `address` varchar(200) DEFAULT NULL,
  `note` varchar(1000) DEFAULT NULL,
  `order_date` datetime DEFAULT NULL,
  `status_id` int(11) DEFAULT NULL,
  `total_money` decimal(10,2) DEFAULT NULL,
  `payment_method_id` int(11) DEFAULT NULL,
  `payment_status` enum('pending','paid','failed') DEFAULT 'pending',
  `shipping_method_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `fullname`, `email`, `phone_number`, `address`, `note`, `order_date`, `status_id`, `total_money`, `payment_method_id`, `payment_status`, `shipping_method_id`) VALUES
(3, NULL, 'qhuy', '2222@gmail.com', '0123456789', 'nhabe', 'Giao nhanh dùm em', '2025-06-08 18:38:13', 2, 7175000.00, NULL, 'pending', NULL),
(5, 8, 'dong', 'Dong@gmail.com', '1234567891', 'Quan 12', 'Giao nhanh', '2025-06-08 20:19:20', 1, 3850000.00, 1, 'pending', 2),
(6, 8, 'dong11', 'dongdong@gmail.com', '1234567891', 'Tan Phu', '13h qua lấy', '2025-06-09 10:17:09', 4, 9615000.00, 2, 'pending', 3),
(7, 13, 'tranthanhdongg', 'donggg@gmail.com', '0111111111', 'dailanh', 'aa', '2025-03-15 15:28:28', 4, 14506000.00, 1, 'pending', 1),
(8, 13, 'tranthanhdongg', 'donggg@gmail.com', '0111111111', 'dailanh', 'bb', '2025-02-14 15:29:01', 4, 850000.00, 2, 'pending', 2),
(9, 13, 'tranthanhdongg', 'donggg@gmail.com', '0111111111', 'dailanh', 'cccc', '2025-04-10 15:29:25', 4, 400000.00, 1, 'pending', 3),
(10, 13, 'quochuyy', 'hyy@gmail.com', '0222222222', 'nhabee', 'nợ', '2025-06-27 15:40:47', 3, 16215000.00, 1, 'pending', 2),
(11, 14, 'quochuyy', 'hyy@gmail.com', '0222222222', 'nhabee', 'thiếu', '2025-06-27 15:42:45', 2, 80000.00, 2, 'pending', 2),
(12, 14, 'quochuyy', 'hyy@gmail.com', '0222222222', 'nhabe', 'vvvfvfvf', '2025-01-15 15:45:02', 5, 2975000.00, 1, 'pending', 3),
(13, 14, 'quochuyy', 'hyy@gmail.com', '0222222222', 'nhabe', 'bbbbb', '2025-02-08 15:55:49', 4, 340000.00, 2, 'pending', 1),
(14, 15, 'quocviett', 'viett@gmail.com', '0333333333', 'quan7', 'vvv', '2025-01-17 16:09:17', 4, 3025000.00, 2, 'pending', 1),
(15, 15, 'quocviett', 'viett@gmail.com', '0333333333', 'quan7', 'xxdcc', '2025-04-02 16:09:40', 4, 60000.00, 1, 'pending', 3),
(16, 16, 'dongphuongbatbai', 'dpbb@gmail.com', '0444444444', 'khanhhoaa', 'cvcvcvcv', '2025-05-01 16:13:41', 4, 7125000.00, 1, 'pending', 1),
(17, 16, 'dongphuongbatbai', 'dpbb@gmail.com', '0444444444', 'khanhhoaa', 'vcvcvc', '2025-06-27 16:14:02', 4, 4000000.00, 2, 'pending', 2),
(18, 17, 'buonvidepchai', 'bvdc@gmail.com', '0555555555', 'hcm', 'xaxcc', '2025-05-09 16:16:44', 4, 100000.00, 1, 'pending', 2),
(19, 17, 'buonvidepchai', 'bvdc@gmail.com', '0555555555', 'hcm', 'cscs', '2025-06-27 16:20:28', 2, 6165000.00, 2, 'pending', 3);

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `id` int(11) NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `num` int(11) DEFAULT NULL,
  `total_money` decimal(10,2) DEFAULT NULL,
  `variant_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`id`, `order_id`, `product_id`, `price`, `num`, `total_money`, `variant_id`) VALUES
(14, 5, 18, 1020000.00, 1, 1020000.00, 69),
(16, 5, 25, 340000.00, 1, 340000.00, 96),
(17, 5, 45, 90000.00, 1, 90000.00, 147),
(18, 6, 83, 8000000.00, 1, 8000000.00, 373),
(20, 6, 18, 1020000.00, 1, 1020000.00, 67),
(21, 7, 87, 40000.00, 1, 40000.00, 352),
(22, 7, 75, 7480000.00, 1, 7480000.00, 296),
(23, 7, 45, 90000.00, 1, 90000.00, 146),
(24, 7, 50, 475000.00, 1, 475000.00, 154),
(25, 7, 79, 5661000.00, 1, 5661000.00, 320),
(26, 7, 47, 760000.00, 1, 760000.00, 148),
(27, 8, 36, 400000.00, 1, 400000.00, 134),
(28, 8, 28, 450000.00, 1, 450000.00, 114),
(29, 9, 36, 400000.00, 1, 400000.00, 134),
(30, 10, 14, 2340000.00, 1, 2340000.00, 40),
(31, 10, 82, 9775000.00, 1, 9775000.00, 338),
(32, 10, 21, 1200000.00, 1, 1200000.00, 81),
(33, 10, 36, 400000.00, 1, 400000.00, 134),
(34, 10, 67, 2500000.00, 1, 2500000.00, 248),
(35, 11, 87, 40000.00, 2, 80000.00, 352),
(36, 12, 57, 2975000.00, 1, 2975000.00, 187),
(37, 13, 25, 340000.00, 1, 340000.00, 96),
(38, 14, 37, 525000.00, 1, 525000.00, 135),
(39, 14, 67, 2500000.00, 1, 2500000.00, 248),
(40, 15, 89, 60000.00, 1, 60000.00, 349),
(41, 16, 80, 7125000.00, 1, 7125000.00, 326),
(42, 17, 76, 4000000.00, 1, 4000000.00, 302),
(43, 18, 93, 100000.00, 1, 100000.00, 345),
(44, 19, 14, 2340000.00, 1, 2340000.00, 40),
(45, 19, 28, 450000.00, 1, 450000.00, 114),
(46, 19, 54, 3375000.00, 1, 3375000.00, 169);

-- --------------------------------------------------------

--
-- Table structure for table `order_log`
--

CREATE TABLE `order_log` (
  `id` int(11) NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  `status_id` int(11) DEFAULT NULL,
  `note` text DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_log`
--

INSERT INTO `order_log` (`id`, `order_id`, `status_id`, `note`, `created_at`, `updated_by`) VALUES
(37, 3, 2, NULL, '2025-06-08 19:42:14', 0),
(39, 6, 4, NULL, '2025-06-27 15:25:55', 2),
(40, 19, 2, NULL, '2025-06-27 16:21:04', 18),
(41, 19, 2, NULL, '2025-06-27 16:21:07', 18),
(42, 18, 2, NULL, '2025-06-27 16:21:15', 18),
(43, 17, 4, NULL, '2025-06-27 16:21:21', 18),
(44, 16, 3, NULL, '2025-06-27 16:21:29', 18),
(45, 15, 3, NULL, '2025-06-27 16:21:37', 18),
(46, 14, 4, NULL, '2025-06-27 16:21:46', 18),
(47, 13, 2, NULL, '2025-06-27 16:21:55', 18),
(48, 12, 5, NULL, '2025-06-27 16:22:02', 18),
(49, 11, 2, NULL, '2025-06-27 16:22:08', 18),
(50, 10, 3, NULL, '2025-06-27 16:22:16', 18),
(51, 9, 4, NULL, '2025-06-27 16:22:25', 18),
(52, 8, 4, NULL, '2025-06-27 16:22:34', 18),
(53, 7, 4, NULL, '2025-06-27 16:22:43', 18),
(54, 16, 4, NULL, '2025-06-27 17:11:37', 18);

-- --------------------------------------------------------

--
-- Table structure for table `order_status`
--

CREATE TABLE `order_status` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_status`
--

INSERT INTO `order_status` (`id`, `name`) VALUES
(1, 'Chờ xác nhận'),
(2, 'Đang chuẩn bị hàng'),
(3, 'Đang giao'),
(4, 'Đã giao thành công'),
(5, 'Đã hủy');

-- --------------------------------------------------------

--
-- Table structure for table `payment_method`
--

CREATE TABLE `payment_method` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payment_method`
--

INSERT INTO `payment_method` (`id`, `name`) VALUES
(1, 'Thanh toán khi nhận hàng'),
(2, 'Chuyển khoản ');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `brand_id` int(11) DEFAULT NULL,
  `title` varchar(250) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `thumbnail` varchar(500) DEFAULT NULL,
  `thumbnail_2` varchar(500) DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `category_id`, `brand_id`, `title`, `price`, `thumbnail`, `thumbnail_2`, `description`, `created_at`, `updated_at`, `deleted`) VALUES
(1, 8, 2, 'Harden vol8', 2000000.00, 'assets/imagesimagesAdidas-ADIDAS HARDEN VOL.8 PIONEER-01.png', 'assets/imagesimagesAdidas-ADIDAS HARDEN VOL.8 PIONEER-02.png', 'giày đẹp', '2025-05-23 19:59:11', '2025-05-14 14:38:13', 1),
(2, 11, 8, 'Banh Akapro', 200000.00, 'assets/imagesimagesBanh-BANH AKPRO AB9008-01.png', 'assets/imagesimagesBanh-BANH AKPRO AB9008-02.png', 'banh dep', '2025-05-24 17:40:02', '2025-05-24 17:40:05', 1),
(3, 11, 8, 'banh Ak', 200000.00, 'assets/imagesimagesBanh-BANH AKPRO AB9008-01.png', 'assets/imagesimagesBanh-BANH AKPRO AB9008-02.png', 'banh dep', '2025-05-24 19:26:08', '2025-05-24 19:41:09', 1),
(4, 8, 2, 'ADIFOM Q OFF-WHITE', 2600000.00, 'assets/images/1749040846-Adidas-ADIDAS ADIFOM Q OFF-WHITE-01.png', 'assets/images/1749040846-Adidas-ADIDAS ADIFOM Q OFF-WHITE-02.png', '', '2025-06-04 14:40:46', '2025-06-06 12:29:59', 1),
(5, 8, 2, 'ADIZERO SELECT SESAME BLACK', 1500000.00, 'assets/images/1749040911-Adidas-ADIDAS ADIZERO SELECT SESAME BLACK-01.png', 'assets/images/1749040911-Adidas-ADIDAS ADIZERO SELECT SESAME BLACK-02.png', '', '2025-06-04 14:41:51', '2025-06-06 12:30:01', 1),
(6, 8, 1, 'NIKE DUNK LOW', 3200000.00, 'assets/images/1749041041-NIKE-NIKE DUNK LOW-01.webp', 'assets/images/1749041041-NIKE-NIKE DUNK LOW-02.png', '', '2025-06-04 14:44:01', '2025-06-06 12:30:02', 1),
(7, 8, 1, 'GIANNIS IMMORTALITY 3', 4200000.00, 'assets/images/1749041093-NIKE-NIKE GIANNIS IMMORTALITY 3-01.webp', 'assets/images/1749041093-NIKE-NIKE GIANNIS IMMORTALITY 3-02.png', '', '2025-06-04 14:44:53', '2025-06-06 12:30:04', 1),
(8, 14, 3, 'BALO JORDAN LINE', 1200000.00, 'assets/images/1749041143-Balo-BALO JORDAN LINE-01.png', 'assets/images/1749041143-Balo-BALO JORDAN LINE-02.webp', '', '2025-06-04 14:45:43', '2025-06-06 12:30:07', 1),
(10, 14, 1, 'BALO NIKE AIR ELITE', 1400000.00, 'assets/images/1749041219-Balo-BALO NIKE AIR ELITE-01.png', 'assets/images/1749041219-Balo-BALO NIKE AIR ELITE-02.webp', '', '2025-06-04 14:46:59', '2025-06-06 12:30:09', 1),
(11, 9, 1, 'EDWARDS MINNESOTA TIMBERWOLVES', 600000.00, 'assets/images/1749041262-Ao-EDWARDS MINNESOTA TIMBERWOLVES STATEMENT EDITION JERSEY-01.png', 'assets/images/1749041262-Ao-EDWARDS MINNESOTA TIMBERWOLVES STATEMENT EDITION JERSEY-02.png', '', '2025-06-04 14:47:42', '2025-06-06 12:30:10', 1),
(12, 9, 3, 'ALEXANDER OKLAHOMA CITY', 800000.00, 'assets/images/1749041287-Ao-GILGEOUS-ALEXANDER OKLAHOMA CITY THUNDER CITY EDITION 2023-2024 JERSEY-01.png', 'assets/images/1749041287-Ao-GILGEOUS-ALEXANDER OKLAHOMA CITY THUNDER CITY EDITION 2023-2024 JERSEY-02.png', '', '2025-06-04 14:48:07', '2025-06-06 12:30:12', 1),
(13, 11, 7, 'BANH AKPRO AB9008', 200000.00, 'assets/images/1749041340-Banh-BANH AKPRO AB9008-01.png', 'assets/images/1749041340-Banh-BANH AKPRO AB9008-02.png', '', '2025-06-04 14:49:00', '2025-06-06 12:30:13', 1),
(14, 8, 2, 'ADIDAS ADIFOM Q OFF-WHITE', 2600000.00, 'assets/images/1749110150-Adidas-ADIDAS ADIFOM Q OFF-WHITE-01.png', 'assets/images/1749110150-Adidas-ADIDAS ADIFOM Q OFF-WHITE-02.png', 'Adidas adiFOM Q Off-White – Đỉnh cao phong cách tương lai! Với thiết kế độc đáo, lớp vỏ foam EVA thời thượng và lót Primeknit ôm sát, đôi giày này mang lại sự thoải mái tối đa khi chơi bóng rổ hoặc dạo phố. Tông màu Off-White tinh tế kết hợp chi tiết cam nổi bật, dễ dàng phối đồ, giúp bạn tự tin tỏa sáng trên sân và ngoài đường phố.', '2025-06-05 09:55:50', '2025-06-27 04:00:00', 0),
(15, 8, 2, 'ADIDAS ADIZERO SELECT SESAME BLACK', 1500000.00, 'assets/images/1749110245-Adidas-ADIDAS ADIZERO SELECT SESAME BLACK-01.png', 'assets/images/1749110245-Adidas-ADIDAS ADIZERO SELECT SESAME BLACK-02.png', 'Adidas adiZero Select Sesame Black – Bùng nổ phong cách và tốc độ! Với thiết kế siêu nhẹ, công nghệ Lightstrike êm ái và đế cao su bám sân đỉnh cao, đôi giày này giúp bạn lướt nhanh như chớp trên sân bóng rổ. Tông màu Sesame Black sang trọng, điểm nhấn tinh tế, dễ phối đồ, sẵn sàng đưa bạn từ sân đấu đến đường phố với vibe cực chất!', '2025-06-05 09:57:25', '2025-06-27 04:00:34', 0),
(16, 8, 2, 'ADIDAS ADIZERO SELECT', 3000000.00, 'assets/images/1749110626-Adidas-ADIDAS ADIZERO SELECT-01.png', 'assets/images/1749110626-Adidas-ADIDAS ADIZERO SELECT-02.png', 'Adidas adiZero Select – Định nghĩa tốc độ và phong cách! Thiết kế siêu nhẹ với công nghệ Lightstrike êm ái, đế cao su bám sân tối ưu, đôi giày này giúp bạn bứt phá trong từng pha bóng rổ. Tông màu hiện đại, dễ phối đồ, đưa bạn từ sân đấu đến đường phố với năng lượng bùng nổ và vibe cực chất!', '2025-06-05 10:03:46', '2025-06-27 04:00:58', 0),
(17, 8, 2, 'ADIDAS D.O.N ISSUE 5', 1000000.00, 'assets/images/1749110769-Adidas-ADIDAS D.O.N ISSUE 5-01.png', 'assets/images/1749110769-Adidas-ADIDAS D.O.N ISSUE 5-02.png', 'Adidas D.O.N. Issue 5 – Chinh phục sân đấu với hiệu suất đỉnh cao! Thiết kế siêu nhẹ với công nghệ Lightstrike midsole, mang lại độ êm ái và phản hồi nhanh cho những pha cắt bóng, nhảy cao và bứt tốc. Đế cao su với họa tiết traction độc đáo đảm bảo độ bám vượt trội trên mọi mặt sân, kể cả sàn bụi. Phần upper thoáng khí, ôm chân chắc chắn, cùng TPU heel clip tăng cường độ ổn định, giúp bạn tự tin thống trị trận đấu như Donovan \"Spida\" Mitchell![](https://www.adidas.com/us/d.o.n.-issue-5-shoes/IE8328.html)', '2025-06-05 10:06:09', '2025-06-27 04:01:40', 0),
(18, 8, 2, 'ADIDAS DAME 8 BRIDGE CITY', 1200000.00, 'assets/images/1749110823-Adidas-ADIDAS DAME 8 BRIDGE CITY-01.png', 'assets/images/1749110823-Adidas-ADIDAS DAME 8 BRIDGE CITY-02.png', 'Adidas Dame 8 Bridge City – Sẵn sàng thống trị sân đấu! Được thiết kế với công nghệ Bounce Pro hai lớp, đôi giày này mang lại sự cân bằng hoàn hảo giữa phản hồi năng lượng, độ êm ái và hỗ trợ, giúp bạn bứt phá trong những pha bóng quyết định. Đế cao su với họa tiết độc quyền đảm bảo độ bám vượt trội trên sân gỗ. Upper làm từ vật liệu tái chế, thoáng khí, kết hợp chi tiết “Bridge City” tôn vinh phong cách Damian Lillard, giúp bạn tự tin tỏa sáng như một nhà vô địch![](https://throwbackstore.com.au/products/dame-8-bridge-city)', '2025-06-05 10:07:03', '2025-06-27 04:02:12', 0),
(19, 8, 2, 'ADIDAS DAME 8 EXTPLY', 1250000.00, 'assets/images/1749110872-Adidas-ADIDAS DAME 8 EXTPLY-01.png', 'assets/images/1749110872-Adidas-ADIDAS DAME 8 EXTPLY-02.png', 'Adidas Dame 8 EXTPLY – Tăng tốc và làm chủ sân đấu! Được ký tên bởi Damian Lillard, đôi giày này mang đến độ bền vượt trội với công nghệ Bounce Pro midsole, kết hợp độ ổn định và đệm nhẹ nhàng cho từng bước di chuyển. Đế cao su với họa tiết zonal herringbone bám sân cực chắc, hỗ trợ những pha cắt bóng và dừng đột ngột. Thiết kế upper thoáng khí, kết hợp dây đai giữa bàn chân và tấm TPU propulsion, giữ chân chắc chắn, giúp bạn tự tin bùng nổ như \"Dame Time\" trong mọi trận đấu!', '2025-06-05 10:07:52', '2025-06-27 04:04:09', 0),
(20, 8, 2, 'ADIDAS DAME 8 MR.INCREDIBLE', 2000000.00, 'assets/images/1749110951-Adidas-ADIDAS DAME 8 MR.INCREDIBLE-01.png', 'assets/images/1749110951-Adidas-ADIDAS DAME 8 MR.INCREDIBLE-02.png', 'Adidas Dame 8 Mr. Incredible – Đỉnh cao phong cách siêu anh hùng! Lấy cảm hứng từ Disney Pixar’s \"The Incredibles,\" đôi giày này kết hợp thiết kế táo bạo với công nghệ Bounce Pro midsole, mang lại sự thoải mái và bùng nổ năng lượng trên sân bóng rổ. Đế ngoài độc đáo với họa tiết traction vượt trội, đảm bảo độ bám hoàn hảo cho mọi pha di chuyển. Tông màu đen kết hợp vàng và đỏ rực rỡ, dễ phối đồ, giúp bạn tỏa sáng như Damian Lillard cả trong trận đấu lẫn trên đường phố!', '2025-06-05 10:09:11', '2025-06-27 04:04:14', 0),
(21, 8, 2, 'ADIDAS HARDEN VOL.8 PIONEER', 1500000.00, 'assets/images/1749110993-Adidas-ADIDAS HARDEN VOL.8 PIONEER-01.png', 'assets/images/1749110993-Adidas-ADIDAS HARDEN VOL.8 PIONEER-02.png', 'Adidas Harden Vol. 8 Pioneer – Phong cách dẫn đầu, bùng nổ sân đấu! Hợp tác cùng James Harden, đôi giày này khoe thiết kế tương lai với khung EVA hình giọt nước màu Cloud White, ôm chân chắc chắn từ mũi đến mắt cá. Công nghệ Jet Boost midsole siêu nhẹ mang lại độ êm và phản hồi nhanh, lý tưởng cho những pha step-back và cắt bóng thần tốc. Upper vải đen tinh tế, phối cùng đế “JH” traction bám sân cực đỉnh, giúp bạn tự tin tỏa sáng cả trên sân bóng rổ lẫn đường phố!', '2025-06-05 10:09:53', '2025-06-27 04:04:23', 0),
(23, 9, 1, 'ANTHONY EDWARDS MINNESOTA TIMBERWOLVES CITY EDITION JERSEY', 500000.00, 'assets/images/1749111124-Ao-ANTHONY EDWARDS MINNESOTA TIMBERWOLVES CITY EDITION JERSEY-01.png', 'assets/images/1749151147-Ao-ANTHONY-EDWARDS-MINNESOTA-TIMBERWOLVES-CITY EDITION -JERSEY-02.png', 'Anthony Edwards Minnesota Timberwolves City Edition Jersey – Thắp sáng sân đấu với vibe mùa đông Minnesota! Lấy cảm hứng từ \"Vùng đất 10.000 hồ\", áo đấu này khoe thiết kế trắng-xanh với họa tiết băng giá độc đáo, tôn vinh văn hóa Minneapolis. Công nghệ Nike Dri-FIT thấm hút mồ hôi, mang lại sự thoải mái tối đa khi cổ vũ hay chơi bóng. Tôn lên phong cách \"Ant-Man\", áo dễ phối đồ, giúp bạn nổi bật từ sân bóng rổ đến đường phố!', '2025-06-05 10:12:04', '2025-06-27 04:04:49', 0),
(24, 9, 1, 'CURRY GOLDEN STATE WARRIORS CITY EDITION JERSEY', 500000.00, 'assets/images/1749111231-Ao-CURRY GOLDEN STATE WARRIORS CITY EDITION JERSEY-01.png', 'assets/images/1749111231-Ao-CURRY GOLDEN STATE WARRIORS CITY EDITION JERSEY-02.png', 'Stephen Curry Golden State Warriors 2024/25 City Edition Jersey – Tinh thần Bay Area bùng nổ! Lấy cảm hứng từ cầu Golden Gate huyền thoại, áo đấu này khoe thiết kế đỏ-vàng rực rỡ, tôn vinh sự kiên cường và sáng tạo của San Francisco. Công nghệ Nike Dri-FIT thấm hút mồ hôi, mang lại sự thoải mái tối đa khi cổ vũ hay chơi bóng. Tôn lên phong cách “Splash Brother”, áo dễ phối đồ, giúp bạn tỏa sáng từ sân bóng rổ đến đường phố!', '2025-06-05 10:13:51', '2025-06-27 04:05:17', 0),
(25, 9, 1, 'EDWARDS MINNESOTA TIMBERWOLVES STATEMENT EDITION JERSEY', 400000.00, 'assets/images/1749111288-Ao-EDWARDS MINNESOTA TIMBERWOLVES STATEMENT EDITION JERSEY-01.png', 'assets/images/1749111288-Ao-EDWARDS MINNESOTA TIMBERWOLVES STATEMENT EDITION JERSEY-02.png', 'Áo đấu Anthony Edwards Minnesota Timberwolves Statement Edition – Thể hiện bản lĩnh Ant-Man! Thiết kế anthracite táo bạo từ Jordan Brand, tích hợp công nghệ Nike Dri-FIT thấm hút mồ hôi, mang lại sự thoải mái tối đa khi cổ vũ hay chơi bóng. In tên và số #5 của Edwards nổi bật, áo đấu này hoàn hảo để bùng nổ phong cách trên sân hoặc đường phố. Tự tin khoe tinh thần Wolves với item đỉnh cao này!', '2025-06-05 10:14:48', '2025-06-27 04:06:03', 0),
(26, 9, 1, 'GILGEOUS-ALEXANDER OKLAHOMA CITY THUNDER CITY EDITION 2023-2024 JERSEY', 500000.00, 'assets/images/1749111323-Ao-GILGEOUS-ALEXANDER OKLAHOMA CITY THUNDER CITY EDITION 2023-2024 JERSEY-01.png', 'assets/images/1749111323-Ao-GILGEOUS-ALEXANDER OKLAHOMA CITY THUNDER CITY EDITION 2023-2024 JERSEY-02.png', 'Áo đấu Shai Gilgeous-Alexander Oklahoma City Thunder City Edition 2023-2024 – Bùng nổ tinh thần OKC! Lấy cảm hứng từ văn hóa và sự tái sinh của Oklahoma City, áo đấu này khoe thiết kế xanh navy đậm chất với các chi tiết nghệ thuật độc đáo. Công nghệ Nike Dri-FIT thấm hút mồ hôi, mang lại sự thoải mái tối đa khi cổ vũ hay chơi bóng. Tôn lên phong cách “SGA”, áo dễ phối đồ, giúp bạn nổi bật từ sân bóng rổ đến đường phố!', '2025-06-05 10:15:23', '2025-06-27 04:06:32', 0),
(27, 9, 1, 'KEVIN DURANT PHOENIX SUNS CITY EDITION 2023-24 JERSEY', 350000.00, 'assets/images/1749111353-Ao-KEVIN DURANT PHOENIX SUNS CITY EDITION 2023-24 JERSEY-01.png', 'assets/images/1749111353-Ao-KEVIN DURANT PHOENIX SUNS CITY EDITION 2023-24 JERSEY-02.png', 'Kevin Durant Phoenix Suns City Edition 2023-24 Jersey – Tôn vinh văn hóa El Valle! Lấy cảm hứng từ nghệ thuật Chicano và phong cách lowrider đặc trưng của Phoenix, áo đấu này khoe sắc đen huyền bí với chữ neon xanh nổi bật. Công nghệ Nike Dri-FIT thấm hút mồ hôi, kết hợp lưới thoáng khí, mang lại sự thoải mái tối đa khi cổ vũ hay chơi bóng. Logo “El Valle” viết tay và họa tiết pinstripe độc đáo, áo dễ phối đồ, giúp bạn thể hiện phong cách “KD” từ sân bóng rổ đến đường phố!', '2025-06-05 10:15:53', '2025-06-27 04:07:02', 0),
(28, 9, 1, 'KLAY THOMPSON GOLDEN STATE WARRIORS 2023-24 CITY EDITION JERSEY', 500000.00, 'assets/images/1749111404-Ao-KLAY THOMPSON GOLDEN STATE WARRIORS 2023-24 CITY EDITION JERSEY-01 (1).png', 'assets/images/1749111455-Ao-KLAY THOMPSON GOLDEN STATE WARRIORS 2023-24 CITY EDITION JERSEY-01 (1).png', 'Áo đấu Klay Thompson Golden State Warriors City Edition 2023-24 – Bùng nổ tinh thần Vịnh San Francisco! Lấy cảm hứng từ cầu Golden Gate và văn hóa Bay Area, áo đấu này khoe thiết kế đen-vàng mạnh mẽ với họa tiết sóng nước độc đáo. Công nghệ Nike Dri-FIT thấm hút mồ hôi, mang lại sự thoải mái tối đa khi cổ vũ hay chơi bóng. Tôn lên phong cách “Splash Brother” của Klay, áo dễ phối đồ, giúp bạn tỏa sáng từ sân bóng rổ đến đường phố!', '2025-06-05 10:16:44', '2025-06-27 04:07:24', 0),
(29, 9, 1, 'LEBRON JAMES 2024 NBA ALL-STAR WEEKEND ESSENTIAL JERSEY', 500000.00, 'assets/images/1749111499-Ao-LEBRON JAMES 2024 NBA ALL-STAR WEEKEND ESSENTIAL JERSEY-01.png', 'assets/images/1749111499-Ao-LEBRON JAMES 2024 NBA ALL-STAR WEEKEND ESSENTIAL JERSEY-01.png', 'Áo đấu LeBron James 2024 NBA All-Star Weekend Essential – Tỏa sáng như huyền thoại! Kỷ niệm lần thứ 20 được chọn vào All-Star của LeBron, áo đấu này khoe thiết kế Crimson rực rỡ, lấy cảm hứng từ lịch sử bóng rổ Indiana và phong cách Pacers. Công nghệ Nike Dri-FIT thấm hút mồ hôi, kết hợp lưới thoáng khí, mang lại sự thoải mái tối đa khi cổ vũ hay chơi bóng. Với tên và số #23 của “King James”, áo dễ phối đồ, giúp bạn bùng nổ phong cách từ sân đấu đến đường phố!', '2025-06-05 10:18:19', '2025-06-27 04:08:12', 0),
(30, 9, 1, 'TEAM USA 2024 JERSEY (HOT-PRESS)', 300000.00, 'assets/images/1749111544-Ao-TEAM USA 2024 JERSEY (HOT-PRESS)-01.png', 'assets/images/1749111544-Ao-TEAM USA 2024 JERSEY (HOT-PRESS)-02.png', 'Áo đấu Team USA 2024 Jersey (Hot-Press) – Bùng nổ tinh thần Olympic! Với thiết kế navy mạnh mẽ, logo và số cầu thủ in chuyển nhiệt sắc nét, không bong tróc, áo đấu này mang lại vibe năng động trên sân bóng rổ. Chất liệu vải lưới thoáng khí, thấm hút mồ hôi, đảm bảo sự thoải mái tối đa khi chơi thể thao hay diện phố. Tôn lên niềm tự hào Mỹ, áo dễ phối đồ, giúp bạn nổi bật như các siêu sao Team USA tại Paris 2024!', '2025-06-05 10:19:04', '2025-06-27 04:08:32', 0),
(31, 14, 2, 'BALO ADIDAS POWER VI', 700000.00, 'assets/images/1749111613-Balo-BALO ADIDAS POWER VI-01.PNG', 'assets/images/1749111613-Balo-BALO ADIDAS POWER VI-02.webp', 'Balo Adidas Power VI – Phong cách năng động, sẵn sàng đồng hành! Với thiết kế trẻ trung, dung tích 23.5L, balo này dễ dàng chứa đồ tập hoặc laptop 15 inch nhờ ngăn đựng thông minh và khóa kéo chắc chắn. Dây đai nén cân bằng tải trọng, quai đeo êm ái, đáy phủ bền bỉ chống va đập. Tông màu hiện đại, chất liệu tái chế thân thiện môi trường, balo Power VI giúp bạn tự tin từ phòng gym đến đường phố!', '2025-06-05 10:20:13', '2025-06-27 04:09:02', 0),
(32, 14, 3, 'BALO JORDAN LINE', 600000.00, 'assets/images/1749111678-Balo-BALO JORDAN LINE-01.png', 'assets/images/1749111678-Balo-BALO JORDAN LINE-02.webp', 'Balo Jordan Line là sự kết hợp hoàn hảo giữa phong cách thể thao hiện đại và tính năng tiện dụng. Với thiết kế mạnh mẽ, logo Jumpman đặc trưng, balo phù hợp cho cả luyện tập lẫn di chuyển hàng ngày. Ngăn chính rộng rãi giúp đựng được bóng rổ, quần áo, laptop và các vật dụng cá nhân. Chất liệu bền bỉ, chống nước nhẹ, quai đeo êm ái giúp bạn luôn thoải mái trong mọi hoạt động.', '2025-06-05 10:21:18', '2025-06-27 04:10:45', 0),
(33, 14, 3, 'BALO JORDAN MONOGRAM', 500000.00, 'assets/images/1749111720-Balo-BALO JORDAN MONOGRAM-01.png', 'assets/images/1749111720-Balo-BALO JORDAN MONOGRAM-02.webp', 'Balo Jordan Monogram nổi bật với họa tiết monogram cá tính và sang trọng, mang đậm phong cách đường phố kết hợp thể thao. Thiết kế ngăn chứa thông minh, phù hợp để đựng bóng rổ, giày, laptop và phụ kiện cá nhân. Chất liệu vải cao cấp, chống thấm nhẹ, đường may chắc chắn và logo Jumpman sắc nét khẳng định đẳng cấp người chơi. Lựa chọn lý tưởng cho các tín đồ bóng rổ yêu thích sự khác biệt và thời trang.', '2025-06-05 10:22:00', '2025-06-27 04:11:04', 0),
(34, 14, 1, 'BALO NIKE ACADEMY TEAM', 550000.00, 'assets/images/1749111758-Balo-BALO NIKE ACADEMY TEAM-01.png', 'assets/images/1749111758-Balo-BALO NIKE ACADEMY TEAM-02.webp', 'Balo Nike Academy Team được thiết kế dành riêng cho các vận động viên và người yêu thể thao, với kiểu dáng gọn gàng, hiện đại. Ngăn chính rộng rãi giúp dễ dàng mang theo bóng rổ, quần áo và dụng cụ thi đấu. Chất liệu polyester cao cấp chống thấm, đệm lưng và quai đeo êm ái mang lại cảm giác thoải mái trong suốt cả ngày. Logo Nike nổi bật khẳng định phong cách thể thao chuyên nghiệp.', '2025-06-05 10:22:38', '2025-06-27 04:11:22', 0),
(35, 14, 1, 'BALO NIKE AIR ELITE (BLACK EDITION)', 600000.00, 'assets/images/1749111791-Balo-BALO NIKE AIR ELITE (BLACK EDITION)-01.png', 'assets/images/1749111791-Balo-BALO NIKE AIR ELITE (BLACK EDITION)-02.webp', 'Balo Nike Air Elite (Black Edition) là lựa chọn hoàn hảo cho những ai yêu thích sự tối giản, mạnh mẽ và đầy phong cách. Với tông màu đen chủ đạo, thiết kế tinh tế và logo Nike sắc sảo, balo mang đến vẻ ngoài sang trọng mà vẫn năng động. Ngăn chứa rộng rãi đủ sức chứa bóng rổ, giày, laptop và phụ kiện cá nhân. Đệm lưng thoáng khí và quai đeo êm ái giúp bạn di chuyển thoải mái trên sân tập hay trong cuộc sống thường ngày.', '2025-06-05 10:23:11', '2025-06-27 04:11:48', 0),
(36, 14, 1, 'BALO NIKE AIR ELITE 2.0', 500000.00, 'assets/images/1749112643-Balo-BALO NIKE AIR ELITE 2.0-01.png', 'assets/images/1749112643-Balo-BALO NIKE AIR ELITE 2.0-02.webp', 'Balo Nike Air Elite 2.0 là phiên bản nâng cấp với thiết kế thể thao tối ưu, phù hợp cho cả tập luyện lẫn di chuyển hàng ngày. Balo sở hữu ngăn chính rộng rãi chứa được bóng rổ, laptop và đồ dùng cá nhân, đi kèm nhiều ngăn phụ tiện lợi. Chất liệu vải cao cấp chống thấm, phần lưng và quai đeo được đệm êm tạo sự thoải mái tối đa. Phong cách năng động, logo Nike đặc trưng tôn lên vẻ chuyên nghiệp cho người dùng.', '2025-06-05 10:24:05', '2025-06-27 04:12:14', 0),
(37, 14, 1, 'BALO NIKE AIR ELITE', 700000.00, 'assets/images/1749112719-Balo-BALO NIKE AIR ELITE-01.png', 'assets/images/1749112719-Balo-BALO NIKE AIR ELITE-02.webp', 'Balo Nike Air Elite mang đến sự kết hợp hoàn hảo giữa thiết kế thể thao hiện đại và tiện ích đa năng. Với ngăn chính rộng, balo giúp bạn dễ dàng mang theo bóng rổ, giày, laptop và đồ dùng cá nhân. Chất liệu cao cấp, khả năng chống thấm tốt, cùng phần đệm lưng và quai đeo êm ái hỗ trợ di chuyển thoải mái suốt cả ngày. Logo Nike nổi bật tạo điểm nhấn đậm chất thể thao cho người chơi chuyên nghiệp lẫn người dùng năng động.', '2025-06-05 10:38:39', '2025-06-27 04:12:36', 0),
(38, 14, 1, 'BALO NIKE BRASILIA', 600000.00, 'assets/images/1749112761-Balo-BALO NIKE BRASILIA-01.png', 'assets/images/1749112777-Balo-BALO NIKE BRASILIA-02.webp', 'Balo Nike Brasilia là mẫu balo thể thao đa năng lý tưởng cho cả luyện tập và sử dụng hằng ngày. Thiết kế gọn nhẹ nhưng vẫn đảm bảo không gian rộng rãi để đựng bóng rổ, quần áo, laptop và phụ kiện cá nhân. Chất liệu polyester bền bỉ, kháng nước nhẹ giúp bảo vệ tốt đồ dùng bên trong. Quai đeo và mặt lưng có lớp đệm êm ái, thoáng khí, hỗ trợ di chuyển thoải mái. Logo Nike tinh tế tạo điểm nhấn cho phong cách năng động.', '2025-06-05 10:39:21', '2025-06-27 04:12:52', 0),
(39, 14, 1, 'BALO NIKE SWOOSH', 650000.00, 'assets/images/1749112817-Balo-BALO NIKE SWOOSH-01.png', 'assets/images/1749112817-Balo-BALO NIKE SWOOSH-02.webp', 'Balo Nike Swoosh nổi bật với thiết kế hiện đại, logo Swoosh đặc trưng tạo điểm nhấn mạnh mẽ cho phong cách thể thao đường phố. Ngăn chính rộng rãi, dễ dàng chứa bóng rổ, laptop và các vật dụng cần thiết. Chất liệu cao cấp, chống thấm nhẹ, bền bỉ theo thời gian. Quai đeo có đệm êm và lưng balo thoáng khí giúp người dùng luôn thoải mái trong suốt quá trình di chuyển hay luyện tập.', '2025-06-05 10:40:17', '2025-06-27 04:13:12', 0),
(40, 13, 8, 'BĂNG GỐI HỖ TRỢ CHẤN THƯƠNG GOODFIT', 219000.00, 'assets/images/1749112956-Băng-BĂNG GỐI HỖ TRỢ CHẤN THƯƠNG GOODFIT-01.png', 'assets/images/1749112956-Băng-BĂNG GỐI HỖ TRỢ CHẤN THƯƠNG GOODFIT-02.png', 'Băng gối hỗ trợ chấn thương GoodFit là giải pháp lý tưởng cho người chơi thể thao cần bảo vệ và ổn định khớp gối trong quá trình vận động. Thiết kế ôm sát, co giãn linh hoạt giúp cố định đầu gối mà không gây khó chịu. Chất liệu vải thoáng khí, thấm hút mồ hôi tốt, phù hợp sử dụng khi chơi bóng rổ, chạy bộ hoặc phục hồi sau chấn thương. Giúp bạn yên tâm thi đấu với cảm giác chắc chắn và an toàn.', '2025-06-05 10:42:36', '2025-06-27 04:13:37', 0),
(41, 13, 7, 'BĂNG GỐI THỂ THAO 2IN1 GOODFIT', 250000.00, 'assets/images/1749112996-Băng-BĂNG GỐI THỂ THAO 2IN1 GOODFIT-01.png', 'assets/images/1749113019-Băng-BĂNG GỐI THỂ THAO 2IN1 GOODFIT-01.png', 'Băng gối thể thao 2in1 GoodFit là sự kết hợp giữa khả năng bảo vệ đầu gối và hỗ trợ vận động tối ưu. Thiết kế 2 trong 1 thông minh giúp cố định khớp gối và tăng cường sự ổn định khi chơi thể thao cường độ cao như bóng rổ, bóng đá hay gym. Chất liệu co giãn 4 chiều, thoáng khí, thấm hút mồ hôi, mang lại cảm giác thoải mái suốt thời gian sử dụng. Lý tưởng cho cả phòng ngừa chấn thương lẫn phục hồi sau va chạm.', '2025-06-05 10:43:16', '2025-06-27 04:13:54', 0),
(42, 13, 7, 'BĂNG GỐI THỂ THAO GOODFIT', 225000.00, 'assets/images/1749113058-Băng-BĂNG GỐI THỂ THAO GOODFIT-01.png', 'assets/images/1749113058-Băng-BĂNG GỐI THỂ THAO GOODFIT-01.png', 'Băng gối thể thao GoodFit được thiết kế chuyên dụng cho người chơi thể thao, đặc biệt là các môn vận động mạnh như bóng rổ, chạy bộ, gym. Sản phẩm giúp cố định và bảo vệ khớp gối, giảm nguy cơ chấn thương và hỗ trợ phục hồi sau va chạm. Chất liệu co giãn đàn hồi, thoáng khí và thấm hút mồ hôi tốt, mang lại cảm giác dễ chịu và linh hoạt khi vận động. Phù hợp cho cả nam và nữ.', '2025-06-05 10:44:18', '2025-06-27 04:14:16', 0),
(43, 11, 7, 'BANH AKPRO AB9008', 700000.00, 'assets/images/1749113219-Banh-BANH AKPRO AB9008-01.png', 'assets/images/1749113219-Banh-BANH AKPRO AB9008-02.png', 'Bóng rổ AKPro AB9008 là lựa chọn tuyệt vời cho cả luyện tập và thi đấu phong trào. Thiết kế tiêu chuẩn với độ nảy ổn định, bề mặt vân nổi tăng độ bám giúp kiểm soát bóng tốt hơn khi chuyền, ném hoặc rê bóng. Chất liệu cao su tổng hợp bền bỉ, phù hợp chơi cả trong nhà và ngoài trời. Đường may và lớp lõi được gia cố chắc chắn, đảm bảo độ bền lâu dài sau nhiều lần sử dụng.', '2025-06-05 10:46:59', '2025-06-27 04:14:33', 0),
(44, 11, 7, 'BANH BÓNG RỔ TARMAK R900', 500000.00, 'assets/images/1749113310-Banh-BANH BÓNG RỔ TARMAK R900-01.png', 'assets/images/1749113310-Banh-BANH BÓNG RỔ TARMAK R900-01.png', 'Bóng rổ Tarmak R900 là dòng bóng cao cấp dành cho thi đấu và tập luyện cường độ cao. Bề mặt làm từ da PU chất lượng cao với vân nổi chống trượt, cho cảm giác cầm chắc tay và kiểm soát bóng tối ưu. Cấu trúc 12 miếng ghép tăng độ bền và độ nảy đồng đều. Bóng phù hợp sử dụng cả trên sân trong nhà lẫn ngoài trời, lý tưởng cho vận động viên và người chơi bóng chuyên nghiệp.', '2025-06-05 10:48:30', '2025-06-27 04:14:49', 0),
(45, 11, 7, 'BANH LI-NING WADE', 100000.00, 'assets/images/1749113442-Banh-BANH LI-NING WADE-01.png', 'assets/images/1749113442-Banh-BANH LI-NING WADE-02.png', 'Bóng rổ Li-Ning Wade là dòng bóng cao cấp thuộc bộ sưu tập mang tên huyền thoại Dwyane Wade, kết hợp giữa hiệu năng thi đấu và phong cách đẳng cấp. Thiết kế nổi bật với họa tiết hiện đại, lớp vỏ cao su tổng hợp chống trượt giúp kiểm soát bóng tối ưu. Cấu trúc chắc chắn cho độ nảy ổn định, phù hợp chơi trên cả sân ngoài trời lẫn trong nhà. Lựa chọn hoàn hảo cho người yêu bóng rổ muốn thể hiện cá tính và kỹ năng.', '2025-06-05 10:50:42', '2025-06-27 04:15:15', 0),
(47, 11, 1, 'BANH MOLTEN FIBA 3X3', 950000.00, 'assets/images/1749113516-Banh-BANH MOLTEN FIBA 3X3-01.png', 'assets/images/1749113543-Banh-BANH MOLTEN FIBA 3X3-02.png', 'Bóng rổ Molten FIBA 3x3 là mẫu bóng thi đấu chính thức được sử dụng trong các giải 3x3 do FIBA tổ chức. Thiết kế chuẩn size 6 nhưng trọng lượng tương đương size 7, giúp tăng tốc độ và cảm giác khi thi đấu. Lớp vỏ da PU cao cấp bám tay tốt, cho khả năng kiểm soát và rê bóng vượt trội trong điều kiện thi đấu ngoài trời. Đường rãnh sâu, độ nảy ổn định, mang đến hiệu suất thi đấu chuyên nghiệp và độ bền cao.', '2025-06-05 10:51:56', '2025-06-27 04:15:32', 0),
(48, 11, 1, 'BANH NIKE GIANNIS ALL-COURT', 1500000.00, 'assets/images/1749113647-Banh-BANH NIKE GIANNIS ALL-COURT-01.png', 'assets/images/1749113647-Banh-BANH NIKE GIANNIS ALL-COURT-02.png', 'Bóng rổ Nike Giannis All-Court là dòng bóng được thiết kế dành riêng cho ngôi sao NBA Giannis Antetokounmpo – biểu tượng của sức mạnh, tốc độ và sự bùng nổ. Bóng sở hữu bề mặt cao su tổng hợp cao cấp, có độ bám tốt, giúp kiểm soát bóng tối ưu khi rê bóng, chuyền hoặc ném rổ. Thiết kế rãnh sâu tăng cảm giác cầm nắm chắc chắn, phù hợp cho cả sân trong nhà và ngoài trời. Họa tiết đặc trưng mang phong cách cá nhân của Giannis tạo nên điểm nhấn nổi bật, vừa chất thể thao vừa đậm tính thời trang. Một lựa chọn lý tưởng cho người chơi yêu thích sự khác biệt và muốn thể hiện phong cách cá nhân trên sân bóng.', '2025-06-05 10:54:07', '2025-06-27 04:16:03', 0),
(49, 11, 5, 'BANH TARMAK BT500 CONTROL', 600000.00, 'assets/images/1749113698-Banh-BANH TARMAK BT500 CONTROL-01.png', 'assets/images/1749113698-Banh-BANH TARMAK BT500 CONTROL-02.png', 'Bóng rổ Tarmak BT500 Control là lựa chọn hoàn hảo cho người chơi tìm kiếm sự kiểm soát bóng chính xác và cảm giác cầm nắm vượt trội. Với lớp vỏ làm từ cao su tổng hợp chất lượng cao và bề mặt vân nổi đặc biệt, bóng cho độ bám tay tốt ngay cả khi tay ra mồ hôi, giúp tăng hiệu suất rê bóng, chuyền và ném rổ. Cấu trúc bóng gồm 12 miếng ghép được tối ưu hóa để đảm bảo độ nảy ổn định và độ bền lâu dài. Phù hợp sử dụng cho cả sân trong nhà và ngoài trời, BT500 Control là bạn đồng hành lý tưởng cho những buổi luyện tập hay thi đấu phong trào.', '2025-06-05 10:54:58', '2025-06-27 04:16:20', 0),
(50, 11, 4, 'BANH TARMAK BT500X FIBA', 500000.00, 'assets/images/1749113769-Banh-BANH TARMAK BT500X FIBA-01.png', 'assets/images/1749113769-Banh-BANH TARMAK BT500X FIBA-01.png', 'Bóng rổ Tarmak BT500X FIBA là dòng bóng đạt chuẩn thi đấu FIBA, được thiết kế dành cho những người chơi nghiêm túc và chuyên nghiệp. Với lớp vỏ PU cao cấp kết hợp bề mặt nhám giúp tăng độ bám, bóng mang lại khả năng kiểm soát tuyệt vời trong mọi pha xử lý. Cấu trúc 12 miếng ghép giúp phân bố lực đều, cho độ nảy ổn định và cảm giác cầm chắc tay. Bóng phù hợp sử dụng trên cả sân trong nhà và ngoài trời, đảm bảo độ bền vượt trội sau nhiều lần sử dụng. Họa tiết hiện đại cùng logo chứng nhận FIBA tạo nên điểm nhấn đẳng cấp cho người dùng.', '2025-06-05 10:56:09', '2025-06-27 04:16:38', 0),
(51, 11, 6, 'BANH TARMAK BT900X FIBA', 1500000.00, 'assets/images/1749113819-Banh-BANH TARMAK BT900X FIBA-01.png', 'assets/images/1749113819-Banh-BANH TARMAK BT900X FIBA-02.png', 'Bóng rổ Tarmak BT900X FIBA là mẫu bóng thi đấu cao cấp nhất của thương hiệu Tarmak, được chứng nhận bởi FIBA – đảm bảo tiêu chuẩn khắt khe về chất lượng và hiệu năng. Bề mặt da tổng hợp PU mềm mại nhưng siêu bền, vân bóng thiết kế dạng rãnh sâu giúp tăng độ bám và kiểm soát bóng tối ưu trong mọi tình huống thi đấu. Lõi bóng được thiết kế đặc biệt nhằm duy trì độ nảy đều, ổn định và chính xác. BT900X lý tưởng cho các trận đấu chuyên nghiệp trên sân trong nhà, mang lại cảm giác bóng thật tay và đẳng cấp thi đấu vượt trội. Thiết kế hiện đại, phối màu mạnh mẽ tôn lên phong cách chuyên nghiệp của người chơi.', '2025-06-05 10:56:59', '2025-06-27 04:17:15', 0),
(52, 8, 3, 'JORDAN 6 CNY', 8000000.00, 'assets/images/1749114427-Jordan-JORDAN 6 CNY-01.webp', 'assets/images/1749113902-Jordan-JORDAN 6 CNY-02.webp', 'Jordan 6 CNY (Chinese New Year) là phiên bản đặc biệt được thiết kế để chào mừng Tết Nguyên Đán, kết hợp giữa văn hóa Á Đông và phong cách thể thao đặc trưng của Jordan. Đôi giày nổi bật với các họa tiết pháo hoa, hoa mai được in chìm tinh tế trên nền chất liệu da và vải cao cấp. Phần đế Air đặc trưng của Jordan 6 mang lại độ êm ái và đàn hồi vượt trội khi di chuyển. Thiết kế phối màu đen – vàng – đỏ vừa mạnh mẽ, vừa mang ý nghĩa may mắn, phồn vinh theo truyền thống Á Đông. Đây là đôi giày không chỉ dành cho người yêu sneaker, mà còn là một món đồ sưu tầm đầy giá trị văn hóa.', '2025-06-05 10:58:22', '2025-06-27 04:17:37', 0),
(53, 8, 3, 'JORDAN 38 FIBA', 6000000.00, 'assets/images/1749113957-Jordan-JORDAN 38 FIBA-01.webp', 'assets/images/1749113957-Jordan-JORDAN 38 FIBA-02.png', 'Jordan 38 FIBA là phiên bản đặc biệt trong dòng giày thi đấu hiệu năng cao của Jordan Brand, được phát hành nhằm tôn vinh tinh thần thể thao toàn cầu tại giải đấu FIBA. Thiết kế hiện đại với phối màu nổi bật, lấy cảm hứng từ quốc tế, kết hợp cùng công nghệ tiên tiến giúp tối ưu hóa sức bật, tốc độ và khả năng chuyển hướng. Đế giày được tích hợp công nghệ Zoom Air Strobel toàn bàn chân, cho cảm giác phản hồi nhanh và êm ái. Phần thân sử dụng chất liệu len woven độc quyền, nhẹ và ôm chân, tăng độ linh hoạt và hỗ trợ tối đa trong các pha xử lý nhanh. Jordan 38 FIBA không chỉ là một đôi giày thi đấu hiệu quả mà còn là biểu tượng thời trang mạnh mẽ dành cho các baller đích thực.', '2025-06-05 10:59:17', '2025-06-27 04:17:56', 0),
(54, 8, 3, 'JORDAN LUKA 1 EASTER', 4500000.00, 'assets/images/1749114006-Jordan-JORDAN LUKA 1 EASTER-01.webp', 'assets/images/1749114006-Jordan-JORDAN LUKA 1 EASTER-02.webp', 'Jordan Luka 1 \"Easter\" là phiên bản đặc biệt lấy cảm hứng từ lễ Phục Sinh, dành riêng cho ngôi sao NBA Luka Dončić. Đôi giày nổi bật với phối màu pastel nhẹ nhàng – hồng, xanh mint và tím nhạt – mang lại cảm giác tươi mới, trẻ trung nhưng vẫn giữ được chất thể thao mạnh mẽ. Được trang bị công nghệ IsoPlate hỗ trợ chuyển hướng nhanh và Cushion Formula 23 độc quyền, đôi giày giúp tối ưu hiệu suất khi di chuyển linh hoạt trên sân. Phần upper làm từ chất liệu mesh thoáng khí, ôm chân nhưng vẫn nhẹ và bền. Jordan Luka 1 Easter không chỉ phù hợp để thi đấu mà còn dễ dàng phối đồ thời trang ngoài sân bóng.', '2025-06-05 11:00:06', '2025-06-27 04:18:13', 0),
(55, 8, 3, 'JORDAN LUKA 2 CAVES', 2450000.00, 'assets/images/1749114060-Jordan-JORDAN LUKA 2 CAVES-01.webp', 'assets/images/1749114060-Jordan-JORDAN LUKA 2 CAVES-02.webp', 'Jordan Luka 2 \"Caves\" là phiên bản mang phong cách bí ẩn và mạnh mẽ, lấy cảm hứng từ hang động – nơi biểu tượng cho sự tập trung, tiềm lực và bùng nổ. Phối màu đậm chất thiên nhiên với các tông xám, đen và xanh dương đậm tạo nên diện mạo độc đáo, cá tính. Đôi giày được trang bị công nghệ IsoPlate 2.0 nâng cấp, giúp hỗ trợ ổn định khi thay đổi hướng nhanh, kết hợp cùng cushion Formula 23 cho cảm giác êm ái, đàn hồi trong từng bước di chuyển. Phần upper kết hợp nhiều lớp chất liệu thoáng khí và chắc chắn, tối ưu cho thi đấu cường độ cao. Luka 2 \"Caves\" là lựa chọn hoàn hảo cho những ai muốn thể hiện kỹ thuật và cá tính trên sân bóng.', '2025-06-05 11:01:00', '2025-06-27 04:18:33', 0),
(56, 8, 3, 'JORDAN LUKA 2 NEBULA', 2900000.00, 'assets/images/1749114126-Jordan-JORDAN LUKA 2 NEBULA-01.webp', 'assets/images/1749114126-Jordan-JORDAN LUKA 2 NEBULA-02.webp', 'Jordan Luka 2 \"Nebula\" là phiên bản nổi bật trong bộ sưu tập giày thi đấu của Luka Dončić, lấy cảm hứng từ những dải tinh vân ngoài vũ trụ – tượng trưng cho sự sáng tạo, bùng nổ và không giới hạn. Đôi giày gây ấn tượng với phối màu tím, hồng và xanh ánh sáng, mang đến diện mạo đầy tương lai và phá cách. Được trang bị công nghệ IsoPlate 2.0 tăng độ ổn định khi thay đổi hướng đột ngột, kết hợp cùng Formula 23 Foam mang lại cảm giác đàn hồi và phản hồi tốt trong từng pha di chuyển. Phần upper sử dụng vật liệu nhẹ, thoáng khí, ôm chân chắc chắn, hỗ trợ thi đấu hiệu quả cả trong các trận đấu tốc độ cao. Luka 2 “Nebula” không chỉ là một đôi giày thể thao – mà còn là tuyên ngôn về cá tính và đam mê.', '2025-06-05 11:02:06', '2025-06-27 04:18:54', 0),
(57, 8, 3, 'JORDAN LUKA 2 NEUTRA', 3500000.00, 'assets/images/1749114203-Jordan-JORDAN LUKA 2 NEUTRA-01.webp', 'assets/images/1749114203-Jordan-JORDAN LUKA 2 NEUTRA-02.webp', 'Jordan Luka 2 \"Neutra\" là phiên bản mang phong cách tối giản và trung tính trong bộ sưu tập giày thi đấu của Luka Dončić. Với phối màu nhã nhặn gồm các tông trắng, xám và kem, đôi giày dễ dàng kết hợp với mọi phong cách thi đấu lẫn thời trang đường phố. Được trang bị công nghệ IsoPlate 2.0 giúp tăng độ ổn định và phản hồi khi di chuyển ngang, cùng Formula 23 Foam ở đế giữa mang lại độ êm ái và đàn hồi tối đa. Upper cấu tạo từ vật liệu đa lớp siêu nhẹ, thoáng khí và ôm chân giúp bạn luôn cảm thấy linh hoạt và thoải mái trong suốt trận đấu. Luka 2 \"Neutra\" là lựa chọn lý tưởng cho những ai yêu thích hiệu năng cao với vẻ ngoài đơn giản nhưng đầy tinh tế.', '2025-06-05 11:03:23', '2025-06-27 04:19:20', 0),
(58, 8, 3, 'JORDAN LUKA 2 QUAI54', 3590000.00, 'assets/images/1749114260-Jordan-JORDAN LUKA 2 QUAI54-01.webp', 'assets/images/1749114260-Jordan-JORDAN LUKA 2 QUAI54-02.webp', 'Jordan Luka 2 \"Quai54\" là phiên bản đặc biệt nằm trong bộ sưu tập hợp tác giữa Jordan Brand và giải đấu bóng rổ đường phố danh tiếng Quai 54 tại Paris. Đôi giày mang đậm chất văn hóa đường phố châu Âu với phối màu độc đáo, họa tiết mang hơi hướng châu Phi và logo Quai54 đặc trưng được thêu nổi bật. Bên cạnh thiết kế phá cách, Luka 2 Quai54 vẫn giữ nguyên hiệu năng cao cấp với công nghệ IsoPlate 2.0 hỗ trợ chuyển hướng nhanh và Formula 23 Foam mang lại độ êm, độ nảy vượt trội. Upper sử dụng vật liệu mesh đa lớp, nhẹ, thoáng khí và ôm chân tốt – giúp bạn chơi bóng ở cường độ cao mà vẫn thoải mái. Đây không chỉ là một đôi giày thi đấu, mà còn là một tuyên ngôn về cá tính và văn hóa bóng rổ đường phố.', '2025-06-05 11:04:20', '2025-06-27 04:19:38', 0),
(59, 8, 3, 'JORDAN TATUM 1 DENIM', 3800000.00, 'assets/images/1749114331-Jordan-JORDAN TATUM 1 DENIM-01.webp', 'assets/images/1749114331-Jordan-JORDAN TATUM 1 DENIM-02.webp', 'Jordan Tatum 1 \"Denim\" là phiên bản đầy cá tính và khác biệt của dòng giày thi đấu đầu tiên mang tên ngôi sao NBA Jayson Tatum. Lấy cảm hứng từ chất liệu denim quen thuộc trong thời trang đường phố, đôi giày sở hữu phần upper làm từ vải jeans phối cùng da tổng hợp, tạo nên phong cách vừa bụi bặm vừa hiện đại. Dù mang tính thời trang cao, Tatum 1 \"Denim\" vẫn đảm bảo hiệu năng thi đấu nhờ thiết kế siêu nhẹ – là một trong những mẫu giày thi đấu nhẹ nhất của Jordan Brand. Đế giữa tích hợp cushion foam hỗ trợ lực bật, kết hợp cấu trúc hỗ trợ bên hông tăng độ ổn định khi đổi hướng. Đây là lựa chọn lý tưởng cho những baller muốn thể hiện kỹ thuật và gu thời trang nổi bật trên sân bóng.', '2025-06-05 11:05:31', '2025-06-27 04:19:57', 0),
(60, 8, 3, 'JORDAN TATUM 2 VORTEX', 3090000.00, 'assets/images/1749114379-Jordan-JORDAN TATUM 2 VORTEX-01.webp', 'assets/images/1749114379-Jordan-JORDAN TATUM 2 VORTEX-02.png', 'Jordan Tatum 2 \"Vortex\" là phiên bản mang phong cách năng động và hiện đại, thuộc thế hệ giày thi đấu thứ hai của ngôi sao Jayson Tatum. Lấy cảm hứng từ sự xoáy chuyển và tốc độ trong lối chơi của Tatum, phối màu \"Vortex\" nổi bật với các sắc tím, xanh, cam kết hợp tạo hiệu ứng chuyển động độc đáo như một cơn lốc xoáy trên sân bóng. Thiết kế upper cấu trúc nhiều lớp với chất liệu nhẹ, thoáng khí và ôm chân, giúp người chơi duy trì sự linh hoạt tối đa. Phần đế giữa tích hợp công nghệ Zoom Air ở mũi giày và cushion foam nhẹ, cho độ nảy cao và phản hồi nhanh trong các pha bật nhảy, tăng tốc. Đế ngoài có hoa văn đa hướng giúp bám sân hiệu quả, kể cả trên sân trong nhà hay ngoài trời. Jordan Tatum 2 \"Vortex\" là sự kết hợp giữa hiệu năng mạnh mẽ và cá tính nổi bật – dành cho những ai muốn làm chủ cuộc chơi.', '2025-06-05 11:06:19', '2025-06-27 04:20:21', 0),
(61, 8, 6, 'LI-NING SPEED 10', 1999998.00, 'assets/images/1749114542-Lining-LI-NING SPEED 10-01.webp', 'assets/images/1749114542-Lining-LI-NING SPEED 10-02.webp', 'Li-Ning Speed 10 là mẫu giày bóng rổ hiệu năng cao dành cho những cầu thủ thiên về tốc độ và khả năng bứt phá. Với thiết kế tối ưu trọng lượng, Speed 10 mang lại cảm giác nhẹ, linh hoạt và cực kỳ thoải mái trong từng bước chạy. Giày được trang bị công nghệ Light Foam độc quyền của Li-Ning, giúp tăng độ êm ái và phản hồi nhanh trong các pha bật nhảy và dứt điểm. Phần upper cấu tạo từ vật liệu dệt kỹ thuật cao, kết hợp khung bảo vệ bên hông giúp ổn định cổ chân mà vẫn đảm bảo độ thoáng khí. Đế ngoài có độ bám cao, phù hợp với nhiều mặt sân, giúp người chơi tự tin xử lý kỹ thuật và chuyển hướng đột ngột. Li-Ning Speed 10 là lựa chọn hoàn hảo cho những ai yêu thích phong cách chơi tốc độ, linh hoạt và đầy bùng nổ.', '2025-06-05 11:09:02', '2025-06-27 04:20:40', 0),
(62, 8, 6, 'LI-NING WADE ALL CITY 12 CITY OF ANGELS', 3000000.00, 'assets/images/1749114596-Lining-LI-NING WADE ALL CITY 12 CITY OF ANGELS-01.webp', 'assets/images/1749114596-Lining-LI-NING WADE ALL CITY 12 CITY OF ANGELS-02.png', 'Li-Ning Wade All City 12 \"City of Angels\" là phiên bản đặc biệt trong dòng giày thi đấu đình đám của Dwyane Wade, lấy cảm hứng từ vẻ đẹp huyền ảo và hoa lệ của thành phố Los Angeles. Thiết kế phối màu pastel nhẹ nhàng, kết hợp giữa xanh baby, tím nhạt và trắng, tạo nên tổng thể thanh lịch mà vẫn đậm chất đường phố. Giày được trang bị công nghệ BOOM độc quyền của Li-Ning – giúp tăng độ nảy, phản hồi nhanh và êm ái tối đa trong từng pha bật nhảy. Cấu trúc đế ngoài với rãnh xẻ linh hoạt và độ bám cao, hỗ trợ di chuyển vững vàng trên sân. Phần upper dệt hiện đại, nhẹ và thoáng khí, ôm chân chắc chắn mà không gây bí nóng. Wade All City 12 \"City of Angels\" không chỉ là đôi giày hiệu năng cao mà còn là tuyên ngôn thời trang mang cá tính riêng của người chơi.', '2025-06-05 11:09:56', '2025-06-27 04:21:00', 0),
(63, 8, 6, 'LI-NING WADE ALL CITY 12 ORIGIN', 2900000.00, 'assets/images/1749114661-Lining-LI-NING WADE ALL CITY 12 ORIGIN-01.webp', 'assets/images/1749114661-Lining-LI-NING WADE ALL CITY 12 ORIGIN-02.webp', 'Li-Ning Wade All City 12 \"Origin\" là phiên bản đặc biệt mang đậm dấu ấn cá nhân của huyền thoại Dwyane Wade, lấy cảm hứng từ nguồn gốc và hành trình vươn lên trong sự nghiệp bóng rổ. Với phối màu chủ đạo là đen – vàng ánh kim, giày thể hiện sự mạnh mẽ, sang trọng và đầy bản lĩnh. Được trang bị công nghệ đệm Li-Ning BOOM cho khả năng bật nhảy nhanh và cảm giác êm ái vượt trội. Cấu trúc đế ngoài được thiết kế với các rãnh sâu và họa tiết chống trượt giúp tăng độ bám trên mọi mặt sân. Upper từ chất liệu dệt đa lớp kết hợp khung hỗ trợ bên hông, giúp ôm chân chắc chắn mà vẫn đảm bảo độ thoáng khí. Wade All City 12 \"Origin\" không chỉ mang lại hiệu năng thi đấu mạnh mẽ mà còn truyền cảm hứng về sự khởi đầu, nghị lực và đam mê.', '2025-06-05 11:11:01', '2025-06-27 04:21:22', 0),
(64, 8, 6, 'LI-NING WADE ALL CITY 12 SUNSHINE STATE', 2800000.00, 'assets/images/1749114785-Lining-LI-NING WADE ALL CITY 12 SUNSHINE STATE-01.webp', 'assets/images/1749114785-Lining-LI-NING WADE ALL CITY 12 SUNSHINE STATE-02.webp', 'Li-Ning Wade All City 12 \"Sunshine State\" là phiên bản đầy màu sắc và năng lượng, lấy cảm hứng từ tiểu bang Florida – quê nhà của huyền thoại Dwyane Wade và nơi gắn liền với những năm tháng rực rỡ trong sự nghiệp của anh. Phối màu rực rỡ với cam, vàng và xanh pastel gợi lên hình ảnh nắng vàng, biển xanh và bầu trời trong vắt của miền đất nhiệt đới. Giày được trang bị công nghệ đệm Li-Ning BOOM cho phản hồi nhanh, độ bật cao và êm ái trong từng bước di chuyển. Phần upper từ chất liệu dệt thoáng khí, nhẹ và ôm chân tốt, giúp bạn thoải mái thi đấu cường độ cao. Đế ngoài có độ bám cao, hỗ trợ các pha chuyển hướng, tăng tốc chính xác. Wade All City 12 \"Sunshine State\" không chỉ là giày thi đấu hiệu năng cao mà còn là biểu tượng của tự do, năng động và phong cách sống tích cực.', '2025-06-05 11:13:05', '2025-06-27 04:21:41', 0),
(65, 8, 6, 'LI-NING WADE ALL CITY 12 YEAR OF DRAGON', 3000000.00, 'assets/images/1749114845-Lining-LI-NING WADE ALL CITY 12 YEAR OF DRAGON-01.webp', 'assets/images/1749114845-Lining-LI-NING WADE ALL CITY 12 YEAR OF DRAGON-02.png', 'Li-Ning Wade All City 12 \"Year of the Dragon\" là phiên bản giới hạn đặc biệt được phát hành nhân dịp Tết Nguyên Đán 2024 – năm con Rồng, mang đậm yếu tố văn hóa phương Đông kết hợp cùng hiệu năng thi đấu đỉnh cao. Thiết kế lấy cảm hứng từ hình tượng Rồng – biểu tượng của sức mạnh, may mắn và quyền uy – với phối màu đỏ, vàng và xanh ngọc đầy ấn tượng cùng các họa tiết rồng cách điệu tinh xảo ở thân giày. Giày được trang bị công nghệ đệm Li-Ning BOOM giúp tăng lực bật, hấp thụ lực tốt và phản hồi nhanh chóng trong thi đấu. Upper làm từ chất liệu dệt kỹ thuật cao cấp, nhẹ, thoáng khí và ôm chân, kết hợp khung bên hông giúp tăng độ ổn định. Đây không chỉ là đôi giày thể thao hiệu năng cao mà còn là món đồ sưu tầm mang giá trị văn hóa và tinh thần châu Á mạnh mẽ.', '2025-06-05 11:14:05', '2025-06-27 04:22:05', 0),
(66, 8, 6, 'LI-NING WADE FLASH CRACKS', 3000000.00, 'assets/images/1749114947-Lining-LI-NING WADE FLASH CRACKS-01.webp', 'assets/images/1749114947-Lining-LI-NING WADE FLASH CRACKS-02.webp', 'Li-Ning Wade Flash \"Cracks\" là mẫu giày mang thiết kế táo bạo, lấy cảm hứng từ những vết nứt mạnh mẽ – tượng trưng cho sức mạnh bùng nổ và khả năng phá vỡ mọi giới hạn trên sân bóng. Với phối màu đen – xám – trắng kết hợp họa tiết \"crack\" đầy chất đường phố, đôi giày thể hiện cá tính mạnh mẽ và tinh thần thi đấu quyết liệt. Giày được trang bị đệm Li-Ning Light Foam giúp giảm chấn, phản hồi nhanh và hỗ trợ tốt cho các pha bật nhảy, tăng tốc. Upper sử dụng chất liệu dệt nhẹ, ôm chân và thoáng khí, phù hợp với thi đấu cường độ cao. Đế ngoài có hoa văn chống trượt độc quyền, đảm bảo độ bám và độ ổn định trên nhiều loại mặt sân.', '2025-06-05 11:15:47', '2025-06-27 04:22:25', 0),
(67, 8, 6, 'LI-NING WADE FLASH RAZ FUEGO', 2500000.00, 'assets/images/1749114989-Lining-LI-NING WADE FLASH RAZ FUEGO-01.webp', 'assets/images/1749114989-Lining-LI-NING WADE FLASH RAZ FUEGO-02.webp', 'Li-Ning Wade Flash \"Raz Fuego\" là phiên bản nổi bật trong dòng giày Wade Flash, mang đậm phong cách lửa cháy mãnh liệt và tinh thần thi đấu rực lửa. Với phối màu đỏ – cam – đen rực rỡ như ngọn lửa bùng nổ trên sân bóng, \"Raz Fuego\" đại diện cho sức mạnh, tốc độ và sự bùng nổ trong từng pha xử lý. Giày được trang bị đệm Light Foam giúp giảm chấn hiệu quả, tạo cảm giác nhẹ và linh hoạt khi di chuyển nhanh. Upper làm từ chất liệu dệt kỹ thuật co giãn đa chiều, giúp ôm chân chắc chắn nhưng vẫn thoáng khí, phù hợp với các trận đấu cường độ cao. Đế ngoài có rãnh chống trượt sâu, đảm bảo độ bám chắc trên nhiều mặt sân, hỗ trợ tối đa trong các pha chuyển hướng đột ngột.', '2025-06-05 11:16:29', '2025-06-27 04:22:46', 0),
(68, 8, 6, 'LI-NING WOW SHADOW 5 V2 PINK BUTTERFLY', 2000000.00, 'assets/images/1749115055-Lining-LI-NING WOW SHADOW 5 V2 PINK BUTTERFLY-01.webp', 'assets/images/1749115055-Lining-LI-NING WOW SHADOW 5 V2 PINK BUTTERFLY-02.webp', 'Li-Ning Way of Wade Shadow 5 V2 \"Pink Butterfly\" là phiên bản giày thi đấu độc đáo, mang vẻ đẹp thanh thoát và cuốn hút như một cánh bướm giữa sân bóng. Với phối màu hồng pastel kết hợp các chi tiết ánh ngọc trai, đôi giày tạo nên sự nổi bật mềm mại nhưng vẫn giữ được chất thể thao mạnh mẽ. Lấy cảm hứng từ sự biến hóa và phát triển, Shadow 5 V2 \"Pink Butterfly\" tượng trưng cho sự chuyển mình của người chơi – từ tinh tế đến bùng nổ.\r\n\r\nGiày được trang bị đệm Li-Ning BOOM trải dài toàn bàn chân, cho khả năng đàn hồi cao và cảm giác phản hồi nhanh trong các pha bật nhảy và di chuyển ngang. Phần upper bằng lưới dệt đa lớp kết hợp khung hỗ trợ bên giúp ôm chân chắc chắn nhưng vẫn nhẹ và thoáng khí. Đế ngoài chống trượt hiệu quả, phù hợp cho cả sân indoor và outdoor.', '2025-06-05 11:17:35', '2025-06-27 04:23:07', 0),
(69, 8, 1, 'NIKE GT CUT ACADEMY', 2500000.00, 'assets/images/1749115202-NIKE-NIKE DUNK LOW-03.webp', 'assets/images/1749115202-NIKE-NIKE DUNK LOW-05.png', 'Nike GT Cut Academy là phiên bản tối ưu hóa từ dòng GT Cut nổi tiếng, mang đến hiệu năng thi đấu đáng tin cậy với mức giá dễ tiếp cận hơn – lý tưởng cho học sinh, sinh viên hoặc những người chơi phong trào nghiêm túc. Thiết kế nhẹ, linh hoạt và ôm chân, hỗ trợ di chuyển tốc độ và đổi hướng linh hoạt trên sân.\r\n\r\nĐược trang bị lớp đệm Nike React Foam êm ái kết hợp với đế ngoài vân hình học giúp tăng độ bám và độ bền, GT Cut Academy cho phép người chơi kiểm soát tốt các pha dừng đột ngột, đổi hướng và tăng tốc. Upper bằng lưới kỹ thuật thoáng khí, vừa giữ cho chân mát mẻ vừa đảm bảo độ ôm sát ổn định.\r\n\r\nLà lựa chọn thông minh cho những ai yêu thích cảm giác thi đấu của dòng GT Cut nhưng đang tìm kiếm một phiên bản gọn nhẹ và kinh tế hơn.', '2025-06-05 11:20:02', '2025-06-27 04:23:30', 0),
(70, 8, 1, 'NIKE GT CUT 3', 5000000.00, 'assets/images/1749115282-Nike-NIKE GT CUT 3-03.webp', 'assets/images/1749115282-Nike-NIKE GT CUT 3-05.webp', 'Nike GT Cut 3 là thế hệ mới nhất trong dòng Greater Than (GT) Series, được thiết kế dành riêng cho các cầu thủ thiên về tốc độ, khả năng bứt phá và xử lý kỹ thuật ở cường độ cao. Phiên bản này mang đến bước nhảy vọt về công nghệ khi lần đầu tiên được trang bị phần đế ZoomX – loại đệm cao cấp nhất của Nike từng chỉ xuất hiện trên giày chạy chuyên nghiệp, mang lại cảm giác siêu nhẹ, phản hồi nhanh và độ đàn hồi vượt trội.\r\nCấu trúc giày cắt thấp (low-cut) cho phép người chơi linh hoạt tối đa trong các pha chuyển hướng, đổi tốc đột ngột và dừng nhanh. Phần upper làm bằng lưới dệt đa lớp kết hợp khung hỗ trợ bên hông, giúp ôm chân chắc chắn mà vẫn thông thoáng. Đế ngoài với thiết kế vân ma sát hình học hỗ trợ độ bám trên cả mặt sân indoor lẫn outdoor.\r\nGT Cut 3 là lựa chọn hàng đầu cho các baller theo phong cách “stop & go”, yêu cầu khả năng kiểm soát tốc độ cao và phản ứng tức thời.', '2025-06-05 11:21:22', '2025-06-27 04:24:07', 0),
(71, 8, 1, 'NIKE GT CUT ACADEMY', 7000000.00, 'assets/images/1749115316-NIKE-NIKE GT CUT ACADEMY-03.webp', 'assets/images/1749115316-NIKE-NIKE GT CUT ACADEMY-05.webp', 'Nike GT Cut Academy là phiên bản tinh gọn của dòng GT Cut danh tiếng, được thiết kế dành cho các cầu thủ yêu thích tốc độ, sự linh hoạt và hiệu năng cao nhưng với mức giá dễ tiếp cận hơn. Đôi giày sở hữu thiết kế low-top hiện đại, cho phép cử động cổ chân linh hoạt tối đa trong các pha bứt tốc, đổi hướng và dừng gấp.\r\nĐệm React Foam trải dài toàn bàn chân giúp hấp thụ lực tốt, mang lại cảm giác êm ái và ổn định khi thi đấu. Upper bằng lưới kỹ thuật nhẹ và thoáng khí, kết hợp với lớp gia cố tổng hợp ở những điểm chịu lực, đảm bảo độ bền mà không làm tăng trọng lượng giày. Đế ngoài được thiết kế với họa tiết hình học giúp tăng độ bám trên cả sân indoor và outdoor.\r\nGT Cut Academy là lựa chọn lý tưởng cho các baller trẻ, học sinh – sinh viên hoặc người chơi phong trào cần một đôi giày thi đấu đáng tin cậy với hiệu năng tốt và thiết kế ấn tượng.', '2025-06-05 11:21:56', '2025-06-27 04:24:34', 0),
(72, 8, 1, 'NIKE GIANNIS IMMORTALITY 3', 8500000.00, 'assets/images/1749115345-NIKE-NIKE GIANNIS IMMORTALITY 3-03.webp', 'assets/images/1749115345-NIKE-NIKE GIANNIS IMMORTALITY 3-05.png', 'Nike Giannis Immortality 3 là phiên bản mới nhất trong dòng giày thi đấu lấy cảm hứng từ MVP Giannis Antetokounmpo – biểu tượng của sức mạnh, tốc độ và sự bùng nổ. Với thiết kế low-top hiện đại cùng form dáng gọn gàng, đôi giày hỗ trợ tối đa cho các pha di chuyển dứt khoát và chuyển hướng đột ngột trên sân.\r\nPhần đế giữa sử dụng đệm phylon nhẹ kết hợp thiết kế uốn cong ở bàn chân trước giúp tối ưu khả năng bật nhảy và phản hồi nhanh. Đế ngoài có rãnh hình học sâu, tăng cường độ bám và độ linh hoạt trên cả mặt sân trong nhà và ngoài trời. Upper bằng lưới dệt nhiều lớp vừa thoáng khí vừa tạo cảm giác chắc chân.\r\nImmortality 3 là lựa chọn lý tưởng cho những cầu thủ thiên về lối chơi tốc độ, phản xạ nhanh và yêu thích sự linh hoạt trong từng bước chạy.', '2025-06-05 11:22:25', '2025-06-27 04:25:04', 0),
(73, 8, 1, 'NIKE JA 1 AIN\'T DUCKING NO SMOKE', 990000.00, '', '', '', '2025-06-05 11:23:58', '2025-06-08 09:55:25', 1),
(74, 8, 1, 'NIKE KD 16 ALL-STAR', 10000000.00, 'assets/images/1749115546-NIKE-NIKE KD 16 ALL-STAR-03.webp', 'assets/images/1749115546-NIKE-NIKE KD 16 ALL-STAR-05.webp', 'Nike KD 16 \"All-Star\" là phiên bản đặc biệt được thiết kế riêng cho sự kiện NBA All-Star, nơi quy tụ những ngôi sao xuất sắc nhất giải đấu. Mang tinh thần thi đấu đỉnh cao của Kevin Durant, KD 16 All-Star không chỉ nổi bật với phối màu độc đáo – thường sử dụng các tông tím, xanh hoặc metallic ánh sáng bắt mắt – mà còn sở hữu hiệu năng thi đấu vượt trội.\r\nGiày được trang bị đệm Zoom Air kép ở bàn trước kết hợp cushlon mềm mại ở đế giữa, mang lại cảm giác phản hồi nhanh, bật tốt và cực kỳ êm ái trong suốt trận đấu. Thiết kế form low-cut giúp cổ chân linh hoạt, trong khi phần khung TPU bên hông và lưỡi gà dày tăng cường độ ổn định và ôm chân. Upper bằng chất liệu mesh đa lớp kết hợp chi tiết da tổng hợp tạo nên vẻ ngoài cao cấp, hiện đại.\r\nKD 16 All-Star là sự lựa chọn hoàn hảo cho những người chơi kỹ thuật, cần sự cân bằng giữa độ êm, độ bám và tính ổn định trong thi đấu cường độ cao.', '2025-06-05 11:25:46', '2025-06-27 04:25:33', 0);
INSERT INTO `product` (`id`, `category_id`, `brand_id`, `title`, `price`, `thumbnail`, `thumbnail_2`, `description`, `created_at`, `updated_at`, `deleted`) VALUES
(75, 8, 1, 'NIKE KD 16 WANDA', 8500000.00, 'assets/images/1749115585-Nike-NIKE KD 16 WANDA-03.webp', 'assets/images/1749115585-Nike-NIKE KD 16 WANDA-05.webp', 'Nike KD 16 \"Wanda\" là phiên bản đặc biệt đầy ý nghĩa được Kevin Durant dành tặng riêng cho mẹ mình – bà Wanda Durant – người luôn là điểm tựa và nguồn động lực to lớn trong hành trình thi đấu của anh. Đôi giày mang phối màu nhẹ nhàng, trang nhã như hồng phấn, trắng và các chi tiết ánh kim, thể hiện sự trân trọng và tình cảm thiêng liêng giữa mẹ và con.\r\nVề hiệu năng, KD 16 Wanda vẫn giữ nguyên công nghệ cao cấp như bản tiêu chuẩn: đệm Zoom Air kép ở bàn chân trước kết hợp với lớp đệm Cushlon trải dài toàn lòng bàn chân – cho cảm giác êm ái, độ phản hồi cao và sự ổn định khi di chuyển mạnh. Upper bằng lưới kỹ thuật nhẹ và thoáng khí, kết hợp cùng phần khung bên bằng TPU tạo độ ôm và giữ chân vững chắc trong các pha đổi hướng nhanh.\r\nKD 16 \"Wanda\" không chỉ là một đôi giày bóng rổ hiệu năng cao, mà còn là biểu tượng tôn vinh tình mẫu tử và sự biết ơn sâu sắc.', '2025-06-05 11:26:25', '2025-06-27 04:26:03', 0),
(76, 8, 1, 'NIKE LEBRON NXXT GEN AMPD FIRST GAME', 4000000.00, 'assets/images/1749115624-NIKE-NIKE LEBRON NXXT GEN AMPD FIRST GAME-03.webp', 'assets/images/1749115624-NIKE-NIKE LEBRON NXXT GEN AMPD FIRST GAME-05.webp', 'Nike LeBron NXXT GEN AMPD \"First Game\" là phiên bản đặc biệt tôn vinh trận đấu NBA đầu tiên trong sự nghiệp huyền thoại của LeBron James vào năm 2003. Với phối màu đặc trưng đỏ – trắng – đen, đôi giày gợi lại hình ảnh King James thời trẻ khi lần đầu bước chân vào đấu trường NBA, mang theo kỳ vọng và khát khao chinh phục đỉnh cao.\r\nLeBron NXXT GEN AMPD là bản nâng cấp của dòng NXXT GEN, được thiết kế để phù hợp hơn với các cầu thủ trẻ, học sinh – sinh viên hoặc người chơi phong trào cần hiệu năng cao mà vẫn nhẹ và linh hoạt. Giày được trang bị Zoom Air kép ở bàn chân trước và gót, kết hợp đệm Phylon êm nhẹ, giúp hỗ trợ các pha bật nhảy, bứt tốc và đổi hướng linh hoạt. Upper sử dụng chất liệu lưới thoáng khí đa lớp, kết hợp khung hỗ trợ bên tăng độ ổn định khi di chuyển cường độ cao.\r\nPhiên bản \"First Game\" không chỉ là một đôi giày thi đấu hiệu quả, mà còn mang giá trị tinh thần – đánh dấu cột mốc khởi đầu của một huyền thoại bóng rổ.', '2025-06-05 11:27:04', '2025-06-27 04:26:28', 0),
(77, 8, 1, 'NIKE PG 5  CLIPPERS', 7000000.00, 'assets/images/1749115675-NIKE-NIKE PG 5  CLIPPERS-03.webp', 'assets/images/1749115675-NIKE-NIKE PG 5  CLIPPERS-05.webp', 'Nike PG 5 \"Clippers\" là phiên bản đặc biệt dành riêng cho Paul George – ngôi sao của Los Angeles Clippers – với phối màu đặc trưng xanh, đỏ và trắng đại diện cho màu áo đội bóng. Đôi giày kết hợp thiết kế gọn gàng, linh hoạt với hiệu năng ổn định, rất phù hợp cho các cầu thủ theo phong cách toàn diện – vừa công vừa thủ, vừa tốc độ vừa kiểm soát.\r\nPG 5 sử dụng hệ thống đệm full-length Nike Air Strobel, mang lại cảm giác êm ái và phản hồi nhanh trong từng bước chạy. Thiết kế low-top hỗ trợ di chuyển linh hoạt, trong khi phần upper bằng lưới kỹ thuật và vải tổng hợp giúp giày nhẹ, thoáng và ôm chân. Đế ngoài có vân dạng wave-pattern giúp tăng độ bám sân, hỗ trợ các pha dừng gấp, xoay người hoặc tăng tốc mượt mà.\r\nPhiên bản \"Clippers\" không chỉ là sự lựa chọn lý tưởng cho fan của Paul George mà còn là mẫu giày đáng tin cậy cho người chơi cần sự ổn định và phản xạ nhanh trên sân.', '2025-06-05 11:27:55', '2025-06-27 04:26:53', 0),
(78, 8, 1, 'NIKE PRECISION 7', 3500000.00, 'assets/images/1749115707-NIKE-NIKE PRECISION 7-03.webp', 'assets/images/1749115707-NIKE-NIKE PRECISION 7-05.webp', 'Nike Precision 7 là phiên bản mới nhất trong dòng giày bóng rổ tầm trung nổi bật với hiệu năng ổn định, thiết kế gọn nhẹ và mức giá dễ tiếp cận – rất phù hợp với học sinh, sinh viên hoặc người chơi phong trào. Precision 7 được nâng cấp với kiểu dáng thể thao hiện đại, mang lại cảm giác linh hoạt và thoải mái trong từng pha di chuyển.\r\nĐôi giày sử dụng đệm phylon nhẹ ở đế giữa, cho cảm giác êm ái và phản hồi tốt khi bật nhảy hoặc chuyển hướng. Upper làm từ vải lưới kỹ thuật kết hợp lớp phủ tổng hợp, giúp giữ độ bền trong khi vẫn đảm bảo độ thoáng khí. Phần cổ giày thiết kế dạng mid-cut ôm gọn cổ chân nhưng vẫn cho phép linh hoạt. Đế ngoài dạng xương cá (herringbone pattern) mang lại độ bám sân tốt, phù hợp cho cả sân indoor và outdoor.\r\nVới sự kết hợp giữa trọng lượng nhẹ – độ bám tốt – thiết kế đơn giản, Nike Precision 7 là lựa chọn thông minh cho người chơi theo phong cách tốc độ và kiểm soát.', '2025-06-05 11:28:27', '2025-06-27 04:27:21', 0),
(79, 8, 8, 'PEAK BASKETBALL SONIC BOOM', 6660000.00, 'assets/images/1749115786-Peak-PEAK BASKETBALL SONIC BOOM-03.webp', 'assets/images/1749115786-Peak-PEAK BASKETBALL SONIC BOOM-05.webp', 'PEAK Sonic Boom là dòng giày bóng rổ hiệu năng cao của PEAK, nổi bật với thiết kế hiện đại, đậm chất thể thao và công nghệ đệm tiên tiến, phù hợp với lối chơi thiên về tốc độ, bật nhảy và phản xạ nhanh. Sonic Boom được nhiều VĐV chuyên nghiệp lựa chọn nhờ khả năng hỗ trợ toàn diện từ công – thủ, đặc biệt là những pha dừng – đổi hướng – tăng tốc liên tục.\r\nGiày được trang bị công nghệ đệm P-Motive độc quyền của PEAK – nhẹ, đàn hồi tốt và hấp thụ lực hiệu quả. Phần upper sử dụng chất liệu lưới dệt đa lớp giúp thoáng khí nhưng vẫn chắc chắn, hỗ trợ ôm chân tốt khi di chuyển cường độ cao. Thiết kế low-top linh hoạt, kết hợp khung ổn định TPU bên hông giúp tăng độ vững vàng khi xoay trở nhanh. Đế ngoài có các rãnh hình học chống trượt, tối ưu độ bám trên sân.\r\nSonic Boom là lựa chọn lý tưởng cho những cầu thủ năng động, yêu thích phong cách bùng nổ và kiểm soát tốt trong từng bước chạy.', '2025-06-05 11:29:46', '2025-06-27 04:27:49', 0),
(80, 8, 8, 'PEAK LIGHTNING X PERFORMANCE', 7500000.00, 'assets/images/1749115820-Peak-PEAK LIGHTNING X PERFORMANCE-03.webp', 'assets/images/1749115820-Peak-PEAK LIGHTNING X PERFORMANCE-05.webp', 'PEAK Lightning X Performance là phiên bản hiệu năng cao trong dòng Lightning – được thiết kế cho các cầu thủ bóng rổ chuyên nghiệp và bán chuyên, đề cao sự nhanh nhẹn, phản xạ linh hoạt và ổn định khi thi đấu ở cường độ cao. Với thiết kế sắc sảo, đường nét khí động học và công nghệ hiện đại, Lightning X Performance mang đến sự cân bằng hoàn hảo giữa tốc độ và kiểm soát.\r\nGiày được tích hợp công nghệ đệm P-Superior cải tiến, kết hợp cùng P-Motive Foam ở đế giữa giúp tăng cường độ nảy, hỗ trợ bật nhảy mạnh mẽ và giảm chấn hiệu quả. Upper làm từ lưới dệt cao cấp đa lớp kết hợp các chi tiết fuse chống mài mòn, vừa đảm bảo độ thoáng khí vừa tăng độ bền khi thi đấu. Thiết kế khung TPU hỗ trợ bên hông và gót giúp cố định bàn chân, tăng độ ổn định khi xoay người hoặc đổi hướng nhanh. Đế ngoài được tối ưu với hoa văn chống trượt đa chiều, đảm bảo bám sân cực tốt trong mọi tình huống.\r\nPEAK Lightning X Performance là lựa chọn hàng đầu cho các cầu thủ thiên về lối chơi tốc độ, kỹ thuật và yêu cầu hiệu suất cao.', '2025-06-05 11:30:20', '2025-06-27 04:28:14', 0),
(81, 8, 8, 'PEAK MONSTER 8', 9800000.00, 'assets/images/1749115848-Peak-PEAK MONSTER 8-03.webp', 'assets/images/1749115848-Peak-PEAK MONSTER 8-05.webp', 'PEAK Monster 8 là thế hệ tiếp theo trong dòng giày thi đấu cao cấp của PEAK, được thiết kế dành riêng cho các cầu thủ thiên về sức mạnh, thể lực và kiểm soát không gian. Với phong cách hầm hố, form giày to bản và công nghệ tiên tiến, Monster 8 đem lại cảm giác vững chắc, hỗ trợ tối đa cho lối chơi mạnh mẽ và đầy uy lực.\r\nĐôi giày được trang bị công nghệ đệm Super P-Motive giúp hấp thụ lực hiệu quả, tạo cảm giác đàn hồi cao khi bật nhảy hoặc tiếp đất. Phần upper sử dụng chất liệu lưới đa lớp kết hợp lớp phủ fuse và khung TPU để tăng độ bền và giữ form giày khi chịu lực nặng. Thiết kế cổ giày dạng mid-cut cùng hệ thống ôm cổ chân chắc chắn giúp ổn định khớp cổ chân trong các tình huống tranh chấp hoặc xoay người đột ngột.\r\nĐế ngoài có rãnh chống trượt sâu và họa tiết đa hướng, đảm bảo độ bám sân cực cao, kể cả khi thi đấu trên sân ngoài trời. Với ngoại hình mạnh mẽ và hiệu năng đáng tin cậy, PEAK Monster 8 là lựa chọn tuyệt vời cho các big man, pivot, hoặc những cầu thủ yêu thích lối chơi thiên về thể lực.', '2025-06-05 11:30:48', '2025-06-27 04:28:40', 0),
(82, 8, 8, 'PEAK MONSTER IX', 11500000.00, 'assets/images/1749115880-Peak-PEAK MONSTER IX-03.webp', 'assets/images/1749151262-Peak-PEAK MONSTER IX-05.webp', 'PEAK Monster IX là phiên bản mới nhất trong dòng giày bóng rổ Monster trứ danh của PEAK – được thiết kế tối ưu cho các cầu thủ thiên về sức mạnh, thể hình to, và lối chơi càn lướt trong khu vực dưới rổ. Với diện mạo mạnh mẽ, cấu trúc chắc chắn và công nghệ tiên tiến, Monster IX tiếp tục khẳng định vị thế là mẫu giày lý tưởng cho các big man hiện đại.\r\nĐiểm nhấn nổi bật của Monster IX là lớp đệm Super P-Motive thế hệ mới, trải đều toàn lòng bàn chân, mang lại độ đàn hồi cao và khả năng hấp thụ lực hiệu quả khi bật nhảy hoặc tiếp đất mạnh. Upper sử dụng chất liệu woven dệt đa lớp kết hợp fuse và hệ thống khung TPU gia cố toàn thân, giúp giữ vững form giày trong những pha va chạm mạnh. Thiết kế cổ mid-top có đệm lót dày, ôm sát cổ chân, hỗ trợ ổn định khớp cổ chân tối đa.\r\nĐế ngoài có các họa tiết chống trượt hình răng cưa đa chiều, đảm bảo bám sân tốt cả indoor lẫn outdoor, đặc biệt phù hợp với những tình huống tranh chấp dưới rổ hoặc xoay trở ở khu vực post-up. Monster IX là lựa chọn lý tưởng cho các cầu thủ cần sự bảo vệ, vững chắc và hiệu suất cao trong thi đấu cường độ mạnh.', '2025-06-05 11:31:20', '2025-06-27 04:29:04', 0),
(83, 8, 8, 'PEAK OUTDOOR', 8000000.00, 'assets/images/1749115921-Peak-PEAK OUTDOOR-03.webp', 'assets/images/1749115921-Peak-PEAK OUTDOOR-05.png', '', '2025-06-05 11:32:01', '2025-06-05 21:15:43', 0),
(84, 8, 8, 'PEAK OVERFLOWS', 4000000.00, 'assets/images/1749115951-Peak-PEAK OVERFLOWS-03.webp', 'assets/images/1749115951-Peak-PEAK OVERFLOWS-05.webp', '', '2025-06-05 11:32:31', '2025-06-05 21:16:17', 0),
(85, 8, 8, 'PEAK TAICHI CAVE SANDALS', 3000000.00, 'assets/images/1749116055-Peak-PEAK TAICHI CAVE SANDALS-04.webp', 'assets/images/1749116055-Peak-PEAK TAICHI CAVE SANDALS-06.webp', 'PEAK Taichi Cave Sandals là dòng dép thể thao tiện dụng, được thiết kế dành cho các hoạt động thường ngày và nghỉ ngơi sau những giờ tập luyện căng thẳng. Với kiểu dáng hiện đại, thoải mái, dép kết hợp giữa phong cách năng động và sự tiện lợi tối đa cho người sử dụng.\r\nPhần đế sandal được làm từ chất liệu EVA nhẹ, đàn hồi tốt, giúp giảm áp lực khi di chuyển và tạo cảm giác êm ái dưới lòng bàn chân. Thiết kế quai ngang bản lớn có họa tiết độc đáo, tăng thêm phần cá tính và giúp cố định chân chắc chắn, hạn chế trượt khi di chuyển. Bề mặt đế có các rãnh chống trượt hiệu quả, đảm bảo an toàn trên nhiều bề mặt khác nhau.\r\nPEAK Taichi Cave Sandals phù hợp cho việc đi lại hàng ngày, nghỉ ngơi sau tập luyện hoặc sử dụng trong môi trường sân bãi, bể bơi, mang lại sự thoải mái và phong cách cho người dùng.', '2025-06-05 11:33:07', '2025-06-27 04:29:31', 0),
(86, 8, 8, 'PEAK WIGGINS TRIANGLE 2.0', 1500000.00, 'assets/images/1749116091-Peak-PEAK WIGGINS TRIANGLE 2.0-03.webp', 'assets/images/1749116091-Peak-PEAK WIGGINS TRIANGLE 2.0-05.png', 'PEAK Wiggins Triangle 2.0 là phiên bản nâng cấp của dòng giày bóng rổ dành riêng cho Andrew Wiggins, ngôi sao NBA với lối chơi linh hoạt, nhanh nhẹn và đầy kỹ thuật. Đôi giày được thiết kế để hỗ trợ tối đa cho các pha di chuyển tốc độ cao, đổi hướng linh hoạt và bật nhảy mạnh mẽ trên sân.\r\nGiày sử dụng công nghệ đệm P-Motive Foam tiên tiến của PEAK, mang lại khả năng hấp thụ lực và phản hồi nhanh, giúp người chơi cảm nhận rõ từng bước chân. Upper làm từ chất liệu lưới dệt đa lớp nhẹ và thoáng khí, kết hợp các chi tiết gia cố TPU tạo sự ổn định và bảo vệ bàn chân trong những tình huống va chạm.\r\nĐế ngoài với hoa văn chống trượt đa hướng giúp tăng độ bám sân, phù hợp cho cả sân trong nhà và sân ngoài trời. Thiết kế low-top hiện đại kết hợp phối màu thời thượng tạo nên phong cách trẻ trung, năng động, phù hợp cho các vận động viên và người chơi đam mê bóng rổ.', '2025-06-05 11:34:51', '2025-06-27 04:30:02', 0),
(87, 12, 1, 'PACK VỚ NIKE (VNXK)', 50000.00, 'assets/images/1749116176-Sock-PACK VỚ NIKE (VNXK)-01.png', 'assets/images/1749116176-Sock-PACK VỚ NIKE (VNXK)-02.webp', 'Pack Vớ Nike (VNXK) bao gồm các đôi vớ thể thao chất lượng cao, sản xuất theo tiêu chuẩn xuất khẩu, đảm bảo độ bền, thoáng khí và độ co giãn tối ưu cho người sử dụng. Sản phẩm được làm từ chất liệu cotton pha polyester và spandex, giúp giữ cho chân luôn khô ráo, thoải mái trong suốt quá trình vận động.\r\nThiết kế với độ cao vừa phải, phù hợp để mang trong các hoạt động thể thao như chạy bộ, bóng rổ, tập gym hoặc sử dụng hàng ngày. Vớ có phần mũi và gót được gia cố, tăng tuổi thọ sản phẩm. Pack thường gồm nhiều màu sắc hoặc mẫu mã đa dạng, dễ dàng phối hợp với trang phục và giày thể thao Nike.\r\nĐây là lựa chọn hoàn hảo cho người yêu thể thao muốn sở hữu sản phẩm chính hãng, giá hợp lý và cảm giác sử dụng thoải mái.', '2025-06-05 11:36:16', '2025-06-27 04:30:32', 0),
(88, 12, 1, 'PACK VỚ NIKE EVERYDAY (VNXK)', 50000.00, 'assets/images/1749116212-Sock-PACK VỚ NIKE EVERYDAY (VNXK)-01.png', 'assets/images/1749116212-Sock-PACK VỚ NIKE EVERYDAY (VNXK)-02.png', 'Pack Vớ Nike Everyday (VNXK) là bộ sưu tập vớ thể thao đa năng, được thiết kế dành cho người dùng yêu thích sự tiện lợi và thoải mái mỗi ngày. Sản phẩm làm từ chất liệu cotton pha polyester và spandex cao cấp, mang đến khả năng thấm hút mồ hôi tốt, giữ cho đôi chân luôn khô ráo và thông thoáng suốt cả ngày dài.\r\nVớ có thiết kế vừa vặn, ôm sát chân nhưng không gây cảm giác bí bách, phù hợp để mang cùng giày thể thao trong các hoạt động thể dục, chạy bộ hoặc sử dụng hàng ngày. Phần mũi và gót được gia cố thêm để tăng độ bền và hạn chế hao mòn khi sử dụng lâu dài.\r\nPack thường gồm nhiều đôi với màu sắc trung tính dễ phối hợp trang phục, là lựa chọn hoàn hảo cho những ai muốn sở hữu vớ chất lượng, bền đẹp và đa dụng.', '2025-06-05 11:36:52', '2025-06-27 04:30:55', 0),
(89, 12, 1, 'PACK VỚ NIKE TIE-DYE', 60000.00, 'assets/images/1749116254-Sock-PACK VỚ NIKE TIE-DYE-01.png', 'assets/images/1749116254-Sock-PACK VỚ NIKE TIE-DYE-02.webp', 'Pack Vớ Nike Tie-Dye mang đến phong cách trẻ trung, nổi bật với họa tiết nhuộm loang đa sắc màu đầy cá tính. Sản phẩm được làm từ chất liệu cotton pha polyester và spandex cao cấp, giúp vớ có độ co giãn tốt, mềm mại và thoáng khí, giữ chân bạn luôn khô ráo và thoải mái trong mọi hoạt động.\r\nThiết kế vừa vặn, ôm chân chắc chắn nhưng không gây bí bách, phù hợp để mang cùng giày thể thao hay giày thường. Phần mũi và gót được gia cố để tăng độ bền, giúp sử dụng lâu dài mà không lo bị sờn hay rách. Pack vớ thường gồm nhiều đôi với họa tiết tie-dye đa dạng, dễ dàng kết hợp với nhiều phong cách thời trang khác nhau, từ năng động đến trẻ trung, phá cách.\r\nĐây là lựa chọn hoàn hảo cho những bạn trẻ yêu thích sự khác biệt và muốn thể hiện cá tính riêng qua từng chi tiết nhỏ nhất trong trang phục.', '2025-06-05 11:37:34', '2025-06-27 04:31:20', 0),
(90, 12, 1, 'RB DAILY MID SOCKS - SIMPLE IS R', 70000.00, 'assets/images/1749116294-Sock-RB DAILY MID SOCKS - SIMPLE IS R-01.webp', 'assets/images/1749116294-Sock-RB DAILY MID SOCKS - SIMPLE IS R-02.webp', 'RB Daily Mid Socks - Simple Is R là mẫu vớ thể thao thiết kế tối giản nhưng tinh tế, phù hợp cho những người yêu thích phong cách đơn giản, hiện đại. Được làm từ chất liệu cotton pha spandex và polyester cao cấp, sản phẩm mang lại độ co giãn tốt, mềm mại và thoáng khí, giúp giữ chân luôn khô ráo và thoải mái trong mọi hoạt động hàng ngày.\r\nVới chiều cao mid-cut vừa phải, vớ ôm chân vừa đủ, không gây cảm giác chật hay khó chịu. Phần mũi và gót được gia cố chắc chắn, tăng độ bền cho sản phẩm khi sử dụng lâu dài. Thiết kế đơn sắc với logo “R” tinh tế làm điểm nhấn, giúp dễ dàng phối hợp với nhiều loại giày và trang phục khác nhau.\r\nRB Daily Mid Socks - Simple Is R là lựa chọn lý tưởng cho những ai muốn một đôi vớ tiện dụng, bền bỉ và mang phong cách tối giản hiện đại.', '2025-06-05 11:38:14', '2025-06-27 04:31:43', 0),
(91, 12, 1, 'RB DAILY SOCKS - SIMPLE IS R (VER 2)', 75000.00, 'assets/images/1749116331-Sock-RB DAILY SOCKS - SIMPLE IS R (VER 2)-01.webp', 'assets/images/1749116331-Sock-RB DAILY SOCKS - SIMPLE IS R (VER 2)-02.webp', 'RB Daily Socks - Simple Is R (Ver 2) là phiên bản nâng cấp của dòng vớ thể thao với thiết kế vẫn giữ nguyên phong cách tối giản nhưng cải tiến về chất liệu và độ bền. Được làm từ hỗn hợp cotton cao cấp kết hợp polyester và spandex, đôi vớ mang lại cảm giác mềm mại, co giãn linh hoạt và khả năng thoáng khí vượt trội.\r\nThiết kế chiều cao cổ vớ chuẩn, ôm vừa vặn và giữ chân thoải mái suốt cả ngày dài. Phần gót và mũi vớ được gia cố chắc chắn giúp tăng tuổi thọ sản phẩm khi sử dụng thường xuyên trong các hoạt động thể thao hay sinh hoạt hàng ngày. Logo “R” vẫn là điểm nhấn tinh tế trên nền vớ đơn sắc, dễ dàng phối hợp với nhiều loại giày dép và trang phục khác nhau.\r\nRB Daily Socks - Simple Is R (Ver 2) là lựa chọn lý tưởng cho những ai cần một đôi vớ thể thao bền bỉ, thoáng mát và thời trang để đồng hành hàng ngày.', '2025-06-05 11:38:51', '2025-06-27 04:32:07', 0),
(92, 12, 1, 'VỚ NIKE DRI-FIT', 60000.00, 'assets/images/1749116370-Sock-VỚ NIKE DRI-FIT-01.png', 'assets/images/1749116370-Sock-VỚ NIKE DRI-FIT-02.png', 'Vớ Nike Dri-FIT được thiết kế với công nghệ độc quyền Dri-FIT giúp thấm hút mồ hôi hiệu quả, giữ cho đôi chân luôn khô ráo và thoáng mát trong suốt quá trình vận động. Sản phẩm làm từ chất liệu tổng hợp pha cotton, polyester và spandex, mang đến độ co giãn tốt, ôm sát chân mà không gây bí bách.\r\nPhần gót và mũi vớ được gia cố chắc chắn nhằm tăng độ bền và kéo dài tuổi thọ khi sử dụng thường xuyên trong các hoạt động thể thao hoặc đi lại hàng ngày. Thiết kế vừa vặn với chiều cao đa dạng từ cổ thấp đến cổ trung bình, phù hợp với nhiều loại giày thể thao và phong cách khác nhau.\r\nVớ Nike Dri-FIT là lựa chọn tối ưu cho các vận động viên và người chơi thể thao cần sự thoải mái, hiệu quả thấm hút và bền bỉ trong từng bước chạy.', '2025-06-05 11:39:30', '2025-06-27 04:32:34', 0),
(93, 12, 1, 'VỚ NIKE ELITE', 100000.00, 'assets/images/1749116425-Sock-VỚ NIKE ELITE-01.png', 'assets/images/1749116425-Sock-VỚ NIKE ELITE-02.png', 'Vớ Nike Elite là dòng vớ cao cấp dành riêng cho vận động viên và những người chơi thể thao chuyên nghiệp, được thiết kế để mang lại sự hỗ trợ tối ưu và hiệu suất thi đấu cao nhất. Sản phẩm sử dụng công nghệ Dri-FIT giúp thấm hút mồ hôi nhanh chóng, giữ chân luôn khô ráo và thoáng mát trong suốt quá trình vận động.\r\nVớ có thiết kế ôm sát, được gia cố ở vùng mắt cá và gót chân để tăng cường sự ổn định và bảo vệ, đồng thời giảm thiểu ma sát gây khó chịu hoặc phồng rộp khi vận động cường độ cao. Chất liệu tổng hợp pha cotton và spandex mang đến độ co giãn linh hoạt, thoải mái mà vẫn giữ form dáng lâu dài.\r\nVới chiều cao cổ vớ trung bình đến cao, Nike Elite phù hợp để phối hợp với các loại giày thể thao cao cổ, đặc biệt được yêu thích trong cộng đồng bóng rổ và các môn thể thao đòi hỏi sự bền bỉ, hỗ trợ và thoáng khí vượt trội.', '2025-06-05 11:40:25', '2025-06-27 04:32:56', 0),
(94, 12, 1, 'VỚ NIKE EVERYDAY ESSENTIAL CREW', 90000.00, 'assets/images/1749116459-Sock-VỚ NIKE EVERYDAY ESSENTIAL CREW-01.webp', 'assets/images/1749116459-Sock-VỚ NIKE EVERYDAY ESSENTIAL CREW-01.webp', 'Vớ Nike Everyday Essential Crew là mẫu vớ cổ trung mang phong cách đơn giản, tinh tế, phù hợp sử dụng hàng ngày và các hoạt động thể thao nhẹ nhàng. Sản phẩm được làm từ chất liệu cotton pha polyester và spandex cao cấp, giúp vớ có độ mềm mại, co giãn tốt và khả năng thoáng khí vượt trội, giữ chân luôn khô ráo và thoải mái suốt cả ngày dài.\r\nThiết kế ôm chân vừa vặn với chiều cao cổ vớ trung bình, bảo vệ mắt cá chân đồng thời mang lại sự thoải mái khi mang giày. Phần mũi và gót vớ được gia cố tăng độ bền, hạn chế tình trạng mài mòn khi sử dụng lâu dài.\r\nNike Everyday Essential Crew là lựa chọn lý tưởng cho những ai cần một đôi vớ bền bỉ, dễ phối đồ và thích hợp để mang cả ngày, từ đi làm đến vận động nhẹ.', '2025-06-05 11:40:59', '2025-06-27 04:33:19', 0);

-- --------------------------------------------------------

--
-- Table structure for table `product_answer`
--

CREATE TABLE `product_answer` (
  `id` int(11) NOT NULL,
  `question_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `answer` text DEFAULT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_discount`
--

CREATE TABLE `product_discount` (
  `id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `discount_type` enum('percent','amount') NOT NULL,
  `value` decimal(10,2) NOT NULL,
  `start_date` datetime NOT NULL,
  `end_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_discount`
--

INSERT INTO `product_discount` (`id`, `product_id`, `discount_type`, `value`, `start_date`, `end_date`) VALUES
(11, 1, 'percent', 30.00, '2025-05-24 00:58:00', '2025-06-28 00:58:00'),
(12, 4, 'percent', 15.00, '2025-06-04 19:55:00', '2025-07-06 19:55:00'),
(14, 5, 'percent', 20.00, '2025-06-04 19:55:00', '2025-07-06 19:55:00'),
(15, 6, 'percent', 5.00, '2025-06-04 19:56:00', '2025-07-06 19:56:00'),
(17, 8, 'percent', 25.00, '2025-06-04 19:56:00', '2025-06-04 19:56:00'),
(18, 7, 'percent', 30.00, '2025-06-04 19:56:00', '2025-07-06 19:56:00'),
(19, 14, 'percent', 10.00, '2025-06-05 16:48:00', '2026-01-01 00:00:00'),
(20, 15, 'percent', 5.00, '2025-06-05 16:51:00', '2026-01-10 00:00:00'),
(21, 16, 'percent', 7.00, '2025-06-05 16:52:00', '2026-10-01 00:00:00'),
(22, 17, 'percent', 5.00, '2025-06-05 16:58:00', '2026-10-01 00:00:00'),
(23, 18, 'percent', 15.00, '2025-06-05 17:00:00', '2026-10-01 00:00:00'),
(24, 19, 'percent', 10.00, '2025-06-05 17:01:00', '2026-10-01 00:00:00'),
(25, 20, 'percent', 17.00, '2025-06-05 17:02:00', '2026-10-01 00:00:00'),
(26, 21, 'percent', 20.00, '2025-06-05 17:03:00', '2026-10-01 00:00:00'),
(27, 23, 'percent', 15.00, '2025-06-06 00:31:00', '2026-10-01 00:00:00'),
(28, 24, 'percent', 15.00, '2025-06-06 00:32:00', '2026-10-01 00:00:00'),
(29, 25, 'percent', 15.00, '2025-06-06 00:35:00', '2026-10-01 00:00:00'),
(30, 26, 'percent', 15.00, '2025-06-06 00:36:00', '2026-10-01 00:00:00'),
(31, 27, 'percent', 15.00, '2025-06-06 00:38:00', '2026-10-01 00:00:00'),
(32, 28, 'percent', 10.00, '2025-06-06 00:38:00', '2026-10-01 00:00:00'),
(33, 29, 'percent', 12.00, '2025-06-06 00:40:00', '2026-10-01 00:00:00'),
(34, 30, 'percent', 15.00, '2025-06-06 00:41:00', '2026-10-01 00:00:00'),
(35, 31, 'percent', 20.00, '2025-06-06 00:48:00', '2026-10-01 00:00:00'),
(36, 32, 'percent', 20.00, '2025-06-06 00:49:00', '2026-10-01 00:00:00'),
(37, 33, 'percent', 25.00, '2025-06-06 00:49:00', '2026-10-01 00:00:00'),
(38, 34, 'percent', 25.00, '2025-06-06 00:50:00', '2026-10-01 00:00:00'),
(39, 35, 'percent', 25.00, '2025-06-06 00:51:00', '2026-10-01 00:00:00'),
(40, 36, 'percent', 20.00, '2025-06-06 00:52:00', '2026-10-01 00:00:00'),
(41, 37, 'percent', 25.00, '2025-06-06 00:53:00', '2026-10-01 00:00:00'),
(42, 38, 'percent', 15.00, '2025-06-06 00:53:00', '2026-10-01 00:00:00'),
(43, 39, 'percent', 15.00, '2025-06-06 00:55:00', '2026-10-01 00:00:00'),
(44, 40, 'percent', 5.00, '2025-06-06 00:56:00', '2026-10-01 00:00:00'),
(45, 41, 'percent', 5.00, '2025-06-06 00:56:00', '2026-10-01 00:00:00'),
(46, 42, 'percent', 5.00, '2025-06-06 00:57:00', '2026-10-01 00:00:00'),
(47, 43, 'percent', 10.00, '2025-06-06 00:58:00', '2026-10-01 00:00:00'),
(48, 44, 'percent', 15.00, '2025-06-06 00:59:00', '2026-10-01 00:00:00'),
(49, 45, 'percent', 10.00, '2025-06-06 00:59:00', '2026-10-01 00:00:00'),
(50, 47, 'percent', 20.00, '2025-06-06 01:00:00', '2026-10-01 00:00:00'),
(51, 48, 'percent', 20.00, '2025-06-06 01:01:00', '2026-10-01 00:00:00'),
(52, 49, 'percent', 10.00, '2025-06-06 01:02:00', '2026-10-01 00:00:00'),
(53, 50, 'percent', 5.00, '2025-06-06 01:03:00', '2026-10-01 00:00:00'),
(54, 51, 'percent', 10.00, '2025-06-06 01:03:00', '2026-10-01 00:00:00'),
(55, 52, 'percent', 15.00, '2025-06-06 01:05:00', '2026-10-01 00:00:00'),
(56, 53, 'percent', 10.00, '2025-06-06 01:06:00', '2026-10-01 00:00:00'),
(57, 54, 'percent', 25.00, '2025-06-06 01:07:00', '2026-10-01 00:00:00'),
(58, 55, 'percent', 20.00, '2025-06-06 01:08:00', '2026-10-01 00:00:00'),
(59, 56, 'percent', 25.00, '2025-06-06 01:09:00', '2026-10-01 00:00:00'),
(60, 57, 'percent', 15.00, '2025-06-06 01:10:00', '2026-10-01 00:00:00'),
(61, 58, 'percent', 10.00, '2025-06-06 01:11:00', '2026-10-01 00:00:00'),
(62, 59, 'percent', 15.00, '2025-06-06 01:12:00', '2026-10-01 00:00:00'),
(63, 60, 'percent', 30.00, '2025-06-06 01:13:00', '2026-10-12 00:00:00'),
(64, 61, 'percent', 0.00, '2025-06-06 01:15:00', '2026-10-01 00:00:00'),
(65, 62, 'percent', 0.00, '2025-06-06 01:18:00', '2026-10-01 00:00:00'),
(66, 63, 'percent', 0.00, '2025-06-06 01:19:00', '2026-10-01 00:00:00'),
(67, 64, 'percent', 0.00, '2025-06-06 01:22:00', '2026-10-01 00:00:00'),
(68, 65, 'percent', 10.00, '2025-06-06 01:27:00', '2026-10-01 00:00:00'),
(69, 66, 'percent', 0.00, '2025-06-06 01:28:00', '2026-10-01 00:00:00'),
(70, 67, 'percent', 0.00, '2025-06-06 01:28:00', '2026-10-01 00:00:00'),
(71, 68, 'percent', 25.00, '2025-06-06 01:29:00', '2026-10-01 00:00:00'),
(72, 69, 'percent', 0.00, '2025-06-06 01:30:00', '2026-10-01 00:00:00'),
(73, 70, 'percent', 0.00, '2025-06-06 01:31:00', '2026-10-01 00:00:00'),
(74, 71, 'percent', 30.00, '2025-06-06 01:32:00', '2026-10-01 00:00:00'),
(75, 72, 'percent', 0.00, '2025-06-06 01:35:00', '2026-10-01 00:00:00'),
(76, 73, 'percent', 10.00, '2025-06-06 01:36:00', '2026-10-01 00:00:00'),
(77, 74, 'percent', 0.00, '2025-06-06 01:38:00', '2026-10-10 00:00:00'),
(78, 75, 'percent', 12.00, '2025-06-06 01:39:00', '2026-10-01 00:00:00'),
(79, 76, 'percent', 0.00, '2025-06-06 01:40:00', '2026-10-01 00:00:00'),
(80, 77, 'percent', 0.00, '2025-06-06 01:41:00', '2026-10-01 00:00:00'),
(81, 78, 'percent', 5.00, '2025-06-06 01:42:00', '2026-10-01 00:00:00'),
(82, 79, 'percent', 15.00, '2025-06-06 01:43:00', '2026-10-01 00:00:00'),
(83, 80, 'percent', 5.00, '2025-06-06 01:44:00', '2026-10-01 00:00:00'),
(84, 81, 'percent', 0.00, '2025-06-06 01:53:00', '2026-10-01 00:00:00'),
(85, 82, 'percent', 15.00, '2025-06-06 01:54:00', '2026-10-01 00:00:00'),
(86, 94, 'percent', 5.00, '2025-06-06 01:55:00', '2026-10-01 00:00:00'),
(87, 93, 'percent', 0.00, '2025-06-06 01:56:00', '2026-10-01 00:00:00'),
(88, 92, 'percent', 0.00, '2025-06-06 01:56:00', '2026-10-01 00:00:00'),
(89, 91, 'percent', 0.00, '2025-06-06 01:57:00', '2026-10-01 00:00:00'),
(90, 90, 'percent', 15.00, '2025-06-06 01:57:00', '2026-10-01 00:00:00'),
(91, 89, 'percent', 0.00, '2025-06-06 01:58:00', '2026-10-01 00:00:00'),
(92, 88, 'percent', 10.00, '2025-06-06 01:59:00', '2026-10-01 00:00:00'),
(93, 87, 'percent', 20.00, '2025-06-06 02:00:00', '2026-10-01 00:00:00'),
(94, 86, 'percent', 5.00, '2025-06-06 02:01:00', '2026-10-01 00:00:00'),
(95, 85, 'percent', 0.00, '2025-06-06 02:03:00', '2026-10-01 00:00:00'),
(96, 84, 'percent', 30.00, '2025-06-06 02:04:00', '2026-10-01 00:00:00'),
(97, 83, 'percent', 0.00, '2025-06-06 02:05:00', '2026-10-01 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `product_question`
--

CREATE TABLE `product_question` (
  `id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `question` text DEFAULT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_variant`
--

CREATE TABLE `product_variant` (
  `id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `size` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_variant`
--

INSERT INTO `product_variant` (`id`, `product_id`, `size`) VALUES
(3, 1, '43'),
(4, 1, '45'),
(5, 1, '44'),
(7, 1, '42'),
(8, 4, '39'),
(9, 4, '40'),
(10, 4, '41'),
(11, 4, '42'),
(12, 4, '43'),
(13, 5, '39'),
(14, 5, '40'),
(15, 5, '41'),
(16, 5, '42'),
(17, 5, '43'),
(18, 6, '39'),
(19, 6, '40'),
(20, 6, '41'),
(21, 6, '42'),
(22, 6, '43'),
(23, 6, '44'),
(24, 7, '41'),
(25, 7, '42'),
(26, 7, '43'),
(27, 7, '44'),
(28, 8, 'XL'),
(29, 10, 'XL'),
(30, 11, 'L'),
(31, 11, 'XL'),
(32, 11, 'XXL'),
(33, 11, 'XXXL'),
(34, 12, 'L'),
(35, 12, 'XL'),
(36, 12, 'XXL'),
(37, 12, 'XXXL'),
(38, 13, '7'),
(39, 13, '6'),
(40, 14, '39'),
(41, 14, '40'),
(42, 14, '41'),
(43, 14, '42'),
(44, 14, '43'),
(45, 14, '44'),
(46, 15, '39'),
(47, 15, '40'),
(48, 15, '41'),
(49, 15, '42'),
(50, 15, '43'),
(51, 15, '44'),
(52, 16, '39'),
(53, 16, '40'),
(54, 16, '41'),
(55, 16, '42'),
(56, 16, '43'),
(57, 16, '44'),
(58, 17, '39'),
(59, 17, '40'),
(60, 17, '41'),
(61, 17, '42'),
(63, 17, '43'),
(64, 17, '44'),
(65, 18, '39'),
(66, 18, '40'),
(67, 18, '42'),
(68, 18, '43'),
(69, 18, '44'),
(70, 19, '40'),
(71, 19, '41'),
(72, 19, '42'),
(73, 19, '43'),
(74, 19, '44'),
(75, 20, '39'),
(76, 20, '40'),
(77, 20, '41'),
(78, 20, '42'),
(79, 20, '43'),
(80, 20, '44'),
(81, 21, '39'),
(82, 21, '40'),
(83, 21, '41'),
(84, 21, '42'),
(85, 21, '43'),
(86, 21, '44'),
(87, 23, 'L'),
(88, 23, 'XL'),
(89, 23, '2XL'),
(90, 23, '3XL'),
(91, 24, 'L'),
(92, 24, 'XL'),
(93, 24, '2XL'),
(94, 24, '3XL'),
(95, 25, 'L'),
(96, 25, '2XL'),
(97, 25, 'XL'),
(99, 25, '4XL'),
(100, 25, '3XL'),
(101, 24, '4XL'),
(102, 26, 'L'),
(103, 26, 'XL'),
(104, 26, '2XL'),
(105, 26, '3XL'),
(106, 26, '4XL'),
(107, 27, 'L'),
(108, 27, 'XL'),
(109, 27, '2XL'),
(110, 27, '3XL'),
(111, 27, '4XL'),
(112, 28, 'L'),
(113, 28, 'XL'),
(114, 28, '2XL'),
(115, 28, '3XL'),
(116, 28, '4XL'),
(117, 29, 'L'),
(119, 29, 'XL'),
(120, 29, '2XL'),
(121, 29, '3XL'),
(122, 29, '4xl'),
(123, 30, 'L'),
(124, 30, 'XL'),
(125, 30, '2XL'),
(126, 30, '3XL'),
(127, 30, '4XL'),
(129, 31, 'one size'),
(130, 32, 'one size'),
(131, 33, 'one size'),
(132, 34, 'one size'),
(133, 35, 'one size'),
(134, 36, 'one size'),
(135, 37, 'one size'),
(137, 38, 'one size'),
(138, 39, 'one size'),
(139, 40, 'one size'),
(140, 41, 'one size'),
(141, 42, 'one size'),
(142, 43, '6'),
(143, 43, '7'),
(144, 44, '6'),
(145, 44, '7'),
(146, 45, '6'),
(147, 45, '7'),
(148, 47, '6'),
(149, 47, '7'),
(150, 48, '6'),
(151, 48, '7'),
(152, 49, '6'),
(153, 49, '7'),
(154, 50, '6'),
(155, 50, '7'),
(156, 51, '6'),
(157, 51, '7'),
(158, 52, '39'),
(159, 52, '40'),
(160, 52, '41'),
(161, 52, '42'),
(162, 52, '43'),
(163, 52, '44'),
(164, 53, '40'),
(165, 53, '41'),
(166, 53, '42'),
(167, 53, '43'),
(168, 53, '44'),
(169, 54, '39'),
(170, 54, '40'),
(171, 54, '41'),
(172, 54, '42'),
(173, 54, '43'),
(174, 54, '44'),
(175, 55, '39'),
(176, 55, '40'),
(177, 55, '41'),
(178, 55, '42'),
(179, 55, '43'),
(180, 55, '44'),
(181, 56, '39'),
(182, 56, '40'),
(183, 56, '41'),
(184, 56, '42'),
(185, 56, '43'),
(186, 56, '44'),
(187, 57, '39'),
(188, 57, '40'),
(189, 57, '41'),
(190, 57, '42'),
(191, 57, '43'),
(192, 57, '44'),
(193, 58, '39'),
(194, 58, '40'),
(195, 58, '41'),
(196, 58, '42'),
(197, 58, '43'),
(198, 58, '44'),
(199, 59, '39'),
(200, 59, '40'),
(201, 59, '41'),
(202, 59, '42'),
(203, 59, '43'),
(204, 59, '44'),
(205, 60, '39'),
(206, 60, '40'),
(207, 60, '41'),
(208, 60, '42'),
(209, 60, '43'),
(210, 60, '44'),
(211, 61, '39'),
(212, 61, '40'),
(213, 61, '41'),
(214, 61, '42'),
(215, 61, '43'),
(216, 61, '44'),
(217, 62, '39'),
(218, 62, '40'),
(219, 62, '41'),
(220, 62, '42'),
(221, 62, '43'),
(222, 62, '44'),
(223, 63, '39'),
(224, 63, '40'),
(225, 63, '41'),
(226, 63, '42'),
(227, 63, '43'),
(228, 63, '44'),
(230, 64, '39'),
(231, 64, '40'),
(232, 64, '41'),
(233, 64, '42'),
(234, 64, '43'),
(235, 64, '44'),
(236, 65, '39'),
(237, 65, '40'),
(238, 65, '41'),
(239, 65, '42'),
(240, 65, '43'),
(241, 65, '44'),
(242, 66, '39'),
(243, 66, '40'),
(244, 66, '41'),
(245, 66, '42'),
(246, 66, '43'),
(247, 66, '44'),
(248, 67, '39'),
(249, 67, '40'),
(250, 67, '41'),
(251, 67, '42'),
(252, 67, '43'),
(253, 67, '44'),
(254, 68, '39'),
(255, 68, '40'),
(256, 68, '41'),
(257, 68, '42'),
(258, 68, '43'),
(259, 68, '44'),
(260, 69, '39'),
(261, 69, '40'),
(262, 69, '41'),
(263, 69, '42'),
(264, 69, '43'),
(265, 69, '44'),
(266, 70, '39'),
(267, 70, '40'),
(268, 70, '41'),
(269, 70, '42'),
(270, 70, '43'),
(271, 70, '44'),
(272, 71, '39'),
(273, 71, '40'),
(274, 71, '41'),
(275, 71, '42'),
(276, 71, '43'),
(277, 71, '44'),
(278, 72, '39'),
(279, 72, '40'),
(280, 72, '41'),
(281, 72, '42'),
(282, 72, '43'),
(283, 72, '44'),
(284, 73, '39'),
(285, 73, '40'),
(286, 73, '41'),
(287, 73, '42'),
(288, 73, '43'),
(289, 73, '44'),
(290, 74, '39'),
(292, 74, '41'),
(293, 74, '42'),
(294, 74, '43'),
(295, 74, '44'),
(296, 75, '39'),
(297, 75, '40'),
(298, 75, '41'),
(299, 75, '42'),
(300, 75, '43'),
(301, 75, '44'),
(302, 76, '39'),
(303, 76, '40'),
(304, 76, '41'),
(305, 76, '42'),
(306, 76, '43'),
(307, 76, '44'),
(308, 77, '39'),
(309, 77, '40'),
(310, 77, '41'),
(311, 77, '42'),
(312, 77, '43'),
(313, 77, '44'),
(314, 78, '39'),
(315, 78, '40'),
(316, 78, '41'),
(317, 78, '42'),
(318, 78, '43'),
(319, 78, '44'),
(320, 79, '39'),
(321, 79, '40'),
(322, 79, '41'),
(323, 79, '42'),
(324, 79, '43'),
(325, 79, '44'),
(326, 80, '39'),
(327, 80, '40'),
(328, 80, '41'),
(329, 80, '42'),
(330, 80, '43'),
(331, 80, '44'),
(332, 81, '39'),
(333, 81, '40'),
(334, 81, '41'),
(335, 81, '42'),
(336, 81, '43'),
(337, 81, '44'),
(338, 82, '39'),
(339, 82, '40'),
(340, 82, '41'),
(341, 82, '42'),
(342, 82, '43'),
(343, 82, '44'),
(344, 94, 'dài'),
(345, 93, 'dài'),
(346, 92, 'dài'),
(347, 91, 'dài'),
(348, 90, 'dài'),
(349, 89, 'dài'),
(351, 88, 'dài'),
(352, 87, 'dài'),
(353, 86, '39'),
(354, 86, '40'),
(355, 86, '41'),
(356, 86, '42'),
(357, 86, '43'),
(358, 86, '44'),
(359, 85, '39'),
(360, 85, '40'),
(361, 85, '41'),
(362, 85, '42'),
(363, 85, '43'),
(364, 85, '44'),
(365, 84, '39'),
(366, 84, '40'),
(367, 84, '41'),
(368, 84, '42'),
(369, 84, '43'),
(370, 84, '44'),
(371, 83, '39'),
(372, 83, '40'),
(373, 83, '41'),
(374, 83, '42'),
(375, 83, '43'),
(376, 83, '44');

-- --------------------------------------------------------

--
-- Table structure for table `return_request`
--

CREATE TABLE `return_request` (
  `id` int(11) NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `reason` text DEFAULT NULL,
  `status` enum('pending','approved','rejected') DEFAULT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `review`
--

CREATE TABLE `review` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `rating` int(11) DEFAULT NULL,
  `comment` text DEFAULT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id`, `name`) VALUES
(1, 'Admin'),
(2, 'User');

-- --------------------------------------------------------

--
-- Table structure for table `shipping_method`
--

CREATE TABLE `shipping_method` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `shipping_method`
--

INSERT INTO `shipping_method` (`id`, `name`) VALUES
(1, 'Giao hàng tiêu chuẩn'),
(2, 'Giao hàng nhanh'),
(3, 'Lấy tại cửa hàng');

-- --------------------------------------------------------

--
-- Table structure for table `tokens`
--

CREATE TABLE `tokens` (
  `user_id` int(11) NOT NULL,
  `token` varchar(32) NOT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tokens`
--

INSERT INTO `tokens` (`user_id`, `token`, `created_at`) VALUES
(13, '995de0bb6d9b4a0e9dd318386b35118e', '2025-06-27 15:33:23'),
(14, 'b6d1de8a7380e8a33a3e792aacd4e63e', '2025-06-27 15:41:32'),
(15, '59b297e64952359a88f7106758cc17f5', '2025-06-27 16:04:23'),
(16, 'aafa9ae831a8105533f2ea01b022d66a', '2025-06-27 16:12:28'),
(17, 'fcdd2377e69288cc5f562311a7369611', '2025-06-27 16:14:42'),
(18, '3fcf975728c81a5ac9fa4eac042084d2', '2025-06-27 16:14:17');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `fullname` varchar(50) DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  `phone_number` varchar(20) DEFAULT NULL,
  `address` varchar(200) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role_id` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `fullname`, `email`, `phone_number`, `address`, `password`, `role_id`, `created_at`, `updated_at`, `deleted`) VALUES
(3, 'qhuy', 'nq2019@gmail.com', '123456789', 'nhabe', '123456', 2, '2024-08-24 21:28:44', '2025-06-03 10:50:53', 1),
(4, 'qhuyyyy', '123aa@gmail.com', NULL, NULL, 'aa3a5464ff6880389fd7e809c4652487', 2, '2025-06-03 10:41:07', '2025-06-03 10:41:07', 1),
(5, 'Khoa', 'aaas@gmail.com', '123456', 'nhabe', 'aa3a5464ff6880389fd7e809c4652487', 2, '2025-06-03 11:03:33', '2025-06-03 11:23:51', 1),
(6, 'asdasd', 'assdaw@gmail.com', '123456789', 'nhabe', 'aa3a5464ff6880389fd7e809c4652487', 2, '2025-06-03 11:21:13', '2025-06-03 11:23:54', 1),
(7, 'asdasdsad', '123456789@gmail.com', 'asdasdasdsa', 'asdad', 'aa3a5464ff6880389fd7e809c4652487', 2, '2025-06-03 11:24:18', '2025-06-03 11:24:18', 1),
(8, 'Dong123456', 'Dong@gmail.com', NULL, NULL, 'aa3a5464ff6880389fd7e809c4652487', 2, '2025-06-08 20:16:42', '2025-06-08 20:16:42', 1),
(9, 'viet', 'viet@gmail.com', NULL, NULL, '41b35e1db9a9eec096bc6a20ed812f1d', 2, '2025-06-13 11:07:47', '2025-06-13 11:18:25', 1),
(10, 'viett', 'vanvietpham453@gmail.com', '0925263897', 'Phường Phú Mỹ, Quận 7, Tp. Hồ Chí Minh', '688d9a84bc7657b653c5058e4249b86f', 2, '2025-06-13 11:16:18', '2025-06-13 11:56:22', 1),
(11, 'test', 'test@example.com', NULL, NULL, '111111', NULL, NULL, NULL, NULL),
(12, 'aviet', 'aviet@gmail.com', NULL, NULL, '56f3cf59ca04587060ccefe3c6e14a9a', 2, '2025-06-24 16:26:46', '2025-06-24 16:26:46', 1),
(13, 'tranthanhdongg', 'donggg@gmail.com', '0111111111', 'dailanh', 'aa3a5464ff6880389fd7e809c4652487', 2, '2025-06-27 15:19:44', '2025-06-27 15:19:44', 0),
(14, 'quochuyy', 'hyy@gmail.com', '0222222222', 'nhabee', 'aa3a5464ff6880389fd7e809c4652487', 2, '2025-06-27 15:20:21', '2025-06-27 15:20:21', 0),
(15, 'quocviett', 'viett@gmail.com', '0333333333', 'quan7', 'aa3a5464ff6880389fd7e809c4652487', 2, '2025-06-27 15:20:56', '2025-06-27 15:20:56', 0),
(16, 'dongphuongbatbai', 'dpbb@gmail.com', '0444444444', 'khanhhoaa', 'aa3a5464ff6880389fd7e809c4652487', 2, '2025-06-27 15:21:44', '2025-06-27 15:21:44', 0),
(17, 'buonvidepchai', 'bvdc@gmail.com', '05555555555', 'hcm', 'aa3a5464ff6880389fd7e809c4652487', 2, '2025-06-27 15:22:23', '2025-06-27 15:22:23', 0),
(18, 'ThanhDone', '2251120008@ut.edu.vn', '0999999999', 'dai lanh khanh hoa', 'aa3a5464ff6880389fd7e809c4652487', 1, '2025-06-27 15:23:23', '2025-06-27 15:23:23', 0),
(19, 'PhamVanViet', '2251120063@ut.edu.vn', '0888888888', 'Nhabee', 'aa3a5464ff6880389fd7e809c4652487', 1, '2025-06-27 15:24:53', '2025-06-27 15:24:53', 0),
(20, 'qqhuy', '2251120015@ut.edu.vn', '0666666666', 'nhakeben', 'aa3a5464ff6880389fd7e809c4652487', 1, '2025-06-27 20:06:56', '2025-06-27 20:06:56', 0);

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `blog_category`
--
ALTER TABLE `blog_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blog_comment`
--
ALTER TABLE `blog_comment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `post_id` (`post_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `blog_post`
--
ALTER TABLE `blog_post`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `author_id` (`author_id`);

--
-- Indexes for table `brand`
--
ALTER TABLE `brand`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `discount_code`
--
ALTER TABLE `discount_code`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `code` (`code`);

--
-- Indexes for table `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`id`),
  ADD KEY `variant_id` (`variant_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `status_id` (`status_id`),
  ADD KEY `payment_method_id` (`payment_method_id`),
  ADD KEY `shipping_method_id` (`shipping_method_id`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `order_log`
--
ALTER TABLE `order_log`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `status_id` (`status_id`);

--
-- Indexes for table `order_status`
--
ALTER TABLE `order_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment_method`
--
ALTER TABLE `payment_method`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `brand_id` (`brand_id`);

--
-- Indexes for table `product_answer`
--
ALTER TABLE `product_answer`
  ADD PRIMARY KEY (`id`),
  ADD KEY `question_id` (`question_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `product_discount`
--
ALTER TABLE `product_discount`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `product_question`
--
ALTER TABLE `product_question`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `product_variant`
--
ALTER TABLE `product_variant`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `return_request`
--
ALTER TABLE `return_request`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shipping_method`
--
ALTER TABLE `shipping_method`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tokens`
--
ALTER TABLE `tokens`
  ADD PRIMARY KEY (`user_id`,`token`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `role_id` (`role_id`);

--
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `product_id` (`product_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `blog_category`
--
ALTER TABLE `blog_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `blog_comment`
--
ALTER TABLE `blog_comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `blog_post`
--
ALTER TABLE `blog_post`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `brand`
--
ALTER TABLE `brand`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `discount_code`
--
ALTER TABLE `discount_code`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `inventory`
--
ALTER TABLE `inventory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=375;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `order_log`
--
ALTER TABLE `order_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `order_status`
--
ALTER TABLE `order_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `payment_method`
--
ALTER TABLE `payment_method`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=95;

--
-- AUTO_INCREMENT for table `product_answer`
--
ALTER TABLE `product_answer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_discount`
--
ALTER TABLE `product_discount`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=98;

--
-- AUTO_INCREMENT for table `product_question`
--
ALTER TABLE `product_question`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_variant`
--
ALTER TABLE `product_variant`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=377;

--
-- AUTO_INCREMENT for table `return_request`
--
ALTER TABLE `return_request`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `review`
--
ALTER TABLE `review`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `shipping_method`
--
ALTER TABLE `shipping_method`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `blog_comment`
--
ALTER TABLE `blog_comment`
  ADD CONSTRAINT `blog_comment_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `blog_post` (`id`),
  ADD CONSTRAINT `blog_comment_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Constraints for table `blog_post`
--
ALTER TABLE `blog_post`
  ADD CONSTRAINT `blog_post_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `blog_category` (`id`),
  ADD CONSTRAINT `blog_post_ibfk_2` FOREIGN KEY (`author_id`) REFERENCES `user` (`id`);

--
-- Constraints for table `inventory`
--
ALTER TABLE `inventory`
  ADD CONSTRAINT `inventory_ibfk_1` FOREIGN KEY (`variant_id`) REFERENCES `product_variant` (`id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`status_id`) REFERENCES `order_status` (`id`),
  ADD CONSTRAINT `orders_ibfk_3` FOREIGN KEY (`payment_method_id`) REFERENCES `payment_method` (`id`),
  ADD CONSTRAINT `orders_ibfk_4` FOREIGN KEY (`shipping_method_id`) REFERENCES `shipping_method` (`id`);

--
-- Constraints for table `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `order_details_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`),
  ADD CONSTRAINT `order_details_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`);

--
-- Constraints for table `order_log`
--
ALTER TABLE `order_log`
  ADD CONSTRAINT `order_log_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`),
  ADD CONSTRAINT `order_log_ibfk_2` FOREIGN KEY (`status_id`) REFERENCES `order_status` (`id`);

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`),
  ADD CONSTRAINT `product_ibfk_2` FOREIGN KEY (`brand_id`) REFERENCES `brand` (`id`);

--
-- Constraints for table `product_answer`
--
ALTER TABLE `product_answer`
  ADD CONSTRAINT `product_answer_ibfk_1` FOREIGN KEY (`question_id`) REFERENCES `product_question` (`id`),
  ADD CONSTRAINT `product_answer_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Constraints for table `product_discount`
--
ALTER TABLE `product_discount`
  ADD CONSTRAINT `product_discount_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`);

--
-- Constraints for table `product_question`
--
ALTER TABLE `product_question`
  ADD CONSTRAINT `product_question_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`),
  ADD CONSTRAINT `product_question_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Constraints for table `product_variant`
--
ALTER TABLE `product_variant`
  ADD CONSTRAINT `product_variant_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`);

--
-- Constraints for table `return_request`
--
ALTER TABLE `return_request`
  ADD CONSTRAINT `return_request_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`),
  ADD CONSTRAINT `return_request_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`);

--
-- Constraints for table `review`
--
ALTER TABLE `review`
  ADD CONSTRAINT `review_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `review_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`);

--
-- Constraints for table `tokens`
--
ALTER TABLE `tokens`
  ADD CONSTRAINT `tokens_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `role` (`id`);

--
-- Constraints for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD CONSTRAINT `wishlist_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `wishlist_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
