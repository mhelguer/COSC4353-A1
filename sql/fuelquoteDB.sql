-- MySQL dump 10.13  Distrib 8.0.23, for Win64 (x86_64)
--
-- Host: database-4353.ctkzz4wlfaku.us-east-2.rds.amazonaws.com    Database: fuelQuote_schema
-- ------------------------------------------------------
-- Server version	8.0.23

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
SET @MYSQLDUMP_TEMP_LOG_BIN = @@SESSION.SQL_LOG_BIN;
SET @@SESSION.SQL_LOG_BIN= 0;

--
-- GTID state at the beginning of the backup 
--

SET @@GLOBAL.GTID_PURGED=/*!80000 '+'*/ '';

--
-- Table structure for table `client_info`
--

DROP TABLE IF EXISTS `client_info`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `client_info` (
  `Username` varchar(45) NOT NULL,
  `fullname` varchar(50) NOT NULL,
  `address1` varchar(100) NOT NULL,
  `address2` varchar(100) DEFAULT NULL,
  `city` varchar(100) NOT NULL,
  `state` enum('AL','AK','AZ','AR','CA','CO','CT','DE','FL','GA','HI','ID','IL','IN','IA','KS','KY','LA','ME','MD','MA','MI','MN','MS','MO','MT','NE','NV','NH','NJ','NM','NY','NC','ND','OH','OK','OR','PA','RI','SC','SD','TN','TX','UT','VT','VA','WA','WV','WI','WY','DC') NOT NULL,
  `zipcode` varchar(10) NOT NULL,
  `Deleted` tinyint NOT NULL DEFAULT '0',
  PRIMARY KEY (`Username`),
  UNIQUE KEY `username_UNIQUE` (`Username`),
  KEY `Is_Deleted_Info_idx` (`Deleted`),
  CONSTRAINT `Is_Deleted_Info` FOREIGN KEY (`Deleted`) REFERENCES `login` (`Is_Deleted`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `Username_Info` FOREIGN KEY (`Username`) REFERENCES `login` (`Username`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `fuel_orders`
--

DROP TABLE IF EXISTS `fuel_orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `fuel_orders` (
  `order_id` int NOT NULL AUTO_INCREMENT,
  `User` varchar(45) NOT NULL,
  `gallons` decimal(10,0) NOT NULL,
  `delivery_address` varchar(45) NOT NULL,
  `delivery_date` date NOT NULL,
  `pricepergal` double NOT NULL COMMENT 'to be calculated by pricing module',
  `total_due` double NOT NULL COMMENT 'calculated, gallons*price',
  PRIMARY KEY (`order_id`),
  UNIQUE KEY `order_id_UNIQUE` (`order_id`),
  KEY `Username_fuel_idx` (`User`),
  CONSTRAINT `Username_fuel` FOREIGN KEY (`User`) REFERENCES `login` (`Username`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `login`
--

DROP TABLE IF EXISTS `login`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `login` (
  `Username` varchar(45) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Acc_Type` int NOT NULL DEFAULT '0',
  `Is_Deleted` tinyint NOT NULL DEFAULT '0',
  PRIMARY KEY (`Username`),
  UNIQUE KEY `Username_UNIQUE` (`Username`),
  KEY `Is_Deleted` (`Is_Deleted`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Temporary view structure for view `order_view`
--

DROP TABLE IF EXISTS `order_view`;
/*!50001 DROP VIEW IF EXISTS `order_view`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `order_view` AS SELECT 
 1 AS `User`,
 1 AS `Total_Gallons`,
 1 AS `Total_Cost`,
 1 AS `Total_Orders`*/;
SET character_set_client = @saved_cs_client;

--
-- Dumping events for database 'fuelQuote_schema'
--

--
-- Dumping routines for database 'fuelQuote_schema'
--

--
-- Final view structure for view `order_view`
--

/*!50001 DROP VIEW IF EXISTS `order_view`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_0900_ai_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`admin`@`%` SQL SECURITY DEFINER */
/*!50001 VIEW `order_view` (`User`,`Total_Gallons`,`Total_Cost`,`Total_Orders`) AS select `f`.`User` AS `User`,sum(`f`.`gallons`) AS `SUM(f.gallons)`,sum(`f`.`total_due`) AS `SUM(f.total_due)`,count(`f`.`order_id`) AS `COUNT(f.order_id)` from (`fuel_orders` `f` join `login` `l` on((`l`.`Username` = `f`.`User`))) where (`l`.`Is_Deleted` = 0) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;
SET @@SESSION.SQL_LOG_BIN = @MYSQLDUMP_TEMP_LOG_BIN;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-07-23 21:48:35
