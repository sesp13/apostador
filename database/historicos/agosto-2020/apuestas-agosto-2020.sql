-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Sep 01, 2020 at 03:23 AM
-- Server version: 10.4.10-MariaDB
-- PHP Version: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `apostador`
--

-- --------------------------------------------------------

--
-- Table structure for table `apuesta`
--

DROP TABLE IF EXISTS `apuesta`;
CREATE TABLE IF NOT EXISTS `apuesta` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(255) NOT NULL,
  `idEstado` int(11) NOT NULL,
  `idStake` int(11) NOT NULL,
  `cuota` float NOT NULL,
  `valorStake` float NOT NULL,
  `valorFinal` float DEFAULT NULL,
  `fecha` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_apuesta_estado` (`idEstado`),
  KEY `fk_apuesta_stake` (`idStake`)
) ENGINE=InnoDB AUTO_INCREMENT=79 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `apuesta`
--

INSERT INTO `apuesta` (`id`, `descripcion`, `idEstado`, `idStake`, `cuota`, `valorStake`, `valorFinal`, `fecha`) VALUES
(1, 'Indiana handicap -2.5 primera mitad', 2, 1, 1.59, 7500, 11925, '2020-08-03'),
(2, 'Gana NO Pelicans', 2, 1, 1.5, 7000, 10290, '2020-08-03'),
(3, 'Gana Boston Celtics', 3, 1, 1.5, 7000, 0, '2020-08-04'),
(4, 'Damian Lillard más de 8.5 asistencias NBA', 3, 1, 1.8, 7500, 0, '2020-08-04'),
(5, 'Gana emparta shaktar donesk', 2, 1, 1.5, 7300, 10950, '2020-08-05'),
(6, 'Boston Celtics handicap -2.5 primera mitad', 2, 1, 1.6, 7400, 11840, '2020-08-05'),
(7, 'Toronto Raptors Handicap -4.5', 2, 1, 1.5, 7200, 10800, '2020-08-05'),
(8, 'NO Pelicans vs Sacramento Kings Menos 254.5', 3, 1, 1.87, 7500, 0, '2020-08-06'),
(9, 'Basilea Hándicap +0.5, +1.0', 2, 1, 1.72, 7000, 12040, '2020-08-06'),
(10, 'Man City Sin apuesta', 4, 1, 1.96, 7000, 7000, '2020-08-07'),
(11, 'Philadelphia apuesta sin empate primera mitad', 3, 1, 1.58, 7500, 0, '2020-08-07'),
(12, 'Bayern Chelsea Menos de 3.5 tarjetas', 2, 1, 1.76, 7300, 12848, '2020-08-08'),
(13, 'Bayern hándicap asiático -0.5,-1.0', 2, 1, 1.5, 7000, 10500, '2020-08-08'),
(14, 'Primero en marcar Barca', 2, 1, 1.45, 7000, 10150, '2020-08-08'),
(15, 'Phoenix suns hándicap +1.5', 2, 1, 1.48, 7600, 11248, '2020-08-08'),
(16, 'Próximo gol Krasnodar', 2, 1, 1.8, 7500, 13500, '2020-08-09'),
(17, 'Toronto vs memphis menos de 226 puntos', 2, 1, 1.52, 6000, 9120, '2020-08-09'),
(18, 'Portland Trail blazers hándicap +2.5', 2, 1, 1.52, 7900, 12008, '2020-08-09'),
(19, 'Dynamo Moscú aspuesta sin empate', 2, 1, 1.51, 8000, 12080, '2020-08-10'),
(20, 'Gana Empata Inter y menos de 4.5 goles', 2, 1, 1.57, 8200, 12874, '2020-08-10'),
(21, 'Toronto Raptors Hándicap +10.5\r\n', 2, 1, 1.34, 7500, 10050, '2020-08-10'),
(22, 'Sevilla apuesta sin empate', 2, 1, 1.48, 8300, 12284, '2020-08-11'),
(23, 'Bucks hándicap -5.5', 2, 1, 1.5, 8400, 12600, '2020-08-11'),
(24, 'Psg apuesta sin empate', 2, 1, 1.56, 8500, 13260, '2020-08-12'),
(25, 'Philadelphia 76ers vs raptors menos de 227 puntos', 3, 1, 1.48, 6000, 0, '2020-08-12'),
(26, 'Clippers gana primera mitad', 3, 1, 1.55, 8000, 0, '2020-08-12'),
(27, 'Atlético de Madrid apuesta sin empate', 3, 1, 1.51, 8300, 0, '2020-08-13'),
(28, 'Ja Morant más de 22.5 puntos', 3, 1, 1.83, 8000, 0, '2020-08-13'),
(29, 'Gana Portland Trail Blazzers', 2, 1, 1.6, 7900, 12640, '2020-08-13'),
(30, 'barca bayern menos 5.5 goles', 3, 1, 1.45, 8000, 0, '2020-08-14'),
(31, 'Barcelona menos 2.5 goles', 2, 2, 1.45, 14000, 20300, '2020-08-14'),
(32, 'Oklahoma city hándicap +2.5', 3, 1, 1.65, 8000, 0, '2020-08-14'),
(33, 'City vs Lyon más de 2.5 goles', 2, 1, 1.55, 7800, 12090, '2020-08-15'),
(34, 'Proximo gol Malmo', 2, 1, 1.83, 8000, 14640, '2020-08-16'),
(35, 'Gana empata Sevilla', 2, 1, 1.45, 8000, 11600, '2020-08-16'),
(36, 'Inter shaktar más de 2.5 goles', 2, 1, 1.45, 8000, 11600, '2020-08-17'),
(37, 'Denver nuggets hándicap +2.5', 2, 1, 1.95, 8000, 15600, '2020-08-17'),
(38, 'Kemba walker más de 19.5 puntos', 3, 1, 1.9, 8400, 0, '2020-08-17'),
(39, 'Psg leipzing menos de 4.5 goles', 2, 1, 1.4, 8000, 11200, '2020-08-18'),
(40, 'Portland Hándicap +5.5 primera mitad', 2, 1, 1.64, 8300, 13612, '2020-08-18'),
(41, 'Bayern Lyon más de 3.5 goles', 3, 1, 1.92, 8400, 0, '2020-08-19'),
(42, 'Lewandoski goleador en cualquier momento', 2, 1, 1.41, 8200, 11562, '2020-08-19'),
(43, 'Philadelphia 76ers vs Boston más de 209.5 puntos', 2, 1, 1.55, 8000, 12400, '2020-08-19'),
(44, 'Gana Sinner y Gana Simon', 3, 1, 1.53, 8000, 0, '2020-08-20'),
(45, 'Gana Chardy', 3, 1, 2.19, 8300, 0, '2020-08-20'),
(46, 'Gana empata Spezia', 3, 1, 1.3, 8000, 0, '2020-08-20'),
(47, 'Lebron más de 9.5 rebotes', 3, 1, 1.69, 8000, 0, '2020-08-20'),
(48, 'Sevilla o Inter y menos de 4.5 goles', 3, 1, 1.5, 7600, 0, '2020-08-21'),
(49, 'Gana Berankis', 2, 1, 1.5, 7000, 10500, '2020-08-21'),
(50, 'Boston hándicap -2.5', 2, 1, 1.5, 7500, 11250, '2020-08-21'),
(51, 'Gana opelka', 2, 1, 1.57, 15200, 23864, '2020-08-22'),
(52, 'Lakers hándicap -3.5', 2, 1, 1.42, 7600, 10792, '2020-08-22'),
(53, 'Gana empata bayern y más de 1.5 goles', 3, 1, 1.45, 7900, 0, '2020-08-23'),
(54, 'Bayern psg más de 3.5 goles', 3, 1, 1.79, 7700, 0, '2020-08-23'),
(55, 'Tsisipas hándicap de juegos segundo set -1.5', 2, 1, 1.35, 7500, 10125, '2020-08-23'),
(56, 'Gana Goffin David ', 2, 1, 1.52, 7600, 11552, '2020-08-23'),
(57, 'Fun bet: Gana Dimitrov, Gana Bautista, Gana, Tiem Krajinovic más de 8.5 juegos primer set', 3, 4, 3.75, 3000, 0, '2020-08-24'),
(58, 'Djokovic gana 2-0 y gana Berretinni', 2, 1, 1.6, 7600, 12160, '2020-08-24'),
(59, 'Gana Murray', 2, 1, 1.5, 7400, 11100, '2020-08-24'),
(60, 'Arsenal Tula y Khimiki ambos marcan: si', 2, 1, 1.5, 7800, 11700, '2020-08-25'),
(61, 'Gana granollers Zeballos', 2, 1, 1.45, 8000, 11600, '2020-08-25'),
(62, 'Dinamo vs zenit más de 1.5 goles', 3, 1, 1.72, 8000, 0, '2020-08-26'),
(63, 'Gana Tsitipas ', 2, 1, 1.45, 8000, 11600, '2020-08-26'),
(64, 'Krajinovic hándicap de juego segundo set +1.5', 2, 1, 2.65, 8000, 21200, '2020-08-26'),
(65, 'Siguiente gol apoel', 3, 1, 1.55, 8200, 0, '2020-08-27'),
(66, 'Gana Shammock', 3, 1, 1.59, 8000, 0, '2020-08-27'),
(67, 'Carreno Busta / Minaur P hándicap set 2 +1.5', 2, 1, 1.6, 7600, 12160, '2020-08-28'),
(68, 'Bautista hándicap de set -1.5', 3, 4, 6.75, 4000, 0, '2020-08-28'),
(69, 'Gana empata Liverpool y menos de 4.5 goles', 2, 1, 1.44, 8000, 11520, '2020-08-29'),
(70, 'Estrasburgo apuesta sin empate', 3, 1, 1.5, 8000, 0, '2020-08-29'),
(71, 'Gana houston', 2, 1, 1.45, 7700, 11165, '2020-08-29'),
(72, 'Chris Paul menos de 20.5 puntos ', 2, 1, 1.8, 7500, 13500, '2020-08-29'),
(73, 'Gana empata Cska moscu y más de 1.5 goles', 2, 1, 1.8, 8000, 14400, '2020-08-30'),
(74, 'Toronto boston más de 207.5 puntos ', 3, 1, 1.52, 8000, 0, '2020-08-30'),
(75, 'Utah jazz hándicap +2.5', 3, 1, 1.5, 8000, 0, '2020-08-30'),
(76, 'Gana hubert y shapovalop hándicap -1.5 de set', 2, 1, 1.55, 7700, 11935, '2020-08-31'),
(77, 'Steve Johnson hándicap de juego 1.5', 2, 1, 2.3, 8000, 18400, '2020-08-31'),
(78, 'Steven Adams más de 10.5 rebotes', 2, 1, 1.95, 8000, 15600, '2020-08-31');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `apuesta`
--
ALTER TABLE `apuesta`
  ADD CONSTRAINT `fk_apuesta_estado` FOREIGN KEY (`idEstado`) REFERENCES `estado` (`id`),
  ADD CONSTRAINT `fk_apuesta_stake` FOREIGN KEY (`idStake`) REFERENCES `stake` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
