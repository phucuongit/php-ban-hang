-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Máy chủ: mydb
-- Thời gian đã tạo: Th10 02, 2020 lúc 09:07 AM
-- Phiên bản máy phục vụ: 8.0.21
-- Phiên bản PHP: 7.4.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `banhang`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `category`
--

CREATE TABLE `category` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Đang đổ dữ liệu cho bảng `category`
--

INSERT INTO `category` (`id`, `name`, `description`, `slug`, `is_deleted`) VALUES
(1, 'cate1 update2', 'day la cate12', 'day-la-cate', 1),
(2, 'cate2', 'danh sach cate2', 'day-la-cate-2', 1),
(3, 'asda', 'ádasd', 'asda', 1),
(4, 'tester', '1231312', 'tester', 1),
(5, 'Giày thể thao', 'Giày thể thao', 'giyththao', 0),
(6, 'Giày nam', 'Giày nam', 'giynam', 0),
(7, 'Giày nữ', 'Giày nữ', 'giyn', 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `order_item`
--

CREATE TABLE `order_item` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` int NOT NULL,
  `total` int NOT NULL,
  `is_deleted` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Đang đổ dữ liệu cho bảng `order_item`
--

INSERT INTO `order_item` (`id`, `user_id`, `created_at`, `status`, `total`, `is_deleted`) VALUES
(22, 1, '2020-09-19 16:36:54', 2, 100, 1),
(23, 1, '2020-09-20 03:27:57', 2, 0, 1),
(24, 1, '2020-09-20 03:30:55', 0, 0, 1),
(25, 1, '2020-09-20 03:32:20', 0, 0, 1),
(26, 1, '2020-09-20 03:32:48', 0, 0, 1),
(27, 1, '2020-09-20 04:16:42', 0, 0, 1),
(28, 1, '2020-09-26 08:55:19', 0, 0, 1),
(29, 1, '2020-09-28 07:48:11', 0, 332, 1),
(30, 1, '2020-09-28 07:48:36', 1, 332, 0),
(31, 1, '2020-09-28 12:35:57', 0, 986, 0),
(32, 1, '2020-09-28 12:38:39', 0, 1, 0),
(33, 4, '2020-09-28 14:10:22', 0, 10, 1),
(34, 4, '2020-09-28 14:11:55', 1, 10, 0),
(35, 17, '2020-09-29 05:05:10', 0, 21, 0),
(36, 1, '2020-10-01 08:56:17', 1, 444, 0),
(37, 1, '2020-10-01 09:40:44', 0, 10, 0),
(38, 21, '2020-10-01 14:10:18', 0, 485000, 0),
(39, 1, '2020-10-01 14:23:42', 2, 1175000, 0),
(40, 1, '2020-10-01 14:28:48', 2, 860000, 0),
(41, 1, '2020-10-01 17:00:20', 0, 235000, 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `order_prod`
--

CREATE TABLE `order_prod` (
  `id` int NOT NULL,
  `order_id` int NOT NULL,
  `product_id` int NOT NULL,
  `quality` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Đang đổ dữ liệu cho bảng `order_prod`
--

INSERT INTO `order_prod` (`id`, `order_id`, `product_id`, `quality`) VALUES
(14, 22, 1, 1),
(15, 23, 1, 8),
(16, 23, 2, 2),
(17, 24, 1, 5),
(18, 24, 2, 5),
(19, 25, 1, 8),
(20, 25, 2, 7),
(21, 26, 1, 0),
(22, 26, 2, 2),
(23, 27, 1, 4),
(24, 27, 2, 4),
(25, 28, 1, 1),
(26, 30, 1, 1),
(27, 30, 2, 1),
(28, 30, 3, 1),
(29, 31, 1, 2),
(30, 31, 2, 3),
(31, 31, 3, 3),
(32, 32, 42, 1),
(33, 33, 1, 1),
(34, 34, 1, 1),
(35, 35, 1, 2),
(36, 35, 42, 1),
(37, 36, 1, 1),
(38, 36, 2, 1),
(39, 36, 42, 1),
(40, 36, 3, 1),
(41, 36, 39, 1),
(42, 37, 1, 1),
(43, 38, 47, 1),
(44, 38, 46, 1),
(45, 39, 46, 5),
(46, 40, 47, 2),
(47, 40, 52, 2),
(48, 41, 46, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product`
--

CREATE TABLE `product` (
  `id` int NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `price` int NOT NULL,
  `category_id` int NOT NULL,
  `in_stock` int NOT NULL,
  `image_url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `short_des` varchar(100) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Đang đổ dữ liệu cho bảng `product`
--

INSERT INTO `product` (`id`, `title`, `description`, `price`, `category_id`, `in_stock`, `image_url`, `slug`, `short_des`, `is_deleted`, `created_at`) VALUES
(1, 'day la title', 'day la cate1', 10, 1, 10, '/assets/img/upload/1601388243.RecognitionBot.png', 'san-pham-1', 'day la short description', 1, '2020-10-01 17:02:18'),
(2, 'giuong', 'day la cate1', 100, 1, 1, '/assets/img/upload/1601388263.Screenshot from 2020-09-26 17-56-48.png', 'san-pham-2', 'day la short description 2', 1, '2020-10-01 17:02:18'),
(3, 'sfsdsdf', 'danh sach cate2', 222, 2, 2, '/assets/img/upload/1601388274.Screenshot from 2020-09-25 12-48-34.png', 'sfsdsdf', 'gvdf', 1, '2020-10-01 17:02:18'),
(37, 'san pham tester', 'dfsdf', 2123, 2, 2, NULL, 'sanphamtester', 'dsfdsf', 1, '2020-10-01 17:02:18'),
(38, 'sdfsdf', 'sdfvcxvc', 234, 2, 342434, 'assets/img/upload/1601137905.your-logo.png', 'sdfsdf', 'sdvsdv', 1, '2020-10-01 17:02:18'),
(39, 'sdfsdf', 'sdfsdf', 12, 2, 2323, 'assets/img/upload/1601137953.your-logo.png', 'sdfsdf', 'sdfsdf', 1, '2020-10-01 17:02:18'),
(40, 'dsfsdf', 'dfdfsdf', 234, 2, 322, 'assets/img/upload/1601138848.Toeic_Score_Conversion_Chart_TuanToeic.com_.jpg', 'dsfsdf', 'fdvfvdfv', 1, '2020-10-01 17:02:18'),
(41, 'sap2', 's3', 234, 2, 12, '/assets/img/upload/1601139086.Bot Adapter.png', 'sap2', 'dfsdf', 1, '2020-10-01 17:02:18'),
(42, 'hihi3rfdgfsdf', 'day la cate1', 100, 1, 32, '/assets/img/upload/1601387809.Northwind.png', 'cuonglesanpham', 'hihi', 1, '2020-10-01 17:02:18'),
(43, 'tesb sfsfsf', '12323', 12323123, 2, 123, '/assets/img/upload/1601374423.Toeic_Score_Conversion_Chart_TuanToeic.com_.jpg', 'tesbsfsfsf', 'dsdvsdv', 1, '2020-10-01 17:02:18'),
(44, 'hih', 'sfsdfs', 234234, 4, 1233, '/assets/img/upload/1601399872.Screenshot from 2020-09-25 12-48-34.png', 'hih', 'dsdvsd', 1, '2020-10-01 17:02:18'),
(45, 'dsdasd', 'ádasd', 1000, 7, 1212, '/assets/img/upload/1601547065.mwc.jpg', 'dsdasd', 'dvsdvsdv', 1, '2020-10-01 17:02:18'),
(46, 'Giày thể thao nữ MWC NUTT- 0443', 'Giày nữ', 235000, 7, 100, '/assets/img/upload/1601557384.mwc.jpg', 'giayththaonmwcnutt0443', ' CÙNG CUONGLE BẮT TREND ITEM SỤC THỂ THAO SIÊU HOT MỚI VỀ NHÉ !', 0, '2020-10-01 17:02:18'),
(47, 'Giày cao gót NUCG', 'Giày nữ', 250000, 7, 100, '/assets/img/upload/1601557560.mwc (1).jpg', 'giycaogtnucg', 'Cao gót quai trong tiếp tục về thêm mẫu mới cực hot !', 0, '2020-10-01 17:02:18'),
(48, 'Giày Thể Thao Nam NATT', ' Sành điệu với thiết kế basic trẻ trung, năng động\r\n 3 tone màu cực trend : Đen / Xanh Rêu / Xanh Biển', 250000, 6, 100, '/assets/img/upload/1601559653.mwc (2).jpg', 'giyththaonamnatt', ' Sành điệu với thiết kế basic trẻ trung, năng động', 0, '2020-10-01 17:02:18'),
(49, 'Giay cao got NUCG-3944', ' Mẫu Cao Gót mới về không chỉ &quot;ghi điểm&quot; ở chất liệu da cao cấp mà còn cực kì nổi bật với thiết kế xỏ ngón độc đáo :', 180000, 7, 100, '/assets/img/upload/1601559868.mwc (3).jpg', 'giaycaogotnucg3944', 'CAO GÓT XỎ NGÓN - HOT ITEM MÀ MỌI CÔ NÀNG KHÔNG THỂ BỎ SÓT ', 0, '2020-10-01 17:02:18'),
(50, 'Dép nữ MWC NUDE- 3377', 'Siêu phẩm dép quai ngang cực hot đã có tại MWC !', 99000, 7, 100, '/assets/img/upload/1601560033.giaynu.jpg', 'dpnmwcnude3377', 'Khả năng mix &amp; match siêu đỉnh : phối gì cũng đẹp, cũng cá tính hết nấc\r\n', 0, '2020-10-01 17:02:18'),
(51, 'Giày cao gót MWC NUCG-3944', 'CAO GÓT XỎ NGÓN - HOT ITEM MÀ MỌI CÔ NÀNG KHÔNG THỂ BỎ SÓT ! ', 180000, 7, 100, '/assets/img/upload/1601560427.thethaon.jpg', 'giycaogtmwcnucg3944', 'Gót nhọn 5cm thanh mảnh, tôn dáng ở mọi góc độ', 0, '2020-10-01 17:02:18'),
(52, 'Giày cao gót MWC NUCG-3944-3', 'CAO GÓT XỎ NGÓN - HOT ITEM MÀ MỌI CÔ NÀNG KHÔNG THỂ BỎ SÓT ! ', 180000, 7, 100, '/assets/img/upload/1601560302.thethao.jpg', 'giycaogtmwcnucg3944-3', 'Gót nhọn 5cm thanh mảnh, tôn dáng ở mọi góc độ', 0, '2020-10-01 17:02:18'),
(53, 'Test262626', 'Dhhdhdhdh', 10101010, 5, 10, '//assets/img/upload/1601571900.1601557666.mwc (2).jpg', 'test262626', 'Dbdbdbd', 0, '2020-10-01 17:02:18'),
(54, 'sam pham', 'banHang.sh', 123213, 7, 123, '/assets/img/upload/1601615272.Bot Adapter.jpg', 'sampham', 'banHang.sh', 0, '2020-10-02 05:07:52');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `user`
--

CREATE TABLE `user` (
  `id` int NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `is_admin` tinyint(1) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Đang đổ dữ liệu cho bảng `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `fullname`, `is_admin`, `is_deleted`) VALUES
(1, 'cuongle', '25d55ad283aa400af464c76d713c07ad', 'cuong dep trai', 1, 0),
(2, 'admin', '202cb962ac59075b964b07152d234b70', 'Họ tên', 0, 1),
(3, 'admin1', '8b18ab890a7f379ee3d1055e2fde9a1e', 'cuong dep trai', 0, 1),
(4, 'testabc', 'ca2b67db58c83f0e184663098bcb74b8', 'Test admin', 0, 1),
(5, '121', '121212', 'sdfsdf', 1, 1),
(6, 'username', '14c4b06b824ec593239362517f538b29', 'hho gten', 1, 1),
(7, 'hfvhjvjv', 'b498481a20e60b1c6402cf0d9eb75cf1', 'bbhjbhj', 0, 1),
(8, 'fsdfs', '4135a6f12bd7b1007140f6c4deec37dc', 'hihi', 0, 1),
(9, 'dfsfsddsfss', 'a5a7158118e59ee590424b55bb9aed17', 'sdfdfs', 0, 1),
(10, 'dsfdf', '202cb962ac59075b964b07152d234b70', 'sdsd', 0, 1),
(11, 'sđ', '202cb962ac59075b964b07152d234b70', 'dsfs', 0, 1),
(12, 'sdfs', 'test', 'test full name', 1, 1),
(13, 'vbfbcv', '202cb962ac59075b964b07152d234b70', 'dsvdv', 0, 1),
(14, 'sád', '202cb962ac59075b964b07152d234b70', 'ád', 0, 1),
(15, 'fgfhnfb', '202cb962ac59075b964b07152d234b70', 'ád', 0, 1),
(16, 'sfdsdf', '202cb962ac59075b964b07152d234b70', 'fvfdv', 0, 1),
(17, 'fe', '202cb962ac59075b964b07152d234b70', '234', 0, 1),
(18, 'hihi1234', 'c51935ff17f1881f0d5ae99c1ab0cec2', 'cuongle123', 1, 1),
(19, '45345cuongle', '38a9af11f6c74980584bd922a37dae8e', 'test doi ten1231', 0, 1),
(20, '1234', '25d55ad283aa400af464c76d713c07ad', 'cuong dep tai', 0, 1),
(21, 'andevct96', '18cae0987af13aa44e5afe968cdd02dd', 'Cao Tú An', 0, 0);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `order_item`
--
ALTER TABLE `order_item`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `order_prod`
--
ALTER TABLE `order_prod`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `category`
--
ALTER TABLE `category`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT cho bảng `order_item`
--
ALTER TABLE `order_item`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT cho bảng `order_prod`
--
ALTER TABLE `order_prod`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT cho bảng `product`
--
ALTER TABLE `product`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT cho bảng `user`
--
ALTER TABLE `user`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
