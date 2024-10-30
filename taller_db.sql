-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 30-10-2024 a las 20:18:10
-- Versión del servidor: 10.4.18-MariaDB
-- Versión de PHP: 7.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `taller_db`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `area`
--

CREATE TABLE `area` (
  `id` int(6) NOT NULL,
  `area` varchar(10) COLLATE utf8_bin NOT NULL,
  `descripcion` varchar(100) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `area`
--

INSERT INTO `area` (`id`, `area`, `descripcion`) VALUES
(3, 'Mecanica', 'Área donde se realiza distintos trabajos de mecánica, a todo tipo de movilidad.'),
(4, 'Chaperia', 'Área donde se realizan trabajos en la parte física de la movilidad, cuando existen abolladuras, rall'),
(5, 'Electrónic', 'Área donde se realiza la revisión y arreglo eléctrico de la movilidad. '),
(6, 'Lavado', 'Área donde se realiza la limpieza de la movilidad'),
(7, 'Administra', 'Área encargada en asuntos administrativos');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `automobil`
--

CREATE TABLE `automobil` (
  `id` int(6) NOT NULL,
  `cliente` int(6) NOT NULL,
  `marca` varchar(20) COLLATE utf8_bin NOT NULL,
  `modelo` varchar(20) COLLATE utf8_bin NOT NULL,
  `color` varchar(15) COLLATE utf8_bin NOT NULL,
  `anio` int(4) NOT NULL,
  `procedencia` varchar(25) COLLATE utf8_bin NOT NULL,
  `placa` varchar(10) COLLATE utf8_bin NOT NULL,
  `observaciones` text COLLATE utf8_bin DEFAULT NULL,
  `tipo` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `kms` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `bastidor` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `motor` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `fecha_compra` date DEFAULT NULL,
  `localizacion` varchar(300) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `automobil`
--

INSERT INTO `automobil` (`id`, `cliente`, `marca`, `modelo`, `color`, `anio`, `procedencia`, `placa`, `observaciones`, `tipo`, `kms`, `bastidor`, `motor`, `fecha_compra`, `localizacion`) VALUES
(1, 1, 'BMW', '850csi', '1', 1998, 'Alemania', '274NFK', '', NULL, NULL, NULL, NULL, NULL, NULL),
(2, 3, 'Toyota', '2012', 'Negro', 2012, 'Proc', '784-PRD', '', NULL, NULL, NULL, NULL, NULL, NULL),
(3, 3, 'Nisaan', 'MOD-123', 'Blanco', 2010, '', '4567-TFN', '', NULL, NULL, NULL, NULL, NULL, NULL),
(4, 1, 'BMW', 'SPACE', 'Blanco', 2011, '', '5124 NSQ', '', '', '', '', 'Gasolina', '2012-05-04', ''),
(5, 5, 'Nissan', 'Sentra', 'Rojo', 2022, '', '5222KLP', 'Parte delantera abollado, lugares implicados capot y parachoques ', 'automovil', '402356', '', '', '0000-00-00', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `id` int(6) NOT NULL,
  `nombres` varchar(50) COLLATE utf8_bin NOT NULL,
  `apellidos` varchar(50) COLLATE utf8_bin NOT NULL,
  `ci` int(10) NOT NULL,
  `telefono` int(10) NOT NULL,
  `direccion` varchar(50) COLLATE utf8_bin NOT NULL,
  `nom_comercial` varchar(300) COLLATE utf8_bin DEFAULT NULL,
  `nom_fiscal` varchar(300) COLLATE utf8_bin DEFAULT NULL,
  `cod_postal` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `poblacion` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `provincia` varchar(200) COLLATE utf8_bin DEFAULT NULL,
  `pais` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `email` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `web` varchar(50) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`id`, `nombres`, `apellidos`, `ci`, `telefono`, `direccion`, `nom_comercial`, `nom_fiscal`, `cod_postal`, `poblacion`, `provincia`, `pais`, `email`, `web`) VALUES
(5, 'Andres', 'Molina Quiroga', 8523561, 2304872, 'Av. Hernando Siles, Nro 50', '', '', '', 'La Paz', '', 'Bolivia', '', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compra_producto`
--

CREATE TABLE `compra_producto` (
  `id` int(5) NOT NULL,
  `total` int(6) DEFAULT NULL,
  `cantidad` int(5) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `hora` time DEFAULT NULL,
  `usuario` int(5) DEFAULT NULL,
  `proveedor` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `compra_producto`
--

INSERT INTO `compra_producto` (`id`, `total`, `cantidad`, `fecha`, `hora`, `usuario`, `proveedor`) VALUES
(1, NULL, NULL, '2018-03-06', '15:44:35', NULL, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compra_reg`
--

CREATE TABLE `compra_reg` (
  `id` int(5) NOT NULL,
  `idcompra` int(11) NOT NULL,
  `producto` int(5) NOT NULL,
  `total_compra` int(6) NOT NULL,
  `cantidad` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `compra_reg`
--

INSERT INTO `compra_reg` (`id`, `idcompra`, `producto`, `total_compra`, `cantidad`) VALUES
(1, 1, 1, 8, 2),
(2, 1, 2, 8, 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `encargado`
--

CREATE TABLE `encargado` (
  `id` int(6) NOT NULL,
  `trabajo` int(6) NOT NULL,
  `personal` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `encargado`
--

INSERT INTO `encargado` (`id`, `trabajo`, `personal`) VALUES
(1, 1, 2),
(2, 1, 3),
(3, 2, 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `insumo`
--

CREATE TABLE `insumo` (
  `id` int(6) NOT NULL,
  `nombre` varchar(200) COLLATE utf8_bin DEFAULT NULL,
  `tipo` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `familia` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `marca` varchar(20) COLLATE utf8_bin DEFAULT NULL,
  `descripcion_breve` varchar(200) COLLATE utf8_bin DEFAULT NULL,
  `description_extensa` text COLLATE utf8_bin DEFAULT NULL,
  `cod_ticket` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `procedencia` varchar(20) COLLATE utf8_bin DEFAULT NULL,
  `precio` float DEFAULT NULL,
  `unidades` int(5) DEFAULT NULL,
  `proveedor` varchar(20) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inventario`
--

CREATE TABLE `inventario` (
  `id` int(6) NOT NULL,
  `idauto` int(6) NOT NULL,
  `partes` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personal`
--

CREATE TABLE `personal` (
  `id` int(6) NOT NULL,
  `area` int(6) DEFAULT NULL,
  `nombres` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `apellidos` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `direccion` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `telefono` int(10) DEFAULT NULL,
  `ci` varchar(10) COLLATE utf8_bin DEFAULT NULL,
  `referencias` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `cod_postal` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `poblacion` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `provincia` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `pais` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `email` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `web` varchar(50) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `personal`
--

INSERT INTO `personal` (`id`, `area`, `nombres`, `apellidos`, `direccion`, `telefono`, `ci`, `referencias`, `cod_postal`, `poblacion`, `provincia`, `pais`, `email`, `web`) VALUES
(1, 0, 'Alejandra', 'Treviño', 'Av 16 de Julio #57 Piso 11', 60427847, '20954368', 'No cuenta con titulo profesional', NULL, NULL, NULL, NULL, NULL, NULL),
(4, 3, 'Martin', 'Segales Mamani', 'Av. Landaeta, Nro. 658', 2218547, '9857458', 'Mecánico experto en motores a gasolina, experiencia de 10 años', '', 'La Paz', 'Murillo', 'Bolivia', 'martin.segales@gmail.com', ''),
(5, 3, 'Eddy', 'Mamani Quispe', 'Calle 11, Irpavi', 2214856, '9687451', 'Mecánico experto en motores a Diesel y Gasolina, experto en movilidades de marca Nissan y Toyota, ex', '', 'La Paz', 'Murillo', 'Bolivia', 'eddy.mamani@gmail.com', ''),
(6, 4, 'Mario', 'Nina Quisbert', 'Av. America, Nro 100', 0, '8574123', 'Chapista, con experiencia de 15 años, en toyota', '', 'La Paz', 'Murillo', 'Bolivia', 'mario.nina@hotmail.com', ''),
(7, 4, 'Marco', 'Murillo Arequipa', 'Av. Republica Nro. 898', 0, '5248652', 'Chapista con experiencia de 12 años, trabajo en toyota', '', 'La Paz', 'Murillo', 'Bolivia', '', ''),
(8, 5, 'David', 'Gutierrez Apaza', 'Av. Siles, Nro 486', 0, '8974125', 'Electrico, con experiencia de 20 años', '', 'La Paz', 'Murillo', 'Bolivia', '', ''),
(9, 6, 'Javier', 'Apaza Mita', 'Calle 1, Irpavi', 0, '5896321', 'Experiencia de 5 años', '', 'La Paz', 'Murillo', 'Bolivia', '', ''),
(10, 7, 'Adrian', 'Mendoza', 'Av. Arequipa, nro 5', 2305685, '6096548', 'Encargado de taller', '', 'La Paz', 'Murillo', 'Bolivia', '', ''),
(11, 7, 'Jorge', 'Quispe', 'Av. Hernando Siles, nro 5896', 0, '5289451', 'Encargado de taller', '', 'La Paz', 'Murillo', 'Bolivia', '', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `id` int(6) NOT NULL,
  `nombre` varchar(200) COLLATE utf8_bin DEFAULT NULL,
  `cod_ticket` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `marca` varchar(20) COLLATE utf8_bin DEFAULT NULL,
  `tipo` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `familia` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `procedencia` varchar(20) COLLATE utf8_bin DEFAULT NULL,
  `precio` float DEFAULT NULL,
  `unidades` int(5) DEFAULT NULL,
  `foto_producto` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `descripcion_breve` varchar(300) COLLATE utf8_bin DEFAULT NULL,
  `descripcion_extensa` text COLLATE utf8_bin DEFAULT NULL,
  `tipo_vehiculo` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `marca_vehiculo` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `modelo_vehiculo` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `kms` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `motor_vehiculo` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `color_vehiculo` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `producto_insumo` tinyint(4) DEFAULT NULL COMMENT 'tipo: 1=producto, 2=insumo',
  `proveedor` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`id`, `nombre`, `cod_ticket`, `marca`, `tipo`, `familia`, `procedencia`, `precio`, `unidades`, `foto_producto`, `descripcion_breve`, `descripcion_extensa`, `tipo_vehiculo`, `marca_vehiculo`, `modelo_vehiculo`, `kms`, `motor_vehiculo`, `color_vehiculo`, `producto_insumo`, `proveedor`) VALUES
(4, 'Masilla plastica', '3', 'Carplast', 'Masa Rapida', 'Masilla', '', 48, 0, '20241030194538.jpg', 'Masilla plastica de recubrimiento', 'Utilización en movilidades', '', '', NULL, '', '', '', NULL, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedor`
--

CREATE TABLE `proveedor` (
  `id` int(6) NOT NULL,
  `nombre` varchar(50) COLLATE utf8_bin NOT NULL,
  `direccion` varchar(20) COLLATE utf8_bin NOT NULL,
  `telefono` int(13) NOT NULL,
  `descripcion` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `nom_comercial` varchar(300) COLLATE utf8_bin DEFAULT NULL,
  `nom_fiscal` varchar(300) COLLATE utf8_bin DEFAULT NULL,
  `cod_postal` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `poblacion` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `provincia` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `pais` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `email` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `web` varchar(50) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `proveedor`
--

INSERT INTO `proveedor` (`id`, `nombre`, `direccion`, `telefono`, `descripcion`, `nom_comercial`, `nom_fiscal`, `cod_postal`, `poblacion`, `provincia`, `pais`, `email`, `web`) VALUES
(5, 'Antonio Contreras', 'Av. Hernando Siles', 2304589, 'Proveedor de material de chaperia', 'Contreras', 'Contreras', '', 'La Paz', 'Murillo', 'Bolivia', 'antonio.contreras@gmail.com', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `trabajo`
--

CREATE TABLE `trabajo` (
  `id` int(6) NOT NULL,
  `idauto` int(6) NOT NULL,
  `detalle` varchar(200) COLLATE utf8_bin NOT NULL,
  `listo` tinyint(1) NOT NULL COMMENT '0=en proceso; 1=finalizado'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `trabajo`
--

INSERT INTO `trabajo` (`id`, `idauto`, `detalle`, `listo`) VALUES
(2, 5, 'Realizar el arreglo del capot y parachoque delantero', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id` int(6) NOT NULL,
  `usuario` varchar(25) COLLATE utf8_bin DEFAULT NULL,
  `contrasenia` varchar(65) COLLATE utf8_bin DEFAULT NULL,
  `privilegios` tinyint(1) DEFAULT NULL COMMENT '1=root; 2=admin; 3=encargado',
  `personal` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `usuario`, `contrasenia`, `privilegios`, `personal`) VALUES
(1, 'admin', '8c6976e5b5410415bde908bd4dee15dfb167a9c873fc4bb8a81f6f2ab448a918\n', 1, NULL),
(2, 'admin', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', 2, 2),
(5, 'uuuu', '2f6662f3d0028d2da73e6d8f5fb992b370e4652f41ab9d005483137c3f84137e', 2, 3),
(6, 'adrianm', 'da5e439373a3885f7335b193b1debbf0f6990b88ccf94e158c6e9e9bd77328bc', 2, 10),
(7, 'jorgeq', '143cc63b0219407bbaf501fdd5c2fda6f2b28ba7de0f7de7497feee71b0b459d', 3, 11);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `venta_producto`
--

CREATE TABLE `venta_producto` (
  `id` int(5) NOT NULL,
  `total` int(6) DEFAULT NULL,
  `cantidad` int(5) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `hora` time DEFAULT NULL,
  `usuario` int(5) DEFAULT NULL,
  `cliente` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `venta_producto`
--

INSERT INTO `venta_producto` (`id`, `total`, `cantidad`, `fecha`, `hora`, `usuario`, `cliente`) VALUES
(1, NULL, NULL, '2018-03-06', '15:45:46', NULL, 3),
(2, NULL, NULL, '2018-03-06', '15:46:04', NULL, 3),
(3, NULL, NULL, '2024-10-30', '14:54:15', NULL, 5),
(4, NULL, NULL, '2024-10-30', '15:03:01', NULL, 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `venta_reg`
--

CREATE TABLE `venta_reg` (
  `id` int(6) NOT NULL,
  `idventa` int(6) NOT NULL,
  `producto` int(6) NOT NULL,
  `costo` int(8) NOT NULL,
  `cantidad` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `venta_reg`
--

INSERT INTO `venta_reg` (`id`, `idventa`, `producto`, `costo`, `cantidad`) VALUES
(1, 1, 1, 45, 1),
(2, 2, 1, 45, 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `area`
--
ALTER TABLE `area`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `automobil`
--
ALTER TABLE `automobil`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `compra_producto`
--
ALTER TABLE `compra_producto`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `compra_reg`
--
ALTER TABLE `compra_reg`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `encargado`
--
ALTER TABLE `encargado`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `insumo`
--
ALTER TABLE `insumo`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `inventario`
--
ALTER TABLE `inventario`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `personal`
--
ALTER TABLE `personal`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `trabajo`
--
ALTER TABLE `trabajo`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `venta_producto`
--
ALTER TABLE `venta_producto`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `venta_reg`
--
ALTER TABLE `venta_reg`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `area`
--
ALTER TABLE `area`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `automobil`
--
ALTER TABLE `automobil`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `compra_producto`
--
ALTER TABLE `compra_producto`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `compra_reg`
--
ALTER TABLE `compra_reg`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `encargado`
--
ALTER TABLE `encargado`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `insumo`
--
ALTER TABLE `insumo`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `inventario`
--
ALTER TABLE `inventario`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `personal`
--
ALTER TABLE `personal`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `trabajo`
--
ALTER TABLE `trabajo`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `venta_producto`
--
ALTER TABLE `venta_producto`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `venta_reg`
--
ALTER TABLE `venta_reg`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
