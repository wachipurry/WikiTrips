SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

USE a19rogcalrul_wikitrips;

INSERT INTO `user_status` (`id_status`, `status_name`) VALUES
(1, 'Activo'),
(2, 'Reportado'),
(3, 'Baneado'),
(4, 'Eliminado');

INSERT INTO `user_details` (`id_user`, `img_profile`, `descr`, `alias`, `id_status`, `last_login`) VALUES
(1, 'foto01.jpg', 'Soy artista 3d, me gusta la magia, la nieve, los deportes de contacto y siempre me propongo metas a ', 'capitan', 1, '0000-00-00'),
(2, 'foto02.jpg', 'Me encantan las charlas apasionadas, regocijantes y divertidas. Me gusta la montaña y conocer gente ', 'manuela88', 1, '0000-00-00'),
(3, 'foto01.jpg', 'Mi entorno dice que soy una persona maravillosa. Me encanta ir en bicicleta y perderme en lugares de', 'angelita', 1, '0000-00-00'),
(4, 'foto02.jpg', 'Amante de la arquitectura y museos. ', 'marccc', 1, '0000-00-00'),
(5, 'foto01.jpg', 'Descripcion 5', 'pepe5555', 1, '0000-00-00'),
(6, 'foto02.jpg', 'Descripcion 6', 'diana6666', 1, '0000-00-00'),
(7, 'foto01.jpg', 'Mi perfil 7', 'carla7777', 1, '0000-00-00'),
(8, 'foto02.jpg', 'Amante de la cultura y museos. ', 'anton8888', 1, '0000-00-00'),
(9, 'foto01.jpg', 'Descripcion 9', 'carles9999', 1, '0000-00-00'),
(10, 'foto02.jpg', 'Descripcion 10', 'celia1010', 1, '0000-00-00'),
(11, 'foto01.jpg', 'Mi perfil 11', 'sara1111', 1, '0000-00-00'),
(12, 'foto02.jpg', 'Fan de la natura y senderismo. ', 'jordi1212', 1, '0000-00-00');

INSERT INTO `user_profile` (`id_user`, `treatment`, `firstname`, `lastname`, `email`, `opt_in`, `sign_up`, `unsuscribed`) VALUES
(1, 'Sr.', 'Antonio', 'Sánchez', 'antonio_s@gmail.com', 1, '2019-12-10 16:09:52', NULL),
(2, 'Sra.', 'Manuela', 'Ramos', 'manuelaramos@gmail.com', 1, '2019-12-10 16:09:52', NULL),
(3, 'Sra.', 'Ángela', 'López', 'angelita@gmail.com', 1, '2019-12-10 16:09:52', NULL),
(4, 'Sr.', 'Marc', 'García', 'marcus7@gmail.com', 1, '2019-12-10 16:09:52', NULL),
(5, 'Sr.', 'Pepe', 'Ruiz', 'pep.r123@gmail.com', 1, '2019-12-10 16:29:40', NULL),
(6, 'Sra.', 'Diana', 'Gutierrez', 'diana_guti@gmail.com', 1, '2019-12-10 16:29:40', NULL),
(7, 'Sra.', 'Carla', 'Puig', 'c.puig555@gmail.com', 1, '2019-12-10 16:29:40', NULL),
(8, 'Sr.', 'Anton', 'Serra', 'a.serra@gmail.com', 1, '2019-12-10 16:29:40', NULL),
(9, 'Sr.', 'Carles', 'Sanz', 'qdicescharlyio@gmail.com', 1, '2019-12-10 16:29:40', NULL),
(10, 'Sra.', 'Celia', 'Perez', 'celia222@gmail.com', 1, '2019-12-10 16:29:40', NULL),
(11, 'Sra.', 'Sara', 'López', 'sarita1989@gmail.com', 1, '2019-12-10 16:29:40', NULL),
(12, 'Sr.', 'Jordi', 'Martí', 'jordi7@gmail.com', 1, '2019-12-10 16:29:40', NULL);

INSERT INTO `pass` (`id_user`, `pass`) VALUES
(1, 'capitan_123'),
(2, 'manuela88_123'),
(3, 'angelita_123'),
(4, 'marccc_123'),
(5, 'pepe5555_123'),
(6, 'diana6666_123'),
(7, 'carla7777_123'),
(8, 'anton8888_123'),
(9, 'carles9999_123'),
(10, 'celia1010_123'),
(11, 'sara1111_123'),
(12, 'jordi1212_123');


INSERT INTO `trips_status` (`id_status`, `status_name`) VALUES
(1, 'borrador'),
(2, 'pendiente'),
(3, 'publico'),
(4, 'reportado'),
(5, 'oculto');

INSERT INTO `trips` (`id_trip`, `id_user`, `id_status`, `title`, `summary`, `descr`, `publish_date`, `geo`) VALUES
(1, 3, 3, 'Excursión por el Caminito del Rey', 'Descubre uno de los paisajes más espectaculares de la sierra malagueña: el Caminito del Rey.', 'Descubre uno de los paisajes más espectaculares de la sierra malagueña: el Caminito del Rey. Un sendero de 7,7 kilómetros conocido como el \"más peligroso del mundo\" por sus impresionantes vistas y sus asombrosas pasarelas, pero totalmente seguro después de su restauración. En esta ruta conocerás su origen, sabrás quién lo mandó construir y qué supuso su aparición para la provincia de Málaga.', '2019-12-10 21:29:20', 'GEO'),
(2, 3, 3, 'Vall de Nuria', 'Viajar no es llegar a un destino, sino abrir camin', 'Para todos aquellos a los que le gusta sentir el mundo bajo sus pies e ir paso a paso conociendo rincones inaccesibles y vivir la naturaleza de una forma directa y sin barreras esta es tu opción de viaje. Con diferentes niveles pasando del senderismo, accesible a cualquier público medianamente en forma, a los trekkings, sólo aptos para viajeros preparados física y técnicamente, nuestros viajes a pie son una garantía de sentir el mundo como siempre has soñado.', '2019-12-10 21:29:13', 'GEO'),
(3, 1, 3, 'Barrio Gótico de Barcelona', 'Descubre el Barrio Gótico de Barcelona y el encant', 'Sumérgete en la historia y admira los restos de la antigua muralla de Barcelona, las columnas de un templo romano, la catedral, antiguos palacios de reyes y obispos. El centro histórico del Barrio Gótico contiene diversos monumentos importantes, entre los que se incluyen el Saló del Tinell, la capilla de Santa Ágata y el palacio del Lloctinent: edificios góticos que formaban parte del palacio Mayor, la residencia de los reyes catalanes.', '2019-12-10 21:29:06', 'GEO'),
(4, 2, 3, 'Viaje a Marruecos con niños: Marrakech y la ruta d', 'Marruecos, la fascinante puerta de entrada a Afric', 'A menudo nos preguntamos si viajar en el desierto es un lugar seguro para los niños y niñas de nuestra familia. La respuesta, evidentemente dependerá de cada persona, pero en general y, por nuestra experiencia, el viaje con niños y niñas ha sido espectacular, siempre.\r\n    Para ellos ha sido una aventura extraordinaria. Han conocido paisajes muy distintos a los que están acostumbrados, han probado alimentos y comido otros sabores, han visto a niñas y niños de una cultura diferentes vivir de manera distinta a la suya, jugar por las calles, gritar, reír, llorar...\r\n    Además de la cultura y tradición que nos brinda todo el viaje al desierto, una vez llegamos a las dunas, hay un sentimiento de libertad en el ambiente. Horizonte de dunas donde tirarse en croqueta y volver a subir, correr entre las dunas sin la presencia de los adultos y volver al campamento, el aire que se respira en el lugar... y una vez llega la noche, miramos arriba y solamente vemos estrellas, un mundo nuevo, un infin', '2019-12-10 21:28:57', 'GEO'),
(5, 4, 1, 'Circuito en Autocar Semana Santa Capitales del Rei', 'Aprovecha esta Semana Santa para disfrutar de las ', 'DÍA 1. ORIGEN - ASTURIAS / AVILÉS\r\nSalida en dirección Asturias. Breves paradas en ruta. Almuerzo en el hotel o en restaurante. Por la tarde visita a Avilés con guía local, ciudad que conserva en su casco antiguo casas nobles, iglesias, plazas, calles y grandes parques, junto con un patrimonio cultural, en el que destacan el Museo de la historia Urbana y el Centro Niemeyer. Llegada al hotel, cena y alojamiento.\r\nDÍA 2. CANGAS DE ONÍS, COVADONGA / RIBADESELLA\r\nDesayuno. y salida a la que fue la primera capital del Reino Cristiano: Cangas de Onís, donde pasearemos por el famoso puente romano sobre el Sella, del que cuelga la Cruz de la Victoria. Continuamos hasta Covadonga, en cuyo recinto se encuentra la Basílica y la Santa Cueva, que alberga a la Virgen de Covadonga y la tumba del Rey Don Pelayo. Tiempo libre con posibilidad de subir a los Lagos de Covadonga (opcional). Almuerzo en restaurante. Por la tarde visitaremos Ribadesella, concejo turístico cuyo enclave en la desembocadura del', '2019-12-10 21:28:48', 'GEO'),
(6, 1, 3, 'Escape Room La puerta Màgica', 'El maestro August Bumbledore te desafía con una última prueba antes de darte tu varita oficial de mago. Para superarla, adéntrate en sus aposentos y e', 'El maestro August Bumbledore te desafía con una última prueba antes de darte tu varita oficial de mago. Para superarla, adéntrate en sus aposentos y encuentra la puerta mágica. Descubrirla será la prueba definitiva de que sois auténticos magos.', '2019-12-10 22:07:43', 'GEO');

INSERT INTO `media` (`id_image`, `id_trip`, `img_url_thumb`, `img_url_high`, `img_alt`) VALUES
(1, 2, 'foto03.jpg', 'foto03.jpg', 'Foto Vall de Nuria'),
(2, 3, 'foto04.jpg', 'foto04.jpg', 'Foto Barrio Gótico Barcelona'),
(3, 4, 'foto03.jpg', 'foto03.jpg', 'Foto viaje a Marruecos'),
(4, 5, 'foto04.jpg', 'foto04.jpg', 'Reino de Asturias'),
(5, 1, 'foto04.jpg', 'foto04.jpg', 'Camino del Rey'),
(6, 6, 'foto03.jpg', 'foto03.jpg', 'La puerta Magica');


INSERT INTO `categories` (`id_cat`, `cat_name`) VALUES
(1, 'Aventura'),
(2, 'Cultural'),
(3, 'Con niños'),
(4, 'Naturaleza'),
(5, 'Polar'),
(6, 'Semana Santa'),
(7, 'A pie'),
(8, 'Bicicleta');

INSERT INTO `trips_cat` (`id_trip`, `id_cat`) VALUES
(2, 1),
(2, 3),
(2, 4),
(2, 7),
(3, 2),
(3, 7),
(3, 8),
(4, 2),
(4, 3),
(5, 2),
(5, 4),
(5, 6);


INSERT INTO `ratings` (`id_trip`, `id_user`, `rate`) VALUES
(1, 5, 4),
(2, 3, 3),
(2, 5, 4),
(2, 12, 4),
(3, 3, 2),
(3, 6, 2),
(3, 10, 3),
(4, 5, 5),
(4, 7, 5),
(4, 8, 5),
(4, 9, 4),
(6, 3, 5),
(6, 7, 5);


COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
