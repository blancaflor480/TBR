-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 18, 2024 at 10:21 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

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
  `username` varchar(15) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_admin_credentials`
--

INSERT INTO `tbl_admin_credentials` (`id`, `last_name`, `first_name`, `middle_name`, `username`, `password`) VALUES
(1, 'admin', 'admin', 'admin', 'admin', '$2y$10$lvBXIolFQqmeHJzhjo06BOsa5UiUtE42w78ziu9tdhghlR/Ynswzu'),
(2, 'lastica', 'mark', 'aldrin', 'user', 'user'),
(10, 'test', 'test', 'test', 'test', '$2y$10$RbK1Wnt7VAMB7p6RSiDBq.jHOYLkgIIUxg.c/Rnz0eqqlPXd/lulO');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_reservation`
--

CREATE TABLE `tbl_reservation` (
  `id` int(55) NOT NULL,
  `reservation_id` varchar(55) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `middle_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `age` int(55) NOT NULL,
  `gender` varchar(100) NOT NULL,
  `contact_number` int(55) NOT NULL,
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

INSERT INTO `tbl_reservation` (`id`, `reservation_id`, `first_name`, `middle_name`, `last_name`, `age`, `gender`, `contact_number`, `address`, `nationality`, `no_of_guest`, `check_in_date`, `check_out_date`, `check_in_time`, `check_out_time`, `status`, `additional_guests`, `cottage`, `rooms`, `recreational_activity`, `other_amenities`, `sub_total`, `total`) VALUES
(1, '1215240001', '321321', '321321', '321321', 2, 'Male', 321321, '321321', '321321', 2, '2024-12-15', '2024-12-15', '321321', '321321321321', '321321', 321321, 'Small Hut', 'Aircon Room (Standard)', 'Island Hopping', 'Light and Sounds Rental', 321321, 321321),
(2, '1215240002', '1200', '12001200', '1200', 20, '1200', 1200, '1200', '1200', 20, '2024-12-16', '2024-12-16', '1200', '1200', '1200', 1200, 'Small Hut', 'Aircon Room (Family)', 'Banana Boat', 'Catering', 1400, 1200),
(3, '', '1200', '1200', '1200', 2, '1200', 1200, '1200', '1200', 2, '2024-12-15', '2024-12-15', '12:00', '1200', '1200', 1200, 'Small Hut', 'Aircon Room (Standard)', 'Island Hopping', 'Light and Sounds Rental', 1200, 1200),
(4, '', 'asdassa', 'asdassa', 'asdassa', 2, 'Male', 3213131, 'asdassa', 'asdassa', 2, '2024-12-15', '2024-12-15', 'asdassa', 'asdassa', 'asdassa', 4242, 'Pavillion', 'Aircon Room (Family)', 'Banana Boat', 'Catering', 4242, 4242),
(5, '', 'mark', 'aldrin', 'lastica', 2, 'Male', 912345, '123 victoria st', 'filipino', 2, '2024-12-15', '2024-12-15', '12:00', '12:00', 'reserved', 2, 'Pavillion', 'Aircon Room (Family)', 'Island Hopping', 'Catering', 1200, 1200),
(6, '', '4242', '4242', '4242', 100, '4242', 4242, '4242', '4242', 100, '2024-12-15', '2024-12-15', '4242', '42424242', '4242', 4242, 'Pavillion', 'Aircon Room (Family)', 'Banana Boat', 'Catering', 4242, 4242),
(7, '', '4242', '4242', '4242', 100, '4242', 4242, '4242', '4242', 100, '2024-12-15', '2024-12-15', '4242', '4242', '42424242', 4242, 'Pavillion', 'Aircon Room (Family)', 'Banana Boat', 'Catering', 4242, 4242),
(8, '', 'asdas', 'asas', 'asdasda', 20, '4242', 4214214, 'asad', 'asas', 20, '2024-12-15', '2024-12-15', '4242', '4242', 'reserfe', 2, 'Pavillion', 'Aircon Room (Standard)', 'Banana Boat', 'Light and Sounds Rental', 4242, 4242),
(9, '123132', 'Mark', 'Alddrin', 'Lastica', 9123, 'Male', 9123456, '1145 DM Compound', 'Filipino', 4, '2024-12-15', '2024-12-15', '12:00', '12:00', 'Reserved', 2, 'Pavillon', 'Aircon Room Family (2000)', 'Banana Boat', 'Catering', 1400, 1400),
(10, '4124214', '54252', '5425254252', '54252', 54252, '54252', 54252, '54252', '54252', 5, '54252', '54252', '54252', '54252', '54252', 54252, 'Array', 'Array', 'Array', 'Array', 54252, 54252),
(11, '2142144', '2142144', '2142144', '2142144', 2142144, '2142144', 2142144, '2142144', '2142144', 2142144, '2142144', '2142144', '2142144', '2142144', '2142144', 2142144, 'Pavillion', 'Aircon Room (Family)', 'Banana Boat', 'Catering', 2142144, 2142144),
(12, '555', '555', '555', '555', 555, '555', 555, '555', '555', 555, '555', '555', '555', '555', '555', 555, 'Pavillion', 'Aircon Room (Family)', 'Banana Boat', 'Catering', 555, 555);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user_credentials`
--

CREATE TABLE `tbl_user_credentials` (
  `id` int(11) NOT NULL,
  `last_name` varchar(200) NOT NULL,
  `first_name` varchar(200) NOT NULL,
  `middle_name` varchar(200) NOT NULL,
  `username` varchar(15) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_user_credentials`
--

INSERT INTO `tbl_user_credentials` (`id`, `last_name`, `first_name`, `middle_name`, `username`, `password`) VALUES
(1, 'user', 'user', 'users', 'user', '$2y$10$MOOOrssDON3cK3b8a6Ehxeu.sQwBhjs86g/H0G2.T9lV6q2ooQuxO'),
(2, 'awa', 'awa', 'awa', 'awa', 'awa'),
(7, 'test', 'test', 'test', 'test', '$2y$10$KyiUOK8.t.R0E7rFRcP9PuxutEHOaSWMX6rN1uyQwZQIy2t0vXAwC');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tbl_reservation`
--
ALTER TABLE `tbl_reservation`
  MODIFY `id` int(55) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tbl_user_credentials`
--
ALTER TABLE `tbl_user_credentials`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
