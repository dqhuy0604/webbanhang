-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th6 09, 2025 lúc 05:59 PM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `webbanhang`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `blog_category`
--

CREATE TABLE `blog_category` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `blog_comment`
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
-- Cấu trúc bảng cho bảng `blog_post`
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
-- Cấu trúc bảng cho bảng `brand`
--

CREATE TABLE `brand` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `brand`
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
-- Cấu trúc bảng cho bảng `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `category`
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
-- Cấu trúc bảng cho bảng `discount_code`
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
-- Cấu trúc bảng cho bảng `inventory`
--

CREATE TABLE `inventory` (
  `id` int(11) NOT NULL,
  `variant_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `inventory`
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
(38, 40, 100),
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
(79, 81, 100),
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
(94, 96, 99),
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
(112, 114, 100),
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
(132, 134, 100),
(133, 135, 200),
(135, 137, 99),
(136, 138, 150),
(137, 139, 100),
(138, 140, 100),
(139, 141, 100),
(140, 142, 100),
(141, 143, 100),
(142, 144, 100),
(143, 145, 100),
(144, 146, 100),
(145, 147, 98),
(146, 148, 100),
(147, 149, 100),
(148, 150, 100),
(149, 151, 100),
(150, 152, 100),
(151, 153, 100),
(152, 154, 100),
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
(167, 169, 100),
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
(185, 187, 100),
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
(246, 248, 100),
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
(294, 296, 100),
(295, 297, 100),
(296, 298, 100),
(297, 299, 100),
(298, 300, 100),
(299, 301, 100),
(300, 302, 100),
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
(318, 320, 100),
(319, 321, 100),
(320, 322, 100),
(321, 323, 100),
(322, 324, 100),
(323, 325, 100),
(324, 326, 100),
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
(336, 338, 100),
(337, 339, 100),
(338, 340, 100),
(339, 341, 100),
(340, 342, 100),
(341, 343, 100),
(342, 344, 100),
(343, 345, 100),
(344, 346, 100),
(345, 347, 100),
(346, 348, 100),
(347, 349, 100),
(349, 351, 100),
(350, 352, 100),
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
-- Cấu trúc bảng cho bảng `orders`
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
-- Đang đổ dữ liệu cho bảng `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `fullname`, `email`, `phone_number`, `address`, `note`, `order_date`, `status_id`, `total_money`, `payment_method_id`, `payment_status`, `shipping_method_id`) VALUES
(1, 3, 'qhuy', 'nq2019@gmail.com', '123456789', 'nhabe', NULL, '2025-05-25 14:40:20', 5, 4000000.00, 1, 'pending', 1),
(2, 5, 'Khoa', 'aaas@gmail.com', '123456789', 'nhabe', NULL, '2024-08-25 01:18:54', 5, 4000000.00, 1, 'pending', 3),
(3, NULL, 'qhuy', '2222@gmail.com', '0123456789', 'nhabe', 'Giao nhanh dùm em', '2025-06-08 18:38:13', 2, 7175000.00, NULL, 'pending', NULL),
(4, 2, 'Dong', 'dong1123@gmail.com', '1234567890', 'Quan 12', 'Giao hàng gấp', '2025-06-08 20:11:39', 2, 7995000.00, 1, 'pending', 2),
(5, 8, 'dong', 'Dong@gmail.com', '1234567891', 'Quan 12', 'Giao nhanh', '2025-06-08 20:19:20', 1, 3850000.00, 1, 'pending', 2),
(6, 8, 'dong11', 'dongdong@gmail.com', '1234567891', 'Tan Phu', '13h qua lấy', '2025-06-09 10:17:09', 1, 9615000.00, 2, 'pending', 3);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `order_details`
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
-- Đang đổ dữ liệu cho bảng `order_details`
--

INSERT INTO `order_details` (`id`, `order_id`, `product_id`, `price`, `num`, `total_money`, `variant_id`) VALUES
(6, 3, 70, 5000000.00, 1, 5000000.00, 267),
(7, 3, 35, 450000.00, 1, 450000.00, 133),
(8, 3, 51, 1350000.00, 1, 1350000.00, 157),
(9, 3, 33, 375000.00, 1, 375000.00, 131),
(10, 4, 52, 6800000.00, 1, 6800000.00, 162),
(11, 4, 38, 510000.00, 1, 510000.00, 137),
(12, 4, 45, 90000.00, 1, 90000.00, 147),
(13, 4, 27, 297500.00, 2, 595000.00, 111),
(14, 5, 18, 1020000.00, 1, 1020000.00, 69),
(15, 5, 21, 1200000.00, 2, 2400000.00, 86),
(16, 5, 25, 340000.00, 1, 340000.00, 96),
(17, 5, 45, 90000.00, 1, 90000.00, 147),
(18, 6, 83, 8000000.00, 1, 8000000.00, 373),
(19, 6, 27, 297500.00, 2, 595000.00, 111),
(20, 6, 18, 1020000.00, 1, 1020000.00, 67);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `order_log`
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
-- Đang đổ dữ liệu cho bảng `order_log`
--

INSERT INTO `order_log` (`id`, `order_id`, `status_id`, `note`, `created_at`, `updated_by`) VALUES
(27, 1, 1, NULL, '2025-05-26 02:06:32', 2),
(28, 1, 2, NULL, '2025-05-26 02:06:36', 2),
(29, 1, 3, NULL, '2025-05-26 02:06:38', 2),
(30, 1, 4, NULL, '2025-05-26 02:34:17', 0),
(31, 1, 2, NULL, '2025-05-26 02:34:26', 0),
(32, 1, 4, NULL, '2025-05-26 02:34:30', 0),
(33, 1, 3, NULL, '2025-05-26 02:36:02', 0),
(34, 1, 4, NULL, '2025-05-26 02:36:06', 0),
(35, 1, 5, NULL, '2025-06-04 14:38:27', 1),
(36, 2, 5, NULL, '2025-06-04 14:38:34', 1),
(37, 3, 2, NULL, '2025-06-08 19:42:14', 0),
(38, 4, 2, NULL, '2025-06-08 20:12:02', 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `order_status`
--

CREATE TABLE `order_status` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `order_status`
--

INSERT INTO `order_status` (`id`, `name`) VALUES
(1, 'Chờ xác nhận'),
(2, 'Đang chuẩn bị hàng'),
(3, 'Đang giao'),
(4, 'Đã giao thành công'),
(5, 'Đã hủy');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `payment_method`
--

CREATE TABLE `payment_method` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `payment_method`
--

INSERT INTO `payment_method` (`id`, `name`) VALUES
(1, 'Thanh toán khi nhận hàng'),
(2, 'Chuyển khoản ');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product`
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
-- Đang đổ dữ liệu cho bảng `product`
--

INSERT INTO `product` (`id`, `category_id`, `brand_id`, `title`, `price`, `thumbnail`, `thumbnail_2`, `description`, `created_at`, `updated_at`, `deleted`) VALUES
(1, 8, 2, 'Harden vol8', 2000000.00, 'assets/imagesimagesAdidas-ADIDAS HARDEN VOL.8 PIONEER-01.png', 'assets/imagesimagesAdidas-ADIDAS HARDEN VOL.8 PIONEER-02.png', 'giày đẹp', '2025-05-23 19:59:11', '2025-06-04 14:38:13', 1),
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
(14, 8, 2, 'ADIDAS ADIFOM Q OFF-WHITE', 2600000.00, 'assets/images/1749110150-Adidas-ADIDAS ADIFOM Q OFF-WHITE-01.png', 'assets/images/1749110150-Adidas-ADIDAS ADIFOM Q OFF-WHITE-02.png', '', '2025-06-05 09:55:50', '2025-06-05 21:09:43', 0),
(15, 8, 2, 'ADIDAS ADIZERO SELECT SESAME BLACK', 1500000.00, 'assets/images/1749110245-Adidas-ADIDAS ADIZERO SELECT SESAME BLACK-01.png', 'assets/images/1749110245-Adidas-ADIDAS ADIZERO SELECT SESAME BLACK-02.png', '', '2025-06-05 09:57:25', '2025-06-05 21:09:54', 0),
(16, 8, 2, 'ADIDAS ADIZERO SELECT', 3000000.00, 'assets/images/1749110626-Adidas-ADIDAS ADIZERO SELECT-01.png', 'assets/images/1749110626-Adidas-ADIDAS ADIZERO SELECT-02.png', '', '2025-06-05 10:03:46', '2025-06-05 21:10:04', 0),
(17, 8, 2, 'ADIDAS D.O.N ISSUE 5', 1000000.00, 'assets/images/1749110769-Adidas-ADIDAS D.O.N ISSUE 5-01.png', 'assets/images/1749110769-Adidas-ADIDAS D.O.N ISSUE 5-02.png', '', '2025-06-05 10:06:09', '2025-06-05 21:10:15', 0),
(18, 8, 2, 'ADIDAS DAME 8 BRIDGE CITY', 1200000.00, 'assets/images/1749110823-Adidas-ADIDAS DAME 8 BRIDGE CITY-01.png', 'assets/images/1749110823-Adidas-ADIDAS DAME 8 BRIDGE CITY-02.png', '', '2025-06-05 10:07:03', '2025-06-05 21:10:24', 0),
(19, 8, 2, 'ADIDAS DAME 8 EXTPLY', 1250000.00, 'assets/images/1749110872-Adidas-ADIDAS DAME 8 EXTPLY-01.png', 'assets/images/1749110872-Adidas-ADIDAS DAME 8 EXTPLY-02.png', '', '2025-06-05 10:07:52', '2025-06-05 21:10:37', 0),
(20, 8, 2, 'ADIDAS DAME 8 MR.INCREDIBLE', 2000000.00, 'assets/images/1749110951-Adidas-ADIDAS DAME 8 MR.INCREDIBLE-01.png', 'assets/images/1749110951-Adidas-ADIDAS DAME 8 MR.INCREDIBLE-02.png', '', '2025-06-05 10:09:11', '2025-06-05 21:10:54', 0),
(21, 8, 2, 'ADIDAS HARDEN VOL.8 PIONEER', 1500000.00, 'assets/images/1749110993-Adidas-ADIDAS HARDEN VOL.8 PIONEER-01.png', 'assets/images/1749110993-Adidas-ADIDAS HARDEN VOL.8 PIONEER-02.png', '', '2025-06-05 10:09:53', '2025-06-05 21:11:02', 0),
(23, 9, 1, 'ANTHONY EDWARDS MINNESOTA TIMBERWOLVES CITY EDITION JERSEY', 500000.00, 'assets/images/1749111124-Ao-ANTHONY EDWARDS MINNESOTA TIMBERWOLVES CITY EDITION JERSEY-01.png', 'assets/images/1749151147-Ao-ANTHONY-EDWARDS-MINNESOTA-TIMBERWOLVES-CITY EDITION -JERSEY-02.png', '', '2025-06-05 10:12:04', '2025-06-05 21:19:07', 0),
(24, 9, 1, 'CURRY GOLDEN STATE WARRIORS CITY EDITION JERSEY', 500000.00, 'assets/images/1749111231-Ao-CURRY GOLDEN STATE WARRIORS CITY EDITION JERSEY-01.png', 'assets/images/1749111231-Ao-CURRY GOLDEN STATE WARRIORS CITY EDITION JERSEY-02.png', '', '2025-06-05 10:13:51', '2025-06-05 10:13:51', 0),
(25, 9, 1, 'EDWARDS MINNESOTA TIMBERWOLVES STATEMENT EDITION JERSEY', 400000.00, 'assets/images/1749111288-Ao-EDWARDS MINNESOTA TIMBERWOLVES STATEMENT EDITION JERSEY-01.png', 'assets/images/1749111288-Ao-EDWARDS MINNESOTA TIMBERWOLVES STATEMENT EDITION JERSEY-02.png', '', '2025-06-05 10:14:48', '2025-06-05 10:14:48', 0),
(26, 9, 1, 'GILGEOUS-ALEXANDER OKLAHOMA CITY THUNDER CITY EDITION 2023-2024 JERSEY', 500000.00, 'assets/images/1749111323-Ao-GILGEOUS-ALEXANDER OKLAHOMA CITY THUNDER CITY EDITION 2023-2024 JERSEY-01.png', 'assets/images/1749111323-Ao-GILGEOUS-ALEXANDER OKLAHOMA CITY THUNDER CITY EDITION 2023-2024 JERSEY-02.png', '', '2025-06-05 10:15:23', '2025-06-05 10:15:23', 0),
(27, 9, 1, 'KEVIN DURANT PHOENIX SUNS CITY EDITION 2023-24 JERSEY', 350000.00, 'assets/images/1749111353-Ao-KEVIN DURANT PHOENIX SUNS CITY EDITION 2023-24 JERSEY-01.png', 'assets/images/1749111353-Ao-KEVIN DURANT PHOENIX SUNS CITY EDITION 2023-24 JERSEY-02.png', '', '2025-06-05 10:15:53', '2025-06-05 10:15:53', 0),
(28, 9, 1, 'KLAY THOMPSON GOLDEN STATE WARRIORS 2023-24 CITY EDITION JERSEY', 500000.00, 'assets/images/1749111404-Ao-KLAY THOMPSON GOLDEN STATE WARRIORS 2023-24 CITY EDITION JERSEY-01 (1).png', 'assets/images/1749111455-Ao-KLAY THOMPSON GOLDEN STATE WARRIORS 2023-24 CITY EDITION JERSEY-01 (1).png', '', '2025-06-05 10:16:44', '2025-06-05 10:17:35', 0),
(29, 9, 1, 'LEBRON JAMES 2024 NBA ALL-STAR WEEKEND ESSENTIAL JERSEY', 500000.00, 'assets/images/1749111499-Ao-LEBRON JAMES 2024 NBA ALL-STAR WEEKEND ESSENTIAL JERSEY-01.png', 'assets/images/1749111499-Ao-LEBRON JAMES 2024 NBA ALL-STAR WEEKEND ESSENTIAL JERSEY-01.png', '', '2025-06-05 10:18:19', '2025-06-05 10:18:19', 0),
(30, 9, 1, 'TEAM USA 2024 JERSEY (HOT-PRESS)', 300000.00, 'assets/images/1749111544-Ao-TEAM USA 2024 JERSEY (HOT-PRESS)-01.png', 'assets/images/1749111544-Ao-TEAM USA 2024 JERSEY (HOT-PRESS)-02.png', '', '2025-06-05 10:19:04', '2025-06-05 10:19:04', 0),
(31, 14, 2, 'BALO ADIDAS POWER VI', 700000.00, 'assets/images/1749111613-Balo-BALO ADIDAS POWER VI-01.PNG', 'assets/images/1749111613-Balo-BALO ADIDAS POWER VI-02.webp', '', '2025-06-05 10:20:13', '2025-06-05 10:20:13', 0),
(32, 14, 3, 'BALO JORDAN LINE', 600000.00, 'assets/images/1749111678-Balo-BALO JORDAN LINE-01.png', 'assets/images/1749111678-Balo-BALO JORDAN LINE-02.webp', '', '2025-06-05 10:21:18', '2025-06-05 10:21:18', 0),
(33, 14, 3, 'BALO JORDAN MONOGRAM', 500000.00, 'assets/images/1749111720-Balo-BALO JORDAN MONOGRAM-01.png', 'assets/images/1749111720-Balo-BALO JORDAN MONOGRAM-02.webp', '', '2025-06-05 10:22:00', '2025-06-05 10:22:00', 0),
(34, 14, 1, 'BALO NIKE ACADEMY TEAM', 550000.00, 'assets/images/1749111758-Balo-BALO NIKE ACADEMY TEAM-01.png', 'assets/images/1749111758-Balo-BALO NIKE ACADEMY TEAM-02.webp', '', '2025-06-05 10:22:38', '2025-06-05 10:22:38', 0),
(35, 14, 1, 'BALO NIKE AIR ELITE (BLACK EDITION)', 600000.00, 'assets/images/1749111791-Balo-BALO NIKE AIR ELITE (BLACK EDITION)-01.png', 'assets/images/1749111791-Balo-BALO NIKE AIR ELITE (BLACK EDITION)-02.webp', '', '2025-06-05 10:23:11', '2025-06-05 10:23:11', 0),
(36, 14, 1, 'BALO NIKE AIR ELITE 2.0', 500000.00, 'assets/images/1749112643-Balo-BALO NIKE AIR ELITE 2.0-01.png', 'assets/images/1749112643-Balo-BALO NIKE AIR ELITE 2.0-02.webp', '', '2025-06-05 10:24:05', '2025-06-05 10:37:23', 0),
(37, 14, 1, 'BALO NIKE AIR ELITE', 700000.00, 'assets/images/1749112719-Balo-BALO NIKE AIR ELITE-01.png', 'assets/images/1749112719-Balo-BALO NIKE AIR ELITE-02.webp', '', '2025-06-05 10:38:39', '2025-06-05 10:38:39', 0),
(38, 14, 1, 'BALO NIKE BRASILIA', 600000.00, 'assets/images/1749112761-Balo-BALO NIKE BRASILIA-01.png', 'assets/images/1749112777-Balo-BALO NIKE BRASILIA-02.webp', '', '2025-06-05 10:39:21', '2025-06-05 10:39:37', 0),
(39, 14, 1, 'BALO NIKE SWOOSH', 650000.00, 'assets/images/1749112817-Balo-BALO NIKE SWOOSH-01.png', 'assets/images/1749112817-Balo-BALO NIKE SWOOSH-02.webp', '', '2025-06-05 10:40:17', '2025-06-05 10:40:17', 0),
(40, 13, 8, 'BĂNG GỐI HỖ TRỢ CHẤN THƯƠNG GOODFIT', 219000.00, 'assets/images/1749112956-Băng-BĂNG GỐI HỖ TRỢ CHẤN THƯƠNG GOODFIT-01.png', 'assets/images/1749112956-Băng-BĂNG GỐI HỖ TRỢ CHẤN THƯƠNG GOODFIT-02.png', '', '2025-06-05 10:42:36', '2025-06-05 10:42:36', 0),
(41, 13, 7, 'BĂNG GỐI THỂ THAO 2IN1 GOODFIT', 250000.00, 'assets/images/1749112996-Băng-BĂNG GỐI THỂ THAO 2IN1 GOODFIT-01.png', 'assets/images/1749113019-Băng-BĂNG GỐI THỂ THAO 2IN1 GOODFIT-01.png', '', '2025-06-05 10:43:16', '2025-06-05 10:43:39', 0),
(42, 13, 7, 'BĂNG GỐI THỂ THAO GOODFIT', 225000.00, 'assets/images/1749113058-Băng-BĂNG GỐI THỂ THAO GOODFIT-01.png', 'assets/images/1749113058-Băng-BĂNG GỐI THỂ THAO GOODFIT-01.png', '', '2025-06-05 10:44:18', '2025-06-05 10:44:18', 0),
(43, 11, 7, 'BANH AKPRO AB9008', 700000.00, 'assets/images/1749113219-Banh-BANH AKPRO AB9008-01.png', 'assets/images/1749113219-Banh-BANH AKPRO AB9008-02.png', '', '2025-06-05 10:46:59', '2025-06-05 10:46:59', 0),
(44, 11, 7, 'BANH BÓNG RỔ TARMAK R900', 500000.00, 'assets/images/1749113310-Banh-BANH BÓNG RỔ TARMAK R900-01.png', 'assets/images/1749113310-Banh-BANH BÓNG RỔ TARMAK R900-01.png', '', '2025-06-05 10:48:30', '2025-06-05 10:48:30', 0),
(45, 11, 7, 'BANH LI-NING WADE', 100000.00, 'assets/images/1749113442-Banh-BANH LI-NING WADE-01.png', 'assets/images/1749113442-Banh-BANH LI-NING WADE-02.png', '', '2025-06-05 10:50:42', '2025-06-05 10:50:42', 0),
(47, 11, 1, 'BANH MOLTEN FIBA 3X3', 950000.00, 'assets/images/1749113516-Banh-BANH MOLTEN FIBA 3X3-01.png', 'assets/images/1749113543-Banh-BANH MOLTEN FIBA 3X3-02.png', '', '2025-06-05 10:51:56', '2025-06-05 10:52:23', 0),
(48, 11, 1, 'BANH NIKE GIANNIS ALL-COURT', 1500000.00, 'assets/images/1749113647-Banh-BANH NIKE GIANNIS ALL-COURT-01.png', 'assets/images/1749113647-Banh-BANH NIKE GIANNIS ALL-COURT-02.png', '', '2025-06-05 10:54:07', '2025-06-05 10:54:07', 0),
(49, 11, 5, 'BANH TARMAK BT500 CONTROL', 600000.00, 'assets/images/1749113698-Banh-BANH TARMAK BT500 CONTROL-01.png', 'assets/images/1749113698-Banh-BANH TARMAK BT500 CONTROL-02.png', '', '2025-06-05 10:54:58', '2025-06-05 10:54:58', 0),
(50, 11, 4, 'BANH TARMAK BT500X FIBA', 500000.00, 'assets/images/1749113769-Banh-BANH TARMAK BT500X FIBA-01.png', 'assets/images/1749113769-Banh-BANH TARMAK BT500X FIBA-01.png', '', '2025-06-05 10:56:09', '2025-06-05 10:56:09', 0),
(51, 11, 6, 'BANH TARMAK BT900X FIBA', 1500000.00, 'assets/images/1749113819-Banh-BANH TARMAK BT900X FIBA-01.png', 'assets/images/1749113819-Banh-BANH TARMAK BT900X FIBA-02.png', '', '2025-06-05 10:56:59', '2025-06-05 10:56:59', 0),
(52, 8, 3, 'JORDAN 6 CNY', 8000000.00, 'assets/images/1749114427-Jordan-JORDAN 6 CNY-01.webp', 'assets/images/1749113902-Jordan-JORDAN 6 CNY-02.webp', '', '2025-06-05 10:58:22', '2025-06-05 11:07:07', 0),
(53, 8, 3, 'JORDAN 38 FIBA', 6000000.00, 'assets/images/1749113957-Jordan-JORDAN 38 FIBA-01.webp', 'assets/images/1749113957-Jordan-JORDAN 38 FIBA-02.png', '', '2025-06-05 10:59:17', '2025-06-05 10:59:17', 0),
(54, 8, 3, 'JORDAN LUKA 1 EASTER', 4500000.00, 'assets/images/1749114006-Jordan-JORDAN LUKA 1 EASTER-01.webp', 'assets/images/1749114006-Jordan-JORDAN LUKA 1 EASTER-02.webp', '', '2025-06-05 11:00:06', '2025-06-05 11:00:06', 0),
(55, 8, 3, 'JORDAN LUKA 2 CAVES', 2450000.00, 'assets/images/1749114060-Jordan-JORDAN LUKA 2 CAVES-01.webp', 'assets/images/1749114060-Jordan-JORDAN LUKA 2 CAVES-02.webp', '', '2025-06-05 11:01:00', '2025-06-05 11:01:00', 0),
(56, 8, 3, 'JORDAN LUKA 2 NEBULA', 2900000.00, 'assets/images/1749114126-Jordan-JORDAN LUKA 2 NEBULA-01.webp', 'assets/images/1749114126-Jordan-JORDAN LUKA 2 NEBULA-02.webp', '', '2025-06-05 11:02:06', '2025-06-05 11:02:06', 0),
(57, 8, 3, 'JORDAN LUKA 2 NEUTRA', 3500000.00, 'assets/images/1749114203-Jordan-JORDAN LUKA 2 NEUTRA-01.webp', 'assets/images/1749114203-Jordan-JORDAN LUKA 2 NEUTRA-02.webp', '', '2025-06-05 11:03:23', '2025-06-05 11:03:23', 0),
(58, 8, 3, 'JORDAN LUKA 2 QUAI54', 3590000.00, 'assets/images/1749114260-Jordan-JORDAN LUKA 2 QUAI54-01.webp', 'assets/images/1749114260-Jordan-JORDAN LUKA 2 QUAI54-02.webp', '', '2025-06-05 11:04:20', '2025-06-05 11:04:20', 0),
(59, 8, 3, 'JORDAN TATUM 1 DENIM', 3800000.00, 'assets/images/1749114331-Jordan-JORDAN TATUM 1 DENIM-01.webp', 'assets/images/1749114331-Jordan-JORDAN TATUM 1 DENIM-02.webp', '', '2025-06-05 11:05:31', '2025-06-05 11:05:31', 0),
(60, 8, 3, 'JORDAN TATUM 2 VORTEX', 3090000.00, 'assets/images/1749114379-Jordan-JORDAN TATUM 2 VORTEX-01.webp', 'assets/images/1749114379-Jordan-JORDAN TATUM 2 VORTEX-02.png', '', '2025-06-05 11:06:19', '2025-06-05 11:06:19', 0),
(61, 8, 6, 'LI-NING SPEED 10', 1999998.00, 'assets/images/1749114542-Lining-LI-NING SPEED 10-01.webp', 'assets/images/1749114542-Lining-LI-NING SPEED 10-02.webp', '', '2025-06-05 11:09:02', '2025-06-05 11:09:02', 0),
(62, 8, 6, 'LI-NING WADE ALL CITY 12 CITY OF ANGELS', 3000000.00, 'assets/images/1749114596-Lining-LI-NING WADE ALL CITY 12 CITY OF ANGELS-01.webp', 'assets/images/1749114596-Lining-LI-NING WADE ALL CITY 12 CITY OF ANGELS-02.png', '', '2025-06-05 11:09:56', '2025-06-05 11:09:56', 0),
(63, 8, 6, 'LI-NING WADE ALL CITY 12 ORIGIN', 2900000.00, 'assets/images/1749114661-Lining-LI-NING WADE ALL CITY 12 ORIGIN-01.webp', 'assets/images/1749114661-Lining-LI-NING WADE ALL CITY 12 ORIGIN-02.webp', '', '2025-06-05 11:11:01', '2025-06-05 11:11:01', 0),
(64, 8, 6, 'LI-NING WADE ALL CITY 12 SUNSHINE STATE', 2800000.00, 'assets/images/1749114785-Lining-LI-NING WADE ALL CITY 12 SUNSHINE STATE-01.webp', 'assets/images/1749114785-Lining-LI-NING WADE ALL CITY 12 SUNSHINE STATE-02.webp', '', '2025-06-05 11:13:05', '2025-06-05 11:13:05', 0),
(65, 8, 6, 'LI-NING WADE ALL CITY 12 YEAR OF DRAGON', 3000000.00, 'assets/images/1749114845-Lining-LI-NING WADE ALL CITY 12 YEAR OF DRAGON-01.webp', 'assets/images/1749114845-Lining-LI-NING WADE ALL CITY 12 YEAR OF DRAGON-02.png', '', '2025-06-05 11:14:05', '2025-06-05 11:14:05', 0),
(66, 8, 6, 'LI-NING WADE FLASH CRACKS', 3000000.00, 'assets/images/1749114947-Lining-LI-NING WADE FLASH CRACKS-01.webp', 'assets/images/1749114947-Lining-LI-NING WADE FLASH CRACKS-02.webp', '', '2025-06-05 11:15:47', '2025-06-05 11:15:47', 0),
(67, 8, 6, 'LI-NING WADE FLASH RAZ FUEGO', 2500000.00, 'assets/images/1749114989-Lining-LI-NING WADE FLASH RAZ FUEGO-01.webp', 'assets/images/1749114989-Lining-LI-NING WADE FLASH RAZ FUEGO-02.webp', '', '2025-06-05 11:16:29', '2025-06-05 11:16:29', 0),
(68, 8, 6, 'LI-NING WOW SHADOW 5 V2 PINK BUTTERFLY', 2000000.00, 'assets/images/1749115055-Lining-LI-NING WOW SHADOW 5 V2 PINK BUTTERFLY-01.webp', 'assets/images/1749115055-Lining-LI-NING WOW SHADOW 5 V2 PINK BUTTERFLY-02.webp', '', '2025-06-05 11:17:35', '2025-06-05 11:17:35', 0),
(69, 8, 1, 'NIKE GT CUT ACADEMY', 2500000.00, 'assets/images/1749115202-NIKE-NIKE DUNK LOW-03.webp', 'assets/images/1749115202-NIKE-NIKE DUNK LOW-05.png', '', '2025-06-05 11:20:02', '2025-06-05 11:20:02', 0),
(70, 8, 1, 'NIKE GT CUT 3', 5000000.00, 'assets/images/1749115282-Nike-NIKE GT CUT 3-03.webp', 'assets/images/1749115282-Nike-NIKE GT CUT 3-05.webp', '', '2025-06-05 11:21:22', '2025-06-05 11:43:38', 0),
(71, 8, 1, 'NIKE GT CUT ACADEMY', 7000000.00, 'assets/images/1749115316-NIKE-NIKE GT CUT ACADEMY-03.webp', 'assets/images/1749115316-NIKE-NIKE GT CUT ACADEMY-05.webp', '', '2025-06-05 11:21:56', '2025-06-05 21:11:35', 0),
(72, 8, 1, 'NIKE GIANNIS IMMORTALITY 3', 8500000.00, 'assets/images/1749115345-NIKE-NIKE GIANNIS IMMORTALITY 3-03.webp', 'assets/images/1749115345-NIKE-NIKE GIANNIS IMMORTALITY 3-05.png', '', '2025-06-05 11:22:25', '2025-06-05 21:12:01', 0),
(73, 8, 1, 'NIKE JA 1 AIN\'T DUCKING NO SMOKE', 990000.00, '', '', '', '2025-06-05 11:23:58', '2025-06-08 09:55:25', 1),
(74, 8, 1, 'NIKE KD 16 ALL-STAR', 10000000.00, 'assets/images/1749115546-NIKE-NIKE KD 16 ALL-STAR-03.webp', 'assets/images/1749115546-NIKE-NIKE KD 16 ALL-STAR-05.webp', '', '2025-06-05 11:25:46', '2025-06-05 21:12:53', 0),
(75, 8, 1, 'NIKE KD 16 WANDA', 8500000.00, 'assets/images/1749115585-Nike-NIKE KD 16 WANDA-03.webp', 'assets/images/1749115585-Nike-NIKE KD 16 WANDA-05.webp', '', '2025-06-05 11:26:25', '2025-06-05 21:13:14', 0),
(76, 8, 1, 'NIKE LEBRON NXXT GEN AMPD FIRST GAME', 4000000.00, 'assets/images/1749115624-NIKE-NIKE LEBRON NXXT GEN AMPD FIRST GAME-03.webp', 'assets/images/1749115624-NIKE-NIKE LEBRON NXXT GEN AMPD FIRST GAME-05.webp', '', '2025-06-05 11:27:04', '2025-06-05 21:13:32', 0),
(77, 8, 1, 'NIKE PG 5  CLIPPERS', 7000000.00, 'assets/images/1749115675-NIKE-NIKE PG 5  CLIPPERS-03.webp', 'assets/images/1749115675-NIKE-NIKE PG 5  CLIPPERS-05.webp', '', '2025-06-05 11:27:55', '2025-06-05 21:14:04', 0),
(78, 8, 1, 'NIKE PRECISION 7', 3500000.00, 'assets/images/1749115707-NIKE-NIKE PRECISION 7-03.webp', 'assets/images/1749115707-NIKE-NIKE PRECISION 7-05.webp', '', '2025-06-05 11:28:27', '2025-06-05 21:14:17', 0),
(79, 8, 8, 'PEAK BASKETBALL SONIC BOOM', 6660000.00, 'assets/images/1749115786-Peak-PEAK BASKETBALL SONIC BOOM-03.webp', 'assets/images/1749115786-Peak-PEAK BASKETBALL SONIC BOOM-05.webp', '', '2025-06-05 11:29:46', '2025-06-05 21:14:37', 0),
(80, 8, 8, 'PEAK LIGHTNING X PERFORMANCE', 7500000.00, 'assets/images/1749115820-Peak-PEAK LIGHTNING X PERFORMANCE-03.webp', 'assets/images/1749115820-Peak-PEAK LIGHTNING X PERFORMANCE-05.webp', '', '2025-06-05 11:30:20', '2025-06-05 21:14:55', 0),
(81, 8, 8, 'PEAK MONSTER 8', 9800000.00, 'assets/images/1749115848-Peak-PEAK MONSTER 8-03.webp', 'assets/images/1749115848-Peak-PEAK MONSTER 8-05.webp', '', '2025-06-05 11:30:48', '2025-06-05 21:15:09', 0),
(82, 8, 8, 'PEAK MONSTER IX', 11500000.00, 'assets/images/1749115880-Peak-PEAK MONSTER IX-03.webp', 'assets/images/1749151262-Peak-PEAK MONSTER IX-05.webp', '', '2025-06-05 11:31:20', '2025-06-05 21:21:02', 0),
(83, 8, 8, 'PEAK OUTDOOR', 8000000.00, 'assets/images/1749115921-Peak-PEAK OUTDOOR-03.webp', 'assets/images/1749115921-Peak-PEAK OUTDOOR-05.png', '', '2025-06-05 11:32:01', '2025-06-05 21:15:43', 0),
(84, 8, 8, 'PEAK OVERFLOWS', 4000000.00, 'assets/images/1749115951-Peak-PEAK OVERFLOWS-03.webp', 'assets/images/1749115951-Peak-PEAK OVERFLOWS-05.webp', '', '2025-06-05 11:32:31', '2025-06-05 21:16:17', 0),
(85, 8, 8, 'PEAK TAICHI CAVE SANDALS', 3000000.00, 'assets/images/1749116055-Peak-PEAK TAICHI CAVE SANDALS-04.webp', 'assets/images/1749116055-Peak-PEAK TAICHI CAVE SANDALS-06.webp', '', '2025-06-05 11:33:07', '2025-06-05 21:16:34', 0),
(86, 8, 8, 'PEAK WIGGINS TRIANGLE 2.0', 1500000.00, 'assets/images/1749116091-Peak-PEAK WIGGINS TRIANGLE 2.0-03.webp', 'assets/images/1749116091-Peak-PEAK WIGGINS TRIANGLE 2.0-05.png', '', '2025-06-05 11:34:51', '2025-06-05 11:42:14', 0),
(87, 12, 1, 'PACK VỚ NIKE (VNXK)', 50000.00, 'assets/images/1749116176-Sock-PACK VỚ NIKE (VNXK)-01.png', 'assets/images/1749116176-Sock-PACK VỚ NIKE (VNXK)-02.webp', '', '2025-06-05 11:36:16', '2025-06-05 11:36:16', 0),
(88, 12, 1, 'PACK VỚ NIKE EVERYDAY (VNXK)', 50000.00, 'assets/images/1749116212-Sock-PACK VỚ NIKE EVERYDAY (VNXK)-01.png', 'assets/images/1749116212-Sock-PACK VỚ NIKE EVERYDAY (VNXK)-02.png', '', '2025-06-05 11:36:52', '2025-06-05 11:36:52', 0),
(89, 12, 1, 'PACK VỚ NIKE TIE-DYE', 60000.00, 'assets/images/1749116254-Sock-PACK VỚ NIKE TIE-DYE-01.png', 'assets/images/1749116254-Sock-PACK VỚ NIKE TIE-DYE-02.webp', '', '2025-06-05 11:37:34', '2025-06-05 11:37:34', 0),
(90, 12, 1, 'RB DAILY MID SOCKS - SIMPLE IS R', 70000.00, 'assets/images/1749116294-Sock-RB DAILY MID SOCKS - SIMPLE IS R-01.webp', 'assets/images/1749116294-Sock-RB DAILY MID SOCKS - SIMPLE IS R-02.webp', '', '2025-06-05 11:38:14', '2025-06-05 11:38:14', 0),
(91, 12, 1, 'RB DAILY SOCKS - SIMPLE IS R (VER 2)', 75000.00, 'assets/images/1749116331-Sock-RB DAILY SOCKS - SIMPLE IS R (VER 2)-01.webp', 'assets/images/1749116331-Sock-RB DAILY SOCKS - SIMPLE IS R (VER 2)-02.webp', '', '2025-06-05 11:38:51', '2025-06-05 11:38:51', 0),
(92, 12, 1, 'VỚ NIKE DRI-FIT', 60000.00, 'assets/images/1749116370-Sock-VỚ NIKE DRI-FIT-01.png', 'assets/images/1749116370-Sock-VỚ NIKE DRI-FIT-02.png', '', '2025-06-05 11:39:30', '2025-06-05 11:39:30', 0),
(93, 12, 1, 'VỚ NIKE ELITE', 100000.00, 'assets/images/1749116425-Sock-VỚ NIKE ELITE-01.png', 'assets/images/1749116425-Sock-VỚ NIKE ELITE-02.png', '', '2025-06-05 11:40:25', '2025-06-05 11:40:25', 0),
(94, 12, 1, 'VỚ NIKE EVERYDAY ESSENTIAL CREW', 90000.00, 'assets/images/1749116459-Sock-VỚ NIKE EVERYDAY ESSENTIAL CREW-01.webp', 'assets/images/1749116459-Sock-VỚ NIKE EVERYDAY ESSENTIAL CREW-01.webp', '', '2025-06-05 11:40:59', '2025-06-05 11:40:59', 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product_answer`
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
-- Cấu trúc bảng cho bảng `product_discount`
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
-- Đang đổ dữ liệu cho bảng `product_discount`
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
-- Cấu trúc bảng cho bảng `product_question`
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
-- Cấu trúc bảng cho bảng `product_variant`
--

CREATE TABLE `product_variant` (
  `id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `size` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `product_variant`
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
-- Cấu trúc bảng cho bảng `return_request`
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
-- Cấu trúc bảng cho bảng `review`
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
-- Cấu trúc bảng cho bảng `role`
--

CREATE TABLE `role` (
  `id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `role`
--

INSERT INTO `role` (`id`, `name`) VALUES
(1, 'Admin'),
(2, 'User');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `shipping_method`
--

CREATE TABLE `shipping_method` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `shipping_method`
--

INSERT INTO `shipping_method` (`id`, `name`) VALUES
(1, 'Giao hàng tiêu chuẩn'),
(2, 'Giao hàng nhanh'),
(3, 'Lấy tại cửa hàng');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tokens`
--

CREATE TABLE `tokens` (
  `user_id` int(11) NOT NULL,
  `token` varchar(32) NOT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `tokens`
--

INSERT INTO `tokens` (`user_id`, `token`, `created_at`) VALUES
(1, '', '2024-08-24 21:28:44');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `user`
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
-- Đang đổ dữ liệu cho bảng `user`
--

INSERT INTO `user` (`id`, `fullname`, `email`, `phone_number`, `address`, `password`, `role_id`, `created_at`, `updated_at`, `deleted`) VALUES
(1, 'Admin', '2251120015@ut.edu.vn', '123456789', 'Nhabe', '123456', 1, '2024-08-24 21:28:44', '2025-06-03 11:17:50', 0),
(2, 'Admin', '2251120051@ut.edu.vn', NULL, NULL, 'aa3a5464ff6880389fd7e809c4652487', 1, '2025-05-22 20:51:34', '2025-05-22 20:51:34', 0),
(3, 'qhuy', 'nq2019@gmail.com', '123456789', 'nhabe', '123456', 2, '2024-08-24 21:28:44', '2025-06-03 10:50:53', 1),
(4, 'qhuyyyy', '123aa@gmail.com', NULL, NULL, 'aa3a5464ff6880389fd7e809c4652487', 2, '2025-06-03 10:41:07', '2025-06-03 10:41:07', 0),
(5, 'Khoa', 'aaas@gmail.com', '123456', 'nhabe', 'aa3a5464ff6880389fd7e809c4652487', 2, '2025-06-03 11:03:33', '2025-06-03 11:23:51', 0),
(6, 'asdasd', 'assdaw@gmail.com', '123456789', 'nhabe', 'aa3a5464ff6880389fd7e809c4652487', 2, '2025-06-03 11:21:13', '2025-06-03 11:23:54', 1),
(7, 'asdasdsad', '123456789@gmail.com', 'asdasdasdsa', 'asdad', 'aa3a5464ff6880389fd7e809c4652487', 2, '2025-06-03 11:24:18', '2025-06-03 11:24:18', 1),
(8, 'Dong123456', 'Dong@gmail.com', NULL, NULL, 'aa3a5464ff6880389fd7e809c4652487', 2, '2025-06-08 20:16:42', '2025-06-08 20:16:42', 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `wishlist`
--

CREATE TABLE `wishlist` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `blog_category`
--
ALTER TABLE `blog_category`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `blog_comment`
--
ALTER TABLE `blog_comment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `post_id` (`post_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Chỉ mục cho bảng `blog_post`
--
ALTER TABLE `blog_post`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `author_id` (`author_id`);

--
-- Chỉ mục cho bảng `brand`
--
ALTER TABLE `brand`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `discount_code`
--
ALTER TABLE `discount_code`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `code` (`code`);

--
-- Chỉ mục cho bảng `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`id`),
  ADD KEY `variant_id` (`variant_id`);

--
-- Chỉ mục cho bảng `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `status_id` (`status_id`),
  ADD KEY `payment_method_id` (`payment_method_id`),
  ADD KEY `shipping_method_id` (`shipping_method_id`);

--
-- Chỉ mục cho bảng `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Chỉ mục cho bảng `order_log`
--
ALTER TABLE `order_log`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `status_id` (`status_id`);

--
-- Chỉ mục cho bảng `order_status`
--
ALTER TABLE `order_status`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `payment_method`
--
ALTER TABLE `payment_method`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `brand_id` (`brand_id`);

--
-- Chỉ mục cho bảng `product_answer`
--
ALTER TABLE `product_answer`
  ADD PRIMARY KEY (`id`),
  ADD KEY `question_id` (`question_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Chỉ mục cho bảng `product_discount`
--
ALTER TABLE `product_discount`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

--
-- Chỉ mục cho bảng `product_question`
--
ALTER TABLE `product_question`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Chỉ mục cho bảng `product_variant`
--
ALTER TABLE `product_variant`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

--
-- Chỉ mục cho bảng `return_request`
--
ALTER TABLE `return_request`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Chỉ mục cho bảng `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Chỉ mục cho bảng `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `shipping_method`
--
ALTER TABLE `shipping_method`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `tokens`
--
ALTER TABLE `tokens`
  ADD PRIMARY KEY (`user_id`,`token`);

--
-- Chỉ mục cho bảng `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `role_id` (`role_id`);

--
-- Chỉ mục cho bảng `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `product_id` (`product_id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `blog_category`
--
ALTER TABLE `blog_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `blog_comment`
--
ALTER TABLE `blog_comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `blog_post`
--
ALTER TABLE `blog_post`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `brand`
--
ALTER TABLE `brand`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT cho bảng `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT cho bảng `discount_code`
--
ALTER TABLE `discount_code`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `inventory`
--
ALTER TABLE `inventory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=375;

--
-- AUTO_INCREMENT cho bảng `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT cho bảng `order_log`
--
ALTER TABLE `order_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT cho bảng `order_status`
--
ALTER TABLE `order_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `payment_method`
--
ALTER TABLE `payment_method`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=95;

--
-- AUTO_INCREMENT cho bảng `product_answer`
--
ALTER TABLE `product_answer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `product_discount`
--
ALTER TABLE `product_discount`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=98;

--
-- AUTO_INCREMENT cho bảng `product_question`
--
ALTER TABLE `product_question`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `product_variant`
--
ALTER TABLE `product_variant`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=377;

--
-- AUTO_INCREMENT cho bảng `return_request`
--
ALTER TABLE `return_request`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `review`
--
ALTER TABLE `review`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `role`
--
ALTER TABLE `role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `shipping_method`
--
ALTER TABLE `shipping_method`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT cho bảng `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `blog_comment`
--
ALTER TABLE `blog_comment`
  ADD CONSTRAINT `blog_comment_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `blog_post` (`id`),
  ADD CONSTRAINT `blog_comment_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Các ràng buộc cho bảng `blog_post`
--
ALTER TABLE `blog_post`
  ADD CONSTRAINT `blog_post_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `blog_category` (`id`),
  ADD CONSTRAINT `blog_post_ibfk_2` FOREIGN KEY (`author_id`) REFERENCES `user` (`id`);

--
-- Các ràng buộc cho bảng `inventory`
--
ALTER TABLE `inventory`
  ADD CONSTRAINT `inventory_ibfk_1` FOREIGN KEY (`variant_id`) REFERENCES `product_variant` (`id`);

--
-- Các ràng buộc cho bảng `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`status_id`) REFERENCES `order_status` (`id`),
  ADD CONSTRAINT `orders_ibfk_3` FOREIGN KEY (`payment_method_id`) REFERENCES `payment_method` (`id`),
  ADD CONSTRAINT `orders_ibfk_4` FOREIGN KEY (`shipping_method_id`) REFERENCES `shipping_method` (`id`);

--
-- Các ràng buộc cho bảng `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `order_details_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`),
  ADD CONSTRAINT `order_details_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`);

--
-- Các ràng buộc cho bảng `order_log`
--
ALTER TABLE `order_log`
  ADD CONSTRAINT `order_log_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`),
  ADD CONSTRAINT `order_log_ibfk_2` FOREIGN KEY (`status_id`) REFERENCES `order_status` (`id`);

--
-- Các ràng buộc cho bảng `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`),
  ADD CONSTRAINT `product_ibfk_2` FOREIGN KEY (`brand_id`) REFERENCES `brand` (`id`);

--
-- Các ràng buộc cho bảng `product_answer`
--
ALTER TABLE `product_answer`
  ADD CONSTRAINT `product_answer_ibfk_1` FOREIGN KEY (`question_id`) REFERENCES `product_question` (`id`),
  ADD CONSTRAINT `product_answer_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Các ràng buộc cho bảng `product_discount`
--
ALTER TABLE `product_discount`
  ADD CONSTRAINT `product_discount_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`);

--
-- Các ràng buộc cho bảng `product_question`
--
ALTER TABLE `product_question`
  ADD CONSTRAINT `product_question_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`),
  ADD CONSTRAINT `product_question_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Các ràng buộc cho bảng `product_variant`
--
ALTER TABLE `product_variant`
  ADD CONSTRAINT `product_variant_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`);

--
-- Các ràng buộc cho bảng `return_request`
--
ALTER TABLE `return_request`
  ADD CONSTRAINT `return_request_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`),
  ADD CONSTRAINT `return_request_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`);

--
-- Các ràng buộc cho bảng `review`
--
ALTER TABLE `review`
  ADD CONSTRAINT `review_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `review_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`);

--
-- Các ràng buộc cho bảng `tokens`
--
ALTER TABLE `tokens`
  ADD CONSTRAINT `tokens_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Các ràng buộc cho bảng `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `role` (`id`);

--
-- Các ràng buộc cho bảng `wishlist`
--
ALTER TABLE `wishlist`
  ADD CONSTRAINT `wishlist_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `wishlist_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
