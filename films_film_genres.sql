CREATE TABLE films.film_genres
(
    film_id int(10) unsigned NOT NULL,
    genre_id int(10) unsigned NOT NULL,
    CONSTRAINT `PRIMARY` PRIMARY KEY (film_id, genre_id),
    CONSTRAINT film_genres_ibfk_1 FOREIGN KEY (film_id) REFERENCES films.films (id),
    CONSTRAINT film_genres_ibfk_2 FOREIGN KEY (genre_id) REFERENCES films.genres (id)
);
CREATE INDEX genre_id ON films.film_genres (genre_id);
INSERT INTO films.film_genres (film_id, genre_id) VALUES (1, 2);
INSERT INTO films.film_genres (film_id, genre_id) VALUES (1, 4);
INSERT INTO films.film_genres (film_id, genre_id) VALUES (2, 6);
INSERT INTO films.film_genres (film_id, genre_id) VALUES (3, 1);
INSERT INTO films.film_genres (film_id, genre_id) VALUES (3, 4);
INSERT INTO films.film_genres (film_id, genre_id) VALUES (4, 3);
INSERT INTO films.film_genres (film_id, genre_id) VALUES (5, 2);
INSERT INTO films.film_genres (film_id, genre_id) VALUES (5, 6);
CREATE TABLE films.films
(
    id int(10) unsigned PRIMARY KEY NOT NULL AUTO_INCREMENT,
    name varchar(255) NOT NULL,
    year smallint(6) NOT NULL,
    user_id int(10) unsigned NOT NULL,
    CONSTRAINT films_ibfk_1 FOREIGN KEY (user_id) REFERENCES films.users (id)
);
CREATE INDEX user_id ON films.films (user_id);
INSERT INTO films.films (name, year, user_id) VALUES ('film1', 1999, 1);
INSERT INTO films.films (name, year, user_id) VALUES ('film2', 2001, 1);
INSERT INTO films.films (name, year, user_id) VALUES ('film3', 2002, 2);
INSERT INTO films.films (name, year, user_id) VALUES ('film4', 2000, 2);
INSERT INTO films.films (name, year, user_id) VALUES ('film5', 2006, 3);
CREATE TABLE films.genres
(
    id int(10) unsigned PRIMARY KEY NOT NULL AUTO_INCREMENT,
    name varchar(255) NOT NULL
);
CREATE UNIQUE INDEX name ON films.genres (name);
INSERT INTO films.genres (name) VALUES ('action');
INSERT INTO films.genres (name) VALUES ('comedy');
INSERT INTO films.genres (name) VALUES ('drama');
INSERT INTO films.genres (name) VALUES ('fantasy');
INSERT INTO films.genres (name) VALUES ('horror');
INSERT INTO films.genres (name) VALUES ('thriller');
CREATE TABLE films.users
(
    id int(10) unsigned PRIMARY KEY NOT NULL AUTO_INCREMENT,
    login varchar(255) NOT NULL,
    pass varchar(255) NOT NULL
);
CREATE UNIQUE INDEX login ON films.users (login);
INSERT INTO films.users (login, pass) VALUES ('vasia', '0000');
INSERT INTO films.users (login, pass) VALUES ('petya', '1111');
INSERT INTO films.users (login, pass) VALUES ('ivan', '2222');
INSERT INTO films.users (login, pass) VALUES ('qqqq', '3bad6af0fa4b8b330d162e19938ee981');