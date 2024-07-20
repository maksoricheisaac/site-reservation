-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 18, 2024 at 10:53 AM
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
-- Database: `rm_reservation`
--

-- --------------------------------------------------------

--
-- Table structure for table `agency`
--

CREATE TABLE `agency` (
  `agency_id` int(11) NOT NULL,
  `image_agency_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `address` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `agency`
--

INSERT INTO `agency` (`agency_id`, `image_agency_id`, `name`, `phone`, `address`) VALUES
(1, 1, 'Océan du Nord', '+242-06-606-31-33', 'Blalala'),
(2, 2, 'Transbony Voyages', '+242-06-563-86-42', 'N° 54, rue Lamy Bacongo'),
(3, 3, 'Melodie Express', '+242-06-583-40-86', 'N°13, rue Emile Biayenda Mpila'),
(4, 4, 'Stelimac', '+242-06-572-88-33', 'N° 297, rue La pépinière Plateau des 15ans, Moungali');

-- --------------------------------------------------------

--
-- Table structure for table `image_agency`
--

CREATE TABLE `image_agency` (
  `image_agency_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `image_agency`
--

INSERT INTO `image_agency` (`image_agency_id`, `name`) VALUES
(1, 'ocean_du_nord.png'),
(2, 'transbony.jpg'),
(3, 'melodie_express.jpg'),
(4, 'stelimac.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `payment_mode`
--

CREATE TABLE `payment_mode` (
  `payment_mode_id` int(11) NOT NULL,
  `image` varchar(200) DEFAULT NULL,
  `name` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payment_mode`
--

INSERT INTO `payment_mode` (`payment_mode_id`, `image`, `name`) VALUES
(1, 'mtn_mobile_money.jpeg', 'MTN Mobile Money'),
(2, 'airtel_money.png', 'Airtel Money');

-- --------------------------------------------------------

--
-- Table structure for table `route`
--

CREATE TABLE `route` (
  `route_id` int(11) NOT NULL,
  `agency_id` int(11) NOT NULL,
  `departure_location` varchar(20) NOT NULL,
  `arrival_location` varchar(20) NOT NULL,
  `adult_price` int(11) DEFAULT NULL,
  `child_price` int(11) DEFAULT NULL,
  `days` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `route`
--

INSERT INTO `route` (`route_id`, `agency_id`, `departure_location`, `arrival_location`, `adult_price`, `child_price`, `days`) VALUES
(1, 1, 'Brazzaville', 'Pointe-Noire', 10000, 8000, 'Tous les jours'),
(2, 1, 'Brazzaville', 'Ouesso', 15000, 12000, 'Tous les jours'),
(3, 1, 'Brazzaville', 'Nkayi', 8000, 6000, 'Tous les jours'),
(4, 1, 'Brazzaville', 'Oyo', 7000, 6000, 'Tous les jours'),
(5, 1, 'Pointe-Noire', 'Sibiti', 10000, 10000, 'Mardi, Samedi'),
(6, 1, 'Pointe-Noire', 'Nkayi', 6000, 6000, 'Tous les jours'),
(7, 1, 'Pointe-Noire', 'Dolisie', 5000, 4000, 'Tous les jours'),
(8, 1, 'Brazzaville', 'Owando', 10000, 8000, 'Tous les jours'),
(9, 1, 'Brazzaville', 'Mindouli', 5000, 4000, 'Tous les jours'),
(10, 1, 'Brazzaville', 'Djambala', 6000, 5000, 'Lundi, Mercredi, Vendredi'),
(11, 1, 'Brazzaville', 'Gamboma', 6000, 5000, 'Tous les jours'),
(12, 1, 'Brazzaville', 'Sibiti', 12000, 10000, 'Tous les jours'),
(13, 1, 'Brazzaville', 'Dolosie', 10000, 8000, 'Tous les jours'),
(14, 1, 'Brazzaville', 'Impfondoo', 35000, 3000, 'Mardi, Jeudi, Dimanche'),
(15, 1, 'Pointe-Noire', 'Madingou', 7000, 5000, 'Tous les jours'),
(16, 1, 'Brazzaville', 'Madingou', 7000, 5000, 'Tous les jours'),
(17, 2, 'Brazzaville', 'Pointe-Noire', 11000, 8500, 'Tous les jours'),
(18, 2, 'Brazzaville', 'Ouesso', 16000, 12500, 'Tous les jours'),
(19, 2, 'Brazzaville', 'Nkayi', 8500, 6500, 'Tous les jours'),
(20, 2, 'Brazzaville', 'Oyo', 7500, 6500, 'Tous les jours'),
(21, 2, 'Pointe-Noire', 'Sibiti', 11000, 11000, 'Mardi, Samedi'),
(22, 2, 'Pointe-Noire', 'Nkayi', 6500, 6500, 'Tous les jours'),
(23, 2, 'Pointe-Noire', 'Dolisie', 5500, 4500, 'Tous les jours'),
(24, 2, 'Brazzaville', 'Owando', 11000, 8500, 'Tous les jours'),
(25, 2, 'Brazzaville', 'Mindouli', 5500, 4500, 'Tous les jours'),
(26, 2, 'Brazzaville', 'Djambala', 6500, 5500, 'Lundi, Mercredi, Vendredi'),
(27, 2, 'Brazzaville', 'Gamboma', 6500, 5500, 'Tous les jours'),
(28, 2, 'Brazzaville', 'Sibiti', 13000, 10500, 'Tous les jours'),
(29, 2, 'Brazzaville', 'Dolosie', 11000, 8500, 'Tous les jours'),
(30, 2, 'Brazzaville', 'Impfondoo', 36000, 3200, 'Mardi, Jeudi, Dimanche'),
(31, 2, 'Pointe-Noire', 'Madingou', 7500, 5500, 'Tous les jours'),
(32, 2, 'Brazzaville', 'Madingou', 7500, 5500, 'Tous les jours'),
(33, 3, 'Brazzaville', 'Pointe-Noire', 10500, 8200, 'Tous les jours'),
(34, 3, 'Brazzaville', 'Ouesso', 15500, 12200, 'Tous les jours'),
(35, 3, 'Brazzaville', 'Nkayi', 8200, 6200, 'Tous les jours'),
(36, 3, 'Brazzaville', 'Oyo', 7200, 6200, 'Tous les jours'),
(37, 3, 'Pointe-Noire', 'Sibiti', 10500, 10500, 'Mardi, Samedi'),
(38, 3, 'Pointe-Noire', 'Nkayi', 6200, 6200, 'Tous les jours'),
(39, 3, 'Pointe-Noire', 'Dolisie', 5200, 4200, 'Tous les jours'),
(40, 3, 'Brazzaville', 'Owando', 10500, 8200, 'Tous les jours'),
(41, 3, 'Brazzaville', 'Mindouli', 5200, 4200, 'Tous les jours'),
(42, 3, 'Brazzaville', 'Djambala', 6200, 5200, 'Lundi, Mercredi, Vendredi'),
(43, 3, 'Brazzaville', 'Gamboma', 6200, 5200, 'Tous les jours'),
(44, 3, 'Brazzaville', 'Sibiti', 12500, 10200, 'Tous les jours'),
(45, 3, 'Brazzaville', 'Dolosie', 10500, 8200, 'Tous les jours'),
(46, 3, 'Brazzaville', 'Impfondoo', 35500, 3100, 'Mardi, Jeudi, Dimanche'),
(47, 3, 'Pointe-Noire', 'Madingou', 7200, 5200, 'Tous les jours'),
(48, 3, 'Brazzaville', 'Madingou', 7200, 5200, 'Tous les jours'),
(49, 4, 'Brazzaville', 'Pointe-Noire', 11500, 8800, 'Tous les jours'),
(50, 4, 'Brazzaville', 'Ouesso', 16500, 12800, 'Tous les jours'),
(51, 4, 'Brazzaville', 'Nkayi', 8800, 6700, 'Tous les jours'),
(52, 4, 'Brazzaville', 'Oyo', 7700, 6700, 'Tous les jours'),
(53, 4, 'Pointe-Noire', 'Sibiti', 11500, 11500, 'Mardi, Samedi'),
(54, 4, 'Pointe-Noire', 'Nkayi', 6700, 6700, 'Tous les jours'),
(55, 4, 'Pointe-Noire', 'Dolisie', 5700, 4700, 'Tous les jours'),
(56, 4, 'Brazzaville', 'Owando', 11500, 8800, 'Tous les jours'),
(57, 4, 'Brazzaville', 'Mindouli', 5700, 4700, 'Tous les jours'),
(58, 4, 'Brazzaville', 'Djambala', 6700, 5700, 'Lundi, Mercredi, Vendredi'),
(59, 4, 'Brazzaville', 'Gamboma', 6700, 5700, 'Tous les jours'),
(60, 4, 'Brazzaville', 'Sibiti', 13500, 10800, 'Tous les jours'),
(61, 4, 'Brazzaville', 'Dolosie', 11500, 8800, 'Tous les jours'),
(62, 4, 'Brazzaville', 'Impfondoo', 37500, 3300, 'Mardi, Jeudi, Dimanche'),
(63, 4, 'Pointe-Noire', 'Madingou', 7700, 5700, 'Tous les jours'),
(64, 4, 'Brazzaville', 'Madingou', 7700, 5700, 'Tous les jours');

-- --------------------------------------------------------

--
-- Table structure for table `ticket`
--

CREATE TABLE `ticket` (
  `ticket_id` int(11) NOT NULL,
  `route_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `payment_mode_id` int(11) NOT NULL DEFAULT 1,
  `owner` varchar(50) NOT NULL,
  `num_adult_seats` int(11) NOT NULL,
  `num_child_seats` int(11) NOT NULL,
  `total_price` int(11) NOT NULL,
  `purchase_date` datetime DEFAULT current_timestamp(),
  `status` enum('valid','cancelled') DEFAULT 'valid'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ticket`
--

INSERT INTO `ticket` (`ticket_id`, `route_id`, `user_id`, `payment_mode_id`, `owner`, `num_adult_seats`, `num_child_seats`, `total_price`, `purchase_date`, `status`) VALUES
(1, 3, 1, 2, 'Jhon Doe', 1, 1, 14000, '2024-07-18 09:39:13', 'valid'),
(2, 9, 1, 2, 'Jhon Doe', 1, 2, 13000, '2024-07-18 10:23:32', 'valid');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `fullname`, `email`, `password`) VALUES
(1, 'Jhon Doe', 'jhondoe@gmail.com', '$argon2i$v=19$m=65536,t=4,p=1$aHJaSlh6ODM2LmY3djRBYg$RJlJ7+P0nHOoLdCX0GbvSyknK/ZRjValnUpN5zlPj00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `agency`
--
ALTER TABLE `agency`
  ADD PRIMARY KEY (`agency_id`),
  ADD KEY `image_agency_id` (`image_agency_id`),
  ADD KEY `image_agency_id_2` (`image_agency_id`);

--
-- Indexes for table `image_agency`
--
ALTER TABLE `image_agency`
  ADD PRIMARY KEY (`image_agency_id`);

--
-- Indexes for table `payment_mode`
--
ALTER TABLE `payment_mode`
  ADD PRIMARY KEY (`payment_mode_id`),
  ADD KEY `image_mode_payment` (`image`),
  ADD KEY `image_mode_payment_id` (`image`),
  ADD KEY `image_id_payment_mode` (`image`),
  ADD KEY `image_payment_mode_id` (`image`);

--
-- Indexes for table `route`
--
ALTER TABLE `route`
  ADD PRIMARY KEY (`route_id`),
  ADD KEY `agency_id` (`agency_id`);

--
-- Indexes for table `ticket`
--
ALTER TABLE `ticket`
  ADD PRIMARY KEY (`ticket_id`),
  ADD KEY `route_id` (`route_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `payment_mode_id` (`payment_mode_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `agency`
--
ALTER TABLE `agency`
  MODIFY `agency_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `image_agency`
--
ALTER TABLE `image_agency`
  MODIFY `image_agency_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `payment_mode`
--
ALTER TABLE `payment_mode`
  MODIFY `payment_mode_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `route`
--
ALTER TABLE `route`
  MODIFY `route_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `ticket`
--
ALTER TABLE `ticket`
  MODIFY `ticket_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `image_agency`
--
ALTER TABLE `image_agency`
  ADD CONSTRAINT `image_agency_ibfk_1` FOREIGN KEY (`image_agency_id`) REFERENCES `agency` (`image_agency_id`);

--
-- Constraints for table `route`
--
ALTER TABLE `route`
  ADD CONSTRAINT `route_ibfk_1` FOREIGN KEY (`agency_id`) REFERENCES `agency` (`agency_id`);

--
-- Constraints for table `ticket`
--
ALTER TABLE `ticket`
  ADD CONSTRAINT `ticket_ibfk_1` FOREIGN KEY (`route_id`) REFERENCES `route` (`route_id`),
  ADD CONSTRAINT `ticket_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`),
  ADD CONSTRAINT `ticket_ibfk_3` FOREIGN KEY (`payment_mode_id`) REFERENCES `payment_mode` (`payment_mode_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
