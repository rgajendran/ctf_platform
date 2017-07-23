-- phpMyAdmin SQL Dump
-- version 4.6.6
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.3
-- Generation Time: Jul 23, 2017 at 01:11 AM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `platform`
--

-- --------------------------------------------------------

--
-- Table structure for table `backend`
--

CREATE TABLE `backend` (
  `ID` int(11) NOT NULL,
  `SCENARIONAME` varchar(50) NOT NULL,
  `SCENARIO` varchar(50) NOT NULL,
  `PROCESSING` varchar(1) NOT NULL,
  `COMPLETED` int(1) NOT NULL,
  `FOLDER` varchar(50) NOT NULL,
  `BACKUP` varchar(8) NOT NULL,
  `VMNO` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `backend`
--

INSERT INTO `backend` (`ID`, `SCENARIONAME`, `SCENARIO`, `PROCESSING`, `COMPLETED`, `FOLDER`, `BACKUP`, `VMNO`) VALUES
(1, 'NS', 'scenarios/ctf/flawed_fortress_1.xml', '1', 0, 'KW4gTCt8BL', 'BACKUP1', 3),
(2, 'NS2', 'scenarios/default_scenario.xml', '1', 0, 'RaSm5JamGc', 'BACKUP2', 1);

-- --------------------------------------------------------

--
-- Table structure for table `game`
--

CREATE TABLE `game` (
  `ID` int(11) NOT NULL,
  `HOST` varchar(15) NOT NULL,
  `GAME_ID` varchar(10) NOT NULL,
  `START_TIME` datetime NOT NULL,
  `END_TIME` datetime NOT NULL,
  `SCENARIO` varchar(50) NOT NULL,
  `TEAM_A` varchar(15) NOT NULL,
  `TEAM_B` varchar(15) NOT NULL,
  `TYPE` varchar(10) NOT NULL,
  `TITLE` varchar(20) NOT NULL,
  `DESP` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `game`
--

INSERT INTO `game` (`ID`, `HOST`, `GAME_ID`, `START_TIME`, `END_TIME`, `SCENARIO`, `TEAM_A`, `TEAM_B`, `TYPE`, `TITLE`, `DESP`) VALUES
(1, 'gaju', 'nOI2x6701N', '2017-06-29 01:00:00', '2017-06-22 02:00:00', 'Liverpool', 'TeamA', 'TeamB', 'openforall', '', 'asdasd'),
(2, 'gaju', 'hCfjBhGzw5', '2017-06-22 01:00:00', '2017-06-22 02:00:00', 'Liverpool', 'TeamA', 'TeamB', 'openforall', '', 'asdasd'),
(3, 'gaju', 'OZGsAZ6K5a', '2017-06-22 01:00:00', '2017-06-22 02:00:00', 'Liverpool', 'TeamA', 'TeamB', 'openforall', '', 'asdasd'),
(4, 'gaju', '9w1sefZriT', '2017-06-22 02:00:00', '2017-06-22 04:00:00', 'Liverpool', 'TeamA', 'TeamB', 'closed', '', 'fghfhgfgh'),
(5, 'gaju', 'g8bqFmNfKM', '2017-06-22 02:00:00', '2017-06-22 04:00:00', 'Liverpool', 'TeamA', 'TeamB', 'closed', '', 'fghfhgfgh'),
(6, 'gaju', 'cVVvfPA93A', '2017-06-23 02:00:00', '2017-06-23 04:00:00', 'Liverpool', 'TEAMA', 'TEAMB', 'closed', '', 'Desc'),
(7, 'gaju', 'NOQvpikKbn', '2017-06-25 02:00:00', '2017-06-23 04:00:00', 'Liverpool', 'TEAMA', 'TEAMB', 'closed', '', 'Desc'),
(8, 'hiran', '75g6r9DO3A', '2017-06-27 13:00:00', '2017-06-27 19:00:00', 'Liverpool', 'TEAM A', 'TEAM B', 'openforall', 'MYCUSTOMGAME', 'This game is the best feature of the main event'),
(9, 'gaju', 'aCUOMnAg5j', '2017-06-27 06:00:00', '2017-06-28 01:00:00', 'Liverpool', 'TeamA_NAME', 'TeamB_NAME', 'closed', 'sdfgsf', 'fdgdfg'),
(10, 'gaju', 'c3Dr9lnEyN', '2017-06-29 00:01:00', '2017-06-29 02:00:00', 'Liverpool', 'hgfhgfh', 'ghfghgfh', 'closed', 'dghfh', 'hgfhfgh'),
(11, 'gaju', 'a2k485kwpW', '2017-06-29 20:22:00', '2017-06-29 21:30:00', 'Liverpool', 'TeamA', 'TeamB', 'closed', 'CustomGame', 'CustomGame'),
(12, 'gaju', 'KYinjvujAL', '2017-06-28 21:00:00', '2017-06-28 23:00:00', 'Liverpool', 'TEAMA', 'TEAMB', 'closed', 'Game', 'Desc'),
(13, 'gaju', 'TtoKoWQVVj', '2017-08-15 15:00:00', '2017-08-15 21:00:00', 'Liverpool', 'TeamA', 'TeamB', 'openforall', 'GameTitle', 'Description');

-- --------------------------------------------------------

--
-- Table structure for table `game_players`
--

CREATE TABLE `game_players` (
  `ID` int(11) NOT NULL,
  `GAME_ID` varchar(10) NOT NULL,
  `TEAM` varchar(15) NOT NULL,
  `PLAYER` varchar(10) NOT NULL,
  `P_STATUS` int(1) NOT NULL,
  `P_VM` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `game_players`
--

INSERT INTO `game_players` (`ID`, `GAME_ID`, `TEAM`, `PLAYER`, `P_STATUS`, `P_VM`) VALUES
(1, '9w1sefZriT', 'TeamA', '1000002', 1, 'NA'),
(2, '9w1sefZriT', 'TeamA', '1000005', 0, 'NA'),
(3, '9w1sefZriT', 'TeamB', '1000001', 1, 'NA'),
(4, '9w1sefZriT', 'TeamB', '1000003', 0, 'NA'),
(5, '9w1sefZriT', 'TeamB', '1000004', 0, 'NA'),
(6, 'g8bqFmNfKM', 'TeamA', '1000002', 1, 'NA'),
(7, 'g8bqFmNfKM', 'TeamA', '1000005', 0, 'NA'),
(8, 'g8bqFmNfKM', 'TeamB', '1000001', 1, 'NA'),
(9, 'g8bqFmNfKM', 'TeamB', '1000003', 0, 'NA'),
(10, 'g8bqFmNfKM', 'TeamB', '1000004', 0, 'NA'),
(11, 'cVVvfPA93A', 'TEAMA', '1000003', 0, 'NA'),
(12, 'cVVvfPA93A', 'TEAMA', '1000004', 0, 'NA'),
(13, 'cVVvfPA93A', 'TEAMB', '1000002', 1, 'NA'),
(14, 'cVVvfPA93A', 'TEAMB', '1000005', 0, 'NA'),
(15, 'NOQvpikKbn', 'TEAMA', '1000003', 0, 'NA'),
(16, 'NOQvpikKbn', 'TEAMA', '1000004', 0, 'NA'),
(17, 'NOQvpikKbn', 'TEAMA', '1000001', 1, 'NA'),
(18, 'NOQvpikKbn', 'TEAMB', '1000002', 1, 'NA'),
(19, 'NOQvpikKbn', 'TEAMB', '1000005', 0, 'NA'),
(20, 'aCUOMnAg5j', 'TeamA_NAME', '1000002', 1, 'NA'),
(21, 'aCUOMnAg5j', 'TeamA_NAME', '1000005', 0, 'NA'),
(22, 'aCUOMnAg5j', 'TeamA_NAME', '1000003', 0, 'NA'),
(23, 'aCUOMnAg5j', 'TeamB_NAME', '1000001', 1, 'NA'),
(24, 'aCUOMnAg5j', 'TeamB_NAME', '1000004', 0, 'NA'),
(25, 'aCUOMnAg5j', 'TeamB_NAME', '1000006', 0, 'NA'),
(26, 'c3Dr9lnEyN', 'hgfhgfh', '1000002', 0, 'NA'),
(27, 'c3Dr9lnEyN', 'hgfhgfh', '1000005', 0, 'NA'),
(28, 'c3Dr9lnEyN', 'hgfhgfh', '1000006', 0, 'NA'),
(29, 'c3Dr9lnEyN', 'ghfghgfh', '1000001', 0, 'NA'),
(30, 'c3Dr9lnEyN', 'ghfghgfh', '1000003', 0, 'NA'),
(31, 'c3Dr9lnEyN', 'ghfghgfh', '1000004', 0, 'NA'),
(32, 'a2k485kwpW', 'TeamA', '1000002', 0, 'NA'),
(33, 'a2k485kwpW', 'TeamA', '1000005', 0, 'NA'),
(34, 'a2k485kwpW', 'TeamA', '1000003', 0, 'NA'),
(35, 'a2k485kwpW', 'TeamB', '1000004', 0, 'NA'),
(36, 'a2k485kwpW', 'TeamB', '1000001', 0, 'NA'),
(37, 'a2k485kwpW', 'TeamB', '1000006', 0, 'NA'),
(38, 'KYinjvujAL', 'TEAMA', '1000002', 0, 'NA'),
(39, 'KYinjvujAL', 'TEAMA', '1000005', 0, 'NA'),
(40, 'KYinjvujAL', 'TEAMA', '1000003', 0, 'NA'),
(41, 'KYinjvujAL', 'TEAMB', '1000004', 0, 'NA'),
(42, 'KYinjvujAL', 'TEAMB', '1000001', 1, 'NA'),
(43, 'KYinjvujAL', 'TEAMB', '1000006', 0, 'NA');

-- --------------------------------------------------------

--
-- Table structure for table `log`
--

CREATE TABLE `log` (
  `ID` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `log` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `log`
--

INSERT INTO `log` (`ID`, `date`, `log`) VALUES
(1, '0000-00-00 00:00:00', 'Crontab Job'),
(2, '0000-00-00 00:00:00', 'Crontab Job'),
(3, '0000-00-00 00:00:00', 'Crontab Job'),
(4, '0000-00-00 00:00:00', 'Crontab Job'),
(5, '0000-00-00 00:00:00', 'Crontab Job'),
(6, '0000-00-00 00:00:00', 'Crontab Job'),
(7, '0000-00-00 00:00:00', 'Crontab Job'),
(8, '0000-00-00 00:00:00', 'Crontab Job'),
(9, '0000-00-00 00:00:00', 'Crontab Job'),
(10, '2015-00-06 16:21:00', 'Crontab Job'),
(11, '0000-00-00 00:00:00', 'Crontab Job'),
(12, '0000-00-00 00:00:00', 'Crontab Job');

-- --------------------------------------------------------

--
-- Table structure for table `loginusers`
--

CREATE TABLE `loginusers` (
  `ID` int(11) NOT NULL,
  `USERID` varchar(10) NOT NULL,
  `USERNAME` varchar(20) NOT NULL,
  `PASSWORD` varchar(32) NOT NULL,
  `TYPE` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `loginusers`
--

INSERT INTO `loginusers` (`ID`, `USERID`, `USERNAME`, `PASSWORD`, `TYPE`) VALUES
(1, '1000001', 'gaju', '091b76e215ab9bef68abf265a1c1b267', 'A'),
(2, '1000002', 'tom', '091b76e215ab9bef68abf265a1c1b267', 'N'),
(3, '1000003', 'kapil', '091b76e215ab9bef68abf265a1c1b267', 'N'),
(4, '1000004', 'kapildev', '091b76e215ab9bef68abf265a1c1b267', 'N'),
(5, '1000005', 'cliffe', '091b76e215ab9bef68abf265a1c1b267', 'N'),
(6, '1000006', 'something', '091b76e215ab9bef68abf265a1c1b267', 'N');

-- --------------------------------------------------------

--
-- Table structure for table `scenariologger`
--

CREATE TABLE `scenariologger` (
  `ID` int(11) NOT NULL,
  `SCENARIO` varchar(50) NOT NULL,
  `USERID` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `smenu`
--

CREATE TABLE `smenu` (
  `ID` int(11) NOT NULL,
  `DIR` varchar(5) NOT NULL,
  `TYPE` varchar(15) NOT NULL,
  `TEMPLATE` varchar(50) NOT NULL,
  `TEMP_SIZE` varchar(20) NOT NULL,
  `TEMP_NAME` varchar(50) NOT NULL,
  `TEMP_SCENARIO` varchar(100) NOT NULL,
  `BACKUP1` varchar(50) NOT NULL,
  `BACKUP2` varchar(50) NOT NULL,
  `BACKUP3` varchar(50) NOT NULL,
  `VMNO` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `smenu`
--

INSERT INTO `smenu` (`ID`, `DIR`, `TYPE`, `TEMPLATE`, `TEMP_SIZE`, `TEMP_NAME`, `TEMP_SCENARIO`, `BACKUP1`, `BACKUP2`, `BACKUP3`, `VMNO`) VALUES
(1, 'D', 'ctf', 'vagrant-debian7', '1073741824', 'Liverpool', '', '', '', '', 0),
(2, 'D', 'game', 'vagrant-debian77', '1073741824', 'Edge_Hill', '', '', '', '', 0),
(3, 'D', 'game', 'KaliLinux', '1073741824', 'Kali_Linux', '', '', '', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `teams`
--

CREATE TABLE `teams` (
  `ID` int(11) NOT NULL,
  `HOST` varchar(20) NOT NULL,
  `TEAM` varchar(15) NOT NULL,
  `P_1` varchar(20) NOT NULL,
  `P_2` varchar(20) NOT NULL,
  `P_3` varchar(20) NOT NULL,
  `P_4` varchar(20) NOT NULL,
  `P_5` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `teams`
--

INSERT INTO `teams` (`ID`, `HOST`, `TEAM`, `P_1`, `P_2`, `P_3`, `P_4`, `P_5`) VALUES
(18, 'gaju', 'dsfg', 'gaju', 'kapil', 'kapildev', 'something', 'tom'),
(19, 'gaju', 'Gajendra', 'something', 'cliffe', 'tom', 'kapil', 'kapildev');

-- --------------------------------------------------------

--
-- Table structure for table `vm`
--

CREATE TABLE `vm` (
  `ID` int(11) NOT NULL,
  `USERNAME` varchar(50) NOT NULL,
  `VMNAME` varchar(100) NOT NULL,
  `VMID` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vm`
--

INSERT INTO `vm` (`ID`, `USERNAME`, `VMNAME`, `VMID`) VALUES
(2, 'hiran', 'hiran_My_FIRST_VM_auVDHnpMY3', 'd69171aa-8e19-4326-9c67-821165a7d66b'),
(5, 'gaju', 'gaju_MYNEWVM_ZRYzwOtKRk', '255d7d67-7f00-462d-ac3d-13b4cc01ac47'),
(6, 'gaju', 'gaju_Kali_linux_gs8buUOcfr', 'd7781f6c-1021-4ef2-aa90-c37c40cb5ef2');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `backend`
--
ALTER TABLE `backend`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `game`
--
ALTER TABLE `game`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `game_players`
--
ALTER TABLE `game_players`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `log`
--
ALTER TABLE `log`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `loginusers`
--
ALTER TABLE `loginusers`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `scenariologger`
--
ALTER TABLE `scenariologger`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `smenu`
--
ALTER TABLE `smenu`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `teams`
--
ALTER TABLE `teams`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `vm`
--
ALTER TABLE `vm`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `backend`
--
ALTER TABLE `backend`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `game`
--
ALTER TABLE `game`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `game_players`
--
ALTER TABLE `game_players`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;
--
-- AUTO_INCREMENT for table `log`
--
ALTER TABLE `log`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `loginusers`
--
ALTER TABLE `loginusers`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `scenariologger`
--
ALTER TABLE `scenariologger`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `smenu`
--
ALTER TABLE `smenu`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `teams`
--
ALTER TABLE `teams`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `vm`
--
ALTER TABLE `vm`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
