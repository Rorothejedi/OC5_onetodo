-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  Dim 03 juin 2018 à 20:40
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
(74, 2, 2),
(74, 19, 1),
(74, 29, 1),
(74, 31, 1),
(1, 2, 3),
(77, 2, 3),
(77, 19, 2),
(75, 19, 3),
(74, 33, 1),
(79, 34, 1),
(79, 35, 1),
(74, 34, 3),
(75, 34, 2),
(79, 19, 2),
(79, 31, 3);

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
(68),
(69),
(70),
(71),
(72),
(73),
(74),
(75),
(76),
(77),
(78),
(79),
(80),
(81),
(82),
(83),
(84),
(85),
(86),
(87),
(88),
(89);

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
(33, 68, 74, 'SAlut !', '2018-05-29 11:18:39'),
(34, 68, 74, 'Comment Ã§a va ?', '2018-05-29 11:18:47'),
(35, 68, 74, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptates vitae voluptatem et alias, excepturi, asperiores mollitia deserunt sit blanditiis totam temporibus quam necessitatibus exercitationem, repellat ex atque nihil. Porro, nobis!', '2018-05-29 11:19:00'),
(36, 68, 74, 'test', '2018-05-29 11:33:44'),
(37, 68, 74, 'blabla', '2018-05-29 12:10:10'),
(38, 75, 74, 'Salut !', '2018-05-29 12:28:20'),
(39, 75, 74, 'Comment Ã§a va ?', '2018-05-29 12:28:28'),
(40, 76, 74, 'Salut les gars !', '2018-05-29 12:39:58'),
(41, 76, 74, 'Comment allez-vous ?', '2018-05-29 12:40:05'),
(42, 77, 74, 'Comment Ã§a se passe toto ?', '2018-05-29 12:40:35'),
(43, 78, 74, 'Coucou !', '2018-05-29 12:40:58'),
(44, 79, 79, 'Salut ! Ca va bien ?', '2018-05-29 12:45:32'),
(45, 79, 74, 'Oui, bien ! \r\nEt toi ?', '2018-05-29 12:46:44'),
(46, 79, 79, 'Pas trop mal ;-)', '2018-05-29 12:50:32'),
(47, 82, 74, 'test', '2018-05-29 15:51:33'),
(48, 83, 74, 'Salut !', '2018-06-01 11:51:02');

-- --------------------------------------------------------

--
-- Structure de la table `project`
--

CREATE TABLE `project` (
  `id` int(11) NOT NULL,
  `name` varchar(40) NOT NULL,
  `link` varchar(40) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `open` int(1) DEFAULT NULL,
  `color` varchar(10) DEFAULT '#306ba2',
  `description` tinytext,
  `wiki` longtext
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `project`
--

INSERT INTO `project` (`id`, `name`, `link`, `status`, `open`, `color`, `description`, `wiki`) VALUES
(2, 'Projet bis', 'projet-bis', 0, NULL, '#306ba2', NULL, NULL),
(19, 'The harmony project', 'the-harmony-project', 1, 1, '#ff8000', 'The most beautiful project in the world !', NULL),
(29, 'Projet test', 'projet-test', 0, NULL, '#008080', 'Je test absolument tout ici !', '<p style=\"text-align: center;\"><span style=\"font-size: 18pt;\">Partie 1 - Wiki</span></p>\r\n<p style=\"text-align: justify;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptate in, dolorem aut soluta hic, beatae expedita vel enim illo qui mollitia officia atque doloremque sapiente eius optio adipisci sed nobis.Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptate in, dolorem aut soluta hic, beatae expedita vel enim illo qui mollitia officia atque doloremque sapiente eius optio adipisci sed nobis.Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptate in, dolorem aut soluta hic, beatae expedita vel enim illo qui mollitia officia atque doloremque sapiente eius optio adipisci sed nobis.Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptate in, dolorem aut soluta hic, beatae expedita vel enim illo qui mollitia officia atque doloremque sapiente eius optio adipisci sed nobis.</p>\r\n<blockquote>\r\n<p style=\"padding-left: 30px;\"><em>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptate in, dolorem aut soluta hic, beatae expedita vel enim illo qui mollitia officia atque doloremque sapiente eius optio adipisci sed nobis.</em></p>\r\n<p style=\"padding-left: 30px;\"><em>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptate in, dolorem aut soluta hic, beatae expedita vel enim illo qui mollitia officia atque doloremque sapiente eius optio adipisci sed nobis.</em></p>\r\n<p style=\"padding-left: 30px;\"><em>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptate in, dolorem aut soluta hic, beatae expedita vel enim illo qui mollitia officia atque doloremque sapiente eius optio adipisci sed nobis.</em></p>\r\n<p style=\"padding-left: 30px;\"><em>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptate in, dolorem aut soluta hic, beatae expedita vel enim illo qui mollitia officia atque doloremque sapiente eius optio adipisci sed nobis.</em></p>\r\n</blockquote>\r\n<p style=\"padding-left: 30px;\">&nbsp;</p>\r\n<hr />\r\n<p>&nbsp;</p>\r\n<p style=\"text-align: center;\"><span style=\"font-size: 18pt;\">Partie 2 - Le wiki deux</span></p>\r\n<ul>\r\n<li>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptate in, dolorem aut soluta hic, beatae expedita vel enim illo qui mollitia officia atque doloremque sapiente eius optio adipisci sed nobis.<br /><br /></li>\r\n<li>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptate in, dolorem aut soluta hic, beatae expedita vel enim illo qui mollitia officia atque doloremque sapiente eius optio adipisci sed nobis.<br /><br /></li>\r\n<li>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptate in, dolorem aut soluta hic, beatae expedita vel enim illo qui mollitia officia atque doloremque sapiente eius optio adipisci sed nobis.</li>\r\n</ul>'),
(30, 'Projet observation', 'projet-observation', 0, NULL, '#008000', NULL, NULL),
(31, 'Projet 123', 'projet-123', 1, 0, '#306ba2', 'description', NULL),
(32, 'gfgfdgf', 'gfgfdgf', 0, NULL, '#808000', NULL, NULL),
(33, 'Open project test', 'open-project-test', 1, 1, '#306ba2', NULL, NULL),
(34, 'HappyTest project', 'happytest-project', 1, 1, '#008080', 'Test pour les projets ouverts comme contributeur !', NULL),
(35, 'Test open project 2.0', 'test-open-project-2.0', 1, 0, '#ff8040', 'Test pour les projets ouverts comme observateur !', NULL);

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
(68, 1, 0),
(69, 74, 1),
(70, 74, 1),
(71, 74, 1),
(72, 74, 1),
(73, 74, 1),
(74, 74, 1),
(75, 77, 0),
(76, 74, 1),
(76, 77, 0),
(76, 1, 0),
(77, 74, 1),
(77, 75, 0),
(78, 78, 0),
(77, 1, 1),
(79, 79, 1),
(79, 74, 1),
(80, 74, 1),
(81, 74, 1),
(82, 1, 0),
(83, 74, 1),
(83, 1, 0),
(76, 78, 1),
(84, 74, 1),
(84, 77, 1),
(85, 74, 1),
(85, 77, 1),
(86, 74, 1),
(86, 77, 1),
(87, 74, 1),
(88, 74, 1),
(88, 77, 1),
(89, 74, 1),
(89, 77, 1);

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
(78, 'pastest', 'pastest@email.com', 'fdsfdsfdsfsdf', 0, NULL),
(79, 'HappyTest', 'happytest@email.com', '$2y$10$xcEI3WrrFAjMcjdAIHjDFO0z4LOHlcO6FrfJDJ1DZqM16OrQeh67m', 1, NULL);

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
  ADD UNIQUE KEY `name` (`name`),
  ADD UNIQUE KEY `link` (`link`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;

--
-- AUTO_INCREMENT pour la table `message`
--
ALTER TABLE `message`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT pour la table `project`
--
ALTER TABLE `project`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `access`
--
ALTER TABLE `access`
  ADD CONSTRAINT `FK_id_project_access` FOREIGN KEY (`id_project`) REFERENCES `project` (`id`) ON DELETE CASCADE,
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
