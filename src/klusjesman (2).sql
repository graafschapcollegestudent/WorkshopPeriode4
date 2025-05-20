-- phpMyAdmin SQL Dump
-- version 5.1.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 14 mei 2025 om 10:09
-- Serverversie: 5.7.17
-- PHP-versie: 8.3.3

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
(1, 'Lucas Bussink', 'haverkamp 1a Doetinchem', '06-12345678', 'lucas.bussink@student.graafschapcollege.nl', ''),
(3, 'Lucas Bussink', 'haverkamp 1a Doetinchem', '06-12345678', 'lucas.bussink@student.graafschapcollege.nl', '');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `klusdetails`
--

CREATE TABLE `klusdetails` (
  `KlusId` int(10) NOT NULL,
  `Klus` varchar(100) DEFAULT NULL,
  `DetailsKlus` varchar(250) DEFAULT NULL,
  `klantId` int(100) DEFAULT NULL,
  `urenGewerkt` int(100) DEFAULT NULL,
  `totaalBedrag` int(100) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `klanten`
--
ALTER TABLE `klanten`
  ADD PRIMARY KEY (`klantId`);

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
  MODIFY `klantId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT voor een tabel `klusdetails`
--
ALTER TABLE `klusdetails`
  MODIFY `KlusId` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
