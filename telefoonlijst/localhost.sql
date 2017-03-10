-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Machine: 127.0.0.1
-- Gegenereerd op: 30 jun 2015 om 14:10
-- Serverversie: 5.6.17
-- PHP-versie: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Databank: `telefoonlijst`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `afdelingen`
--

CREATE TABLE IF NOT EXISTS `afdelingen` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `naam` varchar(100) CHARACTER SET utf8 NOT NULL,
  `afkorting` varchar(10) CHARACTER SET utf8 NOT NULL,
  `omschrijving` text CHARACTER SET utf8 NOT NULL,
  `foto` varchar(40) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `naam` (`naam`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Gegevens worden geëxporteerd voor tabel `afdelingen`
--

INSERT INTO `afdelingen` (`id`, `naam`, `afkorting`, `omschrijving`, `foto`) VALUES
(1, 'Applicatieontwikkeling', 'ao', 'Deze afdeling geeft les aan studenten die het vak van applicatieontwikkelaar willen gaan uitoefenen. De opleiding is momenteel 3 jarig waarvan 2 jaar intern en 1 jaar extern op stage. Gedurende de opleiding leren de studenten de beginselen van het gestructureerd programmeren in de talen HTML5/javaScript, java en PHP/MySQL.\r\nUiteindelijk zijn zij in staat om applicaties zoals webwinkels te bouwen en te onderhouden. ', 'ao.jpg'),
(2, 'ICT-Beheer', 'ib', 'De afdeling geeft les aan studenten op diverse niveaus, die allen 3 jarig zijn. Studenten krijgen kennis van onderhoud van computersystemen, het onderhouden en inrichten van rechtenstructuren in bedrijfsnetwerken en kunnen zo een netwerk opzetten en onderhouden. Kennis van CISCO wordt aangebracht.', 'ictbeheer.jpg');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `contacten`
--

CREATE TABLE IF NOT EXISTS `contacten` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `gebruikersnaam` varchar(30) CHARACTER SET utf8 NOT NULL,
  `wachtwoord` varchar(30) CHARACTER SET utf8 NOT NULL,
  `voorletter` varchar(3) CHARACTER SET utf8 NOT NULL,
  `tussenvoegsel` varchar(20) CHARACTER SET utf8 NOT NULL,
  `achternaam` varchar(30) CHARACTER SET utf8 NOT NULL,
  `extern` varchar(30) CHARACTER SET utf8 NOT NULL,
  `intern` varchar(15) CHARACTER SET utf8 NOT NULL,
  `email` varchar(50) CHARACTER SET utf8 NOT NULL DEFAULT 'qwerty',
  `foto` varchar(40) CHARACTER SET utf8 NOT NULL DEFAULT 'default.jpg',
  `recht` enum('medewerker','secretaresse','directeur') CHARACTER SET utf8 NOT NULL DEFAULT 'medewerker',
  `afdelings_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `gebruikersnaam` (`gebruikersnaam`),
  UNIQUE KEY `gebruikersnaam_2` (`gebruikersnaam`),
  KEY `afdelings_id` (`afdelings_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=36 ;

--
-- Gegevens worden geëxporteerd voor tabel `contacten`
--

INSERT INTO `contacten` (`id`, `gebruikersnaam`, `wachtwoord`, `voorletter`, `tussenvoegsel`, `achternaam`, `extern`, `intern`, `email`, `foto`, `recht`, `afdelings_id`) VALUES
(8, 'mlinden', 'qwerty', 'M', 'van der', 'Linden', '34567', '012345', 'm.van.der.linden@mondriaanict.nl', '752807eb550806b0ca715d43d3a3ba99.jpg', 'medewerker', 1),
(11, 'ahensbergen', 'qwerty', 'A', 'van', 'Hensbergen', '06-1234567', '12345', 'a.van.hensbergen@mondriaanict.nl', '62655cfb998dbe59561d2a5daa112829.jpg', 'medewerker', 1),
(12, 'hkool', 'qwerty', 'H', ' ', 'Kool', '06324324', '1234', 'h.kool@mondriaanict.nl', '5666826bf202bf8370da31f15b1a87a8.jpg', 'medewerker', 1),
(13, 'wtol', 'qwerty', 'W', 'van', 'Tol', '5678', '1234', 'w.van.tol@mondriaanict.nl', 'a95bd7ddea50a91d161db098db06d459.jpg', 'medewerker', 1),
(15, 'ahermans', 'qwerty', 'A', '', 'Hermans', '', '', 'a.hermans@mondriaanict.nl', '3991695da1bc809c1a18bf379d6c06f3.jpg', 'medewerker', 2),
(16, 'wstolk', 'qwerty', 'W', '', 'Stolk', '', '', 'w.stolk@mondriaanict.nl', '9614e80514175a1171036908165b0a9f.jpg', 'medewerker', 2),
(17, 'jjong', 'qwerty', 'J', 'de', 'Jong', '', '', 'j.de.jong@mondriaanict.nl', 'dejong.jpg', 'medewerker', 1),
(19, 'mkok', 'qwerty', 'drs', 'de', 'Kok', '', '', 'm.de.kok@mondriaanict.nl', '2896dfe237191024b39f64482f8cb6fa.jpg', 'directeur', NULL),
(20, 'cbertels', 'qwerty', 'C', '', 'Bertels', '123456789', '6789', 'c.bertels@mondriaanict.nl', '4c727ed239576fec6ba11015b9752175.jpg', 'secretaresse', NULL),
(24, 'rrosssum', 'roel', 'R', 'van', 'Rossum', '', '', 'r.van.rossum@mondriaanict.nl', '51056574893754264a36be485b2d1aec.jpg', 'medewerker', 2),
(25, 'cgijsen', 'coby', 'C', '', 'Gijsen', '', '', 'c.gijsen@mondriaanict.nl', 'c9cd18e376c22f8a16f5be48b8df5101.jpg', 'medewerker', 1),
(33, 'rbaouch', 'rachid', 'R', '', 'Baouch', '', '', 'r.baouch@mondriaanict.nl', '45e59a0bc89499d7921c05eaee9524df.jpg', 'medewerker', 1),
(34, 'bhalem', 'bart', 'B', '', 'Halem', '', '', 'b.van.halem@mondriaanict.nl', 'e0947a6f1da4496f6905c6008cbc8534.jpg', 'medewerker', 2);

--
-- Beperkingen voor geëxporteerde tabellen
--

--
-- Beperkingen voor tabel `contacten`
--
ALTER TABLE `contacten`
  ADD CONSTRAINT `afdelings_lid` FOREIGN KEY (`afdelings_id`) REFERENCES `afdelingen` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
