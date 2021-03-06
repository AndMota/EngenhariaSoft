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
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_produto` int(11) DEFAULT NULL,
  `id_pedido` int(11) DEFAULT NULL,
  `quantidade` int(11) DEFAULT NULL,
  `valor_vendido` float DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `item_venda`
--

LOCK TABLES `item_venda` WRITE;
/*!40000 ALTER TABLE `item_venda` DISABLE KEYS */;
INSERT INTO `item_venda` VALUES (1,1,3,1,3.49),(2,2,3,3,8),(3,3,3,2,1.79),(4,1,4,10,3.49),(5,3,4,1,1.79),(6,2,4,1,8),(7,2,4,1,8),(8,2,4,1,8),(9,2,4,1,8),(10,3,4,1,1.79),(11,3,4,1,1.79),(12,3,4,1,1.79),(13,1,5,1,3.49),(14,3,5,1,1.79),(15,3,5,3,1.79),(16,2,5,1,8);
/*!40000 ALTER TABLE `item_venda` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `produtos`
--

DROP TABLE IF EXISTS `produtos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `produtos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` text,
  `fabricante` text,
  `preco` float(10,2) DEFAULT NULL,
  `desconto` float(10,2) DEFAULT NULL,
  `id_setor` int(11) DEFAULT NULL,
  `quantidade_estoque` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_setor` (`id_setor`),
  CONSTRAINT `produtos_ibfk_1` FOREIGN KEY (`id_setor`) REFERENCES `setores` (`num_identificacao`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `produtos`
--

LOCK TABLES `produtos` WRITE;
/*!40000 ALTER TABLE `produtos` DISABLE KEYS */;
INSERT INTO `produtos` VALUES (1,'Cx Leite 1L','Longa Vida',3.49,0.00,1887,12),(2,'Refrigerante de Cola 2L','Coca Cola',8.00,0.00,6512,48),(3,'Miojo','Nissin',1.79,0.19,93,410);
/*!40000 ALTER TABLE `produtos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `setores`
--

DROP TABLE IF EXISTS `setores`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `setores` (
  `nome` text,
  `id_administrador` int(11) DEFAULT NULL,
  `num_identificacao` int(11) NOT NULL,
  PRIMARY KEY (`num_identificacao`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `setores`
--

LOCK TABLES `setores` WRITE;
/*!40000 ALTER TABLE `setores` DISABLE KEYS */;
INSERT INTO `setores` VALUES ('Alimentos',12,93),('Padaria',12,654),('Laticinios',6,1887),('Enlatados',12,3229),('Produtos de Limpeza',10,5591),('Verduras',12,5627),('Bebidas',10,6512);
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
  `cpf` varchar(11) DEFAULT NULL,
  `cnpj` varchar(14) DEFAULT NULL,
  `endereco` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `complemento` text CHARACTER SET latin1 COLLATE latin1_swedish_ci,
  `cidade` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `estado` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `cep` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `tipo` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0=cliente, 1=func, 2=admin, 3-juridico',
  `cargo_funcionario` text,
  `salario_funcionario` float DEFAULT NULL,
  `data_entrada_funcionario` date DEFAULT NULL,
  `num_identificacao_funcionario` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES (2,'will.oli@gmail.com','1234','Wilson Ferreira Oliveira','32988888888','12345678999','72988935000139','Rua UFJF','','Governador Valadares','MG','224659863',0,NULL,NULL,NULL,NULL),(3,'hallack@gmail.com','1234','Thompson Hallack','3212345678','11111111111','86677709000141','Avenida Circular','Bloco 6, apto 305','Resende','RJ','8215463',0,NULL,NULL,NULL,NULL),(4,'gorob@hotmail.com','1234','Gorobina Juventinas','44945617326','12344456487',NULL,'Rua SÃ£o Pedro','','Barra Mansa','RJ','31899564',1,'Vendedor',1400,'2018-11-02',100),(5,'hermergardo@yahoo.com','1234','Hermengardo','2125469875','22222222222',NULL,'Rua Local','Apto 101','Campinas','SP','321267894',1,'Vendedor',1400,'2019-05-01',112),(6,'severinodjs@hotmail.com','1234','Severino De Jesus','91945621875','11122244455',NULL,'Rua Maria das Dores',NULL,'Recife','PE','15545448',2,'Administrador',2500,'2018-11-02',90),(7,'benedito222@gmail.com','1234','Benedito CamurÃ§a','9975467514','11112225557','92390813000153','Rua Jose Silva','','Caruaru','PE','12316465',0,NULL,NULL,NULL,NULL),(8,'fridinho777@hotmail.com','1234','Fridundino EulÃ­mpio','79754665555','12345678905','84939151000108','Rua Genoveva','','Passa e Fica','RN','99.989-887',0,NULL,NULL,NULL,NULL),(9,'antonio1234@yahoo.com','1234','AntÃ´nio BalduÃ­no','9879645125','89764532155','37225967000181','Rua Local','','Quatis','RJ','27888944',0,NULL,NULL,NULL,NULL),(10,'capitunaotraiu@gmail.com','1234','Capitu Silva','1112554888','98766549879',NULL,'Rua Dom Casmurro',NULL,'Rio de Janeiro','RJ','27400000',2,'Administrador',1235,'2019-05-01',223),(11,'camilinha87@gmail.com','1234','Camila Cesar','77897987987','77777777777',NULL,'Rua Josefina',NULL,'Juiz de Fora','MG','36010777',1,'Vendedor',1234,'2019-05-01',222),(12,'seuze@gmail.com','1234','seuze','38938482188','33333333333',NULL,'Rua  UFJF','','Juiz de Fora','MG','36...0-2-0',2,'Administrador',3500,'2017-03-12',1);
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vendas`
--

DROP TABLE IF EXISTS `vendas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `vendas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_cliente` int(11) DEFAULT NULL,
  `id_funcionario` int(11) DEFAULT NULL,
  `data_venda` datetime DEFAULT NULL,
  `valor_total` float DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vendas`
--

LOCK TABLES `vendas` WRITE;
/*!40000 ALTER TABLE `vendas` DISABLE KEYS */;
INSERT INTO `vendas` VALUES (3,3,6,'2019-06-09 23:21:11',31.07),(4,3,6,'2019-06-09 23:21:27',74.06),(5,9,6,'2019-06-09 23:21:58',18.65);
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

-- Dump completed on 2019-06-09 23:24:22
