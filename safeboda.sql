-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 20, 2020 at 10:44 PM
-- Server version: 10.1.35-MariaDB
-- PHP Version: 7.2.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `safeboda`
--

-- --------------------------------------------------------

--
-- Table structure for table `promo_codes`
--

CREATE TABLE `promo_codes` (
  `p_id` int(11) NOT NULL,
  `p_event_name` varchar(100) NOT NULL,
  `p_event_venue` varchar(100) NOT NULL,
  `p_promo_code` varchar(100) NOT NULL,
  `p_minamount` varchar(100) NOT NULL,
  `p_isactive` varchar(100) NOT NULL DEFAULT '1',
  `p_radius` varchar(100) NOT NULL,
  `p_validtill` varchar(100) NOT NULL,
  `p_created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `p_modified_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `promo_codes`
--

INSERT INTO `promo_codes` (`p_id`, `p_event_name`, `p_event_venue`, `p_promo_code`, `p_minamount`, `p_isactive`, `p_radius`, `p_validtill`, `p_created_date`, `p_modified_date`) VALUES
(1, 'asda', 'sdasd', 'asd', 'asd', '0', 'asdas', 'asdasd', '2020-11-20 23:37:00', '2020-11-20 18:55:37'),
(2, 'asda', 'sdasd', 'asd', 'asd', '0', 'asdas', 'asdasd', '2020-11-20 23:37:13', '2020-11-20 18:58:50'),
(3, 'asda', 'sdasd', 'asd', 'asasd', '1', 'asdas', '2020-12-11', '2020-11-20 23:46:02', '2020-11-20 19:48:29'),
(4, 'asda', 'sdasd', 'asd', 'asasd', '1', 'asdas', '2019-12-11', '2020-11-20 23:46:06', '2020-11-20 19:48:17'),
(5, 'asda', 'sdasd', 'asdaa', 'asasd', '1', 'asdas', '2019-12-11', '2020-11-21 01:03:38', '2020-11-20 19:33:38');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `promo_codes`
--
ALTER TABLE `promo_codes`
  ADD PRIMARY KEY (`p_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `promo_codes`
--
ALTER TABLE `promo_codes`
  MODIFY `p_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
