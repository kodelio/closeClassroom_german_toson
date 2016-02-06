-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Sam 06 Février 2016 à 16:46
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
-- Structure de la table `assomoduleformation`
--

CREATE TABLE IF NOT EXISTS `assomoduleformation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_formation` int(11) NOT NULL,
  `id_module` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_formation` (`id_formation`,`id_module`),
  KEY `id_module` (`id_module`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=4 ;

--
-- Contenu de la table `assomoduleformation`
--

INSERT INTO `assomoduleformation` (`id`, `id_formation`, `id_module`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 2, 1);

-- --------------------------------------------------------

--
-- Structure de la table `assouserformation`
--

CREATE TABLE IF NOT EXISTS `assouserformation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `id_formation` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_user` (`id_user`),
  KEY `id_formation` (`id_formation`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=4 ;

--
-- Contenu de la table `assouserformation`
--

INSERT INTO `assouserformation` (`id`, `id_user`, `id_formation`) VALUES
(1, 3, 1),
(2, 2, 1),
(3, 2, 2);

-- --------------------------------------------------------

--
-- Structure de la table `formations`
--

CREATE TABLE IF NOT EXISTS `formations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) COLLATE utf8_bin NOT NULL,
  `description` varchar(255) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=3 ;

--
-- Contenu de la table `formations`
--

INSERT INTO `formations` (`id`, `name`, `description`) VALUES
(1, 'DUT Informatique', 'DUT en informatique sur 2 ans'),
(2, 'Terminale STI2D', 'Option SIN');

-- --------------------------------------------------------

--
-- Structure de la table `modules`
--

CREATE TABLE IF NOT EXISTS `modules` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=3 ;

--
-- Contenu de la table `modules`
--

INSERT INTO `modules` (`id`, `name`) VALUES
(1, 'Maths'),
(2, 'Programmation Serveur Web');

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
  `id_module` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user` (`user`),
  KEY `module` (`id_module`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=2 ;

--
-- Contenu de la table `practices`
--

INSERT INTO `practices` (`id`, `name`, `path`, `user`, `description`, `date`, `file`, `id_module`) VALUES
(1, 'Pratiques', 'webserv/practices/pratiques_02-01-2016_admin.pdf', 2, 'Cours sur les bonnes pratiques du web', '02-01-2016', 'pratiques_02-01-2016_admin.pdf', 1);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=4 ;

--
-- Contenu de la table `users`
--

INSERT INTO `users` (`id`, `type`, `login`, `password`, `email`, `name`, `first_name`) VALUES
(1, 'Admin', 'admin', 'admin', 'contact@laurent-toson.fr', 'admin', 'admin'),
(2, 'Professeur', 'laurent', 'laurent', 'laurentt96@outlook.fr', 'TOSON', 'Laurent'),
(3, 'Etudiant', 'arnaud', 'arnaud', 'arnaud.german@gmail.com', 'GERMAN', 'Arnaud');

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `assomoduleformation`
--
ALTER TABLE `assomoduleformation`
  ADD CONSTRAINT `formation_id` FOREIGN KEY (`id_formation`) REFERENCES `formations` (`id`),
  ADD CONSTRAINT `module_id` FOREIGN KEY (`id_module`) REFERENCES `modules` (`id`);

--
-- Contraintes pour la table `assouserformation`
--
ALTER TABLE `assouserformation`
  ADD CONSTRAINT `formation_asso` FOREIGN KEY (`id_formation`) REFERENCES `formations` (`id`),
  ADD CONSTRAINT `user_asso` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`);

--
-- Contraintes pour la table `practices`
--
ALTER TABLE `practices`
  ADD CONSTRAINT `id_user` FOREIGN KEY (`user`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `id_module` FOREIGN KEY (`id_module`) REFERENCES `modules` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
