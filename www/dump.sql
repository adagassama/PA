-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Hôte : database
-- Généré le : jeu. 15 avr. 2021 à 09:11
-- Version du serveur :  5.7.33
-- Version de PHP : 7.4.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Base de données : `mvcdocker2`
--

-- --------------------------------------------------------

--
-- Structure de la table `gkvw0_user`
--

CREATE TABLE `gkvw0_user` (
  `id` int(11) NOT NULL,
  `firstname` varchar(120) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `email` varchar(320) NOT NULL,
  `pwd` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `gkvw0_user`
--
ALTER TABLE `gkvw0_user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `gkvw0_user`
--
ALTER TABLE `gkvw0_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;
