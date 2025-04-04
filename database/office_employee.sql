-- MySQL dump 10.13  Distrib 8.0.41, for Win64 (x86_64)
--
-- Host: localhost    Database: office
-- ------------------------------------------------------
-- Server version	8.0.41

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
-- Table structure for table `employee`
--

DROP TABLE IF EXISTS `employee`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `employee` (
  `code` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `passport_photo` longblob,
  `contact_no` varchar(15) NOT NULL,
  `aadhar_no` varchar(12) NOT NULL,
  `pan_no` varchar(10) NOT NULL,
  `date_of_joining` date NOT NULL,
  `date_of_retirement` date NOT NULL,
  `designation` varchar(100) DEFAULT NULL,
  `father_husband_name` varchar(255) DEFAULT NULL,
  `sex` enum('Male','Female','Other') NOT NULL DEFAULT 'Male',
  `caste` varchar(100) DEFAULT NULL,
  `religion` varchar(100) DEFAULT NULL,
  `identification_mark` varchar(255) DEFAULT NULL,
  `educational_qualification` varchar(255) DEFAULT NULL,
  `marital_status` enum('Married','Single') NOT NULL DEFAULT 'Single',
  `local_address` text,
  `permanent_address` text,
  `pf_account_number` varchar(50) DEFAULT NULL,
  `date_of_joining_pf` date DEFAULT NULL,
  `date_of_termination` date DEFAULT NULL,
  `file` longblob,
  PRIMARY KEY (`code`)
) ENGINE=InnoDB AUTO_INCREMENT=10610 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `employee`
--

LOCK TABLES `employee` WRITE;
/*!40000 ALTER TABLE `employee` DISABLE KEYS */;
/*!40000 ALTER TABLE `employee` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-02-01 17:47:57
