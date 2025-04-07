-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 17, 2025 at 12:26 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `reservation_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin_credentials`
--

CREATE TABLE `tbl_admin_credentials` (
  `id` int(11) NOT NULL,
  `last_name` varchar(200) NOT NULL,
  `first_name` varchar(200) NOT NULL,
  `middle_name` varchar(200) NOT NULL,
  `email` varchar(250) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_admin_credentials`
--

INSERT INTO `tbl_admin_credentials` (`id`, `last_name`, `first_name`, `middle_name`, `email`, `password`, `role`) VALUES
(1, 'Sardoma', 'Clarisse', 'N/A', 'admin@gmail.com', '$2y$10$I5t6bjKb99eJeDsru0WeseRgxK6aRd6Hnhdhh7.8/21Ojqd0CT8O6', 'Admin');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_reservation`
--

CREATE TABLE `tbl_reservation` (
  `id` int(55) NOT NULL,
  `reservation_id` varchar(55) NOT NULL,
  `email` varchar(250) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `middle_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `age` int(55) NOT NULL,
  `gender` varchar(100) NOT NULL,
  `contact_number` varchar(55) NOT NULL,
  `address` varchar(255) NOT NULL,
  `nationality` varchar(100) NOT NULL,
  `no_of_guest` int(55) NOT NULL,
  `check_in_date` varchar(255) NOT NULL,
  `check_out_date` varchar(255) NOT NULL,
  `check_in_time` varchar(255) NOT NULL,
  `check_out_time` varchar(255) NOT NULL,
  `status` varchar(100) NOT NULL,
  `additional_guests` int(255) NOT NULL,
  `cottage` varchar(255) NOT NULL,
  `rooms` varchar(255) NOT NULL,
  `recreational_activity` varchar(255) NOT NULL,
  `other_amenities` varchar(255) NOT NULL,
  `sub_total` int(55) NOT NULL,
  `total` int(55) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_reservation`
--

INSERT INTO `tbl_reservation` (`id`, `reservation_id`, `email`, `first_name`, `middle_name`, `last_name`, `age`, `gender`, `contact_number`, `address`, `nationality`, `no_of_guest`, `check_in_date`, `check_out_date`, `check_in_time`, `check_out_time`, `status`, `additional_guests`, `cottage`, `rooms`, `recreational_activity`, `other_amenities`, `sub_total`, `total`) VALUES
(1, 'RS_1001', 'Blancaflor480@gmail.com', 'Jaderyan', 'Leba', 'Blancaflor', 22, 'Male', '111', 'C.Gawaran St.', 'filipino', 22, '2025-02-21', '2025-02-21', '10:45', '10:45', 'Cancelled', 111, 'Big Hut', '', 'Banana Boat', 'Catering', 8800, 19900),
(2, 'RS_1002', 'Blancaflor480@gmail.com', 'Jaderyan', 'Leba', 'Blancaflor', 11, 'Male', '09999999999', 'C.Gawaran St.', 'filipino', 22, '2025-02-24', '2025-02-23', '11:52', '11:13', 'Pending', 11, 'Round Picnic Hut', '', '', 'Catering', 7700, 8800),
(3, 'RS_1003', 'Blancaflor480@gmail.com', 'Jaderyan', 'Leba', 'Blancaflor', 11, 'Male', '0938038377', 'C.Gawaran St.', 'Filipino', 9, '2025-02-23', '2025-02-23', '11:59', '02:59', 'Pending', 111, 'Small Hut', '', '', '', 500, 11600);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user_credentials`
--

CREATE TABLE `tbl_user_credentials` (
  `id` int(11) NOT NULL,
  `last_name` varchar(200) NOT NULL,
  `first_name` varchar(200) NOT NULL,
  `middle_name` varchar(200) NOT NULL,
  `email` varchar(250) NOT NULL,
  `password` varchar(255) NOT NULL,
  `otp` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_user_credentials`
--

INSERT INTO `tbl_user_credentials` (`id`, `last_name`, `first_name`, `middle_name`, `email`, `password`, `otp`) VALUES
(1, 'Blancaflor', 'Jaderyan', 'Leba', 'Blancaflor480@gmail.com', '$2y$10$I5t6bjKb99eJeDsru0WeseRgxK6aRd6Hnhdhh7.8/21Ojqd0CT8O6', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_admin_credentials`
--
ALTER TABLE `tbl_admin_credentials`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_reservation`
--
ALTER TABLE `tbl_reservation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_user_credentials`
--
ALTER TABLE `tbl_user_credentials`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_admin_credentials`
--
ALTER TABLE `tbl_admin_credentials`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_reservation`
--
ALTER TABLE `tbl_reservation`
  MODIFY `id` int(55) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_user_credentials`
--
ALTER TABLE `tbl_user_credentials`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
