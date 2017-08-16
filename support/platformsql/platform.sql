-- phpMyAdmin SQL Dump
-- version 4.6.6
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.3
-- Generation Time: Aug 16, 2017 at 10:41 PM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 5.6.31

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
  `CTF` varchar(1) NOT NULL,
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

INSERT INTO `backend` (`ID`, `CTF`, `SCENARIONAME`, `SCENARIO`, `PROCESSING`, `COMPLETED`, `FOLDER`, `BACKUP`, `VMNO`) VALUES
(8, 'T', 'flawed_fortress_1', 'scenarios/ctf/flawed_fortress_1.xml', '1', 0, 'VW4aBQEeuW', 'BACKUP1', 0),
(9, 'T', 'flawed_fortress_1', 'scenarios/ctf/flawed_fortress_1.xml', '1', 0, 'le4U1yLjFs', 'BACKUP2', 0),
(10, 'T', 'flawed_fortress_1', 'scenarios/ctf/flawed_fortress_1.xml', '1', 0, 'oll2Zz6GnJ', 'BACKUP3', 0);

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
  `TEMPLATE` varchar(50) NOT NULL,
  `TEAM_A` varchar(15) NOT NULL,
  `TEAM_B` varchar(15) NOT NULL,
  `TYPE` varchar(10) NOT NULL,
  `TITLE` varchar(20) NOT NULL,
  `DESP` text NOT NULL,
  `ANNOUNCE` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `game`
--

INSERT INTO `game` (`ID`, `HOST`, `GAME_ID`, `START_TIME`, `END_TIME`, `SCENARIO`, `TEMPLATE`, `TEAM_A`, `TEAM_B`, `TYPE`, `TITLE`, `DESP`, `ANNOUNCE`) VALUES
(39, '1000001', 'jlM5oH4QEI', '2017-08-13 21:02:00', '2017-08-13 22:03:00', 'flawed_fortress_1', 'ilK5UQ0Pya', 'TeamA', 'TeamB', 'closed', 'Testing', 'Tesing', ''),
(42, '1000001', 'r9QToQIeTA', '2015-03-25 23:00:00', '2015-03-25 23:50:00', 'flawed_fortress_1', 'ilK5UQ0Pyc', 'Deers', 'Rabbit', 'closed', 'SusmithaOne', 'SHHSHSHSH', ''),
(43, '1000001', '5ppJnzrzPs', '2017-08-16 13:00:00', '2017-08-16 23:59:00', 'flawed_fortress_1', 'ilK5UQ0Pya', 'TeamA', 'TeamB', 'closed', 'TeamTitle', 'Description', '');

-- --------------------------------------------------------

--
-- Table structure for table `game_players`
--

CREATE TABLE `game_players` (
  `ID` int(11) NOT NULL,
  `GAME_ID` varchar(10) NOT NULL,
  `TEAMNO` int(2) NOT NULL,
  `TEAM` varchar(15) NOT NULL,
  `PLAYER` varchar(10) NOT NULL,
  `P_STATUS` int(1) NOT NULL,
  `P_VM` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `game_players`
--

INSERT INTO `game_players` (`ID`, `GAME_ID`, `TEAMNO`, `TEAM`, `PLAYER`, `P_STATUS`, `P_VM`) VALUES
(152, 'jlM5oH4QEI', 0, 'TeamA', '1000005', 0, 'NA'),
(153, 'jlM5oH4QEI', 0, 'TeamA', '1000002', 0, 'NA'),
(154, 'jlM5oH4QEI', 0, 'TeamA', '1000001', 1, 'NA'),
(155, 'jlM5oH4QEI', 0, 'TeamB', '1000003', 0, 'NA'),
(156, 'jlM5oH4QEI', 0, 'TeamB', '1000004', 0, 'NA'),
(157, 'jlM5oH4QEI', 0, 'TeamB', '1000006', 0, 'NA'),
(158, 'VxNrY8CeZC', 0, 'TeamA', '1000005', 0, 'NA'),
(159, 'VxNrY8CeZC', 0, 'TeamA', '1000002', 0, 'NA'),
(160, 'VxNrY8CeZC', 0, 'TeamA', '1000001', 1, 'NA'),
(161, 'VxNrY8CeZC', 0, 'TeamB', '1000003', 0, 'NA'),
(162, 'VxNrY8CeZC', 0, 'TeamB', '1000004', 0, 'NA'),
(163, 'VxNrY8CeZC', 0, 'TeamB', '1000006', 0, 'NA'),
(164, 'RQYKCuNnMl', 0, 'Wolfs', '1000002', 0, 'NA'),
(165, 'RQYKCuNnMl', 0, 'Wolfs', '1000005', 0, 'NA'),
(166, 'RQYKCuNnMl', 0, 'Wolfs', '1000001', 1, 'NA'),
(167, 'RQYKCuNnMl', 0, 'Lions', '1000003', 0, 'NA'),
(168, 'RQYKCuNnMl', 0, 'Lions', '1000004', 0, 'NA'),
(169, 'RQYKCuNnMl', 0, 'Lions', '1000006', 0, 'NA'),
(170, 'r9QToQIeTA', 0, 'Deers', '1000005', 0, 'NA'),
(171, 'r9QToQIeTA', 0, 'Deers', '1000006', 0, 'NA'),
(172, 'r9QToQIeTA', 0, 'Deers', '1000003', 0, 'NA'),
(173, 'r9QToQIeTA', 0, 'Rabbit', '1000004', 0, 'NA'),
(174, 'r9QToQIeTA', 0, 'Rabbit', '1000002', 0, 'NA'),
(175, 'r9QToQIeTA', 0, 'Rabbit', '1000001', 1, 'NA'),
(176, '5ppJnzrzPs', 1, 'TeamA', '1000005', 0, 'NA'),
(177, '5ppJnzrzPs', 1, 'TeamA', '1000001', 1, 'NA'),
(178, '5ppJnzrzPs', 1, 'TeamA', '1000006', 0, 'NA'),
(179, '5ppJnzrzPs', 2, 'TeamB', '1000003', 0, 'NA'),
(180, '5ppJnzrzPs', 2, 'TeamB', '1000004', 0, 'NA'),
(181, '5ppJnzrzPs', 2, 'TeamB', '1000002', 0, 'NA');

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
  `GAME_ID` varchar(50) NOT NULL,
  `SCENARIO` varchar(50) NOT NULL,
  `TEMPLATE` varchar(20) NOT NULL,
  `USERID` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `scenariologger`
--

INSERT INTO `scenariologger` (`ID`, `GAME_ID`, `SCENARIO`, `TEMPLATE`, `USERID`) VALUES
(103, '5ppJnzrzPs', 'flawed_fortress_1', 'ilK5UQ0Pya', '1000005'),
(104, '5ppJnzrzPs', 'flawed_fortress_1', 'ilK5UQ0Pya', '1000001'),
(105, '5ppJnzrzPs', 'flawed_fortress_1', 'ilK5UQ0Pya', '1000006'),
(106, '5ppJnzrzPs', 'flawed_fortress_1', 'ilK5UQ0Pya', '1000003'),
(107, '5ppJnzrzPs', 'flawed_fortress_1', 'ilK5UQ0Pya', '1000004'),
(108, '5ppJnzrzPs', 'flawed_fortress_1', 'ilK5UQ0Pya', '1000002');

-- --------------------------------------------------------

--
-- Table structure for table `smenu`
--

CREATE TABLE `smenu` (
  `ID` int(11) NOT NULL,
  `DIR` varchar(5) NOT NULL,
  `TYPE` varchar(15) NOT NULL,
  `TEMP_SIZE` varchar(20) NOT NULL,
  `TEMP_SCENARIO` varchar(100) NOT NULL,
  `BACKUP1` varchar(50) NOT NULL,
  `BACKUP2` varchar(50) NOT NULL,
  `BACKUP3` varchar(50) NOT NULL,
  `VMNO` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `smenu`
--

INSERT INTO `smenu` (`ID`, `DIR`, `TYPE`, `TEMP_SIZE`, `TEMP_SCENARIO`, `BACKUP1`, `BACKUP2`, `BACKUP3`, `VMNO`) VALUES
(1, 'D', 'ctf', '1073741824', 'flawed_fortress_1', 'ilK5UQ0Pya', 'ilK5UQ0Pyz', 'ilK5UQ0Pyc', 0),
(2, 'D', 'game', '1073741824', 'edge_hill', '', 'ilK5UQ0Pyz', '', 0),
(3, 'D', 'game', '1073741824', 'kali_linux', '', 'ilK5UQ0Pyz', '', 0);

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
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `game`
--
ALTER TABLE `game`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;
--
-- AUTO_INCREMENT for table `game_players`
--
ALTER TABLE `game_players`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=182;
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
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=109;
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
