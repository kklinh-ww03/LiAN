-- MySQL dump 10.13  Distrib 8.0.40, for Win64 (x86_64)
--
-- Host: localhost    Database: footballyard_schema
-- ------------------------------------------------------
-- Server version	8.0.40

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
-- Table structure for table `bookings`
--

DROP TABLE IF EXISTS `bookings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `bookings` (
  `id` int NOT NULL AUTO_INCREMENT,
  `userID` varchar(45) NOT NULL,
  `yardID` varchar(45) NOT NULL,
  `check_in` date NOT NULL,
  `check_out` date NOT NULL,
  `date_booking` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` enum('xác nhận','hủy') DEFAULT 'xác nhận',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bookings`
--

LOCK TABLES `bookings` WRITE;
/*!40000 ALTER TABLE `bookings` DISABLE KEYS */;
INSERT INTO `bookings` VALUES (1,'1','1','2024-12-08','2024-12-08','2024-12-07 17:00:00','hủy'),(2,'3','1','2025-01-01','2025-01-02','2024-12-08 06:38:25','hủy'),(3,'3','2','2025-01-01','2025-02-01','2024-12-08 06:38:25','hủy'),(4,'3','2','2025-01-01','2025-01-02','2024-12-28 08:57:54','hủy'),(5,'3','2','2025-01-01','2025-01-02','2024-12-28 08:58:26','hủy'),(6,'4','2','2025-01-04','2025-01-05','2024-12-28 09:16:46','hủy'),(7,'4','1','2025-01-02','2025-01-05','2024-12-28 09:17:51','hủy'),(8,'4','2','2025-01-03','2025-01-05','2024-12-28 09:22:23','hủy'),(9,'4','1','2024-12-29','2024-12-30','2024-12-28 10:49:05','xác nhận'),(10,'5','2','2024-12-29','2024-12-31','2024-12-28 11:16:19','hủy');
/*!40000 ALTER TABLE `bookings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `fullname` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `role` enum('admin','customer') DEFAULT NULL,
  `created_time` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'linh123','123','khanhlinh','khanhlinh@gmail.com','0123456789','customer','2024-12-08 06:37:57'),(2,'nha456','$2y$10$fwmtyhKmMrlWrW751KKMAum8SDBsqMfoUSsEOJZ6Vav5RgDUK1/mi','thanhnha','thanhnha@gmail.com','0234567891','customer',NULL),(3,'linh1234','$2y$10$4iuVRlg44xWq8RaZDGP4AOw8Djm8Gr/2QUXdDWEzGzSSagEiqVLFy','khanh linh','nguyenkhanhlinh93nct@gmail.com','0314567892','customer',NULL),(4,'thanhnha03','$2y$10$/EigR5zNs/HkOOw7yaWmouOvcIN0r8pCEnz.D9cDyDFUCXM8tN1ye','hoàng thanh nhã','thanhnha20022003@gmail.com','0789457822','customer',NULL),(5,'quynh anh','$2y$10$qCdgiU0SPneO56c88816wepERHW5ie7KD/nSvHceTSjMjKEu0jlW2','Trần Thị Quỳnh Anh','21t1020107@husc.edu.vn','0787799015','customer',NULL),(6,'trang anh','1234','Trần Thị Trang Anh','21t1020109@husc.edu.vn','0787799020','customer',NULL);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `yards`
--

DROP TABLE IF EXISTS `yards`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `yards` (
  `id` int NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `description` varchar(45) DEFAULT NULL,
  `price_per_hour` float DEFAULT NULL,
  `status` enum('trống','bận') DEFAULT 'trống',
  `image` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `yards`
--

LOCK TABLES `yards` WRITE;
/*!40000 ALTER TABLE `yards` DISABLE KEYS */;
INSERT INTO `yards` VALUES (1,'Sân 1','Khu vực A',40000,'bận','anh4.jpg'),(2,'Sân 2','Khu vực A',60000,'trống','anh3.jpg'),(3,'Sân 3','Khu vực B',35000,'bận','anh6.jpg'),(5,'Sân 5','Khu vực B',65000,'trống','anh8.jpg'),(6,'Sân 6','Khu vực C',45000,'trống','anh9.jpg');
/*!40000 ALTER TABLE `yards` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-12-28 19:49:59
