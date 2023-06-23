-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 17-06-2023 a las 02:45:32
-- Versión del servidor: 10.4.27-MariaDB
-- Versión de PHP: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `tp-programacion-web-2`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id` int(11) NOT NULL,
  `categoria` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id`, `categoria`) VALUES
(1, 'Deporte'),
(2, 'Geografía'),
(3, 'Música');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado_pregunta`
--

CREATE TABLE `estado_pregunta` (
  `id` int(11) NOT NULL,
  `estado` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `estado_pregunta`
--

INSERT INTO `estado_pregunta` (`id`, `estado`) VALUES
(1, 'activa'),
(2, 'suspendida'),
(3, 'reportada'),
(4, 'sugerida');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `partidas`
--

CREATE TABLE `partidas` (
  `id` int(11) NOT NULL,
  `puntaje` int(11) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `idUsuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `partidas`
--

INSERT INTO `partidas` (`id`, `puntaje`, `fecha`, `idUsuario`) VALUES
(314, 2, '2023-06-09 04:19:23', 6),
(315, 0, '2023-06-12 12:36:03', 6),
(316, 0, '2023-06-12 20:17:48', 4),
(317, 0, '2023-06-12 20:18:23', 4),
(318, 1, '2023-06-12 20:18:58', 4),
(319, 4, '2023-06-12 20:23:23', 5),
(320, 0, '2023-06-12 22:08:25', 6),
(321, 0, '2023-06-12 22:08:27', 6),
(322, 0, '2023-06-12 22:09:51', 6),
(323, 0, '2023-06-12 22:10:10', 6),
(324, 1, '2023-06-12 22:10:34', 6),
(325, 0, '2023-06-12 22:10:46', 6),
(326, 0, '2023-06-12 22:13:10', 6),
(327, 1, '2023-06-12 22:15:59', 6),
(328, 0, '2023-06-12 22:16:07', 6),
(329, 0, '2023-06-12 22:16:20', 6),
(330, 0, '2023-06-12 22:16:21', 6),
(331, 0, '2023-06-12 22:17:47', 6),
(332, 0, '2023-06-12 22:24:55', 6),
(333, 1, '2023-06-12 22:30:34', 6),
(334, 0, '2023-06-12 22:32:20', 6),
(335, 0, '2023-06-12 22:34:44', 6),
(336, 0, '2023-06-12 22:37:48', 6),
(337, 0, '2023-06-12 22:39:22', 6),
(338, 0, '2023-06-12 22:39:36', 6),
(339, 0, '2023-06-12 22:40:42', 6),
(340, 0, '2023-06-12 22:40:59', 6),
(341, 0, '2023-06-12 22:41:12', 6),
(342, 0, '2023-06-12 22:41:26', 6),
(343, 0, '2023-06-12 22:41:41', 6),
(344, 1, '2023-06-13 22:09:30', 6),
(345, 0, '2023-06-13 22:12:09', 6),
(346, 0, '2023-06-13 22:12:28', 6),
(347, 7, '2023-06-13 22:13:14', 6),
(348, 1, '2023-06-14 13:46:07', 6),
(349, 0, '2023-06-14 13:47:01', 6),
(350, 1, '2023-06-14 13:48:31', 6),
(351, 0, '2023-06-14 13:48:41', 6),
(352, 0, '2023-06-16 23:02:20', 4),
(353, 0, '2023-06-16 23:03:14', 4),
(354, 0, '2023-06-16 23:03:33', 4),
(355, 0, '2023-06-16 23:04:09', 4),
(356, 0, '2023-06-16 23:04:18', 4),
(357, 0, '2023-06-16 23:08:35', 4),
(358, 0, '2023-06-16 23:08:50', 4),
(359, 0, '2023-06-16 23:09:32', 4),
(360, 0, '2023-06-16 23:10:04', 4),
(361, 0, '2023-06-16 23:13:12', 4),
(362, 0, '2023-06-16 23:13:58', 4),
(363, 0, '2023-06-16 23:14:18', 4),
(364, 0, '2023-06-16 23:14:31', 4),
(365, 0, '2023-06-16 23:14:47', 4),
(366, 0, '2023-06-16 23:16:38', 4),
(367, 0, '2023-06-16 23:17:20', 4),
(368, 0, '2023-06-16 23:17:32', 4),
(369, 0, '2023-06-16 23:18:24', 4),
(370, 0, '2023-06-16 23:19:19', 4),
(371, 0, '2023-06-16 23:19:31', 4),
(372, 0, '2023-06-16 23:19:42', 4),
(373, 0, '2023-06-16 23:19:48', 4),
(374, 0, '2023-06-16 23:21:30', 4),
(375, 0, '2023-06-16 23:22:12', 4),
(376, 0, '2023-06-16 23:22:20', 4),
(377, 0, '2023-06-16 23:22:53', 4),
(378, 0, '2023-06-16 23:23:07', 4),
(379, 0, '2023-06-16 23:23:25', 4),
(380, 0, '2023-06-16 23:27:58', 4),
(381, 0, '2023-06-16 23:28:07', 4),
(382, 0, '2023-06-16 23:28:20', 4),
(383, 0, '2023-06-16 23:28:27', 4),
(384, 0, '2023-06-16 23:28:48', 4),
(385, 0, '2023-06-16 23:30:53', 4),
(386, 0, '2023-06-16 23:32:03', 4),
(387, 0, '2023-06-16 23:32:24', 4),
(388, 0, '2023-06-16 23:32:45', 4),
(389, 0, '2023-06-16 23:53:44', 4),
(390, 0, '2023-06-16 23:54:13', 4),
(391, 0, '2023-06-16 23:55:01', 4),
(392, 0, '2023-06-16 23:55:19', 4),
(393, 0, '2023-06-17 00:00:27', 4),
(394, 0, '2023-06-17 00:00:53', 4),
(395, 0, '2023-06-17 00:00:54', 4),
(396, 0, '2023-06-17 00:01:19', 4),
(397, 0, '2023-06-17 00:05:32', 4),
(398, 0, '2023-06-17 00:07:58', 4),
(399, 0, '2023-06-17 00:08:35', 4),
(400, 0, '2023-06-17 00:10:34', 4),
(401, 1, '2023-06-17 00:11:14', 4),
(402, 0, '2023-06-17 00:12:07', 4),
(403, 1, '2023-06-17 00:22:35', 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `partidas_preguntas`
--

CREATE TABLE `partidas_preguntas` (
  `id` int(11) NOT NULL,
  `id_partida` int(11) NOT NULL,
  `id_pregunta` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `partidas_preguntas`
--

INSERT INTO `partidas_preguntas` (`id`, `id_partida`, `id_pregunta`) VALUES
(1, 403, 173),
(2, 403, 184);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `preguntas`
--

CREATE TABLE `preguntas` (
  `id` int(11) NOT NULL,
  `pregunta` varchar(255) NOT NULL,
  `id_estado_pregunta` int(11) DEFAULT NULL,
  `id_categoria` int(11) DEFAULT NULL,
  `respuesta_a` varchar(255) DEFAULT NULL,
  `respuesta_b` varchar(255) DEFAULT NULL,
  `respuesta_c` varchar(255) DEFAULT NULL,
  `respuesta_d` varchar(255) DEFAULT NULL,
  `respuesta_correcta` varchar(255) DEFAULT NULL,
  `preguntas_totales` int(11) NOT NULL,
  `preguntas_correctas` int(11) NOT NULL,
  `porcentaje_acierto` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `preguntas`
--

INSERT INTO `preguntas` (`id`, `pregunta`, `id_estado_pregunta`, `id_categoria`, `respuesta_a`, `respuesta_b`, `respuesta_c`, `respuesta_d`, `respuesta_correcta`, `preguntas_totales`, `preguntas_correctas`, `porcentaje_acierto`) VALUES
(163, '¿Quién ganó la última Copa del Mundo de fútbol?', 1, 1, 'Francia', 'Brasil', 'Alemania', 'Argentina', 'Argentina', 0, 0, 0),
(165, '¿Quién ostenta el récord de más medallas de oro olímpicas?', 1, 1, 'Michael Phelps', 'Usain Bolt', 'Simone Biles', 'Serena Williams', 'Michael Phelps', 0, 0, 0),
(166, '¿Cuál es el deporte de invierno más popular?', 1, 1, 'Esquí alpino', 'Snowboard', 'Patinaje sobre hielo', 'Bobsleigh', 'Patinaje sobre hielo', 1, 0, 0),
(167, '¿Cuál es el nadador más laureado en la historia de los Juegos Olímpicos?', 1, 1, 'Michael Phelps', 'Ian Thorpe', 'Mark Spitz', 'Katie Ledecky', 'Michael Phelps', 11, 2, 18.1818),
(168, '¿En qué ciudad se celebraron los primeros Juegos Olímpicos modernos?', 1, 1, 'Atenas', 'Roma', 'París', 'Londres', 'Atenas', 0, 0, 0),
(169, '¿Cuál es el único país que ha ganado el Mundial de fútbol en cinco ocasiones?', 1, 1, 'Brasil', 'Alemania', 'Argentina', 'Italia', 'Brasil', 0, 0, 0),
(170, '¿Quién es considerado el mejor jugador de baloncesto de todos los tiempos?', 1, 1, 'Michael Jordan', 'LeBron James', 'Kobe Bryant', 'Magic Johnson', 'Michael Jordan', 0, 0, 0),
(171, '¿Cuál es el país más grande del mundo?', 3, 2, 'Rusia', 'Canadá', 'China', 'Estados Unidos', 'Rusia', 9, 1, 100),
(172, '¿Cuál es el río más largo del mundo?', 1, 2, 'Amazonas', 'Nilo', 'Yangtsé', 'Misisipi', 'Amazonas', 1, 0, 0),
(173, '¿Cuál es el océano más grande?', 3, 2, 'Océano Pacífico', 'Océano Atlántico', 'Océano Índico', 'Océano Ártico', 'Océano Pacífico', 14, 4, 28.5714),
(174, '¿En qué país se encuentra la Torre Eiffel?', 1, 2, 'Francia', 'Italia', 'España', 'Reino Unido', 'Francia', 8, 2, 25),
(175, '¿Cuál es el lago más profundo del mundo?', 1, 2, 'Lago Baikal', 'Lago Superior', 'Lago Victoria', 'Lago Titicaca', 'Lago Baikal', 1, 0, 0),
(176, '¿Cuál es el continente con mayor población?', 1, 2, 'Asia', 'África', 'Europa', 'América del Norte', 'Asia', 0, 0, 0),
(177, '¿Cuál es el desierto más grande del mundo?', 1, 2, 'Desierto del Sáhara', 'Desierto de Gobi', 'Desierto de Atacama', 'Desierto de Kalahari', 'Desierto del Sáhara', 0, 0, 0),
(179, '¿Cuál es el país más pequeño del mundo?', 1, 2, 'Ciudad del Vaticano', 'Mónaco', 'Nauru', 'Tuvalu', 'Ciudad del Vaticano', 0, 0, 0),
(180, '¿En qué continente se encuentra el Amazonas?', 1, 2, 'América del Sur', 'América del Norte', 'África', 'Europa', 'América del Sur', 0, 0, 0),
(181, '¿Quién es el cantante de la banda británica Queen?', 1, 3, 'Freddie Mercury', 'Brian May', 'Roger Taylor', 'John Deacon', 'Freddie Mercury', 0, 0, 0),
(182, '¿Cuál es el álbum más vendido de todos los tiempos?', 3, 3, 'Thriller', 'Back in Black', 'The Dark Side of the Moon', 'Abbey Road', 'Thriller', 8, 2, 25),
(183, '¿Qué instrumento musical tocaba el famoso compositor Ludwig van Beethoven?', 1, 3, 'Piano', 'Violín', 'Guitarra', 'Flauta', 'Piano', 0, 0, 0),
(184, '¿Cuál es el género musical originario de Jamaica?', 1, 3, 'Reggae', 'Salsa', 'Cumbia', 'Tango', 'Reggae', 7, 2, 33.3333),
(185, '¿Cuál es la banda de rock más exitosa de la historia?', 1, 3, 'The Beatles', 'Led Zeppelin', 'Pink Floyd', 'Queen', 'The Beatles', 0, 0, 0),
(186, '¿En qué década se popularizó el género musical conocido como disco?', 1, 3, '1970', '1980', '1960', '1990', '1970', 0, 0, 0),
(187, '¿Quién es el autor de la famosa canción \"Imagine\"?', 1, 3, 'John Lennon', 'Paul McCartney', 'George Harrison', 'Ringo Starr', 'John Lennon', 0, 0, 0),
(188, '¿Cuál es el instrumento principal en una orquesta sinfónica?', 1, 3, 'Violín', 'Piano', 'Flauta', 'Trompeta', 'Violín', 0, 0, 0),
(189, '¿Qué famoso guitarrista fue miembro de las bandas Guns N\' Roses y Velvet Revolver?', 1, 3, 'Slash', 'Jimmy Page', 'Jimi Hendrix', 'Eric Clapton', 'Slash', 0, 0, 0),
(190, '¿Cuál es el género musical principal en el carnaval de Brasil?', 1, 1, 'Samba', 'Merengue', 'Cumbia', 'Bachata', 'Samba', 15, 3, 21.4286);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `rol` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id`, `rol`) VALUES
(1, 'administrador'),
(2, 'editor'),
(3, 'jugador');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `apellido` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `contrasena` varchar(255) NOT NULL,
  `ano_nacimiento` smallint(6) NOT NULL,
  `sexo` varchar(10) NOT NULL,
  `pais_ciudad` varchar(255) NOT NULL,
  `nombre_usuario` varchar(255) NOT NULL,
  `foto_perfil` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `validado` int(1) NOT NULL DEFAULT 0,
  `preguntas_totales` int(11) NOT NULL,
  `preguntas_correctas` int(11) NOT NULL,
  `porcentaje_acierto` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `apellido`, `email`, `contrasena`, `ano_nacimiento`, `sexo`, `pais_ciudad`, `nombre_usuario`, `foto_perfil`, `token`, `validado`, `preguntas_totales`, `preguntas_correctas`, `porcentaje_acierto`) VALUES
(4, 'Gabriel', 'Enrriquez', 'gaenrriquez@gmail.com', '202cb962ac59075b964b07152d234b70', 2000, 'M', 'San Justo', 'admin', 'Cuando.jpg', '647cff2c13f9c', 1, 62, 8, 12.9032),
(5, 'pepe', 'argento', 'fasdsad@asfad.com', '202cb962ac59075b964b07152d234b70', 3423, 'm', 'Ituzaingó', 'admin2', 'user-photo.png', '647d589c749fe', 1, 5, 4, 80),
(6, 'Tomás', 'Ayerbe', 'tomayerbe@gmail.com', '202cb962ac59075b964b07152d234b70', 2002, 'M', 'Morón', 'tomas', 'user-photo.png', '647fea03c212b', 1, 65, 22, 33.8462);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios_roles`
--

CREATE TABLE `usuarios_roles` (
  `idUsuario` int(11) NOT NULL,
  `idRol` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios_roles`
--

INSERT INTO `usuarios_roles` (`idUsuario`, `idRol`) VALUES
(4, 2),
(4, 3),
(5, 3),
(6, 3);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `estado_pregunta`
--
ALTER TABLE `estado_pregunta`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `partidas`
--
ALTER TABLE `partidas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idUsuario` (`idUsuario`);

--
-- Indices de la tabla `partidas_preguntas`
--
ALTER TABLE `partidas_preguntas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_partida` (`id_partida`,`id_pregunta`);

--
-- Indices de la tabla `preguntas`
--
ALTER TABLE `preguntas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_estado_pregunta` (`id_estado_pregunta`,`id_categoria`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios_roles`
--
ALTER TABLE `usuarios_roles`
  ADD PRIMARY KEY (`idUsuario`,`idRol`) USING BTREE,
  ADD KEY `idRol` (`idRol`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `estado_pregunta`
--
ALTER TABLE `estado_pregunta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `partidas`
--
ALTER TABLE `partidas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=404;

--
-- AUTO_INCREMENT de la tabla `partidas_preguntas`
--
ALTER TABLE `partidas_preguntas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `preguntas`
--
ALTER TABLE `preguntas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=192;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `usuarios_roles`
--
ALTER TABLE `usuarios_roles`
  ADD CONSTRAINT `FK_idRol` FOREIGN KEY (`idRol`) REFERENCES `roles` (`id`),
  ADD CONSTRAINT `FK_idUsuario` FOREIGN KEY (`idUsuario`) REFERENCES `usuarios` (`id`),
  ADD CONSTRAINT `usuarios_roles_ibfk_1` FOREIGN KEY (`idRol`) REFERENCES `roles` (`id`),
  ADD CONSTRAINT `usuarios_roles_ibfk_2` FOREIGN KEY (`idUsuario`) REFERENCES `usuarios` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;


ALTER TABLE `preguntas` ADD `fecha_creacion` DATE NULL DEFAULT NULL AFTER `porcentaje_acierto`;

UPDATE `preguntas` SET ,`fecha_creacion`= CURRENT() ;