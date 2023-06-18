-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 12-06-2023 a las 14:36:37
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
(2, 'suspendida');

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
(315, 0, '2023-06-12 12:36:03', 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `partidas_preguntas`
--

CREATE TABLE `partidas_preguntas` (
  `id_partida` int(11) NOT NULL,
  `id_pregunta` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `partidas_preguntas`
--

INSERT INTO `partidas_preguntas` (`id_partida`, `id_pregunta`) VALUES
(23, 166),
(24, 176),
(24, 168),
(25, 173),
(25, 166),
(26, 186),
(27, 189),
(28, 183),
(29, 176),
(30, 177),
(30, 187),
(30, 180),
(31, 183),
(31, 173),
(31, 187),
(31, 184),
(32, 171),
(32, 187),
(32, 169),
(32, 166),
(32, 186),
(32, 189),
(32, 174),
(32, 170),
(32, 163),
(32, 182),
(32, 175),
(32, 183),
(32, 172),
(33, 172),
(34, 186),
(34, 182),
(34, 179),
(34, 177),
(34, 171),
(35, 171),
(36, 186),
(36, 166),
(36, 190),
(36, 165),
(36, 188),
(36, 187),
(37, 180),
(37, 182),
(37, 189),
(38, 184),
(38, 173),
(38, 172),
(39, 167),
(39, 174),
(39, 184),
(40, 187),
(40, 175),
(41, 171),
(41, 185),
(41, 165),
(41, 170),
(41, 172),
(41, 184),
(41, 182),
(41, 177),
(41, 190),
(41, 183),
(41, 167),
(41, 179),
(41, 188),
(41, 176),
(41, 175),
(41, 181),
(41, 166),
(41, 163),
(42, 188),
(42, 176),
(42, 171),
(43, 173),
(43, 184),
(44, 175),
(44, 163),
(45, 187),
(46, 165),
(47, 176),
(47, 188),
(47, 179),
(47, 172),
(47, 186),
(47, 173),
(47, 168),
(47, 171),
(47, 187),
(47, 174),
(47, 165),
(48, 176),
(48, 168),
(48, 182),
(48, 169),
(48, 183),
(48, 167),
(48, 187),
(48, 181),
(48, 170),
(48, 173),
(48, 165),
(48, 172),
(49, 165),
(49, 175),
(49, 174),
(49, 188),
(49, 189),
(49, 186),
(49, 168),
(49, 171),
(49, 182),
(49, 184),
(49, 177),
(49, 179),
(49, 176),
(49, 187),
(49, 166),
(49, 183),
(49, 167),
(50, 172),
(50, 170),
(50, 187),
(51, 171),
(51, 189),
(51, 170),
(51, 166),
(51, 185),
(51, 163),
(51, 174),
(51, 173),
(51, 187),
(51, 169),
(51, 167),
(51, 182),
(51, 168),
(52, 169),
(52, 176),
(52, 184),
(52, 175),
(52, 171),
(52, 183),
(52, 170),
(52, 168),
(52, 173),
(52, 190),
(52, 181),
(52, 165),
(52, 180),
(52, 172),
(52, 187),
(55, 163),
(55, 165),
(55, 166),
(55, 167),
(55, 168),
(55, 169),
(55, 170),
(55, 171),
(56, 163),
(56, 165),
(56, 166),
(56, 167),
(56, 168),
(56, 169),
(56, 170),
(56, 171),
(56, 172),
(56, 173),
(56, 174),
(56, 175),
(56, 176),
(56, 177),
(56, 179),
(56, 180),
(56, 181),
(56, 182),
(56, 183),
(56, 184),
(56, 185),
(57, 163),
(58, 163),
(58, 165),
(58, 166),
(58, 167),
(58, 168),
(58, 169),
(58, 170),
(58, 171),
(58, 172),
(58, 173),
(59, 163),
(60, 163),
(60, 165),
(61, 163),
(62, 163),
(63, 163),
(63, 165),
(63, 166),
(63, 167),
(63, 168),
(63, 169),
(63, 170),
(63, 171),
(63, 172),
(63, 173),
(63, 174),
(63, 175),
(64, 168),
(64, 185),
(64, 175),
(65, 163),
(66, 163),
(66, 165),
(67, 163),
(68, 163),
(69, 163),
(69, 165),
(70, 184),
(70, 167),
(70, 173),
(70, 181),
(70, 185),
(70, 176),
(70, 170),
(70, 187),
(70, 183),
(70, 168),
(70, 182),
(70, 165),
(70, 190),
(72, 188),
(72, 169),
(73, 163),
(73, 184),
(73, 188),
(73, 182),
(73, 177),
(73, 167),
(73, 190),
(73, 168),
(73, 166),
(73, 189),
(73, 165),
(73, 170),
(73, 180),
(73, 171),
(73, 169),
(73, 176),
(73, 186),
(73, 179),
(73, 173),
(73, 174),
(73, 175),
(73, 185),
(73, 172),
(73, 183),
(73, 181),
(73, 187),
(74, 184),
(74, 185),
(74, 170),
(74, 186),
(74, 169),
(74, 182),
(74, 166),
(74, 189),
(74, 172),
(74, 167),
(74, 174),
(75, 163),
(75, 182),
(75, 176),
(75, 180),
(75, 183),
(75, 184),
(75, 173),
(75, 167),
(75, 179),
(75, 181),
(75, 169),
(75, 190),
(0, 166),
(76, 173),
(77, 174),
(77, 175),
(77, 176),
(77, 171),
(77, 170),
(77, 179),
(77, 180),
(77, 168),
(79, 171),
(79, 166),
(80, 171),
(81, 177),
(83, 185),
(84, 189),
(85, 179),
(85, 185),
(85, 170),
(86, 163),
(86, 170),
(87, 173),
(87, 182),
(88, 171),
(88, 176),
(89, 169),
(90, 186),
(90, 189),
(90, 166),
(90, 175),
(90, 176),
(91, 166),
(91, 168),
(91, 175),
(91, 189),
(92, 188),
(93, 174),
(93, 171),
(93, 163),
(94, 190),
(94, 189),
(98, 182),
(98, 172),
(99, 185),
(100, 174),
(101, 187),
(102, 185),
(103, 174),
(104, 184),
(105, 167),
(106, 169),
(106, 170),
(106, 167),
(106, 190),
(107, 167),
(108, 169),
(109, 176),
(110, 179),
(110, 182),
(110, 189),
(111, 183),
(112, 169),
(113, 174),
(114, 184),
(115, 190),
(116, 175),
(117, 175),
(118, 182),
(119, 173),
(120, 170),
(121, 182),
(122, 181),
(123, 176),
(124, 175),
(126, 181),
(128, 177),
(129, 171),
(130, 190),
(131, 173),
(132, 188),
(133, 184),
(134, 174),
(135, 181),
(136, 177),
(137, 188),
(138, 168),
(139, 169),
(140, 186),
(141, 186),
(142, 172),
(143, 180),
(144, 166),
(145, 174),
(146, 188),
(147, 163),
(148, 184),
(149, 170),
(150, 166),
(151, 168),
(152, 169),
(153, 189),
(154, 183),
(155, 176),
(156, 175),
(157, 176),
(158, 177),
(159, 165),
(160, 170),
(161, 180),
(162, 168),
(163, 189),
(164, 182),
(165, 165),
(166, 174),
(167, 180),
(168, 173),
(169, 183),
(170, 167),
(171, 173),
(172, 174),
(173, 165),
(174, 185),
(175, 176),
(176, 185),
(177, 179),
(178, 172),
(179, 189),
(180, 190),
(181, 173),
(182, 189),
(183, 182),
(184, 176),
(185, 184),
(186, 183),
(187, 186),
(188, 163),
(189, 166),
(190, 173),
(191, 166),
(192, 187),
(193, 172),
(194, 182),
(195, 165),
(196, 188),
(197, 173),
(198, 189),
(199, 176),
(199, 168),
(200, 169),
(200, 163),
(201, 167),
(201, 186),
(202, 190),
(202, 186),
(203, 168),
(203, 187),
(204, 170),
(204, 165),
(205, 183),
(205, 177),
(206, 177),
(206, 176),
(207, 169),
(207, 171),
(208, 166),
(209, 190),
(209, 165),
(210, 166),
(211, 186),
(211, 184),
(212, 163),
(212, 166),
(213, 187),
(214, 172),
(215, 180),
(216, 171),
(217, 169),
(217, 176),
(218, 185),
(218, 173),
(219, 169),
(219, 179),
(220, 182),
(220, 168),
(221, 186),
(221, 163),
(222, 188),
(222, 186),
(224, 180),
(224, 187),
(225, 190),
(225, 176),
(226, 188),
(226, 174),
(227, 182),
(227, 183),
(228, 168),
(228, 173),
(229, 179),
(229, 190),
(230, 187),
(230, 189),
(231, 182),
(232, 180),
(232, 188),
(233, 170),
(233, 184),
(234, 190),
(234, 169),
(235, 171),
(235, 163),
(236, 181),
(237, 182),
(237, 184),
(238, 185),
(238, 167),
(239, 165),
(239, 184),
(240, 185),
(240, 170),
(241, 176),
(241, 166),
(242, 182),
(242, 165),
(243, 173),
(243, 165),
(244, 173),
(244, 170),
(245, 185),
(245, 173),
(246, 171),
(246, 173),
(247, 168),
(247, 169),
(248, 176),
(248, 168),
(249, 172),
(249, 174),
(250, 172),
(250, 183),
(251, 168),
(251, 179),
(252, 185),
(252, 176),
(254, 183),
(254, 187),
(255, 167),
(255, 180),
(256, 169),
(256, 172),
(257, 180),
(257, 181),
(258, 188),
(258, 176),
(259, 169),
(259, 181),
(260, 169),
(260, 170),
(261, 190),
(262, 184),
(263, 185),
(264, 165),
(265, 186),
(266, 177),
(267, 170),
(267, 168),
(268, 171),
(268, 189),
(269, 183),
(270, 190),
(271, 175),
(272, 188),
(273, 186),
(274, 171),
(275, 190),
(276, 167),
(277, 169),
(278, 168),
(279, 188),
(280, 184),
(281, 186),
(281, 181),
(282, 171),
(282, 168),
(283, 169),
(284, 175),
(284, 171),
(285, 177),
(285, 180),
(285, 176),
(286, 190),
(287, 169),
(288, 163),
(289, 190),
(290, 170),
(291, 181),
(292, 188),
(294, 190),
(295, 167),
(296, 189),
(297, 179),
(297, 169),
(298, 171),
(298, 186),
(299, 176),
(299, 179),
(300, 171),
(300, 189),
(301, 180),
(301, 165),
(302, 183),
(302, 165),
(302, 185),
(302, 166),
(303, 186),
(304, 187),
(304, 190),
(305, 166),
(306, 184),
(306, 185),
(307, 190),
(308, 163),
(309, 187),
(310, 163),
(311, 190),
(312, 188),
(312, 185),
(313, 183),
(313, 174),
(314, 177),
(314, 169),
(314, 166),
(315, 181),
(315, 187),
(315, 177);

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
(166, '¿Cuál es el deporte de invierno más popular?', 1, 1, 'Esquí alpino', 'Snowboard', 'Patinaje sobre hielo', 'Bobsleigh', 'Patinaje sobre hielo', 0, 0, 0),
(167, '¿Cuál es el nadador más laureado en la historia de los Juegos Olímpicos?', 1, 1, 'Michael Phelps', 'Ian Thorpe', 'Mark Spitz', 'Katie Ledecky', 'Michael Phelps', 0, 0, 0),
(168, '¿En qué ciudad se celebraron los primeros Juegos Olímpicos modernos?', 1, 1, 'Atenas', 'Roma', 'París', 'Londres', 'Atenas', 0, 0, 0),
(169, '¿Cuál es el único país que ha ganado el Mundial de fútbol en cinco ocasiones?', 1, 1, 'Brasil', 'Alemania', 'Argentina', 'Italia', 'Brasil', 0, 0, 0),
(170, '¿Quién es considerado el mejor jugador de baloncesto de todos los tiempos?', 1, 1, 'Michael Jordan', 'LeBron James', 'Kobe Bryant', 'Magic Johnson', 'Michael Jordan', 0, 0, 0),
(171, '¿Cuál es el país más grande del mundo?', 1, 2, 'Rusia', 'Canadá', 'China', 'Estados Unidos', 'Rusia', 0, 0, 0),
(172, '¿Cuál es el río más largo del mundo?', 1, 2, 'Amazonas', 'Nilo', 'Yangtsé', 'Misisipi', 'Amazonas', 0, 0, 0),
(173, '¿Cuál es el océano más grande?', 1, 2, 'Océano Pacífico', 'Océano Atlántico', 'Océano Índico', 'Océano Ártico', 'Océano Pacífico', 0, 0, 0),
(174, '¿En qué país se encuentra la Torre Eiffel?', 1, 2, 'Francia', 'Italia', 'España', 'Reino Unido', 'Francia', 0, 0, 0),
(175, '¿Cuál es el lago más profundo del mundo?', 1, 2, 'Lago Baikal', 'Lago Superior', 'Lago Victoria', 'Lago Titicaca', 'Lago Baikal', 0, 0, 0),
(176, '¿Cuál es el continente con mayor población?', 1, 2, 'Asia', 'África', 'Europa', 'América del Norte', 'Asia', 0, 0, 0),
(177, '¿Cuál es el desierto más grande del mundo?', 1, 2, 'Desierto del Sáhara', 'Desierto de Gobi', 'Desierto de Atacama', 'Desierto de Kalahari', 'Desierto del Sáhara', 1, 0, 0),
(179, '¿Cuál es el país más pequeño del mundo?', 1, 2, 'Ciudad del Vaticano', 'Mónaco', 'Nauru', 'Tuvalu', 'Ciudad del Vaticano', 0, 0, 0),
(180, '¿En qué continente se encuentra el Amazonas?', 1, 2, 'América del Sur', 'América del Norte', 'África', 'Europa', 'América del Sur', 0, 0, 0),
(181, '¿Quién es el cantante de la banda británica Queen?', 1, 3, 'Freddie Mercury', 'Brian May', 'Roger Taylor', 'John Deacon', 'Freddie Mercury', 1, 1, 100),
(182, '¿Cuál es el álbum más vendido de todos los tiempos?', 1, 3, 'Thriller', 'Back in Black', 'The Dark Side of the Moon', 'Abbey Road', 'Thriller', 0, 0, 0),
(183, '¿Qué instrumento musical tocaba el famoso compositor Ludwig van Beethoven?', 1, 3, 'Piano', 'Violín', 'Guitarra', 'Flauta', 'Piano', 0, 0, 0),
(184, '¿Cuál es el género musical originario de Jamaica?', 1, 3, 'Reggae', 'Salsa', 'Cumbia', 'Tango', 'Reggae', 0, 0, 0),
(185, '¿Cuál es la banda de rock más exitosa de la historia?', 1, 3, 'The Beatles', 'Led Zeppelin', 'Pink Floyd', 'Queen', 'The Beatles', 0, 0, 0),
(186, '¿En qué década se popularizó el género musical conocido como disco?', 1, 3, '1970', '1980', '1960', '1990', '1970', 0, 0, 0),
(187, '¿Quién es el autor de la famosa canción \"Imagine\"?', 1, 3, 'John Lennon', 'Paul McCartney', 'George Harrison', 'Ringo Starr', 'John Lennon', 1, 1, 100),
(188, '¿Cuál es el instrumento principal en una orquesta sinfónica?', 1, 3, 'Violín', 'Piano', 'Flauta', 'Trompeta', 'Violín', 0, 0, 0),
(189, '¿Qué famoso guitarrista fue miembro de las bandas Guns N\' Roses y Velvet Revolver?', 1, 3, 'Slash', 'Jimmy Page', 'Jimi Hendrix', 'Eric Clapton', 'Slash', 0, 0, 0),
(190, '¿Cuál es el género musical principal en el carnaval de Brasil?', 1, 3, 'Samba', 'Merengue', 'Cumbia', 'Bachata', 'Samba', 0, 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `respuestas`
--

CREATE TABLE `respuestas` (
  `id` int(11) NOT NULL,
  `respuesta` varchar(255) NOT NULL,
  `respuesta_correcta` tinyint(1) NOT NULL,
  `id_pregunta` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `respuestas`
--

INSERT INTO `respuestas` (`id`, `respuesta`, `respuesta_correcta`, `id_pregunta`) VALUES
(5, 'Francia', 0, 163),
(6, 'Brasil', 0, 163),
(7, 'Alemania', 0, 163),
(8, 'Argentina', 1, 163),
(9, 'Michael Phelps', 1, 165),
(10, 'Usain Bolt', 0, 165),
(11, 'Simone Biles', 0, 165),
(12, 'Serena Williams', 0, 165),
(13, 'Esquí alpino', 0, 166),
(14, 'Snowboard', 0, 166),
(15, 'Patinaje sobre hielo', 1, 166),
(16, 'Bobsleigh', 0, 166),
(17, 'Michael Phelps', 1, 167),
(18, 'Ian Thorpe', 0, 167),
(19, 'Mark Spitz', 0, 167),
(20, 'Katie Ledecky', 0, 167),
(21, 'Atenas', 1, 168),
(22, 'Roma', 0, 168),
(23, 'París', 0, 168),
(24, 'Londres', 0, 168),
(25, 'Brasil', 1, 169),
(26, 'Alemania', 0, 169),
(27, 'Argentina', 0, 169),
(28, 'Italia', 0, 169),
(29, 'Michael Jordan', 1, 170),
(30, 'LeBron James', 0, 170),
(31, 'Kobe Bryant', 0, 170),
(32, 'Magic Johnson', 0, 170),
(33, 'Rusia', 1, 171),
(34, 'Canadá', 0, 171),
(35, 'China', 0, 171),
(36, 'Estados Unidos', 0, 171),
(37, 'Amazonas', 1, 172),
(38, 'Nilo', 0, 172),
(39, 'Yangtsé', 0, 172),
(40, 'Misisipi', 0, 172),
(41, 'Océano Pacífico', 1, 173),
(42, 'Océano Atlántico', 0, 173),
(43, 'Océano Índico', 0, 173),
(44, 'Océano Ártico', 0, 173),
(45, 'Francia', 1, 174),
(46, 'Italia', 0, 174),
(47, 'España', 0, 174),
(48, 'Reino Unido', 0, 174),
(49, 'Lago Baikal', 1, 175),
(50, 'Lago Superior', 0, 175),
(51, 'Lago Victoria', 0, 175),
(52, 'Lago Titicaca', 0, 175),
(53, 'Asia', 1, 176),
(54, 'África', 0, 176),
(55, 'Europa', 0, 176),
(56, 'América del Norte', 0, 176),
(57, 'Desierto del Sáhara', 1, 177),
(58, 'Desierto de Gobi', 0, 177),
(59, 'Desierto de Atacama', 0, 177),
(60, 'Desierto de Kalahari', 0, 177),
(61, 'Ciudad del Vaticano', 1, 179),
(62, 'Mónaco', 0, 179),
(63, 'Nauru', 0, 179),
(64, 'Tuvalu', 0, 179),
(65, 'América del Sur', 1, 180),
(66, 'América del Norte', 0, 180),
(67, 'África', 0, 180),
(68, 'Europa', 0, 180),
(69, 'Freddie Mercury', 1, 181),
(70, 'Brian May', 0, 181),
(71, 'Roger Taylor', 0, 181),
(72, 'John Deacon', 0, 181),
(73, 'Thriller', 1, 182),
(74, 'Back in Black', 0, 182),
(75, 'The Dark Side of the Moon', 0, 182),
(76, 'Abbey Road', 0, 182),
(77, 'Piano', 1, 183),
(78, 'Violín', 0, 183),
(79, 'Guitarra', 0, 183),
(80, 'Flauta', 0, 183),
(81, 'Reggae', 1, 184),
(82, 'Salsa', 0, 184),
(83, 'Cumbia', 0, 184),
(84, 'Tango', 0, 184),
(85, 'The Beatles', 1, 185),
(86, 'Led Zeppelin', 0, 185),
(87, 'Pink Floyd', 0, 185),
(88, 'Queen', 0, 185),
(89, '1970', 1, 186),
(90, '1980', 0, 186),
(91, '1960', 0, 186),
(92, '1990', 0, 186),
(93, 'John Lennon', 1, 187),
(94, 'Paul McCartney', 0, 187),
(95, 'George Harrison', 0, 187),
(96, 'Ringo Starr', 0, 187),
(97, 'Violín', 1, 188),
(98, 'Piano', 0, 188),
(99, 'Flauta', 0, 188),
(100, 'Trompeta', 0, 188),
(101, 'Slash', 1, 189),
(102, 'Jimmy Page', 0, 189),
(103, 'Jimi Hendrix', 0, 189),
(104, 'Eric Clapton', 0, 189),
(105, 'Samba', 1, 190),
(106, 'Merengue', 0, 190),
(107, 'Cumbia', 0, 190),
(108, 'Bachata', 0, 190);

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
(4, 'Gabriel', 'Enrriquez', 'gaenrriquez@gmail.com', '202cb962ac59075b964b07152d234b70', 2000, 'M', 'Argentina', 'admin', 'Cuando.jpg', '647cff2c13f9c', 1, 0, 0, 0),
(5, 'pepe', 'argento', 'fasdsad@asfad.com', '202cb962ac59075b964b07152d234b70', 3423, 'm', 'argentina', 'admin2', 'Chikorita.png', '647d589c749fe', 1, 0, 0, 0),
(6, 'Tomás', 'Ayerbe', 'tomayerbe@gmail.com', '202cb962ac59075b964b07152d234b70', 2002, 'M', 'Argentina', 'tomas', 'user-photo.png', '647fea03c212b', 1, 3, 2, 66.6667);

ALTER TABLE usuarios
ADD COLUMN fecha_registro TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP;

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
(4, 1),
(4, 3),
(5, 3);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `partidas`
--
ALTER TABLE `partidas`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT de la tabla `partidas`
--
ALTER TABLE `partidas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=316;

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
  ADD CONSTRAINT `usuarios_roles_ibfk_2` FOREIGN KEY (`idUsuario`) REFERENCES `usuarios` (`id`),
  ADD CONSTRAINT `usuarios_roles_ibfk_3` FOREIGN KEY (`idUsuario`) REFERENCES `usuarios` (`id`),
  ADD CONSTRAINT `usuarios_roles_ibfk_4` FOREIGN KEY (`idUsuario`) REFERENCES `usuarios` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
