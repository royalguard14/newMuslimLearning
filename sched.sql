-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 22, 2023 at 09:36 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `zear_fresh`
--

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `course_name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `course_acronym` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `course_name`, `course_acronym`, `created_at`, `updated_at`) VALUES
(1, 'bachelor of science computer science', 'bscs', '2023-01-18 15:46:08', '2023-01-18 15:46:08');

-- --------------------------------------------------------

--
-- Table structure for table `course_subjects`
--

CREATE TABLE `course_subjects` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `course_id` int(11) NOT NULL,
  `course_sem` int(11) NOT NULL,
  `course_subject_code` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `course_subject_name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `course_subject_desc` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `logs` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `course_subjects`
--

INSERT INTO `course_subjects` (`id`, `course_id`, `course_sem`, `course_subject_code`, `course_subject_name`, `course_subject_desc`, `logs`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 'COM102', 'computer basic 2', 'basic binary compute\r\nbinary used', NULL, '2023-01-18 16:25:44', '2023-01-18 16:25:44');

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `department_name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `department_head` int(11) DEFAULT NULL,
  `logs` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `department_name`, `department_head`, `logs`, `created_at`, `updated_at`) VALUES
(2, 'computer science', NULL, NULL, '2023-01-18 16:35:13', '2023-01-18 16:35:13'),
(3, 'hotel and restaurant management', NULL, NULL, '2023-01-18 16:35:52', '2023-01-18 16:35:52');

-- --------------------------------------------------------

--
-- Table structure for table `designs`
--

CREATE TABLE `designs` (
  `id` int(10) UNSIGNED NOT NULL,
  `function` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `class` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `designs`
--

INSERT INTO `designs` (`id`, `function`, `name`, `class`, `created_at`, `updated_at`) VALUES
(1, 'Theme', 'Mode', 'light-mode', NULL, NULL),
(2, 'Maintenance', 'Maintenance Page', 'off', NULL, NULL),
(22, 'color1', 'Navbar Variants', 'navbar-dark navbar-danger', NULL, NULL),
(23, 'color2', 'Accent Color Variants', 'accent-black', NULL, NULL),
(24, 'color3', 'Sidebar Variants', 'os-theme-light|sidebar-dark-success', NULL, NULL),
(25, 'color5', 'Brand Logo Variants', 'navbar-indigo', NULL, NULL),
(26, 'Theme', 'Website Mode', 'off', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `frontends`
--

CREATE TABLE `frontends` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ip_access`
--

CREATE TABLE `ip_access` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ip_address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `logs` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remarks` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ip_access`
--

INSERT INTO `ip_access` (`id`, `ip_address`, `status`, `logs`, `remarks`) VALUES
(1, '::1', '1', NULL, ' '),
(8, '49.146.44.244', '1', NULL, 'Developer'),
(9, '180.191.147.251', '1', NULL, 'demo'),
(10, '124.106.218.146', '1', NULL, 'demo'),
(11, '49.148.219.165', '1', NULL, 'demo');

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

CREATE TABLE `logs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `unicode` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `company_code` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `branch_code` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `module` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `info` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `remark` text COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `logs`
--

INSERT INTO `logs` (`id`, `unicode`, `company_code`, `branch_code`, `module`, `date`, `info`, `remark`) VALUES
(1, 'cPyGIjgKouBZ7sen', '0001', '0010', 'transfer_employee', '2022-10-12 01:43:23', '0001|0010|admin25|0002|0006', '||admin19'),
(2, 'aEjg2blWBDSLwOVR', '0002', '0006', 'transfer_employee', '2022-11-28 15:15:11', '0002|0006|325|0002|0003', '0002|0006|007');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(2, '2022_07_24_195230_create_13month_table', 1),
(3, '2022_07_24_195230_create_allowance_type_table', 1),
(4, '2022_07_24_195230_create_allowances_list_table', 1),
(5, '2022_07_24_195230_create_array_data_table', 1),
(6, '2022_07_24_195230_create_bank_details_table', 1),
(7, '2022_07_24_195230_create_branch_routes_table', 1),
(8, '2022_07_24_195230_create_branches_table', 1),
(9, '2022_07_24_195230_create_company_table', 1),
(10, '2022_07_24_195230_create_companyinfo_table', 1),
(11, '2022_07_24_195230_create_deduction_list_table', 1),
(12, '2022_07_24_195230_create_deduction_type_table', 1),
(13, '2022_07_24_195230_create_departments_table', 1),
(14, '2022_07_24_195230_create_designs_table', 1),
(15, '2022_07_24_195230_create_employdata_table', 1),
(16, '2022_07_24_195230_create_employee_attendance_table', 1),
(17, '2022_07_24_195230_create_failed_jobs_table', 1),
(18, '2022_07_24_195230_create_frontends_table', 1),
(19, '2022_07_24_195230_create_hdmf_remittance_data_table', 1),
(20, '2022_07_24_195230_create_holiday_table', 1),
(21, '2022_07_24_195230_create_incom_table', 1),
(22, '2022_07_24_195230_create_ip_access_table', 1),
(23, '2022_07_24_195230_create_job_batches_table', 1),
(24, '2022_07_24_195230_create_jobs_table', 1),
(25, '2022_07_24_195230_create_leave_list_table', 1),
(26, '2022_07_24_195230_create_leave_type_table', 1),
(27, '2022_07_24_195230_create_loan_list_table', 1),
(28, '2022_07_24_195230_create_loan_paid_table', 1),
(29, '2022_07_24_195230_create_loan_type_table', 1),
(30, '2022_07_24_195230_create_logs_table', 1),
(31, '2022_07_24_195230_create_modules_table', 1),
(32, '2022_07_24_195230_create_notes_table', 1),
(33, '2022_07_24_195230_create_password_resets_table', 1),
(34, '2022_07_24_195230_create_payroll_allowance_generated_table', 1),
(35, '2022_07_24_195230_create_payroll_deduction_generated_table', 1),
(37, '2022_07_24_195230_create_payroll_loans_generated_table', 1),
(38, '2022_07_24_195230_create_payroll_mandatory_generated_table', 1),
(39, '2022_07_24_195230_create_phlhealth_remittance_data_table', 1),
(40, '2022_07_24_195230_create_positions_table', 1),
(41, '2022_07_24_195230_create_role_table', 1),
(42, '2022_07_24_195230_create_salart_adjustment_table', 1),
(45, '2022_07_24_195230_create_tax_contribution_table', 1),
(46, '2022_07_24_195230_create_tax_remittance_data_table', 1),
(47, '2022_07_24_195230_create_users_table', 1),
(48, '2022_07_25_132221_create_payroll_detail_data_table', 2),
(49, '2022_10_04_043755_create_13month_table', 0),
(50, '2022_10_04_043755_create_allowance_type_table', 0),
(51, '2022_10_04_043755_create_allowances_list_table', 0),
(52, '2022_10_04_043755_create_array_data_table', 0),
(53, '2022_10_04_043755_create_bank_details_table', 0),
(54, '2022_10_04_043755_create_branch_routes_table', 0),
(55, '2022_10_04_043755_create_branches_table', 0),
(56, '2022_10_04_043755_create_company_table', 0),
(57, '2022_10_04_043755_create_companyinfo_table', 0),
(58, '2022_10_04_043755_create_deduction_list_table', 0),
(59, '2022_10_04_043755_create_deduction_type_table', 0),
(60, '2022_10_04_043755_create_departments_table', 0),
(61, '2022_10_04_043755_create_designs_table', 0),
(62, '2022_10_04_043755_create_employdata_table', 0),
(63, '2022_10_04_043755_create_employee_attendance_table', 0),
(64, '2022_10_04_043755_create_failed_jobs_table', 0),
(65, '2022_10_04_043755_create_frontends_table', 0),
(66, '2022_10_04_043755_create_hdmf_remittance_data_table', 0),
(67, '2022_10_04_043755_create_holiday_table', 0),
(68, '2022_10_04_043755_create_incom_table', 0),
(69, '2022_10_04_043755_create_ip_access_table', 0),
(70, '2022_10_04_043755_create_job_batches_table', 0),
(71, '2022_10_04_043755_create_jobs_table', 0),
(72, '2022_10_04_043755_create_leave_count_table', 0),
(73, '2022_10_04_043755_create_leave_list_table', 0),
(74, '2022_10_04_043755_create_leave_type_table', 0),
(75, '2022_10_04_043755_create_loan_list_table', 0),
(76, '2022_10_04_043755_create_loan_paid_table', 0),
(77, '2022_10_04_043755_create_loan_type_table', 0),
(78, '2022_10_04_043755_create_logs_table', 0),
(79, '2022_10_04_043755_create_modules_table', 0),
(80, '2022_10_04_043755_create_notes_table', 0),
(81, '2022_10_04_043755_create_password_resets_table', 0),
(82, '2022_10_04_043755_create_payroll_allowance_generated_table', 0),
(83, '2022_10_04_043755_create_payroll_deduction_generated_table', 0),
(84, '2022_10_04_043755_create_payroll_detail_data_table', 0),
(85, '2022_10_04_043755_create_payroll_generated_table', 0),
(86, '2022_10_04_043755_create_payroll_loans_generated_table', 0),
(87, '2022_10_04_043755_create_payroll_mandatory_generated_table', 0),
(88, '2022_10_04_043755_create_personal_access_tokens_table', 0),
(89, '2022_10_04_043755_create_phlhealth_remittance_data_table', 0),
(90, '2022_10_04_043755_create_positions_table', 0),
(91, '2022_10_04_043755_create_role_table', 0),
(92, '2022_10_04_043755_create_salart_adjustment_table', 0),
(95, '2022_10_04_043755_create_tax_contribution_table', 0),
(96, '2022_10_04_043755_create_tax_remittance_data_table', 0),
(97, '2022_10_04_043755_create_users_table', 0),
(98, '2022_10_04_143329_create_jobs_table', 3),
(99, '2022_10_04_143633_create_job_batches_table', 3),
(100, '2022_10_04_144138_create_failed_jobs_table', 4),
(101, '2022_07_24_195230_create_payroll_generated_table', 5),
(102, '2022_07_24_195230_create_sss_remittance_data_table', 6),
(103, '2022_11_09_054626_create_declarations_table', 7),
(104, '2022_12_05_082344_create_attendance_date_table', 8),
(105, '2023_01_17_213226_create_departments_table', 9),
(106, '2023_01_18_085224_create_professor_table', 10),
(108, '2023_01_18_131849_create_courses_table', 11),
(110, '2023_01_18_170625_create_section_room_table', 13),
(111, '2023_01_18_131540_create_professor_assigned_table', 14),
(113, '2023_01_21_175954_create_student_table', 15);

-- --------------------------------------------------------

--
-- Table structure for table `modules`
--

CREATE TABLE `modules` (
  `id` int(10) UNSIGNED NOT NULL,
  `module` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `routeUri` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `default_url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `encryptname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `modules`
--

INSERT INTO `modules` (`id`, `module`, `description`, `routeUri`, `icon`, `default_url`, `encryptname`, `created_at`, `updated_at`) VALUES
(1, 'Ajax', 'Ajax access', 'ajax', 'fa fa-code', 'ajax', '$2y$10$RlyVStFGO4K14ZTd.d9KYeHKCJNrALJnVIvzjx97ZLUkxYQ3mSmO', NULL, NULL),
(2, 'Modules', 'MAINTENANCE OF SYSTEM MODULEs', 'modules', 'fa fa-file-text', 'modules.index', '', NULL, NULL),
(3, 'Dashboard', 'MAINTENANCE FOR Dashboard', 'dashboard', 'fa fa-users', 'dashboard.index', '', NULL, NULL),
(4, 'Role', 'Role Maintenance', 'role', 'fa fa-address-book', 'role.index', '$2y$10$RmJoWc36CfhC425eMtBWb.km3WPwk8qOPF2rSpc8VMg7DuRjvQa', NULL, NULL),
(5, 'Department', 'Deparment Maintenance', 'department', 'fa fa-building', 'department.index', '$2y$10$keJKOm0KjoLiJMf2kS6iHOJpQHXkFbSaYT56icQCjnQESm8HO70Ii', NULL, NULL),
(6, 'List', 'Add professor here', 'professor', 'fa fa-user', 'professor.list', '$2y$10$0Cbw0pva9sU.tIVEqF9.relPqgFzXS3pTrHja9NIzW7ZDsgaipeO', NULL, NULL),
(7, 'List', 'Course List', 'courses', 'fa fa-address-book-o', 'course.list', '$2y$10$DPnXt03dlQOcg8yqYzxdeBrtaesocwKm3.eCap9N0E92Zl1nhst.', NULL, NULL),
(8, 'Section & Room', 'Section and room maintenance', 'sec_rom', 'fa fa-angle-double-down', 'secrom.index', '$2y$10$SSKUvJILdkQYeXaRErUNXOtOX7U1fcHV59mAFOZBrzTkb.yOklrxm', NULL, NULL),
(9, 'Users', 'MAINTENANCE FOR USERS', 'users', 'fa fa-users', 'users.index', '', NULL, NULL),
(10, 'List', 'Student List', 'student', 'fa fa-book', 'student.list', '$2y$10$.HE0A3SI6nHcgD4jMS6KG.guW6XUihhXhkfDUbbYUEVQPYb27dKa6', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `professor`
--

CREATE TABLE `professor` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `professor_id_number` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `department_id` int(11) NOT NULL,
  `professor_first_name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `professor_middle_name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `professor_lastname_name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `professor_suffix` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `professor_points` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `professor`
--

INSERT INTO `professor` (`id`, `professor_id_number`, `department_id`, `professor_first_name`, `professor_middle_name`, `professor_lastname_name`, `professor_suffix`, `professor_points`, `created_at`, `updated_at`) VALUES
(1, 'admin19', 1, 'ghaizer', 'atara', 'bautista', '', 'Administrator', '2023-01-18 10:20:08', '2023-01-18 10:20:08'),
(2, '10-3242', 2, 'israfil', 'fernandez', 'bautista', '', 'BSCS Graduate with  honor', '2023-01-18 16:37:27', '2023-01-18 16:37:27'),
(3, '10-3241', 3, 'guillermo', 'jalli', 'bautista', 'jr', '....', '2023-01-19 21:06:33', '2023-01-19 21:06:33');

-- --------------------------------------------------------

--
-- Table structure for table `professor_assigned`
--

CREATE TABLE `professor_assigned` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `courses_id` int(11) NOT NULL,
  `subjects_id` int(11) NOT NULL,
  `end_date` date NOT NULL,
  `section_id` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `professor_id` int(11) NOT NULL,
  `day` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `time_start` time NOT NULL,
  `time_end` time NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `professor_assigned`
--

INSERT INTO `professor_assigned` (`id`, `courses_id`, `subjects_id`, `end_date`, `section_id`, `room_id`, `professor_id`, `day`, `time_start`, `time_end`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2023-12-31', 1, 1, 2, 'mon', '08:00:00', '10:00:00', '2023-01-21 14:50:05', '2023-01-21 14:50:05'),
(2, 1, 1, '2023-12-30', 1, 2, 3, 'mon', '10:00:00', '11:00:00', '2023-01-21 16:13:27', '2023-01-21 16:13:27');

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `group` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `modules` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `log` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id`, `group`, `modules`, `log`, `created_at`, `updated_at`) VALUES
(1, 'admin', '1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,36', NULL, NULL, NULL),
(2, 'Teacher', '3', NULL, '2023-01-17 20:51:03', '2023-01-17 20:51:03');

-- --------------------------------------------------------

--
-- Table structure for table `room`
--

CREATE TABLE `room` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `room_name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `room_location` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `room_available` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `room`
--

INSERT INTO `room` (`id`, `room_name`, `room_location`, `room_available`, `created_at`, `updated_at`) VALUES
(1, 'LAB 1', 'Bldg B.', 0, '2023-01-18 21:49:49', '2023-01-18 21:49:49'),
(2, 'RM11', 'Main Building', 0, '2023-01-19 19:56:11', '2023-01-19 19:56:11');

-- --------------------------------------------------------

--
-- Table structure for table `section`
--

CREATE TABLE `section` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `course_id` int(11) NOT NULL,
  `section_name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `sy_from` year(4) NOT NULL,
  `sy_to` year(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `section`
--

INSERT INTO `section` (`id`, `course_id`, `section_name`, `sy_from`, `sy_to`, `created_at`, `updated_at`) VALUES
(1, 1, 'E11', 2022, 2023, '2023-01-18 20:55:09', '2023-01-18 20:55:09'),
(2, 1, 'E12', 2022, 2023, '2023-01-18 21:41:53', '2023-01-18 21:41:53');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `enrolled` date NOT NULL,
  `course_id` int(11) NOT NULL,
  `section_id` int(11) NOT NULL,
  `student_id_number` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `student_first_name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `student_middle_name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `student_lastname_name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `student_suffix` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `logs` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`id`, `enrolled`, `course_id`, `section_id`, `student_id_number`, `student_first_name`, `student_middle_name`, `student_lastname_name`, `student_suffix`, `logs`, `created_at`, `updated_at`) VALUES
(1, '2023-01-01', 1, 2, '23-001', 'mauven', 'fernandez', 'bautista', 'jr', NULL, '2023-01-21 19:35:57', '2023-01-21 19:35:57');

-- --------------------------------------------------------

--
-- Table structure for table `student_enrolled`
--

CREATE TABLE `student_enrolled` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `professor_assigned_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `student_enrolled`
--

INSERT INTO `student_enrolled` (`id`, `professor_assigned_id`, `student_id`, `created_at`, `updated_at`) VALUES
(1, 2, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_number` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `online` tinyint(1) NOT NULL,
  `active` tinyint(1) NOT NULL,
  `role` int(11) NOT NULL,
  `username` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `id_number`, `online`, `active`, `role`, `username`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin19', 1, 1, 1, 'admin', '$2y$10$C5.7bWxdWtUaicuByLmkNOpGL5fMOhzh4ixQgu1w.64mGwaxQxNp.', NULL, '2023-01-18 10:20:08', '2023-01-18 10:21:36'),
(3, '10-3242', 0, 1, 2, '10-3242', '$2y$10$TEw07MXIg8Z/ub5vBhNI3ehuKgH4SfkAB9bLiU44lHniPcjQEcVTK', NULL, '2023-01-18 16:37:27', '2023-01-18 16:37:27'),
(4, '10-3241', 0, 1, 2, '10-3241', '$2y$10$XjYXmyf5I.JoMQP7vFJDU.iKAlysW.yzlkAfJcyhgkaTPyq8wUztS', NULL, '2023-01-19 21:06:33', '2023-01-19 21:06:33'),
(6, '23-001', 0, 1, 3, '23-001', '$2y$10$E3kdlwxNm0aq2Ncazbhx4em4t4fEFsS/sJJ7LpLHKVVaZ4eFI2FaW', NULL, '2023-01-21 19:35:57', '2023-01-21 19:35:57');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `course_subjects`
--
ALTER TABLE `course_subjects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `designs`
--
ALTER TABLE `designs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `frontends`
--
ALTER TABLE `frontends`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ip_access`
--
ALTER TABLE `ip_access`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `modules`
--
ALTER TABLE `modules`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `professor`
--
ALTER TABLE `professor`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `professor_assigned`
--
ALTER TABLE `professor_assigned`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `room`
--
ALTER TABLE `room`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `section`
--
ALTER TABLE `section`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student_enrolled`
--
ALTER TABLE `student_enrolled`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `course_subjects`
--
ALTER TABLE `course_subjects`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `designs`
--
ALTER TABLE `designs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `frontends`
--
ALTER TABLE `frontends`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ip_access`
--
ALTER TABLE `ip_access`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `logs`
--
ALTER TABLE `logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=114;

--
-- AUTO_INCREMENT for table `modules`
--
ALTER TABLE `modules`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `professor`
--
ALTER TABLE `professor`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `professor_assigned`
--
ALTER TABLE `professor_assigned`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `room`
--
ALTER TABLE `room`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `section`
--
ALTER TABLE `section`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `student_enrolled`
--
ALTER TABLE `student_enrolled`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
