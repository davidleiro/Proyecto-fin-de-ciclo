-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 12-03-2022 a las 16:59:26
-- Versión del servidor: 10.4.14-MariaDB
-- Versión de PHP: 7.4.11
SET
  SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";

START TRANSACTION;

SET
  time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */
;

/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */
;

/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */
;

/*!40101 SET NAMES utf8mb4 */
;

--
-- Base de datos: `kanewokaurestaurant`
--
drop database if exists kanewokaurestaurant;

create database if not exists kanewokauRestaurant;

use kanewokauRestaurant;

-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla `chefs`
--
CREATE TABLE `chefs` (
  `id` bigint(50) not null auto_increment,
  `nombre` varchar(50) NOT NULL,
  `descripcion` varchar(450) NOT NULL,
  `apellido1` varchar(50) NOT NULL,
  `apellido2` varchar(50) NOT NULL,
  `sexo` varchar(9) NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  `nacionalidad` varchar(50) NOT NULL,
  primary key (id)
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;

--
-- Volcado de datos para la tabla `chefs`
--
INSERT INTO
  `chefs` (
    `nombre`,
    `descripcion`,
    `apellido1`,
    `apellido2`,
    `sexo`,
    `fecha_nacimiento`,
    `nacionalidad`
  )
VALUES
  (
    'pepe',
    'KLK',
    'fernandez',
    'rodriguez',
    'H',
    '0000-00-00',
    'Noruega'
  ),
  (
    'JULI',
    'jsiahfsdhifhiosdhfhsdihf',
    'garcia',
    'perez',
    'M',
    '0000-00-00',
    'Marruecos'
  ),
  (
    'Manuel',
    'Experto en vino internacionales',
    'Cuevas',
    'Porto',
    'H',
    '0000-00-00',
    'Frances'
  ),
  (
    'Manuel',
    'Experto en vino internacionales',
    'Cuevas',
    'Porto',
    'H',
    '0000-00-00',
    'Frances'
  );

-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla `reservas`
--
CREATE TABLE `reservas` (
  `idReserva` bigint(20) NOT NULL,
  `idUsuario` bigint(20) NOT NULL,
  `fecha_reserva` timestamp NOT NULL DEFAULT current_timestamp(),
  `comensales` bigint(20) NOT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;

--
-- Volcado de datos para la tabla `reservas`
--
INSERT INTO
  `reservas` (
    `idReserva`,
    `idUsuario`,
    `fecha_reserva`,
    `comensales`
  )
VALUES
  (21, 2, '2022-03-17 16:50:00', 2),
  (22, 2, '2022-03-17 16:50:00', 2),
  (23, 2, '2022-03-10 00:15:00', 3),
  (24, 2, '2022-03-10 00:15:00', 3),
  (26, 2, '2022-03-10 00:15:00', 3),
  (27, 2, '2022-03-10 00:15:00', 3),
  (28, 2, '2022-03-10 00:15:00', 3),
  (29, 2, '2022-03-10 00:15:00', 3),
  (30, 2, '2022-03-10 00:15:00', 3),
  (31, 2, '2022-03-10 00:15:00', 3),
  (32, 2, '2022-03-10 00:15:00', 3),
  (33, 2, '2022-03-10 00:15:00', 3),
  (34, 2, '2022-03-10 00:15:00', 3),
  (35, 2, '2022-03-10 06:25:00', 7),
  (36, 2, '2022-03-10 06:25:00', 7),
  (37, 2, '2022-03-11 21:30:00', 7),
  (39, 4, '2022-03-11 21:30:00', 7),
  (40, 4, '2022-03-11 21:30:00', 7),
  (41, 3, '2022-03-30 18:45:00', 16),
  (42, 3, '2022-03-30 18:45:00', 16);

-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla `roles`
--
CREATE TABLE `roles` (
  `id` bigint(20) NOT NULL,
  `nombre_rol` varchar(50) NOT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;

CREATE TABLE `historico` (
  `idUsuario` bigint(20) not null,
  `fecha` TIMESTAMP not null default CURRENT_TIMESTAMP()
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;
--
-- Volcado de datos para la tabla `roles`
--
INSERT INTO
  `roles` (`id`, `nombre_rol`)
VALUES
  (2, 'administrador'),
  (0, 'anonimo'),
  (1, 'registrado');

-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla `usuarios`
--
CREATE TABLE `usuarios` (
  `codigo` bigint(20) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `contrasenha` varchar(255) NOT NULL,
  `telefono` int(9) NOT NULL,
  `rol` bigint(20) NOT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;

--
-- Volcado de datos para la tabla `usuarios`
--
INSERT INTO
  `usuarios` (
    `codigo`,
    `nombre`,
    `email`,
    `contrasenha`,
    `telefono`,
    `rol`
  )
VALUES
  (2, 'pepe', 'pepe@gmail.com', '12344', 0, 0),
  (
    3,
    'paco',
    'paco@gmail.com',
    '$2y$10$XsydufPwJIHuhe1ss4r5/OFPu4yWNxnanPOL7fqwgBwxPwbzJB.i.',
    1234567,
    0
  ),
  (
    4,
    'davidddddd',
    'davitrix2014@gmail.com',
    '$2y$10$JVATdVXdUsOxUIZ0naaNauiTDlEudBjG0K0isEm.BC14CCxsFb9lu',
    10101,
    1
  );

--
-- Índices para tablas volcadas
--
--
-- Indices de la tabla `reservas`
--
ALTER TABLE
  `reservas`
ADD
  PRIMARY KEY (`idReserva`),
ADD
  KEY `idUsuario` (`idUsuario`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE
  `roles`
ADD
  PRIMARY KEY (`id`),
ADD
  UNIQUE KEY `id` (`id`),
ADD
  UNIQUE KEY `nombre_rol` (`nombre_rol`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE
  `usuarios`
ADD
  PRIMARY KEY (`codigo`),
ADD
  UNIQUE KEY `codigo` (`codigo`),
ADD
  UNIQUE KEY `email` (`email`),
ADD
  KEY `rol` (`rol`);

--
-- AUTO_INCREMENT de las tablas volcadas
--
--
-- AUTO_INCREMENT de la tabla `reservas`
--
ALTER TABLE
  `reservas`
MODIFY
  `idReserva` bigint(20) NOT NULL AUTO_INCREMENT,
  AUTO_INCREMENT = 43;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE
  `usuarios`
MODIFY
  `codigo` bigint(20) NOT NULL AUTO_INCREMENT,
  AUTO_INCREMENT = 5;

--
-- Restricciones para tablas volcadas
--
--
-- Filtros para la tabla `reservas`
--
ALTER TABLE
  `reservas`
ADD
  CONSTRAINT `reservas_ibfk_1` FOREIGN KEY (`idUsuario`) REFERENCES `usuarios` (`codigo`);

ALTER TABLE
  `historico`
ADD
  CONSTRAINT `historico_ibfk_1` FOREIGN KEY (`idUsuario`) REFERENCES `usuarios` (`codigo`);
--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE
  `usuarios`
ADD
  CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`rol`) REFERENCES `roles` (`id`);

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */
;

/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */
;

/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */
;