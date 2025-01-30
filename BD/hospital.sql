-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 31-01-2025 a las 00:27:49
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
-- Base de datos: `hospital`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `administracion`
--

CREATE TABLE `administracion` (
  `idAdmin` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `SueldoAdmin` int(11) NOT NULL,
  `CorreoAdmin` varchar(50) NOT NULL,
  `TelAdmin` varchar(10) NOT NULL,
  `HorarioAdmin` time NOT NULL,
  `ContraseñaAdmin` varchar(30) NOT NULL,
  `NombreAdmin` varchar(50) NOT NULL,
  `CURPAdmin` varchar(18) NOT NULL,
  `DireccionAdmin` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `citas`
--

CREATE TABLE `citas` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `correo` varchar(100) NOT NULL,
  `telefono` varchar(15) DEFAULT NULL,
  `cita_dia` date NOT NULL,
  `cita_hora` time NOT NULL,
  `creada_por` timestamp NOT NULL DEFAULT current_timestamp(),
  `CURP` varchar(18) NOT NULL,
  `doctor` text NOT NULL,
  `Apellido_Paterno` text NOT NULL,
  `Apellido_Materno` text DEFAULT NULL,
  `especialidad` text NOT NULL,
  `estado_cita` timestamp(6) NULL DEFAULT NULL,
  `cancelada` tinyint(4) NOT NULL,
  `mensaje_cobro` text NOT NULL,
  `costo` int(20) NOT NULL,
  `consultorio` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `citas`
--

INSERT INTO `citas` (`id`, `nombre`, `correo`, `telefono`, `cita_dia`, `cita_hora`, `creada_por`, `CURP`, `doctor`, `Apellido_Paterno`, `Apellido_Materno`, `especialidad`, `estado_cita`, `cancelada`, `mensaje_cobro`, `costo`, `consultorio`) VALUES
(13, 'Ernesto', 'Ernes12@gmail.com', '5515402934', '2024-07-05', '10:00:00', '2024-07-03 16:23:40', 'EPSA000804MCHSSSA6', 'Ana Martinez', 'Prada', 'Sedillo', 'cardiologia', NULL, 1, 'Se aplicó una comisión del 15% ($0.00) por la cancelación.', 0, 0);

--
-- Disparadores `citas`
--
DELIMITER $$
CREATE TRIGGER `log_citas` AFTER UPDATE ON `citas` FOR EACH ROW insert into log(accion) values(concat('Se corrigio la cita'))
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `apellido_Materno` varchar(100) NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  `direccion` varchar(255) NOT NULL,
  `telefono` varchar(18) NOT NULL,
  `apellido_Paterno` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `consultorio`
--

CREATE TABLE `consultorio` (
  `idCon` int(11) NOT NULL,
  `idEspecialidad` int(11) NOT NULL,
  `ocupado` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_medicamentos`
--

CREATE TABLE `detalle_medicamentos` (
  `id_detalle_medi` int(11) NOT NULL,
  `nombre_generico` varchar(30) NOT NULL,
  `nombre_comercial` varchar(30) NOT NULL,
  `principio_activo` varchar(50) NOT NULL,
  `excipientes` varchar(30) NOT NULL,
  `tipo_farmaceutico` varchar(30) NOT NULL,
  `presentacion_medi` varchar(75) NOT NULL,
  `cantidad_por_dosis` int(10) NOT NULL,
  `indicaciones_uso` text NOT NULL,
  `via_de_administracion` text NOT NULL,
  `instrucciones_administracion` varchar(100) NOT NULL,
  `efecto_secundario` varchar(50) NOT NULL,
  `contraindicaciones` varchar(50) NOT NULL,
  `prec_especiales` varchar(50) NOT NULL,
  `interacciones_otros_medi` varchar(50) NOT NULL,
  `interacciones_comida` varchar(50) NOT NULL,
  `temperatura_almac` int(10) NOT NULL,
  `condiciones_luz_humedad` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_receta`
--

CREATE TABLE `detalle_receta` (
  `id_detalle_receta` int(11) NOT NULL,
  `nombre_medico` varchar(50) NOT NULL,
  `especialidad_medico` varchar(50) NOT NULL,
  `nombre_pac` varchar(50) NOT NULL,
  `edad_pac` int(10) NOT NULL,
  `sexo_pac` varchar(15) NOT NULL,
  `direccion_pac` varchar(100) NOT NULL,
  `NI_pac` int(20) NOT NULL,
  `fecha_de_emision` date NOT NULL,
  `nombre_medicamento` varchar(50) NOT NULL,
  `forma_farmaceutica` varchar(50) NOT NULL,
  `concentracion_medi` varchar(30) NOT NULL,
  `cantidad_total` int(10) NOT NULL,
  `dosis` int(10) NOT NULL,
  `frec_administracion` int(10) NOT NULL,
  `duracion_tratamiento` int(10) NOT NULL,
  `instrucciones_especificas` varchar(200) NOT NULL,
  `advertencias` varchar(100) NOT NULL,
  `precauciones` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `doctor`
--

CREATE TABLE `doctor` (
  `idDoc` int(11) NOT NULL,
  `idHorario` int(11) NOT NULL,
  `idCon` int(11) NOT NULL,
  `idEmp` int(11) NOT NULL,
  `idEspecialidad` int(11) NOT NULL,
  `SueldoDoc` int(11) NOT NULL,
  `NombreDoc` varchar(11) NOT NULL,
  `Apellido_Materno` varchar(11) DEFAULT NULL,
  `Apellido_Paterno` varchar(11) NOT NULL,
  `TelDoc` int(10) NOT NULL,
  `CURPDoc` varchar(18) NOT NULL,
  `DireccionDoc` varchar(50) NOT NULL,
  `CorreoDoc` varchar(50) NOT NULL,
  `CedulaDoc` varchar(18) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `doctor`
--

INSERT INTO `doctor` (`idDoc`, `idHorario`, `idCon`, `idEmp`, `idEspecialidad`, `SueldoDoc`, `NombreDoc`, `Apellido_Materno`, `Apellido_Paterno`, `TelDoc`, `CURPDoc`, `DireccionDoc`, `CorreoDoc`, `CedulaDoc`) VALUES
(15, 0, 0, 0, 0, 0, 'Juan', 'Perez', 'Marias', 2147483647, 'VEHB000408HMCRRRA8', 'Calle poniente 124', 'JPM@gmail.com', '123454');

--
-- Disparadores `doctor`
--
DELIMITER $$
CREATE TRIGGER `log_doctor` AFTER UPDATE ON `doctor` FOR EACH ROW insert into log(accion) values(concat('Se modifico el doctor'))
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleado`
--

CREATE TABLE `empleado` (
  `idEmp` int(50) NOT NULL,
  `idTipoEmp` int(50) NOT NULL,
  `Contraseña` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `especialidad`
--

CREATE TABLE `especialidad` (
  `idEspecialidad` int(11) NOT NULL,
  `NombreEspe` varchar(50) NOT NULL,
  `CostoEspe` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `especialidad`
--

INSERT INTO `especialidad` (`idEspecialidad`, `NombreEspe`, `CostoEspe`) VALUES
(1, 'Traumatologia', 50000),
(2, 'Ginecologia', 30000);

--
-- Disparadores `especialidad`
--
DELIMITER $$
CREATE TRIGGER `log_especialidad` AFTER UPDATE ON `especialidad` FOR EACH ROW insert into log(accion) values(concat('Se cambio la  especialidad'))
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `farmaceutico`
--

CREATE TABLE `farmaceutico` (
  `idFar` int(11) NOT NULL,
  `idEmp` int(11) NOT NULL,
  `SueldoFar` int(11) NOT NULL,
  `CorreoFar` varchar(30) NOT NULL,
  `NombreFar` varchar(50) NOT NULL,
  `CURPFar` varchar(10) NOT NULL,
  `TelFar` varchar(10) NOT NULL,
  `DireccionFar` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historial`
--

CREATE TABLE `historial` (
  `id` int(11) NOT NULL,
  `id_cita` int(11) NOT NULL,
  `descripcion` text NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `Alergias` text NOT NULL,
  `observaciones` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `historial`
--

INSERT INTO `historial` (`id`, `id_cita`, `descripcion`, `fecha`, `Alergias`, `observaciones`) VALUES
(1, 6, 'Acude por dolor de rodilla', '2024-06-29 01:57:23', 'Penicilina', 'sufre de presion baja'),
(5, 7, 'Realizar rinoplastia', '2024-06-29 02:12:06', 'Ninguna', 'sufre de presion baja'),
(6, 3, 'dolor de rodilla', '2024-07-01 22:28:36', 'ninguna', 'presion alta');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `horario`
--

CREATE TABLE `horario` (
  `idHorario` int(10) NOT NULL,
  `FechaInicio` datetime NOT NULL,
  `FechaFin` datetime NOT NULL,
  `Turno` varchar(15) NOT NULL,
  `Dias` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `hospital`
--

CREATE TABLE `hospital` (
  `id_hospital` int(50) NOT NULL,
  `nombre_hospital` varchar(50) NOT NULL,
  `direccion_hospital` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `hospital`
--

INSERT INTO `hospital` (`id_hospital`, `nombre_hospital`, `direccion_hospital`) VALUES
(1, 'Esperanza', 'Calle Juárez 456, Col. Roma, CDMX'),
(2, 'Esperanza', 'Av. Insurgentes 789, Col. Condesa, CDMX'),
(3, 'Esperanza', 'Calle Hidalgo 101, Col. Centro, Guadalajara'),
(4, 'Esperanza', 'Av. Vallarta 202, Col. Americana, Guadalajara'),
(5, 'Esperanza', 'Calle Morelos 303, Col. Chapultepec, Monterrey'),
(6, 'Esperanza', ' Av. Hidalgo 404, Col. San Pedro, Monterrey'),
(7, 'Esperanza', 'Av. Juárez 505, Col. Centro, Puebla'),
(8, 'Esperanza', 'Calle Reforma 606, Col. Chapultepec, Puebla'),
(9, 'Esperanza', 'Av. Universidad 707, Col. Del Valle, CDMX'),
(10, 'Esperanza', 'Calle Juárez 456, Col. Roma, CDMX');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `log`
--

CREATE TABLE `log` (
  `id` int(11) NOT NULL,
  `accion` varchar(255) NOT NULL,
  `fecha_hora` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `log`
--

INSERT INTO `log` (`id`, `accion`, `fecha_hora`) VALUES
(1, 'Se modifico el doctor', '0000-00-00 00:00:00'),
(2, 'Se cambio la  especialidad', '0000-00-00 00:00:00'),
(3, 'Se modifico el doctor', '0000-00-00 00:00:00'),
(4, 'Se corrigio la cita', '0000-00-00 00:00:00'),
(5, 'Se cambio la  especialidad', '0000-00-00 00:00:00'),
(6, 'Se corrigio la cita', '0000-00-00 00:00:00'),
(7, 'Se corrigio la cita', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `login`
--

CREATE TABLE `login` (
  `usuario` varchar(11) NOT NULL,
  `contraseña` varchar(20) NOT NULL,
  `tipo_usuario` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `login`
--

INSERT INTO `login` (`usuario`, `contraseña`, `tipo_usuario`) VALUES
('Danna', '1234', 0),
('Rafael', '5678', 1),
('John', '91011', 2),
('Jorge', '1213', 3),
('Johana', '2120', 3),
('Stiphen', '5463', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `login_paciente`
--

CREATE TABLE `login_paciente` (
  `id` int(11) NOT NULL,
  `usuario` varchar(20) NOT NULL,
  `contraseña` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `medicamentos`
--

CREATE TABLE `medicamentos` (
  `id_Medic` int(11) NOT NULL,
  `Nombre_Medic` varchar(50) NOT NULL,
  `Precio_Medic` int(10) NOT NULL,
  `Stock` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pacientes`
--

CREATE TABLE `pacientes` (
  `id_Pac` int(10) NOT NULL,
  `id_Usuario` int(10) NOT NULL,
  `Telefono` int(10) NOT NULL,
  `Nombre` varchar(20) NOT NULL,
  `Apellido_Materno` varchar(11) DEFAULT NULL,
  `Apellido_Paterno` varchar(11) NOT NULL,
  `contraseña` varchar(39) NOT NULL,
  `ConfirmaContraseña` varchar(39) NOT NULL,
  `Correo` varchar(50) NOT NULL,
  `Edad` int(20) NOT NULL,
  `Sexo` text NOT NULL,
  `usuario` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `pacientes`
--

INSERT INTO `pacientes` (`id_Pac`, `id_Usuario`, `Telefono`, `Nombre`, `Apellido_Materno`, `Apellido_Paterno`, `contraseña`, `ConfirmaContraseña`, `Correo`, `Edad`, `Sexo`, `usuario`) VALUES
(1, 0, 2147483647, 'BRYAN DAVID', 'VERUETE', 'HERNANDEZ', '', '', '', 0, '', ''),
(2, 0, 0, 'Eduardo', 'Pacheco', 'Losano', '5a99158e0c52f9e7d290906c9d08268d', '', 'edulp@gmail.com', 30, '0', ''),
(3, 0, 0, 'Arturo', 'Ayub', 'Elias', '4d186321c1a7f0f354b297e8914ab240', '', 'ArtueEli@gmail.com', 40, '0', ''),
(6, 0, 0, 'Pablo', 'Martinez', 'Escobar', 'b59c67bf196a4758191e42f76670ceba', '', 'pablo@gmail.com', 20, '0', 'Pablito'),
(7, 0, 0, 'Patricia', 'Solano', 'Rosas', 'b59c67bf196a4758191e42f76670ceba', '', 'Pati@gmail.com', 54, '0', 'Pati');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pago`
--

CREATE TABLE `pago` (
  `idPago` int(11) NOT NULL,
  `FechaPago` date NOT NULL,
  `EstadoPago` varchar(50) NOT NULL,
  `FormaPago` varchar(50) NOT NULL,
  `idTicket` int(11) NOT NULL,
  `idVenta` int(11) NOT NULL,
  `idServicio` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `precio` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `nombre`, `precio`) VALUES
(1, 'Paracetamol', 10.50),
(2, 'Paracetamol', 10.50),
(3, 'Paracetamol', 10.50),
(4, 'Paracetamol', 10.50);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `recepcionista`
--

CREATE TABLE `recepcionista` (
  `idRecep` int(11) NOT NULL,
  `idTipoEmp` int(11) NOT NULL,
  `idEmp` int(11) NOT NULL,
  `SueldoRecep` int(11) NOT NULL,
  `TelRecep` varchar(10) NOT NULL,
  `CorreoRecep` varchar(30) NOT NULL,
  `HorarioRecep` time NOT NULL,
  `DireccionRecep` varchar(50) NOT NULL,
  `CURPRecep` varchar(18) NOT NULL,
  `NombreRecep` varchar(50) NOT NULL,
  `ContraseñaRecep` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `receta`
--

CREATE TABLE `receta` (
  `idReceta` int(11) NOT NULL,
  `idCita` int(11) NOT NULL,
  `FechaEmision` date NOT NULL,
  `Medicamentos` varchar(50) NOT NULL,
  `UbicacionHospital` varchar(50) NOT NULL,
  `Instrucciones` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `registro`
--

CREATE TABLE `registro` (
  `idRegistro` int(11) NOT NULL,
  `idPac` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `idReceta` int(11) NOT NULL,
  `idCita` int(11) NOT NULL,
  `idDoc` int(11) NOT NULL,
  `Fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicio`
--

CREATE TABLE `servicio` (
  `idServicio` int(11) NOT NULL,
  `NombreServicio` varchar(50) NOT NULL,
  `HistorialServicio` datetime NOT NULL,
  `Disponibilidad` int(11) NOT NULL,
  `Especialidad` varchar(50) NOT NULL,
  `Costo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ticket`
--

CREATE TABLE `ticket` (
  `id` int(11) NOT NULL,
  `id_producto` int(50) NOT NULL,
  `MontoTicket` decimal(10,0) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `ticket`
--

INSERT INTO `ticket` (`id`, `id_producto`, `MontoTicket`, `fecha`) VALUES
(1, 1, 101, '2024-06-29 01:16:59');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipoempleado`
--

CREATE TABLE `tipoempleado` (
  `idTipoEmp` int(30) NOT NULL,
  `TipoEmp` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `idUsuario` int(50) NOT NULL,
  `idHospital` int(50) NOT NULL,
  `idTipoUsuario` int(50) NOT NULL,
  `NombreUsuario` varchar(30) NOT NULL,
  `Contraseña` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `administracion`
--
ALTER TABLE `administracion`
  ADD PRIMARY KEY (`idAdmin`),
  ADD KEY `idUsuario` (`idUsuario`);

--
-- Indices de la tabla `citas`
--
ALTER TABLE `citas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `consultorio`
--
ALTER TABLE `consultorio`
  ADD PRIMARY KEY (`idCon`),
  ADD KEY `idEspecialidad` (`idEspecialidad`);

--
-- Indices de la tabla `detalle_medicamentos`
--
ALTER TABLE `detalle_medicamentos`
  ADD PRIMARY KEY (`id_detalle_medi`);

--
-- Indices de la tabla `detalle_receta`
--
ALTER TABLE `detalle_receta`
  ADD PRIMARY KEY (`id_detalle_receta`);

--
-- Indices de la tabla `doctor`
--
ALTER TABLE `doctor`
  ADD PRIMARY KEY (`idDoc`),
  ADD KEY `idHorario` (`idHorario`),
  ADD KEY `idCon` (`idCon`),
  ADD KEY `idEmp` (`idEmp`),
  ADD KEY `idEspecialidad` (`idEspecialidad`);

--
-- Indices de la tabla `empleado`
--
ALTER TABLE `empleado`
  ADD PRIMARY KEY (`idEmp`),
  ADD KEY `idTipoEmp` (`idTipoEmp`);

--
-- Indices de la tabla `especialidad`
--
ALTER TABLE `especialidad`
  ADD PRIMARY KEY (`idEspecialidad`);

--
-- Indices de la tabla `farmaceutico`
--
ALTER TABLE `farmaceutico`
  ADD PRIMARY KEY (`idFar`),
  ADD KEY `idEmp` (`idEmp`);

--
-- Indices de la tabla `historial`
--
ALTER TABLE `historial`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idPac` (`id_cita`);

--
-- Indices de la tabla `horario`
--
ALTER TABLE `horario`
  ADD PRIMARY KEY (`idHorario`);

--
-- Indices de la tabla `hospital`
--
ALTER TABLE `hospital`
  ADD PRIMARY KEY (`id_hospital`);

--
-- Indices de la tabla `log`
--
ALTER TABLE `log`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `login_paciente`
--
ALTER TABLE `login_paciente`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `medicamentos`
--
ALTER TABLE `medicamentos`
  ADD PRIMARY KEY (`id_Medic`);

--
-- Indices de la tabla `pacientes`
--
ALTER TABLE `pacientes`
  ADD PRIMARY KEY (`id_Pac`),
  ADD KEY `id_Usuario` (`id_Usuario`);

--
-- Indices de la tabla `pago`
--
ALTER TABLE `pago`
  ADD PRIMARY KEY (`idPago`),
  ADD KEY `idTicket` (`idTicket`),
  ADD KEY `idVenta` (`idVenta`),
  ADD KEY `idServicio` (`idServicio`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `recepcionista`
--
ALTER TABLE `recepcionista`
  ADD PRIMARY KEY (`idRecep`),
  ADD KEY `idTipoEmp` (`idTipoEmp`),
  ADD KEY `idEmp` (`idEmp`);

--
-- Indices de la tabla `receta`
--
ALTER TABLE `receta`
  ADD PRIMARY KEY (`idReceta`),
  ADD KEY `idCita` (`idCita`);

--
-- Indices de la tabla `registro`
--
ALTER TABLE `registro`
  ADD PRIMARY KEY (`idRegistro`),
  ADD KEY `idPac` (`idPac`),
  ADD KEY `idUsuario` (`idUsuario`),
  ADD KEY `idReceta` (`idReceta`),
  ADD KEY `idCita` (`idCita`),
  ADD KEY `idDoc` (`idDoc`);

--
-- Indices de la tabla `servicio`
--
ALTER TABLE `servicio`
  ADD PRIMARY KEY (`idServicio`);

--
-- Indices de la tabla `ticket`
--
ALTER TABLE `ticket`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tipoempleado`
--
ALTER TABLE `tipoempleado`
  ADD PRIMARY KEY (`idTipoEmp`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`idUsuario`),
  ADD KEY `idHospital` (`idHospital`),
  ADD KEY `idTipoUsuario` (`idTipoUsuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `administracion`
--
ALTER TABLE `administracion`
  MODIFY `idAdmin` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `citas`
--
ALTER TABLE `citas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `consultorio`
--
ALTER TABLE `consultorio`
  MODIFY `idCon` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `detalle_medicamentos`
--
ALTER TABLE `detalle_medicamentos`
  MODIFY `id_detalle_medi` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `detalle_receta`
--
ALTER TABLE `detalle_receta`
  MODIFY `id_detalle_receta` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `doctor`
--
ALTER TABLE `doctor`
  MODIFY `idDoc` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `empleado`
--
ALTER TABLE `empleado`
  MODIFY `idEmp` int(50) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `especialidad`
--
ALTER TABLE `especialidad`
  MODIFY `idEspecialidad` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `farmaceutico`
--
ALTER TABLE `farmaceutico`
  MODIFY `idFar` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `historial`
--
ALTER TABLE `historial`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `horario`
--
ALTER TABLE `horario`
  MODIFY `idHorario` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `hospital`
--
ALTER TABLE `hospital`
  MODIFY `id_hospital` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `log`
--
ALTER TABLE `log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `login_paciente`
--
ALTER TABLE `login_paciente`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `medicamentos`
--
ALTER TABLE `medicamentos`
  MODIFY `id_Medic` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `pacientes`
--
ALTER TABLE `pacientes`
  MODIFY `id_Pac` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `pago`
--
ALTER TABLE `pago`
  MODIFY `idPago` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `recepcionista`
--
ALTER TABLE `recepcionista`
  MODIFY `idRecep` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `receta`
--
ALTER TABLE `receta`
  MODIFY `idReceta` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `registro`
--
ALTER TABLE `registro`
  MODIFY `idRegistro` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `servicio`
--
ALTER TABLE `servicio`
  MODIFY `idServicio` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `ticket`
--
ALTER TABLE `ticket`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `tipoempleado`
--
ALTER TABLE `tipoempleado`
  MODIFY `idTipoEmp` int(30) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idUsuario` int(50) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
