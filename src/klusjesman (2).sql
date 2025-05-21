-- phpMyAdmin SQL Dump
-- version 5.1.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 20 mei 2025 om 11:27
-- Serverversie: 5.7.17
-- PHP-versie: 8.2.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `klusjesman`
--
CREATE DATABASE IF NOT EXISTS `klusjesman` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `klusjesman`;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `klanten`
--

CREATE TABLE `klanten` (
  `klantId` int(11) NOT NULL,
  `klant` varchar(50) NOT NULL,
  `adres` varchar(50) NOT NULL,
  `telefoonnummer` varchar(50) NOT NULL,
  `e-mailadres` varchar(100) NOT NULL,
  `opmerking` varchar(250) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `klanten`
--

INSERT INTO `klanten` (`klantId`, `klant`, `adres`, `telefoonnummer`, `e-mailadres`, `opmerking`) VALUES
(6, 'Lucas Bussink', 'Zeskamp 1', '06-29096148', 'lucas.bussink@student.graafschapcollege.nl', ''),
(9, 'Martijn van Boven', 'kalverstraat 69420', '0611enderestkomtvanzelf', 'martijn@email.com', '');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `klant_adressen`
--

CREATE TABLE `klant_adressen` (
  `adresId` int(11) NOT NULL,
  `klantId` int(11) NOT NULL,
  `adres` text NOT NULL,
  `actief` tinyint(1) NOT NULL,
  `datumToegevoegd` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `klusdetails`
--

CREATE TABLE `klusdetails` (
  `KlusId` int(10) NOT NULL,
  `klant` varchar(100) DEFAULT NULL,
  `Klus` varchar(100) DEFAULT NULL,
  `DetailsKlus` varchar(250) DEFAULT NULL,
  `klantId` int(100) DEFAULT NULL,
  `urenGewerkt` float(50,2) DEFAULT NULL,
  `totaalBedrag` float(65,2) DEFAULT NULL,
  `uurTarief` float(15,2) DEFAULT NULL,
  `voorrijkosten` float(20,2) DEFAULT NULL,
  `Betaald` tinyint(1) NOT NULL,
  `adresId` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `klusdetails`
--

INSERT INTO `klusdetails` (`KlusId`, `klant`, `Klus`, `DetailsKlus`, `klantId`, `urenGewerkt`, `totaalBedrag`, `uurTarief`, `voorrijkosten`, `Betaald`, `adresId`) VALUES
(30, 'Lucas Bussink', 'Pizzaoven gebouw', 'mooie pizzaoven met echte stenen', 6, 5.00, 106.00, 14.00, 36.00, 0, NULL);

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `klanten`
--
ALTER TABLE `klanten`
  ADD PRIMARY KEY (`klantId`);

--
-- Indexen voor tabel `klant_adressen`
--
ALTER TABLE `klant_adressen`
  ADD PRIMARY KEY (`adresId`);

--
-- Indexen voor tabel `klusdetails`
--
ALTER TABLE `klusdetails`
  ADD PRIMARY KEY (`KlusId`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `klanten`
--
ALTER TABLE `klanten`
  MODIFY `klantId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT voor een tabel `klant_adressen`
--
ALTER TABLE `klant_adressen`
  MODIFY `adresId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `klusdetails`
--
ALTER TABLE `klusdetails`
  MODIFY `KlusId` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
