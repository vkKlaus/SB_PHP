-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Апр 12 2020 г., 21:19
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
  `name` varchar(45) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `red` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `green` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `blue` tinyint(3) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `colors`
--

INSERT INTO `colors` (`id`, `name`, `red`, `green`, `blue`) VALUES
(1, 'красный', 255, 0, 0),
(2, 'зеленый', 0, 255, 0),
(3, 'синий', 0, 0, 255),
(4, 'белый', 255, 255, 255),
(5, 'черный', 0, 0, 0),
(6, 'серый', 200, 200, 200);

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
(2, 'write', 'пишет сообщения'),
(3, 'crtSection', 'создает разделы'),
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
(1, 2),
(1, 3),
(1, 999),
(2, 1),
(2, 2),
(2, 3),
(2, 999),
(3, 1),
(4, 1),
(5, 1),
(6, 1),
(6, 3),
(7, 1),
(7, 2),
(7, 3),
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
  `use_panel` tinyint(1) NOT NULL DEFAULT '0',
  `adm_panel` tinyint(1) NOT NULL DEFAULT '0',
  `no_autor` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `main_menu`
--

INSERT INTO `main_menu` (`id`, `title`, `path`, `use_panel`, `adm_panel`, `no_autor`) VALUES
(1, 'Главная', '/', 1, 0, 1),
(100, 'О нас', '/route/about/', 0, 0, 0),
(200, 'Новости', '/route/news/', 0, 0, 0),
(300, 'Каталог', '/route/catalog/', 0, 0, 0),
(400, 'Контакты для связи', '/route/contact/', 0, 0, 0),
(500, 'Галерея', '/route/images/', 0, 0, 0),
(550, 'Сообщения', '/route/messages/', 1, 0, 0),
(560, 'Отправить сообщение', '/route/msgOut/', 1, 0, 0),
(570, 'Разделы', '/route/sections/', 1, 0, 0),
(600, 'Профиль ', '/route/user/', 1, 0, 0),
(999, 'Админ', '/route/admin/', 1, 1, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `messages`
--

CREATE TABLE `messages` (
  `id` int(10) NOT NULL,
  `title` varchar(1024) NOT NULL,
  `section_id` int(3) DEFAULT '0',
  `date_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `text` text,
  `user_id_sender` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `messages`
--

INSERT INTO `messages` (`id`, `title`, `section_id`, `text`, `user_id_sender`) VALUES
(1, '1 - Заголовок', 5, '1 - Какой то очень умный текст', 6),
(2, '2 - Заголовок', 8, '2 - Какой то очень умный текст', 2),
(3, '3 - Заголовок', 5, '3 - Какой то очень умный текст', 6),
(4, '4 - Заголовок', 4, '4 - Какой то очень умный текст', 5),
(5, '5 - Заголовок', 5, '5 - Какой то очень умный текст', 5),
(6, '6 - Заголовок', 7, '6 - Какой то очень умный текст', 9),
(7, '7 - Заголовок', 10, '7 - Какой то очень умный текст', 10),
(8, '8 - Заголовок', 8, '8 - Какой то очень умный текст', 7),
(9, '9 - Заголовок', 6, '9 - Какой то очень умный текст', 10),
(10, '10 - Заголовок', 5, '10 - Какой то очень умный текст', 10),
(11, '11 - Заголовок', 6, '11 - Какой то очень умный текст', 5),
(12, '12 - Заголовок', 4, '12 - Какой то очень умный текст', 3),
(13, '13 - Заголовок', 2, '13 - Какой то очень умный текст', 1),
(14, '14 - Заголовок', 5, '14 - Какой то очень умный текст', 9),
(15, '15 - Заголовок', 6, '15 - Какой то очень умный текст', 6),
(16, '16 - Заголовок', 8, '16 - Какой то очень умный текст', 10),
(17, '17 - Заголовок', 3, '17 - Какой то очень умный текст', 10),
(18, '18 - Заголовок', 3, '18 - Какой то очень умный текст', 7),
(19, '19 - Заголовок', 10, '19 - Какой то очень умный текст', 9),
(20, '20 - Заголовок', 10, '20 - Какой то очень умный текст', 9),
(21, '21 - Заголовок', 7, '21 - Какой то очень умный текст', 6),
(22, '22 - Заголовок', 7, '22 - Какой то очень умный текст', 8),
(23, '23 - Заголовок', 3, '23 - Какой то очень умный текст', 3),
(24, '24 - Заголовок', 4, '24 - Какой то очень умный текст', 1),
(25, '25 - Заголовок', 5, '25 - Какой то очень умный текст', 6),
(26, '26 - Заголовок', 8, '26 - Какой то очень умный текст', 4),
(27, '27 - Заголовок', 4, '27 - Какой то очень умный текст', 8),
(28, '28 - Заголовок', 6, '28 - Какой то очень умный текст', 5),
(29, '29 - Заголовок', 3, '29 - Какой то очень умный текст', 7),
(30, '30 - Заголовок', 8, '30 - Какой то очень умный текст', 1),
(31, '31 - Заголовок', 1, '31 - Какой то очень умный текст', 3),
(32, '32 - Заголовок', 6, '32 - Какой то очень умный текст', 8),
(33, '33 - Заголовок', 10, '33 - Какой то очень умный текст', 5),
(34, '34 - Заголовок', 4, '34 - Какой то очень умный текст', 6),
(35, '35 - Заголовок', 2, '35 - Какой то очень умный текст', 6),
(36, '36 - Заголовок', 10, '36 - Какой то очень умный текст', 6),
(37, '37 - Заголовок', 2, '37 - Какой то очень умный текст', 9),
(38, '38 - Заголовок', 6, '38 - Какой то очень умный текст', 3),
(39, '39 - Заголовок', 2, '39 - Какой то очень умный текст', 9),
(40, '40 - Заголовок', 7, '40 - Какой то очень умный текст', 10),
(41, '41 - Заголовок', 5, '41 - Какой то очень умный текст', 4),
(42, '42 - Заголовок', 8, '42 - Какой то очень умный текст', 6),
(43, '43 - Заголовок', 4, '43 - Какой то очень умный текст', 1),
(44, '44 - Заголовок', 2, '44 - Какой то очень умный текст', 8),
(45, '45 - Заголовок', 5, '45 - Какой то очень умный текст', 8),
(46, '46 - Заголовок', 9, '46 - Какой то очень умный текст', 8),
(47, '47 - Заголовок', 2, '47 - Какой то очень умный текст', 4),
(48, '48 - Заголовок', 3, '48 - Какой то очень умный текст', 1),
(49, '49 - Заголовок', 4, '49 - Какой то очень умный текст', 8),
(50, '50 - Заголовок', 1, '50 - Какой то очень умный текст', 5),
(51, '51 - Заголовок', 2, '51 - Какой то очень умный текст', 5),
(52, '52 - Заголовок', 1, '52 - Какой то очень умный текст', 9),
(53, '53 - Заголовок', 3, '53 - Какой то очень умный текст', 2),
(54, '54 - Заголовок', 10, '54 - Какой то очень умный текст', 6),
(55, '55 - Заголовок', 7, '55 - Какой то очень умный текст', 10),
(56, '56 - Заголовок', 6, '56 - Какой то очень умный текст', 2),
(57, '57 - Заголовок', 2, '57 - Какой то очень умный текст', 7),
(58, '58 - Заголовок', 7, '58 - Какой то очень умный текст', 4),
(59, '59 - Заголовок', 5, '59 - Какой то очень умный текст', 6),
(60, '60 - Заголовок', 9, '60 - Какой то очень умный текст', 10),
(61, '61 - Заголовок', 2, '61 - Какой то очень умный текст', 1),
(62, '62 - Заголовок', 8, '62 - Какой то очень умный текст', 10),
(63, '63 - Заголовок', 5, '63 - Какой то очень умный текст', 7),
(64, '64 - Заголовок', 2, '64 - Какой то очень умный текст', 9),
(65, '65 - Заголовок', 1, '65 - Какой то очень умный текст', 9),
(66, '66 - Заголовок', 1, '66 - Какой то очень умный текст', 5),
(67, '67 - Заголовок', 2, '67 - Какой то очень умный текст', 8),
(68, '68 - Заголовок', 4, '68 - Какой то очень умный текст', 7),
(69, '69 - Заголовок', 6, '69 - Какой то очень умный текст', 2),
(70, '70 - Заголовок', 1, '70 - Какой то очень умный текст', 7),
(71, '71 - Заголовок', 2, '71 - Какой то очень умный текст', 8),
(72, '72 - Заголовок', 5, '72 - Какой то очень умный текст', 5),
(73, '73 - Заголовок', 4, '73 - Какой то очень умный текст', 5),
(74, '74 - Заголовок', 7, '74 - Какой то очень умный текст', 8),
(75, '75 - Заголовок', 3, '75 - Какой то очень умный текст', 7),
(76, '76 - Заголовок', 1, '76 - Какой то очень умный текст', 9),
(77, '77 - Заголовок', 10, '77 - Какой то очень умный текст', 4),
(78, '78 - Заголовок', 6, '78 - Какой то очень умный текст', 9),
(79, '79 - Заголовок', 2, '79 - Какой то очень умный текст', 4),
(80, '80 - Заголовок', 7, '80 - Какой то очень умный текст', 5),
(81, '81 - Заголовок', 4, '81 - Какой то очень умный текст', 1),
(82, '82 - Заголовок', 1, '82 - Какой то очень умный текст', 1),
(83, '83 - Заголовок', 3, '83 - Какой то очень умный текст', 7),
(84, '84 - Заголовок', 2, '84 - Какой то очень умный текст', 7),
(85, '85 - Заголовок', 4, '85 - Какой то очень умный текст', 9),
(86, '86 - Заголовок', 6, '86 - Какой то очень умный текст', 4),
(87, '87 - Заголовок', 10, '87 - Какой то очень умный текст', 7),
(88, '88 - Заголовок', 4, '88 - Какой то очень умный текст', 6),
(89, '89 - Заголовок', 3, '89 - Какой то очень умный текст', 2),
(90, '90 - Заголовок', 6, '90 - Какой то очень умный текст', 7),
(91, '91 - Заголовок', 5, '91 - Какой то очень умный текст', 7),
(92, '92 - Заголовок', 9, '92 - Какой то очень умный текст', 9),
(93, '93 - Заголовок', 6, '93 - Какой то очень умный текст', 9),
(94, '94 - Заголовок', 6, '94 - Какой то очень умный текст', 2),
(95, '95 - Заголовок', 7, '95 - Какой то очень умный текст', 2),
(96, '96 - Заголовок', 4, '96 - Какой то очень умный текст', 7),
(97, '97 - Заголовок', 4, '97 - Какой то очень умный текст', 2),
(98, '98 - Заголовок', 6, '98 - Какой то очень умный текст', 2),
(99, '99 - Заголовок', 7, '99 - Какой то очень умный текст', 5),
(100, '100 - Заголовок', 9, '100 - Какой то очень умный текст', 8),
(101, 'новый заголовок', 4, ' Здесь есть сообщение', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `message_recipient`
--

CREATE TABLE `message_recipient` (
  `message_id` int(10) NOT NULL,
  `recipient_user_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `message_recipient`
--

INSERT INTO `message_recipient` (`message_id`, `recipient_user_id`) VALUES
(1, 7),
(1, 10),
(2, 4),
(2, 6),
(2, 9),
(3, 1),
(3, 4),
(3, 5),
(4, 1),
(4, 6),
(5, 6),
(5, 8),
(5, 10),
(6, 6),
(7, 3),
(7, 4),
(7, 5),
(7, 9),
(8, 2),
(8, 3),
(8, 4),
(8, 5),
(8, 6),
(9, 6),
(9, 7),
(10, 3),
(10, 5),
(11, 1),
(11, 9),
(12, 4),
(12, 5),
(13, 2),
(13, 3),
(13, 9),
(14, 2),
(14, 7),
(14, 8),
(14, 10),
(15, 1),
(15, 3),
(16, 6),
(16, 7),
(17, 1),
(17, 2),
(17, 5),
(17, 6),
(17, 9),
(18, 5),
(19, 4),
(19, 5),
(19, 7),
(19, 8),
(20, 1),
(20, 2),
(21, 1),
(21, 3),
(21, 4),
(21, 5),
(22, 5),
(22, 10),
(23, 4),
(23, 8),
(24, 2),
(24, 3),
(24, 9),
(25, 1),
(25, 4),
(25, 10),
(26, 2),
(26, 5),
(27, 1),
(27, 3),
(27, 4),
(27, 5),
(27, 7),
(28, 7),
(28, 8),
(28, 9),
(29, 1),
(29, 3),
(30, 2),
(30, 8),
(30, 10),
(31, 1),
(31, 4),
(32, 1),
(32, 4),
(32, 5),
(32, 10),
(33, 2),
(33, 4),
(33, 10),
(34, 3),
(34, 5),
(34, 10),
(35, 3),
(35, 7),
(36, 2),
(36, 4),
(36, 8),
(36, 9),
(37, 5),
(37, 10),
(38, 1),
(39, 3),
(39, 5),
(39, 7),
(39, 10),
(40, 1),
(40, 2),
(40, 4),
(41, 1),
(41, 3),
(41, 7),
(42, 5),
(42, 7),
(42, 8),
(43, 3),
(43, 6),
(43, 9),
(44, 2),
(44, 5),
(44, 9),
(45, 1),
(45, 3),
(45, 7),
(45, 10),
(46, 4),
(46, 7),
(47, 7),
(48, 2),
(49, 5),
(49, 6),
(49, 7),
(49, 10),
(50, 6),
(50, 8),
(50, 9),
(51, 3),
(51, 4),
(51, 6),
(51, 8),
(52, 2),
(53, 1),
(53, 5),
(53, 6),
(54, 2),
(54, 5),
(54, 10),
(55, 2),
(55, 8),
(55, 9),
(56, 1),
(56, 4),
(56, 8),
(57, 1),
(57, 2),
(57, 10),
(58, 3),
(58, 6),
(59, 1),
(60, 2),
(60, 8),
(60, 9),
(61, 2),
(61, 6),
(61, 7),
(62, 7),
(63, 2),
(63, 5),
(64, 1),
(64, 2),
(64, 3),
(64, 4),
(65, 2),
(65, 5),
(65, 7),
(65, 8),
(66, 1),
(66, 4),
(66, 6),
(66, 9),
(66, 10),
(67, 1),
(67, 6),
(67, 7),
(67, 9),
(68, 1),
(68, 3),
(69, 6),
(69, 9),
(70, 2),
(70, 4),
(70, 5),
(70, 9),
(71, 1),
(71, 4),
(71, 5),
(71, 10),
(72, 6),
(72, 8),
(73, 3),
(73, 4),
(73, 7),
(74, 2),
(74, 4),
(74, 6),
(74, 9),
(74, 10),
(75, 3),
(76, 4),
(76, 8),
(77, 8),
(78, 5),
(78, 6),
(79, 6),
(79, 8),
(79, 10),
(80, 10),
(81, 4),
(81, 7),
(82, 5),
(82, 8),
(82, 9),
(83, 1),
(83, 8),
(84, 4),
(84, 9),
(84, 10),
(85, 2),
(85, 5),
(85, 6),
(85, 7),
(85, 10),
(86, 2),
(86, 3),
(86, 5),
(86, 6),
(86, 7),
(87, 6),
(88, 1),
(88, 3),
(88, 7),
(89, 8),
(90, 1),
(90, 10),
(91, 3),
(91, 8),
(92, 1),
(92, 2),
(92, 7),
(93, 2),
(93, 10),
(94, 7),
(95, 4),
(95, 7),
(95, 9),
(96, 5),
(97, 5),
(97, 9),
(98, 4),
(99, 1),
(99, 3),
(99, 7),
(99, 9),
(100, 1),
(100, 2),
(100, 3),
(100, 4),
(100, 5),
(101, 2),
(101, 3),
(101, 4),
(101, 5),
(101, 6),
(101, 7),
(101, 8),
(101, 9),
(101, 10);

-- --------------------------------------------------------

--
-- Структура таблицы `sections`
--

CREATE TABLE `sections` (
  `id` int(3) NOT NULL,
  `name` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `parent_id` int(3) DEFAULT '0',
  `user_id` int(11) NOT NULL,
  `color_id` int(3) DEFAULT NULL,
  `date_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 DELAY_KEY_WRITE=1;

--
-- Дамп данных таблицы `sections`
--

INSERT INTO `sections` (`id`, `name`, `parent_id`, `user_id`, `color_id`) VALUES
(1, 'Основные', 0, 2, 3),
(2, 'по работе', 1, 2, 3),
(3, 'личные', 1, 2, 3),
(4, 'Оповещения', 0, 3, 4),
(5, 'форумы', 4, 3, 4),
(6, 'кино', 5, 3, 4),
(7, 'игры', 5, 3, 4),
(8, 'магазины', 4, 3, 4),
(9, 'подписки', 4, 3, 4),
(10, 'Спам', 0, 5, 5),
(11, 'Просто раздел не о чем', 0, 2, 1),
(12, 'и здесь не о чем', 11, 2, 3),
(13, 'и опять не о чем', 12, 2, 2),
(14, 'снова не о чем', 12, 2, 1),
(15, 'еще раз не о чем', 11, 2, 1);

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
(1, 'admin', 'admin@adm.dz7', '000-00-00', '$2y$10$N7irlIffhiVj9CsAzcP9jOnliI9nFDRDkVenhicWa6k0tMr6aB3jS', 1, 0),
(2, 'us10', 'us1@1.dz7', '111 - 11 - 11', '$2y$10$TPKLV3/XHLDp2NtS8EnWJukg49BSqtj.HBM.idiX2CO9ZNt3.F1se', 1, 0),
(3, 'us20', 'us2@2.dz7', '222 - 22 - 22', '$2y$10$u2LJ0ieYbsuBDjjONLzfT.CNfCF4A9hLdX/QEJQCnAs9NPgDnZvpW', 1, 0),
(4, 'us30', 'us3@3.dz7', '333 - 33 - 33', '$2y$10$kDg7ptjyTG0WhEYUtmCOGeUapOkU2kq/OkePNq3SUY6uBcVHBSpiu', 1, 0),
(5, 'us40', 'us4@4.dz7', '444 - 44 - 44', '$2y$10$MN4YCkw6CsW6gWNbzeWssOcK/xLbWL49XB5NbI33SyfxZ.JeG.dnW', 1, 0),
(6, 'us50', 'us5@5.dz7', '555 - 55 - 55', '$2y$10$RrlDPpY829yxpeiCTJ5v/OJYWMTlLWoszOYrdyQR5tIfpi0rMNLGa', 1, 0),
(7, 'us60', 'us6@6.dz7', '666 - 66 - 66', '$2y$10$cHlw1AB.Yw6f.CfEC/6Hsu2XdnYt0Eifz6iPaXt1lMa5L.XAL9Wbu', 1, 0),
(8, 'us70', 'us7@7.dz7', '777 - 77 - 77', '$2y$10$q4YWJXXNcZfsGMMpfZ3LPexH.NZPAH0JUTHoM2KdLdIL/XCaRVa8q', 1, 0),
(9, 'us80', 'us8@8.dz7', '888 - 88 - 88', '$2y$10$WENXkZe0sQNx5ui2oqJ.FegbTeAI9Qd21Nojs9V8Jd0dOgoO1JwJW', 1, 0),
(10, 'us90', 'us9@9.dz7', '999 - 99 - 99', '$2y$10$4rA7.DqxjR4IJS.YKfxUiuPKT6v93dmg0jWybQbVKBj6ntMoMreU.', 1, 0);

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
  ADD KEY `fr_key_sender_idx` (`user_id_sender`),
  ADD KEY `fr_key_sectiom_id_idx` (`section_id`);

--
-- Индексы таблицы `message_recipient`
--
ALTER TABLE `message_recipient`
  ADD PRIMARY KEY (`message_id`,`recipient_user_id`),
  ADD KEY `fr_key_message_idx` (`message_id`),
  ADD KEY `fr_key_user_idx` (`recipient_user_id`);

--
-- Индексы таблицы `sections`
--
ALTER TABLE `sections`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`),
  ADD KEY `fr_key_user_id_idx` (`user_id`),
  ADD KEY `fr_key_color_id_idx` (`color_id`),
  ADD KEY `pr_id_idx` (`parent_id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`),
  ADD UNIQUE KEY `email_UNIQUE` (`email`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `colors`
--
ALTER TABLE `colors`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `groups`
--
ALTER TABLE `groups`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1000;

--
-- AUTO_INCREMENT для таблицы `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102;

--
-- AUTO_INCREMENT для таблицы `sections`
--
ALTER TABLE `sections`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

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
  ADD CONSTRAINT `fr_key_sectiom_id` FOREIGN KEY (`section_id`) REFERENCES `sections` (`id`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `fr_key_sender` FOREIGN KEY (`user_id_sender`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `message_recipient`
--
ALTER TABLE `message_recipient`
  ADD CONSTRAINT `fr_key_message` FOREIGN KEY (`message_id`) REFERENCES `messages` (`id`),
  ADD CONSTRAINT `fr_key_user` FOREIGN KEY (`recipient_user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `sections`
--
ALTER TABLE `sections`
  ADD CONSTRAINT `fr_key_color_id` FOREIGN KEY (`color_id`) REFERENCES `colors` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fr_key_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
