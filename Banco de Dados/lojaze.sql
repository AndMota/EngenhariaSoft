-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: 19-Fev-2019 às 13:12
-- Versão do servidor: 5.7.21
-- PHP Version: 7.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lojaze`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE IF NOT EXISTS `usuarios` (
  `email` varchar(20) NOT NULL,
  `senha` varchar(40) NOT NULL,
  `nome` varchar(40) CHARACTER SET latin1 NOT NULL,
  `telefone` varchar(12) NOT NULL,
  `cpf` varchar(14) NOT NULL,
  `endereco` varchar(40) CHARACTER SET latin1 NOT NULL,
  `complemento` varchar(40) CHARACTER SET latin1 DEFAULT NULL,
  `cidade` varchar(40) CHARACTER SET latin1 NOT NULL,
  `estado` varchar(40) CHARACTER SET latin1 NOT NULL,
  `cep` varchar(10) CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`nome`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
