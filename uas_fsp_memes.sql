-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 07, 2022 at 01:38 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `uas_fsp_memes`
--

-- --------------------------------------------------------

--
-- Table structure for table `memes`
--

CREATE TABLE `memes` (
  `idmemes` int(11) NOT NULL,
  `title` varchar(45) NOT NULL,
  `imgURL` varchar(45) NOT NULL,
  `like` varchar(45) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `memes`
--

INSERT INTO `memes` (`idmemes`, `title`, `imgURL`, `like`) VALUES
(1, 'Smokes Cigarettes', '1', '0'),
(2, 'NO, NaBro, Nah', 'Nah', '0'),
(3, 'Work Get The Best Of Me', '3', '0'),
(4, 'Small Kids Staring Into My Soul', '4', '0'),
(5, 'A Comeback', 'A Comeback', '0'),
(6, 'A wow quote', 'A wow quote', '0'),
(7, 'Family', 'Family', '0'),
(8, 'Finally a worthy opponent', 'Finally a worthy opponent', '0'),
(9, 'Free Time', 'Free Time', '0'),
(10, 'Get Rekt', 'Get Rekt', '0'),
(11, 'HCOONa Matata', 'HCOONa Matata', '0'),
(12, 'Hold Up', 'Hold Up', '0'),
(13, 'Hold Up1', 'Hold Up1', '0'),
(14, 'Internet', 'Internet', '0'),
(15, 'Life after college', 'Life after college', '0'),
(16, 'No Heart Breaks', 'Maths Results', '0'),
(17, 'Nice Answer', 'Nice Answer', '0'),
(18, 'Give This Kid A Medal', 'Nice Answer1', '0'),
(19, 'Infinite IQ', 'Nice Answer2', '0'),
(20, 'Night Shifts', 'Night Shifts', '0'),
(21, 'No Bubblewrap Pops', 'No Bubblewrap pop', '0'),
(22, 'Santa ain\'t real', 'Santa ain\'t real', '0'),
(23, 'Student Life', 'Student Life', '0'),
(24, 'Telepathy 1000', 'Telepathy 1000', '0'),
(25, 'Who Made This', 'Who made this', '0');

-- --------------------------------------------------------

--
-- Table structure for table `memes_has_likes`
--

CREATE TABLE `memes_has_likes` (
  `users_username` varchar(45) NOT NULL,
  `memes_idmemes` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `username` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`username`, `password`) VALUES
('160420082', '160420082');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `memes`
--
ALTER TABLE `memes`
  ADD PRIMARY KEY (`idmemes`);

--
-- Indexes for table `memes_has_likes`
--
ALTER TABLE `memes_has_likes`
  ADD PRIMARY KEY (`users_username`,`memes_idmemes`),
  ADD KEY `fk_users_has_memes_memes1_idx` (`memes_idmemes`),
  ADD KEY `fk_users_has_memes_users_idx` (`users_username`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `memes`
--
ALTER TABLE `memes`
  MODIFY `idmemes` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `memes_has_likes`
--
ALTER TABLE `memes_has_likes`
  ADD CONSTRAINT `fk_users_has_memes_memes1` FOREIGN KEY (`memes_idmemes`) REFERENCES `memes` (`idmemes`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_users_has_memes_users` FOREIGN KEY (`users_username`) REFERENCES `users` (`username`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
