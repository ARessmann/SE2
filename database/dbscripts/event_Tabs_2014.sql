-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Erstellungszeit: 01. Mai 2014 um 14:45
-- Server Version: 5.5.32
-- PHP-Version: 5.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Datenbank: `twitteranalyser`
--
CREATE DATABASE IF NOT EXISTS `twitteranalyser` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `twitteranalyser`;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `event`
--

CREATE TABLE IF NOT EXISTS `event` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `event_title` varchar(100) NOT NULL,
  `event_description` varchar(1000) NOT NULL,
  `event_from` date DEFAULT NULL,
  `event_to` date DEFAULT NULL,
  `event_tw_count` int(6) DEFAULT NULL,
  `event_state` char(1) DEFAULT '0',
  `event_tweet_tags` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Daten für Tabelle `event`
--

INSERT INTO `event` (`id`, `event_title`, `event_description`, `event_from`, `event_to`, `event_tw_count`, `event_state`, `event_tweet_tags`) VALUES
(1, 'Spielberg 2014', 'Eine kurze Beschreibung zum Spielberg Event', '2014-04-20', '2014-07-01', 100, '0', 'Spielberg,F1'),
(2, 'Theater Mamma Mia 2014', 'Eine kurze Beschreibung zum MAMA MIA Event', '2014-04-01', '2014-12-24', 10, '0', 'Mamma Mia,Pierce Brosnan'),
(3, 'Fu?ball WM 2014 Brasil', 'WM 2014', '2014-04-01', '2014-07-01', 1000, '0', 'WM,2014,Brasilien');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `filter`
--

CREATE TABLE IF NOT EXISTS `filter` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `filter_tags` varchar(1000) DEFAULT NULL,
  `filter_from` date DEFAULT NULL,
  `filter_to` date DEFAULT NULL,
  `filter_location` varchar(100) DEFAULT NULL,
  `filter_language` char(2) DEFAULT NULL,
  `event_id` int(4) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `event_id` (`event_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `sentiment`
--

CREATE TABLE IF NOT EXISTS `sentiment` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `sent_text` varchar(50) NOT NULL,
  `sent_weight` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `tweet_entry`
--

CREATE TABLE IF NOT EXISTS `tweet_entry` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `tw_text` varchar(4000) NOT NULL,
  `tw_creationdate` date NOT NULL,
  `tw_user` varchar(50) NOT NULL,
  `tw_location` varchar(100) DEFAULT NULL,
  `tw_language` char(2) DEFAULT NULL,
  `tw_deleted` char(1) DEFAULT '0',
  `event_id` int(4) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `event_id` (`event_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `tweet_for_analysis`
--

CREATE TABLE IF NOT EXISTS `tweet_for_analysis` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `tweet_id` bigint(20) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `tweet_id` (`tweet_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `filter`
--
ALTER TABLE `filter`
  ADD CONSTRAINT `filter_ibfk_1` FOREIGN KEY (`event_id`) REFERENCES `event` (`id`);

--
-- Constraints der Tabelle `tweet_entry`
--
ALTER TABLE `tweet_entry`
  ADD CONSTRAINT `tweet_entry_ibfk_1` FOREIGN KEY (`event_id`) REFERENCES `event` (`id`);

--
-- Constraints der Tabelle `tweet_for_analysis`
--
ALTER TABLE `tweet_for_analysis`
  ADD CONSTRAINT `tweet_for_analysis_ibfk_1` FOREIGN KEY (`tweet_id`) REFERENCES `tweet_entry` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
