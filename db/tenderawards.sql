-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 19, 2020 at 01:34 PM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.2.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
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
-- Table structure for table `tenderawards`
--

CREATE TABLE `tenderawards` (
  `id` int(11) NOT NULL,
  `tenderid` varchar(300) DEFAULT NULL,
  `participant` varchar(300) DEFAULT NULL,
  `participant2` varchar(300) DEFAULT NULL,
  `participant3` varchar(300) DEFAULT NULL,
  `finalscore` varchar(300) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tenderawards`
--

INSERT INTO `tenderawards` (`id`, `tenderid`, `participant`, `participant2`, `participant3`, `finalscore`, `created_at`, `updated_at`) VALUES
(4, '1', '2', '3', '3', '80', '2020-07-19 11:32:55', '2020-07-19 11:32:55');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tenderawards`
--
ALTER TABLE `tenderawards`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tenderawards`
--
ALTER TABLE `tenderawards`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
