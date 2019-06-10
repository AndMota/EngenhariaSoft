-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: 09-Jun-2019 às 15:12
-- Versão do servidor: 10.1.38-MariaDB
-- versão do PHP: 7.3.4

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
CREATE DATABASE IF NOT EXISTS `lojaze` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `lojaze`;

-- --------------------------------------------------------

--
-- Estrutura da tabela `item_venda`
--

DROP TABLE IF EXISTS `item_venda`;
CREATE TABLE IF NOT EXISTS `item_venda` (
  `id` int(11) NOT NULL,
  `id_produto` int(11) DEFAULT NULL,
  `id_pedido` int(11) DEFAULT NULL,
  `quantidade` int(11) DEFAULT NULL,
  `valor_vendido` float DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `item_venda`
--

INSERT INTO `item_venda` (`id`, `id_produto`, `id_pedido`, `quantidade`, `valor_vendido`) VALUES
(0, 0, 0, 1, 21.99),
(1, 1, 0, 1, 27.56);

-- --------------------------------------------------------

--
-- Estrutura da tabela `produtos`
--

DROP TABLE IF EXISTS `produtos`;
CREATE TABLE IF NOT EXISTS `produtos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` text,
  `fabricante` text,
  `preco` float(10,2) DEFAULT NULL,
  `desconto` float(10,2) DEFAULT NULL,
  `id_setor` int(11) DEFAULT NULL,
  `quantidade_estoque` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_setor` (`id_setor`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `produtos`
--

INSERT INTO `produtos` (`id`, `nome`, `fabricante`, `preco`, `desconto`, `id_setor`, `quantidade_estoque`) VALUES
(1, 'Cx Leite 1L', 'Longa Vida', 3.49, 0.00, 1887, 12),
(2, 'Refrigerante de Cola 2L', 'Coca Cola', 8.00, 0.00, 6512, 48),
(3, 'Miojo', 'Nissin', 1.79, 0.19, 93, 410);

-- --------------------------------------------------------

--
-- Estrutura da tabela `setores`
--

DROP TABLE IF EXISTS `setores`;
CREATE TABLE IF NOT EXISTS `setores` (
  `nome` text,
  `id_administrador` int(11) DEFAULT NULL,
  `num_identificacao` int(11) NOT NULL,
  PRIMARY KEY (`num_identificacao`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `setores`
--

INSERT INTO `setores` (`nome`, `id_administrador`, `num_identificacao`) VALUES
('Alimentos', 12, 93),
('Padaria', 12, 654),
('Laticinios', 6, 1887),
('Enlatados', 12, 3229),
('Produtos de Limpeza', 10, 5591),
('Verduras', 12, 5627),
('Bebidas', 10, 6512);

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` text NOT NULL,
  `senha` text NOT NULL,
  `nome` text CHARACTER SET latin1 NOT NULL,
  `telefone` text NOT NULL,
  `cpf` varchar(11) DEFAULT NULL,
  `cnpj` varchar(14) DEFAULT NULL,
  `endereco` text CHARACTER SET latin1 NOT NULL,
  `complemento` text CHARACTER SET latin1,
  `cidade` text CHARACTER SET latin1 NOT NULL,
  `estado` text CHARACTER SET latin1 NOT NULL,
  `cep` text CHARACTER SET latin1 NOT NULL,
  `tipo` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0=cliente, 1=func, 2=admin, 3-juridico',
  `cargo_funcionario` text,
  `salario_funcionario` float DEFAULT NULL,
  `data_entrada_funcionario` date DEFAULT NULL,
  `num_identificacao_funcionario` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `email`, `senha`, `nome`, `telefone`, `cpf`, `cnpj`, `endereco`, `complemento`, `cidade`, `estado`, `cep`, `tipo`, `cargo_funcionario`, `salario_funcionario`, `data_entrada_funcionario`, `num_identificacao_funcionario`) VALUES
(2, 'will.oli@gmail.com', '1234', 'Wilson Ferreira Oliveira', '32988888888', '12345678999', '72988935000139', 'Rua UFJF', '', 'Governador Valadares', 'MG', '224659863', 0, NULL, NULL, NULL, NULL),
(3, 'hallack@gmail.com', '1234', 'Thompson Hallack', '3212345678', '11111111111', '86677709000141', 'Avenida Circular', 'Bloco 6, apto 305', 'Resende', 'RJ', '8215463', 0, NULL, NULL, NULL, NULL),
(4, 'gorob@hotmail.com', '1234', 'Gorobina Juventinas', '44945617326', '12344456487', NULL, 'Rua SÃ£o Pedro', '', 'Barra Mansa', 'RJ', '31899564', 1, 'Vendedor', 1400, '2018-11-02', 100),
(5, 'hermergardo@yahoo.com', '1234', 'Hermengardo', '2125469875', '22222222222', NULL, 'Rua Local', 'Apto 101', 'Campinas', 'SP', '321267894', 1, 'Vendedor', 1400, '2019-05-01', 112),
(6, 'severinodjs@hotmail.com', '1234', 'Severino De Jesus', '91945621875', '11122244455', NULL, 'Rua Maria das Dores', NULL, 'Recife', 'PE', '15545448', 2, 'Administrador', 2500, '2018-11-02', 90),
(7, 'benedito222@gmail.com', '1234', 'Benedito CamurÃ§a', '9975467514', '11112225557', '92390813000153', 'Rua Jose Silva', '', 'Caruaru', 'PE', '12316465', 0, NULL, NULL, NULL, NULL),
(8, 'fridinho777@hotmail.com', '1234', 'Fridundino EulÃ­mpio', '79754665555', '12345678905', '84939151000108', 'Rua Genoveva', '', 'Passa e Fica', 'RN', '99.989-887', 0, NULL, NULL, NULL, NULL),
(9, 'antonio1234@yahoo.com', '1234', 'AntÃ´nio BalduÃ­no', '9879645125', '89764532155', '37225967000181', 'Rua Local', '', 'Quatis', 'RJ', '27888944', 0, NULL, NULL, NULL, NULL),
(10, 'capitunaotraiu@gmail.com', '1234', 'Capitu Silva', '1112554888', '98766549879', NULL, 'Rua Dom Casmurro', NULL, 'Rio de Janeiro', 'RJ', '27400000', 2, 'Administrador', 1235, '2019-05-01', 223),
(11, 'camilinha87@gmail.com', '1234', 'Camila Cesar', '77897987987', '77777777777', NULL, 'Rua Josefina', NULL, 'Juiz de Fora', 'MG', '36010777', 1, 'Vendedor', 1234, '2019-05-01', 222),
(12, 'seuze@gmail.com', '1234', 'seuze', '38938482188', '33333333333', NULL, 'Rua  UFJF', '', 'Juiz de Fora', 'MG', '36...0-2-0', 2, 'Administrador', 3500, '2017-03-12', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `vendas`
--

DROP TABLE IF EXISTS `vendas`;
CREATE TABLE IF NOT EXISTS `vendas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_cliente` int(11) DEFAULT NULL,
  `id_funcionario` int(11) DEFAULT NULL,
  `data_venda` datetime DEFAULT NULL,
  `valor_total` float DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `vendas`
--

INSERT INTO `vendas` (`id`, `id_cliente`, `id_funcionario`, `data_venda`, `valor_total`) VALUES
(0, 1, 5, '2019-05-05 00:00:00', 49.55);

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `produtos`
--
ALTER TABLE `produtos`
  ADD CONSTRAINT `produtos_ibfk_1` FOREIGN KEY (`id_setor`) REFERENCES `setores` (`num_identificacao`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
