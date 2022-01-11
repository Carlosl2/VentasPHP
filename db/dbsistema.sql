-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 11-01-2022 a las 21:39:50
-- Versión del servidor: 10.4.17-MariaDB
-- Versión de PHP: 8.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `dbsistema`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `idcliente` int(11) NOT NULL,
  `NIT` varchar(15) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `apellido` varchar(100) NOT NULL,
  `direccion` varchar(100) NOT NULL,
  `correo` varchar(100) NOT NULL,
  `fkestado` int(11) NOT NULL,
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`idcliente`, `NIT`, `nombre`, `apellido`, `direccion`, `correo`, `fkestado`, `fecha_creacion`) VALUES
(1, '77300327', 'Jorge', 'Lopez', 'Guatemala Ciudad ', 'jlopez@gmail.com', 2, '2022-01-10 16:33:56'),
(2, '35231263', 'Luis', 'Perez', 'Guatemala Ciudad ', 'peter@gmail.com', 2, '2022-01-10 16:34:07'),
(3, '778899', 'Mantiz', 'Polar', 'Guatemala,Ciudad', 'mantiz@gmail.com', 2, '2022-01-10 17:34:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado`
--

CREATE TABLE `estado` (
  `idestado` int(11) NOT NULL,
  `nombre` varchar(75) NOT NULL,
  `descripcion` varchar(150) DEFAULT 'ND',
  `idpadre` int(11) NOT NULL,
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `estado`
--

INSERT INTO `estado` (`idestado`, `nombre`, `descripcion`, `idpadre`, `fecha_creacion`) VALUES
(1, 'CONTROL GENERAL DE ESTADOS', 'Esta tabla es utilizada para gestionar los estados utilizados de manera general en las diferentes tablas.', 0, '2020-09-13 04:10:27'),
(2, 'Activo', 'Utilizado para todas las opciones activas en el sistema ', 1, '2020-09-13 04:10:27'),
(3, 'Inactivo', 'Utilizado para deshabilitar registros  en las tablas', 1, '2020-09-13 04:12:41'),
(4, 'Eliminado ', 'Utilizados para eliminar registros de manera logica en las tablas.', 1, '2020-09-13 04:12:41'),
(5, 'CONTROL DE ESTADOS PARA TABLA USUARIO', 'Esta tabla es utilizada para controlar los estados de las personas, alumnos y usuarios', 0, '2020-10-31 08:32:42'),
(6, 'Presente', 'Estado presente para alumnos', 5, '2020-10-31 08:33:43'),
(7, 'Ausente', 'Estado ausente ', 5, '2020-10-31 08:33:43');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permiso`
--

CREATE TABLE `permiso` (
  `idpermiso` int(11) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `descripcion` varchar(150) DEFAULT NULL,
  `fkestado` int(11) NOT NULL,
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `permiso`
--

INSERT INTO `permiso` (`idpermiso`, `nombre`, `descripcion`, `fkestado`, `fecha_creacion`) VALUES
(1, 'Escritorio', 'asddd', 2, '2020-09-18 03:13:24'),
(2, 'Almacen', 'dsadasd', 4, '2020-09-18 03:13:24'),
(3, 'Compras', 'ddd', 4, '2020-09-18 03:13:24'),
(4, 'Ventas', '4asd5', 4, '2020-09-18 03:13:24'),
(5, 'Acceso', 'das45', 2, '2020-09-18 03:13:24'),
(6, 'Consulta Compras', 'ads4dd', 4, '2020-09-18 03:13:24'),
(7, 'Consulta Ventas', '23asd', 4, '2020-09-18 03:13:24'),
(8, 'Prueba', 'Respuesta', 4, '2020-09-18 03:45:18'),
(9, 'Prueba 2.', 'Prueba2.', 4, '2020-09-18 03:45:47'),
(10, 'usuario', 'Usuario', 2, '2020-10-24 09:00:34');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `idproducto` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `descripcion` varchar(100) NOT NULL,
  `presentacion` varchar(100) NOT NULL,
  `valor_unitario` decimal(8,2) NOT NULL,
  `cantidad_actual` int(11) NOT NULL,
  `fecha_hora` timestamp NOT NULL DEFAULT current_timestamp(),
  `fktipo_producto` int(11) NOT NULL,
  `fkestado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`idproducto`, `nombre`, `descripcion`, `presentacion`, `valor_unitario`, `cantidad_actual`, `fecha_hora`, `fktipo_producto`, `fkestado`) VALUES
(1, 'Coca-cola', 'Bebida carbonatada sabor a cola', 'Lata 375ML', '5.25', 200, '2022-01-11 15:39:04', 3, 2),
(2, 'Kellogs', 'Cereal Integral', 'Caja', '12.50', 200, '2022-01-11 20:13:34', 2, 2),
(3, 'Pan Sandwich Bimbo', 'Pan Sandwitch -  Normal', 'Paquete', '18.00', 20, '2022-01-11 20:17:17', 2, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_producto`
--

CREATE TABLE `tipo_producto` (
  `idtipo_producto` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `descripcion` varchar(100) NOT NULL,
  `fecha_hora` timestamp NOT NULL DEFAULT current_timestamp(),
  `fkestado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tipo_producto`
--

INSERT INTO `tipo_producto` (`idtipo_producto`, `nombre`, `descripcion`, `fecha_hora`, `fkestado`) VALUES
(1, 'Limpieza', 'Productos para la limpieza', '2022-01-10 19:43:14', 2),
(2, 'Cereal', 'Productos basados en semillas', '2022-01-10 19:43:30', 2),
(3, 'Bebida', 'Productos presentación liquida', '2022-01-10 19:43:48', 2),
(4, 'Lata', 'Productos enlatados', '2022-01-10 19:47:47', 2),
(5, 'Frutas', 'Productos tipo fruta', '2022-01-10 19:52:52', 2),
(6, 'Verdura', 'Productos de verduras', '2022-01-10 19:53:24', 2),
(7, 'Golosinas', 'Productos para botanas', '2022-01-10 19:54:21', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_usuario`
--

CREATE TABLE `tipo_usuario` (
  `idtipo_usuario` int(11) NOT NULL,
  `nombre` varchar(75) NOT NULL,
  `descripcion` varchar(150) NOT NULL,
  `fkestado` int(11) NOT NULL,
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tipo_usuario`
--

INSERT INTO `tipo_usuario` (`idtipo_usuario`, `nombre`, `descripcion`, `fkestado`, `fecha_creacion`) VALUES
(1, 'Administrador', 'Este perfil es para las personas que son administradoras del sistema', 2, '2020-09-18 04:39:05'),
(2, 'Tutor', 'Este usuario es utilizado para las persona colaboradoras en la institucion', 2, '2020-09-18 04:39:05'),
(3, 'Alumno', 'Utilizado para los usuarios de tipo alumno', 2, '2020-10-31 07:21:45');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `idusuario` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `tipo_documento` varchar(20) NOT NULL,
  `num_documento` varchar(20) NOT NULL,
  `direccion` varchar(70) DEFAULT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `cargo` int(50) DEFAULT NULL,
  `fecha_nacimiento` date DEFAULT NULL,
  `login` varchar(20) NOT NULL DEFAULT 'N/A',
  `clave` varchar(64) NOT NULL DEFAULT 'N/A',
  `imagen` varchar(50) NOT NULL,
  `condicion` tinyint(1) NOT NULL DEFAULT 1,
  `asistencia` int(11) NOT NULL DEFAULT 2,
  `fktipo_usuario` int(11) NOT NULL DEFAULT 3
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`idusuario`, `nombre`, `tipo_documento`, `num_documento`, `direccion`, `telefono`, `email`, `cargo`, `fecha_nacimiento`, `login`, `clave`, `imagen`, `condicion`, `asistencia`, `fktipo_usuario`) VALUES
(1, 'Carlos Alberto Morales Lopez', 'DPI', '2303046720609', 'Guatemala, Ciudad', '55953680', 'carlosmorales_lopez@hotmail.com', 0, '2020-10-08', 'admin', '8c6976e5b5410415bde908bd4dee15dfb167a9c873fc4bb8a81f6f2ab448a918', '1487132068.jpg', 1, 2, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario_permiso`
--

CREATE TABLE `usuario_permiso` (
  `idusuario_permiso` int(11) NOT NULL,
  `idusuario` int(11) NOT NULL,
  `idpermiso` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuario_permiso`
--

INSERT INTO `usuario_permiso` (`idusuario_permiso`, `idusuario`, `idpermiso`) VALUES
(96, 1, 1),
(97, 1, 2),
(98, 1, 3),
(99, 1, 4),
(100, 1, 5),
(101, 1, 6),
(102, 1, 7);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`idcliente`),
  ADD KEY `fkestado` (`fkestado`);

--
-- Indices de la tabla `estado`
--
ALTER TABLE `estado`
  ADD PRIMARY KEY (`idestado`);

--
-- Indices de la tabla `permiso`
--
ALTER TABLE `permiso`
  ADD PRIMARY KEY (`idpermiso`),
  ADD KEY `fkestado` (`fkestado`),
  ADD KEY `fkestado_2` (`fkestado`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`idproducto`),
  ADD KEY `fkestado` (`fkestado`),
  ADD KEY `fktipo_producto` (`fktipo_producto`);

--
-- Indices de la tabla `tipo_producto`
--
ALTER TABLE `tipo_producto`
  ADD PRIMARY KEY (`idtipo_producto`),
  ADD KEY `fkestado` (`fkestado`);

--
-- Indices de la tabla `tipo_usuario`
--
ALTER TABLE `tipo_usuario`
  ADD PRIMARY KEY (`idtipo_usuario`),
  ADD KEY `fkestado` (`fkestado`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`idusuario`),
  ADD UNIQUE KEY `login_UNIQUE` (`login`),
  ADD KEY `asistencia` (`asistencia`),
  ADD KEY `fktipo_usuario` (`fktipo_usuario`);

--
-- Indices de la tabla `usuario_permiso`
--
ALTER TABLE `usuario_permiso`
  ADD PRIMARY KEY (`idusuario_permiso`),
  ADD KEY `fk_usuario_permiso_permiso_idx` (`idpermiso`),
  ADD KEY `fk_usuario_permiso_usuario_idx` (`idusuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
  MODIFY `idcliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `estado`
--
ALTER TABLE `estado`
  MODIFY `idestado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `permiso`
--
ALTER TABLE `permiso`
  MODIFY `idpermiso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `idproducto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `tipo_producto`
--
ALTER TABLE `tipo_producto`
  MODIFY `idtipo_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `tipo_usuario`
--
ALTER TABLE `tipo_usuario`
  MODIFY `idtipo_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idusuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `usuario_permiso`
--
ALTER TABLE `usuario_permiso`
  MODIFY `idusuario_permiso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=125;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD CONSTRAINT `cliente_ibfk_1` FOREIGN KEY (`fkestado`) REFERENCES `estado` (`idestado`);

--
-- Filtros para la tabla `permiso`
--
ALTER TABLE `permiso`
  ADD CONSTRAINT `permiso_ibfk_1` FOREIGN KEY (`fkestado`) REFERENCES `estado` (`idestado`);

--
-- Filtros para la tabla `producto`
--
ALTER TABLE `producto`
  ADD CONSTRAINT `producto_ibfk_1` FOREIGN KEY (`fktipo_producto`) REFERENCES `tipo_producto` (`idtipo_producto`),
  ADD CONSTRAINT `producto_ibfk_2` FOREIGN KEY (`fkestado`) REFERENCES `estado` (`idestado`);

--
-- Filtros para la tabla `tipo_producto`
--
ALTER TABLE `tipo_producto`
  ADD CONSTRAINT `tipo_producto_ibfk_1` FOREIGN KEY (`fkestado`) REFERENCES `estado` (`idestado`);

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`asistencia`) REFERENCES `estado` (`idestado`),
  ADD CONSTRAINT `usuario_ibfk_2` FOREIGN KEY (`fktipo_usuario`) REFERENCES `tipo_usuario` (`idtipo_usuario`);

--
-- Filtros para la tabla `usuario_permiso`
--
ALTER TABLE `usuario_permiso`
  ADD CONSTRAINT `fk_usuario_permiso_permiso` FOREIGN KEY (`idpermiso`) REFERENCES `permiso` (`idpermiso`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_usuario_permiso_usuario` FOREIGN KEY (`idusuario`) REFERENCES `usuario` (`idusuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
