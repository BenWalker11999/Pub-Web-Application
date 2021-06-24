-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 172.16.11.22:3306
-- Generation Time: Apr 16, 2021 at 04:55 PM
-- Server version: 10.1.48-MariaDB-0+deb9u1
-- PHP Version: 7.1.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `walb2_17_web`
--

-- --------------------------------------------------------

--
-- Table structure for table `Pub`
--

CREATE TABLE `Pub` (
  `pub_id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `pubname` text NOT NULL,
  `address` text NOT NULL,
  `postcode` varchar(8) NOT NULL,
  `livesportschannel` text NOT NULL,
  `livesportschannel2` text NOT NULL,
  `livesportschannel3` text NOT NULL,
  `sportsfacilities` text NOT NULL,
  `sportsfacilities2` text NOT NULL,
  `sportsfacilities3` text NOT NULL,
  `sportsfacilities4` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Pub`
--

INSERT INTO `Pub` (`pub_id`, `user_id`, `pubname`, `address`, `postcode`, `livesportschannel`, `livesportschannel2`, `livesportschannel3`, `sportsfacilities`, `sportsfacilities2`, `sportsfacilities3`, `sportsfacilities4`) VALUES
(1, 1, 'The Monument Pub', 'Monument Hereford', 'HR4 0LT', 'BT Sports', 'Sky Sports', 'BBC Sports', 'Pool Table', '', '', ''),
(2, 1, 'The Imperial', '31 Widemarsh Street Hereford', 'HR4 9EA', 'BBC Sports', '', '', 'Darts', 'Pool Table', '', ''),
(4, 2, 'The Harp', 'The Harp, Covent Garden 47 Chandos Place London', 'WC2N 4HS', 'BBC Sports', '', '', 'Pool Table', 'Snooker Table', '', ''),
(5, 2, 'The Mayflower', '117 Rotherhithe St Rotherhithe London', 'SE16 4NF', 'BBC Sports', 'BT Sports', 'Sky Sports', 'Skittles', 'Darts', '', ''),
(7, 3, 'The Lifeboat Inn', 'Lifeboat Inn St Ives', 'TR26 1LF', 'Sky Sports', '', '', 'Pool Table', '', '', ''),
(10, 1, 'The Three Elms', 'Three Elms Hereford', 'HR4 9QQ', 'Sky Sports', '', '', 'Darts', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `Users`
--

CREATE TABLE `Users` (
  `user_id` int(10) NOT NULL,
  `email` varchar(150) NOT NULL,
  `username` varchar(150) NOT NULL,
  `password` varchar(150) NOT NULL,
  `forename` text NOT NULL,
  `gender` text NOT NULL,
  `county` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Users`
--

INSERT INTO `Users` (`user_id`, `email`, `username`, `password`, `forename`, `gender`, `county`) VALUES
(1, '123@gmail.com', '12345678', '$2y$10$aW5FnoV.S2sZ9t6Lp0fyMuW6egit/n3dDgG1iODQwn5/plbvcx312', 'Peter', 'Male', 'Herefordshire'),
(2, '123456@gmail.com', 'abcdef', '$2y$10$bRY.9HoRGlQTwrxTBPuZHeT.2wyXRo.YSmQm7FgEPhd9bWfcwTLqi', 'Hope', 'Female', 'Greater London'),
(3, 'abc@gmail.com', '12345', '$2y$10$vLQevOfuLy8WnXQ6yWY9Y.66o0WCo2PEEl8r5RsdHV.9n8nkgB6vO', 'Bruce', 'Male', 'Cornwall'),
(8, '12345678@gmail.com', '123', '$2y$10$GAaPu57YzHdx2rp1BKgQseTcsHJcE3wkgGbhPIUPyDjQBgwSvxyze', '', '', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Pub`
--
ALTER TABLE `Pub`
  ADD PRIMARY KEY (`pub_id`);

--
-- Indexes for table `Users`
--
ALTER TABLE `Users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Pub`
--
ALTER TABLE `Pub`
  MODIFY `pub_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `Users`
--
ALTER TABLE `Users`
  MODIFY `user_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
