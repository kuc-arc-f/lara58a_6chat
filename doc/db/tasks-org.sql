-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- ホスト: 127.0.0.1
-- 生成日時: 
-- サーバのバージョン： 10.4.6-MariaDB
-- PHP のバージョン: 7.3.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- データベース: `laravel`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `tasks`
--

CREATE TABLE `tasks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- テーブルのデータのダンプ `tasks`
--

INSERT INTO `tasks` (`id`, `title`, `content`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'a1111', 'aaa111', '2019-12-08 17:45:57', '2019-12-10 14:57:14', '2019-12-10 14:57:14'),
(2, 'abbb', 'c111', '2019-12-08 17:46:11', '2019-12-10 14:57:13', '2019-12-10 14:57:13'),
(4, 'aaaa', 'aaa', '2019-12-08 17:47:39', '2019-12-08 17:47:39', NULL),
(5, 't', 'c1', '2019-12-08 17:49:08', '2019-12-10 14:57:09', '2019-12-10 14:57:09'),
(6, 't2', 'c2', '2019-12-08 17:49:48', '2019-12-10 14:57:11', '2019-12-10 14:57:11'),
(7, 't1209A1', 'ccccc', '2019-12-08 17:51:51', '2019-12-08 20:13:03', NULL),
(10, 't1209A3', 'cccc', '2019-12-08 21:43:38', '2019-12-08 21:43:38', NULL),
(11, 't1209A4', 'cccc', '2019-12-08 21:44:39', '2019-12-08 21:44:39', NULL),
(12, 't1210a2aaa', 'ccccaaa', '2019-12-10 00:30:26', '2019-12-10 14:44:28', NULL),
(14, 't', 'cccc', '2019-12-10 14:37:02', '2019-12-10 14:46:34', '2019-12-10 14:46:34'),
(15, NULL, NULL, '2019-12-10 19:28:59', '2019-12-10 19:29:02', '2019-12-10 19:29:02'),
(16, 'c', NULL, '2019-12-10 20:31:00', '2019-12-10 20:44:25', '2019-12-10 20:44:25'),
(17, 'a', NULL, '2019-12-10 20:33:31', '2019-12-10 20:44:26', '2019-12-10 20:44:26'),
(18, 'c', NULL, '2019-12-10 20:44:23', '2019-12-10 20:44:58', '2019-12-10 20:44:58'),
(19, 't1211a3', NULL, '2019-12-10 20:44:56', '2019-12-10 20:44:56', NULL),
(20, 't1211a4', 'cccc', '2019-12-10 21:10:15', '2019-12-10 21:10:15', NULL),
(21, 't1211a5', 'cccc', '2019-12-10 21:10:23', '2019-12-10 21:10:23', NULL),
(22, 'ggg', NULL, '2019-12-11 16:45:25', '2019-12-11 17:06:31', '2019-12-11 17:06:31'),
(23, 't1213a1', 'cccc', '2019-12-12 23:11:34', '2019-12-12 23:11:34', NULL),
(24, 't1213a2', 'cccc', '2019-12-13 00:47:46', '2019-12-13 00:48:01', NULL);

--
-- ダンプしたテーブルのインデックス
--

--
-- テーブルのインデックス `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`);

--
-- ダンプしたテーブルのAUTO_INCREMENT
--

--
-- テーブルのAUTO_INCREMENT `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
