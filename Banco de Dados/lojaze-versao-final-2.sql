-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 08, 2019 at 10:24 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.4

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
-- Table structure for table `fornecedores`
--

CREATE TABLE `fornecedores` (
  `id` int(11) NOT NULL,
  `cnpj` varchar(14) DEFAULT NULL,
  `nome` text,
  `endereco` text,
  `complemento` text,
  `cidade` text,
  `estado` text,
  `cep` text,
  `telefone` text,
  `email` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `fornecedores`
--

INSERT INTO `fornecedores` (`id`, `cnpj`, `nome`, `endereco`, `complemento`, `cidade`, `estado`, `cep`, `telefone`, `email`) VALUES
(0, '123456789888', 'Atacadão do Seu Joaquim ', 'Rua Padre Norberto', NULL, 'Barra Mansa', 'RJ', '27350000', '2433554698', 'atacadaojoaquim@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `item_venda`
--

CREATE TABLE `item_venda` (
  `id` int(11) NOT NULL,
  `id_produto` int(11) DEFAULT NULL,
  `id_pedido` int(11) DEFAULT NULL,
  `quantidade` int(11) DEFAULT NULL,
  `valor_vendido` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `item_venda`
--

INSERT INTO `item_venda` (`id`, `id_produto`, `id_pedido`, `quantidade`, `valor_vendido`) VALUES
(0, 0, 0, 1, 21.99),
(1, 1, 0, 1, 27.56);

-- --------------------------------------------------------

--
-- Table structure for table `produtos`
--

CREATE TABLE `produtos` (
  `id` int(11) NOT NULL,
  `nome` text,
  `fabricante` text,
  `codigo_barras` text,
  `preco` float DEFAULT NULL,
  `desconto` float DEFAULT NULL,
  `id_setor` int(11) DEFAULT NULL,
  `id_fornecedor` int(11) DEFAULT NULL,
  `quantidade_estoque` int(11) DEFAULT NULL,
  `data_entrada` date DEFAULT NULL,
  `data_validade` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `produtos`
--

INSERT INTO `produtos` (`id`, `nome`, `fabricante`, `codigo_barras`, `preco`, `desconto`, `id_setor`, `id_fornecedor`, `quantidade_estoque`, `data_entrada`, `data_validade`) VALUES
(1, 'Cx Leite 1L', 'Longa Vida', NULL, 3.49, NULL, 0, NULL, 12, NULL, NULL),
(2, 'Refrigerante de Cola 2L', 'Coca Cola', NULL, 8, NULL, 6512, NULL, 48, NULL, NULL),
(3, 'Miojo', 'Nissin', NULL, 1.79, 0.19, 1887, NULL, 410981, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `setores`
--

CREATE TABLE `setores` (
  `nome` text,
  `id_administrador` int(11) DEFAULT NULL,
  `num_identificacao` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `setores`
--

INSERT INTO `setores` (`nome`, `id_administrador`, `num_identificacao`) VALUES
('Laticinios', 6, 1887),
('Enlatados', 12, 3229),
('Produtos de Limpeza', 10, 5591),
('Verduras', 12, 5627),
('Bebidas', 10, 6512);

-- --------------------------------------------------------

--
-- Table structure for table `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `email` text NOT NULL,
  `senha` text NOT NULL,
  `nome` text CHARACTER SET latin1 NOT NULL,
  `telefone` text NOT NULL,
  `cpf` varchar(11) NOT NULL,
  `cnpj` varchar(14) DEFAULT NULL,
  `endereco` text CHARACTER SET latin1 NOT NULL,
  `complemento` text CHARACTER SET latin1,
  `cidade` text CHARACTER SET latin1 NOT NULL,
  `estado` text CHARACTER SET latin1 NOT NULL,
  `cep` text CHARACTER SET latin1 NOT NULL,
  `tipo` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0=cliente, 1=func, 2=admin',
  `cargo_funcionario` text,
  `salario_funcionario` float DEFAULT NULL,
  `data_entrada_funcionario` date DEFAULT NULL,
  `num_identificacao_funcionario` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `usuarios`
--

INSERT INTO `usuarios` (`id`, `email`, `senha`, `nome`, `telefone`, `cpf`, `cnpj`, `endereco`, `complemento`, `cidade`, `estado`, `cep`, `tipo`, `cargo_funcionario`, `salario_funcionario`, `data_entrada_funcionario`, `num_identificacao_funcionario`) VALUES
(2, 'will.oli@gmail.com', '1234', 'Wilson Ferreira Oliveira', '988888888', '12345678999', '72988935000139', 'Rua UFJF', '', 'Governador Valadares', 'MG', '224659863', 0, '', 0, '0000-00-00', 0),
(3, 'hallack@gmail.com', '1234', 'Thompson Hallack', '3212345678', '11111111111', '86677709000141', 'Avenida Circular', 'Bloco 6, apto 305', 'Resende', 'RJ', '8215463', 0, '', 0, '0000-00-00', 0),
(4, 'gorob@hotmail.com', '1234', 'Gorobina Juventinas', '44945617326', '12344456487', NULL, 'Rua SÃ£o Pedro', '', 'Barra Mansa', 'RJ', '31899564', 1, 'Vendedor', 1400, '2018-11-02', 100),
(5, 'hermergardo@yahoo.com', '1234', 'Hermengardo', '2125469875', '22222222222', NULL, 'Rua Local', 'Apto 101', 'Campinas', 'SP', '321267894', 1, 'Vendedor', 1400, '2019-05-01', 112),
(6, 'severinodjs@hotmail.com', '1234', 'Severino De Jesus', '91945621875', '11122244455', NULL, 'Rua Maria das Dores', NULL, 'Recife', 'PE', '15545448', 2, 'Administrador', 2500, '2018-11-02', 90),
(7, 'benedito222@gmail.com', '1234', 'Benedito CamurÃ§a', '9975467514', '11112225557', '92390813000153', 'Rua Jose Silva', '', 'Caruaru', 'PE', '12316465', 0, NULL, NULL, NULL, NULL),
(8, 'fridinho777@hotmail.com', '1234', 'Fridundino EulÃ­mpio', '79 7.5466-5555', '12345678905', '84939151000108', 'Rua Genoveva', '', 'Passa e Fica', 'RN', '99.989-887', 0, NULL, NULL, NULL, NULL),
(9, 'antonio1234@yahoo.com', '1234', 'AntÃ´nio BalduÃ­no', '9879645125', '89764532155', '37225967000181', 'Rua Local', '', 'Quatis', 'RJ', '27888944', 0, NULL, NULL, NULL, NULL),
(10, 'capitunaotraiu@gmail.com', '1234', 'Capitu Silva', '1112554888', '98766549879', NULL, 'Rua Dom Casmurro', NULL, 'Rio de Janeiro', 'RJ', '27400000', 2, 'Administrador', 1235, '2019-05-01', 223),
(11, 'camilinha87@gmail.com', '1234', 'Camila Cesar', '77897987987', '77777777777', NULL, 'Rua Josefina', NULL, 'Juiz de Fora', 'MG', '36010777', 1, 'Vendedor', 1234, '2019-05-01', 222),
(12, 'seuze', '1234', 'seuze', '46  . .5.-45-6', '33333333333', NULL, 'Rua  UFJF', '', 'Juiz de Fora', 'MG', '36...0-2-0', 2, 'Administrador', 3500, '2017-03-12', 1),
(13, 'a', 'a', 'a', 'a', 'a', '', 'a', 'a', 'a', 'AC', 'a', 0, '', 0, '2019-06-08', 0);

-- --------------------------------------------------------

--
-- Table structure for table `vendas`
--

CREATE TABLE `vendas` (
  `id` int(11) NOT NULL,
  `id_cliente` int(11) DEFAULT NULL,
  `id_funcionario` int(11) DEFAULT NULL,
  `data_venda` datetime DEFAULT NULL,
  `valor_total` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `vendas`
--

INSERT INTO `vendas` (`id`, `id_cliente`, `id_funcionario`, `data_venda`, `valor_total`) VALUES
(0, 1, 5, '2019-05-05 00:00:00', 49.55);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `fornecedores`
--
ALTER TABLE `fornecedores`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `item_venda`
--
ALTER TABLE `item_venda`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `produtos`
--
ALTER TABLE `produtos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `setores`
--
ALTER TABLE `setores`
  ADD PRIMARY KEY (`num_identificacao`);

--
-- Indexes for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vendas`
--
ALTER TABLE `vendas`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `produtos`
--
ALTER TABLE `produtos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
