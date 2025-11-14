
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


CREATE TABLE `compra` (
  `id_compra` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_paquete` int(11) NOT NULL,
  `fecha_compra` date NOT NULL,
  `estado` varchar(20) NOT NULL,
  `total` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



INSERT INTO `compra` (`id_compra`, `id_usuario`, `id_paquete`, `fecha_compra`, `estado`, `total`) VALUES
(1, 1, 2, '2025-08-10', 'Pagada', 1500.00),
(2, 2, 1, '2025-08-12', 'Pendiente', 1200.00),
(3, 3, 5, '2025-08-15', 'Pagada', 1800.00),
(4, 1, 3, '2025-08-20', 'Cancelada', 0.00),
(5, 4, 7, '2025-08-22', 'Pagada', 1300.00),
(6, 5, 9, '2025-08-25', 'Pendiente', 2800.00),
(7, 2, 4, '2025-08-27', 'Pagada', 2000.00),
(8, 3, 6, '2025-08-28', 'Pagada', 2500.00),
(9, 5, 8, '2025-08-29', 'Pendiente', 1600.00),
(10, 4, 10, '2025-08-30', 'Pagada', 1400.00);


CREATE TABLE `destino` (
  `id_destino` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `pais` varchar(100) NOT NULL,
  `tipo` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


INSERT INTO `destino` (`id_destino`, `nombre`, `pais`, `tipo`) VALUES
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



CREATE TABLE `paquete` (
  `id_paquete` int(11) NOT NULL,
  `id_destino` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `precio` decimal(10,2) NOT NULL,
  `duracion_dias` int(11) NOT NULL,
  `categoria` varchar(50) DEFAULT NULL,
  `fecha_salida` date NOT NULL,
  `fecha_regreso` date NOT NULL,
  `promocion_activa` tinyint(1) NOT NULL,
  `estado` enum('Disponible','No disponible') NOT NULL DEFAULT 'Disponible'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


INSERT INTO `paquete` (`id_paquete`, `id_destino`, `nombre`, `descripcion`, `precio`, `duracion_dias`, `categoria`, `fecha_salida`, `fecha_regreso`, `promocion_activa`, `estado`) VALUES
(1, 101, 'Aventura en Machu Picchu', 'Paquete con excursiones guiadas por Cusco y Machu Picchu', 1200.00, 7, 'Aventura', '2025-10-01', '2025-10-08', 1, 'No disponible'),
(2, 102, 'Playas de Cancún', 'Vacaciones todo incluido en hotel 5 estrellas frente al mar', 1500.00, 5, 'Playa', '2025-11-15', '2025-11-20', 1, 'Disponible'),
(3, 103, 'Safari en Kenia', 'Experiencia única con safaris en la reserva Masái Mara', 3500.00, 10, 'Safari', '2025-09-20', '2025-09-30', 0, 'No disponible'),
(4, 104, 'Turismo en París', 'Visita a la Torre Eiffel, Louvre y recorridos por la ciudad', 2000.00, 6, 'Cultural', '2025-12-05', '2025-12-11', 1, 'Disponible'),
(5, 105, 'Aventura en Patagonia', 'Trekking por glaciares y paisajes únicos del sur argentino', 1800.00, 8, 'Aventura', '2025-11-10', '2025-11-18', 0, 'Disponible'),
(6, 106, 'Crucero por el Caribe', 'Crucero de lujo con paradas en varias islas tropicales', 2500.00, 7, 'Crucero', '2025-10-20', '2025-10-27', 1, 'No disponible'),
(7, 107, 'Nueva York Exprés', 'Tour por Manhattan, Central Park y museos más famosos', 1300.00, 4, 'Urbano', '2025-09-25', '2025-09-29', 1, 'No disponible'),
(8, 108, 'Ruta Maya en México', 'Recorrido por Chichén Itzá, Tulum y cenotes de la región', 1600.00, 6, 'Cultural', '2025-12-01', '2025-12-07', 0, 'Disponible'),
(9, 109, 'Islas Griegas', 'Tour en barco por Santorini, Mykonos y Atenas', 2800.00, 9, 'Playa', '2025-07-15', '2025-07-24', 1, 'No disponible'),
(10, 110, 'Selva Amazónica', 'Exploración de la selva con guías locales y hospedaje ecológico', 1400.00, 5, 'Aventura', '2025-08-05', '2025-08-10', 0, 'No disponible');


CREATE TABLE `paquete_proveedor` (
  `id_paquete` int(11) NOT NULL,
  `id_proveedor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



INSERT INTO `paquete_proveedor` (`id_paquete`, `id_proveedor`) VALUES
(1, 1),
(1, 2),
(2, 3),
(3, 4),
(4, 2),
(5, 5),
(6, 3),
(7, 1),
(8, 4),
(9, 2),
(10, 5);



CREATE TABLE `paquete_servicio` (
  `id_servicio` int(11) NOT NULL,
  `id_paquete` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



INSERT INTO `paquete_servicio` (`id_servicio`, `id_paquete`) VALUES
(1, 1),
(1, 2),
(1, 7),
(2, 1),
(2, 4),
(2, 9),
(3, 2),
(3, 5),
(3, 10),
(4, 3),
(4, 6),
(5, 3),
(5, 8);



CREATE TABLE `promocion` (
  `id_promocion` int(11) NOT NULL,
  `id_paquete` int(11) NOT NULL,
  `tipo` varchar(50) NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `fecha_inicio` date NOT NULL,
  `fecha_fin` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



INSERT INTO `promocion` (`id_promocion`, `id_paquete`, `tipo`, `precio`, `fecha_inicio`, `fecha_fin`) VALUES
(1, 1, 'Descuento', 1000.00, '2025-09-01', '2025-09-30'),
(2, 2, '2x1', 1500.00, '2025-10-01', '2025-10-15'),
(3, 3, 'Oferta Especial', 3200.00, '2025-08-20', '2025-09-10'),
(4, 4, 'Descuento', 1800.00, '2025-11-01', '2025-11-20'),
(5, 5, 'Descuento', 1600.00, '2025-10-10', '2025-10-25'),
(6, 6, 'Crédito Viaje', 2400.00, '2025-09-15', '2025-09-30'),
(7, 7, 'Oferta Especial', 1200.00, '2025-08-25', '2025-09-05'),
(8, 8, 'Descuento', 1400.00, '2025-11-10', '2025-11-25'),
(9, 9, '2x1', 2500.00, '2025-07-01', '2025-07-20'),
(10, 10, 'Oferta Especial', 1200.00, '2025-08-01', '2025-08-15');



CREATE TABLE `proveedor` (
  `id_proveedor` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `stock_disponible` int(11) NOT NULL,
  `tipo` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


INSERT INTO `proveedor` (`id_proveedor`, `nombre`, `stock_disponible`, `tipo`) VALUES
(1, 'Proveedor A', 100, 'Transporte'),
(2, 'Proveedor B', 50, 'Alojamiento'),
(3, 'Proveedor C', 200, 'Excursiones'),
(4, 'Proveedor D', 75, 'Guía turístico'),
(5, 'Proveedor E', 150, 'Seguro de viaje'),
(6, 'Proveedor F', 80, 'Alimentación'),
(7, 'Proveedor G', 120, 'Entradas'),
(8, 'Proveedor H', 60, 'Crucero'),
(9, 'Proveedor I', 90, 'Transporte interno'),
(10, 'Proveedor J', 110, 'Experiencias culturales');


CREATE TABLE `servicio` (
  `id_servicio` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `descripcion` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


INSERT INTO `servicio` (`id_servicio`, `nombre`, `descripcion`) VALUES
(1, 'Traslados', 'Incluye transporte desde y hacia el aeropuerto'),
(2, 'Alojamiento', 'Estadía en hoteles seleccionados con desayuno incluido'),
(3, 'Excursiones', 'Actividades y tours guiados en los principales atractivos'),
(4, 'Guía turístico', 'Guías profesionales durante todo el recorrido'),
(5, 'Seguro de viaje', 'Cobertura médica y asistencia en el extranjero'),
(6, 'Alimentación', 'Comidas incluidas en restaurantes locales'),
(7, 'Entradas', 'Tickets a museos, parques y sitios arqueológicos'),
(8, 'Crucero', 'Paseos en barco o cruceros según destino'),
(9, 'Transporte interno', 'Buses y trenes para traslados dentro del destino'),
(10, 'Experiencias culturales', 'Shows, eventos y actividades locales');



CREATE TABLE `usuario` (
  `id_usuario` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `edad` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



INSERT INTO `usuario` (`id_usuario`, `nombre`, `email`, `telefono`, `edad`) VALUES
(1, 'Juan Pérez', 'juan.perez@example.com', '3512345678', 30),
(2, 'María González', 'maria.gonzalez@example.com', '3518765432', 28),
(3, 'Carlos López', 'carlos.lopez@example.com', '1134567890', 35),
(4, 'Ana Torres', 'ana.torres@example.com', '1167891234', 25),
(5, 'Luis Fernández', 'luis.fernandez@example.com', '1145678901', 40),
(6, 'Laura Martínez', 'laura.martinez@example.com', '1123456789', 33),
(7, 'Pedro Ramírez', 'pedro.ramirez@example.com', '1178901234', 27),
(8, 'Sofía Herrera', 'sofia.herrera@example.com', '1187654321', 29),
(9, 'Martín Castro', 'martin.castro@example.com', '1198765432', 32),
(10, 'Camila Díaz', 'camila.diaz@example.com', '1112345678', 26);


ALTER TABLE `compra`
  ADD PRIMARY KEY (`id_compra`);

ALTER TABLE `destino`
  ADD PRIMARY KEY (`id_destino`);


ALTER TABLE `paquete`
  ADD PRIMARY KEY (`id_paquete`);


ALTER TABLE `paquete_proveedor`
  ADD PRIMARY KEY (`id_paquete`,`id_proveedor`),
  ADD KEY `fk_pp_proveedor` (`id_proveedor`);


ALTER TABLE `paquete_servicio`
  ADD PRIMARY KEY (`id_servicio`,`id_paquete`);

ALTER TABLE `promocion`
  ADD PRIMARY KEY (`id_promocion`),
  ADD KEY `fk_promocion_paquete` (`id_paquete`);


ALTER TABLE `proveedor`
  ADD PRIMARY KEY (`id_proveedor`);


ALTER TABLE `servicio`
  ADD PRIMARY KEY (`id_servicio`);


ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_usuario`);


ALTER TABLE `paquete_proveedor`
  ADD CONSTRAINT `fk_pp_paquete` FOREIGN KEY (`id_paquete`) REFERENCES `paquete` (`id_paquete`),
  ADD CONSTRAINT `fk_pp_proveedor` FOREIGN KEY (`id_proveedor`) REFERENCES `proveedor` (`id_proveedor`);

ALTER TABLE `promocion`
  ADD CONSTRAINT `fk_promocion_paquete` FOREIGN KEY (`id_paquete`) REFERENCES `paquete` (`id_paquete`);
COMMIT;
