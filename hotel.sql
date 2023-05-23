-- MySQL dump 10.13  Distrib 8.0.33, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: rg_hoteltest
-- ------------------------------------------------------
-- Server version	8.0.33

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `migrations`
--
USE tstDBuser4;

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2023_05_22_010257_create_state_table',1),(2,'2019_12_14_000001_create_personal_access_tokens_table',2),(3,'2023_05_20_190556_create_document_type-table',2),(5,'2023_05_22_032750_create_client_table',3),(6,'2023_05_22_180944_create_role_table',4),(10,'2023_05_22_182331_create_booking_table',5),(11,'2023_05_22_181452_create_room_table',6),(12,'2023_05_23_004536_create_reserve_table',7),(15,'2023_05_23_055418_create_waiting_client_table',8);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `personal_access_tokens`
--

LOCK TABLES `personal_access_tokens` WRITE;
/*!40000 ALTER TABLE `personal_access_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `personal_access_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rgclient`
--

DROP TABLE IF EXISTS `rgclient`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `rgclient` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastName` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `idDocType` bigint unsigned NOT NULL,
  `docnumber` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `birthdate` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `rgclient_docnumber_unique` (`docnumber`),
  UNIQUE KEY `rgclient_email_unique` (`email`),
  UNIQUE KEY `rgclient_birthdate_unique` (`birthdate`),
  KEY `rgclient_iddoctype_foreign` (`idDocType`),
  CONSTRAINT `rgclient_iddoctype_foreign` FOREIGN KEY (`idDocType`) REFERENCES `rgdoctypes` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rgclient`
--

LOCK TABLES `rgclient` WRITE;
/*!40000 ALTER TABLE `rgclient` DISABLE KEYS */;
INSERT INTO `rgclient` VALUES (1,'Laura Vanessa','Contreras Herrera',1,'1144074836','lauravcontrerash@gmail.com','1994-11-02',NULL,'2023-05-22 22:22:00'),(2,'Martin','Gomez Nuñez',3,'1107069274','martin@outlok.com','2023-01-20',NULL,NULL),(4,'Rafael Eduardo','Garcia Ocampo',1,'11070692741','rafael.garcia00@usc.edu.co','1991-12-26','2023-05-22 22:03:18','2023-05-22 22:03:18'),(5,'Gustavo Enrique','Garcia Nuñez',1,'16606323','tavoenrique@gmail.com','1971-04-24','2023-05-22 22:09:39','2023-05-22 22:09:39'),(6,'Gloria Esther','Ocampo',1,'29463724','gloria.e.o662006@gmail.com','1990-06-19','2023-05-22 22:11:38','2023-05-22 22:11:38'),(7,'Carlos Andres','Mejia Osorio',1,'1234','carlosmejia@hotmail.com','1992-11-22','2023-05-22 22:15:15','2023-05-22 22:15:15');
/*!40000 ALTER TABLE `rgclient` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rgdoctypes`
--

DROP TABLE IF EXISTS `rgdoctypes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `rgdoctypes` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `value` int NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `idState` bigint unsigned NOT NULL,
  `observation` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `rgdoctypes_idstate_foreign` (`idState`),
  CONSTRAINT `rgdoctypes_idstate_foreign` FOREIGN KEY (`idState`) REFERENCES `rgstate` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rgdoctypes`
--

LOCK TABLES `rgdoctypes` WRITE;
/*!40000 ALTER TABLE `rgdoctypes` DISABLE KEYS */;
INSERT INTO `rgdoctypes` VALUES (1,1,'Cedula Ciudadania',1,'Documento para personas con mayoria de edad',NULL,'2023-05-22 22:16:03'),(3,2,'Registro Civil',1,'Aplica','2023-05-22 08:16:35','2023-05-22 09:10:47');
/*!40000 ALTER TABLE `rgdoctypes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rgemployee`
--

DROP TABLE IF EXISTS `rgemployee`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `rgemployee` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastName` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `idDocType` bigint unsigned NOT NULL,
  `docnumber` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `idRol` bigint unsigned NOT NULL,
  `birthdate` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `rgemployee_docnumber_unique` (`docnumber`),
  UNIQUE KEY `rgemployee_birthdate_unique` (`birthdate`),
  KEY `rgemployee_iddoctype_foreign` (`idDocType`),
  KEY `rgemployee_idrol_foreign` (`idRol`),
  CONSTRAINT `rgemployee_iddoctype_foreign` FOREIGN KEY (`idDocType`) REFERENCES `rgdoctypes` (`id`),
  CONSTRAINT `rgemployee_idrol_foreign` FOREIGN KEY (`idRol`) REFERENCES `rgrole` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rgemployee`
--

LOCK TABLES `rgemployee` WRITE;
/*!40000 ALTER TABLE `rgemployee` DISABLE KEYS */;
INSERT INTO `rgemployee` VALUES (1,'Carlos Andres','Garcia Contreras',1,'1107069274',1,'1991-12-26',NULL,NULL),(2,'Laura Maria','Contreras Herrera',1,'1144074836',2,'1994-11-01',NULL,NULL);
/*!40000 ALTER TABLE `rgemployee` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rgreserve`
--

DROP TABLE IF EXISTS `rgreserve`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `rgreserve` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `idRoom` bigint unsigned NOT NULL,
  `daysNumber` int NOT NULL,
  `startDate` date NOT NULL,
  `endDate` date NOT NULL,
  `idClient` bigint unsigned NOT NULL,
  `idState` bigint unsigned NOT NULL,
  `idEmployee` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `rgreserve_idroom_foreign` (`idRoom`),
  KEY `rgreserve_idclient_foreign` (`idClient`),
  KEY `rgreserve_idstate_foreign` (`idState`),
  KEY `rgreserve_idemployee_foreign` (`idEmployee`),
  CONSTRAINT `rgreserve_idclient_foreign` FOREIGN KEY (`idClient`) REFERENCES `rgclient` (`id`),
  CONSTRAINT `rgreserve_idemployee_foreign` FOREIGN KEY (`idEmployee`) REFERENCES `rgemployee` (`id`),
  CONSTRAINT `rgreserve_idroom_foreign` FOREIGN KEY (`idRoom`) REFERENCES `rgroom` (`id`),
  CONSTRAINT `rgreserve_idstate_foreign` FOREIGN KEY (`idState`) REFERENCES `rgstate` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rgreserve`
--

LOCK TABLES `rgreserve` WRITE;
/*!40000 ALTER TABLE `rgreserve` DISABLE KEYS */;
INSERT INTO `rgreserve` VALUES (1,4,11,'2023-10-02','2023-10-13',1,1,1,'2023-05-23 05:47:28','2023-05-23 08:10:26'),(2,2,6,'2023-05-24','2023-05-30',1,1,1,'2023-05-23 05:47:48','2023-05-23 09:04:06'),(3,1,7,'2023-06-20','2023-06-27',1,1,1,'2023-05-23 11:16:02','2023-05-23 11:16:02');
/*!40000 ALTER TABLE `rgreserve` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rgrole`
--

DROP TABLE IF EXISTS `rgrole`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `rgrole` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rgrole`
--

LOCK TABLES `rgrole` WRITE;
/*!40000 ALTER TABLE `rgrole` DISABLE KEYS */;
INSERT INTO `rgrole` VALUES (1,'Gerente',NULL,NULL),(2,'Comercial',NULL,NULL),(3,'Contador',NULL,NULL);
/*!40000 ALTER TABLE `rgrole` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rgroom`
--

DROP TABLE IF EXISTS `rgroom`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `rgroom` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `idState` bigint unsigned NOT NULL,
  `capacity` int NOT NULL,
  `observation` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `rgroom_idstate_foreign` (`idState`),
  CONSTRAINT `rgroom_idstate_foreign` FOREIGN KEY (`idState`) REFERENCES `rgstate` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rgroom`
--

LOCK TABLES `rgroom` WRITE;
/*!40000 ALTER TABLE `rgroom` DISABLE KEYS */;
INSERT INTO `rgroom` VALUES (1,'Sencilla',1,1,'Habitacion con cama sencilla',NULL,NULL),(2,'Doble',1,2,'Habitacion con cama doble',NULL,NULL),(3,'Triple',2,3,'Habitacion con una cama doble y otra sencilla',NULL,NULL),(4,'Multiple',1,4,'Habitacion con dos camas dobles',NULL,NULL);
/*!40000 ALTER TABLE `rgroom` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rgstate`
--

DROP TABLE IF EXISTS `rgstate`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `rgstate` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rgstate`
--

LOCK TABLES `rgstate` WRITE;
/*!40000 ALTER TABLE `rgstate` DISABLE KEYS */;
INSERT INTO `rgstate` VALUES (1,'Activo',NULL,NULL),(2,'Inactivo',NULL,NULL);
/*!40000 ALTER TABLE `rgstate` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rgwaitingclient`
--

DROP TABLE IF EXISTS `rgwaitingclient`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `rgwaitingclient` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `idRoom` bigint unsigned NOT NULL,
  `startDate` date NOT NULL,
  `endDate` date NOT NULL,
  `idClient` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `rgwaitingclient_idroom_foreign` (`idRoom`),
  KEY `rgwaitingclient_idclient_foreign` (`idClient`),
  CONSTRAINT `rgwaitingclient_idclient_foreign` FOREIGN KEY (`idClient`) REFERENCES `rgclient` (`id`),
  CONSTRAINT `rgwaitingclient_idroom_foreign` FOREIGN KEY (`idRoom`) REFERENCES `rgroom` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rgwaitingclient`
--

LOCK TABLES `rgwaitingclient` WRITE;
/*!40000 ALTER TABLE `rgwaitingclient` DISABLE KEYS */;
INSERT INTO `rgwaitingclient` VALUES (1,1,'2023-06-20','2023-06-27',1,'2023-05-23 11:16:05','2023-05-23 11:16:05'),(2,1,'2023-06-20','2023-06-27',1,'2023-05-23 11:16:13','2023-05-23 11:16:13'),(3,1,'2023-06-23','2023-06-27',1,'2023-05-23 11:17:57','2023-05-23 11:17:57'),(4,1,'2023-06-23','2023-06-30',1,'2023-05-23 11:19:02','2023-05-23 11:19:02');
/*!40000 ALTER TABLE `rgwaitingclient` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-05-23  1:26:36
