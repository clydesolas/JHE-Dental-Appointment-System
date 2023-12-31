-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 29, 2023 at 12:36 AM
-- Server version: 5.6.51-cll-lve
-- PHP Version: 8.1.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `jhedentalclinic`
--

-- --------------------------------------------------------

--
-- Table structure for table `about_us`
--

CREATE TABLE `about_us` (
  `about_id` int(11) NOT NULL,
  `about_details` varchar(50000) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `about_us`
--

INSERT INTO `about_us` (`about_id`, `about_details`) VALUES
(1, 'J.H.E. Dental Clinic started on September 18, 2021. The dental clinic is managed by Dr. Jemaylyn Rose Ave Gamutuan, the owner, along with her two assistants, Erica Jane Ave and Jeramie Flogencio. Like any other business, J.H.E. Dental Clinic started from scratch. They began with limited resources and services. The determination of Dr. Jemaylyn to build the clinic slowly paid off. As time passes, the clinic is able to acquire every tool required to perform the operations requested by the client. ');

-- --------------------------------------------------------

--
-- Table structure for table `admindb`
--

CREATE TABLE `admindb` (
  `id` int(11) NOT NULL,
  `username` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `mname` varchar(250) NOT NULL,
  `lname` varchar(250) NOT NULL,
  `position` varchar(250) NOT NULL,
  `available` varchar(255) DEFAULT NULL,
  `email` varchar(250) NOT NULL,
  `contact` bigint(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admindb`
--

INSERT INTO `admindb` (`id`, `username`, `password`, `fname`, `mname`, `lname`, `position`, `available`, `email`, `contact`) VALUES
(5, 'Jaiegamutan08', '129722c402366ccaec635b9186f08013', 'Jemaylyn Rose', 'Ave ', 'Gamutan', 'Doctor', 'Yes', 'jhedental@gmail.com', 9196177260),
(9, 'JeramFlogencio', '129722c402366ccaec635b9186f08013', 'JERAMAE', 'CALIZA', 'FLOGENCIO', 'Assistant', ' ', 'flogencio02@gmail.com', 9677132244),
(10, 'Developer', '81dc9bdb52d04dc20036dbd8313ed055', 'Faith', 'T', 'Maquerme', 'Assistant', '', 'maquermefaith@gmail.com', 9156050275);

-- --------------------------------------------------------

--
-- Table structure for table `announcement`
--

CREATE TABLE `announcement` (
  `announce_id` int(11) NOT NULL,
  `announce_details` varchar(60000) NOT NULL,
  `announce_date` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `appointment`
--

CREATE TABLE `appointment` (
  `sched_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `service_id` int(11) NOT NULL,
  `doctor` varchar(255) NOT NULL,
  `applyDate` datetime NOT NULL,
  `start_event` datetime NOT NULL,
  `end_event` datetime NOT NULL,
  `number` int(10) NOT NULL,
  `status` varchar(100) NOT NULL,
  `remark` varchar(500) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `jhedetails`
--

CREATE TABLE `jhedetails` (
  `details_id` int(11) NOT NULL,
  `contact` bigint(11) NOT NULL,
  `email` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jhedetails`
--

INSERT INTO `jhedetails` (`details_id`, `contact`, `email`) VALUES
(1, 9196177260, 'jhedental@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `medicalhistory`
--

CREATE TABLE `medicalhistory` (
  `medicalHistory_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `generalHealth` varchar(500) DEFAULT NULL,
  `existingIllness` varchar(500) DEFAULT NULL,
  `medicine` varchar(500) DEFAULT NULL,
  `allergies` varchar(500) DEFAULT NULL,
  `bloodPressure` varchar(500) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `medicalhistory`
--

INSERT INTO `medicalhistory` (`medicalHistory_id`, `user_id`, `generalHealth`, `existingIllness`, `medicine`, `allergies`, `bloodPressure`) VALUES
(107, 158, NULL, NULL, NULL, NULL, NULL),
(106, 157, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `service_id` int(11) NOT NULL,
  `service` varchar(250) NOT NULL,
  `service_imgpath` varchar(500) NOT NULL,
  `description` varchar(500) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`service_id`, `service`, `service_imgpath`, `description`) VALUES
(65, 'Metal Braces', '', ''),
(67, 'Ceramic Braces', '', ''),
(68, 'Self Ligating Braces', '', ''),
(69, 'Oral Prophylaxis/ Cleaning', 'OralProphylaxisTeethCleaning.png', ''),
(86, 'Restoration/Pasta', 'RestorationToothFilling.png', ''),
(87, 'Extraction', 'OralSurgeryToothExtraction.png', ''),
(88, '3rd Molar/ Wisdom Tooth Removal', '', ''),
(89, 'Removable Partial Denture', '', ''),
(90, 'Complete Denture', 'DentalProsthesisDentures.png', ''),
(91, 'Fixed Bridge/ Crown', 'CrownAndBridges.png', ''),
(92, 'Cosmetic Dentistry Veneers', '', ''),
(93, 'Root Canal Therapy', 'RootCanalTherapy.png', ''),
(94, 'Teeth Whitening', 'TeethWhitening.png', 'N/A'),
(95, 'Braces Adjustment', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `fname` varchar(250) NOT NULL,
  `mname` varchar(250) NOT NULL,
  `lname` varchar(250) NOT NULL,
  `birthday` date NOT NULL,
  `sex` varchar(100) NOT NULL,
  `contact` bigint(20) NOT NULL,
  `regdate` date DEFAULT NULL,
  `email` varchar(250) NOT NULL,
  `email_verification_link` varchar(255) NOT NULL,
  `pass` varchar(300) NOT NULL,
  `changepassToken` varchar(500) DEFAULT NULL,
  `otp` varchar(10) DEFAULT NULL,
  `expiration_time` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `fname`, `mname`, `lname`, `birthday`, `sex`, `contact`, `regdate`, `email`, `email_verification_link`, `pass`, `changepassToken`, `otp`, `expiration_time`) VALUES
(157, 'FAITH', 'TALIMUDAO', 'MAQUERME', '2002-01-21', 'FEMALE', 9156050275, '2023-11-04', 'maquermefaith@gmail.com', '', 'bec2e56d36916b1059df0c7d71ea9bef', NULL, ' ', '0000-00-00 00:00:00'),
(158, 'KEN', 'GARCIA', 'TAPAWAN', '2000-10-09', 'MALE', 9613881809, NULL, 'tapawan555@gmail.com', '', 'fa9d2cef8a4b2c160a63c27b9a0709d2', NULL, '977489', '2023-07-28 07:31:59');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `about_us`
--
ALTER TABLE `about_us`
  ADD PRIMARY KEY (`about_id`);

--
-- Indexes for table `admindb`
--
ALTER TABLE `admindb`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `announcement`
--
ALTER TABLE `announcement`
  ADD PRIMARY KEY (`announce_id`);

--
-- Indexes for table `appointment`
--
ALTER TABLE `appointment`
  ADD PRIMARY KEY (`sched_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `service_id` (`service_id`);

--
-- Indexes for table `jhedetails`
--
ALTER TABLE `jhedetails`
  ADD PRIMARY KEY (`details_id`);

--
-- Indexes for table `medicalhistory`
--
ALTER TABLE `medicalhistory`
  ADD PRIMARY KEY (`medicalHistory_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`service_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `about_us`
--
ALTER TABLE `about_us`
  MODIFY `about_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `admindb`
--
ALTER TABLE `admindb`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `announcement`
--
ALTER TABLE `announcement`
  MODIFY `announce_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `appointment`
--
ALTER TABLE `appointment`
  MODIFY `sched_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `jhedetails`
--
ALTER TABLE `jhedetails`
  MODIFY `details_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `medicalhistory`
--
ALTER TABLE `medicalhistory`
  MODIFY `medicalHistory_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=108;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `service_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=159;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
