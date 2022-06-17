-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Време на генериране: 31 май 2022 в 13:17
-- Версия на сървъра: 10.4.22-MariaDB
-- Версия на PHP: 8.0.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данни: `mvc_testing`
--

-- --------------------------------------------------------

--
-- Структура на таблица `activity`
--

DROP TABLE IF EXISTS `activity`;
CREATE TABLE `activity` (
  `Id` int(11) NOT NULL,
  `task_id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `time` time NOT NULL,
  `description` varchar(255) NOT NULL,
  `status` smallint(3) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Схема на данните от таблица `activity`
--

INSERT INTO `activity` (`Id`, `task_id`, `project_id`, `user_id`, `name`, `time`, `description`, `status`, `created_at`, `updated_at`) VALUES
(1, 2, 1, 4, 'dr', '03:30:00', 'dd', 130, '2022-05-29 15:36:57', '2022-05-20 17:51:23'),
(3, 2, 6, 2, 'test', '03:30:00', 'test', 100, '2022-05-29 16:40:25', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Структура на таблица `client`
--

DROP TABLE IF EXISTS `client`;
CREATE TABLE `client` (
  `Id` int(11) UNSIGNED NOT NULL,
  `owner_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `vat` varchar(255) NOT NULL,
  `status` smallint(5) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `service` smallint(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Схема на данните от таблица `client`
--

INSERT INTO `client` (`Id`, `owner_id`, `name`, `address`, `email`, `phone`, `vat`, `status`, `created_at`, `updated_at`, `service`) VALUES
(1, 0, 'BRIGHT PHP', '', 'drashko1979@gmail.com', '0889623331', '123343289', 20, '2022-05-25 16:33:07', '2022-05-27 15:01:43', NULL);

-- --------------------------------------------------------

--
-- Структура на таблица `message`
--

DROP TABLE IF EXISTS `message`;
CREATE TABLE `message` (
  `Id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `message` varchar(1024) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Схема на данните от таблица `message`
--

INSERT INTO `message` (`Id`, `name`, `email`, `message`, `created_at`) VALUES
(1, 'test', 'drashko1979@gmail.com', 'test mesg', '2022-05-10 19:50:27');

-- --------------------------------------------------------

--
-- Структура на таблица `permission`
--

DROP TABLE IF EXISTS `permission`;
CREATE TABLE `permission` (
  `Id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `code` varchar(32) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Схема на данните от таблица `permission`
--

INSERT INTO `permission` (`Id`, `name`, `description`, `code`, `created_at`, `updated_at`) VALUES
(1, 'user_view', '', 'USER', '2022-05-10 06:05:31', '2022-05-10 06:11:31'),
(2, 'user_create', '', 'USER', '2022-05-10 06:27:31', '2022-05-10 06:33:31'),
(3, 'user_update', '', 'USER', '2022-05-10 06:48:31', '2022-05-11 04:26:09'),
(4, 'user_delete', '', 'USER', '2022-05-10 06:59:31', '2022-05-11 04:34:09');

-- --------------------------------------------------------

--
-- Структура на таблица `project`
--

DROP TABLE IF EXISTS `project`;
CREATE TABLE `project` (
  `Id` int(11) NOT NULL,
  `manager_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `start_date` datetime NOT NULL,
  `end_date` datetime NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Схема на данните от таблица `project`
--

INSERT INTO `project` (`Id`, `manager_id`, `client_id`, `name`, `description`, `start_date`, `end_date`, `created_at`, `updated_at`, `status`) VALUES
(1, 1, 1, 'BRIGHT PHP OOP FRAMEWORK', 'A small php framework based on php oop and entity -repository pattern', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2022-05-25 17:54:13', '2022-05-27 10:46:39', '130'),
(6, 0, 0, 'Test project', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2022-05-29 16:20:02', '0000-00-00 00:00:00', '100');

-- --------------------------------------------------------

--
-- Структура на таблица `role`
--

DROP TABLE IF EXISTS `role`;
CREATE TABLE `role` (
  `Id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Схема на данните от таблица `role`
--

INSERT INTO `role` (`Id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Super Administrator', '', '2022-05-10 06:12:27', '2022-05-10 06:12:27'),
(2, 'Administrator', '', '2022-05-10 06:21:27', '2022-05-10 06:21:27'),
(3, 'Clinet', '', '2022-05-10 06:29:28', '2022-05-10 06:29:28'),
(4, 'Customer', '', '2022-05-10 06:38:28', '2022-05-10 06:38:28'),
(5, 'User', '', '2022-05-10 06:54:28', '2022-05-10 06:54:28'),
(6, 'Guest', '', '2022-05-10 06:04:29', '2022-05-10 06:04:29');

-- --------------------------------------------------------

--
-- Структура на таблица `role_permission`
--

DROP TABLE IF EXISTS `role_permission`;
CREATE TABLE `role_permission` (
  `Id` int(11) UNSIGNED NOT NULL,
  `role_id` int(11) UNSIGNED NOT NULL,
  `permission_id` int(11) UNSIGNED NOT NULL,
  `created_at` varchar(255) NOT NULL,
  `updated_at` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Схема на данните от таблица `role_permission`
--

INSERT INTO `role_permission` (`Id`, `role_id`, `permission_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2022-05-10 18:32:17', '2022-05-10 18:32:17'),
(2, 1, 2, '2022-05-10 18:32:17', '2022-05-10 18:32:17'),
(3, 1, 3, '2022-05-10 18:32:17', '2022-05-10 18:32:17'),
(4, 1, 4, '2022-05-10 18:32:17', '2022-05-10 18:32:17'),
(5, 2, 1, '2022-05-10 18:45:07', '2022-05-10 18:45:07'),
(6, 2, 2, '2022-05-10 18:45:07', '2022-05-10 18:45:07'),
(7, 2, 3, '2022-05-10 18:45:07', '2022-05-10 18:45:07'),
(8, 4, 1, '2022-05-13 10:51:57', '2022-05-13 10:51:57'),
(9, 4, 2, '2022-05-13 10:51:57', '2022-05-13 10:51:57'),
(10, 5, 1, '2022-05-13 10:52:05', '2022-05-13 10:52:05');

-- --------------------------------------------------------

--
-- Структура на таблица `task`
--

DROP TABLE IF EXISTS `task`;
CREATE TABLE `task` (
  `Id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `text` varchar(1024) NOT NULL,
  `time` time DEFAULT '00:00:00',
  `status` smallint(3) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Схема на данните от таблица `task`
--

INSERT INTO `task` (`Id`, `user_id`, `project_id`, `name`, `text`, `time`, `status`, `created_at`, `updated_at`) VALUES
(2, 2, 1, 'task 1', 'ewtwert', '03:00:00', 130, '2022-05-29 16:13:57', '0000-00-00 00:00:00'),
(3, 4, 1, 'task 2', 'werew', '01:00:00', 100, '2022-05-29 16:14:10', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Структура на таблица `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `Id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `status` smallint(5) NOT NULL,
  `failed_logins` int(11) NOT NULL,
  `last_failed_login` datetime DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` datetime NOT NULL,
  `service` tinyint(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Схема на данните от таблица `users`
--

INSERT INTO `users` (`Id`, `role_id`, `name`, `email`, `password`, `phone`, `address`, `status`, `failed_logins`, `last_failed_login`, `created_at`, `updated_at`, `service`) VALUES
(2, 230, 'Ventzi', 'drashko19798@gmial.com', '$2y$10$FgofPbcL1DcsU3hWMK.SJ.eevDxEIr2u55tcPv9oQARtAsBRIeGQi', '3124312', 'reww', 10, 0, NULL, '2022-05-29 17:15:37', '2022-05-29 04:37:15', 0),
(3, 250, 'Mitaka', 'drashko1978@gmail.com', '$2y$10$1RxDgQMG4l9huxgom.TvNOm0G16t7hOLbobCArZMXth2Q/8S/an0m', '324532', 'reww', 30, 0, NULL, '2022-05-29 17:15:24', '2022-05-29 04:24:15', 0),
(4, 200, 'Drashko', 'drashko1979@gmail.com', '$2y$10$he84g1dBiTPTx//gKXJg4OUmUdhczDoJ6UbG9TlU1Wedap/snQuhe', '0889623331', 'Borovo ul. Ladoga, bl. 218 entr, Z', 20, 0, NULL, '2022-05-29 08:25:11', '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

--
-- Структура на таблица `user_session`
--

DROP TABLE IF EXISTS `user_session`;
CREATE TABLE `user_session` (
  `Id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `hash` varchar(255) NOT NULL,
  `expires_at` datetime NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Схема на данните от таблица `user_session`
--

INSERT INTO `user_session` (`Id`, `user_id`, `hash`, `expires_at`, `created_at`) VALUES
(1, 1, '9aa4c8faa056843c1391ec0d5f33fe1aa54542985862b6108b88b408b546773d', '2022-06-19 11:02:13', '0000-00-00 00:00:00'),
(2, 1, '14df617971d85c252a23ade71a89998c48f4433f76efc4bd7b1889dcd683566b', '2022-06-23 12:02:36', '0000-00-00 00:00:00'),
(4, 4, 'af0160771f66262d61e88fa05aa232f0899a277360c45a7a39d5abdd5e479ff3', '2022-06-28 08:17:37', '0000-00-00 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Индекси за таблица `activity`
--
ALTER TABLE `activity`
  ADD PRIMARY KEY (`Id`);

--
-- Индекси за таблица `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`Id`);

--
-- Индекси за таблица `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`Id`);

--
-- Индекси за таблица `permission`
--
ALTER TABLE `permission`
  ADD PRIMARY KEY (`Id`);

--
-- Индекси за таблица `project`
--
ALTER TABLE `project`
  ADD PRIMARY KEY (`Id`);

--
-- Индекси за таблица `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`Id`);

--
-- Индекси за таблица `role_permission`
--
ALTER TABLE `role_permission`
  ADD PRIMARY KEY (`Id`);

--
-- Индекси за таблица `task`
--
ALTER TABLE `task`
  ADD PRIMARY KEY (`Id`);

--
-- Индекси за таблица `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`Id`);

--
-- Индекси за таблица `user_session`
--
ALTER TABLE `user_session`
  ADD PRIMARY KEY (`Id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activity`
--
ALTER TABLE `activity`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `client`
--
ALTER TABLE `client`
  MODIFY `Id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `permission`
--
ALTER TABLE `permission`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `project`
--
ALTER TABLE `project`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `role_permission`
--
ALTER TABLE `role_permission`
  MODIFY `Id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `task`
--
ALTER TABLE `task`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user_session`
--
ALTER TABLE `user_session`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
