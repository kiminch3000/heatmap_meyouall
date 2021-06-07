-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 17, 2021 at 11:56 AM
-- Server version: 10.4.14-MariaDB-1:10.4.14+maria~bionic-log
-- PHP Version: 7.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Database: `cctv`
--

-- --------------------------------------------------------

--
-- Table structure for table `cctv_01_copy`
--

CREATE TABLE `cctv_01_copy` (
  `NO` int(12) NOT NULL,
  `SERIAL_NO` varchar(255) DEFAULT NULL,
  `AREA_ID` varchar(255) DEFAULT NULL,
  `DATE` varchar(255) DEFAULT NULL,
  `TIME` varchar(255) DEFAULT NULL,
  `OBJECT_TYPE` varchar(255) DEFAULT NULL,
  `OBJECT_ID` varchar(255) DEFAULT NULL,
  `POSITION_X` varchar(255) DEFAULT NULL,
  `POSITION_Y` varchar(255) DEFAULT NULL,
  `HITX` varchar(6) DEFAULT NULL,
  `HITY` varchar(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cctv_01_copy`
--
ALTER TABLE `cctv_01_copy`
  ADD PRIMARY KEY (`NO`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cctv_01_copy`
--
ALTER TABLE `cctv_01_copy`
  MODIFY `NO` int(12) NOT NULL AUTO_INCREMENT;
COMMIT;
