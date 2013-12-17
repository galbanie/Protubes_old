-- phpMyAdmin SQL Dump
-- version 4.0.10
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Mar 17 Décembre 2013 à 19:13
-- Version du serveur: 5.6.12-log
-- Version de PHP: 5.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `protubes`
--

-- --------------------------------------------------------

--
-- Structure de la table `abonner`
--

DROP TABLE IF EXISTS `abonner`;
CREATE TABLE IF NOT EXISTS `abonner` (
  `idMembre` int(11) NOT NULL,
  `idAbonne` int(11) NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`idMembre`,`idAbonne`),
  KEY `idAbonne` (`idAbonne`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `appreciationcommentaire`
--

DROP TABLE IF EXISTS `appreciationcommentaire`;
CREATE TABLE IF NOT EXISTS `appreciationcommentaire` (
  `idCommentaire` int(11) NOT NULL,
  `idMembre` int(11) NOT NULL,
  `appreciation` tinyint(1) NOT NULL,
  PRIMARY KEY (`idCommentaire`,`idMembre`),
  KEY `appreciationCommentaire_ibfk_2` (`idMembre`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `appreciationvideo`
--

DROP TABLE IF EXISTS `appreciationvideo`;
CREATE TABLE IF NOT EXISTS `appreciationvideo` (
  `idVideo` int(11) NOT NULL,
  `idMembre` int(11) NOT NULL,
  `appreciation` tinyint(1) NOT NULL,
  PRIMARY KEY (`idVideo`,`idMembre`),
  KEY `appreciationVideo_ibfk_2` (`idMembre`)
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
  KEY `catalogue_ibfk_2` (`CategorieFille`)
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
  `idMembre` int(11) NOT NULL,
  `idVideo` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idVideo` (`idVideo`),
  KEY `idVideo_2` (`idVideo`),
  KEY `idUser` (`idMembre`)
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
  `idMembre` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idUsager` (`idMembre`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15 ;

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
  KEY `contient_ibfk_2` (`idEpisode`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `files`
--

DROP TABLE IF EXISTS `files`;
CREATE TABLE IF NOT EXISTS `files` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mime` varchar(255) CHARACTER SET latin1 NOT NULL,
  `data` longblob NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=26 ;

-- --------------------------------------------------------

--
-- Structure de la table `filesmembre`
--

DROP TABLE IF EXISTS `filesmembre`;
CREATE TABLE IF NOT EXISTS `filesmembre` (
  `idMembre` int(10) NOT NULL,
  `idFile` int(10) NOT NULL,
  `date` date DEFAULT NULL,
  PRIMARY KEY (`idMembre`,`idFile`),
  KEY `idFile` (`idFile`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `membre`
--

DROP TABLE IF EXISTS `membre`;
CREATE TABLE IF NOT EXISTS `membre` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(70) NOT NULL,
  `prenom` varchar(140) NOT NULL,
  `image` int(10) DEFAULT NULL,
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
  KEY `idImage` (`image`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=17 ;

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
-- Structure de la table `video`
--

DROP TABLE IF EXISTS `video`;
CREATE TABLE IF NOT EXISTS `video` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `datePublication` date DEFAULT NULL,
  `cover` int(10) DEFAULT NULL,
  `chemin` varchar(210) DEFAULT NULL,
  `titre` varchar(140) NOT NULL,
  `description` text,
  `categorie` varchar(140) NOT NULL,
  `nbrVue` int(14) NOT NULL,
  `idMembre` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idImage` (`cover`),
  KEY `idUser` (`idMembre`),
  KEY `categorie` (`categorie`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `abonner`
--
ALTER TABLE `abonner`
  ADD CONSTRAINT `abonner_ibfk_1` FOREIGN KEY (`idMembre`) REFERENCES `membre` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `abonner_ibfk_2` FOREIGN KEY (`idAbonne`) REFERENCES `membre` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `appreciationcommentaire`
--
ALTER TABLE `appreciationcommentaire`
  ADD CONSTRAINT `appreciationcommentaire_ibfk_1` FOREIGN KEY (`idCommentaire`) REFERENCES `commentaire` (`id`),
  ADD CONSTRAINT `appreciationcommentaire_ibfk_2` FOREIGN KEY (`idMembre`) REFERENCES `membre` (`id`);

--
-- Contraintes pour la table `appreciationvideo`
--
ALTER TABLE `appreciationvideo`
  ADD CONSTRAINT `appreciationvideo_ibfk_1` FOREIGN KEY (`idVideo`) REFERENCES `video` (`id`),
  ADD CONSTRAINT `appreciationvideo_ibfk_2` FOREIGN KEY (`idMembre`) REFERENCES `membre` (`id`);

--
-- Contraintes pour la table `catalogue`
--
ALTER TABLE `catalogue`
  ADD CONSTRAINT `catalogue_ibfk_1` FOREIGN KEY (`CategorieMere`) REFERENCES `categorie` (`titre`),
  ADD CONSTRAINT `catalogue_ibfk_2` FOREIGN KEY (`CategorieFille`) REFERENCES `categorie` (`titre`);

--
-- Contraintes pour la table `commentaire`
--
ALTER TABLE `commentaire`
  ADD CONSTRAINT `commentaire_ibfk_2` FOREIGN KEY (`idVideo`) REFERENCES `video` (`id`),
  ADD CONSTRAINT `commentaire_ibfk_3` FOREIGN KEY (`idMembre`) REFERENCES `membre` (`id`);

--
-- Contraintes pour la table `compte`
--
ALTER TABLE `compte`
  ADD CONSTRAINT `compte_ibfk_1` FOREIGN KEY (`idMembre`) REFERENCES `membre` (`id`);

--
-- Contraintes pour la table `contient`
--
ALTER TABLE `contient`
  ADD CONSTRAINT `contient_ibfk_1` FOREIGN KEY (`idSerie`) REFERENCES `serie` (`id`),
  ADD CONSTRAINT `contient_ibfk_2` FOREIGN KEY (`idEpisode`) REFERENCES `video` (`id`);

--
-- Contraintes pour la table `filesmembre`
--
ALTER TABLE `filesmembre`
  ADD CONSTRAINT `filesmembre_ibfk_2` FOREIGN KEY (`idFile`) REFERENCES `files` (`id`),
  ADD CONSTRAINT `filesmembre_ibfk_1` FOREIGN KEY (`idMembre`) REFERENCES `membre` (`id`);

--
-- Contraintes pour la table `membre`
--
ALTER TABLE `membre`
  ADD CONSTRAINT `membre_ibfk_1` FOREIGN KEY (`image`) REFERENCES `files` (`id`);

--
-- Contraintes pour la table `serie`
--
ALTER TABLE `serie`
  ADD CONSTRAINT `serie_ibfk_1` FOREIGN KEY (`categorie`) REFERENCES `categorie` (`titre`);

--
-- Contraintes pour la table `video`
--
ALTER TABLE `video`
  ADD CONSTRAINT `video_ibfk_1` FOREIGN KEY (`cover`) REFERENCES `files` (`id`),
  ADD CONSTRAINT `video_ibfk_3` FOREIGN KEY (`categorie`) REFERENCES `categorie` (`titre`),
  ADD CONSTRAINT `video_ibfk_4` FOREIGN KEY (`idMembre`) REFERENCES `membre` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
