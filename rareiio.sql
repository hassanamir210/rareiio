-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 19, 2019 at 02:17 PM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rareiio`
--

-- --------------------------------------------------------

--
-- Table structure for table `applicants`
--

CREATE TABLE `applicants` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phoneNumber` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dob` date NOT NULL,
  `coverLetterPath` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cvPath` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `userId` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `applicants`
--

INSERT INTO `applicants` (`id`, `name`, `phoneNumber`, `dob`, `coverLetterPath`, `cvPath`, `userId`, `created_at`, `updated_at`) VALUES
(4, 'Hassan', '123456789', '1994-10-02', 'CoverLetter_1560928764.pdf', 'CV1560928764.pdf', 6, '2019-06-19 02:19:24', '2019-06-19 02:19:24'),
(5, 'Haseeb', '123456789', '1994-10-02', 'Some Error', 'Some Error', 7, '2019-06-19 02:26:36', '2019-06-19 02:26:36'),
(6, 'Haseeb', '123456789', '1994-10-02', 'Some Error', 'Some Error', 8, '2019-06-19 02:27:44', '2019-06-19 02:27:44'),
(7, 'Haseeb', '123456789', '1994-10-02', 'http://localhost/PROJ_MAY/Rareiio/storage/app/public/CoverLetter_1560929930.pdf', 'http://localhost/PROJ_MAY/Rareiio/storage/app/public/CV1560929930.pdf', 10, '2019-06-19 02:38:50', '2019-06-19 02:38:50'),
(8, 'Haseeb', '123456789', '1994-10-02', 'http://localhost/PROJ_MAY/Rareiio/storage/app/public/CoverLetter_1560930168.pdf', 'http://localhost/PROJ_MAY/Rareiio/storage/app/public/CV1560930168.pdf', 11, '2019-06-19 02:42:48', '2019-06-19 02:42:48'),
(9, 'Haseeb', '123456789', '1994-10-02', 'http://localhost/PROJ_MAY/Rareiio/storage/app/public/CoverLetter_1560930357.pdf', 'http://localhost/PROJ_MAY/Rareiio/storage/app/public/CV1560930357.pdf', 14, '2019-06-19 02:45:57', '2019-06-19 02:45:57');

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
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2019_06_19_054000_applicant_table', 1),
(3, '2019_06_19_054023_role_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `label` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `description`, `label`, `created_at`, `updated_at`) VALUES
(1, 'Owner Of Application', 'admin', NULL, NULL),
(2, 'Person Who Applies', 'applicant', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roleId` int(11) NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `roleId`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin@rareiio.com', '$2y$10$ROi6lv5Y9H8px9zni50NT.KH25QnqY0PjjxTjJLEkfASNNSUX742m', 1, NULL, NULL, NULL),
(6, 'applicant@rareiio.com', '$2y$10$3tm1XIn/ETYEX4RrYxPxju6kaXLkoI8qeUn6BtKgIMNWs9gB79NR2', 2, NULL, '2019-06-19 02:19:24', '2019-06-19 02:19:24'),
(7, 'haseeb@rareiio.com', '$2y$10$00ftpCmbqzf0wx3jwL.w2eE82F2GrfNSoKTbDb/C8qGIy4/Q8c9.i', 2, NULL, '2019-06-19 02:26:36', '2019-06-19 02:26:36'),
(8, 'aftab@rareiio.com', '$2y$10$xmC3kov39NNphxUBf9cBwOhV96PdHoX9h7pzaXovdl5H6HZ4rJXIq', 2, NULL, '2019-06-19 02:27:44', '2019-06-19 02:27:44'),
(10, 'aftab3@rareiio.com', '$2y$10$1EkCd2ew91UIYSxv/7ErFeUVaNeqCO3Ekvzu1g3AAE4XxIgtTsoIa', 2, NULL, '2019-06-19 02:38:50', '2019-06-19 02:38:50'),
(11, 'aftab4@rareiio.com', '$2y$10$DPLq.4FefTfIPc6xY3V1n.7PVRvN/I0Ztqiq.z.KhEx9jHi0i2tvu', 2, NULL, '2019-06-19 02:42:48', '2019-06-19 02:42:48'),
(14, 'aftab5@rareiio.com', '$2y$10$4nu6i7A96OPmNKJFE3Ec8uR/6nmaXjNKA1N7ISyvPoGu6BXJJsg3u', 2, NULL, '2019-06-19 02:45:57', '2019-06-19 02:45:57');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `applicants`
--
ALTER TABLE `applicants`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `applicants`
--
ALTER TABLE `applicants`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
