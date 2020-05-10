-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le :  Dim 11 mars 2018 à 23:04
-- Version du serveur :  10.1.30-MariaDB
-- Version de PHP :  5.6.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `projetS4`
--

-- --------------------------------------------------------

--
-- Structure de la table `ADHERENT`
--

CREATE TABLE `ADHERENT` (
  `id_user` int(11) NOT NULL,
  `id_groupe` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `ADHERENT`
--

INSERT INTO `ADHERENT` (`id_user`, `id_groupe`) VALUES
(1, 1),
(1, 1),
(9, 1);

-- --------------------------------------------------------

--
-- Structure de la table `AGENDA`
--

CREATE TABLE `AGENDA` (
  `id_agenda` bigint(20) UNSIGNED NOT NULL,
  `id_groupe` int(11) NOT NULL,
  `id_event` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `AGENDA`
--

INSERT INTO `AGENDA` (`id_agenda`, `id_groupe`, `id_event`) VALUES
(1, 5, 1),
(2, 5, 2),
(3, 5, 3),
(4, 5, 4),
(5, 5, 5),
(6, 5, 6),
(7, 5, 7),
(8, 1, 8),
(9, 1, 9),
(10, 1, 10),
(11, 1, 11),
(12, 1, 12),
(13, 1, 13),
(14, 1, 14),
(15, 1, 15),
(16, 1, 16),
(17, 1, 17),
(18, 1, 18),
(19, 1, 19),
(20, 1, 20),
(21, 1, 21),
(22, 1, 22),
(23, 1, 23),
(24, 1, 24),
(25, 1, 25),
(26, 1, 26),
(27, 1, 27),
(28, 1, 28),
(29, 1, 29);

-- --------------------------------------------------------

--
-- Structure de la table `EVENT`
--

CREATE TABLE `EVENT` (
  `id_event` bigint(20) UNSIGNED NOT NULL,
  `debut` datetime NOT NULL,
  `fin` time NOT NULL,
  `description` text NOT NULL,
  `id_agenda` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `EVENT`
--

INSERT INTO `EVENT` (`id_event`, `debut`, `fin`, `description`, `id_agenda`) VALUES
(25, '2018-01-15 12:00:00', '13:00:00', 'Test v2 des events\r\n', 0),
(26, '2018-01-15 23:56:00', '05:02:00', 'test v2', 0),
(27, '2018-01-15 11:00:00', '12:00:00', 'test ordre chronologique', 0),
(28, '2018-01-15 10:00:00', '11:00:00', 'test ordre chronologique V2', 0),
(29, '2018-01-16 09:30:00', '10:30:00', 'test ordre chronologique V3 ', 0);

-- --------------------------------------------------------

--
-- Structure de la table `GROUPE`
--

CREATE TABLE `GROUPE` (
  `id_groupe` bigint(20) UNSIGNED NOT NULL,
  `id_user` int(11) NOT NULL,
  `nomgroupe` varchar(280) NOT NULL,
  `color` int(11) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Déchargement des données de la table `GROUPE`
--

INSERT INTO `GROUPE` (`id_groupe`, `id_user`, `nomgroupe`, `color`, `description`) VALUES
(1, 5, 'TEST', 632, 'ceci est un test');

-- --------------------------------------------------------

--
-- Structure de la table `USER`
--

CREATE TABLE `USER` (
  `id_user` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(150) NOT NULL,
  `nom` varchar(150) NOT NULL,
  `prenom` varchar(150) NOT NULL,
  `mdp` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `USER`
--

INSERT INTO `USER` (`id_user`, `email`, `nom`, `prenom`, `mdp`) VALUES
(1, 'test@test.test', 'root', 'test', 'root'),
(9, 'retest@test.com', 'retest\r\n', 'retest', '1234'),
(10, '', 'sabard', 'pierre', '1234'),
(11, 'sabrdpierre@test.com', 'sabard', 'pierre', '1234');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `AGENDA`
--
ALTER TABLE `AGENDA`
  ADD PRIMARY KEY (`id_agenda`),
  ADD UNIQUE KEY `id_agenda` (`id_agenda`);

--
-- Index pour la table `EVENT`
--
ALTER TABLE `EVENT`
  ADD UNIQUE KEY `id_event` (`id_event`);

--
-- Index pour la table `GROUPE`
--
ALTER TABLE `GROUPE`
  ADD PRIMARY KEY (`id_groupe`),
  ADD UNIQUE KEY `id_groupe` (`id_groupe`);

--
-- Index pour la table `USER`
--
ALTER TABLE `USER`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `id_user` (`id_user`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `AGENDA`
--
ALTER TABLE `AGENDA`
  MODIFY `id_agenda` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT pour la table `EVENT`
--
ALTER TABLE `EVENT`
  MODIFY `id_event` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT pour la table `GROUPE`
--
ALTER TABLE `GROUPE`
  MODIFY `id_groupe` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `USER`
--
ALTER TABLE `USER`
  MODIFY `id_user` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
