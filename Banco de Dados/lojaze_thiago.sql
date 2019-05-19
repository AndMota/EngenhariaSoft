CREATE DATABASE  IF NOT EXISTS `lojaze` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `lojaze`;
-- MySQL dump 10.13  Distrib 8.0.15, for Win64 (x86_64)
--
-- Host: localhost    Database: lojaze
-- ------------------------------------------------------
-- Server version	8.0.15

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
 SET NAMES utf8 ;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `fornecedores`
--

DROP TABLE IF EXISTS `fornecedores`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
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
  `email` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fornecedores`
--

LOCK TABLES `fornecedores` WRITE;
/*!40000 ALTER TABLE `fornecedores` DISABLE KEYS */;
INSERT INTO `fornecedores` VALUES (0,'123456789888','Atacadão do Seu Joaquim ','Rua Padre Norberto',NULL,'Barra Mansa','RJ','27350000','2433554698','atacadaojoaquim@gmail.com');
/*!40000 ALTER TABLE `fornecedores` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `item_venda`
--

DROP TABLE IF EXISTS `item_venda`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `item_venda` (
  `id` int(11) NOT NULL,
  `id_produto` int(11) DEFAULT NULL,
  `id_pedido` int(11) DEFAULT NULL,
  `quantidade` int(11) DEFAULT NULL,
  `valor_vendido` float DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `item_venda`
--

LOCK TABLES `item_venda` WRITE;
/*!40000 ALTER TABLE `item_venda` DISABLE KEYS */;
INSERT INTO `item_venda` VALUES (0,0,0,1,21.99),(1,1,0,1,27.56);
/*!40000 ALTER TABLE `item_venda` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `produtos`
--

DROP TABLE IF EXISTS `produtos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `produtos` (
  `id` int(11) NOT NULL,
  `nome` text,
  `fabricante` text,
  `codigo_barras` text,
  `preco` float DEFAULT NULL,
  `id_setor` int(11) DEFAULT NULL,
  `id_fornecedor` int(11) DEFAULT NULL,
  `quantidade_estoque` int(11) DEFAULT NULL,
  `data_entrada` date DEFAULT NULL,
  `data_validade` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `produtos`
--

LOCK TABLES `produtos` WRITE;
/*!40000 ALTER TABLE `produtos` DISABLE KEYS */;
INSERT INTO `produtos` VALUES (0,'Bife de Contra Filé congelado wessel premium 400g','Wessel','313131321',21.99,0,0,120,'2019-05-04','2019-07-01'),(1,'Coca Cola 2 litros leve mais pague menos pack com 4 unidades','Coca Cola','987879877',27.56,1,0,53,'2019-05-05','2020-09-01'),(2,'Álcool Zumbi tradicional 1 litro','Zumbi','789456547',6.85,2,0,99,'2019-03-05','2021-02-01');
/*!40000 ALTER TABLE `produtos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `setores`
--

DROP TABLE IF EXISTS `setores`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `setores` (
  `id` int(11) NOT NULL,
  `nome` text,
  `descricao` text,
  `id_admistrador` int(11) DEFAULT NULL,
  `num_identificacao` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `setores`
--

LOCK TABLES `setores` WRITE;
/*!40000 ALTER TABLE `setores` DISABLE KEYS */;
INSERT INTO `setores` VALUES (0,'Açougue','Carnes',6,1),(1,'Bebidas','Água, Cerveja e Refrigerantes',6,2),(2,'Limpeza','Sabão, Detergente e Água Sanitária',6,3);
/*!40000 ALTER TABLE `setores` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` text NOT NULL,
  `senha` text NOT NULL,
  `nome` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `telefone` text NOT NULL,
  `cpf` varchar(11) NOT NULL,
  `cnpj` varchar(14) DEFAULT NULL,
  `endereco` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `complemento` text CHARACTER SET latin1 COLLATE latin1_swedish_ci,
  `cidade` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `estado` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `cep` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `tipo` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0=cliente, 1=func, 2=admin',
  `cargo_funcionario` text,
  `salario_funcionario` float DEFAULT NULL,
  `data_entrada_funcionario` date DEFAULT NULL,
  `num_identificacao_funcionario` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES (1,'azs201@hotmail.com','1234','Aline Zoldinick da Silva','2222333369','12222554698','','Rua Local nome grande','PrÃ©dio 6','Juiz de Fora','Minas Gerais','12355555',0,'',0,'0000-00-00',0),(2,'will.oli@gmail.com','1234','Wilson Ferreira Oliveira','988888888','12345678999','','Rua UFJF','','Governador Valadares','Minas Gerais','224659863',0,'',0,'0000-00-00',0),(3,'hallack@gmail.com','1234','Thompson Hallack','3212345678','11111111111','','Avenida Circular','Bloco 6, apto 305','Resende','Rio de Janeiro','8215463',0,'',0,'0000-00-00',0),(4,'gorob@hotmail.com','1234','Gorobina Juventina','44945617326','12344456487','','Rua SÃ£o Pedro','','Barra Mansa','Rio de Janeiro','31899564',1,'Vendedor',1400,'2018-11-02',100),(5,'hermergardo@yahoo.com','1234','Hermengardo','2125469875','22222222222','','Rua Local','Apto 101','Campinas','São Paulo','321267894',1,'Vendedor',1400,'2019-05-01',112),(6,'severinodjs@hotmail.com','1234','Severino De Jesus','91945621875','11122244455','0','Rua Maria das Dores',NULL,'Recife','Pernambuco','15545448',2,'Administrador',2500,'2018-11-02',90),(7,'benedito222@gmail.com','1234','Benedito Camurça','9975467514','11112225557','0','Rua Jose Silva',NULL,'Caruaru','Pernambuco','12316465',0,NULL,NULL,NULL,NULL),(8,'fridinho777@hotmail.com','1234','Fridundino Eulâmpio','79754665555','12345678905',NULL,'Rua Genoveva',NULL,'Passa e Fica','Rio Grande do Norte','99989887',0,NULL,NULL,NULL,NULL),(9,'antonio1234@yahoo.com','1234','Antônio Balduíno','9879645125','89764532155',NULL,'Rua Local',NULL,'Quatis','Rio de Janeiro','27888944',0,NULL,NULL,NULL,NULL),(10,'capitunaotraiu@gmail.com','1234','Capitu Silva','1112554888','98766549879',NULL,'Rua Dom Casmurro',NULL,'Rio de Janeiro','Rio de Janeiro','27400000',2,'Administrador',1235,'2019-05-01',223),(11,'camilinha87@gmail.com','1234','Camila Cesar','77897987987','77777777777',NULL,'Rua Josefina',NULL,'Juiz de Fora','Minas Gerais','36010777',1,'Vendedor',1234,'2019-05-01',222),(12,'seuze@gmail.com','1234','José Silva','46545646548','33333333333',NULL,'Rua UFJF',NULL,'Juiz de Fora','Minas Gerais','36020444',2,'Administrador',3500,'2017-03-12',1);
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vendas`
--

DROP TABLE IF EXISTS `vendas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `vendas` (
  `id` int(11) NOT NULL,
  `id_cliente` int(11) DEFAULT NULL,
  `id_funcionario` int(11) DEFAULT NULL,
  `data_venda` datetime DEFAULT NULL,
  `valor_total` float DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vendas`
--

LOCK TABLES `vendas` WRITE;
/*!40000 ALTER TABLE `vendas` DISABLE KEYS */;
INSERT INTO `vendas` VALUES (0,1,5,'2019-05-05 00:00:00',49.55);
/*!40000 ALTER TABLE `vendas` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-05-18 23:49:37
