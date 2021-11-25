-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 25, 2021 at 04:00 AM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 8.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hospital`
--

-- --------------------------------------------------------

--
-- Table structure for table `almacenes`
--

CREATE TABLE `almacenes` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `descripcion` text NOT NULL,
  `creado_por` varchar(100) NOT NULL,
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `fecha_modificacion` date DEFAULT NULL,
  `modificado_por` varchar(100) DEFAULT NULL,
  `fecha_borrado` date DEFAULT NULL,
  `borrado_por` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `almacenes`
--

INSERT INTO `almacenes` (`id`, `nombre`, `descripcion`, `creado_por`, `fecha_creacion`, `fecha_modificacion`, `modificado_por`, `fecha_borrado`, `borrado_por`) VALUES
(1, 'Almacen central', 'Primer almacen', '', '2021-10-14 03:22:53', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `articulos`
--

CREATE TABLE `articulos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `existencia` float NOT NULL DEFAULT 0,
  `stock` float NOT NULL DEFAULT 0,
  `cantidad_disponible` float NOT NULL DEFAULT 0,
  `cantidad_en_movimiento` int(7) NOT NULL DEFAULT 0,
  `almacen` int(2) DEFAULT NULL,
  `fcc` varchar(100) DEFAULT NULL,
  `fcv` varchar(100) NOT NULL,
  `status` varchar(10) NOT NULL DEFAULT 'Activo',
  `categoria` varchar(100) DEFAULT NULL,
  `precio_compra` float DEFAULT NULL,
  `precio_venta` float NOT NULL,
  `codigo_impuesto` int(2) DEFAULT NULL,
  `casa_productora` varchar(100) DEFAULT NULL,
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `creado_por` varchar(100) DEFAULT NULL,
  `fecha_modificacion` date DEFAULT NULL,
  `modificado_por` varchar(100) DEFAULT NULL,
  `fecha_borrado` date DEFAULT NULL,
  `borrado_por` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `articulos`
--

INSERT INTO `articulos` (`id`, `nombre`, `descripcion`, `existencia`, `stock`, `cantidad_disponible`, `cantidad_en_movimiento`, `almacen`, `fcc`, `fcv`, `status`, `categoria`, `precio_compra`, `precio_venta`, `codigo_impuesto`, `casa_productora`, `fecha_creacion`, `creado_por`, `fecha_modificacion`, `modificado_por`, `fecha_borrado`, `borrado_por`) VALUES
(8, 'Aspirina 300 bayer', 'Ejemplo de un artículo', 239, 10, 229, 11, 1, 'Unidad', 'Unidad', 'Activo', 'test', 200.59, 350.7, 14, 'Laboratorio el probado', '2021-11-25 02:54:04', '', NULL, NULL, NULL, NULL),
(9, 'coca cola cero', 'Coca cola sin azucar', 219, 20, 199, 11, 1, '', 'Unidad', 'Activo', '1', 300, 360, 15, 'Laboratorio el probado', '2021-11-25 02:53:52', '', NULL, NULL, NULL, NULL),
(10, 'Diclofenal', 'No se lo que es pero he escuchado el nombre', 240, 25, 215, 10, 1, '', 'Unidad', 'Activo', '1', 350, 500, 15, 'Laboratorio el probado', '2021-11-25 02:48:43', '', NULL, NULL, NULL, NULL),
(11, 'Ibuprofen', 'etesgs', 54, 4, 50, 0, 1, NULL, 'Unidad', 'Activo', '1', 352, 400, 15, 'Laboratorio el probado', '2021-11-25 00:44:40', '', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `categorias`
--

CREATE TABLE `categorias` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `descripcion` text NOT NULL,
  `fecha_creacion` int(11) NOT NULL,
  `creado_por` varchar(50) NOT NULL,
  `fecha_modificacion` date DEFAULT NULL,
  `modificado_por` varchar(100) DEFAULT NULL,
  `fecha_borrado` date DEFAULT NULL,
  `borrado_por` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categorias`
--

INSERT INTO `categorias` (`id`, `nombre`, `descripcion`, `fecha_creacion`, `creado_por`, `fecha_modificacion`, `modificado_por`, `fecha_borrado`, `borrado_por`) VALUES
(1, 'Electricos', 'Todos los electricos', 0, '', NULL, NULL, NULL, NULL),
(2, '16 porciento selectivo al consumo', '', 0, '', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `impuestos`
--

CREATE TABLE `impuestos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `tipo` varchar(100) NOT NULL,
  `porcentaje` int(10) DEFAULT NULL,
  `creado_por` varchar(50) NOT NULL,
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `modificado_por` varchar(100) DEFAULT NULL,
  `fecha_modificacion` date DEFAULT NULL,
  `borrado_por` varchar(100) DEFAULT NULL,
  `fecha_borrado` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `impuestos`
--

INSERT INTO `impuestos` (`id`, `nombre`, `tipo`, `porcentaje`, `creado_por`, `fecha_creacion`, `modificado_por`, `fecha_modificacion`, `borrado_por`, `fecha_borrado`) VALUES
(14, '16 porciento selectivo al consumo', 'Simple', 16, 'super_admin', '2021-10-22 20:52:47', NULL, NULL, NULL, NULL),
(15, '20 porciento selectivo al consumo', 'Compuesto', 20, 'super_admin', '2021-10-22 21:02:59', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `impuestos_detalles`
--

CREATE TABLE `impuestos_detalles` (
  `id` int(11) NOT NULL,
  `cabecera` int(10) NOT NULL,
  `porcentaje` int(10) NOT NULL,
  `destino` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `impuestos_detalles`
--

INSERT INTO `impuestos_detalles` (`id`, `cabecera`, `porcentaje`, `destino`) VALUES
(6, 14, 16, '16 porciento selectivo al consumo'),
(7, 15, 3, '3% de la prueba'),
(8, 15, 10, '10% de la prueba'),
(9, 15, 5, '5% de la prueba'),
(10, 15, 2, '3% de la prueba');

-- --------------------------------------------------------

--
-- Table structure for table `pacientes`
--

CREATE TABLE `pacientes` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellido` varchar(100) NOT NULL,
  `telefono` varchar(50) DEFAULT NULL,
  `celular` varchar(50) DEFAULT NULL,
  `cedula` varchar(100) DEFAULT NULL,
  `numero_record` varchar(100) DEFAULT NULL,
  `cita_previa` date DEFAULT NULL,
  `proxima_cita` date DEFAULT NULL,
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `creado_por` varchar(100) NOT NULL,
  `fecha_modificacion` date DEFAULT NULL,
  `modificado_por` varchar(100) DEFAULT NULL,
  `fecha_borrado` date DEFAULT NULL,
  `borrado_por` varchar(100) DEFAULT NULL,
  `status` varchar(10) NOT NULL DEFAULT 'Activo',
  `notas` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pacientes`
--

INSERT INTO `pacientes` (`id`, `nombre`, `apellido`, `telefono`, `celular`, `cedula`, `numero_record`, `cita_previa`, `proxima_cita`, `fecha_creacion`, `creado_por`, `fecha_modificacion`, `modificado_por`, `fecha_borrado`, `borrado_por`, `status`, `notas`) VALUES
(2, 'Claribel ', 'Maldonado', '809-536-4833', '809-216-6067', '000-0000000-1', '134242423442', '2021-10-12', '2021-10-27', '2021-10-12 15:24:18', 'super_admin', NULL, NULL, '2021-10-12', 'super_admin', 'Activo', 'Sufre de histeria, no estoy seguro si esa palabra es sin h  o con h'),
(3, 'test', '', '', '', '', '', '0000-00-00', '0000-00-00', '2021-10-15 04:29:27', 'super_admin', NULL, NULL, '2021-10-15', 'super_admin', 'Activo', ''),
(4, 'Luis', 'Matínez', '809-536-4833', '809-216-6067', '000-0000000-1', '64', '0000-00-00', '0000-00-00', '2021-10-15 17:29:43', 'super_admin', NULL, NULL, NULL, NULL, 'Activo', ''),
(5, 'Luis', 'Matínez', '809-536-4833', '809-216-6067', '000-0000000-1', '526545484', '2021-10-14', '2021-10-19', '2021-10-15 17:30:14', 'super_admin', NULL, NULL, NULL, NULL, 'Activo', 'Esto es una prueba');

-- --------------------------------------------------------

--
-- Table structure for table `roles_y_permisos`
--

CREATE TABLE `roles_y_permisos` (
  `id` int(11) NOT NULL,
  `rol` varchar(100) NOT NULL,
  `crear_articulos` int(1) NOT NULL DEFAULT 1,
  `modificar_articulos` int(1) NOT NULL DEFAULT 1,
  `eliminar_articulo` int(1) NOT NULL DEFAULT 1,
  `cargar_cantidades_a_inventario` int(1) NOT NULL DEFAULT 1,
  `retornar_articulos_en_movimiento` int(1) NOT NULL DEFAULT 1,
  `pasar_inventario` int(1) NOT NULL DEFAULT 1,
  `ver_articulos_en_movimiento` int(1) NOT NULL DEFAULT 1,
  `crear_almacenes` int(1) NOT NULL DEFAULT 1,
  `modificar_almacenes` int(1) NOT NULL DEFAULT 1,
  `eliminar_almacenes` int(1) NOT NULL DEFAULT 1,
  `crear_categorias` int(1) NOT NULL DEFAULT 1,
  `modificar_categorias` int(1) NOT NULL DEFAULT 1,
  `eliminar_categorias` int(1) NOT NULL DEFAULT 1,
  `ver_categorias` int(1) NOT NULL DEFAULT 1,
  `facturar` int(1) NOT NULL DEFAULT 1,
  `reporte` int(1) NOT NULL DEFAULT 1,
  `cuadre_caja` int(1) NOT NULL DEFAULT 1,
  `devoluciones` int(1) NOT NULL DEFAULT 1,
  `venta_en_espera` int(1) NOT NULL DEFAULT 1,
  `retomar_venta_en_espera` int(1) NOT NULL DEFAULT 1,
  `crear_clientes` int(1) NOT NULL DEFAULT 1,
  `modificar_clientes` int(1) NOT NULL DEFAULT 1,
  `eliminar_clientes` int(1) NOT NULL DEFAULT 1,
  `crear_roles` int(1) NOT NULL DEFAULT 1,
  `modificar_roles` int(1) NOT NULL DEFAULT 1,
  `eliminar_roles` int(1) NOT NULL DEFAULT 1,
  `crear_usuarios` int(1) NOT NULL DEFAULT 1,
  `modificar_usuarios` int(1) NOT NULL DEFAULT 1,
  `eliminar_usuarios` int(1) NOT NULL DEFAULT 1,
  `crear_codigo_impuestos` int(1) NOT NULL DEFAULT 1,
  `modificar_codigo_impuestos` int(1) NOT NULL DEFAULT 1,
  `eliminar_codigo_impuestos` int(1) NOT NULL DEFAULT 1,
  `modificar_comprobantes` int(1) NOT NULL DEFAULT 1,
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `creado_por` varchar(100) NOT NULL DEFAULT 'System',
  `fecha_modificacion` date DEFAULT NULL,
  `modificado_por` varchar(100) DEFAULT NULL,
  `fecha_borrado` date DEFAULT NULL,
  `borrado_por` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `roles_y_permisos`
--

INSERT INTO `roles_y_permisos` (`id`, `rol`, `crear_articulos`, `modificar_articulos`, `eliminar_articulo`, `cargar_cantidades_a_inventario`, `retornar_articulos_en_movimiento`, `pasar_inventario`, `ver_articulos_en_movimiento`, `crear_almacenes`, `modificar_almacenes`, `eliminar_almacenes`, `crear_categorias`, `modificar_categorias`, `eliminar_categorias`, `ver_categorias`, `facturar`, `reporte`, `cuadre_caja`, `devoluciones`, `venta_en_espera`, `retomar_venta_en_espera`, `crear_clientes`, `modificar_clientes`, `eliminar_clientes`, `crear_roles`, `modificar_roles`, `eliminar_roles`, `crear_usuarios`, `modificar_usuarios`, `eliminar_usuarios`, `crear_codigo_impuestos`, `modificar_codigo_impuestos`, `eliminar_codigo_impuestos`, `modificar_comprobantes`, `fecha_creacion`, `creado_por`, `fecha_modificacion`, `modificado_por`, `fecha_borrado`, `borrado_por`) VALUES
(6, 'facturador', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, '2021-10-15 17:34:47', 'super_admin', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tipos_comprobantes`
--

CREATE TABLE `tipos_comprobantes` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `codigo` varchar(100) NOT NULL,
  `proximo` int(10) NOT NULL,
  `limite` int(10) NOT NULL,
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `creado_por` varchar(100) NOT NULL,
  `fecha_modificacion` date DEFAULT NULL,
  `modificado_por` varchar(100) DEFAULT NULL,
  `fecha_borrado` date DEFAULT NULL,
  `borrado_por` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tipos_comprobantes`
--

INSERT INTO `tipos_comprobantes` (`id`, `nombre`, `codigo`, `proximo`, `limite`, `fecha_creacion`, `creado_por`, `fecha_modificacion`, `modificado_por`, `fecha_borrado`, `borrado_por`) VALUES
(1, 'Consumidor final', 'B02', 5, 150, '2021-11-25 02:48:44', 'super_admin', NULL, NULL, NULL, NULL),
(2, 'Valor Fiscal', 'B01', 3, 220, '2021-11-25 02:49:20', 'super_admin', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `user` varchar(50) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `contrasena` varchar(50) NOT NULL,
  `rol` int(100) NOT NULL,
  `estado` int(1) NOT NULL DEFAULT 1,
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `creado_por` varchar(100) NOT NULL,
  `ultimo_acceso` varchar(100) DEFAULT NULL,
  `posicion_laboral` varchar(100) DEFAULT NULL,
  `fecha_modificacion` date DEFAULT NULL,
  `modificado_por` varchar(100) DEFAULT NULL,
  `fecha_borrado` date DEFAULT NULL,
  `borrado_por` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `usuarios`
--

INSERT INTO `usuarios` (`id`, `user`, `nombre`, `contrasena`, `rol`, `estado`, `fecha_creacion`, `creado_por`, `ultimo_acceso`, `posicion_laboral`, `fecha_modificacion`, `modificado_por`, `fecha_borrado`, `borrado_por`) VALUES
(1, 'super_admin', 'Super_admin', '1234', 0, 1, '2021-10-11 21:52:03', 'System', NULL, NULL, NULL, NULL, NULL, NULL),
(3, 'test', 'test', '1234', 6, 1, '2021-10-15 17:35:05', '', NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `venta_cabecera`
--

CREATE TABLE `venta_cabecera` (
  `id` int(11) NOT NULL,
  `codigo_detalles` varchar(100) NOT NULL,
  `cliente` int(7) NOT NULL,
  `forma_pago` varchar(100) NOT NULL,
  `condicion_pago` varchar(50) NOT NULL,
  `comprobante` varchar(50) NOT NULL,
  `neto` float NOT NULL,
  `itbis` float NOT NULL,
  `bruto` float NOT NULL,
  `descuentos` float DEFAULT NULL,
  `creado_por` varchar(50) NOT NULL,
  `status` varchar(10) NOT NULL DEFAULT 'Activo',
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `fecha_modificacion` date DEFAULT NULL,
  `modificado_por` varchar(100) DEFAULT NULL,
  `fecha_borrado` date DEFAULT NULL,
  `borrado_por` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `venta_cabecera`
--

INSERT INTO `venta_cabecera` (`id`, `codigo_detalles`, `cliente`, `forma_pago`, `condicion_pago`, `comprobante`, `neto`, `itbis`, `bruto`, `descuentos`, `creado_por`, `status`, `fecha_creacion`, `fecha_modificacion`, `modificado_por`, `fecha_borrado`, `borrado_por`) VALUES
(7, '1456767513421/11/25/03', 4, 'Tarjeta', 'Al contado', 'B0200000001', 1438.81, 228.11, 1210.7, 0, 'super_admin', 'Activo', '2021-11-25 02:26:54', NULL, NULL, NULL, NULL),
(8, '836153350821/11/25/03', 4, 'Tarjeta', 'Al contado', 'B0200000002', 813.62, 112.22, 701.4, 0, 'super_admin', 'Activo', '2021-11-25 02:27:13', NULL, NULL, NULL, NULL),
(9, '2890566719721/11/25/03', 4, 'Tarjeta', 'Al contado', 'B0200000003', 1438.81, 228.11, 1210.7, 0, 'super_admin', 'Activo', '2021-11-25 02:47:29', NULL, NULL, NULL, NULL),
(10, '947982879521/11/25/03', 4, 'Tarjeta', 'Al contado', 'B0200000003', 813.62, 112.22, 701.4, 0, 'super_admin', 'Activo', '2021-11-25 02:48:22', NULL, NULL, NULL, NULL),
(11, '2601879022121/11/25/03', 4, 'Tarjeta', 'Al contado', 'B0200000004', 1032, 172, 860, 0, 'super_admin', 'Activo', '2021-11-25 02:48:44', NULL, NULL, NULL, NULL),
(12, '1411552757721/11/25/03', 4, 'Tarjeta', 'Al contado', 'B0100000002', 838.81, 128.11, 710.7, 0, 'super_admin', 'Activo', '2021-11-25 02:49:20', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `venta_detalle`
--

CREATE TABLE `venta_detalle` (
  `id` int(11) NOT NULL,
  `codigo` varchar(100) NOT NULL,
  `id_articulo` int(8) NOT NULL,
  `articulo` varchar(100) DEFAULT NULL,
  `precio_sin_itbis` float NOT NULL,
  `precio_con_itbis` float NOT NULL,
  `itbis` float NOT NULL,
  `cantidad` int(10) NOT NULL,
  `total_itbis` float NOT NULL,
  `total_sin_itbis` float NOT NULL,
  `total_con_itbis` float NOT NULL,
  `status` varchar(50) NOT NULL,
  `creado_por` varchar(100) NOT NULL,
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `modificado_por` varchar(100) DEFAULT NULL,
  `fecha_modificacion` date DEFAULT NULL,
  `fecha_borrado` date DEFAULT NULL,
  `borrado_por` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `venta_detalle`
--

INSERT INTO `venta_detalle` (`id`, `codigo`, `id_articulo`, `articulo`, `precio_sin_itbis`, `precio_con_itbis`, `itbis`, `cantidad`, `total_itbis`, `total_sin_itbis`, `total_con_itbis`, `status`, `creado_por`, `fecha_creacion`, `modificado_por`, `fecha_modificacion`, `fecha_borrado`, `borrado_por`) VALUES
(196, '1456767513421/11/25/03', 8, 'Aspirina 300 bayer', 350.7, 406.81, 56.11, 1, 56.11, 350.7, 406.81, '', 'super_admin', '2021-11-25 02:26:49', NULL, NULL, NULL, NULL),
(197, '1456767513421/11/25/03', 9, 'coca cola cero', 360, 432, 72, 1, 72, 360, 432, '', 'super_admin', '2021-11-25 02:26:50', NULL, NULL, NULL, NULL),
(198, '1456767513421/11/25/03', 10, 'Diclofenal', 500, 600, 100, 1, 100, 500, 600, '', 'super_admin', '2021-11-25 02:26:51', NULL, NULL, NULL, NULL),
(199, '836153350821/11/25/03', 8, 'Aspirina 300 bayer', 350.7, 406.81, 56.11, 1, 56.11, 350.7, 406.81, '', 'super_admin', '2021-11-25 02:27:10', NULL, NULL, NULL, NULL),
(200, '836153350821/11/25/03', 8, 'Aspirina 300 bayer', 350.7, 406.81, 56.11, 1, 56.11, 350.7, 406.81, '', 'super_admin', '2021-11-25 02:27:10', NULL, NULL, NULL, NULL),
(201, '2890566719721/11/25/03', 8, 'Aspirina 300 bayer', 350.7, 406.81, 56.11, 1, 56.11, 350.7, 406.81, '', 'super_admin', '2021-11-25 02:45:26', NULL, NULL, NULL, NULL),
(202, '2890566719721/11/25/03', 9, 'coca cola cero', 360, 432, 72, 1, 72, 360, 432, '', 'super_admin', '2021-11-25 02:45:27', NULL, NULL, NULL, NULL),
(203, '2890566719721/11/25/03', 10, 'Diclofenal', 500, 600, 100, 1, 100, 500, 600, '', 'super_admin', '2021-11-25 02:45:29', NULL, NULL, NULL, NULL),
(204, '947982879521/11/25/03', 8, 'Aspirina 300 bayer', 350.7, 406.81, 56.11, 1, 56.11, 350.7, 406.81, '', 'super_admin', '2021-11-25 02:48:19', NULL, NULL, NULL, NULL),
(205, '947982879521/11/25/03', 8, 'Aspirina 300 bayer', 350.7, 406.81, 56.11, 1, 56.11, 350.7, 406.81, '', 'super_admin', '2021-11-25 02:48:20', NULL, NULL, NULL, NULL),
(206, '2601879022121/11/25/03', 9, 'coca cola cero', 360, 432, 72, 1, 72, 360, 432, '', 'super_admin', '2021-11-25 02:48:43', NULL, NULL, NULL, NULL),
(207, '2601879022121/11/25/03', 10, 'Diclofenal', 500, 600, 100, 1, 100, 500, 600, '', 'super_admin', '2021-11-25 02:48:43', NULL, NULL, NULL, NULL),
(208, '1411552757721/11/25/03', 8, 'Aspirina 300 bayer', 350.7, 406.81, 56.11, 1, 56.11, 350.7, 406.81, '', 'super_admin', '2021-11-25 02:49:14', NULL, NULL, NULL, NULL),
(209, '1411552757721/11/25/03', 9, 'coca cola cero', 360, 432, 72, 1, 72, 360, 432, '', 'super_admin', '2021-11-25 02:49:15', NULL, NULL, NULL, NULL),
(211, '4019674219821/11/25/03', 9, 'coca cola cero', 360, 432, 72, 1, 72, 360, 432, '', 'super_admin', '2021-11-25 02:53:52', NULL, NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `almacenes`
--
ALTER TABLE `almacenes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `articulos`
--
ALTER TABLE `articulos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `impuestos`
--
ALTER TABLE `impuestos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `impuestos_detalles`
--
ALTER TABLE `impuestos_detalles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pacientes`
--
ALTER TABLE `pacientes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles_y_permisos`
--
ALTER TABLE `roles_y_permisos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tipos_comprobantes`
--
ALTER TABLE `tipos_comprobantes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `venta_cabecera`
--
ALTER TABLE `venta_cabecera`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `venta_detalle`
--
ALTER TABLE `venta_detalle`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `almacenes`
--
ALTER TABLE `almacenes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `articulos`
--
ALTER TABLE `articulos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `impuestos`
--
ALTER TABLE `impuestos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `impuestos_detalles`
--
ALTER TABLE `impuestos_detalles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `pacientes`
--
ALTER TABLE `pacientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `roles_y_permisos`
--
ALTER TABLE `roles_y_permisos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tipos_comprobantes`
--
ALTER TABLE `tipos_comprobantes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `venta_cabecera`
--
ALTER TABLE `venta_cabecera`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `venta_detalle`
--
ALTER TABLE `venta_detalle`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=212;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
