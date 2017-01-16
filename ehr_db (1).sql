-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 07, 2016 at 03:44 AM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.6.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ehr_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `checkups`
--

CREATE TABLE `checkups` (
  `id` int(10) UNSIGNED NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `doctor` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `p_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `checkups`
--

INSERT INTO `checkups` (`id`, `description`, `doctor`, `p_id`, `created_at`, `updated_at`) VALUES
(10, 'asdasdsa', 'Dr. Jose Rizal', 6, '2016-12-05 05:30:07', '2016-12-05 05:30:32');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(26, '2014_10_12_100000_create_password_resets_table', 1),
(27, '2016_10_12_054555_create_posts_table', 1),
(28, '2016_12_02_110720_create_vaccines_table', 1),
(29, '2016_12_04_020009__create_users_table', 1),
(30, '2016_12_04_050824_create_checkups_table', 2),
(31, '2016_12_04_055557_d', 3),
(32, '2016_12_04_055806_create_checkups_table', 4),
(33, '2016_12_04_070924_create_checkups_table', 5),
(34, '2016_12_04_071539_checkups', 6),
(35, '2016_12_04_071709_checkup', 7),
(36, '2016_12_04_072050_checkups', 8),
(37, '2016_12_04_072137_checkup', 9),
(38, '2016_12_04_072303_checkups', 10);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(10) UNSIGNED NOT NULL,
  `pat_uname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `pat_pass` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `pat_fname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `pat_lname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `pat_bdate` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `pat_uname`, `pat_pass`, `pat_fname`, `pat_lname`, `pat_bdate`, `created_at`, `updated_at`) VALUES
(6, 'sadasd', '$2y$10$yNNtPdAlIdVGurMnX5MhDuhHPHORaKgRhxY00mkPeTXXEtviVKj86', 'Paul', 'Augustine', '2016-12-15', '2016-12-04 00:29:41', '2016-12-05 05:23:54'),
(7, 'cmeniano', '$2y$10$x4i3Vtjojmi/9QBpnYhfbuDOSxIl3EpF/0zStflOOIZEona0JdvxK', 'christian', 'Meniano', '2016-12-23', '2016-12-04 04:51:47', '2016-12-04 04:51:47');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'sadasdsadsa', 'codegeeks@gmail.com', '$2y$10$qFzewOUlVHTBzstQROaee.KtEAjCHwwDJDKO.BfC0/mGHx8cvlb2.', 'HXFL27OovrqGGnGoy4GEjTPxBV6tiBhgVuR5TYOnfXAriaQgEYuTHAA4ZKE2', '2016-12-03 18:02:13', '2016-12-06 18:43:57'),
(2, 'Christian', 'c31216@gmail.com', '$2y$10$vUE6FZQ8.b9q68IlcIj.A.cQFLa3Q4SoLPQs8K9cZ38W9QCkGnAuG', 'L4dugXpLmwH1x7gBX423zqZbn08wXmzWn7WmkQ3zpws4dA5HeZFL6mTbcqVa', '2016-12-03 18:18:24', '2016-12-03 18:18:52'),
(3, 'Christian', 'qweqwe@gmail.com', '$2y$10$Ou.Ovk8W6xsilsakNK7VYeU68kAA5t2ZcApOYp8N0SaSW6k9ucvw2', 'LDKlGrlcyS5MwqkoXnR83gXXyEXhFYMzRedkMZj4ytJbMG3PuZO9ColEF8gx', '2016-12-03 18:19:16', '2016-12-03 21:34:34');

-- --------------------------------------------------------

--
-- Table structure for table `vaccines`
--

CREATE TABLE `vaccines` (
  `id` int(10) UNSIGNED NOT NULL,
  `v_abbr` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `time_period` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `vaccines`
--

INSERT INTO `vaccines` (`id`, `v_abbr`, `time_period`, `created_at`, `updated_at`) VALUES
(1, 'BCG', 'Birth', NULL, NULL),
(2, 'HEP B1', 'Birth', NULL, NULL),
(3, 'OPV 0', 'Birth', NULL, NULL),
(4, 'HEP B2', 'Week 6', NULL, NULL),
(5, 'UPV 1', 'Week 6', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `checkups`
--
ALTER TABLE `checkups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`),
  ADD KEY `password_resets_token_index` (`token`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `posts_pat_uname_unique` (`pat_uname`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `vaccines`
--
ALTER TABLE `vaccines`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `vaccines_v_abbr_unique` (`v_abbr`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `checkups`
--
ALTER TABLE `checkups`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;
--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `vaccines`
--
ALTER TABLE `vaccines`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
