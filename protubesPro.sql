-- phpMyAdmin SQL Dump
-- version 3.5.8.1deb1
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Ven 13 Septembre 2013 à 10:10
-- Version du serveur: 5.5.32-0ubuntu0.13.04.1
-- Version de PHP: 5.4.9-4ubuntu2.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `protubesPro`
--

-- --------------------------------------------------------

--
-- Structure de la table `appreciationCommentaire`
--

DROP TABLE IF EXISTS `appreciationCommentaire`;
CREATE TABLE IF NOT EXISTS `appreciationCommentaire` (
  `idCommentaire` int(11) NOT NULL,
  `idUsager` int(11) NOT NULL,
  `appreciation` tinyint(1) NOT NULL,
  PRIMARY KEY (`idCommentaire`,`idUsager`),
  KEY `idUsager` (`idUsager`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `appreciationVideo`
--

DROP TABLE IF EXISTS `appreciationVideo`;
CREATE TABLE IF NOT EXISTS `appreciationVideo` (
  `idVideo` int(11) NOT NULL,
  `idUsager` int(11) NOT NULL,
  `appreciation` tinyint(1) NOT NULL,
  PRIMARY KEY (`idVideo`,`idUsager`),
  KEY `idUsager` (`idUsager`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `catalogue`
--

DROP TABLE IF EXISTS `catalogue`;
CREATE TABLE IF NOT EXISTS `catalogue` (
  `CategorieMere` varchar(140) NOT NULL,
  `CategorieFille` varchar(140) NOT NULL,
  PRIMARY KEY (`CategorieMere`,`CategorieFille`),
  KEY `CategorieFille` (`CategorieFille`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

DROP TABLE IF EXISTS `categorie`;
CREATE TABLE IF NOT EXISTS `categorie` (
  `titre` varchar(140) NOT NULL,
  `description` text,
  PRIMARY KEY (`titre`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `commentaire`
--

DROP TABLE IF EXISTS `commentaire`;
CREATE TABLE IF NOT EXISTS `commentaire` (
  `id` int(11) NOT NULL,
  `datePublication` date DEFAULT NULL,
  `message` text NOT NULL,
  `idUser` int(11) NOT NULL,
  `idVideo` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idVideo` (`idVideo`),
  KEY `idVideo_2` (`idVideo`),
  KEY `idUser` (`idUser`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `compte`
--

DROP TABLE IF EXISTS `compte`;
CREATE TABLE IF NOT EXISTS `compte` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `actif` tinyint(1) NOT NULL,
  `newsletter` tinyint(1) DEFAULT NULL,
  `langueDefault` varchar(2) NOT NULL,
  `confidentialiteDefault` varchar(30) NOT NULL,
  `permettreRechercheMembre` tinyint(1) NOT NULL,
  `idUsager` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idUsager` (`idUsager`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `contient`
--

DROP TABLE IF EXISTS `contient`;
CREATE TABLE IF NOT EXISTS `contient` (
  `idSerie` int(11) NOT NULL,
  `idEpisode` int(11) NOT NULL,
  `date` date DEFAULT NULL,
  PRIMARY KEY (`idSerie`,`idEpisode`),
  KEY `idEpisode` (`idEpisode`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `image`
--

DROP TABLE IF EXISTS `image`;
CREATE TABLE IF NOT EXISTS `image` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) NOT NULL,
  `taille` varchar(25) NOT NULL,
  `type` varchar(25) NOT NULL,
  `desc` varchar(100) NOT NULL,
  `blob` blob NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `serie`
--

DROP TABLE IF EXISTS `serie`;
CREATE TABLE IF NOT EXISTS `serie` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(140) NOT NULL,
  `description` varchar(210) DEFAULT NULL,
  `nombreEpisodeTotal` int(2) DEFAULT NULL,
  `categorie` varchar(140) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `categorie` (`categorie`),
  KEY `categorie_2` (`categorie`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
CREATE TABLE IF NOT EXISTS `sessions` (
  `idsession` varchar(32) NOT NULL,
  `expiration` int(11) NOT NULL,
  `valeur` text NOT NULL,
  PRIMARY KEY (`idsession`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `usager`
--

DROP TABLE IF EXISTS `usager`;
CREATE TABLE IF NOT EXISTS `usager` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(70) NOT NULL,
  `prenom` varchar(140) NOT NULL,
  `idImage` int(11) DEFAULT NULL,
  `identifiant` varchar(140) NOT NULL,
  `email` varchar(210) NOT NULL,
  `password` varchar(140) NOT NULL,
  `dateNaissance` date NOT NULL,
  `dateInscription` date NOT NULL,
  `pays` varchar(210) DEFAULT NULL,
  `codePostal` varchar(21) DEFAULT NULL,
  `telephone` varchar(210) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `identifiant` (`identifiant`,`email`),
  KEY `idImage` (`idImage`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `video`
--

DROP TABLE IF EXISTS `video`;
CREATE TABLE IF NOT EXISTS `video` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `datePublication` date DEFAULT NULL,
  `idImage` int(11) DEFAULT NULL,
  `chemin` varchar(210) DEFAULT NULL,
  `titre` varchar(140) NOT NULL,
  `description` text,
  `categorie` varchar(140) NOT NULL,
  `idUser` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idImage` (`idImage`),
  KEY `idUser` (`idUser`),
  KEY `categorie` (`categorie`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `appreciationCommentaire`
--
ALTER TABLE `appreciationCommentaire`
  ADD CONSTRAINT `appreciationCommentaire_ibfk_2` FOREIGN KEY (`idUsager`) REFERENCES `usager` (`id`),
  ADD CONSTRAINT `appreciationCommentaire_ibfk_1` FOREIGN KEY (`idCommentaire`) REFERENCES `commentaire` (`id`);

--
-- Contraintes pour la table `appreciationVideo`
--
ALTER TABLE `appreciationVideo`
  ADD CONSTRAINT `appreciationVideo_ibfk_2` FOREIGN KEY (`idUsager`) REFERENCES `usager` (`id`),
  ADD CONSTRAINT `appreciationVideo_ibfk_1` FOREIGN KEY (`idVideo`) REFERENCES `video` (`id`);

--
-- Contraintes pour la table `catalogue`
--
ALTER TABLE `catalogue`
  ADD CONSTRAINT `catalogue_ibfk_2` FOREIGN KEY (`CategorieFille`) REFERENCES `categorie` (`titre`),
  ADD CONSTRAINT `catalogue_ibfk_1` FOREIGN KEY (`CategorieMere`) REFERENCES `categorie` (`titre`);

--
-- Contraintes pour la table `commentaire`
--
ALTER TABLE `commentaire`
  ADD CONSTRAINT `commentaire_ibfk_1` FOREIGN KEY (`idUser`) REFERENCES `usager` (`id`),
  ADD CONSTRAINT `commentaire_ibfk_2` FOREIGN KEY (`idVideo`) REFERENCES `video` (`id`);

--
-- Contraintes pour la table `compte`
--
ALTER TABLE `compte`
  ADD CONSTRAINT `compte_ibfk_1` FOREIGN KEY (`idUsager`) REFERENCES `usager` (`id`);

--
-- Contraintes pour la table `contient`
--
ALTER TABLE `contient`
  ADD CONSTRAINT `contient_ibfk_2` FOREIGN KEY (`idEpisode`) REFERENCES `video` (`id`),
  ADD CONSTRAINT `contient_ibfk_1` FOREIGN KEY (`idSerie`) REFERENCES `serie` (`id`);

--
-- Contraintes pour la table `serie`
--
ALTER TABLE `serie`
  ADD CONSTRAINT `serie_ibfk_1` FOREIGN KEY (`categorie`) REFERENCES `categorie` (`titre`);

--
-- Contraintes pour la table `usager`
--
ALTER TABLE `usager`
  ADD CONSTRAINT `usager_ibfk_1` FOREIGN KEY (`idImage`) REFERENCES `image` (`id`);

--
-- Contraintes pour la table `video`
--
ALTER TABLE `video`
  ADD CONSTRAINT `video_ibfk_1` FOREIGN KEY (`idImage`) REFERENCES `image` (`id`),
  ADD CONSTRAINT `video_ibfk_2` FOREIGN KEY (`idUser`) REFERENCES `usager` (`id`),
  ADD CONSTRAINT `video_ibfk_3` FOREIGN KEY (`categorie`) REFERENCES `categorie` (`titre`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
