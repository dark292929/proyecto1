-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 25-01-2024 a las 21:16:49
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `sistemadeventas`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id` int(11) NOT NULL,
  `categorias` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id`, `categorias`) VALUES
(11, 'Almacen 1'),
(13, 'Almacen 2'),
(14, 'Almacen 3'),
(15, 'Almacen Principal');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `id` int(11) NOT NULL,
  `nombre` text NOT NULL,
  `documento` int(11) NOT NULL,
  `email` text NOT NULL,
  `telefono` text NOT NULL,
  `direccion` text NOT NULL,
  `compras` int(11) NOT NULL,
  `ultima_compra` datetime NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `monto_actual` decimal(10,3) DEFAULT NULL,
  `suma_pagos` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id`, `nombre`, `documento`, `email`, `telefono`, `direccion`, `compras`, `ultima_compra`, `fecha`, `monto_actual`, `suma_pagos`) VALUES
(6, 'Delaborum', 5555, 'daad@gmail.com', '987654321', 'cliente prueba', 89, '2024-01-22 12:23:37', '2024-01-24 15:17:16', 3600.000, 4300.00),
(9, 'cliente prueba333', 0, 'clienteprueba333@gmail.com', 'cliente prueba333', 'cliente prueba333', 0, '0000-00-00 00:00:00', '2024-01-24 06:06:42', 1300.000, 2000.00);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inventario`
--

CREATE TABLE `inventario` (
  `id` int(11) NOT NULL,
  `id_producto` int(11) DEFAULT NULL,
  `id_categoria` int(11) DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `inventario`
--

INSERT INTO `inventario` (`id`, `id_producto`, `id_categoria`, `cantidad`) VALUES
(1, 123, 13, 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pagos`
--

CREATE TABLE `pagos` (
  `id` int(11) NOT NULL,
  `monto` decimal(10,0) DEFAULT NULL,
  `Detalle` varchar(255) DEFAULT NULL,
  `fechahora` datetime DEFAULT NULL,
  `cliente` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `pagos`
--

INSERT INTO `pagos` (`id`, `monto`, `Detalle`, `fechahora`, `cliente`) VALUES
(1, 1000, 'BCP cuenta: 0000123456965874', '2024-01-15 00:00:00', 6),
(2, 500, 'bbva cuenta: 123456789', '2024-01-16 00:00:00', 6),
(3, 5000, 'Detalle Prueba', '2024-01-17 20:36:15', 9),
(98, 500, 'dsasddas', '2024-01-24 01:06:00', 9),
(99, 1000, 'pruebadefuego', '2024-01-24 01:08:00', 6),
(100, 1000, 'paypal', '2024-01-24 10:17:00', 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(11) NOT NULL,
  `codigo` text DEFAULT NULL,
  `descripcion` text DEFAULT NULL,
  `stock` int(11) DEFAULT NULL,
  `precio_compra` float DEFAULT NULL,
  `precio_venta` float DEFAULT NULL,
  `ventas` int(11) DEFAULT NULL,
  `fecha` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `categoria` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `codigo`, `descripcion`, `stock`, `precio_compra`, `precio_venta`, `ventas`, `fecha`, `categoria`) VALUES
(123, '1501', 'producto prueba3', 83, 4, 5.6, 19, '2024-01-22 17:23:36', 15),
(125, '1501', 'sad', 2, 2, 2.8, 1, '2024-01-20 21:05:03', 15);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` text DEFAULT NULL,
  `usuario` text DEFAULT NULL,
  `password` text DEFAULT NULL,
  `perfil` text DEFAULT NULL,
  `estado` int(11) DEFAULT NULL,
  `rol` int(11) DEFAULT NULL,
  `categoria` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `usuario`, `password`, `perfil`, `estado`, `rol`, `categoria`) VALUES
(1, 'Administrador', 'admin', '$2a$07$asxx54ahjppf45sd87a5auFL5K1.Cmt9ZheoVVuudOi5BCi10qWly', 'Administrador', 1, 1, 11);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas`
--

CREATE TABLE `ventas` (
  `id` int(11) NOT NULL,
  `codigo` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `id_vendedor` int(11) NOT NULL,
  `productos` int(11) DEFAULT NULL,
  `impuesto` float NOT NULL,
  `neto` float NOT NULL,
  `total` float NOT NULL,
  `metodo_pago` text NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `ventas`
--

INSERT INTO `ventas` (`id`, `codigo`, `id_cliente`, `id_vendedor`, `productos`, `impuesto`, `neto`, `total`, `metodo_pago`, `fecha`) VALUES
(72, 10001, 6, 1, 123, 0.224, 11.2, 11.424, 'efectivo', '2024-01-20 20:12:00'),
(73, 10002, 6, 1, 123, 0.14, 14, 14.14, 'efectivo', '2024-01-20 21:05:03'),
(74, 10002, 6, 1, 125, 0.14, 14, 14.14, 'efectivo', '2024-01-20 21:05:03'),
(75, 10003, 6, 1, 123, 112, 11.2, 123.2, 'efectivo', '2024-01-22 17:22:19'),
(76, 10004, 6, 1, 123, 2.8, 56, 58.8, 'efectivo', '2024-01-22 17:23:37');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `inventario`
--
ALTER TABLE `inventario`
  ADD PRIMARY KEY (`id`),
  ADD KEY `relacion_inventariocategoria` (`id_categoria`),
  ADD KEY `relacion_inventarioproducto` (`id_producto`);

--
-- Indices de la tabla `pagos`
--
ALTER TABLE `pagos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `relacion_pago_cliente` (`cliente`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `relacion_categoria` (`categoria`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `relacion_categoria_usuario` (`categoria`);

--
-- Indices de la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `relacion_ventacliente` (`id_cliente`),
  ADD KEY `relacion_ventaproducto` (`productos`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `inventario`
--
ALTER TABLE `inventario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `pagos`
--
ALTER TABLE `pagos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=127;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT de la tabla `ventas`
--
ALTER TABLE `ventas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `inventario`
--
ALTER TABLE `inventario`
  ADD CONSTRAINT `relacion_inventariocategoria` FOREIGN KEY (`id_categoria`) REFERENCES `categorias` (`id`),
  ADD CONSTRAINT `relacion_inventarioproducto` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id`);

--
-- Filtros para la tabla `pagos`
--
ALTER TABLE `pagos`
  ADD CONSTRAINT `relacion_pago_cliente` FOREIGN KEY (`cliente`) REFERENCES `clientes` (`id`);

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `relacion_categoria` FOREIGN KEY (`categoria`) REFERENCES `categorias` (`id`);

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `relacion_categoria_usuario` FOREIGN KEY (`categoria`) REFERENCES `categorias` (`id`);

--
-- Filtros para la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD CONSTRAINT `relacion_ventacliente` FOREIGN KEY (`id_cliente`) REFERENCES `clientes` (`id`),
  ADD CONSTRAINT `relacion_ventaproducto` FOREIGN KEY (`productos`) REFERENCES `productos` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
