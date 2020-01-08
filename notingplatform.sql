-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 08, 2020 at 04:58 PM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.1.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `notingplatform`
--

-- --------------------------------------------------------

--
-- Table structure for table `clients_accounts`
--

CREATE TABLE `clients_accounts` (
  `id` int(11) NOT NULL,
  `username` varchar(22) NOT NULL,
  `password` varchar(255) NOT NULL,
  `symbol` varchar(50) NOT NULL,
  `email` varchar(65) NOT NULL,
  `phone` varchar(30) NOT NULL,
  `company` varchar(150) NOT NULL,
  `address` varchar(225) NOT NULL,
  `role` varchar(30) NOT NULL,
  `website` varchar(100) NOT NULL,
  `last_login` int(11) NOT NULL,
  `reg_date` varchar(50) NOT NULL,
  `date_made` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `issuers_accounts`
--

CREATE TABLE `issuers_accounts` (
  `id` int(11) NOT NULL,
  `email` varchar(65) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(200) NOT NULL,
  `company` varchar(150) NOT NULL,
  `role` varchar(30) NOT NULL,
  `reg_date` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `issuers_accounts`
--

INSERT INTO `issuers_accounts` (`id`, `email`, `password`, `name`, `company`, `role`, `reg_date`) VALUES
(1, 'aboajahemmanuel@gmail.com', '$2y$10$YjchbUiGMnAaMKRn0YlEN.MVLNGV5R1Bg7vCmML/jGJdVIdeYjkhK', 'Aboajah Emmanuel', 'IG7UINMJ', 'Legal', '29th  October 2019 02:38:32 PM'),
(2, 'emma@gmail.com', '$2y$10$YjchbUiGMnAaMKRn0YlEN.MVLNGV5R1Bg7vCmML/jGJdVIdeYjkhK', 'EmmanueL', '', 'Audit', '29th  October 2019 02:38:32 PM');

-- --------------------------------------------------------

--
-- Table structure for table `issuers_admin`
--

CREATE TABLE `issuers_admin` (
  `id` int(11) NOT NULL,
  `username` varchar(22) NOT NULL,
  `name` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `symbol` varchar(50) NOT NULL,
  `email` varchar(65) NOT NULL,
  `phone` varchar(30) NOT NULL,
  `company` varchar(150) NOT NULL,
  `address` varchar(225) NOT NULL,
  `role` varchar(30) NOT NULL,
  `website` varchar(100) NOT NULL,
  `last_login` int(11) NOT NULL,
  `reg_date` varchar(50) NOT NULL,
  `date_made` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `issuers_admin`
--

INSERT INTO `issuers_admin` (`id`, `username`, `name`, `password`, `symbol`, `email`, `phone`, `company`, `address`, `role`, `website`, `last_login`, `reg_date`, `date_made`) VALUES
(6, 'super_admin', 'Admin', '$2y$11$ybSv2CIaRMit/RNpXdX4tOwMVvjH6UOPnlMA8H9Dtzuccze19kDXO', 'ADMINCODE', 'it@nasdng.com', '8148242888', '', '9th Floor, UBA House,57 Marina,Lagos,Nigeria.', 'Admin', '', 1570702575, '', 1538988281);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `clients_accounts`
--
ALTER TABLE `clients_accounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `issuers_accounts`
--
ALTER TABLE `issuers_accounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `issuers_admin`
--
ALTER TABLE `issuers_admin`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `clients_accounts`
--
ALTER TABLE `clients_accounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `issuers_accounts`
--
ALTER TABLE `issuers_accounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `issuers_admin`
--
ALTER TABLE `issuers_admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
