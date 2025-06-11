-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 11, 2024 at 04:06 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bpmsdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbladmin`
--

CREATE TABLE `tbladmin` (
  `ID` int(10) NOT NULL,
  `AdminName` char(50) DEFAULT NULL,
  `UserName` char(50) DEFAULT NULL,
  `MobileNumber` bigint(10) DEFAULT NULL,
  `Email` varchar(200) DEFAULT NULL,
  `Password` varchar(200) DEFAULT NULL,
  `AdminRegdate` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbladmin`
--

INSERT INTO `tbladmin` (`ID`, `AdminName`, `UserName`, `MobileNumber`, `Email`, `Password`, `AdminRegdate`) VALUES
(1, 'test', 'admin', 7898799798, 'tester1@gmail.com', 'f925916e2754e5e03f75dd58a5733251', '2019-07-25 06:21:50');

-- --------------------------------------------------------

--
-- Table structure for table `tblappointment`
--

CREATE TABLE `tblappointment` (
  `ID` int(10) NOT NULL,
  `AptNumber` varchar(80) DEFAULT NULL,
  `Name` varchar(120) DEFAULT NULL,
  `Email` varchar(120) DEFAULT NULL,
  `PhoneNumber` bigint(11) DEFAULT NULL,
  `AptDate` varchar(120) DEFAULT NULL,
  `AptTime` varchar(120) DEFAULT NULL,
  `aesthetician_id` int(11) NOT NULL,
  `Services` varchar(120) DEFAULT NULL,
  `ApplyDate` timestamp NULL DEFAULT current_timestamp(),
  `Remark` varchar(250) NOT NULL,
  `Status` varchar(50) NOT NULL,
  `RemarkDate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `TotalCost` decimal(10,2) DEFAULT 0.00,
  `PaymentStatus` varchar(50) NOT NULL DEFAULT 'Not Paid',
  `PaymentMethod` tinyint(1) NOT NULL COMMENT '0-walkin, 1-online',
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tblappointment`
--

INSERT INTO `tblappointment` (`ID`, `AptNumber`, `Name`, `Email`, `PhoneNumber`, `AptDate`, `AptTime`, `aesthetician_id`, `Services`, `ApplyDate`, `Remark`, `Status`, `RemarkDate`, `TotalCost`, `PaymentStatus`, `PaymentMethod`, `user_id`) VALUES
(113, 'APPT20240826065016973', 'jaypeadasd', 'grayzxc23@gmail.com', 5645516, '2024-08-01', '4:00 PM - 5:00 PM', 24, 'Glass Skin (HydroOxygen)', '2024-08-26 04:50:16', 'LELS\r\n', '1', '2024-09-29 13:56:59', 499.00, 'Paid', 0, 18),
(114, 'APPT20240826065016973', 'jaypeadasd', 'grayzxc23@gmail.com', 5645516, '2024-08-01', '4:00 PM - 5:00 PM', 24, 'Acne Detoxify Facial', '2024-08-26 04:50:16', 'owjdosajdoajdo', 'Pending', '2024-09-25 12:47:14', 999.00, 'Not Paid', 0, 18),
(115, 'APPT20240826073648348', 'jaypeadasd', 'grayzxc23@gmail.com', 5645516, '2024-08-10', '9:00 PM - 10:00 PM', 24, 'Acne Detoxify Facial', '2024-08-26 05:36:48', 'owjdosajdoajdo', 'Pending', '2024-09-25 12:47:19', 999.00, 'Not Paid', 0, 18),
(116, 'APPT20240826073648348', 'jaypeadasd', 'grayzxc23@gmail.com', 5645516, '2024-08-10', '8:00 PM - 9:00 PM', 24, 'Exi Firm Arms', '2024-08-26 05:36:48', 'owjdosajdoajdo', 'Pending', '2024-09-25 12:47:22', 3499.00, 'Not Paid', 0, 18),
(117, 'APPT20240827055347201', 'Patricia Bigornia', 'lian23.bigornia@gmail.com', 9776068903, '2024-08-22', '12:00 PM - 1:00 PM', 24, 'Express/ Basic Facial', '2024-08-27 03:53:47', 'gusto ko maging agfanda', 'Pending', '2024-09-25 12:47:26', 499.00, 'Not Paid', 0, 18),
(118, 'APPT20240827055347201', 'Patricia Bigornia', 'lian23.bigornia@gmail.com', 9776068903, '2024-08-22', '7:00 PM - 8:00 PM', 24, 'Acne Detoxify Facial', '2024-08-27 03:53:47', 'gusto ko maging agfanda', 'Pending', '2024-09-25 12:47:29', 999.00, 'Not Paid', 0, 18),
(119, 'APPT20240827055347201', 'Patricia Bigornia', 'lian23.bigornia@gmail.com', 9776068903, '2024-08-22', '6:00 PM - 7:00 PM', 24, 'Signature Diamond Peel Facial', '2024-08-27 03:53:47', 'gusto ko maging agfanda', 'Pending', '2024-09-25 12:47:32', 999.00, 'Not Paid', 0, 18),
(120, 'APPT20240903180937283', 'yyp', 'jaypee.rocero@yahoo.com', 50565656056, '2024-09-01', '12:00 PM - 1:00 PM', 24, 'Express/ Basic Facial', '2024-09-03 16:09:37', 'xzczdfzf', 'Pending', '2024-09-25 12:47:36', 499.00, 'Not Paid', 0, 18),
(121, 'APPT20240903180937283', 'yyp', 'jaypee.rocero@yahoo.com', 50565656056, '2024-09-01', '4:00 PM - 5:00 PM', 24, 'Acne Detoxify Facial', '2024-09-03 16:09:37', 'xzczdfzf', 'Pending', '2024-09-25 12:47:40', 999.00, 'Not Paid', 0, 18),
(122, 'APPT20240903181030604', 'peejayaa', 'jaypee.rocero@yahoo.com', 99955, '2024-09-02', '12:00 PM - 1:00 PM', 24, 'Express/ Basic Facial', '2024-09-03 16:10:30', 'qweqwewq', 'Pending', '2024-09-25 12:47:42', 499.00, 'Not Paid', 0, 18),
(123, 'APPT20240903181030604', 'peejayaa', 'jaypee.rocero@yahoo.com', 99955, '2024-09-02', '12:00 PM - 1:00 PM', 24, 'Acne Detoxify Facial', '2024-09-03 16:10:30', 'qweqwewq', 'Pending', '2024-09-25 12:47:45', 999.00, 'Not Paid', 0, 18),
(124, 'APPT20240925151628392', 'Sam Dracoix', 'paganahinutak@gmail.com', 9123456789, '2024-09-30', '4:00 PM - 5:00 PM', 25, 'Express/ Basic Facial', '2024-09-25 13:16:28', 'N/A', '1', '2024-09-26 08:13:48', 499.00, 'Not Paid', 0, 18),
(125, 'APPT20240927113041521', 'Sam Dracoix', 'paganahinutak@gmail.com', 9123456789, '2024-10-10', '4:00 PM - 5:00 PM', 25, 'Express/ Basic Facial', '2024-09-27 09:30:41', '', '1', '2024-09-27 09:30:41', 499.00, 'Not Paid', 0, 1),
(126, 'APPT20240927152221308', 'Sam Dracoix', 'paganahinutak@gmail.com', 9123456789, '2024-10-30', '5:00 PM - 6:00 PM', 24, 'Express/ Basic Facial', '2024-09-27 13:22:21', 'asd', 'Pending', '2024-09-27 13:22:21', 499.00, 'Not Paid', 0, 18),
(127, 'APPT20240929103747732', 'test', 'paganahinutak@gmail.com', 9123456789, '2024-09-04', '2:00 PM - 3:00 PM', 24, 'Express/ Basic Facial', '2024-09-29 08:37:47', 'asd', 'Pending', '2024-09-29 08:37:47', 499.00, 'Not Paid', 0, 18),
(128, 'APPT20240929104551616', 'test', 'paganahinutak@gmail.com', 9123456789, '2024-09-04', '2:00 PM - 3:00 PM', 25, 'Express/ Basic Facial', '2024-09-29 08:45:51', 'asd', 'Pending', '2024-09-29 08:45:51', 499.00, 'Not Paid', 0, 18),
(129, 'APPT20240929111126175', 'test', 'paganahinutak@gmail.com', 9123456789, '2024-09-05', '5:00 PM - 6:00 PM', 24, 'Express/ Basic Facial', '2024-09-29 09:11:26', 'asd', 'Pending', '2024-09-29 09:11:26', 499.00, 'Not Paid', 0, 18),
(130, 'APPT20241001083020588', 'test', 'paganahinutak@gmail.com', 9123456789, '2024-09-04', '5:00 PM - 6:00 PM', 26, 'Glass Skin (HydroOxygen)', '2024-10-01 06:30:20', 'asd', 'Pending', '2024-10-01 06:30:20', 1999.00, 'Not Paid', 0, 14),
(132, 'APPT20241011030012895', 'yyp', 'paganahinutak@gmail.com', 9123456789, '2024-10-05', '2:00 PM - 3:00 PM', 24, 'Express/ Basic Facial', '2024-10-11 01:00:12', 'approved please pay', '1', '2024-10-11 05:57:44', 499.00, 'Paid', 1, 18);

-- --------------------------------------------------------

--
-- Table structure for table `tblavailability`
--

CREATE TABLE `tblavailability` (
  `id` int(11) NOT NULL,
  `aesthetician_id` int(11) NOT NULL,
  `service` varchar(255) NOT NULL,
  `availability` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblavailability`
--

INSERT INTO `tblavailability` (`id`, `aesthetician_id`, `service`, `availability`) VALUES
(1, 24, '[\"20\",\"24\",\"28\"]', '[\"12:00 PM - 1:00 PM\",\"2:00 PM - 3:00 PM\",\"5:00 PM - 6:00 PM\",\"8:00 PM - 9:00 PM\"]'),
(2, 25, '[\"20\",\"23\",\"27\"]', '[\"12:00 PM - 1:00 PM\",\"1:00 PM - 2:00 PM\",\"2:00 PM - 3:00 PM\",\"3:00 PM - 4:00 PM\",\"4:00 PM - 5:00 PM\",\"5:00 PM - 6:00 PM\",\"6:00 PM - 7:00 PM\",\"7:00 PM - 8:00 PM\",\"8:00 PM - 9:00 PM\",\"9:00 PM - 10:00 PM\"]'),
(3, 26, '[\"22\",\"23\",\"25\",\"28\"]', '[\"2:00 PM - 3:00 PM\",\"5:00 PM - 6:00 PM\"]');

-- --------------------------------------------------------

--
-- Table structure for table `tblcustomers`
--

CREATE TABLE `tblcustomers` (
  `ID` int(10) NOT NULL,
  `Name` varchar(120) DEFAULT NULL,
  `Email` varchar(200) DEFAULT NULL,
  `MobileNumber` bigint(11) DEFAULT NULL,
  `Gender` enum('Female','Male','Transgender') DEFAULT NULL,
  `Details` mediumtext DEFAULT NULL,
  `CreationDate` timestamp NULL DEFAULT current_timestamp(),
  `UpdationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tblcustomers`
--

INSERT INTO `tblcustomers` (`ID`, `Name`, `Email`, `MobileNumber`, `Gender`, `Details`, `CreationDate`, `UpdationDate`) VALUES
(6, 'baby', '1@gmail.com', 6995, 'Female', 'asdasd', '2024-04-17 09:05:25', NULL),
(7, 'shan', 'shan123@gmail.com', 620418717, 'Female', 'asasdasdas', '2024-04-24 15:56:51', NULL),
(8, 'saDda', 'grayzxc23@gmail.com', 995025620, 'Male', 'WDEWAEA', '2024-08-18 17:17:47', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tblinvoice`
--

CREATE TABLE `tblinvoice` (
  `id` int(11) NOT NULL,
  `Userid` int(11) DEFAULT NULL,
  `ServiceId` int(11) DEFAULT NULL,
  `BillingId` int(11) DEFAULT NULL,
  `PostingDate` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tblinvoice`
--

INSERT INTO `tblinvoice` (`id`, `Userid`, `ServiceId`, `BillingId`, `PostingDate`) VALUES
(19, 6, 20, 840281681, '2024-04-17 09:05:42'),
(20, 6, 21, 840281681, '2024-04-17 09:05:42'),
(21, 6, 22, 840281681, '2024-04-17 09:05:42'),
(22, 6, 23, 840281681, '2024-04-17 09:05:42'),
(23, 6, 24, 840281681, '2024-04-17 09:05:42'),
(24, 6, 25, 840281681, '2024-04-17 09:05:42'),
(25, 6, 20, 934982047, '2024-04-24 15:57:22'),
(26, 6, 21, 934982047, '2024-04-24 15:57:22'),
(27, 6, 22, 934982047, '2024-04-24 15:57:22'),
(28, 8, 22, 566310549, '2024-08-18 17:17:57'),
(29, 8, 23, 566310549, '2024-08-18 17:17:57'),
(30, 6, 28, 373865270, '2024-08-20 13:57:56'),
(31, 6, 29, 373865270, '2024-08-20 13:57:56'),
(32, 6, 20, 317272654, '2024-08-20 13:58:11'),
(33, 6, 21, 317272654, '2024-08-20 13:58:12'),
(34, 6, 22, 317272654, '2024-08-20 13:58:12');

-- --------------------------------------------------------

--
-- Table structure for table `tblpage`
--

CREATE TABLE `tblpage` (
  `ID` int(10) NOT NULL,
  `PageType` varchar(200) DEFAULT NULL,
  `PageTitle` mediumtext DEFAULT NULL,
  `PageDescription` mediumtext DEFAULT NULL,
  `Email` varchar(200) DEFAULT NULL,
  `MobileNumber` bigint(10) DEFAULT NULL,
  `UpdationDate` date DEFAULT NULL,
  `Timing` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tblpage`
--

INSERT INTO `tblpage` (`ID`, `PageType`, `PageTitle`, `PageDescription`, `Email`, `MobileNumber`, `UpdationDate`, `Timing`) VALUES
(1, 'aboutus', 'About Us', '        Our main focus is on quality and hygiene. Our Parlour is well equipped with advanced technology equipments and provides best quality services. Our staff is well trained and experienced, offering advanced services in Skin, Hair and Body Shaping that will provide you with a luxurious experience that leave you feeling relaxed and stress free. The specialities in the parlour are, apart from regular bleachings and Facials, many types of hairstyles, Bridal and cine make-up and different types of Facials &amp; fashion hair colourings.', NULL, NULL, NULL, ''),
(2, 'contactus', 'Contact Us', ' 572 Pampanga street, Gagalangin Tondo Manila, Manila, Philippines', 'beckcare@business.com', 918154215, NULL, ' 12:00 PM - 10:00PM');

-- --------------------------------------------------------

--
-- Table structure for table `tblservices`
--

CREATE TABLE `tblservices` (
  `ID` int(10) NOT NULL,
  `ServiceName` varchar(200) DEFAULT NULL,
  `Cost` int(10) DEFAULT NULL,
  `description` varchar(255) NOT NULL,
  `category` varchar(255) NOT NULL,
  `imgurl` varchar(255) NOT NULL,
  `CreationDate` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tblservices`
--

INSERT INTO `tblservices` (`ID`, `ServiceName`, `Cost`, `description`, `category`, `imgurl`, `CreationDate`) VALUES
(20, 'Express/ Basic Facial', 499, ' deep cleaning treatment that restores a healthy, clear complexion.  ', 'Facial', '0', '2024-04-15 11:49:24'),
(21, 'Acne Detoxify Facial', 999, 'this procedure combines deep washing, exfoliation, steam, and specialty masks. A detox facial assists in removing acne, shrinking pores, and lightening blemishes by addressing the underlying factors that contribute to skin problems, such as clogged pores ', 'Facial', '0', '2024-04-15 11:50:39'),
(22, 'Signature Diamond Peel Facial', 999, 'Diamond Peel painlessly removes the dead layer of skin. It gently exfoliates the skin using a machine with an extremely fine diamond dust tip and vacuum. As your skin is being exfoliated by the diamond, the vacuum safely pulls away all debris. Basic Diamo', 'Facial', '0', '2024-04-15 11:51:34'),
(23, 'Glass Skin (HydroOxygen)', 1999, 'The Hydra Facial is a medical-grade resurfacing treatment that clears your pores out, plus hydrates your skin. ', 'Facial', '0', '2024-04-15 11:52:22'),
(24, 'Vlift Contour', 1499, 'a procedure that contours - straightens and sculpts the lower jaw and chin area using a thread lift method and dermal fillers. The resulting effect tightens the lower part of the face, restores elasticity to the skin and gives the face a youthful appearan', 'Facial', '0', '2024-04-15 11:53:26'),
(25, 'Skin Reboot RF Face ', 999, 'Lifts, tightens, redensifies, and decongests the skin on both face and body by using a combination of radiofrequency and direct current.', 'Slimming & Contouring', '0', '2024-04-15 11:54:25'),
(26, 'RF Arms', 1499, 'slimming treatments use radio frequency to reduce subcutaneous fat.  ', 'Slimming & Contouring', '0', '2024-04-15 11:55:41'),
(27, 'RF Stomach', 2499, 'Comfortably minimizes the appearance of cellulite dimpling and fatty bulges, while simultaneously tightening the skin and improving the contours of the target area.', 'Slimming & Contouring', '0', '2024-04-15 11:56:30'),
(28, 'Exi Firm Face', 2499, 'Tighten your skin and specifically stimulate collagen production.', 'Slimming & Contouring', '0', '2024-04-15 11:58:31'),
(29, 'Exi Firm Arms', 3499, 'A relaxing hot stone massage-like feeling will accompany you during the therapy.', ' Slimming & Contouring\r\n', '0', '2024-04-15 11:59:06'),
(30, 'Hello', 8999, 'HAHSHSHAHS', 'Facial', 'work-1.jpg', '2024-08-26 06:13:57');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `user_type` varchar(20) NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `user_type`) VALUES
(1, 'woah', 'dfsfsddda@gmail.com', '202cb962ac59075b964b07152d234b70', 'user'),
(2, 'marcus', '1@gmail.com', '202cb962ac59075b964b07152d234b70', 'admin'),
(3, 'baby', '123@gmail.com', '202cb962ac59075b964b07152d234b70', 'user'),
(4, 'baby', 'ddd@gmail.com', '202cb962ac59075b964b07152d234b70', 'user'),
(5, '222', 'bonn_0514@yahoo.com', '202cb962ac59075b964b07152d234b70', 'admin'),
(6, 'babyaaa', 'dfsfs@gmail.comsadds', '202cb962ac59075b964b07152d234b70', 'user'),
(7, 'asdasdaa', 'daafsfs@gmail.com', '202cb962ac59075b964b07152d234b70', 'user'),
(8, 'babyasdasd', 'asa@gmail.com', '202cb962ac59075b964b07152d234b70', 'user'),
(9, 'baby', 'dfddsfs@gmail.com', '202cb962ac59075b964b07152d234b70', 'user'),
(10, 'babyasdasdasd', 'bonn_0514@yahoo.comdsds', '202cb962ac59075b964b07152d234b70', 'user'),
(11, 'babyssss', 'bonn_0gg514@yahoo.com', '202cb962ac59075b964b07152d234b70', 'user'),
(12, 'baby', 'jhasa@gmail.com', '202cb962ac59075b964b07152d234b70', 'user'),
(13, 'asdadsada', 'bonn_052214@yahoo.com', '202cb962ac59075b964b07152d234b70', 'user'),
(14, 'Jaypee', 'jaypee2.rocero@yahoo.com', '202cb962ac59075b964b07152d234b70', 'user'),
(15, 'olea', 'olea@gmail.com', '202cb962ac59075b964b07152d234b70', 'user'),
(16, 'shan', 'shan123@gmail.com', '202cb962ac59075b964b07152d234b70', 'user'),
(17, 'pat', 'pat@gmail.com', '202cb962ac59075b964b07152d234b70', 'user'),
(18, 'yyp', 'jaypeee.rocero@yahoo.com', '25f9e794323b453885f5181f1b624d0b', 'user'),
(19, 'sdfsdfsdfs', 'yyp@gmail.com', '25f9e794323b453885f5181f1b624d0b', 'user'),
(20, 'asdadadadw3daw', 'lasew@nlshps.fun', '25f9e794323b453885f5181f1b624d0b', 'user'),
(24, 'Jane Doe', 'janedoe@example.com', '32250170a0dca92d53ec9624f336ca24', 'aesthetician'),
(25, 'Sophia DaFirst', 'sophia@example.com', '32250170a0dca92d53ec9624f336ca24', 'aesthetician'),
(26, 'Hale Cesar', 'test@example.com', '32250170a0dca92d53ec9624f336ca24', 'aesthetician');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbladmin`
--
ALTER TABLE `tbladmin`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tblappointment`
--
ALTER TABLE `tblappointment`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tblavailability`
--
ALTER TABLE `tblavailability`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblcustomers`
--
ALTER TABLE `tblcustomers`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tblinvoice`
--
ALTER TABLE `tblinvoice`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `tblpage`
--
ALTER TABLE `tblpage`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tblservices`
--
ALTER TABLE `tblservices`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbladmin`
--
ALTER TABLE `tbladmin`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tblappointment`
--
ALTER TABLE `tblappointment`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=133;

--
-- AUTO_INCREMENT for table `tblavailability`
--
ALTER TABLE `tblavailability`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tblcustomers`
--
ALTER TABLE `tblcustomers`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tblinvoice`
--
ALTER TABLE `tblinvoice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `tblpage`
--
ALTER TABLE `tblpage`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tblservices`
--
ALTER TABLE `tblservices`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
