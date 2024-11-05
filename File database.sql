-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Ноя 05 2024 г., 12:15
-- Версия сервера: 10.4.32-MariaDB
-- Версия PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `travelagency`
--

-- --------------------------------------------------------

--
-- Структура таблицы `accommodation`
--

CREATE TABLE `accommodation` (
  `id` int(11) NOT NULL,
  `tourist_id` int(11) DEFAULT NULL,
  `hotel_id` int(11) DEFAULT NULL,
  `room_number` varchar(50) DEFAULT NULL,
  `check_in_date` date DEFAULT NULL,
  `check_out_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `accommodation`
--

INSERT INTO `accommodation` (`id`, `tourist_id`, `hotel_id`, `room_number`, `check_in_date`, `check_out_date`) VALUES
(3, 1, 13, '101', '2024-10-06', '2024-10-15'),
(4, 21, 5, '345', '2024-10-10', '2024-10-20'),
(5, 27, 5, '343', '2024-10-10', '2024-10-20'),
(6, 5, 5, '343', '2024-10-10', '2024-10-20');

-- --------------------------------------------------------

--
-- Структура таблицы `cargo`
--

CREATE TABLE `cargo` (
  `id` int(11) NOT NULL,
  `tourist_id` int(11) DEFAULT NULL,
  `number_of_pieces` int(11) NOT NULL,
  `weight` decimal(10,2) NOT NULL,
  `volume_weight` decimal(10,2) DEFAULT NULL,
  `packaging_cost` decimal(10,2) DEFAULT NULL,
  `insurance_cost` decimal(10,2) DEFAULT NULL,
  `total_cost` decimal(10,2) NOT NULL,
  `markings` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `cargo`
--

INSERT INTO `cargo` (`id`, `tourist_id`, `number_of_pieces`, `weight`, `volume_weight`, `packaging_cost`, `insurance_cost`, `total_cost`, `markings`) VALUES
(1, 1, 2, 15.50, 3.00, 50.00, 100.00, 200.00, 'Хрупкий груз'),
(2, 3, 1, 10.00, 5.50, 30.00, 70.00, 150.00, 'Осторожно'),
(3, 6, 3, 20.00, 2.50, 60.00, 120.00, 250.00, 'Тяжелый груз'),
(4, 1, 1, 5.00, 5.50, 20.00, 50.00, 100.00, 'Быстро портящийся'),
(5, 3, 2, 12.00, 2.00, 40.00, 80.00, 180.00, 'Огнеопасный'),
(6, 6, 1, 8.00, 9.00, 25.00, 60.00, 130.00, 'Требует охлаждения'),
(7, 1, 4, 25.00, 6.00, 70.00, 150.00, 300.00, 'Особо ценный'),
(8, 3, 2, 18.00, 6.50, 50.00, 110.00, 210.00, 'Хрупкий груз'),
(9, 6, 3, 12.00, 4.00, 65.00, 130.00, 270.00, 'Большой объем'),
(10, 1, 1, 7.00, 7.50, 30.00, 70.00, 150.00, 'Медицинский груз'),
(11, 2, 2, 16.00, 16.50, 55.00, 90.00, 210.00, 'Хрупкий'),
(12, 5, 3, 13.00, 14.00, 45.00, 80.00, 170.00, 'Осторожно'),
(13, 5, 1, 9.00, 9.50, 35.00, 70.00, 140.00, 'Тяжелый'),
(14, 7, 2, 6.00, 6.50, 25.00, 60.00, 110.00, 'Быстро портящийся'),
(15, 18, 3, 19.00, 20.00, 60.00, 100.00, 230.00, 'Огнеопасный'),
(16, 9, 1, 11.00, 11.50, 40.00, 75.00, 155.00, 'Требует охлаждения'),
(17, 10, 4, 23.00, 24.00, 65.00, 120.00, 280.00, 'Особо ценный'),
(18, 2, 2, 14.00, 14.50, 50.00, 85.00, 190.00, 'Большой объем'),
(19, 3, 3, 8.00, 8.50, 30.00, 65.00, 125.00, 'Медицинский груз'),
(20, 5, 1, 10.00, 10.50, 35.00, 70.00, 145.00, 'Хрупкий груз'),
(21, 7, 2, 17.00, 18.00, 55.00, 95.00, 215.00, 'Осторожно'),
(22, 8, 3, 21.00, 22.00, 70.00, 130.00, 300.00, 'Тяжелый груз'),
(23, 9, 1, 18.00, 19.00, 60.00, 110.00, 250.00, 'Быстро портящийся'),
(24, 10, 4, 12.00, 12.50, 45.00, 85.00, 170.00, 'Огнеопасный'),
(25, 1, 2, 20.00, 21.00, 65.00, 125.00, 270.00, 'Требует охлаждения'),
(26, 3, 3, 15.00, 16.00, 50.00, 90.00, 200.00, 'Особо ценный'),
(27, 6, 1, 9.00, 9.50, 35.00, 70.00, 140.00, 'Большой объем'),
(28, 7, 2, 13.00, 14.00, 45.00, 80.00, 170.00, 'Медицинский груз'),
(29, 8, 3, 22.00, 23.50, 70.00, 135.00, 290.00, 'Хрупкий груз'),
(30, 9, 1, 16.00, 17.00, 55.00, 95.00, 210.00, 'Осторожно'),
(31, 10, 4, 19.00, 20.50, 65.00, 120.00, 260.00, 'Тяжелый груз'),
(32, 1, 2, 11.00, 12.00, 40.00, 75.00, 155.00, 'Быстро портящийся'),
(33, 2, 3, 17.00, 18.50, 55.00, 100.00, 230.00, 'Огнеопасный'),
(34, 3, 1, 21.00, 22.50, 70.00, 130.00, 290.00, 'Требует охлаждения'),
(35, 14, 2, 14.00, 15.00, 50.00, 85.00, 195.00, 'Особо ценный'),
(36, 5, 3, 18.00, 19.50, 60.00, 110.00, 250.00, 'Большой объем'),
(37, 6, 1, 12.00, 12.50, 45.00, 80.00, 170.00, 'Медицинский груз'),
(38, 7, 2, 24.00, 25.00, 75.00, 140.00, 320.00, 'Хрупкий груз'),
(39, 8, 3, 13.00, 14.00, 45.00, 85.00, 180.00, 'Осторожно'),
(40, 9, 1, 20.00, 21.50, 65.00, 125.00, 270.00, 'Тяжелый груз');

-- --------------------------------------------------------

--
-- Структура таблицы `child`
--

CREATE TABLE `child` (
  `id` int(11) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `age` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `child`
--

INSERT INTO `child` (`id`, `full_name`, `age`, `parent_id`) VALUES
(1, 'Иванов Николай Петрович', 12, 1),
(2, 'Кузнецова Мария Алексеевна', 8, 3);

-- --------------------------------------------------------

--
-- Структура таблицы `excursion`
--

CREATE TABLE `excursion` (
  `id` int(11) NOT NULL,
  `excursion_name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `agency_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `excursion`
--

INSERT INTO `excursion` (`id`, `excursion_name`, `description`, `agency_id`) VALUES
(1, 'Обзорная экскурсия по Каиру', 'Экскурсия по историческим достопримечательностям Каира', 1),
(2, 'Экскурсия по Лувру', 'Посещение музея Лувр в Париже', 2),
(3, 'Обзорная экскурсия по Александрии', 'Экскурсия по историческим достопримечательностям Александрии', 13),
(4, 'Обзорная экскурсия по памятникам Александрии', 'Экскурсия по историческим памятникам  достопримечательностям Александрии', 13);

-- --------------------------------------------------------

--
-- Структура таблицы `excursionagency`
--

CREATE TABLE `excursionagency` (
  `id` int(11) NOT NULL,
  `agency_name` varchar(255) NOT NULL,
  `contact_info` varchar(255) DEFAULT NULL,
  `rating` decimal(3,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `excursionagency`
--

INSERT INTO `excursionagency` (`id`, `agency_name`, `contact_info`, `rating`) VALUES
(1, 'Kair Tours', 'info@kairtours.it', 4.90),
(2, 'French Heritage', 'info@frenchheritage.fr', 4.70),
(3, 'Sunny Tours', 'info@sunnytours.com', 4.80),
(4, 'Alps Adventure', 'contact@alpsadventure.com', 4.60),
(5, 'Tokyo Sightseeing', 'info@tokyosights.jp', 4.70),
(6, 'Rome Historical Tours', 'contact@romehistory.it', 4.50),
(7, 'New York City Walks', 'info@nycwalks.com', 4.90),
(8, 'Dubai Desert Safaris', 'info@dubaideserts.com', 4.60),
(9, 'Sydney Coastal Trips', 'contact@sydneycoast.au', 4.70),
(10, 'Cairo Pyramids Tour', 'info@pyramidtours.eg', 4.50),
(11, 'Berlin Wall Experience', 'contact@berlinwall.de', 4.40),
(12, 'Madrid Cultural Tours', 'info@madridculturales.es', 4.80),
(13, 'AlexandriaTours', 'info@alexandriatours.it', 4.30);

-- --------------------------------------------------------

--
-- Структура таблицы `excursionbooking`
--

CREATE TABLE `excursionbooking` (
  `id` int(11) NOT NULL,
  `tourist_id` int(11) DEFAULT NULL,
  `excursion_id` int(11) DEFAULT NULL,
  `booking_date` date DEFAULT NULL,
  `excursion_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `excursionbooking`
--

INSERT INTO `excursionbooking` (`id`, `tourist_id`, `excursion_id`, `booking_date`, `excursion_date`) VALUES
(1, 1, 1, '2024-10-06', '2024-10-11'),
(2, 2, 2, '2024-09-10', '2024-09-17'),
(3, 27, 3, '2024-11-06', '2024-11-11');

-- --------------------------------------------------------

--
-- Структура таблицы `financialitem`
--

CREATE TABLE `financialitem` (
  `id` int(11) NOT NULL,
  `item_type` enum('Доход','Расход') NOT NULL,
  `category` varchar(100) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `group_id` int(11) DEFAULT NULL,
  `report_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `financialitem`
--

INSERT INTO `financialitem` (`id`, `item_type`, `category`, `amount`, `group_id`, `report_date`) VALUES
(1, 'Доход', 'Продажа туров', 30000.00, 1, '2024-09-10'),
(2, 'Доход', 'Экскурсии', 15000.00, 2, '2024-09-19'),
(3, 'Доход', 'Авиабилеты', 10000.00, 3, '2024-10-01'),
(4, 'Расход', 'Транспортные расходы', 15000.00, 1, '2024-09-11'),
(5, 'Расход', 'Проживание', 10000.00, 2, '2024-09-17'),
(6, 'Расход', 'Питание', 5000.00, 3, '2024-10-01'),
(7, 'Доход', 'Продажа туров', 25000.00, 1, '2024-09-12'),
(8, 'Доход', 'Экскурсии', 10000.00, 2, '2024-09-15'),
(9, 'Доход', 'Авиабилеты', 10000.00, 4, '2024-10-09'),
(10, 'Расход', 'Транспортные расходы', 2000.00, 4, '2024-10-08'),
(11, 'Расход', 'Проживание', 2000.00, 4, '2024-10-05'),
(12, 'Расход', 'Питание', 1000.00, 4, '2024-10-04'),
(13, 'Доход', 'Продажа туров', 35000.00, 5, '2024-10-11'),
(14, 'Доход', 'Экскурсии', 15000.00, 6, '2024-10-10'),
(15, 'Доход', 'Авиабилеты', 10000.00, 7, '2024-10-12'),
(16, 'Расход', 'Транспортные расходы', 20000.00, 5, '2024-10-11'),
(17, 'Расход', 'Проживание', 10000.00, 6, '2024-10-09'),
(18, 'Расход', 'Питание', 5000.00, 7, '2024-10-14'),
(19, 'Доход', 'Продажа туров', 30000.00, 8, '2024-10-04'),
(20, 'Доход', 'Экскурсии', 15000.00, 9, '2024-10-07'),
(21, 'Доход', 'Авиабилеты', 10000.00, 10, '2024-10-10'),
(22, 'Расход', 'Транспортные расходы', 15000.00, 8, '2024-10-04'),
(23, 'Расход', 'Проживание', 10000.00, 9, '2024-10-07'),
(24, 'Расход', 'Питание', 5000.00, 10, '2024-10-09'),
(25, 'Доход', 'Продажа туров', 28000.00, 11, '2024-10-16'),
(26, 'Доход', 'Экскурсии', 10000.00, 12, '2024-10-06'),
(27, 'Доход', 'Авиабилеты', 10000.00, 13, '2024-11-08'),
(28, 'Расход', 'Транспортные расходы', 14000.00, 11, '2024-10-17'),
(29, 'Расход', 'Проживание', 10000.00, 12, '2024-10-08'),
(30, 'Расход', 'Питание', 4000.00, 13, '2024-11-06'),
(31, 'Доход', 'Продажа туров', 32000.00, 11, '2024-10-14'),
(32, 'Доход', 'Экскурсии', 10000.00, 4, '2024-10-07'),
(33, 'Доход', 'Авиабилеты', 10000.00, 5, '2024-10-10'),
(34, 'Расход', 'Транспортные расходы', 15000.00, 6, '2024-10-08'),
(35, 'Расход', 'Проживание', 12000.00, 7, '2024-10-12'),
(36, 'Расход', 'Питание', 5000.00, 8, '2024-10-03'),
(37, 'Доход', 'Продажа туров', 33000.00, 9, '2024-10-09'),
(38, 'Доход', 'Экскурсии', 15000.00, 10, '2024-10-09'),
(39, 'Доход', 'Авиабилеты', 9000.00, 11, '2024-10-14'),
(40, 'Расход', 'Транспортные расходы', 17000.00, 12, '2024-10-08'),
(41, 'Расход', 'Проживание', 11000.00, 13, '2024-11-07'),
(42, 'Расход', 'Питание', 5000.00, 1, '2024-09-10'),
(43, 'Доход', 'Продажа туров', 29000.00, 2, '2024-09-15'),
(44, 'Доход', 'Экскурсии', 12000.00, 3, '2024-10-03'),
(45, 'Доход', 'Авиабилеты', 8000.00, 4, '2024-10-05'),
(46, 'Расход', 'Транспортные расходы', 14000.00, 5, '2024-10-10'),
(47, 'Расход', 'Проживание', 10000.00, 6, '2024-10-10'),
(48, 'Расход', 'Питание', 5000.00, 7, '2024-10-13'),
(49, 'Доход', 'Продажа туров', 40000.00, 8, '2024-10-03'),
(50, 'Доход', 'Экскурсии', 15000.00, 9, '2024-10-07'),
(51, 'Доход', 'Продажа туров', 28000.00, 12, '2024-10-06'),
(52, 'Доход', 'Продажа туров', 28000.00, 13, '2024-11-08');

-- --------------------------------------------------------

--
-- Структура таблицы `flight`
--

CREATE TABLE `flight` (
  `id` int(11) NOT NULL,
  `flight_number` varchar(50) NOT NULL,
  `flight_date` date NOT NULL,
  `aircraft_type` varchar(100) DEFAULT NULL,
  `type` enum('грузовой','грузопассажирский') NOT NULL DEFAULT 'грузопассажирский'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `flight`
--

INSERT INTO `flight` (`id`, `flight_number`, `flight_date`, `aircraft_type`, `type`) VALUES
(1, 'FL-001-A', '2024-09-10', 'Boeing 737', 'грузопассажирский'),
(2, 'FL-001-D', '2024-09-20', 'Boeing 737', 'грузопассажирский'),
(3, 'FL-002-A', '2024-09-15', 'Boeing 737', 'грузопассажирский'),
(4, 'FL-002-G', '2024-09-20', 'Boeing 737', 'грузовой'),
(5, 'FL-003-A', '2024-10-01', 'Boeing 737', 'грузопассажирский'),
(6, 'FL-003-D', '2024-10-11', 'Boeing 737', 'грузопассажирский'),
(7, 'FL-004-A', '2024-10-05', 'Boeing 737', 'грузопассажирский'),
(8, 'FL-004-D', '2024-10-15', 'Boeing 737', 'грузопассажирский'),
(9, 'FL-005-A', '2024-10-10', 'Boeing 737', 'грузопассажирский'),
(10, 'FL-005-G', '2024-10-20', 'Boeing 737', 'грузовой'),
(11, 'FL-007-G', '2024-10-12', 'Boeing 737', 'грузовой'),
(12, 'FL-006-G', '2024-10-22', 'Boeing 737', 'грузовой'),
(13, 'FL-007-A', '2024-10-14', 'Boeing 737', 'грузопассажирский'),
(14, 'FL-007-D', '2024-10-23', 'Boeing 737', 'грузопассажирский');

-- --------------------------------------------------------

--
-- Структура таблицы `flightcargo`
--

CREATE TABLE `flightcargo` (
  `id` int(11) NOT NULL,
  `flight_id` int(11) DEFAULT NULL,
  `cargo_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `flightcargo`
--

INSERT INTO `flightcargo` (`id`, `flight_id`, `cargo_id`) VALUES
(1, 1, 1),
(2, 5, 2),
(3, 13, 3),
(4, 2, 4),
(5, 6, 5),
(6, 14, 6),
(7, 8, 7),
(8, 5, 8),
(9, 13, 9),
(10, 2, 10),
(11, 3, 11),
(12, 7, 12),
(13, 9, 13),
(14, 10, 14),
(15, 4, 15),
(16, 6, 16),
(17, 8, 17),
(18, 1, 18),
(19, 11, 19),
(20, 12, 20),
(21, 3, 21),
(22, 4, 22),
(23, 5, 23),
(24, 6, 24),
(25, 7, 25),
(26, 8, 26),
(27, 9, 27),
(28, 10, 28),
(29, 1, 29),
(30, 2, 30);

-- --------------------------------------------------------

--
-- Структура таблицы `hotel`
--

CREATE TABLE `hotel` (
  `id` int(11) NOT NULL,
  `hotel_name` varchar(255) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `total_rooms` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `hotel`
--

INSERT INTO `hotel` (`id`, `hotel_name`, `address`, `total_rooms`) VALUES
(1, 'Hotel Roma', 'Рим, Via della Conciliazione, 1', 120),
(2, 'Hotel Paris', 'Париж, Champs-Élysées, 55', 150),
(3, 'Hotel Venice', 'Венеция, Piazza San Marco, 10', 90),
(4, 'Hotel Paris', 'Champs-Élysées, Paris, France', 150),
(5, 'Hotel Berlin', 'Unter den Linden, Berlin, Germany', 200),
(7, 'Hotel Madrid', 'Gran Vía, Madrid, Spain', 180),
(8, 'Hotel Tokyo', 'Shibuya, Tokyo, Japan', 250),
(9, 'Hotel New York', 'Times Square, New York, USA', 300),
(10, 'Hotel London', 'Piccadilly Circus, London, UK', 220),
(11, 'Hotel Sydney', 'Opera House, Sydney, Australia', 200),
(12, 'Hotel Dubai', 'Burj Khalifa Area, Dubai, UAE', 350),
(13, 'Hotel Cairo', 'Tahrir Square, Cairo, Egypt', 130);

-- --------------------------------------------------------

--
-- Структура таблицы `tourist`
--

CREATE TABLE `tourist` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `surname` varchar(255) NOT NULL,
  `patronymic` varchar(255) NOT NULL,
  `passport_data` varchar(100) NOT NULL,
  `gender` enum('Мужской','Женский') NOT NULL,
  `birth_date` date NOT NULL,
  `has_children` tinyint(1) DEFAULT 0,
  `group_id` int(11) DEFAULT NULL,
  `trip_purpose` enum('Отдых','Шопинг') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `tourist`
--

INSERT INTO `tourist` (`id`, `name`, `surname`, `patronymic`, `passport_data`, `gender`, `birth_date`, `has_children`, `group_id`, `trip_purpose`) VALUES
(1, 'Петр', 'Иванов', 'Николаевич', '687356789', 'Мужской', '1985-05-12', 1, 12, 'Отдых'),
(2, 'Ольга', 'Смирнова', 'Дмитриевна', '987654634', 'Женский', '1987-07-23', 0, 2, 'Шопинг'),
(3, 'Алексей', 'Кузнецов ', 'Андреевич', '654987177', 'Мужской', '1990-03-15', 1, 3, 'Отдых'),
(5, 'Мария', 'Петрова', 'Петровна', '2345678901', 'Женский', '1986-09-30', 1, 5, 'Отдых'),
(6, 'Алексей', 'Сидоров', 'Алексеевич', '3456789012', 'Мужской', '1983-12-20', 0, 6, 'Шопинг'),
(7, 'Анна', 'Васильева', 'Васильевна', '4567890123', 'Женский', '1992-11-01', 1, 7, 'Отдых'),
(8, 'Дмитрий', 'Николаев', 'Дмитриевич', '5678901234', 'Мужской', '1991-06-18', 0, 8, 'Шопинг'),
(9, 'Ольга', 'Федорова', 'Федоровна', '6789012345', 'Женский', '1984-01-25', 1, 9, 'Отдых'),
(10, 'Сергей', 'Ковалев', 'Сергеевич', '7890123456', 'Мужской', '1993-08-13', 0, 10, 'Шопинг'),
(11, 'Екатерина', 'Смирнова', 'Смирновна', '8901234567', 'Женский', '1982-04-22', 1, 11, 'Отдых'),
(12, 'Андрей', 'Морозов', 'Андреевич', '9012345678', 'Мужской', '1989-10-05', 0, 12, 'Шопинг'),
(13, 'Наталия', 'Гусарова', 'Гусаровна', '0123456789', 'Женский', '1990-01-14', 1, 1, 'Отдых'),
(14, 'Иван', 'Иванов', 'Иванович', '1234567890', 'Мужской', '1985-05-12', 0, 2, 'Шопинг'),
(15, 'Анна', 'Петрова', 'Алексеевна', '4435678901', 'Женский', '1990-07-23', 0, 3, 'Отдых'),
(16, 'Сергей', 'Сидоров', 'Петрович', '3456789012', 'Мужской', '1987-02-16', 0, 4, 'Шопинг'),
(17, 'Екатерина', 'Морозова', 'Игоревна', '4567890123', 'Женский', '1992-11-30', 0, 4, 'Отдых'),
(18, 'Дмитрий', 'Кузнецов', 'Андреевич', '5678901234', 'Мужской', '1989-09-09', 0, 6, 'Шопинг'),
(19, 'Ольга', 'Федорова', 'Васильевна', '6789012345', 'Женский', '1988-03-14', 0, 7, 'Отдых'),
(20, 'Алексей', 'Новиков', 'Сергеевич', '7890123456', 'Мужской', '1984-07-07', 0, 8, 'Шопинг'),
(21, 'Марина', 'Васильева', 'Павловна', '8901234567', 'Женский', '1986-11-22', 0, 4, 'Шопинг'),
(22, 'Павел', 'Егоров', 'Николаевич', '9012345678', 'Мужской', '1983-01-03', 0, 10, 'Шопинг'),
(23, 'Елена', 'Козлова', 'Игоревна', '5649356789', 'Женский', '1985-12-19', 0, 11, 'Отдых'),
(27, 'Петр', 'Иванов', 'Николаевич', '687356789', 'Мужской', '1985-05-12', 0, 13, 'Отдых');

-- --------------------------------------------------------

--
-- Структура таблицы `touristflight`
--

CREATE TABLE `touristflight` (
  `id` int(11) NOT NULL,
  `tourist_id` int(11) DEFAULT NULL,
  `flight_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `touristflight`
--

INSERT INTO `touristflight` (`id`, `tourist_id`, `flight_id`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 3, 5),
(4, 3, 6),
(5, 6, 13),
(6, 6, 14),
(7, 19, 14),
(8, 12, 13);

-- --------------------------------------------------------

--
-- Структура таблицы `touristgroup`
--

CREATE TABLE `touristgroup` (
  `id` int(11) NOT NULL,
  `group_name` varchar(255) NOT NULL,
  `arrival_date` date NOT NULL,
  `departure_date` date NOT NULL,
  `country` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `touristgroup`
--

INSERT INTO `touristgroup` (`id`, `group_name`, `arrival_date`, `departure_date`, `country`) VALUES
(1, 'Группа в Италию №1', '2024-09-10', '2024-09-20', 'Италия'),
(2, 'Группа во Францию №1', '2024-09-15', '2024-09-25', 'Франция'),
(3, 'Группа в Париж №1', '2024-10-01', '2024-10-11', 'Франция'),
(4, 'Группа в Берлин №1', '2024-10-05', '2024-10-15', 'Франция'),
(5, 'Группа в Италию №2', '2024-10-10', '2024-10-20', 'Италия'),
(6, 'Группа в Мадрид №1', '2024-10-08', '2024-10-18', 'Испании'),
(7, 'Группа в Токио №1', '2024-10-12', '2024-10-22', 'Япония'),
(8, 'Группа в Вашинктон №1', '2024-10-03', '2024-10-13', 'США'),
(9, 'Группа в Лондон №1', '2024-10-07', '2024-10-17', 'Великобритания'),
(10, 'Группа в Сидней №1', '2024-10-09', '2024-10-19', 'Австралия'),
(11, 'Группа в Дубай №1', '2024-10-14', '2024-10-24', 'ОАЭ'),
(12, 'Группа в Каир №1', '2024-10-06', '2024-10-16', 'Египет'),
(13, 'Группа в Александрию №1', '2024-11-06', '2024-11-16', 'Египет');

-- --------------------------------------------------------

--
-- Структура таблицы `visa`
--

CREATE TABLE `visa` (
  `id` int(11) NOT NULL,
  `tourist_id` int(11) DEFAULT NULL,
  `visa_number` varchar(100) NOT NULL,
  `issue_date` date NOT NULL,
  `expiry_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `visa`
--

INSERT INTO `visa` (`id`, `tourist_id`, `visa_number`, `issue_date`, `expiry_date`) VALUES
(1, 1, 'IT123456789', '2024-08-01', '2024-10-01'),
(2, 2, 'FR987654321', '2024-08-10', '2024-10-10');

-- --------------------------------------------------------

--
-- Структура таблицы `warehouse`
--

CREATE TABLE `warehouse` (
  `id` int(11) NOT NULL,
  `location` varchar(255) NOT NULL,
  `capacity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `warehouse`
--

INSERT INTO `warehouse` (`id`, `location`, `capacity`) VALUES
(1, 'Рим, Италия', 100),
(2, 'Париж, Франция', 150),
(3, 'Токио, Япония', 200),
(4, 'Берлин, Германия', 120),
(5, 'Лондон, Великобритания', 130),
(6, 'Вашингтон, США', 140),
(7, 'Мадрид, Испания', 110),
(8, 'Дубай, ОАЭ', 180),
(9, 'Каир, Египет', 160),
(10, 'Москва, Россия', 170);

-- --------------------------------------------------------

--
-- Структура таблицы `warehouserecord`
--

CREATE TABLE `warehouserecord` (
  `id` int(11) NOT NULL,
  `cargo_id` int(11) DEFAULT NULL,
  `warehouse_id` int(11) DEFAULT NULL,
  `date_received` date NOT NULL,
  `date_shipped` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `warehouserecord`
--

INSERT INTO `warehouserecord` (`id`, `cargo_id`, `warehouse_id`, `date_received`, `date_shipped`) VALUES
(1, 1, 1, '2024-09-11', '2024-09-15'),
(2, 2, 2, '2024-10-02', '2024-10-08'),
(3, 3, 3, '2024-10-15', '2024-10-20'),
(4, 4, 4, '2024-09-12', '2024-09-18'),
(5, 5, 5, '2024-10-03', '2024-10-09'),
(6, 6, 6, '2024-10-16', '2024-10-22'),
(7, 7, 7, '2024-09-13', '2024-09-19'),
(8, 8, 8, '2024-10-04', '2024-10-10'),
(9, 9, 9, '2024-10-17', '2024-10-23'),
(10, 10, 10, '2024-09-14', '2024-09-20'),
(11, 11, 1, '2024-10-01', '2024-10-05'),
(12, 12, 2, '2024-10-06', '2024-10-12'),
(13, 13, 3, '2024-10-08', '2024-10-15'),
(14, 14, 4, '2024-09-19', '2024-09-25'),
(15, 15, 5, '2024-10-10', '2024-10-15'),
(16, 16, 6, '2024-10-20', '2024-10-26'),
(17, 17, 7, '2024-09-20', '2024-09-27'),
(18, 18, 8, '2024-10-11', '2024-10-17'),
(19, 19, 9, '2024-10-21', '2024-10-27'),
(20, 20, 10, '2024-09-21', '2024-09-28'),
(21, 21, 1, '2024-10-22', '2024-10-28'),
(22, 22, 2, '2024-10-23', '2024-10-30'),
(23, 23, 3, '2024-10-25', '2024-10-31'),
(24, 24, 4, '2024-09-29', '2024-10-05'),
(25, 25, 5, '2024-10-28', '2024-11-03'),
(26, 26, 6, '2024-10-30', '2024-11-05'),
(27, 27, 7, '2024-09-30', '2024-10-06'),
(28, 28, 8, '2024-11-01', '2024-11-07'),
(29, 29, 9, '2024-11-02', '2024-11-08'),
(30, 30, 10, '2024-10-02', '2024-10-09');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `accommodation`
--
ALTER TABLE `accommodation`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tourist_id` (`tourist_id`),
  ADD KEY `hotel_id` (`hotel_id`);

--
-- Индексы таблицы `cargo`
--
ALTER TABLE `cargo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tourist_id` (`tourist_id`);

--
-- Индексы таблицы `child`
--
ALTER TABLE `child`
  ADD PRIMARY KEY (`id`),
  ADD KEY `parent_id` (`parent_id`);

--
-- Индексы таблицы `excursion`
--
ALTER TABLE `excursion`
  ADD PRIMARY KEY (`id`),
  ADD KEY `agency_id` (`agency_id`);

--
-- Индексы таблицы `excursionagency`
--
ALTER TABLE `excursionagency`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `excursionbooking`
--
ALTER TABLE `excursionbooking`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tourist_id` (`tourist_id`),
  ADD KEY `excursion_id` (`excursion_id`);

--
-- Индексы таблицы `financialitem`
--
ALTER TABLE `financialitem`
  ADD PRIMARY KEY (`id`),
  ADD KEY `group_id` (`group_id`);

--
-- Индексы таблицы `flight`
--
ALTER TABLE `flight`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `flightcargo`
--
ALTER TABLE `flightcargo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `flight_id` (`flight_id`),
  ADD KEY `cargo_id` (`cargo_id`);

--
-- Индексы таблицы `hotel`
--
ALTER TABLE `hotel`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `tourist`
--
ALTER TABLE `tourist`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_tourist_group` (`group_id`);

--
-- Индексы таблицы `touristflight`
--
ALTER TABLE `touristflight`
  ADD PRIMARY KEY (`id`),
  ADD KEY `flight_id` (`flight_id`);

--
-- Индексы таблицы `touristgroup`
--
ALTER TABLE `touristgroup`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `visa`
--
ALTER TABLE `visa`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `warehouse`
--
ALTER TABLE `warehouse`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `warehouserecord`
--
ALTER TABLE `warehouserecord`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cargo_id` (`cargo_id`),
  ADD KEY `warehouse_id` (`warehouse_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `accommodation`
--
ALTER TABLE `accommodation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `cargo`
--
ALTER TABLE `cargo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT для таблицы `child`
--
ALTER TABLE `child`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `excursion`
--
ALTER TABLE `excursion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `excursionagency`
--
ALTER TABLE `excursionagency`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT для таблицы `excursionbooking`
--
ALTER TABLE `excursionbooking`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `financialitem`
--
ALTER TABLE `financialitem`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT для таблицы `flight`
--
ALTER TABLE `flight`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT для таблицы `flightcargo`
--
ALTER TABLE `flightcargo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT для таблицы `hotel`
--
ALTER TABLE `hotel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT для таблицы `tourist`
--
ALTER TABLE `tourist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT для таблицы `touristflight`
--
ALTER TABLE `touristflight`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT для таблицы `touristgroup`
--
ALTER TABLE `touristgroup`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT для таблицы `visa`
--
ALTER TABLE `visa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `warehouse`
--
ALTER TABLE `warehouse`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT для таблицы `warehouserecord`
--
ALTER TABLE `warehouserecord`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `accommodation`
--
ALTER TABLE `accommodation`
  ADD CONSTRAINT `accommodation_ibfk_1` FOREIGN KEY (`tourist_id`) REFERENCES `tourist` (`id`),
  ADD CONSTRAINT `accommodation_ibfk_2` FOREIGN KEY (`hotel_id`) REFERENCES `hotel` (`id`);

--
-- Ограничения внешнего ключа таблицы `cargo`
--
ALTER TABLE `cargo`
  ADD CONSTRAINT `cargo_ibfk_1` FOREIGN KEY (`tourist_id`) REFERENCES `tourist` (`id`);

--
-- Ограничения внешнего ключа таблицы `child`
--
ALTER TABLE `child`
  ADD CONSTRAINT `child_ibfk_1` FOREIGN KEY (`parent_id`) REFERENCES `tourist` (`id`);

--
-- Ограничения внешнего ключа таблицы `excursion`
--
ALTER TABLE `excursion`
  ADD CONSTRAINT `excursion_ibfk_1` FOREIGN KEY (`agency_id`) REFERENCES `excursionagency` (`id`);

--
-- Ограничения внешнего ключа таблицы `excursionbooking`
--
ALTER TABLE `excursionbooking`
  ADD CONSTRAINT `excursionbooking_ibfk_1` FOREIGN KEY (`tourist_id`) REFERENCES `tourist` (`id`),
  ADD CONSTRAINT `excursionbooking_ibfk_2` FOREIGN KEY (`excursion_id`) REFERENCES `excursion` (`id`);

--
-- Ограничения внешнего ключа таблицы `financialitem`
--
ALTER TABLE `financialitem`
  ADD CONSTRAINT `financialitem_ibfk_1` FOREIGN KEY (`group_id`) REFERENCES `touristgroup` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `flightcargo`
--
ALTER TABLE `flightcargo`
  ADD CONSTRAINT `flightcargo_ibfk_1` FOREIGN KEY (`flight_id`) REFERENCES `flight` (`id`),
  ADD CONSTRAINT `flightcargo_ibfk_2` FOREIGN KEY (`cargo_id`) REFERENCES `cargo` (`id`);

--
-- Ограничения внешнего ключа таблицы `tourist`
--
ALTER TABLE `tourist`
  ADD CONSTRAINT `fk_tourist_group` FOREIGN KEY (`group_id`) REFERENCES `touristgroup` (`id`) ON DELETE SET NULL;

--
-- Ограничения внешнего ключа таблицы `touristflight`
--
ALTER TABLE `touristflight`
  ADD CONSTRAINT `touristflight_ibfk_1` FOREIGN KEY (`tourist_id`) REFERENCES `tourist` (`id`),
  ADD CONSTRAINT `touristflight_ibfk_2` FOREIGN KEY (`flight_id`) REFERENCES `flight` (`id`);

--
-- Ограничения внешнего ключа таблицы `visa`
--
ALTER TABLE `visa`
  ADD CONSTRAINT `visa_ibfk_1` FOREIGN KEY (`tourist_id`) REFERENCES `tourist` (`id`);

--
-- Ограничения внешнего ключа таблицы `warehouserecord`
--
ALTER TABLE `warehouserecord`
  ADD CONSTRAINT `warehouserecord_ibfk_1` FOREIGN KEY (`cargo_id`) REFERENCES `cargo` (`id`),
  ADD CONSTRAINT `warehouserecord_ibfk_2` FOREIGN KEY (`warehouse_id`) REFERENCES `warehouse` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
