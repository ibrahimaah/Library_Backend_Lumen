-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 12, 2021 at 06:57 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `motaliaa_library`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `author` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `approved` tinyint(4) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`id`, `title`, `description`, `author`, `approved`) VALUES
(2, 'new title', 'new desc', 'new auth', 1),
(3, 'باب السلام', 'وصف الكتاب الأستاذ الدكتور عبدالوهاب إبراهيم أبو سليمان', 'الأستاذ الدكتور عبدالوهاب إبراهيم أبو سليمان', 1),
(7, 'التحفة في أحكام العمرة والمسجد الحرام', 'None', 'فهد العماري', 1),
(10, 'رعاية المقاصد في فقه ابي بكر الصديق', 'None', 'التلمساني', 1),
(16, 'نفحات من الأدب الإسلامي', 'ھﺬه ﻣﺬﻛﺮات ﻓﻲ اﻷدب اﻹﺳﻼﻣﻲ، وﺿﻌﮫﺎ اﻟﻤﺆﻟﻒ ﻟﻄﻼﺑﻪ ﻓﻲ اﻟﻤﻌﺎھﺪ اﻟﺸﺮﻋﯿﺔ، وﻓﻲ دار ﻧﮫﻀﺔ اﻟﻌﻠﻮم اﻟﺸﺮﻋﯿﺔ ﺑﺤﻠﺐ. ھﺬا اﻷدب اﻟﺤﻲ اﻟﺬي ﻳﻌﺒﺮ ﻋﻦ ﻋﻘﯿﺪة ﺻﺎﺣﺒﻪ ﺑﺼﺪق وو ﺿﻮح، ﻣﻦ ﺧﻼل اﻟﺘﺼﻮر اﻹﺳﻼﻣﻲ، واﻟﺬي ﻳﻌﺎﻟﺞ ﻣﺸﻜﻼت اﻷﻣﺔ اﻹﺳﻼﻣﯿﺔ، ﻳﺘﺤﺴﺲ آﻻﻣﮫﺎ، وﻳﻠﻤﺲ ﺟﺮاﺣﮫﺎ، ﻓﺘﺒﺘﺴﻢ ھﺬه اﻟﺠﺮاح وﺗﺴﯿﻞ دﻣﻮﻋﺎً ﺻﺎﻓﯿﺔ ﻣﻦ ﻣﺂﻗﯿﻪ. ذﻟﻚ اﻷدب اﻟﺬي ظﻠﻢ ﻣﻦ أﺑﻨﺎﺋﻪ أﻛﺜﺮ ﻣﻤﺎ ظﻠﻢ ﻣﻦ أﻋﺪاﺋ عرضﺿﻮح، ﻣﻦ ﺧﻼل اﻟﺘﺼﻮر اﻹﺳﻼﻣﻲ، واﻟﺬي ﻳﻌﺎﻟﺞ ﻣﺸﻜﻼت اﻷﻣﺔ اﻹﺳﻼﻣﯿﺔ، ﻳﺘﺤﺴﺲ آﻻﻣﮫﺎ، وﻳﻠﻤﺲ ﺟﺮاﺣﮫﺎ، ﻓﺘﺒﺘﺴﻢ ھﺬه اﻟﺠﺮاح وﺗﺴﯿﻞ دﻣﻮﻋﺎً ﺻﺎﻓﯿﺔ ﻣﻦ ﻣﺂﻗﯿﻪ. ذﻟﻚ اﻷدب اﻟﺬي ظﻠﻢ ﻣﻦ أﺑﻨﺎﺋﻪ أﻛﺜﺮ ﻣﻤﺎ ظﻠﻢ ﻣﻦ أﻋﺪاﺋ', 'محمد الصابوني', 1),
(77, 'الطيبات من الرزق', 'None', 'ابي ذر القلموني', 1),
(89, 'روائع من أدب الدعوة في القرآن والسيرة', 'None', 'أبي الحسن علي الحسني الندوي', 1),
(90, 'دعوة غير المسلمين إلى الإسلام في المجتمع الإسلامي', 'None', 'عبدالله  اللحيدان', 1),
(91, 'صورة الرسول صلى الله عليه وسلم في القرآن بين الملك والإنسان', 'None', 'سامي الموصلي', 0),
(92, 'رواد عالم الآثار في العراق', 'None', 'سالم الآلوسي', 0),
(94, 'الدر الموصول في مدح آل الرسول', 'None', 'لا يوجد', 0),
(98, 'تدبر سورة القصص', 'None', 'ناصر  العمر', 1),
(101, 'aaaa', 'aaaa', 'aaaa', 1),
(102, 'book title 1', 'book desc 1', 'book author', 1);

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `comment` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `post_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `comment`, `post_id`, `user_id`, `created_at`, `updated_at`) VALUES
(4, 'Qui eligendi et nemo.', 2, 1, '2021-11-12 16:01:21', '2021-11-12 16:01:21'),
(5, 'Aut officiis voluptatem ab vero.', 2, 1, '2021-11-12 16:01:21', '2021-11-12 16:01:21'),
(6, 'Recusandae odit officia et in vitae quod et.', 2, 1, '2021-11-12 16:01:21', '2021-11-12 16:01:21');

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
(1, '2021_11_11_100857_create_users_table', 1),
(2, '2021_11_12_091726_create_posts_table', 1),
(3, '2021_11_12_153647_create_comments_table', 1),
(4, '2021_11_12_162016_create_admins_table', 2),
(5, '2021_11_12_162436_create_books_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `body` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `title`, `body`, `user_id`, `created_at`, `updated_at`) VALUES
(2, 'Iure facilis maiores vel distinctio voluptas nulla quia.', 'Voluptas maxime doloremque ut et sed voluptas eos dicta. Ut recusandae eius dolor alias commodi aspernatur in est. Dolor perspiciatis ut nemo quis.', 1, '2021-11-12 15:45:42', '2021-11-12 15:45:42'),
(3, 'Enim commodi eum ullam ut ut.', 'Rerum aperiam aspernatur fugiat. Incidunt ea quo quis autem sint et et. Fugiat voluptatibus nulla est sit dolores eveniet.', 1, '2021-11-12 15:45:42', '2021-11-12 15:45:42');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `name`, `password`) VALUES
(1, 'jZKfyMfPPX', 'Mrs. Elisha Feil', '$2y$10$dvg0jvPus0O.DKeF/uAKXeIGou4Dc03xoLb.VKidWj6fffMYqsU3S'),
(2, 'QWkRAVYS9u', 'Zachary Ryan', '$2y$10$dvg0jvPus0O.DKeF/uAKXeIGou4Dc03xoLb.VKidWj6fffMYqsU3S'),
(3, 'NCmhuoPxYJ', 'Max Runolfsdottir', '$2y$10$dvg0jvPus0O.DKeF/uAKXeIGou4Dc03xoLb.VKidWj6fffMYqsU3S'),
(4, 'aaa', 'ib', '$2y$10$/wjpg/iZNz1MXNJumR.2x./oa6kdZ143ZHevF6W5j53hZ0MwFRLdq'),
(5, 'a', 'b', 'c');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_username_unique` (`username`);

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `books_title_unique` (`title`) USING HASH;

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `comments_post_id_foreign` (`post_id`),
  ADD KEY `comments_user_id_foreign` (`user_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `posts_user_id_foreign` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

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
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
