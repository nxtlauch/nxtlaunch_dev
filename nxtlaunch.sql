-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 27, 2017 at 07:31 AM
-- Server version: 10.1.25-MariaDB
-- PHP Version: 7.1.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nxtlaunch`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Business', 1, '2017-11-12 04:05:48', '2017-11-12 04:05:48'),
(2, 'Public Figure', 1, '2017-11-12 04:06:06', '2017-11-12 04:06:06');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `post_id` int(10) UNSIGNED NOT NULL,
  `comment` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `user_id`, `post_id`, `comment`, `created_at`, `updated_at`) VALUES
(6, 5, 4, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ab accusantium ad aliquam deserunt, dolore ducimus facilis fuga fugit', '2017-11-16 03:30:53', '2017-11-16 03:30:53'),
(7, 5, 5, 'test comment', '2017-11-25 07:08:39', '2017-11-25 07:08:39'),
(8, 5, 8, 'test comment', '2017-11-26 01:19:05', '2017-11-26 01:19:05'),
(9, 5, 8, 'another test', '2017-11-26 01:20:50', '2017-11-26 01:20:50'),
(10, 5, 8, 'ha ha', '2017-11-26 01:21:15', '2017-11-26 01:21:15'),
(11, 5, 8, 'f', '2017-11-26 01:21:34', '2017-11-26 01:21:34'),
(12, 5, 8, 'ff', '2017-11-26 01:21:38', '2017-11-26 01:21:38'),
(13, 5, 8, 'also test', '2017-11-26 01:22:57', '2017-11-26 01:22:57'),
(14, 5, 8, 'test 1', '2017-11-26 01:23:26', '2017-11-26 01:23:26'),
(15, 5, 8, 'jlkjadlfffffffffffffffff', '2017-11-26 01:25:45', '2017-11-26 01:25:45'),
(16, 5, 8, 'fffff', '2017-11-26 01:26:36', '2017-11-26 01:26:36'),
(17, 5, 8, 'rrrrrrrrrrrrrrrrr', '2017-11-26 01:27:44', '2017-11-26 01:27:44'),
(18, 5, 8, 'kkkkk', '2017-11-26 01:32:15', '2017-11-26 01:32:15'),
(19, 5, 8, 'fdfd', '2017-11-26 03:00:10', '2017-11-26 03:00:10'),
(20, 5, 8, 'fdsa', '2017-11-26 03:17:24', '2017-11-26 03:17:24'),
(21, 5, 8, 'dfasf', '2017-11-26 03:18:33', '2017-11-26 03:18:33'),
(22, 5, 8, 'ha ha', '2017-11-26 03:32:06', '2017-11-26 03:32:06'),
(23, 5, 8, 'this is prepent', '2017-11-26 03:32:48', '2017-11-26 03:32:48'),
(24, 5, 8, 'ff', '2017-11-26 03:35:05', '2017-11-26 03:35:05'),
(25, 5, 8, 'gg', '2017-11-26 03:40:08', '2017-11-26 03:40:08'),
(26, 5, 8, 'vv', '2017-11-26 03:40:38', '2017-11-26 03:40:38'),
(27, 5, 7, 'ok', '2017-11-26 05:30:22', '2017-11-26 05:30:22'),
(28, 5, 7, 'thikache', '2017-11-26 05:31:45', '2017-11-26 05:31:45'),
(29, 5, 6, 'Again Test', '2017-11-26 05:32:45', '2017-11-26 05:32:45'),
(30, 5, 8, 'gg', '2017-11-26 05:54:04', '2017-11-26 05:54:04'),
(31, 5, 8, 'gg', '2017-11-26 05:54:44', '2017-11-26 05:54:44'),
(32, 5, 8, 'gg', '2017-11-26 05:54:49', '2017-11-26 05:54:49'),
(33, 5, 8, 'gg2', '2017-11-26 05:54:54', '2017-11-26 05:54:54'),
(34, 5, 8, 'gg2', '2017-11-26 05:54:56', '2017-11-26 05:54:56'),
(35, 5, 8, 'gg2', '2017-11-26 05:54:58', '2017-11-26 05:54:58'),
(36, 5, 8, 'gg2', '2017-11-26 05:54:58', '2017-11-26 05:54:58'),
(37, 5, 8, 'gg2', '2017-11-26 05:54:58', '2017-11-26 05:54:58'),
(38, 5, 8, 'gg2', '2017-11-26 05:54:58', '2017-11-26 05:54:58'),
(39, 5, 8, 'gg2', '2017-11-26 05:54:59', '2017-11-26 05:54:59'),
(40, 5, 8, 'gg2', '2017-11-26 05:54:59', '2017-11-26 05:54:59'),
(41, 5, 8, 'gg2asdsad', '2017-11-26 05:55:01', '2017-11-26 05:55:01'),
(42, 5, 8, 'gg2asdsad', '2017-11-26 05:55:47', '2017-11-26 05:55:47'),
(43, 5, 6, 'gg', '2017-11-26 05:56:25', '2017-11-26 05:56:25'),
(44, 5, 6, 'gg', '2017-11-26 05:56:32', '2017-11-26 05:56:32'),
(45, 5, 1, 'ha ha', '2017-11-26 05:58:26', '2017-11-26 05:58:26'),
(46, 5, 1, 'text area blank', '2017-11-26 05:59:20', '2017-11-26 05:59:20'),
(47, 5, 1, 'ff', '2017-11-26 06:01:31', '2017-11-26 06:01:31'),
(48, 5, 1, 'ha ha', '2017-11-26 06:04:29', '2017-11-26 06:04:29'),
(49, 5, 2, 'final test', '2017-11-26 06:15:19', '2017-11-26 06:15:19'),
(50, 5, 2, 'another final', '2017-11-26 06:15:27', '2017-11-26 06:15:27'),
(51, 5, 1, 'ff', '2017-11-26 06:15:49', '2017-11-26 06:15:49'),
(52, 5, 8, 'haklkjfds', '2017-11-26 06:17:16', '2017-11-26 06:17:16'),
(53, 5, 8, 'haklkjfds', '2017-11-26 06:17:22', '2017-11-26 06:17:22'),
(54, 5, 8, 'hh', '2017-11-26 06:17:46', '2017-11-26 06:17:46'),
(55, 5, 8, 'ff', '2017-11-26 23:04:09', '2017-11-26 23:04:09'),
(56, 5, 7, 'ff', '2017-11-26 23:04:26', '2017-11-26 23:04:26'),
(57, 5, 8, 'tt', '2017-11-26 23:07:50', '2017-11-26 23:07:50'),
(58, 5, 8, 'ff', '2017-11-26 23:08:06', '2017-11-26 23:08:06'),
(59, 5, 8, 'ff', '2017-11-26 23:08:38', '2017-11-26 23:08:38'),
(60, 5, 8, '40', '2017-11-26 23:09:28', '2017-11-26 23:09:28'),
(61, 5, 8, 'dd', '2017-11-26 23:09:52', '2017-11-26 23:09:52');

-- --------------------------------------------------------

--
-- Table structure for table `comment_replies`
--

CREATE TABLE `comment_replies` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `post_id` int(10) UNSIGNED NOT NULL,
  `comment_id` int(10) UNSIGNED NOT NULL,
  `reply` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `follows`
--

CREATE TABLE `follows` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `followed_by` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `follows`
--

INSERT INTO `follows` (`id`, `user_id`, `followed_by`, `created_at`, `updated_at`) VALUES
(8, 3, 2, '2017-11-13 00:26:27', '2017-11-13 00:26:27'),
(10, 2, 4, '2017-11-13 01:16:52', '2017-11-13 01:16:52'),
(11, 3, 4, '2017-11-13 01:16:54', '2017-11-13 01:16:54'),
(63, 3, 5, '2017-11-26 05:06:09', '2017-11-26 05:06:09'),
(68, 2, 5, '2017-11-26 05:16:37', '2017-11-26 05:16:37');

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `post_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `likes`
--

INSERT INTO `likes` (`id`, `user_id`, `post_id`, `created_at`, `updated_at`) VALUES
(27, 2, 2, '2017-11-13 00:02:39', '2017-11-13 00:02:39'),
(29, 2, 1, '2017-11-13 00:27:22', '2017-11-13 00:27:22'),
(37, 3, 1, '2017-11-13 23:21:14', '2017-11-13 23:21:14'),
(38, 3, 2, '2017-11-13 23:42:48', '2017-11-13 23:42:48'),
(44, 3, 4, '2017-11-14 04:48:12', '2017-11-14 04:48:12'),
(45, 3, 3, '2017-11-14 04:48:35', '2017-11-14 04:48:35'),
(98, 5, 4, '2017-11-19 23:28:49', '2017-11-19 23:28:49'),
(107, 5, 1, '2017-11-21 05:10:50', '2017-11-21 05:10:50'),
(114, 5, 3, '2017-11-23 04:42:41', '2017-11-23 04:42:41'),
(117, 5, 5, '2017-11-25 07:05:12', '2017-11-25 07:05:12'),
(138, 5, 2, '2017-11-26 03:50:43', '2017-11-26 03:50:43'),
(164, 5, 6, '2017-11-26 23:44:27', '2017-11-26 23:44:27'),
(165, 5, 8, '2017-11-27 00:24:08', '2017-11-27 00:24:08');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(10) UNSIGNED NOT NULL,
  `from_id` int(11) NOT NULL,
  `to_id` int(11) NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `from_id`, `to_id`, `message`, `status`, `created_at`, `updated_at`) VALUES
(1, 5, 2, 'hi', 1, '2017-11-21 02:55:30', '2017-11-21 02:55:30');

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
(20, '2014_10_12_000000_create_users_table', 1),
(21, '2014_10_12_100000_create_password_resets_table', 1),
(22, '2016_06_01_000001_create_oauth_auth_codes_table', 1),
(23, '2016_06_01_000002_create_oauth_access_tokens_table', 1),
(24, '2016_06_01_000003_create_oauth_refresh_tokens_table', 1),
(25, '2016_06_01_000004_create_oauth_clients_table', 1),
(26, '2016_06_01_000005_create_oauth_personal_access_clients_table', 1),
(27, '2017_10_31_124022_create_roles_table', 1),
(28, '2017_10_31_124104_create_posts_table', 1),
(29, '2017_10_31_124650_create_likes_table', 1),
(30, '2017_10_31_124844_create_comments_table', 1),
(31, '2017_10_31_125104_create_follows_table', 1),
(32, '2017_10_31_125151_create_comment_replies_table', 1),
(33, '2017_10_31_125303_create_user_details_table', 1),
(34, '2017_10_31_125447_create_user_settings_table', 1),
(35, '2017_11_02_042012_create_shares_table', 1),
(36, '2017_11_06_071403_create_user_reports_table', 1),
(37, '2017_11_06_071440_create_post_reports_table', 1),
(38, '2017_11_09_052735_create_categories_table', 1),
(39, '2017_11_18_063324_create_messages_table', 2),
(43, '2017_11_27_051620_create_notifications_table', 3);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `noti_text` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `noti_for` int(11) NOT NULL,
  `noti_activity` int(11) NOT NULL,
  `purpose_id` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `user_id`, `noti_text`, `noti_for`, `noti_activity`, `purpose_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 5, 'likes your post', 2, 1, 8, 1, '2017-11-27 00:24:08', '2017-11-27 00:24:08');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_access_tokens`
--

CREATE TABLE `oauth_access_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `client_id` int(11) NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_auth_codes`
--

CREATE TABLE `oauth_auth_codes` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_clients`
--

CREATE TABLE `oauth_clients` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `secret` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `redirect` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `personal_access_client` tinyint(1) NOT NULL,
  `password_client` tinyint(1) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_personal_access_clients`
--

CREATE TABLE `oauth_personal_access_clients` (
  `id` int(10) UNSIGNED NOT NULL,
  `client_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_refresh_tokens`
--

CREATE TABLE `oauth_refresh_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `access_token_id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `post_details` text COLLATE utf8mb4_unicode_ci,
  `category_id` int(11) NOT NULL,
  `expire_date` datetime NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `user_id`, `image`, `post_details`, `category_id`, `expire_date`, `status`, `created_at`, `updated_at`) VALUES
(1, 3, '5a0ab5d175182_1510483466youtube.jpg', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ab accusantium ad aliquam deserunt, dolore ducimus facilis fuga fugit illum inventore, ipsum molestias placeat qui quod recusandae repellat temporibus vel vitae!', 1, '2017-11-30 22:44:00', 1, '2017-11-12 04:44:27', '2017-11-14 03:22:25'),
(2, 2, '1510483547mainbg.jpg', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ab accusantium ad aliquam deserunt, dolore ducimus facilis fuga fugit illum inventore, ipsum molestias placeat qui quod recusandae repellat temporibus vel vitae!', 1, '2017-11-30 21:45:00', 1, '2017-11-12 04:45:47', '2017-11-12 04:45:47'),
(3, 3, '1510483547mainbg.jpg', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ab accusantium ad aliquam deserunt, dolore ducimus facilis fuga fugit illum inventore, ipsum molestias placeat qui quod recusandae repellat temporibus vel vitae!', 1, '2017-11-16 16:35:00', 1, '2017-11-14 00:37:17', '2017-11-14 00:37:17'),
(4, 3, '5a0a9a09e0642_about.png', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ab accusantium ad aliquam deserunt, dolore ducimus facilis fuga fugit illum inventore, ipsum molestias placeat qui quod recusandae repellat temporibus vel vitae!', 1, '2017-11-22 17:14:00', 0, '2017-11-14 01:23:53', '2017-11-20 06:44:07'),
(5, 5, '1511425144place3.jpg', 'this is test', 1, '2017-11-24 17:18:00', 1, '2017-11-23 02:19:05', '2017-11-23 02:19:05'),
(6, 5, '1511615736about.png', 'test test test', 1, '2017-11-26 23:15:00', 1, '2017-11-25 07:15:37', '2017-11-25 07:15:37'),
(7, 5, '1511617832place1.jpg', 'test test teskkfjdddddddddddddddddd', 2, '2017-12-30 23:50:00', 1, '2017-11-25 07:50:33', '2017-11-25 07:50:33'),
(8, 5, '1511617930place4.jpg', 'rr', 1, '2017-12-24 19:51:00', 1, '2017-11-25 07:52:10', '2017-11-25 07:52:10');

-- --------------------------------------------------------

--
-- Table structure for table `post_reports`
--

CREATE TABLE `post_reports` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `post_id` int(10) UNSIGNED NOT NULL,
  `report_description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `post_reports`
--

INSERT INTO `post_reports` (`id`, `user_id`, `post_id`, `report_description`, `created_at`, `updated_at`) VALUES
(12, 5, 1, 'he he', '2017-11-21 04:13:59', '2017-11-21 04:13:59'),
(13, 5, 3, 'he eh', '2017-11-21 04:23:49', '2017-11-21 04:23:49'),
(14, 5, 2, 'this is test report', '2017-11-25 23:15:51', '2017-11-25 23:15:51');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Admin', '2017-11-12 04:01:00', '2017-11-12 04:01:00'),
(2, 'Staff', '2017-11-12 04:01:37', '2017-11-12 04:01:37'),
(3, 'User', '2017-11-12 04:01:58', '2017-11-12 04:02:12'),
(4, 'Pro_user', '2017-11-12 04:02:46', '2017-11-12 04:02:46');

-- --------------------------------------------------------

--
-- Table structure for table `shares`
--

CREATE TABLE `shares` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `post_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `location` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role_id` int(10) UNSIGNED NOT NULL DEFAULT '3',
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `phone`, `location`, `role_id`, `email`, `password`, `status`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', '123456', NULL, 1, 'admin@admin.com', '$2y$10$iX0bATgUuV4RKSBqjMJuaeoPuVP8pknV5FuYahCr.sVWETXCOzrEi', 1, 'yoBGoRBCu7hZQHRWlr8TGsIBKX6I9sOG03qX35ogE0fIhj996EelR6ypq9WX', NULL, NULL),
(2, 'Md. Shahin', '123456', NULL, 4, 'shahin@shahin.com', '$2y$10$Cs/7WRoB4MetPuK8kckVoOm3lMCniJINBw49ccv9H8UV5RAVg0h3u', 1, 'uvCSLs7xLYI8kP14RDVuAphO5zV4XzEC3aOFndAzXTy569wMRrzsfncuy9Ga', '2017-11-12 04:18:38', '2017-11-12 04:18:56'),
(3, 'Test', '123456', NULL, 4, 'test@test.com', '$2y$10$rHxJYsSdvTCF24cv3y.8q.9prn.iMmKLse/I0SlFmeycNwRvaG/Ky', 1, '1o4iM2zhERrW0gXWUTkrb14rzEjDEuDaPqj9MCxde7YIwDnuZNvhe7zg0rYa', '2017-11-12 04:42:57', '2017-11-14 04:25:55'),
(4, 'Regular User', '123456', NULL, 3, 'regular@regular.com', '$2y$10$Th32DdiQZrgzCSNOJHuGseMB6dVYHFB6weW9KlxINQ26DorqI5YXe', 1, 'vieKUdcEhsc4dffwxAukiev21iXrxDEPb3qhf9sXr4hfebxSXqqqHbUV2tkS', '2017-11-13 01:10:37', '2017-11-13 01:10:37'),
(5, 'Test Account', '123456789', 'Dhaka', 4, 'a@a.com', '$2y$10$MzVJF4G5raWG8rlrBdF3Tenayp//lLkbf6.a.uHS9vX80minjL.Zi', 1, 'zzSZKfOigjelPH8FhH3XluAgyaQ1JihVd0YIWicK4JM7Oep6e3DpjtSn2KHb', '2017-11-15 01:37:51', '2017-11-16 05:34:07'),
(6, 'b name', '123456', 'location b', 3, 'b@b.com', '$2y$10$rHBloS2eSJQNsFTXs8l4OOm2FPlLga.gPbR6K2kz3fKWCzSzqozTy', 1, 'fqy9HhPxX1CHQngvwKdMQXKW8mlDjnmrqdURlVatge2PUtjLr3MCjZIVZcep', '2017-11-22 23:26:03', '2017-11-22 23:26:03');

-- --------------------------------------------------------

--
-- Table structure for table `user_details`
--

CREATE TABLE `user_details` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `category_name` text COLLATE utf8mb4_unicode_ci,
  `business_description` text COLLATE utf8mb4_unicode_ci,
  `profile_picture` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `birth_date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_details`
--

INSERT INTO `user_details` (`id`, `user_id`, `category_name`, `business_description`, `profile_picture`, `address`, `birth_date`, `created_at`, `updated_at`) VALUES
(1, 2, 'Local business or place', 'this is a local business', '1510483012team1.jpg', NULL, NULL, '2017-11-12 04:18:56', '2017-11-12 04:36:53'),
(2, 3, 'Company or Organization', 'This is a company', '5a0bce4f5923a_team4.jpg', NULL, NULL, '2017-11-13 01:31:51', '2017-11-14 23:19:11'),
(3, 5, 'Local business or place', 'test account', NULL, NULL, NULL, '2017-11-15 01:38:03', '2017-11-15 01:38:03');

-- --------------------------------------------------------

--
-- Table structure for table `user_reports`
--

CREATE TABLE `user_reports` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `reported_by` int(11) NOT NULL,
  `report_description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_reports`
--

INSERT INTO `user_reports` (`id`, `user_id`, `reported_by`, `report_description`, `created_at`, `updated_at`) VALUES
(2, 3, 5, 'he is bad', '2017-11-21 06:41:36', '2017-11-21 06:41:36'),
(3, 2, 5, 'valo lage nai tai', '2017-11-22 22:31:55', '2017-11-22 22:31:55');

-- --------------------------------------------------------

--
-- Table structure for table `user_settings`
--

CREATE TABLE `user_settings` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `notification_status` tinyint(4) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `comments_user_id_foreign` (`user_id`),
  ADD KEY `comments_post_id_foreign` (`post_id`);

--
-- Indexes for table `comment_replies`
--
ALTER TABLE `comment_replies`
  ADD PRIMARY KEY (`id`),
  ADD KEY `comment_replies_user_id_foreign` (`user_id`),
  ADD KEY `comment_replies_post_id_foreign` (`post_id`),
  ADD KEY `comment_replies_comment_id_foreign` (`comment_id`);

--
-- Indexes for table `follows`
--
ALTER TABLE `follows`
  ADD PRIMARY KEY (`id`),
  ADD KEY `follows_user_id_foreign` (`user_id`),
  ADD KEY `follows_followed_by_foreign` (`followed_by`);

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `likes_user_id_foreign` (`user_id`),
  ADD KEY `likes_post_id_foreign` (`post_id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_user_id_foreign` (`user_id`);

--
-- Indexes for table `oauth_access_tokens`
--
ALTER TABLE `oauth_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_access_tokens_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_auth_codes`
--
ALTER TABLE `oauth_auth_codes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_clients_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_personal_access_clients_client_id_index` (`client_id`);

--
-- Indexes for table `oauth_refresh_tokens`
--
ALTER TABLE `oauth_refresh_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_refresh_tokens_access_token_id_index` (`access_token_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `posts_user_id_foreign` (`user_id`);
ALTER TABLE `posts` ADD FULLTEXT KEY `index_name` (`post_details`);

--
-- Indexes for table `post_reports`
--
ALTER TABLE `post_reports`
  ADD PRIMARY KEY (`id`),
  ADD KEY `post_reports_post_id_foreign` (`post_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shares`
--
ALTER TABLE `shares`
  ADD PRIMARY KEY (`id`),
  ADD KEY `shares_user_id_foreign` (`user_id`),
  ADD KEY `shares_post_id_foreign` (`post_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `user_details`
--
ALTER TABLE `user_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_details_user_id_foreign` (`user_id`);

--
-- Indexes for table `user_reports`
--
ALTER TABLE `user_reports`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_reports_user_id_foreign` (`user_id`);

--
-- Indexes for table `user_settings`
--
ALTER TABLE `user_settings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_settings_user_id_foreign` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;
--
-- AUTO_INCREMENT for table `comment_replies`
--
ALTER TABLE `comment_replies`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `follows`
--
ALTER TABLE `follows`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;
--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=166;
--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;
--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `post_reports`
--
ALTER TABLE `post_reports`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `shares`
--
ALTER TABLE `shares`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `user_details`
--
ALTER TABLE `user_details`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `user_reports`
--
ALTER TABLE `user_reports`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `user_settings`
--
ALTER TABLE `user_settings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `comments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `comment_replies`
--
ALTER TABLE `comment_replies`
  ADD CONSTRAINT `comment_replies_comment_id_foreign` FOREIGN KEY (`comment_id`) REFERENCES `comments` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `comment_replies_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `comment_replies_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `follows`
--
ALTER TABLE `follows`
  ADD CONSTRAINT `follows_followed_by_foreign` FOREIGN KEY (`followed_by`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `follows_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `likes`
--
ALTER TABLE `likes`
  ADD CONSTRAINT `likes_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `likes_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `post_reports`
--
ALTER TABLE `post_reports`
  ADD CONSTRAINT `post_reports_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `post_reports_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `shares`
--
ALTER TABLE `shares`
  ADD CONSTRAINT `shares_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `shares_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `user_details`
--
ALTER TABLE `user_details`
  ADD CONSTRAINT `user_details_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `user_reports`
--
ALTER TABLE `user_reports`
  ADD CONSTRAINT `user_reports_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `user_settings`
--
ALTER TABLE `user_settings`
  ADD CONSTRAINT `user_settings_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
