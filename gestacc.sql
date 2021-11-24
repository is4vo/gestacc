-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 14-11-2021 a las 20:06:06
-- Versión del servidor: 10.4.11-MariaDB
-- Versión de PHP: 7.4.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `gestacc`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `accions`
--

CREATE TABLE `accions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `titulo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `comentario` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tipo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `vencimiento` date DEFAULT NULL,
  `estado` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ref_tema` bigint(20) UNSIGNED NOT NULL,
  `ref_acta` bigint(20) UNSIGNED NOT NULL,
  `ref_usuario` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `accions`
--

INSERT INTO `accions` (`id`, `titulo`, `comentario`, `tipo`, `vencimiento`, `estado`, `ref_tema`, `ref_acta`, `ref_usuario`, `created_at`, `updated_at`) VALUES
(1, 'Ingresar notas', NULL, 'Ejecución', '2021-11-19', 'Pendiente', 1, 1, 2, '2021-11-14 19:03:33', '2021-11-14 19:03:33'),
(2, 'Se subirán el 19 de noviembre', NULL, 'Acuerdo', NULL, NULL, 1, 1, NULL, '2021-11-14 19:03:36', '2021-11-14 19:03:36'),
(3, 'No se harán prácticas', NULL, 'Acuerdo', NULL, NULL, 2, 1, NULL, '2021-11-14 19:03:36', '2021-11-14 19:03:36');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `actas`
--

CREATE TABLE `actas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `numero_reunion` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tipo_reunion` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fecha_reunion` date NOT NULL,
  `hora_inicio` time NOT NULL,
  `hora_termino` time NOT NULL,
  `estado` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Pendiente',
  `ref_usuario` bigint(20) UNSIGNED NOT NULL,
  `ref_reunion` bigint(20) UNSIGNED NOT NULL,
  `abierta` tinyint(1) NOT NULL DEFAULT 0,
  `adendas` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `actas`
--

INSERT INTO `actas` (`id`, `numero_reunion`, `tipo_reunion`, `fecha_reunion`, `hora_inicio`, `hora_termino`, `estado`, `ref_usuario`, `ref_reunion`, `abierta`, `adendas`, `created_at`, `updated_at`) VALUES
(1, '1', 'Regular', '2021-11-16', '10:00:00', '11:30:00', 'Cerrada', 1, 1, 0, 'Tema 2: No se harán prácticas debido a la pandemia.', '2021-11-14 19:03:33', '2021-11-14 19:04:59');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `aprobacions`
--

CREATE TABLE `aprobacions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ref_miembro` bigint(20) UNSIGNED NOT NULL,
  `ref_acta` bigint(20) UNSIGNED NOT NULL,
  `aprueba` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `aprobacions`
--

INSERT INTO `aprobacions` (`id`, `ref_miembro`, `ref_acta`, `aprueba`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, '2021-11-14 19:03:36', '2021-11-14 19:04:59');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asistentes`
--

CREATE TABLE `asistentes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ref_usuario` bigint(20) UNSIGNED NOT NULL,
  `ref_acta` bigint(20) UNSIGNED NOT NULL,
  `asiste` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `asistentes`
--

INSERT INTO `asistentes` (`id`, `ref_usuario`, `ref_acta`, `asiste`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, '2021-11-14 19:03:36', '2021-11-14 19:03:36'),
(2, 2, 1, 1, '2021-11-14 19:03:36', '2021-11-14 19:03:36'),
(3, 5, 1, 0, '2021-11-14 19:03:36', '2021-11-14 19:03:36'),
(4, 6, 1, 1, '2021-11-14 19:03:36', '2021-11-14 19:03:36');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asistente_reunions`
--

CREATE TABLE `asistente_reunions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ref_reunion` bigint(20) UNSIGNED NOT NULL,
  `ref_usuario` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `asistente_reunions`
--

INSERT INTO `asistente_reunions` (`id`, `ref_reunion`, `ref_usuario`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2021-11-14 18:56:29', '2021-11-14 18:56:29'),
(2, 1, 2, '2021-11-14 18:56:34', '2021-11-14 18:56:34'),
(3, 1, 5, '2021-11-14 18:56:36', '2021-11-14 18:56:36');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2021_06_15_013329_create_permission_tables', 1),
(5, '2021_06_28_203702_create_reunions_table', 1),
(6, '2021_06_29_040240_create_actas_table', 1),
(7, '2021_06_29_040252_create_temas_table', 1),
(8, '2021_06_29_040258_create_asistentes_table', 1),
(9, '2021_06_29_040304_create_accions_table', 1),
(10, '2021_09_06_203739_create_tema_reunions_table', 1),
(11, '2021_09_06_205621_create_asistente_reunions_table', 1),
(12, '2021_11_03_175952_create_aprobacion_table', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 1),
(3, 'App\\Models\\User', 2),
(3, 'App\\Models\\User', 3),
(3, 'App\\Models\\User', 4),
(3, 'App\\Models\\User', 5),
(3, 'App\\Models\\User', 6),
(3, 'App\\Models\\User', 7);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'usuarios', 'web', '2021-11-14 18:50:28', '2021-11-14 18:50:28'),
(2, 'actas', 'web', '2021-11-14 18:50:28', '2021-11-14 18:50:28'),
(3, 'tareas', 'web', '2021-11-14 18:50:28', '2021-11-14 18:50:28'),
(4, 'reunion', 'web', '2021-11-14 18:50:28', '2021-11-14 18:50:28');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reunions`
--

CREATE TABLE `reunions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `numero_reunion` bigint(20) UNSIGNED NOT NULL,
  `tipo_reunion` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fecha_reunion` date NOT NULL,
  `hora_inicio` time NOT NULL,
  `hora_termino` time NOT NULL,
  `estado` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Pendiente',
  `ref_usuario` bigint(20) UNSIGNED NOT NULL,
  `abierta` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `reunions`
--

INSERT INTO `reunions` (`id`, `numero_reunion`, `tipo_reunion`, `fecha_reunion`, `hora_inicio`, `hora_termino`, `estado`, `ref_usuario`, `abierta`, `created_at`, `updated_at`) VALUES
(1, 1, 'Regular', '2021-11-16', '10:00:00', '11:30:00', 'Realizada', 1, 0, '2021-11-14 18:56:29', '2021-11-14 19:03:33');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'web', '2021-11-14 18:50:28', '2021-11-14 18:50:28'),
(2, 'Miembro', 'web', '2021-11-14 18:50:28', '2021-11-14 18:50:28'),
(3, 'Invitado', 'web', '2021-11-14 18:50:28', '2021-11-14 18:50:28');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1),
(2, 1),
(2, 2),
(3, 1),
(3, 2),
(3, 3),
(4, 1),
(4, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `temas`
--

CREATE TABLE `temas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `titulo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `comentarios` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `estado` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Pendiente',
  `ref_acta` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `temas`
--

INSERT INTO `temas` (`id`, `titulo`, `comentarios`, `estado`, `ref_acta`, `created_at`, `updated_at`) VALUES
(1, 'Notas', 'Se discute la fecha de subir las notas.', 'Pendiente', 1, '2021-11-14 19:03:33', '2021-11-14 19:03:33'),
(2, 'Varios', 'Prácticas de verano', 'Pendiente', 1, '2021-11-14 19:03:36', '2021-11-14 19:03:36');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tema_reunions`
--

CREATE TABLE `tema_reunions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `titulo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ref_reunion` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `tema_reunions`
--

INSERT INTO `tema_reunions` (`id`, `titulo`, `ref_reunion`, `created_at`, `updated_at`) VALUES
(1, 'Notas', 1, '2021-11-14 18:56:38', '2021-11-14 18:56:38'),
(2, 'Varios', 1, '2021-11-14 18:56:38', '2021-11-14 18:56:38');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `last_login` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `status`, `last_login`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Isavo Castro', 'isavocastro@gmail.com', '$2y$10$uNtOSItcAEX/aVRVqfgFsuu7mhIJ67OgS/CXvGZTYdYPnV.aldT5K', 1, NULL, NULL, '2021-11-14 18:50:29', '2021-11-14 18:50:29'),
(2, 'Jose Fuentes', 'jfuentes@gmail.com', '$2y$10$gotQVBs.ekl1ciGaSTsy2uVyWWAyo1oBWn5743eEJtdx5jLSws8lK', 1, NULL, NULL, '2021-11-14 18:50:29', '2021-11-14 18:50:29'),
(3, 'Maria Peña', 'mpena@gmail.com', '$2y$10$tZakygEb6Y978hi6xG/8Z.kyZAvjos5sxBqGW3o3fypP5K534ts9q', 1, NULL, NULL, '2021-11-14 18:50:29', '2021-11-14 18:50:29'),
(4, 'Marcelo Perez', 'mperez@gmail.com', '$2y$10$IwSUVavs8w4jRifjNNZ/ouMRoLU8MjJfVhPDa8Io7PJZewGQ0ZxKO', 1, NULL, NULL, '2021-11-14 18:50:29', '2021-11-14 18:50:29'),
(5, 'Josefa Salas', 'jsalas@gmail.com', '$2y$10$J2vAjE3zqSOEL7QkdW5mEuezSIwLkVI6LbYiHMQF7TmrsIwYfq0cy', 1, NULL, NULL, '2021-11-14 18:50:30', '2021-11-14 18:50:30'),
(6, 'Ester López', 'elopez@gmail.com', '$2y$10$mbtS8Fxo8TkAPh5wVNuJBuzo8wkGxjqKcBpbtywTlE8wrNNE6Bd1i', 1, NULL, NULL, '2021-11-14 18:50:30', '2021-11-14 18:50:30'),
(7, 'Javier Cortez', 'jcortez@gmail.com', '$2y$10$onNGOElt4i3D/E61r3E4Qu.JKMLjpl8yIM/paThqFkOmhPKc8qYd2', 1, NULL, NULL, '2021-11-14 18:50:30', '2021-11-14 18:50:30');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `accions`
--
ALTER TABLE `accions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `accions_ref_tema_foreign` (`ref_tema`),
  ADD KEY `accions_ref_acta_foreign` (`ref_acta`),
  ADD KEY `accions_ref_usuario_foreign` (`ref_usuario`);

--
-- Indices de la tabla `actas`
--
ALTER TABLE `actas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `actas_numero_reunion_tipo_reunion_unique` (`numero_reunion`,`tipo_reunion`),
  ADD KEY `actas_ref_usuario_foreign` (`ref_usuario`),
  ADD KEY `actas_ref_reunion_foreign` (`ref_reunion`);

--
-- Indices de la tabla `aprobacions`
--
ALTER TABLE `aprobacions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `aprobacions_ref_miembro_ref_acta_unique` (`ref_miembro`,`ref_acta`),
  ADD KEY `aprobacions_ref_acta_foreign` (`ref_acta`);

--
-- Indices de la tabla `asistentes`
--
ALTER TABLE `asistentes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `asistentes_ref_usuario_foreign` (`ref_usuario`),
  ADD KEY `asistentes_ref_acta_foreign` (`ref_acta`);

--
-- Indices de la tabla `asistente_reunions`
--
ALTER TABLE `asistente_reunions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `asistente_reunions_ref_reunion_foreign` (`ref_reunion`),
  ADD KEY `asistente_reunions_ref_usuario_foreign` (`ref_usuario`);

--
-- Indices de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indices de la tabla `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indices de la tabla `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indices de la tabla `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indices de la tabla `reunions`
--
ALTER TABLE `reunions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `reunions_numero_reunion_tipo_reunion_unique` (`numero_reunion`,`tipo_reunion`),
  ADD KEY `reunions_ref_usuario_foreign` (`ref_usuario`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indices de la tabla `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indices de la tabla `temas`
--
ALTER TABLE `temas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `temas_ref_acta_foreign` (`ref_acta`);

--
-- Indices de la tabla `tema_reunions`
--
ALTER TABLE `tema_reunions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tema_reunions_ref_reunion_foreign` (`ref_reunion`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `accions`
--
ALTER TABLE `accions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `actas`
--
ALTER TABLE `actas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `aprobacions`
--
ALTER TABLE `aprobacions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `asistentes`
--
ALTER TABLE `asistentes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `asistente_reunions`
--
ALTER TABLE `asistente_reunions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `reunions`
--
ALTER TABLE `reunions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `temas`
--
ALTER TABLE `temas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `tema_reunions`
--
ALTER TABLE `tema_reunions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `accions`
--
ALTER TABLE `accions`
  ADD CONSTRAINT `accions_ref_acta_foreign` FOREIGN KEY (`ref_acta`) REFERENCES `actas` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `accions_ref_tema_foreign` FOREIGN KEY (`ref_tema`) REFERENCES `temas` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `accions_ref_usuario_foreign` FOREIGN KEY (`ref_usuario`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `actas`
--
ALTER TABLE `actas`
  ADD CONSTRAINT `actas_ref_reunion_foreign` FOREIGN KEY (`ref_reunion`) REFERENCES `reunions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `actas_ref_usuario_foreign` FOREIGN KEY (`ref_usuario`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `aprobacions`
--
ALTER TABLE `aprobacions`
  ADD CONSTRAINT `aprobacions_ref_acta_foreign` FOREIGN KEY (`ref_acta`) REFERENCES `actas` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `aprobacions_ref_miembro_foreign` FOREIGN KEY (`ref_miembro`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `asistentes`
--
ALTER TABLE `asistentes`
  ADD CONSTRAINT `asistentes_ref_acta_foreign` FOREIGN KEY (`ref_acta`) REFERENCES `actas` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `asistentes_ref_usuario_foreign` FOREIGN KEY (`ref_usuario`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `asistente_reunions`
--
ALTER TABLE `asistente_reunions`
  ADD CONSTRAINT `asistente_reunions_ref_reunion_foreign` FOREIGN KEY (`ref_reunion`) REFERENCES `reunions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `asistente_reunions_ref_usuario_foreign` FOREIGN KEY (`ref_usuario`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `reunions`
--
ALTER TABLE `reunions`
  ADD CONSTRAINT `reunions_ref_usuario_foreign` FOREIGN KEY (`ref_usuario`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `temas`
--
ALTER TABLE `temas`
  ADD CONSTRAINT `temas_ref_acta_foreign` FOREIGN KEY (`ref_acta`) REFERENCES `actas` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `tema_reunions`
--
ALTER TABLE `tema_reunions`
  ADD CONSTRAINT `tema_reunions_ref_reunion_foreign` FOREIGN KEY (`ref_reunion`) REFERENCES `reunions` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
