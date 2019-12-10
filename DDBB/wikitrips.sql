CREATE DATABASE wikitrips;

use wikitrips;


CREATE TABLE categories(
    id_cat INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(30)
);

CREATE TABLE user_details(
    id_user INT AUTO_INCREMENT PRIMARY KEY,
    img_profile VARCHAR(100) NOT NULL,
    descr VARCHAR(100) NOT NULL,
    alias VARCHAR(30) NOT NULL UNIQUE,
    id_status TINYINT NOT NULL,
    last_login DATE NOT NULL,
);

CREATE TABLE user_profile(
    id_user INT ,
    treatment VARCHAR(5),
    usr_name VARCHAR(30) NOT NULL,
    surnames VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    opt_in BOOLEAN NOT NULL,
    sign_up TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    unsuscribed DATE,
    FOREIGN KEY (id_user) REFERENCES user_details(id_user)
);


CREATE TABLE trips(
    id_trip INT AUTO_INCREMENT PRIMARY KEY,
    id_user INT NOT NULL,
    id_status TINYINT NOT NULL, 
    title VARCHAR(50) NOT NULL,
    summary VARCHAR(50) NOT NULL,
    descr VARCHAR(1000) NOT NULL,
    publish_date TIMESTAMP,
    geo VARCHAR(200) NOT NULL,
    FOREIGN KEY(id_user) REFERENCES user_details(id_user)
);


CREATE TABLE trips_cat(
    id_trip INT ,
    id_cat INT,
    FOREIGN KEY (id_trip) REFERENCES trips(id_trip),
    FOREIGN KEY (id_cat) REFERENCES categories(id_cat)
);

CREATE TABLE media(
    id_image INT AUTO_INCREMENT PRIMARY KEY, 
    id_trip INT ,
    img_url_thumb VARCHAR(30),
    img_url_high VARCHAR(30),
    img_alt VARCHAR(30),
    FOREIGN KEY (id_trip) REFERENCES trips(id_trip)
);

CREATE TABLE pass(
    id_user INT,
    pass VARCHAR(200) NOT NULL,
    FOREIGN KEY(id_user) REFERENCES user_details(id_user)
);