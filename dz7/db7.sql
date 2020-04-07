-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Апр 07 2020 г., 13:38
-- Версия сервера: 8.0.15
-- Версия PHP: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `db7`
--

-- --------------------------------------------------------

--
-- Структура таблицы `colors`
--

CREATE TABLE `colors` (
  `id` int(3) NOT NULL,
  `name` varchar(45) NOT NULL,
  `red` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `green` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `blue` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `color` char(6) NOT NULL DEFAULT '000000'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `colors`
--

INSERT INTO `colors` (`id`, `name`, `red`, `green`, `blue`, `color`) VALUES
(1, 'красный', 255, 0, 0, 'ff0000'),
(2, 'зеленый', 0, 255, 0, '00ff00'),
(3, 'синисй', 0, 0, 255, '0000ff');

-- --------------------------------------------------------

--
-- Структура таблицы `groups`
--

CREATE TABLE `groups` (
  `id` int(3) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `groups`
--

INSERT INTO `groups` (`id`, `name`, `description`) VALUES
(1, 'users', 'пользователи'),
(999, 'admins', 'администраторы');

-- --------------------------------------------------------

--
-- Структура таблицы `group_user`
--

CREATE TABLE `group_user` (
  `user_id` int(10) NOT NULL,
  `group_id` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `group_user`
--

INSERT INTO `group_user` (`user_id`, `group_id`) VALUES
(1, 1),
(1, 999),
(2, 1),
(3, 1),
(4, 1),
(5, 1),
(6, 1),
(7, 1),
(8, 1),
(9, 1),
(10, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `main_menu`
--

CREATE TABLE `main_menu` (
  `id` int(3) NOT NULL,
  `title` varchar(50) NOT NULL,
  `path` varchar(255) NOT NULL,
  `usePanel` tinyint(1) NOT NULL DEFAULT '0',
  `adm_panel` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `main_menu`
--

INSERT INTO `main_menu` (`id`, `title`, `path`, `usePanel`, `adm_panel`) VALUES
(1, 'Главная', '/', 1, 0),
(100, 'О нас', '/route/about/', 0, 0),
(200, 'Новости', '/route/news/', 0, 0),
(300, 'Каталог', '/route/catalog/', 0, 0),
(400, 'Контакты для связи', '/route/contact/', 0, 0),
(500, 'Галерея', '/route/images/', 0, 0),
(600, 'Профиль пользователя', '/route/user/', 1, 0),
(999, 'Админ', '/route/admin/', 1, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `messages`
--

CREATE TABLE `messages` (
  `id` int(10) NOT NULL,
  `title` varchar(1024) NOT NULL,
  `date_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `text` text,
  `user_id_sender` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `message_recipient`
--

CREATE TABLE `message_recipient` (
  `message_id` int(10) NOT NULL,
  `recipient_user_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `section`
--

CREATE TABLE `section` (
  `id` int(3) NOT NULL,
  `title` varchar(50) NOT NULL,
  `parent_id` int(3) DEFAULT NULL,
  `user_id` int(10) NOT NULL,
  `color_id` int(3) DEFAULT NULL,
  `date_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `user` varchar(255) NOT NULL,
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `password` char(60) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `flag_email_notification` tinyint(1) NOT NULL DEFAULT '0',
  `flag_active` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `user`, `email`, `phone`, `password`, `flag_email_notification`, `flag_active`) VALUES
(1, 'администратор', 'adm@dz7.ru', NULL, '$2y$10$sPUSc9nU8l8QDwm4YkAK9O/IXs46SfEI3ZxQ.dWp47kZBAzfKkNPy', 1, 0),
(2, 'us10', 'us1@1.dz7', '111 - 11 - 11', '$2y$10$vshUiVoa7fZUGk5p/Fe3c.jisi6RGwXQaD9C4rKxDekIOlr7C6xzu', 1, 0),
(3, 'us20', 'us2@2.dz7', '222 - 22 - 22', '$2y$10$64QV6l8UTzHH5/vSM1k.Z.NhA3nLbWHdQ7Bc.hDxbIANdb.MAE4rK', 1, 0),
(4, 'us30', 'us3@3.dz7', '333 - 33 - 33', '$2y$10$rvWvRl0cqI26FbljVxBKpuyAPVsT521ACwopfGLYo0BSWrdUyGP2u', 1, 0),
(5, 'us40', 'us4@4.dz7', '444 - 44 - 44', '$2y$10$iANNvDErb55JEHYaamtFjOr0bA/RViCbUKTbcTAM5u6VyYm8u7Sx.', 1, 0),
(6, 'us50', 'us5@5.dz7', '555 - 55 - 55', '$2y$10$oKwG9s9.DUQsW57ghrGEseHljuBmskGgQDh59wQnURLvn0rL7jsze', 1, 0),
(7, 'us60', 'us6@6.dz7', '666 - 66 - 66', '$2y$10$fuR.LWKwdj89tSy4nLOuzugwAZ81KMvPelymgsJ.Dz042n5lQLCYq', 1, 0),
(8, 'us70', 'us7@7.dz7', '777 - 77 - 77', '$2y$10$wY34zq0AOHhNHP8etIns6..YRsBBfjMGNXt4rOx7t17gbNbTqxJvC', 1, 0),
(9, 'us80', 'us8@8.dz7', '888 - 88 - 88', '$2y$10$Uu/i8amuaIZ1dEUoa9AGBeH/pdx9tbpX2djalPIXwPfI5JKvMZAwy', 1, 0),
(10, 'us90', 'us9@9.dz7', '999 - 99 - 99', '$2y$10$fWJA1uO1rzQrU7iatgV/q.OdzgZ3TxGOa87Vk7Jdpw3HgPsipZaBO', 1, 0);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `colors`
--
ALTER TABLE `colors`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`);

--
-- Индексы таблицы `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`);

--
-- Индексы таблицы `group_user`
--
ALTER TABLE `group_user`
  ADD PRIMARY KEY (`user_id`,`group_id`),
  ADD KEY `ug_user_idx` (`user_id`),
  ADD KEY `ug_group_idx` (`group_id`);

--
-- Индексы таблицы `main_menu`
--
ALTER TABLE `main_menu`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`);

--
-- Индексы таблицы `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`),
  ADD KEY `fr_key_sender_idx` (`user_id_sender`);

--
-- Индексы таблицы `message_recipient`
--
ALTER TABLE `message_recipient`
  ADD PRIMARY KEY (`message_id`,`recipient_user_id`),
  ADD KEY `fr_key_message_idx` (`message_id`),
  ADD KEY `fr_key_user_idx` (`recipient_user_id`);

--
-- Индексы таблицы `section`
--
ALTER TABLE `section`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`),
  ADD KEY `fr_key_parent_id_idx` (`parent_id`),
  ADD KEY `fr_key_user_id_idx` (`user_id`),
  ADD KEY `fr_key_color_id_idx` (`color_id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`,`email`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`),
  ADD UNIQUE KEY `email_UNIQUE` (`email`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `colors`
--
ALTER TABLE `colors`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `groups`
--
ALTER TABLE `groups`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1000;

--
-- AUTO_INCREMENT для таблицы `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `section`
--
ALTER TABLE `section`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `group_user`
--
ALTER TABLE `group_user`
  ADD CONSTRAINT `fr_key_group_user` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fr_key_user_group` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `fr_key_sender` FOREIGN KEY (`user_id_sender`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `message_recipient`
--
ALTER TABLE `message_recipient`
  ADD CONSTRAINT `fr_key_message` FOREIGN KEY (`message_id`) REFERENCES `messages` (`id`),
  ADD CONSTRAINT `fr_key_user` FOREIGN KEY (`recipient_user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `section`
--
ALTER TABLE `section`
  ADD CONSTRAINT `fr_key_color_id` FOREIGN KEY (`color_id`) REFERENCES `colors` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fr_key_parent_id` FOREIGN KEY (`parent_id`) REFERENCES `section` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fr_key_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
