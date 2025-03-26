CREATE DATABASE  IF NOT EXISTS `ivystorm_leads_db_2018` /*!40100 DEFAULT CHARACTER SET utf8mb3 */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `ivystorm_leads_db_2018`;
-- MySQL dump 10.13  Distrib 8.0.34, for Win64 (x86_64)
--
-- Host: db1.cluster-czb7nnevxblx.us-east-1.rds.amazonaws.com    Database: ivystorm_leads_db_2018
-- ------------------------------------------------------
-- Server version	8.0.32

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
-- Table structure for table `Info_Leads`
--

DROP TABLE IF EXISTS `Info_Leads`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Info_Leads` (
  `Lead_Id` int NOT NULL AUTO_INCREMENT,
  `First_Name` varchar(100) DEFAULT NULL,
  `Last_Name` varchar(100) DEFAULT NULL,
  `Email_Leads` varchar(100) DEFAULT NULL,
  `Phone` varchar(100) DEFAULT NULL,
  `Time_to_Call` varchar(100) DEFAULT NULL,
  `Country` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`Lead_Id`)
) ENGINE=InnoDB AUTO_INCREMENT=180067 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `Info_Leads_SourceC_Rel`
--

DROP TABLE IF EXISTS `Info_Leads_SourceC_Rel`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Info_Leads_SourceC_Rel` (
  `Leads_SourceC_RelId` int NOT NULL AUTO_INCREMENT,
  `SourceCodeId` int DEFAULT NULL,
  `Lead_Id` int DEFAULT NULL,
  PRIMARY KEY (`Leads_SourceC_RelId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `Info_Leads_To_Project_Rel`
--

DROP TABLE IF EXISTS `Info_Leads_To_Project_Rel`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Info_Leads_To_Project_Rel` (
  `Leads_To_ProjectId` int NOT NULL AUTO_INCREMENT,
  `Lead_Id` int DEFAULT NULL,
  `Project_Id` int DEFAULT NULL,
  `SourceCodeId` int NOT NULL,
  `Date_Joined` datetime DEFAULT CURRENT_TIMESTAMP,
  `Comments` longtext,
  PRIMARY KEY (`Leads_To_ProjectId`),
  KEY `LeadsId_to_info_leads_idx` (`Lead_Id`),
  KEY `ProjectId_to_info_project_idx` (`Project_Id`),
  KEY `SourceId_to_info_source_idx` (`SourceCodeId`),
  CONSTRAINT `LeadsId_to_info_leads` FOREIGN KEY (`Lead_Id`) REFERENCES `Info_Leads` (`Lead_Id`),
  CONSTRAINT `ProjectId_to_info_project` FOREIGN KEY (`Project_Id`) REFERENCES `Info_Projects` (`Project_Id`),
  CONSTRAINT `SourceId_to_info_source` FOREIGN KEY (`SourceCodeId`) REFERENCES `Info_SourceCode` (`SourceCodeId`)
) ENGINE=InnoDB AUTO_INCREMENT=380372 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `Info_Notification`
--

DROP TABLE IF EXISTS `Info_Notification`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Info_Notification` (
  `Info_Notification_Id` int NOT NULL AUTO_INCREMENT,
  `ProjectName_log` varchar(100) DEFAULT NULL,
  `Status` varchar(100) DEFAULT NULL,
  `TimeStamp` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Rmt_Add` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`Info_Notification_Id`)
) ENGINE=InnoDB AUTO_INCREMENT=5921 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `Info_Projects`
--

DROP TABLE IF EXISTS `Info_Projects`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Info_Projects` (
  `Project_Id` int NOT NULL AUTO_INCREMENT,
  `Name` varchar(100) DEFAULT NULL,
  `SaleforceCode` varchar(100) DEFAULT NULL,
  `Project_Url` longtext,
  `Category` varchar(100) DEFAULT 'Real-Estate',
  `Sku` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`Project_Id`),
  UNIQUE KEY `Name` (`Name`)
) ENGINE=InnoDB AUTO_INCREMENT=745 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `Info_Recipients`
--

DROP TABLE IF EXISTS `Info_Recipients`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Info_Recipients` (
  `Info_Recipients_Id` int NOT NULL AUTO_INCREMENT,
  `Project_Id` int DEFAULT NULL,
  `Recipients` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`Info_Recipients_Id`),
  KEY `Recipients_Project_idx` (`Project_Id`),
  CONSTRAINT `Recipients_Project` FOREIGN KEY (`Project_Id`) REFERENCES `Info_Projects` (`Project_Id`)
) ENGINE=InnoDB AUTO_INCREMENT=2770 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `Info_Session`
--

DROP TABLE IF EXISTS `Info_Session`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Info_Session` (
  `Session_Id` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `Session_Expires` datetime NOT NULL,
  `Session_Data` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci,
  PRIMARY KEY (`Session_Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `Info_SourceCode`
--

DROP TABLE IF EXISTS `Info_SourceCode`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Info_SourceCode` (
  `SourceCodeId` int NOT NULL AUTO_INCREMENT,
  `SourceCode` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`SourceCodeId`)
) ENGINE=InnoDB AUTO_INCREMENT=84708 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `Info_Users`
--

DROP TABLE IF EXISTS `Info_Users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Info_Users` (
  `User_Id` int NOT NULL AUTO_INCREMENT,
  `User` varchar(45) DEFAULT NULL,
  `Email` varchar(45) DEFAULT NULL,
  `Password` varchar(45) DEFAULT NULL,
  `User_level` int DEFAULT NULL,
  `Last_login` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`User_Id`)
) ENGINE=InnoDB AUTO_INCREMENT=66 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `temp_table_dio_please_delete`
--

DROP TABLE IF EXISTS `temp_table_dio_please_delete`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `temp_table_dio_please_delete` (
  `EmailAddress` varchar(100) DEFAULT NULL,
  `SourceCode` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping routines for database 'ivystorm_leads_db_2018'
--
/*!50003 DROP PROCEDURE IF EXISTS `Cmember_Content_Get_Convetion_By_SourceCode` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb3 */ ;
/*!50003 SET character_set_results = utf8mb3 */ ;
/*!50003 SET collation_connection  = utf8mb3_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`ivystorm_imember`@`%` PROCEDURE `Cmember_Content_Get_Convetion_By_SourceCode`(IN `SourceCode` VARCHAR(100))
BEGIN

SELECT DISTINCT Info_Leads.Email_Leads, Info_Leads.First_Name, Info_Leads.Last_Name, Info_Leads.Phone, Info_Leads.Time_to_Call,  Info_Leads.Country FROM Info_Leads

INNER JOIN Info_Leads_To_Project_Rel ON Info_Leads_To_Project_Rel.Lead_Id = Info_Leads.Lead_Id

INNER JOIN Info_SourceCode ON Info_SourceCode.SourceCodeId = Info_Leads_To_Project_Rel.SourceCodeId

WHERE Info_SourceCode.SourceCode =  SourceCode;



END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `Cmember_Get_Leads_Ipost_Info` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`ivystorm_imember`@`%` PROCEDURE `Cmember_Get_Leads_Ipost_Info`(IN `IpostList` VARCHAR(100), IN `StartDate` DATETIME, IN `EndDate` DATETIME )
BEGIN

SELECT 
ivystorm_leads_db_2018.Info_Leads.Email_Leads 'EmailAddress', 
GROUP_CONCAT(DISTINCT ivystorm_leads_db_2018.Info_Projects.Name SEPARATOR '(addbrk)') AS "Project_Name",
GROUP_CONCAT(DISTINCT ivystorm_cmember.Ipost_SourceCodes.SourceCode SEPARATOR '(addbrk)') AS "Ipost_SourceCode",
 DATE_FORMAT(ivystorm_cmember.Ipost_date_Joined.Date_Joined, "%Y-%m-%d")  AS "Ipost_Date_Joined",
DATE_FORMAT(ivystorm_leads_db_2018.Info_Leads_To_Project_Rel.Date_Joined, "%Y-%m-%d") AS "Lead_DateJoined"

FROM ivystorm_leads_db_2018.Info_Leads

INNER JOIN ivystorm_leads_db_2018.Info_Leads_To_Project_Rel 
ON ivystorm_leads_db_2018.Info_Leads_To_Project_Rel.Lead_Id =  ivystorm_leads_db_2018.Info_Leads.Lead_Id

INNER JOIN ivystorm_leads_db_2018.Info_Projects 
ON  ivystorm_leads_db_2018.Info_Projects.Project_Id = ivystorm_leads_db_2018.Info_Leads_To_Project_Rel.Project_Id

INNER JOIN ivystorm_cmember.Ipost_Contacts 
ON ivystorm_cmember.Ipost_Contacts.EmailAddress = ivystorm_leads_db_2018.Info_Leads.Email_Leads

INNER JOIN ivystorm_cmember.Ipost_SourceCodes 
ON ivystorm_cmember.Ipost_SourceCodes.Contact_ID = ivystorm_cmember.Ipost_Contacts.Contact_ID

INNER JOIN ivystorm_cmember.Ipost_date_Joined 
ON ivystorm_cmember.Ipost_date_Joined.Contact_ID = ivystorm_cmember.Ipost_Contacts.Contact_ID

INNER JOIN ivystorm_cmember.Ipost_Lists 
ON ivystorm_cmember.Ipost_Lists.Contact_ID =  ivystorm_cmember.Ipost_Contacts.Contact_ID

WHERE ivystorm_cmember.Ipost_Lists.List_Name = IpostList

AND ivystorm_leads_db_2018.Info_Leads_To_Project_Rel.Date_Joined  BETWEEN StartDate AND EndDate

GROUP BY ivystorm_leads_db_2018.Info_Leads.Email_Leads; 

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `Get_Leads_SourceCodes` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`ivystorm_imember`@`%` PROCEDURE `Get_Leads_SourceCodes`()
BEGIN
SELECT DISTINCT Info_SourceCode.SourceCode FROM Info_SourceCode;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `Get_Lead_DollarName_SourceCodes` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`ivystorm_imember`@`%` PROCEDURE `Get_Lead_DollarName_SourceCodes`(IN `SourceCode` VARCHAR(50), IN `FromDate` DATETIME, IN `ToDate` DATETIME)
BEGIN
SELECT DISTINCT 
Info_Leads.Email_Leads, 
Info_SourceCode.SourceCode, 
date_format(Info_Leads_To_Project_Rel.Date_Joined,'%Y-%m-%d')  AS "DateJoined"

FROM Info_Leads

INNER JOIN Info_Leads_To_Project_Rel ON Info_Leads_To_Project_Rel.Lead_Id = Info_Leads.Lead_Id

INNER JOIN Info_SourceCode ON Info_SourceCode.SourceCodeId = Info_Leads_To_Project_Rel.SourceCodeId

WHERE Info_SourceCode.SourceCode LIKE  CONCAT("%",SourceCode,"%")
AND  Info_Leads_To_Project_Rel.Date_Joined BETWEEN FromDate AND ToDate

AND Info_SourceCode.SourceCodeId != 0

GROUP BY  Info_Leads.Email_Leads, Info_Leads_To_Project_Rel.Date_Joined

ORDER BY Info_Leads_To_Project_Rel.Date_Joined ASC;

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
SET @@SESSION.SQL_LOG_BIN = @MYSQLDUMP_TEMP_LOG_BIN;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-03-26 17:10:04
