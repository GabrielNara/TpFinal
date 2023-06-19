CREATE DATABASE  IF NOT EXISTS `tp-programacion-web-2` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;
USE `tp-programacion-web-2`;
-- MariaDB dump 10.19  Distrib 10.4.27-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: tp-programacion-web-2
-- ------------------------------------------------------
-- Server version	10.4.27-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `categorias`
--

DROP TABLE IF EXISTS `categorias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categorias` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `categoria` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categorias`
--

LOCK TABLES `categorias` WRITE;
/*!40000 ALTER TABLE `categorias` DISABLE KEYS */;
INSERT INTO `categorias` VALUES (1,'Deporte'),(2,'Geografía'),(3,'Música'),(4,'Entretenimiento');
/*!40000 ALTER TABLE `categorias` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `estado_pregunta`
--

DROP TABLE IF EXISTS `estado_pregunta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `estado_pregunta` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `estado` varchar(40) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `estado_pregunta`
--

LOCK TABLES `estado_pregunta` WRITE;
/*!40000 ALTER TABLE `estado_pregunta` DISABLE KEYS */;
INSERT INTO `estado_pregunta` VALUES (1,'activa'),(2,'suspendida'),(3,'reportada'),(4,'sugerida');
/*!40000 ALTER TABLE `estado_pregunta` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `partidas`
--

DROP TABLE IF EXISTS `partidas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `partidas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `puntaje` int(11) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `idUsuario` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idUsuario` (`idUsuario`)
) ENGINE=InnoDB AUTO_INCREMENT=421 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `partidas`
--

LOCK TABLES `partidas` WRITE;
/*!40000 ALTER TABLE `partidas` DISABLE KEYS */;
INSERT INTO `partidas` VALUES (314,2,'2023-06-09 04:19:23',6),(315,0,'2023-06-12 12:36:03',6),(316,0,'2023-06-12 20:17:48',4),(317,0,'2023-06-12 20:18:23',4),(318,1,'2023-06-12 20:18:58',4),(319,4,'2023-06-12 20:23:23',5),(320,0,'2023-06-12 22:08:25',6),(321,0,'2023-06-12 22:08:27',6),(322,0,'2023-06-12 22:09:51',6),(323,0,'2023-06-12 22:10:10',6),(324,1,'2023-06-12 22:10:34',6),(325,0,'2023-06-12 22:10:46',6),(326,0,'2023-06-12 22:13:10',6),(327,1,'2023-06-12 22:15:59',6),(328,0,'2023-06-12 22:16:07',6),(329,0,'2023-06-12 22:16:20',6),(330,0,'2023-06-12 22:16:21',6),(331,0,'2023-06-12 22:17:47',6),(332,0,'2023-06-12 22:24:55',6),(333,1,'2023-06-12 22:30:34',6),(334,0,'2023-06-12 22:32:20',6),(335,0,'2023-06-12 22:34:44',6),(336,0,'2023-06-12 22:37:48',6),(337,0,'2023-06-12 22:39:22',6),(338,0,'2023-06-12 22:39:36',6),(339,0,'2023-06-12 22:40:42',6),(340,0,'2023-06-12 22:40:59',6),(341,0,'2023-06-12 22:41:12',6),(342,0,'2023-06-12 22:41:26',6),(343,0,'2023-06-12 22:41:41',6),(344,1,'2023-06-13 22:09:30',6),(345,0,'2023-06-13 22:12:09',6),(346,0,'2023-06-13 22:12:28',6),(347,7,'2023-06-13 22:13:14',6),(348,1,'2023-06-14 13:46:07',6),(349,0,'2023-06-14 13:47:01',6),(350,1,'2023-06-14 13:48:31',6),(351,0,'2023-06-14 13:48:41',6),(352,0,'2023-06-16 23:02:20',4),(353,0,'2023-06-16 23:03:14',4),(354,0,'2023-06-16 23:03:33',4),(355,0,'2023-06-16 23:04:09',4),(356,0,'2023-06-16 23:04:18',4),(357,0,'2023-06-16 23:08:35',4),(358,0,'2023-06-16 23:08:50',4),(359,0,'2023-06-16 23:09:32',4),(360,0,'2023-06-16 23:10:04',4),(361,0,'2023-06-16 23:13:12',4),(362,0,'2023-06-16 23:13:58',4),(363,0,'2023-06-16 23:14:18',4),(364,0,'2023-06-16 23:14:31',4),(365,0,'2023-06-16 23:14:47',4),(366,0,'2023-06-16 23:16:38',4),(367,0,'2023-06-16 23:17:20',4),(368,0,'2023-06-16 23:17:32',4),(369,0,'2023-06-16 23:18:24',4),(370,0,'2023-06-16 23:19:19',4),(371,0,'2023-06-16 23:19:31',4),(372,0,'2023-06-16 23:19:42',4),(373,0,'2023-06-16 23:19:48',4),(374,0,'2023-06-16 23:21:30',4),(375,0,'2023-06-16 23:22:12',4),(376,0,'2023-06-16 23:22:20',4),(377,0,'2023-06-16 23:22:53',4),(378,0,'2023-06-16 23:23:07',4),(379,0,'2023-06-16 23:23:25',4),(380,0,'2023-06-16 23:27:58',4),(381,0,'2023-06-16 23:28:07',4),(382,0,'2023-06-16 23:28:20',4),(383,0,'2023-06-16 23:28:27',4),(384,0,'2023-06-16 23:28:48',4),(385,0,'2023-06-16 23:30:53',4),(386,0,'2023-06-16 23:32:03',4),(387,0,'2023-06-16 23:32:24',4),(388,0,'2023-06-16 23:32:45',4),(389,0,'2023-06-16 23:53:44',4),(390,0,'2023-06-16 23:54:13',4),(391,0,'2023-06-16 23:55:01',4),(392,0,'2023-06-16 23:55:19',4),(393,0,'2023-06-17 00:00:27',4),(394,0,'2023-06-17 00:00:53',4),(395,0,'2023-06-17 00:00:54',4),(396,0,'2023-06-17 00:01:19',4),(397,0,'2023-06-17 00:05:32',4),(398,0,'2023-06-17 00:07:58',4),(399,0,'2023-06-17 00:08:35',4),(400,0,'2023-06-17 00:10:34',4),(401,1,'2023-06-17 00:11:14',4),(402,0,'2023-06-17 00:12:07',4),(403,1,'2023-06-17 00:22:35',6),(404,0,'2023-06-17 14:00:34',6),(405,0,'2023-06-17 14:04:21',6),(406,0,'2023-06-17 14:05:13',6),(407,0,'2023-06-17 14:05:26',6),(408,0,'2023-06-17 14:05:43',6),(409,3,'2023-06-17 14:06:41',6),(410,3,'2023-06-17 14:08:52',6),(411,0,'2023-06-17 14:10:49',6),(412,2,'2023-06-18 14:50:22',4),(413,0,'2023-06-18 14:50:45',4),(414,2,'2023-06-19 00:40:00',6),(415,0,'2023-06-19 03:54:35',6),(416,4,'2023-06-19 04:01:21',6),(417,0,'2023-06-19 04:10:06',4),(418,2,'2023-06-19 04:11:25',4),(419,0,'2023-06-19 04:11:29',4),(420,2,'2023-06-19 04:12:03',4);
/*!40000 ALTER TABLE `partidas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `preguntas`
--

DROP TABLE IF EXISTS `preguntas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `preguntas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `porcentaje_acierto` float NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_estado_pregunta` (`id_estado_pregunta`,`id_categoria`)
) ENGINE=InnoDB AUTO_INCREMENT=203 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `preguntas`
--

LOCK TABLES `preguntas` WRITE;
/*!40000 ALTER TABLE `preguntas` DISABLE KEYS */;
INSERT INTO `preguntas` VALUES (163,'¿Quién ganó la última Copa del Mundo de fútbol?',1,1,'Francia','Brasil','Alemania','Argentina','Argentina',4,2,50),(165,'¿Quién ostenta el récord de más medallas de oro olímpicas?',1,1,'Michael Phelps','Usain Bolt','Simone Biles','Serena Williams','Michael Phelps',4,2,50),(166,'¿Cuál es el deporte de invierno más popular?',1,1,'Esquí alpino','Snowboard','Patinaje sobre hielo','Bobsleigh','Patinaje sobre hielo',5,3,60),(167,'¿Cuál es el nadador más laureado en la historia de los Juegos Olímpicos?',1,1,'Michael Phelps','Ian Thorpe','Mark Spitz','Katie Ledecky','Michael Phelps',5,3,60),(168,'¿En qué ciudad se celebraron los primeros Juegos Olímpicos modernos?',1,1,'Atenas','Roma','París','Londres','Atenas',5,2,40),(169,'¿Cuál es el único país que ha ganado el Mundial de fútbol en cinco ocasiones?',1,1,'Brasil','Alemania','Argentina','Italia','Brasil',5,3,60),(170,'¿Quién es considerado el mejor jugador de baloncesto de todos los tiempos?',1,1,'Michael Jordan','LeBron James','Kobe Bryant','Magic Johnson','Michael Jordan',4,2,50),(171,'¿Cuál es el país más grande del mundo?',3,2,'Rusia','Canadá','China','Estados Unidos','Rusia',5,3,60),(172,'¿Cuál es el río más largo del mundo?',1,2,'Amazonas','Nilo','Yangtsé','Misisipi','Amazonas',5,2,40),(173,'¿Cuál es el océano más grande?',3,2,'Océano Pacífico','Océano Atlántico','Océano Índico','Océano Ártico','Océano Pacífico',6,4,66.6667),(174,'¿En qué país se encuentra la Torre Eiffel?',1,2,'Francia','Italia','España','Reino Unido','Francia',4,2,50),(175,'¿Cuál es el lago más profundo del mundo?',1,2,'Lago Baikal','Lago Superior','Lago Victoria','Lago Titicaca','Lago Baikal',4,2,50),(176,'¿Cuál es el continente con mayor población?',1,2,'Asia','África','Europa','América del Norte','Asia',4,2,50),(177,'¿Cuál es el desierto más grande del mundo?',1,2,'Desierto del Sáhara','Desierto de Gobi','Desierto de Atacama','Desierto de Kalahari','Desierto del Sáhara',5,3,60),(179,'¿Cuál es el país más pequeño del mundo?',1,2,'Ciudad del Vaticano','Mónaco','Nauru','Tuvalu','Ciudad del Vaticano',6,4,66.6667),(180,'¿En qué continente se encuentra el Amazonas?',1,2,'América del Sur','América del Norte','África','Europa','América del Sur',4,2,50),(181,'¿Quién es el cantante de la banda británica Queen?',1,3,'Freddie Mercury','Brian May','Roger Taylor','John Deacon','Freddie Mercury',6,4,66.6667),(182,'¿Cuál es el álbum más vendido de todos los tiempos?',3,3,'Thriller','Back in Black','The Dark Side of the Moon','Abbey Road','Thriller',4,2,50),(183,'¿Qué instrumento musical tocaba el famoso compositor Ludwig van Beethoven?',1,3,'Piano','Violín','Guitarra','Flauta','Piano',4,2,50),(184,'¿Cuál es el género musical originario de Jamaica?',3,3,'Reggae','Salsa','Cumbia','Tango','Reggae',4,2,50),(185,'¿Cuál es la banda de rock más exitosa de la historia?',1,3,'The Beatles','Led Zeppelin','Pink Floyd','Queen','The Beatles',4,2,50),(186,'¿En qué década se popularizó el género musical conocido como disco?',1,3,'1970','1980','1960','1990','1970',4,2,50),(187,'¿Quién es el autor de la famosa canción \"Imagine\"?',1,3,'John Lennon','Paul McCartney','George Harrison','Ringo Starr','John Lennon',6,4,66.6667),(188,'¿Cuál es el instrumento principal en una orquesta sinfónica?',1,3,'Violín','Piano','Flauta','Trompeta','Violín',5,3,60),(189,'¿Qué famoso guitarrista fue miembro de las bandas Guns N\' Roses y Velvet Revolver?',1,3,'Slash','Jimmy Page','Jimi Hendrix','Eric Clapton','Slash',5,3,60),(190,'¿Cuál es el género musical principal en el carnaval de Brasil?',1,1,'Samba','Merengue','Cumbia','Bachata','Samba',4,2,50),(191,'¿Quién es el director de la serie Breaking Bad?',1,4,'Baran bo Odar','Vince Gilligan','Frank Darabont','Jeffrey Jacob Abrams','Vince Gilligan',4,2,50),(192,'¿Qué tenista es el máximo ganador de torneos Grand Slam?',1,1,'Novak Djokovic','Rafael Nadal','Roger Federer','Pete Sampras','Novak Djokovic',4,2,50),(193,'¿Cuál es el actor que interpretó a Iron Man en el Universo Cinematográfico de Marvel?',1,4,'Robert Downey Jr.','Chris Evans','Chris Hemsworth','Tom Hiddleston','Robert Downey Jr.',4,2,50),(194,'¿Cuál es la película ganadora del premio Óscar a Mejor Película en 2020?',1,4,'Parasite','Joker','1917','Once Upon a Time in Hollywood','Parasite',4,2,50),(195,'¿Cuál es el director de la trilogía \"El Señor de los Anillos\"?',1,4,'Peter Jackson','Christopher Nolan','Steven Spielberg','Martin Scorsese','Peter Jackson',4,2,50),(196,'¿Cuál es la película de Pixar que cuenta la historia de Woody y Buzz Lightyear?',1,4,'Toy Story','Finding Nemo','The Incredibles','Up','Toy Story',4,2,50),(197,'¿Qué actor interpreta al personaje de Jack Sparrow en la saga \"Piratas del Caribe\"?',1,4,'Johnny Depp','Leonardo DiCaprio','Tom Hanks','Brad Pitt','Johnny Depp',6,3,50),(198,'¿Cuál es la película de Quentin Tarantino que presenta la vida de dos asesinos a sueldo?',1,4,'Pulp Fiction','Kill Bill','Reservoir Dogs','Django Unchained','Pulp Fiction',5,2,40),(199,'¿Cuál es la actriz que interpreta a Katniss Everdeen en la saga \"Los juegos del hambre\"?',1,4,'Jennifer Lawrence','Emma Stone','Scarlett Johansson','Natalie Portman','Jennifer Lawrence',4,2,50),(200,'¿Cuál es la película de ciencia ficción dirigida por Christopher Nolan que trata sobre los viajes en el tiempo?',1,4,'Inception','Interstellar','The Matrix','Blade Runner','Interstellar',4,2,50),(201,'¿Cuál es la película animada de Disney que presenta a Elsa y Anna como protagonistas?',1,4,'Frozen','Moana','Coco','Zootopia','Frozen',4,2,50),(202,'¿Cuál es el director de la trilogía \"El Padrino\"?',1,4,'Francis Ford Coppola','Alfred Hitchcock','Stanley Kubrick','Martin Scorsese','Francis Ford Coppola',5,2,40);
/*!40000 ALTER TABLE `preguntas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rol` varchar(40) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'administrador'),(2,'editor'),(3,'jugador');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `porcentaje_acierto` float NOT NULL,
  `fecha_registro` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES (4,'Gabriel','Enrriquez','gaenrriquez@gmail.com','202cb962ac59075b964b07152d234b70',2000,'M','San Justo','admin','Cuando.jpg','647cff2c13f9c',1,27,14,51.8519,'2023-06-19 04:11:56'),(5,'pepe','argento','fasdsad@asfad.com','202cb962ac59075b964b07152d234b70',3423,'m','Ituzaingó','admin2','user-photo.png','647d589c749fe',1,10,5,50,'2023-06-19 04:11:00'),(6,'Tomás','Ayerbe','tomayerbe@gmail.com','202cb962ac59075b964b07152d234b70',2002,'M','Morón','tomas','user-photo.png','647fea03c212b',1,90,45,50,'2023-06-19 04:11:00');
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarios_roles`
--

DROP TABLE IF EXISTS `usuarios_roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuarios_roles` (
  `idUsuario` int(11) NOT NULL,
  `idRol` int(11) NOT NULL,
  PRIMARY KEY (`idUsuario`,`idRol`) USING BTREE,
  KEY `idRol` (`idRol`),
  CONSTRAINT `FK_idRol` FOREIGN KEY (`idRol`) REFERENCES `roles` (`id`),
  CONSTRAINT `FK_idUsuario` FOREIGN KEY (`idUsuario`) REFERENCES `usuarios` (`id`),
  CONSTRAINT `usuarios_roles_ibfk_1` FOREIGN KEY (`idRol`) REFERENCES `roles` (`id`),
  CONSTRAINT `usuarios_roles_ibfk_2` FOREIGN KEY (`idUsuario`) REFERENCES `usuarios` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios_roles`
--

LOCK TABLES `usuarios_roles` WRITE;
/*!40000 ALTER TABLE `usuarios_roles` DISABLE KEYS */;
INSERT INTO `usuarios_roles` VALUES (4,1),(4,2),(4,3),(5,3),(6,3);
/*!40000 ALTER TABLE `usuarios_roles` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-06-19  2:01:00
