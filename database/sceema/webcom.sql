-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.28 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for webcom
CREATE DATABASE IF NOT EXISTS `webcom` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `webcom`;

-- Dumping structure for table webcom.company
CREATE TABLE IF NOT EXISTS `company` (
  `company_id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tel` bigint DEFAULT NULL,
  `mobile` bigint NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `company_avatar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `web` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fb_page` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `industry_fk_id` bigint unsigned NOT NULL,
  `country_fk_id` bigint unsigned NOT NULL,
  `registor_date` timestamp NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`company_id`),
  KEY `company_industry_fk_id_foreign` (`industry_fk_id`),
  KEY `company_country_fk_id_foreign` (`country_fk_id`),
  CONSTRAINT `company_country_fk_id_foreign` FOREIGN KEY (`country_fk_id`) REFERENCES `country` (`country_id`) ON DELETE CASCADE,
  CONSTRAINT `company_industry_fk_id_foreign` FOREIGN KEY (`industry_fk_id`) REFERENCES `industry` (`industry_id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table webcom.company: ~1 rows (approximately)
INSERT INTO `company` (`company_id`, `name`, `address`, `tel`, `mobile`, `email`, `company_avatar`, `web`, `fb_page`, `industry_fk_id`, `country_fk_id`, `registor_date`, `created_at`, `updated_at`) VALUES
	(1, 'Epic', 'Colombo', NULL, 770836712, 'epic@info.com', '/company/avatar/1242.jpeg', 'epic.com', 'www.facebook.com/epiclanka', 1, 1, '2022-12-01 05:21:54', '2022-12-01 05:21:55', '2022-12-01 05:21:58');

-- Dumping structure for table webcom.country
CREATE TABLE IF NOT EXISTS `country` (
  `country_id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `country` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country_code` int NOT NULL,
  `registor_date` timestamp NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`country_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table webcom.country: ~1 rows (approximately)
INSERT INTO `country` (`country_id`, `country`, `country_code`, `registor_date`, `created_at`, `updated_at`) VALUES
	(1, 'Sri Lanka', 94, '2022-12-01 05:20:50', '2022-12-01 05:20:51', '2022-12-01 05:20:51');

-- Dumping structure for table webcom.failed_jobs
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table webcom.failed_jobs: ~0 rows (approximately)

-- Dumping structure for table webcom.industry
CREATE TABLE IF NOT EXISTS `industry` (
  `industry_id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `industry_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `registor_date` timestamp NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`industry_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table webcom.industry: ~1 rows (approximately)
INSERT INTO `industry` (`industry_id`, `industry_name`, `registor_date`, `created_at`, `updated_at`) VALUES
	(1, 'Infomation Technology', '2022-12-01 05:18:49', '2022-12-01 05:18:50', '2022-12-01 05:18:51');

-- Dumping structure for table webcom.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table webcom.migrations: ~0 rows (approximately)
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '2019_08_19_000000_create_failed_jobs_table', 1),
	(2, '2014_10_12_100000_create_password_resets_table', 2),
	(3, '2019_12_14_000001_create_personal_access_tokens_table', 3),
	(4, '2022_11_30_113823_create_role_table', 4),
	(5, '2022_11_30_111246_create_industry_table', 5),
	(11, '2022_12_01_031034_create_country_table', 11),
	(12, '2022_11_30_111217_create_company_table', 12),
	(13, '2022_11_30_112133_create_social_table', 13),
	(15, '2014_10_12_000000_create_users_table', 15),
	(17, '2022_12_01_030042_create_person_in_charge_table', 16);

-- Dumping structure for table webcom.password_resets
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table webcom.password_resets: ~0 rows (approximately)

-- Dumping structure for table webcom.personal_access_tokens
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
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

-- Dumping data for table webcom.personal_access_tokens: ~0 rows (approximately)

-- Dumping structure for table webcom.person_in_charge
CREATE TABLE IF NOT EXISTS `person_in_charge` (
  `pic_id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `pic_uuid` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile` bigint NOT NULL,
  `authorize_by` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `designation` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `company_fk_id` bigint unsigned NOT NULL,
  `registor_date` timestamp NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`pic_id`),
  KEY `person_in_charge_company_fk_id_foreign` (`company_fk_id`),
  CONSTRAINT `person_in_charge_company_fk_id_foreign` FOREIGN KEY (`company_fk_id`) REFERENCES `company` (`company_id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table webcom.person_in_charge: ~1 rows (approximately)
INSERT INTO `person_in_charge` (`pic_id`, `pic_uuid`, `email`, `password`, `mobile`, `authorize_by`, `designation`, `type`, `status`, `company_fk_id`, `registor_date`, `created_at`, `updated_at`) VALUES
	(1, '704e578d-ca4b-479a-b5f9-208dd8cb5e00', 'tharakacgamage@gmail.com', '$2y$10$goEIxYDvJJ9QDw75rf7LVe4zsEQJeY5ekfWfEfsiqPCafpUEP/gaG', 770836712, '', '', 'pic_user', 1, 1, '2022-11-30 23:56:58', '2022-11-30 23:56:58', '2022-11-30 23:56:58');

-- Dumping structure for table webcom.role
CREATE TABLE IF NOT EXISTS `role` (
  `role_id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `registor_date` timestamp NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`role_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table webcom.role: ~0 rows (approximately)

-- Dumping structure for table webcom.social
CREATE TABLE IF NOT EXISTS `social` (
  `social_id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `social_media_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `link` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `registor_date` timestamp NOT NULL,
  `company_fk_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`social_id`),
  KEY `social_company_fk_id_foreign` (`company_fk_id`),
  CONSTRAINT `social_company_fk_id_foreign` FOREIGN KEY (`company_fk_id`) REFERENCES `company` (`company_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table webcom.social: ~0 rows (approximately)

-- Dumping structure for table webcom.users
CREATE TABLE IF NOT EXISTS `users` (
  `user_id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_uuid` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `authorize_by` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `designation` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile` bigint DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_avatar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `facebook_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `google_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `registor_date` timestamp NULL DEFAULT NULL,
  `role_fk_id` bigint unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `users_role_fk_id_foreign` (`role_fk_id`),
  CONSTRAINT `users_role_fk_id_foreign` FOREIGN KEY (`role_fk_id`) REFERENCES `role` (`role_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table webcom.users: ~0 rows (approximately)

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
