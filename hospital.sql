-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 21, 2022 at 03:34 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.2

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
(1, 'Almacen central 3', 'Primer almacen', '', '2022-01-18 18:35:55', '2022-01-18', 'super_admin', NULL, NULL),
(3, '', '', '', '2022-01-18 18:40:22', NULL, NULL, '2022-01-18', 'super_admin');

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
(8, 'Aspirina 300 bayer cambiado', 'Ejemplo de un artículo 3', 376, 15, 366, 0, 1, 'Unidad', 'Caja', 'Inactivo', '1', 400, 600.88, 14, 'Laboratorio el proba', '2022-01-13 19:14:00', '', '0000-00-00', 'super_admin', NULL, NULL),
(9, 'coca cola cero', 'Coca cola sin azucar', 248, 20, 228, 1, 1, '', 'Unidad', 'Activo', '1', 300, 360, 15, 'Laboratorio el probado', '2022-01-28 20:49:16', '', NULL, NULL, NULL, NULL),
(10, 'Diclofenal', 'No se lo que es pero he escuchado el nombre', 228, 25, 203, 22, 1, '', 'Unidad', 'Activo', '1', 350, 500, 15, 'Laboratorio el probado', '2022-01-28 20:53:34', '', NULL, NULL, NULL, NULL),
(11, 'Ibuprofen', 'etesgs', 64, 4, 60, 5, 1, NULL, 'Unidad', 'Activo', '1', 352, 400, 15, 'Laboratorio el probado', '2022-01-13 13:37:00', '', NULL, NULL, NULL, NULL),
(12, 'Omeprazon 100ml', 'Para la diarrea', 299, 20, 279, 1, 1, NULL, 'Unidad', 'Activo', '1', 330, 330, 14, 'tu mai', '2021-12-08 13:36:36', '', NULL, NULL, NULL, NULL);

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
(1, 'Electricos ', '  Todos los electricos \r\n\r\n', 0, '', '2022-01-18', 'super_admin', NULL, NULL),
(2, 'Construccion', '  Esto no es un codigo de impuestos', 0, '', '2022-01-18', 'super_admin', '2022-01-18', 'super_admin');

-- --------------------------------------------------------

--
-- Table structure for table `cuadres`
--

CREATE TABLE `cuadres` (
  `id` int(11) NOT NULL,
  `usuario_inicio` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `usuario_cierre` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `encontrado` float NOT NULL,
  `sistema` float NOT NULL,
  `cierre` float DEFAULT NULL,
  `estado` varchar(10) COLLATE utf8_spanish_ci NOT NULL DEFAULT 'Abierto',
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp(),
  `modificacion_fecha` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `modificado_por` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `cuadres`
--

INSERT INTO `cuadres` (`id`, `usuario_inicio`, `usuario_cierre`, `encontrado`, `sistema`, `cierre`, `estado`, `fecha_creacion`, `modificacion_fecha`, `modificado_por`) VALUES
(1, 'super_admin', 'super_admin', 200, 1032, 411, 'Cerrado', '2022-01-28 18:00:00', '2022-01-28 20:50:05', NULL),
(2, 'super_admin', 'super_admin', 500, 1800, 611, 'Cerrado', '2022-01-28 20:51:40', '2022-03-21 01:07:47', NULL),
(3, 'super_admin', '', 0, 0, NULL, 'Abierto', '2022-03-21 01:15:34', '2022-03-21 01:15:34', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `devoluciones`
--

CREATE TABLE `devoluciones` (
  `id_devolucion` int(11) NOT NULL,
  `id_venta_cabecera` int(10) NOT NULL,
  `id_venta_detalle` int(10) NOT NULL,
  `cantidad` int(10) NOT NULL,
  `id_razon` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `creado_por` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `modificado_por` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `borrado_por` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp(),
  `fecha_modificacion` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `fecha_borrado` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

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
(15, '20 porciento selectivo al consumo', 'Compuesto', 20, 'super_admin', '2021-10-22 21:02:59', NULL, NULL, NULL, NULL),
(16, '30 de comunicaciones', 'Simple', 30, 'super_admin', '2021-12-06 23:40:30', NULL, NULL, NULL, NULL),
(17, 'escolares', 'Compuesto', 15, 'super_admin', '2021-12-06 23:41:31', NULL, NULL, NULL, NULL);

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
(10, 15, 2, '3% de la prueba'),
(11, 16, 30, '30 de comunicaciones'),
(12, 17, 10, 'libros'),
(13, 17, 5, 'lapiz');

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
-- Table structure for table `registro_pacientes`
--

CREATE TABLE `registro_pacientes` (
  `id` int(11) NOT NULL,
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `fecha_borrado` date DEFAULT NULL,
  `borrado_por` varchar(100) DEFAULT NULL,
  `nombres` varchar(100) DEFAULT NULL,
  `apellidos` varchar(100) DEFAULT NULL,
  `nacionalidad` varchar(100) DEFAULT NULL,
  `fecha_ingreso` date DEFAULT NULL,
  `hora_ingreso` time DEFAULT NULL,
  `genero` varchar(100) DEFAULT NULL,
  `peso` int(3) DEFAULT NULL,
  `altura` int(3) DEFAULT NULL,
  `lugar_nacimiento` varchar(100) DEFAULT NULL,
  `lugar_vive` varchar(100) DEFAULT NULL,
  `direccion` text DEFAULT NULL,
  `responsable` varchar(100) DEFAULT NULL,
  `relacion` varchar(100) DEFAULT NULL,
  `tipo_sangre` varchar(3) DEFAULT NULL,
  `alergias` text DEFAULT NULL,
  `origen_admision` varchar(100) DEFAULT NULL,
  `num_expediente` varchar(100) DEFAULT NULL,
  `nss` varchar(100) DEFAULT NULL,
  `seguro` varchar(11) DEFAULT NULL,
  `num_seguro` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `registro_pacientes`
--

INSERT INTO `registro_pacientes` (`id`, `fecha_creacion`, `fecha_borrado`, `borrado_por`, `nombres`, `apellidos`, `nacionalidad`, `fecha_ingreso`, `hora_ingreso`, `genero`, `peso`, `altura`, `lugar_nacimiento`, `lugar_vive`, `direccion`, `responsable`, `relacion`, `tipo_sangre`, `alergias`, `origen_admision`, `num_expediente`, `nss`, `seguro`, `num_seguro`) VALUES
(1, '2021-12-06 21:13:01', NULL, NULL, 'test', 'Maldonado', '16:32', '2021-12-16', '16:32:00', 'M', 520, 30, 'Santo Domingo', 'Santo DOmingo', 'Evaristo Morales, calle Luis f Thomen esquina Padre Emilio Tardif', 'fulana', 'hemano', 'A+', 'Ejemplo', 'Traslado', '4234243', '5165165', '51651651', '12311');

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
(6, 'facturador', 0, 1, 1, 0, 0, 0, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, '2021-12-09 21:33:13', 'super_admin', NULL, NULL, NULL, NULL),
(7, 'test', 0, 1, 0, 0, 0, 0, 1, 0, 1, 0, 0, 1, 0, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, '2021-12-09 18:59:47', 'super_admin', NULL, NULL, NULL, NULL),
(8, 'super_admin', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 0, 1, 1, 1, 1, 1, 0, 1, 1, 1, 1, 1, 1, '2021-12-12 17:11:29', 'System', NULL, NULL, NULL, NULL);

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
(1, 'Consumidor final', 'B02', 48, 150, '2022-01-28 20:53:38', 'super_admin', NULL, NULL, NULL, NULL),
(2, 'Valor Fiscal', 'B01', 4, 220, '2021-11-25 15:55:18', 'super_admin', NULL, NULL, NULL, NULL),
(3, 'Comprobante gubernamentales', 'B04', 50, 300, '2021-12-06 23:43:40', 'super_admin', NULL, NULL, NULL, NULL);

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
(1, 'super_admin', 'Super_admin', '1234', 8, 1, '2021-12-12 12:09:06', 'System', NULL, NULL, NULL, NULL, NULL, NULL),
(3, 'test', 'test', '1234', 6, 1, '2021-10-15 17:35:05', '', NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `venta_cabecera`
--

CREATE TABLE `venta_cabecera` (
  `id` int(11) NOT NULL,
  `numero_factura` varchar(50) NOT NULL,
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

INSERT INTO `venta_cabecera` (`id`, `numero_factura`, `codigo_detalles`, `cliente`, `forma_pago`, `condicion_pago`, `comprobante`, `neto`, `itbis`, `bruto`, `descuentos`, `creado_por`, `status`, `fecha_creacion`, `fecha_modificacion`, `modificado_por`, `fecha_borrado`, `borrado_por`) VALUES
(50, '124211', '4035841402321/12/04/10', 4, 'Efectivo', 'Al contado', 'B0200000041', 1438.81, 228.11, 1210.7, 0, 'super_admin', 'Activo', '2021-12-04 21:43:43', NULL, NULL, NULL, NULL),
(51, '1250000002151', '2979405011221/12/05/03', 4, 'Efectivo', 'Al contado', 'B0200000042', 814.8, 124.8, 690, 0, 'super_admin', 'Activo', '2021-12-05 02:04:11', NULL, NULL, NULL, NULL),
(52, '1270000002152', '363759575121/12/07/12', 4, 'Efectivo', 'Al contado', 'B0200000043', 813.62, 112.22, 701.4, 0, 'super_admin', 'Activo', '2021-12-06 23:37:10', NULL, NULL, NULL, NULL),
(53, '1280000002153', '1544537586521/12/08/03', 4, 'Efectivo', 'Al contado', 'B0200000044', 886.81, 136.11, 750.7, 0, 'super_admin', 'Activo', '2021-12-08 14:36:53', NULL, NULL, NULL, NULL),
(54, '12290000002154', '2343019720321/12/29/09', 4, 'Efectivo', 'Al contado', 'B0200000045', 852.84, 142.14, 710.7, 0, 'super_admin', 'Activo', '2021-12-29 20:31:37', NULL, NULL, NULL, NULL),
(55, '1280000002255', '2942870647222/01/28/09', 4, 'Efectivo', 'Al contado', 'B0200000046', 1032, 172, 860, 0, 'super_admin', 'Activo', '2022-01-28 20:49:24', NULL, NULL, NULL, NULL),
(56, '1280000002256', '1238394228422/01/28/09', 4, 'Efectivo', 'Al contado', 'B0200000047', 1800, 300, 1500, 0, 'super_admin', 'Activo', '2022-01-28 20:53:38', NULL, NULL, NULL, NULL);

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
(256, '3842742518321/12/04/07', 11, 'Ibuprofen', 400, 480, 80, 1, 80, 400, 480, '', 'super_admin', '2021-12-04 18:11:33', NULL, NULL, NULL, NULL),
(257, '3842742518321/12/04/07', 10, 'Diclofenal', 500, 600, 100, 1, 100, 500, 600, '', 'super_admin', '2021-12-04 18:11:34', NULL, NULL, NULL, NULL),
(258, '1634318416721/12/04/07', 8, 'Aspirina 300 bayer', 350.7, 406.81, 56.11, 1, 56.11, 350.7, 406.81, '', 'super_admin', '2021-12-04 18:19:25', NULL, NULL, NULL, NULL),
(259, '1634318416721/12/04/07', 9, 'coca cola cero', 360, 432, 72, 1, 72, 360, 432, '', 'super_admin', '2021-12-04 18:19:25', NULL, NULL, NULL, NULL),
(260, '4956001441621/12/04/08', 8, 'Aspirina 300 bayer', 350.7, 406.81, 56.11, 1, 56.11, 350.7, 406.81, '', 'super_admin', '2021-12-04 19:09:32', NULL, NULL, NULL, NULL),
(261, '3382455911321/12/04/08', 8, 'Aspirina 300 bayer', 350.7, 406.81, 56.11, 1, 56.11, 350.7, 406.81, '', 'super_admin', '2021-12-04 19:16:56', NULL, NULL, NULL, NULL),
(262, '1093827961321/12/04/08', 9, 'coca cola cero', 360, 432, 72, 1, 72, 360, 432, '', 'super_admin', '2021-12-04 19:17:02', NULL, NULL, NULL, NULL),
(263, '3039664403521/12/04/08', 9, 'coca cola cero', 360, 432, 72, 1, 72, 360, 432, '', 'super_admin', '2021-12-04 19:17:12', NULL, NULL, NULL, NULL),
(264, '3574677468221/12/04/08', 10, 'Diclofenal', 500, 600, 100, 1, 100, 500, 600, '', 'super_admin', '2021-12-04 19:17:17', NULL, NULL, NULL, NULL),
(265, '636166227721/12/04/08', 8, 'Aspirina 300 bayer', 350.7, 406.81, 56.11, 1, 56.11, 350.7, 406.81, '', 'super_admin', '2021-12-04 19:17:33', NULL, NULL, NULL, NULL),
(266, '5140391815321/12/04/08', 8, 'Aspirina 300 bayer', 350.7, 406.81, 56.11, 1, 56.11, 350.7, 406.81, '', 'super_admin', '2021-12-04 19:37:43', NULL, NULL, NULL, NULL),
(267, '5782633106321/12/04/08', 10, 'Diclofenal', 500, 600, 100, 1, 100, 500, 600, '', 'super_admin', '2021-12-04 19:37:54', NULL, NULL, NULL, NULL),
(268, '4035841402321/12/04/10', 10, 'Diclofenal', 500, 600, 100, 1, 100, 500, 600, '', 'super_admin', '2021-12-04 21:33:16', NULL, NULL, NULL, NULL),
(269, '<br />\r\n<b>Warning</b>:  Undefined variable $codigo in <b>C:xampphtdocsfacturacionviewspunto_de_fact', 8, 'Aspirina 300 bayer', 350.7, 406.81, 56.11, 1, 56.11, 350.7, 406.81, '', 'super_admin', '2021-12-04 21:37:29', NULL, NULL, NULL, NULL),
(270, '<br />\r\n<b>Warning</b>:  Undefined variable $codigo in <b>C:xampphtdocsfacturacionviewspunto_de_fact', 9, 'coca cola cero', 360, 432, 72, 1, 72, 360, 432, '', 'super_admin', '2021-12-04 21:37:51', NULL, NULL, NULL, NULL),
(271, '<br />\r\n<b>Warning</b>:  Undefined variable $codigo in <b>C:xampphtdocsfacturacionviewspunto_de_fact', 8, 'Aspirina 300 bayer', 350.7, 406.81, 56.11, 1, 56.11, 350.7, 406.81, '', 'super_admin', '2021-12-04 21:38:19', NULL, NULL, NULL, NULL),
(272, '<br />\r\n<b>Warning</b>:  Undefined variable $codigo in <b>C:xampphtdocsfacturacionviewspunto_de_fact', 8, 'Aspirina 300 bayer', 350.7, 406.81, 56.11, 1, 56.11, 350.7, 406.81, '', 'super_admin', '2021-12-04 21:40:36', NULL, NULL, NULL, NULL),
(273, '4035841402321/12/04/10', 8, 'Aspirina 300 bayer', 350.7, 406.81, 56.11, 1, 56.11, 350.7, 406.81, '', 'super_admin', '2021-12-04 21:43:34', NULL, NULL, NULL, NULL),
(274, '4035841402321/12/04/10', 9, 'coca cola cero', 360, 432, 72, 1, 72, 360, 432, '', 'super_admin', '2021-12-04 21:43:40', NULL, NULL, NULL, NULL),
(277, '2979405011221/12/05/03', 12, 'Omeprazon 100ml', 330, 382.8, 52.8, 1, 52.8, 330, 382.8, '', 'super_admin', '2021-12-05 02:04:02', NULL, NULL, NULL, NULL),
(278, '2979405011221/12/05/03', 9, 'coca cola cero', 360, 432, 72, 1, 72, 360, 432, '', 'super_admin', '2021-12-05 02:04:08', NULL, NULL, NULL, NULL),
(279, '363759575121/12/07/12', 8, 'Aspirina 300 bayer', 350.7, 406.81, 56.11, 1, 56.11, 350.7, 406.81, '', 'super_admin', '2021-12-06 23:36:44', NULL, NULL, NULL, NULL),
(280, '363759575121/12/07/12', 8, 'Aspirina 300 bayer', 350.7, 406.81, 56.11, 1, 56.11, 350.7, 406.81, '', 'super_admin', '2021-12-06 23:36:56', NULL, NULL, NULL, NULL),
(290, '1544537586521/12/08/03', 8, 'Aspirina 300 bayer', 350.7, 406.81, 56.11, 1, 56.11, 350.7, 406.81, '', 'super_admin', '2021-12-08 14:36:40', NULL, NULL, NULL, NULL),
(291, '1544537586521/12/08/03', 11, 'Ibuprofen', 400, 480, 80, 1, 80, 400, 480, '', 'super_admin', '2021-12-08 14:36:49', NULL, NULL, NULL, NULL),
(292, '3017149733521/12/22/02', 8, 'Aspirina 300 bayer', 350.7, 406.81, 56.11, 2, 112.22, 701.4, 813.62, '', 'super_admin', '2021-12-22 13:10:17', NULL, NULL, NULL, NULL),
(293, '2343019720321/12/29/09', 8, 'Aspirina 300 bayer 2', 350.7, 420.84, 70.14, 1, 70.14, 350.7, 420.84, '', 'super_admin', '2021-12-29 20:31:08', NULL, NULL, NULL, NULL),
(294, '2343019720321/12/29/09', 9, 'coca cola cero', 360, 432, 72, 1, 72, 360, 432, '', 'super_admin', '2021-12-29 20:31:12', NULL, NULL, NULL, NULL),
(298, '2942870647222/01/28/09', 9, 'coca cola cero', 360, 432, 72, 1, 72, 360, 432, '', 'super_admin', '2022-01-28 20:49:16', NULL, NULL, NULL, NULL),
(299, '2942870647222/01/28/09', 10, 'Diclofenal', 500, 600, 100, 1, 100, 500, 600, '', 'super_admin', '2022-01-28 20:49:21', NULL, NULL, NULL, NULL),
(300, '1238394228422/01/28/09', 10, 'Diclofenal', 500, 600, 100, 3, 300, 1500, 1800, '', 'super_admin', '2022-01-28 20:53:34', NULL, NULL, NULL, NULL);

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
-- Indexes for table `cuadres`
--
ALTER TABLE `cuadres`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `devoluciones`
--
ALTER TABLE `devoluciones`
  ADD PRIMARY KEY (`id_devolucion`);

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
-- Indexes for table `registro_pacientes`
--
ALTER TABLE `registro_pacientes`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `articulos`
--
ALTER TABLE `articulos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `cuadres`
--
ALTER TABLE `cuadres`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `devoluciones`
--
ALTER TABLE `devoluciones`
  MODIFY `id_devolucion` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `impuestos`
--
ALTER TABLE `impuestos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `impuestos_detalles`
--
ALTER TABLE `impuestos_detalles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `pacientes`
--
ALTER TABLE `pacientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `registro_pacientes`
--
ALTER TABLE `registro_pacientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `roles_y_permisos`
--
ALTER TABLE `roles_y_permisos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tipos_comprobantes`
--
ALTER TABLE `tipos_comprobantes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `venta_cabecera`
--
ALTER TABLE `venta_cabecera`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `venta_detalle`
--
ALTER TABLE `venta_detalle`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=301;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
