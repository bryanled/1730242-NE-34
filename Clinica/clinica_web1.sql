-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 19-08-2020 a las 14:45:50
-- Versión del servidor: 10.4.13-MariaDB
-- Versión de PHP: 7.2.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `clinica_web`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asignaciones`
--

CREATE TABLE `asignaciones` (
  `id_asignacion` int(11) NOT NULL,
  `id_paciente` int(11) NOT NULL,
  `id_externo` int(11) NOT NULL,
  `parentesco` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `asignaciones`
--

INSERT INTO `asignaciones` (`id_asignacion`, `id_paciente`, `id_externo`, `parentesco`) VALUES
(1, 1, 1, 'Primos');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado_notificacion`
--

CREATE TABLE `estado_notificacion` (
  `id_estado_n` int(11) NOT NULL,
  `estado` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `estado_notificacion`
--

INSERT INTO `estado_notificacion` (`id_estado_n`, `estado`) VALUES
(1, 'Vista'),
(2, 'No vista');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado_paciente`
--

CREATE TABLE `estado_paciente` (
  `id_estado_p` int(11) NOT NULL,
  `estado` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `estado_paciente`
--

INSERT INTO `estado_paciente` (`id_estado_p`, `estado`) VALUES
(1, 'En observacion'),
(2, 'Alta medica'),
(3, 'Defunsion');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `expedientes`
--

CREATE TABLE `expedientes` (
  `id_expediente` int(11) NOT NULL,
  `id_paciente` int(11) NOT NULL,
  `fecha_hora_ingreso` datetime NOT NULL,
  `fecha_hora_alta` datetime NOT NULL,
  `motivo_alta` text NOT NULL,
  `motivo_ingreso` text NOT NULL,
  `diagnostico` text NOT NULL,
  `fecha_defunsion` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `expedientes`
--

INSERT INTO `expedientes` (`id_expediente`, `id_paciente`, `fecha_hora_ingreso`, `fecha_hora_alta`, `motivo_alta`, `motivo_ingreso`, `diagnostico`, `fecha_defunsion`) VALUES
(1, 1, '2020-08-19 23:25:25', '2020-08-05 14:28:00', 'Defunsion por complicaciones cardiacas', 'Ce rompio la pierna', 'En efecto se rompio la pierna jsjs', '2020-08-14 14:28:00'),
(2, 3, '2020-08-07 01:37:00', '2020-08-25 14:18:00', 'Defunsión por COVID', 'Brazo roto', 'Tendones lastimados', '2020-08-13 16:22:00'),
(3, 4, '2020-08-18 19:46:00', '2020-08-27 00:44:00', 'Defunsion por Covid', 'Enferma Covid', 'Complicaciones respiratorias', '2020-08-19 11:43:00'),
(4, 5, '2020-08-18 18:49:00', '2020-08-15 17:55:00', 'vcbcbc', 'Enferma Covid', 'Complicaciones respiratorias', '0000-00-00 00:00:00'),
(5, 6, '2020-08-27 14:47:00', '0000-00-00 00:00:00', '', 'Enferma Covid', 'Complicaciones severas', '2020-08-29 20:48:00'),
(6, 7, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', 'Dolor abdominal', 'Apendicitis', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notificacion`
--

CREATE TABLE `notificacion` (
  `id_notificacion` int(11) NOT NULL,
  `titulo` text NOT NULL,
  `detalle` text NOT NULL,
  `nombre_interno` text NOT NULL,
  `fecha` datetime NOT NULL,
  `id_estado_n` int(11) NOT NULL,
  `id_paciente` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `notificacion`
--

INSERT INTO `notificacion` (`id_notificacion`, `titulo`, `detalle`, `nombre_interno`, `fecha`, `id_estado_n`, `id_paciente`) VALUES
(1, 'Notifiacion Status COVID', 'Ultima descripcion.', 'Jorge Torres', '2020-08-05 11:25:00', 2, 1),
(4, 'Actalizacion Nueva', 'Nuevos detalles.', 'Jorge Torres', '2020-08-18 22:59:00', 2, 1),
(5, 'dffdfd', 'fdfd', '', '0000-00-00 00:00:00', 1, 7);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pacientes`
--

CREATE TABLE `pacientes` (
  `id_paciente` int(11) NOT NULL,
  `nombre` text NOT NULL,
  `apellidos` text NOT NULL,
  `sexo` text NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  `id_estado_p` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `pacientes`
--

INSERT INTO `pacientes` (`id_paciente`, `nombre`, `apellidos`, `sexo`, `fecha_nacimiento`, `id_estado_p`) VALUES
(1, 'Sergio', 'Nava', 'Hombre', '2020-03-18', 1),
(2, 'Tomas', 'Reyes', 'Hombre', '2020-08-13', 1),
(3, 'Hernan', 'Gonzales', 'Hombre', '2020-08-08', 1),
(4, 'Maria', 'Alvarez', 'Mujer', '2013-07-18', 3),
(5, 'Jose', 'Quiroz', 'Hombre', '2009-06-18', 2),
(6, 'Julio', 'Quiroz', 'Hombre', '2002-07-07', 1),
(7, 'Alberto ', 'Lara', 'Hombre', '2020-08-05', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios_externos`
--

CREATE TABLE `usuarios_externos` (
  `id_externo` int(11) NOT NULL,
  `nombre` text NOT NULL,
  `apellidos` text NOT NULL,
  `sexo` text NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  `correo` text NOT NULL,
  `usuario` text NOT NULL,
  `contraseña` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios_externos`
--

INSERT INTO `usuarios_externos` (`id_externo`, `nombre`, `apellidos`, `sexo`, `fecha_nacimiento`, `correo`, `usuario`, `contraseña`) VALUES
(1, 'Erik', 'Rodriguez', 'Hombre', '2020-07-28', 'erik@gmail.com', 'erik1', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79'),
(3, 'Enrique', 'Martinez', 'Hombre', '2020-09-18', 'francisco@gmail.com', 'enrique7422', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79'),
(4, 'Julio', 'Martinez', 'Hombre', '2021-09-18', 'julio@gmail.com', 'julio1', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79'),
(5, 'Maria', 'Alvarez Rios', 'Mujer', '2021-09-18', 'maria@gmail.com', 'maria1', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79'),
(6, 'Luisa', 'Cepeda', 'Mujer', '2021-09-18', 'luisa@gmail.com', 'luisa1', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79'),
(7, 'Blanca', 'Martinez', 'Mujer', '2021-09-18', 'blanca@gmail.com', 'blanca1', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79'),
(8, 'Blanca', 'Martinez', 'Mujer', '2021-09-18', 'blanca@gmail.com', 'blanca2', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79'),
(9, 'Bryan', 'Ledezma', 'Hombre', '1998-09-22', 'bryan@gmail.com', 'bryan1', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios_internos`
--

CREATE TABLE `usuarios_internos` (
  `id_interno` int(11) NOT NULL,
  `nombre` text NOT NULL,
  `apellidos` text NOT NULL,
  `sexo` text NOT NULL,
  `correo` text NOT NULL,
  `cargo` text NOT NULL,
  `usuario` text NOT NULL,
  `contraseña` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios_internos`
--

INSERT INTO `usuarios_internos` (`id_interno`, `nombre`, `apellidos`, `sexo`, `correo`, `cargo`, `usuario`, `contraseña`) VALUES
(1, 'Jorge', 'Torres', 'Hombre', 'jorge@gmail.com', 'Doctor', 'jorge1', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `asignaciones`
--
ALTER TABLE `asignaciones`
  ADD PRIMARY KEY (`id_asignacion`);

--
-- Indices de la tabla `estado_notificacion`
--
ALTER TABLE `estado_notificacion`
  ADD PRIMARY KEY (`id_estado_n`);

--
-- Indices de la tabla `estado_paciente`
--
ALTER TABLE `estado_paciente`
  ADD PRIMARY KEY (`id_estado_p`);

--
-- Indices de la tabla `expedientes`
--
ALTER TABLE `expedientes`
  ADD PRIMARY KEY (`id_expediente`);

--
-- Indices de la tabla `notificacion`
--
ALTER TABLE `notificacion`
  ADD PRIMARY KEY (`id_notificacion`);

--
-- Indices de la tabla `pacientes`
--
ALTER TABLE `pacientes`
  ADD PRIMARY KEY (`id_paciente`);

--
-- Indices de la tabla `usuarios_externos`
--
ALTER TABLE `usuarios_externos`
  ADD PRIMARY KEY (`id_externo`);

--
-- Indices de la tabla `usuarios_internos`
--
ALTER TABLE `usuarios_internos`
  ADD PRIMARY KEY (`id_interno`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `asignaciones`
--
ALTER TABLE `asignaciones`
  MODIFY `id_asignacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `estado_notificacion`
--
ALTER TABLE `estado_notificacion`
  MODIFY `id_estado_n` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `estado_paciente`
--
ALTER TABLE `estado_paciente`
  MODIFY `id_estado_p` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `expedientes`
--
ALTER TABLE `expedientes`
  MODIFY `id_expediente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `notificacion`
--
ALTER TABLE `notificacion`
  MODIFY `id_notificacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `pacientes`
--
ALTER TABLE `pacientes`
  MODIFY `id_paciente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `usuarios_externos`
--
ALTER TABLE `usuarios_externos`
  MODIFY `id_externo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `usuarios_internos`
--
ALTER TABLE `usuarios_internos`
  MODIFY `id_interno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
