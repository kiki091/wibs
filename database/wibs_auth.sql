-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.1.16-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win32
-- HeidiSQL Version:             9.4.0.5143
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Dumping database structure for wibs_auth
CREATE DATABASE IF NOT EXISTS `wibs_auth` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `wibs_auth`;

-- Dumping structure for table wibs_auth.location
CREATE TABLE IF NOT EXISTS `location` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `slug` varchar(45) DEFAULT NULL,
  `is_active` int(1) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug_UNIQUE` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- Dumping data for table wibs_auth.location: ~2 rows (approximately)
DELETE FROM `location`;
/*!40000 ALTER TABLE `location` DISABLE KEYS */;
INSERT INTO `location` (`id`, `name`, `slug`, `is_active`, `created_at`, `updated_at`) VALUES
	(1, 'SENIOR HIGH SCHOOL', 'sma', 1, NULL, NULL),
	(2, 'JUNIOR HIGH SCHOOL', 'smp', 1, NULL, NULL);
/*!40000 ALTER TABLE `location` ENABLE KEYS */;

-- Dumping structure for table wibs_auth.menu
CREATE TABLE IF NOT EXISTS `menu` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `title` varchar(45) DEFAULT NULL,
  `slug` varchar(55) DEFAULT NULL,
  `url` varchar(55) DEFAULT NULL,
  `menu_group_id` int(5) DEFAULT NULL,
  `have_sub_menu` tinyint(1) DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT NULL,
  `order` int(3) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug_UNIQUE` (`slug`),
  UNIQUE KEY `url_UNIQUE` (`url`),
  KEY `fk_menu_1_idx` (`menu_group_id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;

-- Dumping data for table wibs_auth.menu: ~4 rows (approximately)
DELETE FROM `menu`;
/*!40000 ALTER TABLE `menu` DISABLE KEYS */;
INSERT INTO `menu` (`id`, `title`, `slug`, `url`, `menu_group_id`, `have_sub_menu`, `is_active`, `order`, `created_at`, `updated_at`) VALUES
	(1, 'Santri', 'santri', 'santri()', 1, 0, 1, 1, NULL, NULL),
	(21, 'Wali Santri', 'wali-santri', 'wali_santri()', 1, 0, 1, 2, NULL, NULL),
	(22, 'Report Santri', 'report-santri', 'report_santri()', 1, 1, 1, 3, NULL, NULL),
	(23, 'User Account', 'user-account', 'user_account()', 2, 0, 1, 4, NULL, NULL);
/*!40000 ALTER TABLE `menu` ENABLE KEYS */;

-- Dumping structure for table wibs_auth.menu_group
CREATE TABLE IF NOT EXISTS `menu_group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(45) NOT NULL,
  `icon` varchar(45) DEFAULT NULL,
  `order` int(2) DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT NULL,
  `system_id` int(5) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `title_UNIQUE` (`title`),
  KEY `fk_menu_group_1_idx` (`system_id`),
  CONSTRAINT `fk_menu_group_1` FOREIGN KEY (`system_id`) REFERENCES `system` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- Dumping data for table wibs_auth.menu_group: ~2 rows (approximately)
DELETE FROM `menu_group`;
/*!40000 ALTER TABLE `menu_group` DISABLE KEYS */;
INSERT INTO `menu_group` (`id`, `title`, `icon`, `order`, `is_active`, `system_id`, `created_at`, `updated_at`) VALUES
	(1, 'MSC', 'fa-book', 1, 1, 1, NULL, NULL),
	(2, 'AMS', 'fa-user', 2, 1, 2, NULL, NULL);
/*!40000 ALTER TABLE `menu_group` ENABLE KEYS */;

-- Dumping structure for table wibs_auth.privilage
CREATE TABLE IF NOT EXISTS `privilage` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(80) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(80) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(80) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name_UNIQUE` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- Dumping data for table wibs_auth.privilage: ~2 rows (approximately)
DELETE FROM `privilage`;
/*!40000 ALTER TABLE `privilage` DISABLE KEYS */;
INSERT INTO `privilage` (`id`, `name`, `display_name`, `description`, `created_at`, `updated_at`) VALUES
	(1, 'User Privilage', 'User Privilage', 'User Privilage', NULL, NULL),
	(2, 'Admin Privilage', 'Admin Privilage', 'Admin Privilage', NULL, NULL);
/*!40000 ALTER TABLE `privilage` ENABLE KEYS */;

-- Dumping structure for table wibs_auth.role
CREATE TABLE IF NOT EXISTS `role` (
  `user_id` int(10) NOT NULL,
  `privilage_id` int(10) NOT NULL,
  PRIMARY KEY (`user_id`,`privilage_id`),
  KEY `fk_role_2_idx` (`privilage_id`),
  CONSTRAINT `fk_role_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_role_2` FOREIGN KEY (`privilage_id`) REFERENCES `privilage` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table wibs_auth.role: ~1 rows (approximately)
DELETE FROM `role`;
/*!40000 ALTER TABLE `role` DISABLE KEYS */;
INSERT INTO `role` (`user_id`, `privilage_id`) VALUES
	(1, 2),
	(2, 2);
/*!40000 ALTER TABLE `role` ENABLE KEYS */;

-- Dumping structure for table wibs_auth.sub_menu
CREATE TABLE IF NOT EXISTS `sub_menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(60) NOT NULL,
  `slug` varchar(100) NOT NULL,
  `url` varchar(100) NOT NULL,
  `menu_id` int(3) NOT NULL,
  `is_active` tinyint(1) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `title_UNIQUE` (`title`),
  UNIQUE KEY `slug_UNIQUE` (`slug`),
  UNIQUE KEY `url_UNIQUE` (`url`),
  KEY `fk_sub_menu_1_idx` (`menu_id`),
  CONSTRAINT `fk_sub_menu_1` FOREIGN KEY (`menu_id`) REFERENCES `menu` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

-- Dumping data for table wibs_auth.sub_menu: ~3 rows (approximately)
DELETE FROM `sub_menu`;
/*!40000 ALTER TABLE `sub_menu` DISABLE KEYS */;
INSERT INTO `sub_menu` (`id`, `title`, `slug`, `url`, `menu_id`, `is_active`, `created_at`, `updated_at`) VALUES
	(9, 'Report Tahfidz', 'report-tahfidz', 'report_tahfidz()', 22, 1, NULL, NULL),
	(10, 'Report Hadis', 'report-hadis', 'report_hadis()', 22, 1, NULL, NULL),
	(11, 'Report Kesehatan', 'report-kesehatan', 'report_kesehatan()', 22, 1, NULL, NULL);
/*!40000 ALTER TABLE `sub_menu` ENABLE KEYS */;

-- Dumping structure for table wibs_auth.system
CREATE TABLE IF NOT EXISTS `system` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `slug` varchar(90) NOT NULL,
  `order` tinyint(2) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name_UNIQUE` (`name`),
  UNIQUE KEY `slug_UNIQUE` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- Dumping data for table wibs_auth.system: ~2 rows (approximately)
DELETE FROM `system`;
/*!40000 ALTER TABLE `system` DISABLE KEYS */;
INSERT INTO `system` (`id`, `name`, `slug`, `order`, `created_at`, `updated_at`) VALUES
	(1, 'CONTENT MANAGEMENT SYSTEM', 'cms', 1, NULL, NULL),
	(2, 'ACCOUNT MANAGEMENT SYSTEM', 'ams', 2, NULL, NULL);
/*!40000 ALTER TABLE `system` ENABLE KEYS */;

-- Dumping structure for table wibs_auth.system_location
CREATE TABLE IF NOT EXISTS `system_location` (
  `user_id` int(3) NOT NULL,
  `system_id` int(3) NOT NULL,
  PRIMARY KEY (`user_id`,`system_id`),
  KEY `fk_system_location_1_idx` (`user_id`),
  KEY `fk_system_location_2_idx` (`system_id`),
  CONSTRAINT `FK_system_location_system` FOREIGN KEY (`system_id`) REFERENCES `system` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_system_location_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table wibs_auth.system_location: ~4 rows (approximately)
DELETE FROM `system_location`;
/*!40000 ALTER TABLE `system_location` DISABLE KEYS */;
INSERT INTO `system_location` (`user_id`, `system_id`) VALUES
	(1, 1),
	(1, 2),
	(2, 1),
	(2, 2);
/*!40000 ALTER TABLE `system_location` ENABLE KEYS */;

-- Dumping structure for table wibs_auth.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(80) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(80) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(80) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email_UNIQUE` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- Dumping data for table wibs_auth.users: ~2 rows (approximately)
DELETE FROM `users`;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `name`, `email`, `password`, `remember_token`, `is_active`, `created_at`, `updated_at`) VALUES
	(1, 'admin', 'sheqbo@gmail.com', '$2y$10$jWqW0ETc23XTaaDtjktAw.XRvdet5BnBHauvmJLPBCWNfbyvI3YNy', 'uuqgaQ4r5wMWOsPKg0VM3ujcdRunxBzbJC6mD2yS9MQguMk6vGZNNZtjyTI7', 1, '2017-05-04 16:58:53', '2017-09-20 05:42:07'),
	(2, 'Admin', 'admin@wibs.sch.id', '$2y$10$ZLEGjGku4gge.8CpyS8VbuiQ/JttzW5XKsc8Mtxnj32VBqNF3CwqO', 'nlio0CPANZr0b6TUaHHt87WihDATOayR3FHwFD4XF5XIZY0ha4B2B53c4DaM', 1, '2017-09-20 05:13:40', '2017-09-20 05:13:40');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

-- Dumping structure for table wibs_auth.user_location
CREATE TABLE IF NOT EXISTS `user_location` (
  `user_id` int(3) NOT NULL,
  `location_id` int(3) NOT NULL,
  PRIMARY KEY (`user_id`,`location_id`),
  KEY `fk_user_location_2_idx` (`location_id`),
  CONSTRAINT `fk_user_location_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_user_location_2` FOREIGN KEY (`location_id`) REFERENCES `location` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table wibs_auth.user_location: ~2 rows (approximately)
DELETE FROM `user_location`;
/*!40000 ALTER TABLE `user_location` DISABLE KEYS */;
INSERT INTO `user_location` (`user_id`, `location_id`) VALUES
	(1, 1),
	(1, 2);
/*!40000 ALTER TABLE `user_location` ENABLE KEYS */;

-- Dumping structure for table wibs_auth.user_menu
CREATE TABLE IF NOT EXISTS `user_menu` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) NOT NULL,
  `menu_id` int(10) NOT NULL,
  PRIMARY KEY (`id`,`user_id`,`menu_id`),
  KEY `fk_user_menu_1_idx` (`user_id`),
  KEY `fk_user_menu_2_idx` (`menu_id`),
  CONSTRAINT `fk_user_menu_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_user_menu_2` FOREIGN KEY (`menu_id`) REFERENCES `menu` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=64 DEFAULT CHARSET=utf8;

-- Dumping data for table wibs_auth.user_menu: ~8 rows (approximately)
DELETE FROM `user_menu`;
/*!40000 ALTER TABLE `user_menu` DISABLE KEYS */;
INSERT INTO `user_menu` (`id`, `user_id`, `menu_id`) VALUES
	(1, 1, 1),
	(57, 1, 21),
	(58, 1, 22),
	(59, 1, 23),
	(60, 2, 22),
	(61, 2, 1),
	(62, 2, 21),
	(63, 2, 23);
/*!40000 ALTER TABLE `user_menu` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
