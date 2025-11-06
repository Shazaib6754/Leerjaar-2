-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 06 nov 2025 om 14:50
-- Serverversie: 10.4.32-MariaDB
-- PHP-versie: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `film`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `acteur`
--

CREATE TABLE `acteur` (
  `id` int(11) NOT NULL,
  `naam` varchar(255) NOT NULL,
  `geboortedatum` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `acteur`
--

INSERT INTO `acteur` (`id`, `naam`, `geboortedatum`) VALUES
(1, 'jake kloor', NULL);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `film`
--

CREATE TABLE `film` (
  `id` int(11) NOT NULL,
  `titel` varchar(255) NOT NULL,
  `genre` varchar(100) NOT NULL,
  `beschrijving` text DEFAULT NULL,
  `release_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `film`
--

INSERT INTO `film` (`id`, `titel`, `genre`, `beschrijving`, `release_date`) VALUES
(1, 'fast furious', '3', NULL, NULL);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `film_acteur`
--

CREATE TABLE `film_acteur` (
  `id` int(11) NOT NULL,
  `film_id` int(11) NOT NULL,
  `acteur_id` int(11) NOT NULL,
  `rolnaam` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `film_acteur`
--

INSERT INTO `film_acteur` (`id`, `film_id`, `acteur_id`, `rolnaam`) VALUES
(1, 1, 1, NULL);

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `acteur`
--
ALTER TABLE `acteur`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `film`
--
ALTER TABLE `film`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `film_acteur`
--
ALTER TABLE `film_acteur`
  ADD PRIMARY KEY (`id`),
  ADD KEY `film_id` (`film_id`),
  ADD KEY `acteur_id` (`acteur_id`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `acteur`
--
ALTER TABLE `acteur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT voor een tabel `film`
--
ALTER TABLE `film`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT voor een tabel `film_acteur`
--
ALTER TABLE `film_acteur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Beperkingen voor geëxporteerde tabellen
--

--
-- Beperkingen voor tabel `film_acteur`
--
ALTER TABLE `film_acteur`
  ADD CONSTRAINT `film_acteur_ibfk_1` FOREIGN KEY (`film_id`) REFERENCES `film` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `film_acteur_ibfk_2` FOREIGN KEY (`acteur_id`) REFERENCES `acteur` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
