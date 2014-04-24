SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

DROP TABLE IF EXISTS `SENTIMENT`;
DROP TABLE IF EXISTS `TWEET_FOR_ANALYSIS`;
DROP TABLE IF EXISTS `TWEET_ENTRY`;
DROP TABLE IF EXISTS `EVENT`;

-- Event-Table where all events are saved
CREATE TABLE IF NOT EXISTS `EVENT` (
  `id` int(4) NOT NULL AUTO_INCREMENT, -- unique identifier of an event auto incremented
  `event_title` varchar(100) NOT NULL, -- the title of an event
  `event_description` varchar(1000) NOT NULL,
  `event_from` date DEFAULT NULL,
  `event_to` date DEFAULT NULL,
  `event_tw_count` int(6) DEFAULT NULL, -- tweet count
  `event_state` char(1) DEFAULT '0', -- 0 Initial ; 1 Sammlung aktiv ; 2 Sammlung beendet
  `event_tweet_tags` varchar(200) DEFAULT NULL, -- all tweet tags which should be considered, separeted with a special delimiter
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

INSERT INTO `EVENT` (`id`, `event_title`, `event_description`, `event_from`, `event_to`, `event_tw_count`, `event_tweet_tags`) VALUES
(1, 'Spielberg 2014', 'Eine kurze Beschreibung zum Spielberg Event', '2014-04-20', '2014-07-01', 100, 'Spielberg,F1');
INSERT INTO `EVENT` (`id`, `event_title`, `event_description`, `event_from`, `event_to`, `event_tw_count`, `event_tweet_tags`) VALUES
(2, 'Theater Mamma Mia 2014', 'Eine kurze Beschreibung zum MAMA MIA Event', '2014-04-01', '2014-12-24', 10, 'Mamma Mia,Pierce Brosnan');
INSERT INTO `EVENT` (`id`, `event_title`, `event_description`, `event_from`, `event_to`, `event_tw_count`, `event_tweet_tags`) VALUES
(3, 'Fu�ball WM 2014 Brasil', 'WM 2014', '2014-04-01', '2014-07-01', 1000, 'WM,2014,Brasilien');

-- Tweet entries for an event which are filled by a native java program
CREATE TABLE IF NOT EXISTS `TWEET_ENTRY` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `tw_text` varchar(4000) NOT NULL,
  `tw_creationdate` date NOT NULL,
  `tw_user` varchar(50) NOT NULL,
  `tw_location` varchar(100) DEFAULT NULL,
  `tw_language` char(2) DEFAULT NULL,
  `tw_deleted` char(1) DEFAULT '0',
  `event_id` int(4),
  PRIMARY KEY (`id`),
  FOREIGN KEY (`event_id`) REFERENCES `EVENT` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

-- Analysis table which tweet entries for an event should be considered for further processing
CREATE TABLE IF NOT EXISTS `TWEET_FOR_ANALYSIS` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `tweet_id` bigint(20) NOT NULL,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`tweet_id`) REFERENCES `TWEET_ENTRY` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4;

CREATE TABLE IF NOT EXISTS `SENTIMENT` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `sent_text` varchar(50) NOT NULL,
  `sent_weight` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6;