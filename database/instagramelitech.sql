-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 17, 2024 at 05:51 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `instagramelitech`
--

-- --------------------------------------------------------

--
-- Table structure for table `archives`
--

CREATE TABLE `archives` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `post_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `caption` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `post_id` bigint(20) UNSIGNED DEFAULT NULL,
  `comment` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `user_id`, `post_id`, `comment`, `created_at`, `updated_at`) VALUES
(6, 2, 15, 'belum mandi', '2024-10-16 20:14:48', '2024-10-16 20:14:48'),
(7, 2, 13, 'lucu', '2024-10-16 20:14:55', '2024-10-16 20:14:55'),
(8, 1, 17, 'mantap om', '2024-10-16 20:16:04', '2024-10-16 20:16:04'),
(9, 3, 19, 'bagus', '2024-10-16 20:18:50', '2024-10-16 20:18:50'),
(10, 3, 18, 'lucu', '2024-10-16 20:18:58', '2024-10-16 20:18:58'),
(11, 3, 17, 'oke om', '2024-10-16 20:20:32', '2024-10-16 20:20:32'),
(12, 3, 15, 'hihi', '2024-10-16 20:20:41', '2024-10-16 20:20:41'),
(13, 3, 13, 'makasi', '2024-10-16 20:20:50', '2024-10-16 20:20:50'),
(14, 3, 20, 'lagi', '2024-10-16 20:39:48', '2024-10-16 20:39:48'),
(15, 3, 19, 'ya', '2024-10-16 20:39:54', '2024-10-16 20:39:54');

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `post_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `likes`
--

INSERT INTO `likes` (`id`, `created_at`, `updated_at`, `user_id`, `post_id`) VALUES
(31, '2024-10-16 20:10:54', '2024-10-16 20:10:54', 3, 13),
(32, '2024-10-16 20:11:03', '2024-10-16 20:11:03', 3, 12),
(33, '2024-10-16 20:11:37', '2024-10-16 20:11:37', 3, 15),
(34, '2024-10-16 20:11:39', '2024-10-16 20:11:39', 3, 14),
(35, '2024-10-16 20:14:42', '2024-10-16 20:14:42', 2, 15),
(36, '2024-10-16 20:14:59', '2024-10-16 20:14:59', 2, 13),
(37, '2024-10-16 20:15:29', '2024-10-16 20:15:29', 2, 16),
(38, '2024-10-16 20:15:59', '2024-10-16 20:15:59', 1, 17),
(39, '2024-10-16 20:16:13', '2024-10-16 20:16:13', 1, 16),
(41, '2024-10-16 20:17:36', '2024-10-16 20:17:36', 1, 19),
(42, '2024-10-16 20:17:38', '2024-10-16 20:17:38', 1, 18),
(43, '2024-10-16 20:18:21', '2024-10-16 20:18:21', 1, 20),
(45, '2024-10-16 20:18:46', '2024-10-16 20:18:46', 3, 19),
(46, '2024-10-16 20:19:02', '2024-10-16 20:19:02', 3, 18),
(47, '2024-10-16 20:20:22', '2024-10-16 20:20:22', 3, 20);

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
(1, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(2, '2024_10_13_180739_create_comments_table', 1),
(3, '2024_10_13_180749_create_likes_table', 1),
(4, '2024_10_14_033416_create_users_table', 1),
(5, '2024_10_14_033449_create_posts_table', 1),
(6, '2024_10_14_033810_create_archives_table', 1),
(7, '2024_10_14_041837_create_profiles_table', 2),
(8, '2024_10_14_052821_add_caption_to_posts_table', 2),
(9, '2024_10_14_054040_remove_content_from_posts_table', 3),
(10, '2024_10_14_054158_add_content_to_posts_table', 4),
(11, '2024_10_14_054730_add_post_id_to_comments_table', 5),
(12, '2024_10_16_073707_create_settings_table', 6),
(13, '2024_10_16_073954_drop_username_from_users_table', 6),
(14, '2024_10_16_092757_add_likes_count_to_posts_table', 7),
(16, '2024_10_16_093535_modify_likes_table', 8),
(17, '2024_10_16_093551_add_likes_count_to_posts_table', 8),
(18, '2024_10_16_102137_add_comment_column_to_comments_table', 9),
(19, '2024_10_16_102436_add_user_id_and_post_id_to_comments_table', 10);

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
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `caption` varchar(255) NOT NULL,
  `media_type` varchar(255) DEFAULT NULL,
  `media_path` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `content` varchar(255) DEFAULT NULL,
  `likes_count` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `user_id`, `caption`, `media_type`, `media_path`, `created_at`, `updated_at`, `content`, `likes_count`) VALUES
(12, 3, 'kucing', 'image', 'posts/cBXRjKB6u6ipEvRO1CGKSTafYltEVYCtF6zo8tpP.jpg', '2024-10-13 20:07:21', '2024-10-13 20:11:03', 'kucing', 1),
(13, 3, 'kucing', 'image', 'posts/2tsiIoheygIVxlFVa0MQmlfA74JzdMWKi5sCDWn6.jpg', '2024-10-14 20:09:11', '2024-10-14 20:14:59', 'kucing', 2),
(14, 3, 'kucing lagi', 'image', 'posts/damNWbx0IUZKUiXGsE5hVqtHhx4HqyduC5YbmCAS.jpg', '2024-10-15 20:11:16', '2024-10-15 20:11:39', 'kucing lagi', 1),
(15, 3, 'satu lagi', 'image', 'posts/OsopFoRgVzdqoYCnnlTSZsXIKJLFmpPYBKdzg8qZ.png', '2024-10-16 20:11:35', '2024-10-16 20:14:42', 'satu lagi', 2),
(16, 2, 'hitam', 'image', 'posts/ntrmP3EtG3MZvYLY7vPWf2DHpqsQwxmacOUnTqwS.jpg', '2024-10-11 20:15:24', '2024-10-11 20:16:13', 'hitam', 2),
(17, 2, 'bagus gk? hihi', 'image', 'posts/nQNvhzhOkbhIVFhA9T56SGVJC4y5y3Kb80Q2fa3Z.jpg', '2024-10-12 20:15:47', '2024-10-12 20:15:59', 'bagus gk? hihi', 1),
(18, 1, 'kiw', 'video', 'posts/WeCKm497H92B751ZadHto3rQ5XBtDQC0Ub0cTVfJ.mp4', '2024-10-09 20:17:12', '2024-10-09 20:19:02', 'kiw', 2),
(19, 1, 'tom haye', 'video', 'posts/rWLBjSJbKz7Gt0zIaHJvRZGQsH6XOHja8iGhlAAZ.mp4', '2024-10-16 20:17:32', '2024-10-16 20:18:46', 'tom haye', 2),
(20, 1, 'video lagi', 'video', 'posts/FpnA2Y3I5yZG4lWVbxTT5ERttQVsMkixypDpXnHd.mp4', '2024-10-16 20:18:18', '2024-10-16 20:20:22', 'video lagi', 2);

-- --------------------------------------------------------

--
-- Table structure for table `profiles`
--

CREATE TABLE `profiles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `feeds_per_row` int(11) NOT NULL DEFAULT 3,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `user_id`, `feeds_per_row`, `created_at`, `updated_at`) VALUES
(1, 1, 4, '2024-10-16 00:49:07', '2024-10-16 19:50:25'),
(2, 1, 4, '2024-10-16 00:49:17', '2024-10-16 00:49:17'),
(3, 1, 4, '2024-10-16 00:49:21', '2024-10-16 00:49:21'),
(4, 1, 2, '2024-10-16 00:56:07', '2024-10-16 00:56:07'),
(5, 1, 2, '2024-10-16 00:56:12', '2024-10-16 00:56:12'),
(6, 1, 1, '2024-10-16 00:56:16', '2024-10-16 00:56:16'),
(7, 1, 4, '2024-10-16 01:46:46', '2024-10-16 01:46:46'),
(8, 3, 4, '2024-10-16 20:19:09', '2024-10-16 20:19:32');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `profile_picture` varchar(255) DEFAULT NULL,
  `bio` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `profile_picture`, `bio`, `created_at`, `updated_at`) VALUES
(1, 'ugik', 'ugik@gmail.com', '$2y$12$pSBujThd9fSHwsd4SFa2/uxqkuc.Jdk6/BaXA0NG8ffyG2.zB6BJ.', 'images/profile/1729133823.png', 'wawawa', '2024-10-11 20:45:19', '2024-10-16 19:57:03'),
(2, 'hendra admaja', 'hendra@gmail.com', '$2y$12$frIg1iybFe1ikshO2G5rxeiAL66fVWucZPMDvP7u7ctrXOAHJMlVC', 'images/profile/1729101545.jpg', 'qiww', '2024-10-12 23:18:13', '2024-10-16 10:59:05'),
(3, 'nalenn', 'nalen@gmail.com', '$2y$12$iI6eG/T6ShE0X3A4.BYz.edx9hn84L/upSLjD0MBxR8GIFyjbfIbS', 'images/profile/1729136372.jpeg', 'suka kucingg', '2024-10-16 11:00:03', '2024-10-16 20:39:32');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `archives`
--
ALTER TABLE `archives`
  ADD PRIMARY KEY (`id`),
  ADD KEY `archives_post_id_foreign` (`post_id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `comments_post_id_foreign` (`post_id`),
  ADD KEY `comments_user_id_foreign` (`user_id`);

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `likes_user_id_post_id_unique` (`user_id`,`post_id`),
  ADD KEY `likes_post_id_foreign` (`post_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `posts_user_id_foreign` (`user_id`);

--
-- Indexes for table `profiles`
--
ALTER TABLE `profiles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `settings_user_id_foreign` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `archives`
--
ALTER TABLE `archives`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `profiles`
--
ALTER TABLE `profiles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `archives`
--
ALTER TABLE `archives`
  ADD CONSTRAINT `archives_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `comments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `likes`
--
ALTER TABLE `likes`
  ADD CONSTRAINT `likes_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `likes_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `settings`
--
ALTER TABLE `settings`
  ADD CONSTRAINT `settings_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
