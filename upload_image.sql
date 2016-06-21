-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 21, 2016 at 08:52 PM
-- Server version: 5.7.12-0ubuntu1
-- PHP Version: 7.0.4-7ubuntu2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `upload_image`
--

-- --------------------------------------------------------

--
-- Table structure for table `albums`
--

CREATE TABLE `albums` (
  `id` int(10) UNSIGNED NOT NULL,
  `album_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `album_title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `album_description` text COLLATE utf8_unicode_ci,
  `likes` text COLLATE utf8_unicode_ci,
  `views` int(11) DEFAULT '0',
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `comment_albums`
--

CREATE TABLE `comment_albums` (
  `id` int(10) UNSIGNED NOT NULL,
  `comment_content` text COLLATE utf8_unicode_ci NOT NULL,
  `likes` text COLLATE utf8_unicode_ci,
  `comment_status` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `album_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `comment_images`
--

CREATE TABLE `comment_images` (
  `id` int(10) UNSIGNED NOT NULL,
  `comment_content` text COLLATE utf8_unicode_ci NOT NULL,
  `likes` text COLLATE utf8_unicode_ci,
  `comment_status` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `image_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `conversations`
--

CREATE TABLE `conversations` (
  `id` int(10) UNSIGNED NOT NULL,
  `from` int(11) NOT NULL,
  `to` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `conversations`
--

INSERT INTO `conversations` (`id`, `from`, `to`, `created_at`, `updated_at`) VALUES
(2, 1, 4, '2016-06-20 23:32:41', '2016-06-20 23:32:41'),
(3, 1, 5, '2016-06-21 03:38:52', '2016-06-21 03:41:11'),
(4, 1, 3, '2016-06-21 03:38:56', '2016-06-21 03:41:36'),
(5, 1, 2, '2016-06-21 03:39:00', '2016-06-21 03:41:38');

-- --------------------------------------------------------

--
-- Table structure for table `friendships`
--

CREATE TABLE `friendships` (
  `id` int(10) UNSIGNED NOT NULL,
  `from` int(11) NOT NULL,
  `to` int(11) NOT NULL,
  `accepted` int(11) NOT NULL DEFAULT '0',
  `seen` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `id` int(10) UNSIGNED NOT NULL,
  `image_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `fullsize_url` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `avatar_url` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cover_url` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `show_on_timeline_url` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `image_size` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `image_caption` text COLLATE utf8_unicode_ci NOT NULL,
  `likes` text COLLATE utf8_unicode_ci,
  `views` int(11) DEFAULT '0',
  `user_id` int(11) NOT NULL,
  `album_id` int(11) NOT NULL,
  `make_as_profile_picture` int(11) NOT NULL DEFAULT '0',
  `make_as_cover_photo` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(10) UNSIGNED NOT NULL,
  `from` int(11) NOT NULL,
  `to` int(11) NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `attachment_url` text COLLATE utf8_unicode_ci,
  `read` int(11) NOT NULL DEFAULT '0',
  `conversation_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `from`, `to`, `content`, `attachment_url`, `read`, `conversation_id`, `created_at`, `updated_at`) VALUES
(2, 1, 4, 'hi guys', NULL, 0, 2, '2016-06-20 23:32:41', '2016-06-20 23:32:41'),
(3, 1, 4, 'yeyey', NULL, 0, 2, '2016-06-20 23:35:34', '2016-06-20 23:35:34'),
(4, 1, 5, 'haha', NULL, 0, 3, '2016-06-21 03:38:52', '2016-06-21 03:38:52'),
(5, 1, 3, 'xx', NULL, 0, 4, '2016-06-21 03:38:56', '2016-06-21 03:38:56'),
(6, 1, 2, 'zzzz', NULL, 0, 5, '2016-06-21 03:39:00', '2016-06-21 03:39:00'),
(7, 1, 5, 'leen', NULL, 0, 3, '2016-06-21 03:39:13', '2016-06-21 03:39:13'),
(8, 1, 5, 'lelee', NULL, 0, 3, '2016-06-21 03:39:43', '2016-06-21 03:39:43'),
(9, 1, 5, 'xxxx', NULL, 0, 3, '2016-06-21 03:41:11', '2016-06-21 03:41:11'),
(10, 1, 3, 'founder', NULL, 0, 4, '2016-06-21 03:41:29', '2016-06-21 03:41:29'),
(11, 1, 3, 'roi', NULL, 0, 4, '2016-06-21 03:41:35', '2016-06-21 03:41:35'),
(12, 1, 3, 'ngon', NULL, 0, 4, '2016-06-21 03:41:36', '2016-06-21 03:41:36'),
(13, 1, 2, 'haha', NULL, 0, 5, '2016-06-21 03:41:38', '2016-06-21 03:41:38');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`migration`, `batch`) VALUES
('2014_10_12_000000_create_users_table', 1),
('2014_10_12_100000_create_password_resets_table', 1),
('2016_01_01_080032_create_album_table', 1),
('2016_01_01_080517_create_images_table', 1),
('2016_01_01_081245_create_comment_image_table', 1),
('2016_01_01_081516_create_comment_albums_table', 1),
('2016_04_22_173020_create_roles_table', 1),
('2016_04_22_173209_create_user_roles_table', 1),
('2016_05_24_032353_create_messages_table', 1),
('2016_05_29_102650_create_friendships_table', 1),
('2016_06_04_093627_create_conversations_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `description`, `slug`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'dMncWd41v9@gmail.com', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 'author', 'CHEsYemrVY@gmail.com', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 'user', '5qvSElAAju@gmail.com', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `sex` varchar(12) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `birthday` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `friends` text COLLATE utf8_unicode_ci,
  `skip_add_info` int(11) NOT NULL DEFAULT '0',
  `online` int(11) NOT NULL DEFAULT '0',
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `sex`, `address`, `birthday`, `description`, `friends`, `skip_add_info`, `online`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Administrator', 'phumaster.dev@gmail.com', '$2y$10$brlFRyUCBgEEd0dk8RlWR.bSkFfII3kbMFpwkP76rqFdSyjvNaaAW', 'male', 'Hà Nội (TP)', NULL, NULL, '{"2":0,"3":0,"4":0.1,"5":0.2}', 1, 0, 'uxHm9kJUOwEjJuXFq1GYKo59sMk0CiMBoc0xw2mytTXV1OZBg36QYmbk7rZH', '0000-00-00 00:00:00', '2016-06-20 23:54:43'),
(2, 'Phú Master', 'phumaster@gmail.com', '$2y$10$40t8Kf7wLaV/5UedtgnTk.dj.QKrV0.JMbntoa4lO0Bmoe6IsWpM2', NULL, NULL, NULL, NULL, '{"1":0,"3":0.2,"4":0}', 0, 0, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 'Phú Founder', 'phufounder@gmail.com', '$2y$10$WcpRO21y9lk8mOlEdrlKTuA07KEaBkFFFEHhiPZo1HdW/zeWa7ub.', NULL, NULL, NULL, NULL, '{"1":0,"2":0.1,"4":0}', 0, 0, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 'Phú Monster', 'phumonster@gmail.com', '$2y$10$ptyUATbjzv//RJo3HDHwgODZCQTptdu6vK9DUNM3c2vSgvQRtVb/O', NULL, NULL, NULL, NULL, '{"1":0,"2":0.4,"3":0}', 0, 0, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, 'Phú Cốt Đờ', 'phucoder@gmail.com', '$2y$10$QSWL0CID/7qDPYBq.FD9f.X7uBaTEOCPUso0RllW05.t1okNyRz2y', NULL, NULL, NULL, NULL, '{"1":0,"2":0.4,"3":0}', 0, 0, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `user_roles`
--

CREATE TABLE `user_roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL DEFAULT '3',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user_roles`
--

INSERT INTO `user_roles` (`id`, `user_id`, `role_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 2, 2, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 3, 2, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 4, 3, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, 5, 2, '0000-00-00 00:00:00', '0000-00-00 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `albums`
--
ALTER TABLE `albums`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comment_albums`
--
ALTER TABLE `comment_albums`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comment_images`
--
ALTER TABLE `comment_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `conversations`
--
ALTER TABLE `conversations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `friendships`
--
ALTER TABLE `friendships`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`),
  ADD KEY `password_resets_token_index` (`token`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `user_roles`
--
ALTER TABLE `user_roles`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `albums`
--
ALTER TABLE `albums`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `comment_albums`
--
ALTER TABLE `comment_albums`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `comment_images`
--
ALTER TABLE `comment_images`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `conversations`
--
ALTER TABLE `conversations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `friendships`
--
ALTER TABLE `friendships`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `user_roles`
--
ALTER TABLE `user_roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
