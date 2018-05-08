-- phpMyAdmin SQL Dump
-- version 4.1.7
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mag 08, 2018 alle 10:23
-- Versione del server: 5.6.33-log
-- PHP Version: 5.3.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `my_trylevisurveys`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `codici`
--

CREATE TABLE IF NOT EXISTS `codici` (
  `codice` varchar(32) NOT NULL,
  `questionario` int(11) NOT NULL,
  `fatto` tinyint(1) NOT NULL,
  PRIMARY KEY (`codice`),
  KEY `questionario` (`questionario`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `codici`
--

INSERT INTO `codici` (`codice`, `questionario`, `fatto`) VALUES
('42f55652c2177b77fbc8826ddc9d4e2c', 45, 1),
('e71366ec11b3b84077a2f77215417bc4', 45, 1),
('3c89f71052cb09262c4844ffc6141819', 36, 1),
('9850160c46d12ec1394bd32360008186', 40, 1),
('836b7b4a9cdb46ab4f81f41de68a9ce6', 44, 1),
('c53b074785049ec8829160807d745f66', 44, 1);

-- --------------------------------------------------------

--
-- Struttura della tabella `domande`
--

CREATE TABLE IF NOT EXISTS `domande` (
  `id_domanda` int(11) NOT NULL AUTO_INCREMENT,
  `testo_domanda` text NOT NULL,
  `modalita` varchar(3) NOT NULL,
  `questionario` int(11) NOT NULL,
  `piu_risposte` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_domanda`),
  KEY `questionario` (`questionario`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=81 ;

--
-- Dump dei dati per la tabella `domande`
--

INSERT INTO `domande` (`id_domanda`, `testo_domanda`, `modalita`, `questionario`, `piu_risposte`) VALUES
(75, 'Come si chiama lui?', 'S/N', 45, 0),
(74, 'Quali materie ti risultano di piÃ¹ difficile comprensione?', 'M', 44, 0),
(73, 'Frequenti gli sportelli didattici che la scuola propone?', 'S/N', 44, 0),
(77, 'XGFH', 'M', 46, 0),
(59, 'Quanti sono gli AC/DC?', 'M', 36, 0),
(60, 'In che anno hanno pubblicato il loro primo album?', 'M', 36, 0),
(61, 'Ti piacciono?', 'S/N', 36, 0),
(76, 'cIAO', 'S/N', 46, 0),
(66, 'Ti piace?', 'M', 40, 0),
(72, 'Che classe frequenti?', 'M', 44, 0),
(78, 'we', 'M', 48, 1),
(79, 'wefq', 'S/N', 48, 1),
(80, 'ew', 'S/N', 48, 1);

-- --------------------------------------------------------

--
-- Struttura della tabella `pm`
--

CREATE TABLE IF NOT EXISTS `pm` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `user1` varchar(255) NOT NULL,
  `user2` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `timestamp` varchar(255) NOT NULL,
  `user2read` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user2` (`user2`),
  KEY `user1` (`user1`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Dump dei dati per la tabella `pm`
--

INSERT INTO `pm` (`id`, `title`, `user1`, `user2`, `message`, `timestamp`, `user2read`) VALUES
(7, 'agdb', 'admin', 'steve97', 'zdgn', 'Sun, 12 Jun 2016 17:07:33 +0200', 1),
(8, 'whtr', 'steve97', 'admin', 'sftgh', 'Sun, 12 Jun 2016 17:32:10 +0200', 1),
(13, 'ahgrth', 'Steve1997', 'Steve1997', 'rthj', 'Mon, 04 Jul 2016 20:46:26 +0200', 1),
(14, 'Ciao', 'Lety01', 'Steve', 'Ciao', 'Mon, 04 Jul 2016 21:17:21 +0200', 1),
(15, 'Re: ciao', 'Steve', 'Lety01', 'Ciao', 'Mon, 04 Jul 2016 21:18:17 +0200', 1),
(16, 'Ciao', 'Lety01', 'anna97', 'Ciao', 'Mon, 04 Jul 2016 21:24:13 +0200', 1);

-- --------------------------------------------------------

--
-- Struttura della tabella `questionario`
--

CREATE TABLE IF NOT EXISTS `questionario` (
  `id_questionario` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `descrizione` text NOT NULL,
  `data_creazione` date NOT NULL,
  `data_scadenza` date NOT NULL,
  `creatore` varchar(255) NOT NULL,
  PRIMARY KEY (`id_questionario`),
  KEY `creatore` (`creatore`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=49 ;

--
-- Dump dei dati per la tabella `questionario`
--

INSERT INTO `questionario` (`id_questionario`, `nome`, `descrizione`, `data_creazione`, `data_scadenza`, `creatore`) VALUES
(45, 'Ghj', 'Ygh', '2016-08-04', '2017-01-11', 'admin'),
(46, 'rwg', 'RWG', '2016-08-26', '2017-01-11', 'admin'),
(47, 'ciao', '135', '2017-12-27', '2019-12-01', ''),
(36, 'AC/DC', 'piccolo sondaggio sulla nota band australiana', '2016-06-19', '2017-01-11', 'admin'),
(40, 'Pinocchio', 'liu', '2016-07-04', '2017-10-11', 'Carlo'),
(44, 'SPORTELLI DIDATTICI', 'Sono utili gli sportelli didattici? Chi usufruisce di questo servizio? In che modo?', '2016-07-06', '2017-11-01', 'admin'),
(48, 'sticazzi', 'rwdghd', '2018-05-08', '2018-11-09', '');

-- --------------------------------------------------------

--
-- Struttura della tabella `risposte_date`
--

CREATE TABLE IF NOT EXISTS `risposte_date` (
  `codice` varchar(32) NOT NULL,
  `risposta` int(11) NOT NULL,
  PRIMARY KEY (`codice`,`risposta`),
  KEY `risposta` (`risposta`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `risposte_date`
--

INSERT INTO `risposte_date` (`codice`, `risposta`) VALUES
('3c89f71052cb09262c4844ffc6141819', 80),
('3c89f71052cb09262c4844ffc6141819', 83),
('3c89f71052cb09262c4844ffc6141819', 86),
('42f55652c2177b77fbc8826ddc9d4e2c', 123),
('836b7b4a9cdb46ab4f81f41de68a9ce6', 115),
('836b7b4a9cdb46ab4f81f41de68a9ce6', 117),
('836b7b4a9cdb46ab4f81f41de68a9ce6', 118),
('9850160c46d12ec1394bd32360008186', 99),
('c53b074785049ec8829160807d745f66', 114),
('c53b074785049ec8829160807d745f66', 117),
('c53b074785049ec8829160807d745f66', 120),
('e71366ec11b3b84077a2f77215417bc4', 123);

-- --------------------------------------------------------

--
-- Struttura della tabella `risposte_possibili`
--

CREATE TABLE IF NOT EXISTS `risposte_possibili` (
  `id_risposta` int(11) NOT NULL AUTO_INCREMENT,
  `testo_risposta` text NOT NULL,
  `domanda` int(11) NOT NULL,
  PRIMARY KEY (`id_risposta`),
  KEY `domanda` (`domanda`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=135 ;

--
-- Dump dei dati per la tabella `risposte_possibili`
--

INSERT INTO `risposte_possibili` (`id_risposta`, `testo_risposta`, `domanda`) VALUES
(120, 'Inglese', 74),
(119, 'Fisica', 74),
(118, 'Matematica', 74),
(117, 'NO', 73),
(116, 'SI', 73),
(115, '5^ superiore', 72),
(83, '1973', 60),
(114, '4^ superiore', 72),
(82, '4', 59),
(113, '3^ superiore', 72),
(81, '3', 59),
(80, '5', 59),
(55, 'NO', 47),
(54, 'SI', 47),
(53, 'NO', 46),
(52, 'SI', 46),
(126, 'NO', 76),
(84, '1981', 60),
(85, '1990', 60),
(86, 'SI', 61),
(87, 'NO', 61),
(125, 'SI', 76),
(124, 'NO', 75),
(123, 'SI', 75),
(122, 'Latino', 74),
(121, 'Greco', 74),
(99, 'Ciao', 66),
(112, '2^ superiore', 72),
(111, '1^ superiore', 72),
(127, 'SFTH', 77),
(128, 'SRTH', 77),
(129, 'ef', 78),
(130, 'f', 78),
(131, 'SI', 79),
(132, 'NO', 79),
(133, 'SI', 80),
(134, 'NO', 80);

-- --------------------------------------------------------

--
-- Struttura della tabella `utenti`
--

CREATE TABLE IF NOT EXISTS `utenti` (
  `username` varchar(255) NOT NULL,
  `Nome` varchar(255) NOT NULL,
  `Cognome` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(32) NOT NULL,
  `salt` varchar(6) NOT NULL,
  PRIMARY KEY (`username`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `utenti`
--

INSERT INTO `utenti` (`username`, `Nome`, `Cognome`, `email`, `password`, `salt`) VALUES
('Steve1997', 'Stefano', 'Sello', 'sellostefano@live.it', 'b6d2f141277bd995e7bcf9bac405d3fe', '000000'),
('Steve', 'Stefano', 'Sello', 'sellostefano@gmail.com', '4cbf651928e58ac9f9a89eeeb9ecb918', 'W'),
('DZ191', 'Daniel', 'Nastase', 'na.da52@yahoo.it', 'ca7da00cab3da36d180b68b5665a4bbe', '000000'),
('anna97', 'Anna', 'Bortolamiol', 'bortolamiol.anna@libero.it', '0bd162ea315e85cb53dd197ac20dcd75', '0'),
('Root', 'Root', 'Root', 'root@root.com', '74315e3d4ca1abcb2fe96bc56a7e27ce', 'h'),
('Carlo', 'Carlo', 'Collodi', 'carlocollodi@gmail.com', '84ca29631640ef84e9e562c0fe2f5bc4', 'k'),
('Lety01', 'Letizia', 'Sello', 'selloletizia@gmail.com', '0f8bda1abaa4a25adc55c5e68ed5a132', 'e'),
('admin', 'Admin', 'Admin', 'admin@admin.com', '8b31f5499f68310b7889698fac03790d', 'y'),
('Steve97', 'Stefano', 'Sello', 'sellostefano@gmail.com', '8044bd0be4105fcc8aec3558f905ca2a', 'd');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
