-- MySQL dump 10.18  Distrib 10.3.27-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: bd_responsivas
-- ------------------------------------------------------
-- Server version	10.3.27-MariaDB-0+deb10u1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `t_Almacen`
--

DROP TABLE IF EXISTS `t_Almacen`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `t_Almacen` (
  `id_almacen` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(80) NOT NULL,
  PRIMARY KEY (`id_almacen`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_Almacen`
--

LOCK TABLES `t_Almacen` WRITE;
/*!40000 ALTER TABLE `t_Almacen` DISABLE KEYS */;
INSERT INTO `t_Almacen` VALUES (1,'PLANTA 3 - ALMACEN');
/*!40000 ALTER TABLE `t_Almacen` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `t_Centro_Costos`
--

DROP TABLE IF EXISTS `t_Centro_Costos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `t_Centro_Costos` (
  `id_centro_costos` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `num_centro_costos` varchar(30) NOT NULL,
  `descripcion` varchar(80) NOT NULL,
  PRIMARY KEY (`id_centro_costos`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_Centro_Costos`
--

LOCK TABLES `t_Centro_Costos` WRITE;
/*!40000 ALTER TABLE `t_Centro_Costos` DISABLE KEYS */;
INSERT INTO `t_Centro_Costos` VALUES (1,'17311217','WAREHOUSE'),(2,'17313232','MANUFACTURING'),(3,'17311216','ADUANAS'),(4,'17313233','INGENIERIA INDUSTRIAL'),(5,'17313234','MFG ENG ENERGY NHB'),(6,'17313290','MANUFACTURA');
/*!40000 ALTER TABLE `t_Centro_Costos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `t_Cintas`
--

DROP TABLE IF EXISTS `t_Cintas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `t_Cintas` (
  `id_cintas` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `num_serial` varchar(15) NOT NULL,
  `fecha_inic` date DEFAULT NULL,
  `fecha_final` date DEFAULT NULL,
  `ubicacion` varchar(20) NOT NULL,
  `comentarios` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_cintas`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_Cintas`
--

LOCK TABLES `t_Cintas` WRITE;
/*!40000 ALTER TABLE `t_Cintas` DISABLE KEYS */;
/*!40000 ALTER TABLE `t_Cintas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `t_Depto`
--

DROP TABLE IF EXISTS `t_Depto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `t_Depto` (
  `id_depto` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(50) NOT NULL,
  PRIMARY KEY (`id_depto`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_Depto`
--

LOCK TABLES `t_Depto` WRITE;
/*!40000 ALTER TABLE `t_Depto` DISABLE KEYS */;
INSERT INTO `t_Depto` VALUES (1,'MATERIALS'),(2,'MANUFACTURING ENGINEERING'),(3,'LOGISTICS'),(4,'MANUFACTURA');
/*!40000 ALTER TABLE `t_Depto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `t_Edo_epo`
--

DROP TABLE IF EXISTS `t_Edo_epo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `t_Edo_epo` (
  `id_edo_epo` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(80) NOT NULL,
  PRIMARY KEY (`id_edo_epo`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_Edo_epo`
--

LOCK TABLES `t_Edo_epo` WRITE;
/*!40000 ALTER TABLE `t_Edo_epo` DISABLE KEYS */;
INSERT INTO `t_Edo_epo` VALUES (1,'OPERABLE'),(2,'NO OPERABLE');
/*!40000 ALTER TABLE `t_Edo_epo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `t_Empleados`
--

DROP TABLE IF EXISTS `t_Empleados`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `t_Empleados` (
  `id_empleado` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `id_ubicacion` smallint(5) unsigned NOT NULL,
  `id_puesto` smallint(5) unsigned NOT NULL,
  `id_supervisor` smallint(5) unsigned NOT NULL,
  `id_depto` smallint(5) unsigned NOT NULL,
  `id_centro_costos` smallint(5) unsigned NOT NULL,
  `nombre` varchar(20) NOT NULL,
  `apellidos` varchar(45) NOT NULL,
  `ntid` varchar(20) NOT NULL,
  `correo_electronico` varchar(50) NOT NULL,
  `rol` varchar(25) DEFAULT NULL,
  `foto` varchar(100) NOT NULL,
  `fecha` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id_empleado`),
  KEY `id_ubicacion` (`id_ubicacion`),
  KEY `id_puesto` (`id_puesto`),
  KEY `id_supervisor` (`id_supervisor`),
  KEY `id_depto` (`id_depto`),
  KEY `id_centro_costos` (`id_centro_costos`),
  CONSTRAINT `t_Empleados_ibfk_1` FOREIGN KEY (`id_ubicacion`) REFERENCES `t_Ubicacion` (`id_ubicacion`) ON UPDATE CASCADE,
  CONSTRAINT `t_Empleados_ibfk_2` FOREIGN KEY (`id_puesto`) REFERENCES `t_Puesto` (`id_puesto`) ON UPDATE CASCADE,
  CONSTRAINT `t_Empleados_ibfk_3` FOREIGN KEY (`id_supervisor`) REFERENCES `t_Supervisor` (`id_supervisor`) ON UPDATE CASCADE,
  CONSTRAINT `t_Empleados_ibfk_4` FOREIGN KEY (`id_depto`) REFERENCES `t_Depto` (`id_depto`) ON UPDATE CASCADE,
  CONSTRAINT `t_Empleados_ibfk_5` FOREIGN KEY (`id_centro_costos`) REFERENCES `t_Centro_Costos` (`id_centro_costos`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_Empleados`
--

LOCK TABLES `t_Empleados` WRITE;
/*!40000 ALTER TABLE `t_Empleados` DISABLE KEYS */;
INSERT INTO `t_Empleados` VALUES (1,1,1,1,1,1,'DEPTO TI','DEPTO TI','9999999','DEPTOTI@JABIL.COM',NULL,'vistas/img/empleados/default/anonymous.png','2021-04-26 18:22:51'),(2,2,2,2,2,2,'ALVARO','JURADO FLORES','2508819','ALVARO_JURADO@JABIL.COM',NULL,'vistas/img/empleados/default/anonymous.png','2021-04-27 23:14:08'),(3,3,3,3,3,3,'JUAN ALAVARDO','JOFFROY TREVIÑO','2410825','JUAN_JOFFROY@JABIL.COM',NULL,'vistas/img/empleados/default/anonymous.png','2021-04-27 23:32:00'),(4,4,1,1,1,1,'GILBERTO','JIMENEZ','2370721','GILBERTO_JIMENEZ20721@JABIL.COM',NULL,'vistas/img/empleados/default/anonymous.png','2021-04-27 23:58:53'),(5,4,4,4,2,4,'ANDREA','MUÑOZ SOLIS','3040623','ANDREA_MUNOZ@JABIL.COM',NULL,'vistas/img/empleados/default/anonymous.png','2021-05-01 11:07:47'),(6,4,5,5,2,5,'EDWIN','MEDINA RAMOS','2494906','EDWIN_MEDINA@JABIL.COM',NULL,'vistas/img/empleados/default/anonymous.png','2021-05-01 12:03:04'),(7,4,6,6,4,6,'ALFONSO','AGUIRRE GARCIA','2013619','ALFONSO_AGUIRRE@JABIL.COM',NULL,'vistas/img/empleados/default/anonymous.png','2021-05-01 13:05:35');
/*!40000 ALTER TABLE `t_Empleados` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `t_Marca`
--

DROP TABLE IF EXISTS `t_Marca`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `t_Marca` (
  `id_marca` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(45) NOT NULL,
  PRIMARY KEY (`id_marca`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_Marca`
--

LOCK TABLES `t_Marca` WRITE;
/*!40000 ALTER TABLE `t_Marca` DISABLE KEYS */;
INSERT INTO `t_Marca` VALUES (1,'HP'),(2,'LOGITECH'),(3,'CMTECK'),(4,'ZEBRA'),(5,'SAMSUNG'),(6,'MOTOROLA');
/*!40000 ALTER TABLE `t_Marca` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `t_Modelo`
--

DROP TABLE IF EXISTS `t_Modelo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `t_Modelo` (
  `id_modelo` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(45) NOT NULL,
  PRIMARY KEY (`id_modelo`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_Modelo`
--

LOCK TABLES `t_Modelo` WRITE;
/*!40000 ALTER TABLE `t_Modelo` DISABLE KEYS */;
INSERT INTO `t_Modelo` VALUES (1,'H390'),(2,'2013 SLIM DOCKING'),(3,'TPN-DA17'),(4,'SUPER SLIM 2012'),(5,'ZM330'),(6,'ZD620'),(7,'ZT510'),(8,'ZT610'),(9,'GX430T'),(10,'ELITEDISPLAY E223'),(11,'ELITEBOOK 840 G6'),(12,'ELITEBOOK 745 G6'),(13,'PRODESK 600 G5'),(14,'EPLAY 6'),(15,'ELITEDESK 705 G5');
/*!40000 ALTER TABLE `t_Modelo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `t_Periferico`
--

DROP TABLE IF EXISTS `t_Periferico`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `t_Periferico` (
  `id_periferico` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(80) NOT NULL,
  `fecha` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id_periferico`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_Periferico`
--

LOCK TABLES `t_Periferico` WRITE;
/*!40000 ALTER TABLE `t_Periferico` DISABLE KEYS */;
INSERT INTO `t_Periferico` VALUES (1,'DESKTOP','2021-04-26 18:25:05'),(2,'LAPTOP','2021-04-26 18:28:28'),(3,'MONITOR','2021-04-26 18:28:37'),(4,'HEADSET','2021-04-26 18:30:51'),(5,'DOCKING  ST','2021-04-27 22:53:08'),(6,'CARGADOR','2021-04-27 23:02:40'),(7,'BOCINAS','2021-04-29 10:24:19'),(8,'IMPRESORA TERMICA','2021-04-30 21:21:00'),(9,'TELEFONO','2021-05-01 11:51:29');
/*!40000 ALTER TABLE `t_Periferico` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `t_PlanTelefonia`
--

DROP TABLE IF EXISTS `t_PlanTelefonia`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `t_PlanTelefonia` (
  `id_plan_tel` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  PRIMARY KEY (`id_plan_tel`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_PlanTelefonia`
--

LOCK TABLES `t_PlanTelefonia` WRITE;
/*!40000 ALTER TABLE `t_PlanTelefonia` DISABLE KEYS */;
INSERT INTO `t_PlanTelefonia` VALUES (1,'NO APLICA'),(2,'TMSLE MIX 1500 24M'),(3,'TMSLE 6500D VTR 24M'),(4,'TMSLE D 1500 VC 24M'),(5,'DATOS TB 7GB 18M');
/*!40000 ALTER TABLE `t_PlanTelefonia` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `t_Productos`
--

DROP TABLE IF EXISTS `t_Productos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `t_Productos` (
  `id_producto` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `id_almacen` smallint(5) unsigned NOT NULL,
  `id_edo_epo` smallint(5) unsigned NOT NULL,
  `id_marca` smallint(5) unsigned NOT NULL,
  `id_modelo` smallint(5) unsigned NOT NULL,
  `id_periferico` smallint(5) unsigned NOT NULL,
  `id_empleado` smallint(5) unsigned DEFAULT 1,
  `id_telefonia` smallint(5) unsigned NOT NULL,
  `id_plan_tel` smallint(5) unsigned NOT NULL,
  `num_tel` varchar(25) DEFAULT NULL,
  `cuenta` varchar(45) DEFAULT NULL,
  `direcc_mac_tel` varchar(20) DEFAULT NULL,
  `imei_tel` varchar(30) DEFAULT NULL,
  `nomenclatura` varchar(45) DEFAULT NULL,
  `num_serie` varchar(45) DEFAULT NULL,
  `imagen_producto` varchar(100) NOT NULL,
  `stock` smallint(5) unsigned DEFAULT 0,
  `precio_compra` decimal(10,2) DEFAULT NULL,
  `precio_venta` decimal(10,2) DEFAULT NULL,
  `cuantas_veces` tinyint(4) DEFAULT NULL,
  `asignado` char(1) DEFAULT 'N',
  `fecha_arribo` datetime NOT NULL DEFAULT current_timestamp(),
  `edo_tel` varchar(15) DEFAULT NULL,
  `num_ip` varchar(20) DEFAULT NULL,
  `comentarios` text DEFAULT NULL,
  `asset` varchar(15) DEFAULT NULL,
  `loftware` varchar(10) DEFAULT NULL,
  `area` varchar(20) DEFAULT NULL,
  `linea` varchar(25) DEFAULT NULL,
  `estacion` varchar(50) DEFAULT NULL,
  `npa` varchar(15) DEFAULT NULL,
  `idf` varchar(5) DEFAULT NULL,
  `patch_panel` varchar(5) DEFAULT NULL,
  `puerto` varchar(5) DEFAULT NULL,
  `funcion` varchar(20) DEFAULT NULL,
  `qdc` varchar(15) DEFAULT NULL,
  `jls` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`id_producto`),
  KEY `id_almacen` (`id_almacen`),
  KEY `id_empleado` (`id_empleado`),
  KEY `id_edo_epo` (`id_edo_epo`),
  KEY `id_marca` (`id_marca`),
  KEY `id_modelo` (`id_modelo`),
  KEY `id_periferico` (`id_periferico`),
  KEY `id_telefonia` (`id_telefonia`),
  KEY `id_plan_tel` (`id_plan_tel`),
  CONSTRAINT `t_Productos_ibfk_1` FOREIGN KEY (`id_almacen`) REFERENCES `t_Almacen` (`id_almacen`) ON UPDATE CASCADE,
  CONSTRAINT `t_Productos_ibfk_2` FOREIGN KEY (`id_empleado`) REFERENCES `t_Empleados` (`id_empleado`) ON UPDATE CASCADE,
  CONSTRAINT `t_Productos_ibfk_3` FOREIGN KEY (`id_edo_epo`) REFERENCES `t_Edo_epo` (`id_edo_epo`) ON UPDATE CASCADE,
  CONSTRAINT `t_Productos_ibfk_4` FOREIGN KEY (`id_marca`) REFERENCES `t_Marca` (`id_marca`) ON UPDATE CASCADE,
  CONSTRAINT `t_Productos_ibfk_5` FOREIGN KEY (`id_modelo`) REFERENCES `t_Modelo` (`id_modelo`) ON UPDATE CASCADE,
  CONSTRAINT `t_Productos_ibfk_6` FOREIGN KEY (`id_periferico`) REFERENCES `t_Periferico` (`id_periferico`) ON UPDATE CASCADE,
  CONSTRAINT `t_Productos_ibfk_7` FOREIGN KEY (`id_telefonia`) REFERENCES `t_Telefonia` (`id_telefonia`) ON UPDATE CASCADE,
  CONSTRAINT `t_Productos_ibfk_8` FOREIGN KEY (`id_plan_tel`) REFERENCES `t_PlanTelefonia` (`id_plan_tel`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_Productos`
--

LOCK TABLES `t_Productos` WRITE;
/*!40000 ALTER TABLE `t_Productos` DISABLE KEYS */;
INSERT INTO `t_Productos` VALUES (1,1,1,1,2,5,2,2,1,'0','','','','MXTIJH067HGSL','5CG001WDVH','vistas/img/productos/default/anonymous.png',0,220.00,220.00,1,'N','2021-04-27 23:00:52','NO Aplica','','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(2,1,1,1,3,6,2,2,1,'0','','','','MXTIJH067HGSL','WHQRQ0AARD281K','vistas/img/productos/default/anonymous.png',0,60.00,60.00,1,'N','2021-04-27 23:07:32','NO Aplica','','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(3,1,1,1,4,5,3,2,1,'0','','','','','5CG933XV2T','vistas/img/productos/default/anonymous.png',0,220.00,220.00,1,'N','2021-04-27 23:38:34','NO Aplica','','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(4,1,1,1,3,6,3,2,1,'0','','','','','WHQRN0A1RCKM8C','vistas/img/productos/default/anonymous.png',0,80.00,80.00,1,'N','2021-04-27 23:42:14','NO Aplica','','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(5,1,1,2,1,4,4,2,1,'0','','','','','','vistas/img/productos/default/anonymous.png',0,60.00,60.00,1,'N','2021-04-27 23:52:52','NO Aplica','','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(6,1,1,3,5,7,4,2,1,'0','','','','','B07K46LDZM','vistas/img/productos/default/anonymous.png',0,50.00,50.00,1,'N','2021-04-29 10:26:03','NO Aplica','','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(7,1,1,4,6,8,7,2,1,'0','','','','','D1J181206570','vistas/img/productos/default/anonymous.png',0,600.00,600.00,1,'N','2021-04-30 23:54:31','NO Aplica','10.53.221.272','','MXTIJH3000102','152','PHILIPS','RESPIRADORES','BLOWERASSY','10522','IDF2','PP10','40','MES',NULL,NULL),(8,1,1,4,6,8,7,2,1,'0','','','','','D1J181206543','vistas/img/productos/default/anonymous.png',0,800.00,800.00,1,'N','2021-05-01 10:39:49','NO Aplica','10.53.221.32','','MXTIJH3000160','154','PHILIPS','PRODUCCION','PACKAGING','10526','IDF2','PP10','14','',NULL,NULL),(9,1,1,1,10,3,5,2,1,'0','','','','','CNC0240NV8','vistas/img/productos/default/anonymous.png',0,220.00,220.00,1,'N','2021-05-01 11:10:41','NO Disponible','','','MXTIJH3000029','','','','','','','','','',NULL,NULL),(10,1,1,1,13,1,5,2,1,'0','','','','','MXL00735KJ','vistas/img/productos/default/anonymous.png',0,800.00,800.00,1,'N','2021-05-01 11:16:52','NO Aplica','','','MXTIJH3000030','','','','','','','','','','4.5','3.5'),(11,1,1,6,14,9,6,1,2,'6631260857','12094956','','','','','vistas/img/productos/default/anonymous.png',0,180.00,180.00,1,'N','2021-05-01 12:17:44','Asignado','','','','','','','','','','','','',NULL,NULL),(12,1,1,1,15,1,7,2,1,'0','','','','MXTIJH2550L0D','MXL02550L0','vistas/img/productos/default/anonymous.png',0,800.00,800.00,1,'N','2021-05-01 18:14:01','NO Aplica','','','MXTIJH3000008','','Cleanroom','ACE 2','Torque spring & outer tube assy','SPR-000002','IDF02','PP01','42','','3.5','');
/*!40000 ALTER TABLE `t_Productos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `t_Puesto`
--

DROP TABLE IF EXISTS `t_Puesto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `t_Puesto` (
  `id_puesto` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(45) NOT NULL,
  PRIMARY KEY (`id_puesto`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_Puesto`
--

LOCK TABLES `t_Puesto` WRITE;
/*!40000 ALTER TABLE `t_Puesto` DISABLE KEYS */;
INSERT INTO `t_Puesto` VALUES (1,'SR ENTERPRISE RESOURCE PLANNING'),(2,'COMPONENT ENGINEER SR'),(3,'GERENTE DE LOGISTICA Y ADUANAS'),(4,'BANCA DE TALENTO ING INDUSTRIAL'),(5,'GTE PROY INTRODUCC NUEVOS PROD'),(6,'GERENTE DE PRODUCCION');
/*!40000 ALTER TABLE `t_Puesto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `t_Responsivas`
--

DROP TABLE IF EXISTS `t_Responsivas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `t_Responsivas` (
  `id_responsiva` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `id_empleado` smallint(5) unsigned NOT NULL,
  `id_usuario` smallint(5) unsigned NOT NULL,
  `id_almacen` smallint(5) unsigned NOT NULL,
  `activa` char(1) NOT NULL DEFAULT 'S',
  `num_folio` smallint(5) unsigned NOT NULL,
  `modalidad_entrega` varchar(25) NOT NULL,
  `num_ticket` varchar(30) DEFAULT NULL,
  `responsiva_firmada` varchar(100) DEFAULT NULL,
  `comentario` text DEFAULT NULL,
  `comentario_devolucion` text DEFAULT NULL,
  `productos` text DEFAULT NULL,
  `impuesto` decimal(10,2) DEFAULT NULL,
  `neto` decimal(10,2) DEFAULT NULL,
  `total` decimal(10,2) DEFAULT NULL,
  `fecha_devolucion` date DEFAULT NULL,
  `fecha_asignado` date DEFAULT NULL,
  PRIMARY KEY (`id_responsiva`),
  KEY `id_empleado` (`id_empleado`),
  KEY `id_usuario` (`id_usuario`),
  KEY `id_almacen` (`id_almacen`),
  CONSTRAINT `t_Responsivas_ibfk_1` FOREIGN KEY (`id_empleado`) REFERENCES `t_Empleados` (`id_empleado`) ON UPDATE CASCADE,
  CONSTRAINT `t_Responsivas_ibfk_2` FOREIGN KEY (`id_usuario`) REFERENCES `t_Usuarios` (`id_usuario`) ON UPDATE CASCADE,
  CONSTRAINT `t_Responsivas_ibfk_3` FOREIGN KEY (`id_almacen`) REFERENCES `t_Almacen` (`id_almacen`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_Responsivas`
--

LOCK TABLES `t_Responsivas` WRITE;
/*!40000 ALTER TABLE `t_Responsivas` DISABLE KEYS */;
INSERT INTO `t_Responsivas` VALUES (1,2,3,1,'S',1,'Permanente','',NULL,'Comentarios',NULL,'[{\"id\":\"1\",\"descripcion\":\"DOCKING STATTION\",\"cantidad\":\"1\",\"stock\":\"0\",\"precio\":\"220.00\",\"total\":\"220\"},{\"id\":\"2\",\"descripcion\":\"CARGADOR\",\"cantidad\":\"1\",\"stock\":\"0\",\"precio\":\"60.00\",\"total\":\"60.00\"}]',0.00,280.00,280.00,NULL,'2020-06-08'),(2,3,3,1,'S',2,'Permanente','',NULL,'Comentarios',NULL,'[{\"id\":\"3\",\"descripcion\":\"DOCKING STATTION\",\"cantidad\":\"1\",\"stock\":\"0\",\"precio\":\"220.00\",\"total\":\"220\"},{\"id\":\"4\",\"descripcion\":\"CARGADOR\",\"cantidad\":\"1\",\"stock\":\"0\",\"precio\":\"80.00\",\"total\":\"80.00\"}]',0.00,300.00,300.00,NULL,'2020-01-13'),(3,4,3,1,'S',3,'Permanente','',NULL,'Comentarios',NULL,'[{\"id\":\"5\",\"descripcion\":\"HEADSET\",\"cantidad\":\"1\",\"stock\":\"0\",\"precio\":\"60.00\",\"total\":\"60.00\"}]',0.00,60.00,60.00,NULL,'2020-05-11'),(4,4,3,1,'S',4,'Permanente','',NULL,'Comentarios',NULL,'[{\"id\":\"6\",\"descripcion\":\"BOCINAS\",\"cantidad\":\"1\",\"stock\":\"0\",\"precio\":\"50.00\",\"total\":\"50.00\"}]',0.00,50.00,50.00,NULL,'2021-04-29'),(5,5,3,1,'S',5,'Permanente','',NULL,'Comentarios',NULL,'[{\"id\":\"9\",\"descripcion\":\"MONITOR\",\"cantidad\":\"1\",\"stock\":\"0\",\"precio\":\"220.00\",\"total\":\"220\"},{\"id\":\"10\",\"descripcion\":\"DESKTOP\",\"cantidad\":\"1\",\"stock\":\"0\",\"precio\":\"800.00\",\"total\":\"800.00\"}]',0.00,1020.00,1020.00,NULL,'2021-04-27'),(6,6,3,1,'S',6,'Permanente','',NULL,'Comentarios',NULL,'[{\"id\":\"11\",\"descripcion\":\"TELEFONO\",\"cantidad\":\"1\",\"stock\":\"0\",\"precio\":\"180.00\",\"total\":\"180.00\"}]',0.00,180.00,180.00,NULL,'2020-03-02'),(7,7,3,1,'S',7,'Permanente','',NULL,'Comentarios',NULL,'[{\"id\":\"7\",\"descripcion\":\"IMPRESORA TERMICA\",\"cantidad\":\"1\",\"stock\":\"0\",\"precio\":\"600.00\",\"total\":\"600.00\"}]',0.00,600.00,600.00,NULL,'2020-08-03'),(8,7,3,1,'S',8,'Permanente','',NULL,'Comentarios',NULL,'[{\"id\":\"8\",\"descripcion\":\"IMPRESORA TERMICA\",\"cantidad\":\"1\",\"stock\":\"0\",\"precio\":\"800.00\",\"total\":\"800.00\"}]',0.00,800.00,800.00,NULL,'2020-08-03'),(9,7,3,1,'S',9,'Permanente','',NULL,'Comentarios',NULL,'[{\"id\":\"12\",\"descripcion\":\"DESKTOP\",\"cantidad\":\"1\",\"stock\":\"0\",\"precio\":\"800.00\",\"total\":\"800.00\"}]',0.00,800.00,800.00,NULL,'2020-08-03');
/*!40000 ALTER TABLE `t_Responsivas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `t_Supervisor`
--

DROP TABLE IF EXISTS `t_Supervisor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `t_Supervisor` (
  `id_supervisor` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(50) NOT NULL,
  PRIMARY KEY (`id_supervisor`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_Supervisor`
--

LOCK TABLES `t_Supervisor` WRITE;
/*!40000 ALTER TABLE `t_Supervisor` DISABLE KEYS */;
INSERT INTO `t_Supervisor` VALUES (1,'EDGAR GONZALEZ'),(2,'JOSE SIMENTAL QUINTERO'),(3,'NO APLICA'),(4,'SERGIO TORRES'),(5,'FERNANDO RAMIREZ ORTEGA'),(6,'YOVANI ARCE MUÑOZ');
/*!40000 ALTER TABLE `t_Supervisor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `t_Tareas`
--

DROP TABLE IF EXISTS `t_Tareas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `t_Tareas` (
  `id_tarea` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `id_empleado` smallint(5) unsigned NOT NULL,
  `id_almacen` smallint(5) unsigned NOT NULL,
  `id_usuario` smallint(5) unsigned NOT NULL,
  `tarea_asignada` varchar(70) NOT NULL,
  `ticket` varchar(30) DEFAULT NULL,
  `comentario1` text DEFAULT NULL,
  `comentario2` text DEFAULT NULL,
  `fecha_inicio` date DEFAULT NULL,
  `fecha_fin` date DEFAULT NULL,
  PRIMARY KEY (`id_tarea`),
  KEY `id_empleado` (`id_empleado`),
  KEY `id_almacen` (`id_almacen`),
  KEY `id_usuario` (`id_usuario`),
  CONSTRAINT `t_Tareas_ibfk_1` FOREIGN KEY (`id_empleado`) REFERENCES `t_Empleados` (`id_empleado`) ON UPDATE CASCADE,
  CONSTRAINT `t_Tareas_ibfk_2` FOREIGN KEY (`id_almacen`) REFERENCES `t_Almacen` (`id_almacen`) ON UPDATE CASCADE,
  CONSTRAINT `t_Tareas_ibfk_3` FOREIGN KEY (`id_usuario`) REFERENCES `t_Usuarios` (`id_usuario`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_Tareas`
--

LOCK TABLES `t_Tareas` WRITE;
/*!40000 ALTER TABLE `t_Tareas` DISABLE KEYS */;
/*!40000 ALTER TABLE `t_Tareas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `t_Telefonia`
--

DROP TABLE IF EXISTS `t_Telefonia`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `t_Telefonia` (
  `id_telefonia` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  PRIMARY KEY (`id_telefonia`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_Telefonia`
--

LOCK TABLES `t_Telefonia` WRITE;
/*!40000 ALTER TABLE `t_Telefonia` DISABLE KEYS */;
INSERT INTO `t_Telefonia` VALUES (1,'TELCEL'),(2,'NO APLICA');
/*!40000 ALTER TABLE `t_Telefonia` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `t_Ubicacion`
--

DROP TABLE IF EXISTS `t_Ubicacion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `t_Ubicacion` (
  `id_ubicacion` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(45) NOT NULL,
  PRIMARY KEY (`id_ubicacion`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_Ubicacion`
--

LOCK TABLES `t_Ubicacion` WRITE;
/*!40000 ALTER TABLE `t_Ubicacion` DISABLE KEYS */;
INSERT INTO `t_Ubicacion` VALUES (1,'Mezzanine'),(2,'ARCHIVERO 119'),(3,'ARCHIVERO 120'),(4,'GENERICO');
/*!40000 ALTER TABLE `t_Ubicacion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `t_Usuarios`
--

DROP TABLE IF EXISTS `t_Usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `t_Usuarios` (
  `id_usuario` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) NOT NULL,
  `usuario` varchar(45) NOT NULL,
  `clave` varchar(80) NOT NULL,
  `perfil` varchar(45) NOT NULL,
  `vendedor` varchar(45) DEFAULT NULL,
  `foto` varchar(100) DEFAULT NULL,
  `estado` tinyint(3) unsigned DEFAULT 0,
  `ultimo_login` datetime NOT NULL DEFAULT current_timestamp(),
  `fecha` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_Usuarios`
--

LOCK TABLES `t_Usuarios` WRITE;
/*!40000 ALTER TABLE `t_Usuarios` DISABLE KEYS */;
INSERT INTO `t_Usuarios` VALUES (1,'Administrador','admin','Resp2020Ene','Administrador','','',1,'2021-04-26 23:11:28','2021-04-27 01:16:24'),(3,'RAMON ORTEGA M','Ramon','$2a$07$asxx54ahjppf45sd87a5auyBVtgf0Yo/4SuWdmLhiqodyDEB0pai2','Administrador',NULL,'',1,'2021-05-01 10:23:21','2021-04-26 23:13:18');
/*!40000 ALTER TABLE `t_Usuarios` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-05-02  3:09:44
