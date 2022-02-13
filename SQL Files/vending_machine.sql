-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 13, 2022 at 02:03 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `vending_machine`
--

-- --------------------------------------------------------

--
-- Table structure for table `beverages`
--

CREATE TABLE `beverages` (
  `id` int(10) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `beverages`
--

INSERT INTO `beverages` (`id`, `name`) VALUES
(1, 'Black Coffee'),
(2, 'Black Coffee (Sugar Free)'),
(3, 'Coffee With Milk'),
(4, 'Coffee With Milk (Sugar Free)');

-- --------------------------------------------------------

--
-- Table structure for table `beverage_ingredient_mapping`
--

CREATE TABLE `beverage_ingredient_mapping` (
  `id` int(10) NOT NULL,
  `beverage_id` int(10) NOT NULL,
  `ingredient_id` int(10) NOT NULL,
  `amount` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `beverage_ingredient_mapping`
--

INSERT INTO `beverage_ingredient_mapping` (`id`, `beverage_id`, `ingredient_id`, `amount`) VALUES
(1, 1, 1, 3),
(2, 1, 2, 1),
(3, 1, 3, 1),
(4, 2, 1, 3),
(5, 2, 3, 1),
(6, 3, 1, 1),
(7, 3, 2, 1),
(8, 3, 3, 1),
(9, 3, 4, 2),
(10, 4, 1, 1),
(11, 4, 3, 1),
(12, 4, 4, 2);

-- --------------------------------------------------------

--
-- Table structure for table `ingredients`
--

CREATE TABLE `ingredients` (
  `id` int(10) NOT NULL,
  `name` varchar(100) NOT NULL,
  `quantity` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ingredients`
--

INSERT INTO `ingredients` (`id`, `name`, `quantity`) VALUES
(1, 'Water', 150),
(2, 'Sugar', 130),
(3, 'Coffee', 140),
(4, 'Milk', 100);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `beverages`
--
ALTER TABLE `beverages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `beverage_ingredient_mapping`
--
ALTER TABLE `beverage_ingredient_mapping`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ingredient table foreign key` (`ingredient_id`),
  ADD KEY `beverege table foreign key` (`beverage_id`);

--
-- Indexes for table `ingredients`
--
ALTER TABLE `ingredients`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `beverages`
--
ALTER TABLE `beverages`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `beverage_ingredient_mapping`
--
ALTER TABLE `beverage_ingredient_mapping`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `ingredients`
--
ALTER TABLE `ingredients`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `beverage_ingredient_mapping`
--
ALTER TABLE `beverage_ingredient_mapping`
  ADD CONSTRAINT `beverege table foreign key` FOREIGN KEY (`beverage_id`) REFERENCES `beverages` (`id`),
  ADD CONSTRAINT `ingredient table foreign key` FOREIGN KEY (`ingredient_id`) REFERENCES `ingredients` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
