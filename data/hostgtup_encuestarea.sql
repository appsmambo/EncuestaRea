-- phpMyAdmin SQL Dump
-- version 4.3.8
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 20-12-2016 a las 19:41:21
-- Versión del servidor: 5.5.51-38.2
-- Versión de PHP: 5.4.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `hostgtup_encuestarea`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ciclo_academico`
--

CREATE TABLE IF NOT EXISTS `ciclo_academico` (
  `id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `anio` char(4) NOT NULL,
  `semestre` char(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cursos`
--

CREATE TABLE IF NOT EXISTS `cursos` (
  `id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `departamento_academico` int(11) NOT NULL,
  `descripcion` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=128 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `departamento_academico`
--

CREATE TABLE IF NOT EXISTS `departamento_academico` (
  `id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `ciclo_academico` int(11) NOT NULL,
  `descripcion` varchar(50) NOT NULL,
  `prefijo` varchar(5) NOT NULL,
  `cantidad_salones` smallint(6) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `encuesta`
--

CREATE TABLE IF NOT EXISTS `encuesta` (
  `id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `ip` varchar(45) NOT NULL,
  `anio_academico` varchar(4) NOT NULL,
  `semestre` varchar(2) NOT NULL,
  `departamento_academico` int(11) NOT NULL,
  `codigo_salon` varchar(6) NOT NULL,
  `id_curso` int(11) NOT NULL,
  `seccion` varchar(10) NOT NULL,
  `nombre_rea` varchar(100) NOT NULL,
  `curso_contenido` tinyint(4) NOT NULL,
  `curso_contenido_sustentacion` text,
  `curso_exigencia` tinyint(4) NOT NULL,
  `curso_exigencia_sustentacion` text,
  `curso_proposito` tinyint(4) NOT NULL,
  `curso_proposito_sustentacion` text,
  `alumno_esfuerzo` tinyint(4) NOT NULL,
  `alumno_actitud` tinyint(4) NOT NULL,
  `alumno_participacion` tinyint(4) NOT NULL,
  `profesor_motivacion` tinyint(4) NOT NULL,
  `profesor_tiempo` tinyint(4) NOT NULL,
  `profesor_contenido` tinyint(4) NOT NULL,
  `profesor_retroalimentacion` tinyint(4) NOT NULL,
  `otros_1` text,
  `otros_2` text,
  `tiempo_encuesta` smallint(6) DEFAULT NULL,
  `estado` tinyint(1) DEFAULT '1'
) ENGINE=InnoDB AUTO_INCREMENT=5968 DEFAULT CHARSET=utf8;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `ciclo_academico`
--
ALTER TABLE `ciclo_academico`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `cursos`
--
ALTER TABLE `cursos`
  ADD PRIMARY KEY (`id`), ADD KEY `departamento_academico` (`departamento_academico`);

--
-- Indices de la tabla `departamento_academico`
--
ALTER TABLE `departamento_academico`
  ADD PRIMARY KEY (`id`), ADD KEY `ciclo_academico` (`ciclo_academico`);

--
-- Indices de la tabla `encuesta`
--
ALTER TABLE `encuesta`
  ADD PRIMARY KEY (`id`), ADD KEY `departamento_academico` (`departamento_academico`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `ciclo_academico`
--
ALTER TABLE `ciclo_academico`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `cursos`
--
ALTER TABLE `cursos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=128;
--
-- AUTO_INCREMENT de la tabla `departamento_academico`
--
ALTER TABLE `departamento_academico`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT de la tabla `encuesta`
--
ALTER TABLE `encuesta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5968;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
