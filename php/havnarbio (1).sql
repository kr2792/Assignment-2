-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 09, 2018 at 11:20 AM
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

-- --------------------------------------------------------

--
-- Table structure for table `filmur`
--

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

CREATE TABLE `ticket` (
  `syning_id` int(11) NOT NULL,
  `Seat` int(11) NOT NULL,
  `State` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ticket`
--

INSERT INTO `ticket` (`syning_id`, `Seat`, `State`) VALUES
(1, 1, 1),
(1, 2, 1),
(1, 3, 1),
(1, 4, 1),
(1, 5, 1),
(1, 6, 1),
(1, 7, 1),
(1, 8, 1),
(1, 9, 1),
(1, 10, 1),
(1, 11, 0),
(1, 12, 0),
(1, 13, 0),
(1, 14, 0),
(1, 15, 0),
(1, 16, 0),
(1, 17, 0),
(1, 18, 0),
(1, 19, 0),
(1, 20, 0),
(1, 21, 1),
(1, 22, 0),
(1, 23, 0),
(1, 24, 0),
(1, 25, 0),
(1, 26, 0),
(1, 27, 0),
(1, 28, 0),
(1, 29, 0),
(1, 30, 0),
(1, 31, 0),
(1, 32, 0),
(1, 33, 1),
(1, 34, 1),
(1, 35, 1),
(1, 36, 0),
(1, 37, 0),
(1, 38, 0),
(1, 39, 0),
(1, 40, 0),
(1, 41, 0),
(1, 42, 0),
(1, 43, 0),
(1, 44, 0),
(1, 45, 0),
(1, 46, 0),
(1, 47, 1),
(1, 48, 1),
(1, 49, 0),
(1, 50, 1),
(1, 51, 0),
(1, 52, 0),
(1, 53, 0),
(1, 54, 0),
(1, 55, 0),
(1, 56, 1),
(1, 57, 0),
(1, 58, 0),
(1, 59, 0),
(1, 60, 1),
(1, 61, 0),
(1, 62, 0),
(1, 63, 0),
(1, 64, 0),
(1, 65, 0),
(1, 66, 1),
(1, 67, 0),
(1, 68, 0),
(1, 69, 1),
(1, 70, 1),
(1, 71, 1),
(1, 72, 0),
(1, 73, 0),
(1, 74, 0),
(1, 75, 0),
(1, 76, 1),
(1, 77, 0),
(1, 78, 0),
(1, 79, 1),
(1, 80, 1);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
