-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- ホスト: 127.0.0.1
-- 生成日時: 2022-02-15 01:57:40
-- サーバのバージョン： 10.4.22-MariaDB
-- PHP のバージョン: 8.0.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- データベース: `todo`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `todo_items`
--

CREATE TABLE `todo_items` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `item_name` varchar(100) DEFAULT NULL,
  `registration_date` date DEFAULT NULL,
  `expire_date` date DEFAULT NULL,
  `finished_date` date DEFAULT NULL,
  `is_deleted` tinyint(4) NOT NULL DEFAULT 0,
  `create_date_time` datetime NOT NULL DEFAULT current_timestamp(),
  `update_date_time` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- テーブルのデータのダンプ `todo_items`
--

INSERT INTO `todo_items` (`id`, `user_id`, `item_name`, `registration_date`, `expire_date`, `finished_date`, `is_deleted`, `create_date_time`, `update_date_time`) VALUES
(30, 32, '変更！！', '2022-02-14', '2022-02-14', NULL, 1, '2022-02-14 14:13:32', '2022-02-14 14:13:32'),
(31, 32, 'おおおおおおおおおおおおおおおおおおおおおおおおお', '2022-02-14', '2022-02-14', '2022-02-14', 0, '2022-02-14 14:14:18', '2022-02-14 14:14:18');

-- --------------------------------------------------------

--
-- テーブルの構造 `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `user` varchar(256) NOT NULL,
  `pass` varchar(256) NOT NULL,
  `family_name` varchar(50) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `is_admin` tinyint(4) NOT NULL DEFAULT 0,
  `is_deleted` tinyint(4) NOT NULL DEFAULT 0,
  `create_date_time` datetime NOT NULL DEFAULT current_timestamp(),
  `update_date_time` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- テーブルのデータのダンプ `users`
--

INSERT INTO `users` (`id`, `user`, `pass`, `family_name`, `first_name`, `is_admin`, `is_deleted`, `create_date_time`, `update_date_time`) VALUES
(32, 'kouichi315@', '$2y$10$caY62RYJAqpfvMAUD2Tsiu5UuCwHG2zcAJTpY1wP/zdTsEu6Mlrye', '岡田', '幸一', 0, 0, '2022-02-14 14:12:42', '2022-02-14 14:12:42');

--
-- ダンプしたテーブルのインデックス
--

--
-- テーブルのインデックス `todo_items`
--
ALTER TABLE `todo_items`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- ダンプしたテーブルの AUTO_INCREMENT
--

--
-- テーブルの AUTO_INCREMENT `todo_items`
--
ALTER TABLE `todo_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- テーブルの AUTO_INCREMENT `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
