-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 17, 2023 at 10:07 PM
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
(104, '2022_12_05_082344_create_attendance_date_table', 8);

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
(1, 'Users', 'MAINTENANCE FOR USERS', 'users', 'fa fa-users', 'users.index', '', NULL, NULL),
(2, 'Modules', 'MAINTENANCE OF SYSTEM MODULEs', 'modules', 'fa fa-file-text', 'modules.index', '', NULL, NULL),
(3, 'Dashboard', 'MAINTENANCE FOR Dashboard', 'dashboard', 'fa fa-users', 'dashboard.index', '', NULL, NULL),
(4, 'Role', 'Role Maintenance', 'role', 'fa fa-address-book', 'role.index', '$2y$10$RmJoWc36CfhC425eMtBWb.km3WPwk8qOPF2rSpc8VMg7DuRjvQa', NULL, NULL);

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
(14, 'Teacher', '3', NULL, '2023-01-17 20:51:03', '2023-01-17 20:51:03');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `first_name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `middle_name` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `suffix_name` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `resumefile` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
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

INSERT INTO `users` (`id`, `first_name`, `middle_name`, `last_name`, `suffix_name`, `resumefile`, `image`, `online`, `active`, `role`, `username`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin ', 'admin', 'admin', 'admin', NULL, NULL, 1, 1, 1, 'admin', '$2y$10$r.FAmKIk7CCKZSBqiEwu8eqFwtbs1x3G3lR7f.c7ZcJSW1gsqMFum', NULL, NULL, '2022-11-29 09:06:00'),
(2, 'Super ', 'admin', 'HR', NULL, NULL, NULL, 0, 1, 4, 'superhr', '$2y$10$HqNdVx4ag0QM.1BR1GipSuEXwFhd/0na7uYwJn8B.5X6rvM2.GDEG', NULL, NULL, '2022-11-11 08:26:14');

--
-- Indexes for dumped tables
--

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
-- Indexes for table `role`
--
ALTER TABLE `role`
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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=105;

--
-- AUTO_INCREMENT for table `modules`
--
ALTER TABLE `modules`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=467;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
