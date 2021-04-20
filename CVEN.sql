-- phpMyAdmin SQL Dump
-- version 4.6.6deb5ubuntu0.5
-- https://www.phpmyadmin.net/
--
-- Client :  localhost:3306
-- Généré le :  Mar 20 Avril 2021 à 13:24
-- Version du serveur :  5.7.32-0ubuntu0.18.04.1
-- Version de PHP :  7.2.24-0ubuntu0.18.04.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `CVEN`
--

-- --------------------------------------------------------

--
-- Structure de la table `CLIENT`
--

CREATE TABLE `CLIENT` (
  `id_Client` int(11) NOT NULL,
  `NomClient` varchar(50) NOT NULL,
  `PrenomClient` varchar(50) NOT NULL,
  `Login` varchar(50) NOT NULL,
  `Motdepasse` varchar(50) NOT NULL,
  `Mail` varchar(50) NOT NULL,
  `admin` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `CLIENT`
--

INSERT INTO `CLIENT` (`id_Client`, `NomClient`, `PrenomClient`, `Login`, `Motdepasse`, `Mail`, `admin`) VALUES
(1, 'DENOYELLES', 'Damien', 'DamienDENOYELLES', '62f8b274bc3230946371ff5dc9a1d5ac', '', 0),
(2, 'DARCHY', 'Teo', 'TeoDARCHY', '38db103ddfd2861369a048e24d3159b7', '', 0),
(6, 'admin', 'admin', 'Admin', 'cc03e747a6afbbcbf8be7668acfebee5', 'denoyelles.damien@gmail.com', 1),
(7, 'gautier', 'tiffany', 'gautier', '58a15a19f0a3319b3bc0faef992c7cc7', 'tiffany.gautier77@gmail.com', 0),
(9, 'root', 'root', 'root', 'cc03e747a6afbbcbf8be7668acfebee5', 'root@gmail.com', 0);

-- --------------------------------------------------------

--
-- Structure de la table `Evenements`
--

CREATE TABLE `Evenements` (
  `Id` int(11) NOT NULL,
  `Date_reserv` date NOT NULL,
  `Date_debut` date NOT NULL,
  `Date_depart` date NOT NULL,
  `Description` varchar(50) NOT NULL,
  `Type` varchar(50) NOT NULL,
  `Organisateur` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `Evenements`
--

INSERT INTO `Evenements` (`Id`, `Date_reserv`, `Date_debut`, `Date_depart`, `Description`, `Type`, `Organisateur`) VALUES
(2, '2021-04-14', '2021-09-13', '2021-09-14', 'Anniv Damien !', 'Groupe', 'DamienDENOYELLES'),
(3, '2021-04-14', '2021-05-14', '2021-05-14', 'Grosse soirée', 'Groupe', 'DamienDENOYELLES'),
(4, '2021-04-14', '2021-05-15', '2021-05-16', 'Descritpion', 'Congrès', 'root'),
(5, '2021-04-14', '2021-05-10', '2021-05-30', 'Examens !! ', 'Séminaire', 'DamienDENOYELLES');

-- --------------------------------------------------------

--
-- Structure de la table `HEBERGEMENT`
--

CREATE TABLE `HEBERGEMENT` (
  `Num_Hebergement` int(11) NOT NULL,
  `Nom_Logement` varchar(50) NOT NULL,
  `Num_Type_Hebergement` int(11) NOT NULL,
  `Description` text,
  `Nb_Pers_Max` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `HEBERGEMENT`
--

INSERT INTO `HEBERGEMENT` (`Num_Hebergement`, `Nom_Logement`, `Num_Type_Hebergement`, `Description`, `Nb_Pers_Max`) VALUES
(3, 'Chambre 4 Personnes', 1, 'Entrée, Douche et wc, 2 Chambres à 2 lits avec coin toilette et balcon', 4),
(4, 'Chambre 2 Personnes', 1, 'Entrée, Douche et wc, 1 lit double', 2),
(5, 'Chambre 3 Personnes', 1, '3 lits séparés par une cloison mobile avec coin toilette, wc, douche', 3),
(6, 'Chambre 4 Personnes', 1, '4 lits séparés par une cloison mobile avec douche, wc et balcon', 4),
(7, 'Chambre 4 Personnes', 1, 'logement adapté pour les personnes à mobilité réduite', 4);

-- --------------------------------------------------------

--
-- Structure de la table `reserv`
--

CREATE TABLE `reserv` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` text NOT NULL,
  `start` datetime DEFAULT NULL,
  `end` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `reserv`
--

INSERT INTO `reserv` (`id`, `name`, `description`, `start`, `end`) VALUES
(1, 'Teo chambre + hotel', 'test reserv ', '2021-04-05 15:00:00', '2021-04-06 22:15:00'),
(2, 'test2', 'test2', '2021-04-05 10:00:00', '2021-04-05 15:00:00'),
(3, 'test3', 'test3', '2021-04-06 10:00:00', '2021-04-06 20:00:00');

-- --------------------------------------------------------

--
-- Structure de la table `RESERVATION`
--

CREATE TABLE `RESERVATION` (
  `id_Reservation` int(11) NOT NULL,
  `Date_Arrivee` date NOT NULL,
  `Date_Depart` date NOT NULL,
  `date-reserv` date DEFAULT NULL,
  `Pension` varchar(50) NOT NULL,
  `Menage` varchar(50) NOT NULL,
  `Nb_Personnes` int(11) NOT NULL,
  `Tarif_Sejour` float NOT NULL,
  `Etat_Reservation` tinyint(50) NOT NULL,
  `id_Client` int(11) NOT NULL,
  `Num_Hebergement` int(11) NOT NULL,
  `Num_Type_Hebergement` int(11) NOT NULL,
  `Situation` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `RESERVATION`
--

INSERT INTO `RESERVATION` (`id_Reservation`, `Date_Arrivee`, `Date_Depart`, `date-reserv`, `Pension`, `Menage`, `Nb_Personnes`, `Tarif_Sejour`, `Etat_Reservation`, `id_Client`, `Num_Hebergement`, `Num_Type_Hebergement`, `Situation`) VALUES
(8, '2021-02-13', '2021-02-27', NULL, ' Demi_Pension', 'avec', 1, 520, 1, 1, 4, 1, 3),
(9, '2021-02-20', '2021-02-27', NULL, ' Demi_Pension', 'avec', 1, 520, 1, 1, 3, 1, 2),
(12, '2021-02-06', '2021-02-20', '2021-02-23', ' Pension_complète', 'avec', 3, 520, 1, 2, 4, 1, 3),
(22, '2021-03-13', '2021-03-20', '2021-03-30', ' Demi_Pension', 'sans', 1, 520, 1, 6, 3, 1, 2),
(24, '2021-02-27', '2021-03-13', '2021-03-30', ' Demi_Pension', 'avec', 1, 520, 1, 6, 3, 1, 3),
(25, '2021-03-20', '2021-03-27', '2021-03-30', ' Demi_Pension', 'avec', 1, 520, 1, 6, 4, 1, 2),
(26, '2021-04-03', '2021-04-10', '2021-04-06', ' Pension_complète', 'avec', 2, 520, 1, 1, 4, 1, 2),
(29, '2021-04-03', '2021-04-17', '2021-04-07', ' Demi_Pension', 'avec', 1, 520, 1, 6, 3, 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `TYPE_HEBERGEMENT`
--

CREATE TABLE `TYPE_HEBERGEMENT` (
  `Num_Type_Hebergement` int(11) NOT NULL,
  `Type_Hebergement` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Description` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Nb_Chambres` int(11) NOT NULL,
  `Tarif` float NOT NULL,
  `Lien_Photo` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Note` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Contenu de la table `TYPE_HEBERGEMENT`
--

INSERT INTO `TYPE_HEBERGEMENT` (`Num_Type_Hebergement`, `Type_Hebergement`, `Description`, `Nb_Chambres`, `Tarif`, `Lien_Photo`, `Note`) VALUES
(1, 'Site du Jura', 'Chalet d\'epoque', 4, 520, 'Hotel1.jpg', '5'),
(2, 'Chalêt individuel', 'Maison d\'hote', 2, 300, 'Hotel2.jpg', '3'),
(3, 'Appartement', 'appartement 4eme etage', 3, 250, 'Hotel3.jpg', '2'),
(4, 'Hotel Trivago', 'Hotel avec piscine', 3, 500, 'Hotel4.JPG', '4');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `CLIENT`
--
ALTER TABLE `CLIENT`
  ADD PRIMARY KEY (`id_Client`);

--
-- Index pour la table `Evenements`
--
ALTER TABLE `Evenements`
  ADD PRIMARY KEY (`Id`);

--
-- Index pour la table `HEBERGEMENT`
--
ALTER TABLE `HEBERGEMENT`
  ADD PRIMARY KEY (`Num_Hebergement`),
  ADD KEY `HEBERGEMENT_TYPE_HEBERGEMENT_FK` (`Num_Type_Hebergement`);

--
-- Index pour la table `reserv`
--
ALTER TABLE `reserv`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `RESERVATION`
--
ALTER TABLE `RESERVATION`
  ADD PRIMARY KEY (`id_Reservation`),
  ADD KEY `RESERVATION_CLIENT_FK` (`id_Client`),
  ADD KEY `RESERVATION_HEBERGEMENT0_FK` (`Num_Hebergement`),
  ADD KEY `RESERVATION_TYPE_HEBERGEMENT1_FK` (`Num_Type_Hebergement`);

--
-- Index pour la table `TYPE_HEBERGEMENT`
--
ALTER TABLE `TYPE_HEBERGEMENT`
  ADD PRIMARY KEY (`Num_Type_Hebergement`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `CLIENT`
--
ALTER TABLE `CLIENT`
  MODIFY `id_Client` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT pour la table `Evenements`
--
ALTER TABLE `Evenements`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT pour la table `HEBERGEMENT`
--
ALTER TABLE `HEBERGEMENT`
  MODIFY `Num_Hebergement` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT pour la table `reserv`
--
ALTER TABLE `reserv`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `RESERVATION`
--
ALTER TABLE `RESERVATION`
  MODIFY `id_Reservation` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
--
-- AUTO_INCREMENT pour la table `TYPE_HEBERGEMENT`
--
ALTER TABLE `TYPE_HEBERGEMENT`
  MODIFY `Num_Type_Hebergement` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `HEBERGEMENT`
--
ALTER TABLE `HEBERGEMENT`
  ADD CONSTRAINT `HEBERGEMENT_TYPE_HEBERGEMENT_FK` FOREIGN KEY (`Num_Type_Hebergement`) REFERENCES `TYPE_HEBERGEMENT` (`Num_Type_Hebergement`);

--
-- Contraintes pour la table `RESERVATION`
--
ALTER TABLE `RESERVATION`
  ADD CONSTRAINT `RESERVATION_CLIENT_FK` FOREIGN KEY (`id_Client`) REFERENCES `CLIENT` (`id_Client`),
  ADD CONSTRAINT `RESERVATION_HEBERGEMENT0_FK` FOREIGN KEY (`Num_Hebergement`) REFERENCES `HEBERGEMENT` (`Num_Hebergement`),
  ADD CONSTRAINT `RESERVATION_TYPE_HEBERGEMENT1_FK` FOREIGN KEY (`Num_Type_Hebergement`) REFERENCES `TYPE_HEBERGEMENT` (`Num_Type_Hebergement`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
