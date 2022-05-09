-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : lun. 09 mai 2022 à 16:38
-- Version du serveur : 5.7.36
-- Version de PHP : 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `immobilier`
--

-- --------------------------------------------------------

--
-- Structure de la table `logement`
--

DROP TABLE IF EXISTS `logement`;
CREATE TABLE IF NOT EXISTS `logement` (
  `id_logement` int(11) NOT NULL AUTO_INCREMENT,
  `titre` varchar(255) NOT NULL,
  `adresse` varchar(255) NOT NULL,
  `ville` varchar(255) NOT NULL,
  `cp` int(11) NOT NULL,
  `surface` double NOT NULL,
  `prix` int(11) NOT NULL,
  `photo` varchar(255) NOT NULL,
  `types` varchar(255) NOT NULL,
  `descriptions` varchar(250) NOT NULL,
  PRIMARY KEY (`id_logement`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `logement`
--

INSERT INTO `logement` (`id_logement`, `titre`, `adresse`, `ville`, `cp`, `surface`, `prix`, `photo`, `types`, `descriptions`) VALUES
(1, 'Studio E950', '22 Route du Rhin ', 'Illkirch', 67400, 20, 380, 'assets/images/logement.jpg', 'location', 'CROUS'),
(2, 'Studio E95', '14 Route de la Wantzenau ', 'Strasbourg', 67000, 20, 380, 'assets/images/logement.jpg', 'location', 'Logement étudiant '),
(4, 'Maison familiale ', '15 rue de la Gascogne', 'Cambrai', 59000, 50, 750, 'assets/images/maison1.jpg', 'location', 'Belle appartement de 4 pièces pour une famille '),
(10, 'Maison familiale ', '15 rue de la Gascogne', 'Cambrai', 59000, 50, 750, 'assets/images/maison1.jpg', 'location', 'Belle appartement de 4 pièces pour une famille '),
(9, 'Studio E95', '14 Route de la Wantzenau ', 'Strasbourg', 67000, 20, 380, 'assets/images/logement.jpg', 'location', 'Logement étudiant '),
(8, 'Studio E950', '22 Route du Rhin ', 'Illkirch', 67400, 20, 380, 'assets/images/logement.jpg', 'location', 'CROUS');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
