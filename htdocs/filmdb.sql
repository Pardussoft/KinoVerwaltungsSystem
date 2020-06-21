-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 11 Mar 2020, 09:21:13
-- Sunucu sürümü: 10.3.15-MariaDB
-- PHP Sürümü: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `filmdb`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `eintrittskarte`
--

CREATE TABLE `eintrittskarte` (
  `KartenNr` int(11) NOT NULL,
  `Preis` int(11) NOT NULL,
  `VorfuhrungID` int(11) NOT NULL,
  `SitzID` int(11) NOT NULL,
  `VkID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_german2_ci;

--
-- Tablo döküm verisi `eintrittskarte`
--

INSERT INTO `eintrittskarte` (`KartenNr`, `Preis`, `VorfuhrungID`, `SitzID`, `VkID`) VALUES
(1, 10, 4, 3, 12),
(2, 10, 4, 58, 12),
(3, 10, 4, 59, 12),
(4, 10, 4, 73, 13),
(5, 10, 4, 74, 13),
(6, 10, 4, 91, 14),
(7, 10, 4, 92, 14),
(8, 10, 4, 60, 15),
(11, 10, 4, 71, 18),
(13, 10, 4, 102, 20),
(15, 10, 4, 72, 22),
(16, 10, 4, 89, 23),
(17, 10, 4, 94, 24),
(18, 10, 4, 103, 25),
(19, 10, 4, 110, 26),
(20, 10, 4, 111, 27),
(21, 10, 4, 90, 28),
(22, 10, 4, 118, 29),
(23, 10, 4, 70, 30),
(24, 10, 9, 57, 31),
(25, 10, 9, 56, 32),
(26, 10, 4, 61, 33),
(27, 6, 8, 144, 34),
(28, 6, 8, 145, 34),
(29, 6, 8, 135, 35),
(30, 6, 8, 136, 35),
(31, 6, 10, 7, 36),
(32, 6, 10, 8, 36),
(33, 10, 4, 62, 37),
(34, 10, 4, 63, 37),
(35, 10, 6, 6, 38),
(36, 10, 6, 49, 38),
(37, 10, 6, 50, 38),
(38, 10, 10, 152, 39),
(39, 10, 10, 153, 39),
(40, 10, 10, 154, 39),
(41, 10, 10, 155, 39),
(42, 10, 10, 156, 39),
(43, 10, 10, 157, 39),
(44, 10, 2, 203, 40),
(45, 10, 2, 204, 40),
(46, 10, 2, 205, 40),
(47, 10, 2, 214, 41),
(48, 10, 2, 215, 41),
(49, 10, 2, 216, 41),
(50, 10, 2, 217, 41),
(51, 10, 12, 149, 42),
(52, 10, 12, 150, 42),
(53, 10, 13, 139, 43),
(54, 10, 13, 140, 43);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `filme`
--

CREATE TABLE `filme` (
  `FilmID` int(11) NOT NULL,
  `Titel` varchar(255) COLLATE utf8mb4_german2_ci NOT NULL,
  `Dauer` int(11) NOT NULL,
  `FSK` bit(1) NOT NULL,
  `Bild` varchar(30) COLLATE utf8mb4_german2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_german2_ci;

--
-- Tablo döküm verisi `filme`
--

INSERT INTO `filme` (`FilmID`, `Titel`, `Dauer`, `FSK`, `Bild`) VALUES
(27, 'Matrix I', 235, b'0', 'filme27.jpg'),
(28, 'Matrix II', 123, b'0', 'filme28.jpg'),
(30, 'Fury', 135, b'1', 'filme30.jpg'),
(31, 'Avatar', 220, b'0', 'filme31.jpg'),
(32, 'Matrix III', 125, b'0', 'filme32.jpg'),
(33, 'Lord of the Rings I', 135, b'0', 'filme33.jpg'),
(34, 'Lord of the Rings II', 181, b'0', 'filme34.jpg');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `kinopersonal`
--

CREATE TABLE `kinopersonal` (
  `PersonalVR` int(11) NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_german2_ci NOT NULL,
  `password` varchar(100) COLLATE utf8mb4_german2_ci NOT NULL,
  `vorname` varchar(100) COLLATE utf8mb4_german2_ci NOT NULL,
  `nachname` varchar(100) COLLATE utf8mb4_german2_ci NOT NULL,
  `position` int(11) NOT NULL DEFAULT 2,
  `SVNR` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_german2_ci;

--
-- Tablo döküm verisi `kinopersonal`
--

INSERT INTO `kinopersonal` (`PersonalVR`, `email`, `password`, `vorname`, `nachname`, `position`, `SVNR`) VALUES
(1, 'helga@gmx.at', '12345', 'Helga', 'Muller', 1, 40),
(2, 'hans@gmail.com', '1234', 'Hanse', 'Vehaugen', 2, 0),
(3, 'kerem@gmx.at', '12345', 'Kerem', 'Savas', 1, 0);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `reservierung`
--

CREATE TABLE `reservierung` (
  `ResNR` int(11) NOT NULL,
  `Vorname` varchar(100) COLLATE utf8mb4_german2_ci NOT NULL,
  `Nachname` varchar(100) COLLATE utf8mb4_german2_ci NOT NULL,
  `Platzanzahi` int(11) NOT NULL,
  `Zeit` date NOT NULL DEFAULT current_timestamp(),
  `VorfuhrungID` int(11) NOT NULL,
  `KinopersonalID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_german2_ci;

--
-- Tablo döküm verisi `reservierung`
--

INSERT INTO `reservierung` (`ResNR`, `Vorname`, `Nachname`, `Platzanzahi`, `Zeit`, `VorfuhrungID`, `KinopersonalID`) VALUES
(6, 'Can', 'Canan', 2, '2020-03-10', 12, 1);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `saal`
--

CREATE TABLE `saal` (
  `Saal_NR` int(11) NOT NULL,
  `Filmberühmtheit` varchar(255) COLLATE utf8mb4_german2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_german2_ci;

--
-- Tablo döküm verisi `saal`
--

INSERT INTO `saal` (`Saal_NR`, `Filmberühmtheit`) VALUES
(1, 'Michael Jackson'),
(5, 'Arnold'),
(6, 'Brad Pitt'),
(7, 'Jony Depp');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `sitzplatz`
--

CREATE TABLE `sitzplatz` (
  `SitzID` int(11) NOT NULL,
  `Reihennummer` int(11) NOT NULL,
  `Platznummer` int(11) NOT NULL,
  `Saal_NR` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_german2_ci;

--
-- Tablo döküm verisi `sitzplatz`
--

INSERT INTO `sitzplatz` (`SitzID`, `Reihennummer`, `Platznummer`, `Saal_NR`) VALUES
(6, 1, 1, 1),
(4, 1, 1, 5),
(5, 1, 1, 6),
(3, 1, 1, 7),
(49, 1, 2, 1),
(7, 1, 2, 5),
(128, 1, 2, 6),
(58, 1, 2, 7),
(50, 1, 3, 1),
(8, 1, 3, 5),
(129, 1, 3, 6),
(59, 1, 3, 7),
(51, 1, 4, 1),
(152, 1, 4, 5),
(130, 1, 4, 6),
(60, 1, 4, 7),
(52, 1, 5, 1),
(153, 1, 5, 5),
(131, 1, 5, 6),
(61, 1, 5, 7),
(53, 1, 6, 1),
(154, 1, 6, 5),
(62, 1, 6, 7),
(54, 1, 7, 1),
(155, 1, 7, 5),
(63, 1, 7, 7),
(55, 1, 8, 1),
(156, 1, 8, 5),
(64, 1, 8, 7),
(56, 1, 9, 1),
(157, 1, 9, 5),
(65, 1, 9, 7),
(57, 1, 10, 1),
(158, 1, 10, 5),
(66, 1, 10, 7),
(159, 1, 11, 5),
(160, 1, 12, 5),
(161, 1, 13, 5),
(162, 1, 14, 5),
(163, 1, 15, 5),
(226, 2, 1, 1),
(164, 2, 1, 5),
(132, 2, 1, 6),
(68, 2, 1, 7),
(227, 2, 2, 1),
(165, 2, 2, 5),
(133, 2, 2, 6),
(69, 2, 2, 7),
(228, 2, 3, 1),
(166, 2, 3, 5),
(134, 2, 3, 6),
(70, 2, 3, 7),
(229, 2, 4, 1),
(167, 2, 4, 5),
(135, 2, 4, 6),
(71, 2, 4, 7),
(230, 2, 5, 1),
(168, 2, 5, 5),
(136, 2, 5, 6),
(72, 2, 5, 7),
(231, 2, 6, 1),
(169, 2, 6, 5),
(73, 2, 6, 7),
(232, 2, 7, 1),
(170, 2, 7, 5),
(74, 2, 7, 7),
(233, 2, 8, 1),
(171, 2, 8, 5),
(75, 2, 8, 7),
(234, 2, 9, 1),
(172, 2, 9, 5),
(76, 2, 9, 7),
(235, 2, 10, 1),
(173, 2, 10, 5),
(77, 2, 10, 7),
(174, 2, 11, 5),
(175, 2, 12, 5),
(176, 2, 13, 5),
(177, 2, 14, 5),
(178, 2, 15, 5),
(236, 3, 1, 1),
(179, 3, 1, 5),
(137, 3, 1, 6),
(78, 3, 1, 7),
(237, 3, 2, 1),
(180, 3, 2, 5),
(138, 3, 2, 6),
(79, 3, 2, 7),
(238, 3, 3, 1),
(181, 3, 3, 5),
(139, 3, 3, 6),
(80, 3, 3, 7),
(239, 3, 4, 1),
(182, 3, 4, 5),
(140, 3, 4, 6),
(81, 3, 4, 7),
(240, 3, 5, 1),
(183, 3, 5, 5),
(141, 3, 5, 6),
(82, 3, 5, 7),
(241, 3, 6, 1),
(184, 3, 6, 5),
(83, 3, 6, 7),
(242, 3, 7, 1),
(185, 3, 7, 5),
(84, 3, 7, 7),
(243, 3, 8, 1),
(186, 3, 8, 5),
(85, 3, 8, 7),
(244, 3, 9, 1),
(187, 3, 9, 5),
(86, 3, 9, 7),
(245, 3, 10, 1),
(188, 3, 10, 5),
(87, 3, 10, 7),
(189, 3, 11, 5),
(190, 3, 12, 5),
(191, 3, 13, 5),
(192, 3, 14, 5),
(193, 3, 15, 5),
(246, 4, 1, 1),
(194, 4, 1, 5),
(142, 4, 1, 6),
(88, 4, 1, 7),
(247, 4, 2, 1),
(195, 4, 2, 5),
(143, 4, 2, 6),
(89, 4, 2, 7),
(248, 4, 3, 1),
(196, 4, 3, 5),
(144, 4, 3, 6),
(90, 4, 3, 7),
(249, 4, 4, 1),
(197, 4, 4, 5),
(145, 4, 4, 6),
(91, 4, 4, 7),
(250, 4, 5, 1),
(198, 4, 5, 5),
(146, 4, 5, 6),
(92, 4, 5, 7),
(251, 4, 6, 1),
(199, 4, 6, 5),
(93, 4, 6, 7),
(252, 4, 7, 1),
(200, 4, 7, 5),
(94, 4, 7, 7),
(201, 4, 8, 5),
(95, 4, 8, 7),
(202, 4, 9, 5),
(96, 4, 9, 7),
(203, 4, 10, 5),
(97, 4, 10, 7),
(204, 4, 11, 5),
(205, 4, 12, 5),
(206, 4, 13, 5),
(207, 4, 14, 5),
(208, 4, 15, 5),
(253, 5, 1, 1),
(209, 5, 1, 5),
(147, 5, 1, 6),
(98, 5, 1, 7),
(254, 5, 2, 1),
(210, 5, 2, 5),
(148, 5, 2, 6),
(99, 5, 2, 7),
(255, 5, 3, 1),
(211, 5, 3, 5),
(149, 5, 3, 6),
(100, 5, 3, 7),
(256, 5, 4, 1),
(212, 5, 4, 5),
(150, 5, 4, 6),
(101, 5, 4, 7),
(257, 5, 5, 1),
(213, 5, 5, 5),
(151, 5, 5, 6),
(102, 5, 5, 7),
(258, 5, 6, 1),
(214, 5, 6, 5),
(103, 5, 6, 7),
(259, 5, 7, 1),
(215, 5, 7, 5),
(104, 5, 7, 7),
(216, 5, 8, 5),
(105, 5, 8, 7),
(217, 5, 9, 5),
(106, 5, 9, 7),
(218, 5, 10, 5),
(107, 5, 10, 7),
(219, 5, 11, 5),
(220, 5, 12, 5),
(221, 5, 13, 5),
(222, 5, 14, 5),
(223, 5, 15, 5),
(260, 6, 1, 1),
(108, 6, 1, 7),
(261, 6, 2, 1),
(109, 6, 2, 7),
(262, 6, 3, 1),
(110, 6, 3, 7),
(263, 6, 4, 1),
(111, 6, 4, 7),
(264, 6, 5, 1),
(112, 6, 5, 7),
(265, 6, 6, 1),
(113, 6, 6, 7),
(266, 6, 7, 1),
(114, 6, 7, 7),
(267, 6, 8, 1),
(115, 6, 8, 7),
(268, 6, 9, 1),
(116, 6, 9, 7),
(269, 6, 10, 1),
(117, 6, 10, 7),
(270, 7, 1, 1),
(118, 7, 1, 7),
(271, 7, 2, 1),
(119, 7, 2, 7),
(272, 7, 3, 1),
(120, 7, 3, 7),
(273, 7, 4, 1),
(121, 7, 4, 7),
(274, 7, 5, 1),
(122, 7, 5, 7),
(275, 7, 6, 1),
(123, 7, 6, 7),
(276, 7, 7, 1),
(124, 7, 7, 7),
(277, 7, 8, 1),
(125, 7, 8, 7),
(278, 7, 9, 1),
(126, 7, 9, 7),
(279, 7, 10, 1),
(127, 7, 10, 7);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `verkauf`
--

CREATE TABLE `verkauf` (
  `VkID` int(11) NOT NULL,
  `Typ` int(11) NOT NULL,
  `Zeit` date NOT NULL DEFAULT current_timestamp(),
  `KinopersonalID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_german2_ci;

--
-- Tablo döküm verisi `verkauf`
--

INSERT INTO `verkauf` (`VkID`, `Typ`, `Zeit`, `KinopersonalID`) VALUES
(12, 0, '2020-03-09', 1),
(13, 0, '2020-03-09', 1),
(14, 0, '2020-03-09', 1),
(15, 0, '2020-03-09', 1),
(18, 0, '2020-03-09', 1),
(20, 0, '2020-03-09', 1),
(22, 0, '2020-03-09', 1),
(23, 0, '2020-03-09', 1),
(24, 0, '2020-03-09', 1),
(25, 0, '2020-03-09', 1),
(26, 0, '2020-03-09', 1),
(27, 0, '2020-03-09', 1),
(28, 0, '2020-03-09', 1),
(29, 0, '2020-03-09', 1),
(30, 0, '2020-03-09', 1),
(31, 0, '2020-03-09', 1),
(32, 0, '2020-03-09', 1),
(33, 0, '2020-03-09', 1),
(34, 1, '2020-03-09', 1),
(35, 1, '2020-03-09', 2),
(36, 1, '2020-03-09', 2),
(37, 0, '2020-03-09', 2),
(38, 0, '2020-03-10', 1),
(39, 0, '2020-03-10', 1),
(40, 0, '2020-03-10', 1),
(41, 0, '2020-03-10', 1),
(42, 0, '2020-03-10', 1),
(43, 0, '2020-03-10', 1);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `vorfuhrung`
--

CREATE TABLE `vorfuhrung` (
  `VorfuhrungID` int(11) NOT NULL,
  `FilmID` int(11) NOT NULL,
  `Saal_NR` int(11) NOT NULL,
  `Beginn` date NOT NULL,
  `Ende` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_german2_ci;

--
-- Tablo döküm verisi `vorfuhrung`
--

INSERT INTO `vorfuhrung` (`VorfuhrungID`, `FilmID`, `Saal_NR`, `Beginn`, `Ende`) VALUES
(2, 31, 5, '2020-03-04', '2020-03-14'),
(4, 30, 7, '2020-03-09', '2020-03-12'),
(6, 27, 1, '2020-02-29', '2020-03-14'),
(8, 32, 6, '2020-03-09', '2020-03-15'),
(9, 28, 1, '2020-03-10', '2020-03-20'),
(10, 28, 5, '2020-03-15', '2020-03-20'),
(12, 33, 6, '2020-03-16', '2020-03-20'),
(13, 34, 6, '2020-03-21', '2020-03-24'),
(14, 34, 1, '2020-04-01', '2020-04-07'),
(15, 33, 7, '2020-04-01', '2020-04-07'),
(17, 33, 6, '2020-04-01', '2020-04-07'),
(20, 31, 1, '2020-05-15', '2020-05-20'),
(21, 31, 6, '2020-05-15', '2020-05-20'),
(22, 34, 5, '2020-04-01', '2020-04-07');

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `eintrittskarte`
--
ALTER TABLE `eintrittskarte`
  ADD PRIMARY KEY (`KartenNr`),
  ADD UNIQUE KEY `VorführungID` (`VorfuhrungID`,`SitzID`),
  ADD KEY `SitzID_FK` (`SitzID`),
  ADD KEY `VkID_FK` (`VkID`);

--
-- Tablo için indeksler `filme`
--
ALTER TABLE `filme`
  ADD PRIMARY KEY (`FilmID`);

--
-- Tablo için indeksler `kinopersonal`
--
ALTER TABLE `kinopersonal`
  ADD PRIMARY KEY (`PersonalVR`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Tablo için indeksler `reservierung`
--
ALTER TABLE `reservierung`
  ADD PRIMARY KEY (`ResNR`),
  ADD KEY `VorfuhrungID_FK` (`VorfuhrungID`),
  ADD KEY `KinopersonalID` (`KinopersonalID`);

--
-- Tablo için indeksler `saal`
--
ALTER TABLE `saal`
  ADD PRIMARY KEY (`Saal_NR`);

--
-- Tablo için indeksler `sitzplatz`
--
ALTER TABLE `sitzplatz`
  ADD PRIMARY KEY (`SitzID`),
  ADD UNIQUE KEY `Reihennummer` (`Reihennummer`,`Platznummer`,`Saal_NR`),
  ADD KEY `Saal_NR_FK` (`Saal_NR`);

--
-- Tablo için indeksler `verkauf`
--
ALTER TABLE `verkauf`
  ADD PRIMARY KEY (`VkID`),
  ADD KEY `Personal_FK` (`KinopersonalID`);

--
-- Tablo için indeksler `vorfuhrung`
--
ALTER TABLE `vorfuhrung`
  ADD PRIMARY KEY (`VorfuhrungID`),
  ADD KEY `FilmID_FK` (`FilmID`),
  ADD KEY `Saal_NR` (`Saal_NR`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `eintrittskarte`
--
ALTER TABLE `eintrittskarte`
  MODIFY `KartenNr` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- Tablo için AUTO_INCREMENT değeri `filme`
--
ALTER TABLE `filme`
  MODIFY `FilmID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- Tablo için AUTO_INCREMENT değeri `kinopersonal`
--
ALTER TABLE `kinopersonal`
  MODIFY `PersonalVR` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Tablo için AUTO_INCREMENT değeri `reservierung`
--
ALTER TABLE `reservierung`
  MODIFY `ResNR` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Tablo için AUTO_INCREMENT değeri `saal`
--
ALTER TABLE `saal`
  MODIFY `Saal_NR` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Tablo için AUTO_INCREMENT değeri `sitzplatz`
--
ALTER TABLE `sitzplatz`
  MODIFY `SitzID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=280;

--
-- Tablo için AUTO_INCREMENT değeri `verkauf`
--
ALTER TABLE `verkauf`
  MODIFY `VkID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- Tablo için AUTO_INCREMENT değeri `vorfuhrung`
--
ALTER TABLE `vorfuhrung`
  MODIFY `VorfuhrungID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- Dökümü yapılmış tablolar için kısıtlamalar
--

--
-- Tablo kısıtlamaları `eintrittskarte`
--
ALTER TABLE `eintrittskarte`
  ADD CONSTRAINT `SitzID_FK` FOREIGN KEY (`SitzID`) REFERENCES `sitzplatz` (`SitzID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `VkID_FK` FOREIGN KEY (`VkID`) REFERENCES `verkauf` (`VkID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `Vorfuhrung` FOREIGN KEY (`VorfuhrungID`) REFERENCES `vorfuhrung` (`VorfuhrungID`) ON UPDATE CASCADE;

--
-- Tablo kısıtlamaları `reservierung`
--
ALTER TABLE `reservierung`
  ADD CONSTRAINT `KinopersonalID` FOREIGN KEY (`KinopersonalID`) REFERENCES `kinopersonal` (`PersonalVR`) ON UPDATE CASCADE,
  ADD CONSTRAINT `VorfuhrungID_FK` FOREIGN KEY (`VorfuhrungID`) REFERENCES `vorfuhrung` (`VorfuhrungID`) ON UPDATE CASCADE;

--
-- Tablo kısıtlamaları `sitzplatz`
--
ALTER TABLE `sitzplatz`
  ADD CONSTRAINT `Saal_NR_FK` FOREIGN KEY (`Saal_NR`) REFERENCES `saal` (`Saal_NR`) ON UPDATE CASCADE;

--
-- Tablo kısıtlamaları `verkauf`
--
ALTER TABLE `verkauf`
  ADD CONSTRAINT `Personal_FK` FOREIGN KEY (`KinopersonalID`) REFERENCES `kinopersonal` (`PersonalVR`) ON UPDATE CASCADE;

--
-- Tablo kısıtlamaları `vorfuhrung`
--
ALTER TABLE `vorfuhrung`
  ADD CONSTRAINT `FilmID_FK` FOREIGN KEY (`FilmID`) REFERENCES `filme` (`FilmID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `vorfuhrung_ibfk_1` FOREIGN KEY (`Saal_NR`) REFERENCES `saal` (`Saal_NR`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
