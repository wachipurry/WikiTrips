use wikitrips;

INSERT INTO categories (title) VALUES ("Aventura"), ("Cultural"),("Con niños"), ("Naturaleza"), ("Polar"), ("Semana Santa"), ("A pie"),("Bicicleta");

INSERT INTO user_details (img_profile, descr, alias, id_status) VALUES
    ("https://picsum.photos/200/300?random=1", "Soy artista 3d, me gusta la magia, la nieve, los deportes de contacto y siempre me propongo metas a alcanzar.", "capitan", 4),
    ("https://picsum.photos/200/300?random=1", "Me encantan las charlas apasionadas, regocijantes y divertidas. Me gusta la montaña y conocer gente nueva", "manuela88", 4),
    ("https://picsum.photos/200/300?random=1", "Mi entorno dice que soy una persona maravillosa. Me encanta ir en bicicleta y perderme en lugares desconocidos", "angelita", 4),
    ("https://picsum.photos/200/300?random=1", "Amante de la arquitectura y museos. ", "marccc", 4),

    ("https://picsum.photos/200/300?random=1", "Descripcion 5", "pepe5555", 4),
    ("https://picsum.photos/200/300?random=1", "Descripcion 6", "diana6666", 4),
    ("https://picsum.photos/200/300?random=1", "Mi perfil 7", "carla7777", 4),
    ("https://picsum.photos/200/300?random=1", "Amante de la cultura y museos. ", "anton8888", 4),
    ("https://picsum.photos/200/300?random=1", "Descripcion 9", "carles9999", 4),
    ("https://picsum.photos/200/300?random=1", "Descripcion 10", "celia1010", 4),
    ("https://picsum.photos/200/300?random=1", "Mi perfil 11", "sara1111", 4),
    ("https://picsum.photos/200/300?random=1", "Fan de la natura y senderismo. ", "jordi1212", 4);    

     
INSERT INTO user_profile (id_user, treatment, usr_name, surnames, email, opt_in) VALUES
    (1, "Sr.", "Antonio", "Sánchez", "antonio_s@gmail.com", true ),
    (2, "Sra.", "Manuela", "Ramos", "manuelaramos@gmail.com", true ),
    (3, "Sra.", "Ángela", "López", "angelita@gmail.com", true ),
    (4, "Sr.", "Marc", "García", "marcus7@gmail.com", true ),

    (5, "Sr.", "Pepe", "Ruiz", "pep.r123@gmail.com", true ),
    (6, "Sra.", "Diana", "Gutierrez", "diana_guti@gmail.com", true ),
    (7, "Sra.", "Carla", "Puig", "c.puig555@gmail.com", true ),
    (8, "Sr.", "Anton", "Serra", "a.serra@gmail.com", true ),
    (9, "Sr.", "Carles", "Sanz", "qdicescharlyio@gmail.com", true ),
    (10, "Sra.", "Celia", "Perez", "celia222@gmail.com", true ),
    (11, "Sra.", "Sara", "López", "sarita1989@gmail.com", true ),
    (12, "Sr.", "Jordi", "Martí", "jordi7@gmail.com", true );

INSERT INTO trips (id_user, id_status, title, summary, descr, geo) VALUES
    (3, 3, "Vall de Nuria", "Viajar no es llegar a un destino, sino abrir camino.", "Para todos aquellos a los que le gusta sentir el mundo bajo sus pies e ir paso a paso conociendo rincones inaccesibles y vivir la naturaleza de una forma directa y sin barreras esta es tu opción de viaje. Con diferentes niveles pasando del senderismo, accesible a cualquier público medianamente en forma, a los trekkings, sólo aptos para viajeros preparados física y técnicamente, nuestros viajes a pie son una garantía de sentir el mundo como siempre has soñado.", "GEO"),
    (1,2, "Barrio Gótico de Barcelona", "Descubre el Barrio Gótico de Barcelona y el encanto de sus calles, plazas y rincones ocultos", "Sumérgete en la historia y admira los restos de la antigua muralla de Barcelona, las columnas de un templo romano, la catedral, antiguos palacios de reyes y obispos. El centro histórico del Barrio Gótico contiene diversos monumentos importantes, entre los que se incluyen el Saló del Tinell, la capilla de Santa Ágata y el palacio del Lloctinent: edificios góticos que formaban parte del palacio Mayor, la residencia de los reyes catalanes.", "GEO" ),
    (2, 1, "Viaje a Marruecos con niños: Marrakech y la ruta de las Kasbash ", 
    "Marruecos, la fascinante puerta de entrada a Africa. ",
    "A menudo nos preguntamos si viajar en el desierto es un lugar seguro para los niños y niñas de nuestra familia. La respuesta, evidentemente dependerá de cada persona, pero en general y, por nuestra experiencia, el viaje con niños y niñas ha sido espectacular, siempre.
    Para ellos ha sido una aventura extraordinaria. Han conocido paisajes muy distintos a los que están acostumbrados, han probado alimentos y comido otros sabores, han visto a niñas y niños de una cultura diferentes vivir de manera distinta a la suya, jugar por las calles, gritar, reír, llorar...
    Además de la cultura y tradición que nos brinda todo el viaje al desierto, una vez llegamos a las dunas, hay un sentimiento de libertad en el ambiente. Horizonte de dunas donde tirarse en croqueta y volver a subir, correr entre las dunas sin la presencia de los adultos y volver al campamento, el aire que se respira en el lugar... y una vez llega la noche, miramos arriba y solamente vemos estrellas, un mundo nuevo, un infinito estelar, sentimiento de paz.",
    "GEO"),
    (3, 3, "Circuito en Autocar Semana Santa Capitales del Reino de Asturias", "Aprovecha esta Semana Santa para disfrutar de las Capitales del Reino de Asturias", "DÍA 1. ORIGEN - ASTURIAS / AVILÉS
Salida en dirección Asturias. Breves paradas en ruta. Almuerzo en el hotel o en restaurante. Por la tarde visita a Avilés con guía local, ciudad que conserva en su casco antiguo casas nobles, iglesias, plazas, calles y grandes parques, junto con un patrimonio cultural, en el que destacan el Museo de la historia Urbana y el Centro Niemeyer. Llegada al hotel, cena y alojamiento.
DÍA 2. CANGAS DE ONÍS, COVADONGA / RIBADESELLA
Desayuno. y salida a la que fue la primera capital del Reino Cristiano: Cangas de Onís, donde pasearemos por el famoso puente romano sobre el Sella, del que cuelga la Cruz de la Victoria. Continuamos hasta Covadonga, en cuyo recinto se encuentra la Basílica y la Santa Cueva, que alberga a la Virgen de Covadonga y la tumba del Rey Don Pelayo. Tiempo libre con posibilidad de subir a los Lagos de Covadonga (opcional). Almuerzo en restaurante. Por la tarde visitaremos Ribadesella, concejo turístico cuyo enclave en la desembocadura del río Sella ofrece una especial vista panorámica. Además es esta una zona de vestigios de la época jurásica y prehistórica. De vuelta visitaremos una sidrería con degustación de un “culín”. Regreso al hotel, cena y alojamiento.
DÍA 3. OVIEDO / GIJÓN
Desayuno. Por la mañana visitaremos Oviedo, donde, con guía local, conoceremos la capital de Asturias. Realizaremos una panorámica por la ciudad pasando por emblemáticos puntos, como el Palacio de Congresos, el Campo de San Francisco, el Teatro Campoamor, donde se realiza la entrega de los Premios Princesa de Asturias, y la Catedral, entre otros. Almuerzo en restaurante.
Por la tarde visita guiada a Gijón, conocida por su patrimonio marítimo y el viejo barrio de pescadores de Cimadevilla. Conoceremos además, el puerto deportivo, la Casa Jovellanos, el Ayuntamiento, la playa de San Lorenzo, etc. Otros lugares de interés son: el cerro de Santa Catalina, que cuenta con un parque y una escultura en el acantilado; El palacio de Revillagigedo, del s.XVIII, contiguo a la colegiata de San Juan Bautista, o el campanario del s.XVI que acoge un museo sobre la ciudad. Regreso al hotel, cena y alojamiento.
DÍA 4. COMARCA DE LA MINERÍA - ORIGEN
Desayuno. Salida para visitar el Museo de la Minería y la Industria, MUMI (entrada incluida), donde tendremos la oportunidad de descender en la 'jaula' (ascensor minero) 600 m. tierra adentro hasta llegar a la mina, un paseo de casi 1000 m. para conocer, a través de distintas recreaciones, los aspectos más signifi cativos del arranque y extracción del carbón, los tipos de soportes utilizados en galerías y el transporte interior. Dotados de equipamiento real, nos sentiremos como mineros recorriendo sus galerías y talleres. Almuerzo en el hotel o en restaurante. Salida hacia el lugar de origen, breves paradas en ruta, llegada y fin de nuestros servicios.
NOTA: el orden de las excursiones podrá ser modificado sin afectar a su contenido. ", "GEO") ;

INSERT INTO media (id_trip, img_url_thumb, img_url_high, img_alt) VALUES 
(1, "https://picsum.photos/300/200?random=1" ,"https://picsum.photos/800/500?random=1", "Foto Vall de Nuria" ),
(2, "https://picsum.photos/300/200?random=1" ,"https://picsum.photos/800/500?random=1", "Foto Barrio Gótico Barcelona" ),
(3, "https://picsum.photos/300/200?random=1" ,"https://picsum.photos/800/500?random=1", "Foto viaje a Marruecos" ),
(4, "https://picsum.photos/300/200?random=1" ,"https://picsum.photos/800/500?random=1", "Reino de Asturias" );


INSERT INTO wt_status (status_name) VALUES 
("borrador"),
("pendiente"),
("publico"),
("reportado"),
("no_publico"),
("activo"),
("baneado"),
("baja")