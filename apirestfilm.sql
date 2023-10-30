-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : lun. 30 oct. 2023 à 16:01
-- Version du serveur : 10.4.22-MariaDB
-- Version de PHP : 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `apirestfilm`
--

-- --------------------------------------------------------

--
-- Structure de la table `acteur_film`
--

CREATE TABLE `acteur_film` (
  `acteur_film_id` int(11) NOT NULL,
  `acteur_id` int(11) DEFAULT NULL,
  `film_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `acteur_film`
--

INSERT INTO `acteur_film` (`acteur_film_id`, `acteur_id`, `film_id`) VALUES
(1, 1, 1),
(2, 2, 1),
(3, 3, 2),
(4, 4, 2),
(5, 5, 3),
(6, 6, 3),
(7, 7, 4),
(8, 8, 4),
(9, 9, 5),
(10, 10, 5),
(11, 11, 6),
(12, 12, 6),
(13, 13, 7),
(14, 14, 7),
(15, 15, 8),
(16, 16, 8),
(17, 17, 9),
(18, 18, 9),
(19, 19, 10),
(20, 20, 10),
(21, 1, 11),
(22, 2, 11),
(23, 3, 12),
(24, 4, 12),
(25, 5, 13),
(26, 6, 13),
(27, 7, 14),
(28, 8, 14),
(29, 9, 15),
(30, 10, 15),
(31, 11, 16),
(32, 12, 16),
(33, 13, 17),
(34, 14, 17),
(35, 15, 18),
(36, 16, 18),
(37, 17, 19),
(38, 18, 19),
(39, 19, 20),
(40, 20, 20);

-- --------------------------------------------------------

--
-- Structure de la table `film`
--

CREATE TABLE `film` (
  `film_id` int(11) NOT NULL,
  `nom` varchar(128) NOT NULL,
  `description` varchar(2048) DEFAULT NULL,
  `date_de_parution` date DEFAULT NULL,
  `realisateur_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `film`
--

INSERT INTO `film` (`film_id`, `nom`, `description`, `date_de_parution`, `realisateur_id`) VALUES
(1, 'The Adventure of Shadows', 'A thrilling adventure in a mystical world filled with magic and wonder.', '2020-01-05', 11),
(2, 'Midnight Serenity', 'A tale of love, betrayal, and redemption under the starry night.', '2020-02-12', 12),
(3, 'Whispers in the Woods', 'Secrets buried deep in the heart of an enchanted forest come to light.', '2020-03-10', 13),
(4, 'Lost Horizon', 'A group of explorers embarks on a journey to find a lost paradise.', '2020-04-05', 14),
(5, 'Secrets of the Enchanted Forest', 'Two unlikely heroes must uncover the hidden truths of a magical land.', '2020-05-28', 15),
(6, 'The Phantom of Moonlight Manor', 'A haunting mystery shrouded in the eerie atmosphere of Moonlight Manor.', '2020-06-14', 16),
(7, 'Echoes of Eternity', 'Time and destiny collide in a story of love and eternal echoes.', '2020-07-20', 17),
(8, 'Dreams of the Forgotten Kingdom', 'A young hero\'s quest to save a forgotten kingdom from darkness.', '2020-08-18', 18),
(9, 'The Chronicles of Starfall', 'Join a band of fearless warriors in their mission to protect a crystal city.', '2020-09-01', 19),
(10, 'Guardians of the Crystal City', 'Uncover the secrets hidden beneath the silver skies and ancient ruins.', '2020-10-10', 20),
(11, 'Beneath the Silver Skies', 'A thrilling adventure through hidden realms and mythical creatures.', '2020-11-28', 11),
(12, 'Tales from the Hidden Realms', 'A race against time to solve the enigma of the timeless watch.', '2020-12-14', 12),
(13, 'Enigma of the Timeless Watch', 'A legendary tale of a hero\'s journey to confront a fierce dragon.', '2020-01-08', 13),
(14, 'The Legend of the Ruby Dragon', 'Get lost in the enchanted labyrinth filled with puzzles and magic.', '2020-02-05', 14),
(15, 'The Enchanted Labyrinth', 'An epic odyssey across the cosmos in search of a new home.', '2020-03-19', 15),
(16, 'Odyssey of the Cosmic Voyager', 'A voyage to a celestial kingdom with wondrous landscapes and creatures.', '2020-04-11', 16),
(17, 'Voyage to the Celestial Kingdom', 'Join a brave knight on his quest to find the golden chalice.', '2020-05-16', 17),
(18, 'Quest for the Golden Chalice', 'A group of explorers stranded on a mysterious and deadly island.', '2020-06-22', 18),
(19, 'The Mysterious Isle', 'Legends come to life as heroes embark on a celestial journey.', '2020-07-30', 19),
(20, 'Legends of the Celestial Guardians', 'Legends come to life as heroes embark on a celestial journey.', '2020-08-11', 20);

-- --------------------------------------------------------

--
-- Structure de la table `personne`
--

CREATE TABLE `personne` (
  `personne_id` int(11) NOT NULL,
  `nom` varchar(128) NOT NULL,
  `prenom` varchar(128) NOT NULL,
  `date_de_naissance` date DEFAULT NULL,
  `code` varchar(128) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `personne`
--

INSERT INTO `personne` (`personne_id`, `nom`, `prenom`, `date_de_naissance`, `code`) VALUES
(1, 'James', 'Anderson', '1990-01-15', NULL),
(2, 'Emily', 'Bennett', '1988-04-22', NULL),
(3, 'Robert', 'Carter', '1993-03-10', NULL),
(4, 'Sarah', 'Davis', '1985-07-05', NULL),
(5, 'Michael', 'Edwards', '1987-11-28', NULL),
(6, 'Jennifer', 'Foster', '1992-09-14', NULL),
(7, 'Christopher', 'Green', '1986-02-20', NULL),
(8, 'Jessica', 'Harris', '1991-06-11', NULL),
(9, 'William', 'Jackson', '1995-12-01', NULL),
(10, 'Laura', 'King', '1990-08-18', NULL),
(11, 'Matthew', 'Lee', '1993-10-30', NULL),
(12, 'Olivia', 'Martinez', '1989-07-02', NULL),
(13, 'Daniel', 'Nelson', '1996-05-19', NULL),
(14, 'Sophia', 'Ortiz', '1992-03-08', NULL),
(15, 'Joseph', 'Parker', '1990-12-03', NULL),
(16, 'Ava', 'Quinn', '1994-01-25', NULL),
(17, 'David', 'Robinson', '1991-09-12', NULL),
(18, 'Emma', 'Smith', '1995-11-07', NULL),
(19, 'Benjamin', 'Taylor', '1993-08-14', NULL),
(20, 'Lily', 'Walker', '1988-06-24', NULL);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `acteur_film`
--
ALTER TABLE `acteur_film`
  ADD PRIMARY KEY (`acteur_film_id`),
  ADD KEY `acteur_id` (`acteur_id`),
  ADD KEY `film_id` (`film_id`);

--
-- Index pour la table `film`
--
ALTER TABLE `film`
  ADD PRIMARY KEY (`film_id`),
  ADD KEY `realisateur_id` (`realisateur_id`);

--
-- Index pour la table `personne`
--
ALTER TABLE `personne`
  ADD PRIMARY KEY (`personne_id`),
  ADD UNIQUE KEY `code` (`code`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `acteur_film`
--
ALTER TABLE `acteur_film`
  MODIFY `acteur_film_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT pour la table `film`
--
ALTER TABLE `film`
  MODIFY `film_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT pour la table `personne`
--
ALTER TABLE `personne`
  MODIFY `personne_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `acteur_film`
--
ALTER TABLE `acteur_film`
  ADD CONSTRAINT `acteur_film_ibfk_1` FOREIGN KEY (`acteur_id`) REFERENCES `personne` (`personne_id`),
  ADD CONSTRAINT `acteur_film_ibfk_2` FOREIGN KEY (`film_id`) REFERENCES `film` (`film_id`);

--
-- Contraintes pour la table `film`
--
ALTER TABLE `film`
  ADD CONSTRAINT `film_ibfk_1` FOREIGN KEY (`realisateur_id`) REFERENCES `personne` (`personne_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
