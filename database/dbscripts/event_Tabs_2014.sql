SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

DROP TABLE IF EXISTS `SENTIMENT`;
DROP TABLE IF EXISTS `FILT_COLUMN`;
DROP TABLE IF EXISTS `FILT_CONSIDER_TWEET`;
DROP TABLE IF EXISTS `FILT_IGNORE_TWEET`;
DROP TABLE IF EXISTS `TWEET_FILTER`;
DROP TABLE IF EXISTS `TWEET_TAG`;
DROP TABLE IF EXISTS `TWEET_ENTRIES`;
DROP TABLE IF EXISTS `EVENT`;

# Event-Table where all events are saved
CREATE TABLE IF NOT EXISTS `EVENT` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `event_title` varchar(100) NOT NULL,
  `event_description` varchar(1000) NOT NULL,
  `event_from` date DEFAULT NULL,
  `event_to` date DEFAULT NULL,
  `event_tw_count` int(6) DEFAULT NULL, #tweet count
  `event_state` char(1) DEFAULT '0', #0 Initial ; 1 Sammlung aktiv ; 2 Sammlung beendet
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

INSERT INTO `EVENT` (`id`, `event_title`, `event_description`, `event_from`, `event_to`, `event_tw_count`) VALUES
(1, 'Spielberg 2014', 'Eine kurze Beschreibung zum Spielberg Event', '2014-05-24', '2014-07-01', 100);
INSERT INTO `EVENT` (`id`, `event_title`, `event_description`, `event_from`, `event_to`, `event_tw_count`) VALUES
(2, 'Theater Mamma Mia 2014', 'Eine kurze Beschreibung zum MAMA MIA Event', '2014-10-01', '2014-12-24', 100);

# Tweet Tags, which will be considered at collection time. These tags belongs to one event. At least one tag must exists for each event.
CREATE TABLE IF NOT EXISTS `TWEET_TAG` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `tag_name` varchar(50) NOT NULL,
  `event_id` int(4),
  PRIMARY KEY (`id`),
  FOREIGN KEY (`event_id`) REFERENCES `EVENT` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

INSERT INTO `TWEET_TAG` (`id`, `tag_name`, `event_id`) VALUES (1, 'Spielberg', 1);
INSERT INTO `TWEET_TAG` (`id`, `tag_name`, `event_id`) VALUES (2, 'F1', 1);
INSERT INTO `TWEET_TAG` (`id`, `tag_name`, `event_id`) VALUES (3, 'Vettel', 1);
INSERT INTO `TWEET_TAG` (`id`, `tag_name`, `event_id`) VALUES (4, 'Abba', 2);
INSERT INTO `TWEET_TAG` (`id`, `tag_name`, `event_id`) VALUES (5, 'Mama Mia', 2);

# Tweet entries per Event
CREATE TABLE IF NOT EXISTS `TWEET_ENTRIES` (
  `tweet_id` int(8) NOT NULL AUTO_INCREMENT,
  `tw_text` varchar(4000) NOT NULL,
  `tw_creationdate` date NOT NULL,
  `tw_user` varchar(50) NOT NULL,
  `tw_location` varchar(100) DEFAULT NULL,
  `tw_language` char(2) DEFAULT NULL,
  `tw_deleted` char(1) DEFAULT '0',
  `event_id` int(4),
  PRIMARY KEY (`tweet_id`),
  FOREIGN KEY (`event_id`) REFERENCES `EVENT` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

INSERT INTO `TWEET_ENTRIES` (`tweet_id`, `tw_text`, `tw_creationdate`, `tw_user`, `tw_location`, `tw_language`, `event_id`) VALUES
(1, 'Well done - got the ticket for Spielberg GP 2014', '2014-05-05', 'Micael Steward', 'München', 'at', 1);
INSERT INTO `TWEET_ENTRIES` (`tweet_id`, `tw_text`, `tw_creationdate`, `tw_user`, `tw_location`, `tw_language`, `event_id`) VALUES
(2, 'I love Steven Spielberg', '2014-04-03', 'Doris Hart', 'Klagenfurt', 'at', 1);

CREATE TABLE IF NOT EXISTS `TWEET_FILTER` (
  `filter_id` int(4) NOT NULL AUTO_INCREMENT,
  `fi_description` varchar(100) NOT NULL,
  `fi_consider_tweet` varchar(100) DEFAULT NULL,
  `IGNORE_TWEET` varchar(100) DEFAULT NULL,
  `TIME_START` date NOT NULL,
  `TIME_END` date NOT NULL,
  `EVENT_ID` int(4),
  PRIMARY KEY (`FILTER_ID`),
  FOREIGN KEY (`EVENT_ID`) REFERENCES `EVENT` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

# All tweet descriptions in this table will be ignored for the filter
CREATE TABLE IF NOT EXISTS `FILT_IGNORE_TWEET` (
  `filt_ignore_id` int(4) NOT NULL AUTO_INCREMENT,
  `ignored_tweet` varchar(100) DEFAULT NULL,
  `filter_id` int(4),
  PRIMARY KEY (`filt_ignore_id`),
  FOREIGN KEY (`filter_id`) REFERENCES `TWEET_FILTER` (`filter_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4;

# All tweet descriptions in this table will be considered for the filter
CREATE TABLE IF NOT EXISTS `FILT_CONSIDER_TWEET` (
  `filt_consider_id` int(4) NOT NULL AUTO_INCREMENT,
  `consider_tweet` varchar(100) DEFAULT NULL,
  `filter_id` int(4),
  PRIMARY KEY (`filt_consider_id`),
  FOREIGN KEY (`filter_id`) REFERENCES `TWEET_FILTER` (`filter_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4;

# All tweets in this table will be hide
CREATE TABLE IF NOT EXISTS `FILT_COLUMN` (
  `filt_column_id` int(4) NOT NULL AUTO_INCREMENT,
  `filter_id` int(4),
  `tweet_id` int(8),
  PRIMARY KEY (`filt_column_id`),
  FOREIGN KEY (`filter_id`) REFERENCES `TWEET_FILTER` (`filter_id`),
  FOREIGN KEY (`tweet_id`) REFERENCES `TWEET_ENTRIES` (`tweet_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4;

CREATE TABLE IF NOT EXISTS `SENTIMENT` (
  `sent_id` int(8) NOT NULL AUTO_INCREMENT,
  `sent_text` varchar(50) NOT NULL,
  `sent_weight` int(1) NOT NULL,
  PRIMARY KEY (`sent_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6;