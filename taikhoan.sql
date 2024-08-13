-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 18, 2024 at 10:05 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.2.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `taikhoan`
--

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--
-- Error reading structure for table taikhoan.customers: #1932 - Table 'taikhoan.customers' doesn't exist in engine
-- Error reading data for table taikhoan.customers: #1064 - You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near 'FROM `taikhoan`.`customers`' at line 1

-- --------------------------------------------------------

--
-- Table structure for table `dangnhap`
--

CREATE TABLE `dangnhap` (
  `id` int(11) NOT NULL,
  `user_name` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `description` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0=User,1=Admin'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dangnhap`
--

INSERT INTO `dangnhap` (`id`, `user_name`, `password`, `name`, `description`) VALUES
(36, 'Duy', '123', 'Yến Duy', 1),
(38, 'Hoa', '0309', 'Thị Hòa', 0),
(39, 'hoanguyentranthi32@gmail.com', '123456', 'Hoa', 0),
(40, 'Hoa@gmail.com', '123', 'ThiHoa', 0),
(41, '0772962490', '0309', 'Thị Hòa', 0),
(42, 'tuilahoa', '123', 'Tui', 0);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(50) DEFAULT NULL,
  `firstname` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lastname` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(70) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('Xử lý','Đã xác nhận','Đang chuyển hàng','Đã giao hàng','Đã hủy') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `firstname`, `lastname`, `address`, `phone`, `email`, `status`, `created_at`, `updated_at`) VALUES
(96, 0, 'Không có', 'Nguyễn Trần Thị Hòa', 'Đồng Tháp', '0772962490', 'hoanguyentranthi32@gmail.com', 'Đã giao hàng', '2024-01-13 15:34:00', '2024-01-13 15:34:00'),
(97, 0, 'Không có', 'Phạm Thị Yến Duy', 'Thanh Bình', '0772345890', 'duyphamthi26@gmail.com', 'Đã xác nhận', '2024-01-13 15:37:29', '2024-01-13 15:37:29'),
(98, 0, 'Ko có', 'Nguyễn Thị A', 'Bình Thuận', '0956778921', 'nguyenthia123@gmail.com', 'Xử lý', '2024-01-14 14:06:43', '2024-01-14 14:06:43'),
(99, 0, 'Không có', 'Phạm Thị Yến Duy', 'Lấp Vò', '0772345890', 'hoanguyentranthi32@gmail.com', 'Đã xác nhận', '2024-01-18 08:00:11', '2024-01-18 08:00:11');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `price` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `qty` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ten` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `anh` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `size` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total` double(15,2) NOT NULL DEFAULT 0.00,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `price`, `qty`, `ten`, `anh`, `size`, `total`, `created_at`, `updated_at`) VALUES
(39, 96, 1, '400.000', '1', 'MŨ BẢO HIỂM 1/2 ROYAL M153K', '2.jpg', 'M', 400.00, '2024-01-13 15:34:00', '2024-01-13 15:34:00'),
(40, 96, 1, '780.000', '1', 'MŨ BẢO HIỂM 3/4 ROYAL M20D', 'b43.png', 'L', 780.00, '2024-01-13 15:34:00', '2024-01-13 15:34:00'),
(41, 97, 1, '420.000', '1', 'MŨ BẢO HIỂM 3/4 TRẺ EM ROYAL M20KS', 'e1.jpg', 'M', 420.00, '2024-01-13 15:37:29', '2024-01-13 15:37:29'),
(42, 98, 1, '1050.000', '1', 'MŨ BẢO HIỂM LẬT CẰM ROYAL M08 DESIGN', 'l1.jpg', 'L', 1050.00, '2024-01-14 14:06:43', '2024-01-14 14:06:43'),
(43, 99, 1, '745.000', '2', 'MŨ BẢO HIỂM LẬT CẰM ROYAL M179 DESIGN', 'l3.jpg', 'M', 1490.00, '2024-01-18 08:00:11', '2024-01-18 08:00:11');

-- --------------------------------------------------------

--
-- Table structure for table `phanloai`
--

CREATE TABLE `phanloai` (
  `id` int(11) NOT NULL,
  `phanloai_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `phanloai`
--

INSERT INTO `phanloai` (`id`, `phanloai_name`) VALUES
(1, 'Mũ bảo hiểm 3/4'),
(2, 'Mũ bảo hiểm 1/2'),
(3, 'Mũ bảo hiểm full/face'),
(4, 'Mũ bảo hiểm xe đạp'),
(5, 'Mũ bảo hiểm trẻ em'),
(6, 'Mũ bảo hiểm lật cằm');

-- --------------------------------------------------------

--
-- Table structure for table `sanpham`
--

CREATE TABLE `sanpham` (
  `id` int(11) NOT NULL,
  `phanloai_id` int(5) DEFAULT NULL,
  `ten` varchar(255) DEFAULT NULL,
  `gia` double(15,3) NOT NULL DEFAULT 0.000,
  `anh` varchar(255) DEFAULT NULL,
  `mota` varchar(500) DEFAULT NULL,
  `soluong` int(50) DEFAULT NULL,
  `size` varchar(20) DEFAULT NULL,
  `masp` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sanpham`
--

INSERT INTO `sanpham` (`id`, `phanloai_id`, `ten`, `gia`, `anh`, `mota`, `soluong`, `size`, `masp`) VALUES
(5, 2, 'MŨ BẢO HIỂM 1/2 ROYAL M152K', 400.000, '1.jpg', '<p>\r\n    - Vỏ bằng nhựa ABS nguyên sinh\r\n    <br><br>\r\n    - Trọng lượng: <b>573g ± 50g</b>\r\n    <br><br>\r\n    - Có 2 size để lựa chọn:\r\n        <br><b>size L: 55-57 cm</b>\r\n        <br><b>size XL: 57-59 cm</b>\r\n</p>', 50, NULL, 'MŨ BẢO HIỂM 1/2 ĐẦU ROYAL M152K'),
(7, 2, 'MŨ BẢO HIỂM 1/2 ROYAL M153K', 400.000, '2.jpg', '<p>\r\n    - Vỏ bằng nhựa ABS nguyên sinh\r\n    <br><br>\r\n    - Trọng lượng: <b>573g ± 50g</b>\r\n    <br><br>\r\n    - Có 2 size để lựa chọn:\r\n        <br><b>size L: 55-57 cm</b>\r\n        <br><b>size XL: 57-59 cm</b>\r\n</p>\r\n', 50, NULL, 'MŨ BẢO HIỂM 1/2 ĐẦU ROYAL M153K'),
(8, 2, 'MŨ BẢO HIỂM 1/2 ROYAL M156K', 400.000, '3.jpg', '<p>-Thiết kế kính âm đột phá, nhiều mẫu tem độc đáo\r\n                            <br><br>\r\n                            -Chế tạo bằng nhựa ABS nguyên sinh, độ bền cao\r\n                            <br><br>\r\n                            -Trọng lượng <b>950 g</b>\r\n                            <br><br>\r\n                            -Có 3 size để lựa chọn: <b>size M:54-55 cm, size L:55-57 cm, size XL:57-59 cm.</b></p>', 50, NULL, 'MŨ BẢO HIỂM 1/2 ĐẦU ROYAL M156K'),
(10, 2, 'MŨ BẢO HIỂM 1/2 ĐẦU ROYAL M152LT', 380.000, '4.jpg', '<p>\r\n    - Vỏ bằng nhựa ABS nguyên sinh\r\n    <br><br>\r\n    - Trọng lượng: <b>737g ± 50g</b>\r\n    <br><br>\r\n    - Có 2 size để lựa chọn:\r\n        <br><b>size L: 55-57 cm</b>\r\n        <br><b>size XL: 57-59 cm</b>\r\n</p>', 50, NULL, 'MŨ BẢO HIỂM 1/2 ĐẦU ROYAL M152LT '),
(11, 2, 'MŨ BẢO HIỂM 1/2 ROYAL M153LT', 380.000, '5.jpg', '<p>\r\n    - Vỏ bằng nhựa ABS nguyên sinh\r\n    <br><br>\r\n    - Trọng lượng: <b>752g ± 50g</b>\r\n    <br><br>\r\n    - Có 2 size để lựa chọn:\r\n        <br><b>size L: 55-57 cm</b>\r\n        <br><b>size XL: 57-59 cm</b>\r\n</p>', 50, NULL, 'MŨ BẢO HIỂM 1/2 ĐẦU ROYAL M153LT '),
(12, 2, 'MŨ BẢO HIỂM 1/2 ROYAL M154', 320.000, '6.jpg', '<p>\r\n    - Vỏ bằng nhựa ABS nguyên sinh\r\n    <br><br>\r\n    - Trọng lượng: <b>422g ± 50g</b>\r\n    <br><br>\r\n    - Có 2 size để lựa chọn:\r\n        <br>\r\n        <br><b>size L: 55-57 cm</b>\r\n        <br><b>size XL: 57-59 cm</b>\r\n</p>', 50, NULL, 'MŨ BẢO HIỂM 1/2 ĐẦU ROYAL M154'),
(13, 1, 'MŨ BẢO HIỂM 3/4 M139 KÍNH ÂM', 730.000, 'b39.png', '<p>-Thiết kế kính âm đột phá, nhiều mẫu tem độc đáo\r\n                            <br><br>\r\n                            -Chế tạo bằng nhựa ABS nguyên sinh, độ bền cao\r\n                            <br><br>\r\n                            -Trọng lượng <b>950 g</b>\r\n                            <br><br>\r\n                            -Có 3 size để lựa chọn: <b>size M:54-55 cm, size L:55-57 cm, size XL:57-59 cm.</b></p>', 50, '', 'MŨ BẢO HIỂM 3/4 ROYAL M139 KÍNH ÂM DESIGN'),
(14, 1, 'MŨ BẢO HIỂM 3/4 M20C DESIGN', 630.000, 'b40.png', '<p>-Thiết kế kính âm đột phá, nhiều mẫu tem độc đáo\r\n                            <br><br>\r\n                            -Chế tạo bằng nhựa ABS nguyên sinh, độ bền cao\r\n                            <br><br>\r\n                            -Trọng lượng <b>950 g</b>\r\n                            <br><br>\r\n                            -Có 3 size để lựa chọn: <b>size M:54-55 cm, size L:55-57 cm, size XL:57-59 cm.</b></p>', 50, NULL, 'MŨ BẢO HIỂM 3/4 ROYAL M20C DESIGN'),
(15, 1, 'MŨ BẢO HIỂM 3/4 ROYAL M134D', 450.000, 'b41.png', '<p>\r\n    - Vỏ bằng nhựa ABS nguyên sinh\r\n    <br><br>\r\n    - Trọng lượng: <b>1000g ± 50g</b>\r\n    <br><br>\r\n    - Kích thước: <b>Size XL: 56-58 cm</b>\r\n</p>', 50, NULL, 'MŨ BẢO HIỂM 3/4 ROYAL M134D '),
(16, 1, 'MŨ BẢO HIỂM 3/4 XH 01', 600.000, 'b6.jpg', '<p>\r\n    - Vỏ bằng nhựa ABS nguyên sinh\r\n    <br><br>\r\n    - Trọng lượng: <b>873g ± 50g</b>\r\n    <br><br>\r\n    - Kích thước: <b>Size L: 55-57 cm</b>\r\n</p>', 50, NULL, 'MŨ BẢO HIỂM 3/4 XH 01'),
(17, 1, 'MŨ BẢO HIỂM 3/4 ROYAL M20C', 550.000, 'b3.jpg', '<p>\r\n    - Vỏ bằng nhựa ABS nguyên sinh\r\n    <br><br>\r\n    - Trọng lượng: <b>850g ± 50g</b>\r\n    <br><br>\r\n    - Có 2 size để lựa chọn:\r\n        <br><b>size L: 55-57 cm</b>\r\n        <br><b>size XL: 57-59 cm</b>\r\n</p>', 50, NULL, 'MŨ BẢO HIỂM 3/4 ROYAL M20C'),
(18, 1, 'MŨ BẢO HIỂM XH 01 DESIGN', 630.000, 'b29.jpg', '<p>\r\n    - Vỏ bằng nhựa ABS nguyên sinh\r\n    <br><br>\r\n    - Trọng lượng: <b>873g ± 50g</b>\r\n    <br><br>\r\n    - Kích thước: <b>Size L: 55-57 cm</b>\r\n</p>', 50, NULL, 'MŨ BẢO HIỂM XH 01 DESIGN '),
(19, 1, 'MŨ BẢO HIỂM 3/4 ROYAL M20K', 520.000, 'b9.jpg', '<p>\r\n    - Vỏ bằng nhựa ABS nguyên sinh\r\n    <br><br>\r\n    - Trọng lượng: <b>850g ± 50g</b>\r\n    <br><br>\r\n    - Có 2 size để lựa chọn:\r\n        <br><b>Size L: 55-57 cm</b>\r\n        <br><b>Size XL: 57-59 cm</b>\r\n</p>', 50, NULL, 'MŨ BẢO HIỂM 3/4 ROYAL M20K'),
(22, 3, 'MŨ BẢO HIỂM FULLFACE ROYAL M141K', 1210.000, 'f8.jpg', '<p>\r\n    - Vỏ bằng nhựa ABS nguyên sinh\r\n    <br><br>\r\n    - Trọng lượng: <b>1200g ± 50g</b>\r\n    <br><br>\r\n    - Có 2 size để lựa chọn:\r\n        <br><b>Size L: 56-57 cm</b>\r\n        <br><b>Size XL: 58-59 cm</b>\r\n</p>', 50, NULL, 'MŨ BẢO HIỂM FULLFACE ROYAL M141K'),
(23, 3, 'MŨ BẢO HIỂM FULLFACE ROYAL M141', 1130.000, 'f5.jpg', '<p>\r\n    - Vỏ bằng nhựa ABS nguyên sinh\r\n    <br><br>\r\n    - Trọng lượng: <b>1200g ± 50g</b>\r\n    <br><br>\r\n    - Có 2 size để lựa chọn:\r\n        <br><b>Size L: 56-57 cm</b>\r\n        <br><b>Size XL: 58-59 cm</b>\r\n</p>', 50, NULL, 'MŨ BẢO HIỂM FULLFACE ROYAL M141'),
(24, 3, 'MŨ BẢO HIỂM FULLFACE 2 KÍNH ROYAL M266 DESIGN', 760.000, 'f1.jpg', '<p>\r\n    - Vỏ bằng nhựa ABS nguyên sinh\r\n    <br><br>\r\n    - Trọng lượng: <b>1111g ± 50g</b>\r\n    <br><br>\r\n    - Có 2 size để lựa chọn:\r\n        <br><b>Size L: 55-57 cm</b>\r\n        <br><b>Size XL: 57-59 cm</b>\r\n</p>', 50, NULL, 'MŨ BẢO HIỂM FULLFACE 2 KÍNH ROYAL M266 DESIGN'),
(25, 3, 'MŨ BẢO HIỂM FULLFACE 2 KÍNH ROYAL M266 TRƠN', 720.000, 'f12.jpg', '<p>\r\n    - Vỏ bằng nhựa ABS nguyên sinh\r\n    <br><br>\r\n    - Trọng lượng: <b>1111g ± 50g</b>\r\n    <br><br>\r\n    - Có 2 size để lựa chọn:\r\n        <br><b>Size L: 55-57 cm</b>\r\n        <br><b>Size XL: 57-59 cm</b>\r\n</p>', 50, NULL, 'MŨ BẢO HIỂM FULLFACE 2 KÍNH ROYAL M266 TRƠN '),
(26, 3, 'MŨ BẢO HIỂM FULLFACE ROYAL M136 DESIGN', 620.000, 'f16.jpg', '<p>\r\n    - Vỏ bằng nhựa ABS nguyên sinh\r\n    <br><br>\r\n    - Trọng lượng: <b>1050g ± 50g</b>\r\n    <br><br>\r\n    - Có 2 size để lựa chọn:\r\n        <br><b>Size L: 55-57 cm</b>\r\n        <br><b>Size XL: 57-59 cm</b>\r\n</p>', 50, NULL, 'MŨ BẢO HIỂM FULLFACE ROYAL M136 DESIGN'),
(27, 3, 'MŨ BẢO HIỂM FULLFACE ROYAL M136 DESIGN', 620.000, 'f20.jpg', '<p>\r\n    - Vỏ bằng nhựa ABS nguyên sinh\r\n    <br><br>\r\n    - Trọng lượng: <b>1050g ± 50g</b>\r\n    <br><br>\r\n    - Có 2 size để lựa chọn:\r\n        <br><b>Size L: 55-57 cm</b>\r\n        <br><b>Size XL: 57-59 cm</b>\r\n</p>', 50, NULL, 'MŨ BẢO HIỂM FULLFACE ROYAL M136 DESIGN'),
(28, 3, 'MŨ BẢO HIỂM FULLFACE ROYAL M02-DESIGN', 600.000, 'f24.jpg', '<p>\r\n    - Vỏ bằng nhựa ABS nguyên sinh\r\n    <br><br>\r\n    - Trọng lượng: <b>1500g ± 50g</b>\r\n    <br><br>\r\n    - Kích thước: <b>Size XL: 57-59 cm</b>\r\n</p>', 50, NULL, 'MŨ BẢO HIỂM FULLFACE ROYAL M02-DESIGN'),
(29, 3, 'MŨ BẢO HIỂM FULLFACE ROYAL M02 TRƠN', 600.000, 'f28.jpg', '<p>\r\n    - Vỏ bằng nhựa ABS nguyên sinh\r\n    <br><br>\r\n    - Trọng lượng: <b>1111g ± 50g</b>\r\n    <br><br>\r\n    - Có 2 size để lựa chọn:\r\n        <br><b>Size L: 55-57 cm</b>\r\n        <br><b>Size XL: 57-59 cm</b>\r\n</p>', 50, NULL, 'MŨ BẢO HIỂM FULLFACE ROYAL M02 TRƠN'),
(31, 6, 'MŨ BẢO HIỂM LẬT CẰM ROYAL M08 DESIGN', 1050.000, 'l1.jpg', '<p>\r\n    - Vỏ bằng nhựa ABS nguyên sinh\r\n    <br><br>\r\n    - Trọng lượng: <b>1050g ± 50g</b>\r\n    <br><br>\r\n    - Có 2 size để lựa chọn:\r\n        <br><b>Size L: 56-57 cm</b>\r\n        <br><b>Size XL: 58-59 cm</b>\r\n</p>', 50, NULL, 'MŨ BẢO HIỂM LẬT CẰM ROYAL M08 DESIGN'),
(32, 6, 'MŨ BẢO HIỂM LẬT CẰM ROYAL M08', 990.000, 'l2.jpg', '<p>\r\n    - Vỏ bằng nhựa ABS nguyên sinh\r\n    <br><br>\r\n    - Trọng lượng: <b>1050g ± 50g</b>\r\n    <br><br>\r\n    - Có 2 size để lựa chọn:\r\n        <br><b>Size L: 56-57 cm</b>\r\n        <br><b>Size XL: 58-59 cm</b>\r\n</p>', 50, NULL, 'MŨ BẢO HIỂM LẬT CẰM ROYAL M08'),
(33, 6, 'MŨ BẢO HIỂM LẬT CẰM ROYAL M179 DESIGN', 745.000, 'l3.jpg', '<p>\r\n    - Vỏ bằng nhựa ABS nguyên sinh\r\n    <br><br>\r\n    - Trọng lượng: <b>1050g ± 50g</b>\r\n    <br><br>\r\n    - Có 2 size để lựa chọn:\r\n        <br><b>Size L: 56-57 cm</b>\r\n        <br><b>Size XL: 58-59 cm</b>\r\n</p>', 50, NULL, 'MŨ BẢO HIỂM LẬT CẰM ROYAL M179 DESIGN'),
(34, 6, 'MŨ BẢO HIỂM LẬT CẰM ROYAL M179', 710.000, 'l4.jpg', '<p>\r\n    - Vỏ bằng nhựa ABS nguyên sinh\r\n    <br><br>\r\n    - Trọng lượng: <b>1050g ± 50g</b>\r\n    <br><br>\r\n    - Có 2 size để lựa chọn:\r\n        <br><b>Size L: 56-57 cm</b>\r\n        <br><b>Size XL: 58-59 cm</b>\r\n</p>', 50, NULL, 'MŨ BẢO HIỂM LẬT CẰM ROYAL M179'),
(35, 5, 'MŨ BẢO HIỂM 3/4 ĐẦU TRẺ EM M139 KID - KÍNH ÂM', 580.000, 'e5.jpg', '<p>\r\n    - Thiết kế kính âm đột phá, nhiều màu sắc.\r\n    <br><br>\r\n    - Trọng lượng: <b>712g ± 50g</b>\r\n    <br><br>\r\n    - Kích thước: <b>Size S: 52-54 cm</b>\r\n</p>', 50, NULL, 'MŨ BẢO HIỂM 3/4 ĐẦU TRẺ EM M139 KID - KÍNH ÂM'),
(36, 5, 'MŨ BẢO HIỂM 3/4 ĐẦU TRẺ EM ROYAL M270 DESIGN', 370.000, 'e9.png', '<p>\r\n    - Vỏ bằng nhựa ABS nguyên sinh\r\n    <br><br>\r\n    - Trọng lượng: <b>850g ± 50g</b>\r\n    <br><br>\r\n    - Có 2 size để lựa chọn:\r\n        <br><b>Size S: 52-54 cm</b>\r\n        <br><b>Size M: 54-55 cm</b>\r\n</p>', 50, NULL, 'MŨ BẢO HIỂM 3/4 ĐẦU TRẺ EM ROYAL M270 DESIGN'),
(37, 5, 'MŨ BẢO HIỂM 3/4 TRẺ EM ROYAL M20KS', 420.000, 'e1.jpg', '<p>\r\n    - Chất liệu: Vỏ nón làm từ nhựa ABS\r\n    <br><br>\r\n    - Mốp xốp: làm bằng EPS\r\n    <br><br>\r\n    - Có 2 size để lựa chọn:\r\n        <br><b>Size S: 50-52 cm</b>\r\n        <br><b>Size M: 53-54 cm</b>\r\n    <br><br>\r\n    - Trọng lượng: <b>668g ± 50g</b>\r\n</p>', 50, NULL, 'MŨ BẢO HIỂM 3/4 TRẺ EM ROYAL M20KS'),
(38, 4, 'MŨ BẢO HIỂM XE ĐẠP ROYAL MD-15 DESIGN', 550.000, 'x1.jpg', '<p>\r\n    - Vỏ bằng nhựa ABS nguyên sinh\r\n    <br><br>\r\n    - Xốp EPS\r\n    <br><br>\r\n    - Trọng lượng: <b>350 gram</b>\r\n    <br><br>\r\n    - Kích thước: Freesize (58-60 cm) - có hệ thống Roc-Lock dễ dàng tăng chỉnh vòng đầu.\r\n</p>', 50, NULL, 'MŨ BẢO HIỂM XE ĐẠP ROYAL MD-15 DESIGN'),
(39, 4, 'MŨ BẢO HIỂM XE ĐẠP MD-15 TRƠN', 550.000, 'x5.jpg', '<p>\r\n    - Vỏ bằng nhựa ABS nguyên sinh\r\n    <br><br>\r\n    - Xốp EPS\r\n    <br><br>\r\n    - Trọng lượng: <b>350 gram</b>\r\n    <br><br>\r\n    - Kích thước: Freesize (58-60 cm) - có hệ thống Roc-Lock dễ dàng tăng chỉnh vòng đầu.\r\n</p>', 50, NULL, 'MŨ BẢO HIỂM XE ĐẠP MD-15 TRƠN'),
(40, 4, 'MŨ BẢO HIỂM XE ĐẠP KÍNH HÍT ROYAL MD-16 TRƠN', 550.000, 'x9.jpg', '<p>\r\n    - Vỏ bằng nhựa ABS nguyên sinh\r\n    <br><br>\r\n    - Xốp EPS\r\n    <br><br>\r\n    - Trọng lượng: <b>310 gram</b>\r\n    <br><br>\r\n    - Kích thước: Freesize (58-60 cm) - có hệ thống Roc-Lock dễ dàng tăng chỉnh vòng đầu.\r\n</p>', 50, NULL, 'MŨ BẢO HIỂM XE ĐẠP KÍNH HÍT ROYAL MD-16 TRƠN'),
(41, 4, 'MŨ BẢO HIỂM XE ĐẠP KÍNH HÍT ROYAL MD-16 DESIGN', 550.000, 'x10.jpg', '<p>\r\n    - Vỏ bằng nhựa ABS nguyên sinh\r\n    <br><br>\r\n    - Xốp EPS\r\n    <br><br>\r\n    - Trọng lượng: <b>310 gram</b>\r\n    <br><br>\r\n    - Kích thước: Freesize (58-60 cm) - có hệ thống Roc-Lock dễ dàng tăng chỉnh vòng đầu.\r\n</p>', 50, NULL, 'MŨ BẢO HIỂM XE ĐẠP KÍNH HÍT ROYAL MD-16 DESIGN '),
(42, 4, 'MŨ BẢO HIỂM XE ĐẠP MD-17', 450.000, 'x17.jpg', '<p>\r\n    - Vỏ bằng nhựa ABS nguyên sinh\r\n    <br><br>\r\n    - Xốp EPS\r\n    <br><br>\r\n    - Trọng lượng: <b>400 gram</b>\r\n    <br><br>\r\n    - Kích thước: Freesize (58-60 cm) - có hệ thống Roc-Lock dễ dàng tăng chỉnh vòng đầu.\r\n</p>', 50, NULL, 'MŨ BẢO HIỂM XE ĐẠP ROYAL MD-17'),
(43, 4, 'MŨ BẢO HIỂM XE ĐẠP MD-07', 390.000, 'x21.jpg', '<p>\r\n    - Vỏ bằng nhựa ABS nguyên sinh\r\n    <br><br>\r\n    - Xốp EPS\r\n    <br><br>\r\n    - Trọng lượng: <b>350 gram</b>\r\n    <br><br>\r\n    - Kích thước: Freesize (58-60 cm) - có hệ thống Roc-Lock dễ dàng tăng chỉnh vòng đầu.\r\n</p>', 50, NULL, 'MŨ BẢO HIỂM XE ĐẠP MD-07'),
(44, 4, 'MŨ BẢO HIỂM XE ĐẠP TRẺ EM ROYAL MD-10', 280.000, 'x25.jpg', '<p>\r\n    - Vỏ bằng nhựa ABS nguyên sinh\r\n    <br><br>\r\n    - Xốp EPS\r\n    <br><br>\r\n    - Trọng lượng: <b>180 ± 10 gram</b>\r\n    <br><br>\r\n    - Kích thước vòng đầu: <b>53-55 cm</b>\r\n    <br><br>\r\n    - Tem dán ngẫu nhiên.\r\n</p>', 50, NULL, 'MŨ BẢO HIỂM XE ĐẠP TRẺ EM ROYAL MD-10'),
(105, 2, 'MŨ BẢO HIỂM 1/2 ROYAL M379', 270.000, '7.jpg', '<p>\r\n    - Vỏ bằng nhựa ABS nguyên sinh\r\n    <br><br>\r\n    - Trọng lượng: <b>540g ± 50g</b>\r\n    <br><br>\r\n    - Kích thước: <b>size L: 55-58 cm</b>\r\n</p>', 50, NULL, 'MŨ BẢO HIỂM 1/2 ĐẦU ROYAL M379 '),
(106, 2, 'MŨ BẢO HIỂM 1/2ROYAL M158', 270.000, '8.png', '<p>\r\n    - Chế tạo bằng nhựa ABS nguyên sinh, độ bền cao\r\n    <br><br>\r\n    - Trọng lượng: <b>590g ± 50g</b>\r\n    <br><br>\r\n    - Kích thước Freesize (Vòng đầu): <b>54-58 cm</b>\r\n</p>', 50, NULL, 'MŨ BẢO HIỂM 1/2 ĐẦU ROYAL M158 '),
(107, 1, 'MŨ BẢO HIỂM 3/4 ROYAL M20D', 780.000, 'b43.png', '<p>\r\n    - Vỏ bằng nhựa ABS nguyên sinh\r\n    <br><br>\r\n    - Trọng lượng: <b>850g ± 50g</b>\r\n    <br><br>\r\n    - Có 2 size để lựa chọn:\r\n        <br><b>Size L: 55-57 cm</b>\r\n        <br><b>Size XL: 57-59 cm</b>\r\n</p>', 50, NULL, 'MŨ BẢO HIỂM 3/4 ROYAL M20D ');

-- --------------------------------------------------------

--
-- Table structure for table `size`
--

CREATE TABLE `size` (
  `id` int(11) NOT NULL,
  `size_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `size`
--

INSERT INTO `size` (`id`, `size_name`) VALUES
(2, 'L'),
(3, 'XL'),
(4, 'M');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dangnhap`
--
ALTER TABLE `dangnhap`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `SanPham_ibfk_2` (`order_id`);

--
-- Indexes for table `phanloai`
--
ALTER TABLE `phanloai`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sanpham`
--
ALTER TABLE `sanpham`
  ADD PRIMARY KEY (`id`),
  ADD KEY `SanPham_ibfk_1` (`phanloai_id`);

--
-- Indexes for table `size`
--
ALTER TABLE `size`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dangnhap`
--
ALTER TABLE `dangnhap`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `phanloai`
--
ALTER TABLE `phanloai`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `sanpham`
--
ALTER TABLE `sanpham`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=112;

--
-- AUTO_INCREMENT for table `size`
--
ALTER TABLE `size`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `sanpham`
--
ALTER TABLE `sanpham`
  ADD CONSTRAINT `SanPham_ibfk_1` FOREIGN KEY (`phanloai_id`) REFERENCES `phanloai` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
