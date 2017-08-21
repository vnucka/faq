-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Авг 21 2017 г., 08:21
-- Версия сервера: 5.5.53
-- Версия PHP: 5.6.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `faq`
--

-- --------------------------------------------------------

--
-- Структура таблицы `answers`
--

CREATE TABLE `answers` (
  `id` int(10) NOT NULL,
  `answer` varchar(3000) NOT NULL COMMENT 'ответ',
  `user_id` int(10) NOT NULL COMMENT 'id отвечающего',
  `question_id` int(10) NOT NULL COMMENT 'id вопроса',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Дата ответа',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `answers`
--

INSERT INTO `answers` (`id`, `answer`, `user_id`, `question_id`, `created_at`, `updated_at`) VALUES
(1, 'ЧАВО, ЧаВо, ЧЗВ, FAQ, F.A.Q. (акроним от англ. Frequently Asked Question(s) — часто задаваемые вопросы, произносится «фак» , «фэк» , «фэкс» , «эф-эй-кью» ) — собрание часто задаваемых вопросов по какой-либо теме и ответов на них.\r\n\r\nВ английском языке произношение «фэк» практически совпадает с произношением слова fact («факт») , и устойчивое выражение check the facts («убедись в достоверности» ) дало выражение check the FAQ («посмотри в FAQ»).\r\n\r\nИногда встречается русский аналог этого сокращения — ЧАВО (что, как полагают, означает частые вопросы или же часто задаваемые вопросы и ответы) или простой перевод английской аббревиатуры ЧЗВ (часто задаваемые вопросы) . Нередко в рунете встречается и прямая транслитерация, ФАК («посмотри в ФАКе») .\r\n\r\nСуществуют тысячи FAQ, посвящённых самым разным темам. Некоторые сайты каталогизируют их и обеспечивают возможность поиска — например, Internet FAQ Consortium ', 2, 4, '2017-08-13 09:57:21', '0000-00-00 00:00:00'),
(4, 'А че тут не понятного?\r\nРОФЛ', 3, 4, '2017-08-13 12:24:19', '0000-00-00 00:00:00'),
(5, 'Solid State Disk', 2, 5, '2017-08-18 05:16:14', '2017-08-18 05:16:14');

-- --------------------------------------------------------

--
-- Структура таблицы `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('borya@mail.ru', '$2y$10$8ol.7kyQQt8GPuiuPwvl7uX9gnYjZCMpOHnernJzxZDtgL.2rMVzG', '2017-08-19 03:15:11');

-- --------------------------------------------------------

--
-- Структура таблицы `questions`
--

CREATE TABLE `questions` (
  `id` int(10) NOT NULL,
  `theme_id` int(10) NOT NULL COMMENT 'id темы',
  `name` varchar(100) NOT NULL COMMENT 'Заголовок вопроса',
  `text` varchar(3000) NOT NULL COMMENT 'Текст вопроса',
  `user_id` int(10) NOT NULL COMMENT 'id автора',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Дата создания вопроса',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `moderate` varchar(30) NOT NULL DEFAULT 'moderate' COMMENT 'Модерация (true, false, moderate)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Дамп данных таблицы `questions`
--

INSERT INTO `questions` (`id`, `theme_id`, `name`, `text`, `user_id`, `created_at`, `updated_at`, `moderate`) VALUES
(4, 4, 'Что такое ЧАВО, Лол, Имхо, и т.д.', 'Объясните несведущему, что такое ЧАВО, Лол, Имхо, и от чего все эти слова произошли?', 2, '2017-08-20 13:42:53', '0000-00-00 00:00:00', 'confim'),
(5, 1, 'Что такое SSD?', 'Подскажите пожалуйста что такое SSD?', 21, '2017-08-18 15:19:14', '2017-08-20 05:19:14', 'confim'),
(6, 1, 'Переезд', 'Как переехать в другой город?', 2, '2017-08-21 03:24:19', '2017-08-20 17:24:19', 'moderate'),
(7, 1, 'Что такое HDD ?', 'Подскажите пожалуйста, а что такое HDD?', 3, '2017-08-15 14:31:58', '0000-00-00 00:00:00', 'confim'),
(9, 2, 'Кто такой Elephant?', 'Где то услышал такое интересное слово Elephant, а что оно означает не знаю....\r\n', 2, '2017-08-17 03:48:00', '0000-00-00 00:00:00', 'moderate'),
(15, 2, 'Кто такой Капранов?', 'Слышал, что в интернете есть некто Капранов, а это кто такой вообще?', 3, '2017-08-14 14:31:46', '0000-00-00 00:00:00', 'reject'),
(16, 2, 'Что за машина?', 'Подскажите, что за машина такая, Z350 ?', 4, '2017-08-21 03:10:53', '2017-08-20 17:10:53', 'confim');

-- --------------------------------------------------------

--
-- Структура таблицы `themes`
--

CREATE TABLE `themes` (
  `id` int(10) NOT NULL,
  `name` varchar(50) NOT NULL COMMENT 'Тема',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Дамп данных таблицы `themes`
--

INSERT INTO `themes` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Компьютерная лексика', '2017-08-20 05:17:00', '2017-08-19 19:17:00'),
(2, 'Разное', '2017-08-16 15:31:56', '0000-00-00 00:00:00'),
(4, 'Игры', '2017-08-19 21:14:19', '2017-08-19 21:14:19');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `role` varchar(30) CHARACTER SET utf8 NOT NULL DEFAULT 'user' COMMENT 'Роль (admin, moderator, user)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`, `role`) VALUES
(1, 'Александр', 'vnucka@mail.ru', '$2y$10$kMaHztI2Zvb10eA7x3nPdO8BajTw6xAk8ptnlQks0zZG5fLqMn1bu', 'I69EvOSYTVyucFRtLxZTWSjBXejrKnB1t4RGcDDjaUkM9MBtifJobIbBGJwU', '2017-08-07 02:16:34', '2017-08-07 02:16:34', 'admin'),
(2, 'Василий Пупкин', 'vasya@mail.ru', '$2y$10$KWLv4bEUaVaZw8RCH7Zqr.uU7iRaZL6/wlcpnSPpO9Tml6uQHxTxa', 'wAD4KCZJBN30bpV9yX8wfJedhveiZYSPSatlSLQHZSineTbaQinTJdeMypX1', '2017-08-12 23:55:48', '2017-08-20 18:13:45', 'user'),
(3, 'Анаис Брахимов', 'brachim@mail.ru', '$2y$10$pk4dblmOJB2P7xoGbpQ1qOOe5kG8YHM.NI5Cyraa9FsBYZ1YafYBW', 'xSyup8Bi1MtpjaV2zdIWIxnZlktAB9SlWuudcPE7tiRnouZpwn2QrtRDEHCh', '2017-08-13 02:18:07', '2017-08-13 02:18:07', 'user'),
(4, 'Анатонина', 'vnuchok@mail.ru', '$2y$10$QHAVk1./gk3llR4kU7l8N.OHGh78rpx4g83VNd7jxI/9/5u6ejciK', 'ilFO5D3mIwY71DdZHQz3JFrpYsoZzyw9HzrXfOf5jZbMwYgX9YO69OUtERDr', '2017-08-16 20:10:35', '2017-08-20 04:09:43', 'moderator'),
(21, 'Борис', 'borya@mail.ru', '$2y$10$kmkwmKrzB4uLcTWqWO032ecN11of8KzGx/xmqElBFMp2q9LGO2Z1m', 'oQ7FdWa47spKSOz4WNEfSh7v1c6pIRdCNpCuReYnwZUPmI9ya02nZMAmtyeB', '2017-08-19 06:08:03', '2017-08-19 06:08:03', 'user'),
(22, 'Юлия', 'yula@mail.ru', '$2y$10$V9O7/Hw2BtJ0yM/RZt/exuq8HyYMCE5BPGgCbpsQ2LINZCX/kd3aG', 'e9zHjzZZWst5Xw043gyFYmhjVbAPNSqM2XZpr7jZ0iMIpeX46UOmusPaNxW8', '2017-08-19 21:20:21', '2017-08-19 21:20:21', 'user');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `answers`
--
ALTER TABLE `answers`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `themes`
--
ALTER TABLE `themes`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `answers`
--
ALTER TABLE `answers`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT для таблицы `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT для таблицы `themes`
--
ALTER TABLE `themes`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
