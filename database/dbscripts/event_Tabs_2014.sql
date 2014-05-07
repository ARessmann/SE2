-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Erstellungszeit: 07. Mai 2014 um 18:33
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

DROP TABLE IF EXISTS `event`;
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
(1, 'Spielberg 2014', 'Eine kurze Beschreibung zum Spielberg Event', '2014-04-20', '2014-07-01', 100, '2', 'Spielberg,F1'),
(2, 'Theater Mamma Mia 2014', 'Eine kurze Beschreibung zum MAMA MIA Event', '2014-04-01', '2014-12-24', 10, '2', 'Mamma Mia,Pierce Brosnan'),
(3, 'Fu?ball WM 2014 Brasil', 'WM 2014', '2014-04-01', '2014-07-01', 1000, '2', 'WM,2014,Brasilien');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `filter`
--

DROP TABLE IF EXISTS `filter`;
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Daten für Tabelle `filter`
--

INSERT INTO `filter` (`id`, `filter_tags`, `filter_from`, `filter_to`, `filter_location`, `filter_language`, `event_id`) VALUES
(1, 'test', '2014-05-08', '2014-05-16', '', '', 1);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `sentiment`
--

DROP TABLE IF EXISTS `sentiment`;
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

DROP TABLE IF EXISTS `tweet_entry`;
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=462988547226886145 ;

--
-- Daten für Tabelle `tweet_entry`
--

INSERT INTO `tweet_entry` (`id`, `tw_text`, `tw_creationdate`, `tw_user`, `tw_location`, `tw_language`, `tw_deleted`, `event_id`) VALUES
(460249863809024000, 'Re: WM 2014 Brasilien http://t.co/fNIjlrDWhU', '2014-04-27', 'Brasilienfreunde', '', 'de', '0', 3),
(460296181185138689, 'Re: WM 2014 Brasilien http://t.co/SSgumdoAYI', '2014-04-27', 'Brasilienfreunde', '', 'de', '0', 3),
(460304483570827265, '#Nachttalk: 2254: Gewalt in Brasilien - Fußball-WM um jeden Preis? http://t.co/rdzq7W9kD9 (MP3)', '2014-04-27', 'DKultur', 'Kultur ist überall.', 'de', '0', 3),
(460318663900680192, 'RT @DKultur: #Nachttalk: 2254: Gewalt in Brasilien - Fußball-WM um jeden Preis? http://t.co/rdzq7W9kD9 (MP3)', '2014-04-27', 'Birte Förster', 'opinions are my own', 'de', '0', 3),
(460321323773067264, 'Ausschreitungen und Tote in Brasilien | Warum hasst das Land, das den Fußball ... - BILD http://t.co/so0PY4CTgU #fußball', '2014-04-27', 'Fussball Guru', '', 'de', '0', 3),
(460322245076713472, 'Panini WM 2014 Brasilien - 50 Bilder aussuchen -:  EUR 1,00 (0 Gebote)Angebotsende: Montag Apr-28-2014 9:16:19... http://t.co/ZQJhdDPjB7', '2014-04-27', 'Quickberater', 'Germany', 'de', '0', 3),
(460333073994088448, 'http://t.co/xF7oyAIOL4 Video: Fußball-WM 2014 in Brasilien und ob Luis Gustavo, Pepe oder Luka Modric,  ... http://t.co/n48SjDn6IT', '2014-04-27', 'Harald von der Ems', '', 'de', '0', 3),
(460341522484191232, 'RT @Wissensbox: #Prostituierte in #Brasilien können an kostenlosen Englischkursen teilnehmen, um in der WM 2014 bessere Dienste anzubieten.', '2014-04-27', 'MrEmanuelPlays', 'Meist auf YouTube :D', 'de', '0', 3),
(460343129032257536, 'Re: WM 2014 Brasilien http://t.co/bqGP19LNxK', '2014-04-27', 'Brasilienfreunde', '', 'de', '0', 3),
(460344930049994753, 'RT @DKultur: #Nachttalk: 2254: Gewalt in Brasilien - Fußball-WM um jeden Preis? http://t.co/rdzq7W9kD9 (MP3)', '2014-04-27', 'Wolfgang Bogler', 'Saarland, Saarbrücken', 'de', '0', 3),
(460349468374614017, 'Angebotsende: Panini WM 2014 Brasilien - 50 Bilder aussuchen -:  EUR 6,20 (3 Gebote)Angebotsende: Son... http://t.co/TvdTfWOF13 @Ebay AT', '2014-04-27', 'The Deals Planet', '', 'fr', '0', 3),
(460362516787253248, 'Re: WM 2014 Brasilien http://t.co/MgE3cm5ukD', '2014-04-27', 'Brasilienfreunde', '', 'de', '0', 3),
(460363392474025984, 'Panini WM 2014 Brasilien - 50 Bilder aussuchen -:  EUR 1,00 (1 Gebot)Angebotsende: Montag Apr-28-2014 10:20:35... http://t.co/1pF0cU3R9A', '2014-04-27', 'Quickberater', 'Germany', 'de', '0', 3),
(460363393119956993, 'Panini WM 2014 Brasilien - 50 Bilder aussuchen -:  EUR 1,00 (1 Gebot)Angebotsende: Montag Apr-28-2014 11:28:56... http://t.co/PKV4pLTz7y', '2014-04-27', 'Quickberater', 'Germany', 'de', '0', 3),
(460363489387614208, 'eine Feder...\nhttp://t.co/oqL29Ueshf http://t.co/bHCVzkOlGw', '2014-04-27', 'Júlio Daldon', '', 'en', '0', 3),
(460378267892342784, 'RT @GoogleFakten: Prostituierte in Brasilien können an kostenlosen Englischkursen teilnehmen, um in der WM 2014 bessere Dienste anzubieten.', '2014-04-27', 'MyAssIsFamous', 'Germany', 'de', '0', 3),
(460391727527133184, 'Stimmen Sie sich ein auf die WM 2014 in Brasilien! Unnützes Wissen Fußball - 1374 skurrile Fakten, die ma...  http://t.co/I68GzSWBUz', '2014-04-27', 'Dag-Detlef Reinert', 'Oldenburg', 'de', '0', 3),
(460397507273449472, 'Re: WM 2014 Brasilien http://t.co/WpZkrSvr6j', '2014-04-27', 'Brasilienfreunde', '', 'de', '0', 3),
(460399505398329344, 'Stimmen Sie sich ein auf die WM 2014 in Brasilien! Carvalho und der tote Mittelstürmer - Ein Kriminalrom...  http://t.co/UrVcPy2hrh', '2014-04-27', 'Dag-Detlef Reinert', 'Oldenburg', 'de', '0', 3),
(460406819488534528, 'Stimmen Sie sich ein auf die WM 2014 in Brasilien!  Lonely Planet Reiseführer Südamerika für wenig Geld http://t.co/1IGcZMO0BC', '2014-04-27', 'Dag-Detlef Reinert', 'Oldenburg', 'de', '0', 3),
(460407470460907522, 'Pünktlich zur anstehenden WM 2014 hat Hudora zwei Scooter auf den Markt gebracht: den Scooter BRASILIEN und den... http://t.co/Km6GzG8xyr', '2014-04-27', 'spielwelt.de', '72639 Neuffen', 'de', '0', 3),
(460409580716318720, 'yeah but if you think about it how good is Mamma Mia? Meryl Streep, Julie Andrews, Colin Firth, Pierce Brosnan and they''re all sinGING', '2014-04-27', 'teen wolf ', 'Leicester', 'en', '0', 2),
(460414603311476736, 'Stimmen Sie sich ein auf die WM 2014 in Brasilien!  Lonely Planet Reiseführer Rio de Janeiro von: Regis St Louis  http://t.co/KJOSmRrOAJ', '2014-04-27', 'Dag-Detlef Reinert', 'Oldenburg', 'de', '0', 3),
(460418356529491968, 'RT @SparksTheThomas: yeah but if you think about it how good is Mamma Mia? Meryl Streep, Julie Andrews, Colin Firth, Pierce Brosnan and the?', '2014-04-27', 'queen of sass', '', 'en', '0', 2),
(460420700999008256, 'Mamma Mia is fabulous and Pierce Brosnan is hot, even if he is old enough to be my dad.', '2014-04-27', 'Laura Maguire', 'Manchester ', 'en', '0', 2),
(460421896325332992, 'Stimmen Sie sich ein auf die WM 2014 in Brasilien! Entscheidend ist auf''m Platz - Die verrückte Welt des...  http://t.co/wVd8YbhLJ2', '2014-04-27', 'Dag-Detlef Reinert', 'Oldenburg', 'de', '0', 3),
(460426506875834370, 'Panini WM 2014 Brasilien - 50 Bilder aussuchen -:  EUR 1,00 (1 Gebot)Angebotsende: Montag Apr-28-2014 12:43:47... http://t.co/t04Ll87qm5', '2014-04-27', 'Quickberater', 'Germany', 'de', '0', 3),
(460429728747618304, 'Stimmen Sie sich ein auf die WM 2014 in Brasilien!  Fußball spielt Geschichte - Das Wunder von Bern von: Pe...  http://t.co/tFQvIF4JKf', '2014-04-27', 'Dag-Detlef Reinert', 'Oldenburg', 'de', '0', 3),
(460440325119811584, 'RT @Abolition2014: Neu im Blog: Rechtzeitig zur WM: Brasilien will Prostitutionseinnahmen legalisieren: By Tom... http://t.co/H7S5XdsjnT #g?', '2014-04-27', 'Mary Poppins', '', 'de', '0', 3),
(460462131633471489, 'Tippspiel zur WM online: http://t.co/XasT5eu40y', '2014-04-27', 'Tippspiel-Colditz.de', '', 'de', '0', 3),
(460463457188315138, '#Telmi #Nachrichten #news | Finale WM 2014 Stadion Ort Austragungsort Video Info: In Brasilien findet die WM... http://t.co/IVb648nhEv', '2014-04-27', 'DJ Telmi', 'München', 'de', '0', 3),
(460465821203324928, '''Je nová edice Red Bullu, Spielberg, s tématem F1''\nkomentá? : ''Já tam chci Samkovou!'' ????', '2014-04-27', 'Tonda', 'Czech Republic, Náchod', 'en', '0', 1),
(460475262845480960, 'Re: WM 2014 Brasilien http://t.co/C5dtGxqayy', '2014-04-27', 'Brasilienfreunde', '', 'de', '0', 3),
(460478504682131456, 'Cant decide which is more awkward Pierce Brosnan singing in Mamma Mia or Russell Crowe and Hugh Jackman singing in Les Mis.', '2014-04-27', 'Louise Bullen', 'Fetcham ', 'en', '0', 2),
(460481598366814208, 'Das sexy WM-Witzebuch: Zur Fußball WM 2014 in Brasilien von Sophie Mama http://t.co/QoZ2UAdRf7\n\n#Kindle #Deal #gratis #Schnäppchen', '2014-04-27', 'eBooks kostenlos', 'Barsbüttel Germany', 'de', '0', 3),
(460482957493293056, '#Deals - 4 Tickets WM World Cup 2014 Brasilien - Viertelfinale Quarter Finals De... http://t.co/iCmWo2bEYO Hôtel http://t.co/auGyZ5jZTp', '2014-04-27', 'Live Tickets', 'France', 'fr', '0', 3),
(460485738832740352, 'Wichtig! Brasilien - WM 2014 - Zeitverschiebung, Anstoßzeiten & Zeitplan http://t.co/UHHO9diBRB via @welt', '2014-04-27', 'Andreas', 'Lake Pavna, Maharashtra', 'en', '0', 3),
(460487038387499008, 'Brasiliens Quote auf einen Titelgewinn bei der Fußball-Weltmeisterschaft 2014 ist gut fünf Wochen vor... http://t.co/vVVtemRgul', '2014-04-27', 'IAP PortalNetwork', 'Brasilien', 'de', '0', 3),
(460487387643392001, 'Great Job. Great Team?@PlantageBerlin: OBACHT! Die ersten 1.166.788 Augenpaare richten sich nach Brasilien! http://t.co/4duWWY8IZB #wm_2014?', '2014-04-27', 'marion heine', 'Berlin', 'en', '0', 3),
(460487570619510784, 'Brasilien Wettquote auf WM-Titelgewinn leicht gesunken http://t.co/F4GlMtwyXF', '2014-04-27', 'Dietmar Lang', 'Toledo-PR, Brasilien', 'de', '0', 3),
(460487577607233537, 'Brasilien Wettquote auf WM-Titelgewinn leicht gesunken http://t.co/OYBhKtdbG0', '2014-04-27', 'IAP PortalNetwork', 'Brasilien', 'de', '0', 3),
(460490232471638016, 'Panini WM 2014 Brasilien - 50 Bilder aussuchen -:  EUR 1,00 (0 Gebote)Angebotsende: Montag Apr-28-2014 19:31:4... http://t.co/FEW7No5o46', '2014-04-27', 'Quickberater', 'Germany', 'de', '0', 3),
(460492065730990080, '@LouiseBullen definitely Pierce Brosnan in Mamma Mia ??', '2014-04-27', 'Hannah Masterson', 'Devon, England', 'en', '0', 2),
(460506485995229185, 'Re: WM 2014 Brasilien http://t.co/K3tzGU2DNV', '2014-04-27', 'Brasilienfreunde', '', 'de', '0', 3),
(460510058636259328, 'Pierce Brosnan in Mamma Mia <3<3<3', '2014-04-27', 'bethy california ?', 'norfuck', 'en', '0', 2),
(460511458011664384, '"Melanie Müller, dem neuen Maskottchen der deutschen Fussballnationalmannschaft bei der WM 2014 in Brasilien" Ist das euer ernst?', '2014-04-27', 'Deniz Kökden', 'Deutschland/Speyer', 'de', '0', 3),
(460514374755446785, 'Re: WM 2014 Brasilien http://t.co/LrF7knXHQ1', '2014-04-27', 'Brasilienfreunde', '', 'de', '0', 3),
(460519735092723713, '"Die Begeisterung ist noch ausbaufähig": CSU-Politiker Stephan Mayer zur Stimmung vor der #WM2014 in Brasilien http://t.co/JbpO77C8qb (jm)', '2014-04-27', 'Sport', 'Köln, Deutschland', 'de', '0', 3),
(460536985472356352, 'Panini WM 2014 Brasilien - 50 Bilder aussuchen -:  EUR 1,00 (0 Gebote)Angebotsende: Montag Apr-28-2014 21:17:2... http://t.co/F39Zxpbzuo', '2014-04-27', 'Quickberater', 'Germany', 'de', '0', 3),
(460536986281840640, 'Panini WM 2014 Brasilien - 50 Bilder aussuchen -:  EUR 1,00 (0 Gebote)Angebotsende: Montag Apr-28-2014 22:43:3... http://t.co/6xuwiHojwE', '2014-04-27', 'Quickberater', 'Germany', 'de', '0', 3),
(460539583684292608, 'i am the master of pierce brosnan in mamma mia impressions', '2014-04-28', 'Anna', 'Manchester', 'en', '0', 2),
(460552540623360000, '@Quigletqueen FOUND IT\nwe picked Pierce Brosnan\nhe actually played the centaur in percy jackson and was Sam I think in Mamma Mia', '2014-04-28', 'Hatter Asphyxiation', 'High Garden', 'en', '0', 2),
(460576681128783873, 'Re: WM 2014 Brasilien http://t.co/fPpuabCt0K', '2014-04-28', 'Brasilienfreunde', '', 'de', '0', 3),
(460595365813977089, 'The only thing i dont like about Mamma Mia is watching Meryl Streep and Pierce Brosnan make out', '2014-04-28', 'Simba', '', 'en', '0', 2),
(460620483160178688, 'let us never forget when pierce brosnan was in mamma mia #iconic', '2014-04-28', 'Cat Wells', '', 'en', '0', 2),
(460628614174613504, 'Angebotsende: Panini - Fußball WM 2014 Brasilien - 50 Sticker aus der Liste:  EUR 8,00 (8 Gebote)Ange... http://t.co/oJkXh4YJBH @Ebay AT', '2014-04-28', 'The Deals Planet', '', 'fr', '0', 3),
(460649159616233473, 'Angebotsende: Panini - Fußball WM 2014 Brasilien - 50 Sticker aus der Liste:  EUR 6,00 (3 Gebote)Ange... http://t.co/yC1exXat4h @Ebay AT', '2014-04-28', 'The Deals Planet', '', 'fr', '0', 3),
(460662564410884096, 'Noch 45 Tage bis zur WM 2014 in Brasilien! Hier ein kleiner Vorgeschmack ? die neueste Werbung von Nike  https://t.co/nvFRdX8mfq', '2014-04-28', 'Goldbach Group', 'Zürich Switzerland', 'de', '0', 3),
(460673749562695681, '#Brasilien-Fieber steigt. #test-Kollegin rät, welche #Impfungen vor der #Fußball-Reise sinnvoll sind. http://t.co/g9pHbetuH9', '2014-04-28', 'Hermann-J. Tenhagen', 'Berlin', 'en', '0', 3),
(460675196400451585, '45 Tage bis zur WM in Brasilien - das Sammelbild-Fieber ist ausgebrochen. Und @hdambeck geht dem Mythos #Panini nach: http://t.co/swG7w1XR4m', '2014-04-28', 'Digitales Treibgut', 'Immer mitten im Web', 'de', '0', 3),
(460682665986113536, 'RT @akenzo_: Fußball-WM in Brasilien: Der große Durchbruch des Second-Screen? http://t.co/FLwFAPvuzX #wm14 #fifa', '2014-04-28', 'David Theis', '#Koblenz', 'de', '0', 3),
(460689613632192512, 'Angebotsende: Panini - Fußball WM 2014 Brasilien - 50 Sticker aus der Liste:  EUR 4,07 (3 Gebote)Ange... http://t.co/lqFo6ztNGf @Ebay AT', '2014-04-28', 'The Deals Planet', '', 'fr', '0', 3),
(460690364513665024, 'Archiv: Tom Tailor Denim... http://t.co/5UjcnvFxyW #2014 #Brasilien #fan #Fussball #shirt #soccer #tomtailor #tshirt #Weltmeisterschaft #WM', '2014-04-28', 'Sports Insider', 'Berlin', 'de', '0', 3),
(460691111682801664, '4 sale ends today 18:55 GMT  @eBay bid now #ABBA #MammaMia! #Movie doubleside cinema #poster #PierceBrosnan http://t.co/52QGFO99vL @eBay_UK', '2014-04-28', 'poprockmemorabilia', 'Bristol, UK', 'en', '0', 2),
(460701375337218048, 'Panini WM 2014 Brasilien - 50 Bilder aussuchen -:  EUR 1,00 (0 Gebote)Angebotsende: Dienstag Apr-29-2014 9:38:... http://t.co/iQbd40UBRg', '2014-04-28', 'Quickberater', 'Germany', 'de', '0', 3),
(460701375928598528, 'Panini WM 2014 Brasilien - 50 Bilder aussuchen -:  EUR 1,00 (0 Gebote)Angebotsende: Dienstag Apr-29-2014 10:43... http://t.co/dmGewjNhFJ', '2014-04-28', 'Quickberater', 'Germany', 'de', '0', 3),
(460702540502687744, 'Fußball-WM 2014: Erst impfen lassen, dann reisen Am 12. Juni beginnt in Brasilien die Fu? http://t.co/fBGmtF6JOX http://t.co/ml4C5W96DA', '2014-04-28', 'Oliver Page', 'Deutschland', 'de', '0', 3),
(460703864858353664, 'RT @PageOliver: Fußball-WM 2014: Erst impfen lassen, dann reisen Am 12. Juni beginnt in Brasilien die Fu? http://t.co/fBGmtF6JOX http://t.c?', '2014-04-28', 'Markus heinzelmann', '', 'de', '0', 3),
(460704176402886656, 'RT @PageOliver: Fußball-WM 2014: Erst impfen lassen, dann reisen Am 12. Juni beginnt in Brasilien die Fu? http://t.co/fBGmtF6JOX http://t.c?', '2014-04-28', 'Kinderzauberclub', 'Deutschland', 'de', '0', 3),
(460704790260252672, 'RT @PageOliver: Fußball-WM 2014: Erst impfen lassen, dann reisen Am 12. Juni beginnt in Brasilien die Fu? http://t.co/fBGmtF6JOX http://t.c?', '2014-04-28', 'Zauberer Fidibus', '', 'de', '0', 3),
(460712602080141312, 'RT @DLF_Sport: "Die Begeisterung ist noch ausbaufähig": CSU-Politiker Stephan Mayer zur Stimmung vor der #WM2014 in Brasilien http://t.co/J?', '2014-04-28', 'Sportschau', 'Köln', 'de', '0', 3),
(460716721846767616, 'Re: WM 2014 Brasilien http://t.co/XZloL8bXcY', '2014-04-28', 'Brasilienfreunde', '', 'de', '0', 3),
(460721995324203008, 'Panini WM 2014 Brasilien - 50 Bilder aussuchen -:  EUR 1,00 (0 Gebote)Angebotsende: Dienstag Apr-29-2014 11:49... http://t.co/sG4CQdQc16', '2014-04-28', 'Quickberater', 'Germany', 'de', '0', 3),
(460724681306148865, 'Re: WM 2014 Brasilien http://t.co/cSzf5tDIhJ', '2014-04-28', 'Brasilienfreunde', '', 'de', '0', 3),
(460726607729029121, 'Brasilien verwandelt sich zur WM 2014 in ein teures Pflaster - http://t.co/XbWhUvIx2X', '2014-04-28', 'Hispaniola News', 'Hispaniola', 'de', '0', 3),
(460727555432402944, '?@Wissensbox: #Prostituierte in #Brasilien können an kostenlosen Englischkursen teilnehmen, um in der WM 2014 bessere Dienste anzubieten.?????', '2014-04-28', 'whateveryoulike', '', 'de', '0', 3),
(460728007309926400, 'New post: WM 2014: Jerome Valcke besichtigt Baustellen | FIFA Fußball-Weltmeisterschaft in Brasilien 2014 http://t.co/OmfQe5Nj01', '2014-04-28', 'ERFOLGSZIEL', 'Bayern', 'de', '0', 3),
(460728204387295232, 'http://t.co/1Eyx5JPsi2', '2014-04-28', 'agência latinapress', 'Nachrichtenportal', 'de', '0', 3),
(460728459107385344, 'http://t.co/1Eyx5JPsi2 http://t.co/c7QiKvPhu7', '2014-04-28', 'agência latinapress', 'Nachrichtenportal', 'de', '0', 3),
(460730924204699649, '@DairyMilkIn #MyFavDairyMilk A-1) Spielberg and dinosaur', '2014-04-28', 'Go_Green', 'Delhi , India', 'en', '0', 1),
(460731944066908160, 'Countdown: Nur noch 45 Tage bis zur Fußball-WM! Brasilien aber geht kurz vorm Ankick die Puste aus #PwC next http://t.co/VxvnWith3h', '2014-04-28', 'PwC Österreich', 'Wien', 'de', '0', 3),
(460732170777014272, 'Brasilien verwandelt sich zur WM 2014 in ein teures Pflaster http://t.co/KtrbIEfHUJ', '2014-04-28', 'Dietmar Lang', 'Toledo-PR, Brasilien', 'de', '0', 3),
(460732175831146496, 'Brasilien verwandelt sich zur WM 2014 in ein teures Pflaster http://t.co/MZz5jMmSmm', '2014-04-28', 'IAP PortalNetwork', 'Brasilien', 'de', '0', 3),
(460739798190129152, 'Sie verspricht ein rauschendes Fußballfest zu werden: die WM 2014 in Brasilien. Doch wen die Lust gepackt hat,... http://t.co/4p1tEMIgGn', '2014-04-28', 'IAP PortalNetwork', 'Brasilien', 'de', '0', 3),
(460740247366561795, 'Re: WM 2014 Brasilien http://t.co/EANxYtnqas', '2014-04-28', 'Brasilienfreunde', '', 'de', '0', 3),
(460742676791308288, 'Panini WM 2014 Brasilien - 50 Bilder aussuchen -:  EUR 1,00 (0 Gebote)Angebotsende: Dienstag Apr-29-2014 12:54... http://t.co/PpCIVVD0Jb', '2014-04-28', 'Quickberater', 'Germany', 'de', '0', 3),
(460762320885403650, 'Fifa-Fussball-WM 2014 in Brasilien: "Die Begeisterung ist noch ausbaufähig" [Podcast] http://t.co/wOOfh0qmij', '2014-04-28', 'Webradio.Land', 'Gelnhausen, Germany', 'de', '0', 3),
(460763096588378112, 'Panini WM 2014 Brasilien - 50 Bilder aussuchen -:  EUR 1,00 (0 Gebote)Angebotsende: Dienstag Apr-29-2014 14:12... http://t.co/L4rT2i9MCK', '2014-04-28', 'Quickberater', 'Germany', 'de', '0', 3),
(460764209937387520, 'Bald startet die WM in Brasilien! Wer ist momentan nicht so richtig in Form? Mit dabei sind zwei Bayern-Spieler.... http://t.co/vswtCqFqfg', '2014-04-28', 'comunioblog', '', 'de', '0', 3),
(460764536233267200, 'Fussball-WM 2014 in Brasilien: "Brot und Spiele" (panem et circenses) gab es schon im Alten Rom zum Ruhigstellen der Volksmassen.', '2014-04-28', 'Webradio.Land', 'Gelnhausen, Germany', 'de', '0', 3),
(460773228437569536, 'Unterwegs in #Brasilien ? Die wichtigsten Begriffe und Sätze auf #Portugiesisch für die Fußball-WM 2014: http://t.co/w0f1gWEUg7', '2014-04-28', 'bab.la', 'Hamburg, Germany', 'en', '0', 3),
(460775638350049281, 'Ich biete meine übrigen Panini Sammelbilder WM 2014 Brasilien bei ebay an:  http://t.co/7NPefoJOS4 via @eBayDE', '2014-04-28', 'vacilar', 'Württemberg', 'de', '0', 3),
(460777083158142976, 'Hublot präsentiert die offizielle Uhr der Fußball-WM 2014 in Brasilien! Von der Soccer Bang gibt 200 Exemplare in... http://t.co/AzR22FZnN2', '2014-04-28', 'watchSea24.com', 'Munich', 'de', '0', 3),
(460778261707227136, 'Hublot präsentiert die offizielle Uhr der Fußball-WM 2014 in Brasilien! Von der Soccer Bang gibt 200 Exemplare in... http://t.co/uYwan429iI', '2014-04-28', 'watchSea24.com', 'Munich', 'de', '0', 3),
(460779274501230593, 'Re: WM 2014 Brasilien http://t.co/YxoEVXedoh', '2014-04-28', 'Brasilienfreunde', '', 'de', '0', 3),
(460781462388604928, 'Die ersten WM-Schlappen kommen von EA. Wir vergleichen die FIFA-WM Edition mit FIFA 14 und zeigen euch die 18... http://t.co/HKM0Ta368B', '2014-04-28', 'OnlineWelten', '', 'en', '0', 3),
(460784523303596032, 'Panini WM 2014 Brasilien - 50 Bilder aussuchen -:  EUR 1,00 (0 Gebote)Angebotsende: Dienstag Apr-29-2014 15:29... http://t.co/7mv39pgHyw', '2014-04-28', 'Quickberater', 'Germany', 'de', '0', 3),
(460785634492563456, 'Es sind noch Plätze frei: #Brasilien 2014: Chancen und Risiken einer #WM im Land des Fußballs #Hamburg http://t.co/nBjewmbUhO', '2014-04-28', 'Engagement Global', 'Bonn', 'de', '0', 3),
(460786841524776960, 'Entwarnung bei Gonzalo Higuain, WM-Teilnahme ist nicht in Gefahr http://t.co/zPLouY5BVg', '2014-04-28', 'wm2014-brasilien.net', 'Deutschland', 'de', '0', 3),
(460787793976098816, 'heute2: WM-Risiko - ARD und ZDF schulen ihre rund 500 Mitarbeiter, die nach Brasilien fliegen, in Sicherheitsfragen. http://t.co/heEG5xe666', '2014-04-28', 'turi2', 'Germany', 'de', '0', 3),
(460790608907354114, 'WM 2014: Scolari benennt vier Kapitäne für die Selecao http://t.co/coqVcGLBD5', '2014-04-28', 'wm2014-brasilien.net', 'Deutschland', 'de', '0', 3),
(460793050726686720, 'Ich habe ein @YouTube-Video von @cmdkrieger positiv bewertet: http://t.co/lMpHEP0Ymu Kurz und Knapp #8: WM 2014 in Brasilien', '2014-04-28', 'GER_Zombies', '', 'de', '0', 3),
(460793691813072896, 'Ich habe ein @YouTube-Video von @cmdkrieger positiv bewertet: http://t.co/4IZ59Gnw54 Kurz und Knapp #8: WM 2014 in Brasilien', '2014-04-28', 'Jero Power', '', 'de', '0', 3),
(460798680162111488, '#DFB-Stürmer Mario Gomez wird die #WM2014 in Brasilien wohl verpassen: http://t.co/LAmiSo3e1t', '2014-04-28', 'WM 2014 in Brasilien', 'Wien', 'de', '0', 3),
(460824874442035200, 'Wer hat Chancen auf die WM 2014, wer kann sie schon abschreiben? Wir haben die Verletzungssorgen des DFB einmal... http://t.co/EJYQHnFqCP', '2014-04-28', 'WM 2014', 'Deutschland', 'de', '0', 3),
(460825341792387073, 'RT @wm2014brasilien: Wer hat Chancen auf die WM 2014, wer kann sie schon abschreiben? Wir haben die Verletzungssorgen des DFB einmal... htt?', '2014-04-28', 'Chris Brey', 'München', 'de', '0', 3),
(460826694249496576, 'Panini WM 2014 Brasilien - 50 Bilder aussuchen -:  EUR 1,00 (0 Gebote)Angebotsende: Dienstag Apr-29-2014 18:39... http://t.co/05ZAu3fCuL', '2014-04-28', 'Quickberater', 'Germany', 'de', '0', 3),
(460831868125208578, 'RT @GoldbachGroup: Noch 45 Tage bis zur WM 2014 in Brasilien! Hier ein kleiner Vorgeschmack ? die neueste Werbung von Nike  https://t.co/nv?', '2014-04-28', 'Tamara Schmid', 'Basel Bern Zürich Küsnacht', 'de', '0', 3),
(460832733996929024, 'FIFA Fußball Weltmeisterschaft Brasilien 2014 ? Test der FIFA-WM-Edition ? Vergleich zu Fifa 14! Ist der Vollp... http://t.co/rh4j3SK1Vi', '2014-04-28', 'Code5 Games', 'Germany', 'de', '0', 3),
(460837328882126848, '[WM] Fußball WM 2014 in Brasilien - Wir trippeln bis zum Eröffnungsspiel: *FIFA Fußball-Weltmeisterschaf... http://t.co/D069VB5S3X #ioff', '2014-04-28', 'IOFF Medienforum', '', 'de', '0', 3),
(460840545058029568, 'Ich habe ein @YouTube-Video von @cmdkrieger positiv bewertet: http://t.co/pi6Oj62DIO Kurz und Knapp #8: WM 2014 in Brasilien', '2014-04-28', 'TimjoLP', '', 'de', '0', 3),
(460841672817926145, 'Re: WM 2014 Brasilien http://t.co/T8sjKibj4B', '2014-04-28', 'Brasilienfreunde', '', 'de', '0', 3),
(460847824813301761, 'Panini WM 2014 Brasilien - 50 Bilder aussuchen -:  EUR 1,00 (0 Gebote)Angebotsende: Dienstag Apr-29-2014 19:37... http://t.co/ZAfRlxr7oH', '2014-04-28', 'Quickberater', 'Germany', 'de', '0', 3),
(460851364936314880, 'Ich habe ein @YouTube-Video von @cmdkrieger positiv bewertet: http://t.co/syKTTWsGI5 Kurz und Knapp #8: WM 2014 in Brasilien', '2014-04-28', 'Gerhard Otto', 'nijmegen NL', 'de', '0', 3),
(460864910877294592, 'RT @babla: Unterwegs in #Brasilien ? Die wichtigsten Begriffe und Sätze auf #Portugiesisch für die Fußball-WM 2014: http://t.co/w0f1gWEUg7', '2014-04-28', 'WM 2014 Infos', '', 'de', '0', 3),
(460865074135969792, 'Re: WM 2014 Brasilien http://t.co/oKuJaO6btH', '2014-04-28', 'Brasilienfreunde', '', 'de', '0', 3),
(460869490993950720, 'Panini WM 2014 Brasilien - 50 Bilder aussuchen -:  EUR 1,00 (0 Gebote)Angebotsende: Dienstag Apr-29-2014 21:37... http://t.co/bG09BVR8l3', '2014-04-28', 'Quickberater', 'Germany', 'de', '0', 3),
(460871849455284224, 'FIFA WM 2014: Brasilien vs. Portugal [FIFA14] #4 http://t.co/jaQ1gEfxfJ http://t.co/8Ea9KTrBgr #portugal', '2014-04-28', 'GO! Portugal', 'Lisbon', 'en', '0', 3),
(460872355116765186, 'WM-Risiko - ARD+ZDF schulen ihre rund 500 Mitarbeiter, die nach Brasilien fliegen, in Sicherheitsfragen | v @turi2 | http://t.co/zzNgWjEGkU', '2014-04-28', 'mediareloaded', 'Deutschland', 'de', '0', 3),
(460872866490105856, 'Re: WM 2014 Brasilien http://t.co/mVEPQ0JhoE', '2014-04-28', 'Brasilienfreunde', '', 'de', '0', 3),
(460883324438069249, 'James Bond med Pierce Brosnan kommer aldrig bli detsamma efter mamma Mia the movie.', '2014-04-28', 'Ebba Månsson', 'Katrineholm', 'en', '0', 2),
(460888610661605377, 'Re: WM 2014 Brasilien http://t.co/JGE6MV2LBG', '2014-04-28', 'Brasilienfreunde', '', 'de', '0', 3),
(460890038595633153, 'Panini WM 2014 Brasilien - 50 Bilder aussuchen -:  EUR 1,00 (0 Gebote)Angebotsende: Dienstag Apr-29-2014 22:45... http://t.co/cgUiynXVXW', '2014-04-28', 'Quickberater', 'Germany', 'de', '0', 3),
(460899243503648769, 'RT @freinholz: Jetzt frisch auf @lto_de: Public Viewing und Werbung mit der Fußball-WM - rechtliche Grenzen http://t.co/HUYQq4e8ix', '2014-04-28', 'Giuseppe Di Marco', 'Zürich', 'de', '0', 3),
(460905770306252800, 'Aus der Serie unnützes Wissen à la americaine: Zwei Drittel der US-Bürger haben null Interesse an der Brasilien-WM http://t.co/QqMU6wK3oP', '2014-04-29', 'Jürgen Kalwa', 'New York', 'en', '0', 3),
(460906022039998464, '@muttivon2 Brasilien ist ein Stunde weiter als du NY18:15  Rio 19:15 http://t.co/Q0fr4CQacA  Spiele zw13-17Riozeit 18-22Europa 12-16NYtime', '2014-04-29', 'Martina Kupper', 'Berlin, Germany', 'en', '0', 3),
(460935879914442752, 'Brasilien 2014 Spanier Wittern Verschwörung Bei Der Wm-auslosung 8211 Nachrichten Sport 8211? http://t.co/YdTAM851Js', '2014-04-29', 'Bookmarking Software', '', 'en', '0', 3),
(460998875361210368, 'Angebotsende: Panini - Fußball WM 2014 Brasilien - 50 Sticker aus der Liste:  EUR 8,50 (9 Gebote)Ange... http://t.co/VB0jFvg0Fj @Ebay AT', '2014-04-29', 'The Deals Planet', '', 'fr', '0', 3),
(461008741370851328, 'Wenn am 12. Juni 2014 die Fußball-WM in Brasilien startet, hat sich das Magdeburger Startup Karibu Games längst... http://t.co/WacMMhP41o', '2014-04-29', 'Mynewsdesk', 'Leipzig, Germany', 'de', '0', 3),
(461008742817873920, 'Wenn am 12. Juni 2014 die Fußball-WM in Brasilien startet, hat sich das Magdeburger Startup Karibu Games längst... http://t.co/e90Jtodo8m', '2014-04-29', 'Mynewsdesk', 'Leipzig, Germany', 'de', '0', 3),
(461016732275335168, 'Fußball-WM 2014: Brasilien lockt mit Fischbrötchen http://t.co/s7KvI8Bv8r', '2014-04-29', 'Jörg Baldin', 'Schönberg / Ostsee', 'de', '0', 3),
(461052528239464448, 'Panini WM 2014 Brasilien - 50 Bilder aussuchen -:  EUR 1,00 (0 Gebote)Angebotsende: Mittwoch Apr-30-2014 9:39:... http://t.co/56IU1AT7Pr', '2014-04-29', 'Quickberater', 'Germany', 'de', '0', 3),
(461055241257877504, '20 Reiseangebote für Fußballfans ins Land der Fußballzauberer: Sportreisen zur Fußball WM 2014 in Brasilien ve... http://t.co/4PPx2O4qP2', '2014-04-29', 'News 24h Ger', '', 'en', '0', 3),
(461055394857500672, 'Computerspiel verkürzt Wartezeit bis zur WM: Wenn am 12. Juni 2014 die Fußball-WM in Brasilien startet, hat si... http://t.co/vduzqXDzwr', '2014-04-29', 'Magdeburger Sonntag', 'Magdeburg', 'de', '0', 3),
(461057469184495616, '#wm2014 Vorglühen bei SWRinfo: Michael Stocks ist Gast im Korrespondententalk am Montag in #Stuttgart. Nix wie hin: http://t.co/8jZ1YRAPK7', '2014-04-29', 'SWRinfo', 'Baden-Baden', 'de', '0', 3),
(461075451113259008, 'Re: WM 2014 Brasilien http://t.co/ufwawKTzUN', '2014-04-29', 'Brasilienfreunde', '', 'de', '0', 3),
(461077265996980224, '20 Reiseangebote für Fußballfans ins Land der Fußballzauberer: Sportreisen zur Fußball WM 2014 in Brasilien ve... http://t.co/J6vj0G2pbs', '2014-04-29', 'eduardde', '', 'en', '0', 3),
(461089997739675648, 'Fussball WM 2014 Brasilien:  \nZustände 100 mal schlimmer als bei der WM in Südafrika\nIn Rio de Janeiro ist es... http://t.co/KeMGrhN64U', '2014-04-29', 'Fantasticsportswear', 'Rio de Janeiro', 'de', '0', 3),
(461093134605103105, 'Panini WM 2014 Brasilien - 50 Bilder aussuchen -:  EUR 1,00 (0 Gebote)Angebotsende: Mittwoch Apr-30-2014 10:46... http://t.co/wgPHukd5ej', '2014-04-29', 'Quickberater', 'Germany', 'de', '0', 3),
(461093135301361665, 'Panini WM 2014 Brasilien - 50 Bilder aussuchen -:  EUR 1,00 (0 Gebote)Angebotsende: Mittwoch Apr-30-2014 11:51... http://t.co/wWGtBzxXmI', '2014-04-29', 'Quickberater', 'Germany', 'de', '0', 3),
(461113998776467456, 'Noch bis morgen zeigen, dass man "True winner" ist und Karten für die #FIFA WM 2014 in Brasilien gewinnen. http://t.co/YlpsMxUnBP /JB', '2014-04-29', 'DocMorris', '', 'de', '0', 3),
(461114489174110210, 'WM 2014 Deutschland in Brasilien http://t.co/1I6OwE5n7o', '2014-04-29', '#bit #cas #firemind', 'NRW', 'de', '0', 3),
(461120390715023361, 'Angebotsende: Panini - Fußball WM 2014 Brasilien - 50 Sticker aus der Liste:  EUR 6,06 (5 Gebote)Ange... http://t.co/9joWQbuzVk @Ebay AT', '2014-04-29', 'The Deals Planet', '', 'fr', '0', 3),
(461128254934769664, 'http://t.co/owb6NwDpsD http://t.co/LlbnUbJAHy', '2014-04-29', 'Michael Krueger', 'Ratingen', 'de', '0', 3),
(461132456759152640, 'Die Fußball Weltmeisterschaft 201 4K ..@wird natürlich in UHD .. also 2160p aufgenommen.\n\nhttp://t.co/USC6LuCz8V\n\nLOGISCH', '2014-04-29', 'Wilfried DL2LK', 'Goettingen, Germany', 'de', '0', 3),
(461134909139353600, 'RT @docmorris: Noch bis morgen zeigen, dass man "True winner" ist und Karten für die #FIFA WM 2014 in Brasilien gewinnen. http://t.co/YlpsM?', '2014-04-29', 'Gil Pfitzenmaier', '', 'de', '0', 3),
(461141742906273793, 'RT @SWRinfo: #wm2014 Vorglühen bei SWRinfo: Michael Stocks ist Gast im Korrespondententalk am Montag in #Stuttgart. Nix wie hin: http://t.c?', '2014-04-29', 'Arthur Landwehr', 'Baden-Baden', 'en', '0', 3),
(461144288886157312, 'Buch-Tipp: "Traumberuf Fußballprofi" - Motivation für die WM 2014 ... http://t.co/ZkOxqaAtVs', '2014-04-29', 'Harriet Fernandes', '', 'en', '0', 3),
(461151223144783872, 'Fußball WM 2014 in Brasilien ? effektiv werben mit perfectPRINTS http://t.co/wSFWQKXTZU', '2014-04-29', 'DNVerteiler', 'Eppertshausen', 'de', '0', 3),
(461151937191477248, 'Fußball WM 2014 in Brasilien - effektiv werben mit perfectPRINTS -  http://t.co/NA3AZiJBQ5\n #Pressemitteilung', '2014-04-29', 'fair-NEWS Consulting', 'Viersen, Germany', 'de', '0', 3),
(461153023830409217, 'WM 2014 Tippspiel\n\nhttp://t.co/Y1uiDOsFwN http://t.co/CCYUZliScV', '2014-04-29', '#bit #cas #firemind', 'NRW', 'de', '0', 3),
(461161701468303360, 'Gute Nachrichten für das #DFB-Team, Stürmer Miro #Klose meldet sich fit für die #WM2014 in Brasilien: http://t.co/DXhWmAThvS', '2014-04-29', 'WM 2014 in Brasilien', 'Wien', 'de', '0', 3),
(461161827683299329, 'New post: Brasilien: Vorsorge bei Reisen zur WM und zum Karneval http://t.co/rLAtl4wbDp', '2014-04-29', 'Weltreisejournal', 'Berlin', 'de', '0', 3),
(461164023224885248, 'Buch-Tipp: ?Traumberuf Fußballprofi? ? Motivation für die WM 2014 in Brasilien: 64 Spiele stehen an! Die Fußba... http://t.co/nRrFbT4ryp', '2014-04-29', 'Thomas Schlechter', 'Austria', 'de', '0', 3),
(461168037224513536, '#PublicViewingPlätze Fußball WM 2014 in Brasilien  effektiv werben mit perfectPRINTS http://t.co/OytnqLiAUI', '2014-04-29', 'newscomm', 'internet', 'de', '0', 3),
(461173504826548226, 'Panini WM 2014 Brasilien - 50 Bilder aussuchen -:  EUR 1,00 (0 Gebote)Angebotsende: Mittwoch Apr-30-2014 12:56... http://t.co/CNrkNenluO', '2014-04-29', 'Quickberater', 'Germany', 'de', '0', 3),
(461173505589911552, 'Panini WM 2014 Brasilien - 50 Bilder aussuchen -:  EUR 1,00 (0 Gebote)Angebotsende: Mittwoch Apr-30-2014 15:39... http://t.co/dLXd05a3ia', '2014-04-29', 'Quickberater', 'Germany', 'de', '0', 3),
(461181017974657024, 'Who will join me? https://t.co/IESJLR4h4P #F1 #Spielberg #AustrianGP', '2014-04-29', 'Maria Reyer', 'Austria', 'de', '0', 1),
(461191236440064002, 'Halbwegs human?.\n#WM #Brasilien #anstosszeiten http://t.co/9yeFpLZSZF', '2014-04-29', 'fnasigoreng30', 'Im Land der Vollidioten', 'de', '0', 3),
(461193289824075777, 'Panini WM 2014 Brasilien - 50 Bilder aussuchen -:  EUR 1,00 (0 Gebote)Angebotsende: Mittwoch Apr-30-2014 18:39... http://t.co/mkTF4bXbZH', '2014-04-29', 'Quickberater', 'Germany', 'de', '0', 3),
(461198304693743616, 'If I die now then the last thing I will have heard is Pierce Brosnan singing in Mamma Mia... #SOS', '2014-04-29', 'Rory McDermott', '', 'en', '0', 2),
(461208220422266880, 'Re: WM 2014 Brasilien http://t.co/f9LLx7ZlIZ', '2014-04-29', 'Brasilienfreunde', '', 'de', '0', 3),
(461209105466933250, 'For "only" 7,500 Euros (excluding airfare/lodging), you can drive Formula Renault 2.0/3.5 cars on Austria''s F1 track! http://t.co/S2IRwc43Eh', '2014-04-29', 'Rev. Adam', 'Oakton, VA', 'en', '0', 1),
(461209672653877249, '[http://t.co/45Ix43pN7v] Oliver Kahn: Chancen von Rene Adler auf Brasilien-WM gering http://t.co/U85CETEc7l,', '2014-04-29', 'Foot+', '', 'ja', '0', 3),
(461211984814698499, 'RT @trendyverlag: Stimmen Sie sich ein auf die WM 2014 in Brasilien!  Fußball spielt Geschichte - Das Wunder von Bern von: Pe...  http://t.?', '2014-04-29', 'CARTINGO', '', 'de', '0', 3),
(461213803279941632, 'Fußball-WM 2014 in Brasilien: Vom Campingplatz ins Stadion - PROMOBIL http://t.co/9U9tsYQW0m via @promobil', '2014-04-29', 'World Cup Camping', 'Rio de Janeiro, Brazil', 'en', '0', 3),
(461216118321840128, 'Re: WM 2014 Brasilien http://t.co/MAP5x31GiQ', '2014-04-29', 'Brasilienfreunde', '', 'de', '0', 3),
(461216268071092225, 'Oliver Kahn: Chancen von Rene Adler auf Brasilien-WM gering: Geht es nach Oliver Kahn, ist... http://t.co/ujIaEPZJxZ #football #Fussball', '2014-04-29', 'DE-football', '', 'de', '0', 3),
(461217138070810625, 'WM Gewinnspiel Brasilien 2014 | Reise Inspiration 24 -  http://t.co/uaHuT8bRG2', '2014-04-29', 'Michael Krueger', 'Ratingen', 'de', '0', 3),
(461229524017885185, 'Panini WM 2014 Brasilien - 50 Bilder aussuchen -:  EUR 1,00 (0 Gebote)Angebotsende: Mittwoch Apr-30-2014 20:11... http://t.co/IZnGkUGxAn', '2014-04-29', 'Quickberater', 'Germany', 'de', '0', 3),
(461229524684771328, 'Panini WM 2014 Brasilien - 50 Bilder aussuchen -:  EUR 1,00 (0 Gebote)Angebotsende: Mittwoch Apr-30-2014 21:38... http://t.co/kuPU4Lm55j', '2014-04-29', 'Quickberater', 'Germany', 'de', '0', 3),
(461234631937773568, 'Angebotsende: Panini WM 2014 Brasilien - 50 Bilder aussuchen -:  EUR 7,50 (3 Gebote)Angebotsende: Die... http://t.co/8MZPpmRJFe @Ebay AT', '2014-04-29', 'The Deals Planet', '', 'fr', '0', 3),
(461247362334076928, 'Panini WM 2014 Brasilien - 50 Bilder aussuchen -:  EUR 1,00 (0 Gebote)Angebotsende: Mittwoch Apr-30-2014 22:47... http://t.co/AfYg91hBV7', '2014-04-29', 'Quickberater', 'Germany', 'de', '0', 3),
(461249855613329411, 'Fifa WM:250000$ kostet es allein, Dopingproben von Brasilien an Labor Lausanne zu senden."Gemeinnütziger Verein" Fifa http://t.co/tb5aeVKx8r', '2014-04-29', 'Marc Meschenmoser', '', 'de', '0', 3),
(461262566660927489, 'Re: WM 2014 Brasilien http://t.co/9DNGOSzQ7j', '2014-04-29', 'Brasilienfreunde', '', 'de', '0', 3),
(461293637582598144, 'Re: WM 2014 Brasilien http://t.co/rHil9OOQd1', '2014-04-30', 'Brasilienfreunde', '', 'de', '0', 3),
(461301497469218816, 'Re: WM 2014 Brasilien http://t.co/PIxBKQoCo8', '2014-04-30', 'Brasilienfreunde', '', 'de', '0', 3),
(461317216429146112, 'Brasilien vor den Sport-Großereignissen: WM-Strategie der Polizei in Rio mündet in? http://t.co/kzrwcQNd5p', '2014-04-30', 'Nachrichtenportal', '', 'de', '0', 3),
(461346317642387456, 'Angebotsende: Panini - Fußball WM 2014 Brasilien - 50 Sticker aus der Liste:  EUR 7,01 (6 Gebote)Ange... http://t.co/veLrwEIM5Q @Ebay AT', '2014-04-30', 'The Deals Planet', '', 'fr', '0', 3),
(461366352234565633, 'Angebotsende: Panini - Fußball WM 2014 Brasilien - 50 Sticker aus der Liste:  EUR 6,51 (6 Gebote)Ange... http://t.co/mHT9G5VfZt @Ebay AT', '2014-04-30', 'The Deals Planet', '', 'fr', '0', 3),
(461385215105982465, 'Angebotsende: Panini - Fußball WM 2014 Brasilien - 50 Sticker aus der Liste:  EUR 6,49 (8 Gebote)Ange... http://t.co/STwyCsl1Tp @Ebay AT', '2014-04-30', 'The Deals Planet', '', 'fr', '0', 3),
(461387639199764480, 'Rio und São Paulo: Neue Gewalt in Brasilien vor Fußball-WM:  In Rio de Janeiro und São Paulo liefern sich Poli... http://t.co/MdpmI8pJfm', '2014-04-30', 'Zeit_RSS', '', 'en', '0', 3),
(461387641821220864, 'DTN Germany: Rio und São Paulo: Neue Gewalt in Brasilien vor Fußball-WM:  In Rio de Janeiro und São Paulo lief... http://t.co/PjPKYHfIZG', '2014-04-30', 'DTN Germany', 'Canada', 'en', '0', 3),
(461387644006436864, 'Rio und São Paulo: Neue Gewalt in Brasilien vor Fußball-WM http://t.co/XPnRuH1hct from #diezeit #tns', '2014-04-30', 'The News Selector', '', 'es', '0', 3),
(461391188302782464, 'In Brasilien liefern sich Polizei und Demonstranten kurz vor der WM Straßenschlachten. http://t.co/GglZlvW7hc (nd)', '2014-04-30', 'ZEIT ONLINE', 'Berlin und Hamburg, Germany', 'de', '0', 3),
(461391442662129664, 'RT @zeitonline: In Brasilien liefern sich Polizei und Demonstranten kurz vor der WM Straßenschlachten. http://t.co/GglZlvW7hc (nd)', '2014-04-30', 'demo alsubaiey', '', 'en', '0', 3),
(461391627375099904, '#Newsfunk Rio und São Paulo: Neue Gewalt in Brasilien vor Fußball-WM http://t.co/lb2Yuho0zS In Rio de Janeiro und São Paulo liefern si...', '2014-04-30', 'Nachrichtenfunker', '', 'de', '0', 3),
(461391898490728448, '#news Rio und São Paulo: Neue Gewalt in Brasilien vor Fußball-WM http://t.co/BWFYPcvnnG', '2014-04-30', 'NEWS', '', 'de', '0', 3),
(461392478445531136, '?@zeitonline: In Brasilien liefern sich Polizei und Demonstranten kurz vor der WM Straßenschlachten. http://t.co/eQKdCLWivN (nd)? #jadochwm', '2014-04-30', 'Bairisch Koenig', 'München', 'de', '0', 3),
(461392574780301312, 'ZEIT reports: Rio und São Paulo: Neue Gewalt in Brasilien vor Fußball-WM http://t.co/YwlwlUivNZ', '2014-04-30', 'The Israel Company', 'Schwebheim - Germany', 'de', '0', 3),
(461393774980395008, 'RT @zeitonline: In Brasilien liefern sich Polizei und Demonstranten kurz vor der WM Straßenschlachten. http://t.co/GglZlvW7hc (nd)', '2014-04-30', 'Pádua GuaraniKaiowá', 'Brasil', 'en', '0', 3),
(461394545955987456, 'Rio und São Paulo: Neue Gewalt in Brasilien vor Fußball-WM http://t.co/Zex5PSJoZ8', '2014-04-30', 'Marius Eyesfeld', 'Berlin', 'de', '0', 3),
(461395946736455680, 'You don''t say. #adler #hsv #kahn \n http://t.co/DsUn42M6UI', '2014-04-30', 'Katha ', '', 'de', '0', 3),
(461396915717156864, 'http://t.co/FLal7S0n0m Rio und São Paulo: Neue Gewalt in Brasilien vor Fußball-WM http://t.co/ORofZaYB8B', '2014-04-30', 'Horst Müller', '', 'de', '0', 3),
(461397023950770176, 'Rio und São Paulo: Neue Gewalt in Brasilien vor Fußball-WM:  In Rio de Janeiro und São Paulo liefern sich Poli... http://t.co/5ITxTPVltr', '2014-04-30', 'Räubertochter', 'MattisWald', 'de', '0', 3),
(461397408002236417, 'Fußball und Lesung ? passt das zusammen? Aber natürlich! Zur Einstimmung auf die Fußball-WM 2014 in Brasilien... http://t.co/2MFZM45C6q', '2014-04-30', 'WOLL-Biggesee', 'Region Biggesee - Kreis Olpe', 'de', '0', 3),
(461400922602897408, 'Brasilien: Erneut Ausschreitungen vor der Fußball-WM http://t.co/J2Rmkrqj0c', '2014-04-30', 'Spam', '', 'de', '0', 3),
(461401952317083648, 'RT @zeitonline: In Brasilien liefern sich Polizei und Demonstranten kurz vor der WM Straßenschlachten. http://t.co/GglZlvW7hc (nd)', '2014-04-30', 'Heinrich Freer', '', 'de', '0', 3),
(461402628547956736, 'WM 2014 in Brasilien, jetzt Brasilianisch-portugiesisch Online lernen: http://t.co/e4RrZA3Dv7 http://t.co/CXzi4ztMbx', '2014-04-30', 'Open Languages', 'Zurich, Switzerland', 'en', '0', 3),
(461403294863081472, 'Angebotsende: Panini - Fußball WM 2014 Brasilien - 50 Sticker aus der Liste:  EUR 4,40 (3 Gebote)Ange... http://t.co/9MzIOboUy0 @Ebay AT', '2014-04-30', 'The Deals Planet', '', 'fr', '0', 3),
(461403401189064704, 'RT @zeitonline: In Brasilien liefern sich Polizei und Demonstranten kurz vor der WM Straßenschlachten. http://t.co/GglZlvW7hc (nd)', '2014-04-30', 'Elio', '', 'de', '0', 3),
(461404567041617920, '#Politik ? Rio und São Paulo: Neue Gewalt in Brasilien vor Fußball-WM:  In Rio de Janeiro und São Paulo liefer... http://t.co/BN05Pm4DV3', '2014-04-30', 'Kazi Media Germany?', 'Ü.T: 52.538779,13.407211', 'fr', '0', 3),
(461405276110069760, 'Nur noch 43 Tage bis zur #WM2014. 1950 fand die WM schonmal in #Brasilien statt. Ein Vergleich zwischen 1950 und 2014 http://t.co/iwbG0pvWr2', '2014-04-30', 'UB HSU Hamburg', 'Hamburg', 'de', '0', 3),
(461405425884467200, 'RT @zeitonline: In Brasilien liefern sich Polizei und Demonstranten kurz vor der WM Straßenschlachten. http://t.co/GglZlvW7hc (nd)', '2014-04-30', 'Frida Thurm', 'Berlin', 'de', '0', 3),
(461409218193817600, 'Red Bull confident Mercedes can be caught. Reminds me of that film by Steven Spielberg: ?Catch Me If You Can?! http://t.co/zhymNltfwJ #SkyF1', '2014-04-30', 'Elton Lam #79', 'London, UK', 'en', '0', 1),
(461412490963066880, '#Brasilien vor der WM: FriedeFreudeEierkuchen mit eitel Sonnenschein. Nicht. http://t.co/GikMhR19rA', '2014-04-30', 'Maria Rosenau', 'Berlin, Germany', 'en', '0', 3),
(461414052586328064, '#9: Mamma Mia Mamma MiaMeryl Streep (Actor), Pierce Brosnan (Actor), Stephen Sommers ... http://t.co/dPCG6dNrQ4 http://t.co/ppKd5Xcay4', '2014-04-30', 'Movies TV Shows', 'India', 'en', '0', 2),
(461414869091500032, 'Panini WM 2014 Brasilien - 50 Bilder aussuchen -:  EUR 1,00 (0 Gebote)Angebotsende: Donnerstag Mai-1-2014 9:43... http://t.co/iyBZq4AwHE', '2014-04-30', 'Quickberater', 'Germany', 'de', '0', 3),
(461430714391486464, 'RT @GoalDeutschland: Saisonaus = #WM-Aus? Mario #Gomez hat Brasilien noch lange nicht abgeschrieben und ist voller Hoffnung: http://t.co/VF?', '2014-04-30', 'höflich Cule', 'Camp Nou', 'en', '0', 3),
(461431331767865344, 'Mario Gomez gibt die WM noch nicht auf http://t.co/RStzfbtaqY', '2014-04-30', 'Promi24', 'Klatsch & Tratsch', 'de', '0', 3),
(461434901766475776, 'Brasilien: Schwere Ausschreitungen in Sao Paulo http://t.co/RaW2N6PlVj', '2014-04-30', 'Republikaner Jugend', '', 'de', '0', 3),
(461434905885286400, 'DWN: Brasilien: Schwere Ausschreitungen in Sao Paulo: In Brasilien breiten sich die Proteste gegen die Regieru... http://t.co/SMcQYG9Ncc', '2014-04-30', 'Hans Gernemann', '', 'de', '0', 3),
(461450680264568832, 'Rio und São Paulo: Neue Gewalt in Brasilien vor Fußball-WM | ZEIT ONLINE >> http://t.co/qS2TGomvX8', '2014-04-30', 'Schmitz'' Bookmarks', 'Kreuzberg', 'en', '0', 3),
(461459846852657152, 'Fussball-WM Brasilien 2014: Machen Sie an unserem Tipp-Spiel mit + gewinnen Sie tolle Preise! http://t.co/sZR2CT7OR0 http://t.co/AV23vMIQy4', '2014-04-30', 'Gerstl Weinselektion', 'Spreitenbach (Switzerland)', 'de', '0', 3),
(461460039933239296, '#WM2014 - Was Sie auf der Reise nach #Brasilien beachten sollten! http://t.co/qsZSjaHxdk http://t.co/mO6luzNT0w', '2014-04-30', 'Urlaubshighlights', '', 'de', '0', 3),
(461465040127033344, 'Freut ihr euch auch schon auf die WM in Brasilien? Dante sorgt schon mal für  Stimmung #ComBinho #Dante #MediaMarkt http://t.co/Jp81q7ltJk', '2014-04-30', 'prettyfancytrendy', 'Germany', 'en', '0', 3),
(461465304376168450, 'TOP Aktuell Caxirola WM 2014 Caxixi Maracas Fanartikel Rumba Rassel Vuvuzela Brasilien: Caxirola WM 2014 Caxix... http://t.co/8MOvIlPRSo', '2014-04-30', 'Alsino GmbH u.Co.KG', 'Fröndenberg', 'de', '0', 3),
(461465429735911425, 'Fußball-WM 2014: Viagogo verkauft Final-Tickets für 30.000 Euro... http://t.co/LArjcZYpQW', '2014-04-30', 'SPIEGEL ONLINE alles', '', 'de', '0', 3),
(461465429744312320, 'Fußball-WM 2014: Viagogo verkauft Final-Tickets für 30.000 Euro... http://t.co/DlM0A6smOm', '2014-04-30', 'SPIEGEL Sport', '', 'de', '0', 3),
(461467303435976705, '#Telmi #Nachrichten | #news Fußball-WM 2014: Viagogo verkauft Final-Tickets für 30.000 Euro: WM-Endspiel im... http://t.co/qHQ4rykRLs', '2014-04-30', 'DJ Telmi', 'München', 'de', '0', 3),
(461467504515485697, 'RT @SPIEGEL_Sport: Fußball-WM 2014: Viagogo verkauft Final-Tickets für 30.000 Euro... http://t.co/DlM0A6smOm', '2014-04-30', 'Andy Bauer', 'Oberbayern', 'de', '0', 3),
(461467518360485888, 'Fußball-WM 2014: Viagogo verkauft Final-Tickets für 30.000 Euro http://t.co/oqeMFje2Qd', '2014-04-30', 'SPIEGEL 24 Stunden', '', 'de', '0', 3),
(461467536169508864, 'Fußball-WM 2014: Viagogo verkauft Final-Tickets für 30.000 Euro http://t.co/kUOuFIyla1', '2014-04-30', 'SPIEGEL ONLINE Top', 'Hamburg, Germany', 'de', '0', 3),
(461467537272610817, 'Fußball-WM 2014: Viagogo verkauft Final-Tickets für 30.000 Euro http://t.co/NiARmTTeBQ', '2014-04-30', 'plaudertaschePI', 'Düsseldorf', 'de', '0', 3),
(461467943239307264, 'Fußball-WM 2014: Viagogo verkauft Final-Tickets für 30.000 Euro http://t.co/RJPSB0kBnZ via @SPIEGELONLINE', '2014-04-30', 'Tom Corner', 'Frankfurt Germany', 'en', '0', 3),
(461468627980808192, 'Fußball-WM 2014: Viagogo verkauft Final-Tickets für 30.000 Euro http://t.co/leeslEETgD', '2014-04-30', 'Spam', '', 'de', '0', 3),
(461469067325353984, 'Fußball-WM 2014: Viagogo verkauft Final-Tickets für 30.000 Euro: WM-Endspiel im Maracana-Stadion in Rio - ein ... http://t.co/NWc4GAhrgm', '2014-04-30', 'Eistee.x33', '', 'de', '0', 3),
(461469576434565120, 'Fußball-WM 2014: Viagogo verkauft Final-Tickets für 30.000 Euro http://t.co/rjE5sk2A7q April 30, 2014 at 01:21PM', '2014-04-30', 'Patrick Gorska', '', 'de', '0', 3),
(461470506235863040, 'Panini WM 2014 Brasilien - 50 Bilder aussuchen -:  EUR 1,00 (0 Gebote)Angebotsende: Donnerstag Mai-1-2014 10:4... http://t.co/l75g9hnlxS', '2014-04-30', 'Quickberater', 'Germany', 'de', '0', 3),
(461470506906943488, 'Panini WM 2014 Brasilien - 50 Bilder aussuchen -:  EUR 1,00 (0 Gebote)Angebotsende: Donnerstag Mai-1-2014 11:5... http://t.co/4OLI3MCZa3', '2014-04-30', 'Quickberater', 'Germany', 'de', '0', 3),
(461470507720642560, 'Panini WM 2014 Brasilien - 50 Bilder aussuchen -:  EUR 1,00 (0 Gebote)Angebotsende: Donnerstag Mai-1-2014 12:5... http://t.co/Rs3UAFd9wH', '2014-04-30', 'Quickberater', 'Germany', 'de', '0', 3),
(461471978050682880, '#schlagzeilen Fußball-WM 2014: Viagogo verkauft Final-Tickets für 30.000 Euro: WM-Endspiel im Maracana-Stadion... http://t.co/fMSDev8v3a', '2014-04-30', 'Deutsche Presse', 'Berlin', 'de', '0', 3),
(461471986875527169, 'Fußball-WM 2014: Viagogo verkauft Final-Tickets für 30.000 Euro: WM-Endspiel im Maracana-Stadion in Rio - ein ... http://t.co/UYwYruzZDW', '2014-04-30', 'bashir al walid', '', 'en', '0', 3),
(461471993091477505, 'Fußball-WM 2014: Viagogo verkauft Final-Tickets für 30.000 Euro: WM-Endspiel im Maracana-Stadion ... http://t.co/lJxCUcbTJE #Nachrichten', '2014-04-30', 'TimsDailyNews', '', 'de', '0', 3),
(461472014042017792, 'Fußball-WM 2014: Viagogo verkauft Final-Tickets für 30.000 Euro: WM-Endspiel im Maracana-Stadion in Rio - ein ... http://t.co/53yhtkJgYW', '2014-04-30', 'Karl Heinz', '', 'de', '0', 3),
(461472029565149186, '#chamalieres Fußball-WM 2014: Viagogo verkauft Final-Tickets für 30.000 Euro: WM-Endspiel im Maracana-Stadion ... http://t.co/Ag7rdt77Uq', '2014-04-30', 'Ma maison Mon jardin', 'Chamalières - Ville européenne', 'fr', '0', 3),
(461472683515838464, 'Völlig bizarr - Fußball-WM 2014: Viagogo verkauft Final-Tickets für 30.000 Euro http://t.co/ViCzcCl33n via @SPIEGELONLINE #copa2014 #wm #rj', '2014-04-30', 'Sonja Peteranderl', 'Here & There', 'de', '0', 3),
(461472934729895936, 'RT @SPIEGEL_Top: Fußball-WM 2014: Viagogo verkauft Final-Tickets für 30.000 Euro http://t.co/kUOuFIyla1', '2014-04-30', 'Daniel Werkmeister', '', 'en', '0', 3),
(461473316151504896, 'RT @SPIEGEL_alles: Fußball-WM 2014: Viagogo verkauft Final-Tickets für 30.000 Euro... http://t.co/LArjcZYpQW', '2014-04-30', 'Andrea Hirter', 'Kanton Bern', 'de', '0', 3),
(461473999005163520, '#news Fußball-WM 2014: Viagogo verkauft Final-Tickets für 30.000 Euro http://t.co/mGPqypiRNp', '2014-04-30', 'NEWS', '', 'de', '0', 3),
(461474470159335424, '#Fussball Fußball-WM 2014: Viagogo verkauft Final-Tickets für 30.000 Euro: WM-Endspiel im Maracana-Stadion in ... http://t.co/pYtfGrJbLR', '2014-04-30', 'Deutsche Presse', 'Berlin', 'de', '0', 3),
(461474472629784576, 'Fußball-WM 2014: Viagogo verkauft Final-Tickets für 30.000 Euro http://t.co/YtxNYA4LEL', '2014-04-30', 'Sven Walther', 'HAMBURG, MAGDEBURG', 'de', '0', 3),
(461478916067045376, '#news #newsDE #infos Fußball-WM 2014: Viagogo verkauft Finale-Tickets für 30.000 Euro http://t.co/NVCINelliO', '2014-04-30', 'SN Infofiles 1', '', 'de', '0', 3),
(461479606294302721, '#spiegel: Fußball-WM 2014: Viagogo verkauft Finale-Tickets für 30.000 Euro http://t.co/GojXP4gIur #okru', '2014-04-30', 'Okru News #02', 'Addrup', 'de', '0', 3),
(461481862951866368, 'For the game. For the world. - WM 2014: #Viagogo verkauft Finale-Tickets für 30.000 Euro http://t.co/jOxsH4b8I7', '2014-04-30', 'Der Maschinist', '', 'de', '0', 3),
(461482541405319170, '#Sport ? Fußball-WM 2014: Viagogo verkauft Finale-Tickets für 30.000 Euro: WM-Endspiel im Maracana-Stadion in ... http://t.co/HzCWHGDlDd', '2014-04-30', 'Kazi Media Germany?', 'Ü.T: 52.538779,13.407211', 'fr', '0', 3),
(461483706805649408, 'Amnesty stellt fest, dass in Brasilien Menschenrechte in Gefahr sind. Die Meinungs- und Versammlungsfreiheit wird... http://t.co/vVcSx8RLGa', '2014-04-30', 'AmnestyStudentanHSG', 'St. Gallen, Switzerland', 'de', '0', 3),
(461486632848613376, 'http://t.co/n5xaWGz1Gt Fußball-WM 2014: Viagogo verkauft Finale-Tickets für 30.000 Euro http://t.co/LY2djnIJKy', '2014-04-30', 'Ruth Hecker', '', 'de', '0', 3),
(461489517568864256, 'Angebotsende: Panini WM 2014 Brasilien - 50 Bilder aussuchen -:  EUR 7,51 (4 Gebote)Angebotsende: Mit... http://t.co/hDVvz8xoAi @Ebay AT', '2014-04-30', 'The Deals Planet', '', 'fr', '0', 3),
(461489716630548481, 'Panini WM 2014 Brasilien - 50 Bilder aussuchen -:  EUR 1,00 (0 Gebote)Angebotsende: Donnerstag Mai-1-2014 14:1... http://t.co/l9jiKxYSZc', '2014-04-30', 'Quickberater', 'Germany', 'de', '0', 3),
(461490569898762241, 'tz: Bayern-Aus hilft Löw für die WM-Vorbereitung: München - In der Münchner Arena erlebten der Bundestrainer J... http://t.co/bRioV89P22', '2014-04-30', 'FC Bayern Net', '', 'es', '0', 3),
(461491145546407937, 'RT @SPIEGEL_Top: Fußball-WM 2014: Viagogo verkauft Final-Tickets für 30.000 Euro http://t.co/kUOuFIyla1', '2014-04-30', 'Detlef Alsbach', 'Köln', 'de', '0', 3),
(461492108809863169, 'Bayern-Aus hilft Löw für die WM-Vorbereitung http://t.co/Gk33lzqyRr', '2014-04-30', 'Promi24', 'Klatsch & Tratsch', 'de', '0', 3),
(461492928058519552, 'RT @SPIEGEL_Top: Fußball-WM 2014: Viagogo verkauft Final-Tickets für 30.000 Euro http://t.co/kUOuFIyla1', '2014-04-30', 'Jojo Liebnau', 'Hamburg', 'en', '0', 3),
(461493768102100992, '"@SPIEGEL_Top: Fußball-WM 2014: Viagogo verkauft Final-Tickets für 30.000 Euro http://t.co/IUoJ68ewKt"\n#Fußballgeschäft #viaNOgo #wm2014', '2014-04-30', 'Kloesschen-Hamburg', 'Hamburg', 'de', '0', 3),
(461497280429031425, 'RT @SPIEGEL_Top: Fußball-WM 2014: Viagogo verkauft Final-Tickets für 30.000 Euro http://t.co/kUOuFIyla1', '2014-04-30', 'MCMLXXI', '', 'de', '0', 3),
(461500777857839104, 'Unser neues Dossier zur WM ist online! \n"Fußballweltmeisterschaft 2014 in Brasilien: Wofür und für wen?" \n http://t.co/yNeewLeJv2 #boell', '2014-04-30', 'HeinrichBöllStiftung', 'Germany, Berlin', 'de', '0', 3);
INSERT INTO `tweet_entry` (`id`, `tw_text`, `tw_creationdate`, `tw_user`, `tw_location`, `tw_language`, `tw_deleted`, `event_id`) VALUES
(461500870052442112, 'Absolutes Topangebot:\n\nDas offizielle Trikot der deutschen Nationalmannschaft zur FIFA WM 2014 in Brasilien zum... http://t.co/cGvoL1hF7h', '2014-04-30', 'MES Marketingservice', 'Leichlingen', 'de', '0', 3),
(461500983411879936, 'Deutsche Fans sichern sich 53.500 Tickets für WM 2014 in Brasilien -  http://t.co/MhpH5vBHLq via @BrasilienWM2014', '2014-04-30', 'Dietmar Lang', 'Toledo-PR, Brasilien', 'de', '0', 3),
(461501017960742912, 'RT @boell_stiftung: Unser neues Dossier zur WM ist online! \n"Fußballweltmeisterschaft 2014 in Brasilien: Wofür und für wen?" \n http://t.co/?', '2014-04-30', 'Jon@h Wedekind', '', 'en', '0', 3),
(461501220558225408, 'RT @SPIEGEL_Top: Fußball-WM 2014: Viagogo verkauft Final-Tickets für 30.000 Euro http://t.co/kUOuFIyla1', '2014-04-30', 'MisterX?', 'Gefangen im Neuland', 'de', '0', 3),
(461503919760211970, 'Fussball-WM 2014: Übernachtung mittlerweile auch in Favelas möglich  - http://t.co/QJnt81qc5r', '2014-04-30', 'BrasilienReise', '', 'de', '0', 3),
(461504025955799040, 'Fussball-WM 2014: Übernachtung mittlerweile auch in Favelas möglich - http://t.co/uxkBlOkdd5 via @Brasilien_Reise', '2014-04-30', 'Dietmar Lang', 'Toledo-PR, Brasilien', 'de', '0', 3),
(461504240394207232, 'RT @boell_stiftung: Unser neues Dossier zur WM ist online! \n"Fußballweltmeisterschaft 2014 in Brasilien: Wofür und für wen?" \n http://t.co/?', '2014-04-30', 'BÜNDNIS90/DIE GRÜNEN', 'Deutschland', 'de', '0', 3),
(461505308511068160, 'Deutsche Fans sichern sich 53.500 Tickets für WM 2014 in Brasilien http://t.co/SVZjuHsGqh', '2014-04-30', 'IAP PortalNetwork', 'Brasilien', 'de', '0', 3),
(461505309001805824, 'Deutsche Fans sichern sich 53.500 Tickets für WM 2014 in Brasilien http://t.co/YXeFw90tRG', '2014-04-30', 'Dietmar Lang', 'Toledo-PR, Brasilien', 'de', '0', 3),
(461506788546736129, 'Nürnberg, 29. April 2014  Das neu errichtete Campo Bahia, das WM-Quartier der Nationalelf in Brasilien, ist bald... http://t.co/8jgx2LOMxK', '2014-04-30', 'Mynewsdesk', 'Leipzig, Germany', 'de', '0', 3),
(461509594167013376, 'Panini WM 2014 Brasilien - 50 Bilder aussuchen -:  EUR 1,00 (0 Gebote)Angebotsende: Donnerstag Mai-1-2014 16:0... http://t.co/Lu3JGgmbs3', '2014-04-30', 'Quickberater', 'Germany', 'de', '0', 3),
(461509772282695682, 'empfehlenswert RT @boell_stiftung Unser Dossier zur WM ist online! "Fußball WM 2014 in Brasilien:Wofür u für wen?" http://t.co/jTp1erZL59', '2014-04-30', 'Monika Lazar', 'Sachsen', 'de', '0', 3),
(461511157342154752, 'RT @SPIEGEL_Top: Fußball-WM 2014: Viagogo verkauft Final-Tickets für 30.000 Euro http://t.co/kUOuFIyla1', '2014-04-30', 'Fritz Schattauer', '', 'en', '0', 3),
(461512477168394240, 'Unbequeme #Fakten zur #FußballWM in #Brasilien \n@Survival @amnesty_de http://t.co/Xz4JaocWif', '2014-04-30', 'UmweltDialog', 'Münster', 'de', '0', 3),
(461514735301963776, 'Bayern-Aus hilft Löw für die WM-Vorbereitung http://t.co/BaQuSrzgOj', '2014-04-30', 'FC Bayern News', 'München', 'de', '0', 3),
(461515795055775744, '#Pressefreiheit in #Brasilien vor der #Fußball-WM: Abendveranstaltung in #Berlin mit dem #Fotograf André Vieira. https://t.co/YorV6xtsvo', '2014-04-30', 'ReporterohneGrenzen', 'Berlin - Germany', 'de', '0', 3),
(461516127999631360, 'RT @ReporterOG: #Pressefreiheit in #Brasilien vor der #Fußball-WM: Abendveranstaltung in #Berlin mit dem #Fotograf André Vieira. https://t.?', '2014-04-30', 'Bar?? Marquez', 'Essen/Germany', 'de', '0', 3),
(461517675186102273, 'Während der Fußball#WM in Brasilien angeben wollen? Kein Problem mit dem Kurs ?Fußballbegriffe auf Portugiesisch? http://t.co/xKNuWc44zK', '2014-04-30', 'Stadt Ludwigshafen', '', 'de', '0', 3),
(461520526251671552, 'Rio und São Paulo: Neue Gewalt in Brasilien vor Fußball-WM - ZEIT ONLINE http://t.co/CjBoi6h6vi #fußball', '2014-04-30', 'Fussball Guru', '', 'de', '0', 3),
(461523968168820736, 'WM 2014: Das DFB-Quartier in Brasilien. http://t.co/Tfwwg5nAmt', '2014-04-30', 'BrasilienTraumUrlaub', 'München - Recife', 'de', '0', 3),
(461526332589883393, 'Scolari: Proteste gefährden Brasiliens WM-Chancen\n\nweitere Infos unter: http://t.co/rbXndzqLEJ... http://t.co/URJzZqU0tz', '2014-04-30', 'DeutschsprachigeInBR', 'Brasilien', 'de', '0', 3),
(461528020990193664, 'Re: WM 2014 Brasilien http://t.co/pZqIuYIVs7', '2014-04-30', 'Brasilienfreunde', '', 'de', '0', 3),
(461529414744805376, 'Panini WM 2014 Brasilien - 50 Bilder aussuchen -:  EUR 1,00 (0 Gebote)Angebotsende: Donnerstag Mai-1-2014 17:1... http://t.co/k9jz4ZGYnU', '2014-04-30', 'Quickberater', 'Germany', 'de', '0', 3),
(461530081018789888, 'Brasil na Alemanha. http://t.co/kazU6vzoop', '2014-04-30', 'Israel Batista', '', 'pt', '0', 3),
(461536061592596480, 'Die Fussball Show Ohne Name #02 ? FIFA WM 2014 in Brasilien - Fluch oder Segen?: http://t.co/K7mhfn0f6L über @YouTube', '2014-04-30', 'ZockerDudes', 'Deutschland', 'de', '0', 3),
(461537371595743232, 'Townsend fällt für Brasilien aus http://t.co/yb3BW8V1jo April 30, 2014 at 05:10PM', '2014-04-30', 'Patrick Gorska', '', 'de', '0', 3),
(461542543935553537, 'Seit 15. April läuft die letzte Phase des Ticketverkaufs für die Fußball-WM in Brasilien. Allein in den ersten... http://t.co/fNQSxFYZiU', '2014-04-30', 'IAP PortalNetwork', 'Brasilien', 'de', '0', 3),
(461546460270452736, 'RT @ReporterOG: #Pressefreiheit in #Brasilien vor der #Fußball-WM: Abendveranstaltung in #Berlin mit dem #Fotograf André Vieira. https://t.?', '2014-04-30', 'Sven ', 'Ludwigsburg ', 'de', '0', 3),
(461548294871609344, '[Böll-Stiftung] Am Spielfeldrand der Fußball-WM in Brasilien http://t.co/rx8ljY9j79', '2014-04-30', 'Politik-Feed', '', 'de', '0', 3),
(461550440392323072, 'PANINI BOX Display WM 2014 Brasilien: neue originalverpackte BOX\n100 Tüten à 5...\nPreis: EUR 45,00\n http://t.co/8B5RS0Z0kD', '2014-04-30', 'bazar.at Freizeit', '', 'de', '0', 3),
(461551343639863296, 'Re: WM 2014 Brasilien http://t.co/TYk3Fu6m3T', '2014-04-30', 'Brasilienfreunde', '', 'de', '0', 3),
(461552178990022656, 'Panini WM 2014 Brasilien - 50 Bilder aussuchen -:  EUR 1,00 (0 Gebote)Angebotsende: Donnerstag Mai-1-2014 18:4... http://t.co/w2S9s4Wdkb', '2014-04-30', 'Quickberater', 'Germany', 'de', '0', 3),
(461556165328265216, 'RT @boell_stiftung: Unser neues Dossier zur WM ist online! \n"Fußballweltmeisterschaft 2014 in Brasilien: Wofür und für wen?" \n http://t.co/?', '2014-04-30', 'mike mathias', 'Luxembourg', 'fr', '0', 3),
(461556257267019776, 'PANINI BOX Display WM 2014 Brasilien: neue originalverpackte BOX\n100 Tüten à 5...\nPreis: EUR 45,00\n http://t.co/qS4g9VNr3i', '2014-04-30', 'bazar.at NÖ', '', 'de', '0', 3),
(461560796309254145, 'Panini Tauschbörse in Rorschach\nAlle Sammler von Panini Bilder der Fussball WM 2014 in Brasilien sind am Samstag,... http://t.co/F4yAhkdukd', '2014-04-30', 'Lukas Mäder', 'Goldach', 'de', '0', 3),
(461572694669283328, 'RT @boell_stiftung: Unser neues Dossier zur WM ist online! \n"Fußballweltmeisterschaft 2014 in Brasilien: Wofür und für wen?" \n http://t.co/?', '2014-04-30', 'ichbinBW // Oliver', 'Baden-Württemberg', 'de', '0', 3),
(461573139437064192, 'Panini WM 2014 Brasilien - 50 Bilder aussuchen -:  EUR 1,00 (0 Gebote)Angebotsende: Donnerstag Mai-1-2014 19:4... http://t.co/tBhiarXl4u', '2014-04-30', 'Quickberater', 'Germany', 'de', '0', 3),
(461594843643248640, 'Panini WM 2014 Brasilien - 50 Bilder aussuchen -:  EUR 1,00 (0 Gebote)Angebotsende: Donnerstag Mai-1-2014 20:4... http://t.co/GTYduUlrx0', '2014-04-30', 'Quickberater', 'Germany', 'de', '0', 3),
(461594844561813504, 'Panini WM 2014 Brasilien - 50 Bilder aussuchen -:  EUR 1,00 (0 Gebote)Angebotsende: Donnerstag Mai-1-2014 21:4... http://t.co/fvLjfBMf5G', '2014-04-30', 'Quickberater', 'Germany', 'de', '0', 3),
(461615670271422468, 'I love Mamma Mia so much. And even though Pierce Brosnan is 60, he still looks great, but he shouldn`t sing.', '2014-04-30', 'Roksana Król', 'Poland', 'en', '0', 2),
(461618293334233088, 'Panini WM 2014 Brasilien - 50 Bilder aussuchen -:  EUR 1,00 (0 Gebote)Angebotsende: Donnerstag Mai-1-2014 22:4... http://t.co/ZV9JHSsbb9', '2014-04-30', 'Quickberater', 'Germany', 'de', '0', 3),
(461641040277950464, '#Deutsch #News Fußball: Brasilien: Neymar versteht Proteste gegen die WM: Aktualisiert 30. April 2014 12:02 Uh...  http://t.co/UlyhPXkPBq', '2014-05-01', 'The News', '', 'pt', '0', 3),
(461644700512841728, 'Re: WM 2014 Brasilien http://t.co/xMWvzWQys0', '2014-05-01', 'Brasilienfreunde', '', 'de', '0', 3),
(461660291848105984, 'Re: WM 2014 Brasilien http://t.co/wC63iQGnzc', '2014-05-01', 'Brasilienfreunde', '', 'de', '0', 3),
(461661467251449856, 'Nürnberg, 29. April 2014  Das neu errichtete Campo Bahia, das WM-Quartier der Nationalelf in Brasilien, ist bald... http://t.co/jhvu2jnOKW', '2014-05-01', 'themenportal', 'Germany', 'de', '0', 3),
(461720237063565312, '"FIFA WM 2014"-Spezialf: Wien (OTS) - Vom 12. Juni bis 13. Juli 2014 findet in Brasilien mit? http://t.co/uDZnfKvAme', '2014-05-01', 'Originalnews.uk', 'Berlin', 'en', '0', 3),
(461747338302988288, '"FIFA WM 2014"-Spezialf: Wien (OTS) - Vom 12. Juni bis 13. Juli 2014 findet in Brasilien mit? http://t.co/OHCxB6Q5Of', '2014-05-01', 'Original News', 'Berlin', 'de', '0', 3),
(461750103410085888, '"FIFA WM 2014"-Spezialf: Wien (OTS) - Vom 12. Juni bis 13. Juli 2014 findet in Brasilien mit? http://t.co/DoNVrBXLrw', '2014-05-01', 'Smart PR', 'Berlin', 'de', '0', 3),
(461751041470775296, 'Hodgson schließ Terry Comeback zur WM 2014 aus http://t.co/XvzKk4W6Tn', '2014-05-01', 'wm2014-brasilien.net', 'Deutschland', 'de', '0', 3),
(461763444740349952, 'Angebotsende: Panini WM 2014 Brasilien - 50 Bilder aussuchen -:  EUR 8,01 (5 Gebote)Angebotsende: Don... http://t.co/IhzqoarRIG @Ebay AT', '2014-05-01', 'The Deals Planet', '', 'fr', '0', 3),
(461774253868994560, 'Nur noch 1.020 Stunden bis zum ersten Spiel! Am Donnerstag, 12. Juni 2014 um 22:00 spielt Brasilien gegen Kroatien! http://t.co/Iosy2sPMyO', '2014-05-01', 'roland dreix', 'Erlangen', 'de', '0', 3),
(461784811389333504, 'FIFA WM 2014 [HD] #001 Brasilien versus Kroatien ? Das Eröffnungsspiel [WM PROGNOSE] http://t.co/5DqsypxQ5t', '2014-05-01', 'Chris', 'Germany', 'de', '0', 3),
(461789981170618368, 'Panini WM 2014 Brasilien - 50 Bilder aussuchen -:  EUR 1,00 (0 Gebote)Angebotsende: Freitag Mai-2-2014 9:45:06... http://t.co/orwRhwqCqY', '2014-05-01', 'Quickberater', 'Germany', 'de', '0', 3),
(461806885965168640, '...und dann gewinnt Spanien auch noch die WM 2014 in Brasilien, nebst der CL.\n\nDavor das ganze Bla von:\n- zu alt\n- zu satt\n- zu langweilig', '2014-05-01', 'Count Cunt', '', 'de', '0', 3),
(461807298894393344, 'Der DUPLI-COLOR platinum Award 2014 ist eröffnet!\n\nPassend zur anstehenden Fußball-WM in Brasilien suchen wir in... http://t.co/UgC6VvdZoZ', '2014-05-01', 'MOTIP DUPLI GmbH', 'Haßmersheim', 'de', '0', 3),
(461807918451392512, 'Panini WM 2014 Brasilien - 50 Bilder aussuchen -:  EUR 1,00 (0 Gebote)Angebotsende: Freitag Mai-2-2014 10:50:3... http://t.co/KUxD1iBdva', '2014-05-01', 'Quickberater', 'Germany', 'de', '0', 3),
(461807919072149505, 'Panini WM 2014 Brasilien - 50 Bilder aussuchen -:  EUR 1,00 (0 Gebote)Angebotsende: Freitag Mai-2-2014 11:54:0... http://t.co/qAX8GkM3qH', '2014-05-01', 'Quickberater', 'Germany', 'de', '0', 3),
(461826118736023554, 'Panini WM 2014 Brasilien - 50 Bilder aussuchen -:  EUR 1,00 (0 Gebote)Angebotsende: Freitag Mai-2-2014 13:05:0... http://t.co/aYPAQvl9eJ', '2014-05-01', 'Quickberater', 'Germany', 'de', '0', 3),
(461835854668103681, 'Fußball-Weltmeisterschaft 2014 in Brasilien: WLAN-Probleme in WM-Stadien  - http://t.co/Ix9pw3HdeB', '2014-05-01', 'agência latinapress', 'Nachrichtenportal', 'de', '0', 3),
(461836905324482560, 'RT @latinapress: Fußball-Weltmeisterschaft 2014 in Brasilien: WLAN-Probleme in WM-Stadien  - http://t.co/Ix9pw3HdeB', '2014-05-01', 'Sonja Peteranderl', 'Here & There', 'de', '0', 3),
(461840040780259328, 'Die Endrunde der Fußball-Weltmeisterschaft 2014 findet vom 12. Juni bis zum 13. Juli 2014 in Brasilien statt.... http://t.co/gWfBhP7Y2K', '2014-05-01', 'agência latinapress', 'Nachrichtenportal', 'de', '0', 3),
(461844622306598912, 'Panini WM 2014 Brasilien - 50 Bilder aussuchen -:  EUR 1,00 (0 Gebote)Angebotsende: Freitag Mai-2-2014 14:22:1... http://t.co/QHOtYOTWOg', '2014-05-01', 'Quickberater', 'Germany', 'de', '0', 3),
(461846040283316225, 'Fußball-Weltmeisterschaft 2014 in Brasilien: WLAN-Probleme in WM-Stadien http://t.co/ggQ6ikIIU8', '2014-05-01', 'IAP PortalNetwork', 'Brasilien', 'de', '0', 3),
(461846055554797570, 'Fußball-Weltmeisterschaft 2014 in Brasilien: WLAN-Probleme in WM-Stadien http://t.co/ZD1GqSdsDn', '2014-05-01', 'Dietmar Lang', 'Toledo-PR, Brasilien', 'de', '0', 3),
(461846098794254336, 'I liked a @YouTube video from @spooky_4f http://t.co/cXzeMfGSXy FIFA WM 2014 [HD] #001 Brasilien versus Kroatien ? Das', '2014-05-01', 'Gamesmotion', '', 'de', '0', 3),
(461846520145248259, 'Re: WM 2014 Brasilien http://t.co/rnmNcfZ54G', '2014-05-01', 'Brasilienfreunde', '', 'de', '0', 3),
(461851625267527681, 'Ich habe ein @YouTube-Video von @cmdkrieger positiv bewertet: http://t.co/LYwTqaCXbI Kurz und Knapp #8: WM 2014 in Brasilien', '2014-05-01', 'Kevin Reichmann', 'Leibnitz', 'de', '0', 3),
(461853315102691328, 'Het gaat lekker in Brazilië in de aanloop naar het WK\nRio und São Paulo: Neue Gewalt in Brasilien vor Fußball-WM http://t.co/EHbFmU25Nz', '2014-05-01', 'Klaas Pals', 'Groningen, Nederland', 'nl', '0', 3),
(461855711266623490, 'FIFA Fußball-WM Brasilien 2014 für nur 25 Euro Zuzahlung: Jetzt play''-Abonnenten werben! [Anzeige] http://t.co/LTMmdHWNkm', '2014-05-01', 'Georg Ulrich', 'Saarbrücken - Germany', 'de', '0', 3),
(461891847737339904, 'Sprichst du Fußball?: Lerne Fußball-Vokabeln zur WM 2014 in Brasilien. Alle Spieler und Situationen knüpfen an... http://t.co/V8NA1SuMTy', '2014-05-01', 'FFFF EED', 'The Web', 'en', '0', 3),
(461893463038902272, 'Re: WM 2014 Brasilien http://t.co/ukzO9mUz1W', '2014-05-01', 'Brasilienfreunde', '', 'de', '0', 3),
(461901154268368896, 'Panini WM 2014 Brasilien - 50 Bilder aussuchen -:  EUR 1,00 (0 Gebote)Angebotsende: Freitag Mai-2-2014 16:17:0... http://t.co/cXqqpwbuAD', '2014-05-01', 'Quickberater', 'Germany', 'de', '0', 3),
(461919277235195904, 'Panini WM 2014 Brasilien - 50 Bilder aussuchen -:  EUR 1,00 (0 Gebote)Angebotsende: Freitag Mai-2-2014 18:35:3... http://t.co/mPVDQHXwMd', '2014-05-01', 'Quickberater', 'Germany', 'de', '0', 3),
(461923329398816768, 'Post Edited: Brasilien: Vorsorge bei Reisen zur WM und zum Karneval http://t.co/rLAtl4wbDp', '2014-05-01', 'Weltreisejournal', 'Berlin', 'de', '0', 3),
(461938270943723520, 'Panini WM 2014 Brasilien - 50 Bilder aussuchen -:  EUR 1,00 (0 Gebote)Angebotsende: Freitag Mai-2-2014 19:46:0... http://t.co/jRr4Kk2hy0', '2014-05-01', 'Quickberater', 'Germany', 'de', '0', 3),
(461945768925220864, 'Campo Bahia - Ein unfertiges Paradies fürs DFB-Team http://t.co/umG2ttcrlb', '2014-05-01', 'Marco Fisch', '49.43559,10.956268', 'de', '0', 3),
(461955734637248512, 'Re: WM 2014 Brasilien http://t.co/3fpQKNi1xp', '2014-05-01', 'Brasilienfreunde', '', 'de', '0', 3),
(461958876783329280, 'Fußball in Brasilien: FIFA WM 2014-Tickets mit Flug und Hotel zu gewinnen http://t.co/yhQbZSOa9N via @sternde', '2014-05-01', 'Oliver', '', 'en', '0', 3),
(461974706950660097, 'Rio de Janeiro: Zwei Polizisten in Favela angeschossen: WM 2014: In Brasilien herrscht weiterhin Unruhe© SID-I... http://t.co/0Pcb0Ki5t7', '2014-05-01', 'News 24h Ger', '', 'en', '0', 3),
(461975306438336512, 'Panini WM 2014 Brasilien - 50 Bilder aussuchen -:  EUR 1,00 (0 Gebote)Angebotsende: Freitag Mai-2-2014 20:57:5... http://t.co/glkem6L2pc', '2014-05-01', 'Quickberater', 'Germany', 'de', '0', 3),
(461975307851816960, 'Panini WM 2014 Brasilien - 50 Bilder aussuchen -:  EUR 1,00 (0 Gebote)Angebotsende: Freitag Mai-2-2014 23:04:5... http://t.co/WWPCwdTwgm', '2014-05-01', 'Quickberater', 'Germany', 'de', '0', 3),
(461981128140677120, 'Brasilien 2014: WM-Fußballstimmung mit Bitburger-Verlosung - UNICUM.de https://t.co/DYxY9V0JNf', '2014-05-01', 'Sebastian Roessiger', '', 'de', '0', 3),
(461983519133433856, '#10: Mamma Mia!: The Movie Mamma Mia!: The MovieMeryl Streep (Actor), Pierce Brosnan ... http://t.co/vtQqHYkgKp http://t.co/zobOTAoWTG', '2014-05-01', 'Movies TV Shows', 'India', 'en', '0', 2),
(462096705761333249, 'Brazil 2014 - Italia - http://t.co/O1w9GTMWa1', '2014-05-02', 'Zara Sunrise', '', 'de', '0', 3),
(462111040042700800, 'guten morgen. Früchstückslektüre gefällig? alle meine bisherigen WM 2014 Beiträge im Überblick :) http://t.co/AJHdwigtBX', '2014-05-02', 'derplapperblog', 'Vienna', 'de', '0', 3),
(462113473707507713, 'Mario Gomez: Die WM ist und bleibt mein großes Ziel http://t.co/0WkogG6ObR', '2014-05-02', 'wm2014-brasilien.net', 'Deutschland', 'de', '0', 3),
(462142691602468864, 'WM in Brasilien: "Begeisterung hält sich in Grenzen" http://t.co/IQKrAdt67j', '2014-05-02', 'Promi24', 'Klatsch & Tratsch', 'de', '0', 3),
(462143542509719552, 'Im Vorfeld der vom 12. Juni 2014 bis 13. Juli 2014 stattfindenden Fußball-Weltmeisterschaft in Brasilien wurden... http://t.co/d9XAmxFZQX', '2014-05-02', 'PSV Hannover', 'Hannover', 'de', '0', 3),
(462158043765956608, '[@SPOX] WM 2014: Klinsmann mit 30 Spielern im Trainingscamp http://t.co/yBEZsDidv8', '2014-05-02', 'Fussball News', 'Deutschland', 'de', '0', 3),
(462158101278646272, 'Ich habe ein @YouTube-Video positiv bewertet: http://t.co/b7C1kc4Yu7 F1 A1-Ring(Spielberg, Österreich) Startcrash Coulthard', '2014-05-02', 'Moritz Müller', '', 'de', '0', 1),
(462159642697535488, 'Angebotsende: Panini WM 2014 Brasilien - 50 Bilder aussuchen -:  EUR 5,49 (4 Gebote)Angebotsende: Fre... http://t.co/T38KGVaZZo @Ebay AT', '2014-05-02', 'The Deals Planet', '', 'fr', '0', 3),
(462160320774291456, 'Campo Bahia - Ein Paradies fürs DFB-Team.  http://t.co/GoY0X7IFwW', '2014-05-02', 'ZDF heute', 'Mainz', 'de', '0', 3),
(462161221664243712, 'WM 2014 in Brasilien aus der Sicht der indigenen Völker http://t.co/EjUoEG6fV9 via @wordpressdotcom', '2014-05-02', 'Carsten Mellwig', 'Hamburg', 'de', '0', 3),
(462167686424702976, 'Gehen Sie mit unseren Artikeln auf Torjagd und stimmen Sie Ihre Kunden auf die Weltmeisterschaft in Brasilien ein! \nhttp://t.co/6h9PpxwSCv', '2014-05-02', 'DekoWoerner ', 'Leingarten, Deutschland', 'de', '0', 3),
(462169359809777664, 'Bloginho - unser Blog rund um die #WM in #Brasilien. Zum Start etwas, das gesagt werden musste... @NZZ http://t.co/83rgh6vRFx', '2014-05-02', 'Tjerk Brühwiller', 'São Paulo, Brasil', 'de', '0', 3),
(462169511756439552, 'Panini WM 2014 Brasilien - 50 Bilder aussuchen -:  EUR 1,00 (0 Gebote)Angebotsende: Samstag Mai-3-2014 11:54:4... http://t.co/4pfqOboO85', '2014-05-02', 'Quickberater', 'Germany', 'de', '0', 3),
(462170719443382272, 'Rio de Janeiro: Zwei Polizisten in Favela angeschossen: WM 2014: In Brasilien herrscht weiterhin Unruhe© SID-I... http://t.co/l0lo6GCzzo', '2014-05-02', 'derGator', '', 'it', '0', 3),
(462178551559897089, 'Formel 1: Studie: 74,5 Millionen Euro fließen nach Spielberg > Kleine Zeitung http://t.co/wYl40w2qiD #f1', '2014-05-02', 'Gerhard W. Loub', 'Vienna', 'de', '0', 1),
(462179132789772288, 'RT @Svejk: Formel 1: Studie: 74,5 Millionen Euro fließen nach Spielberg > Kleine Zeitung http://t.co/wYl40w2qiD #f1', '2014-05-02', 'Bernhard Karnthaler', 'Lanzenkirchen', 'de', '0', 1),
(462190067235037186, 'Panini WM 2014 Brasilien - 50 Bilder aussuchen -:  EUR 1,00 (0 Gebote)Angebotsende: Samstag Mai-3-2014 13:10:0... http://t.co/NZU9pmcDJm', '2014-05-02', 'Quickberater', 'Germany', 'de', '0', 3),
(462190351995129856, '#DVDKRITIK_News WM Songs 2014: Pitbull, Melanie und Avicii ? Der Soundtrack für Brasilien http://t.co/vVrT8trZTa', '2014-05-02', 'Lauro. ', 'Haan, Germany ', 'de', '0', 3),
(462193684012736513, 'Wie wird das Wetter zur Fußball-WW in Brasilien sein? Der Deutsche Wetterdienst hat ein Info-Blatt zum Klima in... http://t.co/vzTiw33tON', '2014-05-02', 'campustravel.de ', 'Deutschland, Leipzig', 'de', '0', 3),
(462195276305149952, 'SPOX:"Bundesliga: Gustavo: "Ich habe so viel durchgemacht" http://t.co/Jznii6ANGJ" #Bundesliga #SPOX', '2014-05-02', 'Bundesliga Live', '', 'de', '0', 3),
(462201647683600386, '"Ich habe so viel durchgemacht" - @LGustavo_22 im Exklusiv-Interview: http://t.co/Usk487E9RS http://t.co/j1vXwCZTPB', '2014-05-02', 'SPOX Redaktion', 'München', 'de', '0', 3),
(462202663128805376, 'RT @Bundesliga1Live: SPOX:"Bundesliga: Gustavo: "Ich habe so viel durchgemacht" http://t.co/Jznii6ANGJ" #Bundesliga #SPOX', '2014-05-02', 'topscorer?', 'FUSSBALL IST ALLES', 'en', '0', 3),
(462205755542605824, '[@SPOX] Bundesliga: Gustavo: "Ich habe so viel durchgemacht" http://t.co/Hudz4HPi2D', '2014-05-02', 'Fussball News', 'Deutschland', 'de', '0', 3),
(462208195952250881, 'HiGh FuN! Die Daily Dosis Satire des Tages: Melanie singt WM Song - Brasilien zieht Teilnahme an... http://t.co/6Q2d1KZFmh', '2014-05-02', 'DailyDosisSatire', '', 'de', '0', 3),
(462208218328887296, 'HiGh FuN!           Die Daily Dosis Satire des Tages: Melanie singt WM Song - Brasilien zieht Teilnahme ... http://t.co/P3yyvx2j4c', '2014-05-02', 'DailyDosisSatire', '', 'de', '0', 3),
(462209584673742848, 'Panini WM 2014 Brasilien - 50 Bilder aussuchen -:  EUR 1,00 (0 Gebote)Angebotsende: Samstag Mai-3-2014 14:24:0... http://t.co/8W4qAYxgK6', '2014-05-02', 'Quickberater', 'Germany', 'de', '0', 3),
(462231128376885248, 'http://t.co/XQM6XszA8P', '2014-05-02', 'ATLETAS DE FUTEBOL  ', 'RIO DE JANEIRO - BRASIL', 'pt', '0', 3),
(462232075060641792, 'Rio de Janeiro (dpa) - Die Fußball-WM in Brasilien wird 2014 in zwölf Städten ausgetragen. Die Spielorte liegen... http://t.co/mf2RRBI8bj', '2014-05-02', 'ATLETAS DE FUTEBOL  ', 'RIO DE JANEIRO - BRASIL', 'pt', '0', 3),
(462233832675368960, 'RT @spox: "Ich habe so viel durchgemacht" - @LGustavo_22 im Exklusiv-Interview: http://t.co/Usk487E9RS http://t.co/j1vXwCZTPB', '2014-05-02', 'Thomas Verna', 'München', 'de', '0', 3),
(462245329640128512, 'RT @ZDFheute: Campo Bahia - Ein Paradies fürs DFB-Team.  http://t.co/GoY0X7IFwW', '2014-05-02', 'Cloud Viewer', '', 'de', '0', 3),
(462245466407968768, '"@ZDFheute: Campo Bahia - Ein Paradies fürs DFB-Team.  http://t.co/HgegCYpLar" Wurde dort nicht vor kurzem geplündert??', '2014-05-02', 'Cloud Viewer', '', 'de', '0', 3),
(462265069791752192, 'Panini WM 2014 Brasilien - 50 Bilder aussuchen -:  EUR 1,00 (0 Gebote)Angebotsende: Samstag Mai-3-2014 17:43:2... http://t.co/fjYZeDSlzH', '2014-05-02', 'Quickberater', 'Germany', 'de', '0', 3),
(462283006179168256, 'Panini WM 2014 Brasilien - 50 Bilder aussuchen -:  EUR 1,00 (0 Gebote)Angebotsende: Samstag Mai-3-2014 18:37:4... http://t.co/hvYcud3lsz', '2014-05-02', 'Quickberater', 'Germany', 'de', '0', 3),
(462316811212447745, 'I''m trying to remember the name/lyrics to this song, but so far all I can think of is Pierce Brosnan in Mamma Mia and that''s not it 0_o', '2014-05-02', 'Kieran', 'TX', 'en', '0', 2),
(462318687417274370, 'RT @sherlockeds: I love Mamma Mia movie so much but every single time I watch that I keep asking universe ''why why did you let Pierce Brosn?', '2014-05-02', 'Adri', 'Argentina', 'en', '0', 2),
(462322287489056768, 'Fussball Weltmeisterschaft 2014 (WM 2014) in Brasilien !!\nVerpassen Sie nicht die Fussball WM 2014 in Ihrem... http://t.co/3cgVgVn3kD', '2014-05-02', 'Dieter Hochhausen', '50181 Bedburg', 'de', '0', 3),
(462329591609061376, 'Angebotsende: Panini - Fußball WM 2014 Brasilien - 50 Sticker aus der Liste:  EUR 5,50 (5 Gebote)Ange... http://t.co/Sy3RIwAv16 @Ebay AT', '2014-05-02', 'The Deals Planet', '', 'fr', '0', 3),
(462329592993153024, 'Angebotsende: Panini - Fußball WM 2014 Brasilien - 100 verschiedene Sticker:  EUR 6,50 (3 Gebote)Ange... http://t.co/D8kYW9TnVg @Ebay AT', '2014-05-02', 'The Deals Planet', '', 'fr', '0', 3),
(462353975228891136, 'Brasilien: WM-Spielort Salvador de Bahia http://t.co/kMncKFGbil', '2014-05-03', 'overnight', 'Berlin', 'de', '0', 3),
(462356749823913984, 'Brasilien: WM-Spielort Salvador de Bahia: Deutschland bestreitet sein erstes WM-Spiel am 16. Juni in Salvador ... http://t.co/pg61lQRQER', '2014-05-03', 'overnight', 'Berlin', 'de', '0', 3),
(462356752625704960, 'Brasilien: WM-Spielort Salvador de Bahia: Deutschland bestreitet sein erstes WM-Spiel am 16. Juni in Salvador ... http://t.co/VbHiTofRiv', '2014-05-03', 'overnight-europe', 'Bärlin', 'de', '0', 3),
(462376095409795072, 'Mamma Mia is an epic movie. Pierce brosnan my man.??', '2014-05-03', 'caitlin', 'ireland', 'en', '0', 2),
(462472156375310338, 'Roy Hodgson möchte 30 Spieler zur WM 2014 mitnehmen http://t.co/BQtbCKvfGz', '2014-05-03', 'wm2014-brasilien.net', 'Deutschland', 'de', '0', 3),
(462475895886725122, 'Angebotsende: Panini - Fußball WM 2014 Brasilien - 50 Sticker aus der Liste:  EUR 4,90 (5 Gebote)Ange... http://t.co/07pUf5YSHX @Ebay AT', '2014-05-03', 'The Deals Planet', '', 'fr', '0', 3),
(462475897925165057, 'Angebotsende: Panini - Fußball WM 2014 Brasilien - 100 verschiedene Sticker:  EUR 6,05 (5 Gebote)Ange... http://t.co/etIyZyFxsX @Ebay AT', '2014-05-03', 'The Deals Planet', '', 'fr', '0', 3),
(462485553234337792, '?WM Tickets #GEWINNEN für die ?#Fussball #WM in Brasilien! HIER KLICKEN! ? http://t.co/CnqrjDzwh6', '2014-05-03', 'Handyverträge', 'Deutschland', 'de', '0', 3),
(462496793813848064, 'Wiechmanns WM-Kolumne: Deutschlands WM-Quartier ist weiter eine Baustelle: In Brasilien gibt es vor der WM noch... http://t.co/JfNUfurREI', '2014-05-03', 'stern.de Sport', 'Hamburg', 'de', '0', 3),
(462496801200025600, 'Wiechmanns WM-Kolumne: Deutschlands WM-Quartier ist weiter eine Baustelle: In Brasilien gibt es vor der WM noch... http://t.co/pxVtwwu5Dd', '2014-05-03', 'stern.de Feed', 'Hamburg', 'de', '0', 3),
(462500646768623616, 'Gänsehaut in Brasilien??WM Tickets #GEWINNEN für die ?#Fussball #WM in Brasilien! HIER KLICKEN! ? http://t.co/5K3qRsMA83', '2014-05-03', '?Fussball Bundesliga', 'D-Nürnberg', 'de', '0', 3),
(462508200177053696, '#Sport ? Wiechmanns WM-Kolumne: Deutschlands WM-Quartier ist weiter eine Baustelle: In Brasilien gibt es vor d... http://t.co/TuFwf8S8To', '2014-05-03', 'Kazi Media Germany?', 'Ü.T: 52.538779,13.407211', 'fr', '0', 3),
(462515731264176128, 'Für 2 Personen ''GEWINNEN`??WM Tickets #GEWINNEN für die ?#Fussball #WM in Brasilien! HIER KLICKEN! ? http://t.co/13zjDaxA8E', '2014-05-03', 'Geschenkideen 2013', 'D-Nürnberg', 'de', '0', 3),
(462524316601839617, 'Nur noch 40 Tage bis zur WM 2014! Wir haben dies einmal zum Anlass genommen und fünf Fußballexperten um ihre... http://t.co/mptoHiJkow', '2014-05-03', 'WM 2014', 'Deutschland', 'de', '0', 3),
(462525406990827520, '#WM2014 Blogger Umfrage über Kader, Titelchancen & Jogi mit @5freundeabseits @stylekicker @zweierkette @eckesocrates http://t.co/Eci4CeGYgr', '2014-05-03', 'WM 2014', 'Deutschland', 'de', '0', 3),
(462526259788935169, '#Spielplan vs. #Schichtplan: Fußball legt Chemiebetriebe zur #wm2014 in Brasilien nicht lahm Mitteldeutsche Zeitung http://t.co/YxWMmDBfiR', '2014-05-03', 'mz-web.de', 'Halle (Saale)', 'de', '0', 3),
(462529550753488896, 'RT @wm2014brasilien: #WM2014 Blogger Umfrage über Kader, Titelchancen & Jogi mit @5freundeabseits @stylekicker @zweierkette @eckesocrates h?', '2014-05-03', '5 Freunde im Abseits', 'Düsseldorf', 'de', '0', 3),
(462530792741412864, 'Tickets für Deutschlandspiel #gewinnen??WM Tickets #GEWINNEN für die ?#Fussball #WM in Brasilien! HIER KLICKEN! ? http://t.co/sp9Vw4Rnwz', '2014-05-03', 'Gewinnspiele GRATIS', 'Nürnberg', 'de', '0', 3),
(462531630939136000, 'WM 2014 Umfrage: Wir haben fünf Fußball-Experten gefragt? http://t.co/XJKXZINMfo', '2014-05-03', 'WM 2014', 'Deutschland', 'de', '0', 3),
(462532565513940992, 'Re: WM 2014 Brasilien http://t.co/7e6ctXhQt7', '2014-05-03', 'Brasilienfreunde', '', 'de', '0', 3),
(462532802844434432, '#mz: WM 2014 in Brasilien - Fußball legt Chemie nicht lahm http://t.co/XvFeH9Lr7N #okru', '2014-05-03', 'Okru News #10', 'Addrup', 'de', '0', 3),
(462532996139323392, '@DaveIt1985 2009 hatte ich die Eingebung, daß Dtl 2014 Weltmeister wird. Habe zu dem Thema auch ne Umfrage gestartet: http://t.co/Eci4CeGYgr', '2014-05-03', 'WM 2014', 'Deutschland', 'de', '0', 3),
(462534685311373312, 'Da dann votet mal fleißig mit. Wer wird bei der #WM2014 Weltmeister? @wm2014brasilien @DFB_Team @FIFAWorldCup http://t.co/3oA9FXlx9J', '2014-05-03', 'MovieFreak Dave', 'Kiel-Germany', 'de', '0', 3),
(462535399081250816, 'RT @DaveIt1985: Da dann votet mal fleißig mit. Wer wird bei der #WM2014 Weltmeister? @wm2014brasilien @DFB_Team @FIFAWorldCup http://t.co/3?', '2014-05-03', 'WM 2014', 'Deutschland', 'de', '0', 3),
(462537099187470336, '#Geld #verdienen WM 2014 in Brasilien - Fußball legt Chemie nicht lahm: Die großen Firmen in Schkopau und Leun...  http://t.co/wklU6zeljM', '2014-05-03', '?Fussball Bundesliga', 'D-Nürnberg', 'de', '0', 3),
(462538348545200128, 'RT @DaveIt1985: Da dann votet mal fleißig mit. Wer wird bei der #WM2014 Weltmeister? @wm2014brasilien @DFB_Team @FIFAWorldCup http://t.co/3?', '2014-05-03', 'Andrea Hirter', 'Kanton Bern', 'de', '0', 3),
(462545937337167872, 'Live vor Ort dabei sein??WM Tickets #GEWINNEN für die ?#Fussball #WM in Brasilien! HIER KLICKEN! ? http://t.co/8KHEuFv3Ec', '2014-05-03', 'Modeshop', 'Nürnberg', 'de', '0', 3),
(462558754832392192, 'RT @spox: "Ich habe so viel durchgemacht" - @LGustavo_22 im Exklusiv-Interview: http://t.co/Usk487E9RS http://t.co/j1vXwCZTPB', '2014-05-03', 'Michael Alexandrovic', '', 'de', '0', 3),
(462561039465578496, 'Besser als vor der Glotze zu Hause??WM Tickets #GEWINNEN für die ?#Fussball #WM in Brasilien! HIER KLICKEN! ? http://t.co/cdw4o1QJgl', '2014-05-03', 'KfW Studienkredit?', 'Nürnberg', 'de', '0', 3),
(462566364889509888, 'Wiechmanns WM-Kolumne: Deutschlands WM-Quartier ist weiter eine Baustelle In Brasilien gib http://t.co/u5TkVMpi6y http://t.co/RUKheN7XrE', '2014-05-03', 'Inffox.com', 'Deutschland', 'de', '0', 3),
(462575792757563392, 'World Cup in Brazil - etwas für uns Mädels: Noch 40 Tage, dann beginnt die WM in Brasilien. Auch wenn ich abso... http://t.co/fIqy4pv69J', '2014-05-03', 'Coco Colo', '', 'de', '0', 3),
(462576119498412032, 'Inklusive Flug und Übernachtung!?WM Tickets #GEWINNEN für die ?#Fussball #WM in Brasilien! HIER KLICKEN! ? http://t.co/emHnC64VJY', '2014-05-03', 'Urlaubsschnäppchen', 'Nürnberg', 'de', '0', 3),
(462577686812954626, 'No matter how hard I try, I can''t forgive Pierce Brosnan for Mamma Mia. #MusicalsAreNotSexy', '2014-05-03', 'Sarah Haertl', 'Tulsa, OK', 'en', '0', 2),
(462591204736380928, 'Alternativ FAN PAKETE #GEWINNEN??WM Tickets #GEWINNEN für die ?#Fussball #WM in Brasilien! HIER KLICKEN! ? http://t.co/pleFHEvupP', '2014-05-03', 'Firsthandy Webradio', 'Nürnberg, Deutschland', 'de', '0', 3),
(462591426979979264, 'WM 2014 in Brasilien: Fußball legt Chemie nicht lahm http://t.co/l5kJl1XeTv', '2014-05-03', 'Marcel Voigt', '', 'de', '0', 3),
(462603048699703296, 'Schwere Randale im WM-Land Brasilien: Fan mit Kloschüssel erschlagen - Fussball - Bild.de http://t.co/bMozcfvnru', '2014-05-03', 'Eugene Elkin', '', 'en', '0', 3),
(462604030061985792, 'Schock im WM-Land - Randale! Fan mit Kloschüssel erschlagen:  40 Tage vor der WM kam es in Brasilien erneut zu... http://t.co/DA9WUcc1rd', '2014-05-03', 'RSS Sammeldienst', '', 'de', '0', 3),
(462606364372897792, 'Zum Gruppenspiel mit deutscher Beteiligung??WM Tickets #GEWINNEN für die ?#Fussball #WM in Brasilien! HIER KLICKEN! ? http://t.co/CnqrjDzwh6', '2014-05-03', 'Handyverträge', 'Deutschland', 'de', '0', 3),
(462618293656760320, 'Schock im WM-Land - Randale! Fan mit Kloschüssel erschlagen: \n\n40 Tage vor der WM kam es in Brasilien erneut... http://t.co/IzLYRPj4ge', '2014-05-03', 'Fränki läuft', '', 'de', '0', 3),
(462621395500158976, 'Männerherzen schlagen höher??WM Tickets #GEWINNEN für die ?#Fussball #WM in Brasilien! HIER KLICKEN! ? http://t.co/5K3qRsMA83', '2014-05-03', '?Fussball Bundesliga', 'D-Nürnberg', 'de', '0', 3),
(462636524744769536, 'Ein #GESCHENK für Fussballfans??WM Tickets #GEWINNEN für die ?#Fussball #WM in Brasilien! HIER KLICKEN! ? http://t.co/13zjDaxA8E', '2014-05-03', 'Geschenkideen 2013', 'D-Nürnberg', 'de', '0', 3),
(462637497923559424, 'Schwere Randale im WM-Land Brasilien: Fan mit Kloschüssel erschlagen - Fussball - Bild.de http://t.co/eBvkmziRMk', '2014-05-03', 'Eduard Blossfeld', '', 'de', '0', 3),
(462643613701509120, '@Shaggy_F1 No me gusta, es más, odio tanto a esa mierda que obligaría a Spielberg a escuchar la mar está fresquíbiris 789 veces.', '2014-05-03', 'Juan Sánchez', 'Badajoz', 'en', '0', 1),
(462648118476288000, '@juansdf1 juan... Spielberg no tiene nada que ver en esas pelis', '2014-05-03', 'Jordi Talens #F1', 'Valencia', 'es', '0', 1),
(462651589715849216, '#Gratis dabei sein? Mitmachen??WM Tickets #GEWINNEN für die ?#Fussball #WM in Brasilien! HIER KLICKEN! ? http://t.co/8KHEuFv3Ec', '2014-05-03', 'Modeshop', 'Nürnberg', 'de', '0', 3),
(462652167044608001, 'RT @wm2014brasilien: #WM2014 Blogger Umfrage über Kader, Titelchancen & Jogi mit @5freundeabseits @stylekicker @zweierkette @eckesocrates h?', '2014-05-03', 'ecke:sócrates', 'São Paulo/Belo H/Porto A. /Rio', 'de', '0', 3),
(462652597808021504, 'RT @wm2014brasilien: #WM2014 Blogger Umfrage über Kader, Titelchancen & Jogi mit @5freundeabseits @stylekicker @zweierkette @eckesocrates h?', '2014-05-03', 'Tobias Zwior', 'Leipzig', 'de', '0', 3),
(462666702707494913, '#Kostenlose Gewinnchance nutzen? ?WM Tickets #GEWINNEN für die ?#Fussball #WM in Brasilien! HIER KLICKEN! ? http://t.co/pleFHEvupP', '2014-05-03', 'Firsthandy Webradio', 'Nürnberg, Deutschland', 'de', '0', 3),
(462675358492274688, 'WM 2014 Umfrage - und Tery wird im Intro als Experte bezeichnet... :-O http://t.co/PGcAaSt1PG via @wm2014brasilien', '2014-05-03', 'Zweierkette', 'Fußballblogosphäre', 'de', '0', 3),
(462681839619293186, 'Mit Glück #gratis zur WM hier??WM Tickets #GEWINNEN für die ?#Fussball #WM in Brasilien! HIER KLICKEN! ? http://t.co/CnqrjDzwh6', '2014-05-03', 'Handyverträge', 'Deutschland', 'de', '0', 3),
(462691752676438016, 'Spielplan WM 2014 - gratis für Outlook, Handy, iPhone | Spielplan Bundesliga 13/14 + #WM2014 http://t.co/QhwfpudCSt', '2014-05-03', 'Sebastian S.', 'Hildesheim, Germany', 'de', '0', 3),
(462693817003417600, 'Vergleichen lohnt sich, auch bei der WM 2014 http://t.co/nteXLTi6gk via @wm2014brazil', '2014-05-03', '#bit #cas #firemind', 'NRW', 'de', '0', 3),
(462696907228577792, 'Das macht viel #Fun im Jahr 2014??WM Tickets #GEWINNEN für die ?#Fussball #WM in Brasilien! HIER KLICKEN! ? http://t.co/5K3qRsMA83', '2014-05-03', '?Fussball Bundesliga', 'D-Nürnberg', 'de', '0', 3),
(462712103561084928, 'Ab sofort dabei sein beim #GEWINNSPIEL??WM Tickets #GEWINNEN für die ?#Fussball #WM in Brasilien! HIER KLICKEN! ? http://t.co/13zjDaxA8E', '2014-05-03', 'Geschenkideen 2013', 'D-Nürnberg', 'de', '0', 3),
(462851348254687232, 'Extra zur Fußball WM 2014 der neue Reiseführer von Marco Polo\nReisefüher Brasilien und Rio de Janeiro\nhttp://t.co/YOwJ3y62FF', '2014-05-04', 'fremdsprachelernen24', 'Brandenburg', 'de', '0', 3),
(462866865434275841, 'Re: WM 2014 Brasilien http://t.co/c7C1a4p0Xq', '2014-05-04', 'Brasilienfreunde', '', 'de', '0', 3),
(462868285554307073, 'Final-Tickets für die WM 2014 werden für 30.000 Euro verkauft http://t.co/vFteIAW9Mn', '2014-05-04', 'wm2014-brasilien.net', 'Deutschland', 'de', '0', 3),
(462891171271168000, 'WM 2014 Umfrage: Wir haben fünf Fußball-Experten gefragt? http://t.co/YY329rd5cp', '2014-05-04', 'WM 2014', 'Deutschland', 'de', '0', 3),
(462928387443392512, 'Habe mir gerade den Spielplan für die WM 2014 in Brasilien ausgedruckt, und für die Eishockey WM in Weißrussland abgespeichert.', '2014-05-04', 'Martin Bartsch', 'Wanzleben', 'de', '0', 3),
(462930095880298496, 'Ancora 48 giorni - Gran Premio d''Austria F1/Red Bull Ring/ Spielberg http://t.co/Gq4LTgX91X', '2014-05-04', 'Kurt-Peter Jermann', 'Knittelfeld', 'de', '0', 1),
(462935649365291008, ':: Brasiliens dunkle Seite: Unbekannte Fakten zur Fußball-WM\n+ 04.05.2014 + In 39 Tagen beginnt in Brasilien die... http://t.co/9e91PEmZv0', '2014-05-04', 'Franz Alt', 'Germany - Baden-Baden', 'de', '0', 3),
(462936108846682112, 'Es wird Zeit den WM Spielplan in den Kalender zu importieren. Nicht, dass man die falsche Einladung annimmt ;) http://t.co/SPVzk3JeIZ', '2014-05-04', 'David Gohla', 'Hamburg', 'de', '0', 3),
(462960274447015936, 'RT @franzalt: :: Brasiliens dunkle Seite: Unbekannte Fakten zur Fußball-WM\n+ 04.05.2014 + In 39 Tagen beginnt in Brasilien die... http://t.?', '2014-05-04', 'ödp Würzburg', 'Würzburg', 'de', '0', 3),
(462960738017898496, 'RT @franzalt: :: Brasiliens dunkle Seite: Unbekannte Fakten zur Fußball-WM\n+ 04.05.2014 + In 39 Tagen beginnt in Brasilien die... http://t.?', '2014-05-04', 'Marcus Eschborn', '', 'de', '0', 3),
(462961597313724416, 'RT @franzalt: :: Brasiliens dunkle Seite: Unbekannte Fakten zur Fußball-WM\n+ 04.05.2014 + In 39 Tagen beginnt in Brasilien die... http://t.?', '2014-05-04', 'Georg Grund', 'Erde', 'de', '0', 3),
(462968600673153025, 'Pues yo tenía mono de Pierce Brosnan e iba a poner una peli suya\npero he encendido la tele y estaba Mamma Mía\nque no es que me guste pero xd', '2014-05-04', '', 'a dos meses de ti', 'es', '0', 2),
(462971063656529920, 'Ver a Pierce Brosnan cantando en Mamma mia! es como ver a Hugh Laurie aplicandose cremitas para las arrugas.', '2014-05-04', 'Karloff Esa-Gótica', '¿Salamanca? ', 'es', '0', 2),
(462974409075339265, 'http://t.co/QQIqawfak7 mamma mia pierce brosnan interview', '2014-05-04', '???? ???????', '', 'ru', '0', 2),
(462988441014509568, 'wegen der fussball-WM hat #SaoPaulo die Parada Gay vorverlegt. 2013 wurden in #Brasilien 312 #LGBT personen ermordet http://t.co/aj6NFKOIEY', '2014-05-04', 'ulla ebner', 'rio de janeiro', 'de', '0', 3),
(462988547226886144, 'RT @ullaebner: wegen der fussball-WM hat #SaoPaulo die Parada Gay vorverlegt. 2013 wurden in #Brasilien 312 #LGBT personen ermordet http://?', '2014-05-04', 'matahari_klon', 'here and there and anywhere', 'en', '0', 3);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `tweet_for_analysis`
--

DROP TABLE IF EXISTS `tweet_for_analysis`;
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
