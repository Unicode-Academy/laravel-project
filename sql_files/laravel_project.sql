-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Oct 31, 2024 at 08:13 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laravel_project`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(200) DEFAULT NULL,
  `slug` varchar(200) DEFAULT NULL,
  `parent_id` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `slug`, `parent_id`, `created_at`, `updated_at`) VALUES
(1, 'Lập trình', 'lap-trinh', 0, '2023-10-19 02:12:06', '2023-10-19 02:12:06'),
(2, 'Front-End', 'front-end', 1, '2024-02-18 23:22:03', '2024-02-18 23:22:03'),
(3, 'Back-End', 'back-end', 1, '2024-02-18 23:22:12', '2024-02-18 23:22:12');

-- --------------------------------------------------------

--
-- Table structure for table `categories_courses`
--

CREATE TABLE `categories_courses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` int(10) UNSIGNED NOT NULL,
  `course_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories_courses`
--

INSERT INTO `categories_courses` (`id`, `category_id`, `course_id`, `created_at`, `updated_at`) VALUES
(4, 3, 4, '2024-04-09 23:00:53', '2024-04-09 23:00:53'),
(5, 2, 5, '2024-04-07 02:52:22', '2024-04-07 02:52:22'),
(6, 2, 6, '2024-05-03 23:48:29', '2024-05-03 23:48:29');

-- --------------------------------------------------------

--
-- Table structure for table `coupons`
--

CREATE TABLE `coupons` (
  `id` int(10) UNSIGNED NOT NULL,
  `code` varchar(100) NOT NULL,
  `discount_type` enum('percent','value') NOT NULL DEFAULT 'percent',
  `discount_value` int(11) NOT NULL DEFAULT 0,
  `total_condition` int(11) DEFAULT NULL,
  `count` int(11) DEFAULT NULL,
  `start_date` timestamp NULL DEFAULT NULL,
  `end_date` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `coupons`
--

INSERT INTO `coupons` (`id`, `code`, `discount_type`, `discount_value`, `total_condition`, `count`, `start_date`, `end_date`, `created_at`, `updated_at`) VALUES
(1, 'N0B0KF6F4K', 'value', 148077, NULL, NULL, NULL, NULL, '2024-10-14 18:58:52', '2024-10-14 18:58:52'),
(2, 'SOJ8LHUH0G', 'value', 287577, NULL, NULL, NULL, NULL, '2024-10-14 18:58:52', '2024-10-14 18:58:52'),
(3, '9435ZEC4XF', 'percent', 10, NULL, NULL, NULL, NULL, '2024-10-14 18:58:52', '2024-10-14 18:58:52'),
(4, '7XR04CIKLX', 'percent', 12, NULL, NULL, NULL, NULL, '2024-10-14 18:58:52', '2024-10-14 18:58:52'),
(5, 'P3DLPID2LE', 'value', 238139, NULL, NULL, NULL, NULL, '2024-10-14 18:58:52', '2024-10-14 18:58:52'),
(6, '79OQAPGWHD', 'percent', 34, NULL, NULL, NULL, NULL, '2024-10-14 18:58:52', '2024-10-14 18:58:52'),
(7, 'GCAGGLPRY3', 'percent', 29, NULL, NULL, NULL, NULL, '2024-10-14 18:58:52', '2024-10-14 18:58:52'),
(8, 'OP7F8MLOCL', 'value', 162688, NULL, NULL, NULL, NULL, '2024-10-14 18:58:52', '2024-10-14 18:58:52'),
(9, '9WC04VRGC2', 'percent', 21, NULL, NULL, NULL, NULL, '2024-10-14 18:58:52', '2024-10-14 18:58:52'),
(10, 'M6IBBW0UV4', 'value', 122674, NULL, NULL, NULL, NULL, '2024-10-14 18:58:52', '2024-10-14 18:58:52');

-- --------------------------------------------------------

--
-- Table structure for table `coupons_courses`
--

CREATE TABLE `coupons_courses` (
  `id` int(10) UNSIGNED NOT NULL,
  `coupon_id` int(10) UNSIGNED NOT NULL,
  `course_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `coupons_students`
--

CREATE TABLE `coupons_students` (
  `id` int(10) UNSIGNED NOT NULL,
  `coupon_id` int(10) UNSIGNED NOT NULL,
  `student_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `coupons_usage`
--

CREATE TABLE `coupons_usage` (
  `id` int(10) UNSIGNED NOT NULL,
  `coupon_id` int(10) UNSIGNED DEFAULT NULL,
  `order_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `detail` text NOT NULL,
  `teacher_id` int(10) UNSIGNED NOT NULL,
  `thumbnail` varchar(255) NOT NULL,
  `price` double(11,2) NOT NULL DEFAULT 0.00,
  `sale_price` double(11,2) NOT NULL DEFAULT 0.00,
  `code` varchar(100) NOT NULL,
  `durations` double(8,2) NOT NULL DEFAULT 0.00,
  `is_document` tinyint(1) NOT NULL DEFAULT 0,
  `supports` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `view` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `name`, `slug`, `detail`, `teacher_id`, `thumbnail`, `price`, `sale_price`, `code`, `durations`, `is_document`, `supports`, `status`, `view`, `created_at`, `updated_at`) VALUES
(4, 'Lập trình Laravel', 'lap-trinh-laravel', '<h3>What is Lorem Ipsum?</h3>\r\n\r\n<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum</p>\r\n\r\n<h3>Why do we use it?</h3>\r\n\r\n<p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using &#39;Content here, content here&#39;, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for &#39;lorem ipsum&#39; will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>', 1, '/storage/photos/1/z4785649628350_441ed4fc254666ce38428c9d91d17b57.jpg', 2500000.00, 1000000.00, 'laravel001', 91.59, 0, 'Zalo', 0, 0, '2024-03-21 23:59:06', '2024-04-10 11:34:09'),
(5, 'HTML - CSS', 'html-css', '<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>', 1, '/storage/photos/1/HỌC LARAVEL THÔI.png', 500000.00, 400000.00, 'htmlcss001', 0.00, 1, 'Qua Zalo', 1, 0, '2024-04-07 02:52:22', '2024-04-07 02:52:22'),
(6, 'PHP cơ bản', 'php-co-ban', '<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>', 1, '/storage/photos/1/z4785649628350_441ed4fc254666ce38428c9d91d17b57.jpg', 2000000.00, 1000000.00, 'php001', 0.00, 1, 'Qua Zalo', 1, 0, '2024-04-07 02:53:11', '2024-05-03 23:48:29');

-- --------------------------------------------------------

--
-- Table structure for table `documents`
--

CREATE TABLE `documents` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `url` varchar(255) NOT NULL,
  `size` double(8,2) NOT NULL DEFAULT 0.00,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `documents`
--

INSERT INTO `documents` (`id`, `name`, `url`, `size`, `created_at`, `updated_at`) VALUES
(1, 'Back-End NodeJS.pptx', '/storage/documents/1/Back-End NodeJS.pptx', 201485.00, '2024-03-14 23:49:57', '2024-03-14 23:49:57');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lessons`
--

CREATE TABLE `lessons` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `video_id` int(10) UNSIGNED DEFAULT NULL,
  `course_id` int(10) UNSIGNED DEFAULT NULL,
  `document_id` int(10) UNSIGNED DEFAULT NULL,
  `parent_id` int(10) UNSIGNED DEFAULT NULL,
  `is_trial` tinyint(1) NOT NULL DEFAULT 0,
  `view` int(11) NOT NULL DEFAULT 0,
  `position` int(11) NOT NULL DEFAULT 0,
  `durations` double(8,2) NOT NULL,
  `description` text DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `lessons`
--

INSERT INTO `lessons` (`id`, `name`, `slug`, `video_id`, `course_id`, `document_id`, `parent_id`, `is_trial`, `view`, `position`, `durations`, `description`, `status`, `created_at`, `updated_at`) VALUES
(8, 'Module 01: Kiến thức căn bản', 'module-01-kien-thuc-can-ban', NULL, 4, NULL, NULL, 0, 0, 0, 0.00, NULL, 1, '2024-04-07 00:56:37', '2024-05-03 22:59:58'),
(13, 'Cài đặt Laravel trên Xampp', 'cai-dat-laravel-tren-xampp', 1, 4, 1, 8, 1, 0, 2, 30.53, NULL, 1, '2024-04-07 01:11:18', '2024-05-03 23:51:52'),
(14, 'Cấu trúc thư mục và luồng Request trong Laravel Framework', 'cau-truc-thu-muc-va-luong-request-trong-laravel-framework', 1, 4, 1, 8, 1, 0, 1, 30.53, NULL, 1, '2024-04-10 11:33:29', '2024-05-03 22:59:51'),
(15, 'Module 02: Làm việc với Database', 'module-02-lam-viec-voi-database', NULL, 4, NULL, NULL, 0, 0, 3, 0.00, NULL, 1, '2024-04-10 11:33:43', '2024-05-03 23:52:03'),
(16, 'Kết nối Database Larave', 'ket-noi-database-larave', 1, 4, NULL, 15, 0, 0, 4, 30.53, NULL, 1, '2024-04-10 11:34:09', '2024-05-03 23:07:53');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(4, '2023_01_28_171604_create_categories_table', 1),
(5, '2023_02_05_184003_create_courses_table', 1),
(6, '2023_02_25_154032_create_categories_courses_table', 1),
(7, '2023_04_30_163300_create_teacher_table', 1),
(8, '2023_05_02_172829_add_foreign_courses_table', 1),
(10, '2023_09_26_110900_create_test_table', 2),
(22, '2024_01_13_093848_create_video_table', 3),
(23, '2024_01_13_094309_create_documents_table', 3),
(24, '2024_01_13_094622_create_lessons_table', 3),
(25, '2024_03_18_190924_create_students_table', 4),
(27, '2024_04_03_070950_add_view_column_courses_table', 5),
(29, '2024_05_04_055152_add_status_column_lessions_table', 6),
(31, '2024_05_15_092204_add_remember_token_column_students_table', 7),
(33, '2024_05_20_082450_add_email_verified_at_column_users_table', 8),
(34, '2024_05_20_101204_create_jobs_table', 9),
(35, '2024_05_22_040221_create_password_resets_table', 10),
(60, '2024_06_24_082434_create_students_courses_table', 11),
(61, '2024_06_27_062620_create_orders_status_table', 11),
(62, '2024_06_27_062736_create_orders_table', 11),
(63, '2024_06_27_063419_create_orders_detail_table', 11),
(65, '2024_09_27_021855_add_payment_date_column_orders_table', 12),
(70, '2024_10_14_092624_create_coupons_table', 13),
(71, '2024_10_14_093109_create_coupons_usage_table', 13),
(72, '2024_10_14_093440_create_coupons_courses_table', 13),
(73, '2024_10_14_093610_create_coupons_students_table', 13),
(74, '2024_10_29_093424_add_discount_column_orders_table', 14);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(10) UNSIGNED NOT NULL,
  `student_id` int(10) UNSIGNED DEFAULT NULL,
  `total` double(10,2) NOT NULL DEFAULT 0.00,
  `discount` int(11) NOT NULL DEFAULT 0,
  `coupon` varchar(255) DEFAULT NULL,
  `status_id` int(10) UNSIGNED DEFAULT NULL,
  `payment_date` timestamp NULL DEFAULT NULL,
  `payment_complete_date` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `student_id`, `total`, `discount`, `coupon`, `status_id`, `payment_date`, `payment_complete_date`, `created_at`, `updated_at`) VALUES
(1, 25, 1000000.00, 0, NULL, 1, '2024-10-14 18:54:32', NULL, '2024-06-26 08:22:36', '2024-10-30 08:43:58'),
(2, 25, 500000.00, 50000, '9435ZEC4XF', 1, '2024-10-13 07:59:29', NULL, '2024-06-27 08:25:37', '2024-10-29 02:42:54');

-- --------------------------------------------------------

--
-- Table structure for table `orders_detail`
--

CREATE TABLE `orders_detail` (
  `id` int(10) UNSIGNED NOT NULL,
  `order_id` int(10) UNSIGNED NOT NULL,
  `course_id` int(10) UNSIGNED DEFAULT NULL,
  `price` double(10,2) NOT NULL DEFAULT 0.00,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders_detail`
--

INSERT INTO `orders_detail` (`id`, `order_id`, `course_id`, `price`, `created_at`, `updated_at`) VALUES
(1, 1, 4, 1000000.00, '2024-06-28 09:52:28', '2024-06-28 09:52:28'),
(2, 1, 6, 500000.00, '2024-06-28 09:53:06', '2024-06-28 09:53:06');

-- --------------------------------------------------------

--
-- Table structure for table `orders_status`
--

CREATE TABLE `orders_status` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(200) NOT NULL,
  `color` varchar(100) DEFAULT NULL,
  `is_success` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders_status`
--

INSERT INTO `orders_status` (`id`, `name`, `color`, `is_success`, `created_at`, `updated_at`) VALUES
(1, 'Chờ thanh toán', 'warning', 0, NULL, NULL),
(2, 'Đã thanh toán', 'success', 1, NULL, NULL),
(3, 'Thanh toán bất bại', 'danger', 0, NULL, NULL),
(4, 'Hủy thanh toán', 'danger', 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `password` varchar(100) NOT NULL,
  `address` varchar(200) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `remember_token` varchar(100) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `name`, `email`, `phone`, `password`, `address`, `status`, `remember_token`, `email_verified_at`, `created_at`, `updated_at`) VALUES
(25, 'Hoàng An', 'hoangan.web@gmail.com', '0388875179', '$2y$10$bvkIj/VU3rMzddrLwEGwFOopHXSHdawpYa./e1O6DPnoMWSZFqTPK', 'Hà Nội', 1, 'sXehwKujELHi0Tc79vb2TIjkv5mIbsyg5YWv1GtGN1i7ujWyUlnvR0ZkPnkI', '2024-05-21 20:19:06', '2024-05-21 20:02:49', '2024-06-22 01:49:09');

-- --------------------------------------------------------

--
-- Table structure for table `students_courses`
--

CREATE TABLE `students_courses` (
  `id` int(10) UNSIGNED NOT NULL,
  `student_id` int(10) UNSIGNED NOT NULL,
  `course_id` int(10) UNSIGNED NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `student_password_resets`
--

CREATE TABLE `student_password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `teacher`
--

CREATE TABLE `teacher` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `slug` varchar(100) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `exp` int(11) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `teacher`
--

INSERT INTO `teacher` (`id`, `name`, `slug`, `description`, `exp`, `image`, `created_at`, `updated_at`) VALUES
(1, 'Hoàng An', 'hoang-an', '<p>L&agrave; một kĩ sư rất đam m&ecirc; trong lĩnh vực tự động h&oacute;a trong x&acirc;y dựng, lu&ocirc;n t&igrave;m kiếm v&agrave; &aacute;p dụng những kiến thức c&ocirc;ng nghệ mới nhằm mang lại hiệu suất cao trong c&ocirc;ng việc. Từ năm 2015 tới nay, trải qua rất nhiều vị tr&iacute; tại c&aacute;c văn ph&ograve;ng thiết kế như kĩ sư Kết Cấu, trưởng nh&oacute;m Kết Cấu, kĩ sư BIM, quản l&yacute; Kiến Tr&uacute;c, quản l&yacute; Cơ Điện, trưởng ph&ograve;ng BIM... Anh c&oacute; rất nhiều cơ hội để &aacute;p dụng c&aacute;c kiến thức tự động h&oacute;a của m&igrave;nh đặc biệt l&agrave; với Dynamo v&agrave; ng&ocirc;n ngữ lập tr&igrave;nh Python.<br />\r\nNgo&agrave;i ra, anh cũng đang l&agrave; Giảng vi&ecirc;n Dynamo cho c&aacute;c bộ m&ocirc;n Kiến tr&uacute;c - Kết cấu, Cơ điện trong nh&agrave; cao tầng với hơn 20 lớp học tổ chức tại DSCons, đồng thời l&agrave; Admin c&aacute;c trang Fanpage, Group cộng đồng Dynamo BIM Việt Nam c&ugrave;ng hơn 8000 th&agrave;nh vi&ecirc;n.<br />\r\nVới hơn 7 năm kinh nghiệm triển khai BIM cho dự &aacute;n thực tế v&agrave; 4 năm giảng dạy đ&agrave;o tạo, anh sẽ đồng h&agrave;nh c&ugrave;ng học vi&ecirc;n trong c&aacute;c kh&oacute;a học Online v&agrave; tự tin mang lại những gi&aacute; trị hữu &iacute;ch, thiết thực nhất!</p>', 10, '/storage/photos/1/381492250_2016028098770296_9108143938910430487_n.jpg', '2023-10-19 02:10:24', '2024-04-14 04:09:11');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `group_id` int(11) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `group_id`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Hoàng An', 'hoangan.web@gmail.com', 1, NULL, '$2y$10$IlnRziGFiRzNPhXzGv9w8uH9QabrCwsb4q1QsWAcITMVK0asqeyJW', NULL, '2023-09-01 22:38:19', '2023-09-01 22:38:19');

-- --------------------------------------------------------

--
-- Table structure for table `videos`
--

CREATE TABLE `videos` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `url` varchar(255) NOT NULL,
  `size` double(8,2) NOT NULL DEFAULT 0.00,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `videos`
--

INSERT INTO `videos` (`id`, `name`, `url`, `size`, `created_at`, `updated_at`) VALUES
(1, 'file_example_MP4_480_1_5MG.mp4', '/storage/videos/1/file_example_MP4_480_1_5MG.mp4', 30.53, '2024-03-14 23:49:58', '2024-03-14 23:49:58');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories_courses`
--
ALTER TABLE `categories_courses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `categories_courses_category_id_foreign` (`category_id`),
  ADD KEY `categories_courses_course_id_foreign` (`course_id`);

--
-- Indexes for table `coupons`
--
ALTER TABLE `coupons`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `coupons_code_unique` (`code`);

--
-- Indexes for table `coupons_courses`
--
ALTER TABLE `coupons_courses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `coupons_courses_coupon_id_foreign` (`coupon_id`),
  ADD KEY `coupons_courses_course_id_foreign` (`course_id`);

--
-- Indexes for table `coupons_students`
--
ALTER TABLE `coupons_students`
  ADD PRIMARY KEY (`id`),
  ADD KEY `coupons_students_coupon_id_foreign` (`coupon_id`),
  ADD KEY `coupons_students_student_id_foreign` (`student_id`);

--
-- Indexes for table `coupons_usage`
--
ALTER TABLE `coupons_usage`
  ADD PRIMARY KEY (`id`),
  ADD KEY `coupons_usage_coupon_id_foreign` (`coupon_id`),
  ADD KEY `coupons_usage_order_id_foreign` (`order_id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `courses_teacher_id_foreign` (`teacher_id`);

--
-- Indexes for table `documents`
--
ALTER TABLE `documents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `lessons`
--
ALTER TABLE `lessons`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lessons_video_id_foreign` (`video_id`),
  ADD KEY `lessons_document_id_foreign` (`document_id`),
  ADD KEY `lessons_parent_id_foreign` (`parent_id`),
  ADD KEY `lessons_course_id_foreign` (`course_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_status_id_foreign` (`status_id`),
  ADD KEY `orders_student_id_foreign` (`student_id`);

--
-- Indexes for table `orders_detail`
--
ALTER TABLE `orders_detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_detail_course_id_foreign` (`course_id`),
  ADD KEY `orders_detail_order_id_foreign` (`order_id`);

--
-- Indexes for table `orders_status`
--
ALTER TABLE `orders_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `students_email_unique` (`email`);

--
-- Indexes for table `students_courses`
--
ALTER TABLE `students_courses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `students_courses_student_id_foreign` (`student_id`),
  ADD KEY `students_courses_course_id_foreign` (`course_id`);

--
-- Indexes for table `student_password_resets`
--
ALTER TABLE `student_password_resets`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `teacher`
--
ALTER TABLE `teacher`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `videos`
--
ALTER TABLE `videos`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `categories_courses`
--
ALTER TABLE `categories_courses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `coupons`
--
ALTER TABLE `coupons`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `coupons_courses`
--
ALTER TABLE `coupons_courses`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `coupons_students`
--
ALTER TABLE `coupons_students`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `coupons_usage`
--
ALTER TABLE `coupons_usage`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `documents`
--
ALTER TABLE `documents`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `lessons`
--
ALTER TABLE `lessons`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `orders_detail`
--
ALTER TABLE `orders_detail`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `orders_status`
--
ALTER TABLE `orders_status`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `students_courses`
--
ALTER TABLE `students_courses`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `teacher`
--
ALTER TABLE `teacher`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `videos`
--
ALTER TABLE `videos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `categories_courses`
--
ALTER TABLE `categories_courses`
  ADD CONSTRAINT `categories_courses_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `categories_courses_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `coupons_courses`
--
ALTER TABLE `coupons_courses`
  ADD CONSTRAINT `coupons_courses_coupon_id_foreign` FOREIGN KEY (`coupon_id`) REFERENCES `coupons` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `coupons_courses_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `coupons_students`
--
ALTER TABLE `coupons_students`
  ADD CONSTRAINT `coupons_students_coupon_id_foreign` FOREIGN KEY (`coupon_id`) REFERENCES `coupons` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `coupons_students_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `coupons_usage`
--
ALTER TABLE `coupons_usage`
  ADD CONSTRAINT `coupons_usage_coupon_id_foreign` FOREIGN KEY (`coupon_id`) REFERENCES `coupons` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `coupons_usage_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `courses`
--
ALTER TABLE `courses`
  ADD CONSTRAINT `courses_teacher_id_foreign` FOREIGN KEY (`teacher_id`) REFERENCES `teacher` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `lessons`
--
ALTER TABLE `lessons`
  ADD CONSTRAINT `lessons_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `lessons_document_id_foreign` FOREIGN KEY (`document_id`) REFERENCES `documents` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `lessons_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `lessons` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `lessons_video_id_foreign` FOREIGN KEY (`video_id`) REFERENCES `videos` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_status_id_foreign` FOREIGN KEY (`status_id`) REFERENCES `orders_status` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `orders_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `orders_detail`
--
ALTER TABLE `orders_detail`
  ADD CONSTRAINT `orders_detail_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `orders_detail_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `students_courses`
--
ALTER TABLE `students_courses`
  ADD CONSTRAINT `students_courses_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `students_courses_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
