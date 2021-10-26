-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Окт 23 2021 г., 08:15
-- Версия сервера: 8.0.24
-- Версия PHP: 8.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `dem`
--

-- --------------------------------------------------------

--
-- Структура таблицы `category`
--

CREATE TABLE `category` (
  `id` int NOT NULL,
  `name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `category`
--

INSERT INTO `category` (`id`, `name`) VALUES
(1, 'Дом'),
(3, 'Эльдар');

-- --------------------------------------------------------

--
-- Структура таблицы `orders`
--

CREATE TABLE `orders` (
  `id` int NOT NULL,
  `adress` text NOT NULL,
  `description` text NOT NULL,
  `max_price` int NOT NULL,
  `data` text NOT NULL,
  `status` varchar(255) DEFAULT 'Новая',
  `photo_user` text NOT NULL,
  `photo_admin` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `end_price` int DEFAULT NULL,
  `category_id` int NOT NULL,
  `user_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `orders`
--

INSERT INTO `orders` (`id`, `adress`, `description`, `max_price`, `data`, `status`, `photo_user`, `photo_admin`, `end_price`, `category_id`, `user_id`) VALUES
(2, 'Россияская Россия 24', 'Тут пожалуйста поставьте одного Илью, потом Эльдара, а потом еще и Тимура', 109, '20-10-21', 'Новая', 'src/front/img/19071275583456.png', NULL, NULL, 1, 4),
(3, 'Россияская Россия 24', 'Тут пожалуйста поставьте одного Илью, потом Эльдара, а потом еще и Тимура', 109, '20-10-21', 'Новая', 'src/front/img/1173607193456.png', NULL, NULL, 1, 4),
(4, 'Россияская Россия 24', 'Тут пожалуйста поставьте одного Илью, потом Эльдара, а потом еще и Тимура', 109, '20-10-21', 'Новая', 'src/front/img/3248383003456.png', NULL, NULL, 1, 4);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `name` text NOT NULL,
  `login` text NOT NULL,
  `email` text NOT NULL,
  `password` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `name`, `login`, `email`, `password`) VALUES
(1, 'Артем', 'Pachecka', 'artem18062002@mail.ru', '123'),
(2, 'Артем', 'Pachecka1', 'artem18062002@mail.ru', '$2y$10$ivzcCsyCcruJ2XNE6fBJ0eZhHarezdM38mq3syrXLcJo.mYeMrP8a'),
(3, 'Артем', 'Pachecka12', 'artem18062002@mail.ru', '$2y$10$OpDpEOcPig7mOKoPDHlHOOcm.nYkNpRzQA3qNsit19Z7d07WcSn6m'),
(4, 'Артем', 'Hey1', 'Hey1@gmail.com', '$2y$10$T.7ELSnf6qhblQrhTIQfQ.UEq2Z40SCEK6UlK/E8cODSwg/FNrtZu'),
(5, 'Администратор- Да - я', 'admin', 'admin@admin.admin', '$2y$10$lLRBV5NboMOQaDzu7gdbouHzq/q.3ym8qEnS9z7PMm/d/ZbZL7UKy');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `category`
--
ALTER TABLE `category`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
