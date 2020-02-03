-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 03, 2020 at 11:31 AM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `statusgear`
--

-- --------------------------------------------------------

--
-- Table structure for table `associatepartners`
--

CREATE TABLE `associatepartners` (
  `id` int(10) UNSIGNED NOT NULL,
  `associatepartnername` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `officeaddress` text COLLATE utf8mb4_unicode_ci,
  `contact1` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact2` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `officecontact` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gstn` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `panno` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dist` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `state` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `additionalinfo` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `associatepartners`
--

INSERT INTO `associatepartners` (`id`, `associatepartnername`, `officeaddress`, `contact1`, `contact2`, `officecontact`, `email`, `gstn`, `panno`, `city`, `dist`, `state`, `country`, `additionalinfo`, `created_at`, `updated_at`) VALUES
(1, 'hello', 'hello1', '9485658562', '9856584542', '9856523523', 'subham@gmail.com', 'xcxzc', 'zxcxz', 'zxcx', 'zxc', 'zxcxz', 'zxcxzc', 'zxcxzc', '2020-02-03 06:47:16', '2020-02-03 10:30:03'),
(2, 'hari', 'bbsr', NULL, NULL, NULL, NULL, NULL, NULL, 'bbsr', 'fdfdsf', 'dsfdsf', 'sdfdsf', NULL, '2020-02-03 06:48:50', '2020-02-03 06:48:50'),
(3, 'Raz', 'BBSR', '9856523251', '9865584541', '9562562528', 'subham@gmail.com', 'xcxzc', 'zxcxz', 'xzcxzc', 'zxc', 'zxcxz', 'sdfdsf', 'VCXVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVXVXVXCV', '2020-02-03 09:09:48', '2020-02-03 09:16:55');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `associatepartners`
--
ALTER TABLE `associatepartners`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `associatepartners`
--
ALTER TABLE `associatepartners`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
