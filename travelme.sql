-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Mag 22, 2023 alle 22:44
-- Versione del server: 10.4.28-MariaDB
-- Versione PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `travel.me`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `itinerary`
--

CREATE TABLE `itinerary` (
  `user_id` varchar(100) NOT NULL,
  `travel_id` int(11) NOT NULL,
  `travel` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`travel`)),
  `days` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `itinerary`
--

INSERT INTO `itinerary` (`user_id`, `travel_id`, `travel`, `days`) VALUES
('prova@prova.it', 1, '[[\"Place de la Concorde, Avenue des Champs-Élysées, Quartier des Champs-Élysées, 8th Arrondissement of Paris, Paris, Ile-de-France, Metropolitan France, 75008, France&48.86545,2.321133769295693\",\"Cathedral of Notre Dame, 6, Parvis Notre-Dame - Place Jean-Paul II, 4th Arrondissement, Paris, Quartier Les Îles, Paris, Ile-de-France, Metropolitan France, 75004, France&48.85293705,2.3500501225000026\",\"Le Moulin Rouge, 82, Boulevard de Clichy, 18th Arrondissement, Paris, Quartier des Grandes-Carrières, Paris, Ile-de-France, Metropolitan France, 75018, France&48.8840787,2.3324082\"],[\"Louvre Museum, Place du Palais Royal, 1st Arrondissement, Paris, Quartier du Palais Royal, Paris, Ile-de-France, Metropolitan France, 75001, France&48.8611473,2.33802768704666\",\"Paris Eiffel Tower, Avenue Gustave Eiffel, Gros-Caillou, 7th Arrondissement, Paris, Quartier du Gros-Caillou, Paris, Ile-de-France, Metropolitan France, 75007, France&48.8579662,2.2945015\",\"Montparnasse, 6th Arrondissement, Paris, Ile-de-France, Metropolitan France, 75006, France&48.8434755,2.3282995\"]]', 2),
('prova@prova.it', 2, '[[\"Colosseum, Piazza del Colosseo, Celio, Municipio Roma I, Rome, Roma Capitale, Lazio, 00184, Italy&41.8902614,12.493087103595503\",\"Fori Imperiali, Via dei Fori Imperiali, Campitelli, Municipio Roma I, Rome, Roma Capitale, Lazio, 00184, Italy&41.893565,12.4863624\"],[\"Piazza Navona, Via di SantAgnese in Agone, Parione, Municipio Roma I, Rome, Roma Capitale, Lazio, 00186, Italy&41.8989155,12.473118536497108\"],[\"Vatican Museums, Viale della Zitella, Vatican City, 00120, Vatican City&41.906233900000004,12.452732811606328\"]]', 3),
('ale@prova.it', 3, '[[\"New York, United States&40.7127281,-74.0060152\",\"Statue of Liberty, Flagpole Plaza, Manhattan Community Board 1, Manhattan, New York County, New York, 10004, United States&40.689253199999996,-74.04454817144321\"],[\"Manhattan, New York County, New York, United States&40.7896239,-73.9598939\",\"The Bronx, New York, United States&40.8466508,-73.8785937\"]]', 2),
('ale@prova.it', 4, '[[\"Piazza di Spagna, Campo Marzio, Municipio Roma I, Rome, Roma Capitale, Lazio, 00187, Italy&41.9057477,12.4821294\",\"Piazza del Popolo, Campo Marzio, Municipio Roma I, Rome, Roma Capitale, Lazio, Italy&41.910750199999995,12.47682475832423\"],[\"Trevi, Municipio Roma I, Rome, Roma Capitale, Lazio, Italy&41.900611999999995,12.485238365875189\",\"Trevi Fountain, Piazza di Trevi, Trevi, Municipio Roma I, Rome, Roma Capitale, Lazio, 00187, Italy&41.9009778,12.483284842339874\",\"Barberini, Piazza Barberini, Trevi, Municipio Roma I, Rome, Roma Capitale, Lazio, 00187, Italy&41.903837,12.488764\"],[\"St Ignatius, Piazza di San Macuto, Pigna, Municipio Roma I, Rome, Roma Capitale, Lazio, 00186, Italy&41.89874965,12.479808092529893\",\"San Pietro, Ponte SantAngelo, Ponte, Municipio Roma I, Rome, Roma Capitale, Lazio, 00193, Italy&41.9013244,12.4664397\"]]', 3);

-- --------------------------------------------------------

--
-- Struttura della tabella `session`
--

CREATE TABLE `session` (
  `session_id` binary(32) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `expiration` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `session`
--

INSERT INTO `session` (`session_id`, `user_email`, `expiration`) VALUES
(0x257b44cddbdf23d8a74925063c0b6e8aa3fed033477c365390227d320eb18191, 'ale@prova.it', 1687376559);

-- --------------------------------------------------------

--
-- Struttura della tabella `user`
--

CREATE TABLE `user` (
  `Name` varchar(50) NOT NULL,
  `Surname` varchar(50) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Password` varchar(200) NOT NULL,
  `Date` date NOT NULL,
  `Gender` varchar(20) NOT NULL,
  `Number` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `user`
--

INSERT INTO `user` (`Name`, `Surname`, `Email`, `Password`, `Date`, `Gender`, `Number`) VALUES
('Adsd', 'sdas', 'a@cab', '$2y$10$2oyOUdCCg0pN7rO73BRGMOdaFWXc8dfyWpRUJ48vL3MEvHs6RHaIW', '2023-05-09', 'male', '2451555544'),
('ale', 'ale', 'ale@prova.it', '$2y$10$HyCa1oRT5O3jtwnQQvfMs.N8BTnJsWQ60nrn3dz45pvRbrddKPazK', '2023-05-03', 'male', '11122223'),
('Prova', 'Prova', 'prova@prova.it', '$2y$10$zMAS2Ty.9dekM2Kaf.MFg.AGp0nqb/o7A8q50C80cGtfobx5orv.W', '2023-05-02', 'male', '11112222');

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `itinerary`
--
ALTER TABLE `itinerary`
  ADD PRIMARY KEY (`travel_id`);

--
-- Indici per le tabelle `session`
--
ALTER TABLE `session`
  ADD PRIMARY KEY (`session_id`);

--
-- Indici per le tabelle `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`Email`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `itinerary`
--
ALTER TABLE `itinerary`
  MODIFY `travel_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
