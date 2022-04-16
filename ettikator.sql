-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 16. Apr 2022 um 22:38
-- Server-Version: 10.4.21-MariaDB
-- PHP-Version: 8.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `ettikator`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `adress`
--

CREATE TABLE `adress` (
  `ID` int(11) NOT NULL,
  `adress_key` int(11) NOT NULL,
  `vorname` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nachname` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `strasse` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `plz` varchar(4) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ort` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bemerkungen` varchar(1000) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Daten für Tabelle `adress`
--

INSERT INTO `adress` (`ID`, `adress_key`, `vorname`, `nachname`, `strasse`, `plz`, `ort`, `bemerkungen`) VALUES
(8, 1, 'Sven', 'Kamm', 'Im Rank 2', '5333', 'Baldingen', '');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `users`
--

CREATE TABLE `users` (
  `users_id` int(11) NOT NULL,
  `users_uid` tinytext COLLATE utf8mb4_unicode_ci NOT NULL,
  `users_pwd` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `users_email` tinytext COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Daten für Tabelle `users`
--

INSERT INTO `users` (`users_id`, `users_uid`, `users_pwd`, `users_email`) VALUES
(1, 'Svendolin', '$2y$10$Cez5vZG4d9A6KetqjgEZ6OlNog33je66nyzqhFQ3ipUsf.dcwHt/e', 'sven0815@gmx.ch'),
(2, 'Maxmuster', '$2y$10$gmPJ3sY4mKkM3CvUDvDm4uXULqM.SUjZi8IMCAsHf5Kk19UOD/2GO', 'max.muster@gmx.ch');

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `adress`
--
ALTER TABLE `adress`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `users_id` (`adress_key`);

--
-- Indizes für die Tabelle `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`users_id`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `adress`
--
ALTER TABLE `adress`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT für Tabelle `users`
--
ALTER TABLE `users`
  MODIFY `users_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
