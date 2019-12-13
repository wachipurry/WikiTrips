SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

CREATE DATABASE IF NOT EXISTS `wikitrips_5` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `wikitrips_5`;


DROP TABLE IF EXISTS `categories`;
CREATE TABLE `categories` (
  `id_cat` tinyint(1) NOT NULL,
  `cat_name` varchar(30) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `media`;
CREATE TABLE `media` (
  `id_image` int(4) NOT NULL,
  `id_trip` int(4) NOT NULL,
  `img_url_thumb` varchar(30) CHARACTER SET utf8 NOT NULL,
  `img_url_high` varchar(30) CHARACTER SET utf8 NOT NULL,
  `img_alt` varchar(30) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `pass`;
CREATE TABLE `pass` (
  `id_user` int(4) NOT NULL,
  `pass` varchar(200) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `ratings`;
CREATE TABLE `ratings` (
  `id_trip` int(4) NOT NULL,
  `id_user` int(4) NOT NULL,
  `rate` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `trips`;
CREATE TABLE `trips` (
  `id_trip` int(4) NOT NULL,
  `id_user` int(4) NOT NULL,
  `id_status` tinyint(1) NOT NULL,
  `title` varchar(50) NOT NULL,
  `summary` varchar(150) NOT NULL,
  `descr` varchar(1000) NOT NULL,
  `publish_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `geo` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `trips_cat`;
CREATE TABLE `trips_cat` (
  `id_trip` int(4) NOT NULL,
  `id_cat` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `trips_status`;
CREATE TABLE `trips_status` (
  `id_status` tinyint(1) NOT NULL,
  `status_name` varchar(15) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `user_details`;
CREATE TABLE `user_details` (
  `id_user` int(4) NOT NULL,
  `img_profile` varchar(100) CHARACTER SET utf8 NULL,
  `descr` varchar(100) CHARACTER SET utf8 NULL,
  `alias` varchar(30) CHARACTER SET utf8 NOT NULL,
  `id_status` tinyint(1) NOT NULL,
  `last_login` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `user_profile`;
CREATE TABLE `user_profile` (
  `id_user` int(4) NOT NULL,
  `treatment` varchar(5) CHARACTER SET utf8 NULL,
  `firstname` varchar(30) CHARACTER SET utf8 NOT NULL,
  `lastname` varchar(100) CHARACTER SET utf8 NOT NULL,
  `public_name` varchar(45) NOT NULL,
  `email` varchar(100) CHARACTER SET utf8 NOT NULL,
  `opt_in` tinyint(1) NOT NULL,
  `sign_up` timestamp NOT NULL DEFAULT current_timestamp(),
  `unsuscribed` date NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `user_status`;
CREATE TABLE `user_status` (
  `id_status` tinyint(1) NOT NULL,
  `status_name` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


/* definir PRIMARY KEY y posteriores FOREIGN KEY */


ALTER TABLE `categories`
  ADD PRIMARY KEY (`id_cat`);

ALTER TABLE `media`
  ADD PRIMARY KEY (`id_image`),
  ADD KEY `trip_fk2` (`id_trip`);

ALTER TABLE `pass`
  ADD PRIMARY KEY (`id_user`);

ALTER TABLE `ratings`
  ADD PRIMARY KEY (`id_trip`,`id_user`),
  ADD KEY `user_fk4` (`id_user`);

ALTER TABLE `trips`
  ADD PRIMARY KEY (`id_trip`),
  ADD KEY `status_fk2` (`id_status`),
  ADD KEY `user_fk3` (`id_user`);

ALTER TABLE `trips_cat`
  ADD PRIMARY KEY (`id_trip`,`id_cat`),
  ADD KEY `category_fk` (`id_cat`);

ALTER TABLE `trips_status`
  ADD PRIMARY KEY (`id_status`);

ALTER TABLE `user_details`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `alias` (`alias`),
  ADD KEY `status_fk1` (`id_status`);

ALTER TABLE `user_profile`
  ADD KEY `user_fk2` (`id_user`);

ALTER TABLE `user_status`
  ADD PRIMARY KEY (`id_status`);


/* definir AUTO_INCREMENT */


ALTER TABLE `categories`
  MODIFY `id_cat` tinyint(1) NOT NULL AUTO_INCREMENT;

ALTER TABLE `media`
  MODIFY `id_image` int(4) NOT NULL AUTO_INCREMENT;

ALTER TABLE `trips`
  MODIFY `id_trip` int(4) NOT NULL AUTO_INCREMENT;

ALTER TABLE `trips_status`
  MODIFY `id_status` tinyint(1) NOT NULL AUTO_INCREMENT;

ALTER TABLE `user_details`
  MODIFY `id_user` int(4) NOT NULL AUTO_INCREMENT;

ALTER TABLE `user_status`
  MODIFY `id_status` tinyint(1) NOT NULL AUTO_INCREMENT;


/* definir las REFERECES de las FOREIGN KEY */


ALTER TABLE `media`
  ADD CONSTRAINT `trip_fk2` FOREIGN KEY (`id_trip`) REFERENCES `trips` (`id_trip`) ON UPDATE CASCADE;

ALTER TABLE `pass`
  ADD CONSTRAINT `user_fk1` FOREIGN KEY (`id_user`) REFERENCES `user_details` (`id_user`);

ALTER TABLE `ratings`
  ADD CONSTRAINT `trip_fk4` FOREIGN KEY (`id_trip`) REFERENCES `trips` (`id_trip`) ON UPDATE CASCADE,
  ADD CONSTRAINT `user_fk4` FOREIGN KEY (`id_user`) REFERENCES `user_details` (`id_user`) ON UPDATE CASCADE;

ALTER TABLE `trips`
  ADD CONSTRAINT `status_fk2` FOREIGN KEY (`id_status`) REFERENCES `trips_status` (`id_status`) ON UPDATE CASCADE,
  ADD CONSTRAINT `user_fk3` FOREIGN KEY (`id_user`) REFERENCES `user_details` (`id_user`) ON UPDATE CASCADE;

ALTER TABLE `trips_cat`
  ADD CONSTRAINT `category_fk` FOREIGN KEY (`id_cat`) REFERENCES `categories` (`id_cat`) ON UPDATE CASCADE,
  ADD CONSTRAINT `trip_fk1` FOREIGN KEY (`id_trip`) REFERENCES `trips` (`id_trip`) ON UPDATE CASCADE;

ALTER TABLE `user_details`
  ADD CONSTRAINT `status_fk1` FOREIGN KEY (`id_status`) REFERENCES `user_status` (`id_status`) ON UPDATE CASCADE;

ALTER TABLE `user_profile`
  ADD CONSTRAINT `user_fk2` FOREIGN KEY (`id_user`) REFERENCES `user_details` (`id_user`) ON UPDATE CASCADE;
COMMIT;


/* CREAR VISTAS */


CREATE VIEW featured_trips_0 AS 
    SELECT
      id_trip AS trip_id,
      title AS trip_name,
      summary AS trip_resum,
      img_url_thumb AS trip_thumb
      FROM trips
    JOIN media USING (id_trip);

CREATE VIEW featured_trips_1 AS
    SELECT
      id_trip AS trip_id,
      title AS trip_name,
      img_url_thumb AS trip_thumb,
      avg(rate) AS trip_rate
    FROM trips
    JOIN media USING (id_trip)
    JOIN ratings USING (id_trip)
    GROUP BY id_trip;


CREATE VIEW trip_categories AS
    SELECT cat_name FROM categories
    JOIN trips_cat USING (id_cat);



/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
