-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 14-11-2025 a las 18:55:38
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `Labanda`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `id_categoria` int(11) NOT NULL,
  `tipo` enum('familiar','individual','ocio') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`id_categoria`, `tipo`) VALUES
(1, 'familiar'),
(2, 'individual'),
(3, 'ocio');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `destino`
--

CREATE TABLE `destino` (
  `id_destino` int(11) NOT NULL,
  `nombres` varchar(100) NOT NULL,
  `pais` varchar(100) NOT NULL,
  `tipo` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `destino`
--

INSERT INTO `destino` (`id_destino`, `nombres`, `pais`, `tipo`) VALUES
(101, 'Machu Picchu', 'Perú', 'Histórico'),
(102, 'Cancún', 'México', 'Playa'),
(103, 'Reserva Masái Mara', 'Kenia', 'Safari'),
(104, 'París', 'Francia', 'Cultural'),
(105, 'Patagonia', 'Argentina', 'Aventura'),
(106, 'Caribe', 'Internacional', 'Crucero'),
(107, 'Nueva York', 'Estados Unidos', 'Urbano'),
(108, 'Ruta Maya', 'México', 'Histórico'),
(109, 'Islas Griegas', 'Grecia', 'Playa'),
(110, 'Selva Amazónica', 'Brasil', 'Aventura');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paquete`
--

CREATE TABLE `paquete` (
  `id_paquete` int(11) NOT NULL,
  `id_destino` int(11) NOT NULL,
  `id_promocion` int(11) DEFAULT NULL,
  `id_categoria` int(11) DEFAULT NULL,
  `nombre` varchar(100) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `precio` decimal(10,2) NOT NULL,
  `duracion_dias` int(11) NOT NULL,
  `fecha_salida` date NOT NULL,
  `fecha_regreso` date NOT NULL,
  `estado` enum('Disponible','No disponible') NOT NULL DEFAULT 'Disponible',
  `cupo` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `paquete`
--

INSERT INTO `paquete` (`id_paquete`, `id_destino`, `id_promocion`, `id_categoria`, `nombre`, `descripcion`, `precio`, `duracion_dias`, `fecha_salida`, `fecha_regreso`, `estado`, `cupo`) VALUES
(1, 101, 1, 2, 'Aventura en Machu Picchu', 'Excursiones guiadas por Cusco y Machu Picchu', 1200.00, 7, '2025-10-01', '2025-10-08', 'No disponible', 20),
(2, 102, 2, 3, 'Playas de Cancún', 'Vacaciones todo incluido frente al mar', 1500.00, 5, '2025-11-15', '2025-11-20', 'Disponible', 30),
(3, 103, 3, 1, 'Safari en Kenia', 'Safaris en la reserva Masái Mara', 3500.00, 10, '2025-09-20', '2025-09-30', 'Disponible', 15),
(4, 104, 4, 3, 'Turismo en París', 'Visita a la Torre Eiffel y Louvre', 2000.00, 6, '2025-12-05', '2025-12-11', 'Disponible', 25),
(5, 105, 5, 1, 'Aventura en Patagonia', 'Trekking por glaciares del sur argentino', 1800.00, 8, '2025-11-10', '2025-11-18', 'Disponible', 20);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paquete_servicio`
--

CREATE TABLE `paquete_servicio` (
  `id_servicio` int(11) NOT NULL,
  `id_paquete` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `paquete_servicio`
--

INSERT INTO `paquete_servicio` (`id_servicio`, `id_paquete`) VALUES
(1, 1),
(1, 5),
(2, 1),
(3, 2),
(4, 3),
(5, 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `promocion`
--

CREATE TABLE `promocion` (
  `id_promocion` int(11) NOT NULL,
  `tipo` varchar(50) NOT NULL,
  `descuento` decimal(10,2) NOT NULL,
  `fecha_inicio` date NOT NULL,
  `fecha_fin` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `promocion`
--

INSERT INTO `promocion` (`id_promocion`, `tipo`, `descuento`, `fecha_inicio`, `fecha_fin`) VALUES
(1, 'Descuento', 200.00, '2025-09-01', '2025-09-30'),
(2, '2x1', 300.00, '2025-10-01', '2025-10-15'),
(3, 'Oferta Especial', 250.00, '2025-08-20', '2025-09-10'),
(4, 'Descuento', 150.00, '2025-11-01', '2025-11-20'),
(5, 'Descuento', 200.00, '2025-10-10', '2025-10-25'),
(6, 'Crédito Viaje', 100.00, '2025-09-15', '2025-09-30'),
(7, 'Oferta Especial', 100.00, '2025-08-25', '2025-09-05'),
(8, 'Descuento', 200.00, '2025-11-10', '2025-11-25'),
(9, '2x1', 400.00, '2025-07-01', '2025-07-20'),
(10, 'Oferta Especial', 200.00, '2025-08-01', '2025-08-15');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedor`
--

CREATE TABLE `proveedor` (
  `id_proveedor` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `tipo` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `proveedor`
--

INSERT INTO `proveedor` (`id_proveedor`, `nombre`, `tipo`) VALUES
(1, 'Proveedor A', 'Transporte'),
(2, 'Proveedor B', 'Alojamiento'),
(3, 'Proveedor C', 'Excursiones'),
(4, 'Proveedor D', 'Guía turístico'),
(5, 'Proveedor E', 'Seguro de viaje');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedor_servicio`
--

CREATE TABLE `proveedor_servicio` (
  `id_servicio` int(11) NOT NULL,
  `id_proveedor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `proveedor_servicio`
--

INSERT INTO `proveedor_servicio` (`id_servicio`, `id_proveedor`) VALUES
(1, 1),
(2, 2),
(3, 3),
(4, 4),
(5, 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicio`
--

CREATE TABLE `servicio` (
  `id_servicio` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `descripcion` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `servicio`
--

INSERT INTO `servicio` (`id_servicio`, `nombre`, `precio`, `descripcion`) VALUES
(1, 'Traslados', 100.00, 'Incluye transporte desde y hacia el aeropuerto'),
(2, 'Alojamiento', 300.00, 'Estadía en hoteles seleccionados con desayuno incluido'),
(3, 'Excursiones', 200.00, 'Actividades y tours guiados en los principales atractivos'),
(4, 'Guía turístico', 150.00, 'Guías profesionales durante todo el recorrido'),
(5, 'Seguro de viaje', 50.00, 'Cobertura médica y asistencia en el extranjero'),
(6, 'Alimentación', 120.00, 'Comidas incluidas en restaurantes locales'),
(7, 'Entradas', 80.00, 'Tickets a museos, parques y sitios arqueológicos'),
(8, 'Crucero', 500.00, 'Paseos en barco o cruceros según destino'),
(9, 'Transporte interno', 90.00, 'Buses y trenes para traslados dentro del destino'),
(10, 'Experiencias culturales', 110.00, 'Shows, eventos y actividades locales');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id_usuario` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `contraseña` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `rol` enum('admin','empleado','cliente') NOT NULL DEFAULT 'cliente',
  `edad` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--



-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas`
--

CREATE TABLE `ventas` (
  `id_compra` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_paquete` int(11) NOT NULL,
  `fecha_compra` date NOT NULL,
  `estado` varchar(20) NOT NULL,
  `cantidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `ventas`
--

INSERT INTO `ventas` (`id_compra`, `id_usuario`, `id_paquete`, `fecha_compra`, `estado`, `cantidad`) VALUES
(1, 1, 2, '2025-08-10', 'Pagada', 1),
(2, 2, 1, '2025-08-12', 'Pendiente', 2),
(3, 3, 5, '2025-08-15', 'Pagada', 1),
(4, 1, 3, '2025-08-20', 'Cancelada', 0),
(5, 4, 4, '2025-08-22', 'Pagada', 1),
(6, 5, 2, '2025-08-25', 'Pendiente', 3);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`id_categoria`);

--
-- Indices de la tabla `destino`
--
ALTER TABLE `destino`
  ADD PRIMARY KEY (`id_destino`);

--
-- Indices de la tabla `paquete`
--
ALTER TABLE `paquete`
  ADD PRIMARY KEY (`id_paquete`),
  ADD KEY `id_destino` (`id_destino`),
  ADD KEY `id_promocion` (`id_promocion`),
  ADD KEY `id_categoria` (`id_categoria`);

--
-- Indices de la tabla `paquete_servicio`
--
ALTER TABLE `paquete_servicio`
  ADD PRIMARY KEY (`id_servicio`,`id_paquete`),
  ADD KEY `id_paquete` (`id_paquete`);

--
-- Indices de la tabla `promocion`
--
ALTER TABLE `promocion`
  ADD PRIMARY KEY (`id_promocion`);

--
-- Indices de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  ADD PRIMARY KEY (`id_proveedor`);

--
-- Indices de la tabla `proveedor_servicio`
--
ALTER TABLE `proveedor_servicio`
  ADD PRIMARY KEY (`id_servicio`,`id_proveedor`),
  ADD KEY `id_proveedor` (`id_proveedor`);

--
-- Indices de la tabla `servicio`
--
ALTER TABLE `servicio`
  ADD PRIMARY KEY (`id_servicio`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_usuario`);

--
-- Indices de la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD PRIMARY KEY (`id_compra`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `id_paquete` (`id_paquete`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `destino`
--
ALTER TABLE `destino`
  MODIFY `id_destino` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=111;

--
-- AUTO_INCREMENT de la tabla `paquete`
--
ALTER TABLE `paquete`
  MODIFY `id_paquete` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `promocion`
--
ALTER TABLE `promocion`
  MODIFY `id_promocion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  MODIFY `id_proveedor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `servicio`
--
ALTER TABLE `servicio`
  MODIFY `id_servicio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `ventas`
--
ALTER TABLE `ventas`
  MODIFY `id_compra` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `paquete`
--
ALTER TABLE `paquete`
  ADD CONSTRAINT `paquete_ibfk_1` FOREIGN KEY (`id_destino`) REFERENCES `destino` (`id_destino`),
  ADD CONSTRAINT `paquete_ibfk_2` FOREIGN KEY (`id_promocion`) REFERENCES `promocion` (`id_promocion`),
  ADD CONSTRAINT `paquete_ibfk_3` FOREIGN KEY (`id_categoria`) REFERENCES `categoria` (`id_categoria`);

--
-- Filtros para la tabla `paquete_servicio`
--
ALTER TABLE `paquete_servicio`
  ADD CONSTRAINT `paquete_servicio_ibfk_1` FOREIGN KEY (`id_servicio`) REFERENCES `servicio` (`id_servicio`),
  ADD CONSTRAINT `paquete_servicio_ibfk_2` FOREIGN KEY (`id_paquete`) REFERENCES `paquete` (`id_paquete`);

--
-- Filtros para la tabla `proveedor_servicio`
--
ALTER TABLE `proveedor_servicio`
  ADD CONSTRAINT `proveedor_servicio_ibfk_1` FOREIGN KEY (`id_servicio`) REFERENCES `servicio` (`id_servicio`),
  ADD CONSTRAINT `proveedor_servicio_ibfk_2` FOREIGN KEY (`id_proveedor`) REFERENCES `proveedor` (`id_proveedor`);

--
-- Filtros para la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD CONSTRAINT `ventas_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`),
  ADD CONSTRAINT `ventas_ibfk_2` FOREIGN KEY (`id_paquete`) REFERENCES `paquete` (`id_paquete`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
