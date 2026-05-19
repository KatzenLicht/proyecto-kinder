-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: fdb1034.awardspace.net
-- Tiempo de generación: 19-05-2026 a las 21:13:53
-- Versión del servidor: 8.0.32
-- Versión de PHP: 8.1.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `4735919_kinder`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumnos`
--

CREATE TABLE `alumnos` (
  `id_alu` int NOT NULL,
  `id_gpo` int DEFAULT NULL,
  `nombre_alu` varchar(60) COLLATE utf8mb3_spanish_ci NOT NULL,
  `apellidos_alu` varchar(60) COLLATE utf8mb3_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;

--
-- Volcado de datos para la tabla `alumnos`
--

INSERT INTO `alumnos` (`id_alu`, `id_gpo`, `nombre_alu`, `apellidos_alu`) VALUES
(1, 4, 'Mateo', 'Flores Ramos'),
(2, 1, 'Santiago', 'Benítez Ortiz'),
(3, 2, 'Matías', 'Delgado Silva'),
(4, 5, 'Sebastián', 'Méndez Ruiz'),
(5, 5, 'Alejandro', 'Peña Castro'),
(6, 5, 'Daniel', 'Navarro Cruz'),
(7, 1, 'David', 'Alanís Gómez'),
(8, 3, 'Diego', 'Estrada Ortega'),
(9, 4, 'Emiliano', 'Juárez Tovar');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupo`
--

CREATE TABLE `grupo` (
  `id_gpo` int NOT NULL,
  `id_usu` int NOT NULL,
  `grupo_gpo` varchar(10) COLLATE utf8mb3_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;

--
-- Volcado de datos para la tabla `grupo`
--

INSERT INTO `grupo` (`id_gpo`, `id_usu`, `grupo_gpo`) VALUES
(1, 2, 'Grupo A'),
(2, 2, 'Grupo B'),
(3, 3, 'Grupo C'),
(4, 3, 'Grupo D'),
(5, 4, 'Grupo E'),
(6, 4, 'Grupo F');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `padres`
--

CREATE TABLE `padres` (
  `id_padre` int NOT NULL,
  `id_usu` int NOT NULL,
  `id_alu` int DEFAULT NULL,
  `nombre_padre` varchar(60) COLLATE utf8mb3_spanish_ci NOT NULL,
  `telefono_padre` varchar(12) COLLATE utf8mb3_spanish_ci NOT NULL,
  `correo_padre` varchar(60) COLLATE utf8mb3_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;

--
-- Volcado de datos para la tabla `padres`
--

INSERT INTO `padres` (`id_padre`, `id_usu`, `id_alu`, `nombre_padre`, `telefono_padre`, `correo_padre`) VALUES
(1, 5, NULL, 'Tutor Visitante Previsualización', '6560000000', 'visitante@correo.com'),
(2, 6, 1, 'Carlos Flores Ramos', '6569990001', 'tutor1@correo.com'),
(3, 7, 2, 'Diana Benítez Ortiz', '6569990002', 'tutor2@correo.com'),
(4, 8, 3, 'Jorge Delgado Silva', '6569990003', 'tutor3@correo.com'),
(5, 9, 4, 'Laura Méndez Ruiz', '6569990004', 'tutor4@correo.com'),
(6, 10, 5, 'Sofía Peña Castro', '6569990005', 'tutor5@correo.com'),
(7, 11, 6, 'Andrés Navarro Cruz', '6569990006', 'tutor6@correo.com'),
(8, 12, 7, 'Ricardo David Alanís', '6569990007', 'tutor7@correo.com'),
(9, 13, 8, 'Mónica Diego Estrada', '6569990008', 'tutor8@correo.com'),
(10, 14, 9, 'Esteban Emiliano Juárez', '6569990009', 'tutor9@correo.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personal`
--

CREATE TABLE `personal` (
  `id_per` int NOT NULL,
  `id_usu` int NOT NULL,
  `maestra_per` varchar(60) COLLATE utf8mb3_spanish_ci NOT NULL,
  `correo_per` varchar(60) COLLATE utf8mb3_spanish_ci NOT NULL,
  `cel_per` varchar(12) COLLATE utf8mb3_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;

--
-- Volcado de datos para la tabla `personal`
--

INSERT INTO `personal` (`id_per`, `id_usu`, `maestra_per`, `correo_per`, `cel_per`) VALUES
(1, 2, 'Alejandra Gómez Esparza', 'alejandra.gomez@uacj.mx', '6561112233'),
(2, 3, 'Beatriz Gutiérrez Luna', 'beatriz.gutierrez@uacj.mx', '6564445566'),
(3, 4, 'Claudia Morales Soto', 'claudia.morales@uacj.mx', '6567778899');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usu` int NOT NULL,
  `usuario_usu` varchar(32) COLLATE utf8mb3_spanish_ci NOT NULL,
  `password_usu` varchar(255) COLLATE utf8mb3_spanish_ci NOT NULL,
  `rol` enum('admin','docente','padre') COLLATE utf8mb3_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usu`, `usuario_usu`, `password_usu`, `rol`) VALUES
(1, 'admin', '$2y$10$26EkFczERsXnucu7H4AbSOvAScn5VKuEuTfUD8sEfzmfdHlanO/H2', 'admin'),
(2, 'maestra1', '$2y$12$2G9DfUTvm./cwF4opDFBkOP1hGd/4DgxwmgzK98iOUFl2RjaDsM6G', 'docente'),
(3, 'maestra2', '$2y$12$GBR8zi6aYYjc2mdl0aPEJuXMXwR6dITy4evOYD2fBg1a89gOWWGXS', 'docente'),
(4, 'maestra3', '$2y$12$D.VxLNSNpVZFLY3xsQwOGO68vdinCN9RG4.xPcszEebVy34zH4avW', 'docente'),
(5, 'visitante', '$2y$12$zqgrkg4mfGvf8vv2M14nKOJqKlBQlRmW0Ii5wt/Rev8ME7JChS2YG', 'padre'),
(6, 'padre1', '$2y$12$Oa4Gu0.9l.tffgm3xtfsWu7KlSJg9T7.nQZPVzZHRemWVg73MLcvO', 'padre'),
(7, 'padre2', '$2y$12$C0PpjSQYbzyY7dKx7C020OtdkmRjdln/nwgGAjmt/JmCSwJLKgaXu', 'padre'),
(8, 'padre3', '$2y$12$0UyiuOWfY8yhBHpd/04BRONalJZRowLJi.LeIbNGTYEyGWM2jaW7u', 'padre'),
(9, 'padre4', '$2y$12$8j/VgS1qYA7t0AqU8/OJHu9lzB.ugU.bslf3/AgVe3mggrG5NN/fy', 'padre'),
(10, 'padre5', '$2y$12$ewfL2wiYXkEYmAeIqxie3.O8kHBrrajeKWT2itnrzkrK1OvESwI4m', 'padre'),
(11, 'padre6', '$2y$12$xEDBLyOZIGVIoQMjPGHHsOhlMSpaQT9wmUivzEZRPq96TVCrgmZ4S', 'padre'),
(12, 'padre7', '$2y$12$T0ZUp.PkTd5A.BAkts4zJuboWg9mSyXUn0KxnDsCZMrOXVPvMK/Zu', 'padre'),
(13, 'padre8', '$2y$12$pJehCLquCtdc90PfpiGlWOH9vfqplrCtfhm1nBEyrfpQ4LfTYi8ai', 'padre'),
(14, 'padre9', '$2y$12$/4rCuOTvq4o0I/t5Ce4c5.Z3VpoqsuNLukh9xZ2T3Az5OGHyN.tCW', 'padre');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `alumnos`
--
ALTER TABLE `alumnos`
  ADD PRIMARY KEY (`id_alu`),
  ADD KEY `id_gpo` (`id_gpo`);

--
-- Indices de la tabla `grupo`
--
ALTER TABLE `grupo`
  ADD PRIMARY KEY (`id_gpo`),
  ADD KEY `id_usu` (`id_usu`);

--
-- Indices de la tabla `padres`
--
ALTER TABLE `padres`
  ADD PRIMARY KEY (`id_padre`),
  ADD KEY `id_usu` (`id_usu`),
  ADD KEY `id_alu` (`id_alu`);

--
-- Indices de la tabla `personal`
--
ALTER TABLE `personal`
  ADD PRIMARY KEY (`id_per`),
  ADD KEY `id_usu` (`id_usu`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usu`),
  ADD UNIQUE KEY `usuario_usu` (`usuario_usu`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `alumnos`
--
ALTER TABLE `alumnos`
  MODIFY `id_alu` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `grupo`
--
ALTER TABLE `grupo`
  MODIFY `id_gpo` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `padres`
--
ALTER TABLE `padres`
  MODIFY `id_padre` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `personal`
--
ALTER TABLE `personal`
  MODIFY `id_per` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usu` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `alumnos`
--
ALTER TABLE `alumnos`
  ADD CONSTRAINT `alumnos_ibfk_1` FOREIGN KEY (`id_gpo`) REFERENCES `grupo` (`id_gpo`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Filtros para la tabla `grupo`
--
ALTER TABLE `grupo`
  ADD CONSTRAINT `grupo_ibfk_1` FOREIGN KEY (`id_usu`) REFERENCES `usuarios` (`id_usu`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `padres`
--
ALTER TABLE `padres`
  ADD CONSTRAINT `padres_ibfk_1` FOREIGN KEY (`id_usu`) REFERENCES `usuarios` (`id_usu`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `padres_ibfk_2` FOREIGN KEY (`id_alu`) REFERENCES `alumnos` (`id_alu`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Filtros para la tabla `personal`
--
ALTER TABLE `personal`
  ADD CONSTRAINT `personal_ibfk_1` FOREIGN KEY (`id_usu`) REFERENCES `usuarios` (`id_usu`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
