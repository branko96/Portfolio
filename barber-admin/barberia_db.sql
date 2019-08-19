-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 07-06-2019 a las 17:30:54
-- Versión del servidor: 10.1.38-MariaDB
-- Versión de PHP: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `barberia_db`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `agenda`
--

CREATE TABLE `agenda` (
  `id` int(11) NOT NULL,
  `notas` text,
  `fecha` varchar(50) DEFAULT NULL,
  `hora` varchar(50) DEFAULT NULL,
  `fecha_reserva` datetime DEFAULT NULL,
  `cliente_id` int(11) DEFAULT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `barbero_id` int(11) DEFAULT NULL,
  `precio` double DEFAULT NULL,
  `estado_pago_id` int(11) NOT NULL DEFAULT '1',
  `estado_id` int(11) NOT NULL DEFAULT '1',
  `servicio_id` int(11) NOT NULL,
  `endturno` varchar(50) DEFAULT NULL,
  `inactivo` int(1) NOT NULL,
  `forma_pago` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `agenda`
--

INSERT INTO `agenda` (`id`, `notas`, `fecha`, `hora`, `fecha_reserva`, `cliente_id`, `usuario_id`, `barbero_id`, `precio`, `estado_pago_id`, `estado_id`, `servicio_id`, `endturno`, `inactivo`, `forma_pago`) VALUES
(190, '', '2019-05-21', '11:30', '2019-05-23 08:43:13', 3, 72, 1, 200, 1, 1, 2, '12:30', 0, NULL),
(194, '', '2019-06-06', '10:30', '2019-06-07 11:08:44', 5, 72, 1, 0, 1, 1, 1, '11:00', 0, 'tarjeta'),
(195, '', '2019-06-06', '11:00', '2019-06-07 11:56:46', 3, 72, 1, 0, 1, 1, 1, '11:30', 0, 'tarjeta');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `barberos`
--

CREATE TABLE `barberos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) DEFAULT NULL,
  `apellido` varchar(50) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `telefono` varchar(255) DEFAULT NULL,
  `imagen` varchar(255) DEFAULT NULL,
  `es_activo` tinyint(1) NOT NULL DEFAULT '1',
  `fecha_creacion` datetime DEFAULT NULL,
  `categoria_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `barberos`
--

INSERT INTO `barberos` (`id`, `nombre`, `apellido`, `email`, `telefono`, `imagen`, `es_activo`, `fecha_creacion`, `categoria_id`) VALUES
(1, 'Dani', 'Entraigas', 'danielentraigas@hotmail.com', '2920411922', NULL, 1, '2019-04-04 01:18:24', NULL),
(2, 'Mati', 'Noval', 'matii.noval@outlook.com', '2915249065', NULL, 1, '2019-04-04 01:18:24', NULL),
(3, 'Tomi', 'Cassagne', 'thomascassagne18@gmail.com', '2915262643', NULL, 1, '2019-05-01 00:00:00', NULL),
(4, 'Jona', 'Carrasco', 'jonatan_carrasco@hotmail.com', '2922424353', NULL, 1, '2019-05-01 00:00:00', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) DEFAULT NULL,
  `apellido` varchar(50) DEFAULT NULL,
  `telefono` varchar(50) DEFAULT NULL,
  `email` varchar(40) DEFAULT NULL,
  `dni` varchar(8) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id`, `nombre`, `apellido`, `telefono`, `email`, `dni`) VALUES
(2, 'Cliente', 'Dos', '785445412', 'perro@gmail.com', ''),
(3, 'Cliente', 'Uno', '1234556', 'cliente@gmail.com', NULL),
(5, 'pepe', 'pepino', '22222222', 'pepinillo@gmail.com', '11111111');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado_pago`
--

CREATE TABLE `estado_pago` (
  `id` int(11) NOT NULL,
  `estado` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `estado_pago`
--

INSERT INTO `estado_pago` (`id`, `estado`) VALUES
(1, 'Pendiente'),
(2, 'Pagado'),
(3, 'Anulado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicios`
--

CREATE TABLE `servicios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(200) DEFAULT NULL,
  `importe` float NOT NULL,
  `tiempo` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `servicios`
--

INSERT INTO `servicios` (`id`, `nombre`, `importe`, `tiempo`) VALUES
(1, 'Corte', 100, 1800),
(2, 'Corte y Barba', 200, 3600);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `status`
--

CREATE TABLE `status` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `status`
--

INSERT INTO `status` (`id`, `nombre`) VALUES
(1, 'Pendiente'),
(2, 'Aplicada'),
(3, 'No asistio'),
(4, 'Cancelada');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) DEFAULT NULL,
  `apellido` varchar(50) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(60) DEFAULT NULL,
  `es_activo` tinyint(1) NOT NULL DEFAULT '1',
  `es_admin` tinyint(1) NOT NULL DEFAULT '0',
  `fecha_creacion` datetime DEFAULT NULL,
  `id_barbero` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `apellido`, `email`, `password`, `es_activo`, `es_admin`, `fecha_creacion`, `id_barbero`) VALUES
(18, 'dani', 'entraigas', 'dani@gmail.com', 'adcd7048512e64b48da55b027577886ee5a36350', 1, 1, '2019-05-06 19:41:45', 1),
(55, 'Mati', 'Noval', 'matii.noval@outlook.com', 'adcd7048512e64b48da55b027577886ee5a36350', 1, 1, '2019-05-07 18:07:33', 2),
(56, 'Tomi', 'Cassagne', 'thomascassagne18@gmail.com', 'adcd7048512e64b48da55b027577886ee5a36350', 1, 1, '2019-05-07 18:08:05', 3),
(57, 'Jona', 'Carrasco', 'jonatan_carrasco@hotmail.com', 'adcd7048512e64b48da55b027577886ee5a36350', 1, 1, '2019-05-07 18:08:26', 4),
(72, 'admin', 'admin', 'admin@gmail.com', 'adcd7048512e64b48da55b027577886ee5a36350', 1, 1, '2019-05-07 19:10:41', 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `agenda`
--
ALTER TABLE `agenda`
  ADD PRIMARY KEY (`id`),
  ADD KEY `payment_id` (`estado_pago_id`),
  ADD KEY `status_id` (`estado_id`),
  ADD KEY `user_id` (`usuario_id`),
  ADD KEY `pacient_id` (`cliente_id`),
  ADD KEY `medic_id` (`barbero_id`),
  ADD KEY `servicio_id` (`servicio_id`);

--
-- Indices de la tabla `barberos`
--
ALTER TABLE `barberos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`categoria_id`);

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `estado_pago`
--
ALTER TABLE `estado_pago`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `servicios`
--
ALTER TABLE `servicios`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_barbero` (`id_barbero`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `agenda`
--
ALTER TABLE `agenda`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=196;

--
-- AUTO_INCREMENT de la tabla `barberos`
--
ALTER TABLE `barberos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `estado_pago`
--
ALTER TABLE `estado_pago`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `servicios`
--
ALTER TABLE `servicios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `status`
--
ALTER TABLE `status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `agenda`
--
ALTER TABLE `agenda`
  ADD CONSTRAINT `agenda_ibfk_1` FOREIGN KEY (`estado_pago_id`) REFERENCES `estado_pago` (`id`),
  ADD CONSTRAINT `agenda_ibfk_2` FOREIGN KEY (`estado_id`) REFERENCES `status` (`id`),
  ADD CONSTRAINT `agenda_ibfk_5` FOREIGN KEY (`barbero_id`) REFERENCES `barberos` (`id`),
  ADD CONSTRAINT `agenda_ibfk_6` FOREIGN KEY (`servicio_id`) REFERENCES `servicios` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `agenda_ibfk_7` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Filtros para la tabla `barberos`
--
ALTER TABLE `barberos`
  ADD CONSTRAINT `barberos_ibfk_1` FOREIGN KEY (`categoria_id`) REFERENCES `servicios` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
