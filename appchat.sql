-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jul 12, 2022 at 03:11 PM
-- Server version: 5.7.36
-- PHP Version: 8.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `appchat`
--

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

DROP TABLE IF EXISTS `groups`;
CREATE TABLE IF NOT EXISTS `groups` (
  `groupId` int(11) NOT NULL AUTO_INCREMENT,
  `groupName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `userCreate` int(11) NOT NULL,
  `users` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`groupId`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`groupId`, `groupName`, `userCreate`, `users`) VALUES
(1, 'grupa', 4, '7,5'),
(2, 'gg', 4, '6'),
(3, 'nova grupa', 4, '5');

-- --------------------------------------------------------

--
-- Table structure for table `groupsmsg`
--

DROP TABLE IF EXISTS `groupsmsg`;
CREATE TABLE IF NOT EXISTS `groupsmsg` (
  `groupMsgId` int(11) NOT NULL AUTO_INCREMENT,
  `groupId` int(11) NOT NULL,
  `userFrom` int(11) NOT NULL,
  `msg` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`groupMsgId`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `groupsmsg`
--

INSERT INTO `groupsmsg` (`groupMsgId`, `groupId`, `userFrom`, `msg`) VALUES
(1, 1, 7, 'ee'),
(2, 1, 4, 'aa'),
(3, 1, 5, 'ok'),
(4, 3, 5, 'aaaa'),
(5, 1, 4, 'he');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

DROP TABLE IF EXISTS `messages`;
CREATE TABLE IF NOT EXISTS `messages` (
  `msgId` int(11) NOT NULL AUTO_INCREMENT,
  `userFrom` int(11) NOT NULL,
  `userTo` int(11) NOT NULL,
  `msg` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`msgId`)
) ENGINE=MyISAM AUTO_INCREMENT=22 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`msgId`, `userFrom`, `userTo`, `msg`) VALUES
(1, 4, 7, 'hej'),
(2, 4, 7, 'yo'),
(3, 4, 7, 'hfhf'),
(4, 4, 6, 'zz'),
(5, 7, 4, 'a'),
(6, 7, 4, 'ad'),
(7, 4, 7, 'd'),
(8, 7, 4, 'r'),
(9, 7, 4, 'fjdjf'),
(10, 4, 7, 'ccvee'),
(11, 4, 7, 'cvvr'),
(12, 4, 7, ':D'),
(13, 4, 7, 'f'),
(14, 4, 7, 'dfÄ‡'),
(15, 4, 7, 'df'),
(16, 4, 7, '&lt;b&gt;br&lt;/b&gt;'),
(17, 4, 7, '&lt;script&gt;alert(&#039;aha);&lt;/script&gt;'),
(18, 4, 7, '&lt;script&gt;alert(&#039;sada&#039;);&lt;/script&gt;'),
(19, 7, 4, 'ok'),
(20, 4, 7, 'hdd'),
(21, 4, 7, 'dd');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `userId` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`userId`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userId`, `username`, `email`, `password`, `image`) VALUES
(4, 'sajmon', 'stefan.sajmon@gmail.com', '$2y$10$VouTqbc9ryOsjzZrimESwu0H/U8iwBhImVmTym6chAqbbGvNH/lEi', 'http://localhost/webApplicationChat/public/img/defaults/head_turqoise.png'),
(5, 'demo', 'demo@gmail.com', '$2y$10$R.AfuYeSu.Yb2b3cTU2LhepEYpCK1qUMBeeJbGNzPRXc9ixkSOxI6', 'http://localhost/webApplicationChat/public/img/defaults/head_turqoise.png'),
(6, 'test', 'test@gmail.com', '$2y$10$sEy57yYlYPj9HlNJhJJx1OOFQXTBSJdUBhMLyU2V/VzjYYnbPmO.C', 'http://localhost/webApplicationChat/public/img/defaults/head_green_sea.png'),
(7, 'perica', 'perica@gmail.com', '$2y$10$A./SWKgFwlwRWAaXeBWx3.53Ek0g08O1Znuy0pGo4APT5.ByBOq8q', 'http://localhost/webApplicationChat/public/img/defaults/head_wet_asphalt.png');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
