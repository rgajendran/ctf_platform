-- phpMyAdmin SQL Dump
-- version 4.6.6
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.3
-- Generation Time: Jul 03, 2017 at 04:34 PM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ctff`
--

-- --------------------------------------------------------

--
-- Table structure for table `chat`
--

CREATE TABLE `chat` (
  `ID` int(11) NOT NULL,
  `DATE` datetime NOT NULL,
  `USERNAME` varchar(50) NOT NULL,
  `TEAM` int(11) NOT NULL,
  `CHAT` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `hint`
--

CREATE TABLE `hint` (
  `ID` int(11) NOT NULL,
  `RANDOM` text NOT NULL,
  `TEAM` int(2) NOT NULL,
  `SYSTEM_NAME` varchar(100) NOT NULL,
  `C_ID` varchar(10) NOT NULL,
  `CHALLENGE` int(5) NOT NULL,
  `HINT_STATUS` int(1) NOT NULL,
  `HINT_ID` varchar(100) NOT NULL,
  `HINT_TYPE` varchar(100) NOT NULL,
  `HINT_TEXT` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- --------------------------------------------------------

--
-- Table structure for table `lockpick`
--

CREATE TABLE `lockpick` (
  `ID` int(2) NOT NULL,
  `NAME` varchar(50) NOT NULL,
  `FLAG` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `logger`
--

CREATE TABLE `logger` (
  `ID` int(11) NOT NULL,
  `DATE` datetime NOT NULL,
  `TEAM` int(2) NOT NULL,
  `LOG` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `options`
--

CREATE TABLE `options` (
  `ID` int(1) NOT NULL,
  `name` varchar(200) NOT NULL,
  `value` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `options`
--

INSERT INTO `options` (`ID`, `name`, `value`) VALUES
(1, 'ANNOUNCE', 'This is an announcement.'),
(2, 'END_TIME', '2017-06-25 00:02:00'),
(3, 'HOME_TIME', '2017-06-27 00:02:00'),
(4, 'LOGIN', 'ALLOW'),
(5, 'ADMINEDIT', 'ALLOW'),
(6, 'SCOREBOARD', 'ALLOW');

-- --------------------------------------------------------

--
-- Table structure for table `report`
--

CREATE TABLE `report` (
  `ID` int(11) NOT NULL,
  `DATE` datetime NOT NULL,
  `LOG` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `scoreboard`
--

CREATE TABLE `scoreboard` (
  `ID` int(2) NOT NULL,
  `TEAM` int(2) NOT NULL,
  `TEAMNAME` varchar(15) NOT NULL,
  `SCORE` double NOT NULL,
  `PENALTY` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `secgen`
--

CREATE TABLE `secgen` (
  `ID` int(4) NOT NULL,
  `C_NO` int(2) NOT NULL,
  `C_ID` varchar(10) NOT NULL,
  `C_COUNTRY` varchar(30) NOT NULL,
  `C_TITLE` varchar(30) NOT NULL,
  `X` int(4) NOT NULL,
  `Y` int(4) NOT NULL,
  `W` int(4) NOT NULL,
  `H` int(4) NOT NULL,
  `C_D` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `secgenflag`
--

CREATE TABLE `secgenflag` (
  `ID` int(11) NOT NULL,
  `TEAM` int(11) NOT NULL,
  `C_ID` varchar(6) NOT NULL,
  `STATUS` int(1) NOT NULL,
  `VM` varchar(200) NOT NULL,
  `IP` text NOT NULL,
  `FLAG` text NOT NULL,
  `FLAG_POINTS` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `team`
--

CREATE TABLE `team` (
  `ID` int(2) NOT NULL,
  `TEAM` varchar(2) NOT NULL,
  `TEAMNAME` varchar(15) NOT NULL,
  `LOGO` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `updater`
--

CREATE TABLE `updater` (
  `ID` int(2) NOT NULL,
  `TEAM` int(2) NOT NULL,
  `USERNAME` varchar(10) NOT NULL,
  `CHAT` int(1) NOT NULL,
  `ACTIVITY` int(1) NOT NULL,
  `SCORE` int(1) NOT NULL,
  `HINT` int(1) NOT NULL,
  `ANNOUNCE` int(1) NOT NULL,
  `FLAG` int(1) NOT NULL,
  `TIME` int(1) NOT NULL,
  `HINT_UPDATE` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `ID` int(2) NOT NULL,
  `USERNAME` varchar(50) NOT NULL,
  `PASSWORD` varchar(32) NOT NULL,
  `TEAM` int(2) NOT NULL,
  `TYPE` varchar(1) NOT NULL,
  `T_TYPE` varchar(1) NOT NULL,
  `TOKEN` varchar(8) NOT NULL,
  `TOKEN_HASH` varchar(32) NOT NULL,
  `TOKEN_ACT` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `hint`
--
ALTER TABLE `hint`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `lockpick`
--
ALTER TABLE `lockpick`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `logger`
--
ALTER TABLE `logger`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `options`
--
ALTER TABLE `options`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `report`
--
ALTER TABLE `report`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `scoreboard`
--
ALTER TABLE `scoreboard`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `secgen`
--
ALTER TABLE `secgen`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `secgenflag`
--
ALTER TABLE `secgenflag`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `team`
--
ALTER TABLE `team`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `updater`
--
ALTER TABLE `updater`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `chat`
--
ALTER TABLE `chat`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `hint`
--
ALTER TABLE `hint`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=727;
--
-- AUTO_INCREMENT for table `lockpick`
--
ALTER TABLE `lockpick`
  MODIFY `ID` int(2) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `logger`
--
ALTER TABLE `logger`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `options`
--
ALTER TABLE `options`
  MODIFY `ID` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `report`
--
ALTER TABLE `report`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `scoreboard`
--
ALTER TABLE `scoreboard`
  MODIFY `ID` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `secgen`
--
ALTER TABLE `secgen`
  MODIFY `ID` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=137;
--
-- AUTO_INCREMENT for table `secgenflag`
--
ALTER TABLE `secgenflag`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=177;
--
-- AUTO_INCREMENT for table `team`
--
ALTER TABLE `team`
  MODIFY `ID` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `updater`
--
ALTER TABLE `updater`
  MODIFY `ID` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `ID` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
