-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 29, 2023 at 11:01 AM
-- Server version: 10.3.28-MariaDB
-- PHP Version: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cycling`
--

-- --------------------------------------------------------

--
-- Table structure for table `club`
--

CREATE TABLE `club` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `location` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `club`
--

INSERT INTO `club` (`id`, `name`, `location`) VALUES
(1, 'Roker Rollers', 'Sunderland'),
(2, 'Byker Bikers', 'Newcastle'),
(3, 'Middlesbrough Movers', 'Middlesbrough'),
(4, 'Durham Dynamos', 'Durham');

-- --------------------------------------------------------

--
-- Table structure for table `interest`
--

CREATE TABLE `interest` (
  `id` int(255) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `surname` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `terms` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `participant`
--

CREATE TABLE `participant` (
  `id` int(255) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `surname` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `power_output` float DEFAULT NULL,
  `distance` float DEFAULT NULL,
  `club_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `participant`
--

INSERT INTO `participant` (`id`, `firstname`, `surname`, `email`, `power_output`, `distance`, `club_id`) VALUES
(1, 'Lorette', 'Lamacraft', 'llamacraft0@census.gov', 0, 0, 1),
(2, 'Georgeanne', 'Seston', 'gseston1@networksolutions.com', 0, 0, 1),
(3, 'Lemmy', 'Stavers', 'lstavers2@cam.ac.uk', 0, 0, 2),
(4, 'Eduard', 'Roelvink', 'eroelvink3@studiopress.com', 0, 0, 1),
(5, 'Dennis', 'Oxenham', 'doxenham4@chronoengine.com', 0, 0, 4),
(6, 'Lynnett', 'Christophe', 'lchristophe5@yahoo.com', 0, 0, 1),
(7, 'Ken', 'Gammidge', 'kgammidge6@telegraph.co.uk', 0, 0, 4),
(8, 'Dorie', 'Espina', 'despina7@usnews.com', 0, 0, 1),
(9, 'Lawrence', 'Upsale', 'lupsale8@accuweather.com', 0, 0, 1),
(10, 'Evaleen', 'Hartin', 'ehartin9@cornell.edu', 0, 0, 2),
(11, 'Therese', 'Currin', 'tcurrina@taobao.com', 0, 0, 1),
(12, 'Chiquita', 'Rapi', 'crapib@sun.com', 0, 0, 2),
(13, 'Corabella', 'Frude', 'cfrudec@npr.org', 0, 0, 1),
(14, 'Eveleen', 'Cranna', 'ecrannad@twitpic.com', 0, 0, 1),
(15, 'Brier', 'Westmerland', 'bwestmerlande@home.pl', 0, 0, 4),
(16, 'Petra', 'Loffhead', 'ploffheadf@rambler.ru', 0, 0, 2),
(17, 'Elinor', 'Ranscombe', 'eranscombeg@state.tx.us', 0, 0, 4),
(18, 'Reeba', 'Somerbell', 'rsomerbellh@alexa.com', 0, 0, 4),
(19, 'Dulciana', 'Kaming', 'dkamingi@dailymail.co.uk', 0, 0, 1),
(20, 'Eal', 'Willers', 'ewillersj@businessinsider.com', 0, 0, 1),
(21, 'Lucina', 'Hessentaler', 'lhessentalerk@histats.com', 0, 0, 4),
(22, 'Thatch', 'Bosse', 'tbossel@engadget.com', 0, 0, 4),
(23, 'Hanson', 'Adamoli', 'hadamolim@prnewswire.com', 0, 0, 1),
(24, 'Mildrid', 'Marton', 'mmartonn@auda.org.au', 0, 0, 4),
(25, 'Jeana', 'Yakuntzov', 'jyakuntzovo@plala.or.jp', 0, 0, 4),
(26, 'Ulrick', 'Fyall', 'ufyallp@unc.edu', 0, 0, 3),
(27, 'Clary', 'Wevell', 'cwevellq@ucoz.com', 0, 0, 3),
(28, 'Cissiee', 'Plewes', 'cplewesr@smh.com.au', 0, 0, 1),
(29, 'Thorn', 'Richen', 'trichens@usnews.com', 0, 0, 2),
(30, 'Gabriella', 'Clearley', 'gclearleyt@tinypic.com', 0, 0, 3);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(10) NOT NULL,
  `password` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`) VALUES
(1, 'admin', 'password123');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `club`
--
ALTER TABLE `club`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `interest`
--
ALTER TABLE `interest`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `participant`
--
ALTER TABLE `participant`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `club`
--
ALTER TABLE `club`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `interest`
--
ALTER TABLE `interest`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `participant`
--
ALTER TABLE `participant`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
