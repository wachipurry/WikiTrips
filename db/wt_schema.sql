SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

USE a19rogcalrul_wikitrips;

/*TABLAS DE USUARIOS*/

DROP TABLE IF EXISTS user_status;
CREATE TABLE user_status (
  id_status tinyint(1) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  status_name varchar(15) NOT NULL
) ENGINE=InnoDB;

DROP TABLE IF EXISTS user_details;
CREATE TABLE user_details (
  id_user int(4) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  img_profile varchar(100) DEFAULT NULL,
  descr varchar(100)  DEFAULT NULL,
  alias varchar(30) NOT NULL UNIQUE,
  id_status tinyint(1) NOT NULL,
  last_login date NOT NULL,
  CONSTRAINT status_fk1 FOREIGN KEY (id_status) REFERENCES user_status (id_status) ON UPDATE CASCADE
) ENGINE=InnoDB;

DROP TABLE IF EXISTS user_profile;
CREATE TABLE user_profile (
  id_user int(4) NOT NULL,
  treatment varchar(5) DEFAULT NULL,
  firstname varchar(30) NOT NULL,
  lastname varchar(100) NOT NULL,
  email varchar(100) NOT NULL,
  opt_in tinyint(1) NOT NULL,
  sign_up timestamp NOT NULL DEFAULT current_timestamp(),
  unsuscribed date DEFAULT NULL,
  CONSTRAINT user_fk1 FOREIGN KEY (id_user) REFERENCES user_details (id_user) ON UPDATE CASCADE
) ENGINE=InnoDB;

DROP TABLE IF EXISTS pass;
CREATE TABLE pass (
  id_user int(4) NOT NULL PRIMARY KEY,
  pass varchar(200) NOT NULL,
  CONSTRAINT user_fk2 FOREIGN KEY (id_user) REFERENCES user_details (id_user)
) ENGINE=InnoDB;

/*TABLAS DE EXPERIENCIAS*/

DROP TABLE IF EXISTS trips_status;
CREATE TABLE trips_status (
  id_status tinyint(1) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  status_name varchar(15) NOT NULL
) ENGINE=InnoDB;

DROP TABLE IF EXISTS trips;
CREATE TABLE trips (
  id_trip int(4) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  id_user int(4) NOT NULL,
  id_status tinyint(1) NOT NULL,
  title varchar(50) NOT NULL,
  summary varchar(150) NOT NULL,
  descr varchar(1000) NOT NULL,
  publish_date timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  geo varchar(200) NOT NULL,
  CONSTRAINT status_fk2 FOREIGN KEY (id_status) REFERENCES trips_status (id_status) ON UPDATE CASCADE,
  CONSTRAINT user_fk3 FOREIGN KEY (id_user) REFERENCES user_details (id_user) ON UPDATE CASCADE
) ENGINE=InnoDB;

DROP TABLE IF EXISTS media;
CREATE TABLE media (
  id_image int(4) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  id_trip int(4) NOT NULL,
  img_url_thumb varchar(30) NOT NULL,
  img_url_high varchar(30) NOT NULL,
  img_alt varchar(30) NOT NULL,
  CONSTRAINT trip_fk1 FOREIGN KEY (id_trip) REFERENCES trips (id_trip) ON UPDATE CASCADE
) ENGINE=InnoDB;

/*TABLAS VINCULADAS A EXPERIENCIAS*/

DROP TABLE IF EXISTS categories;
CREATE TABLE categories (
  id_cat tinyint(1) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  cat_name varchar(30) NOT NULL
) ENGINE=InnoDB;

DROP TABLE IF EXISTS trips_cat;
CREATE TABLE trips_cat (
  id_trip int(4) NOT NULL,
  id_cat tinyint(1) NOT NULL,
  PRIMARY KEY (id_trip,id_cat),
  CONSTRAINT category_fk FOREIGN KEY (id_cat) REFERENCES categories (id_cat) ON UPDATE CASCADE,
  CONSTRAINT trip_fk2 FOREIGN KEY (id_trip) REFERENCES trips (id_trip) ON UPDATE CASCADE
) ENGINE=InnoDB;


DROP TABLE IF EXISTS ratings;
CREATE TABLE ratings (
  id_trip int(4) NOT NULL,
  id_user int(4) NOT NULL,
  rate tinyint(1) NOT NULL,
  PRIMARY KEY (id_trip,id_user),
  CONSTRAINT trip_fk3 FOREIGN KEY (id_trip) REFERENCES trips (id_trip) ON UPDATE CASCADE,
  CONSTRAINT user_fk4 FOREIGN KEY (id_user) REFERENCES user_details (id_user) ON UPDATE CASCADE
) ENGINE=InnoDB;


COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
