-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : lun. 15 avr. 2024 à 22:02
-- Version du serveur :  10.6.17-MariaDB
-- Version de PHP : 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `gretaxao_malrysi`
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
  `image` geometry DEFAULT NULL,
  `idUser` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `balade`
--

CREATE TABLE `balade` (
  `idBalade` int(11) NOT NULL,
  `title` varchar(30) DEFAULT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `length` int(11) NOT NULL,
  `duration` decimal(6,2) NOT NULL,
  `difficulty` varchar(20) DEFAULT NULL,
  `partNumber` int(11) NOT NULL,
  `startPoint` varchar(50) DEFAULT NULL,
  `arrival` varchar(50) DEFAULT NULL,
  `department` varchar(50) DEFAULT NULL,
  `region` varchar(50) DEFAULT NULL,
  `meetingPoint` varchar(100) NOT NULL,
  `precisions` text NOT NULL,
  `map` geometry DEFAULT NULL,
  `waypoints` text DEFAULT NULL,
  `idUser` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Déchargement des données de la table `balade`
--

INSERT INTO `balade` (`idBalade`, `title`, `date`, `time`, `length`, `duration`, `difficulty`, `partNumber`, `startPoint`, `arrival`, `department`, `region`, `meetingPoint`, `precisions`, `map`, `waypoints`, `idUser`) VALUES
(1, 'Découverte du golfe', '2024-04-24', '10:00:00', 36, 65.78, 'débutant', 12, 'Vannes', 'Auray', 'Morbihan', 'Bretagne', 'Station essence Leclerc', 'Sortie en petit groupe de 10.\r\nAllure douce.', NULL, '[{\"lat\":47.658677,\"lng\":-2.759908},{\"lat\":47.651281,\"lng\":-2.801376},{\"lat\":47.624446,\"lng\":-2.802406},{\"lat\":47.62005,\"lng\":-2.867294},{\"lat\":47.589031,\"lng\":-2.895996},{\"lat\":47.602922,\"lng\":-2.928955},{\"lat\":47.637981,\"lng\":-2.953022},{\"lat\":47.665156,\"lng\":-2.980934}]', 13),
(8, 'Virages, virages', '2024-06-12', '14:00:00', 65, 89.87, 'confirmé', 5, 'Clermont-Ferrand', 'Fontfreyde', 'Puy de Dôme', 'Auvergne Rhône Alpes', 'Station essence Carrefour', 'Plein de belles courbes pour notre plus grand plaisir !', NULL, '[{\"lat\":45.7774551,\"lng\":3.0819427},{\"lat\":45.74203517983806,\"lng\":3.017210976266798},{\"lat\":45.641791907563714,\"lng\":3.003522379271049},{\"lat\":45.62056911674793,\"lng\":3.047567635796145},{\"lat\":45.587662715066536,\"lng\":2.9916331812145107},{\"lat\":45.60985864112045,\"lng\":2.9480932465522085},{\"lat\":45.6551000657999,\"lng\":2.971262368125185},{\"lat\":45.70476471045619,\"lng\":3.0038194730698913}]', 13),
(23, 'Visite aux anciens de Beganne', '2024-07-13', '11:00:00', 74, 92.80, 'debutant', 15, 'Redon', 'Béganne', 'Ille et Vilaine', 'Bretagne', 'Rond point de Courée', 'Départ de Redon à 11h pile !\r\nArrêt à l\'étang de Pluherlin.', NULL, '[{\"lat\":47.6510682,\"lng\":-2.0842143},{\"lat\":47.70075109139772,\"lng\":-2.148513793945313},{\"lat\":47.72546834774025,\"lng\":-2.280349731445313},{\"lat\":47.74555691490245,\"lng\":-2.2549438476562504},{\"lat\":47.77013754192353,\"lng\":-2.318973541259766},{\"lat\":47.697747261516,\"lng\":-2.3620605468750004},{\"lat\":47.5820839916191,\"lng\":-2.4104690551757817},{\"lat\":47.59713469769798,\"lng\":-2.240524291992188}]', 15),
(24, 'Visite au pays du Bretzel', '2024-06-10', '09:00:00', 228, 293.06, 'confirme', 8, 'Belfort', 'Molsheim', 'Territoire de Belfort', 'Bourgogne Franche Comté', 'Relais Total des Glacis', 'Routes escarpées et pleines d\'épingle.\r\nPlaisir assuré mais je préfère éviter les motards débutant.\r\nMerci !', NULL, '[{\"lat\":47.6379599,\"lng\":6.8628942},{\"lat\":47.72304334136589,\"lng\":6.921043395996095},{\"lat\":47.77417550123265,\"lng\":6.995544433593751},{\"lat\":47.828138661732794,\"lng\":7.078285217285157},{\"lat\":47.99612515574872,\"lng\":7.073135375976563},{\"lat\":48.07922583003106,\"lng\":7.143516540527345},{\"lat\":48.125767833701666,\"lng\":7.282218933105469},{\"lat\":48.28227903170258,\"lng\":6.939239501953126},{\"lat\":48.53661318127798,\"lng\":7.492675781250001}]', 15);

-- --------------------------------------------------------

--
-- Structure de la table `message`
--

CREATE TABLE `message` (
  `idMessage` int(11) NOT NULL,
  `email` text NOT NULL,
  `object` text NOT NULL,
  `message` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `participate`
--

CREATE TABLE `participate` (
  `idUser` int(11) NOT NULL,
  `idBalade` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Déchargement des données de la table `participate`
--

INSERT INTO `participate` (`idUser`, `idBalade`) VALUES
(13, 1),
(13, 8),
(15, 8),
(15, 23),
(15, 24);

-- --------------------------------------------------------

--
-- Structure de la table `photo`
--

CREATE TABLE `photo` (
  `idPhoto` int(11) NOT NULL,
  `idBalade` int(11) NOT NULL,
  `idUser` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `_user`
--

CREATE TABLE `_user` (
  `idUser` int(11) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `password` varchar(200) DEFAULT NULL,
  `pseudo` varchar(15) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `firstname` varchar(50) DEFAULT NULL,
  `isAdmin` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Déchargement des données de la table `_user`
--

INSERT INTO `_user` (`idUser`, `email`, `password`, `pseudo`, `name`, `firstname`, `isAdmin`) VALUES
(13, 'user@ride-connect.fr', '$2y$10$lWfQA4bLbKIWrj4vwirLq.k2kNQLE53/MTRWC/HOniqYp8FLpYY32', 'Simonio', 'malry', 'Simon', 0),
(15, 'quentin@quentin.fr', '$2y$10$xD0swwNzMQ1vl3uWtZssDuYStirL9DgOxXpny8muzXYitLejYTnl.', 'Quentinio', 'Quentin', 'Quentin', 0),
(22, 'admin@ride-connect.fr', '$2y$10$5MYH5EnNWVOarr1Bwg2B0.Ix/2OIcrEwMFq5sM9RqLSYRGFS3rYn2', 'TopAdmin', 'Monsieur', 'Admin', 1);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `article`
--
ALTER TABLE `article`
  ADD PRIMARY KEY (`idArticle`),
  ADD KEY `idUser` (`idUser`);

--
-- Index pour la table `balade`
--
ALTER TABLE `balade`
  ADD PRIMARY KEY (`idBalade`),
  ADD KEY `balade_ibfk_1` (`idUser`);

--
-- Index pour la table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`idMessage`);

--
-- Index pour la table `participate`
--
ALTER TABLE `participate`
  ADD PRIMARY KEY (`idUser`,`idBalade`),
  ADD KEY `participate_ibfk_2` (`idBalade`);

--
-- Index pour la table `photo`
--
ALTER TABLE `photo`
  ADD PRIMARY KEY (`idPhoto`),
  ADD KEY `idBalade` (`idBalade`),
  ADD KEY `idUser` (`idUser`);

--
-- Index pour la table `_user`
--
ALTER TABLE `_user`
  ADD PRIMARY KEY (`idUser`);

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
  MODIFY `idBalade` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT pour la table `message`
--
ALTER TABLE `message`
  MODIFY `idMessage` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `photo`
--
ALTER TABLE `photo`
  MODIFY `idPhoto` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `_user`
--
ALTER TABLE `_user`
  MODIFY `idUser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

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
  ADD CONSTRAINT `balade_ibfk_1` FOREIGN KEY (`idUser`) REFERENCES `_user` (`idUser`) ON DELETE CASCADE;

--
-- Contraintes pour la table `participate`
--
ALTER TABLE `participate`
  ADD CONSTRAINT `participate_ibfk_1` FOREIGN KEY (`idUser`) REFERENCES `_user` (`idUser`) ON DELETE CASCADE,
  ADD CONSTRAINT `participate_ibfk_2` FOREIGN KEY (`idBalade`) REFERENCES `balade` (`idBalade`) ON DELETE CASCADE;

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
