-- MySQL dump 10.13  Distrib 5.7.14, for Win64 (x86_64)
--
-- Host: localhost    Database: dist
-- ------------------------------------------------------
-- Server version	5.7.14

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `negocios`
--

DROP TABLE IF EXISTS `negocios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `negocios` (
  `nom` varchar(80) NOT NULL COMMENT 'nombre del establecimiento',
  `rif` varchar(45) NOT NULL COMMENT 'RIF unico del establecimiento',
  `dire` varchar(100) NOT NULL COMMENT 'direccion del negocio',
  PRIMARY KEY (`rif`),
  UNIQUE KEY `rif` (`rif`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `negocios`
--

LOCK TABLES `negocios` WRITE;
/*!40000 ALTER TABLE `negocios` DISABLE KEYS */;
INSERT INTO `negocios` VALUES ('Panadería y Pastelería El Puente  ','0-00000000-1','Sector El Puente'),('Abastos Palmarito ','0-00000000-2','Sector Wilfrido Omaña '),('Bodega Mi Jardin','0-00000000-3','Sector Las Acacias '),('Bodega Don Tulio ','0-00000000-4','Sector Alberto Carnevali'),('Fruteria Mocoties','0-00000000-5','La curva de Sabaneta'),('Panadería Y Pastelería Mi favorita','0-00000000-6','El corozo, Calle 6 Carrera 6ta'),('Panadería El Corozo ','0-00000000-7','El corozo, Calle 7 Carrera 7ma'),('Abastos Mayra','0-00000000-8','Carrera 7ma El corozo '),('Un Mundo De Delicias','0-00000000-9','Sector El Arado'),('Cafetin Felix Roman Duque','0-00000001-0','Sector El Arado'),('Panadería Chantilly ','0-00000001-1','Sector El añil, Terminal de Tovar'),('Bodega Tericar','0-00000001-2','Entrada Las Colinas'),('Carniceria Vista Alegre','0-00000001-3','Sector Vista Alegre'),('Bodega Durania','0-00000001-4','Sector El Rosal Alto'),('Panaderia Ideal ','0-00000001-5','Terminal Viejo Zea'),('Bodega Mi Tesoro Favorito ','0-00000001-6','Calle Principal de Zea'),('Abasto Francy','0-00000001-7','Sector San Miguel, Zea'),('Heladeria Zea','0-00000001-8','Plaza Bolívar de Zea'),('Cafetin Bianca','0-00000001-9','Nuevo Terminal de Pasajeros, Zea'),('Cafetin Mi Esperanza','0-00000002-0','Salida de Zea'),('Abastos Nair','0-00000002-1','Pasos Abajo del Banco Sofitasa, Zea'),('Carniceria Nestor','0-00000002-2','Calle Principal de Zea'),('Panadería El Parador Turístico ','0-00000002-3','Entrada la cuchilla del niño '),('Cafetin La Morocha','0-00000002-4','Frente a La Escuela Felix Roman Duque'),('Carniceria San Miguel ','0-00000002-5','Sector San Miguel ');
/*!40000 ALTER TABLE `negocios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `productos`
--

DROP TABLE IF EXISTS `productos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `productos` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'numero identificador unico del producto',
  `nom` varchar(100) NOT NULL COMMENT 'nombre del producto',
  `cant` int(11) NOT NULL COMMENT 'cantidad en inventario del producto',
  `precio` float NOT NULL COMMENT 'precio del producto',
  `fecha` date NOT NULL COMMENT 'dia en que se registro el producto',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `productos`
--

LOCK TABLES `productos` WRITE;
/*!40000 ALTER TABLE `productos` DISABLE KEYS */;
INSERT INTO `productos` VALUES (1,'Leche Litro ',1958,1320,'2017-05-29'),(2,'Leche Galon ',1500,2450,'2017-05-29'),(3,'Jugo Litro De Sabor',800,950,'2017-05-29'),(4,'Jugo 1/2 Litro De Sabor',500,600,'2017-05-29'),(5,'Jugo Litro De Naranja',600,1080,'2017-05-29'),(6,'Jugo 1/2 Litro De Naranja',300,650,'2017-05-29'),(7,'Jugo De Galón Naranja 1.6',450,1500,'2017-05-29'),(8,'Jugo De Galón Naranja 1.8',598,2200,'2017-05-29'),(9,'Jugo Galon De Sabor',800,1800,'2017-05-29'),(10,'Queso Fundido ',455,1870,'2017-05-29'),(11,'Yogurt Firme',300,780,'2017-05-29'),(12,'Gelatina',300,620,'2017-05-29'),(13,'Chicha Litro ',900,1560,'2017-05-29'),(14,'Chicha 1/2 Litro ',200,810,'2017-05-29'),(15,'Yogurt Batido ',560,1530,'2017-05-29'),(16,'Crema De Leche',680,6500,'2017-05-29'),(17,'Yogurt Con Cereal ',640,900,'2017-05-29'),(18,'Suero ',800,1200,'2017-05-29'),(19,'Yogurt Litro ',250,2800,'2017-05-29'),(20,'Yogurt 1/2 Litro ',400,1000,'2017-05-29');
/*!40000 ALTER TABLE `productos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'identificador unico del usuario',
  `nom` varchar(50) NOT NULL COMMENT 'nombre del usuario',
  `ape` varchar(50) NOT NULL COMMENT 'apellido del usuario',
  `usu` varchar(20) NOT NULL COMMENT 'nombre de autenticacion del usuario',
  `pass` varchar(36) NOT NULL COMMENT 'contraseña de autenticacion del usuario',
  `lvl` int(11) NOT NULL COMMENT 'nivel de usuario',
  `mail` varchar(150) NOT NULL COMMENT 'correo electronico del usuario',
  PRIMARY KEY (`id`),
  UNIQUE KEY `usu` (`usu`) COMMENT 'identificar como valor unico'
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES (1,'Leidy','Carrero','admin','21232f297a57a5a743894a0e4a801fc3',1,'leidy@dist.com'),(2,'Leidy','Carrero','admin2','c84258e9c39059a89ab77d846ddab909',2,'leidy@dist.com');
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ventas`
--

DROP TABLE IF EXISTS `ventas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ventas` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'identificador',
  `id_prod` int(11) NOT NULL COMMENT 'identificador del producto vendido',
  `cant` int(11) NOT NULL COMMENT 'cantidad vendida',
  `valor` float NOT NULL COMMENT 'precio del producto',
  `t_pago` varchar(25) NOT NULL COMMENT 'tipo de pago realizado agregar +iva ',
  `c_pago` float NOT NULL COMMENT 'cantidad total del pago',
  `cliente` varchar(45) NOT NULL COMMENT 'cliente o negocio que realiza la compra',
  `fecha` date NOT NULL COMMENT 'dia en que se realizo la venta',
  PRIMARY KEY (`id`),
  KEY `id_prod` (`id_prod`),
  KEY `cliente` (`cliente`),
  CONSTRAINT `ventas_ibfk_1` FOREIGN KEY (`id_prod`) REFERENCES `productos` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `ventas_ibfk_2` FOREIGN KEY (`cliente`) REFERENCES `negocios` (`rif`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ventas`
--

LOCK TABLES `ventas` WRITE;
/*!40000 ALTER TABLE `ventas` DISABLE KEYS */;
INSERT INTO `ventas` VALUES (1,1,15,1452,'cheque',21780,'0-00000002-4','2017-05-29'),(2,1,5,1452,'transferencia',7260,'0-00000001-7','2017-05-29'),(3,1,22,1452,'efectivo',31944,'0-00000001-7','2017-05-29'),(4,8,2,2420,'efectivo',4840,'0-00000002-2','2017-05-29');
/*!40000 ALTER TABLE `ventas` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-05-29 16:10:59
