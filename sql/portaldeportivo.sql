-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 07-05-2025 a las 19:15:13
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
-- Base de datos: `portaldeportivo`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `equipos`
--

CREATE TABLE `equipos` (
  `idEquipo` int(11) NOT NULL,
  `categoria` varchar(50) NOT NULL,
  `idTemporada` int(11) DEFAULT NULL,
  `idPista` int(11) DEFAULT NULL,
  `deporte` enum('Fútbol','Baloncesto','Padel') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `equipos`
--

INSERT INTO `equipos` (`idEquipo`, `categoria`, `idTemporada`, `idPista`, `deporte`) VALUES
(1, 'Senior', NULL, 1, 'Fútbol'),
(2, 'Senior', NULL, 2, 'Baloncesto'),
(3, 'Senior', NULL, 3, 'Padel'),
(4, 'Infantil', NULL, 1, 'Fútbol'),
(5, 'Juvenil', NULL, 1, 'Fútbol'),
(6, 'Cadete', NULL, 2, 'Baloncesto'),
(7, 'Senior', NULL, 2, 'Baloncesto'),
(8, 'Mixto', NULL, 3, 'Padel'),
(9, 'Veteranos', NULL, 3, 'Padel');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estadisticasbaloncesto`
--

CREATE TABLE `estadisticasbaloncesto` (
  `idJugador` int(11) NOT NULL,
  `partidosJugados` int(11) DEFAULT 0,
  `partidosGanados` int(11) DEFAULT 0,
  `partidosPerdidos` int(11) DEFAULT 0,
  `partidosEmpatados` int(11) DEFAULT 0,
  `puntosAnotados` int(11) DEFAULT 0,
  `asistencias` int(11) DEFAULT 0,
  `porcentajeTres` decimal(5,2) DEFAULT 0.00,
  `porcentajeDos` decimal(5,2) DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `estadisticasbaloncesto`
--

INSERT INTO `estadisticasbaloncesto` (`idJugador`, `partidosJugados`, `partidosGanados`, `partidosPerdidos`, `partidosEmpatados`, `puntosAnotados`, `asistencias`, `porcentajeTres`, `porcentajeDos`) VALUES
(4, 20, 14, 5, 1, 320, 60, 38.50, 52.30),
(5, 18, 12, 5, 1, 295, 54, 40.20, 50.10),
(6, 19, 13, 5, 1, 310, 58, 36.80, 48.70),
(16, 16, 10, 5, 1, 220, 40, 30.20, 45.60),
(17, 15, 9, 5, 1, 210, 38, 28.90, 47.10),
(18, 17, 11, 5, 1, 240, 42, 32.50, 46.40),
(19, 18, 12, 5, 1, 255, 45, 33.10, 48.20),
(20, 16, 8, 7, 1, 198, 36, 27.40, 44.80),
(21, 19, 13, 5, 1, 270, 50, 34.60, 49.00);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estadisticasfutbol`
--

CREATE TABLE `estadisticasfutbol` (
  `idJugador` int(11) NOT NULL,
  `partidosJugados` int(11) DEFAULT 0,
  `partidosGanados` int(11) DEFAULT 0,
  `partidosPerdidos` int(11) DEFAULT 0,
  `partidosEmpatados` int(11) DEFAULT 0,
  `goles` int(11) DEFAULT 0,
  `asistencias` int(11) DEFAULT 0,
  `tarjetasAmarillas` int(11) DEFAULT 0,
  `tarjetasRojas` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `estadisticasfutbol`
--

INSERT INTO `estadisticasfutbol` (`idJugador`, `partidosJugados`, `partidosGanados`, `partidosPerdidos`, `partidosEmpatados`, `goles`, `asistencias`, `tarjetasAmarillas`, `tarjetasRojas`) VALUES
(1, 20, 12, 5, 3, 10, 5, 2, 0),
(2, 18, 10, 6, 2, 9, 4, 1, 1),
(3, 16, 9, 5, 2, 7, 3, 3, 0),
(10, 10, 4, 5, 1, 3, 2, 1, 0),
(11, 11, 6, 4, 1, 2, 2, 2, 1),
(12, 9, 5, 3, 1, 4, 1, 0, 0),
(13, 14, 8, 5, 1, 6, 3, 2, 0),
(14, 15, 9, 5, 1, 5, 4, 1, 0),
(15, 13, 7, 4, 2, 5, 2, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estadisticaspadel`
--

CREATE TABLE `estadisticaspadel` (
  `idJugador` int(11) NOT NULL,
  `partidosJugados` int(11) DEFAULT 0,
  `partidosGanados` int(11) DEFAULT 0,
  `partidosPerdidos` int(11) DEFAULT 0,
  `aces` int(11) DEFAULT 0,
  `puntosDrive` int(11) DEFAULT 0,
  `puntosReves` int(11) DEFAULT 0,
  `puntosRemate` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `estadisticaspadel`
--

INSERT INTO `estadisticaspadel` (`idJugador`, `partidosJugados`, `partidosGanados`, `partidosPerdidos`, `aces`, `puntosDrive`, `puntosReves`, `puntosRemate`) VALUES
(7, 10, 6, 4, 15, 120, 95, 40),
(8, 8, 5, 3, 10, 100, 80, 35),
(9, 12, 7, 5, 20, 130, 110, 45),
(22, 9, 4, 5, 9, 90, 70, 30),
(23, 11, 6, 5, 13, 115, 100, 38),
(24, 7, 3, 4, 7, 85, 60, 25),
(25, 10, 5, 5, 12, 105, 88, 33),
(26, 6, 2, 4, 5, 70, 50, 20),
(27, 13, 9, 4, 18, 140, 120, 50);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `horarios`
--

CREATE TABLE `horarios` (
  `idHorario` int(11) NOT NULL,
  `idEquipo` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `dia` varchar(20) DEFAULT NULL,
  `hora` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `horarios`
--

INSERT INTO `horarios` (`idHorario`, `idEquipo`, `idUsuario`, `dia`, `hora`) VALUES
(1, 3, 1, 'Lunes', '17:00:00'),
(2, 4, 1, 'Miércoles', '14:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `jugadores`
--

CREATE TABLE `jugadores` (
  `idJugador` int(11) NOT NULL,
  `nombreCompleto` varchar(100) NOT NULL,
  `fechaNacimiento` date NOT NULL,
  `dni` varchar(20) NOT NULL,
  `direccion` varchar(150) DEFAULT NULL,
  `localidad` varchar(100) DEFAULT NULL,
  `numeroLicencia` varchar(50) DEFAULT NULL,
  `idEquipo` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `jugadores`
--

INSERT INTO `jugadores` (`idJugador`, `nombreCompleto`, `fechaNacimiento`, `dni`, `direccion`, `localidad`, `numeroLicencia`, `idEquipo`) VALUES
(1, 'Carlos Pérez', '1990-04-15', '12345678A', 'Calle A, 1', 'Madrid', 'LIC001', 1),
(2, 'Luis Gómez', '1989-07-22', '12345679B', 'Calle A, 2', 'Madrid', 'LIC002', 1),
(3, 'Javier Díaz', '1992-11-30', '12345680C', 'Calle A, 3', 'Madrid', 'LIC003', 1),
(4, 'Andrés Romero', '1988-02-12', '22345678D', 'Calle B, 1', 'Sevilla', 'LIC004', 2),
(5, 'Mario Alonso', '1991-06-05', '22345679E', 'Calle B, 2', 'Sevilla', 'LIC005', 2),
(6, 'Pablo Torres', '1990-10-09', '22345680F', 'Calle B, 3', 'Sevilla', 'LIC006', 2),
(7, 'Ana Martín', '1993-08-18', '32345678G', 'Calle C, 1', 'Valencia', 'LIC007', 3),
(8, 'Lucía Vega', '1994-01-25', '32345679H', 'Calle C, 2', 'Valencia', 'LIC008', 3),
(9, 'Elena Ruiz', '1992-05-03', '32345680I', 'Calle C, 3', 'Valencia', 'LIC009', 3),
(10, 'Daniel Blanco', '2012-03-14', '42345678J', 'Calle D, 1', 'Madrid', 'LIC010', 4),
(11, 'Iván Mora', '2011-09-20', '42345679K', 'Calle D, 2', 'Madrid', 'LIC011', 4),
(12, 'Sergio López', '2012-07-07', '42345680L', 'Calle D, 3', 'Madrid', 'LIC012', 4),
(13, 'Adrián Navarro', '2008-04-09', '52345678M', 'Calle E, 1', 'Madrid', 'LIC013', 5),
(14, 'David Herrera', '2007-12-17', '52345679N', 'Calle E, 2', 'Madrid', 'LIC014', 5),
(15, 'Hugo Molina', '2008-10-29', '52345680O', 'Calle E, 3', 'Madrid', 'LIC015', 5),
(16, 'Erik Gil', '2006-06-01', '62345678P', 'Calle F, 1', 'Sevilla', 'LIC016', 6),
(17, 'Gabriel Ramos', '2006-03-11', '62345679Q', 'Calle F, 2', 'Sevilla', 'LIC017', 6),
(18, 'Samuel Ortega', '2005-11-22', '62345680R', 'Calle F, 3', 'Sevilla', 'LIC018', 6),
(19, 'Jorge Méndez', '1990-08-08', '72345678S', 'Calle G, 1', 'Sevilla', 'LIC019', 7),
(20, 'Fernando Ibáñez', '1989-05-19', '72345679T', 'Calle G, 2', 'Sevilla', 'LIC020', 7),
(21, 'Óscar Vidal', '1991-09-13', '72345680U', 'Calle G, 3', 'Sevilla', 'LIC021', 7),
(22, 'Clara Soto', '1995-03-23', '82345678V', 'Calle H, 1', 'Valencia', 'LIC022', 8),
(23, 'Sofía Herrera', '1996-12-10', '82345679W', 'Calle H, 2', 'Valencia', 'LIC023', 8),
(24, 'Alejandro Marín', '1994-06-27', '82345680X', 'Calle H, 3', 'Valencia', 'LIC024', 8),
(25, 'Tomás Aguilar', '1985-01-14', '92345678Y', 'Calle I, 1', 'Valencia', 'LIC025', 9),
(26, 'Rafael Núñez', '1983-07-30', '92345679Z', 'Calle I, 2', 'Valencia', 'LIC026', 9),
(27, 'Ignacio Cruz', '1982-11-08', '92345680A', 'Calle I, 3', 'Valencia', 'LIC027', 9);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pistas`
--

CREATE TABLE `pistas` (
  `idPista` int(11) NOT NULL,
  `nombrePista` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `pistas`
--

INSERT INTO `pistas` (`idPista`, `nombrePista`) VALUES
(1, 'Campo de Fútbol'),
(2, 'Campo de Baloncesto'),
(3, 'Campo de Padel');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reservas`
--

CREATE TABLE `reservas` (
  `idReserva` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `idPista` int(11) NOT NULL,
  `fechaReserva` date NOT NULL,
  `horaInicio` time NOT NULL,
  `horaFin` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `temporadas`
--

CREATE TABLE `temporadas` (
  `idTemporada` int(11) NOT NULL,
  `descripcion` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `idUsuario` int(11) NOT NULL,
  `nombreUsuario` varchar(50) NOT NULL,
  `contrasena` varchar(255) NOT NULL,
  `esAdministrador` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`idUsuario`, `nombreUsuario`, `contrasena`, `esAdministrador`) VALUES
(1, 'admin', '$2y$10$jYfrrpYk4.zELJOvNCVv1uvcgcqEyxwuh096L1gR3GKBlxY0p04Cq', 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `equipos`
--
ALTER TABLE `equipos`
  ADD PRIMARY KEY (`idEquipo`),
  ADD KEY `idTemporada` (`idTemporada`),
  ADD KEY `idPista` (`idPista`);

--
-- Indices de la tabla `estadisticasbaloncesto`
--
ALTER TABLE `estadisticasbaloncesto`
  ADD PRIMARY KEY (`idJugador`);

--
-- Indices de la tabla `estadisticasfutbol`
--
ALTER TABLE `estadisticasfutbol`
  ADD PRIMARY KEY (`idJugador`);

--
-- Indices de la tabla `estadisticaspadel`
--
ALTER TABLE `estadisticaspadel`
  ADD PRIMARY KEY (`idJugador`);

--
-- Indices de la tabla `horarios`
--
ALTER TABLE `horarios`
  ADD PRIMARY KEY (`idHorario`),
  ADD KEY `idEquipo` (`idEquipo`),
  ADD KEY `idUsuario` (`idUsuario`);

--
-- Indices de la tabla `jugadores`
--
ALTER TABLE `jugadores`
  ADD PRIMARY KEY (`idJugador`),
  ADD UNIQUE KEY `dni` (`dni`),
  ADD KEY `idEquipo` (`idEquipo`);

--
-- Indices de la tabla `pistas`
--
ALTER TABLE `pistas`
  ADD PRIMARY KEY (`idPista`);

--
-- Indices de la tabla `reservas`
--
ALTER TABLE `reservas`
  ADD PRIMARY KEY (`idReserva`),
  ADD KEY `idUsuario` (`idUsuario`),
  ADD KEY `idPista` (`idPista`);

--
-- Indices de la tabla `temporadas`
--
ALTER TABLE `temporadas`
  ADD PRIMARY KEY (`idTemporada`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`idUsuario`),
  ADD UNIQUE KEY `nombreUsuario` (`nombreUsuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `equipos`
--
ALTER TABLE `equipos`
  MODIFY `idEquipo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `horarios`
--
ALTER TABLE `horarios`
  MODIFY `idHorario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `jugadores`
--
ALTER TABLE `jugadores`
  MODIFY `idJugador` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT de la tabla `pistas`
--
ALTER TABLE `pistas`
  MODIFY `idPista` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `reservas`
--
ALTER TABLE `reservas`
  MODIFY `idReserva` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `temporadas`
--
ALTER TABLE `temporadas`
  MODIFY `idTemporada` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `idUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `equipos`
--
ALTER TABLE `equipos`
  ADD CONSTRAINT `equipos_ibfk_1` FOREIGN KEY (`idTemporada`) REFERENCES `temporadas` (`idTemporada`),
  ADD CONSTRAINT `equipos_ibfk_2` FOREIGN KEY (`idPista`) REFERENCES `pistas` (`idPista`);

--
-- Filtros para la tabla `estadisticasbaloncesto`
--
ALTER TABLE `estadisticasbaloncesto`
  ADD CONSTRAINT `estadisticasbaloncesto_ibfk_1` FOREIGN KEY (`idJugador`) REFERENCES `jugadores` (`idJugador`);

--
-- Filtros para la tabla `estadisticasfutbol`
--
ALTER TABLE `estadisticasfutbol`
  ADD CONSTRAINT `estadisticasfutbol_ibfk_1` FOREIGN KEY (`idJugador`) REFERENCES `jugadores` (`idJugador`);

--
-- Filtros para la tabla `estadisticaspadel`
--
ALTER TABLE `estadisticaspadel`
  ADD CONSTRAINT `estadisticaspadel_ibfk_1` FOREIGN KEY (`idJugador`) REFERENCES `jugadores` (`idJugador`);

--
-- Filtros para la tabla `horarios`
--
ALTER TABLE `horarios`
  ADD CONSTRAINT `horarios_ibfk_1` FOREIGN KEY (`idEquipo`) REFERENCES `equipos` (`idEquipo`),
  ADD CONSTRAINT `horarios_ibfk_2` FOREIGN KEY (`idUsuario`) REFERENCES `usuarios` (`idUsuario`);

--
-- Filtros para la tabla `jugadores`
--
ALTER TABLE `jugadores`
  ADD CONSTRAINT `jugadores_ibfk_1` FOREIGN KEY (`idEquipo`) REFERENCES `equipos` (`idEquipo`);

--
-- Filtros para la tabla `reservas`
--
ALTER TABLE `reservas`
  ADD CONSTRAINT `reservas_ibfk_1` FOREIGN KEY (`idUsuario`) REFERENCES `usuarios` (`idUsuario`),
  ADD CONSTRAINT `reservas_ibfk_2` FOREIGN KEY (`idPista`) REFERENCES `pistas` (`idPista`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
