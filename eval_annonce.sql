-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : lun. 01 fév. 2021 à 16:16
-- Version du serveur :  10.4.14-MariaDB
-- Version de PHP : 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `eval_annonce`
--

-- --------------------------------------------------------

--
-- Structure de la table `comments`
--

CREATE TABLE `comments` (
  `comment_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `pseudo` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `text` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `mobilier_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `comments`
--

INSERT INTO `comments` (`comment_id`, `user_id`, `pseudo`, `text`, `created_at`, `mobilier_id`) VALUES
(1, 0, 'Jack', 'salut', '2021-01-25 14:32:50', 4),
(5, 0, 'Oui', 'eeijei', '2021-01-25 14:58:04', 4),
(6, 0, 'thththt', 'hththt', '2021-01-26 08:56:39', 4),
(7, 0, 'thththtgrgrgr', 'hththtgegegeg', '2021-01-26 09:01:39', 4),
(8, 0, 'TouKTouK', 'J&#39;aime bin', '2021-01-26 09:10:25', 2),
(9, 4, 'Yep', 'ta', '2021-01-28 08:59:32', 4);

-- --------------------------------------------------------

--
-- Structure de la table `mobiliers`
--

CREATE TABLE `mobiliers` (
  `mobilier_id` int(11) NOT NULL,
  `modele` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `couleur` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `taille` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` float NOT NULL,
  `added_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `mobiliers`
--

INSERT INTO `mobiliers` (`mobilier_id`, `modele`, `couleur`, `taille`, `type`, `price`, `added_at`, `user_id`) VALUES
(2, 'oeokekoeko', 'okgrokgr', 'ogkrogrkgr', 'ogkrkogr', 15, '2021-01-25 12:42:39', 4),
(4, 'Salut', 'rose', '19x3539', 'cool', 0, '2021-01-25 12:28:42', 4),
(5, 'Jean Jean', 'Rouge', '179x300', 'Humain', 69, '2021-01-29 09:05:24', 4),
(6, 'Louis', 'vert', '186cm', 'pute', 0.2, '2021-01-29 10:14:43', 5);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `adresse` varchar(255) NOT NULL,
  `code_postal` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `role` enum('Author','Admin') DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`user_id`, `username`, `nom`, `prenom`, `adresse`, `code_postal`, `email`, `role`, `password`, `created_at`, `updated_at`) VALUES
(1, 'Samba', '', '', '', '', 'samba@exemple.com', 'Admin', 'admin', '2021-01-13 11:52:58', '2021-01-13 11:52:58'),
(2, 'jack', '', '', '', '', 'jack@gmail.com', 'Admin', '$2y$10$HfbfegiGbMPymPWMWO.mueBhgGU.baRFo5HQEFCKktji4BPDgNGkG', '2021-01-19 08:17:16', NULL),
(3, 'bibou', '', '', '', '', 'bibou@gmail.com', NULL, '$2y$10$l8xoUWl8AqLT2WKmJ8S0j.1R/3WRAWIKpSfzqty/hNkw.KOV87F5i', '2021-01-19 09:13:51', NULL),
(4, 'Jacky', 'Lecomte', 'Jacky', '3 rue magenta', '78000', 'jacky@gmail.com', NULL, '$2y$10$ZTmTmwDcH0XJ6ow3umuVOevuSfmrDyX.uAw/pdWfe3/sYMZd/EyFq', '2021-01-20 13:16:18', NULL),
(5, 'ee', 'e', 'e', 'e', '45000', 'e@e.e', NULL, '$2y$10$48YEcwW3gYCuDub5iBJrCeqxg3/FEr80xZ0zMo.TYZySAuarc3WAK', '2021-01-29 10:12:59', NULL);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`),
  ADD KEY `mobilier_id` (`mobilier_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Index pour la table `mobiliers`
--
ALTER TABLE `mobiliers`
  ADD UNIQUE KEY `id_mobilier` (`mobilier_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `mobiliers`
--
ALTER TABLE `mobiliers`
  MODIFY `mobilier_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `mobilier_id` FOREIGN KEY (`mobilier_id`) REFERENCES `mobiliers` (`mobilier_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `mobiliers`
--
ALTER TABLE `mobiliers`
  ADD CONSTRAINT `user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
