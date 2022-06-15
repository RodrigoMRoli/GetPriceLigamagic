-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: 06-Fev-2018 às 13:36
-- Versão do servidor: 5.7.19
-- PHP Version: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `torre`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `cartas`
--

DROP TABLE IF EXISTS `cartas`;
CREATE TABLE IF NOT EXISTS `cartas` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(25) CHARACTER SET utf8 NOT NULL,
  `edicao` varchar(15) CHARACTER SET utf8 NOT NULL,
  `edicaored` varchar(11) CHARACTER SET utf8 NOT NULL,
  `extra0` varchar(11) NOT NULL,
  `extra1` varchar(11) NOT NULL,
  `extra2` varchar(11) NOT NULL,
  `extra3` varchar(10) NOT NULL,
  `extra4` varchar(10) NOT NULL,
  `extra5` varchar(10) NOT NULL,
  `extra6` varchar(10) NOT NULL,
  `extra7` varchar(10) NOT NULL,
  `extra8` varchar(10) NOT NULL,
  `extra9` varchar(10) NOT NULL,
  `extra10` varchar(10) NOT NULL,
  `extra11` varchar(10) NOT NULL,
  `extra12` varchar(10) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `cartas`
--

INSERT INTO `cartas` (`ID`, `nome`, `edicao`, `edicaored`, `extra0`, `extra1`, `extra2`, `extra3`, `extra4`, `extra5`, `extra6`, `extra7`, `extra8`, `extra9`, `extra10`, `extra11`, `extra12`) VALUES
(1, 'Unclaimed Territory', '', '', 'R$ 8,00', 'R$ 14,25', '', '', '', '', '', '', '', '', '', '', ''),
(4, 'brainstorm', '', '', 'R$ 4,49', 'R$ 4,00', 'R$ 4,49', 'R$ 3,99', 'R$ 4,99', 'R$ 4,49', 'R$ 299,90', 'R$ 4,99', 'R$ 4,50', 'R$ 2,99', '-', '-', 'R$ 4,90'),
(5, 'fatal push', '', '', 'R$ 31,90', 'R$ 33,97', '', '', '', '', '', '', '', '', '', '', ''),
(6, 'nezahal, primal tide', '', '', 'R$ 5,41', '', '', '', '', '', '', '', '', '', '', '', ''),
(7, 'griselbrand', '', '', 'R$ 29,89', 'R$ 32,25', 'R$ 49,75', '-', '', '', '', '', '', '', '', '', '');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
