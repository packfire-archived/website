-- phpMyAdmin SQL Dump
-- http://www.phpmyadmin.net
--

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

CREATE DATABASE IF NOT EXISTS `pfweb`;

USE `pfweb`;

--
-- Database: `pfweb`
--

-- --------------------------------------------------------

--
-- Table structure for table `contents`
--

CREATE TABLE IF NOT EXISTS `contents` (
  `ContentId` int(11) NOT NULL AUTO_INCREMENT,
  `Title` varchar(50) NOT NULL,
  `Content` text NOT NULL,
  `Created` datetime NOT NULL,
  `Author` int(11) NOT NULL,
  `ContentType` int(11) NOT NULL,
  PRIMARY KEY (`ContentId`),
  KEY `fk_contents_users1` (`Author`),
  KEY `fk_contents_contenttypes1` (`ContentType`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `contenttypes`
--

CREATE TABLE IF NOT EXISTS `contenttypes` (
  `ContentTypeId` int(11) NOT NULL AUTO_INCREMENT,
  `ContentType` varchar(50) NOT NULL,
  PRIMARY KEY (`ContentTypeId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `UserId` int(11) NOT NULL AUTO_INCREMENT,
  `Username` varchar(50) NOT NULL,
  `Name` varchar(50) NOT NULL,
  `Password` varchar(80) NOT NULL,
  `Created` datetime NOT NULL,
  `Timezone` tinyint(4) NOT NULL,
  PRIMARY KEY (`UserId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `contents`
--
ALTER TABLE `contents`
  ADD CONSTRAINT `fk_contents_contenttypes1` FOREIGN KEY (`ContentType`) REFERENCES `contenttypes` (`ContentTypeId`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_contents_users10` FOREIGN KEY (`Author`) REFERENCES `users` (`UserId`) ON DELETE NO ACTION ON UPDATE NO ACTION;
