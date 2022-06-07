-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 07, 2022 at 11:04 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `stock_management`
--

-- --------------------------------------------------------

--
-- Table structure for table `depozit`
--

CREATE TABLE `depozit` (
  `idDepozit` int(11) NOT NULL,
  `Activ` tinyint(1) NOT NULL,
  `Denumire` varchar(45) NOT NULL,
  `NrRegistrulComertului` varchar(128) NOT NULL,
  `CodFiscal` varchar(128) NOT NULL,
  `DenumireBanca` varchar(64) NOT NULL,
  `ContIban` varchar(64) NOT NULL,
  `Oras` varchar(45) DEFAULT NULL,
  `Strada` varchar(45) DEFAULT NULL,
  `Numar` varchar(45) DEFAULT NULL,
  `Bloc` varchar(64) DEFAULT NULL,
  `Scara` varchar(64) DEFAULT NULL,
  `Apartament` varchar(64) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `depozit`
--

INSERT INTO `depozit` (`idDepozit`, `Activ`, `Denumire`, `NrRegistrulComertului`, `CodFiscal`, `DenumireBanca`, `ContIban`, `Oras`, `Strada`, `Numar`, `Bloc`, `Scara`, `Apartament`) VALUES
(1, 1, 'Deposit 1 S.R.L.', 'J24/2673/1994', '6859662', 'Banca Transilvani S.A.', '1B31007593840000', 'Sibiu', 'Stefan cel Mare', '10', 'T1', NULL, '30'),
(14, 1, 'Depozit 2', '123456789123456', '123456789123456', '123456789123456', '123456789123456', 'Vaidei', 'Nr1', '13', 'D2', NULL, '50');

-- --------------------------------------------------------

--
-- Table structure for table `partener`
--

CREATE TABLE `partener` (
  `idPartener` int(11) NOT NULL,
  `Activ` tinyint(1) NOT NULL,
  `Denumire` varchar(45) NOT NULL,
  `NrRegistrulComertului` varchar(128) NOT NULL,
  `CodFiscal` varchar(128) NOT NULL,
  `DenumireBanca` varchar(64) NOT NULL,
  `ContIban` varchar(64) NOT NULL,
  `Oras` varchar(45) DEFAULT NULL,
  `Strada` varchar(45) DEFAULT NULL,
  `Numar` varchar(45) DEFAULT NULL,
  `Bloc` varchar(64) DEFAULT NULL,
  `Scara` varchar(64) DEFAULT NULL,
  `Apartament` varchar(64) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `partener`
--

INSERT INTO `partener` (`idPartener`, `Activ`, `Denumire`, `NrRegistrulComertului`, `CodFiscal`, `DenumireBanca`, `ContIban`, `Oras`, `Strada`, `Numar`, `Bloc`, `Scara`, `Apartament`) VALUES
(3, 1, 'Altex S.R.L.', 'J24/2673/1994', '6859662', 'BRD S.R.L.', '1B31007593840000', 'Sibiu', 'Mihai Viteazu', '1', 'D2', NULL, '50');

-- --------------------------------------------------------

--
-- Table structure for table `produs`
--

CREATE TABLE `produs` (
  `idProdus` int(11) NOT NULL,
  `Activ` tinyint(1) NOT NULL,
  `Serial` varchar(64) NOT NULL,
  `Brand` varchar(45) DEFAULT NULL,
  `Model` varchar(45) DEFAULT NULL,
  `Pret` varchar(45) DEFAULT NULL,
  `Descriere` varchar(512) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `produs`
--

INSERT INTO `produs` (`idProdus`, `Activ`, `Serial`, `Brand`, `Model`, `Pret`, `Descriere`) VALUES
(8, 1, '00020130913', 'Samsung', 'Galaxy A22', '829', 'In urmatoarea generatie de retea de date mobile, puterea 5G a vitezei rapide schimba modul in care experimentezi si partajezi continut - de la redare continut si jocuri foarte cursive, pana la partajare si descarcare foarte rapida. Fa un upgrade catre noul Galaxy A22 5G si accelereazaexperienta utilizarii smartphone-ului tau.'),
(9, 1, '4CE0460D0G', 'Apple', 'iPhone 13 Pro', '5399', 'Ecran Super Retina XDR cu ProMotion pentru imagini fluide si reactii prompte. Upgrade substantial al sistemului de camere pentru noi posibilitati spectaculoase. Durabilitate exceptionala. Cip ultra rapid A15 Bionic. Autonomie senzationala a bateriei. Pe scurt, Pro.'),
(10, 1, 'BA-999999-201~9', 'Huawei', 'Nova 9', '1549', 'Bucura-te de finisajul dublu al telefonului HUAWEI nova 9 si de corpul ultra-subtire si usor de 175 g, usor de tinut in mana. Inelul emblematic aduce posibilitati infinite si un plus de incantare in fiecare moment.');

-- --------------------------------------------------------

--
-- Table structure for table `produs_tranzactie`
--

CREATE TABLE `produs_tranzactie` (
  `idProdus_Tranzactie` int(11) NOT NULL,
  `idTranzactie` int(11) NOT NULL,
  `idProdus` int(11) DEFAULT NULL,
  `Cantitate` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `produs_tranzactie`
--

INSERT INTO `produs_tranzactie` (`idProdus_Tranzactie`, `idTranzactie`, `idProdus`, `Cantitate`) VALUES
(16, 2, 9, 8),
(18, 2, 9, 1000);

-- --------------------------------------------------------

--
-- Table structure for table `rol`
--

CREATE TABLE `rol` (
  `idRol` int(11) NOT NULL,
  `Denumire` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rol`
--

INSERT INTO `rol` (`idRol`, `Denumire`) VALUES
(1, 'Administrator'),
(2, 'Utilizator');

-- --------------------------------------------------------

--
-- Table structure for table `stoc`
--

CREATE TABLE `stoc` (
  `idStoc` int(11) NOT NULL,
  `idDepozit` int(11) NOT NULL,
  `idProdus` int(11) NOT NULL,
  `Cantitate` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `stoc`
--

INSERT INTO `stoc` (`idStoc`, `idDepozit`, `idProdus`, `Cantitate`) VALUES
(17, 1, 8, 16),
(22, 14, 8, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tranzactie`
--

CREATE TABLE `tranzactie` (
  `idTranzactie` int(11) NOT NULL,
  `idDepozit` int(11) NOT NULL,
  `idPartener` int(11) NOT NULL,
  `tipTranzactie` varchar(64) NOT NULL,
  `Data` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tranzactie`
--

INSERT INTO `tranzactie` (`idTranzactie`, `idDepozit`, `idPartener`, `tipTranzactie`, `Data`) VALUES
(2, 1, 3, 'Sell', '0000-00-00'),
(10, 1, 3, 'Sell', '2022-05-30');

-- --------------------------------------------------------

--
-- Table structure for table `utilizator`
--

CREATE TABLE `utilizator` (
  `idUtilizator` int(11) NOT NULL,
  `idDepozit` int(11) NOT NULL,
  `idRol` int(11) NOT NULL,
  `Nume` varchar(45) DEFAULT NULL,
  `Prenume` varchar(45) DEFAULT NULL,
  `Email` varchar(45) NOT NULL,
  `Parola` varchar(512) NOT NULL,
  `DataNastere` varchar(45) DEFAULT NULL,
  `Telefon` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `utilizator`
--

INSERT INTO `utilizator` (`idUtilizator`, `idDepozit`, `idRol`, `Nume`, `Prenume`, `Email`, `Parola`, `DataNastere`, `Telefon`) VALUES
(20, 1, 1, 'Carabet', 'Razvan-Bogdan', 'bogdanrazvan00@yahoo.com', 'a80b568a237f50391d2f1f97beaf99564e33d2e1c8a2e5cac21ceda701570312', '2000-05-19', '0749389157'),
(22, 1, 2, 'Carabet', 'Razvan', 'user@gmail.com', 'a80b568a237f50391d2f1f97beaf99564e33d2e1c8a2e5cac21ceda701570312', '2022-05-11', '0749389157');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `depozit`
--
ALTER TABLE `depozit`
  ADD PRIMARY KEY (`idDepozit`);

--
-- Indexes for table `partener`
--
ALTER TABLE `partener`
  ADD PRIMARY KEY (`idPartener`);

--
-- Indexes for table `produs`
--
ALTER TABLE `produs`
  ADD PRIMARY KEY (`idProdus`);

--
-- Indexes for table `produs_tranzactie`
--
ALTER TABLE `produs_tranzactie`
  ADD PRIMARY KEY (`idProdus_Tranzactie`),
  ADD KEY `idTranzactie` (`idTranzactie`),
  ADD KEY `idProdus` (`idProdus`) USING BTREE;

--
-- Indexes for table `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`idRol`);

--
-- Indexes for table `stoc`
--
ALTER TABLE `stoc`
  ADD PRIMARY KEY (`idStoc`),
  ADD KEY `iidProdus_idx` (`idProdus`),
  ADD KEY `idDepozit` (`idDepozit`);

--
-- Indexes for table `tranzactie`
--
ALTER TABLE `tranzactie`
  ADD PRIMARY KEY (`idTranzactie`),
  ADD KEY `idPartener_idx` (`idPartener`),
  ADD KEY `idDepozit` (`idDepozit`);

--
-- Indexes for table `utilizator`
--
ALTER TABLE `utilizator`
  ADD PRIMARY KEY (`idUtilizator`),
  ADD KEY `idx_utilizator_idDepozit` (`idDepozit`),
  ADD KEY `idx_utilizator_idRol` (`idRol`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `depozit`
--
ALTER TABLE `depozit`
  MODIFY `idDepozit` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `partener`
--
ALTER TABLE `partener`
  MODIFY `idPartener` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `produs`
--
ALTER TABLE `produs`
  MODIFY `idProdus` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `produs_tranzactie`
--
ALTER TABLE `produs_tranzactie`
  MODIFY `idProdus_Tranzactie` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `rol`
--
ALTER TABLE `rol`
  MODIFY `idRol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `stoc`
--
ALTER TABLE `stoc`
  MODIFY `idStoc` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `tranzactie`
--
ALTER TABLE `tranzactie`
  MODIFY `idTranzactie` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `utilizator`
--
ALTER TABLE `utilizator`
  MODIFY `idUtilizator` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `produs_tranzactie`
--
ALTER TABLE `produs_tranzactie`
  ADD CONSTRAINT `produs_tranzactie_ibfk_1` FOREIGN KEY (`idTranzactie`) REFERENCES `tranzactie` (`idTranzactie`),
  ADD CONSTRAINT `produs_tranzactie_ibfk_2` FOREIGN KEY (`idProdus`) REFERENCES `produs` (`idProdus`);

--
-- Constraints for table `stoc`
--
ALTER TABLE `stoc`
  ADD CONSTRAINT `idProdus` FOREIGN KEY (`idProdus`) REFERENCES `produs` (`idProdus`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `stoc_ibfk_1` FOREIGN KEY (`idDepozit`) REFERENCES `depozit` (`idDepozit`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tranzactie`
--
ALTER TABLE `tranzactie`
  ADD CONSTRAINT `idPartener` FOREIGN KEY (`idPartener`) REFERENCES `partener` (`idPartener`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `tranzactie_ibfk_1` FOREIGN KEY (`idDepozit`) REFERENCES `depozit` (`idDepozit`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `utilizator`
--
ALTER TABLE `utilizator`
  ADD CONSTRAINT `utilizator_ibfk_1` FOREIGN KEY (`idDepozit`) REFERENCES `depozit` (`idDepozit`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `utilizator_ibfk_2` FOREIGN KEY (`idRol`) REFERENCES `rol` (`idRol`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
