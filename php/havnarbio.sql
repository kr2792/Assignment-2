
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


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


INSERT INTO `filmur` (`name`, `length`, `release_date`, `information`, `genre`, `censur`, `ID`, `sysning_id`) VALUES
('Pulp Fiction', 154, '1994-10-21', 'The lives of two mob hitmen, a boxer, a gangster\'s wife, and a pair of diner bandits intertwine in four tales of violence and redemption.', 'Crime, Action', 18, 1, NULL),
('Black Panther', 134, '2018-02-13', 'T\'Challa, the King of Wakanda, rises to the throne in the isolated, technologically advanced African nation, but his claim is challenged by a vengeful outsider who was a childhood victim of T\'Challa\'s father\'s mistake', 'Action, Adventure, Sci-Fi', 12, 2, NULL),
('Darkest Hour', 125, '2018-01-12', 'During the early days of World War II, the fate of Western Europe hangs on the newly-appointed British Prime Minister Winston Churchill, who must decide whether to negotiate with Adolf Hitler, or fight on against incredible odds.', 'Biography, Drama, History', 12, 3, NULL);


CREATE TABLE `syning` (
  `ID` int(11) NOT NULL,
  `date` date NOT NULL,
  `start_time` int(255) NOT NULL,
  `price` int(11) NOT NULL,
  `seat_id` int(11) NOT NULL,
  `movie_id` int(11) NOT NULL,
  `end_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


INSERT INTO `syning` (`ID`, `date`, `start_time`, `price`, `seat_id`, `movie_id`, `end_time`) VALUES
(1, '2018-03-15', 0, 5, 2, 3, NULL),
(9, '2010-12-31', 6, 5, 2, 3, NULL);


CREATE TABLE `ticket` (
  `syning_id` int(11) NOT NULL,
  `Seat` int(11) NOT NULL,
  `State` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


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
(1, 15, 1),
(1, 16, 1),
(1, 17, 1),
(1, 18, 1),
(1, 19, 1),
(1, 20, 1),
(1, 21, 1),
(1, 22, 0),
(1, 23, 0),
(1, 24, 0),
(1, 25, 0),
(1, 26, 1),
(1, 27, 1),
(1, 28, 1),
(1, 29, 1),
(1, 30, 1),
(1, 31, 0),
(1, 32, 0),
(1, 33, 1),
(1, 34, 1),
(1, 35, 1),
(1, 36, 1),
(1, 37, 1),
(1, 38, 1),
(1, 39, 1),
(1, 40, 1),
(1, 41, 0),
(1, 42, 0),
(1, 43, 1),
(1, 44, 1),
(1, 45, 1),
(1, 46, 0),
(1, 47, 1),
(1, 48, 1),
(1, 49, 1),
(1, 50, 1),
(1, 51, 0),
(1, 52, 0),
(1, 53, 1),
(1, 54, 1),
(1, 55, 1),
(1, 56, 1),
(1, 57, 1),
(1, 58, 1),
(1, 59, 1),
(1, 60, 1),
(1, 61, 0),
(1, 62, 0),
(1, 63, 0),
(1, 64, 0),
(1, 65, 1),
(1, 66, 1),
(1, 67, 1),
(1, 68, 1),
(1, 69, 1),
(1, 70, 1),
(1, 71, 1),
(1, 72, 0),
(1, 73, 0),
(1, 74, 0),
(1, 75, 0),
(1, 76, 1),
(1, 77, 1),
(1, 78, 1),
(1, 79, 1),
(1, 80, 1);

ALTER TABLE `filmur`
  ADD PRIMARY KEY (`ID`);

ALTER TABLE `syning`
  ADD PRIMARY KEY (`ID`);

ALTER TABLE `filmur`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

ALTER TABLE `syning`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;
