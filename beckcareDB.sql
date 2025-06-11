-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 03, 2024 at 11:37 PM
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
-- Database: `bpmsdbtscp`
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
  `user_id` int(11) NOT NULL,
  `loyalty_points` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tblappointment`
--

INSERT INTO `tblappointment` (`ID`, `AptNumber`, `Name`, `Email`, `PhoneNumber`, `AptDate`, `AptTime`, `aesthetician_id`, `Services`, `ApplyDate`, `Remark`, `Status`, `RemarkDate`, `TotalCost`, `PaymentStatus`, `PaymentMethod`, `user_id`, `loyalty_points`) VALUES
(134, 'APPT20241019024933468', 'shan', 'shan123@gmail.com', 576548645, '2024-10-01', '2:00 PM - 3:00 PM', 24, 'Express/ Basic Facial', '2024-10-19 00:49:33', 'k', '1', '2024-11-03 08:48:10', 499.00, 'Paid', 1, 16, 1),
(137, 'APPT20241103080134756', 'shannnnna', 'shan123@gmail.com', 9956778802, '2024-11-01', '12:00 PM - 1:00 PM', 24, 'Express/ Basic Facial', '2024-11-03 07:01:34', '11232', '1', '2024-11-03 07:09:15', 499.00, 'Paid', 1, 16, 0),
(138, 'APPT20241103093314545', 'shannnnna', 'shan123@gmail.com', 9956778802, '2024-11-01', '2:00 PM - 3:00 PM', 24, 'Express/ Basic Facial', '2024-11-03 08:33:14', 'sss', '1', '2024-11-03 08:42:00', 499.00, 'Paid', 1, 16, 12),
(139, 'APPT20241103161434847', 'hey', 'jaypeee.rocero@yahoo.com', 9956778802, '2024-11-01', '12:00 PM - 1:00 PM', 25, 'Express/ Basic Facial', '2024-11-03 15:14:34', 'hey', '1', '2024-11-03 15:24:53', 499.00, 'Paid', 1, 27, 17);

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
-- Table structure for table `tblclaimed_rewards`
--

CREATE TABLE `tblclaimed_rewards` (
  `claim_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `reward_id` int(11) NOT NULL,
  `reward_code` varchar(50) NOT NULL,
  `claimed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblclaimed_rewards`
--

INSERT INTO `tblclaimed_rewards` (`claim_id`, `user_id`, `reward_id`, `reward_code`, `claimed_at`) VALUES
(4, 16, 1, 'RW-93BAA527', '2024-11-03 15:12:50'),
(5, 27, 1, 'RW-D8283638', '2024-11-03 15:16:08'),
(6, 27, 2, 'RW-91B3D14F', '2024-11-03 15:25:00');

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
-- Table structure for table `tblrewards`
--

CREATE TABLE `tblrewards` (
  `reward_id` int(11) NOT NULL,
  `rewardname` varchar(255) NOT NULL,
  `points_required` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblrewards`
--

INSERT INTO `tblrewards` (`reward_id`, `rewardname`, `points_required`, `created_at`, `updated_at`) VALUES
(1, 'basic favial', 10, '2024-11-03 08:00:30', '2024-11-03 08:00:30'),
(2, 'hhgvgf', 15, '2024-11-03 15:24:04', '2024-11-03 15:24:04');

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
(20, 'Express/ Basic Facial', 499, ' deep cleaning treatment that restores a healthy, clear complexion.  ', 'Facial', 'facial-signature-deluxe.jpg', '2024-04-15 11:49:24'),
(21, 'Acne Detoxify Facial', 999, 'this procedure combines deep washing, exfoliation, steam, and specialty masks. A detox facial assists in removing acne, shrinking pores, and lightening blemishes by addressing the underlying factors that contribute to skin problems, such as clogged pores ', 'Facial', '82E243D9-5342-4AD9-9E6B-065552F2824C_1080x.webp', '2024-04-15 11:50:39'),
(22, 'Signature Diamond Peel Facial', 999, 'Diamond Peel painlessly removes the dead layer of skin. It gently exfoliates the skin using a machine with an extremely fine diamond dust tip and vacuum. As your skin is being exfoliated by the diamond, the vacuum safely pulls away all debris. Basic Diamo', 'Facial', 'young-woman-lying-cosmetologist-s-table-during-rejuvenation-procedure-scaled.jpg', '2024-04-15 11:51:34'),
(23, 'Glass Skin (HydroOxygen)', 1999, 'The Hydra Facial is a medical-grade resurfacing treatment that clears your pores out, plus hydrates your skin. ', 'Facial', '301.webp', '2024-04-15 11:52:22'),
(24, 'Vlift Contour', 1499, 'a procedure that contours - straightens and sculpts the lower jaw and chin area using a thread lift method and dermal fillers. The resulting effect tightens the lower part of the face, restores elasticity to the skin and gives the face a youthful appearan', 'Facial', 'Vlift.jpg', '2024-04-15 11:53:26'),
(25, 'Skin Reboot RF Face ', 999, 'Lifts, tightens, redensifies, and decongests the skin on both face and body by using a combination of radiofrequency and direct current.', 'Slimming & Contouring', 'Urban-Spa-Aus-05095-620x930.webp', '2024-04-15 11:54:25'),
(26, 'RF Arms', 1499, 'slimming treatments use radio frequency to reduce subcutaneous fat.  ', 'Slimming & Contouring', 'arm-body-cavitation-Chicago-576x1024.jpg', '2024-04-15 11:55:41'),
(27, 'RF Stomach', 2499, 'Comfortably minimizes the appearance of cellulite dimpling and fatty bulges, while simultaneously tightening the skin and improving the contours of the target area.', 'Slimming & Contouring', 'radio_frequency_skin_tightening1 (1).jpg', '2024-04-15 11:56:30'),
(28, 'Exi Firm Face', 2499, 'Tighten your skin and specifically stimulate collagen production.', 'Slimming & Contouring', '652f65f112a0b5b1aba4648d_img-treatment-pure-line-firm.png', '2024-04-15 11:58:31'),
(29, 'Exi Firm Arms', 3499, 'A relaxing hot stone massage-like feeling will accompany you during the therapy.', 'Facial', 'arm-lift.jpg', '2024-04-15 11:59:06'),
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
  `user_type` varchar(20) NOT NULL DEFAULT 'user',
  `profile_pic` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `user_type`, `profile_pic`, `address`) VALUES
(8, 'babyasdasd', 'asa@gmail.com', '202cb962ac59075b964b07152d234b70', 'user', NULL, NULL),
(9, 'baby', 'dfddsfs@gmail.com', '202cb962ac59075b964b07152d234b70', 'user', NULL, NULL),
(10, 'babyasdasdasd', 'bonn_0514@yahoo.comdsds', '202cb962ac59075b964b07152d234b70', 'user', NULL, NULL),
(12, 'baby', 'jhasa@gmail.com', '202cb962ac59075b964b07152d234b70', 'user', NULL, NULL),
(13, 'asdadsada', 'bonn_052214@yahoo.com', '202cb962ac59075b964b07152d234b70', 'user', NULL, NULL),
(14, 'Jaypee', 'jaypee2.rocero@yahoo.com', '202cb962ac59075b964b07152d234b70', 'user', NULL, NULL),
(15, 'olea', 'olea@gmail.com', '202cb962ac59075b964b07152d234b70', 'user', NULL, NULL),
(16, 'shannnnna', 'shan123@gmail.com', '202cb962ac59075b964b07152d234b70', 'user', 'image2.jpeg', 'helloaaaASDSD'),
(17, 'pat', 'pat@gmail.com', '202cb962ac59075b964b07152d234b70', 'user', NULL, NULL),
(18, 'yyp', 'jaypeee.rocero@yahoo.com', '25f9e794323b453885f5181f1b624d0b', 'user', NULL, NULL),
(19, 'sdfsdfsdfs', 'yyp@gmail.com', '25f9e794323b453885f5181f1b624d0b', 'user', NULL, NULL),
(20, 'asdadadadw3daw', 'lasew@nlshps.fun', '25f9e794323b453885f5181f1b624d0b', 'user', NULL, NULL),
(24, 'Jane Doe', 'janedoe@example.com', '32250170a0dca92d53ec9624f336ca24', 'aesthetician', NULL, NULL),
(25, 'Sophia DaFirst', 'sophia@example.com', '32250170a0dca92d53ec9624f336ca24', 'aesthetician', NULL, NULL),
(26, 'Hale Cesar', 'test@example.com', '32250170a0dca92d53ec9624f336ca24', 'aesthetician', NULL, NULL),
(27, 'hey', 'jaypeee.rocero@yahoo.com', '202cb962ac59075b964b07152d234b70', 'user', NULL, NULL);

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
-- Indexes for table `tblclaimed_rewards`
--
ALTER TABLE `tblclaimed_rewards`
  ADD PRIMARY KEY (`claim_id`);

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
-- Indexes for table `tblrewards`
--
ALTER TABLE `tblrewards`
  ADD PRIMARY KEY (`reward_id`);

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
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=140;

--
-- AUTO_INCREMENT for table `tblavailability`
--
ALTER TABLE `tblavailability`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tblclaimed_rewards`
--
ALTER TABLE `tblclaimed_rewards`
  MODIFY `claim_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

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
-- AUTO_INCREMENT for table `tblrewards`
--
ALTER TABLE `tblrewards`
  MODIFY `reward_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tblservices`
--
ALTER TABLE `tblservices`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
