-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  sam. 05 sep. 2020 à 14:52
-- Version du serveur :  10.1.31-MariaDB
-- Version de PHP :  7.2.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `db`
--

-- --------------------------------------------------------

--
-- Structure de la table `client`
--

CREATE TABLE `client` (
  `id` int(10) UNSIGNED NOT NULL,
  `nom` varchar(32) NOT NULL,
  `prenom` varchar(32) NOT NULL,
  `telephone` char(16) NOT NULL,
  `email` varchar(128) DEFAULT NULL,
  `adresse` varchar(250) NOT NULL,
  `login` varchar(128) NOT NULL,
  `mdp` varchar(255) NOT NULL,
  `sexe` char(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `client`
--

INSERT INTO `client` (`id`, `nom`, `prenom`, `telephone`, `email`, `adresse`, `login`, `mdp`, `sexe`) VALUES
(1, 'vadly', 'Aidara', '774278617', 'vadly427@gmail.com', 'Ndande', 'vadly', 'HaQIjn8lRzfwVbmD/i7c5A==', 'F'),
(2, 'Abraham', 'Diallo', '773501190', 'barhama427@gmail.com', 'Dakar', 'abraham', 'Rjb9HFgPxgeeW/k+R59wLw==', 'M'),
(3, 'dioum', 'saliou', '435678', 'dioum@gmail.com', 'touba', 'dioum', 'bySXamIZfTKtokyJSeCj7w==', 'M'),
(4, 'Mouhamed', 'Aidara', '774267788', 'mouha@gmail.com', 'louga', 'mouha', '29KyUL/fUzmwVTp/NIkJDA==', 'M');

-- --------------------------------------------------------

--
-- Structure de la table `conducteur`
--

CREATE TABLE `conducteur` (
  `id` int(10) UNSIGNED NOT NULL,
  `nom` varchar(32) NOT NULL,
  `prenom` varchar(32) NOT NULL,
  `telephone` char(16) NOT NULL,
  `email` varchar(128) DEFAULT NULL,
  `adresse` varchar(250) NOT NULL,
  `login` varchar(128) NOT NULL,
  `mdp` varchar(255) NOT NULL,
  `sexe` char(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `conducteur`
--

INSERT INTO `conducteur` (`id`, `nom`, `prenom`, `telephone`, `email`, `adresse`, `login`, `mdp`, `sexe`) VALUES
(2, 'Monsieur', 'Bame', '774278619', 'bame427@gmail.com', 'Dakar', 'bame', 'WTYe4ia1uPVWjYH44TyJ8w==', 'M'),
(3, 'Amina', 'Diop', '773501191', 'amina427@gmail.com', 'Dakar', 'amina', 'dkxpIIO1F4BjWLC1FOk3cQ==', 'F');

-- --------------------------------------------------------

--
-- Structure de la table `image`
--

CREATE TABLE `image` (
  `id` int(10) UNSIGNED NOT NULL,
  `url` varchar(150) DEFAULT NULL,
  `voiturekey` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `image`
--

INSERT INTO `image` (`id`, `url`, `voiturekey`) VALUES
(1, 'NouvelleDestination/03092020_143546_Passager-homme.jpg', 'mina2020rk'),
(2, 'NouvelleDestination/03092020_143546_Conducteur-homme.jpg', 'mina2020rk'),
(3, 'NouvelleDestination/03092020_162011_Ferrari_Sunrises_and_442416.jpg', 'mina2020rk'),
(4, 'NouvelleDestination/03092020_162011_2016-ford-ka-black-white-editions-3 (1).jpg', 'mina2020rk');

-- --------------------------------------------------------

--
-- Structure de la table `voiture`
--

CREATE TABLE `voiture` (
  `imm` varchar(50) NOT NULL,
  `type` varchar(50) DEFAULT NULL,
  `nbrPlace` int(7) DEFAULT NULL,
  `libelle` text,
  `conducteurkey` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `voiture`
--

INSERT INTO `voiture` (`imm`, `type`, `nbrPlace`, `libelle`, `conducteurkey`) VALUES
('AA334B', 'range 223', 4, 'climatise', 2),
('blabla234lala', 'ttttttypyyy', 5, 'chic pour les meulf chic', 2),
('DK12345FFF', 'Mercedes 250', 5, 'chic pour les chic', 2),
('GHJ2029LG', 'peugeot 404', 5, 'from paradise', 2),
('mina2020bis', 'marcecon 505', 5, 'soyons folle  for one minute', 2),
('mina2020rk', 'marcecon 504', 5, 'soyons folle ', 3);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `telephone` (`telephone`);

--
-- Index pour la table `conducteur`
--
ALTER TABLE `conducteur`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `telephone` (`telephone`);

--
-- Index pour la table `image`
--
ALTER TABLE `image`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_voiture` (`voiturekey`);

--
-- Index pour la table `voiture`
--
ALTER TABLE `voiture`
  ADD PRIMARY KEY (`imm`),
  ADD KEY `fk_conducteur` (`conducteurkey`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `client`
--
ALTER TABLE `client`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `conducteur`
--
ALTER TABLE `conducteur`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `image`
--
ALTER TABLE `image`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `image`
--
ALTER TABLE `image`
  ADD CONSTRAINT `fk_voiture` FOREIGN KEY (`voiturekey`) REFERENCES `voiture` (`imm`);

--
-- Contraintes pour la table `voiture`
--
ALTER TABLE `voiture`
  ADD CONSTRAINT `fk_conducteur` FOREIGN KEY (`conducteurkey`) REFERENCES `conducteur` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
