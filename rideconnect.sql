-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : mer. 03 avr. 2024 à 15:52
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `rideconnect`
--

-- --------------------------------------------------------

--
-- Structure de la table `article`
--

CREATE TABLE `article` (
  `idArticle` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `dateArticle` date DEFAULT NULL,
  `content` text DEFAULT NULL,
  `image` text DEFAULT NULL,
  `idUser` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `balade`
--

CREATE TABLE `balade` (
  `idBalade` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `length` int(11) NOT NULL,
  `duration` decimal(4,2) NOT NULL,
  `difficulty` varchar(20) NOT NULL,
  `partNumber` int(11) NOT NULL,
  `startPoint` varchar(50) NOT NULL,
  `arrival` varchar(50) NOT NULL,
  `department` varchar(50) NOT NULL,
  `region` varchar(50) NOT NULL,
  `meetingPoint` varchar(50) NOT NULL,
  `precisions` text NOT NULL,
  `map` text DEFAULT NULL,
  `waypoints` text NOT NULL,
  `idUser` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `participer`
--

CREATE TABLE `participer` (
  `idUser` int(11) NOT NULL,
  `idBalade` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `photo`
--

CREATE TABLE `photo` (
  `idPhoto` int(11) NOT NULL,
  `idBalade` int(11) NOT NULL,
  `idUser` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `_user`
--

CREATE TABLE `_user` (
  `idUser` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(200) DEFAULT NULL,
  `pseudo` varchar(15) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `firstName` varchar(50) DEFAULT NULL,
  `isAdmin` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `_user`
--

INSERT INTO `_user` (`idUser`, `email`, `password`, `pseudo`, `name`, `firstName`, `isAdmin`) VALUES
(14, 'simon@simon.fr', '$2y$10$.GhcbPeC0OhPFrdqRWJIlOWWymhq/Nlghr5O.1m/DA4zHSyWVwYae', 'parki', 'malry', 'simon', 1),
(15, 'antoine@antoine.fr', '$2y$10$NhWEktjVNQruxQ8SAVupw.QoRnBWmQx6G1nyO8kKdRhRB1A.kSls.', 'Antonio', 'antoine', 'antoine', 0),
(16, 'quentin@quentin.fr', '$2y$10$Ae8NjluobwNVJ0B.iwfsmO4.89qUntMYUxUv9Cu20oWcoDh6wybwe', 'Quentino', 'Quentin', 'Quentin', 0),
(17, 'nadine@nadine.fr', '$2y$10$7O2WEgZFzWHLA4uAxeu9MOoM/8w7WoQWk1LOUNULeXSii9cuvONAK', 'nadinio', 'nadine', 'nadine', 0);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `article`
--
ALTER TABLE `article`
  ADD PRIMARY KEY (`idArticle`),
  ADD KEY `idUser` (`idUser`) USING BTREE;

--
-- Index pour la table `balade`
--
ALTER TABLE `balade`
  ADD PRIMARY KEY (`idBalade`),
  ADD KEY `idUser` (`idUser`) USING BTREE;

--
-- Index pour la table `participer`
--
ALTER TABLE `participer`
  ADD PRIMARY KEY (`idUser`,`idBalade`),
  ADD KEY `idBalade` (`idBalade`);

--
-- Index pour la table `photo`
--
ALTER TABLE `photo`
  ADD PRIMARY KEY (`idPhoto`),
  ADD KEY `idBalade` (`idBalade`),
  ADD KEY `idUser` (`idUser`) USING BTREE;

--
-- Index pour la table `_user`
--
ALTER TABLE `_user`
  ADD PRIMARY KEY (`idUser`),
  ADD UNIQUE KEY `pseudo` (`pseudo`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `pseudo_2` (`pseudo`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `article`
--
ALTER TABLE `article`
  MODIFY `idArticle` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `balade`
--
ALTER TABLE `balade`
  MODIFY `idBalade` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT pour la table `photo`
--
ALTER TABLE `photo`
  MODIFY `idPhoto` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `_user`
--
ALTER TABLE `_user`
  MODIFY `idUser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `article`
--
ALTER TABLE `article`
  ADD CONSTRAINT `article_ibfk_1` FOREIGN KEY (`idUser`) REFERENCES `_user` (`idUser`);

--
-- Contraintes pour la table `balade`
--
ALTER TABLE `balade`
  ADD CONSTRAINT `balade_ibfk_1` FOREIGN KEY (`idUser`) REFERENCES `_user` (`idUser`);

--
-- Contraintes pour la table `participer`
--
ALTER TABLE `participer`
  ADD CONSTRAINT `participer_ibfk_1` FOREIGN KEY (`idUser`) REFERENCES `_user` (`idUser`),
  ADD CONSTRAINT `participer_ibfk_2` FOREIGN KEY (`idBalade`) REFERENCES `balade` (`idBalade`);

--
-- Contraintes pour la table `photo`
--
ALTER TABLE `photo`
  ADD CONSTRAINT `photo_ibfk_1` FOREIGN KEY (`idBalade`) REFERENCES `balade` (`idBalade`),
  ADD CONSTRAINT `photo_ibfk_2` FOREIGN KEY (`idUser`) REFERENCES `_user` (`idUser`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
