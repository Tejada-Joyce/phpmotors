-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 11, 2020 at 12:06 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `phpmotors`
--

-- --------------------------------------------------------

--
-- Table structure for table `carclassification`
--

CREATE TABLE `carclassification` (
  `classificationId` int(11) NOT NULL,
  `classificationName` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `carclassification`
--

INSERT INTO `carclassification` (`classificationId`, `classificationName`) VALUES
(1, 'SUV'),
(2, 'Classic'),
(3, 'Sports'),
(4, 'Trucks'),
(5, 'Used');

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `clientId` int(10) UNSIGNED NOT NULL,
  `clientFirstname` varchar(15) NOT NULL,
  `clientLastname` varchar(25) NOT NULL,
  `clientEmail` varchar(40) NOT NULL,
  `clientPassword` varchar(255) NOT NULL,
  `clientLevel` enum('1','2','3') NOT NULL DEFAULT '1',
  `comment` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`clientId`, `clientFirstname`, `clientLastname`, `clientEmail`, `clientPassword`, `clientLevel`, `comment`) VALUES
(1, 'Mary', 'Jones', 'mjones@cccc.com', '$2y$10$3mzNp5DsO5qtw7i.FwfjjO4RkW9I4F5bu0vJd8PQ9ZYolSkFvCKJm', '1', NULL),
(2, 'Robert', 'Suarez', 'rsuarez@cccc.com', '$2y$10$DtpPPlh9aW7OJ01ES2pC9eEKFzMkDsc5vjamXihUzm4ik0cdLtWfq', '1', NULL),
(3, 'Steve', 'Brown', 'sbrown@cccc.com', '$2y$10$KJ0tOYxJiXQTp..99Yiz0.amTHFAvZQbuyB83zhMfvBq61OmCiOsC', '1', NULL),
(5, 'Carl', 'Dallas', 'cdallas@cccc.com', '$2y$10$26jl0HP3sGUwTehTwYzXN.TtHRhkbGPzyFyKSI6Pcr9gr/uhbpqdy', '1', NULL),
(6, 'Admin', 'User', 'admin@cit340.net', '$2y$10$zJlL.ZYFgEHDaqJ.vASMSuFnFZa5BUkHj71duOIDKYbDmyE8hcCky', '3', NULL),
(7, 'Lucero', 'Stewart', 'lstewart@cccc.com', '$2y$10$Rpgbis4U.J8uI8aIAohOgOQzV1TKf/pQQQYhsP2h8Lk67nECFCgRS', '1', NULL),
(8, 'Paul', 'Rogers', 'progers@cccc.com', '$2y$10$8NjMNRUiYvkPPFsr7IeHzu1/Ug3X2bYHOHU9gbJFVxZp.GjoWn4Qq', '1', NULL),
(9, 'Anna', 'Garcia', 'agarcia@cccc.com', '$2y$10$StNN5udNLLhGuXqz/jSHxuo2BFj2pdY7b71/Q/7Wztr/6Hwz7aDSO', '1', NULL),
(10, 'Rose', 'Parker', 'rparker@cccc.com', '$2y$10$o6E/l0HVcBt2l5vwHng63.TNCPk138yBdzFSHpim1k.0CAlZQpWnu', '1', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `imgId` int(10) UNSIGNED NOT NULL,
  `invId` int(10) UNSIGNED NOT NULL,
  `imgName` varchar(100) CHARACTER SET latin1 NOT NULL,
  `imgPath` varchar(150) CHARACTER SET latin1 NOT NULL,
  `imgDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `imgPrimary` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`imgId`, `invId`, `imgName`, `imgPath`, `imgDate`, `imgPrimary`) VALUES
(1, 1, 'wrangler.jpg', '/phpmotors/images/vehicles/wrangler.jpg', '2020-11-24 15:06:18', 1),
(2, 1, 'wrangler-tn.jpg', '/phpmotors/images/vehicles/wrangler-tn.jpg', '2020-11-24 15:06:18', 1),
(3, 2, 'model-t.jpg', '/phpmotors/images/vehicles/model-t.jpg', '2020-11-24 15:07:10', 1),
(4, 2, 'model-t-tn.jpg', '/phpmotors/images/vehicles/model-t-tn.jpg', '2020-11-24 15:07:10', 1),
(5, 3, 'adventador.jpg', '/phpmotors/images/vehicles/adventador.jpg', '2020-11-24 15:07:26', 1),
(6, 3, 'adventador-tn.jpg', '/phpmotors/images/vehicles/adventador-tn.jpg', '2020-11-24 15:07:26', 1),
(7, 4, 'monster-truck.jpg', '/phpmotors/images/vehicles/monster-truck.jpg', '2020-11-24 15:07:48', 1),
(8, 4, 'monster-truck-tn.jpg', '/phpmotors/images/vehicles/monster-truck-tn.jpg', '2020-11-24 15:07:48', 1),
(9, 5, 'mechanic.jpg', '/phpmotors/images/vehicles/mechanic.jpg', '2020-11-24 15:08:09', 1),
(10, 5, 'mechanic-tn.jpg', '/phpmotors/images/vehicles/mechanic-tn.jpg', '2020-11-24 15:08:09', 1),
(11, 6, 'batmobile.jpg', '/phpmotors/images/vehicles/batmobile.jpg', '2020-11-24 15:08:27', 1),
(12, 6, 'batmobile-tn.jpg', '/phpmotors/images/vehicles/batmobile-tn.jpg', '2020-11-24 15:08:27', 1),
(13, 7, 'mystery-van.jpg', '/phpmotors/images/vehicles/mystery-van.jpg', '2020-11-24 15:08:46', 1),
(14, 7, 'mystery-van-tn.jpg', '/phpmotors/images/vehicles/mystery-van-tn.jpg', '2020-11-24 15:08:46', 1),
(15, 8, 'fire-truck.jpg', '/phpmotors/images/vehicles/fire-truck.jpg', '2020-11-24 15:09:29', 1),
(16, 8, 'fire-truck-tn.jpg', '/phpmotors/images/vehicles/fire-truck-tn.jpg', '2020-11-24 15:09:29', 1),
(17, 9, 'crwn-vic.jpg', '/phpmotors/images/vehicles/crwn-vic.jpg', '2020-11-24 15:09:56', 1),
(18, 9, 'crwn-vic-tn.jpg', '/phpmotors/images/vehicles/crwn-vic-tn.jpg', '2020-11-24 15:09:56', 1),
(19, 10, 'camaro.jpg', '/phpmotors/images/vehicles/camaro.jpg', '2020-11-24 15:10:12', 1),
(20, 10, 'camaro-tn.jpg', '/phpmotors/images/vehicles/camaro-tn.jpg', '2020-11-24 15:10:12', 1),
(21, 11, 'escalade.jpg', '/phpmotors/images/vehicles/escalade.jpg', '2020-11-24 15:10:30', 1),
(22, 11, 'escalade-tn.jpg', '/phpmotors/images/vehicles/escalade-tn.jpg', '2020-11-24 15:10:30', 1),
(23, 12, 'hummer.jpg', '/phpmotors/images/vehicles/hummer.jpg', '2020-11-24 15:10:49', 1),
(24, 12, 'hummer-tn.jpg', '/phpmotors/images/vehicles/hummer-tn.jpg', '2020-11-24 15:10:49', 1),
(25, 13, 'aerocar.jpg', '/phpmotors/images/vehicles/aerocar.jpg', '2020-11-24 15:11:09', 1),
(26, 13, 'aerocar-tn.jpg', '/phpmotors/images/vehicles/aerocar-tn.jpg', '2020-11-24 15:11:10', 1),
(27, 14, 'van.jpg', '/phpmotors/images/vehicles/van.jpg', '2020-11-24 15:11:33', 1),
(28, 14, 'van-tn.jpg', '/phpmotors/images/vehicles/van-tn.jpg', '2020-11-24 15:11:33', 1),
(29, 15, 'dog.jpg', '/phpmotors/images/vehicles/dog.jpg', '2020-11-24 15:11:51', 1),
(30, 15, 'dog-tn.jpg', '/phpmotors/images/vehicles/dog-tn.jpg', '2020-11-24 15:11:51', 1),
(31, 16, 'citroen.jpg', '/phpmotors/images/vehicles/citroen.jpg', '2020-11-24 15:24:45', 1),
(32, 16, 'citroen-tn.jpg', '/phpmotors/images/vehicles/citroen-tn.jpg', '2020-11-24 15:24:45', 1),
(35, 17, 'delorean.jpg', '/phpmotors/images/vehicles/delorean.jpg', '2020-11-24 15:40:30', 1),
(36, 17, 'delorean-tn.jpg', '/phpmotors/images/vehicles/delorean-tn.jpg', '2020-11-24 15:40:30', 1),
(39, 12, 'gm-h.jpg', '/phpmotors/images/vehicles/gm-h.jpg', '2020-11-24 16:06:37', 0),
(40, 12, 'gm-h-tn.jpg', '/phpmotors/images/vehicles/gm-h-tn.jpg', '2020-11-24 16:06:37', 0),
(41, 8, 'fire.jpg', '/phpmotors/images/vehicles/fire.jpg', '2020-11-24 16:08:13', 0),
(42, 8, 'fire-tn.jpg', '/phpmotors/images/vehicles/fire-tn.jpg', '2020-11-24 16:08:13', 0),
(45, 3, 'lamborghini.jpg', '/phpmotors/images/vehicles/lamborghini.jpg', '2020-11-24 17:12:38', 0),
(46, 3, 'lamborghini-tn.jpg', '/phpmotors/images/vehicles/lamborghini-tn.jpg', '2020-11-24 17:12:39', 0),
(47, 1, 'j-wrangler.jpg', '/phpmotors/images/vehicles/j-wrangler.jpg', '2020-11-26 22:44:36', 0),
(48, 1, 'j-wrangler-tn.jpg', '/phpmotors/images/vehicles/j-wrangler-tn.jpg', '2020-11-26 22:44:36', 0);

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

CREATE TABLE `inventory` (
  `invId` int(10) UNSIGNED NOT NULL,
  `invMake` varchar(30) NOT NULL,
  `invModel` varchar(30) NOT NULL,
  `invDescription` text DEFAULT NULL,
  `invImage` varchar(50) NOT NULL,
  `invThumbnail` varchar(50) NOT NULL,
  `invPrice` decimal(10,0) NOT NULL,
  `invStock` smallint(6) NOT NULL,
  `invColor` varchar(20) NOT NULL,
  `classificationId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `inventory`
--

INSERT INTO `inventory` (`invId`, `invMake`, `invModel`, `invDescription`, `invImage`, `invThumbnail`, `invPrice`, `invStock`, `invColor`, `classificationId`) VALUES
(1, 'Jeep ', 'Wrangler', 'The Jeep Wrangler is small and compact with enough power to get you where you want to go. It\'s great for everyday driving as well as offroading whether that be on the rocks or in the mud!', '/phpmotors/images/vehicles/wrangler.jpg', '/phpmotors/images/vehicles/wrangler-tn.jpg', '28045', 4, 'Orange', 1),
(2, 'Ford', 'Model T', 'The Ford Model T can be a bit tricky to drive. It was the first car to be put into production. You can get it in any color you want as long as it\'s black.', '/phpmotors/images/vehicles/model-t.jpg', '/phpmotors/images/vehicles/model-t-tn.jpg', '30000', 2, 'Black', 2),
(3, 'Lamborghini', 'Adventador', 'This V-12 engine packs a punch in this sporty car. Make sure you wear your seatbelt and obey all traffic laws. ', '/phpmotors/images/vehicles/adventador.jpg', '/phpmotors/images/vehicles/adventador-tn.jpg', '417650', 1, 'Blue', 3),
(4, 'Monster', 'Truck', 'Most trucks are for working. This one is for fun. This beast comes with 60in tires giving you tractions needed to jump and roll in the mud.', '/phpmotors/images/vehicles/monster-truck.jpg', '/phpmotors/images/vehicles/monster-truck-tn.jpg', '150000', 3, 'purple', 4),
(5, 'Mechanic', 'Special', 'Not sure where this car came from. However, with a little TLC, it will run as good as new.', '/phpmotors/images/vehicles/mechanic.jpg', '/phpmotors/images/vehicles/mechanic-tn.jpg', '100', 200, 'Rust', 5),
(6, 'Batmobile', 'Custom', 'Ever want to be a superhero? Now you can with the batmobile. This car allows you to switch to bike mode allowing you to easily maneuver through traffic during rush hour.', '/phpmotors/images/vehicles/batmobile.jpg', '/phpmotors/images/vehicles/batmobile-tn.jpg', '65000', 2, 'Black', 3),
(7, 'Mystery', 'Machine', 'Scooby and the gang always found luck in solving their mysteries because of their 4 wheel drive Mystery Machine. This Van will help you do whatever job you are required to with a success rate of 100%.', '/phpmotors/images/vehicles/mystery-van.jpg', '/phpmotors/images/vehicles/mystery-van-tn.jpg', '10000', 12, 'Green', 1),
(8, 'Spartan', 'Fire Truck', 'Emergencies happen often. Be prepared with this Spartan fire truck. Comes complete with 1000 ft. of horses and a 1000 gallon tank.', '/phpmotors/images/vehicles/fire-truck.jpg', '/phpmotors/images/vehicles/fire-truck-tn.jpg', '50000', 2, 'Red', 4),
(9, 'Ford', 'Crown Victoria', 'After the police force updated their fleet, these cars are now available to the public! These cars come equipped with the siren which is convenient for college students running late to class.', '/phpmotors/images/vehicles/crwn-vic.jpg', '/phpmotors/images/vehicles/crwn-vic-tn.jpg', '10000', 5, 'White', 5),
(10, 'Chevy', 'Camaro', 'If you want to look cool this is the car you need! This car has great performance at an affordable price. Own it today!', '/phpmotors/images/vehicles/camaro.jpg', '/phpmotors/images/vehicles/camaro-tn.jpg', '25000', 10, 'Silver', 3),
(11, 'Cadilac', 'Escalade', 'This styling car is great for any occasion from going to the beach to meeting the president. The luxurious inside makes this car a home away from home.', '/phpmotors/images/vehicles/escalade.jpg', '/phpmotors/images/vehicles/escalade-tn.jpg', '75195', 4, 'Black', 1),
(12, 'GM', 'Hummer', 'Do you have 6 kids and like to go offroading? The Hummer gives you the small interiors with an engine to get you out of any muddy or rocky situation.', '/phpmotors/images/vehicles/hummer.jpg', '/phpmotors/images/vehicles/hummer-tn.jpg', '58800', 5, 'Yellow', 5),
(13, 'Aerocar International', 'Aerocar', 'Are you sick of rush-hour traffic? This car converts into an airplane to get you where you are going fast. Only 6 of these were made, get them while they last!', '/phpmotors/images/vehicles/aerocar.jpg', '/phpmotors/images/vehicles/aerocar-tn.jpg', '1000000', 6, 'Red', 2),
(14, 'FBI', 'Survalence Van', 'Do you like police shows? You\'ll feel right at home driving this van. It comes complete with surveillance equipment for an extra fee of $2,000 a month. ', '/phpmotors/images/vehicles/van.jpg', '/phpmotors/images/vehicles/van-tn.jpg', '20000', 1, 'Green', 1),
(15, 'Dog ', 'Car', 'Do you like dogs? Well this car is for you straight from the 90s from Aspen, Colorado. We have the orginal Dog Car complete with fluffy ears.  ', '/phpmotors/images/vehicles/dog.jpg', '/phpmotors/images/vehicles/dog-tn.jpg', '35000', 1, 'Brown', 2),
(16, 'Citroen', 'LX3', 'A super-fast car that will make your life easier.', '/phpmotors/images/vehicles/citroen.jpg', '/phpmotors/images/vehicles/citroen-tn.jpg', '25000', 10, 'Red', 2),
(17, 'DMC', 'Delorean', 'This car was designed by Giorgetto Giugiaro and stands out for its gull-wing doors and brushed stainless-steel outer body panels.', '/phpmotors/images/vehicles/delorean.jpg', '/phpmotors/images/vehicles/delorean-tn.jpg', '11000', 2, 'Silver', 3);

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `reviewId` int(10) UNSIGNED NOT NULL,
  `reviewText` text CHARACTER SET latin1 NOT NULL,
  `reviewDate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `invId` int(10) UNSIGNED NOT NULL,
  `clientId` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`reviewId`, `reviewText`, `reviewDate`, `invId`, `clientId`) VALUES
(6, 'This car works perfectly. ', '2020-12-09 16:06:14', 9, 2),
(7, 'first review. change', '2020-12-05 14:27:57', 4, 8),
(8, 'Most trucks are for working, this one is for fun. this beast comes with 60in tires giving you tracktions needed to jump and roll in the mud.', '2020-12-08 16:18:13', 4, 7),
(9, 'third review!.. test update', '2020-12-09 15:55:12', 4, 9),
(10, 'fourth review', '2020-12-05 14:26:10', 4, 3),
(14, 'This is a good truck, but kind of unsafe.', '2020-12-09 04:19:26', 4, 2),
(19, 'test: Sed massa lorem, vulputate at sapien a, convallis iaculis mi. Duis cursus facilisis lectus vel rhoncus.\r\n', '2020-12-09 16:21:30', 6, 2),
(22, 'I hope this works. 2020', '2020-12-09 15:51:36', 12, 2),
(23, 'Test. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent nec massa quis augue luctus elementum. Morbi vulputate ac diam facilisis eleifend.', '2020-12-09 16:05:43', 12, 2),
(25, 'Loved it!', '2020-12-09 15:56:00', 7, 9),
(26, 'This is the perfect car.', '2020-12-09 16:14:36', 3, 9),
(27, 'It&#39;s a good car for anyone who loves dogs.', '2020-12-09 16:25:04', 15, 8),
(28, 'Classic... Cras sed nisi velit. Proin varius quis tellus eget molestie. 3', '2020-12-10 15:50:26', 2, 6),
(30, 'This car takes you back to the future.', '2020-12-09 16:36:27', 17, 5),
(31, 'First review for red truck.', '2020-12-10 15:50:10', 8, 6);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `carclassification`
--
ALTER TABLE `carclassification`
  ADD PRIMARY KEY (`classificationId`);

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`clientId`),
  ADD UNIQUE KEY `clientEmail` (`clientEmail`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`imgId`),
  ADD KEY `FK_inv_images` (`invId`) USING BTREE;

--
-- Indexes for table `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`invId`),
  ADD KEY `classificationId` (`classificationId`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`reviewId`),
  ADD KEY `FK_reviews_clients` (`clientId`),
  ADD KEY `FK_reviews_inventory` (`invId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `carclassification`
--
ALTER TABLE `carclassification`
  MODIFY `classificationId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `clientId` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `imgId` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `inventory`
--
ALTER TABLE `inventory`
  MODIFY `invId` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `reviewId` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `images`
--
ALTER TABLE `images`
  ADD CONSTRAINT `FK_inv_images` FOREIGN KEY (`invId`) REFERENCES `inventory` (`invId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `FK_reviews_clients` FOREIGN KEY (`clientId`) REFERENCES `clients` (`clientId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_reviews_inventory` FOREIGN KEY (`invId`) REFERENCES `inventory` (`invId`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
