-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 06, 2018 at 01:43 PM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 7.2.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `havnarbio`
--
CREATE DATABASE IF NOT EXISTS `havnarbio` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `havnarbio`;

-- --------------------------------------------------------

--
-- Table structure for table `filmur`
--

DROP TABLE IF EXISTS `filmur`;
CREATE TABLE `filmur` (
  `name` varchar(255) NOT NULL,
  `length` int(36) NOT NULL,
  `release_date` date NOT NULL,
  `information` varchar(255) NOT NULL,
  `genre` varchar(255) DEFAULT NULL,
  `censur` int(11) DEFAULT NULL,
  `ID` int(11) NOT NULL,
  `sysning_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `filmur`
--

INSERT INTO `filmur` (`name`, `length`, `release_date`, `information`, `genre`, `censur`, `ID`, `sysning_id`) VALUES
('Pulp Fiction', 154, '1994-10-21', 'The lives of two mob hitmen, a boxer, a gangster\'s wife, and a pair of diner bandits intertwine in four tales of violence and redemption.', 'Crime, Action', 18, 1, NULL),
('Black Panther', 134, '2018-02-13', 'T\'Challa, the King of Wakanda, rises to the throne in the isolated, technologically advanced African nation, but his claim is challenged by a vengeful outsider who was a childhood victim of T\'Challa\'s father\'s mistake', 'Action, Adventure, Sci-Fi', 12, 2, NULL),
('Darkest Hour', 125, '2018-01-12', 'During the early days of World War II, the fate of Western Europe hangs on the newly-appointed British Prime Minister Winston Churchill, who must decide whether to negotiate with Adolf Hitler, or fight on against incredible odds.', 'Biography, Drama, History', 12, 3, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `syning`
--

DROP TABLE IF EXISTS `syning`;
CREATE TABLE `syning` (
  `ID` int(11) NOT NULL,
  `date` date NOT NULL,
  `start_time` int(255) NOT NULL,
  `price` int(11) NOT NULL,
  `seat_id` int(11) NOT NULL,
  `movie_id` int(11) NOT NULL,
  `end_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `syning`
--

INSERT INTO `syning` (`ID`, `date`, `start_time`, `price`, `seat_id`, `movie_id`, `end_time`) VALUES
(1, '2018-03-15', 0, 5, 2, 3, NULL),
(9, '2010-12-31', 6, 5, 2, 3, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ticket`
--

DROP TABLE IF EXISTS `ticket`;
CREATE TABLE `ticket` (
  `syning_ID` int(11) NOT NULL,
  `seat` varchar(255) NOT NULL,
  `ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `filmur`
--
ALTER TABLE `filmur`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `syning`
--
ALTER TABLE `syning`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `ticket`
--
ALTER TABLE `ticket`
  ADD PRIMARY KEY (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
