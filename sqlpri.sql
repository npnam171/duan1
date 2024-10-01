-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: localhost:3306
-- Thời gian đã tạo: Th8 06, 2024 lúc 12:13 PM
-- Phiên bản máy phục vụ: 8.0.30
-- Phiên bản PHP: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `duan11`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `bill`
--

CREATE TABLE `bill` (
  `bill_id` int NOT NULL,
  `user_id` int DEFAULT NULL,
  `full_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone_number` varchar(20) NOT NULL,
  `address` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `total_price` decimal(15,0) NOT NULL COMMENT 'Tổng giá',
  `bill_status` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT '0' COMMENT 'tình trạng hóa đơn',
  `created_datetime` datetime NOT NULL COMMENT 'ngày giờ đã tạo',
  `payment_status` tinyint NOT NULL DEFAULT '0',
  `bill_code` varchar(50) NOT NULL COMMENT 'mã hoá đơn'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Đang đổ dữ liệu cho bảng `bill`
--

INSERT INTO `bill` (`bill_id`, `user_id`, `full_name`, `email`, `phone_number`, `address`, `total_price`, `bill_status`, `created_datetime`, `payment_status`, `bill_code`) VALUES
(232, 1, 'Nguyễn Phương', 'nguyenphuongnam.intern@gmail.com', '0337412617', 'Thanh Mỹ - Sơn Tây - Hà Nội', 20000, '6', '2024-08-01 08:45:27', 2, '172250192796497'),
(233, 1, 'Nguyễn Phương', 'nguyenphuongnam.intern@gmail.com', '0337412617', 'Thanh Mỹ - Sơn Tây - Hà Nội', 45000, '3', '2024-08-01 08:46:20', 1, '172250198014123'),
(234, 1, 'Nguyễn Phương', 'nguyenphuongnam.intern@gmail.com', '0337412617', 'Thanh Mỹ - Sơn Tây - Hà Nội', 25000, '6', '2024-08-01 16:03:15', 2, '172252819572475'),
(235, 1, 'Nguyễn Phương', 'nguyenphuongnam.intern@gmail.com', '0337412617', 'Thanh Mỹ - Sơn Tây - Hà Nội', 20000, '0', '2024-08-02 18:14:02', 2, '172262244298903'),
(236, 1, 'Nguyễn Phương', 'nguyenphuongnam.intern@gmail.com', '0337412617', 'Thanh Mỹ - Sơn Tây - Hà Nội', 20000, '0', '2024-08-02 18:20:06', 2, '172262280681931'),
(237, 1, 'Nguyễn Phương', 'nguyenphuongnam.intern@gmail.com', '0337412617', 'Thanh Mỹ - Sơn Tây - Hà Nội', 85000, '3', '2024-08-02 18:22:43', 2, '172262296310084'),
(238, 1, 'Nguyễn Phương', 'nguyenphuongnam.intern@gmail.com', '0337412617', 'Thanh Mỹ - Sơn Tây - Hà Nội', 75000, '0', '2024-08-02 18:31:28', 1, '172262348866432'),
(239, 1, 'Nguyễn Phương', 'nguyenphuongnam.intern@gmail.com', '0337412617', 'Thanh Mỹ - Sơn Tây - Hà Nội', 45000, '0', '2024-08-02 18:40:26', 2, '172262402654771'),
(240, 1, 'Nguyễn Phương', 'nguyenphuongnam.intern@gmail.com', '0337412617', 'Thanh Mỹ - Sơn Tây - Hà Nội', 25000, '3', '2024-08-02 18:40:37', 2, '172262403784219'),
(241, 1, 'Nguyễn Phương', 'nguyenphuongnam.intern@gmail.com', '0337412617', 'Thanh Mỹ - Sơn Tây - Hà Nội', 70000, '3', '2024-08-02 18:44:10', 2, '172262425045843'),
(243, 1, 'Nguyễn Phương', 'nguyenphuongnam.intern@gmail.com', '0337412617', 'Thanh Mỹ - Sơn Tây - Hà Nội', 2500000, '3', '2024-08-02 20:30:57', 2, '172263065724330'),
(244, 1, 'Nguyễn Phương', 'nguyenphuongnam.intern@gmail.com', '0337412617', 'Thanh Mỹ - Sơn Tây - Hà Nội', 45000, '0', '2024-08-02 20:31:34', 2, '172263069436380'),
(245, 1, 'Nguyễn Phương', 'nguyenphuongnam.intern@gmail.com', '0337412617', 'Thanh Mỹ - Sơn Tây - Hà Nội', 4520000, '3', '2024-08-02 20:32:09', 2, '172263072918788'),
(246, 1, 'Nguyễn Phương', 'nguyenphuongnam@gmail.com', '0337412617', 'Thanh Mỹ - Sơn Tây - Hà Nội', 20000, '6', '2024-08-03 07:56:26', 2, '172267178648068'),
(247, 1, 'Nguyễn Phương', 'nguyenphuongnam.intern@gmail.com', '0337412617', 'Thanh Mỹ - Sơn Tây - Hà Nội', 20000, '2', '2024-08-03 08:09:35', 2, '172267257511518'),
(249, 1, 'Nguyễn Phương', 'nguyenphuongnam.intern@gmail.com', '0337412617', 'Thanh Mỹ - Sơn Tây - Hà Nội', 20000, '1', '2024-08-03 08:33:08', 1, '172267398853939'),
(250, 1, 'Nguyễn Phương', 'nguyenphuongnam@gmail.com', '0337412617', 'Thanh Mỹ', 45000, '0', '2024-08-03 08:33:29', 2, '172267400947792'),
(251, 13, 'Nguyễn Phương Nam', 'namnpph32407@fpt.edu.vn', '0337412617', '123Thanh Mỹ - Sơn Tây - Hà Nội', 150000, '5', '2024-08-06 07:39:36', 1, '172292997658307'),
(252, 13, 'Nguyễn Phương Nam', 'namnpph32407@fpt.edu.vn', '0337412617', '123Thanh Mỹ - Sơn Tây - Hà Nội', 25000, '1', '2024-08-06 08:25:49', 1, '172293274993992');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `bill_item`
--

CREATE TABLE `bill_item` (
  `bill_item_id` int NOT NULL,
  `bill_id` int NOT NULL,
  `product_id` int DEFAULT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_avatar` varchar(255) NOT NULL,
  `product_sale_price` decimal(15,0) NOT NULL COMMENT 'giá bán sản phẩm',
  `quantity` int NOT NULL COMMENT 'Số lượng'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Đang đổ dữ liệu cho bảng `bill_item`
--

INSERT INTO `bill_item` (`bill_item_id`, `bill_id`, `product_id`, `product_name`, `product_avatar`, `product_sale_price`, `quantity`) VALUES
(20, 232, 31, 'Khoai Lang Kén', '4.jpg', 20000, 1),
(21, 233, 31, 'Khoai Lang Kén', '4.jpg', 20000, 1),
(22, 233, 30, 'Nem Chua Rán', '3.jpg', 25000, 1),
(23, 234, 30, 'Nem Chua Rán', '3.jpg', 25000, 1),
(24, 235, 31, 'Khoai Lang Kén', '4.jpg', 20000, 1),
(25, 236, 31, 'Khoai Lang Kén', '4.jpg', 20000, 1),
(26, 237, 30, 'Nem Chua Rán', '3.jpg', 25000, 1),
(27, 237, 29, 'Chân Gà Xả Tắc', '2.jpg', 20000, 3),
(28, 238, 30, 'Nem Chua Rán', '3.jpg', 25000, 3),
(29, 239, 31, 'Khoai Lang Kén', '4.jpg', 20000, 1),
(30, 239, 30, 'Nem Chua Rán', '3.jpg', 25000, 1),
(31, 240, 30, 'Nem Chua Rán', '3.jpg', 25000, 1),
(32, 241, 30, 'Nem Chua Rán', '3.jpg', 25000, 1),
(33, 241, 26, 'Gà Rán', 'ga-ran-nha-trang-banner.jpg', 45000, 1),
(34, 243, 30, 'Nem Chua Rán', '3.jpg', 25000, 100),
(35, 244, 26, 'Gà Rán', 'ga-ran-nha-trang-banner.jpg', 45000, 1),
(36, 245, 29, 'Chân Gà Xả Tắc', '2.jpg', 20000, 1),
(37, 245, 26, 'Gà Rán', 'ga-ran-nha-trang-banner.jpg', 45000, 100),
(38, 246, 31, 'Khoai Lang Kén', '4.jpg', 20000, 1),
(39, 247, 31, 'Khoai Lang Kén', '4.jpg', 20000, 1),
(40, 249, 31, 'Khoai Lang Kén', '4.jpg', 20000, 1),
(41, 250, 31, 'Khoai Lang Kén', '4.jpg', 20000, 1),
(42, 250, 30, 'Nem Chua Rán', '3.jpg', 25000, 1),
(43, 251, 30, 'Nem Chua Rán', '3.jpg', 25000, 2),
(44, 251, 29, 'Chân Gà Xả Tắc', '2.jpg', 20000, 5),
(45, 252, 30, 'Nem Chua Rán', '3.jpg', 25000, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cart`
--

CREATE TABLE `cart` (
  `cart_id` int NOT NULL,
  `user_id` int NOT NULL,
  `product_id` int NOT NULL,
  `quantity` int NOT NULL COMMENT 'Số lượng',
  `bill_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Đang đổ dữ liệu cho bảng `cart`
--

INSERT INTO `cart` (`cart_id`, `user_id`, `product_id`, `quantity`, `bill_id`) VALUES
(198, 1, 31, 1, 232),
(199, 1, 31, 1, 233),
(200, 1, 30, 1, 233),
(201, 1, 30, 1, 234),
(202, 1, 31, 1, 235),
(203, 1, 31, 1, 236),
(204, 1, 30, 1, 237),
(205, 1, 29, 3, 237),
(206, 1, 30, 3, 238),
(207, 1, 31, 1, 239),
(208, 1, 30, 1, 239),
(209, 1, 30, 1, 240),
(210, 1, 30, 1, 241),
(211, 1, 26, 1, 241),
(212, 1, 30, 100, 243),
(213, 1, 26, 1, 244),
(214, 1, 29, 1, 245),
(215, 1, 26, 100, 245),
(216, 1, 31, 1, 246),
(217, 1, 31, 1, 247),
(218, 1, 31, 1, 249),
(219, 1, 31, 1, 250),
(220, 1, 30, 1, 250),
(221, 13, 30, 2, 251),
(222, 13, 29, 5, 251),
(223, 13, 30, 1, 252);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `category`
--

CREATE TABLE `category` (
  `category_id` int NOT NULL,
  `category_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Đang đổ dữ liệu cho bảng `category`
--

INSERT INTO `category` (`category_id`, `category_name`) VALUES
(2, 'Cơm trưa'),
(13, 'Đồ ăn nhanh'),
(14, 'Đồ uống'),
(15, 'Tráng miệng');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `comment`
--

CREATE TABLE `comment` (
  `comment_id` int NOT NULL,
  `text` text NOT NULL,
  `u_id` int NOT NULL,
  `pro_id` int NOT NULL,
  `date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product`
--

CREATE TABLE `product` (
  `product_id` int NOT NULL COMMENT 'ID sản phẩm',
  `product_name` varchar(255) NOT NULL COMMENT 'tên sản phẩm',
  `product_description` text COMMENT 'Mô tả Sản phẩm',
  `product_avatar_url` varchar(255) NOT NULL COMMENT 'ảnh sản phẩm_url',
  `product_import_price` decimal(15,0) NOT NULL COMMENT 'giá nhập sản phẩm',
  `product_sale_price` decimal(15,0) NOT NULL COMMENT 'giá bán sản phẩm',
  `product_listed_price` decimal(15,0) NOT NULL COMMENT 'giá niêm yết sản phẩm',
  `product_stock` int NOT NULL COMMENT 'kho sản phẩm',
  `category_id` int DEFAULT NULL COMMENT 'Thể loại ID category'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Đang đổ dữ liệu cho bảng `product`
--

INSERT INTO `product` (`product_id`, `product_name`, `product_description`, `product_avatar_url`, `product_import_price`, `product_sale_price`, `product_listed_price`, `product_stock`, `category_id`) VALUES
(6, 'Cơm rang cà chua', 'Nguyên liệu gồm :\r\n1 tô cơm ( tô canh)\r\n100gr lạp xưởng\r\n6 quả trứng gà\r\n200gr đậu que\r\nCà rốt, tỏi\r\nGia vị: Nước mắm, nước tương, bột ngọt, tiêu', 'com_rang_ca_chua.png', 30, 30000, 30, 999999, 2),
(7, 'Cơm trưa đầy đủ', 'Nguyên liệu gồm :\r\n 1 tô cơm ( tô canh) 200gr thịt bò 3 quả trứng gà 100gr rau cải Cà rốt, tỏi Gia vị: Nước mắm, nước tương, bột ngọt, tiêu', 'Com_trua_day-du.jpg', 35, 35000, 35, 999999, 2),
(8, 'Cơm gà rán', 'Nguyên liệu gồm: \r\nGạo 250 gr\r\n(1 lon)\r\n Đùi gà 1 cái\r\n(350gr)\r\n Hành tây 1/2 củ\r\n Dầu ăn 50 ml\r\n Bột nghệ 1.5 muỗng cà phê\r\n Muối/ Hạt nêm 1 ít', 'com_trua_ga_ran.jpg', 25, 25000, 23, 9999999, 2),
(9, 'Cơm gà cải xoăn', 'Nguyên liệu gồm:\r\n1/2 miếng thịt ức gà không lấy da, xắt sợi cỡ ngón tay\r\n4 lá cải xoăn tước bỏ cọng, xé miếng\r\n3 quả trứng gà\r\n3 chén cơm\r\nGia vị: dầu olive, hạt nêm, nước mắm, bột ngọt, đường, tiêu, ớt', 'com_trung_cai_xoan.png', 30, 30000, 30, 999999999, 2),
(10, 'Cơm gà sốt cà ri cải Kale', 'Thành phần gồm:\r\n1/2 miếng thịt ức gà không lấy da, xắt sợi cỡ ngón tay\r\n4 lá cải Kale tước bỏ cọng, xé miếng\r\n3 quả trứng gà\r\n3 chén cơm\r\n4 muỗng canh sốt cà ri\r\nGia vị: dầu olive, hạt nêm, nước mắm, bột ngọt, đường, tiêu, ớt', 'cơm-ga-sốt-ca-ri-với-cải-kale-recipe-step-7-photo.webp', 30, 30000, 30, 100000000, 2),
(11, 'Bánh bofcowm nguội', 'Nguyên liệu gồm:\r\n90gr cơm nguội\r\n180gr bột gạo\r\n120ml nước dừa tươi\r\n40ml nước cốt dừa\r\n20ml nước ấm\r\n70gr đường\r\n2gr men', 'banh_bo_com_nguoi_doc_dao_moi.jpg', 20, 20000, 20, 99999999, 2),
(12, 'bánh rán từ cơm nguội', 'Nguyên liệu:\r\n1 chén cơm nguội\r\n30g thịt bằm chay\r\nHành tím, ớt, mè trắng rang\r\nGia vị: Đường, hạt nêm chay, tương ớt, dầu ăn, nước mắm chay', 'banh_gao_com_nguoi_voi_me_den.jpg', 20, 20000, 20, 9999999, 2),
(13, 'Cơm chiên tôm xúc xích', 'Nguyên liệu gồm: \r\nCơm nguội để tủ lạnh qua đêm\r\nTrứng gà\r\nTỏi xay\r\nSpam\r\nTôm lột vỏ\r\nMăng tây\r\nHành lá\r\nDầu hào\r\nNước tương\r\nGia vị (đường, tiêu, hạt nêm)', 'cơm-chien-cho-bữa-trưa-nhanh-gọn-recipe-main-photo.webp', 25, 25000, 23, 100000000, 2),
(14, 'Cơm rang dưa bò', 'Nguyên liệu gồm:\r\n300 gram thịt bò\r\n1-2 quả cà chua\r\n1 bát dưa cải chua\r\n2-3 bát cơm nguội\r\n2 quả trứng\r\n1 mẩu cà rốt\r\n4 củ hành khô to\r\n1 củ tỏi\r\n1 thìa dầu hào\r\n2 thìa mắm ngon\r\n1 thìa bột nêm\r\n1 nhúm tiêu xay\r\n1 bát con dầu ăn', 'cơm-rang-dưa-bo-cơm-trưa-vp-recipe-main-photo.webp', 30, 30000, 30, 9999999, 2),
(15, 'Cơm chiên hạt điều', 'Nguyên liệu gồm: \r\n1 tô cơm nguội\r\n1 nắm hạt điều vụn hoặc vỡ đôi\r\n10 cái nấm bào ngư (nấm sò)\r\n1 cây cải kale\r\nĐậu hũ Nhật (không bắt buộc)\r\nHạt nêm chay', 'cơm-chien-hạt-diều-recipe-main-photo.webp', 25, 25000, 25, 100000000, 2),
(16, 'Cơm cá lóc cải xoăn', 'Nguyên liệu gồm:\r\nRau cải xoăn\r\nCá lóc thái bỏ xương\r\nHành tím băm nhuyễn', 'cơm-ca-loc-cải-xoan-recipe-main-photo.webp', 25, 25000, 24, 999999, 2),
(17, 'Cơm Tấm Chay', 'Nguyên liệu gồm:\r\nTấm\r\n500 gr tấm thơm\r\n5 gr dầu ăn\r\n420 gr nước\r\nNước mắm cơm tấm\r\n150 gr nước mắm chay\r\n283 gr đường\r\n8.3 gr muối\r\n150 gr nước lọc\r\nĐồ chua\r\n30 gr cà rốt\r\n150 gr củ cải trắng\r\n40 gr đường\r\n3 gr muối\r\n15 gr giấm\r\nDưa rau muống\r\n300 gr rau muống\r\n30 gr tỏi\r\n10 gr ớt\r\n30 gr hành tím\r\n50 gr đường\r\n30 gr giấm\r\n60 gr nước lọc\r\nBì chay\r\n2 vắt miến\r\n15 gr thính\r\n40 gr đậu hủ chiên\r\n10 gr hủ ki chiên\r\n5 gr tỏi phi\r\n2 gr muối\r\n5 gr đường\r\n1 gr bột ngọt\r\n5 gr hạt nêm\r\nChả chay\r\n1 hộp đậu hủ non\r\n50 gr đậu gà\r\n60 gr bánh mì\r\n60 gr sữa đậu nành\r\n150 gr thịt xay chay\r\n30 gr nấm mèo\r\n20 gr hành lá\r\n20 gr hành tím\r\n20 gr tỏi\r\n30 gr dầu ăn\r\n8 gr hạt nêm\r\n3 gr bột ngọt\r\n3 gr dầu mè\r\n5 gr dầu điều', 'cơm-tấm-chay-recipe-main-photo.webp', 30, 30000, 30, 100000000, 2),
(18, 'Cơm chiên xanh', 'Nguyên liệu gồm:\r\nCồi sò điệp\r\nTôm (em thay bằng càng ghẹ)\r\nBắp ngọt, đậu ve, ớt chuông, cà rốt\r\nBột cải kale', 'cơm-chien-xanh-recipe-main-photo.webp', 30, 30000, 30, 100000000, 2),
(19, 'Cơm chiên Hải sản xanh', 'Nguyên liệu gồm:\r\n 30p\r\n Em bé/người lớn\r\nCơm nấu chín để nguội\r\n1 con mực\r\n1-2 con tôm sơ chế sạch\r\nRau cải kale hoặc bó xôi\r\n1 mẩu nhỏ Carrot\r\nHành, tỏi\r\nBột hành\r\nGia vị (hạt nêm/tương)\r\nDầu ăn', 'cơm-chien-hải-sản-xanh-recipe-main-photo.webp', 30, 30000, 30, 100000000, 2),
(20, 'Cơm rang keto', 'Nguyên liệu gồm: \r\nSúp lơ trắng. Cà rốt. Lá hẹ hoặc hành. Hành tây.\r\n1 ít Giò chả hoặc xúc xích (giò chả xúc xích tất cả đều mình tự làm mình mới ăn chứ ko mua ngoài. Ai ko tự làm dc thì nên ăn ít đồ mua sẵn thôi ạ,)\r\nMắm muối tiêu', 'cơm-rang-keto-danh-cho-những-bạn-dang-giảm-can-như-tớ-recipe-main-photo.webp', 25, 25000, 25, 100000000, 2),
(21, 'Cơm gà nướng mật ong ', 'Nguyên Liệu\r\n1 con gà tầm 1 kg rưỡi\r\nCơm trắng hoặc chiên\r\nKetchup, mật ong,dầu hào, muối,xì dầu,bột nêm\r\nĐồ chua cà rốt làm chua ngọt hoặc dưa leo,cà chua,xà lách\r\n3 củ hành tím', 'cơm-ga-nướng-mật-ong-recipe-main-photo.webp', 35, 35000, 35, 99999999, 2),
(22, 'Cơm gạo chiên hạt sen', 'Nguyên Liệu\r\n 40 phút\r\n 1 phần ăn\r\nCơm gạo lứt hạt sen rau củ\r\n25 g gạo lứt đồ Simply\r\n25 g hạt sen\r\n25 g cà rốt thái sợi\r\n25 g bắp vàng tách hạt\r\nỨc gà xào cải thìa và nấm đông cô\r\n75 g ức gà\r\n15 g nấm hương khô\r\n50 g cải thìa\r\nGia vị: dầu hào, hạt nêm', 'com_ga_gao.jpg', 30, 30000, 30, 9999999, 2),
(24, 'Khoai Tây Chiên', 'Ngon, giòn', 'khoaitay.jpg', 45, 35000, 35, 100000000, 13),
(25, 'Burger', 'ngon, béo', 'burger.jpg', 50, 35000, 35, 100000000, 13),
(26, 'Gà Rán', 'gà rán trong mềm ngoài ròn trẻ em rất thích', 'ga-ran-nha-trang-banner.jpg', 60, 45000, 45, 100000000, 13),
(27, 'Pizza', 'Pizza chuẩn của Ý', 'pizza.jpg', 70, 50000, 60, 100000000, 13),
(28, 'Gà Xốt Cay', 'Gà được rán trong dầu ở nhiệt độ cao rồi sau đó được tẩm sốt cay', '1.jpg', 30, 50000, 40, 100000000, 13),
(29, 'Chân Gà Xả Tắc', 'Chân gà xốt Thái là món ăn vặt được nhiều người yêu thích nhờ vị chua, cay kích thích vị giác. Cách làm chân gà xốt Thái rất đơn giản, bạn chỉ cần có một vài bí quyết nhỏ là đã có thể hoàn chỉnh hương vị cho món ăn này. Bài viết dưới đây sẽ chia sẻ đến bạn tuyệt chiêu làm xiêu lòng người dùng với món chân gà xốt Thái.\r\n Để có được món ăn ngon, việc đầu tiên bạn cần làm là phải chọn được nguyên liệu tươi. Đối với món chân gà xốt Thái, nguyên liệu tươi ngon rất quan trọng quyết định phần lớn hương vị và chất lượng. Dưới đây sẽ là một số mẹo để giúp bạn chọn được chân gà tươi ngon.', '2.jpg', 15, 20000, 30, 100000000, 13),
(30, 'Nem Chua Rán', 'Vào những buổi xế chiều, rất dễ để bắt gặp hình ảnh những bạn trẻ Hà Nội tụm năm tụm ba ở những quán cóc. Chỉ với một đĩa nem chua rán và vài cốc trà chanh, các bạn có thể ngồi hàng giờ bên nhau, chia sẻ hay “chém gió” về những dự định trong công việc và cuộc sống.\r\n\r\nNếu không muốn la cà nơi quán xá mà vẫn có thể thưởng thức món ăn thơm ngon này thì hãy lập team, rủ hội chị em bạn gì qua cùng thực hiện món nem chua rán. Chỉ cần bỏ ra một ít thời gian và công sức, bạn đã có ngay “mồi nhậu” hấp dẫn rồi! Tham khảo và thực hiện ngay nhé!', '3.jpg', 15, 25000, 25, 100000000, 13),
(31, 'Khoai Lang Kén', 'Trong thế giới ẩm thực đa dạng, khoai lang kén là một trong những món ăn vặt được ưa chuộng nhất bởi hương vị thơm ngon và màu sắc hấp dẫn. Hãy theo dõi hướng dẫn trong bài viết này để học cách làm khoai lang kén đơn giản mà ngon miệng nhé! Với hướng dẫn các công thức đa dạng mà Tiki Blog chia sẻ dưới đây, bạn sẽ có thể bắt tay ngay vào chế biến món khoai lang kén theo khẩu vị yêu thích!', '4.jpg', 10, 20000, 30, 100000000, 13);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `user_id` int NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `phone_number` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `full_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `avatar_url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL COMMENT 'ảnh user',
  `role` tinyint NOT NULL DEFAULT '0' COMMENT 'vai trò của người dùng',
  `token` varchar(100) DEFAULT NULL,
  `status` enum('Inactive','Active') DEFAULT 'Inactive'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`user_id`, `email`, `password`, `phone_number`, `address`, `full_name`, `avatar_url`, `role`, `token`, `status`) VALUES
(1, 'nguyenphuongnam.intern@gmail.com', '12345', '0337412617', 'Thanh Mỹ - Sơn Tây - Hà Nội', 'Nguyễn Phương', 'Screenshot 2024-07-11 165115.png', 1, NULL, 'Active'),
(13, 'namnpph32407@fpt.edu.vn', 'Nam123', '0337412617', '123Thanh Mỹ - Sơn Tây - Hà Nội', 'Nguyễn Phương Nam', 'Screenshot 2024-07-28 153623.png', 0, '', 'Active'),
(14, 'npnam17012004@gmail.com', 'Nam123', '0337412617', '123\r\nThanh Mỹ - Sơn Tây - Hà Nội', 'Nguyễn Phương Nam', 'Screenshot 2024-07-28 153623.png', 0, '', 'Active');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `bill`
--
ALTER TABLE `bill`
  ADD PRIMARY KEY (`bill_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Chỉ mục cho bảng `bill_item`
--
ALTER TABLE `bill_item`
  ADD PRIMARY KEY (`bill_item_id`),
  ADD KEY `bill_id` (`bill_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Chỉ mục cho bảng `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `bill_id` (`bill_id`);

--
-- Chỉ mục cho bảng `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Chỉ mục cho bảng `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`comment_id`),
  ADD KEY `user_lk` (`u_id`),
  ADD KEY `pro_lk` (`pro_id`);

--
-- Chỉ mục cho bảng `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `bill`
--
ALTER TABLE `bill`
  MODIFY `bill_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=253;

--
-- AUTO_INCREMENT cho bảng `bill_item`
--
ALTER TABLE `bill_item`
  MODIFY `bill_item_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT cho bảng `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=224;

--
-- AUTO_INCREMENT cho bảng `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT cho bảng `comment`
--
ALTER TABLE `comment`
  MODIFY `comment_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int NOT NULL AUTO_INCREMENT COMMENT 'ID sản phẩm', AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `bill`
--
ALTER TABLE `bill`
  ADD CONSTRAINT `bill_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `bill_item`
--
ALTER TABLE `bill_item`
  ADD CONSTRAINT `bill_item_ibfk_1` FOREIGN KEY (`bill_id`) REFERENCES `bill` (`bill_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `bill_item_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cart_ibfk_3` FOREIGN KEY (`bill_id`) REFERENCES `bill` (`bill_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Các ràng buộc cho bảng `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `pro_lk` FOREIGN KEY (`pro_id`) REFERENCES `product` (`product_id`),
  ADD CONSTRAINT `user_lk` FOREIGN KEY (`u_id`) REFERENCES `users` (`user_id`);

--
-- Các ràng buộc cho bảng `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category` (`category_id`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
