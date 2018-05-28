-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  ven. 25 mai 2018 à 13:22
-- Version du serveur :  10.1.30-MariaDB
-- Version de PHP :  7.2.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `onetodo`
--

-- --------------------------------------------------------

--
-- Structure de la table `access`
--

CREATE TABLE `access` (
  `id_user` int(11) NOT NULL,
  `id_project` int(11) NOT NULL,
  `access` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `access`
--

INSERT INTO `access` (`id_user`, `id_project`, `access`) VALUES
(74, 1, 1),
(74, 2, 2);

-- --------------------------------------------------------

--
-- Structure de la table `associate`
--

CREATE TABLE `associate` (
  `id_task` int(11) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `discussion`
--

CREATE TABLE `discussion` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `seen` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `discussion`
--

INSERT INTO `discussion` (`id`, `id_user`, `seen`) VALUES
(0, 74, 0),
(1, 74, 0),
(2, 74, 0),
(3, 1, 0);

-- --------------------------------------------------------

--
-- Structure de la table `message`
--

CREATE TABLE `message` (
  `id_discussion` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `content` text NOT NULL,
  `date_reception` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `message`
--

INSERT INTO `message` (`id_discussion`, `id_user`, `content`, `date_reception`) VALUES
(0, 0, 'test message 1', '2018-05-25 13:13:00'),
(0, 0, 'Test message 2', '2018-05-26 05:09:00'),
(0, 0, 'Test message 3', '2018-05-26 10:09:00'),
(0, 0, 'fdsfd', '2018-05-16 00:00:00'),
(0, 0, 'fdsfdsfsd', '2018-05-26 00:00:00');

-- --------------------------------------------------------

--
-- Structure de la table `project`
--

CREATE TABLE `project` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `color` varchar(10) DEFAULT NULL,
  `description` text,
  `wiki` longtext
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `project`
--

INSERT INTO `project` (`id`, `name`, `status`, `color`, `description`, `wiki`) VALUES
(1, 'Projet test', 0, NULL, NULL, NULL),
(2, 'Projet bis', 0, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `task`
--

CREATE TABLE `task` (
  `id` int(11) NOT NULL,
  `id_todolist` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text,
  `limit_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `todolist`
--

CREATE TABLE `todolist` (
  `id` int(11) NOT NULL,
  `id_project` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `confirm_register` tinyint(1) NOT NULL DEFAULT '0',
  `token` varchar(32) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `username`, `email`, `password`, `confirm_register`, `token`) VALUES
(0, 'test', 'fdsfsd', 'fdsfds', 1, NULL),
(1, 'Rorothejedi', 'rodolphe.cabotiau@laposte.com', '1324', 1, NULL),
(74, 'Rodolphe', 'rodolphe.cabotiau@gmail.com', '$2y$10$Pxoclzi9KZaD23ZwYNyfbeEMFuy1BXeUd5Udyt9uaRIkHiPwiDm/u', 1, NULL),
(75, 'toto', 'r.cabotiau@intech-sud.fr', '$2y$10$94o2joSgjEVuWKu/ZuP/cuPODgaCavKWJRLoR5zN7yFJi37V91cbG', 1, NULL);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `access`
--
ALTER TABLE `access`
  ADD KEY `FK_id_user` (`id_user`),
  ADD KEY `FK_id_project` (`id_project`);

--
-- Index pour la table `associate`
--
ALTER TABLE `associate`
  ADD KEY `id_task` (`id_task`),
  ADD KEY `id_user` (`id_user`);

--
-- Index pour la table `discussion`
--
ALTER TABLE `discussion`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`);

--
-- Index pour la table `message`
--
ALTER TABLE `message`
  ADD KEY `id_discussion` (`id_discussion`),
  ADD KEY `id_user` (`id_user`);

--
-- Index pour la table `project`
--
ALTER TABLE `project`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Index pour la table `task`
--
ALTER TABLE `task`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_todolist` (`id_todolist`);

--
-- Index pour la table `todolist`
--
ALTER TABLE `todolist`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`),
  ADD KEY `id_project` (`id_project`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `discussion`
--
ALTER TABLE `discussion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `project`
--
ALTER TABLE `project`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `task`
--
ALTER TABLE `task`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `todolist`
--
ALTER TABLE `todolist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `access`
--
ALTER TABLE `access`
  ADD CONSTRAINT `FK_id_project_access` FOREIGN KEY (`id_project`) REFERENCES `project` (`id`),
  ADD CONSTRAINT `FK_id_user_access` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `associate`
--
ALTER TABLE `associate`
  ADD CONSTRAINT `FK_id_task_associate` FOREIGN KEY (`id_task`) REFERENCES `task` (`id`),
  ADD CONSTRAINT `FK_id_user_associate` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `discussion`
--
ALTER TABLE `discussion`
  ADD CONSTRAINT `FK_id_user_discussion` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `message`
--
ALTER TABLE `message`
  ADD CONSTRAINT `FK_id_message_discussion` FOREIGN KEY (`id_discussion`) REFERENCES `discussion` (`id`),
  ADD CONSTRAINT `FK_id_message_user` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `task`
--
ALTER TABLE `task`
  ADD CONSTRAINT `FK_id_task_todolist` FOREIGN KEY (`id_todolist`) REFERENCES `todolist` (`id`);

--
-- Contraintes pour la table `todolist`
--
ALTER TABLE `todolist`
  ADD CONSTRAINT `FK_id_todolist_project` FOREIGN KEY (`id_project`) REFERENCES `project` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
