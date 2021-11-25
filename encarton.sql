CREATE DATABASE encarton;

USE encarton;

CREATE TABLE artist
(
id INT PRIMARY KEY NOT NULL,
name VARCHAR(63) NOT NULL,
picture VARCHAR(255)
);

CREATE TABLE album
(
id INT PRIMARY KEY NOT NULL, 
title VARCHAR(127),
artist_id INT NOT NULL,
FOREIGN KEY (artist_id) REFERENCES artist(id),
year INT
);

CREATE TABLE releases
(
id INT PRIMARY KEY NOT NULL,
album_id INT NOT NULL,
FOREIGN KEY (album_id) REFERENCES album(id),
support VARCHAR(3),
year INT,
picture VARCHAR(255),
deezer_url VARCHAR(255)
);