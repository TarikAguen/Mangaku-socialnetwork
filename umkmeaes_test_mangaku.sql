-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : lun. 18 avr. 2022 à 21:22
-- Version du serveur : 10.3.31-MariaDB
-- Version de PHP : 7.3.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `umkmeaes_test_mangaku`
--

-- --------------------------------------------------------

--
-- Structure de la table `commentaire`
--

CREATE TABLE `commentaire` (
  `id_commentaire` int(11) NOT NULL,
  `id_publication` int(11) NOT NULL,
  `texte_commentaire` varchar(200) NOT NULL,
  `id_membre` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `commentaire`
--

INSERT INTO `commentaire` (`id_commentaire`, `id_publication`, `texte_commentaire`, `id_membre`) VALUES
(31, 63, 'Moi aussi !', 32),
(32, 63, 'Moi aussi !', 1);

-- --------------------------------------------------------

--
-- Structure de la table `followers`
--

CREATE TABLE `followers` (
  `id_membre` int(11) NOT NULL,
  `id_celui_qui_follow` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `followers`
--

INSERT INTO `followers` (`id_membre`, `id_celui_qui_follow`) VALUES
(1, 2),
(2, 1),
(3, 1),
(4, 1),
(1, 6),
(6, 1),
(6, 5),
(5, 6),
(1, 5),
(5, 1),
(9, 1),
(1, 2),
(2, 1),
(3, 1),
(1, 3),
(9, 2),
(9, 3),
(2, 9),
(4, 9),
(2, 14),
(8, 9),
(14, 9),
(19, 9),
(20, 9),
(21, 9),
(18, 17),
(22, 9),
(18, 23),
(24, 9),
(17, 26),
(26, 27),
(31, 32),
(32, 31);

-- --------------------------------------------------------

--
-- Structure de la table `membre`
--

CREATE TABLE `membre` (
  `id_membre` int(11) NOT NULL,
  `prenom` varchar(20) NOT NULL,
  `nom` varchar(20) NOT NULL,
  `sexe` varchar(20) NOT NULL,
  `date_naissance` date NOT NULL,
  `email` varchar(30) NOT NULL,
  `mdp` varchar(1000) NOT NULL,
  `ville` varchar(20) DEFAULT NULL,
  `bio` varchar(1000) DEFAULT NULL,
  `photo_profil` varchar(255) NOT NULL DEFAULT 'inconnu.jpg',
  `photo_couverture` varchar(255) NOT NULL DEFAULT 'inconnucouverture.jpg'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `membre`
--

INSERT INTO `membre` (`id_membre`, `prenom`, `nom`, `sexe`, `date_naissance`, `email`, `mdp`, `ville`, `bio`, `photo_profil`, `photo_couverture`) VALUES
(31, 'Etienne', 'Leroy', 'Male', '1998-08-02', 'geti.leroy@gmail.com', '$2y$10$O5sNG6A4SaP3n7aFSWSjL.MbSZCoLTJRboZcHi311uZNSuC8sFV5.', 'Lesigny', 'Je cherche un stage en développement web', '625db3930cebf.jpg', '625db3b34c811.jpg'),
(32, 'Claude', 'Taffou', 'Male', '1980-01-01', 'taffou@gmail.com', '$2y$10$015XIRONtwaNj6UcyWdqne/Hn4nEwjO.8MSxiNjolX/nfkJF6ZjLm', 'Villiers', NULL, '625db3336b462.jpg', '625db33ede9df.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `message`
--

CREATE TABLE `message` (
  `id_message` int(11) NOT NULL,
  `id_sender` int(11) NOT NULL,
  `id_receveur` int(11) NOT NULL,
  `texte` varchar(50) NOT NULL,
  `date_message` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `publication`
--

CREATE TABLE `publication` (
  `id_publication` int(11) NOT NULL,
  `id_membre` int(11) NOT NULL,
  `titre_publication` varchar(20) NOT NULL,
  `message_publication` varchar(50) NOT NULL,
  `image_publication` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `publication`
--

INSERT INTO `publication` (`id_publication`, `id_membre`, `titre_publication`, `message_publication`, `image_publication`) VALUES
(59, 31, 'Coucou', 'Bienvenu sur mon réseau de manga', '625db3e267c48.jpg'),
(63, 31, 'J aime beaucoup..!', 'One piece !', '625db4821e648.jpg'),
(65, 32, 'Toute une enfance', 'Dragon ball !', '625db505ed2f8.jpg');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `commentaire`
--
ALTER TABLE `commentaire`
  ADD PRIMARY KEY (`id_commentaire`);

--
-- Index pour la table `membre`
--
ALTER TABLE `membre`
  ADD PRIMARY KEY (`id_membre`);

--
-- Index pour la table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id_message`);

--
-- Index pour la table `publication`
--
ALTER TABLE `publication`
  ADD PRIMARY KEY (`id_publication`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `commentaire`
--
ALTER TABLE `commentaire`
  MODIFY `id_commentaire` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT pour la table `membre`
--
ALTER TABLE `membre`
  MODIFY `id_membre` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT pour la table `message`
--
ALTER TABLE `message`
  MODIFY `id_message` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `publication`
--
ALTER TABLE `publication`
  MODIFY `id_publication` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
