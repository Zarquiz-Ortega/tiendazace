-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 13-03-2024 a las 20:43:02
-- Versión del servidor: 10.4.25-MariaDB
-- Versión de PHP: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `zace`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `caracteristicas`
--

CREATE TABLE `caracteristicas` (
  `id` int(11) NOT NULL,
  `caracteristica` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `activo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `caracteristicas`
--

INSERT INTO `caracteristicas` (`id`, `caracteristica`, `activo`) VALUES
(1, 'Homs', 1),
(3, 'Faradios', 1),
(4, 'color', 1),
(5, 'Henrys', 1),
(6, 'Tipo de trancistor', 0),
(7, 'Henrys', 1),
(9, 'marca', 1),
(10, 'No de piezas', 1),
(11, 'Tipo de cable', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`id`, `nombre`) VALUES
(1, 'Sin Definir'),
(2, 'Capacitor'),
(3, 'Resistencias'),
(4, 'Equipo de medicion'),
(5, 'Inductor'),
(6, 'Equipo de Pruebas'),
(7, 'Cables');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `id` int(11) NOT NULL,
  `nombres` varchar(80) COLLATE utf8_spanish_ci NOT NULL,
  `apellidos` varchar(80) COLLATE utf8_spanish_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `telefono` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `matricula` int(11) NOT NULL,
  `id_carrera` int(11) NOT NULL,
  `id_grupo` int(11) NOT NULL,
  `estatus` tinyint(4) NOT NULL,
  `fecha_alta` datetime NOT NULL,
  `fecha_modifica` datetime DEFAULT NULL,
  `fecha_baja` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id`, `nombres`, `apellidos`, `email`, `telefono`, `matricula`, `id_carrera`, `id_grupo`, `estatus`, `fecha_alta`, `fecha_modifica`, `fecha_baja`) VALUES
(2, 'Zarquiz', 'Ortega', 'zarquizortega123@gmail.com', '5608860800', 3180035, 1, 7, 1, '2023-01-14 19:00:22', NULL, NULL),
(8, 'zarquiz', 'ortega', 'vian0zarco@gmail.com', '5620860800', 3180034, 1, 8, 1, '2023-04-27 19:37:46', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compra`
--

CREATE TABLE `compra` (
  `id` int(11) NOT NULL,
  `id_transaccion` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `fecha` datetime NOT NULL,
  `status` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `id_cliente` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `total` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `compra`
--

INSERT INTO `compra` (`id`, `id_transaccion`, `fecha`, `status`, `email`, `id_cliente`, `total`) VALUES
(1, '562138093V918211H', '2022-12-01 04:45:32', 'COMPLETED', 'sb-0nr47j22018682@personal.example.com', '6NYEM595JGYVN', '30.00'),
(2, '62719632X5063712A', '2022-12-01 04:48:27', 'COMPLETED', 'sb-0nr47j22018682@personal.example.com', '6NYEM595JGYVN', '360.00'),
(3, '8WV26044178830433', '2022-12-01 04:51:31', 'COMPLETED', 'sb-0nr47j22018682@personal.example.com', '6NYEM595JGYVN', '360.00'),
(4, '2PA403048F8699227', '2022-12-01 05:14:29', 'COMPLETED', 'sb-0nr47j22018682@personal.example.com', '6NYEM595JGYVN', '330.00'),
(5, '5XH547008P061625L', '2022-12-01 05:22:47', 'COMPLETED', 'sb-0nr47j22018682@personal.example.com', '6NYEM595JGYVN', '600.00'),
(6, '1WV73791WK753944J', '2022-12-01 05:37:46', 'COMPLETED', 'sb-0nr47j22018682@personal.example.com', '6NYEM595JGYVN', '700.00'),
(7, '74538723U9118914U', '2022-12-03 03:07:20', 'COMPLETED', 'zarquizortega123@gmail.com', '674VTZRPUGACL', '60.00'),
(8, '1FS64501MH786470D', '2023-01-15 01:27:11', 'COMPLETED', 'sb-0nr47j22018682@personal.example.com', '6NYEM595JGYVN', '460.00'),
(9, '1YH174793R083911V', '2023-01-15 01:45:12', 'COMPLETED', 'sb-0nr47j22018682@personal.example.com', '6NYEM595JGYVN', '30.00'),
(10, '0AV99335YF222505U', '2023-01-17 02:34:00', 'COMPLETED', 'sb-0nr47j22018682@personal.example.com', '6NYEM595JGYVN', '745.00'),
(11, '7VC73584M9770824K', '2023-04-28 03:31:50', 'COMPLETED', 'sb-0nr47j22018682@personal.example.com', '6NYEM595JGYVN', '20.00'),
(12, '183620568F612184A', '2023-04-28 06:44:35', 'COMPLETED', 'vian0zarco@gmail.com', '8', '430.00'),
(13, '9J219862GX612500P', '2023-04-28 06:49:55', 'COMPLETED', 'vian0zarco@gmail.com', '8', '550.00'),
(14, '3JF985894S5896645', '2023-04-28 07:38:38', 'COMPLETED', 'vian0zarco@gmail.com', '8', '20.00'),
(15, '2BP231962C0261258', '2023-06-19 22:19:53', 'COMPLETED', 'vian0zarco@gmail.com', '8', '20.00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_compra`
--

CREATE TABLE `detalle_compra` (
  `id` int(11) NOT NULL,
  `id_compra` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `nombre` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `cantidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `detalle_compra`
--

INSERT INTO `detalle_compra` (`id`, `id_compra`, `id_producto`, `nombre`, `precio`, `cantidad`) VALUES
(1, 1, 1, 'Resistencia', '30.00', 1),
(2, 2, 4, 'Arduino', '300.00', 1),
(3, 2, 1, 'Resistencia', '30.00', 1),
(4, 2, 2, 'Capacitor', '10.00', 1),
(5, 2, 3, 'Compuerta logica', '20.00', 1),
(6, 3, 1, 'Resistencia', '30.00', 1),
(7, 3, 2, 'Capacitor', '10.00', 1),
(8, 3, 3, 'Compuerta logica', '20.00', 1),
(9, 3, 4, 'Arduino', '300.00', 1),
(10, 4, 4, 'Arduino', '300.00', 1),
(11, 4, 2, 'Capacitor', '10.00', 1),
(12, 4, 3, 'Compuerta logica', '20.00', 1),
(13, 5, 4, 'Arduino', '300.00', 2),
(14, 6, 14, 'Multímetro ', '120.00', 1),
(15, 6, 6, 'Jumpers', '80.00', 1),
(16, 6, 5, 'Protoboard', '100.00', 2),
(17, 6, 4, 'Arduino', '300.00', 1),
(18, 7, 1, 'Resistencia', '30.00', 1),
(19, 7, 2, 'Capacitor', '10.00', 1),
(20, 7, 3, 'Compuerta logica', '20.00', 1),
(21, 8, 2, 'Capacitor', '10.00', 1),
(22, 8, 1, 'Resistencia', '30.00', 1),
(23, 8, 4, 'Arduino', '300.00', 1),
(24, 8, 14, 'Multímetro ', '120.00', 1),
(25, 9, 2, 'Capacitor', '10.00', 1),
(26, 9, 3, 'Compuerta logica', '20.00', 1),
(27, 10, 2, 'Capacitor', '10.00', 1),
(28, 10, 1, 'Resistencia', '10.00', 1),
(29, 10, 4, 'Arduino', '300.00', 1),
(30, 10, 5, 'Protoboard', '100.00', 1),
(31, 10, 3, 'Compuerta logica', '20.00', 1),
(32, 10, 6, 'Jumpers', '80.00', 1),
(33, 10, 13, 'Transistor', '50.00', 1),
(34, 10, 14, 'Multímetro ', '120.00', 1),
(35, 10, 15, 'Inductor ', '55.00', 1),
(36, 11, 1, 'Resistencia', '10.00', 1),
(37, 11, 2, 'Capacitor', '10.00', 1),
(38, 12, 1, 'Resistencia', '10.00', 1),
(39, 12, 4, 'Arduino', '240.00', 1),
(40, 12, 5, 'Protoboard', '100.00', 1),
(41, 12, 6, 'Jumpers', '80.00', 1),
(42, 13, 1, 'Resistencia', '10.00', 1),
(43, 13, 4, 'Arduino', '240.00', 1),
(44, 13, 5, 'Protoboard', '100.00', 1),
(45, 13, 6, 'Jumpers', '80.00', 1),
(46, 13, 14, 'Multímetro ', '120.00', 1),
(47, 14, 1, 'Resistencia', '10.00', 1),
(48, 14, 2, 'Capacitor', '10.00', 1),
(49, 15, 1, 'Resistencia', '10.00', 1),
(50, 15, 2, 'Capacitor', '10.00', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `det_prod_carater`
--

CREATE TABLE `det_prod_carater` (
  `id` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `id_caracteristica` int(11) NOT NULL,
  `valor` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `stock` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `det_prod_carater`
--

INSERT INTO `det_prod_carater` (`id`, `id_producto`, `id_caracteristica`, `valor`, `stock`) VALUES
(1, 1, 1, '100 Ω', 5000),
(2, 1, 1, '10 Ω ', 12),
(3, 1, 1, '20 Ω ', 15),
(4, 1, 1, '200 Ω', 15),
(7, 6, 11, 'M-M', 0),
(9, 6, 11, 'M-H', 10);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `descripcion` text COLLATE utf8_spanish_ci NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `descuento` tinyint(3) NOT NULL DEFAULT 0,
  `id_categoria` int(11) NOT NULL,
  `activo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `nombre`, `descripcion`, `precio`, `descuento`, `id_categoria`, `activo`) VALUES
(1, 'Resistencia', '   <p>\r\n        Resistencias de orificio pasante Axial Película de carbono \r\n    </p>', '10.00', 0, 1, 1),
(2, 'Capacitor', 'Capacitor', '10.00', 0, 1, 1),
(3, 'Compuerta logica', 'Compuerta logica', '20.00', 0, 1, 1),
(4, 'Arduino', 'Arduino', '300.00', 0, 1, 1),
(5, 'Protoboard', 'protoboard', '100.00', 0, 1, 1),
(6, 'Jumpers', 'Jumpers', '80.00', 0, 7, 1),
(7, 'Transistor', 'Transistor', '50.00', 0, 1, 1),
(8, 'Multímetro ', 'multímetro ', '120.00', 0, 1, 1),
(9, 'Inductor ', 'Inductor ', '55.00', 0, 1, 1),
(21, 'potenciómetro ', 'potenciómetro ', '15.00', 0, 3, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `usuario` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `password` varchar(120) COLLATE utf8_spanish_ci NOT NULL,
  `activacion` int(11) NOT NULL DEFAULT 0,
  `token` varchar(40) COLLATE utf8_spanish_ci NOT NULL,
  `token_password` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `password_request` int(11) NOT NULL DEFAULT 0,
  `id_cliente` int(11) NOT NULL,
  `rol` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `usuario`, `password`, `activacion`, `token`, `token_password`, `password_request`, `id_cliente`, `rol`) VALUES
(2, 'zarcoad', '$2y$10$v/GeDIMj6.ULNmNZQBcuXeHwc5oaIH097/YQGvXzTaRkeyQ3KgKa2', 1, '', NULL, 0, 2, 1),
(8, 'zarco', '$2y$10$pQJk2gHikeE33Q3RGDncGuCeVnz3IOrG/ecZPV5z7635OSFh.1J.u', 1, '', NULL, 0, 8, 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `caracteristicas`
--
ALTER TABLE `caracteristicas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `compra`
--
ALTER TABLE `compra`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `detalle_compra`
--
ALTER TABLE `detalle_compra`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `det_prod_carater`
--
ALTER TABLE `det_prod_carater`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_det_prod` (`id_producto`),
  ADD KEY `fk_det_caracter` (`id_caracteristica`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uq_usuario` (`usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `caracteristicas`
--
ALTER TABLE `caracteristicas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `compra`
--
ALTER TABLE `compra`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `detalle_compra`
--
ALTER TABLE `detalle_compra`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT de la tabla `det_prod_carater`
--
ALTER TABLE `det_prod_carater`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `det_prod_carater`
--
ALTER TABLE `det_prod_carater`
  ADD CONSTRAINT `fk_det_caracter` FOREIGN KEY (`id_caracteristica`) REFERENCES `caracteristicas` (`id`),
  ADD CONSTRAINT `fk_det_prod` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
