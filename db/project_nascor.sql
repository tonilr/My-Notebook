-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 07-05-2021 a las 10:04:11
-- Versión del servidor: 10.4.17-MariaDB
-- Versión de PHP: 8.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `project_nascor`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notes`
--

CREATE TABLE `notes` (
  `id` int(3) UNSIGNED NOT NULL,
  `name` varchar(40) NOT NULL,
  `details` varchar(500) NOT NULL,
  `id_user` int(3) UNSIGNED NOT NULL,
  `creation_time` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `notes`
--

INSERT INTO `notes` (`id`, `name`, `details`, `id_user`, `creation_time`) VALUES
(7, 'prueba', 'detalles de la nota que acabo de editar para ver qué tal se ven en el navegador', 6, '2021-05-05 13:26:18'),
(9, 'Prueba', 'Desde el móvil', 6, '2021-05-05 13:29:28'),
(10, 'Movil', 'Chequear móvil ', 6, '2021-05-05 13:34:34'),
(11, 'Jdhf', 'Hdvdv', 6, '2021-05-05 13:35:30'),
(12, 'Hfuf', 'Uguf', 6, '2021-05-05 13:35:51');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tasks`
--

CREATE TABLE `tasks` (
  `id` int(3) UNSIGNED NOT NULL,
  `name` varchar(40) NOT NULL,
  `details` varchar(100) NOT NULL,
  `id_lists` int(4) UNSIGNED NOT NULL,
  `id_user` int(3) UNSIGNED NOT NULL,
  `creation_time` datetime NOT NULL DEFAULT current_timestamp(),
  `limit_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tasks`
--

INSERT INTO `tasks` (`id`, `name`, `details`, `id_lists`, `id_user`, `creation_time`, `limit_date`) VALUES
(1, 'test task', 'detalles de tarea de prueba', 4, 6, '2021-05-05 12:46:48', '2021-05-31');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(3) UNSIGNED NOT NULL,
  `username` varchar(20) NOT NULL,
  `email` varchar(40) NOT NULL,
  `name` varchar(20) NOT NULL,
  `password` varchar(64) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `date_signup` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `name`, `password`, `status`, `date_signup`) VALUES
(6, 'test', 'test@test.com', 'test', '$2y$10$wbMEf/KxaFlELuPWXMPbM.8tttJDlAk2.JHBKTFnJndo.vC8WKK1O', 1, '2021-05-05 09:31:46');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `notes`
--
ALTER TABLE `notes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`);

--
-- Indices de la tabla `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `notes`
--
ALTER TABLE `notes`
  MODIFY `id` int(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` int(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `notes`
--
ALTER TABLE `notes`
  ADD CONSTRAINT `notes_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `tasks`
--
ALTER TABLE `tasks`
  ADD CONSTRAINT `tasks_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
