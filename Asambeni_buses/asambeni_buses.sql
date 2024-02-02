-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 02, 2024 at 02:37 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `asambeni_buses`
--

-- --------------------------------------------------------

--
-- Table structure for table `buscompanies`
--

CREATE TABLE `buscompanies` (
  `company_id` int(11) NOT NULL,
  `company_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `buscompanies`
--

INSERT INTO `buscompanies` (`company_id`, `company_name`) VALUES
(1, 'Greyhound'),
(2, 'Intercape'),
(3, 'Intercity');

-- --------------------------------------------------------

--
-- Table structure for table `companyimages`
--

CREATE TABLE `companyimages` (
  `image_id` int(11) NOT NULL,
  `company_id` int(11) DEFAULT NULL,
  `image_name` varchar(255) NOT NULL,
  `image_extension` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `companyimages`
--

INSERT INTO `companyimages` (`image_id`, `company_id`, `image_name`, `image_extension`) VALUES
(1, 1, 'learninghub2/Asambeni_buses/images/greyhound', 'jpg'),
(2, 1, 'learninghub2/Asambeni_buses/images/intercape', 'jpg'),
(3, 2, 'learninghub2/Asambeni_buses/images/intercapedoubledeck', 'jpg'),
(4, 3, 'learninghub2/Asambeni_buses/images/intercity', 'jpg'),
(5, 3, 'learninghub2/Asambeni_buses/images/intercityexterior', 'jpg');

-- --------------------------------------------------------

--
-- Table structure for table `routes`
--

CREATE TABLE `routes` (
  `route_id` int(11) NOT NULL,
  `company_id` int(11) DEFAULT NULL,
  `departing_city` varchar(255) NOT NULL,
  `destination_city` varchar(255) NOT NULL,
  `departure_time` time NOT NULL,
  `arrival_time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `routes`
--

INSERT INTO `routes` (`route_id`, `company_id`, `departing_city`, `destination_city`, `departure_time`, `arrival_time`) VALUES
(1, 1, 'Johannesburg', 'Cape Town', '02:00:00', '23:30:00'),
(2, 1, 'Johannesburg', 'Durban', '05:00:00', '17:00:00'),
(3, 2, 'Cape Town', 'Johannesburg', '09:00:00', '16:00:00'),
(4, 2, 'Polokwane', 'Johannesburg', '09:00:00', '14:00:00'),
(5, 3, 'East London', 'Pretoria', '09:00:00', '14:00:00'),
(6, 3, 'Durban', 'Port Elizabeth', '10:00:00', '18:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `buscompanies`
--
ALTER TABLE `buscompanies`
  ADD PRIMARY KEY (`company_id`);

--
-- Indexes for table `companyimages`
--
ALTER TABLE `companyimages`
  ADD PRIMARY KEY (`image_id`),
  ADD KEY `company_id` (`company_id`);

--
-- Indexes for table `routes`
--
ALTER TABLE `routes`
  ADD PRIMARY KEY (`route_id`),
  ADD KEY `company_id` (`company_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `buscompanies`
--
ALTER TABLE `buscompanies`
  MODIFY `company_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `companyimages`
--
ALTER TABLE `companyimages`
  MODIFY `image_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `routes`
--
ALTER TABLE `routes`
  MODIFY `route_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `companyimages`
--
ALTER TABLE `companyimages`
  ADD CONSTRAINT `companyimages_ibfk_1` FOREIGN KEY (`company_id`) REFERENCES `buscompanies` (`company_id`);

--
-- Constraints for table `routes`
--
ALTER TABLE `routes`
  ADD CONSTRAINT `routes_ibfk_1` FOREIGN KEY (`company_id`) REFERENCES `buscompanies` (`company_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
