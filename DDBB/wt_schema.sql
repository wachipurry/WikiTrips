SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

CREATE DATABASE IF NOT EXISTS wikitrips_2 DEFAULT CHARACTER SET utf8 COLLATE utf8_spanish_ci;
USE wikitrips_2;

/*TABLAS DE USUARIOS*/

DROP TABLE IF EXISTS user_status;
CREATE TABLE user_status (
  id_status tinyint(1) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  status_name varchar(15) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

DROP TABLE IF EXISTS user_details;
CREATE TABLE user_details (
  id_user int(4) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  img_profile varchar(100) CHARACTER SET utf8  COLLATE utf8_spanish_ci DEFAULT NULL,
  descr varchar(100) CHARACTER SET utf8  COLLATE utf8_spanish_ci DEFAULT NULL,
  alias varchar(30) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL UNIQUE,
  id_status tinyint(1) NOT NULL,
  last_login date NOT NULL,
  CONSTRAINT status_fk1 FOREIGN KEY (id_status) REFERENCES user_status (id_status) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

DROP TABLE IF EXISTS user_profile;
CREATE TABLE user_profile (
  id_user int(4) NOT NULL,
  treatment varchar(5) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  firstname varchar(30) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  lastname varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  email varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  opt_in tinyint(1) NOT NULL,
  sign_up timestamp NOT NULL DEFAULT current_timestamp(),
  unsuscribed date DEFAULT NULL,
  CONSTRAINT user_fk1 FOREIGN KEY (id_user) REFERENCES user_details (id_user) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

DROP TABLE IF EXISTS pass;
CREATE TABLE pass (
  id_user int(4) NOT NULL PRIMARY KEY,
  pass varchar(200) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  CONSTRAINT user_fk2 FOREIGN KEY (id_user) REFERENCES user_details (id_user)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

/*TABLAS DE EXPERIENCIAS*/

DROP TABLE IF EXISTS trips_status;
CREATE TABLE trips_status (
  id_status tinyint(1) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  status_name varchar(15) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

DROP TABLE IF EXISTS trips;
CREATE TABLE trips (
  id_trip int(4) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  id_user int(4) NOT NULL,
  id_status tinyint(1) NOT NULL,
  title varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  summary varchar(150) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  descr varchar(1000) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  publish_date timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  geo varchar(200) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  CONSTRAINT status_fk2 FOREIGN KEY (id_status) REFERENCES trips_status (id_status) ON UPDATE CASCADE,
  CONSTRAINT user_fk3 FOREIGN KEY (id_user) REFERENCES user_details (id_user) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

DROP TABLE IF EXISTS media;
CREATE TABLE media (
  id_image int(4) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  id_trip int(4) NOT NULL,
  img_url_thumb varchar(30) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  img_url_high varchar(30) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  img_alt varchar(30) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  CONSTRAINT trip_fk1 FOREIGN KEY (id_trip) REFERENCES trips (id_trip) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

/*TABLAS VINCULADAS A EXPERIENCIAS*/

DROP TABLE IF EXISTS categories;
CREATE TABLE categories (
  id_cat tinyint(1) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  cat_name varchar(30) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

DROP TABLE IF EXISTS trips_cat;
CREATE TABLE trips_cat (
  id_trip int(4) NOT NULL,
  id_cat tinyint(1) NOT NULL,
  PRIMARY KEY (id_trip,id_cat),
  CONSTRAINT category_fk FOREIGN KEY (id_cat) REFERENCES categories (id_cat) ON UPDATE CASCADE,
  CONSTRAINT trip_fk2 FOREIGN KEY (id_trip) REFERENCES trips (id_trip) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;


DROP TABLE IF EXISTS ratings;
CREATE TABLE ratings (
  id_trip int(4) NOT NULL,
  id_user int(4) NOT NULL,
  rate tinyint(1) NOT NULL,
  PRIMARY KEY (id_trip,id_user),
  CONSTRAINT trip_fk3 FOREIGN KEY (id_trip) REFERENCES trips (id_trip) ON UPDATE CASCADE,
  CONSTRAINT user_fk4 FOREIGN KEY (id_user) REFERENCES user_details (id_user) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;


COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
