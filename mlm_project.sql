-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 26, 2022 at 05:05 PM
-- Server version: 8.0.30-0ubuntu0.20.04.2
-- PHP Version: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mlm_project`
--

-- --------------------------------------------------------

--
-- Table structure for table `x_forget_passwords`
--

CREATE TABLE `x_forget_passwords` (
  `id` int NOT NULL,
  `Xuser_id` int NOT NULL,
  `Xis_reset_at` date DEFAULT NULL,
  `Xisdeleted` int DEFAULT NULL,
  `sql_row_created_ts` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `sql_row_updated_ts` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `x_users`
--

CREATE TABLE `x_users` (
  `id` int NOT NULL,
  `Xname` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `Xemail` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `Xpassword` varchar(221) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `Xverification_code` varchar(21) DEFAULT NULL,
  `Xemail_verified_at` int DEFAULT '0',
  `Xremember_me` int NOT NULL DEFAULT '0',
  `Xcountry_code` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `Xmobile` varchar(21) DEFAULT NULL,
  `Xavatar` varchar(220) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `Xdeposit_address` varchar(455) DEFAULT NULL,
  `Xwallet_balance` decimal(10,2) NOT NULL DEFAULT '0.00',
  `Xcountry` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `Xgender` set('M','F','O') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL COMMENT 'M=male,F=Female,O=other',
  `Xdob` varchar(122) DEFAULT NULL,
  `Xreferral_code` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `Xstatus` int NOT NULL DEFAULT '0',
  `Xisblocked` int DEFAULT NULL,
  `Xisdeleted` int DEFAULT NULL,
  `sql_row_created_ts` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `sql_row_updated_ts` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `x_users`
--

INSERT INTO `x_users` (`id`, `Xname`, `Xemail`, `Xpassword`, `Xverification_code`, `Xemail_verified_at`, `Xremember_me`, `Xcountry_code`, `Xmobile`, `Xavatar`, `Xdeposit_address`, `Xwallet_balance`, `Xcountry`, `Xgender`, `Xdob`, `Xreferral_code`, `Xstatus`, `Xisblocked`, `Xisdeleted`, `sql_row_created_ts`, `sql_row_updated_ts`) VALUES
(8, 'kumar', 'kumar@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '673433', NULL, 0, NULL, '9142627909', NULL, NULL, '0.00', NULL, '', '', NULL, 0, NULL, NULL, '2022-12-26 09:25:07', '2022-12-26 09:25:07'),
(9, 'kumar', 'kumar@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '273808', NULL, 0, NULL, '9142627909', NULL, NULL, '0.00', NULL, 'M', '02-12-1991', NULL, 0, NULL, NULL, '2022-12-26 09:25:54', '2022-12-26 09:25:54'),
(10, 'kumar', 'kumar@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '678277', NULL, 0, NULL, '9142627909', NULL, NULL, '0.00', NULL, 'M', '02-12-1991', NULL, 0, NULL, NULL, '2022-12-26 09:44:20', '2022-12-26 09:44:20'),
(11, 'kumar', 'kumar1@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '930426', NULL, 0, NULL, '9142627909', NULL, NULL, '0.00', NULL, 'M', '02-12-1991', NULL, 0, NULL, NULL, '2022-12-26 09:47:43', '2022-12-26 09:47:43'),
(12, 'kumar', 'kumar@gmail.coma', 'e10adc3949ba59abbe56e057f20f883e', '908564', NULL, 0, NULL, '9142627909', NULL, NULL, '0.00', NULL, 'M', '02-12-1991', NULL, 0, NULL, NULL, '2022-12-26 09:51:37', '2022-12-26 09:51:37'),
(13, 'kumar', 'kbumar@gmail.com', '123456', '503302', NULL, 0, NULL, '9142627909', NULL, NULL, '0.00', NULL, 'M', '02-12-1991', NULL, 0, NULL, NULL, '2022-12-26 10:53:44', '2022-12-26 10:53:44');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `x_users`
--
ALTER TABLE `x_users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `x_users`
--
ALTER TABLE `x_users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
