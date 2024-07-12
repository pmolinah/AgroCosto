-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 03-11-2023 a las 02:59:39
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `campo`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `campos`
--

CREATE TABLE `campos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `rut` varchar(10) NOT NULL,
  `empresa_id` bigint(20) UNSIGNED NOT NULL,
  `campo` varchar(250) NOT NULL,
  `direccion` varchar(250) NOT NULL,
  `adm_id` bigint(20) UNSIGNED NOT NULL,
  `superficie` double(8,2) NOT NULL,
  `codigoSag` varchar(10) NOT NULL,
  `comuna_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `campos`
--

INSERT INTO `campos` (`id`, `created_at`, `updated_at`, `rut`, `empresa_id`, `campo`, `direccion`, `adm_id`, `superficie`, `codigoSag`, `comuna_id`) VALUES
(1, '2023-11-01 19:17:44', '2023-11-01 19:17:44', '76191620-3', 6, 'AGRÍCOLA OROCOIPO LTDA.', 'Panquehue 1', 1, 10.00, '121212', 201),
(2, '2023-11-02 04:41:20', '2023-11-02 04:41:20', '10502982-9', 7, 'Mauricio Eltit Rabí', 'Boco', 1, 13.00, '121213', 253);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `campos`
--
ALTER TABLE `campos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `campos_empresa_id_foreign` (`empresa_id`),
  ADD KEY `campos_adm_id_foreign` (`adm_id`),
  ADD KEY `campos_comuna_id_foreign` (`comuna_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `campos`
--
ALTER TABLE `campos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `campos`
--
ALTER TABLE `campos`
  ADD CONSTRAINT `campos_adm_id_foreign` FOREIGN KEY (`adm_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `campos_comuna_id_foreign` FOREIGN KEY (`comuna_id`) REFERENCES `comunas` (`id`),
  ADD CONSTRAINT `campos_empresa_id_foreign` FOREIGN KEY (`empresa_id`) REFERENCES `empresas` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
