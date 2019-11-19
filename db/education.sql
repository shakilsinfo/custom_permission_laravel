-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 03, 2019 at 06:31 AM
-- Server version: 10.1.26-MariaDB
-- PHP Version: 7.1.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `education`
--

-- --------------------------------------------------------

--
-- Table structure for table `controller_name`
--

CREATE TABLE `controller_name` (
  `id` int(11) NOT NULL,
  `full_name` varchar(255) DEFAULT NULL,
  `surname` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `controller_name`
--

INSERT INTO `controller_name` (`id`, `full_name`, `surname`, `created_at`, `updated_at`) VALUES
(1, 'HomeController', 'Dashboard', '2019-04-28 01:18:56', '2019-04-28 02:22:26'),
(2, 'ProductController', 'Product', '2019-04-28 01:18:56', '2019-04-28 01:18:56'),
(3, 'CategoryController', 'Category', '2019-04-28 01:18:56', '2019-04-28 01:18:56'),
(4, 'BlogController', 'Blogs', '2019-04-28 01:18:56', '2019-04-28 01:18:56'),
(5, 'UserRoleController', 'User Roles', '2019-04-28 01:18:56', '2019-04-28 01:18:56'),
(6, 'GetControllerNameController', 'Controller List', '2019-04-28 01:18:56', '2019-04-28 01:18:56');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `phone_no` varchar(255) DEFAULT NULL,
  `fathers_name` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `role_id`, `created_at`, `updated_at`) VALUES
(1, 'Super Admin', 'admin@gmail.com', '2019-04-23 09:41:44', '$2y$12$JR4v/U1SMZGLXdqFNwp.sucCpbNGoh4lantJH9ibdgsC68DmL4u9e', NULL, 1, '2019-04-23 09:42:31', NULL),
(2, 'Accountant', 'account@gmail.com', NULL, '$2y$12$JR4v/U1SMZGLXdqFNwp.sucCpbNGoh4lantJH9ibdgsC68DmL4u9e', NULL, 2, NULL, NULL),
(3, 'Employee', 'employee@gmail.com', NULL, '$2y$12$JR4v/U1SMZGLXdqFNwp.sucCpbNGoh4lantJH9ibdgsC68DmL4u9e', NULL, 3, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_role`
--

CREATE TABLE `user_role` (
  `id` int(11) NOT NULL,
  `role_name` varchar(100) DEFAULT NULL,
  `user_role` text,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_role`
--

INSERT INTO `user_role` (`id`, `role_name`, `user_role`, `created_at`, `updated_at`) VALUES
(1, 'Super Admin', NULL, '2019-04-24 09:09:29', NULL),
(2, 'Accountant', '{\"HomeController\":{\"controller_name\":\"HomeController\",\"view\":\"1\"},\"ProductController\":{\"controller_name\":\"ProductController\",\"view\":\"1\",\"add_edit\":\"1\"},\"CategoryController\":{\"controller_name\":\"CategoryController\",\"view\":\"1\",\"delete\":\"1\"},\"BlogController\":{\"controller_name\":\"BlogController\",\"view\":\"1\",\"add_edit\":\"1\"},\"GetControllerNameController\":{\"controller_name\":\"GetControllerNameController\",\"view\":\"1\"}}', '2019-04-24 09:09:45', '2019-04-28 03:24:48'),
(3, 'Employee', NULL, '2019-04-24 09:09:58', NULL),
(4, 'Student', NULL, '2019-04-24 09:10:11', NULL),
(5, 'Operator', NULL, '2019-04-24 09:10:30', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `controller_name`
--
ALTER TABLE `controller_name`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role_id` (`role_id`);

--
-- Indexes for table `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `controller_name`
--
ALTER TABLE `controller_name`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `user_role`
--
ALTER TABLE `user_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
