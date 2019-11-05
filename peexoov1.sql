-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 17, 2019 at 10:59 AM
-- Server version: 5.7.24
-- PHP Version: 7.2.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `peexoov1`
--

-- --------------------------------------------------------

--
-- Table structure for table `album_comments`
--

CREATE TABLE `album_comments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `billing_addresses`
--

CREATE TABLE `billing_addresses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `firstname` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastname` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `country` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `state` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `postal_code` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `photographer_id` bigint(20) NOT NULL,
  `booking_category_id` bigint(20) NOT NULL,
  `title` text COLLATE utf8mb4_unicode_ci,
  `extra_message` mediumtext COLLATE utf8mb4_unicode_ci,
  `country` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `state` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `address1` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `address2` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `shoot_start_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `shoot_end_date` datetime NOT NULL,
  `delivery_date` datetime NOT NULL,
  `status` enum('ONGOING','PENDING','CANCELLED','COMPLETED') COLLATE utf8mb4_unicode_ci NOT NULL,
  `review` longtext COLLATE utf8mb4_unicode_ci,
  `review_date` datetime DEFAULT NULL,
  `rating` int(11) DEFAULT NULL,
  `package_name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `user_id`, `photographer_id`, `booking_category_id`, `title`, `extra_message`, `country`, `state`, `address1`, `address2`, `type`, `shoot_start_date`, `shoot_end_date`, `delivery_date`, `status`, `review`, `review_date`, `rating`, `package_name`, `created_at`, `updated_at`) VALUES
(6, 5, 1, 0, 'Mr Adeola\'s booking', 'string', 'string', 'string', 'string', 'string', 'string', '2016-02-29 00:00:00', '2016-02-29 00:00:00', '2016-03-29 00:00:00', 'ONGOING', NULL, NULL, NULL, 'string', '2019-09-13 09:39:44', '2019-09-13 17:57:09'),
(7, 5, 1, 0, 'string', 'string', 'string', 'string', 'string', 'string', 'string', '2019-09-14 00:00:00', '2019-09-15 00:00:00', '2019-09-15 00:00:00', 'PENDING', NULL, NULL, NULL, 'string', '2019-09-13 09:53:41', '2019-09-13 09:53:41'),
(8, 5, 3, 0, 'string', 'string', 'string', 'string', 'string', 'string', 'string', '2019-09-14 00:00:00', '2019-09-15 00:00:00', '2019-09-15 00:00:00', 'PENDING', NULL, NULL, NULL, 'string', '2019-09-13 09:59:07', '2019-09-13 09:59:07'),
(9, 5, 1, 0, 'string', 'string', 'string', 'string', 'string', 'string', 'string', '2019-09-14 00:00:00', '2019-09-15 00:00:00', '2019-09-15 00:00:00', 'PENDING', NULL, NULL, NULL, 'string', '2019-09-13 10:01:54', '2019-09-13 10:01:54'),
(10, 5, 1, 0, 'string', 'string', 'string', 'string', 'string', 'string', 'string', '2019-09-14 00:00:00', '2019-09-15 00:00:00', '2019-09-15 00:00:00', 'PENDING', NULL, NULL, NULL, 'string', '2019-09-13 10:24:13', '2019-09-13 10:24:13'),
(11, 5, 1, 0, 'string', 'string', 'string', 'string', 'string', 'string', 'string', '2019-09-14 00:00:00', '2019-09-15 00:00:00', '2019-09-15 00:00:00', 'PENDING', NULL, NULL, NULL, 'string', '2019-09-13 10:27:04', '2019-09-13 10:27:04');

-- --------------------------------------------------------

--
-- Table structure for table `booking_categories`
--

CREATE TABLE `booking_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `booking_details`
--

CREATE TABLE `booking_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `booking_images`
--

CREATE TABLE `booking_images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `booking_items`
--

CREATE TABLE `booking_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `booking_id` bigint(20) NOT NULL,
  `title` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` int(11) NOT NULL,
  `cost` double NOT NULL,
  `active` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `booking_items`
--

INSERT INTO `booking_items` (`id`, `booking_id`, `title`, `quantity`, `cost`, `active`, `created_at`, `updated_at`) VALUES
(1, 9, 'Pre wedding', 5, 75000, 1, '2019-09-12 23:00:00', '2019-09-12 23:00:00'),
(2, 9, 'Traditional wedding', 3, 100000, 1, '2019-09-12 23:00:00', '2019-09-12 23:00:00'),
(3, 9, 'Court wedding', 2, 35000, 1, '2019-09-12 23:00:00', '2019-09-12 23:00:00'),
(4, 10, 'Pre wedding', 5, 75000, 1, '2019-09-12 23:00:00', '2019-09-12 23:00:00'),
(5, 10, 'Traditional wedding', 3, 100000, 1, '2019-09-12 23:00:00', '2019-09-12 23:00:00'),
(6, 10, 'Court wedding', 2, 35000, 1, '2019-09-12 23:00:00', '2019-09-12 23:00:00'),
(7, 11, 'Pre wedding', 5, 75000, 1, '2019-09-13 10:27:04', '2019-09-13 10:27:04'),
(8, 11, 'Traditional wedding', 3, 100000, 1, '2019-09-13 10:27:04', '2019-09-13 10:27:04'),
(9, 11, 'Court wedding', 2, 35000, 1, '2019-09-13 10:27:04', '2019-09-13 10:27:04');

-- --------------------------------------------------------

--
-- Table structure for table `booking_types`
--

CREATE TABLE `booking_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_image` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_icon` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `caption` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `key_code` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `booking_types`
--

INSERT INTO `booking_types` (`id`, `title`, `display_image`, `display_icon`, `caption`, `key_code`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Wedding', 'emptyimage.png', 'emptyicon.png', 'Wedding Caption', 'WDNG', 1, '2019-09-22 10:13:32', '2019-09-22 10:13:32'),
(2, 'Event', 'emptyimage.png', 'emptyicon.png', 'Event Caption', 'EVNT', 1, '2019-09-22 10:13:32', '2019-09-22 10:13:32'),
(3, 'Product', 'emptyimage.png', 'emptyicon.png', 'Product Caption', 'PRDCT', 1, '2019-09-22 10:13:32', '2019-09-22 10:13:32'),
(4, 'Real Estate', 'emptyimage.png', 'emptyicon.png', 'Real Estate Caption', 'RLEST', 1, '2019-09-22 10:13:32', '2019-09-22 10:13:32'),
(16, 'Portrait', 'emptyimage.png', 'emptyicon.png', 'Portrait Caption', 'POTR', 1, '2019-09-27 11:02:24', '2019-09-27 11:02:24'),
(17, 'Family', 'emptyimage.png', 'emptyicon.png', 'Family Caption', 'FMLY', 1, '2019-09-27 11:02:24', '2019-09-27 11:02:24'),
(18, 'Babies', 'emptyimage.png', 'emptyicon.png', 'Babies Caption', 'BBS', 1, '2019-09-27 11:02:24', '2019-09-27 11:02:24'),
(19, 'Corporate', 'emptyimage.png', 'emptyicon.png', 'Corporate Caption', 'COPT', 1, '2019-09-27 11:02:24', '2019-09-27 11:02:24'),
(20, 'Landscape', 'emptyimage.png', 'emptyicon.png', 'Landscape Caption', 'LNDS', 1, '2019-09-27 11:02:24', '2019-09-27 11:02:24'),
(21, 'Architectural', 'emptyimage.png', 'emptyicon.png', 'Architectural Caption', 'ARCH', 1, '2019-09-27 11:02:24', '2019-09-27 11:02:24'),
(22, 'Interior', 'emptyimage.png', 'emptyicon.png', 'Interior Caption', 'INTR', 1, '2019-09-27 11:02:24', '2019-09-27 11:02:24');

-- --------------------------------------------------------

--
-- Table structure for table `email_resets`
--

CREATE TABLE `email_resets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `hash` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `url_path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `email_resets`
--

INSERT INTO `email_resets` (`id`, `hash`, `email`, `url_path`, `created_at`, `updated_at`) VALUES
(9, '$2y$10$SH0gLXsejViOMdb2UR09GeCZm.FDTgjTvvAfp3NuePahtdhzkst.m', 'rupadozali@mail-card.com', 'sssss', '2019-08-05 12:33:53', '2019-08-05 12:33:53');

-- --------------------------------------------------------

--
-- Table structure for table `faqs`
--

CREATE TABLE `faqs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `question` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `answer` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `active` tinyint(1) NOT NULL,
  `category_id` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(2, '2014_10_12_100000_create_password_resets_table', 2),
(6, '2019_08_02_094605_create_jobs_table', 4),
(9, '2019_08_02_104752_create_otp_table', 6),
(11, '2019_08_02_185300_create__email_reset_table', 7),
(13, '2019_08_08_221331_create_photographer_bank_account_details_table', 9),
(17, '2019_06_01_044037_create_photographers_table', 10),
(18, '2014_10_12_000000_create_users_table', 11),
(20, '2019_08_17_002808_create_user_payment_installments_table', 13),
(23, '2019_08_10_002824_create_user_payments_table', 16),
(25, '2019_08_08_163031_create_f_a_qtable', 17),
(26, '2019_08_09_131805_create_photographer_invoices_table', 18),
(28, '2019_08_22_120504_create_user_subscriptions_table', 19),
(29, '2019_08_22_205750_subscription_plans', 20),
(30, '2019_08_28_035724_create_photographer_profile_images_table', 21),
(31, '2019_08_09_142137_create_album_comments_table', 22),
(32, '2019_08_10_011600_create_booking_details_table', 22),
(33, '2019_08_18_145907_create_photographer_portfolios_table', 22),
(35, '2019_08_22_200944_create_peexoo_photography_community_models_table', 22),
(36, '2019_08_25_143250_create_booking_categories_table', 22),
(38, '2019_09_05_162542_create_photographer_portfolio_categories_table', 23),
(39, '2019_08_18_152531_create_photographer_portfolio_images_table', 24),
(41, '2019_09_06_084146_create_peexoo_calendars_table', 25),
(46, '2019_09_07_000220_create_notification_settings_types_table', 26),
(49, '2019_09_07_001909_create_notification_settings_items_table', 27),
(50, '2019_09_07_085421_photographer_card_details', 28),
(51, '2019_09_07_101641_create_billing_addresses_table', 29),
(52, '2019_08_17_164216_booking', 30),
(53, '2019_08_25_150049_create_booking_items_table', 31),
(54, '2019_09_19_140054_photographer_package', 32),
(55, '2019_09_20_112620_photographer_package_item', 33),
(57, '2019_09_22_101636_booking_type', 34),
(58, '2019_09_05_103614_create_user_notification_settings_table', 35),
(59, '2019_09_05_113320_create_photographer_billing_details_table', 35),
(60, '2019_09_27_151416_create_booking_images_table', 35),
(61, '2019_10_03_143136_create_photographer_cine_types_table', 35);

-- --------------------------------------------------------

--
-- Table structure for table `notification_settings_items`
--

CREATE TABLE `notification_settings_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `notification_settings_type_key` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `item_key` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `default` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notification_settings_items`
--

INSERT INTO `notification_settings_items` (`id`, `notification_settings_type_key`, `item_key`, `title`, `default`, `created_at`, `updated_at`) VALUES
(1, 'N_SYS', 'N_SYS_PSH', 'Push', 1, NULL, NULL),
(2, 'N_SYS', 'N_SYS_EML', 'Email', 1, NULL, NULL),
(3, 'N_SYS', 'N_SYS_SMS', 'SMS', 1, NULL, NULL),
(4, 'N_MSG', 'N_MSG_PSH', 'Push', 1, NULL, NULL),
(5, 'N_MSG', 'N_MSG_EML', 'Email', 1, NULL, NULL),
(6, 'N_MSG', 'N_MSG_SMS', 'SMS', 1, NULL, NULL),
(7, 'N_PFL', 'N_PFL_PSH', 'Push', 1, NULL, NULL),
(8, 'N_PFL', 'N_PFL_EML', 'Email', 1, NULL, NULL),
(9, 'N_PFL', 'N_PFL_SMS', 'SMS', 1, NULL, NULL),
(10, 'N_BKN', 'N_BKN_PSH', 'Push', 1, NULL, NULL),
(11, 'N_BKN', 'N_BKN_EML', 'Email', 1, NULL, NULL),
(12, 'N_BKN', 'N_BKN_SMS', 'SMS', 1, NULL, NULL),
(13, 'N_PMT', 'N_PMT_PSH', 'Push', 1, NULL, NULL),
(14, 'N_PMT', 'N_PMT_EML', 'Email', 1, NULL, NULL),
(15, 'N_PMT', 'N_PMT_SMS', 'SMS', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `notification_settings_types`
--

CREATE TABLE `notification_settings_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_key` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notification_settings_types`
--

INSERT INTO `notification_settings_types` (`id`, `title`, `id_key`, `enabled`, `created_at`, `updated_at`) VALUES
(1, 'System Notifications', 'N_SYS', 1, '2019-09-07 07:02:56', '2019-09-07 07:02:56'),
(2, 'Message Notifications', 'N_MSG', 1, '2019-09-07 07:02:56', '2019-09-07 07:02:56'),
(3, 'Portfolio Notifications', 'N_PFL', 1, '2019-09-07 07:02:56', '2019-09-07 07:02:56'),
(4, 'Booking Notifications', 'N_BKN', 1, '2019-09-07 07:02:56', '2019-09-07 07:02:56'),
(5, 'Payment Notifications', 'N_PMT', 1, '2019-09-07 07:02:56', '2019-09-07 07:02:56');

-- --------------------------------------------------------

--
-- Table structure for table `otp`
--

CREATE TABLE `otp` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` int(11) NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `key_1` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `key_2` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `otp`
--

INSERT INTO `otp` (`id`, `code`, `email`, `user_id`, `key_1`, `key_2`, `created_at`, `updated_at`) VALUES
(31, 7798, 'jasf@rich-mail.net', 12, '$2y$10$zPYd6r9VNPLqAnHnGroSU.Ec86zg25.0RwWffv.KNJy3Obo4N8xIu', '$2y$10$GzpWbdCEVLY4GiQ83X7TjOYC9b5T.B9wAH37VNqKdYbZloy1OOXH2', '2019-09-06 09:50:11', '2019-09-06 09:50:11'),
(32, 6609, 'godix@mail-desk.net', 13, '$2y$10$AyBwfBIMh.M.iIFmBDbA2uN8MgsBdZWxhpoJzmh/i5Dzm9bSKHxpW', '$2y$10$LZg0er4EO0Ur/1XLynAgYOsV6YG/D.ecfkGwmSb9cbtYSjCmIIbuu', '2019-09-06 10:00:50', '2019-09-06 10:00:50'),
(33, 2291, 'jasm@drmail.net', 14, '$2y$10$xo19HoTXFJN3hKnBJyNaCOq2HQ/mA6qutrjbFdZWfmdyTDZZ73ZyG', '$2y$10$1SuotnR2E27GiX5Odx7MfOFVCA78rWjEioClQSIo7gdh9ThbW6vr.', '2019-09-06 10:14:09', '2019-09-06 10:14:09'),
(34, 1204, 'jas@mail-guru.net', 15, '$2y$10$I0x8rXsgr8Y/5gTp73PrGupZJukrP/Sj5VR.DYi.EJTI3daI8jHOO', '$2y$10$vlM1dicSZWQiQzyVy5uT7.fv2gUY.Q9Xbs1IC1MxALuixcGNQzW7O', '2019-09-06 10:20:38', '2019-09-06 10:20:38'),
(35, 9496, 'mtch@mail-desk.net', 16, '$2y$10$vajc1u18tcrjU6/p2PfDbOZa3JieoA7oWf6e6c9ZF9D8uHwmecYTO', '$2y$10$xhfbqQchJisE6Ox3B/MFfeAaMFDozvkRI7vDsY4c7YLYOBKL2qgne', '2019-09-06 10:26:51', '2019-09-06 10:26:51'),
(36, 2481, 'mich@mail-desk.net', 17, '$2y$10$.w00H0IOKhaweqBqV3fWtu6mvc5NTMuboyyOyjt/Tf0/62RdbGuoS', '$2y$10$SXvobtCVSUC3tfZwShsbc.ptYP0uPjV7ElCHlWmgZ4Z7CU2fbDpoy', '2019-09-06 10:42:34', '2019-09-06 10:42:34'),
(37, 8364, 'dumab@dd.com', 18, '$2y$10$wPdBc2QwKVQLpS52pMOJ6uVvhhUxzjFlRIZ.do6IyLlvu9BSlzPh.', '$2y$10$koLm.kuNmZ3nnwzSEelkz.GihyokMbj8knm6eE8QULtv.JUf1/UW.', '2019-09-06 12:01:17', '2019-09-06 12:01:17'),
(38, 7742, 'dumaib@dd.com', 19, '$2y$10$.L9Hpxd3iSXnxCmgEWAavuFih4LNlwJ7O1ZNPwSwYKrgmMwZwRiQC', '$2y$10$4v0a0Iozbib94F4xK00w8.hRHtPN7qXYJjJFdkL3FM1ueCEia2xoO', '2019-09-06 12:02:58', '2019-09-06 12:02:58'),
(39, 9615, 'wq@rich-mail.net', 22, '$2y$10$oSHSZfcvvcY68dyzXHUIieGnaLaHcb9yISAS1SO6aP3ZiGoOjNwUK', '$2y$10$TXlKcJSN1AW6u6wQEOASPuqRB4XiUn.SqWeL4qz24OD8pMIPDT01y', '2019-09-06 12:37:03', '2019-09-06 12:37:03'),
(40, 1334, 'xee@mail-guru.net', 23, '$2y$10$NYst.AkDoU45Zv6PXvdjnONCJF/zY51L2w01C28K260a23THjUww6', '$2y$10$2HqQ.krcRJ0bGqJtlnUnTui4jgxhhr9IhOEmfFF.JrwVd1h695G2W', '2019-09-06 12:41:42', '2019-09-06 12:41:42'),
(41, 1169, 'david@mailinator.com', 24, '$2y$10$mk1KKjXxPk1kxzyciTKc6.c5tXDhoibbGJXTfWY.CkwsymA8hnA1y', '$2y$10$3iUWrvGpcOskzKYJrj90qu0DZn/DRQiq7Y.nHQpORvEMzBDds3q3K', '2019-09-10 13:26:13', '2019-09-10 13:26:13'),
(42, 7489, 'client7@mailinator.com', 25, '$2y$10$5jeALCr.Q7DIXgLYboob2.hXYTiF3YM/41CgG2P7V9.onkprqF4P.', '$2y$10$UGm9ozwQVUk/fpdpwwaSiunry3zehg87JXwT3A/8AecWPyluivyC.', '2019-09-10 13:47:41', '2019-09-10 13:47:41'),
(43, 8772, 'client8@gmail.com', 26, '$2y$10$1Zft63Qw1d2UaRG1X8x6IuiywkxMtH./NK2i.n/o1mC/s1/psz18K', '$2y$10$NHL/ESSzzpnNCoFO98LX0u80PQwdtdqMyfnkoKE2tMExrO7ibbdBG', '2019-09-10 14:08:42', '2019-09-10 14:08:42'),
(44, 8819, 'client7@gmail.com', 27, '$2y$10$ZZAtVJzZYQ8yy1fK5k7TseY1SNQywT3TvsIZQ9jVo9gglM2zcb3We', '$2y$10$3nv44CMw29KZE1ptKZyEs.5uhNNCI4snafmDI6uCPoS03mAzPVpQ.', '2019-09-10 14:10:22', '2019-09-10 14:10:22'),
(45, 5758, 'emailf@tech.net', 28, '$2y$10$EH.jFzEfnlxKhmG40ip1se6ko5uJ1KGKSEHNC679BaEFJ6tCCb2.q', '$2y$10$19FOpaDFh7If3k7FvRx0IufBaF0nH4NGxz1IJ/4FQNaXRDzSpfVF.', '2019-09-10 16:05:03', '2019-09-10 16:05:03'),
(46, 9722, 'emailr@tech.net', 29, '$2y$10$uRAh2O.KD3FErohST3IefuFCnUN.pBVhL.riPCqBV24IrRud2YlT.', '$2y$10$1D29RTyIZFQphZG.Nk9HAOWaOMwtnOb4BCK.EsF5yvcJNSOIyzq8a', '2019-09-10 16:06:16', '2019-09-10 16:06:16'),
(47, 7665, 'emailg@tech.net', 30, '$2y$10$t3sPnG8eCnb1Z0GRezeIuucJ8Q9ahKSdEEfti/wxtlOdr4U4HUS/a', '$2y$10$7xskH3vcOhAW5OQ4Pw4FiuEozc9TU.d8x7oMxnqsJTo6Uv240X6Gm', '2019-09-10 16:06:43', '2019-09-10 16:06:43'),
(48, 4621, 'client10@mailinator.com', 31, '$2y$10$dmxqMg38q./mRyqlL4bVJegzxDh5ViP/0PnY1.DUOmVNrgzmJC24S', '$2y$10$lV86XKhDHr0sKJtOX/hL0.p7KKVwac9m9WJcKMCbr/z.W45rTmE3W', '2019-09-10 16:15:44', '2019-09-10 16:15:44'),
(49, 2781, 'photographer2@gmail.com', 32, '$2y$10$dr0jaogFPKyj1QHD.DFRx.Vcf6XuB0aR9FDXae5Yj2Iv4xTr4itni', '$2y$10$cNgPXep01rDk7tcWA2yGCO33x9mi5qFOw0impZyrPtAjTEW2jWxdi', '2019-09-10 16:55:05', '2019-09-10 16:55:05'),
(50, 7928, 'photographer21@gmail.com', 33, '$2y$10$LmYKZSWxxZdvq0oxTw4te.qiUJWwZHdJjsVHeTUslM5sp8DiZtqwS', '$2y$10$.Kp8rVXKZiOZBU6pWnN/ouRb0ddP4MctItgNFy9XmVaey1cxm8gyW', '2019-09-10 16:56:32', '2019-09-10 16:56:32'),
(51, 1598, 'photographer2e1@gmail.com', 34, '$2y$10$RO18bBrzc1//PpUyZo0ZxOF80DKx5rdzZFNCvh/2lVnVP/9bW8qNK', '$2y$10$XI.F.qpUkdbCAxh3qo0Ly.FY/UvfMmfAmAtbW7XdCqKVdxNaY/RRC', '2019-09-10 16:57:39', '2019-09-10 16:57:39'),
(52, 3468, 'client8@mailinator.com', 35, '$2y$10$DFoBDz2tSl2b7fOWCYDfxeQ.DMM7L6bQb99OfD/yn1ZIwuCXk0s/6', '$2y$10$8CocjhCBxEnX2pI2cTU4Dea/a0ZcNR6kNV4.fd0Y96ZLutvBA0u1S', '2019-09-10 17:00:09', '2019-09-10 17:00:09'),
(53, 1368, 'client88@mailinator.com', 36, '$2y$10$6MWdclUEoG.maCMYay3nh.ciKgKVRFyG1gzeqKCvqMou1I6l4wsiC', '$2y$10$qRrP0Ckp9ZpzxG8R6QAs8.lsozTsfwQmowYjyMPq2ke7zeXqLPasq', '2019-09-10 17:04:55', '2019-09-10 17:04:55'),
(54, 5549, 'client54@mailinator.com', 37, '$2y$10$0T4KJ9uUsKBUr2jlzLSoB.WXo9UV21CsdbfqCgE0oTnP9FVAjxOpO', '$2y$10$KHXXJYQA/Rco7.H/y838hOGjsO8vjWOZmvs7kGcFN7ruyHzkNmM0K', '2019-09-10 17:07:58', '2019-09-10 17:07:58'),
(55, 7213, 'client888@mailinator.com', 38, '$2y$10$cSxSfRaWJyX/ijth/AI7ruxYaRLLQ2c4UvttVNDbkmQZsRocQQENe', '$2y$10$c8ZU/KkiITreTUeqv/DgTeUd/hhwA/We1hkI8O9lQz.8rYN.5ZJLm', '2019-09-10 17:12:49', '2019-09-10 17:12:49'),
(56, 7352, 'client85@mailinator.com', 39, '$2y$10$ycCopYNCSrg1sklVYO.ZJ.aA7bixIyAwF/g90WH5ZBlccommJcvWK', '$2y$10$rYShxDtcv/Pnz7k991UvB.JOfhulGk98BQSdAoCZlpOVd3VKnAf8e', '2019-09-10 17:21:14', '2019-09-10 17:21:14'),
(57, 4851, 'client55@mailinator.com', 40, '$2y$10$kVG6/4aFeeXeAHpw8dA22unedu7k4TqCtTDpyCxDuiki2aQnCzjL6', '$2y$10$WknBHCsbQIXl1XnIbPqy5OJHyi85zbvQ1v9dcFJz3SqRhcxX4RKna', '2019-09-10 17:23:28', '2019-09-10 17:23:28'),
(58, 4106, 'client555@mailinator.com', 41, '$2y$10$/6Bn.MrHzNdGK0lRnGTTCOURa0JlAgpiTS3vkRJymb1xRcx2e0.H.', '$2y$10$mghu0DYYW9Jf32QgSwh.7ebTrXCPyRU2QM7q/ZVBVriEAUg.psuB.', '2019-09-10 17:29:33', '2019-09-10 17:29:33'),
(59, 3168, 'client8855@mailinator.com', 42, '$2y$10$9XvdNyrfx7N2Te7/8dSrjeRxIil3dVM4GdF8p1qqQR2POCRzffO1O', '$2y$10$gDuQuiQ0kKE8plNFkdvBXO7Fue/OdcDdbzUJ4mrUEcKmlyW9ZepNy', '2019-09-10 17:37:58', '2019-09-10 17:37:58'),
(60, 4253, 'client23@mailinator.com', 43, '$2y$10$PApXJ2O5uvHC82Mjp3bup.AKXe0hy1yI8Rr8kU7VevJnBxQ5fE4cO', '$2y$10$wUezXbk5hMLC.k3s3h5S/O8rnv4WJYhh6d6g8ddMpcKALk6OMgUt6', '2019-09-11 08:56:38', '2019-09-11 08:56:38'),
(61, 5234, 'client33@mailinator.com', 44, '$2y$10$AOkca.gerv2T3vqNVh9YpOegb7Cnr17E8lzQQYyJwW8PDlnThzeDK', '$2y$10$d/9kMkfM6sV73NlUPIzRUOTWGwHCFrNzhDnAUrOT8Vcq5Qbx2G0Li', '2019-09-11 09:12:34', '2019-09-11 09:12:34'),
(62, 2604, 'client97@mailinator.com', 45, '$2y$10$6uVG5bZ4v5XbySg0AHbfK.7w8VIuNtK4QIKnrKhWhXLcSgudXOPsG', '$2y$10$pVlO9pMoYNs3T9B.hv63DO6IXUS/1ITdIxPLKzpSswXzRnuQYjknS', '2019-09-11 09:34:35', '2019-09-11 09:34:35'),
(63, 4246, 'client88888@mailinator.com', 46, '$2y$10$SOfQehXj9FNH/tb38rDjoewc8/Z4NpVe4VazfRQXjwZiU82.wN.Fa', '$2y$10$i9rQ4IWY8PmNxJWt/jRNmeLM.j3Sc2Y8e3TclxZ4R/n9/rDGhlvrm', '2019-09-11 09:42:38', '2019-09-11 09:42:38'),
(64, 1621, 'sammy@gmail.com', 47, '$2y$10$hXa.8qxyj4Sf/VigrWji4.vmqdaAe3u2J8BbwuL/BqM2j1O1dLn/W', '$2y$10$I7jJ8m.ZeqQTb2NnO1Iu7OtNSGwTB/eFHRpRPrTYuVatIu20GkLG2', '2019-09-19 09:30:49', '2019-09-19 09:30:49'),
(65, 1180, 'sammyg@gmail.com', 48, '$2y$10$YKJSbQTv7HujlO9KOWoHk.d1E4XWtgU3EPXlKALDGCnEp1NN.7eKS', '$2y$10$vejk9liHMWIpv2ICmnxe/ewyhusEROhBp2pgs6eYqJStEaW2ejmp2', '2019-09-19 09:32:05', '2019-09-19 09:32:05'),
(66, 5987, 'client1999@mailinator.com', 49, '$2y$10$3q2Fq8KzRbQIocDfFUQvuuyVDyM3Zd8SywD9PH432WMPWKEGA4AdO', '$2y$10$txw13XuSINjGrYGsBW5WoOjoy33aSGSOdEDYzWw.DREcQSc0efxRa', '2019-09-19 12:20:23', '2019-09-19 12:20:23'),
(67, 2363, 'client2000@mailinator.com', 50, '$2y$10$5fg1tpnx91PdBaTOnRSs2.HZzrvNwPtQBcOQanSvIFCy/HPp1eL2O', '$2y$10$atrDDmEFRDgKnE9i/UXheePLbTcQq7dPNYmriUsZqmIhTWlp.5yTG', '2019-09-20 23:29:49', '2019-09-20 23:29:49'),
(68, 1749, 'client2001@mailinator.com', 51, '$2y$10$I5AoW2vI13ACGQ3eh5csuugTfZqwm3k4iXTkyz1eraXjhtrilJe9q', '$2y$10$rPbWko12ENjbzTQmJtcW4OeR5NIAEWJTJE5RBMH2IPGJYL6Z2Gwva', '2019-09-20 23:33:12', '2019-09-20 23:33:12'),
(70, 4853, 'client77@mailinator.com', 53, '$2y$10$uJtnkKaeYOZk0HQKAL7uieffph0lJr2Zw54dTUPtqcpO7pEKtGVlS', '$2y$10$P8peAcSet3qqWopcDMWzuuedbRrzss3Clj7vW4ocMw0sRWE3FcA1G', '2019-09-21 01:56:38', '2019-09-21 01:56:38'),
(71, 5703, 'client777@mailinator.com', 54, '$2y$10$XKh9AJrPcTYpx25XztwFbueEXH3ogEJYh73cXfZ00EI/GqUvS008m', '$2y$10$r1Jj0xS3pLFlm5mcgtmsq.qKpr1MhcSZpEQucj6KNtwsZUJ6sPp6a', '2019-09-21 01:59:53', '2019-09-21 01:59:53'),
(72, 7664, 'client7777@mailinator.com', 55, '$2y$10$Nzh5wdefBTuEDNoBq3Bf1u6vWiSlsN8MOGaVoEZEGlIm5H2an1E1q', '$2y$10$32/KCdsUgbS4O9L7lyLuNeJsxq7OdwSqdLY.Ak0PvAFe0qqVTkBFG', '2019-09-21 02:02:30', '2019-09-21 02:02:30'),
(73, 7256, 'client78@gmail.com', 56, '$2y$10$tzThWZeZ4OAnOc2li5r8cOnQZZRN13w0A.xDYPkhqQely5OdLIqey', '$2y$10$EzK0RylqazMlekoaJH210.pB514LsdFS/si4JHt3Y3xvsxowbbCsC', '2019-09-21 02:04:15', '2019-09-21 02:04:15'),
(74, 3791, 'client78@mailinator.com', 57, '$2y$10$jQ5EHtgp0OvVPfcMC6jaEOhY8d/fRg0iQ9PrtAn1GBQJzXeJG9vga', '$2y$10$1okiOlZb85GZRJtl3Wc3heHcXHEfO.9vfdCKVnTzY3YcIMZi9Naim', '2019-09-21 02:05:35', '2019-09-21 02:05:35'),
(75, 7537, 'client419@mailinator.com', 58, '$2y$10$BMEaP/kHUEV3hBarU0qr3.Now/8q2B/PXDM2BOWtc9Z.9.X81g7te', '$2y$10$n90SkNDnHAr37kfzI9QIxOb1SJ8gy8Of8FZqdGeTgCwWUybN3UznO', '2019-09-21 16:43:46', '2019-09-21 16:43:46'),
(76, 7397, 'client123@mailinator.com', 59, '$2y$10$T708iSYzfqcB/lIiECC/3OrYIOweTol.zeqcUb5kaqYyygDZVBCm6', '$2y$10$Blwbrvqv./8h3sDHLSnmbudps1rjNGEXGC7pf3TpcBMjqlsnqCfLm', '2019-09-21 16:50:31', '2019-09-21 16:50:31'),
(77, 8703, 'client4040@gmail.com', 60, '$2y$10$EJxM4utJMiqYbN0x504uI.VpNlOFtUc8E9ME4CCt0mnjil2ucNRES', '$2y$10$tXp8K8VmgHnQQOYBpt61a.j76hWZBoF2gqxsjO5eZlvi9sg3R9zP.', '2019-09-21 16:54:35', '2019-09-21 16:54:35'),
(78, 2050, 'client4040@mailinator.com', 61, '$2y$10$L9Hw5UrfstgPiFwxs3AS4ePEpO/TntoEivmZk8D2TaCsMO4TRyfTO', '$2y$10$SKxKYGatL2P7payIfo2XheB3RVlhAo41rY3Jdt3Hn6Yhx22j0CNqy', '2019-09-21 16:59:55', '2019-09-21 16:59:55'),
(81, 6258, 'client4ever@mailinator.com', 64, '$2y$10$J0ul1ITw3f/MqevWiVbvyenBACj3Afzouay.SGMvFcOq3CJBQDbqi', '$2y$10$XUkXww4zBauduX62Yi7axewvqWskJ2rrnROEGq6Q9ySWjigJ1vXXi', '2019-09-21 17:11:43', '2019-09-21 17:11:43'),
(82, 5242, 'client23456@mailinator.com', 65, '$2y$10$OvumapSzLYMNoi8U0E/RYez8msHHulGG1j0igPTH2inJAQpYfxVHS', '$2y$10$6g8ybXQW68LKlDqCugi9IuAbEPcNloqrCIQWVd2rq9.WQl.9uV4QW', '2019-09-21 17:42:34', '2019-09-21 17:42:34'),
(83, 6241, 'client100@mailinator.com', 66, '$2y$10$a7IS/VebSYh/yaMdd1W/9.ZjAGkGMObuG8XPM1yxbZ17RV.N9WLE6', '$2y$10$dMHMX1CTAKF82yzWzaeG3e33nhhw2/x6bBSEyyvT2KBHsNV451.qW', '2019-09-23 17:04:33', '2019-09-23 17:04:33'),
(84, 7019, 'client7878@mailinator.com', 67, '$2y$10$hL3zaBbuBfOEukcGPPG/zeCmpX/5vrGoNsukEShUrNrL6MrJ3PyHK', '$2y$10$Qsxn2SMkUuTAgoksTvzwzuHrfTt4Bp05xaTlUzrN2A/1bN7lYLgWy', '2019-09-27 08:37:12', '2019-09-27 08:37:12'),
(85, 9485, 'doogal@app.com', 68, '$2y$10$xy2IScdAC3S.EakpH/K6c.6YS0Q6WVXlFZ28OpGOz1D8lzWY8xzkK', '$2y$10$0cdMbNygaK8Ec9gbw5taaet/tFDhUxpmNRQFKmvPB4EjlsnSEsPEG', '2019-10-09 15:03:53', '2019-10-09 15:03:53'),
(86, 8372, 'client22@mailinator.com', 69, '$2y$10$vHFKGHYZwW0YGXCXd6EDLuaDzWVSrYS6rTK.wS6jy2LOAZ1rLZV/.', '$2y$10$a5pcqmCo8DtqhuIjY/iShO.qNWZ8bHaztHZDXSxbF0UMOIHsZSHVi', '2019-10-09 16:02:45', '2019-10-09 16:02:45'),
(87, 7062, 'gake@w6mail.com', 70, '$2y$10$GfqYLY0a2VYFtohtmts.beKfLL0KHWEcJJm0Vwl24/F4JrH4fg4V.', '$2y$10$/NViQrXwLyqwKimc/AjQvuhpoGwT1aiH5qp2Q871tYEbYR2NHT05C', '2019-10-10 07:24:32', '2019-10-10 07:24:32'),
(88, 3622, 'xametilor@appmail.top', 71, '$2y$10$FiyPYxc5/Mrh19mpKA3HT.p9f1nrWwckAFYVkPIKuRa2M1R4V3jeS', '$2y$10$L5kGS0XUCUg88kQZHlJBwu5R8Eu09B6QQ6Ggx47WOPZNXdH1MTcYa', '2019-10-10 07:36:52', '2019-10-10 07:36:52'),
(89, 4405, 'laroj@app-mailer.com', 72, '$2y$10$Tv4sZkG.YAfz1lsD9WGo0uBIEOwTP06aKtbQRe.3fL3oJEyaEyrTG', '$2y$10$.jwjrJ0j5HUGIWg7pJshNOAtGTB5zTw.fXMYrpGWdooybhSl.MTBa', '2019-10-10 07:40:35', '2019-10-10 07:40:35'),
(90, 3518, 'debim@6mail.top', 73, '$2y$10$TUM.UHXEs6evT.I0WnwfFurOEmS5R5L1hAdSpxnMZQ2NmzGtsD10a', '$2y$10$9kRufI8EjNp.gdbu7MEeI.zWbCYiAxBgHDs0pnYOQ9YMAzskZybS2', '2019-10-10 07:47:26', '2019-10-10 07:47:26'),
(91, 7817, 'tracyamara07@gmail.com', 74, '$2y$10$e2bBw29IBrv3NtLV7PVuReHGr1QQ4AEphLySX/pvxZJxoz91ZGCnm', '$2y$10$fZav2TDenmYLb5zBTqmMteGr5YnSwuIwP6pCgcAZNwjA1JcZXYUpi', '2019-10-10 13:01:12', '2019-10-10 13:01:12'),
(92, 4640, 'client99@mailinator.com', 75, '$2y$10$DsSlYazgwNdoFxBHQhNkE.ulWKeGIuDBQBxs6O5dODGUP4.AZHEBS', '$2y$10$XEDbl8tvQiJlbs1WRyzAveY7nH3IyVr00tm7.F.isYMgr82chvLbS', '2019-10-14 14:04:32', '2019-10-14 14:04:32');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `peexoo_calendars`
--

CREATE TABLE `peexoo_calendars` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `start_date` timestamp NOT NULL,
  `end_date` timestamp NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent_object` text COLLATE utf8mb4_unicode_ci,
  `parent_object_id` bigint(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `peexoo_calendars`
--

INSERT INTO `peexoo_calendars` (`id`, `user_id`, `start_date`, `end_date`, `description`, `parent_object`, `parent_object_id`, `created_at`, `updated_at`) VALUES
(1, 3, '2019-06-08 23:00:00', '2019-06-19 23:00:00', 'Touring Kenya', '', 0, '2019-09-06 20:22:43', '2019-09-06 20:22:43'),
(2, 5, '2016-02-28 23:00:00', '2016-02-28 23:00:00', 'Mr Adeola\'s booking', 'BOOKING', 6, '2019-09-13 18:07:45', '2019-09-13 18:07:45');

-- --------------------------------------------------------

--
-- Table structure for table `peexoo_photography_community_models`
--

CREATE TABLE `peexoo_photography_community_models` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `photographers`
--

CREATE TABLE `photographers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `verified` tinyint(1) NOT NULL DEFAULT '0',
  `archived` tinyint(1) NOT NULL DEFAULT '0',
  `about_us` mediumtext COLLATE utf8mb4_unicode_ci,
  `region` text COLLATE utf8mb4_unicode_ci,
  `business_name` text COLLATE utf8mb4_unicode_ci,
  `bvn` text COLLATE utf8mb4_unicode_ci,
  `bvn_meta` text COLLATE utf8mb4_unicode_ci,
  `bvn_verified` tinyint(1) NOT NULL DEFAULT '0',
  `id_card` text COLLATE utf8mb4_unicode_ci,
  `id_card_verified` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `photographers`
--

INSERT INTO `photographers` (`id`, `user_id`, `verified`, `archived`, `about_us`, `region`, `business_name`, `bvn`, `bvn_meta`, `bvn_verified`, `id_card`, `id_card_verified`, `created_at`, `updated_at`) VALUES
(1, 3, 0, 0, NULL, 'abuja', NULL, '22327247720', '', 0, NULL, 0, '2019-08-16 11:16:24', '2019-09-12 10:00:26'),
(2, 25, 0, 0, NULL, NULL, 'Another name', NULL, NULL, 0, 'https://s3.eu-west-1.amazonaws.com/peexoo.useridcards/WIN_20190920_23_04_56_Pro-1569028221053.jpg', 0, '2019-09-10 16:57:33', '2019-09-21 01:54:41'),
(3, 34, 0, 0, NULL, NULL, NULL, NULL, NULL, 0, NULL, 0, '2019-09-10 16:57:42', '2019-09-10 16:57:42'),
(4, 35, 0, 0, NULL, NULL, NULL, NULL, NULL, 0, NULL, 0, '2019-09-10 17:00:17', '2019-09-10 17:00:17'),
(5, 36, 0, 0, NULL, NULL, 'Great looks', NULL, NULL, 0, NULL, 0, '2019-09-10 17:05:07', '2019-09-10 17:05:07'),
(6, 37, 0, 0, NULL, NULL, 'Great looks', NULL, NULL, 0, NULL, 0, '2019-09-10 17:08:04', '2019-09-10 17:08:04'),
(7, 38, 0, 0, NULL, NULL, 'buisness', NULL, NULL, 0, NULL, 0, '2019-09-10 17:14:18', '2019-09-10 17:14:18'),
(8, 39, 0, 0, NULL, NULL, 'buisness', NULL, NULL, 0, NULL, 0, '2019-09-10 17:21:22', '2019-09-10 17:21:22'),
(9, 40, 0, 0, NULL, 'lagos', 'buisness', NULL, NULL, 0, NULL, 0, '2019-09-10 17:23:32', '2019-09-10 17:23:32'),
(10, 41, 0, 0, NULL, NULL, 'buisness', NULL, NULL, 0, NULL, 0, '2019-09-10 17:29:38', '2019-09-10 17:29:38'),
(11, 43, 0, 0, NULL, NULL, 'buisness', NULL, NULL, 0, NULL, 0, '2019-09-11 08:56:46', '2019-09-11 08:56:46'),
(12, 44, 0, 0, NULL, NULL, 'buisness', NULL, NULL, 0, NULL, 0, '2019-09-11 09:12:40', '2019-09-11 09:12:40'),
(13, 45, 0, 0, NULL, NULL, 'buisness', NULL, NULL, 0, NULL, 0, '2019-09-11 09:34:43', '2019-09-11 09:34:43'),
(14, 46, 0, 0, 'svdfbdgffnfmfhmfhmfhmfhmfhmfhmfhfmfhmfhmfmfnfgngndgndgndgndndgnd', NULL, 'tailor', NULL, NULL, 0, 'https://s3.eu-west-1.amazonaws.com/peexoo.useridcards/Asset%252012.png.1568338265226', 0, '2019-09-11 09:42:44', '2019-09-13 00:31:07'),
(15, 49, 0, 0, NULL, NULL, 'Top Class Photography', NULL, NULL, 0, 'https://s3.eu-west-1.amazonaws.com/peexoo.useridcards/photo-camera%2520%282%29.png.1568902359954', 0, '2019-09-19 12:20:39', '2019-09-19 13:12:50'),
(16, 50, 0, 0, NULL, NULL, 'Baba Pixels', NULL, NULL, 0, NULL, 0, '2019-09-20 23:30:00', '2019-09-20 23:30:00'),
(17, 51, 0, 0, NULL, NULL, 'Baba Pixels', NULL, NULL, 0, NULL, 0, '2019-09-20 23:33:20', '2019-09-20 23:33:20'),
(18, 52, 0, 0, NULL, 'onitsha', 'Baba Pixels', NULL, NULL, 0, NULL, 0, '2019-09-20 23:36:18', '2019-09-20 23:36:18'),
(19, 53, 0, 0, NULL, NULL, 'Edisson Shots', NULL, NULL, 0, NULL, 0, '2019-09-21 01:56:42', '2019-09-21 01:56:42'),
(20, 54, 0, 0, NULL, NULL, 'Edisson Shots', NULL, NULL, 0, NULL, 0, '2019-09-21 01:59:57', '2019-09-21 01:59:57'),
(21, 55, 0, 0, NULL, NULL, 'mars', NULL, NULL, 0, NULL, 0, '2019-09-21 02:02:35', '2019-09-21 02:02:35'),
(22, 56, 0, 0, NULL, NULL, 'Wedner', NULL, NULL, 0, NULL, 0, '2019-09-21 02:04:20', '2019-09-21 02:04:20'),
(23, 57, 0, 0, 'This is a sample bio of what should be there', NULL, 'Snap Shots', NULL, NULL, 0, 'https://s3.eu-west-1.amazonaws.com/peexoo.useridcards/WIN_20190920_23_01_00_Pro-1569035695133.jpg', 0, '2019-09-21 02:05:39', '2019-09-21 02:14:54'),
(24, 58, 0, 0, NULL, NULL, 'Business', NULL, NULL, 0, 'https://s3.eu-west-1.amazonaws.com/peexoo.useridcards/Corporate%2520%282%29-1569087940889.jpg', 0, '2019-09-21 16:43:54', '2019-09-21 16:45:43'),
(25, 59, 0, 0, NULL, NULL, 'Tupazz', NULL, NULL, 0, 'https://s3.eu-west-1.amazonaws.com/peexoo.useridcards/Corporate%2520%282%29-1569088321858.jpg', 0, '2019-09-21 16:50:36', '2019-09-21 16:52:04'),
(26, 60, 0, 0, NULL, NULL, 'Tunpez', NULL, NULL, 0, NULL, 0, '2019-09-21 16:54:38', '2019-09-21 16:54:38'),
(27, 61, 0, 0, NULL, NULL, 'Tupez Pics', NULL, NULL, 0, 'https://s3.eu-west-1.amazonaws.com/peexoo.useridcards/Corporate%2520%282%29-1569088859528.jpg', 0, '2019-09-21 16:59:59', '2019-09-21 17:01:02'),
(28, 62, 0, 0, 'Creating pixel perfect images is what we are known for', NULL, 'Pixel Perfect', NULL, NULL, 0, NULL, 0, '2019-09-21 17:07:20', '2019-10-15 11:34:00'),
(29, 63, 0, 0, NULL, NULL, 'Yeba', NULL, NULL, 0, NULL, 0, '2019-09-21 17:09:39', '2019-09-21 17:09:39'),
(30, 64, 0, 0, NULL, NULL, 'client4ever', NULL, NULL, 0, 'https://s3.eu-west-1.amazonaws.com/peexoo.useridcards/bush-girl-1569089706287.jpg', 0, '2019-09-21 17:11:46', '2019-09-21 17:15:07'),
(31, 65, 0, 0, NULL, NULL, 'client', NULL, NULL, 0, NULL, 0, '2019-09-21 17:42:39', '2019-09-21 17:42:39'),
(32, 66, 0, 0, NULL, NULL, 'My bizz', NULL, NULL, 0, NULL, 0, '2019-09-23 17:04:39', '2019-09-23 17:04:39'),
(33, 67, 0, 0, NULL, NULL, 'Pixel Perfect', NULL, NULL, 0, 'https://s3.eu-west-1.amazonaws.com/peexoo.useridcards/Corporate%2520%282%29-1569577684765.jpg', 0, '2019-09-27 08:37:21', '2019-09-27 08:48:12'),
(34, 73, 0, 0, NULL, NULL, 'Bus', NULL, NULL, 0, 'https://s3.eu-west-1.amazonaws.com/peexoo.useridcards/Asset%252012-1570640739214.png', 0, '2019-10-09 16:02:54', '2019-10-09 16:05:39'),
(35, 74, 0, 0, NULL, NULL, 'biz', NULL, NULL, 0, NULL, 0, '2019-10-10 13:01:17', '2019-10-10 13:01:17'),
(36, 75, 0, 0, 'A photography company focused on creating the best images and user experience for all our client. Join us, our years of service in this industry gives us unique insight to the problems our consumers face with getting the best quality pictures on a daily basis', NULL, 'The Bizz', NULL, NULL, 0, NULL, 0, '2019-10-14 14:04:43', '2019-10-14 14:50:28');

-- --------------------------------------------------------

--
-- Table structure for table `photographer_bank_account_details`
--

CREATE TABLE `photographer_bank_account_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `photographer_id` bigint(20) NOT NULL,
  `first_name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `bank_name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `account_number` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `photographer_bank_account_details`
--

INSERT INTO `photographer_bank_account_details` (`id`, `photographer_id`, `first_name`, `last_name`, `bank_name`, `account_number`, `created_at`, `updated_at`) VALUES
(1, 0, 'Oprah', 'Winfrey', 'Providus Bank', '08873737475', '2019-08-08 22:16:40', '2019-08-08 22:16:40'),
(2, 0, 'Oprah', 'Winfrey', 'Providus Bank', '08873737475', '2019-08-08 22:17:57', '2019-08-08 22:17:57'),
(3, 0, 'Oprah', 'Winfrey', 'Providus Bank', '08873737475', '2019-08-08 22:20:06', '2019-08-08 22:20:06'),
(4, 4, 'Oprah', 'Winfrey', 'Providus Bank', '08873737475', '2019-08-08 22:20:56', '2019-08-08 22:20:56'),
(5, 4, 'string', 'string', 'string', 'string', '2019-08-08 22:33:10', '2019-08-08 22:33:10'),
(6, 4, 'MR A', 'DAMS', 'unity bank', '403959566', '2019-08-08 22:36:16', '2019-08-08 22:36:16');

-- --------------------------------------------------------

--
-- Table structure for table `photographer_billing_details`
--

CREATE TABLE `photographer_billing_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `photographer_card_details`
--

CREATE TABLE `photographer_card_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `photographer_id` bigint(20) NOT NULL,
  `first_name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `card_number` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `mmyy` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `cvv` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `auto_charge` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `photographer_card_details`
--

INSERT INTO `photographer_card_details` (`id`, `photographer_id`, `first_name`, `last_name`, `card_number`, `mmyy`, `cvv`, `auto_charge`, `created_at`, `updated_at`) VALUES
(1, 1, 'string', 'string', '2343343455656575', 'string', 'string', 1, '2019-09-07 09:09:25', '2019-09-07 09:09:25');

-- --------------------------------------------------------

--
-- Table structure for table `photographer_cine_types`
--

CREATE TABLE `photographer_cine_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `photographer_id` bigint(20) NOT NULL,
  `type` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `photographer_invoices`
--

CREATE TABLE `photographer_invoices` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `photographer_packages`
--

CREATE TABLE `photographer_packages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `photographerId` bigint(20) NOT NULL,
  `title` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `bookingTypeId` bigint(20) NOT NULL,
  `bookingPrice` double NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `photographer_package_items`
--

CREATE TABLE `photographer_package_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `photographer_package_id` bigint(20) NOT NULL,
  `title` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `photographer_portfolios`
--

CREATE TABLE `photographer_portfolios` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `photographer_portfolio_categories`
--

CREATE TABLE `photographer_portfolio_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_key` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `active` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `photographer_portfolio_categories`
--

INSERT INTO `photographer_portfolio_categories` (`id`, `title`, `category_key`, `active`, `created_at`, `updated_at`) VALUES
(1, 'Profile Cover Image', 'PCI', 1, '2019-09-05 16:48:08', '2019-09-05 16:48:08'),
(2, 'HomePage Slider Image', 'HPSI', 1, '2019-09-05 16:49:04', '2019-09-05 16:49:04');

-- --------------------------------------------------------

--
-- Table structure for table `photographer_portfolio_images`
--

CREATE TABLE `photographer_portfolio_images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `photographer_id` bigint(20) NOT NULL,
  `photographer_portfolio_category_key` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `image_url` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `photographer_portfolio_images`
--

INSERT INTO `photographer_portfolio_images` (`id`, `photographer_id`, `photographer_portfolio_category_key`, `image_url`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 1, 'PCI', 'https://images.pexels.com/photos/248159/pexels-photo-248159.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=100', 1, NULL, NULL),
(2, 1, 'PCI', 'image3.png', 1, '2019-09-19 11:23:46', '2019-09-19 11:23:46'),
(3, 1, 'PCI', 'image1.png', 1, '2019-09-19 11:37:37', '2019-09-19 11:37:37'),
(4, 1, 'PCI', 'image2.jpg', 1, '2019-09-19 11:37:37', '2019-09-19 11:37:37'),
(5, 1, 'PCI', 'image3.png', 1, '2019-09-19 11:37:37', '2019-09-19 11:37:37'),
(6, 1, 'PCI', 'image1.png', 1, '2019-09-19 11:38:04', '2019-09-19 11:38:04'),
(7, 1, 'PCI', 'image2.jpg', 1, '2019-09-19 11:38:04', '2019-09-19 11:38:04'),
(8, 1, 'PCI', 'image3.png', 1, '2019-09-19 11:38:04', '2019-09-19 11:38:04'),
(9, 15, 'PCI', 'https://images.pexels.com/photos/248159/pexels-photo-248159.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=100', 1, '2019-09-20 22:08:04', '2019-09-20 22:08:04'),
(10, 15, 'PCI', 'https://images.pexels.com/photos/248159/pexels-photo-248159.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=100', 1, '2019-09-20 23:11:40', '2019-09-20 23:11:40'),
(11, 15, 'PCI', 'https://s3.eu-west-1.amazonaws.com/peexoo.useridcards/WIN_20190920_23_04_56_Pro-1569025283337.jpg', 1, '2019-09-20 23:21:25', '2019-09-20 23:21:25'),
(12, 2, 'PCI', 'https://s3.eu-west-1.amazonaws.com/peexoo.useridcards/WIN_20190920_23_05_04_Pro-1569028255651.jpg', 1, '2019-09-21 00:10:55', '2019-09-21 00:10:55'),
(13, 2, 'PCI', 'https://s3.eu-west-1.amazonaws.com/peexoo.useridcards/WIN_20190920_23_05_06_Pro-1569030489198.jpg', 1, '2019-09-21 00:48:12', '2019-09-21 00:48:12'),
(14, 2, 'PCI', 'https://s3.eu-west-1.amazonaws.com/peexoo.useridcards/WIN_20190920_23_04_56_Pro-1569030562520.jpg', 1, '2019-09-21 00:49:28', '2019-09-21 00:49:28'),
(15, 2, 'WDNG', 'https://s3.eu-west-1.amazonaws.com/peexoo.useridcards/WIN_20190920_23_05_06_Pro-1569030786948.jpg', 1, '2019-09-21 00:53:11', '2019-09-21 00:53:11'),
(16, 2, 'HPSI', 'https://s3.eu-west-1.amazonaws.com/peexoo.useridcards/WIN_20190920_23_05_06_Pro-1569031024424.jpg', 1, '2019-09-21 00:57:07', '2019-09-21 00:57:07'),
(17, 2, 'HPSI', 'https://s3.eu-west-1.amazonaws.com/peexoo.useridcards/WIN_20190920_23_04_56_Pro-1569031899254.jpg', 1, '2019-09-21 01:11:38', '2019-09-21 01:11:38'),
(18, 2, 'HPSI', 'https://s3.eu-west-1.amazonaws.com/peexoo.useridcards/WIN_20190920_23_00_58_Pro-1569032019064.jpg', 1, '2019-09-21 01:13:38', '2019-09-21 01:13:38'),
(19, 2, 'HPSI', 'https://s3.eu-west-1.amazonaws.com/peexoo.useridcards/WIN_20190920_23_05_06_Pro-1569032085066.jpg', 1, '2019-09-21 01:14:44', '2019-09-21 01:14:44'),
(20, 2, 'HPSI', 'https://s3.eu-west-1.amazonaws.com/peexoo.useridcards/WIN_20190920_23_01_00_Pro-1569032255226.jpg', 1, '2019-09-21 01:17:36', '2019-09-21 01:17:36'),
(21, 2, 'HPSI', 'https://s3.eu-west-1.amazonaws.com/peexoo.useridcards/WIN_20190920_23_05_06_Pro-1569032286921.jpg', 1, '2019-09-21 01:18:05', '2019-09-21 01:18:05'),
(22, 2, 'HPSI', 'https://s3.eu-west-1.amazonaws.com/peexoo.useridcards/WIN_20190920_23_05_06_Pro-1569032308875.jpg', 1, '2019-09-21 01:18:28', '2019-09-21 01:18:28'),
(23, 2, 'HPSI', 'https://s3.eu-west-1.amazonaws.com/peexoo.useridcards/WIN_20190920_23_05_06_Pro-1569032385305.jpg', 1, '2019-09-21 01:19:44', '2019-09-21 01:19:44'),
(24, 2, 'PCI', 'https://s3.eu-west-1.amazonaws.com/peexoo.useridcards/WIN_20190920_23_05_06_Pro-1569032483450.jpg', 1, '2019-09-21 01:21:23', '2019-09-21 01:21:23'),
(25, 2, 'HPSI', 'https://s3.eu-west-1.amazonaws.com/peexoo.useridcards/WIN_20190920_23_01_00_Pro-1569032539257.jpg', 1, '2019-09-21 01:22:18', '2019-09-21 01:22:18'),
(26, 2, 'HPSI', 'https://s3.eu-west-1.amazonaws.com/peexoo.useridcards/WIN_20190920_23_05_06_Pro-1569032652805.jpg', 1, '2019-09-21 01:24:11', '2019-09-21 01:24:11'),
(27, 2, 'HPSI', 'https://s3.eu-west-1.amazonaws.com/peexoo.useridcards/WIN_20190920_23_05_06_Pro-1569032800593.jpg', 1, '2019-09-21 01:26:40', '2019-09-21 01:26:40'),
(28, 2, 'HPSI', 'https://s3.eu-west-1.amazonaws.com/peexoo.useridcards/WIN_20190920_23_00_58_Pro-1569032856009.jpg', 1, '2019-09-21 01:27:35', '2019-09-21 01:27:35'),
(29, 2, 'HPSI', 'https://s3.eu-west-1.amazonaws.com/peexoo.useridcards/WIN_20190920_23_00_58_Pro-1569033123532.jpg', 1, '2019-09-21 01:32:03', '2019-09-21 01:32:03'),
(30, 2, 'PCI', 'https://s3.eu-west-1.amazonaws.com/peexoo.useridcards/WIN_20190920_23_01_00_Pro-1569033142665.jpg', 1, '2019-09-21 01:32:22', '2019-09-21 01:32:22'),
(31, 23, 'PCI', 'https://s3.eu-west-1.amazonaws.com/peexoo.useridcards/WIN_20190920_23_01_00_Pro-1569035601354.jpg', 1, '2019-09-21 02:13:21', '2019-09-21 02:13:21'),
(32, 23, 'HPSI', 'https://s3.eu-west-1.amazonaws.com/peexoo.useridcards/WIN_20190920_23_05_06_Pro-1569035619974.jpg', 1, '2019-09-21 02:13:38', '2019-09-21 02:13:38'),
(33, 23, 'HPSI', 'https://s3.eu-west-1.amazonaws.com/peexoo.useridcards/WIN_20190920_23_01_00_Pro-1569035695133.jpg', 1, '2019-09-21 02:14:55', '2019-09-21 02:14:55'),
(34, 23, 'HPSI', 'https://s3.eu-west-1.amazonaws.com/peexoo.useridcards/WIN_20190920_23_04_56_Pro-1569058168555.jpg', 1, '2019-09-21 08:29:27', '2019-09-21 08:29:27'),
(35, 24, 'HPSI', 'https://s3.eu-west-1.amazonaws.com/peexoo.useridcards/Corporate%2520%282%29-1569087940889.jpg', 1, '2019-09-21 16:45:44', '2019-09-21 16:45:44'),
(36, 25, 'HPSI', 'https://s3.eu-west-1.amazonaws.com/peexoo.useridcards/Corporate%2520%282%29-1569088321858.jpg', 1, '2019-09-21 16:52:05', '2019-09-21 16:52:05'),
(37, 30, 'PCI', 'https://s3.eu-west-1.amazonaws.com/peexoo.useridcards/baby-child-cute-161593-1569090470676.jpg', 1, '2019-09-21 17:27:53', '2019-09-21 17:27:53'),
(38, 31, 'PCI', 'https://s3.eu-west-1.amazonaws.com/peexoo.useridcards/Corporate-1569091563072.jpg', 1, '2019-09-21 17:47:05', '2019-09-21 17:47:05'),
(39, 31, 'HPSI', 'https://s3.eu-west-1.amazonaws.com/peexoo.useridcards/Corporate%2520%282%29-1569092445777.jpg', 1, '2019-09-21 18:00:46', '2019-09-21 18:00:46'),
(40, 32, 'PCI', 'https://s3.eu-west-1.amazonaws.com/peexoo.useridcards/Conceptualization-1569262114226.jpg', 1, '2019-09-23 17:08:47', '2019-09-23 17:08:47'),
(41, 33, 'PCI', 'https://s3.eu-west-1.amazonaws.com/peexoo.useridcards/Landscape-1569577288330.jpg', 1, '2019-09-27 08:45:00', '2019-09-27 08:45:00'),
(42, 33, 'PCI', 'https://s3.eu-west-1.amazonaws.com/peexoo.useridcards/Landscape-1569577378849.jpg', 1, '2019-09-27 08:45:02', '2019-09-27 08:45:02'),
(43, 2, 'EVNT', 'https://s3.eu-west-1.amazonaws.com/peexoo.useridcards/portfolio/baby-child-cute-161593-1569849157966.jpg', 1, '2019-09-30 12:13:08', '2019-09-30 12:13:08'),
(44, 2, 'WDNG', 'https://s3.eu-west-1.amazonaws.com/peexoo.useridcards/portfolio/Conceptualization-1569853134466.jpg', 1, '2019-09-30 13:19:00', '2019-09-30 13:19:00'),
(45, 2, 'PCI', 'https://s3.eu-west-1.amazonaws.com/peexoo.useridcards/Asset%252012-1570110146692.png', 1, '2019-10-03 12:42:33', '2019-10-03 12:42:33'),
(46, 34, 'PCI', 'https://s3.eu-west-1.amazonaws.com/peexoo.useridcards/Asset%252012-1570640637190.png', 1, '2019-10-09 16:04:00', '2019-10-09 16:04:00'),
(47, 34, 'HPSI', 'https://s3.eu-west-1.amazonaws.com/peexoo.useridcards/Asset%252012-1570640655784.png', 1, '2019-10-09 16:04:15', '2019-10-09 16:04:15'),
(48, 34, 'EVNT', 'https://s3.eu-west-1.amazonaws.com/peexoo.useridcards/portfolio/Asset%252012-1570641723615.png', 1, '2019-10-09 16:22:05', '2019-10-09 16:22:05'),
(49, 34, 'RLEST', 'https://s3.eu-west-1.amazonaws.com/peexoo.useridcards/portfolio/Conceptualization-1570641819628.jpg', 1, '2019-10-09 16:23:50', '2019-10-09 16:23:50'),
(50, 34, 'RLEST', 'https://s3.eu-west-1.amazonaws.com/peexoo.useridcards/portfolio/MARYLAND-LW-1570642535185.jpg', 1, '2019-10-09 16:35:38', '2019-10-09 16:35:38'),
(51, 28, 'POTR', 'https://s3.eu-west-1.amazonaws.com/peexoo.useridcards/portfolio/Portrait-1571142904528.jpg', 1, '2019-10-15 11:35:01', '2019-10-15 11:35:01'),
(52, 28, 'LNDS', 'https://s3.eu-west-1.amazonaws.com/peexoo.useridcards/portfolio/parents-and-two-daughters-in-family-room-1571143517320.jpg', 1, '2019-10-15 11:45:18', '2019-10-15 11:45:18'),
(53, 28, 'HPSI', 'https://s3.eu-west-1.amazonaws.com/peexoo.useridcards/Conceptualization-1571145006612.jpg', 1, '2019-10-15 12:10:05', '2019-10-15 12:10:05');

-- --------------------------------------------------------

--
-- Table structure for table `photographer_profile_images`
--

CREATE TABLE `photographer_profile_images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `photographer_id` bigint(20) NOT NULL,
  `image_url` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `image_section` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `subscriptionplans`
--

CREATE TABLE `subscriptionplans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `details` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `fee` double NOT NULL,
  `duration` int(11) NOT NULL,
  `is_recurring` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `subscriptionplans`
--

INSERT INTO `subscriptionplans` (`id`, `title`, `details`, `fee`, `duration`, `is_recurring`, `created_at`, `updated_at`) VALUES
(1, 'Pexxo Memories for 12 months', 'Payment plan for Peexoo memories', 5000, 100, 1, '2019-08-22 21:03:56', '2019-08-22 21:04:00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tel_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `profile_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified` tinyint(1) NOT NULL DEFAULT '0',
  `archived` tinyint(1) NOT NULL DEFAULT '0',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `last_name`, `first_name`, `email`, `tel_number`, `profile_image`, `email_verified`, `archived`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, NULL, NULL, 'wakumapupe@top-mails.net', 'string', 'string', 0, 0, NULL, '$2y$10$LZLWnpklTMkDGrM.R7/5nu0uPwlX5wHuq4VzhCviPuPLeGzjUISTy', NULL, '2019-08-16 09:44:50', '2019-08-16 09:44:50'),
(2, 'Dokun', 'Ire', 'ire@vimail24.com', NULL, NULL, 0, 0, NULL, '$2y$10$QYCeK8G49Qso8bZkqOdpyuTVBOtKvqnKlxKO0GaJveYEAqh31LCSG', NULL, '2019-08-16 09:51:42', '2019-08-16 09:51:42'),
(3, 'Nwadike', 'Ire', 'irene@vimail24.com', NULL, NULL, 0, 0, NULL, '$2y$10$UojAoZAJhLWMe/YNZwJkyuyFajTcU35J.kDhUvqpRefzPrXYBgqgy', NULL, '2019-08-16 09:53:27', '2019-08-16 09:53:27'),
(4, 'ade', 'Ire', 'res@vimail24.com', NULL, NULL, 0, 0, NULL, '$2y$10$D1OM6N619RmMgbeFVo0drOyqVY8TfmKJtMh0djmbvuXIdfRv8FPIm', NULL, '2019-08-16 11:21:16', '2019-08-16 11:21:16'),
(5, 'from', 'weed', 'weed@vimail24.com', NULL, NULL, 1, 0, NULL, '$2y$10$99LuDbI7wZAXCGEN0bNpUeZ/8woeplWoC4.j6HVguQH0ZGljtWZLK', NULL, '2019-08-16 11:26:47', '2019-08-16 11:27:46'),
(6, 'Awsa', 'wea', 'weeda@vimail24.com', NULL, NULL, 1, 0, NULL, '$2y$10$Q8CVOjbTOjnmgAwTcEaBk.vnIIUGd9Dgc3eF/LBv0fMOCIyYb.S3O', NULL, '2019-08-16 11:31:11', '2019-08-16 11:31:58'),
(7, 'Creat', 'Jeremiah', 'celo@mailfile.net', NULL, NULL, 0, 0, NULL, '$2y$10$zTajLLHIJ/uKtffqCfx5B./J2wS/cvFzpeUe8TqYjdwRfr8OJzzte', NULL, '2019-09-05 13:36:48', '2019-09-05 13:36:48'),
(8, 'Creats', 'Jeremiah', 'jas@rich-mail.net', NULL, NULL, 0, 0, NULL, '$2y$10$uhavIPg68wIEE24anPZzS.PkZjWwvAGDXZ0JALA5IQMf4btwI.ww2', NULL, '2019-09-05 13:38:30', '2019-09-05 13:38:30'),
(9, 'string', 'string', 'jecil@mail-line.net', 'string', 'string', 0, 0, NULL, '$2y$10$s/adGBFpYjanARM2IejCf.xtceubGmMIp5zL4zh16nAsQ5OSP9nfW', NULL, '2019-09-05 14:10:21', '2019-09-05 14:10:21'),
(10, 'string', 'string', 'jecil@mail-line.nete', 'string', 'string', 0, 0, NULL, '$2y$10$N0IQ8VrdqLVH/XrlwZzODuTYWjd.087wqgAnaa/tcZ7Xai0nLwYDa', NULL, '2019-09-05 14:13:04', '2019-09-05 14:13:04'),
(11, 'string', 'string', 'jecil@mail-line.netge', 'string', 'string', 0, 0, NULL, '$2y$10$QbsSJiGeMCfsF4mAz730NeYOC0QT7CBeynHATgLf8XfLWEejpDuIi', NULL, '2019-09-05 14:13:42', '2019-09-05 14:13:42'),
(12, 'mine', 'Jas', 'jasf@rich-mail.net', NULL, NULL, 0, 0, NULL, '$2y$10$Wfx2/Bj16sAR6TuL7Fb37uTIEYc866zRIoUhrid05dzXu56JtGV2W', NULL, '2019-09-06 09:50:10', '2019-09-06 09:50:10'),
(13, 'DA', 'Se', 'godix@mail-desk.net', NULL, NULL, 0, 0, NULL, '$2y$10$EBg1GOrOdbuSGnSM4UbLWOKfh7Zg.SI2Nr06gysRMWq6K8IiVS.X6', NULL, '2019-09-06 10:00:50', '2019-09-06 10:00:50'),
(14, 'Eli', 'Ja', 'jasm@drmail.net', NULL, NULL, 0, 0, NULL, '$2y$10$F/SHrk7BdaAC25/a/xZWtO8Dp73EDxkToE/tTiGRQ7lDjt03YwQXm', NULL, '2019-09-06 10:14:08', '2019-09-06 10:14:08'),
(15, 'Mw', 'Me', 'jas@mail-guru.net', NULL, NULL, 0, 0, NULL, '$2y$10$k3suYz/CKJFNtet3y7Of/.IceJW/1i8o/srgdox0x.4P7dd5Xu9XC', NULL, '2019-09-06 10:20:38', '2019-09-06 10:20:38'),
(16, 'ch', 'Mt', 'mtch@mail-desk.net', NULL, NULL, 0, 0, NULL, '$2y$10$J2u.FaDlsaLVnD6WmoAE5OJZKyJsurd10pwv29loPc5F2sh.6P2C.', NULL, '2019-09-06 10:26:51', '2019-09-06 10:26:51'),
(17, 'W', 'ERE', 'mich@mail-desk.net', NULL, NULL, 0, 0, NULL, '$2y$10$Xr3edn084nZ.3BqxW2nPyebWv4iUM6BQ7yZx8uIcM4Ka9kA8pClla', NULL, '2019-09-06 10:42:34', '2019-09-06 10:42:34'),
(18, 'string', 'string', 'dumab@dd.com', 'string', 'string', 0, 0, NULL, '$2y$10$PRZlT4Jl/6tpmCLvmT4iWOhsVDuK7jG1QI.F5G5TA74YvLjD3Josq', NULL, '2019-09-06 12:01:16', '2019-09-06 12:01:16'),
(19, 'string', 'string', 'dumaib@dd.com', 'string', 'string', 0, 0, NULL, '$2y$10$.RsnxZfXQYUaYojv0/Nw0OI8SnEVd6g9y6SofEv70nrQP3fn1nqGu', NULL, '2019-09-06 12:02:58', '2019-09-06 12:02:58'),
(20, 'string', 'string', 'dumaikb@dd.com', 'string', 'string', 0, 0, NULL, '$2y$10$YC8.mY0HhiyGGHJ85.lsaOFirCatgCRNTcBu3Rsi9JzBwfBsR64Iq', NULL, '2019-09-06 12:03:53', '2019-09-06 12:03:53'),
(21, 'Ref', 'dere', 'dere@mail-guru.net', NULL, NULL, 0, 0, NULL, '$2y$10$3nj.frM5VuBBFerqrQ9ZVeiPx2dwraNE4z83X54f4CU56WchYokju', NULL, '2019-09-06 12:31:41', '2019-09-06 12:31:41'),
(22, 'poo', 'SHam', 'wq@rich-mail.net', NULL, NULL, 1, 0, NULL, '$2y$10$NKbK/f2y6Fxz5wRmgsFYh.KQl59WmYdVU9KmrxWHKG.MiAceCtao6', NULL, '2019-09-06 12:37:03', '2019-09-06 12:38:32'),
(23, 'zxe', 'Se', 'xee@mail-guru.net', NULL, NULL, 1, 0, NULL, '$2y$10$AYi37VNL4omPWbKUN/m7teGcS8.YsSKrflnS5qWzCL/HE5/7zVrG.', NULL, '2019-09-06 12:41:42', '2019-09-06 12:42:19'),
(24, 'Ademola-Adeoye', 'David', 'david@mailinator.com', NULL, NULL, 0, 0, NULL, '$2y$10$dAGZ6ufXCsXPyB6UjpKzaenSh0kMRp9EIZ6xer6o3BlfU8.RtlZyO', NULL, '2019-09-10 13:26:12', '2019-09-10 13:26:12'),
(25, 'Ademola-Adeoye', 'David', 'client7@mailinator.com', NULL, 'https://s3.eu-west-1.amazonaws.com/peexoo.useridcards/WIN_20190920_23_05_00_Pro-1569028240343.jpg', 0, 0, NULL, '$2y$10$wHDUQcx/ZnRLPsrk2JtNCeW.UgwRdzIIxrHVw8dYgypep5W8wq5FW', NULL, '2019-09-10 13:47:41', '2019-09-21 00:10:40'),
(26, 'Adeoye', 'David', 'client8@gmail.com', NULL, NULL, 0, 0, NULL, '$2y$10$UStxxv7tIFS81KgmRx9JpuvlCvK7e9g2LN1MmevXH0NBXChA94kSW', NULL, '2019-09-10 14:08:42', '2019-09-10 14:08:42'),
(27, NULL, NULL, 'client7@gmail.com', NULL, NULL, 0, 0, NULL, '$2y$10$loqOuejA8FhorjPbttKXQ.K.z.GO3AuTEN/9FeKKbhKsSR1QEm.EW', NULL, '2019-09-10 14:10:22', '2019-09-10 14:10:22'),
(28, 'Abel', 'Mike', 'emailf@tech.net', 'string', 'string', 0, 0, NULL, '$2y$10$8kOTeeORqbTyAJuRotOEYu46ZKRTDEwQKIGLrbNdeQjhnJo/j9gCS', NULL, '2019-09-10 16:05:02', '2019-09-10 16:05:02'),
(29, 'Abel', 'Mike', 'emailr@tech.net', 'string', 'string', 0, 0, NULL, '$2y$10$b7nz8pFSHna4VSUq6ZAjxe0wEWWgpQoTiDGTll6BnVcNs/kfqN9DO', NULL, '2019-09-10 16:06:15', '2019-09-10 16:06:15'),
(30, 'Abel', 'Mike', 'emailg@tech.net', 'string', 'string', 0, 0, NULL, '$2y$10$M35enj/cckO1ByRf13a/heoG8aXH1qy5lUAShsUfq86HO1OPGEJNm', NULL, '2019-09-10 16:06:43', '2019-09-10 16:06:43'),
(31, 'Adeoye', 'David', 'client10@mailinator.com', NULL, NULL, 0, 0, NULL, '$2y$10$bZ.hQymTjongRgvRm.zzPOEK2MmLsbtwBjkOmfUTIiY4zjYMwg2nG', NULL, '2019-09-10 16:15:43', '2019-09-10 16:15:43'),
(32, 'Photographer', 'Joe', 'photographer2@gmail.com', 'string', 'string', 0, 0, NULL, '$2y$10$7FEFe54UVkT5Ze5ZFzHenOXBPOnNvV080WO6RYF5qt2FZm1UDGHLK', NULL, '2019-09-10 16:55:04', '2019-09-10 16:55:04'),
(33, 'Photographer', 'Joe', 'photographer21@gmail.com', 'string', 'string', 0, 0, NULL, '$2y$10$UXkzAaBM9at4jXk9DR8T0urav6SirdXMMKvmveLvvGn6p/oF.mar.', NULL, '2019-09-10 16:56:31', '2019-09-10 16:56:31'),
(34, 'Photographer', 'Joe', 'photographer2e1@gmail.com', 'string', 'string', 0, 0, NULL, '$2y$10$AUWgWPkIPGmH3zN95N1RCefAsZZGDwJGs3UM1bVCR.bs4/iPJTo3a', NULL, '2019-09-10 16:57:38', '2019-09-10 16:57:38'),
(52, 'Babalola', 'Jones', 'client2001@mailinator.com', NULL, NULL, 0, 0, NULL, '$2y$10$WUvX3i.8.FdpEdv4QNrcceZ2pGlOXCQAWlPK7KBVqp9jJjG5h.70u', NULL, '2019-09-20 23:36:17', '2019-09-20 23:36:17'),
(53, 'Edisson', 'Thomas', 'client77@mailinator.com', NULL, NULL, 0, 0, NULL, '$2y$10$IqbMj47TRBodJ7ZtrsmSH.tJVumptadASTkcPf3jJKNyPzD2SAAcO', NULL, '2019-09-21 01:56:37', '2019-09-21 01:56:37'),
(54, 'Edisson', 'Thomas', 'client777@mailinator.com', NULL, NULL, 0, 0, NULL, '$2y$10$9si6NOtzfJEDo.qLFSx4Neue7IXi3iZT/NvHtPU9wQFCRRO7scKq2', NULL, '2019-09-21 01:59:52', '2019-09-21 01:59:52'),
(55, 'Coal', 'Elijah', 'client7777@mailinator.com', NULL, NULL, 0, 0, NULL, '$2y$10$4gJUyeHJH7Ti4mRbdyqH6eW7m1SiF3lGZkfrya0zk0VKLVxwZZfgq', NULL, '2019-09-21 02:02:30', '2019-09-21 02:02:30'),
(56, 'las', '1egbon', 'client78@gmail.com', NULL, NULL, 0, 0, NULL, '$2y$10$0P5lGFH8PoJF95I3WN.y3eC8kRsu7Xkru7v6E2e6CE1Yd7/p7INA.', NULL, '2019-09-21 02:04:15', '2019-09-21 02:04:15'),
(57, 'Emmanuel', 'Elijah', 'client78@mailinator.com', NULL, 'https://s3.eu-west-1.amazonaws.com/peexoo.useridcards/WIN_20190920_23_05_06_Pro-1569035263179.jpg', 1, 0, NULL, '$2y$10$K7p63D20zZGViIGhuiI7uu6uJLsIkmbwPlkK7BNTi2MxgNJCHX5nq', NULL, '2019-09-21 02:05:34', '2019-09-21 02:07:43'),
(58, 'Guy', 'Photo', 'client419@mailinator.com', NULL, 'https://s3.eu-west-1.amazonaws.com/peexoo.useridcards/Corporate-1569087961865.jpg', 1, 0, NULL, '$2y$10$TRroLoEnunI3phEu5ZyfSe7RtRqWCM8eRfL41bxaE2CTRjlICHcOi', NULL, '2019-09-21 16:43:44', '2019-09-21 16:46:01'),
(59, 'Akinola', 'Tunde', 'client123@mailinator.com', NULL, NULL, 1, 0, NULL, '$2y$10$tjSezVl5mdC1Tev6is/DfeRoGRQ/mbiehQnuDZnxJHThAv4fwAQqW', NULL, '2019-09-21 16:50:31', '2019-09-21 16:51:10'),
(60, 'Akinola', 'Tundez', 'client4040@gmail.com', NULL, NULL, 0, 0, NULL, '$2y$10$0ydkZoQcBXI7Nz0EfNsNAe5ixxUF7AOHCaeX2BgTVXbCxK2bUmdm.', NULL, '2019-09-21 16:54:35', '2019-09-21 16:54:35'),
(61, 'Opaz', 'Tundez', 'client4040@mailinator.com', NULL, 'https://s3.eu-west-1.amazonaws.com/peexoo.useridcards/Conceptualization-1569088882624.jpg', 1, 0, NULL, '$2y$10$2BI9iIz0nNl0LKnDItss1O9bYGBCxcmmKJk7G4Etjp3dviBV0WJme', NULL, '2019-09-21 16:59:55', '2019-09-21 17:01:22'),
(62, 'Kunke', 'Elijah', 'client88@mailinator.com', NULL, 'https://s3.eu-west-1.amazonaws.com/peexoo.useridcards/WIN_20190920_23_05_00_Pro-1571135131287.jpg', 0, 0, NULL, '$2y$10$G2JhbhHLuvBcMFZ8IjmmwesIMHueAfAaM3.fdaRm555PYefxBAmmu', NULL, '2019-09-21 17:07:19', '2019-10-15 09:25:32'),
(63, 'Adeoye', 'Dave', 'client85@mailinator.com', NULL, NULL, 0, 0, NULL, '$2y$10$kNEi648UzhzyiN/OERraY.1KTEK3oO340BA5njic2eZEPQeDRaaka', NULL, '2019-09-21 17:09:38', '2019-09-21 17:09:38'),
(64, 'One', 'Another', 'client4ever@mailinator.com', NULL, 'https://s3.eu-west-1.amazonaws.com/peexoo.useridcards/Portrait-1569089727661.jpg', 1, 0, NULL, '$2y$10$MojiXRtDL/5bg8/B1E181.0lHdQMIkTzOYiSty32W0GBk6b/SkxZS', NULL, '2019-09-21 17:11:43', '2019-09-21 17:15:27'),
(65, 'Toba', 'Elijah', 'client23456@mailinator.com', NULL, 'https://s3.eu-west-1.amazonaws.com/peexoo.useridcards/Corporate-1569092140632.jpg', 1, 0, NULL, '$2y$10$BOe.fb8tEdxy/tCdlQnV2O2twyZA./lCfnlc6ko7.3gd0EFtQxVe.', NULL, '2019-09-21 17:42:34', '2019-09-21 17:55:42'),
(66, 'Adeoye', 'David', 'client100@mailinator.com', NULL, NULL, 0, 0, NULL, '$2y$10$S3SqVcbXfuWj5wrPLkCs8.Ru2l4yrcGErfEZ4B7yUKitad2Y6XKHi', NULL, '2019-09-23 17:04:32', '2019-09-23 17:04:32'),
(67, 'Abayomi', 'John', 'client7878@mailinator.com', NULL, 'https://s3.eu-west-1.amazonaws.com/peexoo.useridcards/Conceptualization-1569577252736.jpg', 1, 0, NULL, '$2y$10$kayEUPhwl1p71sVVhibW8ePh/oYwNNZK7HgK0Nn9Zy0vSr24.yuji', NULL, '2019-09-27 08:37:11', '2019-09-27 08:41:09'),
(68, 'string', 'string', 'doogal@app.com', 'string', 'string', 0, 0, NULL, '$2y$10$xhflRh9WtHjhl5tS1H/PouQH/i8gMFqEhLqoF8EJ6u.a2xe6yj/Mi', NULL, '2019-10-09 15:03:51', '2019-10-09 15:03:51'),
(69, 'Adeoye', 'David', 'client22@mailinator.com', NULL, 'https://s3.eu-west-1.amazonaws.com/peexoo.useridcards/Asset%252012-1570640671481.png', 1, 0, NULL, '$2y$10$oOyjXEPyo7yMa83s2.yL3uNTmuAjoX.UCzUAZGFGW7qewsErYTGWu', NULL, '2019-10-09 16:02:45', '2019-10-09 16:04:32'),
(70, 'string', 'string', 'gake@w6mail.com', 'string', 'string', 0, 0, NULL, '$2y$10$TH0qD8kpcPLdMVVkh8vpD.m9rPJ95GEnIkVoJ5OKF4Z/XypnUX05u', NULL, '2019-10-10 07:24:31', '2019-10-10 07:24:31'),
(71, 'string', 'string', 'xametilor@appmail.top', 'string', 'string', 0, 0, NULL, '$2y$10$5K3LbECLT5zlsj1jX4y3P.aj1y3fX9vhjnRtk1kquu29EGOiCp32K', NULL, '2019-10-10 07:36:52', '2019-10-10 07:36:52'),
(72, 'string', 'string', 'laroj@app-mailer.com', 'string', 'string', 0, 0, NULL, '$2y$10$3v/z5InHMP5XFdSUao/B.uM5Ppjhm392oKwXiprEYoigNLmhN6GW.', NULL, '2019-10-10 07:40:35', '2019-10-10 07:40:35'),
(73, 'string', 'string', 'debim@6mail.top', 'string', 'string', 0, 0, NULL, '$2y$10$KuuQfIhvn96ZiOudEygM6emawv8M4XXJZB5Xv9tg6ZIVng.xAZ4zi', NULL, '2019-10-10 07:47:26', '2019-10-10 07:47:26'),
(74, 'Amy', 'Anele', 'tracyamara07@gmail.com', NULL, NULL, 1, 0, NULL, '$2y$10$fgXMoHfwecWdLwXFXqDySunU000QggAmJPH27qY/7sF6iyTHVXIMO', NULL, '2019-10-10 13:01:11', '2019-10-10 13:15:05'),
(75, 'Adeoye', 'David', 'client99@mailinator.com', NULL, NULL, 1, 0, NULL, '$2y$10$8H2CyjOpbZAjlyBACsVrRunX6JUbfhiiAgu1F4ZoxUrTcKAcHYh06', NULL, '2019-10-14 14:04:31', '2019-10-14 14:05:39');

-- --------------------------------------------------------

--
-- Table structure for table `user_notification_settings`
--

CREATE TABLE `user_notification_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_payments`
--

CREATE TABLE `user_payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `title` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` double NOT NULL,
  `eloquent_model` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment_date` datetime DEFAULT NULL,
  `object_id` bigint(20) DEFAULT NULL,
  `object` longtext COLLATE utf8mb4_unicode_ci,
  `meta` longtext COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_payments`
--

INSERT INTO `user_payments` (`id`, `user_id`, `title`, `type`, `amount`, `eloquent_model`, `payment_date`, `object_id`, `object`, `meta`, `created_at`, `updated_at`) VALUES
(12, 1, 'Payment for Booking (Alt photoshoot)', 'SUBSCRIPTION', 5000, 'BOOKINGS', NULL, 1, '{\"id\":1,\"title\":\"Pexxo Memories for 12 months\",\"details\":\"Payment plan for Peexoo memories\",\"fee\":5000,\"duration\":100,\"is_recurring\":1,\"created_at\":\"2019-08-22 22:03:56\",\"updated_at\":\"2019-08-22 22:04:00\"}', '{\n  \"status\": true,\n  \"message\": \"Authorization URL created\",\n  \"data\": {\n    \"authorization_url\": \"https://checkout.paystack.com/p7w7g0g6xr5xyei\",\n    \"access_code\": \"p7w7g0g6xr5xyei\",\n    \"reference\": \"hk3znyjy36\"\n  }\n}', '2019-08-23 06:44:20', '2019-08-23 06:44:20'),
(13, 1, 'Payment for Pexxo Memories for 12 months subscription', 'SUBSCRIPTION', 5000, '', NULL, 1, '{\"id\":1,\"title\":\"Pexxo Memories for 12 months\",\"details\":\"Payment plan for Peexoo memories\",\"fee\":5000,\"duration\":100,\"is_recurring\":1,\"created_at\":\"2019-08-22 22:03:56\",\"updated_at\":\"2019-08-22 22:04:00\"}', '{\n  \"status\": true,\n  \"message\": \"Authorization URL created\",\n  \"data\": {\n    \"authorization_url\": \"https://checkout.paystack.com/xg8jansw5e58xf5\",\n    \"access_code\": \"xg8jansw5e58xf5\",\n    \"reference\": \"mrp08ltxxw\"\n  }\n}', '2019-08-23 06:53:15', '2019-08-23 06:53:15'),
(14, 1, 'Payment for Pexxo Memories for 12 months subscription', 'SUBSCRIPTION', 5000, '', NULL, 1, '{\"id\":1,\"title\":\"Pexxo Memories for 12 months\",\"details\":\"Payment plan for Peexoo memories\",\"fee\":5000,\"duration\":100,\"is_recurring\":1,\"created_at\":\"2019-08-22 22:03:56\",\"updated_at\":\"2019-08-22 22:04:00\"}', '{\n  \"status\": true,\n  \"message\": \"Authorization URL created\",\n  \"data\": {\n    \"authorization_url\": \"https://checkout.paystack.com/3bu2vhtq4k3nnfh\",\n    \"access_code\": \"3bu2vhtq4k3nnfh\",\n    \"reference\": \"d8j759ng8l\"\n  }\n}', '2019-08-23 06:56:19', '2019-08-23 06:56:19'),
(15, 1, 'Payment for Pexxo Memories for 12 months subscription', 'SUBSCRIPTION', 5000, '', NULL, 1, '{\"id\":1,\"title\":\"Pexxo Memories for 12 months\",\"details\":\"Payment plan for Peexoo memories\",\"fee\":5000,\"duration\":100,\"is_recurring\":1,\"created_at\":\"2019-08-22 22:03:56\",\"updated_at\":\"2019-08-22 22:04:00\"}', '{\n  \"status\": true,\n  \"message\": \"Authorization URL created\",\n  \"data\": {\n    \"authorization_url\": \"https://checkout.paystack.com/bj0fy6y9f9mia3e\",\n    \"access_code\": \"bj0fy6y9f9mia3e\",\n    \"reference\": \"4cz5pwrssw\"\n  }\n}', '2019-08-23 06:56:35', '2019-08-23 06:56:35'),
(16, 1, 'Payment for Pexxo Memories for 12 months subscription', 'SUBSCRIPTION', 5000, '', NULL, 1, '{\"id\":1,\"title\":\"Pexxo Memories for 12 months\",\"details\":\"Payment plan for Peexoo memories\",\"fee\":5000,\"duration\":100,\"is_recurring\":1,\"created_at\":\"2019-08-22 22:03:56\",\"updated_at\":\"2019-08-22 22:04:00\"}', '{\n  \"status\": true,\n  \"message\": \"Authorization URL created\",\n  \"data\": {\n    \"authorization_url\": \"https://checkout.paystack.com/goc84p4m8mzng7s\",\n    \"access_code\": \"goc84p4m8mzng7s\",\n    \"reference\": \"vio6g1byuf\"\n  }\n}', '2019-08-23 06:58:10', '2019-08-23 06:58:10'),
(17, 1, 'Payment for Pexxo Memories for 12 months subscription', 'SUBSCRIPTION', 5000, '', NULL, 1, '{\"id\":1,\"title\":\"Pexxo Memories for 12 months\",\"details\":\"Payment plan for Peexoo memories\",\"fee\":5000,\"duration\":100,\"is_recurring\":1,\"created_at\":\"2019-08-22 22:03:56\",\"updated_at\":\"2019-08-22 22:04:00\"}', '{\n  \"status\": true,\n  \"message\": \"Authorization URL created\",\n  \"data\": {\n    \"authorization_url\": \"https://checkout.paystack.com/navhaycsgrcozyd\",\n    \"access_code\": \"navhaycsgrcozyd\",\n    \"reference\": \"p2j9w2uj6e\"\n  }\n}', '2019-08-23 07:13:13', '2019-08-23 07:13:13'),
(18, 1, 'Payment for Pexxo Memories for 12 months subscription', 'SUBSCRIPTION', 5000, '', NULL, 1, '{\"id\":1,\"title\":\"Pexxo Memories for 12 months\",\"details\":\"Payment plan for Peexoo memories\",\"fee\":5000,\"duration\":100,\"is_recurring\":1,\"created_at\":\"2019-08-22 22:03:56\",\"updated_at\":\"2019-08-22 22:04:00\"}', '{\n  \"status\": true,\n  \"message\": \"Authorization URL created\",\n  \"data\": {\n    \"authorization_url\": \"https://checkout.paystack.com/8thbr3ui4it1ur8\",\n    \"access_code\": \"8thbr3ui4it1ur8\",\n    \"reference\": \"up3y8v5pvs\"\n  }\n}', '2019-08-23 07:39:43', '2019-08-23 07:39:43'),
(19, 1, 'Payment for Pexxo Memories for 12 months subscription', 'SUBSCRIPTION', 5000, '', NULL, 1, '{\"id\":1,\"title\":\"Pexxo Memories for 12 months\",\"details\":\"Payment plan for Peexoo memories\",\"fee\":5000,\"duration\":100,\"is_recurring\":1,\"created_at\":\"2019-08-22 22:03:56\",\"updated_at\":\"2019-08-22 22:04:00\"}', NULL, '2019-08-23 07:40:33', '2019-08-23 07:40:33'),
(20, 5, 'Payment for Booking Mr Adeola\'s booking', 'BOOKING', 0, 'BOOKING', NULL, 6, 'BOOKING', NULL, '2019-09-13 18:07:45', '2019-09-13 18:07:45');

-- --------------------------------------------------------

--
-- Table structure for table `user_payment_installments`
--

CREATE TABLE `user_payment_installments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `userpayment_id` bigint(20) NOT NULL,
  `amount` double NOT NULL,
  `payment_object` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment_response` longtext COLLATE utf8mb4_unicode_ci,
  `gateway` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_payment_installments`
--

INSERT INTO `user_payment_installments` (`id`, `userpayment_id`, `amount`, `payment_object`, `payment_response`, `gateway`, `created_at`, `updated_at`) VALUES
(1, 12, 5000, '{\n  \"status\": true,\n  \"message\": \"Authorization URL created\",\n  \"data\": {\n    \"authorization_url\": \"https://checkout.paystack.com/xg8jansw5e58xf5\",\n    \"access_code\": \"xg8jansw5e58xf5\",\n    \"reference\": \"mrp08ltxxw\"\n  }\n}', NULL, 'PAYSTACK', '2019-08-23 06:53:16', '2019-08-23 06:53:16'),
(2, 14, 5000, '\"{\\n  \\\"status\\\": true,\\n  \\\"message\\\": \\\"Authorization URL created\\\",\\n  \\\"data\\\": {\\n    \\\"authorization_url\\\": \\\"https:\\/\\/checkout.paystack.com\\/3bu2vhtq4k3nnfh\\\",\\n    \\\"access_code\\\": \\\"3bu2vhtq4k3nnfh\\\",\\n    \\\"reference\\\": \\\"d8j759ng8l\\\"\\n  }\\n}\"', NULL, 'PAYSTACK', '2019-08-23 06:56:19', '2019-08-23 06:56:19'),
(3, 12, 5000, '{\n  \"status\": true,\n  \"message\": \"Authorization URL created\",\n  \"data\": {\n    \"authorization_url\": \"https://checkout.paystack.com/goc84p4m8mzng7s\",\n    \"access_code\": \"goc84p4m8mzng7s\",\n    \"reference\": \"vio6g1byuf\"\n  }\n}', NULL, 'PAYSTACK', '2019-08-23 06:58:10', '2019-08-23 06:58:10'),
(4, 17, 5000, '{\n  \"status\": true,\n  \"message\": \"Authorization URL created\",\n  \"data\": {\n    \"authorization_url\": \"https://checkout.paystack.com/navhaycsgrcozyd\",\n    \"access_code\": \"navhaycsgrcozyd\",\n    \"reference\": \"p2j9w2uj6e\"\n  }\n}', NULL, 'PAYSTACK', '2019-08-23 07:13:13', '2019-08-23 07:13:13'),
(5, 18, 5000, '{\n  \"status\": true,\n  \"message\": \"Authorization URL created\",\n  \"data\": {\n    \"authorization_url\": \"https://checkout.paystack.com/8thbr3ui4it1ur8\",\n    \"access_code\": \"8thbr3ui4it1ur8\",\n    \"reference\": \"up3y8v5pvs\"\n  }\n}', NULL, 'PAYSTACK', '2019-08-23 07:39:43', '2019-08-23 07:39:43'),
(6, 19, 5000, '{\n  \"status\": true,\n  \"message\": \"Authorization URL created\",\n  \"data\": {\n    \"authorization_url\": \"https://checkout.paystack.com/z7vxs5fmf7vd505\",\n    \"access_code\": \"z7vxs5fmf7vd505\",\n    \"reference\": \"vw6iks8lf2\"\n  }\n}', NULL, 'PAYSTACK', '2019-08-23 07:40:33', '2019-08-23 07:40:33');

-- --------------------------------------------------------

--
-- Table structure for table `user_subscriptions`
--

CREATE TABLE `user_subscriptions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `subscription_package_id` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `user_id` bigint(20) NOT NULL,
  `title` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `from_date` datetime NOT NULL,
  `due_date` datetime NOT NULL,
  `amount` double NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  `status` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_subscriptions`
--

INSERT INTO `user_subscriptions` (`id`, `subscription_package_id`, `user_id`, `title`, `from_date`, `due_date`, `amount`, `is_active`, `status`, `type`, `created_at`, `updated_at`) VALUES
(6, 1, 1, 'Subscription for Pexxo Memories for 12 months', '2019-08-23 00:00:00', '2019-12-01 00:00:00', 5000, 0, 'EXPIRED', 'NA', '2019-08-23 14:20:09', '2019-08-23 14:23:20'),
(7, 1, 1, 'Subscription for Pexxo Memories for 12 months', '2019-08-23 00:00:00', '2019-12-01 00:00:00', 5000, 0, 'EXPIRED', 'NA', '2019-08-23 14:23:20', '2019-08-23 14:23:41'),
(8, 1, 1, 'Subscription for Pexxo Memories for 12 months', '2019-08-23 00:00:00', '2019-12-01 00:00:00', 5000, 0, 'EXPIRED', 'NA', '2019-08-23 14:23:41', '2019-08-23 14:24:03'),
(9, 1, 1, 'Subscription for Pexxo Memories for 12 months', '2019-08-23 00:00:00', '2019-12-01 00:00:00', 5000, 0, 'EXPIRED', 'NA', '2019-08-23 14:24:03', '2019-08-23 14:28:58'),
(10, 1, 1, 'Subscription for Pexxo Memories for 12 months', '2019-08-23 00:00:00', '2020-03-10 00:00:00', 5000, 0, 'EXPIRED', 'NA', '2019-08-23 14:28:58', '2019-08-23 14:29:07'),
(11, 1, 1, 'Subscription for Pexxo Memories for 12 months', '2019-08-23 00:00:00', '2020-06-18 00:00:00', 5000, 0, 'EXPIRED', 'NA', '2019-08-23 14:29:07', '2019-08-23 14:29:13'),
(12, 1, 1, 'Subscription for Pexxo Memories for 12 months', '2019-08-23 00:00:00', '2020-09-26 00:00:00', 5000, 0, 'CARRYOVER', 'NA', '2019-08-23 14:29:13', '2019-08-23 14:30:07'),
(13, 1, 1, 'Subscription for Pexxo Memories for 12 months', '2019-08-23 00:00:00', '2021-01-04 00:00:00', 5000, 1, 'ACTIVE', 'NA', '2019-08-23 14:30:07', '2019-08-23 14:30:07');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `album_comments`
--
ALTER TABLE `album_comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `billing_addresses`
--
ALTER TABLE `billing_addresses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `booking_categories`
--
ALTER TABLE `booking_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `booking_details`
--
ALTER TABLE `booking_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `booking_images`
--
ALTER TABLE `booking_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `booking_items`
--
ALTER TABLE `booking_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `booking_types`
--
ALTER TABLE `booking_types`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `booking_types_key_code_unique` (`key_code`);

--
-- Indexes for table `email_resets`
--
ALTER TABLE `email_resets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `faqs`
--
ALTER TABLE `faqs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notification_settings_items`
--
ALTER TABLE `notification_settings_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notification_settings_types`
--
ALTER TABLE `notification_settings_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `otp`
--
ALTER TABLE `otp`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `otp_code_unique` (`code`),
  ADD UNIQUE KEY `otp_email_unique` (`email`),
  ADD UNIQUE KEY `otp_user_id_unique` (`user_id`),
  ADD UNIQUE KEY `otp_key_1_unique` (`key_1`),
  ADD UNIQUE KEY `otp_key_2_unique` (`key_2`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `peexoo_calendars`
--
ALTER TABLE `peexoo_calendars`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `peexoo_photography_community_models`
--
ALTER TABLE `peexoo_photography_community_models`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `photographers`
--
ALTER TABLE `photographers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `photographers_user_id_unique` (`user_id`);

--
-- Indexes for table `photographer_bank_account_details`
--
ALTER TABLE `photographer_bank_account_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `photographer_billing_details`
--
ALTER TABLE `photographer_billing_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `photographer_card_details`
--
ALTER TABLE `photographer_card_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `photographer_cine_types`
--
ALTER TABLE `photographer_cine_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `photographer_invoices`
--
ALTER TABLE `photographer_invoices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `photographer_packages`
--
ALTER TABLE `photographer_packages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `photographer_package_items`
--
ALTER TABLE `photographer_package_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `photographer_portfolios`
--
ALTER TABLE `photographer_portfolios`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `photographer_portfolio_categories`
--
ALTER TABLE `photographer_portfolio_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `photographer_portfolio_images`
--
ALTER TABLE `photographer_portfolio_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `photographer_profile_images`
--
ALTER TABLE `photographer_profile_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subscriptionplans`
--
ALTER TABLE `subscriptionplans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `user_notification_settings`
--
ALTER TABLE `user_notification_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_payments`
--
ALTER TABLE `user_payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_payment_installments`
--
ALTER TABLE `user_payment_installments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_subscriptions`
--
ALTER TABLE `user_subscriptions`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `album_comments`
--
ALTER TABLE `album_comments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `billing_addresses`
--
ALTER TABLE `billing_addresses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `booking_categories`
--
ALTER TABLE `booking_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `booking_details`
--
ALTER TABLE `booking_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `booking_images`
--
ALTER TABLE `booking_images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `booking_items`
--
ALTER TABLE `booking_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `booking_types`
--
ALTER TABLE `booking_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `email_resets`
--
ALTER TABLE `email_resets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `faqs`
--
ALTER TABLE `faqs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `notification_settings_items`
--
ALTER TABLE `notification_settings_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `notification_settings_types`
--
ALTER TABLE `notification_settings_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `otp`
--
ALTER TABLE `otp`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=93;

--
-- AUTO_INCREMENT for table `peexoo_calendars`
--
ALTER TABLE `peexoo_calendars`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `peexoo_photography_community_models`
--
ALTER TABLE `peexoo_photography_community_models`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `photographers`
--
ALTER TABLE `photographers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `photographer_bank_account_details`
--
ALTER TABLE `photographer_bank_account_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `photographer_billing_details`
--
ALTER TABLE `photographer_billing_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `photographer_card_details`
--
ALTER TABLE `photographer_card_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `photographer_cine_types`
--
ALTER TABLE `photographer_cine_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `photographer_invoices`
--
ALTER TABLE `photographer_invoices`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `photographer_packages`
--
ALTER TABLE `photographer_packages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `photographer_package_items`
--
ALTER TABLE `photographer_package_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `photographer_portfolios`
--
ALTER TABLE `photographer_portfolios`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `photographer_portfolio_categories`
--
ALTER TABLE `photographer_portfolio_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `photographer_portfolio_images`
--
ALTER TABLE `photographer_portfolio_images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `photographer_profile_images`
--
ALTER TABLE `photographer_profile_images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `subscriptionplans`
--
ALTER TABLE `subscriptionplans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT for table `user_notification_settings`
--
ALTER TABLE `user_notification_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_payments`
--
ALTER TABLE `user_payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `user_payment_installments`
--
ALTER TABLE `user_payment_installments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `user_subscriptions`
--
ALTER TABLE `user_subscriptions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
