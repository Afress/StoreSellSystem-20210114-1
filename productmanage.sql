-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 2021-01-13 11:37:21
-- 伺服器版本： 10.4.17-MariaDB
-- PHP 版本： 8.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `productmanage`
--

-- --------------------------------------------------------

--
-- 資料表結構 `factory`
--

CREATE TABLE `factory` (
  `factory_name` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `factory_phone` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `factory`
--

INSERT INTO `factory` (`factory_name`, `factory_phone`) VALUES
('綿羊手機配件大批發', '\"062113689'),
('港季手機配件大批發', '\"062223689'),
('品樺手機配件大批發', '\"062545689'),
('光明手機配件大批發', '\"062556389'),
('東安手機配件大批發', '\"062562009'),
('美好手機配件大批發', '\"062563689'),
('小南手機配件大批發', '\"062565623'),
('成功手機配件大批發', '\"062869689'),
('柏堯手機配件大批發', '\"064523689'),
('品安手機配件大批發', '062563689');

-- --------------------------------------------------------

--
-- 資料表結構 `factory_detail`
--

CREATE TABLE `factory_detail` (
  `factory_phone` char(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `factory_person` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `factory_detail`
--

INSERT INTO `factory_detail` (`factory_phone`, `factory_person`) VALUES
('\"062113689', '李威'),
('\"062223689', '黃博德'),
('\"062545689', '王寰天'),
('\"062556389', '陳淑貞'),
('\"062562009', '陳品憲'),
('\"062563111', '黃娜那'),
('\"062563689', '黃文恩'),
('\"062565623', '陳棋月'),
('\"062869689', '蔡異方'),
('\"064523689', '李月善'),
('062563689', '黃志焜');

-- --------------------------------------------------------

--
-- 資料表結構 `sale_record`
--

CREATE TABLE `sale_record` (
  `sale_recordNum` char(6) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sale_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `sale_record`
--

INSERT INTO `sale_record` (`sale_recordNum`, `sale_date`) VALUES
('000001', '2019-07-20'),
('000002', '2021-01-08'),
('000003', '2021-01-09'),
('000004', '2021-01-10'),
('000005', '2021-01-11'),
('000006', '2021-01-12'),
('000007', '2021-01-12'),
('000008', '2021-01-13'),
('000009', '2021-01-14'),
('000010', '2021-01-14'),
('000011', '2021-01-22'),
('000012', '2021-01-23');

-- --------------------------------------------------------

--
-- 資料表結構 `sell_detail`
--

CREATE TABLE `sell_detail` (
  `item_barcode` char(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sale_recordNum` char(6) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `sell_detail`
--

INSERT INTO `sell_detail` (`item_barcode`, `sale_recordNum`) VALUES
('1 472541 502345', '000009'),
('1 472541 502345', '000011'),
('1 472541 502345', '000012'),
('1 532046 822201', '000008'),
('1 547893 256987', '000003'),
('1 569743 200011', '000005'),
('1 569743 205698', '000004'),
('1 569874 326501', '000002'),
('4 719865 605454', '000001'),
('5 698743 560082', '000007'),
('6 549118 569856', '000006'),
('7 589630 155544', '000010');

-- --------------------------------------------------------

--
-- 資料表結構 `sell_item`
--

CREATE TABLE `sell_item` (
  `item_barcode` char(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `item_num` int(5) UNSIGNED NOT NULL,
  `item_price` int(6) NOT NULL,
  `item_state` tinyint(1) NOT NULL,
  `item_name` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `item_brand` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `item_type` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `item_selling` char(15) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `sell_item`
--

INSERT INTO `sell_item` (`item_barcode`, `item_num`, `item_price`, `item_state`, `item_name`, `item_brand`, `item_type`, `item_selling`) VALUES
('1 472541 502345', 99, 199, 0, '充電線', 'Apple', 'iphoneXS', '1 472541 502345'),
('1 532046 822201', 140, 138, 0, '耳機', 'gsshop', '防汗耳機', '1 532046 822201'),
('1 547893 256987', 90, 299, 0, '行動電源', 'redmi', '10000mah', '1 547893 256987'),
('1 569743 200011', 89, 299, 0, '充電器', 'hero', '65W', '1 569743 200011'),
('1 569743 205698', 150, 499, 0, '充電座', 'gsshop', '木頭充電底座', '1 569743 205698'),
('1 569874 326501', 100, 299, 0, '充電器', 'sony', 'type_c', '1 569874 326501'),
('4 719865 605454', 50, 100, 1, '9H3D曲面螢幕玻璃保護貼玻璃膜', 'Apple', 'iPhone 11 Pro Max', '4 719865 605454'),
('5 698743 560082', 50, 1890, 0, '耳機', '小米', '藍芽耳機', '5 698743 560082'),
('6 549118 569856', 100, 199, 0, '自拍棒', '雲騰', 'VCT_808', '6 549118 569856'),
('7 589630 155544', 50, 190, 0, '支架', 'gsshop', '腳踏車支架', '7 589630 155544');

-- --------------------------------------------------------

--
-- 資料表結構 `supply_index`
--

CREATE TABLE `supply_index` (
  `purchase_code` char(6) COLLATE utf8mb4_unicode_ci NOT NULL,
  `item_barcode` char(15) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `supply_index`
--

INSERT INTO `supply_index` (`purchase_code`, `item_barcode`) VALUES
('000001', '4 719865 605454'),
('000002', '1 569874 326501'),
('000003', '1 547893 256987'),
('000004', '1 569743 205698'),
('000005', '1 569743 200011'),
('000006', '6 549118 569856'),
('000007', '5 698743 560082'),
('000008', '1 532046 822201'),
('000009', '1 472541 502345'),
('000010', '7 589630 155544'),
('000011', '1 472541 502345');

-- --------------------------------------------------------

--
-- 資料表結構 `supply_order`
--

CREATE TABLE `supply_order` (
  `purchase_code` char(6) COLLATE utf8mb4_unicode_ci NOT NULL,
  `purchase_num` int(5) UNSIGNED NOT NULL,
  `purchase_price` int(6) NOT NULL,
  `purchase_date` date NOT NULL,
  `purchase_state` int(1) NOT NULL,
  `purchase_checkID` char(6) COLLATE utf8mb4_unicode_ci NOT NULL,
  `factory_name` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `supply_order`
--

INSERT INTO `supply_order` (`purchase_code`, `purchase_num`, `purchase_price`, `purchase_date`, `purchase_state`, `purchase_checkID`, `factory_name`) VALUES
('000001', 150, 50, '2017-07-26', 2, '000001', '品安手機配件大批發'),
('000002', 6, 299, '2021-01-08', 1, '000002', '小南手機配件大批發'),
('000003', 7, 499, '2021-01-09', 1, '000003', '美好手機配件大批發'),
('000004', 8, 299, '2021-01-10', 1, '000004', '品樺手機配件大批發'),
('000005', 9, 199, '2021-01-11', 1, '000005', '柏堯手機配件大批發'),
('000006', 10, 1890, '2021-01-12', 1, '000006', '成功手機配件大批發'),
('000007', 11, 138, '2021-01-13', 1, '000007', '東安手機配件大批發'),
('000008', 12, 199, '2021-01-14', 1, '000008', '光明手機配件大批發'),
('000009', 13, 235, '2021-01-15', 1, '000009', '綿羊手機配件大批發'),
('000010', 14, 190, '2021-01-16', 1, '000010', '港季手機配件大批發'),
('000011', 55, 50, '2021-01-11', 1, '000011', '光明手機配件大批發');

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `factory`
--
ALTER TABLE `factory`
  ADD PRIMARY KEY (`factory_name`),
  ADD KEY `factory_foreign_1` (`factory_phone`);

--
-- 資料表索引 `factory_detail`
--
ALTER TABLE `factory_detail`
  ADD PRIMARY KEY (`factory_phone`);

--
-- 資料表索引 `sale_record`
--
ALTER TABLE `sale_record`
  ADD PRIMARY KEY (`sale_recordNum`);

--
-- 資料表索引 `sell_detail`
--
ALTER TABLE `sell_detail`
  ADD PRIMARY KEY (`item_barcode`,`sale_recordNum`),
  ADD KEY `sell_detail_foreign_2` (`sale_recordNum`);

--
-- 資料表索引 `sell_item`
--
ALTER TABLE `sell_item`
  ADD PRIMARY KEY (`item_barcode`),
  ADD KEY `sell_item_foreign_1` (`item_selling`);

--
-- 資料表索引 `supply_index`
--
ALTER TABLE `supply_index`
  ADD PRIMARY KEY (`purchase_code`,`item_barcode`),
  ADD KEY `supply_index_foreign_2` (`item_barcode`);

--
-- 資料表索引 `supply_order`
--
ALTER TABLE `supply_order`
  ADD PRIMARY KEY (`purchase_code`),
  ADD KEY `supply_order_foreign_1` (`purchase_checkID`),
  ADD KEY `supply_order_foreign_2` (`factory_name`);

--
-- 已傾印資料表的限制式
--

--
-- 資料表的限制式 `factory`
--
ALTER TABLE `factory`
  ADD CONSTRAINT `factory_foreign_1` FOREIGN KEY (`factory_phone`) REFERENCES `factory_detail` (`factory_phone`);

--
-- 資料表的限制式 `sell_detail`
--
ALTER TABLE `sell_detail`
  ADD CONSTRAINT `sell_detail_foreign_1` FOREIGN KEY (`item_barcode`) REFERENCES `sell_item` (`item_barcode`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `sell_detail_foreign_2` FOREIGN KEY (`sale_recordNum`) REFERENCES `sale_record` (`sale_recordNum`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 資料表的限制式 `sell_item`
--
ALTER TABLE `sell_item`
  ADD CONSTRAINT `sell_item_foreign_1` FOREIGN KEY (`item_selling`) REFERENCES `sell_item` (`item_barcode`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 資料表的限制式 `supply_index`
--
ALTER TABLE `supply_index`
  ADD CONSTRAINT `supply_index_foreign_1` FOREIGN KEY (`purchase_code`) REFERENCES `supply_order` (`purchase_code`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `supply_index_foreign_2` FOREIGN KEY (`item_barcode`) REFERENCES `sell_item` (`item_barcode`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 資料表的限制式 `supply_order`
--
ALTER TABLE `supply_order`
  ADD CONSTRAINT `supply_order_foreign_1` FOREIGN KEY (`purchase_checkID`) REFERENCES `supply_order` (`purchase_code`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `supply_order_foreign_2` FOREIGN KEY (`factory_name`) REFERENCES `factory` (`factory_name`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
