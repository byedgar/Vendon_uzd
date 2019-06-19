-- phpMyAdmin SQL Dump
-- version 4.0.4.2
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Июн 19 2019 г., 12:34
-- Версия сервера: 5.6.13
-- Версия PHP: 5.4.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `anketa`
--
CREATE DATABASE IF NOT EXISTS `anketa` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `anketa`;

-- --------------------------------------------------------

--
-- Структура таблицы `answers`
--

CREATE TABLE IF NOT EXISTS `answers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `q_id` int(11) NOT NULL,
  `answer` text COLLATE utf8mb4_bin NOT NULL,
  `correct` int(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `q_id` (`q_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin AUTO_INCREMENT=60 ;

--
-- Дамп данных таблицы `answers`
--

INSERT INTO `answers` (`id`, `q_id`, `answer`, `correct`) VALUES
(1, 1, '2', 0),
(2, 1, '3', 0),
(3, 1, '4', 1),
(4, 1, '5', 0),
(5, 2, '10', 1),
(6, 2, '15', 0),
(7, 2, '6', 0),
(8, 2, '5', 0),
(9, 3, '5', 1),
(10, 3, '7', 0),
(11, 3, '9', 0),
(12, 3, '3', 0),
(13, 4, '1', 1),
(14, 4, '2', 0),
(15, 4, '3', 0),
(16, 4, '4', 0),
(17, 5, '4', 1),
(18, 5, '5', 0),
(19, 5, '2', 0),
(20, 5, '1', 0),
(21, 6, '8', 1),
(22, 6, '16', 0),
(23, 6, '4', 0),
(24, 6, '2', 0),
(25, 7, '4', 1),
(26, 7, '2', 0),
(27, 7, '3', 0),
(28, 7, '5', 0),
(29, 8, '25', 1),
(30, 8, '30', 0),
(31, 8, '20', 0),
(32, 8, '40', 0),
(33, 9, '49', 1),
(34, 9, '56', 0),
(35, 9, '21', 0),
(36, 9, '28', 0),
(37, 10, '100', 1),
(38, 10, '10', 0),
(39, 10, '1000', 0),
(40, 10, '20', 0),
(41, 10, '30', 0),
(42, 10, '1', 0),
(43, 10, '1', 0),
(44, 10, '0', 0),
(45, 10, '0', 0),
(46, 10, '-1', 0),
(47, 10, '-1', 0),
(48, 11, 'Rīga', 1),
(49, 11, 'Pierīgas reģionas', 1),
(50, 11, 'Cita Latvijas pilsēta', 1),
(51, 11, 'Mazpilsēta vai lauki', 1),
(52, 12, 'Esmu students', 1),
(53, 12, 'Strādāju un studēju', 1),
(54, 12, 'Strādāju', 1),
(55, 12, 'Bez darba', 1),
(56, 13, 'Mazāk kā gadu atpakaļ', 1),
(57, 13, '1 – 2 gadus atpakaļ', 1),
(58, 13, '2 – 3 gadus atpakaļ', 1),
(59, 13, '3 vai vairāk gadus atpakaļ', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `peoples`
--

CREATE TABLE IF NOT EXISTS `peoples` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `form_id` int(11) NOT NULL,
  `name` text COLLATE utf8mb4_bin NOT NULL,
  `start` datetime NOT NULL,
  `finish` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin AUTO_INCREMENT=4 ;

--
-- Дамп данных таблицы `peoples`
--

INSERT INTO `peoples` (`id`, `form_id`, `name`, `start`, `finish`) VALUES
(1, 1, 'Edgars', '2019-06-19 15:07:10', '2019-06-19 15:08:08'),
(2, 3, 'Edgars', '2019-06-19 15:18:14', '0000-00-00 00:00:00'),
(3, 3, 'Edgars', '2019-06-19 15:22:05', '2019-06-19 15:22:25');

-- --------------------------------------------------------

--
-- Структура таблицы `people_answ`
--

CREATE TABLE IF NOT EXISTS `people_answ` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `people_id` int(10) NOT NULL,
  `answer_id` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin AUTO_INCREMENT=14 ;

--
-- Дамп данных таблицы `people_answ`
--

INSERT INTO `people_answ` (`id`, `people_id`, `answer_id`) VALUES
(1, 1, 3),
(2, 1, 5),
(3, 1, 9),
(4, 1, 13),
(5, 1, 17),
(6, 1, 21),
(7, 1, 25),
(8, 1, 29),
(9, 1, 33),
(10, 1, 37),
(11, 3, 51),
(12, 3, 53),
(13, 3, 59);

-- --------------------------------------------------------

--
-- Структура таблицы `questionnaire`
--

CREATE TABLE IF NOT EXISTS `questionnaire` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text COLLATE utf8mb4_bin NOT NULL,
  `active` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin AUTO_INCREMENT=4 ;

--
-- Дамп данных таблицы `questionnaire`
--

INSERT INTO `questionnaire` (`id`, `name`, `active`) VALUES
(1, 'Calculator', 1),
(2, 'test', 0),
(3, 'test1', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `questions`
--

CREATE TABLE IF NOT EXISTS `questions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name_id` int(11) NOT NULL,
  `questions` text COLLATE utf8mb4_bin NOT NULL,
  `order` int(2) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `name_id` (`name_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin AUTO_INCREMENT=14 ;

--
-- Дамп данных таблицы `questions`
--

INSERT INTO `questions` (`id`, `name_id`, `questions`, `order`) VALUES
(1, 1, '2+2', 1),
(2, 1, '5+5', 2),
(3, 1, '7-2', 3),
(4, 1, '1*1', 4),
(5, 1, '2^2', 5),
(6, 1, '2^3', 6),
(7, 1, '5-1', 7),
(8, 1, '5*5', 8),
(9, 1, '7*7', 9),
(10, 1, '10*10', 10),
(11, 3, 'Jūsu dzīvesvieta', 1),
(12, 3, 'Jūsu nodarbošanās', 2),
(13, 3, 'Cik sen Jūs sākāt lietot internetu?', 3);

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `answers`
--
ALTER TABLE `answers`
  ADD CONSTRAINT `answers_ibfk_1` FOREIGN KEY (`q_id`) REFERENCES `questions` (`id`);

--
-- Ограничения внешнего ключа таблицы `questions`
--
ALTER TABLE `questions`
  ADD CONSTRAINT `questions_ibfk_1` FOREIGN KEY (`name_id`) REFERENCES `questionnaire` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
