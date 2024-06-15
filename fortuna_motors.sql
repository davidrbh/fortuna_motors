-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 15-06-2024 a las 06:01:52
-- Versión del servidor: 10.4.18-MariaDB
-- Versión de PHP: 8.0.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `fortuna_motors`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `brands_vehicles`
--

CREATE TABLE `brands_vehicles` (
  `id_brand_vehicle` bigint(20) NOT NULL,
  `model_vehicle_id` bigint(20) NOT NULL,
  `name` text NOT NULL,
  `description` text DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `descriptions_events`
--

CREATE TABLE `descriptions_events` (
  `id_description_event` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `title_event` text NOT NULL,
  `description` text DEFAULT NULL,
  `draw_date` date NOT NULL,
  `number_tickets` int(11) NOT NULL,
  `ticket_price` int(11) NOT NULL,
  `vehicle_id` bigint(20) NOT NULL,
  `lottery_id` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `events`
--

CREATE TABLE `events` (
  `id_event` bigint(20) NOT NULL,
  `description_event_id` bigint(20) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lotterys`
--

CREATE TABLE `lotterys` (
  `id_lottery` bigint(20) NOT NULL,
  `name` text NOT NULL,
  `description` text DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `lotterys`
--

INSERT INTO `lotterys` (`id_lottery`, `name`, `description`, `status`) VALUES
(1, 'Triple Caracas', 'Loteria de Caracas', 1),
(2, 'Triple Zulia', 'Loteria del Zulia', 1),
(3, 'Triple Tachira', 'Loteria del Tachira', 1),
(4, 'Chance en Linea', 'Loteria de Chance en Linea', 1),
(5, 'El Relancino', 'Loteria de caracas, el relancino', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `models_vehicles`
--

CREATE TABLE `models_vehicles` (
  `id_model_vehicle` bigint(20) NOT NULL,
  `brand_vehicle_id` bigint(20) NOT NULL,
  `name` text NOT NULL,
  `description` text DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `modules`
--

CREATE TABLE `modules` (
  `id_module` bigint(20) NOT NULL,
  `name_module` varchar(255) NOT NULL,
  `description_module` varchar(255) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `modules`
--

INSERT INTO `modules` (`id_module`, `name_module`, `description_module`, `status`) VALUES
(1, 'Dashboard', 'Dashboard del sistema principal', 1),
(2, 'Roles', 'Roles de usuario', 1),
(3, 'Usuarios', 'Usuarios del sistema', 1),
(4, 'Eventos', 'Rifas y eventos a realizar', 1),
(5, 'Vehículos', 'se insertan los vehículos para las rifas y eventos', 1),
(6, 'Transacciones de pago', 'Verification de transacciones y comprobante de pagos', 1),
(7, 'Loterías ', 'Registro de loterías ', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `payment_details`
--

CREATE TABLE `payment_details` (
  `id_payment_detail` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `type_transaction_id` bigint(20) NOT NULL,
  `proof_payment` int(11) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permissions`
--

CREATE TABLE `permissions` (
  `id_permission` bigint(20) NOT NULL,
  `rol_id` bigint(20) NOT NULL,
  `module_id` bigint(20) NOT NULL,
  `r` int(11) NOT NULL DEFAULT 0,
  `w` int(11) NOT NULL DEFAULT 0,
  `u` int(11) NOT NULL DEFAULT 0,
  `d` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id_rol` bigint(20) NOT NULL,
  `name_rol` text NOT NULL,
  `description_rol` text NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id_rol`, `name_rol`, `description_rol`, `status`) VALUES
(1, 'Administrador', 'Administrador del sistema', 1),
(2, 'Usuario', 'Usuario Basico del sistema', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tickets`
--

CREATE TABLE `tickets` (
  `id_ticket` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `ticket_number_id` bigint(20) NOT NULL,
  `payment_detail_id` bigint(20) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ticket_numbers`
--

CREATE TABLE `ticket_numbers` (
  `id_ticket_number` bigint(20) NOT NULL,
  `event_id` bigint(20) NOT NULL,
  `number` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `transactions`
--

CREATE TABLE `transactions` (
  `id_transaction` bigint(20) NOT NULL,
  `ticket_id` bigint(20) NOT NULL,
  `description` text DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `types_translations`
--

CREATE TABLE `types_translations` (
  `id_type_translation` bigint(20) NOT NULL,
  `name` text NOT NULL,
  `description` text DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `types_vehicles`
--

CREATE TABLE `types_vehicles` (
  `id_type_vehicle` bigint(20) NOT NULL,
  `name` text NOT NULL,
  `description` text DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id_user` bigint(20) NOT NULL,
  `cedula` varchar(12) NOT NULL,
  `name` text NOT NULL,
  `last_name` text NOT NULL,
  `phone` varchar(20) NOT NULL,
  `email_user` varchar(255) NOT NULL,
  `password` varchar(100) NOT NULL,
  `token` varchar(100) NOT NULL,
  `rol_id` bigint(20) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id_user`, `cedula`, `name`, `last_name`, `phone`, `email_user`, `password`, `token`, `rol_id`, `created_at`, `status`) VALUES
(1, 'V-24723325', 'David', 'Barrera', '424-2029800', '7396davidrbh@gmail.com', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', '', 1, '2024-05-27 19:51:47', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vehicles`
--

CREATE TABLE `vehicles` (
  `id_vehicle` bigint(20) NOT NULL,
  `model_vehicle_id` bigint(20) NOT NULL,
  `name` text NOT NULL,
  `color` text NOT NULL,
  `description` text DEFAULT NULL,
  `year` date NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `brands_vehicles`
--
ALTER TABLE `brands_vehicles`
  ADD PRIMARY KEY (`id_brand_vehicle`),
  ADD KEY `model_vehicle_id` (`model_vehicle_id`);

--
-- Indices de la tabla `descriptions_events`
--
ALTER TABLE `descriptions_events`
  ADD PRIMARY KEY (`id_description_event`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `lottery_id` (`lottery_id`),
  ADD KEY `vehicle_id` (`vehicle_id`);

--
-- Indices de la tabla `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id_event`),
  ADD KEY `description_event_id` (`description_event_id`);

--
-- Indices de la tabla `lotterys`
--
ALTER TABLE `lotterys`
  ADD PRIMARY KEY (`id_lottery`);

--
-- Indices de la tabla `models_vehicles`
--
ALTER TABLE `models_vehicles`
  ADD PRIMARY KEY (`id_model_vehicle`),
  ADD KEY `brand_vehicle_id` (`brand_vehicle_id`);

--
-- Indices de la tabla `modules`
--
ALTER TABLE `modules`
  ADD PRIMARY KEY (`id_module`);

--
-- Indices de la tabla `payment_details`
--
ALTER TABLE `payment_details`
  ADD PRIMARY KEY (`id_payment_detail`),
  ADD KEY `type_transaction_id` (`type_transaction_id`);

--
-- Indices de la tabla `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id_permission`),
  ADD KEY `rol_id` (`rol_id`),
  ADD KEY `module_id` (`module_id`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id_rol`);

--
-- Indices de la tabla `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`id_ticket`),
  ADD KEY `payment_detail_id` (`payment_detail_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `ticket_number_id` (`ticket_number_id`);

--
-- Indices de la tabla `ticket_numbers`
--
ALTER TABLE `ticket_numbers`
  ADD PRIMARY KEY (`id_ticket_number`),
  ADD KEY `event_id` (`event_id`);

--
-- Indices de la tabla `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id_transaction`),
  ADD KEY `ticket_id` (`ticket_id`);

--
-- Indices de la tabla `types_translations`
--
ALTER TABLE `types_translations`
  ADD PRIMARY KEY (`id_type_translation`);

--
-- Indices de la tabla `types_vehicles`
--
ALTER TABLE `types_vehicles`
  ADD PRIMARY KEY (`id_type_vehicle`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`),
  ADD KEY `rol_id` (`rol_id`);

--
-- Indices de la tabla `vehicles`
--
ALTER TABLE `vehicles`
  ADD PRIMARY KEY (`id_vehicle`),
  ADD KEY `model_vehicle_id` (`model_vehicle_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `brands_vehicles`
--
ALTER TABLE `brands_vehicles`
  MODIFY `id_brand_vehicle` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `descriptions_events`
--
ALTER TABLE `descriptions_events`
  MODIFY `id_description_event` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `events`
--
ALTER TABLE `events`
  MODIFY `id_event` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `lotterys`
--
ALTER TABLE `lotterys`
  MODIFY `id_lottery` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `models_vehicles`
--
ALTER TABLE `models_vehicles`
  MODIFY `id_model_vehicle` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `modules`
--
ALTER TABLE `modules`
  MODIFY `id_module` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `payment_details`
--
ALTER TABLE `payment_details`
  MODIFY `id_payment_detail` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id_permission` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id_rol` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `tickets`
--
ALTER TABLE `tickets`
  MODIFY `id_ticket` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `ticket_numbers`
--
ALTER TABLE `ticket_numbers`
  MODIFY `id_ticket_number` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id_transaction` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `types_translations`
--
ALTER TABLE `types_translations`
  MODIFY `id_type_translation` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `types_vehicles`
--
ALTER TABLE `types_vehicles`
  MODIFY `id_type_vehicle` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id_user` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `vehicles`
--
ALTER TABLE `vehicles`
  MODIFY `id_vehicle` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `brands_vehicles`
--
ALTER TABLE `brands_vehicles`
  ADD CONSTRAINT `brands_vehicles_ibfk_1` FOREIGN KEY (`model_vehicle_id`) REFERENCES `types_vehicles` (`id_type_vehicle`);

--
-- Filtros para la tabla `descriptions_events`
--
ALTER TABLE `descriptions_events`
  ADD CONSTRAINT `descriptions_events_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id_user`),
  ADD CONSTRAINT `descriptions_events_ibfk_2` FOREIGN KEY (`lottery_id`) REFERENCES `lotterys` (`id_lottery`),
  ADD CONSTRAINT `descriptions_events_ibfk_3` FOREIGN KEY (`vehicle_id`) REFERENCES `vehicles` (`id_vehicle`);

--
-- Filtros para la tabla `events`
--
ALTER TABLE `events`
  ADD CONSTRAINT `events_ibfk_1` FOREIGN KEY (`description_event_id`) REFERENCES `descriptions_events` (`id_description_event`);

--
-- Filtros para la tabla `models_vehicles`
--
ALTER TABLE `models_vehicles`
  ADD CONSTRAINT `models_vehicles_ibfk_1` FOREIGN KEY (`brand_vehicle_id`) REFERENCES `brands_vehicles` (`id_brand_vehicle`);

--
-- Filtros para la tabla `payment_details`
--
ALTER TABLE `payment_details`
  ADD CONSTRAINT `payment_details_ibfk_1` FOREIGN KEY (`type_transaction_id`) REFERENCES `types_translations` (`id_type_translation`);

--
-- Filtros para la tabla `permissions`
--
ALTER TABLE `permissions`
  ADD CONSTRAINT `permissions_ibfk_1` FOREIGN KEY (`rol_id`) REFERENCES `roles` (`id_rol`) ON UPDATE CASCADE,
  ADD CONSTRAINT `permissions_ibfk_2` FOREIGN KEY (`module_id`) REFERENCES `modules` (`id_module`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `tickets`
--
ALTER TABLE `tickets`
  ADD CONSTRAINT `tickets_ibfk_1` FOREIGN KEY (`payment_detail_id`) REFERENCES `payment_details` (`id_payment_detail`),
  ADD CONSTRAINT `tickets_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id_user`),
  ADD CONSTRAINT `tickets_ibfk_3` FOREIGN KEY (`ticket_number_id`) REFERENCES `ticket_numbers` (`id_ticket_number`);

--
-- Filtros para la tabla `ticket_numbers`
--
ALTER TABLE `ticket_numbers`
  ADD CONSTRAINT `ticket_numbers_ibfk_1` FOREIGN KEY (`event_id`) REFERENCES `events` (`id_event`);

--
-- Filtros para la tabla `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `transactions_ibfk_1` FOREIGN KEY (`ticket_id`) REFERENCES `tickets` (`id_ticket`);

--
-- Filtros para la tabla `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`rol_id`) REFERENCES `roles` (`id_rol`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `vehicles`
--
ALTER TABLE `vehicles`
  ADD CONSTRAINT `vehicles_ibfk_1` FOREIGN KEY (`model_vehicle_id`) REFERENCES `models_vehicles` (`id_model_vehicle`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
