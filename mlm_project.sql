-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 27, 2022 at 06:36 PM
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
  `Xname` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
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

-- --------------------------------------------------------

--
-- Table structure for table `x_verification_code`
--

CREATE TABLE `x_verification_code` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `type` varchar(55) DEFAULT NULL,
  `code` varchar(155) DEFAULT NULL,
  `sent_to` varchar(155) DEFAULT NULL,
  `sent_on` varchar(155) DEFAULT NULL,
  `exp_time` varchar(155) DEFAULT NULL,
  `ip_address` varchar(155) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `x_users`
--
ALTER TABLE `x_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `x_verification_code`
--
ALTER TABLE `x_verification_code`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `x_users`
--
ALTER TABLE `x_users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `x_verification_code`
--
ALTER TABLE `x_verification_code`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
