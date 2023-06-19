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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categorias`
--

LOCK TABLES `categorias` WRITE;
/*!40000 ALTER TABLE `categorias` DISABLE KEYS */;
INSERT INTO `categorias` VALUES (1,'Deporte'),(2,'Geografía'),(3,'Música'),(4,'Entretenimiento'),(5,'Historia'),(6,'Tecnología'),(7,'Literatura'),(8,'Matemática');
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
) ENGINE=InnoDB AUTO_INCREMENT=453 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `partidas`
--

LOCK TABLES `partidas` WRITE;
/*!40000 ALTER TABLE `partidas` DISABLE KEYS */;
INSERT INTO `partidas` VALUES (448,2,'2023-06-19 17:37:41',6),(449,1,'2023-06-19 17:38:01',6),(450,2,'2023-06-19 17:38:36',4),(451,0,'2023-06-19 17:38:51',5),(452,1,'2023-06-19 17:39:11',5);
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
) ENGINE=InnoDB AUTO_INCREMENT=261 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `preguntas`
--

LOCK TABLES `preguntas` WRITE;
/*!40000 ALTER TABLE `preguntas` DISABLE KEYS */;
INSERT INTO `preguntas` VALUES (163,'¿Quién ganó la última Copa del Mundo de fútbol?',1,1,'Francia','Brasil','Alemania','Argentina','Argentina',4,2,50),(165,'¿Quién ostenta el récord de más medallas de oro olímpicas?',1,1,'Michael Phelps','Usain Bolt','Simone Biles','Serena Williams','Michael Phelps',4,1,25),(166,'¿Cuál es el deporte de invierno más popular?',1,1,'Esquí alpino','Snowboard','Patinaje sobre hielo','Bobsleigh','Patinaje sobre hielo',4,2,50),(167,'¿Cuál es el nadador más laureado en la historia de los Juegos Olímpicos?',1,1,'Michael Phelps','Ian Thorpe','Mark Spitz','Katie Ledecky','Michael Phelps',5,2,40),(168,'¿En qué ciudad se celebraron los primeros Juegos Olímpicos modernos?',1,1,'Atenas','Roma','París','Londres','Atenas',4,2,50),(169,'¿Cuál es el único país que ha ganado el Mundial de fútbol en cinco ocasiones?',1,1,'Brasil','Alemania','Argentina','Italia','Brasil',4,2,50),(170,'¿Quién es considerado el mejor jugador de baloncesto de todos los tiempos?',1,1,'Michael Jordan','LeBron James','Kobe Bryant','Magic Johnson','Michael Jordan',4,3,75),(171,'¿Cuál es el país más grande del mundo?',3,2,'Rusia','Canadá','China','Estados Unidos','Rusia',5,3,60),(172,'¿Cuál es el río más largo del mundo?',1,2,'Amazonas','Nilo','Yangtsé','Misisipi','Amazonas',5,2,40),(173,'¿Cuál es el océano más grande?',3,2,'Océano Pacífico','Océano Atlántico','Océano Índico','Océano Ártico','Océano Pacífico',7,3,42.8571),(174,'¿En qué país se encuentra la Torre Eiffel?',1,2,'Francia','Italia','España','Reino Unido','Francia',4,2,50),(175,'¿Cuál es el lago más profundo del mundo?',1,2,'Lago Baikal','Lago Superior','Lago Victoria','Lago Titicaca','Lago Baikal',7,6,85.7143),(176,'¿Cuál es el continente con mayor población?',1,2,'Asia','África','Europa','América del Norte','Asia',4,2,50),(177,'¿Cuál es el desierto más grande del mundo?',1,2,'Desierto del Sáhara','Desierto de Gobi','Desierto de Atacama','Desierto de Kalahari','Desierto del Sáhara',4,2,50),(179,'¿Cuál es el país más pequeño del mundo?',1,2,'Ciudad del Vaticano','Mónaco','Nauru','Tuvalu','Ciudad del Vaticano',4,2,50),(180,'¿En qué continente se encuentra el Amazonas?',1,2,'América del Sur','América del Norte','África','Europa','América del Sur',4,2,50),(181,'¿Quién es el cantante de la banda británica Queen?',1,3,'Freddie Mercury','Brian May','Roger Taylor','John Deacon','Freddie Mercury',6,5,83.3333),(182,'¿Cuál es el álbum más vendido de todos los tiempos?',3,3,'Thriller','Back in Black','The Dark Side of the Moon','Abbey Road','Thriller',5,3,60),(183,'¿Qué instrumento musical tocaba el famoso compositor Ludwig van Beethoven?',1,3,'Piano','Violín','Guitarra','Flauta','Piano',6,3,50),(184,'¿Cuál es el género musical originario de Jamaica?',3,3,'Reggae','Salsa','Cumbia','Tango','Reggae',5,2,40),(185,'¿Cuál es la banda de rock más exitosa de la historia?',1,3,'The Beatles','Led Zeppelin','Pink Floyd','Queen','The Beatles',5,3,60),(186,'¿En qué década se popularizó el género musical conocido como disco?',1,3,'1970','1980','1960','1990','1970',4,2,50),(187,'¿Quién es el autor de la famosa canción \"Imagine\"?',1,3,'John Lennon','Paul McCartney','George Harrison','Ringo Starr','John Lennon',6,5,83.3333),(188,'¿Cuál es el instrumento principal en una orquesta sinfónica?',1,3,'Violín','Piano','Flauta','Trompeta','Violín',6,3,50),(189,'¿Qué famoso guitarrista fue miembro de las bandas Guns N\' Roses y Velvet Revolver?',1,3,'Slash','Jimmy Page','Jimi Hendrix','Eric Clapton','Slash',5,3,60),(190,'¿Cuál es el género musical principal en el carnaval de Brasil?',1,1,'Samba','Merengue','Cumbia','Bachata','Samba',5,3,60),(191,'¿Quién es el director de la serie Breaking Bad?',1,4,'Baran bo Odar','Vince Gilligan','Frank Darabont','Jeffrey Jacob Abrams','Vince Gilligan',4,2,50),(192,'¿Qué tenista es el máximo ganador de torneos Grand Slam?',1,1,'Novak Djokovic','Rafael Nadal','Roger Federer','Pete Sampras','Novak Djokovic',6,5,83.3333),(193,'¿Cuál es el actor que interpretó a Iron Man en el Universo Cinematográfico de Marvel?',1,4,'Robert Downey Jr.','Chris Evans','Chris Hemsworth','Tom Hiddleston','Robert Downey Jr.',5,3,60),(194,'¿Cuál es la película ganadora del premio Óscar a Mejor Película en 2020?',1,4,'Parasite','Joker','1917','Once Upon a Time in Hollywood','Parasite',7,3,42.8571),(195,'¿Cuál es el director de la trilogía \"El Señor de los Anillos\"?',1,4,'Peter Jackson','Christopher Nolan','Steven Spielberg','Martin Scorsese','Peter Jackson',7,4,57.1429),(196,'¿Cuál es la película de Pixar que cuenta la historia de Woody y Buzz Lightyear?',1,4,'Toy Story','Finding Nemo','The Incredibles','Up','Toy Story',5,3,60),(197,'¿Qué actor interpreta al personaje de Jack Sparrow en la saga \"Piratas del Caribe\"?',1,4,'Johnny Depp','Leonardo DiCaprio','Tom Hanks','Brad Pitt','Johnny Depp',9,7,77.7778),(198,'¿Cuál es la película de Quentin Tarantino que presenta la vida de dos asesinos a sueldo?',1,4,'Pulp Fiction','Kill Bill','Reservoir Dogs','Django Unchained','Pulp Fiction',5,3,60),(199,'¿Cuál es la actriz que interpreta a Katniss Everdeen en la saga \"Los juegos del hambre\"?',1,4,'Jennifer Lawrence','Emma Stone','Scarlett Johansson','Natalie Portman','Jennifer Lawrence',5,3,60),(200,'¿Cuál es la película de ciencia ficción dirigida por Christopher Nolan que trata sobre los viajes en el tiempo?',1,4,'Inception','Interstellar','The Matrix','Blade Runner','Interstellar',6,4,66.6667),(201,'¿Cuál es la película animada de Disney que presenta a Elsa y Anna como protagonistas?',1,4,'Frozen','Moana','Coco','Zootopia','Frozen',5,5,100),(202,'¿Cuál es el director de la trilogía \"El Padrino\"?',1,4,'Francis Ford Coppola','Alfred Hitchcock','Stanley Kubrick','Martin Scorsese','Francis Ford Coppola',6,5,83.3333),(203,'¿Quién fue el primer presidente de Estados Unidos?',1,5,'George Washington','Thomas Jefferson','Abraham Lincoln','John Adams','George Washington',7,6,85.7143),(204,'¿En qué año se produjo la Revolución Francesa?',1,5,'1789','1804','1832','1765','1789',8,6,75),(205,'¿Cuál fue el último zar de Rusia?',1,5,'Nicolás II','Pedro el Grande','Alejandro I','Iván el Terrible','Nicolás II',7,5,71.4286),(206,'¿Cuál fue el primer país en enviar un ser humano al espacio?',1,5,'Unión Soviética','Estados Unidos','China','Rusia','Unión Soviética',7,4,57.1429),(207,'¿Qué líder político escribió el libro \"Mi Lucha\"?',1,5,'Adolf Hitler','Joseph Stalin','Benito Mussolini','Winston Churchill','Adolf Hitler',3,2,66.6667),(208,'¿En qué año se fundó la Organización de las Naciones Unidas (ONU)?',1,5,'1945','1952','1939','1921','1945',5,4,80),(209,'¿Quién fue el líder de la Revolución Cubana?',1,5,'Fidel Castro','Che Guevara','Raúl Castro','Camilo Cienfuegos','Fidel Castro',10,8,80),(210,'¿En qué año cayó el Muro de Berlín?',1,5,'1989','1991','1987','1993','1989',2,2,100),(211,'¿Quién escribió el \"Manifiesto Comunista\"?',1,5,'Karl Marx y Friedrich Engels','Vladimir Lenin','Mao Zedong','José Stalin','Karl Marx y Friedrich Engels',7,7,100),(212,'¿En qué año se independizó México?',1,5,'1821','1810','1836','1867','1821',7,5,71.4286),(213,'¿Cuál fue el presidente de Estados Unidos durante la Segunda Guerra Mundial?',1,5,'Franklin D. Roosevelt','Harry S. Truman','Dwight D. Eisenhower','John F. Kennedy','Franklin D. Roosevelt',9,7,77.7778),(214,'¿En qué año se produjo la Revolución Rusa?',1,5,'1917','1905','1921','1933','1917',11,10,90.9091),(215,'¿Quién fue el primer emperador romano?',1,5,'Augusto','Julio César','Tiberio','Nerón','Augusto',3,2,66.6667),(216,'¿Cuál fue la causa principal de la Primera Guerra Mundial?',1,5,'Asesinato del Archiduque Francisco Fernando de Austria','Poderío económico de Alemania','Imperialismo europeo','Disputas territoriales en los Balcanes','Asesinato del Archiduque Francisco Fernando de Austria',5,4,80),(217,'¿Cuál fue el primer país en utilizar armas nucleares en la Segunda Guerra Mundial?',1,5,'Estados Unidos','Alemania','Japón','Rusia','Estados Unidos',6,5,83.3333),(218,'¿Quién es considerado el padre de la computadora?',1,6,'Alan Turing','Bill Gates','Steve Jobs','Tim Berners-Lee','Alan Turing',5,2,40),(219,'¿Qué significa la sigla HTML?',1,6,'HyperText Markup Language','Home Tool Markup Language','Hyper Transfer Mode Language','High Tech Modern Language','HyperText Markup Language',6,3,50),(220,'¿Cuál es el lenguaje de programación más utilizado en el desarrollo web?',1,6,'JavaScript','Python','Java','C#','JavaScript',7,2,28.5714),(221,'¿Qué es un algoritmo?',1,6,'Un conjunto de instrucciones paso a paso para resolver un problema','Un dispositivo de almacenamiento de datos','Un tipo de programación orientada a objetos','Un software antivirus','Un conjunto de instrucciones paso a paso para resolver un problema',5,2,40),(222,'¿Qué es un firewall?',1,6,'Un sistema de seguridad que controla el acceso a una red','Un tipo de hardware utilizado para almacenar datos','Un lenguaje de programación orientado a objetos','Un dispositivo de entrada y salida','Un sistema de seguridad que controla el acceso a una red',6,2,33.3333),(223,'¿Cuál es el sistema operativo más utilizado en dispositivos móviles?',1,6,'Android','Windows','Linux','BlackBerry OS','Android',3,1,33.3333),(224,'¿Qué es un servidor web?',1,6,'Un software que sirve páginas web a los clientes','Un dispositivo utilizado para almacenar datos','Un tipo de cable de red','Un programa de edición de imágenes','Un software que sirve páginas web a los clientes',7,1,14.2857),(225,'¿Qué es el protocolo HTTP?',1,6,'HyperText Transfer Protocol','Home Tool Transfer Protocol','High Tech Transfer Protocol','HyperText Transmission Protocol','HyperText Transfer Protocol',7,2,28.5714),(226,'¿Cuál es el componente principal de un disco duro?',1,6,'Platos magnéticos','Memoria RAM','Procesador','Tarjeta gráfica','Platos magnéticos',4,1,25),(227,'¿Qué es un archivo CSV?',1,6,'Un archivo de texto con valores separados por comas','Un formato de imagen comprimida','Un archivo ejecutable de Windows','Un tipo de virus informático','Un archivo de texto con valores separados por comas',5,2,40),(228,'¿Qué es el Big Data?',1,6,'El manejo y análisis de grandes volúmenes de datos','Un software para crear presentaciones','Un tipo de procesador de texto','Una red de computadoras','El manejo y análisis de grandes volúmenes de datos',7,4,57.1429),(229,'¿Cuál es el navegador web más utilizado?',1,6,'Google Chrome','Mozilla Firefox','Microsoft Edge','Safari','Google Chrome',7,2,28.5714),(230,'¿Qué es el lenguaje SQL?',1,6,'Structured Query Language','Simple Query Language','System Query Language','Software Query Language','Structured Query Language',8,2,25),(231,'¿Qué es un virus informático?',1,6,'Un programa malicioso que se propaga y afecta el funcionamiento de una computadora','Una herramienta de seguridad informática','Una copia de seguridad de archivos','Un dispositivo de almacenamiento externo','Un programa malicioso que se propaga y afecta el funcionamiento de una computadora',5,1,20),(232,'¿Quién escribió la novela \"Don Quijote de la Mancha\"?',1,7,'Miguel de Cervantes Saavedra','Gabriel García Márquez','William Shakespeare','Jane Austen','Miguel de Cervantes Saavedra',6,5,83.3333),(233,'¿Cuál es la obra más conocida de William Shakespeare?',1,7,'Romeo y Julieta','Hamlet','Macbeth','Otelo','Romeo y Julieta',6,5,83.3333),(234,'¿Qué autor escribió la obra \"Cien años de soledad\"?',1,7,'Gabriel García Márquez','Jorge Luis Borges','Julio Cortázar','Pablo Neruda','Gabriel García Márquez',7,6,85.7143),(235,'¿Cuál es la protagonista de la novela \"Orgullo y prejuicio\"?',1,7,'Elizabeth Bennet','Emma Woodhouse','Jane Eyre','Anna Karenina','Elizabeth Bennet',4,3,75),(236,'¿Quién escribió la tragedia griega \"Edipo Rey\"?',1,7,'Sófocles','Eurípides','Esquilo','Aristófanes','Sófocles',5,3,60),(237,'¿Cuál es el autor de la obra \"1984\"?',1,7,'George Orwell','Aldous Huxley','Ray Bradbury','Franz Kafka','George Orwell',6,4,66.6667),(238,'¿Qué escritor argentino es autor de \"Ficciones\"?',1,7,'Jorge Luis Borges','Julio Cortázar','Ernesto Sabato','Adolfo Bioy Casares','Jorge Luis Borges',7,4,57.1429),(239,'¿Cuál es el autor de la novela \"Moby Dick\"?',1,7,'Herman Melville','Mark Twain','Charles Dickens','Emily Brontë','Herman Melville',5,1,20),(240,'¿Cuál es la obra más famosa de Fyodor Dostoyevsky?',1,7,'Crimen y castigo','Guerra y paz','Anna Karenina','Los hermanos Karamazov','Crimen y castigo',5,2,40),(241,'¿Qué autor escribió la obra \"El gran Gatsby\"?',1,7,'F. Scott Fitzgerald','Ernest Hemingway','William Faulkner','Virginia Woolf','F. Scott Fitzgerald',6,2,33.3333),(242,'¿Quién es el autor de \"El principito\"?',1,7,'Antoine de Saint-Exupéry','Victor Hugo','Jules Verne','Gustave Flaubert','Antoine de Saint-Exupéry',7,3,42.8571),(243,'¿Cuál es la obra más conocida de Jane Austen?',1,7,'Orgullo y prejuicio','Sentido y sensibilidad','Emma','Persuasión','Orgullo y prejuicio',4,2,50),(244,'¿Quién escribió la obra \"Cien sonetos de amor\"?',1,7,'Pablo Neruda','Octavio Paz','Gabriela Mistral','Federico García Lorca','Pablo Neruda',5,2,40),(245,'¿Cuál es la obra más famosa de Virginia Woolf?',1,7,'La señora Dalloway','Mrs. Dalloway','Orlando','Las olas','La señora Dalloway',6,2,33.3333),(246,'¿Quién escribió la obra \"Mujercitas\"?',1,7,'Louisa May Alcott','Emily Dickinson','Charlotte Brontë','Agatha Christie','Louisa May Alcott',7,2,28.5714),(247,'¿Qué es el teorema de Pitágoras?',1,8,'La suma de los ángulos internos de un triángulo es igual a 180 grados','La suma de los ángulos externos de un triángulo es igual a 360 grados','En un triángulo rectángulo, el cuadrado de la hipotenusa es igual a la suma de los cuadrados de los catetos','La suma de los ángulos de un cuadrado es igual a 360 grados','En un triángulo rectángulo, el cuadrado de la hipotenusa es igual a la suma de los cuadrados de los catetos',7,3,42.8571),(248,'¿Cuánto es 8 * 3?',1,8,'16','24','32','40','24',7,6,85.7143),(249,'¿Qué es una fracción?',1,8,'Un número entero','Una operación de suma','Una expresión algebraica','Una relación de división entre dos números','Una relación de división entre dos números',4,3,75),(250,'¿Cuál es la fórmula para calcular el área de un triángulo?',1,8,'A = l * w','A = π * r^2','A = b * h','A = (b * h) / 2','A = (b * h) / 2',6,3,50),(251,'¿Qué es una ecuación lineal?',1,8,'Una ecuación con exponentes','Una ecuación con fracciones','Una ecuación con una sola variable de grado 1','Una ecuación con varias variables','Una ecuación con una sola variable de grado 1',7,5,71.4286),(252,'¿Cuál es el resultado de la operación 5 - 2 * 3?',1,8,'7','3','1','-1','-1',4,4,100),(253,'¿Qué es una raíz cuadrada?',1,8,'El resultado de una multiplicación','La operación de elevar un número al cuadrado','La operación inversa de elevar un número al cuadrado','La suma de dos números','La operación inversa de elevar un número al cuadrado',7,5,71.4286),(254,'¿Cuál es el resultado de la operación 10 ÷ (4 - 2)?',1,8,'2','4','5','10','5',7,6,85.7143),(255,'¿Cuál es la fórmula para calcular el volumen de una esfera?',1,8,'V = l * w * h','V = π * r^2','V = (4/3) * π * r^3','V = (1/2) * b * h','V = (4/3) * π * r^3',4,1,25),(256,'¿Qué es una proporción?',1,8,'Una operación con exponentes','Una relación entre dos números o cantidades','Una operación de división','Una operación con raíces','Una relación entre dos números o cantidades',6,3,50),(257,'¿Cuál es el resultado de la operación 3 + 2 * 4?',1,8,'20','14','11','9','11',6,6,100),(258,'¿Qué es el valor absoluto de un número?',1,8,'El resultado de una suma','El valor más grande de una serie de números','El resultado de una multiplicación','La distancia del número al cero en una recta numérica','La distancia del número al cero en una recta numérica',7,4,57.1429),(259,'¿Cuál es la fórmula para calcular el área de un círculo?',1,8,'A = l * w','A = π * r^2','A = b * h','A = (b * h) / 2','A = π * r^2',6,2,33.3333),(260,'¿Cuál es el resultado de la operación 4² - 3²?',1,8,'1','7','64','55','7',4,3,75);
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
INSERT INTO `usuarios` VALUES (4,'Gabriel','Enrriquez','gaenrriquez@gmail.com','202cb962ac59075b964b07152d234b70',2000,'M','San Justo','admin','Cuando.jpg','647cff2c13f9c',1,17,15,88.2353,'2023-06-19 17:38:30'),(5,'pepe','argento','fasdsad@asfad.com','202cb962ac59075b964b07152d234b70',3423,'m','Ituzaingó','admin2','user-photo.png','647d589c749fe',1,10,6,60,'2023-06-19 17:39:07'),(6,'Tomás','Ayerbe','tomayerbe@gmail.com','202cb962ac59075b964b07152d234b70',2002,'M','Morón','tomas','user-photo.png','647fea03c212b',1,10,1,10,'2023-06-19 20:29:49');
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
INSERT INTO `usuarios_roles` VALUES (4,1),(4,2),(4,3),(5,2),(5,3),(6,3);
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

-- Dump completed on 2023-06-19 17:30:34
