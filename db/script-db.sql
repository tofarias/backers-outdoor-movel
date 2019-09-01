CREATE DATABASE  IF NOT EXISTS `backers_db` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci */;
USE `backers_db`;
-- MySQL dump 10.13  Distrib 5.7.27, for Linux (x86_64)
--
-- Host: localhost    Database: backers_db
-- ------------------------------------------------------
-- Server version	5.7.27-0ubuntu0.19.04.1

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
-- Table structure for table `client`
--

DROP TABLE IF EXISTS `client`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `client` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phone_prefix` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `car_model` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `car_color` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `doc_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `doc_type` enum('cpf','cnpj') COLLATE utf8_unicode_ci NOT NULL,
  `company_category` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `client`
--

LOCK TABLES `client` WRITE;
/*!40000 ALTER TABLE `client` DISABLE KEYS */;
INSERT INTO `client` VALUES (1,'Joaquin Mário Cortês Jr.','giovane09@ig.com.br','11','98340-2184','2019-01-27 07:57:57','2019-08-18 17:11:15','Classe SLS AMG','amarelo','025.843.844-42','cpf',NULL),(2,'Srta. Julieta Silvana Pereira Sobrinho','manuel.paz@oliveira.com','44','4574-1054','2019-05-12 18:58:39','2019-08-18 17:11:15','Compass','cinza','956.795.216-79','cpf',NULL),(3,'Ariana Esteves','andres46@neves.com','14','4894-8770','2018-10-05 17:43:21','2019-08-18 17:11:15','Golf Variant','preto','480.429.289-63','cpf',NULL),(4,'Srta. Tábata Toledo Neto','dominato.mariana@gmail.com','28','98510-1287','2018-12-27 11:09:09','2019-08-18 17:11:15','Focus','prata','884.065.503-41','cpf',NULL),(5,'Sr. Giovane Valentin Urias','elizabeth41@hotmail.com','93','95462-9763','2018-11-10 13:07:15','2019-08-18 17:11:15','Doblò Cargo','cinza','609.523.427-15','cpf',NULL),(6,'Sra. Alessandra Tábata Pereira','rico.evandro@delvalle.br','82','95673-6319','2019-04-26 20:36:49','2019-08-18 17:11:15','Cooper','cinza','142.219.679-86','cpf',NULL),(7,'Dr. Sabrina Faro Neto','emilia53@hotmail.com','51','90872-3193','2018-09-18 00:13:12','2019-08-18 17:11:15','Golf','cinza','417.551.195-42','cpf',NULL),(8,'Sr. Simon Rangel Faro','fonseca.bianca@desouza.net','92','3272-3034','2018-10-18 06:12:21','2019-08-18 17:11:15','Doblò Cargo','vermelho','923.481.606-41','cpf',NULL),(9,'Lucas Marques Neto','salgado.pedro@ortiz.net.br','31','95451-0076','2019-07-28 01:20:13','2019-08-18 17:11:15','Focus','vermelho','270.759.378-80','cpf',NULL),(10,'Sr. Ricardo Alonso Torres Jr.','camila.romero@rocha.com.br','79','93650-4717','2019-03-25 10:22:53','2019-08-18 17:11:15','Golf Variant','azul','368.529.335-47','cpf',NULL),(12,NULL,'dante96@ig.com.br',NULL,NULL,'2018-09-11 15:05:00','2019-08-18 17:11:15',NULL,NULL,'20.113.950/0001-30','cnpj','Restaurante'),(13,NULL,'eduardo36@delgado.com.br',NULL,NULL,'2019-04-07 20:54:46','2019-08-18 17:11:15',NULL,NULL,'20.836.973/0001-72','cnpj','Fábrica de computadores'),(14,NULL,'catarina.prado@hotmail.com',NULL,NULL,'2018-08-23 02:34:39','2019-08-18 17:11:15',NULL,NULL,'81.109.334/0001-08','cnpj','Cinema'),(15,NULL,'rivera.francisco@davila.com.br',NULL,NULL,'2019-01-01 09:09:11','2019-08-18 17:11:15',NULL,NULL,'29.049.350/0001-24','cnpj','Fábrica de computadores'),(16,NULL,'serrano.luciana@r7.com',NULL,NULL,'2019-05-27 06:57:23','2019-08-18 17:11:15',NULL,NULL,'57.110.463/0001-23','cnpj','Fábrica de móveis artesanais'),(17,NULL,'kmascarenhas@r7.com',NULL,NULL,'2018-11-25 10:22:27','2019-08-18 17:11:15',NULL,NULL,'44.251.268/0001-71','cnpj','Lavanderia'),(18,NULL,'catarina.mendes@uol.com.br',NULL,NULL,'2018-09-11 20:10:14','2019-08-18 17:11:15',NULL,NULL,'67.274.239/0001-20','cnpj','Fábrica de esquadrias'),(19,NULL,'mariana13@yahoo.com',NULL,NULL,'2018-09-20 23:55:59','2019-08-18 17:11:15',NULL,NULL,'34.252.920/0001-19','cnpj','Atacado de laticínios'),(20,NULL,'elizabeth.matos@flores.net.br',NULL,NULL,'2018-10-17 17:17:08','2019-08-18 17:11:15',NULL,NULL,'77.210.882/0001-44','cnpj','Fábrica de computadores');
/*!40000 ALTER TABLE `client` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `site`
--

DROP TABLE IF EXISTS `site`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `site` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `url` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `text` varchar(1000) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `site`
--

LOCK TABLES `site` WRITE;
/*!40000 ALTER TABLE `site` DISABLE KEYS */;
INSERT INTO `site` VALUES (1,'/site/texto/empresa','<h2 style=\"text-align:center;\">A Empresa...</h2><p style=\"text-align:center;\">&nbsp;</p><p style=\"text-align:center;\">Somos uma empresa com a solução para quem utiliza automóveis diariamente. E uma solução para o Marketing da sua empresa.<br>Como? Para carros utilitários, iremos alugar o vidro traseiro, gerando renda extra.<br>Para empresas, iremos divulgar sua marca ou produto em vidros traseiros de automóveis, tendo grande visibilidade,&nbsp;<br>onde em uma cidade grande a média de tempo gasto com trânsito é de 2 Horas e 28 Minutos em média, de acordo com a CNDL em 2018.<br>Cadastra-se ou entre em contato conosco e saiba mais.</p>','2019-08-18 17:11:15','2019-08-18 21:14:57');
/*!40000 ALTER TABLE `site` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'Adminstrador','user@admin.com','$2y$10$QW..fhLMeRwkvlp/08Q3Lu/wlRxqXNVzXnNoMRGWBlfK6rvnq8fZC','2019-08-18 17:11:15','2019-08-18 17:11:15');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'backers_db'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-08-19 22:23:24
