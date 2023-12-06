-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3333
-- Generation Time: Dec 05, 2023 at 08:15 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `propertydb`
--

-- --------------------------------------------------------

--
-- Table structure for table `buyerinfo`
--

CREATE TABLE `buyerinfo` (
  `BuyerID` int(11) NOT NULL,
  `UserID` int(11) DEFAULT NULL,
  `PropertyID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `listedproperties`
--

CREATE TABLE `listedproperties` (
  `ListingID` int(11) NOT NULL,
  `PropertyID` int(11) DEFAULT NULL,
  `Description` text DEFAULT NULL,
  `Location` varchar(255) NOT NULL,
  `Price` decimal(10,2) DEFAULT NULL,
  `NumberOfBedrooms` int(11) DEFAULT NULL,
  `NumberOfBathrooms` int(11) DEFAULT NULL,
  `SquareFootage` decimal(10,2) DEFAULT NULL,
  `Garden` tinyint(1) DEFAULT NULL,
  `Parking` tinyint(1) DEFAULT NULL,
  `ListingDate` date DEFAULT NULL,
  `Status` enum('available','sold','pending','inactive') DEFAULT 'available'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sellerinfo`
--

CREATE TABLE `sellerinfo` (
  `PropertyID` int(11) NOT NULL,
  `UserID` int(11) DEFAULT NULL,
  `Location` varchar(255) DEFAULT NULL,
  `Age` int(11) DEFAULT NULL,
  `FloorPlan` text DEFAULT NULL,
  `Bedrooms` int(11) DEFAULT NULL,
  `Bathrooms` int(11) DEFAULT NULL,
  `Garden` tinyint(1) DEFAULT NULL,
  `Parking` tinyint(1) DEFAULT NULL,
  `Proximity` text DEFAULT NULL,
  `PropertyTax` decimal(10,2) DEFAULT NULL,
  `ImagePath` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sellerinfo`
--

INSERT INTO `sellerinfo` (`PropertyID`, `UserID`, `Location`, `Age`, `FloorPlan`, `Bedrooms`, `Bathrooms`, `Garden`, `Parking`, `Proximity`, `PropertyTax`, `ImagePath`) VALUES
(1, NULL, '', 0, '', 0, 0, 0, 0, '0', 0.00, 'C:\\xampp\\htdocs\\project4\\salespage'),
(2, NULL, 'Atlanta', 21, 'as', 1, 1, 0, 1, '0', 1.00, 'C:\\xampp\\htdocs\\project4\\salespage');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `UserID` int(11) NOT NULL,
  `FirstName` varchar(50) DEFAULT NULL,
  `LastName` varchar(50) DEFAULT NULL,
  `EmailID` varchar(100) DEFAULT NULL,
  `Username` varchar(50) DEFAULT NULL,
  `Password` varchar(255) DEFAULT NULL,
  `AccountType` enum('free','premium') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`UserID`, `FirstName`, `LastName`, `EmailID`, `Username`, `Password`, `AccountType`) VALUES
(1, 'Chetan', 'Anjana', 'chetananjana75153@gmail.com', 'canjana1', '$2y$10$ZKG3ZsT0kGywpH0DP8cE5OAD96KaamT3MjZ.tikl5y1mhnZU34mQW', 'free'),
(2, 'Chetan', 'Anjana', 'chetananjana75153@gmail.com', 'canjana1', '$2y$10$ZKG3ZsT0kGywpH0DP8cE5OAD96KaamT3MjZ.tikl5y1mhnZU34mQW', 'free');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `buyerinfo`
--
ALTER TABLE `buyerinfo`
  ADD PRIMARY KEY (`BuyerID`),
  ADD KEY `UserID` (`UserID`);

--
-- Indexes for table `listedproperties`
--
ALTER TABLE `listedproperties`
  ADD PRIMARY KEY (`ListingID`),
  ADD KEY `PropertyID` (`PropertyID`);

--
-- Indexes for table `sellerinfo`
--
ALTER TABLE `sellerinfo`
  ADD PRIMARY KEY (`PropertyID`),
  ADD KEY `UserID` (`UserID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`UserID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `buyerinfo`
--
ALTER TABLE `buyerinfo`
  MODIFY `BuyerID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `listedproperties`
--
ALTER TABLE `listedproperties`
  MODIFY `ListingID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sellerinfo`
--
ALTER TABLE `sellerinfo`
  MODIFY `PropertyID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `buyerinfo`
--
ALTER TABLE `buyerinfo`
  ADD CONSTRAINT `buyerinfo_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`);

--
-- Constraints for table `listedproperties`
--
ALTER TABLE `listedproperties`
  ADD CONSTRAINT `listedproperties_ibfk_1` FOREIGN KEY (`PropertyID`) REFERENCES `sellerinfo` (`PropertyID`);

--
-- Constraints for table `sellerinfo`
--
ALTER TABLE `sellerinfo`
  ADD CONSTRAINT `sellerinfo_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
