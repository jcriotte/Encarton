CREATE DATABASE encarton;

USE encarton;

DROP TABLE releases;
DROP TABLE album;
DROP TABLE artist;


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
FOREIGN KEY (artist_id) REFERENCES artist(id) ON DELETE CASCADE,
year INT
);

CREATE TABLE releases
(
id INT PRIMARY KEY NOT NULL,
album_id INT NOT NULL,
FOREIGN KEY (album_id) REFERENCES album(id) ON DELETE CASCADE,
support VARCHAR(3),
year INT,
picture VARCHAR(255),
deezer_url VARCHAR(255)
);

SELECT * FROM album;
SELECT * FROM artist;
SELECT * FROM releases;

SELECT * FROM artist ar JOIN album al ON ar.id = al.artist_id JOIN releases re ON al.id = re.album_id WHERE re.id = 196898;


DELETE FROM artist WHERE id>0;