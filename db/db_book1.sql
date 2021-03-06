-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 30, 2018 at 10:22 PM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 5.6.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_book`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_board`
--

CREATE TABLE `tbl_board` (
  `b_id` int(11) NOT NULL,
  `mem_id` int(11) NOT NULL,
  `b_title` varchar(100) NOT NULL,
  `b_detail` text NOT NULL,
  `a_ans` varchar(200) DEFAULT NULL,
  `a_ans_date` datetime DEFAULT NULL,
  `datesave` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_board`
--

INSERT INTO `tbl_board` (`b_id`, `mem_id`, `b_title`, `b_detail`, `a_ans`, `a_ans_date`, `datesave`) VALUES
(1, 1, 'yyy', 'yyy', 'kkkk', '2018-08-01 00:00:00', '2018-07-31 20:26:55'),
(2, 1, '2', '2', NULL, NULL, '2018-07-31 20:27:33'),
(3, 2, 'ooo', 'oooo', 'jjj', '2018-08-01 00:00:00', '2018-07-31 20:29:17'),
(4, 4, 'uuu', 'uuuu', 'ppppp', '2018-08-01 00:00:00', '2018-07-31 20:36:36'),
(5, 2, 'uuu', 'uuu', 'pppp', '2018-08-04 00:00:00', '2018-08-03 16:59:19'),
(6, 4, 'kkkk', 'mmmm', 'hhhhh', '2018-08-16 00:00:00', '2018-08-16 16:12:03'),
(7, 2, '123456789', '123456789', '2', '2018-08-17 00:00:00', '2018-08-17 09:33:24');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_book`
--

CREATE TABLE `tbl_book` (
  `bo_id` int(11) NOT NULL,
  `bt_id` int(11) NOT NULL,
  `bo_name` varchar(200) NOT NULL,
  `bo_detail` text NOT NULL,
  `bo_img` varchar(200) NOT NULL,
  `bo_qty` varchar(100) NOT NULL,
  `bo_view` int(11) NOT NULL,
  `datesave` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_book`
--

INSERT INTO `tbl_book` (`bo_id`, `bt_id`, `bo_name`, `bo_detail`, `bo_img`, `bo_qty`, `bo_view`, `datesave`) VALUES
(1, 1, 'แฟชั่น1', ' เป็นสื่อที่รวบรวมของข้อมูล ประเภทตัวอักษร และ รูปภาพ ที่ลงในแผ่นกระดาษหรือวัสดุชนิดอื่น และรวมเข้าด้วยกัน ด้วยวิธีการ เย็บเล่ม หรือ ทากาว เข้าด้วยกันที่บริเวณขอบด้านใดด้านหนึ่ง โดยมีขนาดต่าง ๆ กัน แต่มักจะไม่ทำใหญ่กว่าการจับและเปิดอ่านสะดวก หนังสือมักจะเป็นแหล่งรวบรวมข้อมูล ความรู้ วรรณกรรม ', '142900763620180721_024125.png', '12', 9, '2018-07-20 19:41:25'),
(2, 2, 'แฟชั่น2', ' เป็นสื่อที่รวบรวมของข้อมูล ประเภทตัวอักษร และ รูปภาพ ที่ลงในแผ่นกระดาษหรือวัสดุชนิดอื่น และรวมเข้าด้วยกัน ด้วยวิธีการ เย็บเล่ม หรือ ทากาว เข้าด้วยกันที่บริเวณขอบด้านใดด้านหนึ่ง โดยมีขนาดต่าง ๆ กัน แต่มักจะไม่ทำใหญ่กว่าการจับและเปิดอ่านสะดวก หนังสือมักจะเป็นแหล่งรวบรวมข้อมูล ความรู้ วรรณกรรม ', '142900763620180721_024125.png', '7', 9, '2018-07-20 19:41:25'),
(3, 1, 'แฟชั่น3', ' เป็นสื่อที่รวบรวมของข้อมูล ประเภทตัวอักษร และ รูปภาพ ที่ลงในแผ่นกระดาษหรือวัสดุชนิดอื่น และรวมเข้าด้วยกัน ด้วยวิธีการ เย็บเล่ม หรือ ทากาว เข้าด้วยกันที่บริเวณขอบด้านใดด้านหนึ่ง โดยมีขนาดต่าง ๆ กัน แต่มักจะไม่ทำใหญ่กว่าการจับและเปิดอ่านสะดวก หนังสือมักจะเป็นแหล่งรวบรวมข้อมูล ความรู้ วรรณกรรม ', '142900763620180721_024125.png', '0', 7, '2018-07-20 19:41:25');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_booking`
--

CREATE TABLE `tbl_booking` (
  `bi_id` int(5) UNSIGNED ZEROFILL NOT NULL,
  `mem_id` int(11) NOT NULL,
  `bi_room` int(11) NOT NULL,
  `bu_id` int(11) NOT NULL,
  `ft_id` int(11) NOT NULL,
  `bi_class` varchar(100) NOT NULL,
  `bi_no` varchar(100) NOT NULL,
  `bi_in` datetime NOT NULL,
  `bi_return` datetime NOT NULL,
  `bi_out` datetime NOT NULL,
  `bi_status` int(11) NOT NULL,
  `bi_fine` float(10,2) NOT NULL,
  `bi_text` varchar(200) DEFAULT NULL,
  `bn_room` int(11) DEFAULT NULL,
  `bn_id` int(11) DEFAULT NULL,
  `bn_no` varchar(100) DEFAULT NULL,
  `bn_class` varchar(100) DEFAULT NULL,
  `s_at` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_booking`
--

INSERT INTO `tbl_booking` (`bi_id`, `mem_id`, `bi_room`, `bu_id`, `ft_id`, `bi_class`, `bi_no`, `bi_in`, `bi_return`, `bi_out`, `bi_status`, `bi_fine`, `bi_text`, `bn_room`, `bn_id`, `bn_no`, `bn_class`, `s_at`) VALUES
(00001, 2, 2, 3, 0, '2', '5', '2018-09-02 00:00:00', '2018-09-03 00:00:00', '2018-07-27 15:52:41', 3, 0.00, 'หนังสือหมด', NULL, NULL, NULL, NULL, NULL),
(00002, 2, 1, 0, 0, 'ชั้น', '', '2018-09-02 00:00:00', '2018-09-03 00:00:00', '2018-07-27 16:00:25', 5, 0.00, NULL, 1, 0, '', 'ชั้น', NULL),
(00003, 2, 2, 2, 0, '3', '333', '2018-09-06 00:00:00', '2018-09-03 00:00:00', '2018-08-02 14:56:13', 4, 30.00, '', 2, 3, '5', '2', 'พนักงาน'),
(00004, 2, 1, 0, 0, 'ชั้น', '', '2018-09-06 00:00:00', '2018-09-03 00:00:00', '2018-08-02 22:25:21', 3, 0.00, 'หนังสือหมด!!', NULL, NULL, NULL, NULL, NULL),
(00005, 4, 2, 2, 0, '4', '24', '2018-09-05 00:00:00', '2018-09-03 00:00:00', '2018-08-02 22:45:53', 4, 30.00, NULL, 2, 3, '5', '1', 'ห้องสมุด'),
(00006, 4, 1, 0, 0, 'ชั้น', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2018-08-12 02:01:30', 3, 0.00, 'GG', 0, 0, '', '', NULL),
(00007, 2, 2, 3, 0, '2', '4', '2018-09-10 00:00:00', '2018-09-12 00:00:00', '2018-08-14 00:27:00', 5, 0.00, '', 2, 3, '5', '1', NULL),
(00008, 4, 1, 0, 0, 'ชั้น', '', '2018-09-10 00:00:00', '2018-09-06 00:00:00', '2018-08-17 00:44:37', 5, 60.00, '', 1, 0, '', 'ชั้น', NULL),
(00009, 2, 2, 3, 0, '2', '5555', '2018-08-17 00:00:00', '2018-08-14 00:00:00', '2018-08-17 16:32:44', 5, 45.00, '', 1, 0, '', 'ชั้น', NULL),
(00010, 4, 1, 0, 0, 'ชั้น', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2018-08-17 17:10:10', 1, 0.00, '', 0, 0, '', '', NULL),
(00011, 2, 2, 2, 0, '3', '2', '2018-08-18 00:00:00', '2018-08-15 00:00:00', '2018-08-18 13:45:36', 5, 45.00, '', 1, 0, '', 'ชั้น', NULL),
(00012, 4, 1, 0, 0, 'ชั้น', '', '2018-08-29 00:00:00', '2018-08-27 00:00:00', '2018-08-30 00:27:13', 4, 30.00, '', 1, 0, '', 'ชั้น', 'ห้องสมุด'),
(00013, 4, 1, 0, 0, 'ชั้น', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2018-08-31 01:52:05', 1, 0.00, '', 0, 0, '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_booking_detail`
--

CREATE TABLE `tbl_booking_detail` (
  `bd_id` int(11) NOT NULL,
  `bi_id` int(11) NOT NULL,
  `bo_id` int(11) NOT NULL,
  `bd_qty` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_booking_detail`
--

INSERT INTO `tbl_booking_detail` (`bd_id`, `bi_id`, `bo_id`, `bd_qty`) VALUES
(1, 1, 2, '1'),
(2, 2, 1, '1'),
(3, 2, 2, '1'),
(4, 3, 1, '1'),
(5, 3, 2, '1'),
(6, 4, 1, '1'),
(7, 4, 2, '1'),
(8, 5, 1, '1'),
(9, 5, 2, '1'),
(10, 6, 1, '1'),
(11, 6, 2, '1'),
(12, 7, 1, '1'),
(13, 8, 1, '2'),
(14, 8, 2, '1'),
(15, 9, 1, '3'),
(16, 10, 1, '1'),
(17, 11, 1, '1'),
(18, 11, 2, '1'),
(19, 12, 1, '1'),
(20, 13, 1, '1');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_book_type`
--

CREATE TABLE `tbl_book_type` (
  `bt_id` int(11) NOT NULL,
  `bt_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_book_type`
--

INSERT INTO `tbl_book_type` (`bt_id`, `bt_name`) VALUES
(1, 'วารสาร'),
(2, 'นิตยสาร');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_building`
--

CREATE TABLE `tbl_building` (
  `bu_id` int(11) NOT NULL,
  `bu_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_building`
--

INSERT INTO `tbl_building` (`bu_id`, `bu_name`) VALUES
(2, '532'),
(3, '542');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_dating`
--

CREATE TABLE `tbl_dating` (
  `dt_id` int(11) NOT NULL,
  `bi_id` int(11) NOT NULL,
  `mem_id` int(11) NOT NULL,
  `dt_day` date NOT NULL,
  `dt_date` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_dating`
--

INSERT INTO `tbl_dating` (`dt_id`, `bi_id`, `mem_id`, `dt_day`, `dt_date`) VALUES
(1, 3, 3, '2018-08-02', '12:12:00'),
(2, 7, 3, '2018-08-14', '12:12:00'),
(3, 8, 3, '2018-08-20', '14:12:00'),
(4, 9, 3, '2018-08-17', '12:12:00'),
(5, 11, 3, '2018-08-18', '13:01:00'),
(6, 12, 3, '2018-08-30', '12:12:00');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_faculty`
--

CREATE TABLE `tbl_faculty` (
  `ft_id` int(11) NOT NULL,
  `ft_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_faculty`
--

INSERT INTO `tbl_faculty` (`ft_id`, `ft_name`) VALUES
(1, 'มนุษยศาสตร์'),
(2, 'วิทยาศาสตร์');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_member`
--

CREATE TABLE `tbl_member` (
  `mem_id` int(11) NOT NULL,
  `ms_id` int(11) NOT NULL,
  `mem_name` varchar(200) NOT NULL,
  `mem_address` varchar(200) NOT NULL,
  `mem_tel` varchar(20) NOT NULL,
  `mem_email` varchar(100) NOT NULL,
  `mem_user` varchar(100) NOT NULL,
  `mem_pass` varchar(100) NOT NULL,
  `datesave` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_member`
--

INSERT INTO `tbl_member` (`mem_id`, `ms_id`, `mem_name`, `mem_address`, `mem_tel`, `mem_email`, `mem_user`, `mem_pass`, `datesave`) VALUES
(1, 1, 'สมชาย ดีจริง', 'กรุงเทพ 1233/1 ', '08425136425', 'ttt@ttt.com', '1', '1', '2018-07-20 18:15:51'),
(2, 3, 'สมาน สุดยอดชาเขียว', 'กรุงเทพ 1233/1 7777', '08425136425', 'yyy@yyy.com', '2', '2', '2018-07-20 18:16:06'),
(3, 2, 'พัฒนา', 'ดดดดดดดดดดด', '1111111111111', 'kkkk@kkkk.com', '4', '4', '2018-07-22 19:59:38'),
(4, 3, 'เจ', 'เจเจ', '0152403168', 'ggg@ggg.com', '9', '9', '2018-07-23 09:52:03'),
(5, 2, 'วันนา', '11425 กทม.', '0213546785', 'kkkk@kkkk.com', '10', '10', '2018-07-27 14:58:58');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_member_status`
--

CREATE TABLE `tbl_member_status` (
  `ms_id` int(11) NOT NULL,
  `ms_name` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_member_status`
--

INSERT INTO `tbl_member_status` (`ms_id`, `ms_name`) VALUES
(1, 'ผู้ดูแลระบบ'),
(2, 'เจ้าหน้าที่'),
(3, 'อาจารย์');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_schedule`
--

CREATE TABLE `tbl_schedule` (
  `sd_id` int(11) NOT NULL,
  `mem_id` int(11) NOT NULL,
  `sd_day` varchar(100) NOT NULL,
  `datesave` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_schedule`
--

INSERT INTO `tbl_schedule` (`sd_id`, `mem_id`, `sd_day`, `datesave`) VALUES
(1, 5, 'จันทร์', '2018-07-22 20:09:24'),
(2, 3, 'อังคาร', '2018-07-23 07:07:36'),
(3, 3, 'พุธ', '2018-07-23 07:12:38'),
(4, 3, 'พฤหัสบดี', '2018-07-23 07:12:49'),
(5, 3, 'ศุกร์', '2018-07-23 07:12:58');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_board`
--
ALTER TABLE `tbl_board`
  ADD PRIMARY KEY (`b_id`);

--
-- Indexes for table `tbl_book`
--
ALTER TABLE `tbl_book`
  ADD PRIMARY KEY (`bo_id`);

--
-- Indexes for table `tbl_booking`
--
ALTER TABLE `tbl_booking`
  ADD PRIMARY KEY (`bi_id`);

--
-- Indexes for table `tbl_booking_detail`
--
ALTER TABLE `tbl_booking_detail`
  ADD PRIMARY KEY (`bd_id`);

--
-- Indexes for table `tbl_book_type`
--
ALTER TABLE `tbl_book_type`
  ADD PRIMARY KEY (`bt_id`);

--
-- Indexes for table `tbl_building`
--
ALTER TABLE `tbl_building`
  ADD PRIMARY KEY (`bu_id`);

--
-- Indexes for table `tbl_dating`
--
ALTER TABLE `tbl_dating`
  ADD PRIMARY KEY (`dt_id`);

--
-- Indexes for table `tbl_faculty`
--
ALTER TABLE `tbl_faculty`
  ADD PRIMARY KEY (`ft_id`);

--
-- Indexes for table `tbl_member`
--
ALTER TABLE `tbl_member`
  ADD PRIMARY KEY (`mem_id`);

--
-- Indexes for table `tbl_member_status`
--
ALTER TABLE `tbl_member_status`
  ADD PRIMARY KEY (`ms_id`);

--
-- Indexes for table `tbl_schedule`
--
ALTER TABLE `tbl_schedule`
  ADD PRIMARY KEY (`sd_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_board`
--
ALTER TABLE `tbl_board`
  MODIFY `b_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_book`
--
ALTER TABLE `tbl_book`
  MODIFY `bo_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_booking`
--
ALTER TABLE `tbl_booking`
  MODIFY `bi_id` int(5) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tbl_booking_detail`
--
ALTER TABLE `tbl_booking_detail`
  MODIFY `bd_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `tbl_book_type`
--
ALTER TABLE `tbl_book_type`
  MODIFY `bt_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_building`
--
ALTER TABLE `tbl_building`
  MODIFY `bu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_dating`
--
ALTER TABLE `tbl_dating`
  MODIFY `dt_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_faculty`
--
ALTER TABLE `tbl_faculty`
  MODIFY `ft_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_member`
--
ALTER TABLE `tbl_member`
  MODIFY `mem_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_member_status`
--
ALTER TABLE `tbl_member_status`
  MODIFY `ms_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_schedule`
--
ALTER TABLE `tbl_schedule`
  MODIFY `sd_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
