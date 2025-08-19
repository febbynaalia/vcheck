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


-- Dumping database structure for vcheck
CREATE DATABASE IF NOT EXISTS `vcheck` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;
USE `vcheck`;

-- Dumping structure for table vcheck.kehadiran
CREATE TABLE IF NOT EXISTS `kehadiran` (
  `id` int NOT NULL AUTO_INCREMENT,
  `uid` int NOT NULL DEFAULT (0),
  `kode` varchar(50) NOT NULL DEFAULT '0',
  `waktu` datetime NOT NULL DEFAULT (0),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table vcheck.kehadiran: ~0 rows (approximately)

-- Dumping structure for table vcheck.skpm_activities
CREATE TABLE IF NOT EXISTS `skpm_activities` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `nama_kegiatan` varchar(255) NOT NULL,
  `jenis_kegiatan` varchar(100) DEFAULT NULL,
  `status` enum('Diajukan','Diproses','Disetujui','Ditolak') NOT NULL DEFAULT 'Diajukan',
  `poin` int DEFAULT '0',
  `tanggal_pengajuan` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `skpm_activities_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table vcheck.skpm_activities: ~0 rows (approximately)
INSERT IGNORE INTO `skpm_activities` (`id`, `user_id`, `nama_kegiatan`, `jenis_kegiatan`, `status`, `poin`, `tanggal_pengajuan`) VALUES
	(1, 1, 'Panitia Dies Natalis FIK', NULL, 'Disetujui', 70, '2025-06-18 11:42:12'),
	(2, 1, 'Peserta Lomba Desain Grafis Nasional', NULL, 'Disetujui', 50, '2025-06-18 11:42:12'),
	(3, 1, 'Pengajuan Lomba Catur', NULL, 'Diajukan', 0, '2025-06-18 11:42:12');

-- Dumping structure for table vcheck.study_partners
CREATE TABLE IF NOT EXISTS `study_partners` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_one_id` int NOT NULL,
  `user_two_id` int NOT NULL,
  `status` enum('pending','accepted','declined','blocked') NOT NULL DEFAULT 'pending',
  `action_user_id` int NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_partner_pair` (`user_one_id`,`user_two_id`),
  KEY `user_two_id` (`user_two_id`),
  CONSTRAINT `study_partners_ibfk_1` FOREIGN KEY (`user_one_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `study_partners_ibfk_2` FOREIGN KEY (`user_two_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table vcheck.study_partners: ~2 rows (approximately)
INSERT IGNORE INTO `study_partners` (`id`, `user_one_id`, `user_two_id`, `status`, `action_user_id`, `created_at`) VALUES
	(1, 1, 2, 'declined', 1, '2025-06-18 11:50:11'),
	(2, 1, 3, 'declined', 1, '2025-06-18 11:50:11'),
	(3, 1, 4, 'accepted', 4, '2025-06-18 15:34:02'),
	(4, 2, 4, 'pending', 2, '2025-06-18 15:46:23');

-- Dumping structure for table vcheck.uploads
CREATE TABLE IF NOT EXISTS `uploads` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `keterangan` text,
  `filename` varchar(255) DEFAULT NULL,
  `upload_at` timestamp NULL DEFAULT (now()),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table vcheck.uploads: ~0 rows (approximately)

-- Dumping structure for table vcheck.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT '0',
  `npm` varchar(50) NOT NULL DEFAULT '0',
  `fakultas` varchar(50) NOT NULL DEFAULT '0',
  `email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT '0',
  `password` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT '0',
  `ipk` decimal(3,2) DEFAULT '0.00',
  `level` int DEFAULT '1',
  `profile_pic` varchar(255) NOT NULL DEFAULT 'default.png',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table vcheck.users: ~1 rows (approximately)
INSERT IGNORE INTO `users` (`id`, `nama`, `npm`, `fakultas`, `email`, `password`, `ipk`, `level`, `profile_pic`) VALUES
	(1, 'Zada', '23081010209', 'FIK', '209@upn.com', '123', 4.00, 5, 'nahihi.jpg'),
	(2, 'Nana', '23081010215', 'FIK', '215@upn.com', '123', 3.00, 4, 'nahihi.jpg'),
	(3, 'Alhaitham', '2308100001', 'FIK', 'haitham@upn.com', '123', 4.00, 5, 'default.png'),
	(4, 'Kaveh', '2308100002', 'FAD', 'kaveh@upn.com', '123', 4.00, 5, 'nahihi.jpg');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
