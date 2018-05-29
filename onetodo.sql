-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  lun. 28 mai 2018 à 21:42
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
-- Structure de la table `conversation`
--

CREATE TABLE `conversation` (
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `conversation`
--

INSERT INTO `conversation` (`id`) VALUES
(1),
(2),
(3),
(4),
(5),
(6),
(10),
(11),
(12),
(13),
(14),
(15),
(16),
(17),
(18),
(19),
(20),
(21),
(22),
(23),
(24),
(26),
(27),
(28),
(29),
(30),
(31),
(32),
(33),
(34),
(35),
(36),
(37),
(38),
(39),
(40),
(41),
(42),
(43),
(44),
(45),
(46),
(47),
(48),
(49),
(50),
(51),
(52),
(53),
(54),
(55),
(56),
(57),
(58),
(59),
(60),
(61),
(62),
(63),
(64);

-- --------------------------------------------------------

--
-- Structure de la table `message`
--

CREATE TABLE `message` (
  `id` int(11) NOT NULL,
  `id_conversation` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `content` text NOT NULL,
  `date_reception` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `message`
--

INSERT INTO `message` (`id`, `id_conversation`, `id_user`, `content`, `date_reception`) VALUES
(7, 1, 74, 'Test conversation 1 avec Rodolphe !', '2018-05-25 00:00:00'),
(8, 1, 1, 'Test conversation 1 avec Rorothejedi !', '2018-05-23 00:00:00'),
(9, 1, 76, 'Test conversation 1 avec test !', '2018-05-29 00:00:00'),
(10, 3, 74, 'Test conversation 3 avec Rodolphe !', '2018-05-26 14:00:00'),
(11, 3, 75, 'Test conversation 3 avec toto!', '2018-05-31 07:03:00'),
(12, 2, 77, 'Test conversation 2 avec usertest!', '2018-05-31 04:00:00'),
(13, 2, 74, 'Test conversation 2 avec Rodolphe !', '2018-06-06 03:00:00'),
(14, 4, 76, 'Test conversation 4 avec test!', '2018-05-31 00:00:00'),
(15, 4, 77, 'Test conversation 4 avec usertest!', '2018-06-04 05:00:00'),
(16, 1, 77, 'vvfdfsd', '2018-05-17 00:00:00'),
(17, 62, 74, 'test\r\n', '2018-05-28 20:32:38'),
(18, 62, 74, 'test\r\n', '2018-05-28 20:33:24'),
(19, 62, 74, 'Yo les gens !!!', '2018-05-28 20:36:35'),
(20, 62, 74, 'C\'est okkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkk', '2018-05-28 20:36:59'),
(21, 62, 74, 'C\'est oooooooooooooooooooooooooookkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkk\r\ngfgdgdfgdfgfd', '2018-05-28 20:53:27'),
(22, 62, 77, 'fdsfsdfsdfsdfdsf', '2018-06-21 09:00:00'),
(23, 62, 74, 'Ca marche, je suis ok', '2018-05-28 21:15:34'),
(24, 62, 77, 'fdsfsdfsdfsdfdsf', '2018-06-21 09:00:00'),
(25, 63, 74, 'gfdgfdgd', '2018-05-28 21:25:01'),
(26, 63, 1, 'fsdfdsfdsf', '2018-05-28 22:00:00'),
(27, 63, 1, 'gfgdfgdf', '2018-05-28 21:27:47'),
(28, 63, 1, 'gfdgdfgd', '2018-05-28 21:31:27'),
(29, 62, 1, 'fvdfsdfdsf', '2018-05-28 21:32:04'),
(30, 64, 74, 'hghfg', '2018-05-28 21:34:49');

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
-- Structure de la table `seen`
--

CREATE TABLE `seen` (
  `id_conversation` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `seen` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `seen`
--

INSERT INTO `seen` (`id_conversation`, `id_user`, `seen`) VALUES
(1, 74, 1),
(1, 1, 1),
(1, 76, 1),
(3, 74, 1),
(3, 75, 1),
(2, 77, 1),
(2, 74, 1),
(4, 76, 1),
(4, 77, 1),
(1, 77, 1),
(6, 74, 1),
(10, 74, 1),
(11, 75, 1),
(12, 74, 1),
(13, 74, 1),
(14, 74, 1),
(15, 74, 1),
(16, 74, 1),
(17, 74, 1),
(18, 74, 1),
(19, 74, 1),
(20, 74, 1),
(21, 74, 1),
(22, 74, 1),
(23, 74, 1),
(24, 74, 1),
(26, 74, 1),
(27, 74, 1),
(28, 74, 1),
(29, 74, 1),
(30, 74, 1),
(31, 74, 1),
(32, 74, 1),
(33, 74, 1),
(34, 74, 1),
(35, 74, 1),
(36, 74, 1),
(35, 75, 1),
(37, 74, 1),
(38, 74, 1),
(39, 74, 1),
(40, 74, 1),
(41, 74, 1),
(42, 74, 1),
(43, 74, 1),
(44, 74, 1),
(45, 74, 1),
(46, 74, 1),
(47, 74, 1),
(48, 74, 1),
(48, 77, 1),
(49, 74, 1),
(49, 77, 1),
(50, 74, 1),
(50, 77, 1),
(51, 74, 1),
(51, 77, 1),
(52, 74, 1),
(53, 74, 1),
(53, 77, 1),
(54, 74, 1),
(54, 77, 1),
(55, 74, 1),
(55, 77, 1),
(56, 74, 1),
(56, 77, 1),
(57, 74, 1),
(57, 77, 1),
(2, 76, 1),
(2, 1, 1),
(58, 74, 1),
(58, 76, 1),
(59, 74, 1),
(59, 75, 1),
(60, 74, 1),
(61, 74, 1),
(61, 76, 1),
(62, 74, 1),
(62, 77, 0),
(62, 1, 0),
(62, 76, 0),
(63, 74, 0),
(63, 1, 0),
(64, 74, 1),
(64, 1, 1);

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
(1, 'Rorothejedi', 'rodolphe.cabotiau@laposte.com', '1324', 1, NULL),
(74, 'Rodolphe', 'rodolphe.cabotiau@gmail.com', '$2y$10$Pxoclzi9KZaD23ZwYNyfbeEMFuy1BXeUd5Udyt9uaRIkHiPwiDm/u', 1, NULL),
(75, 'toto', 'r.cabotiau@intech-sud.fr', '$2y$10$94o2joSgjEVuWKu/ZuP/cuPODgaCavKWJRLoR5zN7yFJi37V91cbG', 1, NULL),
(76, 'test', 'test@test.com', 'fdsfsdfsdfsd', 0, NULL),
(77, 'usertest', 'usertest@email.com', 'fdsfdsfsd', 0, NULL),
(78, 'pastest', 'pastest@email.com', 'fdsfdsfdsfsdf', 0, NULL);

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
-- Index pour la table `conversation`
--
ALTER TABLE `conversation`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_discussion` (`id_conversation`);

--
-- Index pour la table `project`
--
ALTER TABLE `project`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Index pour la table `seen`
--
ALTER TABLE `seen`
  ADD KEY `id_conversation` (`id_conversation`),
  ADD KEY `id_user` (`id_user`);

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
-- AUTO_INCREMENT pour la table `conversation`
--
ALTER TABLE `conversation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT pour la table `message`
--
ALTER TABLE `message`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

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
-- Contraintes pour la table `message`
--
ALTER TABLE `message`
  ADD CONSTRAINT `FK_id_message_conversation` FOREIGN KEY (`id_conversation`) REFERENCES `conversation` (`id`),
  ADD CONSTRAINT `FK_id_message_user` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `seen`
--
ALTER TABLE `seen`
  ADD CONSTRAINT `FK_id_seen_conversation` FOREIGN KEY (`id_conversation`) REFERENCES `conversation` (`id`),
  ADD CONSTRAINT `FK_id_seen_user` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`);

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
