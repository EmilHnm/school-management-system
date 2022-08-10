-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.4.24-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             12.0.0.6468
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for school
DROP DATABASE IF EXISTS `school`;
CREATE DATABASE IF NOT EXISTS `school` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;
USE `school`;

-- Dumping structure for table school.account_employee_salaries
DROP TABLE IF EXISTS `account_employee_salaries`;
CREATE TABLE IF NOT EXISTS `account_employee_salaries` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `employee_id` int(11) NOT NULL COMMENT 'user_id',
  `date` varchar(256) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amount` double DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table school.account_employee_salaries: ~2 rows (approximately)
DELETE FROM `account_employee_salaries`;
INSERT INTO `account_employee_salaries` (`id`, `employee_id`, `date`, `amount`, `created_at`, `updated_at`) VALUES
	(1, 8, '2022-08', 8500, '2022-08-06 07:52:46', '2022-08-06 07:52:46'),
	(2, 10, '2022-08', 9000, '2022-08-06 07:52:46', '2022-08-06 07:52:46');

-- Dumping structure for table school.account_other_costs
DROP TABLE IF EXISTS `account_other_costs`;
CREATE TABLE IF NOT EXISTS `account_other_costs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `date` date DEFAULT NULL,
  `amount` double DEFAULT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `receipt_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table school.account_other_costs: ~1 rows (approximately)
DELETE FROM `account_other_costs`;
INSERT INTO `account_other_costs` (`id`, `date`, `amount`, `description`, `receipt_image`, `created_at`, `updated_at`) VALUES
	(1, '2022-08-04', 600000, '12312345', '202208061822euph_st02_05.png', '2022-08-06 10:58:22', '2022-08-06 11:22:20');

-- Dumping structure for table school.account_student_fees
DROP TABLE IF EXISTS `account_student_fees`;
CREATE TABLE IF NOT EXISTS `account_student_fees` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `year_id` int(11) DEFAULT NULL,
  `class_id` int(11) DEFAULT NULL,
  `student_id` int(11) DEFAULT NULL COMMENT 'user_id',
  `fee_category_id` int(11) DEFAULT NULL,
  `date` varchar(256) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amount` double DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table school.account_student_fees: ~3 rows (approximately)
DELETE FROM `account_student_fees`;
INSERT INTO `account_student_fees` (`id`, `year_id`, `class_id`, `student_id`, `fee_category_id`, `date`, `amount`, `created_at`, `updated_at`) VALUES
	(3, 2, 2, 5, 1, '2022-08', 111, '2022-08-05 10:41:56', '2022-08-05 10:41:56'),
	(4, 2, 2, 5, 2, '2022-08', 4600, '2022-08-05 10:42:14', '2022-08-05 10:42:14'),
	(5, 2, 2, 5, 3, '2022-08', 92, '2022-08-05 10:42:42', '2022-08-05 10:42:42');

-- Dumping structure for table school.assign_students
DROP TABLE IF EXISTS `assign_students`;
CREATE TABLE IF NOT EXISTS `assign_students` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `student_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `year_id` int(11) NOT NULL,
  `group_id` int(11) DEFAULT NULL,
  `roll` int(11) DEFAULT NULL,
  `shift_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table school.assign_students: ~3 rows (approximately)
DELETE FROM `assign_students`;
INSERT INTO `assign_students` (`id`, `student_id`, `class_id`, `year_id`, `group_id`, `roll`, `shift_id`, `created_at`, `updated_at`) VALUES
	(1, 4, 1, 3, 2, NULL, 3, '2022-07-09 00:24:54', '2022-07-09 00:24:54'),
	(2, 5, 2, 2, 2, NULL, 3, '2022-07-09 10:50:27', '2022-07-13 06:45:14'),
	(3, 5, 3, 1, 2, 1, 3, '2022-07-13 10:01:16', '2022-07-17 08:03:58'),
	(4, 6, 3, 3, 1, NULL, 3, '2022-07-21 09:41:56', '2022-07-21 09:50:23');

-- Dumping structure for table school.assign_subjects
DROP TABLE IF EXISTS `assign_subjects`;
CREATE TABLE IF NOT EXISTS `assign_subjects` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `class_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `full_mark` double NOT NULL,
  `pass_mark` double NOT NULL,
  `subjective_mark` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table school.assign_subjects: ~12 rows (approximately)
DELETE FROM `assign_subjects`;
INSERT INTO `assign_subjects` (`id`, `class_id`, `subject_id`, `full_mark`, `pass_mark`, `subjective_mark`, `created_at`, `updated_at`) VALUES
	(1, 1, 1, 10, 4, 10, '2022-08-02 10:00:57', '2022-08-02 10:00:57'),
	(2, 1, 5, 10, 4, 10, '2022-08-02 10:00:57', '2022-08-02 10:00:57'),
	(3, 1, 4, 10, 4, 10, '2022-08-02 10:00:57', '2022-08-02 10:00:57'),
	(4, 2, 2, 10, 4, 10, '2022-08-02 10:01:44', '2022-08-02 10:01:44'),
	(5, 2, 3, 10, 4, 10, '2022-08-02 10:01:44', '2022-08-02 10:01:44'),
	(6, 2, 1, 10, 4, 10, '2022-08-02 10:01:44', '2022-08-02 10:01:44'),
	(7, 3, 1, 10, 4, 10, '2022-08-02 10:02:21', '2022-08-02 10:02:21'),
	(8, 3, 5, 10, 4, 10, '2022-08-02 10:02:21', '2022-08-02 10:02:21'),
	(9, 3, 4, 10, 4, 10, '2022-08-02 10:02:21', '2022-08-02 10:02:21'),
	(10, 4, 2, 10, 4, 10, '2022-08-02 10:03:15', '2022-08-02 10:03:15'),
	(11, 4, 1, 10, 4, 10, '2022-08-02 10:03:15', '2022-08-02 10:03:15'),
	(12, 4, 3, 10, 4, 10, '2022-08-02 10:03:15', '2022-08-02 10:03:15');

-- Dumping structure for table school.designations
DROP TABLE IF EXISTS `designations`;
CREATE TABLE IF NOT EXISTS `designations` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `designations_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table school.designations: ~2 rows (approximately)
DELETE FROM `designations`;
INSERT INTO `designations` (`id`, `name`, `created_at`, `updated_at`) VALUES
	(1, 'assistant teacher', '2022-07-23 23:19:02', '2022-07-23 23:19:02'),
	(2, 'head teacher', '2022-07-23 23:19:11', '2022-07-23 23:19:11'),
	(3, 'teacher', '2022-07-23 23:34:27', '2022-07-23 23:34:27');

-- Dumping structure for table school.discount_students
DROP TABLE IF EXISTS `discount_students`;
CREATE TABLE IF NOT EXISTS `discount_students` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `assign_student_id` int(11) NOT NULL,
  `fee_category_id` int(11) DEFAULT NULL,
  `discount` double DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table school.discount_students: ~3 rows (approximately)
DELETE FROM `discount_students`;
INSERT INTO `discount_students` (`id`, `assign_student_id`, `fee_category_id`, `discount`, `created_at`, `updated_at`) VALUES
	(1, 1, 1, 5, '2022-07-09 00:24:54', '2022-07-09 00:24:54'),
	(2, 2, 1, 8, '2022-07-09 10:50:27', '2022-07-13 06:45:14'),
	(3, 3, 1, 8, '2022-07-13 10:01:16', '2022-07-13 10:01:16'),
	(4, 4, 1, 5, '2022-07-21 09:41:56', '2022-07-21 09:41:56');

-- Dumping structure for table school.employee_attendances
DROP TABLE IF EXISTS `employee_attendances`;
CREATE TABLE IF NOT EXISTS `employee_attendances` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `employee_id` int(11) NOT NULL COMMENT 'user_id',
  `date` date NOT NULL,
  `attend_status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table school.employee_attendances: ~4 rows (approximately)
DELETE FROM `employee_attendances`;
INSERT INTO `employee_attendances` (`id`, `employee_id`, `date`, `attend_status`, `created_at`, `updated_at`) VALUES
	(7, 8, '2022-08-01', 'Present', '2022-07-31 10:40:06', '2022-07-31 10:40:06'),
	(8, 10, '2022-08-01', 'Present', '2022-07-31 10:40:06', '2022-07-31 10:40:06'),
	(11, 8, '2022-07-20', 'Leave', '2022-07-31 10:58:58', '2022-07-31 10:58:58'),
	(12, 10, '2022-07-20', 'Absent', '2022-07-31 10:58:58', '2022-07-31 10:58:58');

-- Dumping structure for table school.employee_leaves
DROP TABLE IF EXISTS `employee_leaves`;
CREATE TABLE IF NOT EXISTS `employee_leaves` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `employee_id` int(11) NOT NULL COMMENT 'user_id',
  `leave_purposes_id` int(11) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table school.employee_leaves: ~1 rows (approximately)
DELETE FROM `employee_leaves`;
INSERT INTO `employee_leaves` (`id`, `employee_id`, `leave_purposes_id`, `start_date`, `end_date`, `created_at`, `updated_at`) VALUES
	(2, 10, 4, '2022-07-28', '2022-07-29', '2022-07-30 21:54:27', '2022-07-31 03:18:50');

-- Dumping structure for table school.employee_salary_logs
DROP TABLE IF EXISTS `employee_salary_logs`;
CREATE TABLE IF NOT EXISTS `employee_salary_logs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `employee_id` int(11) NOT NULL,
  `previous_salary` int(11) DEFAULT NULL,
  `current_salary` int(11) DEFAULT NULL,
  `increment_salary` int(11) DEFAULT NULL,
  `effected_salary` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table school.employee_salary_logs: ~4 rows (approximately)
DELETE FROM `employee_salary_logs`;
INSERT INTO `employee_salary_logs` (`id`, `employee_id`, `previous_salary`, `current_salary`, `increment_salary`, `effected_salary`, `created_at`, `updated_at`) VALUES
	(1, 8, 6000, 6000, 0, '2016-02-11', '2022-07-25 10:17:06', '2022-07-25 10:17:06'),
	(2, 8, 7500, 8000, 500, '2022-07-27', '2022-07-27 06:12:35', '2022-07-27 06:12:35'),
	(3, 8, 8000, 8500, 500, '2022-07-27', '2022-07-27 06:17:15', '2022-07-27 06:17:15'),
	(4, 10, 9000, 9000, 0, '2012-09-06', '2022-07-29 10:03:12', '2022-07-29 10:03:12');

-- Dumping structure for table school.exam_types
DROP TABLE IF EXISTS `exam_types`;
CREATE TABLE IF NOT EXISTS `exam_types` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `exam_types_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table school.exam_types: ~2 rows (approximately)
DELETE FROM `exam_types`;
INSERT INTO `exam_types` (`id`, `name`, `created_at`, `updated_at`) VALUES
	(1, 'End Course', '2022-07-23 07:36:25', '2022-07-23 07:36:25'),
	(2, 'Middle Course', '2022-07-23 07:36:33', '2022-07-23 07:36:33'),
	(3, 'Objective test', '2022-07-23 07:36:54', '2022-07-23 07:36:54');

-- Dumping structure for table school.failed_jobs
DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table school.failed_jobs: ~0 rows (approximately)
DELETE FROM `failed_jobs`;

-- Dumping structure for table school.fee_categories
DROP TABLE IF EXISTS `fee_categories`;
CREATE TABLE IF NOT EXISTS `fee_categories` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `fee_categories_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table school.fee_categories: ~2 rows (approximately)
DELETE FROM `fee_categories`;
INSERT INTO `fee_categories` (`id`, `name`, `created_at`, `updated_at`) VALUES
	(1, 'Registration', '2022-07-05 22:15:26', '2022-07-21 09:38:36'),
	(2, 'Monthly', '2022-07-05 22:15:33', '2022-07-21 09:28:07'),
	(3, 'Exam Type', '2022-07-23 10:26:11', '2022-07-23 10:26:11');

-- Dumping structure for table school.fee_category_amounts
DROP TABLE IF EXISTS `fee_category_amounts`;
CREATE TABLE IF NOT EXISTS `fee_category_amounts` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `fee_category_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `amount` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table school.fee_category_amounts: ~12 rows (approximately)
DELETE FROM `fee_category_amounts`;
INSERT INTO `fee_category_amounts` (`id`, `fee_category_id`, `class_id`, `amount`, `created_at`, `updated_at`) VALUES
	(7, 3, 1, 100, '2022-07-23 10:29:29', '2022-07-23 10:29:29'),
	(8, 3, 2, 100, '2022-07-23 10:29:29', '2022-07-23 10:29:29'),
	(9, 3, 3, 50, '2022-07-23 10:29:29', '2022-07-23 10:29:29'),
	(10, 3, 4, 50, '2022-07-23 10:29:29', '2022-07-23 10:29:29'),
	(11, 1, 1, 440, '2022-08-05 07:38:35', '2022-08-05 07:38:35'),
	(12, 1, 2, 120, '2022-08-05 07:38:35', '2022-08-05 07:38:35'),
	(13, 1, 3, 440, '2022-08-05 07:38:35', '2022-08-05 07:38:35'),
	(14, 1, 4, 120, '2022-08-05 07:38:35', '2022-08-05 07:38:35'),
	(15, 2, 3, 4400, '2022-08-05 07:38:52', '2022-08-05 07:38:52'),
	(16, 2, 4, 5000, '2022-08-05 07:38:52', '2022-08-05 07:38:52'),
	(17, 2, 1, 4400, '2022-08-05 07:38:52', '2022-08-05 07:38:52'),
	(18, 2, 2, 5000, '2022-08-05 07:38:52', '2022-08-05 07:38:52');

-- Dumping structure for table school.leave_purposes
DROP TABLE IF EXISTS `leave_purposes`;
CREATE TABLE IF NOT EXISTS `leave_purposes` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `leave_purposes_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table school.leave_purposes: ~4 rows (approximately)
DELETE FROM `leave_purposes`;
INSERT INTO `leave_purposes` (`id`, `name`, `created_at`, `updated_at`) VALUES
	(1, 'Personal Problem', NULL, NULL),
	(2, 'Family Problem', NULL, NULL),
	(3, 'Covid-19', '2022-07-30 21:44:11', '2022-07-30 21:44:11'),
	(4, 'Health Problem', '2022-07-30 21:54:27', '2022-07-30 21:54:27');

-- Dumping structure for table school.marks_grades
DROP TABLE IF EXISTS `marks_grades`;
CREATE TABLE IF NOT EXISTS `marks_grades` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `grade_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `grade_point` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `start_marks` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `end_marks` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `start_point` float NOT NULL DEFAULT 0,
  `end_point` float NOT NULL DEFAULT 0,
  `remarks` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table school.marks_grades: ~5 rows (approximately)
DELETE FROM `marks_grades`;
INSERT INTO `marks_grades` (`id`, `grade_name`, `grade_point`, `start_marks`, `end_marks`, `start_point`, `end_point`, `remarks`, `created_at`, `updated_at`) VALUES
	(1, 'A', '4.0', '8.5', '10', 4, 4, 'Excellent', '2022-08-04 09:51:11', '2022-08-04 10:08:55'),
	(2, 'B', '3.0', '7.0', '8.4', 3, 3.9, 'Good', '2022-08-04 09:56:44', '2022-08-04 10:09:51'),
	(3, 'C', '2', '5.5', '6.9', 2, 2.9, 'Average', '2022-08-04 09:58:06', '2022-08-04 10:10:15'),
	(4, 'D', '1.0', '4.0', '5.4', 1, 1.9, 'Poor Average', '2022-08-04 10:00:44', '2022-08-04 10:00:44'),
	(5, 'F', '0.0', '0.0', '3.9', 0, 0.9, 'Fail', '2022-08-04 10:01:37', '2022-08-04 10:01:37');

-- Dumping structure for table school.migrations
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table school.migrations: ~27 rows (approximately)
DELETE FROM `migrations`;
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '2014_10_12_000000_create_users_table', 1),
	(2, '2014_10_12_100000_create_password_resets_table', 1),
	(3, '2014_10_12_200000_add_two_factor_columns_to_users_table', 1),
	(4, '2019_08_19_000000_create_failed_jobs_table', 1),
	(5, '2019_12_14_000001_create_personal_access_tokens_table', 1),
	(6, '2022_06_04_080518_create_sessions_table', 1),
	(7, '2022_06_16_171116_create_student_classes_table', 1),
	(8, '2022_06_19_083733_create_student_years_table', 1),
	(9, '2022_06_19_161049_create_student_groups_table', 1),
	(10, '2022_06_21_085904_create_student_shifts_table', 1),
	(11, '2022_06_21_163221_create_fee_categories_table', 1),
	(12, '2022_06_22_034148_create_fee_category_amounts_table', 1),
	(13, '2022_06_25_172123_create_exam_types_table', 1),
	(14, '2022_06_26_033257_create_school_subjects_table', 1),
	(15, '2022_06_26_144811_create_assign_subjects_table', 1),
	(16, '2022_06_29_164953_create_designations_table', 1),
	(17, '2022_06_30_171523_create_assign_students_table', 1),
	(18, '2022_06_30_171920_create_discount_students_table', 1),
	(19, '2022_07_24_064408_create_employee_salary_logs_table', 2),
	(20, '2022_07_29_172144_create_leave_purposes_table', 3),
	(21, '2022_07_29_173311_create_employee_leaves_table', 3),
	(22, '2022_07_31_105326_create_employee_attendances_table', 4),
	(23, '2022_08_02_104813_create_student_marks_table', 5),
	(24, '2022_08_04_135647_create_marks_grades_table', 6),
	(25, '2022_08_04_180558_create_account_student_fees_table', 7),
	(26, '2022_08_06_100754_create_account_employee_salaries_table', 8),
	(27, '2022_08_06_151104_create_account_other_costs_table', 9);

-- Dumping structure for table school.password_resets
DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table school.password_resets: ~0 rows (approximately)
DELETE FROM `password_resets`;

-- Dumping structure for table school.personal_access_tokens
DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table school.personal_access_tokens: ~0 rows (approximately)
DELETE FROM `personal_access_tokens`;

-- Dumping structure for table school.school_subjects
DROP TABLE IF EXISTS `school_subjects`;
CREATE TABLE IF NOT EXISTS `school_subjects` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `school_subjects_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table school.school_subjects: ~9 rows (approximately)
DELETE FROM `school_subjects`;
INSERT INTO `school_subjects` (`id`, `name`, `created_at`, `updated_at`) VALUES
	(1, 'Math', '2022-08-02 09:56:45', '2022-08-02 09:56:45'),
	(2, 'Literature', '2022-08-02 09:56:57', '2022-08-02 09:56:57'),
	(3, 'English', '2022-08-02 09:57:03', '2022-08-02 09:57:03'),
	(4, 'Chemistry', '2022-08-02 09:57:24', '2022-08-02 09:57:24'),
	(5, 'Physics', '2022-08-02 09:57:38', '2022-08-02 09:57:38'),
	(6, 'History', '2022-08-02 09:57:56', '2022-08-02 09:57:56'),
	(7, 'Biological', '2022-08-02 09:58:12', '2022-08-02 09:58:12'),
	(8, 'Geography', '2022-08-02 09:58:38', '2022-08-02 09:58:38'),
	(9, 'Information Technology', '2022-08-02 09:59:12', '2022-08-02 09:59:12');

-- Dumping structure for table school.sessions
DROP TABLE IF EXISTS `sessions`;
CREATE TABLE IF NOT EXISTS `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payload` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table school.sessions: ~2 rows (approximately)
DELETE FROM `sessions`;
INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
	('dcRDIWX5osSXYBXrMBey65xbOrwuDeo3sRciGKwX', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/104.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiS25GZDhZU3R2YVJhN0tMaEwxMUhJVGdWRFYzTUpTUDZoalJzZ2JXOSI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjMxOiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvZGFzaGJvYXJkIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTt9', 1660154232);

-- Dumping structure for table school.student_classes
DROP TABLE IF EXISTS `student_classes`;
CREATE TABLE IF NOT EXISTS `student_classes` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `student_classes_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table school.student_classes: ~4 rows (approximately)
DELETE FROM `student_classes`;
INSERT INTO `student_classes` (`id`, `name`, `created_at`, `updated_at`) VALUES
	(1, 'Class A', '2022-07-05 22:11:56', '2022-08-05 07:37:34'),
	(2, 'Class B', '2022-07-05 22:12:02', '2022-08-05 07:37:40'),
	(3, 'Class C', '2022-07-05 22:12:08', '2022-08-05 07:37:51'),
	(4, 'Class D', '2022-07-23 03:57:07', '2022-08-05 07:37:59');

-- Dumping structure for table school.student_groups
DROP TABLE IF EXISTS `student_groups`;
CREATE TABLE IF NOT EXISTS `student_groups` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `student_groups_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table school.student_groups: ~2 rows (approximately)
DELETE FROM `student_groups`;
INSERT INTO `student_groups` (`id`, `name`, `created_at`, `updated_at`) VALUES
	(1, 'Art', '2022-07-05 22:13:28', '2022-07-05 22:13:28'),
	(2, 'Science', '2022-07-05 22:13:35', '2022-07-05 22:13:35'),
	(3, 'Sport', '2022-07-08 07:02:09', '2022-07-08 07:02:09');

-- Dumping structure for table school.student_marks
DROP TABLE IF EXISTS `student_marks`;
CREATE TABLE IF NOT EXISTS `student_marks` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `student_id` int(11) NOT NULL COMMENT 'user_id',
  `id_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `year_id` int(11) DEFAULT NULL,
  `class_id` int(11) DEFAULT NULL,
  `assign_subject_id` int(11) DEFAULT NULL,
  `exam_type_id` int(11) DEFAULT NULL,
  `marks` double DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table school.student_marks: ~2 rows (approximately)
DELETE FROM `student_marks`;
INSERT INTO `student_marks` (`id`, `student_id`, `id_no`, `year_id`, `class_id`, `assign_subject_id`, `exam_type_id`, `marks`, `created_at`, `updated_at`) VALUES
	(1, 5, '20210005', 2, 2, 2, 3, 9, '2022-08-04 03:19:04', '2022-08-04 04:49:04'),
	(2, 5, '20210005', 1, 3, 1, 2, 6, '2022-08-04 03:22:07', '2022-08-04 03:22:07');

-- Dumping structure for table school.student_shifts
DROP TABLE IF EXISTS `student_shifts`;
CREATE TABLE IF NOT EXISTS `student_shifts` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table school.student_shifts: ~4 rows (approximately)
DELETE FROM `student_shifts`;
INSERT INTO `student_shifts` (`id`, `name`, `created_at`, `updated_at`) VALUES
	(3, 'Shift 1', '2022-07-09 00:04:24', '2022-07-09 00:04:24'),
	(4, 'Shift  2', '2022-07-09 00:04:29', '2022-07-09 00:04:29'),
	(5, 'Shift 3', '2022-07-09 00:04:34', '2022-07-09 00:04:34'),
	(6, 'Shift 4', '2022-07-09 00:04:40', '2022-07-09 00:04:40');

-- Dumping structure for table school.student_years
DROP TABLE IF EXISTS `student_years`;
CREATE TABLE IF NOT EXISTS `student_years` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `student_years_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table school.student_years: ~3 rows (approximately)
DELETE FROM `student_years`;
INSERT INTO `student_years` (`id`, `name`, `created_at`, `updated_at`) VALUES
	(1, '2021', '2022-07-05 22:12:18', '2022-07-05 22:12:18'),
	(2, '2020', '2022-07-05 22:12:23', '2022-07-05 22:12:23'),
	(3, '2019', '2022-07-05 22:12:27', '2022-07-05 22:12:27');

-- Dumping structure for table school.users
DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `usertype` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Student, Employee, Admin',
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `two_factor_secret` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `two_factor_recovery_codes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `two_factor_confirmed_at` timestamp NULL DEFAULT NULL,
  `mobile` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fname` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mname` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `religion` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'admin = heade of sotware, operator = computer-operator, user = employee',
  `join_date` date DEFAULT NULL,
  `designation_id` int(11) DEFAULT NULL,
  `salary` double DEFAULT NULL,
  `status` tinyint(4) DEFAULT 1 COMMENT '1=active, 0=inactive, ',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `current_team_id` bigint(20) unsigned DEFAULT NULL,
  `profile_photo_path` varchar(2048) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table school.users: ~7 rows (approximately)
DELETE FROM `users`;
INSERT INTO `users` (`id`, `usertype`, `name`, `email`, `email_verified_at`, `password`, `two_factor_secret`, `two_factor_recovery_codes`, `two_factor_confirmed_at`, `mobile`, `address`, `gender`, `image`, `fname`, `mname`, `religion`, `id_no`, `dob`, `code`, `role`, `join_date`, `designation_id`, `salary`, `status`, `remember_token`, `current_team_id`, `profile_photo_path`, `created_at`, `updated_at`) VALUES
	(1, 'Admin', 'Emil', 'hoangominh01@gmail.com', NULL, '$2y$10$TPXLd20Nw.iq3irU62Mhq.TUxKodWzQSiipNLRQ3TQ4SCAhm/lcui', NULL, NULL, NULL, '0833330069', '94 lanes 9, Dao Tan', 'Male', '202207111752nozomi Icon.png', NULL, NULL, NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, NULL, 1, NULL, NULL, NULL, '2022-07-05 22:08:59', '2022-07-11 10:52:37'),
	(3, 'Admin', 'konomi', '123123@gmail.com', NULL, '$2y$10$9ov.snY2QMo3m/hhu.ePPuGNYHtNiMyr9xJ7muYzDZbMY070DN96K', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '5712', 'Operator', NULL, NULL, NULL, 1, NULL, NULL, NULL, '2022-07-06 08:42:56', '2022-07-06 08:42:56'),
	(4, 'Student', 'Itsuka Shidou', NULL, NULL, '$2y$10$6cqbrBlgXeRgtrN8OSR6Guj4xd6Li1HNOKuknJZ0hh0pPcjEFU/3e', NULL, NULL, NULL, '0123123123', 'Tokyo, Japan', 'Male', '202207090724204328680_4120371211353483_4034176514849139957_n.jpg', 'Itsuka Tatsuo', 'Itsuka Haruko', 'oversea', '20190001', '1998-05-27', '3570', NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, '2022-07-09 00:24:54', '2022-07-09 00:24:54'),
	(5, 'Student', 'MASAKOU Harashima', NULL, NULL, '$2y$10$PsqOGyTxr8fYsFg2Xm.iueUNelY.hi2F9yW5tuf8W1PpL76Ouj9ZK', NULL, NULL, NULL, '+8119-314-9446', '288-1159, Nishishinjuku Shinjuku Sukueatawa(1-kai), Shinjuku-ku, Tokyo', 'Female', '202207091750204328680_4120371211353483_4034176514849139957_n.jpg', 'MASAO Harashima', 'KIYOKO Harashima', 'oversea', '20210005', '2004-11-02', '8194', NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, '2022-07-09 10:50:27', '2022-07-13 06:45:14'),
	(6, 'Student', 'Huy Đàm', NULL, NULL, '$2y$10$.SBusrjyI3hsy1okyNBDZ.0pzOO92vFNrcWDs8Zqsc8kWs3nVZ3aq', NULL, NULL, NULL, '(0280) 059 9183', '61 Phố San, Ấp Thương Mai, Huyện Toại Quản Bình Dương', 'Male', '202207211641Screenshot_75.png', 'Lộc Đàm', 'Quyên Thảo', 'Vietnam', '20190006', '2000-02-24', '6710', NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, '2022-07-21 09:41:56', '2022-07-21 09:41:56'),
	(8, 'Employee', 'Quang Văn', NULL, NULL, '$2y$10$fBhpgixTI.RTUddh3H3b0OK.iW.wot9J3JKr0XAAxo5AQxL1espaS', NULL, NULL, NULL, '096 790 5894', '22 Phố Ông Linh Đình, Xã 86, Huyện Sử Bảo Hải Phòng', 'Male', '202207260802euph_st13_05.png', 'Thái Văn', 'Châu Linh', 'Vietnam', '2016020001', '1990-03-14', '3052', NULL, '2016-02-11', 3, 8500, 1, NULL, NULL, NULL, '2022-07-25 10:17:06', '2022-07-27 06:17:15'),
	(9, NULL, 'kokomi', 'admin@gmail.com', NULL, '$2y$10$1UqcA6Mjhsqw0C4CqPhuS.sSYeseL6Nl/wwxjnM3cF0UUJBBdmLiu', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Operator', NULL, NULL, NULL, 1, NULL, NULL, NULL, '2022-07-26 04:57:33', '2022-07-26 04:57:33'),
	(10, 'Employee', 'Phụng Chu', NULL, NULL, '$2y$10$spjie92pxD4QnUzkeIto0eC8f7fbxEn0KcNLVp737VCE9p.q392oK', NULL, NULL, NULL, '073-037-8099', '645 Phố Khúc Dân Quế, Ấp Châu Trang, Huyện Ân Hồ Chí Minh', 'Female', '202207291703euph_st03_03.png', 'Mạnh Dương', 'Quyên Trang', 'Vietnam', '2012090009', '1980-06-20', '4571', NULL, '2012-09-06', 2, 9000, 1, NULL, NULL, NULL, '2022-07-29 10:03:12', '2022-07-29 10:03:12');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
