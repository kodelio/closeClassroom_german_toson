-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Mar 02 Février 2016 à 14:31
-- Version du serveur :  5.6.17
-- Version de PHP :  5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `german_toson_webserv`
--

-- --------------------------------------------------------

--
-- Structure de la table `follow_promotion`
--

CREATE TABLE IF NOT EXISTS `follow_promotion` (
  `user` int(11) NOT NULL,
  `promotion` int(11) NOT NULL,
  UNIQUE KEY `user` (`user`,`promotion`),
  KEY `promotion` (`promotion`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Structure de la table `practices`
--

CREATE TABLE IF NOT EXISTS `practices` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(256) COLLATE utf8_bin NOT NULL,
  `path` varchar(256) COLLATE utf8_bin NOT NULL,
  `user` int(11) NOT NULL,
  `description` text COLLATE utf8_bin NOT NULL,
  `date` varchar(12) COLLATE utf8_bin NOT NULL,
  `file` varchar(256) COLLATE utf8_bin NOT NULL,
  `subject` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user` (`user`),
  KEY `subject` (`subject`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=48 ;

--
-- Contenu de la table `practices`
--

INSERT INTO `practices` (`id`, `name`, `path`, `user`, `description`, `date`, `file`, `subject`) VALUES
(45, 'lol', 'webserv/practices/pratiques_02-01-2016_admin.pdf', 1, 'fegr', '02-01-2016', 'pratiques_02-01-2016_admin.pdf', 1);

-- --------------------------------------------------------

--
-- Structure de la table `promotion`
--

CREATE TABLE IF NOT EXISTS `promotion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(32) COLLATE utf8_bin NOT NULL,
  `description` varchar(256) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=2 ;

--
-- Contenu de la table `promotion`
--

INSERT INTO `promotion` (`id`, `name`, `description`) VALUES
(1, 'S3 Alt', '3e semestre DUT Informatique en alternance');

-- --------------------------------------------------------

--
-- Structure de la table `subject`
--

CREATE TABLE IF NOT EXISTS `subject` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(32) COLLATE utf8_bin NOT NULL,
  `description` varchar(256) COLLATE utf8_bin NOT NULL,
  `promotion` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=2 ;

--
-- Contenu de la table `subject`
--

INSERT INTO `subject` (`id`, `name`, `description`, `promotion`) VALUES
(1, 'Maths', 'Maths S3 Alt', 0);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(32) COLLATE utf8_bin NOT NULL,
  `login` varchar(32) COLLATE utf8_bin NOT NULL,
  `password` varchar(32) COLLATE utf8_bin NOT NULL,
  `email` varchar(32) COLLATE utf8_bin NOT NULL,
  `name` varchar(32) COLLATE utf8_bin NOT NULL,
  `first_name` varchar(32) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `login` (`login`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=8 ;

--
-- Contenu de la table `users`
--

INSERT INTO `users` (`id`, `type`, `login`, `password`, `email`, `name`, `first_name`) VALUES
(1, 'Admin', 'admin', 'toto', 'admin@gmail.com', 'admin', 'admin'),
(2, 'Professeur', 'Laurent', 'tata', 'laurentt96@outlook.fr', 'TOSON', 'Laurent'),
(3, 'Etudiant', 'Arnaud', 'titi', 'arnaud.german@gmail.com', 'GERMAN', 'Arnaud'),
(7, 'Etudiant', 'test2', 'test', 'test@gmail.com', 'test', 'test');

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `follow_promotion`
--
ALTER TABLE `follow_promotion`
  ADD CONSTRAINT `follow_promotion_ibfk_1` FOREIGN KEY (`user`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `follow_promotion_ibfk_2` FOREIGN KEY (`promotion`) REFERENCES `promotion` (`id`);

--
-- Contraintes pour la table `practices`
--
ALTER TABLE `practices`
  ADD CONSTRAINT `practices_ibfk_1` FOREIGN KEY (`user`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `practices_ibfk_2` FOREIGN KEY (`subject`) REFERENCES `subject` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
