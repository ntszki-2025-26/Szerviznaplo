-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.4.3 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.8.0.6908
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for szakdoga
CREATE DATABASE IF NOT EXISTS `szakdoga` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `szakdoga`;

-- Dumping structure for table szakdoga.appointments
CREATE TABLE IF NOT EXISTS `appointments` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int DEFAULT NULL,
  `vehicle_id` int DEFAULT NULL,
  `appointment_date` date DEFAULT NULL,
  `status_appointments_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_appointments_users` (`user_id`),
  KEY `FK_appointments_status` (`status_appointments_id`),
  CONSTRAINT `FK_appointments_status` FOREIGN KEY (`status_appointments_id`) REFERENCES `status` (`id`),
  CONSTRAINT `FK_appointments_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Data exporting was unselected.

-- Dumping structure for table szakdoga.faults
CREATE TABLE IF NOT EXISTS `faults` (
  `id` int NOT NULL AUTO_INCREMENT,
  `vehicle_id` int DEFAULT NULL,
  `description` varchar(50) DEFAULT NULL,
  `category` varchar(50) DEFAULT NULL,
  `photo` varchar(50) DEFAULT NULL,
  `qr_code` varchar(50) DEFAULT NULL,
  `estimated_time` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_faults_vehicle` (`vehicle_id`),
  CONSTRAINT `FK_faults_vehicle` FOREIGN KEY (`vehicle_id`) REFERENCES `vehicle` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Data exporting was unselected.

-- Dumping structure for table szakdoga.repairs
CREATE TABLE IF NOT EXISTS `repairs` (
  `id` int NOT NULL AUTO_INCREMENT,
  `vehicle_id` int DEFAULT NULL,
  `status_repairs_id` int DEFAULT NULL,
  `photos_comments` json DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_repairs_vehicle` (`vehicle_id`),
  KEY `FK_repairs_status` (`status_repairs_id`),
  CONSTRAINT `FK_repairs_status` FOREIGN KEY (`status_repairs_id`) REFERENCES `status` (`id`),
  CONSTRAINT `FK_repairs_vehicle` FOREIGN KEY (`vehicle_id`) REFERENCES `vehicle` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Data exporting was unselected.

-- Dumping structure for table szakdoga.servicelog
CREATE TABLE IF NOT EXISTS `servicelog` (
  `id` int NOT NULL AUTO_INCREMENT,
  `vehicle_id` int DEFAULT NULL,
  `repair_id` int DEFAULT NULL,
  `date` date DEFAULT NULL,
  `performed_tasks` varchar(50) DEFAULT NULL,
  `replaced_parts` varchar(50) DEFAULT NULL,
  `cost` int DEFAULT NULL,
  `warranty` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_servicelog_vehicle` (`vehicle_id`),
  KEY `FK_servicelog_repairs` (`repair_id`),
  CONSTRAINT `FK_servicelog_repairs` FOREIGN KEY (`repair_id`) REFERENCES `repairs` (`id`),
  CONSTRAINT `FK_servicelog_vehicle` FOREIGN KEY (`vehicle_id`) REFERENCES `vehicle` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Data exporting was unselected.

-- Dumping structure for table szakdoga.status
CREATE TABLE IF NOT EXISTS `status` (
  `id` int NOT NULL AUTO_INCREMENT,
  `status` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Data exporting was unselected.

-- Dumping structure for table szakdoga.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `role` tinyint DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Data exporting was unselected.

-- Dumping structure for table szakdoga.vehicle
CREATE TABLE IF NOT EXISTS `vehicle` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int DEFAULT NULL,
  `brand` varchar(50) DEFAULT NULL,
  `model` varchar(50) DEFAULT NULL,
  `year` int DEFAULT NULL,
  `vin` varchar(50) DEFAULT NULL,
  `license_plate` varchar(50) DEFAULT NULL,
  `mileage` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_vehicle_users` (`user_id`),
  CONSTRAINT `FK_vehicle_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Data exporting was unselected.

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
