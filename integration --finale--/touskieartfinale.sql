-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : dim. 30 avr. 2023 à 20:15
-- Version du serveur : 10.4.27-MariaDB
-- Version de PHP : 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `touskieartfinale`
--

-- --------------------------------------------------------

--
-- Structure de la table `avis`
--

CREATE TABLE `avis` (
  `idAvis` int(11) NOT NULL,
  `idProduit` int(11) NOT NULL,
  `contenu` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

CREATE TABLE `categorie` (
  `idCategorie` int(11) NOT NULL,
  `libcategorie` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `categorie_loc`
--

CREATE TABLE `categorie_loc` (
  `codeC_loc` int(11) NOT NULL,
  `libelleC_loc` varchar(255) NOT NULL,
  `color` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `categorie_loc`
--

INSERT INTO `categorie_loc` (`codeC_loc`, `libelleC_loc`, `color`) VALUES
(0, 'yyy', '#ff8040'),
(777, 'en plein air', '#ff0080');

-- --------------------------------------------------------

--
-- Structure de la table `commande`
--

CREATE TABLE `commande` (
  `id_c` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `user` varchar(255) NOT NULL,
  `statue` varchar(255) NOT NULL,
  `remise` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `commande`
--

INSERT INTO `commande` (`id_c`, `date`, `user`, `statue`, `remise`) VALUES
(20, '2023-04-24 09:19:00', '34', 'placed', 10),
(21, '2023-04-24 09:19:52', '34', 'approved', 0),
(23, '2023-04-29 17:54:00', '6', 'approved', 0),
(24, '2023-04-29 17:54:00', '6', 'approved', 0),
(25, '2023-04-29 16:23:45', '34', 'pending', 0),
(26, '2023-04-29 16:30:44', '34', 'pending', 0),
(27, '2023-04-29 16:30:57', '34', 'pending', 0),
(28, '2023-04-29 16:31:22', '34', 'pending', 0),
(29, '2023-04-29 16:32:44', '34', 'pending', 0),
(30, '2023-04-29 16:35:21', '34', 'pending', 0),
(31, '2023-04-29 16:36:25', '34', 'pending', 0),
(32, '2023-04-29 16:38:11', '34', 'pending', 0);

-- --------------------------------------------------------

--
-- Structure de la table `commande_item`
--

CREATE TABLE `commande_item` (
  `id` int(11) NOT NULL,
  `produit` int(11) DEFAULT NULL,
  `commande` int(11) DEFAULT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `commande_item`
--

INSERT INTO `commande_item` (`id`, `produit`, `commande`, `quantity`) VALUES
(32, 2, 3, 2),
(33, 1, 9, 4),
(34, 2, 10, 1),
(35, 2, 11, 1),
(36, 2, 12, 1),
(37, 1, 13, 5),
(38, 2, 13, 4),
(39, 2, 14, 1),
(40, 2, 16, 7),
(41, 1, 17, 1),
(42, 1, 18, 1),
(43, 1, 3, 1),
(44, 1, 10, 1),
(46, 2, 20, 2);

-- --------------------------------------------------------

--
-- Structure de la table `commentaire`
--

CREATE TABLE `commentaire` (
  `id_user` int(11) NOT NULL,
  `id_com` int(11) NOT NULL,
  `commentaire` varchar(255) NOT NULL,
  `id_event` int(11) NOT NULL,
  `LikeCount` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `commentaire`
--

INSERT INTO `commentaire` (`id_user`, `id_com`, `commentaire`, `id_event`, `LikeCount`) VALUES
(35, 2, 'waw nice event! <3', 4, 0);

-- --------------------------------------------------------

--
-- Structure de la table `event`
--

CREATE TABLE `event` (
  `event_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `startDate` date NOT NULL,
  `endDate` date NOT NULL,
  `status` varchar(255) NOT NULL,
  `ticketCount` int(11) NOT NULL,
  `host_id` int(11) NOT NULL,
  `location_id` int(11) NOT NULL,
  `affiche` varchar(255) NOT NULL,
  `ticketPrice` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `event`
--

INSERT INTO `event` (`event_id`, `title`, `type`, `description`, `startDate`, `endDate`, `status`, `ticketCount`, `host_id`, `location_id`, `affiche`, `ticketPrice`) VALUES
(3, 'titletitletitle', 'titletitletitle', 'titletitletitletitletitletitle', '2023-04-26', '2023-04-30', '', 554, 34, 70, 'imgMe-6449a402bf623.png', 100),
(4, 'La Fiesta', 'Outdoors', 'Hello world', '2023-04-13', '2023-04-16', '', 200331, 26, 8915, 'profile-pic-644ea4cc9ebf9.jpg', 15);

-- --------------------------------------------------------

--
-- Structure de la table `eventreaction`
--

CREATE TABLE `eventreaction` (
  `event_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `reaction` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `invite`
--

CREATE TABLE `invite` (
  `inv_id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `inviter_id` int(11) NOT NULL,
  `artiste_id` int(11) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='table_invitation ';

-- --------------------------------------------------------

--
-- Structure de la table `like_comment`
--

CREATE TABLE `like_comment` (
  `id_like` int(11) NOT NULL,
  `id_com` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `etat` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `livraison`
--

CREATE TABLE `livraison` (
  `id` int(11) NOT NULL,
  `commande` int(11) DEFAULT NULL,
  `adresse` varchar(255) NOT NULL,
  `date` datetime NOT NULL,
  `confirmer` tinyint(1) NOT NULL,
  `email` varchar(255) NOT NULL,
  `prix` double NOT NULL,
  `numtel` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `location`
--

CREATE TABLE `location` (
  `num_loc` int(11) NOT NULL,
  `descipt_loc` text NOT NULL,
  `lieu_loc` varchar(255) NOT NULL,
  `surface_loc` float NOT NULL,
  `nb_pers_loc` int(11) NOT NULL,
  `prix_loc` float NOT NULL,
  `equipements` varchar(1900) DEFAULT NULL,
  `disponibilite` varchar(255) NOT NULL,
  `date_Aloc` date NOT NULL,
  `code_catg` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `location`
--

INSERT INTO `location` (`num_loc`, `descipt_loc`, `lieu_loc`, `surface_loc`, `nb_pers_loc`, `prix_loc`, `equipements`, `disponibilite`, `date_Aloc`, `code_catg`, `user_id`, `image`) VALUES
(70, 'zzzzz', 'zzzz', 89, 45, 5200.4, 'dc,csd', 'oui', '2023-04-29', 777, 26, 'esprit-644d2089e4045393393040.jfif'),
(8909, 'local xxxx', 'kkkk', 88, 55, 1.2, 'oui', 'oui', '2023-04-23', 777, 26, 'image-10-6444938b91eb6117941468.jpg'),
(8910, 'yyyy', 'yyy', 1.2, 555, 1.2, 'yyy', 'oui', '2023-04-04', 777, 26, ''),
(8911, 'yyy', 'yyyy', 88, 55, 555, 'uuu', 'oui', '2023-04-11', 0, 26, ''),
(8913, 'local chic', 'ben arous', 598.2, 451, 5200.4, 'table,service', 'non', '2023-04-30', 777, 26, 'profile-pic-644ea47847435647832395.jpg'),
(8914, 'local clame', 'bizerte rue x', 300.1, 555, 5.2, 'tables,chaises', 'oui', '2023-04-29', 777, 26, '3-644d21790e308474442668.jfif'),
(8915, 'local', 'Ben Arous', 10000000, 5555, 500, 'oui', 'oui', '2023-04-30', 777, 31, 'profile-pic-644ea35926fb7119643160.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `messenger_messages`
--

CREATE TABLE `messenger_messages` (
  `id` bigint(20) NOT NULL,
  `body` longtext NOT NULL,
  `headers` longtext NOT NULL,
  `queue_name` varchar(190) NOT NULL,
  `created_at` datetime NOT NULL,
  `available_at` datetime NOT NULL,
  `delivered_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `produit`
--

CREATE TABLE `produit` (
  `id` int(11) NOT NULL,
  `CodeProduit` varchar(255) NOT NULL,
  `Des` varchar(255) NOT NULL,
  `QteStock` int(11) NOT NULL,
  `QteMin` int(11) NOT NULL,
  `PrixUnitaire` int(11) NOT NULL,
  `idUnite` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `idcat` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `produit`
--

INSERT INTO `produit` (`id`, `CodeProduit`, `Des`, `QteStock`, `QteMin`, `PrixUnitaire`, `idUnite`, `image`, `idcat`) VALUES
(1, 'mmmm', 'mmmmm', 4, 12, 123, '45', '644d293f3b313.jpg', 'kkkkk'),
(2, 'eeeee', '55', 55, 12, 4, '45', '644d298d8e84c.jpg', 'eeeeee');

-- --------------------------------------------------------

--
-- Structure de la table `reclamation`
--

CREATE TABLE `reclamation` (
  `rec_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `titre_rec` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `dateCreation` date NOT NULL,
  `dateFin` date DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'Ouvert'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `reclamation`
--

INSERT INTO `reclamation` (`rec_id`, `user_id`, `titre_rec`, `type`, `description`, `dateCreation`, `dateFin`, `status`) VALUES
(185, 36, 'aaaaaaa', 'Evénement', 'aaaaaaaaaaa', '2023-04-30', '2023-04-30', 'Fermée');

-- --------------------------------------------------------

--
-- Structure de la table `redection`
--

CREATE TABLE `redection` (
  `coder` varchar(255) NOT NULL,
  `valr` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `reponses`
--

CREATE TABLE `reponses` (
  `rep_id` int(11) NOT NULL,
  `rec_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `admin_id` int(11) DEFAULT NULL,
  `rep_description` longtext NOT NULL,
  `date_rep` date NOT NULL DEFAULT current_timestamp(),
  `isAdminReponse` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `reponses`
--

INSERT INTO `reponses` (`rep_id`, `rec_id`, `user_id`, `admin_id`, `rep_description`, `date_rep`, `isAdminReponse`) VALUES
(623, 185, 31, NULL, 'aaaaaaaaaaaaaaaaaaaa', '2023-04-30', 1);

-- --------------------------------------------------------

--
-- Structure de la table `ticket`
--

CREATE TABLE `ticket` (
  `ticket_id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `price` float NOT NULL,
  `qrCodeImg` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='table_ticket';

--
-- Déchargement des données de la table `ticket`
--

INSERT INTO `ticket` (`ticket_id`, `event_id`, `user_id`, `price`, `qrCodeImg`) VALUES
(4, 3, 26, 100, 'qr code img path'),
(5, 4, 34, 15, 'QR Code'),
(6, 4, 34, 15, 'QR Code');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mdp` varchar(255) NOT NULL,
  `tel` int(11) NOT NULL,
  `image` longtext NOT NULL,
  `role` varchar(50) NOT NULL,
  `etat` varchar(50) NOT NULL DEFAULT 'activé'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='table utilisateur';

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id_user`, `nom`, `prenom`, `email`, `mdp`, `tel`, `image`, `role`, `etat`) VALUES
(26, 'Achref', 'Boussada', 'email@gmail.com', '123', 12345678, 'imgMe-6449760a87b3c.png', 'Admin', 'activé'),
(31, 'Achref', 'Boussada', 'admin@gmail.com', '123', 12345678, 'imgMe-6449760a87b3c.png', 'Admin', 'activé'),
(34, 'Mahmoud', 'Mzoughi', 'mahmoudmzoughi@gmail.com', '123', 12345678, 'imgMe-6449a16cef6bf.png', 'simple utilisateur', 'activé'),
(35, 'Mehrez', 'Ayo', 'm@m.com', '123', 12345678, 'profile-pic-644eaa72dc72c.jpg', 'simple utilisateur', 'activé'),
(36, 'sylas', 'garen', 'hmaidi185@gmail.com', 'azerty', 58229725, 'profile-pic-644eaaa92401e.jpg', 'simple utilisateur', 'activé');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `avis`
--
ALTER TABLE `avis`
  ADD PRIMARY KEY (`idAvis`),
  ADD KEY `fk_idProduit` (`idProduit`);

--
-- Index pour la table `categorie`
--
ALTER TABLE `categorie`
  ADD PRIMARY KEY (`idCategorie`);

--
-- Index pour la table `categorie_loc`
--
ALTER TABLE `categorie_loc`
  ADD PRIMARY KEY (`codeC_loc`);

--
-- Index pour la table `commande`
--
ALTER TABLE `commande`
  ADD PRIMARY KEY (`id_c`);

--
-- Index pour la table `commande_item`
--
ALTER TABLE `commande_item`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_747724FD29A5EC27` (`produit`),
  ADD KEY `IDX_747724FD6EEAA67D` (`commande`);

--
-- Index pour la table `commentaire`
--
ALTER TABLE `commentaire`
  ADD PRIMARY KEY (`id_com`),
  ADD KEY `fk_user_com` (`id_user`),
  ADD KEY `fk_user_event` (`id_event`);

--
-- Index pour la table `event`
--
ALTER TABLE `event`
  ADD PRIMARY KEY (`event_id`),
  ADD KEY `host_fk` (`host_id`),
  ADD KEY `fk_locid` (`location_id`);

--
-- Index pour la table `eventreaction`
--
ALTER TABLE `eventreaction`
  ADD PRIMARY KEY (`event_id`,`user_id`),
  ADD KEY `user_id_fk` (`user_id`);

--
-- Index pour la table `invite`
--
ALTER TABLE `invite`
  ADD PRIMARY KEY (`inv_id`),
  ADD KEY `fk_event_in` (`event_id`),
  ADD KEY `fk_inviter` (`inviter_id`),
  ADD KEY `fk_artiste` (`artiste_id`);

--
-- Index pour la table `like_comment`
--
ALTER TABLE `like_comment`
  ADD PRIMARY KEY (`id_like`),
  ADD KEY `fk_iduser` (`id_user`),
  ADD KEY `fk_id_com` (`id_com`);

--
-- Index pour la table `livraison`
--
ALTER TABLE `livraison`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_A60C9F1F6EEAA67D` (`commande`);

--
-- Index pour la table `location`
--
ALTER TABLE `location`
  ADD PRIMARY KEY (`num_loc`),
  ADD KEY `fk_codeC` (`code_catg`),
  ADD KEY `fk_user` (`user_id`);

--
-- Index pour la table `messenger_messages`
--
ALTER TABLE `messenger_messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_75EA56E0FB7336F0` (`queue_name`),
  ADD KEY `IDX_75EA56E0E3BD61CE` (`available_at`),
  ADD KEY `IDX_75EA56E016BA31DB` (`delivered_at`);

--
-- Index pour la table `produit`
--
ALTER TABLE `produit`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `reclamation`
--
ALTER TABLE `reclamation`
  ADD PRIMARY KEY (`rec_id`),
  ADD KEY `fk_userid_rec` (`user_id`);

--
-- Index pour la table `redection`
--
ALTER TABLE `redection`
  ADD PRIMARY KEY (`coder`);

--
-- Index pour la table `reponses`
--
ALTER TABLE `reponses`
  ADD PRIMARY KEY (`rep_id`),
  ADD KEY `fk_rec_id_reponse` (`rec_id`),
  ADD KEY `fk_userid_reponse` (`user_id`);

--
-- Index pour la table `ticket`
--
ALTER TABLE `ticket`
  ADD PRIMARY KEY (`ticket_id`),
  ADD KEY `iduser_foreign` (`user_id`),
  ADD KEY `event_fk` (`event_id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `avis`
--
ALTER TABLE `avis`
  MODIFY `idAvis` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `categorie`
--
ALTER TABLE `categorie`
  MODIFY `idCategorie` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `commande`
--
ALTER TABLE `commande`
  MODIFY `id_c` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT pour la table `commande_item`
--
ALTER TABLE `commande_item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT pour la table `commentaire`
--
ALTER TABLE `commentaire`
  MODIFY `id_com` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `event`
--
ALTER TABLE `event`
  MODIFY `event_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `invite`
--
ALTER TABLE `invite`
  MODIFY `inv_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `like_comment`
--
ALTER TABLE `like_comment`
  MODIFY `id_like` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `livraison`
--
ALTER TABLE `livraison`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `location`
--
ALTER TABLE `location`
  MODIFY `num_loc` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8916;

--
-- AUTO_INCREMENT pour la table `messenger_messages`
--
ALTER TABLE `messenger_messages`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

--
-- AUTO_INCREMENT pour la table `produit`
--
ALTER TABLE `produit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `reclamation`
--
ALTER TABLE `reclamation`
  MODIFY `rec_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=186;

--
-- AUTO_INCREMENT pour la table `reponses`
--
ALTER TABLE `reponses`
  MODIFY `rep_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=624;

--
-- AUTO_INCREMENT pour la table `ticket`
--
ALTER TABLE `ticket`
  MODIFY `ticket_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `avis`
--
ALTER TABLE `avis`
  ADD CONSTRAINT `fk_idProduit` FOREIGN KEY (`idProduit`) REFERENCES `produit` (`id`);

--
-- Contraintes pour la table `commentaire`
--
ALTER TABLE `commentaire`
  ADD CONSTRAINT `fk_user_com` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_user_event` FOREIGN KEY (`id_event`) REFERENCES `event` (`event_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `eventreaction`
--
ALTER TABLE `eventreaction`
  ADD CONSTRAINT `event_id_fk` FOREIGN KEY (`event_id`) REFERENCES `event` (`event_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_id_fk` FOREIGN KEY (`user_id`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
