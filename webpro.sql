-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 21, 2022 at 03:24 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.0.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Database: `webpro`
--

-- --------------------------------------------------------

--
-- Table structure for table `appointment`
--

CREATE TABLE `appointment` (
  `appoNum` int(100) NOT NULL,
  `date` date NOT NULL,
  `time` time(6) NOT NULL,
  `satatus` varchar(100) DEFAULT NULL,
  `note` text DEFAULT NULL,
  `petName` varchar(100) DEFAULT NULL,
  `owneremail` varchar(100) DEFAULT NULL,
  `serviceName` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `appointment`
--

INSERT INTO `appointment` (`appoNum`, `date`, `time`, `satatus`, `note`, `petName`, `owneremail`, `serviceName`) VALUES
(1, '2022-03-22', '10:00:00.000000', 'previous', 'Make her a lion hairstyle (:', 'Loosy', 'sara@gmail.com', 'Grooming'),
(2, '2022-03-01', '12:00:00.000000', 'previous', 'be careful <3', 'Goosy', 'sara@gmail.com', 'Boarding'),
(3, '2022-06-07', '18:00:00.000000', 'upcoming', 'dose not feel will ); ', 'Goosy', 'sara@gmail.com', 'Checkup'),
(4, '2022-04-12', '10:00:00.000000', 'previous', 'Make her a lion hairstyle (:', 'Goosy', 'sara@gmail.com', 'Grooming'),
(5, '2022-04-13', '16:00:00.000000', 'previous', 'Please give her a trim', 'Loosy', 'sara@gmail.com', 'Grooming'),
(6, '2022-11-11', '09:00:00.000000', 'request', ' make her safe', 'Loosy', 'sara@gmail.com', 'Grooming'),
(7, '2022-06-01', '11:00:00.000000', '', '', NULL, NULL, 'Boarding'),
(8, '2022-06-07', '10:00:00.000000', '', '', NULL, NULL, 'Boarding');

-- --------------------------------------------------------

--
-- Table structure for table `pet`
--

CREATE TABLE `pet` (
  `name` varchar(100) NOT NULL,
  `DOB` date NOT NULL,
  `breed` varchar(100) NOT NULL,
  `vaccination_list` text DEFAULT NULL,
  `photo` varchar(100) DEFAULT 'images.png',
  `medical_history` text DEFAULT NULL,
  `gender` varchar(50) NOT NULL,
  `SNstatus` varchar(50) NOT NULL,
  `ownerEmail` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pet`
--

INSERT INTO `pet` (`name`, `DOB`, `breed`, `vaccination_list`, `photo`, `medical_history`, `gender`, `SNstatus`, `ownerEmail`) VALUES
('Goosy', '2021-03-12', 'Norwegian Forest', 'Rabies,Bordetella', 'whiteCat.jpg', '', 'female', 'spayed', 'sara@gmail.com'),
('Loosy', '2022-01-01', 'Scottish Fold', 'Rabies', 'littelKitten.jpg', '', 'female', 'neutred', 'sara@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `petowner`
--

CREATE TABLE `petowner` (
  `email` varchar(100) NOT NULL,
  `password` varchar(10) NOT NULL,
  `profilePhoto` varchar(100) NOT NULL,
  `phoneNumber` int(100) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `Fname` varchar(50) NOT NULL,
  `Lname` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `petowner`
--

INSERT INTO `petowner` (`email`, `password`, `profilePhoto`, `phoneNumber`, `gender`, `Fname`, `Lname`) VALUES
('nora@gmail.com', 'heyitsnora', 'profilePic.PNG', 555566554, 'female', 'nora', 'fahad'),
('saadAbdullah@gmail.com', 'heresaad12', 'images.png', 562288992, 'male', 'Saad', 'Abdullah'),
('sara@gmail.com', 'Iamsarah1!', 'profilePic.PNG', 555555555, 'Female', 'sara', 'mohammed');

-- --------------------------------------------------------

--
-- Table structure for table `review`
--

CREATE TABLE `review` (
  `rating` varchar(100) NOT NULL,
  `note` varchar(300) DEFAULT NULL,
  `appoNum` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `review`
--

INSERT INTO `review` (`rating`, `note`, `appoNum`) VALUES
('Like it', NULL, 2),
('Loveit!', NULL, 1),
('Loveit!', NULL, 3);

-- --------------------------------------------------------

--
-- Table structure for table `service`
--

CREATE TABLE `service` (
  `name` varchar(100) NOT NULL,
  `photo` varchar(100) NOT NULL,
  `description` varchar(300) NOT NULL,
  `price` int(4) NOT NULL,
  `Vemail` varchar(100) NOT NULL DEFAULT 'veterinary@gmail.com'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `service`
--

INSERT INTO `service` (`name`, `photo`, `description`, `price`, `Vemail`) VALUES
('Boarding', 'boarding2.jpg', 'Our staff are compassionate and are here to provide individualized care for your pet at all times', 700, 'veterinary@gmail.com'),
('Checkup', 'check%20up.jpg', 'We believe that Regular checkups are a vital part of your pet’s healthcare plan. We recommend all cats and dogs receive a yearly physical exam', 150, 'veterinary@gmail.com'),
('Grooming', 'grooming.jpg', 'improve pets’ hygiene and enhance their physical appearance. They bathe, brush, dry , clean their teeth and ears,trim their nails and hair/fur', 400, 'veterinary@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `veterinary`
--

CREATE TABLE `veterinary` (
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `description` char(250) NOT NULL,
  `photo` varchar(200) NOT NULL,
  `location` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `veterinary`
--

INSERT INTO `veterinary` (`email`, `password`, `description`, `photo`, `location`) VALUES
('veterinary@gmail.com', '12345', '\"Pet Care\" was founded in February 2022. Our clinic is the first in its class in the Kingdom of Saudi Arabia, Since it was established, our staff have been providing unique veterinary medical services and compassionate animal care in Riyadh city', 'Pets.jpg', 'https://goo.gl/maps/YUF1kHXYjRNyw9QE7');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointment`
--
ALTER TABLE `appointment`
  ADD PRIMARY KEY (`appoNum`),
  ADD KEY `petName` (`petName`),
  ADD KEY `appointment_ibfk_3` (`owneremail`),
  ADD KEY `appointment_ibfk_1` (`serviceName`);

--
-- Indexes for table `pet`
--
ALTER TABLE `pet`
  ADD PRIMARY KEY (`name`,`ownerEmail`),
  ADD KEY `forignkey` (`ownerEmail`);

--
-- Indexes for table `petowner`
--
ALTER TABLE `petowner`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`rating`,`appoNum`),
  ADD KEY `appoNum` (`appoNum`);

--
-- Indexes for table `service`
--
ALTER TABLE `service`
  ADD PRIMARY KEY (`name`),
  ADD KEY `co` (`Vemail`);

--
-- Indexes for table `veterinary`
--
ALTER TABLE `veterinary`
  ADD PRIMARY KEY (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointment`
--
ALTER TABLE `appointment`
  MODIFY `appoNum` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `appointment`
--
ALTER TABLE `appointment`
  ADD CONSTRAINT `appointment_ibfk_1` FOREIGN KEY (`serviceName`) REFERENCES `service` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `appointment_ibfk_2` FOREIGN KEY (`petName`) REFERENCES `pet` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `appointment_ibfk_3` FOREIGN KEY (`owneremail`) REFERENCES `pet` (`ownerEmail`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pet`
--
ALTER TABLE `pet`
  ADD CONSTRAINT `forignkey` FOREIGN KEY (`ownerEmail`) REFERENCES `petowner` (`email`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `review`
--
ALTER TABLE `review`
  ADD CONSTRAINT `review_ibfk_1` FOREIGN KEY (`appoNum`) REFERENCES `appointment` (`appoNum`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `service`
--
ALTER TABLE `service`
  ADD CONSTRAINT `co` FOREIGN KEY (`Vemail`) REFERENCES `veterinary` (`email`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;
