-- phpMyAdmin SQL Dump
-- version 3.3.3
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 16, 2017 at 12:43 PM
-- Server version: 5.5.51
-- PHP Version: 5.4.45

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `patchA`
--

-- --------------------------------------------------------

--
-- Table structure for table `CHANGES`
--

CREATE TABLE IF NOT EXISTS `CHANGES` (
  `date` varchar(10) DEFAULT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `isApproved` int(1) NOT NULL DEFAULT '0',
  `isExpired` int(1) NOT NULL DEFAULT '0',
  `requestedBy` varchar(40) CHARACTER SET utf8 NOT NULL,
  `approvedBy` varchar(40) CHARACTER SET utf8 DEFAULT NULL,
  `servers` varchar(16000) CHARACTER SET utf8 NOT NULL,
  `time` varchar(8) DEFAULT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `whatwhy` varchar(1000) NOT NULL,
  `how` varchar(1000) DEFAULT NULL,
  `resources` varchar(400) DEFAULT NULL,
  `software_systems` varchar(40) NOT NULL,
  `duration` varchar(20) NOT NULL,
  `requester_email` varchar(50) DEFAULT NULL,
  `decline_reason` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=54 ;

-- --------------------------------------------------------

--
-- Table structure for table `EXCEPTIONS`
--

CREATE TABLE IF NOT EXISTS `EXCEPTIONS` (
  `User` varchar(40) NOT NULL,
  `Reason` varchar(500) NOT NULL,
  `time_requested` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `change_id` int(11) NOT NULL,
  PRIMARY KEY (`time_requested`),
  KEY `User` (`User`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `SERVERS`
--

CREATE TABLE IF NOT EXISTS `SERVERS` (
  `NAME` varchar(100) NOT NULL,
  `TYPE` varchar(100) DEFAULT NULL,
  `DOMAIN` varchar(100) DEFAULT NULL,
  `OS` varchar(100) DEFAULT NULL,
  `IP` varchar(100) DEFAULT NULL,
  `MAC` varchar(100) DEFAULT NULL,
  `BARCODE` varchar(100) DEFAULT NULL,
  `SERIAL` varchar(100) DEFAULT NULL,
  `LAST_PATCHED` varchar(100) DEFAULT NULL,
  `LAST_FULL_BACKUP` varchar(100) DEFAULT NULL,
  `LAST_IMAGE` varchar(100) DEFAULT NULL,
  KEY `NAME` (`NAME`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
