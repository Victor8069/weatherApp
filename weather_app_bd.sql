-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 26-09-2024 a las 16:57:39
-- Versión del servidor: 10.4.20-MariaDB
-- Versión de PHP: 8.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `weather_app`
--

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `LOGIN` (IN `USER` VARCHAR(50), IN `PASS` VARCHAR(100))  BEGIN                 
                DECLARE NOMBRE	CHAR(50);
                DECLARE CONTRA	CHAR(100);

SELECT user_weather.id, user_weather.username , user_weather.password
INTO @UID, @USU,@CONTRA FROM user_weather
WHERE user_weather.username=USER 
AND user_weather.password=PASS LIMIT 1;

                SELECT COUNT(id) INTO @CON FROM login WHERE login.user_id=@UID;

                IF @UID>0 THEN
                        INSERT INTO login (user_id, login_date) values (@UID, CURRENT_TIMESTAMP);
                        SET @RES="SI";
                    ELSE
                        SET @RES="NO";
                    END IF;

                SELECT @UID AS 'Uid',@RES AS 'Login',@USU AS 'User',@CONTRA AS 'Passw';

END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `login`
--

CREATE TABLE `login` (
  `id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `login_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `login`
--

INSERT INTO `login` (`id`, `user_id`, `login_date`) VALUES
(39, 36, '2024-09-07 08:55:28'),
(40, 36, '2024-09-07 08:56:50'),
(41, 36, '2024-09-07 08:59:13'),
(42, 36, '2024-09-07 09:02:31'),
(43, 36, '2024-09-07 09:03:10'),
(44, 36, '2024-09-07 09:04:18'),
(45, 36, '2024-09-07 09:08:59'),
(46, 36, '2024-09-07 09:09:24'),
(47, 36, '2024-09-07 09:13:31'),
(48, 36, '2024-09-07 09:16:08'),
(49, 35, '2024-09-07 09:19:40'),
(50, 36, '2024-09-07 23:57:24');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user_weather`
--

CREATE TABLE `user_weather` (
  `id` int(10) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `email` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `user_weather`
--

INSERT INTO `user_weather` (`id`, `username`, `password`, `email`) VALUES
(35, 'victorz', 'f938c93da3eeabf30a6679828dede59c', 'victor.zapata8069@gmail.com'),
(36, 'soporte345', 'f938c93da3eeabf30a6679828dede59c', 'victor.zapata8069@gmail.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `weather_log`
--

CREATE TABLE `weather_log` (
  `id` int(10) NOT NULL,
  `city` varchar(30) NOT NULL,
  `weather_desc` varchar(200) NOT NULL,
  `temperature` varchar(10) NOT NULL,
  `date_log` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `user_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `weather_log`
--

INSERT INTO `weather_log` (`id`, `city`, `weather_desc`, `temperature`, `date_log`, `user_id`) VALUES
(1, 'Santiago de Cali', 'broken clouds', '21', '2024-09-07 05:00:00', 35),
(2, 'Cúcuta', 'overcast clouds', '25.6000000', '2024-09-07 07:32:15', 35),
(3, 'Seville', 'clear sky', '18.3700000', '2024-09-07 07:32:53', 35),
(4, 'Bogota', 'scattered clouds', '8.73000000', '2024-09-07 07:36:33', 35),
(5, 'Medellín', 'broken clouds', '19.08', '2024-09-07 07:37:32', 35),
(6, 'Los Angeles', 'clear sky', '23.69', '2024-09-07 08:25:03', 36),
(7, 'Santiago de Cali', 'broken clouds', '21.00', '2024-09-07 08:35:43', 36),
(8, 'Cúcuta', 'overcast clouds', '24.50', '2024-09-07 09:20:27', 35),
(9, 'Santiago de Cali', 'broken clouds', '19.00', '2024-09-07 09:20:35', 35),
(10, 'Caracas', 'overcast clouds', '21.67', '2024-09-07 09:20:46', 35),
(11, 'New York', 'overcast clouds', '20.62', '2024-09-07 09:20:54', 35),
(12, 'Villa del Rosario', 'overcast clouds', '25.84', '2024-09-07 09:21:02', 35),
(13, 'Tuluá', 'overcast clouds', '19.20', '2024-09-07 09:21:14', 35),
(14, 'Turkey', 'clear sky', '25.57', '2024-09-07 09:21:33', 35),
(15, 'Dubai', 'clear sky', '38.96', '2024-09-07 09:21:50', 35),
(16, 'Bogota', 'scattered clouds', '9.73', '2024-09-07 09:23:40', 35);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indices de la tabla `user_weather`
--
ALTER TABLE `user_weather`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indices de la tabla `weather_log`
--
ALTER TABLE `weather_log`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `login`
--
ALTER TABLE `login`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT de la tabla `user_weather`
--
ALTER TABLE `user_weather`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT de la tabla `weather_log`
--
ALTER TABLE `weather_log`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `login`
--
ALTER TABLE `login`
  ADD CONSTRAINT `login_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user_weather` (`id`);

--
-- Filtros para la tabla `weather_log`
--
ALTER TABLE `weather_log`
  ADD CONSTRAINT `weather_log_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user_weather` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
