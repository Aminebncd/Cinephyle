












-- CREATION DE LA BDD
CREATE DATABASE `Cinema Amine` /*!40100 COLLATE 'utf8mb4_bin' */

CREATE TABLE Personne(
   id_personne INT AUTO_INCREMENT,
   nom VARCHAR(50),
   prenom VARCHAR(50),
   sexe VARCHAR(50),
   date_naissance DATE,
   PRIMARY KEY(id_personne)
);

CREATE TABLE Genre(
   id_genre INT AUTO_INCREMENT,
   libelle VARCHAR(50),
   PRIMARY KEY(id_genre)
);

CREATE TABLE Realisateur(
   id_real INT AUTO_INCREMENT,
   id_personne INT NOT NULL,
   PRIMARY KEY(id_real),
   UNIQUE(id_personne),
   FOREIGN KEY(id_personne) REFERENCES Personne(id_personne)
);

CREATE TABLE Acteur(
   id_acteur INT AUTO_INCREMENT,
   id_personne INT NOT NULL,
   PRIMARY KEY(id_acteur),
   UNIQUE(id_personne),
   FOREIGN KEY(id_personne) REFERENCES Personne(id_personne)
);

CREATE TABLE Role(
   id_role INT AUTO_INCREMENT,
   role VARCHAR(50),
   PRIMARY KEY(id_role)
);

CREATE TABLE Film(
   id_film INT AUTO_INCREMENT,
   titre VARCHAR(255),
   date_sortie_france DATE,
   duree INT,
   resume TEXT,
   note INT,
   affiche VARCHAR(255),
   id_real INT NOT NULL,
   PRIMARY KEY(id_film),
   FOREIGN KEY(id_real) REFERENCES Realisateur(id_real)
);

CREATE TABLE categorise(
   id_film INT,
   id_genre INT,
   PRIMARY KEY(id_film, id_genre),
   FOREIGN KEY(id_film) REFERENCES Film(id_film),
   FOREIGN KEY(id_genre) REFERENCES Genre(id_genre)
);

CREATE TABLE casting(
   id_film INT,
   id_acteur INT,
   id_role INT,
   PRIMARY KEY(id_film, id_acteur, id_role),
   FOREIGN KEY(id_film) REFERENCES Film(id_film),
   FOREIGN KEY(id_acteur) REFERENCES Acteur(id_acteur),
   FOREIGN KEY(id_role) REFERENCES Role(id_role)
);


























-- REMPLISSAGE DE MA BDD
-- Ajout de personnes
INSERT INTO Personne (nom, prenom, sexe, date_naissance) VALUES
('De Niro', 'Robert', 'Homme', '1943-08-17'),
('Pacino', 'Alfred "Al"','Homme', '1940-04-25'),
('Brando', 'Marlon','Homme', '1923-04-03'),
('Mortensen', 'Viggo','Homme', '1958-10-20'),
('Liotta', 'Ray','Homme', '1954-12-18'),

('Coppola', 'Francis Ford','Homme', '1939-04-07'),
('Scorcesse', 'Martin','Homme', '1942-11-17'),
('Farrely', 'Peter','Homme', '1956-12-17'),
('Mann', 'Michael','Homme', '1943-02-05');



-- Ajout de réalisateurs
INSERT INTO Realisateur (id_personne) VALUES
(6),
(7),
(8),
(9);


-- Ajout d'acteurs
INSERT INTO Acteur (id_personne) VALUES
(1),
(2),
(3),
(4),
(5);

-- Attribution des rôles aux acteurs dans les films
INSERT INTO casting (id_film, id_acteur, id_role) VALUES

(1, 1, 1),
(2, 1, 2),

(1, 2, 3),
(3, 2, 4),

(3, 3, 5),

(4, 4, 6),

(2, 5, 7);


-- Ajout de rôles
INSERT INTO Role (role) VALUES
-- De niro
('Neil McCauley'), 
('Jimmy Conway'),
-- Al Pac
('Lieutenant Vincent Hanna'),
('Michael Corleone'),
-- Marlon
('Vito Corleone'),
-- Viggo
('Frank "Tony Lip" Vallelonga'),
-- Ray li
('Henry Hill');

-- Ajout de films
INSERT INTO Film (titre, date_sortie_france, duree, resume, note, affiche, id_real) VALUES

('Heat', '1996-02-21', 171, 'Heat (ou Tension au Québec) est un film policier américain écrit et réalisé par Michael Mann, sorti en 1995.

Avec, dans les rôles principaux, Robert De Niro, Al Pacino, Val Kilmer et Tom Sizemore, Heat met en scène la confrontation des personnages de Neil McCauley (Robert De Niro) et Vincent Hanna (Al Pacino), respectivement un chef d équipe de braqueurs professionnels et un lieutenant de police opiniâtre, qui se livrent une lutte à distance et voient leurs vies privées et professionnelles se lier inéluctablement, jusqu à leur confrontation finale.', 8.5, 'Heat.jpg', 4),

('Les Affranchis', '1990-09-12', 146, 'Dans les années 1950, à Brooklyn, le jeune Henry Hill a l occasion de réaliser son rêve : devenir gangster lorsqu un caïd local l intègre à son équipe. C est alors qu il rencontre James et Tommy, 2 truands d une rare brutalité. Impressionné, Henry s associe avec eux pour débuter un trafic très lucratif. Lorsqu il séduit la ravissante Karen, le jeune mafieux s imagine que plus rien ni personne ne pourra jamais lui résister.', 8, 'Goodfellas.jpg', 2),

('Le Parrain', '1972-10-18', 175, 'En 1945, à New York, les Corleone sont une des 5 familles de la mafia. Don Vito Corleone, parrain de cette famille, marie sa fille à un bookmaker. Sollozzo, parrain de la famille Tattaglia, propose à Don Vito une association dans le trafic de drogue, mais celui-ci refuse.

 Sonny, un de ses fils, y est quant à lui favorable. Afin de traiter avec Sonny, Sollozzo tente de faire tuer Don Vito, mais celui-ci en réchappe.', 9, 'Godfather.jpg', 1),

('Green Book : Sur les routes du Sud', '2019-01-23', 130, 'En 1962, alors que règne la ségrégation, Tony Lip, un videur italo-américain du Bronx, est engagé pour conduire et protéger le Dr Don Shirley, un pianiste noir de renommée mondiale, lors d une tournée de concerts. Durant leur périple de Manhattan jusqu au Sud profond, ils doivent se confronter aux humiliations, perceptions et persécutions, tout en devant trouver des établissements accueillant les personnes de couleurs.', 8, 'GreenBook.jpg', 3),

-- Ajout de genres
INSERT INTO Genre (libelle) VALUES
('Action'),
('Comédie'),
('Drame'),
('Mafia'),
('Police');

-- Liaison des films avec des genres
INSERT INTO categorise (id_film, id_genre) VALUES
(1, 1), 
(1, 5), 
(1, 3), 
(2, 2),
(3, 4), 
(3, 3), 
(4, 3), 
(4, 2);







-- A. Informations d’un film (id_film) : titre, année, durée (au format HH:MM) et réalisateur


SELECT titre, 
date_sortie_france,
 
CONCAT(
    LPAD(FLOOR(duree / 60), 2, '0'), 
    'h', 
    LPAD(duree % 60, 2, '0')
  ) AS duree_formatée, 
  CONCAT (
	  prenom, ' ', nom
	  ) AS réalisateur
   
FROM film

INNER JOIN realisateur ON film.id_real = realisateur.id_real
INNER JOIN personne ON realisateur.id_personne = personne.id_personne





-- B. Liste des films dont la durée excède 2h15 classés par durée (du + long au + court

SELECT * 
FROM film
WHERE duree > 135
ORDER BY duree DESC





-- C. Liste des films d’un réalisateur (en précisant l’année de sortie)

SELECT CONCAT (nom , ' ' , prenom) AS realisateur, titre, date_sortie_france
FROM film

INNER JOIN realisateur ON film.id_real=realisateur.id_real
INNER JOIN personne ON realisateur.id_personne=personne.id_personne

WHERE personne.nom LIKE 'Coppola'






-- D. Nombre de films par genre (classés dans l’ordre décroissant)

SELECT COUNT(*) AS nombre_de_films, libelle

FROM genre

INNER JOIN categorise ON genre.id_genre=categorise.id_genre

GROUP BY genre.id_genre
ORDER BY nombre_de_films desc





-- E. Nombre de films par réalisateur (classés dans l’ordre décroissant)

SELECT COUNT(*) AS nombre_de_films, CONCAT (nom , ' ' , prenom) AS realisateur

FROM film

INNER JOIN realisateur ON film.id_real=realisateur.id_real
INNER JOIN personne ON realisateur.id_personne=personne.id_personne

GROUP BY film.id_film
ORDER BY nombre_de_films desc






-- F. Casting d’un film en particulier (id_film) : nom, prénom des acteurs + sexe


SELECT film.id_film, titre, CONCAT(prenom, ' ',nom) AS acteurs, sexe
FROM film

INNER JOIN casting ON film.id_film = casting.id_film
INNER JOIN acteur ON casting.id_acteur = acteur.id_acteur
INNER JOIN personne ON acteur.id_personne = personne.id_personne

WHERE film.id_film LIKE 1






-- G. Films tournés par un acteur en particulier (id_acteur) avec leur rôle et l’année de sortie (du film le plus récent au plus ancien)


SELECT film.id_film, CONCAT(prenom, ' ',nom) AS acteur, titre, role, date_sortie_france
FROM film

INNER JOIN casting ON film.id_film = casting.id_film
INNER JOIN role ON casting.id_role = role.id_role
INNER JOIN acteur ON casting.id_acteur = acteur.id_acteur
INNER JOIN personne ON acteur.id_personne = personne.id_personne

WHERE acteur.id_acteur LIKE 2







-- H. Liste des personnes qui sont à la fois acteurs et réalisateurs

SELECT CONCAT(prenom," " ,nom) AS "acteur et realisateur" 
FROM personne
WHERE personne.id_personne IN (SELECT id_personne FROM realisateur)
AND personne.id_personne IN (SELECT id_personne FROM acteur)






-- I. Liste des films qui ont moins de 5 ans (classés du plus récent au plus ancien)


-- SELECT titre, date_sortie_france 
-- FROM film
-- WHERE DATEDIFF(yy, date_sortie_france, '2024-01-01' ) < 5

-- ORDER BY date_sortie_france DESC 

SELECT *
FROM film
WHERE TIMESTAMPDIFF(YEAR, date_sortie_france, NOW() ) < 5
ORDER BY date_sortie_france DESC;




-- J. Nombre d’hommes et de femmes parmi les acteurs


SELECT COUNT(*) AS effectif, sexe

FROM personne

INNER JOIN acteur ON personne.id_personne=acteur.id_personne

GROUP BY sexe




-- K. Liste des acteurs ayant plus de 50 ans (âge révolu et non révolu)


SELECT 

CONCAT(prenom, ' ', nom) AS acteurs ,
TIMESTAMPDIFF(year, date_naissance, NOW() ) AS Age

FROM acteur
INNER JOIN personne ON acteur.id_personne=personne.id_personne
WHERE TIMESTAMPDIFF(YEAR, date_naissance, NOW() ) > 50



-- L. Acteurs ayant joué dans 3 films ou plus

SELECT CONCAT (prenom, ' ', nom) AS acteurs
FROM casting

INNER JOIN acteur ON casting.id_acteur=acteur.id_acteur
INNER JOIN personne ON acteur.id_personne=personne.id_personne


GROUP BY casting.id_acteur
HAVING ( SELECT COUNT(casting.id_acteur) >= 3 )


