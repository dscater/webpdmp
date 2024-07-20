-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 13-07-2024 a las 16:11:56
-- Versión del servidor: 8.0.30
-- Versión de PHP: 7.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `webpdmp_db`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `certificado_detalles`
--

CREATE TABLE `certificado_detalles` (
  `id` bigint UNSIGNED NOT NULL,
  `certificado_id` bigint UNSIGNED NOT NULL,
  `fecha` date NOT NULL,
  `detalle` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `unidad` varchar(155) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `cantidad` double NOT NULL,
  `pu` decimal(24,2) NOT NULL,
  `total` decimal(24,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `certificado_detalles`
--

INSERT INTO `certificado_detalles` (`id`, `certificado_id`, `fecha`, `detalle`, `unidad`, `cantidad`, `pu`, `total`, `created_at`, `updated_at`) VALUES
(1, 1, '2022-05-27', 'detalle 1', 'unidad', 3, 5.00, 15.00, '2022-05-27 17:06:08', '2022-05-27 17:06:08'),
(2, 1, '2022-05-27', 'detalle 1', 'unidad', 4, 55.00, 220.00, '2022-05-27 17:06:08', '2022-05-27 17:06:08'),
(3, 2, '2022-05-28', 'detalle 1', 'unidad', 5, 78.00, 390.00, '2022-05-28 21:10:16', '2022-05-28 21:12:01');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `certificado_detalle_restas`
--

CREATE TABLE `certificado_detalle_restas` (
  `id` bigint UNSIGNED NOT NULL,
  `certificado_id` bigint UNSIGNED NOT NULL,
  `fecha` date NOT NULL,
  `detalle` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `unidad` varchar(155) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `cantidad` double NOT NULL,
  `pu` decimal(24,2) NOT NULL,
  `total` decimal(24,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `certificado_detalle_restas`
--

INSERT INTO `certificado_detalle_restas` (`id`, `certificado_id`, `fecha`, `detalle`, `unidad`, `cantidad`, `pu`, `total`, `created_at`, `updated_at`) VALUES
(1, 1, '2022-05-27', 'detalle 2', 'unidad', 1, 35.00, 35.00, '2022-05-27 17:06:08', '2022-05-27 17:06:08'),
(2, 2, '2022-05-28', 'detalle 2', 'unidad', 1, 5.00, 5.00, '2022-05-28 21:10:16', '2022-05-28 21:12:01');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `certificado_pagos`
--

CREATE TABLE `certificado_pagos` (
  `id` bigint UNSIGNED NOT NULL,
  `maquinaria_id` bigint UNSIGNED NOT NULL,
  `mes` varchar(155) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `anio` int NOT NULL,
  `total` decimal(24,2) NOT NULL,
  `descuento` decimal(24,2) NOT NULL,
  `total_pagable` decimal(24,2) NOT NULL,
  `literal` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `fecha_registro` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `certificado_pagos`
--

INSERT INTO `certificado_pagos` (`id`, `maquinaria_id`, `mes`, `anio`, `total`, `descuento`, `total_pagable`, `literal`, `fecha_registro`, `created_at`, `updated_at`) VALUES
(1, 5, '05', 2022, 235.00, 35.00, 200.00, '', '2022-05-27', '2022-05-27 17:06:08', '2022-05-27 17:06:08'),
(2, 8, '05', 2022, 390.00, 5.00, 385.00, '', '2022-05-28', '2022-05-28 21:10:16', '2022-05-28 21:12:01');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `configuracions`
--

CREATE TABLE `configuracions` (
  `id` bigint UNSIGNED NOT NULL,
  `nombre_sistema` varchar(155) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `alias` varchar(155) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `razon_social` varchar(155) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `nit` varchar(155) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `ciudad` varchar(155) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `dir` varchar(155) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `fono` varchar(155) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `web` varchar(155) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `actividad_economica` varchar(155) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `correo` varchar(155) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `logo` varchar(155) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `configuracions`
--

INSERT INTO `configuracions` (`id`, `nombre_sistema`, `alias`, `razon_social`, `nit`, `ciudad`, `dir`, `fono`, `web`, `actividad_economica`, `correo`, `logo`, `created_at`, `updated_at`) VALUES
(1, 'SISTEMA WEB DE PARTES DIARIOS DE MAQUINARIA PESADA', 'WEBPDMP', 'EMPRESA DE EQUIPOS Y MAQUINARIAS \"PRUEBA\"', '10000000111', 'LA PAZ', 'ZONA LOS OLIVOS CALLE 3 #322', '2111111', '77777777', 'ACTIVIDAD ECONOMICA', 'CORREO@GMAIL.COM', 'logo.png', '2022-05-23 23:37:28', '2022-05-28 21:13:25');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `datos_usuarios`
--

CREATE TABLE `datos_usuarios` (
  `id` bigint UNSIGNED NOT NULL,
  `nombre` varchar(155) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `paterno` varchar(155) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `materno` varchar(155) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `ci` varchar(155) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `ci_exp` varchar(155) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `dir` varchar(155) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(155) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fono` varchar(155) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `cel` varchar(155) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `fecha_registro` date NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `datos_usuarios`
--

INSERT INTO `datos_usuarios` (`id`, `nombre`, `paterno`, `materno`, `ci`, `ci_exp`, `dir`, `email`, `fono`, `cel`, `fecha_registro`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'JUAN', 'PEREZ', 'MAMANI', '123', 'LP', 'ZONA LOS OLIVOS CALLE 3 #322', 'JUAN@GMAIL.COM', '2222222', '7777777', '2022-05-23', 2, '2022-05-23 23:57:54', '2022-05-28 14:42:48'),
(2, 'MARIO', 'PRADO', '', '1234', 'LP', 'ZONA LOS OLIVOS CALLE 3 #322', '', '2222222', '7777777', '2022-05-25', 3, '2022-05-25 14:56:33', '2022-05-25 14:56:33'),
(3, 'MARIA', 'TEJADA', 'SUAREZ', '12345', 'SC', 'ZONA LOS OLIVOS CALLE 3 #322', '', '2222222', '7777777', '2022-05-25', 4, '2022-05-25 14:56:55', '2022-05-25 14:56:55'),
(4, 'FELIX', 'CHOQUE', 'MAMANI', '123456', 'CB', 'ZONA LOS OLIVOS CALLE 3 #322', '', '2222222', '7777777', '2022-05-25', 5, '2022-05-25 14:57:18', '2022-05-25 14:57:18'),
(5, 'MARIA', 'MAMANI', '', '1234567', 'PT', 'ZONA LOS OLIVOS CALLE 3 #322', '', '2222222', '7777777', '2022-05-25', 6, '2022-05-25 14:57:45', '2022-05-25 14:57:45'),
(6, 'ELVIS', 'MACHACA', '', '22222', 'LP', 'ZONA LOS OLIVOS CALLE 3 #322', '', '2222222', '7777777', '2022-05-25', 7, '2022-05-25 22:38:47', '2022-05-25 22:38:47'),
(7, 'JACINTO', 'ORTIZ', '', '3333', 'CB', 'ZONA LOS OLIVOS CALLE 3 #322', '', '2222222', '7777777', '2022-05-25', 8, '2022-05-25 22:39:05', '2022-05-25 22:39:05'),
(8, 'EDUARDO', 'CALCINA', '', '44444', 'CB', 'ZONA LOS OLIVOS CALLE 3 #322', '', '2222222', '7777777', '2022-05-25', 9, '2022-05-25 22:39:26', '2022-05-28 20:47:04'),
(9, 'SAUL', 'SUAREZ', '', '766666', 'LP', 'ZONA LOS OLIVOS CALLE 3 #322', '', '2222222', '7777777', '2022-05-25', 10, '2022-05-25 22:39:53', '2022-05-25 22:39:53'),
(10, 'JAVIER', 'MARTINEZ', '', '8888', 'CB', 'ZONA LOS OLIVOS CALLE 3 #322', '', '2222222', '7777777', '2022-05-25', 11, '2022-05-25 22:41:26', '2022-05-25 22:41:26'),
(11, 'MARTIN', 'COLQUE', 'PAREDES', '4343', 'CB', 'LOS OLIVOS', '', '222222', '655656565', '2024-07-13', 12, '2024-07-13 15:53:59', '2024-07-13 15:53:59'),
(12, 'JOSUE', 'MAMANI', '', '5454', 'CB', 'LOS OLIVOS', '', '222222', '7777777', '2024-07-13', 13, '2024-07-13 15:54:45', '2024-07-13 15:54:45');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `entregas`
--

CREATE TABLE `entregas` (
  `id` bigint UNSIGNED NOT NULL,
  `registro` bigint UNSIGNED NOT NULL,
  `tipo` varchar(155) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `fecha` date NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `entregas`
--

INSERT INTO `entregas` (`id`, `registro`, `tipo`, `fecha`, `user_id`, `created_at`, `updated_at`) VALUES
(3, 4, 'PROPIO', '2022-05-26', 1, '2022-05-27 00:27:38', '2022-05-27 00:27:38'),
(4, 5, 'ALQUILADO', '2022-05-28', 4, '2022-05-28 21:35:03', '2022-05-28 21:35:03');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `hora_alquilados`
--

CREATE TABLE `hora_alquilados` (
  `id` bigint UNSIGNED NOT NULL,
  `maquinaria_id` bigint UNSIGNED NOT NULL,
  `dia` int NOT NULL,
  `mes` varchar(155) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `anio` int UNSIGNED NOT NULL,
  `fecha` date NOT NULL,
  `horometro_ini` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `horometro_fin` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `horas_trabajadas` double DEFAULT NULL,
  `calentamiento` double DEFAULT NULL,
  `acumuladas` double DEFAULT NULL,
  `dias_trabajados` double NOT NULL,
  `total_horas` int DEFAULT NULL,
  `combustible` varchar(155) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `combustible_cantidad` int DEFAULT NULL,
  `costo_combustible` decimal(24,2) DEFAULT NULL,
  `aceite1` int DEFAULT NULL,
  `costo_aceite1` decimal(24,2) DEFAULT NULL,
  `aceite2` int DEFAULT NULL,
  `costo_aceite2` decimal(24,2) DEFAULT NULL,
  `liquidoh` int DEFAULT NULL,
  `costo_liquidoh` decimal(24,2) DEFAULT NULL,
  `grasa` int DEFAULT NULL,
  `costo_grasa` decimal(24,2) DEFAULT NULL,
  `filtro` int DEFAULT NULL,
  `costo_filtro` decimal(24,2) DEFAULT NULL,
  `num_viajes` int DEFAULT NULL,
  `observaciones` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `fecha_registro` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `hora_alquilados`
--

INSERT INTO `hora_alquilados` (`id`, `maquinaria_id`, `dia`, `mes`, `anio`, `fecha`, `horometro_ini`, `horometro_fin`, `horas_trabajadas`, `calentamiento`, `acumuladas`, `dias_trabajados`, `total_horas`, `combustible`, `combustible_cantidad`, `costo_combustible`, `aceite1`, `costo_aceite1`, `aceite2`, `costo_aceite2`, `liquidoh`, `costo_liquidoh`, `grasa`, `costo_grasa`, `filtro`, `costo_filtro`, `num_viajes`, `observaciones`, `fecha_registro`, `created_at`, `updated_at`) VALUES
(3, 6, 28, '05', 2022, '2022-05-28', '2226', '2227', 2, 1, 8, 0, 3, NULL, 20, 7.00, 5, 40.00, 0, 0.00, 0, 0.00, 0, 0.00, 1, 45.00, 2, '', '2022-05-28', '2022-05-28 14:34:33', '2022-05-28 19:39:15'),
(4, 6, 27, '05', 2022, '2022-05-27', '2221', '2226', 5, 0, 5, 0, 5, NULL, 2, 9.00, 1, 50.00, 0, 0.00, 0, 0.00, 1, 60.00, 0, 0.00, 1, '', '2022-05-28', '2022-05-28 15:48:58', '2022-05-28 19:39:31'),
(5, 7, 28, '05', 2022, '2022-05-28', '10000', '10001', 2, 0, 2, 0, 2, NULL, 0, 0.00, 0, 0.00, 0, 0.00, 0, 0.00, 0, 0.00, 0, 0.00, 0, '', '2022-05-28', '2022-05-28 20:48:10', '2022-05-28 20:48:10'),
(6, 8, 28, '05', 2022, '2022-05-28', '2227', '2229', 5, 0, 5, 1, 5, NULL, 0, 0.00, 0, 0.00, 0, 0.00, 0, 0.00, 0, 0.00, 0, 0.00, 0, '', '2022-05-28', '2022-05-28 20:49:46', '2022-05-28 20:53:07'),
(7, 6, 9, '11', 2023, '2023-11-09', '2221', '2226', 5, 1, 5, 5, 11, NULL, 20, 300.00, 0, 0.00, 0, 0.00, 0, 0.00, 0, 0.00, 0, 0.00, 3, '', '2023-11-14', '2023-11-14 20:05:29', '2023-11-14 20:05:29');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `hora_propios`
--

CREATE TABLE `hora_propios` (
  `id` bigint UNSIGNED NOT NULL,
  `maquinaria_id` bigint UNSIGNED NOT NULL,
  `dia` int NOT NULL,
  `mes` varchar(155) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `anio` int UNSIGNED NOT NULL,
  `fecha` date NOT NULL,
  `horometro_ini` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `horometro_fin` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `horas_trabajadas` double DEFAULT NULL,
  `acumuladas` double DEFAULT NULL,
  `combustible` varchar(155) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `combustible_cantidad` int DEFAULT NULL,
  `costo_combustible` decimal(24,2) DEFAULT NULL,
  `aceite` int DEFAULT NULL,
  `costo_aceite` decimal(24,2) DEFAULT NULL,
  `liquidoh` int DEFAULT NULL,
  `costo_liquidoh` decimal(24,2) DEFAULT NULL,
  `liquidot` int DEFAULT NULL,
  `costo_liquidot` decimal(24,2) DEFAULT NULL,
  `liquidof` int DEFAULT NULL,
  `costo_liquidof` decimal(24,2) DEFAULT NULL,
  `grasa` int DEFAULT NULL,
  `costo_grasa` decimal(24,2) DEFAULT NULL,
  `filtroa` int DEFAULT NULL,
  `costo_filtroa` decimal(24,2) DEFAULT NULL,
  `filtroc` int DEFAULT NULL,
  `costo_filtroc` decimal(24,2) DEFAULT NULL,
  `filtroh` int DEFAULT NULL,
  `costo_filtroh` decimal(24,2) DEFAULT NULL,
  `filtroaire` int DEFAULT NULL,
  `costo_filtroaire` decimal(24,2) DEFAULT NULL,
  `observaciones` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `pieza_daniada` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `tiempo_reparacion` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `estado_pieza` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `fecha_registro` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `hora_propios`
--

INSERT INTO `hora_propios` (`id`, `maquinaria_id`, `dia`, `mes`, `anio`, `fecha`, `horometro_ini`, `horometro_fin`, `horas_trabajadas`, `acumuladas`, `combustible`, `combustible_cantidad`, `costo_combustible`, `aceite`, `costo_aceite`, `liquidoh`, `costo_liquidoh`, `liquidot`, `costo_liquidot`, `liquidof`, `costo_liquidof`, `grasa`, `costo_grasa`, `filtroa`, `costo_filtroa`, `filtroc`, `costo_filtroc`, `filtroh`, `costo_filtroh`, `filtroaire`, `costo_filtroaire`, `observaciones`, `pieza_daniada`, `tiempo_reparacion`, `estado_pieza`, `fecha_registro`, `created_at`, `updated_at`) VALUES
(4, 5, 26, '05', 2022, '2022-05-26', '2221', '2226', 5, 5, NULL, 0, 0.00, 0, 0.00, 0, 0.00, 0, 0.00, 0, 0.00, 0, 0.00, 0, 0.00, 0, 0.00, 0, 0.00, 0, 0.00, 'SSSSSSSSSSSS', '', '', '', '2022-05-26', '2022-05-27 00:03:05', '2022-05-28 21:30:27'),
(7, 5, 28, '05', 2022, '2022-05-28', '2227', '2229', 2, 8, NULL, 1, 30.00, 1, 45.00, 0, 0.00, 0, 0.00, 1, 10.00, 0, 0.00, 0, 0.00, 0, 0.00, 0, 0.00, 2, 30.00, '', '', '', '', '2022-05-28', '2022-05-28 14:33:36', '2022-05-28 21:31:24'),
(8, 5, 29, '05', 2022, '2022-05-29', '2229', '2230', 2, 10, NULL, 1, 15.00, 0, 0.00, 3, 2.00, 1, 55.00, 1, 10.00, 0, 0.00, 0, 0.00, 0, 0.00, 0, 0.00, 3, 45.00, '', '', '', '', '2022-05-28', '2022-05-28 15:44:20', '2022-05-28 21:31:32'),
(9, 5, 27, '05', 2022, '2022-05-27', '2226', '2227', 1, 6, NULL, 0, 0.00, 0, 0.00, 0, 0.00, 0, 0.00, 0, 0.00, 0, 0.00, 0, 0.00, 0, 0.00, 0, 0.00, 0, 0.00, '', '', '', '', '2022-05-28', '2022-05-28 21:31:00', '2022-05-28 21:31:07'),
(10, 5, 14, '11', 2023, '2023-11-14', '2221', '2226', 5, 5, NULL, 12, 500.00, 0, 0.00, 0, 0.00, 0, 0.00, 0, 0.00, 0, 0.00, 0, 0.00, 0, 0.00, 0, 0.00, 0, 0.00, '', '', '', '', '2023-11-14', '2023-11-14 19:47:17', '2023-11-14 19:47:17'),
(11, 5, 2, '07', 2024, '2024-07-02', '2', '3', 3, 0, NULL, 1, 5.00, 1, 5.00, 1, 5.00, 1, 5.00, 1, 5.00, 0, 0.00, 0, 0.00, 0, 0.00, 0, 0.00, 0, 0.00, '', '', '', '', '2024-07-12', '2024-07-12 15:29:43', '2024-07-12 15:29:43');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `maquinarias`
--

CREATE TABLE `maquinarias` (
  `id` bigint UNSIGNED NOT NULL,
  `codigo` varchar(155) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tipo_maquina` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nro` bigint NOT NULL,
  `clase` varchar(155) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `serie` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `chasis` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `matricula` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `marca` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `modelo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `color` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `anio` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `traccion` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `documento` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `certificado` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dui` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `frm` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `horometro` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kilometraje` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `estado` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `observaciones` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `combustible` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tipo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `propiedad` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `costo` decimal(24,2) DEFAULT NULL,
  `encargado` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `foto` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fecha_registro` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `maquinarias`
--

INSERT INTO `maquinarias` (`id`, `codigo`, `tipo_maquina`, `nro`, `clase`, `serie`, `chasis`, `matricula`, `marca`, `modelo`, `color`, `anio`, `traccion`, `documento`, `certificado`, `dui`, `frm`, `horometro`, `kilometraje`, `estado`, `observaciones`, `combustible`, `tipo`, `propiedad`, `costo`, `encargado`, `user_id`, `foto`, `fecha_registro`, `created_at`, `updated_at`) VALUES
(5, 'RTX1', 'RETROEXCAVADORA', 1, 'MAQUINARIA', '', '', '', '', '310-D', '', '1998', '', '', '', '', '', '', '', '', '', 'DIESEL', 'RETROEXCAVADORAS', 'PROPIO', 0.00, 'JOSE MARTINEZ', 2, 'default.png', '2022-05-25', '2022-05-25 15:58:18', '2024-07-13 15:51:02'),
(6, 'PLA1', 'PALA', 1, 'EQUIPO', '', '', '', 'CATERPILLAR', '950-C', '', '1982', '', '', '', '', '', '', '', '', '', '', 'PALAS', 'ALQUILER', 20.00, 'CESAR CHOQUEHUANCA', 7, 'PLA-011653504107.jpg', '2022-05-25', '2022-05-25 18:41:47', '2024-07-13 15:51:07'),
(7, 'RTX2', 'RETROEXCAVADORA', 2, 'EQUIPO', '', '', '', 'JHON DEERE', '410-D', '', '1995', '', '', '', '', '', '', '', '', '', '', 'RETROEXCAVADORAS', 'ALQUILER', 40.00, 'CESAR CHOQUEHUANCA', 9, 'default.png', '2022-05-28', '2022-05-28 20:46:49', '2024-07-13 15:51:15'),
(8, 'PLA2', 'PALA', 2, 'EQUIPO', '', '', '', 'CATERPILLAR', '951-C', '', '1982', '', '', '', '', '', '', '', '', '', '', 'PALAS', 'ALQUILER', 40.00, 'CESAR CHOQUEHUANCA', 8, 'default.png', '2022-05-28', '2022-05-28 20:49:25', '2024-07-13 15:51:21'),
(9, 'TPO1', 'TOPADORA DE ORUGA', 1, 'MAQUINARIA', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'TOPADORA', 'PROPIO', 0.00, 'JUAN PERES', 12, 'default.png', '2024-07-13', '2024-07-13 15:54:14', '2024-07-13 15:54:14'),
(10, 'RTX3', 'RETROEXCAVADORA', 3, 'MAQUINARIA', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'RETROEXCAVADORAS', 'PROPIO', 0.00, 'ELVIS CHOQUE', 13, 'default.png', '2024-07-13', '2024-07-13 15:55:03', '2024-07-13 15:55:03');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(155) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2020_11_11_164550_create_configuracions_table', 1),
(3, '2020_11_11_164632_create_datos_usuarios_table', 1),
(4, '2022_05_23_190129_create_maquinarias_table', 1),
(5, '2022_05_23_190154_create_proyectos_table', 1),
(6, '2022_05_23_190224_create_proyecto_usuarios_table', 1),
(7, '2022_05_23_190335_create_hora_propios_table', 1),
(8, '2022_05_23_190346_create_hora_alquilados_table', 1),
(9, '2022_05_23_190359_create_certificado_pagos_table', 1),
(10, '2022_05_23_192847_create_entregas_table', 1),
(11, '2022_05_27_094642_create_certificado_detalles_table', 2),
(12, '2022_05_27_104745_create_certificado_detalle_restas_table', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proyectos`
--

CREATE TABLE `proyectos` (
  `id` bigint UNSIGNED NOT NULL,
  `nombre` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `lugar` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `fecha_ini` date DEFAULT NULL,
  `fecha_fin` date DEFAULT NULL,
  `fecha_registro` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `proyectos`
--

INSERT INTO `proyectos` (`id`, `nombre`, `lugar`, `fecha_ini`, `fecha_fin`, `fecha_registro`, `created_at`, `updated_at`) VALUES
(1, 'PROYECTO 1', 'ACHOCALLA', '2022-05-13', '2022-05-29', '2022-05-25', '2022-05-25 22:12:56', '2022-05-27 15:47:43'),
(2, 'PROYECTO 2', 'ZONA SUR', '2022-05-07', '2022-05-28', '2022-05-25', '2022-05-25 22:13:17', '2022-05-28 20:51:35'),
(3, 'PROYECTO 3', 'ZONA LOS OLIVOS', '2022-06-01', '0000-00-00', '2022-05-28', '2022-05-28 20:59:34', '2022-05-28 20:59:34');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proyecto_usuarios`
--

CREATE TABLE `proyecto_usuarios` (
  `id` bigint UNSIGNED NOT NULL,
  `proyecto_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `fecha_registro` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `proyecto_usuarios`
--

INSERT INTO `proyecto_usuarios` (`id`, `proyecto_id`, `user_id`, `fecha_registro`, `created_at`, `updated_at`) VALUES
(1, 1, 2, '2022-05-25', '2022-05-25 21:06:41', '2022-05-25 21:06:50'),
(3, 1, 4, '2022-05-25', '2022-05-25 22:49:37', '2022-05-25 22:49:37'),
(4, 1, 7, '2022-05-25', '2022-05-25 22:49:43', '2022-05-25 22:49:43'),
(5, 1, 3, '2022-05-25', '2022-05-25 22:52:09', '2022-05-25 22:52:15'),
(6, 2, 9, '2022-05-28', '2022-05-28 20:47:18', '2022-05-28 20:47:18'),
(7, 2, 8, '2022-05-28', '2022-05-28 20:52:40', '2022-05-28 20:52:40');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(155) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tipo` enum('ADMINISTRADOR','OPERADOR','CAPATAZ','ENCARGADO DE OBRA','RESIDENTE DE OBRA') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `estado` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `password`, `tipo`, `foto`, `estado`, `created_at`, `updated_at`) VALUES
(1, 'admin', '$2y$10$3fWIoLvFvm.Tu9l0R7cxfu0TwU6eKRhf.z/2PQk3TDgEOGoyS82t2', 'ADMINISTRADOR', 'user_default.png', 1, '2022-05-23 23:37:28', '2022-05-23 23:37:28'),
(2, 'JPEREZ', '$2y$10$HjrKrpXqaN2dJbGCmq0K/u9QEZB6FcKJsvZX6dSnfE5lgMk4gLESW', 'OPERADOR', 'JUAN1653350274.jpg', 1, '2022-05-23 23:57:54', '2022-05-23 23:57:54'),
(3, 'MPRADO', '$2y$10$NJ.DTpGzCrj8ULj4ueDc4.3yHOrI5.u4DgGVWNKPhFvfizolHj9p.', 'CAPATAZ', 'MARIO1653490593.jpg', 1, '2022-05-25 14:56:33', '2022-05-25 14:56:33'),
(4, 'MTEJADA', '$2y$10$Akr4V6fEfeeijAaHJfkaY.17k9c/bjkAIRHzYzqpoj0tdrp1Ylytu', 'ENCARGADO DE OBRA', 'MARIA1653490615.jpg', 1, '2022-05-25 14:56:55', '2022-05-25 14:56:55'),
(5, 'FCHOQUE', '$2y$10$Yj.mnmxdO2VxQ.GeI.GJaeU9E1Sw0oKDnJP1Q8Rd3Xwt4oBhrFBVy', 'RESIDENTE DE OBRA', 'FELIX1653490638.jpg', 1, '2022-05-25 14:57:18', '2022-05-25 14:57:58'),
(6, 'MMAMANI', '$2y$10$7.QFFyjlwi7oviZs3OYiVuglGEVhBTP0PG7PtHp8nNAxOqNj9jmN6', 'ADMINISTRADOR', 'MARIA1653490665.jpg', 1, '2022-05-25 14:57:45', '2022-05-25 14:57:45'),
(7, 'EMACHACA', '$2y$10$zbtcHNoL1dPdFQkcxDwD.OMJnYMJBbdJBt7SBOo3m5ypN9NVKM7fC', 'OPERADOR', 'ELVIS1653518327.jpg', 1, '2022-05-25 22:38:47', '2022-05-25 22:38:47'),
(8, 'JORTIZ', '$2y$10$yIsPMmvDFgkAa3XFIU.xjOqnS/EMvzVp5hu7rv8O2SeeWqBQNu9QC', 'OPERADOR', 'JACINTO1653518345.jpg', 1, '2022-05-25 22:39:05', '2022-05-25 22:39:05'),
(9, 'ECALCINA', '$2y$10$bRQN3.z871r7uOUyM9/e6OFqjxfsaMhKIVinL3BwuuG6a1opg7xhy', 'OPERADOR', 'EDUARDO1653518366.jpg', 1, '2022-05-25 22:39:26', '2022-05-27 17:18:34'),
(10, 'SSUAREZ', '$2y$10$kQoaR29aQxPBCUmEZU4DHeaSc2zBTfHtzlD80kilxGxNTrcaxCeVy', 'CAPATAZ', 'SAUL1653518393.jpg', 1, '2022-05-25 22:39:53', '2022-05-27 17:18:08'),
(11, 'JMARTINEZ', '$2y$10$ZXdCn/j7wgdFXGFB9ezZ2OEtrOchadJb/2Z1Nm3jwjYEcM.LB6sw6', 'ENCARGADO DE OBRA', 'JAVIER1653518486.jpg', 1, '2022-05-25 22:41:26', '2022-05-27 17:19:10'),
(12, 'MCOLQUE', '$2y$10$MN58TmYXfwtBV3VM.DJ1t.hW5/.9yo3tp.QNVLFAlzY/ATSLa56PS', 'OPERADOR', 'MARTIN1720886039.jpg', 1, '2024-07-13 15:53:59', '2024-07-13 15:53:59'),
(13, 'JMAMANI', '$2y$10$gqFrU6QuyjLyF7t8RiZjBeqTje6HOl56O96zECZ9IbyEa4lDw4fIq', 'OPERADOR', 'JOSUE1720886085.jpg', 1, '2024-07-13 15:54:45', '2024-07-13 15:54:45');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `certificado_detalles`
--
ALTER TABLE `certificado_detalles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `certificado_detalles_certificado_id_foreign` (`certificado_id`);

--
-- Indices de la tabla `certificado_detalle_restas`
--
ALTER TABLE `certificado_detalle_restas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `certificado_detalle_restas_certificado_id_foreign` (`certificado_id`);

--
-- Indices de la tabla `certificado_pagos`
--
ALTER TABLE `certificado_pagos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `certificado_pagos_maquinaria_id_foreign` (`maquinaria_id`);

--
-- Indices de la tabla `configuracions`
--
ALTER TABLE `configuracions`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `datos_usuarios`
--
ALTER TABLE `datos_usuarios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `datos_usuarios_user_id_foreign` (`user_id`);

--
-- Indices de la tabla `entregas`
--
ALTER TABLE `entregas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `hora_alquilados`
--
ALTER TABLE `hora_alquilados`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `hora_propios`
--
ALTER TABLE `hora_propios`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `maquinarias`
--
ALTER TABLE `maquinarias`
  ADD PRIMARY KEY (`id`),
  ADD KEY `maquinarias_user_id_foreign` (`user_id`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `proyectos`
--
ALTER TABLE `proyectos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `proyecto_usuarios`
--
ALTER TABLE `proyecto_usuarios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `proyecto_usuarios_proyecto_id_foreign` (`proyecto_id`),
  ADD KEY `proyecto_usuarios_user_id_foreign` (`user_id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `certificado_detalles`
--
ALTER TABLE `certificado_detalles`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `certificado_detalle_restas`
--
ALTER TABLE `certificado_detalle_restas`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `certificado_pagos`
--
ALTER TABLE `certificado_pagos`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `configuracions`
--
ALTER TABLE `configuracions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `datos_usuarios`
--
ALTER TABLE `datos_usuarios`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `entregas`
--
ALTER TABLE `entregas`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `hora_alquilados`
--
ALTER TABLE `hora_alquilados`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `hora_propios`
--
ALTER TABLE `hora_propios`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `maquinarias`
--
ALTER TABLE `maquinarias`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `proyectos`
--
ALTER TABLE `proyectos`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `proyecto_usuarios`
--
ALTER TABLE `proyecto_usuarios`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `certificado_detalles`
--
ALTER TABLE `certificado_detalles`
  ADD CONSTRAINT `certificado_detalles_certificado_id_foreign` FOREIGN KEY (`certificado_id`) REFERENCES `certificado_pagos` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `certificado_detalle_restas`
--
ALTER TABLE `certificado_detalle_restas`
  ADD CONSTRAINT `certificado_detalle_restas_certificado_id_foreign` FOREIGN KEY (`certificado_id`) REFERENCES `certificado_pagos` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `certificado_pagos`
--
ALTER TABLE `certificado_pagos`
  ADD CONSTRAINT `certificado_pagos_maquinaria_id_foreign` FOREIGN KEY (`maquinaria_id`) REFERENCES `maquinarias` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `datos_usuarios`
--
ALTER TABLE `datos_usuarios`
  ADD CONSTRAINT `datos_usuarios_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `maquinarias`
--
ALTER TABLE `maquinarias`
  ADD CONSTRAINT `maquinarias_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `proyecto_usuarios`
--
ALTER TABLE `proyecto_usuarios`
  ADD CONSTRAINT `proyecto_usuarios_proyecto_id_foreign` FOREIGN KEY (`proyecto_id`) REFERENCES `proyectos` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `proyecto_usuarios_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
