-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  ven. 08 mars 2019 à 18:36
-- Version du serveur :  5.7.17
-- Version de PHP :  5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `boutique`
--

-- --------------------------------------------------------

--
-- Structure de la table `adresse`
--

CREATE TABLE `adresse` (
  `idAdresse` mediumint(9) NOT NULL,
  `sRue` varchar(100) CHARACTER SET latin1 NOT NULL,
  `sVille` varchar(50) CHARACTER SET latin1 NOT NULL,
  `sPays` varchar(50) CHARACTER SET latin1 NOT NULL,
  `sProvince` varchar(50) CHARACTER SET latin1 NOT NULL,
  `sCodePostal` varchar(7) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

CREATE TABLE `categorie` (
  `idCategorie` tinyint(4) NOT NULL,
  `sNomCategorie` varchar(100) CHARACTER SET latin1 NOT NULL,
  `sUrlImg` varchar(200) CHARACTER SET latin1 NOT NULL,
  `sUrlCategorie` varchar(50) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Structure de la table `commande`
--

CREATE TABLE `commande` (
  `idCommande` int(11) NOT NULL,
  `sNumeroCommande` char(12) CHARACTER SET latin1 NOT NULL,
  `sDateCommande` datetime NOT NULL,
  `iNoUtilisateur` int(11) NOT NULL,
  `fFraisLivraison` decimal(7,2) NOT NULL,
  `fTPS` decimal(5,2) NOT NULL,
  `fTVQ` decimal(5,2) NOT NULL,
  `sEtatCommande` enum('reçue','en traitement','expédiée','livrée','annulée') CHARACTER SET latin1 NOT NULL DEFAULT 'reçue',
  `sTrackingNumCommande` varchar(80) CHARACTER SET latin1 NOT NULL,
  `iNoAdresseFacturation` mediumint(9) NOT NULL,
  `iNoAdresseExpedition` mediumint(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Structure de la table `contenucommande`
--

CREATE TABLE `contenucommande` (
  `idContenuCommande` int(11) NOT NULL,
  `iQteProduitCommande` tinyint(4) NOT NULL,
  `fPrixCommande` decimal(7,2) NOT NULL,
  `iNoCommande` int(11) NOT NULL,
  `iNoProduit` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Structure de la table `contenupanier`
--

CREATE TABLE `contenupanier` (
  `idContenuPanier` int(11) NOT NULL,
  `iQteProduit` tinyint(4) NOT NULL,
  `iNoProduit` smallint(6) NOT NULL,
  `iNoPanier` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Structure de la table `imgproduit`
--

CREATE TABLE `imgproduit` (
  `idImgProduit` mediumint(9) NOT NULL,
  `sUrlImg` varchar(10) CHARACTER SET latin1 NOT NULL,
  `iNoProduit` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Structure de la table `panier`
--

CREATE TABLE `panier` (
  `idPanier` int(11) NOT NULL,
  `sNumPanier` char(25) CHARACTER SET latin1 NOT NULL,
  `sDateModification` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Structure de la table `produit`
--

CREATE TABLE `produit` (
  `idProduit` smallint(6) NOT NULL,
  `sSKUProduit` varchar(50) CHARACTER SET latin1 NOT NULL,
  `sNomProduit` varchar(100) CHARACTER SET latin1 NOT NULL,
  `sMarque` varchar(50) CHARACTER SET latin1 NOT NULL,
  `fPrixProduit` decimal(7,2) NOT NULL,
  `fPrixSolde` decimal(7,2) DEFAULT NULL,
  `sDescCourteProduit` varchar(1000) CHARACTER SET latin1 NOT NULL,
  `sDescLongProduit` mediumtext CHARACTER SET latin1,
  `sCouleur` varchar(3000) CHARACTER SET latin1 DEFAULT NULL,
  `sCapacite` varchar(3000) CHARACTER SET latin1 DEFAULT NULL,
  `iNoCategorie` tinyint(4) NOT NULL,
  `sDateAjout` date NOT NULL,
  `bAfficheProduit` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `idUtilisateur` int(11) NOT NULL,
  `sCourriel` varchar(500) CHARACTER SET latin1 NOT NULL,
  `sMotDePasse` varchar(250) CHARACTER SET latin1 NOT NULL,
  `sNumTelephone` varchar(20) CHARACTER SET latin1 NOT NULL,
  `sPrenomUtilisateur` varchar(50) CHARACTER SET latin1 NOT NULL,
  `sNomUtilisateur` varchar(50) CHARACTER SET latin1 NOT NULL,
  `sDateInscription` datetime NOT NULL,
  `iNoAdresse` mediumint(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `adresse`
--
ALTER TABLE `adresse`
  ADD PRIMARY KEY (`idAdresse`);

--
-- Index pour la table `categorie`
--
ALTER TABLE `categorie`
  ADD PRIMARY KEY (`idCategorie`);

--
-- Index pour la table `commande`
--
ALTER TABLE `commande`
  ADD PRIMARY KEY (`idCommande`),
  ADD UNIQUE KEY `idCommande` (`idCommande`),
  ADD UNIQUE KEY `sNumeroCommande` (`sNumeroCommande`),
  ADD KEY `idUtilisateur` (`iNoUtilisateur`),
  ADD KEY `iNoAdresseFacturation` (`iNoAdresseFacturation`),
  ADD KEY `iNoAdresseFacturation_2` (`iNoAdresseFacturation`),
  ADD KEY `iNoAdresseExpedition` (`iNoAdresseExpedition`);

--
-- Index pour la table `contenucommande`
--
ALTER TABLE `contenucommande`
  ADD PRIMARY KEY (`idContenuCommande`),
  ADD KEY `idCommande` (`iNoCommande`),
  ADD KEY `idProduit` (`iNoProduit`);

--
-- Index pour la table `contenupanier`
--
ALTER TABLE `contenupanier`
  ADD PRIMARY KEY (`idContenuPanier`),
  ADD KEY `iNoProduit` (`iNoProduit`),
  ADD KEY `iNoPanier` (`iNoPanier`);

--
-- Index pour la table `imgproduit`
--
ALTER TABLE `imgproduit`
  ADD PRIMARY KEY (`idImgProduit`),
  ADD KEY `iNoProduit` (`iNoProduit`);

--
-- Index pour la table `panier`
--
ALTER TABLE `panier`
  ADD PRIMARY KEY (`idPanier`);

--
-- Index pour la table `produit`
--
ALTER TABLE `produit`
  ADD PRIMARY KEY (`idProduit`),
  ADD KEY `iNoCategorie` (`iNoCategorie`);

--
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`idUtilisateur`),
  ADD KEY `iNoAdresse` (`iNoAdresse`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `adresse`
--
ALTER TABLE `adresse`
  MODIFY `idAdresse` mediumint(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `categorie`
--
ALTER TABLE `categorie`
  MODIFY `idCategorie` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT pour la table `commande`
--
ALTER TABLE `commande`
  MODIFY `idCommande` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `contenucommande`
--
ALTER TABLE `contenucommande`
  MODIFY `idContenuCommande` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `contenupanier`
--
ALTER TABLE `contenupanier`
  MODIFY `idContenuPanier` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `imgproduit`
--
ALTER TABLE `imgproduit`
  MODIFY `idImgProduit` mediumint(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `panier`
--
ALTER TABLE `panier`
  MODIFY `idPanier` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `produit`
--
ALTER TABLE `produit`
  MODIFY `idProduit` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `idUtilisateur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `commande`
--
ALTER TABLE `commande`
  ADD CONSTRAINT `commande_ibfk_1` FOREIGN KEY (`iNoUtilisateur`) REFERENCES `utilisateur` (`idUtilisateur`),
  ADD CONSTRAINT `commande_ibfk_2` FOREIGN KEY (`iNoAdresseFacturation`) REFERENCES `adresse` (`idAdresse`),
  ADD CONSTRAINT `commande_ibfk_3` FOREIGN KEY (`iNoAdresseExpedition`) REFERENCES `adresse` (`idAdresse`);

--
-- Contraintes pour la table `contenucommande`
--
ALTER TABLE `contenucommande`
  ADD CONSTRAINT `contenucommande_ibfk_1` FOREIGN KEY (`iNoCommande`) REFERENCES `commande` (`idCommande`),
  ADD CONSTRAINT `contenucommande_ibfk_2` FOREIGN KEY (`iNoProduit`) REFERENCES `produit` (`idProduit`);

--
-- Contraintes pour la table `contenupanier`
--
ALTER TABLE `contenupanier`
  ADD CONSTRAINT `contenupanier_ibfk_1` FOREIGN KEY (`iNoProduit`) REFERENCES `produit` (`idProduit`),
  ADD CONSTRAINT `contenupanier_ibfk_2` FOREIGN KEY (`iNoPanier`) REFERENCES `panier` (`idPanier`);

--
-- Contraintes pour la table `imgproduit`
--
ALTER TABLE `imgproduit`
  ADD CONSTRAINT `imgproduit_ibfk_1` FOREIGN KEY (`iNoProduit`) REFERENCES `produit` (`idProduit`);

--
-- Contraintes pour la table `produit`
--
ALTER TABLE `produit`
  ADD CONSTRAINT `produit_ibfk_1` FOREIGN KEY (`iNoCategorie`) REFERENCES `categorie` (`idCategorie`);

--
-- Contraintes pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD CONSTRAINT `utilisateur_ibfk_1` FOREIGN KEY (`iNoAdresse`) REFERENCES `adresse` (`idAdresse`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
