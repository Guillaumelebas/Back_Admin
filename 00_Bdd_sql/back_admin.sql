-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Client :  127.0.0.1
-- Généré le :  Ven 12 Janvier 2018 à 13:02
-- Version du serveur :  10.1.21-MariaDB
-- Version de PHP :  5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `php`
--

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

CREATE TABLE `categories` (
  `cat_id` int(11) NOT NULL,
  `cat_nom` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `cat_visuel` varchar(100) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'default-categorie.png',
  `cat_active` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `categories`
--

INSERT INTO `categories` (`cat_id`, `cat_nom`, `cat_visuel`, `cat_active`) VALUES
(2, 'Categorie Méduse', 'categorie_2.jpg', 1),
(3, 'Categorie Pas Active', 'default-categorie.png', 0);

-- --------------------------------------------------------

--
-- Structure de la table `contenus`
--

CREATE TABLE `contenus` (
  `cont_id` int(11) NOT NULL,
  `cont_title` varchar(255) NOT NULL,
  `cont_subtitle` varchar(255) NOT NULL,
  `cont_shorttext` varchar(255) NOT NULL,
  `cont_longtext` text NOT NULL,
  `cont_active` tinyint(1) NOT NULL,
  `cont_cat_id` int(11) DEFAULT NULL,
  `cont_visuel1` varchar(50) NOT NULL,
  `cont_visuel2` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `contenus`
--

INSERT INTO `contenus` (`cont_id`, `cont_title`, `cont_subtitle`, `cont_shorttext`, `cont_longtext`, `cont_active`, `cont_cat_id`, `cont_visuel1`, `cont_visuel2`) VALUES
(1, 'Contenus', 'Contenus', 'TEXT COURT', 'Text long', 1, 2, 'content_1.png', 'content2_1.png');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `usr_id` int(11) NOT NULL,
  `usr_nom` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `usr_prenom` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `usr_log` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `usr_pass` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `usr_mail` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `usr_avatar` varchar(100) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'avatar.png',
  `usr_role` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `users`
--

INSERT INTO `users` (`usr_id`, `usr_nom`, `usr_prenom`, `usr_log`, `usr_pass`, `usr_mail`, `usr_avatar`, `usr_role`) VALUES
(1, 'Le Bas', 'Guillaume', 'guilbs', '5f4dcc3b5aa765d61d8327deb882cf99', 'Guillaume-lebas@hotmail.com', 'avatar.png', 0),
(16, 'Admin', 'Admin', 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin@admin.com', 'avatar.png', 1);

--
-- Index pour les tables exportées
--

--
-- Index pour la table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`cat_id`);

--
-- Index pour la table `contenus`
--
ALTER TABLE `contenus`
  ADD PRIMARY KEY (`cont_id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`usr_id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `categories`
--
ALTER TABLE `categories`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT pour la table `contenus`
--
ALTER TABLE `contenus`
  MODIFY `cont_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `usr_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
