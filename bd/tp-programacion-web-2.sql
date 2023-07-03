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
  `id_estado_categoria` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categorias`
--

LOCK TABLES `categorias` WRITE;
/*!40000 ALTER TABLE `categorias` DISABLE KEYS */;
INSERT INTO `categorias` VALUES (1,'Deporte',1),(2,'Geografía',1),(3,'Música',1),(4,'Entretenimiento',1),(5,'Historia',1),(6,'Tecnología',1),(7,'Literatura',1),(8,'Matemática',1),(9,'Fútbol',3);
/*!40000 ALTER TABLE `categorias` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `estado_categoria`
--

DROP TABLE IF EXISTS `estado_categoria`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `estado_categoria` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `estado` varchar(40) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `estado_categoria`
--

LOCK TABLES `estado_categoria` WRITE;
/*!40000 ALTER TABLE `estado_categoria` DISABLE KEYS */;
INSERT INTO `estado_categoria` VALUES (1,'activa'),(2,'suspendida'),(3,'sugerida');
/*!40000 ALTER TABLE `estado_categoria` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `partidas`
--

LOCK TABLES `partidas` WRITE;
/*!40000 ALTER TABLE `partidas` DISABLE KEYS */;
INSERT INTO `partidas` VALUES (1,1,'2023-06-26 18:09:36',6),(2,3,'2023-06-26 23:37:39',17),(3,4,'2023-06-26 23:37:39',17),(4,0,'2023-06-27 00:02:05',19),(5,1,'2023-07-03 01:53:21',19),(6,1,'2023-07-03 01:53:21',19),(7,0,'2023-07-03 01:53:21',5),(8,2,'2023-07-03 13:18:00',15);
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
  `fecha_creacion` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_estado_pregunta` (`id_estado_pregunta`,`id_categoria`)
) ENGINE=InnoDB AUTO_INCREMENT=261 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `preguntas`
--

LOCK TABLES `preguntas` WRITE;
/*!40000 ALTER TABLE `preguntas` DISABLE KEYS */;
INSERT INTO `preguntas` VALUES (163,'¿Quién ganó la última Copa del Mundo de fútbol?',3,1,'Francia','Brasil','Alemania','Argentina','Argentina',4,4,100,'2023-06-25'),(165,'¿Quién ostenta el récord de más medallas de oro olímpicas?',3,1,'Michael Phelps','Usain Bolt','Simone Biles','Serena Williams','Michael Phelps',4,3,75,'2023-06-23'),(166,'¿Cuál es el deporte de invierno más popular?',2,1,'Esquí alpino','Snowboard','Patinaje sobre hielo','Bobsleigh','Patinaje sobre hielo',4,2,50,'2023-06-23'),(167,'¿Cuál es el nadador más laureado en la historia de los Juegos Olímpicos?',3,1,'Michael Phelps','Ian Thorpe','Mark Spitz','Katie Ledecky','Michael Phelps',4,1,25,'2023-06-23'),(168,'¿En qué ciudad se celebraron los primeros Juegos Olímpicos modernos?',1,1,'Atenas','Roma','París','Londres','Atenas',4,0,0,'2023-06-23'),(169,'¿Cuál es el único país que ha ganado el Mundial de fútbol en cinco ocasiones?',1,1,'Brasil','Alemania','Argentina','Italia','Brasil',4,4,100,'2023-06-23'),(170,'¿Quién es considerado el mejor jugador de baloncesto de todos los tiempos?',1,1,'Michael Jordan','LeBron James','Kobe Bryant','Magic Johnson','Michael Jordan',4,3,75,'2023-06-23'),(171,'¿Cuál es el país más grande del mundo?',4,2,'Rusia','Canadá','China','Estados Unidos','Rusia',4,2,50,'2023-06-23'),(172,'¿Cuál es el río más largo del mundo?',1,2,'Amazonas','Nilo','Yangtsé','Misisipi','Amazonas',4,1,25,'2023-06-23'),(173,'¿Cuál es el océano más grande?',4,2,'Océano Pacífico','Océano Atlántico','Océano Índico','Océano Ártico','Océano Pacífico',4,0,0,'2023-06-23'),(174,'¿En qué país se encuentra la Torre Eiffel?',2,2,'Francia','Italia','España','Reino Unido','Francia',4,4,100,'2023-06-20'),(175,'¿Cuál es el lago más profundo del mundo?',4,2,'Lago Baikal','Lago Superior','Lago Victoria','Lago Titicaca','Lago Baikal',4,3,75,'2023-06-20'),(176,'¿Cuál es el continente con mayor población?',1,2,'Asia','África','Europa','América del Norte','Asia',4,2,50,'2023-06-20'),(177,'¿Cuál es el desierto más grande del mundo?',1,2,'Desierto del Sáhara','Desierto de Gobi','Desierto de Atacama','Desierto de Kalahari','Desierto del Sáhara',4,1,25,'2023-06-20'),(179,'¿Cuál es el país más pequeño del mundo?',1,2,'Ciudad del Vaticano','Mónaco','Nauru','Tuvalu','Ciudad del Vaticano',4,0,0,'2023-06-20'),(180,'¿En qué continente se encuentra el Amazonas?',1,2,'América del Sur','América del Norte','África','Europa','América del Sur',4,4,100,'2023-06-20'),(181,'¿Quién es el cantante de la banda británica Queen?',4,3,'Freddie Mercury','Brian May','Roger Taylor','John Deacon','Freddie Mercury',4,3,75,'2023-06-20'),(182,'¿Cuál es el álbum más vendido de todos los tiempos?',4,3,'Thriller','Back in Black','The Dark Side of the Moon','Abbey Road','Thriller',4,2,50,'2023-06-20'),(183,'¿Qué instrumento musical tocaba el famoso compositor Ludwig van Beethoven?',1,3,'Piano','Violín','Guitarra','Flauta','Piano',4,1,25,'2023-06-20'),(184,'¿Cuál es el género musical originario de Jamaica?',4,3,'Reggae','Salsa','Cumbia','Tango','Reggae',4,0,0,'2023-06-20'),(185,'¿Cuál es la banda de rock más exitosa de la historia?',1,3,'The Beatles','Led Zeppelin','Pink Floyd','Queen','The Beatles',4,4,100,'2023-05-02'),(186,'¿En qué década se popularizó el género musical conocido como disco?',4,3,'1970','1980','1960','1990','1970',4,3,75,'2023-05-02'),(187,'¿Quién es el autor de la famosa canción \"Imagine\"?',1,3,'John Lennon','Paul McCartney','George Harrison','Ringo Starr','John Lennon',4,2,50,'2023-05-02'),(188,'¿Cuál es el instrumento principal en una orquesta sinfónica?',1,3,'Violín','Piano','Flauta','Trompeta','Violín',4,1,25,'2023-05-02'),(189,'¿Qué famoso guitarrista fue miembro de las bandas Guns N\' Roses y Velvet Revolver?',1,3,'Slash','Jimmy Page','Jimi Hendrix','Eric Clapton','Slash',4,0,0,'2023-05-02'),(190,'¿Cuál es el género musical principal en el carnaval de Brasil?',1,1,'Samba','Merengue','Cumbia','Bachata','Samba',4,4,100,'2023-05-02'),(191,'¿Quién es el director de la serie Breaking Bad?',1,4,'Baran bo Odar','Vince Gilligan','Frank Darabont','Jeffrey Jacob Abrams','Vince Gilligan',4,3,75,'2023-05-02'),(192,'¿Qué tenista es el máximo ganador de torneos Grand Slam?',1,1,'Novak Djokovic','Rafael Nadal','Roger Federer','Pete Sampras','Novak Djokovic',4,2,50,'2023-05-02'),(193,'¿Cuál es el actor que interpretó a Iron Man en el Universo Cinematográfico de Marvel?',1,4,'Robert Downey Jr.','Chris Evans','Chris Hemsworth','Tom Hiddleston','Robert Downey Jr.',4,1,25,'2023-05-02'),(194,'¿Cuál es la película ganadora del premio Óscar a Mejor Película en 2020?',1,4,'Parasite','Joker','1917','Once Upon a Time in Hollywood','Parasite',5,1,20,'2023-05-02'),(195,'¿Cuál es el director de la trilogía \"El Señor de los Anillos\"?',1,4,'Peter Jackson','Christopher Nolan','Steven Spielberg','Martin Scorsese','Peter Jackson',4,4,100,'2023-05-02'),(196,'¿Cuál es la película de Pixar que cuenta la historia de Woody y Buzz Lightyear?',1,4,'Toy Story','Finding Nemo','The Incredibles','Up','Toy Story',5,4,80,'2023-01-31'),(197,'¿Qué actor interpreta al personaje de Jack Sparrow en la saga \"Piratas del Caribe\"?',1,4,'Johnny Depp','Leonardo DiCaprio','Tom Hanks','Brad Pitt','Johnny Depp',4,2,50,'2023-01-31'),(198,'¿Cuál es la película de Quentin Tarantino que presenta la vida de dos asesinos a sueldo?',1,4,'Pulp Fiction','Kill Bill','Reservoir Dogs','Django Unchained','Pulp Fiction',4,1,25,'2023-01-31'),(199,'¿Cuál es la actriz que interpreta a Katniss Everdeen en la saga \"Los juegos del hambre\"?',1,4,'Jennifer Lawrence','Emma Stone','Scarlett Johansson','Natalie Portman','Jennifer Lawrence',4,0,0,'2023-01-31'),(200,'¿Cuál es la película de ciencia ficción dirigida por Christopher Nolan que trata sobre los viajes en el tiempo?',1,4,'Inception','Interstellar','The Matrix','Blade Runner','Interstellar',4,4,100,'2023-01-31'),(201,'¿Cuál es la película animada de Disney que presenta a Elsa y Anna como protagonistas?',1,4,'Frozen','Moana','Coco','Zootopia','Frozen',4,3,75,'2023-01-31'),(202,'¿Cuál es el director de la trilogía \"El Padrino\"?',1,4,'Francis Ford Coppola','Alfred Hitchcock','Stanley Kubrick','Martin Scorsese','Francis Ford Coppola',4,2,50,'2023-01-31'),(203,'¿Quién fue el primer presidente de Estados Unidos?',1,5,'George Washington','Thomas Jefferson','Abraham Lincoln','John Adams','George Washington',4,1,25,'2023-01-31'),(204,'¿En qué año se produjo la Revolución Francesa?',1,5,'1789','1804','1832','1765','1789',4,0,0,'2023-01-31'),(205,'¿Cuál fue el último zar de Rusia?',1,5,'Nicolás II','Pedro el Grande','Alejandro I','Iván el Terrible','Nicolás II',5,4,80,'2023-01-31'),(206,'¿Cuál fue el primer país en enviar un ser humano al espacio?',1,5,'Unión Soviética','Estados Unidos','China','Rusia','Unión Soviética',4,3,75,'2023-01-31'),(207,'¿Qué líder político escribió el libro \"Mi Lucha\"?',1,5,'Adolf Hitler','Joseph Stalin','Benito Mussolini','Winston Churchill','Adolf Hitler',4,2,50,'2022-11-25'),(208,'¿En qué año se fundó la Organización de las Naciones Unidas (ONU)?',1,5,'1945','1952','1939','1921','1945',4,1,25,'2022-11-25'),(209,'¿Quién fue el líder de la Revolución Cubana?',1,5,'Fidel Castro','Che Guevara','Raúl Castro','Camilo Cienfuegos','Fidel Castro',5,0,0,'2022-11-25'),(210,'¿En qué año cayó el Muro de Berlín?',1,5,'1989','1991','1987','1993','1989',4,4,100,'2022-11-25'),(211,'¿Quién escribió el \"Manifiesto Comunista\"?',1,5,'Karl Marx y Friedrich Engels','Vladimir Lenin','Mao Zedong','José Stalin','Karl Marx y Friedrich Engels',4,3,75,'2022-11-25'),(212,'¿En qué año se independizó México?',1,5,'1821','1810','1836','1867','1821',4,2,50,'2022-11-25'),(213,'¿Cuál fue el presidente de Estados Unidos durante la Segunda Guerra Mundial?',1,5,'Franklin D. Roosevelt','Harry S. Truman','Dwight D. Eisenhower','John F. Kennedy','Franklin D. Roosevelt',4,1,25,'2022-11-25'),(214,'¿En qué año se produjo la Revolución Rusa?',1,5,'1917','1905','1921','1933','1917',4,0,0,'2022-11-25'),(215,'¿Quién fue el primer emperador romano?',1,5,'Augusto','Julio César','Tiberio','Nerón','Augusto',4,4,100,'2022-11-25'),(216,'¿Cuál fue la causa principal de la Primera Guerra Mundial?',1,5,'Asesinato del Archiduque Francisco Fernando de Austria','Poderío económico de Alemania','Imperialismo europeo','Disputas territoriales en los Balcanes','Asesinato del Archiduque Francisco Fernando de Austria',4,3,75,'2022-11-25'),(217,'¿Cuál fue el primer país en utilizar armas nucleares en la Segunda Guerra Mundial?',1,5,'Estados Unidos','Alemania','Japón','Rusia','Estados Unidos',4,2,50,'2022-11-25'),(218,'¿Quién es considerado el padre de la computadora?',1,6,'Alan Turing','Bill Gates','Steve Jobs','Tim Berners-Lee','Alan Turing',4,1,25,'2022-11-04'),(219,'¿Qué significa la sigla HTML?',1,6,'HyperText Markup Language','Home Tool Markup Language','Hyper Transfer Mode Language','High Tech Modern Language','HyperText Markup Language',4,0,0,'2022-11-04'),(220,'¿Cuál es el lenguaje de programación más utilizado en el desarrollo web?',1,6,'JavaScript','Python','Java','C#','JavaScript',4,4,100,'2022-11-04'),(221,'¿Qué es un algoritmo?',1,6,'Un conjunto de instrucciones paso a paso para resolver un problema','Un dispositivo de almacenamiento de datos','Un tipo de programación orientada a objetos','Un software antivirus','Un conjunto de instrucciones paso a paso para resolver un problema',4,3,75,'2022-11-04'),(222,'¿Qué es un firewall?',1,6,'Un sistema de seguridad que controla el acceso a una red','Un tipo de hardware utilizado para almacenar datos','Un lenguaje de programación orientado a objetos','Un dispositivo de entrada y salida','Un sistema de seguridad que controla el acceso a una red',4,2,50,'2022-11-04'),(223,'¿Cuál es el sistema operativo más utilizado en dispositivos móviles?',1,6,'Android','Windows','Linux','BlackBerry OS','Android',4,1,25,'2022-11-04'),(224,'¿Qué es un servidor web?',1,6,'Un software que sirve páginas web a los clientes','Un dispositivo utilizado para almacenar datos','Un tipo de cable de red','Un programa de edición de imágenes','Un software que sirve páginas web a los clientes',4,0,0,'2022-11-04'),(225,'¿Qué es el protocolo HTTP?',1,6,'HyperText Transfer Protocol','Home Tool Transfer Protocol','High Tech Transfer Protocol','HyperText Transmission Protocol','HyperText Transfer Protocol',4,4,100,'2022-11-04'),(226,'¿Cuál es el componente principal de un disco duro?',1,6,'Platos magnéticos','Memoria RAM','Procesador','Tarjeta gráfica','Platos magnéticos',4,3,75,'2022-11-04'),(227,'¿Qué es un archivo CSV?',1,6,'Un archivo de texto con valores separados por comas','Un formato de imagen comprimida','Un archivo ejecutable de Windows','Un tipo de virus informático','Un archivo de texto con valores separados por comas',4,2,50,'2022-11-04'),(228,'¿Qué es el Big Data?',1,6,'El manejo y análisis de grandes volúmenes de datos','Un software para crear presentaciones','Un tipo de procesador de texto','Una red de computadoras','El manejo y análisis de grandes volúmenes de datos',4,1,25,'2022-11-04'),(229,'¿Cuál es el navegador web más utilizado?',1,6,'Google Chrome','Mozilla Firefox','Microsoft Edge','Safari','Google Chrome',4,0,0,'2022-07-15'),(230,'¿Qué es el lenguaje SQL?',1,6,'Structured Query Language','Simple Query Language','System Query Language','Software Query Language','Structured Query Language',4,4,100,'2022-07-15'),(231,'¿Qué es un virus informático?',1,6,'Un programa malicioso que se propaga y afecta el funcionamiento de una computadora','Una herramienta de seguridad informática','Una copia de seguridad de archivos','Un dispositivo de almacenamiento externo','Un programa malicioso que se propaga y afecta el funcionamiento de una computadora',4,3,75,'2022-07-15'),(232,'¿Quién escribió la novela \"Don Quijote de la Mancha\"?',1,7,'Miguel de Cervantes Saavedra','Gabriel García Márquez','William Shakespeare','Jane Austen','Miguel de Cervantes Saavedra',4,2,50,'2022-07-15'),(233,'¿Cuál es la obra más conocida de William Shakespeare?',1,7,'Romeo y Julieta','Hamlet','Macbeth','Otelo','Romeo y Julieta',4,1,25,'2022-07-15'),(234,'¿Qué autor escribió la obra \"Cien años de soledad\"?',1,7,'Gabriel García Márquez','Jorge Luis Borges','Julio Cortázar','Pablo Neruda','Gabriel García Márquez',4,0,0,'2022-07-15'),(235,'¿Cuál es la protagonista de la novela \"Orgullo y prejuicio\"?',1,7,'Elizabeth Bennet','Emma Woodhouse','Jane Eyre','Anna Karenina','Elizabeth Bennet',4,4,100,'2022-07-15'),(236,'¿Quién escribió la tragedia griega \"Edipo Rey\"?',1,7,'Sófocles','Eurípides','Esquilo','Aristófanes','Sófocles',4,3,75,'2022-07-15'),(237,'¿Cuál es el autor de la obra \"1984\"?',1,7,'George Orwell','Aldous Huxley','Ray Bradbury','Franz Kafka','George Orwell',4,2,50,'2022-07-15'),(238,'¿Qué escritor argentino es autor de \"Ficciones\"?',1,7,'Jorge Luis Borges','Julio Cortázar','Ernesto Sabato','Adolfo Bioy Casares','Jorge Luis Borges',4,1,25,'2022-07-15'),(239,'¿Cuál es el autor de la novela \"Moby Dick\"?',1,7,'Herman Melville','Mark Twain','Charles Dickens','Emily Brontë','Herman Melville',4,0,0,'2022-07-15'),(240,'¿Cuál es la obra más famosa de Fyodor Dostoyevsky?',1,7,'Crimen y castigo','Guerra y paz','Anna Karenina','Los hermanos Karamazov','Crimen y castigo',4,4,100,'2023-05-19'),(241,'¿Qué autor escribió la obra \"El gran Gatsby\"?',1,7,'F. Scott Fitzgerald','Ernest Hemingway','William Faulkner','Virginia Woolf','F. Scott Fitzgerald',4,3,75,'2023-05-19'),(242,'¿Quién es el autor de \"El principito\"?',1,7,'Antoine de Saint-Exupéry','Victor Hugo','Jules Verne','Gustave Flaubert','Antoine de Saint-Exupéry',4,2,50,'2023-05-19'),(243,'¿Cuál es la obra más conocida de Jane Austen?',3,7,'Orgullo y prejuicio','Sentido y sensibilidad','Emma','Persuasión','Orgullo y prejuicio',4,1,25,'2023-05-19'),(244,'¿Quién escribió la obra \"Cien sonetos de amor\"?',1,7,'Pablo Neruda','Octavio Paz','Gabriela Mistral','Federico García Lorca','Pablo Neruda',4,0,0,'2023-05-19'),(245,'¿Cuál es la obra más famosa de Virginia Woolf?',1,7,'La señora Dalloway','Mrs. Dalloway','Orlando','Las olas','La señora Dalloway',4,4,100,'2023-05-19'),(246,'¿Quién escribió la obra \"Mujercitas\"?',1,7,'Louisa May Alcott','Emily Dickinson','Charlotte Brontë','Agatha Christie','Louisa May Alcott',4,3,75,'2023-05-19'),(247,'¿Qué es el teorema de Pitágoras?',1,8,'La suma de los ángulos internos de un triángulo es igual a 180 grados','La suma de los ángulos externos de un triángulo es igual a 360 grados','En un triángulo rectángulo, el cuadrado de la hipotenusa es igual a la suma de los cuadrados de los catetos','La suma de los ángulos de un cuadrado es igual a 360 grados','En un triángulo rectángulo, el cuadrado de la hipotenusa es igual a la suma de los cuadrados de los catetos',4,2,50,'2023-05-19'),(248,'¿Cuánto es 8 * 3?',1,8,'16','24','32','40','24',5,2,40,'2023-05-19'),(249,'¿Qué es una fracción?',1,8,'Un número entero','Una operación de suma','Una expresión algebraica','Una relación de división entre dos números','Una relación de división entre dos números',4,0,0,'2023-05-19'),(250,'¿Cuál es la fórmula para calcular el área de un triángulo?',3,8,'A = l * w','A = π * r^2','A = b * h','A = (b * h) / 2','A = (b * h) / 2',4,4,100,'2023-05-19'),(251,'¿Qué es una ecuación lineal?',1,8,'Una ecuación con exponentes','Una ecuación con fracciones','Una ecuación con una sola variable de grado 1','Una ecuación con varias variables','Una ecuación con una sola variable de grado 1',4,3,75,'2022-12-15'),(252,'¿Cuál es el resultado de la operación 5 - 2 * 3?',1,8,'7','3','1','-1','-1',4,2,50,'2022-12-15'),(253,'¿Qué es una raíz cuadrada?',1,8,'El resultado de una multiplicación','La operación de elevar un número al cuadrado','La operación inversa de elevar un número al cuadrado','La suma de dos números','La operación inversa de elevar un número al cuadrado',4,1,25,'2022-12-15'),(254,'¿Cuál es el resultado de la operación 10 ÷ (4 - 2)?',1,8,'2','4','5','10','5',4,0,0,'2022-12-15'),(255,'¿Cuál es la fórmula para calcular el volumen de una esfera?',1,8,'V = l * w * h','V = π * r^2','V = (4/3) * π * r^3','V = (1/2) * b * h','V = (4/3) * π * r^3',4,4,100,'2022-12-15'),(256,'¿Qué es una proporción?',1,8,'Una operación con exponentes','Una relación entre dos números o cantidades','Una operación de división','Una operación con raíces','Una relación entre dos números o cantidades',4,3,75,'2023-05-19'),(257,'¿Cuál es el resultado de la operación 3 + 2 * 4?',1,8,'20','14','11','9','11',4,2,50,'2023-05-19'),(258,'¿Qué es el valor absoluto de un número?',1,8,'El resultado de una suma','El valor más grande de una serie de números','El resultado de una multiplicación','La distancia del número al cero en una recta numérica','La distancia del número al cero en una recta numérica',4,1,25,'2023-05-19'),(259,'¿Cuál es la fórmula para calcular el área de un círculo?',1,8,'A = l * w','A = π * r^2','A = b * h','A = (b * h) / 2','A = π * r^2',4,0,0,'2023-05-19'),(260,'¿Cuál es el resultado de la operación 4² - 3²?',1,8,'1','7','64','55','7',4,4,100,'2023-05-19');
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
-- Table structure for table `trampitas`
--

DROP TABLE IF EXISTS `trampitas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `trampitas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idUsuario` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `fecha_compra` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idUsuario` (`idUsuario`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trampitas`
--

LOCK TABLES `trampitas` WRITE;
/*!40000 ALTER TABLE `trampitas` DISABLE KEYS */;
INSERT INTO `trampitas` VALUES (1,4,15,'2023-06-26'),(2,5,5,'2022-06-22'),(3,6,10,'2023-06-15'),(4,7,6,'2023-06-26'),(5,8,4,'2022-12-22'),(6,16,2,'2023-01-26'),(7,19,12,'2023-06-26'),(8,15,1,'2023-07-03');
/*!40000 ALTER TABLE `trampitas` ENABLE KEYS */;
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
  `ano_nacimiento` year(4) NOT NULL,
  `sexo` varchar(10) NOT NULL,
  `pais` varchar(255) NOT NULL,
  `nombre_usuario` varchar(255) NOT NULL,
  `foto_perfil` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `validado` int(1) NOT NULL DEFAULT 0,
  `preguntas_totales` int(11) NOT NULL,
  `preguntas_correctas` int(11) NOT NULL,
  `porcentaje_acierto` float NOT NULL,
  `fecha_registro` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `trampitas` int(11) NOT NULL DEFAULT 0,
  `latitud` float NOT NULL,
  `longitud` float NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES (4,'Gabriel','Enrriquez','gaenrriquez@gmail.com','202cb962ac59075b964b07152d234b70',2000,'M','Argentina','admin','Cuando.jpg','647cff2c13f9c',1,105,8,7.61905,'2023-07-03 01:48:27',15,-34.6589,-58.5867),(5,'Pepe','Argento','pepe@gmail.com','202cb962ac59075b964b07152d234b70',1960,'F','Chile','admin2','user-photo.png','647d589c749fe',1,5,2,40,'2022-07-01 14:22:02',5,-33.4593,-70.649),(6,'Tomás','Ayerbe','tomas@gmail.com','202cb962ac59075b964b07152d234b70',2002,'M','Argentina','tomas','user-photo.png','647fea03c212b',1,6,2,33.3333,'2021-07-01 14:01:31',10,-34.6589,-58.5867),(7,'Juan','Sánchez','juan@gmail.com','202cb962ac59075b964b07152d234b70',2002,'M','Perú','juan','user-photo.png','647fea03c2000',1,4,3,75,'2023-05-01 14:26:04',6,-12.0554,-77.0348),(8,'Pedro','Díaz','pedro@gmail.com','202cb962ac59075b964b07152d234b70',1970,'M','Colombia','pedro','user-photo.png','647fea03c2222',1,4,2,50,'2022-07-01 14:24:47',4,11.0048,-74.8168),(9,'Andrés','Pérez','andres@gmail.com','202cb962ac59075b964b07152d234b70',2002,'M','Argentina','andres','user-photo.png','647fea03c3333',1,4,1,25,'2022-03-01 14:01:31',0,-34.6571,-58.7121),(10,'Emiliano','Pérez','emiliano@gmail.com','202cb962ac59075b964b07152d234b70',2002,'M','Brasil','emiliano','user-photo.png','647fea03c4444',1,4,0,0,'2023-02-01 14:25:29',0,-23.5497,-46.6673),(11,'Pablo','Díaz','pablo@gmail.com','202cb962ac59075b964b07152d234b70',2015,'M','Argentina','pablo','user-photo.png','647fea03c5555',1,4,3,75,'2022-03-01 14:01:31',0,-34.6571,-58.7121),(12,'Flavio','Sánchez','flavio@gmail.com','202cb962ac59075b964b07152d234b70',2014,'M','Brasil','flavio','user-photo.png','647fea03c6666',1,4,2,50,'2023-05-01 14:25:29',0,-23.5497,-46.6673),(13,'Martín','Díaz','martin@gmail.com','202cb962ac59075b964b07152d234b70',2012,'M','Argentina','martin','user-photo.png','647fea03c7777',1,4,1,25,'2023-01-21 13:51:50',0,-34.6571,-58.7121),(14,'Fabricio','Pérez','fabricio@gmail.com','202cb962ac59075b964b07152d234b70',1990,'M','Perú','fabricio','user-photo.png','647fea03c8888',1,4,0,0,'2023-06-01 14:26:04',0,-12.0554,-77.0348),(15,'Jorge','Emilio','jorge@gmail.com','202cb962ac59075b964b07152d234b70',1950,'M','Perú','jorge','user-photo.png','647fea03c9999',1,7,5,71.4286,'2023-07-03 13:18:21',1,-12.0554,-77.0348),(16,'Silvia','Fernández','silvia@gmail.com','202cb962ac59075b964b07152d234b70',1945,'F','Colombia','silvia','user-photo.png','6498f92d4905a',1,4,2,50,'2022-07-01 14:24:47',2,11.0048,-74.8168),(17,'Cristian','Díaz','cristian@gmail.com','202cb962ac59075b964b07152d234b70',1975,'M','Argentina','cristian','user-photo.png','6499d0e6967fc',1,4,1,25,'2023-01-21 13:51:50',0,-34.6571,-58.7121),(18,'Ivan','Díaz','ivan@gmail.com','202cb962ac59075b964b07152d234b70',1975,'M','Argentina','ivan','user-photo.png','6499d0e696799',0,2,0,0,'2023-02-08 13:51:50',0,-34.6589,-58.5867),(19,'Ale','Ale','ale@gmail.com','202cb962ac59075b964b07152d234b70',2000,'M','Argentina','ale','user-photo.png','649a26c65233d',1,8,2,25,'2023-04-11 13:51:50',11,-34.6571,-58.7121),(20,'Francisco','Pérez','francisco@gmail.com','202cb962ac59075b964b07152d234b70',2001,'M','Argentina','francisco','user-photo.png','64a02f6325645',1,0,0,0,'2022-06-21 13:51:50',0,-34.6589,-58.5867),(21,'Juan','Manuel','juan2@gmail.com','202cb962ac59075b964b07152d234b70',1945,'M','Estados Unidos','juan2','user-photo.png','64a035120fc38',1,0,0,0,'2022-07-01 14:16:10',0,40.7128,-74.006);
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
INSERT INTO `usuarios_roles` VALUES (4,1),(4,2),(4,3),(5,2),(5,3),(6,3),(7,3),(8,3),(9,3),(10,3),(11,3),(12,3),(13,3),(14,3),(15,3),(16,3),(17,3),(18,3),(19,3),(20,3),(21,3);
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

-- Dump completed on 2023-07-03 10:19:30
