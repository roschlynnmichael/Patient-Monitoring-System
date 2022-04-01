-- phpMyAdmin SQL Dump
-- version 5.0.4deb2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 01, 2022 at 11:10 PM
-- Server version: 10.5.12-MariaDB-0+deb11u1
-- PHP Version: 7.4.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `patient_monitoring`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_users`
--

CREATE TABLE `admin_users` (
  `id` int(12) NOT NULL,
  `username` varchar(400) NOT NULL,
  `f_name` varchar(50) NOT NULL,
  `l_name` varchar(50) NOT NULL,
  `password` varchar(400) NOT NULL,
  `email` varchar(400) NOT NULL,
  `address` varchar(400) NOT NULL,
  `phone_number` varchar(40) NOT NULL,
  `activation_code` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Table structure for table `discharged_sensor_data`
--

CREATE TABLE `discharged_sensor_data` (
  `record_no` int(255) NOT NULL,
  `machine_identifier` varchar(255) NOT NULL,
  `temp` varchar(255) NOT NULL,
  `hr` varchar(255) NOT NULL,
  `sys_pressure` varchar(255) NOT NULL,
  `dias_pressure` varchar(255) NOT NULL,
  `oxy_lvl` varchar(255) NOT NULL,
  `verified_by` varchar(255) DEFAULT NULL,
  `date_time` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `discharge_patient_data`
--

CREATE TABLE `discharge_patient_data` (
  `patient_id` varchar(255) NOT NULL,
  `full_name` varchar(400) NOT NULL,
  `address` varchar(1000) NOT NULL,
  `phone_number` varchar(255) NOT NULL,
  `room_no` varchar(255) DEFAULT NULL,
  `bed_no` varchar(255) DEFAULT NULL,
  `dr_incharge` varchar(400) DEFAULT NULL,
  `machine_identifier` varchar(255) DEFAULT NULL,
  `patient_status` varchar(255) NOT NULL DEFAULT 'admitted',
  `admitted_for` varchar(255) NOT NULL,
  `added_by` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `doctor_users`
--

CREATE TABLE `doctor_users` (
  `id` int(12) NOT NULL,
  `username` varchar(400) NOT NULL,
  `f_name` varchar(50) NOT NULL,
  `l_name` varchar(50) NOT NULL,
  `password` varchar(400) NOT NULL,
  `email` varchar(400) NOT NULL,
  `address` varchar(400) NOT NULL,
  `phone_number` varchar(40) NOT NULL,
  `activation_code` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Table structure for table `machine_available`
--

CREATE TABLE `machine_available` (
  `machine_identifier` varchar(255) NOT NULL,
  `availability` varchar(255) NOT NULL DEFAULT 'available'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Table structure for table `patient_data`
--

CREATE TABLE `patient_data` (
  `patient_id` varchar(255) NOT NULL,
  `full_name` varchar(400) NOT NULL,
  `address` varchar(1000) NOT NULL,
  `phone_number` varchar(255) NOT NULL,
  `room_no` varchar(255) DEFAULT NULL,
  `bed_no` varchar(255) DEFAULT NULL,
  `dr_incharge` varchar(400) DEFAULT NULL,
  `machine_identifier` varchar(255) DEFAULT NULL,
  `patient_status` varchar(255) NOT NULL DEFAULT 'admitted',
  `admitted_for` varchar(255) NOT NULL,
  `added_by` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Table structure for table `prescriptions`
--

CREATE TABLE `prescriptions` (
  `patient_id` varchar(255) NOT NULL,
  `prs_id` varchar(255) NOT NULL,
  `given_by` varchar(400) NOT NULL,
  `details` varchar(400) NOT NULL,
  `timestamp` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Table structure for table `room_details`
--

CREATE TABLE `room_details` (
  `machine_identifier` varchar(255) NOT NULL,
  `room_number` varchar(255) NOT NULL,
  `bed_number` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


--
-- Table structure for table `sensor_data`
--

CREATE TABLE `sensor_data` (
  `id` int(255) NOT NULL,
  `machine_identifier` varchar(255) NOT NULL,
  `patient_id` varchar(255) NOT NULL,
  `temp` varchar(255) NOT NULL,
  `hr` varchar(255) NOT NULL,
  `sys_pressure` varchar(255) NOT NULL,
  `dias_pressure` varchar(255) NOT NULL,
  `oxy_lvl` varchar(255) NOT NULL,
  `verified_by` varchar(255) DEFAULT NULL,
  `date_time` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_users`
--
ALTER TABLE `admin_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `doctor_users`
--
ALTER TABLE `doctor_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `machine_available`
--
ALTER TABLE `machine_available`
  ADD UNIQUE KEY `machine_identifier` (`machine_identifier`),
  ADD UNIQUE KEY `machine_identifier_2` (`machine_identifier`);

--
-- Indexes for table `patient_data`
--
ALTER TABLE `patient_data`
  ADD PRIMARY KEY (`patient_id`);

--
-- Indexes for table `prescriptions`
--
ALTER TABLE `prescriptions`
  ADD UNIQUE KEY `prs_id` (`prs_id`);

--
-- Indexes for table `room_details`
--
ALTER TABLE `room_details`
  ADD UNIQUE KEY `machine_identifier` (`machine_identifier`,`room_number`,`bed_number`);

--
-- Indexes for table `sensor_data`
--
ALTER TABLE `sensor_data`
  ADD PRIMARY KEY (`id`),
  ADD KEY `machine_identifier` (`machine_identifier`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_users`
--
ALTER TABLE `admin_users`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `doctor_users`
--
ALTER TABLE `doctor_users`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `sensor_data`
--
ALTER TABLE `sensor_data`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
